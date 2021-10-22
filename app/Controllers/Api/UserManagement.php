<?php

namespace App\Controllers\api;


use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\UserMembershipProductModel;
use App\Models\BankUserModel;
use App\Models\WalletModel;
use App\Models\ProfileplanModel;
use App\Models\DistributionHistory;
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

		//check admin
		if (!isAdmin($user)) {
			return $this->fail(['messages' => 'Access is denied'], 400);
		}

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
			if (isset($filter['profile_plan'])) {
				$builder->whereIn('profile_plan', $filter['profile_plan']);
			}

			if (isset($filter['date1']) && isset($filter['date2'])) {
				if (!empty($filter['date1']) && !empty($filter['date2'])) {

					$date1 = getMysqlDateFormat($filter['date1']);
					$date2 = getMysqlDateFormat($filter['date2']);
					$builder->where("joining_date BETWEEN '$date1' AND '$date2'");
				}
			}

			if (isset($filter['status'])) {
				if (strlen(trim($filter['status'])) > 0) {

					$builder->where("status", $filter['status']);
				}
			}
			if (isset($filter['referral_id'])) {
				if (strlen(trim($filter['referral_id'])) > 0) {

					$builder->like("referral_id", $filter['referral_id']);
				}
			}
		}

		$builder->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir']);
		$builder->select('*,DATE_FORMAT(joining_date, "'.SITE_DATE_FORMAT_SQL.'") as joining_date');

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


	public function downline($user_id = '')
	{

		$user = checkUserToken();

		if (!$user) {
			return $this->fail(['messages' => 'Please login.'], 400);
		}

		//check admin 
		// if (!isAdmin($user)) {
		// 	return $this->fail(['messages' => 'Access is denied'], 400);
		// }

		$model = new UserModel();



		$downline = $model->downline($user_id);
		//$userDetails = $model->find($user_id);

		// if(empty($downline)){
		// 	$downline = [['text'=>'Downline is empty.','disabled'=>true]];
		// }
		//Respond with 200 status code
		return $this->respond($downline);
	}

	public function create()
	{



		if ($this->request->getMethod() === 'post') {

			$user = checkUserToken();

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}

			//check admin
			if (!isAdmin($user)) {
				return $this->fail(['messages' => 'Access is denied'], 400);
			}

			$requestData = (array) $this->request->getJSON();



			$allowedColums = [
				'id' => '',
				'first_name' => '',
				'middle_name' => '',
				'last_name' => '',
				'mobile' => '',
				'email' => '',
				'dob' => '',
				'gender' => '',
				'marital_status' => '',
				'other_phone_no' => '',
				'joining_date' => '',
				'joining_mode' => '',
				'profile_plan' => '',
				'referral_id' => '',
				'user_type' => '',
				'status' => '',
			];
			$requestData = array_intersect_key($requestData, $allowedColums);

			$requestData['referral_id'] = isset($requestData['referral_id']) ? $requestData['referral_id'] : '100000';

			$validation =  \Config\Services::validation();

			$rules = [
				'first_name' => 'required',
				'last_name' => 'required',
				'mobile' => 'required|numeric|exact_length[10]|is_unique[users.mobile,id,{id}]',
				'referral_id' => 'numeric|is_not_unique[users.id,id,{referral_id}]',

			];

			if (isset($requestData['email'])) {
				if ($requestData['email']) {
					$rules['email'] = 'trim|valid_email|is_unique[users.email,id,{id}]';
				}
			}
			if (isset($requestData['other_phone_no'])) {
				if (!empty(trim($requestData['other_phone_no']))) {
					$rules['other_phone_no'] = 'numeric';
				}
			}


			$validation->setRules(
				$rules,
				[   // Errors
					'first_name' => [
						'required' => lang('profile.personal.firstName.errorRequired')
					],
					'middle_name' => [
						'required' => lang('profile.personal.middleName.errorRequired')
					],
					'last_name' => [
						'required' => lang('profile.personal.lastName.errorRequired')
					],
					'mobile' => [
						'required' => lang('forms.register.mobile.errorRequired'),
						'exact_length' => lang('forms.register.mobile.errorMinlength'),
						'is_unique' => lang('forms.register.mobile.errorUnique'),
						'numeric' => lang('forms.register.mobile.errorNumeric')
					],
					'other_phone_no' => [

						'numeric' => lang('forms.register.mobile.errorNumeric')
					],

					'email' => [
						'required' => lang('forms.register.emailAddress.errorRequired'),
						'valid_email' => lang('forms.register.emailAddress.errorEmail'),
						'is_unique' => lang('forms.register.emailAddress.errorUnique')
					],
					'referral_id' => [

						'is_not_unique' => lang('forms.register.referralId.errorNotExist'),
						'numeric' => lang('forms.register.referralId.errorNumeric')
					],

				]
			);

			$valid = $validation->run($requestData);
			if (!$valid) {

				return $this->fail($validation->getErrors(), 400);
			}


			if (isset($requestData['joining_date'])) {

				if ($requestData['joining_date'] != '') {
					$requestData['joining_date'] = date('Y-m-d', strtotime($requestData['joining_date']));
				}
			} else {
				$requestData['joining_date'] = date('Y-m-d');
			}

			if (isset($requestData['dob'])) {

				if ($requestData['dob'] != '') {
					$requestData['dob'] = date('Y-m-d', strtotime($requestData['dob']));
				}
			}
			if (isset($requestData['user_type'])) {

				if ($requestData['user_type'] != '') {
					$requestData['user_type'] = 'user';
				}
			}

			$model = new UserModel();
			$user_id = $model->insert($requestData);
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

	public function personalDetails($user_id)
	{

		if ($this->request->getMethod() === 'post') {

			$user = checkUserToken();

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}

			//check admin
			if (!isAdmin($user)) {
				return $this->fail(['messages' => 'Access is denied'], 400);
			}

			$requestData = (array) $this->request->getJSON();

			$requestData['id'] = $user_id;

			$allowedColums = [
				'id' => '',
				'first_name' => '',
				'middle_name' => '',
				'last_name' => '',
				'mobile' => '',
				'email' => '',
				'dob' => '',
				'gender' => '',
				'marital_status' => '',
				'other_phone_no' => '',
				'joining_date' => '',
				'joining_mode' => '',
				'profile_plan' => '',
				'referral_id' => '',
				'user_type' => '',
				'status' => '',
			];
			$requestData = array_intersect_key($requestData, $allowedColums);

			//	$requestData['referral_id'] = isset($requestData['referral_id']) ? $requestData['referral_id'] : '100000';

			$validation =  \Config\Services::validation();

			$rules = [];
			if (isset($requestData['referral_id'])) {

				$rules['referral_id'] =  'numeric|is_not_unique[users.id,id,{referral_id}]';
			}
			if (isset($requestData['mobile'])) {

				$rules['mobile'] = 'required|numeric|exact_length[10]|is_unique[users.mobile,id,{id}]';
			}
			if (isset($requestData['last_name'])) {

				$rules['last_name'] = 'required';
			}
			if (isset($requestData['first_name'])) {

				$rules['first_name'] = 'required';
			}

			if (isset($requestData['email'])) {
				if (!empty(trim($requestData['email']))) {
					$rules['email'] = 'trim|valid_email|is_unique[users.email,id,{id}]';
				}
			}

			if (isset($requestData['other_phone_no'])) {
				if (!empty(trim($requestData['other_phone_no']))) {
					$rules['other_phone_no'] = 'numeric';
				}
			}

			$validation->setRules(
				$rules,
				[   // Errors
					'first_name' => [
						'required' => lang('profile.personal.firstName.errorRequired')
					],
					'middle_name' => [
						'required' => lang('profile.personal.middleName.errorRequired')
					],
					'last_name' => [
						'required' => lang('profile.personal.lastName.errorRequired')
					],
					'mobile' => [
						'required' => lang('forms.register.mobile.errorRequired'),
						'exact_length' => lang('forms.register.mobile.errorMinlength'),
						'is_unique' => lang('forms.register.mobile.errorUnique'),
						'numeric' => lang('forms.register.mobile.errorNumeric')
					],

					'email' => [
						'required' => lang('profile.personal.emailAddress.errorRequired'),
						'valid_email' => lang('profile.personal.emailAddress.errorEmail'),
						'is_unique' => lang('profile.personal.emailAddress.errorUnique')
					],
					'referral_id' => [

						'is_not_unique' => lang('forms.register.referralId.errorNotExist'),
						'numeric' => lang('forms.register.referralId.errorNumeric')
					],

				]
			);


			$valid = $validation->run($requestData);
			if (!$valid && !empty($rules)) {

				return $this->fail($validation->getErrors(), 400);
			}


			if (isset($requestData['joining_date'])) {

				if ($requestData['joining_date'] != '') {
					$requestData['joining_date'] = date('Y-m-d', strtotime($requestData['joining_date']));
				}
			}

			if (isset($requestData['dob'])) {

				if ($requestData['dob'] != '') {
					$requestData['dob'] = date('Y-m-d', strtotime($requestData['dob']));
				}
			}
			if (isset($requestData['user_type'])) {

				if ($requestData['user_type'] != '') {
					$requestData['user_type'] = 'user';
				}
			}


			$model = new UserModel();
			$userDetails =  $model->find($user_id);
			$model->save($requestData);
			//action log
			$changed_data = array_diff_assoc((array)$requestData, (array)$userDetails);

			if (!empty($changed_data)) {
				$actionLogData = [
					'user_id' => $user['id'],
					'action_type' => 'updated',
					'model' => 'user',
					'record_id' => $user_id,
					'chaged_data' => json_encode($changed_data)
				];
				creatActionLog($actionLogData);
			}
			//$userDetails = $model->find($requestData['id']);



			//Respond with 200 status code
			return $this->respond(['success' => lang('profile.personal.success'), 'requestData' => $requestData]);
		}
	}

	public function bankDetails($user_id)
	{
		helper('form');
		if ($this->request->getMethod() === 'post') {

			$user = checkUserToken();

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}
			//check admin
			if (!isAdmin($user)) {
				return $this->fail(['messages' => 'Access is denied'], 400);
			}
			$file = $this->request->getFile('photo_proof');

			$BankUserModel = new BankUserModel();
			$userBankDetails = $BankUserModel->where('user_id', $user_id)->first();
			$userBankDetails_old = $userBankDetails;
			$rules = [];
			if (isset($_POST['bank_name'])) {
				$rules['bank_name'] = 'required';
				$userBankDetails['bank_name'] = $this->request->getVar('bank_name');
			}
			if (isset($_POST['account_name'])) {
				$rules['account_name'] = 'required';
				$userBankDetails['account_name'] = $this->request->getVar('account_name');
			}
			if (isset($_POST['account_no'])) {
				$rules['account_no'] = 'required';
				$userBankDetails['account_no'] = $this->request->getVar('account_no');
			}
			if (isset($_POST['ifsc_code'])) {
				$rules['ifsc_code'] = 'required';
				$userBankDetails['ifsc_code'] = $this->request->getVar('ifsc_code');
			}

			if ($file) {
				$rules['photo_proof'] = 'uploaded[photo_proof]|max_size[photo_proof,1024]|mime_in[photo_proof,image/png,image/jpg,image/jpeg,image/bmp,application/pdf]';
			}

			$validation =  \Config\Services::validation();



			$validation->setRules(
				$rules,
				[   // Errors
					'bank_name' => [
						'required' => lang('profile.bank.bankName.errorRequired')
					],
					'account_name' => [
						'required' => lang('profile.bank.accountName.errorRequired')
					],
					'account_no' => [
						'required' => lang('profile.bank.accountNumber.errorRequired')
					],
					'ifsc_code' => [
						'required' => lang('profile.bank.ifsc.errorRequired')
					],
					'photo_proof' => [
						'max_size' => lang('profile.bank.photoProof.errorValid'),
						'mime_in' => lang('profile.bank.photoProof.errorValid'),
					],

				]
			);
			// if (!$this->validate($rules)) {
			// 	return $this->fail($this->validator->getErrors());
			// }

			$valid = $validation->withRequest($this->request)->run();
			if (!$valid) {
				return $this->fail($validation->getErrors(), 400);
			}



			if ($file) {
				$newName = $file->getRandomName();
				$filePath = 'public/uploads/user_kyc';
				$fileUrl = '';
				if ($file->move(ROOTPATH . $filePath, $newName)) {
					$fileUrl = base_url($filePath . '/' . $newName);
				}

				$UserModel = new UserModel();

				$userBankDetails['photo_proof'] = $fileUrl;
			}


			$userBankDetails['user_id'] = $user_id;


			$BankUserModel->save($userBankDetails);
			//action log
			$changed_data = array_diff_assoc_recursive((array)$userBankDetails, (array)$userBankDetails_old);

			if (!empty($changed_data)) {
				$actionLogData = [
					'user_id' => $user['id'],
					'action_type' => 'updated',
					'model' => 'user',
					'record_id' => $user_id,
					'chaged_data' => json_encode($changed_data)
				];
				creatActionLog($actionLogData);
			}
			$userBankDetails = $BankUserModel->where('user_id', $user_id)->first();

			//Respond with 200 status code
			return $this->respond(['success' => lang('profile.bank.success'), 'url' => $userBankDetails['photo_proof']]);
		}
	}

	public function nomineeDetails($user_id)
	{

		if ($this->request->getMethod() === 'post') {

			$user = checkUserToken();

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}

			//check admin
			if (!isAdmin($user)) {
				return $this->fail(['messages' => 'Access is denied'], 400);
			}


			$requestData = (array) $this->request->getJSON();

			$allowedColums = [
				'nominee_name' => '',
				'nominee_relation' => '',
				'nominee_mobile' => '',
				'nominee_address' => '',
			];
			$requestData = array_intersect_key($requestData, $allowedColums);


			$validation =  \Config\Services::validation();

			$rules = [];

			if (isset($requestData['nominee_name'])) {
				$rules['nominee_name'] = 'required';
			}
			if (isset($requestData['nominee_relation'])) {
				$rules['nominee_relation'] = 'required';
			}
			if (isset($requestData['nominee_mobile'])) {
				$rules['nominee_mobile'] = 'required|numeric|exact_length[10]';
			}
			if (isset($requestData['nominee_address'])) {
				$rules['nominee_address'] = 'required';
			}

			$validation->setRules($rules);

			$validation->setRules(
				$rules,
				[   // Errors
					'nominee_name' => [
						'required' => lang('profile.nominee.nomineeName.errorRequired')
					],
					'nominee_relation' => [
						'required' => lang('profile.nominee.nomineeRelation.errorRequired')
					],
					'nominee_mobile' => [
						'required' => lang('profile.nominee.nomineeMobile.errorRequired'),
						'numeric' => lang('profile.nominee.nomineeMobile.errorNumeric'),
						'exact_length' => lang('profile.nominee.nomineeMobile.errorMinlength')
					],
					'nominee_address' => [
						'required' => lang('profile.nominee.nomineeAddress.errorRequired'),
					]

				]
			);

			$valid = $validation->run($requestData);
			if (!$valid) {
				return $this->fail($validation->getErrors(), 400);
			}

			$UserModel = new UserModel();
			$userData = $UserModel->find($user_id);
			$requestData['id'] = $user_id;

			$UserModel->save($requestData);
			//action log
			$changed_data = array_diff_assoc_recursive((array)$requestData, (array)$userData);

			if (!empty($changed_data)) {
				$actionLogData = [
					'user_id' => $user['id'],
					'action_type' => 'updated',
					'model' => 'user',
					'record_id' => $user_id,
					'chaged_data' => json_encode($changed_data)
				];
				creatActionLog($actionLogData);
			}

			//Respond with 200 status code
			return $this->respond(['success' => lang('profile.nominee.success')]);
		}
	}

	public function addressDetails($user_id)
	{

		if ($this->request->getMethod() === 'post') {

			$user = checkUserToken();

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}

			//check admin
			if (!isAdmin($user)) {
				return $this->fail(['messages' => 'Access is denied'], 400);
			}

			$requestData = (array) $this->request->getJSON();

			$allowedColums = [
				'address1' => '',
				'address2' => '',
				'city' => '',
				'pincode' => '',
				'state' => '',
				'country' => '',
			];
			$requestData = array_diff_assoc_recursive((array)$requestData,  (array)$allowedColums);


			$validation =  \Config\Services::validation();

			$rules = [];

			if (isset($requestData['address1'])) {
				$rules['address1'] = 'required';
			}
			if (isset($requestData['city'])) {
				$rules['city'] = 'required';
			}
			if (isset($requestData['pincode'])) {
				$rules['pincode'] = 'required';
			}
			if (isset($requestData['state'])) {
				$rules['state'] = 'required';
			}
			if (isset($requestData['country'])) {
				$rules['country'] = 'required';
			}

			$validation->setRules($rules);

			$validation->setRules(
				$rules,
				[   // Errors
					'address1' => [
						'required' => lang('profile.address.addressLine1.errorRequired')
					],
					'city' => [
						'required' => lang('profile.address.city.errorRequired')
					],
					'pincode' => [
						'required' => lang('profile.address.pincode.errorRequired')
					],
					'state' => [
						'required' => lang('profile.address.state.errorRequired'),
					],
					'country' => [
						'required' => lang('profile.address.country.errorRequired'),
					]

				]
			);

			$valid = $validation->run($requestData);
			if (!$valid) {
				return $this->fail($validation->getErrors(), 400);
			}


			$UserModel = new UserModel();
			$userData = $UserModel->find($user_id);
			$requestData['id'] = $user_id;

			if ($UserModel->save($requestData)) {
				//action log
				$changed_data = array_diff_assoc_recursive((array)$requestData, (array)$userData);

				if (!empty($changed_data)) {
					$actionLogData = [
						'user_id' => $user['id'],
						'action_type' => 'updated',
						'model' => 'user',
						'record_id' => $user_id,
						'chaged_data' => json_encode($changed_data)
					];
					creatActionLog($actionLogData);
				}

				//Respond with 200 status code
				return $this->respond(['success' => lang('profile.address.success')]);
			}
		}

		return $this->fail(['messages' => 'error'], 400);
	}

	public function uploadKyc($user_id)
	{
		$user = checkUserToken();

		if (!$user) {
			return $this->fail(['messages' => 'Please login.'], 400);
		}

		//check admin
		if (!isAdmin($user)) {
			return $this->fail(['messages' => 'Access is denied'], 400);
		}

		helper('form');


		if ($this->request->getVar('kyc_name') == 'pan') {
			$file = $this->request->getFile('pan_id_proof');

			$allowedColums = [
				'pan_no' => '',
				'pan_id_proof' => ''
			];
			$rules = [
				'pan_no' => 'required|alpha_numeric|exact_length[10]',
				'pan_id_proof' => 'uploaded[pan_id_proof]|max_size[pan_id_proof,1024]|mime_in[pan_id_proof,image/png,image/jpg,image/jpeg,image/bmp,application/pdf]'
			];



			$validation =  \Config\Services::validation();



			$validation->setRules(
				$rules,
				[   // Errors
					'pan_no' => [
						'required' => lang('profile.kyc.panNumber.errorRequired'),
						'exact_length' => lang('profile.kyc.panNumber.errorValid')
					],

					'pan_id_proof' => [
						'max_size' => lang('profile.kyc.panIdProof.errorValid'),
						'mime_in' => lang('profile.kyc.panIdProof.errorValid'),
						'uploaded' => lang('profile.kyc.panIdProof.errorValid'),
					],

				]
			);


			$valid = $validation->withRequest($this->request)->run();
			if (!$valid) {
				return $this->fail($validation->getErrors(), 400);
			}



			if ($file->isValid()) {
				$newName = $file->getRandomName();
				$filePath = 'public/uploads/user_kyc';
				$fileUrl = '';
				if ($file->move(ROOTPATH . $filePath, $newName)) {
					$fileUrl = base_url($filePath . '/' . $newName);
				}

				$UserModel = new UserModel();
				$userDetails = $UserModel->find($user_id);
				$requestData = [];
				$requestData['pan_no'] = $this->request->getVar('pan_no');
				$requestData['pan_id_proof'] = $fileUrl;
				$requestData['id'] = $user_id;
				$UserModel->save($requestData);

				//action log
				$changed_data = array_diff_assoc_recursive((array)$requestData, (array)$userDetails);

				if (!empty($changed_data)) {
					$actionLogData = [
						'user_id' => $user['id'],
						'action_type' => 'updated',
						'model' => 'user',
						'record_id' => $user_id,
						'chaged_data' => json_encode($changed_data)
					];
					creatActionLog($actionLogData);
				}

				$userDetails = $UserModel->where('id', $user_id)->first();
				return $this->respond(['success' => lang('profile.kyc.panSuccess'), 'url' => $fileUrl]);
			}
		}
		if ($this->request->getVar('kyc_name') == 'aadhar') {
			$file = $this->request->getFile('aadhar_id_proof');

			$allowedColums = [
				'aadhar_no' => '',
				'aadhar_id_proof' => ''
			];
			$rules = [
				'aadhar_no' => 'required|numeric|exact_length[12]',
				'aadhar_id_proof' => 'uploaded[aadhar_id_proof]|max_size[aadhar_id_proof,1024]|mime_in[aadhar_id_proof,image/png,image/jpg,image/jpeg,image/bmp,application/pdf]'
			];


			$validation =  \Config\Services::validation();



			$validation->setRules(
				$rules,
				[   // Errors
					'aadhar_no' => [
						'required' => lang('profile.kyc.aadharNumber.errorRequired'),
						'exact_length' => lang('profile.kyc.aadharNumber.errorValid')
					],

					'aadhar_id_proof' => [
						'max_size' => lang('profile.kyc.aadharIdProof.errorValid'),
						'mime_in' => lang('profile.kyc.aadharIdProof.errorValid'),
					],

				]
			);


			$valid = $validation->withRequest($this->request)->run();
			if (!$valid) {
				return $this->fail($validation->getErrors(), 400);
			}

			if ($file->isValid()) {
				$newName = $file->getRandomName();
				$filePath = 'public/uploads/user_kyc';
				$fileUrl = '';
				if ($file->move(ROOTPATH . $filePath, $newName)) {
					$fileUrl = base_url($filePath . '/' . $newName);
				}

				$UserModel = new UserModel();
				$userDetails = $UserModel->find($user_id);
				$requestData = [];

				$requestData['aadhar_no'] = $this->request->getVar('aadhar_no');
				$requestData['aadhar_id_proof'] = $fileUrl;
				$requestData['id'] = $user_id;
				$UserModel->save($requestData);
				//action log
				$changed_data = array_diff_assoc_recursive((array)$requestData, (array)$userDetails);

				if (!empty($changed_data)) {
					$actionLogData = [
						'user_id' => $user['id'],
						'action_type' => 'updated',
						'model' => 'user',
						'record_id' => $user_id,
						'chaged_data' => json_encode($changed_data)
					];
					creatActionLog($actionLogData);
				}

				return $this->respond(['success' => lang('profile.kyc.aadharSuccess'), 'url' => $fileUrl]);
			}
		}
	}

	public function wallet($user_id)
	{
		$user = checkUserToken();

		if (!$user) {
			return $this->fail(['messages' => 'Please login.'], 400);
		}

		//check admin
		if (!isAdmin($user)) {
			return $this->fail(['messages' => 'Access is denied'], 400);
		}


		$WalletModel = new WalletModel();


		return $this->respond($WalletModel->getList(['user_id' => $user_id], '', '', -1, ''));
	}


	public function getUpline($user_id,$isAjax=true)
	{

		$uplineUserIDs = [];
		$uplineUserList = [];
		$UserModel = new UserModel();
		$userDeatils = $UserModel->getUserdetails($user_id);
		$memberDeatils = $userDeatils;
		$productNetPrice = $memberDeatils['membershipProduct']['product_netprice'];
		if($memberDeatils['membershipProduct']['distribution_datetime']){
			//show history
			$DistributionHistory_mdl = new DistributionHistory();
			$uplineUserList = $DistributionHistory_mdl->getHistory($user_id);
			$response['member'] = $memberDeatils;
			$response['uplineMembers'] = $uplineUserList;
			$response['sum'] = $DistributionHistory_mdl->getSum($user_id);;
			if($isAjax){
				return $this->respond($response);
			}else{
				return $response;
			}
		}
        $ProfileplanModel = new ProfileplanModel();
		$maxLevel = 15;
		$sum['minimum_share_percent']=0;
		$sum['bonus_share_percent']=0;
		$sum['minimum_share_amount']=0;
		$sum['bonus_share_amount']=0;
		$sum['total_amount']=0;
		$level = 0;
		// echo $user_id; die;
		while (true) {
			if (count($uplineUserIDs) >= $maxLevel || in_array($userDeatils['referral_id'], $uplineUserIDs)) {
				break;
			}
			$level++;
			$uplineUserIDs[] = $userDeatils['referral_id'];
			$userDeatils = $UserModel->find($userDeatils['referral_id']);
			$userDeatils['level'] = $level;
			$sharePercentage = $ProfileplanModel->getSharePercentage($userDeatils['profile_plan'],$level);
			$userDeatils['minimum_share_percent'] = $sharePercentage['minimum_share_percent'];
			$userDeatils['bonus_share_percent'] = $sharePercentage['bonus_share_percent'];
		    $userDeatils['minimum_share_amount'] = ($productNetPrice*$sharePercentage['minimum_share_percent']/100);
			$userDeatils['bonus_share_amount'] = ($productNetPrice*$sharePercentage['bonus_share_percent']/100);
			$userDeatils['total_amount'] = $userDeatils['minimum_share_amount'] + $userDeatils['bonus_share_amount'];
			$uplineUserList[] = $userDeatils;

			//sum
			$sum['minimum_share_percent'] += $userDeatils['minimum_share_percent'];
			$sum['bonus_share_percent'] += $userDeatils['bonus_share_percent'];
			$sum['minimum_share_amount'] += $userDeatils['minimum_share_amount'];
			$sum['bonus_share_amount'] += $userDeatils['bonus_share_amount'];
			$sum['total_amount'] += $userDeatils['total_amount'];

			//$user_id = $userDeatils['referral_id'];
			// echo '<pre>';
			// print_r($uplineUserIDs);
			// echo '</pre>';
			// echo '<hr>';

			// print_r($userDeatils);
			// die;

		}



		
		$response['member'] = $memberDeatils;
		$response['uplineMembers'] = $uplineUserList;
		$response['sum'] = $sum;
		if($isAjax){
			return $this->respond($response);
		}else{
			return $response;
		}
		
	}

	public function processDistribution($member_id){

		$user = checkUserToken();

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}

			//check admin
			if (!isAdmin($user)) {
				return $this->fail(['messages' => 'Access is denied'], 400);
			}

		//check member id exist
		$UserModel = new UserModel();
		if(!$UserModel->isUserExist($member_id)){
			return $this->fail(['messages' => 'Member is not found.'], 400);
		}

		//check membership product purchased
		if(!$UserModel->is_membership_product_purchased($member_id)){
			return $this->fail(['messages' => 'Membership product not purchased.'], 400);
		}

		//1.check distrubution is done
		$DistributionHistory_mdl = new DistributionHistory();
		if($DistributionHistory_mdl->isDistributionDone($member_id)){
			return $this->fail(['messages' => 'The distribution process is already have done.'], 400);
		}
		//2.get upline member list
		$uplineDetails = $this->getUpline($member_id,false);
		$uplineMemberList = $uplineDetails['uplineMembers'];
		$membershipProduct = $uplineDetails['member']['membershipProduct'];
		//3.process list
		$WalletModel = new WalletModel();
		$DistributionHistory = new DistributionHistory();
		$UserMembershipProductModel = new UserMembershipProductModel();
		$insertCount = 0 ;
		foreach($uplineMemberList as $member){
			//3.1 insert into walet `member_id`, `upline_member_id`, `profile_plan`, `share_percent`, 
			//`bonus_share_percent`, `share_amtount`, `bonus_share_amount`, `total_amount`
			$walletData = [
				'user_id'=>$member['id'],
				'order_id'=>$membershipProduct['order_id'],
				'minimum_share'=>$member['minimum_share_amount'],
				'bonus_share'=>$member['bonus_share_amount'],
				'status'=>'In',
			];
			$WalletModel->insert($walletData);
			//3.2 insert into distribution history
			$distributionData = [
				'member_id'=>$member_id,
				'upline_member_id'=>$member['id'],
				'order_id'=>$membershipProduct['order_id'],
				'level'=>$member['level'],
				'profile_plan'=>$member['profile_plan'],
				'minimum_share_percent'=>$member['minimum_share_percent'],
				'bonus_share_percent'=>$member['bonus_share_percent'],
				'minimum_share_amount'=>$member['minimum_share_amount'],
				'bonus_share_amount'=>$member['bonus_share_amount'],
				'total_amount'=>$member['minimum_share_amount'] + $member['bonus_share_amount'],
			];
		  $insertId = $DistributionHistory->insert($distributionData);
		  
		  if($insertId){
			$insertCount++;
		  }

		}

		//update distribution date
		$UserMembershipProductModel->save(['id'=>$membershipProduct['id'],'distribution_datetime'=>date('Y-m-d H:i:s')]);
			
			return $this->respond(['message'=>'success']);
	}

	// public function upgradeMemberProfilePlan($user_id='')
	// {

	// 	/*
	// 		Upgrade to P5, require directmembers with P4 > 4.
	// 		Upgrade to P4, require join 9 directmembers within 90 days from joining date 
	// 		Upgrade to P3, require join 6 directmembers within 60 days from joining date 
	// 		Upgrade to P2, require join 3 directmembers within 30 days from joining date 
    //    */

	// 	$model = new UserMembershipProductModel();

	// 	$list = [];
		
	// 	foreach($model->get_referralList_profile_plan_upgrade($user_id) as $item){
	// 		if((int)$item['member_count_for_upgrade_to_p5']>=4){
	// 			$item['upgrade_to'] = 'P5';
	// 		}else if((int)$item['member_count_for_upgrade_to_p4']>=9){
	// 			$item['upgrade_to'] = 'P4';
	// 		}else if((int)$item['member_count_for_upgrade_to_p3']>=6){
	// 			$item['upgrade_to'] = 'P3';
	// 		}else if((int)$item['member_count_for_upgrade_to_p2']>=3){
	// 			$item['upgrade_to'] = 'P2';
	// 		}else{
	// 			$item['upgrade_to'] = '';
	// 		}
	// 		$list[] = $item;
	// 	}


		
	// 	echo '<pre>';
	// 	print_r($list);
	// 	die;
	// }


}
