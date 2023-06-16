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

    $sql = "SELECT * FROM `form_safety` WHERE id = ? AND pid = ?";
   
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

<h4 style="text-align:center;">SAFETY CONSENT FORM</h4><br><br>

<label style="font-size: 14px;">I<span  style="color:red "> <?php echo text($check_res['input']); ?></span></label>(print name)consent that I do not have access to prescription medication for use other than prescribed or access to weapons,lethal medications and/or other means of self harm.<p></p><br><br>
<table style="width:100%">
    <tr>
    <td  style="width:50%"> 
            <label style="font-size: 14px;">Patient Signature:
            <?php
                if($check_res['sign1']!='')
                 {
                    echo '<img src="'.$check_res['sign1'].'" style="height:90px;width:10%;">';
                 }
                 ?>
            <!-- <span  style="color:red "> <?php echo text($check_res['sign1']); ?></span> -->
        </label>

</td>

<td  style="width:50%"> 
            <label style="font-size: 14px;">Date/Time:<span  style="color:red "> <?php echo text($check_res['date1']); ?></span></label>

</td>

   
    </tr>
    <tr>
    <td  style="width:50%"> 
            <label style="font-size: 14px;">Nurse Signature:
            <?php
                if($check_res['sign2']!='')
                 {
                    echo '<img src="'.$check_res['sign2'].'" style="height:90px;width:10%;">';
                 }
                 ?>
            <!-- <span  style="color:red "> <?php echo text($check_res['sign2']); ?></span> -->
        </label>

</td>

<td  style="width:50%"> 
            <label style="font-size: 14px;">Date/Time:<span  style="color:red "> <?php echo text($check_res['date2']); ?></span></label>

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
$mpdf->setTitle("Safety Form");
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

