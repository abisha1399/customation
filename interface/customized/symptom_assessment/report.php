<?php
/**
 *
 *
 * Forms generated from formsWiz
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */


require_once("../../globals.php");
require_once($GLOBALS["srcdir"]."/api.inc");
function symptom_assessment_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_symptom_assessment` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span><?php echo xlt('Symptom Assessment for Pulmonary Tuberculosis'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('Client Name:'); ?></b></label>
                <span class=text><?php echo ($data['client']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('BirthDate:'); ?></b></label>
                <span class=text><?php echo ($data['date']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date of Symptom Assessment:'); ?></b></label>
                <span class=text><?php echo ($data['date1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData1:'); ?></b></label>
                <span class=text><?php echo ($data['check1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData2:'); ?></b></label>
                <span class=text><?php echo ($data['check2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData3:'); ?></b></label>
                <span class=text><?php echo ($data['check3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData4:'); ?></b></label>
                <span class=text><?php echo ($data['check4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData5:'); ?></b></label>
                <span class=text><?php echo ($data['check5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData6:'); ?></b></label>
                <span class=text><?php echo ($data['check6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData7:'); ?></b></label>
                <span class=text><?php echo ($data['check7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData8:'); ?></b></label>
                <span class=text><?php echo ($data['check8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData9:'); ?></b></label>
                <span class=text><?php echo ($data['check9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Name of Licensed Md/RN:'); ?></b></label>
                <span class=text><?php echo ($data['licens']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Signature of Licensed Md/RN:'); ?></b></label>
                 <?php
                 if($data['stlicens']!='')
                 {
                    echo '<img src="'.$data['stlicens'].'" style="height:90px;width:10%;">';
                 }
                 ?>
                <!-- <span class=text><?php echo ($data['stlicens']);?></span> -->
            </td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date:'); ?></b></label>
                <span class=text><?php echo ($data['date2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData10:'); ?></b></label>
                <span class=text><?php echo ($data['check10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData11:'); ?></b></label>
                <span class=text><?php echo ($data['check11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature:'); ?></b></label>
                 <?php
                 if($data['signpt']!='')
                 {
                    echo '<img src="'.$data['signpt'].'" style="height:90px;width:10%;">';
                 }
                 ?>
                <!-- <span class=text><?php echo ($data['signpt']);?></span> -->
            </td>
            <tr>
                 <td><label><b><?php echo xlt('Date:'); ?></b></label>
                <span class=text><?php echo ($data['date3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Facility:'); ?></b></label>
                <span class=text><?php echo ($data['facility']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('RN spoken to:'); ?></b></label>
                <span class=text><?php echo ($data['spoken']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date:'); ?></b></label>
                <span class=text><?php echo ($data['date4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Time:'); ?></b></label>
                <span class=text><?php echo ($data['symptime']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/ Time of Mantoux Read:'); ?></b></label>
                <span class=text><?php echo ($data['mantoux']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Result:'); ?></b></label>
                <span class=text><?php echo ($data['result']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Signature of the Licensed RN:'); ?></b></label>
                 <?php
                 if($data['rnlicense']!='')
                 {
                    echo '<img src="'.$data['rnlicense'].'" style="height:90px;width:10%;">';
                 }
                 ?>
                <!-- <span class=text><?php echo ($data['rnlicense']);?></span> -->
            </td>
            </tr>
        </table>
        <?php
    }
}
?>
