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

$doctor_note= $formid ? formFetch("form_doctor_note", $formid) : array();

?>
<html>
    <head>
        <title><?php echo xlt("Personal Drug Use Questionnaire"); ?></title>

        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
        <style>
             .pen_icon {
            cursor: pointer;
        }
            .outline-text{
                color: black;
                outline: none;
                outline-style: none;
                border: 0px 0px 1px 0px;
                border-top: none;
                border-left: none;
                border-right: none;
                border-bottom: solid #212529de 1px;
                margin: 4px;
            }
        </style>
    </head>
    <body>
        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <center><h2><?php echo xlt('Daily doctor’s note'); ?></h2></center>
                    <form method="post" name="my_form" id="my_form" action="<?php echo $rootdir; ?>/forms/doctor_note/save.php?id=<?php echo attr_url($formid); ?>">
                        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                       <table  style="width:100%;" border='1' cellpadding="10" cellspacing="0">
                            <tr style="background-color:black;color:white;">
                                <th style="text-align:center;padding:3px;" colspan='3'>Basic Information</th>
                            </tr>
                            <tr>
                                <th style="width:60% padding:3px;">Patient name: <input type="text" name="patient_name" value="<?php echo $doctor_note['patient_name']??''; ?>"></th>
                                <th style="padding:3px;">Date: <input type="date" name="date1" value="<?php echo $doctor_note['date1']??''; ?>"></th>
                                <th style="padding:3px;">Time: <input type="time" name='time1' value="<?php echo $doctor_note['time1']??''; ?>"></th>
                            </tr>
                            <tr>
                                <th colspan='3'>
                                Current medications:
                                <textarea class="form-control" name="current_medication"> <?php echo $doctor_note['current_medication']??''; ?></textarea>
                                <br>
                                Outside Prescriber:
                                <textarea class="form-control" name="outside_prescriber"> <?php echo $doctor_note['outside_prescriber']??''; ?></textarea>
                                <br>
                                COVID-19 RISK ASSESSMENT (date) upon arrival patient scored a (0). Low risk: Patient was educated on hydration handwashing and droplet precautions.  Patient will be observed and evaluated for risk daily upon arrival to CNT.
                                </th>

                            </tr>
                            <tr>
                                <th style="border:none">Compliant with current medications:</th>
                                <th style="border:none"><input type="radio" value="yes" name="complain_medication" <?php echo isset($doctor_note['complain_medication']) &&$doctor_note['complain_medication']=='yes'?'checked':'';?>>yes</th>
                                <th style="border:none"> <input type="radio" value='no' name="complain_medication" <?php echo isset($doctor_note['complain_medication']) &&$doctor_note['complain_medication']=='no'?'checked':'';?> >no</th>
                            </tr>
                            <tr>
                                <th style="60%">Blood pressure: <input type="text" name="blood_pressure" value="<?php echo $doctor_note['blood_pressure']??''; ?>"></th>
                                <th colspan='2'>Heart rate: <input type="text" name="heart_rate" value="<?php echo $doctor_note['heart_rate']??''; ?>"></th>
                            </tr>
                            <tr style="background-color:black;color:white;">
                                <th style="text-align:center;padding:3px;" colspan='3'>Patient Update</th>
                            </tr>
                        </table>
                            <div colspan='3' contentEditable="true" class="text_edit"><?php echo $doctor_note['text1']??"
                                <b>Update: </b> The patient was seen, c/o withdrawal symptoms attached.  Patient was seen and their COVID-19 Risk Assessment is currently no risk (0). Patient was educated on hydration, handwashing and droplet precautions. Patient will be observed and evaluated for risk daily upon arrival to CNT. Patient was seen today, c/o attached symptoms. Patient stated ”xx.” Patient reports (craving intensity: i.e none, mild, moderate or severe cravings) at this time. Will follow up. Patient exhibits the following withdrawal symptoms such as (list applicable withdrawal symptoms) as well as the indicated symptoms on the attached withdrawal symptom checklist. Psychiatrically, the patient reports (list current emotional states and their intensity on scale 1-10, i.e. anxiety, sadness, fearfulness and irritability) at this time.  Will follow up.  Patient has reported a diagnosis of (psychiatric diagnoses). Will follow up. Medically, the patient presents with (list biomedical conditions).  Will follow up. Therapy and medical supervision are sufficient to help deal with her stressors at this moment through group and individual therapy sessions. The patient does not present with signs or symptoms of (SI/HI/VH/AH). Patient was counseled to be active in group therapy and to address active stressors with therapists in both groups and individual sessions. Patient was counseled for compliance of medications, DUI/DWI, Risky behavior to prevent relapse if necessary rush to the nearest ER and/or call 911 after hours."?>
                            </div><input type="hidden" name="text1" id="text1">
                                
                            <table cellpadding="10" cellspacing="0">    
                                <tr>
                                    <td>
                                        12 Step Program: <input type="checkbox" class="radio-checkbox step_program" data-id='step_program' value="daily" <?php echo isset($doctor_note['step_program']) &&$doctor_note['step_program']=='daily'?'checked':'';?>>attending daily
                                        <input type="checkbox" class="radio-checkbox step_program" value="weekly"  data-id='step_program' <?php echo isset($doctor_note['step_program']) &&$doctor_note['step_program']=='weekly'?'checked':'';?>>2-3 days weekly
                                        <input type="hidden" name="step_program" id="hidden_step_program" value="<?php echo $doctor_note['step_program']??'';?>">

                                        <br>
                                        Sponsor: <input type="checkbox" class="radio-checkbox sponser" data-id='sponser' value="yes" <?php echo isset($doctor_note['sponser']) &&$doctor_note['sponser']=='yes'?'checked':'';?>>yes
                                        <input type="checkbox" class="radio-checkbox sponser" data-id='sponser' value="no" <?php echo isset($doctor_note['sponser']) &&$doctor_note['sponser']=='yes'?'no':'';?>>no
                                        <input type="checkbox" class="radio-checkbox sponser" data-id='sponser'  value="recommended" <?php echo isset($doctor_note['sponser']) &&$doctor_note['sponser']=='recommended'?'checked':'';?>>Recommended
                                        <input type="hidden" name="sponser" id="hidden_sponser" value="<?php echo $doctor_note['sponser']??'';?>">
                                        <br>
                                    </td>
                                </tr>
                            </table>

                                <div contentEditable="true" class="text_edit"><?php echo $doctor_note['text2']??"Discussed medication options with patient including maintenance medications.<br>
                                Patient is in the (stage of change) stage of change.<br>
                                Patient is stable to return home after last dose of medication.<br>"?></div><input type="hidden" name="text2" id="text2">

                        <table style="width:100%;" border='1' cellpadding="10" cellspacing="0">
                            <tr style="background-color:black;color:white;">
                                <th style="text-align:center;padding:3px;" colspan='3'>Review of Systems</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <table style="width:100%">
                                    <?php
                                    $review_system=explode(',',$doctor_note['review_system']);
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" value="constitutional" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("constitutional", $review_system)?'checked':''?>>constitutional</td>
                                        <td><input type="checkbox" value="eye" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("eye", $review_system)?'checked':''?>>eye</td>
                                        <td><input type="checkbox" value="ent" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("ent", $review_system)?'checked':''?>> ENT      </td>
                                        <td><input type="checkbox" value="Cardiovascular" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Cardiovascular", $review_system)?'checked':''?>>Cardiovascular </td>
                                        <td><input type="checkbox" value="Pulmonary" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Pulmonary", $review_system)?'checked':''?>>Pulmonary   </td>
                                        <td><input type="checkbox" value="Gastrointestinal" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Gastrointestinal", $review_system)?'checked':''?>>Gastrointestinal</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;"><input type="checkbox" value="Genitourinary" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Genitourinary", $review_system)?'checked':''?>>Genitourinary</td>
                                        <td style="text-align:center;"><input type="checkbox" value="Musculoskeletal" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Musculoskeletal", $review_system)?'checked':''?>>Musculoskeletal</td>
                                        <td style="text-align:center;"><input type="checkbox" value="Neurological" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Neurological", $review_system)?'checked':''?>>Neurological       </td>
                                        <td colspan='2' style="text-align:center;"><input type="checkbox" value="psychological" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("psychological", $review_system)?'checked':''?>>psychological</td>
                                    </tr>
                                    <tr>
                                    <td style="text-align:center;"><input type="checkbox" value="Endocrine" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Endocrine", $review_system)?'checked':''?>>Endocrine</td>
                                        <td style="text-align:center;"><input type="checkbox" value="hema" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("hema", $review_system)?'checked':''?>>Hema      </td>
                                        <td style="text-align:center;"><input type="checkbox" value="Lymphatic" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Lymphatic", $review_system)?'checked':''?>>Lymphatic             </td>
                                        <td style="text-align:center;"><input type="checkbox" value="Immune" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Immune", $review_system)?'checked':''?>>Immune       </td>
                                        <td colspan='2' style="text-align:center;"><input type="checkbox" value="all" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("all", $review_system)?'checked':''?>>all</td>
                                        <input type="hidden" id='review_system' name="review_system">
                                    </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr style="background-color:black;color:white;">
                                <th style="text-align:center;padding:3px;" colspan='3'>Mental Status Exam</th>
                            </tr>
                            <tr>

                                <td style="border:none;" colspan="3"><b>Appearance</b>
                                <input type="checkbox" class="radio-checkbox mental_appearance" data-id='mental_appearance' value="appropriate" <?php echo isset($doctor_note['mental_appearance'])&& $doctor_note['mental_appearance']=='appropriate'?'checked':''?>>appropriate &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox mental_appearance" data-id='mental_appearance' value="disheveled" <?php echo isset($doctor_note['mental_appearance'])&& $doctor_note['mental_appearance']=="disheveled"?'checked':''?>>disheveled &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox mental_appearance" data-id='mental_appearance' value="bizarre" <?php echo isset($doctor_note['mental_appearance'])&& $doctor_note['mental_appearance']=="bizarre"?'checked':''?>>bizarre &nbsp;&nbsp;&nbsp;
                                <input type="hidden" id="hidden_mental_appearance" name='mental_appearance'>
                                <br>
                                Describe:<textarea name="mental_decribe" class="form-control" value="<?php echo $doctor_note['mental_decribe']??''; ?>"></textarea></td>

                            </tr>
                            <tr>
                                <td style="border-right:none;border-left:none;border-bottom:none" colspan="3">
                                <div style="display:flex;"><b>Musculoskeletal: </b><br>

                                <div style="margin: 0px 183px"><b>Strength/ Tone: </b>
                                <input type="checkbox" class="radio-checkbox musculo_stregth" data-id='musculo_stregth'  value="normal" <?php echo isset($doctor_note['strength']) &&$doctor_note['strength']=='normal'?'checked':'';?> >normal &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox musculo_stregth" data-id='musculo_stregth'  value="abnormal" <?php echo isset($doctor_note['strength']) &&$doctor_note['strength']=='abnormal'?'checked':'';?>>abnormal</div>
                                <input type="hidden" name="strength" id="hidden_strength" value="<?php echo $doctor_note['strength']??'';?>">
                                <div><b>Gait/Station </b><input type="checkbox" class="radio-checkbox gain_station" data-id='gain_station' value="normal" <?php echo isset($doctor_note['gain_station']) &&$doctor_note['gain_station']=='normal'?'checked':'';?>>normal
                                <input type="checkbox"  class="radio-checkbox gain_station" data-id='gain_station'  value="abnormal" <?php echo isset($doctor_note['gain_station']) &&$doctor_note['gain_station']=='abnormal'?'checked':'';?>>abnormal
                                <input type="hidden" name="gain_station" id="hidden_gain_station" value="<?php echo $doctor_note['gain_station']??'';?>">
                                </div>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-style:none;">Describe
                                <textarea class="form-control" name="Musculo_describe" value="<?php echo $doctor_note['Musculo_describe']??''; ?>"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <?php

                                $speech = explode(',',$doctor_note['speech']);
                                ?>
                                <td style="border-right:none;border-left:none;border-bottom:none" colspan="4"><b>speech:</b>
                                <input type="checkbox" class="speech"  value="normal" <?php echo isset($doctor_note['speech'])&& in_array("normal", $speech)?'checked':''?>>normal &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="hyperactive"  <?php echo isset($doctor_note['speech'])&& in_array("hyperactive", $speech)?'checked':''?>>hyperactive&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="retardation" <?php echo isset($doctor_note['speech'])&& in_array("retardation", $speech)?'checked':''?>>retardation      &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="abnormal" <?php echo isset($doctor_note['speech'])&& in_array("abnormal", $speech)?'checked':''?>>abnormal movements<br>
                                <input type="checkbox" class="speech" value="Slurred" <?php echo isset($doctor_note['speech'])&& in_array("Slurred", $speech)?'checked':''?>>Slurred&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="Orobuccal" <?php echo isset($doctor_note['speech'])&& in_array("Orobuccal", $speech)?'checked':''?>>Orobuccal Movement        &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="Pressured" <?php echo isset($doctor_note['speech'])&& in_array("Pressured", $speech)?'checked':''?>>Pressured
                                <input type="checkbox" class="speech" value="Loud" <?php echo isset($doctor_note['speech'])&& in_array("Loud", $speech)?'checked':''?>>Loud&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="Monotonous" <?php echo isset($doctor_note['speech'])&& in_array("Monotonous", $speech)?'checked':''?>>Monotonous <br>
                                <input type="checkbox" class="speech" value="Tremulous" <?php echo isset($doctor_note['speech'])&& in_array("Tremulous", $speech)?'checked':''?>>Tremulous
                                <input type="hidden" id="speech" name="speech">
                                </td>

                            </tr>
                            <tr>
                                <td colspan="3" style="border:none;"> Describe
                                <textarea class="form-control" name="speech_decribe"><?php echo $doctor_note['speech_decribe']??''; ?></textarea></td>
                            </tr>

                            <tr>
                            <?php
                            $thoughts_content = explode(',',$doctor_note['thoughts_content']);
                            ?>
                            <td style="border-right:none;border-left:none;border-bottom:none"  colspan="4"><b>Thoughts Content:</b>
                            <input type="checkbox" class="thoughts_content" value="none" <?php echo isset($doctor_note['thoughts_content'])&& in_array("none", $thoughts_content)?'checked':''?>>none&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="delusions" <?php echo isset($doctor_note['thoughts_content'])&& in_array("delusions", $thoughts_content)?'checked':''?>>delusions      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="overvalued" <?php echo isset($doctor_note['thoughts_content'])&& in_array("overvalued", $thoughts_content)?'checked':''?>>overvalued ideas &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Preoccupations" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Preoccupations", $thoughts_content)?'checked':''?>>Preoccupations&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="depressive" <?php echo isset($doctor_note['thoughts_content'])&& in_array("depressive", $thoughts_content)?'checked':''?>>depressive thoughts&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="self" <?php echo isset($doctor_note['thoughts_content'])&& in_array("self", $thoughts_content)?'checked':''?>>self-harm &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Suicidal" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Suicidal", $thoughts_content)?'checked':''?>>Suicidal Ideations    &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Aggressive" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Aggressive", $thoughts_content)?'checked':''?>>Aggressive or Homicidal Ideations&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Obsessions" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Obsessions", $thoughts_content)?'checked':''?>>Obsessions &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Anxiety" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Anxiety", $thoughts_content)?'checked':''?>>Anxiety
                            <input type="hidden" name="thoughts_content" id="thoughts_content">
                            </td>

                        </tr>
                        <tr>
                            <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="thoughts_content_describe"><?php echo $doctor_note['thoughts_content_describe']??''; ?></textarea></td>
                        </tr>

                        <tr>
                            <?php
                            $thought_process = explode(',',$doctor_note['thought_process']);
                            ?>
                            <td style="border-right:none;border-left:none;border-bottom:none" colspan="4"><b>Thought Process: </b>
                            <input type="checkbox" class="thought_process" value="coherent" <?php echo isset($doctor_note['thought_process'])&& in_array("coherent", $thought_process)?'checked':''?>>coherent      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="soft" <?php echo isset($doctor_note['thought_process'])&& in_array("soft", $thought_process)?'checked':''?>>soft            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="loose" <?php echo isset($doctor_note['thought_process'])&& in_array("loose", $thought_process)?'checked':''?>>loose associations        &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="flight-idea" <?php echo isset($doctor_note['thought_process'])&& in_array("flight-idea", $thought_process)?'checked':''?>>flight of ideas&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="tangential" <?php echo isset($doctor_note['thought_process'])&& in_array("tangential", $thought_process)?'checked':''?>>Tangential thinking          &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="nonsence_words" <?php echo isset($doctor_note['thought_process'])&& in_array("nonsence_words", $thought_process)?'checked':''?>>Nonsense words/Word Salad    &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="thoght_block" <?php echo isset($doctor_note['thought_process'])&& in_array("thoght_block", $thought_process)?'checked':''?>>Thought Blocking      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="thoght_race" <?php echo isset($doctor_note['thought_process'])&& in_array("thoght_race", $thought_process)?'checked':''?>>Thought racing&nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="thought_process" id="thought_process">
                            </td>

                        </tr>
                        <tr>
                            <td colspan="3" style="border:none;" name="thought_process_describe"> Describe:
                            <textarea class="form-control"><?php echo $doctor_note['thought_process_describe']??''; ?></textarea></td>
                        </tr>

                        <tr>
                            <?php
                            $thought_assc = explode(',',$doctor_note['thought_assc']);
                            ?>
                            <td style="border-right:none;border-left:none;border-bottom:none" colspan="4"><b> Thought Associations: </b>
                            <input type="checkbox" class="thought_assc" value="intact" <?php echo isset($doctor_note['thought_assc'])&& in_array("intact", $thought_assc)?'checked':''?>>intact            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox"  class="thought_assc" value="circumstantial" <?php echo isset($doctor_note['thought_assc'])&& in_array("circumstantial", $thought_assc)?'checked':''?>>circumstantial                  &nbsp;&nbsp;&nbsp;
                            <input type="checkbox"  class="thought_assc" value="tangential" <?php echo isset($doctor_note['thought_assc'])&& in_array("tangential", $thought_assc)?'checked':''?>>tangential              &nbsp;&nbsp;&nbsp;
                            <input type="checkbox"  class="thought_assc" value="loose" <?php echo isset($doctor_note['thought_assc'])&& in_array("loose", $thought_assc)?'checked':''?>>loose&nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="thought_assc" id="thought_assc">
                        </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="thought_assc_describe"><?php echo $doctor_note['thought_assc_describe']??''; ?></textarea></td>
                        </tr>

                        <tr>
                            <?php
                            $dis_symptoms = explode(',',$doctor_note['dis_symptoms']);
                            $nallucinations = explode(',',$doctor_note['nallucinations']);
                            ?>
                            <td style="border-right:none;border-left:none;border-bottom:none" colspan="4"><b>  Perception: </b>&nbsp;&nbsp;&nbsp;
                            <b>Dissociative symptoms:   </b>
                            <input type="checkbox" class="dis_symptoms" value="Derealizations" <?php echo isset($doctor_note['dis_symptoms'])&& in_array("Derealizations", $dis_symptoms)?'checked':''?>>Derealizations               &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="dis_symptoms" value="Depersonalization" <?php echo isset($doctor_note['dis_symptoms'])&& in_array("Depersonalization", $dis_symptoms)?'checked':''?>>Depersonalization &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="dis_symptoms" value="Illusions"  <?php echo isset($doctor_note['dis_symptoms'])&& in_array("Depersonalization", $dis_symptoms)?'checked':''?>>Illusions <br>
                            <input type="hidden" name="dis_symptoms" id="dis_symptoms">
                            <b>Hallucinations:     </b>             &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="nallucinations" value="Visual"  <?php echo isset($doctor_note['nallucinations'])&& in_array("Visual", $nallucinations)?'checked':''?>>Visual &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="nallucinations" value="Tactile" <?php echo isset($doctor_note['nallucinations'])&& in_array("Tactile", $nallucinations)?'checked':''?>>Tactile    &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="nallucinations" value="Auditory" <?php echo isset($doctor_note['nallucinations'])&& in_array("Auditory", $nallucinations)?'checked':''?>>Auditory      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="nallucinations" value="Command" <?php echo isset($doctor_note['nallucinations'])&& in_array("Command", $nallucinations)?'checked':''?>>Command
                            <input type="hidden" name="nallucinations" id="nallucinations">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="Perception_descibe"><?php echo $doctor_note['Perception_descibe']??''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td style="border-right:none;border-left:none;border-bottom:none;width:50%"  ><b>Judgment</b>
                            <input type="checkbox" class="radio-checkbox judgement" data-id="judgement"  value="poor" <?php echo isset($doctor_note['judgement']) &&$doctor_note['judgement']=='poor'?'checked':'';?>>poor       &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox judgement" data-id="judgement"  value="fair" <?php echo isset($doctor_note['judgement']) &&$doctor_note['judgement']=='fair'?'checked':'';?>>fair &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox judgement" data-id="judgement"  value="good" <?php echo isset($doctor_note['judgement']) &&$doctor_note['judgement']=='good'?'checked':'';?>>good &nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="judgement" id="hidden_judgement" value="<?php echo $doctor_note['judgement']??'';?>">
                        </td>
                            <td style="border-right:none;border-left:none;border-bottom:none;width:50%" colspan="2" >
                                <b>Insight </b>
                                <input type="checkbox" class="radio-checkbox insight" data-id='insight'  value="minimal" <?php echo isset($doctor_note['insight']) &&$doctor_note['insight']=='minimal'?'checked':'';?>>minimal              &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox insight" data-id='insight'  value="moderate" <?php echo isset($doctor_note['insight']) &&$doctor_note['insight']=='moderate'?'checked':'';?>>moderate       &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox insight" data-id='insight'  value="good" <?php echo isset($doctor_note['insight']) &&$doctor_note['insight']=='good'?'checked':'';?>>good &nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="insight" id="hidden_insight" value="<?php echo $doctor_note['insight']??'';?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="insight_describe"><?php echo $doctor_note['insight_describe']??''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100%;border-right:none;border-left:none;border-bottom:none;" colspan="3">
                                <b>Orientation:</b>
                                <input type="checkbox" class="radio-checkbox orintation" data-id='orintation'  value="time" <?php echo isset($doctor_note['orintation']) &&$doctor_note['orintation']=='time'?'checked':'';?>>time&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox orintation" data-id='orintation'  value="person" <?php echo isset($doctor_note['orintation']) &&$doctor_note['orintation']=='person'?'checked':'';?>>person &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox orintation" data-id='orintation'   value="place" <?php echo isset($doctor_note['orintation']) &&$doctor_note['orintation']=='place'?'checked':'';?>>place &nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="orintation" id="hidden_orintation" value="<?php echo $doctor_note['orintation']??'';?>">
                                <br>
                                <b>Attention Span/ Concentration</b>
                                <input type="checkbox" class="radio-checkbox attenstion"  data-id='attension' value="intact" <?php echo isset($doctor_note['attension']) &&$doctor_note['attension']=='intact'?'checked':'';?>>intact&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox attenstion"  data-id='attension' value="impaired" <?php echo isset($doctor_note['attension']) &&$doctor_note['attension']=='impaired'?'checked':'';?>>impaired &nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="attension" id="hidden_attension" value="<?php echo $doctor_note['attension']??'';?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="orientation_describe"><?php echo $doctor_note['orientation_describe']??''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td  colspan="3" style="border:none;"><b>Memory </b></td>
                        </tr>
                        <tr>
                        <td style="border-right:none;border-left:none;border-bottom:none;width:50%"  ><b>Recent</b>
                            <input type="checkbox" class="radio-checkbox recent" data-id="recent"  value="intent" <?php echo isset($doctor_note['recent']) &&$doctor_note['recent']=='intact'?'checked':'';?>>intent       &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox recent" data-id="recent"  value="impaired" <?php echo isset($doctor_note['recent']) &&$doctor_note['recent']=='impaired'?'checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox recent" data-id="recent"  value="digits" <?php echo isset($doctor_note['recent']) &&$doctor_note['recent']=='digits'?'checked':'';?>>digits forward          &nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="recent" id="hidden_recent" value="<?php echo $doctor_note['recent']??'';?>">
                            </td>
                            <td style="border-right:none;border-left:none;border-bottom:none;width:50%" colspan="2" >
                                <b>Remote</b>
                                <input type="checkbox" class="radio-checkbox remote" data-id="remote"  value="intact" <?php echo isset($doctor_note['remote']) &&$doctor_note['remote']=='intact'?'checked':'';?>>intact&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox remote" data-id="remote"  value="impaired" <?php echo isset($doctor_note['remote']) &&$doctor_note['remote']=='impaired'?'checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="remote" id="hidden_remote" value="<?php echo $doctor_note['remote']??'';?>">
                            </td>
                        </tr>
                        <tr>
                        <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="memory_describe"><?php echo $doctor_note['memory_describe']??''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td style="border-right:none;border-left:none;border-bottom:none;width:50%"><b>Language </b></td>
                            <td style="border-right:none;border-left:none;border-bottom:none;width:50%" colspan="2" >
                            <b>Name Objects </b>
                            <input type="checkbox" class="radio-checkbox langugae"  data-id='langugae' value="intact" <?php echo isset($doctor_note['lang_object']) &&$doctor_note['lang_object']=='intact'?'checked':'';?>>intact                   &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox langugae"  data-id='langugae' value="impaired" <?php echo isset($doctor_note['lang_object']) &&$doctor_note['lang_object']=='impaired'?'checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="lang_object" id="hidden_lang_object" value="<?php echo $doctor_note['lang_object']??'';?>">
                            <br>
                            <b>Repeat phrases  </b>
                            <input type="checkbox" class="radio-checkbox phrase" data-id='phrase'  value='intact' <?php echo isset($doctor_note['phrase']) &&$doctor_note['phrase']=='intact'?'checked':'';?>>intact                   &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox phrase" data-id='phrase'  value='impaired'<?php echo isset($doctor_note['phrase']) &&$doctor_note['phrase']=='impaired'?'checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="phrase" id="hidden_phrase" value="<?php echo $doctor_note['phrase']??'';?>">
                        </tr>
                        <tr>
                        <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="langugae_describe"><?php echo $doctor_note['langugae_describe']??''; ?></textarea></td>
                        </tr>

                        <tr>
                            <td style="border-right:none;border-left:none;border-bottom:none;" colspan="3"><b>Knowledge</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!-- <td style="border-right:none;border-left:none;border-bottom:none;" colspan="3" > -->
                            <b>Current Events  </b>
                            <input type="checkbox" class="radio-checkbox knowledge" data-id='knowledge'  value='intact' <?php echo isset($doctor_note['knowledge']) &&$doctor_note['knowledge']=='intact'?'checked':'';?>>intact                   &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox knowledge" data-id='knowledge'  value='impaired' <?php echo isset($doctor_note['knowledge']) &&$doctor_note['knowledge']=='impaired'?'checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="knowledge" id="hidden_knowledge" value="<?php echo $doctor_note['knowledge']??'';?>">
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>Past History  </b>
                            <input type="checkbox" class="radio-checkbox past_history"  data-id='past_history' value="intact" <?php echo isset($doctor_note['past_history']) &&$doctor_note['past_history']=='intact'?'checked':'';?>>intact                   &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox past_history"  data-id='past_history' value="impaired" <?php echo isset($doctor_note['past_history']) &&$doctor_note['past_history']=='impaired'?'checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="past_history" id="hidden_past_history" value="<?php echo $doctor_note['past_history']??'';?>">
                        </tr>
                        <tr>
                        <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="knowledge_describe"><?php echo $doctor_note['knowledge_describe']??''; ?></textarea></td>
                        </tr>
                        <tr>
                            <?php
                            $mood = explode(',',$doctor_note['mood']);
                            ?>
                            <td style="border-right:none;border-left:none;border-bottom:none;width:100%" colspan="3"><b>Mood</b>
                            <input type="checkbox" class="mood" value="euthymic" <?php echo isset($doctor_note['mood'])&& in_array("euthymic", $mood)?'checked':''?>>euthymic&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="depressed" <?php echo isset($doctor_note['mood'])&& in_array("depressed", $mood)?'checked':''?>>depressed      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="hypomanic" <?php echo isset($doctor_note['mood'])&& in_array("hypomanic", $mood)?'checked':''?>>hypomanic      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="euphoric" <?php echo isset($doctor_note['mood'])&& in_array("euphoric", $mood)?'checked':''?>>euphoric      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="angry" <?php echo isset($doctor_note['mood'])&& in_array("angry", $mood)?'checked':''?>>angry      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="anxious" <?php echo isset($doctor_note['mood'])&& in_array("anxious", $mood)?'checked':''?>>anxious      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="labile" <?php echo isset($doctor_note['mood'])&& in_array("labile", $mood)?'checked':''?>>labile&nbsp;&nbsp;&nbsp;
                            <input type="hidden" id="mood" name="mood">

                            </td>

                        </tr>
                        <tr>
                        <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="mood_descibe"><?php echo $doctor_note['mood_descibe']??''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan='3'><b>Affect:</b>&nbsp;&nbsp;&nbsp;<b>Appropriateness</b>
                            <input type="checkbox" class="radio-checkbox appropriateness" data-id="appropriateness"  value="appropriate" <?php echo isset($doctor_note['appropriateness']) &&$doctor_note['appropriateness']=='appropriate'?'checked':'';?>>appropriate&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox appropriateness" data-id="appropriateness"  value="inappropriate" <?php echo isset($doctor_note['appropriateness']) &&$doctor_note['appropriateness']=='inappropriate'?'checked':'';?>>inappropriate&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox appropriateness" data-id="appropriateness"  value="incongruous" <?php echo isset($doctor_note['appropriateness']) &&$doctor_note['appropriateness']=='incongruous'?'checked':'';?>>incongruous&nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="appropriateness" id="hidden_appropriateness" value="<?php echo $doctor_note['appropriateness']??'';?>">
                            <br>
                            <div style="margin-left: 62px;">
                            <b>Range</b>
                            <input type="checkbox" class="radio-checkbox range" data-id='range'  value='blunted' <?php echo isset($doctor_note['range1']) &&$doctor_note['range1']=='blunted'?'checked':'';?>>blunted &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox range" data-id='range'  value='restricted' <?php echo isset($doctor_note['range1']) &&$doctor_note['range1']=='restricted'?'checked':'';?>>restricted  &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox range" data-id='range'  value='flat' <?php echo isset($doctor_note['range1']) &&$doctor_note['range1']=='flat'?'checked':'';?>>flat&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox range" data-id='range'  value='Broad' <?php echo isset($doctor_note['range1']) &&$doctor_note['range1']=='Broad'?'checked':'';?>>Broad
                            <input type="hidden" name="range1" id="hidden_range1" value="<?php echo $doctor_note['range1']??'';?>">
                            </div>
                            <div style="margin-left: 62px;">
                            <b>Stability</b>
                            <input type="checkbox" class="radio-checkbox stability" data-id='stability'  value='stable' <?php echo isset($doctor_note['stability']) &&$doctor_note['stability']=='stable'?'checked':'';?>>stable  &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox stability" data-id='stability'  value='Labile' <?php echo isset($doctor_note['stability']) &&$doctor_note['stability']=='Labile'?'checked':'';?>>Labile  &nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="stability" id="hidden_stability" value="<?php echo $doctor_note['stability']??'';?>">
                        </div>
                        </td>
                        </tr>
                        <tr style="background-color:black;color:white;">
                                <th style="text-align:center;padding:3px;" colspan='3'>Urine Toxicology</th>
                        </tr>
                        <tr>
                            <th>date:<input type="date" name="urine_date" value="<?php echo $doctor_note['urine_date']??'';?>"></th>
                            <td><input type="checkbox" class="radio-checkbox toxocology"  data-id="toxocology" value="onsite" <?php echo isset($doctor_note['toxocology']) &&$doctor_note['toxocology']=='onsite'?'checked':'';?>> onsite</td>
                            <td><input type="checkbox" class="radio-checkbox toxocology"  data-id="toxocology" value="overnight" <?php echo isset($doctor_note['toxocology']) &&$doctor_note['toxocology']=='overnight'?'checked':'';?>> overnight</td>
                            <input type="hidden" name="toxocology" id="hidden_toxocology" value="<?php echo $doctor_note['toxocology']??'';?>">
                        </tr>
                        <tr >
                            <th style="border:none">Results: </th>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="negative" <?php echo isset($doctor_note['negative']) &&$doctor_note['negative']=='yes'?'checked':'';?> value="yes">negative for all</td>
                        </tr>
                        <tr>
                            <?php
                             $positive  = explode(',',$doctor_note['positive']);
                            ?>
                            <td style="border:none" colspan="3"><input type="checkbox" name="postive_for" class="result" data-id="positive_for" value="yes"  id='positive_for' <?php echo isset($doctor_note['postive_for']) &&$doctor_note['postive_for']=='yes'?'checked':'';?>>positive, for:
                                <input type="checkbox" class="positive positive_for" value="AMP" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("AMP", $positive)?'checked':''?>>AMP&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="BAR" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("BAR", $positive)?'checked':''?>>BAR&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="BZO" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("BZO", $positive)?'checked':''?>>BZO&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="COC" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("COC", $positive)?'checked':''?>>COC&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="OPI" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("OPI", $positive)?'checked':''?>>OPI/MOP&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="MTD" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("MTD", $positive)?'checked':''?>>MTD&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="MET" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("MET", $positive)?'checked':''?>>MET&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="PCP" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("PCP", $positive)?'checked':''?>>PCP&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="OXY" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("OXY", $positive)?'checked':''?>>OXY&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="TCA" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("TCA", $positive)?'checked':''?>>TCA&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="THC" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("TCA", $positive)?'checked':''?>>THC&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="MDMA" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("MDMA", $positive)?'checked':''?>>MDMA &nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="PPX" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("PPX", $positive)?'checked':''?>>PPX&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="BUP" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("BUP", $positive)?'checked':''?>>BUP&nbsp;&nbsp;
                                <input type="hidden" name="positive" id="positive">
                            </td>
                        </tr>
                        <tr>
                            <?php
                             $fair = explode(',',$doctor_note['fair']);
                            ?>
                            <td style="border:none" colspan="3"><input type="checkbox" name="faint_for" class="result" data-id="faint_for" value="yes" id="faint_for" <?php echo isset($doctor_note['faint_for']) &&$doctor_note['faint_for']=='yes'?'checked':'';?>>faint, for:&nbsp;&nbsp;
                                <input type="checkbox" class="fair faint_for" value="AMP" <?php echo isset($doctor_note['fair'])&&$doctor_note['faint_for']=='yes'&& in_array("AMP", $fair)?'checked':''?>>AMP&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="BAR" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("BAR", $fair)?'checked':''?>>BAR&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for"value="BZO" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("BZO", $fair)?'checked':''?>>BZO&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="COC" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("COC", $fair)?'checked':''?>>COC&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="OPI" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("OPI", $fair)?'checked':''?>>OPI/MOP&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="MTD" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("MTD", $fair)?'checked':''?>>MTD&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="MET" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("MET", $fair)?'checked':''?>>MET&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="PCP" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("PCP", $fair)?'checked':''?>>PCP&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="OXY" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("OXY", $fair)?'checked':''?>>OXY&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="TCA" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("TCA", $fair)?'checked':''?>>TCA&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="THC" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("THC", $fair)?'checked':''?>>THC&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="MDMA" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("MDMA", $fair)?'checked':''?>>MDMA &nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="PPX" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("PPX", $fair)?'checked':''?>>PPX&nbsp;&nbsp;
                                <input type="checkbox" class="fair faint_for" value="BUP" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("BUP", $fair)?'checked':''?>>BUP&nbsp;&nbsp;
                                <input type="hidden" name="fair" id="fair">
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="fentanyl" value="fentanyl" <?php echo isset($doctor_note['fentanyl']) &&$doctor_note['fentanyl']=='fentanyl'?'checked':'';?>> Fentanyl: </td>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="alcohol" value="alcohol" <?php echo isset($doctor_note['alcohol']) &&$doctor_note['alcohol']=='alcohol'?'checked':'';?>>Alcohol: </td>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="breathalyzer" value="Breathalyzer" <?php echo isset($doctor_note['breathalyzer']) &&$doctor_note['breathalyzer']=='breathalyzer'?'checked':'';?>>Breathalyzer:</td>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="other" value="other" <?php echo isset($doctor_note['other']) &&$doctor_note['other']=='other'?'checked':'';?>>other:</td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <th colspan="3">Notes: Quantitative results will be reviewed when available.  </th>
                        </tr>
                        <tr style="background-color:black;color:white;">
                                <th style="text-align:center;padding:3px;" colspan='3'>Assessment</th>
                        </tr>
                        <tr>
                            <th style="border:none;">Plan:</th>
                        </tr>
                        <tr>
                            <th style="border:none;">☒ See “Medication List” at front of Patient Record</th>
                        </tr>
                        <tr>
                            <td colspan='3'>      1. Continue following medications: &nbsp; <input type="text" name="assesement1" value="<?php echo $doctor_note['assesement1']??'';?>"></td>
                        </tr>
                        <tr>
                            <td colspan='3'>      2.Discontinue following medications: N/A &nbsp; <input type="text" name="assesement2" value="<?php echo $doctor_note['assesement2']??'';?>"> </td>
                        </tr>
                        <tr>
                            <td colspan='3'>      3.Initiate following medications/ Rx’s written for: N/A &nbsp;  <input type="text" name="assesement3" value="<?php echo $doctor_note['assesement3']??'';?>"></td>
                        </tr>
                        <tr style="background-color:black;color:white;">
                                <th style="text-align:center;padding:3px;" colspan='3'>Education</th>
                        </tr>
                    </table>
                        <div contentEditable="true" class="text_edit"> <?php echo $doctor_note['text3']??"
                             I have discussed with the patient the dose, schedule, risk, and benefits of taking and not taking: (current medications). I have also discussed the potential interactions of the medication prescribed if combined with alcohol or non-prescription drugs, the potential heart related problems, the possibility of agitation, the possibility of falling, the possibility of suicidal thoughts and the risks related to pregnancy. The patient understood the discussion and consented to the treatment. A Medication Education Sheet was provided. A “No Loss” policy was discussed as was the need to choose one pharmacy for all medications. The Patient consented to a random “pill counts and toxicology screens.”"?>
                        </div><input type="hidden" name="text3" id="text3">
                    <table style="width:100%;" border='1' cellpadding="10" cellspacing="0">
                        <tr>
                            <td style="width:50%">M.D. Signature/ Degree
                            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                            <input type="hidden" name="signature1"  id="signature1" value="<?php echo $doctor_note['signature1']??''; ?>">
                            <img src='' class="img" id="img_signature1" style="display:none;width:50%;height:100px;" >
                            </td>
                            <td style="width:50%" colspan='2'>Date/ Time<input type='datetime-local' name="date_time1" value="<?php echo $doctor_note['date_time1']??''; ?>"></td>
                        </tr>
                        <tr>
                            <td style="width:50%">Doctor’s Intern<input type="text" name="doctor_intern" value="<?php echo $doctor_note['doctor_intern']??''; ?>"></td>
                            <td style="width:50%" colspan='2'>Date/ Time<input type='datetime-local' name="date_time2" value="<?php echo $doctor_note['date_time2']??''; ?>"></td>
                        </tr>
                    </table>
                        <div class="form-group" style="margin-top:20px;">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary btn-save" onclick="save()"><?php echo xlt('Save'); ?></button>
                                <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                            </div>
                        </div>
                    </form>
                </div>
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

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
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

    $(function(){
        $('.result').each(function(){
            var id = $(this).attr('data-id');
            if ($('#'+id).is(':checked')) {
                $('.'+id).removeAttr('disabled');
            }
            else{
                $('.'+id).prop('disabled','true');
            }

        })

    })
