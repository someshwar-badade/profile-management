<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'role_name', 'display_name','role_type'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}