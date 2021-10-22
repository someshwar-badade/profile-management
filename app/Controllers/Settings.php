<?php 
namespace App\Controllers;
use App\Models\UserModel;

class Settings extends BaseController
{

    public function index(){
        $data = [
			'page_title' => 'Settings',
			'active_nav_parent'=>'settings',
			'active_nav'=>'settings',
		];

		return view('user/settings',$data);
    }

}