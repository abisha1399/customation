<?php

$ignoreAuth = 1;
require_once("../../globals.php");
require '../../customized/PHPMailerAutoload1.php';
use OpenEMR\Common\Crypto\CryptoGen;
$cryptoGen = new CryptoGen();
$email_sender='refreshhealthehr@gmail.com';
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
//echo $_SESSION['site_id'];
$terra_connected_user=sqlStatement("SELECT CONCAT(u.fname, ' ', u.lname) as user_name,u.email as useremail,
pd.email as patemail,CONCAT(pd.fname, ' ', pd.lname) as patient_name,tr.* FROM terra_user as tr left join patient_data as pd on pd.pid=tr.pid left join 
users as u on u.id=tr.auth_user_id WHERE tr.status=1");
$libre_user=[];
$total_con_count=sqlNumRows($terra_connected_user);
if(!empty($total_con_count))
{
    while($row=sqlFetchArray($terra_connected_user))
    {
        $libre_user[]=$row;
    }
    
    if(!empty($libre_user))
    {
        foreach($libre_user as $value)
        {
            $report_flag=isset($value['report_sent'])?$value['report_sent']:0;
            $sensor_start_date=$value['assign_date'];  
            $pid=isset($value['pid'])?$value['pid']:'';
            $receipt_id=isset($value['auth_user_id'])?$value['auth_user_id']:'';
            $today_date=date('Y-m-d');         
            $sensor_end_date=date('Y-m-d', strtotime($sensor_start_date. ' + 30 days'));
            $patient_name=$value['patient_name'];
            $user_name =isset($value['user_name'])?$value['user_name']:'';  
            echo $sensor_start_date.'<br>'.$sensor_end_date.'<br>'.$today_date;
            
            if(strtotime($sensor_end_date)<=strtotime($today_date))
            {
                $libre_query=sqlStatement("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='Terra_Api' AND blood_glucose IS NOT NULL AND reading_date BETWEEN '".$sensor_start_date."' AND '".$sensor_end_date."' GROUP BY reading_date");
                $libre_count=sqlNumRows($libre_query);
                if($libre_count>=3 && $report_flag==0)
                {
                    $reort_sent=1;
                    define('EMAIL',$auth_email);
                    define('PASS',$cryptoGen->decryptStandard($auth_pass));
                
                    $to=isset($value['useremail'])?$value['useremail']:'';   
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
                
                    $mail->Subject = 'CGM Report';
                    $url= 'http://'.$_SERVER['SERVER_NAME'].$web_root.'/interface/autorun/cgm_bill_create.php?report_id='.$value['id'].'';
                    $data='<h4>Hi '.$user_name.',</h4><br>';
                    $data.='Please <a href="'.$url.'">click here</a> to review & esign the for'.$patient_name.' Freestylelibre Vitals report';
                    $data.='<br><br>Regards,<br>'.$regards.'';
                    $mail->Body    = $data;
                    if($to)
                    {
                        $mail->send();
                    }
                    
                    if($reort_sent)
                    {
                        sqlStatement("UPDATE terra_user SET report_sent=1 WHERE pid='".$pid."'");
                        echo "<br>report sent to ".$pid."";
                    }

                }
                else{
                    if($report_flag==0)
                    {
                        $updated_date=date('Y-m-d', strtotime($today_date. ' + 1 days')); 
                        sqlStatement("UPDATE terra_user SET report_sent=0,assign_date='".$updated_date."' WHERE pid='".$pid."'");
                        echo "<br>suffient data  for report generate  so  libre reset to ".$pid."";

                    }
                    
                }

            }
            else{
                echo "<br>No time for ".$pid."";
            }
            echo "<br>*************************************************************************************";

        }
    }
}
else{
    echo "No Patient with terra connected";
}
?>