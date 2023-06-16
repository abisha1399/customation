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
$male_female = isset($_POST["male_female"])?$_POST["male_female"]:'';
$male_female1 = isset($_POST["male_female1"])?$_POST["male_female1"]:'';

$rating0 = isset($_POST["rating0"])?$_POST["rating0"]:'';
$rating1 = isset($_POST["rating1"])?$_POST["rating1"]:'';
$rating2 = isset($_POST["rating2"])?$_POST["rating2"]:'';
$rating3 = isset($_POST["rating3"])?$_POST["rating3"]:'';
$rating4 = isset($_POST["rating4"])?$_POST["rating4"]:'';
$rating5 = isset($_POST["rating5"])?$_POST["rating5"]:'';
$rating6 = isset($_POST["rating6"])?$_POST["rating6"]:'';
$rating7 = isset($_POST["rating7"])?$_POST["rating7"]:'';

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

$time1 = $_POST["time1"];
$time2 = $_POST["time2"];
$time3 = $_POST["time3"];
$time4 = $_POST["time4"];
$time5= $_POST["time5"];
$time6= $_POST["time6"];
$time7 = $_POST["time7"];
$time8 = $_POST["time8"];
$time9 = $_POST["time9"];
$time10 = $_POST["time10"];

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

$agitation1 = $_POST["agitation1"];
$agitation2 = $_POST["agitation2"];
$agitation3 = $_POST["agitation3"];
$agitation4 = $_POST["agitation4"];
$agitation5 = $_POST["agitation5"];
$agitation6 = $_POST["agitation6"];
$agitation7 = $_POST["agitation7"];
$agitation8 = $_POST["agitation8"];
$agitation9 = $_POST["agitation9"];
$agitation10 = $_POST["agitation10"];

$paranoia1 = $_POST["paranoia1"];
$paranoia2 = $_POST["paranoia2"];
$paranoia3 = $_POST["paranoia3"];
$paranoia4 = $_POST["paranoia4"];
$paranoia5 = $_POST["paranoia5"];
$paranoia6 = $_POST["paranoia6"];
$paranoia7 = $_POST["paranoia7"];
$paranoia8 = $_POST["paranoia8"];
$paranoia9 = $_POST["paranoia9"];
$paranoia10 = $_POST["paranoia10"];

$paroxysmal1 = $_POST["paroxysmal1"];
$paroxysmal2 = $_POST["paroxysmal2"];
$paroxysmal3 = $_POST["paroxysmal3"];
$paroxysmal4 = $_POST["paroxysmal4"];
$paroxysmal5 = $_POST["paroxysmal5"];
$paroxysmal6 = $_POST["paroxysmal6"];
$paroxysmal7 = $_POST["paroxysmal7"];
$paroxysmal8 = $_POST["paroxysmal8"];
$paroxysmal9 = $_POST["paroxysmal9"];
$paroxysmal10 = $_POST["paroxysmal10"];

$anxiety1 = $_POST["anxiety1"];
$anxiety2 = $_POST["anxiety2"];
$anxiety3 = $_POST["anxiety3"];
$anxiety4 = $_POST["anxiety4"];
$anxiety5 = $_POST["anxiety5"];
$anxiety6 = $_POST["anxiety6"];
$anxiety7 = $_POST["anxiety7"];
$anxiety8 = $_POST["anxiety8"];
$anxiety9 = $_POST["anxiety9"];
$anxiety10 = $_POST["anxiety10"];

$depression1 = $_POST["depression1"];
$depression2 = $_POST["depression2"];
$depression3 = $_POST["depression3"];
$depression4 = $_POST["depression4"];
$depression5 = $_POST["depression5"];
$depression6 = $_POST["depression6"];
$depression7 = $_POST["depression7"];
$depression8 = $_POST["depression8"];
$depression9 = $_POST["depression9"];
$depression10 = $_POST["depression10"];

$craving1 = $_POST["craving1"];
$craving2 = $_POST["craving2"];
$craving3 = $_POST["craving3"];
$craving4 = $_POST["craving4"];
$craving5 = $_POST["craving5"];
$craving6 = $_POST["craving6"];
$craving7 = $_POST["craving7"];
$craving8 = $_POST["craving8"];
$craving9 = $_POST["craving9"];
$craving10 = $_POST["craving10"];

