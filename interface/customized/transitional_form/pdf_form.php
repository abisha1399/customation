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
$transitonal_data = $formid ? formFetch("form_transitional_plan", $formid) : array();

use OpenEMR\Core\Header;
// $mpdf = new mPDF('utf-8','A5-P',8, 10,10,10, 75, 30, 4, 10);
$mpdf = new mPDF();
?>
<body id='body' class='body'>
<?php

ob_start();
?><br />
    <h1>Transitional Plan</h1>
    <?php
                                $client_information = json_decode($transitonal_data['client_information']);
                                $client_strength    = json_decode($transitonal_data['client_strength']);

                            ?>
    <b>1. Client Information</b><br>
                            <table class="table" style="width:100%" border="1">
                                    <tr>
                                        <td>Client Name:  <?php echo $client_information->client_name;?></td>
                                        <td>Date of Discharge DETOX: <?php echo isset($client_information->discharage_detox)&&$client_information->discharage_detox!=''?$client_information->discharage_detox:'';?></td>
                                    </tr>
                                    <tr>
                                        <td>DOA:  <?php echo isset($client_information->DOA)&&$client_information->DOA!=''?$client_information->DOA:'';?></td>
                                        <td>Date of Discharge PHP:<?php echo isset($client_information->discharge_php)&&$client_information->discharge_php!=''?$client_information->discharge_php:'';?></td>
                                    </tr>
                                    <tr>
                                        <td>DETOX Treatment Plan:<?php echo isset($client_information->detox_treatment_plan)&&$client_information->detox_treatment_plan!=''?$client_information->detox_treatment_plan:'';?></td>
                                        <td>PHP Treatment Plan: <?php echo isset($client_information->php_treatment_plan)&&$client_information->php_treatment_plan!=''?$client_information->php_treatment_plan:'';?></td>
                                    </tr>

                            </table>
                            <br>
                            <b>2. Client Strengths and abilities</b><br>
                            <table class="table" style="width:100%" border="1">
                                    <tr>
                                        <td>Client reports their strength as  <?php echo isset($client_information->client_strength)&&$client_information->client_strength!=''?$client_information->client_strength:'';?><br>
                                            Client reports their ability as: <?php echo isset($client_information->client_ability)&&$client_information->client_ability!=''?$client_information->client_ability:'';?>
                                        </td>
                                    </tr>
                            </table>
                            <br>
                            <b>3.Client’s needs and Preferences:</b><br>
                            <table class="table" style="width:100%" border="1">
                                    <tr>
                                        <td>Client reports their need is to maintain abstinence from <?php echo isset($transitonal_data['client_need'])?$transitonal_data['client_need']:'';?><br>
                                        Client reports no preferences in regards to male/female counselor or individual/group therapy.
                                        </td>
                                    </tr>
                            </table>
                            <br>
                            <b>4.Substance Use Disorder:</b><br>
                            <table class="table" style="width:100%" border="1">
                                    <tr>
                                        <td><?php echo isset($transitonal_data['substance_disorder'])?$transitonal_data['substance_disorder']:'';?>moderate, in post-acute withdrawal.
                                        </td>
                                    </tr>
                            </table>

                            <?php
                            $transitonal_plan = json_decode($transitonal_data['transitinal_plan']);
                            ?>
                            <p>Transitional Plan for Continuing Care:</p>
                            <br>
                            <table cellpadding="10" cellspacing="0" style="width:100%;border:0">
<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id='TP_hh' <?php echo isset($transitonal_plan->halfway_house)&&$transitonal_plan->halfway_house=='yes'?'checked=checked':'';?>></td>
    <td>Halfway House:	</td>
    <td><input type ='checkbox'  class="checkbox-radio halfway_house" data-id='halfway_house' value="accepted" <?php echo isset($transitonal_plan->halfway_house_data)&&$transitonal_plan->halfway_house=='yes'&&$transitonal_plan->halfway_house_data=='accepted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox'  class="checkbox-radio halfway_house" data-id='halfway_house'  value="denied" <?php echo isset($transitonal_plan->halfway_house_data)&&$transitonal_plan->halfway_house=='yes'&&$transitonal_plan->halfway_house_data=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox'  class="checkbox-radio halfway_house" data-id='halfway_house'  value="n/a" <?php echo isset($transitonal_plan->halfway_house_data)&&$transitonal_plan->halfway_house=='yes'&&$transitonal_plan->halfway_house_data=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>

