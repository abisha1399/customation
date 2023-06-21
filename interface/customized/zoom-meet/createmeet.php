<?php
namespace OpenEMR\Services;
use PHPMailer\PHPMailer\PHPMailer;
use OpenEMR\Common\Crypto\CryptoGen;
require_once "../vendor/autoload.php";
$ignoreAuth_onsite_portal = true;
$isPortal = true;
require_once "../../globals.php";
require '../PHPMailerAutoload1.php';
include_once "Zoom_Api.php";
$auth_email=isset($GLOBALS['SMTP_USER'])?$GLOBALS['SMTP_USER']:'refreshhealthehr@gmail.com';
$cryptoGen = new CryptoGen();
$auth_pass=isset($GLOBALS['SMTP_PASS'])?$GLOBALS['SMTP_PASS']:'adynjudkykinmwcm';
$zoom_meeting = new Zoom_Api();

if (isset($_POST["appoin_id"])) {
    $appoin_id = $_POST["appoin_id"];
} else {
    $appoin_id = "";
}
if (isset($_POST["patient_ans"])) {
    $patient_ans = $_POST["patient_ans"];
} else {
    $patient_ans = "";
}

//for update the Appointment
if ($appoin_id != "")
{
    //  echo 'if';
    //  die();
    $data = [];
    $appointment_id = sqlQuery("select * from openemr_postcalendar_events  WHERE pc_eid = ?",[$appoin_id]);
	try {
        if ($appointment_id["meeting_id"] == null) {
            $data["topic"] = "Telehealth Appiontment";
            $data["start_date"] = $_POST["start_date"] . "" . $_POST["start_time"];
            $data["start_time"] = $_POST["start_time"];
            $data["duration"] = $_POST["duration"];
            $data["type"] = 2;
            $data["password"] = "12345";

            $response = $zoom_meeting->createMeeting($data);

            $response = (array) $response;
            if (!empty($response)) {
                $srow = sqlQuery(
                    "update openemr_postcalendar_events set join_url=?,start_url=?,meeting_id=?,meet_password=? WHERE pc_eid = ?",
                    [
                        $response["join_url"],
                        $response["start_url"],
                        $response["id"],
                        $response["password"],
                        $appoin_id,
                    ]
                );

                send_mail($appointment_id, $response);

                echo "Meeting created successfully!!";
                echo "\n";
            }

            //die();
        } else {
            $data["topic"] = "Telehealth Appiontment";
            $data["start_date"] =
                $_POST["start_date"] . "" . $_POST["start_time"];
            $data["start_time"] = $_POST["start_time"];
            $data["duration"] = $_POST["duration"];
            $data["type"] = 2;
            $data["password"] = "12345";

            $response = $zoom_meeting->updateMeeting(
                $data,
                $appointment_id["meeting_id"]
            );

            echo "Meeting ReSchduled successfully!!";
            echo "\n";

            if ($patient_ans == "true") {
                send_mail($appointment_id, $response);
            }
        }
    } catch (Exception $ex) {
        echo $ex;
    }
}

//for Create the Appointment
else {
	
    if ($_POST["insert_id"]) {
        $data = [];
        $appointment_id = sqlQuery(
            "select * from openemr_postcalendar_events  WHERE pc_eid = ?  ORDER BY pc_eid desc LIMIT 1",[$_POST["insert_id"]]);
            if($appointment_id["pc_apptstatus"] == "^")
            {
                $srow = sqlQuery("update openemr_postcalendar_events set pc_apptstatus=? WHERE pc_eid = ?",  array("doc_confirmed",$appointment_id["pc_eid"])); 
            $appointment_id["pc_apptstatus"]="doc_confirmed"; 
            }
        if ($appointment_id["pc_apptstatus"] == "doc_confirmed") {
			
            try {
                $data["topic"] = "Telehealth Appiontment";
                $data["start_date"] = $appointment_id["pc_eventDate"] ."" .$appointment_id["pc_startTime"];
                $data["start_time"] = $appointment_id["pc_startTime"];
                $data["duration"] = $appointment_id["duration"];
                $data["type"] = 2;
                $data["password"] = "12345";
                $response = $zoom_meeting->createMeeting($data);
                $response = (array) $response;
                if (!empty($response)) {
                    $srow = sqlQuery(
                        "update openemr_postcalendar_events set join_url=?,start_url=?,meeting_id=?,meet_password=? WHERE pc_eid = ?",
                        array(
                            $response["join_url"],
                            $response["start_url"],
                            $response["id"],
                            $response["password"],
                            $appointment_id["pc_eid"],
                         ));
                    send_mail($appointment_id, $response);

                    echo "Meeting created successfully!! ";
                    echo "\n";
                }
            } catch (Exception $ex) {
                echo $ex;
            }
        } else {
            echo "false";
        }
    }
}

