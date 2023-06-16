<?php
require_once("../../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

//$patientid='4';
use OpenEMR\Common\Csrf\CsrfUtils;
$pid=isset($_SESSION['pid'])?$_SESSION['pid']:'';
$result = sqlQuery("SELECT * FROM  terra_user  WHERE  pid=? AND status=?", array($pid,1));
$user_id=$result['user_id'];
// if(isset($pid) && $patientid =='4'){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.tryterra.co/v2/body?user_id='.$user_id.'&start_date=2022-11-20&end_date=2022-12-08&to_webhook=false&with_samples=true',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'dev-id: testingTerra',
    'x-api-key: ussv5SAQ53a1nNTxsMr9G41zj2KUhYMk5eDU1hjG'
  ),
));

$response = curl_exec($curl);
curl_close($curl);

$my_array_data = json_decode($response,true);
$datas= $my_array_data['data'];
//ksort($datas);

$output=array();

 $counting=count($datas)-1;

for($i=$counting;$i>=0;$i--){
 
 $glucose_data=$datas[$i]['glucose_data']['blood_glucose_samples'];
 
foreach($glucose_data as $key=>$values){ 
  $row=array();
   $reading_time       = date('Y-m-d H:i:s', strtotime($values['timestamp']));
   $reading_date       = date('Y-m-d', strtotime($values['timestamp']));
   $row['reading_time']=$reading_time;
   $row['reading_date']=$reading_date;
   $output=$row;
}

$avg_data=$datas[$i]['glucose_data']['day_avg_blood_glucose_mg_per_dL'];
$glucose_avg_data=round($avg_data);
 $date=$output['reading_date'];
$datetime=$output['reading_time'];
$sql_reading   = sqlQuery("SELECT * FROM glucose_level WHERE date='".$date."' AND pid='$pid'");
$id=isset($sql_reading['id'])?$sql_reading['id']:'';
if(!empty($id))
{
 $sql_update= "UPDATE glucose_level SET datetime=?,date=?,avarage=?,pid=? where id=?";
 sqlStatement($sql_update, array($datetime,$date,$glucose_avg_data,$pid,$id));
 
}
else{
    sqlStatement("INSERT INTO glucose_level(datetime,date,avarage,pid) VALUES (?,?,?,?)",array($datetime,$date,$glucose_avg_data,$pid));
    
}
}
  
   //}
?>
