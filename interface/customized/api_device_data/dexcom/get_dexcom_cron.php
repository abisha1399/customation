<?php

 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");
require_once($GLOBALS['srcdir'] . '/encounter_events.inc.php');
require_once($GLOBALS["srcdir"] . "/forms.inc");
use OpenEMR\Common\Csrf\CsrfUtils;
$client_id='uNcrPYu45wWHbEqKeBw5rLHiZbA0BO6T';
$client_secret='IARVhFEcEeqFNbWo';
$url='https://api.dexcom.com';
$dexcom_array=array();
$dexcom_data=sqlStatement("SELECT * FROM dexcom_token WHERE status=1");
$startdate = date(("Y-m-d")).'T'.date('H', strtotime(' -1 hours')).':00:00';
$end_date=date(("Y-m-d")).'T'.date('H').':00:00';
while ($results = sqlFetchArray($dexcom_data)) 
{
    array_push($dexcom_array, $results);
}
if(!empty($dexcom_array))
{   
    foreach($dexcom_array as $value){
        $token=isset($value['access_token'])?$value['access_token']:'';
        $pid=isset($value['pid'])?$value['pid']:'';
        $result1=sqlQuery("SELECT fname,lname from patient_data WHERE pid=?",array($pid));
        if($token!='')
        {
            // $startdate = date(("Y-m-d"), strtotime($date. ' - 1 days')).'T'.date('H:i:s');
            // $end_date=date(("Y-m-d")).'T'.date('H:i:s');
           
           
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
            $error = curl_error($curl);
            if ($error){
                  
                  echo 'something went wrong for '.$result1['fname'].' '.$result1['lname'].' '.$error;
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
                    echo 'glucose have no data wrong for '.$result1['fname'].' '.$result1['lname'];
                }
            }    
           
        } 
        else{
            echo 'dexcom its not conneceted '.$result1['fname'].' '.$result1['lname'];
        }

        $adss=1;
        $rm_encounter_exit=sqlQuery("SELECT * FROM form_encounter WHERE pid=? AND date_end!='NULL' AND encounter_status='open'",array($pid));
        if(empty($rm_encounter_exit))
        {
            $data_received=sqlQuery("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='dexcom_api'");
            if(!empty($data_received))
            {
                $new_encounter = generate_id();
                $code_Type ='CPT4';
                $dos=date('Y-m-d h:i:s');
                $visit_reason='';
                $facility='';
                $facility_id=3;
                $billing_facility=3;
                $visit_provider=1;
                $patient_id=$pid;
                $visit_cat=10;
                $pos_code='AMB';
                $username='admin';
                $end_date=date('Y-m-d h:i:s', strtotime($today_date. ' + 30 days'));
                $enc_date=$dos.'-'. $end_date;
                $adss=sqlInsert(
                    "INSERT INTO form_encounter SET " .
                    "date = ?, " .
                    "reason = ?, " .
                    "facility = ?, " .
                    "facility_id = ?, " .
                    "billing_facility = ?, " .
                    "provider_id = ?, " .
                    "pid = ?, " .
                    "encounter = ?," .
                    "pc_catid = ?," .
                    "date_end=?,".
                    "encounter_status=?,".
                    "pos_code = ?",
                    array($dos,$visit_reason,$facility,$facility_id,$billing_facility,$visit_provider,$pid,$new_encounter,$visit_cat,$end_date,'open',$pos_code)
                );
                addForm($new_encounter,"RPM Patient Encounter",$adss,"newpatient",$pid,"1","NOW()",$username);
            }
        }
    }
    
}
else{
    echo "No patient for Dexcom Verification";
}
//$token='eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6IjJleWZIVDlKdzZ1clVxRFBja2dSeThMOElGQSIsImtpZCI6IjJleWZIVDlKdzZ1clVxRFBja2dSeThMOElGQSJ9.eyJpc3MiOiJodHRwczovL3VhbTEuZGV4Y29tLmNvbS9pZGVudGl0eSIsImF1ZCI6Imh0dHBzOi8vdWFtMS5kZXhjb20uY29tL2lkZW50aXR5L3Jlc291cmNlcyIsImV4cCI6MTY4MDI4MjM0NSwibmJmIjoxNjgwMjc1MTQ1LCJjbGllbnRfaWQiOiJMT3g2SGZtRXR2RHVsd3MwNTczZlVWdzliemFpbTBzdCIsInNjb3BlIjpbImNhbGlicmF0aW9uIiwiZXZlbnQiLCJvZmZsaW5lX2FjY2VzcyIsImVndiIsInN0YXRpc3RpY3MiLCJkZXZpY2UiXSwic3ViIjoiNjAyM2YzZjYtY2I3NS00N2VkLTlhZDItNmRmNTk1ZWFhNDliIiwiYXV0aF90aW1lIjoxNjgwMjc1MTQzLCJpZHAiOiJpZHNydiIsImNvdW50cnlfY29kZSI6IlVTIiwibWlzc2luZ19maWVsZHNfY291bnQiOiIwIiwiaXNfY29uc2VudF9yZXF1aXJlZCI6ImZhbHNlIiwiY25zdCI6IjIiLCJjbnN0X2NsYXJpdHkiOiIyIiwiY25zdF90ZWNoc3VwcG9ydCI6IjIiLCJqdGkiOiJhYWViNjc5YzRhOGFjOTgxYzRkZWMwZmY1MzljODEyNiIsImFtciI6WyJwYXNzd29yZCJdfQ.OUQg2gPum6VllQERJ5OhL42_lDe8o39lHv0VMpP3MIZDDhFwbmdL0S4QFVbLox38j0zsghFqjKmArm7AXCYPjbSWGcDmWlweuz3-33RaOtHzhNmGcaMRU9nep46wYj6ydOHRBtiaQR1HdsEOnpSaITu1Rn0R-z394N2PJBGUrjlI3EzySi6ypjOYCdBlOOmSkkQ15-qHimaIkrILXAO5r1iX1D-DR7dWIKrVQXGcV3eBp08lTg_jB0s0Extcbq3gEg2SDnyaKZAXTu3uYMARYrciyTBUN7PJl9B9lgb5gee67x8cI3qAg9Wbs8AyqVp7veUs8CaVWSI68uqXBTbRMg';

  
?>