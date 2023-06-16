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

$date = $_POST["date"];
$toaddr = $_POST["toaddr"];
$fax = $_POST["fax"];
$fromaddr = $_POST["fromaddr"];
$subject = $_POST["subject"];
$page = $_POST["page"];
$name = $_POST["name"];
$ssn = $_POST["ssn"];
$dob = $_POST["dob"];
$subscriber = $_POST["subscriber"];
$relation = $_POST["relation"];
$employee = $_POST["employee"];
$coverage = $_POST["coverage"];
$check1 = $_POST["check1"];
$check2 = $_POST["check2"];
$auth = $_POST["auth"];
$determine = $_POST["determine"];
$addr = $_POST["addr"];
$member = $_POST["member"];
$patient = $_POST["patient"];
$patdate = $_POST["patdate"];
$minor = $_POST["minor"];
$consent = $_POST["consent"];
$guardian = $_POST["guardian"];
$guarddate = $_POST["guarddate"];
$relation1 = $_POST["relation1"];



if ($id && $id != 0) {
    sqlStatement("UPDATE form_facsimile_coversheet SET date =?, toaddr=?, fax=?, fromaddr=?,
    subject=?, page=?, 
    name=?,
    ssn=?,
    dob=?,
    subscriber=?,
    relation=?,
    employee=?,
    coverage=?,
    check1=?,
    check2=?,
    auth=?,
    determine=?,
    addr=?,
    member=?,
    patient=?,
    patdate=?,
    minor=?,
    consent=?,
    guardian=?,
    guarddate=?,
    relation1=? WHERE id = ?", 
    array($date,$toaddr,$fax,$fromaddr,$subject,$page,$name,$ssn,$dob,$subscriber,$relation,$employee,$coverage,$check1,$check2,$auth,$determine,$addr,$member,$patient,$patdate,$minor,$consent,$guardian,$guarddate,$relation1, $id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_facsimile_coversheet(pid,encounter,date,toaddr,fax,fromaddr,subject,page,name,ssn,dob,subscriber,relation,employee,coverage,check1,check2,auth,determine,addr,member,patient,patdate,minor,consent,guardian,guarddate,relation1)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$date,$toaddr,$fax,$fromaddr,$subject,$page,$name,$ssn,$dob,$subscriber,$relation,$employee,$coverage,$check1,$check2,$auth,$determine,$addr,$member,$patient,$patdate,$minor,$consent,$guardian,$guarddate,$relation1));
    addForm($encounter, "Blank IRO Form", $newid, "facsimile_cover_sheet",  $_SESSION["pid"], $userauthorized);
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

