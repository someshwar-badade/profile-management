<?php namespace App\Models;
  
use CodeIgniter\Model;
use App\Models\RoleCapabilityModel;

class EmailTemplatesModel extends Model
{
    protected $table = 'email_templates';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'short_name', 'display_name', 'email_to', 'email_cc', 'email_bcc', 'subject', 'body', 'status'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getList($filter){
        $db = \Config\Database::connect();
		$builder = $db->table('email_templates');
		$builder->select('email_templates.*');
        if(isset($filter['status'])){
            if($filter['status']!=''){
                $builder->where("status = '".$filter['status']."'");
            }
        }
        $builder->where("deleted_at is NULL");
       
        $builder->orderBy('subject ASC');

        $query   = $builder->get();
        
        $data = $query->getResultArray();
       
        return $data;
    }
    
    public static function getCount($status=''){
        $db = \Config\Database::connect();
        $builder = $db->table('email_templates');
        $builder->where("deleted_at is NULL");
        if(strlen($status)>0){
            $builder->where("status = '$status'");
        }
       return  $builder->countAllResults();
        // $builder->select('status,COUNT(id) as count');
        // $builder->groupBy('status');
        // $query   = $builder->get();
    }

}