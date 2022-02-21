<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class EmployeeJoinigDetailsModel extends Model
{
    protected $table = 'employee_joining_form_details';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'first_name', 'last_name', 'father_name', 'mother_name', 'spouse_name', 'kids_name', 'email_primary', 'mobile_primary', 'aadhar_number', 'pan_number','dob','place_of_birth','nationality', 'education_qualification', 'professional_qualification', 'employment_history', 'background_info', 'employee_other_details','documents', 'verification_code','is_accept_declaration','approval_dt', 'created_by', 'updated_by', 'status'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
    public function verifyJoinigForm($email,$adharPan,$verificationCode){

        $db = \Config\Database::connect();
		$builder = $db->table('employee_joining_form_details');
		// $builder->select('id','first_name', 'last_name');
        $builder->where("verification_code='$verificationCode' AND email_primary='$email' AND (aadhar_number='$adharPan' OR pan_number='$adharPan')");
        $builder->limit(1, 0);

        $query   = $builder->get();
        $data = $query->getRow();
        return $data;
    }

    public function getJoiningFormDetails($id){

        $result = $this->find($id);
        if(empty($result)){
            return;
        }
        $result['joining_date'] = date(SITE_DATE_FORMAT,strtotime($result['joining_date']));
        $result['referralDetails'] = $this->select('id,first_name,last_name,father_name,mother_name,spouse_name,kids_name,mobile_primary,email_primary,aadhar_number,pan_number,education_qualification,professional_qualification,employment_history,background_info,employee_other_details')->find($id);
        // ,DATE_FORMAT(joining_date, "'.SITE_DATE_FORMAT_SQL.'") as joining_date
       
       
        return $result;
    }

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
			if(isset($filter['status'])){
				if(strlen(trim($filter['status']))>0){

					$builder->where("status",$filter['status']);
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

        if (trim($orderBy) != '') {
        $builder->orderBy($orderBy);
        }
        $query   = $builder->get();
        
        $data = $query->getResultArray();
        return ['recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $data?:null];
    }

    public static function getCount($status=''){
        $db = \Config\Database::connect();
        $builder = $db->table('employee_joining_form_details');
        if(strlen($status)>0){
            $builder->where('status',$status);
        }
       return  $builder->countAllResults();
        // $builder->select('status,COUNT(id) as count');
        // $builder->groupBy('status');
        // $query   = $builder->get();
    }
}