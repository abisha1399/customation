<?php

$ignoreAuth = 1;
include_once("../../globals.php");

require_once("rc_fax/libs/controller/ClientAppController.php");

use OpenEMR\Core\Header;

// kick off app endpoints controller
$clientApp = new clientController();

$pid=isset($_GET['pid'])? $_GET['pid']:'';
$message=isset($_POST['message'])? $_POST['message']:'';
//echo $message;die();


if($pid!=""){
$query= sqlQuery("SELECT * FROM patient_data where pid=$pid");

$name=$query['fname'].' '.$query['lname'];
$phone=isset($query['phone_home'])?$query['phone_home']:'';
//$phone='+15712505626';
//$phone='+14046001575';
//echo $message;exit();
$message=str_replace("<br>","\n",$message);
if($phone!=''&&$message!=''){
$response=$clientApp->sendSMS($phone,'',$message,'+14046001575');

    echo $response;exit();
    }
    else{
        $response='nodata';
        echo $response;exit();
    }
}


?>
