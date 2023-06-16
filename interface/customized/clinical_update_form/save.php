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
// echo 'test';
// exit;
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$_POST['anti1']= isset($_POST['anti1'])?$_POST['anti1']:' ';
$_POST['anti2']= isset($_POST['anti2'])?$_POST['anti2']:' ';
$_POST['anti3']= isset($_POST['anti3'])?$_POST['anti3']:' ';
$_POST['anti4']= isset($_POST['anti4'])?$_POST['anti4']:' ';

$_POST['compliant1']= isset($_POST['compliant1'])?$_POST['compliant1']:' ';
$_POST['compliant2']= isset($_POST['compliant2'])?$_POST['compliant2']:' ';


$_POST['safety1']= isset($_POST['safety1'])?$_POST['safety1']:' ';
$_POST['safety2']= isset($_POST['safety2'])?$_POST['safety2']:' ';

$_POST['psychosis1']= isset($_POST['psychosis1'])?$_POST['psychosis1']:' ';
$_POST['psychosis2']= isset($_POST['psychosis2'])?$_POST['psychosis2']:' ';

$_POST['suicidal_ideation1']= isset($_POST['suicidal_ideation1'])?$_POST['suicidal_ideation1']:' ';
$_POST['suicidal_ideation2']= isset($_POST['suicidal_ideation2'])?$_POST['suicidal_ideation2']:' ';

$_POST['homicidal1']= isset($_POST['homicidal1'])?$_POST['homicidal1']:' ';
$_POST['homicidal2']= isset($_POST['homicidal2'])?$_POST['homicidal2']:' ';

$_POST['medical1']= isset($_POST['medical1'])?$_POST['medical1']:' ';
$_POST['medical2']= isset($_POST['medical2'])?$_POST['medical2']:' ';

$_POST['symptoms1']= isset($_POST['symptoms1'])?$_POST['symptoms1']:' ';
$_POST['symptoms2']= isset($_POST['symptoms2'])?$_POST['symptoms2']:' ';
$_POST['symptoms3']= isset($_POST['symptoms3'])?$_POST['symptoms3']:' ';
$_POST['symptoms4']= isset($_POST['symptoms4'])?$_POST['symptoms4']:' ';
$_POST['symptoms5']= isset($_POST['symptoms5'])?$_POST['symptoms5']:' ';
$_POST['symptoms6']= isset($_POST['symptoms6'])?$_POST['symptoms6']:' ';
$_POST['symptoms7']= isset($_POST['symptoms7'])?$_POST['symptoms7']:' ';
$_POST['symptoms8']= isset($_POST['symptoms8'])?$_POST['symptoms8']:' ';
$_POST['symptoms9']= isset($_POST['symptoms9'])?$_POST['symptoms9']:' ';
$_POST['symptoms10']= isset($_POST['symptoms10'])?$_POST['symptoms10']:' ';
$_POST['symptoms11']= isset($_POST['symptoms11'])?$_POST['symptoms11']:' ';
$_POST['symptoms12']= isset($_POST['symptoms12'])?$_POST['symptoms12']:' ';
$_POST['symptoms13']= isset($_POST['symptoms13'])?$_POST['symptoms13']:' ';
$_POST['symptoms14']= isset($_POST['symptoms14'])?$_POST['symptoms14']:' ';

$_POST['frequency1']= isset($_POST['frequency1'])?$_POST['frequency1']:' ';
$_POST['frequency2']= isset($_POST['frequency2'])?$_POST['frequency2']:' ';

$_POST['appearance1']= isset($_POST['appearance1'])?$_POST['appearance1']:' ';
$_POST['appearance2']= isset($_POST['appearance2'])?$_POST['appearance2']:' ';
$_POST['appearance3']= isset($_POST['appearance3'])?$_POST['appearance3']:' ';
$_POST['appearance4']= isset($_POST['appearance4'])?$_POST['appearance4']:' ';
$_POST['appearance5']= isset($_POST['appearance5'])?$_POST['appearance5']:' ';
$_POST['appearance6']= isset($_POST['appearance6'])?$_POST['appearance6']:' ';

