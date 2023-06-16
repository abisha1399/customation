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
function daily_medication_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_daily_medication` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Daily Medication'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('Patient Name:'); ?></b></label> 
                <span class=text><?php echo ($data['patient']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('DOB:'); ?></b></label> 
                <span class=text><?php echo ($data['dob']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Allergies:'); ?></b></label> 
                <span class=text><?php echo ($data['allergy']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date1:'); ?></b></label> 
                <span class=text><?php echo ($data['date1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials1:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date2:'); ?></b></label> 
                <span class=text><?php echo ($data['date2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials2:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date3:'); ?></b></label> 
                <span class=text><?php echo ($data['date3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials3:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date4:'); ?></b></label> 
                <span class=text><?php echo ($data['date4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials4:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date5:'); ?></b></label> 
                <span class=text><?php echo ($data['date5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials5:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date6:'); ?></b></label> 
                <span class=text><?php echo ($data['date6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials6:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date7:'); ?></b></label> 
                <span class=text><?php echo ($data['date7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials7:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date8:'); ?></b></label> 
                <span class=text><?php echo ($data['date8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials8:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date9:'); ?></b></label> 
                <span class=text><?php echo ($data['date9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials9:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date10:'); ?></b></label> 
                <span class=text><?php echo ($data['date10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials10:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date11:'); ?></b></label> 
                <span class=text><?php echo ($data['date11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData1:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData2:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData3:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData4:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData5:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData6:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData7:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData8:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData9:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData10:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData11:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('PatientTextData12:'); ?></b></label> 
                <span class=text><?php echo ($data['pttext12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials11:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign11']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date12:'); ?></b></label> 
                <span class=text><?php echo ($data['date12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials12:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date13:'); ?></b></label> 
                <span class=text><?php echo ($data['date13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials13:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date14:'); ?></b></label> 
                <span class=text><?php echo ($data['date14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials14:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date15:'); ?></b></label> 
                <span class=text><?php echo ($data['date15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials15:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date16:'); ?></b></label> 
                <span class=text><?php echo ($data['date16']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials16:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign16']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date17:'); ?></b></label> 
                <span class=text><?php echo ($data['date17']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials17:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign17']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date18:'); ?></b></label> 
                <span class=text><?php echo ($data['date18']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials18:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign18']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date19:'); ?></b></label> 
                <span class=text><?php echo ($data['date19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials19:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date20:'); ?></b></label> 
                <span class=text><?php echo ($data['date20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials20:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date21:'); ?></b></label> 
                <span class=text><?php echo ($data['date21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials21:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Order Date:'); ?></b></label> 
                <span class=text><?php echo ($data['orderdate']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Transcribing Orders:'); ?></b></label> 
                <span class=text><?php echo ($data['nurse']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Verifying Nurse:'); ?></b></label> 
                <span class=text><?php echo ($data['nursever']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature:'); ?></b></label> 
                <span class=text> <?php
                 if($data['ptsign']!='')
                 {
                    echo '<img src="'.$data['ptsign'].'" style="width:20%;height:60px;">';
                 }
                 ?> </span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials:'); ?></b></label> 
                <span class=text><?php echo ($data['ptinitial']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature1:'); ?></b></label> 
                <span class=text> <?php
                 if($data['nursign']!='')
                 {
                    echo '<img src="'.$data['nursign'].'" style="width:20%;height:60px;">';
                 }
                 ?>  </span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials1:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature2:'); ?></b></label> 
                <span class=text> <?php
                 if($data['nursign1']!='')
                 {
                    echo '<img src="'.$data['nursign1'].'" style="width:20%;height:60px;">';
                 }
                 ?> </span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials2:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature3:'); ?></b></label> 
                <span class=text><?php
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
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature4:'); ?></b></label> 
                <span class=text><?php
                 if($data['nursign3']!='')
                 {
                    echo '<img src="'.$data['nursign3'].'" style="width:20%;height:60px;">';
                 }
                 ?> </span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials4:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial3']);?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>