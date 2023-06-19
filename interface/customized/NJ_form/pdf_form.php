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
    $sql = "SELECT * FROM form_nj WHERE id = ? AND pid = ?";
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

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
        <div class="div1" style= "border-bottom: 1px solid black;";>
            <!-- <p class="p1" style="text-align:right;font-size: 20px;font-weight: 600;";>AUTHORIZATION TO DISCLOSE <br> HEALTH INFORMATION <br> EXTERNAL REVIEW </p> -->
            <img src="uploads/NJ External Review Authorization.jpg" width="100%">
            <br><br>
          </div>
          
            <p style="margin-left: 50px;font-size: 15px;"; >Individual/Member Name:<span style="border-bottom: 1px solid black";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo text($check_res['mname']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
     
          
            <p style="margin-left: 50px;font-size: 15px;";>Member Identification Number:<span style="border-bottom: 1px solid black;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo text($check_res['midnum']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
          
      
            <p style="margin-left: 50px;font-size: 15px;";>Member Date of Birth:<span style="border-bottom: 1px solid black;";><?php echo text($check_res['dob']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <?php
                        if(isset($check_res['text1'])){
                             echo $check_res['text1']; 
                        } else{
                            ?>
            <p style="font-size: 15px;";>I have requested an independent review organization (IRO) conduct a review of a benefit decision. In order for the IRO to conduct a thorough review, I understand the reviewer must be given a copy of all relevant records.</p>
            <p style="font-size: 15px;";>By signing this form I am authorizing ValueOptions, Inc., its subcontractors and all applicable medical providers to release to the IRO all information relating to the decision to be reviewed including, but not limited to, my files and medical record information. By initialing the lines below, I understand and agree the information to be disclosed may also include information relating to mental health, alcohol or substance use and HIV/AIDS. If I do not initial the lines below, I understand that information will not be given to the IRO and will not be included in the IRO review.</p>
            <?php
            }
             ?>
            <i style="font-size: 15px;";>The information to be disclosed includes (indicate by initialing):</i>

            <p style="font-size: 15px;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 15px; border-bottom: 1px solid black;";><?php echo text($check_res['mbh']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            Mental/Behavioral Health Information</p>

            <p style="font-size: 15px;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 15px; border-bottom: 1px solid black;";><?php echo text($check_res['ali']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            Alcohol/Substance Use Information</p>

            <p style="font-size: 15px;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 15px; border-bottom: 1px solid black;";><?php echo text($check_res['hiv']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            HIV/AIDS Information</p>
            <?php
            if(isset($check_res['text2'])){
                             echo $check_res['text2']; 
                        } else{
                            ?>
            <p style="font-size: 15px;"; > I understand the IRO will use this information to make a determination on my external review. This release is valid until the IRO issues a final decision or upon my revocation. I acknowledge that I may revoke this authorization at any time by sending a written statement to ValueOptions, Inc. My revocation will be effective upon receipt, but will not affect actions already taken on the basis of the authorization. </p>
          <p style="font-size: 15px;";> I understand that I have a right to refuse to sign this authorization. I also understand that completing this authorization is not a condition to receive treatment, payment or eligibility. ValueOptions, Inc. is not responsible for any action taken by an authorized recipient of my protected health information. I am aware that an authorized recipient may redisclose my information and my information may no longer be protected by the privacy law. Upon your request, a copy of this form will be provided to you. </p>
          <p style="font-size: 15px; border-bottom: 1px solid black;";> This authorization must be dated and signed by the individual whose information will be released or by a person who is legally authorized to act on the individual’s behalf. </p>
          <?php
            }
             ?>
          <p class="p7">Signature of the Individual or the Individual’s Legally Authorized Representative** </p><span style="font-size: 15px; border-bottom: 1px solid black; width:50%;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo text($check_res['signilr']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="font-size: 15px";>Date:</span>
          <span style="font-size: 15px; border-bottom: 1px solid black; width:50%;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo text($check_res['date2']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

          <p style="font-size: 15px;";>Print Name:</p>
          <p style="font-size: 15px; border-bottom: 1px solid black;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo text($check_res['printn']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

          <p style="font-size: 15px;";>Relationship to the Individual/Member:</p>

          <input type="checkbox" name="legal" value="1" id="ip10"
          <?php if($check_res['legal']== "1") { ?> checked="checked" <?php } ?>
          ><span style="font-size: 15px;";>Self</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          <input type="checkbox" name="lar" value="1" id="ip11" 
            <?php if($check_res['lar']== "1") { ?> checked="checked" <?php } ?>
            ><span style="font-size: 15px;";>Legally Authorized Representative**</span><br><br>

            <input type="checkbox" name="pomc" value="1" id="ip12"
            <?php if($check_res['lar']== "1") { ?> checked="checked" <?php } ?>
            ><span style="font-size: 15px;";>Parent of Minor Child</span>

            <i  style="font-size: 15px;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Power of Attorney, Legal Guardian, Executor or Administrator) ** If you are signing as a Legally Authorized Representative attach a copy of the appropriate legal document(s) granting you the authority to do so.</i>

            <p style="font-size: 15px; font-weight: bold; text-decoration:underlined";>External Review Request <br> Required Information <br>Please complete the following: </p>
            <br>
            <br>
            <span style="font-size: 15px;";>Insurer Name:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 15px;border-bottom: 1px solid black;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo text($check_res['insname']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="font-size: 15px;";>Member ID #:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span  style="font-size: 15px;border-bottom: 1px solid black;";><?php echo text($check_res['insname']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <br><br>
            <span style="font-size: 15px;";>Patient Name:</span>
            <span style="font-size: 15px;border-bottom: 1px solid black;";>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo text($check_res['patname']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br><br>
            <span style="font-size: 15px;";>Phone # and Mailing Address of Claimant:<span style="font-size: 15px;border-bottom: 1px solid black;";>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo text($check_res['napmame']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
            <br><br>
            <span style="font-size: 15px;";>Tracking # in the Header of Adverse Determination Letter:</span>
            <span style="font-size: 15px;border-bottom: 1px solid black;"; >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo text($check_res['thad']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><p></p>

            
            <span style="font-size: 15px;font-weight:bold;";>Mail the completed form to:</span>
            <span style="font-size: 15px; font-weight:bold;";>ValueOptions 12369-C Sunrise Valley Drive, Reston, VA 20191</span><p></p>

            <span style="font-size: 15px;font-weight:bold;";>Or fax it to:</span>
            <span style="font-size: 15px; font-weight:bold;";>877-826-8584</span>
         </div>
    </div>
</div>

<?php

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("UBH Form");
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
// $mpdf->SetHTMLHeader($header);
// $mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($body);
$mpdf->defaultfooterline = 0;
//         //save the file put which location you need folder/filname
// $checkid = sqlQuery("SELECT formid FROM pdf_directory WHERE formid=?", array($formid));
// if($checkid['formid'] != $formid){
//     $pdf_data = sqlInsert('INSERT INTO pdf_directory (path,pid,encounter,formid) VALUES (?,?,?,?)',array($filename,$_SESSION["pid"],$_SESSION["encounter"],$formid));
// }

$mpdf->Output("test.pdf", 'D');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>