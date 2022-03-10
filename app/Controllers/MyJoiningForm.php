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


class MyJoiningForm extends BaseController{

    public function index(){
        helper(['form', 'url']);
        $user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

        
        //get joining form details
        // $joingFormId = $session->get('employee_joining_form_id');
        $model = new EmployeeJoinigDetailsModel();
        $joiningFormDetails = $model->where('user_id',$user['id'])->first();

        $data = [
            'page_title' => 'Joining Form',
            'active_nav_parent' => 'forms',
            'active_nav' => 'forms',
            'id'=> $joiningFormDetails['id'],
            'joiningFormDetails'=> $joiningFormDetails,
        ];
       
        if($joiningFormDetails['is_accept_declaration'] && $joiningFormDetails['status'] =='1' ){
          // $session->remove('employee_joining_form_id');
           return view('employee_joining_form_success', $data);
        }

        return view('user/profiles/my-joining-form', $data);
    }
}