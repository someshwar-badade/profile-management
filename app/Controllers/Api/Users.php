<?php

namespace App\Controllers\api;


use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use Exception;
use Firebase\JWT\JWT;
use App\Controllers;
use App\Models\ContactusModel;
use App\Models\SettingsModel;
use App\Models\ActionLogModel;

class Users extends  Controllers\BaseController
{
	use ResponseTrait;



	public function register()
	{

		if ($this->request->getMethod() === "post") {
			$requestData = (array) $this->request->getJSON();



			$validation =  \Config\Services::validation();

			$rules = [
				'fname' => 'required',
				'lname' => 'required',
				'password' => 'required|min_length[6]',
				'confirm_password' => 'matches[password]'
			];

			$rules['email'] = 'required|trim|valid_email|is_unique[users.email,id,{id}]';


			$validation->setRules(
				$rules,
				[   // Errors
					'fname' => [
						'required' => "First name can not be empty."
					],
					'lname' => [
						'required' => "Last name can not be empty."
					],
					'email' => [
						'required' => "E-mail can not be empty.",
						'valid_email' => "Enter valid e-mail.",
						'is_unique' => "E-mail is already registered with us."
					],
					'password' => [
						'required' => "Password can not be empty.",
						'min_length' => "Password is too short.",
					],
					'confirm_password' => [

						'matches' => "Password is not match.",
					]
				]
			);

			$valid = $validation->run($requestData);
			if (!$valid) {

				return $this->fail($validation->getErrors(), 400);
			}



			$requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);
			
			$model = new UserModel();
			$user_id  = $model->insert($requestData);
			$user = $model->find($user_id);
			
			 //insert role [6 - guest_user]
             $UserRoleModel = new UserRoleModel();
             if(!$UserRoleModel->where('user_id',$user_id)->where('role_id','6')->first()){
                $UserRoleModel->insert(['user_id'=>$user_id,'role_id'=>'6']);
             }
			
			$user = $model->find($user_id);
			$actionLogData = [
				'user_id' => $user_id,
				'action_type' => 'created',
				'model' => 'user',
				'record_id' => $user_id,
				'chaged_data' => json_encode($user)
			];

			creatActionLog($actionLogData);

			if ($user) {
				//send sms 
				// $message = "You have registered on ".SITE_TITLE." and your Registration Id is $user_id.";

				// $message = urlencode($message);
				// $output = sendSms($requestData['mobile'],$message);

			}
			//Respond with 200 status code
			// return $this->respond(['success' => lang('forms.register.successMessage')]);

			return $this->userLogin($user);
		}
	}

	public function login()
	{

		if ($this->request->getMethod() === 'post') {
			$requestData = (array) $this->request->getJSON();
			$requestData = array_filter($requestData);

			$validation =  \Config\Services::validation();
			$model = new UserModel();
			$isValidUser = false;


			$rules = [
				'email' => 'required|valid_email|is_not_unique[users.email]',
			];

			if ($requestData['loginChoice'] == 'verificationCode') {
				$rules['verificationCodeText'] = 'required';
			} else {
				$rules['password'] = 'required';
			}


			$validation->setRules(
				$rules,
				[
					'email' => [
						'required' => lang('forms.login.email.errorRequired'),
						'is_not_unique' => "The e-mail is not registered with us."
					],

					'verificationCodeText' => [
						'required' => "Please enter the verification code."
					],

					'password' => [
						'required' => lang('forms.login.password.errorRequired')
					],
				]
			);

			$valid = $validation->run($requestData);


			if (!$valid) {

				return $this->fail($validation->getErrors(), 400);
			}

			//get user details
			// if (strlen($requestData['mobile']) == '10') {
			// 	$user = $model->where('mobile', $requestData['mobile'])->first();
			// } else {
			// 	$user = $model->find($requestData['mobile']);
			// }

			$user = $model->where('email', $requestData['email'])->first();

			if ($requestData['loginChoice'] == 'verificationCode') {
				//check password
				if ($requestData['verificationCodeText'] != $user['verification_code']) {
					return $this->fail(['verificationCodeText' => "Invalid verification code."]);
					
				}
			} else {
				//check password
				if (!password_verify($requestData['password'], $user['password'])) {
					return $this->fail(['password' => lang('forms.login.password.errorInvalid')]);
				}
			}

			if ($user['status'] == '0') {
				return $this->fail(['errorMessage' => "Your account is deactivated. Please contact to admin"], 403);
			}

			//valid user
			$isValidUser = true;

			if ($isValidUser) {

				//set verification code to null for security
				$user['verification_code'] =null;
				$model->save($user);
				$actionLogData = [
					'user_id' => $user['id'],
					'action_type' => 'created',
					'model' => 'login',
					'record_id' => $user['id'],
					'action_by' => $user['fname'] . ' ' . $user['lname'],
					'chaged_data' => json_encode(['login' => date('Y-m-d H:i:s')])
				];

				$ActionLogModel = new ActionLogModel();
				$ActionLogModel->insert($actionLogData);

				return $this->userLogin($user);
			}



			return $this->fail(['password' => lang('forms.login.password.errorInvalid')]);
		}
	}

	protected function userLogin($user)
	{
		//login succesfully create access token short time
		$payload = [
			'ist' => time(),
			'iss' => 'localhost',
			'exp' => time() + (60 * 15), //sec * min (valid for 15 Min)
			'user_id' => $user['id'],
			'user_type' => $user['user_type']
		];

		$a_token = JWT::encode($payload, JWT_SECRETE_KEY);
		setcookie('a_token', $a_token, 0, '/');

		//create refresh token long time
		$payload = [
			'ist' => time(),
			'iss' => 'localhost',
			'exp' => time() + (60 * 60 * 24 * 7), //sec * min * hours * days (valid 7 days)
			'user_id' => $user['id'],
			'user_type' => $user['user_type']
		];

		$r_token = JWT::encode($payload, JWT_SECRETE_KEY_2);
		setcookie('r_token', $r_token, 0, '/');

		$first_name = $user['fname'];
		$last_name = $user['lname'];
		$user_type = $user['user_type'];

		setcookie('fname', $first_name, 0, '/');
		setcookie('lname', $last_name, 0, '/');
		setcookie('user_type', $user_type, 0, '/');

		//Respond with 200 status code
		return $this->respond([
			'user' => [
				'fname' => $first_name,
				'lname' => $last_name,
				'user_type' => $user_type
			],
			'a_token' => $a_token,
			'r_token' => $r_token
		]);
	}

	public function logout()
	{
		setcookie('a_token', '', time() - 3600, '/');
		setcookie('r_token', '', time() - 3600, '/');
		setcookie('fname', '', time() - 3600, '/');
		setcookie('lname', '', time() - 3600, '/');
		setcookie('user_type', '', time() - 3600, '/');
		//Respond with 200 status code
		return $this->respond(['success' => 'Logout.']);
	}

	public function getUserDetails($id)
	{


		$model = new UserModel();
		$user = $model->find($id);

		if ($user) {
			//Respond with 200 status code
			return $this->respond(['user' => $user]);
		}
		//error
		return $this->fail(['referral_id' => lang('forms.register.referralId.errorNotExist')]);
	}
	public function getReferralDetails()
	{

		if ($this->request->getMethod() === 'post') {
			$requestData = (array) $this->request->getJSON();
			$requestData = array_filter($requestData);

			$validation =  \Config\Services::validation();

			$validation->setRules(
				[
					'referral_id' => 'required|numeric|exact_length[6]',
					'mobile' => 'required|numeric|exact_length[10]',
					'otp' => 'required|is_not_unique[otp.otp,mobile,{mobile}]',
				],
				[   // Errors

					'referral_id' => [
						'required' => lang('forms.register.referralId.errorNotExist'),
						'exact_length' => lang('forms.register.referralId.errorNotExist'),
						'numeric' => lang('forms.register.referralId.errorNotExist')
					],
					'mobile' => [
						'required' => lang('forms.login.mobile.errorRequired'),
						'exact_length' => lang('forms.login.mobile.errorMinlength'),
						'numeric' => lang('forms.login.mobile.errorNumeric')
					],
					'otp' => [
						'required' => lang('forms.login.otp.errorRequired'),
						'is_not_unique' => lang('forms.login.otp.errorInvalid'),
					],
				]
			);

			$valid = $validation->run($requestData);
			if (!$valid) {

				return $this->fail($validation->getErrors(), 400);
			}

			$model = new UserModel();
			$user = $model->find($requestData['referral_id']);

			if ($user) {
				//Respond with 200 status code
				return $this->respond(['user' => $user]);
			}
			//error
			return $this->fail(['referral_id' => lang('forms.register.referralId.errorNotExist')]);
		}
	}

	public function sendVerificationCode()
	{
		$requestData = (array) $this->request->getJSON();


		$validation =  \Config\Services::validation();

		$rules = [
			'email' => 'required|valid_email|is_not_unique[users.email]',
		];


		$validation->setRules(
			$rules,
			[
				'email' => [
					'required' => "Please enter an E-mail.",
					'valid_email' => "Please enter valid E-mail.",
					'is_not_unique' => "E-mail is not registered with us.",
				],
			]

		);
		$valid = $validation->run($requestData);

		if (!$valid) {
			return $this->fail($validation->getErrors(), 400);
		}

		//get user details 
		$model = new UserModel();
		$userData = $model->where('email', $requestData['email'])->first();

		$userData['verification_code'] = substr(number_format(time() * rand(), 0, '', ''), 0, 8);

		$update = $model->save($userData);

		//send email
		$templateData = [
			'first_name' => $userData['fname'],
			'link' => '',
			'verification_code' => $userData['verification_code']
		];
		$message = view('email-templates/send-profile-verification-code', $templateData);
		$isEmailSent =  sendEmail_common($userData['email'], $message, 'Bitstringit', '');

		//Respond with 200 status code
		return $this->respond([
			'messages' => [
				'success' => "Verification code is sent to your email.",
			]
		]);
	}


	public function getUserList()
	{
	}
	// public function requestOtp()
	// {
	// 	if ($this->request->getMethod() === 'post') {
	// 		$requestData = (array) $this->request->getJSON();

	// 		$validation =  \Config\Services::validation();
	// 		$validation->setRules(
	// 			[
	// 				'mobile' => 'required|numeric|exact_length[10]'
	// 			],
	// 			[   // Errors

	// 				'mobile' => [
	// 					'required' => lang('forms.register.mobile.errorRequired'),
	// 					'exact_length' => lang('forms.register.mobile.errorMinlength'),
	// 					'is_unique' => lang('forms.register.mobile.errorUnique'),
	// 					'numeric' => lang('forms.register.mobile.errorNumeric')
	// 				],
	// 			]
	// 		);

	// 		$valid = $validation->run($requestData);
	// 		if (!$valid) {

	// 			return $this->fail($validation->getErrors(), 400);
	// 		}

	// 		$otpModel = new OtpModel();

	// 		//check record exist in database 
	// 		$otpData = $otpModel->select('id,mobile,otp,token')->where('mobile', $requestData['mobile'])->first();

	// 		$otpExpiredTime = 10;
	// 		$payload = [
	// 			'ist' => time(),
	// 			'iss' => 'localhost',
	// 			'exp' => time() + (60 * $otpExpiredTime)
	// 		];

	// 		$token = JWT::encode($payload, JWT_SECRETE_KEY);

	// 		//get otp text
	// 		$otp_code = $this->generateOtp();
	// 		if ($otpData) {
	// 			//update
	// 			$otpData['otp'] = $otp_code;
	// 			$otpData['token'] = $token;

	// 			$isUpdate = $otpModel->save($otpData);
	// 		} else {
	// 			//insert new
	// 			$requestData['otp'] = $otp_code;
	// 			$requestData['token'] = $token;
	// 			$isUpdate = $otpModel->insert($requestData);
	// 		}

	// 		if (isset($isUpdate)) {
	// 			//send SMS
	// 			$message = "Your OTP for ".SITE_TITLE." is $otp_code. The OTP is valid for the next $otpExpiredTime minutes.";
	// 			//getting values from included file

	// 			$message = urlencode($message);


	// 			$output = sendSms($requestData['mobile'],$message);
	// 			if (stripos(strip_tags($output), "Successfully") !== false) {

	// 				return $this->respond(['success' => lang('forms.register.otp.otpSendScuccess')]);
	// 			}
	// 		}

	// 		return $this->fail(['messages' => 'error'], 400);
	// 	}
	// }

	protected function generateOtp($length = 6)
	{
		return substr(number_format(time() * rand(), 0, '', ''), 0, $length);
	}



	// protected function isOtpExpired($mobile)
	// {
	// 	$otpModel = new OtpModel();
	// 	$otpDetails = $otpModel->where('mobile', $mobile)->first();
	// 	try {
	// 		$payload = JWT::decode($otpDetails['token'], JWT_SECRETE_KEY, ['HS256']);
	// 		//make expire used otp
	// 		$payload = [
	// 			'ist' => time(),
	// 			'iss' => 'localhost',
	// 			'exp' => time() + (-60)
	// 		];
	// 		$token = JWT::encode($payload, JWT_SECRETE_KEY);
	// 		$otpDetails['token'] = $token;
	// 		$otpModel->save($otpDetails);
	// 	} catch (Exception $e) {
	// 		return $e->getMessage();
	// 	}

	// 	return false;
	// }

	// public function forgotpassword()
	// {
	// 	if ($this->request->getMethod() === 'post') {
	// 		$requestData = (array) $this->request->getJSON();

	// 		$validation =  \Config\Services::validation();
	// 		$validation->setRules(
	// 			[
	// 				'mobile' => 'required|numeric|exact_length[10]|is_not_unique[users.mobile,mobile,{mobile}]',
	// 				'otp' => 'required|is_not_unique[otp.otp,mobile,{mobile}]',
	// 				'password' => 'required',
	// 			],
	// 			[   // Errors

	// 				'mobile' => [
	// 					'required' => lang('forms.forgotPassword.mobile.errorRequired'),
	// 					'exact_length' => lang('forms.forgotPassword.mobile.errorMinlength'),
	// 					'is_not_unique' => lang('forms.forgotPassword.mobile.errorInvalid'),
	// 					'numeric' => lang('forms.forgotPassword.mobile.errorNumeric')
	// 				],
	// 				'otp' => [
	// 					'required' => lang('forms.forgotPassword.otp.errorRequired'),
	// 					'is_not_unique' => lang('forms.forgotPassword.otp.errorInvalid'),
	// 				],
	// 				'password' => [
	// 					'required' => lang('forms.forgotPassword.password.errorRequired'),
	// 				],
	// 			]
	// 		);

	// 		$valid = $validation->run($requestData);
	// 		if (!$valid) {

	// 			return $this->fail($validation->getErrors(), 400);
	// 		}

	// 		// check otp expired
	// 		if ($this->isOtpExpired($requestData['mobile'])) {
	// 			return $this->fail(['otp' => 'OTP Expired']);
	// 		}

	// 		//get user details
	// 		$model = new UserModel();
	// 		$user = $model->where('mobile', $requestData['mobile'])->first();

	// 		//update password
	// 		if ($user) {
	// 			$user['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);

	// 			if ($model->save($user)) {
	// 				return $this->respond(['success' => lang('forms.forgotPassword.successMessage')]);
	// 			}
	// 		}

	// 		return $this->fail(['messages' => 'error']);
	// 	}
	// }

	// public function contactUs()
	// {

	// 	$SettingsModel = new SettingsModel();
	// 	$contactusModel = new ContactusModel();

	// 	if ($this->request->getMethod() === 'post') {
	// 		$requestData = (array) $this->request->getJSON();
	// 		$requestData = array_filter($requestData);

	// 		$validation =  \Config\Services::validation();
	// 		$validation->setRules(
	// 			[
	// 				'fullname' => 'required|min_length[3]',
	// 				'email' => 'required|valid_email',
	// 				'mobile' => 'required|numeric|exact_length[10]',
	// 				'otp' => 'required|is_not_unique[otp.otp,mobile,{mobile}]',
	// 				'message' => 'required'
	// 			],
	// 			[   // Errors
	// 				'fullname' => [
	// 					'required' => lang('forms.contactUs.fullName.errorRequired'),
	// 					'min_length' => lang('forms.contactUs.fullName.errorMinlength')
	// 				],
	// 				'email' => [
	// 					'required' => lang('forms.contactUs.emailAddress.errorRequired')
	// 				],
	// 				'mobile' => [
	// 					'required' => lang('forms.contactUs.mobile.errorRequired'),
	// 					'numeric' => lang('forms.contactUs.mobile.errorNumeric'),
	// 					'exact_length' => lang('forms.contactUs.mobile.errorMinlength'),
	// 				],
	// 				'otp' => [
	// 					'required' => lang('forms.contactUs.otp.errorRequired'),
	// 					'is_not_unique' => lang('forms.contactUs.otp.errorInvalid'),
	// 				],
	// 				'message' => [
	// 					'required' => lang('forms.contactUs.message.errorRequired')
	// 				]
	// 			]
	// 		);

	// 		$valid = $validation->run($requestData);
	// 		if (!$valid) {

	// 			return $this->fail($validation->getErrors(), 400);
	// 		}
	// 		$save_data = [
	// 			'fullname' => $requestData['fullname'],
	// 			'email' => $requestData['email'],
	// 			'phone' => $requestData['mobile'],
	// 			'message' => $requestData['message'],
	// 		];

	// 		if (!$contactusModel->save($save_data)) {

	// 			return $this->fail(['messages' => "Something Went Wrong."], 400);
	// 		}


	// 		sendEmail_contactUs($save_data['fullname'], $save_data['email'], $save_data['phone'], $save_data['message']);

	// 		return $this->respond(['success' => lang('forms.contactUs.successMessage')]);
	// 	}
	// }

	public function getDashboardDetails()
	{
	}
}
