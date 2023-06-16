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

//echo "test";
$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$mname=$_POST["mname"];
$midnum=$_POST["midnum"];
$dob=$_POST["dob"];
$mbh=$_POST["mbh"];
$ali=$_POST["ali"];
$hiv=$_POST["hiv"];
$signilr=$_POST["signilr"];
$date2=$_POST["date2"];
$printn=$_POST["printn"];
$legal=$_POST["legal"];
$lar=$_POST["lar"];
$pomc=$_POST["pomc"];
$insname=$_POST["insname"];
$mid=$_POST["mid"];
$patname=$_POST["patname"];
$pma=$_POST["pma"];
$thad=$_POST["thad"];
$text1=$_POST["text1"];
$text2=$_POST["text2"];
if ($id && $id != 0) {
    sqlStatement("UPDATE form_nj SET pid =?, encounter=?, mname=?, midnum=?, dob=?, 
    mbh=?, ali=?, hiv=?, signilr=?, date2=?, printn=?, legal=?,lar=?,pomc=?,insname=?,mid=?,patname=?,pma=?,thad=?,text1=?,text2=? WHERE id = ?", array($_SESSION["pid"],$_SESSION["encounter"],$mname,$midnum,$dob,$mbh,$ali,$hiv,$signilr,$date2,$printn,$legal,$lar,$pomc,$insname,$mid,$patname,$pma,$thad,$text1,$text2,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_nj (pid,encounter,mname,midnum,dob,mbh,ali,hiv,signilr,date2,printn,
    legal,lar,pomc,insname,mid,patname,pma,thad,text1,text2) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$mname,$midnum,$dob,$mbh,$ali,$hiv,$signilr,$date2,$printn,$legal,$lar,$pomc,$insname,$mid,$patname,$pma,$thad,$text1,$text2));
    addForm($encounter, "NJ Form", $newid, "NJ_form",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();