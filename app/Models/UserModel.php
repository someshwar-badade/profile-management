<?php 
 namespace App\Models;
//  use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
// use App\Models\BankUserModel;
// use App\Models\UserMembershipProductModel;
class UserModel extends Model {
    protected  $table = 'users';
    protected $primaryKey  = 'id';
    // protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['user_type',
                                'user_role',
                                'owner_id',
                                'fname',
                                'lname',
                                'email',
                                'mobile',
                                'company_name',
                                'address',
                                'country',
                                'state',
                                'city',
                                'pincode',
                                'password',
                                'profile_picture',
                                'ip_address',
                                'last_login',
                                'verification_code',
                                 'status'
                                ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [
    //     'fullname'     => 'required|alpha_numeric_space|min_length[3]',
    //     'email'        => 'required|valid_email',
    //     'message'        => 'required',
    // ];
   


    public function getUserdetails($id){

        $result = $this->find($id);
        if(empty($result)){
            return;
        }
       // $result['joining_date'] = date(SITE_DATE_FORMAT,strtotime($result['joining_date']));
       // $result['referralDetails'] = $this->select('id,first_name,middle_name,last_name,mobile,email,photo,DATE_FORMAT(joining_date, "'.SITE_DATE_FORMAT_SQL.'") as joining_date')->find($id);

       
       
        return $result;
    }

    public function getList($filter=array(),$searchQuery='',$start=0,$length=10,$orderBy='id ASC'){
        $db = \Config\Database::connect();
		$builder = $db->table('users');
        $builder->select('users.*');
        $countBuilder = clone($builder);
        $recordsTotal = $countBuilder->countAllResults();

        if(isset($filter)){
		
			
           
           

        }
        
        if($searchQuery){
           
            $builder->where("($searchQuery)");
        }

        $builderCount = clone($builder);
        $recordsFiltered =  $builderCount->countAllResults();
        
          if($length>0){

              $builder->limit($length, $start);
          }  

        $builder->orderBy($orderBy);

      //  $compiletdSelect   = $builder->getCompiledSelect();
        $query   = $builder->get();
        $data = $query->getResultArray();
        return ['recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $data];
    }

   

    public function isUserExist($user_id){
        return (bool) $this->find($user_id);
    }

    public function getUserCount($filter){

    }


}
