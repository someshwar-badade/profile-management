<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\EmployeeJoinigDetailsModel;

class Profiles extends BaseController
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
			'active_nav_parent' => 'profiles',
			'active_nav' => 'profiles',
		];

		return view('user/profiles/index', $data);
	}
	public function create($id = '')
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
			'active_nav_parent' => 'profiles',
			'active_nav' => 'profiles',
			'id' => $id,
			'pageHeading' => $id ? "Edit Profile" : "Add new profile"
		];
		return view('user/profiles/add-profile', $data);
	}

	public function edit($id)
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
			'active_nav_parent' => 'profiles',
			'active_nav' => 'profiles',
		];
		return view('user/profiles/edit-profile', $data);
	}

	public function sendJoiningForm()
	{
		$user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		$data = [
			'page_title' => 'Send Joining Form',
			'active_nav_parent' => 'send-joining-form',
			'active_nav' => 'send-joining-form',
			'pageHeading' => "Send Joining Form"
		];
		return view('user/employee/sendJoiningForm', $data);
	}

	public function joiningFormVerification($email)
	{

		helper(['form', 'url']);
		$session = session();

		if ($session->get('employee_joining_form_id')) {
			$session->get('employee_joining_form_id');
			//redirect
			return redirect()->to(base_url());
		}
		$data = [
			'page_title' => 'Joining Form',
			'active_nav_parent' => 'send-joining-form',
			'active_nav' => 'send-joining-form',
			'pageHeading' => "Joining Form"
		];
		$employeeDetails = null;


		$model = new EmployeeJoinigDetailsModel();




		if ($_POST) {
			$input = $this->validate([
				'aadhar_pan_number' => ['label' => 'Aadhar/PAN Number', 'rules' => 'required|exact_length[12,10]'],
				'verification_code' => ['label' => 'Verification Code', 'rules' => 'required|exact_length[8]'],
			]);

			if (!$input) {
				$data['validation'] = $this->validator;
			} else {
				//get employee details
				$employeeDetails = $model->verifyJoinigForm(
					base64_decode($email),
					$this->request->getPost('aadhar_pan_number'),
					$this->request->getPost('verification_code')
				);

				if (empty($employeeDetails)) {
					$data['error_message'] = <<<EOT
						<div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
						Joinig form Details not found.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						EOT;
				} else {
					//set session
					// print_r($employeeDetails);

					$employee_joining_form_id = $employeeDetails->id;
					$session->set('employee_joining_form_id', $employee_joining_form_id);

					$session->get('employee_joining_form_id');
					//redirect
					return redirect()->to(base_url());
				}
			}
		}




		return view('employee_joining_form_verification', $data);
	}



	public function emailTest()
	{

		$email = \Config\Services::email();

		// $config['protocol'] = 'smtp';
		// $config['SMTPHost'] = 'mail.bitstringit.in';
		// $config['SMTPUser'] = 'somesh@bitstringit.in';
		// $config['SMTPPass'] = 'Someshwar@123';
		// $config['SMTPPort'] = '465';

		// $email->initialize($config);

		//     $email->setFrom('someshbadade@gmail.com', 'Someshwar');
		//     $email->setTo('somesh@bitstringit.in');

		//     $email->setSubject('Email Test');
		//     $email->setMessage('Testing the email class.');

		//   echo  $email->send();
		// $message = view('email-templates/send-joining-form-link',['first_name'=>'someshwar','link'=>'http://bitstringit.in','verification_code'=>'123456']);
		// echo sendEmail_common('someshbadade@gmail.com',$message,'Bitstringit - Verification code');
		//   die;
	}
}