$_POST['behavior1']= isset($_POST['behavior1'])?$_POST['behavior1']:' ';
$_POST['behavior2']= isset($_POST['behavior2'])?$_POST['behavior2']:' ';
$_POST['behavior3']= isset($_POST['behavior3'])?$_POST['behavior3']:' ';
$_POST['behavior4']= isset($_POST['behavior4'])?$_POST['behavior4']:' ';
$_POST['behavior5']= isset($_POST['behavior5'])?$_POST['behavior5']:' ';
$_POST['behavior6']= isset($_POST['behavior6'])?$_POST['behavior6']:' ';

$_POST['musculoskeletal1']= isset($_POST['musculoskeletal1'])?$_POST['musculoskeletal1']:' ';
$_POST['musculoskeletal2']= isset($_POST['musculoskeletal2'])?$_POST['musculoskeletal2']:' ';
$_POST['musculoskeletal3']= isset($_POST['musculoskeletal3'])?$_POST['musculoskeletal3']:' ';
$_POST['musculoskeletal4']= isset($_POST['musculoskeletal4'])?$_POST['musculoskeletal4']:' ';

$_POST['attitude1']= isset($_POST['attitude1'])?$_POST['attitude1']:' ';
$_POST['attitude2']= isset($_POST['attitude2'])?$_POST['attitude2']:' ';
$_POST['attitude3']= isset($_POST['attitude3'])?$_POST['attitude3']:' ';


$_POST['motor1']= isset($_POST['motor1'])?$_POST['motor1']:' ';
$_POST['motor2']= isset($_POST['motor2'])?$_POST['motor2']:' ';
$_POST['motor3']= isset($_POST['motor3'])?$_POST['motor3']:' ';
$_POST['motor4']= isset($_POST['motor4'])?$_POST['motor4']:' ';
$_POST['motor5']= isset($_POST['motor5'])?$_POST['motor5']:' ';
$_POST['motor6']= isset($_POST['motor6'])?$_POST['motor6']:' ';

$_POST['speech1']= isset($_POST['speech1'])?$_POST['speech1']:' ';
$_POST['speech2']= isset($_POST['speech2'])?$_POST['speech2']:' ';
$_POST['speech3']= isset($_POST['speech3'])?$_POST['speech3']:' ';
$_POST['speech4']= isset($_POST['speech4'])?$_POST['speech4']:' ';
$_POST['speech5']= isset($_POST['speech5'])?$_POST['speech5']:' ';
$_POST['speech6']= isset($_POST['speech6'])?$_POST['speech6']:' ';
$_POST['speech7']= isset($_POST['speech7'])?$_POST['speech7']:' ';
$_POST['speech8']= isset($_POST['speech8'])?$_POST['speech8']:' ';
$_POST['speech9']= isset($_POST['speech9'])?$_POST['speech9']:' ';
$_POST['speech10']= isset($_POST['speech10'])?$_POST['speech10']:' ';

$_POST['mood1']= isset($_POST['mood1'])?$_POST['mood1']:' ';
$_POST['mood2']= isset($_POST['mood2'])?$_POST['mood2']:' ';
$_POST['mood3']= isset($_POST['mood3'])?$_POST['mood3']:' ';
$_POST['mood4']= isset($_POST['mood4'])?$_POST['mood4']:' ';
$_POST['mood5']= isset($_POST['mood5'])?$_POST['mood5']:' ';
$_POST['mood6']= isset($_POST['mood6'])?$_POST['mood6']:' ';
$_POST['mood7']= isset($_POST['mood7'])?$_POST['mood7']:' ';
$_POST['mood8']= isset($_POST['mood8'])?$_POST['mood8']:' ';
$_POST['mood9']= isset($_POST['mood9'])?$_POST['mood9']:' ';
$_POST['mood10']= isset($_POST['mood10'])?$_POST['mood10']:' ';
$_POST['mood11']= isset($_POST['mood11'])?$_POST['mood11']:' ';

