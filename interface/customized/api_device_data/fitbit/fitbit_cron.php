<?php

$ignoreAuth = true;
$sessionAllowWrite = true;
require_once("../../../globals.php");
require_once($GLOBALS['srcdir'] . '/encounter_events.inc.php');
require_once($GLOBALS["srcdir"] . "/forms.inc");

$fitbit_array=[];
$terra_dev_id=isset($GLOBALS['terra_devid'])?$GLOBALS['terra_devid']:'refresh-health-dev-4kHfmQNvOw';
$terra_api_key=isset($GLOBALS['terra_api_key'])?$GLOBALS['terra_api_key']:'c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1';
$fitbit_data=sqlStatement("SELECT tf.*,CONCAT(pd.fname, ' ', pd.lname) as patient_name,pd.pid as pid FROM terra_fitit as tf left join patient_data as pd ON tf.pid=pd.pid WHERE tf.status=1");
while ($results = sqlFetchArray($fitbit_data)) {
    array_push($fitbit_array, $results);
  }
  //echo '<pre>';print_r($omron_array);exit();
if(!empty($fitbit_array)){
    foreach($fitbit_array as $value)
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
                if(!empty($datas))
                {
                    foreach($datas as $key=>$values)
                    {
                        $mesure=$values['measurements_data']['measurements'];
                                    
                          if(!empty($mesure))
                          {
                            foreach($mesure as $key=>$mesurevalues)
                            {
                                date_default_timezone_set('US/Eastern');                  
                                $mesurevalues['measurement_time']=substr($mesurevalues['measurement_time'], 0, -9);                    
                                $reading_time_weight=date('Y-m-d H:i:s', strtotime($mesurevalues['measurement_time']. ' - 4 hours'));
                                $reading_date_weight=date('Y-m-d', strtotime($mesurevalues['measurement_time']));
                                $weight=isset($mesurevalues['weight_kg'])?$mesurevalues['weight_kg']:NULL;
                                $bmr=isset($mesurevalues['BMR'])?$mesurevalues['BMR']:NULL;
                                $height=isset($mesurevalues['height_cm'])?$mesurevalues['height_cm']:NULL;
                                    $sql_reading = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time_weight."' AND pid='$pid' AND api_type='fitbit_api'");
                                $id=isset($sql_reading['id'])?$sql_reading['id']:'';                                
                                if($id=='')
                                {
                                   sqlStatement("INSERT INTO api_vitals_data(reading_time,weight_kg,api_type,pid,reading_date,bmr,height_cm) VALUES (?,?,?,?,?,?,?)",array($reading_time_weight,$weight,'fitbit_api',$pid,$reading_date_weight,$bmr,$height));
                    
                                }
                                else{                   
                                    sqlStatement("UPDATE api_vitals_data SET reading_time=?,weight_kg=?,bmr=?,height_cm=?,api_type=?,pid=?,reading_date=? where id=?", array($reading_time_weight,$weight,$bmr,$height,'fitbit_api',$pid,$reading_date_weight,$id));
                                }
                            }
                            echo 'Mesurement  data for patient '.$patient_name.' : <pre>';print_r($mesure).'<br>';
                        }
                        else{
                            echo 'no Mesurement data for patient '.$patient_name.'<br>';
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
            
            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
            CURLOPT_URL => 'https://api.tryterra.co/v2/daily?user_id='.$user_id.'&start_date='.$startdate.'&end_date='.$today_date.'&to_webhook=false&with_samples=true',
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
                 // echo '<pre>';print_r($datas1);exit();
                  for($i=0;$i<=count($datas1);$i++)
                  {
                    $distance_data= $datas1[$i]['distance_data']['distance_meters']?$datas1[$i]['distance_data']['distance_meters']:NULL;
                    $steps_data= $datas1[$i]['distance_data']['steps']?$datas1[$i]['distance_data']['steps']:NULL;
                    $distance_steps_data= $datas1[$i]['distance_data']['detailed']['step_samples'];
                    $calories_data=$datas1[$i]['calories_data']['calorie_samples'];
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
                             
                      if(!empty($calories_data))
                      {
                          foreach($calories_data as $key=>$values1)
                          {
                              date_default_timezone_set('US/Eastern');
                              $reading_time1       =date('Y-m-d H:i:s', strtotime($values1['timestamp']));
                              $reading_date1      =date('Y-m-d', strtotime($values1['timestamp']));
                              $calories_reading   = $values1['calories']?$values1['calories']:NULL;
                              $sql_reading1    = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time1."' AND pid='$pid' AND api_type='fitbit_api' AND calories_reading='".$calories_reading."'");
                              $id1=isset($sql_reading1['id'])?$sql_reading1['id']:'';
                              if(empty($id1))
                              {
                                sqlStatement("INSERT INTO api_vitals_data(reading_time,calories_reading,api_type,pid,reading_date) VALUES (?,?,?,?,?)",array($reading_time1,$calories_reading,'fitbit_api',$pid,$reading_date1));
                                  // $sql_update1         = "UPDATE api_vitals_data SET reading_time=?,calories_reading=?,api_type=?,pid=?,reading_date=? where id=?";
                                  // sqlStatement($sql_update1, array($reading_time1,$calories_reading,'googlefit',$pid,$reading_date1,$id1));
          
                              }
                          }
                      }
        
          
                      if(!empty($distance_data)||!empty($step_data))
                      {
                          $sql_reading2        = sqlQuery("SELECT * FROM api_vitals_data WHERE pid='$pid' AND api_type='fitbit_api' AND distance_data='".$distance_data."' AND steps_data='".$steps_data."'");
                          $id2=isset($sql_reading2['id'])?$sql_reading2['id']:'';
                          if(empty($id2))
                          {
                            sqlStatement("INSERT INTO api_vitals_data(reading_time,reading_date,distance_data,steps_data,api_type,pid) VALUES (?,?,?,?,?,?)",array($reading_time3,$reading_date3,$distance_data,$steps_data,'fitbit_api',$pid));
                             // $sql_update2         = "UPDATE api_vitals_data SET reading_time=?,reading_date=?,distance_data=?,steps_data=?,api_type=?,pid=? where id=?";
                              //sqlStatement($sql_update2, array($reading_time3,$reading_date3,$distance_data,$steps_data,'googlefit',$pid,$id2));
          
                          }
                      }
                  }
                  echo 'fitbit Activity data :<br>'.json_encode($datas1);
              }
        }
        echo "**********************************************************************";
    }
}
  
?>