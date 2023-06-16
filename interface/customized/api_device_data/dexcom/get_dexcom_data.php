<?php

 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");
$pid=isset($_SESSION['pid'])?$_SESSION['pid']:'';
if(isset($_GET['pid'])){
    $pid=isset($_GET['pid'])?$_GET['pid']:'';
}

//$url='https://sandbox-api.dexcom.com';
$client_id='uNcrPYu45wWHbEqKeBw5rLHiZbA0BO6T';
$client_secret='IARVhFEcEeqFNbWo';
$url='https://api.dexcom.com';
$dexcom_data=sqlQuery("SELECT * FROM dexcom_token WHERE pid=? AND status=1",array($pid));
$token=isset($dexcom_data['access_token'])?$dexcom_data['access_token']:'';
//$token='eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6IjJleWZIVDlKdzZ1clVxRFBja2dSeThMOElGQSIsImtpZCI6IjJleWZIVDlKdzZ1clVxRFBja2dSeThMOElGQSJ9.eyJpc3MiOiJodHRwczovL3VhbTEuZGV4Y29tLmNvbS9pZGVudGl0eSIsImF1ZCI6Imh0dHBzOi8vdWFtMS5kZXhjb20uY29tL2lkZW50aXR5L3Jlc291cmNlcyIsImV4cCI6MTY4MDI4MjM0NSwibmJmIjoxNjgwMjc1MTQ1LCJjbGllbnRfaWQiOiJMT3g2SGZtRXR2RHVsd3MwNTczZlVWdzliemFpbTBzdCIsInNjb3BlIjpbImNhbGlicmF0aW9uIiwiZXZlbnQiLCJvZmZsaW5lX2FjY2VzcyIsImVndiIsInN0YXRpc3RpY3MiLCJkZXZpY2UiXSwic3ViIjoiNjAyM2YzZjYtY2I3NS00N2VkLTlhZDItNmRmNTk1ZWFhNDliIiwiYXV0aF90aW1lIjoxNjgwMjc1MTQzLCJpZHAiOiJpZHNydiIsImNvdW50cnlfY29kZSI6IlVTIiwibWlzc2luZ19maWVsZHNfY291bnQiOiIwIiwiaXNfY29uc2VudF9yZXF1aXJlZCI6ImZhbHNlIiwiY25zdCI6IjIiLCJjbnN0X2NsYXJpdHkiOiIyIiwiY25zdF90ZWNoc3VwcG9ydCI6IjIiLCJqdGkiOiJhYWViNjc5YzRhOGFjOTgxYzRkZWMwZmY1MzljODEyNiIsImFtciI6WyJwYXNzd29yZCJdfQ.OUQg2gPum6VllQERJ5OhL42_lDe8o39lHv0VMpP3MIZDDhFwbmdL0S4QFVbLox38j0zsghFqjKmArm7AXCYPjbSWGcDmWlweuz3-33RaOtHzhNmGcaMRU9nep46wYj6ydOHRBtiaQR1HdsEOnpSaITu1Rn0R-z394N2PJBGUrjlI3EzySi6ypjOYCdBlOOmSkkQ15-qHimaIkrILXAO5r1iX1D-DR7dWIKrVQXGcV3eBp08lTg_jB0s0Extcbq3gEg2SDnyaKZAXTu3uYMARYrciyTBUN7PJl9B9lgb5gee67x8cI3qAg9Wbs8AyqVp7veUs8CaVWSI68uqXBTbRMg';
if($token!='')
{
    // $startdate = date(("Y-m-d"), strtotime($date. ' - 1 days')).'T'.date('H:i:s');
    // $end_date=date(("Y-m-d")).'T'.date('H:i:s');
    $startdate = date(("Y-m-d")).'T'.date('H:i:s', strtotime(' -1 hours'));
    $end_date=date(("Y-m-d")).'T'.date('H:i:s');
   
    $query = array(
        "startDate" => "".$startdate."",
        "endDate" => "".$end_date.""
    );
    
      
    $curl = curl_init();
    
    curl_setopt_array($curl, [
      CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $token"
      ],
      CURLOPT_URL => "".$url."/v3/users/self/egvs?" . http_build_query($query),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "GET",
    ]);
      
    $response = curl_exec($curl);
    
    $dexcom_result=json_decode($response,TRUE);
    //echo'<pre>';print_r($dexcom_result);exit();
    $error = curl_error($curl);
    if ($error){
          echo "something went wrong" . $error;
    } 
     else
    {
        $dexcom_glucose_data=isset($dexcom_result['records'])?$dexcom_result['records']:array();
        $user_id=$dexcom_result['userId'];
        if( $user_id !=""){
                sqlStatement("UPDATE dexcom_token SET user_id='".$user_id."' WHERE pid=".$pid."");
        }
        
         $reading_type=$dexcom_result['recordType'];
        
        if(!empty($dexcom_glucose_data))
        {
            foreach($dexcom_glucose_data as $value)
            {
                //date_default_timezone_set('US/Eastern');
                $from='UTC';
                $to='America/New_York';
                $format='Y-m-d H:i:s';
                $format1='Y-m-d';
                $date=date($value['displayTime']);// UTC time
                date_default_timezone_set($from);
                $newDatetime = strtotime($date);
                date_default_timezone_set($to);
                $reading_time = date($format, $newDatetime);                
                $reading_date = date($format1, $newDatetime);
                date_default_timezone_set('UTC');
                //$reading_time=date('Y-m-d H:i:s',strtotime($value['displayTime']));
                $reading_data_exit=sqlQuery("SELECT * FROM api_vitals_data WHERE api_type='dexcom_api' AND pid=? AND reading_time=?",array($pid,$reading_time));
                //$reading_date=date('Y-m-d',strtotime($value['displayTime']));
                $dexcom_glucose=isset($value['value'])?$value['value']:'';
                $unit=isset($value['unit'])?$value['unit']:'';
               // $reading_type='egvs';
                if($unit=="mmol/L"){
                    $dexcom_glucose=18*($dexcom_glucose);
                }
                $exitid=isset($reading_data_exit['id'])?$reading_data_exit['id']:'';
                if(empty($exitid))
                {
                    sqlStatement("INSERT INTO api_vitals_data(reading_time,blood_glucose,api_type,pid,reading_date,reading_type) VALUES (?,?,?,?,?,?)",array($reading_time,round($dexcom_glucose),'dexcom_api',$pid,$reading_date,$reading_type));
                    
                } 
            }
            echo $response;
            
        }
        else{
            echo 'glucose have no data';
        }
    }    
   
} 
else{
    echo "dexcom its not conneceted";
}
  
?>