$_POST['affect1']= isset($_POST['affect1'])?$_POST['affect1']:' ';
$_POST['affect2']= isset($_POST['affect2'])?$_POST['affect2']:' ';
$_POST['affect3']= isset($_POST['affect3'])?$_POST['affect3']:' ';
$_POST['affect4']= isset($_POST['affect4'])?$_POST['affect4']:' ';
$_POST['affect5']= isset($_POST['affect5'])?$_POST['affect5']:' ';
$_POST['affect6']= isset($_POST['affect6'])?$_POST['affect6']:' ';
// $_POST['affect7']= isset($_POST['affect7'])?$_POST['affect7']:' ';
$_POST['affect8']= isset($_POST['affect8'])?$_POST['affect8']:' ';
$_POST['affect9']= isset($_POST['affect9'])?$_POST['affect9']:' ';
$_POST['affect10']= isset($_POST['affect10'])?$_POST['affect10']:' ';

$_POST['thought_process1']= isset($_POST['thought_process1'])?$_POST['thought_process1']:' ';
$_POST['thought_process2']= isset($_POST['thought_process2'])?$_POST['thought_process2']:' ';
$_POST['thought_process3']= isset($_POST['thought_process3'])?$_POST['thought_process3']:' ';
$_POST['thought_process4']= isset($_POST['thought_process4'])?$_POST['thought_process4']:' ';
$_POST['thought_process5']= isset($_POST['thought_process5'])?$_POST['thought_process5']:' ';
$_POST['thought_process6']= isset($_POST['thought_process6'])?$_POST['thought_process6']:' ';
$_POST['thought_process7']= isset($_POST['thought_process7'])?$_POST['thought_process7']:' ';
$_POST['thought_process8']= isset($_POST['thought_process8'])?$_POST['thought_process8']:' ';
$_POST['thought_process9']= isset($_POST['thought_process9'])?$_POST['thought_process9']:' ';
$_POST['thought_process10']= isset($_POST['thought_process10'])?$_POST['thought_process10']:' ';
$_POST['thought_process11']= isset($_POST['thought_process11'])?$_POST['thought_process11']:' ';
$_POST['thought_process12']= isset($_POST['thought_process12'])?$_POST['thought_process12']:' ';
$_POST['thought_process13']= isset($_POST['thought_process13'])?$_POST['thought_process13']:' ';
$_POST['thought_process14']= isset($_POST['thought_process14'])?$_POST['thought_process14']:' ';
$_POST['thought_process15']= isset($_POST['thought_process15'])?$_POST['thought_process15']:' ';
$_POST['thought_process16']= isset($_POST['thought_process16'])?$_POST['thought_process16']:' ';
$_POST['thought_process17']= isset($_POST['thought_process17'])?$_POST['thought_process17']:' ';
$_POST['thought_process18']= isset($_POST['thought_process18'])?$_POST['thought_process18']:' ';
$_POST['thought_process19']= isset($_POST['thought_process19'])?$_POST['thought_process19']:' ';
$_POST['thought_process21']= isset($_POST['thought_process21'])?$_POST['thought_process21']:' ';
$_POST['thought_process22']= isset($_POST['thought_process22'])?$_POST['thought_process22']:' ';
$_POST['thought_process23']= isset($_POST['thought_process23'])?$_POST['thought_process23']:' ';
$_POST['thought_process24']= isset($_POST['thought_process24'])?$_POST['thought_process24']:' ';

$_POST['thought_ass1']= isset($_POST['thought_ass1'])?$_POST['thought_ass1']:' ';
$_POST['thought_ass2']= isset($_POST['thought_ass2'])?$_POST['thought_ass2']:' ';
$_POST['thought_ass3']= isset($_POST['thought_ass3'])?$_POST['thought_ass3']:' ';
$_POST['thought_ass4']= isset($_POST['thought_ass4'])?$_POST['thought_ass4']:' ';

