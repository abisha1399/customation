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
function facsimile_cover_sheet_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_facsimile_coversheet` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Facsimile Transmission Cover Sheet'); ?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Date:'); ?></b></label> 
                <span class=text><?php echo xlt(text($data['date'])); ?></span></td>
            </tr>
            <tr>
            
                <td>
                <label><b><?php echo xlt('To Address:'); ?></b></label>
                    <span class=text><?php echo xlt(text($data['toaddr'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Fax #:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['fax'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('From Address:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['fromaddr'])); ?></span></td>
            </tr>
            <tr>
            <td> <label><b><?php echo xlt('Subject:'); ?></b></label> 
                <span class=text><?php echo xlt(text($data['subject'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Total Number of pages:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['page'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Patient Name:'); ?></label></b> 
                 <span class=text><?php echo xlt(text($data['name'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('SSN #:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['ssn'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Patient Date of Birth:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['dob'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Subscriber Name (if diffrent):'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['subscriber'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b> Subscriber's Employer Name: </b></label> 
                 <span class=text><?php echo xlt(text($data['employee'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Coverage Determination:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['coverage'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData 1:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check1'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('CheckBoxData 2:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['check2'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('AuthTextData:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['auth'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('DeterminationTextData:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['determination'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b>Authorized Representative's Address:</b></label> 
                 <span class=text><?php echo xlt(text($data['addr'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Relationship to Member:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['member'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Signature of the patient electing appeal:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['patient'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Date:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['patdate'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('MinorTextData:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['minor'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('ConsentTextData:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['consent'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Signature of the parent/Guardian/POA:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['guardian'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Date:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['guarddate'])); ?></span></td>
            </tr>
            <tr>
            <td><label><b><?php echo xlt('Relation:'); ?></b></label> 
                 <span class=text><?php echo xlt(text($data['relation1'])); ?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>