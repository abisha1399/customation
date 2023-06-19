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

    $sql = "SELECT * FROM `form_follow` WHERE id = ? AND pid = ?";
   
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
ob_start();
?>
<body>

<h4 style="text-align:center;">CENTRE FOR NETWORK THERAPHY<BR>20 Gibson Palace,Suite 103<br>Freehold,NJ 07728<BR>732-431-5800</h4><br><br>

<h4 style="text-align:center;">FOLLOW UP FORM</h4><br><br>

<table style="width:100%;border:1px solid black;padding:20px;">
    <tr>
    <td  style="width:30%"> 
            <label style="font-size: 14px;">Treatment:<span  style="color:red "> <?php echo text($check_res['comment1']); ?></span></label>

</td>

<td  style="width:30%"> 
            <label style="font-size: 14px;">Physician:<span  style="color:red "> <?php echo text($check_res['comment2']); ?></span></label>

</td>
<td  style="width:30%"> 
            <label style="font-size: 14px;">Anger Management:<span  style="color:red "> <?php echo text($check_res['comment3']); ?></span></label>

</td>

   
    </tr>
</table>
    <table style="width:100%;border:1px solid black;padding:20px;">

    <tr>

    <td  style="width:30%"> 
            <label style="font-size: 14px;">Clinical Name:<span  style="color:red "> <?php echo text($check_res['name1']); ?></span></label>

</td>

<td  style="width:30%"> 
            <label style="font-size: 14px;">Signature:<span  style="color:red ">
            <?php if($check_res['sign1']){?>
            <img src='data:image/png;base64,<?php echo xlt($check_res['sign1']); ?>' width='100px' height='50px'/> 
            <?php }?>
        </span></label>

</td>

<td  style="width:30%"> 
            <label style="font-size: 14px;">Date:<span  style="color:red "> <?php echo text($check_res['date1']); ?></span></label>

</td>

    </tr>
</table>
    <table style="width:100%;border:1px solid black;padding:20px;">

    <tr>
    <td  style="width:100%"> 
            <label style="font-size: 14px;">Nursing Discharge Note:<span  style="color:red "> <?php echo text($check_res['comment4']); ?></span></label>

</td>
</tr>
</table>
<table style="width:100%;border:1px solid black;padding:20px;">

<tr>
    <td  style="width:30%"> 
            <label style="font-size: 14px;">Medication:<span  style="color:red "> <?php echo text($check_res['comment5']); ?></span></label>

</td>

<td  style="width:30%"> 
            <label style="font-size: 14px;">Dose:<span  style="color:red "> <?php echo text($check_res['comment6']); ?></span></label>

</td>
<td  style="width:30%"> 
            <label style="font-size: 14px;">Indication:<span  style="color:red "> <?php echo text($check_res['comment7']); ?></span></label>

</td>

   
    </tr>
</table>
    <table style="width:100%;border:1px solid black;padding:20px;">

    <tr>
    <td  style="width:30%"> 
            <label style="font-size: 14px;">Nurse Name:<span  style="color:red "> <?php echo text($check_res['name2']); ?></span></label>

</td>

<td  style="width:30%"> 
            <label style="font-size: 14px;">Signature:<span  style="color:red ">
            <?php if($check_res['sign2']){?>
            <img src='data:image/png;base64,<?php echo xlt($check_res['sign2']); ?>' width='100px' height='50px'/>
        <?php }?>
        </span></label>

</td>

<td  style="width:30%"> 
            <label style="font-size: 14px;">Date:<span  style="color:red "> <?php echo text($check_res['date2']); ?></span></label>

</td>

    </tr>
</table>
    <table style="width:100%;border:1px solid black;padding:20px;">

    <tr>
    <td  style="width:100%"> 
            <label style="font-size: 14px;">Physician Discharge Note:<span  style="color:red "> <?php echo text($check_res['comment8']); ?></span></label>

</td>
</tr>
</table>
<table style="width:100%;border:1px solid black;padding:20px;">
<tr>
    <td  style="width:30%"> 
            <label style="font-size: 14px;"> Name:<span  style="color:red "> <?php echo text($check_res['name3']); ?></span></label>

</td>

<td  style="width:30%"> 
            <label style="font-size: 14px;">Signature:<span  style="color:red "> 
            <?php if($check_res['sign3']){?>
            <img src='data:image/png;base64,<?php echo xlt($check_res['sign3']); ?>' width='100px' height='50px'/> 
            <?php }?>
        </span></label>

</td>

<td  style="width:30%"> 
            <label style="font-size: 14px;">Date:<span  style="color:red "> <?php echo text($check_res['date3']); ?></span></label>

</td>

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
$mpdf->setTitle("Follow up Form");
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

