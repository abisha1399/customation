
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
    $sql = "SELECT * FROM `form_ciwa` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>


</head>

<body>
    <div class="container mt-3">
        <div class="row">
          <div  style="border:1px solid black;" class="container-fluid">
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/form_ciwa/save.php?id=<?php echo attr_url($formid); ?>">
<table style="width:100%">
<tr>
    <td style="width:50%">
    <h4>Alcohol and Drug Service CIWA-Ar</h4>
</td>

    <td style="width:50%">
<b style="font-size:18px;">Name:</b><input style="width:150px;border:none;border-bottom:1px solid black;" type="text" value="<?php echo text($check_res['input1']);?>" name="input1" />
</td>
</tr>
<tr>
    <td style="width:50%">
</td>

    <td style="width:50%">
<b style="font-size:18px;">DOB:</b><input style="width:150px;border:none;border-bottom:1px solid black;" type="date" value="<?php echo text($check_res['input2']);?>" name="input2" />
 <b style="font-size:18px;">
   M <input type="checkbox" class="radio_change gender" data-id="gender" value="male" <?php echo isset($check_res['gender'])&&$check_res['gender']=='male'?'checked':''; ?>>
   F <input type="checkbox" class="radio_change gender" data-id="gender" value="female" <?php echo isset($check_res['gender'])&&$check_res['gender']=='female'?'checked':''; ?>></b>
   <input type="hidden" name="gender" id="gender" value="<?php echo $check_res['gender']??''; ?>">
</td>
</tr>

</table><br>
<h3 style="text-align:center;">Alcohol Withdrawal Scale</h3>
<br>
<h3 style="text-align:center;">(CIWA-Ar)</h3>
<div class="container">
                    <div class="row justify-content-md-center">
                <div class="col-lg-offset-1 col-lg-5">
  <table class="table table-borderless">
    <tbody style="width:100%;border:1px solid black;">
      <tr>
        <td colspan="3" style="width:100%;">
      0 <input type="checkbox" class="radio_change rating" data-id="rating" value="0" <?php echo isset($check_res['rating'])&&$check_res['rating']=='0'?'checked':''; ?>>&nbsp;&nbsp;&nbsp;
                    1 <input type="checkbox" class="radio_change rating" data-id="rating" value="1" <?php echo isset($check_res['rating'])&&$check_res['rating']==1?'checked':''; ?>>&nbsp;&nbsp;&nbsp;
                    2<input type="checkbox" class="radio_change rating" data-id="rating" value="2" <?php echo isset($check_res['rating'])&&$check_res['rating']==2?'checked':''; ?>>
                    3 <input type="checkbox" class="radio_change rating" data-id="rating" value="3" <?php echo isset($check_res['rating'])&&$check_res['rating']==3?'checked':''; ?>>
                    4 <input type="checkbox" class="radio_change rating" data-id="rating" value="4" <?php echo isset($check_res['rating'])&&$check_res['rating']==4?'checked':''; ?>>&nbsp;&nbsp;&nbsp;
                    5 <input type="checkbox" class="radio_change rating" data-id="rating" value="5" <?php echo isset($check_res['rating'])&&$check_res['rating']==5?'checked':''; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    6 <input type="checkbox" class="radio_change rating" data-id="rating" value="6" <?php echo isset($check_res['rating'])&&$check_res['rating']==6?'checked':''; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                    7 <input type="checkbox" class="radio_change rating" data-id="rating" value="7" <?php echo isset($check_res['rating'])&&$check_res['rating']==7?'checked':''; ?>></h5>
                  <p><b>Nill mind moderate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;severe&nbsp;&nbsp;&nbsp;very&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;severe</b></p>
                  <input type="hidden" name="rating" id="rating" value="<?php echo $check_res['rating']??''; ?>">
                  </td>
                </tr>
      <!-- <tr>
        <td>Nil</td>
        <td>mild</td>
        <td>moderate</td>
        <td>Severe</td>
        <td>very</td>
        <td>Severe</td>
      </tr> -->
        <!-- <td style="width:7%"><p style="font-size:16px;font-weight:bolder;">0 <input type="checkbox" class="radio_change rating" data-id="rating" value="0" <?php echo isset($check_res['rating'])&&$check_res['rating']=='0'?'checked':''; ?>></p>Nil</td>
        <td style="width:7%"><p style="font-size:16px;font-weight:bolder;">1 <input type="checkbox" class="radio_change rating" data-id="rating" value="1" <?php echo isset($check_res['rating'])&&$check_res['rating']=='1'?'checked':''; ?>></p> mild</b></td>
        <td style="width:7%"><p style="font-size:16px;font-weight:bolder;">2 <input type="checkbox" class="radio_change rating" data-id="rating" value="2" <?php echo isset($check_res['rating'])&&$check_res['rating']=='2'?'checked':''; ?>>&nbsp;
         3<input type="checkbox" class="radio_change rating" data-id="rating" value="3" <?php echo isset($check_res['rating'])&&$check_res['rating']=='3'?'checked':''; ?>></p> moderate</b></td>
        <td style="width:7%"><p style="font-size:16px;font-weight:bolder;">4<input type="checkbox" class="radio_change rating" data-id="rating" value="4" <?php echo isset($check_res['rating'])&&$check_res['rating']=='4'?'checked':''; ?>></p> </b></td>
        <td style="width:7%"><p style="font-size:16px;font-weight:bolder;">5<input type="checkbox" class="radio_change rating" data-id="rating" value="5" <?php echo isset($check_res['rating'])&&$check_res['rating']=='5'?'checked':''; ?>></p>Severe</td>
        <td style="width:7%"><p style="font-size:16px;font-weight:bolder;">6<input type="checkbox" class="radio_change rating" data-id="rating" value="6" <?php echo isset($check_res['rating'])&&$check_res['rating']=='6'?'checked':''; ?>>
         &nbsp;7<input type="checkbox" class="radio_change rating" data-id="rating" value="7" <?php echo isset($check_res['rating'])&&$check_res['rating']=='7'?'checked':''; ?>></p>verysevere</b></td>

      </tr> -->
    </tbody>
  </table>
