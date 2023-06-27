<?php

 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");
$pid=$_SESSION['pid'];
if(isset($_GET['pid'])){
    $pid=isset($_GET['pid'])?$_GET['pid']:'';
}
if(isset($GLOBALS['enable_tidepool_api'])&&$GLOBALS['enable_tidepool_api']==true)
{
$result='';
$patient_data=sqlQuery("SELECT tidepull_email,pid,tidepull_password FROM patient_data WHERE pid=?",array($pid));
$email=isset($patient_data['tidepull_email'])?$patient_data['tidepull_email']:'';
$password=isset($patient_data['tidepull_password'])?$patient_data['tidepull_password']:'';
$user_id='';
$token='';
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
            
            
            $date= date("Y-m-d").'T'.date('H:i:s') . 'Z' ;
            //$startdate = date(("Y-m-d"), strtotime($date. ' - 1 days')).'T'.date('H:i:s') . 'Z';
            $startdate = date(("Y-m-d")).'T'.date('H:i:s', strtotime(' -1 hours')).'Z';
            $ch = curl_init();
            $token1=trim($token);
            curl_setopt($ch, CURLOPT_URL, 'https://api.tidepool.org/data/'.$user_id.'?startDate='.$startdate.'&endDate='.$date.'');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
            $headers = array();
    
            $headers[] = 'Cache-Control: no-cache';
            $headers[] = 'Content-Type: application/json';
            $headers[]  = 'X-Tidepool-Session-Token:'.$token1.'';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
            $result = curl_exec($ch);
            curl_close($ch);
            // $pid=1;
            $res=json_decode($result, true);    
            if(!empty($res))
            {
                foreach($res as $key=>$value)
                {
                    if(isset($res[$key]['value'])&&$res[$key]['value']!='')
                    {
                        //echo '<pre>';print_r($value);
                        date_default_timezone_set('US/Eastern');
                        $reading_time=date('Y-m-d H:i:s',strtotime($value['time']));
                        $reading_data_exit=sqlQuery("SELECT * FROM api_vitals_data WHERE api_type='tidepull_api' AND pid=? AND reading_time=?",array($pid,$reading_time));
                        $reading_date=date('Y-m-d',strtotime($value['time']));
                        $tidepull_glucose=isset($value['value'])?$value['value']:'';
                        $reading_type=isset($value['type'])?$value['type']:'';
                        // units": "mmol/L",
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
                echo $result;
            }
            else{
                echo 'Patient have no data';
            }
            
        }
    }
    else{
        echo $my_body_data['reason'];
    }  
    
}
else{
    echo 'user have no emaiid or password';
}


if(isset($GLOBALS['enable_rpm'])&&$GLOBALS['enable_rpm']==true)
{

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
    }
    echo $adss;
    
}
exit();
}else{
    echo "RPM not enable please contact your facility";
}  
}else{
    echo 'Tide Pool Api is disable for you please contact with your clinic';
}
?>