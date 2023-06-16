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

$well = $_POST["well"];
$disheveled = $_POST["disheveled"];
$bizarre = $_POST["bizarre"];
$inappropriate = $_POST["inappropriate"];

$normal = $_POST["normal"];
$easily = $_POST["easily"];
$easilys = $_POST["easilys"];

$good = $_POST["good"];
$concentration = $_POST["concentration"];
$concentrations = $_POST["concentrations"];

$none = $_POST["none"];
$auditory = $_POST["auditory"];
$visual = $_POST["visual"];
$factory = $_POST["factory"];
$command = $_POST["command"];
$commands = $_POST["commands"];

$nones = $_POST["nones"];
$paraniod = $_POST["paraniod"];
$grandeur = $_POST["grandeur"];
$reference = $_POST["reference"];
$other = $_POST["other"];
$otheres = $_POST["otheres"];

$intact = $_POST["intact"];
$impaired = $_POST["impaired"];
$immediate = $_POST["immediate"];
$recent = $_POST["recent"];
$remote = $_POST["remote"];

$appears = $_POST["appears"];
$lowintelligence = $_POST["lowintelligence"];
$lowintelligences = $_POST["lowintelligences"];


$spheres = $_POST["spheres"];
$impaireds = $_POST["impaireds"];
$person = $_POST["person"];
$place = $_POST["place"];
$time = $_POST["time"];

$appropriates = $_POST["appropriates"];
$harmful = $_POST["harmful"];
$unacceptable = $_POST["unacceptable"];
$unknown = $_POST["unknown"];

$goods = $_POST["goods"];
$fair = $_POST["fair"];
$poor = $_POST["poor"];
$denial = $_POST["denial"];
$blames = $_POST["blames"];

$intacts = $_POST["intacts"];
$poors = $_POST["poors"];
$unknowns = $_POST["unknowns"];

$appropriate = $_POST["appropriate"];
$suicide = $_POST["suicide"];
$homicide = $_POST["homicide"];
$illness = $_POST["illness"];
$compulsions = $_POST["compulsions"];
$obsessions = $_POST["obsessions"];
$fear = $_POST["fear"];
$somatic = $_POST["somatic"];
$otherr = $_POST["otherr"];
$otherrs = $_POST["otherrs"];

$appropriats = $_POST["appropriats"];
$inappropriates = $_POST["inappropriates"];
$inappropriatee = $_POST["inappropriatee"];

$euthymic = $_POST["euthymic"];
$others = $_POST["others"];
$othee = $_POST["othee"];

$normals = $_POST["normals"];
$slurres = $_POST["slurres"];
$slow = $_POST["slow"];
$pressured = $_POST["pressured"];
$loud = $_POST["loud"];

$appropriatss = $_POST["appropriatss"];
$inappropriatess = $_POST["inappropriatess"];

$normales = $_POST["normales"];
$narcissistic = $_POST["narcissistic"];
$homicides = $_POST["homicides"];
$ideas = $_POST["ideas"];
$tangential = $_POST["tangential"];
$loose = $_POST["loose"];
$confusion = $_POST["confusion"];
$blocking = $_POST["blocking"];
$obsession = $_POST["obsession"];
$flight = $_POST["flight"];

$no = $_POST["no"];
$interrupted = $_POST["interrupted"];
$increased = $_POST["increased"];
$increaseds = $_POST["increaseds"];
$decreased = $_POST["decreased"];
$decreaseds = $_POST["decreaseds"];

$increasedes = $_POST["increasedes"];
$decreasedes = $_POST["decreasedes"];
$nochange = $_POST["nochange"];
$weight = $_POST["weight"];
$weights = $_POST["weights"];
$gain = $_POST["gain"];
$gains = $_POST["gains"];

$anorexia = $_POST["anorexia"];
$bulemia = $_POST["bulemia"];

$anorexias = $_POST["anorexias"];

