<?php
namespace App\Controllers;

class EmailTemplates extends BaseController
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
			'page_title' => 'Email Templated',
			'active_nav_parent' => 'email-templates',
			'active_nav' => 'email-templates',
		];
		if(!hasCapability('email_templates/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}
		

		return view('user/email-templates/index', $data);
    }
}