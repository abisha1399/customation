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
$pid = $_GET["pid"];
$encounter = $_GET["encounter"];
$data =array();

    $sql = "SELECT * FROM form_medication WHERE id = $formid";
   
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);
   
  //  echo $sql;
   
    $check_res = $formid ? $check_res : array();
    // print_r($check_res);die;

   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';

use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Medication Reconciliation Form</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">
            <table style="width: 100%;">
                <tr>
                    <td><b>Medication Reconciliation Form</b></td>
                    <td><b style="text-decoration: underline;">The Center for Network Therapy</u></td>
                </tr>
                </table><br><br>
                <table style="width: 100%;">
                <tr>
                    <td>
                        Patient Name:&nbsp;&nbsp;&nbsp;<b><?php echo xlt($data['pname']);?></b><br>
                        DOB:&nbsp;&nbsp;&nbsp;<b><?php echo $data['dob'];?></b><br>
                        Allergies:&nbsp;&nbsp;&nbsp;<b><?php echo $data['allergies'];?></b><br>
                    </td>
                    <td style="border: 1px solid black;">
                        <b class="b1">Information Source:</b><br><br>
      <input type="checkbox" name="patient" value="1"
      <?php
    if ($data['patient'] == "1") {
        echo "checked='checked'";
    }

    ?>

      >&nbsp;
      <label>Patient</label>&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="caregiver" value="1"
      <?php
    if ($data['caregiver'] == "1") {
        echo "checked='checked'";
    }

    ?>
      >&nbsp;
      <label>Caregiver</label>&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="provided"  value="1"
      <?php
    if ($data['provided'] == "1") {
        echo "checked='checked'";
    }
    ?>
      >&nbsp;
      <label>Provided List</label>&nbsp;&nbsp;&nbsp;<br>
      <input type="checkbox" name="other" value="1"
      <?php
    if ($data['other'] == "1") {
        echo "checked='checked'";}
    ?>
      >&nbsp;
      <label>Other:</label>
                    </td>
                </tr><br><br>

                <tr>
                    <td><input type="checkbox" name="homemeds" value="1" <?php if ($data['homemeds'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>
                        <label>patient takes no home meds</label></td>
                </tr>


            </table><br><br>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 20%;"><b>Current Medication(Dose,route,frequency)</b></td>
                    <td style="width: 20%;"><b>Indication</b></td>
                    <td style="width: 20%;"><b>	Date/Time last dose</b></td>
                    <td style="width: 20%;"><b>	Continue</b></td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%;height: 80px;"><b><?php echo $data['txt1'];?></b></td>

                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;">
                        Nurse Signature:&nbsp;&nbsp;&nbsp;<b>
                        <?php
                        if($data['sign']!='')
                        {
                        echo '<img style="height:50px;object-fit:cover;" src='.$data['nsign'].'>';
                        }
                        ?>
                                    <!-- <?php echo $data['nsign'];?> -->
                        </td>
                    <td style="width: 50%;">Date/Time:&nbsp;&nbsp;&nbsp;<b><?php echo $data['datetime1'];?></td>

                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%;height: 80px;"><b><?php echo $data['txt2'];?></b></td>

                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;height: 80px;">
                        Physician Signature:<b>
                        <?php
                        if($data['psign']!='')
                        {
                        echo '<img style="height:50px;object-fit:cover;" src='.$data['psign'].'>';
                        }
                        ?>
                            <!-- <?php echo $data['psign'];?></b> -->
                        </td>
                    <td style="width: 50%;height: 80px;">Date/Time:<b><?php echo $data['date2'];?></b></td>

                </tr>
                <tr>
                    <td style="width: 50%;height: 80px;">Nurse Signature:
                    <?php
                        if($data['nsign2']!='')
                        {
                        echo '<img style="height:50px;object-fit:cover;" src='.$data['nsign2'].'>';
                        }
                        ?>
                    </td>
                    <td style="width: 50%;height: 80px;">Date/Time:<b><?php echo $data['date3'];?></b></td>

                </tr>
                <tr>
                    <td style="width: 50%;height: 80px;">Patient Signature:
                    <?php
                        if($data['patsign']!='')
                        {
                        echo '<img style="height:50px;object-fit:cover;" src='.$data['patsign'].'>';
                        }
                        ?>
                    <!-- <b><?php echo $data['patsign'];?></b> -->
                </td>
                    <td style="width: 50%;height: 80px;">Date/Time:<b><?php echo $data['date4'];?></b></td>

                </tr>
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
$mpdf->setTitle("Medication Reconciliation Form");
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

$mpdf->Output("Medication Reconciliation.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>
