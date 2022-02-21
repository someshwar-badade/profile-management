<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\InterviewModel;

class Interviews extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];
    // get all animal details
    // public function index(){
    //     return ;
    // }
    public function getInterviews($profile_id)
    {

        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new InterviewModel();

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

        if (isset($_POST['filter'])) {
            $filter = $_POST['filter'];
        }

        $filter['profile_id'] = $profile_id;
        $data = $model->getList($filter, $iSearch_str, $start, $length, $orderBy);

        return $this->respond($data);
        // return $this->respond($data);
    }

    public function getInterviewDetails($profile_id, $id)
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('interviews/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $model = new InterviewModel();
        $response = $model->where('id', $id)->where('profile_id', $profile_id)->first();

        return $this->respond($response);
    }

    public function saveInterview()
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('interviews/add')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON();


        $validation =  \Config\Services::validation();

        $rules = [
            'company_name' => 'required',
            'interview_taken_by' => 'required',
            'for_role' => 'required',
            'schedule_dt' => 'required',
            'status' => 'required',
        ];


        $validation->setRules(
            $rules,
            [
                'company_name' => [
                    'required' => "Please enter Company name."
                ],
                'interview_taken_by' => [
                    'required' => "Please enter Interviewer name."
                ],
                'for_role' => [
                    'required' => "Please enter for role."
                ],
                'schedule_dt' => [
                    'required' => "Please enter schedule date time."
                ],
                'status' => [
                    'required' => "Please select status."
                ],
            ]

        );
        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
        }

        $requestData['schedule_dt'] = date('Y-m-d H:i:s', strtotime($requestData['schedule_dt']));
        $model = new InterviewModel();
        if (empty($requestData['id'])) {
            
            if($model->insert($requestData)){

                $actionLogData = [
                           
                    'action_type' => 'created',
                    'model' => 'profile',
                    'record_id' => $requestData['profile_id'],
                    'chaged_data' => json_encode(["interview"=>$requestData])
                ];
                creatActionLog($actionLogData);
            }
            

        } else {

            $oldData = $model->find($requestData['id']);
            $changed_data = array_diff_assoc((array)$requestData, (array)$oldData);

            if($model->save($requestData)){
                $actionLogData = [
                           
                    'action_type' => 'updated',
                    'model' => 'profile',
                    'record_id' => $requestData['profile_id'],
                    'chaged_data' => json_encode(["interview"=>$changed_data])
                ];
                creatActionLog($actionLogData);
            }

        }

        $response = [
            'list' => $model->where('profile_id', $requestData['profile_id'])->find(),
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function delete($id = null)
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('interviews/delete')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $model = new InterviewModel();
        $interviewDetails = $model->find($id);
        if ($model->delete($id)) {

            $actionLogData = [
                           
                'action_type' => 'deleted',
                'model' => 'profile',
                'record_id' => $interviewDetails['profile_id'],
                'chaged_data' => json_encode(["interview"=>$interviewDetails])
            ];
            creatActionLog($actionLogData);


            $response = [
                'error'    => null,
                'messages' => [
                    'success' => 'Deleted successfully'
                ]
            ];
            return $this->respondUpdated($response);
        }
        return $this->fail(['errorMessage' => "Interview details not available."], 403);
    }
}


// personal email
// company email id
// employee id
// combine fname & Lname
// click on name link