$('.radio-checkbox').change(function ()
{
    var radioclass = $(this).attr('data-id');
    if($(this).is(':checked')){
        $("."+radioclass).prop('checked',false)
    $(this).prop('checked',true);
    $('#hidden_'+radioclass).val($(this).val());
    }
    else{
        $('#hidden_'+radioclass).val('');
    }

    //alert($('#'+radioclass).val());

});

$('.result').change(function(){
    var id = $(this).attr('data-id');

    var mainradio = $(this).attr('data-id');
    if($(this).is(":checked",true))
    {
        $('.'+id).removeAttr('disabled');

    }
    else{

        $('.'+id).prop('checked',false);
        $('.'+id).prop('disabled','true');
    }

});
function save(){
    var review_array =[];
    var thoughts_content =[];
    var speech_array=[];
    var thought_process =[];
    var thought_assc = [];
    var nallucinations =[];
    var dis_symptoms =[];
    $('.review_system:checked').each(function(){
        review_array.push($(this).val());
    });
    $("#review_system").val(review_array);

    $('.thoughts_content:checked').each(function(){
        thoughts_content.push($(this).val());
    });
    $("#thoughts_content").val(thoughts_content);

    $('.speech:checked').each(function(){
        speech_array.push($(this).val());
    });
    $("#speech").val(speech_array);
    $('.thought_process:checked').each(function(){
        thought_process.push($(this).val());
    });
    $("#thought_process").val(thought_process);

    $('.thought_assc:checked').each(function(){
        thought_assc.push($(this).val());
    });
    $("#thought_assc").val(thought_assc);

    $('.nallucinations:checked').each(function(){
        nallucinations.push($(this).val());
    });
    $("#nallucinations").val(nallucinations);

    $('.dis_symptoms:checked').each(function(){
        dis_symptoms.push($(this).val());
    });
    $("#dis_symptoms").val(dis_symptoms);
    var mood =[];
    $('.mood:checked').each(function(){
        mood.push($(this).val());
    });
    $("#mood").val(mood);

    var positive =[];
    $('.positive:checked').each(function(){
        positive.push($(this).val());
    });
    $("#positive").val(positive);

    var fair =[];
    $('.fair:checked').each(function(){
        fair.push($(this).val());
    });
    $("#fair").val(fair);

    $('.text_edit').each(function(){
        //alert();
        var dataval = $(this).html();
        $(this).next("input").val(dataval); 
        $errocount = 0;
        if($errocount==0)
        {
            $('#my_form').submit();

        }      
    });
}
</script>
