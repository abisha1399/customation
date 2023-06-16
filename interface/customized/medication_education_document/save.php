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
$date=$_POST["date"];
$allergy=$_POST["allergy"];
$date1=$_POST["date1"];
$nursign1=$_POST["nursign1"];
$ptsign1=$_POST["ptsign1"];
$date2=$_POST["date2"];
$nursign2=$_POST["nursign2"];
$ptsign2=$_POST["ptsign2"];
$date3=$_POST["date3"];
$nursign3=$_POST["nursign3"];
$ptsign3=$_POST["ptsign3"];
$date4=$_POST["date4"];
$nursign4=$_POST["nursign4"];
$ptsign4=$_POST["ptsign4"];
$date5=$_POST["date5"];
$nursign5=$_POST["nursign5"];
$ptsign5=$_POST["ptsign5"];
$date6=$_POST["date6"];
$nursign6=$_POST["nursign6"];
$ptsign6=$_POST["ptsign6"];
$date7=$_POST["date7"];
$nursign7=$_POST["nursign7"];
$ptsign7=$_POST["ptsign7"];
$date8=$_POST["date8"];
$nursign8=$_POST["nursign8"];
$ptsign8=$_POST["ptsign8"];
$date9=$_POST["date9"];
$nursign9=$_POST["nursign9"];
$ptsign9=$_POST["ptsign9"];
$date10=$_POST["date10"];
$nursign10=$_POST["nursign10"];
$ptsign10=$_POST["ptsign10"];
$date11=$_POST["date11"];
$nursign11=$_POST["nursign11"];
$ptsign11=$_POST["ptsign11"];
$date12=$_POST["date12"];
$nursign12=$_POST["nursign12"];
$ptsign12=$_POST["ptsign12"];
$date13=$_POST["date13"];
$nursign13=$_POST["nursign13"];
$ptsign13=$_POST["ptsign13"];
$date14=$_POST["date14"];
$nursign14=$_POST["nursign14"];
$ptsign14=$_POST["ptsign14"];
$date15=$_POST["date15"];
$nursign15=$_POST["nursign15"];
$ptsign15=$_POST["ptsign15"];
$date16=$_POST["date16"];
$nursign16=$_POST["nursign16"];
$ptsign16=$_POST["ptsign16"];
$date17=$_POST["date17"];
$nursign17=$_POST["nursign17"];
$ptsign17=$_POST["ptsign17"];
$date18=$_POST["date18"];
$nursign18=$_POST["nursign18"];
$ptsign18=$_POST["ptsign18"];
$date19=$_POST["date19"];
$nursign19=$_POST["nursign19"];
$ptsign19=$_POST["ptsign19"];
$date20=$_POST["date20"];
$nursign20=$_POST["nursign20"];
$ptsign20=$_POST["ptsign20"];
$date21=$_POST["date21"];
$nursign21=$_POST["nursign21"];
$ptsign21=$_POST["ptsign21"];
$date22=$_POST["date22"];
$nursign22=$_POST["nursign22"];
$ptsign22=$_POST["ptsign22"];
$date23=$_POST["date23"];
$nursign23=$_POST["nursign23"];
$ptsign23=$_POST["ptsign23"];
// print_r($ptsign23);die;
    if ($id && $id != 0) {
    sqlStatement("UPDATE form_medication_education_document SET patient=?,date=?,allergy=?,date1=?,nursign1=?,ptsign1=?,date2=?,nursign2=?,ptsign2=?,date3=?,nursign3=?,ptsign3=?,date4=?,nursign4=?,ptsign4=?,date5=?,nursign5=?,ptsign5=?,date6=?,nursign6=?,ptsign6=?,date7=?,nursign7=?,ptsign7=?,date8=?,nursign8=?,ptsign8=?,date9=?,nursign9=?,ptsign9=?,date10=?,nursign10=?,ptsign10=?,date11=?,nursign11=?,ptsign11=?,date12=?,nursign12=?,ptsign12=?,date13=?,nursign13=?,ptsign13=?,date14=?,nursign14=?,ptsign14=?,date15=?,nursign15=?,ptsign15=?,date16=?,nursign16=?,ptsign16=?,date17=?,nursign17=?,ptsign17=?,date18=?,nursign18=?,ptsign18=?,date19=?,nursign19=?,ptsign19=?,date20=?,nursign20=?,ptsign20=?,date21=?,nursign21=?,ptsign21=?,date22=?,nursign22=?,ptsign22=?,date23=?,nursign23=?,ptsign23=? WHERE id = ?",
    array($patient,$date,$allergy,$date1,$nursign1,$ptsign1,$date2,$nursign2,$ptsign2,$date3,$nursign3,$ptsign3,$date4,$nursign4,$ptsign4,$date5,$nursign5,$ptsign5,$date6,$nursign6,$ptsign6,$date7,$nursign7,$ptsign7,$date8,$nursign8,$ptsign8,$date9,$nursign9,$ptsign9,$date10,$nursign10,$ptsign10,$date11,$nursign11,$ptsign11,$date12,$nursign12,$ptsign12,$date13,$nursign13,$ptsign13,$date14,$nursign14,$ptsign14,$date15,$nursign15,$ptsign15,$date16,$nursign16,$ptsign16,$date17,$nursign17,$ptsign17,$date18,$nursign18,$ptsign18,$date19,$nursign19,$ptsign19,$date20,$nursign20,$ptsign20,$date21,$nursign21,$ptsign21,$date22,$nursign22,$ptsign22,$date23,$nursign23,$ptsign23,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_medication_education_document(pid,encounter,patient,date,allergy,date1,nursign1,ptsign1,date2,nursign2,ptsign2,date3,nursign3,ptsign3,date4,nursign4,ptsign4,date5,nursign5,ptsign5,date6,nursign6,ptsign6,date7,nursign7,ptsign7,date8,nursign8,ptsign8,date9,nursign9,ptsign9,date10,nursign10,ptsign10,date11,nursign11,ptsign11,date12,nursign12,ptsign12,date13,nursign13,ptsign13,date14,nursign14,ptsign14,date15,nursign15,ptsign15,date16,nursign16,ptsign16,date17,nursign17,ptsign17,date18,nursign18,ptsign18,date19,nursign19,ptsign19,date20,nursign20,ptsign20,date21,nursign21,ptsign21,date22,nursign22,ptsign22,date23,nursign23,ptsign23)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$patient,$date,$allergy,$date1,$nursign1,$ptsign1,$date2,$nursign2,$ptsign2,$date3,$nursign3,$ptsign3,$date4,$nursign4,$ptsign4,$date5,$nursign5,$ptsign5,$date6,$nursign6,$ptsign6,$date7,$nursign7,$ptsign7,$date8,$nursign8,$ptsign8,$date9,$nursign9,$ptsign9,$date10,$nursign10,$ptsign10,$date11,$nursign11,$ptsign11,$date12,$nursign12,$ptsign12,$date13,$nursign13,$ptsign13,$date14,$nursign14,$ptsign14,$date15,$nursign15,$ptsign15,$date16,$nursign16,$ptsign16,$date17,$nursign17,$ptsign17,$date18,$nursign18,$ptsign18,$date19,$nursign19,$ptsign19,$date20,$nursign20,$ptsign20,$date21,$nursign21,$ptsign21,$date22,$nursign22,$ptsign22,$date23,$nursign23,$ptsign23));
    addForm($encounter, "Medication Education Document", $newid, "medication_education_document",  $_SESSION["pid"], $userauthorized);
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
