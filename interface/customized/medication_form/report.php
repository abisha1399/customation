<?php
/**
 * assessment_intake report.php.
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
function medication_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_medication` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span class=bold><?php echo xlt('Medication Reconciliation Form'); ?></span></td>
            </tr>

            <tr>
                <th style="width:20%;";><label><?php echo xlt('Patient Name:'); ?></label></th>
                <td><?php echo xlt(text($data['pname'])); ?></td>
            </tr>
            <tr>
            <th style="width:20%;";><label><?php echo xlt('DOB:'); ?></label></th>
                <td><?php echo xlt(text($data['dob'])); ?></td>
            </tr>
            <tr>
            <th style="width:20%;";><label><?php echo xlt('Allergies'); ?></label></th>
                <td><?php echo $data['allergies']; ?></td>
            </tr>
            <!-- <tr>
            <th style="width:20%;";><label><?php echo xlt('
Nurse Signature:'); ?></label></th>
                <td><?php echo $data['nsign']; ?></td>
            </tr> -->
            <tr>
            <th><label><?php echo xlt('Date/Time:'); ?></label></th>
                <td><?php echo $data['datetime1']?></td>
            </tr>
            <!-- <tr>
            <th><label><?php echo xlt('Physician Signature:'); ?></label></th>
                <td><?php echo $data['psign']; ?></td>
            </tr> -->
            <tr>
            <!-- <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><?php echo $data['date2']; ?></td>
            </tr> -->
            <tr>
            <!-- <tr>
            <th><label><?php echo xlt('Patient Signature:'); ?></label></th>
                <td><?php echo $data['patsign']; ?></td>
            </tr> -->
            <tr>
        </table>
        <?php
    }
}
?>
