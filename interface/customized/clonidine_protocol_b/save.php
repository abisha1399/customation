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

$allergy=$_POST['allergy'];
$patient=$_POST['patient'];
$date=$_POST['date'];
$clonidate1=$_POST['clonidate1'];
$cloninurse1=$_POST['cloninurse1'];
$clonidate2=$_POST['clonidate2'];
$cloninurse2=$_POST['cloninurse2'];
$clonidate3=$_POST['clonidate3'];
$cloninurse3=$_POST['cloninurse3']; 
$clonidate4=$_POST['clonidate4'];
$cloninurse4=$_POST['cloninurse4'];
$clonidate5=$_POST['clonidate5'];
$cloninurse5=$_POST['cloninurse5'];
$clonidate6=$_POST['clonidate6'];
$cloninurse6=$_POST['cloninurse6']; 
$clonidate7=$_POST['clonidate7'];
$cloninurse7=$_POST['cloninurse7'];
$clonidate8=$_POST['clonidate8'];
$cloninurse8=$_POST['cloninurse8'];
$clonidate9=$_POST['clonidate9'];
$cloninurse9=$_POST['cloninurse9']; 
$clonidate10=$_POST['clonidate10'];
$cloninurse10=$_POST['cloninurse10'];
$clonidate11=$_POST['clonidate11'];
$cloninurse11=$_POST['cloninurse11'];
$clonidate12=$_POST['clonidate12'];
$cloninurse12=$_POST['cloninurse12']; 
$clonidate13=$_POST['clonidate13'];
$cloninurse13=$_POST['cloninurse13'];
$clonidate14=$_POST['clonidate14'];
$cloninurse14=$_POST['cloninurse14'];
$clonidate15=$_POST['clonidate15'];
$cloninurse15=$_POST['cloninurse15']; 
$clonidate16=$_POST['clonidate16'];
$cloninurse16=$_POST['cloninurse16'];
$clonidate17=$_POST['clonidate17'];
$cloninurse17=$_POST['cloninurse17'];
$clonidate18=$_POST['clonidate18'];
$cloninurse18=$_POST['cloninurse18']; 
$clonidate19=$_POST['clonidate19'];
$cloninurse19=$_POST['cloninurse19'];
$clonidate20=$_POST['clonidate20'];
$cloninurse20=$_POST['cloninurse20'];
$clonidate21=$_POST['clonidate21'];
$cloninurse21=$_POST['cloninurse21']; 
$orderdate=$_POST['orderdate'];
$ptsign=$_POST['ptsign'];
$ptinitial=$_POST['ptinitial'];
$nurse=$_POST['nurse'];
$nursign=$_POST['nursign'];
$nurinitial=$_POST['nurinitial'];
$nursign1=$_POST['nursign1'];
$nurinitial1=$_POST['nurinitial1'];
$nursign2=$_POST['nursign2'];
$nurinitial2=$_POST['nurinitial2'];


    if ($id && $id != 0) {
    sqlStatement("UPDATE form_clonidine_protocol_b SET allergy=?,patient=?,date=?,clonidate1=?,cloninurse1=?,clonidate2=?,cloninurse2=?,clonidate3=?,cloninurse3=?,clonidate4=?,cloninurse4=?,clonidate5=?,cloninurse5=?,clonidate6=?,cloninurse6=?,clonidate7=?,cloninurse7=?,clonidate8=?,cloninurse8=?,clonidate9=?,cloninurse9=?,clonidate10=?,cloninurse10=?,clonidate11=?,cloninurse11=?,clonidate12=?,cloninurse12=?,clonidate13=?,cloninurse13=?,clonidate14=?,cloninurse14=?,clonidate15=?,cloninurse15=?,clonidate16=?,cloninurse16=?,clonidate17=?,cloninurse17=?,clonidate18=?,cloninurse18=?,clonidate19=?,cloninurse19=?,clonidate20=?,cloninurse20=?,clonidate21=?,cloninurse21=?,orderdate=?,ptsign=?,ptinitial=?,nurse=?,nursign=?,nurinitial=?,nursign1=?,nurinitial1=?,nursign2=?,nurinitial2=? WHERE id = ?",
    array($allergy,$patient,$date,$clonidate1,$cloninurse1,$clonidate2,$cloninurse2,$clonidate3,$cloninurse3,$clonidate4,$cloninurse4,$clonidate5,$cloninurse5,$clonidate6,$cloninurse6,$clonidate7,$cloninurse7,$clonidate8,$cloninurse8,$clonidate9,$cloninurse9,$clonidate10,$cloninurse10,$clonidate11,$cloninurse11,$clonidate12,$cloninurse12,$clonidate13,$cloninurse13,$clonidate14,$cloninurse14,$clonidate15,$cloninurse15,$clonidate16,$cloninurse16,$clonidate17,$cloninurse17,$clonidate18,$cloninurse18,$clonidate19,$cloninurse19,$clonidate20,$cloninurse20,$clonidate21,$cloninurse21,$orderdate,$ptsign,$ptinitial,$nurse,$nursign,$nurinitial,$nursign1,$nurinitial1,$nursign2,$nurinitial2,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO form_clonidine_protocol_b(pid,encounter,allergy,patient,date,clonidate1,cloninurse1,clonidate2,cloninurse2,clonidate3,cloninurse3,clonidate4,cloninurse4,clonidate5,cloninurse5,clonidate6,cloninurse6,clonidate7,cloninurse7,clonidate8,cloninurse8,clonidate9,cloninurse9,clonidate10,cloninurse10,clonidate11,cloninurse11,clonidate12,cloninurse12,clonidate13,cloninurse13,clonidate14,cloninurse14,clonidate15,cloninurse15,clonidate16,cloninurse16,clonidate17,cloninurse17,clonidate18,cloninurse18,clonidate19,cloninurse19,clonidate20,cloninurse20,clonidate21,cloninurse21,orderdate,ptsign,ptinitial,nurse,nursign,nurinitial,nursign1,nurinitial1,nursign2,nurinitial2)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$allergy,$patient,$date,$clonidate1,$cloninurse1,$clonidate2,$cloninurse2,$clonidate3,$cloninurse3,$clonidate4,$cloninurse4,$clonidate5,$cloninurse5,$clonidate6,$cloninurse6,$clonidate7,$cloninurse7,$clonidate8,$cloninurse8,$clonidate9,$cloninurse9,$clonidate10,$cloninurse10,$clonidate11,$cloninurse11,$clonidate12,$cloninurse12,$clonidate13,$cloninurse13,$clonidate14,$cloninurse14,$clonidate15,$cloninurse15,$clonidate16,$cloninurse16,$clonidate17,$cloninurse17,$clonidate18,$cloninurse18,$clonidate19,$cloninurse19,$clonidate20,$cloninurse20,$clonidate21,$cloninurse21,$orderdate,$ptsign,$ptinitial,$nurse,$nursign,$nurinitial,$nursign1,$nurinitial1,$nursign2,$nurinitial2));
    addForm($encounter, "Clonidine Protocol B", $newid, "clonidine_protocol_b",  $_SESSION["pid"], $userauthorized);
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
