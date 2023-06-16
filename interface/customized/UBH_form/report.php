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
function UBH_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM form_ubh WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('UBH Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('First Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['fname'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Last Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['lname'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('City: '); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['city'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('State:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['state'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Phone:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['phn'])); ?></span></td>
            </tr>
            <tr>
        </table>
        <?php
    }
}
?>