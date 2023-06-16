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
function master_treatment_plan_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_master_treatment_plan` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span><?php echo xlt('Master Treatment Plan'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('Patient Name:'); ?></b></label>
                <span class=text><?php echo ($data['name1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('D.O.B:'); ?></b></label>
                <span class=text><?php echo ($data['ptdate1']);?></span></td>
            </tr>
            
        </table>
        <?php
    }
}
?>
