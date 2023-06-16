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
$dob = $_POST["dob"];
$mf = $_POST["mf"];
$rating = $_POST['rating'];

$dobs = $_POST["dobs"];
$times = $_POST["times"];

$date1 = $_POST["date1"];
$date2 = $_POST["date2"];
$date3 = $_POST["date3"];
$date4 = $_POST["date4"];
$date5 = $_POST["date5"];
$date6 = $_POST["date6"];
$date7 = $_POST["date7"];
$date8 = $_POST["date8"];
$date9 = $_POST["date9"];
$date10 = $_POST["date10"];

$timee1 = $_POST["timee1"];
$timee2 = $_POST["timee2"];
$timee3 = $_POST["timee3"];
$timee4 = $_POST["timee4"];
$timee5= $_POST["timee5"];
$timee6= $_POST["timee6"];
$timee7 = $_POST["timee7"];
$timee8 = $_POST["timee8"];
$timee9 = $_POST["timee9"];
$timee10 = $_POST["timee10"];

$bal1 = $_POST["bal1"];
$bal2 = $_POST["bal2"];
$bal3 = $_POST["bal3"];
$bal4 = $_POST["bal4"];
$bal5= $_POST["bal5"];
$bal6= $_POST["bal6"];
$bal7 = $_POST["bal7"];
$bal8 = $_POST["bal8"];
$bal9 = $_POST["bal9"];
$bal10 = $_POST["bal10"];

$rest1 = $_POST["rest1"];
$rest2 = $_POST["rest2"];
$rest3 = $_POST["rest3"];
$rest4 = $_POST["rest4"];
$rest5= $_POST["rest5"];
$rest6= $_POST["rest6"];
$rest7 = $_POST["rest7"];
$rest8 = $_POST["rest8"];
$rest9 = $_POST["rest9"];
$rest10 = $_POST["rest10"];

$sweat1 = $_POST["sweat1"];
$sweat2 = $_POST["sweat2"];
$sweat3 = $_POST["sweat3"];
$sweat4 = $_POST["sweat4"];
$sweat5= $_POST["sweat5"];
$sweat6= $_POST["sweat6"];
$sweat7 = $_POST["sweat7"];
$sweat8 = $_POST["sweat8"];
$sweat9 = $_POST["sweat9"];
$sweat10 = $_POST["sweat10"];


$restless1 = $_POST["restless1"];
$restless2 = $_POST["restless2"];
$restless3 = $_POST["restless3"];
$restless4 = $_POST["restless4"];
$restless5= $_POST["restless5"];
$restless6= $_POST["restless6"];
$restless7 = $_POST["restless7"];
$restless8 = $_POST["restless8"];
$restless9 = $_POST["restless9"];
$restless10 = $_POST["restless10"];


$names = $_POST["names"];
$dobss = $_POST["dobss"];
$mf1 = $_POST["mf1"];

$anxienty1 = $_POST["anxienty1"];
$anxienty2 = $_POST["anxienty2"];
$anxienty3 = $_POST["anxienty3"];
$anxienty4 = $_POST["anxienty4"];
$anxienty5= $_POST["anxienty5"];
$anxienty6= $_POST["anxienty6"];
$anxienty7 = $_POST["anxienty7"];
$anxienty8 = $_POST["anxienty8"];
$anxienty9 = $_POST["anxienty9"];
$anxienty10 = $_POST["anxienty10"];


$goose1 = $_POST["goose1"];
$goose2 = $_POST["goose2"];
$goose3 = $_POST["goose3"];
$goose4 = $_POST["goose4"];
$goose5= $_POST["goose5"];
$goose6= $_POST["goose6"];
$goose7 = $_POST["goose7"];
$goose8 = $_POST["goose8"];
$goose9 = $_POST["goose9"];
$goose10 = $_POST["goose10"];

$total1 = $_POST["total1"];
$total2 = $_POST["total2"];
$total3 = $_POST["total3"];
$total4 = $_POST["total4"];
$total5= $_POST["total5"];
$total6= $_POST["total6"];
$total7 = $_POST["total7"];
$total8 = $_POST["total8"];
$total9 = $_POST["total9"];
$total10 = $_POST["total10"];

