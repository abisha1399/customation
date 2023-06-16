<?php

/**
 * This report lists patients that were seen within a given date
 * range, or all patients if no date range is entered.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2006-2016 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2017-2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */
$ignoreAuth = true;
 $sessionAllowWrite = true;
require_once("../../globals.php");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
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
if(isset($_GET['graph'])){
    
    $pid=$_POST['form_pid'];
    //echo '<pre>';print_r($_POST);
    if($_POST['date_type']=='first_week'){
        $end_date=date('Y-m-d');
        $start_date=date('Y-m-d', strtotime($end_date .'- 7 days'));
    }
    else if($_POST['date_type']=='second_week'){
        $end_date=date('Y-m-d');
        $start_date=date('Y-m-d', strtotime($end_date .'- 14 days'));
    }
    else{
        $start_date=$_POST['from_date'];
        $end_date=$_POST['to_date'];
    }
    
    $pb_graph=[];
    $query=sqlstatement("select id,reading_date,pulse,systolic,diastolic from api_vitals_data where pid='".$pid."' AND (systolic!='NULL' OR pulse!='NULL' OR diastolic!='NULL' ) AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY reading_date");
    //echo "select id,reading_date,pulse,systolic,diastolic from api_vitals_data where pid='".$pid."' AND (systolic!='NULL' OR pulse!='NULL' OR diastolic!='NULL' ) AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY reading_date";exit();
    //echo "select id,reading_date,pulse,systolic,diastolic from api_vitals_data where pid='".$pid."' AND (systolic!='NULL' OR pulse!='NULL' OR diastolic!='NULL' )";exit();
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
    //echo '<pre>';print_r($reading_date); exit();
    
    echo json_encode($pb_graph);
    exit();
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
        if($systolic<120 && $diastolic<80) {
             $color='#0c7442';
            } 
            return $color;   
        }