<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id='TP_IO' <?php echo isset($transitonal_plan->inpatient_other)&&$transitonal_plan->inpatient_other=='yes'?'checked=checked':'';?>></td>
    <td>Inpatient other:	</td>
    <td><input type ='checkbox'  value="accepted" class="checkbox-radio inpatient_other" data-id='inpatient_other' value="accepted" <?php echo isset($transitonal_plan->inpatient_other_val)&&$transitonal_plan->inpatient_other=='yes'&&$transitonal_plan->inpatient_other_val=='accepted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox'  value="deneid" class="checkbox-radio inpatient_other" data-id='inpatient_other' value="denied" <?php echo isset($transitonal_plan->inpatient_other_val)&&$transitonal_plan->inpatient_other=='yes'&&$transitonal_plan->inpatient_other_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' value="n/a" class="checkbox-radio inpatient_other" data-id='inpatient_other' value="n/a" <?php echo isset($transitonal_plan->inpatient_other_val)&&$transitonal_plan->inpatient_other=='yes'&&$transitonal_plan->inpatient_other_val=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>

<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id='TP_INdet' <?php echo isset($transitonal_plan->inpatient_detox)&&$transitonal_plan->inpatient_detox=='yes'?'checked=checked':'';?>></td>
    <td>	Inpatient Detox:		</td>
    <td><input type ='checkbox' class="checkbox-radio inpatinet_detox" data-id="inpatinet_detox"  value="accepted" <?php echo isset($transitonal_plan->inpatient_detox_val)&&$transitonal_plan->inpatient_detox=='yes'&&$transitonal_plan->inpatient_detox_val=='accepted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox' class="checkbox-radio inpatinet_detox" data-id="inpatinet_detox" value="denied" <?php echo isset($transitonal_plan->inpatient_detox_val)&&$transitonal_plan->inpatient_detox=='yes'&&$transitonal_plan->inpatient_detox_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio inpatinet_detox" data-id="inpatinet_detox" value="n/a" <?php echo isset($transitonal_plan->inpatient_detox_val)&&$transitonal_plan->inpatient_detox=='yes'&&$transitonal_plan->inpatient_detox_val=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>
<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id='TP_partial' <?php echo isset($transitonal_plan->partial_care)&&$transitonal_plan->partial_care=='yes'?'checked=checked':'';?>></td>
    <td>Partial Care Program:	</td>
    <td><input type ='checkbox' class="checkbox-radio partial_care" data-id="partial_care" value="accepted" <?php echo isset($transitonal_plan->partial_care_val)&&$transitonal_plan->partial_care=='yes'&&$transitonal_plan->partial_care_val=='accepted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox' class="checkbox-radio partial_care" data-id="partial_care" value="denied" <?php echo isset($transitonal_plan->partial_care_val)&&$transitonal_plan->partial_care=='yes'&&$transitonal_plan->partial_care_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio partial_care" data-id="partial_care" value="n/a" <?php echo isset($transitonal_plan->partial_care_val)&&$transitonal_plan->partial_care=='yes'&&$transitonal_plan->partial_care_val=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>
<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id='TP_co_occure' <?php echo isset($transitonal_plan->cooccure_partial_care)&&$transitonal_plan->cooccure_partial_care=='yes'?'checked=checked':'';?>></td>
    <td>Co-Occurring Partial Care Program:</td>
    <td><input type ='checkbox' class="checkbox-radio co-occoure" data-id="co-occoure" value="accepted" <?php echo isset($transitonal_plan->cooccure_partial_care_val)&&$transitonal_plan->cooccure_partial_care=='yes'&&$transitonal_plan->cooccure_partial_care_val=='accepeted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox' class="checkbox-radio co-occoure" data-id="co-occoure" value="denied" <?php echo isset($transitonal_plan->cooccure_partial_care_val)&&$transitonal_plan->cooccure_partial_care=='yes'&&$transitonal_plan->cooccure_partial_care_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio co-occoure" data-id="co-occoure" value="n/a" <?php echo isset($transitonal_plan->cooccure_partial_care_val)&&$transitonal_plan->cooccure_partial_care=='yes'&&$transitonal_plan->cooccure_partial_care_val=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>

