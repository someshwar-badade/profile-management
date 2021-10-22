<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class ProfileModel extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['candidate_name', 'mobile_primary', 'mobile_alternate', 'email_primary', 'email_alternate', 'gender', 'photo', 'resume_pdf', 'resume_pdf_name', 'resume_doc', 'resume_doc_name', 'preferred_work_locations','categories', 'top_skills', 'middle_skills', 'foundation_skills','certifications', 'created_by', 'updated_by', 'status'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getList($filter=array(),$searchQuery='',$start=0,$length=10,$orderBy='id ASC'){
        $db = \Config\Database::connect();
		$builder = $db->table('profiles');
		$builder->select('profiles.*');
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