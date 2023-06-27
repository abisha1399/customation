
<?php
require_once("../../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

use OpenEMR\Common\Csrf\CsrfUtils;

// if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
//     CsrfUtils::csrfNotVerified();
// }



$token1=$_GET['token'];
$flag=$_GET['flag'];
date_default_timezone_set("America/New_York");
$date = date("Y-m-d h:i:s");

if($flag == "24")
{
  $begin_date = strtotime('-24 hour', strtotime($date));
}
else if ($flag == "48") {
  $begin_date = strtotime('-48 hour', strtotime($date));
}



$end_date = strtotime($date);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://developer.ambrosiasys.com/app/readings?begin_date='.$begin_date.'&end_date='.$end_date.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$headers = array();
$headers[] = 'authorization: '.$token1.'';
$headers[] = 'Cache-Control: no-cache';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

$res=explode('{',$result);
    unset($res[0]);
    unset($res[1]);

    if (in_array('}', $res)) 
    {
        unset($res[array_search('}',$res)]);
    }
    

    // echo '<pre>';
    // print_r($res);
    $reading_time = array();
    $reading = array();
   foreach($res as $val){
    $val=explode(',',$val);
    //echo '<pre>';
    //print_r($val[1]);
    $str_arr = explode (":", $val[1]); 

    $reading_time_date= str_replace("}","",$str_arr[1]);
    $reading_time_date= str_replace("]","",$reading_time_date);
    $reading_time_date = trim($reading_time_date);


    $str_arr1 = explode (":", $val[0]); 

  
    $reading_data = trim($str_arr1[1]);

    $myValue=trim($reading_time_date, '"');
    $myValue = substr($myValue,0,-3);
    $date =date($myValue);
   // echo date('Y-m-d h:i:s',  (int)$date);

   $reading_time[] = date('Y-m-d H:i:s',  (int)$date);
   $reading[] = $reading_data;

   }
   //print_r($reading_time);
  // print_r($reading);
  $reading = str_replace('"', '', $reading);

  if(!empty($reading_time))
  {
   $max = max(array_map('strtotime', $reading_time));
   $max_date= date('Y-m-d H:i:s', $max);
   $index = array_search($max_date,array_values($reading_time));
   //echo $reading[$index];
  //  $glucose_val=$reading[$index];
  //  $glucose_val = trim($glucose_val, '"');

  $totle = array_sum($reading);
  
  $count_tol = count($reading);

 $avarage = $totle/$count_tol;

 $avarage = round($avarage);
 //echo  $avarage;
$date = date("Y-m-d");


//echo $date;
 $result12 = sqlQuery("SELECT * FROM glucose_level  WHERE date=? and pid=?", array($date,$pid));
   if($result12)
   {
    $id = $result12['id'];
    $sql_fac_up = "UPDATE glucose_level SET datetime=?,avarage=? where id=?";
    sqlStatement($sql_fac_up, array(
    $max_date,
    $avarage,
    $id
    ));
    
   }
   else {
    $sql3 = " INSERT INTO glucose_level SET";
    $sql3 .= "     datetime=?,";
    $sql3 .= "     avarage=?,";
    $sql3 .= "     pid=?,";
    $sql3 .= "     date=?";
    $newid = sqlInsert(
      $sql3,
      array($max_date,$avarage, $pid,$date)
    );
   }
   echo json_encode(array('msg' => "success",'glucose'=>$avarage));
  }
  else {
    echo json_encode(array('msg' => "error",'glucose'=>''));
  }		 
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
?>

