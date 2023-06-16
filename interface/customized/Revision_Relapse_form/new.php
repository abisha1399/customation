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
    $sql = "SELECT * FROM `revisionrelapse_form` WHERE id=? AND pid = ? AND encounter = ?";
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

    <title>Document</title>
    <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    <style>
        .pen_icon {
            cursor: pointer;
        }
        </style>
</head>
<body>

<div class="container mt-3">
    <div class="row">
        <div class="container-fluid">
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/Revision_Relapse_form/save.php?id=<?php echo attr_url($formid); ?>">
        <b>Patient Name:</b>
        <input style="border:none; border-bottom:1px solid black;" type="text" name="pname" value="<?php echo text($check_res['pname']);?>"> <br> <br>
        <b>DOB:</b>
        <input style="border:none; border-bottom:1px solid black;" type="date" name="DOB" value="<?php echo text($check_res['DOB']);?>"> <br> <br>
        <table style="border:1px solid black;width:100%" class="table table-bordered" >
        <h6 style="text-align:center;">Revision of Treatment/Relapse Record</h6> <br>
        <h6 style="text-align:center;">Nursing</h6> <br> <br>
        <table  style=" width:100%" class="table table-bordered">
            <tr> <h6 style="font_wight:bold;">Target Problem: <label style="margin-left:100px;">Interventions:</label><label style="margin-left:205px;">Time Frame:</label><label style="margin-left:187px;">Teaching Strategy:</label></h6>
                <td>
                    1.Patient Relapse <br>Date of Relapse <br> <br>
                    pt signature &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                    <input type="hidden" name="input1" id="input1" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['input1']);?>">
                    <img src='' class="img" id="img_input1" style="display:none;width:25%;height:100px;" >
                </td>

                <td>
                    <input type="checkbox" name="checkboxA1" value="1" <?php if ($check_res['checkboxA1'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkboxA2" value="1" <?php if ($check_res['checkboxA2'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkboxA3" value="1" <?php if ($check_res['checkboxA3'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkboxA4" value="1" <?php if ($check_res['checkboxA4'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox6" value="1" <?php if ($check_res['checkbox4'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox9" value="1" <?php if ($check_res['checkbox5'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox12" value="1" <?php if ($check_res['checkbox6'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {echo "checked";}?>>1:1 <input type="checkbox" name="checkbox14" value="1" <?php if ($check_res['checkbox14'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox15" value="1" <?php if ($check_res['checkbox15'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox16" value="1" <?php if ($check_res['checkbox16'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox17" value="1" <?php if ($check_res['checkbox17'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox18" value="1" <?php if ($check_res['checkbox18'] == "1") {echo "checked";}?>>Demonstration
                </td>
            </tr>
            <tr>
                <td>
                    2.Patient Relapse <br>Date of Relapse <br> <br> pt signature &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                    <input type="hidden" name="input2" id="input2" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['input2']);?>">
                    <img src='' class="img" id="img_input2" style="display:none;width:25%;height:100px;" >
                </td>
                <td>
                    <input type="checkbox" name="checkbox19" value="1" <?php if ($check_res['checkbox19'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkbox20" value="1" <?php if ($check_res['checkbox20'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox21" value="1" <?php if ($check_res['checkbox21'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkbox22" value="1" <?php if ($check_res['checkbox22'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox23" value="1" <?php if ($check_res['checkbox23'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox24" value="1" <?php if ($check_res['checkbox24'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox25" value="1" <?php if ($check_res['checkbox25'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox26" value="1" <?php if ($check_res['checkbox26'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox27" value="1" <?php if ($check_res['checkbox27'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox28" value="1" <?php if ($check_res['checkbox28'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox29" value="1" <?php if ($check_res['checkbox29'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox30" value="1" <?php if ($check_res['checkbox30'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox31" value="1" <?php if ($check_res['checkbox31'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox32" value="1" <?php if ($check_res['checkbox30'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox33" value="1" <?php if ($check_res['checkbox33'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox34" value="1" <?php if ($check_res['checkbox34'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox35"> value="1" <?php if ($check_res['checkbox35'] == "1") {echo "checked";}?>1:1 <input type="checkbox" name="checkbox36" value="1" <?php if ($check_res['checkbox36'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox37" value="1" <?php if ($check_res['checkbox37'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox38" value="1" <?php if ($check_res['checkbox38'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox39" value="1" <?php if ($check_res['checkbox39'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox40" value="1" <?php if ($check_res['checkbox40'] == "1") {echo "checked";}?>>Demonstration
                </td>
            </tr>
            <tr>
                <td>
                    3.Patient Relapse <br>Date of Relapse <br> <br> pt signature &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                     <input type="hidden" name="input3"  id="input3" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['input3']);?>">
                     <img src='' class="img" id="img_input3" style="display:none;width:25%;height:100px;" >
                </td>
                <td>
                    <input type="checkbox" name="checkbox41" value="1" <?php if ($check_res['checkbox41'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkbox42" value="1" <?php if ($check_res['checkbox42'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox43" value="1" <?php if ($check_res['checkbox43'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkbox44" value="1" <?php if ($check_res['checkbox44'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox45" value="1" <?php if ($check_res['checkbox45'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox46">48hrs  <input type="checkbox" name="checkbox47" value="1" <?php if ($check_res['checkbox47'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox48" value="1" <?php if ($check_res['checkbox48'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox49">48hrs  <input type="checkbox" name="checkbox50" value="1" <?php if ($check_res['checkbox50'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox51" value="1" <?php if ($check_res['checkbox51'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox52">48hrs  <input type="checkbox" name="checkbox53" value="1" <?php if ($check_res['checkbox53'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox54" value="1" <?php if ($check_res['checkbox54'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox55">48hrs  <input type="checkbox" name="checkbox56" value="1" <?php if ($check_res['checkbox56'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox57" value="1" <?php if ($check_res['checkbox57'] == "1") {echo "checked";}?>>1:1 <input type="checkbox" name="checkbox58" value="1" <?php if ($check_res['checkbox58'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox59" value="1" <?php if ($check_res['checkbox59'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox60" value="1" <?php if ($check_res['checkbox60'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox61" value="1" <?php if ($check_res['checkbox61'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox62" value="1" <?php if ($check_res['checkbox62'] == "1") {echo "checked";}?>>Demonstration
                </td>
            </tr>
            <tr>
                <td>
                    4.Patient Relapse <br>Date of Relapse <br> <br> pt signature
                    &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                     <input type="hidden" name="input4" id="input4" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['input4']);?>">
                     <img src='' class="img" id="img_input4" style="display:none;width:25%;height:100px;" >
                </td>
                <td>
                    <input type="checkbox" name="checkbox61" value="1" <?php if ($check_res['checkboxA1'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkbox62" value="1" <?php if ($check_res['checkboxA2'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox63" value="1" <?php if ($check_res['checkboxA3'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkbox64" value="1" <?php if ($check_res['checkboxA4'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox65" value="1" <?php if ($check_res['checkbox65'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox66" value="1" <?php if ($check_res['checkbox66'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox67" value="1" <?php if ($check_res['checkbox67'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox68" value="1" <?php if ($check_res['checkbox68'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox69" value="1" <?php if ($check_res['checkbox69'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox70" value="1" <?php if ($check_res['checkbox70'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox71" value="1" <?php if ($check_res['checkbox71'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox72" value="1" <?php if ($check_res['checkbox72'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox73" value="1" <?php if ($check_res['checkbox73'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox74" value="1" <?php if ($check_res['checkbox74'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox75" value="1" <?php if ($check_res['checkbox75'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox76" value="1" <?php if ($check_res['checkbox76'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox77" value="1" <?php if ($check_res['checkbox77'] == "1") {echo "checked";}?>>1:1 <input type="checkbox" name="checkbox78" value="1" <?php if ($check_res['checkbox78'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox79" value="1" <?php if ($check_res['checkbox79'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox80" value="1" <?php if ($check_res['checkbox080'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox81" value="1" <?php if ($check_res['checkbox81'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox82" value="1" <?php if ($check_res['checkbox82'] == "1") {echo "checked";}?>>Demonstration
                </td>
            </tr>
            <tr>
                <td>
                    5.Patient Relapse <br>Date of Relapse <br> <br> pt signature
                    &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                     <input type="hidden" name="input5" id="input5" style="border:none; border-bottom:1px solid black;" value="<?php echo text($check_res['inpu5']);?>">
                     <img src='' class="img" id="img_input5" style="display:none;width:25%;height:100px;" >
                </td>
                <td>
                    <input type="checkbox" name="checkbox83" value="1" <?php if ($check_res['checkbox83'] == "1") {echo "checked";}?>>Informed Support <br>
                    <input type="checkbox" name="checkbox84" value="1" <?php if ($check_res['checkbox84'] == "1") {echo "checked";}?>>Medication education/ <br> change in medication/ <br> prescription add on change <br>
                    <input type="checkbox" name="checkbox85" value="1" <?php if ($check_res['checkbox85'] == "1") {echo "checked";}?>>Family intervention <br>
                    <input type="checkbox" name="checkbox86" value="1" <?php if ($check_res['checkbox86'] == "1") {echo "checked";}?>>Therapeutic support
                </td>
                <td>
                    <input type="checkbox" name="checkbox87" value="1" <?php if ($check_res['checkbox87'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox88" value="1" <?php if ($check_res['checkbox88'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox89" value="1" <?php if ($check_res['checkbox89'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox90" value="1" <?php if ($check_res['checkbox90'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox91" value="1" <?php if ($check_res['checkbox91'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox92" value="1" <?php if ($check_res['checkbox92'] == "1") {echo "checked";}?>>10days <br> <br> <br>
                    <input type="checkbox" name="checkbox93" value="1" <?php if ($check_res['checkbox93'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox94" value="1" <?php if ($check_res['checkbox94'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox95" value="1" <?php if ($check_res['checkbox95'] == "1") {echo "checked";}?>>10days <br>
                    <input type="checkbox" name="checkbox96" value="1" <?php if ($check_res['checkbox96'] == "1") {echo "checked";}?>>24hrs  <input type="checkbox" name="checkbox97" value="1" <?php if ($check_res['checkbox95'] == "1") {echo "checked";}?>>48hrs  <input type="checkbox" name="checkbox98" value="1" <?php if ($check_res['checkbox98'] == "1") {echo "checked";}?>>10days <br>
                </td>
                <td>
                <input type="checkbox" name="checkbox99" value="1" <?php if ($check_res['checkbox99'] == "1") {echo "checked";}?>>1:1 <input type="checkbox" name="checkbox100" value="1" <?php if ($check_res['checkbox100'] == "1") {echo "checked";}?>>written material <br> <input type="checkbox" name="checkbox111" value="1" <?php if ($check_res['checkbox111'] == "1") {echo "checked";}?>>groups <input type="checkbox" name="checkbox112" value="1" <?php if ($check_res['checkbox112'] == "1") {echo "checked";}?>>videos <br> <input type="checkbox" name="checkbox113" value="1" <?php if ($check_res['checkbox113'] == "1") {echo "checked";}?>>verbal discussion <br><input type="checkbox" name="checkbox114" value="1" <?php if ($check_res['checkbox114'] == "1") {echo "checked";}?>>Demonstration
                </td>
                 
            </tr>
        </table>
        <b>Nurse signature:</b>
        &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" style="border:none; border-bottom:1px solid black;" name="sign1" id="sign1" value="<?php echo text($check_res['sign1']);?>">
         <img src='' class="img" id="img_sign1" style="display:none;width:25%;height:100px;" >
         <b>Date:</b> <input type="date" style="border:none; border-bottom:1px solid black;" name="date1" value="<?php echo text($check_res['date1']);?>">
        <b>Time:</b> <input type="time" style="border:none; border-bottom:1px solid black;" name="time1" value="<?php echo text($check_res['time1']);?>"> <br>
        <b>Patient signature:</b>
        &nbsp; <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
        <input type="hidden" style="border:none; border-bottom:1px solid black;" name="sign2"  id="sign2" value="<?php echo text($check_res['sign2']);?>" >
        <img src='' class="img" id="img_sign2" style="display:none;width:25%;height:100px;" >
         <b>Date:</b> <input type="date" style="border:none; border-bottom:1px solid black;" name="date2" value="<?php echo text($check_res['date2']);?>">
          <b>Time:</b> <input type="time" style="border:none; border-bottom:1px solid black;" name="time2" value="<?php echo text($check_res['time2']);?>"><br> <br>


        <input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit" name="sub" value="Submit" >
        <button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
</form>

</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="sig">
                            <img id="view_img" style="display:none" width='380px' height='144px'>
                        </div>
                        <br />
                        <br />
                        <br />
                        <button id="clear">Clear</button>
                        <textarea id="sign_data" style="display: none"></textarea>
                    </div>
                    <input type='button' id="add_sign" class="btn btn-success" data-dismiss="modal" value='Add Sign' style='float:right'>

                </div>
            </div>
        </div>
    </div>
    <!-- modal close -->

</body>
</html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../forms/admission_orders/assets/js/jquery.signature.min.js"></script>
<script>
    var sig = $('#sig').signature({
        syncField: '#sign_data',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#view_img").attr("src", '');
        $("#view_img").css('display','none');
        $('canvas').css('display','block');
        $("#sign_data").val('');
    });



    var id_name, val, display_edit, icon;


      $('.pen_icon').click(function() {
        id_name = $(this).next('input').attr('id');
        var sign_value = $("#"+id_name).val();
       // alert(sign_value);
        if(sign_value!='')
        {
            // $("#sig").css('display','none');
            $('canvas').css('display','none');
            $("#view_img").css('display','block');
            $("#view_img").attr("src", sign_value);
            $("#sign_data").val(sign_value);

        }
        // else{
        //     $("#)
        // }
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        $('#' + id_name).val(sign);
        if(sign!='')
        {
            $("#img_"+id_name).attr('src',sign);
            $("#img_"+id_name).css('display','block');
        }
        else{
            $("#img_"+id_name).css('display','none');
        }

        $('#sign_data').val('');
        sig.signature('clear');
       // $("#sign_data").val('');
       // check_sign();
    });


    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {

            var id_name1 = $(this).next('input').attr('id');
            var sign_value = $("#"+id_name1).val();

            if(sign_value!='')
            {
                $("#img_"+id_name1).css('display','block');
                $("#img_"+id_name1).attr('src',sign_value);

            }

        });

    }
</script>
