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

// echo "test";
// die;

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$inp1=$_POST['inp1'];
$inp2=$_POST['inp2'];
$inp3=$_POST['inp3'];
$inp4=$_POST['inp4'];
$inp5=$_POST['inp5'];
$inp6=$_POST['inp6'];
$inp7=$_POST['inp7'];
$inp8=$_POST['inp8'];
$inp9=$_POST['inp9'];
$inp10=$_POST['inp10'];
$inp11=$_POST['inp11'];
$inp12=$_POST['inp12'];
$inp13=$_POST['inp13'];
$inp14=$_POST['inp14'];
$inp15=$_POST['inp15'];
$inp16=$_POST['inp16'];
$inp17=$_POST['inp17'];
$inp18=$_POST['inp18'];
$inp19=$_POST['inp19'];
$inp20=$_POST['inp20'];
$inp21=$_POST['inp21'];
$inp22=$_POST['inp22'];
$inp23=$_POST['inp23'];
$inp24=$_POST['inp24'];
$inp25=$_POST['inp25'];
$inp26=$_POST['inp26'];
$inp27=$_POST['inp27'];
$inp28=$_POST['inp28'];
$inp29=$_POST['inp29'];
$inp30=$_POST['inp30'];
$inp31=$_POST['inp31'];
$inp32=$_POST['inp32'];
$inp33=$_POST['inp33'];
$inp34=$_POST['inp34'];
$inp35=$_POST['inp35'];
$inp36=$_POST['inp36'];
$inp37=$_POST['inp37'];
$inp38=$_POST['inp38'];
$inp39=$_POST['inp39'];
$inp40=$_POST['inp40'];
$inp41=$_POST['inp41'];
$inp42=$_POST['inp42'];
$inp43=$_POST['inp43'];
$inp44=$_POST['inp44'];
$inp45=$_POST['inp45'];
$inp46=$_POST['inp46'];
$inp47=$_POST['inp47'];
$inp48=$_POST['inp48'];
$inp49=$_POST['inp49'];
$inp50=$_POST['inp50'];
$inp51=$_POST['inp51'];
$inp52=$_POST['inp52'];
$inp53=$_POST['inp53'];
$inp54=$_POST['inp54'];
$inp55=$_POST['inp55'];
$inp56=$_POST['inp56'];
$inp57=$_POST['inp57'];
$inp58=$_POST['inp58'];
$inp59=$_POST['inp59'];
$inp60=$_POST['inp60'];
$inp61=$_POST['inp61'];
$inp62=$_POST['inp62'];
$inp63=$_POST['inp63'];
$inp64=$_POST['inp64'];
$inp65=$_POST['inp65'];
$inp66=$_POST['inp66'];
$inp67=$_POST['inp67'];
$inp68=$_POST['inp68'];
$inp69=$_POST['inp69'];
$inp70=$_POST['inp70'];
$inp71=$_POST['inp71'];
$inp72=$_POST['inp72'];
$inp73=$_POST['inp73'];
$inp74=$_POST['inp74'];
$inp75=$_POST['inp75'];
$inp76=$_POST['inp76'];
$inp77=$_POST['inp77'];
$inp78=$_POST['inp78'];
$inp79=$_POST['inp79'];
$inp80=$_POST['inp80'];
$inp81=$_POST['inp81'];
$inp82=$_POST['inp82'];
$inp83=$_POST['inp83'];
$inp84=$_POST['inp84'];
$inp85=$_POST['inp85'];
$inp86=$_POST['inp86'];
$inp87=$_POST['inp87'];
$inp88=$_POST['inp88'];
$inp89=$_POST['inp89'];
$inp90=$_POST['inp90'];
$inp91=$_POST['inp91'];
$inp92=$_POST['inp92'];
$inp93=$_POST['inp93'];
$inp94=$_POST['inp94'];
$inp95=$_POST['inp95'];
$inp96=$_POST['inp96'];
$inp97=$_POST['inp97'];
$inp98=$_POST['inp98'];
$inp99=$_POST['inp99'];
$inp100=$_POST['inp100'];
$inp101=$_POST['inp101'];
$inp102=$_POST['inp102'];
$inp103=$_POST['inp103'];
$inp104=$_POST['inp104'];
$inp105=$_POST['inp105'];
$inp106=$_POST['inp106'];
$inp107=$_POST['inp107'];
$inp108=$_POST['inp108'];
$inp109=$_POST['inp109'];
$inp110=$_POST['inp110'];
$inp111=$_POST['inp111'];
$inp112=$_POST['inp112'];
$inp113=$_POST['inp113'];
$inp114=$_POST['inp114'];
$inp115=$_POST['inp115'];
$inp116=$_POST['inp116'];
$inp117=$_POST['inp117'];
$inp118=$_POST['inp118'];
$inp119=$_POST['inp119'];
$inp120=$_POST['inp120'];
$inp121=$_POST['inp121'];
$inp122=$_POST['inp122'];
$inp123=$_POST['inp123'];
$inp124=$_POST['inp124'];
$inp125=$_POST['inp125'];
$inp126=$_POST['inp126'];
$inp127=$_POST['inp127'];
$inp128=$_POST['inp128'];
$inp129=$_POST['inp129'];
$inp130=$_POST['inp130'];
$inp131=$_POST['inp131'];
$inp132=$_POST['inp132'];
$inp133=$_POST['inp133'];
$inp134=$_POST['inp134'];
$inp135=$_POST['inp135'];
$inp136=$_POST['inp136'];
$inp137=$_POST['inp137'];
$inp138=$_POST['inp138'];
$inp139=$_POST['inp139'];
$inp140=$_POST['inp140'];
$inp141=$_POST['inp141'];
$inp142=$_POST['inp142'];
$inp143=$_POST['inp143'];
$inp144=$_POST['inp144'];
$inp145=$_POST['inp145'];
$inp146=$_POST['inp146'];
$inp147=$_POST['inp147'];
$inp148=$_POST['inp148'];
$inp149=$_POST['inp149'];
$inp150=$_POST['inp150'];
$inp151=$_POST['inp151'];
$inp152=$_POST['inp152'];
$inp153=$_POST['inp153'];
$inp154=$_POST['inp154'];
$inp155=$_POST['inp155'];
$inp156=$_POST['inp156'];



