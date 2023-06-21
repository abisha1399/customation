<?php

/**
 * external_data.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Vinish K <vinish@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");
require_once("$srcdir/patient.inc");
require_once "$srcdir/options.inc.php";
require_once("../../../custom/code_types.inc.php");

use OpenEMR\Core\Header;
use OpenEMR\Menu\PatientMenuRole;
use OpenEMR\OeUI\OemrUI;

if(isset($_POST['code_value']))
{
    $numrows = 0;
    $search_term=$_POST['code_value'];
    $search_type = $_POST['code_type'];
    $code_all_array= [];
    $res = main_code_set_search($search_type, $search_term);
   
    if (!empty($res)) {
        $numrows = sqlNumRows($res);
    }
    
    if (! $numrows) {
        echo 0;
        exit();

    }  
    else{
        $codes=[];
        
        while ($row = sqlFetchArray($res)) {
            $code_price=sqlQuery("SELECT pr_price From prices WHERE pr_id='".$row['id']."'");
            if($code_price['pr_price']!=''){
                $row['fee']=$code_price['pr_price'];
            }
            $code[]=$row;
            
        }

     } 
    
    echo json_encode($code);
    exit(); 

}

if(!empty($_POST['code_array'])){
   
    $pid=0;
    $profile_name= $_POST['profile_name'];   
    $codes = $_POST['code_array'];
     $profile_id=$_POST['profile_id'];      
    if($profile_id && $profile_id!=0){
       
        Sqlstatement("UPDATE billing_profile  SET profile_name=?,codes=? WHERE id=?",array($profile_name, $codes,$profile_id));
        echo $profile_id;
       exit();

    }
    else{
        
        $insert_id=sqlInsert("INSERT INTO billing_profile (profile_name,codes) VALUES (?,?)",array($profile_name,$codes));
        echo $insert_id;
       exit();
    }
    

}

if(isset($_GET['profile_name_exit'])&& !empty($_GET['profile_name_exit']))
{
    $profile_name=$_POST['profile_name'];
    $id=$_POST['id'];
    $profile_name_array=[];
    if($id!=0)
    {
        //echo "SELECT * FROM billing_profile where profile_name='".$profile_name."' AND id NOT IN($id) AND is_deleted='0'" ;exit();
        $profile_name_data= sqlstatement("SELECT * FROM billing_profile where profile_name='".$profile_name."' AND id NOT IN($id) AND is_deleted='0'" );
        while($profile_row=sqlFetchArray($profile_name_data))
        {            
            array_push($profile_name_array,$profile_row);           
        }
           $profile_count =count($profile_name_array);
        echo $profile_count;
        exit();
    }
    else{
        $profile_name_data= sqlstatement("SELECT * FROM billing_profile where profile_name='".$profile_name."' AND is_deleted=0");
        while($profile_row=sqlFetchArray($profile_name_data))
        {            
            array_push($profile_name_array,$profile_row);           
        }
        echo count($profile_name_array);
        exit();

    }
   // $profile_data=sqlQuery("SELECT * FROM billing_profile WHERE pid="+$pid+" AND profile_name="+$profile_name+" NOT IN(id=)")

}

$id=isset($_GET['id'])?$_GET['id']:0;

if($id){
$profile_array=sqlQuery("SELECT * FROM billing_profile where id='".$id."'");

}
else{
    $profile_array=[];
}


                                   

?>
<html>
    <head>
        <?php Header::setupHeader(['opener']);?>
        <title><?php echo xlt('billing profile'); ?></title>
        <style>
            .icon_input{
                /* position: relative; */
                font-weight: 400;
                font-style: normal;
                display: inline-flex;
                color: rgba(0,0,0,.87);
                width: 100%;
            }
            .code-text{
                border-radius: 5px!important;
               background-color: transparent!important;
               width:75% !important;
            }
            .code-text1{
                border-radius: 4px 0px 0px 4px !important;
               background-color: transparent!important;
               width:60% !important;
                padding-left: 30px;

            }
            i.fa.fa-search {
                /* position: absolute; */
                top: 10px;
                left: 26px;
                color: #ffffff;
            }
            .results{
                /* display: none; */
    position: absolute;
    top: 100%;
    left: 0;
    -webkit-transform-origin: center top;
    transform-origin: center top;
    white-space: normal;
    text-align: left;
    text-transform: none;
    background: #fff;
    margin-top: 0.5em;
    width: 18em;
    border-radius: 0.28571429rem;
    box-shadow: 0 2px 4px 0 rgb(34 36 38 / 12%), 0 2px 10px 0 rgb(34 36 38 / 15%);
    border: 1px solid #d4d4d5;
    z-index: 998;
            }

            .results.transition {
    max-height: 355px;
    overflow-y: auto;
}
.code_title{
    font-weight: 600;
}
.search_code_btn{
    border-radius: 0px 4px 4px 0px !important;
}
           
           
        </style>
