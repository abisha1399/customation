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
function cigna_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_cigna` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Cigna Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt(' Patient Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['pname'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt('SSN#:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['ssn'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('patient DOB :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['pdob'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Subscriber Name:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['sename'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Relation:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['relation'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['signpg'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Fax to'); ?></label></th>
                <td><span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['fax'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' date:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['date4'])); ?></span></td>
            </tr>
            
            
        </table>
        <?php
    }
}
?>