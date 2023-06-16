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

$patient = $_POST['patient'];
$dob = $_POST['dob'];
$allergy = $_POST['allergy'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$check1 = isset($_POST['check1'])?$_POST['check1']:'';
$check2 = isset($_POST['check2'])?$_POST['check2']:'';
$check3 = isset($_POST['check3'])?$_POST['check3']:'';
$othertext = $_POST['othertext'];
$adtext1 = $_POST['adtext1'];
$adtext2 = $_POST['adtext2'];
$adtext3 = $_POST['adtext3'];
$adtext4 = $_POST['adtext4'];
$check4 = $_POST['check4'];
$check5 = $_POST['check5'];
$check6 = $_POST['check6'];
$check7 = $_POST['check7'];
$check8 = $_POST['check8'];
$check9 = $_POST['check9'];
$check10 = $_POST['check10'];
$check11 = $_POST['check11'];
$check12 = $_POST['check12'];
$check13 = $_POST['check13'];
$check14 = $_POST['check14'];
$check15 = $_POST['check15'];
$check16 = $_POST['check16'];
$check17 = $_POST['check17'];
$check18 = $_POST['check18'];
$check19 = $_POST['check19'];
$check20 = $_POST['check20'];
$check21 = $_POST['check21'];
$check22 = $_POST['check22'];
$check23 = $_POST['check23'];
$check24 = $_POST['check24'];
$check25 = $_POST['check25'];
$check26 = $_POST['check26'];
$check27 = $_POST['check27'];
$check28 = $_POST['check28'];
$check29 = $_POST['check29'];
$check30 = $_POST['check30'];
$check31 = $_POST['check31'];
$check32 = $_POST['check32'];
$check33 = $_POST['check33'];
$check34 = $_POST['check34'];
$check35 = $_POST['check35'];
$check36 = $_POST['check36'];
$check37 = $_POST['check37'];
$check38 = $_POST['check38'];
$check39 = $_POST['check39'];
$check40 = $_POST['check40'];
$check41 = $_POST['check41'];
$check42 = $_POST['check42'];
$check43 = $_POST['check43'];
$check44 = $_POST['check44'];
$check45 = $_POST['check45'];
$check46 = $_POST['check46'];
$check47 = $_POST['check47'];
$check48 = $_POST['check48'];
$check49 = $_POST['check49'];
$check50 = $_POST['check50'];
$check51 = $_POST['check51'];
$check52 = $_POST['check52'];
$check53 = $_POST['check53'];
$rnsign = $_POST['rnsign'];
$rndate = $_POST['rndate'];
$rntime = $_POST['rntime'];
$physign = $_POST['physign'];
$phydate = $_POST['phydate'];
$phytime = $_POST['phytime'];
$phycheck1 = $_POST['phycheck1'];
$phycheck2 = $_POST['phycheck2'];
$phycheck3 = $_POST['phycheck3'];
$rnsign1 = $_POST['rnsign1'];
$rndate1 = $_POST['rndate1'];
$rntime1 = $_POST['rntime1'];
$physign1 = $_POST['physign1'];
$phydate1 = $_POST['phydate1'];
$phytime1 = $_POST['phytime1'];
$clocheck1 = $_POST['clocheck1'];
$clotext1 = $_POST['clotext1'];
$clotext2 = $_POST['clotext2'];
$clotext3 = $_POST['clotext3'];
$clotext4 = $_POST['clotext4'];
$clotext5 = $_POST['clotext5'];
$clocheck2 = $_POST['clocheck2'];
$rnsign2 = $_POST['rnsign2'];
$rndate2 = $_POST['rndate2'];
$rntime2 = $_POST['rntime2'];
$physign2 = $_POST['physign2'];
$phydate2 = $_POST['phydate2'];
$phytime2 = $_POST['phytime2'];
$libcheck1 = $_POST['libcheck1'];
$libcheck2 = $_POST['libcheck2'];
$libcheck3 = $_POST['libcheck3'];
$rnsign3 = $_POST['rnsign3'];
$rndate3 = $_POST['rndate3'];
$rntime3 = $_POST['rntime3'];
$physign3 = $_POST['physign3'];
$phydate3 = $_POST['phydate3'];
$phytime3 = $_POST['phytime3'];
$subcheck1 = $_POST['subcheck1'];
$subcheck2 = $_POST['subcheck2'];
$subcheck3 = $_POST['subcheck3'];
$subcheck4 = $_POST['subcheck4'];
$rnsign4 = $_POST['rnsign4'];
$rndate4 = $_POST['rndate4'];
$rntime4 = $_POST['rntime4'];
$physign4 = $_POST['physign4'];
$phydate4 = $_POST['phydate4'];
$phytime4 = $_POST['phytime4'];


if ($id && $id != 0) {
    sqlStatement(
        "UPDATE form_admission_orders SET patient=?,dob=?,allergy=?,height=?,weight=?,check1=?,check2=?,check3=?,othertext=?,adtext1=?,adtext2=?,adtext3=?,adtext4=?,check4=?,check5=?,check6=?,check7=?,check8=?,check9=?,check10=?,check11=?,check12=?,check13=?,check14=?,check15=?,check16=?,check17=?,check18=?,check19=?,check20=?,check21=?,check22=?,check23=?,check24=?,check25=?,check26=?,check27=?,check28=?,check29=?,check30=?,check31=?,check32=?,check33=?,check34=?,check35=?,check36=?,check37=?,check38=?, check39=?,check40=?,check41=?,check42=?,check43=?,check44=?,check45=?,check46=?,check47=?,check48=?,check49=?,check50=?,check51=?,check52=?,check53=?,rnsign=?,rndate=?,rntime=?, physign=?, phydate=?, phytime=?, phycheck1=?,phycheck2=?,phycheck3=?,rnsign1=?, rndate1=?, rntime1=?, physign1=?,phydate1=?,phytime1=?,clocheck1=?,clotext1=?,clotext2=?,clotext3=?,clotext4=?,clotext5=?,clocheck2=?,rnsign2=?,rndate2=?,rntime2=?,physign2=?,phydate2=?,phytime2=?,libcheck1=?,libcheck2=?,libcheck3=?,rnsign3=?, rndate3=?, rntime3=?, physign3=?,phydate3=?,phytime3=?,subcheck1=?,subcheck2=?,subcheck3=?,subcheck4=?,rnsign4=?,rndate4=?,rntime4=?,physign4=?,phydate4=?,phytime4=? WHERE id = ?",
        array(
            $patient, $dob, $allergy, $height, $weight, $check1, $check2, $check3, $othertext, $adtext1, $adtext2, $adtext3, $adtext4, $check4, $check5, $check6, $check7, $check8, $check9, $check10, $check11, $check12, $check13, $check14, $check15, $check16, $check17, $check18, $check19, $check20, $check21, $check22, $check23, $check24, $check25, $check26, $check27, $check28, $check29, $check30, $check31, $check32, $check33, $check34, $check35, $check36, $check37, $check38, $check39, $check40, $check41, $check42, $check43, $check44, $check45, $check46, $check47, $check48, $check49, $check50, $check51, $check52, $check53, $rnsign, $rndate, $rntime, $physign, $phydate, $phytime, $phycheck1, $phycheck2, $phycheck3, $rnsign1, $rndate1, $rntime1, $physign1, $phydate1, $phytime1, $clocheck1, $clotext1, $clotext2, $clotext3, $clotext4, $clotext5, $clocheck2, $rnsign2, $rndate2, $rntime2, $physign2, $phydate2, $phytime2, $libcheck1, $libcheck2, $libcheck3, $rnsign3, $rndate3, $rntime3, $physign3, $phydate3, $phytime3, $subcheck1, $subcheck2, $subcheck3, $subcheck4, $rnsign4, $rndate4, $rntime4, $physign4, $phydate4, $phytime4, $id
        )
    );
} else {
    $newid = sqlInsert(
        "INSERT INTO form_admission_orders(pid,encounter,patient,dob,allergy,height,weight,check1,check2,check3,othertext,adtext1,adtext2,adtext3,adtext4,check4,check5,check6,check7,check8,check9,check10,check11,check12,check13,check14,check15,check16,check17,check18,check19,check20,check21,check22,check23,check24,check25,check26,check27,check28,check29,check30,check31,check32,check33,check34,check35,check36,check37,check38,check39,check40,check41,check42,check43,check44,check45,check46,check47,check48,check49,check50,check51,check52,check53,rnsign,rndate,rntime, physign, phydate, phytime, phycheck1,phycheck2,phycheck3,rnsign1, rndate1, rntime1, physign1,phydate1,phytime1,clocheck1,clotext1,clotext2,clotext3,clotext4,clotext5,clocheck2,rnsign2,rndate2,rntime2,physign2,phydate2,phytime2,libcheck1,libcheck2,libcheck3,rnsign3, rndate3, rntime3, physign3,phydate3,phytime3,subcheck1,subcheck2,subcheck3,subcheck4,rnsign4,rndate4,rntime4,physign4,phydate4,phytime4)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        array(
            $_SESSION["pid"], $_SESSION["encounter"], $patient, $dob, $allergy, $height, $weight, $check1, $check2, $check3, $othertext, $adtext1, $adtext2, $adtext3, $adtext4, $check4, $check5, $check6, $check7, $check8, $check9, $check10, $check11, $check12, $check13, $check14, $check15, $check16, $check17, $check18, $check19, $check20, $check21, $check22, $check23, $check24, $check25, $check26, $check27, $check28, $check29, $check30, $check31, $check32, $check33, $check34, $check35, $check36, $check37, $check38, $check39, $check40, $check41, $check42, $check43, $check44, $check45, $check46, $check47, $check48, $check49, $check50, $check51, $check52, $check53,
            $rnsign, $rndate, $rntime, $physign, $phydate, $phytime, $phycheck1, $phycheck2, $phycheck3, $rnsign1, $rndate1, $rntime1, $physign1, $phydate1, $phytime1, $clocheck1, $clotext1, $clotext2, $clotext3, $clotext4, $clotext5, $clocheck2, $rnsign2, $rndate2, $rntime2, $physign2, $phydate2, $phytime2, $libcheck1, $libcheck2, $libcheck3, $rnsign3, $rndate3, $rntime3, $physign3, $phydate3, $phytime3, $subcheck1, $subcheck2, $subcheck3, $subcheck4, $rnsign4, $rndate4, $rntime4, $physign4, $phydate4, $phytime4
        )
    );
    addForm($encounter, "Admission Orders", $newid, "admission_orders",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();

if ($id) {
    $fid = $id;
} else {
    $fid = $newid;
}


redirect($fid);

function redirect($fid)
{
    header("Location: pdf_form.php?encounter={$_SESSION["encounter"]}&pid={$_SESSION["pid"]}&id={$fid}");
    exit();
}
