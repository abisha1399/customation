<?php
$ignoreAuth = true;
$sessionAllowWrite = true;
require_once("../globals.php");
use OpenEMR\Core\Header;
if(isset($_GET['save_setting']))
{
  $gl_name  = $_POST['gl_name'];
  $gl_value = $_POST['gl_value'];
  $global_value_exit=sqlStatement("DELETE FROM globals WHERE gl_name='".$gl_name."'");
  sqlStatement("INSERT INTO globals(gl_name,gl_index,gl_value)VALUES('".$gl_name."',0,'".$gl_value."')");
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
            <li class="nav-item">
              <a class="nav-link text-body" id="prescription_setting">Prescription</a>
            </li>
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
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Login &nbsp;</div>
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
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Encounter &nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable level of care</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Clone Encounter</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable lifetime tracker</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
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
                                    <input type="checkbox" class="custom_setting_event" data-id='enable_omron_api'>
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
                                <div class='oe-pull-toward' style='font-size: 1.4rem'>Forms &nbsp;</div>
                                <div style='margin-top: 5px'></div>
                        </div>
                        <div class='clearfix'></div>                        
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Patient consent form</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Create New patient form</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable auto save forms</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable auto save forms</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Macro Button</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-sm-6'>Enable Form Builder</div>
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
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
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
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
                                    <input type="checkbox" checked>
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
                            <div class='col-sm-6 oe-input' title='Rx Enable DEA #'>
                                <label class="switch">
                                    <input type="checkbox" checked>
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
</script>