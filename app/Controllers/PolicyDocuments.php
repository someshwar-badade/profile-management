<?php
namespace App\Controllers;

class PolicyDocuments extends BaseController
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
			'page_title' => 'Policy Documents',
			'active_nav_parent' => 'policy-document',
			'active_nav' => 'policy-document',
		];
		if(!hasCapability('policy-documents/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}
		

		return view('user/policy-documents/index', $data);
    }
}