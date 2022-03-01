<?php

namespace App\Controllers;


use App\Models\ProfileModel;

class Home extends BaseController
{
	public function index()
	{

		$user = checkUserToken();
		$session = session();
		if($user){
			//redirct to dashboard	
			return redirect()->route('user-dashboard');
		}else if ($session->get('employee_joining_form_id')) {
			return redirect()->route('employeeJoiningForm');
		}else if( $session->get('profile_id')){
			return redirect()->route('createMyProfile');
		}
		
		$data = [
			'page_title' => 'Home',
			'active_nav' => 'home'
		];
		 
		return view('home', $data);
	}

	public function aboutUs()
	{
		$data = [
			'page_title' => 'About Us',
			'active_nav' => 'about-us'
		];
		return view('about-us', $data);
	}
	public function contactUs()
	{
		$data = [
			'page_title' => 'Contact Us',
			'active_nav' => 'contact-us'
		];
		


		return view('contact-us', $data);
	}
	public function faq()
	{
		$data = [
			'page_title' => 'FAQ',
			'active_nav' => 'faq'
		];
		return view('faq', $data);
	}
	public function comingSoon()
	{
		$data = [
			'page_title' => 'Coming Soon',
			'active_nav' => 'coming-soon'
		];
		return view('coming-soon', $data);
	}
	public function privacyPolicy()
	{
		$data = [
			'page_title' => 'Privacy Policy',
			'active_nav' => 'privacy-policy'
		];
		return view('privacy-policy', $data);
	}
	public function localVocal()
	{
		$data = [
			'page_title' => 'Local Ke Liye Vocal',
			'active_nav' => 'local-vocal'
		];
		return view('local-vocal', $data);
	}

	public function emailTest()
	{

		//return view('email-templates/shortlist-candidate');
		// $email = \Config\Services::email();

		// $config['protocol'] = 'sendmail';
		// $config['mailPath'] = '/usr/sbin/sendmail';
		// $config['charset']  = 'iso-8859-1';
		// $config['wordWrap'] = true;

		// $email->initialize($config);

		// $email->setFrom('someshbadade@gmail.com', 'Someshwar');
		// $email->setTo(['someshwar@essensys.co.in', 'someshbadade@gmail.com']);
		// // $email->setCC('another@another-example.com');
		// // $email->setBCC('them@their-example.com');

		// $email->setSubject('Email Test 2');
		// $email->setMessage('Testing the email class.');

		// echo	$email->send();

		// $email->printDebugger(['headers']);

			echo "hi testing|||";

			$ProfileModel = new ProfileModel();

			foreach($ProfileModel->findAll() as $row){

				$row['primary_skills_soundex'] = convertStringToSoundex($row['primary_skills'] ," || ");
				$row['secondary_skills_soundex'] = convertStringToSoundex($row['secondary_skills'] ," || ");
				$row['foundation_skills_soundex'] = convertStringToSoundex($row['foundation_skills'] ," || ");
				$ProfileModel->save($row);
			}

	}
	public function phpEmailTest()
	{
	

		$array1 =[
			"id"=>"1",
			"name"=>"someshwar",
			"dob"=>"1986-08-11",
			"lang"=>[
				"en"=>["title"=>"text1","desc"=>'desc1'],
				"gu"=>["title"=>"text2","desc"=>'desc2'],
				"hi"=>["title"=>"text3","desc"=>'desc3'],
			]

		];

		$array2 =[
			"id"=>"1",
			"name"=>"someshwar m badade",
			"dob"=>"1986-08-11",
			"lang"=>[
				"en"=>["title"=>"text11","desc"=>'desc11'],
				"gu"=>["title"=>"text2","desc"=>'desc2'],
				"hi"=>["title"=>"text3","desc"=>'desc33'],
			]

		];

		

		function array_diff_assoc_recursive($array1, $array2) {
			$difference=array();
			foreach($array1 as $key => $value) {
				if( is_array($value) ) {
					if( !isset($array2[$key]) || !is_array($array2[$key]) ) {
						$difference[$key] = $value;
					} else {
						$new_diff = array_diff_assoc_recursive($value, $array2[$key]);
						if( !empty($new_diff) )
							$difference[$key] = $new_diff;
					}
				} else if( !array_key_exists($key,$array2) || $array2[$key] !== $value ) {
					$difference[$key] = $value;
				}
			}
			return $difference;
		}

		print_r(array_diff_assoc_recursive($array1, $array2));
		
	}

	public function pageNotFound(){
		return view('errors/html/error_404');
	}
}