</div>
      <div class="col-lg-offset-1 col-lg-5">
      <table class="table table-borderless">
      <tbody style="width:100%;border:1px solid black;">


      <tr>

<img  style="border:1px solid black;"src="uploads/pupil.png" width:400px height:300px/>
      </tr>
    </tbody>
  </table>
</div></div><br>
<tr>
  <br>
  <table style="width:1000px;border:1px solid black;" class="tabel table-bordered">
    <tr>
      <td>  <b style="text-align:center;">Date and Time of Last Use</b>


      <td><b>Date<b></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input5']);?>" style="width:80px;border:1px solid black;" type="date" name="input5"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input6']);?>" style="width:80px;border:1px solid black;" type="date" name="input6"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input7']);?>" style="width:80px;border:1px solid black;" type="date" name="input7"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input7_1']);?>" style="width:80px;border:1px solid black;" type="date" name="input7_1"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input8']);?>" style="width:80px;border:1px solid black;" type="date" name="input8"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input9']);?>" style="width:80px;border:1px solid black;" type="date" name="input9"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input10']);?>" style="width:80px;border:1px solid black;" type="date" name="input10"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input11']);?>" style="width:80px;border:1px solid black;" type="date" name="input11"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input12']);?>" style="width:80px;border:1px solid black;" type="date" name="input12"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input13']);?>" style="width:80px;border:1px solid black;" type="date" name="input13"> </td>

</tr>
<tr>
  <td><b style="font-size:18px;">Date:</b><input style="width:150px;border:none;border-bottom:1px solid black;" type="date" value="<?php echo text($check_res['input3']);?>" name="input3" /><br>
