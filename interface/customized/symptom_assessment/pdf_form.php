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

    $sql = "SELECT * FROM form_symptom_assessment WHERE id = $formid AND pid = $pid";

    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);

  //  echo $sql;

    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<style>
</style>
<body id='body' class='body'>
<?php
$header ="<div class='row' style='line-height:1px;' >
 <h4 style='text-align:center;'>Center for Network Therapy</h4>
 <p style='text-align:center;'>20 Gibson Place, Suite 103</p>
 <p style='text-align:center;'>Freehold, NJ 07728</p>
 <p style='text-align:center;'>732-431-5800</p>
</div>";

ob_start();

        ?>
                    <table style="width:100%;">
                            <tr>
                                <td style="width:100%;text-align:center;">
                                    <h4><u><b>Symptom Assessment for Pulmonary Tuberculosis (TB)</b></u></h4>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;">
                            <tr>
                                <td style="width:50%;">
                                    <label><b>Client Name:</b> <?php echo xlt($data['client']); ?></label>
                                </td>
                                <td style="width:50%;">
                                    <label><b>BirthDate:</b> <?php echo xlt($data['date']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;border:1px solid black;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Date of Symptom Assessment:</b> <?php echo xlt($data['date1']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="margin-top: 6px;width:100%;border:1px solid black;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>TB- Like Symptoms (check all that apply):<b></label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check1' value="" <?php if ($data["check1"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Productive Cough of Undiagnosed Cause (more than 3 weeks in duration)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check2' value="" <?php if ($data["check2"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Coughing up blood (Hemoptysis)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check3' value="" <?php if ($data["check3"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Unexplained Weight Loss (10 pounds or greater without dieting)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check4' value="" <?php if ($data["check4"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Night Sweats (regarding of room temparature)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check5' value="" <?php if ($data["check5"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Unexplained Loss of Appetite</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check6' value="" <?php if ($data["check6"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Very Easily Tired (Fatigability)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check7' value="" <?php if ($data["check7"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Fever</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check8' value="" <?php if ($data["check8"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Chills</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check9' value="" <?php if ($data["check9"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Chest Pain</label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;border: 1px solid black;">
                            <tr>
                                <td style="width:100%;border: 0px solid black;">
                                <label><b>Name of Licensed Md/RN:</b> <?php echo xlt($data['licens']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;border: 1px solid black;">
                            <tr>
                                <td style="width:50%;border: 0px solid black;">
                                    <label><b>Signature of Licensed Md/RN:</b>
                                    <?php
                                    if($data['stlicens']!='')
                                    {
                                        echo '<img src="'.$data['stlicens'].'" style="height:90px;width:10%;">';
                                    }
                                    ?>
                                     <!-- <?php echo xlt($data['stlicens']); ?> -->
                                    </label>
                                </td>
                                <td style="width:20%;border: 0px solid black;">
                                    <label></label>
                                </td>
                                <td style="width:30%;border: 0px solid black;">
                                    <label><b>Date:</b> <?php echo xlt($data['date2']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;border: 1px solid black;">
                            <tr>
                                <td style="width:100%;border: 0px solid black;">
                                    <label> <input type=checkbox name='check10' value="" <?php if ($data["check10"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Despite education and encourage PT declined PPD administration.</label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;border: 1px solid black;">
                            <tr>
                                <td style="width:100%;border: 0px solid black;">
                                    <label> <input type=checkbox name='check11' value="" <?php if ($data["check11"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Patient consented for PPD administration. Patient was educated about the risks and benefits associated with the PPD administration.</label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label><b>Patient Signature:</b>
                                    <?php
                                    if($data['signpt']!='')
                                    {
                                        echo '<img src="'.$data['signpt'].'" style="height:90px;width:10%;">';
                                    }
                                    ?>
                                    <!-- <?php echo xlt($data['signpt']); ?> -->
                                </label>
                                </td>
                                <td style="width:30%;">
                                    <label><b>Date:</b> <?php echo xlt($data['date3']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>If PPD RECEIVED WITHIN LAST 3 MONTHS PRIOR TO ADMISSION TO CNT, RN must contact facility where tuberculin skin testing was administrated:</b></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Facility:</b> <?php echo xlt($data['facility']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>RN spoken to:</b> <?php echo xlt($data['spoken']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Date:</b> <?php echo xlt($data['date4']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Time:</b> <?php echo xlt($data['symptime']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <label><b>Date/ Time of Mantoux Read:</b> <?php echo xlt($data['mantoux']); ?></label>
                                </td>
                                <td style="width:50%;">
                                    <label><b>Result:</b> <?php echo xlt($data['result']); ?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Signature of the Licensed RN:</b>
                                    <?php
                                    if($data['rnlicense']!='')
                                    {
                                        echo '<img src="'.$data['rnlicense'].'" style="height:90px;width:10%;">';
                                    }
                                    ?>
                                    <!-- <?php echo xlt($data['rnlicense']); ?> -->
                                </label>
                                </td>
                            </tr>
                        </table>
            <?php
        ?>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:right'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

//$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Symptom Assessment");
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

$mpdf->Output('Symptom Assessment.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
