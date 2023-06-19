<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/api.inc");
include_once("$srcdir/patient.inc");
//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");




$name = $_GET['formname'];
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);

$check_res= $formid ? formFetch("form_admission_note", $formid) : array();

    use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>


<style>
    h2{
        text-align:center;
    }
</style>
<body id='body' class='body'>
<?php
ob_start();
?>
<body>
<table  style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <th>
                        Center for Network Therapy<br>

                         81 Northfield Ave. Suite 104, West Orange, NJ 07052<br>
                         Tel:  973-731-1375<br>
                         Fax:  973-731-1374<br>

                        </th>
                        <th >
                           <b>Patient Name:</b> <?php echo text($check_res['pat_name1']);?> <br>
                           <b>DOB:</b> <?php echo $check_res['pat_dob1'] ?strstr($check_res['pat_dob1'], ' ', true): ''; ?> <br>
                           <b>Sexual Orientation :</b>   <?php echo text($check_res['sex_orin1']);?> <br>
                           <b>Medical Clearance by CNT M.D:</b> <input type="checkbox" class="radio_change cnt_md"  data-id="cnt_md" value="yes" <?php if ($check_res['cnt_md1'] == "yes") {echo "checked=checked";}?>>yes
                           <input type="checkbox" class="radio_change cnt_md"  data-id="cnt_md"  value="no" <?php if ($check_res['cnt_md1'] == "no") {echo "checked=checked";}?>>no <br>
                           
                           <b>Medical Clearance by PCP/ER M.D:</b> <input type="checkbox" class="radio_change cnt_pcp"  data-id="cnt_pcp" value="yes" <?php if ($check_res['cnt_pcp1'] == "yes") {echo "checked=checked";}?>>yes
                           <input type="checkbox" class="radio_change cnt_pcp"  data-id="cnt_pcp"  value="no" <?php if ($check_res['cnt_pcp1'] == "no") {echo "checked=checked";}?>>no
                           
                        </th>
                     </tr>
                  </table>
                  
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <th>
                           <b>Date:</b><?php echo $check_res['date1'] ?strstr($check_res['date1'], ' ', true): ''; ?>
                           <b>Time:</b> <?php echo text($check_res['time1']);?>
                           <b>Information Source</b> <input type="checkbox" class="radio_change infsrc" data-id="infsrc" value="1" <?php if ($check_res['infsrc1'] == "1") {echo "checked=checked";}?>>Patient
                           <input type="checkbox" class="radio_change infsrc" data-id="infsrc"  value="2" <?php if ($check_res['infsrc1'] == "2") {echo "checked=checked";}?>>
                          
                           Other <b>Occupation:</b> <?php echo text($check_res['infsrc1_des']);?> <br> <br>
                           <b>Patient's PCP Name:</b><?php echo text($check_res['pat_pcpn1']);?>
                           <b>Phone Number:</b> <?php echo text($check_res['pat_phone1']);?>
                           <input type="checkbox" value="pcp" name="no_pcp" <?php if ($check_res['no_pcp'] == "pcp") {echo "checked=checked";}?>>Has no PCP <br>
                           <br>
                            <b>Admitted from:</b> <input type="checkbox" class="radio_change admitted"  data-id="admitted" value="home" <?php if ($check_res['admitted'] == "home") {echo "checked=checked";}?>>Home
                            <input type="checkbox" class="radio_change admitted"  data-id="admitted"  value="facility" <?php if ($check_res['admitted'] == "facility") {echo "checked=checked";}?>>Another Facilty
                            <input type="checkbox" class="radio_change admitted"  data-id="admitted"  value="other" <?php if ($check_res['admitted'] == "other") {echo "checked=checked";}?>>Other
                           

                           <br> <br> <b>Mode Of Arrived:</b> <input type="checkbox" class="radio_change mode_arrived1"  data-id="mode_arrived1" value="ambulatory" <?php if ($check_res['mode_arrived1'] == "ambulatory") {echo "checked=checked";}?>>Ambulatory
                           <input type="checkbox" name="checkbox11" class="radio_change mode_arrived1"  data-id="mode_arrived1" value="wheel" <?php if ($check_res['mode_arrived1'] == "wheel") {echo "checked=checked";}?>>Wheel Chair
                           <input type="checkbox" class="radio_change mode_arrived1"  data-id="mode_arrived1" value="strech" <?php if ($check_res['mode_arrived1'] == "strech") {echo "checked=checked";}?>> Stretcher
                           <input type="checkbox" class="radio_change mode_arrived1"  data-id="mode_arrived1" value="ambulance" <?php if ($check_res['mode_arrived1'] == "ambulance") {echo "checked=checked";}?>>Ambulance
                          
                           <br> <b>Accompanied by:</b> <input type="checkbox" class="radio_change accompained_by"  data-id="accompained_by"  value="parent" <?php if ($check_res['accompained_by1'] == "parent") {echo "checked=checked";}?>>Parent
                           <input type="checkbox" class="radio_change accompained_by"  data-id="accompained_by"  value="guardian" <?php if ($check_res['accompained_by1'] == "guardian") {echo "checked=checked";}?>>Guardian
                           <input type="checkbox" class="radio_change accompained_by"  data-id="accompained_by"  value="other" <?php if ($check_res['accompained_by1'] == "other") {echo "checked=checked";}?>> Other <br> <br>
                          

                           <b>Reason for Admission(RN):</b>  <?php echo text($check_res['reason_admission1']);?> <br> <br>
                           <b>In Patient's Own Words:</b><br>
                           <textarea style="width:100%;height: 100px;" class="notes" name="pat_ownword1" onkeyup="textAreaAdjust(this)"><?php echo text($check_res['pat_ownword1']);?></textarea>
                        </th>
                     </tr>
                  </table>


                  
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <th> <b>VITAL SIGNS:</b> <br>
                           <b>Temperature:</b><input type="checkbox" name="temperature" <?php echo $check_res['temperature']=='1'?'checked=checked':'';?> value="1">
                           Oral:    <?php echo $check_res['oral']??'';?> &nbsp;&nbsp;&nbsp;
                           Pulse <?php echo $check_res['Pulse']??'';?> &nbsp;&nbsp;&nbsp;
                           <b>Recpiration:</b>   <?php echo $check_res['recpiration']??'';?> &nbsp;&nbsp;&nbsp;
                           <b>BP:</b> <b>Right arm:</b>  <?php echo text($check_res['bp_rightarm']);?>
                           <b>left arm:</b>  <?php echo text($check_res['bp_leftarm']);?>
                            <b>Height:</b> <?php echo text($check_res['bp_height']);?>
                             <b>Weight:</b> <?php echo text($check_res['bp_weight']);?>
                        </th>
                     </tr>
                  </table>
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <th> <b>IMMUNIZATION HISTORY:</b> <br>
                           <b> Recent Exposure to iliness(i.e.chickenbox):</b>
                           <input type="checkbox"  class="radio_change immun_check1"  data-id="immun_check1" value="no" <?php if ($check_res['immun_check1'] == "no") {echo "checked=checked";}?>>no
                           <input type="checkbox" value="yes" class="radio_change immun_check1"  data-id="immun_check1" <?php if ($check_res['immun_check1'] == "yes") {echo "checked=checked";}?>> yes
                          
                           <b>Explain</b>   <?php echo text($check_res['immun_input1']);?> <br>

                           <b> Immunization up to date?</b> <input type="checkbox" class="radio_change immun_check2"  data-id="immun_check2"  value="no" <?php if ($check_res['immun_check2'] == "no") {echo "checked=checked";}?>>no
                           <input type="checkbox" class="radio_change immun_check2"  data-id="immun_check2" value="yes" <?php if ($check_res['immun_check2'] == "yes") {echo "checked=checked";}?>> yes

                           <b>Explain</b>   <?php echo text($check_res['immun_input2']);?>  <br>

                           <b>Mantoux/PPD:</b> <input type="checkbox"  class="radio_change immun_check3" data-id="immun_check3" value="1" <?php if ($check_res['immun_check3'] == "1") {echo "checked=checked";}?>>Negative(date)
                           <input type="checkbox" value="2" <?php if ($check_res['immun_check3'] == "2") {echo "checked=checked";}?>>Positive(date)
                           <input type="checkbox"  value="3" <?php if ($check_res['immun_check3'] == "3") {echo "checked=checked";}?>>Treatment:
                           
                             <input type="checkbox" class="radio_change immun_check4"  data-id="immun_check4"  value="no" <?php if ($check_res['immun_check4'] == "no") {echo "checked=checked";}?>> no
                             <input type="checkbox" class="radio_change immun_check4"  data-id="immun_check4" value="yes" <?php if ($check_res['immun_check4'] == "yes") {echo "checked=checked";}?>> yes <br>
                            

                           <label>Identify medication treated with and how long:</label>     <?php echo text($check_res['immun_input3']);?>     <br>

                           <b>Last Tetanus:</b>   <?php echo text($check_res['immun_input4']);?>
                        </th>
                     </tr>
                  </table>

                  
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <th> <b>ALLERGIES:</b> <br>
                         <?php
                            $allergy_check1=explode(',',$check_res['allergy_check1']);

                          ?>
                           <b>LIST ALL ALLERGIES AND REACTIONS </b> <input type="checkbox"  class="allergy_check1" value="1" <?php echo in_array("1", $allergy_check1)?'checked=checked':''?>>NKA <br>
                           <input type="checkbox" class="allergy_check1"  value="2" <?php echo in_array("2", $allergy_check1)?'checked=checked':''?> >Drugs    <?php echo text($check_res['allergy_input1']);?> <br>
                           <input type="checkbox" class="allergy_check1"  value="3" <?php echo in_array("3", $allergy_check1)?'checked=checked':''?> >Latex    <?php echo text($check_res['allergy_input2']);?> <br>
                           <input type="checkbox" class="allergy_check1" value="4" <?php echo in_array("4", $allergy_check1)?'checked=checked':''?>>Tape    <?php echo text($check_res['allergy_input3']);?> <br>
                           <input type="checkbox" class="allergy_check1" value="5" <?php echo in_array("5", $allergy_check1)?'checked=checked':''?>>Food   <?php echo text($check_res['allergy_input4']);?> <br>
                           <input type="checkbox" class="allergy_check1" value="6"<?php echo in_array("6", $allergy_check1)?'checked=checked':''?> >Environmental    <?php echo text($check_res['allergy_input5']);?> <br>
                           <input type="checkbox" class="allergy_check1" value="7"<?php echo in_array("7", $allergy_check1)?'checked=checked':''?> >Dye    <?php echo text($check_res['allergy_input6']);?> <br>
                           <input type="checkbox" class="allergy_check1" value="8"<?php echo in_array("8", $allergy_check1)?'checked=checked':''?> >Other    <?php echo text($check_res['allergy_input7']);?> <br>
                        
                        </th>
                        <th>
                           <b>MEDICATIONS</b> <br>
                           <p>REFER TO MEDICATION <br>RECONCILLATION SHEET</p>
                           <u>Disposition of Medications:</u> <br>
                           <input type="checkbox"  class="radio_change disposition"  data-id="disposition" value="1" <?php if ($check_res['disposition'] == "1") {echo "checked=checked";}?>> No Medication <br>
                           <input type="checkbox" class="radio_change disposition"  data-id="disposition" value="2" <?php if ($check_res['disposition'] == "2") {echo "checked=checked";}?>> Sent Home<br>
                           <input type="checkbox" class="radio_change disposition"  data-id="disposition" value="3" <?php if ($check_res['disposition'] == "3") {echo "checked=checked";}?>> Medication Room<br>
                          
                        </th>
                     </tr>
                     <tr>
                        <th><b><u>ORIENTATION TO UNIT:</u></b> <br>
                           <input type="checkbox" class="radio_change orien_unit"  data-id="orien_unit" value="yes" <?php if ($check_res['orien_unit'] == "yes") {echo "checked=checked";}?>> yes
                           <input type="checkbox" class="radio_change orien_unit"  data-id="orien_unit" value="no" <?php if ($check_res['orien_unit'] == "no") {echo "checked=checked";}?>> no <br>

                           <input type="checkbox" name="orien_check2" value="1" <?php if ($check_res['orien_check2'] == "1") {echo "checked=checked";}?>> Packet Search Done<br>

                           <input type="checkbox" name="orien_check3" value="1" <?php if ($check_res['orien_check3'] == "1") {echo "checked=checked";}?>>Smoking cessation information provided
                           <input type="checkbox" name="checkbox44" value="1" class="radio_change smoke_na"  data-id="smoke_na" <?php if ($check_res['smoke_na_check'] == "na") {echo "checked=checked";}?>>NA
                           <input type="checkbox" class="radio_change smoke_na"  data-id="smoke_na"  value="yes" <?php if ($check_res['smoke_na_check'] == "yes") {echo "checked=checked";}?>> yes
                           <input type="checkbox"  class="radio_change smoke_na"  data-id="smoke_na"  value="refuse" <?php if ($check_res['smoke_na_check'] == "refuse") {echo "checked=checked";}?>>Refusal
                          
                        </th>
                        <th><b><u>COMMUNICATION:</u></b> <br>
                           <b>Communication in Engilsh:</b> <input type="checkbox" class="radio_change communication_wel"  data-id="communication_wel"  value="f" <?php if ($check_res['comm_check1'] == "f") {echo "checked=checked";}?>>Fluent
                           <input type="checkbox" class="radio_change communication_wel"  data-id="communication_wel"  value="s" <?php if ($check_res['comm_check1'] == "s") {echo "checked=checked";}?>>Some
                           <input type="checkbox" class="radio_change communication_wel"  data-id="communication_wel" value="n" <?php if ($check_res['comm_check1'] == "n") {echo "checked=checked";}?>>None  <br>
                          

                           <input type="checkbox" name="comm_check2" value="1" <?php if ($check_res['comm_check2'] == "1") {echo "checked=checked";}?>><b>Perfect Language:</b>
                             <?php echo text($check_res['comm_input1']);?> <br>
                           <b>Communication by:</b> 
                           <?php
                           $communication_by1=explode(',',$check_res['communication_by1']);
                           ?>
                           <input type="checkbox" class="communication_by1" value="1"  <?php echo in_array("1", $communication_by1)?'checked=checked':''?>>Signing
                           <input type="checkbox" class="communication_by1" value="2" <?php echo in_array("2", $communication_by1)?'checked=checked':''?>>Lip <br>
                           <b>Reading</b> <input type="checkbox" class="communication_by1"  value="3" <?php echo in_array("3", $communication_by1)?'checked=checked':''?>>Pen and Paper
                           <input type="checkbox" class="communication_by1" value="4" <?php echo in_array("4", $communication_by1)?'checked=checked':''?>>Speech Deivce
                           <input type="checkbox" class="communication_by1" value="5" <?php echo in_array("5", $communication_by1)?'checked=checked':''?>> TTY
                          
                        </th>
                     </tr>
                  </table>

                  
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td><b>Notes:</b> <br>
                        <textarea style="width:100%;height: 100px;" class="notes" name="note1" onkeyup="textAreaAdjust(this)"><?php echo $check_res['note1']??'';?></textarea>
                           </td>  
                    </tr>
                  </table>
                  <br>
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td>Patient Name:  <?php echo text($check_res['pat_name2']);?></td>
                        <td>DOB: <?php echo $check_res['pat_dob2'] ?strstr($check_res['pat_dob2'], ' ', true): ''; ?></td>
                     </tr>
                  </table>


                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <th colspan="3" style="border-bottem:none;">
                           <center>FALL RISK ASSESSMENT</center>
                        </th>
                     </tr>
                     <tr>
                        <td colspan="3">Initiate fall protocol if one or more of the following criteria are met</td>
                     </tr>
                     <tr>
                     <?php
                            $risk_check1=explode(',',$check_res['risk_check1']);

                          ?>
                        <td><input type="checkbox" class="risk_check1"  value="1" <?php echo in_array("1", $risk_check1)?'checked=checked':''?>>Impaired mobility</td>
                        <td><input type="checkbox" class="risk_check1"  value="2" <?php echo in_array("2", $risk_check1)?'checked=checked':''?>>History of fall(s) within 6 months</td>
                        <td><input type="checkbox" class="risk_check1"   value="3" <?php echo in_array("3", $risk_check1)?'checked=checked':''?>>New atypical antipsychotic regime</td>

                    </tr>
                     <tr>
                        <td><input type="checkbox" class="risk_check1"  value="4" <?php echo in_array("4", $risk_check1)?'checked=checked':''?>>Unsteady gait</td>
                        <td><input type="checkbox" class="risk_check1"   value="5" <?php echo in_array("5", $risk_check1)?'checked=checked':''?>>Communication deficit</td>
                        <td><input type="checkbox" class="risk_check1"    value="6" <?php echo in_array("6", $risk_check1)?'checked=checked':''?>>Withdrawal protocol</td>

                     </tr>
                     <tr>
                        <td><input type="checkbox" class="risk_check1"  value="7" <?php echo in_array("7", $risk_check1)?'checked=checked':''?>>Drug-induced sedation</td>
                        <td><input type="checkbox" class="risk_check1"  value="8" <?php echo in_array("8", $risk_check1)?'checked=checked':''?>>Hypotension</td>
                        <td><input type="checkbox" class="risk_check1"  value="9" <?php echo in_array("9", $risk_check1)?'checked=checked':''?>>Urological (incontinence, frequency, nocturia)</td>
                     </tr>
                     <tr>
                        <td></td>
                        <td><input type="checkbox" class="risk_check1" value="10" <?php echo in_array("10", $risk_check1)?'checked=checked':''?>>Impaired cognition</td>
                        <td><input type="checkbox" class="risk_check1" value="11" <?php echo in_array("11", $risk_check1)?'checked=checked':''?>>Visual impairment (legally blind)</td>
                     </tr>
                     
                     <tr >
                        <td colspan="3"><b>Physical limitations:</b> <br>
                           <textarea style="width:100%;height: 100px;" class="notes"  name="note2" onkeyup="textAreaAdjust(this)"><?php echo $check_res['note2']??'';?></textarea>
                        </td>
                     </tr>
                     <tr>
                     <?php
                            $risk_check2=explode(',',$check_res['risk_check2']);

                          ?>
                        <td colspan="3">Please select and complete one of the following:<br>
                           <input type="checkbox" class="risk_check2" <?php echo in_array("1", $risk_check2)?'checked=checked':''?> value="1">Patient does not meet criteria for fall protocol<br>
                           <input type="checkbox"  class="risk_check2" <?php echo in_array("2", $risk_check2)?'checked=checked':''?> value="2">Patient meets criteria for fall protocol. MD contacted:
                                <?php echo $check_res['risk_input1']??''; ?><br>
                           <input type="checkbox"  class="risk_check2" <?php echo in_array("3", $risk_check2)?'checked=checked':''?> value="3">Ambulation order obtained and order written 
                            <?php echo $check_res['risk_input2']??''; ?><br>
                           <input type="checkbox"  class="risk_check2" <?php echo in_array("4", $risk_check2)?'checked=checked':''?> value="4">Fall protocol initiated and placed in treatment plan<br>
                           <input type="checkbox"  class="risk_check2" <?php echo in_array("5", $risk_check2)?'checked=checked':''?> value="5">Patient meets criteria for fall protocol, however nursing judgment is to not place the patient on fall protocol Rationale: <?php echo $check_res['risk_input3']??''; ?> <br>
                           <input type="checkbox"  class="risk_check2" <?php echo in_array("6", $risk_check2)?'checked=checked':''?> value="6">MD notified and agrees with RN decision
                            <?php echo $check_res['risk_input4']??''; ?><br>
                           <input type="checkbox"  class="risk_check2" <?php echo in_array("7", $risk_check2)?'checked=checked':''?> value="7">MD notified and wants patient on fall protocol
                            <?php echo $check_res['risk_input5']??''; ?><br>
                           <input type="checkbox"  class="risk_check2" <?php echo in_array("8", $risk_check2)?'checked=checked':''?> value="8">Ambulation order obtained and written
                           <?php echo $check_res['risk_input6']??''; ?><br>
                          
                        </td>
                     </tr>
                     <tr>
                        <th colspan="3">
                           <center>RESTRAINT ASSESSMENT/ RELAXATION ASSESSMENT/ ABUSE ASSESSMENT</center>
                        </th>
                     </tr>
                     <tr>
                        <td colspan="3">
                        <?php
                            $tools1=explode(',',$check_res['tools1']);

                          ?>
                           <b>What tools do you use to help yourself relax?</b><br>
                           <input type="checkbox" class="tools1" <?php echo in_array("1", $tools1)?'checked=checked':''?> >Music 
                           <input type="checkbox" class="tools1"  <?php echo in_array("2", $tools1)?'checked=checked':''?>>Talking it out
                           <input type="checkbox" class="tools1" <?php echo in_array("3", $tools1)?'checked=checked':''?>>Exercise 
                           <input type="checkbox" class="tools1" <?php echo in_array("4", $tools1)?'checked=checked':''?> >Relaxation techniques &nbsp;
                           <input type="checkbox" class="tools1" <?php echo in_array("5", $tools1)?'checked=checked':''?>  value="5">Meditation &nbsp;
                           <input type="checkbox" class="tools1" <?php echo in_array("6", $tools1)?'checked=checked':''?>  value="6">Reading &nbsp;
                           <input type="checkbox" class="tools1" <?php echo in_array("7", $tools1)?'checked=checked':''?> value="7">Quiet time &nbsp;
                           <input type="checkbox" class="tools1"  <?php echo in_array("8", $tools1)?'checked=checked':''?> value="8">Video games &nbsp;
                           <input type="checkbox" class="tools1"  <?php echo in_array("9", $tools1)?'checked=checked':''?> value="9">Journaling &nbsp;
                           <input type="checkbox" class="tools1"  <?php echo in_array("10", $tools1)?'checked=checked':''?> value="10">Computer &nbsp;
                           <input type="checkbox" class="tools1"  <?php echo in_array("11", $tools1)?'checked=checked':''?> value="11">Watching TV &nbsp;
                           <input type="checkbox" class="tools1"  <?php echo in_array("other", $tools1)?'checked=checked':''?> value="other">Other:
                            
                            <?php  echo $check_res['tool1_note']??'';?>
                           <br>
                           <br>
                           <b>Identify whether patient has history of abuse:</b>
                           <input type="checkbox" class="radio_changes1" name="radio_changes1" value="1" <?php if($check_res['radio_changes1']=='1'){echo 'checked';} ?>>No history of abuse
                           <input type="checkbox" class="whether" name="whether1" value="1"<?php if($check_res['whether1']=='1'){echo 'checked';} ?>>Physical abuse
                           <input type="checkbox" class="whether" name="whether2" value="1"<?php if($check_res['whether1']=='1'){echo 'checked';} ?>>Sexual abuse
                           <input type="checkbox" class="whether" name="whether3" value="1"<?php if($check_res['whether1']=='1'){echo 'checked';} ?>>Emotional abuse
                           <br>
                           <br>
                           <b>Identify whether patient has ever been in restraints:</b>
                           <input type="checkbox" class="radio_change res_check1"  data-id="res_check1" value="no" <?php if($check_res['res_check1']=='no'){echo 'checked';} ?>>No
                           <input type="checkbox" class="radio_change res_check1" data-id="res_check1" value="yes" <?php if($check_res['res_check1']=='yes'){echo 'checked';} ?>>Yes
                           
                           (If yes, describe episode) <?php echo $check_res['res_check_yes']??'';?>
                           <br>
                           <br>
                           <b>
                              <center><u>Rapid Plasma Regain (RPR) Test</u></center>
                           </b>
                           <br>
                           Patient was educated about Syphilis and the RPR screening test.<br>
                           <input type="checkbox" class="radio_change ncheck1" data-id='ncheck1' value="1" <?php if($check_res['ncheck1']=='1'){echo 'checked';} ?>>Patient consented to have the RPR test.<br>
                           <input type="checkbox" class="radio_change ncheck1" data-id='ncheck1' value="2" <?php if($check_res['ncheck1']=='2'){echo 'checked';} ?>> Patient denied RPR testing.
                           
                           <br>
                           <br>
                           <b>
                              <center><u>HIV/STD EDUCATION</u></center>
                           </b>
                           <br>
                           Patient was educated about HIV, STD’s and IV drug use
                           Patient consented to HIV testing
                           <input type="checkbox" class="radio_change" data-id='ncheck2' value="1" <?php if($check_res['ncheck2']=='1'){echo 'checked';} ?>>No
                           <input type="checkbox" class="radio_change" data-id='ncheck2' value="2" <?php if($check_res['ncheck2']=='2'){echo 'checked';} ?>>Yes
                          
                           <textarea  name="update_text1" class="textarea_content" onkeyup="textAreaAdjust(this)" style="width: 100%;border:none;outline:none;overflow:hidden"><?php echo $check_res['update_text1']??''?></textarea>
                        </td>
                     </tr>
                    <tr>
                        <td style="width:50%">Patient Name: <?php echo text($check_res['pat_name3']);?></td>
                        <td colspan="2">DOB <?php echo $check_res['pat_dob3'] ?strstr($check_res['pat_dob3'], ' ', true): ''; ?></td>
                     </tr>
                     <tr style="background-color:#bbbec147;">
                        <th colspan="3">
                           <center>SUICIDE LETHALITY ASSESSMENT</center>
                        </th>
                     </tr>
                     <tr style="background-color:#bbbec147;">
                        <th colspan="3">Presence of Risk Factors</th>
                     </tr>
                     <tr>
                        <td colspan="3">
                        <?php
                            $ncheck3=explode(',',$check_res['ncheck3']);

                          ?>
                           <input type="checkbox" class="ncheck3" value="1" <?php echo in_array("1", $ncheck3)?'checked=checked':''?>>Thoughts regarding death and dying   <?php echo text($check_res['ninput1']);?><br>
                           <input type="checkbox" class="ncheck3" value="2" <?php echo in_array("2", $ncheck3)?'checked=checked':''?>>Exposure to another’s suicidal behavior   <?php echo text($check_res['ninput2']);?><br>
                           <input type="checkbox" class="ncheck3" value="3" <?php echo in_array("3", $ncheck3)?'checked=checked':''?>>Family History of suicide   <?php echo text($check_res['ninput3']);?><br>
                           <input type="checkbox" class="ncheck3" value="4" <?php echo in_array("4", $ncheck3)?'checked=checked':''?>>Depression or hopelessness   <?php echo text($check_res['ninput4']);?><br>
                           <input type="checkbox" class="ncheck3" value="5" <?php echo in_array("5", $ncheck3)?'checked=checked':''?>>Previous suicide attempts   <?php echo text($check_res['ninput5']);?><br>
                           <input type="checkbox" class="ncheck3" value="6" <?php echo in_array("6", $ncheck3)?'checked=checked':''?>>Alcohol or drug use by patient or family <?php echo text($check_res['ninput6']);?><br>
                           <input type="checkbox" class="ncheck3" value="7" <?php echo in_array("7", $ncheck3)?'checked=checked':''?>>Poor Coping Skills   <?php echo text($check_res['ninput7']);?><br>
                           <input type="checkbox" class="ncheck3" value="8" <?php echo in_array("8", $ncheck3)?'checked=checked':''?>>Relationship Loss  <?php echo text($check_res['ninput8']);?><br>
                           <input type="checkbox" class="ncheck3" value="9" <?php echo in_array("9", $ncheck3)?'checked=checked':''?>>Organized or serious attempt  <?php echo text($check_res['ninput9']);?><br>
                           <input type="checkbox" class="ncheck3" value="10" <?php echo in_array("10", $ncheck3)?'checked=checked':''?>>Social support unreliable or unavailable/family conflict <?php echo text($check_res['ninput10']);?><br>
                           <input type="checkbox" class="ncheck3" value="11" <?php echo in_array("11", $ncheck3)?'checked=checked':''?>>State future attempt (determine to repeat or ambivalent)  <?php echo text($check_res['ninput11']);?><br>
                           <input type="checkbox" class="ncheck3" value="12" <?php echo in_array("12", $ncheck3)?'checked=checked':''?>>Legal Problems <?php echo text($check_res['ninput12']);?><br>
                           <input type="checkbox" class="ncheck3" value="13" <?php echo in_array("13", $ncheck3)?'checked=checked':''?>>Physical /Sexual abuse  <?php echo text($check_res['ninput13']);?><br>
                           <input type="checkbox" class="ncheck3" value="14" <?php echo in_array("14", $ncheck3)?'checked=checked':''?>>History of assault, aggression, violence, impulsive behaviors  <?php echo text($check_res['ninput14']);?><br>
                           <input type="checkbox" class="ncheck3" value="15" <?php echo in_array("15", $ncheck3)?'checked=checked':''?>>Difficulties dealing with significant stressors (i.e., sexual orientation, unplanned  <?php echo text($check_res['ninput15']);?><br>
                           <input type="checkbox" class="ncheck3" value="16" <?php echo in_array("16", $ncheck3)?'checked=checked':''?>>Guilt, shame or fear of humiliation  <?php echo text($check_res['ninput16']);?><br>
                           <input type="checkbox" class="ncheck3" value="17" <?php echo in_array("17", $ncheck3)?'checked=checked':''?>>Recent loss/Anniversary of a loss/Anticipated Loss   <?php echo text($check_res['ninput17']);?><br>
                           <input type="checkbox" class="ncheck3" value="18" <?php echo in_array("18", $ncheck3)?'checked=checked':''?>>Poor sleep <?php echo text($check_res['ninput18']);?><br>
                           <input type="checkbox" class="ncheck3" value="19" <?php echo in_array("19", $ncheck3)?'checked=checked':''?>>Chronic illness (Chronic Pain, Dialysis)  <?php echo text($check_res['ninput19']);?><br>
                           <input type="checkbox" class="ncheck3" value="20" <?php echo in_array("20", $ncheck3)?'checked=checked':''?>>History of a traumatic event, (Experienced and or Witnessed)   <?php echo text($check_res['ninput20']);?><br>
                           <input type="checkbox" class="ncheck3" value="21" <?php echo in_array("21", $ncheck3)?'checked=checked':''?>>Other <?php echo text($check_res['ninput21']);?><br>
                         
                        </td>
                     </tr>
                     <tr style="background-color:#bbbec147;">
                        <th colspan="3">Presence of Protective Factors/ SNAP Assessment</th>
                     </tr>
                     <tr>
                        <td colspan="3">
                        <?php
                            $ncheck4=explode(',',$check_res['ncheck4']);

                          ?>
                           <input type="checkbox" class="ncheck4" value="1" <?php echo in_array("1", $ncheck4)?'checked=checked':''?> >Positive experience with professional help  <?php echo text($check_res['ninput22']);?><br>
                           <input type="checkbox" class="ncheck4" value="2" <?php echo in_array("2", $ncheck4)?'checked=checked':''?>>Life Skills(decision-making, problem solving, conflict mgmt)    <?php echo text($check_res['ninput23']);?><br>
                           <input type="checkbox" class="ncheck4" value="3" <?php echo in_array("3", $ncheck4)?'checked=checked':''?>>Strong support system   <?php echo text($check_res['ninput24']);?><br>
                           <input type="checkbox" class="ncheck4" value="4" <?php echo in_array("4", $ncheck4)?'checked=checked':''?>>Future goals  <?php echo text($check_res['ninput25']);?><br>
                           <input type="checkbox" class="ncheck4" value="5" <?php echo in_array("5", $ncheck4)?'checked=checked':''?>>Religious prohibition/Spirituality  <?php echo text($check_res['ninput26']);?><br>
                           <input type="checkbox" class="ncheck4" value="6" <?php echo in_array("6", $ncheck4)?'checked=checked':''?>>Willing and able to participate in treatment  <?php echo text($check_res['ninput27']);?><br>
                           <input type="checkbox" class="ncheck4" value="7" <?php echo in_array("7", $ncheck4)?'checked=checked':''?>>Responsibility to siblings/friends/pets  <?php echo text($check_res['ninput28']);?><br>
                           <input type="checkbox" class="ncheck4" value="8" <?php echo in_array("8", $ncheck4)?'checked=checked':''?>>Sobriety   <?php echo text($check_res['ninput29']);?><br>
                           <input type="checkbox" class="ncheck4" value="9" <?php echo in_array("9", $ncheck4)?'checked=checked':''?>>Presenting thoughts    <?php echo text($check_res['ninput30']);?><br>
                           <input type="checkbox" class="ncheck4" value="10" <?php echo in_array("10", $ncheck4)?'checked=checked':''?>>Individual needs    <?php echo text($check_res['ninput31']);?><br>
                           <input type="checkbox" class="ncheck4" value="11" <?php echo in_array("11", $ncheck4)?'checked=checked':''?>>Physical Abilities  <?php echo text($check_res['ninput32']);?><br>
                           <input type="checkbox" class="ncheck4" value="12" <?php echo in_array("12", $ncheck4)?'checked=checked':''?>>Preferences    <?php echo text($check_res['ninput33']);?><br>
                           <input type="checkbox" class="ncheck4" value="13" <?php echo in_array("13", $ncheck4)?'checked=checked':''?>>Urgent needs   <?php echo text($check_res['ninput34']);?><br>
                           <input type="checkbox" class="ncheck4" value="14" <?php echo in_array("14", $ncheck4)?'checked=checked':''?>>Other <?php echo text($check_res['ninput35']);?><br>
                              <?php echo text($check_res['ninput36']);?>
                           <br> <?php echo text($check_res['ninput37']);?><br>
                          
                        </td>
                     </tr>
                     <tr style="background-color:#bbbec147;">
                        <td colspan="3"><b>Current Stressors ( as per patient): </b><br>
                           <textarea style="width:100%;background-color:#bbbec147;" class="notes" <?php echo text($check_res['nnote1']);?>" name="nnote1" onkeyup="textAreaAdjust(this)"></textarea>
                           <b>Motivation for Treatment (as per patient): </b><br>
                           <textarea style="width:100%;background-color:#bbbec147 !important;" class="notes" <?php echo text($check_res['nnote2']);?>" name="nnote2" onkeyup="textAreaAdjust(this)"></textarea>
                        </td>
                     </tr>
                     <tr>
                        <td style="width:50%">Patient Name:  <?php echo text($check_res['pat_name4']);?></td>
                        <td colspan="2">DOB <?php echo $check_res['pat_dob4'] ?strstr($check_res['pat_dob4'], ' ', true): ''; ?> </td>
                     </tr>
                     <tr>
                        <td colspan="3">Reason for Substance Use:<textarea  name="nnote3" class="textarea_content" onkeyup="textAreaAdjust(this)" style="width: 100%;border:none;outline:none;overflow:hidden"><?php echo text($check_res['nnote3']);?></textarea></td>
                     </tr>
                     <tr>
                          <?php
                            $substance=explode(',',$check_res['substance']);

                          ?>
                        <td colspan="3">
                           <input type="checkbox" class="substance" value="1" <?php echo in_array("1", $substance)?'checked=checked':''?> >Euphoria
                           <input type="checkbox" class="substance" value="2" <?php echo in_array("2", $substance)?'checked=checked':''?>>Fear
                           <input type="checkbox" class="substance" value="3" <?php echo in_array("3", $substance)?'checked=checked':''?>>Anger
                           <input type="checkbox" class="substance" value="4" <?php echo in_array("4", $substance)?'checked=checked':''?>>Insomnia
                           <input type="checkbox" class="substance" value="5" <?php echo in_array("5", $substance)?'checked=checked':''?>>Stress
                           <input type="checkbox" class="substance" value="6" <?php echo in_array("6", $substance)?'checked=checked':''?>>Social Discomfort
                           <input type="checkbox" class="substance" value="7" <?php echo in_array("7", $substance)?'checked=checked':''?>>Peer Pressure
                           
                           <br>
                           Substance Use/Abuse Circumstances
                           <textarea style="width:100%;" class="notes" onkeyup="textAreaAdjust(this)" name="substance_reason"> <?php echo text($check_res['substance_reason']);?></textarea>
                           <br>
                           Urges (circle relevant ones):
                           <input type="checkbox" class="radio_change urges" data-id="urges" value="1" <?php if ($check_res['urges'] == "1") {echo "checked=checked";}?>>None
                           <input type="checkbox" class="radio_change urges" data-id="urges" value="2" <?php if ($check_res['urges'] == "2") {echo "checked=checked";}?> >Occasional
                           <input type="checkbox" class="radio_change urges" data-id="urges" value="3" <?php if ($check_res['urges'] == "3") {echo "checked=checked";}?>>Frequent
                           <input type="checkbox" class="radio_change urges" data-id="urges" value="4" <?php if ($check_res['urges'] == "4") {echo "checked=checked";}?>>Very Frequent
                           <input type="checkbox" class="radio_change urges" data-id="urges" value="5" <?php if ($check_res['urges'] == "5") {echo "checked=checked";}?>>Constant<br>
                           
                           <b>Behavior While Using Substances</b><br>
                           Examples:
                           <input type="checkbox" class="radio_change substances1" data-id="substances1" value="1" <?php if ($check_res['substances1'] == "1") {echo "checked=checked";}?>>Extroverted
                           <input type="checkbox" class="radio_change substances1" data-id="substances1" value="2" <?php if ($check_res['substances1'] == "2") {echo "checked=checked";}?>>Isolated
                           <input type="checkbox" class="radio_change substances1" data-id="substances1" value="3" <?php if ($check_res['substances1'] == "3") {echo "checked=checked";}?>>Aggressive
                           <input type="checkbox" class="radio_change substances1" data-id="substances1" value="4" <?php if ($check_res['substances1'] == "4") {echo "checked=checked";}?>> Promiscuous
                           
                           Describe:    <textarea style="width:100%;" class="notes" onkeyup="textAreaAdjust(this)" name="describenote1"><?php echo text($check_res['describenote1']);?></textarea><br>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="3">
                           <b>Suicide Inquiry (Specific questioning about thoughts, plans, behaviors, intent)</b><br>
                           <b>Ideation:</b>
                           <input type="checkbox" class="radio_change susaid_inquiry" data-id="susaid_inquiry" value="1" <?php if ($check_res['susaid_inquiry'] == "1") {echo "checked=checked";}?>>Frequency
                           <input type="checkbox" class="radio_change susaid_inquiry" data-id="susaid_inquiry" value="2" <?php if ($check_res['susaid_inquiry'] == "2") {echo "checked=checked";}?>>Intensity
                           <input type="checkbox" class="radio_change susaid_inquiry" data-id="susaid_inquiry" value="3" <?php if ($check_res['susaid_inquiry'] == "3") {echo "checked=checked";}?>>Duration
                           <input type="checkbox" class="radio_change susaid_inquiry" data-id="susaid_inquiry" value="4" <?php if ($check_res['susaid_inquiry'] == "4") {echo "checked=checked";}?>> last 48 hrs
                           <input type="checkbox" class="radio_change susaid_inquiry" data-id="susaid_inquiry" value="5" <?php if ($check_res['susaid_inquiry'] == "5") {echo "checked=checked";}?>> past month and worst ever
                           <input type="checkbox" class="radio_change susaid_inquiry" data-id="susaid_inquiry" value="6" <?php if ($check_res['susaid_inquiry'] == "6") {echo "checked=checked";}?>> (Behavioral Incident)
                          
                            <?php echo text($check_res['textinput1']);?>
                     </tr>
                     <tr>
                        <td colspan="3">
                           <b>Plan:</b> Timing, Location, Lethality, Availability, Preparatory Acts<br>
                           <b>Behaviors:</b>  Past or aborted attempts, rehearsals (tying noose, loading gun, versus non-suicidal self-injurious actions<br>
                           <b>Intent:</b> Extent to which the patient (1)expects to carry out the plan &(2) believes the plan /act to be lethal vs. self-injurious (explore ambivalence: reason to die vs. reason to live)<br>
                        </td>
                     </tr>
                     <tr>
                        <th colspan="3" style="background-color:#bbbec147;">Assessment of Dangerousness other than Suicide</th>
                     </tr>
                     <tr>
                        <td colspan="3">
                           <input type="checkbox" name="history1"  value='1' <?php if ($check_res['history1'] == "1") {echo "checked=checked";}?>>History of self-mutilation<br>
                           <input type="checkbox" name="history2"  value='1' <?php if ($check_res['history2'] == "1") {echo "checked=checked";}?>>History of aggressive or assaultive behavior<br>
                           <input type="checkbox" name="history3"  value='1' <?php if ($check_res['history3'] == "1") {echo "checked=checked";}?>>History of arrest or incarceration due to violence<br>
                        </td>
                     </tr>
                     <tr>
                        <th colspan="3">LEGAL HISTORY</th>
                     </tr>
                     <tr>
                        <td colspan="3">
                        <?php
                            $legal_history=explode(',',$check_res['legal_history']);

                          ?>
                           <input type="checkbox" class="legal_history" value="1" <?php echo in_array("1", $legal_history)?'checked=checked':''?>>DUIs &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox"  class="legal_history" value="1" <?php echo in_array("1", $legal_history)?'checked=checked':''?>>Arrests &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox"  class="legal_history" value="1" <?php echo in_array("1", $legal_history)?'checked=checked':''?>>Incarcerations &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="legal_history" value="1" <?php echo in_array("1", $legal_history)?'checked=checked':''?>>Convictions &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox"  class="legal_history" value="1" <?php echo in_array("1", $legal_history)?'checked=checked':''?>>Probation<br>
                           
                           Explain:    <textarea style="width:100%;" class="notes" onkeyup="textAreaAdjust(this)" name="nnotes10"> <?php echo text($check_res['nnotes10']);?></textarea><br>
                           Do you feel your legal problems are due to substance use?:
                           <textarea style="width:100%;" class="notes" onkeyup="textAreaAdjust(this)" name="nnotes11"> <?php echo text($check_res['nnotes11']);?></textarea>
                        </td>
                     </tr>
                     <tr>
                        <th colspan="3"><u>SOCIAL</u></th>
                     </tr>
                     <tr>
                        <td colspan="3">
                           1.	Are your social relationships (friends, peers, colleagues) negatively impacted?:
                           <input type="checkbox"  class="radio_change social_relation1" data-id='social_relation1' value="yes" <?php if ($check_res['social_relation1'] == "yes") {echo "checked=checked";}?>>Yes &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="radio_change social_relation1" data-id='social_relation1' value="no" <?php if ($check_res['social_relation1'] == "no") {echo "checked=checked";}?>>No<br>
                           
                           2.	Out of your 1<input type="checkbox" name="closet_peers" value="1" <?php  echo $check_res['closet_peers']=='1'?'checked=checked':'';?>>Closest peers/friends, how many use drugs/alcohol at least once every 2 weeks?
                           <br>
                           <textarea style="width:100%;" class="notes" onkeyup="textAreaAdjust(this)" name="nnotes12"> <?php echo text($check_res['nnotes12']);?></textarea>
                        </td>
                     </tr>
                  </table> 

                          
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td>Patient Name:  <?php echo text($check_res['pat_name5']);?></td>
                        <td>DOB:<?php echo $check_res['pat_dob5'] ?strstr($check_res['pat_dob5'], ' ', true): ''; ?></td>
                     </tr>
                  </table>
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr style="background-color:#bbbec147;">
                        <th colspan="4">
                           <center>CHEMICAL USE HISTORY<br>
                              <input type="checkbox" name="denied_history" value="1" <?php if ($check_res['denied_history'] == "1") {echo "checked=checked";}?>>Denies use of all chemicals
                           </center>
                        </th>
                     </tr>
                     <tr>
                        <th>Class of substance</th>
                        <th>Amount, frequency, pattern of use </th>
                        <th>Duration</th>
                        <th>Last used</th>
                     </tr>
                     <tr>
                        <td>Cigarettes/tobacco</td>
                        <td>  <?php echo text($check_res['cigarettes1']);?></td>
                        <td>  <?php echo text($check_res['cigarettes2']);?></td>
                        <td>  <?php echo text($check_res['cigarettes3']);?></td>
                     </tr>
                     <tr>
                        <td>Alcohol</td>
                        <td>  <?php echo text($check_res['alcohol1']);?></td>
                        <td> <?php echo text($check_res['alcohol2']);?></td>
                        <td> <?php echo text($check_res['alcohol3']);?></td>
                     </tr>
                     <tr>
                        <td>Amphetamine</td>
                        <td> <?php echo text($check_res['amphetamine1']);?></td>
                        <td> <?php echo text($check_res['amphetamine2']);?></td>
                        <td>  <?php echo text($check_res['amphetamine3']);?></td>
                     </tr>
                     <tr>
                        <td>Marijuana</td>
                        <td>  <?php echo text($check_res['Marijuana1']);?></td>
                        <td>  <?php echo text($check_res['Marijuana2']);?></td>
                        <td> <?php echo text($check_res['Marijuana3']);?></td>
                     </tr>
                     <tr>
                        <td>Cocaine</td>
                        <td>  <?php echo text($check_res['Cocaine1']);?></td>
                        <td>  <?php echo text($check_res['Cocaine2']);?></td>
                        <td> <?php echo text($check_res['Cocaine3']);?></td>
                     </tr>
                     <tr>
                        <td>Hallucinogens</td>
                        <td> <?php echo text($check_res['Hallucinogens1']);?></td>
                        <td> <?php echo text($check_res['Hallucinogens2']);?></td>
                        <td> <?php echo text($check_res['Hallucinogens3']);?></td>
                     </tr>
                     <tr>
                        <td>Inhalants</td>
                        <td> <?php echo text($check_res['Inhalants1']);?></td>
                        <td> <?php echo text($check_res['Inhalants2']);?></td>
                        <td> <?php echo text($check_res['Inhalants3']);?></td>
                     </tr>
                     <tr>
                        <td>Opiates</td>
                        <td> <?php echo text($check_res['Opiates1']);?></td>
                        <td> <?php echo text($check_res['Opiates2']);?></td>
                        <td> <?php echo text($check_res['Opiates3']);?></td>
                     </tr>
                     <tr>
                        <td>PCP</td>
                        <td> <?php echo text($check_res['PCP1']);?></td>
                        <td> <?php echo text($check_res['PCP2']);?></td>
                        <td> <?php echo text($check_res['PCP3']);?></td>
                     </tr>
                     <tr>
                        <td>Sedatives</td>
                        <td> <?php echo text($check_res['Sedative1']);?></td>
                        <td> <?php echo text($check_res['Sedative2']);?></td>
                        <td> <?php echo text($check_res['Sedative3']);?></td>
                     </tr>
                     <tr>
                        <td>Ecstasy</td>
                        <td> <?php echo text($check_res['Ecstasy1']);?></td>
                        <td> <?php echo text($check_res['Ecstasy2']);?></td>
                        <td> <?php echo text($check_res['Ecstasy3']);?></td>
                     </tr>
                     <tr>
                        <td>Rave drugs</td>
                        <td><?php echo text($check_res['Rave_drug1']);?></td>
                        <td><?php echo text($check_res['Rave_drug2']);?></td>
                        <td><?php echo text($check_res['Rave_drug3']);?></td>
                     </tr>
                     <tr>
                        <td>Prescription pain meds</td>
                        <td> <?php echo text($check_res['pain_meds1']);?></td>
                        <td> <?php echo text($check_res['pain_meds2']);?></td>
                        <td> <?php echo text($check_res['pain_meds3']);?></td>
                     </tr>
                     <tr>
                        <td>Other:</td>
                        <td> <?php echo text($check_res['Other_dev1']);?></td>
                        <td> <?php echo text($check_res['Other_dev2']);?></td>
                        <td> <?php echo text($check_res['Other_dev3']);?></td>
                     </tr>
                     <tr style="background-color:#bbbec147;">
                        <th colspan="4">
                           <center>TREATMENT HISTORY</center>
                        </th>
                     </tr>
                     <tr>
                        <td colspan="4">
                           <b>Substance abuse :</b>(most recent, reason for treatment, facility, when, treatment length, level of treatment, outcome)
                           <textarea style="width:100%;" class="notes" onkeyup="textAreaAdjust(this)" name="treatment_note1"> <?php echo text($check_res['treatment_note1']);?></textarea>
                           <b>Longest period of  abstinence:</b>  <?php echo text($check_res['abstinence1']);?><br>
                           <b>Previous Psychiatric Treatment History: </b>    <textarea style="width:100%;" class="notes" onkeyup="textAreaAdjust(this)" name="treatment_note2"> <?php echo text($check_res['treatment_note2']);?></textarea><br>
                        </td>
                     </tr>
                  </table>

                       
                  <table style="border:1px solid black;width:100%" class="table table-bordered" style="margin-top:0px;">
                     <tr style="background-color:#bbbec147;">
                        <th colspan="9">
                           <center>MEDICAL HISTORY (P-Patient   F-Family)</center>
                        </th>
                     </tr>
                     <tr style="width:100%;">
                        <td style="width:4%;">P</td>
                        <td style="width:4%;">F</td>
                        <th></th>
                        <td style="width:4%;">P</td>
                        <td style="width:4%;">F</td>
                        <th></th>
                        <td style="width:4%;">P</td>
                        <td style="width:4%;">F</td>
                        <th></th>
                     </tr>
                     <tr>
                     <?php
                            $med_check=explode(',',$check_res['med_check']);

                          ?>
                       
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="1" <?php echo in_array("1", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="2" <?php echo in_array("2", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;" >Heart disease</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="3" <?php echo in_array("3", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="4" <?php echo in_array("4", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Ulcer/reflux</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="5" <?php echo in_array("5", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="6" <?php echo in_array("6", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Thyroid</td>
                     </tr>
                     <tr>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="7" <?php echo in_array("7", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="8" <?php echo in_array("8", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;" >Immune disorder</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="9" <?php echo in_array("9", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="10" <?php echo in_array("10", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Vascular disease</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="11" <?php echo in_array("11", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="12" <?php echo in_array("12", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Hepatitis</td>
                     </tr>
                     <tr>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="13" <?php echo in_array("13", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="14" <?php echo in_array("14", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Chest pain/Arrhythmia</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="15" <?php echo in_array("15", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="16" <?php echo in_array("16", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Migraines</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="17" <?php echo in_array("17", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="18" <?php echo in_array("18", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Cancer</td>
                     </tr>
                     <tr>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="19" <?php echo in_array("19", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="20" <?php echo in_array("20", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;" >Kidney disease</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="21" <?php echo in_array("21", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="22" <?php echo in_array("22", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Pneumonia</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="23" <?php echo in_array("23", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="24" <?php echo in_array("24", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Diabetes</td>
                     </tr>
                     <tr>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="25" <?php echo in_array("25", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="26" <?php echo in_array("26", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;" >Hypertension</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="27" <?php echo in_array("27", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="28" <?php echo in_array("28", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">TIA/CVA</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="29" <?php echo in_array("29", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="30" <?php echo in_array("30", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Seizures disorder</td>
                     </tr>
                     <tr>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="31" <?php echo in_array("31", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="32" <?php echo in_array("32", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;" >Blood disorder</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="33" <?php echo in_array("33", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="34" <?php echo in_array("34", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Asthma</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="35" <?php echo in_array("35", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="36" <?php echo in_array("36", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Eye problems</td>
                     </tr>
                     <tr >
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="37" <?php echo in_array("37", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="38" <?php echo in_array("38", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;" >Memory loss</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="39" <?php echo in_array("39", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="40" <?php echo in_array("40", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Sexually transmitted disease</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="41" <?php echo in_array("41", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="42" <?php echo in_array("42", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">HIV</td>
                     </tr>
                     <tr>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="43" <?php echo in_array("43", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="44"<?php echo in_array("44", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;" >Mono</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="45" <?php echo in_array("45", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;" ><input type="checkbox" class="med_check" value="46" <?php echo in_array("46", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">COPD</td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="47" <?php echo in_array("47", $med_check)?'checked=checked':''?>></td>
                        <td style="width:4%;"><input type="checkbox" class="med_check" value="48" <?php echo in_array("48", $med_check)?'checked=checked':''?>></td>
                        <td style="width:50px;">Arthritis</td>
                     </tr>
                  </table>
                  <p>Other medical issues:  <?php echo text($check_res['med_input1']);?></p>
                  <br>
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr style="background-color:#bbbec147;">
                        <th colspan="2">
                           <center>SURGICAL HISTORY</center>
                        </th>
                     </tr>
                     <tr>
                        <th colspan="2">Have you ever had surgery in the past?
                           <input type="checkbox" class="radio_change surgery_check" data-id="surgery_check" value="yes" <?php if ($check_res['surgery_check'] == "yes") {echo "checked=checked";}?>>Yes
                           <input type="checkbox" class="radio_change surgery_check" data-id="surgery_check" value="no" <?php if ($check_res['surgery_check'] == "no") {echo "checked=checked";}?>>No
                          
                        </th>
                     </tr>
                     <tr>
                        <th style="width:50%">Surgical Procedure(s):</th>
                        <th>Year</th>
                     </tr>
                     <tr>
                        <td> <?php echo text($check_res['sur_input1']);?></td>
                        <td> <?php echo text($check_res['sur_input2']);?></td>
                     </tr>
                     <tr>
                        <td> <?php echo text($check_res['sur_input3']);?></td>
                        <td> <?php echo text($check_res['sur_input4']);?></td>
                     </tr>
                  </table>
                  <table style="border:1px solid black;width:100%" class="table table-bordered" >
                     <tr>
                        <td>Patient Name:  <?php echo text($check_res['pat_name6']);?></td>
                        <td>DOB:  <?php echo $check_res['pat_dob6'] ?strstr($check_res['pat_dob6'], ' ', true): ''; ?></td>
                     </tr>
                  </table>

                  
                  <table style="border:none solid black;width:100%">
                     <tr>
                        <td><b>Appearance:</b> &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red_apperance" data-id="red_apperance" value="1" <?php if ($check_res['red_apperance'] == "1") {echo "checked=checked";}?>>Well-groomed&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red_apperance" data-id="red_apperance" value="2" <?php if ($check_res['red_apperance'] == "2") {echo "checked=checked";}?>>Disheveled&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red_apperance" data-id="red_apperance" value="3" <?php if ($check_res['red_apperance'] == "3") {echo "checked=checked";}?>>Bizarre &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red_apperance" data-id="red_apperance" value="4" <?php if ($check_res['red_apperance'] == "4") {echo "checked=checked";}?>>Inappropriate: ><br>
                           

                           <b>Attention:</b>	&nbsp;&nbsp;<input type="checkbox" class="radio_change red2" data-id="red2" value="1" <?php if ($check_res['red2'] == "1") {echo "checked=checked";}?>>Normal &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red2" data-id="red2" value="2" <?php if ($check_res['red2'] == "2") {echo "checked=checked";}?>>Easily Distracted
                          
                            <?php echo text($check_res['red_input2']);?><br>

                           <b>Concentration:</b>	 &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red3" data-id="red3" value="1" <?php if ($check_res['red3'] == "1") {echo "checked=checked";}?>>Good &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red3" data-id="red3" value="2" <?php if ($check_res['red3'] == "2") {echo "checked=checked";}?>>Trouble concentrating:
                           
                            <?php echo text($check_res['red_input3']);?><br>

                           <b>Hallucinations:</b>	 &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red4" data-id="red4" value="1" <?php if ($check_res['red4'] == "1") {echo "checked=checked";}?>>None&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red4" data-id="red4" value="2" <?php if ($check_res['red4'] == "2") {echo "checked=checked";}?>>Auditory&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red4" data-id="red4" value="3" <?php if ($check_res['red4'] == "3") {echo "checked=checked";}?>>Visual &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red4" data-id="red4" value="4" <?php if ($check_res['red4'] == "4") {echo "checked=checked";}?>>Olfactory &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red4" data-id="red4" value="5" <?php if ($check_res['red4'] == "5") {echo "checked=checked";}?>>Command
                          
                             <?php echo text($check_res['red_input4']);?><br>

                           <b>Delusions:</b>	 &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red5" data-id="red5" value="1" <?php if ($check_res['red5'] == "1") {echo "checked=checked";}?>>None&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red5" data-id="red5" value="2" <?php if ($check_res['red5'] == "2") {echo "checked=checked";}?>>Paranoid&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red5" data-id="red5" value="3" <?php if ($check_res['red5'] == "3") {echo "checked=checked";}?>>Grandeur&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red5" data-id="red5" value="4" <?php if ($check_res['red5'] == "4") {echo "checked=checked";}?>>Reference &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red5" data-id="red5" value="5" <?php if ($check_res['red5'] == "5") {echo "checked=checked";}?>>Other:
                           
                            <?php echo text($check_res['red_input5']);?><br>

                           <b>Memory:</b>	 &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red6" data-id="red6" value="1" <?php if ($check_res['red6'] == "1") {echo "checked=checked";}?>>Intact&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red6" data-id="red6" value="2" <?php if ($check_res['red6'] == "2") {echo "checked=checked";}?>>Impaired (check appropriate):&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red6" data-id="red6" value="3" <?php if ($check_res['red6'] == "3") {echo "checked=checked";}?>>Immediate&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red6" data-id="red6" value="4" <?php if ($check_res['red6'] == "4") {echo "checked=checked";}?>>Recent&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red6" data-id="red6" value="5" <?php if ($check_res['red6'] == "5") {echo "checked=checked";}?>>Remote<br>
                           

                           <b>Intelligence:</b>&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red7" data-id="red7" value="1" <?php if ($check_res['red7'] == "1") {echo "checked=checked";}?>>Appears Normal&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red7" data-id="red7" value="2" <?php if ($check_res['red7'] == "2") {echo "checked=checked";}?>>Low Intelligence:
                          
                           <?php echo text($check_res['red_input6']);?><br>

                           <b>Orientation:</b>&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red8" data-id="red8" value="1" <?php if ($check_res['red8'] == "1") {echo "checked=checked";}?>>All Spheres&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red8" data-id="red8" value="2" <?php if ($check_res['red8'] == "2") {echo "checked=checked";}?>>Impaired (circle appropriate):     &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red8" data-id="red8" value="3" <?php if ($check_res['red8'] == "3") {echo "checked=checked";}?>>Person     &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red8" data-id="red8" value="4" <?php if ($check_res['red8'] == "4") {echo "checked=checked";}?>>Place     &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red8" data-id="red8" value="5" <?php if ($check_res['red8'] == "5") {echo "checked=checked";}?>>Time<br>
                           

                           <b>Social Judgment:</b>	 &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red9" data-id="red9" value="1" <?php if ($check_res['red9'] == "1") {echo "checked=checked";}?>>Appropriate &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red9" data-id="red9" value="2" <?php if ($check_res['red9'] == "2") {echo "checked=checked";}?>>Harmful &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red9" data-id="red9" value="3" <?php if ($check_res['red9'] == "3") {echo "checked=checked";}?>>Unacceptable  &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red9" data-id="red9" value="4" <?php if ($check_res['red9'] == "4") {echo "checked=checked";}?>>Unknown<br>
                           

                           <b>Insight:</b> &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red10" data-id="red10" value="1" <?php if ($check_res['red10'] == "1") {echo "checked=checked";}?>>Good &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red10" data-id="red10" value="2" <?php if ($check_res['red10'] == "2") {echo "checked=checked";}?>>Fair &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red10" data-id="red10" value="3" <?php if ($check_res['red10'] == "3") {echo "checked=checked";}?>>Poor &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red10" data-id="red10" value="4" <?php if ($check_res['red10'] == "4") {echo "checked=checked";}?>>Denial  &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red10" data-id="red10" value="5" <?php if ($check_res['red10'] == "5") {echo "checked=checked";}?>>Blames Others<br>
                           

                           <b>Impulse Control:</b>	 &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red11" data-id="red11" value="1" <?php if ($check_res['red11'] == "1") {echo "checked=checked";}?>>Intact &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red11" data-id="red11" value="2" <?php if ($check_res['red11'] == "2") {echo "checked=checked";}?>>Poor  &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red11" data-id="red11" value="3" <?php if ($check_res['red11'] == "3") {echo "checked=checked";}?>>Unknown<br>
                        
                           <b>Thought Content:</b> &nbsp;&nbsp;
                           <?php
                            $red12=explode(',',$check_res['red12']);

                          ?>
                           <input type="checkbox" class="red12" <?php echo in_array("1", $red12)?'checked=checked':''?> value="1">Appropriate &nbsp;&nbsp;
                           <input type="checkbox" class="red12" <?php echo in_array("2", $red12)?'checked=checked':''?> value="2" >Suicide &nbsp;&nbsp;
                           <input type="checkbox" class="red12" <?php echo in_array("2", $red12)?'checked=checked':''?> value="3" >Homicide &nbsp;&nbsp;
                           <input type="checkbox" class="red12" <?php echo in_array("2", $red12)?'checked=checked':''?> value="4" >Illness &nbsp;&nbsp;
                           <input type="checkbox" class="red12" <?php echo in_array("2", $red12)?'checked=checked':''?> value="5" >Obsessions &nbsp;&nbsp;
                           <input type="checkbox" class="red12" <?php echo in_array("2", $red12)?'checked=checked':''?> value="6" >Compulsions &nbsp;&nbsp;
                           <input type="checkbox" class="red12" <?php echo in_array("2", $red12)?'checked=checked':''?> value="7" >Fears &nbsp;&nbsp;
                           <input type="checkbox" class="red12" <?php echo in_array("2", $red12)?'checked=checked':''?> value="8" >Somatic Complaints &nbsp;&nbsp;
                           <input type="checkbox" class="red12" <?php echo in_array("2", $red12)?'checked=checked':''?> value="9" >Other:
                           
                            <?php echo text($check_res['red_input7']);?><br>

                           <b>Affect:</b>	 &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red13" data-id="red13" value="1" <?php if ($check_res['red13'] == "1") {echo "checked=checked";}?>>Appropriate &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red13" data-id="red13" value="2" <?php if ($check_res['red13'] == "2") {echo "checked=checked";}?>>Inappropriate (describe):
                             <?php echo text($check_res['red_input8']);?><br>
                           

                           <b>Mood:</b> &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red14" data-id="red14" value="1" <?php if ($check_res['red14'] == "1") {echo "checked=checked";}?>>Euthymic &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red14" data-id="red14" value="2" <?php if ($check_res['red14'] == "2") {echo "checked=checked";}?>>Other:
                            <?php echo text($check_res['red_input8']);?><br>
                           

                           <b>Speech:</b> &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red15" data-id="red15" value="1" <?php if ($check_res['red15'] == "1") {echo "checked=checked";}?>>Normal &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red15" data-id="red15" value="2" <?php if ($check_res['red15'] == "2") {echo "checked=checked";}?>>Slurred &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red15" data-id="red15" value="3" <?php if ($check_res['red15'] == "3") {echo "checked=checked";}?>>Slow &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red15" data-id="red15" value="4" <?php if ($check_res['red15'] == "4") {echo "checked=checked";}?>>Pressured &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red15" data-id="red15" value="5" <?php if ($check_res['red15'] == "5") {echo "checked=checked";}?>>Loud<br>
                           
                           <b>Behavior: </b>&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red16" data-id="red16" value="1" <?php if ($check_res['red16'] == "1") {echo "checked=checked";}?>>Appropriate &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red16" data-id="red16" value="2" <?php if ($check_res['red16'] == "2") {echo "checked=checked";}?>>Inappropriate (anxious, agitated, guarded, hostile, uncooperative)<br>
                           

                           <b>Thought Disorder: </b>    &nbsp;&nbsp;
                           <?php
                            $red17=explode(',',$check_res['red17']);

                          ?>
                           <input type="checkbox" class="red17" value="1" <?php echo in_array("1", $red17)?'checked=checked':''?>>Normal &nbsp;&nbsp;
                           <input type="checkbox" class="red17" value="2" <?php echo in_array("2", $red17)?'checked=checked':''?>>Narcissistic &nbsp;&nbsp;
                           <input type="checkbox" class="red17" value="3" <?php echo in_array("3", $red17)?'checked=checked':''?>>Paranoia &nbsp;&nbsp;
                           <input type="checkbox" class="red17" value="4" <?php echo in_array("4", $red17)?'checked=checked':''?>>Ideas of Reference &nbsp;&nbsp;
                           <input type="checkbox" class="red17" value="5" <?php echo in_array("5", $red17)?'checked=checked':''?>>Tangential &nbsp;&nbsp;
                           <input type="checkbox" class="red17" value="6" <?php echo in_array("6", $red17)?'checked=checked':''?>>Loose Associations &nbsp;&nbsp;
                           <input type="checkbox" class="red17" value="7" <?php echo in_array("7", $red17)?'checked=checked':''?>>Confusion  &nbsp;&nbsp;
                           <input type="checkbox" class="red17" value="8" <?php echo in_array("8", $red17)?'checked=checked':''?>>Thought Blocking    &nbsp;&nbsp;
                           <input type="checkbox" class="red17" value="9" <?php echo in_array("9", $red17)?'checked=checked':''?>>Obsession &nbsp;&nbsp;
                           <input type="checkbox" class="red17" value="10" <?php echo in_array("10", $red17)?'checked=checked':''?>>Flight of Ideas<br>
                           

                           <b>Sleep:</b>
                           <input type="checkbox"  class="radio_change red18" data-id="red18" value="1" <?php if ($check_res['red18'] == "1") {echo "checked=checked";}?>>No Change
                           <input type="checkbox" class="radio_change red18" data-id="red18" value="2" <?php if ($check_res['red18'] == "2") {echo "checked=checked";}?>> Interrupted
                           <input type="checkbox" class="radio_change red18" data-id="red18" value="3" <?php if ($check_res['red18'] == "3") {echo "checked=checked";}?>>Increased:
                          <?php echo text($check_res['red_input9']);?>
                           <input type="checkbox" class="radio_change red18" data-id="red18" value="4" <?php if ($check_res['red18'] == "4") {echo "checked=checked";}?>>Decreased:
                           <?php echo text($check_res['red_input10']);?><br>
                        
                           <b>Appetite:</b> &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red19" data-id="red19" value="1" <?php if ($check_res['red19'] == "1") {echo "checked=checked";}?>>Increased &nbsp;&nbsp;
                           <input type="checkbox" class="radio_change red19" data-id="red19" value="2" <?php if ($check_res['red19'] == "2") {echo "checked=checked";}?>>Decreased
                           <input type="checkbox" class="radio_change red19" data-id="red19" value="3" <?php if ($check_res['red19'] == "3") {echo "checked=checked";}?>>No Change
                           <input type="checkbox" class="radio_change red19" data-id="red19" value="4" <?php if ($check_res['red19'] == "4") {echo "checked=checked";}?>>Weight Loss
                            <?php echo text($check_res['red_input11']);?>&nbsp;&nbsp;
                           <input type="checkbox">Weight Gain
                            <?php echo text($check_res['red_input12']);?><br>
                           

                           <b>Eating Disorders:</b><br>
                           <b>Anorexia:</b> <?php echo text($check_res['red_input13']);?><br>
                           <b>Bulemia:</b> <?php echo text($check_res['red_input14']);?><br>
                           <b>Self Mutilation/Cutting Behaviors:</b> <?php echo text($check_res['red_input15']);?><br>
                        </td>
                     </tr>
                  </table>

                  
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td>Patient Name:   <?php echo text($check_res['pat_name7']);?></td>
                        <td>DOB: <?php echo $check_res['pat_dob7'] ?strstr($check_res['pat_dob7'], ' ', true): ''; ?></td>
                     </tr>
                  </table>
                  <b><u>Current Withdrawal Signs/Symptoms </u></b>
                  <hr>
                  <table style="width:100%" style="border:none">
                     <tr>
                        <td>
                        <?php
                            $sysm_check1=explode(',',$check_res['sysm_check1']);

                          ?>
                           
                           <input type="checkbox" class="sysm_check1" value="1" <?php echo in_array("1", $sysm_check1)?'checked=checked':''?>>Dilated pupils
                           <input type="checkbox" class="sysm_check1" value="2" <?php echo in_array("2", $sysm_check1)?'checked=checked':''?>>Nausea
                           <input type="checkbox" class="sysm_check1" value="3" <?php echo in_array("3", $sysm_check1)?'checked=checked':''?>>Vomiting
                           <input type="checkbox" class="sysm_check1" value="4" <?php echo in_array("4", $sysm_check1)?'checked=checked':''?>>Diarrhea
                           <input type="checkbox" class="sysm_check1" value="5" <?php echo in_array("5", $sysm_check1)?'checked=checked':''?>>abdominal cramps
                           <input type="checkbox" class="sysm_check1" value="6" <?php echo in_array("6", $sysm_check1)?'checked=checked':''?>>anxiety
                           <input type="checkbox" class="sysm_check1" value="7" <?php echo in_array("7", $sysm_check1)?'checked=checked':''?>>palpitations<br>
                           <input type="checkbox" class="sysm_check1" value="8" <?php echo in_array("8", $sysm_check1)?'checked=checked':''?>>irritability
                           <input type="checkbox" class="sysm_check1" value="9" <?php echo in_array("9", $sysm_check1)?'checked=checked':''?>>fearful
                           <input type="checkbox" class="sysm_check1" value="10" <?php echo in_array("10", $sysm_check1)?'checked=checked':''?>>depressed mood
                           <input type="checkbox" class="sysm_check1" value="11" <?php echo in_array("11", $sysm_check1)?'checked=checked':''?>>weakness
                           <input type="checkbox" class="sysm_check1" value="12" <?php echo in_array("12", $sysm_check1)?'checked=checked':''?>>fatigue
                           <input type="checkbox" class="sysm_check1" value="13" <?php echo in_array("13", $sysm_check1)?'checked=checked':''?>>restlessness
                           <input type="checkbox" class="sysm_check1" value="14" <?php echo in_array("14", $sysm_check1)?'checked=checked':''?>>tremors
                           <input type="checkbox" class="sysm_check1" value="15" <?php echo in_array("15", $sysm_check1)?'checked=checked':''?>>dizziness<br>
                           <input type="checkbox" class="sysm_check1" value="16" <?php echo in_array("16", $sysm_check1)?'checked=checked':''?>>headache
                           <input type="checkbox" class="sysm_check1" value="17" <?php echo in_array("17", $sysm_check1)?'checked=checked':''?>>werinikes syndrome
                           <input type="checkbox" class="sysm_check1" value="18" <?php echo in_array("18", $sysm_check1)?'checked=checked':''?>>poor coordination
                           <input type="checkbox" class="sysm_check1" value="19" <?php echo in_array("19", $sysm_check1)?'checked=checked':''?>>difficult concentration
                           <input type="checkbox" class="sysm_check1" value="20" <?php echo in_array("20", $sysm_check1)?'checked=checked':''?>>nystagmus<br>
                           <input type="checkbox" class="sysm_check1" value="21" <?php echo in_array("21", $sysm_check1)?'checked=checked':''?>>tongue  fasiculation
                           <input type="checkbox" class="sysm_check1" value="23" <?php echo in_array("23", $sysm_check1)?'checked=checked':''?>>cravings
                           <input type="checkbox" class="sysm_check1" value="24" <?php echo in_array("24", $sysm_check1)?'checked=checked':''?>>poor coordination
                           <input type="checkbox" class="sysm_check1" value="25" <?php echo in_array("25", $sysm_check1)?'checked=checked':''?>>memory change<br>
                           <input type="checkbox" class="sysm_check1" value="26" <?php echo in_array("26", $sysm_check1)?'checked=checked':''?>>photosensitivity
                           <input type="checkbox" class="sysm_check1" value="27" <?php echo in_array("27", $sysm_check1)?'checked=checked':''?>> sensitivity to noise/ taste
                           <input type="checkbox" class="sysm_check1" value="28" <?php echo in_array("28", $sysm_check1)?'checked=checked':''?>>numbness to body
                           <input type="checkbox" class="sysm_check1" value="29" <?php echo in_array("29", $sysm_check1)?'checked=checked':''?>>muscle cramps
                           <input type="checkbox" class="sysm_check1" value="30" <?php echo in_array("30", $sysm_check1)?'checked=checked':''?>>body aches<br>
                           <input type="checkbox" class="sysm_check1" value="31" <?php echo in_array("31", $sysm_check1)?'checked=checked':''?>>constipation
                           <input type="checkbox" class="sysm_check1" value="32" <?php echo in_array("32", $sysm_check1)?'checked=checked':''?>>hot/cold sweats
                           <input type="checkbox" class="sysm_check1" value="33" <?php echo in_array("33", $sysm_check1)?'checked=checked':''?>>diaphoretic
                           <input type="checkbox" class="sysm_check1" value="34" <?php echo in_array("34", $sysm_check1)?'checked=checked':''?>>change in appetite
                           <input type="checkbox" class="sysm_check1" value="35" <?php echo in_array("35", $sysm_check1)?'checked=checked':''?>>weight loss
                           <input type="checkbox" class="sysm_check1" value="36" <?php echo in_array("36", $sysm_check1)?'checked=checked':''?>>Memory loss
                           <input type="checkbox" class="sysm_check1" value="37" <?php echo in_array("37", $sysm_check1)?'checked=checked':''?>>auditory/ visual/  tactile hallucinations
                           <input type="checkbox" class="sysm_check1" value="38" <?php echo in_array("38", $sysm_check1)?'checked=checked':''?>>insomnia
                           <input type="checkbox" class="sysm_check1" value="39" <?php echo in_array("39", $sysm_check1)?'checked=checked':''?>>“skin crawling”
                           <input type="checkbox" class="sysm_check1" value="40" <?php echo in_array("40", $sysm_check1)?'checked=checked':''?>>joint discomfort
                           <input type="checkbox" class="sysm_check1" value="42" <?php echo in_array("41", $sysm_check1)?'checked=checked':''?>>constipation
                        </td>
                     </tr>
                  </table>
                  <hr>
                  <table style="border:1px solid black;width:100%" cellpadding="10" cellspacing="0">
                     <tr style="background-color:#bbbec147;">
                        <th colspan="6">
                           <center>PREGNANCY ASSESSMENT</center>
                        </th>
                     </tr>
                     <tr>
                        <td colspan="6">
                           <b>Did the patient have a pregnancy test completed in the office?</b>
                           <input type="checkbox" class="radio_change pat_check1" data-id="pat_check1" value="1" <?php if ($check_res['pat_check1'] == "1") {echo "checked=checked";}?>>Yes
                           <input type="checkbox" class="radio_change pat_check1" data-id="pat_check1" value="2" <?php if ($check_res['pat_check1'] == "2") {echo "checked=checked";}?>>No
                           <input type="checkbox" class="radio_change pat_check1" data-id="pat_check1" value="3" <?php if ($check_res['pat_check1'] == "3") {echo "checked=checked";}?>>N/A
                           <input type="checkbox" class="radio_change pat_check1" data-id="pat_check1" value="4" <?php if ($check_res['pat_check1'] == "4") {echo "checked=checked";}?>>LMP<br>
                           

                           <b>Results of HCG Test:</b>
                           <input type="checkbox" class="radio_change pat_check2" data-id="pat_check2" value="1" <?php if ($check_res['pat_check2'] == "1") {echo "checked=checked";}?>>Negative
                           <input type="checkbox" class="radio_change pat_check2" data-id="pat_check2" value="2" <?php if ($check_res['pat_check2'] == "2") {echo "checked=checked";}?>>Positive
                          
                        </td>
                     </tr>
                     <tr style="width:100%;border:none">
                        <td style="border-right:none;border-left:none;border-bottem:none;">Is the patient psychotic?</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;" ><input type="checkbox" class="radio_change pat_check3" data-id="pat_check3" value="1" <?php if ($check_res['pat_check3'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;" ><input type="checkbox" class="radio_change pat_check3" data-id="pat_check3" value="2" <?php if ($check_res['pat_check3'] == "2") {echo "checked=checked";}?>>No</td>
                        
                        <td style="border-right:none;border-left:none;border-bottem:none;">Is the patient sexually active?  </td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;"><input type="checkbox"  class="radio_change pat_check4" data-id="pat_check4" value="1" <?php if ($check_res['pat_check4'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:4%;border-bottem:none;"><input type="checkbox" class="radio_change pat_check4" data-id="pat_check4" value="2" <?php if ($check_res['pat_check4'] == "2") {echo "checked=checked";}?>>No</td>
                        
                     </tr>
                     <tr style="width:100%;border:none">
                        <td style="border-right:none;border-left:none;border-bottem:none;">Is the patient impulsive?</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check5" data-id="pat_check5" value="1" <?php if ($check_res['pat_check5'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check5" data-id="pat_check5" value="2" <?php if ($check_res['pat_check5'] == "2") {echo "checked=checked";}?>>No</td>
                        
                        <td style="border-right:none;border-left:none;border-bottem:none;">Does the patient use contraception?  </td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check6" data-id="pat_check6" value="1" <?php if ($check_res['pat_check6'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:4%;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check6" data-id="pat_check6" value="2" <?php if ($check_res['pat_check6'] == "2") {echo "checked=checked";}?>>No</td>
                        
 
                    </tr>
                     <tr style="width:100%;border:none">
                        <td style="border-right:none;border-left:none;border-bottem:none;">Is the patient mentally challenged?</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check7" data-id="pat_check7" value="1" <?php if ($check_res['pat_check7'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check7" data-id="pat_check7" value="2" <?php if ($check_res['pat_check7'] == "2") {echo "checked=checked";}?>>No</td>
                        

                        <td style="border-right:none;border-left:none;border-bottem:none;">Has the patient had a recent abortion?  </td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check8" data-id="pat_check8" value="1" <?php if ($check_res['pat_check8'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:4%;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check8" data-id="pat_check8" value="2" <?php if ($check_res['pat_check8'] == "2") {echo "checked=checked";}?>>No</td>
                        
                     </tr>
                     <tr style="width:100%;border:none">
                        <td style="border-right:none;border-left:none;border-bottem:none;">Is there a possibility your are pregnant?</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check9" data-id="pat_check9" value="1" <?php if ($check_res['pat_check9'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check9" data-id="pat_check9" value="2" <?php if ($check_res['pat_check9'] == "2") {echo "checked=checked";}?>>No</td>
                       

                        <td style="border-right:none;border-left:none;border-bottem:none;">Has the patient had a recent miscarriage  </td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check10" data-id="pat_check10" value="1" <?php if ($check_res['pat_check10'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:4%;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check10" data-id="pat_check10" value="2" <?php if ($check_res['pat_check10'] == "2") {echo "checked=checked";}?>>No</td>
                        

                     </tr>
                     <tr style="width:100%;border:none">
                        <td style="border-right:none;border-left:none;border-bottem:none;">Does the patient have a history of STD?</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check11" data-id="pat_check11" value="1" <?php if ($check_res['pat_check11'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check11" data-id="pat_check11" value="2" <?php if ($check_res['pat_check11'] == "2") {echo "checked=checked";}?>>No</td>
                        

                        <td style="border-right:none;border-left:none;border-bottem:none;">Does the patient have any children?  </td>
                        <td style="width:6%;border-right:none;border-left:none;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check12" data-id="pat_check12" value="1" <?php if ($check_res['pat_check12'] == "1") {echo "checked=checked";}?>>Yes</td>
                        <td style="width:4%;border-bottem:none;">
                        <input type="checkbox" class="radio_change pat_check12" data-id="pat_check12" value="2" <?php if ($check_res['pat_check12'] == "2") {echo "checked=checked";}?>>No</td>
                        

                     </tr>
                     <tr>
                        <td colspan="6">Based on the above data, the patient’s pregnancy status is assessed as:
                           <textarea style="width:100%;" class="notes" onkeyup="textAreaAdjust(this)" name="pregnecy_note" > <?php echo text($check_res['pregnecy_note']);?></textarea>
                        </td>
                     </tr>
                  </table>


                  
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr style="background-color:#bbbec147;">
                        <th>
                           <center>PAIN MANAGEMENT</center>
                        </th>
                     </tr>
                     <tr>
                        <td>
                           Inform the patient of the organization’s pain management philosophy:
                           <input type="checkbox" class="radio_change philosophy1" data-id="philosophy1" value="1" <?php if ($check_res['philosophy1'] == "1") {echo "checked=checked";}?>>Yes
                           <input type="checkbox" class="radio_change philosophy1" data-id="philosophy1" value="2" <?php if ($check_res['philosophy1'] == "2") {echo "checked=checked";}?>>No (if no, list reason)
                             <?php echo text($check_res['philosophy_input']);?><br>
                          
                           
                           <input type="checkbox" name="num_check1" value="1" <?php if ($check_res['num_check1'] == "1") {echo "checked=checked";}?>>FLACC Scale
                           <input type="checkbox" name="num_check2" value="1" <?php if ($check_res['num_check2'] == "1") {echo "checked=checked";}?>>Numeric Scale (0 – 10)
                           <input type="checkbox" name="num_check3" value="1" <?php if ($check_res['num_check3'] == "1") {echo "checked=checked";}?>>Wong-Baker Scale (Faces)<br>
                           
                           Do you have pain now?   
                           <input type="checkbox" class="radio_change pain1" data-id="pain1" value="1" <?php if ($check_res['pain1'] == "1") {echo "checked=checked";}?>>Yes
                           <input type="checkbox" class="radio_change pain1" data-id="pain1" value="2" <?php if ($check_res['pain1'] == "2") {echo "checked=checked";}?>>No &nbsp;&nbsp;
                          

                           Do you have chronic pain?  
                           <input type="checkbox" class="radio_change pain2" data-id="pain2" value="1" <?php if ($check_res['pain2'] == "1") {echo "checked=checked";}?>>Yes
                           <input type="checkbox" class="radio_change pain2" data-id="pain2" value="2" <?php if ($check_res['pain2'] == "2") {echo "checked=checked";}?>>No<br>
                           
                           
                           Where is your pain located
                            <?php echo text($check_res['pain_input1']);?><br>
                           What is your present pain intensity? (USE APPROPRIATE PAIN SCALE)
                             <?php echo text($check_res['pain_input2']);?><br>
                           What is acceptable level of pain? (USE APPROPRIATE PAIN SCALE)
                             <?php echo text($check_res['pain_input3']);?><br>
                           Describe the characteristics of the pain:
                            <?php echo text($check_res['pain_input4']);?><br>
                           Describe the onset and duration of the pain
                             <?php echo text($check_res['pain_input5']);?><br>
                           What relieves the pain?
                             <?php echo text($check_res['pain_input6']);?><br>
                           What causes or increases the pain?
                             <?php echo text($check_res['pain_input7']);?><br>
                           Effects of pain:
                            <?php echo text($check_res['pain_input8']);?><br>
                           Does the patient have any personal, cultural, spiritual or ethnic beliefs that would prevent participation in pain management?<br>

                           <input type="checkbox" class="radio_change pain3" data-id="pain3" value="1" <?php if ($check_res['pain3'] == "1") {echo "checked=checked";}?>>Yes
                           <input type="checkbox" class="radio_change pain3" data-id="pain3" value="2" <?php if ($check_res['pain3'] == "2") {echo "checked=checked";}?>>No  (if yes, refer patient to the treatment team as soon as possible for review)<br>
                           

                           RN Intervention <textarea style="width:100%;" class="notes" onkeyup="textAreaAdjust(this)" name="Intervention"> <?php echo text($check_res['Intervention']);?></textarea>
                        </td>
                     </tr>
                  </table>
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr style="background-color:#dedfe0;">
                        <td><b>Notes:</b><br>
                           <textarea style="width:100%;height: 150px; background-image: linear-gradient(to right, #bbbec147 10px, #bbbec147 10px), linear-gradient(to left, #bbbec147 10px, transparent 10px), repeating-linear-gradient(#bbbec147, #bbbec147 30px, #212529 30px, #212529 31px, #212529 31px) !important;" class="notes" onkeyup="textAreaAdjust(this)" name="logn_note"><?php echo $check_res['logn_note']??''; ?></textarea>
                        </td>
                     </tr>
                     </tr>
                     <tr style="background-color:#dedfe0;">
                        <td>
                           <b>
                              <center>NUTRITION ASSESSMENT</center>
                           </b>
                        </td>
                     </tr>
                     <tr>
                        <td>
                        <?php
                            $nutrition_ass=explode(',',$check_res['nutrition_ass']);

                          ?>
                         
                           <input type="checkbox" class="nutrition_ass" value="1" <?php echo in_array("1", $nutrition_ass)?'checked=checked':''?>>Well nourished
                           <input type="checkbox" class="nutrition_ass" value="2" <?php echo in_array("2", $nutrition_ass)?'checked=checked':''?>>Malnourished
                           <input type="checkbox" class="nutrition_ass" value="3" <?php echo in_array("3", $nutrition_ass)?'checked=checked':''?>>Obese
                           <input type="checkbox" class="nutrition_ass" value="4" <?php echo in_array("4", $nutrition_ass)?'checked=checked':''?>>Indigestion
                           <input type="checkbox" class="nutrition_ass" value="5" <?php echo in_array("5", $nutrition_ass)?'checked=checked':''?>>Food allergies<br>
                           <input type="checkbox" class="nutrition_ass" value="6" <?php echo in_array("6", $nutrition_ass)?'checked=checked':''?>>Coffee/tea intake> 5 cups/day
                           <input type="checkbox" class="nutrition_ass" value="7" <?php echo in_array("7", $nutrition_ass)?'checked=checked':''?>>Soda/caffeine product intake/day<br>
                           <input type="checkbox" class="nutrition_ass" value="8" <?php echo in_array("8", $nutrition_ass)?'checked=checked':''?>>Recent weight gain (amount):
                           <input type="checkbox" class="nutrition_ass" value="9" <?php echo in_array("9", $nutrition_ass)?'checked=checked':''?>>Binging/purging
                           <input type="checkbox" class="nutrition_ass" value="10" <?php echo in_array("10", $nutrition_ass)?'checked=checked':''?>>Laxative use
                           <input type="checkbox" class="nutrition_ass" value="11" <?php echo in_array("11", $nutrition_ass)?'checked=checked':''?>>Hx choking<br>
                           
                           Significant dental cavities   
                           <input type="checkbox" class="radio_change detal_cav" data-id="detal_cav" value="1" <?php if ($check_res['detal_cav'] == "1") {echo "checked=checked";}?>>No   
                           <input type="checkbox" class="radio_change detal_cav" data-id="detal_cav" value="2" <?php if ($check_res['detal_cav'] == "2") {echo "checked=checked";}?>>Yes<br>
                           <input type="checkbox" class="radio_change detal_cav" data-id="detal_cav" value="3" <?php if ($check_res['detal_cav'] == "3") {echo "checked=checked";}?>>Braces  
                           <input type="checkbox" class="radio_change detal_cav" data-id="detal_cav" value="4" <?php if ($check_res['detal_cav'] == "4") {echo "checked=checked";}?>>Retainers
                           
                           <br>
                           Determine whether the patient meets any of the following criteria:<br>
                           <input type="checkbox" class="radio_change criteria1" data-id="criteria1" value="1" <?php if ($check_res['criteria1'] == "1") {echo "checked=checked";}?>>Yes  &nbsp;&nbsp;&nbsp;&nbsp;   
                           <input type="checkbox" class="radio_change criteria1" data-id="criteria1" value="2" <?php if ($check_res['criteria1'] == "2") {echo "checked=checked";}?>>No   &nbsp;&nbsp;&nbsp;&nbsp;    Nausea, vomiting, diarrhea, for 3 or more days<br>
                           

                           <input type="checkbox" class="radio_change criteria2" data-id="criteria2" value="1" <?php if ($check_res['criteria2'] == "1") {echo "checked=checked";}?>>Yes  &nbsp;&nbsp;&nbsp;&nbsp; 
                           <input type="checkbox" class="radio_change criteria2" data-id="criteria2" value="2" <?php if ($check_res['criteria2'] == "2") {echo "checked=checked";}?>>No   &nbsp;&nbsp;&nbsp;&nbsp;  Difficulty swallowing<br>
                           
                           
                           <input type="checkbox" class="radio_change criteria3" data-id="criteria3" value="1" <?php if ($check_res['criteria3'] == "1") {echo "checked=checked";}?>>Yes  &nbsp;&nbsp;&nbsp;&nbsp; 
                           <input type="checkbox" class="radio_change criteria3" data-id="criteria3" value="2" <?php if ($check_res['criteria3'] == "2") {echo "checked=checked";}?>>No   &nbsp;&nbsp;&nbsp;&nbsp;  Unintentional weight loss (> 10 lbs in last 6 months)<br>
                           

                           <input type="checkbox" class="radio_change criteria4" data-id="criteria4" value="1" <?php if ($check_res['criteria4'] == "1") {echo "checked=checked";}?>>Yes  &nbsp;&nbsp;&nbsp;&nbsp; 
                           <input type="checkbox" class="radio_change criteria4" data-id="criteria4" value="2" <?php if ($check_res['criteria4'] == "2") {echo "checked=checked";}?>>No   &nbsp;&nbsp;&nbsp;&nbsp;  Active eating disorder, including laxative use<br>
                           

                           <input type="checkbox" class="radio_change criteria5" data-id="criteria5" value="1" <?php if ($check_res['criteria5'] == "1") {echo "checked=checked";}?>>Yes  &nbsp;&nbsp;&nbsp;&nbsp; 
                           <input type="checkbox" class="radio_change criteria5" data-id="criteria5" value="2" <?php if ($check_res['criteria5'] == "2") {echo "checked=checked";}?>>No   &nbsp;&nbsp;&nbsp;&nbsp;  New onset/uncontrolled diabetes<br>
                           
                           <br>
                           Favorite foods:  <?php echo text($check_res['fav_food1']);?><br>
                           Any additional comments: <?php echo text($check_res['fav_food2']);?><br>
                           <textarea  name="update_text" class="textarea_content" onkeyup="textAreaAdjust(this)" style="width: 100%;border:none;outline:none;overflow:hidden" name='textarea1'><?php echo $check_res['textarea1']??'T*If any other condition that the above is identified which may place the patient at potential nutritional risk, MD will be notified';?></textarea>
                        </td>
                     </tr>
                  </table>

                  

                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td>Patient Name:   <?php echo text($check_res['pat_name8']);?></td>
                        <td>DOB: <?php echo $check_res['pat_dob8'] ?strstr($check_res['pat_dob8'], ' ', true): ''; ?></td>
                     </tr>
                  </table>
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td></td>
                     </tr>
                     <tr>
                        <td>
                           <b>
                              <center>FUNCTIONAL STATUS</center>
                           </b>
                        </td>
                     </tr>
                     <tr>
                        <td>
                        <?php
                            $fun_status1=explode(',',$check_res['fun_status1']);

                          ?>
                           <input type="checkbox" class="fun_status1" value="1" <?php echo in_array("1", $fun_status1)?'checked=checked':''?>>Independent with ADLs
                           <input type="checkbox"  class="fun_status1" value="2" <?php echo in_array("2", $fun_status1)?'checked=checked':''?>>Needs prompting/encouragement
                           <input type="checkbox"  class="fun_status1" value="3" <?php echo in_array("3", $fun_status1)?'checked=checked':''?>>Needs partial assistance
                           <input type="checkbox"  class="fun_status1" value="4" <?php echo in_array("4", $fun_status1)?'checked=checked':''?>>Needs total assistance
                          
                        </td>
                     </tr>
                     <tr>
                        <th>
                           <center>SPIRITUAL/CULTURAL ASSESSMENT </center>
                        </th>
                     </tr>
                     <tr>
                        <td>
                           <b><u>Spiritual:</u></b><br>
                           What is your faith or belief? 
                            <?php echo text($check_res['spriritual1']);?><br>
                           What importance does faith have in your life? 
                             <?php echo text($check_res['spriritual2']);?><br>
                           Are you part of a spiritual or religious community? 
                             <?php echo text($check_res['spriritual3']);?><br>
                           Is this of support to you? 
                            <?php echo text($check_res['spriritual4']);?><br>
                           How would you like us to address these issues during this hospitalization? 
                              <?php echo text($check_res['spriritual5']);?><br>
                           <b><u>Cultural:</u></b><br>
                           Do you identify with any specific ethnic group? 
                           <?php echo text($check_res['spriritual6']);?><br>
                           Are there any specific cultural concerns that need to be addressed during this stay? 
                             <?php echo text($check_res['spriritual7']);?><br>
                        </td>
                     </tr>
                     <tr>
                        <th>
                           Is patient a known or suspected gang member?  
                           <input type="checkbox" class="radio_change member1" data-id="member1"  value="1" <?php if ($check_res['member1'] == "1") {echo "checked=checked";}?>>No      
                           <input type="checkbox" class="radio_change member1" data-id="member1"  value="2" <?php if ($check_res['member1'] == "2") {echo "checked=checked";}?>>Yes<br>
                           
                           <b>
                              <center>FIREARMS ASSESSMENT</center>
                           </b>
                           <br>
                           Does the patient have means of self-harm at home?   
                           <input type="checkbox" class="radio_change member2" data-id="member2"  value="1" <?php if ($check_res['member2'] == "1") {echo "checked=checked";}?>>No    
                           <input type="checkbox" class="radio_change member2" data-id="member2"  value="2" <?php if ($check_res['member2'] == "2") {echo "checked=checked";}?>>Yes ( if yes, complete below, MD must be informed)<br>
                           What type of means? 
                           <?php echo text($check_res['member1_input']);?> <br>
                           

                           Where is it (they) stored?  <?php echo text($check_res['strored']);?> <br>
                           Who will dispose of or safely store items before you are sent home? (name and phone #)   <?php  echo $check_res['strored2']?>
                        </th>
                     </tr>
                     <tr>
                        <td>
                           Notes:<br>
                           <textarea style="width:100%;height: 180px;" class="notes" onkeyup="textAreaAdjust(this)" name="text_area_2"><?php echo text($check_res['text_area_2']);?></textarea>
                        </td>
                     </tr>
                     </table>
                     <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td>Patient Name:   <?php echo text($check_res['pat_name9']);?></td>
                        <td>DOB: <?php echo $check_res['pat_dob9'] ?strstr($check_res['pat_dob9'], ' ', true): ''; ?></td>
                     </tr>
                  </table>

                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr style="background-color:#bbbec147;">
                        <th>
                           <center>SYSTEMS ASSESSMENT </center>
                        </th>
                     </tr>
                     <tr>
                        <td>
                           <b><u>NEUROLOGYICAL/SENSORY</u></b><br>
                           Pupils equal and reactive to light.  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           Normal Findings<input type="checkbox" <?php if ($check_res['normal_find_check'] == "1") {echo "checked=checked";}?>><br>
                           No parathesia, numbness, tremors, spasm, syncope or vertigo. Sensation intact.<br>
                           No headaches or visual disturbances.  Verbalization clear and understandable.<br>
                           <b><u>Abnormal Findings</u></b><br>
                           <input type="checkbox" name="ab_check1" value="1" <?php if ($check_res['ab_check1'] == "1") {echo "checked=checked";}?>>Visual Impairment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="ab_check2" value="1" <?php if ($check_res['ab_check2'] == "1") {echo "checked=checked";}?>>Hearing Impairment<br>
                            <input type="checkbox" name="ab_check3" value="1" <?php if ($check_res['ab_check3'] == "1") {echo "checked=checked";}?>>Eyeglasses/contacts &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="ab_check4" value="1" <?php if ($check_res['ab_check4'] == "1") {echo "checked=checked";}?>>Deaf &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="ab_check5" value="1" <?php if ($check_res['ab_check5'] == "1") {echo "checked=checked";}?>>Hard of hearing  R / L<br>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="ab_check6" value="1" <?php if ($check_res['ab_check6'] == "1") {echo "checked=checked";}?>>Hearing aids  R /L<br>
                           Other: <?php echo text($check_res['ab_input1']);?>
                           Other:    <?php echo text($check_res['ab_input2']);?>
                        </td>
                     </tr>

                     <tr>
                        <td>
                           <b><u>CARDOVASCULAR</u></b><br>
                           Heart rate regular. No edema.  No complaints of calf tenderness.
                           Normal Findings:  <input type="checkbox" name="card_check1" value="1" <?php if ($check_res['card_check1'] == "1") {echo "checked=checked";}?>><br>
                           <b><u>Abnormal Findings</u></b> <br>
                           <input type="checkbox" name="card_check2" value="1" <?php if ($check_res['card_check2'] == "1") {echo "checked=checked";}?>>Edema
                           <input type="checkbox" name="card_check3" value="1" <?php if ($check_res['card_check3'] == "1") {echo "checked=checked";}?>>Bruising
                           <input type="checkbox" name="card_check4" value="1" <?php if ($check_res['card_check4'] == "1") {echo "checked=checked";}?>>Calf Tenderness  R / L
                           <input type="checkbox" name="card_check5" value="1" <?php if ($check_res['card_check5'] == "1") {echo "checked=checked";}?>>Hemodialysis<br>
                           (location)<?php echo text($check_res['card_input1']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           (location) <?php echo text($check_res['card_input2']);?> <br>
                           <p style="margin:8px;">Other:  <?php echo text($check_res['card_input3']);?> </p>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <b><u>RESPIRATORY</u></b><br>
                           Respirations 10-20 minutes regular and unlabored at rest.  No clough/wheezing present.<br>
                           Chest expansion symmetrical.  Breathing room air without distress. No cyanosis.
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <b>Normal Findings: </b><input type="checkbox" name="respiration1" value="1" <?php if ($check_res['respiration1'] == "1") {echo "checked=checked";}?>><br>
                           <b><u>Abnormal Findings</u></b><br>
                           <input type="checkbox" name="respiration2" value="1" <?php if ($check_res['respiration2'] == "1") {echo "checked=checked";}?>>Cough &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="respiration3"  value="1" <?php if ($check_res['respiration3'] == "1") {echo "checked=checked";}?>>Inhaler  &nbsp;&nbsp;
                           <input type="checkbox" name="respiration4"  value="1" <?php if ($check_res['respiration4'] == "1") {echo "checked=checked";}?>>Nebulizer<br>
                           <input type="checkbox"  name="respiration5" value="1" <?php if ($check_res['respiration5'] == "1") {echo "checked=checked";}?>>Productive &nbsp;&nbsp;
                           <input type="checkbox"  name="respiration6" value="1" <?php if ($check_res['respiration6'] == "1") {echo "checked=checked";}?>>Non-productive<br>
                           Other:   <?php echo text($check_res['respiration_input']);?>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <b><u>GASTOINTESTINAL</u></b><br>
                           Abdomen flat, round and symmetrical.  No distention.<br>
                           Bowels move within own normal pattern and consistency.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <b><u>Normal Findings:</u></b><input type="checkbox" name="gas_check01" value="1" <?php if ($check_res['gas_check01'] == "1") {echo "checked=checked";}?>><br>
                           <b><u>Abnormal Findings:</u></b><br>
                           <input type="checkbox" name="gas_check1" value="1" <?php if ($check_res['gas_check1'] == "1") {echo "checked=checked";}?>>Diarrhea &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check2" value="1" <?php if ($check_res['gas_check2'] == "1") {echo "checked=checked";}?>>Constipation  &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check3" value="1" <?php if ($check_res['gas_check3'] == "1") {echo "checked=checked";}?>>Ostomy  &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check4" value="1" <?php if ($check_res['gas_check4'] == "1") {echo "checked=checked";}?>>Peg tube &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check5" value="1" <?php if ($check_res['gas_check5'] == "1") {echo "checked=checked";}?>>Distention &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check6" value="1" <?php if ($check_res['gas_check6'] == "1") {echo "checked=checked";}?>>Incontinence<br>
                           <input type="checkbox" name="gas_check7" value="1" <?php if ($check_res['gas_check7'] == "1") {echo "checked=checked";}?>>Other: 
                            <?php echo text($check_res['gas_check_input']);?>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <b><u>GENITOURINARY</u></b><br>
                           Able to empty bladder without dysuria.  Bladder not distended.  No frequency,<br>
                           Urgency, hesitancy, incontinence or nocturia.  No urethral bleeding.<br>
                           No vaginal bleeding or discharge. &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                           <b>Normal Findings</b><input type="checkbox" name="gas_check8" value="1" <?php if ($check_res['gas_check8'] == "1") {echo "checked=checked";}?>><br>
                           <b><u>Abnormal Findings:</u></b><br>
                           <input type="checkbox" name="gas_check9" value="1" <?php if ($check_res['gas_check9'] == "1") {echo "checked=checked";}?>>Frequency &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check10" value="1" <?php if ($check_res['gas_check10'] == "1") {echo "checked=checked";}?>>Urgency &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check11" value="1" <?php if ($check_res['gas_check11'] == "1") {echo "checked=checked";}?>>Burning &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check12" value="1" <?php if ($check_res['gas_check12'] == "1") {echo "checked=checked";}?>>Incontinence &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check13" value="1" <?php if ($check_res['gas_check13'] == "1") {echo "checked=checked";}?>>Catheter (location) <br>
                           <input type="checkbox" name="gas_check14" value="1" <?php if ($check_res['gas_check14'] == "1") {echo "checked=checked";}?>>Night time Enuresis<br>
                           <input type="checkbox" name="gas_check15" value="1" <?php if ($check_res['gas_check15'] == "1") {echo "checked=checked";}?>>Other
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <b><u>MUSCULOSKETAL</u></b><br>
                           Absence of inflammation, generalized swelling, joint tenderness or deformities.<br>
                           No muscle tenderness, inflammation, atrophy or weakness.  Full ROM. Ambulates.<br>
                           Without difficulty, steady gait.  No adaptive or assistive devices.
                           <b>Normal Findings</b><input type="checkbox" name="gas_check02" value="1" <?php if ($check_res['gas_check02'] == "1") {echo "checked=checked";}?>><br>
                           <b><u>Abnormal Findings:</u></b><br>
                           <input type="checkbox" name="gas_check16" value="1" <?php if ($check_res['gas_check16'] == "1") {echo "checked=checked";}?>>Paraplegic &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check17" value="1" <?php if ($check_res['gas_check17'] == "1") {echo "checked=checked";}?>>Hemiplegic &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check18" value="1" <?php if ($check_res['gas_check18'] == "1") {echo "checked=checked";}?>>Quadriplegic  &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check19" value="1" <?php if ($check_res['gas_check19'] == "1") {echo "checked=checked";}?>>Assistive devices   &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check20" value="1" <?php if ($check_res['gas_check20'] == "1") {echo "checked=checked";}?>>Amputations   (limb) &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" name="gas_check21" value="1" <?php if ($check_res['gas_check21'] == "1") {echo "checked=checked";}?>>R /L0 <br>
                           <input type="checkbox" name="gas_check22" value="1" <?php if ($check_res['gas_check22'] == "1") {echo "checked=checked";}?>>Recent injuries / fractures 
                            <?php echo text($check_res['gas_input_2']);?><br>
                        </td>
                     </tr>
                           </table>   

                           <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td colspan="2">
                           other: <?php echo text($check_res['gas_input_3']);?>
                        </td>
                     </tr>
                     <tr>
                        <td>Patient Name:   <?php echo text($check_res['pat_name10']);?></td>
                        <td>DOB:  <?php echo $check_res['pat_dob10'] ?strstr($check_res['pat_dob10'], ' ', true): ''; ?></td>
                     </tr>
                  </table>
                  <br>
                  <b><u>INTEGUMENTARY</u></b> <br>
                  <p><?php echo $check_res['update_textarea']??'Skin warm, dry and intact.  No jaundice.  No lesions or reddened areas.<br>';?></p>
                  <br>
                  <b>Oral mucous membranes pink and moist.  Nail beds pink. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Normal Findings:
                  <input type="checkbox" name="normal_find" value="1" <?php if ($check_res['normal_find'] == "1") {echo "checked=checked";}?>><br>
                  Abnormal Findings (Please use diagram code on appropriate area)</b><br>
                  <b><input type="checkbox" name='eczema' value="1" <?php if ($check_res['eczema'] == "1") {echo "checked=checked";}?>>History of eczema.</b><br><br>
                  <div class="row">
                     <div class="col-md-8">
                        <img src="../../forms/Nursing_admission_form/imag1.png">
                     </div>
                     <div class="col-md-4">
                        <table border="1" style="width:65%;">
                           <tr>
                              <th>DIAGRAM CODE:</th>
                           </tr>
                           <tr>
                              <th>B = Burn</th>
                           </tr>
                           <tr>
                              <th>C = Contusion</th>
                           </tr>
                           <tr>
                              <th>D = Decubitus/ulcer</th>
                           </tr>
                           <tr>
                              <th>E = Erythema</th>
                           </tr>
                           <tr>
                              <th>I = Incision</th>
                           </tr>
                           <tr>
                              <th>J = Body piercing</th>
                           </tr>
                           <tr>
                              <th>L = Laceration
                           <tr>
                              <th>P = Petechiae</th>
                           </tr>
                           <tr>
                              <th>R = Rash</th>
                           </tr>
                           <tr>
                              <th>S = Scar </th>
                           </tr>
                           <tr>
                              <th>T = Tattoo</th>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <br>
                  <b>Patient shows physical or behavioral signs of abuse</b>
                  <input type="checkbox" class="radio_change phy_abuse" data-id="phy_abuse" value="1" <?php if ($check_res['phy_abuse'] == "1") {echo "checked=checked";}?>>No  &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" class="radio_change phy_abuse" data-id="phy_abuse" value="2" <?php if ($check_res['phy_abuse'] == "2") {echo "checked=checked";}?>>Yes<br>

                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr style="background-color:#bbbec147;">
                        <td></td>
                     </tr>
                  </table>
                  <table style="width: 100%;">
                     <tr>
                        <th>
                           *Signs of Abuse
                        </th>
                     </tr>
                     <tr>
                     <?php
                            $sign_abuse1=explode(',',$check_res['sign_abuse1']);

                          ?>
                          
                        <td><input type="checkbox" class="sign_abuse1" value="1" <?php echo in_array("1", $sign_abuse1)?'checked=checked':''?>>Unexplained bruising </td>
                        <td><input type="checkbox" class="sign_abuse1" value="2" <?php echo in_array("2", $sign_abuse1)?'checked=checked':''?>>Multiple injuries in different stages of healing</td>
                     </tr>
                     <tr>
                        <td><input type="checkbox" class="sign_abuse1" value="3" <?php echo in_array("3", $sign_abuse1)?'checked=checked':''?>>Unexplained burn</td>
                        <td><input type="checkbox" class="sign_abuse1" value="4" <?php echo in_array("4", $sign_abuse1)?'checked=checked':''?>>Genital injury
                     </tr>
                     <tr>
                        <td><input type="checkbox" class="sign_abuse1" value="5" <?php echo in_array("5", $sign_abuse1)?'checked=checked':''?>>Unusual fearfulness
                        <td><input type="checkbox" class="sign_abuse1" value="6" <?php echo in_array("6", $sign_abuse1)?'checked=checked':''?>>Other:
                     </tr>
                     <tr>
                        <td><input type="checkbox" class="sign_abuse1" value="7" <?php echo in_array("7", $sign_abuse1)?'checked=checked':''?>>Story inconsistent with injury</td>
                     </tr>
                  </table>
                  <br>
                  <ul>
                     <li><b>Refer to Victim Abuse Guidelines</b></li>
                  </ul>
                  <br>
                  <hr>
                  <p><b>** According to patient, he/she has (see diagram) ↑</b></p>
                  <br>
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td>Patient Name:  <?php echo text($check_res['pat_name11']);?></td>
                        <td>DOB: <?php echo $check_res['pat_dob11'] ?strstr($check_res['pat_dob11'], ' ', true): ''; ?>
                    </td>
                     </tr>
                  </table>

                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <th>
                           <center>MENTAL STATUS EVALUATION (Continuation)</center>
                        </th>
                     </tr>
                     <tr>
                        <td>
                           <b>HALLUCINATIONS</b><br>
                          
                           <input type="checkbox" class="radio_change men_check1" data-id="men_check1" value="1" <?php if ($check_res['men_check1'] == "1") {echo "checked=checked";}?>>Denied &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check1" data-id="men_check1" value="2" <?php if ($check_res['men_check1'] == "2") {echo "checked=checked";}?>>Auditory &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check1" data-id="men_check1" value="3" <?php if ($check_res['men_check1'] == "3") {echo "checked=checked";}?>>Visual &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check1" data-id="men_check1" value="4" <?php if ($check_res['men_check1'] == "4") {echo "checked=checked";}?>>Olfactory  &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check1" data-id="men_check1" value="5" <?php if ($check_res['men_check1'] == "5") {echo "checked=checked";}?>>Tactile &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check1" data-id="men_check1" value="6" <?php if ($check_res['men_check1'] == "6") {echo "checked=checked";}?>>Command &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check1" data-id="men_check1" value="7" <?php if ($check_res['men_check1'] == "7") {echo "checked=checked";}?>>Gustatory/taste<br>
                           <input type="checkbox" class="radio_change men_check1" data-id="men_check1" value="8" <?php if ($check_res['men_check1'] == "8") {echo "checked=checked";}?>>Other:
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <b>DELUSIONS</b><br>
                           
                           <input type="checkbox" class="radio_change men_check2" data-id="men_check2" value="1" <?php if ($check_res['men_check2'] == "1") {echo "checked=checked";}?>>Denied    &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check2" data-id="men_check2" value="2" <?php if ($check_res['men_check2'] == "2") {echo "checked=checked";}?>>Grandiose   &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check2" data-id="men_check2" value="3" <?php if ($check_res['men_check2'] == "3") {echo "checked=checked";}?>>Persecutory  &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check2" data-id="men_check2" value="4" <?php if ($check_res['men_check2'] == "4") {echo "checked=checked";}?>>Somatic   &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check2" data-id="men_check2" value="5" <?php if ($check_res['men_check2'] == "5") {echo "checked=checked";}?>>Religious  &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check2" data-id="men_check2" value="6" <?php if ($check_res['men_check2'] == "6") {echo "checked=checked";}?>>Paranoid<br>
                           <input type="checkbox" class="radio_change men_check2" data-id="men_check2" value="7" <?php if ($check_res['men_check2'] == "7") {echo "checked=checked";}?>>Other:
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <b>SLEEP</b><br>
                           
                           <input type="checkbox" class="radio_change men_check3" data-id="men_check3" value="1" <?php if ($check_res['men_check3'] == "1") {echo "checked=checked";}?>>Normal   &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check3" data-id="men_check3" value="2" <?php if ($check_res['men_check3'] == "2") {echo "checked=checked";}?>>Restless  &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check3" data-id="men_check3" value="3" <?php if ($check_res['men_check3'] == "3") {echo "checked=checked";}?>>Difficulty falling asleep   &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check3" data-id="men_check3" value="4" <?php if ($check_res['men_check3'] == "4") {echo "checked=checked";}?>>Difficulty staying asleep  &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check3" data-id="men_check3" value="5" <?php if ($check_res['men_check3'] == "5") {echo "checked=checked";}?>>Nightmares<br>
                           <input type="checkbox" class="radio_change men_check3" data-id="men_check3" value="6" <?php if ($check_res['men_check3'] == "6") {echo "checked=checked";}?>>Medications used for sleep <br>
                           <input type="checkbox" class="radio_change men_check3" data-id="men_check3" value="7" <?php if ($check_res['men_check3'] == "7") {echo "checked=checked";}?>>Rituals to assist sleep<br>
                           Are sleep issues
                           
                           <input type="checkbox" class="radio_change men_check4" data-id="men_check4" value="8" <?php if ($check_res['men_check4'] == "8") {echo "checked=checked";}?>>chronic  &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check4" data-id="men_check4" value="9" <?php if ($check_res['men_check4'] == "9") {echo "checked=checked";}?>>recent &nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <b>COPING STYLES</b><br>
                           Strives toward mastery/control    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          
                           <input type="checkbox" class="radio_change men_check5" data-id="men_check5" value="1" <?php if ($check_res['men_check5'] == "1") {echo "checked=checked";}?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check5" data-id="men_check5" value="2" <?php if ($check_res['men_check5'] == "2") {echo "checked=checked";}?>>No   &nbsp;&nbsp;&nbsp;&nbsp;
                           Capacity to develop relationship with staff        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           
                           <input type="checkbox" class="radio_change men_check6" data-id="men_check6" value="1" <?php if ($check_res['men_check6'] == "1") {echo "checked=checked";}?>>Yes    &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check6" data-id="men_check6" value="2" <?php if ($check_res['men_check6'] == "2") {echo "checked=checked";}?>>No<br>
                           Capacity to express feelings/emotions    &nbsp;&nbsp;&nbsp;&nbsp;
                          
                           <input type="checkbox" class="radio_change men_check7" data-id="men_check7" value="1" <?php if ($check_res['men_check7'] == "1") {echo "checked=checked";}?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check7" data-id="men_check7" value="2" <?php if ($check_res['men_check7'] == "2") {echo "checked=checked";}?>>No     &nbsp;&nbsp;&nbsp;&nbsp;
                           Tolerated separation from parents (age appropriate)  &nbsp;&nbsp;&nbsp;&nbsp;
                           
                           <input type="checkbox" class="radio_change men_check8" data-id="men_check8" value="1" <?php if ($check_res['men_check8'] == "1") {echo "checked=checked";}?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="checkbox" class="radio_change men_check8" data-id="men_check8" value="1" <?php if ($check_res['men_check8'] == "1") {echo "checked=checked";}?>>No
                        </td>
                     </tr>
                     <tr style="background-color:#bbbec147;">
                        <th>
                           <center>EDUCATIONAL ASSESSMENT</center>
                        </th>
                     </tr>
                     <tr>
                        <td>
                           <b><u>HIGHEST LEVEL OF EDUCATION</u></b><br>
                           
                           <input type="checkbox" class="radio_change high_edu" data-id="high_edu" value="1" <?php if ($check_res['high_edu'] == "1") {echo "checked=checked";}?>>Elementary &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="radio_change high_edu" data-id="high_edu" value="2" <?php if ($check_res['high_edu'] == "2") {echo "checked=checked";}?>>Junior High School &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="radio_change high_edu" data-id="high_edu" value="3" <?php if ($check_res['high_edu'] == "3") {echo "checked=checked";}?>>High School  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="radio_change high_edu" data-id="high_edu" value="4" <?php if ($check_res['high_edu'] == "4") {echo "checked=checked";}?>>Technical/Vocational &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="radio_change high_edu" data-id="high_edu" value="5" <?php if ($check_res['high_edu'] == "5") {echo "checked=checked";}?>>  College<br>
                           <input type="checkbox" class="radio_change high_edu" data-id="high_edu" value="6" <?php if ($check_res['high_edu'] == "6") {echo "checked=checked";}?>>No formal Education  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="radio_change high_edu" data-id="high_edu" value="7" <?php if ($check_res['high_edu'] == "7") {echo "checked=checked";}?>>Unknown
                           Grade <?php echo text($check_res['grade1']);?>     Grade average (A’s B’s C’s; etc.) <br>
                           Is the patient classified?
                          
                           <input type="checkbox" class="radio_change pat_class" data-id="pat_class" value="1" <?php if ($check_res['pat_class'] == "1") {echo "checked=checked";}?>>No
                           <input type="checkbox" class="radio_change pat_class" data-id="pat_class" value="1" <?php if ($check_res['pat_class'] == "1") {echo "checked=checked";}?>>Yes
                           Favorite subjects:
                            <?php echo text($check_res['pat_class_input']);?><br>
                           <br><br>
                           <b><u>SPECIFIC BARRIERS TO LEARNING</u></b><br>
                           <?php
                            $spec_barr=explode(',',$check_res['spec_barr']);

                          ?>
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Fatigue or pain  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Auditory Impairment  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Learning Disability &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Anxiety<br>
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Physical Disability &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Speech Impairment   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Religious          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Depression<br>
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Lack of Motivation   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Visual Impairment   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Dementia        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Psychosis<br>
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>>Language          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="spec_barr" value="1" <?php echo in_array("1", $spec_barr)?'checked=checked':''?>> Substance Use/ Dependence <br>
                           
                           *If interpreter services are needed, identify type of service:
                            <?php echo text($check_res['spec_barr_input']);?><br>
                        </td>
                     </tr>
                     <tr>
                        <td>
                        <?php
                            $learning_menthod=explode(',',$check_res['learning_menthod']);

                          ?>
                           <b><u>LEARNER’S PREFERRED METHOD OF LEARNING</u></b><br>
                          
                           <input type="checkbox" class="learning_menthod" value="1" <?php echo in_array("1", $learning_menthod)?'checked=checked':''?>>Written Material &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="learning_menthod"  value="2" <?php echo in_array("2", $learning_menthod)?'checked=checked':''?>>Verbal Instructions  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="learning_menthod"  value="3" <?php echo in_array("3", $learning_menthod)?'checked=checked':''?>>Vudio/Visual Aids  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox"  class="learning_menthod" value="4" <?php echo in_array("4", $learning_menthod)?'checked=checked':''?>>Discussion<br>

                           Do you use alternative methods for learning?
                           
                           <input type="checkbox" class="radio_change learn_check1" data-id="learn_check1"  value="1" <?php if ($check_res['learn_check1'] == "1") {echo "checked=checked";}?>>No  &nbsp; &nbsp;
                           <input type="checkbox" class="radio_change learn_check1" data-id="learn_check1"  value="2" <?php if ($check_res['learn_check1'] == "2") {echo "checked=checked";}?>>Yes  &nbsp; &nbsp; &nbsp; If yes,<br>

                           Have they been helpful?
                           
                           <input type="checkbox" class="radio_change help1" data-id="help1"  value="1" <?php if ($check_res['help1'] == "1") {echo "checked=checked";}?>>No  &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="radio_change help1" data-id="help1"  value="2" <?php if ($check_res['help1'] == "2") {echo "checked=checked";}?>>Yes<br>
                           <br><br>
                           <b><u>EDUCATIONAL NEEDS ASSESSMENT</u></b><br>
                           <?php
                            $edu_ass1=explode(',',$check_res['edu_ass1']);

                          ?>
                           
                           <input type="checkbox" class="edu_ass1"  value="1" <?php echo in_array("1", $edu_ass1)?'checked=checked':''?>>Medication Mgmt. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="edu_ass1"  value="2" <?php echo in_array("2", $edu_ass1)?'checked=checked':''?>>Disease Process &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="edu_ass1"  value="3" <?php echo in_array("3", $edu_ass1)?'checked=checked':''?>>Tests    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="edu_ass1"  value="4" <?php echo in_array("4", $edu_ass1)?'checked=checked':''?>>Food/Drug Interactions<br>
                           <input type="checkbox" class="edu_ass1"  value="5" <?php echo in_array("5", $edu_ass1)?'checked=checked':''?>>Pain Mgmt.   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="edu_ass1"  value="6" <?php echo in_array("6", $edu_ass1)?'checked=checked':''?>>Plan of Care  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="edu_ass1"  value="7" <?php echo in_array("7", $edu_ass1)?'checked=checked':''?>>Equipment    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="edu_ass1"  value="8" <?php echo in_array("8", $edu_ass1)?'checked=checked':''?>>Nutrition   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                           <input type="checkbox" class="edu_ass1"  value="9" <?php echo in_array("9", $edu_ass1)?'checked=checked':''?>>Discharge Planning<br>
                           <input type="checkbox" class="edu_ass1"  value="10" <?php echo in_array("10", $edu_ass1)?'checked=checked':''?>>other
                        </td>
                     </tr>
                  </table>
                  <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td>Patient Name:  <?php echo text($check_res['pat_name12']);?></td>
                        <td>DOB:  <?php echo $check_res['pat_dob12'] ?strstr($check_res['pat_dob12'], ' ', true): ''; ?></td>
                     </tr>
                  </table>
                  <br>
                  <table style="width:100%;border:1px" class="table table-bordered">
                     <tr style="background-color:#bbbec147;">
                        <th colspan="2">
                           <center>NURSING ASSESSMENT SUMMARY</center>
                        </th>
                     </tr>
                     <tr>
                        <td style="border-bottem:none;">
                        <?php
                            $nurse_ass=explode(',',$check_res['nurse_ass']);

                          ?>
                           
                           <input type="checkbox" class="nurse_ass"  value="1" <?php echo in_array("1", $nurse_ass)?'checked=checked':''?>><b>Communication deficits</b><br>
                           <input type="checkbox" class="nurse_ass"  value="2" <?php echo in_array("2", $nurse_ass)?'checked=checked':''?>>Hearing &nbsp;&nbsp;
                           <input type="checkbox" class="nurse_ass"  value="3" <?php echo in_array("3", $nurse_ass)?'checked=checked':''?>>Visual &nbsp;&nbsp;
                           <input type="checkbox" class="nurse_ass"  value="4" <?php echo in_array("4", $nurse_ass)?'checked=checked':''?>>Language<br>
                           <br>  <br>
                           <input type="checkbox" class="nurse_ass"  value="5" <?php echo in_array("5", $nurse_ass)?'checked=checked':''?>><b>Fall risk</b><br>
                           <input type="checkbox" class="nurse_ass"  value="6" <?php echo in_array("6", $nurse_ass)?'checked=checked':''?>>Impaired mobility r/t   <br> <br><br>
                           <input type="checkbox" class="nurse_ass"  value="7" <?php echo in_array("7", $nurse_ass)?'checked=checked':''?>><b>Dangerousness</b><br>
                           <input type="checkbox" class="nurse_ass"  value="8" <?php echo in_array("8", $nurse_ass)?'checked=checked':''?>>Self-injury  &nbsp;&nbsp;        <input type="checkbox">Suicidal thoughts<br>
                           <input type="checkbox" class="nurse_ass"  value="9" <?php echo in_array("9", $nurse_ass)?'checked=checked':''?>>Suicidal plans  &nbsp;&nbsp;   <input type="checkbox">Assaultive/violent behavior<br>
                           <br><br>
                           <input type="checkbox" class="nurse_ass"  value="10" <?php echo in_array("10", $nurse_ass)?'checked=checked':''?>><b>Substance abuse</b><br>
                           <input type="checkbox" class="nurse_ass"  value="11" <?php echo in_array("11", $nurse_ass)?'checked=checked':''?>>Current abuse &nbsp;&nbsp;    <input type="checkbox">History of abuse <br>
                           <input type="checkbox" class="nurse_ass"  value="12" <?php echo in_array("12", $nurse_ass)?'checked=checked':''?>>Current withdrawal symptoms<br>
                           <input type="checkbox" class="nurse_ass"  value="13" <?php echo in_array("13", $nurse_ass)?'checked=checked':''?>>History of withdrawal <br>
                           <input type="checkbox" class="nurse_ass"  value="14" <?php echo in_array("14", $nurse_ass)?'checked=checked':''?>>History of seizures r/t withdrawal<br>
                           <br><br>
                           <input type="checkbox" class="nurse_ass"  value="15" <?php echo in_array("15", $nurse_ass)?'checked=checked':''?>><b>Pain r/t</b> <br>
                           <input type="checkbox" class="nurse_ass"  value="16" <?php echo in_array("16", $nurse_ass)?'checked=checked':''?>>Acute pain r/t <br>
                           <input type="checkbox" class="nurse_ass"  value="17" <?php echo in_array("17", $nurse_ass)?'checked=checked':''?>>Chronic pain r/t <br>
                           <br><br>
                           <input type="checkbox" class="nurse_ass"  value="18" <?php echo in_array("18", $nurse_ass)?'checked=checked':''?>><b>Altered nutrition r/t </b><br>
                           <br><br>
                           <input type="checkbox" class="nurse_ass"  value="19" <?php echo in_array("19", $nurse_ass)?'checked=checked':''?>><b>Altered health maintenance</b><br>
                           <input type="checkbox" class="nurse_ass"  value="20" <?php echo in_array("20", $nurse_ass)?'checked=checked':''?>>Elimination r/t  <br>
                           <input type="checkbox" class="nurse_ass"  value="21" <?php echo in_array("21", $nurse_ass)?'checked=checked':''?>>Respiration r/t  <br>
                           <input type="checkbox" class="nurse_ass"  value="22" <?php echo in_array("22", $nurse_ass)?'checked=checked':''?>>Cardiac r/t   <br>
                           <br><br><br>
                           <input type="checkbox" class="nurse_ass"  value="23" <?php echo in_array("23", $nurse_ass)?'checked=checked':''?>><b>SNAP</b> <br>
                           <input type="checkbox" class="nurse_ass"  value="24" <?php echo in_array("24", $nurse_ass)?'checked=checked':''?>>Strengths <br>
                           <input type="checkbox" class="nurse_ass"  value="25" <?php echo in_array("25", $nurse_ass)?'checked=checked':''?>>Weaknesses <br>
                           <input type="checkbox" class="nurse_ass"  value="26" <?php echo in_array("26", $nurse_ass)?'checked=checked':''?>>Individual needs <br>
                           <input type="checkbox" class="nurse_ass"  value="27" <?php echo in_array("27", $nurse_ass)?'checked=checked':''?>>Urgent needs <br>
                           <input type="checkbox" class="nurse_ass"  value="28" <?php echo in_array("28", $nurse_ass)?'checked=checked':''?>>Goal(s) <br>
                        </td>
                        <td style="border-bottem:none;">
                           <input type="checkbox" class="nurse_ass"  value="29" <?php echo in_array("29", $nurse_ass)?'checked=checked':''?>><b>Altered health maintenance (continued)</b><br>
                           <input type="checkbox" class="nurse_ass"  value="30" <?php echo in_array("30", $nurse_ass)?'checked=checked':''?>>GI r/t <br>
                           <input type="checkbox" class="nurse_ass"  value="31" <?php echo in_array("31", $nurse_ass)?'checked=checked':''?>>Circulatory r/t <br>
                           <input type="checkbox" class="nurse_ass"  value="32" <?php echo in_array("32", $nurse_ass)?'checked=checked':''?>>Neurological r/t <br>
                           <input type="checkbox" class="nurse_ass"  value="33" <?php echo in_array("33", $nurse_ass)?'checked=checked':''?>>Impaired skin integrity r/t  <br>
                           <input type="checkbox" class="nurse_ass"  value="34" <?php echo in_array("34", $nurse_ass)?'checked=checked':''?>>Other    <br>
                           <br>  <br>
                           <input type="checkbox" class="nurse_ass"  value="35" <?php echo in_array("35", $nurse_ass)?'checked=checked':''?>><b>Mood/affect </b> <br>
                           <input type="checkbox" class="nurse_ass"  value="36" <?php echo in_array("36", $nurse_ass)?'checked=checked':''?>>Depressed <br>
                           <input type="checkbox" class="nurse_ass"  value="37" <?php echo in_array("37", $nurse_ass)?'checked=checked':''?>>Anxious <br>
                           <input type="checkbox" class="nurse_ass"  value="38" <?php echo in_array("38", $nurse_ass)?'checked=checked':''?>>Manic <br>
                           <br>  <br>
                           <input type="checkbox" class="nurse_ass"  value="39" <?php echo in_array("39", $nurse_ass)?'checked=checked':''?>><b>Thought process</b> <br>
                           <input type="checkbox" class="nurse_ass"  value="40" <?php echo in_array("40", $nurse_ass)?'checked=checked':''?>>Thought blocking  <br>
                           <input type="checkbox" class="nurse_ass"  value="41" <?php echo in_array("41", $nurse_ass)?'checked=checked':''?>>Hallucinations <br>
                           <input type="checkbox" class="nurse_ass"  value="42" <?php echo in_array("42", $nurse_ass)?'checked=checked':''?>>Memory deficits <br>
                           <input type="checkbox" class="nurse_ass"  value="43" <?php echo in_array("43", $nurse_ass)?'checked=checked':''?>>Paranoia <br>
                           <input type="checkbox" class="nurse_ass"  value="44" <?php echo in_array("44", $nurse_ass)?'checked=checked':''?>>Other  <br>
                           <br>  <br>  <br>
                           <input type="checkbox" class="nurse_ass"  value="45" <?php echo in_array("45", $nurse_ass)?'checked=checked':''?>> Sleep disturbance r/t  <br>
                           <input type="checkbox" class="nurse_ass"  value="46" <?php echo in_array("46", $nurse_ass)?'checked=checked':''?>>Non-compliance r/t   <br>
                           <input type="checkbox" class="nurse_ass"  value="47" <?php echo in_array("47", $nurse_ass)?'checked=checked':''?>>Self care deficit r/t   <br>
                           <input type="checkbox" class="nurse_ass"  value="48" <?php echo in_array("48", $nurse_ass)?'checked=checked':''?>>High Risk for Abuse/Neglect  <br>
                        </td>
                     </tr>
                     <tr style="background-color:#bbbec147;">
                        <td colspan="2"></td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           RN Summary: <br>
                           <p><?php echo text($check_res['summary_notern']);?></p>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <b>Signature:</b>
                           <?php
                            if($check_res['sign1']!=''){
                                echo '<img src='.$check_res['sign1'].' style="width:20%;height:40px;" >';
                            } 
                            ?>
                          
                           Date: <?php echo $check_res['sign_date1'] ?strstr($check_res['sign_date1'], ' ', true): ''; ?> &nbsp;&nbsp;&nbsp;&nbsp; 
                           <b>Time:</b><?php echo text($check_res['sign_time1']);?>
                        </td>
                     </tr>
                  </table>

                  
          <table style="border:1px solid black;width:100%" class="table table-bordered">
                     <tr>
                        <td>Patient Name:  <?php echo text($check_res['pat_name13']);?></td>
                        <td>DOB: <?php echo $check_res['pat_dob13'] ?strstr($check_res['pat_dob13'], ' ', true): ''; ?></td>
                     </tr>
                  </table>
                  <br>
                  <b><u>Admission Note:</u></b><br>
                  <p><?php echo text($check_res['admission_note1']);?></p>
                  <br>
                  <table style="width:100%;">
                     <tr>
                        <td> Nurse Signature/Credentials:
                        <?php
                            if(check_res['sign2']!=''){
                                echo '<img src='.$check_res['sign2'].' style="width:20%;height:40px;" >';
                            } 
                            ?> 
                        </td>
                        <td>Date/Time:
                           <?php echo text($check_res['date_time']);?>
                        </td>
                     </tr>
                  </table>


<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("admission form");
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

$mpdf->Output('test.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();