<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id="TP_int_out_treat" <?php echo isset($transitonal_plan->intensive_outpat)&&$transitonal_plan->intensive_outpat=='yes'?'checked=checked':'';?>></td>
    <td>Intensive Outpatient Treatment:	</td>
    <td><input type ='checkbox' class="checkbox-radio intensive_outpat" data-id="intensive_outpat" value="accepted" <?php echo isset($transitonal_plan->intensive_outpat_val)&&$transitonal_plan->intensive_outpat=='yes'&&$transitonal_plan->intensive_outpat_val=='accpeted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox' class="checkbox-radio intensive_outpat" data-id="intensive_outpat" value="denied" <?php echo isset($transitonal_plan->intensive_outpat_val)&&$transitonal_plan->intensive_outpat=='yes'&&$transitonal_plan->intensive_outpat_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio intensive_outpat" data-id="intensive_outpat" value="n/a" <?php echo isset($transitonal_plan->intensive_outpat_val)&&$transitonal_plan->intensive_outpat=='yes'&&$transitonal_plan->intensive_outpat_val=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>

<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id='TP_co_occ_inte_pat' <?php echo isset($transitonal_plan->cocoure_int_pat)&&$transitonal_plan->cocoure_int_pat=='yes'?'checked=checked':'';?>></td>
   <td>Co-Occurring Intensive Outpatient:	</td>
    <td><input type ='checkbox' class="checkbox-radio co-occure-intensive-outpat" data-id="co-occure-intensive-outpat" value="accepted" <?php echo isset($transitonal_plan->cocoure_int_pat_val)&&$transitonal_plan->cocoure_int_pat=='yes'&&$transitonal_plan->cocoure_int_pat_val=='accpeted'?'checked=checked':'';?>>Accepted</td>
     <td><input type ='checkbox' class="checkbox-radio co-occure-intensive-outpat" data-id="co-occure-intensive-outpat" value="denied" <?php echo isset($transitonal_plan->cocoure_int_pat_val)&&$transitonal_plan->cocoure_int_pat=='yes'&&$transitonal_plan->cocoure_int_pat_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio co-occure-intensive-outpat" data-id="co-occure-intensive-outpat" value="n/a" <?php echo isset($transitonal_plan->cocoure_int_pat_val)&&$transitonal_plan->cocoure_int_pat=='yes'&&$transitonal_plan->cocoure_int_pat_val=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>

<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id="TP_panin_management" <?php echo isset($transitonal_plan->pain_managemnet)&&$transitonal_plan->pain_managemnet=='yes'?'checked=checked':'';?>></td>
    <td>Pain Management Referral:</td>
    <td><input type ='checkbox' class="checkbox-radio pain_management" data-id="pain_management" value="accepted" <?php echo isset($transitonal_plan->pain_managemnet_val)&&$transitonal_plan->pain_managemnet=='yes'&&$transitonal_plan->pain_managemnet_val=='accpeted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox' class="checkbox-radio pain_management" data-id="pain_management" value="denied" <?php echo isset($transitonal_plan->pain_managemnet_val)&&$transitonal_plan->pain_managemnet=='yes'&&$transitonal_plan->pain_managemnet_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio pain_management" data-id="pain_management" value="n/a" <?php echo isset($transitonal_plan->pain_managemnet_val)&&$transitonal_plan->pain_managemnet=='yes'&&$transitonal_plan->pain_managemnet_val=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>

<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id="TP_primary_care_phy" <?php echo isset($transitonal_plan->primary_care)&&$transitonal_plan->primary_care=='yes'?'checked=checked':'';?>></td>
    <td>Primary Care Physician:	</td>
    <td><input type ='checkbox' class="checkbox-radio  primary_carephy" data-id="primary_carephy" value="accepted" <?php echo isset($transitonal_plan->primary_care_val)&&$transitonal_plan->primary_care=='yes'&&$transitonal_plan->primary_care_val=='accepted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox' class="checkbox-radio  primary_carephy" data-id="primary_carephy" value="denied" <?php echo isset($transitonal_plan->primary_care_val)&&$transitonal_plan->primary_care=='yes'&&$transitonal_plan->primary_care_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio  primary_carephy" data-id="primary_carephy" value="n/a" <?php echo isset($transitonal_plan->primary_care_val)&&$transitonal_plan->primary_care=='yes'&&$transitonal_plan->primary_care_val=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>

