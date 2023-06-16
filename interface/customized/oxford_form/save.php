<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

// use OpenEMR\Common\Csrf\CsrfUtils;

// if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
//     CsrfUtils::csrfNotVerified();
// }

// if (!$encounter) { // comes from globals.php
//     die(xlt("Internal error: we do not seem to be in an encounter!"));
// }
// echo 'HI';die;

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$membername=$_POST["name"];
$memberdob=$_POST["date"];
$memberid=$_POST["memberid"];
$memberaddress=$_POST["memberaddress"];
$membercity=$_POST["city"];
$memberstate=$_POST["state"];
$memberzipcode=$_POST["zipcode"];
$organisation1=$_POST["organizationname1"];
$organisation2=$_POST["organizationname2"];
$checkbox1=$_POST["checkbox1"];
$checkbox3=$_POST["checkbox3"];

$information1=$_POST["information1"];
$checkbox2=$_POST["checkbox2"];
$checkbox4=$_POST["checkbox4"];

$information2=$_POST["information2"];
$membersign=$_POST["signature1"];
$date1=$_POST["date1"];
$witnesssign=$_POST["signature2"];
$date2=$_POST["date2"];
$gname=$_POST["Gname"];
$gnumber=$_POST["Gnumber"];
$gaddress=$_POST["Gaddress"];
$gcity=$_POST["Gcity"];
$gstate=$_POST["Gstate"];
$gzipcode=$_POST["Gzipcode"];
$gsign=$_POST["Gsignature"];
$gdate=$_POST["Gdate"];
$text1=$_POST["text1"];



if ($id && $id != 0) {
    sqlStatement("UPDATE form_oxford SET  `Mname` =?, `Mdob`=?, `Mid`=?, `Maddress`=?, `Mcity`=?, 
    `Mstate`=?, `Mzipcode`=?, `org1`=?, `org2`=?,`checkbox1`=?,`checkbox3`=?, `information1`=?,`checkbox2`=?,`checkbox4`=?,`information2`=?,`Msign`=?,`date1`=?,`Wsign`=?,
    `date2`=?,`Gname`=?,`Gnumber`=?,`Gaddress`=?,`Gcity`=?,`Gstate`=?,`Gzipcode`=?,`Gsign`=?,`Gdate`=?,`text1`=? WHERE id = ?", array($membername,$memberdob,
    $memberid,$memberaddress,$membercity,$memberstate,$memberzipcode,$organisation1,$organisation2,$checkbox1,$checkbox3,$information1,$checkbox2,$checkbox4,$information2,$membersign,$date1,$witnesssign,$date2,$gname,$gnumber,$gaddress,$gcity,$gstate,$gzipcode,$gsign,$gdate,$text1,$id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_oxford`(`pid`,`encounter`, `Mname`, `Mdob`, `Mid`, `Maddress`, `Mcity`, `Mstate`, `Mzipcode`, `org1`, `org2`,`checkbox1`,`checkbox3`, `information1`,`checkbox2`,`checkbox4`, `information2`, `Msign`, `date1`, `Wsign`, `date2`, `Gname`, `Gnumber`, `Gaddress`, `Gcity`, `Gstate`, `Gzipcode`, `Gsign`, `Gdate`, `text1`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$encounter,$membername,$memberdob,
    $memberid,$memberaddress,$membercity,$memberstate,$memberzipcode,$organisation1,$organisation2,$checkbox1,$checkbox3,$information1,$checkbox2,$checkbox4,$information2,$membersign,$date1,$witnesssign,$date2,$gname,$gnumber,$gaddress,$gcity,$gstate,$gzipcode,$gsign,$gdate,$text1));
    addForm($encounter, "oxford Form", $newid, "oxford_form",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
