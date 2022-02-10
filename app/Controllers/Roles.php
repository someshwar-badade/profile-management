<?php

namespace App\Controllers;
use App\Models\RoleModel;

class Roles extends BaseController
{

    public function index()
    {

        helper(['form', 'url']);
		
        $data = [
			'page_title' => 'Roles',
			'active_nav_parent' => 'roles',
			'active_nav' => 'roles',
		];

        $model = new RoleModel();
        $data['roles'] = $model->where('role_type','USER')->findAll();

        if(!hasCapability('roles/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}
		return view('user/roles/index', $data);
    }

}
