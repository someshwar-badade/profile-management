<?php

namespace App\Controllers;

use App\Models\EmployeeJoinigDetailsModel;

class EmployeeForm extends BaseController
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
            'page_title' => 'Profiles',
            'active_nav_parent' => 'forms',
            'active_nav' => 'forms',
        ];

        return view('employee_joining_form', $data);
    }
    // public function create($id=''){
    // 	$user = checkUserToken();

    // 	if(!$user){
    // 		//redirct to login
    // 		setcookie("a_token", "", time() - 3600,'/');//delete cookie
    // 		setcookie("r_token", "", time() - 3600,'/');//delete cookie
    // 		return redirect()->route('logout');
    // 	}

    // 	$data = [
    // 		'page_title' => 'Profiles',
    // 		'active_nav_parent'=>'profiles',
    // 		'active_nav'=>'profiles',
    // 		'id'=>$id,
    // 		'pageHeading'=>$id?"Edit Profile":"Add new profile"
    // 	];
    // 	return view('user/profiles/add-profile',$data);
    // }

    // public function edit($id){
    // 	$user = checkUserToken();

    // 	if(!$user){
    // 		//redirct to login
    // 		setcookie("a_token", "", time() - 3600,'/');//delete cookie
    // 		setcookie("r_token", "", time() - 3600,'/');//delete cookie
    // 		return redirect()->route('logout');
    // 	}

    // 	$data = [
    // 		'page_title' => 'Profiles',
    // 		'active_nav_parent'=>'profiles',
    // 		'active_nav'=>'profiles',
    // 	];
    // 	return view('user/profiles/edit-profile',$data);
    // }

}
