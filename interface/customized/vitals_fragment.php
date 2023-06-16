<?php

/**
 * vitals_fragment.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");
ini_set('display_errors',true);
require_once($GLOBALS["srcdir"] . "/api.inc");
require_once($GLOBALS['srcdir'] . '/encounter_events.inc.php');
use OpenEMR\Common\Csrf\CsrfUtils;

// if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
//     CsrfUtils::csrfNotVerified();
// }
function cminc($cm)
{
     $inches = $cm/2.54;
     $inches = $inches%12;
     return $inches;
}
function api_type($api_name){
  $api_type='';
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
  if($api_name=='omron_api')
  {
    $api_type='Omron';
  }
  if($api_name=='bodytrace_api')
  {
    $api_type='Body Trace';
  }
  
  return $api_type;
}
// if(!$pid){
// $pid=$_GET['pid'];
// }
?>
<style>
          .heading {
    text-align: center;
    color: #454343;
    font-size: 30px;
    font-weight: 700;
    position: relative;
    margin-bottom: 70px;
    text-transform: uppercase;
    z-index: 999;
}
.white-heading{
    color: #ffffff;
}
.heading:after {
    content: ' ';
    position: absolute;
    top: 100%;
    left: 50%;
    height: 40px;
    width: 180px;
    border-radius: 4px;
    transform: translateX(-50%);
    background: url(img/heading-line.png);
    background-repeat: no-repeat;
    background-position: center;
}
.white-heading:after {
    background: url(https://i.ibb.co/d7tSD1R/heading-line-white.png);
    background-repeat: no-repeat;
    background-position: center;
}

.heading span {
    font-size: 18px;
    display: block;
    font-weight: 500;
}
.white-heading span {
    color: #ffffff;
}
/*-----Testimonial-------*/

/* .testimonial:after {
    position: absolute;
    top: -0 !important;
    left: 0;
    content: " ";
    background: url(img/testimonial.bg-top.png);
    background-size: 100% 100px;
    width: 100%;
    height: 100px;
    float: left;
    z-index: 99;
} */


#testimonial4 .carousel-inner:hover{
  cursor: -moz-grab;
  cursor: -webkit-grab;
}
#testimonial4 .carousel-inner:active{
  cursor: -moz-grabbing;
  cursor: -webkit-grabbing;
}
#testimonial4 .carousel-inner .item{
  overflow: hidden;
}

.testimonial4_indicators .carousel-indicators{
  left: 0;
  margin: 0;
  width: 100%;
  font-size: 0;
  height: 20px;
  bottom: 15px;
  padding: 0 5px;
  cursor: e-resize;
  overflow-x: auto;
  overflow-y: hidden;
  position: absolute;
  text-align: center;
  white-space: nowrap;
}
.testimonial4_indicators .carousel-indicators li{
  padding: 0;
  width: 14px;
  height: 14px;
  border: none;
  text-indent: 0;
  margin: 2px 3px;
  cursor: pointer;
  display: inline-block;
  background: #ffffff;
  -webkit-border-radius: 100%;
  border-radius: 100%;
}
.testimonial4_indicators .carousel-indicators .active{
  padding: 0;
  width: 14px;
  height: 14px;
  border: none;
  margin: 2px 3px;
  background-color: #9dd3af;
  -webkit-border-radius: 100%;
  border-radius: 100%;
}
.testimonial4_indicators .carousel-indicators::-webkit-scrollbar{
  height: 3px;
}
.testimonial4_indicators .carousel-indicators::-webkit-scrollbar-thumb{
  background: #eeeeee;
  -webkit-border-radius: 0;
  border-radius: 0;
}

.testimonial4_control_button .carousel-control{
  top: 175px;
  opacity: 1;
  width: 40px;
  bottom: auto;
  height: 40px;
  font-size: 10px;
  cursor: pointer;
  font-weight: 700;
  overflow: hidden;
  line-height: 38px;
  text-shadow: none;
  text-align: center;
  position: absolute;
  background: transparent;
  border: 2px solid #ffffff;
  text-transform: uppercase;
  -webkit-border-radius: 100%;
  border-radius: 100%;
  -webkit-box-shadow: none;
  box-shadow: none;
  -webkit-transition: all 0.6s cubic-bezier(0.3,1,0,1);
  transition: all 0.6s cubic-bezier(0.3,1,0,1);
}
.testimonial4_control_button .carousel-control.left{
  left: 7%;
  top: 50%;
  right: auto;
}
.testimonial4_control_button .carousel-control.right{
  right: 7%;
  top: 50%;
  left: auto;
}
.testimonial4_control_button .carousel-control.left:hover,
.testimonial4_control_button .carousel-control.right:hover{
  color: #000;
  background: #fff;
  border: 2px solid #fff;
}

