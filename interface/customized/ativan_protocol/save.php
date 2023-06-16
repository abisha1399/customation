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

$allergy=$_POST["allergy"];
$patient=$_POST["patient"];
$dob=$_POST["dob"];
$date1=$_POST["date1"];
$ptsign1=$_POST["ptsign1"];
$ptsign2=$_POST["ptsign2"];
$ptsign3=$_POST["ptsign3"];
$date2=$_POST["date2"];
$ptsign4=$_POST["ptsign4"];
$ptsign5=$_POST["ptsign5"];
$ptsign6=$_POST["ptsign6"];
$date3=$_POST["date3"];
$ptsign7=$_POST["ptsign7"];
$ptsign8=$_POST["ptsign8"];
$date4=$_POST["date4"];
$ptsign9=$_POST["ptsign9"];
$ptsign10=$_POST["ptsign10"];
$date5=$_POST["date5"];
$ptsign11=$_POST["ptsign11"];
$prn1=$_POST["prn1"];
$prn2=$_POST["prn2"];
$prn3=$_POST["prn3"];
$prn4=$_POST["prn4"];
$prn5=$_POST["prn5"];
$prn6=$_POST["prn6"];
$orderdate=$_POST["orderdate"];
$ptsign=$_POST["ptsign"];
$ptinitial=$_POST["ptinitial"];
$nurse=$_POST["nurse"];
$nursign=$_POST["nursign"];
$nurinitial=$_POST["nurinitial"];
$nursever=$_POST["nursever"];
$nursign1=$_POST["nursign1"];
$nurinitial1=$_POST["nurinitial1"];
$nursign2=$_POST["nursign2"];
$nurinitial2=$_POST["nurinitial2"];
// print_r($_POST);die;

    if ($id && $id != 0) {
    sqlStatement("UPDATE form_ativan_protocol SET allergy=?,patient=?,dob=?,date1=?,ptsign1=?,ptsign2=?,ptsign3=?,date2=?,ptsign4=?,ptsign5=?,ptsign6=?,date3=?,ptsign7=?,ptsign8=?,date4=?,ptsign9=?,ptsign10=?,date5=?,ptsign11=?,prn1=?,prn2=?,prn3=?,prn4=?,prn5=?,prn6=?,orderdate=?,ptsign=?,ptinitial=?,nurse=?,nursign=?,nurinitial=?,nursever=?,nursign1=?,nurinitial1=?,nursign2=?,nurinitial2=? WHERE id = ?",
    array($allergy,$patient,$dob,$date1,$ptsign1,$ptsign2,$ptsign3,$date2,$ptsign4,$ptsign5,$ptsign6,$date3,$ptsign7,$ptsign8,$date4,$ptsign9,$ptsign10,$date5,$ptsign11,$prn1,$prn2,$prn3,$prn4,$prn5,$prn6,$orderdate,$ptsign,$ptinitial,$nurse,$nursign,$nurinitial,$nursever,$nursign1,$nurinitial1,$nursign2,$nurinitial2,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_ativan_protocol(pid,encounter,allergy,patient,dob,date1,ptsign1,ptsign2,ptsign3,date2,ptsign4,ptsign5,ptsign6,date3,ptsign7,ptsign8,date4,ptsign9,ptsign10,date5,ptsign11,prn1,prn2,prn3,prn4,prn5,prn6,orderdate,ptsign,ptinitial,nurse,nursign,nurinitial,nursever,nursign1,nurinitial1,nursign2,nurinitial2)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$allergy,$patient,$dob,$date1,$ptsign1,$ptsign2,$ptsign3,$date2,$ptsign4,$ptsign5,$ptsign6,$date3,$ptsign7,$ptsign8,$date4,$ptsign9,$ptsign10,$date5,$ptsign11,$prn1,$prn2,$prn3,$prn4,$prn5,$prn6,$orderdate,$ptsign,$ptinitial,$nurse,$nursign,$nurinitial,$nursever,$nursign1,$nurinitial1,$nursign2,$nurinitial2));
    addForm($encounter, "Ativan Protocol B", $newid, "ativan_protocol",  $_SESSION["pid"], $userauthorized);
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
