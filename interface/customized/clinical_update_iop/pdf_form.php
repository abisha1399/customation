<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
require_once("$srcdir/api.inc");
//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");

$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$name = $_GET['formname'];
$pid = $_SESSION["pid"];
$encounter = $_GET["encounter"];
$check_res = $formid ? formFetch("form_clinical_update_iop", $formid) : array();

$data =array();

    $sql = "SELECT * FROM `form_clinical_update_iop` WHERE id = $formid AND pid = $pid";

    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);

  //  echo $sql;

    //$check_res = $formid ? $drug_data : array();
    // echo '<pre>';print_r($check_res);exit();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<style>
</style>
<body id='body' class='body'>
<?php
$header ="<div class='row' style='line-height:1px;' >
 <h1 style='text-align:center;'>Center for Network Therapy</h1>
 <h2 style='text-align:center;'>Clinical Update</h2>
 <h4 style='text-align:center;'>81 Northfield Avenue</h4>
 <h4 style='text-align:center;'>West Orange, NJ 07052</h4>
 <h4 style='text-align:center;'>T:973-731-1375-F:973-731-1374</h4>
</div>";

ob_start();

        ?>


       <table style="width:100%;border-color: black;" border="1" cellpadding="10" cellspacing="0">
                            <tr>
                                <td style="width:100%;" bgcolor="#000"></td>
                            </tr>
                            <tr>
                                <td style="width:100%;padding: 0 !important; ">
                                    <table style="width:100%;border-color: black;border: 0 !important;" border="0"  cellpadding="5" cellspacing="0">
                                      <tr>
                                         <td style="width:33.3333%;border-right: 1px solid !important;"> <h5 style="margin: 0;"><b>Patient Name:</b><?php echo text($check_res['pname']);?></h5></td>
                                         <td style="width:33.3333%;border-right: 1px solid !important;border-left: 1px solid !important;"> <h5 style="margin: 0;"><b>DOB:</b><?php echo text($check_res['pdob']);?></h5></td>
                                         <td style="width:33.3333%;border-left: 1px solid !important;"> <h5 style="margin: 0;"><b>DOA:</b><?php echo text($check_res['pdoa']);?></h5></td>
                                      </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            <td style="width:100%;" bgcolor="#000"></td>
                            </tr>
                            <tr>
                                <td style="width:100%; "><br></td>
                            </tr>
                            <tr>
                                <td style="width:100%; "><br></td>
                            </tr>
                            <tr>
                                <td style="width:100%; "><br></td>
                            </tr>
                            <tr>
                            <td style="width:100%;" bgcolor="#000"></td>
                            </tr>

                            <tr>
                                <td style="width:100%; ">
                                <label><b>Anti-craving medications prescribed?</b></label>
                                <input type="checkbox" class="medications_prescribed" <?php if ($check_res["medications_prescribed"] == "1") { echo "checked=checked";};?> style="margin: 10px;margin-right: 4px;" id="Naltrexone" name="medications_prescribed" value="1"><label for="Naltrexone"> Naltrexone</label>
                                <input type="checkbox" class="medications_prescribed" <?php if ($check_res["medications_prescribed"] == "2") { echo "checked=checked";};?> style="margin: 10px;margin-right: 4px;" id="Vivitrol" name="medications_prescribed" value="2"><label for="Vivitrol"> Vivitrol</label>
                                <input type="checkbox" class="medications_prescribed" <?php if ($check_res["medications_prescribed"] == "3") { echo "checked=checked";};?> style="margin: 10px;margin-right: 4px;" id="other" name="medications_prescribed" value="3"><label for="other"> other</label>
                                <input type="checkbox" class="medications_prescribed" <?php if ($check_res["medications_prescribed"] == "4") { echo "checked=checked";};?> style="margin: 10px;margin-right: 4px;" id="none" name="medications_prescribed" value="4"><label for="none"> none</label>
                                <p style="margin: 0;"><b> Dosage:</b><?php echo text($check_res['medications_prescribed_dosage']);?></p>
                            </td>
                            </tr>

                            <tr>
                                <td style="width:100%; ">
                                <label>If none, why? <?php echo text($check_res['none_why']);?></label>
                               </td>
                            </tr>


                            <tr>
                            <td style="width:100%; ">
                                <label><b>Compliant with Medications?</b></label>
                                <input type="checkbox" class="Compliant_with_Medications" style="margin: 10px;margin-right: 4px;" <?php if ($check_res["Compliant_with_Medications"] == "1") { echo "checked=checked";};?> id="medications_yes" name="Compliant_with_Medications" value="1"><label for="medications_yes"> Yes</label>
                                <input type="checkbox" class="Compliant_with_Medications" style="margin: 10px;margin-right: 4px;" <?php if ($check_res["Compliant_with_Medications"] == "2") { echo "checked=checked";};?> id="medications_no" name="Compliant_with_Medications" value="2"><label for="medications_no"> No</label>
                                <label> If no, please explain:  </label><?php echo text($check_res['Compliant_with_Medications_explain']);?>
                            </td>
                            </tr>


                            <tr> <td style="width:100%;" bgcolor="#000"></td> </tr>

                            <tr>
                            <td style="width:100%; ">
                                <label><b>Contract for safety?</b></label>
                                <input type="checkbox" class="Contract_for_safety" <?php if ($check_res["Contract_for_safety"] == "1") { echo "checked=checked";};?> style="margin: 10px;margin-right: 4px;" id="safety_yes" name="Contract_for_safety" value="1"><label for="safety_yes"> Yes</label>
                                <input type="checkbox" class="Contract_for_safety" <?php if ($check_res["Contract_for_safety"] == "2") { echo "checked=checked";};?> style="margin: 10px;margin-right: 4px;" id="safety_no" name="Contract_for_safety" value="2"><label for="safety_no"> No</label>
                                <label> If no, please explain: </label><?php echo text($check_res['Contract_for_safety_explain']);?>
                            </td>
                            </tr>

                            <tr>
                            <td style="width:100%; ">
                                <label><b>Current psychosis?</b></label>
                                <input type="checkbox" class="Current_psychosis" style="margin: 10px;margin-right: 4px;" <?php if ($check_res["Current_psychosis"] == "1") { echo "checked=checked";};?> id="psychosis_yes" name="Current_psychosis" value="1"><label for="psychosis_yes"> Yes</label>
                                <input type="checkbox" class="Current_psychosis" style="margin: 10px;margin-right: 4px;" <?php if ($check_res["Current_psychosis"] == "2") { echo "checked=checked";};?> id="psychosis_no" name="Current_psychosis" value="2"><label for="psychosis_no"> No</label>
                                <label> If no, please explain: </label><?php echo text($check_res['Current_psychosis_explain']);?>
                            </td>
                            </tr>

                            <tr>
                            <td style="width:100%; ">
                                <label><b>Current suicidal ideation/ plan/ intent?</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Current_suicidal" <?php if ($check_res["Current_suicidal"] == "1") { echo "checked=checked";};?> id="suicidal_yes" name="Current_suicidal" value="1"><label for="suicidal_yes"> Yes</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Current_suicidal" <?php if ($check_res["Current_suicidal"] == "2") { echo "checked=checked";};?> id="suicidal_no" name="Current_suicidal" value="2"><label for="suicidal_no"> No</label>
                                <label> If no, please explain: </label><?php echo text($check_res['Current_suicidal_explain']);?>
                            </td>
                            </tr>

                            <tr>
                            <td style="width:100%; ">
                                <label><b>Current homicidal ideation/ plan/ intent?</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if ($check_res["Current_homicidal"] == "1") { echo "checked=checked";};?> class="Current_homicidal" id="homicidal_yes" name="Current_homicidal" value="1"><label for="homicidal_yes"> Yes</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if ($check_res["Current_homicidal"] == "2") { echo "checked=checked";};?> class="Current_homicidal" id="homicidal_no" name="Current_homicidal" value="2"><label for="homicidal_no"> No</label>
                                <label> If no, please explain: :</label><?php echo text($check_res['Current_homicidal_explain']);?>
                            </td>
                            </tr>

                            <tr>
                            <td style="width:100%; ">
                                <label><b>Medical complications?</b></label>
                                <input type="checkbox" class="Medical_complications" <?php if ($check_res["Medical_complications"] == "1") { echo "checked=checked";};?> style="margin: 10px;margin-right: 4px;" id="complications_yes" name="Medical_complications" value="1"><label for="complications_yes"> Yes</label>
                                <input type="checkbox" class="Medical_complications" <?php if ($check_res["Medical_complications"] == "2") { echo "checked=checked";};?> style="margin: 10px;margin-right: 4px;" id="complications_no" name="Medical_complications" value="2"><label for="complications_no"> No</label>
                                <label> If no, please explain: :</label><?php echo text($check_res['Medical_complications_explain']);?>
                            </td>
                            </tr>

                            <tr> <td style="width:100%;" bgcolor="#000"></td> </tr>

                            <tr>
                                <td style="width:100%; ">
                                <label><b>Current step(s) patient is working on:</b></label><?php echo text($check_res['patient_is_working']);?>
                               </td>
                            </tr>

                            <tr>
                                <td style="width:100%; ">
                                <label><b>Temporary/ current sponsor:</b></label><?php echo text($check_res['Temporary_current_sponsor']);?>
                               </td>
                            </tr>


                            <tr>
                                <td style="width:100%;padding: 0 !important; ">
                                    <table style="width:100%;border-color: black;border-top: 0px solid !important;border-left: 0px solid !important;border-right: 0px solid !important;" border="0"  cellpadding="5" cellspacing="0">
                                      <tr>
                                      <td style="width:50%;border-right: 1px solid;border-top: 1px solid;">
                                          <label><b>Frequency of meetings</b></label>
                                          <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if ($check_res["Frequency_of_meetings"] == "1") { echo "checked=checked";};?> class="Frequency_of_meetings" id="meetings_daily" name="Frequency_of_meetings" value="1"><label for="meetings_daily"> daily</label>
                                          <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if ($check_res["Frequency_of_meetings"] == "2") { echo "checked=checked";};?> class="Frequency_of_meetings" id="meetings_weekly" name="Frequency_of_meetings" value="2"><label for="meetings_weekly"> weekly</label>
                                      </td>
                                         <td style="width:50%;border-top: 1px solid;"><b>Total per week: N/A</b></td>
                                      </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr> <td style="width:100%;" bgcolor="#000"></td> </tr>

                            <?php $appearance = str_split($check_res["appearance"]); ?>

                            <tr>
                                <td style="width:100%; ">
                                <label><b>Appearance:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $appearance)) { echo "checked=checked";};?> id="appearance-appropriate" name="appearance[]" value="1"><label for="appearance-appropriate"> appropriate</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $appearance)) { echo "checked=checked";};?> id="appearance-well-kempt" name="appearance[]" value="2"><label for="appearance-well-kempt"> well kempt</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $appearance)) { echo "checked=checked";};?> id="appearance-disheveled" name="appearance[]" value="3"><label for="appearance-disheveled"> disheveled</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $appearance)) { echo "checked=checked";};?> id="appearance-bizarre" name="appearance[]" value="4"><label for="appearance-bizarre"> bizarre</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(5, $appearance)) { echo "checked=checked";};?> id="appearance-odorous" name="appearance[]" value="5"><label for="appearance-odorous"> odorous</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(6, $appearance)) { echo "checked=checked";};?> id="appearance-poor-hygiene" name="appearance[]" value="6"><label for="appearance-poor-hygiene"> poor hygiene</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['appearance_describe']);?></p>
                            </td>
                            </tr>

                            <?php $behavior = str_split($check_res["behavior"]); ?>

                            <tr>
                                <td style="width:100%; ">
                                <label><b>Behavior:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $behavior)) { echo "checked=checked";};?> class="Behavior" id="behavior-isolates" name="behavior[]" value="1"><label for="behavior-isolates"> isolates</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $behavior)) { echo "checked=checked";};?> class="Behavior" id="behavior-social-withdrawal" name="behavior[]" value="2"><label for="behavior-social-withdrawal"> social withdrawal</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $behavior)) { echo "checked=checked";};?> class="Behavior" id="behavior-guarded-defensive" name="behavior[]" value="3"><label for="behavior-guarded-defensive"> guarded/ defensive</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $behavior)) { echo "checked=checked";};?> class="Behavior" id="behavior-impulsive" name="behavior[]" value="4"><label for="behavior-impulsive"> impulsive</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(5, $behavior)) { echo "checked=checked";};?> class="Behavior" id="behavior-minimizing-justifying" name="behavior[]" value="5"><label for="behavior-minimizing-justifying"> minimizing/ justifying</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(6, $behavior)) { echo "checked=checked";};?> class="Behavior" id="behavior-med-seeking" name="behavior[]" value="6"><label for="behavior-med-seeking"> med seeking</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(7, $behavior)) { echo "checked=checked";};?> class="Behavior_others" id="behavior-other" name="behavior[]" value="7"><label for="behavior-other"> other:</label><?php echo text($check_res['behavior_other_explain']);?>
                            </td>
                            </tr>

                            <tr>
                                <td style="width:100%;">
                                    <table style="width:100%;border-color: black;" border="0"  cellpadding="5" cellspacing="0">
                                      <tr>
                                         <td style="width:30%"><b>Musculoskeletal</b> <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Musculoskeletal_describe']);?></p></td>
                                         <td style="width:35%">
                                         <b>Strength/ Tone</b>
                                         <input type="checkbox" style="margin: 10px;margin-right: 4px;" id="musculoskeletal-strength-normal"   <?php if ($check_res["strength"] == "1") { echo "checked=checked";};?> class ="strength" name="strength" value="1"><label for="musculoskeletal-strength-normal"> normal </label>
                                         <input type="checkbox" style="margin: 10px;margin-right: 4px;" id="musculoskeletal-strength-abnormal" <?php if ($check_res["strength"] == "2") { echo "checked=checked";};?> class ="strength" name="strength" value="2"><label for="musculoskeletal-strength-abnormal"> abnormal</label>
                                         <p style="margin: 0;"><br></p>
                                        </td>

                                        <td style="width:35%">
                                         <b>Gait/ Station</b>
                                         <input type="checkbox" style="margin: 10px;margin-right: 4px;" id="musculoskeletal-gait-normal"   class ="gait" <?php if ($check_res["gait"] == "1") { echo "checked=checked";};?> name="gait" value="1"><label for="musculoskeletal-gait-normal"> normal </label>
                                         <input type="checkbox" style="margin: 10px;margin-right: 4px;" id="musculoskeletal-gait-abnormal" class ="gait" <?php if ($check_res["gait"] == "2") { echo "checked=checked";};?> name="gait" value="2"><label for="musculoskeletal-gait-abnormal"> abnormal</label>
                                         <p style="margin: 0;"><br></p>
                                        </td>
                                      </tr>
                                    </table>
                                </td>
                            </tr>

                            <?php $Attitude = str_split($check_res["Attitude"]); ?>
                            <tr>
                                <td style="width:100%; ">
                                <label><b>Attitude:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $Attitude)) { echo "checked=checked";};?> id="attitude-cooperativeness" name="Attitude[]" value="1"><label for="attitude-cooperativeness"> cooperativeness</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $Attitude)) { echo "checked=checked";};?> id="attitude-relatedness" name="Attitude[]" value="2"><label for="attitude-relatedness"> relatedness</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $Attitude)) { echo "checked=checked";};?> id="attitude-good-eye-contact" name="Attitude[]" value="3"><label for="attitude-good-eye-contact"> good eye contact</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Attitude_describe']);?></p>
                            </td>
                            </tr>
                            <?php $Motor = str_split($check_res["Motor"]); ?>
                            <tr>
                                <td style="width:100%; ">
                                <label><b>Motor:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $Motor)) { echo "checked=checked";};?> id="motor-normal" name="Motor[]" value="1"><label for="motor-normal"> normal</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $Motor)) { echo "checked=checked";};?> id="motor-psychomotor-agitation" name="Motor[]" value="2"><label for="motor-psychomotor-agitation"> psychomotor agitation</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $Motor)) { echo "checked=checked";};?> id="motor-psycho-motor-retardation" name="Motor[]" value="3"><label for="motor-psycho-motor-retardation"> psycho motor retardation</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $Motor)) { echo "checked=checked";};?> id="motor-EPS" name="Motor[]" value="4"><label for="motor-EPS"> EPS</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(5, $Motor)) { echo "checked=checked";};?> id="motor-tremor" name="Motor[]" value="5"><label for="motor-tremor"> tremor</label><br>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;margin-left: 0;" <?php if (in_array(6, $Motor)) { echo "checked=checked";};?> id="motor-AIMS" name="Motor[]" value="6"><label for="motor-AIMS"> AIMS</label>
                            </td>
                            </tr>
                            <?php $speech = str_split($check_res["speech"]); ?>
                            <tr>
                                <td style="width:100%; ">
                                <label><b>Speech:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $speech)) { echo "checked=checked";};?> id="speech-normal" name="speech[]" value="1"><label for="speech-normal"> normal</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $speech)) { echo "checked=checked";};?> id="speech-latency" name="speech[]" value="2"><label for="speech-latency"> latency</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $speech)) { echo "checked=checked";};?> id="speech-rate" name="speech[]" value="3"><label for="speech-rate"> rate</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $speech)) { echo "checked=checked";};?> id="speech-tone" name="speech[]" value="4"><label for="speech-tone"> tone</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(5, $speech)) { echo "checked=checked";};?> id="speech-volume" name="speech[]" value="5"><label for="speech-volume"> volume</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(6, $speech)) { echo "checked=checked";};?> id="speech-stuttering" name="speech[]" value="6"><label for="speech-stuttering"> stuttering</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(7, $speech)) { echo "checked=checked";};?> id="speech-hyperactive" name="speech[]" value="7"><label for="speech-hyperactive"> hyperactive</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(8, $speech)) { echo "checked=checked";};?> id="speech-retardation" name="speech[]" value="8"><label for="speech-retardation"> retardation</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Speech_describe']);?></p>
                            </td>
                            </tr>
                            <?php $Mood = str_split($check_res["Mood"]); ?>
                            <tr>
                                <td style="width:100%; ">
                                <label><b>Mood:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood" <?php if (in_array(1, $Mood)) { echo "checked=checked";};?> id="Mood-euthymic" name="Mood[]" value="1"><label for="Mood-euthymic"> euthymic</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood" <?php if (in_array(2, $Mood)) { echo "checked=checked";};?> id="Mood-depressed" name="Mood[]" value="2"><label for="Mood-depressed"> depressed</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood" <?php if (in_array(3, $Mood)) { echo "checked=checked";};?> id="Mood-hypomanic" name="Mood[]" value="3"><label for="Mood-hypomanic"> hypomanic</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood" <?php if (in_array(4, $Mood)) { echo "checked=checked";};?> id="Mood-euphoric" name="Mood[]" value="4"><label for="Mood-euphoric"> euphoric</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood" <?php if (in_array(5, $Mood)) { echo "checked=checked";};?> id="Mood-angry" name="Mood[]" value="5"><label for="Mood-angry"> angry</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood" <?php if (in_array(6, $Mood)) { echo "checked=checked";};?> id="Mood-anxious" name="Mood[]" value="6"><label for="Mood-anxious"> anxious</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood" <?php if (in_array(7, $Mood)) { echo "checked=checked";};?> id="Mood-labile" name="Mood[]" value="7"><label for="Mood-labile"> labile</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood" <?php if (in_array(8, $Mood)) { echo "checked=checked";};?> id="Mood-irritable" name="Mood[]" value="8"><label for="Mood-irritable"> irritable</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood" <?php if (in_array(9, $Mood)) { echo "checked=checked";};?> id="Mood-helpless" name="Mood[]" value="9"><label for="Mood-helpless"> helpless</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Mood_other" id="Mood-other" <?php if (in_array(10, $Mood)) { echo "checked=checked";};?> name="Mood[]" value="10"><label for="Mood-other"> other</label>

                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Mood_describe']);?></p>
                            </td>
                            </tr>
                            <?php $Affect = str_split($check_res["Affect"]); ?>
                            <tr>
                                <td style="width:100%; ">
                                <label><b>Affect:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $Affect)) { echo "checked=checked";};?> id="Affect-appropriate"  name="Affect[]" value="1"><label for="Affect-appropriate"> appropriate</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $Affect)) { echo "checked=checked";};?> id="Affect-full" name="Affect[]" value="2"><label for="Affect-full"> full</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $Affect)) { echo "checked=checked";};?> id="Affect-neutral" name="Affect[]" value="3"><label for="Affect-neutral"> neutral</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $Affect)) { echo "checked=checked";};?> id="Affect-constricted"  name="Affect[]" value="4"><label for="Affect-constricted"> constricted</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(5, $Affect)) { echo "checked=checked";};?> id="Affect-blunted-flat"     name="Affect[]" value="5"><label for="Affect-blunted-flat"> blunted/ flat</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(6, $Affect)) { echo "checked=checked";};?> id="Affect-labile"   name="Affect[]" value="6"><label for="Affect-labile"> labile</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(7, $Affect)) { echo "checked=checked";};?> id="Affect-irritable" name="Affect[]" value="7"><label for="Affect-irritable"> irritable</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(8, $Affect)) { echo "checked=checked";};?> id="Affect-dysphoric"  name="Affect[]" value="8"><label for="Affect-dysphoric"> dysphoric</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(9, $Affect)) { echo "checked=checked";};?> id="Affect-sad"     name="Affect[]" value="9"><label for="Affect-sad"> sad</label>

                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Affect_describe']);?></p>
                            </td>
                            </tr>

                            <?php $Process = str_split($check_res["Process"]); ?>
                            <tr>
                                <td style="width:100%; ">
                                <label><b>Thought Process:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(1, $Process)) { echo "checked=checked";};?> id="Process-coherent"  name="Process[]" value="1"><label for="Process-coherent"> coherent</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(2, $Process)) { echo "checked=checked";};?> id="Process-soft"  name="Process[]" value="2"><label for="Process-soft"> soft</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(3, $Process)) { echo "checked=checked";};?> id="Process-loud"  name="Process[]" value="3"><label for="Process-loud"> loud</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(4, $Process)) { echo "checked=checked";};?> id="Process-rapid"  name="Process[]" value="4"><label for="Process-rapid"> rapid</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(5, $Process)) { echo "checked=checked";};?> id="Process-slurred"  name="Process[]" value="5"><label for="Process-slurred"> slurred</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(6, $Process)) { echo "checked=checked";};?> id="Process-unintelligible"  name="Process[]" value="6"><label for="Process-unintelligible"> unintelligible</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(7, $Process)) { echo "checked=checked";};?> id="Process-linear-goal-oriented"  name="Process[]" value="7"><label for="Process-linear-goal-oriented"> linear/ goal-oriented</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(8, $Process)) { echo "checked=checked";};?> id="Process-FOI"  name="Process[]" value="8"><label for="Process-FOI"> FOI</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(9, $Process)) { echo "checked=checked";};?> id="Process-LOA"  name="Process[]" value="9"><label for="Process-LOA"> LOA</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(10, $Process)) { echo "checked=checked";};?> id="Process-word-salad"  name="Process[]" value="10"><label for="Process-word-salad"> word salad</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(11, $Process)) { echo "checked=checked";};?> id="Process-neologism"  name="Process[]" value="11"><label for="Process-neologism"> neologism</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(12, $Process)) { echo "checked=checked";};?> id="Process-pre-occupied"  name="Process[]" value="12"><label for="Process-pre-occupied"> pre-occupied</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(13, $Process)) { echo "checked=checked";};?> id="Process-difficulty-concentrating"  name="Process[]" value="13"><label for="Process-difficulty-concentrating"> difficulty concentrating</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(14, $Process)) { echo "checked=checked";};?> id="Process-disorganized"  name="Process[]" value="14"><label for="Process-disorganized"> disorganized</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(16, $Process)) { echo "checked=checked";};?> id="Process-illogical"  name="Process[]" value="15"><label for="Process-illogical"> illogical</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(17, $Process)) { echo "checked=checked";};?> id="Process-flash-backs"  name="Process[]" value="16"><label for="Process-flash-backs"> flash backs</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process" <?php if (in_array(18, $Process)) { echo "checked=checked";};?> id="Process-intrusive-thoughts"  name="Process[]" value="17"><label for="Process-intrusive-thoughts"> intrusive thoughts</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Process_other" <?php if (in_array(19, $Process)) { echo "checked=checked";};?> id="Process-other"  name="Process[]" value="18"><label for="Process-other"> other</label><br>
                                <label> <b>Computations</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Computations" <?php if ($check_res["Computations"] == "1") {echo "checked=checked";};?> id="Computations-age-appropriate"  name="Computations" value="1"><label for="Computations-age-appropriate"> age appropriate</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Computations" <?php if ($check_res["Computations"] == "2") {echo "checked=checked";};?> id="Computations-age-inappropriate"  name="Computations" value="2"><label for="Computations-age-inappropriate"> age inappropriate</label>
                                <label> <b>Abstractions</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Abstractions" <?php if ($check_res["Abstractions"] == "1") {echo "checked=checked";};?> id="Abstractions-normal"  name="Abstractions" value="1"><label for="Abstractions-normal"> normal</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Abstractions" <?php if ($check_res["Abstractions"] == "2") {echo "checked=checked";};?> id="Abstractions-abnormal"  name="Abstractions" value="2"><label for="Abstractions-abnormal"> abnormal</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Thought_Process_describe']);?></p>
                            </td>
                            </tr>

                            <?php $Associations = str_split($check_res["Associations"]); ?>
                            <tr>
                                <td style="width:100%; ">
                                <label><b>Thought Associations:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $Associations)) { echo "checked=checked";};?> id="Associations-intact"  name="Associations[]" value="1"><label for="Associations-intact"> intact</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $Associations)) { echo "checked=checked";};?> id="Associations-circumstantial"  name="Associations[]" value="2"><label for="Associations-circumstantial"> circumstantial</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $Associations)) { echo "checked=checked";};?> id="Associations-tangential"  name="Associations[]" value="3"><label for="Associations-tangential"> tangential</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $Associations)) { echo "checked=checked";};?> id="Associations-loose"  name="Associations[]" value="4"><label for="Associations-loose"> loose</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Thought_Associations_describe']);?></p>
                            </td>
                            </tr>

                            <?php $Content = str_split($check_res["Content"]); ?>

                            <tr>
                                <td style="width:100%; ">
                                <label><b>Thought Content:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $Content)) { echo "checked=checked";};?> id="Content-obsessions"  name="Content[]" value="1"><label for="Content-obsessions"> obsessions</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $Content)) { echo "checked=checked";};?> id="Content-compulsions"  name="Content[]" value="2"><label for="Content-compulsions"> compulsions</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $Content)) { echo "checked=checked";};?> id="Content-preoccupations"  name="Content[]" value="3"><label for="Content-preoccupations"> preoccupations</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $Content)) { echo "checked=checked";};?> id="Content-paranoid-delusions"  name="Content[]" value="4"><label for="Content-paranoid-delusions"> paranoid delusions</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(5, $Content)) { echo "checked=checked";};?> id="Content-other-delusions"  name="Content[]" value="5"><label for="Content-other-delusions"> other delusions</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(6, $Content)) { echo "checked=checked";};?> id="Content-AH"  name="Content[]" value="6"><label for="Content-AH"> AH</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(7, $Content)) { echo "checked=checked";};?> id="Content-VH"  name="Content[]" value="7"><label for="Content-VH"> VH</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(8, $Content)) { echo "checked=checked";};?> id="Content-SI"  name="Content[]" value="8"><label for="Content-SI"> SI</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(9, $Content)) { echo "checked=checked";};?> id="Content-HI"  name="Content[]" value="9"><label for="Content-HI"> HI</label>
                            </td>
                            </tr>


                        </table>

