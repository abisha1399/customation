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
    $sql = "SELECT * FROM `form_cows` WHERE id=? AND pid = ? AND encounter = ?";
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
<title><?php echo xlt("Form COWS"); ?></title>
	<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>COWS</title>
      <!-- Latest compiled and minified CSS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
      <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <style type="text/css">
    	input[type=text] {
          border: none;
          border-bottom: 2px solid black;
}
input[type=date] {
          border: none;
          border-bottom: 2px solid black;
}
input[type=time] {
          border: none;
          border-bottom: 2px solid black;
}
h4{
   font-size: 18px;
}
.bt{
	width: 100px;
    margin: auto;
    margin-top: 10px;
    display: flex;
}
.container{
	border: 2px solid black;
}
b{
	font-size: 13px;
}
table td{
    border-top: 1px none white;
    border-top-width: 1px;
    border-top-style: none;
    border-top-color: rgb(222, 226, 230);
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
.no2{
  padding-right:35px;
}
.no3{
  padding-right:35px;
}
.no4{
  padding-right:35px;
}
.no5{
  padding-right:35px;
}
.no6{
  padding-right:35px;
}
.no7{
  padding-right:35px;
}
.no8{
  padding-right:35px;
}
    </style>
</head>
<body>
 <div class="container mt-3">
  <div class="container-fluid">
    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/form_cows/save.php?id=<?php echo attr_url($formid); ?>">
    <div class="row">
       <table class="table ">
           <thead>
               <tr>
                 <td><h4>Clinical Opiate Withdraw Scale(COWS)<h4></td>
               </tr>
               <tr>
               <td colspan='4'><h4>Opiate Withdraw Scale</h4><td>
               <td colspan='8'><h4>Name:<input type="text" name='name' value="<?php echo text($check_res['name']); ?>"></h4><td>
               </tr>
               <tr>
                 <td><h4></td>
               </tr>
               <tr>
               <td colspan='4'><h4>(COWS)</h4><td>
               <td colspan='8'><h4>DOB:<input type="date" name='dob' value="<?php echo text($check_res['dob']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
               <input type="checkbox" class="radio_change gender" data-id="gender"  value="1"
               <?php
                if($check_res['mf']=="1"){
                 echo "checked";
                }
              ?>
               >M<input type="checkbox"  class="radio_change gender" data-id="gender" value="2"
               <?php
                 if($check_res['mf']=="2"){
                  echo "checked";
                 }
               ?>
               >F</h4>
               <input type="hidden" id="gender" name='mf' value="<?php echo $check_res['mf']??''; ?>">
               <td>
               </tr>
               <br/>
               <tr>
                 <td colspan='5' style="border:1px solid black"><h4>Ratings:<h4><br/>
                  <h5>0 <input type="checkbox" class="radio_change rating" data-id="rating" value="0" <?php echo isset($check_res['rating'])&&$check_res['rating']=='0'?'checked':''; ?>>&nbsp;&nbsp;&nbsp;
                    1 <input type="checkbox" class="radio_change rating" data-id="rating" value="1" <?php echo isset($check_res['rating'])&&$check_res['rating']==1?'checked':''; ?>>&nbsp;&nbsp;&nbsp;
                    2<input type="checkbox" class="radio_change rating" data-id="rating" value="2" <?php echo isset($check_res['rating'])&&$check_res['rating']==2?'checked':''; ?>>
                    3 <input type="checkbox" class="radio_change rating" data-id="rating" value="3" <?php echo isset($check_res['rating'])&&$check_res['rating']==3?'checked':''; ?>>
                    4 <input type="checkbox" class="radio_change rating" data-id="rating" value="4" <?php echo isset($check_res['rating'])&&$check_res['rating']==4?'checked':''; ?>>&nbsp;&nbsp;&nbsp;
                    5 <input type="checkbox" class="radio_change rating" data-id="rating" value="5" <?php echo isset($check_res['rating'])&&$check_res['rating']==5?'checked':''; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    6 <input type="checkbox" class="radio_change rating" data-id="rating" value="6" <?php echo isset($check_res['rating'])&&$check_res['rating']==6?'checked':''; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                    7 <input type="checkbox" class="radio_change rating" data-id="rating" value="7" <?php echo isset($check_res['rating'])&&$check_res['rating']==7?'checked':''; ?>></h5>
                  <h5>Nill mind moderate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;severe&nbsp;&nbsp;&nbsp;very&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;severe</h5>
                  <input type="hidden" name="rating" id="rating" value="<?php echo $check_res['rating']??''; ?>">
                </td>
                 <td colspan='7' style="border:1px solid black">
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
               <tr>
                 <td colspan='1' style="border:1px solid black"><h6>Date & Time of Last Use</h6></td>
                 <td colspan='1'style="border:1px solid black"> Date:</td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date1' value='<?php echo text($check_res['date1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date2' value='<?php echo text($check_res['date2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date3' value='<?php echo text($check_res['date3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date4' value='<?php echo text($check_res['date4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date5' value='<?php echo text($check_res['date5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date6' value='<?php echo text($check_res['date6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date7' value='<?php echo text($check_res['date7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date8' value='<?php echo text($check_res['date8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date9' value='<?php echo text($check_res['date9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> <input style="width:50px" type='text' name='date10' value='<?php echo text($check_res['date10']); ?>'></td>
                 </tr>
                 <tr>
                 <td colspan='1' style="border:1px solid black"> <b>Date:&nbsp;&nbsp;&nbsp;&nbsp;</b><input type='date' name='dobs' value='<?php echo text($check_res['dobs']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"> Time:</td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee1' value='<?php echo text($check_res['timee1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee2' value='<?php echo text($check_res['timee2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee3' value='<?php echo text($check_res['timee3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee4' value='<?php echo text($check_res['timee4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee5' value='<?php echo text($check_res['timee5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee6' value='<?php echo text($check_res['timee6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee7' value='<?php echo text($check_res['timee7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee8' value='<?php echo text($check_res['timee8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee9' value='<?php echo text($check_res['timee9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='timee10' value='<?php echo text($check_res['timee10']); ?>'></td>
                 </tr>
                 <tr>
                 <td colspan='1' style="border:1px solid black"> <b>Time:&nbsp;&nbsp;&nbsp;&nbsp;</b><input type='time' name='times' value='<?php echo text($check_res['times']); ?>'></td>
                 <td colspan='1'style="border:1px solid black">BALs:</td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal1' value='<?php echo text($check_res['bal1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal2' value='<?php echo text($check_res['bal2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal3' value='<?php echo text($check_res['bal3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal4' value='<?php echo text($check_res['bal4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal5' value='<?php echo text($check_res['bal5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal6' value='<?php echo text($check_res['bal6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal7' value='<?php echo text($check_res['bal7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal8' value='<?php echo text($check_res['bal8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal9' value='<?php echo text($check_res['bal9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='bal10' value='<?php echo text($check_res['bal10']); ?>'></td>
                 </tr>

              <br/>
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

                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest1' value='<?php echo text($check_res['rest1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest2' value='<?php echo text($check_res['rest2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest3' value='<?php echo text($check_res['rest3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest4' value='<?php echo text($check_res['rest4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest5' value='<?php echo text($check_res['rest5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest6' value='<?php echo text($check_res['rest6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest7' value='<?php echo text($check_res['rest7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest8' value='<?php echo text($check_res['rest8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest9' value='<?php echo text($check_res['rest9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='rest10' value='<?php echo text($check_res['rest10']); ?>'></td>
            </tr>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Sweating:</b>over past 1/2 hour not accounted<br/>
                  for by room temp or patient activity<br/>
                  <b>0</b> no report of chills or flushing<br/>
                  <b>1</b> subjective report of chills or flushing<br/>
                  <b>2</b> flushed or observable moistness on face<br/>
                  <b>3</b> beads of sweat on brow or face<br/>
                  <b>4</b> sweating streaming off face<br/>
                </p>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat1' value='<?php echo text($check_res['sweat1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat2' value='<?php echo text($check_res['sweat2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat3' value='<?php echo text($check_res['sweat3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat4' value='<?php echo text($check_res['sweat4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat5' value='<?php echo text($check_res['sweat5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat6' value='<?php echo text($check_res['sweat6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat7' value='<?php echo text($check_res['sweat7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat8' value='<?php echo text($check_res['sweat8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat9' value='<?php echo text($check_res['sweat9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='sweat10' value='<?php echo text($check_res['sweat10']); ?>'></td>
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
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless1' value='<?php echo text($check_res['restless1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless2' value='<?php echo text($check_res['restless2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless3' value='<?php echo text($check_res['restless3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless4' value='<?php echo text($check_res['restless4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless5' value='<?php echo text($check_res['restless5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless6' value='<?php echo text($check_res['restless6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless7' value='<?php echo text($check_res['restless7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless8' value='<?php echo text($check_res['restless8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless9' value='<?php echo text($check_res['restless9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='restless10' value='<?php echo text($check_res['restless10']); ?>'></td>
            </tr>




            <tr>
                 <td><h4>Clinical Opiate Withdraw Scale(COWS)<h4></td>
               </tr>
               <tr>
               <td colspan='4'><h4></h4><td>
               <td colspan='8'><h4>Name:<input type="text" name='names' value="<?php echo text($check_res['names']); ?>"></h4><td>
               </tr>
               <tr>
                 <td><h4></td>
               </tr>
               <tr>
               <td colspan='4'><h4></h4><td>
               <td colspan='8'><h4>DOB:<input type="date" name='dobss' value="<?php echo text($check_res['dobss']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
               <input type="checkbox"  class="radio_change gender1"  data-id="gender1" value="1"
               <?php
                if($check_res['mf1']=="1"){
                 echo "checked";
                }
              ?>
               >M<input type="checkbox" class="radio_change gender1"  data-id="gender1" value="2"
               <?php
                if($check_res['mf1']=="2"){
                 echo "checked";
                }
              ?>
               >F</h4>
               <input type="hidden" name='mf1' id="gender1" value="<?php echo $check_res['mf1']??'';?>">
               <td>
               <!-- <td colspan='6'><h4><input type="checkbox" name='name' value="dob">M <input type="checkbox" name='name' value="dob">F</h4><td> -->

               </tr>
               <br/>

              <br/>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Anxienty or Irritability</b><br/>
                  <b>0</b>none<br/>
                  <b>1</b>patient report increasing irritability or<br/>anxiousness<br/>
                  <b>2</b>patient obviously/anxious<br/>
                  <b>4</b>patient so irritable or anxious that participation<br/>
                  in the assessment is difficult
                </p>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty1' value='<?php echo text($check_res['anxienty1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty2' value='<?php echo text($check_res['anxienty2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty3' value='<?php echo text($check_res['anxienty3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty4' value='<?php echo text($check_res['anxienty4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty5' value='<?php echo text($check_res['anxienty5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty6' value='<?php echo text($check_res['anxienty6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty7' value='<?php echo text($check_res['anxienty7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty8' value='<?php echo text($check_res['anxienty8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty9' value='<?php echo text($check_res['anxienty9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='anxienty10' value='<?php echo text($check_res['anxienty10']); ?>'></td>
            </tr>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Gooseflesh:</b><br/>
                  <b>0</b> skin is smooth<br/>
                  <b>3</b>piloerection of skin can be felt or hairs<br/>
                  standing up on arms<br/>
                  <b>4</b>prominent piloerectoin<br/>
                </p>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose1' value='<?php echo text($check_res['goose1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose2' value='<?php echo text($check_res['goose2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose3' value='<?php echo text($check_res['goose3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose4' value='<?php echo text($check_res['goose4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose5' value='<?php echo text($check_res['goose5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose6' value='<?php echo text($check_res['goose6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose7' value='<?php echo text($check_res['goose7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose8' value='<?php echo text($check_res['goose8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose9' value='<?php echo text($check_res['goose9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='goose10' value='<?php echo text($check_res['goose10']); ?>'></td>
            </tr>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>TOTAL SCORE:</b><br/>
                  <b>5-12=mild</b> <br/>
                  <b>13-24=moderate</b><br/>
                  <b>25-36=moderately severe</b> <br/>
                  <b>37 or greater=severe withdrawal</b><br/>
                </p>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total1' value='<?php echo text($check_res['total1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total2' value='<?php echo text($check_res['total2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total3' value='<?php echo text($check_res['total3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total4' value='<?php echo text($check_res['total4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total5' value='<?php echo text($check_res['total5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total6' value='<?php echo text($check_res['total6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total7' value='<?php echo text($check_res['total7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total8' value='<?php echo text($check_res['total8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total9' value='<?php echo text($check_res['total9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='total10' value='<?php echo text($check_res['total10']); ?>'></td>
            </tr>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Blood Pressure:</b><br/>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood1' value='<?php echo text($check_res['blood1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood2' value='<?php echo text($check_res['blood2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood3' value='<?php echo text($check_res['blood3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood4' value='<?php echo text($check_res['blood4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood5' value='<?php echo text($check_res['blood5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood6' value='<?php echo text($check_res['blood6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood7' value='<?php echo text($check_res['blood7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood8' value='<?php echo text($check_res['blood8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood9' value='<?php echo text($check_res['blood9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='blood10' value='<?php echo text($check_res['blood10']); ?>'></td>
            </tr>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Pulse:</b><br/>
                </p>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse1' value='<?php echo text($check_res['pulse1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse2' value='<?php echo text($check_res['pulse2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse3' value='<?php echo text($check_res['pulse3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse4' value='<?php echo text($check_res['pulse4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse5' value='<?php echo text($check_res['pulse5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse6' value='<?php echo text($check_res['pulse6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse7' value='<?php echo text($check_res['pulse7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse8' value='<?php echo text($check_res['pulse8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse9' value='<?php echo text($check_res['pulse9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pulse10' value='<?php echo text($check_res['pulse10']); ?>'></td>
            </tr>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Temperature:</b><br/>
                </p>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature1' value='<?php echo text($check_res['temperature1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature2' value='<?php echo text($check_res['temperature2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature3' value='<?php echo text($check_res['temperature3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature4' value='<?php echo text($check_res['temperature4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature5' value='<?php echo text($check_res['temperature5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature6' value='<?php echo text($check_res['temperature6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature7' value='<?php echo text($check_res['temperature7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature8' value='<?php echo text($check_res['temperature8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature9' value='<?php echo text($check_res['temperature9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='temperature10' value='<?php echo text($check_res['temperature10']); ?>'></td>
            </tr>
            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Respirations:</b><br/>
                </p>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations1' value='<?php echo text($check_res['respirations1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations2' value='<?php echo text($check_res['respirations2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations3' value='<?php echo text($check_res['respirations3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations4' value='<?php echo text($check_res['respirations4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations5' value='<?php echo text($check_res['respirations5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations6' value='<?php echo text($check_res['respirations6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations7' value='<?php echo text($check_res['respirations7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations8' value='<?php echo text($check_res['respirations8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations9' value='<?php echo text($check_res['respirations9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='respirations10' value='<?php echo text($check_res['respirations10']); ?>'></td>
            </tr>


            <tr>
              <td colspan='1'  style="border:1px solid black">
                <p>
                  <b>Pupils:</b><br/>
                  <p>Reacts   +Brisk B <br/>no reaction -
                     sluggish s</p>
                  <br/>
                </p>
               </td>
               <td colspan='1'  style="border:1px solid black">Size in mm<br/>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils1' value='<?php echo text($check_res['pupils1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils2' value='<?php echo text($check_res['pupils2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils3' value='<?php echo text($check_res['pupils3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils4' value='<?php echo text($check_res['pupils4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils5' value='<?php echo text($check_res['pupils5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils6' value='<?php echo text($check_res['pupils6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils7' value='<?php echo text($check_res['pupils7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils8' value='<?php echo text($check_res['pupils8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils9' value='<?php echo text($check_res['pupils9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='pupils10' value='<?php echo text($check_res['pupils10']); ?>'></td>
                </td>
               </tr>
               <tr>
               <td colspan='1'  style="border:1px solid black">
                <p></p>
               </td>
                <td colspan='1'  style="border:1px solid black">Reaction<br/>
                <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction1' value='<?php echo text($check_res['reaction1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction2' value='<?php echo text($check_res['reaction2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction3' value='<?php echo text($check_res['reaction3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction4' value='<?php echo text($check_res['reaction4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction5' value='<?php echo text($check_res['reaction5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction6' value='<?php echo text($check_res['reaction6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction7' value='<?php echo text($check_res['reaction7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction8' value='<?php echo text($check_res['reaction8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction9' value='<?php echo text($check_res['reaction9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='reaction10' value='<?php echo text($check_res['reaction10']); ?>'></td>
                </td>
            </tr>

            <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Medication:</b><br/>
                </p>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication1' value='<?php echo text($check_res['medication1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication2' value='<?php echo text($check_res['medication2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication3' value='<?php echo text($check_res['medication3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication4' value='<?php echo text($check_res['medication4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication5' value='<?php echo text($check_res['medication5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication6' value='<?php echo text($check_res['medication6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication7' value='<?php echo text($check_res['medication7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication8' value='<?php echo text($check_res['medication8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication9' value='<?php echo text($check_res['medication9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='medication10' value='<?php echo text($check_res['medication10']); ?>'></td>
            </tr>
             <tr>
              <td colspan='2'  style="border:1px solid black">
                <p>
                  <b>Nurse Initial:</b><br/>
                </p>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse1' value='<?php echo text($check_res['nurse1']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse2' value='<?php echo text($check_res['nurse2']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse3' value='<?php echo text($check_res['nurse3']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse4' value='<?php echo text($check_res['nurse4']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse5' value='<?php echo text($check_res['nurse5']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse6' value='<?php echo text($check_res['nurse6']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse7' value='<?php echo text($check_res['nurse7']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse8' value='<?php echo text($check_res['nurse8']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse9' value='<?php echo text($check_res['nurse9']); ?>'></td>
                 <td colspan='1'style="border:1px solid black"><input style="width:50px" type='text' name='nurse10' value='<?php echo text($check_res['nurse10']); ?>'></td>
            </tr>
           </thead>
       </table>


   <div class="btn-group bt" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-primary btn-save" style="margin-left: 50px;"><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>
    </form>
    </div>
   </div>
  </div>
</body>
</html>
<script>
$('.radio_change').on('change',function(){
        var checkbox_class= $(this).attr('data-id');
        if($(this).is(":checked"))
        {
            $('.'+checkbox_class).prop('checked',false);
            $(this).prop('checked',true);
            $('#'+checkbox_class).val($(this).val());
        }
        else{
            $('#'+checkbox_class).val('');
        }
    })
</script>

