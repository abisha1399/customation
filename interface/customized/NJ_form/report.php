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
function nj_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_nj` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('NJ Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Memeber Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['mname'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Member Identification Number:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['midnum'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Member Date of Birth:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dob'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Insurer Name:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['insname'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Member ID #:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['mid'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Patient Name:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['patname'])); ?></span></td>
            </tr>
            <tr>
        </table>
        <?php
    }
}
?>