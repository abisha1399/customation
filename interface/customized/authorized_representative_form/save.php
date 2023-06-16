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
$addr = $_POST["addr"];
$subscribe = $_POST["subscribe"];
$date = $_POST["date"];
$home = $_POST["home"];
$identify = $_POST["identify"];
$sign = $_POST["sign"];
$par = $_POST["par"];
$witness = $_POST["witness"];
$date1 = $_POST["date1"];
$design = $_POST["design"];
$relation = $_POST["relation"];
$street = $_POST["street"];
$city = $_POST["city"];
$phone = $_POST["phone"];
$phone1 = $_POST['phone1'];
$date2= $_POST['date2'];
$txt1= $_POST['txt1'];
$txt2= $_POST['txt2'];



if ($id && $id != 0) {
    sqlStatement("UPDATE form_authorized SET name =?, addr=?, subscribe=?, date=?, home=?, 
    identify=?,sign=?, 
    par=?,
    witness=?,
    date1=?,
    design=?,
    relation=?,
    street=?,
    city=?,
    phone=?,
    phone1=?,
    date2=?,
    txt1=?,
    txt2=? WHERE id = ?", 
    array($name,
    $addr,
    $subscribe,
    $date,
    $home,
    $identify,
    $sign,
    $par,
    $witness,
    $date1,
    $design,
    $relation,
    $street,
    $city,
    $phone,
    $phone1,
    $date2,
    $txt1,
    $txt2, $id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_authorized(pid,encounter,name,addr,subscribe,date,home,identify,sign,par,witness,date1,design,relation,street,city,phone,phone1,date2,txt1,txt2)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$name,
    $addr,
    $subscribe,
    $date,
    $home,
    $identify,
    $sign,
    $par,
    $witness,
    $date1,
    $design,
    $relation,
    $street,
    $city,
    $phone,
    $phone1,
    $date2,
    $txt1,
    $txt2,));
    addForm($encounter, "Beacon Health Consent", $newid, "authorized_representative_form",  $_SESSION["pid"], $userauthorized);
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

