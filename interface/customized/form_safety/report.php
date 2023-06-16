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
function form_safety_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_safety` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Safety Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt(' Name:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['input'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt('signature1:'); ?></label>
            <?php
                if($data['sign1']!='')
                 {
                    echo '<img src="'.$data['sign1'].'" style="height:90px;width:10%;">';
                 }
                 ?>
            </th>
                <td>
                
                <!-- <?php echo xlt(text($data['sign1'])); ?></span> -->
            </td>
            </tr>
            <tr>
            <th><label><?php echo xlt('date1:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['date1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('signature2:'); ?></label>
            <?php
                if($data['sign2']!='')
                 {
                    echo '<img src="'.$data['sign2'].'" style="height:90px;width:10%;">';
                 }
                 ?>
            </th>
                <td>
               
                    <!-- <span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['sign2'])); ?></span> -->
                </td>
            </tr>
            <tr>
            <th><label><?php echo xlt('date2:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['date2'])); ?></span></td>
            </tr>
            
            
        </table>
        <?php
    }
}
?>