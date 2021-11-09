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

function creatActionLog($data)
{

    $ActionLogModel = new ActionLogModel();
    $ActionLogModel->insert($data);
}

function getActionLog($model, $record_id)
{
    $ActionLogModel = new ActionLogModel();
    $data['list'] = $ActionLogModel->getList(['model' => $model, 'record_id' => $record_id], '', 0, 50, 'action_log.id desc');
    return view('admin/actionLog', $data);
}

function array_diff_assoc_recursive($array1, $array2)
{
    $difference = array();
    foreach ($array1 as $key => $value) {
        if (is_array($value)) {
            if (!isset($array2[$key]) || !is_array($array2[$key])) {
                $difference[$key] = $value;
            } else {
                $new_diff = array_diff_assoc_recursive($value, $array2[$key]);
                if (!empty($new_diff))
                    $difference[$key] = $new_diff;
            }
        } else if (!array_key_exists($key, $array2) || $array2[$key] !== $value) {
            $difference[$key] = $value;
        }
    }
    return $difference;
}

function sendSms($mobile, $message)
{
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

function sendEmail_common($to, $message, $subject)
{
    $email = \Config\Services::email();

    $email->setFrom('connect@bitstringit.in', 'Bitstringit');
    $email->setTo($to);

    $email->setSubject($subject);
    $email->setMessage($message);

    return  $email->send();
}

function getBackgroundInformationQuestion($code = '')
{

    $questions = [
        "C01" => "Have you ever been convicted of a criminal offence?",
        "C02" => "Are there any criminal or disciplinary charges pending against you?",
        "C03" => "Are you currently engaged in or have you ever been involved in litigation with your current or former employer, which has resulted or may result in action in a court or tribunal or a settlement by negotiation, arbitration, mediation or alternative dispute resolution procedure?",
        "C04" => "Have you ever been the subject of a civil action that resulted in a finding e.g. a fine or judgement against you in India or elsewhere?",
        "C05" => "Have you ever had a judgement debt (including a county court judgement) made under a court order in India or elsewhere or an individual voluntary arrangement with creditors?",
        "C06" => "Have you ever entered into a deed of arrangement with creditors?",
        "C07" => "Have you ever failed to satisfy any such judgement debts within one year of the making of the order?",
        "C08" => "Have you ever been declared bankrupt or had your estate sequestrated, been the subject of such proceedings, or is any such action pending?",
        "B01" => "Are you, or have you ever been, an officer (either as director or company secretary) or a partner of any company other than in a capacity specified in the employment history section?",
        "B02" => "Do you own more than 15% of any corporate body?",
        "B03" => "Are you currently engaged in any other outside business activity or employment not stated elsewhere in this form?",
        "B04" => "Do you, or any member of your family, have a business interest, employment obligations or are there any other situations that would conflict, or appear to conflict, with the employment for which you are applying?",
        "O01" => "Have you ever been or are you currently the subject of any investigation or disciplinary procedure in relation to your business or professional activities?",
        "O02" => "Have you ever been criticised, censured or disciplined by any organisation or body in relation to your business or professional activities?",
        "O03" => "Have you ever been refused or had revoked membership of any professional body or organisation of which you have been, or applied to be, a member?",
        "O04" => "Have you ever been disqualified by a court from acting as a director of a company or from being concerned with the management of any company, partnership or unincorporated body?",
    ];
    return $code ? $questions[$code] : $questions;
}
