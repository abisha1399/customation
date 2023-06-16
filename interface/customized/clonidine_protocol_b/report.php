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
function clonidine_protocol_b_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_clonidine_protocol_b` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Clonidine Protocol B'); ?></span></td>
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
                <span class=text><?php echo ($data['date']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time1:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials1:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time2:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials2:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time3:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials3:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time4:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials4:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time5:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials5:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time6:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials6:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time7:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials7:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time8:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials8:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time9:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials9:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time10:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials10:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse10']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date/Time11:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials11:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse11']);?></span></td>
            </tr><tr>
                 <td><label><b><?php echo xlt('Date/Time12:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials12:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time13:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials13:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time14:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials14:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time15:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials15:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time16:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate16']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials16:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse16']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time17:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate17']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials17:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse17']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time18:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate18']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials18:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse18']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time19:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials19:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time20:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials20:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date/Time21:'); ?></b></label> 
                <span class=text><?php echo ($data['clonidate21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse/Patient Initials21:'); ?></b></label> 
                <span class=text><?php echo ($data['cloninurse21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Order Date:'); ?></b></label> 
                <span class=text><?php echo ($data['orderdate']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature:'); ?></b></label> 
                <span class=text><?php echo ($data['ptsign']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials:'); ?></b></label> 
                <span class=text><?php echo ($data['ptinitial']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Verifying Nurse:'); ?></b></label> 
                <span class=text><?php echo ($data['nurse']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature1:'); ?></b></label> 
                <span class=text><?php echo ($data['nursign']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials1:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature2:'); ?></b></label> 
                <span class=text><?php echo ($data['nursign1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Initials2:'); ?></b></label> 
                <span class=text><?php echo ($data['nurinitial1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Nurse Signature3:'); ?></b></label> 
                <span class=text><?php echo ($data['nursign2']);?></span></td>
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