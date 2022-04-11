<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\EmployeeJoinigDetailsModel;
use App\Models\EducationQualificationModel;
use App\Models\GapDeclarationModel;
use App\Models\MediclaimModel;
use App\Models\ProfessionalQualificationModel;
use App\Models\ProfileModel;
use App\Models\ProfileEducationQualificationModel;
use App\Models\ProfileProfessionalQualificationModel;
use Firebase\JWT\JWT;
use Exception;

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
		if (!hasCapability('profiles/view')) {
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error', $data);
		}

		$ProfileModel = new ProfileModel();
		$data['statuseWiseCount'] = $ProfileModel->statusWiseCount();

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
		if (!hasCapability('profiles/add')) {
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error', $data);
		}
		return view('user/profiles/add-profile', $data);
	}


	public function createJoiningForm($id = '')
	{
		$user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		$model = new EmployeeJoinigDetailsModel();
		$joiningFormDetails = [];
		if ($id) {

			$joiningFormDetails = (array)$model->find($id);
		}
		$data = [
			'page_title' => 'Send Joining Form',
			'active_nav_parent' => 'send-joining-form',
			'active_nav' => 'send-joining-form',
			'id' => $id,
			'joiningFormDetails' => $joiningFormDetails,
			'pageHeading' => $id ? "Edit Joining Form" : "Add new profile"
		];
		return view('user/employee/editJoiningForm', $data);
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

		$activeTab = $this->request->getVar('tab');
		$tabsArray = ["employeeDetails", "educationalQualifications", "employmentHistory", "uploadDocuments", "jobPositions"];
		$data = [
			'page_title' => 'Profiles',
			'active_nav_parent' => 'profiles',
			'active_nav' => 'profiles',
			'id' => $id,
			'activeTab' => in_array($activeTab, $tabsArray) ? $activeTab : 'employeeDetails'
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
			'page_title' => 'Joining Form',
			'active_nav_parent' => 'send-joining-form',
			'active_nav' => 'send-joining-form',
			'pageHeading' => "Joining Form",
			'profile' => []
		];

		if (!hasCapability('joining_form/view')) {
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error', $data);
		}

		if (isset($_GET['profile_id'])) {

			$profileModel = new ProfileModel();
			$data['profile'] = $profileModel->find($_GET['profile_id']);
		}

		return view('user/employee/sendJoiningForm', $data);
	}

	public function joiningFormVerification($email = '')
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
			'email' => $email ? base64_decode($email) : ''
		];
		$employeeDetails = null;


		$model = new EmployeeJoinigDetailsModel();




		if ($_POST) {
			$input = $this->validate([
				'email' => ['label' => 'email', 'rules' => 'required|valid_email', 'errors' => ['required' => "Enter a valid E-mail.", 'valid_email' => "Enter a valid E-mail."]],
				'aadhar_pan_number' => ['label' => 'Aadhar/PAN Number', 'rules' => 'required|exact_length[12,10]', 'errors' => ['required' => "Enter a valid Aadhar/PAN number.", 'exact_length' => "Enter a valid Aadhar/PAN number."]],
				'verification_code' => ['label' => 'Verification Code', 'rules' => 'required|exact_length[8]', 'errors' => ['required' => "Enter a valid verification code.", 'exact_length' => "Enter a valid verification code."]],
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
Please enter correct details.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
EOD;
				} else {
					//set session
					// print_r($employeeDetails);die;

					$employee_joining_form_id = $employeeDetails->id;
					$session->set('employee_joining_form_id', $employee_joining_form_id);
					$session->set('employee_name', $employeeDetails->first_name);
					$session->set('employee_last_name', $employeeDetails->last_name);

					$session->get('employee_joining_form_id');
					//redirect
					return redirect()->to(base_url(route_to('employeeJoiningForm')));
				}
			}
		}




		return view('employee_joining_form_verification', $data);
	}



	public function _downloadJoiningForm($joinigFormId)
	{
		
		//get joining form details by id
		$model = new EmployeeJoinigDetailsModel();
		$educationModel = new EducationQualificationModel();
		$gapDeclarationModel = new GapDeclarationModel();
		$mediclaimModel = new MediclaimModel();
		$professionalQualificationModel = new ProfessionalQualificationModel();
		$joiningFormDetails = (array)$model->find($joinigFormId);
	
		
		$joiningFormDetails['employee_other_details'] = $joiningFormDetails['employee_other_details'] ? (array)json_decode($joiningFormDetails['employee_other_details']) : null;
		$joiningFormDetails['education_qualification'] = $educationModel->where('joining_form_id', $joinigFormId)->find();
		$joiningFormDetails['gap_declaration'] = $gapDeclarationModel->where('joining_form_id', $joinigFormId)->find();
		$joiningFormDetails['mediclaim'] = $mediclaimModel->where('joining_form_id', $joinigFormId)->find();
		$joiningFormDetails['professional_qualification'] = $professionalQualificationModel->where('joining_form_id', $joinigFormId)->find();
		// $joiningFormDetails['education_qualification'] = $joiningFormDetails['education_qualification']?(array)json_decode($joiningFormDetails['education_qualification']):null;
		// $joiningFormDetails['professional_qualification'] = $joiningFormDetails['professional_qualification']?(array)json_decode($joiningFormDetails['professional_qualification']):null;
		$joiningFormDetails['employment_history'] = $joiningFormDetails['employment_history'] ? (array)json_decode($joiningFormDetails['employment_history']) : null;
		$joiningFormDetails['background_info'] = $joiningFormDetails['background_info'] ? (array)json_decode($joiningFormDetails['background_info']) : null;
		$dompdf = new \Dompdf\Dompdf();
		$dompdf->loadHtml(view('pdf-templates/joining-form', ['joiningFormDetails' => $joiningFormDetails]));
		
		$dompdf->setPaper('A4', 'p');
		$dompdf->set_option('isRemoteEnabled', true);
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(512, 820, "Page: {PAGE_NUM} of {PAGE_COUNT}", '', 8, array(0, 0, 0));
		$filename = strtolower(str_replace(' ', '_', $joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name']));
		$dompdf->stream($filename . "_joining_form.pdf");
		
	}

	public function downloadJoiningForm($joiningFormId)
	{
		$user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		$this->_downloadJoiningForm($joiningFormId);

		// $dompdf->output(); 
	}

	public function downloadMyProfile()
	{



		$profileId = null;

		$user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}



		$model = new ProfileModel();
		$educationModel = new ProfileEducationQualificationModel();
		$professionalQualificationModel = new ProfileProfessionalQualificationModel();

		$profileDetails = $model->where('user_id', $user['id'])->first();
		$profileId = $profileDetails['id'];
		$profileDetails['education_qualification'] = $educationModel->where('profile_id', $profileId)->find();
		$profileDetails['professional_qualification'] = $professionalQualificationModel->where('profile_id', $profileId)->find();
		$profileDetails['employment_history'] = $profileDetails['employment_history'] ? (array)json_decode($profileDetails['employment_history'], true) : [];
		$profileDetails['documents'] = $profileDetails['documents'] ? (array)json_decode($profileDetails['documents'], true) : [];

		if (!empty($profileDetails['preferred_work_locations'])) {
			$profileDetails['preferred_work_locations'] = explode(' || ', $profileDetails['preferred_work_locations']);
		} else {
			$profileDetails['preferred_work_locations'] = [];
		}
		if (!empty($profileDetails['primary_skills'])) {
			$profileDetails['primary_skills'] = explode(' || ', $profileDetails['primary_skills']);
		} else {
			$profileDetails['primary_skills'] = [];
		}

		if (!empty($profileDetails['secondary_skills'])) {
			$profileDetails['secondary_skills'] = explode(' || ', $profileDetails['secondary_skills']);
		} else {
			$profileDetails['secondary_skills'] = [];
		}

		if (!empty($profileDetails['foundation_skills'])) {
			$profileDetails['foundation_skills'] = explode(' || ', $profileDetails['foundation_skills']);
		} else {
			$profileDetails['foundation_skills'] = [];
		}

		$profileDetails['total_experience_y'] = floor($profileDetails['total_experience'] / 12);
		$profileDetails['total_experience_m'] = (int)$profileDetails['total_experience'] % 12;
		$profileDetails['relevant_experience_y'] = floor($profileDetails['relevant_experience'] / 12);
		$profileDetails['relevant_experience_m'] = (int)$profileDetails['relevant_experience'] % 12;

		$dompdf = new \Dompdf\Dompdf();
		// echo view('pdf-templates/profile',['joiningFormDetails'=>$profileDetails]);die;
		$dompdf->loadHtml(view('pdf-templates/profile', ['joiningFormDetails' => $profileDetails]));
		$dompdf->setPaper('A4', 'p');
		$dompdf->set_option('isRemoteEnabled', true);
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(512, 820, "Page: {PAGE_NUM} of {PAGE_COUNT}", '', 8, array(0, 0, 0));
		$filename = strtolower(str_replace(' ', '_', $profileDetails['first_name'] . ' ' . $profileDetails['last_name']));
		$dompdf->stream($filename . "_profile.pdf");
	}

	public function downloadMyResume()
	{



		$profileId = null;

		$user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		$systemFonts = ["Arial","Helvetica Neue","Courier New","Times New Roman","Comic Sans MS","Verdana","Impact"];
		$template = isset($_GET['template'])?$_GET['template']:"template1";
		$ts1 = isset($_GET['ts1'])?$_GET['ts1']:"";
		$ts2 = isset($_GET['ts2'])?$_GET['ts2']:"";
		$ts3 = isset($_GET['ts3'])?$_GET['ts3']:"";
		$ts4 = isset($_GET['ts4'])?$_GET['ts4']:"";
		$ts5 = isset($_GET['ts5'])?$_GET['ts5']:"";
		$ts6 = isset($_GET['ts6'])?$_GET['ts6']:"";
		$colorPrimary = isset($_GET['colorPrimary'])?"#".$_GET['colorPrimary']:"";
		$colorSecondary = isset($_GET['colorSecondary'])?"#".$_GET['colorSecondary']:"";
		$skillsStyle = isset($_GET['skillsStyle'])?$_GET['skillsStyle']:"";
		$sections = isset($_GET['sections'])?explode("_",$_GET['sections']):['WE','ED','CC'];
		$font = isset($_GET['font'])?$_GET['font']:"";
		$fontFamily = isset($_GET['fontFamily'])?$_GET['fontFamily']:"";
		if(in_array($fontFamily,$systemFonts)){
			$configStyle['fontFamilyUrl'] = base_url("/assets/fonts/pdf/system-fonts.css");
		}else{
			$configStyle['fontFamilyUrl'] = "https://fonts.googleapis.com/css2?family=".$fontFamily;
		}
		$configStyle['colorPrimary']=$colorPrimary;
		$configStyle['colorSecondary']=$colorSecondary;
		$configStyle['skillsStyle']=$skillsStyle;
		$configStyle['font']=$font;
		$configStyle['fontFamily']=$fontFamily;
		$configStyle['sections']=$sections;
		$configStyle['ts1']=$ts1;
		$configStyle['ts2']=$ts2;
		$configStyle['ts3']=$ts3;
		$configStyle['ts4']=$ts4;
		$configStyle['ts5']=$ts5;
		$configStyle['ts6']=$ts6;


		$model = new ProfileModel();
		$educationModel = new ProfileEducationQualificationModel();
		$professionalQualificationModel = new ProfileProfessionalQualificationModel();

		$profileDetails = $model->where('user_id', $user['id'])->first();
		$profileId = $profileDetails['id'];
		$profileDetails['education_qualification'] = $educationModel->where('profile_id', $profileId)->find();
		$profileDetails['professional_qualification'] = $professionalQualificationModel->where('profile_id', $profileId)->find();
		$profileDetails['employment_history'] = $profileDetails['employment_history'] ? (array)json_decode($profileDetails['employment_history'], true) : [];
		$profileDetails['documents'] = $profileDetails['documents'] ? (array)json_decode($profileDetails['documents'], true) : [];

		if (!empty($profileDetails['preferred_work_locations'])) {
			$profileDetails['preferred_work_locations'] = explode(' || ', $profileDetails['preferred_work_locations']);
		} else {
			$profileDetails['preferred_work_locations'] = [];
		}
		if (!empty($profileDetails['primary_skills'])) {
            // $profileDetails['primary_skills'] = explode(' || ', $profileDetails['primary_skills']);
            $profileDetails['primary_skills'] = json_decode($profileDetails['primary_skills'], true);
        } else {
            $profileDetails['primary_skills'] = [];
        }

        if (!empty($profileDetails['secondary_skills'])) {
            // $profileDetails['secondary_skills'] = explode(' || ', $profileDetails['secondary_skills']);
            $profileDetails['secondary_skills'] = json_decode($profileDetails['secondary_skills'], true);
        } else {
            $profileDetails['secondary_skills'] = [];
        }

        if (!empty($profileDetails['foundation_skills'])) {
            // $profileDetails['foundation_skills'] = explode(' || ', $profileDetails['foundation_skills']);
            $profileDetails['foundation_skills'] = json_decode($profileDetails['foundation_skills'], true);
        } else {
            $profileDetails['foundation_skills'] = [];
        }

		$profileDetails['total_experience_y'] = floor($profileDetails['total_experience'] / 12);
		$profileDetails['total_experience_m'] = (int)$profileDetails['total_experience'] % 12;
		$profileDetails['relevant_experience_y'] = floor($profileDetails['relevant_experience'] / 12);
		$profileDetails['relevant_experience_m'] = (int)$profileDetails['relevant_experience'] % 12;

		$dompdf = new \Dompdf\Dompdf();
		// echo view('pdf-templates/resume/'.$template,['joiningFormDetails'=>$profileDetails,'config'=>$configStyle]);die;
		$dompdf->loadHtml(view('pdf-templates/resume/'.$template, ['joiningFormDetails' => $profileDetails,'config'=>$configStyle]));
		$dompdf->setPaper('A4', 'p');
		$dompdf->set_option('isRemoteEnabled', true);
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(512, 820, "Page: {PAGE_NUM} of {PAGE_COUNT}", '', 8, array(0, 0, 0));
		$filename = strtolower(str_replace(' ', '_', $profileDetails['first_name'] . ' ' . $profileDetails['last_name']));
		$dompdf->stream($filename . "_resume.pdf",array("Attachment" => false));
	}

	public function downloadPrejoiningDocuments($documentName, $joinigFormId)
	{
		$model = new EmployeeJoinigDetailsModel();
		$joiningFormDetails = (array)$model->find($joinigFormId);

		$documentList = ['infosys-equipment-agreement', 'infosys-mandatory-ASHI-india', 'infosys-information-security-awareness-acknowledgement', 'infosys-personal-data-nda'];
		if (!in_array($documentName, $documentList) || empty($joiningFormDetails)) {
			return redirect()->route('pageNotFound');
		}
		$joiningFormDetails['employee_other_details'] = $joiningFormDetails['employee_other_details'] ? (array)json_decode($joiningFormDetails['employee_other_details']) : null;
		$dompdf = new \Dompdf\Dompdf();
		// echo view('pdf-templates/joining-form',['joiningFormDetails'=>$joiningFormDetails]);die;
		$dompdf->loadHtml(view('pdf-templates/' . $documentName, ['joiningFormDetails' => $joiningFormDetails]));
		$dompdf->setPaper('A4', 'p');
		$dompdf->set_option('isRemoteEnabled', true);
		$dompdf->render();
		$filename = strtolower(str_replace(' ', '_', $joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'] . '_' . $documentName));
		$dompdf->stream($filename . "_joining_form.pdf");
	}

	public function downloadMyResumePreview(){

		$data = [
			'page_title' => 'Profiles',
			'active_nav_parent' => 'profiles',
			'active_nav' => 'profiles',
		];

		return view("user/profiles/resume-preview",$data);
	}

	public function cv()
	{
		// $dompdf = new \Dompdf\Dompdf();
		// 	echo view('pdf-templates/cv');die;
		// 	$dompdf->loadHtml(view('pdf-templates/cv'));
		// 	$dompdf->setPaper('A4', 'p');
		// 	$dompdf->set_option('isRemoteEnabled', true);
		// 	$dompdf->render();
		// 	$filename = strtolower("someshwar_badade_cv.pdf");
		// 	$dompdf->stream($filename);
		return;
	}

	public function downloadMyJoiningForm($token = '')
	{

		
		$userId = -1;
		try {
			if (!empty($token)) {
				$payload = JWT::decode($token, JWT_SECRETE_KEY, ['HS256']);
				$joiningFormId = $payload->joiningFormId;
			} else {
				$user = checkUserToken();

				if (!$user) {
					//redirct to login
					setcookie("a_token", "", time() - 3600, '/'); //delete cookie
					setcookie("r_token", "", time() - 3600, '/'); //delete cookie
					return redirect()->route('logout');
				}
				
				$EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
				$joiningFormDetails = $EmployeeJoinigDetailsModel->where('user_id',$user['id'])->first();
				$joiningFormId = $joiningFormDetails['id'];
			}
			
			if(empty($joiningFormId)){
				return redirect()->route('pageNotFound');
			}
			
		
			$this->_downloadJoiningForm($joiningFormId);
			


		} catch (Exception $e) {
			
			return redirect()->route('pageNotFound');
		}
	}

	public function emailTest()
	{
		$templateData = [
			'first_name' => "Someshwar",
			'job_title' => "Sr Software Developer",
			'experience' => "2-5 Years",
			'apply_now_link' => base_url('apply-for-job?email=somesh@bitstringit.in&job_position_id=1'),
			'primary_skills' => "PHP, MySql, Java, jQuery, Git",
			'secondary_skills' => "Python, SVN, HTML, Javascript",
		];

		$message = view('email-templates/shortlist-candidate', $templateData);
		echo	sendEmail_common('somesh@bitstringit.in', $message, 'BitStringIT - Joining Form');
	}

	public function createMyProfile($token = '')
	{

		$user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		helper(['form', 'url']);
		$data = [
			'page_title' => 'My Profile',
			'active_nav_parent' => 'my-profile',
			'active_nav' => 'my-profile',
			'pageHeading' => "My Profile",
			'profileDetails' => [],
			'messageSuccess' => null,
			'email' => '',
		];
		$model = new ProfileModel();
		$profileDetails = [];
		$session = session();

		//redirect is session is set
		if ($user['id']) {
			$profileDetails = $model->where('user_id', $user['id'])->first();
			$data['profileDetails'] = $profileDetails;
			return view('user/profiles/my-profile', $data);
		}

		if ($_POST && $this->request->getPost('verify') == '') {
			//validation
			$input = $this->validate([
				'email' => ['label' => 'E-mail', 'rules' => 'required|valid_email', 'errors' => ['required' => "Enter a valid E-mail.", 'valid_email' => "Enter a valid E-mail."]],
				//	'first_name' => ['label' => 'First Name', 'rules' => 'required','errors'=>['required'=>"Enter a first name."]],
				//	'last_name' => ['label' => 'Last Name', 'rules' => 'required','errors'=>['required'=>"Enter a last name."]],
				//'verification_code' => ['label' => 'Verification Code', 'rules' => 'required|exact_length[8]','errors'=>['required'=>"Enter a valid verification code.",'exact_length'=>"Enter a valid verification code."]],
			]);

			if (!$input) {
				$data['validation'] = $this->validator;
			} else {
				//check by email profile exist
				$profileDetails = $model->where('email_primary', $this->request->getPost('email'))->first();
				if (empty($profileDetails)) {
					//create new record
					$model->insert([
						//	'first_name'=>$this->request->getPost('first_name'),
						//	'last_name'=>$this->request->getPost('last_name'),
						'email_primary' => $this->request->getPost('email'),
						'status' => '0',
					]);

					$profileDetails = $model->where('email_primary', $this->request->getPost('email'))->first();
				}

				$profileDetails['verification_code'] = substr(number_format(time() * rand(), 0, '', ''), 0, 8);

				$model->save($profileDetails);

				$data['profileDetails'] = $profileDetails;

				//send email
				$templateData = [
					'first_name' => $profileDetails['first_name'],
					'verification_code' => $profileDetails['verification_code']
				];
				$message = view('email-templates/send-profile-verification-code', $templateData);
				$isEmailSent =  sendEmail_common($profileDetails['email_primary'], $message, 'Bitstringit', HR_EMAIL);

				// if ($isEmailSent) {
				// 	//Respond with 200 status code
				// 	return $this->respond(['success' => 'E-mail has been sent successfully.']);
				// }
				// return $this->fail(['errorMessage' => "E-mail sending failed please try again."], 403);

				//send verification code
				$data['messageSuccess'] = "The verification code has been sent on your e-mail.";
			}
		} else if ($_POST && $this->request->getPost('verify') == 'true') {
			//validation
			$input = $this->validate([
				// 'email' => ['label' => 'E-mail', 'rules' => 'required|valid_email','errors'=>['required'=>"Enter a valid E-mail.",'valid_email'=>"Enter a valid E-mail."]],
				//	'first_name' => ['label' => 'First Name', 'rules' => 'required','errors'=>['required'=>"Enter a first name."]],
				//	'last_name' => ['label' => 'Last Name', 'rules' => 'required','errors'=>['required'=>"Enter a last name."]],
				'verification_code' => ['label' => 'Verification Code', 'rules' => 'required|exact_length[8]', 'errors' => ['required' => "Enter 8 digit verification code.", 'exact_length' => "Enter 8 digit verification code."]],
			]);


			$profileDetails = $model->where('email_primary', $this->request->getPost('email'))->first();
			$data['profileDetails'] = $profileDetails;

			if (!$input) {
				$data['validation'] = $this->validator;
			} else {
				if ($profileDetails['verification_code'] != $this->request->getPost('verification_code')) {
					$data['messageError'] = "The verification code is invalid.";
				} else {
					// set session and redirect 
					$session->set('profile_id', $profileDetails['id']);
					$session->set('profile_first_name', $profileDetails['first_name']);
					$session->set('profile_last_name', $profileDetails['last_name']);
					$data['id'] = $profileDetails['id'];
					return view('my-profile', $data);
				}
			}
		}

		return view('my-profile-login-form', $data);
	}


	public function updateSkills(){
		$model = new ProfileModel();

		// foreach($model->findAll() as $p){
		// 	$p['primary_skills'] = $this->converSkills($p['primary_skills']);	
		// 	$p['secondary_skills'] = $this->converSkills($p['secondary_skills']);	
		// 	$p['foundation_skills'] = $this->converSkills($p['foundation_skills']);	

		// 	$model->Save($p);
		// }
		die;
	}

	public function converSkills($skills){
		$skills = explode(" || ",$skills);
		$result = [];
		foreach($skills as $skill){

			$temp = [
				'text'=>$skill,
				'rating'=>0,
			];
			$result[]=$temp;
		}

		return json_encode($result);
	}

}
