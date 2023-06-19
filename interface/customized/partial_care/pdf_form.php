<html>
  <head>
  <link rel="stylesheet" href="./style.css">
</head>

<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");

$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$name = $_GET['formname'];
$pid = $_SESSION['pid'];
$encounter = $_GET["encounter"];
$data =array();

if ($formid) {
    $sql = "SELECT f.*,p.* FROM form_partial_care as f join patient_data as p on p.pid = f.pid WHERE f.id = ?";
    $res = sqlStatement($sql, array($formid));
    

    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
      $all[$iter] = $row;
  }
  $check_res = $all[0];
}
    $check_res = $formid ? $check_res : array();
  //   print_r($check_res);die;
$name = $check_res['fname'].' '.$check_res['mname'].' '.$check_res['lname'];
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';

use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="";
ob_start();
 ?>
<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Partial Care Master Treatment Plan</h2>
</div><br>
<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
<table style="width: 100%;border:1px solid #000;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['name1']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['ptdate1']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table><br>

<table style="width:100%;border:1px solid black;" class="table table-bordered">
    <tr>
     <td style="width:20%;vertical-align:top;border-right:1px solid black;">
        <b>Diagnosis:</b><br><br>
        <p>Substance Abuse/dependence[include withdraw risk]Ex Heroin,Opiates,Alcohol,Benzos</p>
        </td>
        <td style="width:25%;vertical-align:top;border-right:1px solid black;">
        <b>Target Date</b><br><br>
        <input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked='checked'";}else{
      echo '';}?>>5days<br>
        <input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="2" <?php if ($check_res['checkbox1'] == "2") {
            echo "checked='checked'";}else{
      echo '';}?>>10days <br>
        <input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="3" <?php if ($check_res['checkbox1'] == "3") {
            echo "checked='checked'";}else{
      echo '';}?>>15days <br>
        <input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="4" <?php if ($check_res['checkbox1'] == "4") {
            echo "checked='checked'";}else{
      echo '';}?>>30days<br>
        <input type="checkbox" class="radio_change thiacheck checkbox1" name="checkbox1" value="5" <?php if ($check_res['checkbox1'] == "5") {
            echo "checked='checked'";}else{
      echo '';}?>>Others
</td>
<td style="width:250px;vertical-align:top;border-right:1px solid #000;">
    <b>Discharge Criteria</b><br>
    <ul>
        <li>Recognize consequences of continuing substance use</li>
        <li>Receptive to continuing treatment for addition(s) (IOP/AA/NA meetings)</li>
        <li>Gain Insight to his or her addiction patterns</li>
        <li>Improved functioning at work and/or school</li>
        <li>Improved family and social relationships</li>
        <li>Other:[specify]&ensp; <u> <?php echo text($check_res['other1']);?></u></li>
    </ul>
</td>
<td style="width:250px;vertical-align:top;">
  <b>Target Date:</b>&ensp; <u><?php echo text($check_res['tdate1']);?></u>
</td>
    </tr>
</table><br><hr>
<table style="width: 100%;border:1px solid #000;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['name2']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['ptdate2']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table><br>
<table style="text-align:center;width:100%" >
  <tr>
    <td align="center" style="text-align:center;width:100%">
      <b>Partial Care Master Treatment Plan<u>
        <br>Nursing</u></b>
    </td>
  </tr>
