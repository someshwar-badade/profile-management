<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class EmployeeJoinigDetailsModel extends Model
{
    protected $table = 'employee_joining_form_details';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'first_name', 'last_name', 'father_name', 'mother_name', 'spouse_name', 'kids_name', 'email_primary', 'mobile_primary', 'aadhar_number', 'pan_number', 'education_qualification', 'professional_qualification', 'employment_history', 'background_info', 'employee_other_details', 'verification_code', 'created_by', 'updated_by', 'status'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getList($filter=array(),$searchQuery='',$start=0,$length=10,$orderBy='id ASC'){
        $db = \Config\Database::connect();
		$builder = $db->table('employee_joining_form_details');
		$builder->select('employee_joining_form_details.*');
        $countBuilder = clone($builder);
        $recordsTotal = $countBuilder->countAllResults();

        if(isset($filter)){
		
			if(isset($filter['type'])){
				if(strlen(trim($filter['type']))>0){

					$builder->where("type LIKE '%".$filter['type']."%'");
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