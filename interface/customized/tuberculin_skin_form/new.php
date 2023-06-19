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
    $sql = "SELECT * FROM `tuberculin_form` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Tuberculin Skin Form"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
</head>
<body>
<div class="container mt-3">
    <div class="row">
        <div class="container-fluid">
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/tuberculin_skin_form/save.php?id=<?php echo attr_url($formid); ?>">
     <b>Date:</b>
     <input type="date" style="border:none; border-bottom:1px solid black;" name="input1" value="<?php echo text($check_res['input1']);?>"> <br>
     <b>Time:</b>
     <input type="time" style="border:none; border-bottom:1px solid black;" name="input2" value="<?php echo text($check_res['input2']);?>"> <br>
     <b>Date/Time of Mantoux Read</b>
     <input type="datetime-local" style="border:none; border-bottom:1px solid black;" name="input3" value="<?php echo text($check_res['input3']);?>">
     <b>Result:</b>
     <input type="text" style="border:none; border-bottom:1px solid black;" name="input4" value="<?php echo text($check_res['input4']);?>"> <br>
     <b>Signature of Licensed RN:</b>
     <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
      <input type="hidden" name="input5" id="input5" style="width:60%;" value="<?php echo text($check_res['input5']);?>"/>
      <img src='' class="img" id="img_input5" style="display:none;width:50%;height:100px;">  
    <br> <br>
     <h6 style="text-align:center">Tuberculin Skin Test</h6><br>
     <h6 style="text-align:center">Nursing Department</h6>
     <b>Client Name:</b>
     <input type="text" style="border:none; border-bottom:1px solid black;" name="input6" value="<?php echo text($check_res['input6']);?>"> <br> <br>
     <table style="border:1px solid black;width:100%" class="table table-bordered">
         <tr>
             <td style="text-align:center">Mantoux Given</td>
             <td style="text-align:center">Mantoux Read</td>
         </tr>
         <tr>
             <td>
                 <b>Date:</b><input type="date" style="border:none" name="input7" value="<?php echo text($check_res['input7']);?>">
             </td>
             <td>
                 <b>Date:</b><input type="date" style="border:none" name="input8" value="<?php echo text($check_res['input8']);?>">
             </td>
         </tr>
         <tr>
         <td>
                 <b>Time:</b><input type="time" style="border:none" name="input9" value="<?php echo text($check_res['input9']);?>">
             </td>
             <td>
                 <b>Time:</b><input type="time" style="border:none" name="input10" value="<?php echo text($check_res['input10']);?>">
             </td>
         </tr>
         <tr>
         <td>
                 <b>Site:</b><input type="text" style="border:none" name="input11" value="<?php echo text($check_res['input11']);?>">
             </td>
             <td>
                 <b>Negative:</b><input type="text" style="border:none" name="input12" value="<?php echo text($check_res['input12']);?>">
             </td>
         </tr>
         <tr>
         <td>
                 <b>Manufacture:</b><input type="text" style="border:none" name="input13" value="<?php echo text($check_res['input13']);?>">
             </td>
             <td>
                 <b>Positive <br>induration :</b><input type="text" style="border:none" name="input14" value="<?php echo text($check_res['input14']);?>"> mm of <input type="text" style="border:none" name="input15" value="<?php echo text($check_res['input15']);?>">
             </td>
         </tr>
         <tr>
         <td>
                 <b>Expiration Date:</b><input type="date" style="border:none" name="input16" value="<?php echo text($check_res['input17']);?>">
             </td>
             <td>
                 
             </td>
         </tr>
         <td>
                 <b>Lot#:</b><input type="text" style="border:none" name="input17" value="<?php echo text($check_res['input17']);?>">
             </td>
             <td>
                 
             </td>
         </tr>
         <tr>
         <td>
                 <b>Nurse/MD signature:</b>
                 <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="input18" id="input18" style="width:60%;" value="<?php echo text($check_res['input18']);?>"/>
                <img src='' class="img" id="img_input18" style="display:none;width:50%;height:100px;">  
                 
             </td>
             <td>
                 <b>Nurse/MD signature:</b>
                 <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="input19" id="input19" style="width:60%;" value="<?php echo text($check_res['input19']);?>"/>
                <img src='' class="img" id="img_input19" style="display:none;width:50%;height:100px;"> 
                  
             </td>
         </tr>
     </table>
     <b>POSITIVE MANTOUX TEST,REFFERED FOR X-RAY</b> <br>
     <b>Date of x-ray:</b>
     <input type="date" style="border:none; border-bottom:1px solid black;" name="input20" value="<?php echo text($check_res['input20']);?>"> <br>
     <b>Result:</b>
     <input type="text" style="border:none; border-bottom:1px solid black; width:1000px" name="input21" value="<?php echo text($check_res['input21']);?>"> <br>
     <input type="text" style="border:none; border-bottom:1px solid black; width:1000px" name="input22" value="<?php echo text($check_res['input22']);?>">  <br>
     <b>Interventions:</b>
     <input type="text" style="border:none; border-bottom:1px solid black;width:1000px" name="input23" value="<?php echo text($check_res['input23']);?>"> <br> <br>

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
        $("#view_img").attr("src", '');
        $("#view_img").css('display','none');
        $('canvas').css('display','block');
        $("#sign_data").val('');
    });



    var id_name, val, display_edit, icon;


      $('.pen_icon').click(function() {
        id_name = $(this).next('input').attr('id');
        var sign_value = $("#"+id_name).val();
        //alert(sign_value);
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

    $('.radio_change').on('change',function(){
        var checkbox_class= $(this).attr('data-id');
        if($(this).is(":checked"))
        {
            $('.'+checkbox_class).prop('checked',false);
            $(this).prop('checked',true);
            // $('#'+checkbox_class).val($(this).val());
        }
    })

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
</html>