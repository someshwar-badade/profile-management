<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class ProfileEducationQualificationModel extends Model
{
    protected $table = 'profile_educational_qualification';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'profile_id', 'degree', 'university', 'institution', 'from_date', 'to_date', 'course_type', 'percentage','document_path'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
}