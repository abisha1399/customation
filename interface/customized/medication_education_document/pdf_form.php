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
if ($formid) {
    $sql = "SELECT * FROM `form_medication_education_document` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$data = $formid ? $check_res : array();



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
                </td>
            </tr>
        </table>
        <br/>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;text-align:center;">
                    <h3>Medication Education Document</h3>
                </td>
            </tr>
        </table>
        <br/>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                <label><b>Patient Name:</b> <?php echo xlt($data['patient']); ?></label>
                </td>
            </tr>
        </table>
        <table style="margin-top: 6px;width:100%;">
            <tr>
                <td style="width:100%;">
                <label><b>DOB:</b> <?php echo xlt($data['date']); ?></label>
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
        <br/>
        <table style="width:100%;border:1px solid black;border-collapse:collapse;text-align:center;">
            <tr>
                <td style="width:15%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Date</b></label>
                </td>
                <td style="width:25%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Medication</b></label>
                </td>
                <td style="width:30%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Indication</b></label>
                </td>
                <td style="width:15%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Nurse Signature</b></label>
                </td>
                <td style="width:15%;border: 1px solid black;border-collapse: collapse;">
                    <label><b>Patient Signature</b></label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date1']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Suboxone (buprenorphine/naloxone)</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Opiate Withdrawal</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign1']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign1'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign1']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign1']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign1'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign1']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date2']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Subutex (buprenorphine)</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Opiate Withdrawal</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign2']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign2'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign2']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign2']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign2'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign2']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date3']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Librium</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Benzodiazephine/Alcohol Withdrawal</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign3']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign3'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign3']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign3']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign3'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign3']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date4']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Ativan</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Benzodiazephine/Alcohol Withdrawal</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign4']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign4'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign4']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign4']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign4'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign4']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date5']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Clonidine</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Anxiety/Opiate Withdrawal</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign5']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign5'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign5']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign5']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign5'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign5']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date6']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Motrin</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Pain/Discomfort</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign6']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign6'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign6']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign6']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign6'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign6']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date7']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Tylenol</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Pain/Discomfort</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign7']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign7'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign7']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign7']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign7'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign7']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date8']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Robaxin</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Muscle relaxant</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign8']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign8'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign8']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign8']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign8'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign8']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date9']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Vistaril</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Anxiety</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign9']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign9'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign9']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign9']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign9'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign9']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date10']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Thiamine</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Thiamine Deficiency</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign10']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign10'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign10']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign10']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign10'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign10']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date11']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Folate</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Folic acid Deficiency</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign11']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign11'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign11']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign11']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign11'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign11']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date12']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Maalox</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>GI Distress</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign12']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign12'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign12']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign12']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign12'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign12']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date13']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Milk of Magnesium</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Constipation</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign13']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign13'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign13']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign13']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign13'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign13']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date14']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Imodium</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Diarrhea</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign14']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign14'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign14']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign14']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign14'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign14']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date15']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Dulcolax</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Constipation</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign15']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign15'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign15']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign15']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign15'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign15']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                        <?php echo xlt($data['date16']); ?>
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Tigan</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Nausea/vomiting</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign16']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign16'].'>';
                    }
                    ?>

                        <!-- <?php echo xlt($data['nursign16']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign16']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign16'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign16']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date17']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Neurontin</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Anxiety/Neuropathic Pain/<br/>Anti-seizure</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign17']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign17'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign17']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign17']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign17'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign17']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date18']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Keppra</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Anti-seizure</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign18']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign18'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign18']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign18']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign18'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign18']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date19']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Zofran</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Nausea/vomiting</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign19']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign19'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign19']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign19']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign19'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign19']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date20']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Benadryl</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Anxiety/Sleep/Agitation/<br/>Allergies</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign20']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign20'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign20']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign20']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign20'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign20']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date21']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Valium</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Benzodiazephine/Alcohol Withdrawal</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign21']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign21'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign21']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign21']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign21'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign21']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label><?php echo xlt($data['date22']); ?></label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Bentyl</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Stomach Cramps</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign22']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign22'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign22']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign22']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign22'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign22']); ?> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                        <?php echo xlt($data['date23']); ?>
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Promethazine</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>Nausea/Vomitting</label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['nursign23']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['nursign23'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['nursign23']); ?> -->
                    </label>
                </td>
                <td style="border: 1px solid black;border-collapse:collapse;">
                    <label>
                    <?php
                    if($data['ptsign23']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['ptsign23'].'>';
                    }
                    ?>
                        <!-- <?php echo xlt($data['ptsign23']); ?> -->
                    </label>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <table style="width:100%;">
            <tr>
                <td style="width:100%;">
                    <label><b>* per each signature above, the patient was educated on the purpose and side effects of the medication *.</b></label>
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
$mpdf->setTitle("Medication Education Document");
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

$mpdf->Output('Medication Education Document.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
