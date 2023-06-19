<?php

/**
 * History and Physical Evaluation form.
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
    $sql = "SELECT * FROM `form_history_and_physical_evaluation` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("History and Physical Evaluation"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;">
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/history_and_physical_evaluation/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="col-12 mt-3">
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="text-center"><b>History and Physical Evaluation</b></h4>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Date:</label>
                                    <input type="date" name="date" value="<?php echo text($check_res['date']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:40%;">
                                    <label>Pt Last Name:</label>
                                    <input type="text" name="lname" style="width:75%;" value="<?php echo text($check_res['lname']);?>"/>
                                </td>
                                <td style="width:40%;">
                                    <label>Pt First Name:</label>
                                    <input type="text" name="fname" style="width:75%;" value="<?php echo text($check_res['fname']);?>"/>
                                </td>
                                <td style="width:20%;">
                                    <label>D.O.B:</label>
                                    <input type="date" name="date1" style="margin-top: -30px;margin-left: 53px;" value="<?php echo text($check_res['date1']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Allergies:</label>
                                    <input type="text" name="allergy" style="width:50%;" value="<?php echo text($check_res['allergy']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Admitting Diagnosis:</label>
                                    <input type="text" name="diagnosis" style="width:60%;" value="<?php echo text($check_res['diagnosis']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label>Cheif Compliant:</label>
                                    <input type="text" name="compliant" style="width:63%;" value="<?php echo text($check_res['compliant']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:20%;">
                                    <label>Vital Signs:</label>
                                    <label>B.P:</label>
                                    <input type="text" name="bp" style="width:44%;" value="<?php echo text($check_res['bp']);?>"/>
                                </td>
                                <td style="width:20%;">
                                    <label>HR:</label>
                                    <input type="text" name="hr" style="width:80%;" value="<?php echo text($check_res['hr']);?>"/>
                                </td>
                                <td style="width:20%;">
                                    <label>RR:</label>
                                    <input type="text" name="rr" style="width:70%;" value="<?php echo text($check_res['rr']);?>"/>
                                </td>
                                <td style="width:20%;">
                                    <label>Temp:</label>
                                    <input type="text" name="temp" style="width:70%;" value="<?php echo text($check_res['temp']);?>"/>
                                </td>
                                <td style="width:20%;">
                                    <label>O2 Sat:</label>
                                    <input type="text" name="sat" style="width:60%;" value="<?php echo text($check_res['sat']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <th>SYSTEM</th>
                                <th>OK</th>
                                <th>PROBLEMS FOUND</th>
                                <th>Problem found? Action Taken/ TX</th>
                            </tr>
                            <tr>
                                <td>Eyes</td>
                                <td>
                                    <input type="text" name="ok1" value="<?php echo text($check_res['ok1']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob1" value="<?php echo text($check_res['prob1']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action1" value="<?php echo text($check_res['action1']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Ears</td>
                                <td>
                                    <input type="text" name="ok2" value="<?php echo text($check_res['ok2']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob2" value="<?php echo text($check_res['prob2']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action2" value="<?php echo text($check_res['action2']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Teeth, throat, Mouth</td>
                                <td>
                                    <input type="text" name="ok3" value="<?php echo text($check_res['ok3']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob3" value="<?php echo text($check_res['prob3']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action3" value="<?php echo text($check_res['action3']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Cardiovascular</td>
                                <td>
                                    <input type="text" name="ok4" value="<?php echo text($check_res['ok4']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob4" value="<?php echo text($check_res['prob4']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action4" value="<?php echo text($check_res['action4']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Digestive</td>
                                <td>
                                    <input type="text" name="ok5" value="<?php echo text($check_res['ok5']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob5" value="<?php echo text($check_res['prob5']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action5" value="<?php echo text($check_res['action5']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Endocrine</td>
                                <td>
                                    <input type="text" name="ok6" value="<?php echo text($check_res['ok6']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob6" value="<?php echo text($check_res['prob6']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action6" value="<?php echo text($check_res['action6']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Genitalia</td>
                                <td>
                                    <input type="text" name="ok7" value="<?php echo text($check_res['ok7']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob7" value="<?php echo text($check_res['prob7']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action7" value="<?php echo text($check_res['action7']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <td>Hemic-Lymph</td>
                                <td>
                                    <input type="text" name="ok8" value="<?php echo text($check_res['ok8']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob8" value="<?php echo text($check_res['prob8']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action8" value="<?php echo text($check_res['action8']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Integumental</td>
                                <td>
                                    <input type="text" name="ok9" value="<?php echo text($check_res['ok9']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob9" value="<?php echo text($check_res['prob9']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action9" value="<?php echo text($check_res['action9']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>MusculoSkeletal</td>
                                <td>
                                    <input type="text" name="ok10" value="<?php echo text($check_res['ok10']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob10" value="<?php echo text($check_res['prob10']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action10" value="<?php echo text($check_res['action10']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Nervous</td>
                                <td>
                                    <input type="text" name="ok11" value="<?php echo text($check_res['ok11']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob11" value="<?php echo text($check_res['prob11']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action11" value="<?php echo text($check_res['action11']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Respiratory</td>
                                <td>
                                    <input type="text" name="ok12" value="<?php echo text($check_res['ok12']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob12" value="<?php echo text($check_res['prob12']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action12" value="<?php echo text($check_res['action12']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Urinary</td>
                                <td>
                                    <input type="text" name="ok13" value="<?php echo text($check_res['ok13']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob13" value="<?php echo text($check_res['prob13']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action13" value="<?php echo text($check_res['action13']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Psychiatric</td>
                                <td>
                                    <input type="text" name="ok14" value="<?php echo text($check_res['ok14']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob14" value="<?php echo text($check_res['prob14']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action14" value="<?php echo text($check_res['action14']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Drug Sensitivity</td>
                                <td>
                                    <input type="text" name="ok15" value="<?php echo text($check_res['ok15']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="prob15" value="<?php echo text($check_res['prob15']);?>"/>
                                </td>
                                <td>
                                    <input type="text" name="action15" value="<?php echo text($check_res['action15']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <td style="width:70%;">
                                    <label><b>Cranical Nerves: (check appropriate response)<b></label>
                                </td>
                                <td style="width:15%;">
                                    <label><b>Intact<b></label>
                                </td>
                                <td style="width:15%;">
                                    <label><b>Not Intact<b></label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>I.</b> By Identification of Known Substance.</label>
                                </td>
                                <td style="width:15%;">
                                <input type=checkbox class="radio_change check1" data-id="check1" name='check1' value="0"<?php if ($check_res["check1"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                <input type=checkbox class="radio_change check1" data-id="check1" name='check2' value="0"<?php if ($check_res["check2"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>II.</b> By distinguishing movements in the peripheral visual fields.</label>
                                </td>
                                <td style="width:15%;">
                                <input type=checkbox class="radio_change check2" data-id="check2" name='check3' value="0"<?php if ($check_res["check3"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                <input type=checkbox name='check4' class="radio_change check2" data-id="check2" value="0"<?php if ($check_res["check4"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>III. IV. VI.</b> By demonstrating ocular muscle movements.</label>
                                </td>
                                <td style="width:15%;">
                                <input type=checkbox  class="radio_change check3" data-id="check3" name='check5' value="0"<?php if ($check_res["check5"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                <input type=checkbox name='check6' class="radio_change check3" data-id="check3" value="0"<?php if ($check_res["check6"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>V.</b> By distinguishing sensation throughout the trigeminal nerve distribution.</label>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox class="radio_change check4" data-id="check4" name='check7' value="0"<?php if ($check_res["check7"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox  class="radio_change check4" data-id="check4" name='check8' value="0"<?php if ($check_res["check8"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>VII.</b> By demonstrating facial muscles of expression.</label>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox class="radio_change check5" data-id="check5" name='check9' value="0"<?php if ($check_res["check9"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox name='check10' class="radio_change check5" data-id="check5" value="0"<?php if ($check_res["check10"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>VIII.</b> By demonstrating bilateral hearing.</label>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox class="radio_change check6" data-id="check6" name='check11' value="0"<?php if ($check_res["check11"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox  class="radio_change check6" data-id="check6" name='check12' value="0"<?php if ($check_res["check12"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>IX.</b> By demonstrating a gag reflex.</label>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox class="radio_change check7" data-id="check7" name='check13' value="0"<?php if ($check_res["check13"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox class="radio_change check7" data-id="check7" name='check14' value="0"<?php if ($check_res["check14"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>X.</b> By phonating guttural sounds.</label>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox  class="radio_change check8" data-id="check8" name='check15' value="0"<?php if ($check_res["check15"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox class="radio_change check8" data-id="check8"  name='check16' value="0"<?php if ($check_res["check16"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>XI.</b> By demonstrating bilaterally symmetrical shoulder shrug.</label>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox class="radio_change check9" data-id="check9"  name='check17' value="0"<?php if ($check_res["check17"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox  class="radio_change check9" data-id="check9"  name='check18' value="0"<?php if ($check_res["check18"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:70%;">
                                    <label><b>XII.</b> By protruding the tongue without fasciculation.</label>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox class="radio_change check10" data-id="check10"  name='check19' value="0"<?php if ($check_res["check19"] == "0") {
                                echo "checked";};?>>
                                </td>
                                <td style="width:15%;">
                                    <input type=checkbox class="radio_change check10" data-id="check10"  name='check20' value="0"<?php if ($check_res["check20"] == "0") {
                                echo "checked";};?>>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <h5 class="text-center"><b>Treatment Plan</b></h5>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <input type=checkbox name='check21' value="0"<?php if ($check_res["check21"] == "0") {
                                    echo "checked";};?>> <label>Med regimen/ Protocol</label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <input type=checkbox name='check22' value="0"<?php if ($check_res["check22"] == "0") {
                                    echo "checked";};?>> <label>Initial Labs/ PPD</label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <input type=checkbox name='check23' value="0"<?php if ($check_res["check23"] == "0") {
                                    echo "checked";};?>> <label>Encourage Hydration</label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <input type=checkbox name='check24' value="0"<?php if ($check_res["check24"] == "0") {
                                    echo "checked";};?>> <label>Partial Care/ I.O.P/ MAT/ Therapist/  Psychiartist/ P.C.P follow up as needed</label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <input type=checkbox name='check25' class="radio_change agree" data-id="agree" value="0"<?php if ($check_res["check25"] == "0") {
                                    echo "checked";};?>> Yes
                                    <input type=checkbox class="radio_change agree" data-id="agree" name='check26' value="0"<?php if ($check_res["check26"] == "0") {
                                    echo "checked";};?>> No -
                                    <label>I have reviewed the Nursing Assessment and I have addressed the significant findings.</label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <label><b>Name of physician Performing H&P:</b></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:40%;">
                                    <label>Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="signatures" id="signatures" style="width:60%;" value="<?php echo text($check_res['signatures']);?>"/>
                                    <img src='' class="img" id="img_signatures" style="display:none;width:50%;height:100px;" >
                                    M.D
                                </td>
                                <td style="width:30%;">
                                    <label>Date:</label>
                                    <input type="date" name="date2" value="<?php echo text($check_res['date2']);?>"/>
                                </td>
                                <td style="width:30%;">
                                    <label>Time:</label>
                                    <input type="time" name="signtime" value="<?php echo text($check_res['signtime']);?>"/>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <input type=checkbox name='check27' class="radio_change check27" data-id='check27' value="0"<?php if ($check_res["check27"] == "0") {
                                    echo "checked";};?>> Yes
                                    <input type=checkbox name='check28' class="radio_change check27" data-id='check27' value="0"<?php if ($check_res["check28"] == "0") {
                                    echo "checked";};?>> No -
                                    <label>As the patients psychiatric attending, I have reviewed and agree with all the above findings.</label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:40%;">
                                    <label>Attending Physician:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="atsign" id="atsign" style="width:60%;" value="<?php echo text($check_res['atsign']);?>"/>
                                    <img src='' class="img" id="img_atsign" style="display:none;width:50%;height:100px;" >
                                </td>
                                <td style="width:30%;">
                                    <label>Date:</label>
                                    <input type="date" name="date3" value="<?php echo text($check_res['date3']);?>"/>
                                </td>
                                <td style="width:30%;">
                                    <label>Time:</label>
                                    <input type="time" name="attime" value="<?php echo text($check_res['attime']);?>"/>
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
