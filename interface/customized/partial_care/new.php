<?php

/**
 * Clinical instructions form.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2017-2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
if ($formid) {
    $sql = "SELECT * FROM `form_partial_care` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();

?>
<html>
 <head>
        <title><?php echo xlt("Master Treatment Plan"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
  <style type="text/css">
              td{
                font-size: 15px;
              }
              #id1{
                margin-left: 56px;
              }
              input {
                border: 0;
                outline: 0;
                border-bottom: 1px solid black;

                
                      
              }
              .h3_1{
                text-align:center;
                font-size: 20px;
              }
              .tabel5 td p{
                margin-left: 10px;
              }
              b{
                margin-left: 10px;
              }
              input[type="checkbox"] {
                  margin-right: 5px;
              }
              .btndiv {
                text-align: center;
                margin-bottom: 18px;
              }
              button.subbtn {
                background: blue;
                color: white;
              }
              button.cancel {
                background: red;
                color: white;
              }
  
  </style>
 </head>
 <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;">
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/partial_care/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="col-12 mt-3">
                    <table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" name="name1" value="<?php echo text($check_res['name1']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="float: right;">
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" value="<?php echo text($check_res['ptdate1']);?>" name="ptdate1" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br><br>
<h4 class="h3_1" style="text-align:center;">Partial Care Master Treatment Plan</h4>
<br>
<table style="width:100%" class="table table-bordered">
    <tr>
        <td style="width:20%;">
        <b>Diagnosis:</b><br><br>
        <p>Substance Abuse/dependence[include withdraw risk]Ex Heroin,Opiates,Alcohol,Benzos</p>
        </td>
        <td style="width:20%;">
        <b>Target Date</b><br><br>
        <p ><input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked";}?>>5days</p>
        <input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="2" <?php if ($check_res['checkbox1'] == "2") {
            echo "checked";}?>>10days<p></p>
        <input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="3" <?php if ($check_res['checkbox1'] == "3") {
            echo "checked";}?>>15days<p></p>
        <input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="4" <?php if ($check_res['checkbox1'] == "4") {
            echo "checked";}?>>30days<p></p><br>
        <input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="5" <?php if ($check_res['checkbox1'] == "5") {
            echo "checked";}?>>Others
</td>
<td style="width:250px;">
    <b>Discharge Criteria</b><br>
    <ul>
        <li>Recognize consequences of continuing substance use</li>
        <li>Receptive to continuing treatment for addition(s) (IOP/AA/NA meetings)</li>
        <li>Gain Insight to his or her addiction patterns</li>
        <li>Improved functioning at work and/or school</li>
        <li>Improved family and social relationships</li>
        <li>Other:[specify]
          <input type="text" name="other1" value="<?php echo text($check_res['other1']);?>" style="border:none;border-bottom:1px solid black;width:300px;"/></li>
    </ul>
</td>
<td style="width:250px;">
  <b>Target Date:</b><br><input type="date" value="<?php echo text($check_res['tdate1']);?>" name="tdate1" style="border:none;border-bottom:1px solid black;width:150px;"/>
</td>
    </tr>
</table><br><hr>
<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" class="pt_name" name="name2" value="<?php echo text($check_res['name2']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="float: right;">
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" class="pt_date" value="<?php echo text($check_res['ptdate2']);?>" name="ptdate2" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br>
<table style="text-align:center;width:100%" >
  <tr>
    <td align="centre" style="text-align:center;width:100%"><h4 class="h3_1">
      Partial Care Master Treatment Plan<u>
        <br>Nursing</u></h4>
    </td>
  </tr>
</table><br>
        <table style="border:1px solid black;width:100%" class="table table-bordered" >
            
            <td>
                <b>Target Problem</b>
                
            </td>
            <td style="width:40%">
        
                <i>Routine Interventions:</i>
                <ul>
                    <li>Administer medication as ordered.</li>
                    <li>Educate patient about purpose and effects of medication</li>
                    <li>Individual nursing care at heast ance per shif for 10-15  minutes to monitor mental status</li>
                    <li>Complete vital signs once daily and as ordered</li>
                    <li>Ensure safe environment for patient
                    through observation, rounding, and
                    monitoring environment of care</li>
                                        <li>Urine drug screen 3 days week/PRN</li>
                                    </ul>
                      <i>Individualized Interventions: (check all that apply)</i><br>
                    <ul>
                      <li>Monitor discomfort, provide medication as
                    ordered, and support patient in developing
                    coping strategies</li>
                      <li>Nursing groups 5 x per week</li>
                      <li>Educate patient about disease
                    process/prognosis</li>
                      <li>Attend individual and group therapy</li>
                      <li>Develop relapse prevention plan</li>
                      <li>Educate patient about physical effects of
                    substance abuse</li>
                  </ul>
            </td>
            <td style="width:30%">
                <b>Time Frame (check one)</b> <br>
                <input type="checkbox" class="radio_change thiacheck checkbox2" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox2" name="checkbox2" value="2" <?php if ($check_res['checkbox2'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox2" name="checkbox2" value="3" <?php if ($check_res['checkbox2'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox2" name="checkbox2" value="4" <?php if ($check_res['checkbox2'] == "4") {echo "checked";}?>>10 days <br>

                <input type="checkbox" class="radio_change thiacheck checkbox3" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox3" name="checkbox3" value="2" <?php if ($check_res['checkbox3'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox3" name="checkbox3" value="3" <?php if ($check_res['checkbox3'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox3" name="checkbox3" value="4" <?php if ($check_res['checkbox3'] == "4") {echo "checked";}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox4" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox4" name="checkbox4" value="2" <?php if ($check_res['checkbox4'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox4" name="checkbox4" value="3" <?php if ($check_res['checkbox4'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox4" name="checkbox4" value="4" <?php if ($check_res['checkbox4'] == "4") {echo "checked";}?>>10 days <br><br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox5" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox5" name="checkbox5" value="2" <?php if ($check_res['checkbox5'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox5" name="checkbox5" value="3" <?php if ($check_res['checkbox5'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox5" name="checkbox5" value="4" <?php if ($check_res['checkbox5'] == "4") {echo "checked";}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox6" name="checkbox6" value="1" <?php if ($check_res['checkbox6'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox6" name="checkbox6" value="2" <?php if ($check_res['checkbox6'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox6" name="checkbox6" value="3" <?php if ($check_res['checkbox6'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox6" name="checkbox6" value="4" <?php if ($check_res['checkbox6'] == "4") {echo "checked";}?>>10 days <br><br><br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox7" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox7" name="checkbox7" value="2" <?php if ($check_res['checkbox7'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox7" name="checkbox7" value="3" <?php if ($check_res['checkbox7'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox7" name="checkbox7" value="4" <?php if ($check_res['checkbox7'] == "4") {echo "checked";}?>>10 days <br><br><br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox8" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox8" name="checkbox8" value="2" <?php if ($check_res['checkbox8'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox8" name="checkbox8" value="3" <?php if ($check_res['checkbox8'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox8" name="checkbox8" value="4" <?php if ($check_res['checkbox8'] == "4") {echo "checked";}?>>10 days <br><br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox9" name="checkbox9" value="1" <?php if ($check_res['checkbox9'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox9" name="checkbox9" value="2" <?php if ($check_res['checkbox9'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox9" name="checkbox9" value="3" <?php if ($check_res['checkbox9'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox9" name="checkbox9" value="4" <?php if ($check_res['checkbox9'] == "4") {echo "checked";}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox10" name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox10" name="checkbox10" value="2" <?php if ($check_res['checkbox10'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox10" name="checkbox10" value="3" <?php if ($check_res['checkbox10'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox10" name="checkbox10" value="4" <?php if ($check_res['checkbox10'] == "4") {echo "checked";}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox11" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox11" name="checkbox11" value="2" <?php if ($check_res['checkbox11'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox11" name="checkbox11" value="3" <?php if ($check_res['checkbox11'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox11" name="checkbox11" value="4" <?php if ($check_res['checkbox11'] == "4") {echo "checked";}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox12" name="checkbox12" value="1" <?php if ($check_res['checkbox12'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox12" name="checkbox12" value="2" <?php if ($check_res['checkbox12'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox12" name="checkbox12" value="3" <?php if ($check_res['checkbox12'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox12" name="checkbox12" value="4" <?php if ($check_res['checkbox12'] == "4") {echo "checked";}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox13" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {echo "checked";}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox13" name="checkbox13" value="2" <?php if ($check_res['checkbox13'] == "2") {echo "checked";}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox13" name="checkbox13" value="3" <?php if ($check_res['checkbox13'] == "3") {echo "checked";}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox13" name="checkbox13" value="4" <?php if ($check_res['checkbox13'] == "4") {echo "checked";}?>>10 days <br>
                
            </td>
            <td>
                <b>Teaching Strategies</b>
                <ol>
                    <li>Groups</li>
                    <li>Writien material</li>
                    <li>Videos</li>
                    <li>Demonstration</li>
                    <li>Verbal discussian</li>
                    <li>One-on-one</li>
                    <li>Other</li>
                </ol>
            </td>
        </table>
        <table>
          <tr>
            <td>
            <b>Nurse signature:</b> 
        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="sign_1"  id="sign_1" value="<?php echo $check_res['sign_1'];?>">
                <img src='' class="img" id="img_sign_1" style="display:none;width:50%;height:100px;" >
            </td>
            <td>
            <b>Date:</b> <input type="date" style="border:none; border-bottom:1px solid black;" name="date1" value="<?php echo text($check_res['date1']);?>"> 
            </td>
            <td>
            <b>Time:</b> <input type="time" style="border:none; border-bottom:1px solid black;" name="time1" value="<?php echo text($check_res['time1']);?>"> 
            </td>
          </tr>
        </table>
        
        <table>
          <tr>
            <td>
            <b>Patient signature:</b> 
        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="sign_2"  id="sign_2" value="<?php echo $check_res['sign_2'];?>">
                <img src='' class="img" id="img_sign_2" style="display:none;width:50%;height:100px;" >
            </td>
        <td>
         <b>Date:</b> <input type="date" style="border:none; border-bottom:1px solid black;" name="date2" value="<?php echo text($check_res['date2']);?>">
         </td>
         <td>
          
         <b>Time:</b> <input type="time" style="border:none; border-bottom:1px solid black;" name="time2" value="<?php echo text($check_res['time2']);?>">
         </td>
        </tr>
        <table><br>
         <hr>
<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" class="pt_name" name="name3" value="<?php echo text($check_res['name3']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="float: right;">
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" class="pt_date" value="<?php echo text($check_res['ptdate3']);?>" name="ptdate3" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br>
        <table style="width:100%;">
          <tr>
            <th style="width:100%;"><h4 class="h3_1">Partial Care Medication Master Treatment Plan<br>
<u>Nursing</u></h4></th>
          </tr>
        </table>
        
        <table style="width:100%; border: 1px solid black;" class="tabel5">
          <tr>
            <td style="border: 1px solid black; width: 18%;vertical-align:top;text-align:center;"><b>Target Problem:</b>
              <p style="">Physical Withdrawals<br>
Mental instability</p>
</td>

<td style="border: 1px solid black;width: 30%;vertical-align:top;"><b>Interventions:</b>
<p><input type="checkbox" name="dis_check1" value="1"
<?php if($check_res['dis_check1'] == "1"){
  echo "checked";
  }?>
>Neurontin Induction</p>
<p><input type="checkbox" name="dis_check2" value="1"
<?php if($check_res['dis_check2'] == "1"){
  echo "checked";
  }?>>Keppra Custom order</p>
<p><input type="checkbox" name="dis_check3" value="1"
<?php if($check_res['dis_check3'] == "1"){
  echo "checked";
  }?>>Keppra 500mg po BID</p>
<p><input type="checkbox" name="dis_check4" value="1"
<?php if($check_res['dis_check4'] == "1"){
  echo "checked";
  }?>>All prn medication order by M.D if no contraindications</p>
<p><input type="checkbox" name="dis_check5" value="1"
<?php if($check_res['dis_check5'] == "1"){
  echo "checked";
  }?>>Clonidine b protocol</p>
<p><input type="checkbox" name="dis_check6" value="1"
<?php if($check_res['dis_check6'] == "1"){
  echo "checked";
  }?>>Clonidine custom protocol</p>
<p><input type="checkbox" name="dis_check7" value="1"
<?php if($check_res['dis_check7'] == "1"){
  echo "checked";
  }?>>Prescription medication management</p>
<p><input type="checkbox" name="dis_check8" value="1"
<?php if($check_res['dis_check8'] == "1"){
  echo "checked";
  }?>>other<input type="text" name="other2" value="<?php echo text($check_res['other2']);?>" style="border:none;border-bottom:1px solid black;width:200px;"/></p>
  <p><input type="checkbox" name="check9" value="1"
<?php if($check_res['check9'] == "1"){
  echo "checked";
  }?>>other<input type="text" name="other3" value="<?php echo text($check_res['other3']);?>" style="border:none;border-bottom:1px solid black;width:200px;"/></p>
    </td>


    <td style="border: 1px solid black;width: 25%; vertical-align:top;"><b>Time Frame:</b>
<p>
<input type="checkbox" class="radio_change thiacheck time_ck1" name="time_ck1" value="1"
<?php if($check_res['time_ck1'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck time_ck1" name="time_ck1" value="2"
<?php if($check_res['time_ck1'] == "2"){
  echo "checked";
  }?>>48hrs
<input type="checkbox" class="radio_change thiacheck time_ck1" name="time_ck1" value="3"
<?php if($check_res['time_ck1'] == "3"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck2" name="time_ck2" value="1"
  <?php if($check_res['time_ck2'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck2" name="time_ck2" value="2"
  <?php if($check_res['time_ck2'] == "2"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck2" name="time_ck2" value="3"
  <?php if($check_res['time_ck2'] == "3"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck3" name="time_ck3" value="1"
  <?php if($check_res['time_ck3'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck3" name="time_ck3" value="2"
  <?php if($check_res['time_ck3'] == "2"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck3" name="time_ck3" value="3"
  <?php if($check_res['time_ck3'] == "3"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck4" name="time_ck4" value="1"
  <?php if($check_res['time_ck4'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck4" name="time_ck4" value="2"
  <?php if($check_res['time_ck4'] == "2"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck4" name="time_ck4" value="3"
  <?php if($check_res['time_ck4'] == "3"){
  echo "checked";
  }?>>5days
</p><br>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck5" name="time_ck5" value="1"
  <?php if($check_res['time_ck5'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck5" name="time_ck5" value="2"
  <?php if($check_res['time_ck5'] == "2"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck5" name="time_ck5" value="3"
  <?php if($check_res['time_ck5'] == "3"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck6" name="time_ck6" value="1"
  <?php if($check_res['time_ck6'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck6" name="time_ck6" value="2"
  <?php if($check_res['time_ck6'] == "2"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck6" name="time_ck6" value="3"
  <?php if($check_res['time_ck6'] == "3"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck7" name="time_ck7" value="1"
  <?php if($check_res['time_ck7'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck7" name="time_ck7" value="2"
  <?php if($check_res['time_ck7'] == "2"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck7" name="time_ck7" value="3"
  <?php if($check_res['time_ck7'] == "3"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck8" name="time_ck8" value="1"
  <?php if($check_res['time_ck8'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck8" name="time_ck8" value="2"
  <?php if($check_res['time_ck8'] == "2"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck8" name="time_ck8" value="3"
  <?php if($check_res['time_ck8'] == "3"){
  echo "checked";
  }?>>5days
</p>
            </td>
<td style="border: 1px solid black;width: 25%;vertical-align:top;"><b>Teaching Strategies:</b>
<p><b>1.Written Material</b></p>
<p><b>2.Verbal Discussion</b></p>
<p><b>3.One on One</b></p>
            </td>
          </tr>
        </table><br><br>
        <table>
          <tr>
            <td>Nurse Signature:

            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
        <input type="hidden" style="border:none; border-bottom:1px solid black;" name="nsign"  id="nsign" value="<?php echo text($check_res['nsign']);?>" >
        <img src='' class="img" id="img_nsign" style="display:none;width:25%;height:100px;" >

             
            </td>
             <td>Date:<input type="date" name="dedate1" value="<?php echo $check_res['dedate1'];?>"></td>
              <td>Time:<input type="time" name="detime1" value="<?php echo $check_res['detime1'];?>"></td>
          </tr>
        <tr>
    <td>
        &nbsp;
        
    </td>
</tr>
          <tr>
          <td>Patient Signature: 
          <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
        <input type="hidden" style="border:none; border-bottom:1px solid black;" name="psign"  id="psign" value="<?php echo text($check_res['psign']);?>" >
        <img src='' class="img" id="img_psign" style="display:none;width:25%;height:100px;" >
          
          </td>
             <td>Date:<input type="date" name="dedate2" value="<?php echo $check_res['dedate2'];?>"></td>
              <td>Time:<input type="time" name="detime2" value="<?php echo $check_res['detime2'];?>"></td>
          </tr>
        </table><br><br><hr>
        
<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" class="pt_name" name="name4" value="<?php echo text($check_res['name4']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="float: right;">
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" class="pt_date" value="<?php echo text($check_res['ptdate4']);?>" name="ptdate4" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br>
                   <!-- Master Treatment Plan Nursery Content-->                   
<h4 style="text-align:center;" class="h3_1"> Partial Care Master Treatment Plan <br><u>Nursing cont.</u></h4><br>
<table style="width:100%" class="table table-bordered">
    <tr>
        <td style="">
        <b>Target<br>Problem:</b><br>
        <p>Medical</p>
        </td>

        <td style="width:25%;">
    <b>Client's Current Medical Conditions:(list)</b><br>
    <ul>
        <li><input style="width:230px;border:none;border-bottom:2px solid black;" type="text" value="<?php echo text($check_res['input1']);?>"  name="input1"/></li>
        <li><input style="width:230px;border:none;border-bottom:2px solid black;" type="text" value="<?php echo text($check_res['input2']);?>"  name="input2"/></li>
        <li><input style="width:230px;border:none;border-bottom:2px solid black;" type="text" value="<?php echo text($check_res['input3']);?>"  name="input3"/></li>
        <li><input style="width:230px;border:none;border-bottom:2px solid black;" type="text" value="<?php echo text($check_res['input4']);?>"  name="input4"/></li>
        <li><input style="width:230px;border:none;border-bottom:2px solid black;" type="text" value="<?php echo text($check_res['input5']);?>"  name="input5"/></li>
        <li><input style="width:230px;border:none;border-bottom:2px solid black;" type="text" value="<?php echo text($check_res['input6']);?>"  name="input6"/></li>

       
    </ul>
</td>
        <td style="width:35%;">
        <b>Interventions:</b><br>
        <p ><input type="checkbox" name="checkbox1a" value="1" <?php if ($check_res['checkbox1a'] == "1") {
            echo "checked";}?>>   Clients will follow up with PCP for all medical issues.</p>
        <input type="checkbox" name="checkbox2a" value="1" <?php if ($check_res['checkbox2a'] == "1") {
            echo "checked";}?>>   MD will be notified of current medical conditions<p></p>
        <input type="checkbox" name="checkbox3a" value="1" <?php if ($check_res['checkbox3a'] == "1") {
            echo "checked";}?>>   RD and MD will be notified if client has to take their own medication during treatment stay<p></p>
        <input type="checkbox" name="checkbox4a" value="1" <?php if ($check_res['checkbox4a'] == "1") {
            echo "checked";}?>>   Client will administer own medication<p></p><br>
       
</td>
<td style="width:30%;">
<b >Time Frame:(check one)</b><br>


<input type="checkbox" class="radio_change thiacheck tm_one1" name="tm_one1" value="1" <?php if ($check_res['tm_one1'] == "1") {
            echo "checked";}?>> 24 hrs
        <input type="checkbox" class="radio_change thiacheck tm_one1" name="tm_one1" value="2" <?php if ($check_res['tm_one1'] == "2") {
            echo "checked";}?>> 10 days
        <input type="checkbox" class="radio_change thiacheck tm_one1" name="tm_one1" value="3" <?php if ($check_res['tm_one1'] == "3") {
            echo "checked";}?>> 15 days
        <input type="checkbox" class="radio_change thiacheck tm_one1" name="tm_one1" value="4" <?php if ($check_res['tm_one4'] == "4") {
            echo "checked";}?>> 30 days <br><br>
            <input type="checkbox" class="radio_change thiacheck tm_one2" name="tm_one2" value="1" <?php if ($check_res['tm_one2'] == "1") {
            echo "checked";}?>> 24 hrs
        <input type="checkbox" class="radio_change thiacheck tm_one2" name="tm_one2" value="2" <?php if ($check_res['tm_one2'] == "2") {
            echo "checked";}?>> 10 days
        <input type="checkbox" class="radio_change thiacheck tm_one2" name="tm_one2" value="3" <?php if ($check_res['tm_one2'] == "3") {
            echo "checked";}?>> 15 days
        <input type="checkbox" class="radio_change thiacheck tm_one2" name="tm_one2" value="4" <?php if ($check_res['tm_one2'] == "4") {
            echo "checked";}?>> 30 days <br><br>
            <input type="checkbox" class="radio_change thiacheck tm_one3" name="tm_one3" value="1" <?php if ($check_res['tm_one3'] == "1") {
            echo "checked";}?>> 24 hrs
        <input type="checkbox" class="radio_change thiacheck tm_one3" name="tm_one3" value="2" <?php if ($check_res['tm_one3'] == "2") {
            echo "checked";}?>> 10 days
        <input type="checkbox" class="radio_change thiacheck tm_one3" name="tm_one3" value="3" <?php if ($check_res['tm_one3'] == "3") {
            echo "checked";}?>> 15 days
        <input type="checkbox" class="radio_change thiacheck tm_one3" name="tm_one3" value="4" <?php if ($check_res['tm_one3'] == "4") {
            echo "checked";}?>> 30 days <br><br>
            <input type="checkbox" class="radio_change thiacheck tm_one4" name="tm_one4" value="1" <?php if ($check_res['tm_one4'] == "1") {
            echo "checked";}?>> 24 hrs
        <input type="checkbox" class="radio_change thiacheck tm_one4" name="tm_one4" value="2" <?php if ($check_res['tm_one4'] == "2") {
            echo "checked";}?>> 10 days
        <input type="checkbox" class="radio_change thiacheck tm_one4" name="tm_one4" value="3" <?php if ($check_res['tm_one4'] == "3") {
            echo "checked";}?>> 15 days
        <input type="checkbox" class="radio_change thiacheck tm_one4" name="tm_one4" value="4" <?php if ($check_res['tm_one4'] == "4") {
            echo "checked";}?>> 30 days <br>
</td>
    </tr>
</table>
<table><tr><td>
    <b>Nurse signature:</b>
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <input type="hidden" name="sign" id="sign" style="width:60%;" value="<?php echo text($check_res['sign']);?>"/>
    <img src='' class="img" id="img_sign" style="display:none;width:50%;height:100px;" >
        </td>
        <td>
    <b style="margin-left:50px;">Date:</b><input type="date" name="date2a" value="<?php echo text($check_res['date2a']);?>"  style="border:none;border-bottom:2px solid black;"/>
    <b style="margin-left:50px;">Time :</b><input type="time" value="<?php echo text($check_res['time']);?>"  name="time" style="border:none;border-bottom:2px solid black;"/>

</td></tr></table><br/><br/><hr>
<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" class="pt_name" name="name5" value="<?php echo text($check_res['name5']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="float: right;">
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" class="pt_date" value="<?php echo text($check_res['ptdate5']);?>" name="ptdate5" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br>
<!-- Page 5-->

        <table style="width:100%;">
          <tr>
            <th style="width:100%;"><h3 class="h3_1">Partial Care Master Treatment Plan</h3></th>
          </tr>
          <tr>
            <th style="width:100%;text-decoration:underline"><h3 class="h3_1">Psychiatrist</h3></th>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black;" class="tabel5">
          <tr>
            <td style="border: 1px solid black; width: 15%;vertical-align:top;"><b>Targeted Problem</b>
            </td>

            <td style="border: 1px solid black;width: 37%;vertical-align:top;"><i>Routine Interventions:</i>
            <ul>
                <li>Daily assessment of mental/physical status</li>
                <li>Daily assessment of response to medication</li>
                <li>Oversight of interdisciplinary treatment and discharge planning</li>
        </ul>
        <p>
            <i>Individualized Interventions: (check all that apply)</i>
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck1"
        <?php if($check_res['sycheck1'] == "1"){
  echo "checked";
  }?>>Coordination with treating pyschiatrist in the community
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck2"
        <?php if($check_res['sycheck2'] == "1"){
  echo "checked";
  }?>>Coordination with PCP/house doctor/medical consultant
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck3"
        <?php if($check_res['sycheck3'] == "1"){
  echo "checked";
  }?>>Coordination with family re:treatment needs and discharge plans
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck4"
        <?php if($check_res['sycheck4'] == "1"){
  echo "checked";
  }?>>Consultation with community agencies re:treatment needs and discharge plans
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck5"
        <?php if($check_res['sycheck5'] == "1"){
  echo "checked";
  }?>>Educate family/significant other about disease process/prognosis
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck6"
        <?php if($check_res['sycheck6'] == "1"){
  echo "checked";
  }?>>Educate family/significant other about risks and benefits of medications
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck7"
        <?php if($check_res['sycheck7'] == "1"){
  echo "checked";
  }?>>Educate about substances and effect on mental status
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck8"
        <?php if($check_res['sycheck8'] == "1"){
  echo "checked";
  }?>>Other (Specify):<input type="text" name="syinp1" value="<?php echo $check_res['syinp1']?>">
        </p>
            </td>
            <td style="border: 1px solid black;width: 28%;vertical-align:top;"><b>Time Frame:(check one)</b>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check1" name="ch_check1" value="1"
<?php if($check_res['ch_check1'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check1" name="ch_check1" value="2"
<?php if($check_res['ch_check1'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check1" name="ch_check1" value="3"
<?php if($check_res['ch_check1'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check1" name="ch_check1" value="4"
<?php if($check_res['ch_check1'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check2" name="ch_check2" value="1"
<?php if($check_res['ch_check2'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check2" name="ch_check2" value="2"
<?php if($check_res['ch_check2'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check2" name="ch_check2" value="3"
<?php if($check_res['ch_check2'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check2" name="ch_check2" value="4"
<?php if($check_res['ch_check2'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check3" name="ch_check3" value="1"
<?php if($check_res['ch_check3'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check3" name="ch_check3" value="2"
<?php if($check_res['ch_check3'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check3" name="ch_check3" value="3"
<?php if($check_res['ch_check3'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check3" name="ch_check3" value="4"
<?php if($check_res['ch_check3'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check4" name="ch_check4" value="1"
<?php if($check_res['ch_check4'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check4" name="ch_check4" value="2"
<?php if($check_res['ch_check4'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check4" name="ch_check4" value="3"
<?php if($check_res['ch_check4'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check4" name="ch_check4" value="4"
<?php if($check_res['ch_check4'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check5" name="ch_check5" value="1"
<?php if($check_res['ch_check5'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check5" name="ch_check5" value="2"
<?php if($check_res['ch_check5'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check5" name="ch_check5" value="3"
<?php if($check_res['ch_check5'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check5" name="ch_check5" value="4"
<?php if($check_res['ch_check5'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check6" name="ch_check6" value="1"
<?php if($check_res['ch_check6'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check6" name="ch_check6" value="2"
<?php if($check_res['ch_check6'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check6" name="ch_check6" value="3"
<?php if($check_res['ch_check6'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check6" name="ch_check6" value="4"
<?php if($check_res['ch_check6'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check7" name="ch_check7" value="1"
<?php if($check_res['ch_check7'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check7" name="ch_check7" value="2"
<?php if($check_res['ch_check7'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check7" name="ch_check7" value="3"
<?php if($check_res['ch_check7'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check7" name="ch_check7" value="4"
<?php if($check_res['ch_check7'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check8" name="ch_check8" value="1"
<?php if($check_res['ch_check8'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check8" name="ch_check8" value="2"
<?php if($check_res['ch_check8'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check8" name="ch_check8" value="3"
<?php if($check_res['ch_check8'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check8" name="ch_check8" value="4"
<?php if($check_res['ch_check8'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check9" name="ch_check9" value="1"
<?php if($check_res['ch_check9'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check9" name="ch_check9" value="2"
<?php if($check_res['ch_check9'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check9" name="ch_check9" value="3"
<?php if($check_res['ch_check9'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check9" name="ch_check9" value="4"
<?php if($check_res['ch_check9'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check10" name="ch_check10" value="1"
<?php if($check_res['ch_check10'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check10" name="ch_check10" value="2"
<?php if($check_res['ch_check10'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check10" name="ch_check10" value="3"
<?php if($check_res['ch_check10'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check10" name="ch_check10" value="4"
<?php if($check_res['ch_check10'] == "4"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check11" name="ch_check11" value="1"
<?php if($check_res['ch_check11'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check11" name="ch_check11" value="2"
<?php if($check_res['ch_check11'] == "2"){
  echo "checked";
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check11" name="ch_check11" value="3"
<?php if($check_res['ch_check11'] == "3"){
  echo "checked";
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check11" name="ch_check11" value="4"
<?php if($check_res['ch_check11'] == "4"){
  echo "checked";
  }?>>30days
</p>
            </td>
            <td style="border: 1px solid black;width: 25%;vertical-align:top;"><b>Teaching Strategies:</b>
<p><b>1.Groups</b></p>
<p><b>2.Written Material</b></p>
<p><b>3.Videos</b></p>
<p><b>4.Demonsstration</b></p>
<p><b>5.Verbal discussion</b></p>
<p><b>6.one-on-one</b></p>
<p><b>7.other:</b></p>
          </tr>
        </table><br><br>
        <table style="width:100%;">
          <tr>
            <td>Pyschiatrist Signature:
            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="sypsign"  id="sypsign" value="<?php echo $check_res['sypsign'];?>">
                <img src='' class="img" id="img_sypsign" style="display:none;width:50%;height:100px;" >
            </td>
             <td>Date:<input type="date" name="sydate1" value="<?php echo $check_res['sydate1'];?>"></td>
              <td>Time:<input type="time" name="sytime1" value="<?php echo $check_res['sytime1'];?>"></td>
          </tr>
        <tr>
    <td>
        &nbsp;

    </td>
</tr>
        </table><br><hr>
        <table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" class="pt_name" name="name6" value="<?php echo text($check_res['name6']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="float: right;">
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" class="pt_date" value="<?php echo text($check_res['ptdate6']);?>" name="ptdate6" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br>
<!-- Master Treatment Plan Medication Update -->

<h4 style="text-align:center;" class="h3_1">Partial Care Master Treatment Plan Medication Update <br><u>Nursing</u>
</h4>
<br>
<table style="width:100%" class="table table-bordered">
    <tr>
        <td style="width:250px;">
          <b>Target Problem:</b><br>
          <p>Physical Withdrawals</p>
          <p>Mental instability</p>

        </td>

        <td style="width:250px;">
    <b>Medications Interventions</b><br>
    Prescription order/Medication order:<textarea style="height:50px;width:200px;" type="text" name="comment1"><?php echo text($check_res['comment1']);?></textarea><br>
    Prescription order/Medication order:<textarea style="height:50px;width:200px;" type="text" name="comment2"><?php echo text($check_res['comment2']);?></textarea><br>
    Prescription order/Medication order:<textarea style="height:50px;width:200px;" type="text" name="comment3"><?php echo text($check_res['comment3']);?></textarea><br>
    Prescription order/Medication order:<textarea style="height:50px;width:200px;" type="text" name="comment4"><?php echo text($check_res['comment4']);?></textarea><br>
</td>
        <td style="width:250px;">
        <b>Start Date:</b><br><br><br>
        <b>Date :</b>
      <input type="date" name="date_1" value="<?php echo text($check_res['date_1']);?>" /><br><br><br>
      <b>Date :</b>

        <input type="date" name="date_2" value="<?php echo text($check_res['date_2']);?>" /><br><br><br>
        <b>Date :</b>

        <input type="date" name="date_3" value="<?php echo text($check_res['date_3']);?>"/><br><br><br>
        <b>Date :</b>

        <input type="date" name="date_4" value="<?php echo text($check_res['date_4']);?>" />
</td>

<td style="width:300px;">
<b >Teaching Stratergies</b><br><br>
<p>1. Written Material</p>
<p>2. Verbal Discussion</p>
<p>3. One on One</p>


</td>
    </tr>
</table>
<table><tr><td>
    <b>Nurse signature:</b>
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" style="border:none; border-bottom:1px solid black;" name="sign1" id="sign1" value="<?php echo text($check_res['sign1']);?>">
         <img src='' class="img" id="img_sign1" style="display:none;width:25%;height:100px;" >
    
    <b style="margin-left:50px;">Date:</b><input type="date" name="date5" value="<?php echo text($check_res['date5']);?>"  style="border:none;border-bottom:2px solid black;"/>
    <b style="margin-left:50px;">Time :</b><input type="time" value="<?php echo text($check_res['time1']);?>"  name="time1" style="border:none;border-bottom:2px solid black;"/>

</td></tr></table><br><br>
<table><tr><td>
    <b>Patient signature:</b>
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" style="border:none; border-bottom:1px solid black;" name="sign2" id="sign2" value="<?php echo text($check_res['sign2']);?>">
         <img src='' class="img" id="img_sign2" style="display:none;width:25%;height:100px;" >
    
    <b style="margin-left:50px;">Date:</b><input type="date" name="date6" value="<?php echo text($check_res['date6']);?>"  style="border:none;border-bottom:2px solid black;"/>
    <b style="margin-left:50px;">Time :</b><input type="time" value="<?php echo text($check_res['time2']);?>"  name="time2" style="border:none;border-bottom:2px solid black;"/>

</td></tr></table><br><br> <hr>
<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" class="pt_name" name="name7" value="<?php echo text($check_res['name7']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="float: right;">
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" class="pt_date" value="<?php echo text($check_res['ptdate7']);?>" name="ptdate7" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br>
                <!-- Master Treatment Plan
                Psychiatrist -->
                     
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="text-center">Partial Care Master Treatment Plan <br><u>Psychiatrist</u></h4>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;border:1px solid black;">
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-left:50px;margin-top:10px;"><b>Discharge Plan (check all that apply):<b></label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox name='dis_check1' style="margin-left:50px;" value="0"<?php if ($check_res["dis_check1"] == "0") {
                                    echo "checked";};?>> Home</label>
                                    <label><input type=checkbox name='dis_check2' style="margin-left:20px;" value="0"<?php if ($check_res["dis_check2"] == "0") {
                                    echo "checked";};?>> In Patient</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='dis_check3' value="0"<?php if ($check_res["dis_check3"] == "0") {
                                    echo "checked";};?>> Sober Living</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='dis_check4' value="0"<?php if ($check_res["dis_check4"] == "0") {
                                    echo "checked";};?>> PHP</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='dis_check5' value="0"<?php if ($check_res["dis_check5"] == "0") {
                                    echo "checked";};?>> Long term</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='dis_check6' value="0"<?php if ($check_res["dis_check6"] == "0") {
                                    echo "checked";};?>> IOP Facility and Appointment time</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:10px;"><input type=checkbox name='dis_check7' style="margin-left:50px;" value="0"<?php if ($check_res["dis_check7"] == "0") {
                                    echo "checked";};?>> Rehab</label>
                                    <label><input type=checkbox name='dis_check8' style="margin-left:20px;" value="0"<?php if ($check_res["dis_check8"] == "0") {
                                    echo "checked";};?>> Other (specify) :</label>
                                    <label><input type="text" name="othtext1" value="<?php echo text($check_res['othtext1']);?>"/>
                                    <input type="text" name="othtext2" value="<?php echo text($check_res['othtext2']);?>"/></label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:10px;"><input type=checkbox name='dis_check9' style="margin-left:50px;" value="0"<?php if ($check_res["dis_check9"] == "0") {
                                    echo "checked";};?>> Follow-up with PCP</label>
                                    <label><input type=checkbox name='dis_check10' style="margin-left:20px;" value="0"<?php if ($check_res["dis_check10"] == "0") {
                                    echo "checked";};?>> If no PCP, patient referred to a PCP (Doctor Name, phone number, date and time of the appoinment)</label>
                                    </label><input type="text" style="margin-left:50px;width: 50%;margin-bottom: 15px;" name="othtext3" value="<?php echo text($check_res['othtext3']);?>"/></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>I have reviewed treatment plan and have had an opportunity to contribute to its development.</label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Patient Comments:</label>
                                    <textarea id="ptcomments" style="border-color: lightgray;" name="ptcomments" class="form-control" cols="100" rows="3" ><?php echo text($check_res['ptcomments']); ?></textarea>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>If patient's review of treatment plan is contraindicated, specify reason:</label>
                                    <textarea id="treatment" style="border-color: lightgray;" name="treatment" class="form-control" cols="100" rows="3" ><?php echo text($check_res['treatment']); ?></textarea>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label>Patient Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" style="width:50%;" id="ptsign" name="ptsign" value="<?php echo text($check_res['ptsign']);?>"/>
                                    <img src='' class="img" id="img_ptsign" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:50%;">
                                    <label>Date:</label>
                                    <input type="date" name="ptdate"value="<?php echo text($check_res['ptdate']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label>Staff Signature & Credentials:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="stsign"  id="stsign" style="width:40%;" value="<?php echo text($check_res['stsign']);?>"/>
                                    <img src='' class="img" id="img_stsign" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:50%;">
                                    <label>Date:</label>
                                    <input type="date" name="stdate" value="<?php echo text($check_res['stdate']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label>Staff Signature & Credentials:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="credsign" id="credsign" style="width:40%;" value="<?php echo text($check_res['credsign']);?>"/>
                                    <img src='' class="img" id="img_credsign" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:50%;">
                                    <label>Date:</label>
                                    <input type="date" name="creddate" value="<?php echo text($check_res['creddate']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>I certify that patient needs outpatient care for treatment of further therapy and or medication management.</label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label>Psychiatrist Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="psysign" id="psysign" style="width:40%;" value="<?php echo text($check_res['psysign']);?>"/>
                                    <img src='' class="img" id="img_psysign" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:50%;">
                                    <label>Date:</label>
                                    <input type="date" name="psydate" value="<?php echo text($check_res['psydate']);?>"/>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="form-group mt-4" style="margin-left: 465px;">
                        <div class="btn-group" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-success btn-save" style=" "><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-danger btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


            <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="sig">
                            <img id="view_img" style="display:none" width='380px' height='144px'>
                        </div>
                        <br />
                        <br />
                        <br />
                        <button id="clear">Clear</button>
                        <textarea id="sign_data" style="display: none"></textarea>
                    </div>
                    <input type='button' id="add_sign" class="btn btn-success" data-dismiss="modal" value='Add Sign' style='float:right'>

                </div>
            </div>
        </div>
    </div>
    <!-- modal close -->


    </body>
</html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../customized/admission_orders/assets/js/jquery.signature.min.js"></script>
<script>
    var sig = $('#sig').signature({
        syncField: '#sign_data',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#view_img").attr("src", '');
        $("#view_img").css('display','none');
        $('canvas').css('display','block');
        $("#sign_data").val('');
    });



    var id_name, val, display_edit, icon;


      $('.pen_icon').click(function() {
        id_name = $(this).next('input').attr('id');
        var sign_value = $("#"+id_name).val();
       // alert(sign_value);
        if(sign_value!='')
        {
            // $("#sig").css('display','none');
            $('canvas').css('display','none');
            $("#view_img").css('display','block');
            $("#view_img").attr("src", sign_value);
            $("#sign_data").val(sign_value);

        }
        // else{
        //     $("#)
        // }
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        $('#' + id_name).val(sign);
        if(sign!='')
        {
            $("#img_"+id_name).attr('src',sign);
            $("#img_"+id_name).css('display','block');
        }
        else{
            $("#img_"+id_name).css('display','none');
        }

        $('#sign_data').val('');
        sig.signature('clear');
       // $("#sign_data").val('');
       // check_sign();
    });


    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {

            var id_name1 = $(this).next('input').attr('id');
            var sign_value = $("#"+id_name1).val();

            if(sign_value!='')
            {
                $("#img_"+id_name1).css('display','block');
                $("#img_"+id_name1).attr('src',sign_value);

            }

        });
    }

   $('input.thiacheck').on('click', function() {
    $(this).prop('checked', false);
    $(this).prop('checked', true);
   });
   
       $('.radio_change').on('change',function(){
       var checkbox_class= $(this).attr('name');
       
       if($(this).is(":checked"))
       {
           $('.'+checkbox_class).prop('checked',false);
           $(this).prop('checked',true);
            $('#hidden_'+checkbox_class).val($(this).val());
       }
       else{
        $('#hidden_'+checkbox_class).val('');
       }
   })

   $('input[name="name1"]').change(function(){
      var val = $(this).val();
      $('.pt_name').val(val);
      //alert(val);
   })

   $('input[name="ptdate1"]').change(function(){
      var val = $(this).val();
      $('.pt_date').val(val);
      //alert(val);
   })
</script>
