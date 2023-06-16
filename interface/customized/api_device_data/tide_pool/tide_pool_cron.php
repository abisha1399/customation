<?php

 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");
require_once("$srcdir/api.inc");
require_once($GLOBALS['srcdir'] . '/encounter_events.inc.php');
require_once("$srcdir/forms.inc");
use OpenEMR\Common\Csrf\CsrfUtils;
$patient_data_tide_pull=array();
$end_date= date("Y-m-d").'T'.date('H') . ':00:00Z' ;                   
$startdate = date(("Y-m-d")).'T'.date('H', strtotime(' -1 hours')).':00:00Z'; 
$patient_data_tide_pull1=sqlStatement("SELECT tidepull_email,tidepull_password,pid,CONCAT(fname, ' ', lname) as pat_name FROM patient_data WHERE  tidepull_email IS NOT NULL and tidepull_password IS NOT NULL ");
while ($results = sqlFetchArray($patient_data_tide_pull1)) { 
    array_push($patient_data_tide_pull, $results);   
}
if(!empty($patient_data_tide_pull)){
    foreach ($patient_data_tide_pull as $tide_value){
     
         $email=isset($tide_value['tidepull_email'])?$tide_value['tidepull_email']:'';
         $password=isset($tide_value['tidepull_password'])?$tide_value['tidepull_password']:'';
         $patient_name=$tide_value['pat_name'];
         $pid=$tide_value['pid'];
         if($email!='' && $password!=''){
            $auth=base64_encode(trim($email).':'.trim($password));     
            $a='YWJpc2hhQGNhcG1pbmRzLmNvbTpQYXNzd29yZDE2MTNA';
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.tidepool.org/auth/login',
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HEADER =>1,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,        
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                   'content-type: application/json',
                    'Authorization: Basic '.$auth.''
                    
                ),
            ));   
            $response = curl_exec($curl);    
            $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            
            curl_close($curl);
            $my_body_data = json_decode($body,true);  
            if(isset($my_body_data['emailVerified'])&&$my_body_data['emailVerified']=='true'){
                $hedaer_response=explode('x-tidepool-session-token: ',$header);
                $hedaer_response=explode('date:',$hedaer_response[1]);
                $token=isset($hedaer_response[0])?$hedaer_response[0]:'';    
                if(!empty($my_body_data))
                {
                    $user_id=$my_body_data['userid'];            
                }
                if($user_id!='' && $token!='')
                {
                  
                    $ch = curl_init();
                    $token1=trim($token);
                    curl_setopt($ch, CURLOPT_URL, 'https://api.tidepool.org/data/'.$user_id.'?startDate='.$startdate.'&endDate='.$end_date.'');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            
                    $headers = array();
            
                    $headers[] = 'Cache-Control: no-cache';
                    $headers[] = 'Content-Type: application/json';
                    $headers[]  = 'X-Tidepool-Session-Token:'.$token1.'';
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
                    $result = curl_exec($ch);
                    curl_close($ch);                    
                    $res=json_decode($result, true); 
                      
                    if(!empty($res))
                    {
                        foreach($res as $key=>$value)
                        {
                            if(isset($res[$key]['value'])&&$res[$key]['value']!='')
                            {
                                
                                date_default_timezone_set('US/Eastern');
                                $reading_time=date('Y-m-d H:i:s',strtotime($value['time']));
                                $reading_data_exit=sqlQuery("SELECT * FROM api_vitals_data WHERE api_type='tidepull_api' AND pid=? AND reading_time=?",array($pid,$reading_time));
                                $reading_date=date('Y-m-d',strtotime($value['time']));
                                $tidepull_glucose=isset($value['value'])?$value['value']:'';
                                $reading_type=isset($value['type'])?$value['type']:'';                                
                                if(isset($value['units'])&&$value['units']=='mmol/L')
                                {
                                    $tidepull_glucose=18*($tidepull_glucose);
                                }
                                $exitid=isset($reading_data_exit['id'])?$reading_data_exit['id']:'';
                                if(empty($exitid))
                                {
                                    sqlStatement("INSERT INTO api_vitals_data(reading_time,blood_glucose,api_type,pid,reading_date,reading_type) VALUES (?,?,?,?,?,?)",array($reading_time,round($tidepull_glucose),'tidepull_api',$pid,$reading_date,$reading_type));
                                    //$id=$reading_data_exit['id'];
                                    //sqlStatement("UPDATE api_vitals_data SET reading_time=?,tidepull_glucose=?,api_type=?,pid=?,reading_date=?,reading_type=? WHERE id=?",array($reading_time,round($tidepull_glucose),'tidepull_api',$pid,$reading_date,$reading_type,$id));
                                }                        
                            
                            }   
                            
                        }
                        echo ' Result for '.$patient_name.':'.$result;
                    }
                    else{
                        echo ' No data found for '.$patient_name;
                    }
                    
                }
            }
            else{
                echo $my_body_data['reason'].' for '.$patient_name;
            }  
            
        }
        else{
            echo ' Tidepull not connected for '.$patient_name;
        }
        $rm_encounter_exit=sqlQuery("SELECT * FROM form_encounter WHERE pid=? AND date_end!='NULL' AND encounter_status='open'",array($pid));
        if(empty($rm_encounter_exit))
        {
            $data_received=sqlQuery("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='tidepull_api'");
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
                echo '<br> RPM encounter create for '.$patient_name.'';
            }
                            
                            
        }
        echo "*************************************************<br>";
    }
}
else{
    echo " No patient have tidepool connected";
}

exit();
    
?>