if ($id && $id != 0) {
    sqlStatement("UPDATE `form_mental` SET `pid`=?,`encounter`=?,`well`=?,`disheveled`=?,
    `bizarre`=?,`inappropriate`=?,`normal`=?,`easily`=?,`easilys`=?,
    `good`=?,`concentration`=?,`concentrations`=?,`none`=?,
    `auditory`=?,`visual`=?,`factory`=?,`command`=?,`commands`=?,
    `nones`=?,`paraniod`=?,`grandeur`=?,`reference`=?,`other`=?,
    `otheres`=?,`intact`=?,`impaired`=?,`immediate`=?,`recent`=?,
    `remote`=?,`appears`=?,`lowintelligence`=?,`lowintelligences`=?,
    `spheres`=?,`impaireds`=?,`person`=?,`place`=?,`time`=?,
    `appropriates`=?,`harmful`=?,`unacceptable`=?,`unknown`=?,
    `goods`=?,`fair`=?,`poor`=?,`denial`=?,`blames`=?,
    `intacts`=?,`poors`=?,`unknowns`=?,`appropriate`=?,
    `suicide`=?,`homicide`=?,`illness`=?,`compulsions`=?,
    `obsessions`=?,`fear`=?,`somatic`=?,`otherr`=?,
    `otherrs`=?,`appropriats`=?,`inappropriates`=?,`inappropriatee`=?,
    `euthymic`=?,`others`=?,`othee`=?,`normals`=?,`slurres`=?,
    `slow`=?,`pressured`=?,`loud`=?,`appropriatss`=?,
    `inappropriatess`=?,`normales`=?,`narcissistic`=?,`homicides`=?,
    `ideas`=?,`tangential`=?,`loose`=?,`confusion`=?,
    `blocking`=?,`obsession`=?,`flight`=?,`no`=?,`interrupted`=?,
    `increased`=?,`increaseds`=?,`decreased`=?,`decreaseds`=?,
    `increasedes`=?,`decreasedes`=?,`nochange`=?,`weight`=?,
    `weights`=?,`gain`=?,`gains`=?,`anorexia`=?,`bulemia`=?,
    `anorexias`=? WHERE id = ?",array($_SESSION["pid"],$_SESSION["encounter"],$well,$disheveled,$bizarre,$inappropriate,
    $normal,$easily,$easilys,
    $good,$concentration,$concentrations,
    $none,$auditory,$visual,$factory,$command,$commands,
    $nones,$paraniod,$grandeur,$reference,$other,$otheres,
    $intact,$impaired,$immediate,$recent,$remote,
    $appears,$lowintelligence,$lowintelligences,
    $spheres,$impaireds,$person,$place,$time,
    $appropriates,$harmful,$unacceptable,$unknown,
    $goods,$fair,$poor,$denial,$blames,
    $intacts,$poors,$unknowns,
    $appropriate,$suicide,$homicide,$illness,$compulsions,$obsessions,$fear,$somatic,$otherr,$otherrs,
    $appropriats,$inappropriates,$inappropriatee,
    $euthymic,$others,$othee,
    $normals,$slurres,$slow,$pressured,$loud,
    $appropriatss,$inappropriatess,
    $normales,$narcissistic,$homicides,$ideas,$tangential,$loose,$confusion,$blocking,$obsession,$flight,
    $no,$interrupted,$increased,$increaseds,$decreased,$decreaseds,
    $increasedes,$decreasedes,$nochange,$weight,$weights,$gain,$gains,
    $anorexia,$bulemia,$anorexias,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO `form_mental`(`pid`,`encounter`, `well`, `disheveled`, `bizarre`, `inappropriate`,
     `normal`, `easily`, `easilys`, `good`, `concentration`, `concentrations`, `none`, `auditory`,
      `visual`, `factory`, `command`, `commands`, `nones`, `paraniod`, `grandeur`, `reference`, 
      `other`, `otheres`, `intact`, `impaired`, `immediate`, `recent`, `remote`, `appears`, 
      `lowintelligence`, `lowintelligences`, `spheres`, `impaireds`, `person`, `place`, `time`, 
      `appropriates`, `harmful`, `unacceptable`, `unknown`, `goods`, `fair`, `poor`, `denial`, 
      `blames`, `intacts`, `poors`, `unknowns`, `appropriate`, `suicide`, `homicide`, `illness`, 
      `compulsions`, `obsessions`, `fear`, `somatic`, `otherr`, `otherrs`, `appropriats`, `inappropriates`,
       `inappropriatee`, `euthymic`, `others`, `othee`, `normals`, `slurres`, `slow`, `pressured`, `loud`, 
       `appropriatss`, `inappropriatess`, `normales`, `narcissistic`, `homicides`, `ideas`, `tangential`,
        `loose`, `confusion`, `blocking`, `obsession`, `flight`, `no`, `interrupted`, `increased`, 
        `increaseds`, `decreased`, `decreaseds`, `increasedes`, `decreasedes`, `nochange`, `weight`, 
        `weights`, `gain`, `gains`, `anorexia`, `bulemia`, `anorexias`) 
     VALUES (?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,?,?,?,
             ?,?,?,?,?,?,?,?)", 

    array($_SESSION["pid"],$_SESSION["encounter"],$well,$disheveled,$bizarre,$inappropriate,
    $normal,$easily,$easilys,
    $good,$concentration,$concentrations,
    $none,$auditory,$visual,$factory,$command,$commands,
    $nones,$paraniod,$grandeur,$reference,$other,$otheres,
    $intact,$impaired,$immediate,$recent,$remote,
    $appears,$lowintelligence,$lowintelligences,
    $spheres,$impaireds,$person,$place,$time,
    $appropriates,$harmful,$unacceptable,$unknown,
    $goods,$fair,$poor,$denial,$blames,
    $intacts,$poors,$unknowns,
    $appropriate,$suicide,$homicide,$illness,$compulsions,$obsessions,$fear,$somatic,$otherr,$otherrs,
    $appropriats,$inappropriates,$inappropriatee,
    $euthymic,$others,$othee,
    $normals,$slurres,$slow,$pressured,$loud,
    $appropriatss,$inappropriatess,
    $normales,$narcissistic,$homicides,$ideas,$tangential,$loose,$confusion,$blocking,$obsession,$flight,
    $no,$interrupted,$increased,$increaseds,$decreased,$decreaseds,
    $increasedes,$decreasedes,$nochange,$weight,$weights,$gain,$gains,
    $anorexia,$bulemia,$anorexias));

    addForm($encounter, "mental status", $newid, "form_mental",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
