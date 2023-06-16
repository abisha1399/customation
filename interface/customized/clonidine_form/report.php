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
function clonidine_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_clonidine` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Clonidine Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Patient name:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['inp39'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Dob:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['inp2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Allergies:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['inp1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Order Date:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['inp28'])); ?></span></td>
            </tr>

            <tr>
            <th><label><?php echo xlt('Patient Signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;">
                <?php if($data['inp29']) { ?>
                <img src='data:image/png;base64,<?php echo xlt($data['inp29']); ?>' width='100px' height='50px'/> 
            <?}?>
            </span></td>
            </tr>

            <tr>
            <th><label><?php echo xlt('Patient Initials:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['inp30'])); ?></span></td>
            </tr>
            
        </table>
        <?php
    }
}
?>