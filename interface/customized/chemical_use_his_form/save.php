<?php


require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');


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
$checkbox01=$_POST['checkbox01'];
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

if ($id && $id != 0) {
    sqlStatement("UPDATE `chemical_use_form` SET input1=?,input2=?,input3=?,input4=?,input5=?,input6=?,input7=?,input8=?,input9=?,input10=?,input11=?,input12=?,input13=?,input14=?,input15=?,input16=?,input17=?,input18=?,input19=?,input20=?,input21=?,input22=?,input23=?,input24=?,input25=?,input26=?,input27=?,input28=?,input29=?,input30=?,input31=?,input32=?,input33=?,input34=?,input35=?,input36=?,input37=?,input38=?,input39=?,input40=?,input41=?,input42=?,input43=?,input44=?,input45=?,input46=?,input47=?,input48=?,input49=?,input50=?,input51=?,input52=?,input53=?,input54=?,input55=?,input56=?,input57=?,checkbox01=?,checkbox1=?,checkbox2=?,checkbox3=?,checkbox4=?,checkbox5=?,checkbox6=?,checkbox7=?,checkbox8=?,checkbox9=?,checkbox10=?,checkbox11=?,checkbox12=?,checkbox13=?,checkbox14=?,checkbox15=?,checkbox16=?,checkbox17=?,checkbox18=?,checkbox19=?,checkbox20=?,checkbox21=?,checkbox22=?,checkbox23=?,checkbox24=?,checkbox25=?,checkbox26=?,checkbox27=?,checkbox28=?,checkbox29=?,checkbox30=?,checkbox31=?,checkbox32=?,checkbox33=?,checkbox34=?,checkbox35=?,checkbox36=?,checkbox37=?,checkbox38=?,checkbox39=?,checkbox40=?,checkbox41=?,checkbox42=?,checkbox43=?,checkbox44=?,checkbox45=?,checkbox46=?,checkbox47=?,checkbox48=?,checkbox49=?,checkbox50=? WHERE id = ?", array($input1,$input2,$input3,$input4,$input5,$input6,$input7,$input8,$input9,$input10,$input11,$input12,$input13,$input14,$input15,$input16,$input17,$input18,$input19,$input20,$input21,$input22,$input23,$input24,$input25,$input26,$input27,$input28,$input29,$input30,$input31,$input32,$input33,$input34,$input35,$input36,$input37,$input38,$input39,$input40,$input41,$input42,$input43,$input44,$input45,$input46,$input47,$input48,$input49,$input50,$input51,$input52,$input53,$input54,$input55,$input56,$input57,$checkbox01,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6,$checkbox7,$checkbox8,$checkbox9,$checkbox10,$checkbox11,$checkbox12,$checkbox13,$checkbox14,$checkbox15,$checkbox16,$checkbox17,$checkbox18,$checkbox19,$checkbox20,$checkbox21,$checkbox22,$checkbox23,$checkbox24,$checkbox25,$checkbox26,$checkbox27,$checkbox28,$checkbox29,$checkbox30,$checkbox31,$checkbox32,$checkbox33,$checkbox34,$checkbox35,$checkbox36,$checkbox37,$checkbox38,$checkbox39,$checkbox40,$checkbox41,$checkbox42,$checkbox43,$checkbox44,$checkbox45,$checkbox46,$checkbox47,$checkbox48,$checkbox49,$checkbox50,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO chemical_use_form (pid,encounter,input1,input2,input3,input4,input5,input6,input7,input8,input9,input10,input11,input12,input13,input14,input15,input16,input17,input18,input19,input20,input21,input22,input23,input24,input25,input26,input27,input28,input29,input30,input31,input32,input33,input34,input35,input36,input37,input38,input39,input40,input41,input42,input43,input44,input45,input46,input47,input48,input49,input50,input51,input52,input53,input54,input55,input56,input57,checkbox01,checkbox1,checkbox2,checkbox3,checkbox4,checkbox5,checkbox6,checkbox7,checkbox8,checkbox9,checkbox10,checkbox11,checkbox12,checkbox13,checkbox14,checkbox15,checkbox16,checkbox17,checkbox18,checkbox19,checkbox20,checkbox21,checkbox22,checkbox23,checkbox24,checkbox25,checkbox26,checkbox27,checkbox28,checkbox29,checkbox30,checkbox31,checkbox32,checkbox33,checkbox34,checkbox35,checkbox36,checkbox37,checkbox38,checkbox39,checkbox40,checkbox41,checkbox42,checkbox43,checkbox44,checkbox45,checkbox46,checkbox47,checkbox48,checkbox49,checkbox50) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$input1,$input2,$input3,$input4,$input5,$input6,$input7,$input8,$input9,$input10,$input11,$input12,$input13,$input14,$input15,$input16,$input17,$input18,$input19,$input20,$input21,$input22,$input23,$input24,$input25,$input26,$input27,$input28,$input29,$input30,$input31,$input32,$input33,$input34,$input35,$input36,$input37,$input38,$input39,$input40,$input41,$input42,$input43,$input44,$input45,$input46,$input47,$input48,$input49,$input50,$input51,$input52,$input53,$input54,$input55,$input56,$input57,$checkbox01,$checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6,$checkbox7,$checkbox8,$checkbox9,$checkbox10,$checkbox11,$checkbox12,$checkbox13,$checkbox14,$checkbox15,$checkbox16,$checkbox17,$checkbox18,$checkbox19,$checkbox20,$checkbox21,$checkbox22,$checkbox23,$checkbox24,$checkbox25,$checkbox26,$checkbox27,$checkbox28,$checkbox29,$checkbox30,$checkbox31,$checkbox32,$checkbox33,$checkbox34,$checkbox35,$checkbox36,$checkbox37,$checkbox38,$checkbox39,$checkbox40,$checkbox41,$checkbox42,$checkbox43,$checkbox44,$checkbox45,$checkbox46,$checkbox47,$checkbox48,$checkbox49,$checkbox50));
    addForm($encounter, "Chemical Use Form", $newid, "chemical_use_his_form",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();