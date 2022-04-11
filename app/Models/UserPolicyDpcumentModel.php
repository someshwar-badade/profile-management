<?php namespace App\Models;
  
use CodeIgniter\Model;
class UserPolicyDpcumentModel extends Model
{
    protected $table = 'user_policy_documents';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id','user_id', 'document_id', 'view_at'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;

   public function updateViewTime($userId, $documentId){
   
     $rec = $this->getRecord($userId,$documentId);
     if($rec){
         //update
         $rec['view_at'] = date('Y-m-d H:i:s');
         return $this->save($rec);
     }else{
         //insert
         $insertData['view_at'] = date('Y-m-d H:i:s');
         $insertData['user_id'] = $userId;
         $insertData['document_id'] = $documentId;
         return $this->insert($insertData);
     }

   }

   public function getRecord($userId, $documentId){
        return $this->where('user_id',$userId)->where('document_id',$documentId)->first();
   }
}