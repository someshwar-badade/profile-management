<?php namespace App\Models;
  
use CodeIgniter\Model;
use App\Models\ClientContactsModel;
class ClientsModel extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'client_name','logo','status'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;

    public function getList($filter){
        $db = \Config\Database::connect();
		$builder = $db->table('clients');
		$builder->select('clients.*');
        if(isset($filter['status'])){
            if($filter['status']!=''){
                $builder->where("status",$filter['status']);
            }
        }
      
       
        $builder->orderBy('status DESC');

        $query   = $builder->get();
        
        $data = $query->getResultArray();
        $ClientContactsModel = new ClientContactsModel();
        foreach($data as $key=>$row){
            $data[$key]['clientContacts'] = $ClientContactsModel->where('client_id',$row['id'])->findAll();
        }
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