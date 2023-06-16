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
function current_withdrawal_signs_symptoms_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_current_withdrawal_signs` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Current Withdrawal Signs/Symptoms'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData1:'); ?></b></label> 
                <span class=text><?php echo ($data['check1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData2:'); ?></b></label> 
                <span class=text><?php echo ($data['check2']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData3:'); ?></b></label> 
                <span class=text><?php echo ($data['check3']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData4:'); ?></b></label> 
                <span class=text><?php echo ($data['check4']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData5:'); ?></b></label> 
                <span class=text><?php echo ($data['check5']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData6:'); ?></b></label> 
                <span class=text><?php echo ($data['check6']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData7:'); ?></b></label> 
                <span class=text><?php echo ($data['check7']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData8:'); ?></b></label> 
                <span class=text><?php echo ($data['check8']);?></span></td>
            </tr>
          
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData9:'); ?></b></label> 
                <span class=text><?php echo ($data['check9']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData10:'); ?></b></label> 
                <span class=text><?php echo ($data['check10']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData11:'); ?></b></label> 
                <span class=text><?php echo ($data['check11']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData12:'); ?></b></label> 
                <span class=text><?php echo ($data['check12']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData13:'); ?></b></label> 
                <span class=text><?php echo ($data['check13']);?></span></td>
            </tr>
         
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData14:'); ?></b></label> 
                <span class=text><?php echo ($data['check14']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData15:'); ?></b></label> 
                <span class=text><?php echo ($data['check15']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData16:'); ?></b></label> 
                <span class=text><?php echo ($data['check16']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData17:'); ?></b></label> 
                <span class=text><?php echo ($data['check17']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData18:'); ?></b></label> 
                <span class=text><?php echo ($data['check18']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData19:'); ?></b></label> 
                <span class=text><?php echo ($data['check19']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData20:'); ?></b></label> 
                <span class=text><?php echo ($data['check20']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData21:'); ?></b></label> 
                <span class=text><?php echo ($data['check21']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData22:'); ?></b></label> 
                <span class=text><?php echo ($data['check22']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData23:'); ?></b></label> 
                <span class=text><?php echo ($data['check23']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData24:'); ?></b></label> 
                <span class=text><?php echo ($data['check24']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData25:'); ?></b></label> 
                <span class=text><?php echo ($data['check25']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData26:'); ?></b></label> 
                <span class=text><?php echo ($data['check26']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData27:'); ?></b></label> 
                <span class=text><?php echo ($data['check27']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData28:'); ?></b></label> 
                <span class=text><?php echo ($data['check28']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData29:'); ?></b></label> 
                <span class=text><?php echo ($data['check29']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData30:'); ?></b></label> 
                <span class=text><?php echo ($data['check30']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData31:'); ?></b></label> 
                <span class=text><?php echo ($data['check31']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData32:'); ?></b></label> 
                <span class=text><?php echo ($data['check32']);?></span></td>
            </tr>
           
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData33:'); ?></b></label> 
                <span class=text><?php echo ($data['check33']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData34:'); ?></b></label> 
                <span class=text><?php echo ($data['check34']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData35:'); ?></b></label> 
                <span class=text><?php echo ($data['check35']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData36:'); ?></b></label> 
                <span class=text><?php echo ($data['check36']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData37:'); ?></b></label> 
                <span class=text><?php echo ($data['check37']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData38:'); ?></b></label> 
                <span class=text><?php echo ($data['check38']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData39:'); ?></b></label> 
                <span class=text><?php echo ($data['check39']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData40:'); ?></b></label> 
                <span class=text><?php echo ($data['check40']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData41:'); ?></b></label> 
                <span class=text><?php echo ($data['check41']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData42:'); ?></b></label> 
                <span class=text><?php echo ($data['check42']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData43:'); ?></b></label> 
                <span class=text><?php echo ($data['check43']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Result of HCG Test:'); ?></b></label> 
                <span class=text><?php echo ($data['check44']=="Negative")? "Negative" : "Positive";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Is the patient psychotic?:'); ?></b></label> 
                <span class=text><?php echo ($data['check46']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Is the patient sexually active?:'); ?></b></label> 
                <span class=text><?php echo ($data['check48']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Is the patient impulsive?:'); ?></b></label> 
                <span class=text><?php echo ($data['check50']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Does the patient use contraception?:'); ?></b></label> 
                <span class=text><?php echo ($data['check52']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Is the patient mentally changed?:'); ?></b></label> 
                <span class=text><?php echo ($data['check54']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Has the patient had a recent abortion?:'); ?></b></label> 
                <span class=text><?php echo ($data['check56']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Is there a possibility you are pregnant?:'); ?></b></label> 
                <span class=text><?php echo ($data['check58']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Has the patient had a recent miscarriage?:'); ?></b></label> 
                <span class=text><?php echo ($data['check60']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Dose the patient have a history of STD?:'); ?></b></label> 
                <span class=text><?php echo ($data['check62']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Dose the patient have any children?:'); ?></b></label> 
                <span class=text><?php echo ($data['check64']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b>Inform the patient of the organization's pain management philosophy?:</b></label> 
                <span class=text><?php echo ($data['check66']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData68:'); ?></b></label> 
                <span class=text><?php echo ($data['check68']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData69:'); ?></b></label> 
                <span class=text><?php echo ($data['check69']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData70:'); ?></b></label> 
                <span class=text><?php echo ($data['check70']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Do you have pain now?:'); ?></b></label> 
                <span class=text><?php echo ($data['check71']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Do you have chronic pain?'); ?></b></label> 
                <span class=text><?php echo ($data['check73']=="Yes")?"Yes" : "No";?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('where is your pain located:'); ?></b></label> 
                <span class=text><?php echo ($data['pain']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('where is your present pain intensity:'); ?></b></label> 
                <span class=text><?php echo ($data['intensity']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('what is acceptable level of pain:'); ?></b></label> 
                <span class=text><?php echo ($data['acceptable']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('Describe the characteristic of the pain:'); ?></b></label> 
                <span class=text><?php echo ($data['characteristic']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Describe the onset and duration of the pain:'); ?></b></label> 
                <span class=text><?php echo ($data['onset']);?></span></td>
            </tr>
            
            <tr>
                 <td><label><b><?php echo xlt('What relieves the pain:'); ?></b></label> 
                <span class=text><?php echo ($data['relieves']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('What causes or increases the pain:'); ?></b></label> 
                <span class=text><?php echo ($data['causes']);?></span></td>
            </tr> 
            <tr>
                 <td><label><b><?php echo xlt('Effects of pain:'); ?></b></label> 
                <span class=text><?php echo ($data['effects']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData75:'); ?></b></label> 
                <span class=text><?php echo ($data['check75']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData76:'); ?></b></label> 
                <span class=text><?php echo ($data['check76']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Review TextData:'); ?></b></label> 
                <span class=text><?php echo ($data['treatment']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('RN Intervention:'); ?></b></label> 
                <span class=text><?php echo ($data['intervention']);?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>