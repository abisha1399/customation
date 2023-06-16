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
$drug_data = $formid ? formFetch("form_personal_drug", $formid) : array();

use OpenEMR\Core\Header;
// $mpdf = new mPDF('utf-8','A5-P',8, 10,10,10, 75, 30, 4, 10);
$mpdf = new mPDF();
?>
<body id='body' class='body'>
<?php 
 
ob_start();
?><br />

<center><h2>Personal Drug Use Questionnaire</h2></center>
<p>INSTRUCTIONS: Please read the following statements carefully.Each one describes a way that you might (or might not) feel about your drug use. For each statement, circle one number from 1 to 5, to indicate how much you agree or disagree with it right now. Please circle one and only one number for every statement</p>
<div class="row">
    <center>FOR OFFICE USE ONLY </center>
    <ul style="list-style:none;">
        <li><?php echo isset($drug_data['study'])?$drug_data['study']:'';?>:Study</li>
        <li><?php echo isset($drug_data['main_id'])?$drug_data['main_id']:'';?>ID</li>
        <li><?php echo isset($drug_data['point'])?$drug_data['point']:'';?>Point</li>
        <li><?php echo isset($drug_data['main_date'])?$drug_data['main_date']:'';?>Date</li>
        <li><?php echo isset($drug_data['raid'])?$drug_data['raid']:'';?>Raid</li>
    </ul>    
     
