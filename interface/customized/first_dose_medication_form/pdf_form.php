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

    $sql = "SELECT * FROM `first_dose_form` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

    use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<style>
    h2{
        text-align:center;
    }    
</style>
<body id='body' class='body'>
<?php
$header ="<div style='color:white;background-color:grey;text-align:center'>
<H2>Center for Network Theropey <br> 20 Gibson Place,Suite 103 <br> Freeehold,Nj07728 <br>732-431-5800
</H2>
</div>";
ob_start();
?>


<table style="border:1px solid black; width:100%">
     <tr>
         <td>
             <b>patient name</b>
             <p><?php echo text($check_res['pname']); ?></p>
         </td>
         <td style="border:1px solid black;">
         <b>DOB:</b>
         <p><?php echo text($check_res['DOB']); ?></p>
      </td>
     </tr>
</table >
<table style="border:1px solid black; width:100%">
     <tr>
         <th>Medication</th>
         <th>Dose</th>
         <th>Date/Time Given</th>
         <th>Date/Time follow Up</th>
         <th>Side effects  discription</th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Ativan</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input1']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input2']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input3']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input4']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Bentyl</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input5']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input6']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input7']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input8']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Clonidine</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input9']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input10']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input11']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input12']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Dulcolox</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input13']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input14']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input15']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input16']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Folate</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input17']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input18']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input19']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input20']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Hydroxyzine</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input21']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input22']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input23']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input24']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Imodium</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input25']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input26']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input27']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input28']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Keppra</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input29']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input30']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input31']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input32']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Librium</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input33']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input34']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input35']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input36']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Maalex</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input37']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input38']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input39']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input40']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">MOM</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input41']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input42']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input43']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input44']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Neurontin</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input45']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input46']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input47']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input48']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Phenergan</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input49']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input50']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input51']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input52']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Robaxin</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input53']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input54']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input55']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input56']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Sabutex</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input57']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input58']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input59']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input60']); ?></p></th>
     </tr>
     <tr>
         <th style="border:1px solid black;">Thiamine</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input61']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input62']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input63']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input64']); ?></p></th>
     </tr> 
     <tr>
         <th style="border:1px solid black;">Tigan</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input65']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input66']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input67']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input68']); ?></p></th>
     </tr> 
     <tr>
         <th style="border:1px solid black;">Tylenol</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input69']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input70']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input71']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input72']); ?></p></th>
     </tr> 
     <tr>
         <th style="border:1px solid black;">Valium</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input73']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input74']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input75']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input76']); ?></p></th>
     </tr> 
     <tr>
         <th style="border:1px solid black;">Zolran</th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input77']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input78']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input79']); ?></p></th>
         <th style="border:1px solid black;"><p><?php echo text($check_res['input80']); ?></p></th>
     </tr> 
     
</table>
<br/>
<table style="border:1px solid black;border-collapse:collapse;">
   <tr>
       <th style="border:1px solid black;">
           <b>Nurse's Signature</b>
          <?php if($check_res['input81']){ ?>

       <p> <img src='data:image/png;base64,<?php echo xlt($check_res['input81']); ?>' width='100px' height='50px'/> </p>
       <?php }?>
       </th>
       <th style="border:1px solid black;">
           <b>Date</b>
       <p><?php echo text($check_res['input82']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>Time</b>
       <p><?php echo text($check_res['input83']); ?></p>
       </th>
       </tr>
       <tr>
       <th style="border:1px solid black;">
           <b>Nurse's Signature</b>
          <?php if($check_res['input84']){ ?>

       <p><img src='data:image/png;base64,<?php echo xlt($check_res['input84']); ?>' width='100px' height='50px'/> </p>
<?php } ?>
       </th>
       <th style="border:1px solid black;">
           <b>Date</b>
       <p><?php echo text($check_res['input85']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>Time</b>
       <p><?php echo text($check_res['input86']); ?></p>
       </th>
       </tr>
       <tr>
       <th style="border:1px solid black;">
           <b>Nurse's Signature</b>
          <?php if($check_res['input87']){ ?>
       <p><img src='data:image/png;base64,<?php echo xlt($check_res['input87']); ?>' width='100px' height='50px'/> </p>
          <?php } ?>
       </th>
       <th style="border:1px solid black;">
           <b>Date</b>
       <p><?php echo text($check_res['input88']); ?></p>
       </th>
       <th>
           <b>Time</b>
       <p><?php echo text($check_res['input89']); ?></p>
       </th>
       </tr>
       <tr>
       <th style="border:1px solid black;">
           <b>Nurse's Signature</b>
          <?php if($check_res['input90']){ ?>

       <p><img src='data:image/png;base64,<?php echo xlt($check_res['input90']); ?>' width='100px' height='50px'/> </p>
       <?php }?>
       </th>
       <th style="border:1px solid black;">
           <b>Date</b>
       <p><?php echo text($check_res['input91']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>Time</b>
       <p><?php echo text($check_res['input92']); ?></p>
       </th>
</tr>
       <tr>
       <th style="border:1px solid black;">
           <b>Nurse's Signature</b>
          <?php if($check_res['input93']){ ?>

       <p><img src='data:image/png;base64,<?php echo xlt($check_res['input93']); ?>' width='100px' height='50px'/> </p>
       <?php } ?>
       </th>
       <th style="border:1px solid black;">
           <b>Date</b>
       <p><?php echo text($check_res['input94']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>Time</b>
       <p><?php echo text($check_res['input95']); ?></p>
       </th>
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
$mpdf->setTitle("Reason Form");
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
// header("Location:../../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();