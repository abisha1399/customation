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
$pid = $_GET["pid"];
$encounter = $_GET["encounter"];
$data =array();

    $sql = "SELECT * FROM consentform WHERE id = ? AND pid = ?";

    $res = sqlStatement($sql, array($formid,$pid));
    $data = sqlFetchArray($res);



    $check_res = $formid ? $check_res : array();

    $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<style>
</style>
<body id='body' class='body'>
<?php
$header ="<div class='row'style='line-height:1px;' >

</div>";

ob_start();

        ?>

<div class="row" style="border:1px solid black;">
<div class="col" style="background-color:grey">
<h2 style="text-align: center;"><b><u><?php echo xlt('IME CONSENT FORM'); ?></u></b></h2>
<p style="font-size: 18px;text-align: center;"><?php echo xlt('CONSENT FOR THE RELEASE OF');?></P>
<p style="font-size: 18px;text-align: center;"><?php echo xlt('CONFIDENTIAL SUBSTANCE USE TREATEMENT INFORMATION');?></P>
</div>



<!-- <h5 style='text-align:center;line-height:1px;'>A New View, Inc. </h5>
<h5 style='text-align:center;line-height:1px;'>2905 Harr Drive, Suite 102</h5>
<h5 style='text-align:center;line-height:1px;'>Midwest City, OK 73110-3049</h5>
<h5 style='text-align:center;line-height:1px;'>Office: 405-818-8364 Fax:</h5>     -->
<br />
<table style="margin-top: 8px;width:100%;">
<tr>
<td style="width:60%;">
<label style="font-size: 14px;">Client Name : <?php echo xlt($data['name']); ?></label>
</td>
<td style="width:40%;">
<label style="font-size: 14px;">Date Of Birth: <?php echo xlt($data['date']); ?></label>
</td>
</tr>
</table>

    <br />

            <table>

            <tr>
            <td  style="width:100%; border:1px solid black;background-color:grey">
            <h3>   <?php echo xlt('AUTHORIZATION & ACKNOWLEDGEMENT '); ?></h3 >
            </td>
            </tr>

            <tr>
      <td  style="font-size:14px;line-height: 1.4;text-align: justify;">
             <p> I, <?php echo xlt($data['first']); ?>, authorize <?php echo xlt($data['second']); ?>  (Provider Agency),Rutgers University Behavioural Health Care(UBHC) in the capacity of the Interim Management Entity(IME) and
                        the New Jersey Department of Human Services/Division of Mental Health and Addiction Services (NJ
                        DRS/DMHAS) to communicate with and disclose to one another information about my substance use treatment.

</p >
            </td>
            </tr>
            <tr>
      <td  style="font-size:14px;line-height: 1.4;text-align: justify;">
             <p>The purpose of the authorized disclosure is to enable <?php echo xlt($data['third']); ?> Provider Agency), UBHC in the capacity of the IME end the NJ DHS/DMHAS to provide me with better,
                        more coordinated treatment and allow for the evaluation and authorization of my treatment.
                        I understand that the information available to these entities will be exchanged verbally and
                        electronically through the New Jersey Substance Abuse Monitoring System (NJSAMS),
                        a secure computer system, and that my information will be maintained in the NJSAMS.
</p >
            </td>
            </tr>
            <tr>
      <td style="font-size:14px;line-height: 1.4;text-align: justify;">
             <p>   <?php $data['text1']??"I understand that my medical records are protected under federal and state law, including the
                        federal regulations governing Confidentiality of Alcohol and Drug Abuse Patient Records, 42 C.F.R.
                        Part 2, and the Health Insurance Portability and Accountability Act of 1996  (HIPAA),  45 C.F.R. Parts  160 & 164,
                        and  cannot  be disclosed  without  my written consent unless otherwise provided for in the regulations.</p >
            </td>
            </tr>
             <tr>
      <td style='font-size:14px;line-height: 1.4;text-align: justify;'>
       <p> I understand that I may be denied services if I refuse to consent to a disclosure for the purpose of treatment, payment
                        or health care operations. I will not be denied services if I refuse to consent to a disclosure for other purposes.</p >
            </td>
            </tr>
            <tr>
      <td style='font-size:14px;' >
             <p> I have been provided a copy of this form.</p >" ?>
            </td>
            </tr>

</table>

<table style="margin-top: 8px;width:100%;">
<tr>
<td style="border:1px solid black;background-color:grey">
<h3>DESCRIPTION OF INFORMATION TO BE DISCLOSED/RELEASED</h3>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;">
<tr>
<td style="width:100%;font-size:14px;line-height: 1.4;text-align: justify;">
<p>   <?php echo $data['text2']??'All my health information, including my dntg and/or alcohol treatment record and records about other conditions,
                        including medical and mental health conditions, for whioh I might have received treatment.'; ?></p>
</td>
</tr>
</table>

<table style="width:100%;">
<tr>
<td style="border:1px solid black;background-color:grey">
<h3>TERM/EXPIRATION/REVOCATION</h3>
</td>
</tr>
</table>
<table style="width:100%;">
<tr>
<td style="width:100%;font-size:14px;line-height: 1.4;text-align: justify;">
<p style="font-size:14px;">   <?php echo $data['text3']??'This signed Consent will expire one year from today and will remain in effect until that date. I also understand that I may revoke this consent at any time,
                            except to the extent that action has been taken in reliance on it.'; ?></p>
</td>
</tr>
</table>

<table style="margin-top: 8px;width:100%;">
<tr>
<td style="width:100%;border:1px solid black;background-color:grey">
<h3>SIGNATURE</h3>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;">
<tr>
<td style="width:60%;">
<label style="font-size: 14px;">Client Signature :
<?php

 if($data['client']!=''){
     echo '<img src='.$data['client'].' style="width:20%;height:40px;" >';
 }
 ?>

