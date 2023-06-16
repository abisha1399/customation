<?php
$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;
require_once("../globals.php");
$id=isset($_GET['id'])?$_GET['id']:'';
$location=sqlQuery("SELECT * FROM terra_googlefit WHERE id=?",array($id));
$web_root1=isset($location['urllink'])?$location['urllink']:'';
if(!empty($location))
{
    header('Location: ' . $web_root1 .'');
    exit();
}
?>