</td>
      <td><b>Time<b></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input14']);?>" style="width:80px;border:1px solid black;" type="text" name="input14"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input15']);?>" style="width:80px;border:1px solid black;" type="text" name="input15"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input16']);?>" style="width:80px;border:1px solid black;" type="text" name="input16"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input17']);?>" style="width:80px;border:1px solid black;" type="text" name="input17"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input18']);?>" style="width:80px;border:1px solid black;" type="text" name="input18"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input19']);?>" style="width:80px;border:1px solid black;" type="text" name="input19"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input20']);?>" style="width:80px;border:1px solid black;" type="text" name="input20"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input21']);?>" style="width:80px;border:1px solid black;" type="text" name="input21"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input22']);?>" style="width:80px;border:1px solid black;" type="text" name="input22"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input23']);?>" style="width:80px;border:1px solid black;" type="text" name="input23"> </td>
</tr>
<tr>
  <td><b style="font-size:18px;">Time:</b><input style="width:150px;border:none;border-bottom:1px solid black;" type="text" name="input4" value="<?php echo text($check_res['input4']);?>" /></td>
</td>
      <td><b>BAL<b></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input24']);?>" style="width:80px;border:1px solid black;" type="text" name="input24"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input25']);?>" style="width:80px;border:1px solid black;" type="text" name="input25"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input26']);?>" style="width:80px;border:1px solid black;" type="text" name="input26"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input27']);?>" style="width:80px;border:1px solid black;" type="text" name="input27"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input28']);?>" style="width:80px;border:1px solid black;" type="text" name="input28"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input29']);?>" style="width:80px;border:1px solid black;" type="text" name="input29"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input30']);?>" style="width:80px;border:1px solid black;" type="text" name="input30"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input31']);?>" style="width:80px;border:1px solid black;" type="text" name="input31"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input32']);?>" style="width:80px;border:1px solid black;" type="text" name="input32"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input33']);?>" style="width:80px;border:1px solid black;" type="text" name="input33"> </td>
</tr>
</table>
<br><br>
<table style="width:100%;border:1px solid black;">
<tr>
  <td style="width:30%;border:1px solid black;">
<b>Nausea and vomiting </b>Ask ,"Do you feel <br>sick to your stomach?Have you<br> vomited"<br>
0  -no nausea or vomiting<br>
1  -mild nausea no vomiting<br>
2<br>
3<br>
4  -intermittent nausea with dry heaves<br>
5<br>
6<br>
7  -constant nausea,dry heaves.vomit

