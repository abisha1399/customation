<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");


$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');




$comment1=$_POST['comment1'];
$other=$_POST['other'];
$tdate=$_POST['tdate'];
$name1=$_POST['name1'];

$date1=$_POST['date1'];
$checkbox1=$_POST['checkbox1'];
$checkbox2=$_POST['checkbox2'];
$checkbox3=$_POST['checkbox3'];
$checkbox4=$_POST['checkbox4'];
$checkbox5=$_POST['checkbox5'];





if ($id && $id != 0) {
    sqlStatement("UPDATE `form_master1` SET  `comment1`=?, `date1`=?, `name1`=?, `other`=?, `tdate`=?,`checkbox1`=?, `checkbox2`=?,  `checkbox3`=?, `checkbox4`=?, `checkbox5`=? WHERE id =?", array($comment1,$date1,$name1,$other,$tdate,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5, $id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_master1`(`pid`,`encounter`,`comment1`, `date1`, `name1`, `other`, `tdate`,`checkbox1`, `checkbox2`, `checkbox3`, `checkbox4`, `checkbox5`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$comment1,$date1,$name1,$other,$tdate,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5));
    print_r($newid);
    addForm($encounter, "Master1 Form", $newid, "form_master1",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
 

