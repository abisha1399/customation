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
    $sql = "SELECT * FROM `form_thiamine_folate` WHERE id=? AND pid = ? AND encounter = ?";
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
    <title>Document</title>
    <?php Header::setupHeader(); ?>

    <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
   </head>

<body>
    <div class="container mt-3">
        <div class="row">
          <div class="container-fluid">
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/thiamine_folate/save.php?id=<?php echo attr_url($formid); ?>">

<table style="width:100%;">
<tr style="border-bottom:1px solid #000;width:100%;">
    <td style="width:30%;border:1px solid #000;padding:3px 0px 0px 5px;">
        <h4>Medication Log</h4>
    </td>
    <td style="width:70%;border:1px solid #000;padding:3px 0px 0px 5px;">
    <h4>
    DAILY MEDICATION
    </h4>
        <!-- <b>Allergies:</b>
        <input type="text" name="input1"  value="<?php echo text($check_res['input1']);?>" style="width:200px;border:none;border-bottom:1px solid black;"/> -->
    </td>
</tr>
</table>
        <table style="border:1px solid #000;width:100%;table-layout:fixed;display:table;">
                            <tr style="border:1px solid #000;">
                                <th style="border:1px solid #000;"><label>Patient Name:</label> 
                                <label><input type="text" style="width:105%;" name="p_name" value="<?php echo text($check_res['p_name']);?>" style=""/></label></th>
                                <th style="text-align:center;border:1px solid #000;">DOB: 
                                <input type="date" name="dob" value="<?php echo text($check_res['dob']);?>"/></label></th>
                                <th style="text-align:center;border:1px solid #000;">Allgeries: 
                                <input type="text" name="alrg" style="width:100%" value="<?php echo text($check_res['alrg']);?>"/></label></th>
                            </tr>
        </table>
        <table>
                            <tr style="border:1px solid #000;">
                                <th style="width: 20%;border:1px solid #000;">Medication, Dosage, Frequency & Route</th>
                                <th style="width: 6%;border:1px solid #000;">Time</th>
                                <th style="border:1px solid #000;">Date/RN Initials</th>
                                <th style="border:1px solid #000;">Patient Initials</th>
                                <th style="border:1px solid #000;">Date/RN Initials</th>
                                <th style="border:1px solid #000;">Patient Initials</th>
                                <th style="border:1px solid #000;">Date/RN Initials</th>
                                <th style="border:1px solid #000;">Patient Initials</th>
                                <th style="border:1px solid #000;">Date/RN Initials</th> 
                                <th style="border:1px solid #000;">Patient Initials</th> 
                                <th style="border:1px solid #000;">Date/RN Initials</th>
                                <th style="border:1px solid #000;">Patient Initials</th>
                            </tr>
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b> Thiamine 100mg PO Daily supplement</b>
                                </label>
                                </td>
                                <td  style="border:1px solid #000;"><b>NOW</b></td>                               
                                <td  style="border:1px solid #000;"> 
                                    <input type="text" name="input1" class="form-control" value="<?php echo text($check_res['input1']);?>"/>
                                </td>                               
                                <td  style="border:1px solid #000;"> 
                                    <input type="text" name="input2" class="form-control" value="<?php echo text($check_res['input2']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                            </tr>
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b> Thiamine 100mg PO Daily supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>9:30 AM</b></td>                               
                                <td  style="border:1px solid #000;background-color:lightgray;"> 
                                </td>                               
                                <td  style="border:1px solid #000;background-color:lightgray;"> 
                                </td> 
                                <td  style="border:1px solid #000;">
                                    <input type="text" name="input3" class="form-control" value="<?php echo text($check_res['input3']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000;">
                                    <input type="text" name="input4" class="form-control" value="<?php echo text($check_res['input4']);?>"/>                               
                                </td> 
                                <td  style="border:1px solid #000;">
                                    <input type="text" name="input5" class="form-control" value="<?php echo text($check_res['input5']);?>"/>                               
                                </td> 
                                <td  style="border:1px solid #000;">
                                    <input type="text" name="input6" class="form-control" value="<?php echo text($check_res['input6']);?>"/>                               
                                </td> 
                                <td  style="border:1px solid #000;">
                                    <input type="text" name="input7" class="form-control" value="<?php echo text($check_res['input7']);?>"/>                               
                                </td> 
                                <td  style="border:1px solid #000;">
                                    <input type="text" name="input8" class="form-control" value="<?php echo text($check_res['input8']);?>"/>                               
                                </td> 
                                <td  style="border:1px solid #000;">
                                    <input type="text" name="input9" class="form-control" value="<?php echo text($check_res['input9']);?>"/>                               
                                </td> 
                                <td  style="border:1px solid #000;">
                                    <input type="text" name="input10" class="form-control" value="<?php echo text($check_res['input10']);?>"/>                               
                                </td> 
                            </tr>
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b>Folate 1 mg PO  NOW supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>NOW</b></td>                               
                                <td  style="border:1px solid #000;"> 
                                    <input type="text" name="input11" class="form-control" value="<?php echo text($check_res['input11']);?>"/>
                                </td>                               
                                <td  style="border:1px solid #000;"> 
                                    <input type="text" name="input12" class="form-control" value="<?php echo text($check_res['input12']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                            </tr>
                            
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b>Folate 1 mg PO Daily supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>9:30 AM</b></td>                               
                                <td  style="border:1px solid #000;background-color:lightgray;"> 
                                   
                                </td>                               
                                <td  style="border:1px solid #000;background-color:lightgray;"> 
                                    
                                </td> 
                                <td  style="border:1px solid #000">
                                <input type="text" name="input13" class="form-control" value="<?php echo text($check_res['input13']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000">
                                <input type="text" name="input14" class="form-control" value="<?php echo text($check_res['input14']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000">
                                <input type="text" name="input15" class="form-control" value="<?php echo text($check_res['input15']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000">
                                <input type="text" name="input16" class="form-control" value="<?php echo text($check_res['input16']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000">
                                <input type="text" name="input17" class="form-control" value="<?php echo text($check_res['input17']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000">
                                <input type="text" name="input18" class="form-control" value="<?php echo text($check_res['input18']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000">
                                <input type="text" name="input19" class="form-control" value="<?php echo text($check_res['input19']);?>"/>
                                </td> 
                                <td  style="border:1px solid #000">
                                <input type="text" name="input20" class="form-control" value="<?php echo text($check_res['input20']);?>"/>
                                </td> 
                            </tr>
                            <tr style="border:1px solid #000;height:40px;">
                                <td  style="border:1px solid #000"></td>
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td>
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                            </tr>
                            
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b> Thiamine 100mg po Daily supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>9:30 AM</b></td>                               
                                <td   style="border:1px solid #000">    <input type="text" name="input21" class="form-control" value="<?php echo text($check_res['input21']);?>"/>
                                </td>                               
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input23" class="form-control" value="<?php echo text($check_res['input23']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input24" class="form-control" value="<?php echo text($check_res['input24']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input25" class="form-control" value="<?php echo text($check_res['input25']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input26" class="form-control" value="<?php echo text($check_res['input26']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input27" class="form-control" value="<?php echo text($check_res['input27']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input28" class="form-control" value="<?php echo text($check_res['input28']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input29" class="form-control" value="<?php echo text($check_res['input29']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input30" class="form-control" value="<?php echo text($check_res['input30']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input31" class="form-control" value="<?php echo text($check_res['input31']);?>"/>
                                </td> 
                            </tr>
                            
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b>Folate 1mg  PO Daily supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>9:30 AM</b></td>                               
                                <td   style="border:1px solid #000">    <input type="text" name="input32" class="form-control" value="<?php echo text($check_res['input32']);?>"/>
                                </td>                               
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input33" class="form-control" value="<?php echo text($check_res['input33']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input34" class="form-control" value="<?php echo text($check_res['input34']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input35" class="form-control" value="<?php echo text($check_res['input35']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input36" class="form-control" value="<?php echo text($check_res['input36']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input37" class="form-control" value="<?php echo text($check_res['input37']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input38" class="form-control" value="<?php echo text($check_res['input38']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input39" class="form-control" value="<?php echo text($check_res['input39']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input40" class="form-control" value="<?php echo text($check_res['input40']);?>"/>
                                </td> 
                                <td   style="border:1px solid #000">    
                                    <input type="text" name="input41" class="form-control" value="<?php echo text($check_res['input41']);?>"/>
                                </td> 
                            </tr>
</table><br><br>
<table style="width:100%">
<tr>
    <td style="width:25%">
    Order Date: <input type="date" style="border:none;border-bottom:1px solid black;width:150px;" name="ord_date" class="form-control" value="<?php echo text($check_res['ord_date']);?>"/>
</td>
<td style="width:25%">
    Patient Signature: 
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
    <i class="fas fa-search view_icon" id="rn_input33" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="psign1" id="psign1" value="<?php echo text($check_res['psign1']); ?>"  />
    
</td>
<td style="width:32%">
    Patient Initials: <input type="text" style="border:none;border-bottom:1px solid black;border-radius:unset;width:150px;" name="p_inp1" class="form-control" value="<?php echo text($check_res['p_inp1']);?>"/>
</td>
<td style="width:25%">
    <b>Reasons Medication not given</b>
</td>
</tr>
<tr>
    <td style="width:25%">
    Nurse transcribing orders: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="n_trans" class="form-control" value="<?php echo text($check_res['n_trans']);?>"/>
</td>
<td style="width:25%">
    Nurse Signature: <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
    <i class="fas fa-search view_icon" id="rn_input36" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="n_sign1" id="n_sign1" value="<?php echo text($check_res['n_sign1']); ?>"  />
<td style="width:25%">
    Nurse Initials: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="n_inp1" class="form-control" value="<?php echo text($check_res['n_inp1']);?>"/>
</td>
<td style="width:25%">
    <p>1.Patient Refused</p>
    <p>2.Patient Condition</p>
    <p>3.Hold per MD order</p>

</td>
</tr><tr>
    <td style="width:25%">
    Verifying Nurse: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="v_nurse" class="form-control" value="<?php echo text($check_res['v_nurse']);?>"/>
</td>
<td style="width:30%;    display: inline-flex;">&ensp;
    Nurse Signature:<i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>&ensp;
    <i class="fas fa-search view_icon" id="rn_input37" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="n_sign2" id="n_sign2" value="<?php echo text($check_res['n_sign2']); ?>"  />
     
</td>
<td style="width:25%">
    Nurse Initials: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="n_inp2" class="form-control" value="<?php echo text($check_res['n_inp2']);?>"/>
</td>
</tr>
<tr>
    <td style="width:25%">
</td>
<td style="width:25%;    display: inline-flex;">
    Nurse Signature:<i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
    <i class="fas fa-search view_icon" id="rn_input38" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="n_sign3" id="n_sign3" value="<?php echo text($check_res['n_sign3']); ?>"  />
     
</td>
<td style="width:25%">
    Nurse Initials: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="n_inp3" class="form-control" value="<?php echo text($check_res['n_inp3']);?>"/>
</td>
</tr>
<tr>
    <td style="width:25%">
</td>
<td style="width:25%;    display: inline-flex;">
    Nurse Signature:<i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
    <i class="fas fa-search view_icon" id="n_input39" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="n_sign4" id="n_sign4" value="<?php echo text($check_res['n_sign4']); ?>"  />
     
</td>
<td style="width:25%">
    Nurse Initials: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="n_inp4" class="form-control" value="<?php echo text($check_res['n_inp4']);?>"/>
</td>
</tr>
</table><br><br>
<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button><br><br>
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
            icon = $(this).next().attr('id');
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
        $("#view_sign").attr("src",id_name);
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        // alert(sign);
        //sign = sign.split(',');
        $('#' + id_name).val(sign);
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


