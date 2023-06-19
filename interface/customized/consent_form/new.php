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
    $sql = "SELECT * FROM `form_consent` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Consent Form"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;">
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/consent_form/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="col-12 mt-3">
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="text-center"><u><b>Consent Form</b></u></h4>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <p style="text-align:justify;font-size:17px;">I, <input type="text" name="consenttext" style="width: 30%;" value="<?php echo text($check_res['consenttext']);?>"/> (patient name) am agreeing that I will not be ingesting any illegal substances, narcotics, or medications from any other facility that may hinder my detoxification process at CNT. I am agreeing to leave any and all substances and medically necessary medication off the premises of CNT unless documented that the medication is medically necessary in conjuction with a documented medical condition or if cleared by a CNT M.D or RN staff.I am agreeing I will not be using any other substances other than the prescribed medication from the CNT physician when going outside CNT premises. I am agreeing that will I not bring any kind of weapons on to CNT premises or be involved in any physical or verbal violence with any staff member or patient. I will be held responsible for my own actions if found ingesting any illegal substances while in treatment at CNT with the prescribed medications from CNT. I will also be held responsible if involved in any violence (physical or verbal) while in CNT care. CNT has the right to terminate my treatment if I'm found ingesting any illegal substances or any medication not cleared by a CNT MD or RN staff, distributing any substance on CNT premises, cheeking(hiding medication in the mouth) prescribed medications given by CNT, involved in any violence (physical or verbal) or possession of weapons of any kind. CNT will not be held accountable for my actions outside my acknowledge consent of CNT treatment and therapy. By signing below I agree to these terms and conditions.</p>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <label style="font-size:17px;">Patient Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="patient" id="patient" style="width: 30%;" value="<?php echo text($check_res['patient']);?>"/>
                                    <img src='' id="img_patient" style="display:none;width:30%;height:50px;">
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <label style="font-size:17px;">Date/Time:</label>
                                    <input type="datetime-local" name="ptdate" value="<?php echo text($check_res['ptdate']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <label style="font-size:17px;">Staff/Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="staff" id="staff" style="width: 30%;" value="<?php echo text($check_res['staff']);?>"/>
                                    <img src='' id="img_staff" style="display:none;width:50%;height:50px;">
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <label style="font-size:17px;">Date/Time:</label>
                                    <input type="datetime-local" name="stdate" value="<?php echo text($check_res['stdate']);?>"/>
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
