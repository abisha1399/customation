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

//var_dump($_POST);exit;
$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$memberlname=$_POST['lname'];
$memberfname=$_POST['fname'];
$initial=$_POST['minitial'];
$memberdob=$_POST['dob'];
$address=$_POST['address'];
$city=$_POST['city'];
$state=$_POST['state'];
$zipcode=$_POST['zipcode'];
$pnumber=$_POST['pnumber'];
$inumber=$_POST['inumber'];
$gnumber=$_POST['gnumber'];
$checkbox1=$_POST['checkbox1'];
$cinput1=$_POST['cinput1'];
$checkbox2=$_POST['checkbox2'];
$cinput2=$_POST['cinput2'];
$checkbox3=$_POST['checkbox3'];
$cinput3=$_POST['cinput3'];
$checkbox4=$_POST['checkbox4'];
$cinput4=$_POST['cinput4'];
$checkbox4_1=$_POST['checkbox4_1'];
$cinput4_1=$_POST['cinput4_1'];
$checkbox5=$_POST['checkbox5'];
$cinput5=$_POST['cinput5'];
$checkbox6=$_POST['checkbox6'];
$checkbox7=$_POST['checkbox7'];
$checkbox8=$_POST['checkbox8'];
$checkbox9=$_POST['checkbox9'];
$checkbox10=$_POST['checkbox10'];
$checkbox11=$_POST['checkbox11'];
$checkbox12=$_POST['checkbox12'];
$checkbox13=$_POST['checkbox13'];
$checkbox14=$_POST['checkbox14'];
$checkbox15=$_POST['checkbox15'];
$checkbox16=$_POST['checkbox16'];
$checkbox17=$_POST['checkbox17'];
$checkbox18=$_POST['checkbox18'];
$checkbox19=$_POST['checkbox19'];
$checkbox20=$_POST['checkbox20'];
$checkbox21=$_POST['checkbox21'];
$checkbox22=$_POST['checkbox22'];
$checkbox26=$_POST['checkbox26'];
$checkbox27=$_POST['checkbox27'];
$checkbox28=$_POST['checkbox28'];
$checkbox29=$_POST['checkbox29'];
$cinput6=$_POST['cinput6'];
$checkbox30=$_POST['checkbox30'];
$checkbox31=$_POST['checkbox31'];
$checkbox32=$_POST['checkbox32'];
$checkbox33=$_POST['checkbox33'];
$checkbox34=$_POST['checkbox34'];
$checkbox35=$_POST['checkbox35'];
$checkbox36=$_POST['checkbox36'];
$checkbox37=$_POST['checkbox37'];
$checkbox38=$_POST['checkbox38'];
$checkbox39=$_POST['checkbox39'];
$checkbox40=$_POST['checkbox40'];
$cinput7=$_POST['cinput7'];
$checkbox41=$_POST['checkbox41'];
$cinput8=$_POST['cinput8'];
$checkbox42=$_POST['checkbox42'];
$cinput9=$_POST['cinput9'];
$checkbox43=$_POST['checkbox43'];
$cinput10=$_POST['cinput10'];
$checkbox44=$_POST['checkbox44'];
$cinput11=$_POST['cinput11'];
$checkbox45=$_POST['checkbox45'];
$cinput12=$_POST['cinput12'];
$checkbox46=$_POST['checkbox46'];
$cinput13=$_POST['cinput13'];
$checkbox47=$_POST['checkbox47'];
$checkbox48=$_POST['checkbox48'];
$checkbox49=$_POST['checkbox49'];
$checkbox50=$_POST['checkbox50'];
$checkbox51=$_POST['checkbox51'];
$signature=$_POST['signature'];
$date=$_POST['date'];
$lename=$_POST['lename'];
$lrelation=$_POST['lrelation'];
$laddress=$_POST['laddress'];
$lcity=$_POST['lcity'];
$lstate=$_POST['lstate'];
$lzipcode=$_POST['lzipcode'];
$signature2=$_POST['signature2'];
$date2=$_POST['date2'];
$text1=$_POST['text1'];
$text2=$_POST['text2'];







