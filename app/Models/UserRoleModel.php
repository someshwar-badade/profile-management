<?php namespace App\Models;
  
use CodeIgniter\Model;
use App\Models\RoleCapabilityModel;

class UserRoleModel extends Model
{
    protected $table = 'user_role';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'user_id', 'role_id'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
    public function getRoles($userId){
        $db = \Config\Database::connect();
        $builder = $db->table('user_role');
        $builder->select("user_role.*, roles.role_name, roles.display_name ");
        $builder->join('roles','roles.id = user_role.role_id AND user_role.user_id = '.$userId);
        $query   = $builder->get();
        $data = $query->getResultArray();
        return $data;
    }

    public function getSelectedRole($userId){
        $db = \Config\Database::connect();
        $builder = $db->table('user_role');
        $builder->select("roles.*");
        $builder->join('roles','roles.id = user_role.role_id AND user_role.user_id = '.$userId);
        $query   = $builder->get();
        $data = $query->getResultArray();
        return $data;
    }
}