if(isset($_GET['get_data'])){
    $pid=$_POST['form_pid'];
    $result=[];
    //echo '<pre>';print_r($_POST);
    if($_POST['date_type']=='first_week'){
        $end_date=date('Y-m-d');
        $start_date=date('Y-m-d', strtotime($end_date .'- 7 days'));
    }
    else if($_POST['date_type']=='second_week'){
        $end_date=date('Y-m-d');
        $start_date=date('Y-m-d', strtotime($end_date .'- 14 days'));
    }
    else{
        $start_date=$_POST['from_date'];
        $end_date=$_POST['to_date'];
    }
    //echo $start_date;
    $type=explode(',',$_POST['cat_type']);
    $type1=$type[0];
    $type2=$type[1];
    
    $patient_data=sqlQuery("SELECT * FROM patient_data WHERE pid=".$pid."");
    
    $patient_name=$patient_data['fname'].' '.$patient_data['lname'];
    $dob='';
    if(isset($patient_data['DOB'])){
        $dob=date('F d', strtotime($patient_data['DOB'])).','.date('Y', strtotime($patient_data['DOB']));
    }
    //$report_date='';
    $start_date_day=day_convert(date('D',strtotime($start_date)));
    $end_date_day=day_convert(date('D',strtotime($end_date)));
    //$report_date='';
    $report_date=date('F d ',strtotime($start_date)).' ('.$start_date_day.') '.date('Y',strtotime($start_date)).'  - '.date('F d',strtotime($end_date)).' ('.$end_date_day.') '.date('Y',strtotime($end_date));
    
    if(date('Y',strtotime($start_date))==date('Y',strtotime($end_date))){
      $report_date=date('F d ',strtotime($start_date)).' ('.$start_date_day.') - '.date('F d',strtotime($end_date)).' ('.$end_date_day.') , '.date('Y',strtotime($start_date));
    }
    
    $error_count=0;
    if($type1=='bp')
    {   $report_name='Blood Pressure';  
        $total_avg=sqlQuery("SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic, count(id) as id FROM api_vitals_data WHERE pid=".$pid." AND systolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."'");
         
        // echo '<pre>';print_r($total_avg);exit();
        if(isset($total_avg['systolic'])!='')
        {
            
            
            $overal_avg=round($total_avg['systolic']).'/'.round($total_avg['diastolic']);
            $systolic=$total_avg['systolic'];
            $dyslitic=$total_avg['diastolic'];
         
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
            $night_avg_color=color_change($night_avg['systolic'],$night_avg['diastolic']);
            $total_night_avg_count=isset($night_avg['id'])&&$night_avg['id']!=NULL?$night_avg['id']:0;
           

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
            <li class="liclass">Maximum systolic blood pressure '.$maxsys.' recorded at '.$max_sys_time.'</li>
            <li class="liclass">Maximum diastolic blood pressure '.$maxdys.' recorded at '.$max_dys_time.'</li>
            <li class="liclass">Minimum systolic blood pressure '.$min1.' recorded at '.$min_sys_time.'</li>
            <li class="liclass">Minimum diastolic blood pressure '.$min2.' recorded at '.$min_dys_time.'</li>';

            $list1='
            <li class="liclass">Maximum pulse '.$max_pulse['pulse'].' recorded at '.$max_pulse_time.'</li>            
            <li class="liclass">Minimum pulse '.$min_pulse['pulse'].' recorded at '.$min_pulse_time.'</li>';
           
       
        }
        else{
            
            $error_count++;
        }
        
        
          
    } 
    if($error_count==0)
    {

        $src=$web_root.'/controller.php?document&retrieve&patient_id='.$pid.'&document_id=-1&as_file=false&original_file=true&disable_exit=false&show_original=true&context=patient_picture';
    $error_src=$GLOBALS['images_static_relative'].'/patient-picture-default.png';
    
    $template=' 
    <div class="main-row">
        <div class="container">
            <div class="row pdf_row">
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
    <div class="container mt-2">
        <div class="row headrow">
            <div style="align-items:center">
            <img src="./bp1.png" style="padding:4px; margin-left: 10px;" width="28" height="28">Average Blood pressure
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="rowcon">
                    <div class="inner_head"><div class="inner_head_span">Overall</div></div>
                    <div class="avg_span" style="color:'.$overal_avg_color.'">
                    '.$overal_avg.' <span style="font-size:15px;" class="ml-2"> mmHg</span></div>
                  
                    <div class="count_span">'.$overal_avg_count.' '.$overal_avg_text.'</div>
                    
                </div>
            </div>
            <div class="col-4">
                <div class="rowcon">
                    <div class="inner_head"><div class="inner_head_span">Day (6am to 10pm)</div></div>';
                    if($total_day_avg_count!=0){
                        $template.='<div class="avg_span" style="font-size: 32px;display:flex;align-items:center;justify-content: center;color:'.$day_avg_color.'">
                        '.$total_day_avg.'<span style="font-size:15px" class="ml-2"> mmHg</span></div>
                        <div class="count_span">'.$total_day_avg_count.' '.$day_avg_text.'</div>';
                    }
                else{
                        $template.='<div class="avg_span" align="center"><span style="font-size:20px;padding:9px;color:'.$day_avg_color.'">No readings were available</span></div>';
                        
                    }
                    
                    
                    $template.='</div>
            </div>
            <div class="col-4">
                <div class="rowcon">
                    <div class="inner_head"><div class="inner_head_span">Night (10pm to 6am)</div></div>';

                    // <div class="avg_span">'.$total_night_avg.'</div>
                    // <div class="count_span">'.$total_night_avg_count.' reading</div>
                    if($total_night_avg_count!=0){
                        $template.='<div class="avg_span" style="font-size: 32px;display:flex;align-items:center;justify-content: center;color:'.$night_avg_color.'">'.$total_night_avg.'<span style="font-size:15px" class="ml-2"> mmHg</span></div>
                        <div class="count_span">'.$total_night_avg_count.' '.$night_avg_text.'</div>';
                    }
                else{
                        $template.='<div class="avg_span" align="center"><span style="font-size:20px;padding:9px;">No readings were available</span></div>';
                        
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
                <img src="./pulse1.png" style="padding:4px; margin-left: 10px;" width="28" height="28">Average Heart Rate
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
                        $template.='<div class="avg_span sm_avg_span" align="center"><span style="font-size:20px;padding:9px;">No readings were available</span></div>';
                        
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
                        $template.='<div class="avg_span sm_avg_span" align="center"><span style="font-size:20px;padding:9px;">No readings were available</span></div>';
                        
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
        <div id="left_chart" style="width:100%; height: 500px;"></div>
           
        </div>
    </div> ';
    $result['status']='true';
    $result['template']=$template;
    echo json_encode($result);
    exit();

    }
    else{
        $template='<div class="row empty_span"><div>No data</div></div>';
        $result['status']='false';
        $result['template']=$template;
        echo json_encode($result);
        exit();
        //echo $template;exit();
    }
    
    
   
}
?>
<html>
<head>

<title><?php echo xlt('Vitals Report'); ?></title>

    <?php Header::setupHeader(['datetime-picker', 'report-helper']); ?>

<script>

$(function () {
   

    $('.datepicker').datetimepicker({
        <?php $datetimepicker_timepicker = false; ?>
        <?php $datetimepicker_showseconds = false; ?>
        <?php $datetimepicker_formatInput = true; ?>
        <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
        <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma ?>
    });
});

</script>

<style>
 
 body{
    font-family: 'Manrope';
  }
    
@media print {
  

  #printme {
    display: block;
  }

}
.headrow{
    
    background: #6b7cb6;
    justify-content: center;
    font-size: 16px;
    font-weight: 700;
    color: white;
}
.main-row{
    background: #E1E4F0;
    display: flex;
    max-height: 100px;
}
.rowcon{
    box-sizing: border-box;    
    width: 270px;
    height: 105px;    
    background: #FFFFFF;
    border: 1px solid #E9F2FF;
    border-radius: 4px;
    margin: 10px;
   
}
.inner_head{
    width: 268px;
    height: 29px;    
    background: #E1E4F0;
}
.inner_head_span{
    padding-top: 5px;
    font-size: 14px;
    font-weight: 700;
    display:flex;
    
    justify-content: center;
}
.avg_span{
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #30DA88;
    font-weight: 700;
}
.count_span{
    display: flex;
    justify-content: center;
    font-size: 15px;
    color: #646464;
}
.liclass{
    font-size: 15px;
    padding: 4px;
}
.secrowspan{
    width: 174px;
    height: 124px;
    box-sizing: border-box;    
    background: #FFFFFF;
    border: 1px solid #E9F2FF;
    border-radius: 4px;
    margin: 10px
}
.sm_inner_head{
    width: 172px !important;
}
.sm_avg_span{
    color:#FFB323 !important;
}
.img-thumbnail{
            height: 48px;
             border-radius: 50%; 
             /* size:20px; */
             max-width: 50px;
    min-width: 50px;
    width: 50px;
    /* margin-top: -4px;         */

        }
.dateclass{
    font-size:20px;
    font-weight:700;
} 
.dateclass1{
    font-size:16px;
    font-weight:500;
}  
.heading_class{
    font-size:24px;
    font-weight:700;
}


    @media only screen and (max-width: 768px) {
    .heading_class {
        font-size:20px !important;
}
.dateclass{
    font-size:18px !important;
}
.dateclass1{
    font-size:15px !important;
}
.avg_span{
    font-size:25px !important;
}
.inner_head{
    width:208px !important;
}
.rowcon{
    width: 210px !important;

}
.liclass{
    font-size:13px !important; 
}
.secrowspan{
    width: 118px !important;
    height: 103px !important;
}
.sm_inner_head{
    width: 117px !important;
}
}

/* specifically include & exclude from printing */
@media print {
    #report_parameters {
        visibility: hidden;
        display: none;
    }
    #report_parameters_daterange {
        visibility: visible;
        display: inline;
        margin-bottom: 10px;
    }
    #report_results table {
       margin-top: 0px;
    }
}

