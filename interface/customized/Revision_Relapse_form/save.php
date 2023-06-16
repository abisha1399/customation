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

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$pname=$_POST["pname"];
$DOB=$_POST["DOB"];
$input1=$_POST["input1"];
$checkboxA1=$_POST["checkboxA1"];
$checkboxA2=$_POST["checkboxA2"];
$checkboxA3=$_POST["checkboxA3"];
$checkboxA4=$_POST["checkboxA4"];
$checkbox1=$_POST['checkbox1'];
$checkbox2=$_POST['checkbox2'];
$checkbox3=$_POST['checkbox3'];
$checkbox4=$_POST['checkbox4'];
$checkbox5=$_POST['checkbox5'];
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
$checkbox23=$_POST['checkbox23'];
$checkbox24=$_POST['checkbox24'];
$checkbox25=$_POST['checkbox25'];
$checkbox26=$_POST['checkbox26'];
$checkbox27=$_POST['checkbox27'];
$checkbox28=$_POST['checkbox28'];
$checkbox29=$_POST['checkbox29'];
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
$checkbox41=$_POST['checkbox41'];
$checkbox42=$_POST['checkbox42'];
$checkbox43=$_POST['checkbox43'];
$checkbox44=$_POST['checkbox44'];
$checkbox45=$_POST['checkbox45'];
$checkbox46=$_POST['checkbox46'];
$checkbox47=$_POST['checkbox47'];
$checkbox48=$_POST['checkbox48'];
$checkbox49=$_POST['checkbox49'];
$checkbox50=$_POST['checkbox50'];
$checkbox51=$_POST['checkbox51'];
$checkbox52=$_POST['checkbox52'];
$checkbox53=$_POST['checkbox53'];
$checkbox54=$_POST['checkbox54'];
$checkbox55=$_POST['checkbox55'];
$checkbox56=$_POST['checkbox56'];
$checkbox57=$_POST['checkbox57'];
$checkbox58=$_POST['checkbox58'];
$checkbox59=$_POST['checkbox59'];
$checkbox60=$_POST['checkbox60'];
$checkbox61=$_POST['checkbox61'];
$checkbox62=$_POST['checkbox62'];
$checkbox63=$_POST['checkbox63'];
$checkbox64=$_POST['checkbox64'];
$checkbox65=$_POST['checkbox65'];
$checkbox66=$_POST['checkbox66'];
$checkbox67=$_POST['checkbox67'];
$checkbox68=$_POST['checkbox68'];
$checkbox69=$_POST['checkbox69'];
$checkbox70=$_POST['checkbox70'];
$checkbox71=$_POST['checkbox71'];
$checkbox72=$_POST['checkbox72'];
$checkbox73=$_POST['checkbox73'];
$checkbox74=$_POST['checkbox74'];
$checkbox75=$_POST['checkbox75'];
$checkbox76=$_POST['checkbox76'];
$checkbox77=$_POST['checkbox77'];
$checkbox78=$_POST['checkbox78'];
$checkbox79=$_POST['checkbox79'];
$checkbox80=$_POST['checkbox80'];
$checkbox81=$_POST['checkbox81'];
$checkbox82=$_POST['checkbox82'];
$checkbox83=$_POST['checkbox83'];
$checkbox84=$_POST['checkbox84'];
$checkbox85=$_POST['checkbox85'];
$checkbox86=$_POST['checkbox86'];
$checkbox87=$_POST['checkbox87'];
$checkbox88=$_POST['checkbox88'];
$checkbox89=$_POST['checkbox89'];
$checkbox90=$_POST['checkbox90'];
$checkbox91=$_POST['checkbox91'];
$checkbox92=$_POST['checkbox92'];
$checkbox93=$_POST['checkbox93'];
$checkbox94=$_POST['checkbox94'];
$checkbox95=$_POST['checkbox95'];
$checkbox96=$_POST['checkbox96'];
$checkbox97=$_POST['checkbox97'];
$checkbox98=$_POST['checkbox98'];
$checkbox99=$_POST['checkbox99'];
$checkbox100=$_POST['checkbox100'];
$checkbox101=$_POST['checkbox101'];
$checkbox102=$_POST['checkbox102'];
$checkbox103=$_POST['checkbox103'];
$checkbox104=$_POST['checkbox104'];
$checkbox105=$_POST['checkbox105'];
$checkbox106=$_POST['checkbox106'];
$checkbox107=$_POST['checkbox107'];
$checkbox108=$_POST['checkbox108'];
$checkbox109=$_POST['checkbox109'];
$checkbox110=$_POST['checkbox110'];
$checkbox111=$_POST['checkbox111'];
$checkbox112=$_POST['checkbox112'];
$checkbox113=$_POST['checkbox113'];
$checkbox114=$_POST['checkbox114'];
$checkbox115=$_POST['checkbox115'];
$checkbox116=$_POST['checkbox116'];
$input2=$_POST["input2"];
$input3=$_POST["input3"];
$input4=$_POST["input4"];
$input5=$_POST["input5"];
$sign1=$_POST["sign1"];
$date1=$_POST["date1"];
$time1=$_POST["time1"];
$sign2=$_POST["sign2"];
$date2=$_POST["date2"];
$time2=$_POST["time2"];


