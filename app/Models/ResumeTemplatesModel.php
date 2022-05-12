<?php namespace App\Models;
  
use CodeIgniter\Model;
use App\Models\RoleCapabilityModel;

class ResumeTemplatesModel extends Model
{
    protected $table = 'resume_templates';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'user_id', 'name', 'template_config', 'type'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getList($filter){
        $db = \Config\Database::connect();
		$builder = $db->table('resume_templates');
		$builder->select('resume_templates.*');
        if(isset($filter['user_id'])){
            if($filter['user_id']!=''){
                $builder->where("user_id",$filter['user_id']);
            }
        }
      
       

        $query   = $builder->get();
        
        $data = $query->getResultArray();
       
        foreach($data as $key=>$row){
            $data[$key]['template_config'] = $data[$key]['template_config']?json_decode($data[$key]['template_config'],true):'';
        }
        return $data;
    }
}