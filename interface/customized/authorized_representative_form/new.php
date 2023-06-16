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
    $sql = "SELECT * FROM `form_authorized` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Beacon Health Consent"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;padding-top:20px;padding-left: 6px;padding-right: 6px;">
                <div class="col-12">
                    <h2 class="text-center"><?php echo xlt('Authorized Representative Form');?></h2>
                </div>
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/authorized_representative_form/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                     <hr/>
                    <div class="container col-12 mt-2">
                        <p style="font-size: 17px;"><b>Read this information first</b></p>
                        <div contentEditable="true" class="text_edit"><?php 
         echo $check_res['txt1']??'
                        <p style="font-size: 17px;text-align:justify;line-height:1.5;"><b>
                            The Authorized Representative form is used to identify the person(s) who are permitted to have
                        the same rights you have to access your confidential protected health information. By signing
                        this form, you are allowing ValueOptions® to release protected health information to the
                        individual(s) named. Your signature also releases ValueOptions® from any liability of any
                        nature in connection with the release of your protected health information provided that
                        ValueOptions® follows the terms detailed in this form. ValueOptions® is not responsible for
                        any use, misuse or secondary release of information by the individual(s) listed below.
                        </b></p>'?></div><input type="hidden" name="txt1" id="txt1">
                    </div>
                    <hr/>
                    <div class="container col-12 mt-2" >
                        <h4>Step 1:  Complete the demographic information for the member receiving services:</h4>
                    </div>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:50%;">
                       1.<input type="text" id="name" name="name" value="<?php echo text($check_res['name']); ?>" class="form-control" style="border-color: black;"/>

                        <P class="text-center"><b>Name</b></P>
                        <br/>
                        3.<input type="text" id="addr" name="addr" value="<?php echo text($check_res['addr']); ?>" class="form-control" style="border-color: black;"/>

                        <P class="text-center"><b>Address</b></P>
                        <br/>
                        5.<input type="text" id="subscribe" name="subscribe" value="<?php echo text($check_res['subscribe']); ?>" class="form-control" style="border-color: black;"/>

                        <P class="text-center"><b>Subscriber Name</b></P>

                    </td>
                    <td style="width:50%;">
                        2.<input type="date" id="date" name="date" value="<?php echo text($check_res['date']); ?>" class="form-control" style="border-color: black;"/>

                        <P class="text-center"><b>Date of Birth</b></P>
                        <br/>
                        4.<input type="text" id="home" name="home" value="<?php echo text($check_res['home']); ?>" class="form-control" style="border-color: black;"/>

                        <P class="text-center"><b> Home Phone Number</b></P>
                        <br/>
                        6.<input type="text" id="identify" name="identify" value="<?php echo text($check_res['identify']); ?>" class="form-control" style="border-color: black;"/>

                        <P class="text-center"><b>Subscriber Identification Number</b></P>
                    </td>
                    </tr>
                    </table>
                    <hr>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:50%;">
                       7.<b>Member Signature</b>
                       <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                       <input type="hidden" id="sign" name="sign" value="<?php echo text($check_res['sign']); ?>" class="form-control" style="border-color: black;"/>
                       <img src='' class="img" id="img_sign" style="display:none;width:50%;height:100px;" >

                        <br/>
                        8.<b>Parent/Guardian Signature (if required by State Law)</b>
                        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                        <input type="hidden" id="par" name="par" value="<?php echo text($check_res['par']); ?>" class="form-control" style="border-color: black;"/>
                        <img src='' class="img" id="img_par" style="display:none;width:50%;height:100px;" >

                        <br/>

                        9.<b>Witness</b>
                        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                        <input type="hidden" id="witness" name="witness" value="<?php echo text($check_res['witness']); ?>" class="form-control" style="border-color: black;"/>
                        <img src='' class="img" id="img_witness" style="display:none;width:50%;height:100px;" >                        
                       
                    </td>
                    <td style="width:50%;">
                     <input type="date" id="date1" name="date1" value="<?php echo text($check_res['date1']); ?>" class="form-control" style="border-color: black;"/>

                        <P class="text-center"><b>Month/ Day/ Year</b></P>
                    </td>
                    </tr>
                    </table>
                    <hr/>
                    <div class="container col-12 mt-2">
                        <p style="font-size:15px;line-height:1.4;text-align:justify;"><b>Step 2: You <u>must attach</u> a copy of a document that proves an established relationship with the
person(s) you name. Examples include court documents, Durable Power of Attorney or a Health
Care Power of Attorney.<b></p>
                    </div>
                    <hr/>
                    <div class="container col-12 mt-2" >
                        <h4>Step 3: Complete the demographic information for the Authorized Representative:</h4>
                    </div>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>10.Designated Representative:</b></label>
                    <P class="text-center"><b> </b></P>
                    </td>
                    <td style="width:60%;">
                    <input type="text" id="design" name="design" value="<?php echo text($check_res['design']); ?>" class="form-control" style="border-color: black;"/>
                    <P class="text-center"><b>Full Name</b></P>
                    </td>
                    </tr>
                    </table>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>11.Relationship to Member:</b></label>

                    </td>
                    <td style="width:60%;">
                    <input type="text" id="relation" name="relation" value="<?php echo text($check_res['relation']); ?>" class="form-control" style="border-color: black;"/>

                    </td>
                    </tr>
                    </table>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>12.Address of Designated Representative:</b></label>
                    <P class="text-center"></P>
                    <label><b></b></label>
                    <P class="text-center"><b></b></P>
                    </td>
                    <td style="width:60%;">
                    <input type="text" id="street" name="street" value="<?php echo text($check_res['street']); ?>" class="form-control" style="border-color: black;"/>
                    <P class="text-center"><b>Street Address</b></P>
                    <input type="text" id="city" name="city" value="<?php echo text($check_res['city']); ?>" class="form-control" style="border-color: black;"/>
                    <P class="text-center"><b>City, State and Zip Code</b></P>
                    </td>
                    </tr>
                    </table>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>13.Phone Number:</b></label>
                    <input type="text" id="phone" name="phone" value="<?php echo text($check_res['phone']); ?>" class="form-control" style="border-color: black;"/>
                    <P class="text-center"><b>Home</b></P>
                    </td>
                    <td style="width:60%;">
                    <input type="text" id="phone1" name="phone1" value="<?php echo text($check_res['phone1']); ?>" class="form-control" style="border-color: black;"/>
                    <P class="text-center"><b>Work</b></P>

                    </td>
                    </tr>
                    </table>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>14.Expiration Date:</b></label>
                    </td>
                    <td style="width:60%;">
                    <input type="date" id="date2" name="date2" value="<?php echo text($check_res['date2']); ?>" class="form-control" style="border-color: black;"/>

                    </td>
                    </tr>
                    </table>
                    <br/>
                    <div class="container col-12 mt-2" >
                        <div contentEditable="true" class="text_edit"><?php 
         echo $check_res['txt2']??' 
                        <p style="font-size:17px;"><b>       
                    This designation will expire one (1) year from the date it was signed, upon revocation or on the
                    expiration date listed above, whichever occurs sooner. Upon expiration, a new designation must be
                    written in order to be valid. You may cancel this designation in writing at any time.</b>
                    </p>'?></div><input type="hidden" name="txt2" id="txt2">


                        <div class="form-group">
                        <div class="btn-group" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-success btn-save" style="margin-left: 15px;"><?php echo xlt('Save'); ?></button>
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
            var dataval = $(this).html();
            $(this).next("input").val(dataval);
           $errocount = 0;
        if($errocount==0)
        {
            $('#my_form').submit();

        } 
        });
 });
</script>