/* specifically exclude some from the screen */
@media screen {
    #report_parameters_daterange {
        visibility: hidden;
        display: none;
    }
    #report_results {
        width: 100%;
    }
}
.empty_span{
    display: flex;
    justify-content: center;
    font-size: 26px;
    font-weight: 600;
}

</style>

</head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    function form_submit(){
        var selected_cate=[];
        var startDate = $('#from_date').val();
        var endDate = $('#to_date').val();
        var date_type=$("#my_select").val();        
        $("#cat_type").val('');
        var pid=$("#form_pid").val();    
        if(pid==''){
            $("#insert_report").html(' ');
            alert("Please Select the Patient");
            
            return false;
        }
        $('.single-checkbox').each(function(){
            if($(this).is(":checked")) {        
                selected_cate.push($(this).val());
            }
        })
        if(selected_cate.length==0){
            $("#insert_report").html(' ');
            alert("Must be Choose one category");
            
            return false;
        }
        if(date_type=="customise_date"){
            if (startDate > endDate){
                $("#insert_report").html(' ');
            alert("select start date smallar than end date");
            
            return false;
        }
        }
        
    
    $("#cat_type").val(selected_cate);
    $("#form_refresh").val('true');
    var data=$("#theform").serialize();
    var pid=$("#form_pid").val();
    var graph_id =0;
 google.charts.load('current', {'packages':['corechart']});
    $.ajax({
            url:"./vitals_report.php?get_data",    //the page containing php script
            type: "post",    
            async:true,
            crossDomain:true,
            data: data,
            success:function(result){
                result=jQuery.parseJSON(result);
                if(result['status']=='true'){
                    $(".show").show();
                    chat(pid);
                }
                else{
                    $(".show").hide();
                }
                //console.log(result);
                
  
                $("#insert_report").html(result['template']);
                
            }
        });
    //$("#theform").submit();
}
function drawChart(pid,left_chart_array)
    {
        var data = new google.visualization.DataTable();
        

    
        data.addColumn("string","Date");
        data.addColumn("number","Pulse");
        
        data.addColumn("number","systolic");
        data.addColumn('number', 'diastolic');
       
        //data.addColumn({ type: "string", role: "tooltip"});
        data.addRows(left_chart_array);
        var options = {
          curveType: 'function',
          hAxis: { minValue: 0, maxValue: 9 },
          pointSize: 5,
          tooltip: {isHtml: true},
          legend: { position: 'bottom'}
        };

        var chart = new google.visualization.LineChart(document.querySelector('#left_chart'));

        chart.draw(data, options);
    }
