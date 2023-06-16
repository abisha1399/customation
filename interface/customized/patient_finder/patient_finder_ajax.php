<?php
require_once("../../globals.php");
//ini_set('display_errors',true);
require_once "$srcdir/user.inc";
require_once "$srcdir/options.inc.php";

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
use OpenEMR\OeUI\OemrUI;
use OpenEMR\Common\Crypto\CryptoGen;
require '../../customized/PHPMailerAutoload1.php';
/**single patient */
function reading_text($count){
    $text='Reading';
    if($count==1){
        $text="Reading";
    }
    if($count > 1){
        $text="Readings";
    }
    return $text;
}
function day_convert($day){
    //echo $day;exit();
    if($day == 'Sun')
    { 
       $date= 'Sunday';
    }
    if($day == 'Mon')
    { 
       $date= 'Monday';
    }
    if($day == 'Tue')
    { 
       $date= 'Tuesday';
    }
    if($day == 'Wed')
    { 
       $date= 'Wednesday';
    }
    if($day == 'Thu')
    { 
       $date= 'Thursday';
    }
    if($day == 'Fri')
    { 
       $date= 'Friday';
    }
    if($day == 'Sat')
    { 
       $date= 'Saturday';
    }
    return $date;
 } 
 function color_change($systolic,$diastolic){
            
    if($systolic>=120 && $systolic<=129 || $diastolic<80 ){
        $color='#748724';
    }
    if($systolic>=130 && $systolic<=139 || $diastolic>80 && $diastolic<=89){
        $color='#d96614f5';
    }
    if($systolic>=140 && $systolic<=179 || $diastolic>=90 && $diastolic<=119){
        $color='#ed1b1bf0';
    }
   if($systolic>=180 || $diastolic>=120){
        $color='#8B0000'; 
    }
    if($systolic<120 && $diastolic<80) 
    {
         $color='#0c7442';
    } 
        return $color;   
    }