<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id='TP_12meeting' <?php echo isset($transitonal_plan->meeting)&&$transitonal_plan->meeting=='yes'?'checked=checked':'';?>></td>
    <td>12 step fellowship meetings:	</td>
    <td><input type ='checkbox'  class="checkbox-radio meeting" data-id="meeting" value="accepted" <?php echo isset($transitonal_plan->meeting_val)&&$transitonal_plan->meeting=='yes'&&$transitonal_plan->meeting_val=='accepted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox' class="checkbox-radio meeting" data-id="meeting" value="denied" <?php echo isset($transitonal_plan->meeting_val)&&$transitonal_plan->meeting=='yes'&&$transitonal_plan->meeting_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio meeting" data-id="meeting" value="n/a" <?php echo isset($transitonal_plan->meeting_val)&&$transitonal_plan->meeting=='yes'&&$transitonal_plan->meeting_val=='n/a'?'checked=checked':'';?>>N/A</td>


</tr>

<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id='TP_relapse_prevent_group' <?php echo isset($transitonal_plan->relapse_prevent)&&$transitonal_plan->relapse_prevent=='yes'?'checked=checked':'';?>></td>
    <td>Other relapse prevention groups: </td>
    <td><input type ='checkbox' class="checkbox-radio relapse_prevent_group" data-id="relapse_prevent_group"  value="accepted" <?php echo isset($transitonal_plan->relapse_prevent_val)&&$transitonal_plan->relapse_prevent=='yes'&&$transitonal_plan->relapse_prevent_val='accpeted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox' class="checkbox-radio relapse_prevent_group" data-id="relapse_prevent_group" value="denied" <?php echo isset($transitonal_plan->relapse_prevent_val)&&$transitonal_plan->relapse_prevent=='yes'&&$transitonal_plan->relapse_prevent_val='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio relapse_prevent_group" data-id="relapse_prevent_group" value="n/a" <?php echo isset($transitonal_plan->relapse_prevent_val)&&$transitonal_plan->relapse_prevent=='yes'&&$transitonal_plan->relapse_prevent_val='n/a'?'checked=checked':'';?>>N/A</td>

</tr>
<tr><td colspan="5">(SMART Recovery, Celebrate Recovery, Non-12 step meetings)</td></tr>

<tr>
    <td><input type ='checkbox' class="transitional_plan" data-id='TP_other_support_meeting' <?php echo isset($transitonal_plan->other_support)&&$transitonal_plan->other_support=='yes'?'checked=checked':'';?>></td>
    <td>Other support meetings:		</td>
    <td><input type ='checkbox' class="checkbox-radio other_supprt_meeting_tp" data-id="other_supprt_meeting_tp" value="accepted" <?php echo isset($transitonal_plan->other_support_val)&&$transitonal_plan->other_support=='yes'&&$transitonal_plan->other_support_val=='accpeted'?'checked=checked':'';?>>Accepted</td>
    <td><input type ='checkbox' class="checkbox-radio other_supprt_meeting_tp" data-id="other_supprt_meeting_tp" value="denied" <?php echo isset($transitonal_plan->other_support_val)&&$transitonal_plan->other_support=='yes'&&$transitonal_plan->other_support_val=='denied'?'checked=checked':'';?>>Denied</td>
    <td><input type ='checkbox' class="checkbox-radio other_supprt_meeting_tp" data-id="other_supprt_meeting_tp" value="n/a" <?php echo isset($transitonal_plan->other_support_val)&&$transitonal_plan->other_support=='yes'&&$transitonal_plan->other_support_val=='n/a'?'checked=checked':'';?>>N/A</td>

</tr>

<tr>
    <td colspan="5">Church, recreational activities, etc.)</td>

