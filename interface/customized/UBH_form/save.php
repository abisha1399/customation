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




$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$fname=$_POST["fname"];
$lname=$_POST["lname"];
$add=$_POST["address"];
$city=$_POST["city"];
$state=$_POST["state"];
$phn=$_POST["phn"];
$pid=$_POST["pid1"];
$phone=$_POST["phone"];
$patid=$_POST["patid"];
$description=$_POST["description"];
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$add2=$_POST["add2"];
$city2=$_POST["city2"];
$state2=$_POST["state2"];
$dpn=$_POST["dpn"];
$sign=$_POST["sign"];
$nmpidname=$_POST["nmpidname"];
$date2=$_POST["date2"];
$sign2=$_POST["sign2"];
$nmpidname2=$_POST["nmpidname2"];
$date3=$_POST["date3"];




if ($id && $id != 0) {
    sqlStatement("UPDATE form_ubh SET fname =?, lname=?, address=?, city=?, state=?, 
    phn=?, pid1=?, phone=?, patid=?, description=?, firstname=?, lastname=?,add2=?,city2=?,state2=?,dpn=?,sign=?,nmpidname=?,date2=?,sign2=?,nmpidname2=?,date3=? WHERE id = ?", array($fname,$lname,$add,$city,$state,$phn,$pid,$phone,$patid,$description,$firstname,$lastname,$add2, $city2,$state2,$dpn,$sign,$nmpidname,$date2,$sign2,$nmpidname2,$date3,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_ubh (pid,encounter,fname,lname,address,city,state,phn,pid1,phone,patid,description,firstname,lastname,add2,city2,state2,dpn,sign,nmpidname,
    date2,sign2,nmpidname2,date3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$fname,$lname,$add,$city,$state,$phn,$pid,$phone,$patid,$description,$firstname,$lastname,$add2,$city2,$state2,$dpn,$sign,$nmpidname,$date2,$sign2,$nmpidname2,$date3));
    addForm($encounter, "UBH Form", $newid, "UBH_form",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();