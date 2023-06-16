<?php

/**
 * Clinical instructions form.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2017-2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
if ($formid) {
    $sql = "SELECT * FROM `form_symptom_assessment` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();

?>
<html>
    <head>
        <title><?php echo xlt("Symptom Assessment for Pulmonary Tuberclosis (TB)"); ?></title>
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
            <div class="row" style="border:1px solid black;">
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/symptom_assessment/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="col-12 mt-3">
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="text-center"><b><u>Symptom Assessment for Pulmonary Tuberculosis (TB)</u></b></h4>

                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label>Client Name:</label>
                                    <input type="text" name="client" value="<?php echo text($check_res['client']);?>"/>
                                </td>
                                <td style="width:50%;">
                                    <label>BirthDate:</label>
                                    <input type="date" name="date" value="<?php echo text($check_res['date']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;border:1px solid black;padding-right:5px;padding-left:5px;">
                                    <label style="margin-top:17px;">Date of Symptom Assessment:</label>
                                    <input type="date" name="date1" style="width: 30%;margin-bottom: 10px;" value="<?php echo text($check_res['date1']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;border:1px solid black;padding-right:5px;padding-left:5px;">
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:10px;"><b>TB-Like Symptoms (check all that apply):<b></label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox style="margin-left: 20px;" name='check1' value="0"<?php if ($check_res["check1"] == "0") {
                                    echo "checked";};?>> Productive Cough of Undiagnosed Cause (more than 3 weeks in duration)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox style="margin-left: 20px;" name='check2' value="0"<?php if ($check_res["check2"] == "0") {
                                    echo "checked";};?>> Coughing up blood (Hemoptysis)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox style="margin-left: 20px;" name='check3' value="0"<?php if ($check_res["check3"] == "0") {
                                    echo "checked";};?>> Unexplained Weight Loss (10 pounds or greater without dieting)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox style="margin-left: 20px;" name='check4' value="0"<?php if ($check_res["check4"] == "0") {
                                    echo "checked";};?>> Night Sweats (regarding of room temparature)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox style="margin-left: 20px;" name='check5' value="0"<?php if ($check_res["check5"] == "0") {
                                    echo "checked";};?>> Unexplained Loss of Appetite</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox style="margin-left: 20px;" name='check6' value="0"<?php if ($check_res["check6"] == "0") {
                                    echo "checked";};?>> Very Easily Tired (Fatigability)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox style="margin-left: 20px;" name='check7' value="0"<?php if ($check_res["check7"] == "0") {
                                    echo "checked";};?>> Fever</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox style="margin-left: 20px;" name='check8' value="0"<?php if ($check_res["check8"] == "0") {
                                    echo "checked";};?>> Chills</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><input type=checkbox style="margin-left: 20px;" name='check9' value="0"<?php if ($check_res["check9"] == "0") {
                                    echo "checked";};?>> Chest Pain</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;border:1px solid black;">
                                    <label style="margin-top:8px;">Name of Licensed Md/RN:</label>
                                    <input type="text" name="licens" style="width: 40%;" value="<?php echo text($check_res['licens']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;border:1px solid black;">
                                    <label style="margin-top:8px;">Signature of Licensed Md/RN:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden"  name="stlicens" id="stlicens" value="<?php echo text($check_res['stlicens']);?>"/>
                                    <img src='' class="img" id="img_stlicens" style="display:none;width:50%;height:100px;" >
                                    <label style="margin-left:130px;">Date:</label>
                                    <input type="date" name="date2" value="<?php echo text($check_res['date2']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;border:1px solid black;margin-top:5px;">
                                    <label><input type=checkbox style="margin-top:8px;margin-left:5px;" name='check10' value="0"<?php if ($check_res["check10"] == "0") {
                                    echo "checked";};?>> Despite education and encourage PT declined PPD administration.</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;border:1px solid black;margin-top:5px;">
                                    <label><input type=checkbox style="margin-top:8px;margin-left:5px;" name='check11' value="0"<?php if ($check_res["check11"] == "0") {
                                    echo "checked";};?>> Patient consented for PPD administration. Patient was educated about the risks and benefits associated with the PPD administration.</label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label>Patient Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="signpt" id="signpt" value="<?php echo text($check_res['signpt']); ?>" />
                                    <img src='' class="img" id="img_signpt" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:50%;">
                                    <label>Date:</label>
                                    <input type="date" name="date3" value="<?php echo text($check_res['date3']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>If PPD RECEIVED WITHIN LAST 3 MONTHS PRIOR TO ADMISSION TO CNT, RN must contact facility where tuberculin skin testing was administrated:</b></label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Facility:</label>
                                    <input type="text" style="width: 40%;" name="facility" value="<?php echo text($check_res['facility']); ?>" />
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>RN spoken to:</label>
                                    <input type="text" style="width: 40%;" name="spoken" value="<?php echo text($check_res['spoken']); ?>" />
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Date:</label>
                                    <input type="date" name="date4" value="<?php echo text($check_res['date4']); ?>" />
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Time:</label>
                                    <input type="time" name="symptime" value="<?php echo text($check_res['symptime']); ?>" />
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label>Date/ Time of Mantoux Read:</label>
                                    <input type="date" name="mantoux" value="<?php echo text($check_res['mantoux']); ?>" />
                                </td>
                                <td style="width:50%;">
                                    <label>Result:</label>
                                    <input type="text" name="result" value="<?php echo text($check_res['result']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Signature of the Licensed RN:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden"  name="rnlicense" id="rnlicense" value="<?php echo text($check_res['rnlicense']); ?>" />
                                    <img src='' class="img" id="img_rnlicense" style="display:none;width:50%;height:100px;" >
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group mt-4" style="margin-left: 465px;">
                        <div class="btn-group" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-success btn-save" style=" "><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-danger btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>
                    </div>
                </form>
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
