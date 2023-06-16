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
    $sql = "SELECT * FROM form_recovery_management WHERE id = ?";
    $res = sqlStatement($sql, array($formid));
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
<h2>Recovery Management Form</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
        <table>
            <tr>
                <td>
                    <p><b>The Center For Network therapy<br>20 Gibson Place, Suite 103<br>Freehold, NJ 07728<br>732-431-5800</b></p>
</td>
</tr>
</table>
<table style="width:100%;">
    <tr>
        <td></td>
      <td  style="width:70%;">
        <h3 id="h3_1"><u>Recovery Management Evaluation</u></h3>
      </td>
    </tr>
  </table><br><br>
    <table style="width:100%;">
    <tr>
      <td style="width:33%;border:1px solid black;">
        
      </td>
      <td style="width:33%;border:1px solid black;">
      <b>Pre test,day of admission</b>  
      </td>
            <td style="width:33%;border:1px solid black;">
        <b>Post test,day of discharge</b> 
      </td>
    </tr>
  </table><br><br>
     <table style="width:100%;">
    <tr>
      <td style="width:33%;border:1px solid black;">
       <p> Recognizes consequences of <br> continued substance abuse.</p>
      </td>
      <td style="width:33%;border:1px solid black;">
        <input type="checkbox" name="check1" value="1"
        <?php if($check_res['check1'] == "1"){
  echo "checked='checked'";
  }?>
        >YES
         <input type="checkbox" name="check1" value="2"
         <?php if($check_res['check1'] == "2"){
  echo "checked='checked'";
  }?>
         >NO
          <input type="checkbox" name="check1" value="3"
          <?php if($check_res['check1'] == "3"){
  echo "checked='checked'";
  }?>
          >N/A
      </td>
        <td style="width:33%;border:1px solid black;">
         <input type="checkbox" name="check2" value="1"
         <?php if($check_res['check2'] == "1"){
  echo "checked='checked'";
  }?>
         >YES
         <input type="checkbox" name="check5" value="1"
         <?php if($check_res['check2'] == "2"){
  echo "checked='checked'";
  }?>
         >NO
          <input type="checkbox" name="check6" value="1"
          <?php if($check_res['check2'] == "3"){
  echo "checked='checked'";
  }?>
          >N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;border:1px solid black;">
        <p>Able to provide information regarding his or<br>her prescribed medications.</p>
      </td>
      <td style="width:33%;border:1px solid black;">
       <input type="checkbox" name="check7" value="1"
       <?php if($check_res['check3'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check8" value="1"
         <?php if($check_res['check3'] == "2"){
  echo "checked='checked'";
  }?>
         >NO
          <input type="checkbox" name="check9" value="1"
          
          <?php if($check_res['check3'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
            <td style="width:33%;border:1px solid black;">
        <input type="checkbox" name="check10" value="1"
        <?php if($check_res['check4'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check11" value="1"
         <?php if($check_res['check4'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check12" value="1"
          <?php if($check_res['check4'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;border:1px solid black;">
        <p>identifies early warning signs and symptom and factors that contibute to relapse.</p>
      </td>
      <td style="width:33%;border:1px solid black;">
     <input type="checkbox" name="check13" value="1"
     <?php if($check_res['check5'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check14" value="1"
         <?php if($check_res['check5'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check15" value="1"
          <?php if($check_res['check5'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
            <td style="width:33%;border:1px solid black;">
        <input type="checkbox" name="check16" value="1"
        <?php if($check_res['check6'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check17" value="1"
         <?php if($check_res['check6'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check18" value="1"
          <?php if($check_res['check6'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;border:1px solid black;">
        <p>Identifies recovery strategies to prevent re-hospitalizations.</p>
      </td>
      <td style="width:33%;">
      <input type="checkbox" name="check19" value="1"
      <?php if($check_res['check7'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check20" value="1"
         <?php if($check_res['check7'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check21" value="1"
          <?php if($check_res['check7'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
            <td style="width:33%;border:1px solid black;">
       <input type="checkbox" name="check22" value="1"
       <?php if($check_res['check8'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check23" value="1"
         <?php if($check_res['check8'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check24" value="1"
          <?php if($check_res['check8'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;border:1px solid black;">
        <p>Identifies relief of symptoms or endure mild symptoms.</p>
      </td>
      <td style="width:33%;border:1px solid black;">
       <input type="checkbox" name="check25" value="1"
       <?php if($check_res['check9'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check26" value="1"
         <?php if($check_res['check9'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check27" value="1"
          <?php if($check_res['check9'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
            <td style="width:33%;border:1px solid black;">
        <input type="checkbox" name="check28" value="1"
        <?php if($check_res['check10'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check29" value="1"
         <?php if($check_res['check10'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check30" value="1"
          <?php if($check_res['check10'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;border:1px solid black;">
        <p>Demonstrates informed decision making regarding medications.</p>
      </td>
      <td style="width:33%;border:1px solid black;">
       <input type="checkbox" name="check31" value="1"
       <?php if($check_res['check11'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check32" value="1"
         <?php if($check_res['check11'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check33" value="1"
          <?php if($check_res['check11'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
            <td style="width:33%;border:1px solid black;">
        <input type="checkbox" name="check34" value="1"
        <?php if($check_res['check12'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check35" value="1"
         <?php if($check_res['check12'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check36" value="1"
          <?php if($check_res['check12'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;border:1px solid black;">
        <p>Identifies understanding of PAWS and the need for continued treatment.</p>
      </td>
      <td style="width:33%;border:1px solid black;">
      <input type="checkbox" name="check37" value="1"
      <?php if($check_res['check13'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check38" value="1"
         <?php if($check_res['check13'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check39" value="1"
          <?php if($check_res['check13'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
            <td style="width:33%;border:1px solid black;">
       <input type="checkbox" name="check40" value="1"
       <?php if($check_res['check14'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check41" value="1"
         <?php if($check_res['check14'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check42" value="1"
          <?php if($check_res['check14'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;border:1px solid black;">
        <p>Recognizes personal self awareness from pre-contemplation to contemplation state  </p>
      </td>
      <td style="width:33%;border:1px solid black;">
      <input type="checkbox" name="check43" value="1"
      <?php if($check_res['check15'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check44" value="1"
         <?php if($check_res['check15'] == "2"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check45" value="1"
          <?php if($check_res['check15'] == "3"){
  echo "checked='checked'";
  }?>>N/A
      </td>
            <td style="width:33%;border:1px solid black;">
        <input type="checkbox" name="check46" value="1"
        <?php if($check_res['check16'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check47" value="1"
         <?php if($check_res['check16'] == "1"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check48" value="1"
          <?php if($check_res['check16'] == "1"){
  echo "checked='checked'";
  }?>>N/A
      </td>
    </tr>

  </table>
  <br><br>
  <table>
     <tr>
      <td style="width:33%;border:1px solid black;">
        <p>Demonstrates an understanding of his/her illness and preferred treatment approaches.</p>
      </td>
      <td style="width:33%;border:1px solid black;">
      <input type="checkbox" name="check49" value="1"
      <?php if($check_res['check17'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check50" value="1"
         <?php if($check_res['check17'] == "1"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check51" value="1"
          <?php if($check_res['check17'] == "1"){
  echo "checked='checked'";
  }?>>N/A
      </td>
            <td style="width:33%;border:1px solid black;">
        <input type="checkbox" name="check52" value="1"
        <?php if($check_res['check18'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check53" value="1"
         <?php if($check_res['check18'] == "1"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check54" value="1"
          <?php if($check_res['check18'] == "1"){
  echo "checked='checked'";
  }?>>N/A
      </td>
    </tr>
     <tr>
      <td style="width:33%;border:1px solid black;">
        <p>Recognizes need for continued levels of step down treatment and or therapy.</p>
      </td>
      <td style="width:33%;border:1px solid black;">
      <input type="checkbox" name="check55" value="1"
      <?php if($check_res['check19'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check56" value="1"
         <?php if($check_res['check19'] == "1"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check57" value="1"
          <?php if($check_res['check19'] == "1"){
  echo "checked='checked'";
  }?>>N/A
      </td>
            <td style="width:33%;border:1px solid black;">
        <input type="checkbox" name="check58" value="1"
        <?php if($check_res['check20'] == "1"){
  echo "checked='checked'";
  }?>>YES
         <input type="checkbox" name="check59" value="1"
         <?php if($check_res['check20'] == "1"){
  echo "checked='checked'";
  }?>>NO
          <input type="checkbox" name="check60" value="1"
          <?php if($check_res['check20'] == "1"){
  echo "checked='checked'";
  }?>>N/A
      </td>
    </tr>
    
  </table><br><br>
  <tabel style="width:100%;">
      <tr>
          <td style="width:100%;border:1px solid black;">
          <?php echo $check_res['txt1']; ?>
</td>
</tr>
</table>
  
  <br> <br>
  <table style="width: 100%;" class="tbl">
    <tr>
      <td>Nurse Completing initial Assessment:<b><?php echo $check_res['inp1']; ?></b></td>
      <td>Date/Time:<b><?php echo $check_res['inp2']; ?></b></td>
    </tr>
  </table><br>
  <table style="width: 100%;" class="tbl">
    <tr>
      <td>Nurse Completing discharge Assessment:<b><?php echo $check_res['inp3']; ?></b></td>
      <td>Date/Time:<b><?php echo $check_res['inp4']; ?></b></td>
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
$mpdf->setTitle("Recovery Management Form");
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

$mpdf->Output("Recovery Management Form.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>