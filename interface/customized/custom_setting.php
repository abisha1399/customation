<?php
$ignoreAuth = true;
$sessionAllowWrite = true;
require_once("../globals.php");
use OpenEMR\Core\Header;
$forms_array=["admission_note"=>"Admission Note Form","group_attendance"=>"Group Attendance Form","beck_depression_inventory"=>"Beck Depression Inventory Form","biopsychosocial_evaluation_form"=>"Biopsychosocial Form","transitional_form"=>"Transitional plan Form","clinical_update_form"=>"Clinical Updates Form",
"beck_anxiety_inventory"=>"Beck’s Anxiety Inventory Form","personal_drug"=>"Personal Drug Use Questionnaire Form","columbia_suicide"=>"COLUMBIA-SUICIDE SEVERITY RATING SCALE Form","life_events"=>"Life Events Checklist Form","history_and_physical_evaluation"=>"History and Physical Form",
"nicotine"=>"Test for Nicotine Dependence Form","DSM"=>"DSM-V Form","integrated_summary_form"=>"Integrated Summary Form","discharge_summary_form_cli"=>"Discharge summary form","group_note_form"=>"Group Notes Form","symptom_assessment"=>"TB assessment Form","medication_education_document"=>"Medication education form",
"individual_form"=>"Individual Notes Form","Revision_Relapse_form"=>"Revision&Relapse form","clinical_update_iop"=>"Clinical updates (IOP only) Form","facsimile_cover_sheet"=>"Blank IRO Form","Cigna_form"=>"Cigna IRO Form","master_treatment_plan"=>"Master Treatment Plan Form","partial_care"=>"Partial care master treatment plan Form",
"providence_health_plan"=>"Member Consent For UBH Form","form_member"=>"Member Designation Form","NJ_form"=>"NJ External Review Form","oxford_form"=>"Oxford AOR Form","UBH_form"=>"UBH Form","form_umr"=>"UMR AOR Form","medication_form"=>"Medication Reconciliation Form","consent_form"=>"Regular consent form",
"form_wellmark"=>"Wellmark Member Consent Form","authorized_representative_request"=>"Authorized Representative Request Form","clonidine_form"=>" Clonidine Withdraw Form","ativan_protocol"=>"Ativan Protocol B Form","chemical_use_his_form"=>"chemical use history form","form_safety"=>"Safety plan consent form",
"clonidine_protocol_b "=>" Clonidine Protocol B Form","current_withdrawal_signs_symptoms"=>"Current Withdrawal Signs/Symptoms Form","detox_form"=>"Detox Form","integumentary"=>"Fall Risk Management Form","fall_risk_management"=>"Fall Risk Management Form","authorized_representative_form"=>"Client consent Form","driving_consent"=>"Driving Consent Form",
"first_dose_medication_form"=>"first dose medication form","form_follow"=>"Follow Up Form","last_form"=>"LapCorp Form","form_librium"=>"librium Form","form_master1"=>"Master1 Form","form_medication"=>"Medication Form","medication_log"=>"Medication Log Form","medication_order_form"=>"Medication Order Form","daily_medication"=>"Daily Medication Form",
"tuberculin_skin_form"=>"tuberculin skin form","system_assessment"=>"Systems Assessment Form","suicide_lethality_assessment"=>"Suicide Lethality Assessment Form","suboxone_8day_taper"=>"Suboxone 8 day Taper/Heroin Form","recovery_management_form"=>"Recovery Management Form","form_medication1"=>"Medication1 Form","form_mental"=>"Mental Status Examination Form",
"nurse_admission_assessment"=>"Nurse Admission Assessment Form","form_nursing"=>"Nursing Form","form_nutrition"=>"Nutrition Form","form_quick"=>"Quick Guide Form","Nursing_admission_form"=>"Nursing admission pkt Form","daily_nursing_assessment"=>"Daily nursing note Form","benzodiazepine"=>"CIWA-B (benzo use only) Form","form_cows"=>"COWS (opiate use only) Form",
"form_ciwa"=>"CIWA-AR (alcohol use only) Form","CIWA_AMP"=>"CIWA-AMP (amphetamine use only) Form","meddrop_box"=>"Med Drop Box Form","patient_info_pkt"=>"Patient info packet Form","samhsa_form"=>"Samsha opioid toolkit Form","patient_orientation_manual"=>"Patient Orientation Manual Form","ime_consent_form"=>"IME Consent Form","form_onsite"=>"Urine Screening Form",
"ativan_protocol_c"=>"Ativan Protocol C Form","librium_protocol_c"=>"Librium Protocol C Form","thiamine_folate"=>"thiamine/folate form","nursing_blank_note"=>"Blank Form","initial_psychiatric_evaluation_form"=>"Initial Psychiatric Evaluation Form","admission_orders"=>"Admission Orders Form","discharge_summary_form_phy"=>"Discharge summary form"];

