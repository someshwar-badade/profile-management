<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class GapDeclarationModel extends Model
{
    protected $table = 'gap_declaration';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'joining_form_id', 'particular', 'from_date', 'to_date', 'document_path'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}