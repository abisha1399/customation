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
$pid = $_SESSION['pid'];
$encounter = $_GET["encounter"];
$data =array();

if ($formid) {
    $sql = "SELECT * FROM form_medications WHERE id = ?";
    $res = sqlStatement($sql, array($formid));
    // $data = sqlFetchArray($res);
    // print_r($data);die;

    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
      $all[$iter] = $row;
  }
  $check_res = $all[0];
}
    $check_res = $formid ? $check_res : array();
    //print_r($check_res);die;
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>PRN Medication Monitoring</h2>
</div>";
ob_start();
 ?>
<div class="container mt-3">
 <div class="container-fluid">
    <div class="row">
        <table class="table table-bordered" style="width: 100%;border:1px solid black;height:100%">
        <thead>
    	<tr>
    		<td colspan="6" style="padding-bottom: 30px;font-size:25px"><b>Center for Network Therapy</b></td>
            <td colspan="6" style="padding-bottom: 30px;font-size:25px">Patients Name:<b><?php echo text($check_res['patient_name']); ?></b></td>
    	</tr>
    	<tr>
            <td colspan="6" style="padding-bottom: 10px;font-size:25px">20 Gibson,Suite 103<br>Freehold,NJ 07728<br/>732-431-5800</td>
            <td colspan="6" style="padding-bottom: 30px;font-size:25px">Date of Birth:<b><?php echo text($check_res['dob']); ?></b></td>
        </tr>
        <tr>
            <td  style="padding-bottom: 30px;font-size:25px"><b>PRN Medication Monitoring</b></td>
        </tr>
        <tr>
            <td colspan="12" style="padding-bottom: 10px;font-size:25px">Current Level of Discomfort:(0,1,2,3,4,5,6,7,8,9,10)</td>
        </tr>
        <tr>
            <td colspan="12" style="padding-bottom: 10px;font-size:25px">Reassessment of Discomfort:(0,1,2,3,4,5,6,7,8,9,10)</td>
        </tr>
        <tr>
            <td colspan="4" style="padding-right: 100px;font-size:25px">Medication:
            <b><?php echo text($check_res['medication']); ?></b></td>
            <td colspan="4"  style="padding-right: 100px;font-size:20px"><b>Post Comfort Level</b><br>
            <b><?php echo text($check_res['post']); ?></b></td>
            <td colspan="4"  style="padding-right: 120px;font-size:20px"><b>Med Effective</b><br/>
                <b><input type="checkbox" name="med" value="1"
                <?php 
        if($check_res['med']=="1"){
            echo "checked='checked'";
        }
        ?> >YES/<input type="checkbox" name="med" value="1"
        <?php 
        if($check_res['med']=="2"){
            echo "checked='checked'";
        }
        ?> >NO</td>
        </tr>
        <tr>
            <td  style="font-size:25px">Date/Time:<b><?php echo text($check_res['dtime']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Current Level:<b><?php echo text($check_res['current']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Withdraw s/s:<b><?php echo text($check_res['withdraw']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px;padding-bottom:10px">Nurse Signature:<?php
                                    if($check_res['nurse']!='')
                                    {
                                    echo '<img src="'.$check_res['nurse'].'" style="width:20%;height:90px;">';
                                    }
                                     ?></td>
        </tr>
        <tr>
            <td colspan="4" style="padding-right: 200px;font-size:25px">Medication:<b><?php echo text($check_res['medication1']); ?></b></td>
            <td colspan="4"  style="padding-right: 200px;font-size:25px">
            <b><?php echo text($check_res['post1']); ?></b></td>
            <td colspan="4"  style="padding-right: 120px;font-size:20px">
                <b><input type="checkbox" name="med1" value="1"
                <?php 
        if($check_res['med1']=="1"){
            echo "checked='checked'";
        }
        ?>>YES/<input type="checkbox" name="med1" value="1"
         <?php 
        if($check_res['med1']=="2"){
            echo "checked='checked'";
        }
        ?>>NO</td>
        </tr>
        <tr>
            <td  style="font-size:25px">Date/Time:<b><?php echo text($check_res['dtime1']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Current Level:<b><?php echo text($check_res['current1']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Withdraw s/s:<b><?php echo text($check_res['withdraw1']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px;padding-bottom:30px">Nurse Signature:  <?php
                                    if($check_res['nurse1']!='')
                                    {
                                    echo '<img src="'.$check_res['nurse1'].'" style="width:20%;height:90px;">';
                                    }
                                     ?></td>
        </tr>
        <tr>
            <td colspan="4" style="padding-right: 200px;font-size:25px">Medication:<b><?php echo text($check_res['medication2']); ?></b></td>
            <td colspan="4"  style="padding-right: 200px;font-size:20px">
            <b><?php echo text($check_res['post2']); ?></b></td>
            <td colspan="4"  style="padding-right: 120px;font-size:20px">
                <b><input type="checkbox" name="med2" value="1"
                <?php 
        if($check_res['med2']=="1"){
            echo "checked='checked'";
        }
        ?>>YES/<input type="checkbox" name="med2" value="1"
         <?php 
        if($check_res['med2']=="2"){
            echo "checked='checked'";
        }
        ?>>NO</td>
        </tr>
        <tr>
           <td  style="font-size:25px">Date/Time <b><?php echo text($check_res['dtime2']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Current Level:<b><?php echo text($check_res['current2']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Withdraw s/s:<b><?php echo text($check_res['withdraw2']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px;padding-bottom:10px">Nurse Signature: <?php
                                    if($check_res['nurse2']!='')
                                    {
                                    echo '<img src="'.$check_res['nurse2'].'" style="width:20%;height:90px;">';
                                    }
                                     ?></td>
        </tr>
        <tr>
            <td colspan="4" style="padding-right: 200px;font-size:25px">Medication:<b><?php echo text($check_res['medication3']); ?></b></td>
            <td colspan="4"  style="padding-right: 200px;font-size:20px">
            <b><?php echo text($check_res['post3']); ?></b></td>
            <td colspan="4"  style="padding-right: 120px;font-size:20px;padding-bottom:10px">
                <b><input type="checkbox" name="med3" value="1"
                <?php 
        if($check_res['med3']=="1"){
            echo "checked='checked'";
        }
        ?>>YES/<input type="checkbox" name="med3" value="1"
         <?php 
        if($check_res['med3']=="2"){
            echo "checked='checked'";
        }
        ?>>NO</td>
        </tr>
        <tr>
            <td  style="font-size:25px">Date/Time:<b><?php echo text($check_res['dtime3']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Current Level:<b><?php echo text($check_res['current3']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Withdraw s/s:<b><?php echo text($check_res['withdraw3']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px;padding-bottom:10px">Nurse Signature:<?php
                                    if($check_res['nurse3']!='')
                                    {
                                    echo '<img src="'.$check_res['nurse3'].'" style="width:20%;height:90px;">';
                                    }
                                     ?></td>
        </tr>
        <tr>
            <td colspan="4" style="padding-right: 200px;font-size:25px">Medication:<b><?php echo text($check_res['medication4']); ?></b></td>
            <td colspan="4"  style="padding-right: 200px;font-size:20px">
            <b><?php echo text($check_res['post4']); ?><b></td>
            <td colspan="4"  style="padding-right: 200px;font-size:20px">
                <b><input type="checkbox" name="med3" value="1"
                <?php 
        if($check_res['med4']=="1"){
            echo "checked='checked'";
        }
        ?>>YES/<input type="checkbox" name="med3" value="1"
         <?php 
        if($check_res['med4']=="2"){
            echo "checked='checked'";
        }
        ?>>NO</td>
        </tr>
        <tr>
            <td  style="font-size:25px">Date/Time:<b><?php echo text($check_res['dtime4']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Current Level:<b><?php echo text($check_res['current4']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px">Withdraw s/s:<b><?php echo text($check_res['withdraw4']); ?></b></td>
        </tr>
        <tr>
            <td style="font-size:25px;padding-bottom:10px">Nurse Signature: <?php
                                    if($check_res['nurse4']!='')
                                    {
                                    echo '<img src="'.$check_res['nurse4'].'" style="width:20%;height:90px;">';
                                    }
                                     ?></td>
        </tr>
        
    </thead>
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
$mpdf->setTitle("PRN Medication Monitoring");
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

$mpdf->Output("PRN.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>

