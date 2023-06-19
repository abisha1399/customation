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
$pid = $_SESSION["pid"];
$encounter = $_GET["encounter"];


$check_res =array();

    $sql = "SELECT * FROM `form_master_treatment_plan` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

    use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<style>
</style>
<body id='body' class='body'>
<?php
$header ="<div class='row'style='line-height:1px;' >

</div>";

ob_start();

        ?>
        <table style="width: 100%;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo xlt($check_res['name1']); ?></b>
        <br><br>DOB:<b><?php echo $check_res['ptdate1']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table>
        <table style="width:100%;text-align:center;">
    <tr>
    <td > 
    <h2 style="">Master Treatement Plan</h2>

</td>
 

   
    </tr>
</table>
    <table style="width:100%;border:1px solid black;border-collapse:collapse;">

    <tr>

    <td style="width:20%;border:1px solid black;">
        <b>Diagnosis</b><br>
        <p>Substance Abuse/dependence[include withdraw risk]Ex Heroin,Opiates,Alcohol,Benzo</p>
        </td>

        <td style="width:20%;border:1px solid black;">
        <b>Target Date</b><br>
        <input type="checkbox" name="checkbox1" value="" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;5days<br>
        <input type="checkbox" name="checkbox2" value="" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br>
        <input type="checkbox" name="checkbox3" value="" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;15days<br>
        <input type="checkbox" name="checkbox4" value="" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;30days<br>
        <input type="checkbox" name="checkbox5" value="" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Others
</td>
<td style="width:20%;border:1px solid black;">
    <b>Discharge Criteria</b><br>
    <ul>
        <li>Recognize consequences of continuing substance use</li>
        <li>Receptive to continuing treatment for addition[s]</li>
        <li>Mild or free from withdraw signs and symptoms</li><br>
        <li>Other:[specify]<span > <?php echo text($check_res['other']); ?></span></li>

    </ul>
</td>
<td style="width:20%;border:1px solid black;">
<b >Target Date:</b><span > <?php echo text($check_res['tdate']); ?></span><br><br><br>

<b>New Target Date:</b>(state reason why?Relapse,non-compilance,<b>medical necessity</b>,etc.)
<span > <?php echo text($check_res['comment1']); ?></span></li></td>


    </tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<!--  -->
<table style="width: 100%;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo xlt($check_res['nupname']); ?></b>
        <br><br>DOB:<b><?php echo $check_res['nuDOB']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table>
<table style="width:100%;text-align:center;">
    <tr>
    <td > 
    <h4 style="">Master Treatement Plan</h4><br/>Nursing

</td>
 

   
    </tr>
