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

    $sql = "SELECT * FROM `tuberculin_form` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
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
$header ="<div style='color:white;background-color:grey;text-align:center'>
<H2>Center for Network Theropey <br> 20 Gibson Place,Suite 103 <br> Freeehold,Nj07728 <br>732-431-5800
</H2>
</div>";
ob_start();
?>
<table style="border:1px solid black;width:100%;border-collapse:collapse;">
<tr>
       <td  style="border:1px solid black;">
           <h4>Date:</h4>
            <?php echo text($check_res['input1']); ?> 
       </td>
    </tr>
    <tr>
    <td style="border:1px solid black;">
           <h4>Time:</h4>
            <?php echo text($check_res['input2']); ?> 
       </td>
    </tr>
    <tr>
    <td style="border:1px solid black;">
           <h4>Date/Time of Mantoux Read:</h4>
            <?php echo text($check_res['input3']); ?> 
       </th>
    </tr>
    <tr>
    <td style="border:1px solid black;">
           <h4>Result:</h4>
            <?php echo text($check_res['input4']); ?> 
       </th>
    </tr>
    <tr>
    <td style="border:1px solid black;">
           <h4>Signature of Licensed RN:</h4>
            <?php if($check_res['input5']!='')
                  {
                  echo '<img src="'.$check_res['input5'].'" style="width:20%;height:90px;">';
                  }
             ?>  
       </td>
    </tr>
    </table>
<br/><br/>
    <table style="width:100%;text-align:center;">
    <tr><td>
       <h3>Tuberculin Skin Test</h3>
   <h3>Nursing Department
</h3>
               </td></tr>
</table>
<table style="width:100%;">
    <tr>
    <td style="">
           <h4>Client Name:</h4>
           <p><?php echo text($check_res['input6']); ?></p>
       </th>
    </tr>
</table>
<table style="border:1px solid black;width:100%;border-collapse:collapse;">
      <tr>
          <th style="border:1px solid black;">
             <h4>Mantoux Given</h4>
             
          </th>
          <th style="border:1px solid black;">
             <h4>Mantoux Read</h4>
          </th>
      </tr>
      <tr>
          <th style="border:1px solid black;">
             <h4>Date</h4>
             <p><?php echo text($check_res['input7']); ?></p>
          </th>
          <th style="border:1px solid black;">
             <h4>Date</h4>
             <p><?php echo text($check_res['input8']); ?></p>
          </th>
      </tr>
      <tr>
          <th style="border:1px solid black;">
             <h4>time</h4>
             <p><?php echo text($check_res['input9']); ?></p>
          </th>
          <th style="border:1px solid black;">
             <h4>time</h4>
             <p><?php echo text($check_res['input10']); ?></p>
          </th>
      </tr>
      <tr>
          <th style="border:1px solid black;">
             <h4>site</h4>
             <p><?php echo text($check_res['input11']); ?></p>
          </th>
          <th style="border:1px solid black;">
             <h4>Negative</h4>
             <p><?php echo text($check_res['input12']); ?></p>
          </th>
      </tr>
      <tr>
          <th style="border:1px solid black;">
             <h4>Manufacture</h4>
             <p><?php echo text($check_res['input13']); ?></p>
          </th>
          <th style="border:1px solid black;">
             <h4>positive</h4>
             <p><?php echo text($check_res['input14']); ?></p> mm of  <p><?php echo text($check_res['input15']); ?></p>
          </th>
      </tr>
      <tr>
          <th style="border:1px solid black;">
             <h4>Expiration Date</h4>
             <p><?php echo text($check_res['input16']); ?></p>
          </th>
          <th style="border:1px solid black;">
             <h4>LOt#</h4>
             <p><?php echo text($check_res['input17']); ?></p>
          </th>
      </tr>
      <tr>
          <th style="border:1px solid black;">
             <h4>Nurse/Md signature</h4>
             <p><?php if($check_res['input18']!='')
                  {
                  echo '<img src="'.$check_res['input18'].'" style="width:20%;height:90px;">';
                  }
             ?></p>
          </th>
          <th style="border:1px solid black;">
             <h4>Nurse/Md signature</h4>
             <p><?php if($check_res['input19']!='')
                  {
                  echo '<img src="'.$check_res['input19'].'" style="width:20%;height:90px;">';
                  }
             ?></p>
          </th>
      </tr>
</table>
<br/></br/>
<table style="border:1px solid black;width:100%;border-collapse:collapse;">
<tr>
   <td>
      <p>POSITIVE MANTOUX TEST,REFFERED FOR X-RAY</p>
   </td>
</tr>
  <tr>
      <td style="border:1px solid black;">
           <h4>Date of x-ray:</h4>
           <p><?php echo text($check_res['input20']); ?></p>
      </td>
      </tr>
      <tr>
      <td style="border:1px solid black;">
           <h4>Result:</h4>
           <p><?php echo text($check_res['input21']); ?></p> <br> <p><?php echo text($check_res['input22']); ?></p>
      </td>
      </tr>
      <tr>
      <td style="border:1px solid black;">
           <h4>Interventions:</h4>
           <p><?php echo text($check_res['input23']); ?></p>
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

