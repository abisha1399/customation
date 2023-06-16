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

if ($id && $id != 0) {

    sqlStatement("UPDATE `tuberculin_form` SET input1=?,input2=?,input3=?,input4=?,input5=?,input6=?,input7=?,input8=?,input9=?,input10=?,input11=?,input12=?,input13=?,input14=?,input15=?,input16=?,input17=?,input18=?,input19=?,input20=?,input21=?,input22=? WHERE id = ?", array($input1,$input2,$input3,$input4,$input5,$input6,$input7,$input8,$input9,$input10,$input11,$input12,$input13,$input14,$input15,$input16,$input17,$input18,$input19,$input20,$input21,$input22,$id));
}else 
{
    // echo "test";
    // die();
    $newid = sqlInsert("INSERT INTO tuberculin_form (pid,encounter,input1,input2,input3,input4,input5,input6,input7,input8,input9,input10,input11,input12,input13,input14,input15,input16,input17,input18,input19,input20,input21,input22,input23) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
    array($_SESSION["pid"],$_SESSION["encounter"],$input1,$input2,$input3,$input4,$input5,$input6,$input7,$input8,$input9,$input10,$input11,$input12,$input13,$input14,$input15,$input16,$input17,$input18,$input19,$input20,$input21,$input22,$input23));
    addForm($encounter, "Tuberculin form", $newid, "tuberculin_skin_form",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();