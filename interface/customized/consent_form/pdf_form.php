<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");

require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");


$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$name = $_GET['formname'];
$pid = $_GET["pid"];
$encounter = $_GET["encounter"];
$data =array();

    $sql = "SELECT * FROM form_consent WHERE id = $formid AND pid = $pid";

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
$header ="<div class='row' style='line-height:1px;' >
 <h4 style='text-align:center;'>Center for Network Therapy</h4>
 <p style='text-align:center;'>20 Gibson Place, Suite 103</p>
 <p style='text-align:center;'>Freehold, NJ 07728</p>
 <p style='text-align:center;'>732-431-5800</p>
</div>";

ob_start();

        ?>
        <!-- <hr/> -->
                    <div style="border:1px solid black;padding-left:3px;padding-right:3px;">
                        <table style="width:100%;margin-top:4px;">
                            <tr>
                                <td style="width:100%;text-align:center;">
                                    <h3><u><b>Consent Form</b></u></h3>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;text-align:justify;">
                                    <p>I, <?php echo($data['consenttext']);?> (patient name) am agreeing that I will not be ingesting any illegal substances, narcotics, or medications from any other facility that may hinder my detoxification process at CNT. I am agreeing to leave any and all substances and medically necessary medication off the premises of CNT unless documented that the medication is medically necessary in conjuction with a documented medical condition or if cleared by a CNT M.D or RN staff.I am agreeing I will not be using any other substances other than the prescribed medication from the CNT physician when going outside CNT premises. I am agreeing that will I not bring any kind of weapons on to CNT premises or be involved in any physical or verbal violence with any staff member or patient. I will be held responsible for my own actions if found ingesting any illegal substances while in treatment at CNT with the prescribed medications from CNT. I will also be held responsible if involved in any violence (physical or verbal) while in CNT care. CNT has the right to terminate my treatment if I'm found ingesting any illegal substances or any medication not cleared by a CNT MD or RN staff, distributing any substance on CNT premises, cheeking(hiding medication in the mouth) prescribed medications given by CNT, involved in any violence (physical or verbal) or possession of weapons of any kind. CNT will not be held accountable for my actions outside my acknowledge consent of CNT treatment and therapy. By signing below I agree to these terms and conditions.</p>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Patient Signature:</b>
                                    <?php
                                    if($data['patient']!='')
                                    {
                                    echo '<img style="height:50px;object-fit:cover;" src='.$data['patient'].'>';
                                    }
                                    ?>
                                    <!-- <?php echo xlt($data['patient']); ?></label> -->
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Date/Time:</b> <?php echo xlt($data['ptdate']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Staff/Nurse Signature:</b>
                                    <?php
                                    if($data['staff']!='')
                                    {
                                    echo '<img style="height:50px;object-fit:cover;" src='.$data['staff'].'>';
                                    }
                                    ?>
                                    <!-- <?php echo xlt($data['staff']); ?> -->
                                </label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Date/Time:</b> <?php echo xlt($data['stdate']); ?></label>
                                </td>
                            </tr>
                        </table>
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
$mpdf->setTitle("Consent Form");
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

$mpdf->Output('Consent_Form.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
