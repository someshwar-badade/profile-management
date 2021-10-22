<?php

namespace App\Controllers\admin;

use App\Controllers;
use App\Models\UserModel;
use App\Models\OrderModel;
class OrderManagement extends Controllers\BaseController
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
			'page_title' => 'Order Management',
			'active_nav_parent' => 'order-management',
			'active_nav' => 'order-management'
		];
		return view('admin/orderManagement/index', $data);
	}



	public function create()
	{
		return redirect()->route('pageNotFound');
		// $user = checkUserToken();

		// if(!$user){
		// 	//redirct to login
		// 	setcookie("a_token", "", time() - 3600,'/');//delete cookie
		// 	setcookie("r_token", "", time() - 3600,'/');//delete cookie
		// 	return redirect()->route('logout');
		// }
		// if(!in_array($user['user_type'],['admin','subadmin'])){
		// 	return redirect()->route('dashboard');
		// }

		// $data = [
		// 	'page_title' => 'Profileplan Create',
		// 	'active_nav' => 'profileplan-create'
		// ];
		// $LanguageModel = new LanguageModel();
		// $data['language']= $LanguageModel->findAll();

		// return view('admin/profileplanManagement/create', $data);

	}

	public function order($id){
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		if(!in_array($user['user_type'],['admin','subadmin'])){
			return redirect()->route('profile');
			
		}
		$data = [
			'page_title' => 'Order View',
			'active_nav' => 'order-view'
		];
		$data['order_id'] = $id;
		// $LanguageModel = new LanguageModel();
		// $data['language']= $LanguageModel->findAll();

		$model = new OrderModel();
		$orderDerails = $model->find($id);
		if(empty($orderDerails)){
			return redirect()->route('pageNotFound');
		}
		// $category = $categoryModel->getCategory($profileplan_id);
		// $data['language']= $LanguageModel->findAll();

		return view('admin/orderManagement/edit', $data);
	}

	// public function user($user_id)
	// {
	// 	$data = [
	// 		'page_title' => 'User Edit',
	// 		'active_nav' => 'user-edit'
	// 	];
	// 	$userModel = new UserModel();
	// 	$BankUserModel = new BankUserModel();

	// 	$referralList = $userModel->select('id,first_name,middle_name,last_name')->where('status','1')->findAll();
	// 	$data['referralList'] = $referralList;
	// 	$data['user'] = $userModel->find($user_id);
		
		

	// 	if(empty($data['user'])){
			
	// 		session()->setFlashdata('error','Sorry, User not found.');
			
	// 		return redirect()->route('admin.users');
	// 	}

	// 	$data['userBankDetails'] = $BankUserModel->where('user_id',$user_id)->first();
	// 	$data['referralDetails'] = $userModel->select('id,first_name,middle_name,last_name,mobile,email,photo')->find($data['user']['referral_id']);
		
	// 	return view('admin/userManagement/edit', $data);
	// }
	public function downloadExcelReport(){
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}
		if(!in_array($user['user_type'],['admin','subadmin'])){
			return redirect()->route('profile');
			
		}

		// header('Content-type: application/excel;charset=UTF8');
		header('Content-type: application/vnd.ms-excel');
		$filename = 'orders_report'.date('ymd_h_i').'.xls';
		header('Content-Disposition: attachment; filename='.$filename);

		$filter = array();

		if(isset($_POST['filter'])){
			$filter = json_decode($_POST['filter'],true);
			
		}

		$filter['language_code']  = $this->request->getLocale();

		$OrderModel = new OrderModel();
		
		$data['list']=$OrderModel->getList($filter,'',0,-1,'')['data'];
		return view('admin/userManagement/excelReportTemplate',$data);
		
	}

}
