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
//echo $formid;
$individual_data = $formid ? formFetch("form_individual_form", $formid) : array();
//echo '<pre>';print_r($individual_data);exit();
?>
<html>
    <head>
        <title><?php echo xlt("Personal Drug Use Questionnaire"); ?></title>

        <?php Header::setupHeader(); ?>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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
                    <div class="heading_class">Center for Network Therapy<br>81 Northfield Ave, Suite 104 West Orange,<br> NJ 07052   (973) 731-1375<br></div>

                    <h2><center><?php echo xlt('Individual Notes'); ?></center></h2>
                    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/individual_form/save.php?id=<?php echo attr_url($formid); ?>">
                        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                         <fieldset>
                            <table style="width:100%" border='1' cellpadding="10" cellspacing="0" >
                                <tr>
                                <td>Client Name:<input type="text" name="client_name1" class="form-control" value="<?php echo text($individual_data['client_name1'] ?? ''); ?>"></td>
                                <td>date:<input type="date" name="date1" class="form-control" value="<?php echo text($individual_data['date1'] ?? ''); ?>"></td>
                                <td colspan="2" >Code & Duration OV-Office .25<br><input type="text" name="code" class="form-control" value="<?php echo $individual_data['code'] ??''; ?>"></td>
                                </tr>
                                <tr>
                                    <td colspan='4'><b>PROBLEM STATEMENT ADDRESSED IN TREATMENT PLAN: <b></td>
                                </tr>
                                <tr>
                                <td colspan='4'>
                                CODES:
                                 <b>OV-Office</b><input type="checkbox" name="code_pb1" value="on" <?php echo isset($individual_data['code_pb1'])&&$individual_data['code_pb1']=='on'?'checked':''; ?>>
                                 V-Field Visit<input type="checkbox" name="code_pb2" value="on" <?php echo isset($individual_data['code_pb2'])&&$individual_data['code_pb2']=='on'?'checked':''; ?>>
                                  G-Group<input type="checkbox" name="code_pb3" value="on" <?php echo isset($individual_data['code_pb3'])&&$individual_data['code_pb3']=='on'?'checked':''; ?>>
                                  F-Family<input type="checkbox" name="code_pb4" value="on" <?php echo isset($individual_data['code_pb4'])&&$individual_data['code_pb4']=='on'?'checked':''; ?>>
                                  PE-Psych Eval<input type="checkbox" name="code_pb5" value="on" <?php echo isset($individual_data['code_pb5'])&&$individual_data['code_pb5']=='on'?'checked':''; ?>>
                                  L-Letter<input type="checkbox" name="code_pb6" value="on" <?php echo isset($individual_data['code_pb6'])&&$individual_data['code_pb6']=='on'?'checked':''; ?>>
                                      TC-Phone Call<input type="checkbox" name="code_pb7" value="on" <?php echo isset($individual_data['code_pb7'])&&$individual_data['code_pb7']=='on'?'checked':''; ?>>
                                         C-Cancelled Appt<input type="checkbox" name="code_pb8" value="on" <?php echo isset($individual_data['code_pb8'])&&$individual_data['code_pb8']=='on'?'checked':''; ?>>
                                             FA-Failed Appt<input type="checkbox" name="code_pb9" value="on" <?php echo isset($individual_data['code_pb9'])&&$individual_data['code_pb9']=='on'?'checked':''; ?>>
                                </td>
                                </tr>
                                <tr>
                                    <td colspan='4'>TIME: .25 = 15 Minutes &nbsp;&nbsp;&nbsp;&nbsp;.5 = 30 Minutes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.75 = 45 Minutes &nbsp;&nbsp;&nbsp;&nbsp;1.00 = 1 Hour

                                </tr>
                                <tr>
                                    <td colspan='4'><center><b>ASAM DIMENSION(S)</b></center><br>
                                    <center>Please choose the dimension(s) that this note addresses</center>
                                    <input type="checkbox"  name='dimension1' value="Dimension1" <?php echo $individual_data['dimension1']&&$individual_data['dimension1']=='Dimension1'?'checked':'' ?>>Dimension 1
                                    <input type="checkbox"  name='dimension2' value="Dimension2" <?php echo $individual_data['dimension2']&&$individual_data['dimension2']=='Dimension2'?'checked':'' ?>>Dimension 2
                                    <input type="checkbox"  name='dimension3' value="Dimension3" <?php echo $individual_data['dimension3']&&$individual_data['dimension3']=='Dimension3'?'checked':'' ?>>Dimension 3
                                    <input type="checkbox"  name='dimension4' value="Dimension4" <?php echo $individual_data['dimension4']&&$individual_data['dimension4']=='Dimension4'?'checked':'' ?>>Dimension 4
                                    <input type="checkbox"  name='dimension5' value="Dimension5" <?php echo $individual_data['dimension5']&&$individual_data['dimension5']=='Dimension5'?'checked':'' ?>>Dimension 5
                                    <input type="checkbox"  name='dimension6' value="Dimension6" <?php echo $individual_data['dimension6']&&$individual_data['dimension6']=='Dimension6'?'checked':'' ?>>Dimension 6
                                </tr>
                                <tr>
                                    <td colspan='4'>DAP FORMAT</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width='50%'>
                                    DATA: Client statements that capture the theme of the session.  Brief statements as quoted by the client may be used, as well as paraphrased summaries.<br>
                                    Observable data or information supporting the subjective statement.  This may include the physical appearance of the client (e.g., sweaty, shaky, comfortable, disheveled, well-groomed, well-nourished), vital signs, results of completed lab/diagnostics tests, and medications the client is currently taking or being prescribed.
                                    </td>
                                    <td colspan="2">
                                    D: Clinician met with client to examine his treatment progress thus far…….
                                    <br><textarea name="treatment1" class="form-control"><?php echo $individual_data['treatment1'] ??''?></textarea>
                                    <br><br>
                                    The client presented and his/her mood was congruent with his/her affect. No SI/HI/AH/VH.
                                    <br><textarea name="client_present" class="form-control"><?php echo $individual_data['client_present'] ??''?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" width='50%'>
                                    ASSESSMENT: The counselor’s or clinician’s assessment of the situation, the session, and the client’s condition, prognosis, response to intervention, and progress in achieving treatment plan goals/objectives.  This may also include the diagnosis with a list of symptoms and information around a differential diagnosis.
                                    </td>
                                    <td colspan="2">
                                    A: The client seemed to be in
                                    <br><textarea name="client_seem" class="form-control"> <?php echo $individual_data['client_seem'] ??''?></textarea>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" width='50%'>
                                    PLAN: The treatment plan moving forward, based on the clinical information acquired and the assessment
                                    </td>
                                    <td colspan="2">
                                    P:
                                    <br><textarea name="treatment_plan" class="form-control"> <?php echo $individual_data['treatment_plan'] ??''?></textarea>

                                    </td>
                                </tr>
                                <tr>
                                <td colspan="2" width='50%'>
                                </td>
                                <td width='60%'>
                                </td>
                                <td>
                                </td>
                                </tr>
                                <tr>
                                <td colspan="2" width='50%'>
                                <div contentEditable="true" class="text_edit"><?php 
                                echo $individual_data['text1']??'';?>
                                </div><input type="hidden" name="text1" id="text1">
                                    
                                </td>
                                <td>
                                Clinician Signature:
                                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                <input type="hidden" class="form-control" name="clinisian_signature"  id="clinisian_signature" value="<?php echo $individual_data['clinisian_signature'] ??''?>">
                                <img src='' class="img" id="img_clinisian_signature" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td>
                                Date<input type="date" class="form-control" name="clinisian_date1" value="<?php echo $individual_data['clinisian_date1'] ??''?>">
                                </td>
                                </tr>
                                <tr>
                                <td colspan="2" width='50%'>
                                <div contentEditable="true" class="text_edit"><?php 
                                echo $individual_data['text2']??'Eddie Mann, MSW, LCSW, LCADC, CCS';?>
                                </div><input type="hidden" name="text2" id="text2">
                                </td>
                                <td>
                                Supervisor Signature:
                                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                <input type="hidden" class="form-control" name="supervisor_signature" id="supervisor_signature" value="<?php echo $individual_data['supervisor_signature'] ??''?>">
                                <img src='' class="img" id="img_supervisor_signature" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td>
                                Date<input type="date" class="form-control" name="supervisor_date1"  value="<?php echo $individual_data['supervisor_date1'] ??''?>">
                                </td>
                                </tr>
                            </table>
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

    $('.dimenstion').change(function ()
{
    var radioclass = $(this).attr('data-id');
    $('.dimenstion').prop('checked',false)
    $(this).prop('checked',true);
});
$('#btn_save') .on('click',function(){
     $('.text_edit').each(function(){
         //alert();
         var dataval = $(this).html();
         $(this).next("input").val(dataval);
         
     });
 });
</script>

