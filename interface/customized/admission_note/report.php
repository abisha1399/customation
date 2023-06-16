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
function admission_note_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_admission_note1` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Admission Note Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Nurse Signature/Credentials:'); ?></label></th>
                <td><span class=text style="margin-left: -1073px;"><?php echo xlt(text($data['inp1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date/Time:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['inp2'])); ?></span></td>
            </tr>

        </table>
        <?php
    }
}
?>