</head>
<body>    
    <form action="codes.php"  method="post" name="myform" id="myform">
        <input type="hidden" id="exit_template" value='true'>
        <div class="form-group clearfix" id="button-container">
            <div class="p-2  border-bottom">
                <h3>Create New Level Of Care</h3>        
            </div> 
            <div class="profile-body mt-3 pl-3">
                <div class="row">
                    <div class="col-3">
                        <span>Profile Name</span>
                    </div>    
                    <div class="col-8">
                    
                        <input type="text" class="form-control code-text" id="profile_name" value="<?php echo $profile_array['profile_name']?$profile_array['profile_name']:'';?>">
                    </div>
                    <div class="col-3 mt-3">
                        <span>ICD-10 Codes</span>
                    </div>    
                    <div class="col-8 mt-3">
                        <div class="icon_input">
                        <?php
                        $search_icon='<i class="fa fa-search"></i>';
                        ?>
                        <input type="text" class="form-control code-text1" placeholder="Find ICD10 Codes" name='search_term_icd10' id="ic10" data-id='ICD10'>
                        <!-- <button type="submit" class='btn btn-primary search_code_btn' name='bn_search_icd10' onclick='return this.clicked = true;'><i class="fa fa-search"></i></button> -->
                        <button type='button' class='btn btn-primary search_code_btn' value="ICD10" name='bn_search_icd10'><i class="fa fa-search"></i></button>
                        </div>

                        
                    </div> 
                    <div class="col-3 mt-3">
                        <span>CPT Codes</span>
                    </div>    
                    <div class="col-8 mt-3">
                        <div class="icon_input">                        
                            <input type="text" class="form-control code-text1" placeholder="Find CPT Codes" data-id="CPT4" name="search_term_cpt">
                            <button type="button" class='btn btn-primary search_code_btn' name='bn_search_cpt' value="CPT4">
                            <i class="fa fa-search"></i></button>                        
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <span>HCPCS Codes</span>
                    </div>    
                    <div class="col-8 mt-3">
                        <div class="icon_input">
                        
                            <input type="text" class="form-control code-text1" placeholder="Find HCPCS Codes" data-id="HCPCS" name="search_term_hcpc">
                            <button type="button" class='btn btn-primary search_code_btn' name='bn_search_hcpc' value="HCPCS">
                            <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <span>Revenue Codes</span>
                    </div>    
                    <div class="col-8 mt-3">
                        <div class="icon_input">                        
                            <input type="text" class="form-control code-text1" placeholder="Find Revenue Codes" data-id="REVE-CT" name="search_term_reve">
                            <button type="button" class='btn btn-primary search_code_btn' name='bn_search_reve' value="REVE-CT">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>   
            </div>
            <div id="codes_data" class="mt-2 p-3">
                <select class="form-control select_code" id="select_code"  >

                </select>
            </div>        
            <table class="table code_details_table" id="myTable">
                <?php
                if($id){
                    
                    echo'<tr><th>Type</th><th>Code</th><th>Description</th><th>Price </th><th>unit</th><th>delete</th></tr>';
                    $codes=json_decode($profile_array['codes']);
                    
                    $val=0;
                    foreach($codes as $value){
                        $val++;
                        echo '<tr id="code_row_'.$val.'" class="codes"><td>'.$value->codename.'</td><td>'.$value->code.'</td><td>'.$value->decription.'</td>';
                        if($value->codename!='ICD10'){
                            echo '<td><input type="text" value="'.$value->fee.'" style="width:50%;"></td>';
                            echo '<td><input type="text" value="'.$value->unit.'" style="width:50%;"></td>';
                        }
                        
                        else{
                          echo  '<td><input type="hidden"></td><td><input type="hidden"></td>';
                        }
                        echo '<td> <i class="fa fa-trash" onclick="remove_code('.$val.')"></i></td>';
                        //echo '<input type="hidden" value="'.$value->decription.'" data-id="'.$value->code.'" data-type="'.$value->codename.'" class="codes"></tr>';


                    }

                }
                ?>

           </table>    
            
        </div>    
        <div class="col-sm-12 text-left position-override mt-3">
            <!-- <input type="hidden" id="code_array" name="code_array"> -->
            <div class="btn-group" role="group">
                <button type='button' name='form_save' class="btn btn-primary btn-save" value='<?php echo xla('Save'); ?>' onclick="save_code(<?php echo $id;?>)"><?php echo xlt('Save'); ?></button>
                <button type="button" class="btn btn-secondary btn-cancel" onclick='closeme();'><?php echo xlt('Cancel'); ?></button>
            </div>
        </div>
        
    </form>
