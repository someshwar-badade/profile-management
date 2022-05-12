<?php 
 namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class UserLeavesDatesModel extends Model {
    protected  $table = 'user_leave_dates';
    protected $primaryKey  = 'id';
    // protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id','user_leave_id', 'date', 'full_or_half'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


  
    
}

?>