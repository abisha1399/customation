
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
    $sql = "SELECT * FROM `form_follow` WHERE id=? AND pid = ? AND encounter = ?";
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
    <title>First_Dose_Medication</title>
      <?php Header::setupHeader(); ?>
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
          <div  style="border:1px solid black;" class="container-fluid">
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/form_follow /save.php?id=<?php echo attr_url($formid); ?>">
<h1 style="text-align:center;">FOLLOW UP PLACEMENT</h1><br><br>
<table style="width:100%" class="table table-bordered">
<tr>
    <td style="width:30%;">
<label>Treatment:</label><br>
<textarea style="border:none;height:100px;width:300px;" type="text" name="comment1"><?php echo text($check_res['comment1']);?></textarea>

</td>
    <td style="width:30%;">
<label>Physician:</label><br>
<textarea style="border:none;height:100px;width:300px;" type="text" name="comment2"><?php echo text($check_res['comment2']);?></textarea>

</td>
    <td style="width:30%;">
<label>Anger Management:</label><br>
<textarea style="border:none;height:100px;width:300px;" type="text" name="comment3"><?php echo text($check_res['comment3']);?></textarea>

</td>
</tr>


</table><br><br>
<table style="width:100%;">
<tr>
    <td style="width:30%;">
<label>clinical Name:</label><br>
<input style="border:none;border-bottom:1px solid black;" type="text" name="name1" value="<?php echo text($check_res['name1']);?>"/>

</td>
    <td style="width:30%;">
<label>Signature:</label><br>
<i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
<i class="fas fa-search view_icon" id="rn_Signature1" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="Signature1" id="Signature1" value="<?php echo text($check_res['sign1']); ?>"  />
</td>
    <td style="width:30%;">
<label>Date:</label><br>
<input style="border:none;border-bottom:1px solid black;" type="date" name="date1" value="<?php echo text($check_res['date1']);?>"/>

</td>
</tr>

</table><br><br>
<table style="width:100%"><tr><td style="width:100%;">
<label>Nursing Discharge Note:</label><br><br>
<textarea style="border:1px solid black;height:100px;width:100%;height:200px;"  type="text" name="comment4"><?php echo text($check_res['comment4']);?></textarea>
</td></tr></table><br><br><br>
<table style="width:100%;">
<tr>
    <td style="width:30%;">
<label>Medication:</label><br>
<textarea style="border:1px solid black;height:100px;width:100%;"  type="text" name="comment5"><?php echo text($check_res['comment5']);?></textarea>

</td>
    <td style="width:30%;">
<label>Dose:</label><br>
<textarea style="border:1px solid black;height:100px;width:100%;"  type="text" name="comment6"><?php echo text($check_res['comment6']);?></textarea>

</td>
    <td style="width:30%;">
<label>Indication:</label><br>
<textarea style="border:1px solid black;height:100px;width:100%;"  type="text" name="comment7"><?php echo text($check_res['comment7']);?></textarea>

</td>
</tr>

</table><br><br>
<table style="width:100%;">
<tr>
    <td style="width:30%;">
<label>Nurse Name:</label><br>
<input style="border:none;border-bottom:1px solid black;" type="text" name="name2" value="<?php echo text($check_res['name2']);?>"/>

</td>
    <td style="width:30%;">
<label>Signature:</label><br>
<i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
<i class="fas fa-search view_icon" id="rn_Signature2" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="Signature2" id="Signature2" value="<?php echo text($check_res['sign2']); ?>"  />
</td>
    <td style="width:30%;">
<label>Date:</label><br>
<input style="border:none;border-bottom:1px solid black;" type="date" name="date2" value="<?php echo text($check_res['date2']);?>"/>

</td>
</tr>

</table><br><br>
<table style="width:100%"><tr><td style="width:100%;">
<label>Physician Discharge Note:</label><br><br>
<textarea style="border:1px solid black;height:100px;width:100%;height:100px;"  type="text" name="comment8"><?php echo text($check_res['comment3']);?></textarea>
</td></tr></table><br><br>
<table style="width:100%;">
<tr>
    <td style="width:30%;">
<label> Name:</label><br>
<input style="border:none;border-bottom:1px solid black;" type="text" name="name3" value="<?php echo text($check_res['name3']);?>"/>

</td>
    <td style="width:30%;">
<label>Signature:</label><br>
<i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
<i class="fas fa-search view_icon" id="rn_Signature3" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="Signature3" id="Signature3" value="<?php echo text($check_res['sign3']); ?>"  />
</td>
    <td style="width:30%;">
<label>Date:</label><br>
<input style="border:none;border-bottom:1px solid black;" type="date" name="date3" value="<?php echo text($check_res['date3']);?>"/>

</td>
</tr>

</table><br><br>

<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit"  name="sub" value="Submit" >
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