</td>
<td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input34"><?php echo text($check_res['input34']);?></textarea></td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input35"><?php echo text($check_res['input35']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input36"><?php echo text($check_res['input36']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input37"><?php echo text($check_res['input37']);?></textarea>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input38"><?php echo text($check_res['input38']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input39"><?php echo text($check_res['input39']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input40"><?php echo text($check_res['input40']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input41"><?php echo text($check_res['input41']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input42"><?php echo text($check_res['input42']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input43"><?php echo text($check_res['input43']);?></textarea> </td>
</tr><tr>
  <td style="width:30%;border:1px solid black;">
<b>Arms</b> extended  and fingers<br>Spread apart<br>
0  -no tremors<br>
1  -not visible but can be felt at fingertip<br>
2<br>
3<br>
4  -moderate with arms extended<br>
5<br>
6<br>
7  -severe with arms not attended

</td>
<td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input44"><?php echo text($check_res['input44']);?></textarea></td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input45"><?php echo text($check_res['input45']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input46"><?php echo text($check_res['input46']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input47"><?php echo text($check_res['input47']);?></textarea></td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input48"><?php echo text($check_res['input48']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input49"><?php echo text($check_res['input49']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input50"><?php echo text($check_res['input50']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input51"><?php echo text($check_res['input51']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input52"><?php echo text($check_res['input52']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input53"><?php echo text($check_res['input53']);?></textarea> </td>
</tr>
<tr>
  <td style="width:30%;border:1px solid black;">
</td>
<td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input54"><?php echo text($check_res['input54']);?></textarea></td>
      <td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input55"><?php echo text($check_res['input55']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input56"><?php echo text($check_res['input56']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input57"><?php echo text($check_res['input57']);?></textarea></td>
      <td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input58"><?php echo text($check_res['input58']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input59"><?php echo text($check_res['input59']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input60"><?php echo text($check_res['input60']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input61"><?php echo text($check_res['input61']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input62"><?php echo text($check_res['input62']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;border:1px solid black;" type="text" name="input63"><?php echo text($check_res['input63']);?></textarea> </td>


</table><br><br>
<table style="width:100%">
<tr>
    <td style="width:50%">
    <h4>Alcohol and Drug Service CIWA-Ar</h4>
</td>

    <td style="width:50%">
<b style="font-size:18px;">Name:</b><input style="width:150px;border:none;border-bottom:1px solid black;" type="text" value="<?php echo text($check_res['input64']);?>" name="input64" />
</td>
</tr>
<tr>
    <td style="width:50%">
</td>

    <td style="width:50%">
<b style="font-size:18px;">DOB:</b><input value="<?php echo text($check_res['input65']);?>" style="width:150px;border:none;border-bottom:1px solid black;" type="date" name="input65" />
 <b style="font-size:18px;">
 M <input type="checkbox" class="radio_change gender1" data-id="gender1" value="male" <?php echo isset($check_res['gender1'])&&$check_res['gender1']=='male'?'checked':''; ?>>
   F <input type="checkbox" class="radio_change gender1" data-id="gender1" value="female" <?php echo isset($check_res['gender1'])&&$check_res['gender1']=='female'?'checked':''; ?>></b>
   <input type="hidden" name="gender1" id="gender1" value="<?php echo $check_res['gender1']??''; ?>">
</td>
</tr>

</table><br>
<br>
<table style="width:100%;border:1px solid black;">
<tr>
  <td style="width:30%;border:1px solid black;">
<b>Headche,fullness in head</b>Ask ,"Do you  head feel <br>different? Does it feels like a band around head?"<br>Do you  rate dizziness or light headedness <br>
0  -not present<br>
1  - very mild<br>
2  - mild<br>
1  - moderate<br>
4  - moderate severe<br>
5  - severe<br>
6  - very severe<br>
6  -  extremely severe<br>

</td>
<td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input66"><?php echo text($check_res['input66']);?></textarea></td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input67"><?php echo text($check_res['input67']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input68"><?php echo text($check_res['input68']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input69"><?php echo text($check_res['input69']);?></textarea>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input70"><?php echo text($check_res['input70']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input71"><?php echo text($check_res['input71']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input72"><?php echo text($check_res['input72']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input73"><?php echo text($check_res['input73']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input74"><?php echo text($check_res['input74']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input75"><?php echo text($check_res['input75']);?></textarea> </td>
</tr><tr>
  <td style="width:30%;border:1px solid black;">
<b>Orientation clouding of Sensorium:</b> Ask "what day is it",<BR>where are you,who am I.
0  -Oriented and can do serial additions<br>
1  -cant do  serial additions uncertain about dates<br>
2  -disoriented by date by 2 days<br>
3  -disoriented by date more than day<br>
4  -disoriented of place,and or person<br>

</td>
<td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input76"><?php echo text($check_res['input76']);?></textarea></td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input77"><?php echo text($check_res['input77']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input78"><?php echo text($check_res['input78']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input79"><?php echo text($check_res['input79']);?></textarea></td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input80"><?php echo text($check_res['input80']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input81"><?php echo text($check_res['input81']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input82"><?php echo text($check_res['input82']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input83"><?php echo text($check_res['input83']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input84"><?php echo text($check_res['input84']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input85"><?php echo text($check_res['input85']);?></textarea> </td>
</tr>
</table><br>
<table style="width:100%">
<tr>
    <td style="width:50%">
    <h4>Alcohol and Drug Service CIWA-Ar</h4>
</td>

    <td style="width:50%">
<b style="font-size:18px;">Name:</b><input style="width:150px;border:none;border-bottom:1px solid black;" type="text" value="<?php echo text($check_res['input86']);?>"   name="input86" />
</td>
</tr>
<tr>
    <td style="width:50%">
</td>

    <td style="width:50%">
<b style="font-size:18px;">DOB:</b><input style="width:150px;border:none;border-bottom:1px solid black;" type="date" name="input87" value="<?php echo text($check_res['input87']);?>" />
 <b style="font-size:18px;">
 M <input type="checkbox" class="radio_change gender2" data-id="gender2" value="male" <?php echo isset($check_res['gender2'])&&$check_res['gender2']=='male'?'checked':''; ?>>
   F <input type="checkbox" class="radio_change gender2" data-id="gender2" value="female" <?php echo isset($check_res['gender2'])&&$check_res['gender2']=='female'?'checked':''; ?>></b>
<input type="hidden" name="gender2" id="gender2" value="<?php echo $check_res['gender2']??''; ?>">
</td>
</tr>

</table><br>
<br>
<table style="width:100%;border:1px solid black;">
<tr>
  <td style="width:30%;border:1px solid black;">
<b>Visual Disturbances</b>: Ask, “Does the light appear to be too bright? Is the color different? Does it hurt your eyes? Are you seeing anything that is disturbing you? Are you seeing things you know are not there?”<br>
0  -not present<br>
1  -very mild sensitivity<br>
2  -mild sensitivity<br>
1  -moderate sensitivity<br>
4  -moderately severe hallucinations<br>
5  -severe sensitivity<br>
6  -moderately severe hallucinations<br>
6  -severe sensitivity<br>

</td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input88"><?php echo text($check_res['input88']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input89"><?php echo text($check_res['input89']);?></textarea>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input90"><?php echo text($check_res['input90']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input91"><?php echo text($check_res['input91']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input92"><?php echo text($check_res['input92']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input93"><?php echo text($check_res['input93']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input94"><?php echo text($check_res['input94']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input95"><?php echo text($check_res['input95']);?></textarea> </td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input96"><?php echo text($check_res['input96']);?></textarea></td>
      <td style="width:;"><textarea style="width:80px;height:350px;border:1px solid black;" type="text" name="input97"><?php echo text($check_res['input97']);?></textarea> </td>

</tr>
</table><br><br>
<table style="width:100%;border:1px solid black;">
<tr>
<td style="width:30%;border:1px solid black;">
<b>Total score</b></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input98']);?>" style="width:80px;border:1px solid black;" type="text" name="input98"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input99']);?>" style="width:80px;border:1px solid black;" type="text" name="input99"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input100']);?>" style="width:80px;border:1px solid black;" type="text" name="input100"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input101']);?>" style="width:80px;border:1px solid black;" type="text" name="input101"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input102']);?>" style="width:80px;border:1px solid black;" type="text" name="input102"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input103']);?>" style="width:80px;border:1px solid black;" type="text" name="input103"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input104']);?>" style="width:80px;border:1px solid black;" type="text" name="input104"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input105']);?>" style="width:80px;border:1px solid black;" type="text" name="input105"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input106']);?>" style="width:80px;border:1px solid black;" type="text" name="input106"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input107']);?>" style="width:80px;border:1px solid black;" type="text" name="input107"></td>

</tr>
</table>

<table style="width:100%;border:1px solid black;">
<tr>
<td style="width:30%;border:1px solid black;">
<b>Blood pressure</b></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input108']);?>" style="width:80px;border:1px solid black;" type="text" name="input108"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input109']);?>" style="width:80px;border:1px solid black;" type="text" name="input109"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input110']);?>" style="width:80px;border:1px solid black;" type="text" name="input110"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input111']);?>" style="width:80px;border:1px solid black;" type="text" name="input111"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input112']);?>" style="width:80px;border:1px solid black;" type="text" name="input112"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input113']);?>" style="width:80px;border:1px solid black;" type="text" name="input113"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input114']);?>" style="width:80px;border:1px solid black;" type="text" name="input114"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input115']);?>" style="width:80px;border:1px solid black;" type="text" name="input115"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input116']);?>" style="width:80px;border:1px solid black;" type="text" name="input116"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input117']);?>" style="width:80px;border:1px solid black;" type="text" name="input117"></td>


</tr>
<tr>
<td style="width:30%;border:1px solid black;">
<b>Pulse </b></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input118']);?>" style="width:80px;border:1px solid black;" type="text" name="input118"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input119']);?>" style="width:80px;border:1px solid black;" type="text" name="input119"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input120']);?>" style="width:80px;border:1px solid black;" type="text" name="input120"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input121']);?>" style="width:80px;border:1px solid black;" type="text" name="input121"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input122']);?>" style="width:80px;border:1px solid black;" type="text" name="input122"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input123']);?>" style="width:80px;border:1px solid black;" type="text" name="input123"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input124']);?>" style="width:80px;border:1px solid black;" type="text" name="input124"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input125']);?>" style="width:80px;border:1px solid black;" type="text" name="input125"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input126']);?>" style="width:80px;border:1px solid black;" type="text" name="input126"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input127']);?>" style="width:80px;border:1px solid black;" type="text" name="input127"></td>


