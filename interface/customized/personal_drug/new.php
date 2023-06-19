<?php

/**
 * Clinical instructions form.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2017-2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$drug_data = $formid ? formFetch("form_personal_drug", $formid) : array();
?>
<html>
    <head>
        <title><?php echo xlt("Personal Drug Use Questionnaire"); ?></title>

        <?php Header::setupHeader(); ?>
        <style>
            .outline-text{
                color: black;
                outline: none;
                outline-style: none;
                border: 0px 0px 1px 0px;
                border-top: none;
                border-left: none;
                border-right: none;
                border-bottom: solid #212529de 1px;
                margin: 4px;
            }
        </style>    
    </head>
    <body>
        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <h2><?php echo xlt('Personal Drug Use Questionnaire'); ?></h2>
                    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/personal_drug/save.php?id=<?php echo attr_url($formid); ?>">
                        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                        <!-- <fieldset> -->
                            <div class="row">
                                <p>INSTRUCTIONS: Please read the following statements carefully.Each one describes a way that you might (or might not) feel about your drug use. For each statement, circle one number from 1 to 5, to indicate how much you agree or disagree with it right now. Please circle one and only one number for every statement</p>
                            </div>
                            <div class="row">
                                <center>FOR OFFICE USE ONLY </center>
                                <div class="col-md-12">
                                    <ul style="list-style:none;">
                                    <li><input type="text" class="outline-text" name="study" value="<?php echo isset($drug_data['study'])?$drug_data['study']:'';?>">Study</li>
                                    <li><input type="text" class="outline-text" name="main_id" value="<?php echo isset($drug_data['main_id'])?$drug_data['main_id']:'';?>">ID</li>
                                    <li><input type="text" class="outline-text" name="point" id="total" value="<?php echo isset($drug_data['point'])?$drug_data['point']:'';?>" readonly>Point</li>
                                    <li><input type="date" class="outline-text" name="main_date" style="width: 168px;" value="<?php echo isset($drug_data['main_date'])?$drug_data['main_date']:'';?>">Date</li>
                                    <li><input type="text" class="outline-text" name="raid" value="<?php echo isset($drug_data['raid'])?$drug_data['raid']:'';?>">Raid</li>
                                </div>   

                            </div>   
                        <!-- </fieldset>     -->
                        <div>
                            <table class="table" border='1'>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        <b>NO!</b>Strongly Disagree<br>
                                    </td>  
                                    <td>
                                        <b>NO!</b>Disagree<br>
                                    </td> 
                                    <td>
                                        <b>?</b>Undecided or Unsure<br>
                                    </td> 
                                    <td>
                                        <b>Yes!</b>Agree<br>
                                    </td> 
                                    <td>
                                        <b>YES!</b>Strongly Agree<br>
                                    </td>  
                                </tr>
                                <!-- question start    -->
                                <tr>
                                    <td>
                                    1. I really want to make changes in my use of drugs
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_1" value="1" <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_1" value="2" <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_1" value="3" <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_1" value="4" <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_1" value="5" <?php echo isset($drug_data['drugpoint_1'])&&$drug_data['drugpoint_1']=='5'?'checked':'';?>>5</td>   
                                </tr>   
                                
                                <tr>
                                    <td>
                                    2. Sometimes I wonder if I am an addict.
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_2" value="1" <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_2" value="2" <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_2" value="3" <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_2" value="4" <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_2" value="5" <?php echo isset($drug_data['drugpoint_2'])&&$drug_data['drugpoint_2']=='5'?'checked':'';?>>5</td>   
                                </tr>   

                                <tr>
                                    <td>
                                    3. If I don’t change my drug use soon, my problems are going to get worse.
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_3" value="1" <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_3" value="2" <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_3" value="3" <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_3" value="4" <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_3" value="5" <?php echo isset($drug_data['drugpoint_3'])&&$drug_data['drugpoint_3']=='5'?'checked':'';?>>5</td>   
                                </tr>   

                                <tr>
                                    <td>
                                    4. I have already started making some changes in my use of drugs
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_4" value="1" <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_4" value="2" <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_4" value="3" <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_4" value="4" <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_4" value="5" <?php echo isset($drug_data['drugpoint_4'])&&$drug_data['drugpoint_4']=='5'?'checked':'';?>>5</td>   
                                </tr>   

                                <tr>
                                    <td>
                                    5. I was using drugs too much at one time,but I’ve managed to change that
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_5" value="1" <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='1'?'checked':'';?>> 1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_5" value="2" <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_5" value="3" <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_5" value="4" <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_5" value="5" <?php echo isset($drug_data['drugpoint_5'])&&$drug_data['drugpoint_5']=='5'?'checked':'';?>>5</td>   
                                </tr> 

                                <tr>
                                    <td>
                                    6. Sometimes I wonder if my drug use is hurting other people
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_6" value="1" <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='1'?'checked':'';?> >1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_6" value="2" <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_6" value="3" <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_6" value="4" <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_6" value="5" <?php echo isset($drug_data['drugpoint_6'])&&$drug_data['drugpoint_6']=='5'?'checked':'';?>>5</td>   
                                </tr>   

                                <tr>
                                    <td>
                                    7. I have a drug problem.
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_7" value="1" <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='1'?'checked':'';?> >1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_7" value="2" <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_7" value="3" <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_7" value="4" <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_7" value="5" <?php echo isset($drug_data['drugpoint_7'])&&$drug_data['drugpoint_7']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    8.I’m not just thinking about changing my drug use, I’m already doing something about it.
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_8" value="1" <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_8" value="2" <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_8" value="3" <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_8" value="4" <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_8" value="5" <?php echo isset($drug_data['drugpoint_8'])&&$drug_data['drugpoint_8']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                
                                <tr>
                                    <td>
                                    9. I have already changed my drug use, and I am looking for ways to keep from slipping back to my old pattern
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_9" value="1" <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_9" value="2" <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_9" value="3" <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_9" value="4" <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_9" value="5" <?php echo isset($drug_data['drugpoint_9'])&&$drug_data['drugpoint_9']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    10. I have serious problems with drugs
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_10" value="1" <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_10" value="2" <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_10" value="3" <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_10" value="4" <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_10" value="5" <?php echo isset($drug_data['drugpoint_10'])&&$drug_data['drugpoint_10']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    11. Sometimes I wonder if I am in control of my drug use
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_11" value="1" <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_11" value="2" <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_11" value="3" <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_11" value="4" <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_11" value="5" <?php echo isset($drug_data['drugpoint_11'])&&$drug_data['drugpoint_11']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    12. My drug use is causing a lot of harm.
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_12" value="1" <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_12" value="2" <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_12" value="3" <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_12" value="4" <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_12" value="5" <?php echo isset($drug_data['drugpoint_12'])&&$drug_data['drugpoint_12']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    13. I am actively doing things now to cut down or stop my use of drugs
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_13" value="1" <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_13" value="2" <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_13" value="3" <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_13" value="4" <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_13" value="5" <?php echo isset($drug_data['drugpoint_13'])&&$drug_data['drugpoint_13']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    14. I want help to keep from going back to the drug problems that I had before.
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_14" value="1" <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_14" value="2" <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_14" value="3" <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_14" value="4" <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_14" value="5" <?php echo isset($drug_data['drugpoint_14'])&&$drug_data['drugpoint_14']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    15. I know that I have a drug problem
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_15" value="1" <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_15" value="2" <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_15" value="3" <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_15" value="4" <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_15" value="5" <?php echo isset($drug_data['drugpoint_15'])&&$drug_data['drugpoint_15']=='5'?'checked':'';?>>5</td>   
                                </tr> 

                                <tr>
                                    <td>
                                    16. There are times when I wonder if I use drugs too much
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_16" value="1" <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_16" value="2" <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_16" value="3" <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_16" value="4" <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_16" value="5" <?php echo isset($drug_data['drugpoint_16'])&&$drug_data['drugpoint_16']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    17. I am a drug addict
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_17" value="1" <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_17" value="2" <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_17" value="3" <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_17" value="4" <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_17" value="5" <?php echo isset($drug_data['drugpoint_17'])&&$drug_data['drugpoint_17']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    18. I am working hard to change my drug use. 
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_18" value="1" <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_18" value="2" <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_18" value="3" <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_18" value="4" <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_18" value="5" <?php echo isset($drug_data['drugpoint_18'])&&$drug_data['drugpoint_18']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                                <tr>
                                    <td>
                                    19. I have made some changes in my drug use, and I want some help to keep from going back to the way I used before
                                    </td>
                                    <td><input type="radio"  class="radio" name="drugpoint_19" value="1" <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='1'?'checked':'';?>>1</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_19" value="2" <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='2'?'checked':'';?>>2</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_19" value="3" <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='3'?'checked':'';?>>3</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_19" value="4" <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='4'?'checked':'';?>>4</td> 
                                    <td><input type="radio"  class="radio" name="drugpoint_19" value="5" <?php echo isset($drug_data['drugpoint_19'])&&$drug_data['drugpoint_19']=='5'?'checked':'';?>>5</td>   
                                </tr> 
                            </table>    
                        </div>
                        <div class="form-group">
                            <div class="btn-group" role="group">
                                <button type="submit" onclick='top.restoreSession()' class="btn btn-primary btn-save"><?php echo xlt('Save'); ?></button>
                                <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
$('.radio').change(function ()
{
      var total = 0;
      $('.radio:checked').each(function(){ // iterate through each checked element.
        total += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
      }); 
      $("#total").val(total);

});
</script>    
