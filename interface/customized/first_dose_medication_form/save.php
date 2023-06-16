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
$input1=$_POST['input1'];
$input2=$_POST['input2'];
$input3=$_POST['input3'];
$input4=$_POST['input4'];
$input5=$_POST['input5'];
$input6=$_POST['input6'];
$input7=$_POST['input7'];
$input8=$_POST['input8'];
$input9=$_POST['input9'];
$input10=$_POST['input10'];
$input11=$_POST['input11'];
$input12=$_POST['input12'];
$input13=$_POST['input13'];
$input14=$_POST['input14'];
$input15=$_POST['input15'];
$input16=$_POST['input16'];
$input17=$_POST['input17'];
$input18=$_POST['input18'];
$input19=$_POST['input19'];
$input20=$_POST['input20'];
$input21=$_POST['input21'];
$input22=$_POST['input22'];
$input23=$_POST['input23'];
$input24=$_POST['input24'];
$input25=$_POST['input25'];
$input26=$_POST['input26'];
$input27=$_POST['input27'];
$input28=$_POST['input28'];
$input29=$_POST['input29'];
$input30=$_POST['input30'];
$input31=$_POST['input31'];
$input32=$_POST['input32'];
$input33=$_POST['input33'];
$input34=$_POST['input34'];
$input35=$_POST['input35'];
$input36=$_POST['input36'];
$input37=$_POST['input37'];
$input38=$_POST['input38'];
$input39=$_POST['input39'];
$input40=$_POST['input40'];
$input41=$_POST['input41'];
$input42=$_POST['input42'];
$input43=$_POST['input43'];
$input44=$_POST['input44'];
$input45=$_POST['input45'];
$input46=$_POST['input46'];
$input47=$_POST['input47'];
$input48=$_POST['input48'];
$input49=$_POST['input49'];
$input50=$_POST['input50'];
$input51=$_POST['input51'];
$input52=$_POST['input52'];
$input53=$_POST['input53'];
$input54=$_POST['input54'];
$input55=$_POST['input55'];
$input56=$_POST['input56'];
$input57=$_POST['input57'];
$input58=$_POST['input58'];
$input59=$_POST['input59'];
$input60=$_POST['input60'];
$input61=$_POST['input61'];
$input62=$_POST['input62'];
$input63=$_POST['input63'];
$input64=$_POST['input64'];
$input65=$_POST['input65'];
$input66=$_POST['input66'];
$input67=$_POST['input67'];
$input68=$_POST['input68'];
$input69=$_POST['input69'];
$input70=$_POST['input70'];
$input71=$_POST['input71'];
$input72=$_POST['input72'];
$input73=$_POST['input73'];
$input74=$_POST['input74'];
$input75=$_POST['input75'];
$input76=$_POST['input76'];
$input77=$_POST['input77'];
$input78=$_POST['input78'];
$input79=$_POST['input79'];
$input80=$_POST['input80'];
$input81=$_POST['input81'];
$input82=$_POST['input82'];
$input83=$_POST['input83'];
$input84=$_POST['input84'];
$input85=$_POST['input85'];
$input86=$_POST['input86'];
$input87=$_POST['input87'];
$input88=$_POST['input88'];
$input89=$_POST['input89'];
$input90=$_POST['input90'];
$input91=$_POST['input91'];
$input92=$_POST['input92'];
$input93=$_POST['input93'];
$input94=$_POST['input94'];
$input95=$_POST['input95'];

if ($id && $id != 0) {

    sqlStatement("UPDATE `first_dose_form` SET pname=?,DOB=?,input1=?,input2=?,input3=?,input4=?,input5=?,input6=?,input7=?,input8=?,input9=?,input10=?,input11=?,input12=?,input13=?,input14=?,input15=?,input16=?,input17=?,input18=?,input19=?,input20=?,input21=?,input22=?,input23=?,input24=?,input25=?,input26=?,input27=?,input28=?,input29=?,input30=?,input31=?,input32=?,input33=?,input34=?,input35=?,input36=?,input37=?,input38=?,input39=?,input40=?,input41=?,input42=?,input43=?,input44=?,input45=?,input46=?,input47=?,input48=?,input49=?,input50=?,input51=?,input52=?,input53=?,input54=?,input55=?,input56=?,input57=?,input58=?,input59=?,input60=?,input61=?,input62=?,input63=?,input64=?,input65=?,input66=?,input67=?,input68=?,input69=?,input70=?,input71=?,input72=?,input73=?,input74=?,input75=?,input76=?,input77=?,input78=?,input79=?,input80=?,input81=?,input82=?,input83=?,input84=?,input85=?,input86=?,input87=?,input88=?,input89=?,input90=?,input91=?,input92=?,input93=?,input94=?,input95=? WHERE id = ?", array($pname,$DOB,$input1,$input2,$input3,$input4,$input5,$input6,$input7,$input8,$input9,$input10,$input11,$input12,$input13,$input14,$input15,$input16,$input17,$input18,$input19,$input20,$input21,$input22,$input23,$input24,$input25,$input26,$input27,$input28,$input29,$input30,$input31,$input32,$input33,$input34,$input35,$input36,$input37,$input38,$input39,$input40,$input41,$input42,$input43,$input44,$input45,$input46,$input47,$input48,$input49,$input50,$input51,$input52,$input53,$input54,$input55,$input56,$input57,$input58,$input59,$input60,$input61,$input62,$input63,$input64,$input65,$input66,$input67,$input68,$input69,$input70,$input71,$input72,$input73,$input74,$input75,$input76,$input77,$input78,$input79,$input80,$input81,$input82,$input83,$input84,$input85,$input86,$input87,$input88,$input89,$input90,$input91,$input92,$input93,$input94,$input95,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO first_dose_form (pid,encounter,pname,DOB,input1,input2,input3,input4,input5,input6,input7,input8,input9,input10,input11,input12,input13,input14,input15,input16,input17,input18,input19,input20,input21,input22,input23,input24,input25,input26,input27,input28,input29,input30,input31,input32,input33,input34,input35,input36,input37,input38,input39,input40,input41,input42,input43,input44,input45,input46,input47,input48,input49,input50,input51,input52,input53,input54,input55,input56,input57,input58,input59,input60,input61,input62,input63,input64,input65,input66,input67,input68,input69,input70,input71,input72,input73,input74,input75,input76,input77,input78,input79,input80,input81,input82,input83,input84,input85,input86,input87,input88,input89,input90,input91,input92,input93,input94,input95) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$pname,$DOB,$input1,$input2,$input3,$input4,$input5,$input6,$input7,$input8,$input9,$input10,$input11,$input12,$input13,$input14,$input15,$input16,$input17,$input18,$input19,$input20,$input21,$input22,$input23,$input24,$input25,$input26,$input27,$input28,$input29,$input30,$input31,$input32,$input33,$input34,$input35,$input36,$input37,$input38,$input39,$input40,$input41,$input42,$input43,$input44,$input45,$input46,$input47,$input48,$input49,$input50,$input51,$input52,$input53,$input54,$input55,$input56,$input57,$input58,$input59,$input60,$input61,$input62,$input63,$input64,$input65,$input66,$input67,$input68,$input69,$input70,$input71,$input72,$input73,$input74,$input75,$input76,$input77,$input78,$input79,$input80,$input81,$input82,$input83,$input84,$input85,$input86,$input87,$input88,$input89,$input90,$input91,$input92,$input93,$input94,$input95));
    addForm($encounter, "First dose medication form", $newid, "first_dose_medication_form",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
