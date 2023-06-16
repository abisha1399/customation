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

    $sql = "SELECT * FROM form_authorized_representative WHERE id = $formid AND pid = $pid";
   
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);
   
  //  echo $sql;
   
    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>
<style>
</style>
<body id='body' class='body'>
<?php
$header ="<div class='row'style='line-height:1px;' >

</div>";

ob_start();
 
        ?>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:20%;"> 
<p style="font-size:25px;"><b>aetna</b></p>
</td>
<td style="width:80%;">
<p style="font-size:20px;"><b>Authorized Representative Request</b></p>
</td>
</tr>
</table>
<table style="margin-top: 8px;width:100%;"> 
<tr>
<td style="width:60%;"> 
 
</td>
<td style="width:40%;border: 1px solid black;border-collapse: collapse;">
<label style="font-size: 14px;"><b>FAX Number:</b> <?php echo xlt($data['fax']); ?></label>
</td>
</tr>
</table>
<!-- <div style="border:1px solid black;"> -->
<table style="margin-top: 8px;width:100%;border: 1px solid black;border-collapse: collapse;"> 
<tr>
<td style="width:60%;border: 1px solid black;
  border-collapse: collapse;"> 
<label style="font-size: 14px;"><b>Member Name:</b> <?php echo xlt($data['name']); ?></label>
</td>
<td style="width:40%;">
<label style="font-size: 14px;"><b>Aetna ID Number:</b> <?php echo xlt($data['num']); ?></label>
</td>
</tr>
</table>

<table style="width:100%;border: 0px solid black;
  border-collapse: collapse;"> 
<tr>
<td style="width:100%;border: 1px solid black;
  border-collapse: collapse;"> 
<label style="font-size: 14px;"><b>Provider of Service:</b> <?php echo xlt($data['prov']); ?></label>
</td>
</tr>
</table>  
 
<table style=" width:100%;border: 1px solid black;
  border-collapse: collapse;"> 
<tr>
<td style="width:100%;border: 1px solid black;
  border-collapse: collapse;"> 
