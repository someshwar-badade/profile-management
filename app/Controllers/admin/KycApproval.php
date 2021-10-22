<?php

namespace App\Controllers\admin;

use App\Controllers;
class KycApproval extends Controllers\BaseController
{
	public function index()
	{
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		if(!in_array($user['user_type'],['admin','subadmin'])){
			return redirect()->route('dashboard');
			
		}
		$data = [
			'page_title' => 'KYC Approval',
			'active_nav_parent' => 'kyc-approval',
			'active_nav' => 'kyc-approval'
		];
		
		return view('admin/kycApproval/index', $data);
	}

}
