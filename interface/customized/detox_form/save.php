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

// echo "test";
// die;
$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$txt1=$_POST["txt1"];
$txt2=$_POST["txt2"];

$check1=$_POST["check1"];
$check2=$_POST["check2"];
$check3=$_POST["check3"];
$check4=$_POST["check4"];
$check5=$_POST["check5"];
$check6=$_POST["check6"];
$check7=$_POST["check7"];
$check8=$_POST["check8"];
$check9=$_POST["check9"];
$check10=$_POST["check10"];
$check11=$_POST["check11"];
$check12=$_POST["check12"];
$check13=$_POST["check13"];
$check14=$_POST["check14"];
$check15=$_POST["check15"];
$check16=$_POST["check16"];
$check17=$_POST["check17"];
$check18=$_POST["check18"];
$check19=$_POST["check19"];
$check20=$_POST["check20"];
$check21=$_POST["check21"];
$check22=$_POST["check22"];
$check23=$_POST["check23"];
$check24=$_POST["check24"];
$check25=$_POST["check25"];
$check26=$_POST["check26"];
$check27=$_POST["check27"];
$check28=$_POST["check28"];
$check29=$_POST["check29"];
$check30=$_POST["check30"];
$check31=$_POST["check31"];
$check32=$_POST["check32"];
$check33=$_POST["check33"];
$check34=$_POST["check34"];
$check35=$_POST["check35"];
$check36=$_POST["check36"];
$check37=$_POST["check37"];
$check38=$_POST["check38"];
$check39=$_POST["check39"];
$check40=$_POST["check40"];
$check41=$_POST["check41"];
$check42=$_POST["check42"];
$check43=$_POST["check43"];
$check44=$_POST["check44"];
$check45=$_POST["check45"];
$check46=$_POST["check46"];
$check47=$_POST["check47"];
$check48=$_POST["check48"];
$check49=$_POST["check49"];
$check50=$_POST["check50"];
$check51=$_POST["check51"];
$check52=$_POST["check52"];
$check53=$_POST["check53"];
$check54=$_POST["check54"];
$check55=$_POST["check55"];
$check56=$_POST["check56"];
$check57=$_POST["check57"];
$check58=$_POST["check58"];
$check59=$_POST["check59"];
$check60=$_POST["check60"];
$check61=$_POST["check61"];
$check62=$_POST["check62"];
$check63=$_POST["check63"];
$check64=$_POST["check64"];
$check65=$_POST["check65"];
$check66=$_POST["check66"];
$check67=$_POST["check67"];
$check68=$_POST["check68"];
$check69=$_POST["check69"];
$check70=$_POST["check70"];
$check71=$_POST["check71"];
$check72=$_POST["check72"];
$check73=$_POST["check73"];
$check74=$_POST["check74"];
$check75=$_POST["check75"];
$check76=$_POST["check76"];
$check77=$_POST["check77"];

$nsign=$_POST["nsign"];
$date1=$_POST["date1"];
$time1=$_POST["time1"];
$psign=$_POST["psign"];
$date2=$_POST["date2"];
$time2=$_POST["time2"];




