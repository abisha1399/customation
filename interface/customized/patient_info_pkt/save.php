<?php

/**
 * patient orientation form save.php
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

// if (!$encounter) { // comes from globals.php
//     die(xlt("Internal error: we do not seem to be in an encounter!"));
// }

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

if ($id && $id != 0)
{
    $newid = update_form("patient_info_pkt", $_POST, $id,$_GET['pid']);
    formHeader("Redirecting....");
    formJump();
    formFooter();

}
else
{
    if($encounter){
    $newid = submit_form("patient_info_pkt", $_POST, $_GET["pid"],$encounter);
    addForm($encounter, "patient info packet", $newid, "patient_info_pkt", $pid, $userauthorized);
    
    formHeader("Redirecting....");
    formJump();
    formFooter();
    }
    else{
        $newid = submit_form("patient_info_pkt", $_POST, $_GET["pid"],0);
        echo "<script>window.location='$rootdir/patient_file/history/encounters.php';</script>";
        //echo "<script>alert('success');window.close();</script>";
    }
}
