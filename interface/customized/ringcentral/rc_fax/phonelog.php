<?php
require_once("../../../globals.php");
require_once 'twiliophone/vendor/autoload.php';

use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// DANGER! This is insecure. See http://twil.io/secure
$sid = $GLOBALS['phone_gateway_username'];
$token = $GLOBALS['phone_gateway_password'];
$twilio = new Client($sid, $token);

$calls = $twilio->calls
                ->read([], 20);

foreach ($calls as $record) {
	$query = "select * from notification_log where smsgateway_info=? ";
    //echo "<br>".$query;
    $data = sqlFetchArray(sqlStatement($query, [$record->sid]));
    //print_r($data);
    if($data['smsgateway_info']!='')
    {
    print($data['patient_info']."--".$data['dSentDateTime']."--".$record->sid."--".$record->from."--".$record->to."--".$record->status."<br>");
    }
}
?>