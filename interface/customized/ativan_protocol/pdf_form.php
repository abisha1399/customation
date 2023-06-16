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

    $sql = "SELECT * FROM form_ativan_protocol WHERE id = $formid AND pid = $pid";
   
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
                     <table style="width:100%;border:1px solid black;border-bottom-style:none;"> 
                            <tr>
                                <td style="width:70%; ">
                                    <h3><b>Ativan Protocol B DEA # FC8418750 Freehold</b></h3>
                                </td>
                                <td style="width:30%; ">
                                    <label><b>Allergies:</b> <?php echo xlt($data['allergy']);?></label>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;border-collapse:collapse;text-align:center;">
                        <tr>
                                <td style="border: 1px solid black;border-collapse:collapse;"><b>Patient Name:</b> <?php echo xlt($data['patient']);?></td>
                                <td colspan="7" style="border: 1px solid black;border-collapse:collapse;"><b>DOB:</b> <?php echo xlt($data['dob']);?></td>
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
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Ativan 1 mg PO TID on Day of Admission Date:<label><?php echo xlt($data['date1']);?></label>
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
                            </tr>  
                            <tr>
                                <td style="border: 1px solid black;">Ativan 1 mg PO TID on Day 2 Date:<label><?php echo xlt($data['date2']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                   
                                </td>
                                <td style="border: 1px solid black;"> 
                                <label><?php echo xlt($data['ptsign4']);?></label>
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
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
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Ativan 1 mg PO BID on Day 3 Date:<label><?php echo xlt($data['date3']);?></label>
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
                                <label><?php echo xlt($data['ptsign8']);?></label>

                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                               
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Ativan 1 mg PO BID on Day 4 Date:<label><?php echo xlt($data['date4']);?></label>
                                </td>
                                <td style="border: 1px solid black;"><b>9.30 AM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
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
                                <label><?php echo xlt($data['ptsign10']);?></label>

                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                            
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Ativan 1 mg PO in AM Day 5 Date:<label><?php echo xlt($data['date5']);?></label>
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
                                <label><?php echo xlt($data['ptsign11']);?></label>
                               </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>                                
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Ativan 1 mg PO every 2 hours <b>PRN</b> for signs and Symptoms of Withdraw (CIWA-Ar or B score>28) Pulse>95 or SBP >140 or DBP>95. Max 4 Doses in 24 hours.<b>HOLD</b> for SBP<90 or DBP<60 or Pulse<60.<label></label>
                                </td>
                                <td style="border: 1px solid black;"><b>PRN</b></td>
                                <td style="border: 1px solid black;">
                                    <label><?php echo xlt($data['prn1']);?></label> 
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['prn2']);?></label> 
                                </td>                                 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['prn3']);?></label> 
                                </td>                                
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['prn4']);?></label> 
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['prn5']);?></label> 
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['prn6']);?></label> 
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
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td>
                                    <label><b>Order Date:</b> <?php echo xlt($data['orderdate']); ?></label>
                                </td>      
                            </tr>
                        </table>
                        <br>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label><b>Nurse Transcribing:</b> <?php echo xlt($data['nurse']); ?></label>
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Patient Signature:</b>  
                                    <?php
                                    if($data['ptsign']!='')
                                    {
                                    echo '<img src="'.$data['ptsign'].'" style="width:20%;height:90px;">';
                                    }
                                     ?> </label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Patient Initials:</b> <?php echo xlt($data['ptinitial']); ?></label>
                                </td> 
                                       
                            </tr>
                        </table>
                        <br>                 
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
                                    <label><b>Nurse Signature:</b> 
                                    <?php
                                    if($data['nursign']!='')
                                    {
                                    echo '<img src="'.$data['nursign'].'" style="width:20%;height:90px;">';
                                    }
                                     ?>
                                     </label>
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
                                    <label><b>Nurse Signature:</b> 
                                    <?php
                                    if($data['nursign1']!='')
                                    {
                                    echo '<img src="'.$data['nursign1'].'" style="width:20%;height:90px;">';
                                    }
                                     ?>
                                    </label>
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
                                    <label><b>Nurse Signature:</b> 
                                    <?php
                                    if($data['nursign2']!='')
                                    {
                                    echo '<img src="'.$data['nursign2'].'" style="width:20%;height:90px;">';
                                    }
                                     ?>
                                     </label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Nurse Initials:</b> <?php echo xlt($data['nurinitial2']); ?></label>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label><b>Reason Medication Not Given</b></label>
                                    <ol>
                                        <li>Patient Refused</li>
                                        <li>Patient's Condition</li>
                                        <li>Hold Per MD Order</li>
                                    </ol> 
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
$mpdf->setTitle("Ativan Protocol");
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

$mpdf->Output('Ativan Protocol.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>