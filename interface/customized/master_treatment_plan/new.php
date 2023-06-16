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
    $sql = "SELECT * FROM `form_master_treatment_plan` WHERE id=? AND pid = ? AND encounter = ?";
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
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
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
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/master_treatment_plan/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="col-12 mt-3">
                    <table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" name="name1" value="<?php echo text($check_res['name1']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="text-align:center;">
      <b>Center For Network Therapy</b></td>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" value="<?php echo text($check_res['ptdate1']);?>" name="ptdate1" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br><br><br>
<h2 style="text-align:center;">Master Treatment Plan</h2>
<br>
<table style="width:100%" class="table table-bordered">
    <tr>
        <td style="width:250px;">
        <b>Diagnosis</b><br>
        <p>Substance Abuse/dependence[include withdraw risk]Ex Heroin,Opiates,Alcohol,Benzo</p>
        </td>
        <td style="width:250px;">
        <b>Target Date</b><br>
        <p ><input type="checkbox" name="checkbox1" class="mcheck1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked";}?>>5days</p>
        <input type="checkbox" name="checkbox2" class="mcheck1" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked";}?>>10days<p></p>
        <input type="checkbox" name="checkbox3" class="mcheck1" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked";}?>>15days<p></p>
        <input type="checkbox" name="checkbox4" class="mcheck1" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked";}?>>30days<p></p><br>
        <input type="checkbox" name="checkbox5" class="mcheck1" value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked";}?>>Others
</td>
<td style="width:250px;">
    <b>Discharge Criteria</b><br>
    <ul>
        <li>Recognize consequences of continuing substance use</li>
        <li>Receptive to continuing treatment for addition[s]</li>
        <li>Mild or free from withdraw signs and symptoms</li><br>
        <li>Other:[specify]<input type="text" name="other" value="<?php echo text($check_res['other']);?>" style="border:none;border-bottom:1px solid black;width:300px;"/></li>

    </ul>
</td>
 
<td style="width:250px;">
<b >Target Date:</b><br><input type="date" value="<?php echo text($check_res['tdate']);?>" name="tdate" style="border:none;border-bottom:2px solid black;width:150px;"/><br><br>

<b>New Target Date:</b>(state reason why?Relapse,non-compilance,<b>medical necessity</b>,etc.)
<textarea style="border:none;height:50px;width:200px;" type="text" name="comment1"><?php echo text($check_res['comment1']);?></textarea>
</td>
    </tr>
</table><br><br><br>
<!--  -->
<table style="width:100%"><tr><td> Patient Name: 
        <input style="border:none; border-bottom:1px solid black;" type="text" name="nupname" value="<?php echo text($check_res['nupname']);?>"></td>
        <td style="text-align:center;">
            <p>Center for Network Therapy</p>
        </td>
    </tr> 
    <tr><td>
         DOB: 
        <input style="border:none; border-bottom:1px solid black;" type="date" name="nuDOB" value="<?php echo text($check_res['nuDOB']);?>"> </tr></table> <br/>
        <h4 style="text-align:center;">Master Treatment Plan
<u>Nursing</u>
</h4>
        <br/>
        <table style="border:1px solid black;width:100%" class="table table-bordered" >
            
                <td>
                <b>Target Problem:</b>
                <p>Substance Abuse</p>
                
            </td>
            <td>
        
                <b>Routine Interventions:</b>
                <ul>
                    <li>Administer medication as ordered.</li>
                    <li>Educate patient about purpose and effects of medication</li>
                    <li>Individual nursing care at least once per shift
for 10-15 minutes to monitor mental/physical
status</li>
                    <li>Complete vital signs 2x daily or as ordered</li>
                    <li>Ensure safe environment for patient through
