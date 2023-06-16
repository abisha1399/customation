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
function ime_consent_form_report($pid, $encounter, $cols, $id)
{
    $count=0;
    $sql = "SELECT * FROM `consentform` WHERE id=$id AND pid =$pid AND encounter =$encounter";
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);


    if ($data) {
        ?>
        <table style='width: 100%;'>
            <tr>

                <td><span class=bold><?php echo xlt('IME Consent Form'); ?></span></td>
            </tr>
            <tr>
                <th><label><?php echo xlt('Client Name :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['name'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date Of Birth:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['date'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('TextData1:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['first'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('TextData2 :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['second'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('TextData3 :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['third'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Client Signature :'); ?></label></th>
                <td>
                <?php
                        if($data['client']!=''){
                            echo '<img src='.$data['client'].' style="width:40%;height:40px;" >';
                        }
                        ?>

                <!-- <span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['client'])); ?></span> -->
                </td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' Date:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dat'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Signature of Responsible Party if other than client:'); ?></label></th>
                <td>
                    <?php
                    if($data['signature']!=''){
                        echo '<img src='.$data['signature'].' style="width:40%;height:40px;" >';
                    }
                    ?>
                    <!-- <span class=text style="margin-left: -1068px;"><?php echo xlt(text($data['signature'])); ?></span> -->
                </td>
            </tr>
            <tr>
            <th><label><?php echo xlt(' Date:'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['datas'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Describe authority to sign on behalf of Client :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['auth'])); ?></span></td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Witness Signature :'); ?></label></th>
                <td>
                <?php
                    if($data['witness']!=''){
                        echo '<img src='.$data['witness'].' style="width:40%;height:40px;" >';
                    }
                    ?>
                    <!-- <span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['witness'])); ?></span> -->
                </td>
            </tr>
            <tr>
            <th><label><?php echo xlt('Date :'); ?></label></th>
                <td><span class=text style="margin-left: -1121px;"><?php echo xlt(text($data['dates'])); ?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>