$_POST['thought_con1']= isset($_POST['thought_con1'])?$_POST['thought_con1']:' ';
$_POST['thought_con2']= isset($_POST['thought_con2'])?$_POST['thought_con2']:' ';
$_POST['thought_con3']= isset($_POST['thought_con3'])?$_POST['thought_con3']:' ';
$_POST['thought_con4']= isset($_POST['thought_con4'])?$_POST['thought_con4']:' ';
$_POST['thought_con5']= isset($_POST['thought_con5'])?$_POST['thought_con5']:' ';
$_POST['thought_con6']= isset($_POST['thought_con6'])?$_POST['thought_con6']:' ';
$_POST['thought_con7']= isset($_POST['thought_con7'])?$_POST['thought_con7']:' ';
$_POST['thought_con8']= isset($_POST['thought_con8'])?$_POST['thought_con8']:' ';
$_POST['thought_con9']= isset($_POST['thought_con9'])?$_POST['thought_con9']:' ';

$_POST['memory1']= isset($_POST['memory1'])?$_POST['memory1']:' ';
$_POST['memory2']= isset($_POST['memory2'])?$_POST['memory2']:' ';
$_POST['memory3']= isset($_POST['memory3'])?$_POST['memory3']:' ';
$_POST['memory4']= isset($_POST['memory4'])?$_POST['memory4']:' ';
$_POST['memory5']= isset($_POST['memory5'])?$_POST['memory5']:' ';
$_POST['memory6']= isset($_POST['memory6'])?$_POST['memory6']:' ';
$_POST['memory7']= isset($_POST['memory7'])?$_POST['memory7']:' ';
$_POST['memory8']= isset($_POST['memory8'])?$_POST['memory8']:' ';

$_POST['insight1']= isset($_POST['insight1'])?$_POST['insight1']:' ';
$_POST['insight2']= isset($_POST['insight2'])?$_POST['insight2']:' ';
$_POST['insight3']= isset($_POST['insight3'])?$_POST['insight3']:' ';
$_POST['insight4']= isset($_POST['insight4'])?$_POST['insight4']:' ';
$_POST['insight5']= isset($_POST['insight5'])?$_POST['insight5']:' ';

$_POST['judgment1']= isset($_POST['judgment1'])?$_POST['judgment1']:' ';
$_POST['judgment2']= isset($_POST['judgment2'])?$_POST['judgment2']:' ';
$_POST['judgment3']= isset($_POST['judgment3'])?$_POST['judgment3']:' ';
$_POST['judgment4']= isset($_POST['judgment4'])?$_POST['judgment4']:' ';
$_POST['judgment5']= isset($_POST['judgment5'])?$_POST['judgment5']:' ';
$_POST['judgment6']= isset($_POST['judgment6'])?$_POST['judgment6']:' ';
$_POST['judgment7']= isset($_POST['judgment7'])?$_POST['judgment7']:' ';

$_POST['orient1']= isset($_POST['orient1'])?$_POST['orient1']:' ';
$_POST['orient2']= isset($_POST['orient2'])?$_POST['orient2']:' ';
$_POST['orient3']= isset($_POST['orient3'])?$_POST['orient3']:' ';
$_POST['orient4']= isset($_POST['orient4'])?$_POST['orient4']:' ';
$_POST['orient5']= isset($_POST['orient5'])?$_POST['orient5']:' ';

$_POST['language1']= isset($_POST['language1'])?$_POST['language1']:' ';
$_POST['language2']= isset($_POST['language2'])?$_POST['language2']:' ';
$_POST['language3']= isset($_POST['language3'])?$_POST['language3']:' ';
$_POST['language4']= isset($_POST['language4'])?$_POST['language4']:' ';
$_POST['language5']= isset($_POST['language5'])?$_POST['language5']:' ';

$_POST['knowledge1']= isset($_POST['knowledge1'])?$_POST['knowledge1']:' ';
$_POST['knowledge2']= isset($_POST['knowledge2'])?$_POST['knowledge2']:' ';
$_POST['knowledge3']= isset($_POST['knowledge3'])?$_POST['knowledge3']:' ';
$_POST['knowledge4']= isset($_POST['knowledge4'])?$_POST['knowledge4']:' ';
$_POST['knowledge5']= isset($_POST['knowledge5'])?$_POST['knowledge5']:' ';

