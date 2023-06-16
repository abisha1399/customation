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

    $sql = "SELECT * FROM `form_cigna` WHERE id = ? AND pid = ?";
   
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
<img src="uploads/download.png" />
<h3>Request for IRO (Independent Review Organization) <br> Review and Release Form </h3>
            <hr>
              <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Patient Name:<span style="color:brown" > <?php echo text($check_res['pname']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">SSN#:<span style="color:brown" > <?php echo text($check_res['ssn']); ?></span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Patient Date of birth:<span style="color:brown" > <?php echo text($check_res['pdob']); ?></span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Subscriber Name(if different):<span style="color:brown" > <?php echo text($check_res['sname']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Relationship to patient:<span style="color:brown" > <?php echo text($check_res['rtp']); ?></span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Subscriber's Employer Name:<span style="color:brown" > <?php echo text($check_res['sename']); ?></span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Coverage determination that I am appealing:<span style="color:brown" > <?php echo text($check_res['cdappeal']); ?></span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">I am attaching additional Information for this appeal:<span style="color:brown" ><input type=checkbox name='checkyes' value="" <?php
     if ($check_res['checkyes'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp; yes
    <input type=checkbox name='checkno' value="" <?php
     if ($check_res['checkyes'] == '1') {
      echo "checked='checked'";
     }else{
      echo '';
    }?>>&nbsp;no
</span></label>
</td>

</tr>
</table>
<hr/>
<h3 style="text-decoration:underline">Please Complete this section If you are authorizing someone else to act on your behalf</h3>


<span>I am authorizing </span><label style="font-size: 14px;"><span style="color:brown" > <?php echo text($check_res['authname']); ?></span></label> (name of individual) to act on my behalf in requesting a review in accordance with cigna's External review Program regarding thr non-coverage determination dated<label style="font-size: 14px;"><span style="color:brown" > <?php echo text($check_res['date']); ?></span></label><span>. This authorization allows Cigna to disclose any individually Identifying information to my reprentative. This includes releasing the results of the IRO decision to the above mentione authorized representative.</span><p></p>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Authorized Representative's Address:<span style="color:brown" > <?php echo text($check_res['apaddress']); ?></span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Relationship to member:<span style="color:brown" > <?php echo text($check_res['relation']); ?></span></label>
</td>

</tr>
</table><hr>
<p >I understand that tha IRO will receive and review the following information from Cigna, its Agents or subsidiaries:</p>
            <ul>
              <li>My medical records and other documents that were review during the internal review process.</li>
              <br>
              <li>Documents from the internal review process, including a statement of the criteria and clinical reasons for the initial coverage decision.</li>
              <br>
              <li>The contract document for my health care benefir plan(the description of my coverage).</li>
              <br>
              <li>Any additional information not presented during the internal review process related to the appeal.</li>
            </ul>
            <br>
            <p> I understand that I may submit additional irformation related to this appeal <b> WITH THIS FORM</b> to be considered in the external review process. I understand that the decision of the lRO's reviewer(s) will be binding on Cigna and on me, except to be extent that there are other remedies available under State or Federal law. I understand that my appeal to an lRO cannot begin until I have submitted all required information. I understand I must provide the Information requested below and if applicable, sign the release of records form which allows Cigna to forward certain Information to the IRO. I understand (that any forms returned to Cigna incomplete will be returned to me for completion and my appeal will not be forwarded to the lRO until I complete the form and provide all requested Information. </p>

            <h3>I have read and understand the above information.</h3>
            <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Signature of patient electing appeal:<span style="color:brown" > <?php echo text($check_res['signpat']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Date<span style="color:brown" > <?php echo text($check_res['date1']); ?></span></label>
</td>

</tr>
</table><br>
<h3>If patient is unable to give consent because of physical condition or age, complete the following:</h3>
<br>

<span>Patient is a minor </span><label style="font-size: 14px;"><span style="color:brown" > <?php echo text($check_res['age']); ?></span></label> Years of age or is unable to give consent, beacuse<label style="font-size: 14px;"><span style="color:brown" > <?php echo text($check_res['bconsent']); ?></span></label>
<br>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Signature of ParentGuardian/POA:<span style="color:brown" > <?php echo text($check_res['signpg']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Date:<span style="color:brown" > <?php echo text($check_res['date3']); ?></span></label>
</td>

</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Relationships:<span style="color:brown" > <?php echo text($check_res['relationship']); ?></span></label>
</tr>
</table><br>
<span>Return Completed Form To:</span>
            <p style="font-weight:bold" >Cigna Behavioral health, Attn: Central Appeals Unit, P.O. Box 188064, Chattanooga, TN 37422, Fax#: 877.815.4827 </p><p></p>
            <p >"Cigna" is a reglstered service mark and the "Tree of Life” logo ls a service mark of Cigna intellectual property, Inc., licensed for use by Cigna Corporation and its operating subsidiaries. All products and services are provided by or through such operating subsidiaries and not by Cigna Corporation. Such operating subsidiaries include Connecticut General Life Insurance Company, Cigna Health and Life Insurance Company, Cigna Health management, Inc. and HMO of service company subsidiary of Cigna Health Corporation. Please refer to your ID card for the subsidary that insures or administers your benefit plan. </p>
            <br>
          <i>Facsimile Transmission Cover Sheet</i><hr>
          <table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:33%;"> 
<label style="font-size: 14px;">Fax To<span style="color:brown" > <?php echo text($check_res['fax']); ?></span></label>
</td>
<td style="width:33%;"> 
<label style="font-size: 14px;">Date:<span style="color:brown" > <?php echo text($check_res['date4']); ?></span></label>
</td>
<td style="width:33%;"> 
<label style="font-size: 14px;">Total number of pages(Including this Sheet):<span style="color:brown" > <?php echo text($check_res['page']); ?></span></label>
</td>


</tr>
</table><hr>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:33%;"> 
<label style="font-size: 14px;"><b> To<b><span style="color:brown" ></label>
</td>
<td style="width:33%;"> 
<label style="font-size: 14px;"><b>From<b><span style="color:brown" ></label>
</td>



</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Name:<span style="color:brown" > <?php echo text($check_res['subname']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Name:<span style="color:brown" > <?php echo text($check_res['subname1']); ?></span></label>
</td>



</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Company:<span style="color:brown" > <?php echo text($check_res['subcomp']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Company:<span style="color:brown" > <?php echo text($check_res['subcomp']); ?></span></label>
</td>



</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Phone:<span style="color:brown" > <?php echo text($check_res['subphone']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Phone:<span style="color:brown" > <?php echo text($check_res['subphone1']); ?></span></label>
</td>



</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:50%;"> 
<label style="font-size: 14px;">Address:<span style="color:brown" > <?php echo text($check_res['subadd']); ?></span></label>
</td>
<td style="width:50%;"> 
<label style="font-size: 14px;">Address:<span style="color:brown" > <?php echo text($check_res['subadd1']); ?></span></label>
</td>



</tr>
</table><hr/>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:100%;"> 
<label style="font-size: 14px;">Additional Notes:<span style="color:brown" > <?php echo text($check_res['addnote']); ?></span></label><hr>
<b>"CONFIDENTIALITY NOTICE: The accompanying document(s) is intended solely for the use of the individual(s) or entity to which it is addressed. If you are not the intended recipient, kindly notify us immediately by placing a telephone call to arrange for its retrieval. Please be on notice that disclosure, distribution, photocopying or use of its contents is strictly prohibited and may violate client confidentiality. Thank you."</b>





</tr>
</table>



















<?php
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("form_cigna");
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