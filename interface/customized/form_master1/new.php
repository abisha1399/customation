
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
    $sql = "SELECT * FROM `form_master1` WHERE id=? AND pid = ? AND encounter = ?";
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
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/form_master1 /save.php?id=<?php echo attr_url($formid); ?>">


<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" name="name1" value="<?php echo text($check_res['name1']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
      <b>Center For Network Therapy</b>

</tr>
<tr>
<td style="width:50%;">
    <label>DOB:</label><input type="date" value="<?php echo text($check_res['date1']);?>" name="date1" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
</tr>
</table><br><br><br>
<h2 style="text-align:center;">Center For Network Therapy</h2>
<br><br>
<table style="width:100%" class="table table-bordered">
    <tr>
        <td style="width:250px;">
        <b>Diagnosis</b><br>
        <p>Substance Abuse/dependence[include withdraw risk]Ex Heroin,Opiates,Alcohol,Benzo</p>
        </td>
        <td style="width:250px;">
        <b>Target Date</b><br>
        <p ><input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked";}?>>5days</p>
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked";}?>>10days<p></p>
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked";}?>>15days<p></p>
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked";}?>>30days<p></p><br>
        <input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {
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
<td>
<td style="width:250px;">
<b >Target Date:</b><br><input type="date" value="<?php echo text($check_res['tdate']);?>" name="tdate" style="border:none;border-bottom:2px solid black;width:150px;"/><br><br>

<b>New Target Date:</b>(state reason why?Relapse,non-compilance,<b>medical necessity</b>,etc.)
<textarea style="border:none;height:50px;width:200px;" type="text" name="comment1"><?php echo text($check_res['comment1']);?></textarea>
</td>
    </tr>
</table>
<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit"  name="sub" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>



</form>
</div>
</div>
</div>
</body>
</html>    
