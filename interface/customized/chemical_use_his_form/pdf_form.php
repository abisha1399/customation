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

    $sql = "SELECT * FROM `chemical_use_form` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
    $check_res = $formid ? $check_res : array();

    use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);


?>

<?php
$header ="<div style='color:white;background-color:grey;text-align:center'>
<H2>Center for Network Theropey <br> 20 Gibson Place,Suite 103 <br> Freeehold,Nj07728 <br>732-431-5800
</H2>
</div>";
ob_start();
?>

<table style="border:1px solid black; width:100%">
   <tr>
       <th style="border:1px solid black;">
       <p><input type="checkbox" name="checkbox01" value="1" <?php if ($check_res['checkbox01'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Denies used all chemical<br></p> 
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Class of Substance</b>
       </th>
       <th style="border:1px solid black;">
           <b>	Amount,Frequency,pattern use</b>
       </th>
       <th style="border:1px solid black;">
           <b>	Duration</b>
       </th>
       <th style="border:1px solid black;">
           <b>	Last Used</b>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Cigarettes/Tobacco</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input1']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input2']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input3']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Alcohol</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input4']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input5']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input6']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Amphetamine</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input7']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input8']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input9']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Marijuana</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input10']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input11']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input12']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Cocaine</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input13']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input14']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input15']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Hallucinogens</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input16']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input17']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input18']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Inhalants</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input19']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input20']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input21']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Opiates</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input22']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input23']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input24']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>PCP</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input25']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input26']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input27']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Sedatives</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input28']); ?></p>
       </th>
       <th style="border:1px solid black;"> 
       <p><?php echo text($check_res['input29']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input30']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Ecstasy</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input31']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input32']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input33']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Rave drugs</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input34']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input35']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input36']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Prescription pain meds</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input37']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input38']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input39']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <b>Other</b>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input40']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input41']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <p><?php echo text($check_res['input42']); ?></p>
       </th>
   </tr>