</div>
<table class="table" border='1'>
    <tr>
        <td>
            
        </td>
        <td>
            <b>NO!</b><br>Strongly Disagree
        </td>  
        <td>
            <b>NO!</b><br>Disagree
        </td> 
        <td>
            <b>?</b><br>Undecided or Unsure<br>
        </td> 
        <td>
            <b>Yes!</b><br>Agree<br>
        </td> 
       <td>
            <b>YES!</b><br>Strongly Agree<br>
        </td>  
    </tr>
    <!-- question start    -->
    <tr>
        <td>
       1. I really want to make changes in my use of drugs
        </td>
             
        <td><input type="radio"  class="radio" name="drugpoint_1" value="1" <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_1" value="2"  <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_1" value="3"  <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_1" value="4"  <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_1" value="5"  <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='5'?'checked=checked':'';?>>5</td>   
    </tr>   
                                
    <tr>
        <td>
        2. Sometimes I wonder if I am an addict.
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_2" value="1"  <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_2" value="2"  <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_2" value="3"  <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_2" value="4"  <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_2" value="5"   <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='5'?'checked=checked':'';?>>5</td>   
    </tr>   
    <tr>
        <td>3. If I don’t change my drug use soon, my problems are going to get worse.</td>
        <td><input type="radio"  class="radio" name="drugpoint_3" value="1"  <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_3" value="2"  <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_3" value="3"  <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_3" value="4"  <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_3" value="5"   <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='5'?'checked=checked':'';?>>5</td>   
    </tr>   
    <tr>
        <td>
        4. I have already started making some changes in my use of drugs
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_4" value="1"  <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_4" value="2"  <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_4" value="3"  <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_4" value="4"  <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_4" value="5"   <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='5'?'checked=checked':'';?>>5</td>   
    </tr>   

    <tr> 
        <td> 5. I was using drugs too much at one time,but I’ve managed to change that</td>
        <td><input type="radio"  class="radio" name="drugpoint_5" value="1"  <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='1'?'checked=checked':'';?>> 1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_5" value="2"  <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_5" value="3"  <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_5" value="4"  <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_5" value="5"   <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 

    
    <tr>
        <td>
        6. Sometimes I wonder if my drug use is hurting other people
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_6" value="1"  <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_6" value="2"  <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_6" value="3"  <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_6" value="4"  <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_6" value="5"   <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='5'?'checked=checked':'';?>>5</td>   
    </tr>   

    <tr>
        <td>
        7. I have a drug problem.
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_7" value="1"  <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_7" value="2"  <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_7" value="3"  <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_7" value="4"  <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_7" value="5"   <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 
    <tr>
        <td>8.I’m not just thinking about changing my drug use, I’m already doing something about it.
        <td><input type="radio"  class="radio" name="drugpoint_8" value="1"  <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_8" value="2"  <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_8" value="3"  <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_8" value="4"  <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_8" value="5"   <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 
                                
    <tr>
        <td>9. I have already changed my drug use, and I am looking for ways to keep from slipping back to my old pattern</td>
        <td><input type="radio"  class="radio" name="drugpoint_9" value="1"  <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_9" value="2"  <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_9" value="3"  <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_9" value="4"  <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_9" value="5"   <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 
    <tr>
        <td>
        10. I have serious problems with drugs
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_10" value="1"  <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_10" value="2"  <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_10" value="3"  <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_10" value="4"  <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_10" value="5"   <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 
        <tr>
        <td>
        11. Sometimes I wonder if I am in control of my drug use
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_11" value="1"  <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_11" value="2"  <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_11" value="3"  <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_11" value="4"  <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_11" value="5"   <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 
    <tr>
        <td>12. My drug use is causing a lot of harm.</td>
        <td><input type="radio"  class="radio" name="drugpoint_12" value="1"  <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_12" value="2"  <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_12" value="3"  <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_12" value="4"  <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_12" value="5"   <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='5'?'checked=checked':'';?>>5</td>   
    </tr>
    <tr>
        <td>
        13. I am actively doing things now to cut down or stop my use of drugs
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_13" value="1"  <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_13" value="2"  <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_13" value="3"  <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_13" value="4"  <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_13" value="5"   <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='5'?'checked=checked':'';?>>5</td>   
    </tr>

    <tr>
        <td>14. I want help to keep from going back to the drug problems that I had before.</td>
        <td><input type="radio"  class="radio" name="drugpoint_14" value="1"  <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_14" value="2"  <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_14" value="3"  <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_14" value="4"  <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_14" value="5"   <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='5'?'checked=checked':'';?>>5</td>   
    </tr>
    <tr>
        <td>
        15. I know that I have a drug problem
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_15" value="1"  <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='1'?'checked=checked':'';?>>1</td> 
         <td><input type="radio"  class="radio" name="drugpoint_15" value="2"  <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='2'?'checked=checked':'';?>>2</td> 
         <td><input type="radio"  class="radio" name="drugpoint_15" value="3"  <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='3'?'checked=checked':'';?>>3</td> 
         <td><input type="radio"  class="radio" name="drugpoint_15" value="4"  <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='4'?'checked=checked':'';?>>4</td> 
         <td><input type="radio"  class="radio" name="drugpoint_15" value="5"   <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 

    <tr>
         <td>
         16. There are times when I wonder if I use drugs too much
         </td>
         <td><input type="radio"  class="radio" name="drugpoint_16" value="1"  <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='1'?'checked=checked':'';?>>1</td> 
         <td><input type="radio"  class="radio" name="drugpoint_16" value="2"  <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='2'?'checked=checked':'';?>>2</td> 
         <td><input type="radio"  class="radio" name="drugpoint_16" value="3"  <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='3'?'checked=checked':'';?>>3</td> 
         <td><input type="radio"  class="radio" name="drugpoint_16" value="4"  <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_16" value="5"   <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 
    <tr>
        <td>
        17. I am a drug addict
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_17" value="1"  <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_17" value="2"  <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_17" value="3"  <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_17" value="4"  <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_17" value="5"   <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 
    <tr>
        <td>
        18. I am working hard to change my drug use. 
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_18" value="1"  <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_18" value="2"  <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_18" value="3"  <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_18" value="4"  <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_18" value="5"   <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 
    <tr>
        <td>
        19. I have made some changes in my drug use, and I want some help to keep from going back to the way I used before
        </td>
        <td><input type="radio"  class="radio" name="drugpoint_19" value="1"  <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='1'?'checked=checked':'';?>>1</td> 
        <td><input type="radio"  class="radio" name="drugpoint_19" value="2"  <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='2'?'checked=checked':'';?>>2</td> 
        <td><input type="radio"  class="radio" name="drugpoint_19" value="3"  <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='3'?'checked=checked':'';?>>3</td> 
        <td><input type="radio"  class="radio" name="drugpoint_19" value="4"  <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='4'?'checked=checked':'';?>>4</td> 
        <td><input type="radio"  class="radio" name="drugpoint_19" value="5"   <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='5'?'checked=checked':'';?>>5</td>   
    </tr> 
</table>





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

