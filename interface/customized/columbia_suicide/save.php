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

use OpenEMR\Common\Csrf\CsrfUtils;

if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}

if (!$encounter) { // comes from globals.php
    die(xlt("Internal error: we do not seem to be in an encounter!"));
}

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$wish_dead = isset($_POST['wish_dead'])?$_POST['wish_dead']:'';
$wish_dead_reason = isset($_POST['wish_dead_reason'])?$_POST['wish_dead_reason']:' ';
$wish_data= json_encode(array('wish_dead'=>$wish_dead,'wish_dead_reason'=>$wish_dead_reason));

$non_specific_active= isset($_POST['non_specific_active'])?$_POST['non_specific_active']:'';
$non_specific_active_data= json_encode(array('non_specific_active'=>$non_specific_active,'non_specif_active_reason'=>$_POST['non_specif_active_reason']));

$non_specific_active= isset($_POST['active_suicide_ideation'])?$_POST['active_suicide_ideation']:'';
$active_suicide_ideation_data= json_encode(array('non_specific_active'=>$non_specific_active,'active_suicide_ideation_mean'=>$_POST['active_suicide_ideation_mean'],'active_suicide_ideation_access'=>$_POST['active_suicide_ideation_access']));

$active_suicide_wsp= isset($_POST['active_suicide_wsp'])?$_POST['active_suicide_wsp']:'';
$active_suicide_long_data= json_encode(array('active_suicide_wsp'=>$active_suicide_wsp,'active_suicide_wsp_reason'=>$_POST['active_suicide_wsp_reason']));


$active_suicide= isset($_POST['active_suicide'])?$_POST['active_suicide']:'';
$active_suicide_data= json_encode(array('active_suicide'=>$active_suicide,'active_suicide_spi_in'=>$_POST['active_suicide_spi_in'],'active_suicide_spi_time'=>$_POST['active_suicide_spi_time'],'active_suicide_loca'=>$_POST['active_suicide_loca']));

$Preparatory_act_life= isset($_POST['Preparatory_act_life'])?$_POST['Preparatory_act_life']:'';
$Preparatory_act_month= isset($_POST['Preparatory_act_month'])?$_POST['Preparatory_act_month']:'';
$Preparatory_act_data= json_encode(array('Preparatory_act_life'=>$Preparatory_act_life,'Preparatory_act_month'=>$Preparatory_act_month,'Preparatory_act_reason'=>$_POST['Preparatory_act_reason'],'Preparatory_act_reason_month'=>$_POST['Preparatory_act_reason_month']));


if ($id && $id != 0)
{
    sqlStatement("UPDATE form_columbia_suicide SET wish_dead=?,non_specifi_active=?,active_susaid=?,active_susaid_without=?,active_susaid_spe_plan=?,preparatory_acts =? WHERE id = ?", array($wish_data,$non_specific_active_data,$active_suicide_ideation_data,$active_suicide_long_data,$active_suicide_data,$Preparatory_act_data,$id));
   
    // $newid = sqlstament("UPDATE form_columbia_suicide SET wish_dead=?,non_specifi_active=?,active_susaid=?,active_susaid_without=?,active_susaid_spe_plan=?,preparatory_acts=? WHERE id=?",array($wish_data,$non_specific_active_data,$active_suicide_ideation_data,$active_suicide_long_data,$active_suicide_data,$Preparatory_act_data,$id));     
}
else
{    
    $newid  = sqlInsert("INSERT INTO form_columbia_suicide(pid,encounter,user,date,wish_dead,non_specifi_active,active_susaid,active_susaid_without,active_susaid_spe_plan,preparatory_acts,activity)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)",array($pid,$encounter,$_SESSION['authUser'],date('Y-m-d'),$wish_data,$non_specific_active_data,$active_suicide_ideation_data,$active_suicide_long_data,$active_suicide_data,$Preparatory_act_data,'1'));
    addForm($encounter,"COLUMBIA-SUICIDE SEVERITY RATING SCALE",$newid,"columbia_suicide",$pid,$userauthorized);
}
formHeader("Redirecting....");
formJump();
formFooter();
