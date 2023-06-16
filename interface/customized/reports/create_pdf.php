<?php

//create_pdf.php

require_once("../../globals.php");

require_once("$srcdir/api.inc");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
?>
<?php
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
       $color='#748724'; //elevedted
   }
   if($systolic>=130 && $systolic<=139 || $diastolic>80 && $diastolic<=89){
       $color='#d96614f5';//light organge=>high
       
   }
   if($systolic>=140 && $systolic<=179 || $diastolic>=90 && $diastolic<=119){
       $color='#ed1b1bf0'; //high2 red
   }
  if($systolic>=180 || $diastolic>=120){
       $color='#8B0000'; //high3
   }
   if($systolic<120 && $diastolic<80) {
        $color='#0c7442'; //normal
       } 
       return $color;   
   }

// include('pdf.php');
//echo '<pre>';print_r($_POST);
use Mpdf\Mpdf;
$mpdf = new mPDF();
$graph1=base64_decode($_POST['hidden_html']);
$graph='<svg width="1076" height="500" aria-label="A chart." style="overflow: hidden;">';
$graph.=$graph1;
$graph.='</svg>';

//echo $graph;exit();
$img_val=$_POST['img_val'];
$pid=$_POST['pid'];
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
    $report_pdf_name=date('m-d-Y', strtotime($start_date)).' to '.date('m-d-Y', strtotime($end_date));
    //echo $start_date;
    
    
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
          
            $color_text=color_change($systolic,$dyslitic);
            $overal_avg_count=$total_avg['id'];    
              
            $max_sys=sqlQuery("SELECT  MAX(CAST(systolic AS SIGNED)) as systolic,reading_time FROM api_vitals_data WHERE pid=".$pid." AND systolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND systolic=(select MAX(CAST(systolic AS SIGNED)) as systolic from api_vitals_data WHERE pid=".$pid." AND systolic!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            $max_dys=sqlQuery("SELECT  MAX(CAST(diastolic AS SIGNED))  as diastolic,reading_time FROM api_vitals_data WHERE pid=".$pid." AND diastolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND diastolic=(select MAX(CAST(diastolic AS SIGNED)) as diastolic from api_vitals_data WHERE pid=".$pid." AND diastolic!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            $min_sys=sqlQuery("SELECT MIN(CAST(systolic AS SIGNED)) as systolic,reading_time FROM api_vitals_data WHERE pid=".$pid." AND systolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND systolic=(select MIN(CAST(systolic AS SIGNED)) as systolic from api_vitals_data WHERE pid=".$pid." AND systolic!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            $min_dys=sqlQuery("SELECT MIN(CAST(diastolic AS SIGNED)) as diastolic ,reading_time FROM api_vitals_data WHERE pid=".$pid." AND diastolic!=0 AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' AND diastolic=(select MIN(CAST(diastolic AS SIGNED)) as diastolic from api_vitals_data WHERE pid=".$pid." AND diastolic!=0 and reading_date BETWEEN '".$start_date."' AND '".$end_date."')");
            
            
            
            $day_avg=sqlQuery("SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic, count(id) as id FROM api_vitals_data WHERE time(reading_time)>='06:00:00' and time(reading_time)<='21:00:00 ' AND pid='".$pid."' AND systolic!=0 AND reading_date BETWEEN '".$start_date."' and '".$end_date."'");
            // echo "SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic, count(id) as id FROM api_vitals_data WHERE time(reading_time)>='06:00:00' and time(reading_time)<='21:00:00 ' AND pid='".$pid."' AND systolic!=0 AND reading_date BETWEEN '".$start_date."' and '".$end_date."'";
            // exit();
            $total_day_avg=isset($day_avg['systolic'])&&$day_avg['systolic']!=NULL?round($day_avg['systolic']).'/'.round($day_avg['diastolic']):0;
            $total_day_avg_count=$day_avg['id']&&$day_avg['id']!=NULL?$day_avg['id']:0;
            $day_avg_color=color_change($day_avg['systolic'],$day_avg['diastolic']);
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

           
            $table1='<table style="width:100%;border:1px solid black" Cellspacing="0px" cellpadding="8px">
            <tr style="border:1px solid black">
            <th style="border:1px solid black"></td>
            <th style="border:1px solid black">Maximum </th>
            <th style="border:1px solid black">Minimum </th>
            <th style="border:1px solid black">Maximum Date/Time </th>
            <th style="border:1px solid black">Minimum Date/Time</th>
            </tr>
            <tr style="border:1px solid black">
            <th style="border:1px solid black">Systolic</th>
            <td style="border:1px solid black">'.$maxsys.' mmHg</td>
            <td style="border:1px solid black">'.$min1.' mmHg</td>
            <td style="border:1px solid black">'.$max_sys_time.'</td>
            <td style="border:1px solid black">'.$min_sys_time.'</td>
            </tr>
            <tr style="border:1px solid black">
            <th style="border:1px solid black">Diastolic</th>
            <td style="border:1px solid black">'.$maxdys.'mmHg</td>
            <td style="border:1px solid black">'.$min2.' mmHg</td>
            <td style="border:1px solid black">'.$max_dys_time.'</td>
            <td style="border:1px solid black">'.$min_dys_time.'</td>
            </tr>
            <tr style="border:1px solid black">
            <th style="border:1px solid black">Heart Rate </th>
            <td style="border:1px solid black">'.$max_pulse['pulse'].' bpm</td>
            <td style="border:1px solid black">'.$min_pulse['pulse'].' bpm</td>
            <td style="border:1px solid black">'.$max_pulse_time.'</td>
            <td style="border:1px solid black">'.$min_pulse_time.'</td>
            </tr>   
            </table>';

            $list='
            <li class="liclass">maximum systolic bloood pressure '.$maxsys.' recorded an '.$max_sys_time.'</li>
            <li class="liclass">maximum diastolic bloood pressure '.$maxdys.' recordeed an '.$max_dys_time.'</li>
            <li class="liclass">minumum systolic bloood pressure '.$min1.' recordeed an '.$min_sys_time.'</li>
            <li class="liclass">minumum diastolic bloood pressure '.$min2.' recordeed an '.$min_dys_time.'</li>';

            $list1='
            <li class="liclass">maximum pulse '.$max_pulse['pulse'].' recorded an '.$max_pulse_time.'</li>            
            <li class="liclass">minumum pulse '.$min_pulse['pulse'].' recordeed an '.$min_pulse_time.'</li>';

            $overal_avg_text=reading_text($overal_avg_count);
            $day_avg_text=reading_text($total_day_avg_count);
            $night_avg_text=reading_text($total_night_avg_count);
            $overal_avg_text1=reading_text($overal_avg1_count);
            $day_avg_text1=reading_text($total_day_avg_count1);
            $night_avg_text1=reading_text($total_night_avg_count1);
         
            
            $query=sqlstatement("select id,reading_date,pulse,systolic,diastolic from api_vitals_data where pid='".$pid."' AND (systolic!='NULL' OR pulse!='NULL' OR diastolic!='NULL' ) AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY reading_date");
    // echo "select id,reading_date,pulse,systolic,diastolic from api_vitals_data where pid='".$pid."' AND (systolic!='NULL' OR pulse!='NULL' OR diastolic!='NULL' ) AND reading_date BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY reading_date";
    $reading_date=[];
    $table2='';
    while($res=sqlFetchArray($query)){
    
        
        $date=$res['reading_date'];
        $avg_query=sqlQuery("SELECT AVG(systolic) as systolic,AVG(diastolic) as diastolic,AVG(pulse) as pulse, count(id) as id,reading_time FROM api_vitals_data WHERE pid=".$pid." AND systolic!=0 AND reading_date='".$date."'");
         
        $pulse=isset($avg_query['pulse'])?round($avg_query['pulse']):'0';
        $systolic=isset($avg_query['systolic'])?round($avg_query['systolic']):'0';
        $diastolic=isset($avg_query['diastolic'])?round($avg_query['diastolic']):'0';  
        $reading_date = date('m-d-Y', strtotime($avg_query['reading_time']));
        $reading_time = date('H:i A', strtotime($avg_query['reading_time']));
        $table2.='<tr><td align="center">'.$reading_date.'</td>
        <td align="center">'.$reading_time.'</td>
        <td align="center">'.$systolic.'/'.$diastolic.'</td>
        <td align="center">'.$pulse.'</td>
        </tr>';
        
    
    }
       
        }
        else{
            
            $error_count++;
        }
 $html='<body>' ;   
$html.='<table style="width:100%;background: #E1E4F0; border:none !important" class="table">
<tr><td style="width:80%;border:none !important"><span style="font-size: 20px;"><strong>Weekly '.$report_name.' Report</strong></span><br><strong><span style="font-size: 16px;font-weight: 700">'.$report_date.'</sapn></strong></td>
<td style="width:46%;font-size: 16px; border:none !important" align="right"><strong>'.$patient_name.'<br>'.$dob.'<br>MRN:'.$pid.'</strong></td>
<td style="width:2%;border:none !important" align="right">'.$img_val.'</td></tr>
</table>
<div style="margin-top:10px;background: #6b7cb6;justify-content: center;font-size: 16px;font-weight: 700;color: white;">
<div style="align-items:center;" align="center">
   <img src="./bp1.png" width="23" height="23"><strong>Average Blood Pressure</strong>
</div>
</div>
<div style="width: 100%;" >
<div align="left" style="width: 33%;float: left;">
   <div class="mt-2">
      <div class="rowcon">
         <div class="inner_head">
            <div class="inner_head_span" align="center"><strong>Overall</strong></div>
         </div>
         <div class="avg_span" style="color:'.$color_text.'" align="center"><strong>'.$overal_avg.'';
         if($overal_avg!=0){
            $html.='<span style="font-size:15px"> mmHg</span>';
         }
         
         $html.='</strong></div>
         <div class="count_span" align="center">'.$overal_avg_count.'  '.$overal_avg_text.'</div>
      </div>
   </div>
</div>
<div align="left" style="width: 33%;float: left;">
   <div class="rowcon">
      <div class="inner_head" align="center">
         <div class="inner_head_span" align="center"><strong>Day (6am to 10pm)</strong></div>
      </div>';
      if($total_day_avg_count!=0){
         $html.='<div class="avg_span" style="font-size: 32px;display:flex;align-items:center;justify-content: center;color:'.$day_avg_color.'" align="center">
         <strong>'.$total_day_avg.'      
         <span style="font-size:15px"> mmHg</span>      
     </strong></div>
      <div class="count_span" align="center">'.$total_day_avg_count.' '.$day_avg_text.'</div>';
      }
      else{
         $html.='<div class="avg_span" align="center"><div style="font-size:16px;padding-top:5px;" align="center"><strong>No readings were available</strong></div>    
     </div>';
      
      }
      

   $html.='</div>
</div>
<div align="left" style="width: 33%;float: left;">
   <div class="rowcon">
      <div class="inner_head" >
         <div class="inner_head_span" align="center"><strong>Night (10pm to 6am)</strong></div>
      </div>';

      if($total_night_avg_count!=0){
         $html.='<div class="avg_span" style="color:'.$night_avg_color.'" align="center" align="center"><strong>'.$total_night_avg.'      
         <span style="font-size:15px"> mmHg</span>      
     </strong></div>
      <div class="count_span" align="center">'.$total_night_avg_count.' '.$night_avg_text.'</div>';
      }
      else{
         $html.='<div class="avg_span" align="center"><div style="font-size:15px;padding-top:5px;" align="center"><strong>No readings were available</strong></div></div>';
      
      }
   $html.='</div>
</div>
</div>

<div style="margin-top:10px;background: #6b7cb6;justify-content: center;font-size: 16px;color: white;">
<div style="align-items:center;" align="center">  
   <img src="./pulse1.png" width="23" height="23"><strong>Average Heart Rate </strong>
</div>
</div>
<div style="width: 100%;" >
<div align="left" style="width: 33%;float: left;">
   <div class="secrowspan">
      <div class="inner_head sm_inner_head" >
         <div class="inner_head_span" align="center"><strong>Overall</strong></div>
      </div>
      <div class="avg_span sm_avg_span" align="center"><strong>'.$overal_avg1.'<span style="font-size:15px"> bpm</span></strong></div>
      <div class="count_span" align="center">'.$overal_avg1_count.' '.$overal_avg_text1.'</div>
   </div>
</div>
<div align="left" style="width: 33%;float: left;">
   <div class="secrowspan" align="center">
      <div class="inner_head sm_inner_head" >
         <div class="inner_head_span" align="center"><strong>Day (6am to 10pm)</strong></div>
      </div>';
      if($total_day_avg_count1!=0){
         $html.=' <div class="avg_span sm_avg_span" align="center"><strong>'.$total_day_avg1.'
         <span style="font-size:15px"> bpm</span></strong></div>
          <div class="count_span" align="center">'.$total_day_avg_count1.' '.$day_avg_text1.'</div>';
      }
      else{
         $html.='<div class="avg_span sm_avg_span" align="center" style="padding-top:16px !important;" ><div style="font-size:16px;padding-top:15px;" align="center"><strong>No readings were available</strong></div>    
         </div>';
      }
     
   $html.='</div>
</div>
<div align="left" style="width: 33%;float: left;">
   <div class="secrowspan">
      <div class="inner_head sm_inner_head">
         <div class="inner_head_span" align="center"><strong>Night (10pm to 6am)</strong></div>
      </div>';
      if($total_night_avg_count1!=0){
         $html.='<div class="avg_span sm_avg_span" align="center"><strong>'.$total_night_avg1.'
         <span style="font-size:15px"> bpm</span></strong></div>
         <div class="count_span" align="center">'.$total_night_avg_count1.' '.$night_avg_text1.'</div>';
      }
      else{
         $html.='<div class="avg_span sm_avg_span" align="center"><div style="font-size:16px;padding-top:15px;" align="center"><strong>No readings were available</strong></div>    
         </strong></div>';
      }
      
   $html.='</div>
</div>
</div>
<div class="row" style="margin-top:10px">
<div>

'. $table1.'

</div>
</div>

<div style="margin-top:20px;align-items:center;" align="center"><strong>BP & HR Flowsheet</strong>


</div>
        ';

$html.=$graph.'<div class="row" style="margin-top:50px">
<div style="margin-top:40px"><table Cellspacing="0px" cellpadding="8px"><tr><th>Date</th><th>Time</th><th>Bp (mmHg)</th><th>HR (bpm)</th></tr>

'. $table2.'
</table>
</div>
</div>';
$html.='</body>';

//echo '<pre>';print_r($report_pdf_name);exit();
$file_name = $report_pdf_name.'Bp Report.pdf';
$stylesheet = file_get_contents('./pdf.css'); // external css
$mpdf->WriteHTML($stylesheet,1);
$mpdf->setTitle($file_name);
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->WriteHTML($html);     
$mpdf->defaultfooterline = 0;
        //$pdf= $dir.$pid.'_'.mt_rand(10,100).'consent_form'.'.pdf';
$mpdf->Output($file_name,'D');

?>