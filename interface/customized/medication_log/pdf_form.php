<html>
  <head>
  <link rel="stylesheet" href="./style.css">
</head>

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
$pid = $_SESSION['pid'];
$encounter = $_GET["encounter"];
$data =array();

if ($formid) {
    $sql = "SELECT * FROM form_medication_log WHERE id = ? AND pid = ?";
    $res = sqlStatement($sql, array($formid,$pid));
    // $data = sqlFetchArray($res);
    // print_r($data);die;

    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
      $all[$iter] = $row;
  }
  $check_res = $all[0];
}
    $check_res = $formid ? $check_res : array();
    // print_r($check_res);die;
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Medication Log Form</h2>
</div>";
ob_start();
 ?>

<div class="container mt-3">
      <div class="row">
        <div class="container-fluid">

<table style="width: 100%; border: 1px solid black;">
    <tr>
        <td><b>Medication Log</b>
            
        </td>
        <td>
            <b style="font-size: 8px;float: right;">PRN Medication</b>
        </td>
        
    </tr>
</table>
<table style="width: 100%; border: 1px solid black;">
    <tr>
        <td>
            Patient Name:<?php echo $check_res['inp154'];?>
        </td>
        <td>
            DOB:<?php echo $check_res['inp155'];?>
        </td>
        <td>
            Allergies:<?php echo $check_res['inp156'];?>
        </td>
        
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;">
        <b>Medication,Dose,Frequency & Route</b>
        
      </td>
       <td style="border: 1px solid black;">
        Date/Time/RN Initials(Site for IM Injection)
        
      </td>   
               <td style="border: 1px solid black;">
                Patient
                Initials
        
      </td>          
        <td style="border: 1px solid black;">
        Date/Time/RN Initials(Site for IM Injection)
      </td>         
         <td style="border: 1px solid black;">
         Patient
                Initials
      </td>           
       <td style="border: 1px solid black;">
        Date/Time/RN Initials(Site for IM Injection)
      </td>          
        <td style="border: 1px solid black;">
        Patient
                Initials
      </td>           
       <td style="border: 1px solid black;"> 
         Date/Time/RN Initials(Site for IM Injection)
      </td>            
      <td style="border: 1px solid black;">
        Patient
                Initials
      </td>            
      <td style="border: 1px solid black;">
        Date/Time/RN Initials(Site for IM Injection)
      </td>           
       <td style="border: 1px solid black;">
        Patient
                Initials
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
        <p style="font-size: 8px;" > Motrin 600mg PO Q $hours, PRN Discomfort,
Max 4 doses per 24 hrs.</p>
        
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp1'];?>
      </td>   
               <td style="border: 1px solid black;">
                
               <?php echo $check_res['inp2'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp3'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp4'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp5'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp6'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp7'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp8'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp9'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp10'];?>
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
        <p style="font-size: 8px;">   Tylenol 500mg PO Q 4 hours,PRN
Headache/Fever(>than 101'F):Max 4 doses
per 24hrs.</p>
        
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp11'];?>
      </td>   
               <td style="border: 1px solid black;">
                
               <?php echo $check_res['inp12'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp13'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp14'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp15'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp16'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp17'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp18'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp19'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp20'];?>
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
    <p style="font-size: 8px;" > Reglan 10mg IM Q6 PRN for Nausea Max 4
doses in 24hrs</p>
        
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp21'];?>
      </td>   
               <td style="border: 1px solid black;">
                
               <?php echo $check_res['inp22'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp23'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp24'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp25'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp26'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp27'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp28'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp29'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp30'];?>
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
        <p style="font-size: 10px;">Reglan 15mg PO Q 1 hour, PRN GI Distress
Max 8 doses per 24hrs.</p>
        
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp31'];?>
      </td>   
               <td style="border: 1px solid black;">
               <?php echo $check_res['inp32'];?>   
        
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp33'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp34'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp35'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp36'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp37'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp38'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp39'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp40'];?>
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
        <p style="font-size: 10px;">   Maalox 30ml PO Q 1hour, PRN GI Distress,
Max 8 doses per 24hrs.</p>
        
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp41'];?>
      </td>   
               <td style="border: 1px solid black;">
               <?php echo $check_res['inp42'];?>
        
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp43'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp44'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp45'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp46'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp47'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp48'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp49'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp50'];?>
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
        <p style="font-size: 10px;"> Robaxin 750mg PO Q 4 hours, PRN Muscle
        Spasms, Max 3 doses per 24hrs.</p>
        
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp51'];?>
      </td>   
               <td style="border: 1px solid black;">
               <?php echo $check_res['inp52'];?>
        
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp53'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp54'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp55'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp56'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp57'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp58'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp59'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp60'];?>
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
        <p style="font-size: 10px;"> Hydroxyzine Pamoate(Vistaril) 50mg PO Q 4<br>
        hours,PRN Anxiety,<u>Max 3 doses per 24 <br>hours</u>for pt's<30yrs,<u>Max 2 doses per 24<br>hoursfor pt's 30-50 and <u>Max 1 dose per 24 hours for adults >50 yrs x 10days.</ul></p>
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp61'];?>
      </td>   
               <td style="border: 1px solid black;">
                
               <?php echo $check_res['inp62'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp63'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp64'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp65'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp66'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp67'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp68'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp69'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp70'];?>
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
       <p style="font-size: 10px;"> Imodioum 2 mg PO Q 2hours,PRN Diarrhea,
