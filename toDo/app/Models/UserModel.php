<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{  

    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'phone', 'level_access', 'password', 'status', 'updated_at'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        $data['data']['level_access'] = "user";
        $data['data']['status'] = "activ";
        
        return $data;
      }
    
      protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        
        return $data;
      }

      protected function passwordHash(array $data){
        if(isset($data['data']['password']))
          $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);    
            return $data;
      }
      
      protected function listUsers(){
        $query = $this->db->get("users");
        return $query->result();
      }
}