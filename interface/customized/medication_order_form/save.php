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
$medication1=$_POST["medication1"];
$indication1=$_POST["indication1"];
$date2=$_POST["date2"];
$medication2=$_POST["medication2"];
$indication2=$_POST["indication2"];
$date3=$_POST["date3"];
$medication3=$_POST["medication3"];
$indication3=$_POST["indication3"];
$date4=$_POST["date4"];
$medication4=$_POST["medication4"];
$indication4=$_POST["indication4"];
$date5=$_POST["date5"];
$medication5=$_POST["medication5"];
$indication5=$_POST["indication5"];
$date6=$_POST["date6"];
$medication6=$_POST["medication6"];
$indication6=$_POST["indication6"];
$date7=$_POST["date7"];
$medication7=$_POST["medication7"];
$indication7=$_POST["indication7"];
$date8=$_POST["date8"];
$medication8=$_POST["medication8"];
$indication8=$_POST["indication8"];
$date9=$_POST["date9"];
$medication9=$_POST["medication9"];
$indication9=$_POST["indication9"];
$date10=$_POST["date10"];
$medication10=$_POST["medication10"];
$indication10=$_POST["indication10"];
$date11=$_POST["date11"];
$medication11=$_POST["medication11"];
$indication11=$_POST["indication11"];
$date12=$_POST["date12"];
$medication12=$_POST["medication12"];
$indication12=$_POST["indication12"];
$date13=$_POST["date13"];
$medication13=$_POST["medication13"];
$indication13=$_POST["indication13"];
$date14=$_POST["date14"];
$medication14=$_POST["medication14"];
$indication14=$_POST["indication14"];
$date15=$_POST["date15"];
$medication15=$_POST["medication15"];
$indication15=$_POST["indication15"];
$date16=$_POST["date16"];
$medication16=$_POST["medication16"];
$indication16=$_POST["indication16"];
$date17=$_POST["date17"];
$medication17=$_POST["medication17"];
$indication17=$_POST["indication17"];
$date18=$_POST["date18"];
$medication18=$_POST["medication18"];
$indication18=$_POST["indication18"];
$date19=$_POST["date19"];
$medication19=$_POST["medication19"];
$indication19=$_POST["indication19"];
$date20=$_POST["date20"];
$medication20=$_POST["medication20"];
$indication20=$_POST["indication20"];
$date21=$_POST["date21"];
$medication21=$_POST["medication21"];
$indication21=$_POST["indication21"];
$date22=$_POST["date22"];
$medication22=$_POST["medication22"];
$indication22=$_POST["indication22"];
$date23=$_POST["date23"];
$medication23=$_POST["medication23"];
$indication23=$_POST["indication23"];
$date24=$_POST["date24"];
$medication24=$_POST["medication24"];
$indication24=$_POST["indication24"];
$date25=$_POST["date25"];
$medication25=$_POST["medication25"];
$indication25=$_POST["indication25"];
$date26=$_POST["date26"];
$medication26=$_POST["medication26"];
$indication26=$_POST["indication26"];
$date27=$_POST["date27"];
$medication27=$_POST["medication27"];
$indication27=$_POST["indication27"];
$date28=$_POST["date28"];
$medication28=$_POST["medication28"];
$indication28=$_POST["indication28"];
$date29=$_POST["date29"];
$medication29=$_POST["medication29"];
$indication29=$_POST["indication29"];
$date30=$_POST["date30"];
$medication30=$_POST["medication30"];
$indication30=$_POST["indication30"];
$date31=$_POST["date31"];
$medication31=$_POST["medication31"];
$indication31=$_POST["indication31"];
$date32=$_POST["date32"];
$medication32=$_POST["medication32"];
$indication32=$_POST["indication32"];
$date33=$_POST["date33"];
$medication33=$_POST["medication33"];
$indication33=$_POST["indication33"];
$date34=$_POST["date34"];
$medication34=$_POST["medication34"];
$indication34=$_POST["indication34"];
$date35=$_POST["date35"];
$medication35=$_POST["medication35"];
$indication35=$_POST["indication35"];
$date36=$_POST["date36"];
$medication36=$_POST["medication36"];
$indication36=$_POST["indication36"];
$date37=$_POST["date37"];
$medication37=$_POST["medication37"];
$indication37=$_POST["indication37"];
// print_r($indication37);die;
    if ($id && $id != 0) {
    sqlStatement("UPDATE form_medication_order SET patient=?,date=?,allergy=?,date1=?,medication1=?,indication1=?,date2=?,medication2=?,indication2=?,date3=?,medication3=?,indication3=?,date4=?,medication4=?,indication4=?,date5=?,medication5=?,indication5=?,date6=?,medication6=?,indication6=?,date7=?,medication7=?,indication7=?,date8=?,medication8=?,indication8=?,date9=?,medication9=?,indication9=?,date10=?,medication10=?,indication10=?,date11=?,medication11=?,indication11=?,date12=?,medication12=?,indication12=?,date13=?,medication13=?,indication13=?,date14=?,medication14=?,indication14=?,date15=?,medication15=?,indication15=?,date16=?,medication16=?,indication16=?,date17=?,medication17=?,indication17=?,date18=?,medication18=?,indication18=?,date19=?,medication19=?,indication19=?,date20=?,medication20=?,indication20=?,date21=?,medication21=?,indication21=?,date22=?,medication22=?,indication22=?,date23=?,medication23=?,indication23=?,date24=?,medication24=?,indication24=?,date25=?,medication25=?,indication25=?,date26=?,medication26=?,indication26=?,date27=?,medication27=?,indication27=?,date28=?,medication28=?,indication28=?,date29=?,medication29=?,indication29=?,date30=?,medication30=?,indication30=?,date31=?,medication31=?,indication31=?,date32=?,medication32=?,indication32=?,date33=?,medication33=?,indication33=?,date34=?,medication34=?,indication34=?,date35=?,medication35=?,indication35=?,date36=?,medication36=?,indication36=?,date37=?,medication37=?,indication37=? WHERE id = ?",
    array($patient,$date,$allergy,$date1,$medication1,$indication1,$date2,$medication2,$indication2,$date3,$medication3,$indication3,$date4,$medication4,$indication4,$date5,$medication5,$indication5,$date6,$medication6,$indication6,$date7,$medication7,$indication7,$date8,$medication8,$indication8,$date9,$medication9,$indication9,$date10,$medication10,$indication10,$date11,$medication11,$indication11,$date12,$medication12,$indication12,$date13,$medication13,$indication13,$date14,$medication14,$indication14,$date15,$medication15,$indication15,$date16,$medication16,$indication16,$date17,$medication17,$indication17,$date18,$medication18,$indication18,$date19,$medication19,$indication19,$date20,$medication20,$indication20,$date21,$medication21,$indication21,$date22,$medication22,$indication22,$date23,$medication23,$indication23,$date24,$medication24,$indication24,$date25,$medication25,$indication25,$date26,$medication26,$indication26,$date27,$medication27,$indication27,$date28,$medication28,$indication28,$date29,$medication29,$indication29,$date30,$medication30,$indication30,$date31,$medication31,$indication31,$date32,$medication32,$indication32,$date33,$medication33,$indication33,$date34,$medication34,$indication34,$date35,$medication35,$indication35,$date36,$medication36,$indication36,$date37,$medication37,$indication37,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_medication_order(pid,encounter,patient,date,allergy,date1,medication1,indication1,date2,medication2,indication2,date3,medication3,indication3,date4,medication4,indication4,date5,medication5,indication5,date6,medication6,indication6,date7,medication7,indication7,date8,medication8,indication8,date9,medication9,indication9,date10,medication10,indication10,date11,medication11,indication11,date12,medication12,indication12,date13,medication13,indication13,date14,medication14,indication14,date15,medication15,indication15,date16,medication16,indication16,date17,medication17,indication17,date18,medication18,indication18,date19,medication19,indication19,date20,medication20,indication20,date21,medication21,indication21,date22,medication22,indication22,date23,medication23,indication23,date24,medication24,indication24,date25,medication25,indication25,date26,medication26,indication26,date27,medication27,indication27,date28,medication28,indication28,date29,medication29,indication29,date30,medication30,indication30,date31,medication31,indication31,date32,medication32,indication32,date33,medication33,indication33,date34,medication34,indication34,date35,medication35,indication35,date36,medication36,indication36,date37,medication37,indication37)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$patient,$date,$allergy,$date1,$medication1,$indication1,$date2,$medication2,$indication2,$date3,$medication3,$indication3,$date4,$medication4,$indication4,$date5,$medication5,$indication5,$date6,$medication6,$indication6,$date7,$medication7,$indication7,$date8,$medication8,$indication8,$date9,$medication9,$indication9,$date10,$medication10,$indication10,$date11,$medication11,$indication11,$date12,$medication12,$indication12,$date13,$medication13,$indication13,$date14,$medication14,$indication14,$date15,$medication15,$indication15,$date16,$medication16,$indication16,$date17,$medication17,$indication17,$date18,$medication18,$indication18,$date19,$medication19,$indication19,$date20,$medication20,$indication20,$date21,$medication21,$indication21,$date22,$medication22,$indication22,$date23,$medication23,$indication23,$date24,$medication24,$indication24,$date25,$medication25,$indication25,$date26,$medication26,$indication26,$date27,$medication27,$indication27,$date28,$medication28,$indication28,$date29,$medication29,$indication29,$date30,$medication30,$indication30,$date31,$medication31,$indication31,$date32,$medication32,$indication32,$date33,$medication33,$indication33,$date34,$medication34,$indication34,$date35,$medication35,$indication35,$date36,$medication36,$indication36,$date37,$medication37,$indication37));
    addForm($encounter, "Medication Order Form", $newid, "medication_order_form",  $_SESSION["pid"], $userauthorized);
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
