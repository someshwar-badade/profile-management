<?php
namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ClientsModel;
use App\Models\ClientContactsModel;

class Clients extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];

    public function index(){

        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('clients/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $ClientsModel = new ClientsModel();

        $filter=null;
        if(isset($_REQUEST['filter'])){
            $filter=$_REQUEST['filter'];
        }
		$data['data'] = $ClientsModel->getList($filter);
		$data['activeCount'] = $ClientsModel->getCount('1');
		$data['inactiveCount'] = $ClientsModel->getCount(0);
		$data['allCount'] = $ClientsModel->getCount();

        return $this->respond($data);
    }


    public function getDetails($id){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('clients/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $ClientsModel = new ClientsModel();
        $data['data'] = $ClientsModel->find($id);
        return $this->respond($data);
    }

    public function saveClient(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('clients/add')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $document = $this->request->getFile('logo');
        $requestData =  json_decode($_POST['requestData'], true);

        $allowedColums = [
            'id' => '',
            'client_name' => '',
            'logo' => '',
            'status' => '',
        ];

        $requestData = array_intersect_key($requestData, $allowedColums);
       
        //validation
        $validation =  \Config\Services::validation();


        $rules = [
            'client_name' => [
                'label' => 'Client Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The client name is required.'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The status is required.'
                ]
            ],
        ];

        if ($document) {
            $rules['logo'] = ['label' => 'Logo', 
            'rules' => 'uploaded[logo]|max_size[logo,1000]|mime_in[logo,image/png,image/jpg,image/jpeg,image/bmp]',
            'errors' => [
                'mime_in' => 'Please upload a valid image file.'
            ]
        ];
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
            $pathToUpload = "assets/clients";

            $newName = $document->getRandomName();
            $document->move($pathToUpload, $newName);
            //remove old document

            if (isset($requestData['logo'])) {
                if (file_exists($requestData['logo']) && !empty($requestData['logo'])) {

                    unlink($requestData['logo']);
                }
            }

            $requestData['logo'] = $pathToUpload . '/' . $newName;
        }

        $model = new ClientsModel();

        $data = null;
        if (empty($requestData['id'])) {
           $newId =  $model->insert($requestData);
           $data = $model->find($newId);
        } else {
            $model->save($requestData);
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

    public function getClientContact($id){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('clients/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $ClientContactsModel = new ClientContactsModel();
        $data['data'] = $ClientContactsModel->where('client_id',$id)->findAll();
        return $this->respond($data);
    }

    public function saveClientContact(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('clients/edit')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON();


        $validation =  \Config\Services::validation();
      

        $rules = [
            'person_name' => [
                'label' => 'Person Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The person name is required.'
                ]
            ],
            'mobile' => [
                'label' => 'Mobile',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The mobile is required.'
                ]
            ],
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'The e-mail is required.',
                    'valid_email' => 'The e-mail is invalid.'
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

        $model = new ClientContactsModel();

        if (empty($requestData['id'])) {
            $newId =  $model->insert($requestData);
         } else {
             $model->save($requestData);
         }

         $data = [
            'error'    => null,
            'messages' => [
                'success' => 'Updated successfully'
            ],
            'list'=>$model->where('client_id',$requestData['client_id'])->findAll(),
            ];
        
         return $this->respond($data);
    }

    public function deleteClientContact(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('clients/delete')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $requestData = (array) $this->request->getJSON();

        $ClientContactsModel = new ClientContactsModel();
       // $ClientContactsModel->delete($requestData['id']);

        if($ClientContactsModel->delete($requestData['id'])){
            $data = [
                'error'    => null,
                'messages' => [
                    'success' => 'Deleted successfully'
                ],
                'list'=>$ClientContactsModel->where('client_id',$requestData['client_id'])->findAll(),
                ];
            
             return $this->respond($data);
        }

        return $this->fail(['errorMessage' => "Details not available"], 400);
       
    }

}