<?php

namespace App\Controllers\api;


use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\UserRoleModel;
// use Exception;
// use Firebase\JWT\JWT;
use App\Controllers;

class UserManagement extends  Controllers\BaseController
{
	use ResponseTrait;

	public function index($user_id = '')
	{

		$user = checkUserToken();

		if (!$user) {
			return $this->fail(['messages' => 'Please login.'], 400);
		}

		if(!hasCapability('user/view')){
			return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
		}

		//check admin
		// if (!isAdmin($user)) {
		// 	return $this->fail(['messages' => 'Access is denied'], 400);
		// }

		$draw = (int)$this->request->getVar('draw');
		$start = (int)$this->request->getVar('start');
		$length = (int)$this->request->getVar('length');
		$db = \Config\Database::connect();
		$builder = $db->table('users');

		$model = new UserModel();
		//$builder = $model->builder();
		$recordsTotal = $builder->countAllResults();
		$recordsFiltered = $recordsTotal;

		if (!empty($user_id)) {
			$userDetails = $model->getUserdetails($user_id);
			//$referralDetails = $model->select('id,first_name,middle_name,last_name,mobile,email,photo')->find($user['referral_id']);

			// $BankUserModel = new BankUserModel();
			// $userBankDetails = $BankUserModel->where('user_id', $user['id'])->first();

			if ($userDetails) {
				//Respond with 200 status code
				return $this->respond($userDetails);
			} else {
				//Respond with 200 status code
				return $this->fail(['message' => 'User details not found.']);
			}
		}

		$iSearch = [];
		$searchKey = $_POST['search'];
		$columns = $_POST['columns'];
		if (!empty($searchKey['value'])) {
			foreach ($columns as $row) {
				if (!empty($row['data'])) {

					$iSearch[] = " " . $row['data'] . " LIKE '%" . $searchKey['value'] . "%' ";
				}
			}
		}

		$order = $_POST['order'];

		$iSearch_str = implode(' OR ', $iSearch);

		if (isset($_POST['filter'])) {
			$filter = $_POST['filter'];
			// if (isset($filter['profile_plan'])) {
			// 	$builder->whereIn('profile_plan', $filter['profile_plan']);
			// }

			// if (isset($filter['date1']) && isset($filter['date2'])) {
			// 	if (!empty($filter['date1']) && !empty($filter['date2'])) {

			// 		$date1 = getMysqlDateFormat($filter['date1']);
			// 		$date2 = getMysqlDateFormat($filter['date2']);
			// 		$builder->where("joining_date BETWEEN '$date1' AND '$date2'");
			// 	}
			// }

			if (isset($filter['status'])) {
				if (strlen(trim($filter['status'])) > 0) {

					$builder->where("status", $filter['status']);
				}
			}

			// if (isset($filter['referral_id'])) {
			// 	if (strlen(trim($filter['referral_id'])) > 0) {

			// 		$builder->like("referral_id", $filter['referral_id']);
			// 	}
			// }
		}

		$builder->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir']);
		$builder->select('*');

		if (!empty($iSearch_str)) {
			$builder->where("($iSearch_str)");
		}
		$countbuilder = clone ($builder);
		$builder->limit($length, $start);
		$sql = '';
		// $sql = $builder->getCompiledSelect();
		$query   = $builder->get();


		$users = $query->getResultArray();
		$recordsFiltered = $countbuilder->countAllResults();




		//Respond with 200 status code
		return $this->respond(['recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $users, 'sql' => $sql]);
	}

	public function create()
	{

		
		if ($this->request->getMethod() === 'post') {
			
			$user = checkUserToken();
			if(!hasCapability('user/add')){
				return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
			}

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}

			//check admin
			// if (!isAdmin($user)) {
			// 	return $this->fail(['messages' => 'Access is denied'], 400);
			// }

			$requestData = (array) $this->request->getJSON();


			$allowedColums = [
				'id' => '',
				'fname' => '',
				'lname' => '',
				'mobile' => '',
				'email' => '',
				'password' => '',
				'selected_role' => '',
				'status' => '',
			];
			$requestData = array_intersect_key($requestData, $allowedColums);

			//$requestData['referral_id'] = isset($requestData['referral_id']) ? $requestData['referral_id'] : '100000';

			$validation =  \Config\Services::validation();

			$rules = [
				'fname' => 'required',
				'lname' => 'required',
				'password' => 'required',
				'mobile' => 'required|numeric|exact_length[10]',
				'email' => 'trim|required|valid_email|is_unique[users.email,id,{id}]',
			];

			


			$validation->setRules(
				$rules,
				[   // Errors
					'fname' => [
						'required' => "First name can not be empty."
					],
					'lname' => [
						'required' => "Last name can not be empty."
					],
					'password' => [
						'required' => "Password can not be empty."
					],
					'mobile' => [
						'required' => "Mobile can not be empty.",
						'exact_length' => "Enter valid mobile number.",
						'numeric' => "Enter only numbers."
					],
					'email' => [
						'required' => "Email can not be empty.",
						'valid_email' => "Enter valid email.",
						'is_unique' => "This email is already in use, try with different email."
					],
				

				]
			);

			$valid = $validation->run($requestData);
			if (!$valid) {

				return $this->fail($validation->getErrors(), 400);
			}

			
			// if (isset($requestData['dob'])) {

			// 	if ($requestData['dob'] != '') {
			// 		$requestData['dob'] = date('Y-m-d', strtotime($requestData['dob']));
			// 	}
			// }
			// if (isset($requestData['user_type'])) {

			// 	if ($requestData['user_type'] != '') {
			// 		$requestData['user_type'] = 'user';
			// 	}
			// }

			$model = new UserModel();
			//encrypt password
			$requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);
			$user_id = $model->insert($requestData);

			$userRoles = new UserRoleModel();
			foreach($requestData['selected_role'] as $role){
				$role = (array)$role;
				$userRoles->insert(['user_id'=>$user_id, 'role_id'=>$role['id']]);
			}

			//action log
			$changed_data = $requestData;

			if (!empty($changed_data)) {
				$actionLogData = [
					'user_id' => $user['id'],
					'action_type' => 'created',
					'model' => 'user',
					'record_id' => $user_id,
					'chaged_data' => json_encode($changed_data)
				];
				creatActionLog($actionLogData);
			}
			$user = $model->find($user_id);

			session()->setFlashdata('success', 'User created.');
			//Respond with 200 status code
			return $this->respond(['success' => 'User created', 'user_id' => $user_id]);
		}
	}

