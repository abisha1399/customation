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
    $sql = "SELECT * FROM `discharge_summary_phy` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];

}

$check_res = $formid ? $check_res : array();




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <div class="container-fluid">
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/discharge_summary_form_phy/save.php?id=<?php echo attr_url($formid); ?>">

        <table style="border:1px solid black;width:100%" class="table table-bordered" >
            <tr>
                <td style="width:30%; border-right:none;">
                    <label for="">Start Date:</label>
                    <input style="border:none;" type="date" name="input1" value="<?php echo text($check_res['input1']);?>">
                </td>
                <td style="width:30%; border-right:none;">
                    <label for="">Date of Discharge:</label>
                    <input style="border:none;"  type="date" name="input2" value="<?php echo text($check_res['input2']);?>">
                </td>
                <td style="width:30%;">
                    <label for="">DETOX/PCP(circle one):</label>
                    <input style="border:none;"  type="text" name="input3" value="<?php echo text($check_res['input3']);?>">
                </td>
            </tr>

            <tr >
                <td style="width:30%;">
                    <label for="">Client Name:</label>
                    <input style="border:none;" type="text" name="input4" value="<?php echo text($check_res['input4']);?>">
                </td>
                
            </tr>
            <tr >
                <td style="width:30%;">
                    <label for="">Client Address:</label>
                    <input style="border:none;" type="text" name="input5" value="<?php echo text($check_res['input5']);?>">
                </td>
                
            </tr>
            <tr >
                <td style="width:30%;">
                    <label for="">Client Phone Number:</label>
                    <input style="border:none;" type="text" name="input6" value="<?php echo text($check_res['input6']);?>">
                </td>
                
            </tr>
        </table>
        <table style="border:1px solid black;width:100%" class="table table-bordered">
        <div>
            <b>Diagnosis</b>
        <textarea name="comment1" id="" cols="135" rows="10"><?php echo text($check_res['comment1']);?></textarea>
        </div>
        </table>
        <table style="border:1px solid black;width:100%" class="table table-bordered">
             <tr>
                 <td>
                     <b>Reason for Discharge</b> <br>
                     <input type="checkbox" name="checkbox1" value="1" class="radio_change"  <?php if ($check_res['checkbox1'] == "1") {echo "checked";}?>>Successful Completion(Detox) <br>
                     <input type="checkbox" name="checkbox2" value="1" class="radio_change"  <?php if ($check_res['checkbox2'] == "1") {echo "checked";}?>>Successful Completion(partial care treatment) <br>
                     <input type="checkbox" name="checkbox3" value="1" class="radio_change"  <?php if ($check_res['checkbox3'] == "1") {echo "checked";}?>>AMD <br>
                     <input type="checkbox" name="checkbox4" value="1" class="radio_change"  <?php if ($check_res['checkbox4'] == "1") {echo "checked";}?>>Non-Compliance <br>
                     <input type="checkbox" name="checkbox5" value="1" class="radio_change"  <?php if ($check_res['checkbox5'] == "1") {echo "checked";}?>>Administrative Discharge <br>
                     <input type="checkbox" name="checkbox6" value="1" class="radio_change"  <?php if ($check_res['checkbox6'] == "1") {echo "checked";}?>>Others: <br>
                 </td>
             </tr>
        </table>
        <table  style="border:1px solid black;width:100%" class="table table-bordered">
        <tr>
        <!-- <label>Physician Discharge Note:</label><br><br> -->
            <td>
        
<label>Physician Discharge Note:</label><br><br>
<textarea style="border:1px solid black;height:100px;width:100%;height:50px;"  type="text" name="comment2"><?php echo text($check_res['comment2']);?></textarea>
<textarea style="border:1px solid black;height:100px;width:100%;height:50px;"  type="text" name="comment3"><?php echo text($check_res['comment3']);?></textarea>

<textarea style="border:1px solid black;height:100px;width:100%;height:50px;"  type="text" name="comment4"><?php echo text($check_res['comment4']);?></textarea>
<textarea style="border:1px solid black;height:100px;width:100%;height:50px;"  type="text" name="comment5"><?php echo text($check_res['comment5']);?></textarea>
<textarea style="border:1px solid black;height:100px;width:100%;height:50px;"  type="text" name="comment6"><?php echo text($check_res['comment6']);?></textarea>
<textarea style="border:1px solid black;height:100px;width:100%;height:50px;"  type="text" name="comment7"><?php echo text($check_res['comment7']);?></textarea>
<textarea style="border:1px solid black;height:100px;width:100%;height:50px;"  type="text" name="comment8"><?php echo text($check_res['comment8']);?></textarea>
<textarea style="border:1px solid black;height:100px;width:100%;height:50px;"  type="text" name="comment9"><?php echo text($check_res['comment9']);?></textarea>

</td>




</tr>
    
        </table>
        <input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit" name="sub" value="Submit" >
        <button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>

    </form>
        </div>
      </div>
</div>
</body>
</html>

<script>
        $('.radio_change').on('change',function(){
        //var checkbox_class= $(this).attr('data-id');
        if($(this).is(":checked"))
        {
            $('.radio_change').prop('checked',false);
            $(this).prop('checked',true);
            // $('#'+checkbox_class).val($(this).val());
        }
    })
</script>