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
$_POST['natural_happend']= isset($_POST['natural_happend'])?$_POST['natural_happend']:' ';
$_POST['natural_witness']= isset($_POST['natural_witness'])?$_POST['natural_witness']:' ';
$_POST['natural_learn']= isset($_POST['natural_learn'])?$_POST['natural_learn']:' ';
$_POST['natural_job']= isset($_POST['natural_job'])?$_POST['natural_job']:' ';
$_POST['natural_sure']= isset($_POST['natural_sure'])?$_POST['natural_sure']:' ';
$_POST['natural_apply']= isset($_POST['natural_apply'])?$_POST['natural_apply']:' ';

$_POST['fire_happend']= isset($_POST['fire_happend'])?$_POST['fire_happend']:' ';
$_POST['fire_witness']= isset($_POST['fire_witness'])?$_POST['fire_witness']:' ';
$_POST['fire_learn']= isset($_POST['fire_learn'])?$_POST['fire_learn']:' ';
$_POST['fire_job']= isset($_POST['fire_job'])?$_POST['fire_job']:' ';
$_POST['fire_sure']= isset($_POST['fire_sure'])?$_POST['fire_sure']:' ';
$_POST['fire_apply']= isset($_POST['fire_apply'])?$_POST['fire_apply']:' ';

$_POST['transport_happend']= isset($_POST['transport_happend'])?$_POST['transport_happend']:' ';
$_POST['transport_witness']= isset($_POST['transport_witness'])?$_POST['transport_witness']:' ';
$_POST['transport_learn']= isset($_POST['transport_learn'])?$_POST['transport_learn']:' ';
$_POST['transport_job']= isset($_POST['transport_job'])?$_POST['transport_job']:' ';
$_POST['transport_sure']= isset($_POST['transport_sure'])?$_POST['transport_sure']:' ';
$_POST['transport_apply']= isset($_POST['transport_apply'])?$_POST['transport_apply']:' ';

$_POST['serious_acc_happend']= isset($_POST['serious_acc_happend'])?$_POST['serious_acc_happend']:' ';
$_POST['serious_acc_witness']= isset($_POST['serious_acc_witness'])?$_POST['serious_acc_witness']:' ';
$_POST['serious_acc_learn']= isset($_POST['serious_acc_learn'])?$_POST['serious_acc_learn']:' ';
$_POST['serious_acc_job']= isset($_POST['serious_acc_job'])?$_POST['serious_acc_job']:' ';
$_POST['serious_acc_sure']= isset($_POST['serious_acc_sure'])?$_POST['serious_acc_sure']:' ';
$_POST['serious_acc_apply']= isset($_POST['serious_acc_apply'])?$_POST['serious_acc_apply']:' ';

$_POST['exposure_happend']= isset($_POST['exposure_happend'])?$_POST['exposure_happend']:' ';
$_POST['exposure_witness']= isset($_POST['exposure_witness'])?$_POST['exposure_witness']:' ';
$_POST['exposure_learn']= isset($_POST['exposure_learn'])?$_POST['exposure_learn']:' ';
$_POST['exposure_job']= isset($_POST['exposure_job'])?$_POST['exposure_job']:' ';
$_POST['exposure_sure']= isset($_POST['exposure_sure'])?$_POST['exposure_sure']:' ';
$_POST['exposure_apply']= isset($_POST['exposure_apply'])?$_POST['exposure_apply']:' ';

$_POST['assault_happend']= isset($_POST['assault_happend'])?$_POST['assault_happend']:' ';
$_POST['assault_witness']= isset($_POST['assault_witness'])?$_POST['assault_witness']:' ';
$_POST['assault_learn']= isset($_POST['assault_learn'])?$_POST['assault_learn']:' ';
$_POST['assault_job']= isset($_POST['assault_job'])?$_POST['assault_job']:' ';
$_POST['assault_sure']= isset($_POST['assault_sure'])?$_POST['assault_sure']:' ';
$_POST['assault_apply']= isset($_POST['assault_apply'])?$_POST['assault_apply']:' ';

