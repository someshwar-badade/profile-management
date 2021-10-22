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

}