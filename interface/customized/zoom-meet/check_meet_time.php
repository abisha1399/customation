<?php


//$current_time=date("H:i");
date_default_timezone_set('Asia/Kolkata');
$current_time=date('H:i');
$current_date=date("Y-m-d");
$app_time=$_POST['start_time'];
$app_date= $_POST['start_date'];
// print_r($app_date);
// die;

if($current_date == $app_date)
{
    if($current_time >= $app_time)
    {
        
        echo 'true';
    }
    else{
        echo 'You can Host your appointment only at '.$app_time;
    }
}
else{
    echo 'You can Host your appointment only at '.$app_time;
}
die;


?>