<?php 
namespace App\Models;
use CodeIgniter\Model;

class MessageModel extends Model{

    protected $table = 'messages';
    protected $allowedFields = ['name', 'email', 'phone', 'level_access', 'password', 'status', 'updated_at'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
       
    }
    
    protected function beforeUpdate(array $data){
       
    }

    //   public function listMessages(){
    //     $query = $this->db->query("SELECT * FROM messages");
    //     $results = $query->getResult();
    //     return $results;
    // }
}