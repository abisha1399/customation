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
//print_r($_POST);die;
if (!$encounter) { // comes from globals.php
    die(xlt("Internal error: we do not seem to be in an encounter!"));
}
//echo '<pre>';print_r($_POST);exit();
$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
// $review_system = $_POST['review_system'];
// $mental_appearance = $_POST['mental_appearance'];
//echo '<pre>';print_r($review_system);exit();
$_POST['postive_for']= isset($_POST['postive_fo'])?$_POST['positive_for']:'';
$_POST['faint_for']= isset($_POST['faint_for'])?$_POST['faint_for']:'';

if ($id && $id != 0)
{
    $newid = update_form("form_doctor_note", $_POST, $id,$_GET['pid']);    
   
    // $newid = sqlstament("UPDATE form_columbia_suicide SET wish_dead=?,non_specifi_active=?,active_susaid=?,active_susaid_without=?,active_susaid_spe_plan=?,preparatory_acts=? WHERE id=?",array($wish_data,$non_specific_active_data,$active_suicide_ideation_data,$active_suicide_long_data,$active_suicide_data,$Preparatory_act_data,$id));     
}
else
{    
    $newid = submit_form("form_doctor_note", $_POST, $_GET["pid"],$encounter);
    addForm($encounter, "Doctor Notes", $newid, "doctor_note", $pid, $userauthorized);
    //addForm($encounter,"Transitional Plan",$newid,"transitional_form",$pid,$userauthorized);
}
formHeader("Redirecting....");
formJump();
formFooter();
