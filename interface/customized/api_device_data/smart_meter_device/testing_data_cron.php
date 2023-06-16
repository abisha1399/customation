
<?php
$ignoreAuth = true;
$sessionAllowWrite = true;
require_once("../../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
use OpenEMR\Common\Csrf\CsrfUtils;
if(isset($_GET['smart_meter']))
{
     $end_date= date("Y-m-d").'T'.date('H').':00:00';
    // $startdate = date(("Y-m-d")).'T'.date('H', strtotime(' -3 hours')).':00:00';
    $startdate='2023-05-01T00:00:00';
    //print_r($startdate);die;
    $query = sqlStatement("SELECT * FROM `smart_device_numbers` WHERE serial_number IS NOT NULL and serial_number !='' Group by pid");
    while ($results = sqlFetchArray($query)) {
    $pid = $results['pid'];    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.iglucose.com/readings/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $datas=[];
    $patind_dat =sqlStatement("SELECT * FROM smart_device_numbers WHERE pid='".$pid."'");
    while($row=sqlFetchArray($patind_dat)){
        if($row['serial_number']!=''){
            $datas[]=$row['serial_number'];
        }    
        
    }
    

    $data=array(  
        "api_key"       => "1A3C7F30-7773-4708-89E8-98A3A472AC57-1580486333",    
        "device_ids"    => $datas,
        "date_start"    => "".$startdate."",
        "date_end"      => "".$end_date."",
        "reading_type"  => ["blood_glucose", "blood_pressure", "weight", "pulse_ox"]
    );

    $data=json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);
    $data= json_decode($result,TRUE);
    $iglucose_data = $data['readings'];
    
    $cron_status=isset($data['status']['status_code'])&&$data['status']['status_code']==200&&!empty($iglucose_data)?'success':'error';
    $log_id=sqlInsert("INSERT INTO smart_meter_cron_log(pid,cron_message,start_date,end_date,cron_status) VALUES (?,?,?,?,?)",array($pid,$result,$startdate,$end_date,$cron_status));
    if(!empty($iglucose_data)){
        $insert_id_array=[];
        foreach($iglucose_data as $iglucose_val){
                $from='UTC';
                $to='America/New_York';
                $format='Y-m-d H:i:s';
                $format1='Y-m-d';
                $date=date($iglucose_val['date_recorded']);// UTC time
                date_default_timezone_set($from);
                $newDatetime = strtotime($date);
                date_default_timezone_set($to);
                $reading_time = date($format, $newDatetime);
                $reading_date = date($format1, $newDatetime);
                date_default_timezone_set('UTC');            
    
            //$reading_time       = date('Y-m-d H:i:s', strtotime($iglucose_val['date_recorded']));
            // $reading_date       = date('Y-m-d', strtotime($iglucose_val['date_recorded']));
            $reading_type       = $iglucose_val['reading_type'];
            $pulse              = NULL;
            $systolic           =NULL;
            $diastolic          =NULL;
            $blood_glucose_mgdl=NULL;
            $blood_glucose_mmol=NULL;
            if(isset($iglucose_val['pulse_bpm'])){
                $pulse=$iglucose_val['pulse_bpm'];
            }
            if(isset($iglucose_val['systolic_mmhg'])){
                $systolic=$iglucose_val['systolic_mmhg'];
            }
            if(isset($iglucose_val['diastolic_mmhg'])){
                $diastolic=$iglucose_val['diastolic_mmhg'];
            }
            if(isset($iglucose_val['blood_glucose_mgdl'])){
                $blood_glucose_mgdl=$iglucose_val['blood_glucose_mgdl'];
            }
            if(isset($iglucose_val['blood_glucose_mmol'])){
                $blood_glucose_mmol=$iglucose_val['blood_glucose_mmol'];
            }
            $sql_date_reading   = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='".$pid."' AND reading_type='".$reading_type."' AND api_type='smart_meter_api'");
            //$sql_date_reading   = sqlQuery("SELECT * FROM smart_meter_data WHERE reading_time='".$reading_time."' AND pid='".$pid."' AND reading_type='".$reading_type."'");
            $id=isset($sql_date_reading['id'])?$sql_date_reading['id']:'';
            if(!empty($id))
            {
            
            $sql_update= "UPDATE api_vitals_data SET reading_time=?,pulse=?,systolic=?,diastolic=?,blood_glucose_mmol=?,blood_glucose=?,reading_date=?,pid=?,reading_type=? where id=?";
            sqlStatement($sql_update, array($reading_time,$pulse,$systolic,$diastolic,$blood_glucose_mmol,$blood_glucose_mgdl,$reading_date,$pid,$reading_type,$id));
            $insert_id_array[]=$id;
            }
            else{
                
                $insert_id=sqlInsert("INSERT INTO api_vitals_data(reading_time,pulse,systolic,diastolic,blood_glucose_mmol,blood_glucose,reading_date,pid,reading_type,api_type) VALUES (?,?,?,?,?,?,?,?,?,?)",array($reading_time,$pulse,$systolic,$diastolic,$blood_glucose_mmol,$blood_glucose_mgdl,$reading_date,$pid,$reading_type,'smart_meter_api'));
                if($insert_id){
                    $insert_id_array[]=$insert_id;
                }
            }
            
            
        
        }
        $insert_id_status=json_encode($insert_id_array);
        sqlStatement("UPDATE smart_meter_cron_log SET insert_status='".$insert_id_status."' WHERE id=".$log_id."");
        echo 'data for patient id '.$pid.'<pre>';print_r($iglucose_data).'<br>';
    }
    else{
        echo "No data for patient id ".$pid."<br>";
    }
    $pid=$pid;
    $adss=1;
    $rm_encounter_exit=sqlQuery("SELECT * FROM form_encounter WHERE pid=? AND date_end!='NULL' AND encounter_status='open'",array($pid));
    if(empty($rm_encounter_exit))
    {
        $data_received=sqlQuery("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='smart_meter_api'");
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
                $enc_end_date=date('Y-m-d h:i:s', strtotime($today_date. ' + 30 days'));
                $enc_date=$dos.'-'. $enc_end_date;
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
                    array($dos,$visit_reason,$facility,$facility_id,$billing_facility,$visit_provider,$pid,$new_encounter,$visit_cat,$enc_end_date,'open',$pos_code)
                );
                addForm($new_encounter,"RPM Patient Encounter",$adss,"newpatient",$pid,"1","NOW()",$username);
        }
        echo $adss;
        
    }
    }
}
if(isset($_GET['dexcom']))
{
    
    $client_id='uNcrPYu45wWHbEqKeBw5rLHiZbA0BO6T';
    $client_secret='IARVhFEcEeqFNbWo';
    $url='https://api.dexcom.com';
    $dexcom_array=array();
    $dexcom_data=sqlStatement("SELECT * FROM dexcom_token WHERE status=1");
    //$startdate = date(("Y-m-d")).'T'.date('H', strtotime(' -1 hours')).':00:00';
    $startdate='2023-05-01T00:00:00';
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


}
if(isset($_GET['tidepool']))
{

    $patient_data_tide_pull=array();
    $end_date= date("Y-m-d").'T'.date('H') . ':00:00Z' ;                   
    $startdate = date(("Y-m-d")).'T'.date('H', strtotime(' -1 hours')).':00:00Z'; 
    $startdate='2023-05-01T00:00:00Z';
    $patient_data_tide_pull1=sqlStatement("SELECT tidepull_email,tidepull_password,pid,fname,lname FROM patient_data WHERE  tidepull_email IS NOT NULL and tidepull_password IS NOT NULL ");
    while ($results = sqlFetchArray($patient_data_tide_pull1)) { 
        array_push($patient_data_tide_pull, $results);   
    }
    if(!empty($patient_data_tide_pull)){
        foreach ($patient_data_tide_pull as $tide_value){
         
             $email=isset($tide_value['tidepull_email'])?$tide_value['tidepull_email']:'';
             $password=isset($tide_value['tidepull_password'])?$tide_value['tidepull_password']:'';
             $patient_name=$tide_value['fname'].' '.$tide_value['lname'];
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
        }
    }
    else{
        echo " No patient have tidepool connected";
    }
}
if(isset($_GET['terra']))
{

    $terra_user_array = array();
    $terra_googlefit_array = array();
    $query_terra_user = sqlStatement("SELECT pid FROM  terra_user  WHERE  status=? GROUP BY pid", array(1));
    while ($results = sqlFetchArray($query_terra_user)) {
      array_push($terra_user_array, $results['pid']);
    }
    $query_terra_googlefit = sqlStatement("SELECT pid FROM  terra_googlefit  WHERE  status=? GROUP BY pid", array(1));
    while ($results = sqlFetchArray($query_terra_googlefit)) {
      array_push($terra_googlefit_array, $results['pid']);
    }
    
    $array_pid = array_unique(array_merge($terra_user_array, $terra_googlefit_array));
    
    foreach ($array_pid as $pid_value)
    {
      //echo $pid_value;
      $pid=$pid_value;
      $result = sqlQuery("SELECT * FROM  terra_user  WHERE  pid=? AND status=? ORDER BY id DESC LIMIT 1", array($pid,1));
      $result1 = sqlQuery("SELECT * FROM  terra_googlefit  WHERE  pid=? AND status=? ORDER BY id DESC LIMIT 1", array($pid,1));
      $user_id=isset($result['user_id'])?$result['user_id']:'';
      $user_id1=isset($result1['user_id'])?$result1['user_id']:'';
    
      if(!empty($user_id)){
        $today_date =  date('Y-m-d');
        $startdate    = date('Y-m-d', strtotime($today_date. ' - 1 days'));
        $startdate='2023-05-01';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tryterra.co/v2/body?user_id='.$user_id.'&start_date='.$startdate.'&end_date='.$today_date.'&to_webhook=false&with_samples=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Accept: application/json',
          'dev-id: refresh-health-dev-4kHfmQNvOw',
          'x-api-key: c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1'
        ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        $my_array_data = json_decode($response,true);
    
      if($my_array_data['status']=='success'){
          $datas= $my_array_data['data'];
    
          for($i=0;$i<=count($datas);$i++)
          {
            $glucose_data=$datas[$i]['glucose_data']['blood_glucose_samples'];
            if(!empty($glucose_data)){
              foreach($glucose_data as $key=>$values)
              {
    
                  //$reading_time       = date('Y-m-d H:i:s', strtotime($values['timestamp']));
                  $from='UTC';
                  $to='America/New_York';
                  $format='Y-m-d H:i:s';
                  $format1='Y-m-d';
                  $date=date($values['timestamp']);// UTC time
                  date_default_timezone_set($from);
                  $newDatetime = strtotime($date);
                  date_default_timezone_set($to);
                  $reading_time = date($format, $newDatetime);
                  $reading_date = date($format1, $newDatetime);
                  date_default_timezone_set('UTC');   
                // $reading_date       = date('Y-m-d', strtotime($values['timestamp']));
                  $blood_glucose      = $values['blood_glucose_mg_per_dL'];
                  $sql_reading        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='Terra_Api'");
                  $id=isset($sql_reading['id'])?$sql_reading['id']:'';
                  if(!empty($id))
                  {
                  $sql_update         = "UPDATE api_vitals_data SET reading_time=?,blood_glucose=?,api_type=?,pid=?,reading_date=? where id=?";
                  sqlStatement($sql_update, array($reading_time,$blood_glucose,'Terra_Api',$pid,$reading_date,$id));
    
                  }
                  else{
                      sqlStatement("INSERT INTO api_vitals_data(reading_time,blood_glucose,api_type,pid,reading_date) VALUES (?,?,?,?,?)",array($reading_time,$blood_glucose,'Terra_Api',$pid,$reading_date));
    
                  }
    
              }
    
    
            }
    
          }
    
        }
        $pid=$pid;
        $adss=1;
        $rm_encounter_exit=sqlQuery("SELECT * FROM form_encounter WHERE pid=? AND date_end!='NULL' AND encounter_status='open'",array($pid));
        if(empty($rm_encounter_exit))
        {
            $data_received=sqlQuery("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='Terra_Api'");
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
        echo 'success';
      }
      if(!empty($user_id1)){
    
        $today_date =  date('Y-m-d');
        //$startdate    = date('Y-m-d', strtotime($today_date. ' - 1 days'));
        $startdate='2023-05-01';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tryterra.co/v2/body?user_id='.$user_id1.'&start_date='.$startdate.'&end_date='.$today_date.'&to_webhook=false&with_samples=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Accept: application/json',
          'dev-id: refresh-health-dev-4kHfmQNvOw',
          'x-api-key: c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1'
        ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        $my_array_data = json_decode($response,true);
    
        if(isset($my_array_data['status'])&& $my_array_data['status']=='success'){
          $datas= $my_array_data['data'];
    
          for($i=0;$i<=count($datas);$i++)
          {
            $blood_pressure_data=$datas[$i]['blood_pressure_data']['blood_pressure_samples'];
            $mesurement_data=$datas[$i]['measurements_data']['measurements'];
    
            if(!empty($blood_pressure_data)){
              foreach($blood_pressure_data as $key=>$values)
              {
    
                $from='UTC';
                $to='America/New_York';
                $format='Y-m-d H:i:s';
                $format1='Y-m-d';
                $date=date($values['timestamp']);// UTC time
                date_default_timezone_set($from);
                $newDatetime = strtotime($date);
                date_default_timezone_set($to);
                $reading_time = date($format, $newDatetime);
                $reading_date = date($format1, $newDatetime);
                date_default_timezone_set('UTC');   
                  //$reading_time       = date('Y-m-d H:i:s', strtotime($values['timestamp']));
                  //$reading_date       = date('Y-m-d', strtotime($values['timestamp']));
                  $diastolic          = $values['diastolic_bp'];
                  $systolic          = $values['systolic_bp'];
                  $sql_reading        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='googlefit'");
                  $id=isset($sql_reading['id'])?$sql_reading['id']:'';
                  if(!empty($id))
                  {
                  $sql_update         = "UPDATE api_vitals_data SET reading_time=?,systolic=?,diastolic=?,api_type=?,pid=?,reading_date=? where id=?";
                  sqlStatement($sql_update, array($reading_time,$systolic,$diastolic,'googlefit',$pid,$reading_date,$id));
    
                  }
                  else{
                      sqlStatement("INSERT INTO api_vitals_data(reading_time,systolic,diastolic,api_type,pid,reading_date) VALUES (?,?,?,?,?,?)",array($reading_time,$systolic,$diastolic,'googlefit',$pid,$reading_date));
    
                  }
    
              }
    
            }
            if(!empty($mesurement_data)){
              foreach($mesurement_data as $keys=>$values1)
              {
    
                $reading_time1       = date('Y-m-d H:i:s', strtotime($values1['measurement_time']));
                  $reading_date1       = date('Y-m-d', strtotime($value1s['measurement_time']));
                  $height          = $values1['height_cm']?$values1['height_cm']:NULL;
                  $weight          = $values1['weight_kg']?$values1['weight_kg']:NULL;
                  $BMR             =$values1['BMR']?$values1['BMR']:NULL;
                  //echo $BMR.'<br>';
    
                  if($BMR){
                    $BMR=round($BMR);
                  }
                  $sql_reading_height        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='googlefit' AND reading_type='measurement_data' AND height_cm='".$height."'");
                  $sql_reading_weight        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='googlefit' AND reading_type='measurement_data' AND weight_kg='".$weight."'");
                  $sql_reading_bmr        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='googlefit' AND reading_type='measurement_data' AND bmr='".$BMR."'");
                  $height_id=isset($sql_reading_height['id'])?$sql_reading_height['id']:'';
                  $weight_id=isset($sql_reading_weight['id'])?$sql_reading_weight['id']:'';
                  $BMR_id=isset($sql_reading_bmr['id'])?$sql_reading_bmr['id']:'';
                  if(!empty($BMR_id)){
                    $sql_update         = "UPDATE api_vitals_data SET reading_time=?,bmr=?,api_type=?,pid=?,reading_date=? where id=?";
                    sqlStatement($sql_update, array($reading_time,$BMR,'googlefit',$pid,$reading_date,$BMR_id));
                  }
                  if(!empty($height_id))
                  {
                    //echo 'if';
                  $sql_update         = "UPDATE api_vitals_data SET reading_time=?,height_cm=?,api_type=?,pid=?,reading_date=? where id=?";
                  sqlStatement($sql_update, array($reading_time,$height,'googlefit',$pid,$reading_date,$height_id));
    
                  }
                  // else{
                  //     sqlStatement("INSERT INTO api_vitals_data(reading_time,height_cm,api_type,pid,reading_date,reading_type) VALUES (?,?,?,?,?,?)",array($reading_time,$height,'googlefit',$pid,$reading_date,'measurement_data'));
                  //     echo "INSERT INTO api_vitals_data(reading_time,height_cm,weight_kg,api_type,pid,reading_date,reading_type) VALUES ($reading_time,$height,$weight,'googlefit',$pid,$reading_date,'measurement_data')";
                  // }
                  else if(!empty($weight_id))
                  {
                    //echo 'elseif';
                  $sql_update         = "UPDATE api_vitals_data SET reading_time=?,weight_kg=?,api_type=?,pid=?,reading_date=? where id=?";
                  sqlStatement($sql_update, array($reading_time,$weight,'googlefit',$pid,$reading_date,$weight_id));
    
                  }
                  else{
                    //echo 'else';
                      sqlStatement("INSERT INTO api_vitals_data(reading_time,height_cm,weight_kg,bmr,api_type,pid,reading_date,reading_type) VALUES (?,?,?,?,?,?,?,?)",array($reading_time,$height,$weight,$BMR,'googlefit',$pid,$reading_date,'measurement_data'));
                      //echo "INSERT INTO api_vitals_data(reading_time,height_cm,weight_kg,bmr,api_type,pid,reading_date,reading_type) VALUES ($reading_time,$height,$weight,$BMR,'googlefit',$pid,$reading_date,'measurement_data')";
                  }
    
              }
            }
    
    
    
          }
    
        }
    
    
        $today_date1 =  date('Y-m-d');
        $startdate1    = date('Y-m-d', strtotime($today_date1. ' - 1 days'));
    
        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
        CURLOPT_URL => 'https://api.tryterra.co/v2/daily?user_id='.$user_id1.'&start_date='.$startdate1.'&end_date='.$today_date1.'&to_webhook=false&with_samples=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Accept: application/json',
          'dev-id: refresh-health-dev-4kHfmQNvOw',
          'x-api-key: c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1'
        ),
        ));
    
        $response1 = curl_exec($curl1);
        curl_close($curl);
    
        $my_array_data1 = json_decode($response1,true);
    
          if(isset($my_array_data1['status'])&& $my_array_data1['status']=='success')
          {
              $datas1= $my_array_data1['data'];
              //echo '<pre>';print_r($datas1);exit();
              for($i=0;$i<=count($datas1);$i++)
              {
                  $distance_data= $datas1[$i]['distance_data']['distance_meters']?$datas1[$i]['distance_data']['distance_meters']:NULL;
                  $steps_data= $datas1[$i]['distance_data']['steps']?$datas1[$i]['distance_data']['steps']:NULL;
                  $distance_steps_data= $datas1[$i]['distance_data']['detailed']['step_samples'];
                  $reading_time3='';
                  if(!empty($distance_steps_data))
                  {
                      foreach($distance_steps_data as $key=>$values2)
                      {
                          $reading_time3=date('Y-m-d H:i:s', strtotime($values2['timestamp']));
                          $reading_date3=date('Y-m-d', strtotime($values2['timestamp']));
                      }
                  }
                  $calories_data=$datas1[$i]['calories_data']['calorie_samples'];
                  if(!empty($calories_data))
                  {
                      foreach($calories_data as $key=>$values1)
                      {
                          $reading_time1       = date('Y-m-d H:i:s', strtotime($values1['timestamp']));
                          $reading_date1      =date('Y-m-d', strtotime($values1['timestamp']));
                          $calories_reading   = $values1['calories']?$values1['calories']:NULL;
                          $sql_reading1        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time1."' AND pid='$pid' AND api_type='googlefit' AND calories_reading='".$calories_reading."'");
                          $id1=isset($sql_reading1['id'])?$sql_reading1['id']:'';
                          if(!empty($id1))
                          {
                              $sql_update1         = "UPDATE api_vitals_data SET reading_time=?,calories_reading=?,api_type=?,pid=?,reading_date=? where id=?";
                              sqlStatement($sql_update1, array($reading_time1,$calories_reading,'googlefit',$pid,$reading_date1,$id1));
    
                          }
                          else
                          {
                              sqlStatement("INSERT INTO api_vitals_data(reading_time,calories_reading,api_type,pid,reading_date) VALUES (?,?,?,?,?)",array($reading_time1,$calories_reading,'googlefit',$pid,$reading_date1));
    
                          }
    
                      }
                  }
    
                  if(!empty($distance_data)||!empty($step_data))
                  {
                      $sql_reading2        = sqlQuery("SELECT * FROM api_vitals_data WHERE pid='$pid' AND api_type='googlefit' AND distance_data='".$distance_data."' AND steps_data='".$steps_data."'");
                      $id2=isset($sql_reading2['id'])?$sql_reading2['id']:'';
                      if(!empty($id2))
                      {
                          $sql_update2         = "UPDATE api_vitals_data SET reading_time=?,reading_date=?,distance_data=?,steps_data=?,api_type=?,pid=? where id=?";
                          sqlStatement($sql_update2, array($reading_time3,$reading_date3,$distance_data,$steps_data,'googlefit',$pid,$id2));
    
                      }
                      else
                      {
                          sqlStatement("INSERT INTO api_vitals_data(reading_time,reading_date,distance_data,steps_data,api_type,pid) VALUES (?,?,?,?,?,?)",array($reading_time3,$reading_date3,$distance_data,$steps_data,'googlefit',$pid));
    
                      }
    
                  }
              }
    
          }
    
          echo 'success';
      }
      else{
        echo 'success';
      }
    }


}
if(isset($_GET['ambrosiya']))
{
    $patient_result=[];
    $date = date("Y-m-d H").':00:00';                
    $begin_date = strtotime('-72 hours', strtotime($date));                
    $end_date = strtotime($date); 
    $patient_data=sqlStatement("SELECT pid,fname,lname,ambrosiasys_email,ambrosiasys_password FROM patient_data WHERE ambrosiasys_email!='' AND ambrosiasys_password!=''");
    while($row=sqlFetchArray($patient_data))
    {
      $patient_result[]=$row;
    }
    
    if(!empty($patient_result))
    {
    
      foreach($patient_result as $result1)
      {
        
        $pid=$result1['pid'];
    
        if(isset($result1['ambrosiasys_email'])){
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://developer.ambrosiasys.com/app/authentication?client_id=69636921d3662596c1607f6333f127d676d712e9e67834.ambrosiasys.com&client_secret=I6KEVGdYA6PR19U7N2Z6726X9F6M11CBf32QT69DJL36H62OS77We3673fd&response_type=code&redirect_uri=&email='.$result1['ambrosiasys_email'].'&password='.$result1['ambrosiasys_password'].'');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');    
          $headers = array();
          $headers[] = 'authorization: '.$token1.'';
          $headers[] = 'Cache-Control: no-cache';
          $headers[] = 'Content-Type: application/json';
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);    
          $access_crul = curl_exec($ch);
          $access_result=json_decode($access_crul,TRUE);
            
          if($access_result['message']=='user_authentaction_failed'){
            echo 'user authentication failed for '.$result1['fname'].' '.$result1['lname'];
          }
            else{
              $access_tocken=isset($access_result['access_token'])?$access_result['access_token']:'';
              if($access_tocken!=''){
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, 'https://developer.ambrosiasys.com/app/user_authorization?grant_type=access_token&code='.$access_tocken.'&signature=');
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');    
                  $headers = array();
                  $headers[] = 'authorization: '.$token1.'';
                  $headers[] = 'Cache-Control: no-cache';
                  $headers[] = 'Content-Type: application/json';
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);    
                  $acces_token2_curl = curl_exec($ch);
                  $acces_token2=json_decode($acces_token2_curl,TRUE);          
                  
                  if(isset($acces_token2['access_token'])){
                      $token2=$acces_token2['access_token'];
                      $flag=24;
                      $last_ambrosiya_data=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=? AND api_type='Ambrosiya_api' ORDER BY id DESC 
                      LIMIT 1",array($pid));
                      date_default_timezone_set('US/Eastern');                                 
                      $ch = curl_init();
                      curl_setopt($ch, CURLOPT_URL, 'https://developer.ambrosiasys.com/app/readings?begin_date='.$begin_date.'&end_date='.$end_date.'');
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                      $headers = array();
                      $headers[] = 'authorization: '.$token2.'';
                      $headers[] = 'Cache-Control: no-cache';
                      $headers[] = 'Content-Type: application/json';
                      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                      $result_data = curl_exec($ch);                
                      $res=explode('{',$result_data);
                      unset($res[0]);
                      unset($res[1]);
                      if (in_array('}', $res)) 
                      {
                          unset($res[array_search('}',$res)]);
                      }  
                      $reading_time = array();
                      $reading = array();
                      $reading_total_array=[];
                      $blood_glucose='';
                      foreach($res as $val){
                          $val=explode(',',$val);      
                          $str_arr = explode (":", $val[1]); 
                          $reading_time_date= str_replace("}","",$str_arr[1]);
                          $reading_time_date= str_replace("]","",$reading_time_date);
                          $reading_time_date = trim($reading_time_date);
                          $str_arr1 = explode (":", $val[0]);     
                          $reading_data = trim($str_arr1[1]);
                          $reading_data=trim($reading_data, '"');
                          $myValue=trim($reading_time_date, '"');
                          $myValue = substr($myValue,0,-3);
                          $date =date($myValue);      
                          $reading1['reading_time']=date('Y-m-d H:i:s',  (int)$date);
                          $reading1['glucose']=$reading_data;
                          $reading_total_array[]=$reading1;    
    
                      }
                      if(!empty($reading_total_array)){
                          foreach($reading_total_array as $values){
                              date_default_timezone_set('US/Eastern');
                              $reading_datetime       = date('Y-m-d H:i:s', strtotime($values['reading_time']));
                              $reading_date       = date('Y-m-d', strtotime($values['reading_time']));
                              $blood_glucose      = $values['glucose'];
                              $sql_reading=sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_datetime."' AND pid='$pid' AND api_type='Ambrosiya_api'");
                              $id=isset($sql_reading['id'])?$sql_reading['id']:'';
                              if(empty($id))
                              {
                              sqlStatement("INSERT INTO api_vitals_data(reading_time,blood_glucose,api_type,pid,reading_date) VALUES (?,?,?,?,?)",array($reading_datetime,$blood_glucose,'Ambrosiya_api',$pid,$reading_date));
                              
                              }    
    
                          }
                          $pid=$pid;
                          $adss=1;
                          $rm_encounter_exit=sqlQuery("SELECT * FROM form_encounter WHERE pid=? AND date_end!='NULL' AND encounter_status='open'",array($pid));
                          if(empty($rm_encounter_exit))
                          {
                              $data_received=sqlQuery("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='Ambrosiya_api'");
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
                          echo json_encode(array('msg' => "success",'glucose'=>$reading_total_array));
                      }
                      else {
                        echo 'no data found for '.$result1['fname'].' '.$result1['lname'];
                    
                      }	
                      if (curl_errno($ch)) {
                        echo 'something went wrong for '.$result1['fname'].' '.$result1['lname'].' '.curl_error($ch);
                  
                          //echo 'Error:' . curl_error($ch);
                      }
                      curl_close($ch);
    
                  }
                  else{
                    
                      echo 'refresh access token for '.$result1['fname'].' '.$result1['lname'];
                  }
    
              }
              else{
                
                  echo 'invalid access token for '.$result1['fname'].' '.$result1['lname'];
              }
            }
        }
        else{
            echo $result1['fname'].' '.$result1['lname'].' '.'patient have no email id';
            
        }
    
      }
    
    }

}