$orientation1 = $_POST["orientation1"];
$orientation2 = $_POST["orientation2"];
$orientation3 = $_POST["orientation3"];
$orientation4 = $_POST["orientation4"];
$orientation5 = $_POST["orientation5"];
$orientation6 = $_POST["orientation6"];
$orientation7 = $_POST["orientation7"];
$orientation8 = $_POST["orientation8"];
$orientation9 = $_POST["orientation9"];
$orientation10 = $_POST["orientation10"];

$vis_dis_1 = $_POST["vis_dis_1"];
$vis_dis_2 = $_POST["vis_dis_2"];
$vis_dis_3 = $_POST["vis_dis_3"];
$vis_dis_4 = $_POST["vis_dis_4"];
$vis_dis_5 = $_POST["vis_dis_5"];
$vis_dis_6 = $_POST["vis_dis_6"];
$vis_dis_7 = $_POST["vis_dis_7"];
$vis_dis_8 = $_POST["vis_dis_8"];
$vis_dis_9 = $_POST["vis_dis_9"];
$vis_dis_10 = $_POST["vis_dis_10"];

$tactile1 = $_POST["tactile1"];
$tactile2 = $_POST["tactile2"];
$tactile3 = $_POST["tactile3"];
$tactile4 = $_POST["tactile4"];
$tactile5 = $_POST["tactile5"];
$tactile6 = $_POST["tactile6"];
$tactile7 = $_POST["tactile7"];
$tactile8 = $_POST["tactile8"];
$tactile9 = $_POST["tactile9"];
$tactile10 = $_POST["tactile10"];

$auditory1 = $_POST["auditory1"];
$auditory2 = $_POST["auditory2"];
$auditory3 = $_POST["auditory3"];
$auditory4 = $_POST["auditory4"];
$auditory5 = $_POST["auditory5"];
$auditory6 = $_POST["auditory6"];
$auditory7 = $_POST["auditory7"];
$auditory8 = $_POST["auditory8"];
$auditory9 = $_POST["auditory9"];
$auditory10 = $_POST["auditory10"];

$visual1 = $_POST["visual1"];
$visual2 = $_POST["visual2"];
$visual3 = $_POST["visual3"];
$visual4 = $_POST["visual4"];
$visual5 = $_POST["visual5"];
$visual6 = $_POST["visual6"];
$visual7 = $_POST["visual7"];
$visual8 = $_POST["visual8"];
$visual9 = $_POST["visual9"];
$visual10 = $_POST["visual10"];

$scores1 = $_POST["scores1"];
$scores2 = $_POST["scores2"];
$scores3 = $_POST["scores3"];
$scores4 = $_POST["scores4"];
$scores5 = $_POST["scores5"];
$scores6 = $_POST["scores6"];
$scores7 = $_POST["scores7"];
$scores8 = $_POST["scores8"];
$scores9 = $_POST["scores9"];
$scores10 = $_POST["scores10"];

$blood1 = $_POST["blood1"];
$blood2 = $_POST["blood2"];
$blood3 = $_POST["blood3"];
$blood4 = $_POST["blood4"];
$blood5 = $_POST["blood5"];
$blood6 = $_POST["blood6"];
$blood7 = $_POST["blood7"];
$blood8 = $_POST["blood8"];
$blood9 = $_POST["blood9"];
$blood10 = $_POST["blood10"];

$pulse1 = $_POST["pulse1"];
$pulse2 = $_POST["pulse2"];
$pulse3 = $_POST["pulse3"];
$pulse4 = $_POST["pulse4"];
$pulse5 = $_POST["pulse5"];
$pulse6 = $_POST["pulse6"];
$pulse7 = $_POST["pulse7"];
$pulse8 = $_POST["pulse8"];
$pulse9 = $_POST["pulse9"];
$pulse10 = $_POST["pulse10"];

$temperature1 = $_POST["temperature1"];
$temperature2 = $_POST["temperature2"];
$temperature3 = $_POST["temperature3"];
$temperature4 = $_POST["temperature4"];
$temperature5 = $_POST["temperature5"];
$temperature6 = $_POST["temperature6"];
$temperature7 = $_POST["temperature7"];
$temperature8 = $_POST["temperature8"];
$temperature9 = $_POST["temperature9"];
$temperature10 = $_POST["temperature10"];

