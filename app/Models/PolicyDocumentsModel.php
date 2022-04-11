<?php namespace App\Models;
  
use CodeIgniter\Model;
class PolicyDocumentsModel extends Model
{
    protected $table = 'policy_documents';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id','document_name', 'type', 'file','file_name_original', 'text', 'status'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;

    public function getList($filter){
        $db = \Config\Database::connect();
		$builder = $db->table('policy_documents');
		$builder->select('policy_documents.*');
        if(isset($filter['status'])){
            if($filter['status']!=''){
                $builder->where("status = '".$filter['status']."'");
            }
        }
        $builder->where("deleted_at is NULL");
       
        $builder->orderBy('document_name ASC');

        $query   = $builder->get();
        
        $data = $query->getResultArray();
       
        return $data;
    }

    public function getPolicyDocUser($userId){
        $db = \Config\Database::connect();
		$builder = $db->table('policy_documents');
		$builder->select('policy_documents.*,user_policy_documents.view_at');
        $builder->join('user_policy_documents','policy_documents.id = user_policy_documents.document_id AND user_policy_documents.user_id = '.$userId,'left');
        $builder->where("status = 'Active'");
        $builder->where("policy_documents.deleted_at is NULL");
        $builder->orderBy('document_name ASC');
        $query   = $builder->get();
        $data = $query->getResultArray();
        return $data;
    }

    
    public static function getCount($status=''){
        $db = \Config\Database::connect();
        $builder = $db->table('policy_documents');
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