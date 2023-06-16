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

$_POST['dimension1']= isset($_POST['dimension1'])?$_POST['dimension1']:' ';
$_POST['dimension2']= isset($_POST['dimension2'])?$_POST['dimension2']:' ';
$_POST['dimension3']= isset($_POST['dimension3'])?$_POST['dimension3']:' ';
$_POST['dimension4']= isset($_POST['dimension4'])?$_POST['dimension4']:' ';
$_POST['dimension5']= isset($_POST['dimension5'])?$_POST['dimension5']:' ';
$_POST['dimension6']= isset($_POST['dimension6'])?$_POST['dimension6']:' ';

$_POST['code_pb1']= isset($_POST['code_pb1'])?$_POST['code_pb1']:' ';
$_POST['code_pb2']= isset($_POST['code_pb2'])?$_POST['code_pb2']:' ';
$_POST['code_pb3']= isset($_POST['code_pb3'])?$_POST['code_pb3']:' ';
$_POST['code_pb4']= isset($_POST['code_pb4'])?$_POST['code_pb4']:' ';
$_POST['code_pb5']= isset($_POST['code_pb5'])?$_POST['code_pb5']:' ';
$_POST['code_pb6']= isset($_POST['code_pb6'])?$_POST['code_pb6']:' ';
$_POST['code_pb7']= isset($_POST['code_pb7'])?$_POST['code_pb7']:' ';
$_POST['code_pb8']= isset($_POST['code_pb8'])?$_POST['code_pb8']:' ';
$_POST['code_pb9']= isset($_POST['code_pb9'])?$_POST['code_pb9']:' ';

//exit();
if ($id && $id != 0)
{
    $newid = update_form("form_individual_form", $_POST, $id,$_GET['pid']);
}
else
{
    $newid = submit_form("form_individual_form", $_POST, $_GET["pid"],$encounter);
    addForm($encounter, "Individual Notes", $newid, "individual_form", $pid, $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
