<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\ProfileShortlistModel;
use App\Models\InterviewModel;
class ProfileModel extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'id';
    protected $allowedFields =  ['user_id','candidate_name', 'mobile_primary', 'mobile_alternate', 'email_primary', 'email_alternate', 'gender', 'photo', 'resume_pdf', 'resume_pdf_name', 'resume_doc', 'resume_doc_name', 'preferred_work_locations', 'categories', 'primary_skills','primary_skills_soundex', 'secondary_skills','secondary_skills_soundex', 'foundation_skills','foundation_skills_soundex', 'certifications', 'work_experience', 'total_experience', 'relevant_experience', 'current_company', 'notice_period', 'is_negotiable_np', 'negotiable_np', 'ctc', 'expected_ctc', 'is_negotiable_ctc', 'negotiable_ctc', 'created_by', 'updated_by', 'status', 'first_name', 'father_name', 'last_name', 'marital_status', 'dob', 'pan_number', 'aadhar_number', 'verification_code', 'present_address', 'present_address_postcode', 'permanent_address', 'permanent_address_postcode', 'employment_history','last_working_day','documents'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;
    public function getList($filter = array(), $searchQuery = '', $start = 0, $length = 10, $orderBy = 'id ASC')
    {
        $db = \Config\Database::connect();
        $builder = $db->table('profiles');
        $builder->select('profiles.*');
        
        if(!empty($filter['shortlisted']) && !empty($filter['job_position_id'])){
            $builder->join('profile_shortlist','profiles.id = profile_shortlist.profile_id AND profile_shortlist.job_position_id = '.$filter['job_position_id']);
        }else if(!empty($filter['job_position_id'])){
            $builder->join('profile_shortlist','profiles.id = profile_shortlist.profile_id AND profile_shortlist.job_position_id = '.$filter['job_position_id'],'left');
            $builder->where("profile_shortlist.job_position_id IS NULL");
        }
        $countBuilder = clone ($builder);
        $recordsTotal = $countBuilder->countAllResults();

        if (isset($filter)) {

            if(isset($filter['status'])){
            	if(strlen(trim($filter['status']))>0){

            		$builder->where("status",$filter['status']);
            	}
            }

            if (isset($filter['primary_skills'])) {
                if (count($filter['primary_skills']) > 0) {


                    $primaryCombinations = combinations(array_map("primary_regxp_fun", $filter['primary_skills']), $filter['match_primary_skills']);
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
                    $secondaryCombinations = combinations(array_map("secondary_regxp_fun", $filter['secondary_skills']), $filter['match_secondary_skills']);

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

        if (trim($orderBy) != '') {
            $builder->orderBy(trim($orderBy));
        }

        $query   = $builder->get();

        $data = $query->getResultArray();

        $ProfileShortlistModel = new ProfileShortlistModel();
       
        foreach ($data as $key => $row) {
            
            if(!empty($row['primary_skills'])){
                $data[$key]['primary_skills'] = sortAssociativeArrayByKey( json_decode($row['primary_skills'],true), 'rating', 'DESC');

            }
            if(!empty($row['secondary_skills'])){

                $data[$key]['secondary_skills'] = sortAssociativeArrayByKey( json_decode($row['secondary_skills'],true), 'rating', 'DESC');
            }

            if(isset($filter['primary_skills'])){
               
                foreach ($data[$key]['primary_skills'] as $skill) {
                    if (checkSoundexExist($skill['text'], $filter['primary_skills'])) {
                        $data[$key]['primary_skills_matched'][] = $skill;
                    } else {
                        $data[$key]['primary_skills_other'][] = $skill;
                    }
                }
                
                
            }

            if(isset($filter['secondary_skills'])){
                foreach ( $data[$key]['secondary_skills'] as $skill) {
                    if (checkSoundexExist($skill['text'], $filter['secondary_skills'])) {
                        $data[$key]['secondary_skills_matched'][] = $skill;
                    } else {
                        $data[$key]['secondary_skills_other'][] = $skill;
                    }
                }
            }

            if(isset($filter['job_position_id'])){
                $shortListDetails = $ProfileShortlistModel->where('job_position_id',$filter['job_position_id'])->where('profile_id',$row['id'])->first();
                $data[$key]['isShortlisted'] = (boolean) $shortListDetails;
                $data[$key]['applied_dt'] =  $shortListDetails['applied_dt']?date('d-M-Y',strtotime($shortListDetails['applied_dt'])):'';
            }else{
                $data[$key]['isShortlisted'] = false;
            }
               

        }
       
        
        return ['recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $data];
    }

    public function statusWiseCount(){
        $db = \Config\Database::connect();
        $builder = $db->table('profiles');
        $builder->select('status,COUNT(id) as count');
        $builder->groupBy('status');
        $query   = $builder->get();

        $data = $query->getResultArray();
        $finalData = [];
        $allCount = 0;
        foreach($data as $row){
            $finalData[$row['status']] = $row;
            $allCount += $row['count'];
        }
        $finalData['all'] = $allCount;
        return $finalData;
    }

    public function getJobPositions($profile_id){

        $db = \Config\Database::connect();
        $builder = $db->table('job_positions');
        $builder->select('job_positions.*,profile_shortlist.applied_dt,profile_shortlist.created_at as shortlisted_dt');
        $builder->join('profile_shortlist','job_positions.id = profile_shortlist.job_position_id AND profile_shortlist.profile_id = '.$profile_id);
        // $builder->where('profiles.id',$profile_id);
        $query   = $builder->get();

        $data = $query->getResultArray();
        $InterviewModel = new InterviewModel();
        foreach($data as $key=>$row){
            //get interviews list
           $result =  $InterviewModel->getList(['profile_id'=>$profile_id,'job_position_id'=>$row['id']],'',0,-1);
           $data[$key]['interviews'] = !empty($result['data'])?$result['data']:null;
        }
        return $data;
    }

    public static function getCount($status=''){
        $db = \Config\Database::connect();
        $builder = $db->table('profiles');
        if(strlen($status)>0){
            $builder->where('status',$status);
        }
       return  $builder->countAllResults();
        // $builder->select('status,COUNT(id) as count');
        // $builder->groupBy('status');
        // $query   = $builder->get();
    }
}
