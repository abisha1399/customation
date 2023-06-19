<html>
  <head>
  <!-- <link rel="stylesheet" href="./style.css"> -->
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
    $sql = "SELECT * FROM form_benzodiazepine WHERE id = ? AND pid = ?";
    $res = sqlStatement($sql, array($formid,$pid));
    // $data = sqlFetchArray($res);
    // print_r($data);die;

    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
      $all[$iter] = $row;
  }
  $check_res = $all[0];
}
//$check_res = sqlquery("SELECT * FROM form_benzodiazepine WHERE id = '".$formid."' AND pid = '".$pid."'");

    $check_res = $formid ? $check_res : array();
    // echo '<pre>';print_r($check_res);die;
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Benzodiazepine Form</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
        <table style="width:100%;">
          <tr>
            <td style="width:50%; border:1px solid black;"><h3 id="h3_1">Center for Network Therapy</h3><br>
              <div class="b1"><b><u>BENZODIAZEPINE<br>
                WITHDRAWAL SCALE<br>
                (CIWA-B)
              </u>
              </b></div>

            </td>
             <td style="width:50%;border:1px solid black;">
              <label>Name:</label><?php echo $check_res['inp1']?><br>
              <label id="dob_1">DOB:</label><?php echo $check_res['inp2']?><br>
              <label id="doa">DOA:</label><?php echo $check_res['inp3']?><br>
              <label id="m">M</label>
              <input type="checkbox" name="inp4" value="1" 
              <?php 
              if($check_res['inp4']=="1"){
                echo "checked='checked'";
              }
              ?>
              ><label>F</label>
              <input type="checkbox" name="inp5" value="1"
              <?php 
              if($check_res['inp5']=="1"){
                echo "checked='checked'";
              }
              ?>
              >

             </td>
          </tr>
          <tr>
            <td colspan="2" style="border:1px solid black;">
            
              
                <span><b>RATINGS:</b></span>
                
                <p><b>0<input type="checkbox" class="radio_change rating" data-id="rating" value="0" <?php echo isset($check_res['rating'])&& $check_res['rating']==0?'checked=checked':''; ?>><br>NONE</b></p>
                <p><b>1 <input type="checkbox" class="radio_change rating" data-id="rating" value="1" <?php echo isset($check_res['rating'])&& $check_res['rating']==1?'checked=checked':''; ?>><br>MILD</b></p>
                <p><b>2 <input type="checkbox" class="radio_change rating" data-id="rating" value="2" <?php echo isset($check_res['rating'])&& $check_res['rating']==2?'checked=checked':''; ?>><br>MODERATE</b></p>
                <p><b>3 <input type="checkbox" class="radio_change rating" data-id="rating" value="3" <?php echo isset($check_res['rating'])&& $check_res['rating']==3?'checked=checked':''; ?>><br>SEVERE</b></p>
                <p><b>4 <input type="checkbox" class="radio_change rating" data-id="rating" value="4" <?php echo isset($check_res['rating'])&& $check_res['rating']==4?'checked=checked':''; ?>><br>VERY SEVERE</b></p>
                <span><b>SUBJECTIVE<br>DATA</b></span>
             
             
            </td>
          </tr>
        </table><br><br>
        <table style="width:100%;">
          <tr>
            <td style="border:1px solid black;width:15%;"><b>Date</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp6']?></td>
            <td style="border:1px solid black;"> <?php echo $check_res['inp7']?></td>
            <td style="border:1px solid black;"> <?php echo $check_res['inp8']?></td >
            <td style="border:1px solid black;"> <?php echo $check_res['inp9']?></td >
            <td style="border:1px solid black;"><?php echo $check_res['inp10']?></td >
            <td style="border:1px solid black;"><?php echo $check_res['inp11']?></td >
            <td style="border:1px solid black;"><?php echo $check_res['inp12']?></td >
            <td style="border:1px solid black;"><?php echo $check_res['inp13']?></td >
            <td style="border:1px solid black;"><?php echo $check_res['inp14']?></td>
            
          
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="border:1px solid black;width:15%;"><b>Time</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp15']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp16']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp17']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp18']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp19']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp20']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp21']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp22']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp23']?></td>
            
          </tr>
        </table>

        <table style="width:100%;">
          <tr>
            <td style="border:1px solid black;width:15%;"><b>Do you feel irritable?</b></td>
           <td style="border:1px solid black;"><?php echo $check_res['inp24']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp25']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp26']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp27']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp28']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp29']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp30']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp31']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp32']?></td>
            
          </tr>
        </table>

        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Do you feel Tired?</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp33']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp34']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp35']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp36']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp37']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp38']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp39']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp40']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp41']?></td>
           
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Do you feel tense?</b></td>
          <td style="border:1px solid black;"><?php echo $check_res['inp42']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp43']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp44']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp45']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp46']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp47']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp48']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp49']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp50']?></td>
            
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Do you have a loss of appetite?</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp51']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp52']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp53']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp54']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp55']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp56']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp57']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp58']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp59']?></td>
        
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Is there numbness in your face &/or hands?</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp60']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp61']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp62']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp63']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp64']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp65']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp66']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp67']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp68']?></td>
           
          </tr>
        </table>
        <table style="width:100%;border:1px solid black;">
          <tr>
            <td style="width:15%;"><b>Is your heart racing?</b></td>
           <td style="border:1px solid black;"><?php echo $check_res['inp69']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp70']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp71']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp72']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp73']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp74']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp75']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp76']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp77']?></td>
            
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Does your head feel full/achy?</b></td>
           <td style="border:1px solid black;"><?php echo $check_res['inp78']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp79']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp80']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp81']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp82']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp83']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp84']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp85']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp86']?></td>
            
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Are you having difficulties concentrating?</b></td>
           <td style="border:1px solid black;"><?php echo $check_res['inp87']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp88']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp89']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp90']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp91']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp92']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp93']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp94']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp95']?></td>
            
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Are your muscles aching/<br>cramping/stiff?</b></td>
             <td style="border:1px solid black;"><?php echo $check_res['inp96']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp97']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp98']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp99']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp100']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp101']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp102']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp103']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp104']?></td>
         
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Do you feel anxious?</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp105']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp106']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp107']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp108']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp109']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp110']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp111']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp112']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp113']?></td>
                     </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Do you feel upset?</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp114']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp115']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp116']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp117']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp118']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp119']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp120']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp121']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp122']?></td>
            
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Do you feel that your sleep was not restful last night?</b></td>
           <td style="border:1px solid black;"><?php echo $check_res['inp123']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp124']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp125']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp126']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp127']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp128']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp129']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp130']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp131']?></td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Do you feel weak?</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp132']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp133']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp134']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp135']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp136']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp137']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp138']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp139']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp140']?></td>
            
          </tr>
        </table><br><br>

        <table width="100%;">
          <tr>
            <td style="border:1px solid black;"><b><u>Last Benzodiazepine use:</u></b><br>
              <b><u>Amount last 24 hours:</u></b>
            </td>
            <td style="border:1px solid black;"><label>Date</label>
                <?php echo $check_res['inp141']?><br>
                <label>Name:</label>
               <?php echo $check_res['inp142']?>
            </td>
            <td style="border:1px solid black;">
              <label>Time:</label><?php echo $check_res['inp143']?><br>
              <label>Dose:</label><?php echo $check_res['inp144']?>
            </td>
          </tr>
          </table>

          <table width="100%;">
          <tr>
            <td style="width:15%;border:1px solid black;"><b>Blood Pressure</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp145']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp146']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp147']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp148']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp149']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp150']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp151']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp152']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp153']?></td>
            
            
          </tr>
          <tr>
                <td style="width:15%;border:1px solid black;"><b>Pulse</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp154']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp155']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp156']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp157']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp158']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp159']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp160']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp161']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp162']?></td>
            
            
          </tr>
                    <tr>
                <td style="width:15%;border:1px solid black;"><b>Temperature per axilla</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp163']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp164']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp165']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp166']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp167']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp168']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp169']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp170']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp171']?></td>
            
            
          </tr>
                    <tr>
                <td style="width:15%;border:1px solid black;"><b>Respirations</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp172']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp173']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp174']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp175']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp176']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp177']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp178']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp179']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp180']?></td>
            
            
          </tr>
                              <tr>
                <td style="width:20%;border:1px solid black;"><b>Levels of Consciousness<br>
                    1-Alert,obeys,oriented<br>
                    2-Confused, responds to<br>
                    speech<br>
                    3-Stuporous,responds to<br>
                    pain<br>
                    4-Semi-comatose<br>
                    5-Comatose
                </b></td>
           <td style="border:1px solid black;"><?php echo $check_res['inp181']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp182']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp183']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp184']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp185']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp186']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp187']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp188']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp189']?></td>
            
          </tr>
          <tr>
            <td style="border:1px solid black;"><b>Pupils:</b>
                
                  <div style="border:1px solid black;"><b>+reacts<br>-no<br>reaction<br>B brisk <br>S<br>sluggish</b></div>
                  <div style="border:1px solid black;"><p id="p1">Size(in<br>mm)</p><b>REACTION</b></div>
                  
                </div>

            </td>
            <td style="border:1px solid black;width:9%;">
              <div id="bottom">
  <?php echo $check_res['inp190']?>
  <?php echo $check_res['inp191']?>
  <?php echo $check_res['inp192']?>
  <?php echo $check_res['inp193']?>

            </td>
            <td style="border:1px solid black;"> <div id="bottom">
  <?php echo $check_res['inp194']?>
  <?php echo $check_res['inp195']?>
  <?php echo $check_res['inp196']?>
  <?php echo $check_res['inp197']?>
