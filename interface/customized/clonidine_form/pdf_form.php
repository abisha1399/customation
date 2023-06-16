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
$pid = $_session['pid'];
$encounter = $_GET["encounter"];
$data =array();

if ($formid) {
    $sql = "SELECT * FROM form_clonidine WHERE id = ?";
    $res = sqlStatement($sql, array($formid));
    //$data = sqlFetchArray($res);
    // print_r($data);die;

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

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Clonidine Form</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
        <table style="width: 100%;border:1px solid black;">
         <tr>
           <td>
             <h3>Clonidine Withdraw Protocol A</h3>
             
           </td>
           <td><span id="span1">Allergies:<?php echo $check_res['inp1'];?></span></td>
         </tr>
          </table>
          <table style="width: 100%;">
         <tr>
           <td style="border:1px solid black;width: 40%;"><b>Patinet Name:<?php echo $check_res['inp39'];?></b></td>
           <td style="border:1px solid black; font-size:13px;"><span id="span2">DOB:<?php echo $check_res['inp2'];?></span></td>
         </tr>
         </table>
         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"><b>Medication, Dose, Frequency, Route</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Hour</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/Patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
           </tr>
         </table>

         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine <?php echo $check_res['inp3'];?>mg PO 4x daily on Day of Admission Date:<?php echo $check_res['inp4'];?></td>
             <td style="border:1px solid black;width: 10%;">9.30 AM</td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp12'];?></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">12.00 PM</td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp13'];?></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">3.30 PM</td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp14'];?></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">6.30 AM</td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp15'];?></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine <?php echo $check_res['inp5'];?> mg PO TID on Day 2 Date: <?php echo $check_res['inp6'];?> </td>
             <td style="border:1px solid black;width: 10%;">9:30 AM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
             <td style="border:1px solid black;width: 10%;"> <?php echo $check_res['inp16'];?></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
           </tr>
         </table>

         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">12.30 PM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp17'];?></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">5.00 PM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp18'];?></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
                  <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine <?php echo $check_res['inp7'];?> mg PO BID on Day 3 Date:<?php echo $check_res['inp8'];?></td>
             <td style="border:1px solid black;width: 10%;">9.30 AM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"> <?php echo $check_res['inp19'];?> </td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>

         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">5.00 PM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp20'];?></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
      <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine <?php echo $check_res['inp9'];?> mg PO in AM on Day 4 Date: <?php echo $check_res['inp10'];?> </td>
             <td style="border:1px solid black;width: 10%;">9.30 AM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"> <?php echo $check_res['inp21'];?> </td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>

         <table width="100%;" class="tbl3">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine <?php echo $check_res['inp11'];?> mg PO Q2<br>hours PRN signs/symptoms<br>of opiate withdrawl(i.e<br>.abdominal/muscle cramping,<br>N/V,diarrhea,lacrimation,<br>rhinorrhea,joint pain),or one<br>of the following: Pulse>95,<br>SBP>140,DBP>95.<br>Maximum 10 doses in 24<br>hours. Hold for BP <90,DBP <br> <60, or P <60.</td>
             <td style="border:1px solid black;width: 10%;"><b>PRN</b></td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp22'];?></td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp23'];?></td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp24'];?></td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp25'];?></td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp26'];?></td>
             <td style="border:1px solid black;width: 10%;"><?php echo $check_res['inp27'];?></td>
           </tr>
         </table><br><br>

         <table width="100%;" class="ltbl">
           <tr>
             <td>Order Date: <?php echo $check_res['inp28'];?></td>
             <td><b>Patient Signature:</b>
             <?php if($check_res['inp29']){ ?>
             <img src='data:image/png;base64,<?php echo xlt($check_res['inp29']); ?>' width='100px' height='50px'/>
             <?php }?>
            </td>
             <td><b>Patient Initials: <?php echo $check_res['inp30'];?></b></td>
             <td>Reason Medication Not Given</td>
           </tr>

            <tr>
             <td>Nurse Transcribing Orders: <?php echo $check_res['inp31'];?></td>
             <td>Nurse Signature: 
             <?php if($check_res['inp32']){ ?>
             
             <img src='data:image/png;base64,<?php echo xlt($check_res['inp32']); ?>' width='100px' height='50px'/>
             <?php }?>
                        </b></td>
             <td>Nurse Initals: <?php echo $check_res['inp33'];?></td>
             <td>1.Patient Refused</td>
           </tr>
           <tr>
             <td>Verfying Nurse: <?php echo $check_res['inp34'];?></td>
             <td>Nurse Signature:
             
             <?php if($check_res['inp35']){ ?> 
             <img src='data:image/png;base64,<?php echo xlt($check_res['inp35']); ?>' width='100px' height='50px'/><?php }?> </b></td>
             <td>Nurse Initals: <?php echo $check_res['inp36'];?></td>
             <td>1.Patient's Condition</td>
           </tr>

                       <tr>
             <td></td>
             <td>Nurse Signature: 
             <?php if($check_res['inp37']){ ?> 
             <img src='data:image/png;base64,<?php echo xlt($check_res['inp37']); ?>' width='100px' height='50px'/> 
             <?php }?> 
            </b></td>
             <td>Nurse Initals: <?php echo $check_res['inp38'];?></td>
             <td>1.Hold per MD Order</td>
           </tr>
         </table><br>


            

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
$mpdf->setTitle("Clonidine Form");
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

$mpdf->Output("Clonidine Form.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>