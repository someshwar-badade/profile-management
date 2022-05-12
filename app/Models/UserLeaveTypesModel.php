<?php 
 namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class UserLeaveTypesModel extends Model {
    protected  $table = 'user_leave_type';
    protected $primaryKey  = 'id';
    // protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['user_id', 'action_type', 'model','record_id', 'chaged_data','action_by'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getActiveTypeList(){
        return $this->where('status','Active')->findAll();
    }

  

}

?>