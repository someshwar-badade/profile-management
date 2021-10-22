<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\SettingsModel;
use CodeIgniter\CLI\Console;

class Settings extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];
    // get all Employee details
    public function index()
    {
        $user = checkUserToken();
        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new SettingsModel();
        $data = $model->find($user['id']);
        //Respond with 200 status code
        return $this->respond($data);
        // return $this->respond($data);
        // echo $data;
        // die;
    }

    // get single Employee details
    public function show($id = null)
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new SettingsModel();
        $data = $model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }


    // update Employee details
    public function update($id = null)
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $requestData = (array) $this->request->getJSON();
        // $requestData = $this->request->getRawInput();
        $model = new SettingsModel();
        // var_dump($requestData);
        // die;


        $data = [

            // `id`=> $this->request->getVar('id'),
            `fname` => $this->request->getVar('fname'),
            `lname` => $this->request->getVar('lname'),
            // `email`=> $this->request->getVar('email'),
            `mobile` => $this->request->getVar('mobile'),
            `user_type` => $this->request->getVar('user_type'),
            `user_role` => $this->request->getVar('user_role'),
            `owner_id` => $this->request->getVar('owner_id'),
            // `password`=> $this->request->getVar('password')

        ];

        $validation =  \Config\Services::validation();

        $rules = [
            // 'email' => 'required',
            'fname' => 'required'
        ];
        $validation->setRules(
            $rules,
            [   // Errors
                // 'email' => [
                //     'required' => lang('forms.register.email.errorRequired')
                // ],
                'fname' => [
                    'required' => lang('forms.register.fname.errorRequired')
                ]
            ]
        );
        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
        }

        $id =  $model->update($id, $requestData);
        $response = [
            'id'   => $id,
            'action_type' => 'Updated',
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respondCreated($response);
    }


    public function updatePassword()
    {
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $requestData = (array) $this->request->getJSON();
        $model = new SettingsModel();
        // var_dump($requestData);
        // die;
        
        // print_r($requestData['oldpassword']);
        // die;
        $validation =  \Config\Services::validation();

        $rules = [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'cnfpassword' => 'matches[newpassword]'
        ];
        $validation->setRules(
            $rules,
            [   // Errors
                'oldpassword' => [
                    'required' => lang('forms.register.password.errorRequired')
                ],
                'newpassword' => [
                    'required' => lang('forms.register.password.errorRequired')
                ],
                'cnfpassword' => [
                    'required' => lang('forms.register.password.errorRequired')
                ]
            ]
        );
        $valid = $validation->run($requestData);
        if (!$valid) {
            return $this->fail($validation->getErrors(), 400);
        }

        //check password
        if (!password_verify($requestData['oldpassword'], $user['password'])) {
            return $this->fail(['oldpassword' => lang('forms.login.password.errorInvalid')]);
        }
        //valid user
        $isValidUser = true;

        if ($isValidUser) {

            $id =  $model->update($user['id'], ['password' => password_hash($requestData['newpassword'], PASSWORD_BCRYPT)]);
            
            $response = [
                'id'   => $id,
                'action_type' => 'Updated',
                'error'    => null,
                'messages' => [
                    'success' => 'Password Updated'
                ]
            ];
            return $this->respondCreated($response);
        } else {
            //error
            return $this->fail(['password' => lang('forms.login.password.errorInvalid')]);
        }

        // print_r($user);
        // die;
    }
}
