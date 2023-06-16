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

$fax = $_POST["fax"];
$name = $_POST["name"];
$num = $_POST["num"];
$prov = $_POST["prov"];
$service = $_POST["service"];
$first = $_POST["first"];
$second = $_POST["second"];
$check1 = $_POST["check1"];
$check2 = $_POST["check2"];
$check3 = $_POST["check3"];
$check4 = $_POST["check4"];
$check5 = $_POST["check5"];
$check6 = $_POST["check6"];
$check7 = $_POST["check7"];
$check8 = $_POST["check8"];
$check9 = $_POST["check9"];
$check10 = $_POST["check10"];
$check11 = $_POST["check11"];
$check12 = $_POST["check12"];
$check13 = $_POST["check13"];
$check14 = $_POST["check14"];
$check15= $_POST["check15"];
$check16= $_POST["check16"];
$check17 = $_POST["check17"];
$check18 = $_POST["check18"];
$check19 = $_POST["check19"];
$check20 = $_POST["check20"];
$check21 = $_POST["check21"];
$sign = $_POST["sign"];
$date = $_POST["date"];
$print = $_POST["print"];
$auth=$_POST['auth'];


if ($id && $id != 0) {
    sqlStatement("UPDATE form_authorized_representative SET fax =?, name=?, num=?, prov=?, service=?, 
    first=?, second=?, 
    check1=?,
    check2=?,
    check3=?,
    check4=?,
    check5=?,
    check6=?,
    check7=?,
    check8=?,
    check9=?,
    check10=?,
    check11=?,
    check12=?,
    check13=?,
    check14=?,
    check15=?,
    check16=?,
    check17=?,
    check18=?,
    check19=?,
    check20=?,
    check21=?,sign=?,date=?,print=?,auth=? WHERE id = ?", 
    array($fax,
    $name, 
    $num ,
    $prov, 
    $service,
    $first,
    $second,
    $check1, 
    $check2, 
    $check3, 
    $check4, 
    $check5, 
    $check6, 
    $check7, 
    $check8, 
    $check9, 
    $check10,
    $check11,
    $check12,
    $check13,
    $check14,
    $check15,
    $check16,
    $check17,
    $check18,
    $check19,
    $check20,
    $check21,$sign,$date,$print,$auth, $id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_authorized_representative
     (pid,encounter,fax,name,num,prov,service,first,second,
        check1,
        check2,
        check3,
        check4,
        check5,
        check6,
        check7,
        check8,
        check9,
        check10,
        check11,
        check12,
        check13,
        check14,
        check15,
        check16,
        check17,
        check18,
        check19,
        check20,
        check21,
        sign,date,print,auth)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$fax,$name, 
    $num ,
    $prov, 
    $service,
    $first,
    $second,
    $check1, 
    $check2, 
    $check3, 
    $check4, 
    $check5, 
    $check6, 
    $check7, 
    $check8, 
    $check9, 
    $check10,
    $check11,
    $check12,
    $check13,
    $check14,
    $check15,
    $check16,
    $check17,
    $check18,
    $check19,
    $check20,
    $check21,$sign,$date,$print,$auth));
    addForm($encounter, "Authorized Representative Request", $newid, "authorized_representative_request",  $_SESSION["pid"], $userauthorized);
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