function chat(pid){
    var data=$("#theform").serialize();
    $.ajax({
       
      
       url:'./vitals_report.php?graph',
       type: "post",    
       async:true,
       crossDomain:true,
       data: data,
       success:function (response){
         // console.log(response);
         var left_count=0;
         var right_count=0;            
         var left_chart=JSON.parse(response);       
         
         left_chart_array=[];                  
         temp_array=[];
         
         for(i=0;i<left_chart.length;i++){
            if(left_chart[i][1]>0 || left_chart[i][2]>0 || left_chart[i][3]>0){
             left_count=1;
            }
             //let label=left_chart[i][0]+' BP:'+left_chart[i][2]+'/'+left_chart[i][3];
             left_chart_array.push([left_chart[i][0],left_chart[i][1],left_chart[i][2],left_chart[i][3]]);
         }
        
         if(left_count==1){
         google.charts.setOnLoadCallback(drawChart(pid,left_chart_array,temp_array));
         }
         else{
             $('#left_chart').html("<span class='left_graph'>No Data Found</span>");
         }
         
     }
 });
}
</script>
<body class="body_top">

<!-- Required for the popup date selectors -->
<div id="overDiv" style="position: absolute; visibility: hidden; z-index: 1000;"></div>

<span class='title'><?php echo xlt('Report'); ?> - <?php echo xlt('Vitals Report'); ?></span>


<form name='theform' id='theform' method='post' action='vitals_report.php'>
<input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />

<div id="report_parameters">

