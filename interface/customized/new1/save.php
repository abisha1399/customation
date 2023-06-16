<?php
/**
 * assessment_intake save.php.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */


require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

//$src = __DIR__."/../patient_file/encounter/PHPMailerAutoload.php";



if ($encounter == "") {
    $encounter = date("Ymd");
}

if (isset($_GET["mode"])&&$_GET["mode"] == "new")
{

   
   

    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $street = $_POST['addr'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $phno = $_POST['phone'];
    $email = $_POST['email'];
    $ss = $_POST['ssn'];
    $gender = $_POST['sex'];
    $m_status = $_POST['marital'];
    $race = $_POST['race'];
    $g_name1 = $_POST['cont1'];
    $g_rel1 = $_POST['rel1'];
    $g_phno1 = $_POST['tel1'];
    $g_name2 = $_POST['cont2'];
    $g_rel2 = $_POST['rel2'];
    $g_phno2 = $_POST['tel2'];
    $ptype = "primary";
    $stype = "secondary";
    $ttype = "tertiary";
    $plan_name = $_POST['ins_car'];
    $s_phno = $_POST['ins_cont'];
    $s_name = $_POST['ins_subscriber'];
    $s_dob = $_POST['ins_dob'];
    $s_rel = $_POST['ins_rel'];
    $insure_tel = $_POST['ins_tel'];
    $insure_id = $_POST['ins_id'];
    $clnt_id = $_POST['ins_cliid'];
    $gid = $_POST['ins_grp'];
    $sign = $_POST['ins_sign'];
    $sets = "pid=?,pubpid=?,title=?,fname=?,mname=?,lname=?,DOB=?,street=?,city=?,state=?,phone_home=?,email=?,ss=?,sex=?,status=?,race=?,guardians1name=?,guardian1relationship=?,guardian1phone=?,guardian2name=?,guardian2relationship=?,guardian2phone =?";
    $set = "type=?,plan_name=?,subscriber_phone=?,subscriber_fname=?,subscriber_DOB=?,subscriber_relationship=?,group_number=?,pid=?,insured_pid=?,insured_tel=?,client_id=?,signature=?";
    $set_data = "type=?,pid=?";    
    $pid = sqlquery("select COUNT(pid) FROM `patient_data`");
    $pid = $pid['COUNT(pid)']+1;
    $newid = sqlInsert(
        "INSERT INTO patient_data SET " . $sets,
        [
            $pid,
            $pid,
            $title,
            $fname,
            $mname,
            $lname,
            $dob,
            $street,
            $city,
            $state,
            $phno,
            $email,
            $ss,
            $gender,
            $m_status,
            $race,
            $g_name1,
            $g_rel1,
            $g_phno1,
            $g_name2,
            $g_rel2,
            $g_phno2
        ]
    );
    //$newid_res = mysql_affected_rows($newid);
  
    $inc1 = sqlInsert(
       $data = "INSERT INTO insurance_data SET " . $set,
        [
            $ptype,
            $plan_name,
            $s_phno,
            $s_name,
            $s_dob,
            $s_rel,
            $gid,
            $pid,
            $insure_pid,
            $insure_tel,
            $clnt_id,
            $sign
        ]
    );

    $inc2 = sqlInsert(
        $data = "INSERT INTO insurance_data SET " . $set_data,
         [
             $stype,
             $pid
             ]
     );
    $inc3 = sqlInsert($data = "INSERT INTO insurance_data SET " . $set_data,
                 [
                     $ttype,
                     $pid
                ]
     );
    
    
    $name = $fname." ".$mname." ".$lname;
    
//if($newid_res == 1){
   require_once( '../PHPMailerAutoload1.php');
   define('EMAIL','info@capminds.com');
   define('PASS','info12345');
   $to = $email;
   $vBody ="Hi <b>".$name.",</b>";   
   $http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://" . $_SERVER['HTTP_HOST'];
   $url=$http.$GLOBALS['webroot'].'/interface/customized/intake_patient/updatepatient.php?pid='.$pid .'';
   $mail = new PHPMailer;
   $email_subject = 'Patient Intake Form';
   $email_sender = 'Capminds';
   $mail->AddAttachment($GLOBALS['OE_SITE_DIR'].'/documents/cnt/Client_Rights.pdf', $name = 'Client_Rights',  $encoding = 'base64', $type = 'application/pdf');
   $mail->AddAttachment($GLOBALS['OE_SITE_DIR'].'/documents/cnt/Notice_of_Privacy.pdf', $name = 'Notice_of_Privacy',  $encoding = 'base64', $type = 'application/pdf');
   $mail->AddAttachment($GLOBALS['OE_SITE_DIR'].'/documents/cnt/Patient_Orientation_Manual.pdf', $name = 'Notice_of_Privacy',  $encoding = 'base64', $type = 'application/pdf');
  
   $mail->isSMTP();                                      // Set mailer to use SMTP
   $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
   $mail->SMTPAuth = true; 
   $mail->Username = EMAIL;                 // SMTP username
   $mail->Password = PASS;                           // SMTP password
   $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
   $mail->Port = 587; 
   $mail->AddReplyTo(EMAIL, 'Capminds');
   $mail->SetFrom(EMAIL, 'Capminds');
   $mail->AddAddress($to);
   $mail->Subject = $email_subject;
   $mail->MsgHTML("<html><body><div class='wrapper'><div>" . $vBody . "</div><div><p> please fill the remaining data using this url</p></div><div><a href='".$url."'>".$url."</a></div><br><p>Thanks & Regards,<br><b>Capminds</b></p></body></html>");
   $mail->IsHTML(true);
   
   if ($mail->Send())
   {
    
     ?>
     <script>
         <?php
               //echo "window.location='$rootdir/patient_file/encounter/load_form.php?formname=patient_info_pkt";
           echo "window.location='$rootdir/patient_file/summary/demographics.php?" .
          "set_pid=" . attr_url($pid) . "&is_new=1';\n";    
          "set_pid=" . attr_url($pid)."';\n";
  
        ?>
     window.parent.left_nav.loadFrame('ens', window.name, 'customized/patient_info_pkt/new.php');
        </script>
        <?php
        exit();
   }
   else
   {
   
     $email_status = $mail->ErrorInfo;
     echo "Cound not send the message to " . text($to) . ".\nError: " . text( $email_status) . "\n";
     $mstatus = false;
   }

}

//formHeader();