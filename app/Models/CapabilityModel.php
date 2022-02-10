<?php namespace App\Models;
  
use CodeIgniter\Model;
use App\Models\RoleCapabilityModel;

class CapabilityModel extends Model
{
    protected $table = 'capabilities';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'capability', 'module'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function hasCapability($capability,$role_id){
        $cap = $this->where('capability',$capability)->first();
        
        if(empty($cap)){
            return false;
        }

        $roleCapabilityModel = new RoleCapabilityModel();

       return (boolean) $roleCapabilityModel->checkCapability($cap['id'],$role_id);
    }

    public function getAllCapabilities($roleId){
        $db = \Config\Database::connect();
        $builder = $db->table('capabilities');
        $builder->select("role_capability.id as role_capability_id,capabilities.id as capability_id, capabilities.capability,capabilities.module, role_capability.is_allowed");
        $builder->join('role_capability','capabilities.id = role_capability.capability_id AND role_capability.role_id = '.$roleId,'left');
        $builder->orderBy('capabilities.capability');
        $query   = $builder->get();
        $data = $query->getResultArray();
        return $data;
    }
}