<input type='hidden' name='form_refresh' id='form_refresh' value=''/>
<input type='hidden' name='form_csvexport' id='form_csvexport' value=''/>

<table>
 <tr>
  <td>
    <div style='float:left'>

    <table class='text'>
        <tr>
      <td class='col-form-label'>
        <?php echo xlt('Patient'); ?>:
      </td>
      <td>
        <input type="text" class="form-control"  name='form_patient' readeable id="form_patient" style='cursor:pointer;' placeholder='<?php echo xla('Click to select'); ?>' onclick='sel_patient()' title='<?php echo xla('Click to select patient'); ?>'>
        <input type='hidden' name='form_pid' id="form_pid"  />
        <i class="fa fa-close" id='clear_input' onclick='deselect()' style="margin-top:-25px;margin-left:160px;display:none;font-size:15px;color:red"></i>
     
      </td>
        
            <td>category</td>
            <td><input type="checkbox" class="single-checkbox"  value="bp" id="bp">&nbsp;&nbsp;Blood pressure</td>
        <td><input type="checkbox" class="single-checkbox" style="margin-left:-30px;" value="hr" id="hr">&nbsp;&nbsp;Heart Rate</td>
        <td><input type="checkbox" class="single-checkbox" style="margin-left:10px;" value="glucose" id="glucose">&nbsp;&nbsp;Glucose</td>
        <td><input type="checkbox" class="single-checkbox" style="margin-left:-60px;" value="spo2" id="spo2">&nbsp;&nbsp;SPO2</td>
        <td><input type="checkbox" class="single-checkbox" style="margin-left:0px;" value="weight" id="weight">&nbsp;&nbsp;Weight</td>
        <input type="hidden" id="cat_type" name="cat_type">
          <td>
          <div class="btn-group" role="group">
                    <a href='#' class='btn btn-secondary btn-save' onclick='form_submit()'>
                        <?php echo xlt('Submit'); ?>
                    </a>
                    <button type="button" class="btn btn-secondary btn-print show" style="display:none" onclick="printbutton()">Print</button>
                <button  type="button" class="btn btn-secondary show" style="display:none" name="create_pdf" id="create_pdf" ><i class="fa fa-download"></i> &nbsp;&nbsp;Download Report</button>
                
                    <!-- <input type="button" class="btn btn-secondary" value="download" onclick="GeneratePdf()"> -->
                    
              </div>
          </td>       

           
        </tr>
        <tr>
      <td class='col-form-label'>
        <?php echo xlt('Date Sort by'); ?>:
      </td>
      <td>
      <select id="my_select" class="form-control" name="date_type">
        <option value="first_week">First week</option>
        <option value="second_week">Second week</option>
        <option id="custom" value="customise_date">Customise date</option>
        </select>
      </td>
            <td class='col-form-label'>
                <?php echo xlt('From'); ?>:
            </td>
            <td>
                <?php
                $date=date('Y-m-d');
                ?>
            <input class='form-control datepicker1' type="date" id="from_date" name='from_date' value="<?php echo date('Y-m-d', strtotime($date. ' - 1 days')) ?>" disabled>
           
            </td>
            <td class='col-form-label'>
                <?php echo xlt('To'); ?>:
            </td>
            <td>
                
               <input class='form-control datepicker1' type='date' name='to_date' id="to_date" size='10' disabled value="<?php echo date('Y-m-d'); ?>">
            </td>
        </tr>
    </table>

    </div>

  </td>
  
 </tr>
</table>
</div>
</form>
<form method="post" id="make_pdf" action="./create_pdf.php">
    <input type="hidden" name="hidden_html" id="hidden_html" />
    <input type="hidden" name="from_date" id="pdf_from_date" />
    <input type="hidden" name="pid" id="pid" />
    <input type="hidden" name="to_date" id="pdf_to_date" />
    <input type="hidden" name="date_type" id="select_date" />
    <input type="hidden" name="img_val" id="img_val" />
    
  
    
   </form>
<div id="insert_report">

</div>    
   
</body>

</html>

<script>

