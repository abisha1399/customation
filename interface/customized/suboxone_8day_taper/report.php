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
function suboxone_8day_taper_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_suboxone_8day_taper` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Suboxone 8 day Taper/Heroin'); ?></span></td>
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
                 <td><label><b><?php echo xlt('Suboxone Date1:'); ?></b></label> 
                <span class=text><?php echo ($data['date1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials1:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign1']!='')
                    {
                       echo '<img src="'.$data['ptsign1'].'" style="width:100px;height:90px;">';
                    }
                    ?>
                    </span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials2:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign2']!='')
                    {
                       echo '<img src="'.$data['ptsign2'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials3:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign3']!='')
                    {
                       echo '<img src="'.$data['ptsign3'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Suboxone Date2:'); ?></b></label> 
                <span class=text><?php echo ($data['date2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials4:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign4']!='')
                    {
                       echo '<img src="'.$data['ptsign4'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials5:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign5']!='')
                    {
                       echo '<img src="'.$data['ptsign5'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials6:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign6']!='')
                    {
                       echo '<img src="'.$data['ptsign6'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Suboxone Date3:'); ?></b></label> 
                <span class=text><?php echo ($data['date3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials7:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign7']!='')
                    {
                       echo '<img src="'.$data['ptsign7'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials8:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign8']!='')
                    {
                       echo '<img src="'.$data['ptsign8'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials9:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign9']!='')
                    {
                       echo '<img src="'.$data['ptsign9'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Suboxone Date4:'); ?></b></label> 
                <span class=text><?php echo ($data['date4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials10:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign10']!='')
                    {
                       echo '<img src="'.$data['ptsign10'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials11:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign11']!='')
                    {
                       echo '<img src="'.$data['ptsign11'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials12:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign12']!='')
                    {
                       echo '<img src="'.$data['ptsign12'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Suboxone Date5:'); ?></b></label> 
                <span class=text><?php echo ($data['date5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials13:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign13']!='')
                    {
                       echo '<img src="'.$data['ptsign13'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials14:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign14']!='')
                    {
                       echo '<img src="'.$data['ptsign14'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Order Date:'); ?></b></label> 
                <span class=text><?php echo ($data['orderdate']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Transcribing:'); ?></b></label> 
                <span class=text><?php echo ($data['nurse']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign']!='')
                    {
                       echo '<img src="'.$data['ptsign'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials:'); ?></b></label> 
                <span class=text><?php echo ($data['ptinitial']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Verifying Nurse:'); ?></b></label> 
                <span class=text><?php echo ($data['nursever']);?></span></td>
            </tr>           
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature1:'); ?></b></label> 
                <span class=text>
                    <?php if($data['nursign']!='')
                    {
                       echo '<img src="'.$data['nursign'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials1:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature2:'); ?></b></label> 
                <span class=text>
                    <?php if($data['nursign1']!='')
                    {
                       echo '<img src="'.$data['nursign1'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials2:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature3:'); ?></b></label> 
                <span class=text>
                    <?php if($data['nursign2']!='')
                    {
                       echo '<img src="'.$data['nursign2'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials3:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Suboxone Date6:'); ?></b></label> 
                <span class=text><?php echo ($data['date6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials15:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign15']!='')
                    {
                       echo '<img src="'.$data['ptsign15'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials16:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign16']!='')
                    {
                       echo '<img src="'.$data['ptsign16'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Suboxone Date7:'); ?></b></label> 
                <span class=text><?php echo ($data['date7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials17:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign17']!='')
                    {
                       echo '<img src="'.$data['ptsign17'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials18:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign18']!='')
                    {
                       echo '<img src="'.$data['ptsign18'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Suboxone Date8:'); ?></b></label> 
                <span class=text><?php echo ($data['date8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials19:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign19']!='')
                    {
                       echo '<img src="'.$data['ptsign19'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Order Date1:'); ?></b></label> 
                <span class=text><?php echo ($data['orderdate1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Transcribing1:'); ?></b></label> 
                <span class=text><?php echo ($data['nurse1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature1:'); ?></b></label> 
                <span class=text>
                    <?php if($data['ptsign']!='')
                    {
                       echo '<img src="'.$data['ptsign'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials1:'); ?></b></label> 
                <span class=text><?php echo ($data['patinitial']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Verifying Nurse1:'); ?></b></label> 
                <span class=text><?php echo ($data['nursever1']);?></span></td>
            </tr>           
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature4:'); ?></b></label> 
                <span class=text>
                    <?php if($data['nursign3']!='')
                    {
                       echo '<img src="'.$data['nursign3'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials4:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature5:'); ?></b></label> 
                <span class=text>
                    <?php if($data['nursign4']!='')
                    {
                       echo '<img src="'.$data['nursign4'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials5:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature6:'); ?></b></label> 
                <span class=text>
                    <?php if($data['nursign5']!='')
                    {
                       echo '<img src="'.$data['nursign5'].'" style="width:100px;height:90px;">';
                    }
                    ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials6:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial5']);?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>