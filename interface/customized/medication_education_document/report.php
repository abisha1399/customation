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
function medication_education_document_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_medication_education_document` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span><?php echo xlt('Medication Education Document'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('Patient Name:'); ?></b></label>
                <span class=text><?php echo ($data['patient']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('DOB:'); ?></b></label>
                <span class=text><?php echo ($data['date']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Allergies:'); ?></b></label>
                <span class=text><?php echo ($data['allergy']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date1:'); ?></b></label>
                <span class=text><?php echo ($data['date1']);?></span></td>
            </tr>
            <!-- <tr>
                 <td><label><b><?php echo xlt('Nurse Signature1:'); ?></b></label>
                <span class=text><?php echo ($data['nursign1']);?></span></td>
            </tr> -->
            <!-- <tr>
                 <td><label><b><?php echo xlt('Patient Signature1:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date2:'); ?></b></label>
                <span class=text><?php echo ($data['date2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature2:'); ?></b></label>
                <span class=text><?php echo ($data['nursign2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature2:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date3:'); ?></b></label>
                <span class=text><?php echo ($data['date3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature3:'); ?></b></label>
                <span class=text><?php echo ($data['nursign3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature3:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date4:'); ?></b></label>
                <span class=text><?php echo ($data['date4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature4:'); ?></b></label>
                <span class=text><?php echo ($data['nursign4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature4:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date5:'); ?></b></label>
                <span class=text><?php echo ($data['date5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature5:'); ?></b></label>
                <span class=text><?php echo ($data['nursign5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature5:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date6:'); ?></b></label>
                <span class=text><?php echo ($data['date6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature6:'); ?></b></label>
                <span class=text><?php echo ($data['nursign6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature6:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date7:'); ?></b></label>
                <span class=text><?php echo ($data['date7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature7:'); ?></b></label>
                <span class=text><?php echo ($data['nursign7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature7:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date8:'); ?></b></label>
                <span class=text><?php echo ($data['date8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature8:'); ?></b></label>
                <span class=text><?php echo ($data['nursign8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature8:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date9:'); ?></b></label>
                <span class=text><?php echo ($data['date9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature9:'); ?></b></label>
                <span class=text><?php echo ($data['nursign9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature9:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date10:'); ?></b></label>
                <span class=text><?php echo ($data['date10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature10:'); ?></b></label>
                <span class=text><?php echo ($data['nursign10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature10:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign10']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date11:'); ?></b></label>
                <span class=text><?php echo ($data['date11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature11:'); ?></b></label>
                <span class=text><?php echo ($data['nursign11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature11:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign11']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date12:'); ?></b></label>
                <span class=text><?php echo ($data['date12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature12:'); ?></b></label>
                <span class=text><?php echo ($data['nursign12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature12:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign12']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date13:'); ?></b></label>
                <span class=text><?php echo ($data['date13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature13:'); ?></b></label>
                <span class=text><?php echo ($data['nursign13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature13:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign13']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date14:'); ?></b></label>
                <span class=text><?php echo ($data['date14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature14:'); ?></b></label>
                <span class=text><?php echo ($data['nursign14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature14:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign14']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date15:'); ?></b></label>
                <span class=text><?php echo ($data['date15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature15:'); ?></b></label>
                <span class=text><?php echo ($data['nursign15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature15:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign15']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date16:'); ?></b></label>
                <span class=text><?php echo ($data['date16']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature16:'); ?></b></label>
                <span class=text><?php echo ($data['nursign16']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature16:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign16']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date17:'); ?></b></label>
                <span class=text><?php echo ($data['date17']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature17:'); ?></b></label>
                <span class=text><?php echo ($data['nursign17']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature17:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign17']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date18:'); ?></b></label>
                <span class=text><?php echo ($data['date18']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature18:'); ?></b></label>
                <span class=text><?php echo ($data['nursign18']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature18:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign18']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date19:'); ?></b></label>
                <span class=text><?php echo ($data['date19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature19:'); ?></b></label>
                <span class=text><?php echo ($data['nursign19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature19:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date20:'); ?></b></label>
                <span class=text><?php echo ($data['date20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature20:'); ?></b></label>
                <span class=text><?php echo ($data['nursign20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature20:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date21:'); ?></b></label>
                <span class=text><?php echo ($data['date21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature21:'); ?></b></label>
                <span class=text><?php echo ($data['nursign21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature21:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date22:'); ?></b></label>
                <span class=text><?php echo ($data['date22']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature22:'); ?></b></label>
                <span class=text><?php echo ($data['nursign22']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature22:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign22']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date23:'); ?></b></label>
                <span class=text><?php echo ($data['date23']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature23:'); ?></b></label>
                <span class=text><?php echo ($data['nursign23']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature23:'); ?></b></label>
                <span class=text><?php echo ($data['ptsign23']);?></span></td>
            </tr> -->
        </table>
        <?php
    }
}
?>
