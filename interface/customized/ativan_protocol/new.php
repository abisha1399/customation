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
    $sql = "SELECT * FROM `form_ativan_protocol` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Ativan Protocol B"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    </head> 
    <body>
        <div class="container mt-2">
            <div class="row" style="border:1px solid black;"> 
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/ativan_protocol/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />       
                    <div class="col-12 mt-3">    
                        <table style="width:100%;border:1px solid #dee2e6;border-bottom-style:none;"> 
                            <tr>
                                <td style="width:70%; ">
                                    <h4 class="mt-3 ml-1"><b>Ativan Protocol B DEA # FC8418750 Freehold</b></h4>
                                </td> 
                                <td style="width:30%; ">
                                <label>Allergies:</label>
                                <label><input type="text" style="width:105%;" name="allergy" value="<?php echo text($check_res['allergy']);?>"/></label>
                                </td> 
                            </tr>
                        </table>
                        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <th style="width: 15%;"><label>Patient Name:</label> 
                                <label><input type="text" style="width:105%;" name="patient" value="<?php echo text($check_res['patient']);?>"/></label></th>
                                <th colspan="7" style="text-align:center">DOB: 
                                <input type="date" name="dob" value="<?php echo text($check_res['dob']);?>"/></label></th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Medication, Dosage, Frequency & Rotate</th>
                                <th>Hour</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>                               
                            </tr>
                            <tr>
                                <td>
                                    <label>Ativan 1 mg PO TID on Day of Admission Date:</label> <label><input type="date" name="date1" style="width:88%;" value="<?php echo text($check_res['date1']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td> 
                                    <input type="text" name="ptsign1" class="form-control" value="<?php echo text($check_res['ptsign1']);?>"/>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>12.30 PM</b></td>                               
                                <td> 
                                    <input type="text" name="ptsign2" class="form-control" value="<?php echo text($check_res['ptsign2']);?>"/>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>4.00 PM</b></td>                               
                                <td> 
                                    <input type="text" name="ptsign3" class="form-control" value="<?php echo text($check_res['ptsign3']);?>"/>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 

                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                
                            </tr>
                            <tr>
                                <td>
                                    <label>Ativan 1 mg PO TID on Day 2 Date:</label> <label><input type="date" name="date2" style="width:88%;" value="<?php echo text($check_res['date2']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign4" class="form-control" value="<?php echo text($check_res['ptsign4']);?>"/>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>                                
                                                                  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>12.30 PM</b></td>                               
                                <td  style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign5" class="form-control" value="<?php echo text($check_res['ptsign5']);?>"/>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>4.00 PM</b></td>                               
                                <td  style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign6" class="form-control" value="<?php echo text($check_res['ptsign6']);?>"/>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                
                            </tr>
                            <tr>
                                <td>
                                    <label>Ativan 1 mg PO BID on Day 3 Date:</label> <label><input type="date" name="date3" style="width:88%;" value="<?php echo text($check_res['date3']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign7" class="form-control" value="<?php echo text($check_res['ptsign7']);?>"/>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                   
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>4.00 PM</b></td>                               
                                <td  style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign8" class="form-control" value="<?php echo text($check_res['ptsign8']);?>"/>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td>
                                    <label>Ativan 1 mg PO BID on Day 4 Date:</label> <label><input type="date" name="date4" style="width:88%;" value="<?php echo text($check_res['date4']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign9" class="form-control" value="<?php echo text($check_res['ptsign9']);?>"/>
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                   
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                              
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>4.00 PM</b></td>                               
                                <td  style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td>                               
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign10" class="form-control" value="<?php echo text($check_res['ptsign10']);?>"/>
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                              
                            </tr>
                            <tr>
                                <td>
                                    <label>Ativan 1 mg PO in AM Day 5 Date:</label> <label><input type="date" name="date5" style="width:88%;" value="<?php echo text($check_res['date5']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign11" class="form-control" value="<?php echo text($check_res['ptsign11']);?>"/>
                                </td>                                   
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                            </tr>
                            <tr>
                                <td>
                                    <label>Ativan 1 mg PO every 2 hours <b>PRN</b> for signs and Symptoms of Withdraw (CIWA-Ar or B score>28) Pulse>95 or SBP >140 or DBP>95. Max 4 Doses in 24 hours.<b>HOLD</b> for SBP<90 or DBP<60 or Pulse<60.</label>  
                                </td>
                                <td><b>PRN</b></td>                               
                                <td> 
                                    <input type="text" name="prn1" class="form-control" value="<?php echo text($check_res['prn1']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="prn2" class="form-control" value="<?php echo text($check_res['prn2']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="prn3" class="form-control" value="<?php echo text($check_res['prn3']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="prn4" class="form-control" value="<?php echo text($check_res['prn4']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="prn5" class="form-control" value="<?php echo text($check_res['prn5']);?>"/>
                                </td>                                   
                                <td> 
                                    <input type="text" name="prn6" class="form-control" value="<?php echo text($check_res['prn6']);?>"/>
                                </td> 
                            </tr>
                        </table>    
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:25%;">
                                    <label>Order Date:</label>
                                    <input type="date" name="orderdate" value="<?php echo text($check_res['orderdate']);?>"/>
                                </td> 
                                <td style="width:25%;">
                                    <label>Patient Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign" id="ptsign" style="width:60%;" value="<?php echo text($check_res['ptsign']);?>"/>
                                    <img src='' class="img" id="img_ptsign" style="display:none;width:50%;height:100px;" >
                                    
                                </td>
                                <td style="width:25%;">
                                    <label>Patient Initials:</label>
                                    <input type="text" name="ptinitial" value="<?php echo text($check_res['ptinitial']);?>"/>
                                </td>    
                                <td style="width:25%;"> 
                                    <label><b>Reason Medication Not Given</b></label> 
                                    <ol>
                                        <li>Patient Refused</li>
                                        <li>Patient's Condition</li>
                                        <li>Hold Per MD Order</li>
                                    </ol> 
                                    </td>
                            </tr>
                        </table>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:40%;">
                                    <label>Nurse Transcribing Orders:</label>
                                    <input type="text" name="nurse" value="<?php echo text($check_res['nurse']);?>"/>
                                </td>  
                                <td style="width:30%;">
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
                                <td style="width:40%;">
                                    <label>Verifying Nurse:</label>
                                    <input type="text" name="nursever" value="<?php echo text($check_res['nursever']);?>"/>
                                </td>  
                                <td style="width:30%;">
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
                                <td style="width:40%;">
                                     
                                </td>  
                                <td style="width:30%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign2" id="nursign2" style="width:60%;" value="<?php echo text($check_res['nursign2']);?>"/>
                                    <img src='' class="img" id="img_nursign2" style="display:none;width:50%;height:100px;">                                    
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial2" value="<?php echo text($check_res['nurinitial2']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
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