if ($id && $id != 0) {
    sqlStatement("UPDATE form_detox SET `pid`= ?, `encounter`= ?, `txt1`= ?, `txt2`= ?, `check1`= ?, `check2`= ?, `check3`= ?, `check4`= ?, `check5`= ?, `check6`= ?, `check7`= ?, `check8`= ?, `check9`= ?, `check10`= ?, `check11`= ?, `check12`= ?, `check13`= ?, `check14`= ?, `check15`= ?, `check16`= ?, `check17`= ?, `check18`= ?, `check19`= ?, `check20`= ?, `check21`= ?, `check22`= ?, `check23`= ?, `check24`= ?, `check25`= ?, `check26`= ?, `check27`= ?, `check28`= ?, `check29`= ?, `check30`= ?, `check31`= ?, `check32`= ?, `check33`= ?, `check34`= ?, `check35`= ?, `check36`= ?, `check37`= ?, `check38`= ?, `check39`= ?, `check40`= ?, `check41`= ?, `check42`= ?, `check43`= ?, `check44`= ?, `check45`= ?, `check46`= ?, `check47`= ?, `check48`= ?, `check49`= ?, `check50`= ?, `check51`= ?, `check52`= ?, `check53`= ?, `check54`= ?, `check55`= ?, `check56`= ?, `check57`= ?, `check58`= ?, `check59`= ?, `check60`= ?, `check61`= ?, `check62`= ?, `check63`= ?, `check64`= ?, `check65`= ?, `check66`= ?, `check67`= ?, `check68`= ?, `check69`= ?, `check70`= ?, `check71`= ?, `check72`= ?, `check73`= ?, `check74`= ?, `check75`= ?, `check76`= ?, `check77`= ?, `nsign`= ?, `date1`= ?, `time1`= ?, `psign`= ?, `date2`= ?, `time2`= ? WHERE id = ?", array($_SESSION["pid"],$_SESSION["encounter"],$txt1,$txt2,$check1,$check2,$check3,$check4,$check5,$check6,$check7,$check8,$check9,$check10,$check11,$check12,$check13,$check14,$check15,$check16,$check17,$check18,$check19,$check20,$check21,$check22,$check23,$check24,$check25,$check26,$check27,$check28,$check29,$check30,$check31,$check32,$check33,$check34,$check35,$check36,$check37,$check38,$check39,$check40,$check41,$check42,$check43,$check44,$check45,$check46,$check47,$check48,$check49,$check50,$check51,$check52,$check53,$check54,$check55,$check56,$check57,$check58,$check59,$check60,$check61,$check62,$check63,$check64,$check65,$check66,$check67,$check68,$check69,$check70,$check71,$check72,$check73,$check74,$check75,$check76,$check77,$nsign,$date1,$time1,$psign,$date2,$time2,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_detox (`pid`, `encounter`, `txt1`, `txt2`, `check1`, `check2`, `check3`, `check4`, `check5`, `check6`, `check7`, `check8`, `check9`, `check10`, `check11`, `check12`, `check13`, `check14`, `check15`, `check16`, `check17`, `check18`, `check19`, `check20`, `check21`, `check22`, `check23`, `check24`, `check25`, `check26`, `check27`, `check28`, `check29`, `check30`, `check31`, `check32`, `check33`, `check34`, `check35`, `check36`, `check37`, `check38`, `check39`, `check40`, `check41`, `check42`, `check43`, `check44`, `check45`, `check46`, `check47`, `check48`, `check49`, `check50`, `check51`, `check52`, `check53`, `check54`, `check55`, `check56`, `check57`, `check58`, `check59`, `check60`, `check61`, `check62`, `check63`, `check64`, `check65`, `check66`, `check67`, `check68`, `check69`, `check70`, `check71`, `check72`, `check73`, `check74`, `check75`, `check76`, `check77`, `nsign`, `date1`, `time1`, `psign`, `date2`, `time2`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$txt1,$txt2,$check1,$check2,$check3,$check4,$check5,$check6,$check7,$check8,$check9,$check10,$check11,$check12,$check13,$check14,$check15,$check16,$check17,$check18,$check19,$check20,$check21,$check22,$check23,$check24,$check25,$check26,$check27,$check28,$check29,$check30,$check31,$check32,$check33,$check34,$check35,$check36,$check37,$check38,$check39,$check40,$check41,$check42,$check43,$check44,$check45,$check46,$check47,$check48,$check49,$check50,$check51,$check52,$check53,$check54,$check55,$check56,$check57,$check58,$check59,$check60,$check61,$check62,$check63,$check64,$check65,$check66,$check67,$check68,$check69,$check70,$check71,$check72,$check73,$check74,$check75,$check76,$check77,$nsign,$date1,$time1,$psign,$date2,$time2));
    addForm($encounter, "Detox form", $newid, "detox_form",  $_SESSION["pid"], $userauthorized);

}





formHeader("Redirecting....");
formJump();
formFooter();