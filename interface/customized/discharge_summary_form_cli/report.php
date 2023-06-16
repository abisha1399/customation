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
function discharge_summary_form_cli_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `discharge_summary_cli` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Discharge Summary Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Start Date :'); ?></label></th>
                <td style=""><span ><?php echo xlt(text($data['input1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date of Discharge::'); ?></label></th>
                <td ><span ><?php echo xlt(text($data['input2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('DETOX/PCP(circle one):'); ?></label></th>
                <td><span ><?php echo xlt(text($data['input3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Client Name:'); ?></label></th>
                <td><span ><?php echo xlt(text($data['input4'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Client Address :'); ?></label></th>
                <td><span ><?php echo xlt(text($data['input5'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Client Phone Number:'); ?></label></th>
                <td><span ><?php echo xlt(text($data['input6'])); ?></span></td>
            </tr>
            
           
        </table>
        <?php
    }
}
?>