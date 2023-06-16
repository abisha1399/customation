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
function form_ciwa_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_ciwa` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('CIWA Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt(' Patient Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input1'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt(' DOB :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('date1:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input5'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('time1:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input14'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('BAL:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input15'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('date2'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input6'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('time2:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input24'])); ?></span></td>
            </tr>
            
            
        </table>
        <?php
    }
}
?>