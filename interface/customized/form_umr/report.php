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
function form_umr_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_umr` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('UMR Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt('Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['fname'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt('Date1:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['date1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('signature of patient :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['signature1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date2 :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['date2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Rep Signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['signature2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' Rep name:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Nname'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Rep address:'); ?></label></th>
                <td><span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['Naddress'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' Rep city,state,zipcode:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Ncity'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Rep Number:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['Nnumber'])); ?></span></td>
            </tr>
            
        </table>
        <?php
    }
}
?>