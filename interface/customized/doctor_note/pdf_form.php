<?php
// ini_set("display_errors", 1);

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");


require_once("$srcdir/api.inc");

require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;


$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$doctor_note = $formid ? formFetch("form_doctor_note", $formid) : array();

use OpenEMR\Core\Header;
// $mpdf = new mPDF('utf-8','A5-P',8, 10,10,10, 75, 30, 4, 10);
$mpdf = new mPDF();
?>
    <body id='body' class='body'>
        <?php

        ob_start();
        ?>
        <br />
        <div style="text-align:center;"><center><b>Center of Network Theraphy<br> 81 north filed avenue weset orange<br> NJ 07052<br> (973) 731 1375</div>
        <table  style="width:100%;" border='1' cellpadding="10" cellspacing="0">
                            <tr style="background-color:black;color:white;">
                                <th style="text-align:center;padding:3px;color:white;" colspan='3'>Basic Information</th>
                            </tr>
                            <tr>
                                <th style="width:60% padding:3px;">Patient name:<?php echo $doctor_note['patient_name']??''; ?></th>
                                <th style="padding:3px;">Date: <?php echo $doctor_note['date1']??''; ?></th>
                                <th style="padding:3px;">Time:<?php echo $doctor_note['time1']??''; ?></th>
                            </tr>
                            <tr>
                                <th style="border:none" colspan='3' >Current medications:<?php echo $doctor_note['current_medication']??''; ?></th>

                            </tr>
                            <tr>
                                <th style="border:none" colspan='3'>
                                Outside Prescriber:<?php echo $doctor_note['outside_prescriber']??''; ?></th>
                            </tr>
                            <tr>
                                <th style="border-top:none:border-right:none;border-left:none;" colspan='3' >
                                COVID-19 RISK ASSESSMENT (date) upon arrival patient scored a (0). Low risk: Patient was educated on hydration handwashing and droplet precautions.  Patient will be observed and evaluated for risk daily upon arrival to CNT.
                                </th>

                            </tr>
                            <tr>
                                <th style="border:none">Compliant with current medications:</th>
                                <th style="border:none"><input type="radio" value="yes" name="complain_medication" <?php echo isset($doctor_note['complain_medication']) &&$doctor_note['complain_medication']=='yes'?'checked=checked':'';?>>yes</th>
                                <th style="border:none"> <input type="radio" value='no' name="complain_medication" <?php echo isset($doctor_note['complain_medication']) &&$doctor_note['complain_medication']=='no'?'checked=checked':'';?> >no</th>
                            </tr>
                            <tr>
                                <th style="60%">Blood pressure: <?php echo $doctor_note['blood_pressure']??''; ?></th>
                                <th colspan='2'>Heart rate: <?php echo $doctor_note['heart_rate']??''; ?></th>
                            </tr>
                            <tr style="background-color:black;">
                                <th style="text-align:center;padding:3px;color:white;" colspan='3'>Patient Update</th>
                            </tr>
                            <tr>
                                <td  colspan='3'><b>Update:
                                <?php echo $doctor_note['text1']??"
                                </b> The patient was seen, c/o withdrawal symptoms attached.  Patient was seen and their COVID-19 Risk Assessment is currently no risk (0). Patient was educated on hydration, handwashing and droplet precautions. Patient will be observed and evaluated for risk daily upon arrival to CNT. Patient was seen today, c/o attached symptoms. Patient stated xx.” Patient reports (craving intensity: i.e none, mild, moderate or severe cravings) at this time. Will follow up. Patient exhibits the following withdrawal symptoms such as (list applicable withdrawal symptoms) as well as the indicated symptoms on the attached withdrawal symptom checklist. Psychiatrically, the patient reports (list current emotional states and their intensity on scale 1-10, i.e. anxiety, sadness, fearfulness and irritability) at this time.  Will follow up.  Patient has reported a diagnosis of (psychiatric diagnoses). Will follow up. Medically, the patient presents with (list biomedical conditions).  Will follow up. Therapy and medical supervision are sufficient to help deal with her stressors at this moment through group and individual therapy sessions. The patient does not present with signs or symptoms of (SI/HI/VH/AH). Patient was counseled to be active in group therapy and to address active stressors with therapists in both groups and individual sessions. Patient was counseled for compliance of medications, DUI/DWI, Risky behavior to prevent relapse if necessary rush to the nearest ER and/or call 911 after hours."?>
                                <br>
                                12 Step Program: <input type="checkbox" class="radio-checkbox" name="step_program" data-id='step_program' value="daily" <?php echo isset($doctor_note['step_program']) &&$doctor_note['step_program']=='daily'?'checked=checked':'';?>>attending daily
                                <input type="checkbox" class="radio-checkbox" value="weekly" name="step_program" data-id='step_program' <?php echo isset($doctor_note['step_program']) &&$doctor_note['step_program']=='weekly'?'checked=checked':'';?>>2-3 days weekly

                                <br>
                                Sponsor: <input type="checkbox" class="radio-checkbox sponser" data-id='sponser' value="yes" <?php echo isset($doctor_note['sponser']) &&$doctor_note['sponser']=='yes'?'checked=checked':'';?>>yes
                                <input type="checkbox" class="radio-checkbox" data-id='sponser' name="sponser" value="no" <?php echo isset($doctor_note['sponser']) &&$doctor_note['sponser']=='yes'?'no':'';?>>no
                                <input type="checkbox" class="radio-checkbox" data-id='sponser' name="sponser"  value="recommended" <?php echo isset($doctor_note['sponser']) &&$doctor_note['sponser']=='recommended'?'checked=checked':'';?>>Recommended

                                <br>
                                <?php echo $doctor_note['text2']??"
                                Discussed medication options with patient including maintenance medications.<br>
                                Patient is in the (stage of change) stage of change.<br>
                                Patient is stable to return home after last dose of medication."?><br>

                            </td>
                            </tr>
                            <tr style="background-color:black;">
                                <th style="text-align:center;padding:3px;color:white;" colspan='3'>Review of Systems</th>
                            </tr>
                            <tr>
                                <td colspan="3" style="border:none;">
                                    <!-- <table style="width:100%"> -->
                                    <?php
                                    $review_system=explode(',',$doctor_note['review_system']);
                                    ?>
                                    <!-- <tr> -->
                                        <input type="checkbox"  value="constitutional" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("constitutional", $review_system)?'checked=checked':''?>>constitutional&nbsp;&nbsp;
                                        <input type="checkbox"  value="eye" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("eye", $review_system)?'checked=checked':''?>>eye&nbsp;&nbsp;
                                        <input type="checkbox"  value="ent" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("ent", $review_system)?'checked=checked':''?>> ENT&nbsp;&nbsp;
                                        <input type="checkbox"  value="Cardiovascular" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Cardiovascular", $review_system)?'checked=checked':''?>>Cardiovascular&nbsp;&nbsp;
                                        <input type="checkbox" value="Pulmonary" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Pulmonary", $review_system)?'checked=checked':''?>>Pulmonary&nbsp;&nbsp;
                                        <input type="checkbox"   value="Gastrointestinal" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Gastrointestinal", $review_system)?'checked=checked':''?>>Gastrointestinal&nbsp;&nbsp;
                                </td>
                            </tr>
                            <tr>
                                        <td style="border:none;" colspan="3"><input type="checkbox" value="Genitourinary" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Genitourinary", $review_system)?'checked=checked':''?>>Genitourinary&nbsp;&nbsp;
                                        <input type="checkbox" value="Musculoskeletal" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Musculoskeletal", $review_system)?'checked=checked':''?>>Musculoskeletal&nbsp;&nbsp;
                                        <input type="checkbox" value="Neurological" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Neurological", $review_system)?'checked=checked':''?>>Neurological &nbsp;&nbsp;
                                        <input type="checkbox" value="psychological" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("psychological", $review_system)?'checked=checked':''?>>psychological&nbsp;&nbsp;
                                    </tr>
                                    <tr>
                                    <td style="border-top:none:border-right:none;border-left:none;"  colspan="3"><input type="checkbox" value="Endocrine" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Endocrine", $review_system)?'checked=checked':''?>>Endocrine&nbsp;&nbsp;
                                        <input type="checkbox" value="hema" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("hema", $review_system)?'checked=checked':''?>>Hema&nbsp;&nbsp;
                                        <input type="checkbox" value="Lymphatic" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Lymphatic", $review_system)?'checked=checked':''?>>Lymphatic&nbsp;&nbsp;
                                        <input type="checkbox" value="Immune" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("Immune", $review_system)?'checked=checked':''?>>Immune&nbsp;&nbsp;
                                         <input type="checkbox" value="all" class="checkvalue review_system" data-id='review_system' <?php echo isset($doctor_note['review_system'])&& in_array("all", $review_system)?'checked=checked':''?>>all&nbsp;&nbsp;

                                    </tr>


                            </tr>
                            <tr style="background-color:black;">
                                <th style="text-align:center;padding:3px;color:white;" colspan='3'>Mental Status Exam</th>
                            </tr>
                            <tr>
                                <?php
                                $mental_appearance = explode(',',$doctor_note['mental_appearance']);
                                ?>
                                <td style="border:none;" colspan="3"><b>Appearance</b>
                                <input type="checkbox" class="radio-checkbox mental_appearance" data-id='mental_appearance' value="appropriate" <?php echo isset($doctor_note['mental_appearance'])&& $doctor_note['mental_appearance']=='appropriate'?'checked=checked':''?>>appropriate &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox mental_appearance" data-id='mental_appearance' value="disheveled" <?php echo isset($doctor_note['mental_appearance'])&& $doctor_note['mental_appearance']=="disheveled"?'checked=checked':''?>>disheveled &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox mental_appearance" data-id='mental_appearance' value="bizarre" <?php echo isset($doctor_note['mental_appearance'])&& $doctor_note['mental_appearance']=="bizarre"?'checked=checked':''?>>bizarre &nbsp;&nbsp;&nbsp;
                                <input type="hidden" id="mental_appearance" name='mental_appearance'>
                                <br>
                                Describe:<?php echo $doctor_note['mental_decribe']??''; ?></td>

                            </tr>
                            <tr>
                                <td style="border-right:none;border-left:none;border-bottom:none" colspan="3">
                                <div style="display:flex;"><b>Musculoskeletal: </b><br>

                                <div style="margin: 0px 183px"><b>Strength/ Tone: </b>
                                <input type="checkbox" class="radio-checkbox musculo_stregth" data-id='musculo_stregth' name='strength' value="normal" <?php echo isset($doctor_note['strength']) &&$doctor_note['strength']=='normal'?'checked=checked':'';?> >normal &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox musculo_stregth" data-id='musculo_stregth'  name='strength' value="abnormal" <?php echo isset($doctor_note['strength']) &&$doctor_note['strength']=='abnormal'?'checked=checked':'';?>>abnormal</div>
                                <div><b>Gait/Station </b><input type="checkbox" class="radio-checkbox gain_station" data-id='gain_station' name="gain_station" value="normal" <?php echo isset($doctor_note['gain_station']) &&$doctor_note['gain_station']=='normal'?'checked=checked':'';?>>normal
                                <input type="checkbox"  class="radio-checkbox gain_station" data-id='gain_station' name="gain_station" value="abnormal" <?php echo isset($doctor_note['gain_station']) &&$doctor_note['gain_station']=='abnormal'?'checked=checked':'';?>>abnormal
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
                                <input type="checkbox" class="speech"  value="normal" <?php echo isset($doctor_note['speech'])&& in_array("normal", $speech)?'checked=checked':''?>>normal &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="hyperactive"  <?php echo isset($doctor_note['speech'])&& in_array("hyperactive", $speech)?'checked=checked':''?>>hyperactive&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="retardation" <?php echo isset($doctor_note['speech'])&& in_array("retardation", $speech)?'checked=checked':''?>>retardation      &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="abnormal" <?php echo isset($doctor_note['speech'])&& in_array("abnormal", $speech)?'checked=checked':''?>>abnormal movements<br>
                                <input type="checkbox" class="speech" value="Slurred" <?php echo isset($doctor_note['speech'])&& in_array("Slurred", $speech)?'checked=checked':''?>>Slurred&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="Orobuccal" <?php echo isset($doctor_note['speech'])&& in_array("Orobuccal", $speech)?'checked=checked':''?>>Orobuccal Movement        &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="Pressured" <?php echo isset($doctor_note['speech'])&& in_array("Pressured", $speech)?'checked=checked':''?>>Pressured
                                <input type="checkbox" class="speech" value="Loud" <?php echo isset($doctor_note['speech'])&& in_array("Loud", $speech)?'checked=checked':''?>>Loud&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="speech" value="Monotonous" <?php echo isset($doctor_note['speech'])&& in_array("Monotonous", $speech)?'checked=checked':''?>>Monotonous <br>
                                <input type="checkbox" class="speech" value="Tremulous" <?php echo isset($doctor_note['speech'])&& in_array("Tremulous", $speech)?'checked=checked':''?>>Tremulous
                                <input type="hidden" id="speech" name="speech">
                                </td>

                            </tr>
                            <tr>
                                <td colspan="3" style="border:none;"> Describe:<b> Patients speech was of regular rhythm, volume and flow. </b>
                                <textarea class="form-control" name="speech_decribe"><?php echo $doctor_note['speech_decribe']??''; ?></textarea></td>
                            </tr>

                            <tr>
                            <?php
                            $thoughts_content = explode(',',$doctor_note['thoughts_content']);
                            ?>
                            <td style="border-right:none;border-left:none;border-bottom:none"  colspan="4"><b>Thoughts Content:</b>
                            <input type="checkbox" class="thoughts_content" value="none" <?php echo isset($doctor_note['thoughts_content'])&& in_array("none", $thoughts_content)?'checked=checked':''?>>none&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="delusions" <?php echo isset($doctor_note['thoughts_content'])&& in_array("delusions", $thoughts_content)?'checked=checked':''?>>delusions      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="overvalued" <?php echo isset($doctor_note['thoughts_content'])&& in_array("overvalued", $thoughts_content)?'checked=checked':''?>>overvalued ideas &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Preoccupations" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Preoccupations", $thoughts_content)?'checked=checked':''?>>Preoccupations&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="depressive" <?php echo isset($doctor_note['thoughts_content'])&& in_array("depressive", $thoughts_content)?'checked=checked':''?>>depressive thoughts&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="self" <?php echo isset($doctor_note['thoughts_content'])&& in_array("self", $thoughts_content)?'checked=checked':''?>>self-harm &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Suicidal" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Suicidal", $thoughts_content)?'checked=checked':''?>>Suicidal Ideations    &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Aggressive" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Aggressive", $thoughts_content)?'checked=checked':''?>>Aggressive or Homicidal Ideations&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Obsessions" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Obsessions", $thoughts_content)?'checked=checked':''?>>Obsessions &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thoughts_content" value="Anxiety" <?php echo isset($doctor_note['thoughts_content'])&& in_array("Anxiety", $thoughts_content)?'checked=checked':''?>>Anxiety
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
                            <input type="checkbox" class="thought_process" value="coherent" <?php echo isset($doctor_note['thought_process'])&& in_array("coherent", $thought_process)?'checked=checked':''?>>coherent      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="soft" <?php echo isset($doctor_note['thought_process'])&& in_array("soft", $thought_process)?'checked=checked':''?>>soft            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="loose" <?php echo isset($doctor_note['thought_process'])&& in_array("loose", $thought_process)?'checked=checked':''?>>loose associations        &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="flight-idea" <?php echo isset($doctor_note['thought_process'])&& in_array("flight-idea", $thought_process)?'checked=checked':''?>>flight of ideas&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="tangential" <?php echo isset($doctor_note['thought_process'])&& in_array("tangential", $thought_process)?'checked=checked':''?>>Tangential thinking          &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="nonsence_words" <?php echo isset($doctor_note['thought_process'])&& in_array("nonsence_words", $thought_process)?'checked=checked':''?>>Nonsense words/Word Salad    &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="thoght_block" <?php echo isset($doctor_note['thought_process'])&& in_array("thoght_block", $thought_process)?'checked=checked':''?>>Thought Blocking      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="thought_process" value="thoght_race" <?php echo isset($doctor_note['thought_process'])&& in_array("thoght_race", $thought_process)?'checked=checked':''?>>Thought racing&nbsp;&nbsp;&nbsp;
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
                            <input type="checkbox" class="thought_assc" value="intact" <?php echo isset($doctor_note['thought_assc'])&& in_array("intact", $thought_assc)?'checked=checked':''?>>intact            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox"  class="thought_assc" value="circumstantial" <?php echo isset($doctor_note['thought_assc'])&& in_array("circumstantial", $thought_assc)?'checked=checked':''?>>circumstantial                  &nbsp;&nbsp;&nbsp;
                            <input type="checkbox"  class="thought_assc" value="tangential" <?php echo isset($doctor_note['thought_assc'])&& in_array("tangential", $thought_assc)?'checked=checked':''?>>tangential              &nbsp;&nbsp;&nbsp;
                            <input type="checkbox"  class="thought_assc" value="loose" <?php echo isset($doctor_note['thought_assc'])&& in_array("loose", $thought_assc)?'checked=checked':''?>>loose&nbsp;&nbsp;&nbsp;
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
                            <input type="checkbox" class="dis_symptoms" value="Derealizations" <?php echo isset($doctor_note['dis_symptoms'])&& in_array("Derealizations", $dis_symptoms)?'checked=checked':''?>>Derealizations               &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="dis_symptoms" value="Depersonalization" <?php echo isset($doctor_note['dis_symptoms'])&& in_array("Depersonalization", $dis_symptoms)?'checked=checked':''?>>Depersonalization &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="dis_symptoms" value="Illusions"  <?php echo isset($doctor_note['dis_symptoms'])&& in_array("Depersonalization", $dis_symptoms)?'checked=checked':''?>>Illusions <br>
                            <input type="hidden" name="dis_symptoms" id="dis_symptoms">
                            <b>Hallucinations:     </b>             &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="nallucinations" value="Visual"  <?php echo isset($doctor_note['nallucinations'])&& in_array("Visual", $nallucinations)?'checked=checked':''?>>Visual &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="nallucinations" value="Tactile" <?php echo isset($doctor_note['nallucinations'])&& in_array("Tactile", $nallucinations)?'checked=checked':''?>>Tactile    &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="nallucinations" value="Auditory" <?php echo isset($doctor_note['nallucinations'])&& in_array("Auditory", $nallucinations)?'checked=checked':''?>>Auditory      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="nallucinations" value="Command" <?php echo isset($doctor_note['nallucinations'])&& in_array("Command", $nallucinations)?'checked=checked':''?>>Command
                            <input type="hidden" name="nallucinations" id="nallucinations">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="Perception_descibe"><?php echo $doctor_note['Perception_descibe']??''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td style="border-right:none;border-left:none;border-bottom:none;width:50%"  ><b>Judgment</b>
                            <input type="checkbox" class="radio-checkbox judgement" data-id="judgement" name="judgement" value="poor" <?php echo isset($doctor_note['judgement']) &&$doctor_note['judgement']=='poor'?'checked=checked':'';?>>poor       &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox judgement" data-id="judgement" name="judgement" value="fair" <?php echo isset($doctor_note['judgement']) &&$doctor_note['judgement']=='fair'?'checked=checked':'';?>>fair &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox judgement" data-id="judgement" name="judgement" value="good" <?php echo isset($doctor_note['judgement']) &&$doctor_note['judgement']=='good'?'checked=checked':'';?>>good &nbsp;&nbsp;&nbsp;
                            </td>
                            <td style="border-right:none;border-left:none;border-bottom:none;width:50%" colspan="2" >
                                <b>Insight </b>
                                <input type="checkbox" class="radio-checkbox insight" data-id='insight' name="insight" value="minimal" <?php echo isset($doctor_note['insight']) &&$doctor_note['insight']=='minimal'?'checked=checked':'';?>>minimal              &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox insight" data-id='insight' name="insight" value="moderate" <?php echo isset($doctor_note['insight']) &&$doctor_note['insight']=='moderate'?'checked=checked':'';?>>moderate       &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox insight" data-id='insight' name="insight" value="good" <?php echo isset($doctor_note['insight']) &&$doctor_note['insight']=='good'?'checked=checked':'';?>>good &nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="insight_describe"><?php echo $doctor_note['insight_describe']??''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td style="width:100%;border-right:none;border-left:none;border-bottom:none;" colspan="3">
                                <b>Orientation:</b>
                                <input type="checkbox" class="radio-checkbox orintation" data-id='orintation' name="orintation" value="time" <?php echo isset($doctor_note['orintation']) &&$doctor_note['orintation']=='time'?'checked=checked':'';?>>time&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox orintation" data-id='orintation' name="orintation" value="person" <?php echo isset($doctor_note['orintation']) &&$doctor_note['orintation']=='person'?'checked=checked':'';?>>person &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox orintation" data-id='orintation' name="orintation"  value="place" <?php echo isset($doctor_note['orintation']) &&$doctor_note['orintation']=='place'?'checked=checked':'';?>>place &nbsp;&nbsp;&nbsp;
                                <br>
                                <b>Attention Span/ Concentration</b>
                                <input type="checkbox" class="radio-checkbox attenstion" name="attension" data-id='attension' value="intact" <?php echo isset($doctor_note['attension']) &&$doctor_note['attension']=='intact'?'checked=checked':'';?>>intact&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox attenstion" name="attension" data-id='attension' value="impaired" <?php echo isset($doctor_note['attension']) &&$doctor_note['attension']=='impaired'?'checked=checked':'';?>>impaired &nbsp;&nbsp;&nbsp;
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
                            <input type="checkbox" class="radio-checkbox recent" data-id="recent" name="recent" value="intent" <?php echo isset($doctor_note['recent']) &&$doctor_note['recent']=='intact'?'checked=checked':'';?>>intent       &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox recent" data-id="recent" name="recent" value="impaired" <?php echo isset($doctor_note['recent']) &&$doctor_note['recent']=='impaired'?'checked=checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox recent" data-id="recent" name="recent" value="digits" <?php echo isset($doctor_note['recent']) &&$doctor_note['recent']=='digits'?'checked=checked':'';?>>digits forward          &nbsp;&nbsp;&nbsp;
                            </td>
                            <td style="border-right:none;border-left:none;border-bottom:none;width:50%" colspan="2" >
                                <b>Remote</b>
                                <input type="checkbox" class="radio-checkbox remote" data-id="remote" name="remote" value="intact" <?php echo isset($doctor_note['remote']) &&$doctor_note['remote']=='intact'?'checked=checked':'';?>>intact&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="radio-checkbox remote" data-id="remote" name="remote" value="impaired" <?php echo isset($doctor_note['remote']) &&$doctor_note['remote']=='impaired'?'checked=checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;

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
                            <input type="checkbox" class="radio-checkbox object" name="lang_object" data-id='langugae' value="intact" <?php echo isset($doctor_note['lang_object']) &&$doctor_note['lang_object']=='intact'?'checked=checked':'';?>>intact                   &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox object" name="lang_object" data-id='langugae' value="impaired" <?php echo isset($doctor_note['lang_object']) &&$doctor_note['lang_object']=='impaired'?'checked=checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                            <br>
                            <b>Repeat phrases  </b>
                            <input type="checkbox" class="radio-checkbox phrase" data-id='phrase' name='phrase' value='intact' <?php echo isset($doctor_note['phrase']) &&$doctor_note['phrase']=='intact'?'checked=checked':'';?>>intact                   &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox phrase" data-id='phrase' name='phrase' value='impaired'<?php echo isset($doctor_note['phrase']) &&$doctor_note['phrase']=='impaired'?'checked=checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                        </tr>
                        <tr>
                        <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" nmae="langugae_describe"><?php echo $doctor_note['langugae_describe']??''; ?></textarea></td>
                        </tr>

                        <tr>
                            <td style="border-right:none;border-left:none;border-bottom:none;" colspan="3"><b>Knowledge</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!-- <td style="border-right:none;border-left:none;border-bottom:none;" colspan="3" > -->
                            <b>Current Events  </b>
                            <input type="checkbox" class="radio-checkbox knowledge" data-id='knowledge' name='knowledge' value='intact' <?php echo isset($doctor_note['knowledge']) &&$doctor_note['knowledge']=='intact'?'checked=checked':'';?>>intact                   &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox knowledge" data-id='knowledge' name='knowledge' value='impaired' <?php echo isset($doctor_note['knowledge']) &&$doctor_note['knowledge']=='impaired'?'checked=checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>Past History  </b>
                            <input type="checkbox" class="radio-checkbox past_history" name="past_history" data-id='past_history' value="intact" <?php echo isset($doctor_note['past_history']) &&$doctor_note['past_history']=='intact'?'checked=checked':'';?>>intact                   &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox past_history" name="past_history" data-id='past_history' value="impaired" <?php echo isset($doctor_note['past_history']) &&$doctor_note['past_history']=='impaired'?'checked=checked':'';?>>impaired       &nbsp;&nbsp;&nbsp;
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
                            <input type="checkbox" class="mood" value="euthymic" <?php echo isset($doctor_note['mood'])&& in_array("euthymic", $mood)?'checked=checked':''?>>euthymic&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="depressed" <?php echo isset($doctor_note['mood'])&& in_array("depressed", $mood)?'checked=checked':''?>>depressed      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="hypomanic" <?php echo isset($doctor_note['mood'])&& in_array("hypomanic", $mood)?'checked=checked':''?>>hypomanic      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="euphoric" <?php echo isset($doctor_note['mood'])&& in_array("euphoric", $mood)?'checked=checked':''?>>euphoric      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="angry" <?php echo isset($doctor_note['mood'])&& in_array("angry", $mood)?'checked=checked':''?>>angry      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="anxious" <?php echo isset($doctor_note['mood'])&& in_array("anxious", $mood)?'checked=checked':''?>>anxious      &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="mood" value="labile" <?php echo isset($doctor_note['mood'])&& in_array("labile", $mood)?'checked=checked':''?>>labile&nbsp;&nbsp;&nbsp;
                            <input type="hidden" id="mood" name="mood">

                            </td>

                        </tr>
                        <tr>
                        <td colspan="3" style="border:none;"> Describe:
                            <textarea class="form-control" name="mood_descibe"><?php echo $doctor_note['mood_descibe']??''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan='3'><b>Affect:</b>&nbsp;&nbsp;&nbsp;<b>Appropriateness</b>
                            <input type="checkbox" class="radio-checkbox appropriateness" data-id="appropriateness" name="appropriateness" value="appropriate" <?php echo isset($doctor_note['appropriateness']) &&$doctor_note['appropriateness']=='appropriate'?'checked=checked':'';?>>appropriate&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox appropriateness" data-id="appropriateness" name="appropriateness" value="inappropriate" <?php echo isset($doctor_note['appropriateness']) &&$doctor_note['appropriateness']=='inappropriate'?'checked=checked':'';?>>inappropriate&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox appropriateness" data-id="appropriateness" name="appropriateness" value="incongruous" <?php echo isset($doctor_note['appropriateness']) &&$doctor_note['appropriateness']=='incongruous'?'checked=checked':'';?>>incongruous&nbsp;&nbsp;&nbsp;
                            <br>
                            <div style="margin-left: 62px;">
                            <b>Range</b>
                            <input type="checkbox" class="radio-checkbox range" data-id='range' name="range1" value='blunted' <?php echo isset($doctor_note['range1']) &&$doctor_note['range1']=='blunted'?'checked=checked':'';?>>blunted &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox range" data-id='range' name="range1" value='restricted' <?php echo isset($doctor_note['range1']) &&$doctor_note['range1']=='restricted'?'checked=checked':'';?>>restricted  &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox range" data-id='range' name="range1" value='flat' <?php echo isset($doctor_note['range1']) &&$doctor_note['range1']=='flat'?'checked=checked':'';?>>flat&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox range" data-id='range' name="range1" value='Broad' <?php echo isset($doctor_note['range1']) &&$doctor_note['range1']=='Broad'?'checked=checked':'';?>>Broad
                            </div>
                            <div style="margin-left: 62px;">
                            <b>Stability</b>
                            <input type="checkbox" class="radio-checkbox stability" data-id='stability' name="stability" value='stable' <?php echo isset($doctor_note['stability']) &&$doctor_note['stability']=='stable'?'checked=checked':'';?>>stable  &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="radio-checkbox stability" data-id='stability' name="stability" value='Labile' <?php echo isset($doctor_note['stability']) &&$doctor_note['stability']=='Labile'?'checked=checked':'';?>>Labile  &nbsp;&nbsp;&nbsp;
                            </div>
                        </td>
                        </tr>
                        <tr style="background-color:black;">
                                <th style="text-align:center;padding:3px;color:white;" colspan='3'>Urine Toxicology</th>
                        </tr>
                        <tr>
                            <th>date: <?php echo $doctor_note['urine_date']??'';?></th>
                            <td><input type="checkbox" class="radio-checkbox toxocology" name="toxocology" data-id="toxocology" value="onsite" <?php echo isset($doctor_note['toxocology']) &&$doctor_note['toxocology']=='onsite'?'checked=checked':'';?>> onsite</td>
                            <td><input type="checkbox" class="radio-checkbox toxocology" name="toxocology" data-id="toxocology" value="overnight" <?php echo isset($doctor_note['toxocology']) &&$doctor_note['toxocology']=='overnight'?'checked=checked':'';?>> overnight</td>
                        </tr>
                        <tr >
                            <th style="border:none">Results: </th>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="negative" <?php echo isset($doctor_note['negative']) &&$doctor_note['negative']=='yes'?'checked=checked':'';?> value="yes">negative for all</td>
                        </tr>
                        <tr>
                            <?php
                             $positive  = explode(',',$doctor_note['positive']);
                            ?>
                            <td style="border:none" colspan="3"><input type="checkbox" name="postive_for" class="result" data-id="positive_for" value="yes" <?php echo isset($doctor_note['postive_for']) &&$doctor_note['postive_for']=='yes'?'checked=checked':'';?>>positive, for:
                                <input type="checkbox" class="positive positive_for" value="AMP" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("AMP", $positive)?'checked=checked':''?>>AMP&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="BAR" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("BAR", $positive)?'checked=checked':''?>>BAR&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="BZO" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("BZO", $positive)?'checked=checked':''?>>BZO&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="COC" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("COC", $positive)?'checked=checked':''?>>COC&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="OPI" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("OPI", $positive)?'checked=checked':''?>>OPI/MOP&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="MTD" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("MTD", $positive)?'checked=checked':''?>>MTD&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="MET" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("MET", $positive)?'checked=checked':''?>>MET&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="PCP" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("PCP", $positive)?'checked=checked':''?>>PCP&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="OXY" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("OXY", $positive)?'checked=checked':''?>>OXY&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="TCA" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("TCA", $positive)?'checked=checked':''?>>TCA&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="THC" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("TCA", $positive)?'checked=checked':''?>>THC&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="MDMA" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("MDMA", $positive)?'checked=checked':''?>>MDMA &nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="PPX" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("PPX", $positive)?'checked=checked':''?>>PPX&nbsp;&nbsp;
                                <input type="checkbox"  class="positive positive_for" value="BUP" <?php echo isset($doctor_note['positive'])&& $doctor_note['postive_for']=='yes' && in_array("BUP", $positive)?'checked=checked':''?>>BUP&nbsp;&nbsp;
                                <input type="hidden" name="positive" id="positive">
                            </td>
                        </tr>
                        <tr>
                            <?php
                             $fair = explode(',',$doctor_note['fair']);
                            ?>
                            <td style="border:none" colspan="3"><input type="checkbox" name="faint_for" class="result" data-id="faint_for" value="yes" <?php echo isset($doctor_note['faint_for']) &&$doctor_note['faint_for']=='yes'?'checked=checked':'';?>>faint, for:&nbsp;&nbsp;
                                <input type="checkbox" class="fair faint_for" value="AMP" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("AMP", $fair)?'checked=checked':''?>>AMP&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="BAR" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("BAR", $fair)?'checked=checked':''?>>BAR&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for"value="BZO" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("BZO", $fair)?'checked=checked':''?>>BZO&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="COC" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("COC", $fair)?'checked=checked':''?>>COC&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="OPI" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("OPI", $fair)?'checked=checked':''?>>OPI/MOP&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="MTD" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("MTD", $fair)?'checked=checked':''?>>MTD&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="MET" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("MET", $fair)?'checked=checked':''?>>MET&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="PCP" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("PCP", $fair)?'checked=checked':''?>>PCP&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="OXY" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("OXY", $fair)?'checked=checked':''?>>OXY&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="TCA" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("TCA", $fair)?'checked=checked':''?>>TCA&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="THC" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("THC", $fair)?'checked=checked':''?>>THC&nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="MDMA" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("MDMA", $fair)?'checked=checked':''?>>MDMA &nbsp;&nbsp;
                                <input type="checkbox"  class="fair faint_for" value="PPX" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("PPX", $fair)?'checked=checked':''?>>PPX&nbsp;&nbsp;
                                <input type="checkbox" class="fair faint_for" value="BUP" <?php echo isset($doctor_note['fair'])&& $doctor_note['faint_for']=='yes' && in_array("BUP", $fair)?'checked=checked':''?>>BUP&nbsp;&nbsp;
                                <input type="hidden" name="fair" id="fair">
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="fentanyl" value="fentanyl" <?php echo isset($doctor_note['fentanyl']) &&$doctor_note['fentanyl']=='fentanyl'?'checked=checked':'';?>> Fentanyl: </td>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="alcohol" value="alcohol" <?php echo isset($doctor_note['alcohol']) &&$doctor_note['alcohol']=='alcohol'?'checked=checked':'';?>>Alcohol: </td>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="breathalyzer" value="Breathalyzer" <?php echo isset($doctor_note['breathalyzer']) &&$doctor_note['breathalyzer']=='breathalyzer'?'checked=checked':'';?>>Breathalyzer:</td>
                        </tr>
                        <tr>
                            <td style="border:none"><input type="checkbox" name="other" value="other" <?php echo isset($doctor_note['other']) &&$doctor_note['other']=='other'?'checked=checked':'';?>>other:</td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <th colspan="3">Notes: Quantitative results will be reviewed when available.  </th>
                        </tr>
                        <tr style="background-color:black;">
                                <th style="text-align:center;padding:3px;color:white;" colspan='3'>Assessment</th>
                        </tr>
                        <tr>
                            <th style="border:none;">Plan:</th>
                        </tr>
                        <tr>
                            <th style="border:none;"> See “Medication List” at front of Patient Record</th>
                        </tr>
                        <tr>
                            <td colspan='3'>      1. Continue following medications: &nbsp;<?php echo $doctor_note['assesement1']??'';?></td>
                        </tr>
                        <tr>
                            <td colspan='3'>      2.Discontinue following medications: N/A &nbsp;<?php echo $doctor_note['assesement2']??'';?> </td>
                        </tr>
                        <tr>
                            <td colspan='3'>      3.Initiate following medications/ Rx’s written for: N/A &nbsp;<?php echo $doctor_note['assesement3']??'';?> </td>
                        </tr>
                        <tr style="background-color:black;">
                                <th style="text-align:center;padding:3px;color:white;" colspan='3'>Education</th>
                        </tr>
                        <tr>
                            <td colspan='3'>
                            <?php echo $doctor_note['text3']??"
                             I have discussed with the patient the dose, schedule, risk, and benefits of taking and not taking: (current medications). I have also discussed the potential interactions of the medication prescribed if combined with alcohol or non-prescription drugs, the potential heart related problems, the possibility of agitation, the possibility of falling, the possibility of suicidal thoughts and the risks related to pregnancy. The patient understood the discussion and consented to the treatment. A Medication Education Sheet was provided. A “No Loss” policy was discussed as was the need to choose one pharmacy for all medications. The Patient consented to a random “pill counts and toxicology screens.” "?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:50%">M.D. Signature/ Degree
                            <?php
                            if($doctor_note['signature1']!=''){
                                echo '<img src="'.$doctor_note['signature1'].'" style="width:50%;height:90px">';
                            }
                            ?>
                             </td>
                            <td style="width:50%" colspan='2'>Date/ Time<?php echo $doctor_note['date_time1']??''; ?></td>
                        </tr>
                        <tr>
                            <td style="width:50%">Doctor’s Intern <?php echo $doctor_note['doctor_intern']??''; ?></td>
                            <td style="width:50%" colspan='2'>Date/ Time <?php echo $doctor_note['date_time2']??''; ?></td>
                        </tr>
                    </table>






        <?php

        $html = ob_get_contents();
        ob_end_clean();
        // echo $html;die;

        $header ='<table style="width:100%;"><tr><td style="width:50%">patient name:'.$doctor_note['patient_name'].'</td><td style="width:50%;text-align:right;">date:'.$doctor_note['date1'].'</td></tr></table>';
        $mpdf->setTitle("Transitional Plan");
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->defaultfooterline = 0;
        $mpdf->setFooter("Page: {PAGENO} of {nb}");
        $mpdf->SetMargins(0,0,20);
        $mpdf->WriteHTML($html);

        //save the file put which location you need folder/filname
        $mpdf->Output("Transitional Plan.pdf", 'I');

        $mpdf->debug = true;
        //out put in browser below output function
        $mpdf->Output();
        ?>
    </body>
</html>

