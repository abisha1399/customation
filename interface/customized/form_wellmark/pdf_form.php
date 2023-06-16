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

    $sql = "SELECT * FROM `form_wellmark` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'oxford_form.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>


<style>
        
</style>
<body id='body' class='body'>
<?php
// $header ="<div class='row'style='line-height:1px;' >
// </div>";
ob_start();
?>

<img src="uploads/Wellmark Member Consent (BLANK)-1.jpg" width=100%/>
<h3 style="text-align:center;">PERSONAL REPRESENTATIVE APPOINTMENT AND <br>AUTHORIZATION TO RELEASE PROTECTED HEALTH INFORMATION
    </h3><br>
    <hr/>
    <p style="text-align: center;">This form is used to authorize Wellmark to disclose protected health information at the request of the individual.
    </p>
    <hr/><br>
    <h3 style="text-decoration: underline;">INDIVIDUAL AUTHORIZING DISCLOSURE</h3><br>
    <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Name: <span style="color:brown" ><?php echo text($check_res['name']); ?></span></label>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Address:<span style="color:brown" > <?php echo text($check_res['address']); ?></span></label>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">City,State & Zipcode:<span style="color:brown" > <?php echo text($check_res['city']); ?></span></label>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Telephone:<span style="color:brown" > <?php echo text($check_res['telephone']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Email:<span style="color:brown" > <?php echo text($check_res['email']); ?></span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Identification number:<span style="color:brown" > <?php echo text($check_res['inumber']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Social security number:<span style="color:brown" > <?php echo text($check_res['snumber']); ?></span></label>
</td>

