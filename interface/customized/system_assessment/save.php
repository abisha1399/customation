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
// echo "<pre>";print_r($_POST);
// die;
$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$check1=$_POST["check1"];
$check2=$_POST["check2"];
$check3=$_POST["check3"];
$check4=$_POST["check4"];
$check5=$_POST["check5"];
$check6=$_POST["check6"];
$check7=$_POST["check7"];
$inp1=$_POST["inp1"];
$inp2=$_POST["inp2"];
$check8=$_POST["check8"];
$check9=$_POST["check9"];
$check10=$_POST["check10"];
$check11=$_POST["check11"];
$inp3=$_POST["inp3"];
$check12=$_POST["check12"];
$check13=$_POST["check13"];
$check14=$_POST["check14"];
$check15=$_POST["check15"];
$check16=$_POST["check16"];
$check17=$_POST["check17"];
$inp4=$_POST["inp4"];
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
$check37a=$_POST["check37a"];
$check38=$_POST["check38"];
$check39=$_POST["check39"];
$check40=$_POST["check40"];
$check41=$_POST["check41"];
$check42=$_POST["check42"];
$inp5=$_POST["inp5"];
$systext=$_POST["systext"];
$systext1=$_POST["systext1"];






if ($id && $id != 0) {
    sqlStatement("UPDATE form_system_assessment SET `pid`= ?, `encounter`= ?,`check1`= ?, `check2`= ?, `check3`= ?, `check4`= ?, `check5`= ?, `check6`= ?, `check7`= ?, `inp1`= ?, `inp2`= ?, `check8`= ?, `check9`= ?, `check10`= ?, `check11`= ?, `inp3`= ?, `check12`= ?, `check13`= ?, `check14`= ?, `check15`= ?, `check16`= ?, `check17`= ?, `inp4`= ?, `check18`= ?, `check19`= ?, `check20`= ?, `check21`= ?, `check22`= ?, `check23`= ?, `check24`= ?, `check25`= ?, `check26`= ?, `check27`= ?, `check28`= ?, `check29`= ?, `check30`= ?, `check31`= ?, `check32`= ?, `check33`= ?, `check34`= ?, `check35`= ?, `check36`= ?, `check37`= ?, `check37a` = ?,`check38`= ?, `check39`= ?, `check40`= ?, `check41`= ?, `check42`= ?, `inp5`= ?,`systext`=?,`systext1`=? WHERE id = ?", array($_SESSION["pid"],$_SESSION["encounter"],$check1,$check2,$check3,$check4,$check5,$check6,$check7,$inp1,$inp2,$check8,$check9,$check10,$check11,$inp3,$check12,$check13,$check14,$check15,$check16,$check17,$inp4,$check18,$check19,$check20,$check21,$check22,$check23,$check24,$check25,$check26,$check27,$check28,$check29,$check30,$check31,$check32,$check33,$check34,$check35,$check36,$check37,$check37a,$check38,$check39,$check40,$check41,$check42,$inp5,$systext,$systext1,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_system_assessment (`pid`, `encounter`, `check1`, `check2`, `check3`, `check4`, `check5`, `check6`, `check7`, `inp1`, `inp2`, `check8`, `check9`, `check10`, `check11`, `inp3`, `check12`, `check13`, `check14`, `check15`, `check16`, `check17`, `inp4`, `check18`, `check19`, `check20`, `check21`, `check22`, `check23`, `check24`, `check25`, `check26`, `check27`, `check28`, `check29`, `check30`, `check31`, `check32`, `check33`, `check34`, `check35`, `check36`, `check37`, `check37a`, `check38`, `check39`, `check40`, `check41`, `check42`, `inp5`,`systext`,`systext1`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$check1,$check2,$check3,$check4,$check5,$check6,$check7,$inp1,$inp2,$check8,$check9,$check10,$check11,$inp3,$check12,$check13,$check14,$check15,$check16,$check17,$inp4,$check18,$check19,$check20,$check21,$check22,$check23,$check24,$check25,$check26,$check27,$check28,$check29,$check30,$check31,$check32,$check33,$check34,$check35,$check36,$check37,$check37a,$check38,$check39,$check40,$check41,$check42,$inp5,$systext,$systext1));
    addForm($encounter, "System Assessment form", $newid, "system_assessment",  $_SESSION["pid"], $userauthorized);

}

formHeader("Redirecting....");
formJump();
formFooter();