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
use App\Models\PolicyDocumentsModel;
use DateTime;
use Firebase\JWT\JWT;

class MyJoiningForm extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];
    protected $joingFormId = '';
    protected $user;
    protected $joiningFormDetails;

    public function __construct(){
            
        $this->user = checkUserToken();

        if (!$this->user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new EmployeeJoinigDetailsModel();
        $this->joiningFormDetails = $model->where('user_id',$this->user['id'])->first();

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
        $PolicyDocumentsModel = new PolicyDocumentsModel();

        $this->joiningFormDetails['employee_other_details'] = $this->joiningFormDetails['employee_other_details'] ? (array)json_decode($this->joiningFormDetails['employee_other_details'], true) : $employee_other_details;
        $this->joiningFormDetails['education_qualification'] = $educationModel->where('joining_form_id', $this->joiningFormDetails['id'])->find();
        $this->joiningFormDetails['gap_declaration'] = $gapDeclarationModel->where('joining_form_id', $this->joiningFormDetails['id'])->find();
        $this->joiningFormDetails['mediclaim'] = $mediclaimModel->where('joining_form_id', $this->joiningFormDetails['id'])->find();
        $this->joiningFormDetails['professional_qualification'] = $professionalQualificationModel->where('joining_form_id', $this->joiningFormDetails['id'])->find();
        // $this->joiningFormDetails['professional_qualification'] = $this->joiningFormDetails['professional_qualification'] ? (array)json_decode($this->joiningFormDetails['professional_qualification']) : [];
        // $this->joiningFormDetails['employment_history'] = $this->joiningFormDetails['employment_history'] ? (array)json_decode($this->joiningFormDetails['employment_history']) : $employment_history;
        $this->joiningFormDetails['employment_history'] = $EmploymentHistoryModel->where('joining_form_id', $this->joiningFormDetails['id'])->find();
        $this->joiningFormDetails['background_info'] = $this->joiningFormDetails['background_info'] ? (array)json_decode($this->joiningFormDetails['background_info'], true) : $backGroundInfo;
        $this->joiningFormDetails['documents'] = $this->joiningFormDetails['documents'] ? (array)json_decode($this->joiningFormDetails['documents'], true) : [];
        $this->joiningFormDetails['policy_documents'] = $PolicyDocumentsModel->getPolicyDocUser($this->user['id']);
    }

    public function getJoingformDetails()
    {
        $countDetails = $this->joiningFormDetails;

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

        return $this->respond(['joiningFormDetails' => $this->joiningFormDetails, 'formComlpletion' => $formComlpletion]);
    }

    public function joiningFormSaveEmployeeDetails()
    {

        $requestData = (array) $this->request->getJSON();
        $errors = null;
        //if joining form is approved 
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
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
                'rules' => 'required|valid_email|is_unique[employee_joining_form_details.email_primary,id,' . $this->joiningFormDetails['id'] . ']',
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
            $errors = $validation->getErrors();
            // return $this->fail($errors, 400);
        }

        
        $oldData = array_intersect_key($this->joiningFormDetails,$requestData);
        unset($oldData['employee_other_details']);
        $changed_data = array_diff_assoc((array)$requestData, (array) $oldData);
        
        $changed_data['employee_other_details'] = array_diff_assoc((array)$requestData['employee_other_details'], (array)$this->joiningFormDetails['employee_other_details']);

        if(count($changed_data['employee_other_details'])==0){
            unset($changed_data['employee_other_details']);
        }
        $requestData['employee_other_details'] = $requestData['employee_other_details'] ? json_encode($requestData['employee_other_details']) : null;

        $model = new EmployeeJoinigDetailsModel();
        $updated =  $model->update($this->joiningFormDetails['id'], $requestData);

        //action log

        if (!empty($changed_data) && $updated) {
            $actionLogData = [
                'action_type' => 'updated',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode(['personal_details' => $changed_data])
            ];
            creatActionLog($actionLogData);
        }

        $response = [
            'id'   => $this->joiningFormDetails['id'],
            'action_type' => 'Updated',
            'error'    => $errors,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveEducationDetails()
    {

       

        // if (!hasCapability('joining_form/edit')) {
        //     return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        // }


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
       

        
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
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
            $pathToUpload = "form_" . $this->joiningFormDetails['id'];

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

            if ($model->insert($requestData)) {
                $actionLogData = [
                    'action_type' => 'created',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['academics' => $requestData])
                ];
                creatActionLog($actionLogData);
            }
        } else {

            $oldData = $model->find($requestData['id']);
            $changed_data = array_diff_assoc((array)$requestData, (array)$oldData);
            if ($model->save($requestData)) {
                $actionLogData = [

                    'action_type' => 'updated',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['academics' => $changed_data])
                ];
                creatActionLog($actionLogData);
            }
        }





        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
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

       

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new EducationQualificationModel();
        $educationDetails = (array)$model->find($id);
       

        $EmployeeJoinigDetailsModel = new EmployeeJoinigDetailsModel();
        $formDetails = $EmployeeJoinigDetailsModel->find($this->joiningFormDetails['id']);
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }



        if ($model->delete($id)) {
            $actionLogData = [

                'action_type' => 'deleted',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode(['academics' => $educationDetails])
            ];
            creatActionLog($actionLogData);
        }
        //remove document

        // if (file_exists(DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
        //     unlink(DOCUMENTS_PATH . $educationDetails['document_path']);
        // }

        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
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
       


        
        
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
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
            $pathToUpload = "form_" . $this->joiningFormDetails['id'];

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

            if ($model->insert($requestData)) {
                $actionLogData = [

                    'action_type' => 'created',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['gap_declaration' => $requestData])
                ];
                creatActionLog($actionLogData);
            }
        } else {


            $oldData = $model->find($requestData['id']);
            $changed_data = array_diff_assoc((array)$requestData, (array)$oldData);
            if ($model->save($requestData)) {
                $actionLogData = [

                    'action_type' => 'updated',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['academics' => $changed_data])
                ];
                creatActionLog($actionLogData);
            }
        }


        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
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
        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new GapDeclarationModel();

        $educationDetails = (array)$model->find($id);
        
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }


        if ($model->delete($id)) {
            $actionLogData = [

                'action_type' => 'deleted',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode(['gap_declaration' => $educationDetails])
            ];
            creatActionLog($actionLogData);
        }
        //remove document

        // if (file_exists(DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
        //     unlink(DOCUMENTS_PATH . $educationDetails['document_path']);
        // }

        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
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
       
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
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
            $pathToUpload = "form_" . $this->joiningFormDetails['id'];

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
            if ($model->insert($requestData)) {
                $actionLogData = [

                    'action_type' => 'created',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['mediclaim' => $requestData])
                ];
                creatActionLog($actionLogData);
            }
        } else {
            $oldData = $model->find($requestData['id']);

            $changed_data = array_diff_assoc((array)$requestData, (array)$oldData);
            if ($model->save($requestData)) {
                $actionLogData = [

                    'action_type' => 'updated',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['mediclaim' => $changed_data])
                ];
                creatActionLog($actionLogData);
            }
        }


        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
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
       
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }


        if ($model->delete($id)) {
            $actionLogData = [

                'action_type' => 'deleted',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode(['mediclaim' => $educationDetails])
            ];
            creatActionLog($actionLogData);
        }
        //remove document

        // if (file_exists(DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
        //     unlink(DOCUMENTS_PATH . $educationDetails['document_path']);
        // }

        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
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
        

        
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
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

            $pathToUpload = "form_" . $this->joiningFormDetails['id'];

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

        
        //$requestData['education_qualification'] = $requestData['education_qualification'] ? json_encode($requestData['education_qualification']) : null;
        if (empty($requestData['id'])) {

            if ($model->insert($requestData)) {
                $actionLogData = [

                    'action_type' => 'created',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['professional_qualification' => $requestData])
                ];
                creatActionLog($actionLogData);
            }
        } else {
            $oldData = $model->find($requestData['id']);

            $changed_data = array_diff_assoc((array)$requestData, (array)$oldData);
            if ($model->save($requestData)) {
                $actionLogData = [

                    'action_type' => 'updated',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['professional_qualification' => $changed_data])
                ];
                creatActionLog($actionLogData);
            }
        }


        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
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
       

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new ProfessionalQualificationModel();

        $educationDetails = (array)$model->find($id);
        
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        if ($model->delete($id)) {
            $actionLogData = [

                'action_type' => 'deleted',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode(['professional_qualification' => $educationDetails])
            ];
            creatActionLog($actionLogData);
        }
        //remove document

        // if (file_exists(DOCUMENTS_PATH . $educationDetails['document_path']) && !empty($educationDetails['document_path'])) {
        //     unlink(DOCUMENTS_PATH . $educationDetails['document_path']);
        // }

        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Deleted'
            ]
        ];
        return $this->respondUpdated($response);
    }


    public function joiningFormSaveEmploymentHistory_()
    {

      

        $requestData = (array) $this->request->getJSON(true);
        


        $validation =  \Config\Services::validation();
        $rules = [
            "company" => [
                'label' => 'Company',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The company name is required.'
                ]
            ],
            "nature_of_job" => [
                'label' => 'Nature of Job',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The nature of job is required.'
                ]
            ],
            "reporting_manager" => [
                'label' => 'Name of Reporting Manager',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The name of reporting manager is required.'
                ]
            ],

            "contact_number_manager" => [
                'label' => 'Contact Number',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The contact number of manager is required.'
                ]
            ],
            "email_manager" => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'The e-mail of manager is required.',
                    'valid_email' => 'Enter valid e-mail.'
                ]
            ],


        ];


        if (!empty($requestData['from_date'])) {
            $rules["from_date"] = [
                'label' => 'From date',
                'rules' => 'valid_month_year',
            ];
        }

        if (!empty($requestData['to_date'])) {
            $rules["to_date"] = [
                'label' => 'To date',
                'rules' => 'valid_month_year|check_from_date_to_date[' . $requestData['from_date'] . ']',
                'errors' => [
                    'check_from_date_to_date' => 'To date should be greater than from date.'
                ]
            ];
        }

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

            if ($model->insert($requestData)) {
                $actionLogData = [

                    'action_type' => 'created',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['employment' => $requestData])
                ];
                creatActionLog($actionLogData);
            }
        } else {

            $oldData = $model->find($requestData['id']);
            $changed_data = array_diff_assoc((array)$requestData, (array)$oldData);
            if ($model->save($requestData)) {
                $actionLogData = [

                    'action_type' => 'updated',
                    'model' => 'joining_form',
                    'record_id' => $this->joiningFormDetails['id'],
                    'chaged_data' => json_encode(['employment' => $changed_data])
                ];
                creatActionLog($actionLogData);
            }
        }


        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
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
       

        $requestData =  $this->request->getJSON(true);
        $id = $requestData['id'];

        $model = new EmploymentHistoryModel();

        $educationDetails = (array)$model->find($id);
       

       
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        if ($model->delete($id)) {
            $actionLogData = [

                'action_type' => 'deleted',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode(['employment' => $educationDetails])
            ];
            creatActionLog($actionLogData);
        }
        //remove document


        $response = [
            'list' => $model->where('joining_form_id', $this->joiningFormDetails['id'])->find(),
            'action_type' => 'Delete',
            'error'    => null,
            'messages' => [
                'success' => 'Deleted'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveBackgroundInfo()
    {
      

        $requestData = (array) $this->request->getJSON(true);
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'background_info' => ''
        ];
        
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
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
        $changed_data['background_info']['criminal_and_civil_record'] = array_diff_assoc((array)$requestData['background_info']['criminal_and_civil_record'], (array)$this->joiningFormDetails['background_info']['criminal_and_civil_record']);
        $changed_data['background_info']['business_interest'] = array_diff_assoc((array)$requestData['background_info']['business_interest'], (array)$this->joiningFormDetails['background_info']['business_interest']);
        $changed_data['background_info']['other_disqualification'] = array_diff_assoc((array)$requestData['background_info']['other_disqualification'], (array)$this->joiningFormDetails['background_info']['other_disqualification']);

        // $changed_data['background_info']['criminal_and_civil_record']  = array_filter($changed_data['background_info']['criminal_and_civil_record']);
        // $changed_data['background_info']['business_interest']  = array_filter($changed_data['background_info']['business_interest']);
        // $changed_data['background_info']['other_disqualification']  = array_filter($changed_data['background_info']['other_disqualification']);
        $changed_data['background_info']  = array_filter($changed_data['background_info']);

        $requestData['background_info'] = $requestData['background_info'] ? json_encode($requestData['background_info']) : null;



        if ($model->update($this->joiningFormDetails['id'], $requestData)) {
            $actionLogData = [

                'action_type' => 'updated',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode($changed_data)
            ];
            creatActionLog($actionLogData);
        }

        $response = [
            'id'   => $this->joiningFormDetails['id'],
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

     

        $document = $this->request->getFile('document');
        $requestData = $this->request->getPost();
        
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
       

        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        $documentDetails = $this->joiningFormDetails['documents'] ? (array)json_decode($this->joiningFormDetails['documents'], true) : [];
        $documentDetailsOld = $documentDetails;
        if (isset($document)) {
            $pathToUpload = "form_" . $this->joiningFormDetails['id'];
            if (!file_exists(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload)) {
                mkdir(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload, 0777, true);
                fopen(str_replace(APPPATH, '', DOCUMENTS_PATH) . $pathToUpload . "/index.html", 'w');
            }

            $newName = $document->getRandomName();
            $document->move(DOCUMENTS_PATH . $pathToUpload, $newName);
            //remove old document

            if (isset($documentDetails[$documentName])) {
                if (file_exists(DOCUMENTS_PATH . $documentDetails[$documentName]['path'])) {
                    unlink(DOCUMENTS_PATH . $documentDetails[$documentName]['path']);
                }
            }



            $doc['path'] = $pathToUpload . '/' . $newName;
            $doc['file_name'] = $document->getClientName();
            $doc['documentNote'] = $requestData['documentNote'];
            $documentDetails[$documentName] = $doc;
        }


        $saveData['documents'] = $documentDetails ? json_encode($documentDetails) : null;

        $changed_data = [];
        if (isset($documentDetailsOld[$documentName])) {
            $changed_data[$documentName] = array_diff_assoc((array)$documentDetails[$documentName], (array)$documentDetailsOld[$documentName]);
        } else {
            $changed_data[$documentName] = (array)$documentDetails[$documentName];
        }
        // foreach($documentDetails as $key=>$rowItem){
        //     $changed_data[$key] = array_diff_assoc((array)$documentDetails[$key], (array)$documentDetailsOld[$key]);
        // }

        $changed_data = array_filter($changed_data);

        // $changed_data = array_diff_assoc((array)$documentDetails, (array)$documentDetailsOld);
        if ($model->update($this->joiningFormDetails['id'], $saveData)) {
            $actionLogData = [

                'action_type' => 'updated',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode(['documents' => $changed_data])
            ];
            creatActionLog($actionLogData);
        }

        $response = [
            'id'   => $this->joiningFormDetails['id'],
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
      

        $requestData = (array) $this->request->getJSON();

        //get document details
        $model = new EmployeeJoinigDetailsModel();
       
        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        $joiningFormDetails['documents'] = $this->joiningFormDetails['documents'] ? (array)json_decode($this->joiningFormDetails['documents'], true) : [];
        $documentDetails = $joiningFormDetails['documents'];

        //unlink document
        // if (file_exists(DOCUMENTS_PATH . $documentDetails[$requestData['document']]->path)) {
        //     unlink(DOCUMENTS_PATH . $documentDetails[$requestData['document']]->path);
        // }
        unset($documentDetails[$requestData['document']]);


        $saveData['documents'] = $documentDetails ? json_encode($documentDetails) : null;

        if ($model->update($requestData['id'], $saveData)) {
            $actionLogData = [

                'action_type' => 'deleted',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode(['documents' => $requestData['document']])
            ];
            creatActionLog($actionLogData);
        }

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

      
        $requestData = (array) $this->request->getJSON();
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'is_accept_declaration' => '',
            'employee_other_details' => ''
        ];
       
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

       

        //if joining form is approved the link will not be send
        if ($this->joiningFormDetails['status'] == '2' && !hasCapability('joining_form/update_approved')) {
            return $this->fail(['errorMessage' => "Joining details are approved so you can not update details. Please contact to admin."], 403);
        }

        /*Start::validate Entire joining form */
        // $formDetails['employee_other_details'] = $this->joiningFormDetails['employee_other_details'] ? (array)json_decode($formDetails['employee_other_details'], true) : $employee_other_details;
        // $formDetails['education_qualification'] = $educationModel->where('joining_form_id', $joiningFormId)->find();
        // $formDetails['gap_declaration'] = $gapDeclarationModel->where('joining_form_id', $joiningFormId)->find();
        // $formDetails['mediclaim'] = $mediclaimModel->where('joining_form_id', $joiningFormId)->find();
        // $formDetails['professional_qualification'] = $professionalQualificationModel->where('joining_form_id', $joiningFormId)->find();
        // // $joiningFormDetails['professional_qualification'] = $joiningFormDetails['professional_qualification'] ? (array)json_decode($joiningFormDetails['professional_qualification']) : [];
        // $formDetails['employment_history'] = $formDetails['employment_history'] ? (array)json_decode($formDetails['employment_history'], true) : $employment_history;
        // $formDetails['background_info'] = $formDetails['background_info'] ? (array)json_decode($formDetails['background_info'], true) : $backGroundInfo;
        // $formDetails['documents'] = $formDetails['documents'] ? (array)json_decode($formDetails['documents'], true) : [];


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
                'rules' => 'required|valid_email|is_unique[employee_joining_form_details.email_primary,id,' . $this->joiningFormDetails['id'] . ']',
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

        foreach ($this->joiningFormDetails['education_qualification']  as $key => $education) {
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

        foreach ($this->joiningFormDetails['professional_qualification']  as $key => $education) {
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

        foreach ($this->joiningFormDetails['mediclaim']  as $key => $education) {
            // $mediclaimRules["mediclaim.$key.name"] = ['label' => 'Name ', 'rules' => 'required'];
            // $mediclaimRules["mediclaim.$key.relationship"] = ['label' => 'Relationship', 'rules' => 'required'];
            // $mediclaimRules["mediclaim.$key.dob"] = ['label' => 'Date of Birth', 'rules' => 'required'];
            $mediclaimRules["mediclaim.$key.document_path"] = ['label' => 'Photo', 'rules' => 'required'];

            $messages["mediclaim.$key.document_path"]["required"] = "Please upload photo.";
        }

        $documentsRules['documents.aadhar_card.path'] =  ['label' => 'Aadhar Card', 'rules' => 'required'];
        $messages['documents.aadhar_card']['required'] = "Please upload Aadhar Card.";

        $documentsRules['documents.cheque.path'] =  ['label' => 'Cancelled Cheque', 'rules' => 'required'];
        $messages['documents.cheque']['required'] = "Please upload Cancelled Cheque.";

        $documentsRules['documents.pan_card.path'] =  ['label' => 'PAN Card', 'rules' => 'required'];
        $messages['documents.pan_card']['required'] = "Please upload PAN Card.";




        $rules = array_merge($employeDeatilsRules, $educationQualificationRules, $professionalQualificationRules, $gapDeclarationRules, $mediclaimRules, $documentsRules);

        $validation->setRules(
            $rules,
            $messages
        );

        $valid = $validation->run($this->joiningFormDetails);
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

        if ($model->update($this->joiningFormDetails['id'], $requestData)) {
            $actionLogData = [

                'action_type' => 'updated',
                'model' => 'joining_form',
                'record_id' => $this->joiningFormDetails['id'],
                'chaged_data' => json_encode(['accept_declaration' => 'Yes'])
            ];
            creatActionLog($actionLogData);
        }
        //send mail to employee 
        $payload = [
            'ist' => time(),
            'iss' => base_url(),
            'exp' => time() + (60 * 60 * 48), //sec * min * hrs (valid for 48 hrs)
            'joiningFormId' => $this->joiningFormDetails['id'],
        ];

        $token = JWT::encode($payload, JWT_SECRETE_KEY);

        $templateData = [
            'first_name' => $this->joiningFormDetails['first_name'],
            'downloadLink' => base_url(route_to('downloadMyJoiningForm', $token)),
        ];

        $message = view('email-templates/thank-you-message', $templateData);
        $isEmailSent =  sendEmail_common($this->joiningFormDetails['email_primary'], $message, 'Bitstringit - Joining Form', HR_EMAIL);

        //send mail to hr
        $templateData = [
            'first_name' => $this->joiningFormDetails['first_name'],
            'last_name' => $this->joiningFormDetails['last_name'],
            'link' => base_url(route_to('editJoiningForm', $this->joiningFormDetails['id'])),
        ];

        $message = view('email-templates/joining-form-submited-hr', $templateData);
        $isEmailSent =  sendEmail_common(HR_EMAIL, $message, 'Bitstringit - Joining Form', $this->joiningFormDetails['email_primary']);


        $response = [
            'id'   => $this->joiningFormDetails['id'],
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]

        ];
        return $this->respondUpdated($response);
    }

   
}