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
function ativan_protocol_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_ativan_protocol` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Ativan Protocol B'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('Allergies:'); ?></b></label> 
                <span class=text><?php echo ($data['allergy']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Name:'); ?></b></label> 
                <span class=text><?php echo ($data['patient']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('DOB:'); ?></b></label> 
                <span class=text><?php echo ($data['dob']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Ativan Date1:'); ?></b></label> 
                <span class=text><?php echo ($data['date1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials1:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials2:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials3:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Ativan Date2:'); ?></b></label> 
                <span class=text><?php echo ($data['date2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials4:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials5:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials6:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Ativan Date3:'); ?></b></label> 
                <span class=text><?php echo ($data['date3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials7:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials8:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Ativan Date4:'); ?></b></label> 
                <span class=text><?php echo ($data['date4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials9:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials10:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Ativan Date5:'); ?></b></label> 
                <span class=text><?php echo ($data['date5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials11:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Order Date:'); ?></b></label> 
                <span class=text><?php echo ($data['orderdate']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature:'); ?></b></label> 
                <span class=text>
                <?php
                 if($data['ptsign']!='')
                 {
                    echo '<img src="'.$data['ptsign'].'" style="width:20%;height:60px;">';
                 }
                 ?>   
                 </span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials:'); ?></b></label> 
                <span class=text><?php echo ($data['ptinitial']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Transcribing:'); ?></b></label> 
                <span class=text><?php echo ($data['nurse']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature1:'); ?></b></label> 
                <span class=text>
                <?php
                 if($data['nursign']!='')
                 {
                    echo '<img src="'.$data['nursign'].'" style="width:20%;height:60px;">';
                 }
                 ?>  
                 </span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials1:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Verifying Nurse:'); ?></b></label> 
                <span class=text><?php echo ($data['nursever']);?></span></td>
            </tr>                     
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature2:'); ?></b></label> 
                <span class=text>
                <?php
                 if($data['nursign1']!='')
                 {
                    echo '<img src="'.$data['nursign1'].'" style="width:20%;height:60px;">';
                 }
                 ?>    
                 </span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials2:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature3:'); ?></b></label> 
                <span class=text>
                <?php
                 if($data['nursign2']!='')
                 {
                    echo '<img src="'.$data['nursign2'].'" style="width:20%;height:60px;">';
                 }
                 ?>
                 </span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials3:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial2']);?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>