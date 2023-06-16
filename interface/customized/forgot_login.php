<?php

session_start();
$ignoreAuth = 1;
require_once("../globals.php");
use OpenEMR\Common\Crypto\CryptoGen;

$site=isset($_GET['site'])?$_GET['site']:'default';
//$org_name=$GLOBALS['patient_reminder_sender_name'];
$auth_email=isset($GLOBALS['SMTP_USER'])?$GLOBALS['SMTP_USER']:'refreshhealthehr@gmail.com';
$cryptoGen = new CryptoGen();
$auth_pass=isset($GLOBALS['SMTP_PASS'])?$GLOBALS['SMTP_PASS']:'adynjudkykinmwcm';
$host=isset($GLOBALS['SMTP_HOST'])?$GLOBALS['SMTP_HOST']:'smtp.gmail.com';
    $port=isset($GLOBALS['SMTP_PORT'])?$GLOBALS['SMTP_PORT']:'587';
    $secure=isset($GLOBALS['SMTP Security Protocol'])?$GLOBALS['SMTP Security Protocol']:'tls';
	$org_name='Refresh Health';
	if($site =='default'){
		$org_name=isset($GLOBALS['patient_reminder_sender_name'])?$GLOBALS['patient_reminder_sender_name']:'RefreshHealth';
	}
	else if($site=='brevardim'){
		$org_name='BrevardIM';
	}
	else{
		$org_name=ucfirst($site);
	}
	
// if($site =='default'){
// 	$org_name=$GLOBALS['patient_reminder_sender_name'];
// }else if($site =='concierge'){
// 	$org_name="Concierge";
// }else if($site =='brevard'){
// 	$org_name="Brevard";
// }

/*$con= new mysqli("localhost","root","root","openemr502");

	if($con->connect_error)
	{
		echo $con->connect_error;
		die("sorry Database error");
	}*/
if(isset($_POST['forgot']))
{
$name=$_POST['forname'];
$email=$_POST['mail'];

$sql="SELECT * from users_secure as pa inner join users as p on p.id=pa.id where pa.username=?";
$row = sqlQuery($sql,array($name));
if ($email==$row['email'])
  	   	 {

		$otp = rand(000000,999999);
		$_SESSION["otp"] = $otp;

		require 'PHPMailerAutoload1.php';

		define('EMAIL',$auth_email);
		define('PASS',$cryptoGen->decryptStandard($auth_pass));


$mail = new PHPMailer;

//$mail->SMTPDebug = 3;
// Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $host;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = $secure;                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $port;                                    // TCP port to connect to

$mail->setFrom(EMAIL,$org_name);
$mail->addAddress($_POST['mail']);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo(EMAIL);
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$message="Dear ".ucfirst($name).",<br><br>
We received a request to reset your password for the ".$org_name.".<br> 
Use this verification code <b>".$otp."</b> to reset your password <br><br>

If you have any questions or concerns, please contact us at<br>
support@refresh.health / 404-600-1575.<br><br>

Best regards,<br>

".$org_name."";
$mail->Subject = 'Verification code';
// $mail->Body    ="Hi"." ". $name.", "."<br>"."<br>".
//  "Your account recovery code is"."<b> ".$otp ."</b>". "<br> "."<br>".
// "Regards,"."<br>"
// .$org_name;
$mail->Body=$message;
$mail->SMTPDebug;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {

    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
else {
    $un=$_POST['forname'];
	header("location:loginotp.php?site=$site&name=$un");
}
}
else
  	 {
  	 $error1="<p align='center' class='correct'>INVALID USERNAME OR EMAIL</p>";
	 	header("location:verify_login.php?site=$site&message=$error1");
  	 }
}
else
{
echo "server error";
}
?>
