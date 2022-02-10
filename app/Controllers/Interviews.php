<?php

namespace App\Controllers;

use App\Models\ProfileModel;

class Interviews extends BaseController
{

    public function index($profileId)
    {

        helper(['form', 'url']);
		
        $model = new ProfileModel();
        $profileDetails = $model->find($profileId);

        $data = [
            'page_title' => 'Interviews',
            'active_nav_parent' => 'profiles',
            'active_nav' => 'profiles',
            'id'=> $profileId,
            'profileDetails'=> $profileDetails,
        ];

        return view('user/profiles/interviews', $data);
    }

    

}
