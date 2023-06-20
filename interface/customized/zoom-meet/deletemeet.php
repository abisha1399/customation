<?php
namespace OpenEMR\Services;
use PHPMailer\PHPMailer\PHPMailer;
use OpenEMR\Common\Crypto\CryptoGen;

require_once '../vendor/autoload.php';
$ignoreAuth_onsite_portal = true;
    $isPortal = true;
require_once("../../globals.php");
include_once 'Zoom_Api.php';
$cryptoGen = new CryptoGen();
$auth_email=isset($GLOBALS['SMTP_USER'])?$GLOBALS['SMTP_USER']:'refreshhealthehr@gmail.com';
$auth_pass=isset($GLOBALS['SMTP_PASS'])?$GLOBALS['SMTP_PASS']:'adynjudkykinmwcm';
$zoom_meeting = new Zoom_Api();

if(isset($_POST['app_id']))
{
	$app_id=$_POST['app_id'];
}
else
{
	$app_id="";
}

if(isset($_POST['patient_ans']))
{
	$patient_ans=$_POST['patient_ans'];
}
else
{
	$patient_ans="";
}
if(!empty($app_id))
{

	$data = array();
	$appointment_id = sqlQuery("select * from openemr_postcalendar_events  WHERE pc_eid = ?", array($app_id));
	
	try {
			$response1 = $zoom_meeting->deleteMeeting($appointment_id['meeting_id']);
			if($patient_ans == "true")
			{
			send_mail($appointment_id,$response);
			}       
			echo "Meeting Deleted successfully!! ";
			echo "\n";         													

	}
	catch (Exception $ex) {
		echo $ex;
	}

}


function send_mail($appointment_id,$response)
{
	$user_details = sqlQuery("SELECT * FROM users where id = ?", array($appointment_id['pc_aid']));
	$patient_mail = sqlQuery("select * from patient_data WHERE pid = ?", array($appointment_id['pc_pid']));   
	if (filter_var($patient_mail['email'], FILTER_VALIDATE_EMAIL)) {



		require '../../login/PHPMailerAutoload.php';

		// define("EMAIL", "appointments@oasis-pcp.com");
        // define("PASS", "OAppointmets@2022");
		define('EMAIL',$auth_email);
		define('PASS',$cryptoGen->decryptStandard($auth_pass));


$mail = new PHPMailer;

//$mail->SMTPDebug = 3;
// Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'oasis-pcp.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$pname=$patient_mail['fname'].' '.$patient_mail['lname'];
$dtWrk = strtotime($appointment_id['pc_eventDate'] . ' ' . $appointment_id['pc_startTime']);
$EVENTSDATE = date('l F j, Y', $dtWrk);
$STARTSTIME = date('g:i A', $dtWrk);
$mail->setFrom(EMAIL, 'Oasis');
$mail->addAddress($patient_mail['email']);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo(EMAIL);
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = "Telehealth Appoinment";

	$mail->Body    = '<p> Dear '.$patient_mail['fname'].' '.$patient_mail['lname'].', </p> <p> Your Telehealth appointment with '.$user_details['fname'].' '.$user_details['lname'].' is Deleted on '.$EVENTSDATE.' at '.$STARTSTIME.'. </p>  <p> Regards,</p> <span> Oasis </span>';
	

//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {

	echo 'mail could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
}
else
{
	echo 'Mail sent successfully to patient!';
	echo "\n";
}
	}

}