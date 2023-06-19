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
$pid = $_SESSION["pid"];
$encounter = $_GET["encounter"];


$check_res =array();

    $sql = "SELECT * FROM form_umr WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'oxford_form.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>


<style>
        
</style>
<body id='body' class='body'>
<?php
// $header ="<div class='row'style='line-height:1px;' >
// </div>";
ob_start();
?>
<img src="uploads/1.jpeg" width="1000px"/>
<h3 style="text-align:center">APPEALS -DESIGNATION OF AUTHORIZED REPRESENTATIVE</h3><br><br>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">I, <span style="color:brown" ><?php echo text($check_res['fname']); ?></span></label>
</td>
<td style="width:50%;">
<label style="font-size: 14px;">do hereby appoint,<span style="color:brown" ><?php echo text($check_res['lname']); ?></span></label>
</td>
</tr>
</table>(hereinafter my Authorized Representative") to act on  my behalf  in pursuing  a  benefit claim, specifically, claim(s) foe XX.  My Authorized representative shall have full authority to act, and receive notices, on my behalf with respect to an initial determination of the claim,
            any request for documents relating to the claim, any appeal of  an  adverse  benefit determination of the claim and any request for external review/IRO of the claim if
            applicable.<br>
            <br><?php
                        if(isset($check_res['text1'])){
                             echo $check_res['text1']; 
                        } else{
                            ?>
                            I understand that in the absence of a contrary direction from me, UJMR will  direct  all information and notices regarding the claim to which I otherwise an entitled, including benefit determinations, to my Authorized representative only.
            <br><br>I am aware that the Standards for Privacy of Individually Identifiable Health Information set forth by the U.S. Department of Health and Human Services (the "Privacy Standards") govern  access  to  medical  information.  I   under-stand   that   in   connection   with   the performance of his/her duties hereunder, my Authorized Representative may receive my Protected Health Information, as defined in the Privacy Standards, relating to the claim.  I hereby consent to any disclosure of my Protected Health Information to my Authorized representative
            <?php
            }
             ?>
            <br>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:30%;">
<h3 style="font-size: 14px;">Date: <span style="color:brown" ><?php echo text($check_res['date1']); ?></span></h3>
</td>
<td style="width:60%;"> 
<h3 style="font-size: 14px;">Signature of patient or patient's signature: <span style="color:brown" ><?php echo text($check_res['signature1']); ?></span></h3>
</td>


</tr>
</table><br>
<h2 style="text-align:center">ACKNOWLEDGEMENT</h2><br>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:40%;"> 
<label style="font-size: 14px;">I,     <span style="color:brown" > <?php echo text($check_res['ack']); ?></span></label>
</td>
<td style="width:60%;">
<label style="font-size: 14px;">have read the above Designation of Authorized Representative </label>
</td>
</tr>
</table>
<p> and I hereby accept this Designation and agree to act as Authorized Representaive for XX with respect to the above defined claim.</p>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:40%;">
<h3 style="font-size: 14px;">Date:<span style="color:brown" ><?php echo text($check_res['date2']); ?></span></h3>
</td>
<td style="width:60%;"> 
<h3 style="font-size: 14px;">Signature of Authorized Representaive: <span style="color:brown" ><?php echo text($check_res['signature2']); ?></span></h3>
</td>


</tr>
</table><br>
<p>Notices may sent to the Authorized Representaive at the following Address:</p><br>

<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Name: <span style="color:brown" ><?php echo text($check_res['Nname']); ?></span></label>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Street address:<span style="color:brown" > <?php echo text($check_res['Naddress']); ?></span></label>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">City,State & Zipcode:<span style="color:brown" > <?php echo text($check_res['Ncity']); ?></span></label>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Phone Number:<span style="color:brown" > <?php echo text($check_res['Nnumber']); ?></span></label>
</td>
</tr>
</table>


<?php
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Oxford Form");
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

$mpdf->Output('test.pdf', 'D');
// header("Location:../../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();

?>