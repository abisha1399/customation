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
$life_event_data = $formid ? formFetch("form_life_events", $formid) : array();
//echo '<pre>';print_r($individual_data);exit();
?>
<html>
    <head>
        <title><?php echo xlt("life event checklist"); ?></title>

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
                    

                    
                    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/life_events/save.php?id=<?php echo attr_url($formid); ?>">
                        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                         
                         <h2><center><?php echo xlt('Life Events Checklist'); ?></center></h2>
                         <div style="margin-top:20px">
                         <b>Instructions:</b> Listed below are a number of difficult or stressful things that sometimes happen to people. For each 
                        event check one or more of the boxes to the right to indicate that: (a) it happened to you personally; (b) you witnessed 
                        it happen to someone else; (c) you learned about it happening to a close family member or close friend; (d) you were 
                        exposed to it as part of your job (for example, paramedic, police, military, or other first responder); (e) you’re not sure if 
                        it fits; or (f) it doesn’t apply to you.
                         </div> 
                         <div style="margin-top:10px">
                         Be sure to consider your entire life (growing up as well as adulthood) as you go through the list of events. 
                        </div> 
                        <div style=" margin-top:9px">  
                         <table style="width:100%" cellpadding="10" border="1" cellspacing="0">
                            <tr>
                               <th > Event </th> 
                               <th>Happened to me </th> 
                               <th>Witnessed it</th> 
                               <th>Learned about it</th> 
                               <th>Part of my job  </th> 
                               <th>Not sure</th>
                               <th>Doesn’t apply</th>  
                            </tr>
                            <tr>
                                <td style="width:50%" >1. Natural disaster (for example, flood, hurricane,tornado, earthquake)</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="natural_happend" value="happenend" <?php echo isset($life_event_data['natural_happend'])&&$life_event_data['natural_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="natural_witness" value="witness" <?php echo isset($life_event_data['natural_witness'])&&$life_event_data['natural_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="natural_learn" value="learn" <?php echo isset($life_event_data['natural_learn'])&&$life_event_data['natural_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="natural_job" value="job" <?php echo isset($life_event_data['natural_job'])&&$life_event_data['natural_job']=='jon'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="natural_sure" value="sure" <?php echo isset($life_event_data['natural_sure'])&&$life_event_data['natural_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="natural_apply" value="apply" <?php echo isset($life_event_data['natural_apply'])&&$life_event_data['natural_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr style="background-color: #c1c1c19c;">
                                <td style="width:50%">2. Fire or explosion</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="fire_happend" value="happenend" <?php echo isset($life_event_data['fire_happend'])&&$life_event_data['fire_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="fire_witness" value="witness" <?php echo isset($life_event_data['fire_witness'])&&$life_event_data['fire_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="fire_learn" value="learn" <?php echo isset($life_event_data['fire_learn'])&&$life_event_data['fire_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="fire_job" value="job" <?php echo isset($life_event_data['fire_job'])&&$life_event_data['fire_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="fire_sure" value="sure" <?php echo isset($life_event_data['fire_sure'])&&$life_event_data['fire_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="fire_apply" value="apply" <?php echo isset($life_event_data['fire_apply'])&&$life_event_data['fire_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr>
                                <td style="width:50%">3. Transportation accident (for example, car accident, boat accident, train wreck, plane crash)</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="transport_happend" value="happenend" <?php echo isset($life_event_data['transport_happend'])&&$life_event_data['transport_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="transport_witness" value="witness" <?php echo isset($life_event_data['transport_witness'])&&$life_event_data['transport_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="transport_learn" value="learn" <?php echo isset($life_event_data['transport_learn'])&&$life_event_data['transport_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="transport_job" value="job" <?php echo isset($life_event_data['transport_job'])&&$life_event_data['transport_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="transport_sure" value="sure" <?php echo isset($life_event_data['transport_sure'])&&$life_event_data['transport_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="transport_apply" value="apply" <?php echo isset($life_event_data['transport_apply'])&&$life_event_data['transport_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr style="background-color: #c1c1c19c;">
                                <td style="width:10%">4. Serious accident at work, home, or during recreational activity</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="serious_acc_happend" value="happenend" <?php echo isset($life_event_data['serious_acc_happend'])&&$life_event_data['serious_acc_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="serious_acc_witness" value="witness" <?php echo isset($life_event_data['serious_acc_witness'])&&$life_event_data['serious_acc_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="serious_acc_learn" value="learn" <?php echo isset($life_event_data['serious_acc_learn'])&&$life_event_data['serious_acc_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="serious_acc_job" value="job" <?php echo isset($life_event_data['serious_acc_job'])&&$life_event_data['serious_acc_job']=='jon'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="serious_acc_sure" value="sure" <?php echo isset($life_event_data['serious_acc_sure'])&&$life_event_data['serious_acc_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="serious_acc_apply" value="apply" <?php echo isset($life_event_data['serious_acc_apply'])&&$life_event_data['serious_acc_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr>
                                <td style="width:50%">5. Exposure to toxic substance (for example,dangerous chemicals, radiation)</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="exposure_happend" value="happenend" <?php echo isset($life_event_data['exposure_happend'])&&$life_event_data['exposure_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="exposure_witness" value="witness" <?php echo isset($life_event_data['exposure_witness'])&&$life_event_data['exposure_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="exposure_learn" value="learn" <?php echo isset($life_event_data['exposure_learn'])&&$life_event_data['exposure_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="exposure_job" value="job" <?php echo isset($life_event_data['exposure_job'])&&$life_event_data['exposure_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="exposure_sure" value="sure" <?php echo isset($life_event_data['exposure_sure'])&&$life_event_data['exposure_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="exposure_apply" value="apply" <?php echo isset($life_event_data['exposure_apply'])&&$life_event_data['exposure_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr style="background-color: #c1c1c19c;">
                                <td style="width:50%">6.Physical assault (for example, being attacked, hit,slapped, kicked, beaten up)</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="assault_happend" value="happenend" <?php echo isset($life_event_data['assault_happend'])&&$life_event_data['assault_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="assault_witness" value="witness" <?php echo isset($life_event_data['assault_witness'])&&$life_event_data['assault_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="assault_learn" value="learn" <?php echo isset($life_event_data['assault_learn'])&&$life_event_data['assault_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="assault_job" value="job" <?php echo isset($life_event_data['assault_job'])&&$life_event_data['assault_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="assault_sure" value="sure" <?php echo isset($life_event_data['assault_sure'])&&$life_event_data['assault_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="assault_apply" value="apply" <?php echo isset($life_event_data['assault_apply'])&&$life_event_data['assault_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr>
                                <td style="width:50%">7. Assault with a weapon (for example, being shot, stabbed, threatened with a knife, gun,bomb)</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="weapon_happend" value="happenend" <?php echo isset($life_event_data['weapon_happend'])&&$life_event_data['weapon_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="weapon_witness" value="witness" <?php echo isset($life_event_data['weapon_witness'])&&$life_event_data['weapon_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="weapon_learn" value="learn" <?php echo isset($life_event_data['weapon_learn'])&&$life_event_data['weapon_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="weapon_job" value="job" <?php echo isset($life_event_data['weapon_job'])&&$life_event_data['weapon_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="weapon_sure" value="sure" <?php echo isset($life_event_data['weapon_sure'])&&$life_event_data['weapon_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="weapon_apply" value="apply" <?php echo isset($life_event_data['weapon_apply'])&&$life_event_data['weapon_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr style="background-color: #c1c1c19c;">
                                <td style="width:50%">8.Sexual assault (rape, attempted rape, made to perform any type of sexual act through force or threat of harm</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sexual_ass_happend" value="happenend" <?php echo isset($life_event_data['sexual_ass_happend'])&&$life_event_data['sexual_ass_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sexual_ass_witness" value="witness" <?php echo isset($life_event_data['sexual_ass_witness'])&&$life_event_data['sexual_ass_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sexual_ass_learn" value="learn" <?php echo isset($life_event_data['sexual_ass_learn'])&&$life_event_data['sexual_ass_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sexual_ass_job" value="job" <?php echo isset($life_event_data['sexual_ass_job'])&&$life_event_data['sexual_ass_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sexual_ass_sure" value="sure" <?php echo isset($life_event_data['sexual_ass_sure'])&&$life_event_data['sexual_ass_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sexual_ass_apply" value="apply" <?php echo isset($life_event_data['sexual_ass_apply'])&&$life_event_data['sexual_ass_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr>
                                <td style="width:50%">9. Other unwanted or uncomfortable sexual experience.</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="unwanted_sex_happend" value="happenend" <?php echo isset($life_event_data['unwanted_sex_happend'])&&$life_event_data['unwanted_sex_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="unwanted_sex_witness" value="witness" <?php echo isset($life_event_data['unwanted_sex_witness'])&&$life_event_data['unwanted_sex_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="unwanted_sex_learn" value="learn" <?php echo isset($life_event_data['unwanted_sex_learn'])&&$life_event_data['unwanted_sex_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="unwanted_sex_job" value="job" <?php echo isset($life_event_data['unwanted_sex_job'])&&$life_event_data['unwanted_sex_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="unwanted_sex_sure" value="sure" <?php echo isset($life_event_data['unwanted_sex_sure'])&&$life_event_data['unwanted_sex_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="unwanted_sex_apply" value="apply" <?php echo isset($life_event_data['unwanted_sex_apply'])&&$life_event_data['unwanted_sex_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr style="background-color: #c1c1c19c;">
                                <td style="width:50%">10. Combat or exposure to a war-zone (in the military or as a civilian)</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="military_happend" value="happenend" <?php echo isset($life_event_data['military_happend'])&&$life_event_data['military_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="military_witness" value="witness" <?php echo isset($life_event_data['military_witness'])&&$life_event_data['military_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="military_learn" value="learn" <?php echo isset($life_event_data['military_learn'])&&$life_event_data['military_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="military_job" value="job" <?php echo isset($life_event_data['military_job'])&&$life_event_data['military_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="military_sure" value="sure" <?php echo isset($life_event_data['military_sure'])&&$life_event_data['military_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="military_apply" value="apply" <?php echo isset($life_event_data['military_apply'])&&$life_event_data['military_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr>
                                <td style="width:50%">11. Captivity (for example, being kidnapped,abducted, held hostage, prisoner of war)</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="captivity_happend" value="happenend" <?php echo isset($life_event_data['captivity_happend'])&&$life_event_data['captivity_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="captivity_witness" value="witness" <?php echo isset($life_event_data['captivity_witness'])&&$life_event_data['captivity_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="captivity_learn" value="learn" <?php echo isset($life_event_data['captivity_learn'])&&$life_event_data['captivity_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="captivity_job" value="job" <?php echo isset($life_event_data['captivity_job'])&&$life_event_data['captivity_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="captivity_sure" value="sure" <?php echo isset($life_event_data['captivity_sure'])&&$life_event_data['captivity_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="captivity_apply" value="apply" <?php echo isset($life_event_data['captivity_apply'])&&$life_event_data['captivity_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr style="background-color: #c1c1c19c;">
                                <td style="width:50%">12. Life-threatening illness or injury</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="life_thread_happend" value="happenend" <?php echo isset($life_event_data['life_thread_happend'])&&$life_event_data['life_thread_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="life_thread_witness" value="witness" <?php echo isset($life_event_data['life_thread_witness'])&&$life_event_data['life_thread_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="life_thread_learn" value="learn" <?php echo isset($life_event_data['life_thread_learn'])&&$life_event_data['life_thread_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="life_thread_job" value="job" <?php echo isset($life_event_data['life_thread_job'])&&$life_event_data['life_thread_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="life_thread_sure" value="sure" <?php echo isset($life_event_data['life_thread_sure'])&&$life_event_data['life_thread_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="life_thread_apply" value="apply" <?php echo isset($life_event_data['life_thread_apply'])&&$life_event_data['life_thread_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr>
                                <td style="width:50%">13.Severe human sufferin</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="severe_happend" value="happenend" <?php echo isset($life_event_data['life_thread_happend'])&&$life_event_data['life_thread_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="severe_witness" value="witness" <?php echo isset($life_event_data['life_thread_happend'])&&$life_event_data['life_thread_happend']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="severe_learn" value="learn" <?php echo isset($life_event_data['life_thread_happend'])&&$life_event_data['life_thread_happend']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="severe_job" value="job" <?php echo isset($life_event_data['life_thread_happend'])&&$life_event_data['life_thread_happend']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="severe_sure" value="sure" <?php echo isset($life_event_data['life_thread_happend'])&&$life_event_data['life_thread_happend']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="severe_apply" value="apply" <?php echo isset($life_event_data['life_thread_happend'])&&$life_event_data['life_thread_happend']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr style="background-color: #c1c1c19c;">
                                <td style="width:50%">14.Sudden violent death (for example, homicide,suicide</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="violent_death_happend" value="happenend" <?php echo isset($life_event_data['violent_death_happend'])&&$life_event_data['violent_death_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="violent_death_witness" value="witness" <?php echo isset($life_event_data['violent_death_witness'])&&$life_event_data['violent_death_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="violent_death_learn" value="learn" <?php echo isset($life_event_data['violent_death_learn'])&&$life_event_data['violent_death_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="violent_death_job" value="job" <?php echo isset($life_event_data['violent_death_job'])&&$life_event_data['violent_death_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="violent_death_sure" value="sure" <?php echo isset($life_event_data['violent_death_sure'])&&$life_event_data['violent_death_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="violent_death_apply" value="apply" <?php echo isset($life_event_data['violent_death_apply'])&&$life_event_data['violent_death_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr>
                                <td style="width:50%">15.Sudden accidental death</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sudden_acc_happend" value="happenend" <?php echo isset($life_event_data['sudden_acc_happend'])&&$life_event_data['sudden_acc_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sudden_acc_witness" value="witness" <?php echo isset($life_event_data['sudden_acc_witness'])&&$life_event_data['sudden_acc_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sudden_acc_learn" value="learn" <?php echo isset($life_event_data['sudden_acc_learn'])&&$life_event_data['sudden_acc_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sudden_acc_job" value="job" <?php echo isset($life_event_data['sudden_acc_job'])&&$life_event_data['sudden_acc_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sudden_acc_sure" value="sure" <?php echo isset($life_event_data['sudden_acc_sure'])&&$life_event_data['sudden_acc_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="sudden_acc_apply" value="apply" <?php echo isset($life_event_data['sudden_acc_apply'])&&$life_event_data['sudden_acc_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr style="background-color: #c1c1c19c;">
                                <td style="width:50%">16. Serious injury, harm, or death you caused to someone else</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="injury_happend" value="happenend" <?php echo isset($life_event_data['injury_happend'])&&$life_event_data['injury_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="injury_witness" value="witness" <?php echo isset($life_event_data['injury_witness'])&&$life_event_data['injury_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="injury_learn" value="learn" <?php echo isset($life_event_data['injury_learn'])&&$life_event_data['injury_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="injury_job" value="job" <?php echo isset($life_event_data['injury_job'])&&$life_event_data['injury_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="injury_sure" value="sure" <?php echo isset($life_event_data['injury_sure'])&&$life_event_data['injury_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="injury_apply" value="apply" <?php echo isset($life_event_data['injury_apply'])&&$life_event_data['injury_apply']=='apply'?'checked':'';?>></td>
                            </tr>

                            <tr>
                                <td style="width:50%">17. Any other very stressful event or experience</td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="experience_happend" value="happenend" <?php echo isset($life_event_data['experience_happend'])&&$life_event_data['experience_happend']=='happenend'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="experience_witness" value="witness" <?php echo isset($life_event_data['experience_witness'])&&$life_event_data['experience_witness']=='witness'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="experience_learn" value="learn" <?php echo isset($life_event_data['experience_learn'])&&$life_event_data['experience_learn']=='learn'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="experience_job" value="job" <?php echo isset($life_event_data['experience_job'])&&$life_event_data['experience_job']=='job'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="experience_sure" value="sure" <?php echo isset($life_event_data['experience_sure'])&&$life_event_data['experience_sure']=='sure'?'checked':'';?>></td>
                                <td style="width:10%"><input type="checkbox" class="form-control" name="experience_apply" value="apply" <?php echo isset($life_event_data['experience_apply'])&&$life_event_data['experience_apply']=='apply'?'checked':'';?>></td>
                            </tr>
                         </table>  
                        </div> 
                         <br>                         
                         <br>   
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
   
