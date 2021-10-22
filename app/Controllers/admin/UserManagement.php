<?php

namespace App\Controllers\admin;

use App\Controllers;
use App\Controllers\api\Users;
use App\Models\UserMembershipProductModel;
use App\Models\UserModel;
use App\Models\BankUserModel;
use App\Models\ProfileplanModel;
class UserManagement extends Controllers\BaseController
{
	public function index()
	{
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		if(!in_array($user['user_type'],['admin','subadmin'])){
			return redirect()->route('profile');
			
		}
		$ProfileplanModel = new ProfileplanModel();
		$data = [
			'page_title' => 'User Management',
			'active_nav_parent' => 'user-management',
			'active_nav' => 'user-management',
			'profilePlanList'=> $ProfileplanModel->getProfileplanList(['language_code'=>$this->request->getLocale()],'',0,-1,'code ASC')
		];
		
		return view('admin/userManagement/index', $data);
	}

	public function downline($user_id){
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		if(!in_array($user['user_type'],['admin','subadmin'])){
			return redirect()->route('profile');
			
		}
		$data = [
			'page_title' => 'Downline',
			'active_nav_parent' => 'user-management',
			'active_nav' => 'downline'
		];
		$userModel = new UserModel();
		// $data['downline'] = $userModel->downline($user_id);
		$data['user']= $userModel->find($user_id);
		if(empty($data['user'])){
			return redirect()->route('pageNotFound');
		}
		return view('admin/userManagement/downline', $data);

	}

	public function create()
	{
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		if(!in_array($user['user_type'],['admin','subadmin'])){
			return redirect()->route('profile');
			
		}
		$ProfileplanModel = new ProfileplanModel();
		$data = [
			'page_title' => 'User Create',
			'active_nav_parent' => 'user-management',
			'active_nav' => 'user-create',
			'profilePlanList'=> $ProfileplanModel->getProfileplanList(['language_code'=>$this->request->getLocale()],'',0,-1,'code ASC')
		];
		$userModel = new UserModel();

		$referralList = $userModel->select('id,first_name,middle_name,last_name,CONCAT(first_name," ", last_name," (",id, ")") as referral_name')->where('status','1')->findAll();
		$data['referralList'] = $referralList;
		
		return view('admin/userManagement/create', $data);
	}

	public function user($user_id)
	{
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		if(!in_array($user['user_type'],['admin','subadmin'])){
			return redirect()->route('profile');
			
		}
		$ProfileplanModel = new ProfileplanModel();
		$data = [
			'page_title' => 'User Edit',
			'active_nav_parent' => 'user-management',
			'active_nav' => 'user-edit',
			'profilePlanList'=> $ProfileplanModel->getProfileplanList(['language_code'=>$this->request->getLocale()],'',0,-1,'code ASC')
		];
		$userModel = new UserModel();
		$BankUserModel = new BankUserModel();

		$referralList = $userModel->select('id,first_name,middle_name,last_name,CONCAT(first_name," ", last_name," (",id, ")") as referral_name')->where('status','1')->findAll();
		$data['referralList'] = $referralList;
		$user = $userModel->find($user_id);
		$user['referralDetails'] = $userModel->select('id,first_name,middle_name,last_name,CONCAT(first_name," ", last_name," (",id, ")") as referral_name')->find($user['referral_id']);
		$data['user'] = $user;
		
		

		if(empty($data['user'])){
			
			session()->setFlashdata('error','Sorry, User not found.');
			
			return redirect()->route('admin.users');
		}

		$data['userBankDetails'] = $BankUserModel->where('user_id',$user_id)->first();
		//$data['referralDetails'] = $userModel->select('id,first_name,middle_name,last_name,mobile,email,photo')->find($data['user']['referral_id']);
		
		return view('admin/userManagement/edit', $data);
	}

	public function downloadExcelReport(){
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		if(!in_array($user['user_type'],['admin','subadmin'])){
			return redirect()->route('profile');
		}

		// header('Content-type: application/excel;charset=UTF-8');
		header('Content-type: application/octet-stream');
		$filename = 'user_report'.date('ymd_h_i').'.xls';
		header('Content-Disposition: attachment; filename='.$filename);


		
		$db = \Config\Database::connect();
		$builder = $db->table('users');

		$model = new UserModel();
		//$builder = $model->builder();
		$recordsTotal = $builder->countAllResults();
		$recordsFiltered = $recordsTotal;


		if(isset($_POST['filter'])){
			$filter = json_decode($_POST['filter'],true);
			
			if(isset($filter['profile_plan'])){
				if(!empty($filter['profile_plan'])){

					$builder->whereIn('profile_plan',$filter['profile_plan']);

				}
			}

			if(isset($filter['date1']) && isset($filter['date2'])){
				if(!empty($filter['date1']) && !empty($filter['date2'])){

					$date1 = getMysqlDateFormat($filter['date1']);
					$date2 = getMysqlDateFormat($filter['date2']);
					$builder->where("joining_date BETWEEN '$date1' AND '$date2'");
				}
			}

			if(isset($filter['status'])){
				if(strlen(trim($filter['status']))>0){

					$builder->where("status",$filter['status']);
				}
			}

			if(isset($filter['referral_id'])){
				if(strlen(trim($filter['referral_id']))>0){

					$builder->like("referral_id",$filter['referral_id']);
				}
			}


		}

		
		$builder->select('id AS "Profile ID", first_name AS "First Name", last_name AS "Last Name", DATE_FORMAT(dob, "%d-%b-%Y") as "DOB",gender AS Gender, marital_status AS "Marital Status", referral_id AS "Referral ID", mobile AS "Mobile", profile_plan AS "Profile Plan", DATE_FORMAT(joining_date, "%d-%b-%Y") as "Joining Date",joining_mode AS "Joining Mode", address1 AS "Address Line 1", address2 AS "Address Line 2", city AS "City", state AS "State", pincode AS "Pin Code", if(status="1","Active","Inactive") AS "Status"');
		// $builder->select('id');
		
		if (!empty($iSearch_str)) {
			$builder->where("($iSearch_str)");
		} 
		$countbuilder = clone($builder);
		// $builder->limit($length, $start);
		$sql ='';
		// $sql = $builder->getCompiledSelect();
		$query   = $builder->get();
		
		
		$users = $query->getResultArray();
		// $recordsFiltered = $countbuilder->countAllResults();
		// print_r($users);die;
		$data['list']=$users;
		return view('admin/userManagement/excelReportTemplate',$data);
		
	}

