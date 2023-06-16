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
       $sql = "SELECT * FROM `form_fall_risk_management` WHERE id=? AND pid = ? AND encounter = ?";
       $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
       for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
           $all[$iter] = $row;
       }
       $check_res = $all[0];
   }
   //echo $formid;
   $check_res = $formid ? $check_res : array();

   $select2=explode(",",$check_res['select2']);

   
   $sql1="SELECT * FROM `patient_data` WHERE  pid = ?";
   
   $res1 = sqlStatement($sql1, array($_SESSION["pid"]));
   
   for ($iter1 = 0; $row1 = sqlFetchArray($res1); $iter1++) {
     $all1[$iter1] = $row1;
   }
   $check_res1 = $all1[0];
   $session_name = trim($check_res1['fname'] . ' ' . $check_res1['lname']);
   $session_add=$check_res1['street'].','.$check_res1['city'].','.$check_res1['state'].','.$check_res1['country_code'].','.$check_res1['postal_code'];

   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ntherapy</title>
      <!-- Latest compiled and minified CSS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
      <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
      <style type="text/css">
#h3_1{
          text-align: center;
          font-size: 17px;
        }
        #p_1{
          margin-left: 10px;
        }
        .txt_1{
          width: 100%;
        }
        u {
    margin-left: 395px;
}
input {
    border: 0;
    outline: 0;
    border-bottom: 1px solid black;
}
.btndiv {
         text-align: center;
         margin-bottom: 18px;
         }
         button.subbtn {
         background: blue;
         color: white;
         }
         button.cancel {
         background: red;
         color: white;
         }
      </style>

