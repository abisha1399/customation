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
function form_onsite_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_onsite` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span class=bold><?php echo xlt('Online Instant Urine Test Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt('Patient Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input1'])); ?></span></td>
            </tr>

            <tr>
            <th><label><?php echo xlt(' DOB :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Alcohol Urine Dipstick:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input39'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Fentanyl Urine Dipstick:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input40'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Breathalyzer'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input41'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Clinician Signature:'); ?></label>
            <?php
                if($data['input45']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$data['input45'].'>';
                }
                ?>
            </th>
                <td>
                    <!-- <span class=text style="margin-left: -1121px;"> -->

                <!-- <?php echo xlt(text($data['input45'])); ?> -->
            <!-- </span> -->
            </td>
            </tr>


        </table>
        <?php
    }
}
?>
