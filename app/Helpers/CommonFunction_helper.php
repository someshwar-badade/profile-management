<?php

// use App\Models\SettingsModel;
use App\Models\UserModel;
// use Exception;
use Firebase\JWT\JWT;
function getGlobalValues(){
    // $SettingsModel = new SettingsModel();
    // $global = $SettingsModel->findAll();
    
    // $globalData = array();
    // foreach ($global as $rowData){
    //     $globalData[$rowData['setting_name']] = $rowData['setting_value'];
    // }
    // return $globalData;
}

function changeLanguage($lan='en'){
  
    $uriString = uri_string();
    $uriArray = explode('/',$uriString);
    if(in_array($uriArray[0],['en','mr'])){
        $uriArray[0] = $lan;
    }else{
        array_unshift($uriArray,$lan);
    }

    return implode('/',$uriArray);
}

function printFormatedDate($date=null,$defaultText=''){
   
    if(empty($date)){
        return $defaultText;
    }

    if(!isset($date)){
        return date(SITE_DATE_FORMAT);
    }

    return date(SITE_DATE_FORMAT,strtotime($date));


}

function printFormatedDatetime($date=null,$defaultText=''){
   
    if(empty($date)){
        return $defaultText;
    }

    if(!isset($date)){
        return date(SITE_DATE_TIME_FORMAT);
    }

    return date(SITE_DATE_TIME_FORMAT,strtotime($date));


    //return $defaultText;
}

function getMysqlDateFormat($date){
    return date('Y-m-d',strtotime($date));
}

function deleteFile($url){
    $filePath = substr($url,strlen(base_url()));
    if(is_file($filePath)){
        return unlink($filePath);
    }
    return null;
}

function checkUserToken(){
    //get header cookies
		$a_token = isset($_COOKIE['a_token'])?$_COOKIE['a_token']:'';
		$r_token = isset($_COOKIE['r_token'])?$_COOKIE['r_token']:'';
		$userId = -1;
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
		
		if($userId){
			$userModel = new UserModel();
			$user = $userModel->find($userId);
        }
        
        return $user;
}

function isAdmin($user){
    return in_array($user['user_type'],['admin','subadmin']);
}

function sendEmail($to,$subject,$messageBody,$arrAttachments=array(),$attachmentName=''){
    // Get a reference to the controller object
    $email = \Config\Services::email();
    
    $globalData = getGlobalValues();
    $mailTemplate='';
    $mailTemplate='
        <html lang="en">
            <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>'.$subject.'</title>
            <style type="text/css">

            @media only screen and (max-width : 780px) {
                        .wrpper	{ width:100% !important; padding:0px 10px;}
                        a.logo {float:none !important; display:block!important; width:100% }
                        header a {  margin: 0px !important;  padding: 3px  5px !important;  float:none;  width: 100%; font-size:12px}
                        footer{ padding:10px !important;}
                        p{ font-size:14px;}
                        body{ margin:0px; padding:0px;}
                        *{ box-sizing:border-box;}
                        }
            </style>
            </head>
                <body>
                <div class="wrpper" style="width:90%;margin: 0px auto; font-family:Arial, Helvetica, sans-serif">

                <header style="text-align:center;">
                <div style="float:left; width:100%; background:rgba(47,198,66,1); padding:10px 0; margin-bottom:20px;margin-top:10px;"> 
                    <div style="text-align: center; width:100%;"> 
                    <img src="'. base_url('assets/images/Logo.png').'" width="80px" alt="'.SITE_TITLE.'"> 
                    </div>
                </div>
                </header>
                    <div style="width:100%; float:left;min-height:100px;font-size:14px;">'.$messageBody.'<br><br><br>
                        
                    </div>
                       <div style="width:100%;text-align:center;color:#cdcdcd;margin-top:50px;font-size:12px;float:left">Please do not reply to this email address as customer queries are not monitored.</div> 
                    <div style="width:100%; float:left; padding:15px 10px; min-height:50px;background-color:rgba(0,0,0,.1);color:rgba(0,0,0,.5);font-size:12px; margin:50px 0px 0px 0px; box-sizing:border-box; border-top: solid 1px #ccc; text-align:center;">
                         &copy; 2020 All Rights Reserved.
                    </div>
                </div>

                </body>
            </html>
            ';
           
            //            $headers = 'MIME-Version: 1.0' . "\r\n";
            //            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            //            $headers .= 'From: ' . $globalData['site_title'] . '<' . $globalData['site_email'] . '>' . "\r\n";
            
           

					
		
        $config['protocol'] = 'sendmail';
		$config['mailPath'] = '/usr/sbin/sendmail';
        $config['mailType'] = 'html';
        
        $email->clear(TRUE);
        $email->initialize($config);
		
        $email->setFrom('somesh@bitstringit.in', SITE_TITLE);
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($mailTemplate);
		if(!empty($arrAttachments)){
			foreach($arrAttachments as $attachpath){
                            if(!empty($attachmentName)){
                                $email->attach($attachpath,'attachment',$attachmentName);
                            }else{
                                $email->attach($attachpath);
                            }
				
			}
		}
       return $email->send();
		
           
   // return @mail($to, $subject, $mailTemplate, $headers); 
    
}

function sendEmail_contactUs($name,$email,$mobile,$message){
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'].' Contact Us';
    $messageBody='Hello Admin,
                 <p style="margin:5px 0px 0px 0px; color:#000;">User trying to reach you. Please look following contact details.</p>   
                    
                    <p  style="margin:5px 0px 0px 0px; color:#000;">Name : '. $name.' </p>
                   <p  style="margin:5px 0px 0px 0px; color:#000;">email  : '.$email.' </p>
                   <p  style="margin:5px 0px 0px 0px; color:#000;">mobile  : '.$mobile.' </p>
                   <p  style="margin:5px 0px 0px 0px; color:#000;">Message  : '.$message.' </p>
                     ';
    sendMail_contactusReply($email,$name);
    return sendEmail($globalData['contact_us_email'],$subject,$messageBody);
}

function sendMail_contactusReply($to,$name){
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'].' Contact Us';
    $messageBody='Dear '.$name.',
                    <p></p>
                 <p>Thank you for contacting us. We contact you soon in next working days.</p>   
                  ';
    
    return sendEmail($to,$subject,$messageBody);
}