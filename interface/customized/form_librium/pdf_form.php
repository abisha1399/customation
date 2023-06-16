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


$check_res =array();

    $sql = "SELECT * FROM `form_librium` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'oxford_form.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>
<style>
    h2{
        text-align:center;
    }    
</style>
<body id='body' class='body'>
<?php
ob_start();
?>
<h4 style="text-align:center;">CENTRE FOR NETWORK THERAPHY<BR>20 Gibson Palace,Suite 103<br>Freehold,NJ 07728<BR>732-431-5800</h4>
<table style="width:100%">
<tr>
    <td style="width:70%;">
    <h3>Librium Protocol D DEA #FC8418750</h3>
</td>
<td style="width:30%">
<b>Allergies:</b>
<?php echo text($check_res['input1']);?>
</td>
</tr>
</table><br>

</table><br>
        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;font-size:40px;">
                            <tr>
                                <th style="width: 15%;"><label>Patient Name:</label> 
                               <span style="color:red"> <?php echo text($check_res['input2']);?></th>
                                <th colspan="7" style="text-align:center">DOB: 
                               <span style="color:red"> <?php echo text($check_res['input3']);?></th>
                            </tr>
                            <tr>
                                <th style="width: 20%;border:2px solid black;padding:20px;">Medication, Dosage, Frequency & Rotate</th>
                                <th style="border:2px solid black;padding:20px;">Hour</th>
                                <th style="border:2px solid black;padding:20px;">Nurse/Patient Initials</th>
                                <th style="border:2px solid black;padding:20px;">Nurse/Patient Initials</th>
                                <th style="border:2px solid black;padding:20px;">Nurse/Patient Initials</th>
                                <th style="border:2px solid black;padding:20px;">Nurse/Patient Initials</th>
                                <th style="border:2px solid black;padding:20px;">Nurse/Patient Initials</th>
                                <th style="border:2px solid black;padding:20px;">Nurse/Patient Initials</th>                                                              
                            </tr>
                            <tr>
                                <td style="border:2px solid black;padding:20px;">
                                    <label>Librium 10mg PO BID and <b>and 20<br>mg</b> PO at 1230 on admission<br>date   Date:  </label>  <b><?php echo text($check_res['input4']);?></b>
                                </td>
                                <td style="border:2px solid black;padding:20px;"><b>9.30 AM</b></td>                               
                                <td style="border:2px solid black;padding:20px;"> 
                                    <span style="color:red"> <?php echo text($check_res['input5']);?>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td style="border:2px solid black;padding:20px;">
                           <span style="color:red"> <?php echo text($check_res['input6']);?>
</td>
      <td style="border:2px solid black;padding:20px;"><b>12.30 PM</b></td>
      <td style="border:2px solid black;padding:20px;">
                       <span style="color:red"> <?php echo text($check_res['input7']);?>
</td>

<td style="background-color:lightgray;"> 
                                  
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                    
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 
                                 
      </tr>
      <tr>
      <td style="border:2px solid black;padding:20px;"> <span style="color:red"><?php echo text($check_res['input8']);?></span>
</td>
<td style="border:2px solid black;padding:20px;"><b>4.00 PM</b></td>
      <td style="border:2px solid black;padding:20px;"> <span style="color:red"><?php echo text($check_res['input9']);?></span>
</td>
                                  <td style="background-color:lightgray;"> 
                                  
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                    
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 

    </tr>

    <tr>
                                <td style="border:2px solid black;padding:20px;">
                                    <label>Librium 10mg PO TID <br>day2   Date: <b> </label><span style="color:red"> <?php echo text($check_res['input10']);?></b>
                                </td>
                                <td style="border:2px solid black;padding:20px;"><b>9.30 AM</b></td>    
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>                            
                                <td style="border:2px solid black;padding:20px;"> 
                                  <span style="color:red"> <?php echo text($check_res['input11']);?>
                                </td> 
                               
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td style="border:2px solid black;padding:20px;">
                          <span style="color:red"> <?php echo text($check_res['input12']);?>
</td>
      <td style="border:2px solid black;padding:20px;"><b>12.30 PM</b></td>
      <td style="background-color:lightgray;"> 
                                  
                                  </td> 

      <td style="border:2px solid black;padding:20px;">
                           <span style="color:red"> <?php echo text($check_res['input13']);?>
</td>

                                  <td style="background-color:lightgray;"> 
                                    
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 
                                 
      </tr>
      <tr>
      <td style="border:2px solid black;padding:20px;"><span style="color:red"><?php echo text($check_res['input14']);?></span>
</td>
<td style="border:2px solid black;padding:20px;"><b>4.00 PM</b></td>
<td style="background-color:lightgray;"> 
                                  
                                  </td> 

      <td style="border:2px solid black;padding:20px;"><span style="color:red"><?php echo text($check_res['input15']);?></span>
</td>
                                  <td style="background-color:lightgray;"> 
                                    
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 

    </tr>

    <tr>
                                <td style="border:2px solid black;padding:20px;">
                                    <label>Librium 10mg PO BID <br>day3   Date:  <b></label> <span style="color:red"> <?php echo text($check_res['input16']);?></b>
                                </td>
                                <td style="border:2px solid black;padding:20px;"><b>9.30 AM</b></td>    
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>     
                                  
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>                        
                                <td style="border:2px solid black;padding:20px;"> 
                                   <span style="color:red"> <?php echo text($check_res['input17']);?>
                                </td> 
                               
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td style="border:2px solid black;padding:20px;">
                           <span style="color:red"> <?php echo text($check_res['input18']);?>
