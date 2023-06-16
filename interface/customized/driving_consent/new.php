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
    $sql = "SELECT * FROM `form_driving_consent` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Driving Consent"); ?></title>
        <?php Header::setupHeader(); ?>
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
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/driving_consent/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="col-12 mt-3">
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label style="font-size:17px;">Date:</label>
                                    <input type="date" name="date" value="<?php echo text($check_res['date']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="text-center"><u><b>Driving Consent</b></u></h4>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <p style="text-align:justify;font-size:17px;">I, <input type="text" name="text1" value="<?php echo text($check_res['text1']);?>"/> <span contentEditable="true" class="text_edit"><?php 
         echo $check_res['txt']??'
          was educated by the medical and clinical staff at the Central for Network Therapy office about the transportation policy specific to ambulatory patients driving while attending his detoxification program. By signing this letter, I acknowledge that I understand that as a patient in the Ambulatory Detoxification program I take it upon myself to drive even thought the medication may or may not influence my ability to operate a vehicle. I was educated of the risks/ benefits of the medication and understand the benefits of the explanation.'?></span><input type="hidden" name="txt" id="txt"></p>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <label style="font-size:17px;">Patient Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="patient" id="patient" value="<?php echo text($check_res['patient']);?>"/>
                                    <img src='' class="img" id="img_patient" style="display:none;width:20%;height:70px;" >
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

    $('.btn-save') .on('click',function(){
     $('.text_edit').each(function(){
            //alert();
            var dataval = $(this).html();
            $(this).next("input").val(dataval);
          // alert( $(this).next("input").val());
          $errocount = 0;
        if($errocount==0)
        {
            $('#my_form').submit();

        }
        });
 });
</script>