</head>
<body>
    <div class="container mt-3">
    <div class="row">
      <div class="container-fluid">
      <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/fall_risk_management/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
          <tr>
            <td style="border: 1px solid black;"> 
          <h3 id="h3_1">FALL RISK ASSESSMENT</h3>
          <p id="p_1">Initiate fall protocol if one or more of the following criteria are met</p>
           </td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check1" value="1" 
            <?php
            if($check_res['check1']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Impaired mobility
          </td>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check2" value="1"
            <?php
            if($check_res['check2']=="1"){
                echo "checked";
            }
            ?>
            >History of fall(s within 6 months)
          </td>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check3" value="1"
            <?php
            if($check_res['check3']=="1"){
                echo "checked";
            }
            ?>
            >New atypical antipsychotic regime
          </td>
          </tr>
          <tr>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check4" value="1"
            <?php
            if($check_res['check4']=="1"){
                echo "checked";
            }
            ?>
            >Unsteady gait
          </td>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check5" value="1"
            <?php
            if($check_res['check5']=="1"){
                echo "checked";
            }
            ?>
            >Communication deficit
          </td>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check6" value="1"
            <?php
            if($check_res['check6']=="1"){
                echo "checked";
            }
            ?>
            >Withdrawal protocol
          </td>
          </tr>
          <tr>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check7" value="1"
            <?php
            if($check_res['check7']=="1"){
                echo "checked";
            }
            ?>
            >Drug-induced sedation
          </td>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check8" value="1"
            <?php
            if($check_res['check8']=="1"){
                echo "checked";
            }
            ?>
            >Hypotension
          </td>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check9" value="1"
            <?php
            if($check_res['check9']=="1"){
                echo "checked";
            }
            ?>
            >Urological (incontinence,frequency,nocturia)
          </td>
          </tr>
          <tr>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;">
            <input type="checkbox" name="check10" value="1"
            <?php
            if($check_res['check10']=="1"){
                echo "checked";
            }
            ?>
            >Impaired cognition
          </td>
          <td style="border: 1px solid black;"><input type="checkbox" name="check11" value="1"
          <?php
            if($check_res['check11']=="1"){
                echo "checked";
            }
            ?>
          >Visual impairment(legally blind)</td>
          </tr>
        </table>
        <table style="width:100%;border: 1px solid black;">
          <tr>
          <td>
            Physical limatations:
          </td>
          </tr>
          <tr>
            <td>
            <textarea name="txt1" class="txt_1"><?php echo $check_res['txt1'];?></textarea>
            </td>
          </tr>
        </table>
        <table style="border: 1px solid black;width: 100%;">
          <tr>
            <td><b>Please select and complete one of the following:</b></td>
          </tr>
          <tr>  
            <td><input type="checkbox" name="check12" value="1"
            <?php
            if($check_res['check12']=="1"){
                echo "checked";
            }
            ?>
            >Patient does not meet criteria for all protocol</td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check13" value="1"
              <?php
            if($check_res['check13']=="1"){
                echo "checked";
            }
            ?>
              >Patient meets criteria for fall protocol. MD contacted:
              <input type="text" name="inp1" value="
              <?php echo $check_res['inp1'];?>
              ">
            </td>
           </tr>
           <tr> 
            <td>
              <input type="checkbox" name="check14" value="1"
              <?php
            if($check_res['check14']=="1"){
                echo "checked";
            }
            ?>
              >Ambulation order obtained and order written
              <input type="text" name="inp2" value="<?php echo $check_res['inp2'];?>">
            </td>
            </tr>
            <tr>
            <td><input type="checkbox" name="check15" value="1" 
            <?php
            if($check_res['check15']=="1"){
                echo "checked";
            }
            ?>>Fall protocol initiated and placed in treatment plan</td>
            </tr>
            <tr>
            <td><input type="checkbox" name="check16" value="1" 
            <?php
            if($check_res['check16']=="1"){
                echo "checked";
            }
            ?>>Patient meets criteria for fall protocol, however nursing judgement is not place the patient on fall protocol Rationale:<input type="text" name="inp3" value="<?php echo $check_res['inp3'];?>"></td>
          </tr>
                      <tr>
            <td><input type="checkbox" name="check17" value="1"
            
            <?php
            if($check_res['check17']=="1"){
                echo "checked";
            }
            ?>>MD notified and agrees with RN decision
            <input type="text" name="inp4" value="<?php echo $check_res['inp4'];?>"></td>
          </tr>
                      <tr>
            <td><input type="checkbox" name="check18" value="1"
            <?php
            if($check_res['check18']=="1"){
                echo "checked";
            }
            ?>
            >MD notified and wants patient on fall protocol<input type="text" name="check19" value="<?php echo $check_res['check19'];?>"></td>
          </tr>
                      <tr>
            <td><input type="checkbox" name="check20" value="1"
            <?php
            if($check_res['check20']=="1"){
                echo "checked";
            }
            ?>
            >Ambulation order obtained and written
              <input type="text" name="inp5" value="<?php echo $check_res['inp5'];?>">
            </td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="border:1px solid black;"><b>RESTRAINT ASSESSMENT/ RELAXATION ASSESSMENT/ ABUSE ASSESSMENT</b></td>
          </tr>
        </table>
        <table style="width:100%;border: 1px solid black;">
          <tr>
            <td><b>What tools do you use to help yourself relax?</b></td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check21" value="1"
              <?php
            if($check_res['check21']=="1"){
                echo "checked";
            }
            ?>
              >Music 
              <input type="checkbox" name="check22" value="1"
              <?php
            if($check_res['check22']=="1"){
                echo "checked";
            }
            ?>
              >Talking it out
              <input type="checkbox" name="check23" value="1"
              <?php
            if($check_res['check23']=="1"){
                echo "checked";
            }
            ?>
              >Exercise
              <input type="checkbox" name="check24" value="1"
              <?php
            if($check_res['check24']=="1"){
                echo "checked";
            }
            ?>
              >Relaxation techniques
              <input type="checkbox" name="check25" value="1"
              <?php
            if($check_res['check25']=="1"){
                echo "checked";
            }
            ?>
              >Meditation
              <input type="checkbox" name="check27" value="1"
              <?php
            if($check_res['check27']=="1"){
                echo "checked";
            }
            ?>
              >Reading
              <input type="checkbox" name="check28" value="1"
              <?php
            if($check_res['check28']=="1"){
                echo "checked";
            }
            ?>
              >Quit time
              <input type="checkbox" name="check29" value="1"
              <?php
            if($check_res['check29']=="1"){
                echo "checked";
            }
            ?>
              >Video games<br>
              <input type="checkbox" name="check30" value="1"
              <?php
            if($check_res['check30']=="1"){
                echo "checked";
            }
            ?>
              >Journaling
              <input type="checkbox" name="check31" value="1"
              <?php
            if($check_res['check31']=="1"){
                echo "checked";
            }
            ?>
              >Computer
              <input type="checkbox" name="check32" value="1"
              <?php
            if($check_res['check32']=="1"){
                echo "checked";
            }
            ?>
              >Watching TV
              <input type="checkbox" name="check33" value="1"
              <?php
            if($check_res['check33']=="1"){
                echo "checked";
            }
            ?>
              >Other:<input type="text" name="inp6" value="<?php echo $check_res['inp6'];?>">
            </td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td>
              <b>Identify whether patient has history of abuse:</b>
              <input type="checkbox" name="check34" value="1"  <?php
            if($check_res['check34']=="1"){
                echo "checked";
            }
            ?>>No history of abuse
              <input type="checkbox" name="check35" value="1"  <?php
            if($check_res['check35']=="1"){
                echo "checked";
            }
            ?>>Physical abuse
              <input type="checkbox" name="check36" value="1"  <?php
            if($check_res['check36']=="1"){
                echo "checked";
            }
            ?>>Sexual abuse
              <input type="checkbox" name="check37" value="1"  <?php
            if($check_res['check37']=="1"){
                echo "checked";
            }
            ?>><br>Emotional abuse
            </td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td>
              <b>Idenity whether has ever been in restraints:</b><br>
              <input type="checkbox" name="check38" class="rescheck1" value="1"
              <?php
            if($check_res['check38']=="1"){
                echo "checked";
            }
            ?>
              >No&nbsp;&nbsp;&nbsp;<input type="checkbox" class="rescheck1" name="check39" value="1"
              <?php
            if($check_res['check39']=="1"){
                echo "checked";
            }
            ?>
              >Yes (If yes, describe episode)<input type="text" name="inp7" value="<?php echo $check_res['inp7'];?>">
            </td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td><b><u>Rapid Plasma Regain (RPR) Test</u></b></td>
          </tr>
          <tr>
            <td>Patient was educated about Syphilis and the RPR screening test.</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="check40" value="1" 
            <?php
            if($check_res['check40']=="1"){
                echo "checked";
            }
            ?>>Patient consented to have the RPR test.</td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
          </tr>
                    <tr>
            <td><input type="checkbox" name="check41" value="1"
            <?php
            if($check_res['check41']=="1"){
                echo "checked";
            }
            ?>
            >Patient denied RPR testing.</td>
          </tr>
                    <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
          </tr>

                    <tr>
            <td><b><u>HIV/STD EDUCATION</u></b></td>
          </tr>
          <tr>
            <td>
              <p>Patient was educated about HIV ,STD's and IV drug use</p>
            </td>
          </tr>
          <tr>
            <td>
              <p>Patient consented to HIV testing&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="check42" class="hivcheck1" value="1" 
              <?php
            if($check_res['check42']=="1"){
                echo "checked";
            }
            ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hivcheck1" name="check43"  value="1"
            <?php
            if($check_res['check43']=="1"){
                echo "checked";
            }
            ?>>Yes</p>
            </td>
          </tr>

            <tr>
                <td class="btndiv">
        
                     <button type="submit" name="sub" value="Submit" class="subbtn">Submit</button>
                     <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>
                
              </td>
              </tr>
              <tr>
                <td><b>Identify whether patient has history of abuse:</b></td>
              </tr>
        </tabel>
</form>

</div>
</div>
</div>
<script>
        $('.rescheck1').on('change', function() {
        $('.rescheck1').not(this).prop('checked', false);
        });
        $('.hivcheck1').on('change', function() {
        $('.hivcheck1').not(this).prop('checked', false);
        });
</script>
</body>
</html>