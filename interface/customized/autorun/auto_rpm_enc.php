<?php
    ini_set('display_errors',false);
    $ignoreAuth = true;
    $sessionAllowWrite = true;
    require_once("../../globals.php");
    require_once($GLOBALS['srcdir'] . '/encounter_events.inc.php');
    require_once($GLOBALS["srcdir"] . "/forms.inc");
     /*encounter new encounter create */
     $rpm_enc_array=[];
    //$rpm_encounter_data=sqlStatement("SELECT id,pid,date_end,encounter,date,encounter_status FROM form_encounter WHERE date_end!='NULL' AND encounter_status='open'");
    $rpm_encounter_data=sqlStatement("SELECT fe.id as id,fe.pid as pid,fe.date as date,fe.encounter as encounter,fe.date_end as date_end,fe.encounter_status as encounter_status,CONCAT(pd.fname, ' ', pd.lname) as patient_name FROM form_encounter as fe left join patient_data as pd ON fe.pid=pd.pid WHERE fe.date_end!='NULL' AND fe.encounter_status='open'");
    $rpm_encounter_count=sqlNumRows($rpm_encounter_data);
    if($rpm_encounter_count>0)
    {
        while($rpm_row=sqlFetchArray($rpm_encounter_data))
        {
            $rpm_enc_array[]=$rpm_row;
        }     
    }
   
    if(!empty($rpm_enc_array))
    {
        
        foreach($rpm_enc_array as $row)
        {
            $pid=$row['pid'];
            $start_date=date('Y-m-d',strtotime($row['date']));
            $end_date=date('Y-m-d',strtotime($row['date_end']));
            $today_date=date('Y-m-d');
            $encounter=$row['encounter']; 
            $sql_code = sqlQuery("Select * from billing where pid='".$pid."' AND encounter ='".$encounter."' AND code='99454'");
            $rpm_code1= sqlQuery("Select * from billing where pid='".$pid."' AND code='99453'");
            if(empty($rpm_code1))
            {
                $code_reading_date=date('Y-m-d', strtotime($row['date']. ' + 15 days')); 
                if(strtotime($code_reading_date)<strtotime($today_date))
                {
                    $code1=99453;
                    insert_billing($code1,$encounter,$pid);
                    echo "<br>code 99453 created for ".$row['patient_name']."";
                }
            }
            else{
                echo "<br>code 99453 already created for ".$row['patient_name']."";
            }
            if(empty($sql_code)){
                $insert_billing='true';
                
            }
            else{
                $insert_billing='false'; 
                echo "<br>code 99454  already created for ".$row['patient_name']."";
            }
                
            $query=sqlStatement("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='smart_meter_api' AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY reading_date");
            $reading_count=sqlNumRows($query);
            if($reading_count>=16 && $insert_billing=='true')
            {
                $code=99454;
                insert_billing($code,$encounter,$pid);
                echo "<br>code 99454 created for ".$row['patient_name']."";
                  
            }
            $expiry_date=date('Y-m-d', strtotime($row['date_end']. ' + 1 days'));           
            
            if(strtotime($end_date)<strtotime($today_date))
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
                $end_date=date('Y-m-d H:i:s', strtotime($today_date. ' + 30 days'));
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
                sqlStatement("UPDATE form_encounter SET encounter_status='closed' WHERE encounter='".$encounter."'");
                echo "<br>New RPM Encounter ".$new_encounter." Created for ".$row['patient_name']." ".$pid."";
            }
            else{
                echo "<br>Rpm Encounter no expire for ".$row['patient_name']." ".$pid."";
            }
            echo '<br>=============================================<br>';
        }  
    }
    else{
        echo "No Patient Have Rpm Encounter";
    }
     

    function insert_billing($code,$encounter,$pid){
        
                $code_text='smart meter code';
                $modifier='';
                $units='';
                $ndc_info = '';
                $justify = '';
                $billed = 0;
                $notecodes = '';
                $pricelevel = '';
                $revenue_code = "";
                $code_type='CPT4'; 
                $units='1';
                $fee='100';
                $sql = "INSERT INTO billing (date, encounter, code_type, code, code_text, " .
                    "pid, authorized, user, groupname, activity, billed, provider_id, " .
                    "modifier, units, fee, ndc_info, justify, notecodes, pricelevel, revenue_code) VALUES (" .
                    "NOW(), ?, ?, ?, ?, ?, ?, ?, ?,  1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $insert_id=sqlInsert($sql, array($encounter, $code_type, $code,$code_text, $pid, 1,1, 'Default', 0, 1, $modifier, $units, $fee,$ndc_info, $justify, $notecodes, $pricelevel, $revenue_code));
    }
    ?>