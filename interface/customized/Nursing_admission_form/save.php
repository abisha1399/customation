<?php
/**
 * Clinical instructions form save.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$_POST['no_pcp']=isset($_POST['no_pcp'])?$_POST['no_pcp']:'';
$_POST['temperature']=isset($_POST['temperature'])?$_POST['temperature']:'';
$_POST['orien_check2']=isset($_POST['orien_check2'])?$_POST['orien_check2']:'';
$_POST['orien_check3']=isset($_POST['orien_check3'])?$_POST['orien_check3']:'';
$_POST['comm_check2']=isset($_POST['comm_check2'])?$_POST['comm_check2']:'';
$_POST['whether1']= isset($_POST['whether1'])?$_POST['whether1']:'';
$_POST['whether2']= isset($_POST['whether2'])?$_POST['whether2']:'';
$_POST['whether3']= isset($_POST['whether3'])?$_POST['whether3']:'';
$_POST['radio_changes1']= isset($_POST['radio_changes1'])?$_POST['radio_changes1']:'';
$_POST['history1']= isset($_POST['history1'])?$_POST['history1']:'';
$_POST['history2']= isset($_POST['history2'])?$_POST['history2']:'';
$_POST['history3']= isset($_POST['history3'])?$_POST['history3']:'';
$_POST['denied_history']=isset($_POST['denied_history'])?$_POST['denied_history']:'';
$_POST['num_check1']=isset($_POST['num_check1'])?$_POST['num_check1']:'';
$_POST['num_check2']=isset($_POST['num_check2'])?$_POST['num_check2']:'';
$_POST['num_check3']=isset($_POST['num_check3'])?$_POST['num_check3']:'';

$_POST['card_check1']=isset($_POST['card_check1'])?$_POST['card_check1']:'';
$_POST['card_check2']=isset($_POST['card_check2'])?$_POST['card_check2']:'';
$_POST['card_check3']=isset($_POST['card_check3'])?$_POST['card_check3']:'';
$_POST['card_check4']=isset($_POST['card_check4'])?$_POST['card_check4']:'';
$_POST['card_check5']=isset($_POST['card_check5'])?$_POST['card_check5']:'';

$_POST['respiration1']=isset($_POST['respiration1'])?$_POST['respiration1']:'';
$_POST['respiration2']=isset($_POST['respiration2'])?$_POST['respiration2']:'';
$_POST['respiration3']=isset($_POST['respiration3'])?$_POST['respiration3']:'';
$_POST['respiration4']=isset($_POST['respiration4'])?$_POST['respiration4']:'';
$_POST['respiration5']=isset($_POST['respiration5'])?$_POST['respiration5']:'';
$_POST['respiration6']=isset($_POST['respiration6'])?$_POST['respiration6']:'';

$_POST['gas_check01']=isset($_POST['gas_check01'])?$_POST['gas_check01']:'';
$_POST['gas_check1']=isset($_POST['gas_check1'])?$_POST['gas_check1']:'';
$_POST['gas_check2']=isset($_POST['gas_check2'])?$_POST['gas_check2']:'';
$_POST['gas_check3']=isset($_POST['gas_check3'])?$_POST['gas_check3']:'';
$_POST['gas_check4']=isset($_POST['gas_check4'])?$_POST['gas_check4']:'';
$_POST['gas_check5']=isset($_POST['gas_check5'])?$_POST['gas_check5']:'';
$_POST['gas_check6']=isset($_POST['gas_check6'])?$_POST['gas_check6']:'';
$_POST['gas_check7']=isset($_POST['gas_check7'])?$_POST['gas_check7']:'';

$_POST['gas_check02']=isset($_POST['gas_check02'])?$_POST['gas_check02']:'';
$_POST['gas_check8']=isset($_POST['gas_check8'])?$_POST['gas_check8']:'';
$_POST['gas_check9']=isset($_POST['gas_check9'])?$_POST['gas_check9']:'';
$_POST['gas_check10']=isset($_POST['gas_check10'])?$_POST['gas_check10']:'';
$_POST['gas_check11']=isset($_POST['gas_check11'])?$_POST['gas_check11']:'';
$_POST['gas_check12']=isset($_POST['gas_check12'])?$_POST['gas_check12']:'';
$_POST['gas_check13']=isset($_POST['gas_check13'])?$_POST['gas_check13']:'';
$_POST['gas_check14']=isset($_POST['gas_check14'])?$_POST['gas_check14']:'';
$_POST['gas_check15']=isset($_POST['gas_check15'])?$_POST['gas_check15']:'';
$_POST['gas_check16']=isset($_POST['gas_check16'])?$_POST['gas_check16']:'';
$_POST['gas_check17']=isset($_POST['gas_check17'])?$_POST['gas_check17']:'';
$_POST['gas_check18']=isset($_POST['gas_check18'])?$_POST['gas_check18']:'';
$_POST['gas_check19']=isset($_POST['gas_check19'])?$_POST['gas_check19']:'';
$_POST['gas_check20']=isset($_POST['gas_check20'])?$_POST['gas_check20']:'';
$_POST['gas_check21']=isset($_POST['gas_check21'])?$_POST['gas_check21']:'';
$_POST['gas_check22']=isset($_POST['gas_check22'])?$_POST['gas_check22']:'';

$_POST['ab_check1']=isset($_POST['ab_check1'])?$_POST['ab_check1']:'';
$_POST['ab_check2']=isset($_POST['ab_check2'])?$_POST['ab_check2']:'';
$_POST['ab_check3']=isset($_POST['ab_check3'])?$_POST['ab_check3']:'';
$_POST['ab_check4']=isset($_POST['ab_check4'])?$_POST['ab_check4']:'';
$_POST['ab_check5']=isset($_POST['ab_check5'])?$_POST['ab_check5']:'';
$_POST['ab_check6']=isset($_POST['ab_check6'])?$_POST['ab_check6']:'';

$_POST['eczema']=isset($_POST['eczema'])?$_POST['eczema']:'';
$_POST['normal_find']=isset($_POST['normal_find'])?$_POST['normal_find']:'';

$_POST['normal_find_check']= isset($_POST['normal_find_check'])??'';

if ($id && $id != 0)
{
    $newid = update_form("form_admission_note", $_POST, $id,$_GET['pid']);


}
else
{
    $newid = submit_form("form_admission_note", $_POST, $_GET["pid"],$encounter);
    addForm($encounter, "Nursing admission form", $newid, "Nursing_admission_form", $pid, $userauthorized);

}

formHeader("Redirecting....");
formJump();
formFooter();
