<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class ProfessionalQualificationModel extends Model
{
    protected $table = 'professional_qualification';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'joining_form_id', 'qualification', 'category', 'date', 'document_path'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
}