<?php 
namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model{  

  protected $table = 'tasks';
  protected $allowedFields = ['task', 'task_date', 'status', 'frecvency', 'user_id', 'created_at', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  protected function beforeInsert(array $data){
      $data['data']['created_at'] = date('Y-m-d H:i:s');
      $data['data']['status'] = "new";
      $data['data']['user_id'] = session()->get('id');        
      return $data;
    }
  
    protected function beforeUpdate(array $data){
      $data['data']['updated_at'] = date('Y-m-d H:i:s');      
      return $data;
    }   
}