</tr>
</table>
<br>
    <table class="table" border="1">
    <tr>
            <td>Referral Agency: The Center for Network Therapy – IOP
            </td>
            <td>Intake appointment Date:   <?php echo isset($transitonal_data['appoitment_date'])?$transitonal_data['appoitment_date']:''?></td>
    </tr>
    <tr>
        <td>Address:<br>81 Northfield Avenue<br>West Orange, NJ</td>
        <td>Telephone Number: 973-731-1375<br>
            Fax Number: 973-731-1374
        </td>
    </tr>
    </table>
    <p>Comments/Follow up needed</p>
<input   placeholder="No comments" name="comments" <?php echo $transitonal_data['comments']?$transitonal_data['comments']:''?>">
<br>
<?php
$legal_history=json_decode($transitonal_data['legal_history']);
?>
<b>5. Legal History </b>
<table style="width:100%;border:0">
<tr>
    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history" <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='Probation'?'checked=checked':'';?>>Probation</td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history" <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='Parole'?'checked=checked':'';?>>Parole</td>
</tr> <tr>
    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history"  <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='charge_pending'?'checked=checked':'';?>>Charges Pending</td>
</tr> <tr>
    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history"  <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='DUI'?'checked=checked':'';?>>DUI</td>
</tr> <tr>
    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history"  <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='Drug_court'?'checked=checked':'';?>>Drug Court</td>
</tr> <tr>
    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history" <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='other'?'checked=checked':'';?>>Other </td>
</tr>

</table>
<br>
<p>Comments/Follow up needed</p>
<table class="table" border='1'>
<tr>
    <td>Per the client: <?php echo isset($legal_history->legal_history_client)?$legal_history->legal_history_client:'';?></td>
</tr>
</table>
<br>
<?php
$employement_vocation= json_decode($transitonal_data['employement_vocation']);
?>
<b>6. Employment/Vocation</b>
<br>
<table style="width:100%;border:0">
<tr>
    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='unemployed'?'checked=checked':'';?>>Unemployed</td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation"  <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='full_time_employment'?'checked=checked':'';?>>Full time Employment</td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation"  <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='part_time_employement'?'checked=checked':'';?>> Part time Employment</td>
</tr>
 <tr>
    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='voulunteer'?'checked=checked':'';?>>Volunteer work</td>
</tr>
 <tr>
    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation"  <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='job_search'?'checked=checked':'';?>>Job Search</td>
</tr>
 <tr>
    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='job_training'?'checked=checked':'';?>>Job Training </td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='retired'?'checked=checked':'';?>>Retired </td>
</tr>
 <tr>
    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation"  <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='disable'?'checked=checked':'';?>>Disabled</td>
</tr>

</table>

<p>Comments/Follow up needed</p>
<table class="table" border='1'>
<tr>
    <td>Per the client: <?php echo isset($employement_vocation->employement_vocation_client)?$employement_vocation->employement_vocation_client:'';?></td>
</tr>
</table>
<br>
<?php
$educational = json_decode($transitonal_data['educational']);
?>

<b>7. Educational</b>
<table  style="width:100%;border:0">
<tr>
    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational' <?php echo isset($educational->educational)&&$educational->educational=='ged'?'checked=checked':'';?>>GED</td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational' <?php echo isset($educational->educational)&&$educational->educational=='higher_education'?'checked=checked':'';?>>Higher Education</td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational' <?php echo isset($educational->educational)&&$educational->educational=='disable'?'checked=checked':'';?>> Disabled</td>
</tr>
 <tr>
    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational'  <?php echo isset($educational->educational)&&$educational->educational=='hs_diploma'?'checked=checked':'';?>>H.S. Diploma</td>
</tr>
 <tr>
    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational' <?php echo isset($educational->educational)&&$educational->educational=='Other'?'checked=checked':'';?>>Other</td>
</tr>

</table>
<br>
<p>Comments/Follow up needed</p>
<table class="table" border='1'>
<tr>
    <td>Per the client:<input   name="educational_client" <?php echo isset($educational->educational)?$educational->educational:'';?>"></td>
