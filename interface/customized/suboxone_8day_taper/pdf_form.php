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

    $sql = "SELECT * FROM form_suboxone_8day_taper WHERE id = $formid AND pid = $pid";
   
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
</div>";

ob_start();
 
        ?>
                     <table style="width:100%;border:1px solid black;border-bottom-style:none;"> 
                            <tr>
                                <td style="width:100%; ">
                                    <h3><b>Suboxone 8 day Taper/Heroin/Other Opioids DEA # RC0559611/ZC0559611A</b></h3>
                                </td>
                                  
                            </tr>
                        </table>
                        <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;border-collapse:collapse;text-align:center;">
                        <tr>
                                <td style="width:14%;border: 1px solid black;border-collapse:collapse;">Patient Name: <?php echo xlt($data['patient']);?></td>
                                <td colspan="6" style="border: 1px solid black;border-collapse:collapse;">DOB: <?php echo xlt($data['dob']);?></td>
                                <td style="border: 1px solid black;border-collapse:collapse;">Allergies: <?php echo xlt($data['allergy']);?></td>
                                <td style="width:10%;border: 1px solid black;border-collapse:collapse;"> </td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid black;border-collapse:collapse;">Medication, Dose, Frequency, Route</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Hour</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Nurse/Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Nurse/Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Nurse/Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Nurse/Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Nurse/Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Nurse/Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;"></th>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Suboxone 4mg SL BID and <b>8mg SL at 1230</b> on day of admission Date:<label><?php echo xlt($data['date1']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign1']);?></label>
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>12.30 PM</b></td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign2']);?></label>
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>4.00 PM</b></td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign3']);?></label>
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;">         
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>  
                            <tr>
                                <td style="border: 1px solid black;">Day 2 Suboxone 4mg SL BID and <b>6mg SL at 1230</b> Date:<label><?php echo xlt($data['date2']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                   
                                </td>
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign4']);?></label>
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td colspan="2" style="background-color:lightgray;"> 
                                   <p>BEFORE GIVING 1ST DOSE OF SUBOXONE ASSESS LAST USE AND AMOUNT. THEN CALL M.D TO GIVE SUBOXONE.</p>
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>12.30 PM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign5']);?></label>

                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>4.00 PM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                    
                                </td>
                                <td style="border: 1px solid black;">  
                                <label><?php echo xlt($data['ptsign6']);?></label>
       
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Day 3 Suboxone 4mg SL TID Date:<label><?php echo xlt($data['date3']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign7']);?></label>

                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>12.30 PM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 

                                </td> 
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign8']);?></label>

                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>4.00 PM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                    
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;">  
       
                                </td> 
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign9']);?></label>

                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Day 4 Suboxone 4mg SL BID and <b>2mg SL at noon</b> Date:<label><?php echo xlt($data['date4']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                                 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign10']);?></label>
                               </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>12.30 PM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign11']);?></label>
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>4.00 PM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                    
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;">  
       
                                </td> 
                                
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign12']);?></label>

                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Day 5 Suboxone 4mg SL BID Date:<label><?php echo xlt($data['date5']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                                 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign13']);?></label>
                               </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>4.00 PM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                    
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;">  
       
                                </td> 
                                
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                               
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign14']);?></label>

                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Order Date:</b> <?php echo xlt($data['orderdate']); ?></label>
                                </td>      
                            </tr>
                        </table>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td>
                                    <label><b>Nurse Transcribing:</b> <?php echo xlt($data['nurse']); ?></label>
                                </td> 
                                <td>
                                    <label><b>Patient Signature:</b> <?php echo xlt($data['ptsign']); ?></label>
                                </td> 
                                <td>
                                    <label><b>Patient Initials:</b> <?php echo xlt($data['ptinitial']); ?></label>
                                </td> 
                                <td>
                                    <label><b>Reason Medication Not Given</b></label>
                                    <ol>
                                        <li>Patient Refused</li>
                                        <li>Patient's Condition</li>
                                        <li>Hold Per MD Order</li>
                                    </ol> 
                                </td>        
                            </tr>
                        </table>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Verifying Nurse:</b> <?php echo xlt($data['nursever']); ?></label>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Nurse Signature:</b> <?php echo xlt($data['nursign']); ?></label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Nurse Initials:</b> <?php echo xlt($data['nurinitial']); ?></label>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Nurse Signature:</b> <?php echo xlt($data['nursign1']); ?></label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Nurse Initials:</b> <?php echo xlt($data['nurinitial1']); ?></label>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Nurse Signature:</b> <?php echo xlt($data['nursign2']); ?></label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Nurse Initials:</b> <?php echo xlt($data['nurinitial2']); ?></label>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;border-collapse:collapse;text-align:center;">
                            <tr>
                                <td style="width:16%;border: 1px solid black;border-collapse:collapse;">Patient Name: <?php echo xlt($data['patient1']);?></td>
                                <td colspan="6" style="border: 1px solid black;border-collapse:collapse;">DOB: <?php echo xlt($data['dob1']);?></td>
                                <td style="border: 1px solid black;border-collapse:collapse;">Allergies: <?php echo xlt($data['allergy1']);?></td>
                                <td style="border: 1px solid black;border-collapse:collapse;"> </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Day 6 Suboxone 2mg SL AM and <b>4mg SL PM</b> Date:<label><?php echo xlt($data['date6']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign15']);?></label>
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>4.00 PM</b></td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign16']);?></label>
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Day 7 Suboxone 2mg SL BID Date:<label><?php echo xlt($data['date7']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign17']);?></label>
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">
                                </td>
                                <td style="border: 1px solid black;"><b>4.00 PM</b></td>
                                
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign18']);?></label>
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Day 8 Suboxone 2mg SL in AM Date:<label><?php echo xlt($data['date8']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign19']);?></label>
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Order Date:</b> <?php echo xlt($data['orderdate1']); ?></label>
                                </td>      
                            </tr>
                        </table>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td>
                                    <label><b>Nurse Transcribing:</b> <?php echo xlt($data['nurse1']); ?></label>
                                </td> 
                                <td>
                                    <label><b>Patient Signature:</b> <?php echo xlt($data['patsign']); ?></label>
                                </td> 
                                <td>
                                    <label><b>Patient Initials:</b> <?php echo xlt($data['patinitial']); ?></label>
                                </td> 
                                <td>
                                    <label><b>Reason Medication Not Given</b></label>
                                    <ol>
                                        <li>Patient Refused</li>
                                        <li>Patient's Condition</li>
                                        <li>Hold Per MD Order</li>
                                    </ol> 
                                </td>        
                            </tr>
                        </table>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Verifying Nurse:</b> <?php echo xlt($data['nursever1']); ?></label>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Nurse Signature:</b> <?php echo xlt($data['nursign3']); ?></label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Nurse Initials:</b> <?php echo xlt($data['nurinitial3']); ?></label>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Nurse Signature:</b> <?php echo xlt($data['nursign4']); ?></label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Nurse Initials:</b> <?php echo xlt($data['nurinitial4']); ?></label>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Nurse Signature:</b> <?php echo xlt($data['nursign5']); ?></label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Nurse Initials:</b> <?php echo xlt($data['nurinitial5']); ?></label>
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
$mpdf->setTitle("Suboxone 8 day Taper/Heroin");
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

$mpdf->Output('Suboxone 8 day Taper/Heroin.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>