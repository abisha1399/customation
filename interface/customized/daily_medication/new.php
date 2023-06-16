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
    $sql = "SELECT * FROM `form_daily_medication` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Daily Medication"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    </head> 
    <style>
        .thiaminetext{
            height:34px;
            width:130%;
            margin-left:-10px;
        }
    </style>
    <body>
        <div class="container mt-2">
            <div class="row" style="border:1px solid black;"> 
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/daily_medication/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />       
                    <div class="col-12 mt-3">    
                        <table style="width:100%;border:1px solid #dee2e6;border-bottom-style:none;"> 
                            <tr>
                                <td style="width:40%; ">
                                    <h4 class="mt-3 ml-1"><b>Medication Log</b></h4>
                                </td> 
                                <td style="width:60%; ">
                                    <h4 class="mt-3"><b>Daily Medication</b></h4>
                                </td> 
                            </tr>
                        </table>
                        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <th style="width: 12%;"><label>Patient Name:</label> 
                                <label><input type="text" class="form-control" name="patient" value="<?php echo text($check_res['patient']);?>"/></label></th>
                                <th colspan="7" style="text-align:center">DOB: 
                                <input type="date" name="dob" value="<?php echo text($check_res['dob']);?>"/></label></th>
                                <th><label>Allergies:</label>
                                <label><input type="text" class="form-control" name="allergy" value="<?php echo text($check_res['allergy']);?>"/></label>
                                </th>
                                <th colspan="3"></th>
                            </tr>
                            <tr>
                                <th>Medication, Dosage, Frequency & Rotate</th>
                                <th>Time</th>
                                <th>Date/RN Initials</th>
                                <th>Patient Initials</th>
                                <th>Date/RN Initials</th>
                                <th>Patient Initials</th>
                                <th>Date/RN Initials</th>
                                <th>Patient Initials</th>
                                <th>Date/RN Initials</th>
                                <th>Patient Initials</th>
                                <th>Date/RN Initials</th>
                                <th>Patient Initials</th>
                                
                            </tr>
                            <tr>
                                <td>Thiamine 100mg PO NOW supplement</td>
                                <td><b>NOW</b></td>
                                <td> 
                                    <input type="date" name="date1" class="thiaminetext" value="<?php echo text($check_res['date1']);?>"/>
                                </td>                                
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
                                <td>Thiamine 100mg PO Daily supplement</td>
                                <td><b>9.30AM</b></td>
                                <td style="background-color:lightgray;"> 
                                    
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td> 
                                    <input type="date" name="date2" class="thiaminetext" value="<?php echo text($check_res['date2']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign2" class="form-control" value="<?php echo text($check_res['ptsign2']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date3" class="thiaminetext" value="<?php echo text($check_res['date3']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="ptsign3" class="form-control" value="<?php echo text($check_res['ptsign3']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date4" class="thiaminetext" value="<?php echo text($check_res['date4']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign4" class="form-control" value="<?php echo text($check_res['ptsign4']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date5" class="thiaminetext" value="<?php echo text($check_res['date5']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign5" class="form-control" value="<?php echo text($check_res['ptsign5']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td>Folate 1mg PO NOW supplement</td>
                                <td><b>NOW</b></td>
                                <td> 
                                    <input type="date" name="date6" class="thiaminetext" value="<?php echo text($check_res['date6']);?>"/>
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
                                <td>Folate 1mg PO Daily supplement</td>
                                <td><b>9.30AM</b></td>
                                <td style="background-color:lightgray;"> 
                                  
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                    <input type="date" name="date7" class="thiaminetext" value="<?php echo text($check_res['date7']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign7" class="form-control" value="<?php echo text($check_res['ptsign7']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date8" class="thiaminetext" value="<?php echo text($check_res['date8']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="ptsign8" class="form-control" value="<?php echo text($check_res['ptsign8']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date9" class="thiaminetext" value="<?php echo text($check_res['date9']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign9" class="form-control" value="<?php echo text($check_res['ptsign9']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date10" class="thiaminetext" value="<?php echo text($check_res['date10']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign10" class="form-control" value="<?php echo text($check_res['ptsign10']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td>Folate 1mg PO NOW supplement</td>
                                <td><b>NOW</b></td>
                                <td> 
                                    <input type="date" name="date11" class="thiaminetext" value="<?php echo text($check_res['date11']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="ptsign11" class="form-control" value="<?php echo text($check_res['ptsign11']);?>"/>
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
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="pttext1" class="form-control" value="<?php echo text($check_res['pttext1']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="pttext2" class="form-control" value="<?php echo text($check_res['pttext2']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="pttext3" class="form-control" value="<?php echo text($check_res['pttext3']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="pttext4" class="form-control" value="<?php echo text($check_res['pttext4']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="pttext5" class="form-control" value="<?php echo text($check_res['pttext5']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="pttext6" class="form-control" value="<?php echo text($check_res['pttext6']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="pttext7" class="form-control" value="<?php echo text($check_res['pttext7']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="pttext8" class="form-control" value="<?php echo text($check_res['pttext8']);?>"/> 
                                </td> 
                                <td> 
                                    <input type="text" name="pttext9" class="form-control" value="<?php echo text($check_res['pttext9']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="pttext10" class="form-control" value="<?php echo text($check_res['pttext10']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="pttext11" class="form-control" value="<?php echo text($check_res['pttext11']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="pttext12" class="form-control" value="<?php echo text($check_res['pttext12']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td>Thiamine 100mg PO Daily supplement</td>
                                <td><b>9.30AM</b></td>
                                <td> 
                                    <input type="date" name="date12" class="thiaminetext" value="<?php echo text($check_res['date12']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign12" class="form-control" value="<?php echo text($check_res['ptsign12']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date13" class="thiaminetext" value="<?php echo text($check_res['date13']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign13" class="form-control" value="<?php echo text($check_res['ptsign13']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date14" class="thiaminetext" value="<?php echo text($check_res['date14']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign14" class="form-control" value="<?php echo text($check_res['ptsign14']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date15" class="thiaminetext" value="<?php echo text($check_res['date15']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign15" class="form-control" value="<?php echo text($check_res['ptsign15']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date16" class="thiaminetext" value="<?php echo text($check_res['date16']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="ptsign16" class="form-control" value="<?php echo text($check_res['ptsign16']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td>Folate 1mg PO Daily supplement</td>
                                <td><b>9.30 AM</b></td>
                                <td> 
                                    <input type="date" name="date17" class="thiaminetext" value="<?php echo text($check_res['date17']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="ptsign17" class="form-control" value="<?php echo text($check_res['ptsign17']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date18" class="thiaminetext" value="<?php echo text($check_res['date18']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="ptsign18" class="form-control" value="<?php echo text($check_res['ptsign18']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date19" class="thiaminetext" value="<?php echo text($check_res['date19']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="ptsign19" class="form-control" value="<?php echo text($check_res['ptsign19']);?>"/>
                                </td> 
                                <td> 
                                    <input type="date" name="date20" class="thiaminetext" value="<?php echo text($check_res['date20']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="ptsign20" class="form-control" value="<?php echo text($check_res['ptsign20']);?>"/>
                                </td>
                                <td> 
                                    <input type="date" name="date21" class="thiaminetext" value="<?php echo text($check_res['date21']);?>"/>
                                </td>                                
                                <td> 
                                    <input type="text" name="ptsign21" class="form-control" value="<?php echo text($check_res['ptsign21']);?>"/>
                                </td>
                            </tr>
                        </table>    
                        <br/>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label>Order Date:</label>
                                    <input type="date" name="orderdate" value="<?php echo text($check_res['orderdate']);?>"/>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:50%;">
                                    <label>Nurse Transcribing Orders:</label>
                                    <input type="text" name="nurse" value="<?php echo text($check_res['nurse']);?>"/>
                                </td>  
                                <td style="width:20%;">
                                     
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Reason Medication Not Given</b></label>
                                    <ol>
                                        <li>Patient Refused</li>
                                        <li>Patient's Condition</li>
                                        <li>Hold Per MD Order</li>
                                    </ol> 
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label>Verifying Nurse:</label>
                                    <input type="text" name="nursever" value="<?php echo text($check_res['nursever']);?>"/>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
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
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                     
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign3" id="nursign3" style="width:60%;" value="<?php echo text($check_res['nursign3']);?>"/>
                                    <img src='' class="img" id="img_nursign3" style="display:none;width:50%;height:100px;" >
                                    
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial3" value="<?php echo text($check_res['nurinitial3']);?>"/>
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
