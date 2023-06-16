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

    $sql = "SELECT * FROM form_current_withdrawal_signs WHERE id = $formid AND pid = $pid";
   
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);
   
  //  echo $sql;
   
    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>
<style>
</style>
<body id='body' class='body'>
<?php
$header ="<div class='row' style='line-height:1px;' >

</div>";

ob_start();
 
        ?>
                    <table style="width:100%;border:1px solid black;border-right-style:none;border-left-style:none;"> 
                    <tr>
                                <td style="width:40%;">
                                    <h4>Nursing Admission Assessment</h4>
                                </td>  
                                <td style="width:20%;">
                                </td> 
                                <td style="width:40%;">
                                    <h4>Center for Network Therapy</h4>
                                </td>
                            </tr>
                    </table>
                    <br/>
                    <!-- <div style="border:1px solid black;"> -->
                        <table style="width:100%;border:1px solid black;border-right-style:none;border-left-style:none;"> 
                            <tr>
                                <td style="width:100%;">
                                    <h4><b>Current Withdrawal Signs/Symptoms</b></h4>
                                </td>   
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;">    
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check1' value="" <?php if ($data["check1"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Dilated pupils</label>
                                    <label> <input type=checkbox name='check2' value="" <?php if ($data["check2"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Nausea</label> 
                                    <label> <input type=checkbox name='check3' value="" <?php if ($data["check3"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Vomitting</label>                               
                                    <label> <input type=checkbox name='check4' value="" <?php if ($data["check4"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Diarrhea</label>                              
                                    <label> <input type=checkbox name='check5' value="" <?php if ($data["check5"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> abdominal cramps</label>
                                    <label> <input type=checkbox name='check6' value="" <?php if ($data["check6"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> anxiety</label>                                
                                    <label> <input type=checkbox name='check7' value="" <?php if ($data["check7"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> palpitations</label>
                                </td>   
                            </tr>
                            </table>
                            <br/>
                            <table style="width:100%;">    
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check8' value="" <?php if ($data["check8"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> irritability</label>                              
                                    <label> <input type=checkbox name='check9' value="" <?php if ($data["check9"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> fearful</label>                             
                                    <label> <input type=checkbox name='check10' value="" <?php if ($data["check10"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> depressed mood</label>                                
                                    <label> <input type=checkbox name='check11' value="" <?php if ($data["check11"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> weakness</label>
                                    <label> <input type=checkbox name='check12' value="" <?php if ($data["check12"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> fatigue</label>                                
                                    <label> <input type=checkbox name='check13' value="" <?php if ($data["check13"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> restlessness</label>                               
                                    <label> <input type=checkbox name='check14' value="" <?php if ($data["check14"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> tremors</label>                           
                                </td>
                            </tr> 
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;"> 
                                <label> <input type=checkbox name='check15' value="" <?php if ($data["check15"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> dizziness</label>
                                    <label> <input type=checkbox name='check16' value="" <?php if ($data["check16"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> headache</label>
                                    <label> <input type=checkbox name='check17' value="" <?php if ($data["check17"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> wernike's syndrome</label>                               
                                    <label> <input type=checkbox name='check18' value="" <?php if ($data["check18"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> poor condition</label>                           
                                    <label> <input type=checkbox name='check19' value="" <?php if ($data["check19"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> difficult concentration</label>
                                </td>
                            </tr> 
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check20' value="" <?php if ($data["check20"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> nystagmus</label>                       
                                    <label> <input type=checkbox name='check21' value="" <?php if ($data["check21"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> tongue fasciculation</label>
                                    <label> <input type=checkbox name='check22' value="" <?php if ($data["check22"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> cravings</label>
                                    <label> <input type=checkbox name='check23' value="" <?php if ($data["check23"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> poor condition</label>
                                     <label> <input type=checkbox name='check24' value="" <?php if ($data["check24"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> memory change</label>
                                </td>
                            </tr> 
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;"> 
                                <label> <input type=checkbox name='check25' value="" <?php if ($data["check25"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> photosensivity</label>
                                    <label> <input type=checkbox name='check26' value="" <?php if ($data["check26"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> sensivity to noise/ taste</label>
                                    <label> <input type=checkbox name='check27' value="" <?php if ($data["check27"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> numbness to body</label>
                                    <label> <input type=checkbox name='check28' value="" <?php if ($data["check28"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> muscle cramps</label>
                                    <label> <input type=checkbox name='check29' value="" <?php if ($data["check29"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> body aches</label>
                                </td>
                            </tr> 
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check30' value="" <?php if ($data["check30"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> constipation</label>
                                    <label> <input type=checkbox name='check31' value="" <?php if ($data["check31"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> hot/cold sweats</label>
                                    <label> <input type=checkbox name='check32' value="" <?php if ($data["check32"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> diaphoretic</label>
                                    <label> <input type=checkbox name='check33' value="" <?php if ($data["check33"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> change in appetite</label>
                                    <label> <input type=checkbox name='check34' value="" <?php if ($data["check34"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> weight loss</label>
                                    <label> <input type=checkbox name='check35' value="" <?php if ($data["check35"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> memory loss</label>
                                </td>
                            </tr> 
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label> <input type=checkbox name='check36' value="" <?php if ($data["check36"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> auditory/ visual/ tactile hallucinations</label>
                                    <label> <input type=checkbox name='check37' value="" <?php if ($data["check37"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> insomania</label>
                                    <label> <input type=checkbox name='check38' value="" <?php if ($data["check38"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> "skin crawling"</label>
                                    <label> <input type=checkbox name='check39' value="" <?php if ($data["check39"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> join discomfort</label>
                                </td> 
                            </tr>     
                            <tr>
                                <td style="width:100%;">   
                                    <label> <input type=checkbox name='check40' value="" <?php if ($data["check40"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> constipation</label>                                   
                                </td>
                            </tr> 
                        </table>
                        <div style="border:1px solid black;border-left-style:none;border-right-style:none;border-bottom-style:none;">
                        </div>
                        <br/>
                        <table style="width:100%;border:1px solid black;border-bottom-style:none;"> 
                            <tr>
                                <td style="width:100%;text-align:center;border:1px solid black;border-left-style:none;border-right-style:none;border-top-style:none;">
                                    <h4 style="margin-top:6px;"><b>PREGNANCY ASSESSMENT</b></h4>
                                </td>  
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:6px;"><b>Did the patient have a pregnancy test completed in the office?</b></label>
                                    <label> <input type=checkbox name='check41' value="" <?php if ($data["check41"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>>  Yes</label>
                                    <label> <input type=checkbox name='check42' value="" <?php if ($data["check42"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>>  No</label>
                                    <label> <input type=checkbox name='check43' value="" <?php if ($data["check43"] == "NA/ LMP") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>>  NA/ LMP</label>                                    
                                </td>  
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:6px;"><b>Result of HCG Test:</b></label>
                                    <label> <input type=checkbox name='check44' value="" <?php if ($data["check44"] == "Negative") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Negative</label>
                                    <label> <input type=checkbox name='check45' value="" <?php if ($data["check45"] == "Positive") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Positive</label>
                                </td>  
                            </tr>
                        </table>
                        <table style="width:100%;border:1px solid black; border-top-style:none; border-bottom-style:none;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label>Is the patient psychotic?</label>
                                </td>
                                <td style="width:20%;"> 
                                    <label> <input type=checkbox name='check46' value="" <?php if ($data["check46"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check47' value="" <?php if ($data["check47"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label>   
                                </td> 
                                <td style="width:30%;">
                                    <label>Is the patient sexually active?</label>
                                </td>
                                <td style="width:20%;"> 
                                    <label> <input type=checkbox name='check48' value="" <?php if ($data["check48"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check49' value="" <?php if ($data["check49"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label>                                      
                                </td> 
                            </tr> 
                            <tr>
                                <td>
                                    <label>Is the patient impulsive?</label>
                                </td>
                                <td>    
                                    <label> <input type=checkbox name='check50' value="" <?php if ($data["check50"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check51' value="" <?php if ($data["check51"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label> 
                                </td> 
                                <td>
                                    <label>Does the patient use contraception? </label>
                                </td>
                                <td>    
                                    <label> <input type=checkbox name='check52' value="" <?php if ($data["check52"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check53' value="" <?php if ($data["check53"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label> 
                                </td> 
                            </tr>
                            <tr>
                                <td>
                                    <label>Is the patient mentally changed?</label>
                                </td>
                                <td>    
                                    <label> <input type=checkbox name='check54' value="" <?php if ($data["check54"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check55' value="" <?php if ($data["check55"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label> 
                                </td> 
                                <td>
                                    <label>Has the patient had a recent abortion? </label>
                                </td>
                                <td>    
                                    <label> <input type=checkbox name='check56' value="" <?php if ($data["check56"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check57' value="" <?php if ($data["check57"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label> 
                                </td> 
                            </tr>
                            <tr>
                                <td>
                                    <label>Is there a possibility you are pregnant?</label>
                                </td>
                                <td>    
                                    <label> <input type=checkbox name='check58' value="" <?php if ($data["check58"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check59' value="" <?php if ($data["check59"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label>
                                </td> 
                                <td>
                                    <label>Has the patient had a recent miscarriage? </label>
                                </td>
                                <td>    
                                    <label> <input type=checkbox name='check60' value="" <?php if ($data["check60"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check61' value="" <?php if ($data["check61"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label>
                                </td> 
                            </tr>
                            <tr>
                                <td>
                                    <label>Dose the patient have a history of STD?</label>
                                </td>
                                <td>    
                                    <label> <input type=checkbox name='check62' value="" <?php if ($data["check62"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check63' value="" <?php if ($data["check63"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label>
                                </td> 
                                <td>
                                    <label>Dose the patient have any children? </label>
                                </td>
                                <td>    
                                    <label> <input type=checkbox name='check64' value="" <?php if ($data["check64"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check65' value="" <?php if ($data["check65"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label>
                                </td> 
                            </tr> 
                        </table> 
                        <table style="width:100%;border:1px solid black; border-top-style:none;">
                            <tr>
                                <td >
                                    <label>Based on the above data, the patient's pregnancy status is assessedas: </label>
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
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <table style="width:100%;border:1px solid black;"> 
                            <tr>
                                <td style="width:100%;border:1px solid black; border-top-style:none;border-right-style:none;border-left-style:none;text-align:center;">
                                    <h4 style="margin-top:6px;"><b>PAIN MANAGEMENT</b></h4>
                                </td>  
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label style="margin-top:6px;"><b>Inform the patient of the organization's pain management philosophy?:</b></label>
                                    <label> <input type=checkbox name='check66' value="" <?php if ($data["check66"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check67' value="" <?php if ($data["check67"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label><label>(if no, list reason)</label>
                                </td>  
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label> <input type=checkbox name='check68' value="" <?php if ($data["check68"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> FLACC Scale</label>
                                    <label> <input type=checkbox name='check69' value="" <?php if ($data["check69"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Numeric Scale (0-10)</label>
                                    <label> <input type=checkbox name='check70' value="" <?php if ($data["check70"] == "0") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Wonk-Baker Scale (Faces)</label>
                                    
                                </td>                                 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Do you have pain now?</b></label> 
                                    <label > <input type=checkbox  name='check71' value="" <?php if ($data["check71"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check72' value="" <?php if ($data["check72"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label> 
                                    <label></label>
                                    <label></label>
                                    <label></label>
                                    <label></label>
                                    <label></label>
                                    <label></label>
                                    <label><b>Do you have chronic pain?</b></label>  
                                    <label > <input type=checkbox  name='check73' value="" <?php if ($data["check73"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check74' value="" <?php if ($data["check74"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label> 
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>where is your pain located:</b> <?php echo xlt($data['pain']);?></label>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>where is your present pain intensity? (USE APPROPRIATE PAIN SCALE):</b> <?php echo xlt($data['intensity']);?></label>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>what is acceptable level of pain? (USE APPROPRIATE PAIN SCALE):</b> <?php echo xlt($data['acceptable']);?></label>
                                    
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Describe the characteristic of the pain:</b> <?php echo xlt($data['characteristic']);?></label>
                                   
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Describe the onset and duration of the pain:</b> <?php echo xlt($data['onset']);?></label>
                                   
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>What relieves the pain:</b> <?php echo xlt($data['relieves']);?></label>
                                    
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>What causes or increases the pain:</b> <?php echo xlt($data['causes']);?></label>
                                    
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Effects of pain:</b> <?php echo xlt($data['effects']);?></label>
                                 
                                </td> 
                            </tr>
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Does the patient have any personal, cultural, spiritual or ethnic beliefs that would prevent participation in pain management:</b></label>
                                    <label > <input type=checkbox  name='check75' value="" <?php if ($data["check75"] == "Yes") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> Yes</label>
                                    <label> <input type=checkbox name='check76' value="" <?php if ($data["check76"] == "No") {
                                    echo "checked='checked'";}else{
                                        echo '';
                                    }?>> No</label>
                                    <label>(if yes, refer patient to the treatment team as soon as possible for review): <?php echo xlt($data['treatment']);?></label>
                                </td> 
                            </tr> 
                            <tr>
                                <td style="width:100%;">
                                    <label><b>RN Intervention:</b> <?php echo xlt($data['intervention']);?><</label>
                                </td> 
                            </tr>
                        </table>
                        <table style="width:100%;border:1px solid black;border-top-style:none;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Note:</b> <?php echo xlt($data['note']);?></label>                                   
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
$mpdf->setTitle("Current Withdrawal Signs/Symptoms");
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

$mpdf->Output('Current Withdrawal Signs/Symptoms.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>