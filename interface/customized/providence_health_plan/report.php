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
function providence_health_plan_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_providence_healthplan` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Providence Health Plan Policy And Procedure'); ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Appoinment Number:'); ?></b></label> 
                <span class=text><?php echo xlt(text($data['appoin'])); ?></span></td>
            </tr>
            <tr>
            
                <td>
                <label><b><?php echo xlt('Attachment 1 Member Name:'); ?></b></label>
                    <span class=text><?php echo xlt(text($data['name'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Attachment 1 Member Number:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['member'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Attachment 1 Group Number:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['groups'])); ?></span></td>
            </tr>
            <tr>
            <td> <label><b><?php echo xlt('TextData1:'); ?></b></label> 
                <span class=text><?php echo xlt(text($data['first'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('TextData2:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['second'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('TextData3:'); ?></label></b> 
                 <span class=text><?php echo xlt(text($data['third'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('TextData4:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['fourth'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('TextData5:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['fifth'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Attachment 2 Member Name:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['name1'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Attachment 2 Member Number:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['member1'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Attachment 2 Group Number:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['group1'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b>Member's Signature: </b></label> 
                 <span class=text><?php echo xlt(text($data['sign'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Date:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['date'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Provider Signature:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['provider'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Printed Name:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['print'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Date:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['dat'])); ?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>