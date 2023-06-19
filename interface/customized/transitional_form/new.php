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
$transitonal_data = $formid ? formFetch("form_transitional_plan", $formid) : array();
?>
<html>
    <head>
        <title><?php echo xlt("Personal Drug Use Questionnaire"); ?></title>

        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
        <style>
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
                    <center><h2><?php echo xlt('Transitional Plan'); ?></h2></center>
                    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/transitional_form/save.php?id=<?php echo attr_url($formid); ?>">
                        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                        <div class="row">
                            <?php
                                $client_information = json_decode($transitonal_data['client_information']);
                                $client_strength    = json_decode($transitonal_data['client_strength']);

                            ?>
                            <b>1. Client Information</b><br>
                            <table class="table" border="1">
                                    <tr>
                                        <td>Client Name: <input type="text" class="form-control" name="cf_clinet_name" value="<?php echo isset($client_information->client_name)&&$client_information->client_name!=''?$client_information->client_name:'';?>"></td>
                                        <td>Date of Discharge DETOX: <input type="date" class="form-control" name="cf_discharge_date" value="<?php echo isset($client_information->discharage_detox)&&$client_information->discharage_detox!=''?$client_information->discharage_detox:'';?>"></td>
                                    </tr>
                                    <tr>
                                        <td>DOA:  <input type="text" class="form-control" name="cf_doa" value="<?php echo isset($client_information->DOA)&&$client_information->DOA!=''?$client_information->DOA:'';?>"></td>
                                        <td>Date of Discharge PHP:<input type="date" class="form-control" name="cf_date_discharge_php" value="<?php echo isset($client_information->discharge_php)&&$client_information->discharge_php!=''?$client_information->discharge_php:'';?>"></td>
                                    </tr>
                                    <tr>
                                        <td>DETOX Treatment Plan:<input type="text" class="form-control" name="cf_treatement_plan" value="<?php echo isset($client_information->detox_treatment_plan)&&$client_information->detox_treatment_plan!=''?$client_information->detox_treatment_plan:'';?>"></td>
                                        <td>PHP Treatment Plan:<input type="text" class="form-control" name="cf_php_treatement_plan" value="<?php echo isset($client_information->php_treatment_plan)&&$client_information->php_treatment_plan!=''?$client_information->php_treatment_plan:'';?>"></td>
                                    </tr>

                            </table>
                            <br>
                            <b>2. Client Strengths and abilities</b><br>
                            <table class="table" border="1">
                                    <tr>
                                        <td>Client reports their strength as  <input type="text" class="form-control" name="client_strength" value="<?php echo isset($client_information->client_strength)&&$client_information->client_strength!=''?$client_information->client_strength:'';?>"><br>
                                            Client reports their ability as: <input type="text" class="form-control" name="client_ability" value="<?php echo isset($client_information->client_ability)&&$client_information->client_ability!=''?$client_information->client_ability:'';?>">
                                        </td>
                                    </tr>
                            </table>
                            <br>
                            <b>3.Client’s needs and Preferences:</b><br>
                            <table class="table" border="1">
                                    <tr>
                                        <td>Client reports their need is to maintain abstinence from  <input type="text" class="form-control" name="client_need" value="<?php echo isset($transitonal_data['client_need'])?$transitonal_data['client_need']:'';?>"><br>
                                        Client reports no preferences in regards to male/female counselor or individual/group therapy.
                                        </td>
                                    </tr>
                            </table>
                            <br>
                            <b>4.Substance Use Disorder:</b><br>
                            <table class="table" border="1">
                                    <tr>
                                        <td><input type="text" class="form-control" name="substance_disorder" value="<?php echo isset($transitonal_data['substance_disorder'])?$transitonal_data['substance_disorder']:'';?>">moderate, in post-acute withdrawal.
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
                                    <td><input type ='checkbox'  class="transitional_plan" id="check_halfway_house" data-id='TP_hh' <?php echo isset($transitonal_plan->halfway_house)&&$transitonal_plan->halfway_house=='yes'?'checked':'';?>></td>
                                    <td>Halfway House:	</td>
                                    <td><input type ='checkbox'  class="checkbox-radio halfway_house check_halfway_house" data-id='halfway_house' value="accepted" <?php echo isset($transitonal_plan->halfway_house_data)&&$transitonal_plan->halfway_house=='yes'&&$transitonal_plan->halfway_house_data=='accepted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox'  class="checkbox-radio halfway_house check_halfway_house" data-id='halfway_house'  value="denied" <?php echo isset($transitonal_plan->halfway_house_data)&&$transitonal_plan->halfway_house=='yes'&&$transitonal_plan->halfway_house_data=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox'  class="checkbox-radio halfway_house check_halfway_house" data-id='halfway_house'  value="n/a" <?php echo isset($transitonal_plan->halfway_house_data)&&$transitonal_plan->halfway_house=='yes'&&$transitonal_plan->halfway_house_data=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="TP_halfway_house" id="TP_hh"  value="<?php echo isset($transitonal_plan->halfway_house)?$transitonal_plan->halfway_house:'';?>">
                                    <input type="hidden" name="TP_halfway_house_val" id="halfway_house" value="<?php echo isset($transitonal_plan->halfway_house_data)?$transitonal_plan->halfway_house_data:'';?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan"  id="check_inpatient_other" data-id='TP_IO' <?php echo isset($transitonal_plan->inpatient_other)&&$transitonal_plan->inpatient_other=='yes'?'checked':'';?>></td>
                                    <td>Inpatient other:	</td>
                                    <td><input type ='checkbox'  value="accepted" class="checkbox-radio inpatient_other check_inpatient_other" data-id='inpatient_other' value="accepted" <?php echo isset($transitonal_plan->inpatient_other_val)&&$transitonal_plan->inpatient_other=='yes'&&$transitonal_plan->inpatient_other_val=='accepted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox'  value="deneid" class="checkbox-radio inpatient_other check_inpatient_other" data-id='inpatient_other' value="denied" <?php echo isset($transitonal_plan->inpatient_other_val)&&$transitonal_plan->inpatient_other=='yes'&&$transitonal_plan->inpatient_other_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' value="n/a" class="checkbox-radio inpatient_other check_inpatient_other" data-id='inpatient_other' value="n/a" <?php echo isset($transitonal_plan->inpatient_other_val)&&$transitonal_plan->inpatient_other=='yes'&&$transitonal_plan->inpatient_other_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="TP_inpat" id="TP_IO" value="<?php echo isset($transitonal_plan->inpatient_other)?$transitonal_plan->inpatient_other:'';?>">
                                    <input type="hidden" name="TP_inpat_val" id ="inpatient_other" value="<?php echo isset($transitonal_plan->inpatient_other_val)?$transitonal_plan->inpatient_other_val:'';?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_inpatinet_detox" data-id='TP_INdet' <?php echo isset($transitonal_plan->inpatient_detox)&&$transitonal_plan->inpatient_detox=='yes'?'checked':'';?>></td>
                                    <td>	Inpatient Detox:		</td>
                                    <td><input type ='checkbox' class="checkbox-radio inpatinet_detox check_inpatinet_detox" data-id="inpatinet_detox"  value="accepted" <?php echo isset($transitonal_plan->inpatient_detox_val)&&$transitonal_plan->inpatient_detox=='yes'&&$transitonal_plan->inpatient_detox_val=='accepted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio inpatinet_detox check_inpatinet_detox" data-id="inpatinet_detox" value="denied" <?php echo isset($transitonal_plan->inpatient_detox_val)&&$transitonal_plan->inpatient_detox=='yes'&&$transitonal_plan->inpatient_detox_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio inpatinet_detox check_inpatinet_detox" data-id="inpatinet_detox" value="n/a" <?php echo isset($transitonal_plan->inpatient_detox_val)&&$transitonal_plan->inpatient_detox=='yes'&&$transitonal_plan->inpatient_detox_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" id="TP_INdet" name="TP_inpatient_detox" value="<?php echo isset($transitonal_plan->inpatient_detox)?$transitonal_plan->inpatient_detox:''?>">
                                    <input type="hidden" id="inpatinet_detox" name="TP_inpatient_detox_val" value="<?php echo isset($transitonal_plan->inpatient_detox_val)?$transitonal_plan->inpatient_detox_val:''?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" data-id='TP_partial' id="check_partial_care" <?php echo isset($transitonal_plan->partial_care)&&$transitonal_plan->partial_care=='yes'?'checked':'';?>></td>
                                    <td>Partial Care Program:	</td>
                                    <td><input type ='checkbox' class="checkbox-radio partial_care check_partial_care" data-id="partial_care" value="accepted" <?php echo isset($transitonal_plan->partial_care_val)&&$transitonal_plan->partial_care=='yes'&&$transitonal_plan->partial_care_val=='accepted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio partial_care check_partial_care" data-id="partial_care" value="denied" <?php echo isset($transitonal_plan->partial_care_val)&&$transitonal_plan->partial_care=='yes'&&$transitonal_plan->partial_care_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio partial_care check_partial_care" data-id="partial_care" value="n/a" <?php echo isset($transitonal_plan->partial_care_val)&&$transitonal_plan->partial_care=='yes'&&$transitonal_plan->partial_care_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" id="TP_partial" name="TP_partial" value="<?php echo isset($transitonal_plan->partial_care)?$transitonal_plan->partial_care:'';?>">
                                    <input type="hidden" id="partial_care" name="TP_partial_val" value="<?php echo isset($transitonal_plan->partial_care_val)?$transitonal_plan->partial_care_val:'';?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_co-occoure" data-id='TP_co_occure' <?php echo isset($transitonal_plan->cooccure_partial_care)&&$transitonal_plan->cooccure_partial_care=='yes'?'checked':'';?>></td>
                                    <td>Co-Occurring Partial Care Program:</td>
                                    <td><input type ='checkbox' class="checkbox-radio co-occoure check_co-occoure" data-id="co-occoure" value="accepted" <?php echo isset($transitonal_plan->cooccure_partial_care_val)&&$transitonal_plan->cooccure_partial_care=='yes'&&$transitonal_plan->cooccure_partial_care_val=='accepeted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio co-occoure check_co-occoure" data-id="co-occoure" value="denied" <?php echo isset($transitonal_plan->cooccure_partial_care_val)&&$transitonal_plan->cooccure_partial_care=='yes'&&$transitonal_plan->cooccure_partial_care_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio co-occoure check_co-occoure" data-id="co-occoure" value="n/a" <?php echo isset($transitonal_plan->cooccure_partial_care_val)&&$transitonal_plan->cooccure_partial_care=='yes'&&$transitonal_plan->cooccure_partial_care_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" id="TP_co_occure" name="TP_co_occure" value="<?php echo isset($transitonal_plan->cooccure_partial_care)?$transitonal_plan->cooccure_partial_care:'';?>">
                                    <input type="hidden" id="co-occoure" name="TP_co_occure_val" value="<?php echo isset($transitonal_plan->cooccure_partial_care_val)?$transitonal_plan->cooccure_partial_care_val:'';?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_intensive_outpat" data-id="TP_int_out_treat" <?php echo isset($transitonal_plan->intensive_outpat)&&$transitonal_plan->intensive_outpat=='yes'?'checked':'';?>></td>
                                    <td>Intensive Outpatient Treatment:	</td>
                                    <td><input type ='checkbox' class="checkbox-radio intensive_outpat check_intensive_outpat" data-id="intensive_outpat" value="accepted" <?php echo isset($transitonal_plan->intensive_outpat_val)&&$transitonal_plan->intensive_outpat=='yes'&&$transitonal_plan->intensive_outpat_val=='accpeted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio intensive_outpat check_intensive_outpat" data-id="intensive_outpat" value="denied" <?php echo isset($transitonal_plan->intensive_outpat_val)&&$transitonal_plan->intensive_outpat=='yes'&&$transitonal_plan->intensive_outpat_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio intensive_outpat check_intensive_outpat" data-id="intensive_outpat" value="n/a" <?php echo isset($transitonal_plan->intensive_outpat_val)&&$transitonal_plan->intensive_outpat=='yes'&&$transitonal_plan->intensive_outpat_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="TP_int_out_treat" id="TP_int_out_treat" value="<?php echo isset($transitonal_plan->intensive_outpat)?$transitonal_plan->intensive_outpat:'';?>">
                                    <input type="hidden" name="TP_int_out_treat_val" id="intensive_outpat" value="<?php echo isset($transitonal_plan->intensive_outpat_val)?$transitonal_plan->intensive_outpat_val:'';?>" >
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_co-occure_pat" data-id='TP_co_occ_inte_pat' <?php echo isset($transitonal_plan->cocoure_int_pat)&&$transitonal_plan->cocoure_int_pat=='yes'?'checked':'';?>></td>
                                    <td>Co-Occurring Intensive Outpatient:	</td>
                                    <td><input type ='checkbox' class="checkbox-radio co-occure-intensive-outpat check_co-occure_pat" data-id="co-occure-intensive-outpat" value="accepted" <?php echo isset($transitonal_plan->cocoure_int_pat_val)&&$transitonal_plan->cocoure_int_pat=='yes'&&$transitonal_plan->cocoure_int_pat_val=='accpeted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio co-occure-intensive-outpat check_co-occure_pat" data-id="co-occure-intensive-outpat" value="denied" <?php echo isset($transitonal_plan->cocoure_int_pat_val)&&$transitonal_plan->cocoure_int_pat=='yes'&&$transitonal_plan->cocoure_int_pat_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox'class="checkbox-radio co-occure-intensive-outpat check_co-occure_pat" data-id="co-occure-intensive-outpat" value="n/a" <?php echo isset($transitonal_plan->cocoure_int_pat_val)&&$transitonal_plan->cocoure_int_pat=='yes'&&$transitonal_plan->cocoure_int_pat_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="TP_co_occ_inte_pat" id="TP_co_occ_inte_pat" value="<?php echo isset($transitonal_plan->cocoure_int_pat)?$transitonal_plan->cocoure_int_pat:'';?>">
                                    <input type="hidden" name="TP_co_occ_inte_pat_val" id="co-occure-intensive-outpat" value="<?php echo isset($transitonal_plan->cocoure_int_pat_val)?$transitonal_plan->cocoure_int_pat_val:'';?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_privatetheraphist" data-id='TP_private_theraphist' <?php echo isset($transitonal_plan->private_theraphist)&&$transitonal_plan->private_theraphist=='yes'?'checked':'';?>></td>
                                    <td>Private Therapist	</td>
                                    <td><input type ='checkbox' class="checkbox-radio privatetheraphist check_privatetheraphist" data-id="privatetheraphist" value="accepted" <?php echo isset($transitonal_plan->private_theraphist_val)&&$transitonal_plan->private_theraphist=='yes'&&$transitonal_plan->private_theraphist_val=='accpeted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio privatetheraphist check_privatetheraphist" data-id="privatetheraphist" value="denied" <?php echo isset($transitonal_plan->private_theraphist_val)&&$transitonal_plan->private_theraphist=='yes'&&$transitonal_plan->private_theraphist_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio privatetheraphist check_privatetheraphist" data-id="privatetheraphist" value="n/a" <?php echo isset($transitonal_plan->private_theraphist_val)&&$transitonal_plan->private_theraphist=='yes'&&$transitonal_plan->private_theraphist_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="TP_private_theraphist" id="TP_private_theraphist" value="<?php echo isset($transitonal_plan->private_theraphist)?$transitonal_plan->private_theraphist:'';?>">
                                    <input type="hidden" name="TP_private_theraphist_val" id="privatetheraphist" value="<?php echo isset($transitonal_plan->private_theraphist_val)?$transitonal_plan->private_theraphist_val:'';?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_subxone_maintain" data-id='TP_subxone_maintain' <?php echo isset($transitonal_plan->sobxone)&&$transitonal_plan->sobxone=='yes'?'checked':'';?>></td>
                                    <td>Suboxone Maintenance Doctor	</td>
                                    <td><input type ='checkbox' class="checkbox-radio subxone_maintain check_subxone_maintain" data-id="subxone_maintain"  value="accepted" <?php echo isset($transitonal_plan->sobxone_val)&&$transitonal_plan->sobxone=='yes'&&$transitonal_plan->sobxone_val=='accpeted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio subxone_maintain check_subxone_maintain" data-id="subxone_maintain" value="denied" <?php echo isset($transitonal_plan->sobxone_val)&&$transitonal_plan->sobxone=='yes'&&$transitonal_plan->sobxone_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio subxone_maintain check_subxone_maintain" data-id="subxone_maintain" value="n/a" <?php echo isset($transitonal_plan->sobxone_val)&&$transitonal_plan->sobxone=='yes'&&$transitonal_plan->sobxone_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="subxone_maintain" id="TP_subxone_maintain" value="<?php echo isset($transitonal_plan->sobxone)?$transitonal_plan->sobxone:'';?>">
                                    <input type="hidden" name="subxone_maintain_val" id="subxone_maintain" value="<?php echo isset($transitonal_plan->sobxone_val)?$transitonal_plan->sobxone_val:'';?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_pain_management" data-id="TP_panin_management" <?php echo isset($transitonal_plan->pain_managemnet)&&$transitonal_plan->pain_managemnet=='yes'?'checked':'';?>></td>
                                    <td>Pain Management Referral:</td>
                                    <td><input type ='checkbox' class="checkbox-radio pain_management check_pain_management" data-id="pain_management" value="accepted" <?php echo isset($transitonal_plan->pain_managemnet_val)&&$transitonal_plan->pain_managemnet=='yes'&&$transitonal_plan->pain_managemnet_val=='accpeted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio pain_management check_pain_management" data-id="pain_management" value="denied" <?php echo isset($transitonal_plan->pain_managemnet_val)&&$transitonal_plan->pain_managemnet=='yes'&&$transitonal_plan->pain_managemnet_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio pain_management check_pain_management" data-id="pain_management" value="n/a" <?php echo isset($transitonal_plan->pain_managemnet_val)&&$transitonal_plan->pain_managemnet=='yes'&&$transitonal_plan->pain_managemnet_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="pain_management" id="TP_panin_management " value="<?php echo isset($transitonal_plan->pain_managemnet)?$transitonal_plan->pain_managemnet:'';?>">
                                    <input type="hidden" name="pain_management_val" id="pain_management" value="<?php echo isset($transitonal_plan->pain_managemnet_val)?$transitonal_plan->pain_managemnet_val:'';?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_primary_carephy" data-id="TP_primary_care_phy" <?php echo isset($transitonal_plan->primary_care)&&$transitonal_plan->primary_care=='yes'?'checked':'';?>></td>
                                    <td>Primary Care Physician:	</td>
                                    <td><input type ='checkbox' class="checkbox-radio  primary_carephy check_primary_carephy" data-id="primary_carephy" value="accepted" <?php echo isset($transitonal_plan->primary_care_val)&&$transitonal_plan->primary_care=='yes'&&$transitonal_plan->primary_care_val=='accepted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio  primary_carephy check_primary_carephy" data-id="primary_carephy" value="denied" <?php echo isset($transitonal_plan->primary_care_val)&&$transitonal_plan->primary_care=='yes'&&$transitonal_plan->primary_care_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio  primary_carephy check_primary_carephy" data-id="primary_carephy" value="n/a" <?php echo isset($transitonal_plan->primary_care_val)&&$transitonal_plan->primary_care=='yes'&&$transitonal_plan->primary_care_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="TP_primary_care" id="TP_primary_care_phy" value="<?php echo isset($transitonal_plan->primary_care)?$transitonal_plan->primary_care:'';?>">
                                    <input type="hidden" name="TP_primary_care_val" id="primary_carephy" value="<?php echo isset($transitonal_plan->primary_care_val)?$transitonal_plan->primary_care_val:'';?>">
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_meeting" data-id='TP_12meeting' <?php echo isset($transitonal_plan->meeting)&&$transitonal_plan->meeting=='yes'?'checked':'';?>></td>
                                    <td>12 step fellowship meetings:	</td>
                                    <td><input type ='checkbox'  class="checkbox-radio meeting check_meeting" data-id="meeting" value="accepted" <?php echo isset($transitonal_plan->meeting_val)&&$transitonal_plan->meeting=='yes'&&$transitonal_plan->meeting_val=='accepted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio meeting check_meeting" data-id="meeting" value="denied" <?php echo isset($transitonal_plan->meeting_val)&&$transitonal_plan->meeting=='yes'&&$transitonal_plan->meeting_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio meeting check_meeting" data-id="meeting" value="n/a" <?php echo isset($transitonal_plan->meeting_val)&&$transitonal_plan->meeting=='yes'&&$transitonal_plan->meeting_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="TP_12meeting" id="TP_12meeting check_meeting" value="<?php echo isset($transitonal_plan->meeting)?$transitonal_plan->meeting:'';?>">
                                    <input type="hidden" name="TP_12meeting_val" id="meeting check_meeting" value="<?php echo isset($transitonal_plan->meeting_val)?$transitonal_plan->meeting_val:'';?>">

                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_rel_group" data-id='TP_relapse_prevent_group' <?php echo isset($transitonal_plan->relapse_prevent)&&$transitonal_plan->relapse_prevent=='yes'?'checked':'';?>></td>
                                    <td>Other relapse prevention groups: </td>
                                    <td><input type ='checkbox' class="checkbox-radio relapse_prevent_group check_rel_group" data-id="relapse_prevent_group"  value="accepted" <?php echo isset($transitonal_plan->relapse_prevent_val)&&$transitonal_plan->relapse_prevent=='yes'&&$transitonal_plan->relapse_prevent_val='accpeted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio relapse_prevent_group check_rel_group" data-id="relapse_prevent_group" value="denied" <?php echo isset($transitonal_plan->relapse_prevent_val)&&$transitonal_plan->relapse_prevent=='yes'&&$transitonal_plan->relapse_prevent_val='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio relapse_prevent_group check_rel_group" data-id="relapse_prevent_group" value="n/a" <?php echo isset($transitonal_plan->relapse_prevent_val)&&$transitonal_plan->relapse_prevent=='yes'&&$transitonal_plan->relapse_prevent_val='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="TP_relapse_prevent" id="TP_relapse_prevent_group" value="<?php echo isset($transitonal_plan->relapse_prevent)?$transitonal_plan->relapse_prevent:'';?>">
                                    <input type="hidden" name="TP_relapse_prevent_val" id="relapse_prevent_group" value="<?php echo isset($transitonal_plan->relapse_prevent_val)?$transitonal_plan->relapse_prevent_val:'';?>">
                                </tr>
                                <tr><td colspan="5">(SMART Recovery, Celebrate Recovery, Non-12 step meetings)</td></tr>

                                <tr>
                                    <td><input type ='checkbox' class="transitional_plan" id="check_other" data-id='TP_other_support_meeting' <?php echo isset($transitonal_plan->other_support)&&$transitonal_plan->other_support=='yes'?'checked':'';?>></td>
                                    <td>Other support meetings:		</td>
                                    <td><input type ='checkbox' class="checkbox-radio other_supprt_meeting_tp check_other" data-id="other_supprt_meeting_tp" value="accepted" <?php echo isset($transitonal_plan->other_support_val)&&$transitonal_plan->other_support=='yes'&&$transitonal_plan->other_support_val=='accpeted'?'checked':'';?>>Accepted</td>
                                    <td><input type ='checkbox' class="checkbox-radio other_supprt_meeting_tp check_other" data-id="other_supprt_meeting_tp" value="denied" <?php echo isset($transitonal_plan->other_support_val)&&$transitonal_plan->other_support=='yes'&&$transitonal_plan->other_support_val=='denied'?'checked':'';?>>Denied</td>
                                    <td><input type ='checkbox' class="checkbox-radio other_supprt_meeting_tp check_other" data-id="other_supprt_meeting_tp" value="n/a" <?php echo isset($transitonal_plan->other_support_val)&&$transitonal_plan->other_support=='yes'&&$transitonal_plan->other_support_val=='n/a'?'checked':'';?>>N/A</td>
                                    <input type="hidden" name="TP_other_support" id="TP_other_support_meeting" value="<?php echo isset($transitonal_plan->other_support)?$transitonal_plan->other_support:'';?>">
                                    <input type="hidden" name="TP_other_support_val" id="other_supprt_meeting_tp" value="<?php echo isset($transitonal_plan->other_support_val)?$transitonal_plan->other_support_val:'';?>">
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
                                        <td>Intake appointment Date: <input type="date" class="form-control" name="intake_appoitment_date" value="<?php echo isset($transitonal_data['appoitment_date'])?$transitonal_data['appoitment_date']:''?>"></td>
                                </tr>
                                <tr>
                                    <td>Address:<br>81 Northfield Avenue<br>West Orange, NJ</td>
                                    <td>Telephone Number: 973-731-1375<br>
                                        Fax Number: 973-731-1374
                                    </td>
                                </tr>
                            </table>
                            <p>Comments/Follow up needed</p>
                            <input type="text" class="form-control" placeholder="No comments" name="comments" value="<?php echo $transitonal_data['comments']?$transitonal_data['comments']:''?>">
                            <br>
                            <?php
                            $legal_history=json_decode($transitonal_data['legal_history']);
                            ?>
                            <b>5. Legal History </b>
                            <table style="width:100%;border:0">
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history" value="Probation" <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='Probation'?'checked':'';?>>Probation</td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history" value="Parole" <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='Parole'?'checked':'';?>>Parole</td>
                                </tr> <tr>
                                    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history" value="charge_pending" <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='charge_pending'?'checked':'';?>>Charges Pending</td>
                                </tr> <tr>
                                    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history" value="DUI" <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='DUI'?'checked':'';?>>DUI</td>
                                </tr> <tr>
                                    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history" value="Drug_court" <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='Drug_court'?'checked':'';?>>Drug Court</td>
                                </tr> <tr>
                                    <td><input type ='checkbox' class="checkbox-radio legal_history" data-id="legal_history" value="other" <?php echo isset($legal_history->legal_history)&&$legal_history->legal_history=='other'?'checked':'';?>>Other </td>
                                </tr>
                                <input type="hidden" id="legal_history" name="legal_history" value="<?php echo isset($legal_history->legal_history)?$legal_history->legal_history:'';?>">
                            </table>
                            <br>
                            <p>Comments/Follow up needed</p>
                            <table class="table" border='1'>
                                <tr>
                                    <td>Per the client:<input type="text" class="form-control" name="legal_history_client" value="<?php echo isset($legal_history->legal_history_client)?$legal_history->legal_history_client:'';?>"></td>
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
                                    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" value="unemployed" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='unemployed'?'checked':'';?>>Unemployed</td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" value="full_time_employment" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='full_time_employment'?'checked':'';?>>Full time Employment</td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" value="part_time_employement" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='part_time_employement'?'checked':'';?>> Part time Employment</td>
                                </tr>
                                 <tr>
                                    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" value="voulunteer" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='voulunteer'?'checked':'';?>>Volunteer work</td>
                                </tr>
                                 <tr>
                                    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" value="job_search" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='job_search'?'checked':'';?>>Job Search</td>
                                </tr>
                                 <tr>
                                    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" value="job_training" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='job_training'?'checked':'';?>>Job Training </td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" value="retired" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='retired'?'checked':'';?>>Retired </td>
                                </tr>
                                 <tr>
                                    <td><input type ='checkbox' class="checkbox-radio employement_vocation" data-id="employement_vocation" value="disable" <?php echo isset($employement_vocation->employment_vocation)&&$employement_vocation->employement_vocation=='disable'?'checked':'';?>>Disabled</td>
                                </tr>
                                <input type="hidden"  name="employment_vocation" id="employement_vocation" value="<?php echo isset($employement_vocation->employment_vocation) ??'';?>">
                            </table>

                            <p>Comments/Follow up needed</p>
                            <table class="table" border='1'>
                                <tr>
                                    <td>Per the client:<input type="text" class="form-control" name="employement_vocation_client" value="<?php echo isset($employement_vocation->employement_vocation_client)?$employement_vocation->employement_vocation_client:'';?>"></td>
                                </tr>
                            </table>
                            <br>
                            <?php
                            $educational = json_decode($transitonal_data['educational']);
                            ?>

                            <b>7. Educational</b>
                            <table  style="width:100%;border:0">
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational' value="ged" <?php echo isset($educational->educational)&&$educational->educational=='ged'?'checked':'';?>>GED</td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational' value="higher_education" <?php echo isset($educational->educational)&&$educational->educational=='higher_education'?'checked':'';?>>Higher Education</td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational' value="disable" <?php echo isset($educational->educational)&&$educational->educational=='disable'?'checked':'';?>> Disabled</td>
                                </tr>
                                 <tr>
                                    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational' value="hs_diploma" <?php echo isset($educational->educational)&&$educational->educational=='hs_diploma'?'checked':'';?>>H.S. Diploma</td>
                                </tr>
                                 <tr>
                                    <td><input type ='checkbox' class="checkbox-radio educational" data-id='educational' value="Other" <?php echo isset($educational->educational)&&$educational->educational=='Other'?'checked':'';?>>Other</td>
                                </tr>
                                <input type="hidden" name="educational" id="educational" value="<?php echo isset($educational->educational)??'';?>">
                            </table>
                            <br>
                            <p>Comments/Follow up needed</p>
                            <table class="table" border='1'>
                                <tr>
                                    <td>Per the client:<input type="text" class="form-control" name="educational_client" value="<?php echo isset($educational->educational)?$educational->educational:'';?>"></td>
                                </tr>
                            </table>
                            <br>
                            <?php
                            $pysychosocial=json_decode($transitonal_data['Psychosocial']);
                            ?>
                            <b>8. Psychosocial </b>
                            <table style="width:100%;border:0">
                                <tr>
                                    <td><input type ='checkbox'  class="checkbox-radio psychosocial" data-id='psychosocial' value="family_history" <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='family_history'?'checked':'';?>>Family History of Addiction</td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' value="personal_history" <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='personal_history'?'checked':'';?>>Personal history of abuse</td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' value="grief_bereavement" <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='grief_bereavement'?'checked':'';?>> Grief/Bereavement</td>
                                </tr>
                                 <tr>
                                    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' value="anger_management" <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='anger_management'?'checked':'';?>>Anger management</td>
                                </tr>
                                 <tr>
                                    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' value="domestic_abuse" <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='domestic_abuse'?'checked':'';?>>Domestic Abuse/ Violence</td>
                                </tr>

                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' value="basic_necessities" <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='basic_necessities'?'checked':'';?>>Basic Necessities (Food, Shelter, Clothing)</td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' value="recovery_based" <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='recovery_based'?'checked':'';?>>Recovery based support system</td>
                                </tr>
                                <tr>
                                    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' value="family_supports" <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='family_supports'?'checked':'';?>> Family supports </td>
                                </tr>
                                 <tr>
                                    <td><input type ='checkbox' class="checkbox-radio psychosocial" data-id='psychosocial' value="other_support" <?php echo isset($pysychosocial->psychosocial)&&$pysychosocial->psychosocial=='other_support'?'checked':'';?>>Other supports</td>
                                </tr>
                                <input type="hidden" id="psychosocial" name="psychosocial" value="<?php echo isset($pysychosocial->psychosocial)??'';?>">
                            </table><br>
                            <p>Comments/Follow up needed</p>
                            <table class="table" border='1'>
                                <tr>
                                    <td>Per the client:<input type="text" class="form-control" name="psychosocial_client" value="<?php echo isset($pysychosocial->psychosocial_client)?$pysychosocial->psychosocial_client:''?>"></td>
                                </tr>
                            </table>
                            <br>

                            <p><b>I,<input type="text" class="outline-text" name="clinet_name1" value="<?php echo isset($transitonal_data['client_name1'])??'';?>"> allow this document to be mailed to my referral as well as my collateral contact upon discharge.</p>
                            <p>I,<input type="text" class="outline-text" name="clinet_name2" value="<?php echo isset($transitonal_data['client_name2'])??'';?>">  fully understand that in the case of my non-compliance and not meeting the criteria for Partial Care, I will be recommended for Inpatient treatment. I allow the staff at the Center for Network Therapy to contact inpatient treatment facilities in the State of New Jersey on my behalf to secure a bed for me, which includes the following: Seabrook House, Carrier Clinic, Summit Oaks Hospital, and Princeton House Behavioral Health.</b></p>
                            <?php
                            $print_patient=json_decode($transitonal_data['print_patient']);
                            ?>
                            <table class="table" border='1'>
                                <tr>
                                    <th>Please print Name</th>
                                    <th>Date</th>
                                    <th>Signature</th>
                                </tr>
                                <tr>
                                    <th>Client Name <br>
                                    <input type="text" class="form-control" name="print_clientname1" value="<?php echo isset($print_patient->print_clientname1)?$print_patient->print_clientname1:''?>"></th>
                                    <th><input type="date" class="form-control" name="print_date1" value="<?php echo isset($print_patient->print_date1)?$print_patient->print_date1:''?>"></th>
                                    <th><div style="display:flex">
                                        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                        <input type="hidden" class="form-control" name="print_signature1" id="print_signature1" value="<?php echo isset($print_patient->print_signature1) ?$print_patient->print_signature1:''?>" >
                                        <img src='' class="img" id="img_print_signature1" style="display:none;width:50%;height:100px;" >
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td><b>Clinician</b><br><div contentEditable="true" class="text_edit"><?php 
              echo $transitonal_data['text1']??'Daniel O’Connell';?>
              </div><input type="hidden" name="text1" id="text1"></td> </td>
                                    <th><input type="date" class="form-control" name="print_date2" value="<?php echo isset($print_patient->print_date2) ?$print_patient->print_date2:''?>"></th>
                                    <th><i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                        <input type="hidden" class="form-control" name="print_signature2"  id="print_signature2" value="<?php echo isset($print_patient->print_signature2) ?$print_patient->print_signature2:''?>"  >
                                        <img src='' class="img" id="img_print_signature2" style="display:none;width:50%;height:100px;" >
                                    </th>
                                </tr>
                                <tr>
                                    <td><b>Clinical Director:</b><br><div contentEditable="true" class="text_edit"><?php 
              echo $transitonal_data['text2']??'Eddie Mann, MSW, LCSW, LCADC, CCS';?>
              </div><input type="hidden" name="text2" id="text2"></td>
                                    <th><input type="date" class="form-control" name="print_date3" value="<?php echo isset($print_patient->print_date3)?$print_patient->print_date3:''?>" ></th>
                                    <th><i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                        <input type="hidden" class="form-control" name="print_signature3" id="print_signature3" value="<?php echo isset($print_patient->print_signature3)?$print_patient->print_signature3:''?>">
                                        <img src='' class="img" id="img_print_signature3" style="display:none;width:50%;height:100px;" >
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="btn-group" role="group">
                                <button type="submit" onclick='top.restoreSession()' id='btn_save' class="btn btn-primary btn-save"><?php echo xlt('Save'); ?></button>
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
        $('.transitional_plan').each(function(){
            var id = $(this).attr('id');
            if ($('#'+id).is(':checked')) {
                $('.'+id).removeAttr('disabled');
            }
            else{
                $('.'+id).prop('disabled','true');
            }


        })

    })
$('.checkbox-radio').change(function ()
{
    var radioclass = $(this).attr('data-id');
    if($(this).is(':checked')){
        $("."+radioclass).prop('checked',false)
        $(this).prop('checked',true);
    }
    $('.'+radioclass+':checked').each(function(){

        $('#'+radioclass).val($(this).val());
    });
    //alert($('#'+radioclass).val());

});

$('.transitional_plan').change(function(){
    var id = $(this).attr('id');
    var mainradio = $(this).attr('data-id');
    if($(this).is(":checked",true))
    {


        $('#'+mainradio).val('yes');
        $('.'+id).removeAttr('disabled');
        // $('.'+id).prop('checked',true);
    }
    else{
        $('#'+mainradio).val('no');
        $('.'+id).prop('checked',false);
        $('.'+id).prop('disabled','true');
    }

});
$('#btn_save') .on('click',function(){
     $('.text_edit').each(function(){
         //alert();
         var dataval = $(this).html();
         $(this).next("input").val(dataval);
         
     });

 });

</script>