if(isset($_GET['single_patient_detail'])){
    $result=[];
    $pid=isset($_POST['pid'])?$_POST['pid']:'';
    if($pid!=''){
        $pat_details=sqlQuery("SELECT * FROM patient_data WHERE pid=?",array($pid));
        $pat_name=$pat_details['fname'].' '.$pat_details['lname'];    
        $sing_pat_result=glucose_data($pid);
        $card_data=card_data($pid,$pat_name);
        $result['status']='success';
        $result['vitals_data']=$sing_pat_result;
        $result['card_data']=$card_data;
        echo json_encode($result);
    }
    exit();
}
/*report start */
if(isset($_GET['get_data'])){
    $pid=$_POST['pid'];
    //echo '<pre>';print_r($_POST);
    $end_date=date('Y-m-d');
    $start_date=date('Y-m-d', strtotime($end_date .'- 7 days'));
    
    $patient_data=sqlQuery("SELECT * FROM patient_data WHERE pid=".$pid."");
    
    $patient_name=$patient_data['fname'].' '.$patient_data['lname'];
    $dob='';
    if(isset($patient_data['DOB'])){
        $dob=date('F d', strtotime($patient_data['DOB'])).','.date('Y', strtotime($patient_data['DOB']));
    }
    $start_date_day=day_convert(date('D',strtotime($start_date)));
    $end_date_day=day_convert(date('D',strtotime($end_date)));
    //$report_date='';
    $report_date=date('F d ',strtotime($start_date)).' ('.$start_date_day.') '.date('Y',strtotime($start_date)).'  - '.date('F d',strtotime($end_date)).' ('.$end_date_day.') '.date('Y',strtotime($end_date));
    
    if(date('Y',strtotime($start_date))==date('Y',strtotime($end_date))){
      $report_date=date('F d ',strtotime($start_date)).' ('.$start_date_day.') - '.date('F d',strtotime($end_date)).' ('.$end_date_day.') , '.date('Y',strtotime($start_date));
    }
    
    $error_count=0;
       $report_name='Blood Pressure';  
        $total_avg=sqlQuery("SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic, count(id) as id FROM api_vitals_data WHERE pid=".$pid." AND systolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."'");
         
        // echo '<pre>';print_r($total_avg);exit();
        if(isset($total_avg['systolic'])!='')
        {
            
            
            $overal_avg=round($total_avg['systolic']).'/'.round($total_avg['diastolic']);
            $systolic=$total_avg['systolic'];
            $dyslitic=$total_avg['diastolic'];
            // $systolic=200;
            // $dyslitic=80;
            $overal_avg_color=color_change($systolic,$dyslitic);
            $overal_avg_count=$total_avg['id'];    
                 
            $max_sys=sqlQuery("SELECT  MAX(CAST(systolic AS SIGNED)) as systolic,reading_time FROM api_vitals_data WHERE pid=".$pid." AND systolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND systolic=(select MAX(CAST(systolic AS SIGNED)) as systolic from api_vitals_data WHERE pid=".$pid." AND systolic!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            $max_dys=sqlQuery("SELECT  MAX(CAST(diastolic AS SIGNED))  as diastolic,reading_time FROM api_vitals_data WHERE pid=".$pid." AND diastolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND diastolic=(select MAX(CAST(diastolic AS SIGNED)) as diastolic from api_vitals_data WHERE pid=".$pid." AND diastolic!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            $min_sys=sqlQuery("SELECT MIN(CAST(systolic AS SIGNED)) as systolic,reading_time FROM api_vitals_data WHERE pid=".$pid." AND systolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND systolic=(select MIN(CAST(systolic AS SIGNED)) as systolic from api_vitals_data WHERE pid=".$pid." AND systolic!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            $min_dys=sqlQuery("SELECT MIN(CAST(diastolic AS SIGNED)) as diastolic ,reading_time FROM api_vitals_data WHERE pid=".$pid." AND diastolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND diastolic=(select MIN(CAST(diastolic AS SIGNED)) as diastolic from api_vitals_data WHERE pid=".$pid." AND diastolic!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            
            
            
            $day_avg=sqlQuery("SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic, count(id) as id FROM api_vitals_data WHERE time(reading_time)>='06:00:00' and time(reading_time)<='21:00:00 ' AND pid='".$pid."' AND systolic!=0 AND reading_date BETWEEN '".$start_date."' and '".$end_date."'");
            // echo "SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic, count(id) as id FROM api_vitals_data WHERE time(reading_time)>='06:00:00' and time(reading_time)<='21:00:00 ' AND pid='".$pid."' AND systolic!=0 AND reading_date BETWEEN '".$start_date."' and '".$end_date."'";
            // exit();
            $total_day_avg=isset($day_avg['systolic'])&&$day_avg['systolic']!=NULL?round($day_avg['systolic']).'/'.round($day_avg['diastolic']):0;
            $day_avg_color=color_change($day_avg['systolic'],$day_avg['diastolic']);
            $total_day_avg_count=$day_avg['id']&&$day_avg['id']!=NULL?$day_avg['id']:0;

            $night_avg=sqlQuery("SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic, count(id) as id FROM api_vitals_data WHERE id NOT IN(SELECT id FROM api_vitals_data WHERE time(reading_time)>='06:00:00' and time(reading_time)<='21:00:00 ' AND pid='".$pid."' AND systolic!=0 AND  reading_date BETWEEN '".$start_date."' and '".$end_date."')AND pid='".$pid."' AND systolic!=0 AND  reading_date BETWEEN '".$start_date."' and '".$end_date."'");
            $total_night_avg=isset($night_avg['systolic'])&&$night_avg['systolic']!=NULL?round($night_avg['systolic']).'/'.round($night_avg['diastolic']):0;
         
            $total_night_avg_count=isset($night_avg['id'])&&$night_avg['id']!=NULL?$night_avg['id']:0;
            $night_avg_color=color_change($night_avg['systolic'],$night_avg['diastolic']);
            $total_avg1=sqlQuery("SELECT AVG(pulse) as pulse,count(id) as id FROM api_vitals_data WHERE pid=".$pid." AND pulse!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."'");
            $overal_avg1=round($total_avg1['pulse']);
            $overal_avg1_count=$total_avg1['id'];

            $max_pulse=sqlQuery("SELECT MAX(CAST(pulse AS SIGNED)) as pulse,reading_time FROM api_vitals_data WHERE pid=".$pid." AND pulse!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND pulse=(select MAX(CAST(pulse AS SIGNED)) as pulse from api_vitals_data WHERE pid=".$pid." AND pulse!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            $min_pulse=sqlQuery("SELECT MIN(CAST(pulse AS SIGNED)) as pulse,reading_time FROM api_vitals_data WHERE pid=".$pid." AND pulse!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND pulse=(select MIN(CAST(pulse AS SIGNED)) as pulse from api_vitals_data WHERE pid=".$pid." AND pulse!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            //echo "SELECT MIN(CAST(pulse AS SIGNED)) as pulse,reading_time FROM api_vitals_data WHERE pid=".$pid." AND pulse!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."'";
            $max_pulse_time=isset($max_pulse['reading_time'])?date('m-d-Y h:i A',strtotime($max_pulse['reading_time'])):'';
            $min_pulse_time=isset($min_pulse['reading_time'])?date('m-d-Y h:i A',strtotime($min_pulse['reading_time'])):'';

            $maxsys=isset($max_sys['systolic'])?$max_sys['systolic']:'';
            $max_sys_time=isset($max_sys['reading_time'])?date('m-d-Y h:i A',strtotime($max_sys['reading_time'])):'';
            $maxdys=isset($max_dys['diastolic'])?$max_dys['diastolic']:'';
            $max_dys_time=isset($max_dys['reading_time'])?date('m-d-Y h:i A',strtotime($max_dys['reading_time'])):'';
            $min1=isset($min_sys['systolic'])?$min_sys['systolic']:'';
            $min_sys_time=isset($min_sys['reading_time'])?date('m-d-Y h:i A',strtotime($min_sys['reading_time'])):'';
            $min2=isset($min_dys['diastolic'])?$min_dys['diastolic']:'';
            $min_dys_time=isset($min_dys['reading_time'])?date('m-d-Y h:i A',strtotime($min_dys['reading_time'])):'';
            
            $day_avg1=sqlQuery("SELECT AVG(pulse) as pulse,count(id) as id FROM api_vitals_data WHERE time(reading_time)>='06:00:00' and time(reading_time)<='21:00:00 ' AND pid='".$pid."' AND pulse!=0 AND reading_date BETWEEN '".$start_date."' and '".$end_date."'");
            //echo "SELECT AVG(pulse) as pulse,count(id) as id FROM api_vitals_data WHERE time(reading_time)>='06:00:00' and time(reading_time)<='21:00:00 ' AND pid='".$pid."' AND pulse!=0 AND reading_date BETWEEN '".$start_date."' and '".$end_date."'";exit();
            $total_day_avg1=isset($day_avg1['pulse'])&&$day_avg1['pulse']!=NULL?round($day_avg1['pulse']):0;
            $total_day_avg_count1=$day_avg1['id']&&$day_avg1['id']!=NULL?$day_avg1['id']:0;

            $night_avg1=sqlQuery("SELECT AVG(pulse) as pulse,count(id) as id FROM api_vitals_data WHERE id NOT IN(SELECT id FROM api_vitals_data WHERE time(reading_time)>='06:00:00' and time(reading_time)<='21:00:00 ' AND pid='".$pid."' AND pulse!=0 AND  reading_date BETWEEN '".$start_date."' and '".$end_date."')AND pid='".$pid."' AND pulse!=0 AND  reading_date BETWEEN '".$start_date."' and '".$end_date."'");
            $total_night_avg1=isset($night_avg1['pulse'])&&$night_avg1['pulse']!=NULL?round($night_avg1['pulse']):0;
            $total_night_avg_count1=isset($night_avg1['id'])&&$night_avg1['id']!=NULL?$night_avg1['id']:0;


            $overal_avg_text=reading_text($overal_avg_count);
            $day_avg_text=reading_text($total_day_avg_count);
            $night_avg_text=reading_text($total_night_avg_count);
            $overal_avg_text1=reading_text($overal_avg1_count);
            $day_avg_text1=reading_text($total_day_avg_count1);
            $night_avg_text1=reading_text($total_night_avg_count1);

            $list='
            <li class="liclass">Maximum systolic bloood pressure '.$maxsys.' recorded at '.$max_sys_time.'</li>
            <li class="liclass">Maximum diastolic bloood pressure '.$maxdys.' recorded at '.$max_dys_time.'</li>
            <li class="liclass">Minimum systolic bloood pressure '.$min1.' recorded at '.$min_sys_time.'</li>
            <li class="liclass">Minimum diastolic bloood pressure '.$min2.' recorded at '.$min_dys_time.'</li>';

            $list1='
            <li class="liclass">Maximum pulse '.$max_pulse['pulse'].' recorded at '.$max_pulse_time.'</li>            
            <li class="liclass">Minimum pulse '.$min_pulse['pulse'].' recorded at '.$min_pulse_time.'</li>';
           
       
        }
        else{
            
            $error_count++;
        }
   
    if($error_count==0)
    {

        $src=$web_root.'/controller.php?document&retrieve&patient_id='.$pid.'&document_id=-1&as_file=false&original_file=true&disable_exit=false&show_original=true&context=patient_picture';
    $error_src=$GLOBALS['images_static_relative'].'/patient-picture-default.png';
    
    $template=' 
    <div class="main-row">
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <div class="mt-2">
                    <div class="heading_class">Weekly '.$report_name.' Report</div>
                    <div class="dateclass">'.$report_date.'</div>
                    </div>
                </div>  
                <div class="col-5">
                    <div style="float:right">
                        <div style="display:flex;align-items:center">
                            <div class="dateclass p-2">'.$patient_name.'</div>
                            <div id="image_src"><img class="img-thumbnail"  onError=this.setAttribute("src","'.$error_src.'");this.removeAttribute("onError");this.removeAttribute("onclick"); src="'.$src.'"></div>
                        </div>
                        <div class="dateclass1"> '.$dob.'</div>
                        <div class="dateclass1">MRN:'.$pid.' </div>
                    </div>
                </div>    
            </div>
        </div> 
    </div>
    <div class="row mt-3 noprint">
        <div class="col-12">
            <div style="float:right">
                <button class="btn btn-primary btn-print" onclick="printbutton()" style="color: #2C7BE5; background: white;">Print</button>
                <button class="btn btn-primary" style="background: #57BF7F !important;border: #57BF7F !important;" value="'.$pid.'" name="create_pdf" onclick="download_report('.$pid.')"><i class="fa fa-download"></i>&nbsp;&nbsp;Download Report</button>
             </div>        
         </div>
    </div>
    <div class="container mt-3">
        <div class="row headrow">
            <div style="align-items:center">
            <img src="../reports/bp1.png" style="padding:4px; margin-left: 10px;" width="28" height="28">Average Blood pressure
            </div>
        </div>
        <div class="row">
        <div class="col-4">
            <div class="rowcon">
                <div class="inner_head"><div class="inner_head_span">Overall</div></div>
                <div class="avg_span" style="color:'. $overal_avg_color.'">'.$overal_avg.' <span style="font-size:15px" class="ml-2"> mmHg</span></div>
                <div class="count_span">'.$overal_avg_count.' '.$overal_avg_text.'</div>
                
            </div>
        </div>
        <div class="col-4">
            <div class="rowcon">
                <div class="inner_head"><div class="inner_head_span">Day (6am to 10pm)</div></div>';
                if($total_day_avg_count!=0){
                    $template.='<div class="avg_span" style="color:'.$day_avg_color.'">'.$total_day_avg.'<span style="font-size:15px" class="ml-2"> mmHg</span></div>
                    <div class="count_span">'.$total_day_avg_count.' '.$day_avg_text.'</div>';
                }
            else{
                    $template.='<div class="avg_span" align="center"><span style="font-size:20px;margin-top:10px;"><div>No readings were available</div></span></div>';
                    
                }
                
                
                $template.='</div>
        </div>
        <div class="col-4">
            <div class="rowcon">
                <div class="inner_head"><div class="inner_head_span">Night (10pm to 6am)</div></div>';

                // <div class="avg_span">'.$total_night_avg.'</div>
                // <div class="count_span">'.$total_night_avg_count.' reading</div>
                if($total_night_avg_count!=0){
                    $template.='<div class="avg_span" style="color:'.$night_avg_color.'">'.$total_night_avg.'<span style="font-size:15px" class="ml-2"> mmHg</span></div>
                    <div class="count_span">'.$total_night_avg_count.' '.$night_avg_text.'</div>';
                }
            else{
                    $template.='<div class="avg_span" align="center"><span style="font-size:20px;margin-top:10px;">No readings were available</span></div>';
                    
                }
                
            $template.='</div>
        </div>
    </div>
        <div class="row mt-2">
            <div>
                <ul>
                '.$list.'
                </ul>
            
            </div>
        </div>
        <div class="row headrow mt-2">
                <div style="align-items:center">
                <img src="../reports/pulse1.png" style="padding:4px; margin-left: 10px;" width="28" height="28">Average Heart Rate
                </div>
        </div> 
        <div class="row">
        
        <div style="display:flex">
            <div class="secrowspan">
                <div class="inner_head sm_inner_head"  >
                    <div class="inner_head_span">Overall</div>
                </div>
                <div class="avg_span sm_avg_span">'.$overal_avg1.' <span style="font-size:15px" class="ml-2"> bpm</span></div>
                <div class="count_span">'.$overal_avg1_count.' '.$overal_avg_text1.'</div>
            </div>
            <div class="secrowspan">
                <div class="inner_head sm_inner_head"  >
                    <div class="inner_head_span">Day (6am to 10pm)</div>
                </div>';

                if($total_day_avg_count1!=0){
                    $template.='<div class="avg_span sm_avg_span">'.$total_day_avg1.' <span style="font-size:15px" class="ml-2"> bpm</span></div>
                    <div class="count_span">'.$total_day_avg_count1.' '.$day_avg_text1.'</div>';
                }
                else{
                    $template.='<div class="avg_span sm_avg_span" align="center"><span style="font-size:18px;margin-top:10px;">No readings were available</span></div>';
                    
                }
                
            $template.='</div>
            <div class="secrowspan">
                <div class="inner_head sm_inner_head"  >
                    <div class="inner_head_span">Night (10pm to 6am)</div>
                </div>';
                if($total_night_avg_count1!=0){
                    $template.='<div class="avg_span sm_avg_span">'.$total_night_avg1.' <span style="font-size:15px" class="ml-2"> bpm</span></div>
                    <div class="count_span">'.$total_night_avg_count1.' '.$night_avg_text1.'</div>';
                }
                else{
                    $template.='<div class="avg_span sm_avg_span" align="center"><span style="font-size:18px;margin-top:10px;">No readings were available</span></div>';
                    
                }
            $template.='</div>
            <div>
            <ul>
            '. $list1.'
            </ul>  
            </div>
        </div>    
        
        
    </div>
        <div class="row headrow mt-2">
                <div style="align-items:center">
                BP & HR Flowsheet
                </div>
                
        </div>
        <div>
        <div id="left_chart_report" style="width: 100%; height: 500px;"></div>
           
        </div>
    </div> ';
    echo $template;
    exit();

    }
    else{
        $template='<div class="row empty_span"><div>No data</div></div>';
        echo $template;exit();
    }
    
    
   
}

if(isset($_GET['report_graph'])){
    
    $pid=$_POST['pid'];
    $end_date=date('Y-m-d');
    $start_date=date('Y-m-d', strtotime($end_date .'- 7 days'));
   
    $pb_graph=[];
    $query=sqlstatement("select id,reading_date,pulse,systolic,diastolic from api_vitals_data where pid='".$pid."' AND (systolic!='NULL' OR pulse!='NULL' OR diastolic!='NULL' ) AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY reading_date");
    // echo "select id,reading_date,pulse,systolic,diastolic from api_vitals_data where pid='".$pid."' AND (systolic!='NULL' OR pulse!='NULL' OR diastolic!='NULL' ) AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY reading_date";
    $reading_date=[];
    while($res=sqlFetchArray($query)){
    
        $end_date = date('M d', strtotime($res['reading_date']));
        $date=$res['reading_date'];
        $avg_query=sqlQuery("SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic,AVG(pulse) as pulse, count(id) as id FROM api_vitals_data WHERE pid=".$pid." AND systolic!=0 AND reading_date='".$date."'");
         
        $pulse=isset($avg_query['pulse'])?$avg_query['pulse']:'0';
        $systolic=isset($avg_query['systolic'])?$avg_query['systolic']:'0';
        $diastolic=isset($avg_query['diastolic'])?$avg_query['diastolic']:'0';    
        array_push($pb_graph,[$end_date,(int)$pulse,(int)$systolic,(int)$diastolic]);
        
    
    }
    
    echo json_encode($pb_graph);
    exit();
}
/*report end */
function get_time($orgtime){
    date_default_timezone_set('US/Eastern');
    $bp_time=date('Y-m-d',strtotime($orgtime));
    $orgtime1=date('m-d-Y H:i:s',strtotime($orgtime));
    $today_date=date('Y-m-d');
    $yesterday=date('Y-m-d',strtotime("-1 day", strtotime($today_date)));
    $time=$orgtime1;
    
    if($today_date==$bp_time)
    {                            
       $time='today '.date('H:i:s',strtotime($orgtime));
    }
    if($yesterday==$bp_time){                            
        $time='Yesterday '.date('H:i:s',strtotime($orgtime));
    }
    return $time;
                           
}
/**sms start */
if(isset($_GET['sms_message']))
{
    $pid=$_POST['pid'];
    $patient_data=sqlQuery("SELECT * FROM patient_data WHERE pid=?",$pid);
    $patient_name=$patient_data['fname'].' '.$patient_data['lname'];
    //$url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://".$_SERVER['HTTP_HOST']."/interface/constant_form.php?site=".$_SESSION['organisation_name']."&pid=".$pid ."&type=nonportal";
    $key=isset($GLOBALS['short_url_key'])?$GLOBALS['short_url_key']:'';
    $url="www.utils.refresh.health/index?key=".$key."&pid=".$pid ."&type=nonportal"; 
    $userId = $_SESSION['authUserID'] ?$_SESSION['authUserID']:0;
    $provider_detail=sqlQuery("SELECT * FROM users WHERE id=?",array($userId));
    $provider_name='';
    if(!empty($provider_detail))
    {
        $provider_name=$provider_detail['fname'].' '.$provider_detail['lname'];
    } 
    $result=[];
        $email_notification=sqlQuery("SELECT * FROM automatic_notification WHERE notification_type='Ringcentral_sms'");
        $date = date('m/d/Y h:i:s ');
        $message=$email_notification['message'];
        $message= str_replace("***NAME***","".$patient_name."",$message);
        if(isset($GLOBALS['enable_patient_consentfom'])&&$GLOBALS['enable_patient_consentfom']==true){
            $message= str_replace("***CONSENT URL***","".$url."",$message);
        }        
        $message= str_replace("***PROVIDER***","".$provider_name."",$message);
        $message= str_replace("***DATE***","".$date."",$message);
    echo $message;   
    exit();
}
/**sms end */
/**video ring */
if(isset($_GET['video']))
{
    $pid=$_POST['pid'];
    $video=sqlQuery("SELECT * FROM users WHERE id=?",$_SESSION['authUserID']);
    $patient_data=sqlQuery("SELECT * FROM patient_data WHERE pid=?",$pid);
    $url=$video['ringcentral_url']?$video['ringcentral_url']:'981562882';
    $username=$video['username'];
    $email=isset($patient_data["email"])?$patient_data["email"]:'';
    $organization_name=isset($_SESSION['organisation_name'])?trim($_SESSION['organisation_name']):'default';
     
    $regards='Refresh Health';
    
    $orgfrom='Refresh Health';
	if($organization_name =='default'){
		$orgfrom=isset($GLOBALS['patient_reminder_sender_name'])?$GLOBALS['patient_reminder_sender_name']:'Refresh Health';
        
    }
	else{
		$orgfrom=ucfirst($organization_name);
	}
    $regards=$orgfrom;
    if($email!=""){       
    		

    $message = '
    <!DOCTYPE html>
    <html>
    <head>
      <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        td, th {
          text-align: left;
          padding: 8px;
        }
      </style>
    </head>
    <body>
      <h4>Hi '.$patient_data['fname'].''.$patient_data['lname'].',</h4>
      <p>We provide a meeting with <b>'.$video['fname'].' '.$video['lname'].'</b> in
      <p><b> please join meeting url:</b>https://v.ringcentral.com/download/'.$url.'</p>
      <p>Thanks</p>
      <p><b>'.$regards.'</b></p>
    </body>
    </html>        
    ';
    
    //mail utilities
    $ignoreAuth = 1;
    $subject='Join Meeting';
    
    // define('EMAIL','maryabisha1399@gmail.com');
    // define('PASS','xgorwjejzllxrjgz');
    $user_email=isset($GLOBALS['SMTP_USER'])?$GLOBALS['SMTP_USER']:'refreshhealthehr@gmail.com';
    $password=isset($GLOBALS['SMTP_PASS'])?$GLOBALS['SMTP_PASS']:'adynjudkykinmwcm';
    $cryptoGen = new CryptoGen();
    $user_password = $cryptoGen->decryptStandard($password);
    $host=isset($GLOBALS['SMTP_HOST'])?$GLOBALS['SMTP_HOST']:'smtp.gmail.com';
    $port=isset($GLOBALS['SMTP_PORT'])?$GLOBALS['SMTP_PORT']:'587';
    $secure=isset($GLOBALS['SMTP Security Protocol'])?$GLOBALS['SMTP Security Protocol']:'tls';
    		
    $mail = new PHPMailer;
    define('EMAIL',$user_email);
    define('PASS',$user_password);
    // define('EMAIL','info@capminds.com');
    // define('PASS','info12345');
    $to=$email;
    $mail->isSMTP();                                      
    $mail->Host = $host;  
    $mail->SMTPAuth = true;                               
    $mail->Username = EMAIL;                 
    $mail->Password = PASS;                           
    $mail->SMTPSecure = $secure;                            
    $mail->Port =$port;
    $mail->setFrom($user_email, $orgfrom,FALSE);
    $mail->addAddress($to);              
    $mail->addReplyTo($user_email);

    $mail->isHTML(true); 
    $mail->Subject = $subject;
    $mail->Body    = $message;
    
    if($mail->send()){
        $result['status']='success';
        $result['msg']='Mail Successfully Send to Patient';
        $result['url']=$url;
    }

    else{
        $result['status']='error';
        $result['msg']='Something Went wrong!'; 
    }
    }
    else{
        $result['email']='';
    }

echo json_encode($result);
exit();

}
/**email ringcentral */
if(isset($_GET['message']))
{
    $pid=$_POST['pid'];
    $patient_data=sqlQuery("SELECT * FROM patient_data WHERE pid=?",$pid);
    $email=$patient_data['email']?$patient_data['email']:'';
    $patient_name=$patient_data['fname'].' '.$patient_data['lname'];
    $userId = $_SESSION['authUserID'] ?$_SESSION['authUserID']:0;
    //$url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://www.".$_SERVER['HTTP_HOST']."/interface/constant_form.php?site=".$_SESSION['organisation_name']."&pid=".$pid ."&type=nonportal";
    $http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://" . $_SERVER['HTTP_HOST'];
    $url=$http.$GLOBALS['webroot'].'/interface/customized/constant_form.php?pid='.$pid .'&type=nonportal';
    $provider_detail=sqlQuery("SELECT * FROM users WHERE id=?",array($userId));
    $provider_name='';
    if(!empty($provider_detail))
    {
        $provider_name=$provider_detail['fname'].' '.$provider_detail['lname'];
    } 
    $result=[];
    
        $email_notification=sqlQuery("SELECT * FROM automatic_notification WHERE notification_type='Ringcentral_email'");
           
            $message=$email_notification['message'];
            $message= str_replace("***NAME***","".$patient_name."",$message);
            if(isset($GLOBALS['enable_patient_consentfom'])&&$GLOBALS['enable_patient_consentfom']==true){
                $message= str_replace("***CONSENT URL***","".$url."",$message);
            }
            $message= str_replace("***DATE***","".$date."",$message);
            $message= str_replace("***PROVIDER***","".$provider_name."",$message);
           
    echo $message;   
    exit();
}
if(isset($_GET['email_send'])){
    // echo'<pre>';print_r($_GET['email_send']);exit();
    $patient_data=sqlQuery("SELECT * FROM patient_data WHERE pid=?",$pid);
    $email=$patient_data['email']?$patient_data['email']:'';
    $patient_name=$patient_data['fname'].' '.$patient_data['lname'];
    $userId = $_SESSION['authUserID'] ?$_SESSION['authUserID']:0;
    $provider_detail=sqlQuery("SELECT * FROM users WHERE id=?",array($userId));
    $provider_name='';
    if(!empty($provider_detail))
    {
        $provider_name=$provider_detail['fname'].' '.$provider_detail['lname'];
    } 
    $result=[];
    if($email!=''){
        $email_notification=sqlQuery("SELECT * FROM automatic_notification WHERE notification_type='Ringcentral_email'");
        $email_sender=isset($email_notification['email_sender'])?$email_notification['email_sender']:'RefreshEHR';
        //   echo'<pre>';print_r($email_notification);exit();
        if(empty($email_notification)){
            $subject='RefreshEhr Mail';
            $message=$_POST['message'];
           
        }
        else{
            $subject=$email_notification['email_subject'];
            $message=$_POST['message'];            
            
        }
              
        $data=$message;
        $data.='<br><br>Regards,<br>'.$email_sender.'';
        $ignoreAuth = 1;
        $user_email=isset($GLOBALS['SMTP_USER'])?$GLOBALS['SMTP_USER']:'refreshhealthehr@gmail.com';
    $password=isset($GLOBALS['SMTP_PASS'])?$GLOBALS['SMTP_PASS']:'adynjudkykinmwcm';
    $cryptoGen = new CryptoGen();
    $user_password = $cryptoGen->decryptStandard($password);
    $host=isset($GLOBALS['SMTP_HOST'])?$GLOBALS['SMTP_HOST']:'smtp.gmail.com';
    $port=isset($GLOBALS['SMTP_PORT'])?$GLOBALS['SMTP_PORT']:'587';
    $secure=isset($GLOBALS['SMTP Security Protocol'])?$GLOBALS['SMTP Security Protocol']:'tls';
    		
        		
        $mail = new PHPMailer;
        // define('EMAIL','maryabisha1399@gmail.com');
        // define('PASS','xgorwjejzllxrjgz');
        // define('EMAIL','info@capminds.com');
		// define('PASS','info12345');
        define('EMAIL',$user_email);
        define('PASS',$user_password);
        $to=$email;       

        $mail->isSMTP();                                      
        $mail->Host = $host;  
        $mail->SMTPAuth = true;                               
        $mail->Username = EMAIL;                 
        $mail->Password = PASS;                           
        $mail->SMTPSecure = $secure;                            
        $mail->Port =$port;
        $mail->setFrom($user_email, $orgfrom,FALSE);
        $mail->addAddress($to);              
        $mail->addReplyTo($user_email);

        $mail->isHTML(true); 
        $mail->Subject = $subject;
        $mail->Body    = $data;
        if($mail->send()){
            $result['status']='success';
            $result['msg']='Mail Successfully Send to Patient';
        }
        else{
            $result['status']='error';
            $result['msg']='Something Went wrong!'; 
        }
    }
    else{
        $result['status']='error';
        $result['msg']='Petient have no email';
    }
    echo json_encode($result);
    exit();
}
function cminc($cm)
{
    //$cm=round($cm);
    $cm=round((int) $cm);
     $inches =$cm/2.54;
     $inches = $inches%12;
     return $inches;
}
/**patient all data */
if(isset($_GET['graph']))
{
    $pid = $_POST['graph_id'];
    $temp =array();
    $temp1 =array();
    $temp_json="";
    $temp1_json="";
    $query=sqlstatement("select id,reading_date,pulse,systolic,diastolic from api_vitals_data where pid='".$pid."' AND (systolic!='NULL' OR pulse!='NULL' OR diastolic!='NULL' ) and reading_date <=(select max(reading_date) from api_vitals_data where pid='".$pid."') GROUP BY reading_date order by reading_date  desc LIMIT 7");
    $max_arry=[];
    $min_arry=[];
    $gl=sqlstatement("select * from api_vitals_data where pid='".$pid."' AND ( blood_glucose!='NULL') GROUP BY reading_date order by reading_date  desc LIMIT 7");

    while($row=sqlFetchArray($gl))
    {
        $date1=$row['reading_date'];
        $max_val=sqlQuery("select max(blood_glucose) as tig from api_vitals_data WHERE pid=$pid and reading_date='$date1'");
        $min_val=sqlQuery("select min(blood_glucose) as tig from api_vitals_data WHERE pid=$pid and reading_date='$date1'");
        $gl_arry=[];
        $glmax=max($max_val['tig'],$max_val['dexg']);
        $glmin=max($min_val['tig'],$min_val['dexg']);

        $end_date = date('M d', strtotime($date1));
        array_push($temp1,[$end_date , (int)$glmax,(int)$glmin]);
    }

    while($res=sqlFetchArray($query)){
           
            $end_date = date('M d', strtotime($res['reading_date']));
            
            $pulse=isset($res['pulse'])?$res['pulse']:'0';
            $systolic=isset($res['systolic'])?$res['systolic']:'0';
            $diastolic=isset($res['diastolic'])?$res['diastolic']:'0';
            
            array_push($temp,[$end_date,(int)$pulse,(int)$systolic,(int)$diastolic]);

    }
    $temp_json =json_encode($temp);
    $temp1_json =json_encode($temp1); 
    echo $temp_json.'#'.$temp1_json;
    exit;
}
function api_type($api_name){
    $api_type='';
    if($api_name=='omron_api')
    {
      $api_type='Omron';
    }
    if($api_name=='Ambrosiya_api')
    {
      $api_type='Ambrosiya';
    } 
    if($api_name=='tidepull_api')
    {
      $api_type='TidePool';
    }
    if($api_name=='Terra_Api')
    {
      $api_type='LibreFreeStyle';
    }
    if($api_name=='googlefit')
    {
      $api_type='GoogleFit';
    }
    if($api_name=='dexcom_api')
    {
      $api_type='Dexcom';
    }
    if($api_name=='marsonick_api')
    {
      $api_type='MarsoniK';
    }
    if($api_name=='smart_meter_api')
    {
      $api_type='Smart Meter';
    }
    if($api_name=='bodytrace_api')
    {
      $api_type='Body Trace';
    }
    
    return $api_type;
}
function glucose_data($pid){
    $blood_glucose=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND blood_glucose!='') AND blood_glucose!=''");
    
    $glucose_data=isset($blood_glucose['blood_glucose']) ? $blood_glucose['blood_glucose']:''; 
    $glu_api_type=isset($blood_glucose['api_type'])? $blood_glucose['api_type']:'';   
    $glucose_reading_time=isset($blood_glucose['reading_time'])?$blood_glucose['reading_time']:'';   
   
    $glucose_api_type=api_type($glu_api_type);
    
    // blood pressuer
    $blood_pressure=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND systolic!='' AND diastolic!='') AND systolic!='' AND diastolic!=''");
    //echo '<pre>';print_r($blood_pressure);exit();
    $pbs=isset($blood_pressure['systolic']) ? $blood_pressure['systolic']:'';    
    $pbd=isset($blood_pressure['diastolic'])? $blood_pressure['diastolic']:'';    
    $pb_api_type1=isset($blood_pressure['api_type'])? $blood_pressure['api_type']:'';
    $pb_api_type='Smart Meter';
    $pb_api_type=api_type($pb_api_type1);
    
    $bp=$pbs.'/'.$pbd;
    $blood_pressure_time=isset($blood_pressure['reading_time'])?$blood_pressure['reading_time']:'';

    //height
    $height_data=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND height_cm!='') AND height_cm!=''");
    $height_cm=isset($height_data['height_cm'])?$height_data['height_cm']:'';
    $height_inc=cminc($height_cm);
      
      if(!empty($height_inc) || !empty($height_cm)){
        $height=$height_inc.'/'.round($height_cm);
      }
    $height_data_time=isset($height_data['reading_time'])?$height_data['reading_time']:'';

    //weight 
    $weight_kgs=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND weight_kg!='') AND weight_kg!=''");

    $weight_kg=isset($weight_kgs['weight_kg'])?$weight_kgs['weight_kg']:'';
    $weight_api_type=isset($weight_kgs['api_type'])?$weight_kgs['api_type']:'';  
    $weight_api=api_type($weight_api_type);
    $weight_lbs=round((int)$weight_kg)*2.20462262;
   
    // if(!empty($weight_kg) || !empty($weight_lbs)){
    //     $weight=$weight_lbs.'/'.round($weight_kg);
    //   }
    $weight=$weight_lbs;
    $weight_kg_time=isset($weight_kgs['reading_time'])?$weight_kgs['reading_time']:'';

    //pulse
    $pulse_p=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND pulse!='') AND pulse!=''");
    $pulse=isset($pulse_p['pulse'])?$pulse_p['pulse']:'';
    $pulse_p_time=isset($pulse_p['reading_time'])?$pulse_p['reading_time']:'';
    $pulse_api='';    
    $pulse_api=api_type($pulse_p['api_type']);

    //steps
    $steps_s=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND steps_data!='') AND steps_data!=''");
    $steps=isset($steps_s['steps_data'])?$steps_s['steps_data']:'';
    $steps_s_time=isset($steps_s['reading_time'])?$steps_s['reading_time']:''; 

    //disntance
    $distance_data=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND distance_data!='') AND distance_data!=''");
    $distance=isset($distance_data['distance_data'])?$distance_data['distance_data']:'';
    $distance_data_time=isset($distance_data['reading_time'])?$distance_data['reading_time']:''; 

    //calories_reading
    $calories_reading=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND calories_reading!='') AND calories_reading!=''");
    $calories=isset($calories_reading['calories_reading'])?$calories_reading['calories_reading']:'';
    $calories_reading_time=isset($calories_reading['reading_time'])?$calories_reading['reading_time']:'';

    //bmr
    $bmr_r=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND bmr!='') AND bmr!=''");
    $bmr=isset($bmr_r['bmr'])?$bmr_r['bmr']:'';
    $bmr_r_time=isset($bmr_r['reading_time'])?$bmr_r['reading_time']:'';

    //spo2
    $spo2_arr=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND spo2!='') AND spo2!=''");
    $spo2=isset($spo2_arr['spo2'])?$spo2_arr['spo2']:'';
    $spo2_time=isset($spo2_arr['reading_time'])?$spo2_arr['reading_time']:'';    
    $spo2_api_type=isset($spo2_arr['api_type'])?$spo2_arr['api_type']:'';
    $spo2_api='Smart Meter';
   
    $spo2_api=api_type($spo2_api_type);

    $result='';
    $height='';
    if(!empty($glucose_data)||!empty($pulse)|| !empty($pbs) || !empty($height_cm) || !empty($weight_kg) || !empty($bmr) || !empty($distance) || !empty($steps) || !empty($calories)||!empty($spo2))
    {
        $array_data=[];
        if($pbs)
        {
            $bp1['pb']=$bp;
             $time=get_time($blood_pressure_time);
            $bp1['time']=$time;
            $bp1['pbs']=$pbs;
            $array_data['pb'][]=$bp1;                     
        }
        if($pulse){
            $pulses['pulse']=$pulse;
            $time1=get_time($pulse_p_time);
            $pulses['time']=$time1;
            $array_data['pulse'][]=$pulses;
        
        }
        if($weight)
        {
            $weights['weight']=$weight;
            $time2=get_time($weight_kg_time);
            $weights['time']=$time2;
            $array_data['weight'][]=$weights;
        }
        if($spo2)
        {
            $spo2_arr1['spo2']=$spo2;
            $time4=get_time($spo2_time);                        
            $spo2_arr1['time']=$time4;
            $array_data['spo2'][]=$spo2_arr1;
        
        }
        if($glucose_data)
        {
            $glucose['glucose']=$glucose_data;
            $time3=get_time($glucose_reading_time);                        
            $glucose['time']=$time3;
            $array_data['glucose'][]=$glucose;
                    
        }
        
                   
                
                    
        $result.='
        <div>
            <div class="container container-new">
                <div id="testimonial'.$pid.'" class="testimonialtest carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x" data-ride="carousel" data-pause="hover" data-interval="false" data-duration="2000" onmouseover="display_modal('.$pid.')" >
                                                                    
                    <div class="carousel-inner cls-w" role="listbox" style="border-radius: 10px;" >
                        <div class="carousel-item active">
                            <div class="row">';
                                $api_data='';
                                $count=0;
                                foreach($array_data as $key=>$value)
                                {
                                    $count++;
                                    if(isset($array_data[$key][0]['pb']))
                                    { 
                                                      
                                        $pb=$array_data[$key][0]['pb'];
                                        $pbs=$array_data[$key][0]['pbs'];
                                        if($pbs>120){
                                            $color='#FFB323';
                                        }
                                        else if($pbs<120){
                                            $color='#FF4038';
                                        }
                                        else{
                                            $color='#30DA88';
                                        }
                                        $dates=$value[0]['time'];
                                         
                                        $api_data.='<div class="col-col p-0">
                                            <div class="headclass">
                                                <div class="open">
                                                    <img src="../../customized/image/bp.png" style="padding:4px; margin-left: 10px;" width="28" height="28">
                                                    <div class="font-weight-bold d-inline-block">BP</div>
                                                </div>
                                                <div class="img-class">
                                                    <div class="img_val">
                                                        <img src="../../customized/image/bp.png" class="imgblock" style="padding:4px;" width="28" height="28">
                                                        <div class="text" style="display:inline-block;color:'.$color.';">'.$value[0]['pb'].'</div>
                                                        <span class="smbl">&nbsp;(mmHg)</span>
                                                    </div>
                                                    <div class="reading-time">
                                                        <div>
                                                            <img src="../../customized/image/reading-time.png" style="padding: 7px; margin-left:-8px;" width="28" height="28">
                                                            <span style="margin-left:-8px;" >'.$dates.'</span>                                                                       
                                                        </div>                                                                       
                                                    </div>
                                                    <span class="badge" style="background: #6b7cb6;color:white">'.$pb_api_type.'</span>
                                                </div>
                                            </div>
                                        </div>';
                                    } 
                                    if(isset($array_data[$key][0]['pulse']))
                                    {  
                                        $pulse=$array_data[$key][0]['pulse'];
                                        if($pulse>100){
                                            $color='#FFB323';
                                        }
                                        else if($pulse<=60){
                                            $color='#FF4038';
                                        }
                                        else{
                                            $color='#30DA88';
                                        }  
                                        // $dates=date('m/d/Y H:i:s',strtotime($value[0]['time']));
                                        $dates=$value[0]['time'];
                                        $api_data.='<div class="col-col p-0">
                                            <div class="headclass">
                                                <div class="open">
                                                    <img src="../../customized/image/pulsen.png" style="padding:4px;  margin-left: 10px;" width="28" height="28">
                                                    <div class="font-weight-bold d-inline-block">HR</div>
                                                </div>
                                                <div class="img-class">
                                                    <div class="img_val">
                                                                    
                                                        <img src="../../customized/image/pulsen.png" style="padding:4px;" class="imgblock" width="28" height="28">
                                                        <div class="text" style="display:inline-block;color:'.$color.';">'.$value[0]['pulse'].'</div>
                                                        <span class="smbl">&nbsp;(bpm)</span>
                                                    </div>
                                                    <div class="reading-time">
                                                        <div>
                                                            <img src="../../customized/image/reading-time.png" style="padding: 7px; margin-left:-8px;" width="28" height="28">
                                                            <span style="margin-left:-8px;">'.$dates.'</span>
                                                        </div>    
                                                    </div>
                                                    <span class="badge" style="background: #6b7cb6;color:white">'.$pulse_api.'</span>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    if(isset($array_data[$key][0]['weight']))
                                    { 
                                                        $weight=$array_data[$key][0]['weight'];
                                                        if($weight>180){
                                                            $color='#FFB323';
                                                        }
                                                        else if($weight>=130 && $$weight<=180){
                                                            $color='#30DA88';
                                                        }
                                                        else{
                                                            $color='#FF4038';
                                                        }
                                                        //$dates=date('m/d/Y H:i:s',strtotime($value[0]['time']));
                                                        $dates=$value[0]['time'];
                                                        $api_data.='<div class="col-col p-0">
                                                            <div class="headclass">
                                                                <div class="open">
                                                                <img src="../../customized/image/weightn.png" style="padding:4px;  margin-left: 10px;" width="28" height="28">
                                                                <div class="font-weight-bold d-inline-block">Weight</div>
                                                                </div>
                                                                <div class="img-class">
                                                                <div class="img_val">
                                                                    <img src="../../customized/image/weightn.png" style="padding:4px;" class="imgblock" width="28" height="28">
                                                                    <div class="text" style="display:inline-block;color:'.$color.';">'.round($value[0]['weight']).'</div>
                                                                    <span class="smbl">&nbsp;(lbs)</span>
                                                                </div>
                                                                <div class="reading-time">
                                                                    <div>
                                                                        <img src="../../customized/image/reading-time.png" style="padding: 7px; margin-left:-8px;" width="28" height="28">
                                                                        <span style="margin-left:-8px;">'.$dates.'</span>
                                                                    </div>    
                                                                </div>
                                                                <span class="badge" style="background: #6b7cb6;color:white">'.$weight_api.'</span>
                                                                </div>
                                                            </div>
                                                        </div>';   
                                    } 
                                    if(isset($array_data[$key][0]['spo2']))
                                    { 
                                                         
                                                           $glucose=isset($array_data[$key][0]['spo2'])?$array_data[$key][0]['spo2']:'';
                                                           $spo2=isset($array_data[$key][0]['spo2'])?$array_data[$key][0]['spo2']:'';
                                                           
                                                           if($spo2>95){
                                                            $color='#FFB323';
                                                            }
                                                            elseif($spo2<=80){
                                                                $color='#FF4038';
                                                            }
                                                            else{
                                                                $color='#30DA88';
                                                            }
                                                        //$dates=date('m/d/Y H:i:s',strtotime($value[0]['time']));
                                                        $dates=$value[0]['time'];
                                                        $api_data.='<div class="col-col p-0">
                                                            <div class="headclass">
                                                                <div class="open">
                                                                <img src="../../customized/image/o2.png" style="padding:4px;  margin-left: 10px;" width="28" height="28">
                                                                <div class="font-weight-bold d-inline-block">SPO2</div>                                                           
                                                                </div>
                                                                <div class="img-class">
                                                                <div class="img_val">
                                                                <img src="../../customized/image/o2.png" style="padding:4px;" class="imgblock" width="28" height="28">
                                                                    <div class="text" style="display:inline-block;color:'.$color.';">'.round($value[0]['spo2']).'</div>
                                                                    <span class="smbl">&nbsp;%</span>
                                                                </div>
                                                                <div class="reading-time">
                                                                    <div>
                                                                        <img src="../../customized/image/reading-time.png" style="padding: 7px; margin-left:-8px;" width="28" height="28">
                                                                        <span style="margin-left:-8px;">'.$dates.'</span>
                                                                    </div>    
                                                                </div>
                                                                <span class="badge" style="background: #6b7cb6;color:white">'.$spo2_api.'</span>
                                                                </div>
                                                            </div>
                                                        </div>'; 
                                    }        
                                    if(isset($array_data[$key][0]['glucose']))
                                    { 
                                        
                                                          
                                                            $glucose=$array_data[$key][0]['glucose'];
                                                            if($glucose>125){
                                                                $color='orange';
                                                            }
                                                            else if($glucose<=100){
                                                                $color='red';
                                                            }
                                                            else{
                                                                $color='lightgreen';
                                                            }
                                                         //$dates=date('m/d/Y H:i:s',strtotime($value[0]['time']));
                                                         $dates=$value[0]['time'];
                                                         $api_data.='<div class="col-col p-0">
                                                             <div class="headclass">
                                                                 <div class="open">
                                                                 <img src="../../customized/image/glucosen.png" style="padding:4px;  margin-left: 10px;" width="28" height="28">
                                                                 <div class="font-weight-bold d-inline-block">Glucose</div>
                                                                 </div>
                                                                 <div class="img-class">
                                                                 <div class="img_val">
                                                                     <img src="../../customized/image/glucosen.png" style="padding:4px;" class="imgblock" width="28" height="28">
                                                                     <div class="text" style="display:inline-block;color:'.$color.';">'.round($glucose).'</div>
                                                                     <span class="smbl">&nbsp;(mg/dl)</span>
                                                                 </div>
                                                                 <div class="reading-time">
                                                                     <div>
                                                                         <img src="../../customized/image/reading-time.png" style="padding: 7px; margin-left:-8px;" width="28" height="28">
                                                                         <span style="margin-left:-8px;">'.$dates.'</span>
                                                                     </div>    
                                                                 </div>
                                                                 <span class="badge" style="background: #6b7cb6;color:white">'.$glucose_api_type.'</span>
                                                                 </div>
                                                             </div>
                                                         </div>'; 
                                    }                                                

                                }                   
                                $result.=$api_data;           
                            $result.='</div>
                        </div>                        
                    </div>
                                    
                </div>
            </div>
        </div>';

                  
    }
    else
    {
        $result.='<div class="row no-vitals" style="border: 1px solid rgb(223, 223, 223);font-size: 26px;border-radius: 10px;align-items: center;justify-content: center;font-weight: 600;margin: 0 15px;">No vitals data </div>';
    }
   
    return $result;
}
function modal_data($pid){
    $modal_array=[];
    //glucose
    $blood_glucose=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND blood_glucose!='') AND blood_glucose!=''");
    $glucose_data=isset($blood_glucose['blood_glucose']) ? $blood_glucose['blood_glucose']:''; 
    $glu_api_type=isset($blood_glucose['api_type'])? $blood_glucose['api_type']:'';   
    $glucose_reading_time=isset($blood_glucose['reading_time'])?$blood_glucose['reading_time']:'';   
    $glucose_api_type=api_type($glu_api_type);
    $modal_array['glucose']=$glucose_data;
    $modal_array['glucose_api_type']=$glucose_api_type;
    $glucose_reading_time1=get_time($glucose_reading_time);
    $modal_array['glucose_reading_time']=$glucose_reading_time1;

    // blood pressure
    $blood_pressure=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND systolic!='' AND diastolic!='') AND systolic!='' AND diastolic!=''");
    $pbs=isset($blood_pressure['systolic'])?$blood_pressure['systolic']:'';    
    $pbd=isset($blood_pressure['diastolic'])?$blood_pressure['diastolic']:'';
    $pb_api_type1=  isset($blood_pressure['api_type'])?$blood_pressure['api_type']:'';  
    $pb_api_type=api_type($pb_api_type1);
    $bp=$pbs.'/'.$pbd;
    $modal_array['pbs']=$pbs;
    $blood_pressure_time=isset($blood_pressure['reading_time'])?$blood_pressure['reading_time']:'';
    $modal_array['bp']=$bp;
    $modal_array['pb_api_type']=$pb_api_type;
    $blood_pressure_time1=get_time($blood_pressure_time);
    $modal_array['bp_reading_time']=$blood_pressure_time1;
    
    //average bp and glucose for 3 days
    $avg_bp_query=sqlQuery("SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic FROM api_vitals_data WHERE pid=$pid AND systolic!=0 AND reading_date BETWEEN (SELECT DATE_SUB((SELECT Max(reading_date) FROM api_vitals_data WHERE pid=$pid AND systolic!=0 ),INTERVAL 3 DAY)) AND (SELECT Max(reading_date) FROM api_vitals_data WHERE pid=$pid AND systolic!=0)");
    $avg_glucose_query=sqlQuery("SELECT AVG(blood_glucose) as blood_glucose FROM api_vitals_data WHERE pid=$pid AND blood_glucose!=0 AND reading_date BETWEEN (SELECT DATE_SUB((SELECT Max(reading_date) FROM api_vitals_data WHERE pid=$pid AND blood_glucose!=0 ),INTERVAL 3 DAY)) AND (SELECT Max(reading_date) FROM api_vitals_data WHERE pid=$pid AND blood_glucose!=0)");
    //$average_query=sqlQuery("SELECT max(systolic) as systolic,max(diastolic) as diastolic,max(terra_glucose) as terra_glucose,max(ambrosiya_glucose) as ambrosiya_glucose,max(blood_glucose_mgdl) as blood_glucose_mgdl,max(blood_glucose) as blood_glucose FROM api_vitals_data WHERE pid=$pid AND reading_date between DATE_SUB((SELECT Max(reading_date) FROM api_vitals_data WHERE pid=$pid),INTERVAL 3 DAY) AND (SELECT Max(reading_date) FROM api_vitals_data WHERE pid=$pid)");
    // print_r($average_query);exit;  
    
    $pbs=isset($avg_bp_query['systolic'])?round($avg_bp_query['systolic']):'';      
    $pbd=isset($avg_bp_query['diastolic'])?round($avg_bp_query['diastolic']):'';
    $average_glucose=isset($avg_glucose_query['blood_glucose'])?round($avg_glucose_query['blood_glucose']):'';
    
    $bp=$pbs.'/'.$pbd;
    // $blood_pressure_time=isset($blood_pressure['reading_time'])?$blood_pressure['reading_time']:'';
    $modal_array['average_bp']=$bp;
    $modal_array['average_bps']=$pbs;
    // $modal_array['bp_reading_time']=$blood_pressure_time;
    $modal_array['average_glucose']=$average_glucose;

    //height
    $height_data=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND height_cm!='') AND height_cm!=''");
    $height_cm=isset($height_data['height_cm'])?$height_data['height_cm']:0;
    $height_inc='';
    $height='';
    if($height_cm!=0){
        $height_inc=cminc($height_cm);
    }
    
    
      if(!empty($height_inc) || !empty($height_cm)){
        $height=$height_inc.'/'.round($height_cm);
      }
    $height_data_time=isset($height_data['reading_time'])?$height_data['reading_time']:'';
    $modal_array['height']=$height;
    $height_data_time1=get_time($height_data_time);
    $modal_array['height_reading_time']=$height_data_time1;

    //weight 
    $weight_kgs=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND weight_kg!='') AND weight_kg!=''");
    $weight_kg=isset($weight_kgs['weight_kg'])?$weight_kgs['weight_kg']:'';
    $weight_lbs=round((int)$weight_kg)*2.20462262;
   
    $weight=$weight_lbs;
    $weight_kg_time=isset($weight_kgs['reading_time'])?$weight_kgs['reading_time']:'';
    $modal_array['weight']=$weight;
    $weight_api_type=isset($weight_kgs['api_type'])?$weight_kgs['api_type']:'';    
    $weight_api=api_type($weight_api_type);
    $weight_kg_time1=get_time($weight_kg_time);
    $modal_array['weight_reading_time']=$weight_kg_time1;
    $modal_array['weight_api']=$weight_api;

    //pulse
    $pulse_p=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND pulse!='') AND pulse!=''");
    $pulse=isset($pulse_p['pulse'])?$pulse_p['pulse']:'';
    $pulse_p_time=isset($pulse_p['reading_time'])?$pulse_p['reading_time']:'';
    $pulse_api_type=isset($pulse_p['api_type'])?$pulse_p['api_type']:'';
    $pulse_api=api_type($pulse_api_type);
    $modal_array['pulse']=$pulse;
    $pulse_p_time1=get_time($pulse_p_time);
    $modal_array['pulse_reading_time']=$pulse_p_time1;
    $modal_array['pulse_api']=$pulse_api;

    //spo2
    $spo2_p=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND spo2!='') AND spo2!=''");
    $spo2=isset($spo2_p['spo2'])?$spo2_p['spo2']:'';
    $spo2_time=isset($spo2_p['reading_time'])?$spo2_p['reading_time']:'';
    $spo2_api_type=isset($spo2_p['api_type'])?$spo2_p['api_type']:'';
    $spo2_api=api_type($spo2_api_type);
    $modal_array['spo2']=$spo2;
    $spo2_time1=get_time($spo2_time);
    $modal_array['spo2_reading_time']=$spo2_time1;
    $modal_array['spo2_api']=$spo2_api;
    //steps
    $steps_s=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND steps_data!='') AND steps_data!=''");
    $steps=isset($steps_s['steps_data'])?$steps_s['steps_data']:'';
    $steps_s_time=isset($steps_s['reading_time'])?$steps_s['reading_time']:''; 
    $modal_array['steps']=$steps;
    $steps_s_time1=$steps_s_time;
    $modal_array['steps_reading_time']=$steps_s_time1;
          
    //disntance
    $distance_data=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND distance_data!='') AND distance_data!=''");
    $distance=isset($distance_data['distance_data'])?$distance_data['distance_data']:'';
    $distance_data_time=isset($distance_data['reading_time'])?$distance_data['reading_time']:''; 
    $modal_array['distance']=$distance;
    $distance_data_time1=get_time($distance_data_time);
    $modal_array['distance_reading_time']=$distance_data_time1;

    //calories_reading
    $calories_reading=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND calories_reading!='') AND calories_reading!=''");
    $calories=isset($calories_reading['calories_reading'])?$calories_reading['calories_reading']:'';
    $calories_reading_time=isset($calories_reading['reading_time'])?$calories_reading['reading_time']:'';
    $modal_array['calories']=$calories;
    $calories_reading_time1=get_time($calories_reading_time);
    $modal_array['calories_reading_time']=$calories_reading_time1;

    //bmr
    $bmr_r=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND bmr!='') AND bmr!=''");
    $bmr=isset($bmr_r['bmr'])?$bmr_r['bmr']:'';
    $bmr_r_time=isset($bmr_r['reading_time'])?$bmr_r['reading_time']:'';
    $modal_array['bmr']=$bmr;
    $bmr_r_time1=get_time($bmr_r_time);
    $modal_array['bmr_reading_time']=$bmr_r_time1;
    return $modal_array;
}

