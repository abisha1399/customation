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
// echo 'test';
// exit;
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');


$numbness = $_POST["numbness"];
$feeling = $_POST["feeling"];
$wobbliness = $_POST["wobbliness"];
$unable = $_POST["unable"];
$fear = $_POST["fear"];
$dizzy = $_POST["dizzy"];
$heart = $_POST["heart"];
$unsteady = $_POST["unsteady"];
$terrified = $_POST["terrified"];
$nervous = $_POST["nervous"];
$feeling_choking = $_POST["feeling_choking"];
$hands_trembling = $_POST["hands_trembling"];
$shaky_unsteady = $_POST["shaky_unsteady"];
$fear_losing_control = $_POST["fear_losing_control"];
$difficulty = $_POST["difficulty"];
$fear_dying = $_POST["fear_dying"];
$scared = $_POST["scared"];
$indigestion = $_POST["indigestion"];
$faint = $_POST["faint"];
$face = $_POST["face"];
$hot_cold = $_POST["hot_cold"];
$grand_score = $_POST["grand_score"];

if ($id && $id != 0) {
    sqlStatement("UPDATE `form_beck_anxiety_inventory` SET `pid`=?,`encounter`=?,`numbness`=?,`feeling`=?,`wobbliness`=?,`unable`=?,`fear`=?,`dizzy`=?,`heart`=?,`unsteady`=?,`terrified`=?,`nervous`=?,`feeling_choking`=?,`hands_trembling`=?,`shaky_unsteady`=?, `fear_losing_control`=?, `difficulty`=?, `fear_dying`=?, `scared`=?, `indigestion`=?, `faint`=?, `face`=?, `hot_cold`=?, `grand_score`=?
    WHERE id = ?",array($_SESSION["pid"],$_SESSION["encounter"],$numbness,$feeling,$wobbliness,$unable,$fear,$dizzy,$heart,$unsteady,$terrified,$nervous,$feeling_choking,$hands_trembling,$shaky_unsteady,$fear_losing_control,$difficulty,$fear_dying,$scared,$indigestion,$faint,$face,$hot_cold,$grand_score,$id));
}
else 
{
    // echo "INSERT INTO `form_beck_anxiety_inventory`(`pid`, `encounter`, `numbness`, `feeling`, `wobbliness`, `unable`, `fear`, `dizzy`, `heart`, `unsteady`, `terrified`, `nervous`, `feeling_choking`, `hands_trembling`, `shaky_unsteady`, `fear_losing_control`, `difficulty`, `fear_dying`, `scared`, `indigestion`, `faint`, `face`, `hot_cold`, `grand_score`) 
    // VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    // exit;
    $newid = sqlInsert("INSERT INTO `form_beck_anxiety_inventory`(`pid`, `encounter`, `numbness`, `feeling`, `wobbliness`, `unable`, `fear`, `dizzy`, `heart`, `unsteady`, `terrified`, `nervous`, `feeling_choking`, `hands_trembling`, `shaky_unsteady`, `fear_losing_control`, `difficulty`, `fear_dying`, `scared`, `indigestion`, `faint`, `face`, `hot_cold`, `grand_score`) 
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 

    array($_SESSION["pid"],$_SESSION["encounter"],$numbness,$feeling,$wobbliness,$unable,$fear,$dizzy,$heart,$unsteady,$terrified,$nervous,$feeling_choking,$hands_trembling,$shaky_unsteady,$fear_losing_control,$difficulty,$fear_dying,$scared,$indigestion,$faint,$face,$hot_cold,$grand_score));

    addForm($encounter, "beck anxiety inventory", $newid, "beck_anxiety_inventory",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
