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
$pid = $_SESSION['pid'];
$encounter = $_GET["encounter"];
$data =array();

if ($formid) {
    $sql = "SELECT * FROM form_integumentary WHERE id = ? AND pid = ?";
    $res = sqlStatement($sql, array($formid,$pid));
    //$data = sqlFetchArray($res);
    // print_r($data);die;

    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
      $all[$iter] = $row;
  }
  $check_res = $all[0];
}
    $check_res = $formid ? $check_res : array();
    // print_r($check_res);die;
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Integumentary Form</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">



<table style="width: 100%;">
    <tr>
        <td style="font-size: 20px;"><b><u>Integumentary</u></b></td>
    </tr>
</table>
<table style="width:100%;">
    <tr>
      <td><b>
        Skin warm,dry and intact. No jaundice. No lesions or reddened areas.<br>Oral mucous membranes pink and moist. Nail beds pink<br><u>Abnoramal Findings</u>(Please use diagram code on appropiate area)
      </b><br><input type="checkbox" name="check2" value="1"
      <?php if($check_res['check2']=="1"){
        echo "checked='checked'";
       } ?>
      >History Of eczema.
      </td>
      <td><b>Normal Findings:</b><input type="checkbox" name="check1" value="1"
      <?php if($check_res['check2']=="1"){
        echo "checked='checked'";
       } ?>
      ></td>
    </tr>
  </table><br><br>
  <div class="parent">
    <div class="sub1" align="left" style="width: 50%;float: left;">
      <img src="../../forms/integumentary/uploads/vector.png">
    </div>
    <div class="sub2" align="right" style="width: 30%;float: right;margin-top:25px;">
      <table style="border: 1px solid black;">
        <tr>
          <td><b>DIAGRAM CODE:</b></td>
        </tr>
        <tr>
          <td>B=Burn</td>
        </tr>
        <tr>
          <td>C=Contusion</td>
        </tr>
        <tr>
          <td>D=Decubitus</td>
        </tr>
        <tr>
          <td>E=Erythema</td>
        </tr>
        <tr>
          <td>I=Incision</td>
        </tr>
        <tr>
          <td>J=Body piercing</td>
        </tr>
        <tr>
          <td>L=Laceration</td>
        </tr>
        <tr>
          <td>P=Petechiae</td>
        </tr>
        <tr>
          <td>R=Rash</td>
        </tr>
        <tr>
          <td>S=Sour</td>
        </tr>
        <tr>
          <td>T=Tattoo</td>
        </tr>
      </table>
    </div>
  </div>
  <br><br>
<table>
  <tr>
    <td><b>Patient shows physical or behavioral signs of abuse</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="check3" value="1"
    <?php if($check_res['check3']=="1"){
      echo "checked='checked'";
     } ?>
    >No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="check4" value="1"
    <?php if($check_res['check4']=="1"){
      echo "checked='checked'";
     } ?>
    >Yes</td>
  </tr>
</table>
<table style="width:100%;">
    <tr>
      <td style="width:100%;border: 1px solid black;height:20px;"></td>
    </tr>
  </table><br><br>
  <table>
    <tr>
      <td><b>*signs of Abuse</b></td>
    </tr>
    <tr>
      <td><input type="checkbox" name="check5" value="1"
      <?php if($check_res['check5']=="1"){
        echo "checked='checked'";
       } ?>
      >Unexplained bruising</td>
      <td><input type="checkbox" name="check6" value="1"
      <?php if($check_res['check6']=="1"){
        echo "checked='checked'";
       } ?>
      >Multiple injuries in defferent stages of heating</td>
    </tr>
      <tr>
      <td><input type="checkbox" name="check7" value="1"
      <?php if($check_res['check7']=="1"){
        echo "checked='checked'";
       } ?>
      >unexplained burn</td>
      <td><input type="checkbox" name="check8" value="1"
      <?php if($check_res['check8']=="1"){
        echo "checked='checked'";
       } ?>
      >Genital injury</td>
    </tr>
      </tr>
      <tr>
      <td><input type="checkbox" name="check9" value="1"
      <?php if($check_res['check9']=="1"){
        echo "checked='checked'";
       } ?>
      >Unusual fearfulness</td>
      <td><input type="checkbox" name="check10" value="1"
      <?php if($check_res['check10']=="1"){
        echo "checked='checked'";
       } ?>
      >Other:</td>
    </tr>
        <tr>
      <td><input type="checkbox" name="check11" value="1"
      <?php if($check_res['check11']=="1"){
        echo "checked='checked'";
       } ?>
      >Story inconsistent with injury</td>
    </tr>
  </table><br>
  <table style="border-bottom:1px solid black;width: 100%;">
    <tr>
      <td>
        <ul>
          <li><i>Refer to Victim Abuse Guidelines</i></li>
        </ul>
      </td>
    </tr>
  </table>
  <table>
    <tr>
      <td>
        <b>**According to patient, he/she(see diagram)&uarr;</b>
      </td>
    </tr>
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
$mpdf->setTitle("Integumentary Form");
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
//     $pdf$check_res = sqlInsert('INSERT INTO pdf_directory (path,pid,encounter,formid) VALUES (?,?,?,?)',array($filename,$_SESSION["pid"],$_SESSION["encounter"],$formid));
// }

$mpdf->Output("Integumentary Form.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>