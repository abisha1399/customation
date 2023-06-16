<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");


$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$name=$_POST['name'];
$address=$_POST['address'];
$city=$_POST['city'];
$number=$_POST['number'];
$telephone=$_POST['telephone'];
$email=$_POST['email'];
$inumber=$_POST['inumber'];
$snumber=$_POST['snumber'];
$checkbox1=$_POST['checkbox1'];
$checkbox2=$_POST['checkbox2'];
$cinput1=$_POST['cinput1'];
$checkbox3=$_POST['checkbox3'];
$cinput2=$_POST['cinput2'];
$checkbox4=$_POST['checkbox4'];
$cinput3=$_POST['cinput3'];
$pname=$_POST['pname'];
$paddress=$_POST['paddress'];
$pcity=$_POST['pcity'];
$pnumber=$_POST['pnumber'];
$ptelephone=$_POST['ptelephone'];
$pemail=$_POST['pemail'];
$checkbox5=$_POST['checkbox5'];
$cinput4=$_POST['cinput4'];
$checkbox6=$_POST['checkbox6'];
$cinput5=$_POST['cinput5'];
$signature1=$_POST['signature1'];
$ldate=$_POST['ldate'];
$signature2=$_POST['signature2'];
$text1=$_POST['text1'];
$text2=$_POST['text2'];
$text3=$_POST['text3'];
$text4=$_POST['text4'];
$text5=$_POST['text5'];
$text6=$_POST['text6'];

if ($id && $id != 0) {
    sqlStatement("UPDATE `form_wellmark` SET `name`=?, `address`=?, `city`=?,`number`=?, `telephone`=?, `email`=?, 
    `inumber`=?, `snumber`=?, `checkbox1`=?, `checkbox2`=?,`cinput1`=?,`checkbox3`=?,
    `cinput2`=?, `checkbox4`=?, `cinput3`=?, `pname`=?,`paddress`=?,`pcity`=? ,
    `pnumber`=?, `ptelephone`=?, `pemail`=?, `checkbox5`=?,`cinput4`=?,`checkbox6`=?, 
    `cinput5`=?, `signature1`=?, `ldate`=?, `signature2`=?, `text1`=?, `text2`=?, `text3`=?, `text4`=?, `text5`=?, `text6`=?   WHERE id =?", array($name,$address,
    $city,$number,$telephone,$email,$inumber,$snumber,$checkbox1,$checkbox2,$cinput1,$checkbox3,
    $cinput2,$checkbox4,$cinput3,$pname,$paddress,$pcity,$pnumber,$ptelephone,$pemail,$checkbox5,
    $cinput4,$checkbox6,$cinput5,$signature1,$ldate,$signature2,$text1,$text2,$text3,$text4,$text5,$text6,$id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_wellmark`(`pid`,`encounter` ,`name`, `address`, `city`,`number`, `telephone`, `email`, 
    `inumber`, `snumber`, `checkbox1`, `checkbox2`,`cinput1`,`checkbox3`,
    `cinput2`, `checkbox4`, `cinput3`, `pname`,`paddress`,`pcity` ,
    `pnumber`, `ptelephone`, `pemail`, `checkbox5`,`cinput4`,`checkbox6`, 
    `cinput5`, `signature1`, `ldate`, `signature2`, `text1`, `text2`, `text3`, `text4`, `text5`, `text6` ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$name,$address,
    $city,$number,$telephone,$email,$inumber,$snumber,$checkbox1,$checkbox2,$cinput1,$checkbox3,
    $cinput2,$checkbox4,$cinput3,$pname,$paddress,$pcity,$pnumber,$ptelephone,$pemail,$checkbox5,
    $cinput4,$checkbox6,
    $cinput5,$signature1,$ldate,$signature2,$text1,$text2,$text3,$text4,$text5,$text6));
    addForm($encounter, "form_wellmark", $newid, "form_wellmark",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();




