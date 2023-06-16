<?php

/**
 * Medication Education Document form.
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
    $sql = "SELECT * FROM `form_medication_order` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();
 
?>
<html>
    <head>
        <title><?php echo xlt("Medication Order Form"); ?></title>
        <?php Header::setupHeader(); ?>
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;"> 
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/medication_order_form/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />       
                    <div class="col-12 mt-3">    
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label>Patient Name:</label>
                                </td> 
                                <td style="width:30%;">
                                    <input type="text" name="patient" class="form-control" value="<?php echo text($check_res['patient']);?>"/>
                                </td> 
                                <td style="width:40%;">
                                     
                                </td> 
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label>DOB:</label>
                                </td> 
                                <td style="width:30%;">
                                    <input type="date" name="date" class="form-control" value="<?php echo text($check_res['date']);?>"/>
                                </td> 
                                <td style="width:40%;">
                                     
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label>Allergies:</label>
                                </td> 
                                <td style="width:30%;">
                                    <input type="text" name="allergy" class="form-control" value="<?php echo text($check_res['allergy']);?>"/>
                                </td> 
                                <td style="width:40%;">      
                                </td> 
                            </tr>
                        </table>
                        <br/>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="text-center"><b>Medication Order Form</b></h4>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <th>Date/Time</th>
                                <th>Medication, Dosage, Frequency & Route</th>
                                <th>Indication</th>
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date1" class="form-control" value="<?php echo text($check_res['date1']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication1" class="form-control" value="<?php echo text($check_res['medication1']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication1" class="form-control" value="<?php echo text($check_res['indication1']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date2" class="form-control" value="<?php echo text($check_res['date2']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication2" class="form-control" value="<?php echo text($check_res['medication2']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication2" class="form-control" value="<?php echo text($check_res['indication2']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date3" class="form-control" value="<?php echo text($check_res['date3']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication3" class="form-control" value="<?php echo text($check_res['medication3']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication3" class="form-control" value="<?php echo text($check_res['indication3']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date4" class="form-control" value="<?php echo text($check_res['date4']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication4" class="form-control" value="<?php echo text($check_res['medication4']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication4" class="form-control" value="<?php echo text($check_res['indication4']);?>"/>
                                </td>
                            </tr>
                            <tr>
                            <td> 
                                <input type="datetime-local" name="date5" class="form-control" value="<?php echo text($check_res['date5']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication5" class="form-control" value="<?php echo text($check_res['medication5']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication5" class="form-control" value="<?php echo text($check_res['indication5']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date6" class="form-control" value="<?php echo text($check_res['date6']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication6" class="form-control" value="<?php echo text($check_res['medication6']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication6" class="form-control" value="<?php echo text($check_res['indication6']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date7" class="form-control" value="<?php echo text($check_res['date7']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication7" class="form-control" value="<?php echo text($check_res['medication7']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication7" class="form-control" value="<?php echo text($check_res['indication7']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date8" class="form-control" value="<?php echo text($check_res['date8']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication8" class="form-control" value="<?php echo text($check_res['medication8']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication8" class="form-control" value="<?php echo text($check_res['indication8']);?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date9" class="form-control" value="<?php echo text($check_res['date9']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication9" class="form-control" value="<?php echo text($check_res['medication9']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication9" class="form-control" value="<?php echo text($check_res['indication9']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date10" class="form-control" value="<?php echo text($check_res['date10']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication10" class="form-control" value="<?php echo text($check_res['medication10']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication10" class="form-control" value="<?php echo text($check_res['indication10']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date11" class="form-control" value="<?php echo text($check_res['date11']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication11" class="form-control" value="<?php echo text($check_res['medication11']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication11" class="form-control" value="<?php echo text($check_res['indication11']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date12" class="form-control" value="<?php echo text($check_res['date12']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication12" class="form-control" value="<?php echo text($check_res['medication12']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication12" class="form-control" value="<?php echo text($check_res['indication12']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date13" class="form-control" value="<?php echo text($check_res['date13']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication13" class="form-control" value="<?php echo text($check_res['medication13']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication13" class="form-control" value="<?php echo text($check_res['indication13']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date14" class="form-control" value="<?php echo text($check_res['date14']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication14" class="form-control" value="<?php echo text($check_res['medication14']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication14" class="form-control" value="<?php echo text($check_res['indication14']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date15" class="form-control" value="<?php echo text($check_res['date15']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication15" class="form-control" value="<?php echo text($check_res['medication15']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication15" class="form-control" value="<?php echo text($check_res['indication15']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date16" class="form-control" value="<?php echo text($check_res['date16']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication16" class="form-control" value="<?php echo text($check_res['medication16']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication16" class="form-control" value="<?php echo text($check_res['indication16']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date17" class="form-control" value="<?php echo text($check_res['date17']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication17" class="form-control" value="<?php echo text($check_res['medication17']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication17" class="form-control" value="<?php echo text($check_res['indication17']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date18" class="form-control" value="<?php echo text($check_res['date18']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication18" class="form-control" value="<?php echo text($check_res['medication18']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication18" class="form-control" value="<?php echo text($check_res['indication18']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date19" class="form-control" value="<?php echo text($check_res['date19']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication19" class="form-control" value="<?php echo text($check_res['medication19']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication19" class="form-control" value="<?php echo text($check_res['indication19']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date20" class="form-control" value="<?php echo text($check_res['date20']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication20" class="form-control" value="<?php echo text($check_res['medication20']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication20" class="form-control" value="<?php echo text($check_res['indication20']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date21" class="form-control" value="<?php echo text($check_res['date21']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication21" class="form-control" value="<?php echo text($check_res['medication21']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication21" class="form-control" value="<?php echo text($check_res['indication21']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date22" class="form-control" value="<?php echo text($check_res['date22']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication22" class="form-control" value="<?php echo text($check_res['medication22']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication22" class="form-control" value="<?php echo text($check_res['indication22']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date23" class="form-control" value="<?php echo text($check_res['date23']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication23" class="form-control" value="<?php echo text($check_res['medication23']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication23" class="form-control" value="<?php echo text($check_res['indication23']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date24" class="form-control" value="<?php echo text($check_res['date24']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication24" class="form-control" value="<?php echo text($check_res['medication24']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication24" class="form-control" value="<?php echo text($check_res['indication24']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date25" class="form-control" value="<?php echo text($check_res['date25']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication25" class="form-control" value="<?php echo text($check_res['medication25']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication25" class="form-control" value="<?php echo text($check_res['indication25']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date26" class="form-control" value="<?php echo text($check_res['date26']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication26" class="form-control" value="<?php echo text($check_res['medication26']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication26" class="form-control" value="<?php echo text($check_res['indication26']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date27" class="form-control" value="<?php echo text($check_res['date27']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication27" class="form-control" value="<?php echo text($check_res['medication27']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication27" class="form-control" value="<?php echo text($check_res['indication27']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                            <td> 
                                    <input type="datetime-local" name="date28" class="form-control" value="<?php echo text($check_res['date28']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication28" class="form-control" value="<?php echo text($check_res['medication28']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication28" class="form-control" value="<?php echo text($check_res['indication28']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date29" class="form-control" value="<?php echo text($check_res['date29']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication29" class="form-control" value="<?php echo text($check_res['medication29']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication29" class="form-control" value="<?php echo text($check_res['indication29']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date30" class="form-control" value="<?php echo text($check_res['date30']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication30" class="form-control" value="<?php echo text($check_res['medication30']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication30" class="form-control" value="<?php echo text($check_res['indication30']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date31" class="form-control" value="<?php echo text($check_res['date31']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication31" class="form-control" value="<?php echo text($check_res['medication31']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication31" class="form-control" value="<?php echo text($check_res['indication31']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date32" class="form-control" value="<?php echo text($check_res['date32']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication32" class="form-control" value="<?php echo text($check_res['medication32']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication32" class="form-control" value="<?php echo text($check_res['indication32']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date33" class="form-control" value="<?php echo text($check_res['date33']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication33" class="form-control" value="<?php echo text($check_res['medication33']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication33" class="form-control" value="<?php echo text($check_res['indication33']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date34" class="form-control" value="<?php echo text($check_res['date34']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication34" class="form-control" value="<?php echo text($check_res['medication34']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication34" class="form-control" value="<?php echo text($check_res['indication34']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date35" class="form-control" value="<?php echo text($check_res['date35']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication35" class="form-control" value="<?php echo text($check_res['medication35']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication35" class="form-control" value="<?php echo text($check_res['indication35']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date36" class="form-control" value="<?php echo text($check_res['date36']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication36" class="form-control" value="<?php echo text($check_res['medication36']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication36" class="form-control" value="<?php echo text($check_res['indication36']);?>"/>
                                </td> 
                            </tr>
                            <tr>
                                <td> 
                                    <input type="datetime-local" name="date37" class="form-control" value="<?php echo text($check_res['date37']);?>"/>
                                </td>
                                <td> 
                                    <input type="text" name="medication37" class="form-control" value="<?php echo text($check_res['medication37']);?>"/>
                                </td> 
                                <td> 
                                    <input type="text" name="indication37" class="form-control" value="<?php echo text($check_res['indication37']);?>"/>
                                </td> 
                            </tr>
                        </table>
                    </div>         
                    <div class="form-group mt-4" style="margin-left: 465px;">
                        <div class="btn-group" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-success btn-save" style=" "><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-danger btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
