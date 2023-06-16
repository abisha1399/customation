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

$nurse = $_POST["nurse"];
$dtime = $_POST["dtime"];

if ($id && $id != 0) {
    sqlStatement("UPDATE `form_nursing` SET `pid`=?,`encounter`=?,`nurse`=?,`dtime`=? WHERE id = ?",array($_SESSION["pid"],$_SESSION["encounter"],$nurse,$dtime,$id));
}else 
{
    $newid = sqlInsert("INSERT INTO `form_nursing`(`pid`, `encounter`, `nurse`, `dtime`) 
     VALUES (?,?,?,?)", 

    array($_SESSION["pid"],$_SESSION["encounter"],$nurse,$dtime));

    addForm($encounter, "nurse status", $newid, "form_nursing",  $_SESSION["pid"], $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
