<?php
   require_once(__DIR__ . "/../../globals.php");
   require_once("$srcdir/api.inc");
   require_once("$srcdir/patient.inc");
   require_once("$srcdir/options.inc.php");

   use OpenEMR\Common\Csrf\CsrfUtils;
   use OpenEMR\Core\Header;

  $returnurl = 'encounter_top.php';
  $formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
  if ($formid) {
      $sql = "SELECT * FROM `form_clinical_update` WHERE id=? AND pid = ? AND encounter = ?";
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
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Beck Anxiety Inventory</title>
      <!-- Latest compiled and minified CSS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
      <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
      <style type="text/css">
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
  </style>
</head>
<body>
    <div class="container mt-3">
    <div class="row" style="border:1px solid black;" ;>
      <div class="container-fluid">
        <br><br>
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/clinical_update_form/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%; text-align:center;">Clinical Upadte</h4></td>
         </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%; border:1px solid black;"><b>Patient Name:</b> <input type="text" name="pat_name" value="<?php echo $check_res['pat_name']; ?>"></td>
            <td style="width:25%; border:1px solid black;"><b>DOB:</b> <input type="date" name="dob" value="<?php echo $check_res['dbo']; ?>"></td>
            <td style="width:25%; border:1px solid black;"><b>Date:</b> <input type="date" name="clinical_date" value="<?php echo $check_res['clinical_date']; ?>"></td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:80%; border:1px solid black;"><input type="text" name="clinical1" value="<?php echo $check_res['clinical1']; ?>"></td>
          </tr>
          <tr>
            <td style="width:80%; border:1px solid black;"><input type="text" name="clinical2" value="<?php echo $check_res['clinical2']; ?>"></td>
          </tr>
          <tr>
            <td style="width:80%; border:1px solid black;"><input type="text" name="clinical3" value="<?php echo $check_res['clinical3']; ?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:33%; border:1px solid black;"><b>Blood pressure:</b><input type="text" name="check1" value="<?php echo $check_res['check1']; ?>"></td>
            <td style="width:33%; border:1px solid black;"><b>Pulse </b><input type="text" name="check2" value="<?php echo $check_res['check2']; ?>"></td>
            <td style="width:33%; border:1px solid black;"><b>Respirations: <b><input type="text" name="check3" value="<?php echo $check_res['check3']; ?>"></td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:50%; border:1px solid black;"><b>CIWA Score:</b><input type="text" name="check4" value="<?php echo $check_res['check4']; ?>"></td>
            <td style="width:50%; border:1px solid black;"><b>COW Score:</b><input type="text" name="check5" value="<?php echo $check_res['check5']; ?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:10%; border:1px solid black;"><b>Medication</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Dose</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Route</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Frequency</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Quantity</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Last dose</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Brought in on admission</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Continue on admission</b> </td>
            <td style="width:10%; border:1px solid black;"><b>Continue on discharge</b> </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>1. List Medications</b></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Anti-craving medications prescribed?</b><input type="checkbox" name="anti1" value="1" <?php
            if($check_res['anti1']=="1"){
            echo "checked";
            }?>> Naltrexone <input type="checkbox" name="anti2" value="2" <?php
            if($check_res['anti2']=="2"){
            echo "checked";
            }?>> Vivitrol <input type="checkbox" name="anti3" value="3" <?php
            if($check_res['anti3']=="3"){
            echo "checked";
            }?>> other <input type="checkbox" name="anti4" value="4" <?php
            if($check_res['anti4']=="4"){
            echo "checked";
            }?>> none Dosage: <input type="text" name="anti5" value="<?php echo $check_res['anti5']; ?>"></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">If none, why? Patient is currently on withdrawal medications</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Compliant with Medications?</b><input type="checkbox" name="compliant1" class="yes_no" value="1" <?php
            if($check_res['compliant1']=="1"){
            echo "checked";
            }?>> yes <input type="checkbox" name="compliant2" class="yes_no" value="2" <?php
            if($check_res['compliant2']=="2"){
            echo "checked";
            }?>> no if no, please explain: <input type="text" name="explain_no1" value="<?php echo $check_res['explain_no1']??''; ?>"></td>
          </tr>
        </table>
        <br>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Contract for safety?</b><input type="checkbox" name="safety1" class="yes_no" value="1" <?php
            if($check_res['safety1']=="1"){
            echo "checked";
            }?>> yes <input type="checkbox" name="safety2" class="yes_no" value="2" <?php
            if($check_res['safety2']=="2"){
            echo "checked";
            }?>> no if no, please explain: <input type="text" name="explain_no2" value="<?php echo $check_res['explain_no2']??''; ?>"></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Current psychosis?</b><input type="checkbox" name="psychosis1" class="yes_no" value="1" <?php
            if($check_res['psychosis1']=="1"){
            echo "checked";
            }?>> yes <input type="checkbox" name="psychosis2" class="yes_no" value="2" <?php
            if($check_res['psychosis2']=="2"){
            echo "checked";
            }?>> no if no, please explain: <input type="text" name="explain_no3" value="<?php echo $check_res['explain_no3']??''; ?>"></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Current suicidal ideation/ plan/ intent?</b><input type="checkbox" name="suicidal_ideation1" class="yes_no" value="1" <?php
            if($check_res['suicidal_ideation1']=="1"){
            echo "checked";
            }?>> yes <input type="checkbox" name="suicidal_ideation2" class="yes_no" value="2" <?php
            if($check_res['suicidal_ideation2']=="2"){
            echo "checked";
            }?>> no if no, please explain: <input type="text" name="explain_no4" value="<?php echo $check_res['explain_no4']??''; ?>"></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Current homicidal ideation/ plan/ intent?</b><input type="checkbox" name="homicidal1" class="yes_no" value="1" <?php
            if($check_res['homicidal1']=="1"){
            echo "checked";
            }?>> yes <input type="checkbox" name="homicidal2" class="yes_no" value="2" <?php
            if($check_res['homicidal2']=="2"){
            echo "checked";
            }?>> no if no, please explain: <input type="text" name="explain_no5" value="<?php echo $check_res['explain_no5']??''; ?>"></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Medical complications?</b><input type="checkbox" name="medical1" class="yes_no" value="1" <?php
            if($check_res['medical1']=="1"){
            echo "checked";
            }?>> yes <input type="checkbox" name="medical2" class="yes_no" value="2" <?php
            if($check_res['medical2']=="2"){
            echo "checked";
            }?>> no if no, please explain: <input type="text" name="explain_no6" value="<?php echo $check_res['explain_no6']??''; ?>"></td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Symptoms</b> <input type="checkbox" name="symptoms1" value="1" <?php
              if($check_res['symptoms1']=="1"){
              echo "checked";
              }?>> nausea <input type="checkbox" name="symptoms2" value="2" <?php
              if($check_res['symptoms2']=="2"){
              echo "checked";
              }?>> vomiting <input type="checkbox" name="symptoms3" value="3" <?php
              if($check_res['symptoms3']=="3"){
              echo "checked";
              }?>> sweating
              <input type="checkbox" name="symptoms4" value="4" <?php
              if($check_res['symptoms4']=="4"){
              echo "checked";
              }?>> tremors
              <input type="checkbox" name="symptoms5" value="5" <?php
              if($check_res['symptoms5']=="5"){
              echo "checked";
              }?>> diarrhea
              <input type="checkbox" name="symptoms6" value="6" <?php
              if($check_res['symptoms6']=="6"){
              echo "checked";
              }?>> cramping
              <input type="checkbox" name="symptoms7" value="7" <?php
              if($check_res['symptoms7']=="7"){
              echo "checked";
              }?>> body aches
              <input type="checkbox" name="symptoms8" value="8" <?php
              if($check_res['symptoms8']=="8"){
              echo "checked";
              }?>> headache
              <input type="checkbox" name="symptoms9" value="9" <?php
              if($check_res['symptoms9']=="9"){
              echo "checked";
              }?>> unsteady gait
              <input type="checkbox" name="symptoms10" value="10" <?php
              if($check_res['symptoms10']=="10"){
              echo "checked";
              }?>> GI issues
              <input type="checkbox" name="symptoms11" value="11" <?php
              if($check_res['symptoms11']=="11"){
              echo "checked";
              }?>> psycho motor agitation
              <input type="checkbox" name="symptoms12" value="12" <?php
              if($check_res['symptoms12']=="12"){
              echo "checked";
              }?>> psycho motor retardation
              <input type="checkbox" name="symptoms13" value="13" <?php
              if($check_res['symptoms13']=="13"){
              echo "checked";
              }?>> runny nose
              <input type="checkbox" name="symptoms14" value="14" <?php
              if($check_res['symptoms14']=="14"){
              echo "checked";
              }?>> other:
            </td>
          </tr>
        </table>
        <br>
        <table style="width100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Current step(s) patient is working on: Patient is currently attending onsite AA meetings: State whether they are participating or not. State whether they are participating in meetings outside of treatment and how frequently.</b></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Temporary/ current sponsor: Currently has a sponsor or currently not seeking</b></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;"><b>Frequency of meetings</b><input type="checkbox" name="frequency1" class="yes_no" value="1" <?php
              if($check_res['frequency1']=="1"){
              echo "checked";
              }?>> daily
              <input type="checkbox" name="frequency2" class="yes_no" value="2" <?php
              if($check_res['frequency2']=="2"){
              echo "checked";
              }?>> weekly</td>
            <td style="width:50%; border:1px solid black;"><b>Total per week: 7 (onsite): Also how many times they are attending outside of treatment.</b></td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Appearance:</b><input type="checkbox" name="appearance1" class="yes_no" value="1" <?php
              if($check_res['appearance1']=="1"){
              echo "checked";
              }?>>appropriate
              <input type="checkbox" name="appearance2" class="yes_no" value="2" <?php
              if($check_res['appearance2']=="2"){
              echo "checked";
              }?>>well kempt <input type="checkbox" class="yes_no" name="appearance3" value="3" <?php
              if($check_res['appearance3']=="3"){
              echo "checked";
              }?>>disheveled <input type="checkbox" class="yes_no" name="appearance4" value="4" <?php
              if($check_res['appearance4']=="4"){
              echo "checked";
              }?>>bizarre <input type="checkbox" class="yes_no" name="appearance5" value="5" <?php
              if($check_res['appearance5']=="5"){
              echo "checked";
              }?>>odorous <input type="checkbox" class="yes_no" name="appearance6" value="6" <?php
              if($check_res['appearance6']=="6"){
              echo "checked";
              }?>>poor hygiene
              <p><b>Describe:</b> <input type="text" class="yes_no" name="appearance7" value="<?php echo $check_res['appearance7']; ?>"></p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Behavior:</b><input type="checkbox" name="behavior1" class="yes_no" value="1" <?php
              if($check_res['behavior1']=="1"){
              echo "checked";
              }?>>isolates
              <input type="checkbox" name="behavior2" value="2" <?php
              if($check_res['behavior2']=="2"){
              echo "checked";
              }?>>social withdrawal <input type="checkbox" class="yes_no" name="behavior3" value="3" <?php
              if($check_res['behavior3']=="3"){
              echo "checked";
              }?>>guarded/ defensive <input type="checkbox" class="yes_no" name="behavior4" value="4" <?php
              if($check_res['behavior4']=="4"){
              echo "checked";
              }?>>impulsive <input type="checkbox" class="yes_no" name="behavior5" value="5" <?php
              if($check_res['behavior5']=="5"){
              echo "checked";
              }?>>minimizing/ justifying <input class="yes_no" type="checkbox" name="behavior6" value="6" <?php
              if($check_res['behavior6']=="6"){
              echo "checked";
              }?>> med seeking <input type="checkbox" class="yes_no" name="behavior7" value="7" <?php
              if($check_res['behavior7']=="7"){
              echo "checked";
              }?>>Other: <input type="text" name="behavior8" class="yes_no" value="<?php echo $check_res['behavior8']; ?>">
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Musculoskeletal:&emsp;&emsp;
              <b>Strength/ Tone</b>
              <input type="checkbox" name="musculoskeletal1" class="yes_no1" value="1" <?php
              if($check_res['musculoskeletal1']=="1"){
              echo "checked";
              }?>> normal <input type="checkbox" class="yes_no1" name="musculoskeletal2" value="2" <?php
              if($check_res['musculoskeletal2']=="2"){
              echo "checked";
              }?>> abnormal  &emsp;&emsp; <b>Gait/Station</b>
              <input type="checkbox" name="musculoskeletal3" class="yes_no2" value="1" <?php
              if($check_res['musculoskeletal3']=="1"){
              echo "checked";
              }?>> normal <input type="checkbox" name="musculoskeletal4" class="yes_no2" value="2" <?php
              if($check_res['musculoskeletal4']=="2"){
              echo "checked";
              }?>> abnormal
              <p><b>Describe:</b> <input type="text" name="musculoskeletal5" value="<?php echo $check_res['musculoskeletal5']; ?>"></p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Attitude:
              <input type="checkbox" name="attitude1" class="yes_no" value="1" <?php
              if($check_res['attitude1']=="1"){
              echo "checked";
              }?>> cooperativeness <input type="checkbox" class="yes_no" name="attitude2" value="2" <?php
              if($check_res['attitude2']=="2"){
              echo "checked";
              }?>> relatedness <input type="checkbox" name="attitude3" class="yes_no" value="3" <?php
              if($check_res['attitude3']=="3"){
              echo "checked";
              }?>> good eye contact
              <p><b>Describe:</b> <input type="text" name="attitude4" value="<?php echo $check_res['attitude4']; ?>"></p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Motor:
              <input type="checkbox" name="motor1" value="1" <?php
              if($check_res['motor1']=="1"){
              echo "checked";
              }?>> normal <input type="checkbox" name="motor2" value="2" <?php
              if($check_res['motor2']=="2"){
              echo "checked";
              }?>> psychomotor agitation <input type="checkbox" name="motor3" value="3" <?php
              if($check_res['motor3']=="3"){
              echo "checked";
              }?>> psycho motor retardation <input type="checkbox" name="motor4" value="4" <?php
              if($check_res['motor4']=="4"){
              echo "checked";
              }?>> EPS <input type="checkbox" name="motor5" value="5" <?php
              if($check_res['motor5']=="5"){
              echo "checked";
              }?>> tremor <input type="checkbox" name="motor6" value="6" <?php
              if($check_res['motor6']=="6"){
              echo "checked";
              }?>> AIMS:
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Speech:
              <input type="checkbox" name="speech1" value="1" <?php
              if($check_res['speech1']=="1"){
              echo "checked";
              }?>> normal <input type="checkbox" name="speech2" value="2" <?php
              if($check_res['speech2']=="2"){
              echo "checked";
              }?>> latency <input type="checkbox" name="speech3" value="3" <?php
              if($check_res['speech3']=="3"){
              echo "checked";
              }?>> rate <input type="checkbox" name="speech4" value="4" <?php
              if($check_res['speech4']=="4"){
              echo "checked";
              }?>> tone <input type="checkbox" name="speech5" value="5" <?php
              if($check_res['speech5']=="5"){
              echo "checked";
              }?>> volume <input type="checkbox" name="speech6" value="6" <?php
              if($check_res['speech6']=="6"){
              echo "checked";
              }?>> stuttering <input type="checkbox" name="speech7" value="7" <?php
              if($check_res['speech7']=="7"){
              echo "checked";
              }?>> normal <input type="checkbox" name="speech8" value="8" <?php
              if($check_res['speech8']=="8"){
              echo "checked";
              }?>> hyperactive <input type="checkbox" name="speech9" value="9" <?php
              if($check_res['speech9']=="9"){
              echo "checked";
              }?>> retardation <input type="checkbox" name="speech10" value="10" <?php
              if($check_res['speech10']=="10"){
              echo "checked";
              }?>> stuttering
              <p><b>Describe:</b> <input type="text" name="speech11" value="<?php echo $check_res['speech11']; ?>"></p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Mood:
              <input type="checkbox" name="mood1" value="1" <?php
              if($check_res['mood1']=="1"){
              echo "checked";
              }?>>euthymic <input type="checkbox" name="mood2" value="2" <?php
              if($check_res['mood2']=="2"){
              echo "checked";
              }?>>depressed <input type="checkbox" name="mood3" value="3" <?php
              if($check_res['mood3']=="3"){
              echo "checked";
              }?>>hypomanic <input type="checkbox" name="mood4" value="4" <?php
              if($check_res['mood4']=="4"){
              echo "checked";
              }?>>euphoric <input type="checkbox" name="mood5" value="5" <?php
              if($check_res['mood5']=="5"){
              echo "checked";
              }?>>angry <input type="checkbox" name="mood6" value="6" <?php
              if($check_res['mood6']=="6"){
              echo "checked";
              }?>>anxious <input type="checkbox" name="mood7" value="7" <?php
              if($check_res['mood7']=="7"){
              echo "checked";
              }?>>labile <input type="checkbox" name="mood8" value="8" <?php
              if($check_res['mood8']=="8"){
              echo "checked";
              }?>>irritable <input type="checkbox" name="mood9" value="9" <?php
              if($check_res['mood9']=="9"){
              echo "checked";
              }?>>helpless <input type="checkbox" name="mood10" value="10" <?php
              if($check_res['mood10']=="10"){
              echo "checked";
              }?>>hopeless <input type="checkbox" name="mood11" value="11" <?php
              if($check_res['mood11']=="11"){
              echo "checked";
              }?>>other: <input type="text" name="mood12" value="<?php echo $check_res['mood12']; ?>">
              <p><b>Describe:</b> <input type="text" name="mood13" value="<?php echo $check_res['mood13']; ?>"></p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Affect:
              <input type="checkbox" name="affect1" value="1" <?php
              if($check_res['affect1']=="1"){
              echo "checked";
              }?>> appropriate <input type="checkbox" name="affect2" value="2" <?php
              if($check_res['affect2']=="2"){
              echo "checked";
              }?>> full <input type="checkbox" name="affect3" value="3" <?php
              if($check_res['affect3']=="3"){
              echo "checked";
              }?>> neutral <input type="checkbox" name="affect4" value="4" <?php
              if($check_res['affect4']=="4"){
              echo "checked";
              }?>> constricted <input type="checkbox" name="affect5" value="5" <?php
              if($check_res['affect5']=="5"){
              echo "checked";
              }?>> blunted/ flat <input type="checkbox" name="affect6" value="6" <?php
              if($check_res['affect6']=="6"){
              echo "checked";
              }?>> labile 
              <!-- <input type="checkbox" name="affect7" value="7" <?php
              if($check_res['affect7']=="7"){
              echo "checked";
              }?>> labile  -->
              <input type="checkbox" name="affect8" value="8" <?php
              if($check_res['affect8']=="8"){
              echo "checked";
              }?>> irritable <input type="checkbox" name="affect9" value="9" <?php
              if($check_res['affect9']=="9"){
              echo "checked";
              }?>> dysphoric <input type="checkbox" name="affect10" value="10" <?php
              if($check_res['affect10']=="10"){
              echo "checked";
              }?>> sad
              <p><b>Describe:</b> <input type="text" name="affect11" value="<?php echo $check_res['affect11']; ?>"></p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Thought Process:
              <input type="checkbox" name="thought_process1" value="1" <?php
              if($check_res['thought_process1']=="1"){
              echo "checked";
              }?>> coherent <input type="checkbox" name="thought_process2" value="2" <?php
              if($check_res['thought_process2']=="2"){
              echo "checked";
              }?>> soft <input type="checkbox" name="thought_process3" value="3" <?php
              if($check_res['thought_process3']=="3"){
              echo "checked";
              }?>> loud <input type="checkbox" name="thought_process4" value="4" <?php
              if($check_res['thought_process4']=="4"){
              echo "checked";
              }?>> rapid <input type="checkbox" name="thought_process5" value="5" <?php
              if($check_res['thought_process5']=="5"){
              echo "checked";
              }?>> slurred <input type="checkbox" name="thought_process6" value="6" <?php
              if($check_res['thought_process6']=="6"){
              echo "checked";
              }?>> unintelligible <input type="checkbox" name="thought_process7" value="7" <?php
              if($check_res['thought_process7']=="7"){
              echo "checked";
              }?>> linear/ goal-oriented <input type="checkbox" name="thought_process8" value="8" <?php
              if($check_res['thought_process8']=="8"){
              echo "checked";
              }?>> FOI <input type="checkbox" name="thought_process9" value="9" <?php
              if($check_res['thought_process9']=="9"){
              echo "checked";
              }?>> LOA <input type="checkbox" name="thought_process10" value="10" <?php
              if($check_res['thought_process10']=="10"){
              echo "checked";
              }?>> word salad
              <input type="checkbox" name="thought_process11" value="11" <?php
              if($check_res['thought_process11']=="11"){
              echo "checked";
              }?>> neologism  <input type="checkbox" name="thought_process12" value="12" <?php
              if($check_res['thought_process12']=="12"){
              echo "checked";
              }?>> pre-occupied <input type="checkbox" name="thought_process13" value="13" <?php
              if($check_res['thought_process13']=="13"){
              echo "checked";
              }?>> difficulty concentrating <input type="checkbox" name="thought_process14" value="14" <?php
              if($check_res['thought_process14']=="14"){
              echo "checked";
              }?>> disorganized <input type="checkbox" name="thought_process15" value="15" <?php
              if($check_res['thought_process15']=="15"){
              echo "checked";
              }?>> illogical <input type="checkbox" name="thought_process16" value="16" <?php
              if($check_res['thought_process16']=="16"){
              echo "checked";
              }?>> obsessive <input type="checkbox" name="thought_process17" value="17" <?php
              if($check_res['thought_process17']=="17"){
              echo "checked";
              }?>> flash backs <input type="checkbox" name="thought_process18" value="18" <?php
              if($check_res['thought_process18']=="18"){
              echo "checked";
              }?>> intrusive thoughts <input type="checkbox" name="thought_process19" value="19" <?php
              if($check_res['thought_process19']=="19"){
              echo "checked";
              }?>> Other: <input type="text" name="thought_process20" value="<?php echo $check_res['thought_proces20']; ?>">

              <p><b>Computations</b> <input type="checkbox" name="thought_process21" value="21" <?php
              if($check_res['thought_process21']=="21"){
              echo "checked";
              }?>> age appropriate <input type="checkbox" name="thought_process22" value="22" <?php
              if($check_res['thought_process22']=="22"){
              echo "checked";
              }?>> age inappropriate <b>Abstractions</b> <input type="checkbox" name="thought_process23" value="23" <?php
              if($check_res['thought_process23']=="23"){
              echo "checked";
              }?>> normal <input type="checkbox" name="thought_process24" value="24" <?php
              if($check_res['thought_process24']=="24"){
              echo "checked";
              }?>>abnormal</p>
              <p><b>Describe:</b> <input type="text" name="thought_process25" value="<?php echo $check_res['thought_process25']; ?>"></p>
            </td>
          </tr>
        </table>


        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Thought Associations:
              <input type="checkbox" name="thought_ass1" class="yes_no" value="1" <?php
              if($check_res['thought_ass1']=="1"){
              echo "checked";
              }?>> intact <input type="checkbox" class="yes_no" name="thought_ass2" value="2" <?php
              if($check_res['thought_ass2']=="2"){
              echo "checked";
              }?>> circumstantial <input type="checkbox" class="yes_no" name="thought_ass3" value="3" <?php
              if($check_res['thought_ass4']=="3"){
              echo "checked";
              }?>> tangential <input type="checkbox" name="thought_ass4" class="yes_no" value="4" <?php
              if($check_res['thought_ass4']=="4"){
              echo "checked";
              }?>> loose
              <p><b>Describe:</b> <input type="text" name="thought_ass5" value="<?php echo $check_res['thought_ass5']; ?>"></p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>Thought Content:
              <input type="checkbox" name="thought_con1" value="1" <?php
              if($check_res['thought_con1']=="1"){
              echo "checked";
              }?>> obsessions <input type="checkbox" name="thought_con2" value="2" <?php
              if($check_res['thought_con2']=="2"){
              echo "checked";
              }?>> compulsions <input type="checkbox" name="thought_con3" value="3" <?php
              if($check_res['thought_con3']=="3"){
              echo "checked";
              }?>> preoccupations <input type="checkbox" name="thought_con4" value="4" <?php
              if($check_res['thought_con4']=="4"){
              echo "checked";
              }?>> paranoid delusions <input type="checkbox" name="thought_con5" value="5" <?php
              if($check_res['thought_con5']=="5"){
              echo "checked";
              }?>> other delusions <input type="checkbox" name="thought_con6" value="6" <?php
              if($check_res['thought_con6']=="6"){
              echo "checked";
              }?>> AH <input type="checkbox" name="thought_con7" value="7" <?php
              if($check_res['thought_con7']=="7"){
              echo "checked";
              }?>> VH <input type="checkbox" name="thought_con8" value="8" <?php
              if($check_res['thought_con8']=="8"){
              echo "checked";
              }?>> SI <input type="checkbox" name="thought_con9" value="9" <?php
              if($check_res['thought_con9']=="9"){
              echo "checked";
              }?>> HI
              <p><b>Describe:</b> <input type="text" name="thought_con10" value="<?php echo $check_res['thought_con10']; ?>"></p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <p><b>Memory:
              <input type="checkbox" name="memory1" class="yes_no3" value="1" <?php
              if($check_res['memory1']=="1"){
              echo "checked";
              }?>> poor <input type="checkbox" name="memory2" class="yes_no3" value="2" <?php
              if($check_res['memory2']=="2"){
              echo "checked";
              }?>> fair <input type="checkbox" name="memory3" class="yes_no3" value="3" <?php
              if($check_res['memory3']=="3"){
              echo "checked";
              }?>> moderate</p>
               <p> <b>Recent</b><input type="checkbox" name="memory4" class="yes_no4" value="4" <?php
              if($check_res['memory4']=="4"){
              echo "checked";
              }?>> intact <input type="checkbox" name="memory5" class="yes_no4" value="5" <?php
              if($check_res['memory5']=="5"){
              echo "checked";
              }?>> impaired <input type="checkbox" name="memory6" class="yes_no4" value="6" <?php
              if($check_res['memory6']=="6"){
              echo "checked";
              }?>> digits forward <input type="checkbox" name="memory7" class="yes_no4" value="7" <?php
              if($check_res['memory7']=="7"){
              echo "checked";
              }?>> intact <input type="checkbox" name="memory8" class="yes_no4" value="8" <?php
              if($check_res['memory8']=="8"){
              echo "checked";
              }?>> impaired </p>
              <p><b>Describe:</b> <input type="text" name="memory9" value="<?php echo $check_res['memory9']; ?>"></p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Insight:
              <input type="checkbox" name="insight1" class="yes_no" value="1" <?php
              if($check_res['insight1']=="1"){
              echo "checked";
              }?>> minimizes <input type="checkbox" class="yes_no" name="insight2" value="2" <?php
              if($check_res['insight2']=="2"){
              echo "checked";
              }?>> rationalizes <input type="checkbox" class="yes_no" name="insight3" value="3" <?php
              if($check_res['insight3']=="3"){
              echo "checked";
              }?>> intellectualizes <input type="checkbox" class="yes_no" name="insight4" value="4" <?php
              if($check_res['insight4']=="4"){
              echo "checked";
              }?>> impaired <input type="checkbox" name="insight5" class="yes_no" value="5" <?php
              if($check_res['insight5']=="5"){
              echo "checked";
              }?>> other: <input type="text" name="insight6" value="<?php echo $check_res['insight6']; ?>">
              <p><b>Describe:</b> <input type="text" name="insight7" value="<?php echo $check_res['insight7']; ?>"></p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Judgment:
              <input type="checkbox" name="judgment1" class="yes_no" value="1" <?php
              if($check_res['judgment1']=="1"){
              echo "checked";
              }?>> poor <input type="checkbox" name="judgment2" class="yes_no" value="2" <?php
              if($check_res['judgment2']=="2"){
              echo "checked";
              }?>> fair <input type="checkbox" name="judgment3" class="yes_no" value="3" <?php
              if($check_res['judgment3']=="3"){
              echo "checked";
              }?>> good <input type="checkbox" name="judgment4" class="yes_no" value="4" <?php
              if($check_res['judgment4']=="4"){
              echo "checked";
              }?>> Insight <input type="checkbox" name="judgment5" class="yes_no" value="5" <?php
              if($check_res['judgment5']=="5"){
              echo "checked";
              }?>> minimal <input type="checkbox" name="judgment6" class="yes_no" value="6" <?php
              if($check_res['judgment6']=="6"){
              echo "checked";
              }?>> moderate <input type="checkbox" name="judgment7" class="yes_no" value="7" <?php
              if($check_res['judgment7']=="7"){
              echo "checked";
              }?>>good
              <p><b>Describe:</b> <input type="text" name="judgment8" value="<?php echo $check_res['judgment8']; ?>"></p>
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Orientation:
              <input type="checkbox" name="orient1" class="yes_no" value="1" <?php
              if($check_res['orient1']=="1"){
              echo "checked";
              }?>> time <input type="checkbox" class="yes_no" name="orient2" value="2" <?php
              if($check_res['orient2']=="2"){
              echo "checked";
              }?>> person <input type="checkbox" class="yes_no" name="orient3" value="3" <?php
              if($check_res['orient3']=="3"){
              echo "checked";
              }?>> place &emsp; Attention Span/ Concentration <input class="yes_no" type="checkbox" name="orient4" value="4" <?php
              if($check_res['orient4']=="4"){
              echo "checked";
              }?>> intact  <input type="checkbox" name="orient5" class="yes_no" value="5" <?php
              if($check_res['orient5']=="5"){
              echo "checked";
              }?>> impaired
              <p><b>Describe:</b> <input type="text" name="orient6" value="<?php echo $check_res['orient6']; ?>"></p>
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Language: &emsp; Name Objects
              <input type="checkbox" name="language1" class="yes_no" value="1" <?php
              if($check_res['language1']=="1"){
              echo "checked";
              }?>> intact <input type="checkbox" class="yes_no" name="language2" value="2" <?php
              if($check_res['language2']=="2"){
              echo "checked";
              }?>> impaired <input type="checkbox" class="yes_no" name="language3" value="3" <?php
              if($check_res['language3']=="3"){
              echo "checked";
              }?>> place&emsp; Repeat phrases <input class="yes_no" type="checkbox" name="language4" value="4" <?php
              if($check_res['language4']=="4"){
              echo "checked";
              }?>> intact  <input type="checkbox" class="yes_no" name="language5" value="5" <?php
              if($check_res['language5']=="5"){
              echo "checked";
              }?>> impaired
            </td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Knowledge &emsp; Current Events
              <input type="checkbox" name="knowledge1"1 value="1" class="yes_no" <?php
              if($check_res['knowledge1']=="1"){
              echo "checked";
              }?>> intact <input type="checkbox" name="knowledge2" class="yes_no" value="2" <?php
              if($check_res['knowledge2']=="2"){
              echo "checked";
              }?>> impaired <input type="checkbox" name="knowledge3" class="yes_no" value="3" <?php
              if($check_res['knowledge3']=="3"){
              echo "checked";
              }?>> place&emsp; Past History <input type="checkbox" class="yes_no" name="knowledge4" value="4" <?php
              if($check_res['knowledge4']=="4"){
              echo "checked";
              }?>> intact  <input type="checkbox" name="knowledge5" class="yes_no" value="5" <?php
              if($check_res['knowledge5']=="5"){
              echo "checked";
              }?>> impaired
            </td>
          </tr>
        </table>

        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Intelligence
              <input type="checkbox" name="intel1" class="yes_no" value="1" <?php
              if($check_res['intel']=="1"){
              echo "checked";
              }?>> appears normal <input type="checkbox" class="yes_no" name="intel2" value="2" <?php
              if($check_res['intel2']=="2"){
              echo "checked";
              }?>> age appropriate <input type="checkbox" class="yes_no" name="intel3" value="3" <?php
              if($check_res['intel3']=="3"){
              echo "checked";
              }?>> age inappropriate <input type="checkbox" class="yes_no" name="intel4" value="4" <?php
              if($check_res['intel4']=="4"){
              echo "checked";
              }?>> above average  <input type="checkbox" class="yes_no" name="intel5" value="5" <?php
              if($check_res['intel5']=="5"){
              echo "checked";
              }?>> average  <input type="checkbox" class="yes_no" name="intel6" value="6" <?php
              if($check_res['intel6']=="6"){
              echo "checked";
              }?>> below average <input type="checkbox" class="yes_no" name="intel7" value="7" <?php
              if($check_res['intel7']=="7"){
              echo "checked";
              }?>> impaired <input type="checkbox" class="yes_no" name="intel8" value="8" <?php
              if($check_res['intel8']=="8"){
              echo "checked";
              }?>>other
              <p><b>Describe:</b> <input type="text" name="intel9" value="<?php echo $check_res['intel9']; ?>"></p>
            </td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;">Appetite: <input type="checkbox" name="appetite1" class="yes_no" value="1" <?php
              if($check_res['appetite1']=="1"){
              echo "checked";
              }?>> poor <input class="yes_no" type="checkbox" name="appetite2" value="2" <?php
              if($check_res['appetite2']=="2"){
              echo "checked";
              }?>> fair <input class="yes_no" type="checkbox" name="appetite3" value="3" <?php
              if($check_res['appetite3']=="3"){
              echo "checked";
              }?>> moderate <input class="yes_no" type="checkbox" name="appetite4" value="4" <?php
              if($check_res['appetite4']=="4"){
              echo "checked";
              }?>>good
            </td>
            <td style="width:50%; border:1px solid black;"> % of meals eaten<input type="checkbox" name="percentage1" class="yes_no" value="1" <?php
              if($check_res['percentage1']=="1"){
              echo "checked";
              }?>>25% <input type="checkbox" class="yes_no" name="percentage2" value="2" <?php
              if($check_res['percentage2']=="2"){
              echo "checked";
              }?>>50% <input type="checkbox" class="yes_no" name="percentage3" value="3" <?php
              if($check_res['percentage3']=="3"){
              echo "checked";
              }?>> 75% <input type="checkbox" class="yes_no" name="percentage4" value="4" <?php
              if($check_res['percentage4']=="4"){
              echo "checked";
              }?>>100%
            </td>
          </tr>
        </table>
              <br>
        <table style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;">Sleep: <input type="checkbox" name="sleep1" class="yes_no" value="1" <?php
              if($check_res['sleep1']=="1"){
              echo "checked";
              }?>> poor <input type="checkbox" class="yes_no" name="sleep2" value="2" <?php
              if($check_res['sleep2']=="2"){
              echo "checked";
              }?>> fair <input type="checkbox" class="yes_no" name="sleep3" value="3" <?php
              if($check_res['sleep3']=="3"){
              echo "checked";
              }?>> moderate <input type="checkbox" class="yes_no" name="sleep4" value="4" <?php
              if($check_res['sleep4']=="4"){
              echo "checked";
              }?>>good </td>
            <td style="width:50%; border:1px solid black;">Hours slept per night: <input type="text" name="sleep5" value="<?php echo $check_res['sleep5']; ?>"></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Problem: <input type="checkbox" name="problem1" class="yes_no" value="1" <?php
              if($check_res['problem1']=="1"){
              echo "checked";
              }?>> difficulty falling asleep <input type="checkbox" class="yes_no" name="problem2" value="2" <?php
              if($check_res['problem2']=="2"){
              echo "checked";
              }?>> difficulty staying asleep <input type="checkbox" class="yes_no" name="problem3" value="3" <?php
              if($check_res['problem3']=="3"){
              echo "checked";
              }?>> drug dreams <input type="checkbox" name="problem4" class="yes_no" value="4" <?php
              if($check_res['problem4']=="4"){
              echo "checked";
              }?>> nightmares <input type="checkbox" name="problem5" class="yes_no" value="5" <?php
              if($check_res['problem5']=="5"){
              echo "checked";
              }?>>other : <input type="text" name="problem6" value="<?php echo $check_res['problem6']; ?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><input type="checkbox" name="anxious1" value="1" <?php
              if($check_res['anxious1']=="1"){
              echo "checked";
              }?>> anxious about being in treatment <input type="checkbox" name="anxious2" value="2" <?php
              if($check_res['anxious2']=="2"){
              echo "checked";
              }?>> legal concerns/ consequences <input type="checkbox" name="anxious3" value="3" <?php
              if($check_res['anxious3']=="3"){
              echo "checked";
              }?>> transition to sober living <input type="checkbox" name="anxious4" value="4" <?php
              if($check_res['anxious4']=="4"){
              echo "checked";
              }?>> no family support <input type="checkbox" name="anxious5" value="5" <?php
              if($check_res['anxious5']=="5"){
              echo "checked";
              }?>> returning to work <input type="checkbox" name="anxious6" value="6" <?php
              if($check_res['anxious6']=="6"){
              echo "checked";
              }?>> difficulty coping <input type="checkbox" name="anxious7" value="7" <?php
              if($check_res['anxious7']=="7"){
              echo "checked";
              }?>> decision difficulty <input type="checkbox" name="anxious8" value="8" <?php
              if($check_res['anxious8']=="8"){
              echo "checked";
              }?>>other, explain:<input type="text" name="anxious9" value="<?php echo $check_res['anxious9']; ?>"></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">What is the client struggling with in treatment? Triggers? Level of cravings from 1-10.: Explain what client is struggling with.</td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Goals being worked on and client progress (Specify problem, goal and objective): Specify according to what they are struggling with.</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Motivation for treatment <input type="checkbox" name="motivation1" class="yes_no" value="1" <?php
              if($check_res['motivation1']=="1"){
              echo "checked";
              }?>> internal <input type="checkbox" class="yes_no" name="motivation2" value="2" <?php
              if($check_res['motivation2']=="2"){
              echo "checked";
              }?>> external <input type="checkbox" class="yes_no" name="motivation3" value="3" <?php
              if($check_res['motivation3']=="3"){
              echo "checked";
              }?>>other, explain:<input type="text" name="motivation4" value="<?php echo $check_res['motivation4']; ?>"></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Group Participation <input type="checkbox" name="group_parti1" class="yes_no" value="1" <?php
              if($check_res['group_parti1']=="1"){
              echo "checked";
              }?>> poor <input type="checkbox" class="yes_no" name="group_parti2" value="2" <?php
              if($check_res['group_parti2']=="2"){
              echo "checked";
              }?>> fair <input type="checkbox" class="yes_no" name="group_parti3" value="4" <?php
              if($check_res['group_parti3']=="3"){
              echo "checked";
              }?>> moderate <input type="checkbox" class="yes_no" name="group_parti4" value="4" <?php
              if($check_res['group_parti4']=="4"){
              echo "checked";
              }?>> good <input type="checkbox" class="yes_no" name="group_parti5" value="5" <?php
              if($check_res['group_parti5']=="5"){
              echo "checked";
              }?>>other, explain:<input type="text" name="group_parti6" value="<?php echo $check_res['group_parti6']; ?>"></td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">Legal update:<input type="text" name="legal" value="<?php echo $check_res['legal']; ?>"></td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;">Date of test:<input type="text" name="date_of_test" value="<?php echo $check_res['date_of_test']; ?>"></td>
            <td style="width:50%; border:1px solid black;">&emsp;&emsp;<input type="checkbox" name="onsite" value="1" class="yes_no" <?php
              if($check_res['onsite']=="1"){
              echo "checked";
              }?>> onsite &emsp; &emsp; &emsp; &emsp;<input type="checkbox" class="yes_no" name="overnight" value="2" <?php
              if($check_res['overnight']=="2"){
              echo "checked";
              }?>>Overnight</td>
          </tr>
        </table>
        <table style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
            <p><b>Result:</b></p>
            <p><input type="checkbox" name="result1" value="1" <?php
              if($check_res['result1']=="1"){
              echo "checked";
              }?>>negative for all</p>
              <p><input type="checkbox" name="result2" value="2" <?php
              if($check_res['result2']=="2"){
              echo "checked";
              }?>> positive, for:<input type="checkbox" name="result3" value="3" <?php
              if($check_res['result3']=="3"){
              echo "checked";
              }?>> AMP<input type="checkbox" name="result4" value="4" <?php
              if($check_res['result4']=="4"){
              echo "checked";
              }?>> BAR<input type="checkbox" name="result5" value="5" <?php
              if($check_res['result5']=="5"){
              echo "checked";
              }?>> BZO<input type="checkbox" name="result6" value="6" <?php
              if($check_res['result6']=="6"){
              echo "checked";
              }?>> COC<input type="checkbox" name="result7" value="7" <?php
              if($check_res['result7']=="7"){
              echo "checked";
              }?>> OPI/MOP<input type="checkbox" name="result8" value="8" <?php
              if($check_res['result8']=="8"){
              echo "checked";
              }?>> MTD<input type="checkbox" name="result9" value="9" <?php
              if($check_res['result9']=="9"){
              echo "checked";
              }?>> MET<input type="checkbox" name="result10" value="10" <?php
              if($check_res['result10']=="10"){
              echo "checked";
              }?>> PCP<input type="checkbox" name="result11" value="11" <?php
              if($check_res['result11']=="11"){
              echo "checked";
              }?>> OXY<input type="checkbox" name="result12" value="12" <?php
              if($check_res['result12']=="12"){
              echo "checked";
              }?>> TCA<input type="checkbox" name="result13" value="13" <?php
              if($check_res['result13']=="13"){
              echo "checked";
              }?>> THC<input type="checkbox" name="result14" value="14" <?php
              if($check_res['result14']=="14"){
              echo "checked";
              }?>> MDMA<input type="checkbox" name="result15" value="15" <?php
              if($check_res['result15']=="15"){
              echo "checked";
              }?>> PPX<input type="checkbox" name="result16" value="16" <?php
              if($check_res['result16']=="16"){
              echo "checked";
              }?>> BUP<input type="checkbox" name="result17" value="17" <?php
              if($check_res['result17']=="17"){
              echo "checked";
              }?>> ETOH</p>

              <p>faint, for:&emsp;&emsp;&emsp; AMP&emsp;&emsp;&emsp; BAR&emsp;&emsp;&emsp; BZO&emsp;&emsp;&emsp;COC&emsp;&emsp;&emsp;OPI/MOP&emsp;&emsp;&emsp;MTD&emsp;&emsp;&emsp;MET&emsp;&emsp;&emsp;PCP&emsp;&emsp;&emsp;OXY&emsp;&emsp;&emsp;TCA&emsp;&emsp;&emsp;THC&emsp;&emsp;&emsp;MDMA&emsp;&emsp;&emsp; PPX&emsp;&emsp;&emsp;BUP&emsp;&emsp;&emsp;ETOH</p>

              <p>Alcohol urine dipstick <input type="text" name="faint1" value="<?php echo $check_res['faint1']; ?>"></p>
              <p>Breathalyzer <input type="text" name="faint2" value="<?php echo $check_res['faint2']; ?>"></p>
              <p>other: <input type="text" name="faint3" value="<?php echo $check_res['faint3']; ?>"></p>
            </td>
          </tr>
        </table>
        <br>
        <table  style="width:100%">
          <tr>
            <td style="width:50%; border:1px solid black;"><b>Date of last family session:</b> <input type="text" name="last_family" value="<?php echo $check_res['last_family']; ?>"></td>
            <td style="width:50%; border:1px solid black;"><b>Date of next family session:</b> <input type="text" name="next_family" value="<?php echo $check_res['next_family']; ?>"></td>
          </tr>
        </table>
        <table  style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;"><b>What family members have been involved?</b> <input type="checkbox" name="family1" value="1" <?php
              if($check_res['family1']=="1"){
              echo "checked";
              }?>> mother <input type="checkbox" name="family2" value="2" <?php
              if($check_res['family2']=="2"){
              echo "checked";
              }?>> father <input type="checkbox" name="family3" value="3" <?php
              if($check_res['family3']=="3"){
              echo "checked";
              }?>> siblings <input type="checkbox" name="family4" value="4" <?php
              if($check_res['family4']=="4"){
              echo "checked";
              }?>> spouse <input type="checkbox" name="family5" value="5" <?php
              if($check_res['family5']=="5"){
              echo "checked";
              }?>> partner <input type="checkbox" name="family6" value="6" <?php
              if($check_res['family6']=="6"){
              echo "checked";
              }?>> adult child <input type="checkbox" name="family7" value="7" <?php
              if($check_res['family7']=="7"){
              echo "checked";
              }?>>Other: <input type="text" name="family8" value="<?php echo $check_res['family8']; ?>"></td>
          </tr>
        </table>
        <table  style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <p><b>If family has not participated with treatment, what outreach attempts have been made?</b></p>
              <p><input type="checkbox" name="tele1" class="yes_no5" value="1" <?php
              if($check_res['tele1']=="1"){
              echo "checked";
              }?>> telephone <input type="checkbox" class="yes_no5" name="tele2" value="2" <?php
              if($check_res['tele2']=="2"){
              echo "checked";
              }?>> mail <input type="checkbox" class="yes_no5" name="tele3" value="3" <?php
              if($check_res['tele3']=="3"){
              echo "checked";
              }?>> email <input type="checkbox" class="yes_no5" name="tele4" value="4" <?php
              if($check_res['tele4']=="4"){
              echo "checked";
              }?>> face to face</p>

              <p><b>To whom?:</b></p>
              <p><input type="checkbox" name="whom1" class="yes_no6" value="1" <?php
              if($check_res['whom1']=="1"){
              echo "checked";
              }?>> mother <input type="checkbox" class="yes_no6" name="whom2" value="2" <?php
              if($check_res['whom2']=="2"){
              echo "checked";
              }?>> father <input type="checkbox" class="yes_no6" name="whom3" value="3" <?php
              if($check_res['whom3']=="3"){
              echo "checked";
              }?>> siblings <input type="checkbox" class="yes_no6" name="whom4" value="4" <?php
              if($check_res['whom4']=="4"){
              echo "checked";
              }?>> spouse <input type="checkbox" class="yes_no6" name="whom5" value="5" <?php
              if($check_res['whom5']=="5"){
              echo "checked";
              }?>> partner <input type="checkbox" class="yes_no6" name="whom6" value="6" <?php
              if($check_res['whom6']=="6"){
              echo "checked";
              }?>> adult child <input type="checkbox" class="yes_no6" name="whom7" value="7" <?php
              if($check_res['whom7']=="7"){
              echo "checked";
              }?>>Other: <input type="text" name="whom8" value="<?php echo $check_res['whom8']; ?>"></p>
            </td>
          </tr>
        </table>

        <br>
        <table  style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Source of sober support</b>
              <input type="checkbox" name="source1" class="yes_no" value="1" <?php
              if($check_res['source1']=="1"){
              echo "checked";
              }?>> 12 Step Community <input type="checkbox" class="yes_no" name="source2" value="2" <?php
              if($check_res['source2']=="2"){
              echo "checked";
              }?>> family <input type="checkbox" class="yes_no" name="source3" value="3" <?php
              if($check_res['source3']=="3"){
              echo "checked";
              }?>>Other: <input type="text" name="source4" value="<?php echo $check_res['source4']; ?>">
            </td>
          </tr>
        </table>
        <table  style="width:100%">
          <tr>
            <td style="width:100%; border:1px solid black;">
              <b>Community support</b>
              <input type="checkbox" name="support1" class="yes_no"  value="1" <?php
              if($check_res['support1']=="1"){
              echo "checked";
              }?>> recovery community <input type="checkbox" class="yes_no"  name="support2" value="2" <?php
              if($check_res['support2']=="2"){
              echo "checked";
              }?>> religious/ spiritual <input type="checkbox" class="yes_no"  name="support3" value="3" <?php
              if($check_res['support3']=="3"){
              echo "checked";
              }?>>Other: <input type="text" name="support4" value="<?php echo $check_res['support4']; ?>">
            </td>
          </tr>
        </table>
              <br>
        <table  style="width:100%">
          <tr>
          <td style="width:100%; border-top:1px solid;border-left:1px solid;border-right:1px solid; padding-left: 10px;padding-right: 10px;">
              <p><b>Date, level of care, and location of step down/ step up:</b></p>
              <p>Patient is currently in <input type="text" name="level1" value="<?php echo $check_res['level1']; ?>"> as of <input type="daete" name="level2" value="<?php echo $check_res['level2']; ?>"> Patient needs additional days at this level of care.</p>
              </td>
          </tr>
        </table>
        <div style="border-left:1px solid; border-bottom:1px solid; border-right:1px solid;padding-left: 10px;padding-right: 10px;" contentEditable="true" class="text_edit"><?php echo $check_res['text1']??"
              <p>
                 He/She is making progress, but has not yet achieved goals articulated in the individualized treatment plan. The treatment is leading to measurable improvements to acute symptoms and progression toward discharge presently, but the individual in not yet sufficiently stabilized safely to continue at a lower level of care. Continued treatment at the present level of care is assessed as necessary to permit patient to continue to work toward his/her treatment goals. Or</p>
                 <p> The patient is not yet making progress, but has capacity to resolve his/her problems. He/She is actively working toward the goals articulated in individualized treatment plan. Continued treatment at present level of care is assessed as necessary to permit the patient to continue to work toward his/her treatment goals. Or
                 New problems have been identified that are appropriately treated at present level of care. The new problem/priority requires services, the frequency and intensity of which can only safely be delivered by continued stay in the current level of care.</p>
                <p>Currently the patient does not require a higher level of care or a different level of care if the patient continues to reside in ambulatory detox level of care. At this level of care there is reasonable probability of reduction of symptoms and behaviors with this treatment at the present time. If applicable !! ( Despite intensive recovery and therapeutic efforts elsewhere the patient is choosing ambulatory detox level of care to treat the intensity, duration and frequency of symptoms and behaviors. There is a need for continued medical and clinical treatment at this current time. Persistence of signs and symptoms such as (specify withdrawal symptoms) require the clients continued observation and treatment at this level of care. …OR… The patient has developed new symptoms and or behaviors (specify withdrawal symptom/ behaviors) that require this intensity of service for a safe and effective treatment. The patient is still experiencing signs and symptoms of withdrawal such as (specify withdrawal symptoms) that require continued services at this level of withdrawal</p>"?>
                </div><input type="hidden" name="text1" id="text1">

        <br><br>
        <div class="btndiv">
        <input type="submit" value="Submit" class="subbtn btn-save">
          <button class="cancel" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
        </div>
</form>

</div>
</div>
</div>
</body>
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
    $('input.yes_no4').on('click', function() {
      $(this).parent().parent().find('.yes_no4').prop('checked', false);
      $(this).prop('checked', true)
    });
    $('input.yes_no5').on('click', function() {
      $(this).parent().parent().find('.yes_no5').prop('checked', false);
      $(this).prop('checked', true)
    });
    $('input.yes_no6').on('click', function() {
      $(this).parent().parent().find('.yes_no6').prop('checked', false);
      $(this).prop('checked', true)
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
