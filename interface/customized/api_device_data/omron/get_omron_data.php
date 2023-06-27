<?php

 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");
$pid=$_SESSION['pid'];
if(isset($_GET['pid'])){
    $pid=isset($_GET['pid'])?$_GET['pid']:'';
}
if(isset($GLOBALS['enable_omron_api'])&&$GLOBALS['enable_omron_api']==true){
$result = sqlQuery("SELECT * FROM  omron_token  WHERE  pid=? AND status=? ORDER BY id DESC LIMIT 1", array($pid,1));
$user_id=isset($result['user_id'])?$result['user_id']:'';
$terra_dev_id=isset($GLOBALS['terra_devid'])?$GLOBALS['terra_devid']:'refresh-health-dev-4kHfmQNvOw';
$terra_api_key=isset($GLOBALS['terra_api_key'])?$GLOBALS['terra_api_key']:'c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1';
if(!empty($user_id)){
    //echo 'terra_glucose';
    $today_date =  date('Y-m-d');
    $startdate    = date('Y-m-d', strtotime($today_date. ' - 1 days'));
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
      'dev-id: '.$terra_dev_id.'',
       'x-api-key: '.$terra_api_key.''
    ),
    ));
  
    $response = curl_exec($curl);
    curl_close($curl);  
    $my_array_data = json_decode($response,true);
    //echo '<pre>';print_r($my_array_data);exit();
    if($my_array_data['status']=='success'){
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
                echo 'pulse data: <pre>';print_r($pulse_data).'<br>';
    
    
            }
            else{
                echo 'no pulse data<br>';
            }
            if(!empty($blood_pressure_data))
            {

                foreach($blood_pressure_data as $key=>$bp_value)
                {
                    
                    $bp_value['timestamp']=substr($bp_value['timestamp'], 0, -9);                    
                    $reading_time=date('Y-m-d H:i:s', strtotime($bp_value['timestamp']. ' - 4 hours'));               
                    $reading_date=date('Y-m-d', strtotime($bp_value['timestamp']));                    
                    $systolic=$bp_value['systolic_bp'];
                    $diastolic=$bp_value['diastolic_bp'];
                    
                    $sql_reading_pb        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='omron_api'");
                    $pb_id=isset($sql_reading_pb['id'])?$sql_reading_pb['id']:'';
                    if($pb_id=='')
                    {                       
                        sqlStatement("INSERT INTO api_vitals_data(reading_time,systolic,diastolic,api_type,pid,reading_date) VALUES (?,?,?,?,?,?)",array($reading_time,$systolic,$diastolic,'omron_api',$pid,$reading_date));
                    }
                    else{
                        
                        sqlStatement("UPDATE api_vitals_data SET reading_time='".$reading_time."',systolic='".$systolic."',diastolic='".$diastolic."',pid='".$pid."',reading_date='".$reading_date."' where id='".$pb_id."'");

                    }
                    
                }
                echo 'bp data: <pre>';print_r($blood_pressure_data).'<br>';

            }
            else{
                echo 'No blood Pressure data <br>';
            }

            echo '----------------------------------------------------------------------<br>';
    
        }

      }
      else{
        echo "No data Found<br>";
      }
      
      
      //echo 'libree:<br>'.json_encode($datas);
    }
    else{
        echo $my_array_data['message'];
    }
    
    $pid=$pid;
    $adss=1;
    if(isset($GLOBALS['enable_rpm'])&&$GLOBALS['enable_rpm']==true)
    {
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
                $end_date=date('Y-m-d h:i:s', strtotime($today_date. ' + 15 days'));
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
    }else{
        echo "RPM not enable please contact your facility";
    }
}
else{
    echo "not connected";
}
}else{
    echo "Omron is disable for you please contact with your clinic";
}

  
?>