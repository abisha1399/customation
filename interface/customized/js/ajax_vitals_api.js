function refresh_patient(pid,type)
{
    $("#vitalsdiv_"+pid+"").html('<div class="spinner-border spinner-border-sm" role="status"></div>');
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": ""+customized_folder+"/api_device_data/smart_meter_device/iglucose_data.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {         
        
        }
    });
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": ""+customized_folder+"/api_device_data/body_trace_api/get_data.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {            
               
        }
    });
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": ""+customized_folder+"/api_device_data/tenovi/get_tenovi_data.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {            
               
        }
    });
    
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": ""+customized_folder+"/api_device_data/dexcom/get_dexcom_data.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {            
               
        }
    }); 
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": ""+customized_folder+"/api_device_data/omron/get_omron_data.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {            
               
        }
    });
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": ""+customized_folder+"/api_device_data/tryterra/getdata.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        { 
            
        }
    });
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": ""+customized_folder+"/api_device_data/tide_pool/tide_pool.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {            
               
        }
    });   
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": ""+customized_folder+"/api_device_data/ambrosiya/getdata.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {   
            if(type=='demo'){
                placeHtml(""+customized_folder+"/vitals_fragment.php", "vitals_ps_expand");
           }
           else{
            show_single_patient(pid);
            
           }
            
        }
    });
}