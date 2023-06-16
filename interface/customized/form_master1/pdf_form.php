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

    $sql = "SELECT * FROM `form_master1` WHERE id = ? AND pid = ?";
   
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
            <label style="font-size: 14px;">Patient Name:<span  style="color:red "> <?php echo text($check_res['name1']); ?></span></label>

</td>
<td  style="width:30%"> 
            <label style="font-size: 14px;">DOB<span  style="color:red "> <?php echo text($check_res['date1']); ?></span></label>

</td>

   
    </tr>
</table>

<h1 style="text-align:center;">Center for Network Therapy</h1>
    <table style="width:100%;border:1px solid black;padding:20px;">

    <tr>

    <td style="width:20%;border:1px solid black;">
        <b>Diagnosis</b><br>
        <p>Substance Abuse/dependence[include withdraw risk]Ex Heroin,Opiates,Alcohol,Benzo</p>
        </td>

        <td style="width:20%;border:1px solid black;">
        <b>Target Date</b><br>
        <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;5days<br>
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;10days<br>
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;15days<br>
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;30days<br>
        <input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Others
</td>
<td style="width:20%;border:1px solid black;">
    <b>Discharge Criteria</b><br>
    <ul>
        <li>Recognize consequences of continuing substance use</li>
        <li>Receptive to continuing treatment for addition[s]</li>
        <li>Mild or free from withdraw signs and symptoms</li><br>
        <li>Other:[specify]<span  style="color:red "> <?php echo text($check_res['other']); ?></span></li>

    </ul>
</td>
<td style="width:20%;border:1px solid black;">
<b >Target Date:</b><span  style="color:red "> <?php echo text($check_res['tdate']); ?></span><br><br><br>

<b>New Target Date:</b>(state reason why?Relapse,non-compilance,<b>medical necessity</b>,etc.)
<span  style="color:red "> <?php echo text($check_res['comment1']); ?></span></li></td>


    </tr>
</table>
    

</body>




<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Master1 Form");
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