if ($id && $id != 0) {
    sqlStatement("UPDATE form_medication_log SET `pid`= ?, `encounter`= ?, `inp1`= ?, `inp2`= ?, `inp3`= ?, `inp4`= ?, `inp5`= ?, `inp6`= ?, `inp7`= ?, `inp8`= ?, `inp9`= ?, `inp10`= ?, `inp11`= ?, `inp12`= ?, `inp13`= ?, `inp14`= ?, `inp15`= ?, `inp16`= ?, `inp17`= ?, `inp18`= ?, `inp19`= ?, `inp20`= ?, `inp21`= ?, `inp22`= ?, `inp23`= ?, `inp24`= ?, `inp25`= ?, `inp26`= ?, `inp27`= ?, `inp28`= ?, `inp29`= ?, `inp30`= ?, `inp31`= ?, `inp32`= ?, `inp33`= ?, `inp34`= ?, `inp35`= ?, `inp36`= ?, `inp37`= ?, `inp38`= ?, `inp39`= ?, `inp40`= ?, `inp41`= ?, `inp42`= ?, `inp43`= ?, `inp44`= ?, `inp45`= ?, `inp46`= ?, `inp47`= ?, `inp48`= ?, `inp49`= ?, `inp50`= ?, `inp51`= ?, `inp52`= ?, `inp53`= ?, `inp54`= ?, `inp55`= ?, `inp56`= ?, `inp57`= ?, `inp58`= ?, `inp59`= ?, `inp60`= ?, `inp61`= ?, `inp62`= ?, `inp63`= ?, `inp64`= ?, `inp65`= ?, `inp66`= ?, `inp67`= ?, `inp68`= ?, `inp69`= ?, `inp70`= ?, `inp71`= ?, `inp72`= ?, `inp73`= ?, `inp74`= ?, `inp75`= ?, `inp76`= ?, `inp77`= ?, `inp78`= ?, `inp79`= ?, `inp80`= ?, `inp81`= ?, `inp82`= ?, `inp83`= ?, `inp84`= ?, `inp85`= ?, `inp86`= ?, `inp87`= ?, `inp88`= ?, `inp89`= ?, `inp90`= ?, `inp91`= ?, `inp92`= ?, `inp93`= ?, `inp94`= ?, `inp95`= ?, `inp96`= ?, `inp97`= ?, `inp98`= ?, `inp99`= ?, `inp100`= ?, `inp101`= ?, `inp102`= ?, `inp103`= ?, `inp104`= ?, `inp105`= ?, `inp106`= ?, `inp107`= ?, `inp108`= ?, `inp109`= ?, `inp110`= ?, `inp111`= ?, `inp112`= ?, `inp113`= ?, `inp114`= ?, `inp115`= ?, `inp116`= ?, `inp117`= ?, `inp118`= ?, `inp119`= ?, `inp120`= ?, `inp121`= ?, `inp122`= ?, `inp123`= ?, `inp124`= ?, `inp125`= ?, `inp126`= ?, `inp127`= ?, `inp128`= ?, `inp129`= ?, `inp130`= ?, `inp131`= ?, `inp132`= ?, `inp133`= ?, `inp134`= ?, `inp135`= ?, `inp136`= ?, `inp137`= ?, `inp138`= ?, `inp139`= ?, `inp140`= ?, `inp141`= ?, `inp142`= ?, `inp143`= ?, `inp144`= ?, `inp145`= ?, `inp146`= ?, `inp147`= ?, `inp148`= ?, `inp149`= ?, `inp150`= ?, `inp151`= ?, `inp152`= ?, `inp153`= ?,`inp154`= ?,`inp155`= ?,`inp156`= ? WHERE id = ?", array($_SESSION["pid"],$_SESSION["encounter"],$inp1,$inp2,$inp3,$inp4,$inp5,$inp6,$inp7,$inp8,$inp9,$inp10,$inp11,$inp12,$inp13,$inp14,$inp15,$inp16,$inp17,$inp18,$inp19,$inp20,$inp21,$inp22,$inp23,$inp24,$inp25,$inp26,$inp27,$inp28,$inp29,$inp30,$inp31,$inp32,$inp33,$inp34,$inp35,$inp36,$inp37,$inp38,$inp39,$inp40,$inp41,$inp42,$inp43,$inp44,$inp45,$inp46,$inp47,$inp48,$inp49,$inp50,$inp51,$inp52,$inp53,$inp54,$inp55,$inp56,$inp57,$inp58,$inp59,$inp60,$inp61,$inp62,$inp63,$inp64,$inp65,$inp66,$inp67,$inp68,$inp69,$inp70,$inp71,$inp72,$inp73,$inp74,$inp75,$inp76,$inp77,$inp78,$inp79,$inp80,$inp81,$inp82,$inp83,$inp84,$inp85,$inp86,$inp87,$inp88,$inp89,$inp90,$inp91,$inp92,$inp93,$inp94,$inp95,$inp96,$inp97,$inp98,$inp99,$inp100,$inp101,$inp102,$inp103,$inp104,$inp105,$inp106,$inp107,$inp108,$inp109,$inp110,$inp111,$inp112,$inp113,$inp114,$inp115,$inp116,$inp117,$inp118,$inp119,$inp120,$inp121,$inp122,$inp123,$inp124,$inp125,$inp126,$inp127,$inp128,$inp129,$inp130,$inp131,$inp132,$inp133,$inp134,$inp135,$inp136,$inp137,$inp138,$inp139,$inp140,$inp141,$inp142,$inp143,$inp144,$inp145,$inp146,$inp147,$inp148,$inp149,$inp150,$inp151,$inp152,$inp153,$inp154,$inp155,$inp156,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO form_medication_log (`pid`, `encounter`, `inp1`, `inp2`, `inp3`, `inp4`, `inp5`, `inp6`, `inp7`, `inp8`, `inp9`, `inp10`, `inp11`, `inp12`, `inp13`, `inp14`, `inp15`, `inp16`, `inp17`, `inp18`, `inp19`, `inp20`, `inp21`, `inp22`, `inp23`, `inp24`, `inp25`, `inp26`, `inp27`, `inp28`, `inp29`, `inp30`, `inp31`, `inp32`, `inp33`, `inp34`, `inp35`, `inp36`, `inp37`, `inp38`, `inp39`, `inp40`, `inp41`, `inp42`, `inp43`, `inp44`, `inp45`, `inp46`, `inp47`, `inp48`, `inp49`, `inp50`, `inp51`, `inp52`, `inp53`, `inp54`, `inp55`, `inp56`, `inp57`, `inp58`, `inp59`, `inp60`, `inp61`, `inp62`, `inp63`, `inp64`, `inp65`, `inp66`, `inp67`, `inp68`, `inp69`, `inp70`, `inp71`, `inp72`, `inp73`, `inp74`, `inp75`, `inp76`, `inp77`, `inp78`, `inp79`, `inp80`, `inp81`, `inp82`, `inp83`, `inp84`, `inp85`, `inp86`, `inp87`, `inp88`, `inp89`, `inp90`, `inp91`, `inp92`, `inp93`, `inp94`, `inp95`, `inp96`, `inp97`, `inp98`, `inp99`, `inp100`, `inp101`, `inp102`, `inp103`, `inp104`, `inp105`, `inp106`, `inp107`, `inp108`, `inp109`, `inp110`, `inp111`, `inp112`, `inp113`, `inp114`, `inp115`, `inp116`, `inp117`, `inp118`, `inp119`, `inp120`, `inp121`, `inp122`, `inp123`, `inp124`, `inp125`, `inp126`, `inp127`, `inp128`, `inp129`, `inp130`, `inp131`, `inp132`, `inp133`, `inp134`, `inp135`, `inp136`, `inp137`, `inp138`, `inp139`, `inp140`, `inp141`, `inp142`, `inp143`, `inp144`, `inp145`, `inp146`, `inp147`, `inp148`, `inp149`, `inp150`, `inp151`, `inp152`, `inp153`, `inp154`, `inp155`, `inp156`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$inp1,$inp2,$inp3,$inp4,$inp5,$inp6,$inp7,$inp8,$inp9,$inp10,$inp11,$inp12,$inp13,$inp14,$inp15,$inp16,$inp17,$inp18,$inp19,$inp20,$inp21,$inp22,$inp23,$inp24,$inp25,$inp26,$inp27,$inp28,$inp29,$inp30,$inp31,$inp32,$inp33,$inp34,$inp35,$inp36,$inp37,$inp38,$inp39,$inp40,$inp41,$inp42,$inp43,$inp44,$inp45,$inp46,$inp47,$inp48,$inp49,$inp50,$inp51,$inp52,$inp53,$inp54,$inp55,$inp56,$inp57,$inp58,$inp59,$inp60,$inp61,$inp62,$inp63,$inp64,$inp65,$inp66,$inp67,$inp68,$inp69,$inp70,$inp71,$inp72,$inp73,$inp74,$inp75,$inp76,$inp77,$inp78,$inp79,$inp80,$inp81,$inp82,$inp83,$inp84,$inp85,$inp86,$inp87,$inp88,$inp89,$inp90,$inp91,$inp92,$inp93,$inp94,$inp95,$inp96,$inp97,$inp98,$inp99,$inp100,$inp101,$inp102,$inp103,$inp104,$inp105,$inp106,$inp107,$inp108,$inp109,$inp110,$inp111,$inp112,$inp113,$inp114,$inp115,$inp116,$inp117,$inp118,$inp119,$inp120,$inp121,$inp122,$inp123,$inp124,$inp125,$inp126,$inp127,$inp128,$inp129,$inp130,$inp131,$inp132,$inp133,$inp134,$inp135,$inp136,$inp137,$inp138,$inp139,$inp140,$inp141,$inp142,$inp143,$inp144,$inp145,$inp146,$inp147,$inp148,$inp149,$inp150,$inp151,$inp152,$inp153,$inp154,$inp155,$inp156));
    addForm($encounter, "Medication log form", $newid, "medication_log",  $_SESSION["pid"], $userauthorized);

}

formHeader("Redirecting....");
formJump();
formFooter();