</td>
            <td style="border:1px solid black;"> <div id="bottom">
  <?php echo $check_res['inp198']?>
  <?php echo $check_res['inp199']?>
  <?php echo $check_res['inp200']?>
  <?php echo $check_res['inp201']?>
</td>
            <td style="border:1px solid black;"> <div id="bottom">
  <?php echo $check_res['inp202']?>
  <?php echo $check_res['inp203']?>
  <?php echo $check_res['inp204']?>
  <?php echo $check_res['inp205']?>
</td>
            <td style="border:1px solid black;"> <div id="bottom">
  <?php echo $check_res['inp206']?>
  <?php echo $check_res['inp207']?>
  <?php echo $check_res['inp208']?>
  <?php echo $check_res['inp209']?>
</td>
            <td style="border:1px solid black;"> <div id="bottom">
  <?php echo $check_res['inp210']?>
  <?php echo $check_res['inp211']?>
  <?php echo $check_res['inp212']?>
  <?php echo $check_res['inp213']?>
</td>
            <td style="border:1px solid black;"> <div id="bottom">
  <?php echo $check_res['inp214']?>
  <?php echo $check_res['inp215']?>
  <?php echo $check_res['inp216']?>
  <?php echo $check_res['inp217']?>
</td>
            <td style="border:1px solid black;"> <div id="bottom">
  <?php echo $check_res['inp218']?>
  <?php echo $check_res['inp219']?>
  <?php echo $check_res['inp220']?>
  <?php echo $check_res['inp221']?>
</td>
            <td style="border:1px solid black;"> <div id="bottom">
  <?php echo $check_res['inp222']?>
  <?php echo $check_res['inp223']?>
  <?php echo $check_res['inp224']?>
  <?php echo $check_res['inp225']?>
</td>
            </tr>
            <tr>
            <td style="width:15%;border:1px solid black;"><b>Medications Given?</b></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp226']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp227']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp228']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp229']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp230']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp231']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp232']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp233']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp234']?></td>
            
            
          </tr>
                    <tr>
            <td style="width:15%;border:1px solid black;"><b>Nurse Initials</b></td>
           <td style="border:1px solid black;"><?php echo $check_res['inp235']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp236']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp237']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp238']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp239']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp240']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp241']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp242']?></td>
            <td style="border:1px solid black;"><?php echo $check_res['inp243']?></td>
            
            
          </tr>
          
        </table>
        <img src="\NetworkTherapy\openemr\interface\forms\benzodiazepine\uploads\rating.png">
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
$mpdf->setTitle("Benzodiazepine Form");
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

$mpdf->Output("Benzodiazepine Form.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>