if(isset($_GET['omron']))
{

    $omron_array=[];
    $omron_data=sqlStatement("SELECT ot.*,CONCAT(pd.fname, ' ', pd.lname) as patient_name,pd.pid as pid FROM omron_token as ot left join patient_data as pd ON ot.pid=pd.pid WHERE ot.status=1");
    while ($results = sqlFetchArray($omron_data)) {
        array_push($omron_array, $results);
      }
      //echo '<pre>';print_r($omron_array);exit();
    if(!empty($omron_array)){
        foreach($omron_array as $value)
        {
            $patient_name=$value['patient_name'];
           
            $user_id=isset($value['user_id'])?$value['user_id']:'';
            if(!empty($user_id)){
                //echo 'terra_glucose';
                $today_date =  date('Y-m-d');
                $startdate    = date('Y-m-d', strtotime($today_date. ' - 7 days'));
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.tryterra.co/v2/body?user_id='.$user_id.'&start_date='.$startdate.'&end_date='.$today_date.'&to_webhook=false&with_samples=true',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'dev-id: refresh-health-dev-4kHfmQNvOw',
                'x-api-key: c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1'
                ),
                ));
            
                $response = curl_exec($curl);
                curl_close($curl);  
                $my_array_data = json_decode($response,true);
                //echo '<pre>';print_r($my_array_data);exit();
                if($my_array_data['status']=='success')
                {
                    $datas= $my_array_data['data'];
                    //$datas=[];
                    if(!empty($datas))
                    {
    
                        foreach($datas as $key=>$values)
                        {
                            
                            $pulse_data=$values['heart_data']['heart_rate_data']['detailed']['hr_samples'];
                            $blood_pressure_data=$values['blood_pressure_data']['blood_pressure_samples'];
                            //
                            if(!empty($pulse_data))
                            {
                                foreach($pulse_data as $key=>$pulsevalues)
                                {
                                
                                    
                                    date_default_timezone_set('UTC');                  
                                    $pulsevalues['timestamp']=substr($pulsevalues['timestamp'], 0, -9);                    
                                    $reading_time_pulse=date('Y-m-d H:i:s', strtotime($pulsevalues['timestamp']. ' - 4 hours'));
                                    $reading_date_pulse=date('Y-m-d', strtotime($pulsevalues['timestamp']));          
                                    
                                    $pulse=$pulsevalues['bpm'];
                                    
                                    $sql_reading        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time_pulse."' AND pid='$pid' AND api_type='omron_api'");
                                    
                                    $id=isset($sql_reading['id'])?$sql_reading['id']:'';
                                    
                                    if($id=='')
                                    {
                                                                      
                                        sqlStatement("INSERT INTO api_vitals_data(reading_time,pulse,api_type,pid,reading_date) VALUES (?,?,?,?,?)",array($reading_time_pulse,$pulse,'omron_api',$pid,$reading_date_pulse));
                        
                                    }
                                    else{
                                        
                                        sqlStatement("UPDATE api_vitals_data SET reading_time=?,pulse=?,api_type=?,pid=?,reading_date=? where id=?", array($reading_time_pulse,$pulse,'omron_api',$pid,$reading_date_pulse,$id));
    
                                    }
                                    
                                }
                                echo 'pulse data for patient '.$patient_name.' : <pre>';print_r($pulse_data).'<br>';
                    
                    
                            }
                            else{
                                echo 'no pulse data for patient '.$patient_name.'<br>';
                            }
                            if(!empty($blood_pressure_data))
                            {
    
                                foreach($blood_pressure_data as $key=>$bp_value)
                                {
                                   
                                    date_default_timezone_set('UTC');                  
                                    $bp_value['timestamp']=substr($bp_value['timestamp'], 0, -9);                    
                                    $reading_time=date('Y-m-d H:i:s', strtotime($bp_value['timestamp']. ' - 4 hours'));               
                                    $reading_date=date('Y-m-d', strtotime($bp_value['timestamp']));                               //echo $unixTimestamp.'<br>';
                                                      
                                    $systolic=$bp_value['systolic_bp'];
                                    $diastolic=$bp_value['diastolic_bp'];
                                    
                                    $sql_reading_pb        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='omron_api'");
                                    $pb_id=isset($sql_reading_pb['id'])?$sql_reading_pb['id']:'';
                                    if($pb_id=='')
                                    {                                                                  
                                        sqlStatement("INSERT INTO api_vitals_data(reading_time,systolic,diastolic,api_type,pid,reading_date) VALUES (?,?,?,?,?,?)",array($reading_time,$systolic,$diastolic,'omron_api',$pid,$reading_date));
                                    }
                                    else{
                                        //$sql_update         = "UPDATE api_vitals_data SET reading_time=?,systolic=?,diastolic=?,api_type=?,pid=?,reading_date=? where id=?";
                                        sqlStatement("UPDATE api_vitals_data SET reading_time=?,systolic=?,diastolic=?,api_type=?,pid=?,reading_date=? where id=?", array($reading_time,$systolic,$diastolic,'omron_api',$pid,$reading_date,$pb_id));
    
                                    }
                                    
                                }
                                echo 'bp data for patient '.$patient_name.': <pre>';print_r($blood_pressure_data).'<br>';
    
                            }
                            else{
                                echo 'No blood Pressure data for patient '.$patient_name.' <br>';
                            }                        
                    
                        }
    
                    }
                    else{
                        echo "No data for patient ".$patient_name."<br>";
                    }            
                
                
                }
                else{
                    echo 'error_msg for patient '.$patient_name.' '.$my_array_data['message'].'<br>';
                }
                
                $pid=$pid;
                $adss=1;
    
                $rm_encounter_exit=sqlQuery("SELECT * FROM form_encounter WHERE pid=? AND date_end!='NULL' AND encounter_status='open'",array($pid));
                if(empty($rm_encounter_exit))
                {
                    $data_received=sqlQuery("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='omron_api'");
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
            }
            else
            {
                echo "No user  for patient ".$patient_name."<br>'";
    
            }
            echo '----------------------------------------------------------------------------------------<br>';
        }
    }

}

?>