observation, assessment, rounding, and
monitoring environment of care</li>
                    <li>Instant urine drug Screen 3days per week/PRN </li>
                    <li>Other <input type="text" name="nuinput1" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['nuinput1']);?>"></li>
                </ul>

                <b>Individualized Interventions(Check all that apply)</b> <br> <br>
                <input type="checkbox" name="checkbox01" value="1" <?php if ($check_res['checkbox01'] == "1") {echo "checked";}?>>Monitor discomfort,provide medication as <br> ordered,and support patient in developing <br> coping strategies. <br>
                <input type="checkbox" name="checkbox02" value="1" <?php if ($check_res['checkbox02'] == "1") {echo "checked";}?>>Nursing/Therapy group 7x per week based <br> on tolerance per group interaction. <br>
                <input type="checkbox" name="checkbox03" value="1" <?php if ($check_res['checkbox03'] == "1") {echo "checked";}?>>Educate patient and family about disease <br> process/prognosis. <br>
                <input type="checkbox" name="checkbox06" value="1" <?php if ($check_res['checkbox06'] == "1") {echo "checked";}?>>Educate patient about fall reduction techniques. <br>
                
                <input type="checkbox" name="checkbox04" value="1" <?php if ($check_res['checkbox04'] == "1") {echo "checked";}?>>Educate patient and family about physical <br> effect of substance abuse. <br>
                <input type="checkbox" name="checkbox05" value="1" <?php if ($check_res['checkbox05'] == "1") {echo "checked";}?>>Other <input type="text" name="nuinput2" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['nuinput2']);?>">
            </td>
            <td style="width: 26%;"> 
                <b>Time Frame (check one)</b> <br>
                <input type="checkbox" name="nucheckbox1" class="mcheck2" value="1" <?php if ($check_res['nucheckbox1'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" class="mcheck2" name="nucheckbox2" value="1" <?php if ($check_res['nucheckbox2'] == "1") {echo "checked";}?>>10days  <input type="checkbox" class="mcheck2" name="nucheckbox3" value="1" <?php if ($check_res['nucheckbox3'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox4" class="mcheck2" value="1" <?php if ($check_res['nucheckbox4'] == "1") {echo "checked";}?>>30days <br>
                <input type="checkbox" class="mcheck3" name="nucheckbox5" value="1" <?php if ($check_res['nucheckbox5'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" class="mcheck3" name="nucheckbox6" value="1" <?php if ($check_res['nucheckbox6'] == "1") {echo "checked";}?>>10days  <input type="checkbox" class="mcheck3" name="nucheckbox7" value="1" <?php if ($check_res['nucheckbox7'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox8" class="mcheck3" value="1" <?php if ($check_res['nucheckbox8'] == "1") {echo "checked";}?>>30days <br> 
                <input type="checkbox" class="mcheck4" name="nucheckbox9" value="1" <?php if ($check_res['nucheckbox9'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox10" class="mcheck4" value="1" <?php if ($check_res['nucheckbox10'] == "1") {echo "checked";}?>>10days  <input type="checkbox" class="mcheck4" name="nucheckbox11" value="1" <?php if ($check_res['nucheckbox11'] == "1") {echo "checked";}?>>15days  <input type="checkbox" class="mcheck4" name="nucheckbox12" value="1" <?php if ($check_res['nucheckbox12'] == "1") {echo "checked";}?>>30days  <br> <br>
                <input type="checkbox" class="mcheck5" name="nucheckbox13" value="1" <?php if ($check_res['nucheckbox13'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox14" class="mcheck5" value="1" <?php if ($check_res['nucheckbox14'] == "1") {echo "checked";}?>>10days  <input type="checkbox" class="mcheck5" name="nucheckbox15" value="1" <?php if ($check_res['nucheckbox15'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox16 " class="mcheck5" value="1" <?php if ($check_res['nucheckbox16'] == "1") {echo "checked";}?>>30days  <br>
                <input type="checkbox" name="nucheckbox17" class="mcheck6" value="1" <?php if ($check_res['nucheckbox17'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox18" class="mcheck6" value="1" <?php if ($check_res['nucheckbox18'] == "1") {echo "checked";}?>>10days  <input type="checkbox" name="nucheckbox19" class="mcheck6" value="1" <?php if ($check_res['nucheckbox19'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox20" class="mcheck6" value="1" <?php if ($check_res['nucheckbox20'] == "1") {echo "checked";}?>>30days  <br> <br>    
                <input type="checkbox" name="nucheckbox21" class="mcheck7" value="1" <?php if ($check_res['nucheckbox21'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox22" class="mcheck7" value="1" <?php if ($check_res['nucheckbox22'] == "1") {echo "checked";}?>>10days  <input type="checkbox" name="nucheckbox23" class="mcheck7" value="1" <?php if ($check_res['nucheckbox23'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox24" class="mcheck7" value="1" <?php if ($check_res['nucheckbox24'] == "1") {echo "checked";}?>>30days  <br>
                <input type="checkbox" name="nucheckbox25" class="mcheck8" value="1" <?php if ($check_res['nucheckbox25'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox26" class="mcheck8" value="1" <?php if ($check_res['nucheckbox26'] == "1") {echo "checked";}?>>10days  <input type="checkbox" name="nucheckbox27" class="mcheck8" value="1" <?php if ($check_res['nucheckbox27'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox28" class="mcheck8" value="1" <?php if ($check_res['nucheckbox28'] == "1") {echo "checked";}?>>30days <br> <br> <br> <br>
                <input type="checkbox" name="nucheckbox29" class="mcheck9" value="1" <?php if ($check_res['nucheckbox29'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox30" class="mcheck9" value="1" <?php if ($check_res['nucheckbox30'] == "1") {echo "checked";}?>>10days  <input type="checkbox" name="nucheckbox31" class="mcheck9" value="1" <?php if ($check_res['nucheckbox31'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox32" class="mcheck9" value="1" <?php if ($check_res['nucheckbox32'] == "1") {echo "checked";}?>>30days  <br> <br> <br>
                <input type="checkbox" name="nucheckbox33" class="mcheck10" value="1" <?php if ($check_res['nucheckbox33'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox34" class="mcheck10" value="1" <?php if ($check_res['nucheckbox34'] == "1") {echo "checked";}?>>10days  <input type="checkbox" name="nucheckbox35" class="mcheck10" value="1" <?php if ($check_res['nucheckbox35'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox36" class="mcheck10" value="1" <?php if ($check_res['nucheckbox36'] == "1") {echo "checked";}?>>30days  <br> <br>  
                <input type="checkbox" name="nucheckbox37" class="mcheck11" value="1" <?php if ($check_res['nucheckbox37'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox38" class="mcheck11" value="1" <?php if ($check_res['nucheckbox38'] == "1") {echo "checked";}?>>10days  <input type="checkbox" name="nucheckbox39" class="mcheck11" value="1" <?php if ($check_res['nucheckbox39'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox40" class="mcheck11" value="1" <?php if ($check_res['nucheckbox40'] == "1") {echo "checked";}?>>30days  <br> <br>
                <input type="checkbox" name="nucheckbox41" class="mcheck12" value="1" <?php if ($check_res['nucheckbox41'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox42" class="mcheck12" value="1" <?php if ($check_res['nucheckbox42'] == "1") {echo "checked";}?>>10days  <input type="checkbox" name="nucheckbox43" class="mcheck12" value="1" <?php if ($check_res['nucheckbox43'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox44" class="mcheck12" value="1" <?php if ($check_res['nucheckbox44'] == "1") {echo "checked";}?>>30days <br> <br>
                <input type="checkbox" name="nucheckbox45" class="mcheck13" value="1" <?php if ($check_res['nucheckbox45'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox46" class="mcheck13" value="1" <?php if ($check_res['nucheckbox46'] == "1") {echo "checked";}?>>10days  <input type="checkbox" name="nucheckbox47" class="mcheck13" value="1" <?php if ($check_res['nucheckbox47'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox48" class="mcheck13" value="1" <?php if ($check_res['nucheckbox48'] == "1") {echo "checked";}?>>30days <br>
                <input type="checkbox" name="nucheckbox49" class="mcheck14" value="1" <?php if ($check_res['nucheckbox49'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="nucheckbox50" class="mcheck14" value="1" <?php if ($check_res['nucheckbox50'] == "1") {echo "checked";}?>>10days  <input type="checkbox" name="nucheckbox51" class="mcheck14" value="1" <?php if ($check_res['nucheckbox51'] == "1") {echo "checked";}?>>15days  <input type="checkbox" name="nucheckbox52" class="mcheck14" value="1" <?php if ($check_res['nucheckbox52'] == "1") {echo "checked";}?>>30days <br>

            </td>
            <td>
                <b>Teaching Strategies</b>
                <ol>
                    <li>Groups</li>
                    <li>Written material</li>
                    <li>Videos</li>
                    <li>Demonstration</li>
                    <li>Verbal discussion</li>
                    <li>One-on-one</li>
                    <li>Other: <input type="text" name="nuother" value="<?php echo text($check_res['nuother']);?>"></li>
                </ol>
            </td>
        </table>
        <table><tr><td>
        <b>Nurse signature:</b> 
        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" style="border:none; border-bottom:1px solid black;" name="nusign1" id="nusign1" value="<?php echo text($check_res['nusign1']);?>">
         <img src='' class="img" id="img_nusign1" style="display:none;width:25%;height:100px;" >
         </td><td>
        <b>Date:</b> <input type="date" style="border:none; border-bottom:1px solid black;" name="nudate1" value="<?php echo text($check_res['nudate1']);?>"> <b>Time:</b> <input type="time" style="border:none; border-bottom:1px solid black;" name="nutime1" value="<?php echo text($check_res['nutime1']);?>"> </td></tr>
        <tr><td><b>Patient signature:</b>  <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" style="border:none; border-bottom:1px solid black;" name="nusign2" id="nusign2" value="<?php echo text($check_res['nusign2']);?>">
         <img src='' class="img" id="img_nusign2" style="display:none;width:25%;height:100px;" > </td><td>
          <b>Date:</b> <input type="date" style="border:none; border-bottom:1px solid black;" name="nudate2" value="<?php echo text($check_res['nudate2']);?>"> <b>Time:</b> <input type="time" style="border:none; border-bottom:1px solid black;" name="nutime2" value="<?php echo text($check_res['nutime2']);?>"></td></tr> </table>
          <br/><br/>
<!-- Detox Master Treatment Plan: Nursing -->
<table style="width:100%;">
          <tr>
            <td style="width:70%;">Patient name:
              <input type="text" name="txt1" value="<?php echo $check_res['txt1'];?>">
            </td>
            <td style="width:30%;text-align:center;"><b>Center for Network Therapy<b></td>
          </tr>
        </table><br>
        <table style="width:100%;">
          <tr>
            <td>DOB:
              <input type="date" name="txt2" id="id1" value="<?php echo $check_res['txt2'];?>">
            </td>
          </tr>
        </table><br><br>
        <table style="width:100%;">
          <tr>
            <th style="width:100%;"><h3 class="h3_1">Detox Master Treatment Plan: Nursing</h3></th>
          </tr>
        </table>
        
        <table style="width:100%; border: 1px solid black;" class="tabel5">
          <tr>
            <td style="border: 1px solid black; width: 25%;"><b>Target Problem:</b>
              <p>Phsical Withdrawls Mental instability</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>

            <td style="border: 1px solid black;width: 25%;"><b>Interventions:</b>
<p><input type="checkbox" name="check1a" value="1"
<?php if($check_res['check1a'] == "1"){
  echo "checked";
  }?>
>Suboxone 8 day protocol</p>
<p><input type="checkbox" name="check2a" value="1"
<?php if($check_res['check2a'] == "1"){
  echo "checked";
  }?>>Suboxone 5 day protocol</p>
<p><input type="checkbox" name="check3a" value="1"
<?php if($check_res['check3a'] == "1"){
  echo "checked";
  }?>>Suboxone 4 day protocol</p>
<p><input type="checkbox" name="check4a" value="1"
<?php if($check_res['check4a'] == "1"){
  echo "checked";
  }?>>Suboxone custom protocol</p>
<p><input type="checkbox" name="check5a" value="1"
<?php if($check_res['check5a'] == "1"){
  echo "checked";
  }?>>Suboxone induction</p>
<p><input type="checkbox" name="check6a" value="1"
<?php if($check_res['check6a'] == "1"){
  echo "checked";
  }?>>Ativan b protocol</p>
<p><input type="checkbox" name="check7a" value="1"
<?php if($check_res['check7a'] == "1"){
  echo "checked";
  }?>>Ativan c protocol</p>
<p><input type="checkbox" name="check8a" value="1"
<?php if($check_res['check8a'] == "1"){
  echo "checked";
  }?>>Ativan custom protocol</p>
<p><input type="checkbox" name="check9a" value="1"
<?php if($check_res['check9a'] == "1"){
  echo "checked";
  }?>>Libirium b protocol</p>
<p><input type="checkbox" name="check10a" value="1"
<?php if($check_res['check10a'] == "1"){
  echo "checked";
  }?>>Libirium c protocol</p>
<p><input type="checkbox" name="check11a" value="1"
<?php if($check_res['check11a'] == "1"){
  echo "checked";
  }?>>Libirium custom protocol</p>
<p><input type="checkbox" name="check12a" value="1"
<?php if($check_res['check12a'] == "1"){
  echo "checked";
  }?>>Valium custom protocol</p>
<p><input type="checkbox" name="check13a" value="1"
<?php if($check_res['check13a'] == "1"){
  echo "checked";
  }?>>Neurotin induction</p>
<p><input type="checkbox" name="check14a" value="1"
<?php if($check_res['check14a'] == "1"){
  echo "checked";
  }?>>Thiamin and Folate supplement</p>
<p><input type="checkbox" name="check15a" value="1"
<?php if($check_res['check15a'] == "1"){
  echo "checked";
  }?>>Keppra Custom order</p>
<p><input type="checkbox" name="check16a" value="1"
<?php if($check_res['check16a'] == "1"){
  echo "checked";
  }?>>Keppra 500mg po BID</p>
<p><input type="checkbox" name="check17a" value="1"
<?php if($check_res['check17a'] == "1"){
  echo "checked";
  }?>>All prn medication order by M.D if no contraindications</p>
<p><input type="checkbox" name="check18a" value="1"
<?php if($check_res['check18a'] == "1"){
  echo "checked";
  }?>>Clonidine b protocol</p>
<p><input type="checkbox" name="check19a" value="1"
<?php if($check_res['check19a'] == "1"){
  echo "checked";
  }?>>Clonidine custom protocol</p>
<p><input type="checkbox" name="check20a" value="1"
<?php if($check_res['check20a'] == "1"){
  echo "checked";
  }?>>Prescription medication management</p>

            </td>
            <td style="border: 1px solid black;width: 25%;"><b>Time Frame:</b>
<p>
<input type="checkbox" name="check21a" class="mcheck15" value="1"
<?php if($check_res['check21a'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="check22a" class="mcheck15" value="1"
<?php if($check_res['check22a'] == "1"){
  echo "checked";
  }?>>48hrs
<input type="checkbox" name="check23a" class="mcheck15" value="1"
<?php if($check_res['check23a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check24a" class="mcheck16" value="1"
  <?php if($check_res['check24a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check25a" class="mcheck16" value="1"
  <?php if($check_res['check25a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check26a" class="mcheck16" value="1"
  <?php if($check_res['check26a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check27a" class="mcheck17" value="1"
  <?php if($check_res['check27a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check28a" class="mcheck17" value="1"
  <?php if($check_res['check28a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check29a" class="mcheck17" value="1"
  <?php if($check_res['check29a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check30a" class="mcheck18" value="1"
  <?php if($check_res['check30a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check31a" class="mcheck18" value="1"
  <?php if($check_res['check31a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check32a" class="mcheck18" value="1"
  <?php if($check_res['check32a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check33a" class="mcheck19" value="1"
  <?php if($check_res['check33a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check34a" class="mcheck19" value="1"
  <?php if($check_res['check34a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check35a" class="mcheck19" value="1"
  <?php if($check_res['check35a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check36a" class="mcheck20" value="1"
  <?php if($check_res['check36a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check37a" class="mcheck20" value="1"
  <?php if($check_res['check37a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check38a" class="mcheck20" value="1"
  <?php if($check_res['check38a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check39a" class="mcheck21" value="1"
  <?php if($check_res['check39a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check40a" class="mcheck21" value="1"
  <?php if($check_res['check40a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check41a" class="mcheck21" value="1"
  <?php if($check_res['check41a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p><input type="checkbox" name="check42a" class="mcheck22" value="1"
<?php if($check_res['check42a'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="check43a" class="mcheck22" value="1"
<?php if($check_res['check43a'] == "1"){
  echo "checked";
  }?>>48hrs
<input type="checkbox" name="check44a" class="mcheck22" value="1"
<?php if($check_res['check44a'] == "1"){
  echo "checked";
  }?>>5days</p>

<p>
  <input type="checkbox" name="check45a" class="mcheck23" value="1"
  <?php if($check_res['check45a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check46a" class="mcheck23" value="1"
  <?php if($check_res['check46a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check47a" class="mcheck23" value="1"
  <?php if($check_res['check47a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check48a" class="mcheck24" value="1"
  <?php if($check_res['check48a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check49a" class="mcheck24" value="1"
  <?php if($check_res['check49a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check50a" class="mcheck24" value="1"
  <?php if($check_res['check50a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check51a" class="mcheck25" value="1"
  <?php if($check_res['check51a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check52a" class="mcheck25" value="1"
  <?php if($check_res['check52a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check53a" class="mcheck25" value="1"
  <?php if($check_res['check53a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check54a" class="mcheck26" value="1"
  <?php if($check_res['check54a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check55a" class="mcheck26" value="1"
  <?php if($check_res['check55a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check56a" class="mcheck26" value="1"
  <?php if($check_res['check56a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check57a" class="mcheck27" value="1"
  <?php if($check_res['check57a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check58a" class="mcheck27" value="1"
  <?php if($check_res['check58a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check59a" class="mcheck27" value="1"
  <?php if($check_res['check59a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check60a" class="mcheck28" value="1"
  <?php if($check_res['check60a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check61a" class="mcheck28" value="1"
  <?php if($check_res['check61a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check62a" class="mcheck28" value="1"
  <?php if($check_res['check62a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check63a" class="mcheck29" value="1"
  <?php if($check_res['check63a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check64a" class="mcheck29" value="1"
  <?php if($check_res['check64a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check65a" class="mcheck29" value="1"
  <?php if($check_res['check65a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check66a" class="mcheck30" value="1"
  <?php if($check_res['check66a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check67a" class="mcheck30" value="1"
  <?php if($check_res['check67a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check68a" class="mcheck30" value="1"
  <?php if($check_res['check68a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check69a" class="mcheck31" value="1"
  <?php if($check_res['check69a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check70a" class="mcheck31" value="1"
  <?php if($check_res['check70a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check71a" class="mcheck31" value="1"
  <?php if($check_res['check71a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check72a" class="mcheck32" value="1"
  <?php if($check_res['check72a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check73a" class="mcheck32" value="1"
  <?php if($check_res['check73a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check74a" class="mcheck32" value="1"
  <?php if($check_res['check74a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check75a" class="mcheck33" value="1"
  <?php if($check_res['check75a'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check76a" class="mcheck33" value="1"
  <?php if($check_res['check76a'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check77a" class="mcheck33" value="1"
  <?php if($check_res['check77a'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>
<td style="border: 1px solid black;width: 25%;"><b>Teaching Strategies:</b>
<p><b>1.Written Material</b></p>
<p><b>2.Verbal Discussion</b></p>
<p><b>3.One on One</b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
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
        </table><br><br><br><br>


           <!-- Master Treatment Plan Nursery Content-->
            <table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" name="ptname1" value="<?php echo text($check_res['ptname1']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="text-align:center">
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" value="<?php echo text($check_res['ptdate1a']);?>" name="ptdate1a" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br><br><br>

<h4 style="text-align:center;">Master Treatment Plan <br><u>Nursing cont.</u></h4>
 
<br><br>
<table style="width:100%" class="table table-bordered">
    <tr>
        <td style="width:250px;">
        <b>Target<br>Problem:</b><br>
        <p>Medical</p>
        </td>

        <td style="width:250px;">
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
        <td style="width:250px;">
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

 
<td style="width:300px;">
<b >Time Frame:(check one)</b><br>


        <input type="checkbox" class="mcheck34" name="checkbox5a" value="1" <?php if ($check_res['checkbox5a'] == "1") {
            echo "checked";}?>> 24 hrs
        <input type="checkbox" class="mcheck34" name="checkbox6" value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked";}?>> 10 days
        <input type="checkbox" class="mcheck34" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {
            echo "checked";}?>> 15 days
        <input type="checkbox" class="mcheck34" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {
            echo "checked";}?>> 30 days <br><br>
        <input type="checkbox" class="mcheck35" name="checkbox9" value="1" <?php if ($check_res['checkbox9'] == "1") {
            echo "checked";}?>> 24 hrs
        <input type="checkbox" class="mcheck35"name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {
            echo "checked";}?>> 10 days
        <input type="checkbox" class="mcheck35" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {
            echo "checked";}?>> 15 days
        <input type="checkbox" class="mcheck35" name="checkbox12" value="1" <?php if ($check_res['checkbox12'] == "1") {
            echo "checked";}?>> 30 days <br><br>
        <input type="checkbox" class="mcheck36" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {
            echo "checked";}?>> 24 hrs
        <input type="checkbox" class="mcheck36" name="checkbox14" value="1" <?php if ($check_res['checkbox14'] == "1") {
            echo "checked";}?>> 10 days
        <input type="checkbox" class="mcheck36" name="checkbox15" value="1" <?php if ($check_res['checkbox15'] == "1") {
            echo "checked";}?>> 15 days
        <input type="checkbox" class="mcheck36" name="checkbox16" value="1" <?php if ($check_res['checkbox16'] == "1") {
            echo "checked";}?>> 30 days <br><br>
        <input type="checkbox" class="mcheck37" name="checkbox17" value="1" <?php if ($check_res['checkbox17'] == "1") {
            echo "checked";}?>> 24 hrs
        <input type="checkbox" class="mcheck37" name="checkbox18" value="1" <?php if ($check_res['checkbox18'] == "1") {
            echo "checked";}?>> 10 days
        <input type="checkbox" class="mcheck37" name="checkbox19" value="1" <?php if ($check_res['checkbox19'] == "1") {
            echo "checked";}?>> 15 days
        <input type="checkbox" class="mcheck37" name="checkbox20" value="1" <?php if ($check_res['checkbox20'] == "1") {
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

</td></tr></table><br/><br/>

<!-- Page 5-->

<table style="width:100%;">
          <tr>
            <td style="width:70%;">Patient name:
              <input type="text" name="ptxt1" value="<?php echo $check_res['ptxt1'];?>">
            </td>
            <td style="width:30%;text-align:center;"><b>Center for Network Therapy<b></td>
          </tr>
        </table><br>
        <table style="width:100%;">
          <tr>
            <td>DOB:
              <input type="date" name="ptxt2" id="id1" value="<?php echo $check_res['ptxt2'];?>">
            </td>
          </tr>
        </table><br><br>
        <table style="width:100%;">
          <tr>
            <th style="width:100%;"><h3 class="h3_1">Master Treatment Plan</h3></th>
          </tr>
          <tr>
            <th style="width:100%;text-decoration:underline"><h3 class="h3_1">Psychiatrist</h3></th>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black;" class="tabel5">
          <tr>
            <td style="border: 1px solid black; width: 25%;"><b>Targeted Problem</b>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

            </td>

            <td style="border: 1px solid black;width: 25%;"><b>Routine Interventions:</b>
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
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>


            </td>
            <td style="border: 1px solid black;width: 25%;"><b>Time Frame:(check one)</b>
<p>
<input type="checkbox" name="sycheck9" class="mcheck38" value="1"
<?php if($check_res['sycheck9'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck10" class="mcheck38" value="1"
<?php if($check_res['sycheck10'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck11" class="mcheck38" value="1"
<?php if($check_res['sycheck11'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck12" class="mcheck38" value="1"
<?php if($check_res['sycheck12'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck13" class="mcheck39" value="1"
<?php if($check_res['sycheck13'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck14" class="mcheck39" value="1"
<?php if($check_res['sycheck14'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck15" class="mcheck39" value="1"
<?php if($check_res['sycheck15'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck16" class="mcheck39" value="1"
<?php if($check_res['sycheck16'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck17" class="mcheck40" value="1"
<?php if($check_res['sycheck17'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck18" class="mcheck40" value="1"
<?php if($check_res['sycheck18'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck19" class="mcheck40" value="1"
<?php if($check_res['sycheck19'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck20" class="mcheck40" value="1"
<?php if($check_res['sycheck20'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck21" class="mcheck41" value="1"
<?php if($check_res['sycheck21'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck22" class="mcheck41" value="1"
<?php if($check_res['sycheck22'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck23" class="mcheck41" value="1"
<?php if($check_res['sycheck23'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck24" class="mcheck41" value="1"
<?php if($check_res['sycheck24'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck25" class="mcheck42" value="1"
<?php if($check_res['sycheck25'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck26" class="mcheck42" value="1"
<?php if($check_res['sycheck26'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck27" class="mcheck42" value="1"
<?php if($check_res['sycheck27'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck28" class="mcheck42" value="1"
<?php if($check_res['sycheck28'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck29" class="mcheck43" value="1"
<?php if($check_res['sycheck29'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck30" class="mcheck43" value="1"
<?php if($check_res['sycheck30'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck31" class="mcheck43" value="1"
<?php if($check_res['sycheck31'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck32" class="mcheck43" value="1"
<?php if($check_res['sycheck32'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck33" class="mcheck44" value="1"
<?php if($check_res['sycheck33'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck34" class="mcheck44" value="1"
<?php if($check_res['sycheck34'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck35" class="mcheck44" value="1"
<?php if($check_res['sycheck35'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck36" class="mcheck44" value="1"
<?php if($check_res['sycheck36'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck37" class="mcheck45" value="1"
<?php if($check_res['sycheck37'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck38" class="mcheck45" value="1"
<?php if($check_res['sycheck38'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck39" class="mcheck45" value="1"
<?php if($check_res['sycheck39'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck40" class="mcheck45" value="1"
<?php if($check_res['sycheck40'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck41" class="mcheck46" value="1"
<?php if($check_res['sycheck41'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck42" class="mcheck46" value="1"
<?php if($check_res['sycheck42'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck43" class="mcheck46" value="1"
<?php if($check_res['sycheck43'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck44" class="mcheck46" value="1"
<?php if($check_res['sycheck44'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck45" class="mcheck47" value="1"
<?php if($check_res['sycheck45'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck46" class="mcheck47" value="1"
<?php if($check_res['sycheck46'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck47" class="mcheck47" value="1"
<?php if($check_res['sycheck47'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck48" class="mcheck47" value="1"
<?php if($check_res['sycheck48'] == "1"){
  echo "checked";
  }?>>30days
</p>
<p>
<input type="checkbox" name="sycheck49" class="mcheck48" value="1"
<?php if($check_res['sycheck49'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="sycheck50" class="mcheck48" value="1"
<?php if($check_res['sycheck50'] == "1"){
  echo "checked";
  }?>>10days
<input type="checkbox" name="sycheck51" class="mcheck48" value="1"
<?php if($check_res['sycheck51'] == "1"){
  echo "checked";
  }?>>15days
<input type="checkbox" name="sycheck52" class="mcheck48" value="1"
<?php if($check_res['sycheck52'] == "1"){
  echo "checked";
  }?>>30days
</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>
            <td style="border: 1px solid black;width: 25%;"><b>Teaching Strategies:</b>
<p><b>1.Groups</b></p>
<p><b>2.Written Material</b></p>
<p><b>3.Videos</b></p>
<p><b>4.Demonsstration</b></p>
<p><b>5.Verbal discussion</b></p>
<p><b>6.one-on-one</b></p>
<p><b>7.other:</b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

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
        </table><br><br>

<!-- Master Treatment Plan Medication Update -->
<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" name="name1a" value="<?php echo text($check_res['name1a']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td style="text-align:center;">
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" value="<?php echo text($check_res['date0']);?>" name="date0" style="border:none;border-bottom:2px solid black;width:150px;"/>
<td>
</tr>
</table><br><br><br>
<h2 style="text-align:center;">Master Treatment Plan Medication Update</h2>
<p style="text-align:center;">Nursing</p>
<br><br>
<table style="width:100%" class="table table-bordered">
    <tr>
        <td style="width:250px;">
        <b>Target Problem:</b><br>
        <p>Physical Withdrawals</p>
        <p>Mental instability</p>

        </td>

        <td style="width:250px;">
    <b>Medications Interventions</b><br>
    Prescription order/Medication order:<textarea style="height:50px;width:200px;" type="text" name="comment1a"><?php echo text($check_res['comment1a']);?></textarea><br>
    Prescription order/Medication order:<textarea style="height:50px;width:200px;" type="text" name="comment2"><?php echo text($check_res['comment2']);?></textarea><br>
    Prescription order/Medication order:<textarea style="height:50px;width:200px;" type="text" name="comment3"><?php echo text($check_res['comment3']);?></textarea><br>
    Prescription order/Medication order:<textarea style="height:50px;width:200px;" type="text" name="comment4"><?php echo text($check_res['comment4']);?></textarea><br>



</td>
        <td style="width:250px;">
        <b>Start Date:</b><br><br><br>
        <b>Date :</b>
      <input type="date" name="date1a" value="<?php echo text($check_res['date1a']);?>" /><br><br><br>
      <b>Date :</b>

        <input type="date" name="date2" value="<?php echo text($check_res['date2']);?>" /><br><br><br>
        <b>Date :</b>

        <input type="date" name="date3" value="<?php echo text($check_res['date3']);?>"/><br><br><br>
        <b>Date :</b>

        <input type="date" name="date4" value="<?php echo text($check_res['date4']);?>" />
</td>

<td>
<td style="width:300px;">
<b >Teaching Stratergies</b><br><br>
<p>4. Written Material</p>
<p>5. Verbal Discussion</p>
<p>6. One on One</p>


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

</td></tr></table><br/> <br/><br/>

                <!-- Master Treatment Plan
                Psychiatrist -->
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Patient Name:</label>
                                    <input type="text" name="patient" value="<?php echo text($check_res['patient']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>D.O.B:</label>
                                    <input type="date" name="date" value="<?php echo text($check_res['date']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="text-center"><b>Master Treatment Plan</b></h4>
                                    <h5 class="text-center"><b><u>Psychiatrist</u></b></h5>
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
                                    <label><input type=checkbox name='check1' style="margin-left:50px;" value="0"<?php if ($check_res["check1"] == "0") {
                                    echo "checked";};?>> Home</label>
                                    <label><input type=checkbox name='check2' style="margin-left:20px;" value="0"<?php if ($check_res["check2"] == "0") {
                                    echo "checked";};?>> In Patient</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='check3' value="0"<?php if ($check_res["check3"] == "0") {
                                    echo "checked";};?>> Sober Living</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='check4' value="0"<?php if ($check_res["check4"] == "0") {
                                    echo "checked";};?>> PHP</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='check5' value="0"<?php if ($check_res["check5"] == "0") {
                                    echo "checked";};?>> Long term</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='check6' value="0"<?php if ($check_res["check6"] == "0") {
                                    echo "checked";};?>> IOP Facility and Appointment time</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:10px;"><input type=checkbox name='check7' style="margin-left:50px;" value="0"<?php if ($check_res["check7"] == "0") {
                                    echo "checked";};?>> Rehab</label>
                                    <label><input type=checkbox name='check8' style="margin-left:20px;" value="0"<?php if ($check_res["check8"] == "0") {
                                    echo "checked";};?>> Other (specify) :</label>
                                    <label><input type="text" name="othtext1" value="<?php echo text($check_res['othtext1']);?>"/>
                                    <input type="text" name="othtext2" value="<?php echo text($check_res['othtext2']);?>"/></label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:10px;"><input type=checkbox name='check9' style="margin-left:50px;" value="0"<?php if ($check_res["check9"] == "0") {
                                    echo "checked";};?>> Follow-up with PCP</label>
                                    <label><input type=checkbox name='check10' style="margin-left:20px;" value="0"<?php if ($check_res["check10"] == "0") {
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
                                    <input type="date" name="ptdate"value="<?php echo text($check_res['compliant']);?>"/>
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
<br/><br/><br/>
<!-- Revision & Relapse Form -->
<table style="width:100%;">
                            <tr>
                                <td  >
<b>Patient Name:</b>
        <input style="border:none; border-bottom:1px solid black;" type="text" name="pname" value="<?php echo text($check_res['pname']);?>"> <br> <br>
        <b>DOB:</b>
        <input style="border:none; border-bottom:1px solid black;" type="date" name="DOB" value="<?php echo text($check_res['DOB']);?>">   </td>
                            </tr>
                        </table><br> <br>
        <table style="border:1px solid black;width:100%" class="table table-bordered" >
        <h6 style="text-align:center;">Revision of Treatment/Relapse Record</h6> <br>
        <h6 style="text-align:center;">Nursing</h6> <br> <br>
        <table  style=" width:100%" class="table table-bordered">
            <tr> <h6 style="font_wight:bold;">Target Problem: <label style="margin-left:100px;">Interventions:</label><label style="margin-left:205px;">Time Frame:</label><label style="margin-left:187px;">Teaching Strategy:</label></h6>
                <td>
                    1.Patient Relapse <br>Date of Relapse <br> <br>
                    pt signature &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                    <input type="hidden" name="input1b" id="input1b" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['input1b']);?>">
                    <img src='' class="img" id="img_input1b" style="display:none;width:25%;height:100px;" >
                </td>

                <td>
                    <input type="checkbox" name="checkboxA1" value="1" <?php if ($check_res['checkboxA1'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkboxA2" value="1" <?php if ($check_res['checkboxA2'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkboxA3" value="1" <?php if ($check_res['checkboxA3'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkboxA4" value="1" <?php if ($check_res['checkboxA4'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox1b" class="mcheck49" value="1" <?php if ($check_res['checkbox1b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox2b" class="mcheck49" value="1" <?php if ($check_res['checkbox2b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox3b" class="mcheck49" value="1" <?php if ($check_res['checkbox3b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox4b" class="mcheck50" value="1" <?php if ($check_res['checkbox4b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox5b" class="mcheck50" value="1" <?php if ($check_res['checkbox5b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck50" name="checkbox6b" value="1" <?php if ($check_res['checkbox6b'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox7b" class="mcheck51" value="1" <?php if ($check_res['checkbox7b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox8b" class="mcheck51" value="1" <?php if ($check_res['checkbox8b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox9b" class="mcheck51" value="1" <?php if ($check_res['checkbox9b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" class="mcheck52" name="checkbox10b" value="1" <?php if ($check_res['checkbox10b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox11b" class="mcheck52" value="1" <?php if ($check_res['checkbox11b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox12b" class="mcheck52" value="1" <?php if ($check_res['checkbox12b'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox13b" value="1" <?php if ($check_res['checkbox13b'] == "1") {echo "checked";}?>>1:1 <input type="checkbox" name="checkbox14b" value="1" <?php if ($check_res['checkbox14b'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox15b" value="1" <?php if ($check_res['checkbox15b'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox16b" value="1" <?php if ($check_res['checkbox16b'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox17b" value="1" <?php if ($check_res['checkbox17b'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox18b" value="1" <?php if ($check_res['checkbox18b'] == "1") {echo "checked";}?>>Demonstration
                </td>
            </tr>
            <tr>
                <td>
                    2.Patient Relapse <br>Date of Relapse <br> <br> pt signature &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                    <input type="hidden" name="input2b" id="input2b" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['input2b']);?>">
                    <img src='' class="img" id="img_input2b" style="display:none;width:25%;height:100px;" >
                </td>
                <td>
                    <input type="checkbox" name="checkbox19b" value="1" <?php if ($check_res['checkbox19b'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkbox20b" value="1" <?php if ($check_res['checkbox20b'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox21b" value="1" <?php if ($check_res['checkbox21b'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkbox22b" value="1" <?php if ($check_res['checkbox22b'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox23b" class="mcheck53" value="1" <?php if ($check_res['checkbox23b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox24b" class="mcheck53" value="1" <?php if ($check_res['checkbox24b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox25b" class="mcheck53" value="1" <?php if ($check_res['checkbox25b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox26b" class="mcheck54" value="1" <?php if ($check_res['checkbox26b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox27b" class="mcheck54" value="1" <?php if ($check_res['checkbox27b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck54" name="checkbox28b" value="1" <?php if ($check_res['checkbox28b'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox29b" class="mcheck55" value="1" <?php if ($check_res['checkbox29b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox30b" class="mcheck55" value="1" <?php if ($check_res['checkbox30b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck55" name="checkbox31b" value="1" <?php if ($check_res['checkbox31b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox32b" class="mcheck56" value="1" <?php if ($check_res['checkbox30b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox33b" class="mcheck56" value="1" <?php if ($check_res['checkbox33b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck56" name="checkbox34b" value="1" <?php if ($check_res['checkbox34b'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox35b" value="1" <?php if ($check_res['checkbox35b'] == "1") {echo "checked";}?>>1:1 <input type="checkbox" name="checkbox36b" value="1" <?php if ($check_res['checkbox36b'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox37b" value="1" <?php if ($check_res['checkbox37b'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox38b" value="1" <?php if ($check_res['checkbox38b'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox39b" value="1" <?php if ($check_res['checkbox39b'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox40b" value="1" <?php if ($check_res['checkbox40b'] == "1") {echo "checked";}?>>Demonstration
                </td>
            </tr>
            <tr>
                <td>
                    3.Patient Relapse <br>Date of Relapse <br> <br> pt signature &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                     <input type="hidden" name="input3b"  id="input3b" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['input3b']);?>">
                     <img src='' class="img" id="img_input3b" style="display:none;width:25%;height:100px;" >
                </td>
                <td>
                    <input type="checkbox" name="checkbox41b" value="1" <?php if ($check_res['checkbox41b'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkbox42b" value="1" <?php if ($check_res['checkbox42b'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox43b" value="1" <?php if ($check_res['checkbox43b'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkbox44b" value="1" <?php if ($check_res['checkbox44b'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox45b" class="mcheck57" value="1" <?php if ($check_res['checkbox45b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox46b" class="mcheck57" value="1" <?php if ($check_res['checkbox46b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck57" name="checkbox47b" value="1" <?php if ($check_res['checkbox47b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox48b" class="mcheck58" value="1" <?php if ($check_res['checkbox48b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox49b" class="mcheck58" value="1" <?php if ($check_res['checkbox49b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck58" name="checkbox50b" value="1" <?php if ($check_res['checkbox50b'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox51b" class="mcheck59" value="1" <?php if ($check_res['checkbox51b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox52b" class="mcheck59" value="1" <?php if ($check_res['checkbox52b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck59" name="checkbox53b" value="1" <?php if ($check_res['checkbox53b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" class="mcheck60" name="checkbox54b" value="1" <?php if ($check_res['checkbox54b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox55b" class="mcheck60" value="1" <?php if ($check_res['checkbox55b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck60" name="checkbox56b" value="1" <?php if ($check_res['checkbox56b'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox57b" value="1" <?php if ($check_res['checkbox57b'] == "1") {echo "checked";}?>>1:1 <input type="checkbox" name="checkbox58b" value="1" <?php if ($check_res['checkbox58b'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox59b" value="1" <?php if ($check_res['checkbox59b'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox60b" value="1" <?php if ($check_res['checkbox60b'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox61b" value="1" <?php if ($check_res['checkbox61b'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox62b" value="1" <?php if ($check_res['checkbox62b'] == "1") {echo "checked";}?>>Demonstration
                </td>
            </tr>
            <tr>
                <td>
                    4.Patient Relapse <br>Date of Relapse <br> <br> pt signature
                    &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                     <input type="hidden" name="input4b" id="input4b" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['input4b']);?>">
                     <img src='' class="img" id="img_input4b" style="display:none;width:25%;height:100px;" >
                </td>
                <td>
                    <input type="checkbox" name="checkbox61b" value="1" <?php if ($check_res['checkbox61b'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkbox62b" value="1" <?php if ($check_res['checkbox62b'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox63b" value="1" <?php if ($check_res['checkbox63b'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkbox64b" value="1" <?php if ($check_res['checkbox64b'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox65b" class="mcheck61" value="1" <?php if ($check_res['checkbox65b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox66b" class="mcheck61" value="1" <?php if ($check_res['checkbox66b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck61" name="checkbox67b" value="1" <?php if ($check_res['checkbox67b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" class="mcheck62" name="checkbox68b" value="1" <?php if ($check_res['checkbox68b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox69b" class="mcheck62" value="1" <?php if ($check_res['checkbox69b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck62" name="checkbox70b" value="1" <?php if ($check_res['checkbox70b'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" class="mcheck63" name="checkbox71b" value="1" <?php if ($check_res['checkbox71b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox72b" class="mcheck63" value="1" <?php if ($check_res['checkbox72b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck63" name="checkbox73b" value="1" <?php if ($check_res['checkbox73b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox74b" class="mcheck64" value="1" <?php if ($check_res['checkbox74b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox75b" class="mcheck64" value="1" <?php if ($check_res['checkbox75b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck64" name="checkbox76b" value="1" <?php if ($check_res['checkbox76b'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox77b" value="1" <?php if ($check_res['checkbox77b'] == "1") {echo "checked";}?>>1:1 <input type="checkbox" name="checkbox78b" value="1" <?php if ($check_res['checkbox78b'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox79b" value="1" <?php if ($check_res['checkbox79b'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox80b" value="1" <?php if ($check_res['checkbox80b'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox81b" value="1" <?php if ($check_res['checkbox81b'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox82b" value="1" <?php if ($check_res['checkbox82b'] == "1") {echo "checked";}?>>Demonstration
                </td>
            </tr>
            <tr>
                <td>
                    5.Patient Relapse <br>Date of Relapse <br> <br> pt signature
                    &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                     <input type="hidden" name="input5b" id="input5b" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['input5b']);?>">
                     <img src='' class="img" id="img_input5b" style="display:none;width:25%;height:100px;" >
                </td>
                <td>
                    <input type="checkbox" name="checkbox83b" value="1" <?php if ($check_res['checkbox83b'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkbox84b" value="1" <?php if ($check_res['checkbox84b'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox85b" value="1" <?php if ($check_res['checkbox85b'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkbox86b" value="1" <?php if ($check_res['checkbox86b'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox87b" class="mcheck65" value="1" <?php if ($check_res['checkbox87b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox88b" class="mcheck65" class="mcheck65" value="1" <?php if ($check_res['checkbox88b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox89b" class="mcheck65" value="1" <?php if ($check_res['checkbox89b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox90b" class="mcheck66" value="1" <?php if ($check_res['checkbox90b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox91b" class="mcheck66" value="1" <?php if ($check_res['checkbox91b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck66" name="checkbox92b" value="1" <?php if ($check_res['checkbox92b'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox93b" class="mcheck67" value="1" <?php if ($check_res['checkbox93b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox94b" class="mcheck67" value="1" <?php if ($check_res['checkbox94b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck67" name="checkbox95b" value="1" <?php if ($check_res['checkbox95b'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox96b" class="mcheck68" value="1" <?php if ($check_res['checkbox96b'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox97b" class="mcheck68" value="1" <?php if ($check_res['checkbox97b'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" class="mcheck68" name="checkbox98b" value="1" <?php if ($check_res['checkbox98b'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox99b" value="1" <?php if ($check_res['checkbox99b'] == "1") {echo "checked";}?>>1:1 <input type="checkbox" name="checkbox100b" value="1" <?php if ($check_res['checkbox100b'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox111b" value="1" <?php if ($check_res['checkbox111b'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox112b" value="1" <?php if ($check_res['checkbox112b'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox113b" value="1" <?php if ($check_res['checkbox113b'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox114b" value="1" <?php if ($check_res['checkbox114b'] == "1") {echo "checked";}?>>Demonstration
                </td>
                 
            </tr>
        </table>
        <b>Nurse signature:</b>
        &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" style="border:none; border-bottom:1px solid black;" name="sign1b" id="sign1b" value="<?php echo text($check_res['sign1b']);?>">
         <img src='' class="img" id="img_sign1b" style="display:none;width:25%;height:100px;" >
         <b>Date:</b> <input type="date" style="border:none; border-bottom:1px solid black;" name="bdate1" value="<?php echo text($check_res['bdate1']);?>">
        <b>Time:</b> <input type="time" style="border:none; border-bottom:1px solid black;" name="btime1" value="<?php echo text($check_res['btime1']);?>"> <br>
        <b>Patient signature:</b>
        &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
        <input type="hidden" style="border:none; border-bottom:1px solid black;" name="sign2b"  id="sign2b" value="<?php echo text($check_res['sign2b']);?>" >
        <img src='' class="img" id="img_sign2b" style="display:none;width:25%;height:100px;" >
         <b>Date:</b> <input type="date" style="border:none; border-bottom:1px solid black;" name="bdate2" value="<?php echo text($check_res['bdate2']);?>">
          <b>Time:</b> <input type="time" style="border:none; border-bottom:1px solid black;" name="btime2" value="<?php echo text($check_res['btime2']);?>"><br> <br>
 

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
<script type="text/javascript" src="../../forms/admission_orders/assets/js/jquery.signature.min.js"></script>
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
    $('.mcheck1').on('change', function() {
    $('.mcheck1').not(this).prop('checked', false);
    });
    $('.mcheck2').on('change', function() {
    $('.mcheck2').not(this).prop('checked', false);
    });
    $('.mcheck3').on('change', function() {
    $('.mcheck3').not(this).prop('checked', false);
    });
    $('.mcheck4').on('change', function() {
    $('.mcheck4').not(this).prop('checked', false);
    });
    $('.mcheck5').on('change', function() {
    $('.mcheck5').not(this).prop('checked', false);
    });
    $('.mcheck6').on('change', function() {
    $('.mcheck6').not(this).prop('checked', false);
    });
    $('.mcheck7').on('change', function() {
    $('.mcheck7').not(this).prop('checked', false);
    });
    $('.mcheck8').on('change', function() {
    $('.mcheck8').not(this).prop('checked', false);
    });
    $('.mcheck9').on('change', function() {
    $('.mcheck9').not(this).prop('checked', false);
    });
    $('.mcheck10').on('change', function() {
    $('.mcheck10').not(this).prop('checked', false);
    });
    $('.mcheck11').on('change', function() {
    $('.mcheck11').not(this).prop('checked', false);
    });
    $('.mcheck12').on('change', function() {
    $('.mcheck12').not(this).prop('checked', false);
    });
    $('.mcheck13').on('change', function() {
    $('.mcheck13').not(this).prop('checked', false);
    });
    $('.mcheck14').on('change', function() {
    $('.mcheck14').not(this).prop('checked', false);
    });
    $('.mcheck15').on('change', function() {
    $('.mcheck15').not(this).prop('checked', false);
    });
    $('.mcheck16').on('change', function() {
    $('.mcheck16').not(this).prop('checked', false);
    });
    $('.mcheck17').on('change', function() {
    $('.mcheck17').not(this).prop('checked', false);
    });
    $('.mcheck18').on('change', function() {
    $('.mcheck18').not(this).prop('checked', false);
    });
    $('.mcheck19').on('change', function() {
    $('.mcheck19').not(this).prop('checked', false);
    });
    $('.mcheck20').on('change', function() {
    $('.mcheck20').not(this).prop('checked', false);
    });
    $('.mcheck21').on('change', function() {
    $('.mcheck21').not(this).prop('checked', false);
    });
    $('.mcheck22').on('change', function() {
    $('.mcheck22').not(this).prop('checked', false);
    });
    $('.mcheck23').on('change', function() {
    $('.mcheck23').not(this).prop('checked', false);
    });
    $('.mcheck24').on('change', function() {
    $('.mcheck24').not(this).prop('checked', false);
    });
    $('.mcheck25').on('change', function() {
    $('.mcheck25').not(this).prop('checked', false);
    });
    $('.mcheck26').on('change', function() {
    $('.mcheck26').not(this).prop('checked', false);
    });
    $('.mcheck27').on('change', function() {
    $('.mcheck27').not(this).prop('checked', false);
    });
    $('.mcheck28').on('change', function() {
    $('.mcheck28').not(this).prop('checked', false);
    });
    $('.mcheck29').on('change', function() {
    $('.mcheck29').not(this).prop('checked', false);
    });
    $('.mcheck30').on('change', function() {
    $('.mcheck30').not(this).prop('checked', false);
    });
    $('.mcheck31').on('change', function() {
    $('.mcheck31').not(this).prop('checked', false);
    });
    $('.mcheck32').on('change', function() {
    $('.mcheck32').not(this).prop('checked', false);
    });
    $('.mcheck33').on('change', function() {
    $('.mcheck33').not(this).prop('checked', false);
    });
    $('.mcheck34').on('change', function() {
    $('.mcheck34').not(this).prop('checked', false);
    });
    $('.mcheck35').on('change', function() {
    $('.mcheck35').not(this).prop('checked', false);
    });
    $('.mcheck36').on('change', function() {
    $('.mcheck36').not(this).prop('checked', false);
    });
    $('.mcheck37').on('change', function() {
    $('.mcheck37').not(this).prop('checked', false);
    });
    $('.mcheck38').on('change', function() {
    $('.mcheck38').not(this).prop('checked', false);
    });
    $('.mcheck39').on('change', function() {
    $('.mcheck39').not(this).prop('checked', false);
    });
    $('.mcheck40').on('change', function() {
    $('.mcheck40').not(this).prop('checked', false);
    });
    $('.mcheck41').on('change', function() {
    $('.mcheck41').not(this).prop('checked', false);
    });
    $('.mcheck42').on('change', function() {
    $('.mcheck42').not(this).prop('checked', false);
    });
    $('.mcheck43').on('change', function() {
    $('.mcheck43').not(this).prop('checked', false);
    });
    $('.mcheck44').on('change', function() {
    $('.mcheck44').not(this).prop('checked', false);
    });
    $('.mcheck45').on('change', function() {
    $('.mcheck45').not(this).prop('checked', false);
    });
    $('.mcheck46').on('change', function() {
    $('.mcheck46').not(this).prop('checked', false);
    });
    $('.mcheck47').on('change', function() {
    $('.mcheck47').not(this).prop('checked', false);
    });
    $('.mcheck48').on('change', function() {
    $('.mcheck48').not(this).prop('checked', false);
    });
    $('.mcheck49').on('change', function() {
    $('.mcheck49').not(this).prop('checked', false);
    });
    $('.mcheck50').on('change', function() {
    $('.mcheck50').not(this).prop('checked', false);
    });
    $('.mcheck51').on('change', function() {
    $('.mcheck51').not(this).prop('checked', false);
    });
    $('.mcheck52').on('change', function() {
    $('.mcheck52').not(this).prop('checked', false);
    });
    $('.mcheck53').on('change', function() {
    $('.mcheck53').not(this).prop('checked', false);
    });
    $('.mcheck54').on('change', function() {
    $('.mcheck54').not(this).prop('checked', false);
    });
    $('.mcheck55').on('change', function() {
    $('.mcheck55').not(this).prop('checked', false);
    });
    $('.mcheck56').on('change', function() {
    $('.mcheck56').not(this).prop('checked', false);
    });
    $('.mcheck57').on('change', function() {
    $('.mcheck57').not(this).prop('checked', false);
    });
    $('.mcheck58').on('change', function() {
    $('.mcheck58').not(this).prop('checked', false);
    });
    $('.mcheck59').on('change', function() {
    $('.mcheck59').not(this).prop('checked', false);
    });
    $('.mcheck60').on('change', function() {
    $('.mcheck60').not(this).prop('checked', false);
    });
    $('.mcheck61').on('change', function() {
    $('.mcheck61').not(this).prop('checked', false);
    });
    $('.mcheck62').on('change', function() {
    $('.mcheck62').not(this).prop('checked', false);
    });
    $('.mcheck63').on('change', function() {
    $('.mcheck63').not(this).prop('checked', false);
    });
    $('.mcheck64').on('change', function() {
    $('.mcheck64').not(this).prop('checked', false);
    });
    $('.mcheck65').on('change', function() {
    $('.mcheck65').not(this).prop('checked', false);
    });
    $('.mcheck66').on('change', function() {
    $('.mcheck66').not(this).prop('checked', false);
    });
    $('.mcheck67').on('change', function() {
    $('.mcheck67').not(this).prop('checked', false);
    });
    $('.mcheck68').on('change', function() {
    $('.mcheck68').not(this).prop('checked', false);
    });
</script>
