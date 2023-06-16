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

$suicide_data = $formid ? formFetch("form_columbia_suicide", $formid) : array();
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
                    <center><h2><?php echo xlt('COLUMBIA-SUICIDE SEVERITY RATING SCALE (C-SSRS)'); ?></h2></center>
                    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/columbia_suicide/save.php?id=<?php echo attr_url($formid); ?>">
                        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                          
                        <table border='1' style="width:100%;">
                        <tr><td style="width:80%;" ><center>RISK ASSESSMENT VERSION</center></td>
                            <td colspan="2">Past Month</b></td>
                        </tr>  
                        <tr style="background: #f1f1f1;">
                            <td colspan="3"><b>Ask Questions 1 and 2<b></td>
                        </tr>
                        <?php
                        //echo '<pre>';print_r($suicide_data);exit();
                        if(isset($suicide_data['wish_dead']))
                        {
                            $wish_dead_data=json_decode($suicide_data['wish_dead']);
                        }
                        
                        if(isset($suicide_data['non_specifi_active']))
                        {
                            $non_specifi_active_data=json_decode($suicide_data['non_specifi_active']);
                        }

                        if(isset($suicide_data['active_susaid']))
                        {
                            $active_susaid_data=json_decode($suicide_data['active_susaid']);
                        }

                        if(isset($suicide_data['active_susaid_without']))
                        {
                            $active_susaid_without_data=json_decode($suicide_data['active_susaid_without']);
                        }
                        
                        if(isset($suicide_data['active_susaid_spe_plan']))
                        {
                            $active_susaid_spe_plan_data=json_decode($suicide_data['active_susaid_spe_plan']);
                        }

                        if(isset($suicide_data['preparatory_acts']))
                        {
                            $preparatory_acts_data=json_decode($suicide_data['preparatory_acts']);
                        }
                        //echo $data;exit();
                        ?> 
                        <tr>
                            <td>
                            <b>1) Wish to be Dead:</b><br>Person endorses thoughts about a wish to be dead or not alive anymore, or wish to fall asleep and not wake up.<br>
                            <b>Have you wished you were dead or wished you could go to sleep and not wake up</b><br>
                            <b>If yes, please explain:</b><br>
                            <input type="text" class="form-control" name="wish_dead_reason" value="<?php echo text(($wish_dead_data && $wish_dead_data->wish_dead=='yes') ? $wish_dead_data->wish_dead_reason :''); ?>">
                            </td>
                            <td>
                                <input type="radio" name="wish_dead" value="yes" <?php echo ($wish_dead_data && $wish_dead_data->wish_dead=='yes') ? 'checked' :''?>>yes
                            </td> 
                            <td>   
                                <input type="radio" name="wish_dead" value="no" <?php echo text(($wish_dead_data && $wish_dead_data->wish_dead =='no') ? 'checked' :''); ?>>no  
                            </td>   
                        </tr>
                        
                        <tr>
                            <td>
                            <b>2) Non-Specific Active Suicidal Thoughts:</b><br>General non-specific thoughts of wanting to end one’s life/die by suicide without general thoughts of methods, intent, or plan.<br>
                            <b>Have you had any actual thoughts of killing yourself?</b><br>
                            <b>If yes, please explain:</b><br>
                            <input type="text" class="form-control" name="non_specif_active_reason" value="<?php echo text(($non_specifi_active_data && $non_specifi_active_data->non_specific_active=='yes') ? $non_specifi_active_data->non_specif_active_reason :''); ?>">
                            </td>
                            <td>
                                <input type="radio" name="non_specific_active" value="yes" class="non-specifi-active" <?php echo text(($non_specifi_active_data && $non_specifi_active_data->non_specific_active=='yes') ?'checked' :''); ?>>yes
                            </td> 
                            <td>   
                                <input type="radio"  name="non_specific_active" value="no" class="non-specifi-active" <?php echo text(($non_specifi_active_data && $non_specifi_active_data->non_specific_active=='no') ?'checked' :''); ?>>no  
                            </td>   
                        </tr> 
                        <tr style="background: #f1f1f1;">
                            <td colspan="3"><b>If YES to 2, ask questions 3, 4, 5, and 6. If NO to 2, go directly to question 6<b></td>
                        </tr>
                        <!-- <div class="question_yes" style="display:none"> -->
                            <tr class="question_yes">
                                <td>
                                <b>3) Active Suicidal Ideation with Any Methods/Means (Not Plan) without Intent to Act:</b>
                                <br>Person endorses thoughts of suicide and has thought of at least one method. e.g. “I thought about taking an overdose but I never made a specific plan as to when, where or how I would actually do it….and I would never go through with it.”<br>
                                <b>Have you been thinking about (how) you might do this</b><br>
                                <b>If yes, how? (means)</b><br>
                                <input type="text" class="form-control" name="active_suicide_ideation_mean" value="<?php echo text(($active_susaid_data && $active_susaid_data->non_specific_active=='yes') ?$active_susaid_data->active_suicide_ideation_mean :''); ?>"><br>
                                <b>If yes, do you have access to the methods/means?</b><br>
                                <input type="text" class="form-control" name="active_suicide_ideation_access" value="<?php echo text(($active_susaid_data && $active_susaid_data->non_specific_active=='yes') ?$active_susaid_data->active_suicide_ideation_access :''); ?>"><br>
                                </td>
                                <td>
                                    <input type="radio" name="active_suicide_ideation" value="yes" <?php echo text(($active_susaid_data && $active_susaid_data->non_specific_active=='yes') ?'checked' :''); ?>>yes
                                </td> 
                                <td>   
                                    <input type="radio" name="active_suicide_ideation" value="no" <?php echo text(($active_susaid_data && $active_susaid_data->non_specific_active=='no') ?'checked' :''); ?>>no  
                                </td>   
                            </tr> 

                            <tr class="question_yes">
                                <td>
                                <b>4)Active Suicidal Ideation with Some Intent to Act, without Specific Plan:</b>
                                <br>Active suicidal thoughts of killing oneself and reports having some intent to act on such thoughts.e.g. “I have the thoughts but I definitely will not do anything about them.”<br>
                                <b>Have you had these thoughts and had some intention of acting on them?</b><br>
                                <b>If yes, please explain:</b><br>
                                <input type="text" class="form-control" name="active_suicide_wsp_reason" value="<?php echo text(($active_susaid_without_data && $active_susaid_without_data->active_suicide_wsp=='yes') ?$active_susaid_without_data->active_suicide_wsp_reason:''); ?>"><br>
                                </td>
                                <td>
                                    <input type="radio"  name="active_suicide_wsp" value="yes" <?php echo text(($active_susaid_without_data && $active_susaid_without_data->active_suicide_wsp=='yes') ?'checked':''); ?>>yes
                                </td> 
                                <td>   
                                    <input type="radio" name="active_suicide_wsp" value="no" <?php echo text(($active_susaid_without_data && $active_susaid_without_data->active_suicide_wsp=='no') ?'checked':''); ?>>no  
                                </td>   
                            </tr> 

                            <tr class="question_yes">
                                <td>
                                <b>5) Active Suicidal Ideation with Specific Plan and Intent:</b>
                                <br>Thoughts of killing oneself with details of plan fully or partially worked out and person has some intent to carry it out.<br>
                                <b>Have you started to work out or worked out the details of how to kill yourself?</b><br>
                                <b>If yes, do you intend to carry out this plan?</b><br>
                                <input type="text" class="form-control" name="active_suicide_spi_in"  value="<?php echo text(($active_susaid_spe_plan_data && $active_susaid_spe_plan_data->active_suicide=='yes') ?$active_susaid_spe_plan_data->active_suicide_spi_in:''); ?>"><br>
                                <b>If yes, do you have a timeframe (when)?</b><br>
                                <input type="text" class="form-control" name="active_suicide_spi_time" value="<?php echo text(($active_susaid_spe_plan_data && $active_susaid_spe_plan_data->active_suicide=='yes') ?$active_susaid_spe_plan_data->active_suicide_spi_time:''); ?>"><br>
                                <b>If yes, do you have a location (where)?</b><br>
                                <input type="text" class="form-control" name="active_suicide_loca"  value="<?php echo text(($active_susaid_spe_plan_data && $active_susaid_spe_plan_data->active_suicide=='yes') ?$active_susaid_spe_plan_data->active_suicide_loca:''); ?>"><br>
                                </td>
                                <td>
                                    <input type="radio"  name="active_suicide" value="yes" <?php echo text(($active_susaid_spe_plan_data && $active_susaid_spe_plan_data->active_suicide=='yes') ?'checked':''); ?>>yes
                                </td> 
                                <td>   
                                    <input type="radio"  name="active_suicide" value="no" <?php echo text(($active_susaid_spe_plan_data && $active_susaid_spe_plan_data->active_suicide=='yes') ?'checked':''); ?>>no  
                                </td>   
                            </tr> 

                            <tr>
                                <td><b>6a) Preparatory Acts or Behavior:</b><br>
                                Examples: Collected pills, obtained a gun, gave away valuables, wrote a will or suicide note, took out pills 
                                but didn’t swallow any, held a gun but changed your mind or it was grabbed from your hand, went to the 
                                roof but didn’t jump; or actually took pills, tried to shoot yourself, cut yourself, tried to hang yourself, etc.
                                <b>Have you done anything, started to do anything, or prepared to do anything to end your life? </b><br>
                                <b>If yes, please explain:</b><br>
                                <input type="text" class="form-control" name="Preparatory_act_reason" value="<?php echo text(($preparatory_acts_data && $preparatory_acts_data->Preparatory_act_life=='yes') ?$preparatory_acts_data->Preparatory_act_reason:''); ?>">
                                </td>
                                 <td colspan="2"  style="padding: 0;"><center><b>Lifetime</b></center>

                                    <table style="width:100%;height:148px;">                                
                                        <!-- <tr>
                                            <td colspan="2" style="border: 1px solid;border-top: 0 !important;border-left: 0 !important;"><b>Lifetime</b></td>
                                            
                                        </tr> -->
                                        <tr>
                                            <td style="width:50% "><input type="radio"  name="Preparatory_act_life" value="yes" <?php echo text(($preparatory_acts_data && $preparatory_acts_data->Preparatory_act_life=='yes') ?'checked':''); ?>>yes</td>
                                            <td><input type="radio"  name="Preparatory_act_life" value="no" <?php echo text(($preparatory_acts_data && $preparatory_acts_data->Preparatory_act_life=='no') ?'checked':''); ?>>no</td>
                                        </tr>
                                       
                                    </table>
                                    

                                </td>    
                                </tr>
                                <tr><td>6b) <b>If yes, ask: Was this within the past 3 months?</b>
                                <br><input type="text" name="Preparatory_act_reason_month" class="form-control" value="<?php echo text(($preparatory_acts_data && $preparatory_acts_data->Preparatory_act_month=='yes') ?$preparatory_acts_data->Preparatory_act_reason_month:''); ?>">
                                </td>
                                <td colspan="2"  style="padding: 0;"><center><b>Past 3 Months</b></center>
                                    <table style="width:100%;height: 43px;">                                
                                        
                                        <tr>
                                            <td style="width:50% "><input type="radio" name="Preparatory_act_month" value="yes" <?php echo text(($preparatory_acts_data && $preparatory_acts_data->Preparatory_act_month=='yes') ?'checked':''); ?>>yes</td>
                                            <td><input type="radio" name="Preparatory_act_month" value="no" <?php echo text(($preparatory_acts_data && $preparatory_acts_data->Preparatory_act_month=='no') ?'checked':''); ?>>no</td>
                                        </tr>
                                       
                                    </table>
                                </td>    
                                
                            </tr>   


                        </div>     
                         </table>
                         <div class="row">
                            <div class="col-md-6">
                                <b style="">Response Procedure to C-SSRS Screening: </b>                                
                            </div>  
                            <div class="col-md-2" >
                                <b style="background:yellow">Low Risk  </b>                                
                            </div>  
                            <div class="col-md-2" >
                                <b style="background:orange">Moderate Risk </b>                                
                            </div>  
                            <div class="col-md-2" >
                                <b style="background:red">High Risk </b>                                
                            </div>   
                         </div>
                         <div class="row">
                         <p>1) Seek behavioral health counseling services and/or contact crisis line.<br/>
                         <p>2) Seek behavioral health counseling services and/or contact crisis line.
                         <p> 3) Seek behavioral health counseling services, psychiatric services/evaluation, and/or contact crisis line.
                         <p>4) Seek psychiatric services/evaluation by behavioral health intake/emergency room/EMT.
                          <p>5) Seek psychiatric services/evaluation by behavioral health intake/emergency room/EMT.
                         <p>6a) Seek behavioral health counseling services, psychiatric services/evaluation, and/or contact crisis line.
                         <p>6b) Within 3 months: Seek psychiatric services/evaluation by behavioral health intake/emergency room/EMT   
                        </div>
                        <br>
                        <div>
                        Any <b>YES</b> indicates that the person should seek behavioral health counseling and/or contact crisis lines at: 
                        National Suicide Prevention Lifeline <b>1-800-273-8255,</b> text “Home” to 741741, Behavioral Health Response
                        (BHR) 1-800-811-4760, Provident Crisis Services (PCS) <b>314-647-4357,</b> KUTO 1-888-644-5886, Trevor Project 
                        (LGBTQ) 1-866-488-7386. However, if the answer to 4, 5 or 6 is <b>YES,</b> seek immediate help: contact behavioral 
                        health intake, go to the emergency room, or call 911
                        </div>
                        <br>
                        <div class="row">
                            <p style="background:orange">*Do Not Leave an “At-Risk” Person Alone. Secure All Means. Remain Calm, Listen, Provide Love & Support.*</p>
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
$(function(){
        var value= $('.non-specifi-active:checked').val();
        if(value=='yes'){
            $(".question_yes").show();
        } 
        else{
            $(".question_yes").hide();
        } 
})
$(document).on('change','.non-specifi-active',function(){
    
    var value = $(this).val();    
    if(value=='yes')
    {        
        $(".question_yes").show();
    }
    else{
        $(".question_yes").hide();
    }
});
</script>    
