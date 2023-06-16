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

$inp1=$_POST['inp1'];
$inp2=$_POST['inp2'];
$inp3=$_POST['inp3'];
$inp4=$_POST['inp4'];
$inp5=$_POST['inp5'];
$inp6=$_POST['inp6'];
$inp7=$_POST['inp7'];
$inp8=$_POST['inp8'];
$inp9=$_POST['inp9'];
$inp10=$_POST['inp10'];
$inp11=$_POST['inp11'];
$inp12=$_POST['inp12'];
$inp13=$_POST['inp13'];
$inp14=$_POST['inp14'];
$inp15=$_POST['inp15'];
$inp16=$_POST['inp16'];
$inp17=$_POST['inp17'];
$inp18=$_POST['inp18'];
$inp19=$_POST['inp19'];
$inp20=$_POST['inp20'];
$inp21=$_POST['inp21'];
$inp22=$_POST['inp22'];
$inp23=$_POST['inp23'];
$inp24=$_POST['inp24'];
$inp25=$_POST['inp25'];
$inp26=$_POST['inp26'];
$inp27=$_POST['inp27'];
$inp28=$_POST['inp28'];
$inp29=$_POST['inp29'];
$inp30=$_POST['inp30'];
$inp31=$_POST['inp31'];
$inp32=$_POST['inp32'];
$inp33=$_POST['inp33'];
$inp34=$_POST['inp34'];
$inp35=$_POST['inp35'];
$inp36=$_POST['inp36'];
$inp37=$_POST['inp37'];
$inp38=$_POST['inp38'];
$inp39=$_POST['inp39'];


if ($id && $id != 0) {
    sqlStatement("UPDATE form_clonidine SET `pid`= ?, `encounter`= ?, `inp1`= ?,`inp2`= ?,`inp3`= ?,`inp4`= ?,`inp5`= ?,`inp6`= ?,`inp7`= ?,`inp8`= ?,`inp9`= ?,`inp10`= ?,`inp11`= ?,`inp12`= ?,`inp13`= ?,`inp14`= ?,`inp15`= ?,`inp16`= ?,`inp17`= ?,`inp18`= ?,`inp19`= ?,`inp20`= ?,`inp21`= ?,`inp22`= ?,`inp23`= ?,`inp24`= ?,`inp25`= ?,`inp26`= ?,`inp27`= ?,`inp28`= ?,`inp29`= ?,`inp30`= ?,`inp31`= ?,`inp32`= ?,`inp33`= ?,`inp34`= ?,`inp35`= ?,`inp36`= ?,`inp37`= ?,`inp38`= ?,`inp39`= ? WHERE id = ?", array($_SESSION["pid"],$_SESSION["encounter"],$inp1,$inp2,$inp3,$inp4,$inp5,$inp6,$inp7,$inp8,$inp9,$inp10,$inp11,$inp12,$inp13,$inp14,$inp15,$inp16,$inp17,$inp18,$inp19,$inp20,$inp21,$inp22,$inp23,$inp24,$inp25,$inp26,$inp27,$inp28,$inp29,$inp30,$inp31,$inp32,$inp33,$inp34,$inp35,$inp36,$inp37,$inp38,$inp39,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_clonidine (`pid`, `encounter`, `inp1`,`inp2`,`inp3`,`inp4`,`inp5`,`inp6`,`inp7`,`inp8`,`inp9`,`inp10`,`inp11`,`inp12`,`inp13`,`inp14`,`inp15`,`inp16`,`inp17`,`inp18`,`inp19`,`inp20`,`inp21`,`inp22`,`inp23`,`inp24`,`inp25`,`inp26`,`inp27`,`inp28`,`inp29`,`inp30`,`inp31`,`inp32`,`inp33`,`inp34`,`inp35`,`inp36`,`inp37`,`inp38`,`inp39`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$inp1,$inp2,$inp3,$inp4,$inp5,$inp6,$inp7,$inp8,$inp9,$inp10,$inp11,$inp12,$inp13,$inp14,$inp15,$inp16,$inp17,$inp18,$inp19,$inp20,$inp21,$inp22,$inp23,$inp24,$inp25,$inp26,$inp27,$inp28,$inp29,$inp30,$inp31,$inp32,$inp33,$inp34,$inp35,$inp36,$inp37,$inp38,$inp39));
    addForm($encounter, "Clonidine Withdraw Protocol A", $newid, "clonidine_form",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();