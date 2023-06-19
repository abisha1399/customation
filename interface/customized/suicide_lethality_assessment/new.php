<?php

/**
 * Medication Education Document form.
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
    $sql = "SELECT * FROM `form_suicide_lethality_assessment` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("SUICIDE LETHALITY ASSESSMENT"); ?></title>
        <?php Header::setupHeader(); ?>
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;"> 
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/suicide_lethality_assessment/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />   
                    <div class="col-12 mt-3">    
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;border:1px solid black;border-top-style:none;border-right-style:none;border-left-style:none;">
                                    <h5 class="text-center"><b>SUICIDE LETHALITY ASSESSMENT</b></h5>
                                </td>  
                            </tr>
                        </table>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:6px;"><b>Presence of Risk Factors</b></label>
                                </td>  
                            </tr>
                        </table>
                        <table style="width:100%;"> 
                            <tr>
                                <td>
                                    <label><input type=checkbox  name='check1' value="0"<?php if ($check_res["check1"] == "0") {
                                    echo "checked";};?>> Thoughts regarding death and dying
                                    <input type="text" name="suicidetext1" value="<?php echo text($check_res['suicidetext1']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check2' value="0"<?php if ($check_res["check2"] == "0") {
                                    echo "checked";};?>> Exposure to another's suicidal behaviour
                                    <input type="text" name="suicidetext2" value="<?php echo text($check_res['suicidetext2']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check3' value="0"<?php if ($check_res["check3"] == "0") {
                                    echo "checked";};?>> Family History of suicide
                                    <input type="text" name="suicidetext3" value="<?php echo text($check_res['suicidetext3']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check4' value="0"<?php if ($check_res["check4"] == "0") {
                                    echo "checked";};?>> Depression of hopelessness
                                    <input type="text" name="suicidetext4" value="<?php echo text($check_res['suicidetext4']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check5' value="0"<?php if ($check_res["check5"] == "0") {
                                    echo "checked";};?>> Previous suicide attempts
                                    <input type="text" name="suicidetext5" value="<?php echo text($check_res['suicidetext5']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check6' value="0"<?php if ($check_res["check6"] == "0") {
                                    echo "checked";};?>> Alcohol or drug use by patient or family
                                    <input type="text" name="suicidetext6" value="<?php echo text($check_res['suicidetext6']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check7' value="0"<?php if ($check_res["check7"] == "0") {
                                    echo "checked";};?>> Poor Coping Skills
                                    <input type="text" name="suicidetext7" value="<?php echo text($check_res['suicidetext7']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check8' value="0"<?php if ($check_res["check8"] == "0") {
                                    echo "checked";};?>> Relationship Loss
                                    <input type="text" name="suicidetext8" value="<?php echo text($check_res['suicidetext8']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check9' value="0"<?php if ($check_res["check9"] == "0") {
                                    echo "checked";};?>> Organized or serious attempt
                                    <input type="text" name="suicidetext9" value="<?php echo text($check_res['suicidetext9']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check10' value="0"<?php if ($check_res["check10"] == "0") {
                                    echo "checked";};?>> Social support unreliable or unavailable/family conflict
                                    <input type="text" name="suicidetext10" value="<?php echo text($check_res['suicidetext10']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check11' value="0"<?php if ($check_res["check11"] == "0") {
                                    echo "checked";};?>> State future attempt (determine to repeat or ambivalent)
                                    <input type="text" name="suicidetext11" value="<?php echo text($check_res['suicidetext11']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check12' value="0"<?php if ($check_res["check12"] == "0") {
                                    echo "checked";};?>> Legal Problems
                                    <input type="text" name="suicidetext12" value="<?php echo text($check_res['suicidetext12']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check13' value="0"<?php if ($check_res["check13"] == "0") {
                                    echo "checked";};?>> Physical/ Sexual abuse
                                    <input type="text" name="suicidetext13" value="<?php echo text($check_res['suicidetext13']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check14' value="0"<?php if ($check_res["check14"] == "0") {
                                    echo "checked";};?>> History of assault, aggression, violence, impulsive behaviors
                                    <input type="text" name="suicidetext14" value="<?php echo text($check_res['suicidetext14']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check15' value="0"<?php if ($check_res["check15"] == "0") {
                                    echo "checked";};?>> Difficulties dealing with significant stressors (i.e.,sexual orientation, unplanned preganancy)
                                    <input type="text" name="suicidetext15" value="<?php echo text($check_res['suicidetext15']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check16' value="0"<?php if ($check_res["check16"] == "0") {
                                    echo "checked";};?>> Guilt, shame or fear of humiliation
                                    <input type="text" name="suicidetext16" value="<?php echo text($check_res['suicidetext16']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check17' value="0"<?php if ($check_res["check17"] == "0") {
                                    echo "checked";};?>> Recent loss/Anniversary of a loss/Anticipated loss
                                    <input type="text" name="suicidetext17" value="<?php echo text($check_res['suicidetext17']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check18' value="0"<?php if ($check_res["check18"] == "0") {
                                    echo "checked";};?>> Poor sleep
                                    <input type="text" name="suicidetext18" value="<?php echo text($check_res['suicidetext18']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check19' value="0"<?php if ($check_res["check19"] == "0") {
                                    echo "checked";};?>> Chronic illness (Chronic Pain, Dialysis)
                                    <input type="text" name="suicidetext19" value="<?php echo text($check_res['suicidetext19']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check20' value="0"<?php if ($check_res["check20"] == "0") {
                                    echo "checked";};?>> History of a traumatic event, (Experienced and or Witnessed) 
                                    <input type="text" name="suicidetext20" value="<?php echo text($check_res['suicidetext20']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check21' value="0"<?php if ($check_res["check21"] == "0") {
                                    echo "checked";};?>> Other 
                                    <input type="text" name="suicidetext21" value="<?php echo text($check_res['suicidetext21']); ?>" /></label>
                                </td>  
                            </tr>
                        </table>
                        <hr/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:6px;"><b>Presence of Protective Factors/ SNAP Assessment</b></label>
                                </td>  
                            </tr>
                        </table>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check22' value="0"<?php if ($check_res["check22"] == "0") {
                                    echo "checked";};?>> Positive experience with professional help
                                    <input type="text" name="suicidetext22" value="<?php echo text($check_res['suicidetext22']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check23' value="0"<?php if ($check_res["check23"] == "0") {
                                    echo "checked";};?>> Life Skills (decision-making, problem solving, conflict mgmt)
                                    <input type="text" name="suicidetext23" value="<?php echo text($check_res['suicidetext23']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check24' value="0"<?php if ($check_res["check24"] == "0") {
                                    echo "checked";};?>> Strong support system
                                    <input type="text" name="suicidetext24" value="<?php echo text($check_res['suicidetext24']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox  name='check25' value="0"<?php if ($check_res["check25"] == "0") {
                                    echo "checked";};?>> Future goals
                                    <input type="text" name="suicidetext25" value="<?php echo text($check_res['suicidetext25']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check26' value="0"<?php if ($check_res["check26"] == "0") {
                                    echo "checked";};?>> Religious prohibition/Spirituality
                                    <input type="text" name="suicidetext26" value="<?php echo text($check_res['suicidetext26']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check27' value="0"<?php if ($check_res["check27"] == "0") {
                                    echo "checked";};?>> Willing and able to participate in treatment
                                    <input type="text" name="suicidetext27" value="<?php echo text($check_res['suicidetext27']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check28' value="0"<?php if ($check_res["check28"] == "0") {
                                    echo "checked";};?>> Responsibility to sibilings/friends/pets
                                    <input type="text" name="suicidetext28" value="<?php echo text($check_res['suicidetext28']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check29' value="0"<?php if ($check_res["check29"] == "0") {
                                    echo "checked";};?>> Sobriety
                                    <input type="text" name="suicidetext29" value="<?php echo text($check_res['suicidetext29']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check30' value="0"<?php if ($check_res["check30"] == "0") {
                                    echo "checked";};?>> Presenting thoughts
                                    <input type="text" name="suicidetext30" value="<?php echo text($check_res['suicidetext30']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check31' value="0"<?php if ($check_res["check31"] == "0") {
                                    echo "checked";};?>> Individual needs
                                    <input type="text" name="suicidetext31" value="<?php echo text($check_res['suicidetext31']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check32' value="0"<?php if ($check_res["check32"] == "0") {
                                    echo "checked";};?>> Physical Abilities
                                    <input type="text" name="suicidetext32" value="<?php echo text($check_res['suicidetext32']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check33' value="0"<?php if ($check_res["check33"] == "0") {
                                    echo "checked";};?>> Preferences
                                    <input type="text" name="suicidetext33" value="<?php echo text($check_res['suicidetext33']); ?>" /></label>
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check34' value="0"<?php if ($check_res["check34"] == "0") {
                                    echo "checked";};?>> Urgent needs
                                    <input type="text" name="suicidetext34" value="<?php echo text($check_res['suicidetext34']); ?>" /></label>
                                </td>  
                            </tr>
                        </table>
                        <hr/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Current Stressors (as per patient):</b></label>
                                </td>  
                            </tr>
                        </table>
                        <table style="width:100%;margin-top:8px;"> 
                            <tr>
                                <td style="width:100%;">
                                    <textarea name="stressor" class="form-control" cols="200" rows="5"><?php echo text($check_res['stressor']);?></textarea>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Motivation for Treatment (as per patient):</b></label>
                                    <textarea name="motivation" class="form-control" cols="200" rows="5"> <?php echo text($check_res['motivation']);?></textarea>
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
    </body>
</html>
