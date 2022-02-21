<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class InterviewModel extends Model
{
    protected $table = 'profile_interviews';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['profile_id', 'job_position_id','company_name', 'interview_taken_by', 'for_role', 'schedule_dt', 'status'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
    public function getList($filter=array(),$searchQuery='',$start=0,$length=10,$orderBy='id ASC'){
        $db = \Config\Database::connect();
		$builder = $db->table('profile_interviews');
		$builder->select('profile_interviews.*');
        if(isset($filter['profile_id'])){
            if($filter['profile_id']!=''){
                $builder->where("profile_id",$filter['profile_id']);
            }
        }
        if(isset($filter['job_position_id'])){
            if($filter['job_position_id']!=''){
                $builder->where("job_position_id",$filter['job_position_id']);
            }
        }
        $countBuilder = clone($builder);
        $recordsTotal = $countBuilder->countAllResults();

        if(isset($filter)){
		
			if(isset($filter['type'])){
				if(strlen(trim($filter['type']))>0){

					//$builder->where("type LIKE '%".$filter['type']."%'");
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