$_POST['intel1']= isset($_POST['intel1'])?$_POST['intel1']:' ';
$_POST['intel2']= isset($_POST['intel2'])?$_POST['intel2']:' ';
$_POST['intel3']= isset($_POST['intel3'])?$_POST['intel3']:' ';
$_POST['intel4']= isset($_POST['intel4'])?$_POST['intel4']:' ';
$_POST['intel5']= isset($_POST['intel5'])?$_POST['intel5']:' ';
$_POST['intel6']= isset($_POST['intel6'])?$_POST['intel6']:' ';
$_POST['intel7']= isset($_POST['intel7'])?$_POST['intel7']:' ';
$_POST['intel8']= isset($_POST['intel8'])?$_POST['intel8']:' ';

$_POST['appetite1']= isset($_POST['appetite1'])?$_POST['appetite1']:' ';
$_POST['appetite2']= isset($_POST['appetite2'])?$_POST['appetite2']:' ';
$_POST['appetite3']= isset($_POST['appetite3'])?$_POST['appetite3']:' ';
$_POST['appetite4']= isset($_POST['appetite4'])?$_POST['appetite4']:' ';

$_POST['percentage1']= isset($_POST['percentage1'])?$_POST['percentage1']:' ';
$_POST['percentage2']= isset($_POST['percentage2'])?$_POST['percentage2']:' ';
$_POST['percentage3']= isset($_POST['percentage3'])?$_POST['percentage3']:' ';
$_POST['percentage4']= isset($_POST['percentage4'])?$_POST['percentage4']:' ';

$_POST['sleep1']= isset($_POST['sleep1'])?$_POST['sleep1']:' ';
$_POST['sleep2']= isset($_POST['sleep2'])?$_POST['sleep2']:' ';
$_POST['sleep3']= isset($_POST['sleep3'])?$_POST['sleep3']:' ';
$_POST['sleep4']= isset($_POST['sleep4'])?$_POST['sleep4']:' ';

$_POST['problem1']= isset($_POST['problem1'])?$_POST['problem1']:' ';
$_POST['problem2']= isset($_POST['problem2'])?$_POST['problem2']:' ';
$_POST['problem3']= isset($_POST['problem3'])?$_POST['problem3']:' ';
$_POST['problem4']= isset($_POST['problem4'])?$_POST['problem4']:' ';
$_POST['problem5']= isset($_POST['problem5'])?$_POST['problem5']:' ';

$_POST['anxious1']= isset($_POST['anxious1'])?$_POST['anxious1']:' ';
$_POST['anxious2']= isset($_POST['anxious2'])?$_POST['anxious2']:' ';
$_POST['anxious3']= isset($_POST['anxious3'])?$_POST['anxious3']:' ';
$_POST['anxious4']= isset($_POST['anxious4'])?$_POST['anxious4']:' ';
$_POST['anxious5']= isset($_POST['anxious5'])?$_POST['anxious5']:' ';
$_POST['anxious6']= isset($_POST['anxious6'])?$_POST['anxious6']:' ';
$_POST['anxious7']= isset($_POST['anxious7'])?$_POST['anxious7']:' ';
$_POST['anxious8']= isset($_POST['anxious8'])?$_POST['anxious8']:' ';

$_POST['motivation1']= isset($_POST['motivation1'])?$_POST['motivation1']:' ';
$_POST['motivation2']= isset($_POST['motivation2'])?$_POST['motivation2']:' ';
$_POST['motivation3']= isset($_POST['motivation3'])?$_POST['motivation3']:' ';

$_POST['group_parti1']= isset($_POST['group_parti1'])?$_POST['group_parti1']:' ';
$_POST['group_parti2']= isset($_POST['group_parti2'])?$_POST['group_parti2']:' ';
$_POST['group_parti3']= isset($_POST['group_parti3'])?$_POST['group_parti3']:' ';
$_POST['group_parti4']= isset($_POST['group_parti4'])?$_POST['group_parti4']:' ';
$_POST['group_parti5']= isset($_POST['group_parti5'])?$_POST['group_parti5']:' ';

$_POST['onsite']= isset($_POST['onsite'])?$_POST['onsite']:' ';
$_POST['overnight']= isset($_POST['overnight'])?$_POST['overnight']:' ';