$_POST['weapon_happend']= isset($_POST['weapon_happend'])?$_POST['weapon_happend']:' ';
$_POST['weapon_witness']= isset($_POST['weapon_witness'])?$_POST['weapon_witness']:' ';
$_POST['weapon_learn']= isset($_POST['weapon_learn'])?$_POST['weapon_learn']:' ';
$_POST['weapon_job']= isset($_POST['weapon_job'])?$_POST['weapon_job']:' ';
$_POST['weapon_sure']= isset($_POST['weapon_sure'])?$_POST['weapon_sure']:' ';
$_POST['weapon_apply']= isset($_POST['weapon_apply'])?$_POST['weapon_apply']:' ';

$_POST['sexual_ass_happend']= isset($_POST['sexual_ass_happend'])?$_POST['sexual_ass_happend']:' ';
$_POST['sexual_ass_witness']= isset($_POST['sexual_ass_witness'])?$_POST['sexual_ass_witness']:' ';
$_POST['sexual_ass_learn']= isset($_POST['sexual_ass_learn'])?$_POST['sexual_ass_learn']:' ';
$_POST['sexual_ass_job']= isset($_POST['sexual_ass_job'])?$_POST['sexual_ass_job']:' ';
$_POST['sexual_ass_sure']= isset($_POST['sexual_ass_sure'])?$_POST['sexual_ass_sure']:' ';
$_POST['sexual_ass_apply']= isset($_POST['sexual_ass_apply'])?$_POST['sexual_ass_apply']:' ';

$_POST['unwanted_sex_happend']= isset($_POST['unwanted_sex_happend'])?$_POST['unwanted_sex_happend']:' ';
$_POST['unwanted_sex_witness']= isset($_POST['unwanted_sex_witness'])?$_POST['unwanted_sex_witness']:' ';
$_POST['unwanted_sex_learn']= isset($_POST['unwanted_sex_learn'])?$_POST['unwanted_sex_learn']:' ';
$_POST['unwanted_sex_job']= isset($_POST['unwanted_sex_job'])?$_POST['unwanted_sex_job']:' ';
$_POST['unwanted_sex_sure']= isset($_POST['unwanted_sex_sure'])?$_POST['unwanted_sex_sure']:' ';
$_POST['unwanted_sex_apply']= isset($_POST['unwanted_sex_apply'])?$_POST['unwanted_sex_apply']:' ';

$_POST['military_happend']= isset($_POST['military_happend'])?$_POST['military_happend']:' ';
$_POST['military_witness']= isset($_POST['military_witness'])?$_POST['military_witness']:' ';
$_POST['military_learn']= isset($_POST['military_learn'])?$_POST['military_learn']:' ';
$_POST['military_job']= isset($_POST['military_job'])?$_POST['military_job']:' ';
$_POST['military_sure']= isset($_POST['military_sure'])?$_POST['military_sure']:' ';
$_POST['military_apply']= isset($_POST['military_apply'])?$_POST['military_apply']:' ';

$_POST['captivity_happend']= isset($_POST['captivity_happend'])?$_POST['captivity_happend']:' ';
$_POST['captivity_witness']= isset($_POST['captivity_witness'])?$_POST['captivity_witness']:' ';
$_POST['captivity_learn']= isset($_POST['captivity_learn'])?$_POST['captivity_learn']:' ';
$_POST['captivity_job']= isset($_POST['captivity_job'])?$_POST['captivity_job']:' ';
$_POST['captivity_sure']= isset($_POST['captivity_sure'])?$_POST['captivity_sure']:' ';
$_POST['captivity_apply']= isset($_POST['captivity_apply'])?$_POST['captivity_apply']:' ';

$_POST['life_thread_happend']= isset($_POST['life_thread_happend'])?$_POST['life_thread_happend']:' ';
$_POST['life_thread_witness']= isset($_POST['life_thread_witness'])?$_POST['life_thread_witness']:' ';
$_POST['life_thread_learn']= isset($_POST['life_thread_learn'])?$_POST['life_thread_learn']:' ';
$_POST['life_thread_job']= isset($_POST['life_thread_job'])?$_POST['life_thread_job']:' ';
$_POST['life_thread_sure']= isset($_POST['life_thread_sure'])?$_POST['life_thread_sure']:' ';
$_POST['life_thread_apply']= isset($_POST['life_thread_apply'])?$_POST['life_thread_apply']:' ';

