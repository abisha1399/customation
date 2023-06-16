<?php
require_once("../../globals.php");

$device_type=isset($_GET['device_type'])?$_GET['device_type']:'';
$pid=isset($_SESSION['pid'])?$_SESSION['pid']:'';
$terra_dev_id=isset($GLOBALS['terra_devid'])?$GLOBALS['terra_devid']:'refresh-health-dev-4kHfmQNvOw';
$terra_api_key=isset($GLOBALS['terra_api_key'])?$GLOBALS['terra_api_key']:'c451fb54fe6fd1584f99445d241c9fdb92b6d9b0037aeca38552cc3991a37cb1';
if($device_type=='libre')
{
  //check user authorized or not
  $sql_data = sqlQuery("SELECT * FROM terra_user WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1");
  $userid=$sql_data['user_id'];
  $status=isset($sql_data['status'])?$sql_data['status']:0;
  
  if($status==1){
    echo '1';
    exit();
  }
  //echo $userid;exit;
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.tryterra.co/v2/body?user_id='.$userid.'&start_date=2022-11-20&to_webhook=false&with_samples=true',
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
  // echo $response;
  $my_data = json_decode($response,true);
  $status= $my_data['status'];
  // echo $status;exit;
  if($status=="success"){
    echo "1";
    $sql_update= "UPDATE terra_user SET status=? where pid=?";
    sqlStatement($sql_update, array(1,$pid));
  }else{
    echo "2";
  }
  exit();

}
if($device_type=='googlefit')
{
  //check user authorized or not
  $sql_data = sqlQuery("SELECT * FROM terra_googlefit WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1");
  $userid=$sql_data['user_id'];
  $status=isset($sql_data['status'])?$sql_data['status']:0;  
  if($status==1)
  {
    echo '1';
    exit();
  }
  //echo $userid;exit;
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.tryterra.co/v2/body?user_id='.$userid.'&start_date=2022-11-20&to_webhook=false&with_samples=true',
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
  // echo $response;
  $my_data = json_decode($response,true);
  $status= $my_data['status'];
  // echo $status;exit;
  if($status=="success")
  {
    echo "1";
    $sql_update= "UPDATE terra_googlefit SET status=? where pid=?";
    sqlStatement($sql_update, array(1,$pid));
  }
  else{
    echo "2";
  }
  exit();
} 
if($device_type=='dexcom')
{
  //check user authorized or not
  $sql_data = sqlQuery("SELECT * FROM dexcom_token WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1");
  $status=isset($sql_data['status'])?$sql_data['status']:0;
  
  if($status){
    echo "1";
    
  }else{
    echo "2";
  }
  exit();

} 
if($device_type=='marsonik')
{
  //check user authorized or not
  $sql_data = sqlQuery("SELECT * FROM patient_data WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1");
  $status=isset($sql_data['marsonik_status'])?$sql_data['marsonik_status']:0;
  
  if($status){
    echo "1";
    
  }else{
    echo "2";
  }
  exit();

}
if($device_type=='omron')
{
  
    //check user authorized or not
    $sql_data = sqlQuery("SELECT * FROM omron_token WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1");
    $userid=$sql_data['user_id'];
    $status=isset($sql_data['status'])?$sql_data['status']:0;
    
    if($status==1){
      echo '1';
      exit();
    }
    //echo $userid;exit;
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.tryterra.co/v2/body?user_id='.$userid.'&start_date=2022-11-20&to_webhook=false&with_samples=true',
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
    // echo $response;
    $my_data = json_decode($response,true);
    $status= $my_data['status'];
    // echo $status;exit;
    if($status=="success"){
      echo "1";
      $sql_update= "UPDATE omron_token SET status=? where pid=?";
      sqlStatement($sql_update, array(1,$pid));
    }else{
      echo "2";
    }
    exit();

} 

if($device_type=='fitbit')
{
    //check user authorized or not
    $sql_data = sqlQuery("SELECT * FROM terra_fitbit WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1");
    $userid=$sql_data['user_id'];
    $status=isset($sql_data['status'])?$sql_data['status']:0;
    
    if($status==1){
      echo '1';
      exit();
    }
    //echo $userid;exit;
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.tryterra.co/v2/body?user_id='.$userid.'&start_date=2022-11-20&to_webhook=false&with_samples=true',
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
    // echo $response;
    $my_data = json_decode($response,true);
    $status= $my_data['status'];
    // echo $status;exit;
    if($status=="success"){
      echo "1";
      $sql_update= "UPDATE terra_fitbit SET status=? where pid=?";
      sqlStatement($sql_update, array(1,$pid));
    }else{
      echo "2";
    }
    exit();

} 
?>