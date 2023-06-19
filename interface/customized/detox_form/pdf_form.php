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
    $sql = "SELECT * FROM form_detox WHERE id = ? AND pid = ?";
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
<h2>Detox Master Treatment Plan Form</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
        <table style="width: 100%;">
        <tr>
        <td style="width: 60%;">Patient Name:<b><?php echo $check_res['txt1']; ?></b>
        <br><br>DOB:<b><?php echo $check_res['txt2']; ?></b></td>
                    <td><b>Center for Network Therapy</b></td>
</tr>
</table><br>
<br>
<table style="width:100%;">
          <tr>
            <th style="width:100%;"><h3 class="h3_1">Detox Master Treatment Plan: Nursing</h3></th>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black;" class="tabel5">
          <tr>
            <td style="border: 1px solid black; width: 25%;"><b>Target Problem:</b>
              <p>Phsical Withdrawls Mental instability</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

            </td>

            <td style="border: 1px solid black;width: 25%;"><b>Interventions:</b>
<p><input type="checkbox" name="check1" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'" ;
  }?>
>Suboxone 8 day protocol</p>
<p><input type="checkbox" name="check2" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Suboxone 5 day protocol</p>
<p><input type="checkbox" name="check3" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Suboxone 4 day protocol</p>
<p><input type="checkbox" name="check4" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Suboxone custom protocol</p>
<p><input type="checkbox" name="check5" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Suboxone induction</p>
<p><input type="checkbox" name="check6" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Ativan b protocol</p>
<p><input type="checkbox" name="check7" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Ativan c protocol</p>
<p><input type="checkbox" name="check8" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Ativan custom protocol</p>
<p><input type="checkbox" name="check9" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Libirium b protocol</p>
<p><input type="checkbox" name="check10" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Libirium c protocol</p>
<p><input type="checkbox" name="check11" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Libirium custom protocol</p>
<p><input type="checkbox" name="check12" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Valium custom protocol</p>
<p><input type="checkbox" name="check13" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Neurotin induction</p>
<p><input type="checkbox" name="check14" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Thiamin and Folate supplement</p>
<p><input type="checkbox" name="check15" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Keppra Custom order</p>
<p><input type="checkbox" name="check16" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Keppra 500mg po BID</p>
<p><input type="checkbox" name="check17" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>All prn medication order by M.D if no contraindications</p>
<p><input type="checkbox" name="check18" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Clonidine b protocol</p>
<p><input type="checkbox" name="check19" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Clonidine custom protocol</p>
<p><input type="checkbox" name="check20" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>Prescription medication management</p>

            </td>
            <td style="border: 1px solid black;width: 25%;"><b>Time Frame:</b>
<p>
<input type="checkbox" name="check21" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check22" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
<input type="checkbox" name="check23" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check24" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check25" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check26" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check27" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check28" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check29" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check30" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check31" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check32" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check33" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check34" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check35" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check36" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check37" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check38" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check39" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check40" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check41" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p><input type="checkbox" name="check42" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
<input type="checkbox" name="check43" value="1"<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
<input type="checkbox" name="check44" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days</p>

<p>
  <input type="checkbox" name="check45" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check46" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check47" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check48" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check49" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check50" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check51" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check52" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check53" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check54" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check55" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check56" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check57" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check58" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check59" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check60" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check61" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check62" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check63" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check64" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check65" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check66" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check67" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check68" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check69" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check70" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check71" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check72" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check73" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check74" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check75" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>24hrs
  <input type="checkbox" name="check76" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>48hrs
  <input type="checkbox" name="check77" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>>5days
</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>


            </td>
            <td style="border: 1px solid black;width: 25%;"><b>Teaching Strategies:</b>
<p><b>1.Written Material</b></p>
<p><b>2.Verbal Discussion</b></p>
<p><b>3.One on One</b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>


            </td>
          </tr>
        </table><br><br>
        <table>
          <tr>
            <td><b>Nurse Signature:</b><img src='data:image/png;base64,<?php echo xlt($check_res['nsign']); ?>' width='100px' height='50px'/> </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>Date:<b><?php echo $check_res['date1'];?></b></td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>Time:<b><?php echo $check_res['time1'];?></b></td>
          </tr>
        <tr>
    <td>
        &nbsp;
        
    </td>
</tr>
          <tr>
          <td><b>Patient Signature:</b> <img src='data:image/png;base64,<?php echo xlt($check_res['psign']); ?>' width='100px' height='50px'/></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>Date:<b><?php echo $check_res['date2'];?></b></td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>Time:<b><?php echo $check_res['time2'];?></b></td>
          </tr>
        </table><br><br>
            

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
$mpdf->setTitle("Master Treatment Plan Form");
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

$mpdf->Output("Detox.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>