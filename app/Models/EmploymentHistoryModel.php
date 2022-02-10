<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class EmploymentHistoryModel extends Model
{
    protected $table = 'employment_history';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'joining_form_id', 'company', 'department', 'position_held', 'from_date', 'to_date', 'nature_of_job', 'job_responsibilities', 'annual_ctc', 'address', 'city', 'telephone', 'reporting_manager', 'contact_number_manager', 'email_manager', 'reason_of_leaving', 'hr_name', 'hr_contact_number', 'hr_email', 'hr_designation'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}