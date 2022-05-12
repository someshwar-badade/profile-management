<?php namespace App\Models;
  
use CodeIgniter\Model;

class SiteSettingsModel extends Model
{
    protected $table = 'site_settings';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['id', 'setting_name', 'value'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function updateSetting($key,$value){
        $builder = $this->db->table('site_settings');
        $builder->set('value', $value);
        $builder->where('setting_name', $key);
       return  $builder->update();
    }
}