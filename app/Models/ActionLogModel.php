<?php 
 namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class ActionLogModel extends Model {
    protected  $table = 'action_log';
    protected $primaryKey  = 'id';
    // protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['user_id', 'action_type', 'model','record_id', 'chaged_data'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';



    public function getList($filter=array(),$searchQuery='',$start=0,$length=10,$orderBy='action_log.id desc'){
        $db = \Config\Database::connect();
        $builder = $db->table('action_log');
        $builder->select("action_log.chaged_data, DATE_FORMAT(action_log.created_at,'%d-%b-%Y %h:%s') as created_at, CONCAT_WS(' ',users.first_name,users.middle_name,users.last_name) as action_by_user ");
        $builder->join('users','action_log.user_id = users.id','left');
        $countBuilder = clone($builder);
        $recordsTotal = $countBuilder->countAllResults();

        if(isset($filter)){
		
			if(isset($filter['model'])){
				if(strlen(trim($filter['model']))>0){
					$builder->where("model",$filter['model']);
				}
            }
			if(isset($filter['record_id'])){
				if(strlen(trim($filter['record_id']))>0){
					$builder->where("record_id",$filter['record_id']);
				}
            }

        }
        
        if($searchQuery){
            $builder->where("($searchQuery)");
        }
        $builderCount = clone($builder);
        $recordsFiltered =  $builderCount->countAllResults();
        
        if($length >= 0){

            $builder->limit($length, $start);
        }    

        $builder->orderBy($orderBy);

        $query   = $builder->get();
        $data = $query->getResultArray();
        return ['recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $data];
    }

  

}

?>