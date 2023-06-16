<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
if ($formid) {
    $sql = "SELECT * FROM `form_CIWA_AMP` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();

   ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CNT FORM</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
      /* * {
        margin: 15px;
        padding-top: 15px;
        padding-bottom: 15px;
        padding-left: 50px;
        padding-right: 50px;
        border: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent;
      } */
      .heading {
        font-size: 14px;
        font-weight: 600;
      }
      .nam_bor{
        border-left: none;
        border-right: none;
        border-top: none;
      }
      .center {
        text-align: center;
      }
      .dot{
        border-bottom-style: dotted;
      }
      .fright{
        float: right;
      }
      .ctitle{
        padding-top: 26px;
        padding-bottom: 15px;
      }
      .dot1{
        height:5px;
        width:5px;
        background-color:black;
        border-radius:50%;
        display: inline-block;
        margin-right:30px;
      }
      .dot2{
        height:8px;
        width:8px;
        background-color:black;
        border-radius:50%;
        display: inline-block;
        margin-right:30px;
      }
      .dot3{
        height:12px;
        width:12px;
        background-color:black;
        border-radius:50%;
        display: inline-block;
        margin-right:30px;
      }
      .dot4{
        height:15px;
        width:15px;
        background-color:black;
        border-radius:50%;
        display: inline-block;
        margin-right:30px;
      }
      .dot5{
        height:18px;
        width:18px;
        background-color:black;
        border-radius:50%;
        display: inline-block;
        margin-right:30px;
      }
      .dot6{
        height:21px;
        width:21px;
        background-color:black;
        border-radius:50%;
        display: inline-block;
        margin-right:30px;
      }
      .dot7{
        height:24px;
        width:24px;
        background-color:black;
        border-radius:50%;
        display: inline-block;
        margin-right:30px;
      }
      .dot8{
        height:27px;
        width:27px;
        background-color:black;
        border-radius:50%;
        display: inline-block;
        margin-right:30px;
      }
      .no1{
        padding-right:25px;
      }
      .no{
        padding-right:35px;
      }
      .tborder{
        border:1px solid black;
      }
      .bor_wid{
        width: 80%;
        border: none;
      }
      .p-size {
        font-size: 15px;
      }

      ::placeholder {
        color: black;
      }

      input {
        outline: none;
      }

      td {
        border: 2px solid black;
        padding: 5px;
      }

      .row {
        width: 100% !important;
      }

      input#desid {
        margin-bottom: 24px;
      }

      .pm {
        margin-left: 10px;
      }

      .field {
        border: bottom 1px solid black;
      }

      .text_b {
        font-size: 15px;
      }

      p.p-size.pm.marginp {
        margin-left: 45px;
      }

      .dp {
        display: flex;
      }
      .subbtn {
    background: #0066A2;
    color: white;
    border-style: outset;
    border-color: #0066A2;
    height: 38px;
    width: 100px;
    margin-bottom: 10px;
    font: bold15px arial,sans-serif;
    text-shadow: none;
}
.btndiv{
  margin: 25px;
  text-align: center;

}