</body>   
</html>
<script>

$(".select_code").change(function(){
    var value=$(this).val();    
    var text=$('.select_code option:selected').text();
    value= value.split('|');
    var type=value[0];
    var code = value[1];
    var fee= value[2];
    var table_value='';
    if(fee=="null"){
        fee='';
    }
    //var rowCount = $('.code_details_table >tr').length;
    var rowCount = $('#myTable tr').length;
    //alert(rowCount);
    var row_id=rowCount+1;
    if(rowCount==0)
    {
        table_value  ='<tr><th>Type</th><th>Code</th><th>Description</th><th>Price </th><th>unit</th><th>delete</th></tr>';
    }
    text=text.split(",");
    text=text[1];
    table_value += '<tr id="code_row_'+row_id+'" class="codes"><td>'+type+'</td><td>'+code+'</td><td>'+text+'</td>';
    // table_value  +='<input type="hidden" value="'+text+'" data-id="'+code+'" data-type="'+type+'" >';
    if(type!='ICD10'){
        table_value +='<td><input type="text" value="'+fee+'" style="width:50%;"></td><td><input type="text" style="width:50%;"></td>';
    }
    else{
        table_value +='<td><input type="hidden"></td><td><input type="hidden"></td>';
    }

    table_value +='<td> <i class="fa fa-trash" onclick="remove_code('+row_id+')"></i></td>';
    table_value +='</tr>';
    $(".code_details_table").append(table_value);
})

function remove_code(id)
{
    $('#code_row_'+id+'').remove();
}

