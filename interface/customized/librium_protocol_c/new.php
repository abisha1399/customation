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
$check_res= $formid ? formFetch("form_librium_protocol_c", $formid) : array();

 
?>
<html>
    <head>
        <title><?php echo xlt("Ativan Protocol B"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    </head> 
    <body>
       <div class="container-fliud m-4">
        <div class="row ">
            <div class="col-12">
           <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/librium_protocol_c/save.php?id=<?php echo attr_url($formid); ?>">
                <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />       
                <h3>Librium Protocol C</h3>
                        <br/>
                <table style="width:100%;"> 
                    <tr>
                        <th>Patient Name: <input type="text" style="width:50%" name="pat_name1" value="<?php echo $check_res['pat_name1']??''; ?>"></th>
                        <th>Allergies:<input type="text" style="width:70%;border:none;outline:none;" name="allergy" value="<?php echo $check_res['allergy']??''; ?>"><br>
                        DOB:<input type="date" style="width:50%" name="dob1" value="<?php echo $check_res['dob1']??''; ?>"></th>
                    </tr>
                </table> 
                </br>  
                <table style="width:100%;" border="1" cellspacing=0 cellpadding=10>
                        <tr>
                            <th>Medication, Dose Frequency, Route</th>
                            <th>Hour</th>
                            <th>Date/Time</th>	
                            <th>Nurse/Patient Initials</th>
                            <th>Date/Time</th>	
                            <th>Nurse/Patient Initials</th>
                            <th>Date/Time</th>	
                            <th>Nurse/Patient Initials</th>
                        </tr>
                        <tr>
                            <td rowspan="8">Vital Signs 4x daily Ativan 1 mg PO Q 2 hours PRN for Signs and Symptoms of Withdraw; or one of the following, pulse >95, SBP >140, DBP >95. Max 8 doses in 24 hours. Hold for SBP< 90, DBP < 60, Pulse < 60</td>
                            <td>PRN</td>
                            <td><input type="datetime-local" name="date1" value="<?php echo $check_res['date1']??''; ?>"></td>
                            <td><input type="text" name="input1" style="border:none;outline:none;" value="<?php echo $check_res['input1']??''; ?>"></td>
                            <td><input type="datetime-local" name="date2" value="<?php echo $check_res['date2']??''; ?>" ></td>
                            <td><input type="text" name="input2" style="border:none;outline:none;" value="<?php echo $check_res['input2']??''; ?>"></td>
                            <td><input type="datetime-local" name="date3" value="<?php echo $check_res['date3']??''; ?>"></td>
                            <td><input type="text" name="input3" style="border:none;outline:none;" value="<?php echo $check_res['input3']??''; ?>"></td>
                        </tr>
                        <tr>
                            <td>PRN</td>
                            <td><input type="datetime-local" name="date4" value="<?php echo $check_res['date4']??''; ?>"></td>
                            <td><input type="text" name="input4" style="border:none;outline:none;" value="<?php echo $check_res['input4']??''; ?>"></td>
                            <td><input type="datetime-local" name="date5" value="<?php echo $check_res['date5']??''; ?>"></td>
                            <td><input type="text" name="input5" style="border:none;outline:none;" value="<?php echo $check_res['input5']??''; ?>"></td>
                            <td><input type="datetime-local" name="date6" value="<?php echo $check_res['date6']??''; ?>"></td>
                            <td><input type="text" name="input6" style="border:none;outline:none;" value="<?php echo $check_res['input6']??''; ?>"></td>
                        </tr> 
                        <tr>
                            <td>PRN</td>
                            <td><input type="datetime-local" name="date7" value="<?php echo $check_res['date7']??''; ?>"></td>
                            <td><input type="text" name="input7" style="border:none;outline:none;" value="<?php echo $check_res['input7']??''; ?>"></td>
                            <td><input type="datetime-local" name="date8" value="<?php echo $check_res['date8']??''; ?>"></td>
                            <td><input type="text" name="input8" style="border:none;outline:none;" value="<?php echo $check_res['input8']??''; ?>"></td>
                            <td><input type="datetime-local" name="date9" value="<?php echo $check_res['date9']??''; ?>"></td>
                            <td><input type="text" name="input9" style="border:none;outline:none;" value="<?php echo $check_res['input9']??''; ?>"></td>
                        </tr>  
                        <tr>
                            <td>PRN</td>
                            <td><input type="datetime-local" name="date10" value="<?php echo $check_res['date10']??''; ?>"></td>
                            <td><input type="text" name="input10" style="border:none;outline:none;" value="<?php echo $check_res['input10']??''; ?>"></td>
                            <td><input type="datetime-local" name="date11" value="<?php echo $check_res['date11']??''; ?>"></td>
                            <td><input type="text" name="input11" style="border:none;outline:none;" value="<?php echo $check_res['input11']??''; ?>"></td>
                            <td><input type="datetime-local" name="date12" value="<?php echo $check_res['date12']??''; ?>"></td>
                            <td><input type="text" name="input12" style="border:none;outline:none;" value="<?php echo $check_res['input12']??''; ?>"></td>
                        </tr>  
                        <tr>
                            <td>PRN</td>
                            <td><input type="datetime-local" name="date13" value="<?php echo $check_res['date13']??''; ?>"></td>
                            <td><input type="text" name="input13" style="border:none;outline:none;" value="<?php echo $check_res['input13']??''; ?>" ></td>
                            <td><input type="datetime-local" name="date14" value="<?php echo $check_res['date14']??''; ?>"></td>
                            <td><input type="text" name="input14" style="border:none;outline:none;" value="<?php echo $check_res['input14']??''; ?>"></td>
                            <td><input type="datetime-local" name="date15" value="<?php echo $check_res['date15']??''; ?>"></td>
                            <td><input type="text" name="input15" style="border:none;outline:none;" value="<?php echo $check_res['input15']??''; ?>"></td>
                        </tr>  
                        <tr>
                            <td>PRN</td>
                            <td><input type="datetime-local" name="date16" value="<?php echo $check_res['date16']??''; ?>"></td>
                            <td><input type="text" name="input16" style="border:none;outline:none;" value="<?php echo $check_res['input16']??''; ?>"></td>
                            <td><input type="datetime-local" name="date17" value="<?php echo $check_res['date17']??''; ?>"></td>
                            <td><input type="text" name="input17" style="border:none;outline:none;" value="<?php echo $check_res['input17']??''; ?>"></td>
                            <td><input type="datetime-local" name="date18" value="<?php echo $check_res['date18']??''; ?>"></td>
                            <td><input type="text" name="input18" style="border:none;outline:none;" value="<?php echo $check_res['input18']??''; ?>"></td>
                        </tr>  
                        <tr>
                            <td>PRN</td>
                            <td><input type="datetime-local" name="date19" value="<?php echo $check_res['date19']??''; ?>"></td>
                            <td><input type="text" name="input19" style="border:none;outline:none;" value="<?php echo $check_res['input19']??''; ?>"></td>
                            <td><input type="datetime-local" name="date20" value="<?php echo $check_res['date20']??''; ?>"></td>
                            <td><input type="text" name="input20" style="border:none;outline:none;" value="<?php echo $check_res['input20']??''; ?>"></td>
                            <td><input type="datetime-local" name="date21" value="<?php echo $check_res['date21']??''; ?>"></td>
                            <td><input type="text" name="input21" style="border:none;outline:none;" value="<?php echo $check_res['input21']??''; ?>"></td>
                        </tr>     
                        </table>

                        <table style="width:100%;">
                        <tr>
                        <td>Order Date: <input type="date" name="order_date1" style="border-top:none;border-left:none;border-right:none;" value="<?php echo $check_res['order_date1']??''; ?>"></td>
                        <td>Patient Signature:
                            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                            <input type="hidden" name="sign1" id="sign1" value="<?php echo $check_res['sign1']?$check_res['sign1']:'';?>">
                            <img src='' class="img" id="img_sign1" style="display:none;width:20%;height:40px;" ></td>
                        <td> Patient Initials: <input type="text" name="ini1" style="border-top:none;border-left:none;border-right:none;" value="<?php echo $check_res['ini1']??''; ?>" ></td>
                        </tr> 
                        <tr>
                            <td>Nurse Transcribing Orders: <input type="text" name="order1" style="border-top:none;border-left:none;border-right:none;" value="<?php echo $check_res['order1']??''; ?>"></td>
                            <td></td>
                            <td></td>

                        </tr> 
                        <tr>
                            <td>Verifying Nurse:  <input type="text" name="verify_nurse" style="border-top:none;border-left:none;border-right:none;" value="<?php echo $check_res['verify_nurse']??''; ?>"></td>
                            <td>Nurse Signature: 
                            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                            <input type="hidden" name="sign2" id="sign2" value="<?php echo $check_res['sign2']?$check_res['sign2']:'';?>">
                            <img src='' class="img" id="img_sign2" style="display:none;width:20%;height:40px;" ></td>
                           <td> Nurse Initials:<input type="text" name="ini2" style="border-top:none;border-left:none;border-right:none;" value="<?php echo $check_res['ini2']??''; ?>"></td>

                        </tr>   
                        <tr>
                            <td></td>
                            <td>Nurse Signature: 
                            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                            <input type="hidden" name="sign3" id="sign3" value="<?php echo $check_res['sign3']?$check_res['sign3']:'';?>">
                            <img src='' class="img" id="img_sign3" style="display:none;width:20%;height:40px;" ></td>
                           <td> Nurse Initials:<input type="text" name="ini3" style="border-top:none;border-left:none;border-right:none;" value="<?php echo $check_res['ini3']??''; ?>"></td>

                        </tr> 
                        <tr>
                            <td></td>
                            <td>Nurse Signature: 
                            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                            <input type="hidden" name="sign4" id="sign4" value="<?php echo $check_res['sign4']?$check_res['sign4']:'';?>">
                            <img src='' class="img" id="img_sign4" style="display:none;width:20%;height:40px;" ></td>
                           <td> Nurse Initials:<input type="text" name="ini4" style="border-top:none;border-left:none;border-right:none;" value="<?php echo $check_res['ini4']??''; ?>"></td>

                        </tr>    
                        </table>

                        <div>
                            <p>Reason Medication Not Given</p>
                            <ol>
                            <li>Patient Refused</li>
                            <li>Patient’s Condition</li>
                            <li>Hold Per MD order</li>
                            </ol>

                        </div>

                        


                        <div class="form-group mt-4" style="margin-left: 500px;">
                        <div class="btn-group" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-success btn-save" style=" "><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-danger btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
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
