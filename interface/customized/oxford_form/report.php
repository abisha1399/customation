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
function oxford_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_oxford` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
     
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Oxford Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt(' MemberName :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Mname'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt('Memberdob:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Mdob'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('memberid :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Mid'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('memberaddress :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Maddress'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('member sign'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Msign'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' witness sign:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Wsign'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Guardian name:'); ?></label></th>
                <td><span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['Gname'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' guardian sign:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Gsign'])); ?></span></td>
            </tr>
            
        </table>
        <?php
    }
}
?>