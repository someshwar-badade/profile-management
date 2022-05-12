<?php

namespace App\Models;

use CodeIgniter\Model;

class JobPositionModel extends Model
{
    protected $table = 'job_positions';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['job_code', 'client_name', 'title', 'desc', 'primary_skills', 'secondary_skills','primary_skills_soundex', 'secondary_skills_soundex','match_primary_skills', 'position_received_date','match_secondary_skills', 'valid_to_date', 'created_by', 'updated_by','locations','min_experience','max_experience'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
    public function getList($filter = array(), $searchQuery = '', $start = 0, $length = 10, $orderBy = 'id ASC')
    {
        $db = \Config\Database::connect();
        $builder = $db->table('job_positions');
        $builder->select('job_positions.*');
        $countBuilder = clone ($builder);
        $recordsTotal = $countBuilder->countAllResults();

        if (isset($filter)) {

            if (isset($filter['job_code'])) {
                if (strlen(trim($filter['job_code'])) > 0) {

                    $builder->where("job_positions.job_code LIKE '%" . $filter['job_code'] . "%'");
                }
            }

            if (isset($filter['title'])) {
                if (strlen(trim($filter['title'])) > 0) {

                    $builder->where("job_positions.title LIKE '%" . $filter['title'] . "%'");
                }
            }

            if (isset($filter['client_name'])) {
                if (strlen(trim($filter['client_name'])) > 0) {

                    $builder->where("job_positions.client_name LIKE '%" . $filter['client_name'] . "%'");
                }
            }

            if (isset($filter['received_date_from']) && isset($filter['received_date_to'])) {
                if (strlen(trim($filter['received_date_from'])) > 0 && strlen(trim($filter['received_date_to'])) > 0) {
                    $fromDt = date('Y-m-d',strtotime($filter['received_date_from']));
                    $toDt = date('Y-m-d',strtotime($filter['received_date_to']));
                    $builder->where("job_positions.position_received_date BETWEEN  '$fromDt' AND '$toDt' ");
                }
            }

            if (isset($filter['valid_date_from']) && isset($filter['valid_date_to'])) {
                if (strlen(trim($filter['valid_date_from'])) > 0 && strlen(trim($filter['valid_date_to'])) > 0) {
                    $fromDt = date('Y-m-d',strtotime($filter['valid_date_from']));
                    $toDt = date('Y-m-d',strtotime($filter['valid_date_to']));
                    $builder->where("job_positions.valid_to_date BETWEEN  '$fromDt' AND '$toDt' ");
                }
            }

            if (isset($filter['primary_skills'])) {
                if (count($filter['primary_skills']) > 0) {

                   
                    $primaryCombinations = combinations(array_map("primary_regxp_fun", $filter['primary_skills']), count($filter['primary_skills']));
                    $primary_skills_sql_arr = [];
                    foreach ($primaryCombinations as $c) {
                        $primary_skills_sql_arr[] = "(" . implode(" AND ", $c) . ") ";
                    }
                    $primary_skills_sql_str = "(" . implode(" OR ", $primary_skills_sql_arr) . ") ";

                    
                   $builder->where($primary_skills_sql_str);
                }
            }

            if (isset($filter['secondary_skills'])) {
                if (count($filter['secondary_skills']) > 0) {

                    $secondary_skills_sql_arr = [];
                    $secondaryCombinations = combinations(array_map("secondary_regxp_fun", $filter['secondary_skills']), count($filter['secondary_skills']));
                   
                    foreach ($secondaryCombinations as $c) {
                        $secondary_skills_sql_arr[] = "(" . implode(" AND ", $c) . ")";
                    }
                    $secondary_skills_sql_str = "(" . implode(" OR ", $secondary_skills_sql_arr) . ") ";
                    

                   $builder->where($secondary_skills_sql_str);
                }
            }



        }

        if ($searchQuery) {
            $builder->where("($searchQuery)");
        }
        $builderCount = clone ($builder);
        $recordsFiltered =  $builderCount->countAllResults();

        if ($length >= 0) {

            $builder->limit($length, $start);
        }

        $builder->orderBy($orderBy);

        $query   = $builder->get();

        $data = $query->getResultArray();
        foreach ($data as $key => $row) {
            
            if(!empty($row['primary_skills'])){
                $data[$key]['primary_skills'] = json_decode($row['primary_skills'],true);

            }
            if(!empty($row['secondary_skills'])){

                $data[$key]['secondary_skills'] = json_decode($row['secondary_skills'],true);
            }

        }
        return ['recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $data];
    }


    public function getJobPositionDetails($id){
        $response = $this->find($id);

        // $response['primary_skills'] = !empty($response['primary_skills'])?explode(" || ",$response['primary_skills']):null;
        // $response['secondary_skills'] = !empty($response['secondary_skills'])?explode(" || ",$response['secondary_skills']):null;

        if (!empty($response['primary_skills'])) {
            // $response['primary_skills'] = explode(' || ', $response['primary_skills']);
            $response['primary_skills'] = json_decode($response['primary_skills'], true);
        } else {
            $response['primary_skills'] = [];
        }

        if (!empty($response['secondary_skills'])) {
            // $response['secondary_skills'] = explode(' || ', $response['secondary_skills']);
            $response['secondary_skills'] = json_decode($response['secondary_skills'], true);
        } else {
            $response['secondary_skills'] = [];
        }

        $response['locations'] = !empty($response['locations'])?explode(" || ",$response['locations']):null;

        $response['min_exp_y'] = floor($response['min_experience']/12);
        $response['min_exp_m'] = (int)$response['min_experience']%12;
        $response['max_exp_y'] = floor($response['max_experience']/12);
        $response['max_exp_m'] = (int)$response['max_experience']%12;

        $response['position_received_date'] =!empty($response['position_received_date'])? date('d-M-Y',strtotime($response['position_received_date'])):'';
        $response['valid_to_date'] = !empty($response['valid_to_date'])?date('d-M-Y',strtotime($response['valid_to_date'])):'';

        return $response;
    }

    public static function getCount(){
        $db = \Config\Database::connect();
        $builder = $db->table('job_positions');
        
       return  $builder->countAllResults();
        // $builder->select('status,COUNT(id) as count');
        // $builder->groupBy('status');
        // $query   = $builder->get();
    }
    
}
