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
       $sql = "SELECT * FROM `form_system_assessment` WHERE id=? AND pid = ? AND encounter = ?";
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
          p#p1 {
    margin-left: 225px;
}
.tbl1{
  border-bottom: 1px solid black;
  border-right: 1px solid black;
  border-left: 1px solid black;
  width: 100%;
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
         .tb2{
             border-bottom:none !important;
         }
         input {
    border: 0;
    outline: 0;
    border-bottom: 1px solid black;
}
         </style>
      </head>
<body>
    <div class="container mt-3">
    <div class="row">
      <div class="container-fluid">
      <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/system_assessment/save.php?id=<?php echo attr_url($formid); ?>">

      <table style="width:100%;">
          <tr>
            <td><b>Nursing Admission Assessment</b></td>
            <td style="width: 30%;"><b>Center for Network Therapy</b></td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <th style="border:1px solid black;text-align: center;"><b>SYSTEMS ASSESSMENT</b></th>
          </tr>
        </table>
        <table width="100%;" style="border: 1px solid black;">
          <tr>
            <td><u><b>NEUROLOGICAL/SENSORY</b></u></td>
          </tr>
          <tr>
            <td>
            Pupils equal and reactive to light.<br>
            No paresthesia, numberness,tremors,spasm,syncope or vertigo.sensation intact.<br>
            No headches or visual distrubances, Verbalization clear and understandable.
            </td>
            <td style="width:30%;">
              Normal Findings<input type="checkbox" name="check1" value="1"
              <?php
              if($check_res['check1']=="1"){
                echo "checked";
              }
              ?>
              >
            </td>
          </tr>
          <tr>
            <td>
              <u><b>Abnormal Findings</b></u>
            </td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check2" value="1" 
              <?php
              if($check_res['check2']=="1"){
                echo "checked";
              }
              ?>
              >Visual Impairment
            </td>
                        <td style="width:20%;">
              <input type="checkbox" name="check3" value="1" 
              <?php
              if($check_res['check3']=="1"){
                echo "checked";
              }
              ?>
              >Hearing Impairment
            </td>
          </tr>
          <tr>
            <td><input type="checkbox" name="check4" value="1"
            <?php
              if($check_res['check4']=="1"){
                echo "checked";
              }
              ?>
            >Eyeglasses/Contacts</td>
            <td><input type="checkbox" name="check5" value="1" 
            <?php
              if($check_res['check5']=="1"){
                echo "checked";
              }
              ?>
            >Deaf</td>
            <td><input type="checkbox" name="check6" value="1" 
            <?php
              if($check_res['check6']=="1"){
                echo "checked";
              }
              ?>
            >Hard of hearing R/L</td>
          </tr>
                    <tr>
            <td></td>
            <td><input type="checkbox" name="check7" value="1"
            <?php
              if($check_res['check7']=="1"){
                echo "checked";
              }
              ?>
            >Hearing aids R/L</td>
            <td></td>
          </tr>
          <tr>
            <td>Other:<input type="text" name="inp1" value="<?php echo $check_res['inp1']; ?>"></td>
            <td>Other:<input type="text" name="inp2" value="<?php echo $check_res['inp2']; ?>"></td>
          </tr>
         
        </table>
        <table style="border:1px solid black;width: 100%;">
          <tr>
            <td><b><u>CARDIOVASCULAR</u></b></td>
          </tr>
          <tr>
            <td><p>Heart rate regular. No edema. No complaints of calf tenderness</p></td>
            <td ><p id="p1">Normal Findings: <input type="checkbox" name="check41" value="1"
            <?php
              if($check_res['check41']=="1"){
                echo "checked";
              }
              ?>
            ></p></td>
          </tr>
          <tr><td></td></tr>
          <tr>
            <td>
              <b><u>Abnormal Findings</u></b>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox" name="check8" value="1" 
            <?php
              if($check_res['check8']=="1"){
                echo "checked";
              }
              ?>
            >Edema</td>
            <td><input type="checkbox" name="check9" value="1" 
            <?php
              if($check_res['check9']=="1"){
                echo "checked";
              }
              ?>
            >Bruising</td>
            <td><input type="checkbox" name="check10" value="1" 
            <?php
              if($check_res['check10']=="1"){
                echo "checked";
              }
              ?>
            >Calf Tenderness&nbsp;&nbsp;R/L</td>
            <td><input type="checkbox" name="check11" value="1" 
            <?php
              if($check_res['check11']=="1"){
                echo "checked";
              }
              ?>
            >Hemodialysis</td>
          </tr>
          <tr>
            <td>(Location)</td>
            <td>(Location)</td>
          </tr>
          <tr><td>Other:<input type="text" name="inp3" value="<?php echo $check_res['inp3'];?>"></td></tr>
        </table>
        <table style="border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;width: 100%;">
          <tr><td><u><b>RESPIRATORY</b></u></td></tr>
          <tr>
            <td>
              <p>
                Respirations 10-20 minutes regular and unlabored at rest. No clough/Wheezing present.<br> Chest expansion symmetrical. Breathing room air without distress. No cyanosis.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Normal Findings:&nbsp;&nbsp; <input type="checkbox" name="check12"
                  value="1"
                  <?php
              if($check_res['check12']=="1"){
                echo "checked";
              }
              ?>
                  ></b> 
              </p>
            </td>
          </tr>
        </table>
        <table class="tbl1">
          <tr>
            <td>
            <b><u>Abnormal Findings</u></b>
          </tr></td>
          <tr>
            <td><input type="checkbox" name="check13" value="1"
            <?php
              if($check_res['check13']=="1"){
                echo "checked";
              }
              ?>
            >Cough</td>
            <td><input type="checkbox" name="check14" value="1"
            <?php
              if($check_res['check14']=="1"){
                echo "checked";
              }
              ?>
            >In-haler</td>
            <td><input type="checkbox" name="check15" value="1"
            <?php
              if($check_res['check15']=="1"){
                echo "checked";
              }
              ?>
            >Nebulizer</td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check16" value="1"
              <?php
              if($check_res['check16']=="1"){
                echo "checked";
              }
              ?>
              >Productive
            </td>
            <td>
              <input type="checkbox" name="check17" value="1"
              <?php
              if($check_res['check17']=="1"){
                echo "checked";
              }
              ?>
              >Non-Productive
            </td>
          </tr>
          <tr>
            <td>Other:<input type="text" name="inp4" value="<?php echo $check_res['inp4'];?>"></td>
          </tr>
        </table>
        <table style="border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;width: 100%;">
          <tr><td><u><b>GASTROINTESTINAL</b></u></td></tr>
          <tr>
            <td>
              <p>
                Absomen flat,round and symmetrical. No distention.<br>Bowels move within own normal pattern and consistency&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Normal Findings</b> <input type="checkbox" name="check42"
                  value="1"
                  <?php
              if($check_res['check42']=="1"){
                echo "checked";
              }
              ?>
                  ></b> 
              </p>
            </td>
          </tr>
        </table>
                <table class="tbl1">
          <tr>
            <td>
            <b><u>Abnormal Findings</u></b>
          </tr></td>
          <tr>
            <td><input type="checkbox" name="check18" value="1"
            <?php
              if($check_res['check18']=="1"){
                echo "checked";
              }
              ?>
            >Diarrhea</td>
            <td><input type="checkbox" name="check19" value="1" 
            <?php
              if($check_res['check19']=="1"){
                echo "checked";
              }
              ?>
            >Constipation</td>
            <td><input type="checkbox" name="check20" value="1" 
            <?php
              if($check_res['check20']=="1"){
                echo "checked";
              }
              ?>
            >Ostomy</td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check21" value="1"
              <?php
              if($check_res['check21']=="1"){
                echo "checked";
              }
              ?>
              >Peg tube
            </td>
            <td>
              <input type="checkbox" name="check22" value="1"
              <?php
              if($check_res['check22']=="1"){
                echo "checked";
              }
              ?>
              >Distention
            </td>
                        <td>
              <input type="checkbox" name="check23" value="1"
              <?php
              if($check_res['check23']=="1"){
                echo "checked";
              }
              ?>
              >Incontinence
            </td>
          </tr>
            <tr>
                        <td>
              <input type="checkbox" name="check24" value="1"
              <?php
              if($check_res['check24']=="1"){
                echo "checked";
              }
              ?>
              >Other:<input type="text" name="systext" value="<?php echo $check_res['systext'];?>"/>
            </td>
                        
          </tr>
        </table>
                <table style="border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;width: 100%;">
          <tr><td><u><b>GENITOURINARY</b></u></td></tr>
          <tr>
            <td>
              <p>
                Able to empty bladder without dysuria. Bladder not distended. No Frequency,<br>urgency,hesitancy,incontinence or nocturia. No urethral bleeding.<br>No vaginal bleeding or discharge&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Normal Findings</b> <input type="checkbox" name="check25"
                  value="1"
                  <?php
              if($check_res['check25']=="1"){
                echo "checked";
              }
              ?>
                  ></b> 
              </p>
            </td>
          </tr>
        </table>
                <table class="tbl1">
          <tr>
            <td>
            <b><u>Abnormal Findings</u></b>
          </tr></td>
          <tr>
            <td><input type="checkbox" name="check26" value="1"
            <?php
              if($check_res['check26']=="1"){
                echo "checked";
              }
              ?>
            >Frequency</td>
            <td><input type="checkbox" name="check27" value="1"
            <?php
              if($check_res['check27']=="1"){
                echo "checked";
              }
              ?>
            >Urgency</td>
            <td><input type="checkbox" name="check28" value="1"
            <?php
              if($check_res['check28']=="1"){
                echo "checked";
              }
              ?>
            >Burning</td>
            <td><input type="checkbox" name="check29" value="1"
            <?php
              if($check_res['check29']=="1"){
                echo "checked";
              }
              ?>
            >Incontinence</td>
            <td><input type="checkbox" name="check30" value="1"
            <?php
              if($check_res['check30']=="1"){
                echo "checked";
              }
              ?>
            >Catheter(location)</td>

          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check31" value="1"
              <?php
              if($check_res['check31']=="1"){
                echo "checked";
              }
              ?>
              >Night time Enuresis
            </td>
            
          </tr>
            <tr>
                        <td>
              <input type="checkbox" name="check32" value="1"
              <?php
              if($check_res['check32']=="1"){
                echo "checked";
              }
              ?>
              >Other:<input type="text" name="systext1" value="<?php echo $check_res['systext1'];?>"/>
            </td>
                        
          </tr>
        </table>
                        <table style="border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;width: 100%;">
          <tr><td><u><b>MUSCULOSKETAL</b></u></td></tr>
          <tr>
            <td>
              <p>
                Absence of inflammation,generalized swelling,joint tenderness or deformities.<br>No muscle tenderness,inflammartion,atrophy or weakness.full ROM. Ambulates.<br>Without difficulty,steady gait. No adaptive or assitive devices.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Normal Findings</b> <input type="checkbox" name="check33"
                  value="1" <?php
              if($check_res['check33']=="1"){
                echo "checked";
              }
              ?>></b> 
              </p>
            </td>
          </tr>
        </table>
                <table class="tbl1 tb2">
          <tr>
            <td>
            <b><u>Abnormal Findings</u></b>
          </tr></td>
          <tr>
            <td><input type="checkbox" name="check34" value="1"
            <?php
              if($check_res['check34']=="1"){
                echo "checked";
              }
              ?>
            >Paraplegic</td>
            <td><input type="checkbox" name="check35" value="1"
            <?php
              if($check_res['check35']=="1"){
                echo "checked";
              }
              ?>
            >Hemiplegic</td>
            <td><input type="checkbox" name="check36" value="1"
            <?php
              if($check_res['check36']=="1"){
                echo "checked";
              }
              ?>
            >Quadriplegic</td>
            <td><input type="checkbox"  name="check37" value="1"
            <?php
              if($check_res['check37']=="1"){
                echo "checked";
              }
              ?>
            >Assistive devices 
            <input type="checkbox" class="ml-3" name="check37a" value="1"
            <?php
              if($check_res['check37a']=="1"){
                echo "checked";
              }
              ?>
            >Amputations(limb)
              <input type="checkbox" class="ml-3" name="check38" value="1"
              <?php
              if($check_res['check38']=="1"){
                echo "checked";
              }
              ?>
              >R/L
              <input type="checkbox" name="check39" value="1"
              <?php
              if($check_res['check39']=="1"){
                echo "checked";
              }
              ?>
              >
            </td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check40" value="1"
              <?php
              if($check_res['check40']=="1"){
                echo "checked";
              }
              ?>
              >Recent injuries/fractures
            </td>
            
          </tr>
            <tr>
                        <td>
              Other:<input type="text" name="inp5" value="<?php echo $check_res['inp5'] ?>">
            </td>
           
                        
          </tr>
<tr>
    
        </tr>
        </table>
        <table style="width:100%;" class="tbl1">
            <tr>
            <td class="btndiv" style="width:100%;">
 
 <button type="submit" name="sub" value="Submit" class="subbtn">Submit</button>
 <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>

</td>
        </tr>
        </tabel>
        

      </form>
</div>
</div>
</div>
</body>
</html>