function send_mail($appointment_id, $response)
{
    $user_details = sqlQuery("SELECT * FROM users where id = ?", [$appointment_id["pc_aid"],]);
    $patient_mail = sqlQuery("select * from patient_data WHERE pid = ?", [ $appointment_id["pc_pid"],]);
    if (filter_var($patient_mail["email"], FILTER_VALIDATE_EMAIL))
    {

        $cryptoGen = new CryptoGen();
        $email_sender='refreshhealthehr@gmail.com';
        $auth_email=isset($GLOBALS['SMTP_USER'])?$GLOBALS['SMTP_USER']:'refreshhealthehr@gmail.com';
        $auth_pass=isset($GLOBALS['SMTP_PASS'])?$GLOBALS['SMTP_PASS']:'adynjudkykinmwcm';
        $site=isset($_SESSION['site_id'])?$_SESSION['site_id']:'';       
        $host=isset($GLOBALS['SMTP_HOST'])?$GLOBALS['SMTP_HOST']:'smtp.gmail.com';
        $port=isset($GLOBALS['SMTP_PORT'])?$GLOBALS['SMTP_PORT']:'587';
        $secure=isset($GLOBALS['SMTP Security Protocol'])?$GLOBALS['SMTP Security Protocol']:'tls';
        define('EMAIL',$auth_email);
		define('PASS',$cryptoGen->decryptStandard($auth_pass));        
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL;                 // SMTP username
        $mail->Password = PASS;                           // SMTP password
        $mail->SMTPSecure = $secure;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $port;
        $mail->isHTML(true);
        $EVENTSDATE = date("l F j, Y", $dtWrk);
        $STARTSTIME = date("g:i A", $dtWrk);
        $mail->setFrom(EMAIL, "capminds");
        $mail->addAddress($patient_mail["email"]);             // Name is optional
        $mail->addReplyTo(EMAIL);
        $pname = $patient_mail["fname"] . " " . $patient_mail["lname"];
        $dtWrk = strtotime($appointment_id["pc_eventDate"] ." " . $appointment_id["pc_startTime"]);
        $mail->Subject = "Telehealth Appoinment";
        if ($appointment_id["meeting_id"] == null) {
            $mail->Body ="<p> Dear " .$patient_mail["fname"] ." " .$patient_mail["lname"] .", </p> <p> Your Telehealth appointment with " .
                $user_details["fname"] .
                " " .
                $user_details["lname"] .
                " is successfully scheduled on " .
                $EVENTSDATE .
                " at " .
                $STARTSTIME .
                ". </p> <p> Please join the meeting on time with the given url below </p> <p>" .
                $response["join_url"] .
                " </p> <p> Regards,</p> <span> Oasis </span>";
            $ss = sqlQuery(
                "update openemr_postcalendar_events set pc_sendalertemail=? WHERE pc_eid = ?",
                ["YES", $appointment_id["pc_eid"]]
            );
        } else {
            $mail->Body =
                "<p> Dear " .
                $patient_mail["fname"] .
                " " .
                $patient_mail["lname"] .
                ", </p> <p> Your Telehealth appointment with " .
                $user_details["fname"] .
                " " .
                $user_details["lname"] .
                " is successfully rescheduled on " .
                $EVENTSDATE .
                " at " .
                $STARTSTIME .
                ". </p> <p> Please join the meeting on time with the given url below </p> <p>" .
                $appointment_id["join_url"] .
                " </p> <p> Regards,</p> <span> Oasis </span>";
        }

        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if (!$mail->send()) {
            echo "mail could not be sent.";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Mail sent successfully to patient!";
            echo "\n";
        }

    }
   
}


