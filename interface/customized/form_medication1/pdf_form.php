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

    $sql = "SELECT * FROM `form_medication1` WHERE id = ? AND pid = ?";
   
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

<h4 style="text-align:center;">Medication Administration log</h4><br><br>

<table style="width:100%;">
<tr style="border:1px solid black">
    <td style="width:30%;">
    <label>Patient Name: <b><?php echo text($check_res['input92']);?></b>
</td>
<td style="width:30%;">
<label>DOB: <b><?php echo text($check_res['input93']);?></b>
</td>
<td style="width:30%;">
<label>Allergy: <b><?php echo text($check_res['input94']);?></b>
</td>

</tr>
</table><br><br><br>

<table class="table table-bordered" style="width:100%;border:1px solid black;">
      <thead>
    <tr style="border:1px solid black">
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Medication,Dose,<br>Frequency,Route</th>
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Hour</th>
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Date/Nurse Initials</th>
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Patient Initials</th>
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Date/Nurse Initials</th>
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Patient Initials</th>
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Date/Nurse Initials</th>
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Patient Initials</th>
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Date/Nurse Initials</th>
      <th style="width:10%;border:1px solid black;padding:50px;font-size:40px;" scope="col">Patient Initials</th>
      
    </tr>
  </thead>
  <tbody >
  <tr style="border:1px solid black">
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input1']);?></span></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input2']);?></span></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input3']);?></span></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input4']);?></span></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input5']);?></span></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input6']);?></span></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input7']);?></span></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input8']);?></span></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input9']);?></span></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><span><?php echo text($check_res['input10']);?></span></td>
</tr>
<tr style="border:1px solid black">
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input11']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input12']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input13']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input14']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input15']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input16']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input17']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input18']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input19']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input20']);?></td>

    </tr>
    <tr style="border:1px solid black">
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input21']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input22']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input23']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input24']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input25']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input26']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input27']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input28']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input29']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input30']);?></td>

    </tr>
    <tr style="border:1px solid black">
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input31']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input32']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input33']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input34']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input35']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input36']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input37']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input38']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input39']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input40']);?></td>

    </tr>
    <tr style="border:1px solid black">
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input41']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input42']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input43']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input44']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input45']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input46']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input47']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input48']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input49']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input50']);?></td>

    </tr>
    <tr style="border:1px solid black">
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input51']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input52']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input53']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input54']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input55']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input56']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input57']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input58']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input59']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input60']);?></td>

    </tr>
    <tr style="border:1px solid black">
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input61']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input62']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input63']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input64']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input65']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input66']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input67']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input68']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input69']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input70']);?></td>

    </tr>
    <tr style="border:1px solid black">
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input71']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input72']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input73']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input74']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input75']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input76']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input77']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input78']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input79']);?></td>
      <td style="width:10%;border:1px solid black;padding:50px;font-size:40px;"><?php echo text($check_res['input80']);?></td>

    </tr>

</table><br><br><br>

<table style="width:100%">
    <tr style="border:1px solid black">
      <td > Order Date:<br><b><?php echo text($check_res['input81']);?></b></td>
      <td > Parents Signature:<br>  <?php
                                    if($check_res['input82']!='')
                                    {
                                    echo '<img src="'.$check_res['input82'].'" style="width:20%;height:90px;">';
                                    }
                                     ?> </td>
      <td > Parents Initials:<br><b><?php echo text($check_res['input83']);?></b></td>
      <td > Reasons Medication not given:<br><br>
        1.Patient Refused<br>
        2.Patient Condition<br>
        3.Hold per MD order
      </td>
    </tr>
<tr style="border:1px solid black">
    <td > Nurse transcribing:<br><b><?php echo text($check_res['input84']);?></b></td>
</tr>

<tr style="border:1px solid black">
    <td > Verifying Nurse:<br><b><?php echo text($check_res['input85']);?></b></td>
    <td > Nurse Signature:<br> <?php
                                    if($check_res['input86']!='')
                                    {
                                    echo '<img src="'.$check_res['input86'].'" style="width:20%;height:90px;">';
                                    }
                                     ?> </td>
    <td > Nurse Initials:<br><b><?php echo text($check_res['input87']);?></b></td>
</tr>

<tr style="border:1px solid black">
    <td ></td>
    <td > Nurse Signature:<br> <?php
                                    if($check_res['input88']!='')
                                    {
                                    echo '<img src="'.$check_res['input88'].'" style="width:20%;height:90px;">';
                                    }
                                     ?></td>
    <td > Nurse Initials:<br><b><?php echo text($check_res['input89']);?></b></td>
</tr>

<tr style="border:1px solid black">
    <td ></td>
    <td > Nurse Signature:<br> <?php
                                    if($check_res['input90']!='')
                                    {
                                    echo '<img src="'.$check_res['input90'].'" style="width:20%;height:90px;">';
                                    }
                                     ?></td>
    <td > Nurse Initials:<br><b><?php echo text($check_res['input91']);?></b></td>
</tr>
   
</table><br><br>

</body>




<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Medication1 Form");
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

