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
    $sql = "SELECT * FROM `form_clonidine_protocol_b` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Clonidine Protocol B"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    </head> 
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;"> 
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/clonidine_protocol_b/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />       
                    <div class="col-12 mt-3">    
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="text-center"><b>Clonidine Protocol B</b></h4>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:50%;">
                                    <label></label>     
                                </td> 
                                <td style="width:50%;">
                                    <label>Allergies:</label>
                                    <input type="text" name="allergy" value="<?php echo text($check_res['allergy']);?>"/>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:50%;">
                                    <label>Patient Name:</label>
                                    <input type="text" name="patient" style="width:75%;" value="<?php echo text($check_res['patient']);?>"/>
                                </td>  
                                <td style="width:50%;">
                                    <label>DOB:</label>
                                    <input type="date" name="date" value="<?php echo text($check_res['date']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;table-layout:fixed;display:table;border:1px solid lightgray;">
                            <tr>
                                <th style="border: 1px solid lightgray;width:14%">Medication, Dose, Frequency, Route</th>
                                <th style="border: 1px solid lightgray;width:8%">Hour</th>
                                <th style="border: 1px solid lightgray;width:19%">Date/Time</th>
                                <th style="border: 1px solid lightgray;width:11%">Nurse/Patient Initials</th>
                                <th style="border: 1px solid lightgray;width:19%">Date/Time</th>
                                <th style="border: 1px solid lightgray;width:11%">Nurse/Patient Initials</th>
                                <th style="border: 1px solid lightgray;width:19%">Date/Time</th>
                                <th style="border: 1px solid lightgray;width:11%">Nurse/Patient Initials</th>
                            </tr>
                            <tr>
                                <td>Vitals Signs prn Clonidine</td>
                                <td style="border: 1px solid lightgray;">PRN</td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate1" value="<?php echo text($check_res['clonidate1']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse1" value="<?php echo text($check_res['cloninurse1']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate2" value="<?php echo text($check_res['clonidate2']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse2" value="<?php echo text($check_res['cloninurse2']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate3" value="<?php echo text($check_res['clonidate3']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse3" value="<?php echo text($check_res['cloninurse3']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td>0.05 mg PO Q 2 hours PRN for Signs</td>
                                <td style="border: 1px solid lightgray;">PRN</td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate4" value="<?php echo text($check_res['clonidate4']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse4" value="<?php echo text($check_res['cloninurse4']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate5" value="<?php echo text($check_res['clonidate5']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse5" value="<?php echo text($check_res['cloninurse5']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate6" value="<?php echo text($check_res['clonidate6']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse6" value="<?php echo text($check_res['cloninurse6']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td>and Symptoms of Opioid Withdraw (abdominal/muscle cramping,</td>
                                <td style="border: 1px solid lightgray;">PRN</td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate7" value="<?php echo text($check_res['clonidate7']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse7" value="<?php echo text($check_res['cloninurse7']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate8" value="<?php echo text($check_res['clonidate8']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse8" value="<?php echo text($check_res['cloninurse8']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate9" value="<?php echo text($check_res['clonidate9']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse9" value="<?php echo text($check_res['cloninurse9']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td>N/V, diarrhea, joint pain, lacrimation, rhinorrhea) or</td>
                                <td style="border: 1px solid lightgray;">PRN</td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate10" value="<?php echo text($check_res['clonidate10']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse10" value="<?php echo text($check_res['cloninurse10']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate11" value="<?php echo text($check_res['clonidate11']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse11" value="<?php echo text($check_res['cloninurse11']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate12" value="<?php echo text($check_res['clonidate12']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse12" value="<?php echo text($check_res['cloninurse12']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> one of the following. pulse>95, SBP>140,</td>
                                <td style="border: 1px solid lightgray;">PRN</td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate13" value="<?php echo text($check_res['clonidate13']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse13" value="<?php echo text($check_res['cloninurse13']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate14" value="<?php echo text($check_res['clonidate14']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse14" value="<?php echo text($check_res['cloninurse14']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate15" value="<?php echo text($check_res['clonidate15']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse15" value="<?php echo text($check_res['cloninurse15']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td>DBP>95. Max 10 doses in 24 hours.</td>
                                <td style="border: 1px solid lightgray;">PRN</td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate16" value="<?php echo text($check_res['clonidate16']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse16" value="<?php echo text($check_res['cloninurse16']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate17" value="<?php echo text($check_res['clonidate17']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse17" value="<?php echo text($check_res['cloninurse17']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate18" value="<?php echo text($check_res['clonidate18']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse18" value="<?php echo text($check_res['cloninurse18']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td><b>Hold</b> for SBP<90, DBP<60, Pulse<60.</td>
                                <td style="border: 1px solid lightgray;">PRN</td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate19" value="<?php echo text($check_res['clonidate19']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse19" value="<?php echo text($check_res['cloninurse19']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate20" value="<?php echo text($check_res['clonidate20']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse20" value="<?php echo text($check_res['cloninurse20']);?>"/>
                                </td> 
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="datetime-local" style="margin-left: 4px;width:95%;" name="clonidate21" value="<?php echo text($check_res['clonidate21']);?>"/>
                                </td>
                                <td style="border: 1px solid lightgray;"> 
                                    <input type="text" style="margin-left: 6px;width:80%;" name="cloninurse21" value="<?php echo text($check_res['cloninurse21']);?>"/>
                                </td> 
                            </tr>
                        </table>
                        <br/>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label>Order Date:</label>
                                    <input type="date" name="orderdate" value="<?php echo text($check_res['orderdate']);?>"/>
                                </td>  
                                <td style="width:40%;">
                                    <label>Patient Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign" id="ptsign" style="width:60%;" value="<?php echo text($check_res['ptsign']);?>"/>
                                    <img src='' class="img" id="img_ptsign" style="display:none;width:50%;height:100px;" >
                                     
                                </td>
                                <td style="width:30%;">
                                    <label>Patient Initials:</label>
                                    <input type="text" name="ptinitial" value="<?php echo text($check_res['ptinitial']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label>Verifying Nurse:</label>
                                    <input type="text" name="nurse" value="<?php echo text($check_res['nurse']);?>"/>
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign" id="nursign" style="width:60%;" value="<?php echo text($check_res['nursign']);?>"/>
                                    <img src='' class="img" id="img_nursign" style="display:none;width:50%;height:100px;" >
                                    
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial" value="<?php echo text($check_res['nurinitial']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                     
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign1" id="nursign1" style="width:60%;" value="<?php echo text($check_res['nursign1']);?>"/>
                                    <img src='' class="img" id="img_nursign1" style="display:none;width:50%;height:100px;" >
                                    
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial1" value="<?php echo text($check_res['nurinitial1']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                     
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign2" id="nursign2" style="width:60%;" value="<?php echo text($check_res['nursign2']);?>"/>
                                    <img src='' class="img" id="img_nursign2" style="display:none;width:50%;height:100px;" >
                                   
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial2" value="<?php echo text($check_res['nurinitial2']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <table style="width:100%;"> 
                            <tr>
                                <td>
                                    <label><b>Reason Medication Not Given</b></label>
                                    <ol>
                                        <li>Patient Refused</li>
                                        <li>Patient's Condition</li>
                                        <li>Hold Per MD Order</li>
                                    </ol>         
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
