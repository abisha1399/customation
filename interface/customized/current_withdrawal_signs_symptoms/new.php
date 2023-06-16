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
    $sql = "SELECT * FROM `form_current_withdrawal_signs` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Current Withdrawal Signs/Symptoms"); ?></title>
        <?php Header::setupHeader(); ?>
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;"> 
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/current_withdrawal_signs_symptoms/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />   
                    <div class="col-12 mt-3">    
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <h5 class="text-center"><b>Current Withdrawal Signs/Symptoms</b></h5>
                                </td>  
                            </tr>
                        </table>
                        <br>
                        <table style="width:100%;"> 
                            <tr>
                                <td>
                                    <label><input type=checkbox  name='check1' value="0"<?php if ($check_res["check1"] == "0") {
                                    echo "checked";};?>> Dilated pupils</label>
                                    <label><input type=checkbox name='check2' value="0"<?php if ($check_res["check2"] == "0") {
                                    echo "checked";};?>> Nausea</label>
                                    <label><input type=checkbox name='check3' value="0"<?php if ($check_res["check3"] == "0") {
                                    echo "checked";};?>> Vomitting</label>
                                    <label><input type=checkbox name='check4' value="0"<?php if ($check_res["check4"] == "0") {
                                    echo "checked";};?>> Diarrhea</label>
                                    <label><input type=checkbox name='check5' value="0"<?php if ($check_res["check5"] == "0") {
                                    echo "checked";};?>> abdominal cramps</label>
                                    <label><input type=checkbox name='check6' value="0"<?php if ($check_res["check6"] == "0") {
                                    echo "checked";};?>> anxiety</label>
                                    <label><input type=checkbox name='check7' value="0"<?php if ($check_res["check7"] == "0") {
                                    echo "checked";};?>> palpitations</label>
                                    <label><input type=checkbox name='check8' value="0"<?php if ($check_res["check8"] == "0") {
                                    echo "checked";};?>> irritability</label>
                                    <label><input type=checkbox name='check9' value="0"<?php if ($check_res["check9"] == "0") {
                                    echo "checked";};?>> fearful</label>
                                    <label><input type=checkbox name='check10' value="0"<?php if ($check_res["check10"] == "0") {
                                    echo "checked";};?>> depressed mood</label>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check11' value="0"<?php if ($check_res["check11"] == "0") {
                                    echo "checked";};?>> weakness</label>
                                    <label><input type=checkbox name='check12' value="0"<?php if ($check_res["check12"] == "0") {
                                    echo "checked";};?>> fatigue</label>
                                    <label><input type=checkbox name='check13' value="0"<?php if ($check_res["check13"] == "0") {
                                    echo "checked";};?>> restlessness</label>
                                    <label><input type=checkbox name='check14' value="0"<?php if ($check_res["check14"] == "0") {
                                    echo "checked";};?>> tremors</label>
                                    <label><input type=checkbox name='check15' value="0"<?php if ($check_res["check15"] == "0") {
                                    echo "checked";};?>> dizziness</label>
                                    <label><input type=checkbox name='check16' value="0"<?php if ($check_res["check16"] == "0") {
                                    echo "checked";};?>> headache</label>
                                    <label><input type=checkbox name='check17' value="0"<?php if ($check_res["check17"] == "0") {
                                    echo "checked";};?>> wernike's syndrome</label>
                                    <label><input type=checkbox name='check18' value="0"<?php if ($check_res["check18"] == "0") {
                                    echo "checked";};?>> poor condition</label>
                                    <label><input type=checkbox name='check19' value="0"<?php if ($check_res["check19"] == "0") {
                                    echo "checked";};?>> difficult concentration</label>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check20' value="0"<?php if ($check_res["check20"] == "0") {
                                    echo "checked";};?>> nystagmus</label>
                                    <label><input type=checkbox name='check21' value="0"<?php if ($check_res["check21"] == "0") {
                                    echo "checked";};?>> tongue fasciculation</label>
                                    <label><input type=checkbox name='check22' value="0"<?php if ($check_res["check22"] == "0") {
                                    echo "checked";};?>> cravings</label>
                                    <label><input type=checkbox name='check23' value="0"<?php if ($check_res["check23"] == "0") {
                                    echo "checked";};?>> poor condition</label>
                                    <label><input type=checkbox name='check24' value="0"<?php if ($check_res["check24"] == "0") {
                                    echo "checked";};?>> memory change</label>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">     
                            <tr>
                                <td>
                                    <label><input type=checkbox  name='check25' value="0"<?php if ($check_res["check25"] == "0") {
                                    echo "checked";};?>> photosensivity</label>
                                    <label><input type=checkbox name='check26' value="0"<?php if ($check_res["check26"] == "0") {
                                    echo "checked";};?>> sensivity to noise/ taste</label>
                                    <label><input type=checkbox name='check27' value="0"<?php if ($check_res["check27"] == "0") {
                                    echo "checked";};?>> numbness to body</label>
                                    <label><input type=checkbox name='check28' value="0"<?php if ($check_res["check28"] == "0") {
                                    echo "checked";};?>> muscle cramps</label>                                
                                    <label><input type=checkbox name='check29' value="0"<?php if ($check_res["check29"] == "0") {
                                    echo "checked";};?>> body aches</label>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check30' value="0"<?php if ($check_res["check30"] == "0") {
                                    echo "checked";};?>> constipation</label>
                                    <label><input type=checkbox name='check31' value="0"<?php if ($check_res["check31"] == "0") {
                                    echo "checked";};?>> hot/cold sweats</label>
                                    <label><input type=checkbox name='check32' value="0"<?php if ($check_res["check32"] == "0") {
                                    echo "checked";};?>> diaphoretic</label>                               
                                    <label><input type=checkbox name='check33' value="0"<?php if ($check_res["check33"] == "0") {
                                    echo "checked";};?>> change in appetite</label>
                                    <label><input type=checkbox name='check34' value="0"<?php if ($check_res["check34"] == "0") {
                                    echo "checked";};?>> weight loss</label>
                                    <label><input type=checkbox name='check35' value="0"<?php if ($check_res["check35"] == "0") {
                                    echo "checked";};?>> memory loss</label>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td>
                                    <label><input type=checkbox name='check36' value="0"<?php if ($check_res["check36"] == "0") {
                                    echo "checked";};?>> auditory/ visual/ tactile hallucinations</label>
                                    <label><input type=checkbox name='check37' value="0"<?php if ($check_res["check37"] == "0") {
                                    echo "checked";};?>> insomania</label>
                                    <label><input type=checkbox name='check38' value="0"<?php if ($check_res["check38"] == "0") {
                                    echo "checked";};?>> "skin crawling"</label>                               
                                    <label><input type=checkbox name='check39' value="0"<?php if ($check_res["check39"] == "0") {
                                    echo "checked";};?>> join discomfort</label>
                                    <label><input type=checkbox name='check40' value="0"<?php if ($check_res["check40"] == "0") {
                                    echo "checked";};?>> constipation</label>
                                </td>  
                            </tr>
                        </table>
                        <div class="bor" style="border:1px solid black;border-left-style:none;border-right-style:none;border-bottom-style:none;">
                        </div>
                        <br/>
                        <table style="width:100%;border:1px solid black;border-bottom-style:none;"> 
                            <tr>
                                <td style="width:100%;border:1px solid black;">
                                    <h5 class="text-center" style="margin-top:6px;"><b>PREGNANCY ASSESSMENT</b></h5>
                                </td>  
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:6px;"><b>Did the patient have a pregnancy test completed in the office?</b></label>
                                    <label><input type=checkbox name='check41' class="fcheck1" value="Yes"<?php if ($check_res["check41"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check42' class="fcheck1" value="No"<?php if ($check_res["check42"] == "No") {
                                    echo "checked";};?>> No</label>
                                    <label><input type=checkbox name='check43' class="fcheck1" value="NA/ LMP"<?php if ($check_res["check43"] == "NA/ LMP") {
                                    echo "checked";};?>> NA/ LMP</label>
                                </td>  
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:6px;"><b>Result of HCG Test:</b></label>
                                    <label><input type=checkbox name='check44' class="fcheck2" value="Negative"<?php if ($check_res["check44"] == "Negative") {
                                    echo "checked";};?>> Negative</label>
                                    <label><input type=checkbox name='check45' class="fcheck2" value="Positive"<?php if ($check_res["check45"] == "Positive") {
                                    echo "checked";};?>> Positive</label>
                                </td>  
                            </tr>
                        </table>
                        <table style="width:100%;border:1px solid black; border-top-style:none;border-bottom-style:none;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label>Is the patient psychotic?</label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check46' class="fcheck3" value="Yes"<?php if ($check_res["check46"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check47' class="fcheck3" value="No"<?php if ($check_res["check47"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                                <td style="width:30%;">
                                    <label style="margin-top:6px;">Is the patient sexually active?</label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check48' class="fcheck4" value="Yes"<?php if ($check_res["check48"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check49' class="fcheck4" value="No"<?php if ($check_res["check49"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:30%;">
                                    <label>Is the patient impulsive?</label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check50' class="fcheck5" value="Yes"<?php if ($check_res["check50"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check51' class="fcheck5" value="No"<?php if ($check_res["check51"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                                <td style="width:30%;">
                                    <label style="margin-top:6px;">Does the patient use contraception? </label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check52' class="fcheck6" value="Yes"<?php if ($check_res["check52"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check53' class="fcheck6" value="No"<?php if ($check_res["check53"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:30%;">
                                    <label>Is the patient mentally changed?</label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check54' class="fcheck7" value="Yes"<?php if ($check_res["check54"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check55' class="fcheck7" value="No"<?php if ($check_res["check55"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                                <td style="width:30%;">
                                    <label style="margin-top:6px;">Has the patient had a recent abortion? </label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check56' class="fcheck8" value="Yes"<?php if ($check_res["check56"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check57' class="fcheck8" value="No"<?php if ($check_res["check57"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:30%;">
                                    <label>Is there a possibility you are pregnant?</label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check58' class="fcheck9" value="Yes"<?php if ($check_res["check58"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check59' class="fcheck9" value="No"<?php if ($check_res["check59"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                                <td style="width:30%;">
                                    <label style="margin-top:6px;">Has the patient had a recent miscarriage? </label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check60' class="fcheck10" value="Yes"<?php if ($check_res["check60"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check61' class="fcheck10" value="No"<?php if ($check_res["check61"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:30%;">
                                    <label>Dose the patient have a history of STD?</label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check62' class="fcheck11" value="Yes"<?php if ($check_res["check62"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check63' class="fcheck11" value="No"<?php if ($check_res["check63"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                                <td style="width:30%;">
                                    <label style="margin-top:6px;">Dose the patient have any children? </label>
                                </td>
                                <td style="width:20%;">    
                                    <label><input type=checkbox name='check64' class="fcheck12" value="Yes"<?php if ($check_res["check64"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check65' class="fcheck12" value="No"<?php if ($check_res["check65"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                            </tr>
                        </table>
                        <table style="width:100%;border:1px solid black; border-top-style:none;">
                            <tr>
                                <td >
                                    <label>Based on the above data, the patient's pregnancy status is assessedas: </label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;border:1px solid black; border-top-style:none;"> 
                            <tr>
                                <td style="width:100%;border:1px solid black; border-top-style:none;">
                                    <h5 class="text-center" style="margin-top:6px;"><b>PAIN MANAGEMENT</b></h5>
                                </td>  
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:6px;"><b>Inform the patient of the organization's pain management philosophy?:</b></label>
                                    <label><input type=checkbox name='check66' class="fcheck13" value="Yes"<?php if ($check_res["check66"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check67' class="fcheck13" value="No"<?php if ($check_res["check67"] == "No") {
                                    echo "checked";};?>> No</label><label>(if no, list reason)</label>
                                </td>  
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:10px;margin-left:30px;"><input type=checkbox name='check68' value="0"<?php if ($check_res["check68"] == "0") {
                                    echo "checked";};?>> FLACC Scale</label>
                                    <label><input type=checkbox name='check69' value="0"<?php if ($check_res["check69"] == "0") {
                                    echo "checked";};?>> Numeric Scale (0-10) </label>
                                    <label><input type=checkbox name='check70' value="0"<?php if ($check_res["check70"] == "0") {
                                    echo "checked";};?>> Wonk-Baker Scale (Faces)</label>
                                </td>                                 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>Do you have pain now?</label>  
                                    <label><input type=checkbox style="margin-left:50px;" class="fcheck14" name='check71'  value="Yes"<?php if ($check_res["check71"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check72' class="fcheck14" value="No"<?php if ($check_res["check72"] == "No") {
                                    echo "checked";};?>> No</label>
                                    <label style="margin-left:50px;">Do you have chronic pain? </label>  
                                    <label><input type=checkbox style="margin-left:50px;" class="fcheck15" name='check73' value="Yes"<?php if ($check_res["check73"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check74' class="fcheck15" value="No"<?php if ($check_res["check74"] == "No") {
                                    echo "checked";};?>> No</label>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>where is your pain located:</label>
                                    <input type="text" name="pain" value="<?php echo text($check_res['pain']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>where is your present pain intensity? (USE APPROPRIATE PAIN SCALE)</label>
                                    <input type="text" name="intensity" value="<?php echo text($check_res['intensity']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>what is acceptable level of pain? (USE APPROPRIATE PAIN SCALE)</label>
                                    <input type="text" name="acceptable" value="<?php echo text($check_res['acceptable']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>Describe the characteristic of the pain:</label>
                                    <input type="text" name="characteristic" value="<?php echo text($check_res['characteristic']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>Describe the onset and duration of the pain:</label>
                                    <input type="text" name="onset" value="<?php echo text($check_res['onset']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>What relieves the pain:</label>
                                    <input type="text" name="relieves" value="<?php echo text($check_res['relieves']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>What causes or increases the pain:</label>
                                    <input type="text" name="causes" value="<?php echo text($check_res['causes']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>Effects of pain:</label>
                                    <input type="text" name="effects" value="<?php echo text($check_res['effects']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label>Does the patient have any personal, cultural, spiritual or ethnic beliefs that would prevent participation in pain management:</label>
                                    <label><input type=checkbox name='check75' class="fcheck16" value="Yes"<?php if ($check_res["check75"] == "Yes") {
                                    echo "checked";};?>> Yes</label>
                                    <label><input type=checkbox name='check76' class="fcheck16" value="No"<?php if ($check_res["check76"] == "No") {
                                    echo "checked";};?>> No</label>
                                    <label>(if yes, refer patient to the treatment team as soon as possible for review)</label>
                                    <input type="text" name="treatment" value="<?php echo text($check_res['treatment']);?>"/>
                                </td> 
                            </tr> 
                            <tr>
                                <td style="width:100%;">
                                    <label>RN Intervention:</label>
                                    <input type="text" name="intervention" value="<?php echo text($check_res['intervention']);?>"/>
                                </td> 
                            </tr>
                        </table>
                        <table style="width:100%;border:1px solid black;border-top-style:none;"> 
                            <tr>
                                <td style="width:100%;padding-bottom:5px;">
                                    <label><b>Note:</b></label>
                                    <textarea name="note" style="width: 98%;margin-left: 15px;" class="form-control" cols="200" rows="5"><?php echo text($check_res['note']);?></textarea>
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
        <script>
        $('.fcheck1').on('change', function() {
        $('.fcheck1').not(this).prop('checked', false);
        });
        $('.fcheck2').on('change', function() {
        $('.fcheck2').not(this).prop('checked', false);
        });
        $('.fcheck3').on('change', function() {
        $('.fcheck3').not(this).prop('checked', false);
        });
        $('.fcheck4').on('change', function() {
        $('.fcheck4').not(this).prop('checked', false);
        });
        $('.fcheck5').on('change', function() {
        $('.fcheck5').not(this).prop('checked', false);
        });
        $('.fcheck6').on('change', function() {
        $('.fcheck6').not(this).prop('checked', false);
        });
        $('.fcheck7').on('change', function() {
        $('.fcheck7').not(this).prop('checked', false);
        });
        $('.fcheck8').on('change', function() {
        $('.fcheck8').not(this).prop('checked', false);
        });
        $('.fcheck9').on('change', function() {
        $('.fcheck9').not(this).prop('checked', false);
        });
        $('.fcheck10').on('change', function() {
        $('.fcheck10').not(this).prop('checked', false);
        });
        $('.fcheck11').on('change', function() {
        $('.fcheck11').not(this).prop('checked', false);
        });
        $('.fcheck12').on('change', function() {
        $('.fcheck12').not(this).prop('checked', false);
        });
        $('.fcheck13').on('change', function() {
        $('.fcheck13').not(this).prop('checked', false);
        });
        $('.fcheck14').on('change', function() {
        $('.fcheck14').not(this).prop('checked', false);
        });
        $('.fcheck15').on('change', function() {
        $('.fcheck15').not(this).prop('checked', false);
        });
        $('.fcheck16').on('change', function() {
        $('.fcheck16').not(this).prop('checked', false);
        });
        </script>
    </body>
</html>
