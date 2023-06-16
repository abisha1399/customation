<?php

 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");
require_once($GLOBALS['srcdir'] . '/encounter_events.inc.php');
require_once($GLOBALS["srcdir"] . "/forms.inc");
$ime_device=[];
$device_data=sqlStatement("SELECT bt.*,CONCAT(pd.fname, ' ', pd.lname) as patient_name FROM body_trace_number as bt left join patient_data as pd ON bt.pid=pd.pid WHERE bt.device_number IS NOT NULL AND bt.device_number!=''");
$from_date=date('Y-m-d H', strtotime(' -1 hours')).':00:00';
$to_date=date('Y-m-d H').':00:00';
// $from_date='2023-01-11 01:10:10';
// $to_date='2023-05-22 23:10:10';
$from_time = strtotime($from_date)*1000;
$to_time=strtotime($to_date)*1000;
while($row=sqlFetchArray($device_data))
{
    $ime_device[]=$row;
}
if(!empty($ime_device))
{
    foreach($ime_device as $data)
    {
        $device_number=isset($data['device_number'])?$data['device_number']:'';
        $pid=$data['pid'];
        $patient_name=$data['patient_name'];
        //$device_number='ssss';
        if($device_number!='')
        {
            $userName = isset($GLOBALS['bodytrace_username'])?$GLOBALS['bodytrace_username']:'support@refresh.health';
            $password = isset($GLOBALS['bodytrace_password'])?$GLOBALS['bodytrace_password']:'blVPtJO4hfDYuJLn35WoL';
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://us.data.bodytrace.com/1/device/'.$device_number.'/datamessages?from='.$from_time.'&to='.$to_time.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_USERPWD => $userName . ':' . $password,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $body_data = json_decode($response,true);
            if(!empty($body_data)){
                foreach($body_data as $values)
                {
                    $values_array=$values['values'];
                    if(!empty($values_array))
                    {
                        $weight_data=isset($values_array['weight'])?$values_array['weight']:'';
                        $bp_data    = isset($values_array['systolic'])?$values_array['systolic']:'';
                        date_default_timezone_set('US/Eastern');
                        $seconds = ceil($values['ts'] / 1000);

                        $reading_time=date("Y-m-d H:i:s", $seconds);
                        $reading_date=date("Y-m-d", $seconds);                                       
                        $reading_data_exit=sqlQuery("SELECT * FROM api_vitals_data WHERE api_type='bodytrace_api' AND pid=? AND reading_time=?",array($pid,$reading_time));
                        $exitid=isset($reading_data_exit['id'])?$reading_data_exit['id']:'';
                        if($weight_data)
                        {
                            $unit=isset($values_array['unit'])&&$values_array['unit']==1?'lb':'kg';
                            $weight_g=$values_array['weight'];
                            $org_weight=$values_array['weight'];
                            $weight=$weight_g*0.00220462;                    
                            if($unit=='lb')
                            {
                                $weight=$weight*0.45359237;
                            }
                            if($exitid!=''){
                                $sql_update1         = "UPDATE api_vitals_data SET reading_time=?,weight_kg=?,api_type=?,pid=?,reading_date=?,reading_type=?,org_weight=? where id=?";
                                sqlStatement($sql_update1, array($reading_time,round($weight),'bodytrace_api',$pid,$reading_date,$unit,$org_weight,$exitid));
                            }
                            else
                            {
                                sqlInsert("INSERT INTO api_vitals_data(reading_time,weight_kg,api_type,pid,reading_date,reading_type,org_weight) VALUES (?,?,?,?,?,?,?)",array($reading_time,round($weight),'bodytrace_api',$pid,$reading_date,$unit,$org_weight));
                            }
                               
                        }
                        
                        if($bp_data)
                        {
                            $unit=isset($values_array['unit'])&&$values_array['unit']==1?'mmHg':'kPa';                    
                            $systolic=$values_array['systolic'];
                            $diastolic=$values_array['diastolic'];
                            $bp_value=$systolic.','.$diastolic;
                            $pulse=$values_array['pulse'];                    
                            if($unit=='kPa')
                            {                     
                                $systolic=round($values_array['systolic'] * 0.0075006);
                                $diastolic=round($values_array['diastolic'] * 0.0075006);
                            }
                            if($exitid!=''){
                                $sql_update1         = "UPDATE api_vitals_data SET reading_time=?,systolic=?,diastolic=?,bp_value=?,pulse=?,api_type=?,pid=?,reading_date=?,reading_type=? where id=?";
                                sqlStatement($sql_update1, array($reading_time,round($systolic),round($diastolic),$bp_value,round($pulse),'bodytrace_api',$pid,$reading_date,$unit,$exitid));
                            }
                            else
                            {
                                sqlInsert("INSERT INTO api_vitals_data(reading_time,systolic,diastolic,bp_value,pulse,api_type,pid,reading_date,reading_type) VALUES (?,?,?,?,?,?,?,?,?)",array($reading_time,round($systolic),round($diastolic),$bp_value,round($pulse),'bodytrace_api',$pid,$reading_date,$unit));
                            }                            
                                
                        }
                        
                        echo 'data for '.$patient_name.'<pre>';print_r($response).'<br>';
                    }
                }
                echo '<br>data for '.$patient_name.'<br>'.$response.'';
                
                
            }
            else{
                echo "<br>No data. $patient_name";
            }
            
        }
        else{
            echo "<br>device number empty $patient_name";
        }
        $rm_encounter_exit=sqlQuery("SELECT * FROM form_encounter WHERE pid=? AND date_end!='NULL' AND encounter_status='open'",array($pid));
    if(empty($rm_encounter_exit))
    {
        $data_received=sqlQuery("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='bodytrace_api'");
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
                date_default_timezone_set('US/Eastern');
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
        echo "<br>****************************************************************************";
    }
    

}
else{
    echo "<br>No device data";
}
//echo '<pre>';print_r($ime_device);

?>