<?php

namespace App\Controllers;

use App\Models\ClientsModel;
use App\Models\ProfileModel;
use App\Models\ProfileShortlistModel;

class JobPositions extends BaseController
{

    public function index()
    {

        helper(['form', 'url']);
		
        $clientModel = new ClientsModel();
        $data = [
            'page_title' => 'Job Positions',
            'active_nav_parent' => 'job-positions',
            'active_nav' => 'job-positions',
            'clients'=>$clientModel->findAll(),
        ];

        return view('user/job-positions/index', $data);
    }


    public function applyForJob(){
        $email=$this->request->getVar('email');
        $job_position_id=$this->request->getVar('job_position_id');

        if(empty($email) || empty($job_position_id)){
            return redirect()->route('pageNotFound');
        }

        $ProfileModel = new ProfileModel();
        $profileDetails = $ProfileModel->where('email_primary',$email)->first();

        if(empty($profileDetails)){
            return redirect()->route('pageNotFound');
        }

        $message ='';
        //check profile is shorlisted or not
        $ProfileShortlistModel = new ProfileShortlistModel();

        $shortListDetails = $ProfileShortlistModel->where('job_position_id',$job_position_id)->where('profile_id',$profileDetails['id'])->first();
       
        if(empty($shortListDetails)){
            return redirect()->route('pageNotFound');
        }
        
        if($shortListDetails['applied_dt']){
            $message="You have already applied for this job.";
        }else{
            $shortListDetails['applied_dt'] = date('Y-m-d H:i:s');
            if($ProfileShortlistModel->save($shortListDetails)){
                $message="<span class='text-success'>You have successfully applied for the job.</span>";
            }else{
                $message="<span class='text-danger'>Network error!</span>";
            }
        }
       
        $data =[
            'page_title' => 'Apply for job',
            'active_nav_parent' => 'job-positions',
            'active_nav' => 'job-positions',
            'message'=>$message,
        ];

        return view('response_message',$data);
    }
    

}
