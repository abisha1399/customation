<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");


$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');


$input=$_POST['input'];
$sign1=$_POST['sign1'];
$date1=$_POST['date1'];
$sign2=$_POST['sign2'];
$date2=$_POST['date2'];





if ($id && $id != 0) {
    sqlStatement("UPDATE `form_safety` SET `input`=?,`sign1`=?,`date1`=?,`sign2`=?, `date2`=?  WHERE id =?", array($input,$sign1,$date1,$sign2, $date2, $id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_safety`(`pid`,`encounter`,`input`,`sign1`,`date1`,`sign2`, `date2`) VALUES (?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$input,$sign1,$date1,$sign2, $date2));
    addForm($encounter, "Safety Form", $newid, "form_safety",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
