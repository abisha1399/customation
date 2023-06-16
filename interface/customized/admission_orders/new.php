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
    $sql = "SELECT * FROM `form_admission_orders` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid, $_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();

?>
<html>

<head>
    <title><?php echo xlt("Consent Form"); ?></title>
    <?php Header::setupHeader(); ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    <style>
        .pen_icon {
            cursor: pointer;
        }

        .view_icon {
            margin-left: 160px;
            margin-top: -26px;
        }

        .phy_icon {
            margin-left: 213px;
            margin-top: -25px;
        }

        .admissionord {
            font-family: 'Poppins';
        }

        .protocol {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/admission_orders/save.php?id=<?php echo attr_url($formid); ?>">
                <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                <div class="col-md-12">
                    <h3 class="text-center admissionord">Admission Orders</h3>
                </div>
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;">
                    <tr class="bg-dark ">
                        <td>
                            <h4 class="text-center text-light">Patient Information</h4>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered mb-2 admissionord" style="width:100%;table-layout:fixed;display:table;margin-top: -17px;">
                    <tr>
                        <td>
                            <label>Patient Name :</label>
                            <label><input type="text" style="width:105%;" name="patient" value="<?php echo text($check_res['patient']); ?>" /></label>
                        </td>
                        <td>
                            <label>DOB :</label>
                            <input type="date" name="dob" value="<?php echo text($check_res['dob']); ?>" />
                        </td>
                        <td>
                            <label>Allergies :</label>
                            <input type="text" name="allergy" value="<?php echo text($check_res['allergy']); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Height :</label>
                            <label><input type="text" style="width:105%;" name="height" value="<?php echo text($check_res['height']); ?>" /></label>
                        </td>
                        <td>
                            <label>Weight :</label>
                            <input type="text" name="weight" value="<?php echo text($check_res['weight']); ?>" />
                        </td>
                        <td>
                            <label>Vitals :</label>
                            <label><input type=checkbox name='check1' class="radio_changes" value="0" <?php if ($check_res["check1"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Q Shift</label>
                            <label class="ml-2"><input type=checkbox name='check2' class="radio_changes" value="0" <?php if ($check_res["check2"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> BID</label>
                            <label class="ml-2"><input type=checkbox name='check3' class="radio_changes" value="0" <?php if ($check_res["check3"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Other : <input type="text" name="othertext" value="<?php echo text($check_res['othertext']); ?>" /></label>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;margin-top: -8px;">
                    <tr class="bg-dark ">
                        <td>
                            <h4 class="text-center text-light">Admission to Chemical Dependancy</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type="text" name="adtext1" class="form-control" style="width: 565%;" value="<?php echo text($check_res['adtext1']); ?>" /></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type="text" name="adtext2" class="form-control" style="width: 565%;" value="<?php echo text($check_res['adtext2']); ?>" /></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type="text" name="adtext3" class="form-control" style="width: 565%;" value="<?php echo text($check_res['adtext3']); ?>" /></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type="text" name="adtext4" class="form-control" style="width: 565%;" value="<?php echo text($check_res['adtext4']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark">
                        <td>
                            <h4 class="text-center text-light">Medications</h4>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;margin-top:-17px;">
                    <tr>
                        <td>
                            <label>1. Thiamine 100 MG PO Now and Daily</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check4' value="0" <?php if ($check_res["check4"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Yes</label>
                            <label><input type=checkbox  class="ml-3 thiacheck" name='check5' value="0" <?php if ($check_res["check5"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>2. Folate 1MG PO Now and Daily:</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check6' value="0" <?php if ($check_res["check6"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check7' value="0" <?php if ($check_res["check7"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>3. Motrin 600 MG PO Q 4 Hours, PRN Discomfort</label><br /><label class="ml-5"> Max 4 doses per 24hrs</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check8' value="0" <?php if ($check_res["check8"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check9' value="0" <?php if ($check_res["check9"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>4. Tylenol 500 MG PO Q 4 Hours, PRN Headache/Fever (more than 101F)</label><br /><label class="ml-5">Max 4 doses per 24 hours</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check10' value="0" <?php if ($check_res["check10"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check11' value="0" <?php if ($check_res["check11"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> 5. Maalox 30 ML PO Q 1 Hour, PRN GI Distress</label><br /><label class="ml-5"> Max 8 doses per 24 hours</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check12' value="0" <?php if ($check_res["check12"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check13' value="0" <?php if ($check_res["check13"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> 6. Robaxin 500 MG PO Q 4 Hours, PRN Muscle Spasm</label><br /><label class="ml-5"> Max 3 in 24 hours</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check14' value="0" <?php if ($check_res["check14"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check15' value="0" <?php if ($check_res["check15"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>7. Hydroxyzine Pamoate (Vistaril) 50 MG PO Q 4 hours PRN Anxiety</label><br /><label class="ml-5">Max 3 doses in 24 hours <b>for patients < 30 yrs</b></label><br /><label class="ml-5">Max 2 doses per 24 hours <b>for patients 30-50 years old</b></label><br /><label class="ml-5">Max 1 dose per 24 hours <b>for adults > 50 yrs</b> x 10 days</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check16' value="0" <?php if ($check_res["check16"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check17' value="0" <?php if ($check_res["check17"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>8. Imodium 2 MG PO Q 2 hours, PRN Diarrhea</label><br /><label class="ml-5">Max 4 doses per 24 hours</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check18' value="0" <?php if ($check_res["check18"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check19' value="0" <?php if ($check_res["check19"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> 9. MOM 30 ML PO BID x 3 Days, PRN Constipation</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check20' value="0" <?php if ($check_res["check20"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check21' value="0" <?php if ($check_res["check21"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> 10. Dulcolax 10 MG PO BID x 3 Days PRN constipation if MOM doesn’t work</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check22' value="0" <?php if ($check_res["check22"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check23' value="0" <?php if ($check_res["check23"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>11. Tigan 300 MG PO Q 6 Hours, PRN for Nausea (Max 4 doses per 24 hrs x 10 days
                            </label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check24' value="0" <?php if ($check_res["check24"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check25' value="0" <?php if ($check_res["check25"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>12. Tigan 200 MG IM Q 6 Hours, PRN for Vomiting
                            </label><br><label class="ml-5">Max 4 doses per 24 hours x 10 days</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check26' value="0" <?php if ($check_res["check26"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check27' value="0" <?php if ($check_res["check27"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>13. Zofran ODT 8 MG PO Q 8 hours
                            </label><br><label class="ml-5">Max 2 doses in 24 hours for refractory to Tigan</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check28' value="0" <?php if ($check_res["check28"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check29' value="0" <?php if ($check_res["check29"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>14. Keppra 500 PO Now and then BID</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check30' value="0" <?php if ($check_res["check30"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check31' value="0" <?php if ($check_res["check31"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>15. Thiamine 100 MG IM once a day x 3 days for Wernicke’s Syndrome</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check32' value="0" <?php if ($check_res["check32"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check33' value="0" <?php if ($check_res["check33"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> 16. Ativan 1 MG IM x 1 dose PRN Anxiety or Severe Withdraw</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check34' value="0" <?php if ($check_res["check34"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check35' value="0" <?php if ($check_res["check35"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> 17. Benadryl 50 MG IM x 1 dose PRN Allergic Reaction</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check36' value="0" <?php if ($check_res["check36"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check37' value="0" <?php if ($check_res["check37"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> 18. Alcohol and Drug Detox Program</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check38' value="0" <?php if ($check_res["check38"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check39' value="0" <?php if ($check_res["check39"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>19. Tuberculin Test</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check40' value="0" <?php if ($check_res["check40"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check41' value="0" <?php if ($check_res["check41"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>20. RPR Test</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check42' value="0" <?php if ($check_res["check42"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check43' value="0" <?php if ($check_res["check43"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>21. Comprehensive Metabolic Panel</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check44' value="0" <?php if ($check_res["check44"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check45' value="0" <?php if ($check_res["check45"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>22. Hepatic function panel</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check46' value="0" <?php if ($check_res["check46"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check47' value="0" <?php if ($check_res["check47"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>23. Lipid profile</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check48' value="0" <?php if ($check_res["check48"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check49' value="0" <?php if ($check_res["check49"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>24. Thyroid profile</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check50' value="0" <?php if ($check_res["check50"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check51' value="0" <?php if ($check_res["check51"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>25. Hepatitis panel</label>
                        </td>
                        <td>
                            <label><input type=checkbox class="thiacheck" name='check52' value="0" <?php if ($check_res["check52"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Yes</label>
                            <label><input type=checkbox class="ml-3 thiacheck" name='check53' value="0" <?php if ($check_res["check53"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> No</label>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;margin-top: -17px;">
                    <tr>
                        <td>RN Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon" id="rn_sign" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" id="rnsign" name="rnsign" value="<?php echo text($check_res['rnsign']); ?>" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="rndate" value="<?php echo text($check_res['rndate']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="rntime" value="<?php echo text($check_res['rntime']); ?>" class="ml-2" /></td>
                    </tr>

                    <tr>
                        <td>Physician Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon phy_icon" id="phy_sign" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" id="physign" name="physign" value="<?php echo text($check_res['physign']); ?>" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="phydate" value="<?php echo text($check_res['phydate']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="phytime" value="<?php echo text($check_res['phytime']); ?>" class="ml-2" /></td>
                    </tr>
                </table>
                <br />
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;">
                    <tr class="bg-dark ">
                        <td>
                            <h4 class="text-center text-light">Physicians Orders</h4>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h5><b>For Alcohol (liver impaired) Withdrawal and/ or Benzodiazepine Withdrawal</b></h5>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h5><b>IMPLEMENT ATIVAN WITHDRAWAL PROTOCOL</b></h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='phycheck1' value="0" <?php if ($check_res["phycheck1"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">Ativan Withdrawal Protocol A :</b></label><br />
                            <br /><label class="ml-5">Vital signs 4x daily</label>
                            <br />
                            <br /><br /><label class="ml-5">Ativan 2 mg PO TID on admission day<br />
                                Ativan 2 mg PO BID and 1mg PO at 12:30pm on day #2<br />
                                Ativan 2 mg PO BID on day #3<br />
                                Ativan 1 mg PO BID on day #4<br />
                                Ativan 1 mg PO in AM on day #5
                            </label>
                            <br /><br /><label class="ml-5">Ativan 1 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 4 doses in 24 hours.</label>
                            <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='phycheck2' value="0" <?php if ($check_res["phycheck2"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">Ativan Withdrawal Protocol B :</b></label><br />
                            <br /><label class="ml-5">Vital signs 4x daily</label>
                            <br />
                            <br /><br /><label class="ml-5">Ativan 1mg PO BID and 2mg at 12:30pm on day of admission<br />
                                Ativan 1mg PO TID on day #2<br />
                                Ativan 1 mg PO BID on day #3<br />
                                Ativan 1 mg PO in AM on day #4

                            </label>
                            <br /><br /><label class="ml-5">Ativan 1 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 4 doses in 24 hours.</label>
                            <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='phycheck3' value="0" <?php if ($check_res["phycheck3"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">Ativan Withdrawal Protocol C :</b></label><br />
                            <br /><label class="ml-5">Vital signs 4x daily</label>

                            <br /><br /><label class="ml-5">Ativan¬ 1 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 8 doses in 24 hours.</label>
                            <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;margin-top: -17px;">

                    <tr>
                        <td>RN Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon" id="rn_sign1" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" id="rnsign1" name="rnsign1" value="<?php echo text($check_res['rnsign1']); ?>" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="rndate1" value="<?php echo text($check_res['rndate1']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="rntime1" value="<?php echo text($check_res['rntime1']); ?>" class="ml-2" /></td>
                    </tr>

                    <tr>
                        <td>Physician Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon phy_icon" id="phy_sign1" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" style="width: 50%;" id="physign1" name="physign1" value="<?php echo text($check_res['physign1']); ?>" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="phydate1" value="<?php echo text($check_res['phydate1']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="phytime1" value="<?php echo text($check_res['phytime1']); ?>" class="ml-2" /></td>
                    </tr>
                </table>
                <br />
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;">
                    <tr class="bg-dark ">
                        <td>
                            <h4 class="text-center text-light">Physicians Orders</h4>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h5><b>For Opioid Withdrawal</b></h5>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h5><b>IMPLEMENT CLONIDINE WITHDRAWAL PROTOCOL</b></h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='clocheck1' value="0" <?php if ($check_res["clocheck1"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">Clonidine Withdrawal Protocol A :</b></label><br />
                            <br /><label class="ml-5">Vital signs 4x daily</label>
                            <br />
                            <br /><br /><label class="ml-5">Clonidine <input type="text" name="clotext1" style="width: 15%;" value="<?php echo text($check_res['clotext1']); ?>" /> mg PO TID on admission day<br /><br />
                                Clonidine <input type="text" style="width: 15%;" name="clotext2" value="<?php echo text($check_res['clotext2']); ?>" /> mg PO TID on day #2<br /><br />
                                Clonidine <input type="text" style="width: 15%;" name="clotext3" value="<?php echo text($check_res['clotext3']); ?>" /> mg PO BID on day #3<br /><br />
                                Clonidine <input type="text" style="width: 15%;" name="clotext4" value="<?php echo text($check_res['clotext4']); ?>" /> mg PO in AM on day #4

                            </label>
                            <br /><br /><label class="ml-5">Clonidine <input type="text" name="clotext5" style="width: 7%;" value="<?php echo text($check_res['clotext5']); ?>" /> mg PO Q2 hours PRN signs/symptoms of opiate withdrawal
                                (i.e. abdominal/muscle cramping, nausea, vomiting, diarrhea, lacrimation, rhinorrhea, joint pain), or one of the following: Pulse >95, SBP >140, DBP >95.
                                Maximum 10 doses in 24 hours.
                            </label>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='clocheck2' value="0" <?php if ($check_res["clocheck2"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">Clonidine Withdrawal Protocol B :</b></label><br />
                            <br /><label class="ml-5">Vital signs 4x daily</label>

                            <br /><br /><label class="ml-5">Clonidine 0.05 mg PO Q2 hour PRN signs/symptoms of opiate withdrawal
                                (i.e. abdominal/muscle cramping, nausea, vomiting, diarrhea, lacrimation, rhinorrhea, joint pain), or one of the following: Pulse >95, SBP >140, DBP >95.
                                Maximum 10 doses in 24 hours.
                            </label>
                            <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;margin-top: -17px;">

                    <tr>
                        <td>RN Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon" id="rn_sign2" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" id="rnsign2" name="rnsign2" value="<?php echo text($check_res['rnsign2']); ?>" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="rndate2" value="<?php echo text($check_res['rndate2']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="rntime2" value="<?php echo text($check_res['rntime2']); ?>" class="ml-2" /></td>
                    </tr>

                    <tr>
                        <td>Physician Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon phy_icon" id="phy_sign2" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" id="physign2" name="physign2" value="<?php echo text($check_res['physign2']); ?>" style="width: 50%;" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="phydate2" value="<?php echo text($check_res['phydate2']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="phytime2" value="<?php echo text($check_res['phytime2']); ?>" class="ml-2" /></td>
                    </tr>
                </table>
                <br />
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;">
                    <tr class="bg-dark ">
                        <td>
                            <h4 class="text-center text-light">Physicians Orders</h4>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h5><b>For Alcohol and/or Benzodiazepine Withdrawal</b></h5>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h5><b>IMPLEMENT LIBRIUM WITHDRAWAL PROTOCOL:</b></h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='libcheck1' value="0" <?php if ($check_res["libcheck1"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">Librium Withdrawal Protocol A :</b></label><br />
                            <br /><label class="ml-5">Vital Signs and CIWA-AR 4x daily</label>
                            <br />
                            <br /><br /><label class="ml-5">Librium 25 mg PO BID and 50mg at 12:30pm on admission day<br />
                                Librium 25 mg PO TID on day #2<br />
                                Librium 25 mg PO BID on day #3<br />
                                Librium 25 mg PO BID on day #4<br />
                                Librium 25 mg PO in AM on day #5

                            </label>
                            <br /><br /><label class="ml-5">Libirum 10 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 10 doses in 24 hours.</label>
                            <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                                    <br /><br /><label class="ml-5">Notify physician if T >100 F or if CIWA-AR score >28.</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='libcheck2' value="0" <?php if ($check_res["libcheck2"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">Librium Withdrawal Protocol B :</b></label><br />
                            <br /><label class="ml-5">Vital Signs and CIWA-AR 4x daily</label>
                            <br />
                            <br /><br /><label class="ml-5">Librium 10 mg PO BID and 20mg at 12:30pm on day #1<br />
                                Librium 10 mg PO TID on day #2<br />
                                Librium 10 mg PO BID on day #3<br />
                                Librium 10 mg PO BID on day #4<br />
                                Librium 10mg PO in AM on day #5


                            </label>
                            <br /><br /><label class="ml-5">Libirum 10 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 10 doses in 24 hours.</label>
                            <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                                    <br /><br /><label class="ml-5">Notify physician if T >100 F or if CIWA-AR score >28.</label>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='libcheck3' value="0" <?php if ($check_res["libcheck3"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">Librium Withdrawal Protocol C :</b></label><br />
                            <br /><label class="ml-5">Vital Signs and CIWA-AR 4x daily</label>

                            <br /><br /><label class="ml-5">Libirum 10 mg PO Q 2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 10 doses in 24 hours.</label>
                            <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                                    <br /><br /><label class="ml-5">Notify physician if T >100 F or if CIWA-AR score >28.</label>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;margin-top: -17px;">

                    <tr>
                        <td>RN Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon" id="rn_sign3" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" id="rnsign3" name="rnsign3" value="<?php echo text($check_res['rnsign3']); ?>" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="rndate3" value="<?php echo text($check_res['rndate3']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="rntime3" value="<?php echo text($check_res['rntime3']); ?>" class="ml-2" /></td>
                    </tr>

                    <tr>
                        <td>Physician Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon phy_icon" id="phy_sign3" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" id="physign3" name="physign3" value="<?php echo text($check_res['physign3']); ?>" style="width: 50%;" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="phydate3" value="<?php echo text($check_res['phydate3']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="phytime3" value="<?php echo text($check_res['phytime3']); ?>" class="ml-2" /></td>
                    </tr>
                </table>
                <br />
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;">
                    <tr class="bg-dark ">
                        <td>
                            <h4 class="text-center text-light">Physicians Orders</h4>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h5><b>For Opiate Withdrawal (Heroin, Oxycontin, Oxycodone, Roxicodone, etc.)</b></h5>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h5><b>IMPLEMENT SUBOXONE DETOXIFICATION PROTOCOL</b></h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='subcheck1' value="0" <?php if ($check_res["subcheck1"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">SUBOXONE TAPER/HEROIN/OTHER OPIOIDS - Custom Taper</b></label><br />
                            <br /><label class="ml-5">Suboxone 4 mg SL film BID and 8mg SL at 12:30pm on day of Admission<br /><br />Day 2 Suboxone 4 mg SL film BID and 6 mg SL at 1230<br /><br />Day 3 Suboxone 4 mg SL film TID

                                <br /><br />Day 4 Suboxone 4 mg SL film BID and 2 mg SL at noon

                                <br /><br />Day 5 Suboxone 4 mg SL film BID

                                <br /><br />Day 6 Suboxone 2 mg SL film in AM and 4 mg SL PM

                                <br /><br /> Day 7 Suboxone 2 mg SL film BID

                                <br /><br /> Day 8 Suboxone 2 mg SL film in AM
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='subcheck2' value="0" <?php if ($check_res["subcheck2"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">SUBOXONE TAPER/HEROIN/OTHER OPIOIDS 6 days</b></label><br />
                            <br /><label class="ml-5">Suboxone 4 mg SL film BID on day of Admission<br /><br />

                                Day 2 Suboxone 4 mg SL film 1st dose and 2 mg SL film 2nd dose<br /><br />

                                Day 3 Suboxone 4 mg SL film 1st dose and 2 mg SL film 2nd dose<br /><br />

                                Day 4 Suboxone 2 mg SL film BID<br /><br />

                                Day 5 Suboxone 2 mg SL film once a day<br /><br />

                                Day 6 Suboxone 2 mg SL film once a day
                            </label>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='subcheck3' value="0" <?php if ($check_res["subcheck3"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">SUBOXONE TAPER/HEROIN/OTHER OPIOIDS 5 Days</b></label><br />
                            <br /><label class="ml-5"> Suboxone 4 mg SL film TID on day of Admission<br /><br />

                                Day 2 Suboxone 4 mg SL film BID<br /><br />

                                Day 3 Suboxone 4 mg SL film 1st dose and 2 mg SL film 2nd dose<br /><br />

                                Day 4 Suboxone 2 mg SL film BID<br /><br />

                                Day 5 Suboxone 2 mg SL film once a day
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='subcheck4' value="0" <?php if ($check_res["subcheck4"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>><b class="ml-3 protocol">SUBOXONE TAPER/HEROIN/OTHER OPIOIDS 4 Days</b></label><br />
                            <br /><label class="ml-5"> Suboxone 4 mg SL film BID on day of Admission<br /><br />

                                Day 2 Suboxone 4 mg SL film 1st dose and 2 mg SL film 2nd dose<br /><br />

                                Day 3 Suboxone 2 mg SL film BID<br /><br />

                                Day 4 Suboxone 2 mg SL film once a day

                            </label>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;margin-top: -17px;">

                    <tr>
                        <td>RN Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon" id="rn_sign4" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="rnsign4" id="rnsign4" value="<?php echo text($check_res['rnsign4']); ?>" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="rndate4" value="<?php echo text($check_res['rndate4']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="rntime4" value="<?php echo text($check_res['rntime4']); ?>" class="ml-2" /></td>
                    </tr>

                    <tr>
                        <td>Physician Signature :
                            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon phy_icon" id="phy_sign4" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i>
                            <input type="hidden" id="physign4" name="physign4" value="<?php echo text($check_res['physign4']); ?>" style="width: 50%;" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="phydate4" value="<?php echo text($check_res['phydate4']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="phytime4" value="<?php echo text($check_res['phytime4']); ?>" class="ml-2" /></td>
                    </tr>
                </table>
                <div class=" form-group mt-4" style="margin-left: 465px;">
                    <div class="btn-group" role="group">
                        <button type="submit" onclick='top.restoreSession()' class="btn btn-success btn-save" style=" "><?php echo xlt('Save'); ?></button>
                        <button type="button" class="btn btn-danger btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel'); ?></button>
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
                        <div id="sig"></div>
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

    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <img src="" id="view_sign" alt="sign img" width='200px' height='100px'>
                </div>
            </div>
        </div>
    </div>
    <!-- modal close -->
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../forms/admission_orders/assets/js/jquery.signature.min.js"></script>
<script>
    var sig = $('#sig').signature({
        syncField: '#sign_data',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#sign_data").val('');
    });

    var id_name, val, display_edit, icon;


    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {
            icon = $(this).next().attr('id');;
            display_edit = $(this).next().next('input').attr('id');
            val = $("#" + display_edit).val();
            display(icon);
        });

    }

    function display(icon) {
        if (val != "") {
            $("#" + icon).css('display', 'block');

        } else {
            $("#" + icon).css('display', 'none');
        }
    }
    $('.pen_icon').click(function() {
        id_name = $(this).next().next('input').attr('id');
    });

    $('.view_icon').click(function() {
        id_name = $(this).next('input').val();
        $("#view_sign").attr("src", "data:image/png;base64," + id_name);
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        sign = sign.split(',');
        $('#' + id_name).val(sign[1]);
        sig.signature('clear');
        $("#sign_data").val('');
        check_sign();
    });
    $('input.thiacheck').on('click', function() {
    $(this).parent().parent().find('.thiacheck').prop('checked', false);
    $(this).prop('checked', true)
    });

    $('.radio_changes').on('change',function(){
        //var checkbox_class= $(this).attr('data-id');
        if($(this).is(":checked"))
        {
            $('.radio_changes').prop('checked',false);
            $(this).prop('checked',true);
            //$('#'+checkbox_class).val($(this).val());
        }
    })


</script>

</html>
