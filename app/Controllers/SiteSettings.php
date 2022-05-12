<?php
namespace App\Controllers;

class SiteSettings extends BaseController
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
			'page_title' => 'Site Settings',
			'active_nav_parent' => 'site-settings',
			'active_nav' => 'site-settings',
		];
		if(!hasCapability('site_settings/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}
		

		return view('user/site-settings/index', $data);
    }
}