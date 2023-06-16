<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");


$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$date1=$_POST['date1'];
$psign=$_POST['signature1'];
$ack=$_POST['ack1'];
$date2=$_POST['date2'];
$asign=$_POST['signature2'];
$name=$_POST['Nname'];
$address=$_POST['Naddress'];
$city=$_POST['Ncity'];
$number=$_POST['Nnumber'];
$text1=$_POST['text1'];


if ($id && $id != 0) {
    sqlStatement("UPDATE `form_umr` SET  `fname` =?, `lname`=?, `date1`=?, `signature1`=?, `ack`=?, 
    `date2`=?, `signature2`=?, `Nname`=?, `Naddress`=?,`Ncity`=?,`Nnumber`=?,`text1`=? WHERE id =?", array($fname,$lname,
    $date1,$psign,$ack,$date2,$asign,$name,$address,$city,$number,$text1,$id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_umr`(`pid`,`encounter`,`fname`,`lname`, `date1`, `signature1`, `ack`, `date2`, `signature2`, `Nname`, `Naddress`, `Ncity`, `Nnumber`, `text1`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$encounter,$fname,$lname,
    $date1,$psign,$ack,$date2,$asign,$name,$address,$city,$number,$text1));
    addForm($encounter, "umr_form", $newid, "form_umr",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();