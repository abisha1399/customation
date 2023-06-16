<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");


$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');




$comment1=$_POST['comment1'];
$comment2=$_POST['comment2'];
$comment3=$_POST['comment3'];
$comment4=$_POST['comment4'];
$comment5=$_POST['comment5'];
$comment6=$_POST['comment6'];
$comment7=$_POST['comment7'];
$comment8=$_POST['comment8'];

$name1=$_POST['name1'];
$name2=$_POST['name2'];
$name3=$_POST['name3'];

$sign1=$_POST['Signature1'];
$sign2=$_POST['Signature2'];
$sign3=$_POST['Signature3'];

$date1=$_POST['date1'];
$date2=$_POST['date2'];
$date3=$_POST['date3'];




if ($id && $id != 0) {
    sqlStatement("UPDATE `form_follow` SET  `comment1`=?, `comment2`=?, `comment3`=?, `comment4`=?, `comment5`=?, `comment6`=?, `comment7`=?, `comment8`=?, `date1`=?, `date2`=?, `date3`=?, `sign1`=?, `sign2`=?, `sign3`=?, `name1`=?, `name2`=?, `name3`=? WHERE id =?", array($comment1,$comment2, $comment3, $comment4, $comment5, $comment6, $comment7, $comment8,$date1,$date2,$date3,$sign1,$sign2,$sign3,$name1,$name2,$name3, $id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_follow`(`pid`,`encounter`, `comment1`, `comment2`, `comment3`, `comment4`, `comment5`, `comment6`, `comment7`, `comment8`, `date1`, `date2`, `date3`, `sign1`, `sign2`, `sign3`, `name1`, `name2`, `name3`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$comment1,$comment2, $comment3, $comment4, $comment5, $comment6, $comment7, $comment8,$date1,$date2,$date3,$sign1,$sign2,$sign3,$name1,$name2,$name3));
    addForm($encounter, "Follow Up Form", $newid, "form_follow",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
 

