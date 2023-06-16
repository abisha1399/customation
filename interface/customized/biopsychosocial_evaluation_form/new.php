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
    $sql = "SELECT * FROM `form_biopsychosocial_evaluation` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Biopsychosocial"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    
    <style type="text/css">
      td{
        font-size: 15px;
      }
      #id1{
        margin-left: 56px;
      }
      input {
        border: 0;
        outline: 0;
        border-bottom: 1px solid black;
      }
      .h3_1{
        text-align:center;
        font-size: 20px;
      }
      .tabel5 td p{
        margin-left: 10px;
      }
      b{
        margin-left: 10px;
      }
      input[type="checkbox"] {
          margin-right: 5px;
      }
      .btndiv
      {
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
      .asinput{
        width:60%;
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
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/biopsychosocial_evaluation_form/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%; text-align:center;">Biopsychosocial Evaluation</h4></td>
         </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Client Name: <input type="text" name="cname" value="<?php echo $check_res['cname'];?>"></td>
            <td style="width:50%;">Date of Evaluation: <input type="date" name="date_eval" value="<?php echo $check_res['date_eval'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:10%;">Age: <input type="text"  style="width: 30%;" name="age" value="<?php echo $check_res['age'];?>"></td>
            <td style="width:20%;">Sex: <input type="checkbox" class="yes_no" name="male" value="male" <?php
                if($check_res['male']=="male"){
                 echo "checked";
                }
              ?>>Male<input type="checkbox" name="female" class="yes_no" value="female" <?php
              if($check_res['female']=="female"){
               echo "checked";
              }
            ?>>Female</td>
            <td style="width:10%;">Height: <input type="text" style="width: 30%;" name="height" value="<?php echo $check_res['height'];?>"></td>
            <td style="width:10%;">Weight: <input type="text" style="width: 30%;" name="weight" value="<?php echo $check_res['weight'];?>"></td>
            <td style="width:10%;">Race: <input type="text" style="width: 30%;" name="race" value="<?php echo $check_res['race'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:20%;">Hispanic: <input type="checkbox" class="yes_no" name="hispanic1" value="yes" <?php
                if($check_res['hispanic1']=="yes"){
                 echo "checked";
                }
              ?>>Yes<input type="checkbox" name="hispanic2" class="yes_no" value="no" <?php
              if($check_res['hispanic2']=="no"){
               echo "checked";
              }
            ?>>No</td>
            <td style="width:80%;">If yes, specify: <input type="text" style="width: 80%;" name="specify1" value="<?php echo $check_res['date_eval'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Address: <input type="text" style="width: 60%;" name="address" value="<?php echo $check_res['address'];?>"></td>
            <td style="width:25%;">Zip Code: <input type="text" name="zipcode" value="<?php echo $check_res['zipcode'];?>"></td>
            <td style="width:25%;">County: <input type="text" name="country" value="<?php echo $check_res['country'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:100%;">Client Phone Number: <input type="text" style="width: 30%;" name="phone_num" value="<?php echo $check_res['phone_num'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Collateral Contact: <input type="text" name="collateral_contact" value="<?php echo $check_res['collateral_contact'];?>"></td>
            <td style="width:50%;">Relationship: <input type="text" name="relationship1" value="<?php echo $check_res['relationship1'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Emergency contact 01: <input type="text" name="emergency_contact1" value="<?php echo $check_res['emergency_contact1'];?>"></td>
            <td style="width:50%;">Relationship: <input type="text" name="relationship2" value="<?php echo $check_res['relationship2'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Emergency contact 02: <input type="text" name="emergency_contact2" value="<?php echo $check_res['emergency_contact2'];?>"></td>
            <td style="width:50%;">Relationship: <input type="text" name="relationship3" value="<?php echo $check_res['relationship3'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:20%;">Same Address: <input type="checkbox" class="yes_no" name="same_address1" value="yes" <?php
                if($check_res['same_address1']=="yes"){
                 echo "checked";
                }
              ?>>Yes<input type="checkbox" name="same_address2" class="yes_no" value="no" <?php
              if($check_res['same_address2']=="no"){
               echo "checked";
              }
            ?>>No</td>
            <td style="width:40%;">If yes, address: <input type="text" style="width: 50%;" name="address1" value="<?php echo $check_res['address1'];?>"></td>
            <td style="width:40%;">Country: <input type="text" style="width: 40%;" name="country1" value="<?php echo $check_res['country1'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Living Arrangements: <input type="text" style="width: 60%;" name="living_arrangements" value="<?php echo $check_res['living_arrangements'];?>"></td>
            <td style="width:25%;">How Long: <input type="text" name="how_long1" value="<?php echo $check_res['how_long1'];?>"></td>
            <td style="width:25%;">Referral: <input type="text" name="referral" value="<?php echo $check_res['referral'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:20%;">SSN: <input type="text" style="width: 60%;" name="ssn" value=""></td>
            <td style="width:20%;">Marital Status: <input type="text" style="width: 50%;" name="marital_status" value="<?php echo $check_res['marital_status'];?>"></td>
            <td style="width:20%;">How Long: <input type="text" style="width: 50%;" name="how_long2" value="<?php echo $check_res['how_long2'];?>"></td>
            <td style="width:40%;">Are you satisfied? <input type="checkbox" class="yes_no" name="satisfied1" value="yes" <?php
                if($check_res['satisfied1']=="yes"){
                 echo "checked";
                }
              ?>>Yes<input type="checkbox" name="satisfied2" value="no" class="yes_no" <?php
              if($check_res['satisfied2']=="no"){
               echo "checked";
              }
            ?>>No<input type="checkbox" name="satisfied3" value="indifferent" class="yes_no" <?php
            if($check_res['satisfied3']=="indifferent"){
             echo "checked";
            }
          ?>>Indifferent</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:40%;">Occupation: <input type="text" style="width: 60%;" name="occupation" value="<?php echo $check_res['occupation'];?>"></td>
            <td style="width:20%;">How Long: <input style="width: 50%;" type="text" name="how_long3" value="<?php echo $check_res['how_long3'];?>"></td>
            <td style="width:40%;">Are you satisfied? <input  type="checkbox" name="satisfied4" value="yes" class="yes_no" <?php
                if($check_res['satisfied4']=="yes"){
                 echo "checked";
                }
              ?>>Yes<input type="checkbox" name="satisfied5" value="no" class="yes_no" <?php
              if($check_res['satisfied5']=="no"){
               echo "checked";
              }
            ?>>No<input type="checkbox" name="satisfied6" value="indifferent" class="yes_no" <?php
            if($check_res['satisfied6']=="indifferent"){
             echo "checked";
            }
          ?>>Indifferent</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:100%;">Monthly Income: <input type="text" style="width: 30%;" name="monthly_income" value="<?php echo $check_res['monthly_income'];?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Are you a Veteran? <input  type="checkbox" class="yes_no" name="veteran1" value="yes" <?php
                if($check_res['veteran1']=="yes"){
                 echo "checked";
                }
              ?>>Yes<input type="checkbox" name="veteran2" class="yes_no" value="no" <?php
                if($check_res['veteran2']=="no"){
                 echo "checked";
                }
              ?>>No</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:60%;">Occupation: <input  type="text" style="width: 60%;" name="occupation1" value="<?php echo $check_res['occupation1'];?>"></td>
            <td style="width:40%;">car available? <input class="yes_no" type="checkbox" name="car_avai1" value="yes" <?php
                if($check_res['car_avai1']=="yes"){
                 echo "checked";
                }
              ?>>Yes<input type="checkbox" class="yes_no" name="car_avai2" value="no" <?php
              if($check_res['car_avai2']=="no"){
               echo "checked";
              }
            ?>>No</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Do you have any spiritual beliefs? (Religion, prayer, belief in God(s)/Higher Power, sources of comfort)<input type="text" style="width: 30%;" name="spiritual_beliefs" value="<?php echo $check_res['spiritual_beliefs'];?>"></td>
          </tr>
        </table>
        <br>
        <br>
        <p style="text-decoration: underline;">PRESENTING ISSUES</p>
        <br>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Substance Abuse:<input type="text" style="width: 20%;" name="substance_abuse" value="<?php echo $check_res['substance_abuse']; ?>"></td>
          </tr>
          <tr>
          <td style="width:40%;">Mental Health:<input type="text" style="width: 20%;" name="mental_health" value="<?php echo $check_res['mental_health']; ?>"></td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
          <td style="width:40%;">Reason for seeking treatment at this point:<input type="text" style="width: 20%;" name="treatment_point" value="<?php echo $check_res['treatment_point']; ?>"></td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Are you seeking treatment because of pressure from: <input  type="checkbox" name="family" value="family" <?php
              if($check_res['family']=="family"){
               echo "checked";
              }
            ?>> Family <input type="checkbox" name="work" value="work" <?php
            if($check_res['work']=="work"){
             echo "checked";
            }
          ?>> Work <input type="checkbox" name="legal" value="legal" <?php
          if($check_res['legal']=="legal"){
           echo "checked";
          }
        ?>> Legal <input type="checkbox" name="self" value="self" <?php
        if($check_res['self']=="self"){
         echo "checked";
        }
      ?>> Self</td>
          </tr>
        </table>
        <br>
        <p ><span style="text-decoration: underline;">PRESENTING ISSUES</span> (Presenting issues)</p>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Do you have any chronic medical issues that interfere with your life? <input  type="checkbox" name="chronic_medical_issues" class="yes_no" value="yes" <?php
        if($check_res['chronic_medical_issues']=="yes"){
         echo "checked";
        }
      ?>> Yes <input type="checkbox" name="chronic_medical_issues1" class="yes_no" value="no" <?php
      if($check_res['chronic_medical_issues1']=="no"){
       echo "checked";
      }
    ?>> No</td>
          </tr>
        </table>
        <br>
        <table  style="width:100%;">
          <tr>
            <td style="width: 40%;">Allergies: (Medication/Food)</td>
            <td style="width: 60%;"><input type="checkbox" name="nkda" value="NKDA" <?php
        if($check_res['nkda']=="NKDA"){
         echo "checked";
        }
      ?>>NKDA</td>
          </tr>
        </table>

        <table style="width:100%;">
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="none" value="None" <?php
        if($check_res['none']=="None"){
         echo "checked";
        }
      ?>>None</td>
            <td style="width: 20%;"><input type="checkbox" name="heart_disease" value="Heart Disease"
            <?php
        if($check_res['heart_disease']=="Heart Disease"){
         echo "checked";
        }
      ?>>Heart Disease</td>
            <td style="width: 20%;"><input type="checkbox" name="liver_problems" value="Liver problems"
            <?php
        if($check_res['liver_problems']=="Liver problems"){
         echo "checked";
        }
      ?>>Liver problems</td>
            <td style="width: 20%;"><input type="checkbox" name="asthma" value="Asthma"
            <?php
        if($check_res['asthma']=="Asthma"){
         echo "checked";
        }
      ?>>Asthma</td>
            <td style="width: 20%;"><input type="checkbox" name="std" value="STD" <?php
        if($check_res['std']=="STD"){
         echo "checked";
        }
      ?>>STD</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="high_cholesterol" value="High Cholesterol" <?php
        if($check_res['high_cholesterol']=="High Cholesterol"){
         echo "checked";
        }
      ?>>High Cholesterol</td>
            <td style="width: 20%;"><input type="checkbox" name="head_trauma" value="Head Trauma" <?php
        if($check_res['head_trauma']=="Head Trauma"){
         echo "checked";
        }
      ?>>Head Trauma</td>
            <td style="width: 20%;"><input type="checkbox" name="lung_problems" value="Lung problems" <?php
        if($check_res['lung_problems']=="Lung problems"){
         echo "checked";
        }
      ?>>Lung problems</td>
            <td style="width: 20%;" rowspan="2"><input type="checkbox" name="hiv_aids" value="HIV/AIDS" <?php
        if($check_res['hiv_aids']=="HIV/AIDS"){
         echo "checked";
        }
      ?>>HIV/AIDS</td>
          </tr>
        </table>

        <table style="width:100%;">
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="diabetes_type" value="Diabetes: type I or II" <?php
        if($check_res['diabetes_type']=="Diabetes: type I or II"){
         echo "checked";
        }
      ?>>Diabetes: type I or II</td>
            <td style="width: 20%;"><input type="checkbox" name="hypertension" value="hypertension" <?php
        if($check_res['hypertension']=="hypertension"){
         echo "checked";
        }
      ?>>Hypertension</td>
            <td style="width: 20%;"><input type="checkbox" name="kidney_problems" value="kidney problems" <?php
        if($check_res['kidney_problems']=="kidney problems"){
         echo "checked";
        }
      ?>>Kidney problems</td>
            <td style="width: 20%;"><input type="checkbox" name="hepatitis" value="hepatitis"<?php
        if($check_res['hepatitis']=="hepatitis"){
         echo "checked";
        }
      ?>>Hepatitis</td>
            <td><input type="checkbox" name="a" value="a"<?php
        if($check_res['a']=="a"){
         echo "checked";
        }
      ?>>A <input type="checkbox" name="b" value="b"<?php
      if($check_res['b']=="b"){
       echo "checked";
      }
    ?>>B <input type="checkbox" name="c" value="c"<?php
    if($check_res['c']=="c"){
     echo "checked";
    }
  ?>>C</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="other" value="" <?php
        if($check_res['other']=="other"){
         echo "checked";
        }
      ?>>Other:</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Hospitalizations in lifetime (physical) <input class="yes_no" type="checkbox" name="hospitalizations" value="yes" <?php
        if($check_res['hospitalizations']=="yes"){
         echo "checked";
        }
      ?>>Yes <input type="checkbox" name="hospitalizations1" class="yes_no" value="no" <?php
      if($check_res['hospitalizations1']=="no"){
       echo "checked";
      }
    ?>>No</td>
          </tr>
          <tr>
            <td>If yes, explain: <input type="text" name="explain1" value="<?php echo $check_res['explain1']; ?>"></td>
          </tr>
          <tr>
            <td>Last hospitalization: <input type="text" name="" value="<?php echo $check_res['spiritual_beliefs']; ?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Current Medications (including for substance abuse): <input type="text" name="spiritual_beliefs" value="<?php echo $check_res['spiritual_beliefs']; ?>"></td>
          </tr>
          <tr>
            <td>Are you following your doctor’s instructions closely on prescription medication use? <input type="checkbox" name="prescription_medication" class="yes_no" value="yes" <?php
        if($check_res['prescription_medication']=="yes"){
         echo "checked";
        }
      ?>>Yes <input type="checkbox" name="prescription_medication1" class="yes_no" value="no" <?php
      if($check_res['prescription_medication1']=="no"){
       echo "checked";
      }
    ?>>No</td>
          </tr>
          <tr>
            <td>Are you taking any prescribed medication on regular basis for a physical problem? <input type="checkbox" name="physical_problem" class="yes_no" value="yes" <?php
        if($check_res['physical_problem']=="yes"){
         echo "checked";
        }
      ?>>Yes <input type="checkbox" name="physical_problem1" class="yes_no" value="yes" <?php
        if($check_res['physical_problem1']=="no"){
         echo "checked";
        }
      ?>>No</td>
          </tr>
          <tr>
            <td>Do you comply with your medication? <input type="checkbox" class="yes_no" name="medication" value="yes" <?php
        if($check_res['medication']=="yes"){
         echo "checked";
        }
      ?>>Yes <input type="checkbox" name="medication1" class="yes_no" value="no" <?php
      if($check_res['medication1']=="no"){
       echo "checked";
      }
    ?>>No</td>
            <td>Do you receive pension for disability? <input type="checkbox" class="yes_no" name="disability" value="yes" <?php
        if($check_res['disability']=="yes"){
         echo "checked";
        }
      ?>> Yes <input type="checkbox" name="disability1" class="yes_no" value="no" <?php
        if($check_res['disability1']=="no"){
         echo "checked";
        }
      ?>> No</td>
          </tr>
        </table>
        <br>
        <table styel="width:100%">
          <tr>
            <td>How bothered are you by your medical condition? Not at all <input type="text" name="medical_condition" value="<?php echo $check_res['medical_condition']; ?>"></td>
          </tr>
          <tr>
            <td>How important is treatment to you for your medical condition? Not at all <input type="text" name="medical_condition1" value="<?php echo $check_res['medical_condition1']; ?>"></td>
          </tr>
        </table>
        <br>
        <p style="text-align: center; text-decoration: underline;">SUBSTANCE USE HISTORY</p>
        <table style="width: 100%;">
          <tr>
            <td style="border: 1px solid black;">Substances</td>
            <td style="border: 1px solid black;">Route of admin</td>
            <td style="border: 1px solid black;">First Use (age)</td>
            <td style="border: 1px solid black;">Last Use</td>
            <td style="border: 1px solid black;">Comments</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Tobacco</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="tabacco1" value="<?php echo $check_res['tabacco1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="tabacco2" value="<?php echo $check_res['tabacco2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="tabacco3" value="<?php echo $check_res['tabacco3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="tabacco4" value="<?php echo $check_res['tabacco4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Alcohol</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="alcohol1" value="<?php echo $check_res['alcohol1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="alcohol2" value="<?php echo $check_res['alcohol2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="alcohol3" value="<?php echo $check_res['alcohol3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="alcohol4" value="<?php echo $check_res['alcohol4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Cannabis</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="cannabis1" value="<?php echo $check_res['cannabis1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="cannabis2" value="<?php echo $check_res['cannabis2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="cannabis3" value="<?php echo $check_res['cannabis3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="cannabis4" value="<?php echo $check_res['cannabis4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Cocaine</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="cocaine1" value="<?php echo $check_res['cocaine1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="cocaine2" value="<?php echo $check_res['cocaine2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="cocaine3" value="<?php echo $check_res['cocaine3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="cocaine4" value="<?php echo $check_res['cocaine4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Heroin</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="heroin1" value="<?php echo $check_res['heroin1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="heroin2" value="<?php echo $check_res['heroin2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="heroin3" value="<?php echo $check_res['heroin3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="heroin4" value="<?php echo $check_res['heroin4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Other opiates:</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="other_opiates1" value="<?php echo $check_res['other_opiates1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="other_opiates2" value="<?php echo $check_res['other_opiates2']; ?>"></td>
            <td style="bordr: 1px solid black;"><input style="border:none" type="text" name="other_opiates3" value="<?php echo $check_res['other_opiates3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="other_opiates4" value="<?php echo $check_res['other_opiates4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Methadone</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="methadone1" value="<?php echo $check_res['methadone1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="methadone2" value="<?php echo $check_res['methadone2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="methadone3" value="<?php echo $check_res['methadone3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="methadone4" value="<?php echo $check_res['methadone4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Amphetamines</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="amphetamines1" value="<?php echo $check_res['amphetamines1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="amphetamines2" value="<?php echo $check_res['amphetamines2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="amphetamines3" value="<?php echo $check_res['amphetamines3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="amphetamines4" value="<?php echo $check_res['amphetamines4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Benzodiazepines</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="benzodiazepines1" value="<?php echo $check_res['benzodiazepines1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="benzodiazepine2" value="<?php echo $check_res['benzodiazepine2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="benzodiazepine3" value="<?php echo $check_res['benzodiazepine3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="benzodiazepine4" value="<?php echo $check_res['benzodiazepine4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">LSD/Psilocybin/K/PCP</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="lsd_pcp1" value="<?php echo $check_res['lsd_pcp1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="lsd_pcp2" value="<?php echo $check_res['lsd_pcp2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="lsd_pcp3" value="<?php echo $check_res['lsd_pcp3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="lsd_pcp4" value="<?php echo $check_res['lsd_pcp4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Inhalants</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="inhalants1" value="<?php echo $check_res['inhalants1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="inhalants2" value="<?php echo $check_res['inhalants2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="inhalants3" value="<?php echo $check_res['inhalants3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="inhalants4" value="<?php echo $check_res['inhalants4']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Others</td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="other1" value="<?php echo $check_res['other1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="other2" value="<?php echo $check_res['other2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="other3" value="<?php echo $check_res['other3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none" type="text" name="other4" value="<?php echo $check_res['other4']; ?>"></td>
          </tr>
          <tr>
            <td>Additional Notes: <input type="text" name="additional_notes" value="<?php echo $check_res['additional_notes']; ?>"></td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td> OD’s/DT’s in lifetime: <input type="text" name="od_dt" value="<?php echo $check_res['od_dt']; ?>"></td>
          </tr>
          <tr>
            <td> Drug use in the last 30 days: <input type="text" name="odurg" value="<?php echo $check_res['odurg']; ?>"></td>
          </tr>
          <tr>
            <td> Money spent in the past 30 days on: Alcohol: <input type="text" name="money_spent_alcohol" value="<?php echo $check_res['money_spent_alcohol']; ?>"> Drugs: <input type="text" name="money_spent_drugs" value="<?php echo $check_res['money_spent_drugs']; ?>"></td>
          </tr>
        </table>
        <br>
        <p><span style="text-decoration: underline;">SUBSTANCE ABUSE RELATED WITHDRAWAL SYMPTOMS</span> (check all that apply)</p>
        <table style="width:100%;">
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="denies" value="1" <?php
        if($check_res['	denies']=="1"){
         echo "checked";
        }?>>Denies</td>
            <td style="width: 20%;"><input type="checkbox" name="vomiting" value="1" <?php
        if($check_res['vomiting']=="1"){
         echo "checked";
        }?>>Vomiting</td>
            <td style="width: 20%;"><input type="checkbox" name="" value="1" <?php
        if($check_res['constipation']=="1"){
         echo "checked";
        }?>>Constipation</td>
            <td style="width: 20%;"><input type="checkbox" name="irritability" value="1" <?php
        if($check_res['irritability']=="1"){
         echo "checked";
        }?>>Irritability</td>
            <td style="width: 20%;"><input type="checkbox" name="problems_sleeping" value="1" <?php
        if($check_res['problems_sleeping']=="1"){
         echo "checked";
        }?>>Problems sleeping</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="cravings" value="1" <?php
        if($check_res['cravings']=="1"){
         echo "checked";
        }?>>Cravings</td>
            <td style="width: 20%;"><input type="checkbox" name="change_appetite" value="1" <?php
        if($check_res['change_appetite']=="1"){
         echo "checked";
        }?>>Change in appetite</td>
            <td style="width: 20%;"><input type="checkbox" name="stomach_cramps" value="1" <?php
        if($check_res['stomach_cramps']=="1"){
         echo "checked";
        }?>>Stomach cramps</td>
            <td style="width: 20%;"><input type="checkbox" name="feeling_sad" value="1" <?php
        if($check_res['feeling_sad']=="1"){
         echo "checked";
        }?>>Feeling sad</td>
            <td style="width: 20%;"><input type="checkbox" name="fatigue" value="1" <?php
        if($check_res['fatigue']=="1"){
         echo "checked";
        }?>>Fatigue</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="nausea" value="1" <?php
        if($check_res['nausea']=="1"){
         echo "checked";
        }?>>Nausea</td>
            <td style="width: 20%;"><input type="checkbox" name="diarrhea" value="1" <?php
        if($check_res['diarrhea']=="1"){
         echo "checked";
        }?>>Diarrhea</td>
            <td style="width: 20%;"><input type="checkbox" name="anxiety" value="1" <?php
        if($check_res['anxiety']=="1"){
         echo "checked";
        }?>>Anxiety(hx)</td>
            <td style="width: 20%;"><input type="checkbox" name="fearful" value="1" <?php
        if($check_res['fearful']=="1"){
         echo "checked";
        }?>>Fearful</td>
            <td style="width: 20%;"><input type="checkbox" name="difficulty_concentrating" value="1" <?php
        if($check_res['difficulty_concentrating']=="1"){
         echo "checked";
        }?>>Difficulty concentrating</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="restless_leg" value="1" <?php
        if($check_res['restless_leg']=="1"){
         echo "checked";
        }?>>Restless leg</td>
            <td style="width: 20%;"><input type="checkbox" name="restlessness" value="1" <?php
        if($check_res['restlessness']=="1"){
         echo "checked";
        }?>>Restlessness</td>
            <td style="width: 20%;"><input type="checkbox" name="tremors" value="1" <?php
        if($check_res['tremors']=="1"){
         echo "checked";
        }?>>Tremors</td>
            <td style="width: 20%;"><input type="checkbox" name="dizziness" value="1" <?php
        if($check_res['dizziness']=="1"){
         echo "checked";
        }?>>Dizziness</td>
            <td style="width: 20%;"><input type="checkbox" name="headaches" value="1" <?php
        if($check_res['headaches']=="1"){
         echo "checked";
        }?>>Headaches</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="muscle_aches" value="1" <?php
        if($check_res['muscle_aches']=="1"){
         echo "checked";
        }?>>Muscle aches</td>
            <td style="width: 20%;"><input type="checkbox" name="muscle_stiffness" value="1" <?php
        if($check_res['muscle_stiffness']=="1"){
         echo "checked";
        }?>>Muscle stiffness</td>
            <td style="width: 20%;"><input type="checkbox" name="weakness" value="1" <?php
        if($check_res['weakness']=="1"){
         echo "checked";
        }?>>Weakness</td>
            <td style="width: 20%;"><input type="checkbox" name="numbness" value="1" <?php
        if($check_res['numbness']=="1"){
         echo "checked";
        }?>>Numbness</td>
            <td style="width: 20%;"><input type="checkbox" name="hot_cold_temperate" value="1" <?php
        if($check_res['hot_cold_temperate']=="1"){
         echo "checked";
        }?>>Hot/cold temperate changes</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="sweats" value="1" <?php
        if($check_res['sweats']=="1"){
         echo "checked";
        }?>>Sweats</td>
            <td style="width: 20%;"><input type="checkbox" name="heart_pounding" value="1" <?php
        if($check_res['heart_pounding']=="1"){
         echo "checked";
        }?>>Heart pounding</td>
            <td style="width: 20%;" rowspan="2"><input type="checkbox" name="auditory_visual_tactile" value="1" <?php
        if($check_res['auditory_visual_tactile']=="1"){
         echo "checked";
        }?>>Auditory/Visual/Tactile Hallucinations</td>
            <td style="width: 20%;"><input type="checkbox" name="insomnia" value="1" <?php
        if($check_res['insomnia']=="1"){
         echo "checked";
        }?>>Insomnia</td>
          </tr>
          <tr>
          <td style="width: 20%;"><input type="checkbox" name="other_abuse" value="1" <?php
        if($check_res['other_abuse']=="1"){
         echo "checked";
        }?>>Other:</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Any history of drug/alcohol related seizures? <input type="checkbox" name="drug_alcohol" value="1" class="yes_no" <?php
        if($check_res['drug_alcohol']=="1"){
         echo "checked";
        }?>> Yes <input type="checkbox" name="drug_alcohol1" class="yes_no" value="2" <?php
        if($check_res['drug_alcohol1']=="2"){
         echo "checked";
        }?>> No</td>
          </tr>
          <tr>
            <td>If yes, when: <input type="text" name="yes_when" value="<?php echo $check_res['yes_when']; ?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Sleep changes:&emsp;&emsp; <input type="checkbox" name="sleep_changes" value="1" <?php
        if($check_res['sleep_changes']=="1"){
         echo "checked";
        }?>> No change &emsp;&emsp;<input type="checkbox" name="sleep_changes1" value="1" <?php
        if($check_res['sleep_changes1']=="1"){
         echo "checked";
        }?>> Interrupted &emsp;&emsp;<input type="checkbox" name="sleep_changes2" value="1" <?php
        if($check_res['sleep_changes2']=="1"){
         echo "checked";
        }?>> Increased &emsp;&emsp;<input type="checkbox" name="sleep_changes3" value="1" <?php
        if($check_res['sleep_changes3']=="1"){
         echo "checked";
        }?>> Decreased</td>
          </tr>
          <tr>
            <td>Explain: <input type="text" name="explain2" value="<?php echo $check_res['explain2']; ?>"></td>
          </tr>
        </table>

        <br>
        <table style="width:100%;">
          <tr>
            <td>Appetite changes:&emsp;&emsp; <input type="checkbox" name="appetite_changes" value="1" <?php
        if($check_res['appetite_changes']=="1"){
         echo "checked";
        }?>> Increased &emsp;&emsp;<input type="checkbox" name="appetite_changes1" value="1" <?php
        if($check_res['appetite_changes1']=="1"){
         echo "checked";
        }?>> Decreased &emsp;&emsp;<input type="checkbox" name="appetite_changes2" value="1" <?php
        if($check_res['appetite_changes2']=="1"){
         echo "checked";
        }?>> No change &emsp;&emsp;<input type="checkbox" name="appetite_changes3" value="1" <?php
        if($check_res['appetite_changes3']=="1"){
         echo "checked";
        }?>> Weight loss &emsp;&emsp;<input type="checkbox" name="appetite_changes4" value="1" <?php
        if($check_res['appetite_changes4']=="1"){
         echo "checked";
        }?>> Weight gain</td>
          </tr>
          <tr>
            <td>Explain: <input type="text" name="explain3" value="<?php echo $check_res['explain3']; ?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Cravings:&emsp;&emsp; <input type="checkbox" name="cravings1" value="1" <?php
        if($check_res['cravings1']=="1"){
         echo "checked";
        }?>> Absent &emsp;&emsp;<input type="checkbox" name="cravings2" value="2" <?php
        if($check_res['cravings2']=="2"){
         echo "checked";
        }?>> Present:<input type="checkbox" name="cravings3" value="3" <?php
        if($check_res['cravings3']=="3"){
         echo "checked";
        }?>>Mild,<input type="checkbox" name="cravings4" value="4" <?php
        if($check_res['cravings4']=="4"){
         echo "checked";
        }?>> Moderate, <input type="checkbox" name="cravings5" value="5" <?php
        if($check_res['cravings5']=="5"){
         echo "checked";
        }?>> Severe</td>
          </tr>
          <tr>
            <td>Urges: <input type="checkbox" name="urges1" value="1" <?php
        if($check_res['urges1']=="1"){
         echo "checked";
        }?>>None &emsp;&emsp; <input type="checkbox" name="urges" value="2" <?php
        if($check_res['urges']=="2"){
         echo "checked";
        }?>>Present,how often:</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Substance Abuse Related Symptoms and Observations</td>
          </tr>
          <tr>
            <td style="font-style: italic;">Evidence of increased tolerance to substance use:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="evidence" value="1" <?php
        if($check_res['evidence']=="1"){
         echo "checked";
        }?>> Need to increase quantity to get desired effect</td>
            <td><input type="checkbox" name="evidence1" value="2" <?php
        if($check_res['evidence1']=="2"){
         echo "checked";
        }?>> Increased number of use episodes</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="evidenc2" value="3" <?php
        if($check_res['evidence2']=="3"){
         echo "checked";
        }?>>Repeated efforts to reduce usage</td>
            <td><input type="checkbox" name="evidence3" value="4" <?php
        if($check_res['evidence3']=="4"){
         echo "checked";
        }?>>Continuous use of at least 2 day duration</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="evidence4" value="5" <?php
        if($check_res['evidence4']=="5"){
         echo "checked";
        }?>>Blackouts</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td><span style="text-decoration: underline;">Reason for Substance Use</span> (check off relevant ones):</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="reason_substance" value="0" <?php
        if($check_res['reason_substance']=="0"){
         echo "checked";
        }?>>Euphoria &emsp;&emsp;&emsp;<input type="checkbox" name="reason_substance1" value="1" <?php
        if($check_res['reason_substance1']=="1"){
         echo "checked";
        }?>>Fear &emsp;&emsp;&emsp;<input type="checkbox" name="reason_substance2" value="2" <?php
        if($check_res['reason_substance2']=="2"){
         echo "checked";
        }?>>Anger &emsp;&emsp;&emsp;<input type="checkbox" name="reason_substance3" value="3" <?php
        if($check_res['reason_substance3']=="3"){
         echo "checked";
        }?>>Insomnia &emsp;&emsp;&emsp;<input type="checkbox" name="reason_substance4" value="4" <?php
        if($check_res['reason_substance4']=="4"){
         echo "checked";
        }?>>Stress &emsp;&emsp;&emsp;<input type="checkbox" name="reason_substance5" value="5" <?php
        if($check_res['reason_substance5']=="5"){
         echo "checked";
        }?>>Social Discomfort &emsp;&emsp;&emsp;<input type="checkbox" name="reason_substance6" value="6" <?php
        if($check_res['reason_substance6']=="6"){
         echo "checked";
        }?>>Peer Pressure</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="reason_substance7" value="7" <?php
        if($check_res['reason_substance7']=="1"){
         echo "checked";
        }?>> Other: </td>
          </tr>
          <tr>
            <td>Substance Use/Abuse Circumstances: <input type="text" name="use_abuse_circumstances" value="<?php echo $check_res['use_abuse_circumstances']; ?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Behavior While Using Substances</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="behavior_substances" value="0" <?php
        if($check_res['behavior_substances']=="0"){
         echo "checked";
        }?>>Extroverted &emsp;&emsp;&emsp;<input type="checkbox" name="behavior_substances1" value="1 <?php
        if($check_res['behavior_substances1']=="1"){
         echo "checked";
        }?>">Isolated &emsp;&emsp;&emsp;<input type="checkbox" name="behavior_substances2" value="2" <?php
        if($check_res['behavior_substances2']=="2"){
         echo "checked";
        }?>>Aggressive &emsp;&emsp;&emsp;<input type="checkbox" name="behavior_substances3" value="3" <?php
        if($check_res['behavior_substances3']=="3"){
         echo "checked";
        }?>>Promiscuous</td>
          </tr>
          <tr>
            <td>Explain: <input type="text" name="explain4" value="<?php echo $check_res['explain4']; ?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="text-decoration:underline;">Personality/Behavioral Changes Related to Substance Use:</td>
          </tr>
          <tr>
            <td style="width:50%; text-decoration:underline;">Personality</td>
            <td style="width:50%; text-decoration:underline;">Behavioral</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="personality1" value="1" <?php
        if($check_res['personality1']=="1"){
         echo "checked";
        }?>>Increased moodiness</td>
            <td><input type="checkbox" name="behavioral1" value="1" <?php
        if($check_res['behavioral1']=="1"){
         echo "checked";
        }?>>Preoccupation with substance supply</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="personality2" value="2" <?php
        if($check_res['personality2']=="2"){
         echo "checked";
        }?>>Jumpy, nervous</td>
            <td><input type="checkbox" name="behavioral2" value="2" <?php
        if($check_res['behavioral2']=="2"){
         echo "checked";
        }?>>Secretive use</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="personality3" value="3" <?php
        if($check_res['personality3']=="3"){
         echo "checked";
        }?>>Irritable</td>
            <td><input type="checkbox" name="behavioral3" value="3" <?php
        if($check_res['behavioral3']=="3"){
         echo "checked";
        }?>>Use at unusual times</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="personality4" value="4" <?php
        if($check_res['personality4']=="4"){
         echo "checked";
        }?>>Paranoid</td>
            <td><input type="checkbox" name="behavioral4" value="4" <?php
        if($check_res['behavioral4']=="4"){
         echo "checked";
        }?>>Urgent use</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="personality5" value="5" <?php
        if($check_res['personality5']=="5"){
         echo "checked";
        }?>>Low self-confidence</td>
            <td><input type="checkbox" name="behavioral5" value="5" <?php
        if($check_res['behavioral5']=="5"){
         echo "checked";
        }?>>Loss of interest in social/recreational activates</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="personality6" value="6" <?php
        if($check_res['personality6']=="6"){
         echo "checked";
        }?>>Depressed</td>
            <td><input type="checkbox" name="behavioral6" value="6"<?php
        if($check_res['behavioral6']=="6"){
         echo "checked";
        }?>>Homicidal/suicidal urges while using</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="personality7" value="7" <?php
        if($check_res['personality7']=="7"){
         echo "checked";
        }?>>Withdrawn</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="personality8" value="8" <?php
        if($check_res['personality8']=="8"){
         echo "checked";
        }?>>Loss of energy</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="personality9" value="9" <?php
        if($check_res['personality9']=="9"){
         echo "checked";
        }?>>Anger</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Has substance abuse resulted in: <input type="text" name="substance_result" value="<?php echo $check_res['substance_result']; ?>"></td>
          </tr>
          <tr>
            <td>Poor judgement: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="poor_judgement1" value="1" class="yes_no" <?php
        if($check_res['poor_judgement1']=="1"){
         echo "checked";
        }?>>Yes,explain:<input type="text" name="poor_judgement2" value="<?php echo $check_res['inhalants4']; ?>">&emsp;&emsp;<input type="checkbox" class="yes_no" name="poor_judgement3" value="2" <?php
        if($check_res['poor_judgement3']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>Cognitive impairments: &emsp;<input type="checkbox" name="cognitive1" value="1" <?php
        if($check_res['cognitive1']=="1"){
         echo "checked";
        }?>>Denies</td>
          </tr>
          <tr>
            <td> &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="cognitive2" value="2" <?php
        if($check_res['cognitive2']=="2"){
         echo "checked";
        }?>>Loss of memory recent or remote</td>
            <td> <input type="checkbox" name="cognitive3" value="3" <?php
        if($check_res['cognitive3']=="3"){
         echo "checked";
        }?>>Vision changes (double vision, drooping eyelids)</td>
          </tr>
          <tr>
            <td> &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="cognitive4" value="4" <?php
        if($check_res['cognitive4']=="4"){
         echo "checked";
        }?>>Loss of muscle control</td>
            <td> <input type="checkbox" name="cognitive5" value="5" <?php
        if($check_res['cognitive5']=="5"){
         echo "checked";
        }?>>Nystagmus (involuntary eye movements)</td>
          </tr>
          <tr>
            <td> &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="cognitive6" value="6" <?php
        if($check_res['cognitive6']=="6"){
         echo "checked";
        }?>>Inability to concentrate</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>History of previous treatment (Substance Abuse)</td>
          </tr>
          <tr>
            <td>Substance abuse (most recent first), reason for treatment, facility, when, treatment length, outcome:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="client_denies" value="1" <?php
        if($check_res['client_denies']=="1"){
         echo "checked";
        }?>>Client denies previous history of treatment</td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="border: 1px solid black; text-align: center;">Facility Name</td>
            <td style="border: 1px solid black; text-align: center;">When</td>
            <td style="border: 1px solid black; text-align: center;">Length of treatment</td>
            <td style="border: 1px solid black; text-align: center;">Completed?Y/N</td>
            <td style="border: 1px solid black; text-align: center;">Outcome:</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_name1" value="<?php echo $check_res['facility_name1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="when1" value="<?php echo $check_res['when1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_treatment1" value="<?php echo $check_res['facility_treatment1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_completed1" value="<?php echo $check_res['facility_completed1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_outcome1" value="<?php echo $check_res['facility_outcome1']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_name2" value="<?php echo $check_res['facility_name2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="when2" value="<?php echo $check_res['when2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_treatment2" value="<?php echo $check_res['facility_treatment2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_completed2" value="<?php echo $check_res['facility_completed2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_outcome2" value="<?php echo $check_res['facility_outcome2']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_name3" value="<?php echo $check_res['facility_name3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="when3" value="<?php echo $check_res['when3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_treatment3" value="<?php echo $check_res['facility_treatment3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_completed3" value="<?php echo $check_res['facility_completed3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_outcome3" value="<?php echo $check_res['facility_outcome3']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_name4" value="<?php echo $check_res['facility_name4']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="when4" value="<?php echo $check_res['when4']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_treatment4" value="<?php echo $check_res['facility_treatment4']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_completed4" value="<?php echo $check_res['facility_completed4']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="facility_outcome4" value="<?php echo $check_res['facility_outcome4']; ?>"></td>
          </tr>
          <tr>
            <td>How many were detoxes only: <input type="text" name="facility_detoxes" value="<?php echo $check_res['facility_detoxes']; ?>"></td>
          </tr>
        </table>
          <p> Longest period of voluntary abstinence (when and how it was achieved): <input type="text" name="facility_voluntary" value="<?php echo $check_res['facility_voluntary']; ?>"></p>
        <br>
        <table>
          <tr>
            <td>Last period of abstinence: <input type="text" name="abstinence1" value="<?php echo $check_res['abstinence1']; ?>">&emsp;&emsp;</td>
            <td>When last period of abstinence ended: <input type="text" name="abstinence2" value="<?php echo $check_res['abstinence2']; ?>"></td>
          </tr>
          <tr>
            <td><br>Self-help groups attended: <input type="text" name="attended" value="<?php echo $check_res['attended']; ?>">&emsp;&emsp;</td>
            <td><br>Since: <input type="text" name="since" value="<?php echo $check_res['since']; ?>"></td>
            <td><br>Times/week: <input type="text" name="timw_week" value="<?php echo $check_res['timw_week']; ?>"></td>
          </tr>
          <tr>
            <td>Do/did you have a sponsor? <input type="text" name="sponsor" value="<?php echo $check_res['sponsor']; ?>">&emsp;&emsp;</td>
            <td>Attendance in last 30 days: <input type="text" name="attendance" value="<?php echo $check_res['attendance']; ?>"></td>
          </tr>
          <tr>
            <td>What do you think of self-help groups? <input type="text" name="self_help_groups" value="<?php echo $check_res['self_help_groups']; ?>"></td>
          </tr>
        </table>
        <table>
          <tr>
            <td>How bothered are you by your substance use? Not at all <input type="text" name="self_bothered" value="<?php echo $check_res['self_bothered']; ?>"></td>
          </tr>
          <tr>
            <td>How important to you is treatment for your substance use? Not at all <input type="text" name="self_important_treatment" value="<?php echo $check_res['self_important_treatment']; ?>"></td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td style="text-decoration: underline;">Co-Occurring Mental Illness</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="co_occurring_mental1" value="1" <?php
        if($check_res['co_occurring_mental1']=="1"){
         echo "checked";
        }?>>Denies &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="co_occurring_mental2" value="2" <?php
        if($check_res['co_occurring_mental2']=="2"){
         echo "checked";
        }?>>Present</td>
          </tr>
          <tr>
            <td>If yes, specify diagnosis: <input type="text" name="diagnosis" value="<?php echo $check_res['diagnosis']; ?>"></td>
          </tr>
          <tr>
            <td>When were you first diagnosed? <input type="text" name="diagnosed" value="<?php echo $check_res['diagnosed']; ?>"></td>
          </tr>
          <tr>
            <td><br>Mental health treatment &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="mental_health_treatment" value="1" <?php
        if($check_res['mental_health_treatment']=="1"){
         echo "checked";
        }?>>Denies</td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="border: 1px solid black; text-align: center;">Most recent treatmentfacility</td>
            <td style="border: 1px solid black; text-align: center;">Year</td>
            <td style="border: 1px solid black; text-align: center;">Reason fortreatment</td>
            <td style="border: 1px solid black; text-align: center;">Type offacility</td>
            <td style="border: 1px solid black; text-align: center;">Treatmentlength</td>
            <td style="border: 1px solid black; text-align: center;">Outcome:</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="treatmentfacility1" value="<?php echo $check_res['treatmentfacility1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="year1" value="<?php echo $check_res['year1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="reason_fortreatment1" value="<?php echo $check_res['reason_fortreatment1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="type_offacility1" value="<?php echo $check_res['type_offacility1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="treatmentlength1" value="<?php echo $check_res['treatmentlength1']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="outcome1" value="<?php echo $check_res['outcome1']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="treatmentfacility2" value="<?php echo $check_res['treatmentfacility2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="year2" value="<?php echo $check_res['year2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="reason_fortreatment2" value="<?php echo $check_res['reason_fortreatment2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="type_offacility2" value="<?php echo $check_res['type_offacility2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="treatmentlength2" value="<?php echo $check_res['treatmentlength2']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="outcome2" value="<?php echo $check_res['outcome2']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="treatmentfacility3" value="<?php echo $check_res['treatmentfacility3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="year3" value="<?php echo $check_res['year3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="reason_fortreatment3" value="<?php echo $check_res['reason_fortreatment3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="type_offacility3" value="<?php echo $check_res['type_offacility3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="treatmentlength3" value="<?php echo $check_res['treatmentlength3']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="outcome3" value="<?php echo $check_res['outcome3']; ?>"></td>
          </tr>
          <tr>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="treatmentfacility4" value="<?php echo $check_res['treatmentfacility4']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="year4" value="<?php echo $check_res['year4']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="reason_fortreatment4" value="<?php echo $check_res['reason_fortreatment4']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="type_offacility4" value="<?php echo $check_res['type_offacility4']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="treatmentlength4" value="<?php echo $check_res['treatmentlength4']; ?>"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="text" name="outcome4" value="<?php echo $check_res['outcome4']; ?>"></td>
          </tr>
          <tr>
            <td><br><input type="checkbox" name="bullied_others" value="1" <?php
        if($check_res['bullied_others']=="1"){
         echo "checked";
        }?>>Bullied by others</td>
          </tr>
        </table>
        <table>
          <tr>
            <td><input type="checkbox" name="behavior_bullying" value="1" <?php
        if($check_res['behavior_bullying']=="1"){
         echo "checked";
        }?>>Have you ever practiced the behavior of bullying or been accused of bullying by others? Explain:<input type="text" name="explain6" value="<?php echo $check_res['explain6']; ?>"></td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Eating Disorders: Past diagnosis: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="disorders1" value="1" <?php
        if($check_res['disorders1']=="1"){
         echo "checked";
        }?>>Denies &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="disorders2" value="2" <?php
        if($check_res['disorders2']=="2"){
         echo "checked";
        }?>>Present: <input type="checkbox" name="disorders3" value="3" <?php
        if($check_res['disorders3']=="3"){
         echo "checked";
        }?>>Purging <input type="checkbox" name="disorders4" value="4" <?php
        if($check_res['disorders4']=="4"){
         echo "checked";
        }?>>Binge Eating <input type="checkbox" name="disorders5" value="5" <?php
        if($check_res['disorders5']=="5"){
         echo "checked";
        }?>>Anorexia <input type="checkbox" name="disorders6" value="6" <?php
        if($check_res['disorders6']=="6"){
         echo "checked";
        }?>>Bulimia</td>
          </tr>
          <tr>
            <td>Frequency: <input type="text" name="frequency1" value="<?php echo $check_res['frequency1']; ?>">Age of onset: <input type="text" name="frequency2" value="<?php echo $check_res['frequency2']; ?>">Lasted until: <input type="text" name="frequency3" value="<?php echo $check_res['frequency3']; ?>"></td>
          </tr>
          <tr>
            <td>Limiting food intake: <input type="text" name="frequency4" value="<?php echo $check_res['frequency4']; ?>">Age of onset: <input type="text" name="frequency5" value="<?php echo $check_res['frequency5']; ?>">Lasted until: <input type="text" name="frequency6" value="<?php echo $check_res['frequency6']; ?>"></td>
          </tr>
          <tr>
            <td><br>Self-Mutilation/Cutting Behaviors: &emsp;&emsp;&emsp;<input type="checkbox" name="mutilation_cutting1" class="yes_no" value="1" <?php
        if($check_res['mutilation_cutting1']=="1"){
         echo "checked";
        }?>>Yes &emsp;&emsp;<input type="checkbox" name="mutilation_cutting2" class="yes_no" value="2" <?php
        if($check_res['mutilation_cutting2']=="1"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>If yes, <input type="checkbox" name="cutting" value="1" <?php
        if($check_res['cutting']=="1"){
         echo "checked";
        }?>>Cutting <input type="checkbox" name="burning" value="2" <?php
        if($check_res['burning']=="2"){
         echo "checked";
        }?>>Burning <input type="checkbox" name="hair_pulling" value="3" <?php
        if($check_res['hair_pulling']=="3"){
         echo "checked";
        }?>>Hair pulling <input type="checkbox" name="piercings" value="4" <?php
        if($check_res['piercings']=="4"){
         echo "checked";
        }?>>Piercings <input type="checkbox" name="tattoos" value="5" <?php
        if($check_res['tattoos']=="5"){
         echo "checked";
        }?>>Tattoos</td>
          </tr>
          <tr>
            <td>Age of onset: <input type="text" name="age_onset" value="<?php echo $check_res['age_onset']; ?>">Frequency: <input type="text" name="frequency" value="<?php echo $check_res['frequency']; ?>">Area on the body: <input type="text" name="on_area_body" value="<?php echo $check_res['on_area_body']; ?>">Lasted until: <input type="text" name="lasted_until" value="<?php echo $check_res['lasted_until']; ?>"></td>
          </tr>

          <tr>
            <td><br>Gambling behaviors:</td>
          </tr>
          <tr>
            <td>Did/do you gamble (online/in person)? <input type="checkbox" name="gamble_online_person1" class="yes_no" value="1" <?php
        if($check_res['gamble_online_person1']=="1"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="gamble_online_person2" value="2" <?php
        if($check_res['gamble_online_person2']=="2"){
         echo "checked";
        }?>>Yes, how often?</td>
          </tr>
          <tr>
            <td>Explain: <input type="text" name="explain7" value="<?php echo $check_res['explain7']; ?>"></td>
          </tr>
          <tr>
            <td>Have you spent a lot of time thinking about past gambling experience or planning future gambling ventures or bets? <input type="checkbox" class="yes_no" name="gambling_experience1" value="1" <?php
        if($check_res['gambling_experience1']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" class="yes_no" name="gambling_experience12" value="2" <?php
        if($check_res['gambling_experience2']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>Have you ever lied to family members, friends or others about how often you gamble or how much money you lost gambling? <input type="checkbox" name="lost_gambling1" class="yes_no" value="1" <?php
        if($check_res['lost_gambling1']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" class="yes_no" name="lost_gambling2" value="2" <?php
        if($check_res['lost_gambling2']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>After losing do you try to return as quickly as possible to win back your losses? <input type="checkbox" class="yes_no" name="win_back_your_losses1" value="1" <?php
        if($check_res['win_back_your_losses1']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" class="yes_no" name="win_back_your_losses2" value="2" <?php
        if($check_res['win_back_your_losses2']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>LETHAILITY ASSESSMENT</td>
          </tr>
          <tr>
            <td>Do you have access to any firearms? <input type="checkbox" name="lethaility_assessment1" class="yes_no" value="1" <?php
        if($check_res['lethaility_assessment1']=="1"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="lethaility_assessment2" value="2" <?php
        if($check_res['lethaility_assessment2']=="2"){
         echo "checked";
        }?>>Yes</td>
          </tr>
          <tr>
            <td>Do you own guns or other weapons? <input type="checkbox" name="lethaility_assessment3" class="yes_no" value="1" <?php
        if($check_res['lethaility_assessment3']=="1"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="lethaility_assessment4" value="2" <?php
        if($check_res['lethaility_assessment4']=="2"){
         echo "checked";
        }?>>Yes &emsp;&emsp;&emsp;&emsp;&emsp; If yes, what kind? <input type="text" name="lethaility_assessment5" value="<?php echo $check_res['lethaility_assessment5']; ?>" ></td>
          </tr>
          <tr>
            <td>If you own a gun, do you have a gun permit? <input type="checkbox" name="lethaility_assessment6" class="yes_no"  value="1" <?php
        if($check_res['lethaility_assessment6']=="1"){
         echo "checked";
        }?>>N/A <input type="checkbox" class="yes_no" name="lethaility_assessment7" value="2" <?php
        if($check_res['lethaility_assessment7']=="2"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="lethaility_assessment8" value="3" <?php
        if($check_res['lethaility_assessment8']=="3"){
         echo "checked";
        }?>>Yes &emsp;&emsp;&emsp;&emsp;&emsp;  Do you have ammunition? <input type="checkbox" name="lethaility_assessment9" value="1" class="yes_no" <?php
        if($check_res['lethaility_assessment9']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="lethaility_assessment10" class="yes_no" value="2" <?php
        if($check_res['lethaility_assessment10']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>Is the gun and ammunition in a secured place? <input type="checkbox" name="lethaility_assessment11" class="yes_no" value="1" <?php
        if($check_res['lethaility_assessment11']=="1"){
         echo "checked";
        }?>>N/A <input type="checkbox" class="yes_no" name="lethaility_assessment12" value="2" <?php
        if($check_res['lethaility_assessment12']=="2"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="lethaility_assessment13" value="3" <?php
        if($check_res['lethaility_assessment13']=="3"){
         echo "checked";
        }?>>Yes &emsp;&emsp;&emsp;&emsp;&emsp;  Where? <input type="text" name="lethaility_assessment14" value="<?php echo $check_res['inhalants4']; ?>"></td>
          </tr>
          <tr>
            <td>What actions have been taken to address client access to firearms: <input type="text" name="lethaility_assessment15" value="<?php echo $check_res['lethaility_assessment15']; ?>"></td>
          </tr>
          <tr>
            <td>Education offered to client and Collateral Risk &amp; Harm/Advisements Made? <input type="checkbox" class="yes_no" name="lethaility_assessment16" value="1" <?php
        if($check_res['lethaility_assessment16']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" class="yes_no" name="lethaility_assessment17" value="2" <?php
        if($check_res['lethaility_assessment17']=="2"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="lethaility_assessment18" value="3" <?php
        if($check_res['lethaility_assessment18']=="3"){
         echo "checked";
        }?>>N/A </td>
          </tr>
          <tr>
            <td>Firearms/Weapons Safety Agreement Signed? &amp; Harm/Advisements Made? <input type="checkbox" class="yes_no" name="lethaility_assessment19" value="1" <?php
        if($check_res['lethaility_assessment19']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" class="yes_no" name="lethaility_assessment20" value="2" <?php
        if($check_res['lethaility_assessment20']=="2"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="lethaility_assessment21" value="3" <?php
        if($check_res['lethaility_assessment21']=="3"){
         echo "checked";
        }?>>N/A </td>
          </tr>

          <tr>
            <td><br>Suicide:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="suicide1" value="1" <?php
        if($check_res['suicide1']=="1"){
         echo "checked";
        }?>>Denies present or past ideations &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <input type="checkbox" name="suicide2" value="2" <?php
        if($check_res['suicide2']=="2"){
         echo "checked";
        }?>>Denies present or past attempts</td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">Ideation:</span> Age 1 st experienced: <input type="text" name="suicide3" value="<?php echo $check_res['suicide3']; ?>"> &emsp;Other times experienced: <input type="text" name="suicide4" value="<?php echo $check_res['suicide4']; ?>"> &emsp; Associated stressors: <input type="text" name="suicide5" value="<?php echo $check_res['suicide5']; ?>"></td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">Plan:</span> Age 1 st experienced: <input type="text" name="suicide6" value="<?php echo $check_res['suicide6']; ?>"> &emsp;&emsp; Other times experienced: <input type="text" name="suicide7" value="<?php echo $check_res['suicide7']; ?>"> &emsp;&emsp; Associated stressors: <input type="text" name="suicide8" value="<?php echo $check_res['suicide8']; ?>"></td>
          </tr>
          <tr>
            <td>History – Presenting attempts: <input type="text" name="suicide9" value="<?php echo $check_res['suicide9']; ?>"></td>
          </tr>
          <tr>
            <td>Means – What weapons do you own/possess? <input type="text" name="suicide10" value="<?php echo $check_res['suicide10']; ?>"></td>
          </tr>
          <tr>
            <td>Recent events (past 2 months): <input type="text" name="suicide11" value="<?php echo $check_res['suicide11']; ?>"></td>
          </tr>
          <tr>
            <td>Past events (prior to 2 months): <input type="text" name="suicide12" value="<?php echo $check_res['suicide12']; ?>"></td>
          </tr>
          <tr>
            <td>Immediate events before attempt:<input type="text" name="suicide13" value="<?php echo $check_res['suicide13']; ?>"></td>
          </tr>
          <tr>
            <td>Have any family members attempted or completed suicide? <input type="checkbox" name="suicide14" class="yes_no" value="2" <?php
        if($check_res['suicide14']=="1"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="suicide15" value="2" <?php
        if($check_res['suicide15']=="2"){
         echo "checked";
        }?>>Yes, explain: <input type="text" name="suicide16" value="<?php echo $check_res['suicide16']; ?>"></td>
          </tr>
          <tr>
            <td>Currently, what are your motivations to live? <input type="text" name="suicide17" value="<?php echo $check_res['suicide17']; ?>"></td>
          </tr>
          <tr>
            <td>Risk factors:<input type="text" name="suicide18" value="<?php echo $check_res['suicide18']; ?>"></td>
          </tr>
          <tr>
            <td>Protective factors: <input type="text" name="suicide19" value="<?php echo $check_res['suicide19']; ?>"></td>
          </tr>

          <tr>
            <td><br>Homicide: <input type="checkbox" name="homicide1" value="1" <?php
        if($check_res['homicide1']=="1"){
         echo "checked";
        }?>>Denies</td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">Ideation:</span> Age 1 st experienced: <input type="text" name="homicide2" value="<?php echo $check_res['homicide2']; ?>"> &emsp;Other times experienced: <input type="text" name="homicide3" value="<?php echo $check_res['homicide3']; ?>"> &emsp; Associated stressors: <input type="text" name="homicide4" value="<?php echo $check_res['homicide4']; ?>"></td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">Plan:</span> Age 1 st experienced: <input type="text" name="homicide5" value="<?php echo $check_res['homicide5']; ?>"> &emsp;&emsp; Other times experienced: <input type="text" name="homicide6" value="<?php echo $check_res['homicide6']; ?>"> &emsp;&emsp; Associated stressors: <input type="text" name="homicide7" value="<?php echo $check_res['homicide7']; ?>"></td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">History:</span> Age 1 st experienced: <input type="text" name="homicide8" value="<?php echo $check_res['homicide8']; ?>"> &emsp;Other times experienced: <input type="text" name="homicide9" value="<?php echo $check_res['homicide9']; ?>"> &emsp; Associated stressors: <input type="text" name="homicide10" value="<?php echo $check_res['homicide10']; ?>"></td>
          </tr>
          <tr>
            <td> Age at additional attempts: <input type="text" name="homicide11" value="<?php echo $check_res['homicide11']; ?>"> &emsp;Associated stressors? <input type="text" name="homicide12" value="<?php echo $check_res['homicide12']; ?>"> </td>
          </tr>
          <tr>
            <td>Has a family member attempted or completed homicidal actions? <input type="checkbox" class="yes_no" name="homicide13" value="1" <?php
        if($check_res['homicide13']=="1"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="homicide14" value="2" <?php
        if($check_res['homicide14']=="2"){
         echo "checked";
        }?>>Yes</td>
          </tr>
          <tr>
            <td> If yes, please explain: <input type="text" name="homicide15" value="<?php echo $check_res['homicide15']; ?>"> </td>
          </tr>
          <tr>
            <td><br> How bothered are you by your mental health? Not at all <input type="text" name="homicide16" value="<?php echo $check_res['homicide16']; ?>"> </td>
          </tr>
          <tr>
            <td> How important to you is treatment for your mental health? Not at all <input type="text" name="homicide17" value="<?php echo $check_res['homicide17']; ?>"> </td>
          </tr>

          <tr>
            <td style="text-decoration: underline;">OCCUPATION/SCHOOL</td>
          </tr>
          <tr>
            <td>Highest level of education: <input type="text" name="occupation_school1" value="<?php echo $check_res['occupation_school1']; ?>"> &emsp;&emsp; Are you currently in school? <input type="checkbox" class="yes_no" name="occupation_school1" value="1" <?php
        if($check_res['occupation_school3']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" class="yes_no" name="occupation_school3" value="2" <?php
        if($check_res['occupation_school3']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>Are you presenting working? &emsp; <input type="checkbox" name="occupation_school4" class="yes_no" value="1" <?php
        if($check_res['occupation_school4']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" class="yes_no" name="occupation_school5" value="2" <?php
        if($check_res['occupation_school5']=="2"){
         echo "checked";
        }?>>No <input type="checkbox" class="yes_no" name="occupation_school6" value="3" <?php
        if($check_res['occupation_school6']=="3"){
         echo "checked";
        }?>>Full-time <input type="checkbox" class="yes_no" name="occupation_school7" value="4" <?php
        if($check_res['occupation_school7']=="4"){
         echo "checked";
        }?>>Part-time &emsp;&emsp;&emsp;&emsp; Where? <input type="text" name="occupation_school8" value="<?php echo $check_res['8']; ?>"></td>
          </tr>
          <tr>
            <td>Longest full time job? <input type="text" name="occupation_school9" value="<?php echo $check_res['occupation_school9']; ?>"> &emsp;&emsp; Where? <input type="text" name="occupation_school10" value="<?php echo $check_res['occupation_school10']; ?>"></td>
          </tr>
          <tr>
            <td> Has your substance use ever affect your performance at work/school? <input type="checkbox" name="occupation_school11" class="yes_no" value="1" <?php
        if($check_res['occupation_school11']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="occupation_school12" class="yes_no" value="2" <?php
        if($check_res['occupation_school12']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td> If yes, impact on performance: <input type="checkbox" name="occupation_school13" value="1" <?php
        if($check_res['occupation_school13']=="1"){
         echo "checked";
        }?>>Mild <input type="checkbox" name="occupation_school14" value="2" <?php
        if($check_res['occupation_school14']=="2"){
         echo "checked";
        }?>>Moderate <input type="checkbox" name="occupation_school15" value="3" <?php
        if($check_res['occupation_school15']=="3"){
         echo "checked";
        }?>>Severe</td>
          </tr>
          <tr>
            <td>Explain: <input type="text" name="occupation_school16" value="<?php echo $check_res['occupation_school16']; ?>"></td>
          </tr>
          <tr>
            <td>Other financial supports: <input type="text" name="occupation_school17" value="<?php echo $check_res['occupation_school17']; ?>"></td>
          </tr>
          <tr>
            <td>Financial dependents: <input type="text" name="occupation_school18" value="<?php echo $check_res['occupation_school18']; ?>"></td>
          </tr>
          <tr>
            <td>Number of days worked in the last 30 days: <input type="text" name="occupation_school19" value="<?php echo $check_res['occupation_school19']; ?>"></td>
          </tr>

          <tr>
            <td><br><br>Developmental History</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="developmental_history1" value="1" <?php
        if($check_res['developmental_history1']=="1"){
         echo "checked";
        }?>>Special Education <input type="checkbox" name="developmental_history2" value="2" <?php
        if($check_res['developmental_history2']=="2"){
         echo "checked";
        }?>>IEP in school <input type="checkbox" name="developmental_history3" value="3" <?php
        if($check_res['developmental_history3']=="3"){
         echo "checked";
        }?>>Did you attend an alternate high school/out of district placement?</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="developmental_history4" value="1" <?php
        if($check_res['developmental_history4']=="1"){
         echo "checked";
        }?>>Intellectual/Learning Disability <input type="checkbox" name="developmental_history5" value="2" <?php
        if($check_res['developmental_history5']=="2"){
         echo "checked";
        }?>>Cognitive Deficits <input type="checkbox" name="developmental_history6" value="3" <?php
        if($check_res['developmental_history6']=="3"){
         echo "checked";
        }?>>FASD <input type="checkbox" name="developmental_history7" value="4" <?php
        if($check_res['developmental_history7']=="4"){
         echo "checked";
        }?>>ADHD/ADD <input type="checkbox" name="developmental_history8" value="5" <?php
        if($check_res['developmental_history8']=="5"){
         echo "checked";
        }?>>Documents provided <input type="checkbox" name="developmental_history9" value="6" <?php
        if($check_res['developmental_history9']=="6"){
         echo "checked";
        }?>>Client denies</td>
          </tr>
          <tr>
            <td>Physician/Psychologist name: <input type="text" name="developmental_history10" value="<?php echo $check_res['developmental_history10']; ?>"> &emsp;&emsp;Age formally tested: <input type="text" name="developmental_history11" value="<?php echo $check_res['developmental_history11']; ?>"></td>
          </tr>
          <tr>
            <td>Additional notes: <input type="text" name="developmental_history12" value="<?php echo $check_res['developmental_history12']; ?>"></td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>FAMILY</td>
          </tr>
          <tr>
            <td>Describe your upbringing (biological, adopted, siblings, etc.): <input type="text" name="family1" value="<?php echo $check_res['family1']; ?>"></td>
          </tr>
          <tr>
            <td>Describe your current family: <input type="text" name="family2" value="<?php echo $check_res['family2']; ?>"></td>
          </tr>

          <tr>
            <td><br>Who in your family/household has substance abuse/mental health issues?</td>
          </tr>
          <tr>
            <td>Relationship: <input type="text" name="family3"  value="<?php echo $check_res['family3']; ?>">&emsp;&emsp;&emsp; Issue:<input type="text" name="family4" value="<?php echo $check_res['family4']; ?>">&emsp;&emsp;&emsp;Living with you? <input type="checkbox" name="family5" class="yes_no1" value="1" <?php
        if($check_res['family5']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="family6" class="yes_no1" value="2" <?php
        if($check_res['family6']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>Relationship: <input type="text" name="family7" value="<?php echo $check_res['family7']; ?>">&emsp;&emsp;&emsp; Issue: <input type="text" name="family8" value="<?php echo $check_res['family8']; ?>">&emsp;&emsp;&emsp;Living with you? <input type="checkbox" name="family9" class="yes_no2" value="1" <?php
        if($check_res['family9']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" class="yes_no2" name="family10" value="2" <?php
        if($check_res['family10']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>Relationship: <input type="text" name="family11" value="<?php echo $check_res['family11']; ?>">&emsp;&emsp;&emsp; Issue: <input type="text" name="family12" value="<?php echo $check_res['family12']; ?>">&emsp;&emsp;&emsp;Living with you? <input type="checkbox" name="family13" class="yes_no3" value="1" <?php
        if($check_res['family13']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="family14" class="yes_no3" value="2" <?php
        if($check_res['family14']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>

          <tr>
            <td><br>In the past 30 days have you had significant periods in which you have experienced serious problems getting along with:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="family15" value="1" <?php
        if($check_res['family15']=="1"){
         echo "checked";
        }?>>Mother <input type="checkbox" name="family16" value="2" <?php
        if($check_res['family16']=="2"){
         echo "checked";
        }?>>Father <input type="checkbox" name="family17" value="3" <?php
        if($check_res['family17']=="3"){
         echo "checked";
        }?>>Brothers <input type="checkbox" name="family18" value="4" <?php
        if($check_res['family18']=="4"){
         echo "checked";
        }?>>Sisters <input type="checkbox" name="family19" value="5" <?php
        if($check_res['family19']=="5"){
         echo "checked";
        }?>>Sexual partner/spouse <input type="checkbox" name="family20" value="6" <?php
        if($check_res['family20']=="6"){
         echo "checked";
        }?>>Children <input type="checkbox" name="family21" value="7" <?php
        if($check_res['family21']=="7"){
         echo "checked";
        }?>>Other significant family <input type="checkbox" name="family22" value="8" <?php
        if($check_res['family22']=="8"){
         echo "checked";
        }?>>Close friends</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="family23" value="9" <?php
        if($check_res['family23']=="9"){
         echo "checked";
        }?>>Neighbors <input type="checkbox" name="family24" value="10" <?php
        if($check_res['family24']=="10"){
         echo "checked";
        }?>>Co-workers <input type="checkbox" name="family25" value="11" <?php
        if($check_res['family25']=="11"){
         echo "checked";
        }?>>Client denies</td>
          </tr>

          <tr>
            <td><br>In your lifetime have you had significant periods in which you have experienced serious problems getting along with:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="family26" value="1" <?php
        if($check_res['family26']=="1"){
         echo "checked";
        }?>>Mother <input type="checkbox" name="family27" value="2" <?php
        if($check_res['family27']=="2"){
         echo "checked";
        }?>>Father <input type="checkbox" name="family28" value="3" <?php
        if($check_res['family28']=="3"){
         echo "checked";
        }?>>Brothers <input type="checkbox" name="family29" value="4" <?php
        if($check_res['family29']=="4"){
         echo "checked";
        }?>>Sisters <input type="checkbox" name="family30" value="5" <?php
        if($check_res['family30']=="5"){
         echo "checked";
        }?>>Sexual partner/spouse <input type="checkbox" name="family31" value="6" <?php
        if($check_res['family31']=="6"){
         echo "checked";
        }?>>Children <input type="checkbox" name="family32" value="7" <?php
        if($check_res['family32']=="7"){
         echo "checked";
        }?>>Other significant family <input type="checkbox" name="family33" value="8" <?php
        if($check_res['family33']=="8"){
         echo "checked";
        }?>>Close friends</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="family34" value="9" <?php
        if($check_res['family34']=="9"){
         echo "checked";
        }?>>Neighbors <input type="checkbox" name="family35" value="10" <?php
        if($check_res['family35']=="10"){
         echo "checked";
        }?>>Co-workers <input type="checkbox" name="family36" value="11" <?php
        if($check_res['family36']=="11"){
         echo "checked";
        }?>>Client denies</td>
          </tr>
          <tr>
            <td>Is your relationship with your family/household members negatively impacted? <input type="checkbox" name="family37" class="yes_no" value="1" <?php
        if($check_res['family37']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="family38" class="yes_no" value="2" <?php
        if($check_res['homicide1']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>If yes, how? <input type="text" name="family39" value="<?php echo $check_res['family39']; ?>"></td>
          </tr>
          <tr>
            <td>What does your family/household members think about your substance use? Are they supportive? <input type="text" name="family40" value="<?php echo $check_res['family40']; ?>"></td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>SOCIAL</td>
          </tr>
          <tr>
            <td>How many close friends do you have? Do any of them use? <input type="text" name="social1" value="<?php echo $check_res['social1']; ?>"></td>
          </tr>
          <tr>
            <td>Are your social relationships negatively impacted? <input type="checkbox" name="social2" class="yes_no" value="1" <?php
        if($check_res['social2']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" class="yes_no" name="social3" value="2" <?php
        if($check_res['social3']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>Explain: <input type="text" name="social4" value="<?php echo $check_res['social4']; ?>"></td>
          </tr>

          <tr>
            <td><br>Do you spend most of your free time with: <input type="checkbox" name="social5" value="1" <?php
        if($check_res['social5']=="1"){
         echo "checked";
        }?>>Friends <input type="checkbox" name="social6" value="2" <?php
        if($check_res['social6']=="1"){
         echo "checked";
        }?>>Family <input type="checkbox" name="social7" value="3" <?php
        if($check_res['social7']=="1"){
         echo "checked";
        }?>>Alone</td>
          </tr>
          <tr>
            <td>Who do you turn to when you are troubled? <input type="text" name="social8" value="<?php echo $check_res['social8']; ?>"></td>
          </tr>
          <tr>
            <td>Who will be your collateral contact(s) during your time in treatment? <input type="text" name="social9" value="<?php echo $check_res['social9']; ?>"></td>
          </tr>
          <tr>
            <td>Release signed? <input type="checkbox" name="social10" value="1" <?php
        if($check_res['social10']=="1"){
         echo "checked";
        }?>>Yes </td>
          </tr>

          <tr>
            <td><br>How bothered are you by your family issues? Not at all <input type="text" name="social11" value="<?php echo $check_res['social11']; ?>"> Social issues? Not at all <input type="text" name="social12" value="<?php echo $check_res['social12']; ?>"></td>
          </tr>
          <tr>
            <td>How important is treatment for your family issues? Not at all <input type="text" name="social13" value="<?php echo $check_res['social13']; ?>"> Social issues? Not at all <input type="text" name="social14" value="<?php echo $check_res['social14']; ?>"></td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>ABUSE HISTORY</td>
          </tr>
          <tr>
            <td>Emotional: <input type="text" name="abuse_history1" value="<?php echo $check_res['abuse_history1']; ?>"></td>
          </tr>
          <tr>
            <td>Physical: <input type="text" name="abuse_history2" value="<?php echo $check_res['abuse_history2']; ?>"></td>
          </tr>
          <tr>
            <td>Sexual: <input type="text" name="abuse_history3" value="<?php echo $check_res['abuse_history3']; ?>"></td>
          </tr>

          <tr>
            <td style="text-decoration: underline;">DOMESTIC VIOLENCE</td>
          </tr>
          <tr>
            <td>Have you ever received a temporary or final restraining order against you? <input type="checkbox" name="dome_voil1" class="yes_no" value="1" <?php
        if($check_res['dome_voil1']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox"  class="yes_no" name="dome_voil2" value="2" <?php
        if($check_res['dome_voil2']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>Have you ever filed a restraining or final restraining order against anyone? <input type="checkbox" name="dome_voil3" class="yes_no" value="1" <?php
        if($check_res['dome_voil3']=="1"){
         echo "checked";
        }?>>Yes <input type="checkbox" name="dome_voil4" class="yes_no" value="2" <?php
        if($check_res['dome_voil4']=="2"){
         echo "checked";
        }?>>No</td>
          </tr>
          <tr>
            <td>Explain: <input type="text" name="dome_voil5" value="<?php echo $check_res['dome_voil5']; ?>"></td>
          </tr>
          <tr>
            <td>Additional notes: <input type="text" name="dome_voil6" value="<?php echo $check_res['dome_voil6']; ?>"></td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>PAIN ASSESSMENT</td>
          </tr>
          <tr>
            <td>Previous treatment for chronic pain: <input type="text" name="pain_assess1" value="<?php echo $check_res['pain_assess1']; ?>"></td>
          </tr>
          <tr>
            <td>Providers Name: <input type="text" name="pain_assess2" value="<?php echo $check_res['pain_assess2']; ?>"></td>
          </tr>
          <tr>
            <td>Previous treatment for chronic pain: <input type="text" name="pain_assess3" value="<?php echo $check_res['pain_assess3']; ?>"></td>
          </tr>
          <tr>
            <td>Rate of pain (1-10 scale): <input type="checkbox" name="pain_assess4" value="1" <?php
        if($check_res['pain_assess4']=="1"){
         echo "checked";
        }?>>1 <input type="checkbox" name="pain_assess5" class="yes_no" value="2" <?php
        if($check_res['pain_assess5']=="2"){
         echo "checked";
        }?>>2 <input type="checkbox" name="pain_assess6" class="yes_no" value="3" <?php
        if($check_res['pain_assess6']=="3"){
         echo "checked";
        }?>>3 <input type="checkbox" name="pain_assess7" class="yes_no" value="4" <?php
        if($check_res['pain_assess7']=="4"){
         echo "checked";
        }?>>4 <input type="checkbox" name="pain_assess8" class="yes_no" value="5" <?php
        if($check_res['pain_assess8']=="5"){
         echo "checked";
        }?>>5 <input type="checkbox" name="pain_assess9" class="yes_no" value="6" <?php
        if($check_res['pain_assess9']=="6"){
         echo "checked";
        }?>>6 <input type="checkbox" name="pain_assess10" class="yes_no" value="7" <?php
        if($check_res['pain_assess10']=="7"){
         echo "checked";
        }?>>7 <input type="checkbox" name="pain_assess11" class="yes_no" value="8" <?php
        if($check_res['pain_assess11']=="8"){
         echo "checked";
        }?>>8 <input type="checkbox" name="pain_assess12" class="yes_no" value="9" <?php
        if($check_res['pain_assess12']=="9"){
         echo "checked";
        }?>>9 <input type="checkbox" name="pain_assess13" class="yes_no" value="10" <?php
        if($check_res['pain_assess13']=="10"){
         echo "checked";
        }?>>10</td>
          </tr>

          <tr>
            <td><br>Current care (reason): <input type="text" name="pain_assess14" value="<?php echo $check_res['pain_assess14']; ?>"></td>
          </tr>
          <tr>
            <td>Primary Care/Other: <input type="text" name="pain_assess15" value="<?php echo $check_res['pain_assess15']; ?>"></td>
          </tr>
          <tr>
            <td>Psychiatrist: <input type="text" name="pain_assess16" value="<?php echo $check_res['pain_assess16']; ?>"></td>
          </tr>
          <tr>
            <td>Therapist: <input type="text" name="pain_assess17" value="<?php echo $check_res['pain_assess17']; ?>"></td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>LEGAL HISTORY</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="legal_history1" value="1" <?php
        if($check_res['legal_history1']=="1"){
         echo "checked";
        }?>>DUI’s &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="legal_history2" value="2" <?php
        if($check_res['legal_history2']=="2"){
         echo "checked";
        }?>>Arrests &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="legal_history3" value="3" <?php
        if($check_res['legal_history3']=="3"){
         echo "checked";
        }?>>Incarcerations &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="legal_history4" value="4" <?php
        if($check_res['legal_history4']=="4"){
         echo "checked";
        }?>>Convictions &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="legal_history5" value="5" <?php
        if($check_res['legal_history5']=="5"){
         echo "checked";
        }?>>Probation</td>
          </tr>
          <tr>
            <td>Explain: <input type="text" name="legal_history6" value="<?php echo $check_res['legal_history6']; ?>"></td>
          </tr>
          <tr>
            <td>How many times have you been charged with a crime? <input type="text" name="legal_history7" value="<?php echo $check_res['legal_history7']; ?>"></td>
          </tr>
          <tr>
            <td>Do you feel your legal problems are due to substance use? <input type="text" name="legal_history8" value="<?php echo $check_res['legal_history8']; ?>"></td>
          </tr>

          <tr>
            <td><br>How bothered are you by your legal issues? Not at all <input type="text" name="legal_history9" value="<?php echo $check_res['legal_history9']; ?>"></td>
          </tr>
          <tr>
            <td>How important to you is treatment for your legal issues? Not at all <input type="text" name="legal_history10" value="<?php echo $check_res['legal_history10']; ?>"></td>
          </tr>

          <tr>
            <td><br>SNAP ASSESSMENT</td>
          </tr>
          <tr>
            <td>Client’s Strengths: <input type="text" name="snap_assessment1" value="<?php echo $check_res['snap_assessment1']; ?>"></td>
          </tr>
          <tr>
            <td>Client’s Needs: <input type="text" name="snap_assessment2" value="<?php echo $check_res['snap_assessment2']; ?>"></td>
          </tr>
          <tr>
            <td>Client’s Abilities: <input type="text" name="snap_assessment3" value="<?php echo $check_res['snap_assessment3']; ?>"></td>
          </tr>
          <tr>
            <td>Client’s Preferences: <input type="text" name="snap_assessment4" value="<?php echo $check_res['snap_assessment4']; ?>"></td>
          </tr>

          <tr>
            <td><br>Mental Status Examination (check as appropriate)</td>
          </tr>
          <tr>
            <td style="font-size:12px; font-style: italic;">Please be prepared to write out and give support for your assessment, i.e., Client appears well groomed, bizarre, and inappropriate. Client was</td>
          </tr>
          <tr>
            <td style="font-size:12px; font-style: italic;">dressed for summer weather, wearing shorts and open shoes despite the cold temperature/winter season.</td>
          </tr>

          <tr>
            <td style="padding-bottom: 8px;"><br>Appearance: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="appearance1" value="1" <?php
        if($check_res['appearance1']=="1"){
         echo "checked";
        }?>>Well-groomed &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="appearance2" value="2" <?php
        if($check_res['appearance2']=="2"){
         echo "checked";
        }?>>Disheveled &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="appearance3" value="3" <?php
        if($check_res['homicide1']=="3"){
         echo "checked";
        }?>>Bizarre &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="appearance4" value="4" <?php
        if($check_res['appearance14']=="4"){
         echo "checked";
        }?>>Inappropriate: <input type="text" name="appearance5" value="<?php echo $check_res['appearance5']; ?>"></td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Attention: &emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="attention1" value="1" <?php
        if($check_res['attention1']=="1"){
         echo "checked";
        }?>>Normal &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="attention2" value="2" <?php
        if($check_res['attention2']=="2"){
         echo "checked";
        }?>>Easily distracted</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Concentration: &emsp;&emsp;&emsp;<input type="checkbox" name="concentration1" value="1" <?php
        if($check_res['concentration1']=="1"){
         echo "checked";
        }?>>Good &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="concentration2" value="2" <?php
        if($check_res['concentration2']=="2"){
         echo "checked";
        }?>>Trouble concentrating</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Hallucinations: &emsp;&emsp;&emsp;<input type="checkbox" name="hallucinations1" value="1" <?php
        if($check_res['hallucinations1']=="1"){
         echo "checked";
        }?>>None &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="hallucinations2" value="2" <?php
        if($check_res['hallucinations2']=="2"){
         echo "checked";
        }?>>Auditory &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="hallucinations3" value="3" <?php
        if($check_res['hallucinations3']=="3"){
         echo "checked";
        }?>>Visual &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="hallucinations4" value="4" <?php
        if($check_res['hallucinations4']=="4"){
         echo "checked";
        }?>>Olfactory &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="hallucinations5" value="5" <?php
        if($check_res['hallucinations5']=="5"){
         echo "checked";
        }?>>Command: <input type="text" name="hallucinations6" value="<?php echo $check_res['hallucinations6']; ?>"></td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Delusions: &emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="delusions1" value="1" <?php
        if($check_res['delusions1']=="1"){
         echo "checked";
        }?>>None &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="delusions2" value="2" <?php
        if($check_res['delusions2']=="2"){
         echo "checked";
        }?>>Paranoid &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="delusions3" value="3" <?php
        if($check_res['delusions3']=="3"){
         echo "checked";
        }?>>Grandeur &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="delusions4" value="4" <?php
        if($check_res['delusions4']=="4"){
         echo "checked";
        }?>>Reference &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="delusions5" value="5" <?php
        if($check_res['delusions5']=="5"){
         echo "checked";
        }?>>Other: <input type="text" name="delusions6" value="<?php echo $check_res['delusions6']; ?>" ></td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Memory: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="memory1" value="1" <?php
        if($check_res['memory1']=="1"){
         echo "checked";
        }?>>Intact <input type="checkbox" name="memory2" value="2" <?php
        if($check_res['memory2']=="2"){
         echo "checked";
        }?>>Impaired (check appropriate) &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="memory3" value="3" <?php
        if($check_res['memory3']=="3"){
         echo "checked";
        }?>>Immediate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="memory4" value="4" <?php
        if($check_res['memory4']=="4"){
         echo "checked";
        }?>>Recent &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="memory5" value="5" <?php
        if($check_res['memory5']=="5"){
         echo "checked";
        }?>>Remote</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Intelligence: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="intelligence1" value="1" <?php
        if($check_res['intelligence1']=="1"){
         echo "checked";
        }?>>Appears normal &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="intelligence2" value="" <?php
        if($check_res['intelligence2']=="2"){
         echo "checked";
        }?>>Low intelligence:<input type="text" name="intelligence3" value="<?php echo $check_res['intelligence3']; ?>"></td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Orientation: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="orientation1" value="1" <?php
        if($check_res['orientation1']=="1"){
         echo "checked";
        }?>>All spheres &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="orientation2" value="2" <?php
        if($check_res['orientation2']=="2"){
         echo "checked";
        }?>>Impaired (check appropriate) &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="orientation3" value="3" <?php
        if($check_res['orientation3']=="3"){
         echo "checked";
        }?>>Person &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="orientation4" value="4" <?php
        if($check_res['orientation4']=="4"){
         echo "checked";
        }?>>Place &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="orientation5" value="5" <?php
        if($check_res['orientation5']=="5"){
         echo "checked";
        }?>>Time</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Social judgement: &emsp;&emsp;<input type="checkbox" name="social_judgement1" value="1" <?php
        if($check_res['social_judgement1']=="1"){
         echo "checked";
        }?>>Appropriate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="social_judgement2" value="2" <?php
        if($check_res['social_judgement2']=="2"){
         echo "checked";
        }?>>Impaired &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="social_judgement3" value="3" <?php
        if($check_res['social_judgement3']=="3"){
         echo "checked";
        }?>>Harmful &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="social_judgement4" value="4" <?php
        if($check_res['social_judgement4']=="4"){
         echo "checked";
        }?>>Unacceptable &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="social_judgement5" value="5" <?php
        if($check_res['social_judgement5']=="5"){
         echo "checked";
        }?>>Unknown</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Insight: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="insight1" value="1" <?php
        if($check_res['insight11']=="1"){
         echo "checked";
        }?>>Good &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="insight2" value="2" <?php
        if($check_res['insight2']=="2"){
         echo "checked";
        }?>>Fair &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="insight3" value="3" <?php
        if($check_res['insight3']=="3"){
         echo "checked";
        }?>>Poor &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="insight4" value="4" <?php
        if($check_res['insight4']=="4"){
         echo "checked";
        }?>>Denial &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="insight5" value="5" <?php
        if($check_res['insight5']=="5"){
         echo "checked";
        }?>>Blames others</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Impulse control: &emsp;&emsp;&emsp;<input type="checkbox" name="impulse_control1" value="1" <?php
        if($check_res['impulse_control1']=="1"){
         echo "checked";
        }?>>Intact &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="impulse_control2" value="2" <?php
        if($check_res['impulse_control2']=="2"){
         echo "checked";
        }?>>Poor &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="impulse_control3" value="3" <?php
        if($check_res['impulse_control3']=="3"){
         echo "checked";
        }?>>Unknown</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Thought content: ;&emsp;&emsp;&emsp;<input type="checkbox" name="	thought_content1" value="1" <?php
        if($check_res['	thought_content1']=="1"){
         echo "checked";
        }?>>Appropriate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="	thought_content2" value="2" <?php
        if($check_res['	thought_content2']=="2"){
         echo "checked";
        }?>>Suicide &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="	thought_content3" value="3" <?php
        if($check_res['	thought_content3']=="3"){
         echo "checked";
        }?>>Homicide &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="	thought_content4" value="4" <?php
        if($check_res['	thought_content4']=="4"){
         echo "checked";
        }?>>Illness &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="	thought_content5" value="5" <?php
        if($check_res['	thought_content5']=="5"){
         echo "checked";
        }?>>Obsessions &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="	thought_content6" value="6" <?php
        if($check_res['	thought_content6']=="6"){
         echo "checked";
        }?>>Fears</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="	thought_content7" value="7" <?php
        if($check_res['	thought_content7']=="7"){
         echo "checked";
        }?>>Compulsions &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="	thought_content8" value="8" <?php
        if($check_res['	thought_content8']=="8"){
         echo "checked";
        }?>>Somatic complaints &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="	thought_content9" value="9" <?php
        if($check_res['	thought_content9']=="9"){
         echo "checked";
        }?>>Other: <input type="text" name="thought_content10" value="<?php echo $check_res['thought_content10']; ?>"></td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Affect: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="affect1" value="1" <?php
        if($check_res['affect1']=="1"){
         echo "checked";
        }?>>Appropriate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="affect2" value="2" <?php
        if($check_res['affect2']=="2"){
         echo "checked";
        }?>>Flat &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="affect3" value="3" <?php
        if($check_res['affect3']=="3"){
         echo "checked";
        }?>>Tearful &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="affect4" value="4" <?php
        if($check_res['affect4']=="4"){
         echo "checked";
        }?>>Labile &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="affect5" value="5" <?php
        if($check_res['affect5']=="5"){
         echo "checked";
        }?>>Inappropriate: <input type="text" name="affect6" value="<?php echo $check_res['affect6']; ?>"></td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Mood: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="mood1" value="1" <?php
        if($check_res['mood1']=="1"){
         echo "checked";
        }?>>Euthymic &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="mood2" value="2" <?php
        if($check_res['mood2']=="2"){
         echo "checked";
        }?>>Depressed &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="mood3" value="3" <?php
        if($check_res['mood3']=="3"){
         echo "checked";
        }?>>Manic &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="mood4" value="4" <?php
        if($check_res['mood4']=="4"){
         echo "checked";
        }?>>Euphoric <input type="checkbox" name="mood5" value="5" <?php
        if($check_res['mood5']=="5"){
         echo "checked";
        }?>>Irritable &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="mood6" value="6" <?php
        if($check_res['mood6']=="6"){
         echo "checked";
        }?>>Annoyed</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Speech: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="speech1" value="1" <?php
        if($check_res['speech1']=="1"){
         echo "checked";
        }?>>Normal &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="speech2" value="2" <?php
        if($check_res['speech2']=="2"){
         echo "checked";
        }?>>Slurred &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="speech3" value="3" <?php
        if($check_res['speech3']=="3"){
         echo "checked";
        }?>>Slow &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="speech4" value="4" <?php
        if($check_res['speech4']=="4"){
         echo "checked";
        }?>>Pressured &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="speech5" value="5" <?php
        if($check_res['speech5']=="5"){
         echo "checked";
        }?>>Loud</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Behavior: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="behavior1" value="1" <?php
        if($check_res['behavior1']=="1"){
         echo "checked";
        }?>>Appropriate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="behavior2" value="2" <?php
        if($check_res['behavior2']=="2"){
         echo "checked";
        }?>>Anxious &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="behavior3" value="3" <?php
        if($check_res['behavior3']=="3"){
         echo "checked";
        }?>>Agitated &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="behavior4" value="4" <?php
        if($check_res['behavior4']=="4"){
         echo "checked";
        }?>>Guarded &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="behavior5" value="5" <?php
        if($check_res['behavior5']=="5"){
         echo "checked";
        }?>>Hostile &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="behavior6" value="6" <?php
        if($check_res['behavior6']=="6"){
         echo "checked";
        }?>>Uncooperative</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Thought Disorder: &emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder1" value="1" <?php
        if($check_res['thought_disorder1']=="1"){
         echo "checked";
        }?>>Normal &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder2" value="2" <?php
        if($check_res['thought_disorder2']=="2"){
         echo "checked";
        }?>>Narcissistic &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder3" value="3" <?php
        if($check_res['thought_disorder3']=="3"){
         echo "checked";
        }?>>Paranoia &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder4" value="4" <?php
        if($check_res['thought_disorder4']=="4"){
         echo "checked";
        }?>>Ideas of reference &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder5" value="5" <?php
        if($check_res['thought_disorder5']=="5"){
         echo "checked";
        }?>>Tangential &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder6" value="6" <?php
        if($check_res['thought_disorder6']=="6"){
         echo "checked";
        }?>>Confusion</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder7" value="7" <?php
        if($check_res['thought_disorder7']=="7"){
         echo "checked";
        }?>>Loose associations &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder8" value="8" <?php
        if($check_res['thought_disorder8']=="8"){
         echo "checked";
        }?>>Thought blocking &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder9" value="9" <?php
        if($check_res['thought_disorder9']=="9"){
         echo "checked";
        }?>>Obsessions &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="thought_disorder10" value="10" <?php
        if($check_res['thought_disorder10']=="10"){
         echo "checked";
        }?>>Flight of ideas</td>
          </tr>

          <tr>
            <td><br>Other clinician observations: <input type="text" name="clinician_observations" value="<?php echo $check_res['clinician_observations']; ?>"></td>
          </tr>
        </table>

        <table style="width:100%;">
          <tr>
            <td style="width:40%; border: 1px solid black; text-align: center;">Please print Name</td>
            <td style="width:20%; border: 1px solid black; text-align: center;">Date</td>
            <td style="width:40%; border: 1px solid black; text-align: center;">Signature</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height:50px;"><div contentEditable="true" class="text_edit"><?php 
              echo $check_res['text2']??'Clinician
              Daniel O’Connell, MSW, LSW, LCADC Intern';?>
              </div><input type="hidden" name="text2" id="text2"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="date" name="date1" value="<?php echo $check_res['date1']; ?>"></td>
            <td style="border: 1px solid black;">
              <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
              <i class="fas fa-search view_icon phy_icon" id="sign_1" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i>
              <input type="hidden" id="sign1" name="sign1" value="<?php echo text($check_res['sign1']); ?>" style="width: 50%;" class="ml-2" />
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height:50px;"><div contentEditable="true" class="text_edit"><?php 
              echo $check_res['text1']??'Clinical Supervisor
              Eddie Mann, MSW, LCSW, LCADC, CCS';?>
              </div><input type="hidden" name="text1" id="text1"></td>
            <td style="border: 1px solid black;"><input style="border:none;" type="date" name="date2" value="<?php echo $check_res['date2']; ?>"></td>
            <td style="border: 1px solid black;">
              <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
              <i class="fas fa-search view_icon phy_icon" id="sign_2" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i>
              <input type="hidden" id="sign2" name="sign2" value="<?php echo text($check_res['sign2']); ?>" style="width: 50%;" class="ml-2" />
            </td>
          </tr>
        </table>

        <br><br>
        <div class="btndiv">
          <input type="submit" value="Submit" id="btn-save" class="subbtn">
          <button class="cancel" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
        </div>
      </form>

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
    $('input.yes_no').on('click', function() {
      $(this).parent().parent().find('.yes_no').prop('checked', false);
      $(this).prop('checked', true)
    });
    $('input.yes_no1').on('click', function() {
      $(this).parent().parent().find('.yes_no1').prop('checked', false);
      $(this).prop('checked', true)
    });
    $('input.yes_no2').on('click', function() {
      $(this).parent().parent().find('.yes_no2').prop('checked', false);
      $(this).prop('checked', true)
    });
    $('input.yes_no3').on('click', function() {
      $(this).parent().parent().find('.yes_no3').prop('checked', false);
      $(this).prop('checked', true)
    });

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
    $('#btn-save') .on('click',function(){
     $('.text_edit').each(function(){
         //alert();
         var dataval = $(this).html();
         $(this).next("input").val(dataval);
         
     });

 });
</script>

</html>