</tr>
</table>
<br>
<?php
$pysychosocial=json_decode($transitonal_data['Psychosocial']);
?>
<b>8. Psychosocial </b>
<table style="width:100%;border:0">
<tr>
    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='family_history'?'checked=checked':'';?>>Family History of Addiction</td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='personal_history'?'checked=checked':'';?>>Personal history of abuse</td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='grief_bereavement'?'checked=checked':'';?>> Grief/Bereavement</td>
</tr>
 <tr>
    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial'  <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='anger_management'?'checked=checked':'';?>>Anger management</td>
</tr>
 <tr>
    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='domestic_abuse'?'checked=checked':'';?>>Domestic Abuse/ Violence</td>
</tr>

<tr>
    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='basic_necessities'?'checked=checked':'';?>>Basic Necessities (Food, Shelter, Clothing)</td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='recovery_based'?'checked=checked':'';?>>Recovery based support system</td>
</tr>
<tr>
    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial'  <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='family_supports'?'checked=checked':'';?>> Family supports </td>
</tr>
 <tr>
    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial'  <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='other_support'?'checked=checked':'';?>>Other supports</td>
</tr>

</table><br>
<p>Comments/Follow up needed</p>
<table class="table" border='1'>
<tr>
    <td>Per the client: <?php echo isset($pysychosocial->psychosocial_client)?$pysychosocial->psychosocial_client:''?></td>
</tr>
</table>
<br>

<p><b>I,  <?php echo isset($transitonal_data['client_name1'])?$transitonal_data['client_name1']:'';?> allow this document to be mailed to my referral as well as my collateral contact upon discharge.</p>
<p>I, <?php echo isset($transitonal_data['client_name2'])?$transitonal_data['client_name2']:'';?>  fully understand that in the case of my non-compliance and not meeting the criteria for Partial Care, I will be recommended for Inpatient treatment. I allow the staff at the Center for Network Therapy to contact inpatient treatment facilities in the State of New Jersey on my behalf to secure a bed for me, which includes the following: Seabrook House, Carrier Clinic, Summit Oaks Hospital, and Princeton House Behavioral Health.</b></p>
<?php
$print_patient=json_decode($transitonal_data['print_patient']);
?>
<table class="table" border='1' style="width:100%;">
<tr>
    <th>Please print Name</th>
    <th>Date</th>
    <th>Signature</th>
</tr>
 <tr>
    <th>Client Name
    <?php echo $print_patient->print_clientname1;?></th>
    <th><?php $print_patient->print_date1?></th>
    <th><?php
    if($print_patient->print_signature1!=''){
        echo '<img src='.$print_patient->print_signature1.' style="width:20%;height:40px;" >';
    }
    //echo isset($print_patient->print_signature1) ?$print_patient->print_signature1:''?></th>
</tr>
<tr>
    <td><b>Clinician</b><br><?php echo $transitonal_data['text1'];?></td>
    <th><?php echo $print_patient->print_date2;?></th>
    <th>
    <?php
    if($print_patient->print_signature2!=''){
        echo '<img src='.$print_patient->print_signature2.' style="width:20%;height:40px;" >';
    }
    ?>
    </th>
</tr>
<tr>
    <td><b>Clinical Director:</b><br><?php echo $transitonal_data['text2'];?></td>
    <th><?php echo $print_patient->print_date3;?></th>
    <th>
    <?php
    if($print_patient->img_print_signature3!=''){
        echo '<img src='.$print_patient->print_signature3.' style="width:20%;height:40px;" >';
    }
    ?>
    </th>
</tr>
</table>






        <?php

        $html = ob_get_contents();
        ob_end_clean();
        // echo $html;die;
        $header='<div style="display:flex;align-item:center;justofy-content:center"><center><b>Center of Network Theraphy<br> 81 north filed avenue weset orange<br> NJ 07052<br> (973) 731 1375</center></div>';
        $mpdf->setTitle("Transitional Plan");
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->defaultfooterline = 0;
        $mpdf->setFooter("Page: {PAGENO} of {nb}");
        $mpdf->SetMargins(0,0,30);
        $mpdf->WriteHTML($html);

        //save the file put which location you need folder/filname
        $mpdf->Output("Transitional Plan.pdf", 'I');

        $mpdf->debug = true;
        //out put in browser below output function
        $mpdf->Output();
    ?>
    </body>
</html>

