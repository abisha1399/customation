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
function form_follow_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_follow` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('follow Form'); ?></span></td>
            </tr><br>
            <tr>
                <th><label><?php echo xlt(' Clinical Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['name1'])); ?></span></td>
            </tr>
           
            <tr>
            <th><label><?php echo xlt('Signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;">
                <?php if($data['sign1']){?>
                <img src='data:image/png;base64,<?php echo xlt($data['sign1']); ?>' width='100px' height='50px'/> <?php } ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' date :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['date1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse name:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['name2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;">
                <?php if($data['sign2']){?>
                <img src='data:image/png;base64,<?php echo xlt($data['sign2']); ?>' width='100px' height='50px'/> <?php }?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('date:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['date2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('discharge note :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['comment8'])); ?></span></td>
            </tr>
            
            
        </table>
        <?php
    }
}
?>