if ($id && $id != 0) {

    sqlStatement("UPDATE revisionrelapse_form SET pname =?, DOB=?, input1=?,checkboxA1=?,checkboxA2=?,checkboxA3=?,checkboxA4=?,checkbox1=?,checkbox2=?,checkbox3=?,checkbox4=?,checkbox5=?,checkbox6=?,checkbox7=?,checkbox8=?,checkbox9=?,checkbox10=?,checkbox11=?,checkbox12=?,checkbox13=?,checkbox14=?,checkbox15=?,checkbox16=?,checkbox17=?,checkbox18=?,checkbox19=?,checkbox20=?,checkbox21=?,checkbox22=?,checkbox23=?,checkbox24=?,checkbox25=?,checkbox26=?,checkbox27=?,checkbox28=?,checkbox29=?,checkbox30=?,checkbox31=?,checkbox32=?,checkbox33=?,checkbox34=?,checkbox35=?,checkbox36=?,checkbox37=?,checkbox38=?,checkbox39=?,checkbox40=?,checkbox41=?,checkbox42=?,checkbox43=?,checkbox44=?,checkbox45=?,checkbox46=?,checkbox47=?,checkbox48=?,checkbox49=?,checkbox50=?,checkbox51=?,checkbox52=?,checkbox53=?,checkbox54=?,checkbox55=?,checkbox56=?,checkbox57=?,checkbox58=?,checkbox59=?,checkbox60=?,checkbox61=?,checkbox62=?,checkbox63=?,checkbox64=?,checkbox65=?,checkbox66=?,checkbox67=?,checkbox68=?,checkbox69=?,checkbox70=?,checkbox71=?,checkbox72=?,checkbox73=?,checkbox74=?,checkbox75=?,checkbox76=?,checkbox77=?,checkbox78=?,checkbox79=?,checkbox80=?,checkbox81=?,checkbox82=?,checkbox83=?,checkbox84=?,checkbox85=?,checkbox86=?,checkbox87=?,checkbox88=?,checkbox89=?,checkbox90=?,checkbox91=?,checkbox92=?,checkbox93=?,checkbox94=?,checkbox95=?,checkbox96=?,checkbox97=?,checkbox98=?,checkbox99=?,checkbox100=?,checkbox101=?,checkbox102=?,checkbox103=?,checkbox104=?,checkbox105=?,checkbox106=?,checkbox107=?,checkbox108=?,checkbox109=?,checkbox110=?,checkbox111=?,checkbox112=?,checkbox113=?,checkbox114=?,checkbox115=?,checkbox116=?,input2=?,input3=?,input4=?,input5=?,sign1=?,date1=?,time1=?,sign2=?,date2=?,time2=? WHERE id = ?", array($pname,$DOB,$input1,$checkboxA1,$checkboxA2,$checkboxA3,$checkboxA4,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6,$checkbox7,$checkbox8,$checkbox9,$checkbox10,$checkbox11,$checkbox12,$checkbox13,$checkbox14,$checkbox15,$checkbox16,$checkbox17,$checkbox18,$checkbox19,$checkbox20,$checkbox21,$checkbox22,$checkbox23,$checkbox24,$checkbox25,$checkbox26,$checkbox27,$checkbox28,$checkbox29,$checkbox30,$checkbox31,$checkbox32,$checkbox33,$checkbox34,$checkbox35,$checkbox36,$checkbox37,$checkbox38,$checkbox39,$checkbox40,$checkbox41,$checkbox42,$checkbox43,$checkbox44,$checkbox45,$checkbox46,$checkbox47,$checkbox48,$checkbox49,$checkbox50,$checkbox51,$checkbox52,$checkbox53,$checkbox54,$checkbox55,$checkbox56,$checkbox57,$checkbox58,$checkbox59,$checkbox60,$checkbox61,$checkbox62,$checkbox63,$checkbox64,$checkbox65,$checkbox66,$checkbox67,$checkbox68,$checkbox69,$checkbox70,$checkbox71,$checkbox72,$checkbox73,$checkbox74,$checkbox75,$checkbox76,$checkbox77,$checkbox78,$checkbox79,$checkbox80,$checkbox81,$checkbox82,$checkbox83,$checkbox84,$checkbox85,$checkbox86,$checkbox87,$checkbox88,$checkbox89,$checkbox90,$checkbox91,$checkbox92,$checkbox93,$checkbox94,$checkbox95,$checkbox96,$checkbox97,$checkbox98,$checkbox99,$checkbox100,$checkbox101,$checkbox102,$checkbox103,$checkbox104,$checkbox105,$checkbox106,$checkbox107,$checkbox108,$checkbox109,$checkbox110,$checkbox111,$checkbox112,$checkbox113,$checkbox114,$checkbox115,$checkbox116,$input2,$input3,$input4,$input5,$sign1,$date1,$time1,$sign2,$date2,$time2,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO revisionrelapse_form (pid,encounter,pname,DOB,input1,checkboxA1,checkboxA2,checkboxA3,checkboxA4,checkbox1,checkbox2,checkbox3,checkbox4,checkbox5,checkbox6,checkbox7,checkbox8,checkbox9,checkbox10,checkbox11,checkbox12,checkbox13,checkbox14,checkbox15,checkbox16,checkbox17,checkbox18,checkbox19,checkbox20,checkbox21,checkbox22,checkbox23,checkbox24,checkbox25,checkbox26,checkbox27,checkbox28,checkbox29,checkbox30,checkbox31,checkbox32,checkbox33,checkbox34,checkbox35,checkbox36,checkbox37,checkbox38,checkbox39,checkbox40,checkbox41,checkbox42,checkbox43,checkbox44,checkbox45,checkbox46,checkbox47,checkbox48,checkbox49,checkbox50,checkbox51,checkbox52,checkbox53,checkbox54,checkbox55,checkbox56,checkbox57,checkbox58,checkbox59,checkbox60,checkbox61,checkbox62,checkbox63,checkbox64,checkbox65,checkbox66,checkbox67,checkbox68,checkbox69,checkbox70,checkbox71,checkbox72,checkbox73,checkbox74,checkbox75,checkbox76,checkbox77,checkbox78,checkbox79,checkbox80,checkbox81,checkbox82,checkbox83,checkbox84,checkbox85,checkbox86,checkbox87,checkbox88,checkbox89,checkbox90,checkbox91,checkbox92,checkbox93,checkbox94,checkbox95,checkbox96,checkbox97,checkbox98,checkbox99,checkbox100,checkbox101,checkbox102,checkbox103,checkbox104,checkbox105,checkbox106,checkbox107,checkbox108,checkbox109,checkbox110,checkbox111,checkbox112,checkbox113,checkbox114,checkbox115,checkbox116,input2,input3,input4,input5,sign1,date1,time1,sign2,date2,time2) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$pname,$DOB,$input1,$checkboxA1,$checkboxA2,$checkboxA3,$checkboxA4,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6,$checkbox7,$checkbox8,$checkbox9,$checkbox10,$checkbox11,$checkbox12,$checkbox13,$checkbox14,$checkbox15,$checkbox16,$checkbox17,$checkbox18,$checkbox19,$checkbox20,$checkbox21,$checkbox22,$checkbox23,$checkbox24,$checkbox25,$checkbox26,$checkbox27,$checkbox28,$checkbox29,$checkbox30,$checkbox31,$checkbox32,$checkbox33,$checkbox34,$checkbox35,$checkbox36,$checkbox37,$checkbox38,$checkbox39,$checkbox40,$checkbox41,$checkbox42,$checkbox43,$checkbox44,$checkbox45,$checkbox46,$checkbox47,$checkbox48,$checkbox49,$checkbox50,$checkbox51,$checkbox52,$checkbox53,$checkbox54,$checkbox55,$checkbox56,$checkbox57,$checkbox58,$checkbox59,$checkbox60,$checkbox61,$checkbox62,$checkbox63,$checkbox64,$checkbox65,$checkbox66,$checkbox67,$checkbox68,$checkbox69,$checkbox70,$checkbox71,$checkbox72,$checkbox73,$checkbox74,$checkbox75,$checkbox76,$checkbox77,$checkbox78,$checkbox79,$checkbox80,$checkbox81,$checkbox82,$checkbox83,$checkbox84,$checkbox85,$checkbox86,$checkbox87,$checkbox88,$checkbox89,$checkbox90,$checkbox91,$checkbox92,$checkbox93,$checkbox94,$checkbox95,$checkbox96,$checkbox97,$checkbox98,$checkbox99,$checkbox100,$checkbox101,$checkbox102,$checkbox103,$checkbox104,$checkbox105,$checkbox106,$checkbox107,$checkbox108,$checkbox109,$checkbox110,$checkbox111,$checkbox112,$checkbox113,$checkbox114,$checkbox115,$checkbox116,$input2,$input3,$input4,$input5,$sign1,$date1,$time1,$sign2,$date2,$time2));
    addForm($encounter, "Revision Relapse form", $newid, "Revision_Relapse_form",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();