$respirations1 = $_POST["respirations1"];
$respirations2 = $_POST["respirations2"];
$respirations3 = $_POST["respirations3"];
$respirations4 = $_POST["respirations4"];
$respirations5 = $_POST["respirations5"];
$respirations6 = $_POST["respirations6"];
$respirations7 = $_POST["respirations7"];
$respirations8 = $_POST["respirations8"];
$respirations9 = $_POST["respirations9"];
$respirations10 = $_POST["respirations10"];

$size1 = $_POST["size1"];
$size2 = $_POST["size2"];
$size3 = $_POST["size3"];
$size4 = $_POST["size4"];
$size5 = $_POST["size5"];
$size6 = $_POST["size6"];
$size7 = $_POST["size7"];
$size8 = $_POST["size8"];
$size9 = $_POST["size9"];
$size10 = $_POST["size10"];

$reaction1 = $_POST["reaction1"];
$reaction2 = $_POST["reaction2"];
$reaction3 = $_POST["reaction3"];
$reaction4 = $_POST["reaction4"];
$reaction5 = $_POST["reaction5"];
$reaction6 = $_POST["reaction6"];
$reaction7 = $_POST["reaction7"];
$reaction8 = $_POST["reaction8"];
$reaction9 = $_POST["reaction9"];
$reaction10 = $_POST["reaction10"];

$medication1 = $_POST["medication1"];
$medication2 = $_POST["medication2"];
$medication3 = $_POST["medication3"];
$medication4 = $_POST["medication4"];
$medication5 = $_POST["medication5"];
$medication6 = $_POST["medication6"];
$medication7 = $_POST["medication7"];
$medication8 = $_POST["medication8"];
$medication9 = $_POST["medication9"];
$medication10 = $_POST["medication10"];

$nurse1 = $_POST["nurse1"];
$nurse2 = $_POST["nurse2"];
$nurse3 = $_POST["nurse3"];
$nurse4 = $_POST["nurse4"];
$nurse5 = $_POST["nurse5"];
$nurse6 = $_POST["nurse6"];
$nurse7 = $_POST["nurse7"];
$nurse8 = $_POST["nurse8"];
$nurse9 = $_POST["nurse9"];
$nurse10 = $_POST["nurse10"];


