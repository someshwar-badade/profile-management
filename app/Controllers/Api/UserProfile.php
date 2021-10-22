<?php

namespace App\Controllers\api;


use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\BankUserModel;
use App\Models\WalletModel;
// use App\Models\OtpModel;
// use Exception;
// use Firebase\JWT\JWT;
use App\Controllers;

class UserProfile extends  Controllers\BaseController
{
	use ResponseTrait;


	public function personalDetails()
	{
		
		if ($this->request->getMethod() === 'post') {

			$user = checkUserToken();

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}

			$requestData = (array) $this->request->getJSON();

			$requestData['id'] = $user['id'];

			$allowedColums = [
				'id' => '',
				'first_name' => '',
				'middle_name' => '',
				'last_name' => '',
				'email' => '',
				'dob' => '',
				'gender' => '',
				'marital_status' => '',
				'other_phone_no' => '',
			];
			$requestData = array_intersect_key($requestData, $allowedColums);

			$validation =  \Config\Services::validation();

			$rules = [
				'first_name' => 'required',
				'last_name' => 'required',

			];

			if (isset($requestData['email'])) {
				if ($requestData['email']) {
					$rules['email'] = 'trim|valid_email|is_unique[users.email,id,{id}]';
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
					
					'email' => [
						'required' => lang('profile.personal.emailAddress.errorRequired'),
						'valid_email' => lang('profile.personal.emailAddress.errorEmail'),
						'is_unique' => lang('profile.personal.emailAddress.errorUnique')
					],

				]
			);

			$valid = $validation->run($requestData);
			if (!$valid) {

				return $this->fail($validation->getErrors(), 400);
			}


			if (isset($requestData['dob'])) {

				if ($requestData['dob'] != '') {
				}
			}
			$requestData['dob'] = date('Y-m-d', strtotime($requestData['dob']));
			$model = new UserModel();
			$model->save($requestData);

			//action log
			 $changed_data = array_diff_assoc( (array)$requestData, (array)$user);
			
			if(!empty($changed_data)){
				$actionLogData =[
					'user_id'=>$user['id'],
					'action_type'=>'updated',
					'model'=>'user',
					'record_id'=>$user['id'],
					'chaged_data'=> json_encode($changed_data)
				] ;
				creatActionLog($actionLogData);
			}
			

			$user = $model->find($requestData['id']);

			setcookie('first_name',$user['first_name'],0,'/');
			setcookie('middle_name',$user['middle_name'],0,'/');
			setcookie('last_name',$user['last_name'],0,'/');

			//Respond with 200 status code
			return $this->respond(['success' => lang('profile.personal.success')]);
		}
	}


	public function changePassword()
	{


		if ($this->request->getMethod() === 'post') {

			$user = checkUserToken();

			if (!$user) {
				return $this->fail(['messages' => 'Please login.'], 400);
			}

			$requestData = (array) $this->request->getJSON();

			$allowedColums = [
				'new_password' => '',
				'current_password' => '',
				'confirm_password' => ''
			];
			$requestData = array_intersect_key($requestData, $allowedColums);


			$validation =  \Config\Services::validation();

			$rules = [
				'current_password' => 'required|min_length[6]',
				'new_password' => 'required|min_length[6]',
				'confirm_password' => 'matches[new_password]',
			];

			$validation->setRules($rules);

			$validation->setRules(
				$rules,
				[   // Errors
					'current_password' => [
						'required' => lang('profile.settings.currentPassword.errorRequired'),
						'min_length' => lang('profile.settings.currentPassword.errorMinlength')
					],
					'new_password' => [
						'required' => lang('profile.settings.newPassword.errorRequired'),
						'min_length' => lang('profile.settings.newPassword.errorMinlength'),
					],
					'confirm_password' => [
						'matches' => lang('profile.settings.confirmPassword.errorEqualto'),
					],

				]
			);

			$valid = $validation->run($requestData);
			if (!$valid) {
				return $this->fail($validation->getErrors(), 400);
			}


			$UserModel = new UserModel();
			// $userDetails = $UserModel->where('id',$user['id'])->first();

			//check current password
			if (!password_verify($requestData['current_password'], $user['password'])) {
				return $this->fail(['current_password' => lang('profile.settings.currentPassword.errorValid')]);
			}

			$user['password'] = password_hash($requestData['confirm_password'], PASSWORD_BCRYPT);

			$UserModel->save($user);
			//action log
			$changed_data = ['message'=>"change password"];

			if(!empty($changed_data)){
				$actionLogData =[
					'user_id'=>$user['id'],
					'action_type'=>'updated',
					'model'=>'user',
					'record_id'=>$user['id'],
					'chaged_data'=> json_encode($changed_data)
				] ;
				creatActionLog($actionLogData);
			}
			$userDetails = $UserModel->where('id', $user['id'])->first();

			//Respond with 200 status code
			return $this->respond(['success' => lang('profile.settings.passSuccess')]);
		}
	}

	
}
