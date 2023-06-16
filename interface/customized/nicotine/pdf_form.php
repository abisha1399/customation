<?php
// ini_set("display_errors", 1);

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");


require_once("$srcdir/api.inc");

require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;


$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$nicotine_data = $formid ? formFetch("form_nicotine", $formid) : array();

use OpenEMR\Core\Header;
// $mpdf = new mPDF('utf-8','A5-P',8, 10,10,10, 75, 30, 4, 10);
$mpdf = new mPDF();
?>
<body id='body' class='body'>
<?php 
 
ob_start();
?><br />


<table style="width:100%" cellpadding="10" cellspacing="0">
<tr>
    <td style="width:60%">Name:<?php echo $nicotine_data['pat_name'] ??'' ?>
    </td>
    <td style="width:40%">Date:<?php echo $nicotine_data['form_date'] ??'' ?>
    </td>    
</tr>   
</table>
<br>
<h2><center><?php echo xlt('Fagerstrom Test for Nicotine Dependence (FTND) '); ?></center></h2>
<table style="width:100%" cellpadding="10" border="1" cellspacing="0">
<tr>
    <td colspan="2"></td>
     <td>0</td> 
     <td>1</td>  
     <td>2</td>  
     <td>3</td>    
</tr>
<tr>
    <td colspan="2">1. How soon after you wake up do you smoke your first cigarette? </td>
     <td><input type="radio" class="radio cigarette" value="0" data-id="cigarette" <?php echo isset($nicotine_data['first_cigarette'])&&$nicotine_data['first_cigarette']=='0'?'checked=checked':'';?> >After 60 Minutes</td> 
     <td><input type="radio" class="radio cigarette" value="1" data-id="cigarette" <?php echo isset($nicotine_data['first_cigarette'])&&$nicotine_data['first_cigarette']=='1'?'checked=checked':'';?>>After 60 Minutes</td>  
     <td><input type="radio" class="radio cigarette" value="2" data-id="cigarette" <?php echo isset($nicotine_data['first_cigarette'])&&$nicotine_data['first_cigarette']=='2'?'checked=checked':'';?>>After 60 Minutes</td>  
     <td><input type="radio" class="radio cigarette" value="3" data-id="cigarette" <?php echo isset($nicotine_data['first_cigarette'])&&$nicotine_data['first_cigarette']=='3'?'checked=checked':'';?>>After 60 Minutes</td> 
     
</tr>
<tr style="background-color: #c1c1c19c;">
    <td colspan="2">2. Do you find it difficult to refrain from smoking in places where it is forbidden, e.g., in church,at the library, cinema, etc?</td>
     <td><input type="radio" class="radio difficult_smoke" value="0" data-id="difficult_smoke" <?php echo isset($nicotine_data['difficult_smoke'])&&$nicotine_data['difficult_smoke']=='0'?'checked=checked':'';?>>No</td> 
     <td><input type="radio" class="radio difficult_smoke" value="1" data-id="difficult_smoke" <?php echo isset($nicotine_data['difficult_smoke'])&&$nicotine_data['difficult_smoke']=='1'?'checked=checked':'';?>>Yes</td>  
     <td></td>  
     <td></td> 
    
</tr>

<tr>
    <td colspan="2">3. Which cigarette would you hate most to give up? </td>
     <td><input type="radio" class="radio cigarette_hate" value="0" data-id="cigarette_hate" <?php echo isset($nicotine_data['cigarette_hate'])&&$nicotine_data['cigarette_hate']=='0'?'checked=checked':'';?>>All others</td> 
     <td><input type="radio" class="radio cigarette_hate" value="1" data-id="cigarette_hate" <?php echo isset($nicotine_data['cigarette_hate'])&&$nicotine_data['cigarette_hate']=='1'?'checked=checked':'';?>>The first one in the morning</td>  
     <td></td>  
     <td></td> 
    
