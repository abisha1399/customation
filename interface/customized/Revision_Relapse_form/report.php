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
function Revision_Relapse_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `revisionrelapse_form` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);
    // print_r($data);
    // die();


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span class=bold><?php echo xlt('Revision&Relapse Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Patient Name:'); ?></label></th>
                <td><span class=text><?php echo xlt(text($data['pname'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('DOB:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['DOB'])); ?></span></td>
            </tr>
            <tr>
            <th colspan="2"><label><?php echo xlt('Nurse signature:'); ?></label>
            <?php
                if($data['sign1']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$data['sign1'].'>';
                }
                ?>
            </th>
                <!-- <td>

                    <span class=text ><?php echo xlt(text($data['sign1'])); ?></span>
            </td> -->
            </tr>
            <tr>
            <th><label><?php echo xlt('Date :'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['date1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Time :'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['time1'])); ?></span></td>
            </tr>
            <tr>
            <th colspan="2"><label><?php echo xlt('Patient signature :'); ?></label>
            <?php
                if($data['sign2']!='')
                {
                   echo '<img style="height:50px;width:20%;object-fit:cover;" src='.$data['sign2'].'>';
                }
                ?>
            </th>
                <!-- <td>
                    <span class=text ><?php echo xlt(text($data['sign2'])); ?></span></td> -->
            </tr>
            <tr>
            <th><label><?php echo xlt(' Date:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['date2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Time:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['Time2'])); ?></span></td>
            </tr>
            <tr>

        </table>
        <?php
    }
}
?>
