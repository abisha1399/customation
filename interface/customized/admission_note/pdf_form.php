<html>
  <head>
  <!-- <link rel="stylesheet" href="./style.css"> -->
</head>

<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");


$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$name = $_GET['formname'];
$pid = $_session['pid'];
$encounter = $_GET["encounter"];
$data =array();
$check_res=[];
if ($formid) {
    $sql = "SELECT * FROM form_admission_note1 WHERE id = ?";
    $check_res = sqlQuery($sql, array($formid));
    
}
$check_res = $formid ? $check_res : array();
 
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
use OpenEMR\Core\Header;
use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Admission Note</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
        <table style="width: 100%;">
            <tr>
                <td><b>Nursing Admission Assessment</b></td>
                <td style="width: 30%;"><b>Center for Network Therapy</b></td>
            </tr>
        </table><br><br>

        <tabel style="width: 100%;">
          <tr>
              <td>
                  <b><u>Admission Note:</u></b><br>
                 <?php echo $check_res['txt1'];?>
              </td>
        </tr>
        
        </tabel><br>
        <tabel>
        <tr>
        <td style="width: 40%;">Nurse Signature/Credentials:<b><?php echo $check_res['inp1'];?></b></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td tyle="width: 60%;">Date/Time:<b><?php echo $check_res['inp2'];?></b></td>
      </tr>
      </tabel>





        </div>
      </div>
</div>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Fall Risk Management");
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

$mpdf->Output("Admission Note.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>