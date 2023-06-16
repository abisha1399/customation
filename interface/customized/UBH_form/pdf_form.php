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
    $sql = "SELECT * FROM form_ubh WHERE id = ? AND pid = ?";
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
<style>
  .div1 input{
    outline:none;
  }
  </style>
<?php
ob_start();
 ?>
   <div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
        <h2 class="heading" style="text-align: right; font-size:20px;">Authorized Representative Form-Commercial Appeals</h2>
          <p class="p-size">A member (or “patient”) may use this form to designate an authorized representative to act on his or her <br> behalf regarding an appeal of a denial of service or payment. </p>
          <p class="p-size">Your legal representative may submit the appropriate legal documentation in place of this form. (for example: <br> power of attorney, guardianship papers, foster parent certification or court order). </p>
          <p class="p-size1"><b>1. Member/Patient Information:</b> (Please provide the following information) </p>
          <table style="border: 1px solid black; width:100%;">
          <div class="div1">
            <tr>
              <td  colspan="2" style="border: 1px solid black;">
              <label for="fnameid" class="fn">First Name: <?php echo xlt($check_res['fname']); ?></label>
              </td>
              <td style="border: 1px solid black;">
              <label for="lnameid">Last Name:<?php echo xlt($check_res['lname']); ?></label> 
              </td>
            </tr>
</div>
            <tr>
                <td  style="border: 1px solid black;">
                  <label for="labelid">Address:<?php echo xlt($check_res['address']); ?></label>
                </td>
                <td  style="border: 1px solid black;">
                  <label for="cityid">City:<?php echo xlt($check_res['city']); ?></label>
                </td>
                  <td style="border: 1px solid black;">
                  <label for="stateid">State:<?php echo xlt($check_res['state']); ?></label>
                </td>
              </tr>
              <tr>
                <td  colspan="2" style="border: 1px solid black;">
                  <label for="dpn">Daytime Phone (include area code):<?php echo xlt($check_res['phn']); ?></label>
                </td>
                <td  style="border: 1px solid black;">
                  <label for="mpid">Member/Patient ID:<?php echo xlt($check_res['pid1']); ?></label>
                </td>
              </tr>
              <tr>
              <td  colspan="2" style="border: 1px solid black;">
                  <label for="dob">Date of Birth (mm/dd/yyyy):<?php echo xlt($check_res['phone']); ?></label>
              </td>
                <td style="border: 1px solid black;">
                  <label for="ref">Reference or claim number (if known)<?php echo xlt($check_res['patid']); ?></label>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border: 1px solid black;">
                  <label for="desid">Description of service and/or date of denial of service or payment:<?php echo xlt($check_res['description']); ?></label>
                </td>
              </tr>
          </table>
          <p class="p-size pm"><b>2. Person I am authorizing to pursue my appeal:</b> (Please provide the following information for your authorized representative) </p>
          <table  style="border: 1px solid black; width:100%;">
            
              <tr>
                <td colspan="2" style="border: 1px solid black;">
                  <label for="fnid2">First Name:<?php echo xlt($check_res['firstname']); ?></label>
                </td>
                <td style="border: 1px solid black;">
                  <label for="lnid2">Last Name:<?php echo xlt($check_res['lastname']); ?></label>
                </td>
              </tr>
              <tr>
                <td style="border: 1px solid black;">
                  <label for="ad2id">Address:<?php echo xlt($check_res['add2']); ?></label>
                </td>
                <td style="border: 1px solid black;">
                  <label for="ct2id">City:<?php echo xlt($check_res['city2']); ?></label>
                </td>
                <td style="border: 1px solid black;">
                  <label for="stateid2">State:<?php echo xlt($check_res['state2']); ?></label>
                  
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border: 1px solid black;">
                  <label for="dpid1">Daytime Phone: (include area code):<?php echo xlt($check_res['dpn']); ?></label>
                  
                </td>
              </tr>
            
          </table>

          <p class="p-size pm"><b>3. Member/Patient:</b> By signing below I authorize the person named above to act on my behalf and receive information from United Behavioral Health and its subsidiaries in connection with my appeal. This information may include the following: </p>
          <p>All medical and financial information contained in my insurance file, including but not limited to treatment for venereal disease, alcoholism and drug abuse, abortion, mental disorder and HIV status relating to my examination, treatment and hospital confinement in connection with the determination which is being appealed.</p>
          <p class="p-size pm">I understand this information is confidential and will only be released as specified in this authorization. This authorization is only valid for 1 year from the date of the signature of Member/Patient or Legal Guardian below.</p>
          <table style="border: 1px solid black; width:100%;">
            
              <tr>
                <td style="border: 1px solid black;">
                  <label for="sig" class="field">Signature of Member/Patient or Legal Guardian / Parent if a minor.</label>
                  <br>
                </td>
                <td style="border: 1px solid black;">
                  <label class="field" for="npid2">Name of Member/Patient or Legal Guardian /Parent if a minor. (Please Print)</label>
                </td>
                <td style="border: 1px solid black;">
                  <label class="field" for="dt2">Date</label>
                </td>
              </tr>
              <tr>
                <td style="border: 1px solid black; height:30px;">
                <?php echo xlt($check_res['sign']); ?>
                </td>
                <td style="border: 1px solid black;">
                <?php echo xlt($check_res['nmpidname']); ?>
                </td>
                <td style="border: 1px solid black;">
                <?php echo xlt($check_res['date2']); ?>
                </td>
              </tr>
           
          </table>

          <p class="p-size pm"><b>4. Representative:</b> By signing below you are certifying you will represent the member to the best of your abilities and do not have a conflict of interest posed by any relationships you may have with the insurance company or providers whom the member is seeking care. </p>
          <table  style="border: 1px solid black; width:100%;">
            
              <tr>
                <td style="border: 1px solid black;">
                  <label for="sig1" class="field">Signature of Authorized Representative</label>
                  <br>
                </td>
                <td style="border: 1px solid black;">
                  <label class="field" for="npid22">Name of Authorized Representative (Please Print)</label>
                </td>
                <td style="border: 1px solid black;">
                  <label class="field" for="dt22">Date</label>
                </td>
              </tr>
              <tr>
                <td style="border: 1px solid black; height:30px;">
                <?php echo xlt($check_res['sign2']); ?>
                </td>
                <td style="border: 1px solid black;">
                <?php echo xlt($check_res['nmpidname2']); ?>
                </td>
                <td style="border: 1px solid black;">
                <?php echo xlt($check_res['date3']); ?>
                </td>
              </tr>
          </table>
          <p class="p-size pm"><b>5.</b>Please include a copy (keep the original) of the adverse determination notice you received.</p>
          <p class="p-size pm"><b>6.</b>Submit this completed form to AOR Processing via</p>
          <p class="p-size pm"> Fax to: 866-322-0051</p>
          <div class="dp">
            <p class="p-size pm text_b">Mail to: </p>
            <p>
              <b> AOR Processing <br> 11000 Optum Circle <br> Mail Route MN103-0600 <br> Eden Prairie, MN 55344 </b>
            </p>
          </div>    
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

$mpdf->Output("test.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>