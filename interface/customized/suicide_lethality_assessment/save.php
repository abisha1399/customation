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
 
use OpenEMR\Common\Csrf\CsrfUtils;

if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}

if (!$encounter) { // comes from globals.php
    die(xlt("Internal error: we do not seem to be in an encounter!"));
}

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$check1=$_POST['check1'];
$suicidetext1=$_POST['suicidetext1'];
$check2=$_POST['check2'];
$suicidetext2=$_POST['suicidetext2'];
$check3=$_POST['check3'];
$suicidetext3=$_POST['suicidetext3'];
$check4=$_POST['check4'];
$suicidetext4=$_POST['suicidetext4'];
$check5=$_POST['check5'];
$suicidetext5=$_POST['suicidetext5']; 
$check6=$_POST['check6'];
$suicidetext6=$_POST['suicidetext6'];
$check7=$_POST['check7'];
$suicidetext7=$_POST['suicidetext7'];
$check8=$_POST['check8'];
$suicidetext8=$_POST['suicidetext8'];
$check9=$_POST['check9'];
$suicidetext9=$_POST['suicidetext9'];
$check10=$_POST['check10'];
$suicidetext10=$_POST['suicidetext10'];
$check11=$_POST['check11'];
$suicidetext11=$_POST['suicidetext11'];
$check12=$_POST['check12'];
$suicidetext12=$_POST['suicidetext12'];
$check13=$_POST['check13'];
$suicidetext13=$_POST['suicidetext13'];
$check14=$_POST['check14'];
$suicidetext14=$_POST['suicidetext14'];
$check15=$_POST['check15'];
$suicidetext15=$_POST['suicidetext15'];
$check16=$_POST['check16'];
$suicidetext16=$_POST['suicidetext16'];
$check17=$_POST['check17'];
$suicidetext17=$_POST['suicidetext17'];
$check18=$_POST['check18'];
$suicidetext18=$_POST['suicidetext18'];
$check19=$_POST['check19'];
$suicidetext19=$_POST['suicidetext19'];
$check20=$_POST['check20'];
$suicidetext20=$_POST['suicidetext20']; 
$check21=$_POST['check21']; 
$suicidetext21=$_POST['suicidetext21'];
$check22=$_POST['check22']; 
$suicidetext22=$_POST['suicidetext22'];
$check23=$_POST['check23']; 
$suicidetext23=$_POST['suicidetext23'];
$check24=$_POST['check24']; 
$suicidetext24=$_POST['suicidetext24'];
$check25=$_POST['check25']; 
$suicidetext25=$_POST['suicidetext25'];
$check26=$_POST['check26'];
$suicidetext26=$_POST['suicidetext26'];
$check27=$_POST['check27'];
$suicidetext27=$_POST['suicidetext27'];
$check28=$_POST['check28'];
$suicidetext28=$_POST['suicidetext28'];
$check29=$_POST['check29'];
$suicidetext29=$_POST['suicidetext29'];
$check30=$_POST['check30'];
$suicidetext30=$_POST['suicidetext30'];
$check31=$_POST['check31'];
$suicidetext31=$_POST['suicidetext31'];
$check32=$_POST['check32'];
$suicidetext32=$_POST['suicidetext32'];
$check33=$_POST['check33'];
$suicidetext33=$_POST['suicidetext33'];
$check34=$_POST['check34'];
$suicidetext34=$_POST['suicidetext34'];
$stressor=$_POST['stressor'];
$motivation=$_POST['motivation'];
// print_r($motivation);die;

    if ($id && $id != 0) {
    sqlStatement("UPDATE form_suicide_lethality_assessment SET check1=?,suicidetext1=?,check2=?,suicidetext2=?,check3=?,suicidetext3=?,check4=?,suicidetext4=?,check5=?,suicidetext5=?,check6=?,suicidetext6=?,check7=?,suicidetext7=?,check8=?,suicidetext8=?,check9=?,suicidetext9=?,check10=?,suicidetext10=?,check11=?,suicidetext11=?,check12=?,suicidetext12=?,check13=?,suicidetext13=?,check14=?,suicidetext14=?,check15=?,suicidetext15=?,check16=?,suicidetext16=?,check17=?,suicidetext17=?,check18=?,suicidetext18=?,check19=?,suicidetext19=?,check20=?,suicidetext20=?,check21=?,suicidetext21=?,check22=?,suicidetext22=?,check23=?,suicidetext23=?,check24=?,suicidetext24=?,check25=?,suicidetext25=?,check26=?,suicidetext26=?,check27=?,suicidetext27=?,check28=?,suicidetext28=?,check29=?,suicidetext29=?,check30=?,suicidetext30=?,check31=?,suicidetext31=?,check32=?,suicidetext32=?,check33=?,suicidetext33=?,check34=?,suicidetext34=?,stressor=?,motivation=? WHERE id = ?",
    array($check1,$suicidetext1,$check2,$suicidetext2,$check3,$suicidetext3,$check4,$suicidetext4,$check5,$suicidetext5,$check6,$suicidetext6,$check7,$suicidetext7,$check8,$suicidetext8,$check9,$suicidetext9,$check10,$suicidetext10,$check11,$suicidetext11,$check12,$suicidetext12,$check13,$suicidetext13,$check14,$suicidetext14,$check15,$suicidetext15,$check16,$suicidetext16,$check17,$suicidetext17,$check18,$suicidetext18,$check19,$suicidetext19,$check20,$suicidetext20,$check21,$suicidetext21,$check22,$suicidetext22,$check23,$suicidetext23,$check24,$suicidetext24,$check25,$suicidetext25,$check26,$suicidetext26,$check27,$suicidetext27,$check28,$suicidetext28,$check29,$suicidetext29,$check30,$suicidetext30,$check31,$suicidetext31,$check32,$suicidetext32,$check33,$suicidetext33,$check34,$suicidetext34,$stressor,$motivation,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_suicide_lethality_assessment(pid,encounter,check1,suicidetext1,check2,suicidetext2,check3,suicidetext3,check4,suicidetext4,check5,suicidetext5,check6,suicidetext6,check7,suicidetext7,check8,suicidetext8,check9,suicidetext9,check10,suicidetext10,check11,suicidetext11,check12,suicidetext12,check13,suicidetext13,check14,suicidetext14,check15,suicidetext15,check16,suicidetext16,check17,suicidetext17,check18,suicidetext18,check19,suicidetext19,check20,suicidetext20,check21,suicidetext21,check22,suicidetext22,check23,suicidetext23,check24,suicidetext24,check25,suicidetext25,check26,suicidetext26,check27,suicidetext27,check28,suicidetext28,check29,suicidetext29,check30,suicidetext30,check31,suicidetext31,check32,suicidetext32,check33,suicidetext33,check34,suicidetext34,stressor,motivation)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$check1,$suicidetext1,$check2,$suicidetext2,$check3,$suicidetext3,$check4,$suicidetext4,$check5,$suicidetext5,$check6,$suicidetext6,$check7,$suicidetext7,$check8,$suicidetext8,$check9,$suicidetext9,$check10,$suicidetext10,$check11,$suicidetext11,$check12,$suicidetext12,$check13,$suicidetext13,$check14,$suicidetext14,$check15,$suicidetext15,$check16,$suicidetext16,$check17,$suicidetext17,$check18,$suicidetext18,$check19,$suicidetext19,$check20,$suicidetext20,$check21,$suicidetext21,$check22,$suicidetext22,$check23,$suicidetext23,$check24,$suicidetext24,$check25,$suicidetext25,$check26,$suicidetext26,$check27,$suicidetext27,$check28,$suicidetext28,$check29,$suicidetext29,$check30,$suicidetext30,$check31,$suicidetext31,$check32,$suicidetext32,$check33,$suicidetext33,$check34,$suicidetext34,$stressor,$motivation));
    addForm($encounter, "Suicide Lethality Assessment", $newid, "suicide_lethality_assessment",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();

if($id){
    $fid=$id;
}
else{
    $fid=$newid;
}


redirect($fid);

function redirect($fid) {
    header("Location: pdf_form.php?encounter={$_SESSION["encounter"]}&pid={$_SESSION["pid"]}&id={$fid}");
    exit();
}
