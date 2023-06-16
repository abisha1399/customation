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
function form_thiamine_folate_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_thiamine_folate` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('librium Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt(' Patient Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['p_name'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt(' DOB :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dob'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date1:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input4'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('date2:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input10'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('order date:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input32'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('patient sign'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"> <img src='data:image/png;base64,<?php echo xlt($data['input33']); ?>' width='100px' height='50px'/> </span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('patient initials:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input34'])); ?></span></td>
            </tr>
            
            
        </table>
        <?php
    }
}
?>