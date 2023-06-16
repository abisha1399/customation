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

    $sql = "SELECT * FROM form_daily_medication WHERE id = $formid AND pid = $pid";
   
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
                                <td style="width:40%; ">
                                    <h3><b>Medication Log</b></h3>
                                </td> 
                                <td style="width:60%; ">
                                    <h3><b>Daily Medication</b></h3>
                                </td> 
                            </tr>
                        </table>
                        <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;border-collapse:collapse;text-align:center;">
                            <tr>
                                <td style="border: 1px solid black;border-collapse:collapse;">Patient Name: <?php echo xlt($data['patient']);?></td>
                                <td colspan="7" style="border: 1px solid black;border-collapse:collapse;">DOB: <?php echo xlt($data['dob']);?></td>
                                <td style="border: 1px solid black;border-collapse:collapse;">Allergies: <?php echo xlt($data['allergy']);?></td>
                                <td colspan="3" style="border: 1px solid black;border-collapse:collapse;"> </td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid black;border-collapse:collapse;">Medication, Dose, Frequency, Route</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Time</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Date/RN Initial</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Date/RN Initial</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Date/RN Initial</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Date/RN Initial</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Date/RN Initial</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Patient Initials</th>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Thiamine 100mg PO NOW supplement</td>
                                <td style="border: 1px solid black;">NOW</td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date1']);?></label>
                                </td>
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
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Thiamine 100mg PO Daily supplement</td>
                                <td style="border: 1px solid black;"><b>9.30AM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date2']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign2']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date3']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign3']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date4']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign4']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date5']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign5']);?></label>
                                </td> 
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Folate 1mg PO NOW supplement</td>
                                <td style="border: 1px solid black;"><b>NOW</b></td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date6']);?></label>
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
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                            </tr> 
                            <tr>
                                <td style="border: 1px solid black;">Folate 1mg PO Daily supplement</td>
                                <td style="border: 1px solid black;"><b>9.30AM</b></td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td>
                                <td style="border: 1px solid black;background-color:lightgray;"> 
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date7']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign7']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date8']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign8']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date9']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign9']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date10']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign10']);?></label>
                                </td> 
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext1']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext2']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext3']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext4']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext5']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext6']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext7']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext8']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext9']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext10']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext11']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['pttext2']);?></label>
                                </td> 
                            </tr>    
                            <tr>
                                <td style="border: 1px solid black;">Thiamine 100mg PO Daily supplement</td>
                                <td style="border: 1px solid black;"><b>9.30AM</b></td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date12']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign12']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date13']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign13']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date14']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign14']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date15']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign15']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date16']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign16']);?></label>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Folate 1mg PO Daily supplement</td>
                                <td style="border: 1px solid black;"><b>9.30AM</b></td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date17']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign17']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date18']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign18']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date19']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign19']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date20']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign20']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['date21']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['ptsign21']);?></label>
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
                                <td style="width:50%;">
                                    <label><b>Nurse Transcribing Orders:</b> <?php echo xlt($data['nurse']); ?></label>
                                </td> 
                                <td style="width:10%;">
                                     
                                </td> 
                                <td style="width:40%;">
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
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Patient Signature:</b> <?php
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
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Nurse Signature:</b> <?php
                                    if($data['nursign']!='')
                                    {
                                    echo '<img src="'.$data['nursign'].'" style="width:20%;height:90px;">';
                                    }
                                     ?>  </label>
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
                                    <label><b>Nurse Signature:</b> <?php
                                    if($data['nursign1']!='')
                                    {
                                    echo '<img src="'.$data['nursign1'].'" style="width:20%;height:90px;">';
                                    }
                                     ?> </label>
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
                                    <label><b>Nurse Signature:</b> <?php
                                    if($data['nursign2']!='')
                                    {
                                    echo '<img src="'.$data['nursign2'].'" style="width:20%;height:90px;">';
                                    }
                                     ?> </label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Nurse Initials:</b> <?php echo xlt($data['nurinitial2']); ?></label>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td> 
                                <td style="width:40%;">
                                    <label><b>Nurse Signature:</b> <?php
                                    if($data['nursign3']!='')
                                    {
                                    echo '<img src="'.$data['nursign3'].'" style="width:20%;height:90px;">';
                                    }
                                     ?> </label>
                                </td> 
                                <td style="width:30%;">
                                    <label><b>Nurse Initials:</b> <?php echo xlt($data['nurinitial3']); ?></label>
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
$mpdf->setTitle("Daily Medication");
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

$mpdf->Output('Daily Medication.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>