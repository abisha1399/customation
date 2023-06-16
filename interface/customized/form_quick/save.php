<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");


$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');





$name0=$_POST['name0'];
$date1=$_POST['date1'];
$checkbox1=$_POST['checkbox1'];
$checkbox2=$_POST['checkbox2'];
$checkbox3=$_POST['checkbox3'];
$checkbox4=$_POST['checkbox4'];
$checkbox5=$_POST['checkbox5'];

$name1=$_POST['name1'];
$name2=$_POST['name2'];
$rel1=$_POST['rel1'];
$rel2=$_POST['rel2'];
$num1=$_POST['num1'];
$num2=$_POST['num2'];






if ($id && $id != 0) {
    sqlStatement("UPDATE `form_quick` SET    `name0`=?,`date1`=?,  `checkbox1`=?, `checkbox2`=?,  `checkbox3`=?, `checkbox4`=?, `checkbox5`=?, `name1`=?,`name2`=?,`rel1`=?,`rel2`=?,`num1`=?,`num2`=? WHERE id =?", array($name0,$date1,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$name1,$name2,$rel1,$rel2,$num1,$num2,$id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_quick`(`pid`,`encounter`,`name0`,`date1`,  `checkbox1`, `checkbox2`,  `checkbox3`, `checkbox4`, `checkbox5`, `name1`,`name2`,`rel1`,`rel2`,`num1`,`num2`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$name0,$date1,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$name1,$name2,$rel1,$rel2,$num1,$num2));
    addForm($encounter, "Quick Guide Form", $newid, "form_quick",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
 

