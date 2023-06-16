<?php

 $ignoreAuth = true;
 $sessionAllowWrite = true;
 require_once("../../../globals.php");
$pid=$_SESSION['pid'];
if(isset($_GET['pid'])){
    $pid=isset($_GET['pid'])?$_GET['pid']:'';
}
$tenovi_data=sqlStatement("SELECT * FROM tenovi_data WHERE hwi_id!='' AND pid=".$pid."");
$tenovi_data_count=sqlNumRows($tenovi_data);
$startdate = date(("Y-m-d")).'T'.date('H:i:s', strtotime(' -1 hours')).'Z';
$startdate='2023-02-18T20:00:00Z';
if($tenovi_data_count>0)
{
    $result=[];
    while ($results = sqlFetchArray($tenovi_data))
    {
        $device_id= $results['hwi_id'];
        $url = "https://api2.tenovi.com/clients/capminds/hwi/hwi-devices/$device_id/measurements/?timestamp__gte=".$startdate."";       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //f6d52f7f-586e-404b-84b7-27aa269c3c5
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'authorization: Api-Key XF6mCmsQ.PgoTAFeKBpfSiiTBfR3XOm3O2MtMf1B7';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $res=json_decode($result,TRUE);
        $all_measurement_data[]=$res;
        
        
    }
   
    if(!empty($all_measurement_data))
        {
            foreach($all_measurement_data as $tenoviresult_all){
                if(!empty($tenoviresult_all))
                {
                    foreach($tenoviresult_all as $tenoviresult)
                    {
                        if(!empty($tenoviresult))
                        {
                            $metric=isset($tenoviresult['metric'])?$tenoviresult['metric']:'';                
                            if($metric=='blood_pressure')
                            {
                                $systolic=round($tenoviresult['value_1']);
                                $dystolic=round($tenoviresult['value_2']);
    
                            }
                            if($metric=='pulse'){
                                $pulse=round($tenoviresult['value_1']);
                            }
                            if($metric=='weight'){
                                $weight=round($tenoviresult['value_1']);
                            }
                            if($metric=='glucose'){
                                $blood_glucose=round($tenoviresult['value_1']);
                            }
                            if($metric=='spo2'){
                                $spo2=round($tenoviresult['value_1']);
                            }
                            $reading_time=date('Y-m-d H:i:s', strtotime($tenoviresult['timestamp']. ' - 4 hours'));
                            $reading_date=date('Y-m-d', strtotime($tenoviresult['timestamp']));
                            $sql_reading        = sqlQuery("SELECT * FROM api_vitals_data WHERE reading_time='".$reading_time."' AND pid='$pid' AND api_type='tenovi_api'");
                            $id=isset($sql_reading['id'])?$sql_reading['id']:'';
                            if($id=='')
                            { 
                                sqlStatement("INSERT INTO api_vitals_data(reading_time,pulse,systolic,diastolic,weight_kg,blood_glucose,spo2,api_type,pid,reading_date) VALUES (?,?,?,?,?,?,?,?,?,?)",array($reading_time,$pulse,$systolic,$dystolic,$weight,$blood_glucose,$spo2,'tenovi_api',$pid,$reading_date));
                    
                            }
                            else{
                                sqlStatement("UPDATE api_vitals_data SET reading_time=?,pulse=?,systolic=?,diastolic=?,weight_kg=?,blood_glucose=?,spo2=?,reading_date=? where id=?", array($reading_time,$pulse,$systolic,$dystolic,$weight,$blood_glucose,$spo2,$reading_date,$id));
    
                            }

                        }

                       

                    }
                }
                
            }
            echo 'tenovi data : <br>'.'<pre>';print_r($all_measurement_data);
            

        }
        else{
            echo 'No data <br>';
        }

}
else{
    echo "No device to get data";
}

?>