<label style="font-size: 14px;"><b>Name and Dates of Service or Proposed Service:</b> <?php echo xlt($data['prov']); ?></label>
</td>
</tr>
</table> 
<!-- </div> -->
<!-- <h5 style='text-align:center;line-height:1px;'>A New View, Inc. </h5>
<h5 style='text-align:center;line-height:1px;'>2905 Harr Drive, Suite 102</h5>
<h5 style='text-align:center;line-height:1px;'>Midwest City, OK 73110-3049</h5>
<h5 style='text-align:center;line-height:1px;'>Office: 405-818-8364 Fax:</h5>     --> 

    <br />
                <table style="margin-top: 8px;width:100%;"> 
                <tr>
                <td style="width:100%;">
                <p >I, <?php echo xlt($data['first']); ?>, do hereby name Print the name of the member
                                    who is receiving the service or supply 
                                    <?php echo xlt($data['second']); ?>, Print the name of the person who 
                                    is being authorized to act on the member’s behalf</p> 
                
                </td>
                </tr>
                </table> 
                <div class="col-12 row">
                <p >to act as my authorized representative in requesting (check one)
                <input type=checkbox name='check1' value="" <?php if($data["check1"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> a complaint or
                <input type=checkbox name='check2' value="" <?php if ($data["check2"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> an appeal from Aetna regarding the
                    above-noted service or proposed service.
                    </p>
                    </div>
                     
                <p><b>IMPORTANT: Your signature below means that you understand and agree to the following:</b></p>
                    
                    <div class="col-12 row" style="border:1px solid black;padding-right:4px;">
                    <ul>
                        <li>In conjunction with this (check one)
                            <input type=checkbox name='check3' value="" <?php if ($data["check3"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> complaint or
                            <input type=checkbox name='check4' value="" <?php if ($data["check4"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> appeal, Aetna may disclose Protected Health Information (“PHI”)
                                to the above-named authorized representative (“Representative”).
                </li>
                        <li style="text-align:justify;"><b>The PHI disclosed pursuant to this authorization may include diagnosis and treatment information, including
                        information pertaining to chronic diseases, behavioral health conditions, alcohol or substance abuse,
                        communicable diseases, sexually-transmitted diseases, HIV/AIDS, and/or genetic marker information.</b></li>
                        <li style="text-align:justify;">Information disclosed pursuant to this authorization may be redisclosed by the Representative and may no longer be
                        protected by federal or state privacy regulations.</li>
                        <li style="text-align:justify;">If you would like to pursue (check one)
                            <input type=checkbox name='check5' value="" <?php if ($data["check5"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> a complaint or
                            <input type=checkbox name='check6' value="" <?php if ($data["check6"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> an appeal, at the Representative’s request, but do not want
                            the Representative to receive any PHI or other information related to the (check one)
                            <input type=checkbox name='check7' value="" <?php if ($data["check7"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> complaint or
                            <input type=checkbox name='check8' value="" <?php if ($data["check8"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> appeal,
                            including the (check one)
                            <input type=checkbox name='check9' value="" <?php if ($data["check9"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> complaint or
                            <input type=checkbox name='check10' value="" <?php if ($data["check10"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> appeal, decision, you may indicate that choice by checking the box on the
                            signature line below.
                </li>
                        <li style="text-align:justify;">Your ability to enroll in an Aetna plan, and your eligibility for benefits and payment for services, will not be affected if you
                            do not sign this form. However, without your signature, we cannot process the (check one)
                            <input type=checkbox name='check11' value="" <?php if ($data["check11"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> complaint or
                            <input type=checkbox name='check12' value="" <?php if ($data["check12"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> appeal,
                            initiated by the Representative.
                </li>
                        <li style="text-align:justify;">This authorization is only valid for the duration of the (check one)
                            <input type=checkbox name='check13' value="" <?php if ($data["check13"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> complaint or
                            <input type=checkbox name='check14' value="" <?php if ($data["check14"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> appeal. If you sign this form, you
                            may revoke the authorization at any time by notifying Aetna in writing at the address above. Revoking this authorization
                            will not have any effect on actions that Aetna took in reliance on the authorization before we received the notification.
                </li>
                </ul>
                    </div>
                    <div class="col-12 row">
                        <p style="text-align:justify;">
                            <input type=checkbox name='check15' value="" <?php if ($data["check15"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> Please accept this (check one)
                            <input type=checkbox name='check16' value="" <?php if ($data["check16"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> complaint or
                            <input type=checkbox name='check17' value="" <?php if ($data["check17"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> appeal, from my representative on my behalf; however, forward all
                            information related to this (check one)
                            <input type=checkbox name='check18' value="" <?php if ($data["check18"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> complaint or
                            <input type=checkbox name='check19' value="" <?php if ($data["check19"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> appeal,
                            including the (check one)
                            <input type=checkbox name='check20' value="" <?php if ($data["check20"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> complaint or
                            <input type=checkbox name='check21' value="" <?php if ($data["check21"] == "0") {
                echo "checked='checked'";}else{
                    echo '';
                  }?>> appeal
                            decision and any request you may have for additional information, to my attention only.
                        </p>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <!-- <div style="border:1px solid black;"> -->
                    <table style="margin-top: 8px;width:100%;border: 1px solid black;border-collapse: collapse;"> 
                    <tr>
                    <td style="width:60%;border: 1px solid black;border-collapse: collapse;"> 
                    <label style="font-size: 14px;"><b>Signature:</b> <?php echo xlt($data['sign']); ?></label>
                    </td>
                    <td style="width:40%;">
                    <label style="font-size: 14px;"><b>Date:</b> <?php echo xlt($data['date']); ?></label>
                    </td>
                    </tr>
                    </table>
                    
                    <table style=" width:100%;border: 1px solid black;border-collapse: collapse;"> 
                    <tr>
                    <td style="width:100%;"> 
                    <label style="font-size: 14px;"><b>Print Name:</b> <?php echo xlt($data['print']); ?></label>
                    </td>
                    </tr>
                    </table> 
                     
                    <table style=" width:100%;border: 1px solid black;border-collapse: collapse;"> 
                    <tr>
                    <td style="width:100%;"> 
                    <label style="font-size: 14px;"><b>If person signing this Authorization is not the Member, describe relationship to the Member (i.e. Parent, Legal
                                                Representative):</b> <?php echo xlt($data['auth']); ?></label>
                    </td>
                    </tr>
                    </table> 
                <!-- </div> -->
                    <p style="text-align:justify;">Legal Representatives signing this authorization on behalf of a Member must furnish a copy of a health care power of attorney, or other relevant document
                    that grants the applicable legal authority.</p>


 
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
$mpdf->setTitle("Authorized Representative Request");
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

$mpdf->Output('Authorized Representative Request.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>