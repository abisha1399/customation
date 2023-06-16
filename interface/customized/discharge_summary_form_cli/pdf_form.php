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

    $sql = "SELECT * FROM `discharge_summary_cli` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
    $check_res = $formid ? $check_res : array();

    use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);


?>
<?php
$header ="<div style='color:white;background-color:grey;text-align:center'>
<H2>DISCHARGE SUMMARY</H2>
</div>";
ob_start();
?>

<table style="border:1px solid black;">
    <tr>
        <td style="border:1px solid black;">
            <b>Start Date:</b> <br>
            <p><?php echo text($check_res['input1']); ?></p>

        </td>
        <td style="border:1px solid black;">
           <b>Date of Discharge:</b>
           <p><?php echo text($check_res['input2']); ?></p>
        </td>
    </tr>
    <tr>
    <td style="border:1px solid black;">
            <b>DETOX/PCP(circle one):</b> <br>
            <p><?php echo text($check_res['input3']); ?></p>

        </td>
        <td style="border:1px solid black;">
           <b>Client Name:</b>
           <p><?php echo text($check_res['input4']); ?></p>
        </td>
    </tr>
    <tr>
    <td style="border:1px solid black;">
            <b>Client Address:</b> <br>
            <p><?php echo text($check_res['input5']); ?></p>

        </td>
        <td style="border:1px solid black;">
           <b>Client Phone Number:</b>
           <p><?php echo text($check_res['input6']); ?></p>
        </td>
    </tr>
    <tr>
    <td style="border:1px solid black;">
           <b>Diagnosis</b>
           <p><?php echo text($check_res['comment1']); ?></p>
        </td>
    </tr>
    <tr>
        <td style="border:1px solid black;">
        <b>Reason for Discharge</b>
        Successful Completion(Detox)<p><?php echo text($check_res['checkbox1']); ?></p>
        Successful Completion(partial care treatment) <p><?php echo text($check_res['checkbox2']); ?></p>
        AMD <p> <?php echo text($check_res['checkbox3']); ?></p>
        Non-Compliance <p> <?php echo text($check_res['checkbox4']); ?></p>
        Administrative Discharge <p> <?php echo text($check_res['checkbox5']); ?></p>
        Others: <p> <?php echo text($check_res['checkbox6']); ?></p>  </td>
    </tr>
    <tr>
        <b>Physician Discharge Note:</b>
        <td style="border:1px solid black;">
            <p><?php echo text($check_res['comment2']); ?></p>
            </td>
            </tr>
            <tr>
            <td style="border:1px solid black;">
            <p><?php echo text($check_res['comment3']); ?></p>

            </td >
            </tr>
            <tr>
            <td style="border:1px solid black;">
            <p><?php echo text($check_res['comment4']); ?></p>

            </td>
            </tr>
           <tr>
           <td style="border:1px solid black;">
            <p><?php echo text($check_res['comment5']); ?></p>

            </td>
           </tr>
            <tr>
            <td style="border:1px solid black;">
            <p><?php echo text($check_res['comment6']); ?></p>

            </td>
            </tr>
            <tr>
            <td style="border:1px solid black;">
            <p><?php echo text($check_res['comment7']); ?></p>

            </td>
            </tr>
            
            <tr>
            <td style="border:1px solid black;">
            <p><?php echo text($check_res['comment8']); ?><</p>

            </td>
            </tr>
              <tr>
              <td style="border:1px solid black;">
              <p><?php echo text($check_res['comment9']); ?><</p>

              </td>
              </tr>
    
</table>


<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Discharge Summary");
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

$mpdf->Output('discharge.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();