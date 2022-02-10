<?php namespace App\Models;
  
use CodeIgniter\Model;

class ClientContactsModel extends Model
{
    protected $table = 'client_contacts';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'client_id', 'person_name', 'mobile', 'email','department', 'additional_info', 'created_by', 'updated_by'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getList($filter){
        $db = \Config\Database::connect();
		$builder = $db->table('client_contacts');
		$builder->select('client_contacts.*');

        $query   = $builder->get();
        
        $data = $query->getResultArray();
        return $data;
    }

    
    public static function getCount($status=''){
        $db = \Config\Database::connect();
        $builder = $db->table('clients');
        if(strlen($status)>0){
            $builder->where('status',$status);
        }
       return  $builder->countAllResults();
        // $builder->select('status,COUNT(id) as count');
        // $builder->groupBy('status');
        // $query   = $builder->get();
    }
}