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

// echo "test";
// die();


$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$pname=$_POST['pname'];
$ssn=$_POST['ssn'];
$pdob=$_POST['pdob'];
$sname=$_POST['sname'];
$rtp=$_POST['rtp'];
$sename=$_POST['sename'];
$cdappeal=$_POST['cdappeal'];
$checkyes=$_POST['checkyes'];
$checkno=$_POST['checkno'];
$authname=$_POST['authname'];
$date=$_POST['date'];
$apaddress=$_POST['apaddress'];
$relation=$_POST['relation'];
$signpat=$_POST['signpat'];
$date1=$_POST['date1'];
$age=$_POST['age'];
$bconsent=$_POST['bconsent'];
$signpg=$_POST['signpg'];
$date3=$_POST['date3'];
$relationship=$_POST['relationship'];
$fax=$_POST['fax'];
$date4=$_POST['date4'];
$page=$_POST['page'];
$subname=$_POST['subname'];
$subcomp=$_POST['subcomp'];
$subphone=$_POST['subphone'];
$subadd=$_POST['subadd'];
$subname1=$_POST['subname1'];
$subcomp1=$_POST['subcomp1'];
$subphone1=$_POST['subphone1'];
$subfax=$_POST['subfax'];
$subadd1=$_POST['subadd1'];
$addnote=$_POST['addnote'];





if ($id && $id != 0) {
    sqlStatement("UPDATE form_cigna SET `pid` =?, `encounter`=?, `pname`=?, `ssn`=?, `pdob`=?, 
    `sname`=?, `rtp`=?, `sename`=?, `cdappeal`=?, `checkyes`=?, `checkno`=?, `authname`=?,`date`=?,`apaddress`=?,`relation`=?,`signpat`=?,`date1`=?,`age`=?,`bconsent`=?,`signpg`=?,`date3`=?,`relationship`=?,`fax`=?,`date4`=?,`page`=?,`subname`=?,`subcomp`=?,`subphone`=?,`subadd`=?,`subname1`=?,`subcomp1`=?,`subphone1`=?,`subfax`=?,`subadd1`=?,`addnote`=? WHERE id= ?", array($_SESSION["pid"],$_SESSION["encounter"],$pname,$ssn,$pdob,$sname,$rtp,$sename,$cdappeal,$checkyes,$checkno,$authname,$date,$apaddress,$relation,$signpat,$date1,$age,$bconsent,$signpg,$date3,$relationship,$fax,$date4,$page,$subname,$subcomp,$subphone,$subadd,$subname1,$subcomp1,$subphone1,$subfax,$subadd1,$addnote,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_cigna (pid,encounter,pname, ssn, pdob, 
    sname, rtp, sename, cdappeal, checkyes, checkno, authname,date,apaddress,relation,signpat,date1,age,bconsent,signpg,date3,relationship,fax,date4,page,subname,subcomp,subphone,subadd,subname1,subcomp1,subphone1,subfax,subadd1,addnote) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$pname,$ssn,$pdob,$sname,$rtp,$sename,$cdappeal,$checkyes,$checkno,$authname,$date,$apaddress,$relation,$signpat,$date1,$age,$bconsent,$signpg,$date3,$relationship,$fax,$date4,$page,$subname,$subcomp,$subphone,$subadd,$subname1,$subcomp1,$subphone1,$subfax,$subadd1,$addnote));
    addForm($encounter, "Cigna form", $newid, "Cigna_form",  $_SESSION["pid"], $userauthorized);
}




formHeader("Redirecting....");
formJump();
formFooter();