<?php

/**
 * Clinical instructions form.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2017-2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
if ($formid) {
    $sql = "SELECT * FROM `form_nursing` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo xlt("Form Medication"); ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
    	input[type=text] {
          border: none;
          border-bottom: 2px solid black;
}
h4{
   font-size: 18px;
}
.bt{
	width: 100px;
    margin: auto;
    margin-top: 10px;
    display: flex;
}
.container{
	border: 2px solid black;
}
b{
	font-size: 13px;
}
table{
    border: 1px solid white;
}
    </style>
</head>
<body>
 <div class="container mt-3">
  <div class="container-fluid">
    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/form_nursing/save.php?id=<?php echo attr_url($formid); ?>">
    <div class="row">  
       <table class="table">
           <thead>
               <tr>
                  <td style="padding-bottom: 30px;float: left; "><h4>Nursing Admission Assessment</h4></td>
                  <td style="padding-bottom: 30px;float: right; "><h4>Center for Network Therapy</h4></td>
               </tr>
               <tr>
                  <td  style="padding-bottom: 30px;"><h4>Admission Note:</h4></td>
               </tr>
               <tr>
                   <td><p>
                   DATE: TIME: Pt admitted for DIAGNOSIS (OPIATE, BENZODIAZAPINE/SED/HYP, ETOH, CANNABIS, ETC.) Pt
c/o (CURRENT SYMPTOMS). Pt reports (DRUG HISTORY). Pt reports (STRESSORS). Pt (PAST MEDICAL
HISTORY). Pt (PYSCH HISTORY). PT (Current Medications). (Surgeries). (Treatment Hx). Pt AAO X3. NO
current evidence of Si/HI. NO AH/VH. VS. PERRLA. Pt present (MOOD). (AFFECT). Pt RECEIVED
(MEDICATIONS). TOLERATED WELL. Pt received one on one support. Pt safety precautions maintained.
Pt was educated about program, treatment plan, relapse prevention, withdrawal symptoms,
medications, drug interactions, risky behaviors, potential for overdose and possible death. Pt verbalized
understanding. Pt oriented to facility and facility rules. DOCUMENT IF PT RECEIVED PPD/ LABS. Pt
remains at risk for relapse/ noncompliance. Will continue to monitor.
                   </p></td>
               </tr>
               <tr>
                   <td style="float:left; "><b>Nurse Signature/ Credentials:</b><input type="text" name="nurse" value="<?php echo text($check_res['nurse']);?>"></td>
                     <td style="float: right; "><b>Date/Time:<input type="datetime-local" name="dtime" value="<?php echo text($check_res['dtime']);?>"></b></td>
               </tr>
           </thead>
       </table>
     	<h4 style="margin-bottom: 10px"></h4>
     </div>    
         
   <div class="btn-group bt" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-primary btn-save" style="margin-left: 15px;"><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>           
    </form>
   </div>
  </div>
</body>
</html>