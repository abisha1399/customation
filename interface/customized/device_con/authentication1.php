<?php
$ignoreAuth = 1;
require_once("../../globals.php");
require '../../customized/PHPMailerAutoload1.php';
use OpenEMR\Common\Crypto\CryptoGen;
$cryptoGen = new CryptoGen();
$email_sender='donotreply@refresh.health';
$auth_email=isset($GLOBALS['SMTP_USER'])?$GLOBALS['SMTP_USER']:'refreshhealthehr@gmail.com';
$site=isset($_SESSION['organisation_name'])?$_SESSION['organisation_name']:'';
$auth_pass=isset($GLOBALS['SMTP_PASS'])?$GLOBALS['SMTP_PASS']:'adynjudkykinmwcm';
$host=isset($GLOBALS['SMTP_HOST'])?$GLOBALS['SMTP_HOST']:'smtp.gmail.com';
    $port=isset($GLOBALS['SMTP_PORT'])?$GLOBALS['SMTP_PORT']:'587';
    $secure=isset($GLOBALS['SMTP Security Protocol'])?$GLOBALS['SMTP Security Protocol']:'tls';
	$orgfrom='Refresh Health';
	if($site =='default'){
		$orgfrom=isset($GLOBALS['patient_reminder_sender_name'])?$GLOBALS['patient_reminder_sender_name']:'RefreshHealth';
	}
	else if($site=='brevardim'){
		$orgfrom='BrevardIM';
	}
	else{
		$orgfrom=ucfirst($site);
	}
    $regards=$orgfrom;
// require_once('../../login/PHPMailerAutoload1.php');
$pid=isset($_SESSION['pid'])?$_SESSION['pid']:'';
$patient_data=sqlQuery("SELECT * FROM patient_data WHERE pid=?",array($pid));
$terra_dev_id=isset($GLOBALS['terra_devid'])?$GLOBALS['terra_devid']:'refresh-health-dev-4kHfmQNvOw';
$terra_api_key=isset($GLOBALS['terra_api_key'])?$GLOBALS['terra_api_key']:'c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1';
//https://docs.tryterra.co/reference/list-integrations
if(isset($_GET['libre']))
{
    $output=[];
    //send auth url request
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tryterra.co/v2/auth/authenticateUser?resource=FREESTYLELIBRE',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
           'Accept: application/json',
           'content-type: application/json',
            'dev-id: '.$terra_dev_id.'',
            'x-api-key: '.$terra_api_key.''
            
        ),
    ));
    $response = curl_exec($curl);
    
    curl_close($curl);
    $my_array_data = json_decode($response,true);    
    $auth_url= isset($my_array_data['auth_url'])?$my_array_data['auth_url']:'';
    $user_id= isset($my_array_data['user_id'])?$my_array_data['user_id']:'';    
    $date = date('Y-m-d H:i:s');
    $assign_date=date('Y-m-d');
    $auth_user_id= $_SESSION['authUserID'];
    $email_exit=sqlQuery("SELECT * FROM terra_user WHERE pid =$pid");
    if($auth_url&&$auth_url!='')
    {
        if(!empty($email_exit))
        {
            sqlStatement("UPDATE terra_user SET auth_user_id='". $auth_user_id."',create_date='".$date."',user_id='".$user_id."',assign_date='".$assign_date."',status=0 WHERE pid='".$pid."'");
        }
        else
        {
            sqlStatement("INSERT INTO terra_user(pid,user_id,auth_user_id,create_date,assign_date) VALUES (?,?,?,?,?)",array($pid,$user_id,$auth_user_id,$date,$assign_date));
        }
       
        define('EMAIL',$auth_email);
		define('PASS',$cryptoGen->decryptStandard($auth_pass));
        $to=isset($patient_data['email'])?$patient_data['email']:'';
        $patient_name=$patient_data['fname'].' '.$patient_data['lname'];        
        $mail = new PHPMailer;
        $mail->isSMTP();                                      
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                               
        $mail->Username = EMAIL;                 
        $mail->Password = PASS;                           
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;       
        $mail->addAddress($to);
        $mail->AddReplyTo($email_sender, $email_sender);
        $mail->SetFrom($email_sender, $email_sender); 
        $mail->isHTML(true);    
        $link=$auth_url;     
        $mail->Subject = 'FreeStyle Libre Authentication';
        $data='<h4>Hi '.$patient_name.',</h4><br>';
        $data.='Welcome to '.$regards.'<br>';
        $data.='<p>We are excited to offer you a convenient and secure way to see your healthcare data
        </p>';
        $data.='<p>To get started, Please <a href="'.$link.'" >Click here</a> the FreeStyle Libre data.</p>';
        $data.='<br><br>Regards,<br>'.$regards.'';
        $mail->Body    = $data;
        if($to)
        {
            $mail->send();
        }
        $output['status']='success';
        $output['message']='The authentication URL was sent to the patient email Successfully!';

    }
    else{
        $output['status']='danger';
        $output['message']='Invalid x-api-key & dev-id combination';
    }
    
    
    echo json_encode($output);
    exit();
    
    
}

