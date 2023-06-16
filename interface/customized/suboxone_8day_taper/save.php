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

$patient=$_POST["patient"];
$dob=$_POST["dob"];
$allergy=$_POST["allergy"];
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
$ptsign9=$_POST["ptsign9"];
$date4=$_POST["date4"];
$ptsign10=$_POST["ptsign10"];
$ptsign11=$_POST["ptsign11"];
$ptsign12=$_POST["ptsign12"];
$date5=$_POST["date5"];
$ptsign13=$_POST["ptsign13"];
$ptsign14=$_POST["ptsign14"];
$orderdate=$_POST["orderdate"];
$nurse=$_POST["nurse"];
$ptsign=$_POST["ptsign"];
$ptinitial=$_POST["ptinitial"];
$nursever=$_POST["nursever"];
$nursign=$_POST["nursign"];
$nurinitial=$_POST["nurinitial"];
$nursign1=$_POST["nursign1"];
$nurinitial1=$_POST["nurinitial1"];
$nursign2=$_POST["nursign2"];
$nurinitial2=$_POST["nurinitial2"];
$patient1=$_POST["patient1"];
$dob1=$_POST["dob1"];
$allergy1=$_POST["allergy1"];
$date6=$_POST["date6"];
$ptsign15=$_POST["ptsign15"];
$ptsign16=$_POST["ptsign16"];
$date7=$_POST["date7"];
$ptsign17=$_POST["ptsign17"];
$ptsign18=$_POST["ptsign18"];
$date8=$_POST["date8"];
$ptsign19=$_POST["ptsign19"];
$orderdate1=$_POST["orderdate1"];
$nurse1=$_POST["nurse1"];
$patsign=$_POST["patsign"];
$patinitial=$_POST["patinitial"];
$nursever1=$_POST["nursever1"];
$nursign3=$_POST["nursign3"];
$nurinitial3=$_POST["nurinitial3"];
$nursign4=$_POST["nursign4"];
$nurinitial4=$_POST["nurinitial4"];
$nursign5=$_POST["nursign5"];
$nurinitial5=$_POST["nurinitial5"];

// echo $nurinitial5;die;

    if ($id && $id != 0) {
    sqlStatement("UPDATE form_suboxone_8day_taper SET patient=?,dob=?,allergy=?,date1=?,ptsign1=?,ptsign2=?,ptsign3=?,date2=?,ptsign4=?,ptsign5=?,ptsign6=?,date3=?,ptsign7=?,ptsign8=?,ptsign9=?,date4=?,ptsign10=?,ptsign11=?,ptsign12=?,date5=?,ptsign13=?,ptsign14=?,orderdate=?,nurse=?,nursever=?,ptsign=?,ptinitial=?,nursign=?,nurinitial=?,nursign1=?,nurinitial1=?,nursign2=?,nurinitial2=?,patient1=?,dob1=?,allergy1=?,date6=?,ptsign15=?,ptsign16=?,date7=?,ptsign17=?,ptsign18=?,date8=?,ptsign19=?,orderdate1=?,nurse1=?,nursever1=?,patsign=?,patinitial=?,nursign3=?,nurinitial3=?,nursign4=?,nurinitial4=?,nursign5=?,nurinitial5=? WHERE id = ?",
    array($patient,$dob,$allergy,$date1,$ptsign1,$ptsign2,$ptsign3,$date2,$ptsign4,$ptsign5,$ptsign6,$date3,$ptsign7,$ptsign8,$ptsign9,$date4,$ptsign10,$ptsign11,$ptsign12,$date5,$ptsign13,$ptsign14,$orderdate,$nurse,$nursever,$ptsign,$ptinitial,$nursign,$nurinitial,$nursign1,$nurinitial1,$nursign2,$nurinitial2,$patient1,$dob1,$allergy1,$date6,$ptsign15,$ptsign16,$date7,$ptsign17,$ptsign18,$date8,$ptsign19,$orderdate1,$nurse1,$nursever1,$patsign,$patinitial,$nursign3,$nurinitial3,$nursign4,$nurinitial4,$nursign5,$nurinitial5,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_suboxone_8day_taper(pid,encounter,patient,dob,allergy,date1,ptsign1,ptsign2,ptsign3,date2,ptsign4,ptsign5,ptsign6,date3,ptsign7,ptsign8,ptsign9,date4,ptsign10,ptsign11,ptsign12,date5,ptsign13,ptsign14,orderdate,nurse,nursever,ptsign,ptinitial,nursign,nurinitial,nursign1,nurinitial1,nursign2,nurinitial2,patient1,dob1,allergy1,date6,ptsign15,ptsign16,date7,ptsign17,ptsign18,date8,ptsign19,orderdate1,nurse1,nursever1,patsign,patinitial,nursign3,nurinitial3,nursign4,nurinitial4,nursign5,nurinitial5)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$patient,$dob,$allergy,$date1,$ptsign1,$ptsign2,$ptsign3,$date2,$ptsign4,$ptsign5,$ptsign6,$date3,$ptsign7,$ptsign8,$ptsign9,$date4,$ptsign10,$ptsign11,$ptsign12,$date5,$ptsign13,$ptsign14,$orderdate,$nurse,$nursever,$ptsign,$ptinitial,$nursign,$nurinitial,$nursign1,$nurinitial1,$nursign2,$nurinitial2,$patient1,$dob1,$allergy1,$date6,$ptsign15,$ptsign16,$date7,$ptsign17,$ptsign18,$date8,$ptsign19,$orderdate1,$nurse1,$nursever1,$patsign,$patinitial,$nursign3,$nurinitial3,$nursign4,$nurinitial4,$nursign5,$nurinitial5));
    addForm($encounter, "Suboxone 8 day Taper/Heroin", $newid, "suboxone_8day_taper",  $_SESSION["pid"], $userauthorized);
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
