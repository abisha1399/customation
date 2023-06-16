<?php


require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');


$input1=$_POST["input1"];
$input2=$_POST["input2"];
$input3=$_POST["input3"];
$input4=$_POST["input4"];
$input5=$_POST["input5"];
$input6=$_POST["input6"];
$comment1=$_POST["comment1"];
$checkbox1=isset($_POST["checkbox1"])?$_POST["checkbox1"]:'';
$checkbox2=isset($_POST["checkbox2"])?$_POST["checkbox2"]:'';
$checkbox3=isset($_POST["checkbox3"])?$_POST["checkbox3"]:'';
$checkbox4=isset($_POST["checkbox4"])?$_POST["checkbox4"]:'';
$checkbox5=isset($_POST["checkbox5"])?$_POST["checkbox5"]:'';
$checkbox6=isset($_POST["checkbox6"])?$_POST["checkbox6"]:'';
$comment2=$_POST["comment2"];
$comment3=$_POST["comment3"];
$comment4=$_POST["comment4"];
$comment5=$_POST["comment5"];
$comment6=$_POST["comment6"];
$comment7=$_POST["comment7"];
$comment8=$_POST["comment8"];
$comment9=$_POST["comment9"];

if ($id && $id != 0) {

    sqlStatement("UPDATE `discharge_summary_phy` SET input1=?, input2=?, input3=?, input4=?, input5=?, 
    input6=?, comment1=?, checkbox1=?, checkbox2=?, checkbox3=?, checkbox4=?, checkbox5=?,checkbox6=?,comment2=?,comment3=?,comment4=?,comment5=?,comment6=?,comment7=?,comment8=?,comment9=? WHERE id = ?"
    , array($input1,$input2,$input3,$input4,$input5,$input6,$comment1,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6,$comment2,$comment3,$comment4,$comment5,$comment6,$comment7,$comment8,$comment9,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO `discharge_summary_phy` (pid,encounter,input1,input2,input3,input4,input5,input6,comment1,checkbox1,checkbox2,checkbox3,checkbox4,checkbox5,checkbox6,comment2,comment3,comment4,comment5,comment6,comment7,comment8,comment9) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$input1,$input2,$input3,$input4,$input5,$input6,$comment1,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6,$comment2,$comment3,$comment4,$comment5,$comment6,$comment7,$comment8,$comment9));
    addForm($encounter, "discharge summary form", $newid, "discharge_summary_form_phy",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();