<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");


$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$name = $_GET['formname'];
$pid = $_SESSION["pid"];
$encounter = $_GET["encounter"];


$check_res =array();

    $sql = "SELECT * FROM `form_thiamine_folate` WHERE id = ?";
   
    $res = sqlStatement($sql, array($formid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

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
<table style="width:100%;background-color:#ccc;height:50px;">
<tr style="border-bottom:1px solid #000;width:100%;">
    <td style="width:30%;border:1px solid #000;padding:3px 0px 0px 5px;">
        <h4>Medication Log</h4>
    </td>
    <td style="width:70%;border:1px solid #000;padding:3px 0px 0px 5px;">
    <h4>
    DAILY MEDICATION
    </h4>
      
    </td>
</tr>
</table>
        <table style="border:1px solid #000;width:100%;table-layout:fixed;">
                            <tr style="border:1px solid #000;">
                                <th style="height:25px;"><label><b> Patient Name:</b>&ensp; 
                                <label><u><?php echo text($check_res['p_name']);?></u></label></th>
                                <th style="text-align:center;"><b> DOB:</b> &ensp;
                                <u><?php echo text($check_res['dob']);?></u></th>
                                <th style="text-align:center;"><b>Allgeries:</b>  &ensp;<u><?php echo text($check_res['alrg']);?></u></th>
                            </tr>
        </table>
        <table style="border-collapse:collapse;">
                            <tr style="border:1px solid #000;">
                                <th style="width: 20%;border:1px solid #000;">Medication, Dosage, Frequency & Route</th>
                                <th style="width: 6%;border:1px solid #000;">Time</th>
                                <th style="border:1px solid #000;">Date/RN Initials</th>
                                <th style="border:1px solid #000;">Patient Initials</th>
                                <th style="border:1px solid #000;">Date/RN Initials</th>
                                <th style="border:1px solid #000;">Patient Initials</th>
                                <th style="border:1px solid #000;">Date/RN Initials</th>
                                <th style="border:1px solid #000;">Patient Initials</th>
                                <th style="border:1px solid #000;">Date/RN Initials</th> 
                                <th style="border:1px solid #000;">Patient Initials</th> 
                                <th style="border:1px solid #000;">Date/RN Initials</th>
                                <th style="border:1px solid #000;">Patient Initials</th>
                            </tr>
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b> Thiamine 100mg PO Daily supplement</b>
                                </label>
                                </td>
                                <td  style="border:1px solid #000;"><b>NOW</b></td>                               
                                <td  style="border:1px solid #000;word-wrap: break-word"> 
                                    <?php echo text($check_res['input1']);?>
                                </td>                               
                                <td  style="border:1px solid #000;word-wrap: break-word"> 
                                    <?php echo text($check_res['input2']);?>
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                            </tr>
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b> Thiamine 100mg PO Daily supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>9:30 AM</b></td>                               
                                <td  style="border:1px solid #000;background-color:lightgray;"> 
                                </td>                               
                                <td  style="border:1px solid #000;background-color:lightgray;"> 
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                    <?php echo text($check_res['input3']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                    <?php echo text($check_res['input4']);?>                               
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                    <?php echo text($check_res['input5']);?>                               
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                    <?php echo text($check_res['input6']);?>                               
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                    <?php echo text($check_res['input7']);?>                               
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                    <?php echo text($check_res['input8']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                    <?php echo text($check_res['input9']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                    <?php echo text($check_res['input10']);?>
                                </td> 
                            </tr>
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b>Folate 1 mg PO  NOW supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>NOW</b></td>                               
                                <td  style="border:1px solid #000;word-wrap: break-word"> 
                                    <?php echo text($check_res['input11']);?>
                                </td>                               
                                <td  style="border:1px solid #000;word-wrap: break-word"> 
                                    <?php echo text($check_res['input12']);?>
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                                <td  style="border:1px solid #000;background-color:lightgray;">                               
                                </td> 
                            </tr>
                            
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b>Folate 1 mg PO Daily supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>9:30 AM</b></td>                               
                                <td  style="border:1px solid #000;background-color:lightgray;"> 
                                   
                                </td>                               
                                <td  style="border:1px solid #000;background-color:lightgray;"> 
                                    
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                <?php echo text($check_res['input13']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                <?php echo text($check_res['input14']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                <?php echo text($check_res['input15']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                <?php echo text($check_res['input16']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                <?php echo text($check_res['input17']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                <?php echo text($check_res['input18']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                <?php echo text($check_res['input19']);?>
                                </td> 
                                <td  style="border:1px solid #000;word-wrap: break-word">
                                <?php echo text($check_res['input20']);?>
                                </td> 
                            </tr>
                            <tr style="border:1px solid #000;height:40px;">
                                <td  style="border:1px solid #000;height:40px;"></td>
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td>
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                                <td  style="border:1px solid #000"></td> 
                            </tr>
                            
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b> Thiamine 100mg po Daily supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>9:30 AM</b></td>                               
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                <?php echo text($check_res['input21']);?>
                                </td>                               
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input23']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input24']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input25']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input26']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input27']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input28']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input29']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input30']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input31']);?>
                                </td> 
                            </tr>
                            
                            <tr style="border:1px solid #000;">
                                <td  style="border:1px solid #000;">
                                    <label><b>Folate 1mg  PO Daily supplement</b></label>
                                </td>
                                <td  style="border:1px solid #000;"><b>9:30 AM</b></td>                               
                                <td   style="border:1px solid ;word-wrap: break-word#000">    
                                <?php echo text($check_res['input32']);?>
                                </td>                               
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input33']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input34']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input35']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input36']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input37']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input38']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input39']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input40']);?>
                                </td> 
                                <td   style="border:1px solid #000;word-wrap: break-word">    
                                    <?php echo text($check_res['input41']);?>
                                </td> 
                            </tr>
</table><br><br>
<table style="width:100%">
<tr>
    <td style="width:25%">
    Order Date: <?php echo text($check_res['ord_date']);?>
</td>
<td style="width:25%">
    Patient Signature:<?php
                            if(check_res['psign1']!=''){
                                echo '<img src='.$check_res['psign1'].' style="width:20%;height:40px;" >';
                            }
                            ?>
    
</td>
<td style="width:32%">
    Patient Initials: <u><?php echo text($check_res['p_inp1']);?></u>
</td>
<td style="width:25%">
    <b>Reasons Medication not given</b>
</td>
</tr>

<tr>
    <td style="width:25%">
    Nurse transcribing orders: <u><?php echo text($check_res['n_trans']);?></u>
</td>
<td style="width:25%">
    Nurse Signature: <?php
                            if(check_res['n_sign1']!=''){
                                echo '<img src='.$check_res['n_sign1'].' style="width:20%;height:40px;" >';
                            }


                            ?>
</td>
<td style="width:25%">
    Nurse Initials: <u><?php echo text($check_res['n_inp1']);?></u>
</td>
<td style="width:25%">
    <p>1.Patient Refused</p>
    <p>2.Patient Condition</p>
    <p>3.Hold per MD order</p>

</td>
</tr>

<tr>
<td style="width:25%">
Verifying Nurse: <u><?php echo text($check_res['v_nurse']);?></u>
</td>
<td style="width:25%">
Nurse Signature: <?php
                        if(check_res['n_sign2']!=''){
                            echo '<img src='.$check_res['n_sign2'].' style="width:20%;height:40px;" >';
                        }
                        ?>
 
</td>
<td style="width:25%">
Nurse Initials: <u><?php echo text($check_res['n_inp2']);?></u>
</td>
</tr>


<tr>
<td style="width:25%">
</td>
<td style="width:25%">
Nurse Signature:<?php
                        if(check_res['n_sign3']!=''){
                            echo '<img src='.$check_res['n_sign3'].' style="width:20%;height:40px;" >';
                        }


                        ?>
 
</td>
<td style="width:25%">
Nurse Initials: <u><?php echo text($check_res['n_inp3']);?></u>
</td>
</tr>

<tr>
<td style="width:25%">
</td>
<td style="width:25%">
Nurse Signature:<?php
                        if(check_res['n_sign4']!=''){
                            echo '<img src='.$check_res['n_sign4'].' style="width:20%;height:40px;" >';
                        }
                        ?>
 
</td>
<td style="width:25%">
Nurse Initials: <u><?php echo text($check_res['n_inp4']);?></u>
</td>
</tr>

</table>

<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Thiamine and Folate Form");
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
