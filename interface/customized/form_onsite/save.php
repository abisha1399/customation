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






if ($id && $id != 0) {
    sqlStatement("UPDATE `form_onsite` SET   `input1`=?,`input2`=?,`input3`=?,`input4`=?,`input5`=?,`input6`=?,`input7`=?,`input8`=?,`input9`=?,`input10`=?,`input11`=?,`input12`=?,`input13`=?,`input14`=?,`input15`=?,`input16`=?,`input17`=?,`input18`=?,`input19`=?,`input20`=?,`input21`=?,`input22`=?,`input23`=?,`input24`=?,`input25`=?,`input26`=?,`input27`=?,`input28`=?,`input29`=?,`input30`=?,`input31`=?,`input32`=?,`input33`=?,`input34`=?,`input35`=?,`input36`=?,`input37`=?,`input38`=?,`input39`=?,`input40`=?,`input41`=?,`input42`=?,`input43`=?,`input44`=?,`input45`=?,`input46`=?,`input47`=?,`input48`=?,`input49`=?,`input50`=? WHERE id =?", array($input1,$input2,$input3,$input4,$input5,$input6,$input7,$input8,$input9,$input10,$input11,$input12,$input13,$input14,$input15,$input16,$input17,$input18,$input19,$input20,$input21,$input22,$input23,$input24,$input25,$input26,$input27,$input28,$input29,$input30,$input31,$input32,$input33,$input34,$input35,$input36,$input37,$input38,$input39,$input40,$input41,$input42,$input43,$input44,$input45,$input46,$input47,$input48,$input49,$input50, $id));
}else 
{

    $newid = sqlInsert("INSERT INTO `form_onsite`(`pid`,`encounter`,`input1`,`input2`,`input3`,`input4`,`input5`,`input6`,`input7`,`input8`,`input9`,`input10`,`input11`,`input12`,`input13`,`input14`,`input15`,`input16`,`input17`,`input18`,`input19`,`input20`,`input21`,`input22`,`input23`,`input24`,`input25`,`input26`,`input27`,`input28`,`input29`,`input30`,`input31`,`input32`,`input33`,`input34`,`input35`,`input36`,`input37`,`input38`,`input39`,`input40`,`input41`,`input42`,`input43`,`input44`,`input45`,`input46`,`input47`,`input48`,`input49`,`input50`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($_SESSION["pid"],$_SESSION["encounter"],$input1,$input2,$input3,$input4,$input5,$input6,$input7,$input8,$input9,$input10,$input11,$input12,$input13,$input14,$input15,$input16,$input17,$input18,$input19,$input20,$input21,$input22,$input23,$input24,$input25,$input26,$input27,$input28,$input29,$input30,$input31,$input32,$input33,$input34,$input35,$input36,$input37,$input38,$input39,$input40,$input41,$input42,$input43,$input44,$input45,$input46,$input47,$input48,$input49,$input50));
    addForm($encounter, "Onsite Form", $newid, "form_onsite",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
 

