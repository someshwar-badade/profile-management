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

}