<?php
ini_set('display_errors',false);
$ignoreAuth = true;
$sessionAllowWrite = true;
require_once("../../globals.php");
require_once($GLOBALS['srcdir'] . '/encounter_events.inc.php');
require_once($GLOBALS["srcdir"] . "/forms.inc");
if(isset($GLOBALS['enable_rpm_code'])&&$GLOBALS['enable_rpm_code']==true)
{
 
$patient_array=[];
$patient_data=sqlStatement("SELECT pid,CONCAT(fname, ' ', lname) as pat_name FROM patient_data");
while($row=sqlFetchArray($patient_data))
{
   $patient_array[]=$row; 
}

foreach($patient_array as $value)
{
    $pid=isset($value['pid'])?$value['pid']:'';
    $patient_name=isset($value['pat_name'])?$value['pat_name']:'';
    $rm_encounter_exit=sqlQuery("SELECT * FROM form_encounter WHERE pid=? AND date_end IS NOT NULL AND encounter_status='open'",array($pid));
    if(empty($rm_encounter_exit))
    {
        $data_received=sqlQuery("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='marsonick_api'");
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
            echo '<br> '.$patient_name.' create new rpm encounter';
        }
        else{
            echo '<br> '.$patient_name.' have no marsonick api data';  
        }
        
    }
    else{
        echo '<br> '.$patient_name.' have already RPM Enounter';
    }
    echo '<br>**********************************************************************************';
}
}
?>