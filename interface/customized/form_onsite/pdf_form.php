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

    $sql = "SELECT * FROM `form_onsite` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

    use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>


<style>
    h2{
        text-align:center;
    }    
</style>
<body id='body' class='body'>
<?php
ob_start();
?>
<body>

<h4 style="text-align:center;">CENTRE FOR NETWORK THERAPHY<BR>20 Gibson Palace,Suite 103<br>Freehold,NJ 07728<BR>732-431-5800</h4><br><br>

<h4 style="text-align:center;">ONSITE INSTANT URINE TEST FORM</h4><br><br>

<table style="width:100%;border:1px solid black;padding:20px;">
    <tr style="border:1px solid black">
    <td  style="width:30%"> 
            <label style="font-size: 14px;"><b>Patient Name: </b><?php echo text($check_res['input1']); ?>

</td>
<td  style="width:30%"> 
            <label style="font-size: 14px;"><b>DOB </b><?php echo text($check_res['input2']); ?>

</td>

   
    </tr>
    </table>
<h2 style="text-align:center;background-color:black;color:white;">12-panel Urine Results</h2>
<table style="width:100%;border:1px solid black;">
  <thead>
    <tr style="border:1px solid black">
      <th style="width:25px;border:1px solid black;padding:20px;">Substance</th>
      <th style="width:25px;border:1px solid black;padding:20px;">Positive</th>
      <th style="width:25px;border:1px solid black;padding:20px;">Negative</th>
      <th style="width:25px;border:1px solid black;padding:20px;">Faint</th>
    </tr>
  </thead>
  <tbody>
    <tr style="border:1px solid black">
      <th style="border:1px solid black;">Amphetamine</th>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;"> <?php echo text($check_res['input3']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;"> <?php echo text($check_res['input4']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;"> <?php echo text($check_res['input5']);?></td>
     


    </tr>
    <tr style="border:1px solid black">
    <th style="border:1px solid black;">Barbiturate</th>
    <td style="width:27%;border:1px solid black;padding:10px;padding:20px;"> <?php echo text($check_res['input6']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;"> <?php echo text($check_res['input7']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;"> <?php echo text($check_res['input8']);?></td>
    </tr>
    <tr style="border:1px solid black">
      <th style="border:1px solid black;">Benzodiazepines (BZO)</th>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;"> <?php echo text($check_res['input9']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input10']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input11']);?></td>
    </tr>
    <tr style="border:1px solid black">
    <th style="border:1px solid black;">Cocaine (COC)</th>
    <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input12']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input13']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input14']);?></td>
    </tr>  <tr style="border:1px solid black">
    <th style="border:1px solid black;">Opiates (OPJ / MOP)</th>
    <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input15']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input16']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input17']);?></td>
    </tr>  <tr style="border:1px solid black">
    <th style="border:1px solid black;">Methadone (MTD)</th>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input18']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input19']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input20']);?></td>

    </tr>  <tr style="border:1px solid black">
    <th style="border:1px solid black;">Methamphetamine (MET)</th>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input21']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input22']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input23']);?></td>
    </tr>  <tr style="border:1px solid black">
    <th style="border:1px solid black;">Phencyclidine (PCP)</th>
   
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input24']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input25']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input26']);?></td>

    </tr>
    <tr style="border:1px solid black">
    <th style="border:1px solid black;">Oxycodone (OXY)</th>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input27']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input28']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input29']);?></td>

    </tr>
    <tr style="border:1px solid black">
      <th style="border:1px solid black;">Buprenorphine/Suboxone (BUP)</th>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input30']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input31']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input32']);?></td>

    </tr>
    <tr style="border:1px solid black">
    <th style="border:1px solid black;">Marijuana (THC)</th>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input33']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input34']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input35']);?></td>

    </tr>
    <tr style="border:1px solid black">
      <th style="border:1px solid black;">Ecstasy (MDMA)</th>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input36']);?></td>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input37']);?>
      <td style="width:27%;border:1px solid black;padding:10px;padding:20px;">  <?php echo text($check_res['input38']);?>


    </tr>
  </tbody>
</table><br><br><br>
<h2 style="text-align:center;background-color:black;color:white;">Other</h2>
<table style="width:100%;border:1px solid">
  <tbody>
    <tr style="border:1px solid black">
      <th style="width:25px;border:1px solid black;padding:20px;">Alcohol Urine Dipstick</th>
      <td style="width:75%;border:1px solid black;padding:10px;padding:20px;"><?php echo text($check_res['input39']);?></td>

</tr>
<tr style="border:1px solid black">
      <th style="width:25px;border:1px solid black;padding:20px;">Fentanyl Urine Dipstick</th>
      <td style="width:75%;border:1px solid black;padding:10px;padding:20px;"><?php echo text($check_res['input40']);?></td>

</tr>
<tr style="border:1px solid black">
      <th style="width:25px;border:1px solid black;padding:20px;">Breathalyzer</th>
      <td style="width:75%;border:1px solid black;padding:10px;padding:20px;"><?php echo text($check_res['input41']);?></td>
</tr>
</tbody>
</table><br><br>
<table style="width:100%;border:1px solid black;">
    <tr style="border:1px solid black;padding:20px;">
    <td style="width:32%;border:1px solid black;padding:20px;"><b>Client Signature:</b><?php echo text($check_res['input42']);?></td>
    <td style="width:32%;border:1px solid black;padding:20px;"><b>Date:</b><?php echo text($check_res['input43']);?></td>
    <td style="width:32%;border:1px solid black;padding:20px;"><b>Time:</b><?php echo text($check_res['input44']);?></td>
</tr>
<tr style="border:1px solid black;padding:20px;">
    <td style="width:32%;border:1px solid black;padding:20px;"><b>Clinician Signature:</b><?php echo text($check_res['input45']);?></td>
    <td style="width:32%;border:1px solid black;padding:20px;"><b>Date:</b><?php echo text($check_res['input46']);?></td>
    <td style="width:32%;border:1px solid black;padding:20px;"><b>Time:</b><?php echo text($check_res['input47']);?></td>
</tr>
<tr style="border:1px solid black;padding:20px;">
    <td style="width:32%;border:1px solid black;padding:20px;"><b>RN Signature:</b><?php echo text($check_res['input48']);?></td>
    <td style="width:32%;border:1px solid black;padding:20px;"><b>Date:</b><?php echo text($check_res['input49']);?></td>
    <td style="width:32%;border:1px solid black;padding:20px;"><b>Time:</b><?php echo text($check_res['input50']);?></td>
</tr>
</table><br>


</body>




<?php
$footer ="<table>
<tr>

<td style='margin:50px;width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Nursing Content Form");
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

