<?php
/**
 *
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
function consent_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_consent` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span><?php echo xlt('Consent Form'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('TextData:'); ?></b></label>
                <span class=text><?php echo ($data['consenttext']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature:'); ?></b></label>
                 <?php
                                    if($data['patient']!='')
                                    {
                                    echo '<img style="height:50px;width:20%;object-fit:cover;" src='.$data['patient'].'>';
                                    }
                                    ?>
                <!-- <span class=text><?php echo ($data['patient']);?></span> -->
            </td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time:'); ?></b></label>
                <span class=text><?php echo ($data['ptdate']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Staff/Nurse Signature:'); ?></b></label>
                 <?php
                                    if($data['staff']!='')
                                    {
                                    echo '<img style="height:50px;width:20%;object-fit:cover;" src='.$data['staff'].'>';
                                    }
                                    ?>
                <!-- <span class=text><?php echo ($data['staff']);?></span> -->
            </td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time:'); ?></b></label>
                <span class=text><?php echo ($data['stdate']);?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>
