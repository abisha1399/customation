
<?php
 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
use OpenEMR\Common\Csrf\CsrfUtils;
$end_date= date("Y-m-d").'T'.date('H').':00:00';
$startdate = date(("Y-m-d")).'T'.date('H', strtotime(' -3 hours')).':00:00';
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
            $spo2=NULL;
            $weight=NULL;
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
            if(isset($iglucose_val['weight_kg'])&&$iglucose_val['weight_kg']!='')
            {
                $weight=$iglucose_val['weight_kg'];
            }
            if(isset($iglucose_val['weight_lbs'])&&$iglucose_val['weight_lbs']!='')
            {
                $weight_data=$iglucose_val['weight_lbs'];
                $weight=$weight_data*0.45359237;
            }
            if(isset($iglucose_val['spo2'])&&$iglucose_val['spo2']!='')
            {
                $spo2=$iglucose_val['spo2'];
            }
            $sql_date_reading   = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='".$pid."' AND reading_type='".$reading_type."' AND api_type='smart_meter_api'");
            //$sql_date_reading   = sqlQuery("SELECT * FROM smart_meter_data WHERE reading_time='".$reading_time."' AND pid='".$pid."' AND reading_type='".$reading_type."'");
            $id=isset($sql_date_reading['id'])?$sql_date_reading['id']:'';
            if(!empty($id))
            {
            
                $sql_update= "UPDATE api_vitals_data SET reading_time=?,pulse=?,systolic=?,diastolic=?,blood_glucose=?,weight_kg=?,spo2=?,reading_date=?,pid=?,reading_type=? where id=?";
                sqlStatement($sql_update, array($reading_time,$pulse,$systolic,$diastolic,$blood_glucose_mgdl,$weight,$spo2,$reading_date,$pid,$reading_type,$id));
            $insert_id_array[]=$id;
            }
            else{
                
                $insert_id=sqlInsert("INSERT INTO api_vitals_data(reading_time,pulse,systolic,diastolic,blood_glucose,weight_kg,spo2,reading_date,pid,reading_type,api_type) VALUES (?,?,?,?,?,?,?,?,?,?,?)",array($reading_time,$pulse,$systolic,$diastolic,$blood_glucose_mgdl,$weight,$spo2,$reading_date,$pid,$reading_type,'smart_meter_api'));
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
?>

