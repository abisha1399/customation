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
function form_quick_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_quick` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Quick Guide  Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt(' Patient Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['name0'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt(' DOB :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['date1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('checkbox1:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['checkbox1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('checkbox2:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['checkbox2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('checkbox3'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['checkbox3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('checkbox4:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['checkbox4'])); ?></span></td>
            </tr>
            
            
        </table>
        <?php
    }
}
?>