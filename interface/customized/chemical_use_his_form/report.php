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
function chemical_use_his_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `chemical_use_form` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    // print_r($data);
    // die();
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Chemical Use History'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Cigarettes/Tobacco:'); ?></label></th>
                <td><span class=text><?php echo xlt(text($data['input1'])); ?></span></td>
                <td><span class=text ><?php echo xlt(text($data['input2'])); ?></span></td>
            </tr>
            <tr>
           
        </table>
        <?php
    }
}
?>