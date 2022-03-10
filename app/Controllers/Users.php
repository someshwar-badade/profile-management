<?php 
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\ProfileModel;
use App\Models\JobPositionModel;
use App\Models\EmployeeJoinigDetailsModel;
use App\Models\ClientsModel;
// use Exception;
// use Firebase\JWT\JWT;
// use App\Models\BankUserModel;

class Users extends BaseController
{
	public function index()
	{
		$data = [
			'page_title' => 'Users',
			'active_nav'=>'users',
			'active_nav_parent'=>'users'
		];

		if(!hasCapability('user/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}

		return view('user/users/index',$data);
	}
	public function user()
	{
		$roleModel = new RoleModel();
		$data = [
			'page_title' => 'Users',
			'active_nav'=>'users',
			'active_nav_parent'=>'users',
			'roleList'=> $roleModel->where('role_type','USER')->find(),
		];

		if(!hasCapability('user/add')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}
		return view('user/users/user',$data);
	}

	public function getUser($user_id)
	{

		if(!hasCapability('user/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}
		
		$roleModel = new RoleModel();
		$data = [
			'page_title' => 'Users',
			'active_nav'=>'users',
			'user_id'=>$user_id,
			'roleList'=> $roleModel->where('role_type','USER')->find(),
			'active_nav_parent'=>'users'
		];
		return view('user/users/editUser',$data);
	}

	public function signUp(){
		$user = checkUserToken();

		if($user){
			return redirect()->route('profile');
		}

		$data = [
			'page_title' => 'Sign Up',
			'active_nav'=>'sign-up',
			'active_nav_parent'=>'sign-up'
		];
		return view('sign-up',$data);
	}

	public function login(){
		$user = checkUserToken();

		if($user){
			return redirect()->route('profile');
		}

		$data = [
			'page_title' => 'Login',
			'active_nav'=>'login',
			'active_nav_parent'=>'login',
		];
		return view('login',$data);
	}
	
	public function forgotPassword(){
		helper(['form', 'url']);
		
		$data = [
			'page_title' => 'Forgot Password',
			'active_nav'=>'forgot-password',
			'active_nav_parent'=>'forgot-password',
			'email'=>'',
		];
		$userModel = new UserModel();
		if ($_POST && $this->request->getPost('verify')=='') {

			$input = $this->validate([
				'email' => ['label' => 'E-mail', 'rules' => 'required|valid_email','errors'=>['required'=>"Enter a valid E-mail.",'valid_email'=>"Enter a valid E-mail."]],
			]);

			if (!$input) {
				$data['validation'] = $this->validator;

			}else {
				
				
				$userDetails = $userModel->where('email',$this->request->getPost('email'))->first();
				if(empty($userDetails)){
					$data['messageError'] = "E-mail is not registered with us.";
				}else if($userDetails['status']=='0'){
					$data['messageError'] = "Your account is deactivated please contact to admin.";
				}else{
					//send verification code
					$userDetails['verification_code'] = substr(number_format(time() * rand(), 0, '', ''), 0, 8);
					$userModel->save($userDetails);

					//send email
					$templateData = [
						'first_name' => $userDetails['fname'],
						'verification_code' => $userDetails['verification_code']
					];
					$message = view('email-templates/send-profile-verification-code', $templateData);
					$isEmailSent =  sendEmail_common($userDetails['email'], $message, 'Bitstringit', '');
					$data['messageSuccess']="The verification code has been sent on your e-mail.";
					$data['email'] = $userDetails['email'];
				}
			}

		}else if($_POST && $this->request->getPost('verify')=='true'){
			$data['email'] = $this->request->getPost('email');
			$input = $this->validate([
				'verification_code' => ['label' => 'Verification Code', 'rules' => 'required|exact_length[8]','errors'=>['required'=>"Enter 8 digit verification code.",'exact_length'=>"Enter 8 digit verification code."]],
				'password' => ['label' => 'Password', 'rules' => 'required','errors'=>['required'=>"Password can not be empty."]],
				'cpassword' => ['label' => 'Confirm Password', 'rules' => 'matches[password]','errors'=>['matches'=>"Not match with password."]],
			]);
			if (!$input) {
				$data['validation'] = $this->validator;

			}else {
				$userDetails = $userModel->where('email',$this->request->getPost('email'))->first();

				if($userDetails['verification_code']==$this->request->getPost('verification_code')){
					$userDetails['password'] =  password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);;
					$userModel->save($userDetails);
					$data['messageSuccess']="The password updated successfully.";
					$data['email'] = '';
				}else{
					$data['messageError'] = "Please enter a valid verification code.";
				}

			}

		}


		return view('forgot-password',$data);
	}
	
	public function profile(){
			
		$user = checkUserToken();
		
		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		

		// $BankUserModel = new BankUserModel();
		// $userBankDetails = $BankUserModel->where('user_id',$user['id'])->first();

		$UserModel = new UserModel();
		// $referralDetails = $UserModel->select('id,first_name,middle_name,last_name,mobile,email,photo')->find($user['referral_id']);

		$data = [
			'page_title' => 'Profile',
			'active_nav_parent'=>'',
			'active_nav'=>'profile',
			'active_nav_parent'=>'profile',
			'user'=>$user,
		];

		
		return view('user/profile',$data);
	}

	public function userDashboard(){
			

		$user = checkUserToken();
	
		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		// if(!in_array($user['user_type'],['admin','subadmin'])){
		// 	return redirect()->route('profile');
			
		// }
		$data = [
			'page_title' => 'Dashboard',
			'active_nav_parent' => 'dashboard',
			'active_nav'=>'dashboard',
			'user'=>$user
		];

		if(isset($user['roles'][0])){

			if($user['roles'][0]['role_name']=='guest_user'){
			$model = new EmployeeJoinigDetailsModel();
			$JoiningForm = $model->where('user_id',$user['id'])->first();
			$data['isJoiningFormExist'] = (bool) $JoiningForm;
			return view('user/dashboard-guest-user',$data);
		}
		}else{
			$model = new EmployeeJoinigDetailsModel();
			$JoiningForm = $model->where('user_id',$user['id'])->first();
			$data['isJoiningFormExist'] = (bool) $JoiningForm;
			return view('user/dashboard-guest-user',$data);
		}

		// $ProfileModel = new ProfileModel();
		// $JobPositionModel = new JobPositionModel();
		// $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
		// $EmployeeJoinigDetailsModel = new

		$data['counts'] = [
			'profiles'=>ProfileModel::getCount(),
			'onboards'=>EmployeeJoinigDetailsModel::getCount(),
			'jobPositions'=>JobPositionModel::getCount(),
			'clients'=> ClientsModel::getCount(),
		];
		
		
		return view('user/dashboard',$data);
	}

	public function settings(){
			

		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		// if(!in_array($user['user_type'],['admin','subadmin'])){
		// 	return redirect()->route('profile');
			
		// }
		$data = [
			'page_title' => 'Settings',
			'active_nav_parent' => 'settings',
			'active_nav'=>'settings',
			'user'=>$user
		];

		
		
		return view('user/settings',$data);
	}

	public function logout(){
		setcookie('a_token','',time() - 3600,'/');
		setcookie('r_token','',time() - 3600,'/');
		setcookie('fname','',time() - 3600,'/');
		setcookie('lname','',time() - 3600,'/');
		setcookie('user_type','',time() - 3600,'/');
		$session = session();
		$session->remove('employee_joining_form_id');
		$session->remove('employee_name');
		
		$session->remove('profile_id');
		$session->remove('profile_first_name');
		$session->remove('profile_last_name');

		return redirect()->route('home');
	}

}