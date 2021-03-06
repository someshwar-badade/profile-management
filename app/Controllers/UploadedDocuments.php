<?php

namespace App\Controllers;



class UploadedDocuments extends BaseController
{
	public function index($folderName, $fileName)
	{

		$user = checkUserToken();

		$isUserLoggedin = false;
		$session = session();
		$documentAccess = '';
		if(strpos($folderName, "form") !== false){
			//joining form
			$documentAccess ='joining_form';
		}
		if(strpos($folderName, "profile") !== false){
			//joining form
			$documentAccess ='profile';
		}
		 

		if(!empty($session->get('employee_joining_form_id'))){
			$isUserLoggedin = true;
		}
		if(!empty($session->get('profile_id'))){
			$isUserLoggedin = true;
		}
		if(!empty($user)){
			$isUserLoggedin = true;
		}
		
		

			if (empty($session->get('employee_joining_form_id')) && !$isUserLoggedin) {
				//redirect
				return redirect()->to(base_url(route_to('joiningFormVerification2')));
				exit();
			}
			if (empty($session->get('profile_id')) && !$isUserLoggedin) {
				//redirect
				return redirect()->to(base_url(route_to('createMyProfile')));
				exit();
			}

			if (!$user && !$isUserLoggedin) {
				//redirct to login
				setcookie("a_token", "", time() - 3600, '/'); //delete cookie
				setcookie("r_token", "", time() - 3600, '/'); //delete cookie
				return redirect()->route('logout');
				exit();
			}
		
		
		if($session->get('employee_joining_form_id') && $documentAccess=='joining_form'){
			$folderName = "form_".$session->get('employee_joining_form_id');
		}

		if($session->get('profile_id') && $documentAccess=='profile'){
			$folderName = "profile_".$session->get('profile_id');
		}


		if (preg_match('^[A-Za-z0-9]{2,32}+[.]{1}[A-Za-z]{3,4}$^', $fileName)) // validation
		{
			
			if($documentAccess=='joining_form'){
				$file = DOCUMENTS_PATH . $folderName.'/'. $fileName;
			}else if($documentAccess=='profile'){
				$file = PROFILE_DOCUMENTS_PATH . $folderName.'/'. $fileName;
			}else{
				$file = DOCUMENTS_PATH . $folderName.'/'. $fileName;
			}

			

			if (file_exists($file)) // check the file is existing 
			{
				// header('Content-Description: File Transfer');
				// header('Content-Type: application/octet-stream');
				header('Content-Type: '.mime_content_type($file));
				// header('Content-Disposition: attachment; filename=' . basename($file));
				header('Content-Disposition: inline; filename=' . basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
				exit;
				readfile($file);
			} else {
				return redirect()->route('pageNotFound');
				
			}
		}
	}

	public function profile($folderName, $fileName)
	{

		
	}
}
