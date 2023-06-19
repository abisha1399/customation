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

    $sql = "SELECT * FROM form_facsimile_coversheet WHERE id = $formid AND pid = $pid";
   
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);
   
  //  echo $sql;
   
    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
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
<table>
<tr>
 
<td style='width:150% font-size:10px align:center'>TO:".$data['toaddr']."</td>
<td style='width:150% font-size:10px align:center'>FROM:".$data['fromaddr']."</td>
<td style='width:150% font-size:10px align:center'>DATE:".$data['date']."</td>

</tr>
</table>
</div>";

ob_start();
 
        ?>
                        <div class="row" >
                            <div class="col-12">
                            <img style="float:right;" src="cigna.png" height="50px" width="200px"/>
                                <h2>Facsimile Transmission Cover Sheet</h2>
                                
                            </div>  
                        </div>
                        <hr/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%;">
                        <label><b>DATE:</b> <?php echo xlt($data['date']); ?></label>
                        </td>  
                        <td style="width:50%;">
                         </td> 
                         
                        </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%;">
                        <label><b>TO:</b> <?php echo xlt($data['toaddr']); ?></label>
                        </td>  
                        <td style="width:50%;">
                         </td> 
                         
                        </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>FAX #:</b> <?php echo xlt($data['fax']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        </td>
                        </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>FROM:</b> <?php echo xlt($data['fromaddr']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        </td>
                        </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>SUBJECT:</b> <?php echo xlt($data['subject']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        </td>
                        </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>TOTAL NUMBER OF PAGES (INCLUDING THIS PAGE):</b> <?php echo xlt($data['page']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        </td>
                        </tr>
                        </table>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div class="col-12">
                                 
                                <img style="float:right;" src="cigna.png" height="50px" width="200px"/>
                            </div> 
                            <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div class="col-12">
                            <img style="float:right;" src="cigna.png" height="50px" width="200px"/>
                               
                            </div> 
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/> 
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/> 
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div class="container col-12 mt-2">
                        <img style="float:right;" src="cigna.png" height="30px" width="200px"/>
                        <h4>Request for IRO(Independent Review Organization)</h4>
                        <h4>Review and Release Form</h4>
                        
                        </div> 
                        <hr/>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>Patient Name:</b> <?php echo xlt($data['name']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        <label><b>SSN #:</b> <?php echo xlt($data['ssn']); ?></label>
                        </td>
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:100%; ">
                        <label><b>Patient Date of Birth:</b> <?php echo xlt($data['dob']); ?></label>
                        </td>   
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>Subscriber Name (if diffrent):</b> <?php echo xlt($data['subscriber']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        <label><b>Relationship to Patient:</b> <?php echo xlt($data['ssn']); ?></label>
                        </td>
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:100%; ">
                        <label><b>Subscriber's Employer Name:</b> <?php echo xlt($data['employee']); ?></label>
                        </td>   
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:100%; ">
                        <label><b>Coverage determination that I am appealing:</b> <?php echo xlt($data['coverage']); ?></label>
                        </td>   
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:100%; ">
                            <label style="font-size: 17px;"><b>I am attaching additional information for this appeal:</b> 
                                <input type=checkbox name='check1' value="" <?php if($data["check1"] == "0") {
                                echo "checked='checked'";}else{
                                    echo '';
                                }?>> Yes
                                            <input type=checkbox name='check2' value="" <?php if($data["check2"] == "1") {
                                echo "checked='checked'";}else{
                                    echo '';
                                }?>> No</label>
                        </td>   
                        </tr>
                        </table> 
                        <hr>
                        <div class="container col-12 mt-2">
                            <p><u><b>Please complete this section if you are authorizing someone else to act on your behalf</b></u></p>
                            </div>   
                            <div class="container col-12">
                            <p style="text-align:justify;">I am authorizing <?php echo xlt($data['auth']); ?> (name of individual)
                            to  act on my behalf in requesting a review in accordance with Cigna's External Review Program regarding 
                            the non-coverage determination dated. <?php echo xlt($data['auth']); ?>. This authorization allows Cigna to disclose any individually identifying information to my representative.
                            This includes releasing the results of the IRO decision to the above mentioned authorized representative.</p>
                        </div>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:100%; ">
                        <label><b>Authorized Representative's Address:</b> <?php echo xlt($data['addr']); ?></label>
                        </td>   
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:100%; ">
                        <label><b>Relationship to Member:</b> <?php echo xlt($data['member']); ?></label>
                        </td>   
                        </tr>
                        </table>
                        <hr>
                        <div class="container col-12 mt-2">
                            <p style="text-align:justify;">I understand that IRO will receive and review the following
                            information from Cigna, its Agents or subsidiaries:</p>
                            <ul>
                                <li>My medical records and other documents that were reviewed during the internal review process.</li>
                                <li>Documents from the internal review process, including a statement of the 
                                criteria and clinical reasons for the initial coverage decision.</li>
                                <li>The contact document for my health care benefit plan (the description of my coverage).</li>
                                <li>Any additional information not presented during the internal review process related to the appeal.</li>
                            </ul>
                        
                            <p style="text-align:justify;">I understand that I may submit additional information related to this appeal
                            <b>WITH THIS FORM</b> to be considered in the external review process. I understand that the decision of the IRO's reviewer(s)
                            will be binding on Cigna and on me, except to the extent that there are other remedies available under State or Federal law.
                            I understand that my appeal to an IRO cannot begin until I have submitted all required information. I understand
                            I must provide the information requested below  and if applicable, sign the release of records form which allows Cigna to 
                            forward certain information to the IRO. I understand that any form retuned to Cigna incomplete will be returned to me for completion 
                            and my appeal will not be forwarded to the IRO untill I complete the form and provide all requested information.</p>
                            <p><b>I have read and understand the above information.</b></p>
                        </div>
                        <table style="width:100%;"> 
                            <tr>
                            <td style="width:50%; ">
                            <label><b>Signature of the patient electing appeal:</b> <?php echo xlt($data['patient']); ?></label>
                            </td>   
                            <td style="width:50%;">
                            <label><b>Date:</b> <?php echo xlt($data['patdate']); ?></label>
                            </td>
                            </tr>
                        </table>
                        <div class="container col-12 mt-2">
                            <p style="text-align:justify;">If patient is unable to give consent because of physical condition or age , complete the following:</p>
                            <p>Patient is a minor <?php echo xlt($data['minor']); ?> Years of age
                            or is unable to give consent, because <?php echo xlt($data['consent']); ?>.</p>
                        </div>
                        <table style="width:100%;"> 
                            <tr>
                            <td style="width:50%; ">
                            <label><b>Signature of the parent/Guardian/POA:</b> <?php echo xlt($data['guardian']); ?></label>
                            </td>   
                            <td style="width:50%;">
                            <label><b>Date:</b> <?php echo xlt($data['guarddate']); ?></label>
                            </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:100%; ">
                        <label><b>Relationship:</b> <?php echo xlt($data['relation1']); ?></label>
                        </td>   
                        </tr>
                        </table>
                        <table style="width:100%">
                            <tr>
                                <td style="width:30%;">
                                <label style=" text-align:justify;">Return Completed From To:</label>
                                </td>
                                <td style="width:50%;">
                                <label><b>Cigna Behavioral Health,
                                Attn:Central Appeals Unit, P.O.Box 46090, Eden Prairie, MN 55354. Fax#:855-816-3497</b></label>
                                </td>
                                <td style="width:20%;">
                                
                                </td>
                            </tr>
                        </table>
                        <div class="container col-12 mt-2">
                            <p style="text-align:justify;">"cigna" is a registered  service mark and the "Tree of Life" logo is a service mark of
                            Cigna Intellectual Property, Inc., licensed for  use by Cigna Corparation and its operating subsidiaries. All products
                            and services are provided by or through such operating subsidiaries and not by Cigna Corparation. Such operating 
                            subsidiaries include connecticut General Life Insurance Company, Cigna Health and Life Insurance Company, 
                            Cigna Health Management, Inc, and HMO or service company subsidiaries of Cigna Health Corparation.
                            Please refer to your ID card for the subsidiary that insures or administers your benefit plan.</p>
                        </div>
                    
<!-- </div> -->
<!-- <h5 style='text-align:center;line-height:1px;'>A New View, Inc. </h5>
<h5 style='text-align:center;line-height:1px;'>2905 Harr Drive, Suite 102</h5>
<h5 style='text-align:center;line-height:1px;'>Midwest City, OK 73110-3049</h5>
<h5 style='text-align:center;line-height:1px;'>Office: 405-818-8364 Fax:</h5>     --> 

    


 
            <?php
        ?>
<?php
$footer ="<table>
<tr>
<td style='width:350% font-size:10px align:center'>REF #: </td>
<td style='width:45% font-size:10px align:right'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

//$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Facsimile Transmission Cover Sheet");
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

$mpdf->Output('Facsimile Transmission Cover Sheet.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>