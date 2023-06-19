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
    $sql = "SELECT * FROM `form_daily_nursing` WHERE id=? AND pid = ? AND encounter = ?";
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
    <title><?php echo xlt("Daily Nursing Assessment"); ?></title>
    <?php Header::setupHeader(); ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
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
            <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/daily_nursing_assessment/save.php?id=<?php echo attr_url($formid); ?>">
                <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                <div class="col-md-12">
                    <h3 class="text-center admissionord">Daily Nursing Assessment</h3>
                </div>

                <table class="admissionord" style="width:100%;table-layout:fixed;display:table; ">
                    <tr>
                        <td>
                            <label>Patient Name :</label>
                            <label><input type=" text" name="patient" value="<?php echo text($check_res['patient']); ?>" /></label>
                        </td>
                        <td>
                            <label>DOB :</label>
                            <input type="date" name="dob" value="<?php echo text($check_res['dob']); ?>" />
                        </td>
                        <td>
                            <label>Date :</label>
                            <input type="date" name="date" value="<?php echo text($check_res['date']); ?>" />
                        </td>
                        <td>
                            <label>Time :</label>
                            <input type="time" name="time" value="<?php echo text($check_res['time']); ?>" />
                        </td>
                    </tr>
                </table>

                <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;">
                    <tr class="bg-dark text-light">
                        <td>
                            Monitoring For:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='check1' value="0"<?php if ($check_res["check1"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Medication</label>
                            <label class="ml-5"></label>
                            <label class="ml-5"></label>
                            <label class="ml-5"><input type=checkbox name='check2' value="0" <?php if ($check_res["check2"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Detox</label>
                            <label class="ml-5"></label>
                            <label class="ml-5"></label>
                            <label class="ml-5"><input type=checkbox name='check3' value="0" <?php if ($check_res["check3"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Injury Risk</label>
                            <label class="ml-5"></label>
                            <label class="ml-5"></label>
                            <label class="ml-5"><input type=checkbox name='check4' value="0" <?php if ($check_res["check4"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> PC</label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Behavior:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='check5' value="0" <?php if ($check_res["check5"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Alert</label>

                            <label class="ml-5"><input type=checkbox name='check6' value="0" <?php if ($check_res["check6"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Cooperative</label>

                            <label class="ml-5"><input type=checkbox name='check7' value="0" <?php if ($check_res["check7"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Calm</label>

                            <label class="ml-5"><input type=checkbox name='check8' value="0" <?php if ($check_res["check8"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Aggressive</label>

                            <label class="ml-5"><input type=checkbox name='check9' value="0" <?php if ($check_res["check9"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Disruptive</label>

                            <label class="ml-5"><input type=checkbox name='check10' value="0" <?php if ($check_res["check10"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Agitated/ Irritated</label>

                            <label class="ml-5"><input type=checkbox name='check11' value="0" <?php if ($check_res["check11"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Isolative</label>

                            <label class="ml-3"><input type=checkbox name='check12' value="0" <?php if ($check_res["check12"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Impulsive</label>

                            <label class=""><input type=checkbox name='check13' value="0" <?php if ($check_res["check13"] == "0") {
                                                                                                echo "checked";
                                                                                            }; ?>> Demanding</label>

                            <label class="ml-5"><input type=checkbox name='check14' value="0" <?php if ($check_res["check14"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Argumentative</label>

                            <label class="ml-5"><input type=checkbox name='check15' value="0" <?php if ($check_res["check15"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Passive</label>

                            <label class="ml-5"><input type=checkbox name='check16' value="0" <?php if ($check_res["check16"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Withdrawn</label>

                            <label class="ml-5"><input type=checkbox name='check17' value="0" <?php if ($check_res["check17"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Intrusive</label>

                            <label class="ml-5"><input type=checkbox name='check18' value="0" <?php if ($check_res["check18"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Entitled</label>

                            <label class="ml-5"><input type=checkbox name='check19' value="0" <?php if ($check_res["check19"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Sarcastic</label>

                            <label class="ml-4"><input type=checkbox name='check20' value="0" <?php if ($check_res["check20"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Guarded</label>
                            <label class=""><input type=checkbox name='check21' value="0" <?php if ($check_res["check21"] == "0") {
                                                                                                echo "checked";
                                                                                            }; ?>> Other : <input type="text" name="othertext1" value="<?php echo text($check_res['othertext1']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Affect:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='check22' value="0" <?php if ($check_res["check22"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Appropriate for situation</label>

                            <label class="ml-5"><input type=checkbox name='check23' value="0" <?php if ($check_res["check23"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Constricted</label>

                            <label class="ml-5"><input type=checkbox name='check24' value="0" <?php if ($check_res["check24"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Flat</label>

                            <label class="ml-5"><input type=checkbox name='check25' value="0" <?php if ($check_res["check25"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Inappropriate</label>

                            <label class="ml-5"><input type=checkbox name='check26' value="0" <?php if ($check_res["check26"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Blunted</label>

                            <label class="ml-5"><input type=checkbox name='check27' value="0" <?php if ($check_res["check27"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Other: <input type="text" name="othertext2" value="<?php echo text($check_res['othertext2']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Mood:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='check28' value="0" <?php if ($check_res["check28"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Calm</label>

                            <label class="ml-5"><input type=checkbox name='check29' value="0" <?php if ($check_res["check29"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Anxious</label>

                            <label class="ml-5"><input type=checkbox name='check30' value="0" <?php if ($check_res["check30"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Depressed</label>

                            <label class="ml-5"><input type=checkbox name='check31' value="0" <?php if ($check_res["check31"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Sad/Tearful</label>

                            <label class="ml-5"><input type=checkbox name='check32' value="0" <?php if ($check_res["check32"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Labile</label>

                            <label class="ml-5"><input type=checkbox name='check33' value="0" <?php if ($check_res["check33"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Euphoric</label>

                            <label class="ml-5"><input type=checkbox name='check34' value="0" <?php if ($check_res["check34"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Dysphoric</label>

                            <label class="ml-5"><input type=checkbox name='check35' value="0" <?php if ($check_res["check35"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Euthymic</label>

                            <label><input type=checkbox name='check36' value="0" <?php if ($check_res["check36"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Angry</label>

                            <label class="ml-5"><input type=checkbox name='check37' value="0" <?php if ($check_res["check37"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Other : <input type="text" name="othertext3" value="<?php echo text($check_res['othertext3']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Thought Process:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='check38' value="0" <?php if ($check_res["check38"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Logical</label>

                            <label class="ml-5"><input type=checkbox name='check39' value="0" <?php if ($check_res["check39"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Illogical</label>

                            <label class="ml-5"><input type=checkbox name='check40' value="0" <?php if ($check_res["check40"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Coherent</label>

                            <label class="ml-5"><input type=checkbox name='check41' value="0" <?php if ($check_res["check41"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Disorganized</label>


                            <label class="ml-5"><input type=checkbox name='check42' value="0" <?php if ($check_res["check42"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Loose</label>

                            <label class="ml-5"><input type=checkbox name='check43' value="0" <?php if ($check_res["check43"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Confused</label>

                            <label class="ml-5"><input type=checkbox name='check44' value="0" <?php if ($check_res["check44"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Paranoid</label>

                            <label class="ml-5"><input type=checkbox name='check45' value="0" <?php if ($check_res["check45"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Circumstantial</label>

                            <label><input type=checkbox name='check46' value="0" <?php if ($check_res["check46"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Grandiose</label>

                            <label class="ml-5"><input type=checkbox name='check47' value="0" <?php if ($check_res["check47"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Preoccupied</label>


                            <label class="ml-5"><input type=checkbox name='check48' value="0" <?php if ($check_res["check48"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Tangential</label>


                            <label class="ml-5"><input type=checkbox name='check49' value="0" <?php if ($check_res["check49"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Delusional</label>


                            <label class="ml-5"><input type=checkbox name='check50' value="0" <?php if ($check_res["check50"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Other: <input type="text" name="othertext4" value="<?php echo text($check_res['othertext4']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Level of Function:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='check51' value="0" <?php if ($check_res["check51"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Self-Directed</label>
                            <label class="ml-5"><input type=checkbox name='check52' value="0" <?php if ($check_res["check52"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Some Direction </label>
                            <label class="ml-5"><input type=checkbox name='check53' value="0" <?php if ($check_res["check53"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Frequent Direction</label>
                            <label class="ml-5"><input type=checkbox name='check54' value="0" <?php if ($check_res["check54"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Other : <input type="text" name="othertext5" value="<?php echo text($check_res['othertext5']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Physical Withdrawal:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='check55' value="0" <?php if ($check_res["check55"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Relaxed</label>
                            <label class="ml-5"><input type=checkbox name='check56' value="0" <?php if ($check_res["check56"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Tense</label>
                            <label class="ml-5"><input type=checkbox name='check57' value="0" <?php if ($check_res["check57"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Pacing</label>
                            <label class="ml-5"><input type=checkbox name='check58' value="0" <?php if ($check_res["check58"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Slow</label>
                            <label class="ml-5"><input type=checkbox name='check59' value="0" <?php if ($check_res["check59"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Nausea/Vomiting</label>
                            <label class="ml-5"><input type=checkbox name='check60' value="0" <?php if ($check_res["check60"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Dilated Pupils</label>
                            <label class="ml-5"><input type=checkbox name='check61' value="0" <?php if ($check_res["check61"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Diarrhea</label>
                            <label><input type=checkbox name='check62' value="0" <?php if ($check_res["check62"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Stomach Cramps</label>
                            <label class="ml-5"><input type=checkbox name='check63' value="0" <?php if ($check_res["check63"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Tremors</label>
                            <label class="ml-5"><input type=checkbox name='check64' value="0" <?php if ($check_res["check64"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Restless </label>
                            <label class="ml-5"><input type=checkbox name='check65' value="0" <?php if ($check_res["check65"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Constipation </label>
                            <label class="ml-5"><input type=checkbox name='check66' value="0" <?php if ($check_res["check66"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Anxiety </label>
                            <label class="ml-5"><input type=checkbox name='check67' value="0" <?php if ($check_res["check67"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Fatigue </label>
                            <label class="ml-5"><input type=checkbox name='check68' value="0" <?php if ($check_res["check68"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Eyes blurred </label>
                            <label class="ml-2"><input type=checkbox name='check69' value="0" <?php if ($check_res["check69"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Tearing</label>
                            <label><input type=checkbox name='check70' value="0" <?php if ($check_res["check70"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Weakness </label>
                            <label class="ml-5"><input type=checkbox name='check71' value="0" <?php if ($check_res["check71"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Dizziness </label>
                            <label class="ml-5"><input type=checkbox name='check72' value="0" <?php if ($check_res["check72"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Headache </label>
                            <label class="ml-5"><input type=checkbox name='check73' value="0" <?php if ($check_res["check73"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Numbness in body : <input type="text" name="othertext6" value="<?php echo text($check_res['othertext6']); ?>" /></label>
                            <label class="ml-5"><input type=checkbox name='check74' value="0" <?php if ($check_res["check74"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Yawning</label>
                            <br />
                            <label><input type=checkbox name='check75' value="0" <?php if ($check_res["check75"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Muscle aches </label>
                            <label class="ml-5"><input type=checkbox name='check76' value="0" <?php if ($check_res["check76"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Muscle stiffness </label>
                            <label class="ml-5"><input type=checkbox name='check77' value="0" <?php if ($check_res["check77"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Joint discomfort </label>
                            <label class="ml-5"><input type=checkbox name='check78' value="0" <?php if ($check_res["check78"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Muscle twitches </label>
                            <label class="ml-5"><input type=checkbox name='check79' value="0" <?php if ($check_res["check79"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Poor Coordination</label>
                            <label class="ml-5"><input type=checkbox name='check80' value="0" <?php if ($check_res["check80"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Light sensitive </label><br />
                            <label><input type=checkbox name='check81' value="0" <?php if ($check_res["check81"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Noise sensitivity </label>
                            <label class="ml-5"><input type=checkbox name='check82' value="0" <?php if ($check_res["check82"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Taste sensitivity </label>
                            <label class="ml-5"><input type=checkbox name='check83' value="0" <?php if ($check_res["check83"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Difficulty Concentrating </label>
                            <label class="ml-5"><input type=checkbox name='check84' value="0" <?php if ($check_res["check84"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Fearful </label>
                            <label class="ml-5"><input type=checkbox name='check85' value="0" <?php if ($check_res["check85"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Hot/cold flashes </label>
                            <label class="ml-5"><input type=checkbox name='check86' value="0" <?php if ($check_res["check86"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Palpitations </label><br />
                            <label><input type=checkbox name='check87' value="0" <?php if ($check_res["check87"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Sweats </label>
                            <label class="ml-5"><input type=checkbox name='check88' value="0" <?php if ($check_res["check88"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Cravings </label>
                            <label class="ml-5"><input type=checkbox name='check89' value="0" <?php if ($check_res["check89"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Insomnia/Broken sleep </label>
                            <label class="ml-5"><input type=checkbox name='check90' value="0" <?php if ($check_res["check90"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Runny nose</label>
                            <label class="ml-5"><input type=checkbox name='check91' value="0" <?php if ($check_res["check91"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Change in appetite: Loss / Gain </label><br />
                            <label><input type=checkbox name='check92' value="0" <?php if ($check_res["check92"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Tongue fasciculation </label>
                            <label class="ml-5"><input type=checkbox name='check93' value="0" <?php if ($check_res["check93"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Nystagmus </label>
                            <label class="ml-5"><input type=checkbox name='check94' value="0" <?php if ($check_res["check94"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Piloerection </label><br />
                            <label><input type=checkbox name='check95' value="0" <?php if ($check_res["check95"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Auditory/Visual/Tactile Hallucinations : <input type="text" name="othertext7" value="<?php echo text($check_res['othertext7']); ?>" /></label><br />
                            <label><input type=checkbox name='check96' value="0" <?php if ($check_res["check96"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Memory: Recent – </label>
                            <label class="ml-5"><input type=checkbox name='check97' value="0" <?php if ($check_res["check97"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Impaired </label>
                            <label class="ml-5"><input type=checkbox name='check98' value="0" <?php if ($check_res["check98"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Intact; Remote –</label>
                            <label class="ml-5"><input type=checkbox name='check99' value="0" <?php if ($check_res["check99"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Impaired </label>
                            <label class="ml-5"><input type=checkbox name='check100' value="0" <?php if ($check_res["check100"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Intact </label>
                            <label class="ml-5"><input type=checkbox name='check101' value="0" <?php if ($check_res["check101"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Other : <input type="text" name="othertext8" value="<?php echo text($check_res['othertext8']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Suicidal/ Homicidal Ideation:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='check102' value="0" <?php if ($check_res["check102"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Has no plan </label><br />
                            <label><input type=checkbox name='check103' value="0" <?php if ($check_res["check103"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Has plan : <input type="text" name="plantext1" value="<?php echo text($check_res['plantext1']); ?>" /></label><br />
                            <label><input type=checkbox name='check104' value="0" <?php if ($check_res["check104"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Has ideation : <input type="text" name="plantext2" value="<?php echo text($check_res['plantext2']); ?>" /></label><br />
                            <label><input type=checkbox name='check105' value="0" <?php if ($check_res["check105"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Attempts/History-description : <input type="text" name="plantext3" value="<?php echo text($check_res['plantext3']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Means of Self-Harm:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='meancheck1' value="0" <?php if ($check_res["meancheck1"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> No means of self harm at home </label><br />
                            <label><input type=checkbox name='meancheck2' value="0" <?php if ($check_res["meancheck2"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Means of self harm at home (MD must be made aware before patient is sent home and document it in additional notes!) </label>
                            <br />
                            <label class="ml-5"> What type of means: <input type="text" name="meantext1" value="<?php echo text($check_res['meantext1']); ?>" /></label><br />
                            <label class="ml-5"> Where is it (they) stored: <input type="text" name="meantext2" value="<?php echo text($check_res['meantext2']); ?>" /></label><br />
                            <label class="ml-5"> Who will dispose of or safely store these items before you are sent home: <br> Name : <input type="text" name="meantext3" value="<?php echo text($check_res['meantext3']); ?>" /> Relationship: <input type="text" name="meantext4" value="<?php echo text($check_res['meantext4']); ?>" /> Phone: <input type="text" name="meantext5" value="<?php echo text($check_res['meantext5']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Interaction with Staff/ Peers:
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <label><input type=checkbox name='intercheck1' value="0" <?php if ($check_res["intercheck1"] == "0") {
                                                                                            echo "checked";
                                                                                        }; ?>> Friendly </label>
                            <label class="ml-5"><input type=checkbox name='intercheck2' value="0" <?php if ($check_res["intercheck2"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Cooperative</label>
                            <label class="ml-5"><input type=checkbox name='intercheck3' value="0" <?php if ($check_res["intercheck3"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Hostile </label>
                            <label class="ml-5"><input type=checkbox name='intercheck4' value="0" <?php if ($check_res["intercheck4"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Inappropriate </label>
                            <label class="ml-5"><input type=checkbox name='intercheck5' value="0" <?php if ($check_res["intercheck5"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Resistant</label>
                            <label class="ml-5"><input type=checkbox name='intercheck6' value="0" <?php if ($check_res["intercheck6"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Guarded </label>
                            <label class="ml-5"><input type=checkbox name='intercheck7' value="0" <?php if ($check_res["intercheck7"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Isolative</label><br />
                            <label><input type=checkbox name='intercheck8' value="0" <?php if ($check_res["intercheck8"] == "0") {
                                                                                            echo "checked";
                                                                                        }; ?>> Withdrawal</label>
                            <label class="ml-5"><input type=checkbox name='intercheck9' value="0" <?php if ($check_res["intercheck9"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Avoidant</label>
                            <label class="ml-5"><input type=checkbox name='intercheck10' value="0" <?php if ($check_res["intercheck10"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Other : <input type="text" name="intertext1" value="<?php echo text($check_res['intertext1']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Meals
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='mealcheck1' value="0" <?php if ($check_res["mealcheck1"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Lunch : <input type="text" name="mealtext1" value="<?php echo text($check_res['mealtext1']); ?>" /> %</label>
                            <label class="ml-5"><input type=checkbox name='mealcheck2' value="0" <?php if ($check_res["mealcheck2"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Dinner : <input type="text" name="mealtext2" value="<?php echo text($check_res['mealtext2']); ?>" /> %</label>
                            <label class="ml-5"><input type=checkbox name='mealcheck3' value="0" <?php if ($check_res["mealcheck3"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Other : <input type="text" name="mealtext3" value="<?php echo text($check_res['mealtext3']); ?>" /></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Objective Data:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='objcheck1' value="0" <?php if ($check_res["objcheck1"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> AAO x </label>
                            <label class="ml-5"><input type=checkbox name='objcheck2' value="0" <?php if ($check_res["objcheck2"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Person </label>
                            <label class="ml-5"><input type=checkbox name='objcheck3' value="0" <?php if ($check_res["objcheck3"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Place </label>
                            <label class="ml-5"><input type=checkbox name='objcheck4' value="0" <?php if ($check_res["objcheck4"] == "0") {
                                                                                                        echo "checked";
                                                                                                    }; ?>> Time </label><br>
                            <label>Vital Signs: BP <input type="text" name="vtext1" value="<?php echo text($check_res['vtext1']); ?>" />/<input type="text" name="vtext2" value="<?php echo text($check_res['vtext2']); ?>" /> PR <input type="text" name="vtext3" value="<?php echo text($check_res['vtext3']); ?>" /> RR <input type="text" name="vtext4" value="<?php echo text($check_res['vtext4']); ?>" /> <br /><br />Temperature <input type="text" name="vtext5" value="<?php echo text($check_res['vtext5']); ?>" /> Pulse Ox: <input type="text" name="vtext6" value="<?php echo text($check_res['vtext6']); ?>" /> %</label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td>
                            Patient Received:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><input type=checkbox name='ptcheck1' value="0" <?php if ($check_res["ptcheck1"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Motrin 600mg PO </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck2' value="0" <?php if ($check_res["ptcheck2"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Tylenol 500mg PO </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck3' value="0" <?php if ($check_res["ptcheck3"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Maalox 30ml PO</label>
                            <label class="ml-3"><input type=checkbox name='ptcheck4' value="0" <?php if ($check_res["ptcheck4"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Robaxin <input type="text" name="pttext1" value="<?php echo text($check_res['pttext1']); ?>" /> mg PO</label>
                            <label class="ml-3"><input type=checkbox name='ptcheck5' value="0" <?php if ($check_res["ptcheck5"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Vistaril 50mg PO</label><label><input type=checkbox name='ptcheck6' value="0" <?php if ($check_res["ptcheck6"] == "0") {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        }; ?>> Imodium 2mg PO</label>
                            <label class="ml-3"><input type=checkbox name='ptcheck7' value="0" <?php if ($check_res["ptcheck7"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> MOM 30ml PO</label>
                            <label class="ml-3"><input type=checkbox name='ptcheck8' value="0" <?php if ($check_res["ptcheck8"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Ducolax 10mg PO</label><label class="ml-3"><input type=checkbox name='ptcheck9' value="0" <?php if ($check_res["ptcheck9"] == "0") {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        }; ?>> Zofran ODT 8mgPO </label><label class="ml-3"><input type=checkbox name='ptcheck10' value="0" <?php if ($check_res["ptcheck10"] == "0") {
                                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                                }; ?>> Benadryl 50mg IM</label><label><input type=checkbox name='ptcheck11' value="0" <?php if ($check_res["ptcheck11"] == "0") {
                                                                                                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                                                                                                                                                    }; ?>> Promethazine <input type="text" name="pttext2" value="<?php echo text($check_res['pttext2']); ?>" /> mg PO </label><label class="ml-3"><input type=checkbox name='ptcheck12' value="0" <?php if ($check_res["ptcheck12"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                              }; ?>> Promethazine HCL 12.5mg IM </label><label class="ml-3"><input type=checkbox name='ptcheck13' value="0" <?php if ($check_res["ptcheck13"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }; ?>> Bentyl 10mg PO</label><label ><input type=checkbox name='ptcheck14' value="0" <?php if ($check_res["ptcheck14"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }; ?>> Keppra <input type="text" name="pttext3" value="<?php echo text($check_res['pttext3']); ?>" /> mg PO </label><label class="ml-3"><input type=checkbox name='ptcheck15' value="0" <?php if ($check_res["ptcheck15"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }; ?>> Folate 1mg PO </label><label class="ml-3"><input type=checkbox name='ptcheck16' value="0" <?php if ($check_res["ptcheck16"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }; ?>> Thiamine 100mg PO </label><label class="ml-3"><input type=checkbox name='ptcheck17' value="0" <?php if ($check_res["ptcheck17"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }; ?>> Lactulose <input type="text" name="pttext4" value="<?php echo text($check_res['pttext4']); ?>" />ml PO</label>
                            <label><input type=checkbox name='ptcheck18' value="0" <?php if ($check_res["ptcheck18"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Suboxone <input type="text" name="pttext5" value="<?php echo text($check_res['pttext5']); ?>" />mg SL </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck19' value="0" <?php if ($check_res["ptcheck19"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> SubuTEX <input type="text" name="pttext6" value="<?php echo text($check_res['pttext6']); ?>" />mg SL </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck20' value="0" <?php if ($check_res["ptcheck20"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Clonidine <input type="text" name="pttext7" value="<?php echo text($check_res['pttext7']); ?>" />mg PO </label>
                            <label><input type=checkbox name='ptcheck21' value="0" <?php if ($check_res["ptcheck21"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Neurontin <input type="text" name="pttext8" value="<?php echo text($check_res['pttext8']); ?>" />mg PO </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck22' value="0" <?php if ($check_res["ptcheck22"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Librium <input type="text" name="pttext9" value="<?php echo text($check_res['pttext9']); ?>" />mg PO </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck23' value="0" <?php if ($check_res["ptcheck23"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Ativan <input type="text" name="pttext10" value="<?php echo text($check_res['pttext10']); ?>" />mg PO </label>
                                                                                    <label><input type=checkbox name='ptcheck24' value="0" <?php if ($check_res["ptcheck24"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Valium <input type="text" name="pttext11" value="<?php echo text($check_res['pttext11']); ?>" />mg PO  </label>
                                                                                    <label class="ml-3"><input type=checkbox name='ptcheck25' value="0" <?php if ($check_res["ptcheck25"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Other: <input type="text" name="pttext13" value="<?php echo text($check_res['pttext13']); ?>" /> </label>
                        </td>
                    </tr>
<tr class="bg-dark text-light">
    <td>
Nursing Education Provided:
    </td>
</tr>
<tr>
    <td>
        <label><input type=checkbox name='goalcheck0' value="0" <?php if ($check_res["goalcheck0"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Treatment Planning/Goal Planning </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck1' value="0" <?php if ($check_res["goalcheck1"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Medication Education </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck2' value="0" <?php if ($check_res["goalcheck2"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Disease Process Education </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck3' value="0" <?php if ($check_res["goalcheck3"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Coping with Symptoms </label><br/>

                            <label><input type=checkbox name='goalcheck4' value="0" <?php if ($check_res["goalcheck4"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Mental Health Education </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck5' value="0" <?php if ($check_res["goalcheck5"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Reducing Relapse </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck6' value="0" <?php if ($check_res["goalcheck6"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Recovery Strategies </label>

                            <label class="ml-3"><input type=checkbox name='goalcheck7' value="0" <?php if ($check_res["goalcheck7"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Medical Issue Education </label>

                            <label class=""><input type=checkbox name='goalcheck8' value="0" <?php if ($check_res["goalcheck8"] == "0") {
                                                                                                echo "checked";
                                                                                            }; ?>> HIV/STD Education</label><br/>

                            <label ><input type=checkbox name='goalcheck9' value="0" <?php if ($check_res["goalcheck9"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Substance Abuse Education </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck10' value="0" <?php if ($check_res["goalcheck10"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Triggers </label>

                            
    </td>
</tr>
<tr class="bg-dark text-light">
    <td>
Subjective Data:
    </td>
</tr>
<tr>
    <td>
             <textarea name="subjective" id="subjective" class="form-control" cols="80" rows="5" ><?php echo text($check_res['subjective'] ); ?></textarea>                                                                               </td>
                                                                                            </tr>
                                                                                            <tr class="bg-dark text-light">
    <td>
Additional Notes:
    </td>
</tr>
<tr>
    <td>
    <textarea  name="txt1" class="form-control" onkeyup="textAreaAdjust(this)" style="width: 100%;border:none;outline:none;overflow:hidden"><?php echo $check_res['txt1']??'Patient received one-on-one support.  Patient educated per treatment plan and prescribed medication regimen. Patient was encouraged to verbalize feelings. Patient was encouraged to stay hydrated and maintain proper nutrition. Patient verbalized understanding of all education and encouragement provided.  Patient remains at risk for relapse. Will continue to monitor and assist as needed.'?></textarea><br>
          <!-- Patient received one-on-one support.  Patient educated per treatment plan and prescribed medication regimen. Patient was encouraged to verbalize feelings. Patient was encouraged to stay hydrated and maintain proper nutrition. Patient verbalized understanding of all education and encouragement provided.  Patient remains at risk for relapse. Will continue to monitor and assist as needed. -->
             <textarea name="additional" id="additional" class="form-control" cols="80" rows="5" ><?php echo text($check_res['additional']); ?></textarea>                                                                               </td>
                                                                                </tr>                                                                         
                </table>
                <table class="table table-bordered" style="    margin-top: -17px;">
                    <tr>
                        <td>RN Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon" id="rn_sign" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" id="rnsign" name="rnsign" value="<?php echo text($check_res['rnsign']); ?>" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="rndate" value="<?php echo text($check_res['rndate']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="rntime" value="<?php echo text($check_res['rntime']); ?>" class="ml-2" /></td>
                    </tr>
                </table>
                <table class="admissionord" style="width:100%;table-layout:fixed;display:table; ">
                    <tr>
                        <td>
                             <h3 class="text-center"><b>Evening Clearance Note</b></h3>                                                               </td>
                                                                                            </tr>
                                                                                            </table>
                                                                                            <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;">
                    <tr class="bg-dark text-light">
                        <td>
                            Evening Clearance:
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <textarea  name="txt2" class="textarea_content" onkeyup="textAreaAdjust(this)" style="width: 100%;border:none;outline:none;overflow:hidden"><?php echo $check_res['txt2']??'Patient is medically cleared to go home by the M.D.  Patient has not been in distress, although still in withdrawal.  Patient was educated about risk and benefits of outpatient detox, medications, drug interactions, risky behaviors, overdose potential, and possible death. Patient was also educated not to exchange phone numbers with peers or have social interaction outside of treatment.  Patient was educated to call 911 or present to the Emergency Room if an emergent situation arises.  Patient exhibits understanding of all the above entities.  Patient is still at risk for relapse. '?></textarea>
                            <!-- Patient is medically cleared to go home by the M.D.  Patient has not been in distress, although still in withdrawal.  Patient was educated about risk and benefits of outpatient detox, medications, drug interactions, risky behaviors, overdose potential, and possible death. Patient was also educated not to exchange phone numbers with peers or have social interaction outside of treatment.  Patient was educated to call 911 or present to the Emergency Room if an emergent situation arises.  Patient exhibits understanding of all the above entities.  Patient is still at risk for relapse. -->
                            <br/>
                            <label><input type=checkbox name='evecheck1' value="0" <?php if ($check_res["evecheck1"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Family was Educated</label>
                                                                                <label class="ml-5"><input type=checkbox name='evecheck2' value="0" <?php if ($check_res["evecheck2"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Patient Driven By Family</label>
                                                                                <label class="ml-5"><input type=checkbox name='evecheck3' value="0" <?php if ($check_res["evecheck3"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Patient drove self</label>
                                                                                <label class="ml-5"><input type=checkbox name='evecheck4' value="0" <?php if ($check_res["evecheck4"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Patient Driven By Uber/Lyft</label>
                            </td>
                                                                                                </tr>
                       <tr class="bg-dark text-light"><td>
Medications Administered Before Dismissal:
                       </td></tr>                                                                         
                <tr>
                        <td>
                            <label><input type=checkbox name='medcheck1' value="0" <?php if ($check_res["medcheck1"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Motrin 600mg PO </label>
                            <label class="ml-3"><input type=checkbox name='medcheck2' value="0" <?php if ($check_res["medcheck2"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Tylenol 500mg PO </label>
                            <label class="ml-3"><input type=checkbox name='medcheck3' value="0" <?php if ($check_res["medcheck3"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Maalox 30ml PO</label>
                            <label class="ml-3"><input type=checkbox name='medcheck4' value="0" <?php if ($check_res["medcheck4"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Robaxin <input type="text" name="medtext1" value="<?php echo text($check_res['medtext1']); ?>" /> mg PO</label>
                            <label class="ml-3"><input type=checkbox name='medcheck5' value="0" <?php if ($check_res["medcheck5"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Vistaril 50mg PO</label><label><input type=checkbox name='medcheck6' value="0" <?php if ($check_res["medcheck6"] == "0") {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        }; ?>> Imodium 2mg PO</label>
                            <label class="ml-3"><input type=checkbox name='medcheck7' value="0" <?php if ($check_res["medcheck7"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> MOM 30ml PO</label>
                            <label class="ml-3"><input type=checkbox name='medcheck8' value="0" <?php if ($check_res["medcheck8"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Ducolax 10mg PO</label><label class="ml-3"><input type=checkbox name='medcheck9' value="0" <?php if ($check_res["medcheck9"] == "0") {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        }; ?>> Zofran ODT 8mgPO </label><label class="ml-3"><input type=checkbox name='medcheck10' value="0" <?php if ($check_res["medcheck10"] == "0") {
                                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                                }; ?>> Benadryl 50mg IM</label><label><input type=checkbox name='medcheck11' value="0" <?php if ($check_res["medcheck11"] == "0") {
                                                                                                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                                                                                                                                                    }; ?>> Promethazine <input type="text" name="medtext2" value="<?php echo text($check_res['medtext2']); ?>" /> mg PO </label><label class="ml-3"><input type=checkbox name='medcheck12' value="0" <?php if ($check_res["medcheck12"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                              }; ?>> Promethazine HCL 12.5mg IM </label><label class="ml-3"><input type=checkbox name='medcheck13' value="0" <?php if ($check_res["medcheck13"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }; ?>> Bentyl 10mg PO</label><label><input type=checkbox name='medcheck14' value="0" <?php if ($check_res["medcheck14"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }; ?>> Keppra <input type="text" name="medtext3" value="<?php echo text($check_res['medtext3']); ?>" /> mg PO </label><label class="ml-3"><input type=checkbox name='medcheck15' value="0" <?php if ($check_res["medcheck15"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }; ?>> Folate 1mg PO </label><label class="ml-3"><input type=checkbox name='medcheck16' value="0" <?php if ($check_res["medcheck16"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }; ?>> Thiamine 100mg PO </label><label class="ml-3"><input type=checkbox name='medcheck17' value="0" <?php if ($check_res["medcheck17"] == "0") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }; ?>> Lactulose <input type="text" name="medtext4" value="<?php echo text($check_res['medtext4']); ?>" />ml PO</label>
                            <label><input type=checkbox name='medcheck18' value="0" <?php if ($check_res["medcheck18"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Suboxone <input type="text" name="medtext5" value="<?php echo text($check_res['medtext5']); ?>" />mg SL </label>
                            <label class="ml-3"><input type=checkbox name='medcheck19' value="0" <?php if ($check_res["medcheck19"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> SubuTEX <input type="text" name="medtext6" value="<?php echo text($check_res['medtext6']); ?>" />mg SL </label>
                            <label class="ml-3"><input type=checkbox name='medcheck20' value="0" <?php if ($check_res["medcheck20"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Clonidine <input type="text" name="medtext7" value="<?php echo text($check_res['medtext7']); ?>" />mg PO </label>
                            <label ><input type=checkbox name='medcheck21' value="0" <?php if ($check_res["medcheck21"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Neurontin <input type="text" name="medtext8" value="<?php echo text($check_res['medtext8']); ?>" />mg PO </label>
                            <label class="ml-3"><input type=checkbox name='medcheck22' value="0" <?php if ($check_res["medcheck22"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Librium <input type="text" name="medtext9" value="<?php echo text($check_res['medtext9']); ?>" />mg PO </label>
                            <label class="ml-3"><input type=checkbox name='medcheck23' value="0" <?php if ($check_res["medcheck23"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Ativan <input type="text" name="medtext10" value="<?php echo text($check_res['medtext10']); ?>" />mg PO </label>
                                                                                    <label><input type=checkbox name='medcheck24' value="0" <?php if ($check_res["medcheck24"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Valium <input type="text" name="medtext11" value="<?php echo text($check_res['medtext11']); ?>" />mg PO  </label>
                                                                                    <label class="ml-3"><input type=checkbox name='medcheck25' value="0" <?php if ($check_res["medcheck25"] == "0") {
                                                                                        echo "checked";
                                                                                    }; ?>> Other: <input type="text" name="medtext13" value="<?php echo text($check_res['medtext13']); ?>" /> </label>
                        </td>
                                                                                </tr>   
                                                                            <tr class="bg-dark text-light">
    <td>
Nursing Education Provided Before Dismissal:
    </td>
</tr>
<tr>
    <td>
        <label><input type=checkbox name='nurcheck0' value="0" <?php if ($check_res["nurcheck0"] == "0") {
                                                                                    echo "checked";
                                                                                }; ?>> Treatment Planning/Goal Planning </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck1' value="0" <?php if ($check_res["nurcheck1"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Medication Education </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck2' value="0" <?php if ($check_res["nurcheck2"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Disease Process Education </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck3' value="0" <?php if ($check_res["nurcheck3"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Coping with Symptoms </label><br/>

                            <label><input type=checkbox name='nurcheck4' value="0" <?php if ($check_res["nurcheck4"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Mental Health Education </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck5' value="0" <?php if ($check_res["nurcheck5"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Reducing Relapse </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck6' value="0" <?php if ($check_res["nurcheck6"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Recovery Strategies </label>

                            <label class="ml-3"><input type=checkbox name='nurcheck7' value="0" <?php if ($check_res["nurcheck7"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Medical Issue Education </label>

                            <label class=""><input type=checkbox name='nurcheck8' value="0" <?php if ($check_res["nurcheck8"] == "0") {
                                                                                                echo "checked";
                                                                                            }; ?>> HIV/STD Education</label><br/>

                            <label ><input type=checkbox name='nurcheck9' value="0" <?php if ($check_res["nurcheck9"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Substance Abuse Education </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck10' value="0" <?php if ($check_res["nurcheck10"] == "0") {
                                                                                                    echo "checked";
                                                                                                }; ?>> Triggers </label>

                            
    </td>
</tr>   
        <tr class="bg-dark text-light">
    <td>
Additional Notes:
    </td>
</tr>
<tr>
    <td>
             <textarea name="additional1" id="additional1" class="form-control" cols="80" rows="8" ><?php echo text($check_res['additional1']); ?></textarea>                                                                               </td>
                                                                                </tr>                                                                    
</table>
<table class="table table-bordered" style="    margin-top: -17px;">
                    <tr>
                        <td>RN Signature : <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                            <i class="fas fa-search view_icon" id="rn_sign1" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" id="rnsign1" name="rnsign1" value="<?php echo text($check_res['rnsign1']); ?>" class="ml-2" />
                        </td>
                        <td>Date : <input type="date" name="rndate1" value="<?php echo text($check_res['rndate1']); ?>" class="ml-2" /></td>
                        <td>Time:<input type="time" name="rntime1" value="<?php echo text($check_res['rntime1']); ?>" class="ml-2" /></td>
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
<script type="text/javascript" src="../../customized/admission_orders/assets/js/jquery.signature.min.js"></script>
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
        $("textarea").each(function () {
        this.style.height = (this.scrollHeight+10)+'px';
    });
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

    function textAreaAdjust(element) {
        element.style.height = "1px";
        element.style.height = (25+element.scrollHeight)+"px";
    }
</script>

</html>