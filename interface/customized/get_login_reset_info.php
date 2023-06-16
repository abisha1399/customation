<?php

/**
 * portal/get_patient_info.php
 *
 * @package   OpenEMR
 * @link      https://www.open-emr.org
 * @author    Cassian LUP <cassi.lup@gmail.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2011 Cassian LUP <cassi.lup@gmail.com>
 * @copyright Copyright (c) 2016-2017 Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

// starting the PHP session
// Will start the (patient) portal OpenEMR session/cookie.
//require_once(dirname(__FILE__) . "/../src/Common/Session/SessionUtil.php");
//OpenEMR\Common\Session\SessionUtil::portalSessionStart(); 
// regenerating the session id to avoid session fixation attacks
//session_regenerate_id(true);
//
$site=isset($_GET['site'])?$_GET['site']:'default';
// landing page definition -- where to go if something goes wrong
$landingpage = "../login/login.php?site=$site";
//
$landingpage1 = "reset_login.php?site=$site";
//echo $landingpage1;exit();
// some validation
if (!isset($_POST['name']) || empty($_POST['name'])) {
    header('Location: ' . $landingpage1 );
    exit();
}

if (!isset($_POST['newpassword']) || empty($_POST['newpassword'])) {
    header('Location: ' . $landingpage1 );
    exit();
}

// // set the language
// if (! empty($_POST['languageChoice'])) {
//     $_SESSION['language_choice'] = (int) $_POST['languageChoice'];
// } else if (empty($_SESSION['language_choice'])) {
//     // just in case both are empty, then use english
//     $_SESSION['language_choice'] = 1;
// } else {
//     $_SESSION['language_choice'] = 1;
//     // keep the current session language token
// }

// Settings that will override globals.php
$ignoreAuth = true;
require_once("../globals.php");
//$logit = new ApplicationTable();

require_once("common_operations.php");
$plain_code = $_POST['newpassword'];


DEFINE("TBL_PAT_ACC_ON", "users_secure");
DEFINE("COL_PID", "id");
DEFINE("COL_POR_PWD", "password");
DEFINE("COL_POR_USER", "username");
DEFINE("COL_POR_SALT", "salt");

$sql = "SELECT " . implode(",", array(
    COL_PID,
    COL_POR_PWD,
    COL_POR_SALT,
)) . " FROM " . TBL_PAT_ACC_ON . " WHERE " . COL_POR_USER . "=?";
$auth = sqlQuery($sql, array(
    $_POST['name']
));


$_SESSION['username'] = $_POST['name'];
$sql = "SELECT * FROM `users` WHERE `id` = ?";

if ($userData = sqlQuery($sql, array(
    $auth['id']
))) { // if query gets executed

    if (empty($userData)) {
        header('Location:'.$landingpage.'&failure');
        exit();
    }


    if ($auth['id'] != $userData['id']) {
        // Not sure if this is even possible, but should escape if this happens
        header('Location:'.$landingpage.'&failure');
        exit();
    }



    if (isset($_POST['reset'])) {
        $code_new = $_POST["newpassword"];
        $code_new_confirm = $_POST["conpassword"];
        $name=$_POST["name"];
        if (! (empty($_POST['newpassword'])) && ! (empty($_POST['conpassword'])) && ($code_new == $code_new_confirm)) {
            $new_salt = oemr_password_salt();

            $new_hash = oemr_password_hash($code_new, $new_salt);

            // Update the password and continue (patient is authorized)
            $logpass= sqlStatement(
                "UPDATE " . TBL_PAT_ACC_ON . "  SET " . COL_POR_PWD . "=?," . COL_POR_SALT . "=? WHERE id=?",
                array(
                        $new_hash,
                        $new_salt,
                        $auth['id']
                )
            );  
 
        }
    }



} else { // problem with query
    header('Location:'.$landingpage.'&failure');
    exit();
}
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header('Location: '.$landingpage.'&success');
exit();
