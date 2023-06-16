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

$date=$_POST['date'];
$lname=$_POST['lname'];
$fname=$_POST['fname'];
$date1=$_POST['date1'];
$allergy=$_POST['allergy'];
$diagnosis=$_POST['diagnosis'];
$compliant=$_POST['compliant'];
$bp=$_POST['bp'];
$hr=$_POST['hr'];
$rr=$_POST['rr'];
$temp=$_POST['temp'];
$sat=$_POST['sat'];
$ok1=$_POST["ok1"];
$prob1=$_POST['prob1'];
$action1=$_POST['action1'];
$ok2=$_POST['ok2'];
$prob2=$_POST['prob2'];
$action2=$_POST['action2'];
$ok3=$_POST['ok3'];
$prob3=$_POST['prob3'];
$action3=$_POST['action3'];
$ok4=$_POST["ok4"];
$prob4=$_POST['prob4'];
$action4=$_POST['action4'];
$ok5=$_POST["ok5"];
$prob5=$_POST['prob5'];
$action5=$_POST['action5'];
$ok6=$_POST["ok6"];
$prob6=$_POST['prob6'];
$action6=$_POST['action6'];
$ok7=$_POST["ok7"];
$prob7=$_POST['prob7'];
$action7=$_POST['action7'];
$ok8=$_POST["ok8"];
$prob8=$_POST['prob8'];
$action8=$_POST['action8'];
$ok9=$_POST["ok9"];
$prob9=$_POST['prob9'];
$action9=$_POST['action9'];
$ok10=$_POST["ok10"];
$prob10=$_POST['prob10'];
$action10=$_POST['action10'];
$ok11=$_POST["ok11"];
$prob11=$_POST['prob11'];
$action11=$_POST['action11'];
$ok12=$_POST["ok12"];
$prob12=$_POST['prob12'];
$action12=$_POST['action12'];
$ok13=$_POST["ok13"];
$prob13=$_POST['prob13'];
$action13=$_POST['action13'];
$ok14=$_POST["ok14"];
$prob14=$_POST['prob14'];
$action14=$_POST['action14'];
$ok15=$_POST["ok15"];
$prob15=$_POST['prob15'];
$action15=$_POST['action15'];
$check1=isset($_POST['check1'])?$_POST['check1']:'';
$check2=isset($_POST['check2'])?$_POST['check2']:'';
$check3=isset($_POST['check3'])?$_POST['check3']:'';
$check4=isset($_POST['check4'])?$_POST['check4']:'';
$check5=isset($_POST['check5'])?$_POST['check5']:'';
$check6=isset($_POST['check6'])?$_POST['check6']:'';
$check7=isset($_POST['check7'])?$_POST['check7']:'';
$check8=isset($_POST['check8'])?$_POST['check8']:'';
$check9=isset($_POST['check9'])?$_POST['check9']:'';
$check10=isset($_POST['check10'])?$_POST['check10']:'';
$check11=isset($_POST['check11'])?$_POST['check11']:'';
$check12=isset($_POST['check12'])?$_POST['check12']:'';
$check13=isset($_POST['check13'])?$_POST['check13']:'';
$check14=isset($_POST['check14'])?$_POST['check14']:'';
$check15=isset($_POST['check15'])?$_POST['check15']:'';
$check16=isset($_POST['check16'])?$_POST['check16']:'';
$check17=isset($_POST['check17'])?$_POST['check17']:'';
$check18=isset($_POST['check18'])?$_POST['check18']:'';
$check19=isset($_POST['check19'])?$_POST['check19']:'';
$check20=isset($_POST['check20'])?$_POST['check20']:'';
$check21=isset($_POST['check21'])?$_POST['check21']:'';
$check22=isset($_POST['check22'])?$_POST['check22']:'';
$check23=isset($_POST['check23'])?$_POST['check23']:'';
$check24=isset($_POST['check24'])?$_POST['check24']:'';
$check25=isset($_POST['check25'])?$_POST['check25']:'';
$check26=isset($_POST['check26'])?$_POST['check26']:'';
$signatures=$_POST['signatures'];
$date2=$_POST['date2'];
$signtime=$_POST['signtime'];
$check27=isset($_POST['check27'])?$_POST['check27']:'';
$check28=isset($_POST['check28'])?$_POST['check28']:'';
$atsign=$_POST['atsign'];
$date3=$_POST['date3'];
$attime=$_POST['attime'];
    if ($id && $id != 0) {
    sqlStatement("UPDATE form_history_and_physical_evaluation SET date=?,lname=?,fname=?,date1=?,allergy=?,diagnosis=?,compliant=?,bp=?,hr=?,rr=?,temp=?,sat=?,ok1=?,prob1=?,action1=?,ok2=?,prob2=?,action2=?,ok3=?,prob3=?,action3=?,ok4=?,prob4=?,action4=?,ok5=?,prob5=?,action5=?,ok6=?,prob6=?,action6=?,ok7=?,prob7=?,action7=?,ok8=?,prob8=?,action8=?,ok9=?,prob9=?,action9=?,ok10=?,prob10=?,action10=?,ok11=?,prob11=?,action11=?,ok12=?,prob12=?,action12=?,ok13=?,prob13=?,action13=?,ok14=?,prob14=?,action14=?,ok15=?,prob15=?,action15=?,check1=?,check2=?,check3=?,check4=?,check5=?,check6=?,check7=?,check8=?,check9=?,check10=?, check11=?, check12=?,check13=?,check14=?,check15=?,check16=?,check17=?,check18=?,check19=?,check20=?,check21=?, check22=?,check23=?,check24=?,check25=?,check26=?,signatures=?,date2=?,signtime=?,check27=?,check28=?,atsign=?,date3=?,attime=? WHERE id = ?",
    array($date,$lname,$fname,$date1,$allergy,$diagnosis,$compliant,$bp,$hr,$rr,$temp,$sat,$ok1,$prob1,$action1,$ok2,$prob2,$action2,$ok3,$prob3,$action3,$ok4,$prob4,$action4,$ok5,$prob5,$action5,$ok6,$prob6,$action6,$ok7,$prob7,$action7,$ok8,$prob8,$action8,$ok9,$prob9,$action9,$ok10,$prob10,$action10,$ok11,$prob11,$action11,$ok12,$prob12,$action12,$ok13,$prob13,$action13,$ok14,$prob14,$action14,$ok15,$prob15,$action15,$check1,$check2,$check3,$check4,$check5,$check6,$check7,$check8,$check9,$check10,$check11,$check12,$check13,$check14,$check15,$check16,$check17,$check18,$check19,$check20,$check21,$check22,$check23,$check24,$check25,$check26,$signatures,$date2,$signtime,$check27,$check28,$atsign,$date3,$attime,$id));
}else
{
    $newid = sqlInsert("INSERT INTO form_history_and_physical_evaluation(pid,encounter,date,lname,fname,date1,allergy,diagnosis,compliant,bp,hr,rr,temp,sat,ok1,prob1,action1,ok2,prob2,action2,ok3,prob3,action3,ok4,prob4,action4,ok5,prob5,action5,ok6,prob6,action6,ok7,prob7,action7,ok8,prob8,action8,ok9,prob9,action9,ok10,prob10,action10,ok11,prob11,action11,ok12,prob12,action12,ok13,prob13,action13,ok14,prob14,action14,ok15,prob15,action15,check1,check2,check3,check4,check5,check6,check7,check8,check9,check10,check11,check12,check13,check14,check15,check16,check17,check18,check19,check20,check21,check22,check23,check24,check25,check26,signatures,date2,signtime,check27,check28,atsign,date3,attime)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$date,$lname,$fname,$date1,$allergy,$diagnosis,$compliant,$bp,$hr,$rr,$temp,$sat,$ok1,$prob1,$action1,$ok2,$prob2,$action2,$ok3,$prob3,$action3,$ok4,$prob4,$action4,$ok5,$prob5,$action5,$ok6,$prob6,$action6,$ok7,$prob7,$action7,$ok8,$prob8,$action8,$ok9,$prob9,$action9,$ok10,$prob10,$action10,$ok11,$prob11,$action11,$ok12,$prob12,$action12,$ok13,$prob13,$action13,$ok14,$prob14,$action14,$ok15,$prob15,$action15,$check1,$check2,$check3,$check4,$check5,$check6,$check7,$check8,$check9,$check10,$check11,$check12,$check13,$check14,$check15,$check16,$check17,$check18,$check19,$check20,$check21,$check22,$check23,$check24,$check25,$check26,$signatures,$date2,$signtime,$check27,$check28,$atsign,$date3,$attime));
    addForm($encounter, "History and Physical Evaluation", $newid, "history_and_physical_evaluation",  $_SESSION["pid"], $userauthorized);
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