</tr>
<tr style="background-color: #c1c1c19c;">
    <td colspan="2">4. How many cigarettes/day do you smoke?</td>
     <td><input type="radio" class="radio cigarette_value" value="0" data-id="cigarette_value" <?php echo isset($nicotine_data['cigarette_value'])&&$nicotine_data['cigarette_value']=='0'?'checked=checked':'';?>>10 or less</td> 
     <td><input type="radio" class="radio cigarette_value" value="1" data-id="cigarette_value" <?php echo isset($nicotine_data['cigarette_value'])&&$nicotine_data['cigarette_value']=='1'?'checked=checked':'';?>>11-20 </td>  
     <td><input type="radio" class="radio cigarette_value" value="2" data-id="cigarette_value" <?php echo isset($nicotine_data['cigarette_value'])&&$nicotine_data['cigarette_value']=='2'?'checked=checked':'';?>>21-30 </td> 
     <td><input type="radio" class="radio cigarette_value" value="3" data-id="cigarette_value" <?php echo isset($nicotine_data['cigarette_value'])&&$nicotine_data['cigarette_value']=='3'?'checked=checked':'';?>>31 or more</td>  
   
</tr> 
<tr>
    <td colspan="2">5. Do you smoke more frequently during the first hours of waking than during the rest of the day?</td>
     <td><input type="radio" class="radio frequently" value="0" data-id="frequently" <?php echo isset($nicotine_data['frequently'])&&$nicotine_data['frequently']=='0'?'checked=checked':'';?>>No</td> 
     <td><input type="radio" class="radio frequently" value="1" data-id="frequently" <?php echo isset($nicotine_data['frequently'])&&$nicotine_data['frequently']=='1'?'checked=checked':'';?>>Yes</td>  
     <td></td>  
     <td></td> 
    
</tr> 
<tr style="background-color: #c1c1c19c;">
    <td colspan="2">6. Do you smoke if you are so ill that you are in bed most of the  day? </td>
     <td><input type="radio" class="radio ill" value="0" data-id="ill" <?php echo isset($nicotine_data['illness'])&&$nicotine_data['illness']=='0'?'checked=checked':'';?>>No</td> 
     <td><input type="radio" class="radio ill" value="1" data-id="ill" <?php echo isset($nicotine_data['illness'])&&$nicotine_data['illness']=='1'?'checked=checked':'';?>>Yes</td>  
     <td></td>  
     <td></td> 
    
</tr>  
</table>  
<br>
<div >
<h4>total scrore:<?php echo $nicotine_data['total']??'';?></h4>
</div> 
<div style="margin-top:30px;font-size:20px;">
<h4 style="text-align:center">Scoring the Fagerstrom Test for Nicotine Dependence (FTND)</h4>
<p style="font-size;20px">In scoring the Fagerstrom Test for Nicotine Dependence, the three yes/no items are 
    scored 0 (no) and 1 (yes). The three multiple-choice items are scored from 0 to 3. 
    The items are summed to yield a total score of 0-10.
</p>
<table style="width:32%;">
    <tr>Classification of dependence:</tr>
    <tr style="font-size:20px;">
        <td>0-2</td>
        <td> Very low</td>                                       
    </tr>
    <tr style="font-size:20px;">
        <td>3-4</td>
        <td>low</td>                                       
    </tr>
    <tr style="font-size:20px;">
        <td>5</td>
        <td>Moderate</td>                                       
    </tr>
    <tr style="font-size:20px;">
        <td>6-7</td>
        <td>High </td>                                       
    </tr>
    <tr style="font-size:20px;">
        <td>8-10</td>
        <td>Very high </td>                                       
    </tr>
</table>       
</div>
        <?php 
        
        $html = ob_get_contents();
        ob_end_clean();
        // echo $html;die;
        $mpdf->setTitle("Personal drug");
        //$mpdf->SetHTMLHeader($header);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->defaultfooterline = 0;
        $mpdf->setFooter("Page: {PAGENO} of {nb}");
         //$mpdf->SetMargins(0,0,20);
        $mpdf->WriteHTML($html);

        //save the file put which location you need folder/filname
        $mpdf->Output("Personal drug.pdf", 'I');

        $mpdf->debug = true;
        //out put in browser below output function
        $mpdf->Output();
    ?> 
    </body>
</html>

