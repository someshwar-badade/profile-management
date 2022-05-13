<?php 
 namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class UserLeavesModel extends Model {
    protected  $table = 'user_leaves';
    protected $primaryKey  = 'id';
    // protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','user_id','leave_type_id', 'reason','comment','cancellation_reason', 'no_of_days', 'action_by_user', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';



    public function getList($filter=array(),$searchQuery='',$start=0,$length=10,$orderBy='user_leave_id desc',$report=false){
        // $db = \Config\Database::connect();
        $builder = $this->db->table($this->table);
        // $builder->select("action_log.chaged_data, DATE_FORMAT(action_log.created_at,'%d-%b-%Y %h:%s') as created_at, CONCAT_WS(' ',users.first_name,users.middle_name,users.last_name) as action_by_user ");
        $builder->select("user_leaves.id, user_leaves.id as user_leave_id,user_leave_type.title as leave_type ,user_leaves.reason, user_leaves.comment ,user_leaves.no_of_days,user_leaves.action_by_user,user_leaves.status, DATE_FORMAT(user_leaves.created_at,'%d-%b-%Y %h:%s %p') as created_at, CONCAT(users.fname,' ', users.lname) as employee_name,SUM(user_leave_dates.full_or_half) as total_days ");
        $builder->join('users','user_leaves.user_id = users.id','left');
        $builder->join('user_leave_type','user_leaves.leave_type_id = user_leave_type.id','left');
        $builder->join('user_leave_dates','user_leaves.id = user_leave_dates.user_leave_id','left');
        $builder->groupBy('user_leaves.id');
        if(isset($filter['view_only_my_leaves'])){
            $builder->where("user_leaves.user_id",$filter['view_only_my_leaves']);
            $statusWiseCount= $this->getStatusWiseCount($filter['view_only_my_leaves']);
        }else{
            $statusWiseCount= $this->getStatusWiseCount();
        }

        if(!$report){
            $countBuilder = clone($builder);
            $recordsTotal = $countBuilder->countAllResults();

            
        }

        if(isset($filter)){
		
			if(isset($filter['user_id'])){
				if(strlen(trim($filter['user_id']))>0){
					$builder->where("user_leaves.user_id",$filter['user_id']);
				}
            }
			if(isset($filter['status'])){
				if(strlen(trim($filter['status']))>0){
					$builder->where("user_leaves.status",$filter['status']);
				}
            }
		

        }
        


        if($searchQuery){
            $builder->where("($searchQuery)");
        }
        if(!$report){
            $builderCount = clone($builder);
            $recordsFiltered =  $builderCount->countAllResults();

            
        }


        if($length >= 0){

            $builder->limit($length, $start);
        }    

        if (trim($orderBy) != '') {
            $builder->orderBy(trim($orderBy));
        }

        $query   = $builder->get();
        $data = $query->getResultArray();

        $UserLeavesDatesModel = new UserLeavesDatesModel();
        foreach($data as $key=>$row){
            $dates =  $UserLeavesDatesModel->where('user_leave_id', $row['user_leave_id'])->findAll();
            foreach ($dates as $key2 => $row2) {
                $dates[$key2]['date'] = date('d-M-Y', strtotime($row2['date']));
            }

            $data[$key]['dates'] =$dates;
        }


        if($report){
            return $data;
        }else{
            return ['filter'=>$filter,'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered,'orderBy'=>$orderBy, 'data' => $data,'statusWiseCount'=>$statusWiseCount];
        }
       
    }

    public function getDetails($id){
        $builder = $this->db->table($this->table);
        // $builder->select("action_log.chaged_data, DATE_FORMAT(action_log.created_at,'%d-%b-%Y %h:%s') as created_at, CONCAT_WS(' ',users.first_name,users.middle_name,users.last_name) as action_by_user ");
        $builder->select("user_leaves.id, user_leaves.id as user_leave_id,user_leaves.leave_type_id,user_leave_type.title as leave_type ,user_leaves.reason, user_leaves.comment, user_leaves.cancellation_reason ,user_leaves.no_of_days,user_leaves.action_by_user,user_leaves.status, DATE_FORMAT(user_leaves.created_at,'%d-%b-%Y %h:%s %p') as created_at, CONCAT(users.fname,' ', users.lname) as employee_name,SUM(user_leave_dates.full_or_half) as total_days ");
        $builder->join('users','user_leaves.user_id = users.id','left');
        $builder->join('user_leave_type','user_leaves.leave_type_id = user_leave_type.id','left');
        $builder->join('user_leave_dates','user_leaves.id = user_leave_dates.user_leave_id','left');
        $builder->groupBy('user_leaves.id');
        $builder->where("user_leaves.id",$id);
        $builder->limit(1, 0);
        $query   = $builder->get();
        $data = $query->getResultArray();

        if($data){
            return $data[0];
        }else{
            return null;
        }
    }

    public function checkDuplicateDates($user_id,$user_leave_id='',$arrayDates){
        $builder = $this->db->table($this->table);
        // $builder->select("action_log.chaged_data, DATE_FORMAT(action_log.created_at,'%d-%b-%Y %h:%s') as created_at, CONCAT_WS(' ',users.first_name,users.middle_name,users.last_name) as action_by_user ");
        $builder->select("user_leaves.id as user_leave_id, DATE_FORMAT(user_leave_dates.date,'%d-%b-%Y') as date,user_leaves.status ");
        $builder->join('users','user_leaves.user_id = users.id','left');
        $builder->join('user_leave_type','user_leaves.leave_type_id = user_leave_type.id','left');
        $builder->join('user_leave_dates','user_leaves.id = user_leave_dates.user_leave_id','left');
        $builder->groupBy('user_leave_dates.date');
        if(!empty($user_leave_id)){
            $builder->where("user_leaves.id != $user_leave_id");
        }
        
        $builder->where("user_leaves.user_id",$user_id);
        $builder->whereIn("user_leaves.status",['Approved','Pending','Request for cancellation']);
        $builder->whereIn("user_leave_dates.date",$arrayDates);

       
        $query   = $builder->get();
        $data = $query->getResultArray();
        return $data;
    }

    public function getChartData($user_id,$year){


        /*
        SELECT user_leaves.id, user_leaves.user_id,user_leave_dates.date,month(user_leave_dates.date) month,COUNT(user_leave_dates.id) leave_count FROM `user_leaves` 
        JOIN user_leave_dates on user_leave_dates.user_leave_id = user_leaves.id

        WHERE user_leaves.user_id = 22 AND user_leaves.status='Approved' AND year(user_leave_dates.date) = '2022'
        group by year(user_leave_dates.date),month(user_leave_dates.date)
        order by year(user_leave_dates.date),month(user_leave_dates.date)
        */
        $builder = $this->db->table($this->table);
        // $builder->select("action_log.chaged_data, DATE_FORMAT(action_log.created_at,'%d-%b-%Y %h:%s') as created_at, CONCAT_WS(' ',users.first_name,users.middle_name,users.last_name) as action_by_user ");
        $builder->select("user_leaves.id, user_leaves.user_id,user_leave_dates.date,month(user_leave_dates.date) month,SUM(user_leave_dates.full_or_half) leave_count ");
        $builder->join('user_leave_dates','user_leaves.id = user_leave_dates.user_leave_id');
        $builder->groupBy('year(user_leave_dates.date), month(user_leave_dates.date)');
        $builder->orderBy('year(user_leave_dates.date), month(user_leave_dates.date)');
        $builder->where("user_leaves.user_id",$user_id);
        $builder->where("year(user_leave_dates.date) = '$year'");
        $builder->whereIn("user_leaves.status",['Approved','Request for cancellation']);
        $query   = $builder->get();
        $data = $query->getResultArray();



        return $data;
    }
  
    public function getStatusWiseCount($user_id=''){
        $builder = $this->db->table($this->table);
        $builder->select(" COUNT(case user_leaves.status when 'Pending' then 1 else null end) as 'pending',
                           COUNT(case user_leaves.status when 'Approved' then 1 else null end) as 'approved',
                           COUNT(case user_leaves.status when 'Cancelled' then 1 else null end) as 'cancelled',
                           COUNT(case user_leaves.status when 'Rejected' then 1 else null end) as 'rejected',
                           COUNT(case user_leaves.status when 'Request for cancellation' then 1 else null end) as 'reqcancel' ");
        // $builder->groupBy('user_leaves.status');
        if(!empty($user_id)){
            $builder->where("user_leaves.user_id",$user_id);
        }
        $query   = $builder->get();
        $data = $query->getRowArray();
        return $data;
    }

    public function getLeaveTypeWiseCount($user_id){
        $builder = $this->db->table($this->table);
        $builder->select(" user_leave_type.title as leave_type, SUM(user_leave_dates.full_or_half) as total_days ");
        $builder->join('user_leave_type','user_leaves.leave_type_id = user_leave_type.id','left');
        $builder->join('user_leave_dates','user_leaves.id = user_leave_dates.user_leave_id','left');
        $builder->where("user_leaves.user_id",$user_id);
        $builder->whereIn("user_leaves.status",['Approved']);
        $builder->groupBy("user_leaves.leave_type_id");
        $query   = $builder->get();
        $data = $query->getResultArray();
        return $data;
    }

    public function employeeList(){
        $builder = $this->db->table($this->table);
        // $builder->select("action_log.chaged_data, DATE_FORMAT(action_log.created_at,'%d-%b-%Y %h:%s') as created_at, CONCAT_WS(' ',users.first_name,users.middle_name,users.last_name) as action_by_user ");
        $builder->select("users.id as employee_id,CONCAT(users.fname,' ', users.lname) as employee_name ");
        $builder->join('users','user_leaves.user_id = users.id','left');
        $builder->groupBy('users.id');
        $query   = $builder->get();
        $data = $query->getResultArray();
        return $data;
    }

    public function getReportData($start,$length,$filter=[]){
        $builder = $this->db->table($this->table);
        // $builder->select("action_log.chaged_data, DATE_FORMAT(action_log.created_at,'%d-%b-%Y %h:%s') as created_at, CONCAT_WS(' ',users.first_name,users.middle_name,users.last_name) as action_by_user ");
        $builder->select("user_leaves.id, DATE_FORMAT(user_leave_dates.date,'%d-%b-%Y') as leave_date, user_leave_dates.full_or_half, user_leaves.id as user_leave_id,user_leave_type.title as leave_type ,user_leaves.reason, user_leaves.comment ,user_leaves.no_of_days,user_leaves.action_by_user,user_leaves.status, CONCAT(users.fname,' ', users.lname) as employee_name,user_leaves.cancellation_reason ");
        $builder->join('users','user_leaves.user_id = users.id','left');
        $builder->join('user_leave_type','user_leaves.leave_type_id = user_leave_type.id','left');
        $builder->join('user_leave_dates','user_leaves.id = user_leave_dates.user_leave_id','left');
        // $builder->groupBy('user_leaves.id');
       
        $builder->orderBy("user_leave_dates.date desc");
        $builder->orderBy("employee_name");

        if(isset($filter)){
		
			if(isset($filter['employee_id'])){
                if(count($filter['employee_id'])>0){
                    $builder->whereIn("user_leaves.user_id",$filter['employee_id']);
                }
            }
			if(isset($filter['status'])){
                if(count($filter['status'])>0){
                $builder->whereIn("user_leaves.status",$filter['status']);
                }
            }
			if(isset($filter['leave_type_id'])){
                if(count($filter['leave_type_id'])>0){
                $builder->whereIn("user_leaves.leave_type_id",$filter['leave_type_id']);
                }
            }

            if(isset($filter['date'])){
                $dateInt = strtotime($filter['date']);
                $year = date('Y',$dateInt);
                $month = date('m',$dateInt);
                $day = date('d',$dateInt);

                $builder->where("year(user_leave_dates.date)",$year);

                if($filter['reportFor']=='month' || $filter['reportFor']=='day'){
                    $builder->where("month(user_leave_dates.date)",$month);
                }

                if($filter['reportFor']=='day'){
                    $builder->where("day(user_leave_dates.date)",$day);
                }

            }
		
			// if(isset($filter['action_type'])){
			// 	if(strlen(trim($filter['action_type']))>0){
			// 		$builder->where("action_type",$filter['action_type']);
			// 	}
            // }
			// if(isset($filter['from_dt']) && isset($filter['to_dt'])){
			// 	if(strlen(trim($filter['from_dt']))>0 && strlen(trim($filter['to_dt']))>0){

			// 		$fromDt = date('Y-m-d',strtotime($filter['from_dt']));
            //         $toDt = date('Y-m-d',strtotime($filter['to_dt']));
            //         $builder->where("CAST(created_at AS DATE) BETWEEN  '$fromDt' AND '$toDt' ");
			// 	}
            // }

            // if(isset($filter['action_by'])){
			// 	if(strlen(trim($filter['action_by']))>0){
            //         $filterActionBy = $filter['action_by'];
            //         $builder->where("action_by LIKE  '%$filterActionBy%' ");
			// 	}
            // }

        }

        if($length >= 0){

            $builder->limit($length, $start);
        }    

        // if (trim($orderBy) != '') {
        //     $builder->orderBy(trim($orderBy));
        // }

        $query   = $builder->get();
        $data = $query->getResultArray();

        // $UserLeavesDatesModel = new UserLeavesDatesModel();
        // foreach($data as $key=>$row){
        //     $dates =  $UserLeavesDatesModel->where('user_leave_id', $row['user_leave_id'])->findAll();
        //     foreach ($dates as $key2 => $row2) {
        //         $dates[$key2]['date'] = date('d-M-Y', strtotime($row2['date']));
        //     }

        //     $data[$key]['dates'] =$dates;
        // }


        return $data;
       
    }
    
}

?>