$blood1 = $_POST["blood1"];
$blood2 = $_POST["blood2"];
$blood3 = $_POST["blood3"];
$blood4 = $_POST["blood4"];
$blood5= $_POST["blood5"];
$blood6= $_POST["blood6"];
$blood7 = $_POST["blood7"];
$blood8 = $_POST["blood8"];
$blood9 = $_POST["blood9"];
$blood10 = $_POST["blood10"];

$pulse1 = $_POST["pulse1"];
$pulse2 = $_POST["pulse2"];
$pulse3 = $_POST["pulse3"];
$pulse4 = $_POST["pulse4"];
$pulse5= $_POST["pulse5"];
$pulse6= $_POST["pulse6"];
$pulse7 = $_POST["pulse7"];
$pulse9 = $_POST["pulse8"];
$blood9 = $_POST["pulse9"];
$pulse10 = $_POST["pulse10"];

$temperature1 = $_POST["temperature1"];
$temperature2 = $_POST["temperature2"];
$temperature3 = $_POST["temperature3"];
$temperature4 = $_POST["temperature4"];
$temperature5= $_POST["temperature5"];
$temperature6= $_POST["temperature6"];
$temperature7 = $_POST["temperature7"];
$temperature8 = $_POST["temperature8"];
$temperature9 = $_POST["temperature9"];
$temperature10 = $_POST["temperature10"];

$respirations1 = $_POST["respirations1"];
$respirations2 = $_POST["respirations2"];
$respirations3 = $_POST["respirations3"];
$respirations4 = $_POST["respirations4"];
$respirations5= $_POST["respirations5"];
$respirations6= $_POST["respirations6"];
$respirations7 = $_POST["temperature7"];
$respirations8 = $_POST["respirations8"];
$respirations9 = $_POST["respirations9"];
$respirations10 = $_POST["respirations10"];


$pupils1 = $_POST["pupils1"];
$pupils2 = $_POST["pupils2"];
$pupils3 = $_POST["pupils3"];
$pupils4 = $_POST["pupils4"];
$pupils5= $_POST["pupils5"];
$pupils6= $_POST["pupils6"];
$pupils7 = $_POST["pupils7"];
$pupils8 = $_POST["pupils8"];
$pupils9 = $_POST["pupils9"];
$pupils10 = $_POST["pupils10"];

$reaction1 = $_POST["reaction1"];
$reaction2 = $_POST["reaction2"];
$reaction3 = $_POST["reaction3"];
$reaction4 = $_POST["reaction4"];
$reaction5= $_POST["reaction5"];
$reaction6= $_POST["reaction6"];
$reaction7 = $_POST["reaction7"];
$reaction8 = $_POST["reaction8"];
$reaction9 = $_POST["reaction9"];
$reaction10 = $_POST["reaction10"];

$medication1 = $_POST["medication1"];
$medication2 = $_POST["medication2"];
$medication3 = $_POST["medication3"];
$medication4 = $_POST["medication4"];
$medication5= $_POST["medication5"];
$medication6= $_POST["medication6"];
$medication7 = $_POST["medication7"];
$medication8 = $_POST["medication8"];
$medication9 = $_POST["medication9"];
$medication10 = $_POST["medication10"];

$nurse1 = $_POST["nurse1"];
$nurse2 = $_POST["nurse2"];
$nurse3 = $_POST["nurse3"];
$nurse4 = $_POST["nurse4"];
$nurse5= $_POST["nurse5"];
$nurse6= $_POST["nurse6"];
$nurse7 = $_POST["nurse7"];
$nurse8 = $_POST["nurse8"];
$nurse9 = $_POST["nurse9"];
$nurse10 = $_POST["nurse10"];

