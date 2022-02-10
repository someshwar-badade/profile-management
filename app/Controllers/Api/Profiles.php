<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProfileModel;
use App\Models\ProfileEducationQualificationModel;
use App\Models\ProfileProfessionalQualificationModel;
use App\Models\UserModel;
use App\Models\EmployeeJoinigDetailsModel;
use App\Models\EducationQualificationModel;
use App\Models\ProfessionalQualificationModel;
use App\Models\EmploymentHistoryModel;
use App\Models\GapDeclarationModel;
use App\Models\MediclaimModel;
use App\Models\SkillsModel;
use App\Models\JobPositionModel;
use DateTime;
use Firebase\JWT\JWT;

class Profiles extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];
    // get all animal details
    public function index()
    {
        ini_set('display_errors', 1);
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new ProfileModel();

        $draw = (int)$this->request->getVar('draw');
        $start = (int)$this->request->getVar('start');
        $length = (int)$this->request->getVar('length');
        $jobPositionId = (int)$this->request->getVar('job_position_id');
        $shortlisted = $this->request->getVar('shortlisted');

        $jobPositionModel = new JobPositionModel();
        $jobPositionDetails = '';
        if ($jobPositionId) {
            $jobPositionDetails = $jobPositionModel->find($jobPositionId);
        }
        // $iSearch = [];
        $searchKey = $this->request->getVar('search'); //$_POST['search'];
        $columns = $this->request->getVar('columns'); // $_POST['columns'];
        $order = $this->request->getVar('order'); //$_POST['order'];
        $orderBy = $columns[$order[0]['column']]['data'] . ' ' . $order[0]['dir'];

        $iSearch_str = '';
        if (!empty($searchKey['value'])) {
            foreach ($columns as $row) {
                if (!empty($row['data'] && $row['searchable'] == 'true')) {
                    $iSearch[] = " " . $row['data'] . "  LIKE '%" . $searchKey['value'] . "%' ";
                }
            }

            $iSearch[] = " `candidate_name`  LIKE '%" . $searchKey['value'] . "%' OR  SOUNDEX(`candidate_name`) = SOUNDEX('" . $searchKey['value'] . "') ";
            $iSearch[] = " `secondary_skills` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `foundation_skills` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `certifications` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `categories` LIKE '%" . $searchKey['value'] . "%' ";

            $iSearch_str = implode(' OR ', $iSearch);
        }

        $filter = array();

        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
        }

        if ($jobPositionDetails) {
            $filter['primary_skills'] = $jobPositionDetails['primary_skills'] ? explode(" || ", $jobPositionDetails['primary_skills']) : null;
            $filter['secondary_skills'] =  $jobPositionDetails['secondary_skills'] ? explode(" || ", $jobPositionDetails['secondary_skills']) : null;
            $filter['match_primary_skills'] = $jobPositionDetails['match_primary_skills'] ? $jobPositionDetails['match_primary_skills'] : count($filter['primary_skills']);
            $filter['match_secondary_skills'] =  $jobPositionDetails['match_secondary_skills'] ? $jobPositionDetails['match_secondary_skills'] : count($filter['secondary_skills']);
            $filter['job_position_id'] = $jobPositionDetails['id'];
            $filter['shortlisted'] = !empty($shortlisted) ? true : false;
        } else {
            $filter['match_primary_skills'] = isset($filter['primary_skills']) ? count($filter['primary_skills']) : 0;
            $filter['match_secondary_skills'] = isset($filter['secondary_skills']) ? count($filter['secondary_skills']) : 0;
        }




        $data = $model->getList($filter, $iSearch_str, $start, $length, $orderBy);
        $data['jobPositionDetails'] = $jobPositionDetails;
        return $this->respond($data);
        // return $this->respond($data);
    }

    // get single animal details
    public function show($id = null)
    {
        $data = $this->gerProfileDetails($id);
        if ($data) {

            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    // create animal details
    public function create()
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        // $requestData = (array) $this->request->getJSON();
        $resumepdf = $this->request->getFile('resumepdf');
        $resumeword = $this->request->getFile('resumeword');
        $requestData =  json_decode($_POST['requestData'], true);

        $model = new ProfileModel();

        // $id= $model->insert($requestData);
        // echo $id;
        // die;
        $validation =  \Config\Services::validation();

        $rules = [
            'candidate_name' => 'required',
            'mobile_primary' => 'required|numeric',
            'email_primary' => 'required|valid_email',
            'gender' => 'required',
        ];



        $validation->setRules(
            $rules,
            [   // Errors
                'candidate_name' => [
                    'required' => "Please enter Candidate full name.",
                    'alpha_numeric' => "Candidate name must contain only alpha numeric."
                ],
                'mobile_primary' => [
                    'required' => "Please enter primary mobile number.",
                    'numeric' => "Primary mobile number must contain only numbers."
                ],
                'email_primary' => [
                    'required' => "Please enter primary email.",
                    'numeric' => "Please enter valid email."
                ],
                'gender' => [
                    'required' => "Please select gender.",
                ],



            ]
        );
        $valid = $validation->run($requestData);
        if (!$valid) {

            return $this->fail($validation->getErrors(), 400);
        }


        /*start::upload files*/
        if (isset($resumepdf)) {
            $newName = $resumepdf->getRandomName();
            $resumepdf->move(ROOTPATH . 'assets/profiles/', $newName);

            $requestData['resume_pdf'] = $newName;
            $requestData['resume_pdf_name'] = $resumepdf->getClientName();
        }
        if (isset($resumeword)) {
            $newName = $resumeword->getRandomName();
            $resumeword->move(ROOTPATH . 'assets/profiles/', $newName);

            $requestData['resume_doc'] = $newName;
            $requestData['resume_doc_name'] = $resumeword->getClientName();
        }
        /*end::upload files*/

        if (isset($requestData['preferred_work_locations'])) {
            $requestData['preferred_work_locations'] = implode(", ", $requestData['preferred_work_locations']);
        }
        if (isset($requestData['categories'])) {
            $requestData['categories'] = implode(", ", $requestData['categories']);
        }

        if (isset($requestData['primary_skills'])) {
            $requestData['primary_skills'] = implode(" || ", $requestData['primary_skills']);
        }
        if (isset($requestData['secondary_skills'])) {
            $requestData['secondary_skills'] = implode(" || ", $requestData['secondary_skills']);
        }
        if (isset($requestData['foundation_skills'])) {
            $requestData['foundation_skills'] = implode(" || ", $requestData['foundation_skills']);
        }

        if (isset($requestData['certifications'])) {
            $requestData['certifications'] = json_encode($requestData['certifications']);
        }
        if (isset($requestData['work_experience'])) {
            $requestData['work_experience'] = json_encode($requestData['work_experience']);
        }

        $requestData['created_by'] = $user['id'];
        $requestData['updated_by'] = $user['id'];

        $insert_id = $model->insert($requestData);
        // echo  $model->getLastQuery()->getQuery();
        if (isset($requestData['certifications'])) {
            $requestData['certifications'] = json_decode($requestData['certifications'], true);
        }

        if (isset($requestData['work_experience'])) {
            $requestData['work_experience'] = json_decode($requestData['work_experience'], true);
        }

        //action log
        $changed_data = $requestData;

        if ($insert_id) {
            if (!empty($changed_data)) {
                $actionLogData = [
                    'user_id' => $user['id'],
                    'action_type' => 'created',
                    'model' => 'profile',
                    'record_id' => $insert_id,
                    'chaged_data' => json_encode($changed_data)
                ];
                creatActionLog($actionLogData);
            }

            //Respond with 200 status code
            return $this->respond(['success' => 'Profile created', 'insert_id' => $insert_id]);
        }
    }

    // update animal details
    public function update($id = null)
    {


        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new ProfileModel();
        $profileDetails = $model->find($id);

        if (empty($profileDetails)) {
            return $this->fail(['messages' => 'Record not found'], 400);
        }

        $requestData =  (array) $this->request->getJSON();


        $validation =  \Config\Services::validation();

        $update = $model->update($id, $requestData);
        //action log
        $changed_data = $changed_data = array_diff_assoc((array)$requestData, (array)$profileDetails);

        if ($update) {
            if (!empty($changed_data)) {
                $actionLogData = [
                    'user_id' => $user['id'],
                    'action_type' => 'updated',
                    'model' => 'profile',
                    'record_id' => $id,
                    'chaged_data' => json_encode($changed_data)
                ];
                creatActionLog($actionLogData);
            }

            $profileDetails = $this->gerProfileDetails($id);

            //Respond with 200 status code
            return $this->respond(['success' => 'Profile updated', 'id' => $id, 'profile' => $profileDetails]);
        }

        return $this->fail(['error' => 'Record not updated'], 400);
    }

    public function getJoiningFormDetails($id)
    {


        $model = new EmployeeJoinigDetailsModel();
        $user = $model->find($id);
        // echo $user;
        // die;
        if ($user) {
            //Respond with 200 status code
            return $this->respond(['user' => $user]);
        }
        //error
        return $this->fail(['referral_id' => lang('forms.register.referralId.errorNotExist')]);
    }

    public function joiningFormList()
    {


        $model = new EmployeeJoinigDetailsModel();

        $start = (int)$this->request->getVar('start');
        $length = (int)$this->request->getVar('length');

        // $iSearch = [];
        $searchKey = $this->request->getVar('search'); //$_POST['search'];
        $columns = $this->request->getVar('columns'); // $_POST['columns'];
        $order = $this->request->getVar('order'); //$_POST['order'];
        $orderBy = $columns[$order[0]['column']]['data'] . ' ' . $order[0]['dir'];

        $iSearch_str = '';
        if (!empty($searchKey['value'])) {
            foreach ($columns as $row) {
                if (!empty($row['data'] && $row['searchable'] == 'true')) {
                    $iSearch[] = " " . $row['data'] . "  LIKE '%" . $searchKey['value'] . "%' ";
                }
            }

            // $iSearch[] = " `candidate_name`  LIKE '%" . $searchKey['value'] . "%' OR  SOUNDEX(`candidate_name`) = SOUNDEX('" . $searchKey['value'] . "') ";
            $iSearch[] = " `first_name` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `last_name` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `email_primary` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `mobile_primary` LIKE '%" . $searchKey['value'] . "%' ";

            $iSearch_str = implode(' OR ', $iSearch);
        }

        $filter = array();

        if (isset($_REQUEST['filter'])) {
            $filter = $_REQUEST['filter'];
        }

        $data = $model->getList($filter, $iSearch_str, $start, $length, $orderBy);

        return $this->respond($data);
    }

    public function sendJoiningForm()
    {


        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('joining_form/add')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $requestData = (array) $this->request->getJSON();


        $validation =  \Config\Services::validation();

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            //'father_name' => 'required',
            'email_primary' => 'required|valid_email|is_unique[employee_joining_form_details.email_primary,id,{id}]',
            'aadhar_number' => 'required|numeric|exact_length[12]',
            'pan_number' => 'required|alpha_numeric|exact_length[10]|valid_pan'
        ];


        $validation->setRules(
            $rules,
            [
                'first_name' => [
                    'required' => "Please enter First name."
                ],
                'last_name' => [
                    'required' => "Please enter Last name."
                ],
                'father_name' => [
                    'required' => "Please enter Father's name."
                ],
                'email_primary' => [
                    'required' => "Please enter E-mail.",
                    'valid_email' => "Please enter valid E-mail.",
                    'is_unique' => "E-mail already exist.",
                ],
                'aadhar_number' => [
                    'required' => "Please enter Aadhar number.",
                    'numeric' => "Please enter valid Aadhar number.",
                    'exact_length' => "Please enter valid Aadhar number.",
                ],
                'pan_number' => [
                    'required' => "Please enter PAN number.",
                    'alpha_numeric' => "Please enter valid PAN number.",
                    'exact_length' => "Please enter valid PAN number.",
                ]
            ]

        );
        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
        }

        $model = new EmployeeJoinigDetailsModel();
        $joiningFormDetails = $model->where('email_primary', $requestData['email_primary'])->find();
        if (!empty($joiningFormDetails)) {
            return $this->fail(['messages' => 'Email already exist.'], 400);
        }



        $requestData['updated_by'] = $user['id'];
        $requestData['verification_code'] = substr(number_format(time() * rand(), 0, '', ''), 0, 8);

        //get details form profile
        $profileModel = new ProfileModel();
        $profileEducationModel = new ProfileEducationQualificationModel();
        $profileProfessionalModel = new ProfileProfessionalQualificationModel();
        $profileDetails = $profileModel->where('email_primary', $requestData['email_primary'])->first();
        $joingFormId = $joiningFormDetails['id'];
        if (!empty($profileDetails)) {
            //$profile_education_qualification = $profileEducationModel->where('profile_id', $profileDetails['id'])->find();
            //$profile_professional_qualification = $profileEducationModel->where('profile_id', $profileDetails['id'])->find();
            $requestData['mobile_primary'] = $profileDetails['mobile_primary'];
            $requestData['dob'] = $profileDetails['dob'];
            $requestData['employment_history'] = $profileDetails['employment_history'];

            $employeeOtherDetails['gender'] = $profileDetails['gender'];
            $employeeOtherDetails['marital_status'] = $profileDetails['marital_status'];
            $employeeOtherDetails['total_experience'] = $profileDetails['total_experience'];
            $employeeOtherDetails['present_address'] = $profileDetails['present_address'];
            $employeeOtherDetails['present_address_postcode'] = $profileDetails['present_address_postcode'];
            $employeeOtherDetails['permanent_address'] = $profileDetails['permanent_address'];
            $employeeOtherDetails['permanent_address_postcode'] = $profileDetails['permanent_address_postcode'];

            $requestData['employee_other_details'] = json_encode($employeeOtherDetails);
        }


        $update = $model->save($requestData);

        $educationQualificationModel = new EducationQualificationModel();
        $professionalQualificationModel = new ProfessionalQualificationModel();
        $joiningFormDetails = $model->where('email_primary', $requestData['email_primary'])->first();
        if (!empty($profileDetails)) {
            $joiningFormId = $joiningFormDetails['id'];

            $profile_education_qualification = $profileEducationModel->where('profile_id', $profileDetails['id'])->find();
            $profile_professional_qualification = $profileProfessionalModel->where('profile_id', $profileDetails['id'])->find();


            foreach ($profile_education_qualification as $p_e_q) {
                unset($p_e_q['id']);
                unset($p_e_q['profile_id']);
                $p_e_q['joining_form_id'] = $joiningFormId;

                $educationQualificationModel->save($p_e_q);
            }

            foreach ($profile_professional_qualification as $p_p_q) {
                unset($p_p_q['id']);
                unset($p_p_q['profile_id']);
                $p_p_q['joining_form_id'] = $joiningFormId;
                $professionalQualificationModel->save($p_p_q);
            }
        }

        // 	//action log
        // 	$changed_data = $changed_data = array_diff_assoc((array)$requestData, (array)$profileDetails);

        if ($update) {

            //send email
            $templateData = [
                'first_name' => $requestData['first_name'],
                'link' => base_url(route_to('joiningFormVerification', base64_encode($requestData['email_primary']))),
                'verification_code' => $requestData['verification_code']
            ];
            $message = view('email-templates/send-joining-form-link', $templateData);
            $isEmailSent =  sendEmail_common($requestData['email_primary'], $message, 'Bitstringit - Joining Form', $user['email']);

            //Respond with 200 status code
            return $this->respond(['success' => 'Sent Joining form.']);
        }

        return $this->fail(['error' => 'Failed to send Joining form.'], 400);
    }

    public function sendJoiningFormLink()
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('joining_form/add')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON();

        $model = new EmployeeJoinigDetailsModel();
        $formDetails = $model->find($requestData['id']);


        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2') {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not send link. Please contact to admin."], 403);
        }

        $requestData['verification_code'] = substr(number_format(time() * rand(), 0, '', ''), 0, 8);
        $requestData['is_accept_declaration'] = null;
        $update = $model->save($requestData);

        //send email
        $templateData = [
            'first_name' => $formDetails['first_name'],
            'link' => base_url(route_to('joiningFormVerification', base64_encode($formDetails['email_primary']))),
            'verification_code' => $requestData['verification_code']
        ];
        $message = view('email-templates/send-joining-form-link', $templateData);
        $isEmailSent =  sendEmail_common($formDetails['email_primary'], $message, 'Bitstringit - Joining Form', $user['email']);

        if ($isEmailSent) {
            //Respond with 200 status code
            return $this->respond(['success' => 'E-mail has been sent successfully.']);
        }
        return $this->fail(['errorMessage' => "E-mail sending failed please try again."], 403);
    }

    public function joiningFormSaveEmployeeDetails()
    {

        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }


        $requestData = (array) $this->request->getJSON();
        //$requestData = $this->request->getRawInput();
        $model = new EmployeeJoinigDetailsModel();
        $joiningFormId = $requestData['id'];
        $formDetails = $model->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        $allowedColums = [
            'first_name' => '',
            'last_name' => '',
            'father_name' => '',
            'mother_name' => '',
            'spouse_name' => '',
            'kids_name' => '',
            'email_primary' => '',
            'mobile_primary' => '',
            'aadhar_number' => '',
            'pan_number' => '',
            'dob' => '',
            'place_of_birth' => '',
            'nationality' => '',
            'employee_other_details' => '',
        ];
        $requestData = array_intersect_key($requestData, $allowedColums);
        $requestData['employee_other_details'] = (array)$requestData['employee_other_details'];
        //validation
        $validation =  \Config\Services::validation();

        $rules = [
            // 'email' => 'required',
            'first_name' => [
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The first name is required.'
                ]
            ],
            'last_name' => [
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The last name is required.'
                ]
            ],
            'dob' => [
                'label' => 'Date of Birth',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The date of birth is required.'
                ]
            ],
            'aadhar_number' => [
                'label' => 'Aadhar Number',
                'rules' => 'required|numeric|exact_length[12]',
                'errors' => [
                    'required' => 'The aadhar number is required.',
                    'numeric' => 'Enter valid aadhar number.',
                    'exact_length' => 'Enter valid aadhar number.'
                ]
            ],
            'pan_number' => [
                'label' => 'PAN Number',
                'rules' => 'required|alpha_numeric|exact_length[10]|valid_pan',
                'errors' => [
                    'required' => 'The PAN Number is required.',
                    'alpha_numeric' => 'Enter valid PAN number.',
                    'exact_length' => 'Enter valid PAN number.',
                    'valid_pan' => 'Enter valid PAN number.'
                ]
            ],
            'email_primary' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email|is_unique[employee_joining_form_details.email_primary,id,' . $joiningFormId . ']',
                'errors' => [
                    'required' => 'The e-mail is required.',
                    'valid_email' => 'Enter valid e-mail.',
                    'is_unique' => 'E-mail is already in use, try with different e-mail.'
                ]
            ],
            'mobile_primary' => [
                'label' => 'Mobile',
                'rules' => 'required|exact_length[10]',
                'errors' => [
                    'required' => 'The mobile is required.',
                    'exact_length' => 'Enter valid mobile number.'
                ]
            ],

            'employee_other_details.bank_ifsc_code' => [
                'label' => 'IFS Code',
                'rules' => 'required|valid_ifsc',
                'errors' => [
                    'required' => 'The IFS code is required.',
                    'valid_ifsc' => 'Enter valid IFS code.'
                ]
            ],
            'employee_other_details.bank_name_branch' => [
                'label' => 'Bank Name & Branch',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The bank name and branch is required.'
                ]
            ],
            'employee_other_details.bank_account_number' => [
                'label' => 'Bank A/c No',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The bank account number is required.'
                ]
            ],

            'employee_other_details.gender' => [
                'label' => 'Gender',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Select a gender.'
                ]
            ],
            'employee_other_details.marital_status' => [
                'label' => 'Marital Status',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Select marital status.'
                ]
            ],
            'employee_other_details.blood_group' => [
                'label' => 'Blood Group',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The blood group is required.'
                ]
            ],
            'employee_other_details.emergency_contact_name' => [
                'label' => 'Emergency Contact Name and Relation',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The emergency contact name is required.'
                ]
            ],
            'employee_other_details.emergency_contact_mobile' => [
                'label' => 'Emergency Mobile No',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The emergency mobile number is required.'
                ]

            ],

            'employee_other_details.present_address' => [
                'label' => 'Present Address',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The present address is required.'
                ]
            ],
            'employee_other_details.present_address_postcode' => [
                'label' => 'Postcode',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The postcode is required.'
                ]
            ],
            'employee_other_details.present_address_city' => [
                'label' => 'City Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The city name is required.'
                ]
            ],
            'employee_other_details.present_address_residing_duration' => [
                'label' => 'For how long',
                'rules' => 'required',
                'errors' => [
                    'required' => 'For how long are you residing at this address.'
                ]
            ],

            'employee_other_details.permanent_address' => [
                'label' => 'Permanent Address',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The permanent address is required.'
                ]
            ],
            'employee_other_details.permanent_address_city' => [
                'label' => 'City Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The city name is required.'
                ]
            ],
            'employee_other_details.permanent_address_postcode' => [
                'label' => 'Postcode',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The postcode is required.'
                ]
            ],
            'employee_other_details.date_of_joining' => [
                'label' => 'Date of Joining',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Date of Joining is required.'
                ]
            ],
        ];


        $validation->setRules(
            $rules
        );

        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
        }

        $requestData['employee_other_details'] = $requestData['employee_other_details'] ? json_encode($requestData['employee_other_details']) : null;

        $id =  $model->update($joiningFormId, $requestData);

        $response = [
            'id'   => $joiningFormId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveEducationDetails()
    {
        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $document = $this->request->getFile('edudocument');
        $requestData =  json_decode($_POST['requestData'], true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'id' => '',
            'joining_form_id' => '',
            'degree' => '',
            'university' => '',
            'institution' => '',
            'from_date' => '',
            'to_date' => '',
            'course_type' => '',
            'percentage' => '',
            'document_path' => '',
        ];
        // $joiningFormId = $requestData['joining_form_id'];
        $requestData = array_intersect_key($requestData, $allowedColums);
        $joiningFormId = $requestData['joining_form_id'];

        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        //validation
        $validation =  \Config\Services::validation();


        $rules = [
            'degree' => [
                'label' => 'Degree/course',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The degree/course is required.'
                ]
            ],
            'university' => [
                'label' => 'Course Title along with Board / University',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The board/university is required.'
                ]
            ],
            'institution' => [
                'label' => 'address of school/Institution',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The school/instutution is required.'
                ]
            ],
            'from_date' => [
                'label' => 'From',
                'rules' => 'required|valid_month_year',
                'errors' => [
                    'required' => 'The from date is required.'
                ]
            ],
            'to_date' => [
                'label' => 'To',
                'rules' => 'required|valid_month_year|check_from_date_to_date[' . $requestData['from_date'] . ']',
                'errors' => [
                    'required' => 'The to date is required.',
                    'check_from_date_to_date' => 'To date should be greater than from date.'
                ]
            ],
            'course_type' => [
                'label' => 'Course Type',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The course type is required.'
                ]
            ],
            'percentage' => [
                'label' => 'Percentage/CGPA',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The percentage/CGPA is required.'
                ]
            ],
        ];


        if (empty($requestData['document_path']) || !file_exists(DOCUMENTS_PATH . $requestData['document_path'])) {
            // $rules['edudocument'] = ['label' => 'Document', 'rules' => 'uploaded[edudocument]|max_size[edudocument,1000]|mime_in[edudocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        if (!file_exists(DOCUMENTS_PATH . $requestData['document_path'])) {

            // $rules['edudocument'] = ['label' => 'Document', 'rules' => 'uploaded[edudocument]|max_size[edudocument,1000]|mime_in[edudocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        if ($document) {
            $rules['edudocument'] = ['label' => 'Document', 'rules' => 'uploaded[edudocument]|max_size[edudocument,1000]|mime_in[edudocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        $validation->setRules(
            $rules
        );




        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['education_qualification' => "Please fill all the fields."], 400);
        }


        if (isset($document)) {
            $pathToUpload = "form_" . $joiningFormId;

            if (!file_exists(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload)) {
                mkdir(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload, 0777, true);
                fopen(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload . "/index.html", 'w');
            }

            $newName = $document->getRandomName();
            $document->move(DOCUMENTS_PATH . $pathToUpload, $newName);
            //remove old document

            if (isset($requestData['document_path'])) {
                if (file_exists(DOCUMENTS_PATH . $requestData['document_path']) && !empty($requestData['document_path'])) {

                    unlink(DOCUMENTS_PATH . $requestData['document_path']);
                }
            }

            $requestData['document_path'] = $pathToUpload . '/' . $newName;
        }

        $model = new EducationQualificationModel();


        //$requestData['education_qualification'] = $requestData['education_qualification'] ? json_encode($requestData['education_qualification']) : null;
        if (empty($requestData['id'])) {
            $model->insert($requestData);
        } else {
            $model->save($requestData);
        }


        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormRemoveEducationDetails()
    {

        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new EducationQualificationModel();
        $educationDetails = (array)$model->find($id);
        $joiningFormId = $educationDetails['joining_form_id'];

        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        $model->delete($id);
        //remove document

        if (file_exists(DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
            unlink(DOCUMENTS_PATH . $educationDetails['document_path']);
        }

        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Deleted'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveGapdeclaration()
    {
        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $document = $this->request->getFile('gapdocument');
        $requestData =  json_decode($_POST['requestData'], true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'id' => '',
            'joining_form_id' => '',
            'particular' => '',
            'from_date' => '',
            'to_date' => '',
            'document_path' => '',
        ];
        // $joiningFormId = $requestData['joining_form_id'];
        $requestData = array_intersect_key($requestData, $allowedColums);
        $joiningFormId = $requestData['joining_form_id'];


        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        //validation
        $validation =  \Config\Services::validation();


        $rules = [
            'particular' => [
                'label' => 'Particulars',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The particulars is required.'
                ]
            ],
            'from_date' => [
                'label' => 'From',
                'rules' => 'required|valid_month_year',
                'errors' => [
                    'required' => 'The from date is required.'
                ]
            ],
            'to_date' => [
                'label' => 'To',
                'rules' => 'required|valid_month_year|check_from_date_to_date[' . $requestData['from_date'] . ']',
                'errors' => [
                    'required' => 'The to date is required.',
                    'check_from_date_to_date' => 'To date should be greater than from date.'
                ]
            ],
        ];
        if (empty($requestData['document_path']) || !file_exists(DOCUMENTS_PATH . $requestData['document_path'])) {

            // $rules['gapdocument'] = ['label' => 'Certificate', 'rules' => 'uploaded[gapdocument]|max_size[gapdocument,1000]|mime_in[gapdocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        if (!file_exists(DOCUMENTS_PATH . $requestData['document_path'])) {

            // $rules['gapdocument'] = ['label' => 'Certificate', 'rules' => 'uploaded[gapdocument]|max_size[gapdocument,1000]|mime_in[gapdocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        if ($document) {

            $rules['gapdocument'] = ['label' => 'Certificate', 'rules' => 'uploaded[gapdocument]|max_size[gapdocument,1000]|mime_in[gapdocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }


        $validation->setRules(
            $rules
        );




        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['education_qualification' => "Please fill all the fields."], 400);
        }


        if (isset($document)) {
            $pathToUpload = "form_" . $joiningFormId;

            if (!file_exists(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload)) {
                mkdir(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload, 0777, true);
                fopen(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload . "/index.html", 'w');
            }

            $newName = $document->getRandomName();
            $document->move(DOCUMENTS_PATH . $pathToUpload, $newName);
            //remove old document

            if (isset($requestData['document_path'])) {
                if (file_exists(DOCUMENTS_PATH . $requestData['document_path']) && !empty($requestData['document_path'])) {

                    unlink(DOCUMENTS_PATH . $requestData['document_path']);
                }
            }

            $requestData['document_path'] = $pathToUpload . '/' . $newName;
        }

        $model = new GapDeclarationModel();


        //$requestData['education_qualification'] = $requestData['education_qualification'] ? json_encode($requestData['education_qualification']) : null;
        if (empty($requestData['id'])) {
            $model->insert($requestData);
        } else {
            $model->save($requestData);
        }


        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormRemoveGapdeclaration()
    {
        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new GapDeclarationModel();

        $educationDetails = (array)$model->find($id);
        $joiningFormId = $educationDetails['joining_form_id'];

        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }


        $model->delete($id);
        //remove document

        if (file_exists(DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
            unlink(DOCUMENTS_PATH . $educationDetails['document_path']);
        }

        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Deleted'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveMediclaim()
    {

        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $document = $this->request->getFile('mediclaimdocumentPhoto');
        $requestData =  json_decode($_POST['requestData'], true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'id' => '',
            'joining_form_id' => '',
            'name' => '',
            'relationship' => '',
            'dob' => '',
            'age' => '',
            'document_path' => '',
        ];
        // $joiningFormId = $requestData['joining_form_id'];
        $requestData = array_intersect_key($requestData, $allowedColums);
        $joiningFormId = $requestData['joining_form_id'];


        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }


        //validation
        $validation =  \Config\Services::validation();


        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The name is required.'
                ]
            ],
            'relationship' => [
                'label' => 'Relationship',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The relationship is required.'
                ]
            ],
            'dob' => [
                'label' => 'Date of Birth',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The date of birth is required.'
                ]
            ],
        ];
        if (empty($requestData['document_path']) || !file_exists(DOCUMENTS_PATH . $requestData['document_path'])) {

            //  $rules['mediclaimdocumentPhoto'] = ['label' => 'Photo', 'rules' => 'uploaded[mediclaimdocumentPhoto]|max_size[mediclaimdocumentPhoto,1000]|mime_in[mediclaimdocumentPhoto,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        if (!file_exists(DOCUMENTS_PATH . $requestData['document_path'])) {
            // $rules['mediclaimdocumentPhoto'] = ['label' => 'Photo', 'rules' => 'uploaded[mediclaimdocumentPhoto]|max_size[mediclaimdocumentPhoto,1000]|mime_in[mediclaimdocumentPhoto,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];


        }
        if ($document) {

            $rules['mediclaimdocumentPhoto'] = ['label' => 'Photo', 'rules' => 'uploaded[mediclaimdocumentPhoto]|max_size[mediclaimdocumentPhoto,1000]|mime_in[mediclaimdocumentPhoto,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }


        $validation->setRules(
            $rules
        );




        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['education_qualification' => "Please fill all the fields."], 400);
        }


        if (isset($document)) {
            $pathToUpload = "form_" . $joiningFormId;

            if (!file_exists(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload)) {
                mkdir(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload, 0777, true);
                fopen(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload . "/index.html", 'w');
            }

            $newName = $document->getRandomName();
            $document->move(DOCUMENTS_PATH . $pathToUpload, $newName);
            //remove old document

            if (isset($requestData['document_path'])) {
                if (file_exists(DOCUMENTS_PATH . $requestData['document_path']) && !empty($requestData['document_path'])) {

                    unlink(DOCUMENTS_PATH . $requestData['document_path']);
                }
            }

            $requestData['document_path'] = $pathToUpload . '/' . $newName;
        }

        $model = new MediclaimModel();

        //calculate age from dob
        $bday = new DateTime($requestData['dob']); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        $requestData['age'] = $diff->y;
        //$requestData['education_qualification'] = $requestData['education_qualification'] ? json_encode($requestData['education_qualification']) : null;
        if (empty($requestData['id'])) {
            $model->insert($requestData);
        } else {
            $model->save($requestData);
        }


        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormRemoveMediclaim()
    {
        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new MediclaimModel();

        $educationDetails = (array)$model->find($id);
        $joiningFormId = $educationDetails['joining_form_id'];

        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }


        $model->delete($id);
        //remove document

        if (file_exists(DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
            unlink(DOCUMENTS_PATH . $educationDetails['document_path']);
        }

        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Deleted'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveProfetionalQualification()
    {
        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $document = $this->request->getFile('professionalDocument');
        $requestData =  json_decode($_POST['requestData'], true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'id' => '',
            'joining_form_id' => '',
            'qualification' => '',
            'category' => '',
            'date' => '',
            'document_path' => '',
        ];
        // $joiningFormId = $requestData['joining_form_id'];
        $requestData = array_intersect_key($requestData, $allowedColums);
        $joiningFormId = $requestData['joining_form_id'];

        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        //validation
        $validation =  \Config\Services::validation();


        $rules = [
            'qualification' => [
                'label' => 'Qualification',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The qualification is required.'
                ]
            ],
            'category' => [
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The category is required.'
                ]
            ],
            'date' => [
                'label' => 'Date',
                'rules' => 'required|valid_month_year',
                'errors' => [
                    'required' => 'The date is required.'
                ]
            ],
        ];

        if (empty($requestData['document_path']) || !file_exists(DOCUMENTS_PATH . $requestData['document_path'])) {

            // $rules['professionalDocument'] = ['label' => 'Certificate', 'rules' => 'uploaded[professionalDocument]|max_size[professionalDocument,1000]|mime_in[professionalDocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        if (!file_exists(DOCUMENTS_PATH . $requestData['document_path'])) {
            //  $rules['professionalDocument'] = ['label' => 'Certificate', 'rules' => 'uploaded[professionalDocument]|max_size[professionalDocument,1000]|mime_in[professionalDocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];


        }

        if ($document) {

            $rules['professionalDocument'] = ['label' => 'Certificate', 'rules' => 'uploaded[professionalDocument]|max_size[professionalDocument,1000]|mime_in[professionalDocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        $validation->setRules(
            $rules
        );




        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['education_qualification' => "Please fill all the fields."], 400);
        }


        if (isset($document)) {

            $pathToUpload = "form_" . $joiningFormId;

            if (!file_exists(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload)) {
                mkdir(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload, 0777, true);
                fopen(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload . "/index.html", 'w');
            }

            $newName = $document->getRandomName();
            $document->move(DOCUMENTS_PATH . $pathToUpload, $newName);
            //remove old document

            if (isset($requestData['document_path'])) {
                if (file_exists(DOCUMENTS_PATH . $requestData['document_path']) && !empty($requestData['document_path'])) {

                    unlink(DOCUMENTS_PATH . $requestData['document_path']);
                }
            }

            $requestData['document_path'] = $pathToUpload . '/' . $newName;
        }

        $model = new ProfessionalQualificationModel();

        //calculate age from dob
        $bday = new DateTime($requestData['dob']); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        $requestData['age'] = $diff->y;
        //$requestData['education_qualification'] = $requestData['education_qualification'] ? json_encode($requestData['education_qualification']) : null;
        if (empty($requestData['id'])) {
            $model->insert($requestData);
        } else {
            $model->save($requestData);
        }


        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormRemoveProfetionalQualification()
    {
        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new ProfessionalQualificationModel();

        $educationDetails = (array)$model->find($id);
        $joiningFormId = $educationDetails['joining_form_id'];

        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        $model->delete($id);
        //remove document

        if (file_exists(DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
            unlink(DOCUMENTS_PATH . $educationDetails['document_path']);
        }

        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Deleted'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveEmploymentHistory()
    {
        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON(true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'employment_history' => ''
        ];
        $joiningFormId = $requestData['id'];
        $requestData = array_intersect_key($requestData, $allowedColums);

        $valid = true;
        //validation
        $validation =  \Config\Services::validation();
        $rules = [];
        // $validationData = [
        //     'gap_declaration' => [
        //         'particular' => [],
        //         'from_date' => [],
        //         'to_date' => [],
        //     ]
        // ];
        // print_r($requestData['employment_history']);
        // if (!empty($requestData['employment_history']->gap_declaration)) {

        //     foreach ($requestData['employment_history']->gap_declaration as $key => $item) {


        //         array_push($validationData['gap_declaration']['particular'], $item->particular);
        //         array_push($validationData['gap_declaration']['from_date'], $item->from_date);
        //         array_push($validationData['gap_declaration']['to_date'], $item->to_date);
        //     }

        //     $rules = [
        //         'gap_declaration.particular.*' => ['label' => 'Particulars ', 'rules' => 'required'],
        //         'gap_declaration.from_date.*' => ['label' => 'From', 'rules' => 'required'],
        //         'gap_declaration.to_date.*' => ['label' => 'To', 'rules' => 'required'],
        //     ];
        // }

        if (!empty($requestData['employment_history']['employers'])) {
            foreach ($requestData['employment_history']['employers'] as $key => $employer) {
                $rules["employment_history.employers.$key.company"] = [
                    'label' => 'Company',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The company name is required.'
                    ]
                ];
                // $rules["employment_history.employers.$key.department"] = ['label' => 'Department', 'rules' => 'required'];
                // $rules["employment_history.employers.$key.position_held"] = ['label' => 'Position Held', 'rules' => 'required'];
                $rules["employment_history.employers.$key.nature_of_job"] = [
                    'label' => 'Nature of Job',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The nature of job is required.'
                    ]
                ];
                $rules["employment_history.employers.$key.reporting_manager"] = [
                    'label' => 'Name of Reporting Manager',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The name of reporting manager is required.'
                    ]
                ];
                $rules["employment_history.employers.$key.from_date"] = [
                    'label' => 'From date',
                    'rules' => 'valid_month_year',
                ];
                $rules["employment_history.employers.$key.to_date"] = [
                    'label' => 'To date',
                    'rules' => 'valid_month_year|check_from_date_to_date[' . $employer['from_date'] . ']',
                    'errors' => [
                        'check_from_date_to_date' => 'To date should be greater than from date.'
                    ]
                ];
                $rules["employment_history.employers.$key.contact_number_manager"] = [
                    'label' => 'Contact Number',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The contact number of manager is required.'
                    ]
                ];
                $rules["employment_history.employers.$key.email_manager"] = [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'The e-mail of manager is required.',
                        'valid_email' => 'Enter valid e-mail.'
                    ]
                ];
            }
        }

        // if (!empty($requestData['employment_history']['gap_declaration'])) {
        //     foreach ($requestData['employment_history']['gap_declaration'] as $key => $gap) {
        //         $rules["employment_history.gap_declaration.$key.particular"] = ['label' => 'Particulars', 'rules' => 'required'];
        //         $rules["employment_history.gap_declaration.$key.from_date"] = ['label' => 'From', 'rules' => 'required'];
        //         $rules["employment_history.gap_declaration.$key.to_date"] = ['label' => 'To', 'rules' => 'required'];
        //     }
        // }


        if ($rules) {
            $validation->setRules(
                $rules
            );
            $valid = $validation->run($requestData);
        }

        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['gap_declaration' => "Please fill all the fields."], 400);
        }

        $model = new EmployeeJoinigDetailsModel();
        $requestData['employment_history'] = $requestData['employment_history'] ? json_encode($requestData['employment_history']) : null;
        $id =  $model->update($joiningFormId, $requestData);

        $response = [
            'id'   => $joiningFormId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveEmploymentHistory_()
    {

        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON(true);
        $joiningFormId = $requestData['joining_form_id'];

       
        $validation =  \Config\Services::validation();
        $rules["company"] = [
            'label' => 'Company',
            'rules' => 'required',
            'errors' => [
                'required' => 'The company name is required.'
            ]
        ];

        $rules["nature_of_job"] = [
            'label' => 'Nature of Job',
            'rules' => 'required',
            'errors' => [
                'required' => 'The nature of job is required.'
            ]
        ];
        $rules["reporting_manager"] = [
            'label' => 'Name of Reporting Manager',
            'rules' => 'required',
            'errors' => [
                'required' => 'The name of reporting manager is required.'
            ]
        ];
        $rules["from_date"] = [
            'label' => 'From date',
            'rules' => 'valid_month_year',
        ];
        $rules["to_date"] = [
            'label' => 'To date',
            'rules' => 'valid_month_year|check_from_date_to_date[' . $requestData['from_date'] . ']',
            'errors' => [
                'check_from_date_to_date' => 'To date should be greater than from date.'
            ]
        ];
        $rules["contact_number_manager"] = [
            'label' => 'Contact Number',
            'rules' => 'required',
            'errors' => [
                'required' => 'The contact number of manager is required.'
            ]
        ];
        $rules["email_manager"] = [
            'label' => 'Email',
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'The e-mail of manager is required.',
                'valid_email' => 'Enter valid e-mail.'
            ]
        ];

        
        $validation->setRules(
            $rules
        );
        $valid = $validation->run($requestData);
        // print_r($requestData );die;
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['gap_declaration' => "Please fill all the fields."], 400);
        }

        $model = new EmploymentHistoryModel();

        if (empty($requestData['id'])) {
            $model->insert($requestData);
        } else {
            $model->save($requestData);
        }


        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);

    }

    public function joiningFormRemoveEmploymentHistory_()
    {
        if (!hasCapability('joining_form/delete')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new EmploymentHistoryModel();

        $educationDetails = (array)$model->find($id);
        $joiningFormId = $educationDetails['joining_form_id'];

        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        $model->delete($id);
        //remove document


        $response = [
            'list' => $model->where('joining_form_id', $joiningFormId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Deleted'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveBackgroundInfo()
    {
        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON(true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'background_info' => ''
        ];
        $joiningFormId = $requestData['id'];

        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($joiningFormId);
        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        $requestData = array_intersect_key($requestData, $allowedColums);
        $valid = true;
        //validation
        $validation =  \Config\Services::validation();
        $rules = [];
        if (!empty($requestData['background_info']['previous_address'])) {
            foreach ($requestData['background_info']['previous_address'] as $key => $address) {
                $rules["background_info.previous_address.$key.address"] = [
                    'label' => 'Address',
                    'rules' => 'required',
                    'errors' => [
                        'required' => "The address is required."
                    ]
                ];
                $rules["background_info.previous_address.$key.postcode"] = [
                    'label' => 'Postcode',
                    'rules' => 'required',
                    'errors' => [
                        'required' => "The postcode is required."
                    ]
                ];
                $rules["background_info.previous_address.$key.from_date"] = [
                    'label' => 'From Date',
                    'rules' => 'required',
                    'errors' => [
                        'required' => "The from date is required."
                    ]
                ];
                $rules["background_info.previous_address.$key.to_date"] = [
                    'label' => 'To Date',
                    'rules' => 'required',
                    'errors' => [
                        'required' => "The to date is required."
                    ]
                ];
            }
        }


        if (!empty($rules)) {
            $validation->setRules(
                $rules
            );
            $valid = $validation->run($requestData);
        }



        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
        }


        $model = new EmployeeJoinigDetailsModel();
        $requestData['background_info'] = $requestData['background_info'] ? json_encode($requestData['background_info']) : null;
        $model->update($joiningFormId, $requestData);

        $response = [
            'id'   => $joiningFormId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningUploadDocument()
    {

        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        if (!hasCapability('joining_form/update_documents')) {
            return $this->fail(['errorMessage' => "You don't have capability to update documents. Please contact to admin."], 403);
        }

        $document = $this->request->getFile('document');
        $requestData = $this->request->getPost();
        $id = $this->request->getPost('id'); // json_decode($_POST['requestData'], true);
        $documentName = $this->request->getPost('documentName'); // json_decode($_POST['requestData'], true);
        helper('form');
        $validation =  \Config\Services::validation();

        $rules = [
            'documentName' => ['label' => 'Document Name', 'rules' => 'required', 'errors' => ['required' => 'Select a document name.']],
            // 'document' => 'uploaded[document]|max_size[document,500]|mime_in[image,image/png,image/jpg,image/jpeg,image/bmp]',
            'document' => ['label' => 'Document', 'rules' => 'uploaded[document]|max_size[document,1000]|mime_in[document,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'],
        ];



        $validation->setRules($rules, [
            'document' => [
                'uploaded' => 'Please select a file.',
                'max_size' => 'File size is more than 1MB.',
                'mime_in' => 'Please upload an image/pdf/doc/docx file.',
            ]
        ]);
        $valid = $validation->run($requestData);
        if (!$valid) {

            return $this->fail($validation->getErrors(), 400);
        }


        //get document list
        $model = new EmployeeJoinigDetailsModel();
        $joiningFormDetails = (array)$model->find($id);

        //if joining form is approved the link will not be send
        if ($joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        $documentDetails = $joiningFormDetails['documents'] ? (array)json_decode($joiningFormDetails['documents']) : [];

        if (isset($document)) {
            $pathToUpload = "form_" . $id;
            if (!file_exists(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload)) {
                mkdir(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload, 0777, true);
                fopen(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload . "/index.html", 'w');
            }

            $newName = $document->getRandomName();
            $document->move(DOCUMENTS_PATH . $pathToUpload, $newName);
            //remove old document

            if (isset($documentDetails[$documentName])) {
                if (file_exists(DOCUMENTS_PATH . $documentDetails[$documentName]->path)) {
                    unlink(ROOTPATH . $documentDetails[$documentName]->path);
                }
            }
            $doc['path'] = $pathToUpload . '/' . $newName;
            $doc['file_name'] = $document->getClientName();
            $doc['documentNote'] = $requestData['documentNote'];
            $documentDetails[$documentName] = $doc;
        }


        $saveData['documents'] = $documentDetails ? json_encode($documentDetails) : null;
        $model->update($id, $saveData);
        $response = [
            'id'   => $id,
            'action_type' => 'Updated',
            'error'    => null,
            'documentList' => $documentDetails,
            'messages' => [
                'success' => 'Updated successfully',
            ]
        ];
        return $this->respondUpdated($response);
    }


    public function removeDocument()
    {
        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        if (!hasCapability('joining_form/update_documents')) {
            return $this->fail(['errorMessage' => "You don't have capability to update documents. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON();

        //get document details
        $model = new EmployeeJoinigDetailsModel();
        $joiningFormDetails = (array)$model->find($requestData['id']);

        //if joining form is approved the link will not be send
        if ($joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        $joiningFormDetails['documents'] = $joiningFormDetails['documents'] ? (array)json_decode($joiningFormDetails['documents']) : [];
        $documentDetails = $joiningFormDetails['documents'];

        //unlink document
        if (file_exists(DOCUMENTS_PATH . $documentDetails[$requestData['document']]->path)) {
            unlink(DOCUMENTS_PATH . $documentDetails[$requestData['document']]->path);
        }
        unset($documentDetails[$requestData['document']]);


        $saveData['documents'] = $documentDetails ? json_encode($documentDetails) : null;
        $model->update($requestData['id'], $saveData);

        $response = [
            'id'   => $requestData['id'],
            'action_type' => 'delete',
            'error'    => null,
            'documentList' => $documentDetails,
            'messages' => [
                'success' => 'Document removed.',
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormAcceptDeclaration()
    {

        if (!hasCapability('joining_form/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON();
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'is_accept_declaration' => '',
            'employee_other_details' => ''
        ];
        $joiningFormId = $requestData['id'];
        $requestData = array_intersect_key($requestData, $allowedColums);

        $model = new EmployeeJoinigDetailsModel();
        $educationModel = new EducationQualificationModel();
        $gapDeclarationModel = new GapDeclarationModel();
        $mediclaimModel = new MediclaimModel();
        $professionalQualificationModel = new ProfessionalQualificationModel();

        $employee_other_details = [
            'marital_status' => '',
            'uan_number' => '',
            'emergency_contact_name' => '',
            'emergency_contact_mobile' => '',
            'bank_name_branch' => '',
            'bank_account_number' => '',
            'bank_ifsc_code' => '',
            'date_of_joining' => '',
        ];
        $employment_history = [
            'employment_summary' => [],
            'employers' => [],
            'previous_employer' => [
                'position_held' => '',
                'from_date' => '',
                'to_date' => '',
                'company' => '',
                'department' => '',
                'nature_of_job' => '',
                'address' => '',
                'city' => '',
                'telephone' => '',
                'job_responsibilities' => '',
                'annual_ctc' => '',
                'reporting_manager' => '',
                'contact_number_manager' => '',
                'email_manager' => '',
                'reason_of_leaving' => '',
                'hr_name' => '',
                'hr_contact_number' => '',
                'hr_email' => '',
                'hr_designation' => '',
            ],
            'previous_to_previous_employer' => [
                'position_held' => '',
                'from_date' => '',
                'to_date' => '',
                'company' => '',
                'department' => '',
                'nature_of_job' => '',
                'address' => '',
                'city' => '',
                'telephone' => '',
                'job_responsibilities' => '',
                'annual_ctc' => '',
                'reporting_manager' => '',
                'contact_number_manager' => '',
                'email_manager' => '',
                'reason_of_leaving' => '',
                'hr_name' => '',
                'hr_contact_number' => '',
                'hr_email' => '',
                'hr_designation' => '',
            ],
            'gap_declaration' => []
        ];

        $backGroundInfo = [
            'criminal_and_civil_record' => [
                "C01" => 0,
                "C02" => 0,
                "C03" => 0,
                "C04" => 0,
                "C05" => 0,
                "C06" => 0,
                "C07" => 0,
                "C08" => 0,
            ],
            'business_interest' => [
                "B01" => 0,
                "B02" => 0,
                "B03" => 0,
                "B04" => 0,
            ],
            'other_disqualification' => [
                "O01" => 0,
                "O02" => 0,
                "O03" => 0,
                "O04" => 0,
            ],
            'previous_address' => [],
            'mediclaim' => [],
            'relative_with_bitstring' => []

        ];

        $formDetails = $model->find($joiningFormId);

        //if joining form is approved the link will not be send
        if ($formDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        /*Start::validate Entire joining form */
        $formDetails['employee_other_details'] = $formDetails['employee_other_details'] ? (array)json_decode($formDetails['employee_other_details']) : $employee_other_details;
        $formDetails['education_qualification'] = $educationModel->where('joining_form_id', $joiningFormId)->find();
        $formDetails['gap_declaration'] = $gapDeclarationModel->where('joining_form_id', $joiningFormId)->find();
        $formDetails['mediclaim'] = $mediclaimModel->where('joining_form_id', $joiningFormId)->find();
        $formDetails['professional_qualification'] = $professionalQualificationModel->where('joining_form_id', $joiningFormId)->find();
        // $joiningFormDetails['professional_qualification'] = $joiningFormDetails['professional_qualification'] ? (array)json_decode($joiningFormDetails['professional_qualification']) : [];
        $formDetails['employment_history'] = $formDetails['employment_history'] ? (array)json_decode($formDetails['employment_history']) : $employment_history;
        $formDetails['background_info'] = $formDetails['background_info'] ? (array)json_decode($formDetails['background_info']) : $backGroundInfo;
        $formDetails['documents'] = $formDetails['documents'] ? (array)json_decode($formDetails['documents']) : [];


        //validation
        $validation =  \Config\Services::validation();
        $rules = [];
        $messages = [];
        $employeDeatilsRules = [
            'first_name' => [
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The first name is required.'
                ]
            ],
            'last_name' => [
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The last name is required.'
                ]
            ],
            'dob' => [
                'label' => 'Date of Birth',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The date of birth is required.'
                ]
            ],
            'aadhar_number' => [
                'label' => 'Aadhar Number',
                'rules' => 'required|numeric|exact_length[12]',
                'errors' => [
                    'required' => 'The aadhar number is required.',
                    'numeric' => 'Enter valid aadhar number.',
                    'exact_length' => 'Enter valid aadhar number.'
                ]
            ],
            'pan_number' => [
                'label' => 'PAN Number',
                'rules' => 'required|alpha_numeric|exact_length[10]|valid_pan',
                'errors' => [
                    'required' => 'The PAN Number is required.',
                    'alpha_numeric' => 'Enter valid PAN number.',
                    'exact_length' => 'Enter valid PAN number.',
                    'valid_pan' => 'Enter valid PAN number.'
                ]
            ],
            'email_primary' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email|is_unique[employee_joining_form_details.email_primary,id,' . $joiningFormId . ']',
                'errors' => [
                    'required' => 'The e-mail is required.',
                    'valid_email' => 'Enter valid e-mail.',
                    'is_unique' => 'E-mail is already in use, try with different e-mail.'
                ]
            ],
            'mobile_primary' => [
                'label' => 'Mobile',
                'rules' => 'required|exact_length[10]',
                'errors' => [
                    'required' => 'The mobile is required.',
                    'exact_length' => 'Enter valid mobile number.'
                ]
            ],

            'employee_other_details.bank_ifsc_code' => [
                'label' => 'IFS Code',
                'rules' => 'required|valid_ifsc',
                'errors' => [
                    'required' => 'The IFS code is required.',
                    'valid_ifsc' => 'Enter valid IFS code.'
                ]
            ],
            'employee_other_details.bank_name_branch' => [
                'label' => 'Bank Name & Branch',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The bank name and branch is required.'
                ]
            ],
            'employee_other_details.bank_account_number' => [
                'label' => 'Bank A/c No',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The bank account number is required.'
                ]
            ],

            'employee_other_details.gender' => [
                'label' => 'Gender',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Select a gender.'
                ]
            ],
            'employee_other_details.marital_status' => [
                'label' => 'Marital Status',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Select marital status.'
                ]
            ],
            'employee_other_details.blood_group' => [
                'label' => 'Blood Group',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The blood group is required.'
                ]
            ],
            'employee_other_details.emergency_contact_name' => [
                'label' => 'Emergency Contact Name and Relation',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The emergency contact name is required.'
                ]
            ],
            'employee_other_details.emergency_contact_mobile' => [
                'label' => 'Emergency Mobile No',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The emergency mobile number is required.'
                ]

            ],

            'employee_other_details.present_address' => [
                'label' => 'Present Address',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The present address is required.'
                ]
            ],
            'employee_other_details.present_address_postcode' => [
                'label' => 'Postcode',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The postcode is required.'
                ]
            ],
            'employee_other_details.present_address_residing_duration' => [
                'label' => 'For how long',
                'rules' => 'required',
                'errors' => [
                    'required' => 'For how long are you residing at this address.'
                ]
            ],

            'employee_other_details.permanent_address' => [
                'label' => 'Permanent Address',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The permanent address is required.'
                ]
            ],
            'employee_other_details.permanent_address_postcode' => [
                'label' => 'Postcode',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The postcode is required.'
                ]
            ],
            'employee_other_details.date_of_joining' => [
                'label' => 'Date of Joining',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Date of Joining is required.'
                ]
            ],
        ];

        $educationQualificationRules = [];
        $professionalQualificationRules = [];
        $gapDeclarationRules = [];
        $mediclaimRules = [];
        $documents = [];

        foreach ($formDetails['education_qualification']  as $key => $education) {
            // $educationQualificationRules["education_qualification.$key.degree"] = ['label' => 'Degree/course', 'rules' => 'required'];
            // $educationQualificationRules["education_qualification.$key.university"] = ['label' => 'Course Title along with Board / University', 'rules' => 'required'];
            // $educationQualificationRules["education_qualification.$key.institution"] = ['label' => 'address of school/Institution', 'rules' => 'required'];
            // $educationQualificationRules["education_qualification.$key.from_date"] = ['label' => 'From', 'rules' => 'required'];
            // $educationQualificationRules["education_qualification.$key.to_date"] = ['label' => 'To', 'rules' => 'required'];
            // $educationQualificationRules["education_qualification.$key.course_type"] = ['label' => 'Course Type', 'rules' => 'required'];
            // $educationQualificationRules["education_qualification.$key.percentage"] = ['label' => 'Percentage/CGPA', 'rules' => 'required'];
            $educationQualificationRules["education_qualification.$key.document_path"] = ['label' => 'Certificate', 'rules' => 'required'];

            $messages["education_qualification.$key.document_path"]["required"] = "Please upload certificate.";
        }

        foreach ($formDetails['professional_qualification']  as $key => $education) {
            // $professionalQualificationRules["professional_qualification.$key.degree"] = ['label' => 'Qualification', 'rules' => 'required'];
            // $professionalQualificationRules["professional_qualification.$key.university"] = ['label' => 'Category', 'rules' => 'required'];
            // $professionalQualificationRules["professional_qualification.$key.institution"] = ['label' => 'Date', 'rules' => 'required'];
            $professionalQualificationRules["professional_qualification.$key.document_path"] = ['label' => 'Certificate', 'rules' => 'required'];

            $messages["professional_qualification.$key.document_path"]["required"] = "Please upload certificate.";
        }

        // foreach($formDetails['gap_declaration']  as $key=>$education ){
        //     $gapDeclarationRules["gap_declaration.$key.particular"] = ['label' => 'Particulars ', 'rules' => 'required'];
        //     $gapDeclarationRules["gap_declaration.$key.from_date"] = ['label' => 'From', 'rules' => 'required'];
        //     $gapDeclarationRules["gap_declaration.$key.to_date"] = ['label' => 'To', 'rules' => 'required'];
        //     $gapDeclarationRules["gap_declaration.$key.document_path"] = ['label' => 'Certificate', 'rules' => 'required'];

        //     $messages["gap_declaration.$key.document_path"]["required"] = "Please upload certificate.";
        // }

        foreach ($formDetails['mediclaim']  as $key => $education) {
            // $mediclaimRules["mediclaim.$key.name"] = ['label' => 'Name ', 'rules' => 'required'];
            // $mediclaimRules["mediclaim.$key.relationship"] = ['label' => 'Relationship', 'rules' => 'required'];
            // $mediclaimRules["mediclaim.$key.dob"] = ['label' => 'Date of Birth', 'rules' => 'required'];
            $mediclaimRules["mediclaim.$key.document_path"] = ['label' => 'Photo', 'rules' => 'required'];

            $messages["mediclaim.$key.document_path"]["required"] = "Please upload photo.";
        }

        $documentsRules['documents.aadhar_card'] =  ['label' => 'Aadhar Card', 'rules' => 'required'];
        $messages['documents.aadhar_card']['required'] = "Please upload Aadhar Card.";

        $documentsRules['documents.cheque'] =  ['label' => 'Cancelled Cheque', 'rules' => 'required'];
        $messages['documents.cheque']['required'] = "Please upload Cancelled Cheque.";

        $documentsRules['documents.pan_card'] =  ['label' => 'PAN Card', 'rules' => 'required'];
        $messages['documents.pan_card']['required'] = "Please upload PAN Card.";




        $rules = array_merge($employeDeatilsRules, $educationQualificationRules, $professionalQualificationRules, $gapDeclarationRules, $mediclaimRules, $documentsRules);





        $validation->setRules(
            $rules,
            $messages
        );

        $valid = $validation->run($formDetails);
        if (!$valid) {
            $errors = $validation->getErrors();
            $errors['employeeDetailsTab'] = false;
            $errors['educationalQualificationsTab'] = false;
            $errors['employmentHistoryTab'] = false;
            $errors['backgroundInfoTab'] = false;
            $errors['uploadDocumentsTab'] = false;
            $errors['declarationTab'] = false;

            $errors['employeeDetailsTab'] = (bool) count(array_intersect_key($errors, $employeDeatilsRules));
            $errors['educationalQualificationsTab'] = (bool) count(array_intersect_key($errors, array_merge($educationQualificationRules, $professionalQualificationRules)));
            $errors['employmentHistoryTab'] = (bool) count(array_intersect_key($errors, $gapDeclarationRules));
            $errors['backgroundInfoTab'] = (bool) count(array_intersect_key($errors, $mediclaimRules));
            $errors['uploadDocumentsTab'] = (bool) count(array_intersect_key($errors, $documentsRules));

            return $this->fail($errors, 400);
        }





        /*End::validate Entire joining form*/







        $requestData['is_accept_declaration'] = date('Y-m-d H:i:s');
        $requestData['employee_other_details'] = $requestData['employee_other_details'] ? json_encode($requestData['employee_other_details']) : null;
        $requestData['status'] = '1';
        $id =  $model->update($joiningFormId, $requestData);
        //send mail to employee 
        $payload = [
            'ist' => time(),
            'iss' => base_url(),
            'exp' => time() + (60 * 60 * 48), //sec * min * hrs (valid for 48 hrs)
            'joiningFormId' => $joiningFormId,
        ];

        $token = JWT::encode($payload, JWT_SECRETE_KEY);

        $templateData = [
            'first_name' => $formDetails['first_name'],
            'downloadLink' => base_url(route_to('downloadMyJoiningForm', $token)),
        ];

        $message = view('email-templates/thank-you-message', $templateData);
        $isEmailSent =  sendEmail_common($formDetails['email_primary'], $message, 'Bitstringit - Joining Form', HR_EMAIL);

        //send mail to hr
        $templateData = [
            'first_name' => $formDetails['first_name'],
            'last_name' => $formDetails['last_name'],
            'link' => base_url(route_to('editJoiningForm', $joiningFormId)),
        ];

        $message = view('email-templates/joining-form-submited-hr', $templateData);
        $isEmailSent =  sendEmail_common(HR_EMAIL, $message, 'Bitstringit - Joining Form', $formDetails['email_primary']);


        $response = [
            'id'   => $joiningFormId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]

        ];
        return $this->respondUpdated($response);
    }

    public function approveJoiningForm()
    {

        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('joining_form/approve')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON(true);
        $joiningFormId = $requestData['id'];
        $updateData['status'] = '2';
        $updateData['approval_dt'] = date('Y-m-d H:i:s');
        $model = new EmployeeJoinigDetailsModel();
        $model->update($joiningFormId, $updateData);
        $formDetails = $model->find($joiningFormId);
        //send email
        $templateData = [
            'first_name' => $formDetails['first_name'],
            'last_name' => $formDetails['last_name'],
            'link' => base_url(route_to('editJoiningForm', $joiningFormId)),
        ];

        $message = view('email-templates/joining-form-approved', $templateData);
        $isEmailSent =  sendEmail_common(CEO_EMAIL . ', ' . ACCOUNTS_EMAIL, $message, 'Approved Joining Form (' . $formDetails['first_name'] . ' ' . $formDetails['last_name'] . ')', $user['email']);
    }
    public function getJoingformDetails($id)
    {
        if (!hasCapability('joining_form/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $user = checkUserToken();

        $session = session();

        if (empty($session->get('employee_joining_form_id')) && empty($user)) {
            if (empty($session->get('employee_joining_form_id'))) {
                //redirect
                return $this->fail(['messages' => 'Please verify details.'], 400);
            }

            if (!$user) {
                return $this->fail(['messages' => 'Please login.'], 400);
            }
        }


        $model = new EmployeeJoinigDetailsModel();
        $joiningFormDetails = (array)$model->find($id);
        $employee_other_details = [
            'marital_status' => '',
            'uan_number' => '',
            'emergency_contact_name' => '',
            'emergency_contact_mobile' => '',
            'bank_name_branch' => '',
            'bank_account_number' => '',
            'bank_ifsc_code' => '',
        ];
        $employment_history = [
            'employment_summary' => [],
            'employers' => [],
            'previous_employer' => [
                'position_held' => '',
                'from_date' => '',
                'to_date' => '',
                'company' => '',
                'department' => '',
                'nature_of_job' => '',
                'address' => '',
                'city' => '',
                'telephone' => '',
                'job_responsibilities' => '',
                'annual_ctc' => '',
                'reporting_manager' => '',
                'contact_number_manager' => '',
                'email_manager' => '',
                'reason_of_leaving' => '',
                'hr_name' => '',
                'hr_contact_number' => '',
                'hr_email' => '',
                'hr_designation' => '',
            ],
            'previous_to_previous_employer' => [
                'position_held' => '',
                'from_date' => '',
                'to_date' => '',
                'company' => '',
                'department' => '',
                'nature_of_job' => '',
                'address' => '',
                'city' => '',
                'telephone' => '',
                'job_responsibilities' => '',
                'annual_ctc' => '',
                'reporting_manager' => '',
                'contact_number_manager' => '',
                'email_manager' => '',
                'reason_of_leaving' => '',
                'hr_name' => '',
                'hr_contact_number' => '',
                'hr_email' => '',
                'hr_designation' => '',
            ],
            'gap_declaration' => []
        ];

        $backGroundInfo = [
            'criminal_and_civil_record' => [
                "C01" => 0,
                "C02" => 0,
                "C03" => 0,
                "C04" => 0,
                "C05" => 0,
                "C06" => 0,
                "C07" => 0,
                "C08" => 0,
            ],
            'business_interest' => [
                "B01" => 0,
                "B02" => 0,
                "B03" => 0,
                "B04" => 0,
            ],
            'other_disqualification' => [
                "O01" => 0,
                "O02" => 0,
                "O03" => 0,
                "O04" => 0,
            ],
            'previous_address' => [],
            'mediclaim' => [],
            'relative_with_bitstring' => []

        ];

        $educationModel = new EducationQualificationModel();
        $professionalQualificationModel = new ProfessionalQualificationModel();
        $gapDeclarationModel = new GapDeclarationModel();
        $mediclaimModel = new MediclaimModel();
        $EmploymentHistoryModel = new EmploymentHistoryModel();

        $joiningFormDetails['employee_other_details'] = $joiningFormDetails['employee_other_details'] ? (array)json_decode($joiningFormDetails['employee_other_details']) : $employee_other_details;
        $joiningFormDetails['education_qualification'] = $educationModel->where('joining_form_id', $id)->find();
        $joiningFormDetails['gap_declaration'] = $gapDeclarationModel->where('joining_form_id', $id)->find();
        $joiningFormDetails['mediclaim'] = $mediclaimModel->where('joining_form_id', $id)->find();
        $joiningFormDetails['professional_qualification'] = $professionalQualificationModel->where('joining_form_id', $id)->find();
        // $joiningFormDetails['professional_qualification'] = $joiningFormDetails['professional_qualification'] ? (array)json_decode($joiningFormDetails['professional_qualification']) : [];
        // $joiningFormDetails['employment_history'] = $joiningFormDetails['employment_history'] ? (array)json_decode($joiningFormDetails['employment_history']) : $employment_history;
        $joiningFormDetails['employment_history'] = $EmploymentHistoryModel->where('joining_form_id', $id)->find();
        $joiningFormDetails['background_info'] = $joiningFormDetails['background_info'] ? (array)json_decode($joiningFormDetails['background_info']) : $backGroundInfo;
        $joiningFormDetails['documents'] = $joiningFormDetails['documents'] ? (array)json_decode($joiningFormDetails['documents']) : [];

        $countDetails = $joiningFormDetails;

        unset($countDetails['id']); //remove for calculation
        unset($countDetails['verification_code']); //remove for calculation
        unset($countDetails['created_by']); //remove for calculation
        unset($countDetails['updated_by']); //remove for calculation
        unset($countDetails['status']); //remove for calculation
        unset($countDetails['created_at']); //remove for calculation
        unset($countDetails['updated_at']); //remove for calculation
        unset($countDetails['deleted_at']); //remove for calculation

        $totalFieldCount = count($countDetails);
        $totalFieldCount_other = count($countDetails['employee_other_details']);
        $totalFilledCount = count(array_filter($countDetails));
        $totalFilledCount_other = count(array_filter($countDetails['employee_other_details']));
        $formComlpletion = number_format((($totalFilledCount + $totalFilledCount_other) / ($totalFieldCount + $totalFieldCount_other) * 100));
        // echo "totalFieldCount:$totalFieldCount totalFilledCount:$totalFilledCount Form Completion: $formColpletion%";

        return $this->respond(['joiningFormDetails' => $joiningFormDetails, 'formComlpletion' => $formComlpletion]);
    }


    public function delete($id = null)
    {
        $model = new ProfileModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                // 'id'=>$id,
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }


    private function gerProfileDetails($id)
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new ProfileModel();
        $educationModel = new ProfileEducationQualificationModel();
        $professionalQualificationModel = new ProfileProfessionalQualificationModel();
        $data = $model->find($id);

        if (!$data) {
            return null;
        }

        $userModel = new UserModel();
        if (!hasCapability('profiles/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        if (!empty($data['certifications'])) {
            $data['certifications'] = json_decode($data['certifications']);
        } else {
            $data['certifications'] = [];
        }

        if (!empty($data['work_experience'])) {
            $data['work_experience'] = json_decode($data['work_experience']);
        } else {
            $data['work_experience'] = [];
        }


        $data['resume_pdf'] = trim($data['resume_pdf']);
        $data['resume_doc'] = trim($data['resume_doc']);
        if (!empty($data['resume_pdf'])) {
            $data['resume_pdf_url'] = base_url('/assets/profiles/' . $data['resume_pdf']);
        } else {
            $data['resume_pdf_url'] = null;
        }

        if (!empty($data['resume_doc'])) {
            $data['resume_doc_url'] = base_url('/assets/profiles/' . $data['resume_doc']);
        } else {
            $data['resume_doc_url'] = null;
        }

        if (!empty($data['preferred_work_locations'])) {
            $data['preferred_work_locations'] = explode(', ', $data['preferred_work_locations']);
        } else {
            $data['preferred_work_locations'] = [];
        }
        if (!empty($data['categories'])) {
            $data['categories'] = explode(', ', $data['categories']);
        } else {
            $data['categories'] = [];
        }

        if (!empty($data['primary_skills'])) {
            $data['primary_skills'] = explode(' || ', $data['primary_skills']);
        } else {
            $data['primary_skills'] = [];
        }

        if (!empty($data['secondary_skills'])) {
            $data['secondary_skills'] = explode(' || ', $data['secondary_skills']);
        } else {
            $data['secondary_skills'] = [];
        }

        if (!empty($data['foundation_skills'])) {
            $data['foundation_skills'] = explode(' || ', $data['foundation_skills']);
        } else {
            $data['foundation_skills'] = [];
        }


        $data['education_qualification'] = $educationModel->where('profile_id', $id)->find();
        $data['professional_qualification'] = $professionalQualificationModel->where('profile_id', $id)->find();
        $data['employment_history'] = $data['employment_history'] ? (array)json_decode($data['employment_history']) : [];
        $data['documents'] = $data['documents'] ? (array)json_decode($data['documents']) : [];

        $createdByDetails = $userModel->find($data['created_by']);
        $updatedByDetails = $userModel->find($data['updated_by']);
        $data['created_by'] = $createdByDetails['fname'] . ' ' . $createdByDetails['lname'];
        $data['updated_by'] = $updatedByDetails['fname'] . ' ' . $updatedByDetails['lname'];

        $data['created_at'] = date(SITE_DATE_TIME_FORMAT, strtotime($data['created_at']));
        $data['updated_at'] = date(SITE_DATE_TIME_FORMAT, strtotime($data['updated_at']));
        $data['jobPositions'] = $model->getJobPositions($id);

        return $data;
    }

    public function getSkillsAutocomplete()
    {


        $query = $this->request->getVar('query');
        $model = new SkillsModel();
        $result = $model->getAutocompleteList($query);
        return $this->respond($result);
    }

    public function addSkill()
    {
        $requestData = (array) $this->request->getJSON(true);

        $model = new SkillsModel();
        $isExist = $model->where('text', $requestData['text'])->find();
        if (!$isExist) {
            return $model->insert($requestData);
        }
        return;
    }

    public function getMyProfile()
    {
        $session = session();
        $profileId = $session->get('profile_id');
        if (empty($session->get('profile_id'))) {
            return $this->fail(['redirectUrl' => base_url(route_to('createMyProfile'))], 403);
        }

        $employment_history = [
            'employers' => [],
        ];

        //get profile details
        $model = new ProfileModel();
        $educationModel = new ProfileEducationQualificationModel();
        $professionalQualificationModel = new ProfileProfessionalQualificationModel();

        $profileDetails = $model->find($profileId);

        $profileDetails['education_qualification'] = $educationModel->where('profile_id', $profileId)->find();
        $profileDetails['professional_qualification'] = $professionalQualificationModel->where('profile_id', $profileId)->find();
        $profileDetails['employment_history'] = $profileDetails['employment_history'] ? (array)json_decode($profileDetails['employment_history']) : $employment_history;
        $profileDetails['documents'] = $profileDetails['documents'] ? (array)json_decode($profileDetails['documents']) : [];

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

        return $this->respond(['profileDetails' => $profileDetails]);
    }

    public function updateMyProfile()
    {
        $session = session();
        $profileId = $session->get('profile_id');
        if (empty($session->get('profile_id'))) {
            return $this->fail(['redirectUrl' => base_url(route_to('createMyProfile'))], 403);
        }
        if (!hasCapability('profiles/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $model = new ProfileModel();
        $requestData = (array) $this->request->getJSON();
        $allowedColums = [
            'id' => '',
            'first_name' => '',
            'last_name' => '',
            'email_primary' => '',
            'mobile_primary' => '',
            'email_alternate' => '',
            'mobile_alternate' => '',
            'gender' => '',
            'martial_status' => '',
            'dob' => '',
            'aadhar_number' => '',
            'pan_number' => '',
            'preferred_work_locations' => '',
            'primary_skills' => '',
            'secondary_skills' => '',
            'foundation_skills' => '',
            'certifications' => '',
            'total_experience' => '',
            'total_experience_y' => '',
            'total_experience_m' => '',
            'relevant_experience' => '',
            'relevant_experience_y' => '',
            'relevant_experience_m' => '',
            'current_company' => '',
            'notice_period' => '',
            'is_negotiable_np' => '',
            'last_working_day' => '',
            'ctc' => '',
            'expected_ctc' => '',
            'is_negotiable_ctc' => '',
            'is_negotiable_ctc' => '',
            'present_address' => '',
            'present_address_postcode' => '',
            'permanent_address' => '',
            'permanent_address_postcode' => '',
        ];
        $requestData = array_intersect_key($requestData, $allowedColums);

        if (isset($requestData['preferred_work_locations'])) {
            $requestData['preferred_work_locations'] = implode(" || ", $requestData['preferred_work_locations']);
        }
        if (isset($requestData['primary_skills'])) {
            $requestData['primary_skills'] = implode(" || ", $requestData['primary_skills']);
        }
        if (isset($requestData['secondary_skills'])) {
            $requestData['secondary_skills'] = implode(" || ", $requestData['secondary_skills']);
        }
        if (isset($requestData['foundation_skills'])) {
            $requestData['foundation_skills'] = implode(" || ", $requestData['foundation_skills']);
        }

        $requestData['total_experience'] = ($requestData['total_experience_y'] * 12) + $requestData['total_experience_m'];
        $requestData['relevant_experience'] = ($requestData['relevant_experience_y'] * 12) + $requestData['relevant_experience_m'];

        $model->save($requestData);

        $response = [
            'id'   => $profileId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }


    public function profileSaveEducationDetails()
    {
        if (!hasCapability('profiles/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $document = $this->request->getFile('edudocument');
        $requestData =  json_decode($_POST['requestData'], true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'id' => '',
            'profile_id' => '',
            'degree' => '',
            'university' => '',
            'institution' => '',
            'from_date' => '',
            'to_date' => '',
            'course_type' => '',
            'percentage' => '',
            'document_path' => '',
        ];
        // $joiningFormId = $requestData['joining_form_id'];
        $requestData = array_intersect_key($requestData, $allowedColums);
        $profileId = $requestData['profile_id'];
        //validation
        $validation =  \Config\Services::validation();


        $rules = [
            'degree' => [
                'label' => 'Degree/course',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The degree/course is required.'
                ]
            ],
            'university' => [
                'label' => 'Course Title along with Board / University',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The board/university is required.'
                ]
            ],
            'institution' => [
                'label' => 'address of school/Institution',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The school/instutution is required.'
                ]
            ],
            'from_date' => [
                'label' => 'From',
                'rules' => 'required|valid_month_year',
                'errors' => [
                    'required' => 'The from date is required.'
                ]
            ],
            'to_date' => [
                'label' => 'To',
                'rules' => 'required|valid_month_year|check_from_date_to_date[' . $requestData['from_date'] . ']',
                'errors' => [
                    'required' => 'The to date is required.',
                    'check_from_date_to_date' => 'To date should be greater than from date.'
                ]
            ],
            'course_type' => [
                'label' => 'Course Type',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The course type is required.'
                ]
            ],
            'percentage' => [
                'label' => 'Percentage/CGPA',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The percentage/CGPA is required.'
                ]
            ],
        ];


        if (empty($requestData['document_path']) || !file_exists(PROFILE_DOCUMENTS_PATH . $requestData['document_path'])) {
            // $rules['edudocument'] = ['label' => 'Document', 'rules' => 'uploaded[edudocument]|max_size[edudocument,1000]|mime_in[edudocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        if (!file_exists(PROFILE_DOCUMENTS_PATH . $requestData['document_path'])) {

            // $rules['edudocument'] = ['label' => 'Document', 'rules' => 'uploaded[edudocument]|max_size[edudocument,1000]|mime_in[edudocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        if ($document) {
            $rules['edudocument'] = ['label' => 'Document', 'rules' => 'uploaded[edudocument]|max_size[edudocument,1000]|mime_in[edudocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        $validation->setRules(
            $rules
        );




        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['education_qualification' => "Please fill all the fields."], 400);
        }


        if (isset($document)) {
            $pathToUpload = "profile_" . $profileId;

            if (!file_exists(str_replace(APPPATH, '', PROFILE_DOCUMENTS_PATH) . $pathToUpload)) {
                mkdir(str_replace(APPPATH, '', PROFILE_DOCUMENTS_PATH) . $pathToUpload, 0777, true);
                fopen(str_replace(APPPATH, '', PROFILE_DOCUMENTS_PATH) . $pathToUpload . "/index.html", 'w');
            }

            $newName = $document->getRandomName();
            $document->move(PROFILE_DOCUMENTS_PATH . $pathToUpload, $newName);
            //remove old document

            if (isset($requestData['document_path'])) {
                if (file_exists(PROFILE_DOCUMENTS_PATH . $requestData['document_path']) && !empty($requestData['document_path'])) {

                    unlink(PROFILE_DOCUMENTS_PATH . $requestData['document_path']);
                }
            }

            $requestData['document_path'] = $pathToUpload . '/' . $newName;
        }

        $model = new ProfileEducationQualificationModel();


        //$requestData['education_qualification'] = $requestData['education_qualification'] ? json_encode($requestData['education_qualification']) : null;
        if (empty($requestData['id'])) {
            $model->insert($requestData);
        } else {
            $model->save($requestData);
        }


        $response = [
            'list' => $model->where('profile_id', $profileId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function profileRemoveEducationDetails()
    {

        if (!hasCapability('profiles/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new ProfileEducationQualificationModel();
        $educationDetails = (array)$model->find($id);
        $model->delete($id);
        $profileId = $educationDetails['profile_id'];
        //remove document

        if (file_exists(PROFILE_DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
            unlink(PROFILE_DOCUMENTS_PATH . $educationDetails['document_path']);
        }

        $response = [
            'list' => $model->where('profile_id', $profileId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Deleted'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function profileSaveProfetionalQualification()
    {
        if (!hasCapability('profiles/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $document = $this->request->getFile('professionalDocument');
        $requestData =  json_decode($_POST['requestData'], true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'id' => '',
            'profile_id' => '',
            'qualification' => '',
            'category' => '',
            'date' => '',
            'document_path' => '',
        ];
        // $joiningFormId = $requestData['joining_form_id'];
        $requestData = array_intersect_key($requestData, $allowedColums);
        $profileId = $requestData['profile_id'];
        //validation
        $validation =  \Config\Services::validation();


        $rules = [
            'qualification' => [
                'label' => 'Qualification',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The qualification is required.'
                ]
            ],
            'category' => [
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The category is required.'
                ]
            ],
            'date' => [
                'label' => 'Date',
                'rules' => 'required|valid_month_year',
                'errors' => [
                    'required' => 'The date is required.'
                ]
            ],
        ];

        if (empty($requestData['document_path']) || !file_exists(PROFILE_DOCUMENTS_PATH . $requestData['document_path'])) {

            // $rules['professionalDocument'] = ['label' => 'Certificate', 'rules' => 'uploaded[professionalDocument]|max_size[professionalDocument,1000]|mime_in[professionalDocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        if (!file_exists(PROFILE_DOCUMENTS_PATH . $requestData['document_path'])) {
            //  $rules['professionalDocument'] = ['label' => 'Certificate', 'rules' => 'uploaded[professionalDocument]|max_size[professionalDocument,1000]|mime_in[professionalDocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];


        }

        if ($document) {

            $rules['professionalDocument'] = ['label' => 'Certificate', 'rules' => 'uploaded[professionalDocument]|max_size[professionalDocument,1000]|mime_in[professionalDocument,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'];
        }

        $validation->setRules(
            $rules
        );




        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['education_qualification' => "Please fill all the fields."], 400);
        }


        if (isset($document)) {
            $pathToUpload = "profile_" . $profileId;

            if (!file_exists(str_replace(APPPATH, '', PROFILE_DOCUMENTS_PATH) . $pathToUpload)) {
                mkdir(str_replace(APPPATH, '', PROFILE_DOCUMENTS_PATH) . $pathToUpload, 0777, true);
                fopen(str_replace(APPPATH, '', PROFILE_DOCUMENTS_PATH) . $pathToUpload . "/index.html", 'w');
            }

            $newName = $document->getRandomName();
            $document->move(PROFILE_DOCUMENTS_PATH . $pathToUpload, $newName);
            //remove old document

            if (isset($requestData['document_path'])) {
                if (file_exists(PROFILE_DOCUMENTS_PATH . $requestData['document_path']) && !empty($requestData['document_path'])) {

                    unlink(PROFILE_DOCUMENTS_PATH . $requestData['document_path']);
                }
            }

            $requestData['document_path'] = $pathToUpload . '/' . $newName;
        }

        $model = new ProfileProfessionalQualificationModel();

        //calculate age from dob
        // $bday = new DateTime($requestData['dob']); // Your date of birth
        // $today = new Datetime(date('m.d.y'));
        // $diff = $today->diff($bday);
        // $requestData['age'] = $diff->y;
        //$requestData['education_qualification'] = $requestData['education_qualification'] ? json_encode($requestData['education_qualification']) : null;
        if (empty($requestData['id'])) {
            $model->insert($requestData);
        } else {
            $model->save($requestData);
        }


        $response = [
            'list' => $model->where('profile_id', $profileId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function profileRemoveProfetionalQualification()
    {
        if (!hasCapability('profiles/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new ProfileProfessionalQualificationModel();

        $educationDetails = (array)$model->find($id);
        $model->delete($id);
        $profileId = $educationDetails['profile_id'];
        //remove document

        if (file_exists(PROFILE_DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
            unlink(PROFILE_DOCUMENTS_PATH . $educationDetails['document_path']);
        }

        $response = [
            'list' => $model->where('profile_id', $profileId)->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Deleted'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function profileSaveEmploymentHistory()
    {
        if (!hasCapability('profiles/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON(true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'employment_history' => ''
        ];
        $profileId = $requestData['id'];
        $requestData = array_intersect_key($requestData, $allowedColums);

        $valid = true;
        //validation
        $validation =  \Config\Services::validation();
        $rules = [];


        if (!empty($requestData['employment_history']['employers'])) {
            foreach ($requestData['employment_history']['employers'] as $key => $employer) {
                $rules["employment_history.employers.$key.company"] = [
                    'label' => 'Company',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The company name is required.'
                    ]
                ];
                // $rules["employment_history.employers.$key.department"] = ['label' => 'Department', 'rules' => 'required'];
                // $rules["employment_history.employers.$key.position_held"] = ['label' => 'Position Held', 'rules' => 'required'];
                // $rules["employment_history.employers.$key.nature_of_job"] = [
                //     'label' => 'Nature of Job',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'The nature of job is required.'
                //     ]
                // ];
                // $rules["employment_history.employers.$key.reporting_manager"] = [
                //     'label' => 'Name of Reporting Manager',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'The name of reporting manager is required.'
                //     ]
                // ];
                $rules["employment_history.employers.$key.from_date"] = [
                    'label' => 'From date',
                    'rules' => 'valid_month_year',
                ];
                $rules["employment_history.employers.$key.to_date"] = [
                    'label' => 'To date',
                    'rules' => 'valid_month_year|check_from_date_to_date[' . $employer['from_date'] . ']',
                    'errors' =>
                    [
                        'check_from_date_to_date' => 'To date should be greater than from date.'
                    ]
                ];
                // $rules["employment_history.employers.$key.contact_number_manager"] = [
                //     'label' => 'Contact Number',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'The contact number of manager is required.'
                //     ]
                // ];
                // $rules["employment_history.employers.$key.email_manager"] = [
                //     'label' => 'Email',
                //     'rules' => 'required|valid_email',
                //     'errors' => [
                //         'required' => 'The e-mail of manager is required.',
                //         'valid_email' => 'Enter valid e-mail.'
                //     ]
                // ];
            }
        }

        // if (!empty($requestData['employment_history']['gap_declaration'])) {
        //     foreach ($requestData['employment_history']['gap_declaration'] as $key => $gap) {
        //         $rules["employment_history.gap_declaration.$key.particular"] = ['label' => 'Particulars', 'rules' => 'required'];
        //         $rules["employment_history.gap_declaration.$key.from_date"] = ['label' => 'From', 'rules' => 'required'];
        //         $rules["employment_history.gap_declaration.$key.to_date"] = ['label' => 'To', 'rules' => 'required'];
        //     }
        // }


        if ($rules) {
            $validation->setRules(
                $rules
            );
            $valid = $validation->run($requestData);
        }

        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['gap_declaration' => "Please fill all the fields."], 400);
        }

        $model = new ProfileModel();
        $requestData['employment_history'] = $requestData['employment_history'] ? json_encode($requestData['employment_history']) : null;
        $id =  $model->update($profileId, $requestData);

        $response = [
            'id'   => $profileId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function myProfileUploadDocument()
    {

        if (!hasCapability('profiles/edit')) {
            // return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        if (!hasCapability('profiles/update_documents')) {
            // return $this->fail(['errorMessage' => "You don't have capability to update documents. Please contact to admin."], 403);
        }

        $document = $this->request->getFile('document');
        $requestData = $this->request->getPost();
        $id = $this->request->getPost('id'); // json_decode($_POST['requestData'], true);
        $documentName = $this->request->getPost('documentName'); // json_decode($_POST['requestData'], true);
        helper('form');
        $validation =  \Config\Services::validation();

        $rules = [
            'documentName' => ['label' => 'Document Name', 'rules' => 'required', 'errors' => ['required' => 'Select a document name.']],
            // 'document' => 'uploaded[document]|max_size[document,500]|mime_in[image,image/png,image/jpg,image/jpeg,image/bmp]',
            'document' => ['label' => 'Document', 'rules' => 'uploaded[document]|max_size[document,1000]|mime_in[document,image/png,image/jpg,image/jpeg,image/bmp,application/pdf,application/force-download,application/x-download,application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-zip]'],
        ];



        $validation->setRules($rules, [
            'document' => [
                'uploaded' => 'Please select a file.',
                'max_size' => 'File size is more than 1MB.',
                'mime_in' => 'Please upload an image/pdf/doc/docx file.',
            ]
        ]);
        $valid = $validation->run($requestData);
        if (!$valid) {

            return $this->fail($validation->getErrors(), 400);
        }


        //get document list
        $model = new ProfileModel();
        $joiningFormDetails = (array)$model->find($id);



        $documentDetails = $joiningFormDetails['documents'] ? (array)json_decode($joiningFormDetails['documents']) : [];

        if (isset($document)) {
            $pathToUpload = "profile_" . $id;
            if (!file_exists(str_replace(APPPATH, '', PROFILE_DOCUMENTS_PATH) . $pathToUpload)) {
                mkdir(str_replace(APPPATH, '', PROFILE_DOCUMENTS_PATH) . $pathToUpload, 0777, true);
                fopen(str_replace(APPPATH, '', PROFILE_DOCUMENTS_PATH) . $pathToUpload . "/index.html", 'w');
            }

            $newName = $document->getRandomName();
            $document->move(PROFILE_DOCUMENTS_PATH . $pathToUpload, $newName);
            //remove old document

            if (isset($documentDetails[$documentName])) {
                if (file_exists(PROFILE_DOCUMENTS_PATH . $documentDetails[$documentName]->path)) {
                    unlink(ROOTPATH . $documentDetails[$documentName]->path);
                }
            }
            $doc['path'] = $pathToUpload . '/' . $newName;
            $doc['file_name'] = $document->getClientName();
            $doc['documentNote'] = $requestData['documentNote'];
            $documentDetails[$documentName] = $doc;
        }


        $saveData['documents'] = $documentDetails ? json_encode($documentDetails) : null;
        $model->update($id, $saveData);
        $response = [
            'id'   => $id,
            'action_type' => 'Updated',
            'error'    => null,
            'documentList' => $documentDetails,
            'messages' => [
                'success' => 'Updated successfully',
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function myProfileRemoveDocument()
    {
        $requestData = (array) $this->request->getJSON();

        //get document details
        $model = new ProfileModel();
        $joiningFormDetails = (array)$model->find($requestData['id']);

        //if joining form is approved the link will not be send
        //  if($joiningFormDetails['status']=='2' && !hasCapability('joining_form/update_approved')){
        //     return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        // }

        $joiningFormDetails['documents'] = $joiningFormDetails['documents'] ? (array)json_decode($joiningFormDetails['documents']) : [];
        $documentDetails = $joiningFormDetails['documents'];

        //unlink document
        if (file_exists(PROFILE_DOCUMENTS_PATH . $documentDetails[$requestData['document']]->path)) {
            unlink(PROFILE_DOCUMENTS_PATH . $documentDetails[$requestData['document']]->path);
        }
        unset($documentDetails[$requestData['document']]);


        $saveData['documents'] = $documentDetails ? json_encode($documentDetails) : null;
        $model->update($requestData['id'], $saveData);

        $response = [
            'id'   => $requestData['id'],
            'action_type' => 'delete',
            'error'    => null,
            'documentList' => $documentDetails,
            'messages' => [
                'success' => 'Document removed.',
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function testing()
    {

        $session = session();

        $profileId = $session->get('profile_id');
        echo "Profile: $profileId";
        die;
    }
}


// personal email
// company email id
// employee id
// combine fname & Lname
// click on name link