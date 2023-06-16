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






if ($id && $id != 0) {
    // echo "test1";
    // die();
    sqlStatement("UPDATE form_integumentary SET `pid`= ?, `encounter`= ?, `check1`= ?, `check2`= ?, `check3`= ?, `check4`= ?, `check5`= ?, `check6`= ?, `check7`= ?, `check8`= ?, `check9`= ?, `check10`= ?, `check11`= ? WHERE id = ?", array($_SESSION["pid"],$_SESSION["encounter"],$check1,$check2,$check3,$check4,$check5,$check6,$check7,$check8,$check9,$check10,$check11,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_integumentary (`pid`, `encounter`, `check1`, `check2`, `check3`, `check4`, `check5`, `check6`, `check7`, `check8`, `check9`, `check10`, `check11`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$check1,$check2,$check3,$check4,$check5,$check6,$check7,$check8,$check9,$check10,$check11));
    addForm($encounter, "Integumentary", $newid, "integumentary",  $_SESSION["pid"], $userauthorized);
}


formHeader("Redirecting....");
formJump();
formFooter();