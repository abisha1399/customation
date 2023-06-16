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

$name = $_POST["name"];
$date = $_POST["date"];
$first = $_POST["first"];
$second = $_POST["second"];
$third = $_POST["third"];
$client = $_POST["client"];
$dat = $_POST["dat"];
$signature = $_POST["signature"];
$datas = $_POST["datas"];
$auth = $_POST["auth"];
$witness = $_POST["witness"];
$dates = $_POST["dates"];
$text1 = $_POST["text1"];
$text2 = $_POST["text2"];
$text3 = $_POST["text3"];

if ($id && $id != 0) {
    sqlStatement("UPDATE consentform SET name =?, date=?, first=?, second=?, third=?, 
    client=?, dat=?, signature=?, datas=?, auth=?, witness=?, dates=?,text1=?,text2=?,text3=? WHERE id = ?", array($name,$date,$first,$second,$third,$client,$dat,$signature,$datas,$auth,$witness,$dates,$text1,$text2,$text3, $id));
}else 
{
    $newid = sqlInsert("INSERT INTO consentform (pid,encounter,name,date,first,second,third,client,dat,signature,datas,auth,witness,dates,text1,text2,text3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$name, $date,$first,$second,$third,$client,$dat,$signature,$datas,$auth,$witness,$dates,$text1,$text2,$text3));
    addForm($encounter, "IME Consent Form", $newid, "ime_consent_form",  $_SESSION["pid"], $userauthorized);
}
formHeader("Redirecting....");
formJump();
formFooter();
// if($id){
//     $fid=$id;
// }
// else{
//     $fid=$newid;
// }
// print_r($fid);die;

//redirect($fid);

// function redirect($fid) {
//     // echo 'Hi';die;
//     header("Location: pdf_form.php?encounter={$_SESSION["encounter"]}&pid={$_SESSION["pid"]}&id={$fid}");
//     exit();
// }

