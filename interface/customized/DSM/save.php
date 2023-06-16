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

//exit();
if ($id && $id != 0)
{
    $newid = update_form("form_dsm", $_POST, $id,$_GET['pid']);     
}
else
{    
    $newid = submit_form("form_dsm", $_POST, $_GET["pid"],$encounter);
    addForm($encounter, "DSM V", $newid, "DSM", $pid, $userauthorized);
}
function formSubmits($tableName, $values, $id,$encounter)
{
    global $attendant_type;

    $sqlBindingArray = [$_SESSION['pid'],$encounter,$_SESSION['authUser']];
    $sql = "insert into " . escape_table_name($tableName) . " set " .  escape_sql_column_name($attendant_type, array($tableName)) . "=?, encounter=?, user=?, activity=1, date = NOW(),";
    foreach ($values as $key => $value) {    
        if ($key == "csrf_token_form") {
            continue;
        }    
        
            $sql .= " " . escape_sql_column_name($key, array($tableName)) . " = ?,";
            $sqlBindingArray[] = $value;
       
    }

    $sql = substr($sql, 0, -1);
    return sqlInsert($sql, $sqlBindingArray);
}
function formUpdates($tableName, $values, $id)
{
    $sqlBindingArray = [$_SESSION['pid'], $_SESSION['authUser']];
    $sql = "update " . escape_table_name($tableName) . " set pid =?, user=? ,activity=1, date = NOW(),";
    foreach ($values as $key => $value) {
        if ($key == "csrf_token_form") {
            continue;
        }
        $sql .= " " . escape_sql_column_name($key, array($tableName)) . " = ?,";
        $sqlBindingArray[] = $value;
    }

    $sql = substr($sql, 0, -1);
    $sql .= " where id=?";
    $sqlBindingArray[] = $id;

    return sqlInsert($sql, $sqlBindingArray);
}

formHeader("Redirecting....");
formJump();
formFooter();
