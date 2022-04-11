<?php
namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PolicyDocumentsModel;
use App\Models\UserPolicyDpcumentModel;

class PolicyDocuments extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];

    public function index(){

        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('policy-documents/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $model = new PolicyDocumentsModel();

        $filter=null;
        if(isset($_REQUEST['filter'])){
            $filter=$_REQUEST['filter'];
        }
		$data['data'] = $model->getList($filter);
		$data['activeCount'] = $model->getCount('Active');
		$data['inactiveCount'] = $model->getCount('Inactive');
		$data['allCount'] = $model->getCount();

        return $this->respond($data);
    }


    public function getDetails($id){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('policy-documents/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $PolicyDocumentsModel = new PolicyDocumentsModel();

        $data = $PolicyDocumentsModel->find($id);
        if(!empty($data)){
            //isDocumentExist
            $data['isDocumentExist'] = file_exists($data['file']);
        }
        return $this->respond(['data'=>$data]);
    }


    public function getPolicyDocumentsUser(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $PolicyDocumentsModel = new PolicyDocumentsModel();
        $data = $PolicyDocumentsModel->getPolicyDocUser($user['id']);
        if(!empty($data)){
            //isDocumentExist
            $data['isDocumentExist'] = file_exists($data['file']);
        }
        return $this->respond(['data'=>$data]);
    }

    public function savePolicyDocument(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('policy-documents/add')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $document = $this->request->getFile('document');
        $requestData =  json_decode($_POST['requestData'], true);

        $allowedColums = [
            'id' => '',
            'document_name' => '',
            'type' => '',
            'file' => '',
            'file_name_original' => '',
            'text' => '',
            'status' => '',
        ];

        $requestData = array_intersect_key($requestData, $allowedColums);
       
        //validation
        $validation =  \Config\Services::validation();


        $rules = [
            'document_name' => [
                'label' => 'Document Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The document name is required.'
                ]
            ],
            'type' => [
                'label' => 'Type',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The document type is required.'
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
            $rules['document'] = ['label' => 'document', 
            'rules' => 'uploaded[document]|max_size[document,3000]',
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
            $pathToUpload = "assets/policy-documents";

            $newName = $document->getRandomName();
            $document->move($pathToUpload, $newName);
            //remove old document

            if (isset($requestData['file'])) {
                if (file_exists($requestData['file']) && !empty($requestData['file'])) {

                    unlink($requestData['file']);
                }
            }

            $requestData['file'] = $pathToUpload . '/' . $newName;
            $requestData['file_name_original'] = $document->getClientName();
        }

        $model = new PolicyDocumentsModel();

        $data = null;
        if (empty($requestData['id'])) {
           $newId =  $model->insert($requestData);

           if($newId){
            $actionLogData = [
                   
                'action_type' => 'created',
                'model' => 'policyDocuments',
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
                    'model' => 'policyDocuments',
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

    public function deletePolicyDocument($documentId){
        $PolicyDocumentsModel = new PolicyDocumentsModel();
        $PolicyDocumentDetails = $PolicyDocumentsModel->find($documentId);
        $result ='';
        if(!empty($PolicyDocumentDetails)){
           $result =  $PolicyDocumentsModel->delete($documentId);
        //     if (isset($requestData['file'])) {
        //         if (file_exists($requestData['file']) && !empty($requestData['file'])) {

        //             unlink($requestData['file']);
        //         }
        //     }
        }

        if($result){
            $response = [
                'error'    => null,
                'messages' => [
                    'success' => 'Deleted successfully'
                ]
            ];
            return $this->respondUpdated($response);
        }

        return $this->fail(["message"=>"Document not available."], 400);

    }

    public function viewPolicyDocumentFile($documentId,$documentName=''){

      
		$user = checkUserToken();

		$isUserLoggedin = false;
	
		if(!empty($user)){
			$isUserLoggedin = true;
		}
        if (!$user && !$isUserLoggedin) {
            //redirct to login
            setcookie("a_token", "", time() - 3600, '/'); //delete cookie
            setcookie("r_token", "", time() - 3600, '/'); //delete cookie
            return redirect()->route('logout');
            exit();
        }
		
    	    $PolicyDocumentsModel = new PolicyDocumentsModel();
            $documentDetails = $PolicyDocumentsModel->find($documentId);
            $file = isset($documentDetails['file'])?$documentDetails['file']:'';
			if (file_exists($file) && !empty($file) && $documentDetails['type']=='File') // check the file is existing 
			{


                //update the document view time by user
                $UserPolicyDpcumentModel = new UserPolicyDpcumentModel();
                $UserPolicyDpcumentModel->updateViewTime($user['id'], $documentId);

				// header('Content-Description: File Transfer');
				// header('Content-Type: application/octet-stream');
				header('Content-Type: '.mime_content_type($file));
				// header('Content-Disposition: attachment; filename=' . basename($file));
				header('Content-Disposition: inline; filename=' . basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
				exit;
				// readfile($file);

			}else if($documentDetails['type']=='Text'){
                //update the document view time by user
                $UserPolicyDpcumentModel = new UserPolicyDpcumentModel();
                $UserPolicyDpcumentModel->updateViewTime($user['id'], $documentId);
                return $this->respond(['data'=>$documentDetails]);

            } else {
				return redirect()->route('pageNotFound');
				
			}
		
	
    }


}