if(isset($_GET['save_setting']))
{
  $gl_name  = $_POST['gl_name'];
  $gl_value = $_POST['gl_value'];
  $global_value_exit=sqlStatement("DELETE FROM globals WHERE gl_name='".$gl_name."'");
  sqlStatement("INSERT INTO globals(gl_name,gl_index,gl_value)VALUES('".$gl_name."',0,'".$gl_value."')");
  if($gl_name=='enable_telehealthappt'){
    sqlStatement("UPDATE openemr_postcalendar_categories SET pc_active = '".$gl_value."' WHERE pc_constant_id='telehealth'");
  }
  echo 'insert';
  exit();
}
if(isset($_GET['get_all_global']))
{
  $globals_arry=[];
  $value=sqlStatement("SELECT * FROM globals");
  while($row=sqlFetchArray($value)){
   
    if($row['gl_value']=='1'){
      $globals_arry[]=$row['gl_name'];
    }
   
  }
  $global_arr=json_encode($globals_arry);
  echo $global_arr;
  exit();
}
if(isset($_GET['encounter_forms_setting']))
{
    $value=$_POST['value'];
    $directory_name=$_POST['directory_name'];
    $form_name=$_POST['form_name'];
    sqlStatement("DELETE FROM registry WHERE directory='".$directory_name."'");
    if($value==1)
    {
        sqlStatement("INSERT INTO registry (name,state,directory,id,sql_run,unpackaged,date,priority,category,nickname,patient_encounter,therapy_group_encounter,aco_spec,form_foreign_id) VALUES ('".$form_name."', '1', '".$directory_name."', NULL, '1', '1', '".date('Y-m-d H:i:s')."', '0', 'Customazation', '', '1', '0', 'encounters|notes', NULL)");

    }
    echo $value;
    exit();
}
if(isset($_GET['get_encounter_forms']))
{
  $forms_all_array=[];
  $value=sqlStatement("SELECT * FROM registry WHERE state=1");
  while($row=sqlFetchArray($value)){
      $forms_all_array[]=$row['directory'];
  }
  $forms_arr=json_encode($forms_all_array);
  echo $forms_arr;
  exit();
}

