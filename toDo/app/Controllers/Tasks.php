<?php
namespace App\Controllers;
use App\Models\TaskModel;
use App\Models\UserModel;

class Tasks extends BaseController
{
    //After login
    public function index() 
    {   
        $data=[];         
        $model = new TaskModel();  
        $userModel = new UserModel();             
        $tasks = $model->listTasks();  
        $users = $userModel->listUsers();
        $data["allTasks"] = $tasks;
        $data["users"] = $users;
        echo view('header');
        echo view('nav');
        echo view('pages/tasks', array('data' => $data));
        echo view('footer');
    }

    //Add a new task
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
                $userId = $this->request->getVar('assignTo') ?: session()->get('id');
                $newData = [                    
                    'task' => $this->request->getVar('task'),
                    'task_date' => $this->request->getVar('taskDate'),
                    'status' => 'new',
                    'frecvency' => $this->request->getVar('frecvency'),
                    'user_id' => $userId      
                ];

                $model->insert($newData);
 				$session = session();
				$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('/tasks');
            }           
        }       
        echo view('header', $data);
        echo view('nav');
        echo view('pages/tasks');
        echo view('footer');
    }

    //Mark as "done" a task 
    public function markAsDone($taskId){
        $model = new TaskModel();
        $checkFrecvency =  $model->checkFrecvency($taskId);
        if($checkFrecvency->frecvency == "weekly"){
            $newDeadline = "7 DAY";
            $model->updateNewDeadline($newDeadline, $taskId);
        } 
        else if($checkFrecvency->frecvency == "monthly"){
            $newDeadline = "1 MONTH";
            $model->updateNewDeadline($newDeadline, $taskId);
        }else if($checkFrecvency->frecvency == "yearly"){
            $newDeadline = "1 YEAR";
            $model->updateNewDeadline($newDeadline, $taskId);
        } else {
            $model->markAsDone($taskId);
        }
        return redirect()->to('/tasks');
    }

    public function addMessage(){
        $model = new TaskModel();
        $message = [                    
            'taskMessage' => $this->request->getVar('taskMessage'),
            'taskDate' => $this->request->getVar('taskDate'),
            'taskId' => $this->request->getVar('taskId')     
        ];

        //$model->
    }
}