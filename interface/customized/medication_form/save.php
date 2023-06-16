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

// echo "text";
// die;
$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$pname=$_POST["pname"];
$dob=$_POST["dob"];
$allergies=$_POST["allergies"];
$patient=$_POST["patient"];
$caregiver=$_POST["caregiver"];
$provided=$_POST["provided"];
$other=$_POST["other"];
$homemeds=$_POST["homemeds"];
$txt1=$_POST["txt1"];
$nsign=$_POST["nsign"];
$datetime1=$_POST["datetime1"];
$txt2=$_POST["txt2"];
$psign=$_POST["psign"];
$date2=$_POST["date2"];
$nsign2=$_POST["nsign2"];
$date3=$_POST["date3"];
$patsign=$_POST["patsign"];
$date4=$_POST["date4"];

// print_r($_POST);
// die;


if ($id && $id != 0) {
    sqlStatement("UPDATE form_medication SET `pid`= ?, `encounter`= ?, `pname`= ?, `dob`= ?, `allergies`= ?, `patient`= ?, `caregiver`= ?, `provided`= ?, `other`= ?, `homemeds`= ?, `txt1`= ?, `nsign`= ?, `datetime1`= ?, `txt2`= ?, `psign`= ?, `date2`= ?, `nsign2`= ?, `date3`= ?, `patsign`= ?, `date4`= ? WHERE id = ?", array($_SESSION["pid"],$_SESSION["encounter"],$pname,$dob,$allergies,$patient,$caregiver,$provided,$other,$homemeds,$txt1,$nsign,$datetime1,$txt2,$psign,$date2,$nsign2,$date3,$patsign,$date4,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_medication (`pid`, `encounter`, `pname`, `dob`, `allergies`, `patient`, `caregiver`, `provided`, `other`, `homemeds`, `txt1`, `nsign`, `datetime1`, `txt2`, `psign`, `date2`, `nsign2`, `date3`, `patsign`, `date4`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$pname,$dob,$allergies,$patient,$caregiver,$provided,$other,$homemeds,$txt1,$nsign,$datetime1,$txt2,$psign,$date2,$nsign2,$date3,$patsign,$date4));
    addForm($encounter, "Medication Reconciliation Form", $newid, "medication_form",  $_SESSION["pid"], $userauthorized);

}





formHeader("Redirecting....");
formJump();
formFooter();