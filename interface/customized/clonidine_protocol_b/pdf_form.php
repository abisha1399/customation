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

    $sql = "SELECT * FROM form_clonidine_protocol_b WHERE id = $formid";
   
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
 <h4 style='text-align:center;'>Center for Network Therapy</h4>
  
</div>";

ob_start();
 
        ?>
                    <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;text-align:center;">
                                    <h3> <b>Clonidine Protocol B</b> </h3>
                                </td>   
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:50%;">
                                     
                                </td>  
                                <td style="width:50%;">
                                    <label><b>Allergies:</b> <?php echo xlt($data['allergy']); ?></label>
                                </td>    
                            </tr>
                        </table>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:50%;">
                                    <label><b>Patient Name:</b> <?php echo xlt($data['patient']); ?></label>
                                </td>  
                                <td style="width:50%;">
                                    <label><b>DOB:</b> <?php echo xlt($data['date']); ?></label>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;table-layout:fixed;display:table;border:1px solid black;border-collapse:collapse;text-align:center;">
                            <tr>
                                <th style="border: 1px solid black;border-collapse:collapse;">Medication, Dose, Frequency, Route</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Hour</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Date/Time</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Nurse/Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Date/Time</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Nurse/Patient Initials</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Date/Time</th>
                                <th style="border: 1px solid black;border-collapse:collapse;">Nurse/Patient Initials</th>
                            </tr>
                            <tr>
                                <td>Vitals Signs prn Clonidine</td>
                                <td style="border: 1px solid black;">PRN</td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate1']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse1']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate2']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse2']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate3']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse3']);?></label>
                                </td> 
                            </tr>
                            <tr>
                                <td>0.05 mg PO Q 2 hours PRN for Signs</td>
                                <td style="border: 1px solid black;">PRN</td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate4']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse4']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate5']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse5']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate6']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse6']);?></label>
                                </td> 
                            </tr>
                            <tr>
                                <td>and Symptoms of Opioid Withdraw (abdominal/muscle cramping,</td>
                                <td style="border: 1px solid black;">PRN</td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate7']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse7']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate8']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse8']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate9']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse9']);?></label>
                                </td> 
                            </tr>    
                            <tr>
                                <td>N/V, diarrhea, joint pain, lacrimation, rhinorrhea) or</td>
                                <td style="border: 1px solid black;">PRN</td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate10']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse10']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate11']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse11']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate12']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse12']);?></label>
                                </td> 
                            </tr>    
                            <tr>
                                <td> one of the following. pulse>95, SBP>140,</td>
                                <td style="border: 1px solid black;">PRN</td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate13']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse13']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate14']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse14']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate15']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse15']);?></label>
                                </td> 
                            </tr>    
                            <tr>
                                <td>DBP>95. Max 10 doses in 24 hours.</td>
                                <td style="border: 1px solid black;">PRN</td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate16']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse16']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate17']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse17']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate18']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse18']);?></label>
                                </td> 
                            </tr>    
                            <tr>
                                <td><b>Hold</b> for SBP<90, DBP<60, Pulse<60.</td>
                                <td style="border: 1px solid black;">PRN</td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate19']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse19']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate20']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse20']);?></label>
                                </td> 
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['clonidate21']);?></label>
                                </td>
                                <td style="border: 1px solid black;"> 
                                    <label><?php echo xlt($data['cloninurse21']);?></label>
                                </td> 
                            </tr>        
                        </table>  
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label><b>Order Date:</b> <?php echo xlt($data['orderdate']); ?></label>
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
                        <br/>
                        <table style="width:100%;margin-top:6px;"> 
                            <tr>
                                <td style="width:30%;">
                                    <label><b>Verifying Nurse:</b> <?php echo xlt($data['nurse']); ?></label>
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
                        <table style="margin-top: 6px;"> 
                            <tr>
                                <td style="width:100%;"> 
                                    <label><b>Reason Medication Not Given</b></label>
                                    <ol>
                                        <li><input type=checkbox name='reason1' value="" <?php if ($data["reason1"] == "0") {echo "checked='checked'";} else {echo '';} ?>> Patient Refused</li>
                                        <li><input type=checkbox name='reason2' value="" <?php if ($data["reason2"] == "0") {echo "checked='checked'";} else {echo '';} ?>> Patient's Condition</li>
                                        <li><input type=checkbox name='reason3' value="" <?php if ($data["reason3"] == "0") {echo "checked='checked'";} else {echo '';} ?>> Hold Per MD Order</li>
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