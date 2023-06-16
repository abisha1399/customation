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


$crtn = $_POST["crtn"];
$crf_no = $_POST["crf_no"];
$patient_inits = $_POST["patient_inits"];
$date = $_POST["date"];
$name = $_POST["name"];
$marital_status = $_POST["marital_status"];
$age = $_POST["age"];
$sex = $_POST["sex"];
$occupation = $_POST["occupation"];
$education = $_POST["education"];
$sadness = $_POST["sadness"];
$pessimism = $_POST["pessimism"];
$past_failure = $_POST["past_failure"];
$loss_of_pleasure = $_POST["loss_of_pleasure"];
$guilty_feelings = $_POST["guilty_feelings"];
$punishment_feelings = $_POST["punishment_feelings"];
$self_dislike = $_POST["self_dislike"];
$self_criti = $_POST["self_criti"];
$suicidal_tho = $_POST["suicidal_tho"];
$crying = $_POST["crying"];
$agitation = $_POST["agitation"];
$loss_of_interest = $_POST["loss_of_interest"];
$indecisiveness = $_POST["indecisiveness"];
$worthlessness = $_POST["worthlessness"];
$loss_of_energy = $_POST["loss_of_energy"];
$chg_slp_ptn = $_POST["chg_slp_ptn"];
$irritability = $_POST["irritability"];
$chg_in_app = $_POST["chg_in_app"];
$con_diff = $_POST["con_diff"];
$tired_fati = $_POST["tired_fati"];
$loss_int_sex = $_POST["loss_int_sex"];
$total_score = $_POST["total_score"];

if ($id && $id != 0) {
    sqlStatement("UPDATE `form_beck_depression_inventory` SET `pid`=?,`encounter`=?,`crtn`=?,`crf_no`=?,`patient_inits`=?,`date`=?,`name`=?,`marital_status`=?,`age`=?,`sex`=?,`occupation`=?,`education`=?,`sadness`=?,`pessimism`=?,`past_failure`=?,`loss_of_pleasure`=?,`guilty_feelings`=?,`punishment_feelings`=?,`self_dislike`=?,`self_criti`=?,`suicidal_tho`=?,`crying`=?, `agitation`=?,`loss_of_interest`=?,`indecisiveness`=?, `worthlessness`=?,`loss_of_energy`=?,`chg_slp_ptn`=?,`irritability`=?, `chg_in_app`=?,`con_diff`=?,`tired_fati`=?,`loss_int_sex`=?,`total_score`=?
    WHERE id = ?",array($_SESSION["pid"],$_SESSION["encounter"],$crtn,$crf_no,$patient_inits,$date,$name,$marital_status,$age,$sex,$occupation,$education,$sadness,$pessimism,$past_failure,$loss_of_pleasure,$guilty_feelings,$punishment_feelings,$self_dislike,$self_criti,$suicidal_tho,$crying,$agitation,$loss_of_interest,$indecisiveness,$worthlessness,$loss_of_energy,$chg_slp_ptn,$irritability,$chg_in_app,$con_diff,$tired_fati,$loss_int_sex,$total_score,$id));
}
else 
{
    $newid = sqlInsert("INSERT INTO `form_beck_depression_inventory`(`pid`, `encounter`, `crtn`, `crf_no`, `patient_inits`, `date`, `name`, `marital_status`, `age`, `sex`, `occupation`, `education`, `sadness`, `pessimism`, `past_failure`, `loss_of_pleasure`, `guilty_feelings`, `punishment_feelings`, `self_dislike`, `self_criti`, `suicidal_tho`, `crying`, `agitation`, `loss_of_interest`, `indecisiveness`, `worthlessness`, `loss_of_energy`, `chg_slp_ptn`, `irritability`, `chg_in_app`, `con_diff`, `tired_fati`, `loss_int_sex`, `total_score`) 
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 

    array($_SESSION["pid"],$_SESSION["encounter"],$crtn,$crf_no,$patient_inits,$date,$name,$marital_status,$age,$sex,$occupation,$education,$sadness,$pessimism,$past_failure,$loss_of_pleasure,$guilty_feelings,$punishment_feelings,$self_dislike,$self_criti,$suicidal_tho,$crying,$agitation,$loss_of_interest,$indecisiveness,$worthlessness,$loss_of_energy,$chg_slp_ptn,$irritability,$chg_in_app,$con_diff,$tired_fati,$loss_int_sex,$total_score));

    addForm($encounter, "beck depression inventory", $newid, "beck_depression_inventory",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
