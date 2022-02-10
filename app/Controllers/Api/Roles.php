<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CapabilityModel;
use App\Models\RoleCapabilityModel;

class Roles extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];
    // get all Employee details
    public function capabilities($id)
    {
        $user = checkUserToken();
        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new CapabilityModel();
        $data = $model->getAllCapabilities($id);
        //Respond with 200 status code
        return $this->respond($data);
        // return $this->respond($data);
        // echo $data;
        // die;
    }

    
    public function saveCapabilities($id){
        $requestData = (array) $this->request->getJSON(true);

       
        $model = new RoleCapabilityModel();
        foreach($requestData as $roleCapability){
            if($roleCapability['role_capability_id']){
                //update
                $model->update($roleCapability['role_capability_id'],['role_id'=>$id, 'capability_id'=>$roleCapability['capability_id'],'is_allowed'=>$roleCapability['is_allowed']]);
            }else{
                //insert
                $model->insert(['role_id'=>$id, 'capability_id'=>$roleCapability['capability_id'],'is_allowed'=>$roleCapability['is_allowed']]);
            }
        }

        $cap_model = new CapabilityModel();
        $data = $cap_model->getAllCapabilities($id);
        return $this->respond($data);

    }



}
