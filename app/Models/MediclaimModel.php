<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class MediclaimModel extends Model
{
    protected $table = 'mediclaim';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'joining_form_id', 'name', 'relationship', 'dob', 'age', 'document_path'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
}