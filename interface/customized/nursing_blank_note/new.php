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
    $sql = "SELECT * FROM `form_nursing_blank_note` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid, $_SESSION["pid"], $_SESSION["encounter"]));
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    <style>
        .pen_icon {
            cursor: pointer;
        }

        .view_icon {
            margin-left: 160px;
            margin-top: -26px;
        }

        .phy_icon {
            margin-left: 213px;
            margin-top: -25px;
        }

        .admissionord {
            font-family: 'Poppins';
        }

        .protocol {
            font-size: 20px;
        }
        textarea {
    width: 100%;
    height: 700px;
}
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <form method="post" name="my_form" id="my_form" action="<?php echo $rootdir; ?>/forms/nursing_blank_note/save.php?id=<?php echo attr_url($formid); ?>" style="width:100%;">
                <table  style="width:100%;" border='1' cellpadding="10" cellspacing="0">
                    <tr style="background-color:black;color:white;">
                        <th style="text-align:center;padding:3px;" colspan='3'>Nursing Blank Note</th>
                    </tr>
                    <tr>
                        <th style="width:50% padding:3px;">Patient name: <input type="text" name="patient_name" value="<?php echo $check_res['patient_name']; ?>"></th>
                        <th style="padding:3px;">Date: <input type="date" name="app_date" value="<?php echo $check_res['app_date']; ?>"></th>
                    </tr>
                </table>
                <table style="width:100%;">
                    <tr>
                        <td><textarea name="text" class="txt"><?php echo $check_res['text'];?></textarea></td>
                    </tr>
                </table>
                <div class="col-6 center">
                    <td>
                        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                        <i class="fas fa-search view_icon" id="sign_1" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="sign" id="sign" value="<?php echo $check_res['sign']; ?>" class="ml-2" />
                    </td>
                    <div>Signature</div>
                </div>
                <div class="form-group" style="margin-top:20px;">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-save"><?php echo xlt('Save'); ?></button>
                        <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
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
            </form>
        </div>
    </div>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    $('.btn-save') .on('click',function(){
        // $('.text_edit').each(function(){            
        //     var dataval = $(this).html();
        //     $(this).next("input").val(dataval);
        //     // alert( $(this).next("input").val());
            
        // });
        $('#my_form').submit();
    });
</script>

</html>
