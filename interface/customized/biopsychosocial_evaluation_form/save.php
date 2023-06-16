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

// $_POST['dimension1']= isset($_POST['dimension1'])?$_POST['dimension1']:' ';
// $_POST['dimension2']= isset($_POST['dimension2'])?$_POST['dimension2']:' ';
// $_POST['dimension3']= isset($_POST['dimension3'])?$_POST['dimension3']:' ';
// $_POST['dimension4']= isset($_POST['dimension4'])?$_POST['dimension4']:' ';
// $_POST['dimension5']= isset($_POST['dimension5'])?$_POST['dimension5']:' ';
// $_POST['dimension6']= isset($_POST['dimension6'])?$_POST['dimension6']:' ';


if ($id && $id != 0) {
    $newid = update_form("form_biopsychosocial_evaluation", $_POST, $id,$_GET['pid']);   
}
else 
{   
    $newid = submit_form("form_biopsychosocial_evaluation", $_POST, $_GET["pid"],$encounter);    

    addForm($encounter, "biopsychosocial evaluation status", $newid, "biopsychosocial_evaluation_form",  $_SESSION["pid"], $userauthorized);
}



formHeader("Redirecting....");
formJump();
formFooter();