.testimonial4_header{
  top: 0;
  left: 0;
  bottom: 0;
  width: 550px;
  display: block;
  margin: 30px auto;
  text-align: center;
  position: relative;
}
.testimonial4_header h4{
  color: #ffffff;
  font-size: 30px;
  font-weight: 600;
  position: relative;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.testimonial4_slide{
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 70%;
  margin: auto;
  padding: 20px;
  position: relative;
  text-align: center;
}

.testimonial4_slide p {
    color: #ffffff;
    font-size: 20px;
    line-height: 1.4;
    margin: 40px 0 20px 0;
}
.testimonial4_slide h4 {
  color: #ffffff;
  font-size: 22px;
}


.testimonial .carousel-control-next-icon, .testimonial .carousel-control-prev-icon {
    width: 35px;
    height: 35px;
}
section.testimonial.text-center {
    background: white;
    box-shadow: 0px 0px 6px 0px #bcb4b4;
    border-radius: 6px;
    padding: 0;
}
.carousel-control-prev {
    left: 5px;
}.carousel-control-next {
    right: 5px;
}
/* ------testimonial  close-------*/


.col-col {
    display: flex;
    width: 20%;
    min-width: 20%;
    align-items: center;
    background: white;
    margin:5px 0;
    padding: 5px 5px;
    min-height: 94px;
    flex-direction: row;
    text-align: left;
    margin-right: 0;
    border-right: 1px solid #a6b0d3;
}.col-col .text {
    font-size: 15px;
    padding: 5px 0;
    font-weight: bold;
}span.smbl {
    font-size: 12px;
    color: #5b5858;
    font-weight: bold;
}.carousel-item .row {
    margin: 0;
}.col-col img {
    margin-right: 7px;
    height: 24px;
    width: auto;
}.col-col:last-child {
    border-right: 0;
}.carousel i.fa {
    color: black;
    width: 22px;
    height: 22px;
    line-height: 23px;
    border-radius: 50%;
    /* box-shadow: 0px 0px 4px 2px #957f7f; */
}.carousel-control-next, .carousel-control-prev{
  width:2% !important;
}.col-col .font-weight-bold.d-inline-block {
    font-weight: 600 !important;
    width: 100%;
    text-align: left;
    min-height: 40px;
}
.carousel-inner.cls-w {
    width: 94%;
    min-height: 104px;
}
.testimonialtest{
  display: flex;
    justify-content: center;
}
div#testimonial4 {
    display: flex;
    justify-content: center;
}.text.text1 {
    font-size: 12px;
    padding: 0;
}.img_val {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}.col-col div:first-child {
    width: 100%;
}
</style>
<div id='vitals'><!--outer div-->

    <?php
    $vitals_data=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pulse!='NULL' AND pid=".$pid.")");
    $pulse_data=isset($vitals_data['pulse'])?$vitals_data['pulse']:'';
    $pulse_api_type=isset($vitals_data['api_type'])?$vitals_data['api_type']:'';
    $pulse_api=api_type($pulse_api_type);    

    $blood_pressure=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND systolic!='' AND diastolic!='') AND systolic!='' AND diastolic!=''");
    $pb_api_type1=  isset($blood_pressure['api_type'])?$blood_pressure['api_type']:''; 
    $pb_api_type=api_type($pb_api_type1);  
    $systolic= isset($blood_pressure['systolic'])?$blood_pressure['systolic']:''; 
    $diastolic= isset($blood_pressure['diastolic'])?$blood_pressure['diastolic']:'';   
    if(!empty($systolic)&& !empty($diastolic))
    {
      $blood_pressure_data=$systolic.'/'.$diastolic;
    }

    $blood_glucose=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE pid=".$pid." AND blood_glucose!='') AND blood_glucose!=''");
    $glucose_data= isset($blood_glucose['blood_glucose'])?$blood_glucose['blood_glucose']:'';
    $glu_api_type=  isset($blood_glucose['api_type'])?$blood_glucose['api_type']:''; 
    $glucose_api_type=api_type($glu_api_type);
    
    
    $weight_data='';
    $height_data='';
    $bmr_v='';
    $reading_date_org=sqlQuery("SELECT Max(reading_time) as reading_time FROM api_vitals_data WHERE  pid=".$pid."");
    $reading_dates_org=$reading_date_org['reading_time']?$reading_date_org['reading_time']:date('Y-m-d');
    $weight=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE weight_kg!='NULL' AND pid=".$pid.") AND weight_kg!='NULL'");
    $weight_api_type=isset($weight['api_type'])?$weight['api_type']:'';    
    $weight_api=api_type($weight_api_type);

    
    $height=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE height_cm!='NULL' AND pid=".$pid.") AND height_cm!='NULL'");
    $bmr=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE bmr!='NULL' AND bmr!=0 AND pid=".$pid.") AND bmr!='NULL' AND bmr!=0");
    $distance=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND distance_data!='NULL' ORDER BY id DESC limit 1");
    $steps=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND steps_data!='NULL' ORDER BY id DESC limit 1");
    $calories=sqlQuery("SELECT * FROM api_vitals_data WHERE pid=".$pid." AND reading_time=(SELECT Max(reading_time) FROM api_vitals_data WHERE calories_reading!='NULL' AND calories_reading!=0 AND pid=".$pid.") AND calories_reading!='NULL' AND calories_reading!=0");
    $google_api_type='GoogleFit';

    if(!empty($height)){
      $height_cm=isset($height['height_cm'])?$height['height_cm']:'';    
      $height_inc=cminc($height_cm);
      
      if(!empty($height_inc) || !empty($height_cm)){
        $height_data=$height_inc.'/'.round($height_cm);
      }
    }
    $weight_lbs='';
    if(!empty($weight)){
      $weight_kg=isset($weight['weight_kg'])?$weight['weight_kg']:''; 
      if($weight_kg!=''){
        $weight_lbs=round($weight_kg*2.20462262);
      }   
      
      
      if(!empty($weight_kg) || !empty($weight_lbs)){
        $weight_data=$weight_lbs.'/'.round($weight_kg);
      }
    }  

    if(!empty($bmr)){
      $bmr_v=isset($weight['bmr'])?$weight['bmr']:''; 
    }

    if(!empty($distance)){
      $distance_r=isset($distance['distance_data'])?$distance['distance_data']:''; 
    }

    if(!empty($steps)){
      $steps_r=isset($steps['steps_data'])?$steps['steps_data']:''; 
    }

    if(!empty($calories)){
      $calories_r=isset($calories['calories_reading'])?$calories['calories_reading']:''; 
    }    
    if(!empty($pulse_data)||!empty($blood_pressure_data)|| !empty($glucose_data) || !empty($height_data) || !empty($weight_data) || !empty($bmr_v) || !empty($distance_r) || !empty($steps_r) || !empty($calories_r))
    {
      
         
        ?>

      <span class='text'><b>
      <?php 
      date_default_timezone_set('US/Eastern');
      echo xlt('Most recent vitals from:') . " " .text(date('m/d/Y H:i:s',strtotime($reading_dates_org))); ?>  
        </b></span>
        <br />
        <br />
        <section class="testimonial text-center body_title acck">
            <div class="container p-0">
                <div id="testimonial4" class="testimonialtest carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x" data-ride="carousel" data-pause="hover" data-interval="false" data-duration="2000">
                    <a class="carousel-control-prev" href="#testimonial4" data-slide="prev">
                    <span class=""><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                    </a>
                    <?php
                    
                    $array_data=[];
                    if($glucose_data){
                      $array_data[]['glucose']=$glucose_data;
                    }
                    if($pulse_data){
                      $array_data[]['pulse']=$pulse_data;
                    }
                    if($blood_pressure_data){
                      $array_data[]['pb']=$blood_pressure_data;
                      
                    }
                    if($height_data){
                      $array_data[]['height']=$height_data;
                    }
                    if($weight_data){
                      $array_data[]['weight']=$weight_data;
                    }
                    if($bmr_v){
                      $array_data[]['bmr']=$bmr_v;
                    }
                    if($distance_r){
                      $array_data[]['distance']=$distance_r;

                    }
                    if($steps_r){
                      $array_data[]['step']=$steps_r;

                    }
                    if($calories_r){
                      $array_data[]['calory']=$calories_r;
                    }
                    
                    //echo '<pre>';print_r($array_data);exit();
                    ?>
                    <div class="carousel-inner cls-w" role="listbox">
                        <div class="carousel-item active">
                            <div class="row">
                              <?php
                                $api_data='';
                                $count=0;
                                foreach($array_data as $key=>$value)
                                {
                                  $count++;
                                  if($count==6 || $count ==11){
                                    $api_data.='</div></div><div class="carousel-item"><div class="row">';
                                  }
                                  if(isset($array_data[$key]['glucose']))
                                  {
                                    
                                    $api_data.= "<div class='col-col'><div><div class='font-weight-bold d-inline-block'>Blood Glucose<span class='smbl'>&nbsp;(mg/dl)</span></div>
                                    <div class='img_val'><img src='../../customized/image/glucose.png'  width='28' height='28'><div class='text' style='display:inline-block'>".$value['glucose']."</div></div>
                                    <span class='badge' style='background: #6b7cb6;color:white'>".$glucose_api_type."</span>
                                  
                                    </div></div>"; 
                                    //unset($array_data[$key]['glucose']);
                                  }
                                  if(isset($array_data[$key]['pulse']))
                                  {
                                    $api_data.= "<div class='col-col'><div><div class='font-weight-bold d-inline-block'>Pulse</div>
                                    <div class='img_val'><img src='../../customized/image/Pulse.png'  width='28' height='28'><div class='text' style='display:inline-block'>".$value['pulse']."</div></div>
                                    <span class='badge' style='background: #6b7cb6;color:white'>".$pulse_api."</span>
                                    </div></div>"; 
                                    //unset($array_data[$key]['pulse']);
                                  }
                                  if(isset($array_data[$key]['pb']))
                                  {
                                    $api_data.= "<div class='col-col'><div><div class='font-weight-bold d-inline-block'>Blood Pressure<span class='smbl'>&nbsp;(mmHg)</span></div>
                                    <div class='img_val'><img src='../../customized/image/BloodPressure.png'  width='28' height='28'><div class='text' style='display:inline-block'>".$value['pb']."</div></div>
                                    <span class='badge' style='background: #6b7cb6;color:white'>".$pb_api_type."</span>
                                    </div></div>"; 
                                    //unset($array_data[$key]['pb']);
                                  }
                                  if(isset($array_data[$key]['height']))
                                  {
                                    $api_data.= " <div class='col-col'><div><div class='font-weight-bold d-inline-block'>Height<span class='smbl'>&nbsp;in/cm</span></div>
                                    <div class='img_val'><img src='../../customized/image/Height.png'  width='28' height='28'><div class='text' style='display:inline-block'>".$value['height']."</div></div>
                                    <span class='badge' style='background: #6b7cb6;color:white'>GoogleFit</span>
                                    </div></div>"; 
                                    //unset($array_data[$key]['height']);
                                  }
                                  if(isset($array_data[$key]['weight']))
                                  {
                                    $api_data.= "<div class='col-col'><div><div class='font-weight-bold d-inline-block'>Weight<span class='smbl'>&nbsp;(lb)/kg</span></div>
                                    <div class='img_val'><img src='../../customized/image/Weight.png'  width='28' height='28'><div class='text' style='display:inline-block'>".$value['weight']."</div></div>
                                    <span class='badge' style='background: #6b7cb6;color:white'>".$weight_api."</span>
                                    </div></div>"; 
                                    //unset($array_data[$key]['weight']);
                                  }
                                  if(isset($array_data[$key]['bmr']))
                                  {
                                    $api_data.= "<div class='col-col'><div><div class='font-weight-bold d-inline-block'>BMR</div>
                                    <div class='img_val'><img src='../../customized/image/bmists.png'  width='28' height='28'><div class='text' style='display:inline-block'>".$value['bmr']."</div></div>
                                    <span class='badge' style='background: #6b7cb6;color:white'>GoogleFit</span>
                                    </div></div>"; 
                                  
                                  }



                                  if(isset($array_data[$key]['distance']))
                                  {
                                    $api_data.= " <div class='col-col'><div><div class='font-weight-bold d-inline-block'>distance<span class='smbl'>&nbsp;meter</span></div>
                                    <div class='img_val'><img src='../../customized/image/Height.png'  width='28' height='28'><div class='text' style='display:inline-block'>".round($value['distance'])."</div></div>
                                    <span class='badge' style='background: #6b7cb6;color:white'>GoogleFit</span>
                                    </div></div>"; 
                                    //unset($array_data[$key]['height']);
                                  }
                                  if(isset($array_data[$key]['step']))
                                  {
                                    $api_data.= "<div class='col-col'><div><div class='font-weight-bold d-inline-block'>Step<span class='smbl'>&nbsp;step</span></div>
                                    <div class='img_val'><img src='../../customized/image/Weight.png'  width='28' height='28'><div class='text' style='display:inline-block'>".round($value['step'])."</div></div>
                                    <span class='badge' style='background: #6b7cb6;color:white'>GoogleFit</span>
                                    </div></div>"; 
                                    //unset($array_data[$key]['weight']);
                                  }
                                  if(isset($array_data[$key]['calory']))
                                  {
                                    $api_data.= "<div class='col-col'><div><div class='font-weight-bold d-inline-block'>Calories</div>
                                    <div class='img_val'><img src='../../customized/image/bmi.png'  width='28' height='28'><div class='text' style='display:inline-block'>".round($value['calory'])."</div></div>
                                    <span class='badge' style='background: #6b7cb6;color:white'>GoogleFit</span>
                                    </div></div>"; 
                                  
                                  }
                                 
                                  
                                }
                                echo $api_data;
                                //exit();
                              ?>
                     
                            </div>
                        </div>
                        
                    </div>
                    <a class="carousel-control-next" href="#testimonial4" data-slide="next">
                        <span class=""><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    </a>
                </div>
            </div>
        </section>

      <?php 
    }
    
    else {
      ?>
      <span class='text'><?php echo xlt("No vitals have been documented."); ?></span>
      <?php
    }
    ?>
</div>