</tr>
<tr>
<td style="width:30%;border:1px solid black;">
<b>Temperature</b></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input128']);?>" style="width:80px;border:1px solid black;" type="text" name="input128"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input129']);?>" style="width:80px;border:1px solid black;" type="text" name="input129"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input130']);?>" style="width:80px;border:1px solid black;" type="text" name="input130"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input131']);?>" style="width:80px;border:1px solid black;" type="text" name="input131"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input132']);?>" style="width:80px;border:1px solid black;" type="text" name="input132"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input133']);?>" style="width:80px;border:1px solid black;" type="text" name="input133"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input134']);?>" style="width:80px;border:1px solid black;" type="text" name="input134"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input135']);?>" style="width:80px;border:1px solid black;" type="text" name="input135"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input136']);?>" style="width:80px;border:1px solid black;" type="text" name="input136"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input137']);?>" style="width:80px;border:1px solid black;" type="text" name="input137"></td>


</tr>
<tr>
<td style="width:30%;border:1px solid black;">
<b>Respiration</b></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input138']);?>" style="width:80px;border:1px solid black;" type="text" name="input138"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input139']);?>" style="width:80px;border:1px solid black;" type="text" name="input139"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input140']);?>" style="width:80px;border:1px solid black;" type="text" name="input140"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input141']);?>" style="width:80px;border:1px solid black;" type="text" name="input141"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input142']);?>" style="width:80px;border:1px solid black;" type="text" name="input142"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input143']);?>" style="width:80px;border:1px solid black;" type="text" name="input143"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input144']);?>" style="width:80px;border:1px solid black;" type="text" name="input144"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input145']);?>" style="width:80px;border:1px solid black;" type="text" name="input145"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input146']);?>" style="width:80px;border:1px solid black;" type="text" name="input146"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input147']);?>" style="width:80px;border:1px solid black;" type="text" name="input147"></td>


