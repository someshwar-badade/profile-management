<?php 
 namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class SkillsModel extends Model {
    protected  $table = 'master_skills';
    protected $primaryKey  = 'id';
    // protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['text'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
   

public function getAutocompleteList($query){

    $db = \Config\Database::connect();
    $builder = $db->table('master_skills');
    $builder->select('text');
    $builder->where(" text LIKE '$query%'");
    $builder->limit(10, 0);
    $builder->orderBy('text');
    $query   = $builder->get();
    $data = $query->getResultArray();
    $data = array_column($data,"text");
    return $data;

}
  

}
