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
    $sql = "SELECT * FROM `form_initial_psychiatric_evaluation` WHERE id=? AND pid = ? AND encounter = ?";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">

    <style>
        td{
          font-size: 15px;
        }
        input {
          border: 0;
          outline: 0;
          border-bottom: 1px solid black;
        }
        b{
          margin-left: 10px;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        .btndiv {
          text-align: center;
          margin-bottom: 18px;
        }
        .subbtn {
          background: blue;
          color: white;
        }
        button.cancel {
          background: red;
          color: white;
        }
        .boralign{
          width:100%;
          border:1px solid black
        }
        .center{
          text-align:center;
        }
        .pen_icon {
            cursor: pointer;
        }

        .view_icon {
            margin-left: 160px;
            margin-top: -26px;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
    <div class="row" style="border:1px solid black;" ;>
      <div class="container-fluid">
        <br><br>
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/initial_psychiatric_evaluation_form/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%; text-align:center;">Initial Psychiatric Evaluation</h4></td>
         </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Patient Name: <input type="text" name="initial_psychi_1" value="<?php echo $check_res['initial_psychi_1']; ?>"></td>
            <td>DOB: <input type="date" name="initial_psychi_2" value="<?php echo $check_res['initial_psychi_2']; ?>"></td>
            <td>Evaluation Date: <input type="date" name="initial_psychi_3" value="<?php echo $check_res['initial_psychi_3']; ?>"></td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td>Allergies: <input type="text" name="initial_psychi_4" value="<?php echo $check_res['initial_psychi_4']; ?>"></td>
          </tr>
          <tr>
            <td>Address: <input type="text" name="initial_psychi_5" value="<?php echo $check_res['initial_psychi_5']; ?>"></td>
          </tr>
          <tr>
            <td>Referral Source: <input type="text" name="initial_psychi_6" value="<?php echo $check_res['initial_psychi_6']; ?>"></td>
          </tr>
          <tr>
            <td>Sources of Information: <input type="checkbox" name="initial_psychi_7" value="1" <?php
        if($check_res['initial_psychi_7']=="1"){
         echo "checked";
        }?>> interviews, with: <input type="checkbox" name="initial_psychi_8" value="2" <?php
        if($check_res['initial_psychi_8']=="2"){
         echo "checked";
        }?>>medical records <input type="checkbox" name="initial_psychi_9" value="3" <?php
        if($check_res['initial_psychi_9']=="3"){
         echo "checked";
        }?>>test results <input type="checkbox" name="initial_psychi_10" value="4" <?php
        if($check_res['initial_psychi_10']=="4"){
         echo "checked";
        }?>>school records</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_11" value="1" <?php
        if($check_res['initial_psychi_11']=="1"){
         echo "checked";
        }?>> Other: Self <input type="checkbox" name="initial_psychi_12" value="2"
        <?php
        if($check_res['initial_psychi_12']=="2"){
         echo "checked";
        }?>>If accompanied by family member: N/A</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:60%;">Reason for Referral: (LOC)<input type="text" name="initial_psychi_13" value="<?php echo $check_res['initial_psychi_17']; ?>"></td>
            <td style="width:20%;">for <input type="text" name="initial_psychi_14" value="<?php echo $check_res['initial_psychi_17']; ?>"></td>
            <td style="width:20%;">Use Disorder</td>
          </tr>
          <tr>
            <td>Chief Complaint: “∆ Quote for New LOC”</td>
          </tr>
        </table>
        <table>
          <tr>
            <td>General Patient Information</td>
          </tr>
          <tr>
            <td><br> Are you single/married? : <input type="text" name="initial_psychi_15" value="<?php echo $check_res['initial_psychi_17']; ?>"></td>
          </tr>
          <tr>
            <td> Are you employed at this time? : <input type="text" name="initial_psychi_16" value="<?php echo $check_res['initial_psychi_17']; ?>"></td>
          </tr>
          <tr>
            <td> Who do you live with currently? : <input type="text" name="initial_psychi_17" value="<?php echo $check_res['initial_psychi_17']; ?>"></td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Biomedical</td>
          </tr>
          <tr>
            <td><br> Medical Problems at this time? : <input type="text" name="initial_psychi_18" value="<?php echo $check_res['initial_psychi_18']; ?>"></td>
          </tr>
          <tr>
            <td> Hx of hospitalization : <input type="text" name="initial_psychi_19" value="<?php echo $check_res['initial_psychi_19']; ?>"></td>
          </tr>
          <tr>
            <td> Current medications : <input type="text" name="initial_psychi_20" value="<?php echo $check_res['initial_psychi_20']; ?>"></td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Psychiatric</td>
          </tr>
          <tr>
            <td><br> Mental Health Diagnoses : <input type="text" name="initial_psychi_21" value="<?php echo $check_res['initial_psychi_21']; ?>"></td>
          </tr>
          <tr>
            <td> Psychiatric Medications : <input type="text" name="initial_psychi_22" value="<?php echo $check_res['initial_psychi_22']; ?>"></td>
          </tr>
          <tr>
            <td> Any history of depression: <input type="text" name="initial_psychi_23" value="<?php echo $check_res['initial_psychi_23']; ?>"></td>
          </tr>
          <tr>
            <td> Hx of Self-Mutilation, SI/HI: <input type="text" name="initial_psychi_24" value="<?php echo $check_res['initial_psychi_24']; ?>"></td>
          </tr>
          <tr>
            <td> Hx of eating disorders: <input type="text" name="initial_psychi_25" value="<?php echo $check_res['initial_psychi_25']; ?>"></td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Substance Use History</td>
          </tr>
          <tr>
            <td><br> Age of first use: <input type="text" name="initial_psychi_26" value="<?php echo $check_res['initial_psychi_26']; ?>"></td>
          </tr>
          <tr>
            <td> Frequency: <input type="text" name="initial_psychi_27" value="<?php echo $check_res['initial_psychi_27']; ?>"></td>
          </tr>
          <tr>
            <td> Quantity: <input type="text" name="initial_psychi_28" value="<?php echo $check_res['initial_psychi_28']; ?>"></td>
          </tr>
          <tr>
            <td> Reason for use: <input type="text" name="initial_psychi_29" value="<?php echo $check_res['initial_psychi_29']; ?>"></td>
          </tr>
          <tr>
            <td> Dates of escalation/sobriety: <input type="text" name="initial_psychi_30" value="<?php echo $check_res['initial_psychi_30']; ?>"></td>
          </tr>
          <tr>
            <td> Date of last use***: <input type="text" name="initial_psychi_31" value="<?php echo $check_res['initial_psychi_31']; ?>"></td>
          </tr>
          <tr>
            <td> Previous treatment episodes: <input type="text" name="initial_psychi_32" value="<?php echo $check_res['initial_psychi_32']; ?>"></td>
          </tr>
          <tr>
            <td> Any overdoses?: <input type="text" name="initial_psychi_33" value="<?php echo $check_res['initial_psychi_33']; ?>"></td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Other</td>
          </tr>
          <tr>
            <td><br> Current Stressors: <input type="text" name="initial_psychi_34" value="<?php echo $check_res['initial_psychi_34']; ?>"></td>
          </tr>
          <tr>
            <td> Access to Firearms: Yes/No <input type="text" name="initial_psychi_35" value="<?php echo $check_res['initial_psychi_35']; ?>"></td>
          </tr>
          <tr>
            <td> Who will be you collateral contact?: <input type="text" name="initial_psychi_36" value="<?php echo $check_res['initial_psychi_36']; ?>"></td>
          </tr>
        </table>
          <span contentEditable="true" class="text_edit"> <?php echo $check_res['text1']??"
            <b>*</b>History of Present Illness: Patient is a {age} , {marital status}, {employment status} {race} {gender} who presents to the Center for Network Therapy for {Level of Care} for"?></span> <input type="hidden" name="text1" id="text1">

            <input type="text" name="initial_psychi_37" value="<?php echo $check_res['initial_psychi_37']; ?>"> 

            <span contentEditable="true" class="text_edit"><?php echo $check_res['text2']??"Use Disorder. Patient was educated that in the event of non-compliance or inability to maintain treatment plan objectives, she would be referred to a higher level of care which includes the following: Seabrook House, Carrier Clinic, Summit Oaks Hospital, and Princeton House Behavioral Health. She verbalized her understanding. Patient signed a release of information for her {insert collateral contact}. She was educated that he will be contacted for collateral information, missed appointments and discharge recommendations. She currently lives {insert living arrangement}. She presents with"?></span> <input type="hidden" name="text2" id="text2">

            <input type="text" name="initial_psychi_38" value="<?php echo $check_res['initial_psychi_38']; ?>">
            <span contentEditable="true" class="text_edit"><?php echo $check_res['text3']??"Use Disorder as evidenced by her history of {daily/regular}"?></span> <input type="hidden" name="text3" id="text3">  
            <input type="text" name="initial_psychi_39" value="<?php echo $check_res['initial_psychi_39']; ?>"> use.                         
        <br/>
        <br/>
        <table>
          <tr>
            <td>Insert Substance Use Description</td>
          </tr>
          <tr>
            <td> The patient began using <input type="text" name="initial_psychi_40" value="<?php echo $check_res['initial_psychi_40']; ?>"></td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Insert Biomedical Information</td>
          </tr>
          <tr>
            <td> Medically the patient reports Patient will be monitored throughout the course of treatment.</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Insert Psychiatric Information</td>
          </tr>
          <tr>
            <td>Psychiatrically, the patient reports Patient specified not having any self-mutilating behaviors.
                Patient does not currently present with any SI/HI/VH/AH at this time.</td>
          </tr>
        </table>
        <br>

        
        <table>
          <tr>
            <td>Other</td>
            </tr>
        </table>
        <div contentEditable="true" class="text_edit"> <?php echo $check_res['text4']??"
          <p> <b>*</b> Patient’s current stressors are She reports not having access to firearms. The patient clearly understands instructions for care and has been able to follow instructions and has an adequate understanding of the {Level of Care} Program and has expressed commitment to continue at this level of care. Patient was educated about the risk of relapse, potential overdose and possible death. She understood the risks versus benefits, drug-drug interactions, polysubstance use and abuse. She was educated about if in need to rush to the nearest ER and or call 911 after hours.</p>" ?>
        </div><input type="hidden" name="text4" id="text4">
          
        <br>
        <table style="width:100%">
          <tr>
            <td><input type="checkbox" name="initial_psychi_41" value="1" <?php
        if($check_res['initial_psychi_41']=="1"){
         echo "checked";
        }?>> Bipolar: Manic or Hypomanic (3 or more)</td>
            <td><input type="checkbox" name="initial_psychi_42" value="2" <?php
        if($check_res['initial_psychi_42']=="2"){
         echo "checked";
        }?>> Depression (5 or more)</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_43" value="3" <?php
        if($check_res['initial_psychi_43']=="3"){
         echo "checked";
        }?>> expansive/ irritable mood</td>
            <td><input type="checkbox" name="initial_psychi_44" value="4" <?php
        if($check_res['initial_psychi_44']=="4"){
         echo "checked";
        }?>> depressed mood (specify frequency)</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_45" value="5" <?php
        if($check_res['initial_psychi_45']=="5"){
         echo "checked";
        }?>> inflated self-esteem or grandiosity</td>
            <td><input type="checkbox" name="initial_psychi_46" value="6" <?php
        if($check_res['initial_psychi_46']=="6"){
         echo "checked";
        }?>> diminished interests in activities</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_47" value="7" <?php
        if($check_res['initial_psychi_47']=="7"){
         echo "checked";
        }?>> decreased need for sleep</td>
            <td><input type="checkbox" name="initial_psychi_48" value="8" <?php
        if($check_res['initial_psychi_48']=="8"){
         echo "checked";
        }?>> increase or decrease in appetite</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_49" value="9" <?php
        if($check_res['initial_psychi_49']=="9"){
         echo "checked";
        }?>> flight of ideas or subjective experience of racing thoughts</td>
            <td><input type="checkbox" name="initial_psychi_50" value="10" <?php
        if($check_res['initial_psychi_50']=="10"){
         echo "checked";
        }?>> psychomotor retardation</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_51" value="11" <?php
        if($check_res['initial_psychi_51']=="11"){
         echo "checked";
        }?>> distractibility as reported or observed</td>
            <td><input type="checkbox" name="initial_psychi_52" value="12" <?php
        if($check_res['initial_psychi_52']=="12"){
         echo "checked";
        }?>> psychomotor agitation</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_53" value="13" <?php
        if($check_res['initial_psychi_53']=="13"){
         echo "checked";
        }?>> increased goal directed activity</td>
            <td><input type="checkbox" name="initial_psychi_54" value="14" <?php
        if($check_res['initial_psychi_54']=="14"){
         echo "checked";
        }?>> fatigue or loss of energy</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_56" value="15" <?php
        if($check_res['initial_psychi_56']=="15"){
         echo "checked";
        }?>> psychomotor agitation</td>
            <td><input type="checkbox" name="initial_psychi_57" value="16" <?php
        if($check_res['initial_psychi_57']=="16"){
         echo "checked";
        }?>> insomnia or hypersomnia</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_58" value="17" <?php
        if($check_res['initial_psychi_58']=="17"){
         echo "checked";
        }?>> rage</td>
            <td><input type="checkbox" name="initial_psychi_59" value="18" <?php
        if($check_res['initial_psychi_59']=="18"){
         echo "checked";
        }?>> low self-esteem</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_60" value="19" <?php
        if($check_res['initial_psychi_60']=="19"){
         echo "checked";
        }?>> excessive involvement in activities with high potential or painful consequences</td>
            <td><input type="checkbox" name="initial_psychi_61" value="20" <?php
        if($check_res['initial_psychi_61']=="20"){
         echo "checked";
        }?>> hopelessness</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_62" value="21" <?php
        if($check_res['initial_psychi_62']=="21"){
         echo "checked";
        }?>> interrupting/ intruding others</td>
            <td><input type="checkbox" name="initial_psychi_63" value="22" <?php
        if($check_res['initial_psychi_63']=="22"){
         echo "checked";
        }?>> feelings of worthlessness or excessive or inappropriate guilt</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_64" value="23" <?php
        if($check_res['initial_psychi_64']=="23"){
         echo "checked";
        }?>> independent of mood disturbance</td>
            <td><input type="checkbox" name="initial_psychi_65" value="24" <?php
        if($check_res['initial_psychi_65']=="24"){
         echo "checked";
        }?>> recurrent thoughts of death or suicidal ideation</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_66" value="25" <?php
        if($check_res['initial_psychi_66']=="25"){
         echo "checked";
        }?>> suicidal thoughts:</td>
            <td><input type="checkbox" name="initial_psychi_67" value="26" <?php
        if($check_res['initial_psychi_67']=="26"){
         echo "checked";
        }?>> diminished ability to think or concentrate, indecisiveness either subjective or objective</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_68" value="27" <?php
        if($check_res['initial_psychi_68']=="27"){
         echo "checked";
        }?>> homicidal thoughts:</td>
            <td><input type="checkbox" name="initial_psychi_69" value="28" <?php
        if($check_res['initial_psychi_69']=="28"){
         echo "checked";
        }?>> substance/medication induced depression</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_70" value="29"> <?php
        if($check_res['initial_psychi_70']=="29"){
         echo "checked";
        }?> obsessions</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_71" value="30" <?php
        if($check_res['initial_psychi_71']=="30"){
         echo "checked";
        }?>> compulsions</td>
          </tr>
        </table>
        <br>

        <div class="row">
          <div class="col-4 boralign">
            <div><h6><input type="checkbox" name="initial_psychi_571" value="1" <?php
              if($check_res['initial_psychi_571']=="1"){
              echo "checked";
              }?>>ADHD: Hyperactivity/</h6></div>
            <div><h6> Impulsivity (6 or more)</h6></div>
            <div><input type="checkbox" name="initial_psychi_572" value="2" <?php
              if($check_res['initial_psychi_572']=="2"){
              echo "checked";
              }?>>fidgety/ squirming in seat</div>
            <div><input type="checkbox" name="initial_psychi_573" value="3" <?php
              if($check_res['initial_psychi_573']=="3"){
              echo "checked";
              }?>>leaves seat in classroom or office</div>
            <div><input type="checkbox" name="initial_psychi_574" value="4" <?php
              if($check_res['initial_psychi_574']=="4"){
              echo "checked";
              }?>>fails close attention</div>
            <div><input type="checkbox" name="initial_psychi_575" value="5" <?php
              if($check_res['initial_psychi_575']=="5"){
              echo "checked";
              }?>>runs about/climbs in</div>
            <div>inappropriate situations</div>
            <div><input type="checkbox" name="initial_psychi_576" value="6" <?php
              if($check_res['initial_psychi_576']=="6"){
              echo "checked";
              }?>>difficulty playing quietly</div>
            <div><input type="checkbox" name="initial_psychi_577" value="7" <?php
              if($check_res['initial_psychi_577']=="7"){
              echo "checked";
              }?>>“on the go”</div>
            <div><input type="checkbox" name="initial_psychi_578" value="8" <?php
              if($check_res['initial_psychi_578']=="8"){
              echo "checked";
              }?>>talking excessively</div>
            <div><input type="checkbox" name="initial_psychi_579" value="9" <?php
              if($check_res['initial_psychi_579']=="9"){
              echo "checked";
              }?>>blurting answers</div>
            <div><input type="checkbox" name="initial_psychi_580" value="10" <?php
              if($check_res['initial_psychi_580']=="10"){
              echo "checked";
              }?>>difficulty awaiting turn</div>
          </div>
          <div class="col-4 boralign">
            <div><h6><input type="checkbox" name="initial_psychi_581" value="11" <?php
              if($check_res['initial_psychi_581']=="11"){
              echo "checked";
              }?>>Conduct Disorder (3 or more)</h6></div>
            <div><input type="checkbox" name="initial_psychi_582" value="12" <?php
              if($check_res['initial_psychi_582']=="12"){
              echo "checked";
              }?>>aggression to people/ animals</div>
            <div><input type="checkbox" name="initial_psychi_583" value="13" <?php
              if($check_res['initial_psychi_583']=="13"){
              echo "checked";
              }?>>bullying/ threatening/ intimidating/</div>
            <div>initiating fights</div>
            <div><input type="checkbox" name="initial_psychi_584" value="14" <?php
              if($check_res['initial_psychi_584']=="14"){
              echo "checked";
              }?>>used weapon causing harm</div>
            <div><input type="checkbox" name="initial_psychi_585" value="15" <?php
              if($check_res['initial_psychi_585']=="15"){
              echo "checked";
              }?>>physically cruel to people/ animals</div>
            <div><input type="checkbox" name="initial_psychi_586" value="16" <?php
              if($check_res['initial_psychi_586']=="16"){
              echo "checked";
              }?>>stealing with confrontation</div>
            <div><input type="checkbox" name="initial_psychi_587" value="17" <?php
              if($check_res['initial_psychi_587']=="17"){
              echo "checked";
              }?>>forced into sexual activity</div>
          </div>
          <div class="col-4 boralign">
            <div><h6><input type="checkbox" name="initial_psychi_588" value="18" <?php
              if($check_res['initial_psychi_588']=="18"){
              echo "checked";
              }?>>ADHD: Inattention (6
            or more)</h6></div>
            <div><input type="checkbox" name="initial_psychi_589" value="19" <?php
              if($check_res['initial_psychi_589']=="19"){
              echo "checked";
              }?>>inattention</div>
            <div><input type="checkbox" name="initial_psychi_590" value="20" <?php
              if($check_res['initial_psychi_590']=="20"){
              echo "checked";
              }?>>difficulty sustaining attention</div>
            <div><input type="checkbox" name="initial_psychi_591" value="21" <?php
              if($check_res['initial_psychi_591']=="21"){
              echo "checked";
              }?>>difficulty listening</div>
            <div><input type="checkbox" name="initial_psychi_592" value="22" <?php
              if($check_res['initial_psychi_592']=="22"){
              echo "checked";
              }?>>difficulty following</div>
            <div>instructions</div>
            <div><input type="checkbox" name="initial_psychi_593" value="23" <?php
              if($check_res['initial_psychi_593']=="23"){
              echo "checked";
              }?>>difficulty finishing tasks</div>
            <div><input type="checkbox" name="initial_psychi_594" value="24" <?php
              if($check_res['initial_psychi_594']=="24"){
              echo "checked";
              }?>>poor time management</div>
            <div><input type="checkbox" name="initial_psychi_595" value="25" <?php
              if($check_res['initial_psychi_595']=="25"){
              echo "checked";
              }?>>difficulty organizing</div>
            <div><input type="checkbox" name="initial_psychi_596" value="26" <?php
              if($check_res['initial_psychi_596']=="26"){
              echo "checked";
              }?>>losing things often</div>
            <div><input type="checkbox" name="initial_psychi_597" value="27" <?php
              if($check_res['initial_psychi_597']=="27"){
              echo "checked";
              }?>>easily distracted</div>
            <div><input type="checkbox" name="initial_psychi_598" value="28" <?php
              if($check_res['initial_psychi_598']=="28"){
              echo "checked";
              }?>>forgetful</div>
          </div>

          <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_72" value="1" <?php
        if($check_res['initial_psychi_72']=="1"){
         echo "checked";
        }?>><b>Deceitful/ Theft</b></div>
            <div><input type="checkbox" name="initial_psychi_73" value="2" <?php
        if($check_res['initial_psychi_73']=="2"){
         echo "checked";
        }?>> breaking in</div>
            <div><input type="checkbox" name="initial_psychi_74" value="3" <?php
        if($check_res['initial_psychi_74']=="3"){
         echo "checked";
        }?>> lying</div>
            <div><input type="checkbox" name="initial_psychi_75" value="4" <?php
        if($check_res['initial_psychi_75']=="4"){
         echo "checked";
        }?>> stealing</div>
            <div><input type="checkbox" name="initial_psychi_76" value="5" <?php
        if($check_res['initial_psychi_76']=="5"){
         echo "checked";
        }?>> serious violation(s)</div>
            <div><input type="checkbox" name="initial_psychi_77" value="6" <?php
        if($check_res['initial_psychi_77']=="6"){
         echo "checked";
        }?>> staying out late</div>
            <div><input type="checkbox" name="initial_psychi_78" value="7" <?php
        if($check_res['initial_psychi_78']=="7"){
         echo "checked";
        }?>> running away (minimum 2x)</div>
          </div>
          <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_79" value="1" <?php
        if($check_res['initial_psychi_79']=="1"){
         echo "checked";
        }?>><b>ODD (4 or more)</b></div>
            <div><input type="checkbox" name="initial_psychi_80" value="2" <?php
        if($check_res['initial_psychi_80']=="2"){
         echo "checked";
        }?>> losing temper</div>
            <div><input type="checkbox" name="initial_psychi_81" value="3" <?php
        if($check_res['initial_psychi_81']=="3"){
         echo "checked";
        }?>> arguing with adults</div>
            <div><input type="checkbox" name="initial_psychi_82" value="4" <?php
        if($check_res['initial_psychi_82']=="4"){
         echo "checked";
        }?>> defiant/ refusal to comply</div>
            <div><input type="checkbox" name="initial_psychi_83" value="5" <?php
        if($check_res['initial_psychi_83']=="5"){
         echo "checked";
        }?>> deliberately annoying people</div>
            <div><input type="checkbox" name="initial_psychi_84" value="6" <?php
        if($check_res['initial_psychi_84']=="6"){
         echo "checked";
        }?>> blaming others for mistakes</div>
            <div><input type="checkbox" name="initial_psychi_85" value="7" <?php
        if($check_res['initial_psychi_85']=="7"){
         echo "checked";
        }?>> touchy/ easily annoyed</div>
            <div><input type="checkbox" name="initial_psychi_86" value="8" <?php
        if($check_res['initial_psychi_86']=="8"){
         echo "checked";
        }?>> angry</div>
            <div><input type="checkbox" name="initial_psychi_87" value="9" <?php
        if($check_res['initial_psychi_87']=="9"){
         echo "checked";
        }?>> resentful</div>
          </div>
          <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_88" value="1" <?php
        if($check_res['initial_psychi_88']=="1"){
         echo "checked";
        }?>><b>Autism (6 or more)</b></div>
            <div><input type="checkbox" name="initial_psychi_89" value="2" <?php
        if($check_res['initial_psychi_89']=="2"){
         echo "checked";
        }?>> Social interaction</div>
            <div><input type="checkbox" name="initial_psychi_90" value="3" <?php
        if($check_res['initial_psychi_90']=="3"){
         echo "checked";
        }?>> impairment to multiple nonverbal</div>
            <div><input type="checkbox" name="initial_psychi_91" value="4" <?php
        if($check_res['initial_psychi_91']=="4"){
         echo "checked";
        }?>> lack of age appropriate relationships</div>
            <div><input type="checkbox" name="initial_psychi_92" value="5" <?php
        if($check_res['initial_psychi_92']=="5"){
         echo "checked";
        }?>> lack of spontaneity</div>
            <div><input type="checkbox" name="initial_psychi_93" value="6" <?php
        if($check_res['initial_psychi_93']=="6"){
         echo "checked";
        }?>> seeking to share joy</div>
            <div><input type="checkbox" name="initial_psychi_94" value="7" <?php
        if($check_res['initial_psychi_94']=="7"){
         echo "checked";
        }?>> lack of emotional reciprocity</div>
            <div><input type="checkbox" name="initial_psychi_95" value="8" <?php
        if($check_res['initial_psychi_95']=="8"){
         echo "checked";
        }?>> truant before 13</div>
          </div>

          <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_96" value="1" <?php
        if($check_res['initial_psychi_96']=="1"){
         echo "checked";
        }?>><b>Communication</b></div>
            <div><input type="checkbox" name="initial_psychi_97" value="2" <?php
        if($check_res['initial_psychi_97']=="2"){
         echo "checked";
        }?>> delay in speech preoccupation</div>
            <div><input type="checkbox" name="initial_psychi_98" value="3" <?php
        if($check_res['initial_psychi_98']=="3"){
         echo "checked";
        }?>> impaired initiation of conversation</div>
            <div><input type="checkbox" name="initial_psychi_99" value="4" <?php
        if($check_res['initial_psychi_99']=="4"){
         echo "checked";
        }?>> stereotype language</div>
            <div><input type="checkbox" name="initial_psychi_100" value="5" <?php
        if($check_res['initial_psychi_100']=="5"){
         echo "checked";
        }?>> lack of make believe play</div>
            <div><input type="checkbox" name="initial_psychi_101" value="6" <?php
        if($check_res['initial_psychi_101']=="6"){
         echo "checked";
        }?>> spiteful/vindictive</div>
          </div>
          <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_102" value="1" <?php
        if($check_res['initial_psychi_102']=="1"){
         echo "checked";
        }?>><b>Destruction to property</b></div>
            <div><input type="checkbox" name="initial_psychi_103" value="2" <?php
        if($check_res['initial_psychi_103']=="2"){
         echo "checked";
        }?>> deliberate fire setting with harm</div>
            <div><input type="checkbox" name="initial_psychi_104" value="3" <?php
        if($check_res['initial_psychi_104']=="3"){
         echo "checked";
        }?>> deliberate property destruction</div>
          </div>
          <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_105" value="1" <?php
        if($check_res['initial_psychi_105']=="1"){
         echo "checked";
        }?>><b>Anxiety</b></div>
            <div><input type="checkbox" name="initial_psychi_106" value="2" <?php
        if($check_res['initial_psychi_106']=="2"){
         echo "checked";
        }?>> finds it difficult to control worry</div>
            <div><input type="checkbox" name="initial_psychi_107" value="3" <?php
        if($check_res['initial_psychi_107']=="3"){
         echo "checked";
        }?>> restlessness or feeling keyed up or on edge</div>
            <div><input type="checkbox" name="initial_psychi_108" value="4" <?php
        if($check_res['initial_psychi_108']=="4"){
         echo "checked";
        }?>> being easily fatigued</div>
            <div><input type="checkbox" name="initial_psychi_109" value="5" <?php
        if($check_res['initial_psychi_109']=="5"){
         echo "checked";
        }?>> difficulty concentrating or mind going blank</div>
            <div><input type="checkbox" name="initial_psychi_110" value="6" <?php
        if($check_res['initial_psychi_110']=="6"){
         echo "checked";
        }?>> irritability</div>
            <div><input type="checkbox" name="initial_psychi_111" value="7" <?php
        if($check_res['initial_psychi_111']=="7"){
         echo "checked";
        }?>> muscle tension</div>
            <div><input type="checkbox" name="initial_psychi_112" value="8" <?php
        if($check_res['initial_psychi_112']=="8"){
         echo "checked";
        }?>> sleep disturbance</div>
            <div><input type="checkbox" name="initial_psychi_113" value="9" <?php
        if($check_res['initial_psychi_113']=="9"){
         echo "checked";
        }?>> panic disorder</div>
            <div><input type="checkbox" name="initial_psychi_114" value="10" <?php
        if($check_res['initial_psychi_114']=="10"){
         echo "checked";
        }?>> specific phobia</div>
            <div><input type="checkbox" name="initial_psychi_115" value="11" <?php
        if($check_res['initial_psychi_115']=="11"){
         echo "checked";
        }?>> social anxiety disorder</div>
            <div><input type="checkbox" name="initial_psychi_116" value="12" <?php
        if($check_res['initial_psychi_116']=="12"){
         echo "checked";
        }?>> agoraphobia</div>
            <div><input type="checkbox" name="initial_psychi_117" value="13" <?php
        if($check_res['initial_psychi_117']=="13"){
         echo "checked";
        }?>> substance/medication induced anxiety</div>
          </div>

          <div class="col-6 boralign">
          <br>  <b>Primary Care:</b> <input type="text" name="initial_psychi_118" value="<?php echo $check_res['initial_psychi_118']; ?>">
          </div>
          <div class="col-6 boralign">
          <br>  <b>Phone:</b> <input type="text" name="initial_psychi_119" value="<?php echo $check_res['initial_psychi_119']; ?>">
          </div>
          <div class="col-12 boralign">
          <b>Address:</b> <input style="width:80%" type="text" name="initial_psychi_120" value="<?php echo $check_res['initial_psychi_120']; ?>">
          </div>

          <div class="col-6 boralign">
          <br> <b>MD:</b> <input type="text" name="initial_psychi_121" value="<?php echo $check_res['initial_psychi_121']; ?>">
          </div>
          <div class="col-6 boralign">
          <br>  <b>Phone:</b> <input type="text" name="initial_psychi_122" value="<?php echo $check_res['initial_psychi_122']; ?>">
          </div>
          <div class="col-12 boralign">
          <b>Address:</b> <input style="width:80%" type="text" name="initial_psychi_123" value="<?php echo $check_res['initial_psychi_123']; ?>">
          </div>

          <div class="col-6 boralign">
          <br><b>Therapist:</b> <input type="text" name="initial_psychi_124" value="<?php echo $check_res['initial_psychi_124']; ?>">
          </div>
          <div class="col-6 boralign">
          <br>  <b>Phone:</b> <input type="text" name="initial_psychi_125" value="<?php echo $check_res['initial_psychi_125']; ?>">
          </div>
          <div class="col-12 boralign">
          <b>Address:</b> <input style="width:80%" type="text" name="initial_psychi_126" value="<?php echo $check_res['initial_psychi_126']; ?>">
          </div>

          <div class="col-6 boralign">
          <br><b>Other:</b> <input type="text" name="initial_psychi_127" value="<?php echo $check_res['initial_psychi_127']; ?>">
          </div>
          <div class="col-6 boralign">
          <br>  <b>Phone:</b> <input type="text" name="initial_psychi_128" value="<?php echo $check_res['initial_psychi_128']; ?>">
          </div>
          <div class="col-12 boralign">
          <b>Address:</b> <input style="width:80%" type="text" name="initial_psychi_129" value="<?php echo $check_res['initial_psychi_129']; ?>">
          </div>

          <div class="col-12 boralign">
              <br><b>Current Psychotropic Medications:</b> <input style="width:60%" type="text" name="initial_psychi_130" value="<?php echo $check_res['initial_psychi_130']; ?>">
          </div>
          <div class="col-12 boralign">
          <b>Other Medications (including OTC):</b> <input style="width:60%" type="text" name="initial_psychi_131" value="<?php echo $check_res['initial_psychi_131']; ?>">
          </div>

          <div class="col-12 boralign">
          </div>
          <div class="col-4 boralign"><b>When:</b> <input type="text" name="initial_psychi_599" value="<?php echo $check_res['initial_psychi_599']; ?>"></div>
          <div class="col-4 boralign"><b>Where:</b> <input type="text" name="initial_psychi_132" value="<?php echo $check_res['initial_psychi_132']; ?>"></div>
          <div class="col-4 boralign"> <b>Reason:</b> <input type="text" name="initial_psychi_133" value="<?php echo $check_res['initial_psychi_133']; ?>"></div>

          <div class="col-12 boralign">
              <br><input type="checkbox" name="initial_psychi_134" value="1" <?php
        if($check_res['initial_psychi_134']=="1"){
         echo "checked";
        }?>> <b>Inpatient:</b> <input style="width:60%" type="text" name="initial_psychi_135" value="<?php echo $check_res['initial_psychi_135']; ?>">
          </div>
          <div class="col-4 boralign"><b>When:</b> <input type="text" name="initial_psychi_136" value="<?php echo $check_res['initial_psychi_136']; ?>">(duration)</div>
          <div class="col-4 boralign"><b>Where:</b> <input type="text" name="initial_psychi_137" value="<?php echo $check_res['initial_psychi_137']; ?>"></div>
          <div class="col-4 boralign"> <b>Reason:</b> <input type="text" name="initial_psychi_138" value="<?php echo $check_res['initial_psychi_138']; ?>"></div>

          <div class="col-4 center"><input type="checkbox" name="initial_psychi_139" value="1" <?php
        if($check_res['initial_psychi_139']=="1"){
         echo "checked";
        }?>><b>none</b></div>
          <div class="col-4 center"><input type="checkbox" name="initial_psychi_140" value="2" <?php
        if($check_res['initial_psychi_140']=="2"){
         echo "checked";
        }?>><b>experienced</b></div>
          <div class="col-4 center"><input type="checkbox" name="initial_psychi_141" value="3" <?php
        if($check_res['initial_psychi_141']=="3"){
         echo "checked";
        }?>><b>witnessed</b></div>

          <div class="col-12 boralign">
              <br><input type="checkbox" name="initial_psychi_142" value="1" <?php
        if($check_res['initial_psychi_142']=="1"){
         echo "checked";
        }?>> <b>abuse:</b> By whom? <input style="width:60%" type="text" name="initial_psychi_143" value="<?php echo $check_res['initial_psychi_143']; ?>">
          </div>
          <div class="col-12 boralign">
              <br><input type="checkbox" name="initial_psychi_144" value="2" <?php
        if($check_res['initial_psychi_144']=="2"){
         echo "checked";
        }?>> <b>neglect:</b> By whom? <input style="width:60%" type="text" name="initial_psychi_145" value="<?php echo $check_res['initial_psychi_145']; ?>">
          </div>
          <div class="col-12 boralign">
              <br><input type="checkbox" name="initial_psychi_146" value="3" <?php
        if($check_res['initial_psychi_146']=="3"){
         echo "checked";
        }?>> <b>physical:</b> By whom? <input style="width:60%" type="text" name="initial_psychi_147" value="<?php echo $check_res['initial_psychi_147']; ?>">
          </div>
          <div class="col-12 boralign">
              <br><input type="checkbox" name="initial_psychi_148" value="4" <?php
        if($check_res['initial_psychi_148']=="4"){
         echo "checked";
        }?>> <b>emotional:</b> By whom? <input style="width:60%" type="text" name="initial_psychi_149" value="<?php echo $check_res['initial_psychi_149']; ?>">
          </div>
          <div class="col-12 boralign">
              <br><input type="checkbox" name="initial_psychi_150" value="5" <?php
        if($check_res['initial_psychi_150']=="5"){
         echo "checked";
        }?>> <b>sexual:</b> By whom? <input style="width:60%" type="text" name="initial_psychi_151" value="<?php echo $check_res['initial_psychi_151']; ?>">
          </div>
          <div class="col-12 boralign">
              <br><input type="checkbox" name="initial_psychi_152" value="6" <?php
        if($check_res['initial_psychi_152']=="6"){
         echo "checked";
        }?>> <b>violence:</b> By whom? <input style="width:60%" type="text" name="initial_psychi_153" value="<?php echo $check_res['initial_psychi_153']; ?>">
          </div>

          <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_154" value="1" <?php
        if($check_res['initial_psychi_154']=="1"){
         echo "checked";
        }?>><b>Smoking:</b></div>
            <div>Age you began: <input type="text" name="initial_psychi_155" value="<?php echo $check_res['initial_psychi_155']; ?>"></div>
          </div>
          <div class="col-4 boralign">
          </div>
          <div class="col-4 boralign">
          </div>

          <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_156" value="1" <?php
        if($check_res['initial_psychi_156']=="1"){
         echo "checked";
        }?>><b>Alcohol:</b></div>
            <div>Age you began: <input type="text" name="initial_psychi_157" value="<?php echo $check_res['initial_psychi_157']; ?>"></div>
          </div>
          <div class="col-4 boralign">
            <div>Age of escalation: <input type="text" name="initial_psychi_158" value="<?php echo $check_res['initial_psychi_158']; ?>"></div>
            <div>Amount: <input type="text" name="initial_psychi_159" value="<?php echo $check_res['initial_psychi_159']; ?>"></div>
            <div>Frequency: <input type="text" name="initial_psychi_160" value="<?php echo $check_res['initial_psychi_160']; ?>"></div>
            <div>Age it became problem: <input type="text" name="initial_psychi_161" value="<?php echo $check_res['initial_psychi_161']; ?>"></div>
          </div>
          <div class="col-4 boralign">
            <div>Date: <input type="text" name="initial_psychi_162" value="<?php echo $check_res['initial_psychi_162']; ?>"></div>
            <div>Quantity: <input type="text" name="initial_psychi_163" value="<?php echo $check_res['initial_psychi_163']; ?>"></div>
          </div>

          <div class="col-4 center boralign"><input type="checkbox" name="initial_psychi_164" value="1" <?php
        if($check_res['initial_psychi_164']=="1"){
         echo "checked";
        }?>><b>Seizures</b></div>
          <div class="col-4 center boralign"><input type="checkbox" name="initial_psychi_165" value="2" <?php
        if($check_res['initial_psychi_165']=="2"){
         echo "checked";
        }?>><b>Black Outs</b></div>
          <div class="col-4 center boralign"><input type="checkbox" name="initial_psychi_166" value="3" <?php
        if($check_res['initial_psychi_166']=="3"){
         echo "checked";
        }?>><b>DTs</b> &emsp;&emsp;<input type="checkbox" name="initial_psychi_167" value="4" <?php
        if($check_res['initial_psychi_167']=="4"){
         echo "checked";
        }?>><b>Tremors</b></div>

          <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_168" value="1" <?php
        if($check_res['initial_psychi_168']=="1"){
         echo "checked";
        }?>><b>Marijuana:</b></div>
          </div>
          <div class="col-4 boralign">
            <div>Age of escalation: <input type="text" name="initial_psychi_169" value="<?php echo $check_res['initial_psychi_169']; ?>"></div>
            <div>Amount: <input type="text" name="initial_psychi_170" value="<?php echo $check_res['initial_psychi_170']; ?>"></div>
            <div>Frequency: <input type="text" name="initial_psychi_171" value="<?php echo $check_res['initial_psychi_171']; ?>"></div>
            <div>Age it became problem: <input style="width:40%" type="text" name="initial_psychi_172" value="<?php echo $check_res['initial_psychi_172']; ?>"></div>
          </div>
          <div class="col-4 boralign">
            <div>Date: <input type="text" name="initial_psychi_173" value="<?php echo $check_res['initial_psychi_173']; ?>"></div>
            <div>Quantity: <input type="text" name="initial_psychi_174" value="<?php echo $check_res['initial_psychi_174']; ?>"></div>
          </div>


          <div class="col-4 boralign">
              <div><b><input type="checkbox" name="initial_psychi_175" value="1" <?php
        if($check_res['initial_psychi_175']=="1"){
         echo "checked";
        }?>>Cocaine:</b></div>
              <div><b>Route of Admin:</b> <input type="text" name="initial_psychi_176" value="<?php echo $check_res['initial_psychi_176']; ?>"></div>
          </div>
          <div class="col-4 boralign">
              <div>Age of escalation: <input type="text" name="initial_psychi_177" value="<?php echo $check_res['initial_psychi_177']; ?>"></div>
              <div>Amount: <input type="text" name="initial_psychi_178" value="<?php echo $check_res['initial_psychi_178']; ?>"></div>
              <div>Frequency: <input type="text" name="initial_psychi_179" value="<?php echo $check_res['initial_psychi_179']; ?>"></div>
              <div>Age it became problem: <input style="width:40%" type="text" name="initial_psychi_180" value="<?php echo $check_res['initial_psychi_180']; ?>"></div>
          </div>
          <div class="col-4 boralign">
              <div>Date: <input type="text" name="initial_psychi_181" value="<?php echo $check_res['initial_psychi_181']; ?>"></div>
              <div>Quantity: <input type="text" name="initial_psychi_182" value="<?php echo $check_res['initial_psychi_182']; ?>"></div>
          </div>


        <div class="col-4"><b>IV: From:</b> <input type="text" name="initial_psychi_183" value="<?php echo $check_res['initial_psychi_183']; ?>"></div>
        <div class="col-2"><b>To</b> <input style="width:30%" type="text" name="initial_psychi_184" value="<?php echo $check_res['initial_psychi_184']; ?>"></div>
        <div class="col-2"><b>IN:</b> <input style="width:30%" type="text" name="initial_psychi_185" value="<?php echo $check_res['initial_psychi_185']; ?>"></div>
        <div class="col-2"><b>From:</b> <input style="width:30%" type="text" name="initial_psychi_186" value="<?php echo $check_res['initial_psychi_186']; ?>"></div>
        <div class="col-2"><b>To:</b> <input style="width:30%" type="text" name="initial_psychi_187" value="<?php echo $check_res['initial_psychi_187']; ?>"></div>

        <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_188" value="1" <?php
        if($check_res['initial_psychi_188']=="1"){
         echo "checked";
        }?>><b>Heroin:</b></div>
        </div>
        <div class="col-4 boralign">
            <div>Age of escalation: <input type="text" name="initial_psychi_189" value="<?php echo $check_res['initial_psychi_189']; ?>"></div>
            <div>Amount: <input type="text" name="initial_psychi_190" value="<?php echo $check_res['initial_psychi_190']; ?>"></div>
            <div>Frequency: <input type="text" name="initial_psychi_191" value="<?php echo $check_res['initial_psychi_191']; ?>"></div>
            <div>Age it became problem: <input style="width:40%" type="text" name="initial_psychi_192" value="<?php echo $check_res['initial_psychi_192']; ?>"></div>
        </div>
        <div class="col-4 boralign">
            <div>Date: <input type="text" name="initial_psychi_193" value="<?php echo $check_res['initial_psychi_193']; ?>"></div>
            <div>Quantity: <input type="text" name="initial_psychi_194" value="<?php echo $check_res['initial_psychi_194']; ?>"></div>
        </div>


        <div class="col-4"><input type="checkbox" name="initial_psychi_559" value="1" <?php
        if($check_res['initial_psychi_559']=="1"){
         echo "checked";
        }?>><b>IV: From:</b> <input type="text" name="initial_psychi_195" value="<?php echo $check_res['initial_psychi_195']; ?>"></div>
        <div class="col-2"><b>To</b> <input style="width:30%" type="text" name="initial_psychi_196" value="<?php echo $check_res['initial_psychi_196']; ?>"></div>
        <div class="col-2"><b><input type="checkbox" name="initial_psychi_560" value="1" <?php
        if($check_res['initial_psychi_560']=="1"){
         echo "checked";
        }?>>IN:</b> <input style="width:30%" type="text" name="initial_psychi_197" value="<?php echo $check_res['initial_psychi_197']; ?>"></div>
        <div class="col-2"><b>From:</b> <input style="width:30%" type="text" name="initial_psychi_198" value="<?php echo $check_res['initial_psychi_198']; ?>"></div>
        <div class="col-2"><b>To:</b> <input style="width:30%" type="text" name="initial_psychi_199" value="<?php echo $check_res['initial_psychi_199']; ?>"></div>

        <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_200" value="1" <?php
        if($check_res['initial_psychi_200']=="1"){
         echo "checked";
        }?>><b>Other Opiates:</b></div>
            <div><b>Fentanyl</b></div>
            <div><b>Oxycodone</b></div>
            <div><b>Hydrocodone</b></div>
            <div><b>Codeine</b></div>
            <div><b>Morphine</b></div>
        </div>
        <div class="col-4 boralign">
            <div>Age of escalation: <input type="text" name="initial_psychi_201" value="<?php echo $check_res['initial_psychi_201']; ?>"></div>
            <div>Amount: <input type="text" name="initial_psychi_202" value="<?php echo $check_res['initial_psychi_202']; ?>"></div>
            <div>Frequency: <input type="text" name="initial_psychi_203" value="<?php echo $check_res['initial_psychi_203']; ?>"></div>
            <div>Age it became problem: <input style="width:40%" type="text" name="initial_psychi_204" value="<?php echo $check_res['initial_psychi_204']; ?>"></div>
        </div>
        <div class="col-4 boralign">
            <div>Date: <input type="text" name="initial_psychi_205" value="<?php echo $check_res['initial_psychi_205']; ?>"></div>
            <div>Quantity: <input type="text" name="initial_psychi_206" value="<?php echo $check_res['initial_psychi_206']; ?>"></div>
        </div>

        <div class="col-4"><input type="checkbox" name="initial_psychi_561" value="1" <?php
        if($check_res['initial_psychi_561']=="1"){
         echo "checked";
        }?>><b>IV: From:</b> <input type="text" name="initial_psychi_207" value="<?php echo $check_res['initial_psychi_207']; ?>"></div>
        <div class="col-2"><b>To</b> <input style="width:30%" type="text" name="initial_psychi_208" value="<?php echo $check_res['initial_psychi_208']; ?>"></div>
        <div class="col-2"><b><input type="checkbox" name="initial_psychi_562" value="1" <?php
        if($check_res['initial_psychi_562']=="1"){
         echo "checked";
        }?>>IN:</b> <input style="width:30%" type="text" name="initial_psychi_209" value="<?php echo $check_res['initial_psychi_209']; ?>"></div>
        <div class="col-2"><b>From:</b> <input style="width:30%" type="text" name="initial_psychi_210" value="<?php echo $check_res['initial_psychi_210']; ?>"></div>
        <div class="col-2"><b>To:</b> <input style="width:30%" type="text" name="initial_psychi_211" value="<?php echo $check_res['initial_psychi_211']; ?>"></div>

        <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_212" value="1" <?php
        if($check_res['initial_psychi_212']=="1"){
         echo "checked";
        }?>><b>Amphetamines:</b></div>
        </div>
        <div class="col-4 boralign">
            <div>Age of escalation: <input type="text" name="initial_psychi_213" value="<?php echo $check_res['initial_psychi_213']; ?>"></div>
            <div>Amount: <input type="text" name="initial_psychi_214" value="<?php echo $check_res['initial_psychi_214']; ?>"></div>
            <div>Frequency: <input type="text" name="initial_psychi_215" value="<?php echo $check_res['initial_psychi_215']; ?>"></div>
            <div>Age it became problem: <input style="width:40%" type="text" name="initial_psychi_216" value="<?php echo $check_res['initial_psychi_216']; ?>"></div>
        </div>
        <div class="col-4 boralign">
            <div>Date: <input type="text" name="initial_psychi_217" value="<?php echo $check_res['initial_psychi_217']; ?>"></div>
            <div>Quantity: <input type="text" name="initial_psychi_218" value="<?php echo $check_res['initial_psychi_218']; ?>"></div>
        </div>

        <div class="col-4"><input type="checkbox" name="initial_psychi_563" value="1" <?php
        if($check_res['initial_psychi_563']=="1"){
         echo "checked";
        }?>><b>IV: From:</b> <input type="text" name="initial_psychi_219" value="<?php echo $check_res['initial_psychi_219']; ?>"></div>
        <div class="col-2"><b>To</b> <input style="width:30%" type="text" name="initial_psychi_220" value="<?php echo $check_res['initial_psychi_220']; ?>"></div>
        <div class="col-2"><b><input type="checkbox" name="initial_psychi_564" value="1" <?php
        if($check_res['initial_psychi_564']=="1"){
         echo "checked";
        }?>>IN:</b> <input style="width:30%" type="text" name="initial_psychi_221" value="<?php echo $check_res['initial_psychi_221']; ?>"></div>
        <div class="col-2"><b>From:</b> <input style="width:30%" type="text" name="initial_psychi_222" value="<?php echo $check_res['initial_psychi_222']; ?>"></div>
        <div class="col-2"><b>To:</b> <input style="width:30%" type="text" name="initial_psychi_223" value="<?php echo $check_res['initial_psychi_223']; ?>"></div>

        <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_224" value="1" <?php
        if($check_res['initial_psychi_224']=="1"){
         echo "checked";
        }?>><b>Hallucinogens: <input style="width:30%" type="text" name="initial_psychi_225" value="<?php echo $check_res['initial_psychi_225']; ?>"></b></div>
        </div>
        <div class="col-4 boralign">
        </div>
        <div class="col-4 boralign">
        </div>
        <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_226" value="1" <?php
        if($check_res['initial_psychi_226']=="1"){
         echo "checked";
        }?>><b>LSD, K, PCP, others: <input style="width:30%" type="text" name="initial_psychi_227" value="<?php echo $check_res['initial_psychi_227']; ?>"></b></div>
        </div>
        <div class="col-4 boralign">
        </div>
        <div class="col-4 boralign">
        </div>

        <div class="col-4"><input type="checkbox" name="initial_psychi_565" value="1" <?php
        if($check_res['initial_psychi_565']=="1"){
         echo "checked";
        }?>><b>IV: From:</b> <input type="text" name="initial_psychi_228" value="<?php echo $check_res['initial_psychi_228']; ?>"></div>
        <div class="col-2"><b>To</b> <input style="width:30%" type="text" name="initial_psychi_229" value="<?php echo $check_res['initial_psychi_229']; ?>"></div>
        <div class="col-2"><b><input type="checkbox" name="initial_psychi_566" value="1" <?php
        if($check_res['initial_psychi_566']=="1"){
         echo "checked";
        }?>>IN:</b> <input style="width:30%" type="text" name="initial_psychi_230" value="<?php echo $check_res['initial_psychi_230']; ?>"></div>
        <div class="col-2"><b>From:</b> <input style="width:30%" type="text" name="initial_psychi_231" value="<?php echo $check_res['initial_psychi_231']; ?>"></div>
        <div class="col-2"><b>To:</b> <input style="width:30%" type="text" name="initial_psychi_232" value="<?php echo $check_res['initial_psychi_232']; ?>"></div>

        <div class="col-4 boralign">
            <div><input type="checkbox" name="initial_psychi_233" value="1" <?php
        if($check_res['initial_psychi_233']=="1"){
         echo "checked";
        }?>><b>benzodiazepines:</b></div>
            <div><input type="text" name="initial_psychi_234" value="<?php echo $check_res['initial_psychi_234']; ?>"></div>
        </div>
        <div class="col-4 boralign">
            <div>Age of escalation: <input type="text" name="initial_psychi_235" value="<?php echo $check_res['initial_psychi_235']; ?>"></div>
            <div>Amount: <input type="text" name="initial_psychi_236" value="<?php echo $check_res['initial_psychi_236']; ?>"></div>
            <div>Frequency: <input type="text" name="initial_psychi_237" value="<?php echo $check_res['initial_psychi_237']; ?>"></div>
            <div>Age it became problem: <input style="width:40%" type="text" name="initial_psychi_238" value="<?php echo $check_res['initial_psychi_238']; ?>"></div>
        </div>
        <div class="col-4 boralign">
            <div>Date: <input type="text" name="initial_psychi_239" value="<?php echo $check_res['initial_psychi_239']; ?>"></div>
            <div>Quantity: <input type="text" name="initial_psychi_240" value="<?php echo $check_res['initial_psychi_240']; ?>"></div>
        </div>

        <div class="col-4"><input type="checkbox" name="initial_psychi_567" value="1" <?php
        if($check_res['initial_psychi_567']=="1"){
         echo "checked";
        }?>><b>IV: From:</b> <input type="text" name="initial_psychi_241" value="<?php echo $check_res['initial_psychi_241']; ?>"></div>
        <div class="col-2"><b>To</b> <input style="width:30%" type="text" name="initial_psychi_242" value="<?php echo $check_res['initial_psychi_242']; ?>"></div>
        <div class="col-2"><b><input type="checkbox" name="initial_psychi_568" value="1" <?php
        if($check_res['initial_psychi_568']=="1"){
         echo "checked";
        }?>>IN:</b> <input style="width:30%" type="text" name="initial_psychi_243" value="<?php echo $check_res['initial_psychi_243']; ?>"></div>
        <div class="col-2"><b>From:</b> <input style="width:30%" type="text" name="initial_psychi_244" value="<?php echo $check_res['initial_psychi_244']; ?>"></div>
        <div class="col-2"><b>To:</b> <input style="width:30%" type="text" name="initial_psychi_245" value="<?php echo $check_res['initial_psychi_245']; ?>"></div>

        <div class="col-12 boralign">
            <div><input type="checkbox" name="initial_psychi_246" value="1" <?php
        if($check_res['initial_psychi_246']=="1"){
         echo "checked";
        }?>><b>inhalants:</b></div>
        </div>
        <div class="col-12 boralign">
            <div><input type="checkbox" name="initial_psychi_247" value="1" <?php
        if($check_res['initial_psychi_247']=="1"){
         echo "checked";
        }?>><b>Sobriety:</b>
            <input style="width:60%" type="text" name="initial_psychi_248" value="<?php echo $check_res['initial_psychi_248']; ?>"></div>
            <div><input type="checkbox" name="initial_psychi_249" value="2"> <?php
        if($check_res['initial_psychi_249']=="2"){
         echo "checked";
        }?><b>How long:</b>
            <input style="width:80%" type="text" name="initial_psychi_250" value="<?php echo $check_res['initial_psychi_250']; ?>"></div>
        </div>
        <div class="col-12 boralign">
            <div><input type="checkbox" name="initial_psychi_251" value="1" <?php
        if($check_res['initial_psychi_251']=="1"){
         echo "checked";
        }?>><b>Others:</b></div>
        </div>
        <div class="col-12 boralign">
            <div><b>Spiritual beliefs:</b><input type="text" name="initial_psychi_252" value="<?php echo $check_res['initial_psychi_252']; ?>"></div>
        </div>
        <div class="col-12 boralign">
            <div><b>Religiosity:</b><input type="text" name="initial_psychi_253" value="<?php echo $check_res['initial_psychi_253']; ?>"></div>
        </div>
        <div class="col-12 boralign">
            <div><b>AA/ 12 Steps: {Yes/No}</b><input type="text" name="initial_psychi_254" value="<?php echo $check_res['initial_psychi_254']; ?>"></div>
        </div>

        <div class="col-12"><b>Substance Abuse Treatment History:</b></div>

        <div class="col-3">
          <div>Facility Name</div>
          <div><input type="text" name="initial_psychi_255" value="<?php echo $check_res['initial_psychi_255']; ?>"></div>
        </div>
        <div class="col-2">
          <div>When?</div>
          <div><input type="text" name="initial_psychi_256" value="<?php echo $check_res['initial_psychi_256']; ?>"></div>
        </div>
        <div class="col-2">
          <div>Length of Tx</div>
          <div><input type="text" name="initial_psychi_257" value="<?php echo $check_res['initial_psychi_257']; ?>"></div>
        </div>
        <div class="col-3">
          <div>Completed?</div>
          <div><input type="text" name="initial_psychi_258" value="<?php echo $check_res['initial_psychi_258']; ?>"></div>
        </div>
        <div class="col-2">
          <div>Outcome</div>
          <div><input  type="text" name="initial_psychi_259" value="<?php echo $check_res['initial_psychi_259']; ?>"></div>
        </div>

        <div class="col-12 boralign">
          <input type="checkbox" name="initial_psychi_260" value="1" <?php
        if($check_res['initial_psychi_260']=="1"){
         echo "checked";
        }?>><b>Denied</b>
        </div>
        <div class="col-12 boralign">
          <input type="checkbox" name="initial_psychi_261" value="1" <?php
        if($check_res['initial_psychi_261']=="1"){
         echo "checked";
        }?>><b>DUI’s:</b> <input type="text" name="initial_psychi_262" value="<?php echo $check_res['initial_psychi_262']; ?>">&emsp;<input type="text" name="initial_psychi_263" value="<?php echo $check_res['initial_psychi_263']; ?>">
        </div>
        <div class="col-12 boralign">
          <input type="checkbox" name="initial_psychi_264" value="1" <?php
        if($check_res['initial_psychi_264']=="1"){
         echo "checked";
        }?>><b>Arrests:</b> When? <input type="text" name="initial_psychi_265" value="<?php echo $check_res['initial_psychi_265']; ?>">&emsp;For What? <input type="text" name="initial_psychi_266" value="<?php echo $check_res['initial_psychi_266']; ?>">
        </div>
        <div class="col-12 boralign">
          <input type="checkbox" name="initial_psychi_267" value="1" <?php
        if($check_res['initial_psychi_267']=="1"){
         echo "checked";
        }?>><b>Incarcerations:</b> <input type="text" name="initial_psychi_268" value="<?php echo $check_res['initial_psychi_268']; ?>">&emsp;For What? <input type="text" name="initial_psychi_269" value="<?php echo $check_res['initial_psychi_269']; ?>">
        </div>
        <div class="col-12 boralign">
          <input type="checkbox" name="initial_psychi_270" value="1" <?php
        if($check_res['initial_psychi_270']=="1"){
         echo "checked";
        }?>><b>Convictions:</b> <input type="text" name="initial_psychi_271" value="<?php echo $check_res['initial_psychi_271']; ?>">&emsp;For What? <input type="text" name="initial_psychi_272" value="<?php echo $check_res['initial_psychi_272']; ?>">
        </div>
        <div class="col-12 boralign">
          <input type="checkbox" name="initial_psychi_273" value="1" <?php
        if($check_res['initial_psychi_273']=="1"){
         echo "checked";
        }?>><b>Probation/ Parole:</b> <input type="text" name="initial_psychi_274" value="<?php echo $check_res['initial_psychi_274']; ?>">&emsp;For What? <input type="text" name="initial_psychi_275" value="<?php echo $check_res['initial_psychi_275']; ?>">
        </div>
        <div class="col-12 boralign">
          <input type="checkbox" name="initial_psychi_276" value="1"<?php
        if($check_res['initial_psychi_276']=="1"){
         echo "checked";
        }?>><b>PINS:</b> Not reported
        </div>
        <div class="col-12 boralign">
          <input type="checkbox" name="initial_psychi_277" value="1" <?php
        if($check_res['initial_psychi_277']=="1"){
         echo "checked";
        }?>><b>Other:</b> Not reported
        </div>
        <div class="col-12 boralign">
          <b>HIPPA Release Signed for:</b> <input type="checkbox" name="initial_psychi_278" value="1" <?php
        if($check_res['initial_psychi_278']=="1"){
         echo "checked";
        }?>>Probation Officer&emsp;<input type="checkbox" name="initial_psychi_279" value="2" <?php
        if($check_res['initial_psychi_279']=="2"){
         echo "checked";
        }?>>Parole Officer</b>&emsp;<input type="checkbox" name="initial_psychi_280" value="3" <?php
        if($check_res['initial_psychi_280']=="3"){
         echo "checked";
        }?>>Court&emsp;<input type="checkbox" name="initial_psychi_570" value="4" <?php
        if($check_res['initial_psychi_570']=="4"){
         echo "checked";
        }?>>Lawyer</b>&emsp;<input type="checkbox" name="initial_psychi_281" value="5" <?php
        if($check_res['initial_psychi_281']=="5"){
         echo "checked";
        }?>>IDRC&emsp;<input type="checkbox" name="initial_psychi_282" value="6" <?php
        if($check_res['initial_psychi_282']=="6"){
         echo "checked";
        }?>>Other:
        </div>
        <div class="col-12 boralign"><input type="checkbox" name="initial_psychi_283" value="1" <?php
        if($check_res['initial_psychi_283']=="1"){
         echo "checked";
        }?>><b>None:</b></div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_284" value="1" <?php
        if($check_res['initial_psychi_284']=="1"){
         echo "checked";
        }?>><b>Allergies:</b><input type="checkbox" name="initial_psychi_285" value="2" <?php
        if($check_res['initial_psychi_285']=="2"){
         echo "checked";
        }?>>NKDA <input type="checkbox" name="initial_psychi_286" value="3" <?php
        if($check_res['initial_psychi_286']=="3"){
         echo "checked";
        }?>>Yes  <input type="text" name="initial_psychi_287" value="<?php echo $check_res['initial_psychi_287'] ?>" ></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_288" value="1" <?php
        if($check_res['initial_psychi_288']=="1"){
         echo "checked";
        }?>><b>Heart Disease</b></div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_289" value="2" <?php
        if($check_res['initial_psychi_289']=="2"){
         echo "checked";
        }?>><b>HTN</b></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_290" value="3" <?php
        if($check_res['initial_psychi_290']=="3"){
         echo "checked";
        }?>><b>Lung disease</b></div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_291" value="4" <?php
        if($check_res['initial_psychi_291']=="4"){
         echo "checked";
        }?>><b>Asthma</b></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_292" value="5" <?php
        if($check_res['initial_psychi_292']=="5"){
         echo "checked";
        }?>><b>DM</b></div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_293" value="6" <?php
        if($check_res['initial_psychi_293']=="6"){
         echo "checked";
        }?>><b>Head trauma</b></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_294" value="7" <?php
        if($check_res['initial_psychi_294']=="7"){
         echo "checked";
        }?>><b>Seizure disorder</b></div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_295" value="8" <?php
        if($check_res['initial_psychi_295']=="8"){
         echo "checked";
        }?>><b>Liver</b></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_296" value="9" <?php
        if($check_res['initial_psychi_296']=="9"){
         echo "checked";
        }?>><b>Kidney</b></div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_297" value="10" <?php
        if($check_res['initial_psychi_297']=="10"){
         echo "checked";
        }?>><b>Thyroid</b></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_298" value="11" <?php
        if($check_res['initial_psychi_298']=="11"){
         echo "checked";
        }?>><b>Diabetes</b></div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_299" value="12" <?php
        if($check_res['initial_psychi_299']=="12"){
         echo "checked";
        }?>><b>Ulcer/ reflux</b></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_300" value="13" <?php
        if($check_res['initial_psychi_300']=="13"){
         echo "checked";
        }?>><b>Migraines</b></div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_301" value="14" <?php
        if($check_res['initial_psychi_301']=="14"){
         echo "checked";
        }?>><b>Eye problems</b></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_302" value="15" <?php
        if($check_res['initial_psychi_302']=="15"){
         echo "checked";
        }?>><b>Hypertension</b></div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_303" value="1" <?php
        if($check_res['initial_psychi_303']=="1"){
         echo "checked";
        }?>><b>Psychiatric disorders:</b></div>
          <div><input type="text" name="initial_psychi_304" value="<?php echo $check_res['initial_psychi_304']; ?>"></div>
          <div><input type="text" name="initial_psychi_305" value="<?php echo $check_res['initial_psychi_305']; ?>"></div>
          <div><input type="text" name="initial_psychi_306" value="<?php echo $check_res['initial_psychi_306']; ?>"></div>
        </div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_307" value="1" <?php
        if($check_res['initial_psychi_307']=="1"){
         echo "checked";
        }?>><b>Learning disabilities</b></div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_308" value="2" <?php
        if($check_res['initial_psychi_308']=="2"){
         echo "checked";
        }?>><b>Cancer:</b></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_309" value="3" <?php
        if($check_res['initial_psychi_309']=="3"){
         echo "checked";
        }?>><b>Other:</b></div>

        <div class="col-6 boralign">
            <div><input type="checkbox" name="initial_psychi_310" value="1" <?php
        if($check_res['initial_psychi_310']=="1"){
         echo "checked";
        }?>><b>HIV risk factors:</b>&emsp;<input type="checkbox" name="initial_psychi_311" value="2" <?php
        if($check_res['initial_psychi_311']=="2"){
         echo "checked";
        }?>><b>IVDU</b></div>
            <div><input type="checkbox" name="initial_psychi_312" value="3" <?php
        if($check_res['initial_psychi_312']=="3"){
         echo "checked";
        }?>><b>Unprotected Sex</b></div>
            <div><input type="checkbox" name="initial_psychi_313" value="4" <?php
        if($check_res['initial_psychi_313']=="4"){
         echo "checked";
        }?>><b>Psychiatric Acute Illness: Date and reason for hospitalization</b></div>
            <div><input type="text" name="initial_psychi_314" value="<?php echo $check_res['initial_psychi_314']; ?>"></div>
        </div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_315" value="1" <?php
        if($check_res['initial_psychi_315']=="1"){
         echo "checked";
        }?>><b>Immunizations: Up to date</b></div>

        <div class="col-12 boralign">
          <div><input type="checkbox" name="initial_psychi_316" value="1" <?php
        if($check_res['initial_psychi_316']=="1"){
         echo "checked";
        }?>><b>Menstrual History:</b></div>
          <div><b>Menarche:</b> <input type="text" name="initial_psychi_317" value="<?php echo $check_res['initial_psychi_317']; ?>"></div>
          <div><b>Regularity:</b> <input type="checkbox" name="initial_psychi_318" value="1" <?php
        if($check_res['initial_psychi_318']=="1"){
         echo "checked";
        }?>>Regular &emsp;<input type="checkbox" name="initial_psychi_319" value="2" <?php
        if($check_res['initial_psychi_319']=="2"){
         echo "checked";
        }?>>Irregular &emsp;<input type="checkbox" name="initial_psychi_320" value="3" <?php
        if($check_res['initial_psychi_320']=="3"){
         echo "checked";
        }?>>Amenorrhea: &emsp;Since When:<input type="text" name="initial_psychi_321" value="<?php echo $check_res['initial_psychi_321']; ?>"></div>
          <div><b>Duration:</b> <input type="checkbox" name="initial_psychi_322" value="1" <?php
        if($check_res['initial_psychi_322']=="1"){
         echo "checked";
        }?>>21 Days &emsp;<input type="checkbox" name="initial_psychi_323" value="2" <?php
        if($check_res['initial_psychi_323']=="2"){
         echo "checked";
        }?>>30 Days &emsp;<input type="checkbox" name="initial_psychi_324" value="3" <?php
        if($check_res['initial_psychi_324']=="3"){
         echo "checked";
        }?>> 21 Days: &emsp;<input type="checkbox" name="initial_psychi_325" value="4" <?php
        if($check_res['initial_psychi_325']=="4"){
         echo "checked";
        }?>>30 Days</div>
          <div><b>OC:</b> <input type="checkbox" name="initial_psychi_326" value="1" <?php
        if($check_res['initial_psychi_326']=="1"){
         echo "checked";
        }?>>On Pills Name:<input type="text" name="initial_psychi_327" value="<?php echo $check_res['initial_psychi_327']; ?>"><input type="checkbox" name="initial_psychi_328" value="2" <?php
        if($check_res['initial_psychi_328']=="2"){
         echo "checked";
        }?>>On IUD:<input type="text" name="initial_psychi_329" value="<?php echo $check_res['initial_psychi_329']; ?>">Since:<input type="text" name="initial_psychi_330" value="<?php echo $check_res['initial_psychi_330']; ?>"></div>
          <div><b>Related to mood: </b><input type="checkbox" name="initial_psychi_331" value="1" <?php
        if($check_res['initial_psychi_331']=="1"){
         echo "checked";
        }?>>N/A <input type="checkbox" name="initial_psychi_332" value="2" <?php
        if($check_res['initial_psychi_332']=="2"){
         echo "checked";
        }?>>Before Menstruation <input type="checkbox" class="yes_no" name="initial_psychi_333" value="3" <?php
        if($check_res['initial_psychi_333']=="3"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="initial_psychi_334" class="yes_no" value="4" <?php
        if($check_res['initial_psychi_334']=="4"){
         echo "checked";
        }?>>No</div>
          <div><input type="checkbox" name="initial_psychi_335" value="1" <?php
        if($check_res['initial_psychi_335']=="1"){
         echo "checked";
        }?>>After Menstruation <input type="checkbox" class="yes_no1" name="initial_psychi_336" value="2" <?php
        if($check_res['initial_psychi_336']=="2"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="initial_psychi_337" class="yes_no1" value="3" <?php
        if($check_res['initial_psychi_337']=="3"){
         echo "checked";
        }?>>No</div>
          <div>Violent Behavior <input type="checkbox" name="initial_psychi_338" class="yes_no2" value="1" <?php
        if($check_res['initial_psychi_338']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="initial_psychi_339" class="yes_no2" value="2" <?php
        if($check_res['initial_psychi_339']=="2"){
         echo "checked";
        }?>>No</div>
        </div>

        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_340" value="1" <?php
        if($check_res['initial_psychi_340']=="1"){
         echo "checked";
        }?>>Illnesses (include age): <input type="text" name="initial_psychi_341" value="<?php echo $check_res['initial_psychi_341']; ?>"></div>
        <div class="col-6 boralign"><input type="checkbox" name="initial_psychi_342" value="2" <?php
        if($check_res['initial_psychi_342']=="2"){
         echo "checked";
        }?>>Accidents (include age): <input type="text" name="initial_psychi_343" value="<?php echo $check_res['initial_psychi_343']; ?>"></div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_344" value="1" <?php
        if($check_res['initial_psychi_344']=="1"){
         echo "checked";
        }?>>Medical hospitalizations (include age):</div>
          <div><input type="text" name="initial_psychi_345" value="<?php echo $check_res['initial_psychi_345']; ?>">&emsp;<input style="width:10%" type="text" name="initial_psychi_346" value="<?php echo $check_res['initial_psychi_346']; ?>"></div>
          <div><input type="text" name="initial_psychi_347" value="<?php echo $check_res['initial_psychi_347']; ?>">&emsp;<input style="width:10%" type="text" name="initial_psychi_348" value="<?php echo $check_res['initial_psychi_348']; ?>"></div>
          <div><input type="text" name="initial_psychi_349" value="<?php echo $check_res['initial_psychi_349']; ?>">&emsp;<input style="width:10%" type="text" name="initial_psychi_350" value="<?php echo $check_res['initial_psychi_350']; ?>"></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_351" value="1" <?php
        if($check_res['initial_psychi_351']=="1"){
         echo "checked";
        }?>>Surgeries (include age):</div>
          <div><input type="text" name="initial_psychi_352" value="<?php echo $check_res['initial_psychi_352']; ?>">&emsp;<input style="width:10%" type="text" name="initial_psychi_353" value="<?php echo $check_res['initial_psychi_353']; ?>"></div>
          <div><input type="text" name="initial_psychi_354" value="<?php echo $check_res['initial_psychi_354']; ?>">&emsp;<input style="width:10%" type="text" name="initial_psychi_355" value="<?php echo $check_res['initial_psychi_355']; ?>"></div>
          <div><input type="text" name="initial_psychi_356" value="<?php echo $check_res['initial_psychi_356']; ?>">&emsp;<input style="width:10%" type="text" name="initial_psychi_357" value="<?php echo $check_res['initial_psychi_357']; ?>"></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_358" value="1" <?php
        if($check_res['initial_psychi_358']=="1"){
         echo "checked";
        }?>>Suicide risk:</div>
          <div><input type="checkbox" name="initial_psychi_359" value="2" <?php
        if($check_res['initial_psychi_359']=="2"){
         echo "checked";
        }?>>Prior Attempts&emsp;&emsp;<input type="checkbox" class="yes_no3" name="initial_psychi_360" value="3" <?php
        if($check_res['initial_psychi_360']=="3"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="initial_psychi_361" class="yes_no3" value="4" <?php
        if($check_res['initial_psychi_361']=="4"){
         echo "checked";
        }?>>No</div>
          <div><input type="checkbox" name="initial_psychi_362" value="5" <?php
        if($check_res['initial_psychi_362']=="5"){
         echo "checked";
        }?>>Passive Suicidal Ideation <input type="checkbox" class="yes_no9" name="initial_psychi_363" value="6" <?php
        if($check_res['initial_psychi_363']=="6"){
         echo "checked";
        }?>>Plan <input type="checkbox" name="initial_psychi_364" class="yes_no9" value="7" <?php
        if($check_res['initial_psychi_364']=="7"){
         echo "checked";
        }?>>Noplan</div>
          <div>Active Suicidal Ideation<input type="checkbox" class="yes_no10" name="initial_psychi_365" value="8" <?php
        if($check_res['initial_psychi_365']=="8"){
         echo "checked";
        }?>>plan <input type="checkbox" name="initial_psychi_366" class="yes_no10" value="9" <?php
        if($check_res['initial_psychi_366']=="9"){
         echo "checked";
        }?>>Noplan</div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_367" value="1" <?php
        if($check_res['initial_psychi_367']=="1"){
         echo "checked";
        }?>>Personal safety:</div>

        <div>Access to Firearms: <input type="checkbox" class="yes_no4" name="initial_psychi_368" value="2" <?php
        if($check_res['initial_psychi_368']=="2"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="initial_psychi_369" class="yes_no4" value="3" <?php
        if($check_res['initial_psychi_369']=="3"){
         echo "checked";
        }?>>No</div>

          <div>SI: <input type="checkbox" name="initial_psychi_370" class="yes_no5" value="1" <?php
        if($check_res['initial_psychi_370']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="initial_psychi_371" class="yes_no5" value="2" <?php
        if($check_res['initial_psychi_371']=="2"){
         echo "checked";
        }?>>No</div>

          <div>HI: <input type="checkbox" name="initial_psychi_372" class="yes_no6" value="1" <?php
        if($check_res['initial_psychi_372']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="initial_psychi_373" class="yes_no6" value="2" <?php
        if($check_res['initial_psychi_373']=="2"){
         echo "checked";
        }?>>No</div>

          <div>Rage: <input type="checkbox" name="initial_psychi_374" class="yes_no7" value="1" <?php
        if($check_res['initial_psychi_374']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="initial_psychi_375" class="yes_no7" value="2 <?php
        if($check_res['initial_psychi_375']=="2"){
         echo "checked";
        }?>">No</div>

        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_376" value="1" <?php
        if($check_res['initial_psychi_376']=="1"){
         echo "checked";
        }?>>Risk to others: <input type="checkbox" name="initial_psychi_377" value="2" <?php
        if($check_res['initial_psychi_377']=="2"){
         echo "checked";
        }?>>IVDU  <input type="checkbox" name="initial_psychi_378" value="3" <?php
        if($check_res['initial_psychi_378']=="3"){
         echo "checked";
        }?>>Unsafe Sex  <input type="checkbox" name="initial_psychi_379" value="4" <?php
        if($check_res['initial_psychi_379']=="4"){
         echo "checked";
        }?>>DUI</div>
          <div> <input type="checkbox" name="initial_psychi_380" value="5" <?php
        if($check_res['initial_psychi_380']=="5"){
         echo "checked";
        }?>>Risky Behaviors Related to Substance Use <input type="checkbox" name="initial_psychi_381" value="6" <?php
        if($check_res['initial_psychi_381']=="6"){
         echo "checked";
        }?>>All</div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_382" value="1" <?php
        if($check_res['initial_psychi_382']=="1"){
         echo "checked";
        }?>>Personal Strengths:</div>
          <div><input type="text" name="initial_psychi_383" value="<?php echo $check_res['initial_psychi_383']; ?>"></div>
          <div><input type="text" name="initial_psychi_384" value="<?php echo $check_res['initial_psychi_384']; ?>"></div>
        </div>

        <div class="col-12 boralign">
        <b>Literacy level:</b> <input type="checkbox" name="initial_psychi_385" value="1" <?php
        if($check_res['initial_psychi_385']=="1"){
         echo "checked";
        }?>>High School &emsp; <input type="checkbox" name="initial_psychi_386" value="2" <?php
        if($check_res['initial_psychi_386']=="2"){
         echo "checked";
        }?>>College &emsp; <input type="checkbox" name="initial_psychi_387" value="3" <?php
        if($check_res['initial_psychi_387']=="3"){
         echo "checked";
        }?>>Illiterate &emsp; <input type="text" name="initial_psychi_569" value="<?php echo $check_res['initial_psychi_569']; ?>">
        </div>

        <div class="col-12 boralign">
        Need for assistive technology in the provision of services: None
        </div>
        <div class="col-12 boralign">
        Advanced directive when applicable: <input type="text" name="when_applicable" value="<?php echo $check_res['when_applicable']??''; ?>">
        </div>
        <div class="col-12 boralign">
        Psychological and social adjustments to disabilities and/ or disorders: <input type="text" name="disorder" value="<?php echo $check_res['disorder']??''; ?>">
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_388" value="1" <?php
        if($check_res['initial_psychi_388']=="1"){
         echo "checked";
        }?>><b>None</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_389" value="2" <?php
        if($check_res['initial_psychi_389']=="2"){
         echo "checked";
        }?>><b>Heart Disease</b></div>
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_390" value="3" <?php
        if($check_res['initial_psychi_390']=="3"){
         echo "checked";
        }?>><b>Hypertension</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_391" value="4" <?php
        if($check_res['initial_psychi_391']=="4"){
         echo "checked";
        }?>><b>CVA</b></div>
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_392" value="5" <?php
        if($check_res['initial_psychi_392']=="5"){
         echo "checked";
        }?>><b>Lung Disease</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_393" value="6" <?php
        if($check_res['initial_psychi_393']=="6"){
         echo "checked";
        }?>><b>Asthma</b></div>
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_394" value="7" <?php
        if($check_res['initial_psychi_394']=="7"){
         echo "checked";
        }?>><b>DM</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_395" value="8" <?php
        if($check_res['initial_psychi_395']=="8"){
         echo "checked";
        }?>><b>Head Trauma</b></div>
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_396" value="9" <?php
        if($check_res['initial_psychi_396']=="9"){
         echo "checked";
        }?>><b>Cancer</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_397" value="10" <?php
        if($check_res['initial_psychi_397']=="10"){
         echo "checked";
        }?>><b>Eye problems</b></div>
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_398" value="11" <?php
        if($check_res['initial_psychi_398']=="11"){
         echo "checked";
        }?>><b>Seizure Disorder</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_399" value="12" <?php
        if($check_res['initial_psychi_399']=="12"){
         echo "checked";
        }?>><b>Liver</b></div>
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_400" value="13" <?php
        if($check_res['initial_psychi_400']=="13"){
         echo "checked";
        }?>><b>Kidney</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_401" value="14" <?php
        if($check_res['initial_psychi_401']=="14"){
         echo "checked";
        }?>><b>Thyroid</b></div>
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_402" value="15" <?php
        if($check_res['initial_psychi_402']=="15"){
         echo "checked";
        }?>><b>Congenital Abnormalities</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_403" value="16" <?php
        if($check_res['initial_psychi_403']=="16"){
         echo "checked";
        }?>><b>Learning difficulties</b></div>
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_404" value="17" <?php
        if($check_res['initial_psychi_404']=="17"){
         echo "checked";
        }?>><b>Psychiatric Disorders</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_405" value="18" <?php
        if($check_res['initial_psychi_405']=="18"){
         echo "checked";
        }?>><b>Suicide Not reported</b></div>
        </div>

        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_406" value="19" <?php
        if($check_res['initial_psychi_406']=="19"){
         echo "checked";
        }?>><b>Substance abuse</b></div>
        </div>
        <div class="col-6 boralign">
          <div><input type="checkbox" name="initial_psychi_407" value="20" <?php
        if($check_res['initial_psychi_407']=="20"){
         echo "checked";
        }?>><b>Others:</b></div>
          <div><input type="text" name="initial_psychi_408" value="<?php echo $check_res['initial_psychi_408']; ?>"></div>
        </div>

        <div class="col-4 boralign">
          <div><b>Gender</b></div>
          <div><input type="checkbox" name="initial_psychi_409" class="yes_no11" value="1" <?php
        if($check_res['initial_psychi_409']=="1"){
         echo "checked";
        }?>>Male &emsp;&emsp; <input type="checkbox" class="yes_no11" name="initial_psychi_410" value="2" <?php
        if($check_res['initial_psychi_410']=="2"){
         echo "checked";
        }?>>Female</div>
          <div><input type="checkbox" name="initial_psychi_411" class="yes_no11" value="3" <?php
        if($check_res['initial_psychi_411']=="3"){
         echo "checked";
        }?>>Transgender</div>
        </div>
        <div class="col-4 boralign">
          <div><b>Gender Expressions:</b></div>
          <div><input type="checkbox" name="initial_psychi_412" class="yes_no12" value="1" <?php
        if($check_res['initial_psychi_412']=="1"){
         echo "checked";
        }?>>Male</div>
          <div><input type="checkbox" name="initial_psychi_413" class="yes_no12" value="2" <?php
        if($check_res['initial_psychi_413']=="2"){
         echo "checked";
        }?>>Female</div>
          <div><input type="checkbox" name="initial_psychi_414" class="yes_no12" value="3" <?php
        if($check_res['initial_psychi_414']=="3"){
         echo "checked";
        }?>>Transgender</div>
        </div>
        <div class="col-4 boralign">
          <div><b>Sexual Orientation:</b></div>
          <div><input type="checkbox" name="initial_psychi_415" class="yes_no13" value="1" <?php
        if($check_res['initial_psychi_415']=="1"){
         echo "checked";
        }?>>Heterosexual</div>
          <div><input type="checkbox" name="initial_psychi_416" class="yes_no13" value="2" <?php
        if($check_res['initial_psychi_416']=="2"){
         echo "checked";
        }?>>Homosexual</div>
          <div><input type="checkbox" name="initial_psychi_417" class="yes_no13" value="3" <?php
        if($check_res['initial_psychi_417']=="3"){
         echo "checked";
        }?>>Pansexual <input type="checkbox" name="initial_psychi_418" class="yes_no13" value="4" <?php
        if($check_res['initial_psychi_418']=="4"){
         echo "checked";
        }?>>Asexual</div>
        </div>

        <div class="col-12 boralign">
          <div><b>Appearance:</b> <input type="checkbox" name="initial_psychi_419" value="1" <?php
        if($check_res['initial_psychi_419']=="1"){
         echo "checked";
        }?>>appropriate  <input type="checkbox" name="initial_psychi_420" value="2" <?php
        if($check_res['initial_psychi_420']=="2"){
         echo "checked";
        }?>>well kept <input type="checkbox" name="initial_psychi_421" value="3" <?php
        if($check_res['initial_psychi_421']=="3"){
         echo "checked";
        }?>>disheveled <input type="checkbox" name="initial_psychi_422" value="4" <?php
        if($check_res['initial_psychi_422']=="4"){
         echo "checked";
        }?>>bizarre</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_423" value="<?php echo $check_res['initial_psychi_423']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Musculoskeletal:</b> &emsp;&emsp;<b style="font-style:intalic;">Strength/ Tone</b> <input type="checkbox" name="initial_psychi_424" class="yes_no14" value="1" <?php
        if($check_res['initial_psychi_424']=="1"){
         echo "checked";
        }?>>normal<input type="checkbox" class="yes_no14" name="initial_psychi_425" value="2" <?php
        if($check_res['initial_psychi_425']=="2"){
         echo "checked";
        }?>>abnormal &emsp;&emsp;<b style="font-style:intalic;">Gait/Station</b> <input type="checkbox" class="yes_no15" name="initial_psychi_426" value="3" <?php
        if($check_res['initial_psychi_426']=="3"){
         echo "checked";
        }?>>normal<input type="checkbox" name="initial_psychi_427" class="yes_no15" value="4" <?php
        if($check_res['initial_psychi_427']=="4"){
         echo "checked";
        }?>>abnormal</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_428" value="<?php echo $check_res['initial_psychi_428']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Attitude:</b> &emsp;&emsp;&emsp;&emsp;cooperativeness&emsp;&emsp;&emsp;&emsp;relatedness&emsp;&emsp;&emsp;&emsp;good eye contact&emsp;&emsp;&emsp;&emsp;uncooperative</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_429" value="<?php echo $check_res['initial_psychi_429']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Motor:</b>  <input type="checkbox" name="initial_psychi_430" value="1" <?php
        if($check_res['initial_psychi_430']=="1"){
         echo "checked";
        }?>>normal <input type="checkbox" name="initial_psychi_431" value="2" <?php
        if($check_res['initial_psychi_431']=="2"){
         echo "checked";
        }?>> psychomotor agitation <input type="checkbox" name="initial_psychi_432" value="3" <?php
        if($check_res['initial_psychi_432']=="3"){
         echo "checked";
        }?>> psycho motor retardation  <input type="checkbox" name="initial_psychi_433" value="4" <?php
        if($check_res['initial_psychi_433']=="4"){
         echo "checked";
        }?>>EPS <input type="checkbox" name="initial_psychi_434" value="5" <?php
        if($check_res['initial_psychi_434']=="5"){
         echo "checked";
        }?>>tremor <input type="checkbox" name="initial_psychi_435" value="6" <?php
        if($check_res['initial_psychi_435']=="6"){
         echo "checked";
        }?>>AIMS:</div>
        </div>
        <div class="col-12 boralign">
          <div><b>Speech:</b>  <input type="checkbox" name="initial_psychi_436" value="1" <?php
        if($check_res['initial_psychi_436']=="1"){
         echo "checked";
        }?>>normal <input type="checkbox" name="initial_psychi_437" value="2" <?php
        if($check_res['initial_psychi_437']=="2"){
         echo "checked";
        }?>> hyperactive <input type="checkbox" name="initial_psychi_438" value="3" <?php
        if($check_res['initial_psychi_438']=="3"){
         echo "checked";
        }?>> retardation  <input type="checkbox" name="initial_psychi_439" value="4" <?php
        if($check_res['initial_psychi_439']=="4"){
         echo "checked";
        }?>>abnormal movements <input type="checkbox" name="initial_psychi_440" value="5" <?php
        if($check_res['initial_psychi_440']=="5"){
         echo "checked";
        }?>>slurred <input type="checkbox" name="initial_psychi_441" value="6" <?php
        if($check_res['initial_psychi_441']=="6"){
         echo "checked";
        }?>>Orobuccal Movement <input type="checkbox" name="initial_psychi_442" value="7" <?php
        if($check_res['initial_psychi_442']=="7"){
         echo "checked";
        }?>>Pressured <input type="checkbox" name="initial_psychi_443" value="8" <?php
        if($check_res['initial_psychi_443']=="8"){
         echo "checked";
        }?>>Loud <input type="checkbox" name="initial_psychi_444" value="9" <?php
        if($check_res['initial_psychi_444']=="9"){
         echo "checked";
        }?>>Monotonous <input type="checkbox" name="initial_psychi_445" value="10" <?php
        if($check_res['initial_psychi_445']=="10"){
         echo "checked";
        }?>>Tremulous</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_446" value="<?php echo $check_res['initial_psychi_446']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Mood:</b>  <input type="checkbox" name="initial_psychi_447" value="1" <?php
        if($check_res['initial_psychi_447']=="1"){
         echo "checked";
        }?>>euthymic <input type="checkbox" name="initial_psychi_448" value="2" <?php
        if($check_res['initial_psychi_448']=="2"){
         echo "checked";
        }?>> depressed <input type="checkbox" name="initial_psychi_449" value="3" <?php
        if($check_res['initial_psychi_449']=="3"){
         echo "checked";
        }?>> hypomanic  <input type="checkbox" name="initial_psychi_450" value="4" <?php
        if($check_res['initial_psychi_450']=="4"){
         echo "checked";
        }?>>euphoric <input type="checkbox" name="initial_psychi_451" value="5" <?php
        if($check_res['initial_psychi_451']=="5"){
         echo "checked";
        }?>>angry <input type="checkbox" name="initial_psychi_452" value="6" <?php
        if($check_res['initial_psychi_452']=="6"){
         echo "checked";
        }?>>anxious <input type="checkbox" name="initial_psychi_453" value="7" <?php
        if($check_res['initial_psychi_453']=="7"){
         echo "checked";
        }?>>labile</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_454" value="<?php echo $check_res['initial_psychi_454']; ?>"></div>
        </div>

        <div class="col-12 boralign">
          <div><b>Affect: Appropriateness:</b>  <input type="checkbox" class="yes_no16" name="initial_psychi_455" value="1" <?php
        if($check_res['initial_psychi_455']=="1"){
         echo "checked";
        }?>>Appropriate <input type="checkbox" name="initial_psychi_456" class="yes_no16" value="2" <?php
        if($check_res['initial_psychi_456']=="2"){
         echo "checked";
        }?>> Inappropriate <input type="checkbox" name="initial_psychi_457" class="yes_no16" value="3" <?php
        if($check_res['initial_psychi_457']=="3"){
         echo "checked";
        }?>> Incongruous </div>

          <div><b>Range:</b>  <input type="checkbox" name="initial_psychi_458" class="yes_no17" value="1" <?php
        if($check_res['initial_psychi_458']=="1"){
         echo "checked";
        }?>>Blunted <input type="checkbox" name="initial_psychi_459" class="yes_no17" value="2" <?php
        if($check_res['initial_psychi_459']=="2"){
         echo "checked";
        }?>> Restricted <input type="checkbox" name="initial_psychi_460" class="yes_no17" value="3" <?php
        if($check_res['initial_psychi_460']=="3"){
         echo "checked";
        }?>> Flat  <input type="checkbox" name="initial_psychi_461" class="yes_no17" value="4" <?php
        if($check_res['initial_psychi_461']=="4"){
         echo "checked";
        }?>>Expansive </div>

          <div><b>Stability:</b>  <input type="checkbox" name="initial_psychi_462" class="yes_no18" value="1" <?php
        if($check_res['initial_psychi_462']=="1"){
         echo "checked";
        }?>>Stable <input type="checkbox" name="initial_psychi_463" class="yes_no18" value="2" <?php
        if($check_res['initial_psychi_463']=="2"){
         echo "checked";
        }?>> Labile</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_464" value="<?php echo $check_res['initial_psychi_464']; ?>"></div>
        </div>

        <div class="col-12 boralign">
          <div><b>Thought Process:</b>  <input type="checkbox" name="initial_psychi_465" value="1" <?php
        if($check_res['initial_psychi_465']=="1"){
         echo "checked";
        }?>>coherent <input type="checkbox" name="initial_psychi_466" value="2" <?php
        if($check_res['initial_psychi_466']=="2"){
         echo "checked";
        }?>> soft <input type="checkbox" name="initial_psychi_467" value="3" <?php
        if($check_res['initial_psychi_467']=="3"){
         echo "checked";
        }?>> loose associations <input type="checkbox" name="initial_psychi_468" value="4" <?php
        if($check_res['initial_psychi_468']=="4"){
         echo "checked";
        }?>> flight of ideas<input type="checkbox" name="initial_psychi_469" value="5" <?php
        if($check_res['initial_psychi_469']=="5"){
         echo "checked";
        }?>> slurred<input type="checkbox" name="initial_psychi_470" value="6" <?php
        if($check_res['initial_psychi_470']=="6"){
         echo "checked";
        }?>> Tangential thinking<input type="checkbox" name="initial_psychi_471" value="7" <?php
        if($check_res['initial_psychi_471']=="7"){
         echo "checked";
        }?>> Nonsense words/word salad<input type="checkbox" name="initial_psychi_472" value="8" <?php
        if($check_res['initial_psychi_472']=="8"){
         echo "checked";
        }?>> Thought Blocking<input type="checkbox" name="initial_psychi_473" value="9" <?php
        if($check_res['initial_psychi_473']=="9"){
         echo "checked";
        }?>> Thought Racing</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_474" value="<?php echo $check_res['initial_psychi_474']; ?>"></div>
        </div>

        <div class="col-12 boralign">
          <div><b>Thought Associations:</b>  <input type="checkbox" name="initial_psychi_475" value="1" <?php
        if($check_res['initial_psychi_475']=="1"){
         echo "checked";
        }?>>intact <input type="checkbox" name="initial_psychi_476" value="2" <?php
        if($check_res['initial_psychi_476']=="2"){
         echo "checked";
        }?>> circumstantial <input type="checkbox" name="initial_psychi_478" value="3" <?php
        if($check_res['initial_psychi_478']=="3"){
         echo "checked";
        }?>> tangential <input type="checkbox" name="initial_psychi_479" value="4" <?php
        if($check_res['initial_psychi_479']=="4"){
         echo "checked";
        }?>> loose</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_480" value="<?php echo $check_res['initial_psychi_480']; ?>"></div>
        </div>

        <div class="col-12 boralign">
          <div><b>Thought Content:</b>  <input type="checkbox" name="initial_psychi_481" value="1" <?php
        if($check_res['initial_psychi_481']=="1"){
         echo "checked";
        }?>>None <input type="checkbox" name="initial_psychi_482" value="2" <?php
        if($check_res['initial_psychi_482']=="2"){
         echo "checked";
        }?>> Delusions <input type="checkbox" name="initial_psychi_483" value="3" <?php
        if($check_res['initial_psychi_483']=="3"){
         echo "checked";
        }?>> Overvalued ideas <input type="checkbox" name="initial_psychi_484" value="4" <?php
        if($check_res['initial_psychi_484']=="4"){
         echo "checked";
        }?>> preoccupations <input type="checkbox" name="initial_psychi_485" value="5" <?php
        if($check_res['initial_psychi_485']=="5"){
         echo "checked";
        }?>> Depressive Thoughts<input type="checkbox" name="initial_psychi_486" value="6" <?php
        if($check_res['initial_psychi_486']=="6"){
         echo "checked";
        }?>> Self-harm<input type="checkbox" name="initial_psychi_487" value="7" <?php
        if($check_res['initial_psychi_487']=="7"){
         echo "checked";
        }?>> Suicidal Ideations<input type="checkbox" name="initial_psychi_488" value="8" <?php
        if($check_res['initial_psychi_488']=="8"){
         echo "checked";
        }?>> TAggressive or Homicidal Ideations</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_489" value="<?php echo $check_res['initial_psychi_489']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Perception: Dissociative symptoms:</b>  <input type="checkbox" name="initial_psychi_490" value="1" <?php
        if($check_res['initial_psychi_490']=="1"){
         echo "checked";
        }?>>Derealization <input type="checkbox" name="initial_psychi_491" value="2" <?php
        if($check_res['initial_psychi_491']=="2"){
         echo "checked";
        }?>> Depersonalization </div>
          <div><input type="checkbox" name="initial_psychi_492" value="3" <?php
        if($check_res['initial_psychi_492']=="3"){
         echo "checked";
        }?>><b>Illusions</b>  </div>
          <div><b>Hallucinations:</b> <input type="checkbox" name="initial_psychi_493" value="4" <?php
        if($check_res['initial_psychi_493']=="4"){
         echo "checked";
        }?>> Visual <input type="checkbox" name="initial_psychi_494" value="5" <?php
        if($check_res['initial_psychi_494']=="5"){
         echo "checked";
        }?>> Tactile <input type="checkbox" name="initial_psychi_495" value="6" <?php
        if($check_res['initial_psychi_495']=="6"){
         echo "checked";
        }?>> Auditory <input type="checkbox" name="initial_psychi_496" value="7" <?php
        if($check_res['initial_psychi_496']=="7"){
         echo "checked";
        }?>>Command </div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_497" value="<?php echo $check_res['initial_psychi_497']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Memory: Recent</b>  <input type="checkbox" name="initial_psychi_498" class="yes_no19" value="1" <?php
        if($check_res['initial_psychi_498']=="1"){
         echo "checked";
        }?>> intact <input type="checkbox" name="initial_psychi_499" class="yes_no19" value="2" <?php
        if($check_res['initial_psychi_499']=="2"){
         echo "checked";
        }?>>  impaired <input type="checkbox" name="initial_psychi_500" class="yes_no19" value="3" <?php
        if($check_res['initial_psychi_500']=="3"){
         echo "checked";
        }?>> digits forward &emsp;<b>Remote</b> <input type="checkbox"  class="yes_no20" name="initial_psychi_501" value="4" <?php
        if($check_res['initial_psychi_501']=="4"){
         echo "checked";
        }?>> intact <input type="checkbox" name="initial_psychi_502" class="yes_no20" value="5" <?php
        if($check_res['initial_psychi_502']=="5"){
         echo "checked";
        }?>> impaired</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_503" value="<?php echo $check_res['initial_psychi_503']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Judgment</b>  <input type="checkbox" name="initial_psychi_504" class="yes_no21" value="1" <?php
        if($check_res['initial_psychi_504']=="1"){
         echo "checked";
        }?>> poor <input type="checkbox" name="initial_psychi_505" class="yes_no21" value="2" <?php
        if($check_res['initial_psychi_505']=="2"){
         echo "checked";
        }?>>  fair <input type="checkbox" name="initial_psychi_506" class="yes_no21" value="3" <?php
        if($check_res['initial_psychi_506']=="3"){
         echo "checked";
        }?>> good &emsp;<b>Insight</b> <input type="checkbox" name="initial_psychi_507" class="yes_no22" value="4" <?php
        if($check_res['initial_psychi_507']=="4"){
         echo "checked";
        }?>> minimal <input type="checkbox" name="initial_psychi_508" class="yes_no22" value="5" <?php
        if($check_res['initial_psychi_508']=="5"){
         echo "checked";
        }?>> moderate <input type="checkbox" name="initial_psychi_509" class="yes_no22" value="6" <?php
        if($check_res['initial_psychi_509']=="6"){
         echo "checked";
        }?>> good</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_510" value="<?php echo $check_res['initial_psychi_510']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Orientation</b>  <input type="checkbox" name="initial_psychi_511" class="yes_no23" value="1" <?php
        if($check_res['initial_psychi_511']=="1"){
         echo "checked";
        }?>> time <input type="checkbox" name="initial_psychi_512" class="yes_no23" value="2" <?php
        if($check_res['initial_psychi_512']=="2"){
         echo "checked";
        }?>> person <input type="checkbox" name="initial_psychi_513" class="yes_no23" value="3" <?php
        if($check_res['initial_psychi_513']=="3"){
         echo "checked";
        }?>> place &emsp;<b>Attention Span/ Concentration</b> <input type="checkbox" class="yes_no24" name="initial_psychi_514" value="4" <?php
        if($check_res['initial_psychi_514']=="4"){
         echo "checked";
        }?>> intact <input type="checkbox" name="initial_psychi_515" class="yes_no24" value="5" <?php
        if($check_res['initial_psychi_515']=="5"){
         echo "checked";
        }?>> impaired </div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_516" value="<?php echo $check_res['initial_psychi_516']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Language Name Objects</b>  <input type="checkbox" class="yes_no25" name="initial_psychi_517" value="1" <?php
        if($check_res['initial_psychi_517']=="1"){
         echo "checked";
        }?>> intact <input type="checkbox" name="initial_psychi_518" class="yes_no25" value="2" <?php
        if($check_res['initial_psychi_518']=="2"){
         echo "checked";
        }?>> impaired <input type="checkbox" name="initial_psychi_519" class="yes_no25" value="3" <?php
        if($check_res['initial_psychi_519']=="3"){
         echo "checked";
        }?>> place &emsp;<b>Repeat phrases</b><input type="checkbox" class="yes_no26" name="initial_psychi_520" value="4" <?php
        if($check_res['initial_psychi_520']=="4"){
         echo "checked";
        }?>> intact <input type="checkbox" name="initial_psychi_521" class="yes_no26" value="5" <?php
        if($check_res['initial_psychi_521']=="5"){
         echo "checked";
        }?>> impaired </div>
        </div>
        <div class="col-12 boralign">
          <div><b>Knowledge Current Events</b>  <input type="checkbox" class="yes_no27" name="initial_psychi_522" value="1" <?php
        if($check_res['initial_psychi_522']=="1"){
         echo "checked";
        }?>> intact <input type="checkbox" name="initial_psychi_523" class="yes_no27" value="2" <?php
        if($check_res['initial_psychi_523']=="2"){
         echo "checked";
        }?>> impaired <input type="checkbox" name="initial_psychi_524" class="yes_no27" value="3" <?php
        if($check_res['initial_psychi_524']=="3"){
         echo "checked";
        }?>> place &emsp;<b>Past History</b><input type="checkbox" class="yes_no28" name="initial_psychi_525" value="4" <?php
        if($check_res['initial_psychi_525']=="4"){
         echo "checked";
        }?>> intact <input type="checkbox" name="initial_psychi_526" class="yes_no28" value="5" <?php
        if($check_res['initial_psychi_526']=="5"){
         echo "checked";
        }?>> impaired </div>
        </div>
        <div class="col-12 boralign">
          <div><b>Intelligence</b>  <input type="checkbox" name="initial_psychi_527" class="yes_no29" value="1" <?php
        if($check_res['initial_psychi_527']=="1"){
         echo "checked";
        }?>> appears normal <input type="checkbox" name="initial_psychi_528" class="yes_no29" value="2" <?php
        if($check_res['initial_psychi_528']=="2"){
         echo "checked";
        }?>> age appropriate <input type="checkbox" name="initial_psychi_529" class="yes_no29" value="3" <?php
        if($check_res['initial_psychi_529']=="3"){
         echo "checked";
        }?>> age inappropriate</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_530" value="<?php echo $check_res['initial_psychi_530']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Insight:</b>  <input type="checkbox" name="initial_psychi_531" class="yes_no30" value="1" <?php
        if($check_res['initial_psychi_531']=="1"){
         echo "checked";
        }?>> poor <input type="checkbox" name="initial_psychi_532" class="yes_no30" value="2" <?php
        if($check_res['initial_psychi_532']=="2"){
         echo "checked";
        }?>> Fair <input type="checkbox" name="initial_psychi_533" class="yes_no30" value="3" <?php
        if($check_res['initial_psychi_533']=="3"){
         echo "checked";
        }?>> moderate <input type="checkbox" name="initial_psychi_534" class="yes_no30" value="4" <?php
        if($check_res['initial_psychi_534']=="4"){
         echo "checked";
        }?>> good</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_535" value="<?php echo $check_res['initial_psychi_535']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Self-Esteem:</b>  <input type="checkbox" name="initial_psychi_536" class="yes_no31" value="1" <?php
        if($check_res['initial_psychi_536']=="1"){
         echo "checked";
        }?>> poor <input type="checkbox" name="initial_psychi_537" class="yes_no31" value="2" <?php
        if($check_res['initial_psychi_537']=="2"){
         echo "checked";
        }?>> Fair <input type="checkbox" name="initial_psychi_538" class="yes_no31" value="3" <?php
        if($check_res['initial_psychi_538']=="3"){
         echo "checked";
        }?>> moderate <input type="checkbox" name="initial_psychi_539" class="yes_no31" value="4" <?php
        if($check_res['initial_psychi_539']=="4"){
         echo "checked";
        }?>> good</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_540" value="<?php echo $check_res['initial_psychi_540']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Impulse Control:</b>  <input type="checkbox" name="initial_psychi_541" class="yes_no32" value="1" <?php
        if($check_res['initial_psychi_541']=="1"){
         echo "checked";
        }?>> poor <input type="checkbox" name="initial_psychi_542" class="yes_no32" value="2" <?php
        if($check_res['initial_psychi_542']=="2"){
         echo "checked";
        }?>> Fair <input type="checkbox" name="initial_psychi_543" class="yes_no32" value="3" <?php
        if($check_res['initial_psychi_543']=="3"){
         echo "checked";
        }?>> moderate <input type="checkbox" name="initial_psychi_544" class="yes_no32" value="4" <?php
        if($check_res['initial_psychi_544']=="4"){
         echo "checked";
        }?>> good</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_545" value="<?php echo $check_res['initial_psychi_545']; ?>"></div>
        </div>
        <div class="col-12 boralign">
          <div><b>Motivation/ Involvement:</b>  <input type="checkbox" name="initial_psychi_546" class="yes_no33" value="1" <?php
        if($check_res['initial_psychi_546']=="1"){
         echo "checked";
        }?>> poor <input type="checkbox" name="initial_psychi_547" class="yes_no33" value="2" <?php
        if($check_res['initial_psychi_547']=="2"){
         echo "checked";
        }?>> Fair <input type="checkbox" name="initial_psychi_548" class="yes_no33" value="3" <?php
        if($check_res['initial_psychi_548']=="3"){
         echo "checked";
        }?>> moderate <input type="checkbox" name="initial_psychi_549" class="yes_no33" value="4" <?php
        if($check_res['initial_psychi_549']=="4"){
         echo "checked";
        }?>> good</div>
          <div><b>Describe:</b> <input type="text" name="initial_psychi_550" value="<?php echo $check_res['initial_psychi_550']; ?>"></div>
        </div>

        <div class="col-12 boralign">
          <div><input type="text" name="initial_psychi_551" value="<?php echo $check_res['initial_psychi_551']; ?>"><b>Use Disorder, moderate, in post-acute withdrawal</b></div>
        </div>

        <div class="col-12 boralign">
          <div><b>{Mental Health} Disorder(s)</b></div>
        </div>

        <div class="col-12 boralign">
          <div> {Biomedical Condition(s)}</div>
        </div>

        <div class="col-12 boralign">
        <div contentEditable="true" class="text_edit"> <?php echo $check_res['text5']??"
          <p>Starting {Level of Care} with:</p>
          <p>Clonidine B</p>
          <p>All PRN’s medications.</p>
          
            <p>Patient refused history and physical. Requested primary care for H&amp;P/Labs. Discussed with the patient the
            dose, schedule, risk, and benefits of taking and not taking Clonidine B and all PRN’s. I have also discussed
            the potential interactions of the medication prescribed if combined with alcohol or non-prescription drugs,
            the potential heart related problems, the possibility of agitation, the possibility of falling, the possibility of
            suicidal thoughts and the risks related to pregnancy. The patient understood the discussion and consented
            to the treatment. A Medication Education Sheet was provided. A “No Loss” policy was discussed as was
            the need to choose one pharmacy for all meds. The Patient consented to a random “pill counts and
            toxicology screens.”
            </p>
            <p>
            Patient was educated regarding the risks versus benefits of {Level of Care}. Patient was also counseled on
            physiological symptoms of acute intoxication, withdrawal potential, biomedical conditions and
            complications, and emotional/behavioral/cognitive conditions. Psychosocial treatment components were
            elaborated on such as acceptance and resistance, relapse potential, recovery, environment and
            family/caregiver functioning that is offered during psychoeducational groups in CNT’S {Level of Care}
            program. Patient was advised to contact our nursing director after hours for all inquiries and concerns via
            the Center for Network Therapy answering service. While in {Level of Care}, any after hour emergency that
            are of an acute nature should be addressed by calling 911 or by going to your local emergency room.
            Patients are made aware that {Level of Care} level of care is an alternative to inpatient residential care. If
            the patient’s psychological/medical function reportedly has diminished, they will be referred to a higher
            level of care, which is residential inpatient.
            </p>"?></div><input type="hidden" name="text5" id="text5">          
        </div>

        <div class="col-12 boralign">
          <b>Signed Suboxone Tool Kit?</b> <input type="checkbox" class="yes_no8" name="initial_psychi_552" value="1" <?php
          if($check_res['initial_psychi_552']=="1"){
          echo "checked";
          }?>> N/A <input type="checkbox" name="initial_psychi_553" class="yes_no8" value="2" <?php
          if($check_res['initial_psychi_553']=="2"){
          echo "checked";
          }?>> yes <input type="checkbox" name="initial_psychi_554" class="yes_no8" value="3" <?php
          if($check_res['initial_psychi_554']=="3"){
          echo "checked";
          }?>> No &emsp;&emsp; If no, why? <input type="text" name="no_explain" value="<?php echo $check_res['no_explain']??''; ?>">
        </div>


        <div class="col-6 center">
          <td>
            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
            <i class="fas fa-search view_icon" id="initial_psychi555" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="initial_psychi_555" id="initial_psychi_555" value="<?php echo $check_res['initial_psychi_555']; ?>" class="ml-2" />
          </td>
          <div>M.D. Signature/ Degree</div>
        </div>

        <div class="col-6 center">
          <div><input type="date" name="initial_psychi_556" value="<?php echo $check_res['initial_psychi_556']; ?>"></div>
          <div>Date/Time</div>
        </div>

        <div class="col-6 center">
          <td>
            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
            <i class="fas fa-search view_icon" id="initial_psychi557" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="initial_psychi_557" id="initial_psychi_557" value="<?php echo $check_res['initial_psychi_557']; ?>" class="ml-2" />
          </td>
          <div>
            <div contentEditable="true" class="text_edit">
               <?php echo $check_res['text6']??"Daniel O’Connell, MSW, LSW, LCADC Intern"?>
              </div>
              <input type="hidden" name="text6" id="text6"> </div>
        </div>
        <div class="col-6 center">
          <div><input type="date" name="initial_psychi_558" value="<?php echo $check_res['initial_psychi_558']; ?>"></div>
          <div>Date/Time</div>
        </div>

        <br><br>
        <div class="btndiv">
          <input type="submit" value="Submit" class="subbtn btn-save">
          <button class="cancel" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
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

</form>

</div>
</div>
</div>
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

  $('.yes_no').on('change', function() {
  $('.yes_no').not(this).prop('checked', false)
  });
  $('.yes_no1').on('change', function() {
  $('.yes_no1').not(this).prop('checked', false)
  });
  $('.yes_no2').on('change', function() {
  $('.yes_no2').not(this).prop('checked', false)
  });
  $('.yes_no3').on('change', function() {
  $('.yes_no3').not(this).prop('checked', false)
  });
  $('.yes_no4').on('change', function() {
  $('.yes_no4').not(this).prop('checked', false)
  });
  $('.yes_no5').on('change', function() {
  $('.yes_no5').not(this).prop('checked', false)
  });
  $('.yes_no6').on('change', function() {
  $('.yes_no6').not(this).prop('checked', false)
  });
  $('.yes_no7').on('change', function() {
  $('.yes_no7').not(this).prop('checked', false)
  });
  $('.yes_no8').on('change', function() {
  $('.yes_no8').not(this).prop('checked', false)
  });
  $('.yes_no9').on('change', function() {
  $('.yes_no9').not(this).prop('checked', false)
  });
  $('.yes_no10').on('change', function() {
  $('.yes_no10').not(this).prop('checked', false)
  });
  $('.yes_no11').on('change', function() {
  $('.yes_no11').not(this).prop('checked', false)
  });
  $('.yes_no12').on('change', function() {
  $('.yes_no12').not(this).prop('checked', false)
  });
  $('.yes_no13').on('change', function() {
  $('.yes_no13').not(this).prop('checked', false)
  });
  $('.yes_no14').on('change', function() {
  $('.yes_no14').not(this).prop('checked', false)
  });
  $('.yes_no15').on('change', function() {
  $('.yes_no15').not(this).prop('checked', false)
  });
  $('.yes_no16').on('change', function() {
  $('.yes_no16').not(this).prop('checked', false)
  });
  $('.yes_no17').on('change', function() {
  $('.yes_no17').not(this).prop('checked', false)
  });
  $('.yes_no18').on('change', function() {
  $('.yes_no18').not(this).prop('checked', false)
  });
  $('.yes_no19').on('change', function() {
  $('.yes_no19').not(this).prop('checked', false)
  });
  $('.yes_no20').on('change', function() {
  $('.yes_no20').not(this).prop('checked', false)
  });
  $('.yes_no21').on('change', function() {
  $('.yes_no21').not(this).prop('checked', false)
  });
  $('.yes_no22').on('change', function() {
  $('.yes_no22').not(this).prop('checked', false)
  });
  $('.yes_no23').on('change', function() {
  $('.yes_no23').not(this).prop('checked', false)
  });
  $('.yes_no24').on('change', function() {
  $('.yes_no24').not(this).prop('checked', false)
  });
  $('.yes_no25').on('change', function() {
  $('.yes_no25').not(this).prop('checked', false)
  });
  $('.yes_no26').on('change', function() {
  $('.yes_no26').not(this).prop('checked', false)
  });
  $('.yes_no27').on('change', function() {
  $('.yes_no27').not(this).prop('checked', false)
  });
  $('.yes_no28').on('change', function() {
  $('.yes_no28').not(this).prop('checked', false)
  });
  $('.yes_no29').on('change', function() {
  $('.yes_no29').not(this).prop('checked', false)
  });
  $('.yes_no30').on('change', function() {
  $('.yes_no30').not(this).prop('checked', false)
  });
  $('.yes_no31').on('change', function() {
  $('.yes_no31').not(this).prop('checked', false)
  });
  $('.yes_no32').on('change', function() {
  $('.yes_no32').not(this).prop('checked', false)
  });
  $('.yes_no33').on('change', function() {
  $('.yes_no33').not(this).prop('checked', false)
  });
  $('.btn-save') .on('click',function(){
    $('.text_edit').each(function(){
        //alert();
        var dataval = $(this).html();
        $(this).next("input").val(dataval);
      // alert( $(this).next("input").val());
        
    });
  });
</script>

</html>