function card_data($pid,$pat_name){
    $modal_data=modal_data($pid);
    $src=$web_root.'/controller.php?document&retrieve&patient_id='.$pid.'&document_id=-1&as_file=false&original_file=true&disable_exit=false&show_original=true&context=patient_picture';
    $error_src=$GLOBALS['images_static_relative'].'/patient-picture-default.png';
    $result='';
    $result.='<div class="col-2">
    </div>
    <div class="container col-8">
        <div class="card col-12 position-absolute p-0 myModal" id="myModal'.$pid.'" style="height:100vh!important;display:none;padding-bottom:20px!important;background-color:white!important;overflow:scroll">
            <div class="header d-flex justify-content-between text-white text-bold" style="height:42px;align-items: center">
                 <h4 class="mt-2 ml-4" style="font-weight:bolder"> Vitals | FDA device</h4>
                <div class="d-flex">
                    <h5 class="mt-2" style="display:grid;align-items: center;font-weight:bolder">'.$pat_name.' </h5>&emsp;&nbsp;
                    <img id="img" class="mt-2" width="30px" height="30px" style="border-radius:50%;margin-bottom:10px" onError=this.setAttribute("src","'.$error_src.'");this.removeAttribute("onError");this.removeAttribute("onclick"); src="'.$src.'">&emsp;&nbsp;
                </div>
            </div>
            <div class="container">         
                <div class="head d-flex m-2">   

                    <div class="card-group col-12 text-center"> ';           

                        if(isset($modal_data['bp'])&&$modal_data['bp']!='/'){
                            $pbs=isset($modal_data['pbs'])?$modal_data['pbs']:'';                

                            if($pbs>120){
                                $text_color='#FFB323';
                            }
                            else if($pbs<120){
                                $text_color='#FF4038';
                            }
                            else{
                                $text_color='#30DA88';
                            }
                        
                            $result.='<div class="card">
                                <div class="card-title"> <img class="label" src="../../customized/image/bp.png" width="17" height="13">&nbsp;BP</div>
                                <div class="card-body text-center">
                                <span style="font-size:22px;font-weight:700;color:'.$text_color.'">'.$modal_data['bp'].'</span>&nbsp;(mmHg)<br>
                                <img class="label" src="../../customized/image/reading-time.png" width="17" height="13">&nbsp;
                                '.$modal_data['bp_reading_time'].'
                                </div>
                                <div><span class="badge" style="background: #6b7cb6;color:white">'.$modal_data['pb_api_type'].'</span></div>
                                
                            </div>';
                        }
                        if($modal_data['pulse']){
                            if($modal_data['pulse']>100){
                                $text_color='#FFB323';
                            }
                            else if($modal_data['pulse']>=60 && $modal_data['pulse']<=100){
                                $text_color='#30DA88';
                            }
                            else{
                                $text_color='#FF4038';
                            }
                            $result.=' <div class="card">
                            <div class="card-title"><img class="label" src="../../customized/image/pulsen.png" width="17" height="13">&nbsp;HR</div>
                                <div class="card-body text-center">
                                <span style="font-size:22px;font-weight:700;color:'.$text_color.'">'.$modal_data['pulse'].'</span>&nbsp;(bpm)
                                <br>
                                <img class="label" src="../../customized/image/reading-time.png" width="17" height="13">&nbsp;
                                '.$modal_data['pulse_reading_time'].'
                                </div>
                                <div><span class="badge" style="background: #6b7cb6;color:white">'.$modal_data['pulse_api'].'</span></div>
                                
                                </div>';
                        }
                        if($modal_data['weight'])
                        {
                            if($modal_data['weight']>180){
                                $text_color='#FFB323';
                            }
                            else if($modal_data['weight']>=130 && $modal_data['weight']<=180){
                                $text_color='#30DA88';
                            }
                            else{
                                $text_color='#FF4038';
                            }
                            $result.=' <div class="card">
                            <div class="card-title"><img class="label" src="../../customized/image/weightn.png" width="17" height="13">&nbsp;Weight</div>
                                <div class="card-body text-center">
                                <span style="font-size:22px;font-weight:700;color:'.$text_color.'">'.round($modal_data['weight']).'</span>&nbsp;(lbs)<br>
                                <img class="label" src="../../customized/image/reading-time.png" width="17" height="13">&nbsp;
                                '.$modal_data['weight_reading_time'].'
                                </div>
                                <div><span class="badge" style="background: #6b7cb6;color:white">'.$modal_data['weight_api'].'</span></div>
                            </div>';
                        }
                        if($modal_data['spo2']){
                            if($modal_data['spo2']>95){
                                $text_color='#FFB323';
                            }
                            else if($modal_data['spo2']<95){
                                $text_color='#FF4038';
                            }
                            else{
                                $text_color='#30DA88';
                            }
                            $result.='
                            <div class="card">
                                <div class="card-title"><img class="label" src="../../customized/image/o2.png" width="17" height="13">&nbsp;SPO2</div>
                                <div class="card-body text-center">
                                    <span style="font-size:22px;font-weight:700;color:'.$text_color.'">'.round($modal_data['spo2']).'</span>&nbsp;%<br>
                                    <img class="label" src="../../customized/image/reading-time.png" width="17" height="13">&nbsp;
                                        '.$modal_data['spo2_reading_time'].'
                                </div>
                                <div><span class="badge" style="background: #6b7cb6;color:white">'.$modal_data['spo2_api'].'</span></div>
                            </div>';
                        }
                
                        if($modal_data['glucose']){
                            if($modal_data['glucose']>125){
                                $text_color='#FFB323';
                            }
                            else if($modal_data['glucose']>=100 && $modal_data['glucose']<=125){
                                $text_color='#30DA88';
                            }
                            else{
                                $text_color='#FF4038';
                            }
                            $result.='<div class="card">
                            <div class="card-title"><img class="label" src="../../customized/image/glucosen.png" width="13" height="17">&nbsp;Glucose</div>
                                <div class="card-body text-center">
                                <span style="font-size:22px;font-weight:700;color:'.$text_color.'">'.round($modal_data['glucose']).'</span>&nbsp;(mg/dl)<br>
                                <img class="label" src="../../customized/image/reading-time.png" width="17" height="13">&nbsp;
                                '.$modal_data['glucose_reading_time'].'
                                </div>
                                <div><span class="badge" style="background: #6b7cb6;color:white">'.$modal_data['glucose_api_type'].'</span></div>
                            </div>';
                        }
                    $result.='</div>    
    
                </div>
            </div>            
            <div class="header d-flex text-white text-bold">
            <h4 class="mt-2 ml-4" style="font-weight:bolder"> Vitals | Non FDA device</h4>
            </div>
            <div class="container">
                <div class="head d-flex m-2 text-bold">
                    <div class="card-group col-12 text-center"> ';

                        if($modal_data['steps']){ 
                            $month=date('F d/Y',strtotime($modal_data['steps_reading_time']));
                            $result.='<div class="card">
                                <div class="card-title"><img class="label" src="../../customized/image/googlefit.png" width="17" height="13">&nbsp;GoogleFit</div>
                                <div class="card-body bg-white text-center">
                                    '.$month.'
                                </div>
                            </div>';
                        }
                        if($modal_data['steps']){
                            $text_color='#30DA88';
                            // if($modal_data['steps']>=125){
                            //     $text_color='orange';
                            // }
                            // else if($modal_data['steps']>=100 && $modal_data['steps']<=125){
                            //     $text_color='#30DA88';
                            // }
                            // else{
                            //     $text_color='red';
                            // }
                            $result.='<div class="card">
                                <div class="card-title"><img class="label" src="../../customized/image/step.png" width="17" height="13">&nbsp;Step Samples</div>
                                <div class="card-body text-center">
                                <span style="font-size:22px;font-weight:700;color:'.$text_color.'">'.round($modal_data['steps']).'</span>&nbsp;Steps<br>
                                
                                </div>
                            </div>';
                        }
                        if($modal_data['distance']){
                            $text_color='#30DA88';
                            // if($modal_data['distance']>=125){
                            //     $text_color='orange';
                            // }
                            // else if($modal_data['distance']>=100 && $modal_data['distance']<=125){
                            //     $text_color='#30DA88';
                            // }
                            // else{
                            //     $text_color='red';
                            // }
                            $result.='<div class="card">
                                <div class="card-title"><img class="label" src="../../customized/image/calories.png" width="17" height="13">&nbsp;Distance</div>
                                <div class="card-body text-center">
                                <span style="font-size:22px;font-weight:700;color:'.$text_color.'">'.round($modal_data['distance']).'</span>&nbsp;Meter<br>
                            
                                </div>
                            </div>';
                        }
                        if($modal_data['calories']){
                            $text_color='#30DA88';
                            // if($modal_data['calories']>=125){
                            //     $text_color='orange';
                            // }
                            // else if($modal_data['calories']>=100 && $modal_data['calories']<=125){
                            //     $text_color='#30DA88';
                            // }
                            // else{
                            //     $text_color='red';
                            // }
                            $result.='<div class="card">
                                <div class="card-title"><img class="label" src="../../customized/image/new_calories.png" width="17" height="13">&nbsp;Kcal Burn</div>
                                <div class="card-body text-center">
                                <span style="font-size:22px;font-weight:700;color:'.$text_color.'">'.round($modal_data['calories']).'</span>&nbsp;Kcal<br>

                                </div>
                            </div>';
                        }
                        if($modal_data['bmr']){
                            if($modal_data['bmr']>=125){
                                $text_color='orange';
                            }
                            else if($modal_data['bmr']>=100 && $modal_data['bmr']<=125){
                                $text_color='#30DA88';
                            }
                            else{
                                $text_color='red';
                            }
                            $result.='<div class="card">
                                <div class="card-title"><img class="label" src="../../customized/image/monitor_heart.png" width="17" height="13">&nbsp;BMR</div>
                                <div class="card-body text-center">
                                <span style="font-size:22px;font-weight:700;color:'.$text_color.'">'.round($modal_data['bmr']).'</span>&nbsp;bmr<br>
                                
                                </div>
                            </div>';
                        }
                    $result.='</div>

                </div>
            </div>
            <div class="header d-flex text-white text-bold">
                <h4 class="mt-2 ml-4" style="font-weight:bolder"> BP & Pulse</h4>
                <h4 class="mt-2" style="margin-left:395px;font-weight:bolder"> Glucose </h4>
            </div>
            <div class="row m-2">    
                <div class="col-md-6 lilist mt-2">
                    <div class="card">
                        <div class="card-body">
                            <div id="left_chart_'.$pid.'" style="width: 500px; height: 200px;margin-left:-15px"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 lilist mt-2">
                    <div class="card">
                        <div class="card-body">
                            <div id="right_chart_'.$pid.'"  style="width: 500px; height:200px;margin-left:-15px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header d-flex text-white text-bold">
                <h4 class="mt-2 ml-4" style="font-weight:bolder"> Clinical Inferences</h4>
            </div>
            <div class="container m-2">
                <div class="row mt-2" style="font-size:14px;font-weight:500;color: #000000;">';
                        
                        //echo '<pre>';print_r($modal_data);
                        if($modal_data['bp']!=''&&$modal_data['bp']!='/'){
                            $pbs=$modal_data['pbs'];                           
                            $text='Normal'; 
                            if($pbs>=126){
                                $text='High';
                            }
                            else if($pbs>=121 && $pbs<=125){
                                $text='Midly High';
                            }
                            else if($pbs>=115 && $pbs<120){
                                $text='Midly Low';
                            }
                            else if($pbs<115){
                                $text='Low';
                            }
                            
                            $result.='<div class="col-md-6 lilist"><p>&#9679; Recent BP is '.$text.'</p>
                            </div>';
                        }
                        
                        if(!empty($modal_data['weight'])&&$modal_data['weight']!=''){
                            $result.='<div class="col-md-6 lilist">';                            
                            if($modal_data['weight']>=130 && $modal_data['weight']<=180){
                                $text='Normal';
                            }
                            else if($modal_data['weight']>180 && $modal_data['weight']<=185){
                                $text='Midly Obesity';
                            }
                            else if($modal_data['weight']>=125 && $modal_data['weight']<=129){
                                $text='Midly Lean';
                            }
                            else if($modal_data['weight']>185){
                                $text='Obesity';
                            }
                            else if($modal_data['weight']<125){
                                $text='Lean';
                            }
                            
                            $result.='<p>&#9679; Weight is '.$text.'</p>
                        </div>';
                        }
                        if($modal_data['average_bp']!=''&&$modal_data['average_bp']!='/'){
                            $text='Normal';
                            
                            if($modal_data['average_bps']>=126){
                                $text='High';
                            }
                            else if($modal_data['average_bps']>=121 && $modal_data['average_bps']<=125){
                                $text='Midly High';
                            }
                            else if($modal_data['average_bps']>=115 && $modal_data['average_bps']<120){
                                $text='Midly Low';
                            }
                            else if($modal_data['average_bps']<115){
                                $text='Low';
                            }
                            
                            
                            
                        $result.='<div class="col-md-6 lilist"><p>&#9679; Average blood pressure in the last 3 days is '.$modal_data['average_bp'].' '.$text.'</p>
                        </div>';
                        }
                        if(!empty($modal_data['spo2'])&&$modal_data['spo2']!=''){
                            // $pbs=$modal_data['spo2'];
                            
                            if($modal_data['spo2']>=100){
                                 $text='High';
                             }
                             else if($modal_data['spo2']==95){
                                 $text='Normal';
                              }
                              else if($modal_data['spo2']>95 && $modal_data['spo2']<=99){
                                $text='Midly High';
                             }
                             else if($modal_data['spo2']>=90 && $modal_data['spo2']<=94){
                                $text='Midly Low';
                             }
                             else{
                                 $text='Low';
                             }
                            $result.='<div class="col-md-6 lilist"><p>&#9679; Oxygen is '.$text.'</p>
                            </div>';
                         }
                         if(!empty($modal_data['pulse']) && $modal_data['pulse']!=''){
                            $pulse=$modal_data['pulse'];                            
                            if($pulse>115){
                                $text='High';
                            }
                            else if($pulse>=60 && $pulse<=100){
                                $text='Normal';
                            }
                            else if($pulse>=55 && $pulse<=59){
                                $text='Midly Low';
                            }
                            else if($pulse>99 && $pulse<=115){
                                $text='Midly High';
                            }
                            else if($pulse<55){
                                $text='Low';  
                            }
                            $result.='<div class="col-md-6 lilist"><p>&#9679; Pulse is '.$text.'</p>
                            </div>';
                        }
                        if($modal_data['glucose']!=''&&$modal_data['glucose']!='/')
                        {
                            $result.='<div class="col-md-6 lilist">';
                           
                            if($modal_data['glucose']>130){
                                $text='High';
                            }
                            else if($modal_data['glucose']>=100 && $modal_data['glucose']<=125){
                                $text='Normal';
                            }
                            else if($modal_data['glucose']>=95 && $modal_data['glucose']<=99){
                                $text='Midly Low';
                            }
                            else if($modal_data['glucose']>=126 && $modal_data['glucose']<=130){
                                $text='Midly High';
                            }
                            else if($modal_data['glucose']<95){
                                $text='Low';
                            }
                            
                                $result.='<p>&#9679; Last blood sugar is  '.$text.'</p>
                            </div>';
                        }                        
                    
                        if($modal_data['average_glucose']!=''&&$modal_data['average_glucose']!='/')                        {
                           
                            if($modal_data['average_glucose']>130){
                                $text='High';
                            }
                            else if($modal_data['average_glucose']>=100 && $modal_data['average_glucose']<=125){
                                $text='Normal';
                            }
                            else if($modal_data['average_glucose']>=95 && $modal_data['average_glucose']<=99){
                                $text='Midly Low';
                            }
                            else if($modal_data['average_glucose']>=126 && $modal_data['average_glucose']<=130){
                                $text='Midly High';
                            }
                            else if($modal_data['average_glucose']<95){
                                $text='Low';
                            }
                            $result.='<div class="col-md-6 lilist"><p>&#9679; Average blood sugar in the last 3 days is  '.$modal_data['average_glucose'].' '.$text.'</p>
                            </div>';
                        }
                $result.='</div>
            </div>

        </div>   
    </div>';
    return $result;
    
}

