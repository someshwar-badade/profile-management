<?php 
namespace App\Controllers;
use App\Models\UserModel;

class Profiles extends BaseController
{

    public function index(){

		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}

        $data = [
			'page_title' => 'Profiles',
			'active_nav_parent'=>'profiles',
			'active_nav'=>'profiles',
		];

		return view('user/profiles/index',$data);
    }
	public function create($id=''){
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}

		$data = [
			'page_title' => 'Profiles',
			'active_nav_parent'=>'profiles',
			'active_nav'=>'profiles',
			'id'=>$id,
			'pageHeading'=>$id?"Edit Profile":"Add new profile"
		];
		return view('user/profiles/add-profile',$data);
	}

	public function createJoiningForm($id=''){
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}

		$data = [
			'page_title' => 'Send Joining Form',
			'active_nav_parent'=>'send-joining-form',
			'active_nav'=>'send-joining-form',
			'id'=>$id,
			'pageHeading'=>$id?"Edit Joining Form":"Add new profile"
		];
		return view('user/employee/editJoiningForm',$data);
	}

	public function edit($id){
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}

		$data = [
			'page_title' => 'Profiles',
			'active_nav_parent'=>'profiles',
			'active_nav'=>'profiles',
		];
		return view('user/profiles/edit-profile',$data);
	}

	public function sendJoiningForm(){
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}

		$data = [
			'page_title' => 'Send Joining Form',
			'active_nav_parent'=>'send-joining-form',
			'active_nav'=>'send-joining-form',
			'pageHeading'=>"Send Joining Form"
		];
		return view('user/employee/sendJoiningForm',$data);
	}

	public function emailTest()
    {

        $email = \Config\Services::email();

        // $config['protocol'] = 'smtp';
        // $config['SMTPHost'] = 'mail.bitstringit.in';
        // $config['SMTPUser'] = 'somesh@bitstringit.in';
        // $config['SMTPPass'] = 'Someshwar@123';
        // $config['SMTPPort'] = '465';

        // $email->initialize($config);

    //     $email->setFrom('someshbadade@gmail.com', 'Someshwar');
    //     $email->setTo('somesh@bitstringit.in');

    //     $email->setSubject('Email Test');
    //     $email->setMessage('Testing the email class.');

    //   echo  $email->send();
	$message = view('email-templates/send-joining-form-link',['first_name'=>'someshwar','link'=>'http://bitstringit.in','verification_code'=>'123456']);
	echo sendEmail_common('someshbadade@gmail.com',$message,'Bitstringit - Verification code');
      die;
    }

}