</tr>
</table><br>
<table style="width:100%;border:1px solid black;">
<tr>
<td style="width:30%;border:1px solid black;">
<b>Pupils
</b><br>
 React+ no reaction-
</td>
<td style="width:30%;border:1px solid black;">
<b>Size in mm
</b><br>
</td>
     <td style="width:100px;"><input value="<?php echo text($check_res['input148']);?>" style="width:80px;border:1px solid black;" type="text" name="input148"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input149']);?>" style="width:80px;border:1px solid black;" type="text" name="input149"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input150']);?>" style="width:80px;border:1px solid black;" type="text" name="input150"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input151']);?>" style="width:80px;border:1px solid black;" type="text" name="input151"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input152']);?>" style="width:80px;border:1px solid black;" type="text" name="input152"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input153']);?>" style="width:80px;border:1px solid black;" type="text" name="input153"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input154']);?>" style="width:80px;border:1px solid black;" type="text" name="input154"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input155']);?>" style="width:80px;border:1px solid black;" type="text" name="input155"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input156']);?>" style="width:80px;border:1px solid black;" type="text" name="input156"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input157']);?>" style="width:80px;border:1px solid black;" type="text" name="input157"></td></tr>
      <tr>
      <td style="width:30%;border:1px solid black;">
Brisk B sluggish s</td>

