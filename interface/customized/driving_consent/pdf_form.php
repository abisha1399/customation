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

    $sql = "SELECT * FROM form_driving_consent WHERE id = $formid AND pid = $pid";

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
                    <div style="border:1px solid black;padding-left:3px;padding-right:3px;">
                        <table style="width:100%;margin-top:4px;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Date:</b> <?php echo xlt($data['date']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;text-align:center;">
                                    <h3><u><b>Driving Consent</b></u></h3>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;text-align:justify;">
                                
                                    <p>I, <?php echo($data['text1']);?> 
                                    <?php echo $data['txt']??"
                                    was educated by the medical and clinical staff at the Central for Network Therapy office about the transportation policy specific to ambulatory patients driving while attending his detoxification program. By signing this letter, I acknowledge that I understand that as a patient in the Ambulatory Detoxification program I take it upon myself to drive even thought the medication may or may not influence my ability to operate a vehicle. I was educated of the risks/ benefits of the medication and understand the benefits of the explanation."
                                    ?></p>
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
                                    <!-- <?php echo xlt($data['patient']); ?> -->
                                </label>
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
$mpdf->setTitle("Driving Consent");
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

$mpdf->Output('Driving_Consent.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
