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
$pid = $_SESSION['pid'];
$encounter = $_GET["encounter"];
$data =array();

if ($formid) {
    $sql = "SELECT * FROM form_fall_risk_management WHERE id = ? AND pid = ?";
    $res = sqlStatement($sql, array($formid,$pid));
    // $data = sqlFetchArray($res);
    // print_r($data);die;

    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
      $all[$iter] = $row;
  }
  $check_res = $all[0];
}
    $check_res = $formid ? $check_res : array();
    //print_r($check_res);die;
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Fall Risk Management</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
          <tabel style="width:100%">
            <tr>  
              <td style="border: 1px solid black;width:50%;">
              Center for Network Therapy<br>
              <i>20 Gibson Place, Suite 103</i><br>
              <i>Freehold,NJ 07728</i><br>
              <i>Phone:732-431-5800</i><br>
              <i>Fax-732-431-5896</i><br>
              <br>
              <b>NURSING ADMISSION ASSESSMENT</b><br>
            </td>
              
</tr>
</tabel><br>

       <table style="border: 1px solid black;width:100%;">
           <tr>
               <td style="text-align: center;"><b>FALL RISK ASSESSMENT</b><br>
                <p>Initiate fall protocol if one or more of the following criteria are met</p>
            </td>
           </tr>
       </table>
       <table style="width: 100%;">
        <tr>
         <td style="border: 1px solid black;width:33%;">
            <input type="checkbox" name="check1" value="1" 
            <?php
            if($check_res['check1']=="1"){
              echo "checked='checked'";
            }
            ?>
            >Impaired mobility
         </td>
         <td style="border: 1px solid black;width:33%;">
         <input type="checkbox" name="check2" value="1"
            <?php
            if($check_res['check2']=="1"){
                echo "checked='checked'";
            }
            ?>
            >History of fall(s within 6 months)
        </td>
        <td style="border: 1px solid black;width:33%;">
        <input type="checkbox" name="check3" value="1"
            <?php
            if($check_res['check3']=="1"){
                echo "checked='checked'";
            }
            ?>
            >New atypical antipsychotic regime
        </td>
        </tr>
        <tr>
            <td style="border: 1px solid black;width:33%;">
            <input type="checkbox" name="check4" value="1"
            <?php
            if($check_res['check4']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Unsteady gait
            </td>
            <td style="border: 1px solid black;width:33%;">
            <input type="checkbox" name="check5" value="1"
            <?php
            if($check_res['check5']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Communication deficit
           </td>
           <td style="border: 1px solid black;width:33%;">
           <input type="checkbox" name="check6" value="1"
            <?php
            if($check_res['check6']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Withdrawal protocol
           </td>
           </tr>
           <tr>
            <td style="border: 1px solid black;width:33%;">
            <input type="checkbox" name="check7" value="1"
            <?php
            if($check_res['check7']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Drug-induced sedation
            </td>
            <td style="border: 1px solid black;width:33%;">
            <input type="checkbox" name="check8" value="1"
            <?php
            if($check_res['check8']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Hypotension
           </td>
           <td style="border: 1px solid black;width:33%;">
           <input type="checkbox" name="check9" value="1"
            <?php
            if($check_res['check9']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Urological (incontinence,frequency,nocturia)
           </td>
           </tr>
           <tr>
            <td style="border: 1px solid black;width:33%;">
            </td>
            <td style="border: 1px solid black;width:33%;">
            <input type="checkbox" name="check10" value="1"
            <?php
            if($check_res['check10']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Impaired cognition
           </td>
           <td style="border: 1px solid black;width:33%;">
           <input type="checkbox" name="check11" value="1"
          <?php
            if($check_res['check11']=="1"){
                echo "checked='checked'";
            }
            ?>
          >Visual impairment(legally blind)
           </td>
           </tr>
    </table>
    <table style="width: 100%;">
      <tr>
        <td style="border: 1px solid black;width:100%;">
          Physical limatations:<?php echo $check_res['txt1'];?>
        </td>
      </tr>
    </table>
    <table style="width: 100%;">
      <tr>
        <td style="border: 1px solid black;width:100%;"><b>Please select and complete one of the following:</b>
          <p><input type="checkbox" name="check12" value="1"
            <?php
            if($check_res['check12']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Patient does not meet criteria for all protocol</p>
            <p>
              <input type="checkbox" name="check13" value="1"
              <?php
            if($check_res['check13']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Patient meets criteria for fall protocol. MD contacted:<?php echo $check_res['inp1'];?>
            </p>
            <p><input type="checkbox" name="check14" value="1"
              <?php
            if($check_res['check14']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Ambulation order obtained and order written:<?php echo $check_res['inp2'];?></p>
              <p><input type="checkbox" name="check15" value="1" 
                <?php
                if($check_res['check15']=="1"){
                    echo "checked='checked'";
                }
                ?>>Fall protocol initiated and placed in treatment plan:</p>
                <p><input type="checkbox" name="check16" value="1" 
                  <?php
                  if($check_res['check16']=="1"){
                      echo "checked='checked'";
                  }
                  ?>>Patient meets criteria for fall protocol, however nursing judgement is not place the patient on fall protocol Rationale:<?php echo $check_res['inp3'];?></p>
                  <p>
                    <input type="checkbox" name="check17" value="1"
            
            <?php
            if($check_res['check17']=="1"){
                echo "checked='checked'";
            }
            ?>>MD notified and agrees with RN decision:<?php echo $check_res['inp4'];?>
                  </p>
                  <p>
                    <input type="checkbox" name="check18" value="1"
            <?php
            if($check_res['check18']=="1"){
                echo "checked='checked'";
            }
            ?>
            >MD notified and wants patient on fall protocol:<?php echo $check_res['check19'];?>
                  </p>
        <p>
          <input type="checkbox" name="check20" value="1"
            <?php
            if($check_res['check20']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Ambulation order obtained and written:<?php echo $check_res['inp5'];?>
        </p>
        </td>
      </tr>
    </table>
    <table style="border: 1px solid black;width:100%;">
      <tr>
        <td >
          <b>
            RESTRAINT ASSESSMENT/ RELAXATION ASSESSMENT/ ABUSE ASSESSMENT</b>
        </td>
      </tr>
    </table>
    <table style="border: 1px solid black;width:100%;">
      <tr>
        <td><b>What tools do you use to help yourself relax?</b></td>
      </tr>
      <tr>
        <td>
        <input type="checkbox" name="check21" value="1"
              <?php
            if($check_res['check21']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Music 
              <input type="checkbox" name="check22" value="1"
              <?php
            if($check_res['check22']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Talking it out
              <input type="checkbox" name="check23" value="1"
              <?php
            if($check_res['check23']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Exercise
              <input type="checkbox" name="check24" value="1"
              <?php
            if($check_res['check24']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Relaxation techniques
              <input type="checkbox" name="check25" value="1"
              <?php
            if($check_res['check25']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Meditation
              <input type="checkbox" name="check27" value="1"
              <?php
            if($check_res['check27']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Reading
              <input type="checkbox" name="check28" value="1"
              <?php
            if($check_res['check28']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Quit time
              <input type="checkbox" name="check29" value="1"
              <?php
            if($check_res['check29']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Video games<br>
              <input type="checkbox" name="check30" value="1"
              <?php
            if($check_res['check30']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Journaling
              <input type="checkbox" name="check31" value="1"
              <?php
            if($check_res['check31']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Computer
              <input type="checkbox" name="check32" value="1"
              <?php
            if($check_res['check32']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Watching TV
              <input type="checkbox" name="check33" value="1"
              <?php
            if($check_res['check33']=="1"){
                echo "checked='checked'";
            }
            ?>
              >Other:<?php echo $check_res['inp6'];?>
            </td>
      </tr>
      <tr>
        <td>
        <b>Identify whether patient has history of abuse:</b>
              <input type="checkbox" name="check34" value="1"  <?php
            if($check_res['check34']=="1"){
                echo "checked='checked'";
            }
            ?>>No history of abuse
              <input type="checkbox" name="check35" value="1"  <?php
            if($check_res['check35']=="1"){
                echo "checked='checked'";
            }
            ?>>Physical abuse
              <input type="checkbox" name="check36" value="1"  <?php
            if($check_res['check36']=="1"){
                echo "checked='checked'";
            }
            ?>>Sexual abuse
              <input type="checkbox" name="check37" value="1"  <?php
            if($check_res['check37']=="1"){
                echo "checked='checked'";
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
          <input type="checkbox" name="check38" value="1"
          <?php
        if($check_res['check38']=="1"){
            echo "checked='checked'";
        }
        ?>
          >No&nbsp;&nbsp;&nbsp;<input type="checkbox" name="check39" value="1"
          <?php
        if($check_res['check39']=="1"){
            echo "checked='checked'";
        }
        ?>
          >Yes (If yes, describe episode):<?php echo $check_res['inp7'];?>
        </td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td><b><u>Rapid Plasma Regain (RPR) Test</u></b>
          
          <p>
            Patient was educated about Syphilis and the RPR screening test.
          </p>
        </td>
        </tr>
        <tr>
          <td>
         <input type="checkbox" name="check40" value="1" 
            <?php
            if($check_res['check40']=="1"){
                echo "checked='checked'";
            }
            ?>>Patient consented to have the RPR test.</td>
          </tr>

                    <tr>
            <td><input type="checkbox" name="check41" value="1"
            <?php
            if($check_res['check41']=="1"){
                echo "checked='checked'";
            }
            ?>
            >Patient denied RPR testing.</td>
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
              <p>Patient consented to HIV testing&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="check42"value="1" 
              <?php
            if($check_res['check42']=="1"){
                echo "checked='checked'";
            }
            ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="check43" value="1"
            <?php
            if($check_res['check43']=="1"){
                echo "checked='checked'";
            }
            ?>>Yes</p>
            </td>
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
$mpdf->setTitle("Fall Risk Management");
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
//     $pdf_data = sqlInsert('INSERT INTO pdf_directory (path,pid,encounter,formid) VALUES (?,?,?,?)',array($filename,$_SESSION["pid"],$_SESSION["encounter"],$formid));
// }

$mpdf->Output("Fall Risk Management.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>