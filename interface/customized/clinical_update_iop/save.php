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

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$pname=$_POST["pname"];
$pdob=$_POST["pdob"];
$pdoa=$_POST["pdoa"];

$medications_prescribed=$_POST["medications_prescribed"];
$medications_prescribed_dosage=$_POST["medications_prescribed_dosage"];

$Compliant_with_Medications=$_POST["Compliant_with_Medications"];
$Compliant_with_Medications_explain=$_POST["Compliant_with_Medications_explain"];


$Contract_for_safety=$_POST["Contract_for_safety"];
$Contract_for_safety_explain=$_POST["Contract_for_safety_explain"];

$Current_psychosis=$_POST["Current_psychosis"];
$Current_psychosis_explain=$_POST["Current_psychosis_explain"];

$Current_suicidal=$_POST["Current_suicidal"];
$Current_suicidal_explain=$_POST["Current_suicidal_explain"];

$Current_homicidal=$_POST["Current_homicidal"];
$Current_homicidal_explain=$_POST["Current_homicidal_explain"];



$Medical_complications=$_POST["Medical_complications"];
$Medical_complications_explain=$_POST["Medical_complications_explain"];

$patient_is_working=$_POST["patient_is_working"];

$Temporary_current_sponsor=$_POST["Temporary_current_sponsor"];

$Frequency_of_meetings=$_POST["Frequency_of_meetings"];

    $appearance = array();
    foreach($_POST['appearance'] as $val)
    {
    $appearance[] = (int) $val;
    }
$appearance = implode(',', $appearance);
$appearance_describe=$_POST["appearance_describe"];

$behavior = array();
foreach($_POST['behavior'] as $val)
{
$behavior[] = (int) $val;
}
$behavior = implode(',', $behavior);
$behavior_other_explain=$_POST["behavior_other_explain"];

$Musculoskeletal_describe=$_POST["Musculoskeletal_describe"];
$strength=$_POST["strength"];
$gait=$_POST["gait"];


$Attitude = array();
foreach($_POST['Attitude'] as $val)
{
$Attitude[] = (int) $val;
}
$Attitude = implode(',', $Attitude);
$Attitude_describe=$_POST["Attitude_describe"];


$Motor = array();
foreach($_POST['Motor'] as $val)
{
$Motor[] = (int) $val;
}
$Motor = implode(',', $Motor);


$speech = array();
foreach($_POST['speech'] as $val)
{
$speech[] = (int) $val;
}
$speech = implode(',', $speech);
$Speech_describe=$_POST["Speech_describe"];

$Mood = array();
foreach($_POST['Mood'] as $val)
{
$Mood[] = (int) $val;
}
$Mood = implode(',', $Mood);
$Mood_describe=$_POST["Mood_describe"];

$Affect = array();
foreach($_POST['Affect'] as $val)
{
$Affect[] = (int) $val;
}
$Affect = implode(',', $Affect);
$Affect_describe=$_POST["Affect_describe"];

$Process = array();
foreach($_POST['Process'] as $val)
{
$Process[] = (int) $val;
}
$Process = implode(',', $Process);

$Computations=$_POST["Computations"];
$Abstractions=$_POST["Abstractions"];
$Thought_Process_describe=$_POST["Thought_Process_describe"];

$Associations = array();
foreach($_POST['Associations'] as $val)
{
$Associations[] = (int) $val;
}
$Associations = implode(',', $Associations);
$Thought_Associations_describe=$_POST["Thought_Associations_describe"];

$Content = array();
foreach($_POST['Content'] as $val)
{
$Content[] = (int) $val;
}
$Content = implode(',', $Content);

$describe2=$_POST["describe2"];



$Memory=$_POST["Memory"];
$Recent=$_POST["Recent"];
$Remote=$_POST["Remote"];
$mrr_describe=$_POST["mrr_describe"];


$Insight = array();
foreach($_POST['Insight'] as $val)
{
$Insight[] = (int) $val;
}
$Insight = implode(',', $Insight);
$Insight_describe=$_POST["Insight_describe"];

