<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserLeavesModel;
use App\Models\UserLeavesDatesModel;
use stdClass;

class Leaves extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];

    public function index()
    {

        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('leaves/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $model = new UserLeavesModel();

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

            $iSearch_str = implode(' OR ', $iSearch);
        }

        $filter = array();

        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
        }

        
        $filter['view_only_my_leaves'] = $user['id'];

        // $data = ['message'=>"hello"];
        $data = $model->getList($filter, $iSearch_str, $start, $length, $orderBy);

        return $this->respond($data);
        // return $this->respond($data);
    }


    public function leavesForApproval()
    {

        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('leaves/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        if (!hasCapability('leaves/approval')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $model = new UserLeavesModel();

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

            $iSearch_str = implode(' OR ', $iSearch);
        }

        $filter = array();

        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
        }

        // $data = ['message'=>"hello"];
        $data = $model->getList($filter, $iSearch_str, $start, $length, $orderBy);

        return $this->respond($data);
        // return $this->respond($data);
    }

    public function getLeaveDetails($id)
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('leaves/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $model = new UserLeavesModel();
        $UserLeavesDatesModel = new UserLeavesDatesModel();
        $response = $model->getDetails($id);
        $response['dates'] = $UserLeavesDatesModel->where('user_leave_id', $response['user_leave_id'])->findAll();
        foreach ($response['dates'] as $key => $row) {
            $response['dates'][$key]['date'] = date('d-M-Y', strtotime($row['date']));
        }

        return $this->respond($response);
    }

    public function updateLeave()
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('leaves/add') && empty($requestData['id'])) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        if (!hasCapability('leaves/edit') && !empty($requestData['id'])) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON(true);


        $validation =  \Config\Services::validation();

        $rules = [
            'reason' => [
                'label' => 'Reason',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please enter a reason.'
                ],
            
            ],
            'leave_type_id' => [
                'label' => 'Leave Type',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please select a leave type.'
                ],
            
            ],
            
        ];

        $errorMessages=[];
        $dateRules = [];
        // foreach ($requestData['dates'] as $key => $val) {
            
        //         $dateRules["dates.$key.date"] = [

        //             'label' => 'Date',
        //             'rules' => 'required',
                    
        //         ];
        //         $errorMessages["dates.$key.date"] = "Please select a date.";

        // }

        $rules  = array_merge($rules,$dateRules);
        $validation->setRules(
            $rules,$errorMessages
        );
        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
        }



        //check duplicate dates
        $tempDates = [];
        foreach ($requestData['dates'] as $key => $val) {
            $val = (array)$val;
            $date_val = date('Y-m-d',strtotime($val['date']));
            if(in_array($date_val,$tempDates)){
                return $this->fail(['errorMessage'=>"Don't select duplicate dates."], 400);
            }else{
                $tempDates[] = $date_val;
            }
        }

        $model = new UserLeavesModel();

        //check duplicate dates in data base with having status Pending,Approved
        

        if($model->checkDuplicateDates($user['id'],isset($requestData['id'])?$requestData['id']:'',$tempDates)){

            return $this->fail(['errorMessage'=>"From selected dates, some dates already exist."], 400);
        }

       
        if (empty($requestData['id'])) {
            $requestData['user_id'] = $user['id'];
            $insertId = $model->insert($requestData);

            //insert dates
            $UserLeavesDatesModel = new UserLeavesDatesModel();
            foreach ($requestData['dates'] as $key => $val) {
                $val = (array)$val;
                $UserLeavesDatesModel->insert([
                    'user_leave_id'=>$insertId,
                    'date'=>date('Y-m-d',strtotime($val['date'])),
                    'full_or_half'=>$val['full_or_half'],
                ]);
            }

            if ($insertId) {
                $actionLogData = [

                    'action_type' => 'created',
                    'model' => 'leaves',
                    'record_id' => $insertId,
                    'chaged_data' => json_encode($requestData)
                ];
                creatActionLog($actionLogData);
            }

            $response = [
                'list' => $model->findAll(),
                'action_type' => 'created',
                'error'    => null,
                'messages' => [
                    'success' => 'Created successfully'
                ]
            ];
        } else {

            $oldData = $model->find($requestData['id']);
            if($oldData['status'] != 'Pending' && $requestData['status']!='Request for cancellation'){
                return $this->fail(['errorMessage'=>"You can't modify details."], 400);
            }
            
            $changed_data = array_diff_assoc((array)$requestData, (array)$oldData);

            //insert dates
            $UserLeavesDatesModel = new UserLeavesDatesModel();
            $UserLeavesDatesModel->where('user_leave_id',$requestData['id'])->delete();//delete old records

            foreach ($requestData['dates'] as $key => $val) {
                $val = (array)$val;
                $UserLeavesDatesModel->insert([
                    'user_leave_id'=>$requestData['id'],
                    'date'=>date('Y-m-d',strtotime($val['date'])),
                    'full_or_half'=>$val['full_or_half'],
                ]);
            }

            if ($model->save($requestData)) {
                $actionLogData = [

                    'action_type' => 'updated',
                    'model' => 'leaves',
                    'record_id' => $requestData['id'],
                    'chaged_data' => json_encode($changed_data)
                ];
                creatActionLog($actionLogData);
            }

            $response = [
                'list' => null,
                'action_type' => 'Updated',
                'error'    => null,
                'messages' => [
                    'success' => 'Updated successfully'
                ]
            ];
        }


        return $this->respond($response);
    }


    public function updateLeaveStatus()
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('leaves/approval')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }


        $requestData = (array) $this->request->getJSON();

        $model = new UserLeavesModel();
        $oldData = $model->find($requestData['id']);

        if($oldData['status'] == 'Approved' || $oldData['status'] == 'Rejected' || $oldData['status'] == 'Cancelled'){
            return $this->fail(['errorMessage'=>"You can't modify details."], 400);
        }

        if($oldData['user_id'] == $user['id']){
            return $this->fail(['errorMessage'=>"You can't approve / reject self leaves."], 400);
        }

        $changed_data = array_diff_assoc((array)$requestData, (array)$oldData);

        $requestData['action_by_user'] = $user['fname'] . ' ' . $user['lname'];

        if ($model->save($requestData)) {
            $actionLogData = [

                'action_type' => 'updated',
                'model' => 'leaves',
                'record_id' => $requestData['id'],
                'chaged_data' => json_encode($changed_data)
            ];
            creatActionLog($actionLogData);
        }

        $response = [
            'list' => null,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];

        return $this->respond($response);
    }

    public function getChartData(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new UserLeavesModel();
        // $data = ['message'=>"hello"];
        $year = date('Y');
        $data = $model->getChartData($user['id'],$year);
        $chartData = new stdClass();
        $chartData->labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'];
        $leaveData = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($data as $key=>$value){
            $leaveData[$value['month']-1] = $value['leave_count']*1;
        }

        $chartData->datasets = [
               (object) [
                "label"               => 'Leaves - '.$year,
                "backgroundColor"     => 'rgba(60,141,188,0.9)',
                "borderColor"         => 'rgba(60,141,188,0.8)',
                "pointRadius"          => false,
                "pointColor"          => '#3b8bba',
                "pointStrokeColor"    => 'rgba(60,141,188,1)',
                "pointHighlightFill"  => '#fff',
                "pointHighlightStroke"=> 'rgba(60,141,188,1)',
                "data"                => $leaveData
            ]
            ];

        return $this->respond($chartData);
    }

    public function getReport(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('leaves/report')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON(true);

        $start = !empty($requestData['start'])?$requestData['start']:0;
        $length = !empty($requestData['length'])?$requestData['length']:0;
        $filter = !empty($requestData['filter'])?$requestData['filter']:0;;

        $model = new UserLeavesModel();

        $data = $model->getReportData($start,$length,$filter);

        return $this->respond(['data'=>$data,'start'=>$start + $length,'length'=>$length]);
    }
}