if ($id && $id != 0) {
    sqlStatement("UPDATE `form_CIWA_AMP` SET `pid`=?,`encounter`=?,`name`=?,`dob`=?,`male_female`=?,`male_female1`=?,`rating0`=?,`rating1`=?,`rating2`=?,`rating3`=?,`rating4`=?,`rating5`=?,`rating6`=?,`rating7`=?,`dobs`=?,`times`=?,
    `date1`=?,`date2`=?,`date3`=?,`date4`=?,`date5`=?, `date6`=?,`date7`=?,`date8`=?,`date9`=?,`date10`=?, `time1`=?,`time2`=?,`time3`=?,`time4`=?,`time5`=?,`time6`=?,`time7`=?,`time8`=?,`time9`=?,`time10`=?,`bal1`=?,`bal2`=?,`bal3`=?,`bal4`=?,`bal5`=?,`bal6`=?,`bal7`=?,`bal8`=?,`bal9`=?,`bal10`=?,`agitation1`=?,`agitation2`=?,`agitation3`=?,`agitation4`=?,`agitation5`=?,`agitation6`=?,`agitation7`=?,`agitation8`=?,`agitation9`=?,`agitation10`=?,`paranoia1`=?,`paranoia2`=?,`paranoia3`=?,`paranoia4`=?,`paranoia5`=?,`paranoia6`=?,`paranoia7`=?,`paranoia8`=?,`paranoia9`=?,`paranoia10`=?,`paroxysmal1`=?,`paroxysmal2`=?,`paroxysmal3`=?,`paroxysmal4`=?,`paroxysmal5`=?,`paroxysmal6`=?,`paroxysmal7`=?,`paroxysmal8`=?,`paroxysmal9`=?,`paroxysmal10`=?,`anxiety1`=?,`anxiety2`=?,`anxiety3`=?,`anxiety4`=?,`anxiety5`=?,`anxiety6`=?,`anxiety7`=?,`anxiety8`=?,`anxiety9`=?,`anxiety10`=?,`depression1`=?,`depression2`=?,`depression3`=?,`depression4`=?,`depression5`=?,`depression6`=?,`depression7`=?,`depression8`=?,`depression9`=?,`depression10`=?,`vis_dis_1`=?,`vis_dis_2`=?,`vis_dis_3`=?,`vis_dis_4`=?,`vis_dis_5`=?,`vis_dis_6`=?,`vis_dis_7`=?,`vis_dis_8`=?,`vis_dis_9`=?,`vis_dis_10`=?,`tactile1`=?,`tactile2`=?,`tactile3`=?,`tactile4`=?,`tactile5`=?,`tactile6`=?,`tactile7`=?,`tactile8`=?,`tactile9`=?,`tactile10`=?,`auditory1`=?,`auditory2`=?,`auditory3`=?,`auditory4`=?,`auditory5`=?,`auditory6`=?,`auditory7`=?,`auditory8`=?,`auditory9`=?,`auditory10`=?,`visual1`=?,`visual2`=?,`visual3`=?,`visual4`=?,`visual5`=?,`visual6`=?,`visual7`=?,`visual8`=?,`visual9`=?,`visual10`=?,`scores1`=?,`scores2`=?,`scores3`=?,`scores4`=?,`scores5`=?,`scores6`=?,`scores7`=?,`scores8`=?,`scores9`=?,`scores10`=?,`blood1`=?,`blood2`=?,`blood3`=?,`blood4`=?,`blood5`=?,`blood6`=?,`blood7`=?,`blood8`=?,`blood9`=?,`blood10`=?,`pulse1`=?,`pulse2`=?,`pulse3`=?,`pulse4`=?,`pulse5`=?,`pulse6`=?,`pulse7`=?,`pulse8`=?,`pulse9`=?,`pulse10`=?,`temperature1`=?,`temperature2`=?,`temperature3`=?,`temperature4`=?,`temperature5`=?,`temperature6`=?,`temperature7`=?,`temperature8`=?,`temperature9`=?,`temperature10`=?,`size1`=?,`size2`=?,`size3`=?,`size4`=?,`size5`=?,`size6`=?,`size7`=?,`size8`=?,`size9`=?,`size10`=?,`reaction1`=?,`reaction2`=?,`reaction3`=?,`reaction4`=?,`reaction5`=?,`reaction6`=?,`reaction7`=?,`reaction8`=?,`reaction9`=?,`reaction10`=?,`medication1`=?,`medication2`=?,`medication3`=?,`medication4`=?,`medication5`=?,`medication6`=?,`medication7`=?,`medication8`=?,`medication9`=?,`medication10`=?,`nurse1`=?,`nurse2`=?,`nurse4`=?,`nurse4`=?,`nurse5`=?,`nurse6`=?,`nurse7`=?,`nurse8`=?,`nurse9`=?,`nurse10`=?
    WHERE id = ?",array($_SESSION["pid"],$_SESSION["encounter"],$name,$dob,$male_female,$male_female1,
    $rating0,$rating1,$rating2,$rating3,$rating4,$rating5,$rating6,$rating7,
    $dobs,$times,
    $date1,$date2,$date3,$date4,$date5,$date6,$date7,$date8,$date9,$date10,
    $time1,$time2,$time3,$time4,$time5,$time6,$time7,$time8,$time9,$time10,
    $bal1,$bal2,$bal3,$bal4,$bal5,$bal6,$bal7,$bal8,$bal9,$bal10,$agitation1,$agitation2,$agitation3,$agitation4,$agitation5,$agitation6,$agitation7,$agitation8,$agitation9,$agitation10,$paranoia1,$paranoia2,$paranoia3,$paranoia4,$paranoia5,$paranoia6,$paranoia7,$paranoia8,$paranoia9,$paranoia10,$paroxysmal1,$paroxysmal2,$paroxysmal3,$paroxysmal4,$paroxysmal5,$paroxysmal6,$paroxysmal7,$paroxysmal8,$paroxysmal9,$paroxysmal10,$anxiety1,$anxiety2,$anxiety3,$anxiety4,$anxiety5,$anxiety6,$anxiety7,$anxiety8,$anxiety9,$anxiety10,$depression1,$depression2,$depression3,$depression4,$depression5,$depression6,$depression7,$depression8,$depression9,$depression10,$vis_dis_1,$vis_dis_2,$vis_dis_3,$vis_dis_4,$vis_dis_5,$vis_dis_6,$vis_dis_7,$vis_dis_8,$vis_dis_9,$vis_dis_10,$tactile1,$tactile2,$tactile3,$tactile4,$tactile5,$tactile6,$tactile7,$tactile8,$tactile9,$tactile10,$auditory1,$auditory2,$auditory3,$auditory4,$auditory5,$auditory6,$auditory7,$auditory8,$auditory9,$auditory10,$visual1,$visual2,$visual3,$visual4,$visual5,$visual6,$visual7,$visual8,$visual9,$visual10,$scores1,$scores2,$scores3,$scores4,$scores5,$scores6,$scores7,$scores8,$scores9,$scores10,$blood1,$blood2,$blood3,$blood4,$blood5,$blood6,$blood7,$blood8,$blood9,$blood10,$pulse1,$pulse2,$pulse3,$pulse4,$pulse5,$pulse6,$pulse7,$pulse8,$pulse9,$pulse10,$temperature1,$temperature2,$temperature3,$temperature4,$temperature5,$temperature6,$temperature7,$temperature8,$temperature9,$temperature10,$size1,$size2,$size3,$size4,$size5,$size6,$size7,$size8,$size9,$size10,$reaction1,$reaction2,$reaction3,$reaction4,$reaction5,$reaction6,$reaction7,$reaction8,$reaction9,$reaction10,$medication1,$medication2,$medication3,$medication4,$medication5,$medication6,$medication7,$medication8,$medication9,$medication10,$nurse1,$nurse2,$nurse3,$nurse4,$nurse5,$nurse6,$nurse7,$nurse8,$nurse9,$nurse10,$id));
}else
{
    $newid = sqlInsert("INSERT INTO `form_CIWA_AMP`(`pid`, `encounter`, `name`, `dob`, `male_female`,`male_female1`,
    `rating0`,`rating1`,`rating2`,`rating3`,`rating4`,`rating5`,`rating6`,`rating7`,
    `dobs`, `times`,
    `date1`, `date2`, `date3`, `date4`, `date5`, `date6`, `date7`, `date8`, `date9`, `date10`,
    `time1`, `time2`, `time3`, `time4`, `time5`, `time6`, `time7`, `time8`, `time9`, `time10`,
    `bal1`, `bal2`, `bal3`, `bal4`, `bal5`, `bal6`, `bal7`, `bal8`, `bal9`, `bal10`, `agitation1`, `agitation2`, `agitation3`, `agitation4`, `agitation5`, `agitation6`, `agitation7`, `agitation8`, `agitation9`, `agitation10`, `paranoia1`, `paranoia2`,`paranoia3`, `paranoia4`, `paranoia5`, `paranoia6`, `paranoia7`, `paranoia8`, `paranoia9`, `paranoia10`, `paroxysmal1`, `paroxysmal2`,`paroxysmal3`, `paroxysmal4`, `paroxysmal5`, `paroxysmal6`, `paroxysmal7`, `paroxysmal8`, `paroxysmal9`, `paroxysmal10`, `anxiety1`,`anxiety2`, `anxiety3`, `anxiety4`, `anxiety5`, `anxiety6`, `anxiety7`, `anxiety8`, `anxiety9`, `anxiety10`, `depression1`,`depression2`, `depression3`, `depression4`, `depression5`,  `depression6`, `depression7`, `depression8`, `depression9`, `depression10`, `vis_dis_1`, `vis_dis_2`, `vis_dis_3`, `vis_dis_4`, `vis_dis_5`, `vis_dis_6`, `vis_dis_7`, `vis_dis_8`, `vis_dis_9`,`vis_dis_10`, `tactile1`, `tactile2`, `tactile3`, `tactile4`, `tactile5`, `tactile6`, `tactile7`, `tactile8`, `tactile9`, `tactile10`,`auditory1`, `auditory2`, `auditory3`, `auditory4`, `auditory5`, `auditory6`, `auditory7`, `auditory8`, `auditory9`, `auditory10`,`visual1`, `visual2`, `visual3`, `visual4`, `visual5`, `visual6`, `visual7`, `visual8`, `visual9`, `visual10`, `scores1`, `scores2`, `scores3`, `scores4`, `scores5`, `scores6`, `scores7`, `scores8`, `scores9`, `scores10`, `blood1`, `blood2`, `blood3`, `blood4`, `blood5`, `blood6`, `blood7`, `blood8`, `blood9`, `blood10`, `pulse1`, `pulse2`, `pulse3`, `pulse4`, `pulse5`, `pulse6`, `pulse7`, `pulse8`, `pulse9`, `pulse10`, `temperature1`, `temperature2`, `temperature3`, `temperature4`, `temperature5`, `temperature6`, `temperature7`, `temperature8`, `temperature9`, `temperature10`, `size1`, `size2`, `size3`, `size4`, `size5`, `size6`, `size7`, `size8`, `size9`, `size10`, `reaction1`, `reaction2`, `reaction3`, `reaction4`, `reaction5`, `reaction6`, `reaction7`, `reaction8`, `reaction9`, `reaction10`, `medication1`, `medication2`, `medication3`, `medication4`, `medication5`, `medication6`, `medication7`, `medication8`,`medication9`, `medication10`, `nurse1`, `nurse2`, `nurse3`, `nurse4`, `nurse5`, `nurse6`, `nurse7`, `nurse8`, `nurse9`, `nurse10`)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",

    array($_SESSION["pid"],$_SESSION["encounter"],
    $name,$dob,$male_female,$male_female1,
    $rating0,$rating1,$rating2,$rating3,$rating4,$rating5,$rating6,$rating7,
    $dobs,$times,
    $date1,$date2,$date3,$date4,$date5,$date6,$date7,$date8,$date9,$date10,
    $time1,$time2,$time3,$time4,$time5,$time6,$time7,$time8,$time9,$time10,
    $bal1,$bal2,$bal3,$bal4,$bal5,$bal6,$bal7,$bal8,$bal9,$bal10,
    $agitation1,$agitation2,$agitation3,$agitation4,$agitation5,$agitation6,$agitation7,$agitation8,$agitation9,$agitation10,
    $paranoia1,$paranoia2,$paranoia3,$paranoia4,$paranoia5,$paranoia6,$paranoia7,$paranoia8,$paranoia9,$paranoia10,
    $paroxysmal1,$paroxysmal2,$paroxysmal3,$paroxysmal4,$paroxysmal5,$paroxysmal6,$paroxysmal7,$paroxysmal8,$paroxysmal9,$paroxysmal10,$anxiety1,$anxiety2,$anxiety3,$anxiety4,$anxiety5,$anxiety6,$anxiety7,$anxiety8,$anxiety9,$anxiety10,
    $depression1,$depression2,$depression3,$depression4,$depression5,$depression6,$depression7,$depression8,$depression9,$depression10,$vis_dis_1,$vis_dis_2,$vis_dis_3,$vis_dis_4,$vis_dis_5,$vis_dis_6,$vis_dis_7,$vis_dis_8,$vis_dis_9,$vis_dis_10,
    $tactile1,$tactile2,$tactile3,$tactile4,$tactile5,$tactile6,$tactile7,$tactile8,$tactile9,$tactile10,
    $auditory1,$auditory2,$auditory3,$auditory4,$auditory5,$auditory6,$auditory7,$auditory8,$auditory9,$auditory10,
    $visual1,$visual2,$visual3,$visual4,$visual5,$visual6,$visual7,$visual8,$visual9,$visual10,
    $scores1,$scores2,$scores3,$scores4,$scores5,$scores6,$scores7,$scores8,$scores9,$scores10,
    $blood1,$blood2,$blood3,$blood4,$blood5,$blood6,$blood7,$blood8,$blood9,$blood10,
    $pulse1,$pulse2,$pulse3,$pulse4,$pulse5,$pulse6,$pulse7,$pulse8,$pulse9,$pulse10,
    $temperature1,$temperature2,$temperature3,$temperature4,$temperature5,$temperature6,$temperature7,$temperature8,$temperature9,$temperature10,
    $size1,$size2,$size3,$size4,$size5,$size6,$size7,$size8,$size9,$size10,
    $reaction1,$reaction2,$reaction3,$reaction4,$reaction5,$reaction6,$reaction7,$reaction8,$reaction9,$reaction10,
    $medication1,$medication2,$medication3,$medication4,$medication5,$medication6,$medication7,$medication8,$medication9,$medication10,$nurse1,$nurse2,$nurse3,$nurse4,$nurse5,$nurse6,$nurse7,$nurse8,$nurse9,$nurse10));

    addForm($encounter, "CIWA AMP FORM", $newid, "CIWA_AMP",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
