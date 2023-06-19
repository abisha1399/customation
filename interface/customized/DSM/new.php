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
//echo $formid;exit();
$dsm_data = $formid ? formFetch("form_dsm", $formid) : array();
//echo '<pre>';print_r($individual_data);exit();
?>
<html>
    <head>
        <title><?php echo xlt("DSM V Diagnosis"); ?></title>

        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
        <style>
            .outline-text{
                color: black;
                outline: none;
                outline-style: none;
                border: 0px 0px 1px 0px;
                border-top: none;
                border-left: none;
                border-right: none;
                border-bottom: solid #212529de 1px;
                margin: 4px;
            }
            .pen_icon {
            cursor: pointer;
        }
        .heading_class{
            align-items: center;
            justify-content: center;
            display: flex;
            font-size: 19px;
            font-weight: 600;

        }
        .times{
            width: 10%;
        }

        </style>
    </head>
    <body>
        <div class="container mt-3">
            <div class="row">
                <div class="col-12">


                    <h2><center><?php echo xlt('DSM V Diagnosis '); ?></center></h2>
                    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/DSM/save.php?id=<?php echo attr_url($formid); ?>">
                        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                         <fieldset>
                            <h4 style="margin:10px;">DSM V Diagnosis :<input type="text" style="width:50%;border: 1px solid #ced4da; margin:10px;font-size: .875rem;height:30px;font-weight: 400;" name="diagnosis_name" value="<?php echo $dsm_data['diagnosis_name'] ??'';?>" >
                            <table style="width:100%"  cellpadding="10" cellspacing="0" >
                                <tr>
                                    <td><b>Use Disorder / Additional Mental Health Disorder</b><br>
                                        <textarea  name="mental_disorder" class="form-control"> <?php echo $dsm_data['mental_disorder'] ??'';?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Personality Disorder / Intellectual Impairments </b><br>
                                        <textarea  name="personal_disorder" class="form-control"> <?php echo $dsm_data['personal_disorder'] ??'';?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Medical Issues  </b><br>
                                        <textarea  name="medical_isssue" class="form-control"> <?php echo $dsm_data['medical_isssue'] ??'';?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Contributing Stressors </b><br>
                                        <textarea  name="contribute_stress" class="form-control"> <?php echo $dsm_data['contribute_stress'] ??'';?></textarea>
                                    </td>
                                </tr>
                            </table>
                            <div style="margin-top:20px;">
                             <table tyle="width:100%"  cellpadding="10" cellspacing="0">
                                <tr>
                                    <td style="width:50%;">Clinical Coordinator:&nbsp;
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="clinical_coordinator" id="clinical_coordinator" value="<?php echo $dsm_data['clinical_coordinator'] ??'';?>">
                                    <img src='' class="img" id="img_clinical_coordinator" style="display:none;width:50%;height:100px;" >
                                    </td>
                                    <td style="width:50%;">Admission Date: <input type="date" name="admission_dete1" value="<?php echo $dsm_data['admission_dete1'] ??'';?>"></td>
                                </tr>
                                <tr>
                                    <td style="width:100%;" colspan="2"><div contentEditable="true" class="text_edit"><?php 
                                    echo $dsm_data['text1']??'xx, MSW, LSW, LCADC Intern';?>
                                    </div><input type="hidden" name="text1" id="text1"><br>
                                    <textarea  name="intern" class="form-control"><?php echo $dsm_data['diagnosis_name'] ??'';?></textarea>
                                </tr>
                                <tr>
                                    <td style="width:50%;">Clinical Supervisor:&nbsp;
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                     <input type="hidden" name="clinical_supervisor" id="clinical_supervisor" value="<?php echo $dsm_data['clinical_supervisor'] ??'';?>">
                                     <img src='' class="img" id="img_clinical_supervisor" style="display:none;width:50%;height:100px;" >
                                    </td>
                                    <td style="width:50%;">Admission Date: <input type="date" name="admission_dete2" value="<?php echo $dsm_data['admission_dete2'] ??'';?>"></td>
                                </tr>
                                <tr>
                                    <td style="width:100%;" colspan="2"><div contentEditable="true" class="text_edit"><?php 
                                    echo $dsm_data['text2']??'Eddie Mann, MSW, LCSW, LCADC, CCS';?>
                                    </div><input type="hidden" name="text2" id="text2"><br>
                                    <textarea  name="msw" class="form-control"><?php echo $dsm_data['msw'] ??'';?></textarea>
                                </tr>
                             </table>
                            </div>
                         </fieldset>
                         <br>
                        <div class="form-group">
                            <div class="btn-group" role="group">
                                <button type="submit" onclick='top.restoreSession()' id='btn_save' class="btn btn-primary btn-save"><?php echo xlt('Save'); ?></button>
                                <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                            </div>
                        </div>
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
    $('#btn_save') .on('click',function(){
     $('.text_edit').each(function(){
         //alert();
         var dataval = $(this).html();
         $(this).next("input").val(dataval);
         
     });
 });
</script>

