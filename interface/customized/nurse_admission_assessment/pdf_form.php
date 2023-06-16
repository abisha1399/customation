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
$_SESSION['pid'];;
$encounter = $_GET["encounter"];
$data =array();

if ($formid) {
    $sql = "SELECT * FROM form_nurse_admission WHERE id = ? AND pid = ?";
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

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Nurse Admission Assessment Form</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">

        <table class="cls">
          <tr>
            <td style="width:40%;"><b>Nursing Admission Assessment</b></td>
            <td style="width:20%;"><b>Center for Network Therapy</b></td>
          </tr>
        </table>
        <table style="width:100%;">
        <tr>
          <td style="height: 30px;border:1px solid black"></td>
        </tr>
        <tr>
            <th style="align:center;border:1px solid black"><strong>FUNCTIONAL STATUS</strong></th>
        </tr>
      </table>
      <table style="width:100%;border:1px solid black;">
        <tr>
          <td style="height:100px;"><input type="checkbox" name="check1" value="1"
          <?php 
              if($check_res['check1']=="1"){
                  echo "checked='checked'";
              }
              ?>
          >Independent with ADLs&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="checkbox" name="check2" value="1" <?php 
              if($check_res['check2']=="1"){
                  echo "checked='checked'";
              }
              ?>>Needs Prompting/encouragement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="checkbox" name="check3" value="1"
              <?php 
              if($check_res['check3']=="1"){
                  echo "checked='checked'";
              }
              ?>
              >Needs partial assistance&nbsp;
              <input type="checkbox" name="check4" value="1"
              <?php 
              if($check_res['check4']=="1"){
                  echo "checked='checked'";
              }
              ?>
              >Needs total assistance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
        </tr>
      </table>
      <table style="width: 100%;border: 1px solid black;">
        <tr>
          <td style="height: 30px;" class="td"><b>SPIRITUAL/CULTURAL ASSESSMENT</b></td>
        </tr>
      </table>
      <table  style="width: 100%;border: 1px solid black;">
        <tr>
          <td>
            <b><u>Spiritual:</b></u><br>
            What is your faith or belief?<br>
            What importance does faith have in your life?<br>
            Are you part of a spiritual or religious community?<br>
            Is this of support to you?<br>
            How would you like us to address these issues during this hospitalization?
            <br>
            <br>
            <b><u>Cultural:</u></b>
            Do you identify with any specific ethinic group?<br>
            Are there any specific cultural concerns that needs to be addressed during this stay?
            <br><br>
          </td>
        </tr>
      </table>
      <table  style="width: 100%;border: 1px solid black;">
        <tr>
          <td style="border-bottom: 1px solid black !important;">
            <br>
            <b>Is Patient a known or suspected gang member?&nbsp;&nbsp;&nbsp;&nbsp;
             </b> <input type="checkbox" name="check5" value="1"
             <?php 
              if($check_res['check5']=="1"){
                  echo "checked='checked'";
              }
              ?>
             >No&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="check6" value="1"
             <?php 
              if($check_res['check6']=="1"){
                  echo "checked='checked'";
              }
              ?>
             >Yes
             <br><br>
             <b style="text-align:center;" id="b1">FIREARMS ASSESSMENT</b><br>
             <br>
             <b>Does the patient have means of self-harm at home?</b>&nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="check7" value="1"
             <?php 
              if($check_res['check7']=="1"){
                  echo "checked='checked'";
              }
              ?>
             >No&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="check8" value="1"
             <?php 
              if($check_res['check8']=="1"){
                  echo "checked='checked'";
              }
              ?>
             >Yes (if yes,complete below, MD must be informed)<br>
             <b>what type of means?</b><br>
             <b>where is it (they) stored</b><br>
             <b>Who will dispose of or safely store items before you sent home? (name and phone #)</b><br>
           </td>
        </tr>
      </table>
      <table  style="width: 100%;border: 1px solid black;">
        <tr>
          <td>
            
            <b><ul>Notes:</ul></b><br>
            <?php echo $check_res['txt1'];?>
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
$mpdf->setTitle("Nurse Admission Assessment Form");
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

$mpdf->Output("Nurse Admission Assessment Form.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>