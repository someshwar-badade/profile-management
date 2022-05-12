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
use App\Models\CapabilityModel;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use App\Models\SiteSettingsModel;
// use Exception;
use Firebase\JWT\JWT;

function cart(bool $getShared = true)
{
    return \Config\Services::cart($getShared);
}

function getSiteSetting($setting_name){
    $SiteSettingsModel = new SiteSettingsModel();
    $data = $SiteSettingsModel->where('setting_name',$setting_name)->first();

    // if($setting_name == 'smtp_pass'){
    //     $encrypter = \Config\Services::encrypter();
    //     if(!empty($data['value'])){
    //         return isset($data['value'])?$encrypter->decrypt(hex2bin($data['value'])):'';
    //     }
    // }else{
    // }
    return isset($data['value'])?$data['value']:'';

}

function creatActionLog($data)
{

    $actionBy = '';
    $user = checkUserToken();
    $session = session();
    
    $data['user_id']='0';
    if($user){
        $actionBy = $user['fname'].' '.$user['lname'];
        $data['user_id'] = $user['id'];
    }else if(!empty($session->get('employee_joining_form_id'))){
        $actionBy = $session->get('employee_name').' '.$session->get('employee_last_name'); 
    }else if(!empty($session->get('profile_id'))){
        $actionBy = $session->get('profile_first_name').' '.$session->get('profile_last_name');
    }
    $data['action_by'] = $actionBy;

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

function sendEmail_common($to, $message, $subject,$from = '')
{
    $email = \Config\Services::email();

    $config['SMTPHost'] = getSiteSetting('smtp_host');
    $config['SMTPUser'] = getSiteSetting('smtp_user');
    $config['SMTPPass'] = getSiteSetting('smtp_pass');
    $config['SMTPPort'] = getSiteSetting('smtp_port');
    // $config['mailPath'] = '/usr/sbin/sendmail';
    // $config['charset']  = 'iso-8859-1';
    // $config['wordWrap'] = true;

    if(!empty($config['SMTPHost']) && !empty($config['SMTPUser']) && !empty($config['SMTPPass']) && !empty($config['SMTPPort']))
    {
        $email->initialize($config);
    }

    $from = empty($from)?getSiteSetting('smtp_user'):'connect@bitstringit.com';
    $email->setFrom($from, getSiteSetting('site_title'));
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

function checkUserToken(){
    //get header cookies
		$a_token = isset($_COOKIE['a_token'])?$_COOKIE['a_token']:'';
		$r_token = isset($_COOKIE['r_token'])?$_COOKIE['r_token']:'';
		$userId = -1;
        $session = session();
		try{
			$payload = JWT::decode($a_token,JWT_SECRETE_KEY,['HS256']);
			$userId = $payload->user_id;

		} catch(Exception $e){
			
			//if access token expire check refresh token
			try{
				$payload = JWT::decode($r_token,JWT_SECRETE_KEY_2,['HS256']);
				$userId = $payload->user_id;
			}catch(Exception $e){
				//redirct to login
				setcookie("a_token", "", time() - 3600,'/');//delete cookie
				setcookie("r_token", "", time() - 3600,'/');//delete cookie
				return null;
			}
			
		}
		$user = null;
		if($userId){
			$userModel = new UserModel();
			$userRoleModel = new UserRoleModel();
			$user = $userModel->find($userId);
            // $user['roles'] = $userRoleModel->where('user_id',$user['id'])->find();
            $user['roles'] = $userRoleModel->getRoles($user['id']);
        }
        
        return $user;
}

function hasCapability($capability){
    $m = new CapabilityModel();
    $user = checkUserToken();
    $session = session();
    $roleId = isset($user['roles'][0])?$user['roles'][0]['role_id']:'6';
   
    if(!empty($user)){
      
        $roleId = isset($user['roles'][0])?$user['roles'][0]['role_id']:'6';
        if(isset($user['roles'][0])){
            if($user['roles'][0]['role_name']=='admin'){

                return true;
            }else{
                return $m->hasCapability($capability,$roleId);
            }
        }
    }
    return false;
}


$combinationResult = array();
$combination = array();

function inner($start, $choose_, $arr, $n)
{
    global $combinationResult, $combination;

    if ($choose_ == 0) array_push($combinationResult, $combination);
    else for ($i = $start; $i <= $n - $choose_; ++$i) {
        array_push($combination, $arr[$i]);
        inner($i + 1, $choose_ - 1, $arr, $n);
        array_pop($combination);
    }
}

function combinations(array $myArray, $choose)
{
    global $combinationResult, $combination;

    $n = count($myArray);
    inner(0, $choose, $myArray, $n);
    $newTemp = $combinationResult;
    $combinationResult = array();
    $combination = array();
    return $newTemp;
}


function primary_regxp_fun($value)
    {

        if(is_array($value)){
            return "MATCH(primary_skills_soundex) AGAINST('+".soundex($value['text'])."' IN BOOLEAN MODE)";
        }else{
            return "MATCH(primary_skills_soundex) AGAINST('+".soundex($value)."' IN BOOLEAN MODE)";
        }
       
        // return "primary_skills REGEXP '([[:blank:][:punct:]]|^)$value([[:blank:][:punct:]]|$)'";
        
        //SOUNDEX(primary_skills) LIKE CONCAT(SOUNDEX('".$value."'), '%')
        // return "SOUNDEX(primary_skills) LIKE CONCAT('%',SOUNDEX('%".$value."'), '%')";
    }
    function secondary_regxp_fun($value)
    {
       
        if(is_array($value)){
            return "MATCH(secondary_skills_soundex) AGAINST('+".soundex($value['text'])."' IN BOOLEAN MODE)";
        }else{
            return "MATCH(secondary_skills_soundex) AGAINST('+".soundex($value)."' IN BOOLEAN MODE)";
        }
        // return "secondary_skills REGEXP '([[:blank:][:punct:]]|^)$value([[:blank:][:punct:]]|$)'";
       
        // return "SOUNDEX(secondary_skills) LIKE CONCAT('%',SOUNDEX('".$value."'), '%')";
    }

function convertStringToSoundex($string, $seprator=' '){
    $soundexStr=[];
    $wordArray = [];
   
    if(is_array($string)){
        $wordArray = $string; 
    }else{
        $wordArray =  explode($seprator,$string);
    }

    foreach($wordArray as $item){
        $item = (array)$item;
        $soundexStr[]= soundex(trim($item['text']));
    }

    if(is_array($string)){
        return $soundexStr; 
    }

    return implode(" ",$soundexStr);
}

function checkSoundexExist($word,$arrWords)
{
   
    foreach($arrWords as $item){
        if(is_array($item)){
            $soundexWordsList[]= soundex(trim($item['text']));
        }else{
            $soundexWordsList[]= soundex(trim($item));
        }
       
    }

    $soundexWord = soundex($word);
    return in_array($soundexWord,$soundexWordsList);
}


/**
 * A method for sorting associative arrays by a key and a direction.
 * Direction can be ASC or DESC.
 *
 * @param $array
 * @param $key
 * @param $direction
 * @return mixed $array
 */
function sortAssociativeArrayByKey($array, $key, $direction){

    if(empty($array)){
        return;
    }
    switch ($direction){
        case "ASC":
            usort($array, function ($first, $second) use ($key) {
                return $first[$key] <=> $second[$key];
            });
            break;
        case "DESC":
            usort($array, function ($first, $second) use ($key) {
                return $second[$key] <=> $first[$key];
            });
            break;
        default:
            break;
    }

    return $array;
}
