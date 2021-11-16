<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProfileModel;
use App\Models\UserModel;
use App\Models\EmployeeJoinigDetailsModel;
use App\Models\SkillsModel;

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
            $iSearch[] = " `middle_skills` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `foundation_skills` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `certifications` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `categories` LIKE '%" . $searchKey['value'] . "%' ";

            $iSearch_str = implode(' OR ', $iSearch);
        }

        $filter = array();

        if (isset($_POST['filter'])) {
            $filter = $_POST['filter'];
        }

        $data = $model->getList($filter, $iSearch_str, $start, $length, $orderBy);

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

        if (isset($requestData['top_skills'])) {
            $requestData['top_skills'] = implode(", ", $requestData['top_skills']);
        }
        if (isset($requestData['middle_skills'])) {
            $requestData['middle_skills'] = implode(", ", $requestData['middle_skills']);
        }
        if (isset($requestData['foundation_skills'])) {
            $requestData['foundation_skills'] = implode(", ", $requestData['foundation_skills']);
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

        $resumepdf = $this->request->getFile('resumepdf');
        $resumeword = $this->request->getFile('resumeword');
        $requestData =  json_decode($_POST['requestData'], true);




        $validation =  \Config\Services::validation();

        $rules = [
            // 'tag_id' => 'required',
            // 'animal_type_id' => 'required',
            // 'breed_type_id' => 'required',
            // 'gender' => 'required'
            // 'tag_id' => 'required|alpha_numeric|is_unique[animals.tag_id,id,{id}]',
            // 'animal_type_id' => 'required',
            // 'breed_type_id' => 'required',
            // 'gender' => 'required'

        ];




        $validation->setRules(
            $rules,
            [   // Errors
                'tag_id' => [
                    'required' => lang('forms.register.tag_id.errorRequired'),
                    'alpha_numeric' => lang('forms.register.tag_id.errorAlphanumeric'),
                    'is_unique' => lang('forms.register.tag_id.errorUnique')
                ],
                'animal_type_id' => [
                    'required' => lang('forms.register.animal_type_id.errorRequired')
                ],
                'breed_type_id' => [
                    'required' => lang('forms.register.breed_type_id.errorRequired')
                ],
                'gender' => [
                    'required' => lang('forms.register.gender.errorRequired')
                ],
                'mother_tag_id' => [
                    'required' => lang('forms.register.mother_tag_id.errorRequired'),
                    // 'is_unique' => lang('forms.register.mother_tag_id.errorUnique')
                ],
                'date_of_birth' => [
                    'required' => lang('forms.register.date_of_birth.errorRequired')
                ],
                'purchase_date' => [
                    'required' => lang('forms.register.purchase_date.errorRequired')
                ],
                'purchase_price' => [
                    'required' => lang('forms.register.purchase_price.errorRequired')
                ]


            ]
        );


        // $valid = $validation->run($requestData);
        // if (!$valid) {

        //     return $this->fail($validation->getErrors(), 400);
        // }

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

        if (isset($requestData['categories'])) {
            $requestData['categories'] = implode(", ", $requestData['categories']);
        }
        if (isset($requestData['preferred_work_locations'])) {
            $requestData['preferred_work_locations'] = implode(", ", $requestData['preferred_work_locations']);
        }

        if (isset($requestData['top_skills'])) {
            $requestData['top_skills'] = implode(", ", $requestData['top_skills']);
        }
        if (isset($requestData['middle_skills'])) {
            $requestData['middle_skills'] = implode(", ", $requestData['middle_skills']);
        }
        if (isset($requestData['foundation_skills'])) {
            $requestData['foundation_skills'] = implode(", ", $requestData['foundation_skills']);
        }

        if (isset($requestData['certifications'])) {
            $requestData['certifications'] = json_encode($requestData['certifications']);
        }

        if (isset($requestData['work_experience'])) {
            $requestData['work_experience'] = json_encode($requestData['work_experience']);
        }

        $requestData['updated_by'] = $user['id'];

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

        if (isset($_POST['filter'])) {
            $filter = $_POST['filter'];
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
                    'required' => "Please enter Email.",
                    'valid_email' => "Please enter valid Email.",
                    'is_unique' => "Email already exist.",
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

        $update = $model->save($requestData);
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
            $isEmailSent =  sendEmail_common($requestData['email_primary'], $message, 'Bitstringit - Joining Form');

            //Respond with 200 status code
            return $this->respond(['success' => 'Sent Joining form.']);
        }

        return $this->fail(['error' => 'Failed to send Joining form.'], 400);
    }

    public function joiningFormSaveEmployeeDetails()
    {
        $requestData = (array) $this->request->getJSON();
        //$requestData = $this->request->getRawInput();
        $model = new EmployeeJoinigDetailsModel();
        $joiningFormId = $requestData['id'];

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

        //validation
        $validation =  \Config\Services::validation();

        $rules = [
            // 'email' => 'required',
            'first_name' => ['label' => 'First Name', 'rules' => 'required'],
            'last_name' => ['label' => 'Last Name', 'rules' => 'required'],
            'dob' => ['label' => 'Date of Birth', 'rules' => 'required'],
            'aadhar_number' => ['label' => 'Aadhar Number', 'rules' => 'required|numeric|exact_length[12]'],
            'pan_number' => ['label' => 'PAN Number', 'rules' => 'required|alpha_numeric|exact_length[10]|valid_pan'],
            'email_primary' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[employee_joining_form_details.email_primary,id,' . $joiningFormId . ']'],
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
                'success' => 'Done'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveEducationDetails()
    {
        $requestData = (array) $this->request->getJSON();
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'education_qualification' => ''
        ];
        $joiningFormId = $requestData['id'];
        $requestData = array_intersect_key($requestData, $allowedColums);

        //validation
        $validation =  \Config\Services::validation();
        $rules = [];
        $validationData = [
            'degree' => [],
            'university' => [],
            'institution' => [],
            'from_date' => [],
            'to_date' => [],
            'percentage' => [],
        ];
        foreach ($requestData['education_qualification'] as $key => $item) {

            array_push($validationData['degree'], $item->degree);
            array_push($validationData['university'], $item->university);
            array_push($validationData['institution'], $item->institution);
            array_push($validationData['from_date'], $item->from_date);
            array_push($validationData['to_date'], $item->to_date);
            array_push($validationData['percentage'], $item->percentage);
        }

        $rules = [
            'degree.*' => ['label' => 'Degree/course', 'rules' => 'required'],
            'university.*' => ['label' => 'Course Title along with Board / University', 'rules' => 'required'],
            'institution.*' => ['label' => 'address of school/Institution', 'rules' => 'required'],
            'from_date.*' => ['label' => 'From', 'rules' => 'required'],
            'to_date.*' => ['label' => 'To', 'rules' => 'required'],
            'percentage.*' => ['label' => 'Percentage/CGPA', 'rules' => 'required'],
        ];
        $validation->setRules(
            $rules
        );

        $valid = $validation->run($validationData);
        if (!$valid) {
            //  return $this->fail($validation->getErrors(), 400);
            return $this->fail(['education_qualification' => "Please fill all the fields."], 400);
        }

        $model = new EmployeeJoinigDetailsModel();



        $requestData['education_qualification'] = $requestData['education_qualification'] ? json_encode($requestData['education_qualification']) : null;
        $id =  $model->update($joiningFormId, $requestData);

        $response = [
            'id'   => $joiningFormId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Done'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveProfetionalQualification()
    {
        $requestData = (array) $this->request->getJSON();
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'professional_qualification' => ''
        ];
        $joiningFormId = $requestData['id'];
        $requestData = array_intersect_key($requestData, $allowedColums);

        //validation
        $validation =  \Config\Services::validation();
        $rules = [];
        $validationData = [
            'qualification' => [],
            'category' => [],
            'date' => [],
        ];
        foreach ($requestData['professional_qualification'] as $key => $item) {

            array_push($validationData['qualification'], $item->qualification);
            array_push($validationData['category'], $item->category);
            array_push($validationData['date'], $item->date);
        }

        $rules = [
            'qualification.*' => ['label' => 'Qualification/Body/Institute / Licence', 'rules' => 'required'],
            'category.*' => ['label' => 'Category/Membership level', 'rules' => 'required'],
            'date.*' => ['label' => 'Dates', 'rules' => 'required'],
        ];
        $validation->setRules(
            $rules
        );

        $valid = $validation->run($validationData);
        if (!$valid) {
            //  return $this->fail($validation->getErrors(), 400);
            return $this->fail(['professional_qualification' => "Please fill all the fields."], 400);
        }


        $model = new EmployeeJoinigDetailsModel();
        $requestData['professional_qualification'] = $requestData['professional_qualification'] ? json_encode($requestData['professional_qualification']) : null;
        $id =  $model->update($joiningFormId, $requestData);

        $response = [
            'id'   => $joiningFormId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Done'
            ]
        ];
        return $this->respondUpdated($response);
    }
    public function joiningFormSaveEmploymentHistory()
    {
        $requestData = (array) $this->request->getJSON();
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
        $validationData = [
            'gap_declaration' => [
                'particular' => [],
                'from_date' => [],
                'to_date' => [],
            ]
        ];
        // print_r($requestData['employment_history']);
        if(!empty($requestData['employment_history']->gap_declaration)){
            
            foreach ($requestData['employment_history']->gap_declaration as $key => $item) {


                array_push($validationData['gap_declaration']['particular'], $item->particular);
                array_push($validationData['gap_declaration']['from_date'], $item->from_date);
                array_push($validationData['gap_declaration']['to_date'], $item->to_date);
            }
    
            $rules = [
                'gap_declaration.particular.*' => ['label' => 'Particulars ', 'rules' => 'required'],
                'gap_declaration.from_date.*' => ['label' => 'From', 'rules' => 'required'],
                'gap_declaration.to_date.*' => ['label' => 'To', 'rules' => 'required'],
            ];
           
        }

      

        if($rules){
            $validation->setRules(
                $rules
            );
            $valid = $validation->run($validationData);
        }

        if (!$valid) {
            //  return $this->fail($validation->getErrors(), 400);
            return $this->fail(['gap_declaration' => "Please fill all the fields."], 400);
        }

        $model = new EmployeeJoinigDetailsModel();
        $requestData['employment_history'] = $requestData['employment_history'] ? json_encode($requestData['employment_history']) : null;
        $id =  $model->update($joiningFormId, $requestData);

        $response = [
            'id'   => $joiningFormId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Done'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningFormSaveBackgroundInfo()
    {
        $requestData = (array) $this->request->getJSON();
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'background_info' => ''
        ];
        $joiningFormId = $requestData['id'];
        $requestData = array_intersect_key($requestData, $allowedColums);

        //validation
        $validation =  \Config\Services::validation();
        $rules = [];
        $validationData = [
            'previous_address' => [
                'address' => array(),
                'postcode' => array(),
                'dates' => array(),
            ],
            'mediclaim' => [
                'name' => array(),
                'relationship' => array(),
                'dob' => array(),
                'age' => array(),
            ]
        ];
    


        if (!empty($requestData['background_info']->previous_address)) {
            foreach ($requestData['background_info']->previous_address as $key => $item) {


                array_push($validationData['previous_address']['address'], $item->address);
                array_push($validationData['previous_address']['postcode'], $item->postcode);
                array_push($validationData['previous_address']['dates'], $item->dates);
            }

            // array_push($rules, [
            //     'previous_address.address.*' => ['label' => 'Address ', 'rules' => 'required'],
            //     'previous_address.postcode.*' => ['label' => 'Postcode', 'rules' => 'required'],
            //     'previous_address.dates.*' => ['label' => 'Dates', 'rules' => 'required'],
            // ]);
        }

        if (!empty($requestData['background_info']->mediclaim)) {

            foreach ($requestData['background_info']->mediclaim as $key => $item2) {
                array_push($validationData['mediclaim']['name'], $item2->name);
                array_push($validationData['mediclaim']['relationship'], $item2->relationship);
                array_push($validationData['mediclaim']['dob'], $item2->dob);
                array_push($validationData['mediclaim']['age'], $item2->age);
            }

            // array_push($rules, [
            //     'mediclaim.name.*' => ['label' => 'Name ', 'rules' => 'required'],
            //     'mediclaim.relationship.*' => ['label' => 'Relationship', 'rules' => 'required'],
            //     'mediclaim.dob.*' => ['label' => 'Date of Birth', 'rules' => 'required'],
            //     'mediclaim.age.*' => ['label' => 'Age', 'rules' => 'required'],
            // ]);
        }

        $rules = [
            'previous_address.address.*' => ['label' => 'Address ', 'rules' => 'required'],
            'previous_address.postcode.*' => ['label' => 'Postcode', 'rules' => 'required'],
            'previous_address.dates.*' => ['label' => 'Dates', 'rules' => 'required'],

            'mediclaim.name.*' => ['label' => 'Name ', 'rules' => 'required'],
            'mediclaim.relationship.*' => ['label' => 'Relationship', 'rules' => 'required'],
            'mediclaim.dob.*' => ['label' => 'Date of Birth', 'rules' => 'required'],
            'mediclaim.age.*' => ['label' => 'Age', 'rules' => 'required'],
        ];
       
        $validation->setRules(
            $rules
        );

        
        $valid = $validation->run($validationData);
        
        if (!$valid) {
            // return $this->fail($validation->getErrors(), 400);

            $errors = [
                'previous_address' => "",
                'mediclaim' => ""
            ];

            foreach ($validation->getErrors() as $key => $value) {
                if (preg_match('#^previous_address#i', $key)) {
                    $errors['previous_address'] = "Please fill all the fields.";
                }
                if (preg_match('#^mediclaim#i', $key)) {
                    $errors['mediclaim'] = "Please fill all the fields.";
                }
            }
            $errors = array_filter($errors);
            return $this->fail(
                $errors,
                400
            );
        }


        $model = new EmployeeJoinigDetailsModel();
        $requestData['background_info'] = $requestData['background_info'] ? json_encode($requestData['background_info']) : null;
        $model->update($joiningFormId, $requestData);

        $response = [
            'id'   => $joiningFormId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Done'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function joiningUploadDocument()
    {




        $document = $this->request->getFile('document');
        $requestData = $this->request->getPost();
        $id = $this->request->getPost('id'); // json_decode($_POST['requestData'], true);
        $documentName = $this->request->getPost('documentName'); // json_decode($_POST['requestData'], true);
        helper('form');
        $validation =  \Config\Services::validation();

        $rules = [
            'documentName' => ['label' => 'Document Name', 'rules' => 'required'],
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
        $documentDetails = $joiningFormDetails['documents'] ? (array)json_decode($joiningFormDetails['documents']) : [];

        if (isset($document)) {
            $pathToUpload = "form_" . $id;
            if (!file_exists(str_replace(APPPATH,'',DOCUMENTS_PATH).$pathToUpload)) {
                mkdir(str_replace(APPPATH,'',DOCUMENTS_PATH).$pathToUpload, 0777, true);
                fopen(str_replace(APPPATH,'',DOCUMENTS_PATH).$pathToUpload . "/index.html", 'w');
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
                'success' => 'Done',
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function removeDocument()
    {
        $requestData = (array) $this->request->getJSON();

        //get document details
        $model = new EmployeeJoinigDetailsModel();
        $joiningFormDetails = (array)$model->find($requestData['id']);
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
        $requestData = (array) $this->request->getJSON();
        //$requestData = $this->request->getRawInput();
        $allowedColums = [
            'is_accept_declaration' => ''
        ];
        $joiningFormId = $requestData['id'];
        $requestData = array_intersect_key($requestData, $allowedColums);

        $model = new EmployeeJoinigDetailsModel();
        $requestData['is_accept_declaration'] = 1;
        $id =  $model->update($joiningFormId, $requestData);

        $response = [
            'id'   => $joiningFormId,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Done'
            ]

        ];
        return $this->respondUpdated($response);
    }

    public function getJoingformDetails($id)
    {
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

        $joiningFormDetails['employee_other_details'] = $joiningFormDetails['employee_other_details'] ? (array)json_decode($joiningFormDetails['employee_other_details']) : $employee_other_details;
        $joiningFormDetails['education_qualification'] = $joiningFormDetails['education_qualification'] ? (array)json_decode($joiningFormDetails['education_qualification']) : [];
        $joiningFormDetails['professional_qualification'] = $joiningFormDetails['professional_qualification'] ? (array)json_decode($joiningFormDetails['professional_qualification']) : [];
        $joiningFormDetails['employment_history'] = $joiningFormDetails['employment_history'] ? (array)json_decode($joiningFormDetails['employment_history']) : $employment_history;
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

    // delete animal details
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
        $model = new ProfileModel();
        $data = $model->find($id);
        $userModel = new UserModel();

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

        if (!empty($data['top_skills'])) {
            $data['top_skills'] = explode(', ', $data['top_skills']);
        } else {
            $data['top_skills'] = [];
        }

        if (!empty($data['middle_skills'])) {
            $data['middle_skills'] = explode(', ', $data['middle_skills']);
        } else {
            $data['middle_skills'] = [];
        }

        if (!empty($data['foundation_skills'])) {
            $data['foundation_skills'] = explode(', ', $data['foundation_skills']);
        } else {
            $data['foundation_skills'] = [];
        }



        $createdByDetails = $userModel->find($data['created_by']);
        $updatedByDetails = $userModel->find($data['updated_by']);
        $data['created_by'] = $createdByDetails['fname'] . ' ' . $createdByDetails['lname'];
        $data['updated_by'] = $updatedByDetails['fname'] . ' ' . $updatedByDetails['lname'];

        $data['created_at'] = date(SITE_DATE_TIME_FORMAT, strtotime($data['created_at']));
        $data['updated_at'] = date(SITE_DATE_TIME_FORMAT, strtotime($data['updated_at']));

        return $data;
    }

    public function getSkillsAutocomplete()
    {


        $query = $this->request->getVar('query');
        $model = new SkillsModel();
        $result = $model->getAutocompleteList($query);
        return $this->respond($result);
    }
}


// personal email
// company email id
// employee id
// combine fname & Lname
// click on name link