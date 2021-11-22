<?php

namespace App\Controllers;



class UploadedDocuments extends BaseController
{
	public function index($folderName, $fileName)
	{

		$user = checkUserToken();

		$session = session();

		if (empty($session->get('employee_joining_form_id')) && empty($user)) {
			if (empty($session->get('employee_joining_form_id'))) {
				//redirect
				return redirect()->to(base_url(route_to('joiningFormVerification2')));
			}

			if (!$user) {
				//redirct to login
				setcookie("a_token", "", time() - 3600, '/'); //delete cookie
				setcookie("r_token", "", time() - 3600, '/'); //delete cookie
				return redirect()->route('logout');
			}
		}

		if($session->get('employee_joining_form_id')){
			$folderName = "form_".$session->get('employee_joining_form_id');
		}


		if (preg_match('^[A-Za-z0-9]{2,32}+[.]{1}[A-Za-z]{3,4}$^', $fileName)) // validation
		{
			$file = DOCUMENTS_PATH . $folderName.'/'. $fileName;
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
}
