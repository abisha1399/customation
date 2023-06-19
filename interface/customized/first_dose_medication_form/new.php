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
    $sql = "SELECT * FROM `first_dose_form` WHERE id=? AND pid = ? AND encounter = ?";
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
    <!-- <meta charset="UTF-8">
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
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script> -->
    <title>First Dose Medication</title>
      <?php Header::setupHeader(); ?>
      <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">

</head>
<body>
<div class="container mt-3">
    <div class="row">
        <div class="container-fluid">
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/first_dose_medication_form/save.php?id=<?php echo attr_url($formid); ?>">
          <b>Patient Name:</b>
          <input type="text" style="border:none; border-bottom:1px solid black;" name="pname" value="<?php echo text($check_res['pname']);?>"> <br>
          <b>DOB:</b>
          <input type="date" style="border:none; border-bottom:1px solid black;" name="DOB" value="<?php echo text($check_res['DOB']);?>"> <br> <br>
          <b style="text-align:center;">First Dose Medication Monitoring</b>
          <table style="border:1px solid black;width:100%" class="table table-bordered">
             <tr>
                 <td>
                     <b>Medication</b>
                 </td>
                 <td>
                     <b>Dose</b>
                 </td>
                 <td>
                    <b> Date/Time Givin</b>
                 </td>
                 <td>
                     <b>Date/time follow up</b>
                 </td>
                 <td>
                     <b>Side Effects Descripition</b>
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Ativan</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input1" value="<?php echo text($check_res['input1']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input2" value="<?php echo text($check_res['input2']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input3" value="<?php echo text($check_res['input3']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input4" value="<?php echo text($check_res['input4']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Bentyl</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input5" value="<?php echo text($check_res['input5']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input6" value="<?php echo text($check_res['input6']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input7" value="<?php echo text($check_res['input7']);?>"> 
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input8" value="<?php echo text($check_res['input8']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Clonidine</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input9"  value="<?php echo text($check_res['input9']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input10"  value="<?php echo text($check_res['input10']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input11"  value="<?php echo text($check_res['input11']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input12"  value="<?php echo text($check_res['input12']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Dulcolox</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input13" value="<?php echo text($check_res['input13']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input14" value="<?php echo text($check_res['input14']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input15" value="<?php echo text($check_res['input15']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input16" value="<?php echo text($check_res['input16']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Folate</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input17" value="<?php echo text($check_res['input17']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input18" value="<?php echo text($check_res['input18']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input19" value="<?php echo text($check_res['input19']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input20" value="<?php echo text($check_res['input20']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Hydroxyzine</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input21"  value="<?php echo text($check_res['input21']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input22"  value="<?php echo text($check_res['input22']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input23"  value="<?php echo text($check_res['input23']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input24"  value="<?php echo text($check_res['input24']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Imodium</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input25"  value="<?php echo text($check_res['input25']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input26"  value="<?php echo text($check_res['input26']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input27"  value="<?php echo text($check_res['input27']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input28"  value="<?php echo text($check_res['input28']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Keppra</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input29" value="<?php echo text($check_res['input29']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input30" value="<?php echo text($check_res['input30']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input31" value="<?php echo text($check_res['input31']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input32" value="<?php echo text($check_res['input32']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Librium</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input33" value="<?php echo text($check_res['input33']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input34" value="<?php echo text($check_res['input34']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input35" value="<?php echo text($check_res['input35']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input36" value="<?php echo text($check_res['input36']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Maalex</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input37" value="<?php echo text($check_res['input37']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input38" value="<?php echo text($check_res['input38']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input39" value="<?php echo text($check_res['input39']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input40" value="<?php echo text($check_res['input40']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>MOM</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input41" value="<?php echo text($check_res['input41']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input42" value="<?php echo text($check_res['input42']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input43" value="<?php echo text($check_res['input43']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input44" value="<?php echo text($check_res['input44']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Neurontin</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input45" value="<?php echo text($check_res['input45']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input46" value="<?php echo text($check_res['input46']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input47" value="<?php echo text($check_res['input47']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input48" value="<?php echo text($check_res['input48']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Phenergan</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input49" value="<?php echo text($check_res['input48']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input50" value="<?php echo text($check_res['input48']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input51" value="<?php echo text($check_res['input48']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input52" value="<?php echo text($check_res['input48']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Robaxin</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input53" value="<?php echo text($check_res['input53']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input54" value="<?php echo text($check_res['input54']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input55" value="<?php echo text($check_res['input55']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input56" value="<?php echo text($check_res['input56']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Sabutex</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input57" value="<?php echo text($check_res['input57']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input58" value="<?php echo text($check_res['input58']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input59" value="<?php echo text($check_res['input59']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input60" value="<?php echo text($check_res['input60']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Thiamine</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input61" value="<?php echo text($check_res['input61']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input62" value="<?php echo text($check_res['input62']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input63" value="<?php echo text($check_res['input63']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input64" value="<?php echo text($check_res['input64']);?>">
                 </td>
                
             </tr>
             <tr>
                 <td>
                     <b>Tigan</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input65" value="<?php echo text($check_res['input65']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input66" value="<?php echo text($check_res['input66']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input67" value="<?php echo text($check_res['input67']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input68" value="<?php echo text($check_res['input68']);?>">
                 </td>


                </tr>  
                <tr>
                 <td>
                     <b>Tylenol</b>
                 <td>
                     <input type="text" style="border:none;" name="input69" value="<?php echo text($check_res['input69']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input70" value="<?php echo text($check_res['input70']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input71" value="<?php echo text($check_res['input71']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input72" value="<?php echo text($check_res['input72']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Valium</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input73" value="<?php echo text($check_res['input73']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input74" value="<?php echo text($check_res['input74']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input75" value="<?php echo text($check_res['input75']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input76" value="<?php echo text($check_res['input76']);?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Zolran</b>
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input77" value="<?php echo text($check_res['input77']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input78" value="<?php echo text($check_res['input78']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input79" value="<?php echo text($check_res['input79']);?>">
                 </td>
                 <td>
                     <input type="text" style="border:none;" name="input80" value="<?php echo text($check_res['input80']);?>">
                 </td>
             </tr>
          </table>
<table>
    <tr><td>
          <b>Nurse's signature:</b> 
          <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
        <i class="fas fa-search view_icon" id="rn_input81" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input81" id="input81" value="<?php echo text($check_res['input81']); ?>"  /></td>
        <td><b class="ml-5">Date:</b> <input type="date" style="border:none;border-bottom:1px solid black;" name="input82" value="<?php echo text($check_res['input82']);?>"> <b class="ml-5">Time:</b>  <input type="time" style="border:none;border-bottom:1px solid black;" name="input83" value="<?php echo text($check_res['input83']);?>"> <br> <br></td></tr>
          
        <tr><td><b>Nurse's signature:</b> 
          <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
        <i class="fas fa-search view_icon" id="rn_input84" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input84" id="input84" value="<?php echo text($check_res['input84']); ?>"  />  </td>
          <td><b class="ml-5">Date:</b> <input type="date" style="border:none;border-bottom:1px solid black;" name="input85" value="<?php echo text($check_res['input85']);?>"> <b class="ml-5">Time:</b>  <input type="time" style="border:none;border-bottom:1px solid black;" name="input86" value="<?php echo text($check_res['input86']);?>"> <br> <br></td></tr>
          
          <tr><td><b>Nurse's signature:</b> 
          <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
          <i class="fas fa-search view_icon" id="rn_input87" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input87" id="input87" value="<?php echo text($check_res['input87']); ?>"  /></td>
          <td> <b class="ml-5">Date:</b> <input type="date" style="border:none;border-bottom:1px solid black;" name="input88" value="<?php echo text($check_res['input88']);?>"> <b class="ml-5">Time:</b>  <input type="time" style="border:none;border-bottom:1px solid black;" name="input89" value="<?php echo text($check_res['input89']);?>" > <br> <br></td></tr>
          
          <tr><td><b>Nurse's signature:</b> 
          <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
          <i class="fas fa-search view_icon" id="rn_input90" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input90" id="input90" value="<?php echo text($check_res['input90']); ?>"  /></td>
          <td><b class="ml-5">Date:</b> <input type="date" style="border:none;border-bottom:1px solid black;" name="input91" value="<?php echo text($check_res['input91']);?>"> <b class="ml-5">Time:</b>  <input type="time" style="border:none;border-bottom:1px solid black;" name="input92" value="<?php echo text($check_res['input92']);?>"> <br> <br></td></tr>
          
          <tr><td><b>Nurse's signature:</b> 
          <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
          <i class="fas fa-search view_icon" id="rn_input93" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input93" id="input93" value="<?php echo text($check_res['input93']); ?>"  /></td>
           
          <td><b class="ml-5">Date:</b> <input type="date" style="border:none;border-bottom:1px solid black;" name="input94" value="<?php echo text($check_res['input94']);?>"> <b class="ml-5">Time:</b>  <input type="time" style="border:none;border-bottom:1px solid black;" name="input95" value="<?php echo text($check_res['input95']);?>"> <br> <br></td></tr></table>

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
                        <div id="sig"></div>
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

    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <img src="" id="view_sign" alt="sign img" width='200px' height='100px'>
                </div>
            </div>
        </div>
    </div>
    <!-- modal close --> 
</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../customized/admission_orders/assets/js/jquery.signature.min.js"></script>
<script>
    var sig = $('#sig').signature({
        syncField: '#sign_data',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#sign_data").val('');
    });

    var id_name, val, display_edit, icon;


    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {
            icon = $(this).next().attr('id');;
            display_edit = $(this).next().next('input').attr('id');
            val = $("#" + display_edit).val();
            display(icon);
        });

    }

    function display(icon) {
        if (val != "") {
            $("#" + icon).css('display', 'block');

        } else {
            $("#" + icon).css('display', 'none');
        }
    }
    $('.pen_icon').click(function() {
        id_name = $(this).next().next('input').attr('id');
    });

    $('.view_icon').click(function() {
        id_name = $(this).next('input').val();
        $("#view_sign").attr("src", "data:image/png;base64," + id_name);
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        // alert(sign);
        sign = sign.split(',');
        $('#' + id_name).val(sign[1]);
        sig.signature('clear');
        $("#sign_data").val('');
        check_sign();
    });
    $('input.thiacheck').on('click', function() {
    $(this).parent().parent().find('.thiacheck').prop('checked', false);
    $(this).prop('checked', true)
    });
   
</script>
</html>