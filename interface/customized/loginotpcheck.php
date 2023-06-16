<?php
session_start();
$site=isset($_GET['site'])?$_GET['site']:'default';
if(isset($_POST['verify']))
{
$otp1=$_POST['otp'];


if ($otp1==$_SESSION["otp"])
  	 {
		$un=$_POST['authname'];
	 	header("location:reset_login.php?site=$site&name=$un");
  	 }
  	 else
  	 {
		$un=$_POST['authname'];
  	 $error1="<p align='center' class='correct'>INVALID OTP</p>";
	 	header("location:loginotp.php?site=$site&message=$error1&name=$un");
  	 }
}
else
{
echo "some error";
}
?>
