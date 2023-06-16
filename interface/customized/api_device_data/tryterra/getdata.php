<?php
 $ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

//$patientid='4';
use OpenEMR\Common\Csrf\CsrfUtils;
$pid=isset($_SESSION['pid'])?$_SESSION['pid']:'';
if(isset($_GET['pid'])){
  $pid=isset($_GET['pid'])?$_GET['pid']:'';
}
$terra_dev_id=isset($GLOBALS['terra_devid'])?$GLOBALS['terra_devid']:'refresh-health-dev-4kHfmQNvOw';
$terra_api_key=isset($GLOBALS['terra_api_key'])?$GLOBALS['terra_api_key']:'c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1';
$result = sqlQuery("SELECT * FROM  terra_user  WHERE  pid=? AND status=? ORDER BY id DESC LIMIT 1", array($pid,1));
$result1 = sqlQuery("SELECT * FROM  terra_googlefit  WHERE  pid=? AND status=? ORDER BY id DESC LIMIT 1", array($pid,1));
$user_id=isset($result['user_id'])?$result['user_id']:'';
$user_id1=isset($result1['user_id'])?$result1['user_id']:'';
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
  if($my_array_data['status']=='success'){
    $datas= $my_array_data['data'];
    
    foreach($datas as $key=>$values)
    {
      
      $glucose_data=$values['glucose_data']['blood_glucose_samples'];
      if(!empty($glucose_data)){
        foreach($glucose_data as $key=>$values)
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
            $blood_glucose      = $values['blood_glucose_mg_per_dL'];
            $sql_reading        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='Terra_Api'");
            $id=isset($sql_reading['id'])?$sql_reading['id']:'';
            if(empty($id))
            {
            // $sql_update         = "UPDATE api_vitals_data SET reading_time=?,terra_glucose=?,api_type=?,pid=?,reading_date=? where id=?";
            // sqlStatement($sql_update, array($reading_time,$blood_glucose,'Terra_Api',$pid,$reading_date,$id));
            sqlStatement("INSERT INTO api_vitals_data(reading_time,blood_glucose,api_type,pid,reading_date) VALUES (?,?,?,?,?)",array($reading_time,$blood_glucose,'Terra_Api',$pid,$reading_date));

            }
            
        }


      }

    }
    echo 'libree:<br>'.json_encode($datas);
  }
  else{
    echo $my_array_data['message'];
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
  
}
else{
  echo "<br> libree not connected";
}
if(!empty($user_id1)){

  $today_date =  date('Y-m-d');
  $startdate    = date('Y-m-d', strtotime($today_date. ' - 1 days'));

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
    'dev-id: '.$terra_dev_id.'',
     'x-api-key: '.$terra_api_key.''
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
            date_default_timezone_set('UTC');  
            $reading_date       = date($format1, $newDatetime);
          //$reading_time       = date('Y-m-d H:i:s', strtotime($values['timestamp']));
            //$reading_date       = date('Y-m-d', strtotime($values['timestamp']));
            $diastolic          = $values['diastolic_bp'];
            $systolic          = $values['systolic_bp'];
            $sql_reading        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='googlefit'");
            $id=isset($sql_reading['id'])?$sql_reading['id']:'';
            if(empty($id))
            {
            // $sql_update         = "UPDATE api_vitals_data SET reading_time=?,systolic=?,diastolic=?,api_type=?,pid=?,reading_date=? where id=?";
            // sqlStatement($sql_update, array($reading_time,$systolic,$diastolic,'googlefit',$pid,$reading_date,$id));
            sqlStatement("INSERT INTO api_vitals_data(reading_time,systolic,diastolic,api_type,pid,reading_date) VALUES (?,?,?,?,?,?)",array($reading_time,$systolic,$diastolic,'googlefit',$pid,$reading_date));
            }
        }

      }
      if(!empty($mesurement_data)){
        foreach($mesurement_data as $keys=>$values1)
        {
          date_default_timezone_set('US/Eastern');
          $reading_time1     = date('Y-m-d H:i:s', strtotime($values1['measurement_time']));
            $reading_date1   = date('Y-m-d', strtotime($value1s['measurement_time']));
            $height          = $values1['height_cm']?$values1['height_cm']:NULL;
            $weight          = $values1['weight_kg']?$values1['weight_kg']:NULL;
            $BMR             = $values1['BMR']?$values1['BMR']:NULL;
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
            if(empty($BMR_id)||empty($height_id)||empty($weight_id))
            {
              sqlStatement("INSERT INTO api_vitals_data(reading_time,height_cm,weight_kg,bmr,api_type,pid,reading_date,reading_type) VALUES (?,?,?,?,?,?,?,?)",array($reading_time,$height,$weight,$BMR,'googlefit',$pid,$reading_date,'measurement_data'));
            }
            // if(!empty($BMR_id)){
            //   $sql_update         = "UPDATE api_vitals_data SET reading_time=?,bmr=?,api_type=?,pid=?,reading_date=? where id=?";
            //   sqlStatement($sql_update, array($reading_time,$BMR,'googlefit',$pid,$reading_date,$BMR_id));
            // }
            // if(!empty($height_id))
            // {
            //   //echo 'if';
            // $sql_update         = "UPDATE api_vitals_data SET reading_time=?,height_cm=?,api_type=?,pid=?,reading_date=? where id=?";
            // sqlStatement($sql_update, array($reading_time,$height,'googlefit',$pid,$reading_date,$height_id));

            // }
            // else{
            //     sqlStatement("INSERT INTO api_vitals_data(reading_time,height_cm,api_type,pid,reading_date,reading_type) VALUES (?,?,?,?,?,?)",array($reading_time,$height,'googlefit',$pid,$reading_date,'measurement_data'));
            //     echo "INSERT INTO api_vitals_data(reading_time,height_cm,weight_kg,api_type,pid,reading_date,reading_type) VALUES ($reading_time,$height,$weight,'googlefit',$pid,$reading_date,'measurement_data')";
            // }
            // else if(!empty($weight_id))
            // {
            //   //echo 'elseif';
            // $sql_update         = "UPDATE api_vitals_data SET reading_time=?,weight_kg=?,api_type=?,pid=?,reading_date=? where id=?";
            // sqlStatement($sql_update, array($reading_time,$weight,'googlefit',$pid,$reading_date,$weight_id));

            // }
            //else{
              //echo 'else';
                
                //echo "INSERT INTO api_vitals_data(reading_time,height_cm,weight_kg,bmr,api_type,pid,reading_date,reading_type) VALUES ($reading_time,$height,$weight,$BMR,'googlefit',$pid,$reading_date,'measurement_data')";
            //}

        }
      }



    }
    echo 'googlefit:<br>'.json_encode($datas);

  }
  else{
    echo $my_array_data['message'];
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
    'dev-id: '.$terra_dev_id.'',
     'x-api-key: '.$terra_api_key.''
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
                   date_default_timezone_set('US/Eastern');
                    $reading_time3=date('Y-m-d H:i:s', strtotime($values2['timestamp']));
                    $reading_date3=date('Y-m-d', strtotime($values2['timestamp']));
                }
            }
            $calories_data=$datas1[$i]['calories_data']['calorie_samples'];
            if(!empty($calories_data))
            {
                foreach($calories_data as $key=>$values1)
                {
                    date_default_timezone_set('US/Eastern');
                    $reading_time1       =date('Y-m-d H:i:s', strtotime($values1['timestamp']));
                    $reading_date1      =date('Y-m-d', strtotime($values1['timestamp']));
                    $calories_reading   = $values1['calories']?$values1['calories']:NULL;
                    $sql_reading1        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time1."' AND pid='$pid' AND api_type='googlefit' AND calories_reading='".$calories_reading."'");
                    $id1=isset($sql_reading1['id'])?$sql_reading1['id']:'';
                    if(empty($id1))
                    {
                      sqlStatement("INSERT INTO api_vitals_data(reading_time,calories_reading,api_type,pid,reading_date) VALUES (?,?,?,?,?)",array($reading_time1,$calories_reading,'googlefit',$pid,$reading_date1));
                        // $sql_update1         = "UPDATE api_vitals_data SET reading_time=?,calories_reading=?,api_type=?,pid=?,reading_date=? where id=?";
                        // sqlStatement($sql_update1, array($reading_time1,$calories_reading,'googlefit',$pid,$reading_date1,$id1));

                    }
                }
            }

            if(!empty($distance_data)||!empty($step_data))
            {
                $sql_reading2        = sqlQuery("SELECT * FROM api_vitals_data WHERE pid='$pid' AND api_type='googlefit' AND distance_data='".$distance_data."' AND steps_data='".$steps_data."'");
                $id2=isset($sql_reading2['id'])?$sql_reading2['id']:'';
                if(empty($id2))
                {
                  sqlStatement("INSERT INTO api_vitals_data(reading_time,reading_date,distance_data,steps_data,api_type,pid) VALUES (?,?,?,?,?,?)",array($reading_time3,$reading_date3,$distance_data,$steps_data,'googlefit',$pid));
                   // $sql_update2         = "UPDATE api_vitals_data SET reading_time=?,reading_date=?,distance_data=?,steps_data=?,api_type=?,pid=? where id=?";
                    //sqlStatement($sql_update2, array($reading_time3,$reading_date3,$distance_data,$steps_data,'googlefit',$pid,$id2));

                }
            }
        }
        echo 'googlefit1:<br>'.json_encode($datas1);
    }

    
}
else{
  echo "<br> Googlefit not connected";
}


?>
