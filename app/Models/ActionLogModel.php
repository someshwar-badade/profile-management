<?php 
 namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class ActionLogModel extends Model {
    protected  $table = 'action_log';
    protected $primaryKey  = 'id';
    // protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['user_id', 'action_type', 'model','record_id', 'chaged_data','action_by'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';



    public function getList($filter=array(),$searchQuery='',$start=0,$length=10,$orderBy='action_log.id desc',$report=false){
        // $db = \Config\Database::connect();
        $builder = $this->db->table('action_log');
        // $builder->select("action_log.chaged_data, DATE_FORMAT(action_log.created_at,'%d-%b-%Y %h:%s') as created_at, CONCAT_WS(' ',users.first_name,users.middle_name,users.last_name) as action_by_user ");
        $builder->select("action_log.id,action_log.action_by, action_log.action_type, action_log.model, action_log.chaged_data, DATE_FORMAT(action_log.created_at,'%d-%b-%Y %h:%s %p') as created_at ");
        // $builder->join('users','action_log.user_id = users.id','left');
        if(!$report){
            $countBuilder = clone($builder);
            $recordsTotal = $countBuilder->countAllResults();
        }

        if(isset($filter)){
		
			if(isset($filter['model'])){
				if(strlen(trim($filter['model']))>0){
					$builder->where("model",$filter['model']);
				}
            }
			if(isset($filter['action_type'])){
				if(strlen(trim($filter['action_type']))>0){
					$builder->where("action_type",$filter['action_type']);
				}
            }
			if(isset($filter['action_type'])){
				if(strlen(trim($filter['action_type']))>0){
					$builder->where("action_type",$filter['action_type']);
				}
            }
			if(isset($filter['from_dt']) && isset($filter['to_dt'])){
				if(strlen(trim($filter['from_dt']))>0 && strlen(trim($filter['to_dt']))>0){

					$fromDt = date('Y-m-d',strtotime($filter['from_dt']));
                    $toDt = date('Y-m-d',strtotime($filter['to_dt']));
                    $builder->where("CAST(created_at AS DATE) BETWEEN  '$fromDt' AND '$toDt' ");
				}
            }

            if(isset($filter['action_by'])){
				if(strlen(trim($filter['action_by']))>0){
                    $filterActionBy = $filter['action_by'];
                    $builder->where("action_by LIKE  '%$filterActionBy%' ");
				}
            }

        }
        
        if($searchQuery){
            $builder->where("($searchQuery)");
        }
        if(!$report){
        $builderCount = clone($builder);
        $recordsFiltered =  $builderCount->countAllResults();
        }
        if($length >= 0){

            $builder->limit($length, $start);
        }    

        if (trim($orderBy) != '') {
            $builder->orderBy(trim($orderBy));
        }

        $query   = $builder->get();
        $data = $query->getResultArray();
        if($report){
            return $data;
        }else{
            return ['filter'=>$filter,'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $data];
        }
       
    }

  

}

?>