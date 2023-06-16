<?php

/**
 * Clinical instructions form save.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

use OpenEMR\Common\Csrf\CsrfUtils;

if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}

if (!$encounter) { // comes from globals.php
    die(xlt("Internal error: we do not seem to be in an encounter!"));
}
//echo '<pre>';print_r($_POST);exit();
$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$client_information  = json_encode(array('client_name'=>$_POST['cf_clinet_name'],'discharage_detox'=>$_POST['cf_discharge_date'],'DOA'=>$_POST['cf_doa'],'discharge_php'=>$_POST['cf_date_discharge_php'],
                      'detox_treatment_plan'=>$_POST['cf_treatement_plan'],'php_treatment_plan'=>$_POST['cf_php_treatement_plan']));

$client_strength    = json_encode(array('client_strength'=>$_POST['client_strength'],'client_ability'=>$_POST['client_ability']));
$client_need        = $_POST['client_need'];
$substance_disorder = $_POST['substance_disorder'];
$transitional_plan  = json_encode(array('halfway_house'=>$_POST['TP_halfway_house'],'halfway_house_data'=>$_POST['TP_halfway_house_val'],
                    'inpatient_other'=>$_POST['TP_inpat'],'inpatient_other_val'=>$_POST['TP_inpat_val'],'inpatient_detox'=>$_POST['TP_inpatient_detox'],'inpatient_detox_val'=>$_POST['TP_inpatient_detox_val'],
                    'partial_care'=>$_POST['TP_partial'],'partial_care_val'=>$_POST['TP_partial_val'],'cooccure_partial_care'=>$_POST['TP_co_occure'],'cooccure_partial_care_val'=>$_POST['TP_co_occure_val'],
                    'intensive_outpat'=>$_POST['TP_int_out_treat'],'intensive_outpat_val'=>$_POST['TP_int_out_treat_val'],'cocoure_int_pat'=>$_POST['TP_co_occ_inte_pat'],'cocoure_int_pat_val'=>$_POST['TP_co_occ_inte_pat_val'],
                    'private_theraphist'=>$_POST['TP_private_theraphist'],'private_theraphist_val'=>$_POST['TP_private_theraphist_val'],'sobxone'=>$_POST['subxone_maintain'],'subxone_val'=>$_POST['subxone_maintain_val'],
                    'pain_managemnet'=>$_POST['pain_management'],'pain_managemnet_val'=>$_POST['pain_managemnet_val'],'primary_care'=>$_POST['TP_primary_care'],'primary_care_val'=>$_POST['TP_primary_care_val'],
                    'meeting'=>$_POST['TP_12meeting'],'meeting_val'=>$_POST['TP_12meeting_val'],'relapse_prevent'=>$_POST['TP_relapse_prevent'],'relapse_prevent_val'=>$_POST['TP_relapse_prevent_val'],
                    'other_support'=>$_POST['TP_other_support'],'other_support_val',$_POST['TP_other_support_val']));

$appoitment_date    = date("Y-m-d", strtotime($_POST['intake_appoitment_date']));
$comments           = $_POST['comments'];
$legal_history      = json_encode(array('legal_history'=>$_POST['legal_history'],'legal_history_client'=>$_POST['legal_history_client']));
$employment_vocation= json_encode(array('employment_vocation'=>$_POST['employment_vocation'],'employement_vocation_client'=>$_POST['employement_vocation_client']));
$educational        = json_encode(array('educational'=>$_POST['educational'],'educational_client'=>$_POST['educational_client']));
$psychosocial       = json_encode(array('psychosocial'=>$_POST['psychosocial'],'psychosocial_client'=>$_POST['psychosocial_client']));
$client_name1       = $_POST['clinet_name1'];
$clinet_name2       = $_POST['clinet_name2'];
$text1       = $_POST['text1'];
$text2       = $_POST['text2'];
// echo $text1;
// echo $text2;
$print_information  = json_encode(array('print_clientname1'=>$_POST['print_clientname1'],'print_date1'=>$_POST['print_date1'],'print_signature1'=>$_POST['print_signature1'],
                    'print_date2',$_POST['print_date2'],'print_signature2'=>$_POST['print_signature2'],'print_date3'=>$_POST['print_date3'],'print_signature3'=>$_POST['print_signature3']));                  
                    
if ($id && $id != 0)
{
    sqlStatement("UPDATE form_transitional_plan SET client_information=?,client_strength=?,client_need=?,substance_disorder=?,transitinal_plan=?,appoitment_date=?,comments=?,legal_history=?,employement_vocation=?,educational=?,Psychosocial=?,client_name1=?,clinet_name2=?,print_patient=?,text1=?,text2=? WHERE id = ?",array($client_information,$client_strength,$client_need,$substance_disorder,$transitional_plan,$appoitment_date,$comments,$legal_history,$employment_vocation,$educational,$psychosocial,$client_name1,$clinet_name2,$print_information,$text1,$text2,$id));
   
    // $newid = sqlstament("UPDATE form_columbia_suicide SET wish_dead=?,non_specifi_active=?,active_susaid=?,active_susaid_without=?,active_susaid_spe_plan=?,preparatory_acts=? WHERE id=?",array($wish_data,$non_specific_active_data,$active_suicide_ideation_data,$active_suicide_long_data,$active_suicide_data,$Preparatory_act_data,$id));     
}
else
{    
    $newid  = sqlInsert("INSERT INTO form_transitional_plan(pid,encounter,user,date,activity,client_information,client_strength,client_need,substance_disorder,transitinal_plan,appoitment_date,comments,legal_history,employement_vocation,educational,Psychosocial,client_name1,clinet_name2,print_patient,text1,text2)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",array($pid,$encounter,$_SESSION['authUser'],date('Y-m-d'),'1',$client_information,$client_strength,$client_need,$substance_disorder,$transitional_plan,$appoitment_date,$comments,$legal_history,$employment_vocation,$educational,$psychosocial,$client_name1,$clinet_name2,$print_information,$text1,$text2,));
    addForm($encounter,"Transitional Plan",$newid,"transitional_form",$pid,$userauthorized);
}
formHeader("Redirecting....");
formJump();
formFooter();
