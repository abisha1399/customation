<?php
/**
 *
 *Forms generated from formsWiz
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */


require_once("../../globals.php");
require_once($GLOBALS["srcdir"]."/api.inc");
function history_and_physical_evaluation_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_history_and_physical_evaluation` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span><?php echo xlt('History and Physical Evaluation'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('Date:'); ?></b></label>
                <span class=text><?php echo ($data['date']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Pt Last Name:'); ?></b></label>
                <span class=text><?php echo ($data['lname']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Pt First Name:'); ?></b></label>
                <span class=text><?php echo ($data['fname']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('D.O.B:'); ?></b></label>
                <span class=text><?php echo ($data['date1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Allergies:'); ?></b></label>
                <span class=text><?php echo ($data['allergy']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Admitting Diagnosis:'); ?></b></label>
                <span class=text><?php echo ($data['diagnosis']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Cheif Compliant:'); ?></b></label>
                <span class=text><?php echo ($data['compliant']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('B.P:'); ?></b></label>
                <span class=text><?php echo ($data['bp']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('HR:'); ?></b></label>
                <span class=text><?php echo ($data['hr']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('RR:'); ?></b></label>
                <span class=text><?php echo ($data['rr']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Temp:'); ?></b></label>
                <span class=text><?php echo ($data['temp']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('O2 Sat:'); ?></b></label>
                <span class=text><?php echo ($data['sat']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('EyesData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('EyesData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('EyesData3:'); ?></b></label>
                <span class=text><?php echo ($data['action1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('EarsData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('EarsData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('EarsData3:'); ?></b></label>
                <span class=text><?php echo ($data['action2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Teeth,throat,Mouth Data1:'); ?></b></label>
                <span class=text><?php echo ($data['ok3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Teeth,throat,Mouth Data2:'); ?></b></label>
                <span class=text><?php echo ($data['prob3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Teeth,throat,Mouth Data3:'); ?></b></label>
                <span class=text><?php echo ($data['action3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CardiovascularData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CardiovascularData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CardiovascularData3:'); ?></b></label>
                <span class=text><?php echo ($data['action4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('DigestiveData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('DigestiveData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('DigestiveData3:'); ?></b></label>
                <span class=text><?php echo ($data['action5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('EndocrineData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('EndocrineData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('EndocrineData3:'); ?></b></label>
                <span class=text><?php echo ($data['action6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('GenitaliaData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('GenitaliaData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('GenitaliaData3:'); ?></b></label>
                <span class=text><?php echo ($data['action7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Hemic-LymphData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Hemic-LymphData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Hemic-LymphData3:'); ?></b></label>
                <span class=text><?php echo ($data['action8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('IntegumentalData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('IntegumentalData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('IntegumentalData3:'); ?></b></label>
                <span class=text><?php echo ($data['action9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('MusculoSkeletalData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('MusculoSkeletalData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('MusculoSkeletalData3:'); ?></b></label>
                <span class=text><?php echo ($data['action10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('NervousData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('NervousData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('NervousData3:'); ?></b></label>
                <span class=text><?php echo ($data['action11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('RespiratoryData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('RespiratoryData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('RespiratoryData3:'); ?></b></label>
                <span class=text><?php echo ($data['action12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('UrinaryData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('UrinaryData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('UrinaryData3:'); ?></b></label>
                <span class=text><?php echo ($data['action13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PsychiatricData1:'); ?></b></label>
                <span class=text><?php echo ($data['ok14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PsychiatricData2:'); ?></b></label>
                <span class=text><?php echo ($data['prob14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PsychiatricData3:'); ?></b></label>
                <span class=text><?php echo ($data['action14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Drug Sensitivity Data1:'); ?></b></label>
                <span class=text><?php echo ($data['ok15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Drug Sensitivity Data2:'); ?></b></label>
                <span class=text><?php echo ($data['prob15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Drug Sensitivity Data3:'); ?></b></label>
                <span class=text><?php echo ($data['action15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By Identification of Known Substance CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By Identification of Known Substance CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By distinguishing movements in the peripheral visual fields CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By distinguishing movements in the peripheral visual fields CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating ocular muscle movements CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating ocular muscle movements CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By distinguishing sensation throughout the trigeminal nerve distribution CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By distinguishing sensation throughout the trigeminal nerve distribution CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating facial muscles of expression CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating facial muscles of expression CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating bilateral hearing CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating bilateral hearing CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating a gag reflex CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating a gag reflex CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By phonating guttural sounds CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By phonating guttural sounds CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check16']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating bilaterally symmetrical shoulder shrug CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check17']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By demonstrating bilaterally symmetrical shoulder shrug CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check18']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By protruding the tongue without fasciculation CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('By protruding the tongue without fasciculation CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Med regimen/ Protocol:'); ?></b></label>
                <span class=text><?php echo ($data['check21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Initial Labs/ PPD:'); ?></b></label>
                <span class=text><?php echo ($data['check22']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Encourage Hydration:'); ?></b></label>
                <span class=text><?php echo ($data['check23']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Partial Care/ I.O.P/ MAT/ Therapist/  Psychiartist/ P.C.P follow up as needed:'); ?></b></label>
                <span class=text><?php echo ($data['check24']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData25:'); ?></b></label>
                <span class=text><?php echo ($data['check25']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData26:'); ?></b></label>
                <span class=text><?php echo ($data['check26']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Signature:'); ?></b></label>
                 <?php
                 if($data['signatures']!='')
                 {
                    echo '<img src="'.$data['signatures'].'" style="width:20%;height:90px;">';
                 }
                 ?>
                <!-- <span class=text><?php echo ($data['signatures']);?></span> -->
            </td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date:'); ?></b></label>
                <span class=text><?php echo ($data['date2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Time:'); ?></b></label>
                <span class=text><?php echo ($data['signtime']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData27:'); ?></b></label>
                <span class=text><?php echo ($data['check27']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData28:'); ?></b></label>
                <span class=text><?php echo ($data['check28']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Attending Physician:'); ?></b></label>
                 <?php
                 if($data['atsign']!='')
                 {
                    echo '<img src="'.$data['atsign'].'" style="width:20%;height:90px;">';
                 }
                 ?>
                <!-- <span class=text><?php echo ($data['atsign']);?></span> -->
            </td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date:'); ?></b></label>
                <span class=text><?php echo ($data['date3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Time:'); ?></b></label>
                <span class=text><?php echo ($data['attime']);?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>