if(isset($_GET['google_fit']))
{
    //send auth url request
    $output=[];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tryterra.co/v2/auth/authenticateUser?resource=google',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
           'Accept: application/json',
           'content-type: application/json',
            'dev-id: '.$terra_dev_id.'',
            'x-api-key: '.$terra_api_key.''
            
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $my_array_data = json_decode($response,true);
    $auth_url= isset($my_array_data['auth_url'])?$my_array_data['auth_url']:'';
    $user_id= isset($my_array_data['user_id'])?$my_array_data['user_id']:'';
    $date = date('Y-m-d H:i:s');
    $auth_user_id= $_SESSION['authUserID'];
    $email_exit=sqlQuery("SELECT * FROM terra_googlefit WHERE pid =$pid");
    
    if($auth_url)

    {
        if(!empty($email_exit))
        {
            sqlStatement("UPDATE terra_googlefit SET auth_user_id='". $auth_user_id."',create_date='".$date."',user_id='".$user_id."',urllink='".$auth_url."',status=0 WHERE pid='".$pid."'");
            $insert_id=$email_exit['id'];
        }
        else{
            $insert_id=sqlInsert("INSERT INTO terra_googlefit(pid,user_id,urllink,auth_user_id,create_date) VALUES (?,?,?,?,?)",array($pid,$user_id,$auth_url,$auth_user_id,$date));
        }
        define('EMAIL',$auth_email);
		define('PASS',$cryptoGen->decryptStandard($auth_pass));        
        $to=isset($patient_data['googlefit_email'])?$patient_data['googlefit_email']:'';
        $patient_name=$patient_data['fname'].' '.$patient_data['lname'];        
        $mail = new PHPMailer;
        $mail->isSMTP();                                      
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                               
        $mail->Username = EMAIL;                 
        $mail->Password = PASS;                           
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;       
        $mail->addAddress($to);
        $mail->AddReplyTo($email_sender, $email_sender);
        $mail->SetFrom($email_sender, $email_sender); 
        $mail->isHTML(true); 
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://" . $_SERVER['HTTP_HOST'].''.$web_root;
        $link.='/interface/customized/googlefit_link.php?id='.$insert_id;
        $mail->Subject = 'Google fit Authentication';
        $data='<h4>Hi '.$patient_name.',</h4><br>';
        $data.='Welcome to '.$regards.'<br>';
        $data.='<p>We are excited to offer you a convenient and secure way to see your healthcare data
        </p>';
        $data.='<p>To get started, Please <a href="'.$link.'" >Click here</a> the googlefit data.</p>';
        $data.='<br><br>Regards,<br>'.$regards.'';
        $mail->Body    = $data;
        if($to)
        {
            $mail->send();
        } 
        $output['status']='success';
        $output['message']='The authentication URL was sent to the patients Googlefit Registered Email Successfully!';

    }
    else{
        $output['status']='danger';
        $output['message']='Invalid x-api-key & dev-id combination';
    }
    echo json_encode($output);
    exit();

}
if(isset($_GET['omron']))
{
    $output=[];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tryterra.co/v2/auth/authenticateUser?resource=OMRONUS',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
           'Accept: application/json',
           'content-type: application/json',
            'dev-id: '.$terra_dev_id.'',
                'x-api-key: '.$terra_api_key.''
            
        ),
    ));
    $response = curl_exec($curl);
    
    curl_close($curl);
    $my_array_data = json_decode($response,true);
    $auth_url= isset($my_array_data['auth_url'])?$my_array_data['auth_url']:'';
    $user_id= isset($my_array_data['user_id'])?$my_array_data['user_id']:'';
    $auth_user=$_SESSION['authUserID'];
    $date = date('Y-m-d H:i:s');
    $email_exit=sqlQuery("SELECT * FROM omron_token WHERE pid =$pid");    
    if($auth_url)
    {
        if(!empty($email_exit))
        {
            sqlStatement("UPDATE omron_token SET user_id='".$user_id."',auth_user_id='".$auth_user."',updated_time='".$date."', status=0 WHERE pid=".$pid."");
        }
        else
        {
            sqlStatement("INSERT INTO omron_token(pid,user_id,auth_user_id,updated_time) VALUES (?,?,?,?)",array($pid,$user_id,$auth_user,$date));
        }
        define('EMAIL',$auth_email);
		define('PASS',$cryptoGen->decryptStandard($auth_pass));
        $to=isset($patient_data['email'])?$patient_data['email']:'';
        $patient_name=$patient_data['fname'].' '.$patient_data['lname'];        
        $mail = new PHPMailer;
        $mail->isSMTP();                                      
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                               
        $mail->Username = EMAIL;                 
        $mail->Password = PASS;                           
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;       
        $mail->addAddress($to);
        $mail->AddReplyTo($email_sender, $email_sender);
        $mail->SetFrom($email_sender, $email_sender);
        $mail->isHTML(true);
       
        $mail->Subject = 'Omron Authentication';
        $data='<h4>Hi '.$patient_name.',</h4><br>';
        $data.='Welcome to '.$regards.'<br>';
        $data.='<p>We are excited to offer you a convenient and secure way to see your healthcare data
        </p>';
        $data.='<p>To get started, Please <a href="'.$auth_url.'" >Click here</a> the Omron data.</p>';
        $data.='<br><br>Regards,<br>'.$regards.'';
        $mail->Body    = $data;
        if($to)
        {
            $mail->send();
        }
        $output['status']='success';
        $output['message']='The authentication URL was sent to the patients email Successfully!';

    }
    else{
        $output['status']='danger';
        $output['message']='Invalid x-api-key & dev-id combination';
    }
    echo json_encode($output);
    exit();

}

