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
header('Access-Control-Allow-Origin: *');
$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;
require_once(__DIR__ . "/../../globals.php");
 require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
require_once('../form_custom.php');

use OpenEMR\Common\Csrf\CsrfUtils;
$id              = $_GET['id'];
$pid              = $_SESSION['pid'];
if ($id && $id != 0) {
    $newid = formUpdate_new("form_assessment_intake", $_POST, $_GET["id"],$_GET['pid']);
    if($newid)
    {
        
        if($_SESSION['authUser']){
            echo "<script>window.location='$rootdir/patient_file/summary/demographics.php?" .
            "set_pid=" . attr_url($pid) . "&is_new=1';</script>";
        }else{    
          echo "<script>alert('patient data inserted successfully');
          window.close();
          </script>";
          
      }
      
        
    }
    
} else {
    
    $newid = formSubmit_new("form_assessment_intake", $_POST, $_GET["pid"]);
    if($newid)
    {
       
        echo "<script>alert('patient data inserted successfully...');
        window.close();
        </script>";
    }
   
     
}

