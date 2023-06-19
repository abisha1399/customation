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

    $sql = "SELECT * FROM form_medication_order WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $data = sqlFetchArray($res);
     
    $check_res = $formid ? $check_res : array();

   

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
        <table style="width:100%;"> 
            <tr>
                <td style="width:100%;text-align:center;"> 
                    <h3>The Center for Network Therapy</h3>
                </td>
            </tr>
        </table> 
        <table style="margin-top: 6px;width:100%;"> 
            <tr>
                <td style="width:100%;">
                <label><b>Patient Name:</b> <?php echo xlt($data['patient']); ?></label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;"> 
            <tr>
                <td style="width:100%;">
                <label><b>DOB:</b> <?php echo xlt($data['date']); ?></label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;"> 
            <tr>
                <td style="width:100%;">
                <label><b>Allergies:</b> <?php echo xlt($data['allergy']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="width:100%;"> 
            <tr>
                <td style="width:100%;text-align:center;"> 
                    <h3>Medication Order Form</h3>
                </td>
            </tr>
        </table> 
        <br/>                     
        
        <table style="width:100%;border:1px solid black;border-collapse:collapse;text-align:center;"> 
            <tr>
                <td style="border: 1px solid black;border-collapse: collapse;">
                    <label><b>Date/Time</b></label>
                </td>  
                <td style="border: 1px solid black;border-collapse: collapse;">
                    <label><b>Medication, Dosage, Frequency & Route</b></label>
                </td> 
                <td style="border: 1px solid black;border-collapse: collapse;">
                    <label><b>Indication</b></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date1']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication1']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication1']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date2']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication2']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication2']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date3']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication3']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication3']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date4']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication4']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication4']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date5']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication5']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication5']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date6']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication6']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication6']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date7']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication7']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication7']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date8']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication8']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication8']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date9']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication9']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication9']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date10']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication10']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication10']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date11']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication11']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication11']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date12']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication12']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication12']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date13']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication13']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication13']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date14']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication14']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication14']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date15']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication15']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication15']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date16']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication16']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication16']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date17']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication17']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication17']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date18']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication18']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication18']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date19']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication19']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication19']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date20']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication20']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication20']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date21']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication21']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication21']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date22']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication22']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication22']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date23']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication23']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication23']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date24']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication24']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication24']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date25']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication25']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication25']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date26']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication26']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication26']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date27']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication27']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication27']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date28']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication28']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication28']); ?></label>
                </td>
            </tr>
            <tr>
            <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date29']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication29']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication29']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date30']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication30']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication30']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date31']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication31']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication31']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date32']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication32']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication32']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date33']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication33']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication33']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date34']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication34']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication34']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date35']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication35']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication35']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date36']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication36']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication36']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date37']); ?></label>
                </td>   
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['medication37']); ?></label>
                </td>  
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['indication37']); ?></label>
                </td>
            </tr>
        </table>
        
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
$mpdf->setTitle("Medication Order Form");
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

$mpdf->Output('Medication Order Form.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>