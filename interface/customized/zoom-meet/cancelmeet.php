<?php
namespace OpenEMR\Services;
use PHPMailer\PHPMailer\PHPMailer;

require_once '../vendor/autoload.php';
$ignoreAuth_onsite_portal = true;
    $isPortal = true;
require_once("../../globals.php");

include_once 'Zoom_Api.php';



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

	// echo "<script>";
	// echo "alert('hiii');";
	// echo "</script>";


	$data = array();
	$appointment_id = sqlQuery("select * from openemr_postcalendar_events  WHERE pc_eid = ?", array($app_id));
	
	try {
                    if($_POST['flag']=="1")
                    {
                            $data['topic'] 		= 'Telehealth Appiontment';
                            $data['start_date'] = $_POST['start_date'].''.$_POST['start_time'];
                            $data['start_time'] = $_POST['start_time'];
                            $data['duration'] 	= $_POST['duration'];
                            $data['type'] 		= 2;
                            $data['password'] 	= "12345";
                        
                            $response1 = $zoom_meeting->deleteMeeting($appointment_id['meeting_id']);

        $srow = sqlQuery("update openemr_postcalendar_events set join_url=?,start_url=?,
        meeting_id=?,meet_password=? WHERE pc_eid = ?", 
        array(NULL,NULL,NULL,NULL,$app_id));
                        // echo "<pre>";
                    if($patient_ans == "true")
                    {
                       send_mail($appointment_id,$response);
                    }       
					echo "Meeting Cancelled successfully!! ";              													
					echo "\n";
										}
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

		define("EMAIL", "appointments@oasis-pcp.com");
        define("PASS", "OAppointmets@2022");


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

	$mail->Body    = '<p> Dear '.$patient_mail['fname'].' '.$patient_mail['lname'].', </p> <p> Your Telehealth appointment with '.$user_details['fname'].' '.$user_details['lname'].' is Cancelled on '.$EVENTSDATE.' at '.$STARTSTIME.'. </p>  <p> Regards,</p> <span> Oasis </span>';
    $ss = sqlQuery("update openemr_postcalendar_events set pc_sendalertemail=? WHERE pc_eid = ?", array("NO",$appointment_id['pc_eid']));

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