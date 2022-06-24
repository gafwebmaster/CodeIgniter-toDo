<?php 
namespace App\Models;
use CodeIgniter\Model;

class TaskModel extends Model{
  protected $table = 'tasks';
  protected $allowedFields = ['company', 'status', 'frecvency', 'user_id', 'created_at', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  protected function beforeInsert(array $data){
      $data['data']['created_at'] = date('Y-m-d H:i:s');
      $data['data']['status'] = "new";
      return $data;
    }
  
    protected function beforeUpdate(array $data){
      $data['data']['updated_at'] = date('Y-m-d H:i:s');      
      return $data;
    }
    
    // List all tasks
    public function listTasks(){
      $query   = $this->db->query('SELECT DISTINCT * FROM users INNER JOIN tasks ON users.id = tasks.user_id');
      $results = $query->getResult();
      return $results;
    }    

    // Check a task frecvency
    public function checkFrecvency($idIask){
       $query = $this->db->query("SELECT frecvency, task_date FROM tasks WHERE id=$idIask LIMIT 1");
       $results = $query->getRow();
       return $results;
     }

    // Update a new deadline 
    public function updateNewDeadline($newDate,$idIask){ 
      $this->db->query("UPDATE tasks SET task_date=DATE_ADD(task_date, INTERVAL $newDate) WHERE id = $idIask");
    }

    // Mark a task as done 
    public function markAsDone($idIask){
      $this->db->query("UPDATE tasks SET status='done' WHERE id = $idIask"); 
    }

    public function addMessage($message){
      $this->db->query("INSERT INTO messages "); 
    }
}