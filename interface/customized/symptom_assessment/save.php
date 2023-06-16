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

$client=$_POST['client'];
$date=$_POST['date'];
$date1=$_POST['date1'];
$check1=isset($_POST['check1'])?$_POST['check1']:'';
$check2=isset($_POST['check2'])?$_POST['check2']:'';
$check3=isset($_POST['check3'])?$_POST['check3']:'';
$check4=isset($_POST['check4'])?$_POST['check4']:'';
$check5=isset($_POST['check5'])?$_POST['check5']:'';
$check6=isset($_POST['check6'])?$_POST['check6']:'';
$check7=isset($_POST['check7'])?$_POST['check7']:'';
$check8=isset($_POST['check8'])?$_POST['check8']:'';
$check9=isset($_POST['check9'])?$_POST['check9']:'';
$licens=$_POST['licens'];
$date2=$_POST['date2'];
$stlicens=$_POST['stlicens'];
$check10=isset($_POST['check10'])?$_POST['check10']:'';
$check11=isset($_POST['check11'])?$_POST['check11']:'';
$signpt=$_POST['signpt'];
$date3=$_POST['date3'];
$facility=$_POST['facility'];
$spoken=$_POST['spoken'];
$date4=$_POST['date4'];
$symptime=$_POST['symptime'];
$mantoux=$_POST['mantoux'];
$result=$_POST['result'];
$rnlicense=$_POST['rnlicense'];

    if ($id && $id != 0) {
    sqlStatement("UPDATE form_symptom_assessment SET client=?,date=?,date1=?,check1=?,check2=?,check3=?,check4=?,check5=?,check6=?,check7=?,check8=?,check9=?,licens=?,date2=?,stlicens=?,check10=?,check11=?,signpt=?,date3=?,facility=?,spoken=?,date4=?,symptime=?,mantoux=?,result=?,rnlicense=? WHERE id = ?",
    array($client,$date,$date1,$check1,$check2,$check3,$check4,$check5,$check6,$check7,$check8,$check9,$licens,$date2,$stlicens,$check10,$check11,$signpt,$date3,$facility,$spoken,$date4,$symptime,$mantoux,$result,$rnlicense,$id));
}else
{
    $newid = sqlInsert("INSERT INTO form_symptom_assessment(pid,encounter,client,date,date1,check1,check2,check3,check4,check5,check6,check7,check8,check9,licens,date2,stlicens,check10,check11,signpt,date3,facility,spoken,date4,symptime,mantoux,result,rnlicense)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$client,$date,$date1,$check1,$check2,$check3,$check4,$check5,$check6,$check7,$check8,$check9,$licens,$date2,$stlicens,$check10,$check11,$signpt,$date3,$facility,$spoken,$date4,$symptime,$mantoux,$result,$rnlicense));
    addForm($encounter, "Symptom Assessment for Pulmonary Tuberclosis (TB)", $newid, "symptom_assessment",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();

if($id){
    $fid=$id;
}
else{
    $fid=$newid;
}


redirect($fid);

function redirect($fid) {
    header("Location: pdf_form.php?encounter={$_SESSION["encounter"]}&pid={$_SESSION["pid"]}&id={$fid}");
    exit();
}
