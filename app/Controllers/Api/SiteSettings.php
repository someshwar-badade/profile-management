<?php
namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\SiteSettingsModel;

class SiteSettings extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];

    public function index(){

        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('site_settings/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

       

        $model = new SiteSettingsModel();
       // $encrypter = \Config\Services::encrypter();

        
		$data['data'] = [];
        foreach($model->findAll() as $row){
            // if($row['setting_name']=='smtp_pass'){
            //     $data['data'][$row['setting_name']] = $encrypter->decrypt(hex2bin($row['value']));
            //     // $data['data'][$row['setting_name']] = $row['value'];
            // }else{

            // }
            $data['data'][$row['setting_name']] = $row['value'];
        }

        return $this->respond($data);
    }


    public function getDetails($id){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('site_settings/view')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }
        $SiteSettingsModel = new SiteSettingsModel();

        $data = $SiteSettingsModel->find($id);

        
        return $this->respond(['data'=>$data]);
    }


    public function updateDetails(){
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        if (!hasCapability('site_settings/update')) {
            return $this->fail(['errorMessage' => "You don't have capability to access this page. Please contact to admin."], 403);
        }

        $document = $this->request->getFile('document');
        $requestData =  json_decode($_POST['requestData'], true);


        if (isset($document)) {
            $pathToUpload = "assets/images";

            $newName = $document->getRandomName();
            $document->move($pathToUpload, $newName);
            //remove old document

            if (isset($requestData['site_logo'])) {
                if (file_exists($requestData['site_logo']) && !empty($requestData['site_logo'])) {

                    unlink($requestData['site_logo']);
                }
            }

            $requestData['site_logo'] = $pathToUpload . '/' . $newName;
            // $requestData['file_name_original'] = $document->getClientName();
        }

      
       // $encrypter = \Config\Services::encrypter();

        //encryp password
    //    $requestData['smtp_pass'] = bin2hex($encrypter->encrypt($requestData['smtp_pass']));

        $model = new SiteSettingsModel();

        $data = null;
        
        foreach($requestData as $key=>$value){
            $updated = 0;
            $updated = $model->updateSetting($key,$value);
            if($updated){
                $actionLogData = [
                   
                    'action_type' => 'updated',
                    'model' => 'siteSettings',
                    'record_id' => '0',
                    'chaged_data' => json_encode([$key=>$value])
                ];
                creatActionLog($actionLogData);
            }
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