if(isset($_GET['fitbit']))
{
    $output=[];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tryterra.co/v2/auth/authenticateUser?resource=FITBIT',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
           'Accept: application/json',
           'content-type: application/json',
            'dev-id: '.$terra_dev_id.'',
                'x-api-key: '.$terra_api_key.''
            
        ),
    ));
    $response = curl_exec($curl);
    
    curl_close($curl);
    $my_array_data = json_decode($response,true);
    $auth_url= $my_array_data['auth_url'];
    $user_id= $my_array_data['user_id'];
    $auth_user=$_SESSION['authUserID'];
    $date = date('Y-m-d H:i:s');
    $email_exit=sqlQuery("SELECT * FROM terra_fitbit WHERE pid =$pid");
    
    if($auth_url)
    {
        if(!empty($email_exit))
        { 
            sqlStatement("UPDATE terra_fitbit SET user_id='".$user_id."',update_date='".$date."',auth_user_id='".$auth_user."', status=0 WHERE pid='".$pid."'");
        }
        else
        {
            sqlStatement("INSERT INTO terra_fitbit(pid,user_id,auth_user_id,create_date) VALUES (?,?,?,?)",array($pid,$user_id,$auth_user,$date));
        }
        define('EMAIL',$auth_email);
		define('PASS',$cryptoGen->decryptStandard($auth_pass));     
        $to=isset($patient_data['email'])?$patient_data['email']:'';
        $patient_name=$patient_data['fname'].' '.$patient_data['lname'];        
        $mail = new PHPMailer;
        $mail->isSMTP();                                      
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                               
        $mail->Username = EMAIL;                 
        $mail->Password = PASS;                           
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;       
        $mail->addAddress($to);
        $mail->AddReplyTo($email_sender, $email_sender);
        $mail->SetFrom($email_sender, $email_sender);
        $mail->isHTML(true);
       
        $mail->Subject = 'Fitbit Authentication';
        $data='<h4>Hi '.$patient_name.',</h4><br>';
        $data.='Welcome to '.$regards.'<br>';
        $data.='<p>We are excited to offer you a convenient and secure way to see your healthcare data
        </p>';
        $data.='<p>To get started, Please <a href="'.$auth_url.'" >Click here</a> the Fitbit data.</p>';
        $data.='<br><br>Regards,<br>'.$regards.'';
        $mail->Body    = $data;
        if($to)
        {
            $mail->send();
        }
        $output['status']='success';
        $output['message']='The authentication URL was sent to the patients email Successfully!';

    }
    else{
        $output['status']='danger';
        $output['message']='Invalid x-api-key & dev-id combination';
    }
    echo json_encode($output);
    exit();

}
if(isset($_GET['dexcom']))
{
    $authUserID=isset($_SESSION['authUserID'])?$_SESSION['authUserID']:'';
    $auth_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://" . $_SERVER['HTTP_HOST'].''.$web_root;
    $auth_url.='/interface/customized/api_device_data/dexcom/dexcom_redirect.php?pid='.$pid.'&authUserID='.$authUserID;
    if($auth_url)

    {
       
		
        define('EMAIL',$auth_email);
		define('PASS',$cryptoGen->decryptStandard($auth_pass));      
        $to=isset($patient_data['email'])?$patient_data['email']:'';
        $patient_name=$patient_data['fname'].' '.$patient_data['lname'];        
        $mail = new PHPMailer;
        $mail->isSMTP();                                      
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                               
        $mail->Username = EMAIL;                 
        $mail->Password = PASS;                           
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;       
        $mail->addAddress($to);
        $mail->AddReplyTo($email_sender, $email_sender);
        $mail->SetFrom($email_sender, $email_sender); 
        $mail->isHTML(true);    
        $link=$auth_url;     
        $mail->Subject = 'Dexcom Authentication';
        $data='<h4>Hi '.$patient_name.',</h4><br>';
        $data.='Welcome to '.$regards.'<br>';
        $data.='<p>We are excited to offer you a convenient and secure way to see your healthcare data
        </p>';
        $data.='<p>To get started, Please <a href="'.$link.'" >Click here</a> the Dexcom data.</p>';
        $data.='<br><br>Regards,<br>'.$regards.'';
        $mail->Body    = $data;
        if($to)
        {
            $mail->send();
        }
    }
    echo $auth_url;
    exit();
}