$per_page=25;
if(isset($_GET['patient_detail'])&&$_GET['patient_detail']=='true')
{
   // echo 'ss';exit();
//    if(!empty($_GET["limit"])){
//     $per_page=$_GET["limit"];
//    }
   if(isset($_GET['limit'])&&$_GET['limit']!=''){
    $per_page=$_GET["limit"];
   }
    $result_pat_id=[];
    $value=isset($_POST['value'])?$_POST['value']:'';
    $query= "SELECT * FROM patient_data "; 
    
        if($value){
            $query.="WHERE CONCAT(fname, ' ', lname,DOB,pubpid,phone_home,ss,email,email_direct) LIKE '%".$value."%' ";
        }
        $query2= sqlstatement($query);
        $num_query=sqlNumRows($query2);
            
            if($num_query< $per_page){
                $num_query=$per_page;  
            }
            if (isset($_GET["page"])&&$_GET["page"]!=0) 
            {    
                $page  = $_GET["page"];    
            }
            else
            {    
                $page=1;    
            }
            $start_from = ($page-1) * $per_page;
            $total_pages=ceil($num_query/$per_page);    
    $query.="LIMIT $start_from, $per_page";      
    $query1=sqlstatement($query);    
    if (sqlNumRows($query1) > 0) {   
        $pat_result=[];                       
        while($pat_row=sqlFetchArray($query1))
        {
            $pid=$pat_row['pid'];           
            $pat_name=$pat_row['fname'].' '.$pat_row['lname'];            
            $email=$pat_row['email'];
            $age=date('Y')-date('Y',strtotime($pat_row['DOB']));
            $phone=isset($pat_row['phone_home'])?$pat_row['phone_home']:' ';
            //$glucose_data=glucose_data($pid);
            //echo '<pre>';print_r($glucose_data);
            $http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://" . $_SERVER['HTTP_HOST'];
            $src='../../../controller.php?document&retrieve&patient_id='.$pid.'&document_id=-1&as_file=false&original_file=true&disable_exit=false&show_original=true&context=patient_picture';
           // $src=$web_root.'/controller.php?document&retrieve&patient_id='.$pid.'&document_id=-1&as_file=false&original_file=true&disable_exit=false&show_original=true&context=patient_picture';
            $error_src=$GLOBALS['images_static_relative'].'/patient-picture-default.png';
            
            $result='<section class="testimonial text-center acck mt-4 close_div" id="demodiv_'.$pid.'" style="height: 100%;padding: 3px;">
                <div class="row patdemo" style="margin-left:5px;margin-right:5px;align-items: center;" id="pid_'.$pid.'">
                    <div class="col-2 p-0" >
                        <div class="p-0">
                            <div class="first_sec">
                            <span class="p-2">
                            <input type="hidden" id="collapse_value_'.$pid.'" value="hide">
                            <span style="cursor:pointer" id="refersh_btn" onclick="refresh_patient('.$pid.',0)"><i class="fa fa-refresh" style="color:#232d4f;">&nbsp;</i></span>
                                <i class="fa fa-angle-down" style="display:none; padding-top:1px;" aria-hidden="true" onclick=collapse('.$pid.',"show");></i>
                                <i class="fa fa-angle-up"  style="display:none; padding-top:0px;" aria-hidden="true" onclick=collapse('.$pid.',"hide");></i>                           
                                                               
                                </span>
                            <div class="float-left ml-2">
                                <img class="img-thumbnail"  onError=this.setAttribute("src","'.$error_src.'");this.removeAttribute("onError");this.removeAttribute("onclick"); src="'.$src.'">
                            </div>
                            <div style="margin-left:8px; margin-top:0px;" class="patdemodiv" onclick=demopat('.$pid.');>
                                <div class="form-group demo-group" style="text-align: initial; padding-top:0px;word-break: break-all;">
                                <div class="slide" style="margin-top:-8px;">
                                    <span class="name-heading"  onclick=demopat('.$pid.');>'.$pat_name.'</span></div>
                                    </a>
                                <div class="mt-0 patdetail" style="font-size:12px;">
                                    <span style="padding-right:10px;">age:'.$age.'</span>
                                    <span>phone:'.$phone.'</span>
                                </div>
                                <div class="mt-0 patdetail" style="font-size:12px;">
                                    <span>'.$email.'</span>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-0 vitalsdiv" id="vitalsdiv_'.$pid.'">';
                    $vars=0;                  
                    $result.=glucose_data($pid);                
                    $result.='</div>';                   
                    $enc_data=sqlQuery("SELECT * FROM form_encounter WHERE date_end!='NULL' AND encounter_status='open' AND pid=?",array($pid));
                    //echo '<pre>';print_r($enc_data);
                    $days=30;
                    $need_count=16;
                    $duration=0;
                    $flag=0;
                    if(!empty($enc_data))
                    {
                        $flag=1;
                        //days
                        $end_data=strtotime($enc_data['date_end']);
                        $today_date=strtotime(date('Y-m-d h:i:s'));
                        $left_days=$end_data-$today_date;
                        $days=date('d',$left_days); 
                        
                        //reading
                        $start_date=date('Y-m-d',strtotime($enc_data['date']));
                        $end_date=date('Y-m-d',strtotime($enc_data['date_end']));
                        $query=sqlStatement("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type!='googlefit' AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY reading_date");
                        $reading_count=sqlNumRows($query);
                        
                        $totala_reading_count=16;
                        if($reading_count>16){
                            $reading_count=16;
                        }
                        $need_count=$totala_reading_count-$reading_count;
                
                
                        //duration
                        $encounter=$enc_data['encounter'];
                        $sum_query=sqlQuery("SELECT SUM(timespent) as duration from rpm_encounter WHERE pid=? and eid=? AND is_deleted=0",array($pid,$encounter));
                        $duration=isset($sum_query['duration'])&&$sum_query['duration']!='NULL'?$sum_query['duration']:0;
                        
                    
                    }
                    $result.='
                        <div class="col-4 p-1 bisection">
                            <div class="last_div_action">
                            <div style="display:flex;align-items: center;" class="action_div">
                            <div class="bibutton-main"> <img src="../../customized/image/biButton.png" class="imgbibtn" onmouseover="function_name( '.$pid.')" >
                                <div class="testbutton" id="mouse_hover_'.$pid.'" style="display:none;">
                                <div class="colorpick" style="background-color:#E9F2FF;" >
                                <img class="img-thumbnails"  height="30" onError=this.setAttribute("src","'.$error_src.'");this.removeAttribute("onError");this.removeAttribute("onclick"); src="'.$src.'">
                                <span class="name-headings" style="text-align:left 6px;"onclick=demopat('.$pid.');>'.$pat_name.'</span>
                                </div>
                                <br>
                                <div>
                                <button style="border:hidden; margin-left:12px; border-radius: 22px; padding:3px 37px;">'.$days.' days left</button>
                                <button style="border:hidden; margin-left:12px; border-radius: 22px;">'.$duration.' min RPM</button> 
                                </div>
                                <br>
                                <div>
                                <button style="border:hidden; margin-left:12px; border-radius: 22px; ">'.$need_count.' reading needed</button>
                                <button style="border:hidden; margin-left:12px; border-radius: 22px;">0 min CCM</button></div><br>
                                </div>
                                </div>
                                
                                
                                <div style="display: table-cell;column-count: 2;">
                                <div><button class="btn btn-sm bi-button" style="margin-left: 0;">'.$days.' days left</button></div>

                                <div><button class="btn btn-sm bi-button" style="margin-left: 0;">'.$duration.' min RPM</button></div>

                                <div><button class="btn btn-sm bi-button" style="margin-left: 0;">'.$need_count.' reading needed</button></div>
                            
                                <div><button class="btn btn-sm bi-button" style="margin-left: 0;">0 min CCM</button></div>
                            </div>
                            </div>  
                            

                            <div style="display: flex;flex-wrap: wrap;align-items: center;">
                            <div>
                            <div class="ring">  
                                <i class="fa fa-phone fa-xl icon" onclick="dialpad_open('.$phone.');" style="margin-left:4px;"></i>
                                <i class="fa fa-video fa-xl icon" onclick="ringcentral_video('.$pid.');" id="'.$pid.'_video_icon" style="margin-left:4px;"></i>
                                <i class="fa fa-envelope fa-xl icon launch-modal" onclick="send_mail('.$pid.')" data-toggle="modal" data-target="#myModal"  style="margin-left:10px; "></i>
                                <i class="fa fa-message fa-xl icon" onclick="sms_send('.$pid.');" data-toggle="modal" data-target="#myModal" style="margin-left:10px;"></i>';
                                if($flag == 0)
                                {
                                    $result.='<div class="circleBase type1" onclick="start_encounter('.$pid.')" style="margin-left:10px;">
                                    
                                    <img src="../../customized/image/enc.png" width="25" height="25" style="margin-top: 7px;">
                                </div>
                                ';

                                }
                                else{
                                    $result.='<div class="circleBase type1" onclick="rpm_encounter('.$pid.')" style="margin-left:10px;">
                                    
                                    <img src="../../customized/image/enc.png" width="25" height="25" style="margin-top: 7px;">
                                </div>
                                ';
                                }

                                $result .='</div>
                                <div>';
                                if($flag == 0)
                                {
                                    $result .='<button class="btn  btn-sm start-encounter-btn"  onclick="start_encounter('.$pid.')">Start Encounter</button>';
                                }
                                else{
                                    $result .='<button class="btn  btn-sm start-encounter-btn"  onclick="rpm_encounter('.$pid.')">Start Encounter</button>';
                                }
                                $result .='</div>'; 
                                $end_date=date('Y-m-d');
                                $start_date=date('Y-m-d', strtotime($end_date .'- 7 days'));
                                $report_show=sqlQuery("SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic, count(id) as id FROM api_vitals_data WHERE pid=".$pid." AND systolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."'");
                                if(isset($report_show['systolic'])!='')
                                    {
                                $result.='<button class="btn btn-sm start-encounter-btn mt-1 report_btn" onclick="report_modal('.$pid.')" style="background:#2C7BE5 !important;">Preview Report</button>';
                                    }                              
                                $result.=' </div>
                                </div>
                                </div>  
                        </div>
                </div>
            </section>';
            $result.='<div class="row" id="card_data_'.$pid.'">';

              $result.=card_data($pid,$pat_name);  
            $result.='</div>
            <div class="col-2">
            </div>
            ';
            $pat_result[]=$result;
        }
        //exit();
        $pagination='<div class="row" style="float:right;">';       
        $pagination.='<ul class="pagination">';
        if($page>=2) { 
            $ip=$page-1;
        $pagination.='<li class="paginate_button page-item previous"><a href="#" onclick=show_patient_detail('.$ip.') class="page-link">Previous</a></li>';
        }
        for ($i=1; $i<=$total_pages; $i++) {   
            if ($i == $page) {  
                $pagination.='<li class="paginate_button page-item active"><a href="#" onclick=show_patient_detail('.$i.') class="page-link">'.$i.'</a></li>';
              
            }               
            else  {   
                
                $pagination.='<li class="paginate_button page-item"><a href="#" onclick=show_patient_detail('.$i.') class="page-link">'.$i.'</a></li>'; 
            }   
        } 
        if($page<$total_pages){ 
            $in=$page+1;
            $pagination.='<li class="paginate_button page-item previous"><a href="#" onclick=show_patient_detail('.$in.') class="page-link">Next</a></li>';  

        }
        $pagination.='</ul></div>';
        $result=[];
        $result['p1']=$pat_result;
        $result['status']='success';
        $result['pagination']=$pagination;
        echo json_encode($result);
        exit();
    }
    else{
       
        $result_pat_id['pid']='empty';
        $result=[];
        $result['status']='error';
        $result['p1']=$result_pat_id;
        echo json_encode($result);
        exit();
        
    }
    
    
}
?>