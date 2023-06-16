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

$name = $_POST["name"];
$date = $_POST["dob"];
$first = $_POST["medication"];
$second = $_POST["dt"];
$third = $_POST["current"];
$client = $_POST["withdraw"];
$dat = $_POST["nurse"];
$signature = $_POST["post"];
$datas =  $_POST["med"];

$first1 = $_POST["medication1"];
$second1 = $_POST["dt1"];
$third1 = $_POST["current1"];
$client1 = $_POST["withdraw1"];
$dat1 = $_POST["nurse1"];
$signature1 = $_POST["post1"];
$datas1 =  $_POST["med1"];

$first2 = $_POST["medication2"];
$second2 = $_POST["dt2"];
$third2 = $_POST["current2"];
$client2 = $_POST["withdraw2"];
$dat2 = $_POST["nurse2"];
$signature2 = $_POST["post2"];
$datas2 = $_POST["med2"];

$first3 = $_POST["medication3"];
$second3 = $_POST["dt3"];
$third3 = $_POST["current3"];
$client3 = $_POST["withdraw3"];
$dat3 = $_POST["nurse3"];
$signature3 = $_POST["post3"];
$datas3 = $_POST["med3"];


$first4 = $_POST["medication4"];
$second4 = $_POST["dt4"];
$third4 = $_POST["current4"];
$client4 = $_POST["withdraw4"];
$dat4 = $_POST["nurse4"];
$signature4 = $_POST["post4"];
$datas4 = $_POST["med4"];

if ($id && $id != 0) {
    sqlStatement("UPDATE `form_medications` SET `pid`=?,`encounter`=?,`patient_name`=?,`dob`=?,`medication`=?,
    `dtime`=?,`current`=?,`withdraw`=?,`nurse`=?,`post`=?,`med`=?,`medication1`=?,`dtime1`=?,`current1`=?,
    `withdraw1`=?,`nurse1`=?,`post1`=?,`med1`=?,`medication2`=?,`dtime2`=?,`current2`=?,`withdraw2`=?,
    `nurse2`=?,`post2`=?,`med2`=?,`medication3`=?,`dtime3`=?,`current3`=?,`withdraw3`=?,`nurse3`=?,
    `post3`=?,`med3`=?,`medication4`=?,`dtime4`=?,`current4`=?,`withdraw4`=?,`nurse4`=?,`post4`=?,
    `med4`=? WHERE id = ?",array($_SESSION["pid"],$_SESSION["encounter"],$name,$date,$first,$second,$third,
    $client,$dat,$signature,$datas,$first1,$second1,$third1,$client1,$dat1,$signature1,$datas1,$first2,
    $second2,$third2,$client2,$dat2,$signature2,$datas2,$first3,$second3,$third3,$client3,$dat3,$signature3,
    $datas3,$first4,$second4,$third4,$client4,$dat4,$signature4,$datas4,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO `form_medications`(`pid`, `encounter`, `patient_name`, `dob`, 
    `medication`, `dtime`, `current`, `withdraw`, `nurse`, `post`, `med`,
     `medication1`, `dtime1`, `current1`,`withdraw1`, `nurse1`, `post1`, `med1`,
      `medication2`, `dtime2`, `current2`, `withdraw2`, `nurse2`,`post2`, `med2`,
      `medication3`, `dtime3`, `current3`, `withdraw3`, `nurse3`, `post3`, `med3`, 
     `medication4`, `dtime4`, `current4`, `withdraw4`, `nurse4`, `post4`, `med4`) 
     VALUES (?,?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$name,$date,$first,$second,$third,$client,$dat,$signature,$datas,
    $first1,$second1,$third1,$client1,$dat1,$signature1,$datas1,
    $first2,$second2,$third2,$client2,$dat2,$signature2,$datas2,
    $first3,$second3,$third3,$client3,$dat3,$signature3,$datas3,
    $first4,$second4,$third4,$client4,$dat4,$signature4,$datas4));

    addForm($encounter, "medication monitor", $newid, "form_medication",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
 
