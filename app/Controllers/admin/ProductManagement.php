<?php

namespace App\Controllers\admin;

use App\Controllers;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\LanguageModel;
class ProductManagement extends Controllers\BaseController
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

		$CategoryModel = new CategoryModel();
		$data = [
			'page_title' => 'Product Management',
			'active_nav_parent' => 'product-management',
			'active_nav' => 'product-management',
			'categoryList'=> $CategoryModel->getCategoryList(['language_code'=>$this->request->getLocale()],'',0,-1,'title ASC')
		];
		// $CategoryModel = new CategoryModel();
		// $data['list']= $CategoryModel->findAll();
		return view('admin/productManagement/index', $data);
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
			'page_title' => 'Product Create',
			'active_nav_parent' => 'product-management',
			'active_nav' => 'product-create'
		];
		$LanguageModel = new LanguageModel();
		$CategoryModel = new CategoryModel();
		$data['language']= $LanguageModel->findAll();
		$data['categoryList']= $CategoryModel->getCategoryList(['language_code'=>$this->request->getLocale()],'',0,-1,'title ASC');
		
		return view('admin/productManagement/create', $data);
	}

	public function product($product_id){
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
			'page_title' => 'Product Edit',
			'active_nav_parent' => 'product-management',
			'active_nav' => 'product-edit'
		];
		$data['product_id'] = $product_id;
		// $LanguageModel = new LanguageModel();
		// $data['language']= $LanguageModel->findAll();

		$model = new ProductModel();
		$product = $model->find($product_id);
		if(empty($product)){
			return redirect()->route('pageNotFound');
		}
		$LanguageModel = new LanguageModel();
		$CategoryModel = new CategoryModel();
		$data['language']= $LanguageModel->findAll();
		$data['categoryList']= $CategoryModel->getCategoryList(['language_code'=>$this->request->getLocale()],'',0,-1,'title ASC');
		

		return view('admin/productManagement/edit', $data);
	}

	
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

		header('Content-type: application/excel;charset=UTF8');
		header('Content-type: application/vnd.ms-excel');
		$filename = 'products_report'.date('ymd_h_i').'.xls';
		header('Content-Disposition: attachment; filename='.$filename);


		
		$iSearch = [];
		// $searchKey = $_POST['search'];
		// $columns = $_POST['columns'];
		// $order = $_POST['order'];
		// $orderBy = $columns[$order[0]['column']]['data'].' '.$order[0]['dir'];

		$iSearch_str = '';
		// if (!empty($searchKey['value'])) {
		// 	foreach ($columns as $row) {
		// 		if (!empty($row['data'] && $row['searchable']=='true')) {
		// 			if(in_array($row['data'],['product_id','title','description'])){
		// 				$row['data'] = "products_translation.".$row['data'];
		// 			}
		// 			if($row['data']=='status'){
		// 				$row['data'] = "products.".$row['data'];
		// 			}
		// 			if($row['data']=='category_names'){
		// 				$row['data'] = "t4.title";
		// 			}
		// 			$iSearch[] = " " . $row['data'] . " LIKE '%" . $searchKey['value'] . "%' ";
		// 		}
		// 	}
		// 	$iSearch_str = implode(' OR ', $iSearch);
		// }

		$filter = array();

		if(isset($_POST['filter'])){
			$filter = json_decode($_POST['filter'],true);
			
		}

		$filter['language_code']  = $this->request->getLocale();

		$ProductModel = new ProductModel();
		
		$data['list']=$ProductModel->getProductList($filter,$iSearch_str,0,-1,'')['data'];
		return view('admin/userManagement/excelReportTemplate',$data);
		
	}

}
