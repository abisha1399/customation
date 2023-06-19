<html>
  <head>
  <link rel="stylesheet" href="./style.css">
</head>

<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");

$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$name = $_GET['formname'];
$pid = $_SESSION['pid'];;
$encounter = $_GET["encounter"];
$data =array();

 if ($formid) {
       $sql = "SELECT * FROM `form_system_assessment` WHERE id=? AND pid = ? AND encounter = ?";
       $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
       for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
           $all[$iter] = $row;
       }
       $check_res = $all[0];
   }
    $check_res = $formid ? $check_res : array();
    // print_r($check_res);die;
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Systems Assessment Form</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
        <table style="width:100%;">
          <tr>
            <td><b>Nursing Admission Assessment</b></td>
            <td style="width: 30%;"><b>Center for Network Therapy</b></td>
          </tr>
        </table>
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
                echo "checked='checked'";
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
                echo "checked='checked'";
              }
              ?>
              >Visual Impairment
            </td>
                        <td style="width:20%;">
              <input type="checkbox" name="check3" value="1" 
              <?php
              if($check_res['check3']=="1"){
                echo "checked='checked'";
              }
              ?>
              >Hearing Impairment
            </td>
          </tr>
          <tr>
            <td><input type="checkbox" name="check4" value="1"
            <?php
              if($check_res['check4']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Eyeglasses/Contacts</td>
            <td><input type="checkbox" name="check5" value="1" 
            <?php
              if($check_res['check5']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Deaf</td>
            <td><input type="checkbox" name="check6" value="1" 
            <?php
              if($check_res['check6']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Hard of hearing R/L</td>
          </tr>
                    <tr>
            <td></td>
            <td><input type="checkbox" name="check7" value="1"
            <?php
              if($check_res['check7']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Hearing aids R/L</td>
            <td></td>
          </tr>
          <tr>
            <td>Other:<b><?php echo $check_res['inp1']; ?></b></td>
            <td>Other:<b><?php echo $check_res['inp2']; ?></b></td>
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
                echo "checked='checked'";
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
                echo "checked='checked'";
              }
              ?>
            >Edema</td>
            <td><input type="checkbox" name="check9" value="1" 
            <?php
              if($check_res['check9']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Bruising</td>
            <td><input type="checkbox" name="check10" value="1" 
            <?php
              if($check_res['check10']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Calf Tenderness&nbsp;&nbsp;R/L</td>
            <td><input type="checkbox" name="check11" value="1" 
            <?php
              if($check_res['check11']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Hemodialysis</td>
          </tr>
          <tr>
            <td>(Location)</td>
            <td>(Location)</td>
          </tr>
          <tr><td>Other:<b><?php echo $check_res['inp3'];?></b></td></tr>
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
                echo "checked='checked'";
              }
              ?>
                  ></b> 
              </p>
            </td>
          </tr>
        </table>
        <table style="border-bottom: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;width: 100%;";>
          <tr>
            <td>
            <b><u>Abnormal Findings</u></b>
          </tr></td>
          <tr>
            <td><input type="checkbox" name="check13" value="1"
            <?php
              if($check_res['check13']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Cough</td>
            <td><input type="checkbox" name="check14" value="1"
            <?php
              if($check_res['check14']=="1"){
                echo "checked='checked'";
              }
              ?>
            >In-haler</td>
            <td><input type="checkbox" name="check15" value="1"
            <?php
              if($check_res['check15']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Nebulizer</td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check16" value="1"
              <?php
              if($check_res['check16']=="1"){
                echo "checked='checked'";
              }
              ?>
              >Productive
            </td>
            <td>
              <input type="checkbox" name="check17" value="1"
              <?php
              if($check_res['check17']=="1"){
                echo "checked='checked'";
              }
              ?>
              >Non-Productive
            </td>
          </tr>
          <tr>
            <td>Other:<b><?php echo $check_res['inp4'];?></b></td>
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
                echo "checked='checked'";
              }
              ?>
                  ></b> 
              </p>
            </td>
          </tr>
        </table>
                <table style="border-bottom: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;width: 100%;";>
          <tr>
            <td>
            <b><u>Abnormal Findings</u></b>
          </tr></td>
          <tr>
            <td><input type="checkbox" name="check18" value="1"
            <?php
              if($check_res['check18']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Diarrhea</td>
            <td><input type="checkbox" name="check19" value="1" 
            <?php
              if($check_res['check19']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Constipation</td>
            <td><input type="checkbox" name="check20" value="1" 
            <?php
              if($check_res['check20']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Ostomy</td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check21" value="1"
              <?php
              if($check_res['check21']=="1"){
                echo "checked='checked'";
              }
              ?>
              >Peg tube
            </td>
            <td>
              <input type="checkbox" name="check22" value="1"
              <?php
              if($check_res['check22']=="1"){
                echo "checked='checked'";
              }
              ?>
              >Distention
            </td>
                        <td>
              <input type="checkbox" name="check23" value="1"
              <?php
              if($check_res['check23']=="1"){
                echo "checked='checked'";
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
                echo "checked='checked'";
              }
              ?>
              >Other:<?php echo $check_res['systext'];?>
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
                echo "checked='checked'";
              }
              ?>
                  ></b> 
              </p>
            </td>
          </tr>
        </table>
                <table style="border-bottom: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;width: 100%;";>
          <tr>
            <td>
            <b><u>Abnormal Findings</u></b>
          </tr></td>
          <tr>
            <td><input type="checkbox" name="check26" value="1"
            <?php
              if($check_res['check26']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Frequency</td>
            <td><input type="checkbox" name="check27" value="1"
            <?php
              if($check_res['check27']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Urgency</td>
            <td><input type="checkbox" name="check28" value="1"
            <?php
              if($check_res['check28']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Burning</td>
            <td><input type="checkbox" name="check29" value="1"
            <?php
              if($check_res['check29']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Incontinence</td>
            <td><input type="checkbox" name="check30" value="1"
            <?php
              if($check_res['check30']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Catheter(location)</td>

          </tr>
          <tr>
            <td>
              <input type="checkbox" name="check31" value="1"
              <?php
              if($check_res['check31']=="1"){
                echo "checked='checked'";
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
                echo "checked='checked'";
              }
              ?>
              >Other:<?php echo $check_res['systext1'];?>
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
                echo "checked='checked'";
              }
              ?>></b> 
              </p>
            </td>
          </tr>
        </table>
                <table style="border-bottom: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;width: 100%;";>
          <tr>
            <td>
            <b><u>Abnormal Findings</u></b>
          </tr></td>
          <tr>
            <td><input type="checkbox" name="check34" value="1"
            <?php
              if($check_res['check34']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Paraplegic</td>
            <td><input type="checkbox" name="check35" value="1"
            <?php
              if($check_res['check35']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Hemiplegic</td>
            <td><input type="checkbox" name="check36" value="1"
            <?php
              if($check_res['check36']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Quadriplegic</td>
            <td><input type="checkbox" name="check37" value="1"
            <?php
              if($check_res['check37']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Assistive devices 
            <input type="checkbox" name="check37a" value="1"
            <?php
              if($check_res['check37a']=="1"){
                echo "checked='checked'";
              }
              ?>
            >Amputations(limb)
              <input type="checkbox" name="check38" value="1"
              <?php
              if($check_res['check38']=="1"){
                echo "checked='checked'";
              }
              ?>
              >R/L
              <input type="checkbox" name="check39" value="1"
              <?php
              if($check_res['check39']=="1"){
                echo "checked='checked'";
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
                echo "checked='checked'";
              }
              ?>
              >Recent injuries/fractures
            </td>
            
          </tr>
            <tr>
                        <td>
              Other:<b><?php echo $check_res['inp5']; ?></b>
            </td>
           
                        
          </tr>
<tr>
    
        </tr>
        </table>

            

        </div>
      </div>
</div>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Recovery Management Form");
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($body);
$mpdf->defaultfooterline = 0;
//         //save the file put which location you need folder/filname
// $checkid = sqlQuery("SELECT formid FROM pdf_directory WHERE formid=?", array($formid));
// if($checkid['formid'] != $formid){
//     $pdf$check_res = sqlInsert('INSERT INTO pdf_directory (path,pid,encounter,formid) VALUES (?,?,?,?)',array($filename,$_SESSION["pid"],$_SESSION["encounter"],$formid));
// }

$mpdf->Output("Recovery Management Form.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>