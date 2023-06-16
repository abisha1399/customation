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
$date2=$_POST["date2"];
$ptsign2=$_POST["ptsign2"];
$date3=$_POST["date3"];
$ptsign3=$_POST["ptsign3"];
$date4=$_POST["date4"];
$ptsign4=$_POST["ptsign4"];
$date5=$_POST["date5"];
$ptsign5=$_POST["ptsign5"];
$date6=$_POST["date6"];
$ptsign6=$_POST["ptsign6"];
$date7=$_POST["date7"];
$ptsign7=$_POST["ptsign7"];
$date8=$_POST["date8"];
$ptsign8=$_POST["ptsign8"];
$date9=$_POST["date9"];
$ptsign9=$_POST["ptsign9"];
$date10=$_POST["date10"];
$ptsign10=$_POST["ptsign10"];
$date11=$_POST["date11"];
$ptsign11=$_POST["ptsign11"];
$pttext1=$_POST["pttext1"];
$pttext2=$_POST["pttext2"];
$pttext3=$_POST["pttext3"];
$pttext4=$_POST["pttext4"];
$pttext5=$_POST["pttext5"];
$pttext6=$_POST["pttext6"];
$pttext7=$_POST["pttext7"];
$pttext8=$_POST["pttext8"];
$pttext9=$_POST["pttext9"];
$pttext10=$_POST["pttext10"];
$pttext11=$_POST["pttext11"];
$pttext12=$_POST["pttext12"];
$date12=$_POST["date12"];
$ptsign12=$_POST["ptsign12"];
$date13=$_POST["date13"];
$ptsign13=$_POST["ptsign13"];
$date14=$_POST["date14"];
$ptsign14=$_POST["ptsign14"];
$date15=$_POST["date15"];
$ptsign15=$_POST["ptsign15"];
$date16=$_POST["date16"];
$ptsign16=$_POST["ptsign16"];
$date17=$_POST["date17"];
$ptsign17=$_POST["ptsign17"];
$date18=$_POST["date18"];
$ptsign18=$_POST["ptsign18"];
$date19=$_POST["date19"];
$ptsign19=$_POST["ptsign19"];
$date20=$_POST["date20"];
$ptsign20=$_POST["ptsign20"];
$date21=$_POST["date21"];
$ptsign21=$_POST["ptsign21"];
$orderdate=$_POST["orderdate"];
$nurse=$_POST["nurse"];
$nursever=$_POST["nursever"];
$ptsign=$_POST["ptsign"];
$ptinitial=$_POST["ptinitial"];
$nursign=$_POST["nursign"];
$nurinitial=$_POST["nurinitial"];
$nursign1=$_POST["nursign1"];
$nurinitial1=$_POST["nurinitial1"];
$nursign2=$_POST["nursign2"];
$nurinitial2=$_POST["nurinitial2"];
$nursign3=$_POST["nursign3"];
$nurinitial3=$_POST["nurinitial3"];
// echo $nurinitial3;die;

    if ($id && $id != 0) {
    sqlStatement("UPDATE form_daily_medication SET patient=?,dob=?,allergy=?,date1=?,ptsign1=?,date2=?,ptsign2=?,date3=?,ptsign3=?,date4=?,ptsign4=?,date5=?,ptsign5=?,date6=?,ptsign6=?,date7=?,ptsign7=?,date8=?,ptsign8=?,date9=?,ptsign9=?,date10=?,ptsign10=?,date11=?,ptsign11=?,pttext1=?,pttext2=?,pttext3=?,pttext4=?,pttext5=?,pttext6=?,pttext7=?,pttext8=?,pttext9=?,pttext10=?,pttext11=?,pttext12=?,date12=?,ptsign12=?,date13=?,ptsign13=?,date14=?,ptsign14=?,date15=?,ptsign15=?,date16=?,ptsign16=?,date17=?,ptsign17=?,date18=?,ptsign18=?,date19=?,ptsign19=?,date20=?,ptsign20=?,date21=?,ptsign21=?,orderdate=?,nurse=?,nursever=?,ptsign=?,ptinitial=?,nursign=?,nurinitial=?,nursign1=?,nurinitial1=?,nursign2=?,nurinitial2=?,nursign3=?,nurinitial3=? WHERE id = ?",
    array($patient,$dob,$allergy,$date1,$ptsign1,$date2,$ptsign2,$date3,$ptsign3,$date4,$ptsign4,$date5,$ptsign5,$date6,$ptsign6,$date7,$ptsign7,$date8,$ptsign8,$date9,$ptsign9,$date10,$ptsign10,$date11,$ptsign11,$pttext1,$pttext2,$pttext3,$pttext4,$pttext5,$pttext6,$pttext7,$pttext8,$pttext9,$pttext10,$pttext11,$pttext12,$date12,$ptsign12,$date13,$ptsign13,$date14,$ptsign14,$date15,$ptsign15,$date16,$ptsign16,$date17,$ptsign17,$date18,$ptsign18,$date19,$ptsign19,$date20,$ptsign20,$date21,$ptsign21,$orderdate,$nurse,$nursever,$ptsign,$ptinitial,$nursign,$nurinitial,$nursign1,$nurinitial1,$nursign2,$nurinitial2,$nursign3,$nurinitial3,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_daily_medication(pid,encounter,patient,dob,allergy,date1,ptsign1,date2,ptsign2,date3,ptsign3,date4,ptsign4,date5,ptsign5,date6,ptsign6,date7,ptsign7,date8,ptsign8,date9,ptsign9,date10,ptsign10,date11,ptsign11,pttext1,pttext2,pttext3,pttext4,pttext5,pttext6,pttext7,pttext8,pttext9,pttext10,pttext11,pttext12,date12,ptsign12,date13,ptsign13,date14,ptsign14,date15,ptsign15,date16,ptsign16,date17,ptsign17,date18,ptsign18,date19,ptsign19,date20,ptsign20,date21,ptsign21,orderdate,nurse,nursever,ptsign,ptinitial,nursign,nurinitial,nursign1,nurinitial1,nursign2,nurinitial2,nursign3,nurinitial3)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$patient,$dob,$allergy,$date1,$ptsign1,$date2,$ptsign2,$date3,$ptsign3,$date4,$ptsign4,$date5,$ptsign5,$date6,$ptsign6,$date7,$ptsign7,$date8,$ptsign8,$date9,$ptsign9,$date10,$ptsign10,$date11,$ptsign11,$pttext1,$pttext2,$pttext3,$pttext4,$pttext5,$pttext6,$pttext7,$pttext8,$pttext9,$pttext10,$pttext11,$pttext12,$date12,$ptsign12,$date13,$ptsign13,$date14,$ptsign14,$date15,$ptsign15,$date16,$ptsign16,$date17,$ptsign17,$date18,$ptsign18,$date19,$ptsign19,$date20,$ptsign20,$date21,$ptsign21,$orderdate,$nurse,$nursever,$ptsign,$ptinitial,$nursign,$nurinitial,$nursign1,$nurinitial1,$nursign2,$nurinitial2,$nursign3,$nurinitial3));
    addForm($encounter, "Daily Medication", $newid, "daily_medication",  $_SESSION["pid"], $userauthorized);
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
