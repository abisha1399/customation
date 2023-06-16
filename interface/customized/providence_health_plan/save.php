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
//var_dump($_POST["text1"]);exit;

$appoin = $_POST["appoin"];
$name = $_POST["name"];
$member = $_POST["member"];
$groups = $_POST["group"];
$first = $_POST["first"];
$second = $_POST["second"];
$third = $_POST["third"];
$sign = $_POST["sign"];
$date = $_POST["date"];
$name1 = $_POST["name1"];
$member1 = $_POST["member1"];
$group1 = $_POST["group1"];
$fourth = $_POST["fourth"];
$fifth = $_POST["fifth"];
$provider = $_POST["provider"];
$print = $_POST["print"];
$dat = $_POST["dat"];
$text1 = $_POST["text1"];
$text2 = $_POST["text2"];


if ($id && $id != 0) {
    sqlStatement("UPDATE form_providence_healthplan SET appoin =?, name=?, member=?, groups=?,
    first=?, second=?, 
    third=?,
    sign=?,
    date=?,
    name1=?,
    member1=?,
    group1=?,
    fourth=?,
    fifth=?,
    provider=?,
    print=?,
    dat=?,
    text1=?,
    text2=? WHERE id = ?", 
    array($appoin,$name,$member,$groups,$first,$second,$third,$sign,$date,$name1,$member1,$group1,$fourth,$fifth,$provider,$print,$dat,$text1,$text2, $id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_providence_healthplan(pid,encounter,appoin,name,member,groups,first,second,third,sign,date,name1,member1,group1,fourth,fifth,provider,print,dat,text1,text2)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$appoin,$name,$member,$groups,$first,$second,$third,$sign,$date,$name1,$member1,$group1,$fourth,$fifth,$provider,$print,$dat,$text1,$text2));
    addForm($encounter, "Member Consent For UBH", $newid, "providence_health_plan",  $_SESSION["pid"], $userauthorized);
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

