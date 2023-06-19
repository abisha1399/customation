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

    $sql = "SELECT * FROM form_history_and_physical_evaluation WHERE id = ? AND pid = ?";

    $res = sqlStatement($sql, array($formid,$pid));
    $data = sqlFetchArray($res);

    $check_res = $formid ? $check_res : array();



use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<style>
</style>
<body id='body' class='body'>
<?php
$header ="<div class='row'style='line-height:1px;' >

</div>";

ob_start();

        ?>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;text-align:center;">
                    <h4>The Center for Network Therapy</h4>
                    <br/>
                    <p><b>20 Gibson Place, Suite 103, Freehold, NJ 07728</b></p>
                </td>
            </tr>
        </table>
        <br/>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;text-align:center;">
                    <h3>History and Physical Evaluation</h3>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:60%;">
                    <label><b>Date:</b> <?php echo xlt($data['date']); ?></label>
                </td>
                <td style="width:40%;">
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:40%;">
                    <label><b>Pt Last Name:</b> <?php echo xlt($data['lname']); ?></label>
                </td>
                <td style="width:30%;">
                    <label><b>Pt First Name:</b> <?php echo xlt($data['fname']); ?></label>
                </td>
                <td style="width:30%;">
                    <label><b>D.O.B:</b> <?php echo xlt($data['date1']); ?></label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                    <label><b>Allergies:</b> <?php echo xlt($data['allergy']); ?></label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                    <label><b>Admitting Diagnosis:</b> <?php echo xlt($data['diagnosis']); ?></label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                    <label><b>Cheif Compliant:</b> <?php echo xlt($data['compliant']); ?></label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:30%;">
                    <label><b>Vital Signs:</b>
                    <label><b>B.P:</b> <?php echo xlt($data['bp']); ?></label>
                </td>
                <td style="width:20%;">
                    <label><b>HR:</b> <?php echo xlt($data['hr']); ?></label>
                </td>
                <td style="width:10%;">
                    <label><b>RR:</b> <?php echo xlt($data['rr']); ?></label>
                </td>
                <td style="width:20%;">
                    <label><b>Temp:</b> <?php echo xlt($data['temp']); ?></label>
                </td>
                <td style="width:20%;">
                    <label><b>O2 Sat:</b> <?php echo xlt($data['sat']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 12px;width:100%;border:1px solid black;border-collapse:collapse;text-align:center;">
            <tr>
                <td style="width:20%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>SYSTEM</b></label>
                </td>
                <td style="width:20%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Ok</b></label>
                </td>
                <td style="width:30%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>PROBLEMS FOUND</b></label>
                </td>
                <td style="width:30%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Problem found? Action Taken/ TX</b></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Eyes</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok1']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob1']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action1']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Ears</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok2']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob2']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action2']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Teeth, throat, Mouth</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok3']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob3']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action3']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Cardiovascular</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok4']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob4']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action4']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Digestive</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok5']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob5']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action5']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Endocrine</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok6']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob6']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action6']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Genitalia</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok7']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob7']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action7']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <br/>
        <table style="margin-top: 12px;width:100%;border:1px solid black;border-collapse:collapse;text-align:center;">
            <tr>
                <td style="width:20%;border: 1px solid black;border-collapse:collapse;">
                    <label><b>Hemic-Lymph</b></label>
                </td>
                <td style="width:20%;border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok8']); ?></label>
                </td>
                <td style="width:30%;border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob8']); ?></label>
                </td>
                <td style="width:30%;border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action8']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Integumental</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok9']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob9']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action9']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>MusculoSkeletal</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok10']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob10']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action10']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Nervous</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok11']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob11']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action11']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Respiratory</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok12']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob12']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action12']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Urinary</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok13']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob13']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action13']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Psychiatric</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok14']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob14']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action14']); ?></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>Drug Sensitivity</b></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['ok15']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['prob15']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['action15']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <table style="margin-top: 12px;width:100%;border:1px solid black;border-collapse:collapse;">
            <tr>
                <td style="width:70%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Cranical Nerves: (check appropriate response)</b></label>
                </td>
                <td style="width:15%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Intact</b></label>
                </td>
                <td style="width:15%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Not Intact</b></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>I.</b> By Identification of Known Substance.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check1' value="" <?php if($data["check1"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check2' value="" <?php if($data["check2"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>II.</b>By distinguishing movements in the peripheral visual fields.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check3' value="" <?php if($data["check3"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check4' value="" <?php if($data["check4"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>III. IV. VI.</b> By demonstrating ocular muscle movements.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check5' value="" <?php if($data["check5"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check6' value="" <?php if($data["check6"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>V.</b> By distinguishing sensation throughout the trigeminal nerve distribution.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check7' value="" <?php if($data["check7"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check8' value="" <?php if($data["check8"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>VII.</b> By demonstrating facial muscles of expression.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check9' value="" <?php if($data["check9"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check10' value="" <?php if($data["check10"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>VIII.</b> By demonstrating bilateral hearing.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check11' value="" <?php if($data["check11"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check12' value="" <?php if($data["check12"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>IX.</b> By demonstrating a gag reflex.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check13' value="" <?php if($data["check13"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check14' value="" <?php if($data["check14"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>X.</b> By phonating guttural sounds.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check15' value="" <?php if($data["check15"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check16' value="" <?php if($data["check16"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>XI.</b> By demonstrating bilaterally symmetrical shoulder shrug.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check17' value="" <?php if($data["check17"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check18' value="" <?php if($data["check18"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><b>XII.</b> By protruding the tongue without fasciculation.</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check19' value="" <?php if($data["check19"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;text-align:center;">
                    <label><input type=checkbox name='check20' value="" <?php if($data["check20"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>></label>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;text-align:center;">
                    <h4>Treatment Plan</h4>
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;">
                <label><input type=checkbox name='check21' value="" <?php if($data["check21"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>>Med regimen/ Protocol</label>
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;">
                <label><input type=checkbox name='check22' value="" <?php if($data["check22"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>>Initial Labs/ PPD</label>
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;">
                <label><input type=checkbox name='check23' value="" <?php if($data["check23"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>>Encourage Hydration</label>
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;">
                <label><input type=checkbox name='check24' value="" <?php if($data["check24"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>>Partial Care/ I.O.P/ MAT/ Therapist/  Psychiartist/ P.C.P follow up as needed</label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;">
                <label>
                    <input type=checkbox name='check25' value="" <?php if($data["check25"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>>Yes
                   <input type=checkbox name='check26' value="" <?php if($data["check26"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>>No
                  - I have reviewed the Nursing Assessment and I have addressed the significant findings.
                  </label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;">
                <label><b>Name of physician Performing H&P:</b></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:40%;">
                    <label><b>Signature:</b>
                     <?php
                     if($data['signatures']!='')
                     {
                        echo '<img src="'.$data['signatures'].'" style="width:20%;height:90px;">';
                     }
                     ?>
                    <!-- // echo xlt($data['signatures']); ?> -->
                    </label>
                </td>
                <td style="width:30%;">
                    <label><b>Date:</b> <?php echo xlt($data['date2']); ?></label>
                </td>
                <td style="width:30%;">
                    <label><b>Time:</b> <?php echo xlt($data['signtime']); ?></label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;">
                <label>
                    <input type=checkbox name='check27' value="" <?php if($data["check27"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>>Yes
                   <input type=checkbox name='check28' value="" <?php if($data["check28"] == "0") {
                    echo "checked='checked'";}else{
                    echo '';
                  }?>>No
                  - As the patients psychiatric attending, I have reviewed and agree with all the above findings.
                  </label>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:40%;">
                    <label><b>Attending Physician:</b>
                    <?php
                    if($data['atsign']!='')
                    {
                       echo '<img src="'.$data['atsign'].'" style="width:20%;height:90px;">';
                    }
                    ?> </label>
                </td>
                <td style="width:30%;">
                    <label><b>Date:</b> <?php echo xlt($data['date3']); ?></label>
                </td>
                <td style="width:30%;">
                    <label><b>Time:</b> <?php echo xlt($data['attime']); ?></label>
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
$mpdf->setTitle("History and Physical Evaluation");
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

$mpdf->Output('History and Physical Evaluation.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