	public function editUser($user_id){
		$user = checkUserToken();
		if(!hasCapability('user/edit')){
			return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
		}
			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}
			$model = new UserModel();
			$userRoles = new UserRoleModel();
			$user = $model->find($user_id);
			
			$selectedRole = $userRoles->getSelectedRole($user_id);
			
			$user['selected_role'] = $selectedRole;
			return $this->respond($user);

	}

	public function update()
	{

		
		if(!hasCapability('user/update')){
			return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
		}
			$user = checkUserToken();

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}

			//check admin
			// if (!isAdmin($user)) {
			// 	return $this->fail(['messages' => 'Access is denied'], 400);
			// }

			$requestData = (array) $this->request->getJSON();


			$allowedColums = [
				'id' => '',
				'fname' => '',
				'lname' => '',
				'mobile' => '',
				'email' => '',
				'password' => '',
				'selected_role' => '',
				'status' => '',
				'changePassword' => '',
			];
			$requestData = array_intersect_key($requestData, $allowedColums);

			//$requestData['referral_id'] = isset($requestData['referral_id']) ? $requestData['referral_id'] : '100000';

			$validation =  \Config\Services::validation();

			$rules = [
				'fname' => 'required',
				'lname' => 'required',
				'mobile' => 'required|numeric|exact_length[10]',
				'email' => 'trim|required|valid_email|is_unique[users.email,id,{id}]',
			];

			if($requestData['changePassword']){
				$rules['password'] = 'required';
				$requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);
			}else{
				unset($requestData['password']);
			}

			$user_id = $requestData['id'];


			$validation->setRules(
				$rules,
				[   // Errors
					'fname' => [
						'required' => "First name can not be empty."
					],
					'lname' => [
						'required' => "Last name can not be empty."
					],
					'password' => [
						'required' => "Password can not be empty."
					],
					'mobile' => [
						'required' => "Mobile can not be empty.",
						'exact_length' => "Enter valid mobile number.",
						'numeric' => "Enter only numbers."
					],
					'email' => [
						'required' => "Email can not be empty.",
						'valid_email' => "Enter valid email.",
						'is_unique' => "This email is already in use, try with different email."
					],
				

				]
			);

			$valid = $validation->run($requestData);
			if (!$valid) {

				return $this->fail($validation->getErrors(), 400);
			}

			
			// if (isset($requestData['dob'])) {

			// 	if ($requestData['dob'] != '') {
			// 		$requestData['dob'] = date('Y-m-d', strtotime($requestData['dob']));
			// 	}
			// }
			// if (isset($requestData['user_type'])) {

			// 	if ($requestData['user_type'] != '') {
			// 		$requestData['user_type'] = 'user';
			// 	}
			// }

			$model = new UserModel();
			//encrypt password
			
			$model->save($requestData);

			$userRoles = new UserRoleModel();
			//delete old roles
			$userRoles->where('user_id',$user_id)->delete();
			foreach($requestData['selected_role'] as $role){
				$role = (array)$role;
				
				$userRoles->insert(['user_id'=>$user_id, 'role_id'=>$role['id']]);
			}

			//action log
			$changed_data = $requestData;

			if (!empty($changed_data)) {
				$actionLogData = [
					'user_id' => $user['id'],
					'action_type' => 'update',
					'model' => 'user',
					'record_id' => $user_id,
					'chaged_data' => json_encode($changed_data)
				];
				creatActionLog($actionLogData);
			}
			$user = $model->find($user_id);

			session()->setFlashdata('success', 'Successfully updated.');
			//Respond with 200 status code
			return $this->respond(['success' => 'Successfully updated']);
		
	}


}