function printbutton() {
    
     var printContents = document.getElementById('insert_report').innerHTML;    
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
    
}
      
         function setpatient(pid, lname, fname, dob) {
            var f = document.forms[0];
            f.form_patient.value = lname + ', ' + fname;
            f.form_pid.value = pid;
        
            if (f.form_pid.value) {
            var text=document.getElementById("clear_input").style.display = "block";
            // console.log(text);
            }
            else{
                var text=document.getElementById("clear_input").style.display = "none";
            }
    //dlgclose();
    }
        
function sel_patient() {
    let title = '<?php echo xlt('Patient Search'); ?>';
    dlgopen('../../main/calendar/find_patient_popup.php', 'findPatient', 650, 300, '', title);
   
}
$(document).ready(function() {
    $('#my_select').change(function() {
        
      if ($(this).val() == 'customise_date') {
        //alert('hi');
        $('.datepicker1').prop('disabled', false);
      } else {
        $('.datepicker1').prop('disabled', true);
      }
    });
  });

  $(function () {
    oeFixedHeaderSetup(document.getElementById('mymaintable'));
   
});

function removeVal(arr, val)
{
    for(var i = 0; i < arr.length; i++)
    {
        if (arr[i] == val)
            arr.splice(i, 1);
    }
}
var selected_cate=[];
$('input.single-checkbox').on('change', function(evt) {

    var id=$(this).val();
  
    //alert('ss');
    if($(this).prop('checked')==true){
        var checked_limit=$('.single-checkbox:checked').length;
        
        //alert(id);
        if(checked_limit >=3) 
        {
            alert('Maximum 2 catergory selecedted only');
            this.checked = false;
            return false;
        }
        if(id=='bp'){
            $(".single-checkbox").prop('checked',false); 
            $("#hr").prop('checked',true); 
            $("#bp").prop('checked',true);
        }
        else if(id=='hr'){
            $(".single-checkbox").prop('checked',false);
            $("#bp").prop('checked',true);
            $("#hr").prop('checked',true);
        }
    }
    else{
        var checked_limit=$('.single-checkbox:checked').length;
        if(checked_limit ==0) 
        {
            this.checked = true;
            return false;
        }
        if(id=='bp'){
            $("#hr").prop('checked',false); 
        } 
        else if(id=='hr'){
            $("#bp").prop('checked',false);
        }
    }
});
function drawChart(pid,left_chart_array)
     {
        var data = new google.visualization.DataTable();
        

    
        data.addColumn("string","Date");
        data.addColumn("number","Pulse");
        
        data.addColumn("number","systolic");
        data.addColumn('number', 'diastolic');
       
        //data.addColumn({ type: "string", role: "tooltip"});
        data.addRows(left_chart_array);
        var options = {
          curveType: 'function',
          hAxis: { minValue: 0, maxValue: 9 },
          pointSize: 5,
          tooltip: {isHtml: true},
          legend: { position: 'bottom'}
        };

        var chart = new google.visualization.LineChart(document.querySelector('#left_chart'));

        chart.draw(data, options);
    }

   $('#create_pdf').click(function(){
    //alert('ss');
    $('#left_chart table').html(' ');
    var chart_val=$('#left_chart svg').html();
    var pid=$("#form_pid").val();
    var from_date=$("#from_date").val();
    var to_date=$("#to_date").val();    
    var date_type=$("#my_select").val();
    console.log(chart_val);
    chart_val=btoa(chart_val); 
    var img_val=$('#image_src').html();
  $('#hidden_html').val(chart_val); 
  $("#pid").val(pid);
  $("#pdf_from_date").val(from_date);
  $("#pdf_to_date").val(to_date);
  $("#select_date").val(date_type); 
  $("#img_val").val(img_val); 
  $('#make_pdf').submit();
 });

 function deselect() {
    
    var text=document.getElementById("form_patient").value = "";
    text=document.getElementById("form_pid").value = "";
    //alert(text);
    //$('#clear_input').hide();
    var text_1=document.getElementById("clear_input").style.display = "none";
//alert(text_1);
}


</script>

    