$_POST['result1']= isset($_POST['result1'])?$_POST['result1']:' ';
$_POST['result2']= isset($_POST['result2'])?$_POST['result2']:' ';
$_POST['result3']= isset($_POST['result3'])?$_POST['result3']:' ';
$_POST['result4']= isset($_POST['result4'])?$_POST['result4']:' ';
$_POST['result5']= isset($_POST['result5'])?$_POST['result5']:' ';
$_POST['result6']= isset($_POST['result6'])?$_POST['result6']:' ';
$_POST['result7']= isset($_POST['result7'])?$_POST['result7']:' ';
$_POST['result8']= isset($_POST['result8'])?$_POST['result8']:' ';
$_POST['result9']= isset($_POST['result9'])?$_POST['result9']:' ';
$_POST['result10']= isset($_POST['result10'])?$_POST['result10']:' ';
$_POST['result11']= isset($_POST['result11'])?$_POST['result11']:' ';
$_POST['result12']= isset($_POST['result12'])?$_POST['result12']:' ';
$_POST['result13']= isset($_POST['result13'])?$_POST['result13']:' ';
$_POST['result14']= isset($_POST['result14'])?$_POST['result14']:' ';
$_POST['result15']= isset($_POST['result15'])?$_POST['result15']:' ';
$_POST['result16']= isset($_POST['result16'])?$_POST['result16']:' ';
$_POST['result17']= isset($_POST['result17'])?$_POST['result17']:' ';

$_POST['family1']= isset($_POST['family1'])?$_POST['family1']:' ';
$_POST['family2']= isset($_POST['family2'])?$_POST['family2']:' ';
$_POST['family3']= isset($_POST['family3'])?$_POST['family3']:' ';
$_POST['family4']= isset($_POST['family4'])?$_POST['family4']:' ';
$_POST['family5']= isset($_POST['family5'])?$_POST['family5']:' ';
$_POST['family6']= isset($_POST['family6'])?$_POST['family6']:' ';
$_POST['family7']= isset($_POST['family7'])?$_POST['family7']:' ';

$_POST['tele1']= isset($_POST['tele1'])?$_POST['tele1']:' ';
$_POST['tele2']= isset($_POST['tele2'])?$_POST['tele2']:' ';
$_POST['tele3']= isset($_POST['tele3'])?$_POST['tele3']:' ';
$_POST['tele4']= isset($_POST['tele4'])?$_POST['tele4']:' ';

$_POST['whom1']= isset($_POST['whom1'])?$_POST['whom1']:' ';
$_POST['whom2']= isset($_POST['whom2'])?$_POST['whom2']:' ';
$_POST['whom3']= isset($_POST['whom3'])?$_POST['whom3']:' ';
$_POST['whom4']= isset($_POST['whom4'])?$_POST['whom4']:' ';
$_POST['whom5']= isset($_POST['whom5'])?$_POST['whom5']:' ';
$_POST['whom6']= isset($_POST['whom6'])?$_POST['whom6']:' ';
$_POST['whom7']= isset($_POST['whom7'])?$_POST['whom7']:' ';

$_POST['source1']= isset($_POST['source1'])?$_POST['source1']:' ';
$_POST['source2']= isset($_POST['source2'])?$_POST['source2']:' ';
$_POST['source3']= isset($_POST['source3'])?$_POST['source3']:' ';

$_POST['support1']= isset($_POST['support1'])?$_POST['support1']:' ';
$_POST['support2']= isset($_POST['support2'])?$_POST['support2']:' ';
$_POST['support3']= isset($_POST['support3'])?$_POST['support3']:' ';


if ($id && $id != 0) {
    $newid = update_form("form_clinical_update", $_POST, $id,$_GET['pid']);   
}
else 
{   
    $newid = submit_form("form_clinical_update", $_POST, $_GET["pid"],$encounter);    

    addForm($encounter, "Clinical Update Status", $newid, "clinical_update_form",  $_SESSION["pid"], $userauthorized);
}



formHeader("Redirecting....");
formJump();
formFooter();
