<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\JobPositionModel;
use App\Models\ProfileShortlistModel;
use App\Models\ProfileModel;

class JobPositions extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];
    // get all animal details
    // public function index(){
    //     return ;
    // }
    public function index()
    {
        
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new JobPositionModel();

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

            // $iSearch[] = " `candidate_name`  LIKE '%" . $searchKey['value'] . "%' OR  SOUNDEX(`candidate_name`) = SOUNDEX('" . $searchKey['value'] . "') ";
            // $iSearch[] = " `secondary_skills` LIKE '%" . $searchKey['value'] . "%' ";
            // $iSearch[] = " `foundation_skills` LIKE '%" . $searchKey['value'] . "%' ";
            // $iSearch[] = " `certifications` LIKE '%" . $searchKey['value'] . "%' ";
            // $iSearch[] = " `categories` LIKE '%" . $searchKey['value'] . "%' ";

            $iSearch_str = implode(' OR ', $iSearch);
        }

        $filter = array();

        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
        }

        
        $data = $model->getList($filter, $iSearch_str, $start, $length, $orderBy);

        return $this->respond($data);
    }

    public function getJobPositionDetails($id){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('job_position/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $model = new JobPositionModel();
        $response = $model->find($id);

        $response['primary_skills'] = !empty($response['primary_skills'])?explode(" || ",$response['primary_skills']):null;
        $response['secondary_skills'] = !empty($response['secondary_skills'])?explode(" || ",$response['secondary_skills']):null;
        $response['locations'] = !empty($response['locations'])?explode(" || ",$response['locations']):null;

        $response['min_exp_y'] = floor($response['min_experience']/12);
        $response['min_exp_m'] = (int)$response['min_experience']%12;
        $response['max_exp_y'] = floor($response['max_experience']/12);
        $response['max_exp_m'] = (int)$response['max_experience']%12;

        $response['position_received_date'] =!empty($response['position_received_date'])? date('d-M-Y',strtotime($response['position_received_date'])):'';
        $response['valid_to_date'] = !empty($response['valid_to_date'])?date('d-M-Y',strtotime($response['valid_to_date'])):'';


        return $this->respond($response);
    }

    public function saveJobPosition(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('job_positions/add')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON();


        $validation =  \Config\Services::validation();

        $rules = [
            'job_code' => 'required',
            'client_name' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'primary_skills' => 'required',
        ];


        $validation->setRules(
            $rules,
            [
                'job_code' => [
                    'required' => "Please enter job code."
                ],
                'client_name' => [
                    'required' => "Please select client name."
                ],
                'title' => [
                    'required' => "Please enter title."
                ],
                'desc' => [
                    'required' => "Please enter description."
                ],
                'primary_skills' => [
                    'required' => "Please enter primary skills"
                ],
            ]

        );
        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
        }

        $requestData['position_received_date'] = date('Y-m-d',strtotime($requestData['position_received_date']));
        $requestData['valid_to_date'] = date('Y-m-d',strtotime($requestData['valid_to_date']));

        $requestData['primary_skills'] = !empty($requestData['primary_skills'])?implode(" || ",$requestData['primary_skills']):null;
        $requestData['secondary_skills'] = !empty($requestData['secondary_skills'])?implode(" || ",$requestData['secondary_skills']):null;
        $requestData['locations'] = !empty($requestData['locations'])?implode(" || ",$requestData['locations']):null;
        $requestData['min_experience'] = ($requestData['min_exp_y']*12) + $requestData['min_exp_m'];
        $requestData['max_experience'] = ($requestData['max_exp_y']*12) + $requestData['max_exp_m'];

        $model = new JobPositionModel();
        if (empty($requestData['id'])) {
            $requestData['created_by'] = $user['id'];
            $requestData['updated_by'] = $user['id'];
            $model->insert($requestData);

            $response = [
                'list' => $model->findAll(),
                'action_type' => 'created',
                'error'    => null,
                'messages' => [
                    'success' => 'Created successfully'
                ]
            ];
        } else {
            $requestData['updated_by'] = $user['id'];
            $model->save($requestData);
            $response = [
                'list' => $model->findAll(),
                'action_type' => 'Updated',
                'error'    => null,
                'messages' => [
                    'success' => 'Updated successfully'
                ]
            ];
        }

       
        return $this->respond($response);

    }

    public function saveShortlistCandidates(){
        $user = checkUserToken();
        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('job_positions/shortlist')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON(true);
        
        $ProfileShortlistModel = new ProfileShortlistModel();
        $jobPositionId = $requestData['job_position_id'];
        $count=0;
       foreach($requestData['toBeShortlistProfiles'] as $profileId){
        //    echo $profileId;
            if(!$ProfileShortlistModel->where('job_position_id',$jobPositionId)->where('profile_id',$profileId)->first()){
                $ProfileShortlistModel->save(['job_position_id'=>$jobPositionId,'profile_id'=>$profileId]);
                $count++;
            }
       }

       $response=[
        'error'    => null,
        'messages' => [
            'success' => $count>1?" $count profiles are shortlisted":" $count profile is shortlisted"
        ]
       ];
       return $this->respond($response);

    }


}