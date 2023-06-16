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

    $sql = "SELECT * FROM `form_quick` WHERE id = ? AND pid = ?";
   
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

<h4 style="text-align:center;">CENTRE FOR NETWORK THERAPY<BR>20 Gibson Palace,Suite 103<br>Freehold,NJ 07728<BR>732-431-5800</h4><br><br>

<h4 style="text-align:center;">MASTER FORM</h4><br><br>

<table style="width:100%;border:1px solid black;padding:20px;">
    <tr>
    <td  style="width:30%"> 
            <label style="font-size: 14px;">Patient Name:<span  style="color:red "> <?php echo text($check_res['name0']); ?></span></label>

</td>
<td  style="width:30%"> 
            <label style="font-size: 14px;">DOB<span  style="color:red "> <?php echo text($check_res['date0']); ?></span></label>

</td>

   
    </tr>
</table><h1>

MD/RN Ouick Guide on Assessment</h1>
   
<table style="width:100%;">
    <tr>
    <td style="margin:50px;width:50%;border:1px solid black;">
<p>Does patient have access to firearms?</p>
</td>
        <td style="width:50%;border:1px solid black;">
        <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;YES
    </td>
</tr>
<tr>
<td style="margin:50px;width:50%;border:1px solid black;">
<p>If yes, was somebody contacted to safely store it away?</p>
</td>

<td style="margin:50px;width:50%;border:1px solid black;">

        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;YES<br>
    </td>
</tr>
<tr>
<td style="margin:50px;width:50%;border:1px solid black;">
<p>Does patient still have access to alcohol, opiates, benzo, etc'?</p>
</td>


<td style="margin:50px;width:50%;border:1px solid black;">

        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;YES<br>
   
</td>
</tr>
<tr>
<td style="margin:50px;width:50%;border:1px solid black;">
<p>If yes, was somebody contacted to discard of the substances?</p>
</td>


<td style="margin:50px;width:50%;border:1px solid black;">

    <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;YES<br>
      
</td>
</tr>
</table><br><br><br>


    <b>Who is picking patient up on a daily basis?</b><br><br>
<label style="font-size:14px;">Name :</label>
    <b><?php echo text($check_res['name1']);?></b><br><br>
    <label style="font-size:14px;">Relation to patient :</label>
    <b><?php echo text($check_res['rel1']);?></b><br><br>
    <label style="font-size:14px;">Phone number :</label>
    <b><?php echo text($check_res['num1']);?></b><br><br>

    <label style="font-size:14px;">Name :</label>
    <b><?php echo text($check_res['name2']);?></b><br><br>
    <label style="font-size:14px;">Relation to patient :</label>
    <b><?php echo text($check_res['rel2']);?></b><br><br>
    <label style="font-size:14px;">Phone number :</label>
    <b><?php echo text($check_res['num2']);?><br>



    


    <h1>MD end RN must be made aware if Yes is circled to any question rind DOCUMENT!!!!
</h1><br>
<br>
Does patient have PCP?    <input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;YES<br>(if no, p1euse havc clinical staff find a PCP for thc paticnt and make an appointment after detox. Appointment times are to be put on the moster tx plan at time of discharge per Dr C. <b>ALL PATIENTS MUST HAVE A PCP WHEN LEAVIN G HERE FOR DETOX)</b><br><br>

*ALL NEW PATIENT'S MUST HAVE BLOODWORK DONE THAT IS MARKED ON ORDER SHEET (UNLESS THEY REFUSE IT). PLEASE CALL THE NUMBER ON THE BOTTOM OF THE WHITE BOARD TO HAVE A PHLEBOTOMIST COME TO THE CENTER. THEY ONLY COME DURING WEEKDAYS. TF YOU HAVE ANY OUESTIONS, PLEASE CALL VICTOR. *


  

</body>




<?php
$footer ="<table>
<tr>

<td style='margin:50px;width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Quick Guide Form");
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

