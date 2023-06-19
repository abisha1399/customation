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

    $sql = "SELECT * FROM form_oxford WHERE id = ? AND pid = ?";
   
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





<img src="uploads/oxford_form.png" height=100px/>      
<h1 class="header">Authorization for Release of Health Information</h1>
        <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:30%;"> 
<label style="font-size: 14px;">Member's Name: <?php echo text($check_res['Mname']); ?></label>
</td>
<td style="width:20%;">
<label style="font-size: 14px;">Date Of Birth: <?php echo text($check_res['Mdob']); ?></label>
</td>
<td style="width:30%;">
<label style="font-size: 14px;">Member's Id or Subscriber Id: <?php echo text($check_res['Mid']); ?></label>
</td>

</tr>
</table><br>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:30%;"> 
<label style="font-size: 14px;">Members street address : <?php echo text($check_res['Maddress']); ?></label>
</td>
<td style="width:20%;">
<label style="font-size: 14px;">city:<?php echo text($check_res['Mcity']); ?></label>
</td>
<td style="width:15%;">
<label style="font-size: 14px;">state:<?php echo text($check_res['Mstate']); ?></label>
</td>
<td style="width:15%;">
<label style="font-size: 14px;">zipcode:<?php echo text($check_res['Mzipcode']); ?></label>
</td>

</tr>
</table>



        
        <div class="content">
        <p style="font-size:20px;font-weight: bold;background-color:brown;color:white">I understand and agree that:         </p>
        <?php
                        if(isset($check_res['text1'])){
                             echo $check_res['text1']; 
                        } else{ ?>
        <ul>
            <li>this authorization is voluntary;</li>
            <li>my health information may contain information created by other persons or entities including
                health care providers and may contain medical, pharmacy, dental, vision, mental health,
                substance abuse, HIV/AIDS, psychotherapy, reproductive, communicable disease and
                health care program information;</li>
            <li>I may not be denied treatment, payment for health care services, or enrollment or eligibility
                for health care benefits if I do not sign this form;
                </li>
            <li>my health information may be subject to re-disclosure by the recipient, and if the recipient is
                not a health plan or health care provider, the information may no longer be protected by the
                federal privacy regulations;</li>
            <li>this authorization will expire one year from the date I sign the authorization. I may revoke this
                authorization at any time by notifying Oxford Health Plans, Inc. or Oxford Health Insurance,
                Inc. (“Oxford”), 1 as appropriate, in writing; however, the revocation will not have an effect on
                any actions taken prior to the date my revocation is received and processed.</li>
        </ul> 
        <?php
            }
             ?>
    </div>
    <div class="content2">
        <h3 style="font-size:20px;font-weight: bold;background-color:brown;color:white">Who May Receive and Disclose My Information: </h3>
        <p>I authorize Oxford and its affiliates to receive from or disclose my individually identifiable health
            information to the following person(s) or organization(s):</p><br>
            <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Full Name of Person(s) or Organization(s): <?php echo text($check_res['org1']); ?></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Full Name of Person(s) or Organization(s): <?php echo text($check_res['org2']); ?></label>
</td>

</tr>
</table>
            <h3 style="font-size:20px;font-weight: bold;background-color:brown;color:white">Type of Information to Be Disclosed: </h3>
            </div>
            <input type=checkbox name='checkbox1' value="" <?php
     if ($check_res['checkbox1'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp; I authorize disclosure of all my health information including information relating to medical, pharmacy, dental, vision, mental health, substance abuse, HIV/AIDS, psychotherapy, reproductive, communicable disease and health care program information; or<br>
    <input type=checkbox name='checkbox3' value="" <?php
     if ($check_res['checkbox3'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp;I authorize only the disclosure of the following information<br>
            <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<h3 style="font-size: 14px;">Type of Information: <?php echo text($check_res['information1']); ?></h3>
</td>

</tr>
</table>
        </div>
            <h3 style="font-size:20px;font-weight: bold;background-color:brown;color:white">Purpose of Disclosure: </h3>
            <input type=checkbox name='checkbox2' value="" <?php
     if ($check_res['checkbox2'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp; My health information is being disclosed at my request or at the request of my personal representative; or
    <br>
    <input type=checkbox name='checkbox4' value="" <?php
     if ($check_res['checkbox4'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp;My health information is being disclosed for the following purpose<br>
                <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<h3 style="font-size: 14px;"> Explain Purpose: <?php echo text($check_res['information2']); ?></h3>
</td>

</tr>
</table>
                <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Signature of member : <br><?php echo text($check_res['Msign']); ?></label>
</td>
<td style="width:50%;">
<label style="font-size: 14px;">Date:<?php echo text($check_res['date1']); ?></label>
</td>

</tr>
</table><br>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Witness Signature <br>(For Illinois Residents Only): <br><?php echo text($check_res['Wsign']); ?></label>
</td>
<td style="width:50%;">
<label style="font-size: 14px;">Date:<?php echo text($check_res['date2']); ?></label>
</td>

</tr>
</table><br>

                          <p style="font-size:20px;font-weight: bold;background-color:brown;color:white">
Please note: If you are a guardian or court appointed representative, you must attach a
copy of your legal authorization to represent the member and complete the following</p>
            </div>

            <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:40%;"> 
<label style="font-size: 14px;">FullName : <br><?php echo text($check_res['Gname']); ?></label>
</td>
<td style="width:60%;">
<label style="font-size: 14px;">Phone Number:<?php echo text($check_res['Gnumber']); ?></label>
</td>

</tr>
</table><br>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:25%;"> 
<label style="font-size: 14px;">Street address : <br><?php echo text($check_res['Gaddress']); ?></label>
</td>
<td style="width:20%;">
<label style="font-size: 14px;">city:<?php echo text($check_res['Gcity']); ?></label>
</td>
<td style="width:15%;">
<label style="font-size: 14px;">state:<?php echo text($check_res['Gstate']); ?></label>
</td>
<td style="width:15%;">
<label style="font-size: 14px;">zipcode:<?php echo text($check_res['Gzipcode']); ?></label>
</td>

</tr>
</table><br>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;"> Signature of Guardian or Representative : <?php echo text($check_res['Gsign']); ?></label>
</td>
<td style="width:50%;">
<label style="font-size: 14px;">Date:<?php echo text($check_res['Gdate']); ?></label>
</td>

</tr>
</table><br>
            
                            
                            <p style="font-size:15px;">
                                <i>(For California and Georgia residents only) </i>I understand that I may see and copy the information
                                described on this form if I ask for it, and that I may receive a copy of this form after I sign i</p>
            </div>
                <h3 style="text-align: center;">
                    PLEASE MAINTAIN A COPY OF THIS FORM FOR YOUR RECORDS<br>
                    AND RETURN THE ORIGINAL TO:</h3><br>
                    <p style="text-align:center">
                        UnitedHealthcare<br>
                        Customer Service Privacy Unit<br>
                        P.O. Box 740815<br>
                        Atlanta, GA 30374-08</p><br>
                        <p>
                            1 Oxford HMO products are underwritten by Oxford Health Plans (NY), Inc., Oxford Health Plans (NJ), Inc. and
                            Oxford Health Plans (CT), Inc. Oxford insurance products are underwritten by Oxford Health Insurance, In</p>
            </div>
            






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

$mpdf->Output('test.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();

?>