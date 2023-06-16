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
function medication_log_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_medication_log` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Medication Log'); ?></span></td> 
            </tr>

            <tr>
                <th style="width:20%;";><label><?php echo xlt('Patient Name:'); ?></label></th>
                <td><?php echo xlt(text($data['inp154'])); ?></td>
            </tr>
            <tr>
            <th style="width:20%;";><label><?php echo xlt('DOB:'); ?></label></th>
                <td><?php echo xlt(text($data['inp155'])); ?></td>
            </tr>
            <tr>
            <th style="width:20%;";><label><?php echo xlt('Allergies'); ?></label></th>
                <td><?php echo $data['inp156']; ?></td>
            </tr>
            <tr>
            <th style="width:20%;";><label><?php echo xlt('
Order Date:'); ?></label></th>
                <td><?php echo $data['inp141']; ?></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nursing Transcribing Orders:'); ?></label></th>
                <td><?php echo $data['inp142']?></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Verfifying Nurse:'); ?></label></th>
                <td><?php echo $data['inp143']; ?></td>
            </tr>
            <tr>
            <tr>
            <th><label><?php echo xlt('Patient Signature:'); ?></label></th>
                <td>  <?php
                                    if($data['inp144']!='')
                                    {
                                    echo '<img src="'.$data['inp144'].'" style="width:20%;height:90px;">';
                                    }
                                     ?> </td>
            </tr>
            
        </table>
        <?php
    }
}
?>