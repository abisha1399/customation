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
function librium_protocol_c_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_librium_protocol_c` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span><?php echo xlt('Librium Protocol C'); ?></span></td>
            </tr>
            <br/>
            <tr>
                 <td><label><b><?php echo xlt('Allergies:'); ?></b></label> 
                <span class=text><?php echo ($data['allergy']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Name:'); ?></b></label> 
                <span class=text><?php echo ($data['pat_name1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('DOB:'); ?></b></label> 
                <span class=text><?php echo ($data['dob1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Order Date:'); ?></b></label> 
                <span class=text><?php echo ($data['order_date1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Initials:'); ?></b></label> 
                <span class=text><?php echo ($data['ini1']);?></span></td>
            </tr>
            <tr>
                 <td><label><b><?php echo xlt('Patient Signature:'); ?></b></label> 
                <span class=text>
                <?php
                 if($data['sign1']!='')
                 {
                    echo '<img src="'.$data['sign1'].'" style="width:20%;height:60px;">';
                 }
                 ?>   
                 </span></td>
            </tr>
        </table>
        <?php
    }
}
?>