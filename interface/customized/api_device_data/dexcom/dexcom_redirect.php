<?php

/**
 * external_data.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Vinish K <vinish@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */
$ignoreAuth = true;
$sessionAllowWrite = true;
require_once("../../../globals.php");
require_once("$srcdir/patient.inc");
require_once "$srcdir/options.inc.php";
$pid=isset($_GET['pid'])?$_GET['pid']:1;
//$site=isset($_SESSION['site_id'])?$_SESSION['site_id']:'';
$provider_id=isset($_GET['authUserID'])?$_GET['authUserID']:'';
setcookie ("dexcompid",$pid, time()+3600*24*365*10, '/');
//setcookie ("site",$site, time()+3600*24*365*10, '/');
setcookie ("provider_id",$provider_id, time()+3600*24*365*10, '/');
$client_id='LOx6HfmEtvDulws0573fUVw9bzaim0st';
$url='https://api.dexcom.com';
$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://" . $_SERVER['HTTP_HOST'];
$redirect_uri=$http.$GLOBALS['webroot'].'/interface/customized/api_device_data/dexcom/dexcom_token.php';
$web_root1="".$url."/v2/oauth2/login?client_id=".$client_id."&redirect_uri=".$redirect_uri."&response_type=code&scope=offline_access&state=";
//echo $web_root1;exit();
header('Location: ' . $web_root1 .'');
exit();
?>