</table><br>
        <table style="border:1px solid black;width:100%" class="table table-bordered" >
            <tr >
            <td style="border-right:1px solid #000;width:12%;vertical-align:top;">
                <b>Target Problem</b>
                
            </td>
            <td style="border-right:1px solid #000;vertical-align:top;width:40%">
        
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
            <td style="border-right:1px solid #000;vertical-align:top;width:32%">
                <b>Time Frame (check one)</b> <br>
                <input type="checkbox" class="radio_change thiacheck checkbox2" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox2" name="checkbox2" value="2" <?php if ($check_res['checkbox2'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox2" name="checkbox2" value="3" <?php if ($check_res['checkbox2'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox2" name="checkbox2" value="4" <?php if ($check_res['checkbox2'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br>

                <input type="checkbox" class="radio_change thiacheck checkbox3" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox3" name="checkbox3" value="2" <?php if ($check_res['checkbox3'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox3" name="checkbox3" value="3" <?php if ($check_res['checkbox3'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox3" name="checkbox3" value="4" <?php if ($check_res['checkbox3'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox4" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox4" name="checkbox4" value="2" <?php if ($check_res['checkbox4'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox4" name="checkbox4" value="3" <?php if ($check_res['checkbox4'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox4" name="checkbox4" value="4" <?php if ($check_res['checkbox4'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br><br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox5" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox5" name="checkbox5" value="2" <?php if ($check_res['checkbox5'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox5" name="checkbox5" value="3" <?php if ($check_res['checkbox5'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox5" name="checkbox5" value="4" <?php if ($check_res['checkbox5'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox6" name="checkbox6" value="1" <?php if ($check_res['checkbox6'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox6" name="checkbox6" value="2" <?php if ($check_res['checkbox6'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox6" name="checkbox6" value="3" <?php if ($check_res['checkbox6'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox6" name="checkbox6" value="4" <?php if ($check_res['checkbox6'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br><br><br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox7" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox7" name="checkbox7" value="2" <?php if ($check_res['checkbox7'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox7" name="checkbox7" value="3" <?php if ($check_res['checkbox7'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox7" name="checkbox7" value="4" <?php if ($check_res['checkbox7'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br><br><br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox8" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox8" name="checkbox8" value="2" <?php if ($check_res['checkbox8'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox8" name="checkbox8" value="3" <?php if ($check_res['checkbox8'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox8" name="checkbox8" value="4" <?php if ($check_res['checkbox8'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br><br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox9" name="checkbox9" value="1" <?php if ($check_res['checkbox9'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox9" name="checkbox9" value="2" <?php if ($check_res['checkbox9'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox9" name="checkbox9" value="3" <?php if ($check_res['checkbox9'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox9" name="checkbox9" value="4" <?php if ($check_res['checkbox9'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox10" name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox10" name="checkbox10" value="2" <?php if ($check_res['checkbox10'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox10" name="checkbox10" value="3" <?php if ($check_res['checkbox10'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox10" name="checkbox10" value="4" <?php if ($check_res['checkbox10'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox11" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox11" name="checkbox11" value="2" <?php if ($check_res['checkbox11'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox11" name="checkbox11" value="3" <?php if ($check_res['checkbox11'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox11" name="checkbox11" value="4" <?php if ($check_res['checkbox11'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox12" name="checkbox12" value="1" <?php if ($check_res['checkbox12'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox12" name="checkbox12" value="2" <?php if ($check_res['checkbox12'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox12" name="checkbox12" value="3" <?php if ($check_res['checkbox12'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox12" name="checkbox12" value="4" <?php if ($check_res['checkbox12'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br>
                
                <input type="checkbox" class="radio_change thiacheck checkbox13" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {echo "checked='checked'";}else{
      echo '';}?>>24 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox13" name="checkbox13" value="2" <?php if ($check_res['checkbox13'] == "2") {echo "checked='checked'";}else{
      echo '';}?>>48 hrs &ensp;  
                <input type="checkbox" class="radio_change thiacheck checkbox13" name="checkbox13" value="3" <?php if ($check_res['checkbox13'] == "3") {echo "checked='checked'";}else{
      echo '';}?>>5 days  &ensp;
                <input type="checkbox" class="radio_change thiacheck checkbox13" name="checkbox13" value="4" <?php if ($check_res['checkbox13'] == "4") {echo "checked='checked'";}else{
      echo '';}?>>10 days <br>
                
            </td>
            <td style="vertical-align:top">
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
        <b>Nurse signature:</b> 
        <?php
                if($check_res['sign_1']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign_1'].'>';
                }
                ?>
        <img src='<?php echo text($check_res['sign_1']);?>' style="display:none;width:25%;height:100px;" >
         <b>Date:</b> <u><?php echo text($check_res['date1']);?></u> <b>Time:</b> <u><?php echo text($check_res['time1']);?></u><br>
        <b>Patient signature:</b><?php
                if($check_res['sign_2']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign_2'].'>';
                }
                ?> <b>Date:</b> <u></u><?php echo text($check_res['date2']);?></u><b>Time:</b> <u><?php echo text($check_res['time2']);?></u><br> <br><br><hr>
<table style="width: 100%;border:1px solid #000;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['name3']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['ptdate3']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
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
            <td style="border-right: 1px solid black; width: 18%;vertical-align:top;text-align:center;"><b>Target Problem:</b>
              <p style="">Physical Withdrawals<br>
Mental instability</p>
</td>

<td style="border-right: 1px solid black;width: 30%;vertical-align:top;"><b>Interventions:</b>
<p><input type="checkbox" name="dis_check1" value="1"
<?php if($check_res['dis_check1'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>
>Neurontin Induction</p>
<p><input type="checkbox" name="dis_check2" value="1"
<?php if($check_res['dis_check2'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Keppra Custom order</p>
<p><input type="checkbox" name="dis_check3" value="1"
<?php if($check_res['dis_check3'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Keppra 500mg po BID</p>
<p><input type="checkbox" name="dis_check4" value="1"
<?php if($check_res['dis_check4'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>All prn medication order by M.D if no contraindications</p>
<p><input type="checkbox" name="dis_check5" value="1"
<?php if($check_res['dis_check5'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Clonidine b protocol</p>
<p><input type="checkbox" name="dis_check6" value="1"
<?php if($check_res['dis_check6'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Clonidine custom protocol</p>
<p><input type="checkbox" name="dis_check7" value="1"
<?php if($check_res['dis_check7'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Prescription medication management</p>
<p><input type="checkbox" name="dis_check8" value="1"
<?php if($check_res['dis_check8'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>other&ensp;<u><?php echo text($check_res['other2']);?></u>
  <p><input type="checkbox" name="check9" value="1"
<?php if($check_res['check9'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>other&ensp;<u><?php echo text($check_res['other3']);?></u>
    </td>


    <td style="border-right: 1px solid black;width: 25%; vertical-align:top;"><b>Time Frame:</b>
<p>
<input type="checkbox" class="radio_change thiacheck time_ck1" name="time_ck1" value="1"
<?php if($check_res['time_ck1'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck time_ck1" name="time_ck1" value="2"
<?php if($check_res['time_ck1'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>48hrs
<input type="checkbox" class="radio_change thiacheck time_ck1" name="time_ck1" value="3"
<?php if($check_res['time_ck1'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck2" name="time_ck2" value="1"
  <?php if($check_res['time_ck2'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck2" name="time_ck2" value="2"
  <?php if($check_res['time_ck2'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck2" name="time_ck2" value="3"
  <?php if($check_res['time_ck2'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck3" name="time_ck3" value="1"
  <?php if($check_res['time_ck3'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck3" name="time_ck3" value="2"
  <?php if($check_res['time_ck3'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck3" name="time_ck3" value="3"
  <?php if($check_res['time_ck3'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck4" name="time_ck4" value="1"
  <?php if($check_res['time_ck4'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck4" name="time_ck4" value="2"
  <?php if($check_res['time_ck4'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck4" name="time_ck4" value="3"
  <?php if($check_res['time_ck4'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>5days
</p><br>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck5" name="time_ck5" value="1"
  <?php if($check_res['time_ck5'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck5" name="time_ck5" value="2"
  <?php if($check_res['time_ck5'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck5" name="time_ck5" value="3"
  <?php if($check_res['time_ck5'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck6" name="time_ck6" value="1"
  <?php if($check_res['time_ck6'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck6" name="time_ck6" value="2"
  <?php if($check_res['time_ck6'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck6" name="time_ck6" value="3"
  <?php if($check_res['time_ck6'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck7" name="time_ck7" value="1"
  <?php if($check_res['time_ck7'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck7" name="time_ck7" value="2"
  <?php if($check_res['time_ck7'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck7" name="time_ck7" value="3"
  <?php if($check_res['time_ck7'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>5days
</p>

<p>
  <input type="checkbox" class="radio_change thiacheck time_ck8" name="time_ck8" value="1"
  <?php if($check_res['time_ck8'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
  <input type="checkbox" class="radio_change thiacheck time_ck8" name="time_ck8" value="2"
  <?php if($check_res['time_ck8'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>48hrs
  <input type="checkbox" class="radio_change thiacheck time_ck8" name="time_ck8" value="3"
  <?php if($check_res['time_ck8'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>5days
</p>
            </td>
<td style="width: 25%;vertical-align:top;"><b>Teaching Strategies:</b>
<p><b>1.Written Material</b></p>
<p><b>2.Verbal Discussion</b></p>
<p><b>3.One on One</b></p>
            </td>
          </tr>
        </table><br><br>
        <table>
          <tr>
            <td>Nurse Signature:<?php
                if($check_res['nsign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['nsign'].'>';
                }
                ?>
        <img src='<?php echo text($check_res['nsign']);?>' class="img" id="img_nsign" style="display:none;width:25%;height:100px;" >

             
            </td>
             <td>Date:&ensp;<u><?php echo $check_res['dedate1'];?></u></td>
              <td>Time:&ensp;<u><?php echo $check_res['detime1'];?></u></td>
          </tr>
        <tr>
    <td>
        &nbsp;
        
    </td>
</tr>
          <tr>
          <td>Patient Signature: 
          <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
          <?php
                if($check_res['psign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['psign'].'>';
                }
                ?>
        <img src='<?php echo text($check_res['psign']);?>' class="img" id="img_psign" style="display:none;width:25%;height:100px;" >
          
          </td>
             <td>Date:&ensp;<u><?php echo $check_res['dedate2'];?></u></td>
              <td>Time:&ensp;<u><?php echo $check_res['detime2'];?></u></td>
          </tr>
        </table><br><br>
                   <!-- Master Treatment Plan Nursery Content-->
                   <hr>
 <table style="width: 100%;border:1px solid #000;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['name4']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['ptdate4']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table><br>
<h4 style="text-align:center;">Partial Care Master Treatment Plan <br><u>Nursing cont.</u></h4><br>
<table style="width:100%;border: 1px solid black;" class="table table-bordered">
    <tr>
        <td style="border-right: 1px solid black;vertical-align:top">
        <b>Target<br>Problem:</b><br>
        <p>Medical</p>
        </td>

        <td style="width:25%;border-right: 1px solid black;vertical-align:top">
    <b>Client's Current Medical Conditions:(list)</b><br>
    <ul>
        <li><u><?php echo text($check_res['input1']);?></u></li>
        <li><u><?php echo text($check_res['input2']);?></u></li>
        <li><u><?php echo text($check_res['input3']);?></u></li>
        <li><u><?php echo text($check_res['input4']);?></u></li>
        <li><u><?php echo text($check_res['input5']);?></u></li>
        <li><u><?php echo text($check_res['input6']);?></u></li>
    </ul>
</td>
        <td style="width:35%;border-right: 1px solid black;vertical-align:top">
        <b>Interventions:</b><br>
        <input type="checkbox" name="checkbox1a" value="1" <?php if ($check_res['checkbox1a'] == "1") {
            echo "checked='checked'";}else{
      echo '';}?>>   Clients will follow up with PCP for all medical issues.<br>
        <input type="checkbox" name="checkbox2a" value="1" <?php if ($check_res['checkbox2a'] == "1") {
            echo "checked='checked'";}else{
      echo '';}?>>   MD will be notified of current medical conditions<br>
        <input type="checkbox" name="checkbox3a" value="1" <?php if ($check_res['checkbox3a'] == "1") {
            echo "checked='checked'";}else{
      echo '';}?>>   RD and MD will be notified if client has to take their own medication during treatment stay <br>
        <input type="checkbox" name="checkbox4a" value="1" <?php if ($check_res['checkbox4a'] == "1") {
            echo "checked='checked'";}else{
      echo '';}?>>   Client will administer own medication
       
</td>
<td style="width:30%;vertical-align:top">
<b >Time Frame:(check one)</b><br>


<input type="checkbox" class="radio_change thiacheck tm_one1" name="tm_one1" value="1" <?php if ($check_res['tm_one1'] == "1") {
            echo "checked='checked'";}else{
      echo '';}?>> 24 hrs
        <input type="checkbox" class="radio_change thiacheck tm_one1" name="tm_one1" value="2" <?php if ($check_res['tm_one1'] == "2") {
            echo "checked='checked'";}else{
      echo '';}?>> 10 days
        <input type="checkbox" class="radio_change thiacheck tm_one1" name="tm_one1" value="3" <?php if ($check_res['tm_one1'] == "3") {
            echo "checked='checked'";}else{
      echo '';}?>> 15 days
        <input type="checkbox" class="radio_change thiacheck tm_one1" name="tm_one1" value="4" <?php if ($check_res['tm_one4'] == "4") {
            echo "checked='checked'";}else{
      echo '';}?>> 30 days <br><br>
            <input type="checkbox" class="radio_change thiacheck tm_one2" name="tm_one2" value="1" <?php if ($check_res['tm_one2'] == "1") {
            echo "checked='checked'";}else{
      echo '';}?>> 24 hrs
        <input type="checkbox" class="radio_change thiacheck tm_one2" name="tm_one2" value="2" <?php if ($check_res['tm_one2'] == "2") {
            echo "checked='checked'";}else{
      echo '';}?>> 10 days
        <input type="checkbox" class="radio_change thiacheck tm_one2" name="tm_one2" value="3" <?php if ($check_res['tm_one2'] == "3") {
            echo "checked='checked'";}else{
      echo '';}?>> 15 days
        <input type="checkbox" class="radio_change thiacheck tm_one2" name="tm_one2" value="4" <?php if ($check_res['tm_one2'] == "4") {
            echo "checked='checked'";}else{
      echo '';}?>> 30 days <br><br>
            <input type="checkbox" class="radio_change thiacheck tm_one3" name="tm_one3" value="1" <?php if ($check_res['tm_one3'] == "1") {
            echo "checked='checked'";}else{
      echo '';}?>> 24 hrs
        <input type="checkbox" class="radio_change thiacheck tm_one3" name="tm_one3" value="2" <?php if ($check_res['tm_one3'] == "2") {
            echo "checked='checked'";}else{
      echo '';}?>> 10 days
        <input type="checkbox" class="radio_change thiacheck tm_one3" name="tm_one3" value="3" <?php if ($check_res['tm_one3'] == "3") {
            echo "checked='checked'";}else{
      echo '';}?>> 15 days
        <input type="checkbox" class="radio_change thiacheck tm_one3" name="tm_one3" value="4" <?php if ($check_res['tm_one3'] == "4") {
            echo "checked='checked'";}else{
      echo '';}?>> 30 days <br><br>
            <input type="checkbox" class="radio_change thiacheck tm_one4" name="tm_one4" value="1" <?php if ($check_res['tm_one4'] == "1") {
            echo "checked='checked'";}else{
      echo '';}?>> 24 hrs
        <input type="checkbox" class="radio_change thiacheck tm_one4" name="tm_one4" value="2" <?php if ($check_res['tm_one4'] == "2") {
            echo "checked='checked'";}else{
      echo '';}?>> 10 days
        <input type="checkbox" class="radio_change thiacheck tm_one4" name="tm_one4" value="3" <?php if ($check_res['tm_one4'] == "3") {
            echo "checked='checked'";}else{
      echo '';}?>> 15 days
        <input type="checkbox" class="radio_change thiacheck tm_one4" name="tm_one4" value="4" <?php if ($check_res['tm_one4'] == "4") {
            echo "checked='checked'";}else{
      echo '';}?>> 30 days <br>
</td>
    </tr>
</table>
<table><tr><td>
    <b>Nurse signature:</b>
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <?php
                if($check_res['sign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign'].'>';
                }
                ?>
    <img src='<?php echo text($check_res['sign']);?>' class="img" id="img_sign" style="display:none;width:50%;height:100px;" >
        </td>
        <td>
    <b style="margin-left:50px;">Date:</b>&ensp;<u><?php echo text($check_res['date2a']);?></u>
    <b style="margin-left:50px;">Time :</b>&ensp;<u><?php echo text($check_res['time']);?></u>

</td></tr></table><br/><br/>

<!-- Page 5-->
<hr>
<table style="width: 100%;border:1px solid #000;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['name5']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['ptdate5']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table><br>
        <table style="width:100%;">
          <tr>
            <th style="width:100%;"><h3 class="h3_1">Partial Care Master Treatment Plan</h3></th>
          </tr>
          <tr>
            <th style="width:100%;text-decoration:underline"><h3 class="h3_1">Psychiatrist</h3></th>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black;"  class="table table-bordered">
          <tr>
            <td style="border-right: 1px solid black; width: 13%;vertical-align:top;"><b>Targeted Problem</b>
            </td>

            <td style="border-right: 1px solid black;width: 35%;vertical-align:top;"><i>Routine Interventions:</i>
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
  echo "checked='checked'";}else{
      echo '';
  }?>>Coordination with treating pyschiatrist in the community
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck2"
        <?php if($check_res['sycheck2'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Coordination with PCP/house doctor/medical consultant
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck3"
        <?php if($check_res['sycheck3'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Coordination with family re:treatment needs and discharge plans
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck4"
        <?php if($check_res['sycheck4'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Consultation with community agencies re:treatment needs and discharge plans
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck5"
        <?php if($check_res['sycheck5'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Educate family/significant other about disease process/prognosis
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck6"
        <?php if($check_res['sycheck6'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Educate family/significant other about risks and benefits of medications
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck7"
        <?php if($check_res['sycheck7'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Educate about substances and effect on mental status
        </p>
        <p>
        <input type="checkbox" value="1" name="sycheck8"
        <?php if($check_res['sycheck8'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>Other (Specify):&ensp;<?php echo $check_res['syinp1']?>
        </p>
            </td>
            <td style="border-right: 1px solid black;width: 32%;vertical-align:top;"><b>Time Frame:(check one)</b>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check1" name="ch_check1" value="1"
<?php if($check_res['ch_check1'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check1" name="ch_check1" value="2"
<?php if($check_res['ch_check1'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check1" name="ch_check1" value="3"
<?php if($check_res['ch_check1'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check1" name="ch_check1" value="4"
<?php if($check_res['ch_check1'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check2" name="ch_check2" value="1"
<?php if($check_res['ch_check2'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check2" name="ch_check2" value="2"
<?php if($check_res['ch_check2'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check2" name="ch_check2" value="3"
<?php if($check_res['ch_check2'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check2" name="ch_check2" value="4"
<?php if($check_res['ch_check2'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check3" name="ch_check3" value="1"
<?php if($check_res['ch_check3'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check3" name="ch_check3" value="2"
<?php if($check_res['ch_check3'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check3" name="ch_check3" value="3"
<?php if($check_res['ch_check3'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check3" name="ch_check3" value="4"
<?php if($check_res['ch_check3'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check4" name="ch_check4" value="1"
<?php if($check_res['ch_check4'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check4" name="ch_check4" value="2"
<?php if($check_res['ch_check4'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check4" name="ch_check4" value="3"
<?php if($check_res['ch_check4'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check4" name="ch_check4" value="4"
<?php if($check_res['ch_check4'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check5" name="ch_check5" value="1"
<?php if($check_res['ch_check5'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check5" name="ch_check5" value="2"
<?php if($check_res['ch_check5'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check5" name="ch_check5" value="3"
<?php if($check_res['ch_check5'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check5" name="ch_check5" value="4"
<?php if($check_res['ch_check5'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check6" name="ch_check6" value="1"
<?php if($check_res['ch_check6'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check6" name="ch_check6" value="2"
<?php if($check_res['ch_check6'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check6" name="ch_check6" value="3"
<?php if($check_res['ch_check6'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check6" name="ch_check6" value="4"
<?php if($check_res['ch_check6'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check7" name="ch_check7" value="1"
<?php if($check_res['ch_check7'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check7" name="ch_check7" value="2"
<?php if($check_res['ch_check7'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check7" name="ch_check7" value="3"
<?php if($check_res['ch_check7'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check7" name="ch_check7" value="4"
<?php if($check_res['ch_check7'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check8" name="ch_check8" value="1"
<?php if($check_res['ch_check8'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check8" name="ch_check8" value="2"
<?php if($check_res['ch_check8'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check8" name="ch_check8" value="3"
<?php if($check_res['ch_check8'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check8" name="ch_check8" value="4"
<?php if($check_res['ch_check8'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check9" name="ch_check9" value="1"
<?php if($check_res['ch_check9'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check9" name="ch_check9" value="2"
<?php if($check_res['ch_check9'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check9" name="ch_check9" value="3"
<?php if($check_res['ch_check9'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check9" name="ch_check9" value="4"
<?php if($check_res['ch_check9'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check10" name="ch_check10" value="1"
<?php if($check_res['ch_check10'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check10" name="ch_check10" value="2"
<?php if($check_res['ch_check10'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check10" name="ch_check10" value="3"
<?php if($check_res['ch_check10'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check10" name="ch_check10" value="4"
<?php if($check_res['ch_check10'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
<p>
<input type="checkbox" class="radio_change thiacheck ch_check11" name="ch_check11" value="1"
<?php if($check_res['ch_check11'] == "1"){
  echo "checked='checked'";}else{
      echo '';
  }?>>24hrs
<input type="checkbox" class="radio_change thiacheck ch_check11" name="ch_check11" value="2"
<?php if($check_res['ch_check11'] == "2"){
  echo "checked='checked'";}else{
      echo '';
  }?>>10days
<input type="checkbox" class="radio_change thiacheck ch_check11" name="ch_check11" value="3"
<?php if($check_res['ch_check11'] == "3"){
  echo "checked='checked'";}else{
      echo '';
  }?>>15days
<input type="checkbox" class="radio_change thiacheck ch_check11" name="ch_check11" value="4"
<?php if($check_res['ch_check11'] == "4"){
  echo "checked='checked'";}else{
      echo '';
  }?>>30days
</p>
            </td>
            <td style="width: 15%;vertical-align:top;"><b>Teaching Strategies:</b>
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
            <?php
                if($check_res['sypsign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sypsign'].'>';
                }
                ?>
                <img src='<?php echo $check_res['sypsign'];?>' class="img" id="img_sypsign" style="display:none;width:50%;height:100px;" >
            </td>
             <td>Date:&ensp;<u><?php echo $check_res['sydate1'];?></u></td>
              <td>Time:&ensp;<u><?php echo $check_res['sytime1'];?></u></td>
          </tr>
        <tr>
    <td>
        &nbsp;

    </td>
</tr>
        </table><br>

<!-- Master Treatment Plan Medication Update -->
<hr>
<table style="width: 100%;border:1px solid #000;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['name6']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['ptdate6']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table><br>
<h4 style="text-align:center;">Partial Care Master Treatment Plan Medication Update <br>
<u>Nursing</u></h4>
<table  style="border:1px solid #000;vertical-align:top;width:100%" class="table table-bordered">
    <tr>
        <td style="width:15%;border-right:1px solid #000;">
          <b>Target Problem:</b><br>
          <p>Physical Withdrawals</p>
          <p>Mental instability</p>

        </td>

        <td style="width:35%;border-right:1px solid #000;">
    <b>Medications Interventions</b><br>
    Prescription order/Medication order:&ensp;<?php echo text($check_res['comment1']);?><br>
    Prescription order/Medication order:&ensp;<?php echo text($check_res['comment2']);?><br>
    Prescription order/Medication order:&ensp;<?php echo text($check_res['comment3']);?><br>
    Prescription order/Medication order:&ensp;<?php echo text($check_res['comment4']);?>
</td>
        <td style="width:32%;border-right:1px solid #000;">
        <b>Start Date:</b><br><br><br>
        <b>Date :</b>&ensp;<?php echo text($check_res['date_1']);?><br><br><br>
      <b>Date :</b>&ensp;<?php echo text($check_res['date_2']);?><br><br><br>
        <b>Date :</b>&ensp;<?php echo text($check_res['date_3']);?><br><br><br>
        <b>Date :</b>&ensp;<?php echo text($check_res['date_4']);?>
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
    <?php
                if($check_res['sign1']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign1'].'>';
                }
                ?>
         <img src='<?php echo text($check_res['sign1']);?>' class="img" id="img_sign1" style="display:none;width:25%;height:100px;" >
    
    <b style="margin-left:50px;">Date:</b>&ensp;<u><?php echo text($check_res['date5']);?></u>
    <b style="margin-left:50px;">Time :</b>&ensp;<u><?php echo text($check_res['time1']);?></u>

</td></tr></table><br><br>
<table><tr><td>
    <b>Patient signature:</b>
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <?php
                if($check_res['sign2']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign2'].'>';
                }
                ?>
    
    <b style="margin-left:50px;">Date:</b>&ensp;<?php echo text($check_res['date6']);?>
    <b style="margin-left:50px;">Time :</b>&ensp;<?php echo text($check_res['time2']);?>
</td></tr></table><br><br> 

                <!-- Master Treatment Plan
                Psychiatrist -->
                <hr>
<table style="width: 100%;border:1px solid #000;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['name7']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['ptdate7']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table><br>   
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
                                    <label><input type=checkbox name='dis_check1' style="margin-left:50px;" value="0"<?php if ($check_res["dis_check1"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> Home</label>
                                    <label><input type=checkbox name='dis_check2' style="margin-left:20px;" value="0"<?php if ($check_res["dis_check2"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> In Patient</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='dis_check3' value="0"<?php if ($check_res["dis_check3"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> Sober Living</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='dis_check4' value="0"<?php if ($check_res["dis_check4"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> PHP</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='dis_check5' value="0"<?php if ($check_res["dis_check5"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> Long term</label>
                                    <label><input type=checkbox style="margin-left:20px;" name='dis_check6' value="0"<?php if ($check_res["dis_check6"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> IOP Facility and Appointment time</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:10px;"><input type=checkbox name='dis_check7' style="margin-left:50px;" value="0"<?php if ($check_res["dis_check7"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> Rehab</label>
                                    <label><input type=checkbox name='dis_check8' style="margin-left:20px;" value="0"<?php if ($check_res["dis_check8"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> Other (specify) :</label>
                                    <label><?php echo text($check_res['othtext1']);?>
                                    <?php echo text($check_res['othtext2']);?></label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:10px;"><input type=checkbox name='dis_check9' style="margin-left:50px;" value="0"<?php if ($check_res["dis_check9"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> Follow-up with PCP</label>
                                    <label><input type=checkbox name='dis_check10' style="margin-left:20px;" value="0"<?php if ($check_res["dis_check10"] == "0") {
                                    echo "checked='checked'";}else{
      echo '';};?>> If no PCP, patient referred to a PCP (Doctor Name, phone number, date and time of the appoinment)</label>
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
                                    <?php
                if($check_res['ptsign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['ptsign'].'>';
                }
                ?>
                                    <img src='<?php echo text($check_res['ptsign']);?>' class="img" id="img_ptsign" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:50%;">
                                    <label>Date:</label>&ensp;<u><?php echo text($check_res['ptdate']);?></u>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label>Staff Signature & Credentials:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <?php
                if($check_res['stsign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['stsign'].'>';
                }
                ?>
                                    <img src='<?php echo text($check_res['stsign']);?>' class="img" id="img_stsign" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:50%;">
                                    <label>Date:</label>&ensp;<u><?php echo text($check_res['stdate']);?></u>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label>Staff Signature & Credentials:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <?php
                if($check_res['credsign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['credsign'].'>';
                }
                ?>
                                    <img src='<?php echo text($check_res['credsign']);?>' class="img" id="img_credsign" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:50%;">
                                    <label>Date:</label>&ensp;<u><?php echo text($check_res['creddate']);?></u>
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
                                    <?php
                if($check_res['psysign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['psysign'].'>';
                }
                ?>
                                    <img src='<?php echo text($check_res['psysign']);?>' class="img" id="img_psysign" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:50%;">
                                    <label>Date:</label>&ensp;<u><?php echo text($check_res['psydate']);?></u>
                                </td>
                            </tr>
                        </table>


        </div>
      </div>
</div>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Master Treatment Plan Form");
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($body);
$mpdf->defaultfooterline = 0;
//         //save the file put which location you need folder/filname
// $checkid = sqlQuery("SELECT formid FROM pdf_directory WHERE formid=?", array($formid));
// if($checkid['formid'] != $formid){
//     $pdf_data = sqlInsert('INSERT INTO pdf_directory (path,pid,encounter,formid) VALUES (?,?,?,?)',array($filename,$_SESSION["pid"],$_SESSION["encounter"],$formid));
// }

$mpdf->Output("Master Treatment Plan.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>
