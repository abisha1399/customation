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
function form_wellmark_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_wellmark` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('wellmark Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt('Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['name'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt('address'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['address'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('phone number :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['number'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('email'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['email'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['signature1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('  personal Rep name:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['pname'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' personal Rep address:'); ?></label></th>
                <td><span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['paddress'])); ?></span></td>
            </tr>
            <th><label><?php echo xlt(' personal Rep Number:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['pnumber'])); ?></span></td>
            </tr>
            
        </table>
        <?php
    }
}
?>
