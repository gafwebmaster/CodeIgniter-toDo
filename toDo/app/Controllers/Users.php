<?php
namespace App\Controllers;
use App\Models\UserModel;

class Users extends BaseController
{
    //Login
    public function index()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [                
                'email' => 'required|min_length[6]|max_length[50]|valid_email',                
                'password' => 'required|min_length[2]|max_length[85]|validateUser[email,password]'
            ];
            $errors = [
                'password' => [
                    'validateUser' => 'Email or Password don\'t match'
                ]
            ];
            if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			} else {
                $model = new UserModel();               
                $user = $model->where('email', $this->request->getVar('email'))
                              ->first();              
                $this->setUserSession($user);              
				return redirect()->to('/tasks');
            }
        }        
        echo view('header', $data);
        echo view('nav');
        echo view('pages/login');
        echo view('footer');
    }

    //Set user session
    private function setUserSession($user){
        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'level_access' => $user['level_access'],
            'isLoggedIn' => true
        ];
        session()->set($data);
    }

    //Add a new user
    public function addUser(){  
        $data = [];      
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[3]|max_length[50]|valid_email|is_unique[users.email]',
                'phone' => 'required|min_length[9]|max_length[12]',
                'password' => 'required|min_length[2]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];
            if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
                $model = new UserModel();
                $newData = [
                    'name' => $this->request->getVar('name'),
                    'email' => $this->request->getVar('email'),
                    'phone' => $this->request->getVar('phone'),
                    'password' => $this->request->getVar('password')
                ]; 
                $model->insert($newData);
 				$session = session();
				$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('/');
            }           
        }        
        echo view('header', $data);
        echo view('nav');
        echo view('pages/addUser');
        echo view('footer');
    }

    //View a profile
    public function profile(){
        $data = [];
        helper(['form']);
        $model = new UserModel();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[20]'               
            ];

            if (! $this->request->getPost('password') !='') {                
                $rules['password'] = 'required|min_length[2]|max_length[255]';
                $rules['password_confirm'] = 'matches[password]';
			} 

            if(! $this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();  
                $newData = [
                    'id' => session()->get('id'),
                    'name' => $this->request->getPost('name'),
                ];
                if($this->request->getPost('password') != ''){
                    $newData['password'] = $this->request->getPost('password');
                }
                $model->save($newData);
				session()->setFlashdata('success', 'Successful updated');
				return redirect()->to('/users/profile');
            }           
        } 
        $data['user'] = $model->where('id', session()->get('id'))->first();
        echo view('header', $data);
        echo view('nav');
        echo view('pages/profile');
        echo view('footer');      
    }

    //Logout
    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }
}