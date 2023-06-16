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
require_once($GLOBALS["srcdir"] . "/api.inc");
function admission_orders_report($pid, $encounter, $cols, $id)
{
    $count = 0;
    $sql = "SELECT * FROM `form_admission_orders` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
?>
        <table style='width: 100%;'>
            <tr>

                <td><span><?php echo xlt('Admission Orders'); ?></span></td>
            </tr>
            <br />
            <tr>
                <td><label><b><?php echo xlt('Patient Name:'); ?></b></label>
                    <span class=text><?php echo ($data['patient']); ?></span>
                </td>
            </tr>
            <tr>
                <td><label><b><?php echo xlt('DOB:'); ?></b></label>
                    <span class=text><?php echo ($data['dob']); ?></span>
                </td>
            </tr>
            <tr>
                <td><label><b><?php echo xlt('Allergy:'); ?></b></label>
                    <span class=text><?php echo ($data['allergy']); ?></span>
                </td>
            </tr>
            <tr>
                <td><label><b><?php echo xlt('Height:'); ?></b></label>
                    <span class=text><?php echo ($data['height']); ?></span>
                </td>
            </tr>
            <tr>
                <td><label><b><?php echo xlt('Weight:'); ?></b></label>
                    <span class=text><?php echo ($data['weight']); ?></span>
                </td>
            </tr>
        </table>
<?php
    }
}
?>