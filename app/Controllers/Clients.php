<?php
namespace App\Controllers;

class Clients extends BaseController
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
			'page_title' => 'Clients',
			'active_nav_parent' => 'clients',
			'active_nav' => 'clients',
		];
		if(!hasCapability('clients/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}

		

		return view('user/clients/index', $data);
    }
}