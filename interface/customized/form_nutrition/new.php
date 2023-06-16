
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
    $sql = "SELECT * FROM `form_nutrition` WHERE id=? AND pid = ? AND encounter = ?";
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
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/form_nutrition/save.php?id=<?php echo attr_url($formid); ?>">

<h2>NUTRITIONAL ASSESSMENT</h2><br><br>



       <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked";}?>>  well nourished&nbsp;
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked";}?>>Malnourished&nbsp;
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked";}?>> Obese&nbsp;
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked";}?>>Indigestion&nbsp;
       


<input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked";}?>> Food Allergies<br>
        <input type="checkbox" name="checkbox6" value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked";}?>>Coffee/Tea intake>5cups a day&nbsp;
        <input type="checkbox" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {
            echo "checked";}?>>soda/caffeine product intake/day<br>
        <input type="checkbox" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {
            echo "checked";}?>>Recent Weight gain(amount):&nbsp;
            <input type="checkbox" name="checkbox9" value="1" <?php if ($check_res['checkbox9'] == "1") {
            echo "checked";}?>> Binging/purging&nbsp;
        <input type="checkbox" name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {
            echo "checked";}?>>Laxative use&nbsp;
        <input type="checkbox" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {
            echo "checked";}?>>Hx choking<br><label>Significant dental cavities</label>
        <input type="checkbox" name="checkbox12" class="radio_change thiacheck checkbox12" value="0" <?php if ($check_res['checkbox12'] == "0") {
            echo "checked";}?>>No&nbsp;
            <input type="checkbox" name="checkbox12" class="radio_change thiacheck checkbox12" value="1" <?php if ($check_res['checkbox12'] == "1") {
            echo "checked";}?>>Yes<br>
        <input type="checkbox" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {
            echo "checked";}?>> Braces&nbsp;
        <input type="checkbox" name="checkbox14" value="1" <?php if ($check_res['checkbox14'] == "1") {
            echo "checked";}?>> Retainers<br>&nbsp;
            <p>Determine whether the patients meet any of the following criteria</p>
        <input type="checkbox" name="checkbox15" class="radio_change thiacheck checkbox15" value="1" <?php if ($check_res['checkbox15'] == "1") {
            echo "checked";}?>>yes&nbsp;
            <input type="checkbox" name="checkbox15"  class="radio_change thiacheck checkbox15" value="0" <?php if ($check_res['checkbox15'] == "0") {
            echo "checked";}?>>No    <b>      Nausea,vomiting,diarrhea,for 3 or more days</b><br>
        <input type="checkbox" name="checkbox16"  class="radio_change thiacheck checkbox16" value="1" <?php if ($check_res['checkbox16'] == "1") {
            echo "checked";}?>>yes&nbsp;
        <input type="checkbox" name="checkbox16"  class="radio_change thiacheck checkbox16" value="0" <?php if ($check_res['checkbox16'] == "0") {
            echo "checked";}?>>no      <b>     Difficulty swallowing</b><br>
        <input type="checkbox" name="checkbox17"  class="radio_change thiacheck checkbox17" value="1" <?php if ($check_res['checkbox17'] == "1") {
            echo "checked";}?>>yes&nbsp;
            <input type="checkbox" name="checkbox17"  class="radio_change thiacheck checkbox17" value="0" <?php if ($check_res['checkbox17'] == "0") {
            echo "checked";}?>>No    <b>  Unintentional weight loss(>10 lbs in last 10 months)</b><br>
              <input type="checkbox" name="checkbox18"  class="radio_change thiacheck checkbox18" value="1" <?php if ($check_res['checkbox18'] == "1") {
            echo "checked";}?>>yes&nbsp;
        <input type="checkbox" name="checkbox18"  class="radio_change thiacheck checkbox18" value="0" <?php if ($check_res['checkbox18'] == "0") {
            echo "checked";}?>>no     <b>   Active eating disorder including laxative use</b><br>
              <input type="checkbox" name="checkbox19"  class="radio_change thiacheck checkbox19" value="1" <?php if ($check_res['checkbox19'] == "1") {
            echo "checked";}?>>yes&nbsp;
        <input type="checkbox" name="checkbox19"  class="radio_change thiacheck checkbox19" value="0" <?php if ($check_res['checkbox19'] == "0") {
            echo "checked";}?>>no     <b>   New onset/uncontrolled diabetes</b><br><br>

<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Favourite foods:</label><input type="text" name="name1" value="<?php echo text($check_res['name1']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
      

</tr>
<tr>
<td style="width:50%;">
    <label>Any additional comments:</label><input type="text" value="<?php echo text($check_res['name2']);?>" name="name2" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br><br><br>
<b>If any other conditions that the above is identified which may  place the patient at potential nutritional risk,MD will be notified</b>










<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit"  name="sub" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button><br><br>



</form>
</div>
</div>
</div>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
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

    $('input.thiacheck').on('click', function() {
    $(this).prop('checked', false);
    $(this).prop('checked', true);
   });
</script>
</html>    
