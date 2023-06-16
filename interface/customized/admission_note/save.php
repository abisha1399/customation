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
$inp1=$_POST["inp1"];
$inp2=$_POST["inp2"];


if ($id && $id != 0) {
    // echo "test1";
    // die();
    sqlStatement("UPDATE form_admission_note1 SET `pid`= ?, `encounter`= ?, `txt1`= ?,`inp1`= ?,`inp2`= ? WHERE id = ?", array($_SESSION["pid"],$_SESSION["encounter"],$txt1,$inp1,$inp2,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_admission_note1 (`pid`, `encounter`, `txt1`,`inp1`,`inp2`) VALUES (?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$txt1,$inp1,$inp2,));
    addForm($encounter, "Admission Note", $newid, "admission_note",  $_SESSION["pid"], $userauthorized);
}


formHeader("Redirecting....");
formJump();
formFooter();