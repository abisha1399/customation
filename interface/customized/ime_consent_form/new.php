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
$sign_data = sqlStatement("SELECT * FROM `consentform` Where pid=".$_SESSION["pid"]." ORDER BY id DESC");
$sign_data=sqlFetchArray($sign_data);
//echo '<pre>';print_r($sign_data);
$check_res=array();
if ($formid) {
    $sql = "SELECT * FROM `consentform` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}
else{
    if(isset($sign_data['client'])&& $sign_data['client']!='')
    {
        $check_res['client']=$sign_data['client'];
    }

}
// $check_res = $formid ? $check_res : array();
?>
<html>
    <head>
        <title><?php echo xlt("IME CONSENT FORM"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border: 1px solid black">
                <div class="col-12" style="background-color:grey">
                    <h2 class="text-center"><u><?php echo xlt('IME CONSENT FORM'); ?></u></h2>
                    <p class="text-center" style="font-size: 22px;"><?php echo xlt('CONSENT FOR THE RELEASE OF');?></P>
                    <p class="text-center" style="font-size: 22px;"><?php echo xlt('CONFIDENTIAL SUBSTANCE USE TREATEMENT INFORMATION');?></P>
                </div>
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/ime_consent_form/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="col-12 row" style="margin-top: 17px;">
                        <div class="col-6" style="display:flex;">
                            <label style="font-size: 17px;"><?php echo xlt('Client Name :'); ?></label>
                                <div class="form-group">
                                    <input type="text" id="name" value=" <?php echo text($check_res['name']); ?>" name="name" class="form-control" />

                                </div>
                        </div>
                        <div class="col-6" style="display:flex;">
                            <label style="font-size: 17px;"><?php echo xlt('Date Of Birth:'); ?></label>
                                <div class="form-group">
                                    <input type="date" id="date" value="<?php echo text($check_res['date']); ?>" name="date" class="form-control">

                                </div>
                        </div>
                    </div>
                    <div class="col-12" style="margin-left: -15px">
                        <h3 style="border: 1px solid black; background-color:grey;margin-right: -30px;">AUTHORIZATION & ACKNOWLEDGEMENT</h3>
                    </div>
                    <div class="container col-12 mt-2">
                        <p style="font-size: 17px;">I</p>
                        <input type="text" id="first" name="first" value="<?php echo text($check_res['first']); ?>" class="form-control" style="margin-left: 13px;margin-top: -36px;width: 290px;">
                        <p style="margin-left: 310px;margin-top: -30px;font-size: 17px;">, authorize</p>
                        <input type="text" id="second" name="second" value="<?php echo text($check_res['second']); ?>" class="form-control" style="width: 394px;margin-left: 394px;margin-top: -46px;" >
                        <p style="font-size: 17px;">(Provider Agency),Rutgers University Behavioural Health Care(UBHC) in the capacity of the Interim Management Entity(IME) and
                        the New Jersey Department of Human Services/Division of Mental Health and Addiction Services (NJ
                        DRS/DMHAS) to communicate with and disclose to one another information about my substance use treatment.</p>
                        <p style="font-size: 17px;">The purpose of the authorized disclosure is to enable</p>
                        <input type="text" id="third" name="third" value="<?php echo text($check_res['third']); ?>" class="form-control" style="margin-left: 405px;margin-top: -45px;width: 404px;" >
                        <p style="font-size: 17px;">(Provider Agency), UBHC in the capacity of the IME end the NJ DHS/DMHAS to provide me with better,
                        more coordinated treatment and allow for the evaluation and authorization of my treatment.
                        I understand that the information available to these entities will be exchanged verbally and
                        electronically through the New Jersey Substance Abuse Monitoring System (NJSAMS),
                        a secure computer system, and that my information will be maintained in the NJSAMS.</p>
                        <div contentEditable="true" class="text_edit"><?php echo $check_res['text1']??'<p style="font-size: 17px;">I understand that my medical records are protected under federal and state law, including the
                        federal regulations governing Confidentiality of Alcohol and Drug Abuse Patient Records, 42 C.F.R.
                        Part 2, and the Health Insurance Portability and Accountability Act of 1996  (HIPAA),  45 C.F.R. Parts  160 & 164,
                        and  cannot  be disclosed  without  my written consent unless otherwise provided for in the regulations.</p>
                        <p style="font-size: 17px;">I understand that I may be denied services if I refuse to consent to a disclosure for the purpose of treatment, payment
                        or health care operations. I will not be denied services if I refuse to consent to a disclosure for other purposes.</p>
                        <p style="font-size: 17px;">I have been provided a copy of this form.</p> '?></div><input type="hidden" name="text1" id="text1">
                    </div>
                    <div class="col-12" style="margin-left: -15px">
                        <h3 style="border: 1px solid black; background-color:grey;margin-right: -30px;">DESCRIPTION OF INFORMATION TO BE DISCLOSED/RELEASED</h3>
                        <p style="font-size: 17px;">
                        <div contentEditable="true" class="text_edit"><?php echo $check_res['text2']??'
                        All my health information, including my dntg and/or alcohol treatment record and records about other conditions,
                        including medical and mental health conditions, for whioh I might have received treatment.'?></div><input type="hidden" name="text2" id="text2">
                        </p>
                    </div>
                    <div class="col-12" style="margin-left: -15px">
                        <h3 style="border: 1px solid black; background-color:grey;margin-right: -30px;">TERM/EXPIRATION/REVOCATION</h3>
                        <p style="font-size: 17px;">
                        <div contentEditable="true" class="text_edit"><?php echo $check_res['text3']??'This signed Consent will expire one year from today and will remain in effect until that date. I also understand that I may revoke this consent at any time,
                            except to the extent that action has been taken in reliance on it'?></div><input type="hidden" name="text3" id="text3">
                        </p>
                    </div>

                    <div class="col-12" style="margin-left: -15px">
                        <h3 style="border: 1px solid black; background-color:grey;margin-right: -30px;">SIGNATURE</h3>
                    </div>
                    <div class="col-12 row">
                        <div class="col-6" style="display:flex;">
                            <label style="font-size: 17px;"><?php echo xlt('Client Signature :'); ?></label>
                                <div class="form-group">
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" id="client" name="client" value="<?php echo text($check_res['client']); ?>" class="form-control" />
                                    <img src='' id="img_client" style="display:none;width:90%;height:50px;">
                                </div>
                        </div>
                        <div class="col-6" style="display:flex;">
                            <label style="font-size: 17px;"><?php echo xlt('Date:'); ?></label>
                                <div class="form-group">
                                    <input type="date" id="dat" name="dat" value=" <?php echo text($check_res['dat']); ?>" class="form-control">

                                </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-7" style="display:flex;">
                            <label style="font-size: 17px;"><?php echo xlt('Signature of Responsible Party if other than client :'); ?></label>
                                <div class="form-group">
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" id="signature" name="signature" value="<?php echo text($check_res['signature']); ?>" class="form-control" />
                                    <img src='' id="img_signature" style="display:none;width:90%;height:50px;">
                                </div>
                        </div>
                        <div class="col-5" style="display:flex;">
                            <label style="font-size: 17px;"><?php echo xlt('Date:'); ?></label>
                                <div class="form-group">
                                    <input type="date" id="datas" name="datas" value="<?php echo text($check_res['datas']); ?>" class="form-control">

                                </div>
                        </div>
                    </div>

                        <div class="col-12">
                            <label style="font-size: 17px;"><?php echo xlt('Describe authority to sign on behalf of Client:'); ?></label>
                                <div class="form-group">
                                    <input type="text" id="auth" name="auth" value="<?php echo text($check_res['auth']); ?>" class="form-control" style="margin-left:346px; margin-top:-27px;width:300px;">
                                </div>
                        </div>
                        <div class="col-12 row">
                            <div class="col-6" style="display:flex;">
                                <label style="font-size: 17px;"><?php echo xlt('Witness Signature :'); ?></label>
                                    <div class="form-group">
                                         <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                        <input type="hidden" id="witness" name="witness" value="<?php echo text($check_res['witness']); ?>" class="form-control" />
                                        <img src='' id="img_witness" style="display:none;width:90%;height:50px;">
                                    </div>
                            </div>
                            <div class="col-6" style="display:flex;">
                                <label style="font-size: 17px;"><?php echo xlt('Date:'); ?></label>
                                    <div class="form-group">
                                        <input type="date" id="dates" name="dates" value="<?php echo text($check_res['dates']); ?>" class="form-control">

                                    </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="btn-group" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-primary btn-save" style="margin-left: 15px;"><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
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

    $(".btn-save").click(function(){
        
        $('.text_edit').each(function(){
            var dataval = $(this).html();
            $(this).next("input").val(dataval);
            
        });
    })
</script>
