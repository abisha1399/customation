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
function form_medication1_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_medication1` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Medication1 Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt('  Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input92'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt('allergy:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input94'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' date :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input93'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php
                 if($data['input90']!='')
                 {
                    echo '<img src="'.$data['input90'].'" style="width:20%;height:60px;">';
                 }
                 ?> </span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse initials:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input87'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' order date:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input81'])); ?></span></td>
            </tr>
            
            
            
        </table>
        <?php
    }
}
?>