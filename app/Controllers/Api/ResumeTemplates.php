<?php
namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ResumeTemplatesModel;

class ResumeTemplates extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];

    public function index(){

        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        // if (!hasCapability('clients/view')) {
        //     return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        // }

        $ResumeTemplatesModel = new ResumeTemplatesModel();

        $filter=null;
        if(isset($_REQUEST['filter'])){
            $filter=$_REQUEST['filter'];
        }
		$data['data']['predefined'] = $ResumeTemplatesModel->getList(["user_id"=>'0']);
		$data['data']['custom'] = $ResumeTemplatesModel->getList(["user_id"=>$user['id']]);

        return $this->respond($data);
    }


    public function saveDetails(){
        $user = checkUserToken();

       
        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        // if (!hasCapability('clients/view')) {
        //     return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        // }

        $requestData = (array) $this->request->getJSON();

        $validation =  \Config\Services::validation();
      
        $rules = [
            'name' => [
                'label' => 'Template Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The template name is required.'
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


        $ResumeTemplatesModel = new ResumeTemplatesModel();

        //find existing template
        $templateDetails = $ResumeTemplatesModel->where("name",$requestData['name'])->where('user_id',$user['id'])->first();
       
        
        $responseData = '';
        if(empty($templateDetails)){
            //create new
            $templateDetails['user_id'] = $user['id'];
            $templateDetails['name'] = $requestData['name'];
            $templateDetails['type'] = 'custom';
            $templateDetails['template_config'] = json_encode($requestData['template_config']);

           
           if($ResumeTemplatesModel->insert($templateDetails)){
            $responseData = [
                'error'    => null,
                'messages' => [
                    'success' => 'Created successfully'
                ],
                ];
           }
           
        
        
        }else{
            // update
            $templateDetails['template_config'] = json_encode($requestData['template_config']);
           
            if($ResumeTemplatesModel->save($templateDetails)){
                $responseData = [
                    'error'    => null,
                    'messages' => [
                        'success' => 'Updated successfully'
                    ],
                    ];
               }
        }

        return $this->respond($responseData);

        
    }

   



}