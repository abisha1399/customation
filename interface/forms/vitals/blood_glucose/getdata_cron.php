<?php
$ignoreAuth = true;
require_once("../../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
use OpenEMR\Common\Csrf\CsrfUtils;
$patient_result=[];
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
                  $date = date("Y-m-d h:i:s");                
                  $begin_date = strtotime('-1 hours', strtotime($date));                
                  $end_date = strtotime($date);                
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
//echo '<pre>';print_r($patient_result);exit();





?>