if ($id && $id != 0) {
    sqlStatement("UPDATE `form_cows` SET `pid`=?,`encounter`=?,`name`=?,`dob`=?,`mf`=?,`rating`=?,`dobs`=?,`times`=?,
    `date1`=?,`date2`=?,`date3`=?,`date4`=?,`date5`=?, `date6`=?,`date7`=?,`date8`=?,`date9`=?,`date10`=?, `timee1`=?,`timee2`=?,`timee3`=?,`timee4`=?,`timee5`=?,
    `timee6`=?,`timee7`=?,`timee8`=?,`timee9`=?,`timee10`=?,`bal1`=?,`bal2`=?,`bal3`=?,`bal4`=?,`bal5`=?,`bal6`=?,`bal7`=?,`bal8`=?,`bal9`=?,`bal10`=?,
    `rest1`=?,`rest2`=?,`rest3`=?,`rest4`=?,`rest5`=?, `rest6`=?,`rest7`=?,`rest8`=?,`rest9`=?,`rest10`=?,
    `sweat1`=?,`sweat2`=?,`sweat3`=?,`sweat4`=?,`sweat5`=?,`sweat6`=?,`sweat7`=?,`sweat8`=?,`sweat9`=?,`sweat10`=?,
    `restless1`=?,`restless2`=?,`restless3`=?,`restless4`=?,`restless5`=?,`restless6`=?,`restless7`=?,`restless8`=?
    ,`restless9`=?,`restless10`=?,`names`=?,`dobss`=?,`mf1`=?,`anxienty1`=?,`anxienty2`=?,`anxienty3`=?,
    `anxienty4`=?,`anxienty5`=?,`anxienty6`=?,`anxienty7`=?,`anxienty8`=?,`anxienty9`=?,`anxienty10`=?,`goose1`=?,
    `goose2`=?,`goose3`=?,`goose4`=?,`goose5`=?,`goose6`=?,`goose7`=?,`goose8`=?,`goose9`=?,`goose10`=?,`total1`=?,`total2`=?,`total3`=?,`total4`=?,`total5`=?,`total6`=?,`total7`=?,`total8`=?,`total9`=?,
    `total10`=?,`blood1`=?,`blood2`=?,`blood3`=?,`blood4`=?,`blood5`=?,`blood6`=?,`blood7`=?,`blood8`=?,`blood9`=?,
    `blood10`=?,`pulse1`=?,`pulse2`=?,`pulse3`=?,`pulse4`=?,`pulse5`=?,`pulse6`=?,`pulse7`=?,`pulse8`=?,`pulse9`=?,`pulse10`=?,
    `temperature1`=?,`temperature2`=?,`temperature3`=?,`temperature4`=?,`temperature5`=?,`temperature6`=?,
    `temperature7`=?,`temperature8`=?,`temperature9`=?,`temperature10`=?,`respirations1`=?,`respirations2`=?,
    `respirations3`=?,`respirations4`=?,`respirations5`=?,`respirations6`=?,`respirations7`=?,
    `respirations8`=?,`respirations9`=?,`respirations10`=?,`pupils1`=?,`pupils2`=?,`pupils3`=?,`pupils4`=?,`pupils5`=?,`pupils6`=?,`pupils7`=?,`pupils8`=?,`pupils9`=?,`pupils10`=?,`reaction1`=?,
    `reaction2`=?,`reaction3`=?,`reaction4`=?,`reaction5`=?,`reaction6`=?,`reaction7`=?,`reaction8`=?,
    `reaction9`=?,`reaction10`=?,`medication1`=?,`medication2`=?,`medication3`=?,`medication4`=?,`medication5`=?,`medication6`=?,`medication7`=?,`medication8`=?,`medication9`=?,`medication10`=?,
    `nurse1`=?,`nurse2`=?,`nurse3`=?,`nurse4`=?,`nurse5`=?,`nurse6`=?,`nurse7`=?,`nurse8`=?,`nurse9`=?,`nurse10`=?
    WHERE id = ?",array($_SESSION["pid"],$_SESSION["encounter"],$name,$dob,$mf,$rating,$dobs,$times,
    $date1,$date2,$date3,$date4,$date5,$date6,$date7,$date8,$date9,$date10,
    $timee1,$timee2,$timee3,$timee4,$timee5,$timee6,$timee7,$timee8,$timee9,$timee10,
    $bal1,$bal2,$bal3,$bal4,$bal5,$bal6,$bal7,$bal8,$bal9,$bal10,
    $rest1,$rest2,$rest3,$rest4,$rest5,$rest6,$rest7,$rest8,$rest9,$rest10,
    $sweat1,$sweat2,$sweat3,$sweat4,$sweat5,$sweat6,$sweat7,$sweat8,$sweat9,$sweat10,
    $restless1,$restless2,$restless3,$restless4,$restless5,$restless6,$restless7,$restless8,$restless9,$restless10,$names,$dobss,$mf1,
    $anxienty1,$anxienty2,$anxienty3,$anxienty4,$anxienty5,$anxienty6,$anxienty7,$anxienty8,$anxienty9,$anxienty10,$goose1,$goose2,$goose3,$goose4,$goose5,$goose6,$goose7,$goose8,$goose9,$goose10,
    $total1,$total2,$total3,$total4,$total5,$total6,$total7,$total8,$total9,$total10,
    $blood1,$blood2,$blood3,$blood4,$blood5,$blood6,$blood7,$blood8,$blood9,$blood10,
    $pulse1,$pulse2,$pulse3,$pulse4,$pulse5,$pulse6,$pulse7,$pulse8,$pulse9,$pulse10,
    $temperature1,$temperature2,$temperature3,$temperature4,$temperature5,$temperature6,$temperature7,$temperature8,$temperature9,$temperature10,
    $respirations1,$respirations2,$respirations3,$respirations4,$respirations5,$respirations6,$respirations7,$respirations8,$respirations9,$respirations10,
    $pupils1,$pupils2,$pupils3,$pupils4,$pupils5,$pupils6,$pupils7,$pupils8,$pupils9,$pupils10,
    $reaction1,$reaction2,$reaction3,$reaction4,$reaction5,$reaction6,$reaction7,$reaction8,$reaction9,$reaction10,
    $medication1,$medication2,$medication3,$medication4,$medication5,$medication6,$medication7,$medication8,$medication9,$medication10,
    $nurse1,$nurse2,$nurse3,$nurse4,$nurse5,$nurse6,$nurse7,$nurse8,$nurse9,$nurse10,$id));
}else
{
    $newid = sqlInsert("INSERT INTO `form_cows`(`pid`, `encounter`, `name`, `dob`, `mf`,`rating`, `dobs`, `times`,
    `date1`, `date2`, `date3`, `date4`, `date5`, `date6`, `date7`, `date8`, `date9`, `date10`,
    `timee1`, `timee2`, `timee3`, `timee4`, `timee5`, `timee6`, `timee7`, `timee8`, `timee9`, `timee10`,
    `bal1`, `bal2`, `bal3`, `bal4`, `bal5`, `bal6`, `bal7`, `bal8`, `bal9`, `bal10`,
    `rest1`, `rest2`, `rest3`, `rest4`, `rest5`, `rest6`, `rest7`, `rest8`, `rest9`, `rest10`,
     `sweat1`, `sweat2`, `sweat3`, `sweat4`, `sweat5`, `sweat6`, `sweat7`, `sweat8`, `sweat9`, `sweat10`,
     `restless1`, `restless2`, `restless3`, `restless4`, `restless5`, `restless6`, `restless7`, `restless8`, `restless9`, `restless10`,`names`, `dobss`, `mf1`, `anxienty1`, `anxienty2`, `anxienty3`, `anxienty4`, `anxienty5`, `anxienty6`, `anxienty7`, `anxienty8`, `anxienty9`, `anxienty10`,`goose1`, `goose2`,`goose3`, `goose4`, `goose5`, `goose6`, `goose7`, `goose8`, `goose9`, `goose10`, `total1`, `total2`, `total3`, `total4`, `total5`, `total6`, `total7`, `total8`, `total9`, `total10`, `blood1`, `blood2`, `blood3`, `blood4`, `blood5`, `blood6`, `blood7`, `blood8`, `blood9`, `blood10`, `pulse1`, `pulse2`, `pulse3`, `pulse4`, `pulse5`, `pulse6`, `pulse7`, `pulse8`, `pulse9`, `pulse10`,`temperature1`, `temperature2`, `temperature3`, `temperature4`, `temperature5`, `temperature6`, `temperature7`,`temperature8`, `temperature9`, `temperature10`, `respirations1`, `respirations2`, `respirations3`, `respirations4`, `respirations5`, `respirations6`, `respirations7`, `respirations8`, `respirations9`, `respirations10`, `pupils1`, `pupils2`, `pupils3`, `pupils4`, `pupils5`, `pupils6`, `pupils7`, `pupils8`, `pupils9`, `pupils10`,`reaction1`, `reaction2`, `reaction3`, `reaction4`, `reaction5`, `reaction6`, `reaction7`, `reaction8`, `reaction9`, `reaction10`, `medication1`, `medication2`, `medication3`, `medication4`, `medication5`, `medication6`, `medication7`, `medication8`, `medication9`, `medication10`,
        `nurse1`, `nurse2`, `nurse3`, `nurse4`, `nurse5`, `nurse6`, `nurse7`, `nurse8`, `nurse9`, `nurse10`)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",

    array($_SESSION["pid"],$_SESSION["encounter"],
    $name,$dob,$mf,$rating,$dobs,$times,
    $date1,$date2,$date3,$date4,$date5,$date6,$date7,$date8,$date9,$date10,
    $timee1,$timee2,$timee3,$timee4,$timee5,$timee6,$timee7,$timee8,$timee9,$timee10,
    $bal1,$bal2,$bal3,$bal4,$bal5,$bal6,$bal7,$bal8,$bal9,$bal10,
    $rest1,$rest2,$rest3,$rest4,$rest5,$rest6,$rest7,$rest8,$rest9,$rest10,
    $sweat1,$sweat2,$sweat3,$sweat4,$sweat5,$sweat6,$sweat7,$sweat8,$sweat9,$sweat10,
    $restless1,$restless2,$restless3,$restless4,$restless5,$restless6,$restless7,$restless8,$restless9,$restless10,$names,$dobss,$mf1,
    $anxienty1,$anxienty2,$anxienty3,$anxienty4,$anxienty5,$anxienty6,$anxienty7,$anxienty8,$anxienty9,$anxienty10,$goose1,$goose2,$goose3,$goose4,$goose5,$goose6,$goose7,$goose8,$goose9,$goose10,
    $total1,$total2,$total3,$total4,$total5,$total6,$total7,$total8,$total9,$total10,
    $blood1,$blood2,$blood3,$blood4,$blood5,$blood6,$blood7,$blood8,$blood9,$blood10,
    $pulse1,$pulse2,$pulse3,$pulse4,$pulse5,$pulse6,$pulse7,$pulse8,$pulse9,$pulse10,
    $temperature1,$temperature2,$temperature3,$temperature4,$temperature5,$temperature6,$temperature7,$temperature8,$temperature9,$temperature10,
    $respirations1,$respirations2,$respirations3,$respirations4,$respirations5,$respirations6,$respirations7,$respirations8,$respirations9,$respirations10,
    $pupils1,$pupils2,$pupils3,$pupils4,$pupils5,$pupils6,$pupils7,$pupils8,$pupils9,$pupils10,
    $reaction1,$reaction2,$reaction3,$reaction4,$reaction5,$reaction6,$reaction7,$reaction8,$reaction9,$reaction10,
    $medication1,$medication2,$medication3,$medication4,$medication5,$medication6,$medication7,$medication8,$medication9,$medication10,
    $nurse1,$nurse2,$nurse3,$nurse4,$nurse5,$nurse6,$nurse7,$nurse8,$nurse9,$nurse10));

    addForm($encounter, "cows status", $newid, "form_cows",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
