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
function authorized_representative_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_authorized` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span><?php echo xlt('Authorized Representative Form'); ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Name:'); ?></b></label>
                <span class=text><?php echo xlt(text($data['name'])); ?></span></td>
            </tr>
            <tr>

                <td>
                <label><b><?php echo xlt('Date of Birth:'); ?></b></label>
                    <span class=text><?php echo xlt(text($data['date'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Address:'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['addr'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Home Phone Number:'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['home'])); ?></span></td>
            </tr>
            <tr>
            <td> <label><b><?php echo xlt('Subscriber Name:'); ?></b></label>
                <span class=text><?php echo xlt(text($data['subscribe'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Subscriber Identification Number:'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['identify'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Member Signature:'); ?></label></b>
                 <?php
                if($data['sign']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$data['sign'].'>';
                }
                ?>
                 <!-- <span class=text><?php echo xlt(text($data['sign'])); ?></span> -->
                </td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Month/Day/Year:'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['date1'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' Parent/Guardian Signature (if required by State Law):'); ?></b></label>
                 <!-- <span class=text><?php echo xlt(text($data['par'])); ?></span> -->
                 <?php
                if($data['par']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$data['par'].'>';
                }
                ?>
                </td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' Witness:'); ?></b></label>
            <?php
                if($data['witness']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$data['witness'].'>';
                }
                ?>
                 <!-- <span class=text><?php echo xlt(text($data['witness'])); ?></span> -->
               </td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Designated Representative:'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['design'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Relationship to Member:'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['relation'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Street:'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['street'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('City:'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['city'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Phone Number (Home):'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['phone'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Phone Number (Work):'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['phone1'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Expiration Date:'); ?></b></label>
                 <span class=text><?php echo xlt(text($data['date2'])); ?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>