// function codeselect(){
//     var value=$(this).val();
//     alert(value);
// }
    function closeme() {
            dlgclose();
        }
        $(function(){
            $("#select_code").hide();
           
        })

    
    $(".search_code_btn").click(function(){       
        var search_term= $(this).prev().val();
        var search_type= $(this).val();
        var data='';
        //$("#codes_data").html('ss');
        if(search_term!=''){
            $.ajax({
              url: './codes.php?search_code',
              method: 'POST',
              dataType: "json",
              data: {'code_value':search_term,'code_type':search_type},
              success: function(data){
                $("#select_code").show();
                $("#select_code").css('color','black');
                $("#select_code").find('option').remove();                
                if(data!=0){
                    var code_count= data.length;
                    $("#select_code").css('background-color','yellow');
                    $("#select_code").append('<option>Search Results   ('+code_count+' items)</option>');
                    $.each( data, function( key, value ) {

                        $("#select_code").append('<option value=' + search_type + '|'+value.code+'|'+value.fee+'>' + value.code+','+value.code_text + '</option>'); // return empty
                    });
                }
                else{
                    $("#select_code").css('background-color','red');
                    $("#select_code").css('color','white');
                    $("#select_code").attr('disable');
                    $("#select_code").append('<option>Search Results   ('+data+' items)</option>');
                }
                
                     
                }
            });
           
        }        
       
    });
    function save_code(id){
        //alert(id);
        var profile_name=$("#profile_name").val();
        var status='true';
        if(profile_name!='')
        {
            name_exit(profile_name,id);
        }
        else{
            $("#profile_name").css('border-color','red');
            $('#profile_name').attr('placeholder','Profile name requierd');
            return false;
        }
        
        
    }


    function name_exit(profile_name,id){
        $.ajax({
              url: './codes.php?profile_name_exit=true',
              method: 'POST',
             
              data: {'id':id,'profile_name':profile_name},
              success: function(data){
                console.log(data);
                
                if(data!=0)
                {
                    //alert('Profile name exit');
                    $("#profile_name").css('border-color','red');
                    $('#profile_name').val('');
                    $('#profile_name').attr('placeholder','level of care profile name already exit');
                    $("#exit_template").val('false');
                    return false;
                               
                }
                else{
                    add_code(profile_name,id);
                     
                    
                }
              }
            });
    }

    function add_code(profile_name,id){
        
        var icd10_array = [];
        $('.codes').each(function(){
            // var fee=$(this).next();
            // alert(fee);
            // var code=$(this).attr('data-id');
            // var type=$(this).attr('data-type');  
            // var description = $(this).val();
            var $tds = $(this).find('td');
            var type = $tds.eq(0).text();
            var code= $tds.eq(1).text();
            var description =  $tds.eq(2).text();
            var fee = $tds.eq(3).find("input").val();
            var unit = $tds.eq(4).find("input").val();
            
            // product = $tds.eq(1).text(),
            // Quantity = $tds.eq(2).text();
            var icd10_obj = {};
            icd10_obj['codename']=type;
            icd10_obj['code']=code;
            icd10_obj['decription']=description;
            icd10_obj['fee']=fee;
            icd10_obj['unit']=unit;
            //console.log(icd10_obj);
            icd10_array.push(icd10_obj);

        });
        
        if(icd10_array.length === 0){
            signerAlertMsg('Atleaset Select One Code', 2000, 'danger');
        return false;
       }
        var code_array=JSON.stringify(icd10_array)
        //$("#code_array").val(code_array);
       
        $.ajax({
              url: './codes.php?search_code',
              method: 'POST',
              dataType: "json",
              data: {'code_array':code_array,'profile_name':profile_name,'profile_id':id},
              success: function(data){
                if(data!='')
                {
                    dlgclose();
                    opener.location.reload(true);
                    
                }
              }
            });
        
    }
    $("#profile_name").keyup(function(){
        $("#profile_name").css('border-color','#c1c1c1b3');
    });
    function signerAlertMsg(message, timer = 5000, type = 'success', size = '') {
        $('#signerAlertBox').remove();
        if(type=='danger'){
            var error='Alert!';
        }
        else{
            var error='Success';
        }
        size = (size == 'lg') ? 'left:25%;width:50%;' : 'left:35%;width:30%;';
        let style = "position:fixed;top:25%;" + size + " bottom:0;z-index:1020;z-index:5000";
        $("body").prepend("<div class='container text-center' id='signerAlertBox' style='" + style + "'></div>");
        let mHtml = '<div id="alertMessage" class="alert alert-' + type + ' alert-dismissable">' +
            '<button type="button" class="close btn btn-link" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<h5 class="alert-heading text-center">'+error+'</h5><hr>' +
            '<p>' + message + '</p>' +
            '</div>';
        $('#signerAlertBox').append(mHtml);
        $('#alertMessage').on('closed.bs.alert', function () {
            clearTimeout(AlertMsg);
            $('#signerAlertBox').remove();
        });
        let AlertMsg = setTimeout(function () {
            $('#alertMessage').fadeOut(800, function () {
                $('#signerAlertBox').remove();
            });
        }, timer);
    }
</script>    