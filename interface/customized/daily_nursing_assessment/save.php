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

$patient    = $_POST['patient'];
$dob        = $_POST['dob'];
$date       = $_POST['date'];
$time       = $_POST['time'];
$check1     = $_POST['check1'];
$check2     = $_POST['check2'];
$check3     = $_POST['check3'];
$check4     = $_POST['check4'];
$check5     = $_POST['check5'];
$check6     = $_POST['check6'];
$check7     = $_POST['check7'];
$check8     = $_POST['check8'];
$check9     = $_POST['check9'];
$check10    = $_POST['check10'];
$check11    = $_POST['check11'];
$check12    = $_POST['check12'];
$check13    = $_POST['check13'];
$check14    = $_POST['check14'];
$check15    = $_POST['check15'];
$check16    = $_POST['check16'];
$check17    = $_POST['check17'];
$check18    = $_POST['check18'];
$check19    = $_POST['check19'];
$check20    = $_POST['check20'];
$check21    = $_POST['check21'];
$check22    = $_POST['check22'];
$check23    = $_POST['check23'];
$check24    = $_POST['check24'];
$check25    = $_POST['check25'];
$check26    = $_POST['check26'];
$check27    = $_POST['check27'];
$check28    = $_POST['check28'];
$check29    = $_POST['check29'];
$check30    = $_POST['check30'];
$check31    = $_POST['check31'];
$check32    = $_POST['check32'];
$check33    = $_POST['check33'];
$check34    = $_POST['check34'];
$check35    = $_POST['check35'];
$check36    = $_POST['check36'];
$check37    = $_POST['check37'];
$check38    = $_POST['check38'];
$check39    = $_POST['check39'];
$check40    = $_POST['check40'];
$check41    = $_POST['check41'];
$check42    = $_POST['check42'];
$check43    = $_POST['check43'];
$check44    = $_POST['check44'];
$check45    = $_POST['check45'];
$check46    = $_POST['check46'];
$check47    = $_POST['check47'];
$check48    = $_POST['check48'];
$check49    = $_POST['check49'];
$check50    = $_POST['check50'];
$check51    = $_POST['check51'];
$check52    = $_POST['check52'];
$check53    = $_POST['check53'];
$check54    = $_POST['check54'];
$check55    = $_POST['check55'];
$check56    = $_POST['check56'];
$check57    = $_POST['check57'];
$check58    = $_POST['check58'];
$check59    = $_POST['check59'];
$check60    = $_POST['check60'];
$check61    = $_POST['check61'];
$check62    = $_POST['check62'];
$check63    = $_POST['check63'];
$check64    = $_POST['check64'];
$check65    = $_POST['check65'];
$check66    = $_POST['check66'];
$check67    = $_POST['check67'];
$check68    = $_POST['check68'];
$check69    = $_POST['check69'];
$check70    = $_POST['check70'];
$check71    = $_POST['check71'];
$check72    = $_POST['check72'];
$check73    = $_POST['check73'];
$check74    = $_POST['check74'];
$check75    = $_POST['check75'];
$check76    = $_POST['check76'];
$check77    = $_POST['check77'];
$check78    = $_POST['check78'];
$check79    = $_POST['check79'];
$check80    = $_POST['check80'];
$check81    = $_POST['check81'];
$check82    = $_POST['check82'];
$check83    = $_POST['check83'];
$check84    = $_POST['check84'];
$check85    = $_POST['check85'];
$check86    = $_POST['check86'];
$check87    = $_POST['check87'];
$check88    = $_POST['check88'];
$check89    = $_POST['check89'];
$check90    = $_POST['check90'];
$check91    = $_POST['check91'];
$check92    = $_POST['check92'];
$check93    = $_POST['check93'];
$check94    = $_POST['check94'];
$check95    = $_POST['check95'];
$check96    = $_POST['check96'];
$check97    = $_POST['check97'];
$check98    = $_POST['check98'];
$check99    = $_POST['check99'];
$check100   = $_POST['check100'];
$check101   = $_POST['check101'];
$check102   = $_POST['check102'];
$check103   = $_POST['check103'];
$check104   = $_POST['check104'];
$check105   = $_POST['check105'];
$othertext1 = $_POST['othertext1'];
$othertext2 = $_POST['othertext2'];
$othertext3 = $_POST['othertext3'];
$othertext4 = $_POST['othertext4'];
$othertext5 = $_POST['othertext5'];
$othertext6 = $_POST['othertext6'];
$othertext7 = $_POST['othertext7'];
$othertext8 = $_POST['othertext8'];
$plantext1  = $_POST['plantext1'];
$plantext2  = $_POST['plantext2'];
$plantext3  = $_POST['plantext3'];
$meancheck1 = $_POST['meancheck1'];
$meancheck2 = $_POST['meancheck2'];
$meantext1  = $_POST['meantext1'];
$meantext2  = $_POST['meantext2'];
$meantext3  = $_POST['meantext3'];
$meantext4  = $_POST['meantext4'];
$meantext5  = $_POST['meantext5'];
$intercheck1 = $_POST['intercheck1'];
$intercheck2 = $_POST['intercheck2'];
$intercheck3 = $_POST['intercheck3'];
$intercheck4 = $_POST['intercheck4'];
$intercheck5 = $_POST['intercheck5'];
$intercheck6 = $_POST['intercheck6'];
$intercheck7 = $_POST['intercheck7'];
$intercheck8 = $_POST['intercheck8'];
$intercheck9 = $_POST['intercheck9'];
$intercheck10 = $_POST['intercheck10'];
$intertext1 = $_POST['intertext1'];
$mealcheck1 = $_POST['mealcheck1'];
$mealcheck2 = $_POST['mealcheck2'];
$mealcheck3 = $_POST['mealcheck3'];
$mealtext1 = $_POST['mealtext1'];
$mealtext2 = $_POST['mealtext2'];
$mealtext3 = $_POST['mealtext3'];
$objcheck1 = $_POST['objcheck1'];
$objcheck2 = $_POST['objcheck2'];
$objcheck3 = $_POST['objcheck3'];
$objcheck4 = $_POST['objcheck4'];
$vtext1 = $_POST['vtext1'];
$vtext2 = $_POST['vtext2'];
$vtext3 = $_POST['vtext3'];
$vtext4 = $_POST['vtext4'];
$vtext5 = $_POST['vtext5'];
$vtext6 = $_POST['vtext6'];
$ptcheck1 = $_POST['ptcheck1'];
$ptcheck2 = $_POST['ptcheck2'];
$ptcheck3 = $_POST['ptcheck3'];
$ptcheck4 = $_POST['ptcheck4'];
$ptcheck5 = $_POST['ptcheck5'];
$ptcheck6 = $_POST['ptcheck6'];
$ptcheck7 = $_POST['ptcheck7'];
$ptcheck8 = $_POST['ptcheck8'];
$ptcheck9 = $_POST['ptcheck9'];
$ptcheck10 = $_POST['ptcheck10'];
$ptcheck11 = $_POST['ptcheck11'];
$ptcheck12 = $_POST['ptcheck12'];
$ptcheck13 = $_POST['ptcheck13'];
$ptcheck14 = $_POST['ptcheck14'];
$ptcheck15 = $_POST['ptcheck15'];
$ptcheck16 = $_POST['ptcheck16'];
$ptcheck17 = $_POST['ptcheck17'];
$ptcheck18 = $_POST['ptcheck18'];
$ptcheck19 = $_POST['ptcheck19'];
$ptcheck20 = $_POST['ptcheck20'];
$ptcheck21 = $_POST['ptcheck21'];
$ptcheck22 = $_POST['ptcheck22'];
$ptcheck23 = $_POST['ptcheck23'];
$ptcheck24 = $_POST['ptcheck24'];
$ptcheck25 = $_POST['ptcheck25'];
$pttext1 = $_POST['pttext1'];
$pttext2 = $_POST['pttext2'];
$pttext3 = $_POST['pttext3'];
$pttext4 = $_POST['pttext4'];
$pttext5 = $_POST['pttext5'];
$pttext6 = $_POST['pttext6'];
$pttext7 = $_POST['pttext7'];
$pttext8 = $_POST['pttext8'];
$pttext9  = $_POST['pttext9 '];
$pttext10 = $_POST['pttext10'];
$pttext11 = $_POST['pttext11'];
$pttext12 = $_POST['pttext12'];
$pttext13 = $_POST['pttext13'];
$goalcheck0 = $_POST['goalcheck0'];
$goalcheck1 = $_POST['goalcheck1'];
$goalcheck2 = $_POST['goalcheck2'];
$goalcheck3 = $_POST['goalcheck3'];
$goalcheck4 = $_POST['goalcheck4'];
$goalcheck5 = $_POST['goalcheck5'];
$goalcheck6 = $_POST['goalcheck6'];
$goalcheck7 = $_POST['goalcheck7'];
$goalcheck8 = $_POST['goalcheck8'];
$goalcheck9 = $_POST['goalcheck9'];
$goalcheck10 = $_POST['goalcheck10'];
$subjective = $_POST['subjective'];
$additional = $_POST['additional'];
$rnsign = $_POST['rnsign'];
$rndate = $_POST['rndate'];
$rntime = $_POST['rntime'];
$evecheck1 = $_POST['evecheck1'];
$evecheck2 = $_POST['evecheck2'];
$evecheck3 = $_POST['evecheck3'];
$evecheck4 = $_POST['evecheck4'];
$medcheck1 = $_POST['medcheck1'];
$medcheck2 = $_POST['medcheck2'];
$medcheck3 = $_POST['medcheck3'];
$medcheck4 = $_POST['medcheck4'];
$medcheck5 = $_POST['medcheck5'];
$medcheck6 = $_POST['medcheck6'];
$medcheck7 = $_POST['medcheck7'];
$medcheck8 = $_POST['medcheck8'];
$medcheck9 = $_POST['medcheck9'];
$medcheck10 = $_POST['medcheck10'];
$medcheck11 = $_POST['medcheck11'];
$medcheck12 = $_POST['medcheck12'];
$medcheck13 = $_POST['medcheck13'];
$medcheck14 = $_POST['medcheck14'];
$medcheck15 = $_POST['medcheck15'];
$medcheck16 = $_POST['medcheck16'];
$medcheck17 = $_POST['medcheck17'];
$medcheck18 = $_POST['medcheck18'];
$medcheck19 = $_POST['medcheck19'];
$medcheck20 = $_POST['medcheck20'];
$medcheck21 = $_POST['medcheck21'];
$medcheck22 = $_POST['medcheck22'];
$medcheck23 = $_POST['medcheck23'];
$medcheck24 = $_POST['medcheck24'];
$medcheck25 = $_POST['medcheck25'];
$medtext1 = $_POST['medtext1'];
$medtext2 = $_POST['medtext2'];
$medtext3 = $_POST['medtext3'];
$medtext4 = $_POST['medtext4'];
$medtext5 = $_POST['medtext5'];
$medtext6 = $_POST['medtext6'];
$medtext7 = $_POST['medtext7'];
$medtext8 = $_POST['medtext8'];
$medtext9  = $_POST['medtext9 '];
$medtext10 = $_POST['medtext10'];
$medtext11 = $_POST['medtext11'];
$medtext12 = $_POST['medtext12'];
$medtext13 = $_POST['medtext13'];
$nurcheck0 = $_POST['nurcheck0'];
$nurcheck1 = $_POST['nurcheck1'];
$nurcheck2 = $_POST['nurcheck2'];
$nurcheck3 = $_POST['nurcheck3'];
$nurcheck4 = $_POST['nurcheck4'];
$nurcheck5 = $_POST['nurcheck5'];
$nurcheck6 = $_POST['nurcheck6'];
$nurcheck7 = $_POST['nurcheck7'];
$nurcheck8 = $_POST['nurcheck8'];
$nurcheck9 = $_POST['nurcheck9'];
$nurcheck10 = $_POST['nurcheck10'];
$additional1 = $_POST['additional1'];
$rnsign1 = $_POST['rnsign1'];
$rndate1 = $_POST['rndate1'];
$rntime1 = $_POST['rntime1'];
$txt1 = $_POST['txt1'];
$txt2 = $_POST['txt2'];
// print_r($rntime1);die;


