<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\TaskModel;

class Tasks extends BaseController
{
    //After login
    public function index()   
    {       
        $data=[];  
        $data["allUsers"] = $this->UserModel->listUsers();
        
        echo view('header', $data);
        echo view('nav');
        echo view('pages/tasks');
        echo view('footer');
    }

    public function addTask(){
        
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            
            $rules = [
                'task' => 'required|min_length[5]|max_length[1000]'
            ];            

            if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
                
			} else {                

                $model = new TaskModel();
                $newData = [                    
                    'task' => $this->request->getVar('task'),
                    'task_date' => $this->request->getVar('taskDate'),
                    'status' => 'new',
                    'frecvency' => $this->request->getVar('frecvency'),
                    'user_id' => session()->get('id'),
                ]; 
                
                //print_r($newData);
               
                $model->insert($newData);

 				$session = session();
				$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('/tasks');
            }           
        }
        //echo "<pre>";
        

        echo view('header', $data);
        echo view('nav');
        echo view('pages/tasks');
        echo view('footer');
    }
}