<?php
namespace App\Controllers;

class Logs extends BaseController
{

	public function index()
	{
        $user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		$data = [
			'page_title' => 'Logs',
			'active_nav_parent' => 'logs',
			'active_nav' => 'logs',
		];
		if(!hasCapability('logs/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}

		

		return view('user/logs/index', $data);
    }
}