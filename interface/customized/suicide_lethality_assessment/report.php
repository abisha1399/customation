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
function suicide_lethality_assessment_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_suicide_lethality_assessment` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Suicide Lethality Assessment'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData1:'); ?></b></label> 
                <span class=text><?php echo ($data['check1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData1:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData2:'); ?></b></label> 
                <span class=text><?php echo ($data['check2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData2:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext2']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData3:'); ?></b></label> 
                <span class=text><?php echo ($data['check3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData3:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext3']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData4:'); ?></b></label> 
                <span class=text><?php echo ($data['check4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData4:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext4']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData5:'); ?></b></label> 
                <span class=text><?php echo ($data['check5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData5:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext5']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData6:'); ?></b></label> 
                <span class=text><?php echo ($data['check6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData6:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext6']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData7:'); ?></b></label> 
                <span class=text><?php echo ($data['check7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData7:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext7']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData8:'); ?></b></label> 
                <span class=text><?php echo ($data['check8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData8:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext8']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData9:'); ?></b></label> 
                <span class=text><?php echo ($data['check9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData9:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext9']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData10:'); ?></b></label> 
                <span class=text><?php echo ($data['check10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData10:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext10']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData11:'); ?></b></label> 
                <span class=text><?php echo ($data['check11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData11:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext11']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData12:'); ?></b></label> 
                <span class=text><?php echo ($data['check12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData12:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext12']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData13:'); ?></b></label> 
                <span class=text><?php echo ($data['check13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData13:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext13']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData14:'); ?></b></label> 
                <span class=text><?php echo ($data['check14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData14:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext14']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData15:'); ?></b></label> 
                <span class=text><?php echo ($data['check15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData15:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext15']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData16:'); ?></b></label> 
                <span class=text><?php echo ($data['check16']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData16:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext16']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData17:'); ?></b></label> 
                <span class=text><?php echo ($data['check17']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData17:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext17']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData18:'); ?></b></label> 
                <span class=text><?php echo ($data['check18']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData18:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext18']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData19:'); ?></b></label> 
                <span class=text><?php echo ($data['check19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData19:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext19']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData20:'); ?></b></label> 
                <span class=text><?php echo ($data['check20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData20:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext20']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData21:'); ?></b></label> 
                <span class=text><?php echo ($data['check21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData21:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext21']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData22:'); ?></b></label> 
                <span class=text><?php echo ($data['check22']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData22:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext22']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData23:'); ?></b></label> 
                <span class=text><?php echo ($data['check23']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData23:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext23']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData24:'); ?></b></label> 
                <span class=text><?php echo ($data['check24']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData24:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext24']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData25:'); ?></b></label> 
                <span class=text><?php echo ($data['check25']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData25:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext25']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData26:'); ?></b></label> 
                <span class=text><?php echo ($data['check26']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData26:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext26']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData27:'); ?></b></label> 
                <span class=text><?php echo ($data['check27']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData27:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext27']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData28:'); ?></b></label> 
                <span class=text><?php echo ($data['check28']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData28:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext28']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData29:'); ?></b></label> 
                <span class=text><?php echo ($data['check29']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData29:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext29']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData30:'); ?></b></label> 
                <span class=text><?php echo ($data['check30']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData30:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext30']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData31:'); ?></b></label> 
                <span class=text><?php echo ($data['check31']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData31:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext31']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData32:'); ?></b></label> 
                <span class=text><?php echo ($data['check32']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData32:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext32']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData33:'); ?></b></label> 
                <span class=text><?php echo ($data['check33']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData33:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext33']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('CheckBoxData34:'); ?></b></label> 
                <span class=text><?php echo ($data['check34']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('TextBoxData34:'); ?></b></label> 
                <span class=text><?php echo ($data['suicidetext34']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Current Stressors (as per patient):'); ?></b></label> 
                <span class=text><?php echo ($data['stressor']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Motivation for Treatment (as per patient):'); ?></b></label> 
                <span class=text><?php echo ($data['motivation']);?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>