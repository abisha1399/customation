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
    $sql = "SELECT * FROM `form_authorized_representative` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Authorized Representative Request"); ?></title>
        <?php Header::setupHeader(); ?>
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;padding-top:20px;padding-left:5px;padding-right:5px">
                <div class="col-3">
                <h2 class="" style="font-size: 50px;"><b><?php echo xlt('aetna');?></b></h2>
                </div>   
                <div class="col-9">
                <h2><?php echo xlt('Authorized Representative Request'); ?></h2>
                </div>
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/authorized_representative_request/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />    
                    <div class="col-12 row" style="margin-left:765px;">   
                         <label style="font-size: 17px;"><?php echo xlt('FAX Number:'); ?></label>
                                    <div class="form-group">
                                        <input type="text" id="fax" name="fax" value="<?php echo text($check_res['fax']); ?>" class="form-control" />
                                        
                                    </div>
                             </div> 
                        <div class="col-12 row" style="padding-top: 20px;">   
                            <div class="col-6" style="display:flex;">
                                <label style="font-size: 17px;"><?php echo xlt('Member Name :'); ?></label>
                                    <div class="form-group">
                                        <input type="text" id="name" name="name" value="<?php echo text($check_res['name']); ?>" class="form-control" />
                                        
                                    </div>
                             </div> 
                            <div class="col-6" style="display:flex;">
                                <label style="font-size: 17px;"><?php echo xlt('Aetna ID Number:'); ?></label>
                                    <div class="form-group">
                                        <input type="text" id="num" name="num" value=" <?php echo text($check_res['num']); ?>" class="form-control">   
                                    </div>
                            </div>
                         
                        <div class="col-12">
                            <label style="font-size: 17px;"><?php echo xlt('Provider of Service:'); ?></label>
                                <div class="form-group">
                                    <input type="text" id="prov" name="prov" value="<?php echo text($check_res['prov']); ?>" class="form-control" style="margin-left:153px; margin-top:-35px;width:300px;">
                                </div>
                        </div> 
                        <div class="col-12">
                            <label style="font-size: 17px;"><?php echo xlt('Name and Dates of Service or Proposed Service:'); ?></label>
                                <div class="form-group">
                                    <input type="text" id="service" name="service" value="<?php echo text($check_res['service']); ?>" class="form-control" style="margin-left:380px; margin-top:-35px;width:300px;">
                                </div>
                        </div> 
                    </div> 
                    <div class="col-12 mt-2">
                        <p style="font-size: 17px;">I</p>
                        <input type="text" id="first" name="first" style="margin-top: -40px;margin-left: 15px;width: 99%;" value="<?php echo text($check_res['first']); ?>" class="form-control"/>
                        <p style="font-size: 17px;">, do hereby name Print the name of the member
                    who is receiving the service or supply</p>
                    <input type="text" id="second" name="second" value="<?php echo text($check_res['second']); ?>" class="form-control" />
                <p style="font-size: 17px;">Print the name of the person who is being authorized to act on the member’s behalf</p>    
                </div>
                <div class="col-12 row">
                <p style="font-size: 17px;">to act as my authorized representative in requesting (check one)
                <input type=checkbox name='check1' value="0"<?php if ($check_res{"check1"} == "0") {
                echo "checked";};?>> a complaint or
                <input type=checkbox name='check2' value="0"<?php if ($check_res{"check2"} == "0") {
                echo "checked";};?>> an appeal from Aetna regarding the
                    above-noted service or proposed service.
                    </p>
                    </div>
                    <div class="col-12 ">
                <p style="font-size: 17px;"><b>IMPORTANT: Your signature below means that you understand and agree to the following:</b></p>
                    </div>
                    <div class="col-12 row">
                        <p style="font-size: 17px;">● In conjunction with this (check one)
                            <input type=checkbox name='check3' value="0"<?php if ($check_res{"check3"} == "0") {
                echo "checked";};?>> complaint or
                            <input type=checkbox name='check4' value="0"<?php if ($check_res{"check4"} == "0") {
                echo "checked";};?>> appeal, Aetna may disclose Protected Health Information (“PHI”)
                                to the above-named authorized representative (“Representative”).
                        </p>
                        <p style="font-size: 17px;text-align:justify;"><b>● The PHI disclosed pursuant to this authorization may include diagnosis and treatment information, including
                        information pertaining to chronic diseases, behavioral health conditions, alcohol or substance abuse,
                        communicable diseases, sexually-transmitted diseases, HIV/AIDS, and/or genetic marker information.</b></p>
                        <p style="font-size: 17px;text-align:justify;">● Information disclosed pursuant to this authorization may be redisclosed by the Representative and may no longer be
                        protected by federal or state privacy regulations.</p>
                        <p style="font-size: 17px;">● If you would like to pursue (check one)
                            <input type=checkbox name='check5' value="0"<?php if ($check_res{"check5"} == "0") {
                echo "checked";};?>> a complaint or
                            <input type=checkbox name='check6' value="0"<?php if ($check_res{"check6"} == "0") {
                echo "checked";};?>> an appeal, at the Representative’s request, but do not want
                            the Representative to receive any PHI or other information related to the (check one)
                            <input type=checkbox name='check7' value="0"<?php if ($check_res{"check7"} == "0") {
                echo "checked";};?>> complaint or
                            <input type=checkbox name='check8' value="0"<?php if ($check_res{"check8"} == "0") {
                echo "checked";};?>> appeal,
                            including the (check one)
                            <input type=checkbox name='check9' value="0"<?php if ($check_res{"check9"} == "0") {
                echo "checked";};?>> complaint or
                            <input type=checkbox name='check10' value="0"<?php if ($check_res{"check10"} == "0") {
                echo "checked";};?>> appeal, decision, you may indicate that choice by checking the box on the
                            signature line below.
                        </p>
                        <p style="font-size: 17px;text-align:justify;">● Your ability to enroll in an Aetna plan, and your eligibility for benefits and payment for services, will not be affected if you
                            do not sign this form. However, without your signature, we cannot process the (check one)
                            <input type=checkbox name='check11' value="0"<?php if ($check_res{"check11"} == "0") {
                echo "checked";};?>> complaint or
                            <input type=checkbox name='check12' value="0"<?php if ($check_res{"check12"} == "0") {
                echo "checked";};?>> appeal,
                            initiated by the Representative.
                        </p>
                        <p style="font-size: 17px;text-align:justify;">● This authorization is only valid for the duration of the (check one)
                            <input type=checkbox name='check13' value="0"<?php if ($check_res{"check13"} == "0") {
                echo "checked";};?>> complaint or
                            <input type=checkbox name='check14' value="0"<?php if ($check_res{"check14"} == "0") {
                echo "checked";};?>> appeal. If you sign this form, you
                            may revoke the authorization at any time by notifying Aetna in writing at the address above. Revoking this authorization
                            will not have any effect on actions that Aetna took in reliance on the authorization before we received the notification.
                        </p>
                    </div>
                    <div class="col-12 row">
                        <p style="font-size: 17px;text-align:justify;">
                            <input type=checkbox name='check15' value="0"<?php if ($check_res{"check15"} == "0") {
                echo "checked";};?>> Please accept this (check one)
                            <input type=checkbox name='check16' value="0"<?php if ($check_res{"check16"} == "0") {
                echo "checked";};?>> complaint or
                            <input type=checkbox name='check17' value="0"<?php if ($check_res{"check17"} == "0") {
                echo "checked";};?>> appeal, from my representative on my behalf; however, forward all
                            information related to this (check one)
                            <input type=checkbox name='check18' value="0"<?php if ($check_res{"check18"} == "0") {
                echo "checked";};?>> complaint or
                            <input type=checkbox name='check19' value="0"<?php if ($check_res{"check19"} == "0") {
                echo "checked";};?>> appeal,
                            including the (check one)
                            <input type=checkbox name='check20' value="0"<?php if ($check_res{"check20"} == "0") {
                echo "checked";};?>> complaint or
                            <input type=checkbox name='check21' value="0"<?php if ($check_res{"check21"} == "0") {
                echo "checked";};?>> appeal
                            decision and any request you may have for additional information, to my attention only.
                        </p>
                    </div>
                    <div class="col-12 row" style="padding-top: 20px;margin-top: 20px;">   
                            <div class="col-6" style="display:flex;">
                                <label style="font-size: 17px;"><?php echo xlt('Signature :'); ?></label>
                                    <div class="form-group">
                                        <input type="text" id="sign" name="sign" value="<?php echo text($check_res['sign']); ?>" class="form-control" />
                                        
                                    </div>
                             </div> 
                            <div class="col-6" style="display:flex;">
                                <label style="font-size: 17px;"><?php echo xlt('Date:'); ?></label>
                                    <div class="form-group">
                                        <input type="date" id="date" name="date" value="<?php echo text($check_res['date']); ?>" class="form-control">   
                                    </div>
                            </div>
                         
                        <div class="col-12">
                            <label style="font-size: 17px;"><?php echo xlt('Print Name:'); ?></label>
                                <div class="form-group">
                                    <input type="text" id="print" name="print" value="<?php echo text($check_res['print']); ?>" class="form-control" style="margin-left:96px; margin-top:-35px;width:300px;">
                                </div>
                        </div> 
                        <div class="col-12">
                            <label style="font-size: 17px;"><?php echo xlt('If person signing this Authorization is not the Member, describe relationship to the Member (i.e. Parent, Legal
                            Representative:'); ?></label>
                                <div class="form-group">
                                    <input type="text" id="auth" name="auth" value="<?php echo text($check_res['auth']); ?>" class="form-control">
                                </div>
                        </div> 
                       
                    </div> 
                    <p style="text-align:justify;">Legal Representatives signing this authorization on behalf of a Member must furnish a copy of a health care power of attorney, or other relevant document
that grants the applicable legal authority.</p>
<div class="form-group">
                        <div class="btn-group" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-success btn-save" style="margin-left: 15px;"><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-danger btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>