	public function upgradeMemberProfilePlan($user_id='')
	{
		$data = [
			'page_title' => 'Upgrade member profile plan',
			'active_nav_parent' => 'user-management',
			'active_nav' => 'user-upgrage-profile-plan',
		];

		/*
			Upgrade to P5, require directmembers with P4 > 4.
			Upgrade to P4, require join 9 directmembers within 90 days from joining date 
			Upgrade to P3, require join 6 directmembers within 60 days from joining date 
			Upgrade to P2, require join 3 directmembers within 30 days from joining date 
       */

		$model = new UserMembershipProductModel();
        $UserModel = new UserModel();
		$list = [];

		function canUpgradeProfilePlan($plan_old,$plan_new){

			$profilePlanRank = [
				"P1"=>1,
				"P2"=>2,
				"P3"=>3,
				"P4"=>4,
				"P5"=>5,
			];

			return $profilePlanRank[$plan_old] < $profilePlanRank[$plan_new];

		};

		
		foreach($model->get_referralList_profile_plan_upgrade($user_id,$onlyEligibal=true) as $item){
			$item['remark'] ="";
			$oldPlan = $item['profile_plan'];
			if((int)$item['member_count_for_upgrade_to_p5']>=4 && canUpgradeProfilePlan($oldPlan,"P5")){
				$item['upgrade_to'] = 'P5';
				if($this->upgradeProfilePlan($item['referral_id'],['profile_plan'=>'P5'])){
					$item['remark'] ="Upgraded from $oldPlan to P5";
				}
				
			}else if((int)$item['member_count_for_upgrade_to_p4']>=9 && canUpgradeProfilePlan($oldPlan,"P4")){
				$item['upgrade_to'] = 'P4';
				if($this->upgradeProfilePlan($item['referral_id'],['profile_plan'=>'P4'])){
					$item['remark'] ="Upgraded from $oldPlan to P4";
				}
			}else if((int)$item['member_count_for_upgrade_to_p3']>=6 && canUpgradeProfilePlan($oldPlan,"P3")){
				$item['upgrade_to'] = 'P3';
				if($this->upgradeProfilePlan($item['referral_id'],['profile_plan'=>'P3'])){
					$item['remark'] ="Upgraded from $oldPlan to P3";
				}
			}else if((int)$item['member_count_for_upgrade_to_p2']>=3 && canUpgradeProfilePlan($oldPlan,"P2")){
				$item['upgrade_to'] = 'P2';
				if($this->upgradeProfilePlan($item['referral_id'],['profile_plan'=>'P2'])){
					$item['remark'] ="Upgraded from $oldPlan to P2";
				}
			}else{
				$item['upgrade_to'] = '';
			}
			$item['directMemberCount'] = $UserModel->getDirectMemberCount($item['referral_id']);
			$list[] = $item;
		}

		$data['list'] = $list;
		return view('admin/userManagement/member_upgrade_profile_plan', $data);
		
	}

		public function upgradeProfilePlan($user_id,$requestData){
			$UserModel = new UserModel();
			$userData = $UserModel->find($user_id);
			$userDataOld = $userData;
			$userData['profile_plan'] = $requestData['profile_plan'];

			if ($UserModel->save($userData)) {
				//action log
				$changed_data = array_diff_assoc_recursive((array)$requestData, (array)$userDataOld);

				if (!empty($changed_data)) {
					$actionLogData = [
						'user_id' => $userData['id'],
						'action_type' => 'updated',
						'model' => 'user',
						'record_id' => $user_id,
						'chaged_data' => json_encode($changed_data)
					];
					creatActionLog($actionLogData);
				}
				return true;
			}
			return false;
		}


	public function shareDistribution($user_id='')
	{
		$data = [
			'page_title' => 'Distribution',
			'active_nav_parent' => 'user-management',
			'active_nav' => 'user-distribution',
		];
		
		$model = new UserMembershipProductModel();
		$UserModel = new UserModel();
		$filter = ['status'=>'','from_dt'=>'','to_dt'=>''];
		if($this->request->getGet()){
			
			$filter['status'] = $this->request->getVar('sr_status');//pending,distributed
			$filter['from_dt'] = $this->request->getVar('sr_date1');//pending,distributed
			$filter['to_dt'] = $this->request->getVar('sr_date2');//pending,distributed

		}

		
		$list =$model->getMembershipProductList($user_id, $filter);

		
	
		$data['filter'] = $filter;
		$data['list'] = $list;
		if($this->request->getGet()){
			if($this->request->getVar('submit-type')=='Download Report'){
				// header('Content-type: application/excel;charset=UTF-8');
				header('Content-type: application/octet-stream');
				$filename = 'distribution_report'.date('ymd_h_i').'.xls';
				header('Content-Disposition: attachment; filename='.$filename);
				$data['skipCol'] = ['id','product_image_url'];
				return view('admin/userManagement/excelReportTemplate',$data);
			}
		}

		return view('admin/userManagement/share_distribution', $data);
		
	}

	

}
