<?php

 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");

$omron_array=[];
$omron_data=sqlStatement("SELECT ot.*,CONCAT(pd.fname, ' ', pd.lname) as patient_name,pd.pid as pid FROM omron_token as ot left join patient_data as pd ON ot.pid=pd.pid WHERE ot.status=1");
while ($results = sqlFetchArray($omron_data)) {
    array_push($omron_array, $results);
  }
  $terra_dev_id=isset($GLOBALS['terra_devid'])?$GLOBALS['terra_devid']:'refresh-health-dev-4kHfmQNvOw';
$terra_api_key=isset($GLOBALS['terra_api_key'])?$GLOBALS['terra_api_key']:'c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1';
  //echo '<pre>';print_r($omron_array);exit();
if(!empty($omron_array)){
    foreach($omron_array as $value)
    {
        $patient_name=$value['patient_name'];
       
        $user_id=isset($value['user_id'])?$value['user_id']:'';
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
  
?>