<?php 
namespace App\Controllers;
use App\Models\UserModel;
// use App\Models\ContactusModel;
// use App\Models\SettingsModel;
// use Exception;
// use Firebase\JWT\JWT;
// use App\Models\BankUserModel;

class Users extends BaseController
{
	public function index()
	{
		$data = [
			'page_title' => 'Home',
			'active_nav'=>'home'
		];
		return view('home',$data);
	}

	public function register(){
		$user = checkUserToken();

		if($user){
			return redirect()->route('profile');
		}

		$data = [
			'page_title' => 'Register',
			'active_nav'=>'register'
		];
		return view('register',$data);
	}

	public function login(){
		$user = checkUserToken();

		if($user){
			return redirect()->route('profile');
		}

		$data = [
			'page_title' => 'Login',
			'active_nav'=>'login'
		];
		return view('login',$data);
	}
	
	public function forgotPassword(){
		$data = [
			'page_title' => 'Forgot Password',
			'active_nav'=>'forgot-password'
		];
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
		return redirect()->route('home');
	}

}