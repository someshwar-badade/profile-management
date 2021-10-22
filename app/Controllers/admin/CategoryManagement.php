<?php

namespace App\Controllers\admin;

use App\Controllers;
use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\LanguageModel;
class CategoryManagement extends Controllers\BaseController
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
			return redirect()->route('profile');
			
		}

		$data = [
			'page_title' => 'Category Management',
			'active_nav_parent' => 'category-management',
			'active_nav' => 'category-management'
		];
		$CategoryModel = new CategoryModel();
		$data['list']= $CategoryModel->findAll();
		return view('admin/categoryManagement/index', $data);
	}



	public function create()
	{
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
			'page_title' => 'Category Create',
			'active_nav_parent' => 'category-management',
			'active_nav' => 'category-create'
		];
		$LanguageModel = new LanguageModel();
		$data['language']= $LanguageModel->findAll();

		return view('admin/categoryManagement/create', $data);
	}

	public function category($category_id){
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
			'page_title' => 'Category Edit',
			'active_nav_parent' => 'category-management',
			'active_nav' => 'category-edit'
		];
		$data['category_id'] = $category_id;
		// $LanguageModel = new LanguageModel();
		// $data['language']= $LanguageModel->findAll();

		$model = new CategoryModel();
		$category = $model->find($category_id);
		if(empty($category)){
			return redirect()->route('pageNotFound');
		}
		// $category = $categoryModel->getCategory($category_id);
		// $data['language']= $LanguageModel->findAll();

		return view('admin/categoryManagement/edit', $data);
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
		$filename = 'category_report'.date('ymd_h_i').'.xls';
		header('Content-Disposition: attachment; filename='.$filename);


		
		$db = \Config\Database::connect();
		$builder = $db->table('category');
		$builder->select('ct.category_id AS "Category ID",category.image_url AS "Image",category.slug AS "Slug",ct.language_code AS "Language",ct.title AS "Title",ct.description AS "Description"');
		$builder->join('category_translation as ct','category.id = ct.category_id','left');
		

		


		if(isset($_POST['filter'])){
			$filter = $_POST['filter'];
			if(isset($filter['status'])){
				if(strlen(trim($filter['status']))>0){

					$builder->where("status",$filter['status']);
				}
			}
			if(isset($filter['title'])){
				if(strlen(trim($filter['title']))>0){

					$builder->like("title",$filter['title']);
				}
			}
		}

		$query   = $builder->get();
		
		
		
		$data['list']=$query->getResultArray();
		return view('admin/userManagement/excelReportTemplate',$data);
		
	}

}
