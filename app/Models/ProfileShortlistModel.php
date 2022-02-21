<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileShortlistModel extends Model
{
    protected $table = 'profile_shortlist';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['job_position_id', 'profile_id', 'applied_dt'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
}
