<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class RoleCapabilityModel extends Model
{
    protected $table = 'role_capability';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'role_id', 'capability_id','is_allowed'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function checkCapability($capabilityId,$role_id){
        return (boolean) $this->where('capability_id',$capabilityId)->where('role_id',$role_id)->where('is_allowed',1)->find();
    }
}