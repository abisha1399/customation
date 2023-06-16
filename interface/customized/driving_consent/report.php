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
function driving_consent_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_driving_consent` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span><?php echo xlt('Driving Consent'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('Date:'); ?></b></label>
                <span class=text><?php echo ($data['date']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextData1:'); ?></b></label>
                <span class=text><?php echo ($data['text1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature:'); ?></b></label>
                 <?php
                if($data['patient']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$data['patient'].'>';
                }
                ?>
                <!-- <span class=text><?php echo ($data['patient']);?></span> -->
            </td>
            </tr>
        </table>
        <?php
    }
}
?>
