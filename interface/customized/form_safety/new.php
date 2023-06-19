
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
    $sql = "SELECT * FROM `form_safety` WHERE id=? AND pid = ? AND encounter = ?";
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
<?php Header::setupHeader(); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">


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
          <div class="container-fluid">
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/form_safety/save.php?id=<?php echo attr_url($formid); ?>">

<h2 style="text-align:center;">Safety Plan Consent</h2><br><br>
<span style="font-size:18px;color:black;font-family:sans-serif;">I</span><input style="border:none;border-bottom:2px solid black;width:300px;" type="text" name="input" value="<?php echo text($check_res['input']);?>"/><span style="font-size:18px;color:black;font-family:sans-serif;">(print name)consent that I do not have access to prescription medication for use other than prescribed or access to weapons,lethal medications and/or other means of self harm.</span><br><br><br><br>
<table style="width:100%">
    <tr>
        <td style="width:50%">
        <span style="font-size:18px;color:black;font-family:sans-serif;">Patient Signature:</span>
        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
        <input type="hidden" name="sign1" id="sign1" value="<?php echo text($check_res['sign1']);?>"/>
        <img src='' class="img" id="img_sign1" style="display:none;width:50%;height:100px;" >
    </td>
    <td style="width:50%">
        <span style="font-size:18px;color:black;font-family:sans-serif;">Date/Time:</span><input style="border:none;border-bottom:2px solid black;width:300px;" type="date" name="date1" value="<?php echo text($check_res['date1']);?>"/>
    </td>
   
    </tr>
    <tr>
    <td style="width:50%">
        <span style="font-size:18px;color:black;font-family:sans-serif;">Nurse Signature:</span>
        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
        <input type="hidden" name="sign2" id="sign2" value="<?php echo text($check_res['sign2']);?>"/>
        <img src='' class="img" id="img_sign2" style="display:none;width:50%;height:100px;" >
    </td>
    <td style="width:50%">
        <span style="font-size:18px;color:black;font-family:sans-serif;">Date/Time:</span><input style="border:none;border-bottom:2px solid black;width:300px;" type="date" name="date2"
        value="<?php echo text($check_res['date2']);?>"/>
    </td>
    </tr>
</table><br><br><br>

<input style=" border:1px solid blue;margin-left:470px;padding-left:15px;background-color:blue;color:white;font-size:16px;" class="btn btn-primary" type="submit" name="sub" value="save" >
<button style="  border:1px solid red; padding-left:15px; background-color:red;  color:white; font-size:16px;" type="button" class="btn btn-danger"   onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
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
