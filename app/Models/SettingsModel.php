<?php 
namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model {

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['user_type', 'user_role', 'owner_id', 'fname', 'lname', 'email', 'mobile', 'company_name', 'address', 'country', 'state', 'city', 'pincode', 'password', 'profile_picture', 'ip_address', 'status'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected  $table = 'settings';
    // protected $primaryKey  = 'setting_id';

}?>