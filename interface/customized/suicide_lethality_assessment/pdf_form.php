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

    $sql = "SELECT * FROM form_suicide_lethality_assessment WHERE id = $formid AND pid = $pid";
   
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
 <p style='text-align:center;'>Fax: 732-431-5806</p>
</div>";

ob_start();
 
        ?>
                    <table style="width:100%;border:1px solid black;border-top-style:none;border-right-style:none;border-left-style:none;"> 
                            <tr>
                                <td style="width:100%;">
                                    <h4><b>NURSING ADMISSION ASSESSMENT</b></h4>
                                </td>   
                            </tr>
                    </table>
                    <div style="border:1px solid black;">
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;text-align:center;">
                                    <h4><b>SUICIDE LETHALITY ASSESSMENT</b></h4>
                                </td>   
                            </tr>
                        </table>
                        <table style="width:100%;border:1px solid black;border-left-style:none;border-right-style:none;"> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label><b>Presence of Risk Factors<b></label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">    
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check1' value="" <?php if ($data["check1"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Thoughts regarding death and dying <?php echo xlt($data['suicidetext1']);?></label>
                                </td>
                            </tr>        
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check2' value="" <?php if ($data["check2"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Exposure to another's suicidal behaviour <?php echo xlt($data['suicidetext2']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check3' value="" <?php if ($data["check3"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Family History of suicide <?php echo xlt($data['suicidetext3']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check4' value="" <?php if ($data["check4"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Depression of hopelessness <?php echo xlt($data['suicidetext4']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check5' value="" <?php if ($data["check5"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Previous suicide attempts <?php echo xlt($data['suicidetext5']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check6' value="" <?php if ($data["check6"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Alcohol or drug use by patient or family <?php echo xlt($data['suicidetext6']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check7' value="" <?php if ($data["check7"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Poor Coping Skills <?php echo xlt($data['suicidetext7']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check8' value="" <?php if ($data["check8"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Relationship Loss <?php echo xlt($data['suicidetext8']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check9' value="" <?php if ($data["check9"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Organized or serious attempt <?php echo xlt($data['suicidetext9']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check10' value="" <?php if ($data["check10"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Social support unreliable or unavailable/family conflict <?php echo xlt($data['suicidetext10']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check11' value="" <?php if ($data["check11"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> State future attempt (determine to repeat or ambivalent) <?php echo xlt($data['suicidetext11']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check12' value="" <?php if ($data["check12"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Legal Problems <?php echo xlt($data['suicidetext12']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check13' value="" <?php if ($data["check13"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Physical/ Sexual abuse <?php echo xlt($data['suicidetext13']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check14' value="" <?php if ($data["check14"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> History of assault, aggression, violence, impulsive behaviors <?php echo xlt($data['suicidetext14']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check15' value="" <?php if ($data["check15"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Difficulties dealing with significant stressors (i.e.,sexual orientation, unplanned preganancy) <?php echo xlt($data['suicidetext15']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check16' value="" <?php if ($data["check16"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Guilt, shame or fear of humiliation <?php echo xlt($data['suicidetext16']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check17' value="" <?php if ($data["check17"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Recent loss/Anniversary of a loss/Anticipated loss <?php echo xlt($data['suicidetext17']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check18' value="" <?php if ($data["check18"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Poor sleep <?php echo xlt($data['suicidetext18']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check19' value="" <?php if ($data["check19"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Chronic illness (Chronic Pain, Dialysis) <?php echo xlt($data['suicidetext19']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check20' value="" <?php if ($data["check20"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> History of a traumatic event, (Experienced and or Witnessed)  <?php echo xlt($data['suicidetext20']);?></label>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check21' value="" <?php if ($data["check21"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Other <?php echo xlt($data['suicidetext21']);?></label>
                                </td>
                            </tr> 
                        </table>
                    </div>
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
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div style="border:1px solid black;">    
                        <table style="width:100%;border:1px solid black;border-left-style:none;border-right-style:none;"> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label><b>Presence of Protective Factors/SNAP Assessment<b></label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">    
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check22' value="" <?php if ($data["check22"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Positive experience with professional help <?php echo xlt($data['suicidetext22']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check23' value="" <?php if ($data["check23"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Life Skills (decision-making, problem solving, conflict mgmt) <?php echo xlt($data['suicidetext23']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check24' value="" <?php if ($data["check24"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Strong support system <?php echo xlt($data['suicidetext24']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check25' value="" <?php if ($data["check25"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Future goals <?php echo xlt($data['suicidetext25']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check26' value="" <?php if ($data["check26"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Religious prohibition/Spirituality <?php echo xlt($data['suicidetext26']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check27' value="" <?php if ($data["check27"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Willing and able to participate in treatment <?php echo xlt($data['suicidetext27']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check28' value="" <?php if ($data["check28"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Responsibility to sibilings/friends/pets <?php echo xlt($data['suicidetext28']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check29' value="" <?php if ($data["check29"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Sobriety <?php echo xlt($data['suicidetext29']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check30' value="" <?php if ($data["check30"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Presenting thoughts <?php echo xlt($data['suicidetext30']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check31' value="" <?php if ($data["check31"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Individual needs <?php echo xlt($data['suicidetext31']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check32' value="" <?php if ($data["check32"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Physical Abilities <?php echo xlt($data['suicidetext32']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check33' value="" <?php if ($data["check33"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Preferences <?php echo xlt($data['suicidetext33']);?></label>
                                </td>   
                            </tr>
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check34' value="" <?php if ($data["check34"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Urgent needs <?php echo xlt($data['suicidetext34']);?></label>
                                </td>   
                            </tr>
                        </table>
                        <table style="width:100%;border:1px solid black;border-left-style:none;border-right-style:none;">    
                            <tr>
                                <td style="width:100%;">
                                <label><b>Current Stressors (as per patient):</b></label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">    
                            <tr>
                                <td style="width:100%;">
                                <label><?php echo xlt($data['stressor']);?></label>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;border:1px solid black;border-left-style:none;border-right-style:none;">    
                            <tr>
                                <td style="width:100%;">
                                <label><b>Motivation for Treatment (as per patient):</b></label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">    
                            <tr>
                                <td style="width:100%;">
                                <label><?php echo xlt($data['motivation']);?></label>
                                </td>
                            </tr>
                        </table>
                    </div>
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
$mpdf->setTitle("SUICIDE LETHALITY ASSESSMENT");
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

$mpdf->Output('SUICIDE LETHALITY ASSESSMENT.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>