?> <html>
    <title>custom Setting</title>
  <head>
     <?php Header::setupHeader();?>
     <style>
      .tabContainer{
        max-height: 1500px;
        overflow: auto;
      }
     
        .tab{
            background: white !important;
            border: 1px solid white !important;
        }
        .switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 21px;
        }

        .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
        }

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        }

        .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 2px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        }

        input:checked + .slider {
        background-color: #2196F3;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
        border-radius: 34px;
        }

        .slider.round:before {
        border-radius: 50%;
        }
        .text-body{
            cursor:pointer;
        }
    </style>
     <script>
      $(function() {
        $(".text-body").on('click',function(){
                var id=$(this).attr('id');
                $('.tab').removeClass('current');
                $("#tab_"+id).addClass('current');
            });
      });
    </script>
    
  </head>
  <body class="body-topnav">
    <div class="container-fluid pl-0">
      <nav class="nav navbar-light bg-light fixed-top top-before-sidebar">
        <div class="container-fluid py-2">
          <div class="sidebar-expand d-md-none">
            <button type="button" class="text-dark">
              <i class="fa fa-angle-right fa-inverted"></i>
            </button>
          </div>
          <a class="navbar-brand" href="#">Customized setting</a>
          <div id="practice-setting-nav"></div>
        </div>
      </nav>
      <nav class="nav-sidebar bg-light mt-3 mt-md-5 pt-5 pt-md-3">
        <div class="sidebar-content">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link text-body" id="login_setting">Login</a>
            </li>     
            <li class="nav-item">
              <a class="nav-link text-body" id="encounter_setting">Encounter</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link text-body" id="rpm_setting">RPM</a>
            </li>           
            <li class="nav-item">
              <a class="nav-link text-body" id="forms_setting">Forms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-body" id="billing_setting">Billing</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link text-body" id="prescription_setting">Prescription</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link text-body" id="third_party_setting">Third parties Api</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-body" id="calendar_setting">Calendar</a>
            </li>
          </ul>
        </div>
      </nav>
      <main class="main-full">
        <div class="pl-3 pt-5 pt-md-3">
            <div class="tabContainer">
                <!---Login tab---->
                <div class="tab current" id="tab_login_setting">                    
                    
                    <div class=''>
                        <div class='col-sm-12 oe-global-tab-heading'>
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Login Setting&nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable New Login page</div>
                            <div class='col-sm-6 oe-input' title='Enable New Login page'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_newloginpage'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Forget password</div>
                            <div class='col-sm-6 oe-input' title='Enable Forget password'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_forgetpassword'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Keeps me sign</div>
                            <div class='col-sm-6 oe-input' title='Enable Keeps me sign'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_keepmesign'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable location based login</div>
                            <div class='col-sm-6 oe-input' title='Enable location based login'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_location_login'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!---encounter tab---->
                <div class="tab " id="tab_encounter_setting">
                    <div class=''>
                        <div class='col-sm-12 oe-global-tab-heading'>
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Encounter Setting&nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable level of care</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox"  class="custom_setting_event" data-id='enable_enc_levelofcare'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Clone Encounter</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_cloneencounter'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable lifetime tracker</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_lifetime_tracker'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Send Email new encounter create</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_send_mail_enc'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!---RPM tab---->
                <div class="tab" id="tab_rpm_setting">                   
                    
                    <div class=''>
                        <div class='col-sm-12 oe-global-tab-heading'>
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>RPM &nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable RPM Encounter</div>
                            <div class='col-sm-6 oe-input' title='Enable RPM Encounter'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_rpm'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Patient Finder vitals screen</div>
                            <div class='col-sm-6 oe-input' title='Enable Patient Finder vitals screen'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_patient_vitals_screen'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable libree Freestyle Api</div>
                            <div class='col-sm-6 oe-input' title='Enable libree Freestyle Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_libree_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable GoogleFit Api</div>
                            <div class='col-sm-6 oe-input' title='Enable GoogleFit Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_googlefit_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Fitbit Api</div>
                            <div class='col-sm-6 oe-input' title='Enable Fitbit Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_fitbit_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Omron Api</div>
                            <div class='col-sm-6 oe-input' title='Enable Omron Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_omron_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Smart Meter Api</div>
                            <div class='col-sm-6 oe-input' title='Enable Smart Meter Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_smartmeter_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Bodytrace Api</div>
                            <div class='col-sm-6 oe-input' title='Enable Bodytrace Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_bodytrace_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Tidepool Api</div>
                            <div class='col-sm-6 oe-input' title='Enable Tidepool Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_tidepool_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Ambrosiya Api</div>
                            <div class='col-sm-6 oe-input' title='Enable Ambrosiya Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_ambrosiya_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Dexcom Api</div>
                            <div class='col-sm-6 oe-input' title='Enable Dexcom Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_dexcom_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Tenovi Api</div>
                            <div class='col-sm-6 oe-input' title='Enable Tenovi Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_tenovi_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Imedrix Api</div>
                            <div class='col-sm-6 oe-input' title='Imedrix Api'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_imderix_api'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable RPM code </div>
                            <div class='col-sm-6 oe-input' title='Enable RPM code'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_rpm_code'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Billing CCM billing code for libreefreestyle</div>
                            <div class='col-sm-6 oe-input' title='Enable Billing CCM billing'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_ccm_code'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!---forms tab---->
                <div class="tab" id="tab_forms_setting">                   
                    
                    <div class=''>
                        <div class='col-sm-12 oe-global-tab-heading'>
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Forms Setting &nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Patient consent form</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_patient_consentfom'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Create New patient form</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_patient_newform'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable auto save forms</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_auto_save'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Clone Forms</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_clone_form'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Macro Button</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_macrobutton'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Form Builder</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_formbuilder'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <?php
                        foreach($forms_array as $key=>$value){
                            ?>
                            <div class='row form-group'>
                            <div class='col-sm-6'>Enable <?php echo $value; ?></div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_encounter_forms" data-id='<?php echo $key;?>' data-name='<?php echo $value;?>'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <!---Billing tab---->
                <div class="tab" id="tab_billing_setting">                    
                    
                    <div class=''>
                        <div class='col-sm-12 oe-global-tab-heading'>
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Billing &nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable New Billing Mangaer</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Calim Dashboard</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!---Prescription tab---->
                <div class="tab" id="tab_prescription_setting">                    
                    
                    <div class=''>
                        <div class='col-sm-12 oe-global-tab-heading'>
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Prescription &nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable scanned prescription</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>                        
                    </div>
                </div>
                <!---Third Party tab---->
                <div class="tab" id="tab_third_party_setting">                    
                    
                    <div class=''>
                        <div class='col-sm-12 oe-global-tab-heading'>
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Third Party Setting &nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Ringcentral</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_ringcentral_fax'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div> 
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Availability</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div> 
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Avialability</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>  
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Newcrop Erx</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div> 
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable 1uphealth integration</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_ringcentral_fax'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>                       
                    </div>
                </div>
                <!---Prescription tab---->
                <div class="tab" id="tab_calendar_setting">                    
                    
                    <div class=''>
                        <div class='col-sm-12 oe-global-tab-heading'>
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Calendar Setting &nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable calendar grid</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_calendargrid'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div> 
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Provider Available Check</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div> 
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable billing profile in calender</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>   
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable TelehealthAppoitment</div>
                            <div class='col-sm-6 oe-input'>
                                <label class="switch">
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_telehealthappt'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>                        
                    </div>
                </div>


                
            </div>
        </div>
      </main>
    </div>
  </body>  
</html>
<script>
  $(function(){
    enable_all_buttons();
    enable_all_forms();
  });
  function enable_all_buttons(){
    $.ajax({
        "async": true,
        "crossDomain": true,
        "url": "./custom_setting?get_all_global",
        "method": "POST",
        success: function(response) 
        {
          var data = $.parseJSON(response);
          $(".custom_setting_event").each(function(){
            var glname=$(this).attr('data-id');    
            if ($.inArray(glname, data) > -1)
            {
              $(this).prop('checked',true);
            }
          });
        } 
    });     
  }
   function enable_all_forms(){
        $.ajax({
            "async": true,
            "crossDomain": true,
            "url": "./custom_setting?get_encounter_forms",
            "method": "POST",
            success: function(response) 
            {
            var data = $.parseJSON(response);
            $(".custom_encounter_forms").each(function(){
                var name=$(this).attr('data-id');    
                if ($.inArray(name, data) > -1)
                {
                $(this).prop('checked',true);
                }
            });
            } 
        }); 
    }
  
  $(".custom_setting_event").change(function(){
    var gl_value=0;
    var gl_name=$(this).attr('data-id');
    if($(this).is(":checked")){
      gl_value=1;      
    }    
    if(gl_name!=''){
      $.ajax({
        "async": true,
        "crossDomain": true,
        "url": "./custom_setting?save_setting",
        "method": "POST",
        data:{
          gl_name:gl_name,
          gl_value:gl_value
        },
        success: function(response) 
        {
        } 
      });
    }
  })
 
    $(".custom_encounter_forms").change(function(){
    var value=0;
    var directory_name=$(this).attr('data-id');
    var form_name=$(this).attr('data-name');    
    if($(this).is(":checked")){
        value=1;      
    }    
    if(directory_name!=''){
      $.ajax({
        "async": true,
        "crossDomain": true,
        "url": "./custom_setting?encounter_forms_setting",
        "method": "POST",
        data:{
            form_name:form_name,
            directory_name:directory_name,
            value:value
        },
        success: function(response) 
        {
        } 
      });
    }
  });
</script>