Max 4 doses per 24hrs.</p>
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp71'];?>
      </td>   
               <td style="border: 1px solid black;">
                
               <?php echo $check_res['inp72'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp73'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp74'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp75'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp76'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp77'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp78'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp79'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp80'];?>
        
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
       <p style="font-size: 10px;"> MOM 30ml PO BID x 3days, PRN
        Constipation.</p>
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp81'];?>
      </td>   
               <td style="border: 1px solid black;">
               <?php echo $check_res['inp82'];?>      
        
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp83'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp84'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp85'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp86'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp87'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp88'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp89'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp90'];?>
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
       <p style="font-size: 10px;"> Ducolax 10mg PO BID x 3days,PRN
        Constipation if MOM doesn't Work.</p>
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp91'];?>
      </td>   
               <td style="border: 1px solid black;">
               <?php echo $check_res['inp92'];?>
        
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp93'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp94'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp95'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp96'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp97'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp98'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp99'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp100'];?>
      </td>
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
       <p style="font-size: 10px;"> Zofran ODT 8mg PO Q 8 hours, Max 2 doses
        in 24hrs for refractory to Tigan.</p>
      </td>

               <td style="border: 1px solid black;">
               <?php echo $check_res['inp101'];?>
        
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp102'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp103'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp104'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp105'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp106'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp107'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp108'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp109'];?>
      </td>
      <td style="border: 1px solid black;">
       <?php echo $check_res['inp110'];?>
      </td>   
    </tr>
</table>
<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
       <p style="font-size: 10px;">Promethazine 12.5mg PO Q4 PRN for nausea
        and vomiting max dose 3 in 24 hours.	
        </p>
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp111'];?>
      </td>   
               <td style="border: 1px solid black;">
                
               <?php echo $check_res['inp112'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp113'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp114'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp115'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp116'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp117'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp118'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp119'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp120'];?>
      </td>
    </tr>
</table>

<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
       <p style="font-size: 10px;">Promethazine HCL 25mg IM Q 6 PRN for
        nausea/vomiting. max 4 doses per 24 hours	
        </p>
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp121'];?>
      </td>   
               <td style="border: 1px solid black;">
                
               <?php echo $check_res['inp122'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp123'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp124'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp125'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp126'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp127'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp128'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp129'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp130'];?>
      </td>
    </tr>
</table>

<table style="width:100%;" class="tbl2">
    <tr>
      <td style="border: 1px solid black;width: 20%;">
       <p style="font-size: 10px;">Bentyl/Dicyclomine hydrochloride 10mg po
        q4pm max 4/24 hr abdominal cramps	
        </p>
      </td>
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp131'];?>
      </td>   
               <td style="border: 1px solid black;">
               <?php echo $check_res['inp132'];?>
        
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp133'];?>
      </td>         
         <td style="border: 1px solid black;">
         <?php echo $check_res['inp134'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp135'];?>
      </td>          
        <td style="border: 1px solid black;">
        <?php echo $check_res['inp136'];?>
      </td>           
       <td style="border: 1px solid black;"> 
       <?php echo $check_res['inp137'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp138'];?>
      </td>            
      <td style="border: 1px solid black;">
      <?php echo $check_res['inp139'];?>
      </td>           
       <td style="border: 1px solid black;">
       <?php echo $check_res['inp140'];?>
      </td>
    </tr>
</table>
<table>
    <tr>
        <td style="width: 25%;">Order Date:<?php echo $check_res['inp141'];?><br>
            Nursing Transcribing Orders:<?php echo $check_res['inp142'];?><br>
            Verifying Nurse:<?php echo $check_res['inp143'];?>
        </td>
        <td style="width: 25%;">Patient Signature:  <?php
                                    if($check_res['inp144']!='')
                                    {
                                    echo '<img src="'.$check_res['inp144'].'" style="width:20%;height:90px;">';
                                    }
                                     ?> 
            Nurse Signature :  <?php
                                    if($check_res['inp146']!='')
                                    {
                                    echo '<img src="'.$check_res['inp146'].'" style="width:20%;height:90px;">';
                                    }
                                     ?>  <br><br>
            Nurse Signature :  <?php
                                    if($check_res['inp148']!='')
                                    {
                                    echo '<img src="'.$check_res['inp148'].'" style="width:20%;height:90px;">';
                                    }
                                     ?>  <br>
            Nurse Signature : <?php
                                    if($check_res['inp150']!='')
                                    {
                                    echo '<img src="'.$check_res['inp150'].'" style="width:20%;height:90px;">';
                                    }
                                     ?>  <br>
            Nurse Signature : <?php
                                    if($check_res['inp152']!='')
                                    {
                                    echo '<img src="'.$check_res['inp152'].'" style="width:20%;height:90px;">';
                                    }
                                     ?>  <br>
        </td>
        <td style="width: 25%;">Patient Initials:<?php echo $check_res['inp145'];?><br>
            Patient Initials: <?php echo $check_res['inp147'];?><br>
            Patient Initials: <?php echo $check_res['inp149'];?><br>
            Patient Initials:<?php echo $check_res['inp151'];?><br>
            Patient Initials:<?php echo $check_res['inp153'];?><br>
        
        </td>
        <td style="width: 25%;"><b>Reason Medication Not given</b>
            <ul>
                <li>Patient Refused</li>
                <li>Patient's Condition</li>
                <li>Hold per MD's Order</li>
                
            </ul>
        </td>
    </tr>
</table>




        </div>
      </div>
</div>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Medication log Form");
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

$mpdf->Output("Medication log.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>