</table>
<table style="border:1px solid black;width:100%;border-collapse:collapse;">
          <tr>  
            <td style="border:1px solid black;">
            <b>Target Problem:</b>
            <p>Substance Abuse</p>
            
        </td>
        <td style="border:1px solid black;">
    
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
                <li>Other : <?php echo text($check_res['nuinput1']);?> </li>
            </ul>

            <b>Individualized Interventions(Check all that apply)</b> <br> <br>
            <input type="checkbox" name="checkbox01" value="1" <?php if ($check_res['checkbox01'] == "1") {
  echo "checked='checked'";
  }?>>Monitor discomfort,provide medication as <br> ordered,and support patient in developing <br> coping strategies. <br>
            <input type="checkbox" name="checkbox02" value="1" <?php if ($check_res['checkbox02'] == "1") {
  echo "checked='checked'";
  }?>>Nursing/Therapy group 7x per week based <br> on tolerance per group interaction. <br>
            <input type="checkbox" name="checkbox03" value="1" <?php if ($check_res['checkbox03'] == "1") {
  echo "checked='checked'";
  }?>>Educate patient and family about disease <br> process/prognosis. <br>
            <input type="checkbox" name="checkbox06" value="1" <?php if ($check_res['checkbox06'] == "1") {
  echo "checked='checked'";
  }?>>Educate patient about fall reduction techniques. <br>
            
            <input type="checkbox" name="checkbox04" value="1" <?php if ($check_res['checkbox04'] == "1") {
  echo "checked='checked'";
  }?>>Educate patient and family about physical <br> effect of substance abuse. <br>
            <input type="checkbox" name="checkbox05" value="1" <?php if ($check_res['checkbox05'] == "1") {
  echo "checked='checked'";
  }?>>Other :<?php echo text($check_res['nuinput2']);?> 
        </td>
        <td style="border:1px solid black;" > 
            <b>Time Frame (check one)</b> <br>
            <input type="checkbox" name="nucheckbox1" value="1" <?php if ($check_res['nucheckbox1'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox2" value="1" <?php if ($check_res['nucheckbox2'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox3" value="1" <?php if ($check_res['nucheckbox3'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox4" value="1" <?php if ($check_res['nucheckbox4'] == "1") {
  echo "checked='checked'";
  }?>>30days <br>
            <input type="checkbox" name="nucheckbox5" value="1" <?php if ($check_res['nucheckbox5'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox6" value="1" <?php if ($check_res['nucheckbox6'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox7" value="1" <?php if ($check_res['nucheckbox7'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox8" value="1" <?php if ($check_res['nucheckbox8'] == "1") {
  echo "checked='checked'";
  }?>>30days <br> 
            <input type="checkbox" name="nucheckbox9" value="1" <?php if ($check_res['nucheckbox9'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox10" value="1" <?php if ($check_res['nucheckbox10'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox11" value="1" <?php if ($check_res['nucheckbox11'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox12" value="1" <?php if ($check_res['nucheckbox12'] == "1") {
  echo "checked='checked'";
  }?>>30days  <br> <br>
            <input type="checkbox" name="nucheckbox13" value="1" <?php if ($check_res['nucheckbox13'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox14" value="1" <?php if ($check_res['nucheckbox14'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox15" value="1" <?php if ($check_res['nucheckbox15'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox16 " value="1" <?php if ($check_res['nucheckbox16'] == "1") {
  echo "checked='checked'";
  }?>>30days  <br>
            <input type="checkbox" name="nucheckbox17" value="1" <?php if ($check_res['nucheckbox17'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox18" value="1" <?php if ($check_res['nucheckbox18'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox19" value="1" <?php if ($check_res['nucheckbox19'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox20" value="1" <?php if ($check_res['nucheckbox20'] == "1") {
  echo "checked='checked'";
  }?>>30days  <br> <br>    
            <input type="checkbox" name="nucheckbox21" value="1" <?php if ($check_res['nucheckbox21'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox22" value="1" <?php if ($check_res['nucheckbox22'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox23" value="1" <?php if ($check_res['nucheckbox23'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox24" value="1" <?php if ($check_res['nucheckbox24'] == "1") {
  echo "checked='checked'";
  }?>>30days  <br>
            <input type="checkbox" name="nucheckbox25" value="1" <?php if ($check_res['nucheckbox25'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox26" value="1" <?php if ($check_res['nucheckbox26'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox27" value="1" <?php if ($check_res['nucheckbox27'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox28" value="1" <?php if ($check_res['nucheckbox28'] == "1") {
  echo "checked='checked'";
  }?>>30days <br> <br> <br> <br>
            <input type="checkbox" name="nucheckbox29" value="1" <?php if ($check_res['nucheckbox29'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox30" value="1" <?php if ($check_res['nucheckbox30'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox31" value="1" <?php if ($check_res['nucheckbox31'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox32" value="1" <?php if ($check_res['nucheckbox32'] == "1") {
  echo "checked='checked'";
  }?>>30days  <br> <br> <br>
            <input type="checkbox" name="nucheckbox33" value="1" <?php if ($check_res['nucheckbox33'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox34" value="1" <?php if ($check_res['nucheckbox34'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox35" value="1" <?php if ($check_res['nucheckbox35'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox36" value="1" <?php if ($check_res['nucheckbox36'] == "1") {
  echo "checked='checked'";
  }?>>30days  <br> <br>  
            <input type="checkbox" name="nucheckbox37" value="1" <?php if ($check_res['nucheckbox37'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox38" value="1" <?php if ($check_res['nucheckbox38'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox39" value="1" <?php if ($check_res['nucheckbox39'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox40" value="1" <?php if ($check_res['nucheckbox40'] == "1") {
  echo "checked='checked'";
  }?>>30days  <br> <br>
            <input type="checkbox" name="nucheckbox41" value="1" <?php if ($check_res['nucheckbox41'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox42" value="1" <?php if ($check_res['nucheckbox42'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox43" value="1" <?php if ($check_res['nucheckbox43'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox44" value="1" <?php if ($check_res['nucheckbox44'] == "1") {
  echo "checked='checked'";
  }?>>30days <br> <br>
            <input type="checkbox" name="nucheckbox45" value="1" <?php if ($check_res['nucheckbox45'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox46" value="1" <?php if ($check_res['nucheckbox46'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox47" value="1" <?php if ($check_res['nucheckbox47'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox48" value="1" <?php if ($check_res['nucheckbox48'] == "1") {
  echo "checked='checked'";
  }?>>30days <br>
            <input type="checkbox" name="nucheckbox49" value="1" <?php if ($check_res['nucheckbox49'] == "1") {
  echo "checked='checked'";
  }?>>24hrs  <input type="checkbox" name="nucheckbox50" value="1" <?php if ($check_res['nucheckbox50'] == "1") {
  echo "checked='checked'";
  }?>>10days  <input type="checkbox" name="nucheckbox51" value="1" <?php if ($check_res['nucheckbox51'] == "1") {
  echo "checked='checked'";
  }?>>15days  <input type="checkbox" name="nucheckbox52" value="1" <?php if ($check_res['nucheckbox52'] == "1") {
  echo "checked='checked'";
  }?>>30days <br>

        </td>
        <td style="border:1px solid black;">
            <b>Teaching Strategies</b>
            <ol>
                <li>Groups</li>
                <li>Written material</li>
                <li>Videos</li>
                <li>Demonstration</li>
                <li>Verbal discussion</li>
                <li>One-on-one</li>
                <li>Other:  <?php echo text($check_res['nuother']);?> </li>
            </ol>
        </td>
  </tr>
    </table>

    <table><tr><td>
        <b>Nurse signature:</b> 
        <?php
                if($check_res['nusign1']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['nusign1'].'>';
                }
                ?>
        
         </td><td>
        <b>Date:</b>  <?php echo text($check_res['nudate1']);?>  <b>Time:</b> <?php echo text($check_res['nutime1']);?>  </td></tr>
        <tr><td><b>Patient signature:</b>     <?php
                if($check_res['nusign2']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['nusign2'].'>';
                }
                ?> </td><td>
          <b>Date:</b>  <?php echo text($check_res['nudate2']);?>  <b>Time:</b>  <?php echo text($check_res['nutime2']);?> </td></tr> </table>
  <!--  -->
<br/><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/><br><br/><br/>
<table style="width: 100%;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['txt1']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['txt2']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table><br>
<br><br/><br/>
<table style="width:100%;">
          <tr>
            <th style="width:100%;"><h3 class="h3_1">Detox Master Treatment Plan: Nursing</h3></th>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black;border-collapse:collapse;" class="tabel5">
          <tr>
            <td style="border: 1px solid black; width: 25%;"><b>Target Problem:</b>
              <p>Phsical Withdrawls Mental instability</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

            </td>

            <td style="border: 1px solid black;width: 25%;"><b>Interventions:</b>
            <p><input type="checkbox" name="check1a" value="1"
<?php if($check_res['check1a'] == "1"){
  echo "checked='checked'";
  }?>
>Suboxone 8 day protocol</p>
<p><input type="checkbox" name="check2a" value="1"
<?php if($check_res['check2a'] == "1"){
  echo "checked='checked'";
  }?>>Suboxone 5 day protocol</p>
<p><input type="checkbox" name="check3a" value="1"
<?php if($check_res['check3a'] == "1"){
  echo "checked='checked'";
  }?>>Suboxone 4 day protocol</p>
<p><input type="checkbox" name="check4a" value="1"
<?php if($check_res['check4a'] == "1"){
  echo "checked='checked'";
  }?>>Suboxone custom protocol</p>
<p><input type="checkbox" name="check5a" value="1"
<?php if($check_res['check5a'] == "1"){
  echo "checked='checked'";
  }?>>Suboxone induction</p>
<p><input type="checkbox" name="check6a" value="1"
<?php if($check_res['check6a'] == "1"){
  echo "checked='checked'";
  }?>>Ativan b protocol</p>
<p><input type="checkbox" name="check7a" value="1"
<?php if($check_res['check7a'] == "1"){
  echo "checked='checked'";
  }?>>Ativan c protocol</p>
<p><input type="checkbox" name="check8a" value="1"
<?php if($check_res['check8a'] == "1"){
  echo "checked='checked'";
  }?>>Ativan custom protocol</p>
<p><input type="checkbox" name="check9a" value="1"
<?php if($check_res['check9a'] == "1"){
  echo "checked='checked'";
  }?>>Libirium b protocol</p>
<p><input type="checkbox" name="check10a" value="1"
<?php if($check_res['check10a'] == "1"){
  echo "checked='checked'";
  }?>>Libirium c protocol</p>
<p><input type="checkbox" name="check11a" value="1"
<?php if($check_res['check11a'] == "1"){
  echo "checked='checked'";
  }?>>Libirium custom protocol</p>
<p><input type="checkbox" name="check12a" value="1"
<?php if($check_res['check12a'] == "1"){
  echo "checked='checked'";
  }?>>Valium custom protocol</p>
<p><input type="checkbox" name="check13a" value="1"
<?php if($check_res['check13a'] == "1"){
  echo "checked='checked'";
  }?>>Neurotin induction</p>
<p><input type="checkbox" name="check14a" value="1"
<?php if($check_res['check14a'] == "1"){
  echo "checked='checked'";
  }?>>Thiamin and Folate supplement</p>
<p><input type="checkbox" name="check15a" value="1"
<?php if($check_res['check15a'] == "1"){
  echo "checked='checked'";
  }?>>Keppra Custom order</p>
<p><input type="checkbox" name="check16a" value="1"
<?php if($check_res['check16a'] == "1"){
  echo "checked='checked'";
  }?>>Keppra 500mg po BID</p>
<p><input type="checkbox" name="check17a" value="1"
<?php if($check_res['check17a'] == "1"){
  echo "checked='checked'";
  }?>>All prn medication order by M.D if no contraindications</p>
<p><input type="checkbox" name="check18a" value="1"
<?php if($check_res['check18a'] == "1"){
  echo "checked='checked'";
  }?>>Clonidine b protocol</p>
<p><input type="checkbox" name="check19a" value="1"
<?php if($check_res['check19a'] == "1"){
  echo "checked='checked'";
  }?>>Clonidine custom protocol</p>
<p><input type="checkbox" name="check20a" value="1"
<?php if($check_res['check20a'] == "1"){
  echo "checked='checked'";
  }?>>Prescription medication management</p>

            </td>
            <td style="border: 1px solid black;width: 25%;"><b>Time Frame:</b>
<p>
<input type="checkbox" name="check21a" value="1"
<?php if($check_res['check21a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check22a" value="1"
<?php if($check_res['check22a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
<input type="checkbox" name="check23a" value="1"
<?php if($check_res['check23a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check24a" value="1"
  <?php if($check_res['check24a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check25a" value="1"
  <?php if($check_res['check25a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check26a" value="1"
  <?php if($check_res['check26a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check27a" value="1"
  <?php if($check_res['check27a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check28a" value="1"
  <?php if($check_res['check28a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check29a" value="1"
  <?php if($check_res['check29a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check30a" value="1"
  <?php if($check_res['check30a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check31a" value="1"
  <?php if($check_res['check31a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check32a" value="1"
  <?php if($check_res['check32a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check33a" value="1"
  <?php if($check_res['check33a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check34a" value="1"
  <?php if($check_res['check34a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check35a" value="1"
  <?php if($check_res['check35a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check36a" value="1"
  <?php if($check_res['check36a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check37a" value="1"
  <?php if($check_res['check37a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check38a" value="1"
  <?php if($check_res['check38a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check39a" value="1"
  <?php if($check_res['check39a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check40a" value="1"
  <?php if($check_res['check40a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check41a" value="1"
  <?php if($check_res['check41a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p><input type="checkbox" name="check42a" value="1"
<?php if($check_res['check42a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check43a" value="1"
<?php if($check_res['check43a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
<input type="checkbox" name="check44a" value="1"
<?php if($check_res['check44a'] == "1"){
  echo "checked='checked'";
  }?>>5days</p>

<p>
  <input type="checkbox" name="check45a" value="1"
  <?php if($check_res['check45a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check46a" value="1"
  <?php if($check_res['check46a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check47a" value="1"
  <?php if($check_res['check47a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check48a" value="1"
  <?php if($check_res['check48a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check49a" value="1"
  <?php if($check_res['check49a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check50a" value="1"
  <?php if($check_res['check50a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check51a" value="1"
  <?php if($check_res['check51a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check52a" value="1"
  <?php if($check_res['check52a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check53a" value="1"
  <?php if($check_res['check53a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check54a" value="1"
  <?php if($check_res['check54a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check55a" value="1"
  <?php if($check_res['check55a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check56a" value="1"
  <?php if($check_res['check56a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check57a" value="1"
  <?php if($check_res['check57a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check58a" value="1"
  <?php if($check_res['check58a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check59a" value="1"
  <?php if($check_res['check59a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check60a" value="1"
  <?php if($check_res['check60a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check61a" value="1"
  <?php if($check_res['check61a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check62a" value="1"
  <?php if($check_res['check62a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check63a" value="1"
  <?php if($check_res['check63a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check64a" value="1"
  <?php if($check_res['check64a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check65a" value="1"
  <?php if($check_res['check65a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check66a" value="1"
  <?php if($check_res['check66a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check67a" value="1"
  <?php if($check_res['check67a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check68a" value="1"
  <?php if($check_res['check68a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check69a" value="1"
  <?php if($check_res['check69a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check70a" value="1"
  <?php if($check_res['check70a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check71a" value="1"
  <?php if($check_res['check71a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check72a" value="1"
  <?php if($check_res['check72a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check73a" value="1"
  <?php if($check_res['check73a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check74a" value="1"
  <?php if($check_res['check74a'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check75a" value="1"
  <?php if($check_res['check75a'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check76a" value="1"
  <?php if($check_res['check76a'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check77a" value="1"
  <?php if($check_res['check77a'] == "1"){
  echo "checked='checked'";
  }?>>5days
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
          </tr>
        </table><br><br>
        <table>
          <tr>
            <td><b>Nurse Signature:</b>
            <?php
                if($check_res['nsign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['nsign'].'>';
                }
                ?>
             </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>Date:<b><?php echo $check_res['dedate1'];?></b></td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>Time:<b><?php echo $check_res['detime1'];?></b></td>
          </tr>
        <tr>
    <td>
        &nbsp;
        
    </td>
</tr>
          <tr>
          <td><b>Patient Signature:</b> 
          <?php
                if($check_res['psign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['psign'].'>';
                }
                ?>
           </td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>Date:<b><?php echo $check_res['dedate2'];?></b></td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>Time:<b><?php echo $check_res['detime2'];?></b></td>
          </tr>
        </table><br><br>  <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> 

        <!-- Master Treatment Plan Nursery Content-->

        
        <table style="width:100%; ">
    <tr>
    <td > 
            <label style="font-size: 14px;">Patient Name:<span> <?php echo text($check_res['ptname1']); ?></span></label>

</td> <td></td><td></td></tr> <tr>
<td  style="width:30%"> 
            <label style="font-size: 14px;">DOB:<span > <?php echo text($check_res['ptdate1a']); ?></span></label>

</td>
<td></td><td><p>Center for Network Therapy</p></td></tr>
   
    </tr>
</table><br/><br/>
<h4 style="text-align:center;">Master Treatement Plan</h4><br><br>

<table style="width:100%;border-collapse:collapse;">

    <tr>

    <td style=" border:1px solid black;">
        <b style="text-align:center;">Target
Problem:</b><br>
        <p>Medical</p>
        </td>
        <td style=" border:1px solid black;">
    <b>Client’s Current Medical Conditions: (list)</b><br>
    <ul>
        <li>    <label style="font-size:14px;"></label>
   <b> <?php echo text($check_res['input1']);?><br>
    <li>    <label style="font-size:14px;"></label>
   <b> <?php echo text($check_res['input2']);?><br>
    <li>    <label style="font-size:14px;"></label>
   <b> <?php echo text($check_res['input3']);?><br>
    <li>    <label style="font-size:14px;"></label>
   <b> <?php echo text($check_res['input4']);?><br>
    <li>    <label style="font-size:14px;"></label>
   <b> <?php echo text($check_res['input5']);?><br>
    <li>    <label style="font-size:14px;"></label>
   <b> <?php echo text($check_res['input6']);?><br>

    </ul>
</td>
<td style=" border:1px solid black;">
        <b>Interventions:</b><br>
        <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1a'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; Clients will follow up with PCP for all medical issues.<br>
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2a'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;MD will be notified of current medical conditions<br>
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3a'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;RD and MD will be notified if client has to take their own medication during treatment stay<br>
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4a'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Client will administer own medication<br>
      
</td>
<td style="border:1px solid black;">
        <b>Time Frame(Check One):</b><br>
        <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox5a'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 24 hrs
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 10 days
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox7'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 15 days
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox8'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 30 days<br>
    
      <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox9'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 24 hrs
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox10'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 10 days
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox11'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 15 days
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox12'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 30 days<br>
      <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox13'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 24 hrs
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox14'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 10 days
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox15'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 15 days
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox16'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 30 days<br>

<input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox17'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 24 hrs
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox18'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 10 days
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox19'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 15 days
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox20'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; 30 days<br>
      
</td>
</tr></table>

 
    <br><br><br>


<label style="font-size:14px;">Nurse Signature:</label>
    <?php if($check_res['sign']!='')
                                    {
                                    echo '<img src="'.$check_res['sign'].'" style="width:20%;height:90px;">';
                                    }
                                     ?><br><br>
    <label style="font-size:14px;">Date :</label>
    <b><?php echo text($check_res['date2a']);?></b><br><br>
    <label style="font-size:14px;">Time :</label>
    <b><?php echo text($check_res['time']);?><br><br/><br/> <br><br/><br/> <br><br/><br/> <br><br/><br/> <br><br/><br/> <br><br/><br/> <br><br/><br/> <br><br/><br/> <br><br/><br/> 


<!--  -->
<table style="width: 100%;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['ptxt1']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['ptxt2']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table><br>
<br>
<table style="width:100%;">
          <tr>
            <th style="width:100%;"><h3 class="h3_1">Master Treatment Plan<br/>
<u>Psychiatrist</u></h3></th>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black;border-collapse:collapse;" class="tabel5">
          <tr>
            <td style="border: 1px solid black; width: 20%;"><b>Target Problem:</b>
              <p>Targeted Problem</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
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

            <td style="border: 1px solid black;width: 28%;"><b>Routine Interventions:</b>
            <ul>
                <li>Daily assessment of mental/physical status</li>
                <li>Daily assessment of response to medication</li>
                <li>Oversight of interdisciplinary treatment and discharge planning</li>
        </ul>
        <p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>



        <p>
            <i>Individualized Interventions: (check all that apply)</i>
        </p>

        <p>
        <input type="checkbox" value="1" name="check1"
        <?php if($check_res['sycheck1'] == "1"){
  echo "checked='checked'";
  }?>>Coordination with treating pyschiatrist in the community
        </p>

        <p>
        <input type="checkbox" value="1" name="check2"
        <?php if($check_res['sycheck2'] == "1"){
  echo "checked='checked'";
  }?>>Coordination with PCP/house doctor/medical consultant
        </p>
        <p>
        <input type="checkbox" value="1" name="check3"
        <?php if($check_res['sycheck3'] == "1"){
  echo "checked='checked'";
  }?>>Coordination with family re:treatment needs and discharge plans
        </p>
        <p>
        <input type="checkbox" value="1" name="check4"
        <?php if($check_res['sycheck4'] == "1"){
  echo "checked='checked'";
  }?>>Consultation with community agencies re:treatment needs and discharge plans
        </p>
        <p>
        <input type="checkbox" value="1" name="check5"
        <?php if($check_res['sycheck5'] == "1"){
  echo "checked='checked'";
  }?>>Educate family/significant other about disease process/prognosis
        </p>
        <p>
        <input type="checkbox" value="1" name="check6"
        <?php if($check_res['sycheck6'] == "1"){
  echo "checked='checked'";
  }?>>Educate family/significant other about risks and benefits of medications
        </p>
        <p>
        <input type="checkbox" value="1" name="check7"
        <?php if($check_res['sycheck7'] == "1"){
  echo "checked='checked'";
  }?>>Educate about substances and effect on mental status
        </p>
        <p>
        <input type="checkbox" value="1" name="check8"
        <?php if($check_res['sycheck8'] == "1"){
  echo "checked='checked'";
  }?>>
  Other (Specify):<b><?php echo $check_res['inp1']?></b>
        </p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

            </td>
            <td style="border: 1px solid black;width: 35%;"><b>Time Frame:</b>

            <p>
<input type="checkbox" name="check9" value="1"
<?php if($check_res['sycheck9'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check10" value="1"
<?php if($check_res['sycheck10'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check11" value="1"
<?php if($check_res['sycheck11'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check12" value="1"
<?php if($check_res['sycheck12'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check13" value="1"
<?php if($check_res['sycheck13'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check14" value="1"
<?php if($check_res['sycheck14'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check15" value="1"
<?php if($check_res['sycheck15'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check16" value="1"
<?php if($check_res['sycheck16'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check17" value="1"
<?php if($check_res['sycheck17'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check18" value="1"
<?php if($check_res['sycheck18'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check19" value="1"
<?php if($check_res['sycheck19'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check20" value="1"
<?php if($check_res['sycheck20'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check21" value="1"
<?php if($check_res['sycheck21'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check22" value="1"
<?php if($check_res['sycheck22'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check23" value="1"
<?php if($check_res['sycheck23'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check24" value="1"
<?php if($check_res['sycheck24'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check25" value="1"
<?php if($check_res['sycheck25'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check26" value="1"
<?php if($check_res['sycheck26'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check27" value="1"
<?php if($check_res['sycheck27'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check28" value="1"
<?php if($check_res['sycheck28'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check29" value="1"
<?php if($check_res['sycheck29'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check30" value="1"
<?php if($check_res['sycheck30'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check31" value="1"
<?php if($check_res['sycheck31'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check32" value="1"
<?php if($check_res['sycheck32'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check33" value="1"
<?php if($check_res['sycheck33'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check34" value="1"
<?php if($check_res['sycheck34'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check35" value="1"
<?php if($check_res['sycheck35'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check36" value="1"
<?php if($check_res['sycheck36'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check37" value="1"
<?php if($check_res['sycheck37'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check38" value="1"
<?php if($check_res['sycheck38'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check39" value="1"
<?php if($check_res['sycheck39'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check40" value="1"
<?php if($check_res['sycheck40'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check41" value="1"
<?php if($check_res['sycheck41'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check42" value="1"
<?php if($check_res['sycheck42'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check43" value="1"
<?php if($check_res['sycheck43'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check44" value="1"
<?php if($check_res['sycheck44'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check45" value="1"
<?php if($check_res['sycheck45'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check46" value="1"
<?php if($check_res['sycheck46'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check47" value="1"
<?php if($check_res['sycheck47'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check48" value="1"
<?php if($check_res['sycheck48'] == "1"){
  echo "checked='checked'";
  }?>>30days
</p>
<p>
<input type="checkbox" name="check49" value="1"
<?php if($check_res['sycheck49'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check50" value="1"
<?php if($check_res['sycheck50'] == "1"){
  echo "checked='checked'";
  }?>>10days
<input type="checkbox" name="check51" value="1"
<?php if($check_res['sycheck51'] == "1"){
  echo "checked='checked'";
  }?>>15days
<input type="checkbox" name="check52" value="1"
<?php if($check_res['sycheck52'] == "1"){
  echo "checked='checked'";
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
            <td style="border: 1px solid black;width: 17%;"><b>Teaching Strategies:</b>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p><b>1.Groups</b></p>
<p><b>2.Written Material</b></p>
<p><b>3.Videos</b></p>
<p><b>4.Demonsstration</b></p>
<p><b>5.Verbal discussion</b></p>
<p><b>6.one-on-one</b></p>
<p><b>7.other:</b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
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
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>


            </td>
          </tr>
        </table><br><br>
        <table>
          <tr>
            <td>Pyschiatrist Signature:<b>
            <?php
                if($check_res['sypsign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sypsign'].'>';
                }
                ?>
                <!-- <?php echo $check_res['psign'];?> -->
            </b></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>Date:<b><?php echo $check_res['sydate1'];?></b></td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>Time:<b><?php echo $check_res['sytime1'];?></b></td>
          </tr>
        <tr>
    <td>
        &nbsp;

    </td>
</tr>

        </table><br><br><br><br><br><br>

<!-- Master Treatment Plan Medication Update -->


<table style="width:100%; ">
    <tr>
    <td  style="width:30%"> 
            <label style="font-size: 14px;">Patient Name:<span> <?php echo text($check_res['name1a']); ?></span></label>

</td>
<td  style="width:30%"> 
            <label style="font-size: 14px;">DOB:<span > <?php echo text($check_res['date0']); ?></span></label>

</td>

   
    </tr>
</table><br><br/><br/>
<table style="width:100%;text-align:center;">
<tr><td>
<h4>
Master Treatment Plan Medication Update </h4></td>

   
</tr>
</table><br/><br/>
    <table style="width:100%;border-collapse:collapse;">

    <tr>

    <td style=" border:1px solid black;">
        <b style="text-align:center;">Target
Problem:</b><br>
        <p>Physical Withdrawals</p>
        <p>Mental instability</p>
        </td>
        <td style=" border:1px solid black;">
    <b>Medications Interventions</b><br>
    <ul>
        <li>    <label style="font-size:14px;">Prescription order/Medication order:</label>
   <b> <?php echo text($check_res['comment1a']);?></b><br>
    <li>    <label style="font-size:14px;">Prescription order/Medication order:</label>
   <b> <?php echo text($check_res['comment2']);?></b><br>
    <li>    <label style="font-size:14px;">Prescription order/Medication order:</label>
   <b> <?php echo text($check_res['comment3']);?></b><br>
    <li>    <label style="font-size:14px;">Prescription order/Medication order:</label>
   <b> <?php echo text($check_res['comment4']);?></b><br>

    </ul>
</td>
<td style=" border:1px solid black;">
<b>Medications Interventions</b><br>
<ul>
<li>    <label style="font-size:14px;">Date:</label>
<b> <?php echo text($check_res['date1a']);?></b><br>
<li>    <label style="font-size:14px;">Date:</label>
<b> <?php echo text($check_res['date2']);?></b><br>
<li>    <label style="font-size:14px;">Date:</label>
<b> <?php echo text($check_res['date3']);?></b><br>
<li>    <label style="font-size:14px;">Date:</label>
<b> <?php echo text($check_res['date4']);?></b><br>

</ul>
</td>
<td style=" border:1px solid black;">
        <b>Teaching Stratergies</b><br>
        <p>4. Written Material</p>
<p>5. Verbal Discussion</p>
<p>6. One on One</p>

      
</td>
</tr>
</table><br><br> 

<label style="font-size:14px;">Nurse Signature:</label>
<?php
                if($check_res['sign1']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign1'].'>';
                }
                ?> <br><br>
    <label style="font-size:14px;">Date :</label>
    <b><?php echo text($check_res['date5']);?></b><br><br>
    <label style="font-size:14px;">Time :</label>
    <b><?php echo text($check_res['time1']);?></b><br><br>

    <label style="font-size:14px;">Patient Signature:</label>
    <?php
                if($check_res['sign2']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign2'].'>';
                }
                ?> <br><br>
    <label style="font-size:14px;">Date :</label>
    <b><?php echo text($check_res['date6']);?></b><br><br>
    <label style="font-size:14px;">Time :</label>
    <b><?php echo text($check_res['time2']);?><br><br/><br/><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



<!--  -->
<table style="width:100%;">
            <tr>
                <td style="width:100%;text-align:center;">
                    <h3>The Center for Network Therapy</h3>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                    <label><b>Patient Name:</b> <?php echo xlt($check_res['patient']); ?></label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                    <label><b>D.O.B:</b> <?php echo xlt($check_res['date']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;text-align:center;">
                    <h3><b>Master Treatment Plan</b></h3>
                    <h4><b><u>Psychiatrist</u></b></h4>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;border:1px solid black;">
            <tr>
                <td style="width:100%;">
                    <label><b>Discharge Plan (check all that apply):<b></label>
                </td>
            </tr>
            <tr>
                <td style="width:100%;">
                    <label> <input type=checkbox name='check1' value="" <?php if ($check_res["check1"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> Home</label>
                  <label> <input type=checkbox name='check2' value="" <?php if ($check_res["check2"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> In Patient</label>
                  <label> <input type=checkbox name='check3' value="" <?php if ($check_res["check3"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> Sober Living</label>
                  <label> <input type=checkbox name='check4' value="" <?php if ($check_res["check4"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> PHP</label>
                  <label> <input type=checkbox name='check5' value="" <?php if ($check_res["check5"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> Long term</label>
                  <label> <input type=checkbox name='check6' value="" <?php if ($check_res["check6"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> IOP Facility and Appointment time</label>
                </td>
            </tr>
            <tr>
                <td style="width:100%;">
                    <label> <input type=checkbox name='check7' value="" <?php if ($check_res["check7"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> Rehab</label>
                  <label> <input type=checkbox name='check8' value="" <?php if ($check_res["check8"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> Other (specify):</label>
                  <label><?php echo xlt($check_res['othtext1']); ?></label>
                  <label><?php echo xlt($check_res['othtext2']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="width:100%;">
                    <label> <input type=checkbox name='check9' value="" <?php if ($check_res["check9"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> Follow-up with PCP</label>
                  <label> <input type=checkbox name='check10' value="" <?php if ($check_res["check10"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> If no PCP, patient referred to a PCP (Doctor Name, phone number, date and time of the appoinment):</label>
                  <label><?php echo xlt($check_res['othtext3']); ?></label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                    <label>I have reviewed treatment plan and have had an opportunity to contribute to its development.</label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                    <label><b>Patient Comments:</b> <?php echo xlt($check_res['ptcomments']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                    <label><b>If patient's review of treatment plan is contraindicated, specify reason:</b> <?php echo xlt($check_res['treatment']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:50%;">
                    <label><b>Patient Signature:</b>
                    <?php
                if($check_res['ptsign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['ptsign'].'>';
                }
                ?>
                    <!-- <?php echo xlt($check_res['ptsign']); ?> -->
                </label>
                </td>
                <td style="width:50%;">
                    <label><b>Date:</b> <?php echo xlt($check_res['ptdate']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:50%;">
                    <label><b>Staff Signature & Credentials:</b>
                    <?php
                    if($check_res['stsign']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$check_res['stsign'].'>';
                    }
                    ?>
                     <!-- <?php echo xlt($check_res['stsign']); ?> -->
                    </label>
                </td>
                <td style="width:50%;">
                    <label><b>Date:</b> <?php echo xlt($check_res['stdate']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:50%;">
                    <label><b>Staff Signature & Credentials:</b>

                    <?php
                    if($check_res['credsign']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$check_res['credsign'].'>';
                    }
                    ?>
                     <!-- <?php echo xlt($check_res['credsign']); ?> -->
                    </label>
                </td>
                <td style="width:50%;">
                    <label><b>Date:</b> <?php echo xlt($check_res['creddate']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                    <label>I certify that patient needs outpatient care for treatment of further therapy and or medication management.</label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:50%;">
                    <label><b>Psychiatrist Signature:</b>
                    <?php
                    if($check_res['psysign']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$check_res['psysign'].'>';
                    }
                    ?>
                    <!-- <?php echo xlt($check_res['psysign']); ?> -->
                </label>
                </td>
                <td style="width:50%;">
                    <label><b>Date:</b> <?php echo xlt($check_res['psydate']); ?></label>
                </td>
            </tr>
        </table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<table style=" width:100%">
<tr>
      <td >
         <b>Patient Name:</b>
         <p><?php echo text($check_res['pname']); ?></p>
      </td>
      <td  >
         
          
      </td>
      <td  >
         <b>Center For Network Therapy</b>
          
      </td>
                  </tr>
      <tr>
      <td  >
         <b>DOB:</b>
         <p><?php echo text($check_res['DOB']); ?></p>
      </td>
      <td  >
         
          
         </td>
         <td  >
            
             
         </td>
</tr>
</table>
<br/>
<table style=" width:100%">
<tr>
      <td >
          <p>Target Problem:</p>
      </td>
      <td >
      <p>Interventions:</p>
          
      </td>
      <td>
      <p>Time Frame:</p>
      </td>
      <td>
      <p>Teaching Strategy:</p>
      </td>
                  </tr>
                  </table>
<table style="border:1px solid black; width:100%;border-collapse:collapse;">
<tr> 
                <td style="border:1px solid black;">
                    1.Patient Relapse <br>Date of Relapse <br> <br>
                    pt signature :
                    <?php
                if($check_res['input1b']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['input1b'].'>';
                }
                ?>
                </td>

                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkboxA1" value="1" <?php if ($check_res['checkboxA1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Informed Support <br>
                    <input type="checkbox" name="checkboxA2" value="1" <?php if ($check_res['checkboxA2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkboxA3" value="1" <?php if ($check_res['checkboxA3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Family intervention <br>
                    <input type="checkbox" name="checkboxA4" value="1" <?php if ($check_res['checkboxA4'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Therapeutic support
                </td>
                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkbox1b" value="1" <?php if ($check_res['checkbox1b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox2b" value="1" <?php if ($check_res['checkbox2b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox3b" value="1" <?php if ($check_res['checkbox3b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox4b" value="1" <?php if ($check_res['checkbox4b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox5b" value="1" <?php if ($check_res['checkbox5b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox6b" value="1" <?php if ($check_res['checkbox6b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox7b" value="1" <?php if ($check_res['checkbox7b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox8b" value="1" <?php if ($check_res['checkbox8b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox9b" value="1" <?php if ($check_res['checkbox9b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox10b" value="1" <?php if ($check_res['checkbox10b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox11b" value="1" <?php if ($check_res['checkbox11b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox12b" value="1" <?php if ($check_res['checkbox12b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                </td>
                <td style="border:1px solid black;">
                <input type="checkbox" name="checkbox13b" value="1" <?php if ($check_res['checkbox13b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>1:1 <input type="checkbox" name="checkbox14b" value="1" <?php if ($check_res['checkbox14b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>written material <br> <input type="checkbox" name="checkbox15b" value="1" <?php if ($check_res['checkbox15b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>groups <input type="checkbox" name="checkbox16b" value="1" <?php if ($check_res['checkbox16b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>videos <br> <input type="checkbox" name="checkbox17b" value="1" <?php if ($check_res['checkbox17b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>verbal discussion <br><input type="checkbox" name="checkbox18b" value="1" <?php if ($check_res['checkbox18b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Demonstration
                </td>
            </tr>
            <tr>
                <td style="border:1px solid black;">
                    2.Patient Relapse <br>Date of Relapse <br> <br> pt signature :<?php
                if($check_res['input2b']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['input2b'].'>';
                }
                ?>
                </td>
                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkbox19b" value="1" <?php if ($check_res['checkbox19b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Informed Support <br>
                    <input type="checkbox" name="checkbox20b" value="1" <?php if ($check_res['checkbox20b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox21b" value="1" <?php if ($check_res['checkbox21b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Family intervention <br>
                    <input type="checkbox" name="checkbox22b" value="1" <?php if ($check_res['checkbox22b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Therapeutic support
                </td>
                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkbox23b" value="1" <?php if ($check_res['checkbox23b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox24b" value="1" <?php if ($check_res['checkbox24b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox25b" value="1" <?php if ($check_res['checkbox25b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox26b" value="1" <?php if ($check_res['checkbox26b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox27b" value="1" <?php if ($check_res['checkbox27b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox28b" value="1" <?php if ($check_res['checkbox28b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox29b" value="1" <?php if ($check_res['checkbox29b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox30b" value="1" <?php if ($check_res['checkbox30b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox31b" value="1" <?php if ($check_res['checkbox31b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox32b" value="1" <?php if ($check_res['checkbox30b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox33b" value="1" <?php if ($check_res['checkbox33b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox34b" value="1" <?php if ($check_res['checkbox34b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                </td>
                <td style="border:1px solid black;">
                <input type="checkbox" name="checkbox35b" value="1" <?php if ($check_res['checkbox35b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>1:1 <input type="checkbox" name="checkbox36b" value="1" <?php if ($check_res['checkbox36b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>written material <br> <input type="checkbox" name="checkbox37b" value="1" <?php if ($check_res['checkbox37b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>groups <input type="checkbox" name="checkbox38b" value="1" <?php if ($check_res['checkbox38b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>videos <br> <input type="checkbox" name="checkbox39b" value="1" <?php if ($check_res['checkbox39b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>verbal discussion <br><input type="checkbox" name="checkbox40b" value="1" <?php if ($check_res['checkbox40b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Demonstration
                </td>
            </tr>
            <tr>
                <td style="border:1px solid black;">
                    3.Patient Relapse <br>Date of Relapse <br> <br> pt signature :<?php
                if($check_res['input3b']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['input3b'].'>';
                }
                ?>
                </td>
                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkbox41b" value="1" <?php if ($check_res['checkbox41b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Informed Support <br>
                    <input type="checkbox" name="checkbox42b" value="1" <?php if ($check_res['checkbox42b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox43b" value="1" <?php if ($check_res['checkbox43b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Family intervention <br>
                    <input type="checkbox" name="checkbox44b" value="1" <?php if ($check_res['checkbox44b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Therapeutic support
                </td>
                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkbox45b" value="1" <?php if ($check_res['checkbox45b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox46b" value="1" <?php if ($check_res['checkbox46b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox47b" value="1" <?php if ($check_res['checkbox47b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox48b" value="1" <?php if ($check_res['checkbox48b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox49b" value="1" <?php if ($check_res['checkbox49b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox50b" value="1" <?php if ($check_res['checkbox50b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox51b" value="1" <?php if ($check_res['checkbox51b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox52b" value="1" <?php if ($check_res['checkbox52b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox53b" value="1" <?php if ($check_res['checkbox53b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox54b" value="1" <?php if ($check_res['checkbox54b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox55b" value="1" <?php if ($check_res['checkbox55b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox56b" value="1" <?php if ($check_res['checkbox56b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                </td>
                <td style="border:1px solid black;">
                <input type="checkbox" name="checkbox57b" value="1" <?php if ($check_res['checkbox57b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>1:1 <input type="checkbox" name="checkbox58b" value="1" <?php if ($check_res['checkbox58b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>written material <br> <input type="checkbox" name="checkbox59b" value="1" <?php if ($check_res['checkbox59b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>groups <input type="checkbox" name="checkbox60b" value="1" <?php if ($check_res['checkbox60b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>videos <br> <input type="checkbox" name="checkbox61b" value="1" <?php if ($check_res['checkbox61b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>verbal discussion <br><input type="checkbox" name="checkbox62b" value="1" <?php if ($check_res['checkbox62b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Demonstration
                </td>
            </tr>
            <tr>
                <td style="border:1px solid black;">
                    4.Patient Relapse <br>Date of Relapse <br> <br> pt signature:
                    <?php
                if($check_res['input4b']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['input4b'].'>';
                }
                ?>
                     
                </td>
                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkbox61b" value="1" <?php if ($check_res['checkbox61b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Informed Support <br>
                    <input type="checkbox" name="checkbox62b" value="1" <?php if ($check_res['checkbox62b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox63b" value="1" <?php if ($check_res['checkbox63b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Family intervention <br>
                    <input type="checkbox" name="checkbox64b" value="1" <?php if ($check_res['checkbox64b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Therapeutic support
                </td>
                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkbox65b" value="1" <?php if ($check_res['checkbox65b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox66b" value="1" <?php if ($check_res['checkbox66b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox67b" value="1" <?php if ($check_res['checkbox67b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox68b" value="1" <?php if ($check_res['checkbox68b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox69b" value="1" <?php if ($check_res['checkbox69b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox70b" value="1" <?php if ($check_res['checkbox70b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox71b" value="1" <?php if ($check_res['checkbox71b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox72b" value="1" <?php if ($check_res['checkbox72b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox73b" value="1" <?php if ($check_res['checkbox73b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox74b" value="1" <?php if ($check_res['checkbox74b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox75b" value="1" <?php if ($check_res['checkbox75b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox76b" value="1" <?php if ($check_res['checkbox76b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                </td>
                <td style="border:1px solid black;">
                <input type="checkbox" name="checkbox77b" value="1" <?php if ($check_res['checkbox77b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>1:1 <input type="checkbox" name="checkbox78b" value="1" <?php if ($check_res['checkbox78b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>written material <br> <input type="checkbox" name="checkbox79b" value="1" <?php if ($check_res['checkbox79b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>groups <input type="checkbox" name="checkbox80b" value="1" <?php if ($check_res['checkbox80b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>videos <br> <input type="checkbox" name="checkbox81b" value="1" <?php if ($check_res['checkbox81b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>verbal discussion <br><input type="checkbox" name="checkbox82b" value="1" <?php if ($check_res['checkbox82b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Demonstration
                </td>
            </tr>
            <tr>
                <td style="border:1px solid black;">
                    5.Patient Relapse <br>Date of Relapse <br> <br> pt signature: 
                    <?php
                if($check_res['input5b']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['input5b'].'>';
                }
                ?>
                    
                </td>
                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkbox83b" value="1" <?php if ($check_res['checkbox83b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Informed Support <br>
                    <input type="checkbox" name="checkbox84b" value="1" <?php if ($check_res['checkbox84b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox85b" value="1" <?php if ($check_res['checkbox85b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Family intervention <br>
                    <input type="checkbox" name="checkbox86b" value="1" <?php if ($check_res['checkbox86b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Therapeutic support
                </td>
                <td style="border:1px solid black;">
                    <input type="checkbox" name="checkbox87b" value="1" <?php if ($check_res['checkbox87b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox88b" value="1" <?php if ($check_res['checkbox88b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox89b" value="1" <?php if ($check_res['checkbox89b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox90b" value="1" <?php if ($check_res['checkbox90b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox91b" value="1" <?php if ($check_res['checkbox91b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox92b" value="1" <?php if ($check_res['checkbox92b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox93b" value="1" <?php if ($check_res['checkbox93b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox94b" value="1" <?php if ($check_res['checkbox94b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox95b" value="1" <?php if ($check_res['checkbox95b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                    <input type="checkbox" name="checkbox96b" value="1" <?php if ($check_res['checkbox96b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>24hrs  <input type="checkbox" name="checkbox97b" value="1" <?php if ($check_res['checkbox97b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>48hrs  <input type="checkbox" name="checkbox98b" value="1" <?php if ($check_res['checkbox98b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>10days <br>
                </td>
                <td style="border:1px solid black;">
                <input type="checkbox" name="checkbox99b" value="1" <?php if ($check_res['checkbox99b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>1:1 <input type="checkbox" name="checkbox100b" value="1" <?php if ($check_res['checkbox100b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>written material <br> <input type="checkbox" name="checkbox111b" value="1" <?php if ($check_res['checkbox111b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>groups <input type="checkbox" name="checkbox112b" value="1" <?php if ($check_res['checkbox112b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>videos <br> <input type="checkbox" name="checkbox113b" value="1" <?php if ($check_res['checkbox113b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>verbal discussion <br><input type="checkbox" name="checkbox114b" value="1" <?php if ($check_res['checkbox114b'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>Demonstration
                </td>
                 
            </tr>
  </table>
  <br/><br/>
  <table style="width:100%;border-collapse:collapse;">
  <tr>
  <td style="border:1px solid black;">
          <b>Nurse signature:</b>
          <?php
                if($check_res['sign1b']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign1b'].'>';
                }
                ?>
          <!-- <p><?php echo text($check_res['sign1']); ?> </p> -->
      </td>
      <td style="border:1px solid black;">
          <b>Date:</b>
          <p><?php echo text($check_res['bdate1']); ?> </p>
      </td>
      <td style="border:1px solid black;">
          <b>Time:</b>
          <p><?php echo text($check_res['btime1']); ?> </p>
      </td>
  </tr>
  <tr>
      <td style="border:1px solid black;">
          <b>Patient signature:</b>
          <?php
                if($check_res['sign2b']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign2b'].'>';
                }
                ?>
          <!-- <p><?php echo text($check_res['sign2']); ?> </p> -->
      </td>
      <td style="border:1px solid black;">
          <b>Date:</b>
          <p><?php echo text($check_res['bdate2']); ?> </p>
      </td>
      <td style="border:1px solid black;">
          <b>Time:</b>
          <p><?php echo text($check_res['btime2']); ?> </p>
      </td>
  </tr>
</table>


    
        <?php
        ?>
        <?php
        $footer ="<table>
        <tr>
            <td style='width:45% font-size:10px align:right'>Page: {PAGENO} of {nb}</td>
        </tr>
        </table>";

//$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Master Treatment Plan");
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

$mpdf->Output('Master Treatment Plan.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