</tr>
</table><br>
<h3 style="text-decoration: underline;">PERSONAL REPRESENTATIVE APPOINTMENT</h3>
    <p>I appoint the individual named below to act on my behalf as my Authorized Personal Representative with Wellmark Blue Cross and Blue Shield or Wellmark Health Plan of Iowa, Inc. in connection with:
    </p><br>
    <input type=checkbox name='checkbox1' value="" <?php
     if ($check_res['checkbox1'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp; All my claims or inquiries for health care benefits on and after the effective date of this appointment.<br>
    <input type=checkbox name='checkbox2' value="" <?php
     if ($check_res['checkbox2'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp; My inquiries and claims for health care benefits with the dates of service: [specify dates]
    </table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">dates:<span style="color:brown" > <?php echo text($check_res['cinput1']); ?></span></label>
</td>


</tr>
</table><br>
<input type=checkbox name='checkbox3' value="" <?php
     if ($check_res['checkbox3'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp;All inquiries and claims for health care benefits for the following minor dependent(s): [specify names]
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">names:<span style="color:brown" > <?php echo text($check_res['cinput2']); ?></span></label>
</td>


</tr>
</table><br>
<input type=checkbox name='checkbox4' value="" <?php
     if ($check_res['checkbox4'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp;My appeal of denied claim(s) with the date(s) of service:  [specify dates] 
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">date:<span style="color:brown" > <?php echo text($check_res['cinput3']); ?></span></label>
</td>


</tr>
</table><br>
<br> <h3 style="text-decoration: underline;">PERSONAL REPRESENTATIVE        </h3>

<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Name: <span style="color:brown" ><?php echo text($check_res['pname']); ?></span></label>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Address:<span style="color:brown" > <?php echo text($check_res['paddress']); ?></span></label>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">City,State & Zipcode:<span style="color:brown" > <?php echo text($check_res['pcity']); ?></span></label>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Telephone:<span style="color:brown" > <?php echo text($check_res['ptelephone']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Email:<span style="color:brown" > <?php echo text($check_res['pemail']); ?></span></label>
</td>

</tr>
</table>
<h3 style="display: inline-block;text-decoration: underline;">Effective:</h3><span>This appointment of Authorized Personal Representative and authorization to disclose is effective upon Wellmark’s receipt of a fully completed and signed original or exact copy of this form at the address stated below.</span><p></p>
       <h3 style="display: inline-block;text-decoration: underline;">Expiration:</h3><span>
        This appointment and authorization will expire 30 days after termination of my health plan coverage, or upon settlement of claims incurred while covered, unless revoked or an earlier date or event is entered below.</span><p></p>

        </table><br>
<input type=checkbox name='checkbox5' value="" <?php
     if ($check_res['checkbox5'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp;on <label style="font-size: 14px;">date:<span style="color:brown" > <?php echo text($check_res['cinput4']); ?></span></label>
    <br><input type=checkbox name='checkbox6' value="" <?php
     if ($check_res['checkbox6'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp;On occurrence of the following event (which must relate to the individual or to the purpose of the use and/or disclosure being authorized): <label style="font-size: 14px;"><span style="color:brown" > <?php echo text($check_res['cinput5']); ?></span></label>

    <h3 style="text-decoration:underline">Right to Revoke</h3>
    <?php
                        if(isset($check_res['text1'])){
                             echo $check_res['text1']; 
                        } else{
                            ?>
    <p> I understand that I may revoke this appointment and authorization at any time by giving written notice of my revocation to Wellmark at the address stated below. I understand that revocation of this appointment and authorization will not affect any action you took in reliance on this appointment and authorization before you received my written notice of revocation
</p> 
 <?php
            }
             ?>
<h3>AUTHORIZATION TO DISCLOSE PROTECTED HEALTH INFORMATION
</h3>

<h4 style="text-decoration:underline">Protected Health Information to be Disclosed: </h4>
<?php
                        if(isset($check_res['text2'])){
                             echo $check_res['text2']; 
                        } else{
                            ?>
<p>I authorize Wellmark Blue Cross and Blue Shield or Wellmark Health Plan of Iowa, Inc. to disclose the protected health information described in this form to the named Authorized Personal Representative.
This authorization shall include and apply to any and all protected health information related to treatments where the individual has requested a restriction and/or for any health care item or service for which the health care provider has been paid out of pocket in full.
</p>
<?php
            }
             ?>
<h4 style="text-decoration:underline">Effect of Granting this Authorization: </h4>
<?php
if(isset($check_res['text3'])){
                             echo $check_res['text3']; 
                        } else{
                            ?>
<p>I understand that if the person or entity that receives the information requested is not covered by federal or state privacy laws, the information described above may be redisclosed and will no longer be protected by law.
</p>
<?php
   }
?>
<h4 style="text-decoration:underline">Prohibition on Redisclosure</h4>
<?php
if(isset($check_res['text4'])){
                             echo $check_res['text4']; 
                        } else{
                            ?>
<p>This form does not authorize the disclosure of medical information beyond the limits of the authorization. Where information has been disclosed from the records protected by Federal law for alcohol/drug abuse records or state law for mental health records, the Federal requirements (42 CFR Part 2) and state requirements (Iowa Code Chapter 228) prohibit further disclosure without the specific written consent of the patient, or as otherwise permitted by such law and/or regulations. A general authorization for the release of medical or other information is NOT sufficient for this purpose. The Federal rules restrict any use of the information to criminally investigate or prosecute any alcohol or drug abuse patient</p>
<?php
   }
?>
<h4 style="text-decoration:underline">No Conditions</h4>
<?php
if(isset($check_res['text5'])){
                             echo $check_res['text5']; 
                        } else{
                            ?>
<p>This authorization is voluntary. Wellmark will not condition your enrollment in a health plan, eligibility for benefits or payment of claims on giving this authorization</p>
<?php
   }
?>
<h4 style="text-decoration:underline">Specific Authorization for Mental Health, Substance Abuse Treatment or Aids-Related Information</h4>
<?php
if(isset($check_res['text6'])){
                             echo $check_res['text6']; 
                        } else{
                            ?>
<p>I authorize the release and disclosure of any and all protected health information, as described in this form, including specifically mental health information, substance abuse (drug or alcohol), and AIDS-related information, if applicable, to the individual named as long as this appointment of Authorized Representative is in effect. I understand that I may inspect the mental health information disclosed.
</p>
<p>I have had full opportunity to read and consider the contents of this personal representative appointment and authorization, and I understand that, by signing this form, I am confirming my authorization of the disclosure of my protected health information, as described in this form. If this authorization involves the disclosure of mental health information, I acknowledge receipt of a copy of the authorization.
</p><br>
<?php
   }
?>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">signature:<span style="color:brown" > <?php echo text($check_res['signature1']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">date:<span style="color:brown" > <?php echo text($check_res['ldate']); ?></span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;"> Individual’s Signature (or Legal Guardian's signature)<span style="color:brown" ></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">(Signature date required)<span style="color:brown" > </span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">signature:<span style="color:brown" > <?php echo text($check_res['signature2']); ?></span></label>


</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;"> Print Name of Legal Guardian if applicable*<span style="color:brown" ></span></label>
</td>
</tr>
</table><br>
<p>*If a legal guardian signs for an individual, a copy of the guardian appointment document must be submitted with this form.
</p><br>

    <h3 style="text-align: center;text-decoration: underline;">RETAIN A COPY FOR YOUR RECORDS – Send completed and signed form to:
    </h3><br>
    <p>Wellmark Privacy Office<br> Mail Station 5W590<br>
        PO Box 9232<br>
        Des Moines IA 50306-9232 <br>Or fax to (515) 376-9032
        </p>
        <p>If you have questions about how to complete this form, please call (877) 610-6395.
        </p>







<?php
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("form_wellmark");
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