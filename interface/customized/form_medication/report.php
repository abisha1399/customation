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
function form_medications_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_medications` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('IME Consent Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Patients Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['patient_name'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date Of Birth:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dob'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Medication:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['medication'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date/Time :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dtime'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Current Level :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['current'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Withdraw s/s :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['withdraw'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['nurse'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Post comfort Level:'); ?></label></th>
                <td><span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['post'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' Med Effective:yes/no:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['med'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Medication:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['medication1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date/Time :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dtime1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Current Level :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['current1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Withdraw s/s :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['withdraw1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['nurse1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Post comfort Level:'); ?></label></th>
                <td><span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['post1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' Med Effective:yes/no:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['med1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Medication:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['medication2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date/Time :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dtime2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Current Level :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['current2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Withdraw s/s :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['withdraw2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['nurse2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Post comfort Level:'); ?></label></th>
                <td><span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['post2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' Med Effective:yes/no:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['med2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Medication:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['medication3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date/Time :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dtime3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Current Level :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['current3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Withdraw s/s :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['withdraw3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['nurse3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Post comfort Level:'); ?></label></th>
                <td><span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['post3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' Med Effective:yes/no:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['med3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Medication:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['medication4'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date/Time :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dtime4'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Current Level :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['current4'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Withdraw s/s :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['withdraw4'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['nurse4'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Post comfort Level:'); ?></label></th>
                <td><span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['post4'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' Med Effective:yes/no:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['med4'])); ?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>