</table>
<table style="border:1px solid black;">
   <b>TREATMENT HISTORY</b>
   <tr>
       <th style="border:1px solid black;">
       <p>Substance abuse:(most recent,reason,for treatment,facility,when,treatment length,level of treatment,outcome)</p>
       <p><?php echo text($check_res['input43']); ?></p>
       <p><?php echo text($check_res['input44']); ?></p>
       <p><?php echo text($check_res['input45']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <p>Longest period of abstinece:(when and how it was achieved):</p>
           <p><?php echo text($check_res['input46']); ?></p>
       <p><?php echo text($check_res['input47']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
           <p>Previous psychiatric Treatment History</p>
           <p><?php echo text($check_res['input48']); ?></p>
           <p><?php echo text($check_res['input49']); ?></p>
           <p><?php echo text($check_res['input50']); ?></p>
           <p><?php echo text($check_res['input51']); ?></p>
           <p><?php echo text($check_res['input52']); ?></p>
       </th>
   </tr>
</table>
<table style="border:1px solid black;">
    <tr>
        <th style="border:1px solid black;">
        <b>Heart disease</b>
        <p><input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th style="border:1px solid black;">
        <b>Heart disease</b>
        <p><input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Ulcer/reflux</b>
        <p><input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>Thyroid</b>
        <p><input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox6" value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th style="border:1px solid black;">
        <b>Heart disease</b>
        <p><input type="checkbox" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th style="border:1px solid black;">
        <b>Immune disorder</b>
        <p><input type="checkbox" name="checkbox9" value="1" <?php if ($check_res['checkbox9'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Vascular disease</b>
        <p><input type="checkbox" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox12" value="1" <?php if ($check_res['checkbox12'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>hepatitis</b>
        <p><input type="checkbox" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox14" value="1" <?php if ($check_res['checkbox14'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th style="border:1px solid black;">
        <b>Chest pain/Arrhythmia</b>
        <p><input type="checkbox" name="checkbox15" value="1" <?php if ($check_res['checkbox15'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox16" value="1" <?php if ($check_res['checkbox16'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Migraines</b>
        <p><input type="checkbox" name="checkbox17" value="1" <?php if ($check_res['checkbox17'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox18" value="1" <?php if ($check_res['checkbox18'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>cancer Medical</b>
        <p><input type="checkbox" name="checkbox19" value="1" <?php if ($check_res['checkbox19'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox20" value="1" <?php if ($check_res['checkbox20'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th style="border:1px solid black;">
        <b>Kidney disease</b>
        <p><input type="checkbox" name="checkbox21" value="1" <?php if ($check_res['checkbox21'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox22" value="1" <?php if ($check_res['checkbox22'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Pneumonia</b>
        <p><input type="checkbox" name="checkbox23" value="1" <?php if ($check_res['checkbox23'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox24" value="1" <?php if ($check_res['checkbox24'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>Diabetes</b>
        <p><input type="checkbox" name="checkbox25" value="1" <?php if ($check_res['checkbox25'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox26" value="1" <?php if ($check_res['checkbox26'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th style="border:1px solid black;">
        <b>Hypertension</b>
        <p><input type="checkbox" name="checkbox27" value="1" <?php if ($check_res['checkbox27'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox28" value="1" <?php if ($check_res['checkbox28'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	TIA/CVA</b>
        <p><input type="checkbox" name="checkbox29" value="1" <?php if ($check_res['checkbox29'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox30" value="1" <?php if ($check_res['checkbox30'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Seizures disorder</b>
        <p><input type="checkbox" name="checkbox31" value="1" <?php if ($check_res['checkbox31'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox32" value="1" <?php if ($check_res['checkbox32'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th style="border:1px solid black;">
        <b>Blood disease</b>
        <p><input type="checkbox" name="checkbox33" value="1" <?php if ($check_res['checkbox33'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox34" value="1" <?php if ($check_res['checkbox34'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Asthma</b>
        <p><input type="checkbox" name="checkbox35" value="1" <?php if ($check_res['checkbox35'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox36" value="1" <?php if ($check_res['checkbox36'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Eye problem</b>
        <p><input type="checkbox" name="checkbox37" value="1" <?php if ($check_res['checkbox37'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox38" value="1" <?php if ($check_res['checkbox38'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th style="border:1px solid black;">
        <b>Memory loss</b>
        <p><input type="checkbox" name="checkbox39" value="1" <?php if ($check_res['checkbox39'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox40" value="1" <?php if ($check_res['checkbox40'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Sexually transmitted disese</b>
        <p><input type="checkbox" name="checkbox41" value="1" <?php if ($check_res['checkbox41'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox42" value="1" <?php if ($check_res['checkbox42'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	HIV</b>
        <p><input type="checkbox" name="checkbox40" value="1" <?php if ($check_res['checkbox40'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox41" value="1" <?php if ($check_res['checkbox41'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th style="border:1px solid black;">
        <b>Mono</b>
        <p><input type="checkbox" name="checkbox42" value="1" <?php if ($check_res['checkbox42'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox43" value="1" <?php if ($check_res['checkbox43'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Copo</b>
        <p><input type="checkbox" name="checkbox44" value="1" <?php if ($check_res['checkbox44'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox45" value="1" <?php if ($check_res['checkbox45'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    <th style="border:1px solid black;">
        <b>	Arthritis</b>
        <p><input type="checkbox" name="checkbox46" value="1" <?php if ($check_res['checkbox46'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;P<br></p>
        </th>
        <p><input type="checkbox" name="checkbox47" value="1" <?php if ($check_res['checkbox47'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;F<br></p>
    </th>
    </tr>
    <tr>
        <th>
            <b>Other medical issues:</b>
            <p><?php echo text($check_res['input53']); ?></p>
        </th>
    </tr>
</table>
<table style="border:1px solid black;">
       <tr>
           <th><label for="">SURGICAL HISTORY</label>
             <b>Have you ever had surgery in the past?</b>
             <th style="border:1px solid black;">
        <b>	Arthritis</b>
        <p><input type="checkbox" name="checkbox49" value="1" <?php if ($check_res['checkbox48'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;YES<br></p>
        </th>
        <p><input type="checkbox" name="checkbox38" value="1" <?php if ($check_res['checkbox59'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;NO<br></p>
           </th>
       </tr>
</table>
  <table style="border:1px solid black;">
          <tr>
              <th style="border:1px solid black;">
                 <b>Surgical Procedure(s):</b>
              </th>
              <th><p><?php echo text($check_res['input54']); ?></p></th>
              <th><p><?php echo text($check_res['input55']); ?></p></th>
              <th>
                  <b>Year</b>
                  <th><p><?php echo text($check_res['input56']); ?></p></th>
                  <th><p><?php echo text($check_res['input57']); ?></p></th>
              </th>
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