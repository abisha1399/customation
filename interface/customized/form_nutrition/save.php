<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");


$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');




$checkbox0=$_POST['checkbox0'];
$checkbox1=$_POST['checkbox1'];
$checkbox2=$_POST['checkbox2'];
$checkbox3=$_POST['checkbox3'];
$checkbox4=$_POST['checkbox4'];
$checkbox5=$_POST['checkbox5'];
$checkbox6=$_POST['checkbox6'];
$checkbox7=$_POST['checkbox7'];
$checkbox8=$_POST['checkbox8'];
$checkbox9=$_POST['checkbox9'];
$checkbox10=$_POST['checkbox10'];
$checkbox11=$_POST['checkbox11'];
$checkbox12=$_POST['checkbox12'];
$checkbox13=$_POST['checkbox13'];
$checkbox14=$_POST['checkbox14'];
$checkbox15=$_POST['checkbox15'];
$checkbox16=$_POST['checkbox16'];
$checkbox17=$_POST['checkbox17'];
$checkbox18=$_POST['checkbox18'];
$checkbox19=$_POST['checkbox19'];
$checkbox20=$_POST['checkbox20'];
$checkbox21=$_POST['checkbox21'];
$checkbox22=$_POST['checkbox22'];
$checkbox23=$_POST['checkbox23'];
$checkbox24=$_POST['checkbox24'];
$checkbox25=$_POST['checkbox25'];

$name1=$_POST['name1'];
$name2=$_POST['name2'];








if ($id && $id != 0) {
    sqlStatement("UPDATE `form_nutrition` SET  `checkbox1`=?,`checkbox2`=?,`checkbox3`=?,`checkbox4`=?,`checkbox5`=?,`checkbox6`=?,`checkbox7`=?,`checkbox8`=?,`checkbox9`=?,`checkbox10`=?,`checkbox11`=?,`checkbox12`=?,`checkbox13`=?,`checkbox14`=?,`checkbox15`=?,`checkbox16`=?,`checkbox17`=?,`checkbox18`=?,`checkbox19`=?,`checkbox20`=?,`checkbox21`=?,`checkbox22`=?,`checkbox23`=?,`checkbox24`=?,`checkbox25`=?, `name1`=?,`name2`=? WHERE id =?", array($checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6,$checkbox7,$checkbox8,$checkbox9,$checkbox10,$checkbox11,$checkbox12,$checkbox13,$checkbox14,$checkbox15,$checkbox16,$checkbox17,$checkbox18,$checkbox19,$checkbox20,$checkbox21,$checkbox22,$checkbox23,$checkbox24,$checkbox25,$name1,$name2, $id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_nutrition`(`pid`,`encounter`,`checkbox1`,`checkbox2`,`checkbox3`,`checkbox4`,`checkbox5`,`checkbox6`,`checkbox7`,`checkbox8`,`checkbox9`,`checkbox10`,`checkbox11`,`checkbox12`,`checkbox13`,`checkbox14`,`checkbox15`,`checkbox16`,`checkbox17`,`checkbox18`,`checkbox19`,`checkbox20`,`checkbox21`,`checkbox22`,`checkbox23`,`checkbox24`,`checkbox25`, `name1`,`name2` ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6,$checkbox7,$checkbox8,$checkbox9,$checkbox10,$checkbox11,$checkbox12,$checkbox13,$checkbox14,$checkbox15,$checkbox16,$checkbox17,$checkbox18,$checkbox19,$checkbox20,$checkbox21,$checkbox22,$checkbox23,$checkbox24,$checkbox25,$name1,$name2));
    addForm($encounter, "NUTRITION Form", $newid, "form_nutrition",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
 