if ($id && $id != 0) {
    sqlStatement("UPDATE `form_member` SET  `lname`=?, `fname`=?, `minitial`=?, `dob`=?, `address`=?, `city`=?, `state`=?, `zipcode`=?, `pnumber`=?, `inumber`=?, `gnumber`=?, `checkbox1`=?, `cinput1`=?, `checkbox2`=?, `cinput2`=?, `checkbox3`=?, `cinput3`=?, `checkbox4`=?, `cinput4`=?, `checkbox4_1`=?, `cinput4_1`=?, `checkbox5`=?, `cinput5`=?, `checkbox6`=?, `checkbox7`=?, `checkbox8`=?, `checkbox9`=?, `checkbox10`=?, `checkbox11`=?, `checkbox12`=?, `checkbox13`=?, `checkbox14`=?, `checkbox15`=?, `checkbox16`=?, `checkbox17`=?, `checkbox18`=?, `checkbox19`=?, `checkbox20`=?, `checkbox21`=?, `checkbox22`=?, `checkbox26`=?, `checkbox27`=?, `checkbox28`=?, `checkbox29`=?, `cinput6`=?, `checkbox30`=?, `checkbox31`=?, `checkbox32`=?, `checkbox33`=?, `checkbox34`=?, `checkbox35`=?, `checkbox36`=?, `checkbox37`=?, `checkbox38`=?, `checkbox39`=?, `checkbox40`=?, `cinput7`=?, `checkbox41`=?, `cinput8`=?, `checkbox42`=?, `cinput9`=?, `checkbox43`=?, `cinput10`=?, `checkbox44`=?, `cinput11`=?, `checkbox45`=?, `cinput12`=?, `checkbox46`=?, `cinput13`=?, `checkbox47`=?, `checkbox48`=?, `checkbox49`=?, `checkbox50`=?, `checkbox51`=?, `signature`=?, `date`=?, `lename`=?, `lrelation`=?, `laddress`=?, `lcity`=?, `lstate`=?, `lzipcode`=?, `signature2`=?, `date2`=?, `text1`=?, `text2`=? WHERE id =?", array($memberlname,$memberfname,$initial,$memberdob,$address ,$city,$state,$zipcode,$pnumber,$inumber,$gnumber,$checkbox1 ,$cinput1,$checkbox2 ,$cinput2,$checkbox3,$cinput3,$checkbox4 ,$cinput4,$checkbox4_1 ,$cinput4_1 ,$checkbox5 ,$cinput5 ,$checkbox6 ,$checkbox7 ,$checkbox8 ,$checkbox9 ,$checkbox10,$checkbox11,$checkbox12,$checkbox13,$checkbox14,$checkbox15,$checkbox16,$checkbox17,$checkbox18,$checkbox19,$checkbox20,$checkbox21,$checkbox22,$checkbox26,$checkbox27,$checkbox28,$checkbox29,$cinput6 ,$checkbox30,$checkbox31,$checkbox32,$checkbox33,$checkbox34,$checkbox35,$checkbox36,$checkbox37,$checkbox38,$checkbox39,$checkbox40,$cinput7 ,$checkbox41,$cinput8 ,$checkbox42,$cinput9 ,$checkbox43,$cinput10,$checkbox44,$cinput11,$checkbox45,$cinput12,$checkbox46,$cinput13,$checkbox47,$checkbox48,$checkbox49,$checkbox50,$checkbox51,$signature ,$date,$lename,$lrelation ,$laddress,$lcity,$lstate,$lzipcode,$signature2,$date2,$text1,$text2,$id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_member`( `pid`, `encounter`, `lname`, `fname`, `minitial`, `dob`, `address`, `city`, `state`, `zipcode`, `pnumber`, `inumber`, `gnumber`, `checkbox1`, `cinput1`, `checkbox2`, `cinput2`, `checkbox3`, `cinput3`, `checkbox4`, `cinput4`, `checkbox4_1`, `cinput4_1`, `checkbox5`, `cinput5`, `checkbox6`, `checkbox7`, `checkbox8`, `checkbox9`, `checkbox10`, `checkbox11`, `checkbox12`, `checkbox13`, `checkbox14`, `checkbox15`, `checkbox16`, `checkbox17`, `checkbox18`, `checkbox19`, `checkbox20`, `checkbox21`, `checkbox22`, `checkbox26`, `checkbox27`, `checkbox28`, `checkbox29`, `cinput6`, `checkbox30`, `checkbox31`, `checkbox32`, `checkbox33`, `checkbox34`, `checkbox35`, `checkbox36`, `checkbox37`, `checkbox38`, `checkbox39`, `checkbox40`, `cinput7`, `checkbox41`, `cinput8`, `checkbox42`, `cinput9`, `checkbox43`, `cinput10`, `checkbox44`, `cinput11`, `checkbox45`, `cinput12`, `checkbox46`, `cinput13`, `checkbox47`, `checkbox48`, `checkbox49`, `checkbox50`, `checkbox51`, `signature`, `date`, `lename`, `lrelation`, `laddress`, `lcity`, `lstate`, `lzipcode`, `signature2`, `date2`, `text1`, `text2`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$memberlname,$memberfname,$initial,$memberdob,$address ,$city,$state,$zipcode,$pnumber,$inumber,$gnumber,$checkbox1 ,$cinput1,$checkbox2 ,$cinput2,$checkbox3,$cinput3,$checkbox4 ,$cinput4,$checkbox4_1 ,$cinput4_1 ,$checkbox5 ,$cinput5 ,$checkbox6 ,$checkbox7 ,$checkbox8 ,$checkbox9 ,$checkbox10,$checkbox11,$checkbox12,$checkbox13,$checkbox14,$checkbox15,$checkbox16,$checkbox17,$checkbox18,$checkbox19,$checkbox20,$checkbox21,$checkbox22,$checkbox26,$checkbox27,$checkbox28,$checkbox29,$cinput6 ,$checkbox30,$checkbox31,$checkbox32,$checkbox33,$checkbox34,$checkbox35,$checkbox36,$checkbox37,$checkbox38,$checkbox39,$checkbox40,$cinput7 ,$checkbox41,$cinput8 ,$checkbox42,$cinput9 ,$checkbox43,$cinput10,$checkbox44,$cinput11,$checkbox45,$cinput12,$checkbox46,$cinput13,$checkbox47,$checkbox48,$checkbox49,$checkbox50,$checkbox51,$signature ,$date,$lename,$lrelation ,$laddress,$lcity,$lstate,$lzipcode,$signature2,$date2,$text1,$text2));
    addForm($encounter, "Member form", $newid, "form_member",  $_SESSION["pid"], $userauthorized);
}

























formHeader("Redirecting....");
formJump();
formFooter();

