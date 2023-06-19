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
//echo $formid;exit();
$nicotine_data = $formid ? formFetch("form_nicotine", $formid) : array();
//echo '<pre>';print_r($individual_data);exit();
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
                    

                    
                    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/nicotine/save.php?id=<?php echo attr_url($formid); ?>">
                        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                         <table style="width:100%" cellpadding="10" cellspacing="0">
                            <tr>
                                <td style="width:60%">Name:<input type="text" class="form-control" name="pat_name" value="<?php echo $nicotine_data['pat_name'] ??'' ?>">
                                </td>
                                <td style="width:40%">Date:<input type="date" class="form-control" name="form_date" value="<?php echo $nicotine_data['form_date'] ??'' ?>">
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
                                 <td><input type="radio" class="radio cigarette" value="0" data-id="cigarette" <?php echo isset($nicotine_data['first_cigarette'])&&$nicotine_data['first_cigarette']=='0'?'checked':'';?> >After 60 Minutes</td> 
                                 <td><input type="radio" class="radio cigarette" value="1" data-id="cigarette" <?php echo isset($nicotine_data['first_cigarette'])&&$nicotine_data['first_cigarette']=='1'?'checked':'';?>>After 60 Minutes</td>  
                                 <td><input type="radio" class="radio cigarette" value="2" data-id="cigarette" <?php echo isset($nicotine_data['first_cigarette'])&&$nicotine_data['first_cigarette']=='2'?'checked':'';?>>After 60 Minutes</td>  
                                 <td><input type="radio" class="radio cigarette" value="3" data-id="cigarette" <?php echo isset($nicotine_data['first_cigarette'])&&$nicotine_data['first_cigarette']=='3'?'checked':'';?>>After 60 Minutes</td> 
                                 <input type="hidden" name="first_cigarette" id="cigarette" value="<?php echo $nicotine_data['first_cigarette'] ??'' ?>">  
                            </tr>
                            <tr style="background-color: #c1c1c19c;">
                                <td colspan="2">2. Do you find it difficult to refrain from smoking in places where it is forbidden, e.g., in church,at the library, cinema, etc?</td>
                                 <td><input type="radio" class="radio difficult_smoke" value="0" data-id="difficult_smoke" <?php echo isset($nicotine_data['difficult_smoke'])&&$nicotine_data['difficult_smoke']=='0'?'checked':'';?>>No</td> 
                                 <td><input type="radio" class="radio difficult_smoke" value="1" data-id="difficult_smoke" <?php echo isset($nicotine_data['difficult_smoke'])&&$nicotine_data['difficult_smoke']=='1'?'checked':'';?>>Yes</td>  
                                 <td></td>  
                                 <td></td> 
                                 <input type="hidden" name="difficult_smoke" id="difficult_smoke" value="<?php echo $nicotine_data['difficult_smoke']??'';?>"  >  
                            </tr>
                            
                            <tr>
                                <td colspan="2">3. Which cigarette would you hate most to give up? </td>
                                 <td><input type="radio" class="radio cigarette_hate" value="0" data-id="cigarette_hate" <?php echo isset($nicotine_data['cigarette_hate'])&&$nicotine_data['cigarette_hate']=='0'?'checked':'';?>>All others</td> 
                                 <td><input type="radio" class="radio cigarette_hate" value="1" data-id="cigarette_hate" <?php echo isset($nicotine_data['cigarette_hate'])&&$nicotine_data['cigarette_hate']=='1'?'checked':'';?>>The first one in the morning</td>  
                                 <td></td>  
                                 <td></td> 
                                 <input type="hidden" name="cigarette_hate" id="cigarette_hate" value="<?php echo $nicotine_data['cigarette_hate']??'';?>" >  
                            </tr>
                            <tr style="background-color: #c1c1c19c;">
                                <td colspan="2">4. How many cigarettes/day do you smoke?</td>
                                 <td><input type="radio" class="radio cigarette_value" value="0" data-id="cigarette_value" <?php echo isset($nicotine_data['cigarette_value'])&&$nicotine_data['cigarette_value']=='0'?'checked':'';?>>10 or less</td> 
                                 <td><input type="radio" class="radio cigarette_value" value="1" data-id="cigarette_value" <?php echo isset($nicotine_data['cigarette_value'])&&$nicotine_data['cigarette_value']=='1'?'checked':'';?>>11-20 </td>  
                                 <td><input type="radio" class="radio cigarette_value" value="2" data-id="cigarette_value" <?php echo isset($nicotine_data['cigarette_value'])&&$nicotine_data['cigarette_value']=='2'?'checked':'';?>>21-30 </td> 
                                 <td><input type="radio" class="radio cigarette_value" value="3" data-id="cigarette_value" <?php echo isset($nicotine_data['cigarette_value'])&&$nicotine_data['cigarette_value']=='3'?'checked':'';?>>31 or more</td>  
                                 <input type="hidden" name="cigarette_value" id="cigarette_value" value="<?php echo $nicotine_data['cigarette_value']??'';?>" >  
                            </tr> 
                            <tr>
                                <td colspan="2">5. Do you smoke more frequently during the first hours of waking than during the rest of the day?</td>
                                 <td><input type="radio" class="radio frequently" value="0" data-id="frequently" <?php echo isset($nicotine_data['frequently'])&&$nicotine_data['frequently']=='0'?'checked':'';?>>No</td> 
                                 <td><input type="radio" class="radio frequently" value="1" data-id="frequently" <?php echo isset($nicotine_data['frequently'])&&$nicotine_data['frequently']=='1'?'checked':'';?>>Yes</td>  
                                 <td></td>  
                                 <td></td> 
                                 <input type="hidden" name="frequently" id="frequently" value="<?php echo $nicotine_data['frequently']??'';?>" >  
                            </tr> 
                            <tr style="background-color: #c1c1c19c;">
                                <td colspan="2">6. Do you smoke if you are so ill that you are in bed most of the  day? </td>
                                 <td><input type="radio" class="radio ill" value="0" data-id="ill" <?php echo isset($nicotine_data['illness'])&&$nicotine_data['illness']=='0'?'checked':'';?>>No</td> 
                                 <td><input type="radio" class="radio ill" value="1" data-id="ill" <?php echo isset($nicotine_data['illness'])&&$nicotine_data['illness']=='1'?'checked':'';?>>Yes</td>  
                                 <td></td>  
                                 <td></td> 
                                 <input type="hidden" name="illness" id="ill" value="<?php echo $nicotine_data['illness']??'';?>" >  
                            </tr>  
                         </table>  
                         <br>
                         <div >
                            <h4>total scrore:<input type="text" readonly id="total" name="total" value="<?php echo $nicotine_data['total']??'';?>"></h4>
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
                         <br><br>   
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
        var single_value = $(this).attr('data-id');
        $('#'+single_value).val($(this).val());
        var total = 0;
        $('.'+single_value).prop('checked',false);
        $(this).prop('checked',true);
        $('.radio:checked').each(function(){ // iterate through each checked element.
            total += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
        }); 
        $("#total").val(total);

    });
</script>    
   
