<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
require_once("$srcdir/api.inc");

//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");


$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$check_res= $formid ? formFetch("form_librium_protocol_c", $formid) : array();
//echo '<pre>';print_r($check_res);exit();
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
$header ="<div class='row' style='line-height:1px;' >

</div>";

ob_start();
 
        ?>
                    <h3>Librium Protocol C</h3>
                        <br/>
                <table style="width:100%;"> 
                    <tr>
                        <th>Patient Name: <?php echo $check_res['pat_name1']??''; ?></th>
                        <th>Allergies:<?php echo $check_res['allergy']??''; ?><br>
                        DOB:<?php echo $check_res['dob1']??''; ?></th>
                    </tr>
                </table> 
                </br>  
                <table style="width:100%;" border="1" cellspacing=0 cellpadding=10>
                        <tr>
                            <th>Medication, Dose Frequency, Route</th>
                            <th>Hour</th>
                            <th>Date/Time</th>	
                            <th>Nurse/Patient Initials</th>
                            <th>Date/Time</th>	
                            <th>Nurse/Patient Initials</th>
                            <th>Date/Time</th>	
                            <th>Nurse/Patient Initials</th>
                        </tr>
                        <tr>
                            <td rowspan="8">Vital Signs 4x daily Ativan 1 mg PO Q 2 hours PRN for Signs and Symptoms of Withdraw; or one of the following, pulse >95, SBP >140, DBP >95. Max 8 doses in 24 hours. Hold for SBP< 90, DBP < 60, Pulse < 60</td>
                            <td>PRN</td>
                            <td><?php echo $check_res['date1']??''; ?></td>
                            <td> <?php echo $check_res['input1']??''; ?></td>
                            <td><?php echo $check_res['date2']??''; ?></td>
                            <td> <?php echo $check_res['input2']??''; ?></td>
                            <td><?php echo $check_res['date3']??''; ?></td>
                            <td> <?php echo $check_res['input3']??''; ?></td>
                        </tr>
                        <tr>
                            <td>PRN</td>
                            <td><?php echo $check_res['date4']??''; ?></td>
                            <td> <?php echo $check_res['input4']??''; ?></td>
                            <td><?php echo $check_res['date5']??''; ?></td>
                            <td> <?php echo $check_res['input5']??''; ?></td>
                            <td><?php echo $check_res['date6']??''; ?></td>
                            <td> <?php echo $check_res['input6']??''; ?></td>
                        </tr> 
                        <tr>
                            <td>PRN</td>
                            <td><?php echo $check_res['date7']??''; ?></td>
                            <td> <?php echo $check_res['input7']??''; ?></td>
                            <td><?php echo $check_res['date8']??''; ?></td>
                            <td> <?php echo $check_res['input8']??''; ?></td>
                            <td><?php echo $check_res['date9']??''; ?></td>
                            <td> <?php echo $check_res['input9']??''; ?></td>
                        </tr>  
                        <tr>
                            <td>PRN</td>
                            <td><?php echo $check_res['date10']??''; ?></td>
                            <td> <?php echo $check_res['input10']??''; ?></td>
                            <td><?php echo $check_res['date11']??''; ?></td>
                            <td> <?php echo $check_res['input11']??''; ?></td>
                            <td><?php echo $check_res['date12']??''; ?></td>
                            <td><?php echo $check_res['input12']??''; ?></td>
                        </tr>  
                        <tr>
                            <td>PRN</td>
                            <td><?php echo $check_res['date13']??''; ?></td>
                            <td><?php echo $check_res['input13']??''; ?></td>
                            <td><?php echo $check_res['date14']??''; ?></td>
                            <td><?php echo $check_res['input14']??''; ?></td>
                            <td><?php echo $check_res['date15']??''; ?></td>
                            <td><?php echo $check_res['input15']??''; ?></td>
                        </tr>  
                        <tr>
                            <td>PRN</td>
                            <td><?php echo $check_res['date16']??''; ?></td>
                            <td><?php echo $check_res['input16']??''; ?></td>
                            <td><?php echo $check_res['date17']??''; ?></td>
                            <td><?php echo $check_res['input17']??''; ?></td>
                            <td><?php echo $check_res['date18']??''; ?></td>
                            <td><?php echo $check_res['input18']??''; ?></td>
                        </tr>  
                        <tr>
                            <td>PRN</td>
                            <td><?php echo $check_res['date19']??''; ?></td>
                            <td><?php echo $check_res['input19']??''; ?></td>
                            <td><?php echo $check_res['date20']??''; ?></td>
                            <td> <?php echo $check_res['input20']??''; ?></td>
                            <td><?php echo $check_res['date21']??''; ?></td>
                            <td> <?php echo $check_res['input21']??''; ?></td>
                        </tr>     
                        </table>

                        <table style="width:100%;">
                        <tr>
                        <td>Order Date: <?php echo $check_res['order_date1']??''; ?></td>
                        <td>Patient Signature:
                        <?php
                        if($check_res['sign1']!='')
                        {
                            echo '<img src="'.$check_res['sign1'].'" style="width:20%;height:60px;">';
                        }
                        ?> 
                        </td>
                        <td> Patient Initials:  <?php echo $check_res['ini1']??''; ?></td>
                        </tr> 
                        <tr>
                            <td>Nurse Transcribing Orders:<?php echo $check_res['order1']??''; ?></td>
                            <td></td>
                            <td></td>

                        </tr> 
                        <tr>
                            <td>Verifying Nurse:   <?php echo $check_res['verify_nurse']??''; ?></td>
                            <td>Nurse Signature: 
                            <?php
                        if($check_res['sign2']!='')
                        {
                            echo '<img src="'.$check_res['sign2'].'" style="width:20%;height:60px;">';
                        }
                        ?> 
                            </td>
                           <td> Nurse Initials:<?php echo $check_res['ini2']??''; ?></td>

                        </tr>   
                        <tr>
                            <td></td>
                            <td>Nurse Signature: 
                            <?php
                        if($check_res['sign3']!='')
                        {
                            echo '<img src="'.$data['sign3'].'" style="width:20%;height:60px;">';
                        }
                        ?> 
                            </td>
                           <td> Nurse Initials:<?php echo $check_res['ini3']??''; ?></td>

                        </tr> 
                        <tr>
                            <td></td>
                            <td>Nurse Signature: 
                            <?php
                        if($check_res['sign4']!='')
                        {
                            echo '<img src="'.$data['sign4'].'" style="width:20%;height:60px;">';
                        }
                        ?>
                        </td>
                           <td> Nurse Initials:<?php echo $check_res['ini4']??''; ?></td>

                        </tr>    
                        </table>

                        <div>
                            <p>Reason Medication Not Given</p>
                            <ol>
                            <li>Patient Refused</li>
                            <li>Patient’s Condition</li>
                            <li>Hold Per MD order</li>
                            </ol>

                        </div>   
                                                          
            <?php
        ?>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:right'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

//$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Ativan Protocol");
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

$mpdf->Output('Ativan Protocol.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>