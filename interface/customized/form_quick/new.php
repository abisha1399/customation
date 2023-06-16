
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
    $sql = "SELECT * FROM `form_quick` WHERE id=? AND pid = ? AND encounter = ?";
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
<style>
    input[type="checkbox"] {
    width: 150px;
}
.switch {
    position: relative;
    display: inline-block;
    width: 90px;
    height: 34px;
    }

.switch input {display:none;}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: grey;
-webkit-transition: .4s;
transition: .4s;
}

.slider:before {
position: absolute;
content: "";
height: 26px;
width: 26px;
left: 4px;
bottom: 4px;
background-color: white;
-webkit-transition: .4s;
transition: .4s;
}

input:checked + .slider {
background-color: #2ab934;
}

input:focus + .slider {
box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
-webkit-transform: translateX(55px);
-ms-transform: translateX(55px);
transform: translateX(55px);
}

/*------ ADDED CSS ---------*/
.on
{
display: none;
}

.on, .off
{
color: white;
position: absolute;
transform: translate(-50%,-50%);
top: 50%;
left: 50%;
font-size: 10px;
font-family: Verdana, sans-serif;
}

input:checked+ .slider .on
{display: block;}

input:checked + .slider .off
{display: none;}

/*--------- END --------*/

/* Rounded sliders */
.slider.round {
border-radius: 34px;
}

.slider.round:before {
border-radius: 50%;
}

.contenbg{
    background-color: #00BFFF ;
    border-radius: 8px;
    padding-right: 2px;
    padding-left: 3px;
    text-decoration: none !important;
    font-size: 14px;
    
}

</style>

<body>
    <div class="container mt-3">
        <div class="row">
          <div  style="border:1px solid black;" class="container-fluid">
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/form_quick/save.php?id=<?php echo attr_url($formid); ?>">


<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" name="name0" value="<?php echo text($check_res['name0']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" value="<?php echo text($check_res['date1']);?>" name="date1" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br><br><br>
<h2 style="text-align:center;">MD/RN Ouick Guide on Assessment</h2><br>
<h6>(PLACE tHIS FORM IN MAR!)
</h6>
<br><br>
<table style="width:100%">
    <tr>
        <td style="width:600px;">
       <p>Does patient have access to firearms?</p>
        </td>
        <td style="width:400px;">
        <div class="form-group">
            
            <label class="switch">
                            <input type="checkbox" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked";}?>   name="checkbox1">
                            <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="on">YES</span>
                                            <span class="off">NO</span>
                                            <!--END-->
                            </div>        </td>

</tr>

<tr>
        <td style="width:600px;">
       <p>If yes, was somebody contacted to safely store it away?
</p>
        </td>
        <td style="width:400px;">
        <div class="form-group">
            
            <label class="switch">
                            <input type="checkbox" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked";}?>   name="checkbox2">
                            <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="on">YES</span>
                                            <span class="off">NO</span>
                                            <!--END-->
                            </div>        </td>

</tr>
<tr>
        <td style="width:600px;">
       <p>Does patient still have access to alcohol, opiates, benzo, etc'?
</p>
        </td>
        <td style="width:400px;">
        <div class="form-group">
            
            <label class="switch">
                            <input type="checkbox" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked";}?>   name="checkbox3">
                            <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="on">YES</span>
                                            <span class="off">NO</span>
                                            <!--END-->
                            </div>        </td>

</tr>
<tr>
        <td style="width:600px;">
       <p>If yes, was somebody contacted to discard of the substances?



</p>
        </td>
        <td style="width:400px;">
        <div class="form-group">
            
            <label class="switch">
                            <input type="checkbox" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked";}?>   name="checkbox4">
                            <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="on">YES</span>
                                            <span class="off">NO</span>
                                            <!--END-->
                            </div>        </td>

</tr>

</table><br><br>
<table><tr><td>
    <p>Who is picking patient up on a daily basis?
                            </p><br>
Name:<input type="text" name="name1" style="border:none;border-bottom:1px solid black;" value="<?php echo text($check_res['name1']);?>"/><br>
Relationship to Patient:<input type="text" name="rel1" value="<?php echo text($check_res['rel1']);?>" style="border:none;border-bottom:1px solid black;"/><br>
Phone Number:<input type="text" name="num1" value="<?php echo text($check_res['num1']);?>" style="border:none;border-bottom:1px solid black;"/><br>
                            </td></tr>
                            </table>
                            <table><tr><td>

Name:<input type="text" name="name2" value="<?php echo text($check_res['name2']);?>" style="border:none;border-bottom:1px solid black;"/><br>
Relationship to Patient:<input type="text" value="<?php echo text($check_res['rel2']);?>" name="rel2" style="border:none;border-bottom:1px solid black;"/><br>
Phone Number:<input type="text" name="num2" value="<?php echo text($check_res['num2']);?>" style="border:none;border-bottom:1px solid black;"/><br>
                            </td></tr></table>


                            <h2>MD end RN must be made aware if Yes is circled to any question rind DOCUMENT!!!!</h2><br>

                           <p> Does patient have PCP? </p> <div class="form-group">
            
            <label class="switch">
                            <input type="checkbox" value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked";}?>   name="checkbox5">
                            <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="on">YES</span>
                                            <span class="off">NO</span>
                                            <!--END-->
                            </label>
                            </div>
                            </div> 

<p>
                            (if no, p1euse havc clinical staff find a PCP for thc paticnt and make an appointment after detox. Appointment times are to be put on the moster  tx plan at time of discharge  per Dr C. <b>ALL  PATIENTS  MUST  HAVE  A PCP WHEN LEAVIN G HERE FOR DETOX)</b></p><br><br>

*ALL NEW PATIENT'S MUST HAVE BLOODWORK DONE THAT IS MARKED ON ORDER SHEET (UNLESS THEY REFUSE IT). PLEASE CALL THE NUMBER ON THE BOTTOM OF THE WHITE BOARD TO HAVE A PHLEBOTOMIST COME TO  THE  CENTER.  THEY  ONLY  COME  DURING  WEEKDAYS.  TF  YOU  HAVE ANY OUESTIONS, PLEASE CALL VICTOR. *
<p></p>
<br><br>
            
            






                            
<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit"  name="sub" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button><br><br>



</form>
</div>
</div>
</div>
</body>
</html>    
