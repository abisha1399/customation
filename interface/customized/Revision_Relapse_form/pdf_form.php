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

    $sql = "SELECT * FROM `revisionrelapse_form` WHERE id = ? AND pid = ?";

    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);

    $check_res = $formid ? $check_res : array();

    use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<style>
    h2{
        text-align:center;
    }
</style>
<body id='body' class='body'>
<?php
$header ="<div style='color:white;background-color:grey;text-align:center'>
<H2>Center for Network Therapy <br> 20 Gibson Place,Suite 103 <br> Freehold,Nj 07728 <br>732-431-5800
</H2>
</div>";
ob_start();
?>
<table style="border:1px solid black; width:100%">
<tr>
      <td style="border:1px solid black;">
         <b>Patient Name:</b>
         <p><?php echo text($check_res['pname']); ?></p>
      </td>
      <td style="border:1px solid black;">
         <b>DOB:</b>
         <p><?php echo text($check_res['DOB']); ?></p>
      </td>
</tr>
<tr>
      <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkboxA1" value="1" <?php if ($check_res['checkboxA1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Informed Support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox6" value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkboxA3" value="1" <?php if ($check_res['checkboxA3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Family intervention<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox9" value="1" <?php if ($check_res['checkbox9'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkboxA4" value="1" <?php if ($check_res['checkboxA4'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Therapeutic support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox12" value="1" <?php if ($check_res['checkbox12'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
   <p><input type="checkbox" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;1:1<br></p>
    <p><input type="checkbox" name="checkbox14" value="1" <?php if ($check_res['checkbox14'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Written material<br></p>
    <p><input type="checkbox" name="checkbox15" value="1" <?php if ($check_res['checkbox15'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;groups<br></p>
    <p><input type="checkbox" name="checkbox16" value="1" <?php if ($check_res['checkbox16'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;videos<br></p>
    <p><input type="checkbox" name="checkbox17" value="1" <?php if ($check_res['checkbox17'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;verbal discussion<br></p>
    <p><input type="checkbox" name="checkbox18" value="1" <?php if ($check_res['checkbox18'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Demonstration<br></p>
   </td>
  </tr>


  <tr>
      <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox19" value="1" <?php if ($check_res['checkbox19'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Informed Support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox24" value="1" <?php if ($check_res['checkbox24'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox25" value="1" <?php if ($check_res['checkbox25'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox26" value="1" <?php if ($check_res['checkbox26'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox20" value="1" <?php if ($check_res['checkbox20'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Medication education/
    change in medication/
    prescription add on change<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox27" value="1" <?php if ($check_res['checkbox27'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox28" value="1" <?php if ($check_res['checkbox28'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox29" value="1" <?php if ($check_res['checkbox29'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox21" value="1" <?php if ($check_res['checkbox21'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Family intervention<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox30" value="1" <?php if ($check_res['checkbox30'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox31" value="1" <?php if ($check_res['checkbox31'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox32" value="1" <?php if ($check_res['checkbox32'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox33" value="1" <?php if ($check_res['checkbox33'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Therapeutic support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox34" value="1" <?php if ($check_res['checkbox34'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox35" value="1" <?php if ($check_res['checkbox35'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox36" value="1" <?php if ($check_res['checkbox36'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
   <p><input type="checkbox" name="checkbox37" value="1" <?php if ($check_res['checkbox37'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;1:1<br></p>
    <p><input type="checkbox" name="checkbox38" value="1" <?php if ($check_res['checkbox38'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Written material<br></p>
    <p><input type="checkbox" name="checkbox39" value="1" <?php if ($check_res['checkbox39'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;groups<br></p>
    <p><input type="checkbox" name="checkbox40" value="1" <?php if ($check_res['checkbox40'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;videos<br></p>
    <p><input type="checkbox" name="checkbox41" value="1" <?php if ($check_res['checkbox41'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;verbal discussion<br></p>
    <p><input type="checkbox" name="checkbox42" value="1" <?php if ($check_res['checkbox42'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Demonstration<br></p>
   </td>
  </tr>


  <tr>
      <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox43" value="1" <?php if ($check_res['checkbox43'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Informed Support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox47" value="1" <?php if ($check_res['checkbox47'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox48" value="1" <?php if ($check_res['checkbox48'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox49" value="1" <?php if ($check_res['checkbox49'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox44" value="1" <?php if ($check_res['checkbox44'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Medication education/
    change in medication/
    prescription add on change<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox50" value="1" <?php if ($check_res['checkbox50'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox51" value="1" <?php if ($check_res['checkbox51'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox52" value="1" <?php if ($check_res['checkbox52'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox45" value="1" <?php if ($check_res['checkbox45'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Family intervention<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox53" value="1" <?php if ($check_res['checkbox53'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox54" value="1" <?php if ($check_res['checkbox54'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox55" value="1" <?php if ($check_res['checkbox55'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox46" value="1" <?php if ($check_res['checkbox46'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Therapeutic support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox56" value="1" <?php if ($check_res['checkbox56'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox57" value="1" <?php if ($check_res['checkbox57'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox58" value="1" <?php if ($check_res['checkbox58'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
   <p><input type="checkbox" name="checkbox59" value="1" <?php if ($check_res['checkbox59'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;1:1<br></p>
    <p><input type="checkbox" name="checkbox60" value="1" <?php if ($check_res['checkbox60'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Written material<br></p>
    <p><input type="checkbox" name="checkbox61" value="1" <?php if ($check_res['checkbox61'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;groups<br></p>
    <p><input type="checkbox" name="checkbox62" value="1" <?php if ($check_res['checkbox62'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;videos<br></p>
    <p><input type="checkbox" name="checkbox63" value="1" <?php if ($check_res['checkbox63'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;verbal discussion<br></p>
    <p><input type="checkbox" name="checkbox64" value="1" <?php if ($check_res['checkbox64'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Demonstration<br></p>
   </td>
  </tr>



  <tr>
      <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox65" value="1" <?php if ($check_res['checkbox65'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Informed Support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox69" value="1" <?php if ($check_res['checkbox69'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox70" value="1" <?php if ($check_res['checkbox70'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox71" value="1" <?php if ($check_res['checkbox71'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox66" value="1" <?php if ($check_res['checkbox66'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Medication education/
    change in medication/
    prescription add on change<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox72" value="1" <?php if ($check_res['checkbox72'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox73" value="1" <?php if ($check_res['checkbox73'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox74" value="1" <?php if ($check_res['checkbox74'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox67" value="1" <?php if ($check_res['checkbox67'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Family intervention<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox75" value="1" <?php if ($check_res['checkbox75'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox76" value="1" <?php if ($check_res['checkbox76'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox77" value="1" <?php if ($check_res['checkbox77'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox68" value="1" <?php if ($check_res['checkbox68'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Therapeutic support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox78" value="1" <?php if ($check_res['checkbox78'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox79" value="1" <?php if ($check_res['checkbox79'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox80" value="1" <?php if ($check_res['checkbox80'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
   <p><input type="checkbox" name="checkbox81" value="1" <?php if ($check_res['checkbox81'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;1:1<br></p>
    <p><input type="checkbox" name="checkbox82" value="1" <?php if ($check_res['checkbox82'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Written material<br></p>
    <p><input type="checkbox" name="checkbox83" value="1" <?php if ($check_res['checkbox83'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;groups<br></p>
    <p><input type="checkbox" name="checkbox84" value="1" <?php if ($check_res['checkbox84'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;videos<br></p>
    <p><input type="checkbox" name="checkbox85" value="1" <?php if ($check_res['checkbox85'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;verbal discussion<br></p>
    <p><input type="checkbox" name="checkbox86" value="1" <?php if ($check_res['checkbox86'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Demonstration<br></p>
   </td>
  </tr>


  <tr>
      <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox88" value="1" <?php if ($check_res['checkbox88'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Informed Support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox92" value="1" <?php if ($check_res['checkbox92'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox93" value="1" <?php if ($check_res['checkbox93'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox94" value="1" <?php if ($check_res['checkbox94'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox89" value="1" <?php if ($check_res['checkbox89'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Medication education/
    change in medication/
    prescription add on change<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox95" value="1" <?php if ($check_res['checkbox95'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox96" value="1" <?php if ($check_res['checkbox96'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox97" value="1" <?php if ($check_res['checkbox97'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox90" value="1" <?php if ($check_res['checkbox90'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Family intervention<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox98" value="1" <?php if ($check_res['checkbox98'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox99" value="1" <?php if ($check_res['checkbox99'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox100" value="1" <?php if ($check_res['checkbox100'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox91" value="1" <?php if ($check_res['checkbox91'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Therapeutic support<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox101" value="1" <?php if ($check_res['checkbox101'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;24hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox102" value="1" <?php if ($check_res['checkbox102'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;48hrs<br></p>
   </td>
   <td style="border:1px solid black;">
      <b></b>
      <p><input type="checkbox" name="checkbox103" value="1" <?php if ($check_res['checkbox103'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br></p>
   </td>
   <td style="border:1px solid black;">
   <p><input type="checkbox" name="checkbox104" value="1" <?php if ($check_res['checkbox104'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;1:1<br></p>
    <p><input type="checkbox" name="checkbox105" value="1" <?php if ($check_res['checkbox105'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Written material<br></p>
    <p><input type="checkbox" name="checkbox106" value="1" <?php if ($check_res['checkbox106'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;groups<br></p>
    <p><input type="checkbox" name="checkbox107" value="1" <?php if ($check_res['checkbox107'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;videos<br></p>
    <p><input type="checkbox" name="checkbox108" value="1" <?php if ($check_res['checkbox108'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;verbal discussion<br></p>
    <p><input type="checkbox" name="checkbox109" value="1" <?php if ($check_res['checkbox109'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Demonstration<br></p>
   </td>
  </tr>
  <tr>
  <td style="border:1px solid black;">
          <b>Nurse signature:</b>
          <?php
                if($check_res['sign1']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign1'].'>';
                }
                ?>
          <!-- <p><?php echo text($check_res['sign1']); ?> </p> -->
      </td>
      <td style="border:1px solid black;">
          <b>Date:</b>
          <p><?php echo text($check_res['date1']); ?> </p>
      </td>
      <td style="border:1px solid black;">
          <b>Time:</b>
          <p><?php echo text($check_res['time1']); ?> </p>
      </td>
  </tr>
  <tr>
      <td style="border:1px solid black;">
          <b>Patient signature:</b>
          <?php
                if($check_res['sign2']!='')
                {
                   echo '<img style="height:50px;object-fit:cover;" src='.$check_res['sign2'].'>';
                }
                ?>
          <!-- <p><?php echo text($check_res['sign2']); ?> </p> -->
      </td>
      <td style="border:1px solid black;">
          <b>Date:</b>
          <p><?php echo text($check_res['date2']); ?> </p>
      </td>
      <td style="border:1px solid black;">
          <b>Time:</b>
          <p><?php echo text($check_res['time2']); ?> </p>
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
$mpdf->setTitle("Reason Form");
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

$mpdf->Output('test.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();


