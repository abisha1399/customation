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
$data =array();

    $sql = "SELECT * FROM form_daily_nursing WHERE id = $formid AND pid = $pid";
   
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
<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  
</head>
 
<body id='body' class='body'>
<?php
$header ="<div class='row' style='line-height:1px;' >
<table><tr>
 <td style='width:35%'><b>Patient</b>:".$data['patient']."</td>
<td style='width:35%'><b>DOB</b>:".$data['dob']."</td>
<td style='width:25%'><b>Date</b>:".$data['date']."</td>
<td style='width:25%'><b>Time</b>:".$data['time']."</td>
</tr></table>
</div>";

ob_start();
 
        ?>
        <!-- <hr/> -->
         <table style="width:100%;">
        <tr>
            <td style="width:100%;text-align:center;">
                <h2> <b>Center for Network Therapy</b> </h2>
                <h3> <b>81 Northfield Ave, Suite 104 West Orange, NJ 07052</b> </h3>
                <h3> <b>(973) 731-1375</b> </h3>
            </td>
        </tr>
    </table>
    <br />
        <table style="width:100%;table-layout:fixed;display:table; ">
        <tr>
                        <td style="text-align:center;">
                    <h3 class="text-center admissionord">Daily Nursing Assessment</h3>
                </td>
                    </tr>
                </table>
                <table style="width:100%;table-layout:fixed;display:table;border-collapse:collapse;">
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Monitoring For:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='check1' value="" <?php if ($data["check1"] == "0") {
                                                                echo "checked='checked'";
                } else {
                                                                echo '';
                                                            } ?>> Medication</label>
                            <label class="ml-5"></label>
                            <label class="ml-5"></label>
                            <label class="ml-5"><input type=checkbox name='check1' value="" <?php if ($data["check2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Detox</label>
                            <label class="ml-5"></label>
                            <label class="ml-5"></label>
                            <label class="ml-5"><input type=checkbox name='check1' value="" <?php if ($data["check3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Injury Risk</label>
                            <label class="ml-5"></label>
                            <label class="ml-5"></label>
                            <label class="ml-5"><input type=checkbox name='check1' value="" <?php if ($data["check4"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> PC</label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Behavior:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='check5' value="" <?php if ($data["check5"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Alert</label>

                            <label class="ml-5"><input type=checkbox name='check6' value="" <?php if ($data["check6"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Cooperative</label>

                            <label class="ml-5"><input type=checkbox name='check7' value="" <?php if ($data["check7"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Calm</label>

                            <label class="ml-5"><input type=checkbox name='check8' value="" <?php if ($data["check8"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Aggressive</label>

                            <label class="ml-5"><input type=checkbox name='check9' value="" <?php if ($data["check9"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Disruptive</label>

                            <label class="ml-5"><input type=checkbox name='check10' value="" <?php if ($data["check10"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Agitated/ Irritated</label>

                            <label class="ml-5"><input type=checkbox name='check11' value="" <?php if ($data["check11"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Isolative</label>

                            <label class="ml-3"><input type=checkbox name='check12' value="" <?php if ($data["check12"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Impulsive</label>

                            <label class=""><input type=checkbox name='check13' value="" <?php if ($data["check13"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Demanding</label>

                            <label class="ml-5"><input type=checkbox name='check14' value="" <?php if ($data["check14"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Argumentative</label>

                            <label class="ml-5"><input type=checkbox name='check15' value="" <?php if ($data["check15"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Passive</label>

                            <label class="ml-5"><input type=checkbox name='check16' value="" <?php if ($data["check16"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Withdrawn</label>

                            <label class="ml-5"><input type=checkbox name='check17' value="" <?php if ($data["check17"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Intrusive</label>

                            <label class="ml-5"><input type=checkbox name='check18' value="" <?php if ($data["check18"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Entitled</label>

                            <label class="ml-5"><input type=checkbox name='check19' value="" <?php if ($data["check19"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Sarcastic</label>

                            <label class="ml-4"><input type=checkbox name='check20' value="" <?php if ($data["check20"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Guarded</label>
                            <label class=""><input type=checkbox name='check21' value="" <?php if ($data["check21"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other : <?php echo xlt($data['othertext1']);?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Affect:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='check22' value="" <?php if ($data["check22"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Appropriate for situation</label>

                            <label class="ml-5"><input type=checkbox name='check23' value="" <?php if ($data["check23"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Constricted</label>

                            <label class="ml-5"><input type=checkbox name='check24' value="" <?php if ($data["check24"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Flat</label>

                            <label class="ml-5"><input type=checkbox name='check25' value="" <?php if ($data["check25"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Inappropriate</label>

                            <label class="ml-5"><input type=checkbox name='check26' value="" <?php if ($data["check26"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Blunted</label>

                            <label class="ml-5"><input type=checkbox name='check27' value="" <?php if ($data["check27"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other: <?php echo xlt($data['othertext2']); ?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Mood:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='check28' value="" <?php if ($data["check28"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Calm</label>

                            <label class="ml-5"><input type=checkbox name='check29' value="" <?php if ($data["check29"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Anxious</label>

                            <label class="ml-5"><input type=checkbox name='check30' value="" <?php if ($data["check30"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Depressed</label>

                            <label class="ml-5"><input type=checkbox name='check31' value="" <?php if ($data["check31"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Sad/Tearful</label>

                            <label class="ml-5"><input type=checkbox name='check32' value="" <?php if ($data["check32"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Labile</label>

                            <label class="ml-5"><input type=checkbox name='check33' value="" <?php if ($data["check33"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Euphoric</label>

                            <label class="ml-5"><input type=checkbox name='check34' value="" <?php if ($data["check34"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Dysphoric</label>

                            <label class="ml-5"><input type=checkbox name='check35' value="" <?php if ($data["check35"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Euthymic</label>

                            <label><input type=checkbox name='check36' value="" <?php if ($data["check36"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Angry</label>

                            <label class="ml-5"><input type=checkbox name='check37' value="" <?php if ($data["check37"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other : <?php echo xlt($data['othertext3']); ?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Thought Process:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='check38' value="" <?php if ($data["check38"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Logical</label>

                            <label class="ml-5"><input type=checkbox name='check39' value="" <?php if ($data["check39"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Illogical</label>

                            <label class="ml-5"><input type=checkbox name='check40' value="" <?php if ($data["check40"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Coherent</label>

                            <label class="ml-5"><input type=checkbox name='check41' value="" <?php if ($data["check41"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Disorganized</label>


                            <label class="ml-5"><input type=checkbox name='check42' value="" <?php if ($data["check42"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Loose</label>

                            <label class="ml-5"><input type=checkbox name='check43' value="" <?php if ($data["check43"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Confused</label>

                            <label class="ml-5"><input type=checkbox name='check44' value="" <?php if ($data["check44"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Paranoid</label>

                            <label class="ml-5"><input type=checkbox name='check45' value="" <?php if ($data["check45"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Circumstantial</label>

                            <label><input type=checkbox name='check46' value="" <?php if ($data["check46"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Grandiose</label>

                            <label class="ml-5"><input type=checkbox name='check47' value="" <?php if ($data["check47"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Preoccupied</label>


                            <label class="ml-5"><input type=checkbox name='check48' value="" <?php if ($data["check48"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Tangential</label>


                            <label class="ml-5"><input type=checkbox name='check49' value="" <?php if ($data["check49"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Delusional</label>


                            <label class="ml-5"><input type=checkbox name='check50' value="" <?php if ($data["check50"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other: <?php echo xlt($data['othertext4']); ?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Level of Function:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='check51' value="" <?php if ($data["check51"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Self-Directed</label>
                            <label class="ml-5"><input type=checkbox name='check52' value="" <?php if ($data["check52"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Some Direction </label>
                            <label class="ml-5"><input type=checkbox name='check53' value="" <?php if ($data["check53"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Frequent Direction</label>
                            <label class="ml-5"><input type=checkbox name='check54' value="" <?php if ($data["check54"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other : <?php echo xlt($data['othertext5']); ?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Physical Withdrawal:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='check55' value="" <?php if ($data["check55"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Relaxed</label>
                            <label class="ml-5"><input type=checkbox name='check56' value="" <?php if ($data["check56"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Tense</label>
                            <label class="ml-5"><input type=checkbox name='check57' value="" <?php if ($data["check57"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Pacing</label>
                            <label class="ml-5"><input type=checkbox name='check58' value="" <?php if ($data["check58"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Slow</label>
                            <label class="ml-5"><input type=checkbox name='check59' value="" <?php if ($data["check59"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Nausea/Vomiting</label>
                            <label class="ml-5"><input type=checkbox name='check60' value="" <?php if ($data["check60"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Dilated Pupils</label>
                            <label class="ml-5"><input type=checkbox name='check61' value="" <?php if ($data["check61"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Diarrhea</label>
                            <label><input type=checkbox name='check62' value="" <?php if ($data["check62"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Stomach Cramps</label>
                            <label class="ml-5"><input type=checkbox name='check63' value="" <?php if ($data["check63"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Tremors</label>
                            <label class="ml-5"><input type=checkbox name='check64' value="" <?php if ($data["check64"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Restless </label>
                            <label class="ml-5"><input type=checkbox name='check65' value="" <?php if ($data["check65"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Constipation </label>
                            <label class="ml-5"><input type=checkbox name='check66' value="" <?php if ($data["check66"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Anxiety </label>
                            <label class="ml-5"><input type=checkbox name='check67' value="" <?php if ($data["check67"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Fatigue </label>
                            <label class="ml-5"><input type=checkbox name='check68' value="" <?php if ($data["check68"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Eyes blurred </label>
                            <label class="ml-2"><input type=checkbox name='check69' value="" <?php if ($data["check69"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Tearing</label>
                            <label><input type=checkbox name='check70' value="" <?php if ($data["check70"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Weakness </label>
                            <label class="ml-5"><input type=checkbox name='check71' value="" <?php if ($data["check71"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Dizziness </label>
                            <label class="ml-5"><input type=checkbox name='check72' value="" <?php if ($data["check72"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Headache </label>
                            <label class="ml-5"><input type=checkbox name='check73' value="" <?php if ($data["check73"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Numbness in body : <?php echo xlt($data['othertext6']); ?></label>
                            <label class="ml-5"><input type=checkbox name='check74' value="" <?php if ($data["check74"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Yawning</label>
                            <br />
                            <label><input type=checkbox name='check75' value="" <?php if ($data["check75"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Muscle aches </label>
                            <label class="ml-5"><input type=checkbox name='check76' value="" <?php if ($data["check76"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Muscle stiffness </label>
                            <label class="ml-5"><input type=checkbox name='check77' value="" <?php if ($data["check77"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Joint discomfort </label>
                            <label class="ml-5"><input type=checkbox name='check78' value="" <?php if ($data["check78"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Muscle twitches </label>
                            <label class="ml-5"><input type=checkbox name='check79' value="" <?php if ($data["check79"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Poor Coordination</label>
                            <label class="ml-5"><input type=checkbox name='check80' value="" <?php if ($data["check80"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Light sensitive </label><br />
                            <label><input type=checkbox name='check81' value="" <?php if ($data["check81"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Noise sensitivity </label>
                            <label class="ml-5"><input type=checkbox name='check82' value="" <?php if ($data["check82"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Taste sensitivity </label>
                            <label class="ml-5"><input type=checkbox name='check83' value="" <?php if ($data["check83"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Difficulty Concentrating </label>
                            <label class="ml-5"><input type=checkbox name='check84' value="" <?php if ($data["check84"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Fearful </label>
                            <label class="ml-5"><input type=checkbox name='check85' value="" <?php if ($data["check85"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Hot/cold flashes </label>
                            <label class="ml-5"><input type=checkbox name='check86' value="" <?php if ($data["check86"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Palpitations </label><br />
                            <label><input type=checkbox name='check87' value="" <?php if ($data["check87"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Sweats </label>
                            <label class="ml-5"><input type=checkbox name='check88' value="" <?php if ($data["check88"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Cravings </label>
                            <label class="ml-5"><input type=checkbox name='check89' value="" <?php if ($data["check89"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Insomnia/Broken sleep </label>
                            <label class="ml-5"><input type=checkbox name='check90' value="" <?php if ($data["check90"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Runny nose</label>
                            <label class="ml-5"><input type=checkbox name='check91' value="" <?php if ($data["check91"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Change in appetite: Loss / Gain </label><br />
                            <label><input type=checkbox name='check92' value="" <?php if ($data["check92"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Tongue fasciculation </label>
                            <label class="ml-5"><input type=checkbox name='check93' value="" <?php if ($data["check93"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Nystagmus </label>
                            <label class="ml-5"><input type=checkbox name='check94' value="" <?php if ($data["check94"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Piloerection </label><br />
                            <label><input type=checkbox name='check95' value="" <?php if ($data["check95"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Auditory/Visual/Tactile Hallucinations : <?php echo xlt($data['othertext7']); ?></label><br />
                            <label><input type=checkbox name='check96' value="" <?php if ($data["check96"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Memory: Recent – </label>
                            <label class="ml-5"><input type=checkbox name='check97' value="" <?php if ($data["check97"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Impaired </label>
                            <label class="ml-5"><input type=checkbox name='check98' value="" <?php if ($data["check98"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Intact; Remote –</label>
                            <label class="ml-5"><input type=checkbox name='check99' value="" <?php if ($data["check99"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Impaired </label>
                            <label class="ml-5"><input type=checkbox name='check100' value="" <?php if ($data["check100"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Intact </label>
                            <label class="ml-5"><input type=checkbox name='check101' value="" <?php if ($data["check101"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other : <?php echo xlt($data['othertext8']); ?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Suicidal/ Homicidal Ideation:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='check102' value="" <?php if ($data["check102"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Has no plan </label><br />
                            <label><input type=checkbox name='check103' value="" <?php if ($data["check103"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Has plan : <?php echo xlt($data['plantext1']); ?></label><br />
                            <label><input type=checkbox name='check104' value="" <?php if ($data["check104"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Has ideation : <?php echo xlt($data['plantext2']); ?></label><br />
                            <label><input type=checkbox name='check105' value="" <?php if ($data["check105"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Attempts/History-description : <?php echo xlt($data['plantext3']); ?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Means of Self-Harm:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='meancheck1' value="" <?php if ($data["meancheck1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> No means of self harm at home </label><br />
                            <label><input type=checkbox name='meancheck2' value="" <?php if ($data["meancheck2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Means of self harm at home (MD must be made aware before patient is sent home and document it in additional notes!) </label>
                            <br />
                            <label class="ml-5"> What type of means: <?php echo xlt($data['meantext1']); ?></label><br />
                            <label class="ml-5"> Where is it (they) stored: <?php echo xlt($data['meantext2']); ?></label><br />
                            <label class="ml-5"> Who will dispose of or safely store these items before you are sent home: <br> Name : <?php echo xlt($data['meantext3']); ?> Relationship: <?php echo xlt($data['meantext4']); ?> Phone: <?php echo xlt($data['meantext5']); ?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Interaction with Staff/ Peers:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">

                            <label><input type=checkbox name='intercheck1' value="" <?php if ($data["intercheck1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Friendly </label>
                            <label class="ml-5"><input type=checkbox name='intercheck2' value="" <?php if ($data["intercheck2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Cooperative</label>
                            <label class="ml-5"><input type=checkbox name='intercheck3' value="" <?php if ($data["intercheck3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Hostile </label>
                            <label class="ml-5"><input type=checkbox name='intercheck4' value="" <?php if ($data["intercheck4"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Inappropriate </label>
                            <label class="ml-5"><input type=checkbox name='intercheck5' value="" <?php if ($data["intercheck5"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Resistant</label>
                            <label class="ml-5"><input type=checkbox name='intercheck6' value="" <?php if ($data["intercheck6"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Guarded </label>
                            <label class="ml-5"><input type=checkbox name='intercheck7' value="" <?php if ($data["intercheck7"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Isolative</label><br />
                            <label><input type=checkbox name='intercheck8' value="" <?php if ($data["intercheck8"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Withdrawal</label>
                            <label class="ml-5"><input type=checkbox name='intercheck9' value="" <?php if ($data["intercheck9"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Avoidant</label>
                            <label class="ml-5"><input type=checkbox name='intercheck10' value="" <?php if ($data["intercheck10"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other : <?php echo xlt($data['intertext1']); ?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Meals
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='mealcheck1' value="" <?php if ($data["mealcheck1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Lunch : <?php echo xlt($data['mealtext1']); ?>%</label>
                            <label class="ml-5"><input type=checkbox name='mealcheck2' value="" <?php if ($data["mealcheck2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Dinner : <?php echo xlt($data['mealtext2']); ?>%</label>
                            <label class="ml-5"><input type=checkbox name='mealcheck3' value="" <?php if ($data["mealcheck3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other : <?php echo xlt($data['mealtext3']); ?></label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Objective Data:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='objcheck1' value="" <?php if ($data["objcheck1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> AAO x </label>
                            <label class="ml-5"><input type=checkbox name='objcheck2' value="" <?php if ($data["objcheck2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Person </label>
                            <label class="ml-5"><input type=checkbox name='objcheck3' value="" <?php if ($data["objcheck3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Place </label>
                            <label class="ml-5"><input type=checkbox name='objcheck4' value="" <?php if ($data["objcheck4"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Time </label><br>
                            <label>Vital Signs: BP: <?php echo xlt($data['vtext1']); ?>/<?php echo xlt($data['vtext2']); ?> PR: <?php echo xlt($data['vtext3']); ?> RR: <?php echo xlt($data['vtext4']); ?> <br /><br />Temperature: <?php echo xlt($data['vtext5']); ?> Pulse Ox: <?php echo xlt($data['vtext6']); ?> %</label>
                        </td>
                    </tr>
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Patient Received:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='ptcheck1' value="" <?php if ($data["ptcheck1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Motrin 600mg PO </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck2' value="" <?php if ($data["ptcheck2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Tylenol 500mg PO </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck3' value="" <?php if ($data["ptcheck3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Maalox 30ml PO</label>
                            <label class="ml-3"><input type=checkbox name='ptcheck4' value="" <?php if ($data["ptcheck4"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Robaxin <?php echo xlt($data['pttext1']); ?>mg PO</label>
                            <label class="ml-3"><input type=checkbox name='ptcheck5' value="" <?php if ($data["ptcheck5"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Vistaril 50mg PO</label><label><input type=checkbox name='ptcheck6' value="" <?php if ($data["ptcheck6"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Imodium 2mg PO</label>
                            <label class="ml-3"><input type=checkbox name='ptcheck7' value="" <?php if ($data["ptcheck7"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> MOM 30ml PO</label>
                            <label class="ml-3"><input type=checkbox name='ptcheck8' value="" <?php if ($data["ptcheck8"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Ducolax 10mg PO</label><label class="ml-3"><input type=checkbox name='ptcheck9' value="" <?php if ($data["ptcheck9"] == "0") {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        }; ?>> Zofran ODT 8mgPO </label><label class="ml-3"><input type=checkbox name='ptcheck10' value="" <?php if ($data["ptcheck10"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Benadryl 50mg IM</label><label><input type=checkbox name='ptcheck11' value="" <?php if ($data["ptcheck11"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Promethazine <?php echo xlt($data['pttext2']); ?>mg PO </label><label class="ml-3"><input type=checkbox name='ptcheck12' value="" <?php if ($data["ptcheck12"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Promethazine HCL 12.5mg IM </label><label class="ml-3"><input type=checkbox name='ptcheck13' value="" <?php if ($data["ptcheck13"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Bentyl 10mg PO</label><label ><input type=checkbox name='ptcheck14' value="" <?php if ($data["ptcheck14"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Keppra <?php echo xlt($data['pttext3']); ?>mg PO </label><label class="ml-3"><input type=checkbox name='ptcheck15' value="" <?php if ($data["ptcheck15"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Folate 1mg PO </label><label class="ml-3"><input type=checkbox name='ptcheck16' value="" <?php if ($data["ptcheck16"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Thiamine 100mg PO </label><label class="ml-3"><input type=checkbox name='ptcheck17' value="" <?php if ($data["ptcheck17"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Lactulose <?php echo xlt($data['pttext4']); ?>ml PO</label>
                            <label><input type=checkbox name='ptcheck18' value="" <?php if ($data["ptcheck18"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Suboxone <?php echo xlt($data['pttext5']); ?>mg SL </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck19' value="" <?php if ($data["ptcheck19"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> SubuTEX <?php echo xlt($data['pttext6']); ?>mg SL </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck20' value="" <?php if ($data["ptcheck20"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Clonidine <?php echo xlt($data['pttext7']); ?>mg PO </label>
                            <label><input type=checkbox name='ptcheck21' value="" <?php if ($data["ptcheck21"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Neurontin <?php echo xlt($data['pttext8']); ?>mg PO </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck22' value="" <?php if ($data["ptcheck22"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Librium <?php echo xlt($data['pttext9']); ?>mg PO </label>
                            <label class="ml-3"><input type=checkbox name='ptcheck23' value="" <?php if ($data["ptcheck23"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Ativan <?php echo xlt($data['pttext10']); ?>mg PO </label>
                                                                                    <label><input type=checkbox name='ptcheck24' value="" <?php if ($data["ptcheck24"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Valium <?php echo xlt($data['pttext11']); ?>mg PO  </label>
                                                                                    <label class="ml-3"><input type=checkbox name='ptcheck25' value="" <?php if ($data["ptcheck25"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other: "<?php echo xlt($data['pttext12']); ?> </label>
                        </td>
                    </tr>
<tr class="bg-dark text-light">
    <td style="border: 1px solid black;background-color:black;color:white;">
Nursing Education Provided:
    </td>
</tr>
<tr>
    <td style="border: 1px solid black;">
        <label><input type=checkbox name='goalcheck0' value="" <?php if ($data["goalcheck0"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Treatment Planning/Goal Planning </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck1' value="" <?php if ($data["goalcheck1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Medication Education </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck2' value="" <?php if ($data["goalcheck2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Disease Process Education </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck3' value="" <?php if ($data["goalcheck3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Coping with Symptoms </label><br/>

                            <label><input type=checkbox name='goalcheck4' value="" <?php if ($data["goalcheck4"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Mental Health Education </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck5' value="" <?php if ($data["goalcheck5"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Reducing Relapse </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck6' value="" <?php if ($data["goalcheck6"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Recovery Strategies </label>

                            <label class="ml-3"><input type=checkbox name='goalcheck7' value="" <?php if ($data["goalcheck7"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Medical Issue Education </label>

                            <label class=""><input type=checkbox name='goalcheck8' value="" <?php if ($data["goalcheck8"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> HIV/STD Education</label><br/>

                            <label ><input type=checkbox name='goalcheck9' value="" <?php if ($data["goalcheck9"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Substance Abuse Education </label>

                            <label class="ml-5"><input type=checkbox name='goalcheck10' value="" <?php if ($data["goalcheck10"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Triggers </label>

                            
    </td>
</tr>
<tr class="bg-dark text-light">
    <td style="border: 1px solid black;background-color:black;color:white;">
Subjective Data:
    </td>
</tr>
<tr>
    <td style="border: 1px solid black;">
             <?php echo xlt($data['subjective'] ); ?>                                                 </td>
                                                                                            </tr>
                                                                                            <tr class="bg-dark text-light">
    <td style="border: 1px solid black;background-color:black;color:white;">
Additional Notes:
    </td>
</tr>
<tr>
    <td style="border: 1px solid black;">
                        <?php echo $data['txt1']??"
          Patient received one-on-one support.  Patient educated per treatment plan and prescribed medication regimen. Patient was encouraged to verbalize feelings. Patient was encouraged to stay hydrated and maintain proper nutrition. Patient verbalized understanding of all education and encouragement provided.  Patient remains at risk for relapse. Will continue to monitor and assist as needed."?> <?php echo xlt($data['additional']); ?>                                                                     </td>
                                                                                </tr>                                                                         
                </table>
                <table class="table table-bordered" style="border: 1px solid black;width:100%;" > 
                    <tr>
                        <td >RN Signature : <img src='data:image/png;base64,<?php echo xlt($data['rnsign']); ?>' width='100px' height='50px'>
                        </td>
                        <td>Date : <?php echo xlt($data['rndate']); ?></td>
                        <td>Time: <?php echo xlt($data['rntime']); ?> </td>
                    </tr>
                </table>
                <br/>
                <br/>
                <table class="admissionord" style="width:100%;table-layout:fixed;display:table;text-align:center; ">
                    <tr>
                        <td>
                             <h3 class="text-center"><b>Evening Clearance Note</b></h3>                                                               </td>
                                                                                            </tr>
                                                                                            </table>
                                                                                            <table class="table table-bordered admissionord" style="width:100%;table-layout:fixed;display:table;border-collapse:collapse;">
                    <tr class="bg-dark text-light">
                        <td style="border: 1px solid black;background-color:black;color:white;">
                            Evening Clearance:
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                        <?php echo $data['txt2']??"
                            Patient is medically cleared to go home by the M.D.  Patient has not been in distress, although still in withdrawal.  Patient was educated about risk and benefits of outpatient detox, medications, drug interactions, risky behaviors, overdose potential, and possible death. Patient was also educated not to exchange phone numbers with peers or have social interaction outside of treatment.  Patient was educated to call 911 or present to the Emergency Room if an emergent situation arises.  Patient exhibits understanding of all the above entities.  Patient is still at risk for relapse."?><br/>
                            <label><input type=checkbox name='evecheck1' value="" <?php if ($data["evecheck1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Family was Educated</label>
                                                                                <label class="ml-5"><input type=checkbox name='evecheck2' value="" <?php if ($data["evecheck2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Patient Driven By Family</label>
                                                                                <label class="ml-5"><input type=checkbox name='evecheck3' value="" <?php if ($data["evecheck3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Patient drove self</label>
                                                                                <label class="ml-5"><input type=checkbox name='evecheck4' value="" <?php if ($data["evecheck4"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Patient Driven By Uber/Lyft</label>
                            </td>
                                                                                                </tr>
                       <tr class="bg-dark text-light"><td style="border: 1px solid black;background-color:black;color:white;">
Medications Administered Before Dismissal:
                       </td></tr>                                                                         
                <tr>
                        <td style="border: 1px solid black;">
                            <label><input type=checkbox name='medcheck1' value="" <?php if ($data["medcheck1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Motrin 600mg PO </label>
                            <label class="ml-3"><input type=checkbox name='medcheck2' value="" <?php if ($data["medcheck2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Tylenol 500mg PO </label>
                            <label class="ml-3"><input type=checkbox name='medcheck3' value="" <?php if ($data["medcheck3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Maalox 30ml PO</label>
                            <label class="ml-3"><input type=checkbox name='medcheck4' value="" <?php if ($data["medcheck4"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Robaxin <?php echo xlt($data['medtext1']); ?>mg PO</label>
                            <label class="ml-3"><input type=checkbox name='medcheck5' value="" <?php if ($data["medcheck5"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Vistaril 50mg PO</label><label><input type=checkbox name='medcheck6' value="" <?php if ($data["medcheck6"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Imodium 2mg PO</label>
                            <label class="ml-3"><input type=checkbox name='medcheck7' value="" <?php if ($data["medcheck7"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> MOM 30ml PO</label>
                            <label class="ml-3"><input type=checkbox name='medcheck8' value="" <?php if ($data["medcheck8"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Ducolax 10mg PO</label><label class="ml-3"><input type=checkbox name='medcheck9' value="" <?php if ($data["medcheck9"] == "0") {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        }; ?>> Zofran ODT 8mgPO </label><label class="ml-3"><input type=checkbox name='medcheck10' value="" <?php if ($data["medcheck10"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Benadryl 50mg IM</label><label><input type=checkbox name='medcheck11' value="" <?php if ($data["medcheck11"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Promethazine <?php echo xlt($data['medtext2']); ?>mg PO </label><label class="ml-3"><input type=checkbox name='medcheck12' value="" <?php if ($data["medcheck12"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Promethazine HCL 12.5mg IM </label><label class="ml-3"><input type=checkbox name='medcheck13' value="" <?php if ($data["medcheck13"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Bentyl 10mg PO</label><label><input type=checkbox name='medcheck14' value="" <?php if ($data["medcheck14"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Keppra <?php echo xlt($data['medtext3']); ?>mg PO </label><label class="ml-3"><input type=checkbox name='medcheck15' value="" <?php if ($data["medcheck15"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Folate 1mg PO </label><label class="ml-3"><input type=checkbox name='medcheck16' value="" <?php if ($data["medcheck16"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Thiamine 100mg PO </label><label class="ml-3"><input type=checkbox name='medcheck17' value="" <?php if ($data["medcheck17"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Lactulose <?php echo xlt($data['medtext4']); ?>ml PO</label>
                            <label><input type=checkbox name='medcheck18' value="" <?php if ($data["medcheck18"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Suboxone <?php echo xlt($data['medtext5']); ?>mg SL </label>
                            <label class="ml-3"><input type=checkbox name='medcheck19' value="" <?php if ($data["medcheck19"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> SubuTEX <?php echo xlt($data['medtext6']); ?>mg SL </label>
                            <label class="ml-3"><input type=checkbox name='medcheck20' value="" <?php if ($data["medcheck20"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Clonidine <?php echo xlt($data['medtext7']); ?>mg PO </label>
                            <label ><input type=checkbox name='medcheck21' value="" <?php if ($data["medcheck21"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Neurontin <?php echo xlt($data['medtext8']); ?>mg PO </label>
                            <label class="ml-3"><input type=checkbox name='medcheck22' value="" <?php if ($data["medcheck22"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Librium <?php echo xlt($data['medtext9']); ?>mg PO </label>
                            <label class="ml-3"><input type=checkbox name='medcheck23' value="" <?php if ($data["medcheck23"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Ativan <?php echo xlt($data['medtext10']); ?>mg PO </label>
                                                                                    <label><input type=checkbox name='medcheck24' value="" <?php if ($data["medcheck24"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Valium <?php echo xlt($data['medtext11']); ?>mg PO  </label>
                                                                                    <label class="ml-3"><input type=checkbox name='medcheck25' value="" <?php if ($data["medcheck25"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Other: <?php echo xlt($data['medtext13']); ?> </label>
                        </td>
                                                                                </tr>   
                                                                            <tr class="bg-dark text-light">
    <td style="border: 1px solid black;background-color:black;color:white;">
Nursing Education Provided Before Dismissal:
    </td>
</tr>
<tr>
    <td style="border: 1px solid black;">
        <label><input type=checkbox name='nurcheck0' value="" <?php if ($data["nurcheck0"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Treatment Planning/Goal Planning </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck1' value="" <?php if ($data["nurcheck1"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Medication Education </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck2' value="" <?php if ($data["nurcheck2"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Disease Process Education </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck3' value="" <?php if ($data["nurcheck3"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Coping with Symptoms </label><br/>

                            <label><input type=checkbox name='nurcheck4' value="" <?php if ($data["nurcheck4"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Mental Health Education </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck5' value="" <?php if ($data["nurcheck5"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Reducing Relapse </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck6' value="" <?php if ($data["nurcheck6"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Recovery Strategies </label>

                            <label class="ml-3"><input type=checkbox name='nurcheck7' value="" <?php if ($data["nurcheck7"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Medical Issue Education </label>

                            <label class=""><input type=checkbox name='nurcheck8' value="" <?php if ($data["nurcheck8"] == "0") {
                                                                                                echo "checked";
                                                                                            }; ?>> HIV/STD Education</label><br/>

                            <label ><input type=checkbox name='nurcheck9' value="" <?php if ($data["nurcheck9"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Substance Abuse Education </label>

                            <label class="ml-5"><input type=checkbox name='nurcheck10' value="" <?php if ($data["nurcheck10"] == "0") {
                                                                echo "checked='checked'";
                                                            } else {
                                                                echo '';
                                                            } ?>> Triggers </label>

                            
    </td>
</tr>   
        <tr class="bg-dark text-light">
    <td style="border: 1px solid black;background-color:black;color:white;font-family:Poppins;">
Additional Notes:
    </td>
</tr>
<tr>
    <td style="border: 1px solid black;">
             <?php echo xlt($data['additional1']); ?>                                                                              </td>
                                                                                </tr>                                                                    
</table>
<table class="table table-bordered" style="border: 1px solid black;width:100%;">
                    <tr>
                        <td>RN Signature : <img src='data:image/png;base64,<?php echo xlt($data['rnsign1']); ?>' width='100px' height='50px'>
                        </td>
                        <td>Date : <?php echo xlt($data['rndate1']); ?></td>
                        <td>Time: <?php echo xlt($data['rntime1']); ?> </td>
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
$mpdf->setTitle("Daily Nursing Assessment");
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

$mpdf->Output('Consent_Form.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>