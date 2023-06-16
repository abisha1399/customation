<?php
/**
 * Clinical instructions form report.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(dirname(__FILE__) . '/../../globals.php');
require_once($GLOBALS["srcdir"] . "/api.inc");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");

    $id= $_GET['id'];
    //print_r($id);
    $data = sqlQuery("select * from form_clinical_update where id='".$id."'");
    if ($data)
    {

        if($data['anti1']=='1' && $data['anti1']!="")
        {
          $anti1 ='checked="checked"';
        }
        if($data['anti2']=='2' && $data['anti2']!="")
        {
          $anti2 ='checked="checked"';
        }
        if($data['anti3']=='3' && $data['anti3']!="")
        {
          $anti3 ='checked="checked"';
        }
        if($data['anti4']=='4' && $data['anti4']!="")
        {
          $anti4 ='checked="checked"';
        }

        if($data['compliant1']=='1' && $data['compliant1']!="")
        {
          $compliant1 ='checked="checked"';
        }
        if($data['compliant2']=='2' && $data['compliant2']!="")
        {
          $compliant2 ='checked="checked"';
        }

        if($data['psychosis1']=='1' && $data['psychosis1']!="")
        {
          $psychosis1 ='checked="checked"';
        }
        if($data['psychosis2']=='2' && $data['psychosis2']!="")
        {
          $psychosis2 ='checked="checked"';
        }

        if($data['suicidal_ideation1']=='1' && $data['suicidal_ideation1']!="")
        {
          $suicidal_ideation1 ='checked="checked"';
        }
        if($data['suicidal_ideation2']=='2' && $data['suicidal_ideation2']!="")
        {
          $suicidal_ideation2 ='checked="checked"';
        }

        if($data['homicidal1']=='1' && $data['homicidal1']!="")
        {
          $homicidal1 ='checked="checked"';
        }
        if($data['homicidal2']=='2' && $data['homicidal2']!="")
        {
          $psychosis2 ='checked="checked"';
        }

        if($data['medical1']=='1' && $data['medical1']!="")
        {
          $medical1 ='checked="checked"';
        }
        if($data['medical2']=='2' && $data['medical2']!="")
        {
          $medical2 ='checked="checked"';
        }

        if($data['symptoms1']=='1' && $data['symptoms1']!="")
        {
          $symptoms1 ='checked="checked"';
        }
        if($data['symptoms2']=='2' && $data['symptoms2']!="")
        {
          $symptoms2 ='checked="checked"';
        }
        if($data['symptoms3']=='3' && $data['symptoms3']!="")
        {
          $symptoms3 ='checked="checked"';
        }
        if($data['symptoms4']=='4' && $data['symptoms4']!="")
        {
          $symptoms4 ='checked="checked"';
        }
        if($data['symptoms5']=='5' && $data['symptoms5']!="")
        {
          $symptoms5 ='checked="checked"';
        }
        if($data['symptoms6']=='6' && $data['symptoms6']!="")
        {
          $symptoms6 ='checked="checked"';
        }
        if($data['symptoms7']=='7' && $data['symptoms7']!="")
        {
          $symptoms7 ='checked="checked"';
        }
        if($data['symptoms8']=='8' && $data['symptoms8']!="")
        {
          $symptoms8 ='checked="checked"';
        }
        if($data['symptoms9']=='9' && $data['symptoms9']!="")
        {
          $symptoms9 ='checked="checked"';
        }
        if($data['symptoms10']=='10' && $data['symptoms10']!="")
        {
          $symptoms10 ='checked="checked"';
        }
        if($data['symptoms11']=='11' && $data['symptoms11']!="")
        {
          $symptoms11 ='checked="checked"';
        }
        if($data['symptoms12']=='12' && $data['symptoms12']!="")
        {
          $symptoms12 ='checked="checked"';
        }
        if($data['symptoms13']=='13' && $data['symptoms13']!="")
        {
          $symptoms13 ='checked="checked"';
        }
        if($data['symptoms14']=='12' && $data['symptoms14']!="")
        {
          $symptoms14 ='checked="checked"';
        }

        if($data['frequency1']=='1' && $data['frequency1']!="")
        {
          $frequency1 ='checked="checked"';
        }
        if($data['frequency2']=='2' && $data['frequency2']!="")
        {
          $frequency2 ='checked="checked"';
        }

        if($data['appearance1']=='1' && $data['appearance1']!="")
        {
          $appearance1 ='checked="checked"';
        }
        if($data['appearance2']=='2' && $data['appearance2']!="")
        {
          $appearance2 ='checked="checked"';
        }
        if($data['appearance3']=='3' && $data['appearance3']!="")
        {
          $appearance3 ='checked="checked"';
        }
        if($data['appearance4']=='4' && $data['appearance4']!="")
        {
          $appearance4 ='checked="checked"';
        }
        if($data['appearance5']=='5' && $data['appearance5']!="")
        {
          $appearance5 ='checked="checked"';
        }
        if($data['appearance6']=='6' && $data['appearance6']!="")
        {
          $appearance6 ='checked="checked"';
        }

        if($data['behavior1']=='1' && $data['behavior1']!="")
        {
          $behavior1 ='checked="checked"';
        }
        if($data['behavior2']=='2' && $data['behavior2']!="")
        {
          $behavior2 ='checked="checked"';
        }
        if($data['behavior3']=='3' && $data['behavior3']!="")
        {
          $behavior3 ='checked="checked"';
        }
        if($data['behavior4']=='4' && $data['behavior4']!="")
        {
          $behavior4 ='checked="checked"';
        }
        if($data['behavior5']=='5' && $data['behavior5']!="")
        {
          $behavior5 ='checked="checked"';
        }
        if($data['behavior6']=='6' && $data['behavior6']!="")
        {
          $behavior6 ='checked="checked"';
        }

        if($data['musculoskeletal1']=='1' && $data['musculoskeletal1']!="")
        {
          $musculoskeletal1 ='checked="checked"';
        }
        if($data['musculoskeletal2']=='2' && $data['musculoskeletal2']!="")
        {
          $musculoskeletal2 ='checked="checked"';
        }
        if($data['musculoskeletal3']=='3' && $data['musculoskeletal3']!="")
        {
          $musculoskeletal3 ='checked="checked"';
        }
        if($data['musculoskeletal4']=='4' && $data['musculoskeletal4']!="")
        {
          $musculoskeletal4 ='checked="checked"';
        }

        if($data['attitude1']=='1' && $data['attitude1']!="")
        {
          $attitude1 ='checked="checked"';
        }
        if($data['attitude2']=='2' && $data['attitude2']!="")
        {
          $attitude2 ='checked="checked"';
        }
        if($data['attitude3']=='3' && $data['attitude3']!="")
        {
          $attitude3 ='checked="checked"';
        }

        if($data['motor1']=='1' && $data['motor1']!="")
        {
          $motor1 ='checked="checked"';
        }
        if($data['motor2']=='2' && $data['motor2']!="")
        {
          $motor2 ='checked="checked"';
        }
        if($data['motor3']=='3' && $data['motor3']!="")
        {
          $motor3 ='checked="checked"';
        }
        if($data['motor4']=='4' && $data['motor4']!="")
        {
          $motor4 ='checked="checked"';
        }
        if($data['motor5']=='5' && $data['motor5']!="")
        {
          $motor5 ='checked="checked"';
        }
        if($data['motor6']=='6' && $data['motor6']!="")
        {
          $motor6 ='checked="checked"';
        }


        if($data['speech1']=='1' && $data['speech1']!="")
        {
          $speech1 ='checked="checked"';
        }
        if($data['speech2']=='2' && $data['speech2']!="")
        {
          $speech2 ='checked="checked"';
        }
        if($data['speech3']=='3' && $data['speech3']!="")
        {
          $speech3 ='checked="checked"';
        }
        if($data['speech4']=='4' && $data['speech4']!="")
        {
          $speech4 ='checked="checked"';
        }
        if($data['speech5']=='5' && $data['speech5']!="")
        {
          $speech5 ='checked="checked"';
        }
        if($data['speech6']=='6' && $data['speech6']!="")
        {
          $speech6 ='checked="checked"';
        }
        if($data['speech7']=='7' && $data['speech7']!="")
        {
          $speech7 ='checked="checked"';
        }
        if($data['speech8']=='8' && $data['speech8']!="")
        {
          $speech8 ='checked="checked"';
        }
        if($data['speech9']=='9' && $data['speech9']!="")
        {
          $speech9 ='checked="checked"';
        }
        if($data['speech10']=='10' && $data['speech10']!="")
        {
          $speech10 ='checked="checked"';
        }

        if($data['mood1']=='1' && $data['mood1']!="")
        {
          $mood1 ='checked="checked"';
        }
        if($data['mood2']=='2' && $data['mood2']!="")
        {
          $mood2 ='checked="checked"';
        }
        if($data['mood3']=='3' && $data['mood3']!="")
        {
          $mood3 ='checked="checked"';
        }
        if($data['mood4']=='4' && $data['mood4']!="")
        {
          $mood4 ='checked="checked"';
        }
        if($data['mood5']=='5' && $data['mood5']!="")
        {
          $mood5 ='checked="checked"';
        }
        if($data['mood6']=='6' && $data['mood6']!="")
        {
          $mood6 ='checked="checked"';
        }
        if($data['mood7']=='7' && $data['mood7']!="")
        {
          $mood7 ='checked="checked"';
        }
        if($data['mood8']=='8' && $data['mood8']!="")
        {
          $mood8 ='checked="checked"';
        }
        if($data['mood9']=='9' && $data['mood9']!="")
        {
          $mood9 ='checked="checked"';
        }
        if($data['mood10']=='10' && $data['mood10']!="")
        {
          $mood10 ='checked="checked"';
        }
        if($data['mood11']=='11' && $data['mood11']!="")
        {
          $mood11 ='checked="checked"';
        }

        if($data['affect1']=='1' && $data['affect1']!="")
        {
          $affect1 ='checked="checked"';
        }
        if($data['affect2']=='2' && $data['affect2']!="")
        {
          $affect2 ='checked="checked"';
        }
        if($data['affect3']=='3' && $data['affect3']!="")
        {
          $affect3 ='checked="checked"';
        }
        if($data['affect4']=='4' && $data['affect4']!="")
        {
          $affect4 ='checked="checked"';
        }
        if($data['affect5']=='5' && $data['affect5']!="")
        {
          $affect5 ='checked="checked"';
        }
        if($data['affect6']=='6' && $data['affect6']!="")
        {
          $affect6 ='checked="checked"';
        }
        if($data['affect7']=='7' && $data['affect7']!="")
        {
          $affect7 ='checked="checked"';
        }
        if($data['affect8']=='8' && $data['affect8']!="")
        {
          $affect8 ='checked="checked"';
        }
        if($data['affect9']=='9' && $data['affect9']!="")
        {
          $affect9 ='checked="checked"';
        }
        if($data['affect10']=='10' && $data['affect10']!="")
        {
          $affect10 ='checked="checked"';
        }

        if($data['thought_process1']=='1' && $data['thought_process1']!="")
        {
          $thought_process1 ='checked="checked"';
        }
        if($data['thought_process2']=='2' && $data['thought_process2']!="")
        {
          $thought_process2 ='checked="checked"';
        }
        if($data['thought_process3']=='3' && $data['thought_process3']!="")
        {
          $thought_process3 ='checked="checked"';
        }
        if($data['thought_process4']=='4' && $data['thought_process4']!="")
        {
          $thought_process4 ='checked="checked"';
        }
        if($data['thought_process5']=='5' && $data['thought_process5']!="")
        {
          $thought_process5 ='checked="checked"';
        }
        if($data['thought_process6']=='6' && $data['thought_process6']!="")
        {
          $thought_process6 ='checked="checked"';
        }
        if($data['thought_process7']=='7' && $data['thought_process7']!="")
        {
          $thought_process7 ='checked="checked"';
        }
        if($data['thought_process8']=='8' && $data['thought_process8']!="")
        {
          $thought_process8 ='checked="checked"';
        }
        if($data['thought_process9']=='9' && $data['thought_process9']!="")
        {
          $thought_process9 ='checked="checked"';
        }
        if($data['thought_process10']=='10' && $data['thought_process10']!="")
        {
          $thought_process10 ='checked="checked"';
        }
        if($data['thought_process11']=='11' && $data['thought_process11']!="")
        {
          $thought_process11 ='checked="checked"';
        }
        if($data['thought_process12']=='12' && $data['thought_process12']!="")
        {
          $thought_process12 ='checked="checked"';
        }
        if($data['thought_process13']=='13' && $data['thought_process13']!="")
        {
          $thought_process13 ='checked="checked"';
        }
        if($data['thought_process14']=='14' && $data['thought_process14']!="")
        {
          $thought_process14 ='checked="checked"';
        }
        if($data['thought_process15']=='15' && $data['thought_process15']!="")
        {
          $thought_process15 ='checked="checked"';
        }
        if($data['thought_process16']=='16' && $data['thought_process16']!="")
        {
          $thought_process16 ='checked="checked"';
        }
        if($data['thought_process17']=='17' && $data['thought_process17']!="")
        {
          $thought_process17 ='checked="checked"';
        }
        if($data['thought_process18']=='18' && $data['thought_process18']!="")
        {
          $thought_process8 ='checked="checked"';
        }
        if($data['thought_process19']=='19' && $data['thought_process19']!="")
        {
          $thought_process19 ='checked="checked"';
        }
        if($data['thought_process21']=='21' && $data['thought_process21']!="")
        {
          $thought_process21 ='checked="checked"';
        }
        if($data['thought_process22']=='22' && $data['thought_process22']!="")
        {
          $thought_process22 ='checked="checked"';
        }
        if($data['thought_process23']=='23' && $data['thought_process23']!="")
        {
          $thought_process23 ='checked="checked"';
        }
        if($data['thought_process24']=='24' && $data['thought_process24']!="")
        {
          $thought_process24 ='checked="checked"';
        }


        if($data['thought_ass1']=='1' && $data['thought_ass1']!="")
        {
          $thought_ass1 ='checked="checked"';
        }
        if($data['thought_ass2']=='2' && $data['thought_ass2']!="")
        {
          $thought_ass2 ='checked="checked"';
        }
        if($data['thought_ass3']=='3' && $data['thought_ass3']!="")
        {
          $thought_ass3 ='checked="checked"';
        }
        if($data['thought_ass4']=='4' && $data['thought_ass4']!="")
        {
          $thought_ass4 ='checked="checked"';
        }


        if($data['thought_con1']=='1' && $data['thought_con1']!="")
        {
          $thought_con1 ='checked="checked"';
        }
        if($data['thought_con2']=='2' && $data['thought_con2']!="")
        {
          $thought_con2 ='checked="checked"';
        }
        if($data['thought_con3']=='3' && $data['thought_con3']!="")
        {
          $thought_con3 ='checked="checked"';
        }
        if($data['thought_con4']=='4' && $data['thought_con4']!="")
        {
          $thought_con4 ='checked="checked"';
        }
        if($data['thought_con5']=='5' && $data['thought_con5']!="")
        {
          $thought_con5 ='checked="checked"';
        }
        if($data['thought_con6']=='6' && $data['thought_con6']!="")
        {
          $thought_con6 ='checked="checked"';
        }
        if($data['thought_con7']=='7' && $data['thought_con7']!="")
        {
          $thought_con7 ='checked="checked"';
        }
        if($data['thought_con8']=='8' && $data['thought_con8']!="")
        {
          $thought_con8 ='checked="checked"';
        }
        if($data['thought_con9']=='9' && $data['thought_con9']!="")
        {
          $thought_con9 ='checked="checked"';
        }

        if($data['memory1']=='1' && $data['memory1']!="")
        {
          $memory1 ='checked="checked"';
        }
        if($data['memory2']=='2' && $data['memory2']!="")
        {
          $memory2 ='checked="checked"';
        }
        if($data['memory3']=='3' && $data['memory3']!="")
        {
          $memory3 ='checked="checked"';
        }
        if($data['memory4']=='4' && $data['memory4']!="")
        {
          $memory4 ='checked="checked"';
        }
        if($data['memory5']=='5' && $data['memory5']!="")
        {
          $memory5 ='checked="checked"';
        }
        if($data['memory6']=='6' && $data['memory6']!="")
        {
          $memory6 ='checked="checked"';
        }
        if($data['memory7']=='7' && $data['memory7']!="")
        {
          $memory7 ='checked="checked"';
        }
        if($data['memory8']=='8' && $data['memory8']!="")
        {
          $memory8 ='checked="checked"';
        }

        if($data['insight1']=='1' && $data['insight1']!="")
        {
          $insight1 ='checked="checked"';
        }
        if($data['insight2']=='2' && $data['insight2']!="")
        {
          $insight2 ='checked="checked"';
        }
        if($data['insight3']=='3' && $data['insight3']!="")
        {
          $insight3 ='checked="checked"';
        }
        if($data['insight4']=='4' && $data['insight4']!="")
        {
          $insight4 ='checked="checked"';
        }
        if($data['insight5']=='5' && $data['insight5']!="")
        {
          $insight5 ='checked="checked"';
        }

        if($data['judgment1']=='1' && $data['judgment1']!="")
        {
          $judgment1 ='checked="checked"';
        }
        if($data['judgment2']=='2' && $data['judgment2']!="")
        {
          $judgment2 ='checked="checked"';
        }
        if($data['judgment3']=='3' && $data['judgment3']!="")
        {
          $judgment3 ='checked="checked"';
        }
        if($data['judgment4']=='4' && $data['judgment4']!="")
        {
          $judgment4 ='checked="checked"';
        }
        if($data['judgment5']=='5' && $data['judgment5']!="")
        {
          $judgment5 ='checked="checked"';
        }
        if($data['judgment6']=='6' && $data['judgment6']!="")
        {
          $judgment6 ='checked="checked"';
        }
        if($data['judgment7']=='7' && $data['judgment7']!="")
        {
          $judgment7 ='checked="checked"';
        }

        if($data['orient1']=='1' && $data['orient1']!="")
        {
          $orient1 ='checked="checked"';
        }
        if($data['orient2']=='2' && $data['orient2']!="")
        {
          $orient2 ='checked="checked"';
        }
        if($data['orient3']=='3' && $data['orient3']!="")
        {
          $orient3 ='checked="checked"';
        }
        if($data['orient4']=='4' && $data['orient4']!="")
        {
          $orient4 ='checked="checked"';
        }
        if($data['orient5']=='5' && $data['orient5']!="")
        {
          $orient5 ='checked="checked"';
        }

        if($data['language1']=='1' && $data['language1']!="")
        {
          $language1 ='checked="checked"';
        }
        if($data['language2']=='2' && $data['language2']!="")
        {
          $language2 ='checked="checked"';
        }
        if($data['language3']=='3' && $data['language3']!="")
        {
          $language3 ='checked="checked"';
        }
        if($data['language4']=='4' && $data['language4']!="")
        {
          $language4 ='checked="checked"';
        }
        if($data['language5']=='5' && $data['language5']!="")
        {
          $language5 ='checked="checked"';
        }

        if($data['knowledge1']=='1' && $data['knowledge1']!="")
        {
          $knowledge1 ='checked="checked"';
        }
        if($data['knowledge2']=='2' && $data['knowledge2']!="")
        {
          $knowledge2 ='checked="checked"';
        }
        if($data['knowledge3']=='3' && $data['knowledge3']!="")
        {
          $knowledge3 ='checked="checked"';
        }
        if($data['knowledge4']=='4' && $data['knowledge4']!="")
        {
          $knowledge4 ='checked="checked"';
        }
        if($data['knowledge5']=='5' && $data['knowledge5']!="")
        {
          $knowledge5 ='checked="checked"';
        }

        if($data['intel1']=='1' && $data['intel1']!="")
        {
          $intel1 ='checked="checked"';
        }
        if($data['intel2']=='2' && $data['intel2']!="")
        {
          $intel2 ='checked="checked"';
        }
        if($data['intel3']=='3' && $data['intel3']!="")
        {
          $intel3 ='checked="checked"';
        }
        if($data['intel4']=='4' && $data['intel4']!="")
        {
          $intel4 ='checked="checked"';
        }
        if($data['intel5']=='5' && $data['intel5']!="")
        {
          $intel5 ='checked="checked"';
        }
        if($data['intel6']=='6' && $data['intel6']!="")
        {
          $intel6 ='checked="checked"';
        }
        if($data['intel7']=='7' && $data['intel7']!="")
        {
          $intel7 ='checked="checked"';
        }
        if($data['intel8']=='8' && $data['intel8']!="")
        {
          $intel8 ='checked="checked"';
        }

        if($data['appetite1']=='1' && $data['appetite1']!="")
        {
          $appetite1 ='checked="checked"';
        }
        if($data['appetite2']=='2' && $data['appetite2']!="")
        {
          $appetite2 ='checked="checked"';
        }
        if($data['appetite3']=='3' && $data['appetite3']!="")
        {
          $appetite3 ='checked="checked"';
        }
        if($data['appetite4']=='4' && $data['appetite4']!="")
        {
          $appetite4 ='checked="checked"';
        }

        if($data['percentage1']=='1' && $data['percentage1']!="")
        {
          $percentage1 ='checked="checked"';
        }
        if($data['percentage2']=='2' && $data['percentage2']!="")
        {
          $percentage2 ='checked="checked"';
        }
        if($data['percentage3']=='3' && $data['percentage3']!="")
        {
          $percentage3 ='checked="checked"';
        }
        if($data['percentage4']=='4' && $data['percentage4']!="")
        {
          $percentage4 ='checked="checked"';
        }

        if($data['sleep1']=='1' && $data['sleep1']!="")
        {
          $sleep1 ='checked="checked"';
        }
        if($data['sleep2']=='2' && $data['sleep2']!="")
        {
          $sleep2 ='checked="checked"';
        }
        if($data['sleep3']=='3' && $data['sleep3']!="")
        {
          $sleep3 ='checked="checked"';
        }
        if($data['sleep4']=='4' && $data['sleep4']!="")
        {
          $sleep4 ='checked="checked"';
        }

        if($data['problem1']=='1' && $data['problem1']!="")
        {
          $problem1 ='checked="checked"';
        }
        if($data['problem2']=='2' && $data['problem2']!="")
        {
          $problem2 ='checked="checked"';
        }
        if($data['problem3']=='3' && $data['problem3']!="")
        {
          $problem3 ='checked="checked"';
        }
        if($data['problem4']=='4' && $data['problem4']!="")
        {
          $problem4 ='checked="checked"';
        }
        if($data['problem5']=='5' && $data['problem5']!="")
        {
          $problem5 ='checked="checked"';
        }

        if($data['anxious1']=='1' && $data['anxious1']!="")
        {
          $anxious1 ='checked="checked"';
        }
        if($data['anxious2']=='2' && $data['anxious2']!="")
        {
          $anxious2 ='checked="checked"';
        }
        if($data['anxious3']=='3' && $data['anxious3']!="")
        {
          $anxious3 ='checked="checked"';
        }
        if($data['anxious4']=='4' && $data['anxious4']!="")
        {
          $anxious4 ='checked="checked"';
        }
        if($data['anxious5']=='5' && $data['anxious5']!="")
        {
          $anxious5 ='checked="checked"';
        }
        if($data['anxious6']=='6' && $data['anxious6']!="")
        {
          $anxious6 ='checked="checked"';
        }
        if($data['anxious7']=='7' && $data['anxious7']!="")
        {
          $anxious7 ='checked="checked"';
        }
        if($data['anxious8']=='8' && $data['anxious8']!="")
        {
          $anxious8 ='checked="checked"';
        }

        if($data['motivation1']=='1' && $data['motivation1']!="")
        {
          $motivation1 ='checked="checked"';
        }
        if($data['motivation2']=='2' && $data['motivation2']!="")
        {
          $motivation2 ='checked="checked"';
        }
        if($data['motivation3']=='3' && $data['motivation3']!="")
        {
          $motivation3 ='checked="checked"';
        }

        if($data['group_parti1']=='1' && $data['group_parti1']!="")
        {
          $group_parti1 ='checked="checked"';
        }
        if($data['group_parti2']=='2' && $data['group_parti2']!="")
        {
          $group_parti2 ='checked="checked"';
        }
        if($data['group_parti3']=='3' && $data['group_parti3']!="")
        {
          $group_parti3 ='checked="checked"';
        }
        if($data['group_parti4']=='4' && $data['group_parti4']!="")
        {
          $group_parti4 ='checked="checked"';
        }
        if($data['group_parti5']=='5' && $data['group_parti5']!="")
        {
          $group_parti5 ='checked="checked"';
        }

        if($data['onsite']=='1' && $data['onsite']!="")
        {
          $onsite ='checked="checked"';
        }
        if($data['overnight']=='2' && $data['overnight']!="")
        {
          $overnight ='checked="checked"';
        }

        if($data['result1']=='1' && $data['result1']!="")
        {
          $result1 ='checked="checked"';
        }
        if($data['result2']=='2' && $data['result2']!="")
        {
          $result2 ='checked="checked"';
        }
        if($data['result3']=='3' && $data['result3']!="")
        {
          $result3 ='checked="checked"';
        }
        if($data['result4']=='4' && $data['result4']!="")
        {
          $result4 ='checked="checked"';
        }
        if($data['result5']=='5' && $data['result5']!="")
        {
          $result5 ='checked="checked"';
        }
        if($data['result6']=='6' && $data['result6']!="")
        {
          $result6 ='checked="checked"';
        }
        if($data['result7']=='7' && $data['result7']!="")
        {
          $result7 ='checked="checked"';
        }
        if($data['result8']=='8' && $data['result8']!="")
        {
          $result8 ='checked="checked"';
        }
        if($data['result9']=='9' && $data['result9']!="")
        {
          $result9 ='checked="checked"';
        }
        if($data['result10']=='10' && $data['result10']!="")
        {
          $result10 ='checked="checked"';
        }
        if($data['result11']=='11' && $data['result11']!="")
        {
          $result11 ='checked="checked"';
        }
        if($data['result12']=='12' && $data['result12']!="")
        {
          $result12 ='checked="checked"';
        }
        if($data['result13']=='13' && $data['result13']!="")
        {
          $result13 ='checked="checked"';
        }
        if($data['result14']=='14' && $data['result14']!="")
        {
          $result14 ='checked="checked"';
        }
        if($data['result15']=='15' && $data['result15']!="")
        {
          $result15 ='checked="checked"';
        }
        if($data['result16']=='16' && $data['result16']!="")
        {
          $result16 ='checked="checked"';
        }
        if($data['result17']=='17' && $data['result17']!="")
        {
          $result17 ='checked="checked"';
        }

        if($data['family1']=='1' && $data['family1']!="")
        {
          $family1 ='checked="checked"';
        }
        if($data['family2']=='2' && $data['family2']!="")
        {
          $family2 ='checked="checked"';
        }
        if($data['family3']=='3' && $data['family3']!="")
        {
          $family3 ='checked="checked"';
        }
        if($data['family4']=='4' && $data['family4']!="")
        {
          $family4 ='checked="checked"';
        }
        if($data['family5']=='5' && $data['family5']!="")
        {
          $family5 ='checked="checked"';
        }
        if($data['family6']=='6' && $data['family6']!="")
        {
          $family6 ='checked="checked"';
        }
        if($data['family7']=='7' && $data['family7']!="")
        {
          $family7 ='checked="checked"';
        }

        if($data['tele1']=='1' && $data['tele1']!="")
        {
          $tele1 ='checked="checked"';
        }
        if($data['tele2']=='2' && $data['tele2']!="")
        {
          $tele2 ='checked="checked"';
        }
        if($data['tele3']=='3' && $data['tele3']!="")
        {
          $tele3 ='checked="checked"';
        }
        if($data['tele4']=='4' && $data['tele4']!="")
        {
          $tele4 ='checked="checked"';
        }

        if($data['whom1']=='1' && $data['whom1']!="")
        {
          $whom1 ='checked="checked"';
        }
        if($data['whom2']=='2' && $data['whom2']!="")
        {
          $whom2 ='checked="checked"';
        }
        if($data['whom3']=='3' && $data['whom3']!="")
        {
          $whom3 ='checked="checked"';
        }
        if($data['whom4']=='4' && $data['whom4']!="")
        {
          $whom4 ='checked="checked"';
        }
        if($data['whom5']=='5' && $data['whom5']!="")
        {
          $whom5 ='checked="checked"';
        }
        if($data['whom6']=='6' && $data['whom6']!="")
        {
          $whom6 ='checked="checked"';
        }
        if($data['whom7']=='7' && $data['whom7']!="")
        {
          $whom7 ='checked="checked"';
        }

        if($data['source1']=='1' && $data['source1']!="")
        {
          $source1 ='checked="checked"';
        }
        if($data['source2']=='2' && $data['source2']!="")
        {
          $source2 ='checked="checked"';
        }
        if($data['source3']=='3' && $data['source3']!="")
        {
          $source3 ='checked="checked"';
        }

        if($data['support1']=='1' && $data['support1']!="")
        {
          $support1 ='checked="checked"';
        }
        if($data['support2']=='2' && $data['support2']!="")
        {
          $support2 ='checked="checked"';
        }
        if($data['support3']=='3' && $data['support3']!="")
        {
          $support3 ='checked="checked"';
        }

        $print = '
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%; text-align:center;">Clinical Upadte</h4></td>
         </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%; border:1px solid black;"><b>Patient Name:</b> '.$data['pat_name'].'</td>
            <td style="width:25%; border:1px solid black;"><b>DOB:</b> '.$data['dob'].'</td>
            <td style="width:25%; border:1px solid black;"><b>Date:</b> '.$data['clinical_date'].'</td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:80%; border:1px solid black;">'.$data['clinical1'].'
          </tr>
          <tr>
            <td style="width:80%; border:1px solid black;">'.$data['clinical2'].'</td>
          </tr>
          <tr>
            <td style="width:80%; border:1px solid black;">'.$data['clinical3'].'</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:33%; border:1px solid black;"><b>Blood pressure:</b>'.$data['check1'].'</td>
            <td style="width:33%; border:1px solid black;"><b>Pulse </b>'.$data['check2'].'</td>
            <td style="width:33%; border:1px solid black;"><b>Respirations: <b>'.$data['check3'].'</td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:50%; border:1px solid black;"><b>CIWA Score:</b>'.$data['check4'].'</td>
            <td style="width:50%; border:1px solid black;"><b>COW Score:</b>'.$data['check5'].'</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:10%; border:1px solid black;"><b>Medication</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Dose</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Route</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Frequency</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Quantity</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Last dose</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Brought in on admission</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Continue on admission</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Continue on discharge</b> </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>1. List Medications</b></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Anti-craving medications prescribed?</b><input type="checkbox" name="anti1" value="1" '.$anti1.'> Naltrexone <input type="checkbox" name="anti2" value="2" '.$anti2.'> Vivitrol <input type="checkbox" name="anti3" value="3" '.$anti3.'> other <input type="checkbox" name="anti4" value="4" '.$anti4.'> none Dosage: '.$data['anti5'].'</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">If none, why? Patient is currently on withdrawal medications</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Compliant with Medications?</b><input type="checkbox" name="compliant1" value="1" '.$compliant1.'> yes <input type="checkbox" name="compliant2" value="2" '.$compliant2.'> no if no, please explain:'.$data['explain_no1'].'</td>
          </tr>
        </table>
        <br>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Contract for safety?</b><input type="checkbox" name="safety1" value="1" '.$safety1.'> yes <input type="checkbox" name="safety2" value="2" '.$safety2.'> no if no, please explain: '.$data['explain_no2'].'</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Current psychosis?</b><input type="checkbox" name="psychosis1" value="1" '.$psychosis1.'> yes <input type="checkbox" name="psychosis2" value="2" '.$psychosis2.'> no if no, please explain: '.$data['explain_no3'].'</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Current suicidal ideation/ plan/ intent?</b><input type="checkbox" name="suicidal_ideation1" value="1" '.$suicidal_ideation1.'> yes <input type="checkbox" name="suicidal_ideation2" value="2" '.$suicidal_ideation2.'> no if no, please explain: '.$data['explain_no4'].'</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Current homicidal ideation/ plan/ intent?</b><input type="checkbox" name="homicidal1" value="1" '.$homicidal1.'> yes <input type="checkbox" name="homicidal2" value="2" '.$homicidal2.'> no if no, please explain: '.$data['explain_no5'].'</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Medical complications?</b><input type="checkbox" name="medical1" value="1" '.$medical1.'> yes <input type="checkbox" name="medical2" value="2" '.$medical2.'> no if no, please explain: '.$data['explain_no6'].'</td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Symptoms</b> <input type="checkbox" name="symptoms1" value="1" '.$symptoms1.'> nausea <input type="checkbox" name="symptoms2" value="2" '.$symptoms2.'> vomiting <input type="checkbox" name="symptoms3" value="3" '.$symptoms3.'> sweating
              <input type="checkbox" name="symptoms4" value="4" '.$symptoms4.'> tremors
              <input type="checkbox" name="symptoms5" value="5"'.$symptoms5.'> diarrhea
              <input type="checkbox" name="symptoms6" value="6" '.$symptoms6.'> cramping
              <input type="checkbox" name="symptoms7" value="7" '.$symptoms7.'> body aches
              <input type="checkbox" name="symptoms8" value="8" '.$symptoms8.'> headache
              <input type="checkbox" name="symptoms9" value="9"'.$symptoms9.'> unsteady gait
              <input type="checkbox" name="symptoms10" value="10" '.$symptoms10.'> GI issues
              <input type="checkbox" name="symptoms11" value="11" '.$symptoms11.'> psycho motor agitation
              <input type="checkbox" name="symptoms12" value="12" '.$symptoms12.'> psycho motor retardation
              <input type="checkbox" name="symptoms13" value="13" '.$symptoms13.'> runny nose
              <input type="checkbox" name="symptoms14" value="14" '.$symptoms14.'> other:
            </td>
          </tr>
        </table>
        <br>
        <table style="width100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Current step(s) patient is working on: Patient is currently attending onsite AA meetings: State whether they are participating or not. State whether they are participating in meetings outside of treatment and how frequently.</b></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Temporary/ current sponsor: Currently has a sponsor or currently not seeking</b></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;"><b>Frequency of meetings</b><input type="checkbox" name="frequency1" value="1" '.$frequency1.'> daily
              <input type="checkbox" name="frequency2" value="2" '.$frequency2.'> weekly</td>
            <td style="width:50%; border:1px solid black;"><b>Total per week: 7 (onsite): Also how many times they are attending outside of treatment.</b></td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Appearance:</b><input type="checkbox" name="appearance1" value="1" '.$appearance1.'> appropriate
              <input type="checkbox" name="appearance2" value="2" '.$appearance2.'> well kempt <input type="checkbox" name="appearance3" value="3" '.$appearance3.'> disheveled <input type="checkbox" name="appearance4" value="4" '.$appearance4.'> bizarre <input type="checkbox" name="appearance5" value="5" '.$appearance5.'> odorous <input type="checkbox" name="appearance6" value="6" '.$appearance6.'> poor hygiene
              <p><b>Describe:</b> '.$data['appearance7'].'</p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Behavior:</b><input type="checkbox" name="behavior1" value="1" '.$behavior1.'> isolates
              <input type="checkbox" name="behavior2" value="2" '.$behavior2.'> social withdrawal <input type="checkbox" name="behavior3" value="3" '.$behavior3.'> guarded/ defensive <input type="checkbox" name="behavior4" value="4" '.$behavior4.'> impulsive <input type="checkbox" name="behavior5" value="5" '.$behavior5.'> minimizing/ justifying <input type="checkbox" name="behavior6" value="6" '.$behavior6.'> med seeking <input type="checkbox" name="behavior7" value="7" '.$behavior7.'> Other: '.$data['$behavior8'].'
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Musculoskeletal:&emsp;&emsp;
              <b>Strength/ Tone</b>
              <input type="checkbox" name="musculoskeletal1" value="1" '.$musculoskeletal1.'> normal <input type="checkbox" name="musculoskeletal2" value="2" '.$musculoskeletal2.'> abnormal  &emsp;&emsp; <b>Gait/Station</b>
              <input type="checkbox" name="musculoskeletal3" value="1" '.$musculoskeletal3.'> normal <input type="checkbox" name="musculoskeletal4" value="2" '.$musculoskeletal4.'> abnormal
              <p><b>Describe:</b> '.$data['$musculoskeletal5'].'</p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Attitude:
              <input type="checkbox" name="attitude1" value="1" '.$attitude1.'> cooperativeness <input type="checkbox" name="attitude2" value="2" '.$attitude2.'> relatedness <input type="checkbox" name="attitude3" value="3" '.$attitude3.'> good eye contact
              <p><b>Describe:</b> '.$data['attitude4'].'</p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Motor:
              <input type="checkbox" name="motor1" value="1" '.$motor1.'> normal <input type="checkbox" name="motor2" value="2" '.$motor2.'> psychomotor agitation <input type="checkbox" name="motor3" value="3" '.$motor3.'> psycho motor retardation <input type="checkbox" name="motor4" value="4" '.$motor4.'> EPS <input type="checkbox" name="motor5" value="5" '.$motor5.'> tremor <input type="checkbox" name="motor6" value="6" '.$motor6.'> AIMS:
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Speech:
              <input type="checkbox" name="speech1" value="1" '.$speech1.'> normal <input type="checkbox" name="speech2" value="2" '.$speech2.'> latency <input type="checkbox" name="speech3" value="3" '.$speech3.'> rate <input type="checkbox" name="speech4" value="4" '.$speech4.'> tone <input type="checkbox" name="speech5" value="5" '.$speech5.'> volume <input type="checkbox" name="speech6" value="6" '.$speech6.'> stuttering <input type="checkbox" name="speech7" value="7" '.$speech7.'> normal <input type="checkbox" name="speech8" value="8" '.$speech8.'> hyperactive <input type="checkbox" name="speech9" value="9" '.$speech9.'> retardation <input type="checkbox" name="speech10" value="10" '.$speech10.'> stuttering
              <p><b>Describe:</b> '.$data['speech11'].'</p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Mood:
              <input type="checkbox" name="mood1" value="1" '.$mood1.'> euthymic <input type="checkbox" name="mood2" value="2" '.$mood2.'> depressed <input type="checkbox" name="mood3" value="3" '.$mood3.'> hypomanic <input type="checkbox" name="mood4" value="4" '.$mood4.'> euphoric <input type="checkbox" name="mood5" value="5" '.$mood5.'> angry <input type="checkbox" name="mood6" value="6" '.$mood6.'> anxious <input type="checkbox" name="mood7" value="7" '.$mood7.'> labile <input type="checkbox" name="mood8" value="8" '.$mood8.'> irritable <input type="checkbox" name="mood9" value="9" '.$mood9.'> helpless <input type="checkbox" name="mood10" value="10" '.$mood10.'> hopeless <input type="checkbox" name="mood11" value="11" '.$mood11.'> other: '.$data['mood12'].'
              <p><b>Describe:</b> '.$data['mood13'].'</p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Affect:
              <input type="checkbox" name="affect1" value="1" '.$affect1.'> appropriate <input type="checkbox" name="affect2" value="2" '.$affect2.'> full <input type="checkbox" name="affect3" value="3" '.$affect3.'> neutral <input type="checkbox" name="affect4" value="4" '.$affect4.' constricted <input type="checkbox" name="affect5" value="5" '.$affect5.'> blunted/ flat <input type="checkbox" name="affect6" value="6" '.$affect6.'> labile <input type="checkbox" name="affect7" value="7" '.$affect7.'> labile <input type="checkbox" name="affect8" value="8" '.$affect8.'> irritable <input type="checkbox" name="affect9" value="9" '.$affect9.'> dysphoric <input type="checkbox" name="affect10" value="10" '.$affect10.'> sad
              <p><b>Describe:</b> '.$data['affect11'].'</p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Thought Process:
              <input type="checkbox" name="thought_process1" value="1" '.$thought_process1.'> coherent <input type="checkbox" name="thought_process2" value="2" '.$thought_process2.'> soft <input type="checkbox" name="thought_process3" value="3" '.$thought_process3.'> loud <input type="checkbox" name="thought_process4" value="4" '.$thought_process4.'> rapid <input type="checkbox" name="thought_process5" value="5" '.$thought_process5.'> slurred <input type="checkbox" name="thought_process6" value="6" '.$thought_process6.'> unintelligible <input type="checkbox" name="thought_process7" value="7" '.$thought_process7.'> linear/ goal-oriented <input type="checkbox" name="thought_process8" value="8" '.$thought_process8.'> FOI <input type="checkbox" name="thought_process9" value="9" '.$thought_process9.'> LOA <input type="checkbox" name="thought_process10" value="10" '.$thought_process10.'> word salad
              <input type="checkbox" name="thought_process11" value="11" '.$thought_process11.'> neologism  <input type="checkbox" name="thought_process12" value="12" '.$thought_process12.'> pre-occupied <input type="checkbox" name="thought_process13" value="13" '.$thought_process13.'> difficulty concentrating <input type="checkbox" name="thought_process14" value="14" '.$thought_process14.'> disorganized <input type="checkbox" name="thought_process15" value="15" '.$thought_process15.'> illogical <input type="checkbox" name="thought_process16" value="16" '.$thought_process16.'> obsessive <input type="checkbox" name="thought_process17" value="17" '.$thought_process17.'> flash backs <input type="checkbox" name="thought_process18" value="18" '.$thought_process18.'> intrusive thoughts <input type="checkbox" name="thought_process19" value="19"'.$thought_process19.'> Other: '.$data['thought_process20'].'

              <p><b>Computations</b> <input type="checkbox" name="thought_process21" value="21" '.$thought_process21.'> age appropriate <input type="checkbox" name="thought_process22" value="22" '.$thought_process22.'> age inappropriate <b>Abstractions</b> <input type="checkbox" name="thought_process23" value="23" '.$thought_process23.'> normal <input type="checkbox" name="thought_process24" value="24" '.$thought_process24.'>abnormal</p>
              <p><b>Describe:</b> '.$data['thought_process25'].'</p>
            </td>
          </tr>
        </table>


        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Thought Associations:
              <input type="checkbox" name="thought_ass1" value="1" '.$thought_ass1.'> intact <input type="checkbox" name="thought_ass2" value="2"'.$thought_ass2.'> circumstantial <input type="checkbox" name="thought_ass3" value="3" '.$thought_ass3.'> tangential <input type="checkbox" name="thought_ass4" value="4" '.$thought_ass4.'> loose
              <p><b>Describe:</b> '.$data['thought_ass5'].'</p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Thought Content:
              <input type="checkbox" name="thought_con1" value="1" '.$thought_con1.'> obsessions <input type="checkbox" name="thought_con2" value="2" '.$thought_con2.'> compulsions <input type="checkbox" name="thought_con3" value="3" '.$thought_con3.'> preoccupations <input type="checkbox" name="thought_con4" value="4" '.$thought_con4.'> paranoid delusions <input type="checkbox" name="thought_con5" value="5" '.$thought_con5.'> other delusions <input type="checkbox" name="thought_con6" value="6" '.$thought_con6.'> AH <input type="checkbox" name="thought_con7" value="7"'.$thought_con7.'> VH <input type="checkbox" name="thought_con8" value="8" '.$thought_con8.'> SI <input type="checkbox" name="thought_con9" value="9" '.$thought_con9.'> HI
              <p><b>Describe:</b> '.$data['thought_con10'].'</p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <p><b>Memory:
              <input type="checkbox" name="memory1" value="1" '.$memory1.'> poor <input type="checkbox" name="memory2" value="2" '.$memory2.'> fair <input type="checkbox" name="memory3" value="3" '.$memory3.'> moderate</p>
               <p> <b>Recent</b><input type="checkbox" name="memory4" value="4" '.$memory4.'> intact <input type="checkbox" name="memory5" value="5" '.$memory5.'> impaired <input type="checkbox" name="memory6" value="6" '.$memory6.'> digits forward <input type="checkbox" name="memory7" value="7" '.$memory7.'> intact <input type="checkbox" name="memory8" value="8" '.$memory8.'> impaired </p>
              <p><b>Describe:</b> '.$data['memory9'].'</p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Insight:
              <input type="checkbox" name="insight1" value="1" '.$insight1.'> minimizes <input type="checkbox" name="insight2" value="2" '.$insight2.'> rationalizes <input type="checkbox" name="insight3" value="3" '.$insight3.'> intellectualizes <input type="checkbox" name="insight4" value="4" '.$insight4.'> impaired <input type="checkbox" name="insight5" value="5" '.$insight5.'> other: '.$data['insight6'].'">
              <p><b>Describe:</b> '.$data['insight7'].'"></p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Judgment:
              <input type="checkbox" name="judgment1" value="1" '.$judgment1.'> poor <input type="checkbox" name="judgment2" value="2" '.$judgment2.'> fair <input type="checkbox" name="judgment3" value="3" '.$judgment3.'> good <input type="checkbox" name="judgment4" value="4" '.$judgment4.'> Insight <input type="checkbox" name="judgment5" value="5" '.$judgment5.'> minimal <input type="checkbox" name="judgment6" value="6" '.$judgment6.'> moderate <input type="checkbox" name="judgment7" value="7" '.$judgment7.'>good
              <p><b>Describe:</b> '.$data['judgment8'].'</p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Orientation:
              <input type="checkbox" name="orient1" value="1" '.$orient1.'> time <input type="checkbox" name="orient2" value="2" '.$orient2.'> person <input type="checkbox" name="orient3" value="3" '.$orient3.'> place &emsp; Attention Span/ Concentration <input type="checkbox" name="orient4" value="4" '.$orient4.'> intact  <input type="checkbox" name="orient5" value="5" '.$orient5.'> impaired
              <p><b>Describe:</b> '.$data['orient6'].'</p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Language: &emsp; Name Objects
              <input type="checkbox" name="language1" value="1" '.$language1.'> intact <input type="checkbox" name="language2" value="2" '.$language2.'> impaired <input type="checkbox" name="language3" value="3" '.$language3.'> place&emsp; Repeat phrases <input type="checkbox" name="language4" value="4" '.$language4.'> intact  <input type="checkbox" name="language5" value="5" '.$language5.'> impaired
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Knowledge &emsp; Current Events
              <input type="checkbox" name="knowledge1" value="1" '.$knowledge1.'> intact <input type="checkbox" name="knowledge2" value="2" '.$knowledge2.'> impaired <input type="checkbox" name="knowledge3" value="3" '.$knowledge3.'> place&emsp; Past History <input type="checkbox" name="knowledge4" value="4" '.$knowledge4.'> intact  <input type="checkbox" name="knowledge5" value="5" '.$knowledge5.'> impaired
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Intelligence
              <input type="checkbox" name="intel1" value="1" '.$intel1.'> appears normal <input type="checkbox" name="intel2" value="2" '.$intel2.'> age appropriate <input type="checkbox" name="intel3" value="3" '.$intel3.'> age inappropriate <input type="checkbox" name="intel4" value="4" '.$intel4.'> above average  <input type="checkbox" name="intel5" value="5" '.$intel5.'> average  <input type="checkbox" name="intel6" value="6" '.$intel6.'> below average <input type="checkbox" name="intel7" value="7" '.$intel7.'> impaired <input type="checkbox" name="intel8" value="8" '.$intel8.'>other
              <p><b>Describe:</b> '.$data['intel9'].'</p>
            </td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;">Appetite: <input type="checkbox" name="appetite1" value="1" '.$appetite1.'> poor <input type="checkbox" name="appetite2" value="2" '.$appetite2.'> fair <input type="checkbox" name="appetite3" value="3" '.$appetite3.'> moderate <input type="checkbox" name="appetite4" value="4" '.$appetite4.'>good
            </td>
            <td style="width:50%; border:1px solid black;"> % of meals eaten<input type="checkbox" name="percentage1" value="1" '.$percentage1.'>25% <input type="checkbox" name="percentage2" value="2" '.$percentage2.'>50% <input type="checkbox" name="percentage3" value="3" '.$percentage3.'> 75% <input type="checkbox" name="percentage4" value="4" '.$percentage4.'>100%
            </td>
          </tr>
        </table>
              <br>
        <table style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;">Sleep: <input type="checkbox" name="sleep1" value="1" '.$sleep1.'> poor <input type="checkbox" name="sleep2" value="2" '.$sleep2.'> fair <input type="checkbox" name="sleep3" value="3" '.$sleep3.'> moderate <input type="checkbox" name="sleep4" value="4" '.$sleep4.'>good </td>
            <td style="width:50%; border:1px solid black;">Hours slept per night: '.$data['sleep5'].'</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Problem: <input type="checkbox" name="problem1" value="1" '.$problem1.'> difficulty falling asleep <input type="checkbox" name="problem2" value="2" '.$problem2.'> difficulty staying asleep <input type="checkbox" name="problem3" value="3" '.$problem3.'> drug dreams <input type="checkbox" name="problem4" value="4" '.$problem4.'> nightmares <input type="checkbox" name="problem5" value="5" '.$problem5.'>other : '.$data['problem6'].'</td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><input type="checkbox" name="anxious1" value="1" '.$anxious1.'> anxious about being in treatment <input type="checkbox" name="anxious2" value="2" '.$anxious2.'> legal concerns/ consequences <input type="checkbox" name="anxious3" value="3" '.$anxious3.'> transition to sober living <input type="checkbox" name="anxious4" value="4" '.$anxious4.'> no family support <input type="checkbox" name="anxious5" value="5" '.$anxious5.'> returning to work <input type="checkbox" name="anxious6" value="6" '.$anxious6.'> difficulty coping <input type="checkbox" name="anxious7" value="7" '.$anxiou7.'> decision difficulty <input type="checkbox" name="anxious6" value="6" '.$anxious8.'> other, explain: '.$data['anxious9'].'</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">What is the client struggling with in treatment? Triggers? Level of cravings from 1-10.: Explain what client is struggling with.</td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Goals being worked on and client progress (Specify problem, goal and objective): Specify according to what they are struggling with.</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Motivation for treatment <input type="checkbox" name="motivation1" value="1" '.$motivation1.'> internal <input type="checkbox" name="motivation2" value="2" '.$motivation2.'> external <input type="checkbox" name="motivation3" value="3" '.$motivation3.'>other, explain: '.$data['motivation4'].'</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Group Participation <input type="checkbox" name="group_parti1" value="1" '.$group_parti1.'> poor <input type="checkbox" name="group_parti2" value="2" '.$group_parti2.'> fair <input type="checkbox" name="group_parti3" value="4" '.$group_parti3.'> moderate <input type="checkbox" name="group_parti4" value="4" '.$group_parti4.'> good <input type="checkbox" name="group_parti5" value="5" '.$group_parti5.'>other, explain: '.$group_parti6.'</td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Legal update: '.$data['legal'].'</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;">Date of test: '.$data['date_of_test'].'</td>
            <td style="width:50%; border:1px solid black;">&emsp;&emsp;<input type="checkbox" name="onsite" value="1" '.$onsite.'> onsite &emsp; &emsp; &emsp; &emsp;<input type="checkbox" name="overnight" value="2" '.$overnight.'>Overnight</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
            <p><b>Result:</b></p>
            <p><input type="checkbox" name="result1" value="1" '.$result1.'>negative for all</p>
              <p><input type="checkbox" name="result2" value="2" '.$result2.'> positive, for:<input type="checkbox" name="result3" value="3" '.$result3.'> AMP<input type="checkbox" name="result4" value="4" '.$result4.'> BAR<input type="checkbox" name="result5" value="5" '.$result5.'> BZO<input type="checkbox" name="result6" value="6" '.$result6.'> COC<input type="checkbox" name="result7" value="7" '.$result7.'> OPI/MOP<input type="checkbox" name="result8" value="8" '.$result8.'> MTD<input type="checkbox" name="result9" value="9" '.$result9.'> MET<input type="checkbox" name="result10" value="10" '.$result10.'> PCP<input type="checkbox" name="result11" value="11" '.$result11.'> OXY<input type="checkbox" name="result12" value="12" '.$result12.'> TCA<input type="checkbox" name="result13" value="13" '.$result13.'> THC<input type="checkbox" name="result14" value="14" '.$result14.'> MDMA<input type="checkbox" name="result15" value="15" '.$result15.'> PPX<input type="checkbox" name="result16" value="16" '.$result16.'> BUP<input type="checkbox" name="result17" value="17" '.$result17.'> ETOH</p>

              <p><br>faint, for:&emsp;&emsp; AMP&emsp;&emsp; BAR&emsp;&emsp; BZO&emsp;&emsp;COC&emsp;&emsp;OPI/MOP&emsp;&emsp;MTD&emsp;&emsp;MET&emsp;&emsp;PCP&emsp;&emsp;OXY&emsp;&emsp;TCA &emsp;&emsp;THC&emsp;&emsp;MDMA&emsp;&emsp; PPX&emsp;&emsp;BUP&emsp;&emsp;ETOH</p>

              <p>Alcohol urine dipstick '.$data['faint1'].'</p>
              <p>Breathalyzer '.$data['faint2'].'</p>
              <p>other: '.$data['faint3'].'</p>
            </td>
          </tr>
        </table>
        <br>
        <table  style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;"><b>Date of last family session: '.$data['last_family'].'</td>
            <td style="width:50%; border:1px solid black;"><b>Date of next family session:</b> '.$data['next_family'].'</td>
          </tr>
        </table>
        <table  style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>What family members have been involved?</b> <input type="checkbox" name="family1" value="1" '.$family1.'> mother <input type="checkbox" name="family2" value="2" '.$family2.'> father <input type="checkbox" name="family3" value="3" '.$family3.'> siblings <input type="checkbox" name="family4" value="4" '.$family4.'> spouse <input type="checkbox" name="family5" value="5" '.$family5.'> partner <input type="checkbox" name="family6" value="6" '.$family6.'> adult child <input type="checkbox" name="family7" value="7" '.$family7.'>Other: '.$data['family8'].'</td>
          </tr>
        </table>
        <table  style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <p><b>If family has not participated with treatment, what outreach attempts have been made?</b></p>
              <p><input type="checkbox" name="tele1" value="1" '.$tele1.'> telephone <input type="checkbox" name="tele2" value="2"'.$tele2.'> mail <input type="checkbox" name="tele3" value="3" '.$tele3.'> email <input type="checkbox" name="tele4" value="4" '.$tele4.'> face to face</p>

              <p><b>To whom?:</b></p>
              <p><input type="checkbox" name="whom1" value="1" '.$whom1.'> mother <input type="checkbox" name="whom2" value="2" '.$whom2.'> father <input type="checkbox" name="whom3" value="3" '.$whom3.'> siblings <input type="checkbox" name="whom4" value="4" '.$whom4.'> spouse <input type="checkbox" name="whom5" value="5" '.$whom5.'> partner <input type="checkbox" name="whom6" value="6" '.$whom6.'> adult child <input type="checkbox" name="whom7" value="7" '.$whom7.'>Other: '.$data['whom8'].'</p>
            </td>
          </tr>
        </table>

        <br>
        <table  style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Source of sober support</b>
              <input type="checkbox" name="source1" value="3" '.$source1.'> 12 Step Community <input type="checkbox" name="source2" value="2" '.$source2.'> family <input type="checkbox" name="source3" value="3" '.$source3.'>Other: '.$data['source4'].'
            </td>
          </tr>
        </table>
        <table  style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Community support</b>
              <input type="checkbox" name="support1" value="1" '.$support1.'> recovery community <input type="checkbox" name="support2" value="2" '.$support2.'> religious/ spiritual <input type="checkbox" name="support3" value="3" '.$support3.'>Other: '.$data['support4'].'
            </td>
          </tr>
        </table>
              <br>
        <table  style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <p><b>Date, level of care, and location of step down/ step up:</b></p>
              <p>Patient is currently in '.$data['level1'].' as of '.$data['level2'].' Patient needs additional days at this level of care.</p>
              <p>';
               if(isset($data['text1'])){
                $print.= $data['text1']; 
              } else{
                  
                 $print.='He/She is making progress, but has not yet achieved goals articulated in the individualized treatment plan. The treatment is leading to measurable improvements to acute symptoms and progression toward discharge presently, but the individual in not yet sufficiently stabilized safely to continue at a lower level of care. Continued treatment at the present level of care is assessed as necessary to permit patient to continue to work toward his/her treatment goals. Or</p>
                 <p> The patient is not yet making progress, but has capacity to resolve his/her problems. He/She is actively working toward the goals articulated in individualized treatment plan. Continued treatment at present level of care is assessed as necessary to permit the patient to continue to work toward his/her treatment goals. Or
                 New problems have been identified that are appropriately treated at present level of care. The new problem/priority requires services, the frequency and intensity of which can only safely be delivered by continued stay in the current level of care.</p>
                <p>Currently the patient does not require a higher level of care or a different level of care if the patient continues to reside in ambulatory detox level of care. At this level of care there is reasonable probability of reduction of symptoms and behaviors with this treatment at the present time. If applicable !! ( Despite intensive recovery and therapeutic efforts elsewhere the patient is choosing ambulatory detox level of care to treat the intensity, duration and frequency of symptoms and behaviors. There is a need for continued medical and clinical treatment at this current time. Persistence of signs and symptoms such as (specify withdrawal symptoms) require the clients continued observation and treatment at this level of care. …OR… The patient has developed new symptoms and or behaviors (specify withdrawal symptom/ behaviors) that require this intensity of service for a safe and effective treatment. The patient is still experiencing signs and symptoms of withdrawal such as (specify withdrawal symptoms) that require continued services at this level of withdrawal</p>
                '; } 
                $print.='

            </td>
          </tr>
        </table>

        ';
    }
    else{
        $print="Not Found";
    }
    //  echo $print;
    //  exit;
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($print);
$file='pdf/'.time().'.pdf';
$mpdf->Output($file,'I');

?>
