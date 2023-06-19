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
    $sql = "SELECT * FROM `form_medication_education_document` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}
$current_date=date('Y-m-d');

$check_res = $formid ? $check_res : array();

?>
<html>
    <head>
        <title><?php echo xlt("Medication Education Document"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;">
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/medication_education_document/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="col-12 mt-3">
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="text-center"><b>Medication Education Document</b></h4>
                                </td>
                            </tr>
                        </table>
                        <br/>
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
                                    <input type="date" name="date" class="form-control" value="<?php echo $check_res['date']??$current_date;?>"/>
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
                        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <th>Date</th>
                                <th>Medication</th>
                                <th>Indication</th>
                                <th>Nurse Signature</th>
                                <th>Patient Signature</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date1" class="form-control" value="<?php echo $check_res['date1']??$current_date;?>"/>
                                </td>
                                <td>Suboxone (buprenorphine/naloxone)</td>
                                <td>Opiate Withdrawal</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign1" id="nursign1" class="form-control" value="<?php echo text($check_res['nursign1']);?>"/>
                                    <img src='' class="img" id="img_nursign1" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign1" id='ptsign1' class="form-control" value="<?php echo text($check_res['ptsign1']);?>"/>
                                    <img src='' class="img" id="img_ptsign1" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date2" class="form-control" value="<?php echo $check_res['date2']??$current_date;?>"/>
                                </td>
                                <td>Subutex (buprenorphine)</td>
                                <td>Opiate Withdrawal</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign2" id="nursign2" class="form-control" value="<?php echo text($check_res['nursign2']);?>"/>
                                    <img src='' class="img" id="img_nursign2" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign2" id="ptsign2" class="form-control" value="<?php echo text($check_res['ptsign2']);?>"/>
                                    <img src='' class="img" id="img_ptsign2" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date3" class="form-control" value="<?php echo $check_res['date3']??$current_date;?>"/>
                                </td>
                                <td>Librium</td>
                                <td>Benzodiazephine/Alcohol Withdrawal</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign3" id="nursign3" class="form-control" value="<?php echo text($check_res['nursign3']);?>"/>
                                    <img src='' class="img" id="img_nursign3" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign3" id="ptsign3" class="form-control" value="<?php echo text($check_res['ptsign3']);?>"/>
                                    <img src='' class="img" id="img_ptsign3" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date4" class="form-control" value="<?php echo $check_res['date4']??$current_date;?>"/>
                                </td>
                                <td>Ativan</td>
                                <td>Benzodiazephine/Alcohol Withdrawal</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign4" id="nursign4" class="form-control" value="<?php echo text($check_res['nursign4']);?>"/>
                                    <img src='' class="img" id="img_nursign4" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign4" id="ptsign4" class="form-control" value="<?php echo text($check_res['ptsign4']);?>"/>
                                    <img src='' class="img" id="img_ptsign4" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date5" class="form-control" value="<?php echo $check_res['date5']??$current_date;?>"/>
                                </td>
                                <td>Clonidine</td>
                                <td>Anxiety/Opiate Withdrawal</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign5" id="nursign5" class="form-control" value="<?php echo text($check_res['nursign5']);?>"/>
                                    <img src='' class="img" id="img_nursign5" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign5" id="ptsign5" class="form-control" value="<?php echo text($check_res['ptsign5']);?>"/>
                                    <img src='' class="img" id="img_ptsign5" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date6" class="form-control" value="<?php echo $check_res['date6']??$current_date;?>"/>
                                </td>
                                <td>Motrin</td>
                                <td>Pain/Discomfort</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign6" id="nursign6" class="form-control" value="<?php echo text($check_res['nursign6']);?>"/>
                                    <img src='' class="img" id="img_nursign6" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign6" id="ptsign6" class="form-control" value="<?php echo text($check_res['ptsign6']);?>"/>
                                    <img src='' class="img" id="img_ptsign6" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date7" class="form-control" value="<?php echo $check_res['date7']??$current_date;?>"/>
                                </td>
                                <td>Tylenol</td>
                                <td>Pain/Discomfort</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign7" id="nursign7" class="form-control" value="<?php echo text($check_res['nursign7']);?>"/>
                                    <img src='' class="img" id="img_nursign7" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign7" id="ptsign7" class="form-control" value="<?php echo text($check_res['ptsign7']);?>"/>
                                    <img src='' class="img" id="img_ptsign7" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date8" class="form-control" value="<?php echo $check_res['date8']??$current_date;?>"/>
                                </td>
                                <td>Robaxin</td>
                                <td>Muscle relaxant</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign8"  id="nursign8" class="form-control" value="<?php echo text($check_res['nursign8']);?>"/>
                                    <img src='' class="img" id="img_nursign8" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign8"  id="ptsign8" class="form-control" value="<?php echo text($check_res['ptsign8']);?>"/>
                                    <img src='' class="img" id="img_ptsign8" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date9" class="form-control" value="<?php echo $check_res['date9']??$current_date;?>"/>
                                </td>
                                <td>Vistaril</td>
                                <td>Anxiety</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign9" id="nursign9" class="form-control" value="<?php echo text($check_res['nursign9']);?>"/>
                                    <img src='' class="img" id="img_nursign9" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign9" id="ptsign9" class="form-control" value="<?php echo text($check_res['ptsign9']);?>"/>
                                    <img src='' class="img" id="img_ptsign9" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date10" class="form-control" value="<?php echo $check_res['date10']??$current_date;?>"/>
                                </td>
                                <td>Thiamine</td>
                                <td>Thiamine Deficiency</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign10"  id="nursign10" class="form-control" value="<?php echo text($check_res['nursign10']);?>"/>
                                    <img src='' class="img" id="img_nursign10" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign10" id="ptsign10" class="form-control" value="<?php echo text($check_res['ptsign10']);?>"/>
                                    <img src='' class="img" id="img_ptsign10" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date11" class="form-control" value="<?php echo $check_res['date11']??$current_date;?>"/>
                                </td>
                                <td>Folate</td>
                                <td>Folic acid Deficiency</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign11" id="nursign11" class="form-control" value="<?php echo text($check_res['nursign11']);?>"/>
                                    <img src='' class="img" id="img_nursign11" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign11" id="ptsign11" class="form-control" value="<?php echo text($check_res['ptsign11']);?>"/>
                                    <img src='' class="img" id="img_ptsign11" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date12" class="form-control" value="<?php echo $check_res['date12']??$current_date;?>"/>
                                </td>
                                <td>Maalox</td>
                                <td>GI Distress</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign12" id="nursign12" class="form-control" value="<?php echo text($check_res['nursign12']);?>"/>
                                    <img src='' class="img" id="img_nursign12" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign12" id="ptsign12" class="form-control" value="<?php echo text($check_res['ptsign12']);?>"/>
                                    <img src='' class="img" id="img_ptsign12" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date13" class="form-control" value="<?php echo $check_res['date13']??$current_date;?>"/>
                                </td>
                                <td>Milk of Magnesium</td>
                                <td>Constipation</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign13" id="nursign13" class="form-control" value="<?php echo text($check_res['nursign13']);?>"/>
                                    <img src='' class="img" id="img_nursign13" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                     <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign13" id="ptsign13" class="form-control" value="<?php echo text($check_res['ptsign13']);?>"/>
                                    <img src='' class="img" id="img_ptsign13" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date14" class="form-control" value="<?php echo $check_res['date14']??$current_date;?>"/>
                                </td>
                                <td>Imodium</td>
                                <td>Diarrhea</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign14" id='nursign14' class="form-control" value="<?php echo text($check_res['nursign14']);?>"/>
                                    <img src='' class="img" id="img_nursign14" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign14" id="ptsign14" class="form-control" value="<?php echo text($check_res['ptsign14']);?>"/>
                                    <img src='' class="img" id="img_ptsign14" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date15" class="form-control" value="<?php echo $check_res['date15']??$current_date;?>"/>
                                </td>
                                <td>Dulcolax</td>
                                <td>Constipation</td>
                                <td>
                                     <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign15" id="nursign15" class="form-control" value="<?php echo text($check_res['nursign15']);?>"/>
                                    <img src='' class="img" id="img_nursign15" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign15" id="ptsign15" class="form-control" value="<?php echo text($check_res['ptsign15']);?>"/>
                                    <img src='' class="img" id="img_ptsign15" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date16" class="form-control" value="<?php echo $check_res['date16']??$current_date;?>"/>
                                </td>
                                <td>Tigan</td>
                                <td>Nausea/vomiting</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign16" id="nursign16" class="form-control" value="<?php echo text($check_res['nursign16']);?>"/>
                                    <img src='' class="img" id="img_nursign16" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign16" id="ptsign16" class="form-control" value="<?php echo text($check_res['ptsign16']);?>"/>
                                    <img src='' class="img" id="img_ptsign16" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date17" class="form-control" value="<?php echo $check_res['date17']??$current_date;?>"/>
                                </td>
                                <td>Neurontin</td>
                                <td>Anxiety/Neuropathic Pain/Anti-seizure</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign17" id="nursign17" class="form-control" value="<?php echo text($check_res['nursign17']);?>"/>
                                    <img src='' class="img" id="img_nursign17" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign17" id="ptsign17" class="form-control" value="<?php echo text($check_res['ptsign17']);?>"/>
                                    <img src='' class="img" id="img_ptsign17" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date18" class="form-control" value="<?php echo $check_res['date18']??$current_date;?>"/>
                                </td>
                                <td>Keppra</td>
                                <td>Anti-seizure</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign18" id="nursign18" class="form-control" value="<?php echo text($check_res['nursign18']);?>"/>
                                    <img src='' class="img" id="img_nursign18" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign18" id="ptsign18" class="form-control" value="<?php echo text($check_res['ptsign18']);?>"/>
                                    <img src='' class="img" id="img_ptsign18" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date19" class="form-control" value="<?php echo $check_res['date19']??$current_date;?>"/>
                                </td>
                                <td>Zofran</td>
                                <td>Nausea/vomiting</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign19" id="nursign19" class="form-control" value="<?php echo text($check_res['nursign19']);?>"/>
                                    <img src='' class="img" id="img_nursign19" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign19" id="ptsign19" class="form-control" value="<?php echo text($check_res['ptsign19']);?>"/>
                                    <img src='' class="img" id="img_ptsign19" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date20" class="form-control" value="<?php echo $check_res['date20']??$current_date;?>"/>
                                </td>
                                <td>Benadryl</td>
                                <td>Anxiety/Sleep/Agitation/<br/>Allergies</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign20" id="nursign20" class="form-control" value="<?php echo text($check_res['nursign20']);?>"/>
                                    <img src='' class="img" id="img_nursign20" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign20"  id="ptsign20" class="form-control" value="<?php echo text($check_res['ptsign20']);?>"/>
                                    <img src='' class="img" id="img_ptsign20" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date21" class="form-control" value="<?php echo $check_res['date21']??$current_date;?>"/>
                                </td>
                                <td>Valium</td>
                                <td>Benzodiazephine/Alcohol Withdrawal</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign21" id="nursign21" class="form-control" value="<?php echo text($check_res['nursign21']);?>"/>
                                    <img src='' class="img" id="img_nursign21" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign21" id="ptsign21" class="form-control" value="<?php echo text($check_res['ptsign21']);?>"/>
                                    <img src='' class="img" id="img_ptsign21" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date22" class="form-control" value="<?php echo $check_res['date22']??$current_date;?>"/>
                                </td>
                                <td>Bentyl</td>
                                <td>Stomach Cramps</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign22" id="nursign22" class="form-control" value="<?php echo text($check_res['nursign22']);?>"/>
                                    <img src='' class="img" id="img_nursign22" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                     <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign22" id="ptsign22" class="form-control" value="<?php echo text($check_res['ptsign22']);?>"/>
                                    <img src='' class="img" id="img_ptsign22" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="date23" class="form-control" value="<?php echo $check_res['date23']??$current_date;?>"/>
                                </td>
                                <td>Promethazine</td>
                                <td>Nausea/Vomitting</td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign23" id="nursign23" class="form-control" value="<?php echo text($check_res['nursign23']);?>"/>
                                    <img src='' class="img" id="img_nursign23" style="display:none;width:50%;height:80px;" >
                                </td>
                                <td>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign23" id="ptsign23" class="form-control" value="<?php echo text($check_res['ptsign23']);?>"/>
                                    <img src='' class="img" id="img_ptsign23" style="display:none;width:50%;height:80px;" >
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>* per each signature above, the patient was educated on the purpose and side effects of the medication *.</b></label>
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

               <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="sig">
                            <img id="view_img" style="display:none" width='380px' height='144px'>
                        </div>
                        <br />
                        <br />
                        <br />
                        <button id="clear">Clear</button>
                        <textarea id="sign_data" style="display: none"></textarea>
                    </div>
                    <input type='button' id="add_sign" class="btn btn-success" data-dismiss="modal" value='Add Sign' style='float:right'>

                </div>
            </div>
        </div>
    </div>
    <!-- modal close -->

    </body>
</html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../customized/admission_orders/assets/js/jquery.signature.min.js"></script>
<script>
    var sig = $('#sig').signature({
        syncField: '#sign_data',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#view_img").attr("src", '');
        $("#view_img").css('display','none');
        $('canvas').css('display','block');
        $("#sign_data").val('');
    });



    var id_name, val, display_edit, icon;


      $('.pen_icon').click(function() {
        id_name = $(this).next('input').attr('id');
        var sign_value = $("#"+id_name).val();
       // alert(sign_value);
        if(sign_value!='')
        {
            // $("#sig").css('display','none');
            $('canvas').css('display','none');
            $("#view_img").css('display','block');
            $("#view_img").attr("src", sign_value);
            $("#sign_data").val(sign_value);

        }
        // else{
        //     $("#)
        // }
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        $('#' + id_name).val(sign);
        if(sign!='')
        {
            $("#img_"+id_name).attr('src',sign);
            $("#img_"+id_name).css('display','block');
        }
        else{
            $("#img_"+id_name).css('display','none');
        }

        $('#sign_data').val('');
        sig.signature('clear');
       // $("#sign_data").val('');
       // check_sign();
    });


    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {

            var id_name1 = $(this).next('input').attr('id');
            var sign_value = $("#"+id_name1).val();

            if(sign_value!='')
            {
                $("#img_"+id_name1).css('display','block');
                $("#img_"+id_name1).attr('src',sign_value);

            }

        });

    }
</script>