</td>
<td style="width:40%;">
<label style="font-size: 14px;">Date : <?php echo xlt($data['dat']); ?></label>
</td>
</tr>
</table>
<div style="border:1px solid black;">
    <table style="margin-top: 8px;width:100%;">
    <tr>
    <td style="width:70%;">
    <label style="font-size: 14px;">Signature of Responsible Party if other than client : <?php echo xlt($data['signature']); ?></label>
    </td>
    <td style="width:30%;">
    <label style="font-size: 14px;">Date : <?php echo xlt($data['datas']); ?></label>
    </td>
    </tr>
    </table>
    <table style="margin-top: 8px;width:100%;">
    <tr>
    <td>
    <label style="font-size: 14px;">Describe authority to sign on behalf of Client : <?php echo xlt($data['auth']); ?></label>
    </td>
    </tr>
    </table>
</div>
<table style="margin-top: 8px;width:100%;">
<tr>
<td style="width:60%;">
<label style="font-size: 14px;">Witness Signature :
<?php

 if($data['witness']!=''){
     echo '<img src='.$data['witness'].' style="width:20%;height:40px;" >';
 }
 ?>
</label>
</td>
<td style="width:40%;">
<label style="font-size: 14px;">Date : <?php echo xlt($data['dates']); ?></label>
</td>
</tr>
</table>
</div>
<br />
<br />
<br />
<br />

<table style="margin-top: 8px;width:100%;">
<tr>
<td style="width:50%;line-height:1.4;font-size:18px;text-align: justify;">
<h2 style="border:1px solid black;background-color:grey">Why do I need to sign the IME Consent Form?</h2>
<br/>
<p>By signing the IME Consent Form, you are allowing your identified substance use disorder treatment provider,
the NJ Department of Human Services/Division of Mental Health and Addiction Services (NJ DHS/DMHAS) and the
Interim Management Entity (IME) to communicate about your health information
and records  in order to provide you with better,
more coordinated substance use treatment.As part of	this communication,	your health information	will be	disclosed through a computer system, the New Jersey Substance
Abuse Monitoring System (NJSAMS).
</p>
<br />
<p>Here is some additional information about the IME Consent Form:</p>
<p>• You can withdraw your consent at any time.
You may be asked to sign a form indicating that you have withdrawn your consent. </p>
<p>• A refusal to content or a withdrawal of consent may affect your ability,
or continued ability, to receive
services if it affects disclosures related to treatment, payment or other health care operations.</p>
<p>• Any health information about you may
not be re-disclosed to others except as allowed by state and Federal laws and regulations</p>
<p>• You are entitled to a copy of the IME Consent
Form after you sign it
</p>
<p>• Your current substance use treatment provider identified
 in the IME Consent Form must obtain a separate consent in order to communicate with and
 disclose information about you to any other
 substance use treatment providers and/or health care professionals for whom you are
  a current, former or future client.</p>
  <br/>
  <h2 style="border:1px solid black;background-color:grey">What is NJSAMS?</h2>
  <br/>
  <p>NJSAMS	is a secure	web-based computer system that collects	and	maintains
demographic, clinical, service and financial
</p>
</td>
<td style="width:50%;line-height:1.4;font-size:18px;text-align: justify;">
<p>information about clients who receive substance use disorder
     treatment in New Jersey. Examples of the  information  collected and maintained
     in NJSAMS include admission and discharge dates, income, household size and clinical assessments.
     All New Jersey substance use disorder treatment programs and
facilities are required to record and report client data to the NJSAMS.</p>
<br />
<p>By recording your information in NJSAMS, your substance use disorder treatment provider,
    the IME and NJ DHS/DMHAS can better coordinate your treatment, including obtaining any
    necessary authorizations for assessments and other services. In addition, de-identified
     data is used to assist the NJ DHS/DMHAS in program development and budget planning,
     and for required data reporting to the federal government.</p>
     <br/>
     <h2 style="border:1px solid black;padding-top:20px;background-color:grey">What is the IME?</h2>
     <br/>
     <p>The NJ DHS/DMHAS has contracted with Rutgers University Behavioral Health Care to serve
         as the IME for addiction services. The IME is a central point of access for individuals
          seeking treatment for substance use disorders and maintains a 24/7 call center. The IME
          is designed to provide services including, but not limited to, screening,  referral, care coordination
          and utilization management (e.g. authorizations for assessments, treatment placements and continuing care).</p>
       <br/>
          <p>The IME also assists NJ DHS/DMHAS and NJ FamilyCare/Medicaid with verifying an individual’s
            financial eligibility and provider network management activities. These activities allow the
            IME to refer callers to providers that are most likely to
            meet their service need and have the ability to use funding or insurunce for which the caller qualifies.</p>
       <br />
       <p>For more information about the IME, please visit:</p>
       <a href="http://www.state.nj.us/humanservices/dmhas/initiatives/managed">http://www.state.nj.us/humanservices/dmhas/initiatives/managed</a>


        </td>
</tr>
</table>

<table style="margin-top: 8px;width:100%;  border: 1px solid black;">



            <?php
        ?>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

//$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("IME Consent Form");
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($body);
$mpdf->defaultfooterline = 0;
//         //save the file put which location you need folder/filname
$checkid = sqlQuery("SELECT formid FROM pdf_directory WHERE formid=?", array($formid));
if($checkid['formid'] != $formid){
    $pdf_data = sqlInsert('INSERT INTO pdf_directory (path,pid,encounter,formid) VALUES (?,?,?,?)',array($filename,$_SESSION["pid"],$_SESSION["encounter"],$formid));
}

$mpdf->Output($filename, 'I');
header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>