.cancel{
  border: 1px solid red;
    padding: 8px;
    background-color: red;
    color: white;
    font-size: 16px;
    width: 99px;
}
    </style>
  </head>
  <body>
    <div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/CIWA_AMP/save.php?id=<?php echo attr_url($formid); ?>">
          <div style="display:inline-flex;padding-top: 50px;">
            <span>
              <p class="heading">Amphetamine Use Withdrawal Scale</p>
            </span>
            <span style="padding-left: 625px;">
              <label>Name:
              <input class="nam_bor" type="text" name="name" value="<?php echo text($check_res['name']); ?>"></label>
            </span>
          </div>
          <div class="fright">
            <label>DOB:</label> <input class="nam_bor dot" type="date" name="dob" value="<?php echo text($check_res['dob']); ?>">
            &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="yes_no" name="male_female" value="1"
               <?php
                if($check_res['male_female']=="1"){
                 echo "checked";
                }
              ?>
               >&nbsp;M &nbsp;&nbsp;<input type="checkbox" class="yes_no" name="male_female1" value="2"
               <?php
                 if($check_res['male_female1']=="2"){
                  echo "checked";
                 }
               ?>
               >&nbsp;F</h4>
          </div>
          <br>
          <div><p  class="center heading ctitle">Amphetamine Use Withdrawal Scale</p></div>

          <p  class="center heading">(CIWA-A)</p>

          <table style="width:100%;">
            <tr>
              <td class="tborder" style="width:50%;"><h5>Ratings: <h5>
                <h5><input type="checkbox" class="yes_no1" name="rating0" value="0"
               <?php
                if($check_res['rating0']=="0"){
                 echo "checked";
                }
              ?>
               > 0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name='rating1 'class="yes_no1" value="1"
               <?php
                if($check_res['rating1']=="1"){
                 echo "checked";
                }
              ?>> 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <input type="checkbox" class="yes_no1" name="rating2" value="2"
               <?php
                if($check_res['rating2']=="2"){
                 echo "checked";
                }
              ?>> 2 <input type="checkbox" class="yes_no1" name="rating3" value="3"
               <?php
                if($check_res['rating3']=="3"){
                 echo "checked";
                }
              ?>> 3 &nbsp;&nbsp;&nbsp; <input type="checkbox" class="yes_no1" name="rating4" value="4"
               <?php
                if($check_res['rating4']=="4"){
                 echo "checked";
                }
              ?>> 4 &nbsp;&nbsp;&nbsp;&nbsp;<input class="yes_no1" type="checkbox" name="rating5" value="5"
               <?php
                if($check_res['rating5']=="5"){
                 echo "checked";
                }
              ?>> 5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <input type="checkbox" class="yes_no1" name="rating6" value="6"
               <?php
                if($check_res['rating6']=="6"){
                 echo "checked";
                }
              ?>> 6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="rating7" value="7" class="yes_no1"
               <?php
                if($check_res['rating7']=="7"){
                 echo "checked";
                }
              ?>> 7</h5>
                <h5>Nill &emsp; mind &emsp;&emsp; moderate&emsp;&emsp;&emsp;&emsp; severe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;very&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;severe</h5>
              </td>
              <td class="tborder" >
                <h5>Pupil size</h5>
                <span class='dot1'></span>
                <span class='dot2'></span>
                <span class='dot3'></span>
                <span class='dot4'></span>
                <span class='dot5'></span>
                <span class='dot6'></span>
                <span class='dot7'></span>
                <span class='dot8'></span><br/>
                <span class='no1'>1</span>
                <span class='no'>2</span>
                <span class='no'>3</span>
                <span class='no'>4</span>
                <span class='no'>5</span>
                <span class='no'>6</span>
                <span class='no'>7</span>
                <span class='no'>8 mm</span>
              </td>
          </tr>
        </table>
          <br>
          <br>

          <table class="form_1" style="width:100%;">
              <tr>
                <td style="width:20%;" class="tborder"  rowspan="3">
                  <label>Date &amp; Time of Last Use</label>
                  <label>Date: <input class="nam_bor" type="date" name="dobs" value="<?php echo text($check_res['dobs']); ?>" style="width:70%;"></label>
                  <label>Time: <input class="nam_bor" type="time" name="times" value="<?php echo text($check_res['times']); ?>" style="width:60%;"></label>
                </td>
                <td style="width:10%" class="tborder" >
                  <p>Date</p>
                </td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date1' value='<?php echo text($check_res['date1']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date2' value='<?php echo text($check_res['date2']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date3' value='<?php echo text($check_res['date3']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date4' value='<?php echo text($check_res['date4']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date5' value='<?php echo text($check_res['date5']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date6' value='<?php echo text($check_res['date6']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date7' value='<?php echo text($check_res['date7']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date8' value='<?php echo text($check_res['date8']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date9' value='<?php echo text($check_res['date9']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='date')" name='date10' value='<?php echo text($check_res['date10']); ?>'></td>

              </tr>
              <tr>
                <td class="tborder">
                  <p>Time</p>
                </td>
                <td class="tborder"> <input class="bor_wid" type='text' onfocus="(this.type='time')" name='time1' value='<?php echo text($check_res['time1']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text'  onfocus="(this.type='time')" name='time2' value='<?php echo text($check_res['time2']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text'  onfocus="(this.type='time')" name='time3' value='<?php echo text($check_res['time3']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text'  onfocus="(this.type='time')" name='time4' value='<?php echo text($check_res['time4']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text'  onfocus="(this.type='time')" name='time5' value='<?php echo text($check_res['time5']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text'  onfocus="(this.type='time')" name='time6' value='<?php echo text($check_res['time6']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text'  onfocus="(this.type='time')" name='time7' value='<?php echo text($check_res['time7']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text'  onfocus="(this.type='time')" name='time8' value='<?php echo text($check_res['time8']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text'  onfocus="(this.type='time')" name='time9' value='<?php echo text($check_res['time9']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text'  onfocus="(this.type='time')" name='time10' value='<?php echo text($check_res['time10']); ?>'></td>
              </tr>
              <tr>
                <td class="tborder">
                  <p>BAL</p>
                </td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal1' value='<?php echo text($check_res['bal1']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal2' value='<?php echo text($check_res['bal2']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal3' value='<?php echo text($check_res['bal3']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal4' value='<?php echo text($check_res['bal4']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal5' value='<?php echo text($check_res['bal5']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal6' value='<?php echo text($check_res['bal6']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal7' value='<?php echo text($check_res['bal7']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal8' value='<?php echo text($check_res['bal8']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal9' value='<?php echo text($check_res['bal9']); ?>'></td>
                <td class="tborder"> <input class="bor_wid" type='text' name='bal10' value='<?php echo text($check_res['bal10']); ?>'></td>

              </tr>
          </table>
          <br>
          <br>
          <table class="form_1" style="width:100%;">
            <tr>
              <td style="width:20%;" class="tborder">
                <p>AGITATION: Observation</p>
                <p>  0 - Normal activity</p>
                <p>  1 - Somewhat more than normal
                  activity</p>
                  <p>  2</p>
                  <p> 3</p>
                  <p> 4 - Moderately fidgety and restless</p>
                  <p> 5</p>
                  <p>    6</p>
                  <p> 7 - Paces back and forth or
                  constantly thrashes about</p>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation1' value='<?php echo text($check_res['agitation1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation2' value='<?php echo text($check_res['agitation2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation3' value='<?php echo text($check_res['agitation3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation4' value='<?php echo text($check_res['agitation4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation5' value='<?php echo text($check_res['agitation5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation6' value='<?php echo text($check_res['agitation6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation7' value='<?php echo text($check_res['agitation7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation8' value='<?php echo text($check_res['agitation8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation9' value='<?php echo text($check_res['agitation9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='agitation10' value='<?php echo text($check_res['agitation10']); ?>'>
              </td>
            </tr>
            <tr>
              <td style="width:20%;" class="tborder">
                PARANOIA: Ask “Do you feel
                people are paying special attention
                to you? Do you feel anyone is out to
                get you or give you a hard time?
                0 - No paranoia
                1 - Mildly suspicious
                2
                3
                4 - Moderately paranoid or
                suspicious.
                5
                6
                7 - Severely paranoid with
                delusions of persecution
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia1' value='<?php echo text($check_res['paranoia1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia2' value='<?php echo text($check_res['paranoia2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia3' value='<?php echo text($check_res['paranoia3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia4' value='<?php echo text($check_res['paranoia4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia5' value='<?php echo text($check_res['paranoia5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia6' value='<?php echo text($check_res['paranoia6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia7' value='<?php echo text($check_res['paranoia7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia8' value='<?php echo text($check_res['paranoia8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia9' value='<?php echo text($check_res['paranoia9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paranoia10' value='<?php echo text($check_res['paranoia10']); ?>'>
              </td>
            </tr>
            <tr>
              <td style="width:20%;" class="tborder">
                Paroxysmal Sweats:
                0 no sweat visible
                1
                2
                3
                4 beads of sweat viable on
                forehead
                5
                6
                7 drenching sweat
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal1' value='<?php echo text($check_res['paroxysmal1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal2' value='<?php echo text($check_res['paroxysmal2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal3' value='<?php echo text($check_res['paroxysmal3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal4' value='<?php echo text($check_res['paroxysmal4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal5' value='<?php echo text($check_res['paroxysmal5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal6' value='<?php echo text($check_res['paroxysmal6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal7' value='<?php echo text($check_res['paroxysmal7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal8' value='<?php echo text($check_res['paroxysmal8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal9' value='<?php echo text($check_res['paroxysmal9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='paroxysmal10' value='<?php echo text($check_res['paroxysmal10']); ?>'>
              </td>
            </tr>
            <tr>
              <td style="width:20%;" class="tborder">
                Anxiety: Ask, “Do you feel anxious?”
                0 - no anxiety
                1 - mild anxiety
                2
                3
                4 - moderately anxious, or guarded,
                so anxiety is inferred
                5
                6
                7 - panic state or constantly trashing
                out
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety1' value='<?php echo text($check_res['anxiety1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety2' value='<?php echo text($check_res['anxiety2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety3' value='<?php echo text($check_res['anxiety3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety4' value='<?php echo text($check_res['anxiety4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety5' value='<?php echo text($check_res['anxiety5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety6' value='<?php echo text($check_res['anxiety6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety7' value='<?php echo text($check_res['anxiety7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety8' value='<?php echo text($check_res['anxiety8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety9' value='<?php echo text($check_res['anxiety9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='anxiety10' value='<?php echo text($check_res['anxiety10']); ?>'>
              </td>
            </tr><tr>
              <td style="width:20%;" class="tborder">
                DEPRESSION: Ask “Do you feel
                sad or depressed?” If yes, “On a
                scale of one to seven how
                depressed do you feel?”
                0 - None
                1 - Mild depression
                2
                3
                4 - Moderate depressed most of the
                day
                5
                6
                7 - Severe depressed all day every
                day.
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression1' value='<?php echo text($check_res['depression1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression2' value='<?php echo text($check_res['depression2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression3' value='<?php echo text($check_res['depression3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression4' value='<?php echo text($check_res['depression4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression5' value='<?php echo text($check_res['depression5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression6' value='<?php echo text($check_res['depression6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression7' value='<?php echo text($check_res['depression7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression8' value='<?php echo text($check_res['depression8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression9' value='<?php echo text($check_res['depression9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='depression10' value='<?php echo text($check_res['depression10']); ?>'>
              </td>
            </tr>
            <tr>
              <td style="width:20%;" class="tborder">
                CRAVING: Ask “Are you craving
                drugs or alcohol?
                0 - No craving
                1 - Mild or occasionally thinking
                about drug use
                2
                3
                4 - Moderate craving drug use
                throughout the day.
                5
                6
                7 - Severe can’t stop craving.
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving1' value='<?php echo text($check_res['craving1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving2' value='<?php echo text($check_res['craving2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving3' value='<?php echo text($check_res['craving3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving4' value='<?php echo text($check_res['craving4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving5' value='<?php echo text($check_res['craving5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving6' value='<?php echo text($check_res['craving6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving7' value='<?php echo text($check_res['craving7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving8' value='<?php echo text($check_res['craving8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving9' value='<?php echo text($check_res['craving9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='craving10' value='<?php echo text($check_res['craving10']); ?>'>
              </td>
            </tr>
            <tr>
              <td style="width:20%;" class="tborder">
                Orientation Clouding of
                Sensorium: Ask “What day is it,
                where are you, who am I.”
                0 oriented and can do serial
                additions
                1 can’t do serial additions uncertain
                about dates
                2 disoriented by date by 2 days
                3 disoriented by date more then
                day
                4 disoriented of place, and or
                person
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation1' value='<?php echo text($check_res['orientation1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation2' value='<?php echo text($check_res['orientation2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation3' value='<?php echo text($check_res['orientation3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation4' value='<?php echo text($check_res['orientation4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation5' value='<?php echo text($check_res['orientation5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation6' value='<?php echo text($check_res['orientation6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation7' value='<?php echo text($check_res['orientation7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation8' value='<?php echo text($check_res['orientation8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation9' value='<?php echo text($check_res['orientation9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='orientation10' value='<?php echo text($check_res['orientation10']); ?>'>
              </td>
            </tr>
            <tr>
              <td style="width:20%;" class="tborder">
                Visual Disturbances: Ask, “Does
                the light appear to be too bright? Is
                the color different? Does it hurt your
                eyes? Are you seeing anything that is
                disturbing you? Are you seeing things
                you know are not there?”
                0 not present
                1 very mild sensitivity
                2 mild sensitivity
                3 moderate sensitivity
                4 moderately severe hallucinations
                5 severe sensitivity
                6 extremely severe hallucinations
                7 continuous hallucinations
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_1' value='<?php echo text($check_res['vis_dis_1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_2' value='<?php echo text($check_res['vis_dis_2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_3' value='<?php echo text($check_res['vis_dis_3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_4' value='<?php echo text($check_res['vis_dis_4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_5' value='<?php echo text($check_res['vis_dis_5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_6' value='<?php echo text($check_res['vis_dis_6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_7' value='<?php echo text($check_res['vis_dis_7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_8' value='<?php echo text($check_res['vis_dis_8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_9' value='<?php echo text($check_res['vis_dis_9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='vis_dis_10' value='<?php echo text($check_res['vis_dis_10']); ?>'>
              </td>
            </tr>
            <tr>
              <td style="width:20%;" class="tborder">
                Tactile Disturbance: Ask, “Any
                itching,
                Pins and needle sensation, burning,
                Numbness, or feel like bugs are
                Crawling under skin?”
                0 none
                1 very mild itching, burning, pins &amp;
                Needles or numbness
                2 mild itching, pins, needles, burning
                Or numbness
                3 moderate itching, pins, needles,
                burning
                Or numbness
                4 moderate severe hallucinations
                5 severe hallucinations
                6 extremely severe hallucinations
                7 continuous hallucinations
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile1' value='<?php echo text($check_res['tactile1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile2' value='<?php echo text($check_res['tactile2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile3' value='<?php echo text($check_res['tactile3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile4' value='<?php echo text($check_res['tactile4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile5' value='<?php echo text($check_res['tactile5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile6' value='<?php echo text($check_res['tactile6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile7' value='<?php echo text($check_res['tactile7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile8' value='<?php echo text($check_res['tactile8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile9' value='<?php echo text($check_res['tactile9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='tactile10' value='<?php echo text($check_res['tactile10']); ?>'>
              </td>
            </tr>
            <tr>
              <td style="width:20%;" class="tborder">
                Auditory Disturbances: Ask “Are
                you more aware of sounds? Are they
                harsh? Do they frighten you? Are you
                hearing. Anything that frightens you?
                Are you Hearing things you are not
                aware of?”
                0 not present
                1 very mild harshness or ability to
                frighten
                2 mild harshness or ability to
                frighten
                3 moderate harshness or ability to
                frighten
                4 Moderately severe hallucinations
                5 Severe Hallucinations
                6 Extremely severe hallucinations
                7 Continuous hallucinations
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory1' value='<?php echo text($check_res['auditory1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory2' value='<?php echo text($check_res['auditory2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory3' value='<?php echo text($check_res['auditory3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory4' value='<?php echo text($check_res['auditory4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory5' value='<?php echo text($check_res['auditory5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory6' value='<?php echo text($check_res['auditory6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory7' value='<?php echo text($check_res['auditory7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory8' value='<?php echo text($check_res['auditory8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory9' value='<?php echo text($check_res['auditory9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='auditory10' value='<?php echo text($check_res['auditory10']); ?>'>
              </td>
            </tr>
            <tr>
              <td style="width:20%;" class="tborder">
                Visual Disturbances: Ask, “Does the
                light appear to be too bright? Is the
                color different? Does it hurt your eyes?
                Are you seeing anything that is
                disturbing you? Are you seeing things
                you know are not there?”
                0 not present
                1 very mild sensitivity
                2 mild sensitivity
                3 moderate sensitivity
                4 moderately severe hallucinations
                5 severe sensitivity
                6 extremely severe hallucinations
                7 continuous hallucinations
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual1' value='<?php echo text($check_res['visual1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual2' value='<?php echo text($check_res['visual2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual3' value='<?php echo text($check_res['visual3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual4' value='<?php echo text($check_res['visual4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual5' value='<?php echo text($check_res['visual5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual6' value='<?php echo text($check_res['visual6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual7' value='<?php echo text($check_res['visual7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual8' value='<?php echo text($check_res['visual8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual9' value='<?php echo text($check_res['visual9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='visual10' value='<?php echo text($check_res['visual10']); ?>'>
              </td>
            </tr>
          </table>
          <br>
          <br>

          <table>
            <tr>
            <td style="width:20%;" class="tborder">
            Total Score
            Scores:
            0-8 = indicates mild withdrawal
            8-20 = indicates moderate withdrawal
            20+ = indicates severe withdrawal
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores1' value='<?php echo text($check_res['scores1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores2' value='<?php echo text($check_res['scores2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores3' value='<?php echo text($check_res['scores3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores4' value='<?php echo text($check_res['scores4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores5' value='<?php echo text($check_res['scores5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores6' value='<?php echo text($check_res['scores6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores7' value='<?php echo text($check_res['scores7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores8' value='<?php echo text($check_res['scores8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores9' value='<?php echo text($check_res['scores9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='scores10' value='<?php echo text($check_res['scores10']); ?>'>
              </td>
            </tr>
          </table>
          <br>
          <br>

          <table class="form_1" style="width:100%;">
            <tr>
              <td style="width:20%;" class="tborder">
                Blood Pressure
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood1' value='<?php echo text($check_res['blood1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood2' value='<?php echo text($check_res['blood2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood3' value='<?php echo text($check_res['blood3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood4' value='<?php echo text($check_res['blood4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood5' value='<?php echo text($check_res['blood5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood6' value='<?php echo text($check_res['blood6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood7' value='<?php echo text($check_res['blood7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood8' value='<?php echo text($check_res['blood8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood9' value='<?php echo text($check_res['blood9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='blood10' value='<?php echo text($check_res['blood10']); ?>'>
              </td>
            </tr>
            <tr>
              <td class="tborder">
                Pulse
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse1' value='<?php echo text($check_res['pulse1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse2' value='<?php echo text($check_res['pulse2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse3' value='<?php echo text($check_res['pulse3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse4' value='<?php echo text($check_res['pulse4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse5' value='<?php echo text($check_res['pulse5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse6' value='<?php echo text($check_res['pulse6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse7' value='<?php echo text($check_res['pulse7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse8' value='<?php echo text($check_res['pulse8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse9' value='<?php echo text($check_res['pulse9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='pulse10' value='<?php echo text($check_res['pulse10']); ?>'>
              </td>
            </tr>
            <tr>
              <td class="tborder">
                Temperature
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature1' value='<?php echo text($check_res['temperature1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature2' value='<?php echo text($check_res['temperature2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature3' value='<?php echo text($check_res['temperature3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature4' value='<?php echo text($check_res['temperature4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature5' value='<?php echo text($check_res['temperature5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature6' value='<?php echo text($check_res['temperature6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature7' value='<?php echo text($check_res['temperature7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature8' value='<?php echo text($check_res['temperature8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature9' value='<?php echo text($check_res['temperature9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='temperature10' value='<?php echo text($check_res['temperature10']); ?>'>
              </td>
            </tr>
            <tr>
              <td class="tborder">
                Respirations
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations1' value='<?php echo text($check_res['respirations1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations2' value='<?php echo text($check_res['respirations2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations3' value='<?php echo text($check_res['respirations3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations4' value='<?php echo text($check_res['respirations4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations5' value='<?php echo text($check_res['respirations5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations6' value='<?php echo text($check_res['respirations6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations7' value='<?php echo text($check_res['respirations7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations8' value='<?php echo text($check_res['respirations8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations8' value='<?php echo text($check_res['respirations9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='respirations10' value='<?php echo text($check_res['respirations10']); ?>'>
              </td>
            </tr>
          </table>
          <br>
          <br>

          <table class="form_1" style="width:100%;">
            <tr>
              <td style="width:20%;" rowspan="3" class="tborder">
                <p>
                  Pupils
                  Reacts + no reaction -
                  Brisk B sluggish s
                </p>
              </td>
            </tr>
            <tr>
              <td style="width:10%;" class="tborder">Size in mm</td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size1' value='<?php echo text($check_res['size1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size2' value='<?php echo text($check_res['size2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size3' value='<?php echo text($check_res['size3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size4' value='<?php echo text($check_res['size4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size5' value='<?php echo text($check_res['size5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size6' value='<?php echo text($check_res['size6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size7' value='<?php echo text($check_res['size7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size8' value='<?php echo text($check_res['size8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size9' value='<?php echo text($check_res['size9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='size10' value='<?php echo text($check_res['size10']); ?>'>
              </td>
            </tr>
            <tr>
              <td class="tborder">Reaction</td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction1' value='<?php echo text($check_res['reaction1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction2' value='<?php echo text($check_res['reaction2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction3' value='<?php echo text($check_res['reaction3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction4' value='<?php echo text($check_res['reaction4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction5' value='<?php echo text($check_res['reaction5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction6' value='<?php echo text($check_res['reaction6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction7' value='<?php echo text($check_res['reaction7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction8' value='<?php echo text($check_res['reaction8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction9' value='<?php echo text($check_res['reaction9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='reaction10' value='<?php echo text($check_res['reaction10']); ?>'>
              </td>
            </tr>
          </table>
          <br>
          <br>

          <table class="form_1" style="width:100%;">
            <tr>
              <td style="width:30%;" class="tborder">Medication</td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication1' value='<?php echo text($check_res['medication1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication2' value='<?php echo text($check_res['medication2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication3' value='<?php echo text($check_res['medication3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication4' value='<?php echo text($check_res['medication4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication5' value='<?php echo text($check_res['medication5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication6' value='<?php echo text($check_res['medication6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication7' value='<?php echo text($check_res['medication7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication8' value='<?php echo text($check_res['medication8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication9' value='<?php echo text($check_res['medication9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='medication10' value='<?php echo text($check_res['medication10']); ?>'>
              </td>
            </tr>
            <tr>
              <td class="tborder">Nurse Initial</td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse1' value='<?php echo text($check_res['nurse1']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse2' value='<?php echo text($check_res['nurse2']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse3' value='<?php echo text($check_res['nurse3']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse4' value='<?php echo text($check_res['nurse4']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse5' value='<?php echo text($check_res['nurse5']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse6' value='<?php echo text($check_res['nurse6']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse7' value='<?php echo text($check_res['nurse7']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse8' value='<?php echo text($check_res['nurse8']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse9' value='<?php echo text($check_res['nurse9']); ?>'>
              </td>
              <td class="tborder">
                <input class="bor_wid" type='text' name='nurse10' value='<?php echo text($check_res['nurse10']); ?>'>
              </td>
            </tr>
          </table>

          <div class="btndiv">
          <input type="submit" name="sub" value="Submit" class="subbtn">
          <button class="cancel" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
          </div>

    </form>
        </div>
      </div>
    </div>
  </body>
  <script>
    $('.yes_no').on('change', function() {
    $('.yes_no').not(this).prop('checked', false)
    });
    $('.yes_no1').on('change', function() {
    $('.yes_no1').not(this).prop('checked', false)
    });
  </script>
</html>