</td>
<td style="border:2px solid black;padding:20px;"><b>4.00 PM</b></td>
      <td style="background-color:lightgray;"> 
                                  
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                    
                                    </td> 

      <td style="border:2px solid black;padding:20px;">
                          <span style="color:red"> <?php echo text($check_res['input19']);?>
</td>

                              
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 
                                 
      </tr>

      <tr>
                                <td style="border:2px solid black;padding:20px;">
                                    <label>Librium 10mg PO BID <br>day4   Date: <b> </label><span style="color:red"> <?php echo text($check_res['input20']);?></b>
                                </td>
                                <td style="border:2px solid black;padding:20px;"><b>9.30 AM</b></td>    
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>     
                                  
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                   
                                   </td>                         
                                <td style="border:2px solid black;padding:20px;"> 
                                <span style="color:red"> <?php echo text($check_res['input21']);?>
                                </td> 
                               
                                                           
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td style="border:2px solid black;padding:20px;">
                            <span style="color:red"> <?php echo text($check_res['input22']);?>
</td>
<td style="border:2px solid black;padding:20px;"><b>4.00 PM</b></td>
      <td style="background-color:lightgray;"> 
                                  
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                    
                                    </td> 
                                    
                                  <td style="background-color:lightgray;"> 
                                     
                                     </td>   

      <td style="border:2px solid black;padding:20px;">
                          <span style="color:red"> <?php echo text($check_res['input23']);?>
</td>

                                                           
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 
                                 
      </tr>

      <tr>
                                <td style="border:2px solid black;padding:20px;">
                                    <label>Librium 10mg PO BID <br>day5   Date:  <b></label><span style="color:red"> <?php echo text($check_res['input24']);?></b>
                                </td>
                                <td style="border:2px solid black;padding:20px;"><b>9.30 AM</b></td>    
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>     
                                  
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                   
                                   </td>                         
                                   <td style="background-color:lightgray;"> 
                                   
                                   </td>
                                   <td style="border:2px solid black;padding:20px;">
                         <span style="color:red"> <?php echo text($check_res['input25']);?>
</td>
<td style="background-color:lightgray;"> 
                                   
                                   </td>
</tr>
<tr>
                                <td style="border:2px solid black;padding:20px;">
                                    <label>Librium 10mg PO Q2 <br>hours PRN signs/symptoms<br> of alcohol withdrawal(CIWA-Ar or Bscore>28)<br>  or one of the following Pulse>95,SBP>140<br>,DBP>95.Maximum 10 doses in 24 hours.HOLD for (SBP less than90,<br>DBP less than 60,P less than 60. </label>
                                </td>
                                <td style="border:2px solid black;padding:20px;"><b>PRN</b></td>   
                                <td style="border:2px solid black;padding:20px;">
                           <span style="color:red"> <?php echo text($check_res['input26']);?>
</td>     <td style="border:2px solid black;padding:20px;">
                           <span style="color:red"> <?php echo text($check_res['input27']);?>
</td>     <td style="border:2px solid black;padding:20px;">
                           <span style="color:red"> <?php echo text($check_res['input28']);?>
</td>
<td style="border:2px solid black;padding:20px;">
                           <span style="color:red"> <?php echo text($check_res['input29']);?>
</td>     <td style="border:2px solid black;padding:20px;">
                           <span style="color:red"> <?php echo text($check_res['input30']);?>
</td>     <td style="border:2px solid black;padding:20px;">
                           <span style="color:red"> <?php echo text($check_res['input31']);?>
</td>



  

    

</table><br><br>

<table style="width:100%">
<tr>
    <td style="width:25%">
    Order Date:<span style="color:red"><?php echo text($check_res['input32']);?></span>
</td>
<td style="width:25%">
    Patient Signature:<span style="color:red"><img src='data:image/png;base64,<?php echo xlt($check_res['input33']); ?>' width='100px' height='50px'/> </span>
</td>
<td style="width:25%">
    Patient Initials:<span style="color:red"><?php echo text($check_res['input34']);?></span>
</td>
<td style="width:25%">
    <b>Reasons Medication not given</b>
</td>
</tr>
<tr>
    <td style="width:25%">
    Nurse transcribing orders:<span style="color:red"><?php echo text($check_res['input35']);?></span>
</td>
<td style="width:25%">
    Patient Signature:<span style="color:red"><img src='data:image/png;base64,<?php echo xlt($check_res['input36']); ?>' width='100px' height='50px'/> </span>
</td>
<td style="width:25%">
    Patient Initials:<span style="color:red"><?php echo text($check_res['input37']);?></span>
</td>
<td style="width:25%">
    <p>1.Patient Refused</p>
    <p>2.Patient Condition</p>
    <p>3.Hold per MD order</p>

</td>
</tr><tr>
    <td style="width:25%">
    Verifying Nurse:<span style="color:red"><?php echo text($check_res['input38']);?></span>
</td>
<td style="width:25%">
    Patient Signature:<span style="color:red"><img src='data:image/png;base64,<?php echo xlt($check_res['input39']); ?>' width='100px' height='50px'/> </span>
</td>
<td style="width:25%">
    Patient Initials:<span style="color:red"><?php echo text($check_res['input40']);?></span>
</td>
</tr>
<tr>
    <td style="width:25%">
</td>
<td style="width:25%">
    Patient Signature:<span style="color:red"><img src='data:image/png;base64,<?php echo xlt($check_res['input41']); ?>' width='100px' height='50px'/> </span>
</td>
<td style="width:25%">
    Patient Initials:<span style="color:red"><?php echo text($check_res['input42']);?></span>
</td>
</tr>
</table><br><br>



<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("librium Form");
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

$mpdf->Output('test.pdf', 'I');
// header("Location:7%.border:2px solid black;./../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();

?>