if ($id && $id != 0) {
    sqlStatement(
        "UPDATE form_daily_nursing SET patient =?,dob=?,date=?,time=?,check1=?,check2=?,check3=?,check4=?,check5=?,check6=?,check7=?,check8=?,check9=?,check10=?,check11=?,check12=?,check13=?,check14=?,check15=?,check16=?,check17=?,check18=?,check19=?,check20=?,check21=?,check22=?,check23=?,check24=?,check25=?,check26=?,check27=?,check28=?,check29=?,check30=?,check31=?,check32=?,check33=?,check34=?,check35=?,check36=?,check37=?,check38=?,check39=?,check40=?,check41=?,check42=?,check43=?,check44=?,check45=?,check46=?,check47=?,check48=?,check49=?,check50=?,check51=?,check52=?,check53=?,check54=?,check55=?,check56=?,check57=?,check58=?,check59=?,check60=?,check61=?,check62=?,check63=?,check64=?,check65=?,check66=?,check67=?,check68=?,check69=?,check70=?,check71=?,check72=?,check73=?,check74=?,check75=?,check76=?,check77=?,check78=?,check79=?,check80=?,check81=?,check82=?,check83=?,check84=?,check85=?,check86=?,check87=?,check88=?,check89=?,check90=?,check91=?,check92=?,check93=?,check94=?,check95=?,check96=?,check97=?,check98=?,check99=?,   check100=?,   check101=?,   check102=?,   check103=?,   check104=?,   check105=?,   othertext1=?,othertext2=?,othertext3=?,othertext4=?,othertext5=?,othertext6=?,othertext7=?,othertext8=?,plantext1 =?,plantext2 =?,plantext3 =?,meancheck1=?,meancheck2=?,meantext1 =?,meantext2 =?,meantext3 =?,meantext4 =?,meantext5 =?,intercheck1=?,intercheck2=?,intercheck3=?,intercheck4=?,intercheck5=?,intercheck6=?,intercheck7=?,intercheck8=?,intercheck9=?,intercheck10=?,intertext1=?,mealcheck1=?,mealcheck2=?,mealcheck3=?,mealtext1=?,mealtext2=?,mealtext3=?,objcheck1=?,objcheck2=?,objcheck3=?,objcheck4=?,vtext1=?,vtext2=?,vtext3=?,vtext4=?,vtext5=?,vtext6=?,ptcheck1=?,ptcheck2=?,ptcheck3=?,ptcheck4=?,ptcheck5=?,ptcheck6=?,ptcheck7=?,ptcheck8=?,ptcheck9=?,ptcheck10 =?,ptcheck11=?,ptcheck12=?,ptcheck13=?,ptcheck14=?,ptcheck15=?,ptcheck16=?,ptcheck17=?,ptcheck18=?,ptcheck19=?,ptcheck20=?,ptcheck21=?,ptcheck22=?,ptcheck23=?,ptcheck24=?,ptcheck25=?,pttext1=?,pttext2=?,pttext3=?,pttext4=?,pttext5=?,pttext6=?,pttext7=?,pttext8=?,pttext9 =?,pttext10=?,pttext11=?,pttext12=?,pttext13=?,goalcheck0=?,goalcheck1=?,goalcheck2=?,goalcheck3=?,goalcheck4=?,goalcheck5=?,goalcheck6=?,goalcheck7=?,goalcheck8=?,goalcheck9=?,goalcheck10=?,subjective=?,additional=?,rnsign=?,rndate=?,rntime=?,evecheck1=?,evecheck2=?,evecheck3=?,evecheck4=?,medcheck1=?,medcheck2=?,medcheck3=?,medcheck4=?,medcheck5=?,medcheck6=?,medcheck7=?,medcheck8=?,medcheck9=?,medcheck10=?,medcheck11=?,medcheck12=?,medcheck13=?,medcheck14=?,medcheck15=?,medcheck16=?,medcheck17=?,medcheck18=?,medcheck19=?,medcheck20=?,medcheck21=?,medcheck22=?,medcheck23=?,medcheck24=?,medcheck25=?,medtext1=?,medtext2=?,medtext3=?,medtext4=?,medtext5=?,medtext6=?,medtext7=?,medtext8=?,medtext9=?,medtext10=?,medtext11=?,medtext12=?,medtext13=?,nurcheck0=?,nurcheck1=?,nurcheck2=?,nurcheck3=?,nurcheck4=?,nurcheck5=?,nurcheck6=?,nurcheck7=?,nurcheck8=?,nurcheck9=?,nurcheck10=?,additional1=?,rnsign1= ?,rndate1= ?,rntime1= ?,txt1,txt2 WHERE id= ?",
        array($patient,   $dob,   $date,   $time,   $check1,   $check2,   $check3,$check4,$check5,$check6,$check7,$check8,$check9,$check10,   $check11,   $check12,   $check13,   $check14,   $check15,$check16,   $check17,   $check18,   $check19,   $check20,$check21,   $check22,   $check23,   $check24,   $check25,$check26,   $check27,   $check28,   $check29,   $check30,$check31,   $check32,   $check33,   $check34,   $check35,$check36,   $check37,   $check38,   $check39,   $check40,$check41,   $check42,   $check43,   $check44,   $check45,$check46,   $check47,   $check48,   $check49,   $check50,$check51,   $check52,   $check53,   $check54,   $check55,$check56,   $check57,   $check58,   $check59,   $check60,$check61,   $check62,   $check63,   $check64,   $check65,$check66,   $check67,   $check68,   $check69,   $check70,$check71,   $check72,   $check73,   $check74,   $check75,$check76,   $check77,   $check78,   $check79,   $check80,$check81,   $check82,   $check83,   $check84,   $check85,$check86,   $check87,   $check88,   $check89,   $check90,$check91,   $check92,   $check93,   $check94,   $check95,$check96,   $check97,   $check98,   $check99,   $check100,   $check101,   $check102,   $check103,   $check104,   $check105,   $othertext1,$othertext2,$othertext3,$othertext4,$othertext5,$othertext6,$othertext7,$othertext8,$plantext1,$plantext2,$plantext3,$meancheck1,$meancheck2,$meantext1,$meantext2,$meantext3,$meantext4,$meantext5,$intercheck1,$intercheck2,$intercheck3,$intercheck4,$intercheck5,$intercheck6,$intercheck7,$intercheck8,$intercheck9,$intercheck10,$intertext1,$mealcheck1,$mealcheck2,$mealcheck3,$mealtext1,$mealtext2,$mealtext3,$objcheck1,$objcheck2,$objcheck3,$objcheck4,$vtext1,$vtext2,$vtext3,$vtext4,$vtext5,$vtext6,$ptcheck1,$ptcheck2,$ptcheck3,$ptcheck4,$ptcheck5,$ptcheck6,$ptcheck7,$ptcheck8,$ptcheck9,$ptcheck10,$ptcheck11,$ptcheck12,$ptcheck13,$ptcheck14,$ptcheck15,$ptcheck16,$ptcheck17,$ptcheck18,$ptcheck19,$ptcheck20,$ptcheck21,$ptcheck22,$ptcheck23,$ptcheck24,$ptcheck25,$pttext1,$pttext2,$pttext3,$pttext4,$pttext5,$pttext6,$pttext7,$pttext8,$pttext9,$pttext10,$pttext11,$pttext12,$pttext13,$goalcheck0,$goalcheck1,$goalcheck2,$goalcheck3,$goalcheck4,$goalcheck5,$goalcheck6,$goalcheck7,$goalcheck8,$goalcheck9,$goalcheck10,$subjective,$additional,$rnsign,$rndate,$rntime,$evecheck1,$evecheck2,$evecheck3,$evecheck4,$medcheck1,$medcheck2,$medcheck3,$medcheck4,$medcheck5,$medcheck6,$medcheck7,$medcheck8,$medcheck9,$medcheck10,$medcheck11,$medcheck12,$medcheck13,$medcheck14,$medcheck15,$medcheck16,$medcheck17,$medcheck18,$medcheck19,$medcheck20,$medcheck21,$medcheck22,$medcheck23,$medcheck24,$medcheck25,$medtext1,$medtext2,$medtext3,$medtext4,$medtext5,$medtext6,$medtext7,$medtext8,$medtext9,$medtext10,$medtext11,$medtext12,$medtext13,$nurcheck0,$nurcheck1,$nurcheck2,$nurcheck3,$nurcheck4,$nurcheck5,$nurcheck6,$nurcheck7,$nurcheck8,$nurcheck9,$nurcheck10,$additional1,$rnsign1,$rndate1,$rntime1,$txt1,$txt2, $id
        )
    );
} else {
    $newid = sqlInsert(
        "INSERT INTO form_daily_nursing(pid,encounter,patient ,   
dob,   
date,   
time,   
check1,   
check2,   
check3,   
check4,   
check5,   
check6,   
check7,   
check8,   
check9,   
check10,   
check11,   
check12,   
check13,   
check14,   
check15,   
check16,   
check17,   
check18,   
check19,   
check20,   
check21,   
check22,   
check23,   
check24,   
check25,   
check26,   
check27,   
check28,   
check29,   
check30,   
check31,   
check32,   
check33,   
check34,   
check35,   
check36,   
check37,   
check38,   
check39,   
check40,   
check41,   
check42,   
check43,   
check44,   
check45,   
check46,   
check47,   
check48,   
check49,   
check50,   
check51,   
check52,   
check53,   
check54,   
check55,   
check56,   
check57,   
check58,   
check59,   
check60,   
check61,   
check62,   
check63,   
check64,   
check65,   
check66,   
check67,   
check68,   
check69,   
check70,   
check71,   
check72,   
check73,   
check74,   
check75,   
check76,   
check77,   
check78,   
check79,   
check80,   
check81,   
check82,   
check83,   
check84,   
check85,   
check86,   
check87,   
check88,   
check89,   
check90,   
check91,   
check92,   
check93,   
check94,   
check95,   
check96,   
check97,   
check98,   
check99,   
check100,   
check101,   
check102,   
check103,   
check104,   
check105,   
othertext1,

othertext2,

othertext3,

othertext4,

othertext5,

othertext6,

othertext7,

othertext8,

plantext1 ,

plantext2 ,

plantext3 ,

meancheck1,

meancheck2,

meantext1 ,

meantext2 ,

meantext3 ,

meantext4 ,

meantext5 ,

intercheck1,
intercheck2,
intercheck3,
intercheck4,
intercheck5,
intercheck6,
intercheck7,
intercheck8,
intercheck9,
intercheck10,
intertext1 ,
mealcheck1 ,
mealcheck2 ,
mealcheck3 ,
mealtext1 ,

mealtext2 ,

mealtext3 ,

objcheck1 ,

objcheck2 ,

objcheck3 ,

objcheck4 ,

vtext1 ,
vtext2 ,
vtext3 ,
vtext4 ,
vtext5 ,
vtext6 ,
ptcheck1 ,
ptcheck2 ,
ptcheck3 ,
ptcheck4 ,
ptcheck5 ,
ptcheck6 ,
ptcheck7 ,
ptcheck8 ,
ptcheck9 ,
ptcheck10 ,
ptcheck11 ,
ptcheck12 ,
ptcheck13 ,
ptcheck14 ,
ptcheck15 ,
ptcheck16 ,
ptcheck17 ,
ptcheck18 ,
ptcheck19 ,
ptcheck20 ,
ptcheck21 ,
ptcheck22 ,
ptcheck23 ,
ptcheck24 ,
ptcheck25 ,
pttext1 ,
pttext2 ,
pttext3 ,
pttext4 ,
pttext5 ,
pttext6 ,
pttext7 ,
pttext8 ,
pttext9  ,
pttext10 ,
pttext11 ,
pttext12 ,
pttext13 ,
goalcheck0 ,
goalcheck1 ,
goalcheck2 ,
goalcheck3 ,
goalcheck4 ,
goalcheck5 ,
goalcheck6 ,
goalcheck7 ,
goalcheck8 ,
goalcheck9 ,
goalcheck10,
subjective ,
additional ,
rnsign ,
rndate ,
rntime ,
evecheck1 ,

evecheck2 ,

evecheck3 ,

evecheck4 ,

medcheck1 ,

medcheck2 ,

medcheck3 ,

medcheck4 ,

medcheck5 ,

medcheck6 ,

medcheck7 ,

medcheck8 ,

medcheck9 ,

medcheck10 ,
medcheck11 ,
medcheck12 ,
medcheck13 ,
medcheck14 ,
medcheck15 ,
medcheck16 ,
medcheck17 ,
medcheck18 ,
medcheck19 ,
medcheck20 ,
medcheck21 ,
medcheck22 ,
medcheck23 ,
medcheck24 ,
medcheck25 ,
medtext1 ,

medtext2 ,

medtext3 ,

medtext4 ,

medtext5 ,

medtext6 ,

medtext7 ,

medtext8 ,

medtext9  ,

medtext10 ,

medtext11 ,

medtext12 ,

medtext13 ,

nurcheck0 ,

nurcheck1 ,

nurcheck2 ,

nurcheck3 ,

nurcheck4 ,

nurcheck5 ,

nurcheck6 ,

nurcheck7 ,

nurcheck8 ,

nurcheck9 ,

nurcheck10 ,
additional1,
rnsign1 ,
rndate1 ,
rntime1,
txt1,
txt2)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        array(
            $_SESSION["pid"], $_SESSION["encounter"], $patient ,   
$dob     ,   
$date    ,   
$time    ,   
$check1  ,   
$check2  ,   
$check3  ,   
$check4  ,   
$check5  ,   
$check6  ,   
$check7  ,   
$check8  ,   
$check9  ,   
$check10 ,   
$check11 ,   
$check12 ,   
$check13 ,   
$check14 ,   
$check15 ,   
$check16 ,   
$check17 ,   
$check18 ,   
$check19 ,   
$check20 ,   
$check21 ,   
$check22 ,   
$check23 ,   
$check24 ,   
$check25 ,   
$check26 ,   
$check27 ,   
$check28 ,   
$check29 ,   
$check30 ,   
$check31 ,   
$check32 ,   
$check33 ,   
$check34 ,   
$check35 ,   
$check36 ,   
$check37 ,   
$check38 ,   
$check39 ,   
$check40 ,   
$check41 ,   
$check42 ,   
$check43 ,   
$check44 ,   
$check45 ,   
$check46 ,   
$check47 ,   
$check48 ,   
$check49 ,   
$check50 ,   
$check51 ,   
$check52 ,   
$check53 ,   
$check54 ,   
$check55 ,   
$check56 ,   
$check57 ,   
$check58 ,   
$check59 ,   
$check60 ,   
$check61 ,   
$check62 ,   
$check63 ,   
$check64 ,   
$check65 ,   
$check66 ,   
$check67 ,   
$check68 ,   
$check69 ,   
$check70 ,   
$check71 ,   
$check72 ,   
$check73 ,   
$check74 ,   
$check75 ,   
$check76 ,   
$check77 ,   
$check78 ,   
$check79 ,   
$check80 ,   
$check81 ,   
$check82 ,   
$check83 ,   
$check84 ,   
$check85 ,   
$check86 ,   
$check87 ,   
$check88 ,   
$check89 ,   
$check90 ,   
$check91 ,   
$check92 ,   
$check93 ,   
$check94 ,   
$check95 ,   
$check96 ,   
$check97 ,   
$check98 ,   
$check99 ,   
$check100,   
$check101,   
$check102,   
$check103,   
$check104,   
$check105,   
$othertext1,
$othertext2,
$othertext3,
$othertext4,
$othertext5,
$othertext6,
$othertext7,
$othertext8,
$plantext1 ,
$plantext2 ,
$plantext3 ,
$meancheck1,
$meancheck2,
$meantext1 ,
$meantext2 ,
$meantext3 ,
$meantext4 ,
$meantext5 ,
$intercheck1,
$intercheck2,
$intercheck3,
$intercheck4,
$intercheck5,
$intercheck6,
$intercheck7,
$intercheck8,
$intercheck9,
$intercheck10,
$intertext1 ,
$mealcheck1 ,
$mealcheck2 ,
$mealcheck3 ,
$mealtext1 ,
$mealtext2 ,
$mealtext3 ,
$objcheck1 ,
$objcheck2 ,
$objcheck3 ,
$objcheck4 ,
$vtext1 ,
$vtext2 ,
$vtext3 ,
$vtext4 ,
$vtext5 ,
$vtext6 ,
$ptcheck1 ,
$ptcheck2 ,
$ptcheck3 ,
$ptcheck4 ,
$ptcheck5 ,
$ptcheck6 ,
$ptcheck7 ,
$ptcheck8 ,
$ptcheck9 ,
$ptcheck10 ,
$ptcheck11 ,
$ptcheck12 ,
$ptcheck13 ,
$ptcheck14 ,
$ptcheck15 ,
$ptcheck16 ,
$ptcheck17 ,
$ptcheck18 ,
$ptcheck19 ,
$ptcheck20 ,
$ptcheck21 ,
$ptcheck22 ,
$ptcheck23 ,
$ptcheck24 ,
$ptcheck25 ,
$pttext1 ,
$pttext2 ,
$pttext3 ,
$pttext4 ,
$pttext5 ,
$pttext6 ,
$pttext7 ,
$pttext8 ,
$pttext9  ,
$pttext10 ,
$pttext11 ,
$pttext12 ,
$pttext13 ,
$goalcheck0 ,
$goalcheck1 ,
$goalcheck2 ,
$goalcheck3 ,
$goalcheck4 ,
$goalcheck5 ,
$goalcheck6 ,
$goalcheck7 ,
$goalcheck8 ,
$goalcheck9 ,
$goalcheck10,
$subjective ,
$additional ,
$rnsign ,
$rndate ,
$rntime ,
$evecheck1 ,
$evecheck2 ,
$evecheck3 ,
$evecheck4 ,
$medcheck1 ,
$medcheck2 ,
$medcheck3 ,
$medcheck4 ,
$medcheck5 ,
$medcheck6 ,
$medcheck7 ,
$medcheck8 ,
$medcheck9 ,
$medcheck10 ,
$medcheck11 ,
$medcheck12 ,
$medcheck13 ,
$medcheck14 ,
$medcheck15 ,
$medcheck16 ,
$medcheck17 ,
$medcheck18 ,
$medcheck19 ,
$medcheck20 ,
$medcheck21 ,
$medcheck22 ,
$medcheck23 ,
$medcheck24 ,
$medcheck25 ,
$medtext1 ,
$medtext2 ,
$medtext3 ,
$medtext4 ,
$medtext5 ,
$medtext6 ,
$medtext7 ,
$medtext8 ,
$medtext9  ,
$medtext10 ,
$medtext11 ,
$medtext12 ,
$medtext13 ,
$nurcheck0 ,
$nurcheck1 ,
$nurcheck2 ,
$nurcheck3 ,
$nurcheck4 ,
$nurcheck5 ,
$nurcheck6 ,
$nurcheck7 ,
$nurcheck8 ,
$nurcheck9 ,
$nurcheck10 ,
$additional1,
$rnsign1 ,
$rndate1 ,
$rntime1,
$txt1, 
$txt2        )
    );
    addForm($encounter, "Daily Nursing Assessment", $newid, "daily_nursing_assessment",  $_SESSION["pid"], $userauthorized);
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
