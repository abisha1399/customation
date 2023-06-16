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
function authorized_representative_request_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_authorized_representative` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Authorized Representative Request'); ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('FAX Number :'); ?></b></label> 
                <span class=text><?php echo xlt(text($data['fax'])); ?></span></td>
            </tr>
            <tr>
            
                <td>
                <label><b><?php echo xlt('Member Name:'); ?></b></label>
                    <span class=text><?php echo xlt(text($data['name'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Aetna ID Number:'); ?></label> 
                 <span class=text><?php echo xlt(text($data['num'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Provider of Service :'); ?></label> 
                 <span class=text><?php echo xlt(text($data['prov'])); ?></span></td>
            </tr>
            <tr>
            <td> <label><b><?php echo xlt('Name and Dates of Service :'); ?></b></label> 
                <span class=text><?php echo xlt(text($data['service'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('TextData1 :'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['first'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('TextData2:'); ?></label></b> 
                 <span class=text><?php echo xlt(text($data['second'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData1:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check1'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' CheckBoxData2:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check2'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' CheckBoxData3:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check3'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData4:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check4'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData5:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check5'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData6:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check6'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' CheckBoxData7:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check7'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' CheckBoxData8:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check8'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData9:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check9'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData10:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check10'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData11:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check11'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' CheckBoxData12:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check12'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' CheckBoxData13:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check13'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData14:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check14'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData15:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check15'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData16:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check16'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' CheckBoxData17:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check17'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt(' CheckBoxData18:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check18'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData19:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check19'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData20:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check20'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData21:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check21'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Signature:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['sign'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Date:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['date'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Print Name:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['print'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Authorization Member:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['auth'])); ?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>