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
function first_dose_medication_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `first_dose_form` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    // print_r($data);
    // die();
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('First Dose Medication'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Patient Name:'); ?></label></th>
                <td><span class=text><?php echo xlt(text($data['pname'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('DOB:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['DOB'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text >
          <?php if($data['input81']){ ?>
                    
            <img src='data:image/png;base64,<?php echo xlt($data['input81']); ?>' width='100px' height='50px'/>
        <?php }?>
        </span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input82'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Time:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input83'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text >
          <?php if($data['input84']){ ?>
                    
                    <img src='data:image/png;base64,<?php echo xlt($data['input84']); ?>' width='100px' height='50px'/><?php } ?> </span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input85'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Time:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input86'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text >
          <?php if($data['input87']){ ?>
                    <img src='data:image/png;base64,<?php echo xlt($data['input87']); ?>' width='100px' height='50px'/><?php } ?> </span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input88'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Time:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input89'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text >
          <?php if($data['input90']){ ?>
                    <img src='data:image/png;base64,<?php echo xlt($data['input90']); ?>' width='100px' height='50px'/><?php } ?> </span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input91'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Time:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input92'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Nurse Signature:'); ?></label></th>
                <td><span class=text >
          <?php if($data['input93']){ ?>
                    
                <img src='data:image/png;base64,<?php echo xlt($data['input93']); ?>' width='100px' height='50px'/>
            <?php }?> </span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input94'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Time:'); ?></label></th>
                <td><span class=text ><?php echo xlt(text($data['input95'])); ?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>