$Judgment=$_POST["Judgment"];
$Judgment_Insight=$_POST["Judgment_Insight"];
$Judgment_describe=$_POST["Judgment_describe"];

$Orientation=$_POST["Orientation"];
$Attention=$_POST["Attention"];
$Orientation_describe=$_POST["Orientation_describe"];

$Language_Objects=$_POST["Language_Objects"];
$Language_phrases=$_POST["Language_phrases"];
$Language_describe=$_POST["Language_describe"];

$Knowledge_Current=$_POST["Knowledge_Current"];
$Knowledge_History=$_POST["Knowledge_History"];
$Knowledge_describe=$_POST["Knowledge_describe"];

$Intelligence=$_POST["Intelligence"];
$Intelligence_describe=$_POST["Intelligence_describe"];

$Motivation=$_POST["Motivation"];
$Motivation_explain=$_POST["Motivation_explain"];

$Group_Participation=$_POST["Group_Participation"];
$Group_Participation_explain=$_POST["Group_Participation_explain"];

$Legal_update=$_POST["Legal_update"];

$Date_of_test=$_POST["Date_of_test"];

$onsite=$_POST["onsite"];

$negative_for_all=$_POST["negative-for-all"];
$positive = array();
foreach($_POST['positive'] as $val)
{
$positive[] = (int) $val;
}
$positive = implode(',', $positive);

$faint = array();
foreach($_POST['faint'] as $val)
{
$faint[] = (int) $val;
}
$faint = implode(',', $faint);

