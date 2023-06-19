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

    $sql = "SELECT * FROM form_providence_healthplan WHERE id = $formid AND pid = $pid";
   
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

</div>";

ob_start();
 
        ?>
                <div class="row" >
                    <div class="col-12" style="border:1px solid black;">
                        <h3>Providence Health Plans 
                         Policy and Procedure</h3>
                    </div>  
                </div>
                <table style="width:100%;border: 1px solid black;border-collapse: collapse;"> 
                        <tr>
                        <td style="width:50%;border: 1px solid black;border-collapse: collapse;">
                        <h5>SUBJECT:</h5>
                        <p><b>Appointment of Authorized Member Representatives</b></p>
                        </td>  
                        <td style="width:50%;">
                        <h5>NUMBER:</h5>
                        <p>AP<?php echo xlt($data['appoin']); ?></p>
                         </td>  
                        </tr>
                        </table>
                        <div class="col-12 mt-2">
                        <p><b>1.Attachment 1: Form for Appointment of Authorized Representative and Provider Release of 
                            Balance Billing Rights</b></p>
                        </div> 
                       
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%;">
                        <label><b>Member Name:</b> <?php echo xlt($data['name']); ?></label>
                        </td>  
                        <td style="width:50%;">
                         </td> 
                         
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%;">
                        <label><b>Member Number:</b> <?php echo xlt($data['member']); ?></label>
                        </td>  
                        <td style="width:50%;">
                         </td> 
                         
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>Group Number:</b> <?php echo xlt($data['groups']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        </td>
                        </tr>
                        </table>
                        <div class="container col-12 mt-2">
                        <p style="font-size:17px;text-align:center;"><b>MEMBER DESIGNATION OF AUTHORIZED REPRESENTATIVE</b></p>
                        </div> 
                    <div class="container col-12 mt-2">
                        <p style="text-align:justify;">I, <?php echo xlt($data['first']); ?> , hereby grant, <?php echo xlt($data['second']);?> 
                        authority to act on my behalf as my authorized representative in pursing and
                        appealing benefit determinations under my plan related to the following claim number(s): <?php echo xlt($data['third']); ?>.</p>
                        <?php
                        if(isset($data['text1'])){
                             echo strip_tags($data['text1']); 
                        } else{
                            ?>
                          
                        <p style="text-align:justify;"> All communication regarding any such appeals should be sent to my authorized representative
                        in lieu of me.</p>
                        <p style="text-align:justify;">My designee is an individual  and not a business entity. If  my designee
                        is a medical provider or a person affiliated with a medical provider, I understand that am under no legal obligation to grant 
                        authority to the provider to act as my authorized representative. That authority has value to the provider, especially to
                        to the extent I have already assigned benefits under my plan to the provider. Therefore, my grant to the provider of authority to pursue benefits on my behalf is conditioned
                        on full release of any claim the provider, or his or her employer, business partners, or any business affiliate of the provider
                        has against me personally for services at issue in the appeal(s) as set out in the form required by Providence Helath Plan.
                        The release is intended to extinguish the conflict of interest the provider would otherwise have in holding me accountable for non-covered 
                        charges while also asserting my rights against the plan. </p>
                        <?php
                        }
                        ?>
                    </div>
                    <table style="width:100%;"> 
                        <tr>
                        <td style="width:60%;"> 
                        <label><b>Member's Signature:</b> <?php echo xlt($data['sign']); ?></label>
                        </td>
                        <td style="width:40%;">
                        <label><b>Date:</b> <?php echo xlt($data['dat']); ?></label>
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
                    <br/>
                    <div class="col-12" style="border:1px solid black;">
                        <h3>Providence Health Plans
                        Policy and Procedure</h3>
                    </div>  
                    <table style="width:100%;border: 1px solid black;border-collapse: collapse;"> 
                        <tr>
                        <td style="width:50%;border: 1px solid black;border-collapse: collapse;">
                        <h5>SUBJECT:</h5>
                        <p><b>Appoinment of Authorized Member Representatives</b></p>
                        </td>  
                        <td style="width:50%;">
                        <h5>NUMBER:</h5>
                        <p>AP<?php echo xlt($data['appoin']); ?></p>
                         </td>  
                        </tr>
                        </table>
                        <div class="col-12 mt-2">
                        <p><b>2.Attachment 2: Mandatory Provider Release of Balance Billing Rights</b></p>
                        </div> 
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%;">
                        <label><b>Member Name:</b> <?php echo xlt($data['name1']); ?></label>
                        </td>  
                        <td style="width:50%;">
                         </td> 
                         
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%;">
                        <label><b>Member Number:</b> <?php echo xlt($data['member1']); ?></label>
                        </td>  
                        <td style="width:50%;">
                         </td> 
                         
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>Group Number:</b> <?php echo xlt($data['group1']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        </td>
                        </tr>
                        </table>
                    <div class="container col-12 mt-2">
                        <p style="text-align:center;"><b>REQUIREMENTS FOR DESIGNATION OF A PROVIDER AS AUTHORIZED REPRESENTATIVE</b></p>
                    </div> 
                    <div class="container col-12 mt-2">
                    <?php
                        if(isset($data['text1'])){
                             echo strip_tags($data['text1']); 
                        } else{
                            ?>
                          
                        <p style="text-align:justify;">Providence members have the right to designate an authorized
                        representative to act on their behalf in pursing a benefit claim or appeal of an adverse benefit determination. 
                        An authorized representative must be individual, as opposed to a business entity. If the individual the member
                        designates is a medical provider or someone affiliated with a medical provider, there is an additional requirement that
                        the provider waive whatever rights it may have against the member unless the claims relates to urgent care.</p>
                        <p style="text-align:justify;">The reason for this requirement is to avoid conflicts of interest. In some instances 
                        provider acquire rights of payment against their patients even when the patient has health coverage. For example,
                        regardless of whether a provider paticipates in Providence's provider network, if Providence denies coverage of a service rendered to the member
                        the provider may have rights against the member for costs of non-covered medical services. Furthermore, when a provider is
                        not under contract with Providence and is therefore "out-of-network", the provider may have the right to charge
                        the member for the amount they bill Providence less the amount paid by providence less the amount paid by Providence 
                        under the out-of-network terms of the member's plan. The practice of charging a member for that amount is known as "balance billing".</p>
                        <p style="text-align:justify;">For example, if a member receives medical services from an
                        out-of-network provider and the provider bills Providence $1000 for those services, the members plan will not cover
                        that entire amount. First, the billed amount is reduced to an amount consistent with "Usual and Customary Rates".
                        Providence determines the usual and customary rate for a particular service by referencing a database maintained by a 
                        national independent, not-for-profit corporation called FAIR Health. (See<a href="http://www.fairhealthconsumer.org/"> http://www.fairhealthconsumer.org/</a>). If the UCR
                        rate in the FAIR Health database is lower than the billed amount ,such as $500 instead of the $1000 billed amount,
                        the amount Providence will pay on the claim is determined by the UCR Rate.</p>
                        <p style="text-align:justify;">Once the UCR rate is determined, Providence pays the percentage
                        of out-of-network benefits called for in the plan.For example, if the UCR rate is $500, and the plan pays 60
                        percent for out-of-network care, Providence will pay the provider $300. However, if the provider initially billed $1000 
                        for the services and the provider is not under contract with Providence, the provider may be able to bill the member the remaining
                        $700 under applicable law.</p>
                        <p style="text-align:justify;">If a provider were to act as a member's authorized representative
                        while simultaneously holding rights to bill the member for the post-appeal balance, that provider would be in a conflicted 
                        in position. Therefore, providence does not permit a member to designate a provider as an authorized
                        representative unless the provider waives its rights against the member by signing the attached form. The only 
                        exception to that requirement is for claims involving urgent care, meaning a pre-service claim for medical care or treatement with 
                        respect to which normal timeline for pre-service.</p> <?php
                        }
                        ?>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="col-12" style="border:1px solid black;">
                        <h3>Providence Health Plans 
                         Policy and Procedure</h3>
                    </div>  
                    <table style="width:100%;border: 1px solid black;border-collapse: collapse;"> 
                        <tr>
                        <td style="width:50%;border: 1px solid black;border-collapse: collapse;">
                        <h5>SUBJECT:</h5>
                        <p><b>Appoinment of Authorized Member Representatives</b></p>
                        </td>  
                        <td style="width:50%;">
                        <h5>NUMBER:</h5>
                        <p>AP<?php echo xlt($data['appoin']);?></p>
                         </td>  
                        </tr>
                        </table> 
                        <div class="container col-12 mt-3">
                            <p style="text-align:justify;">claims could seriously jeopardize the life or health
                            of the member or the ability of the member to regain maximum function, or would subject the member to severe 
                            pain that cannot be adequately managed without the care or treatement that is the subject of the claim. The provider
                            is not permitted to remain as the member's authorized representative for any post-service grievance processes 
                            absent a balance billing waiver.</p>
                            <p style="text-align:justify;">If your provider is not willing to waive its rights 
                            against you by signing the attached form for your claim for non-urgent care, you are free to appoint any other 
                            individual to act as your authorized representative who would not be operating under a conflict of interest.</p>
                        </div>
                        <div class="container col-12 mt-2">
                            <p style="text-align:center;"><b>RELEASE OF BALANCE BILLING RIGHTS</b></p>
                        </div> 
                        <div class="container col-12 mt-2">
                            <p style="text-align:center;">(release to be completed by the provider,not a person affiliated with the provider)</p>
                        </div> 
                        <div class="container col-12 mt-2">
                            <p style="text-align:justify;">I, <?php echo xlt($data['fourth']);?>
                            , hereby waive and release any and all rights that I, my employer, my  business partners
                            ,any business in which I have an interest,or any business with which I am otherwise affiliated may have to collect 
                            payment from the  above-named member, <?php echo xlt($data['fifth']);?>, with respect to any services at issue in any appeal that
                            has been filed or is hereafter filled in which I or a person affiliated with me acts as the member's authorized 
                            representative, regardless of the outcome of the appeal. I have authority to bind the third-parties described
                            in the previous sentence to this release.</p>
                        </div>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>Provider Signature:</b> <?php echo xlt($data['provider']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        <label><b>Printed Name:</b> <?php echo xlt($data['print']); ?></label>
                        </td>
                        </tr>
                        </table>
                        <table style="width:100%;"> 
                        <tr>
                        <td style="width:50%; ">
                        <label><b>Date:</b> <?php echo xlt($data['dat']); ?></label>
                        </td>   
                        <td style="width:50%;">
                        </td>
                        </tr>
                        </table>
                         
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
<td style='font-size:12px align:center'>Appoinment of Authorized Member Representatives: AP".$data['appoin'].".</td>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

//$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Providence Health Plan Policy And Procedure");
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

$mpdf->Output('Providence Health Plan Policy And Procedure.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>