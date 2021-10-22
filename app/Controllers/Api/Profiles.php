<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProfileModel;
use App\Models\UserModel;
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
		$searchKey = $this->request->getVar('search');//$_POST['search'];
		$columns = $this->request->getVar('columns');// $_POST['columns'];
		$order = $this->request->getVar('order');//$_POST['order'];
		$orderBy = $columns[$order[0]['column']]['data'].' '.$order[0]['dir'];

		$iSearch_str = '';
		if (!empty($searchKey['value'])) {
			foreach ($columns as $row) {
				if (!empty($row['data'] && $row['searchable']=='true')) {
					$iSearch[] = " " . $row['data'] . "  LIKE '%" . $searchKey['value'] . "%' ";
				}
			}

            $iSearch[] = " `candidate_name`  LIKE '%" . $searchKey['value'] . "%' OR  SOUNDEX(`candidate_name`) = SOUNDEX('".$searchKey['value']."') ";
            $iSearch[] = " `middle_skills` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `foundation_skills` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `certifications` LIKE '%" . $searchKey['value'] . "%' ";
            $iSearch[] = " `categories` LIKE '%" . $searchKey['value'] . "%' ";

			$iSearch_str = implode(' OR ', $iSearch);
		}

		$filter = array();

		if(isset($_POST['filter'])){
			$filter = $_POST['filter'];
		}

        $data = $model->getList($filter,$iSearch_str,$start,$length,$orderBy);
       
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
       
        $requestData['created_by'] = $user['id'];
        $requestData['updated_by'] = $user['id'];

        $insert_id = $model->insert($requestData);
        // echo  $model->getLastQuery()->getQuery();
        if (isset($requestData['certifications'])) {
            $requestData['certifications'] = json_decode($requestData['certifications'], true);
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

			if(empty($profileDetails)){
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
				return $this->respond(['success' => 'Profile updated', 'id' => $id,'profile'=>$profileDetails]);
			}

            return $this->fail(['error' => 'Record not updated'], 400);
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


    private function gerProfileDetails($id){
        $model = new ProfileModel();
        $data = $model->find($id);
        $userModel = new UserModel();

        if(!empty($data['certifications'])){
            $data['certifications'] = json_decode($data['certifications']);
        }else{
            $data['certifications'] = [];
        }


        $data['resume_pdf'] = trim($data['resume_pdf']);
        $data['resume_doc'] = trim($data['resume_doc']);
        if(!empty($data['resume_pdf'])){
            $data['resume_pdf_url'] = base_url('/assets/profiles/'.$data['resume_pdf']);
        }else{
            $data['resume_pdf_url']=null;
        }

        if(!empty($data['resume_doc'])){
            $data['resume_doc_url'] = base_url('/assets/profiles/'.$data['resume_doc']);
        }else{
            $data['resume_doc_url']=null;
        }

        if(!empty($data['preferred_work_locations'])){
            $data['preferred_work_locations'] = explode(', ',$data['preferred_work_locations']);
        }else{
            $data['preferred_work_locations']=[];
        }
        if(!empty($data['categories'])){
            $data['categories'] = explode(', ',$data['categories']);
        }else{
            $data['categories']=[];
        }

        if(!empty($data['top_skills'])){
            $data['top_skills'] = explode(', ',$data['top_skills']);
        }else{
            $data['top_skills']=[];
        }

        if(!empty($data['middle_skills'])){
            $data['middle_skills'] = explode(', ',$data['middle_skills']);
        }else{
            $data['middle_skills']=[];
        }

        if(!empty($data['foundation_skills'])){
            $data['foundation_skills'] = explode(', ',$data['foundation_skills']);
        }else{
            $data['foundation_skills']=[];
        }
        
        $createdByDetails = $userModel->find($data['created_by']);
        $updatedByDetails = $userModel->find($data['updated_by']);
        $data['created_by'] = $createdByDetails['fname'].' '.$createdByDetails['lname'];
        $data['updated_by'] = $updatedByDetails['fname'].' '.$updatedByDetails['lname'];

        $data['created_at'] = date(SITE_DATE_TIME_FORMAT,strtotime($data['created_at']));
        $data['updated_at'] = date(SITE_DATE_TIME_FORMAT,strtotime($data['updated_at']));
        
        return $data;

    }

    public function getSkillsAutocomplete(){

        
        $query = $this->request->getVar('query');
        $model = new SkillsModel();
        $result = $model->getAutocompleteList($query);
        return $this->respond($result);
    }

}
