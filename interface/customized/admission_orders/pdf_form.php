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
$data = array();
$provider = $_SESSION['authUserID'];

$sql = "SELECT * FROM form_admission_orders WHERE id = $formid AND pid = $pid";
//echo $sql;exit();

$res = sqlStatement($sql);
$data = sqlFetchArray($res);

//  echo $sql;

$check_res = $formid ? $check_res : array();

// $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
// print_r($filename);die;
use OpenEMR\Core\Header;

$mpdf = new mPDF('', '', '', '', 8, 10, 10, 10, 5, 10, 4, 10);
?>
<style>
</style>

<body id='body' class='body'>
    <?php
    $header = "<div class='row' style='line-height:1px;' >
   
</div>";

    ob_start();

    ?>
    <table style="width:100%;">
        <tr>
            <td style="width:100%;text-align:center;">
                <h2> <b>Center for Network Therapy</b> </h2>
                <h3> <b>81 Northfield Avenue, West Orange, NJ 07052</b> </h3>
                <h3> <b>973-731-1375</b> </h3>
            </td>
        </tr>
    </table>
    <br />
    <table style="width:100%;">
        <tr>
            <td style="width:100%;text-align:center;">
                <h3> <b>Admission Orders</b> </h3>
            </td>
        </tr>
    </table>
    <br />
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;border-collapse:collapse;text-align:center;">
        <tr>
            <td style="width:100%;text-align:center;background-color:black;color:white;">
                <h3> <b> Patient Information</b> </h3>
            </td>
        </tr>
    </table>
    <table style="width:100%;margin-top:-2px;border:1px solid black;border-collapse:collapse;">
        <tr>
            <td style="border:1px solid black;">
                <label><b>Patient Name:</b> <?php echo xlt($data['patient']); ?></label>
            </td>
            <td style="border:1px solid black;">
                <label><b>DOB:</b> <?php echo xlt($data['dob']); ?></label>
            </td>
            <td style="border:1px solid black;">
                <label><b>Allergies:</b> <?php echo xlt($data['allergy']); ?></label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><b>Height :</b> <?php echo xlt($data['height']); ?></label>

            </td>
            <td style="border:1px solid black;">
                <label><b>Weight :</b> <?php echo xlt($data['weight']); ?></label>

            </td>
            <td style="border:1px solid black;">
                <label><b>Vitals :</b></label>
                <input type=checkbox name='check1' value="" <?php if ($data["check1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Q Shift
                <input type=checkbox name='check2' value="" <?php if ($data["check2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> BID
                <input type=checkbox name='check3' value="" <?php if ($data["check3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other : <?php echo xlt($data['othertext']); ?>
            </td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;border-collapse:collapse;">
        <tr>
            <td style="width:100%;text-align:center;background-color:black;color:white;">
                <h3> <b> Admit to Chemical Dependency</b> </h3>
            </td>
        </tr>
        <tr>
            <td style="width:100%;border:1px solid black;">
                <label><?php echo xlt($data['adtext1']); ?>
            </td>
        </tr>
        <tr>
            <td style="width:100%;border:1px solid black;">
                <label><?php echo xlt($data['adtext2']); ?>

            </td>
        </tr>
        <tr>
            <td style="width:100%;border:1px solid black;">
                <label><?php echo xlt($data['adtext3']); ?>

            </td>
        </tr>
        <tr>
            <td style="width:100%;border:1px solid black;">
                <label><?php echo xlt($data['adtext4']); ?>

            </td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;border-collapse:collapse;text-align:center;">
        <tr>
            <td style="width:100%;text-align:center;background-color:black;color:white;">
                <h3> <b>Medications</b> </h3>
            </td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border-collapse:collapse;">
        <tr>
            <td style="border:1px solid black;">
                <label>1. Thiamine 100 MG PO Now and Daily</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check4' value="" <?php if ($data["check4"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check5' value="" <?php if ($data["check5"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>2. Folate 1MG PO Now and Daily:</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check6' value="" <?php if ($data["check6"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check7' value="" <?php if ($data["check7"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>3. Motrin 600 MG PO Q 4 Hours, PRN Discomfort</label><br /><label class="ml-5"> Max 4 doses per 24hrs</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check8' value="" <?php if ($data["check8"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check9' value="" <?php if ($data["check9"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>4. Tylenol 500 MG PO Q 4 Hours, PRN Headache/Fever (more than 101F)</label><br /> <label>Max 4 doses per 24 hours</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check10' value="" <?php if ($data["check10"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label>
                    <input type=checkbox name='check11' value="" <?php if ($data["check11"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No
                </label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label> 5. Maalox 30 ML PO Q 1 Hour, PRN GI Distress</label><br /><label class="ml-5"> Max 8 doses per 24 hours</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check12' value="" <?php if ($data["check12"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label>
                    <input type=checkbox name='check13' value="" <?php if ($data["check13"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No
                </label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label> 6. Robaxin 500 MG PO Q 4 Hours, PRN Muscle Spasm</label><br /><label class="ml-5"> Max 3 in 24 hours</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check14' value="" <?php if ($data["check14"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check15' value="" <?php if ($data["check15"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>7. Hydroxyzine Pamoate (Vistaril) 50 MG PO Q 4 hours PRN Anxiety</label><br /><label class="ml-5">Max 3 doses in 24 hours <b>for patients < 30 yrs</b></label><br /><label class="ml-5">Max 2 doses per 24 hours <b>for patients 30-50 years old</b></label><br /><label class="ml-5">Max 1 dose per 24 hours <b>for adults > 50 yrs</b> x 10 days</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check16' value="" <?php if ($data["check16"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check17' value="" <?php if ($data["check17"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>8. Imodium 2 MG PO Q 2 hours, PRN Diarrhea</label><br /><label class="ml-5">Max 4 doses per 24 hours</label>
            </td>
            <td style="border:1px solid black;">
                <label> <input type=checkbox name='check18' value="" <?php if ($data["check18"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> Yes</label>
                <label> <input type=checkbox name='check19' value="" <?php if ($data["check19"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label> 9. MOM 30 ML PO BID x 3 Days, PRN Constipation</label>
            </td>
            <td style="border:1px solid black;">
                <label> <input type=checkbox name='check20' value="" <?php if ($data["check20"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> Yes</label>
                <label><input type=checkbox name='check21' value="" <?php if ($data["check21"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label> 10. Dulcolax 10 MG PO BID x 3 Days PRN constipation if MOM doesn’t work</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check22' value="" <?php if ($data["check22"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check23' value="" <?php if ($data["check23"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>11. Tigan 300 MG PO Q 6 Hours, PRN for Nausea (Max 4 doses per 24 hrs x 10 days
                </label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check24' value="" <?php if ($data["check24"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check25' value="" <?php if ($data["check25"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>12. Tigan 200 MG IM Q 6 Hours, PRN for Vomiting
                </label><br><label class="ml-5">Max 4 doses per 24 hours x 10 days</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check26' value="" <?php if ($data["check26"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check27' value="" <?php if ($data["check27"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>13. Zofran ODT 8 MG PO Q 8 hours
                </label><br><label class="ml-5">Max 2 doses in 24 hours for refractory to Tigan</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check28' value="" <?php if ($data["check28"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check29' value="" <?php if ($data["check29"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>14. Keppra 500 PO Now and then BID</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check30' value="" <?php if ($data["check30"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check31' value="" <?php if ($data["check31"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>15. Thiamine 100 MG IM once a day x 3 days for Wernicke’s Syndrome</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check32' value="" <?php if ($data["check32"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label>
                    <input type=checkbox name='check33' value="" <?php if ($data["check33"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No
                </label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label> 16. Ativan 1 MG IM x 1 dose PRN Anxiety or Severe Withdraw</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check34' value="" <?php if ($data["check34"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check35' value="" <?php if ($data["check35"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label> 17. Benadryl 50 MG IM x 1 dose PRN Allergic Reaction</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check36' value="" <?php if ($data["check36"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check37' value="" <?php if ($data["check37"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label> 18. Alcohol and Drug Detox Program</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check38' value="" <?php if ($data["check38"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check39' value="" <?php if ($data["check39"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>19. Tuberculin Test</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check40' value="" <?php if ($data["check40"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check41' value="" <?php if ($data["check41"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>20. RPR Test</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check42' value="" <?php if ($data["check42"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check43' value="" <?php if ($data["check43"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>21. Comprehensive Metabolic Panel</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check44' value="" <?php if ($data["check44"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check45' value="" <?php if ($data["check45"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>22. Hepatic function panel</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check46' value="" <?php if ($data["check46"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check47' value="" <?php if ($data["check47"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>23. Lipid profile</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check48' value="" <?php if ($data["check48"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check49' value="" <?php if ($data["check49"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>24. Thyroid profile</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check50' value="" <?php if ($data["check50"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check51' value="" <?php if ($data["check51"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label>25. Hepatitis panel</label>
            </td>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='check52' value="" <?php if ($data["check52"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> Yes</label>
                <label><input type=checkbox name='check53' value="" <?php if ($data["check53"] == "0") {
                                                                        echo "checked='checked'";
                                                                    } else {
                                                                        echo '';
                                                                    } ?>> No</label>
            </td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">
        <tr>
            <td>RN Signature : <img src='data:image/png;base64,<?php echo xlt($data['rnsign']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['rndate']); ?></td>
            <td>Time: <?php echo xlt($data['rntime']); ?></td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">

        <tr style="border:1px solid black;">
            <td>Physician Signature : <img src='data:image/png;base64,<?php echo xlt($data['physign']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['phydate']); ?></td>
            <td>Time: <?php echo xlt($data['phytime']); ?></td>
        </tr>
    </table>
    <br />
    <br />
    <table style="width:100%;margin-top:-2px;border:1px solid black;border-collapse:collapse;">
        <tr>
            <td style="border:1px solid black;">
                <label><b>Patient Name:</b> <?php echo xlt($data['patient']); ?></label>
            </td>
            <td style="border:1px solid black;">
                <label><b>DOB:</b> <?php echo xlt($data['dob']); ?></label>
            </td>

        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><b>Allergies:</b> <?php echo xlt($data['allergy']); ?></label>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <table style="width:100%;table-layout:fixed;display:table;border-collapse:collapse">
        <tr>
            <td style="text-align:center;border:1px solid black;background-color:black;color:white;">
                <h3>Physicians Orders</h3>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid black;">
                <h3><b>For Alcohol (liver impaired) Withdrawal and/ or Benzodiazepine Withdrawal</b></h3>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid black;">
                <h3><b>IMPLEMENT ATIVAN WITHDRAWAL PROTOCOL</b></h3>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='phycheck1' value="" <?php if ($data["phycheck1"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>><b>Ativan Withdrawal Protocol A :</b></label><br />
                <br /><label class="ml-5">Vital signs 4x daily</label>
                <br />
                <br /><br /><label class="ml-5">Ativan 2 mg PO TID on admission day<br />
                    Ativan 2 mg PO BID and 1mg PO at 12:30pm on day #2<br />
                    Ativan 2 mg PO BID on day #3<br />
                    Ativan 1 mg PO BID on day #4<br />
                    Ativan 1 mg PO in AM on day #5
                </label>
                <br /><br /><label class="ml-5">Ativan 1 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 4 doses in 24 hours.</label>
                <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='phycheck2' value="" <?php if ($data["phycheck2"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">Ativan Withdrawal Protocol B :</b></label><br />
                <br /><label class="ml-5">Vital signs 4x daily</label>
                <br />
                <br /><br /><label class="ml-5">Ativan 1mg PO BID and 2mg at 12:30pm on day of admission<br />
                    Ativan 1mg PO TID on day #2<br />
                    Ativan 1 mg PO BID on day #3<br />
                    Ativan 1 mg PO in AM on day #4

                </label>
                <br /><br /><label class="ml-5">Ativan 1 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 4 doses in 24 hours.</label>
                <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='phycheck3' value="" <?php if ($data["phycheck3"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">Ativan Withdrawal Protocol C :</b></label><br />
                <br /><label class="ml-5">Vital signs 4x daily</label>

                <br /><br /><label class="ml-5">Ativan¬ 1 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 8 doses in 24 hours.</label>
                <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
            </td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">
        <tr>
            <td>RN Signature : <img src='data:image/png;base64,<?php echo xlt($data['rnsign1']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['rndate1']); ?></td>
            <td>Time: <?php echo xlt($data['rntime1']); ?></td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">

        <tr style="border:1px solid black;">
            <td>Physician Signature : <img src='data:image/png;base64,<?php echo xlt($data['physign1']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['phydate1']); ?></td>
            <td>Time: <?php echo xlt($data['phytime1']); ?></td>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <table style="width:100%;margin-top:-2px;border:1px solid black;border-collapse:collapse;">
        <tr>
            <td style="border:1px solid black;">
                <label><b>Patient Name:</b> <?php echo xlt($data['patient']); ?></label>
            </td>
            <td style="border:1px solid black;">
                <label><b>DOB:</b> <?php echo xlt($data['dob']); ?></label>
            </td>

        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><b>Allergies:</b> <?php echo xlt($data['allergy']); ?></label>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <table style="width:100%;table-layout:fixed;display:table;border-collapse:collapse">
        <tr>
            <td style="text-align:center;border:1px solid black;background-color:black;color:white;">
                <h3>Physicians Orders</h3>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid black;">
                <h3><b>For Opioid Withdrawal</b></h3>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid black;">
                <h3><b>IMPLEMENT CLONIDINE WITHDRAWAL PROTOCOL</b></h3>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='clocheck1' value="" <?php if ($data["clocheck1"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>><b class="ml-3 protocol">Clonidine Withdrawal Protocol A :</b></label><br />
                <br /><label class="ml-5">Vital signs 4x daily</label>
                <br />
                <br /><br /><label class="ml-5">Clonidine <?php echo xlt($data['clotext1']); ?> mg PO TID on admission day<br /><br />
                    Clonidine <?php echo xlt($data['clotext2']); ?> mg PO TID on day #2<br /><br />
                    Clonidine <?php echo text($data['clotext3']); ?> mg PO BID on day #3<br /><br />
                    Clonidine <?php echo text($data['clotext4']); ?> mg PO in AM on day #4

                </label>
                <br /><br /><label class="ml-5">Clonidine <?php echo xlt($data['clotext5']); ?> mg PO Q2 hours PRN signs/symptoms of opiate withdrawal
                    (i.e. abdominal/muscle cramping, nausea, vomiting, diarrhea, lacrimation, rhinorrhea, joint pain), or one of the following: Pulse >95, SBP >140, DBP >95.
                    Maximum 10 doses in 24 hours.
                </label>

            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='clocheck2' value="" <?php if ($data["clocheck2"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">Clonidine Withdrawal Protocol B :</b></label><br />
                <br /><label class="ml-5">Vital signs 4x daily</label>

                <br /><br /><label class="ml-5">Clonidine 0.05 mg PO Q2 hour PRN signs/symptoms of opiate withdrawal
                    (i.e. abdominal/muscle cramping, nausea, vomiting, diarrhea, lacrimation, rhinorrhea, joint pain), or one of the following: Pulse >95, SBP >140, DBP >95.
                    Maximum 10 doses in 24 hours.
                </label>
                <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
            </td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">
        <tr>
            <td>RN Signature : <img src='data:image/png;base64,<?php echo xlt($data['rnsign2']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['rndate2']); ?></td>
            <td>Time: <?php echo xlt($data['rntime2']); ?></td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">

        <tr style="border:1px solid black;">
            <td>Physician Signature : <img src='data:image/png;base64,<?php echo xlt($data['physign2']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['phydate2']); ?></td>
            <td>Time: <?php echo xlt($data['phytime2']); ?></td>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <table style="width:100%;margin-top:-2px;border:1px solid black;border-collapse:collapse;">
        <tr>
            <td style="border:1px solid black;">
                <label><b>Patient Name:</b> <?php echo xlt($data['patient']); ?></label>
            </td>
            <td style="border:1px solid black;">
                <label><b>DOB:</b> <?php echo xlt($data['dob']); ?></label>
            </td>

        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><b>Allergies:</b> <?php echo xlt($data['allergy']); ?></label>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <table style="width:100%;table-layout:fixed;display:table;border-collapse:collapse">
        <tr>
            <td style="text-align:center;border:1px solid black;background-color:black;color:white;">
                <h3>Physicians Orders</h3>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid black;">
                <h3><b>For Alcohol and/or Benzodiazepine Withdrawal</b></h3>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid black;">
                <h3><b>IMPLEMENT LIBRIUM WITHDRAWAL PROTOCOL:</b></h3>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='libcheck1' value="" <?php if ($data["libcheck1"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">Librium Withdrawal Protocol A :</b></label><br />
                <br /><label class="ml-5">Vital Signs and CIWA-AR 4x daily</label>
                <br />
                <br /><br /><label class="ml-5">Librium 25 mg PO BID and 50mg at 12:30pm on admission day<br />
                    Librium 25 mg PO TID on day #2<br />
                    Librium 25 mg PO BID on day #3<br />
                    Librium 25 mg PO BID on day #4<br />
                    Librium 25 mg PO in AM on day #5

                </label>
                <br /><br /><label class="ml-5">Libirum 10 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 10 doses in 24 hours.</label>
                <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                        <br /><br /><label class="ml-5">Notify physician if T >100 F or if CIWA-AR score >28.</label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='libcheck2' value="" <?php if ($data["libcheck2"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">Librium Withdrawal Protocol B :</b></label><br />
                <br /><label class="ml-5">Vital Signs and CIWA-AR 4x daily</label>
                <br />
                <br /><br /><label class="ml-5">Librium 10 mg PO BID and 20mg at 12:30pm on day #1<br />
                    Librium 10 mg PO TID on day #2<br />
                    Librium 10 mg PO BID on day #3<br />
                    Librium 10 mg PO BID on day #4<br />
                    Librium 10mg PO in AM on day #5


                </label>
                <br /><br /><label class="ml-5">Libirum 10 mg PO Q2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 10 doses in 24 hours.</label>
                <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                        <br /><br /><label class="ml-5">Notify physician if T >100 F or if CIWA-AR score >28.</label>

            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='libcheck3' value="" <?php if ($data["libcheck3"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">Librium Withdrawal Protocol C :</b></label><br />
                <br /><label class="ml-5">Vital Signs and CIWA-AR 4x daily</label>

                <br /><br /><label class="ml-5">Libirum 10 mg PO Q 2 hours PRN signs/symptoms of alcohol withdrawal (CIWA-Ar or B score > 28) or one of the following: Pulse >95, SBP >140, DBP >95. Maximum 10 doses in 24 hours.</label>
                <br /><br /><label class="ml-5">Hold for SBP <90, DBP <60, or P <60.</label>
                        <br /><br /><label class="ml-5">Notify physician if T >100 F or if CIWA-AR score >28.</label>
            </td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">
        <tr>
            <td>RN Signature : <img src='data:image/png;base64,<?php echo xlt($data['rnsign3']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['rndate3']); ?></td>
            <td>Time: <?php echo xlt($data['rntime3']); ?></td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">

        <tr style="border:1px solid black;">
            <td>Physician Signature : <img src='data:image/png;base64,<?php echo xlt($data['physign3']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['phydate3']); ?></td>
            <td>Time: <?php echo xlt($data['phytime3']); ?></td>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <table style="width:100%;margin-top:-2px;border:1px solid black;border-collapse:collapse;">
        <tr>
            <td style="border:1px solid black;">
                <label><b>Patient Name:</b> <?php echo xlt($data['patient']); ?></label>
            </td>
            <td style="border:1px solid black;">
                <label><b>DOB:</b> <?php echo xlt($data['dob']); ?></label>
            </td>

        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><b>Allergies:</b> <?php echo xlt($data['allergy']); ?></label>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <table style="width:100%;table-layout:fixed;display:table;border-collapse:collapse">
        <tr>
            <td style="text-align:center;border:1px solid black;background-color:black;color:white;">
                <h3>Physicians Orders</h3>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid black;">
                <h4><b>For Opiate Withdrawal (Heroin, Oxycontin, Oxycodone, Roxicodone, etc.)</b></h4>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid black;">
                <h4><b>IMPLEMENT SUBOXONE DETOXIFICATION PROTOCOL</b></h4>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='subcheck1' value="" <?php if ($data["subcheck1"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">SUBOXONE TAPER/HEROIN/OTHER OPIOIDS - Custom Taper</b></label><br />
                <br /><label class="ml-5">Suboxone 4 mg SL film BID and 8mg SL at 12:30pm on day of Admission<br /><br />Day 2 Suboxone 4 mg SL film BID and 6 mg SL at 1230<br /><br />Day 3 Suboxone 4 mg SL film TID

                    <br /><br />Day 4 Suboxone 4 mg SL film BID and 2 mg SL at noon

                    <br /><br />Day 5 Suboxone 4 mg SL film BID

                    <br /><br />Day 6 Suboxone 2 mg SL film in AM and 4 mg SL PM

                    <br /><br /> Day 7 Suboxone 2 mg SL film BID

                    <br /><br /> Day 8 Suboxone 2 mg SL film in AM
                </label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='subcheck2' value="" <?php if ($data["subcheck2"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">SUBOXONE TAPER/HEROIN/OTHER OPIOIDS 6 days</b></label><br />
                <br /><label class="ml-5">Suboxone 4 mg SL film BID on day of Admission<br /><br />

                    Day 2 Suboxone 4 mg SL film 1st dose and 2 mg SL film 2nd dose<br /><br />

                    Day 3 Suboxone 4 mg SL film 1st dose and 2 mg SL film 2nd dose<br /><br />

                    Day 4 Suboxone 2 mg SL film BID<br /><br />

                    Day 5 Suboxone 2 mg SL film once a day<br /><br />

                    Day 6 Suboxone 2 mg SL film once a day
                </label>

            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='subcheck3' value="" <?php if ($data["subcheck3"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">SUBOXONE TAPER/HEROIN/OTHER OPIOIDS 5 Days</b></label><br />
                <br /><label class="ml-5"> Suboxone 4 mg SL film TID on day of Admission<br /><br />

                    Day 2 Suboxone 4 mg SL film BID<br /><br />

                    Day 3 Suboxone 4 mg SL film 1st dose and 2 mg SL film 2nd dose<br /><br />

                    Day 4 Suboxone 2 mg SL film BID<br /><br />

                    Day 5 Suboxone 2 mg SL film once a day
                </label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid black;">
                <label><input type=checkbox name='subcheck4' value="" <?php if ($data["subcheck4"] == "0") {
                                                                            echo "checked='checked'";
                                                                        } else {
                                                                            echo '';
                                                                        } ?>> <b class="ml-3 protocol">SUBOXONE TAPER/HEROIN/OTHER OPIOIDS 4 Days</b></label><br />
                <br /><label class="ml-5"> Suboxone 4 mg SL film BID on day of Admission<br /><br />

                    Day 2 Suboxone 4 mg SL film 1st dose and 2 mg SL film 2nd dose<br /><br />

                    Day 3 Suboxone 2 mg SL film BID<br /><br />

                    Day 4 Suboxone 2 mg SL film once a day

                </label>
            </td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">
        <tr>
            <td>RN Signature : <img src='data:image/png;base64,<?php echo xlt($data['rnsign4']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['rndate4']); ?></td>
            <td>Time: <?php echo xlt($data['rntime4']); ?></td>
        </tr>
    </table>
    <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;">

        <tr style="border:1px solid black;">
            <td>Physician Signature : <img src='data:image/png;base64,<?php echo xlt($data['physign4']); ?>' width='100px' height='50px'></td>
            <td>Date : <?php echo xlt($data['phydate4']); ?></td>
            <td>Time: <?php echo xlt($data['phytime4']); ?></td>
        </tr>
    </table>
    <?php
    ?>
    <?php
    $footer = "<table>
<tr>

<td style='width:45% font-size:10px align:right'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

    //$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

    $body = ob_get_contents();
    ob_end_clean();
    $mpdf->setTitle("Clonidine Protocol B");
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

    $mpdf->Output('Clonidine Protocol B.pdf', 'I');
    // header("Location:../../patient_file/encounter/forms.php");
    //         //out put in browser below output function
    $mpdf->Output();
    ?>