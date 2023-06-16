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
function integumentary_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `form_integumentary` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res); 
    
    
    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>
                
                <td><span class=bold><?php echo xlt('Integumentary Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Normal Findings:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php if($data['check2']=="1"){
      echo "Yes";
     }else{
        echo "No";
    }  ?> </span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('History Of eczema:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php if($data['check1']=="1"){
      echo "Yes";
     }else{
         echo "No";
     } ?></span></td>
            </tr>
            <tr>
            
        </table>
        <?php
    }
}
?>