$none_why=$_POST['none_why'];

    if ($id && $id != 0) {
    sqlStatement("UPDATE form_clinical_update_iop SET pname=?,pdob=?,pdoa=?,medications_prescribed=?,medications_prescribed_dosage=?,Compliant_with_Medications=?,Compliant_with_Medications_explain=?,Contract_for_safety=?,Contract_for_safety_explain=?,Current_psychosis=?,Current_psychosis_explain=?,Current_suicidal=?,Current_suicidal_explain=?,Current_homicidal=?,Current_homicidal_explain=?,Medical_complications=?,Medical_complications_explain=?,patient_is_working=?,Temporary_current_sponsor=?,Frequency_of_meetings=?,appearance=?,appearance_describe=?,behavior=?,behavior_other_explain=?,Musculoskeletal_describe=?,strength=?,gait=?,Attitude=?,Attitude_describe=?,Motor=?,speech=?,Speech_describe=?,Mood=?,Mood_describe=?,Affect=?,Affect_describe=?,Process=?,Computations=?,Abstractions=?,Thought_Process_describe=?,Associations=?,Thought_Associations_describe=?,Content=?,describe2=?,Memory=?,Recent=?,Remote=?,mrr_describe=?,Insight=?,Insight_describe=?,Judgment=?,Judgment_Insight=?,Judgment_describe=?,Orientation=?,Attention=?,Orientation_describe=?,Language_Objects=?,Language_phrases=?,Language_describe=?,Knowledge_Current=?,Knowledge_History=?,Knowledge_describe=?,Intelligence=?,Intelligence_describe=?,Motivation=?,Motivation_explain=?,Group_Participation=?,Group_Participation_explain=?,Legal_update=?,Date_of_test=?,onsite=?,negative_for_all=?,positive=?,faint=?,none_why=? WHERE id = ?",
    array($pname,$pdob,$pdoa,$medications_prescribed,$medications_prescribed_dosage,$Compliant_with_Medications,$Compliant_with_Medications_explain,$Contract_for_safety,$Contract_for_safety_explain,$Current_psychosis,$Current_psychosis_explain,$Current_suicidal,$Current_suicidal_explain,$Current_homicidal,$Current_homicidal_explain,$Medical_complications,$Medical_complications_explain,$patient_is_working,$Temporary_current_sponsor,$Frequency_of_meetings,$appearance,$appearance_describe,$behavior,$behavior_other_explain,$Musculoskeletal_describe,$strength,$gait,$Attitude,$Attitude_describe,$Motor,$speech,$Speech_describe,$Mood,$Mood_describe,$Affect,$Affect_describe,$Process,$Computations,$Abstractions,$Thought_Process_describe,$Associations,$Thought_Associations_describe,$Content,$describe2,$Memory,$Recent,$Remote,$mrr_describe,$Insight,$Insight_describe,$Judgment,$Judgment_Insight,$Judgment_describe,$Orientation,$Attention,$Orientation_describe,$Language_Objects,$Language_phrases,$Language_describe,$Knowledge_Current,$Knowledge_History,$Knowledge_describe,$Intelligence,$Intelligence_describe,$Motivation,$Motivation_explain,$Group_Participation,$Group_Participation_explain,$Legal_update,$Date_of_test,$onsite,$negative_for_all,$positive,$faint,$none_why,$id));
}else
{
    $newid = sqlInsert("INSERT INTO form_clinical_update_iop(pid,encounter,pname,pdob,pdoa,medications_prescribed,medications_prescribed_dosage,Compliant_with_Medications,Compliant_with_Medications_explain,Contract_for_safety,Contract_for_safety_explain,Current_psychosis,Current_psychosis_explain,Current_suicidal,Current_suicidal_explain,Current_homicidal,Current_homicidal_explain,Medical_complications,Medical_complications_explain,patient_is_working,Temporary_current_sponsor,Frequency_of_meetings,appearance,appearance_describe,behavior,behavior_other_explain,Musculoskeletal_describe,strength,gait,Attitude,Attitude_describe,Motor,speech,Speech_describe,Mood,Mood_describe,Affect,Affect_describe,Process,Computations,Abstractions,Thought_Process_describe,Associations,Thought_Associations_describe,Content,describe2,Memory,Recent,Remote,mrr_describe,Insight,Insight_describe,Judgment,Judgment_Insight,Judgment_describe,Orientation,Attention,Orientation_describe,Language_Objects,Language_phrases,Language_describe,Knowledge_Current,Knowledge_History,Knowledge_describe,Intelligence,Intelligence_describe,Motivation,Motivation_explain,Group_Participation,Group_Participation_explain,Legal_update,Date_of_test,onsite,negative_for_all,positive,faint,date,none_why)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$pname,$pdob,$pdoa,$medications_prescribed,$medications_prescribed_dosage,$Compliant_with_Medications,$Compliant_with_Medications_explain,$Contract_for_safety,$Contract_for_safety_explain,$Current_psychosis,$Current_psychosis_explain,$Current_suicidal,$Current_suicidal_explain,$Current_homicidal,$Current_homicidal_explain,$Medical_complications,$Medical_complications_explain,$patient_is_working,$Temporary_current_sponsor,$Frequency_of_meetings,$appearance,$appearance_describe,$behavior,$behavior_other_explain,$Musculoskeletal_describe,$strength,$gait,$Attitude,$Attitude_describe,$Motor,$speech,$Speech_describe,$Mood,$Mood_describe,$Affect,$Affect_describe,$Process,$Computations,$Abstractions,$Thought_Process_describe,$Associations,$Thought_Associations_describe,$Content,$describe2,$Memory,$Recent,$Remote,$mrr_describe,$Insight,$Insight_describe,$Judgment,$Judgment_Insight,$Judgment_describe,$Orientation,$Attention,$Orientation_describe,$Language_Objects,$Language_phrases,$Language_describe,$Knowledge_Current,$Knowledge_History,$Knowledge_describe,$Intelligence,$Intelligence_describe,$Motivation,$Motivation_explain,$Group_Participation,$Group_Participation_explain,$Legal_update,$Date_of_test,$onsite,$negative_for_all,$positive,$faint,date('y-m-d'),$none_why));
    addForm($encounter, "Clinical Update IOP", $newid, "clinical_update_iop",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
if($id){
    $fid=$id;
}
else{
    $fid=$newid;
}


redirect($fid);

function redirect($fid) {
    header("Location: pdf_form.php?encounter={$_SESSION["encounter"]}&pid={$_SESSION["pid"]}&id={$fid}");
    exit();
}
