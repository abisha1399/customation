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
function last_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `labcorp_form` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    // print_r($data);
    // die();
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('LapCorp Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Patient Name:'); ?></label></th>
                <td><span class=text><?php echo xlt(text($data['input1'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Sex:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input2'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date of birth:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input3'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('	Collaction of time:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input4'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('NPI:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input7'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Physicians ID#'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input8'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Patients ID#:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input9'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Patient Address:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input12'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('City:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input13'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Phone:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input14'])); ?></span></td>
            </tr>
            <th><label><?php echo xlt('State:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input15'])); ?></span></td>
            </tr>
            
        </table>
        <?php
    }
}
?>