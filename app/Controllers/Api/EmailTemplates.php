<?php
namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PolicyDocumentsModel;
use App\Models\EmailTemplatesModel;

class EmailTemplates extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];

    public function index(){

        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('email_templates/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $model = new EmailTemplatesModel();

        $filter=null;
        if(isset($_REQUEST['filter'])){
            $filter=$_REQUEST['filter'];
        }
		$data['data'] = $model->getList($filter);
		$data['activeCount'] = $model->getCount('Enable');
		$data['inactiveCount'] = $model->getCount('Disable');
		$data['allCount'] = $model->getCount();

        return $this->respond($data);
    }


    public function getDetails($id){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('email_templates/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $EmailTemplatesModel = new EmailTemplatesModel();

        $data = $EmailTemplatesModel->find($id);
      
        return $this->respond(['data'=>$data]);
    }


    public function updateDetails(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }
        
        if (!hasCapability('email_templates/update')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        // $document = $this->request->getFile('document');
        $requestData =  (array) $this->request->getJSON();
      
        // $requestData =  json_decode($this->request->getRawInput('requestData'),true);
        $allowedColums = ['id'=>'',
                            'short_name'=>'',
                            'display_name'=>'',
                            'email_to'=>'',
                            'email_cc'=>'',
                            'email_bcc'=>'',
                            'subject'=>'',
                            'body'=>'',
                            'status'=>''];

        $requestData = array_intersect_key($requestData, $allowedColums);
       
        //validation
        $validation =  \Config\Services::validation();


        $rules = [
            'email_to' => [
                'label' => 'To ',
                'rules' => 'required',
                'errors' => [
                    'required' => 'This field is required.'
                ]
            ],
            'subject' => [
                'label' => 'Subject',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The subject is required.'
                ]
            ],
            'body' => [
                'label' => 'Email body',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The email body is required.'
                ]
            ],
        ];

     

        $validation->setRules(
            $rules
        );

        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
            // return $this->fail(['education_qualification' => "Please fill all the fields."], 400);
        }


        $model = new EmailTemplatesModel();

        $data = null;
        if (empty($requestData['id'])) {
           $newId =  $model->insert($requestData);

           if($newId){
            $actionLogData = [
                   
                'action_type' => 'created',
                'model' => 'emailTemplates',
                'record_id' => $newId,
                'chaged_data' => json_encode($requestData)
            ];
            creatActionLog($actionLogData);
           }
           $data = $model->find($newId);


        } else {
            
            $oldData = $model->find($requestData['id']);
            $changed_data = array_diff_assoc((array)$requestData, (array)$oldData);
            if($model->save($requestData)){
                $actionLogData = [
                   
                    'action_type' => 'updated',
                    'model' => 'emailTemplates',
                    'record_id' => $requestData['id'],
                    'chaged_data' => json_encode($changed_data)
                ];
                creatActionLog($actionLogData);
            }

            $data = $model->find($requestData['id']);

        }


        $response = [
            'data' => $data,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ]
        ];
        return $this->respondUpdated($response);

    }


}