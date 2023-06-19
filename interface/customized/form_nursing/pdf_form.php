<html>
  <head>
  <link rel="stylesheet" href="./style.css">
</head>

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
$pid = $_SESSION['pid'];;
$encounter = $_GET["encounter"];
$data =array();

if ($formid) {
    $sql = "SELECT * FROM form_nursing WHERE id = ? AND pid = ?";
    $res = sqlStatement($sql, array($formid,$pid));
    // $data = sqlFetchArray($res);
    // print_r($data);die;

    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
      $all[$iter] = $row;
  }
  $check_res = $all[0];
}
    $check_res = $formid ? $check_res : array();
    //print_r($check_res);die;
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Nursing Admission Assessment</h2>
</div>";
ob_start();
 ?>
 <div class="container mt-3">
  <div class="container-fluid">
    <div class="row">  
       <table class="table" style="width: 100%;border:1px solid black;height:100%">
           <thead>
               <tr>
                  <td style="padding-bottom: 30px;float: left; "><h4>Nursing Admission Assessment</h4></td>
                  <td style="padding-bottom: 30px;float: right; "><h4>Center for Network Therapy</h4></td>
               </tr>
               <tr>
                  <td  style="padding-bottom: 30px;"><h4>Admission Note:</h4></td>
               </tr>
               <tr>
                   <td><p>
                   DATE: TIME: Pt admitted for DIAGNOSIS (OPIATE, BENZODIAZAPINE/SED/HYP, ETOH, CANNABIS, ETC.) Pt
c/o (CURRENT SYMPTOMS). Pt reports (DRUG HISTORY). Pt reports (STRESSORS). Pt (PAST MEDICAL
HISTORY). Pt (PYSCH HISTORY). PT (Current Medications). (Surgeries). (Treatment Hx). Pt AAO X3. NO
current evidence of Si/HI. NO AH/VH. VS. PERRLA. Pt present (MOOD). (AFFECT). Pt RECEIVED
(MEDICATIONS). TOLERATED WELL. Pt received one on one support. Pt safety precautions maintained.
Pt was educated about program, treatment plan, relapse prevention, withdrawal symptoms,
medications, drug interactions, risky behaviors, potential for overdose and possible death. Pt verbalized
understanding. Pt oriented to facility and facility rules. DOCUMENT IF PT RECEIVED PPD/ LABS. Pt
remains at risk for relapse/ noncompliance. Will continue to monitor.
                   </p></td>
               </tr>
               <tr>
                   <td style="float:left; ">Nurse Signature/ Credentials:<b><?php echo text($check_res['nurse']);?></b></td>
                     <td style="float: right; ">Date/Time:<b><?php echo text($check_res['dtime']);?></b></td>
               </tr>
           </thead>
       </table>
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
$mpdf->setTitle("Nursing Admission Assessment");
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

$mpdf->Output("Nurse.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>