$_POST['severe_happend']= isset($_POST['severe_happend'])?$_POST['severe_happend']:' ';
$_POST['severe_witness']= isset($_POST['severe_witness'])?$_POST['severe_witness']:' ';
$_POST['severe_learn']= isset($_POST['severe_learn'])?$_POST['severe_learn']:' ';
$_POST['severe_job']= isset($_POST['severe_job'])?$_POST['severe_job']:' ';
$_POST['severe_sure']= isset($_POST['severe_sure'])?$_POST['severe_sure']:' ';
$_POST['severe_apply']= isset($_POST['severe_apply'])?$_POST['severe_apply']:' ';

$_POST['violent_death_happend']= isset($_POST['violent_death_happend'])?$_POST['violent_death_happend']:' ';
$_POST['violent_death_witness']= isset($_POST['violent_death_witness'])?$_POST['violent_death_witness']:' ';
$_POST['violent_death_learn']= isset($_POST['violent_death_learn'])?$_POST['violent_death_learn']:' ';
$_POST['violent_death_job']= isset($_POST['violent_death_job'])?$_POST['violent_death_job']:' ';
$_POST['violent_death_sure']= isset($_POST['violent_death_sure'])?$_POST['violent_death_sure']:' ';
$_POST['violent_death_apply']= isset($_POST['violent_death_apply'])?$_POST['violent_death_apply']:' ';

$_POST['sudden_acc_happend']= isset($_POST['sudden_acc_happend'])?$_POST['sudden_acc_happend']:' ';
$_POST['sudden_acc_witness']= isset($_POST['sudden_acc_witness'])?$_POST['sudden_acc_witness']:' ';
$_POST['sudden_acc_learn']= isset($_POST['sudden_acc_learn'])?$_POST['sudden_acc_learn']:' ';
$_POST['sudden_acc_job']= isset($_POST['sudden_acc_job'])?$_POST['sudden_acc_job']:' ';
$_POST['sudden_acc_sure']= isset($_POST['sudden_acc_sure'])?$_POST['sudden_acc_sure']:' ';
$_POST['sudden_acc_apply']= isset($_POST['sudden_acc_apply'])?$_POST['sudden_acc_apply']:' ';

$_POST['injury_happend']= isset($_POST['injury_happend'])?$_POST['injury_happend']:' ';
$_POST['injury_witness']= isset($_POST['injury_witness'])?$_POST['injury_witness']:' ';
$_POST['injury_learn']= isset($_POST['injury_learn'])?$_POST['injury_learn']:' ';
$_POST['injury_job']= isset($_POST['injury_job'])?$_POST['injury_job']:' ';
$_POST['injury_sure']= isset($_POST['injury_sure'])?$_POST['injury_sure']:' ';
$_POST['injury_apply']= isset($_POST['injury_apply'])?$_POST['injury_apply']:' ';

$_POST['experience_happend']= isset($_POST['experience_happend'])?$_POST['experience_happend']:' ';
$_POST['experience_witness']= isset($_POST['experience_witness'])?$_POST['experience_witness']:' ';
$_POST['experience_learn']= isset($_POST['experience_learn'])?$_POST['experience_learn']:' ';
$_POST['experience_job']= isset($_POST['experience_job'])?$_POST['experience_job']:' ';
$_POST['experience_sure']= isset($_POST['experience_sure'])?$_POST['experience_sure']:' ';
$_POST['experience_apply']= isset($_POST['experience_apply'])?$_POST['experience_apply']:' ';



//exit();
if ($id && $id != 0)
{
    $newid = update_form("form_life_events", $_POST, $id,$_GET['pid']);     
}
else
{    
    $newid = submit_form("form_life_events", $_POST, $_GET["pid"],$encounter);
    addForm($encounter, "Life Events Checklist", $newid, "life_events", $pid, $userauthorized);
}


formHeader("Redirecting....");
formJump();
formFooter();