<td style="width:30%;border:1px solid black;">
<b>Reaction
</b><br>
</td>
     <td style="width:100px;"><input value="<?php echo text($check_res['input158']);?>" style="width:80px;border:1px solid black;" type="text" name="input158"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input159']);?>" style="width:80px;border:1px solid black;" type="text" name="input159"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input160']);?>" style="width:80px;border:1px solid black;" type="text" name="input160"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input161']);?>" style="width:80px;border:1px solid black;" type="text" name="input161"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input162']);?>" style="width:80px;border:1px solid black;" type="text" name="input162"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input163']);?>" style="width:80px;border:1px solid black;" type="text" name="input163"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input164']);?>" style="width:80px;border:1px solid black;" type="text" name="input164"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input165']);?>" style="width:80px;border:1px solid black;" type="text" name="input165"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input166']);?>" style="width:80px;border:1px solid black;" type="text" name="input166"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input167']);?>" style="width:80px;border:1px solid black;" type="text" name="input167"></td></tr>


</table><br><br>
<table style="width:100%;border:1px solid black;">
<tr>
<td style="width:30%;border:1px solid black;">
<b>Medication
</b><br>
</td>
     <td style="width:100px;"><input value="<?php echo text($check_res['input168']);?>" style="width:80px;border:1px solid black;" type="text" name="input168"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input169']);?>" style="width:80px;border:1px solid black;" type="text" name="input169"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input170']);?>" style="width:80px;border:1px solid black;" type="text" name="input170"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input171']);?>" style="width:80px;border:1px solid black;" type="text" name="input171"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input172']);?>" style="width:80px;border:1px solid black;" type="text" name="input172"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input173']);?>" style="width:80px;border:1px solid black;" type="text" name="input173"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input174']);?>" style="width:80px;border:1px solid black;" type="text" name="input174"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input175']);?>" style="width:80px;border:1px solid black;" type="text" name="input175"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input176']);?>" style="width:80px;border:1px solid black;" type="text" name="input176"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input177']);?>" style="width:80px;border:1px solid black;" type="text" name="input177"></td></tr>
      <tr>
      <td style="width:30%;border:1px solid black;">
<b>Nurse Initial
</b><br>
</td>
     <td style="width:100px;"><input value="<?php echo text($check_res['input178']);?>" style="width:80px;border:1px solid black;" type="text" name="input178"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input179']);?>" style="width:80px;border:1px solid black;" type="text" name="input179"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input180']);?>" style="width:80px;border:1px solid black;" type="text" name="input180"></td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input181']);?>" style="width:80px;border:1px solid black;" type="text" name="input181"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input182']);?>" style="width:80px;border:1px solid black;" type="text" name="input182"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input183']);?>" style="width:80px;border:1px solid black;" type="text" name="input183"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input184']);?>" style="width:80px;border:1px solid black;" type="text" name="input184"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input185']);?>" style="width:80px;border:1px solid black;" type="text" name="input185"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input186']);?>" style="width:80px;border:1px solid black;" type="text" name="input186"> </td>
      <td style="width:100px;"><input value="<?php echo text($check_res['input187']);?>" style="width:80px;border:1px solid black;" type="text" name="input187"></td></tr>
</table><br><br>

<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit"  name="sub" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
<br><br>

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
