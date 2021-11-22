<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class EducationQualificationModel extends Model
{
    protected $table = 'educational_qualification';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'joining_form_id', 'degree', 'university', 'institution', 'from_date', 'to_date', 'course_type', 'percentage','document_path'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}