<br>

                        <table style="width:100%;border-color: black;" border="1" cellpadding="10" cellspacing="0">

                        <tr>
                                <td style="width:100%; ">
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['describe2']);?></p>
                            </td>
                            </tr>

                        <tr>
                                <td style="width:100%; ">
                                <label><b>Memory:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Memory" <?php if ($check_res["Memory"] == "1") {echo "checked=checked";};?> id="Memory-poor"  name="Memory" value="1"><label for="Memory-poor"> poor</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Memory" <?php if ($check_res["Memory"] == "2") {echo "checked=checked";};?> id="Memory-fair"  name="Memory" value="2"><label for="Memory-fair"> fair</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Memory" <?php if ($check_res["Memory"] == "3") {echo "checked=checked";};?> id="Memory-moderate"  name="Memory" value="3"><label for="Memory-moderate"> moderate</label><br>
                                <label><b>Recent:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Recent" <?php if ($check_res["Recent"] == "1") {echo "checked=checked";};?> id="Recent-intact"  name="Recent" value="1"><label for="Recent-intact"> intact</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Recent" <?php if ($check_res["Recent"] == "2") {echo "checked=checked";};?> id="Recent-impaired"  name="Recent" value="2"><label for="Recent-impaired"> impaired</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Recent" <?php if ($check_res["Recent"] == "3") {echo "checked=checked";};?> id="Recent-digits-forward"  name="Recent" value="3"><label for="Recent-digits-forward"> digits forward</label>
                                <label><b>Remote:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Remote" <?php if ($check_res["Remote"] == "1") {echo "checked=checked";};?> id="Remote-intact"  name="Remote" value="1"><label for="Remote-intact"> intact</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Remote" <?php if ($check_res["Remote"] == "2") {echo "checked=checked";};?> id="Remote-impaired"  name="Remote" value="2"><label for="Remote-impaired"> impaired</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['mrr_describe']);?></p>
                            </td>
                            </tr>
                            <?php $Insight = str_split($check_res["Insight"]); ?>
                            <tr>
                                <td style="width:100%; ">
                                <label><b>Insight:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $Insight)) { echo "checked=checked";};?> class="Insight" id="Insight-minimizes"  name="Insight[]" value="1"><label for="Insight-minimizes"> minimizes</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $Insight)) { echo "checked=checked";};?> class="Insight" id="Insight-rationalizes"  name="Insight[]" value="2"><label for="Insight-rationalizes"> rationalizes</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $Insight)) { echo "checked=checked";};?> class="Insight" id="Insight-intellectualizes"  name="Insight[]" value="3"><label for="Insight-intellectualizes"> intellectualizes</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $Insight)) { echo "checked=checked";};?> class="Insight" id="Insight-impaired"  name="Insight[]" value="4"><label for="Insight-impaired"> impaired</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(5, $Insight)) { echo "checked=checked";};?> class="Insight_other" id="Insight-other"  name="Insight[]" value="5"><label for="Insight-other"> other</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Insight_describe']);?></p>
                            </td>
                            </tr>

                            <tr>
                                <td style="width:100%; ">
                                <label><b>Judgment:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" id="Judgment-poor" class="Judgment" <?php if ($check_res["Judgment"] == "1") {echo "checked=checked";};?> name="Judgment" value="1"><label for="Judgment-poor"> poor</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" id="Judgment-fair" class="Judgment" <?php if ($check_res["Judgment"] == "2") {echo "checked=checked";};?> name="Judgment" value="2"><label for="Judgment-fair"> fair</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" id="Judgment-good" class="Judgment" <?php if ($check_res["Judgment"] == "3") {echo "checked=checked";};?> name="Judgment" value="3"><label for="Judgment-good"> good</label>
                                <label><b>Insight:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" name="Judgment_Insight" class="Judgment_Insight" <?php if ($check_res["Judgment_Insight"] == "1") {echo "checked=checked";};?> id="Judgment-Insight-minimal" value="1"><label for="Judgment-Insight-minimal"> minimal</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" name="Judgment_Insight" class="Judgment_Insight" <?php if ($check_res["Judgment_Insight"] == "2") {echo "checked=checked";};?> id="Judgment-Insight-moderate" value="2"><label for="Judgment-Insight-moderate"> moderate</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" name="Judgment_Insight" class="Judgment_Insight" <?php if ($check_res["Judgment_Insight"] == "3") {echo "checked=checked";};?> id="Judgment-Insight-good" value="3"><label for="Judgment-Insight-good"> good</label>

                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Judgment_describe']);?></p>
                            </td>
                            </tr>


                            <tr>
                                <td style="width:100%; ">
                                <label><b>Orientation:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Orientation" <?php if ($check_res["Orientation"] == "1") {echo "checked=checked";};?> id="Orientation-time"  name="Orientation" value="1"><label for="Orientation-time"> time</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Orientation" <?php if ($check_res["Orientation"] == "2") {echo "checked=checked";};?> id="Orientation-person"  name="Orientation" value="2"><label for="Orientation-person"> person</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Orientation" <?php if ($check_res["Orientation"] == "3") {echo "checked=checked";};?> id="Orientation-place"  name="Orientation" value="3"><label for="Orientation-place"> place</label>
                                <label><b> Attention Span/ Concentration:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Attention" <?php if ($check_res["Attention"] == "1") {echo "checked=checked";};?> id="Attention-Span-Concentration-intact"  name="Attention" value="1"><label for="Attention-Span-Concentration-intact"> intact</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Attention" <?php if ($check_res["Attention"] == "2") {echo "checked=checked";};?> id="Attention-Span-Concentration-impaired"  name="Attention" value="2"><label for="Attention-Span-Concentration-impaired"> impaired</label>

                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Orientation_describe']);?></p>
                            </td>
                            </tr>


                            <tr>
                                <td style="width:100%; ">
                                <label><b>Language  Name Objects</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Language_Objects" <?php if ($check_res["Language_Objects"] == "1") {echo "checked=checked";};?> id="Language-Name-Objects-intact"  name="Language_Objects" value="1"><label for="Language-Name-Objects-intact"> intact</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Language_Objects" <?php if ($check_res["Language_Objects"] == "2") {echo "checked=checked";};?> id="Language-Name-Objects-impaired"  name="Language_Objects" value="2"><label for="Language-Name-Objects-impaired"> impaired</label>
                                <label><b> Repeat phrases:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Language_phrases" <?php if ($check_res["Language_phrases"] == "1") {echo "checked=checked";};?> id="Language-Repeat-phrases-intact"  name="Language_phrases" value="1"><label for="Language-Repeat-phrases-intact"> intact</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Language_phrases" <?php if ($check_res["Language_phrases"] == "2") {echo "checked=checked";};?> id="Language-Repeat-phrases-impaired"  name="Language_phrases" value="2"><label for="Language-Repeat-phrases-impaired"> impaired</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Language_describe']);?></p>
                            </td>
                            </tr>


                            <tr>
                                <td style="width:100%; ">
                                <label><b>Knowledge  Current Events</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Knowledge_Current" <?php if ($check_res["Knowledge_Current"] == "1") {echo "checked=checked";};?> id="Knowledge-Current-Events-intact"  name="Knowledge_Current" value="1"><label for="Knowledge-Current-Events-intact"> intact</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Knowledge_Current" <?php if ($check_res["Knowledge_Current"] == "2") {echo "checked=checked";};?> id="Knowledge-Current-Events-impaired"  name="Knowledge_Current" value="2"><label for="Knowledge-Current-Events-impaired"> impaired</label>
                                <label><b> Past History:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Knowledge_History" <?php if ($check_res["Knowledge_History"] == "1") {echo "checked=checked";};?> id="Knowledge-Past-History-intact"  name="Knowledge_History" value="1"><label for="Knowledge-Past-History-intact"> intact</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Knowledge_History" <?php if ($check_res["Knowledge_History"] == "2") {echo "checked=checked";};?> id="Knowledge-Past-History-impaired"  name="Knowledge_History" value="2"><label for="Knowledge-Past-History-impaired"> impaired</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Knowledge_describe']);?></p>
                            </td>
                            </tr>


                            <tr>
                                <td style="width:100%; ">
                                <label><b>Intelligence:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Intelligence" <?php if ($check_res["Intelligence"] == "1") {echo "checked=checked";};?> id="Intelligence-appears-normal"  name="Intelligence" value="1"><label for="Intelligence-appears-normal"> appears normal</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Intelligence" <?php if ($check_res["Intelligence"] == "2") {echo "checked=checked";};?> id="Intelligence-age-appropriate"  name="Intelligence" value="2"><label for="Intelligence-age-appropriate"> age appropriate</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Intelligence" <?php if ($check_res["Intelligence"] == "3") {echo "checked=checked";};?> id="Intelligence-age-inappropriate"  name="Intelligence" value="3"><label for="Intelligence-age-inappropriate"> age inappropriate</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Intelligence" <?php if ($check_res["Intelligence"] == "4") {echo "checked=checked";};?> id="Intelligence-above-average"  name="Intelligence" value="4"><label for="Intelligence-above-average"> above average</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Intelligence" <?php if ($check_res["Intelligence"] == "5") {echo "checked=checked";};?> id="Intelligence-average"  name="Intelligence" value="5"><label for="Intelligence-average"> average</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Intelligence" <?php if ($check_res["Intelligence"] == "6") {echo "checked=checked";};?> id="Intelligence-below-average"  name="Intelligence" value="6"><label for="Intelligence-below-average"> below average</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Intelligence" <?php if ($check_res["Intelligence"] == "7") {echo "checked=checked";};?> id="Intelligence-impaired"  name="Intelligence" value="7"><label for="Intelligence-impaired"> impaired</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Intelligence" <?php if ($check_res["Intelligence"] == "8") {echo "checked=checked";};?> id="Intelligence-other"  name="Intelligence" value="8"><label for="Intelligence-other"> other</label>
                                <p style="margin: 0;"><b> Describe:</b><?php echo text($check_res['Intelligence_describe']);?></p>
                            </td>
                            </tr>


                            <tr>
                                <td style="width:100%;" bgcolor="#000"></td>
                            </tr>
                            <tr>
                                <td style="width:100%;"></td>
                            </tr>
                            <tr>
                                <td style="width:100%;" bgcolor="#000"></td>
                            </tr>

                            <tr>
                                <td style="width:100%; ">
                                <label><b>Motivation for treatment:</b></label>

                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Motivation" <?php if ($check_res["Motivation"] == "1") {echo "checked=checked";};?> id="Motivation-for-treatment-internal"  name="Motivation" value="1"><label for="Motivation-for-treatment-internal"> internal</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Motivation" <?php if ($check_res["Motivation"] == "2") {echo "checked=checked";};?> id="Motivation-for-treatment-external"  name="Motivation" value="2"><label for="Motivation-for-treatment-external"> external</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Motivation" <?php if ($check_res["Motivation"] == "3") {echo "checked=checked";};?> id="Motivation-for-treatment-other"  name="Motivation" value="3"><label for="Motivation-for-treatment-other"> other, explain: external or internal.</label>
                                <?php echo text($check_res['Motivation_explain']);?>
                            </td>
                            </tr>

                            <tr>
                                <td style="width:100%; ">
                                <label><b>Group Participation:</b></label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Group_Participation" <?php if ($check_res["Group_Participation"] == "1") {echo "checked=checked";};?> id="Group-Participation-poor"  name="Group_Participation" value="1"><label for="Group-Participation-poor"> poor</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Group_Participation" <?php if ($check_res["Group_Participation"] == "2") {echo "checked=checked";};?> id="Group-Participation-fair"  name="Group_Participation" value="2"><label for="Group-Participation-fair"> fair</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Group_Participation" <?php if ($check_res["Group_Participation"] == "3") {echo "checked=checked";};?> id="Group-Participation-moderate"  name="Group_Participation" value="3"><label for="Group-Participation-moderate"> moderate</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Group_Participation" <?php if ($check_res["Group_Participation"] == "4") {echo "checked=checked";};?> id="Group-Participation-good"  name="Group_Participation" value="4"><label for="Group-Participation-good"> good</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="Group_Participation" <?php if ($check_res["Group_Participation"] == "5") {echo "checked=checked";};?> id="Group-Participation-other"  name="Group_Participation" value="5"><label for="Group-Participation-other"> other, explain:</label>
                                <?php echo text($check_res['Group_Participation_explain']);?>
                            </td>
                            </tr>

                            <tr>
                                <td style="width:100%;" bgcolor="#000"></td>
                            </tr>

                            <tr>
                                <td style="width:100%; ">
                                <p style="margin: 0;"><b> Legal update:</b><?php echo text($check_res['Legal_update']);?></p>
                            </td>
                            </tr>

                            <tr>
                                <td style="width:100%;" bgcolor="#000"></td>
                            </tr>
                            <tr>
                                <td style="width:100%;padding: 0 !important; ">
                                    <table style="width:100%;border-color: black;border-bottom: 0px solid !important;border-left: 0px solid !important;border-right: 0px solid !important;" border="0" cellpadding="5" cellspacing="0">
                                      <tr>
                                      <td style="width:50%;border-right: 1px solid;"><b>Date of test:</b><?php echo text($check_res['Date_of_test']);?></td>
                                      <td style="width:50%;border-left: 1px solid;">
                                      <table style="width:100%;" border="0" cellpadding="2" cellspacing="0">
                                      <tr>
                                      <td style="width:50%;">
                                      <input type="checkbox" style="margin: 10px;margin-right: 4px;" class="onsite" id="onsite" <?php if ($check_res["onsite"] == "1") {echo "checked=checked";};?> name="onsite" value="1"><label for="onsite"> onsite</label>
                                    </td>
                                      <td style="width:50%;">
                                          <input type="checkbox" style="margin: 10px;margin-right: 4px;" id="overnight" <?php if ($check_res["onsite"] == "2") {echo "checked=checked";};?> class="onsite" name="onsite" value="2"><label for="overnight"> overnight</label>
                                      </td>

                                      </tr></table>
                                      </td>

                                      </tr></table>
                                </td>
                            </tr>
                            <?php $positive = str_split($check_res["positive"]); ?>
                            <?php $faint = str_split($check_res["faint"]); ?>
                            <tr>
                                <td style="width:100%; ">
                                <p style="margin: 0;"><b> Results:</b></p>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" id="negative-for-all" <?php if ($check_res["negative-for-all"] == "1") {echo "checked=checked";};?>  name="negative-for-all" value="1"><label for="negative-for-all"> negative for all</label>
                                <br>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $positive)) { echo "checked=checked";};?> id="positive-for"  name="positive[]" value="1"><label for="positive-for"> positive, for:</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $positive)) { echo "checked=checked";};?> id="positive-AMP"  name="positive[]" value="2"><label for="positive-AMP"> AMP</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $positive)) { echo "checked=checked";};?> id="positive-BAR"  name="positive[]" value="3"><label for="positive-BAR"> BAR</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $positive)) { echo "checked=checked";};?> id="positive-BZO"  name="positive[]" value="4"><label for="positive-BZO"> BZO</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(5, $positive)) { echo "checked=checked";};?> id="positive-COC"  name="positive[]" value="5"><label for="positive-COC"> COC</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(6, $positive)) { echo "checked=checked";};?> id="positive-OPI-MOP"  name="positive[]" value="6"><label for="positive-OPI-MOP"> OPI/ MOP</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(7, $positive)) { echo "checked=checked";};?> id="positive-MTD"  name="positive[]" value="7"><label for="positive-MTD"> MTD</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(8, $positive)) { echo "checked=checked";};?> id="positive-MET"  name="positive[]" value="8"><label for="positive-MET"> MET</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(9, $positive)) { echo "checked=checked";};?> id="positive-PCP"  name="positive[]" value="9"><label for="positive-PCP"> PCP</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(10, $positive)) { echo "checked=checked";};?> id="positive-OXY"  name="positive[]" value="10"><label for="positive-OXY"> OXY</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(11, $positive)) { echo "checked=checked";};?> id="positive-TCA"  name="positive[]" value="11"><label for="positive-TCA"> TCA</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(12, $positive)) { echo "checked=checked";};?> id="positive-THC"  name="positive[]" value="12"><label for="positive-THC"> THC</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(13, $positive)) { echo "checked=checked";};?> id="positive-MDMA"  name="positive[]" value="13"><label for="positive-MDMA"> MDMA</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(14, $positive)) { echo "checked=checked";};?> id="positive-PPX"  name="positive[]" value="14"><label for="positive-PPX"> PPX</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(15, $positive)) { echo "checked=checked";};?> id="positive-BUP"  name="positive[]" value="15"><label for="positive-BUP"> BUP</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(16, $positive)) { echo "checked=checked";};?> id="positive-ETOH"  name="positive[]" value="16"><label for="positive-ETOH"> ETOH</label>
                                <br>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(1, $faint)) { echo "checked=checked";};?> id="faint-for"  name="faint[]" value="1"><label for="faint-for"> faint, for:</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(2, $faint)) { echo "checked=checked";};?> id="faint-AMP"  name="faint[]" value="2"><label for="faint-AMP"> AMP</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(3, $faint)) { echo "checked=checked";};?> id="faint-BAR"  name="faint[]" value="3"><label for="faint-BAR"> BAR</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(4, $faint)) { echo "checked=checked";};?> id="faint-BZO"  name="faint[]" value="4"><label for="faint-BZO"> BZO</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(5, $faint)) { echo "checked=checked";};?> id="faint-COC"  name="faint[]" value="5"><label for="faint-COC"> COC</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(6, $faint)) { echo "checked=checked";};?> id="faint-OPI-MOP"  name="faint[]" value="6"><label for="faint-OPI-MOP"> OPI/ MOP</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(7, $faint)) { echo "checked=checked";};?> id="faint-MTD"  name="faint[]" value="7"><label for="faint-MTD"> MTD</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(8, $faint)) { echo "checked=checked";};?> id="faint-MET"  name="faint[]" value="8"><label for="faint-MET"> MET</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(9, $faint)) { echo "checked=checked";};?> id="faint-PCP"  name="faint[]" value="9"><label for="faint-PCP"> PCP</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(10, $faint)) { echo "checked=checked";};?> id="faint-OXY"  name="faint[]" value="10"><label for="faint-OXY"> OXY</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(11, $faint)) { echo "checked=checked";};?> id="faint-TCA"  name="faint[]" value="11"><label for="faint-TCA"> TCA</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(12, $faint)) { echo "checked=checked";};?> id="faint-THC"  name="faint[]" value="12"><label for="faint-THC"> THC</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(13, $faint)) { echo "checked=checked";};?> id="faint-MDMA"  name="faint[]" value="13"><label for="faint-MDMA"> MDMA</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(14, $faint)) { echo "checked=checked";};?> id="faint-PPX"  name="faint[]" value="14"><label for="faint-PPX"> PPX</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(15, $faint)) { echo "checked=checked";};?> id="faint-BUP"  name="faint[]" value="15"><label for="faint-BUP"> BUP</label>
                                <input type="checkbox" style="margin: 10px;margin-right: 4px;" <?php if (in_array(16, $faint)) { echo "checked=checked";};?> id="faint-ETOH"  name="faint[]" value="16"><label for="faint-ETOH"> ETOH</label>

                            </td>
                            </tr>

                        </table>


            <?php
        ?>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:right'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

//$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Consent Form");
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($body);
$mpdf->defaultfooterline = 0;
//         //save the file put which location you need folder/filname
// $checkid = sqlQuery("SELECT formid FROM pdf_directory WHERE formid=?", array($formid));
// if($checkid['formid'] != $formid){
//     $pdf_data = sqlInsert('INSERT INTO pdf_directory (path,pid,encounter,formid) VALUES (?,?,?,?)',array($filename,$_SESSION["pid"],$_SESSION["encounter"],$formid));
// }

$mpdf->Output('Consent_Form.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
