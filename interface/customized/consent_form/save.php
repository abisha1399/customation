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

$consenttext=$_POST["consenttext"];
$patient=$_POST["patient"];
$ptdate=$_POST["ptdate"];
$staff=$_POST["staff"];
$stdate=$_POST["stdate"];
// print_r($_POST);die;
 
    if ($id && $id != 0) {
    sqlStatement("UPDATE form_consent SET consenttext=?, patient=?, ptdate=?, staff=?, stdate=? WHERE id = ?",
    array($consenttext,$patient,$ptdate,$staff,$stdate,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_consent(pid,encounter,consenttext,patient,ptdate,staff,stdate)VALUES (?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$consenttext,$patient,$ptdate,$staff,$stdate));
    addForm($encounter, "Consent Form", $newid, "consent_form",  $_SESSION["pid"], $userauthorized);
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
