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
    $sql = "SELECT * FROM `form_cows` WHERE id = ? AND pid = ?";
    $res = sqlStatement($sql, array($formid,$pid));
    // $data = sqlFetchArray($res);
    // print_r($data);die;

    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
      $all[$iter] = $row;
  }
  $check_res = $all[0];
}
    $check_res = $formid ? $check_res : array();
    // print_r($check_res);die;

   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';

use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Clinical Opiate Withdraw Scale(COWS)</h2>
</div>";
ob_start();
 ?>
<div class="container mt-3">
 <div class="container-fluid">
    <div class="row">
        <table class="table table-bordered" style="width:100%;height:100%">
        <thead>
               <tr>
                 <td><h4>Clinical Opiate Withdraw Scale(COWS)<h4></td>
               </tr>
               <tr>
               <td colspan='4'><h4>Opiate Withdraw Scale</h4><td>
               <td colspan='8'>Name:<b><?php echo text($check_res['name']); ?></b><td>
               </tr>
               <tr>
                 <td><h4></td>
               </tr>
               <tr>
               <td colspan='4'>(COWS)<td>
               <td colspan='8'>DOB:<b><?php echo text($check_res['dob']);?>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name='mf' value="1"
               <?php
                if($check_res['mf']=="1"){
                    echo "checked='checked'";
                }
              ?>
               >M<input type="checkbox" name='mf' value="2"
               <?php
                 if($check_res['mf']=="2"){
                    echo "checked='checked'";
                 }
               ?>
               >F<td>
               </tr>

               <br/>
               <tr>
                 <td colspan='5' style="border:1px solid black"><h4>Ratings:<h4><br/>
                 <h5>0 <input type="checkbox" class="radio_change rating" data-id="rating" value="0" <?php echo isset($check_res['rating'])&&$check_res['rating']=='0'?'checked=checked':''; ?>>&nbsp;&nbsp;&nbsp;
                    1 <input type="checkbox" class="radio_change rating" data-id="rating" value="1" <?php echo isset($check_res['rating'])&&$check_res['rating']==1?'checked=checked':''; ?>>&nbsp;&nbsp;&nbsp;
                    2<input type="checkbox" class="radio_change rating" data-id="rating" value="2" <?php echo isset($check_res['rating'])&&$check_res['rating']==2?'checked=checked':''; ?>>
                    3 <input type="checkbox" class="radio_change rating" data-id="rating" value="3" <?php echo isset($check_res['rating'])&&$check_res['rating']==3?'checked=checked':''; ?>>
                    4 <input type="checkbox" class="radio_change rating" data-id="rating" value="4" <?php echo isset($check_res['rating'])&&$check_res['rating']==4?'checked=checked':''; ?>>&nbsp;&nbsp;&nbsp;
                    5 <input type="checkbox" class="radio_change rating" data-id="rating" value="5" <?php echo isset($check_res['rating'])&&$check_res['rating']==5?'checked=checked':''; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    6 <input type="checkbox" class="radio_change rating" data-id="rating" value="6" <?php echo isset($check_res['rating'])&&$check_res['rating']==6?'checked=checked':''; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                    7 <input type="checkbox" class="radio_change rating" data-id="rating" value="7" <?php echo isset($check_res['rating'])&&$check_res['rating']==7?'checked=checked':''; ?>></h5>
                  <h5>Nill mind moderate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;severe&nbsp;&nbsp;&nbsp;very&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;severe</h5>
                  </td>
                 <td colspan='7' style="border:1px solid black">
                   <h5>Pupil size</h5><br/>
                   <span style="height:5px;width:5px;background-color:black;border-radius:50%;display: inline-block;margin-right:30px;"></span>
                   <span class='dot2' style="width:5px;background-color:black;height:5px;border-radius:50%;"></span>
                   <span class='dot3'></span>
                   <span class='dot4'></span>
                   <span class='dot5'></span>
                   <span class='dot6'></span>
                   <span class='dot7'></span>
                   <span class='dot8'></span><br/>
                   <span class='no1'>1</span>
                   <span class='no2'>2</span>
                   <span class='no3'>3</span>
                   <span class='no4'>4</span>
                   <span class='no5'>5</span>
                   <span class='no6'>6</span>
                   <span class='no7'>7</span>
                   <span class='no8'>8 mm</span>
                 </td>
               </tr>
               <br/>
               <br/>
               </thead>
                </table><br/><br/>
               <table class="table table-bordered" style="width:100%;height:100%">
        <thead>
               <tr>
                 <td colspan='1' style="border:1px solid black">Date & Time of Last Use</td>
                 <td colspan='1' style="border:1px solid black">Date:</td>
                 <td colspan='1' style="border:1px solid black"><?php echo text($check_res['date2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['date2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['date3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['date4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['date5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['date6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['date7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['date8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['date9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['date10']); ?></b></td>
                 </tr>
        <tr>

                 <td colspan='1' style="border:1px solid black"><b>Date:&nbsp;&nbsp;&nbsp;&nbsp;</b> <?php echo text($check_res['dobs']); ?></td>
                 <td colspan='1' style="border:1px solid black"> Time:</td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['timee10']); ?></b></td>
                 </tr>
                 <tr>

                 <td colspan='1' style="border:1px solid black"> <b>Time:&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo text($check_res['times']); ?></td>
                 <td colspan='1' style="border:1px solid black">BALs:</td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['bal10']); ?></b></td>
                 </tr>
        </thead>
        </table> <br/>
        <table class="table table-bordered" style="width:100%;height:100%">
        <thead>
        <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Resting Pulse Rate:</b>(record beats per minute)<br/>
                  Measured after patient is sitting or<br/>lying for one minute<br/>
                  <b>0</b> pulse rate 80 or below<br/>
                  <b>1</b> pulse rate 81 or 100<br/>
                  <b>2</b> pulse rate 101 or 120<br/>
                  <b>4</b> pulse rate greater than 120
                </p>
                <!-- <td colspan='1'  style="border:1px solid black"></td> -->
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['rest10']); ?></b></td>
            </tr>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Sweating:</b>over past 1/2 hout not accounted<br/>
                  for by room temp or patient activity<br/>
                  <b>0</b> no report of chills or flushing<br/>
                  <b>1</b> subjective report of chills or flushing<br/>
                  <b>2</b> flushed or observable moistness on face<br/>
                  <b>3</b> beads of sweat on brow or face<br/>
                  <b>4</b> sweating streaming off face<br/>
                </p>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['sweat10']); ?></b></td>
            </tr>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Restlessness:</b>observation during assessment<br/>
                  <b>0</b> able to sit still<br/>
                  <b>1</b> reports difficulty sitting still,but is able to do so<br/>
                  <b>3</b> frequent shifting or extraneous movement of legs/arms<br/>
                  <b>5</b> unable to sit still for more than a few seconds<br/>
                  <b>4</b> sweating streaming off face<br/>
                </p>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['restless10']); ?></b></td>
            </tr>
        </thead>
        </table> <br/>
        <table class="table " style="width: 100%;border:1px solid black;height:100%">
                </thead>
            <tr>
                 <td><h4>Clinical Opiate Withdraw Scale(COWS)<h4></td>
               </tr>
               <tr>
               <td colspan='4'><h4></h4><td>
               <td colspan='8'><h4>Name:<?php echo text($check_res['names']); ?></h4><td>
               </tr>
               <tr>
                 <td></td>
               </tr>
               <tr>
               <td colspan='4'><h4></h4><td>
               <td colspan='8'><h4>DOB:<?php echo text($check_res['dobss']); ?>&nbsp;&nbsp;&nbsp;&nbsp;
               <input type="checkbox" name='mf1' value="1"
               <?php
                if($check_res['mf1']=="1"){
                    echo "checked='checked'";
                }
              ?>
               >M<input type="checkbox" name='mf1' value="2"
               <?php
                if($check_res['mf1']=="2"){
                    echo "checked='checked'";
                }
              ?>
               >F</h4><td>
               <!-- <td colspan='6'><h4><input type="checkbox" name='name' value="dob">M <input type="checkbox" name='name' value="dob">F</h4><td> -->

               </tr>
               <tr>
              <td colspan='2'   style="border:1px solid black">
                <p>
                  <b>Anxienty or Irritability</b><br/>
                  <b>0</b>none<br/>
                  <b>1</b>patient report increasing irritability or<br/>anxiousness<br/>
                  <b>2</b>patient obviously/anxious<br/>
                  <b>4</b>patient so irritable or anxious thatparticipated<br/>
                  in the assessment is difficult
                </p>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['anxienty10']); ?></b></td>
            </tr>
            <tr>
              <td colspan='2'   style="border:1px solid black">
                <p>
                  <b>Gooseflesh:</b><br/>
                  <b>0</b> skin is smooth<br/>
                  <b>3</b>piloerection of skin can be felt or hairs<br/>
                  standing up on arms<br/>
                  <b>4</b>prominent piloerectoin<br/>
                </p>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['goose10']); ?></b></td>
            </tr>
            <tr>
              <td colspan='2'   style="border:1px solid black">
                <p>
                  <b>TOTAL SCORE:</b><br/>
                  <b>5-12=mild</b> <br/>
                  <b>13-24=moderate</b><br/>
                  <b>25-36=moderately severe</b> <br/>
                  <b>37 or greater=severe withdrawal</b><br/>
                </p></td>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['total10']); ?></b></td>
            </tr>
            <tr>
              <td colspan='2'   style="border:1px solid black">
                <p>
                  <b>Blood Pressure:</b><br/></td>
                  <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['blood10']); ?></b></td>
            </tr>
            <tr>
              <td colspan='2'   style="border:1px solid black">
                <p>
                  <b>Temperature:</b><br/>
                </p>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['temperature10']); ?></b></td>
            </tr>
            <tr>
              <td colspan='2'   style="border:1px solid black">
                <p>
                  <b>Respirations:</b><br/>
                </p>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['respirations10']); ?></b></td>
            </tr>
            <tr>
              <td colspan='1'   style="border:1px solid black">
                <p>
                  <b>Pupils:</b><br/>
                  <p>Reacts   +Brisk B <br/>no reaction -
                     sluggish s</p>
                  <br/>
                </p>
               </td>
               <td colspan='1'   style="border:1px solid black">Size in mm<br/>
               <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['pupils10']); ?></b></td>
                </td>
               </tr>
               <tr>
               <td colspan='1'   style="border:1px solid black">
                <p></p>
               </td>
                <td colspan='1'   style="border:1px solid black">Reaction<br/>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['reaction10']); ?></b></td>
                </td>
            </tr>

            <tr>
              <td colspan='2'   style="border:1px solid black">
                <p>
                  <b>Medication:</b><br/>
                </p>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['medication10']); ?></b></td>
            </tr>
             <tr>
              <td colspan='2'   style="border:1px solid black">
                <p>
                  <b>Nurse Initial:</b><br/>
                </p>
                <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse1']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse2']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse3']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse4']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse5']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse6']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse7']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse8']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse9']); ?></b></td>
                 <td colspan='1' style="border:1px solid black"><b><?php echo text($check_res['nurse10']); ?></b></td>
            </tr>

           </thead>
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
$mpdf->setTitle("Clinical Opiate Withdraw Scale(COWS)");
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

$mpdf->Output("PRN.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>

