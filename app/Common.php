<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */
use App\Models\ActionLogModel;

function cart(bool $getShared = true)
{
    return \Config\Services::cart($getShared);
}

function creatActionLog($data){

    $ActionLogModel = new ActionLogModel();
    $ActionLogModel->insert($data);

}

function getActionLog($model,$record_id){
    $ActionLogModel = new ActionLogModel();
    $data['list'] = $ActionLogModel->getList(['model'=>$model,'record_id'=>$record_id],'',0,50,'action_log.id desc');
    return view('admin/actionLog',$data);
}

function array_diff_assoc_recursive($array1, $array2) {
    $difference=array();
    foreach($array1 as $key => $value) {
        if( is_array($value) ) {
            if( !isset($array2[$key]) || !is_array($array2[$key]) ) {
                $difference[$key] = $value;
            } else {
                $new_diff = array_diff_assoc_recursive($value, $array2[$key]);
                if( !empty($new_diff) )
                    $difference[$key] = $new_diff;
            }
        } else if( !array_key_exists($key,$array2) || $array2[$key] !== $value ) {
            $difference[$key] = $value;
        }
    }
    return $difference;
}

function sendSms($mobile,$message){
    //staging
    $ch = curl_init("http://www.eazy2sms.in/SMS.aspx?Userid=BITSTRING&Password=BIT@2020&Type=1&Mobile=" . $mobile . "&Message=" . $message);
    
    //production
    // $ch = curl_init("http://www.eazy2sms.in/SMS.aspx?Userid=BITSTRING2&Password=BIT2@2020&Type=1&Mobile=" . $mobile . "&Message=" . $message);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// function getProductImageUrl($filename){
//     return base_url(PRODUCT_IMAGE_FILE_PATH.'/' .$filename);
// }
// function getProductImageThumbeUrl($filename){
//     return base_url(PRODUCT_IMAGE_THUMB_FILE_PATH.$filename);
// }

function sendEmail_common($to,$message,$subject){
    $email = \Config\Services::email();

    $email->setFrom('connect@bitstringit.in', 'Bitstringit');
    $email->setTo($to);

    $email->setSubject($subject);
    $email->setMessage($message);

      return  $email->send();
}