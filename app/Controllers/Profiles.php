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


	public function createJoiningForm($id=''){
		$user = checkUserToken();

		if(!$user){
			//redirct to login
			setcookie("a_token", "", time() - 3600,'/');//delete cookie
			setcookie("r_token", "", time() - 3600,'/');//delete cookie
			return redirect()->route('logout');
		}

		$data = [
			'page_title' => 'Send Joining Form',
			'active_nav_parent'=>'send-joining-form',
			'active_nav'=>'send-joining-form',
			'id'=>$id,
			'pageHeading'=>$id?"Edit Joining Form":"Add new profile"
		];
		return view('user/employee/editJoiningForm',$data);
	}

	public function edit($id){

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

	public function joiningFormVerification($email='')
	{


		helper(['form', 'url']);
		$session = session();

		if ($session->get('employee_joining_form_id')) {
			$session->get('employee_joining_form_id');
			//redirect
			return redirect()->to(base_url(route_to('employeeJoiningForm')));
		}
		$data = [
			'page_title' => 'Joining Form',
			'active_nav_parent' => 'send-joining-form',
			'active_nav' => 'send-joining-form',
			'pageHeading' => "Joining Form",
			'email'=>$email?base64_decode($email):''
		];
		$employeeDetails = null;


		$model = new EmployeeJoinigDetailsModel();




		if ($_POST) {
			$input = $this->validate([
				'email' => ['label' => 'email', 'rules' => 'required|valid_email'],
				'aadhar_pan_number' => ['label' => 'Aadhar/PAN Number', 'rules' => 'required|exact_length[12,10]'],
				'verification_code' => ['label' => 'Verification Code', 'rules' => 'required|exact_length[8]'],
			]);

			if (!$input) {
				$data['validation'] = $this->validator;
			} else {
				//get employee details
				$employeeDetails = $model->verifyJoinigForm(
					$this->request->getPost('email'),
					$this->request->getPost('aadhar_pan_number'),
					$this->request->getPost('verification_code')
				);

				if (empty($employeeDetails)) {
					$data['error_message'] = <<<'EOD'
<div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
Joinig form Details not found.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
EOD;
				} else {
					//set session
					// print_r($employeeDetails);

					$employee_joining_form_id = $employeeDetails->id;
					$session->set('employee_joining_form_id', $employee_joining_form_id);

					$session->get('employee_joining_form_id');
					//redirect
					return redirect()->to(base_url(route_to('employeeJoiningForm')));
				}
			}
		}




		return view('employee_joining_form_verification', $data);
	}

	public function downloadJoiningForm($joinigFormId)
	{
		$user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		//get joining form details by id
		$model = new EmployeeJoinigDetailsModel();
		$joiningFormDetails = (array)$model->find($joinigFormId);
		$joiningFormDetails['employee_other_details'] = $joiningFormDetails['employee_other_details']?(array)json_decode($joiningFormDetails['employee_other_details']):null;
		$joiningFormDetails['education_qualification'] = $joiningFormDetails['education_qualification']?(array)json_decode($joiningFormDetails['education_qualification']):null;
		$joiningFormDetails['professional_qualification'] = $joiningFormDetails['professional_qualification']?(array)json_decode($joiningFormDetails['professional_qualification']):null;
		$joiningFormDetails['employment_history'] = $joiningFormDetails['employment_history']?(array)json_decode($joiningFormDetails['employment_history']):null;
		$joiningFormDetails['background_info'] = $joiningFormDetails['background_info']?(array)json_decode($joiningFormDetails['background_info']):null;
		$dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('pdf-templates/joining-form',['joiningFormDetails'=>$joiningFormDetails]));
		$dompdf->setPaper('A4', 'p');
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->render();
		$canvas = $dompdf->get_canvas();
     	$canvas->page_text(512, 820, "Page: {PAGE_NUM} of {PAGE_COUNT}",'', 8, array(0,0,0)); 
        $dompdf->stream("joining_form.pdf",array("Attachment" => 0));
		// $dompdf->output(); 
	}


	public function emailTest()
	{
	}
}
