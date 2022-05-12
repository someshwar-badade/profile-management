<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class ProfileProjectsModel extends Model
{
    protected $table = 'profile_projects';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id','profile_id', 'title', 'description'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
}