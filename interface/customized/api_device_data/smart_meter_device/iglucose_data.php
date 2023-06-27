
<?php
 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
use OpenEMR\Common\Csrf\CsrfUtils;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.iglucose.com/readings/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$pid=isset($_SESSION['pid'])?$_SESSION['pid']:'';
if(isset($_GET['pid'])){
    $pid=isset($_GET['pid'])?$_GET['pid']:'';
}
if(isset($GLOBALS['enable_smartmeter_api'])&&$GLOBALS['enable_smartmeter_api']==true){
$datas=[];
$patind_dat =sqlStatement("SELECT * FROM smart_device_numbers WHERE pid='".$pid."'");
while($row=sqlFetchArray($patind_dat)){
    if($row['serial_number']!=''){
        $datas[]=$row['serial_number'];
    }    
    
}
//$end_date= date("Y-m-d").'T'.date('H:i:s');
//$startdate = date(("Y-m-d"), strtotime($end_date. ' - 1 days')).'T'.date('H:i:s');

$date= date("Y-m-d").'T'.date('H:i:s');

$startdate = date(("Y-m-d")).'T'.date('H:i:s', strtotime(' -1 hours'));
$end_date=date(("Y-m-d")).'T'.date('H:i:s');
// print_r($startdate);
// echo '<br>';
// print_r($end_date);

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

if(isset($data['status']['status_code'])==200){ 
    $iglucose_data = $data['readings']; 
    if(!empty($iglucose_data)){
        foreach($iglucose_data as $iglucose_val){
            $from='UTC';
            $to='America/New_York';
            $format='Y-m-d H:i:s';
            $format1='Y-m-d';
            $date=$iglucose_val['date_recorded'];// UTC time
            date_default_timezone_set($from);
            $newDatetime = strtotime($date);
            date_default_timezone_set($to);
            $reading_time = date($format, $newDatetime);
            date_default_timezone_set('UTC');
            $reading_date       = date($format1, $newDatetime);

            //$reading_time       = date('Y-m-d H:i:s', strtotime($iglucose_val['date_recorded']));
            //$reading_date       = date('Y-m-d', strtotime($iglucose_val['date_recorded']));
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
            
            }
            else{
                
                sqlStatement("INSERT INTO api_vitals_data(reading_time,pulse,systolic,diastolic,blood_glucose,weight_kg,spo2,reading_date,pid,reading_type,api_type) VALUES (?,?,?,?,?,?,?,?,?,?,?)",array($reading_time,$pulse,$systolic,$diastolic,$blood_glucose_mgdl,$weight,$spo2,$reading_date,$pid,$reading_type,'smart_meter_api'));
                
            }
        }
        echo json_encode($iglucose_data);  
    } 
    else{
        echo 'device have no data';
    }   
     
}
else{  
    
    echo $data['status']['status_message'];
}

$pid=isset($_SESSION['pid'])?$_SESSION['pid']:'';
$adss=1;
if(isset($GLOBALS['enable_rpm'])&&$GLOBALS['enable_rpm']==true){
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
}else{
    echo "RPM  is disable for you please contact your facility";
}
}else{
    echo "Smart meter is disable for you please contact your facility";
}

?>

