<?php
error_reporting(E_ALL);
ini_set("display_error",0);
require_once("../../globals.php");
// require_once("$srcdir/acl.inc");
// require_once("$srcdir/log.inc");


if(isset($_POST['listid']))
{
    // echo "if";die;
        $list_data = getListdata($_POST['listid']);
        print_r($list_data);
        die;
}

function getListdata($listid)
{
    // echo $listid;
        $result = sqlStatement("select * from list_options where list_id = '".$listid."' and activity = 1");
        // echo $result;die;
        $final_array = [];
        while($res = sqlFetchArray($result))
        {
            array_push($final_array,$res);
        }
        $final_array = json_encode($final_array);
        return $final_array;
}

if(isset($_POST['form_submit']) && $_POST['form_submit']=='submit')
{
    // $form_json = json_encode($form_json):
    // echo "<pre>";print_r($_POST);die;
    $data = $_POST['data'];
    // echo "36";die;
    $form_json = json_encode($data);
    // $form_json = $data['formProperty'];
    $form_name = $_POST['formName'];
    $form_type = $_POST['form_type'];
    $exit_form_name=find_exit_form($form_name,$_POST['form_id']);
    // print_r($data);
    if($_POST['form_id'] !='')
    {
        //echo $exit_form_name;exit();
        if($exit_form_name==0){
            $result = sqlStatement("UPDATE form_builder SET form_name = '".$form_name."',form_type= '".$form_type."',form_json ='".$form_json."' where id=".$_POST['form_id']);
            echo "1";
            exit();
        }
        else{
            echo '0';
            exit();
        }
    }else
    {
        if($exit_form_name==0){
            $result = sqlInsert("INSERT INTO form_builder SET form_name = ?,form_type = ?,form_json = ?",[$form_name,$form_type,$form_json]);
            echo "1";
            exit();
        }
        else{
            echo '0';
            exit();
        }



    }
}
else if(isset($_POST["action"]) && $_POST["action"]=="Delete"){
    $id=$_POST["id"];
    $result=sqlQuery("delete from form_builder where id='{$id}'");    
}

$result = sqlStatement("select * from form_builder");

function find_exit_form($formname,$form_id){
    if($form_id=='')
    {
        $form_array  =[];
        $form_data= sqlstatement("SELECT form_name from form_builder where form_name='".$formname."'");
        while($row=sqlFetchArray($form_data))
        {
            array_push($form_array,$row);

        }
        return count($form_array);
    }
    else{
        $form_array  =[];
        $form_data= sqlstatement("SELECT form_name from form_builder where form_name='".$formname."' AND id NOT IN($form_id)");
        while($row=sqlFetchArray($form_data))
        {
            array_push($form_array,$row);

        }
        return count($form_array);
    }
}
if(isset($_POST['check_field_value'])&&$_POST['check_field_value']=='true')
{

    $inputfield_id = $_POST['inputfield_id'];
    $field_array = [];
    $field_data= sqlstatement("SELECT field_value from lbf_data where inputfield_id='".$inputfield_id."'");

    while($field_row=sqlFetchArray($field_data))
        {
            if($field_row['field_value']!='')
            {
                array_push($field_array,$field_row);
            }
        }
        $filed_count =count($field_array);
        echo $filed_count;

    exit();
}
if(isset($_POST['form_status_id'])&&$_POST['form_status_id']!='')
{
    $form_status_id = $_POST['form_status_id'];
    if($form_status_id==1){
        $form_status_id=0;
    }
    elseif($form_status_id==0)
    {
        $form_status_id=1;
    }
    $edit_id        =$_POST['edit_id'];
    sqlstatement("UPDATE form_builder SET status = '".$form_status_id."' WHERE id='".$edit_id."'");
    echo '1';
    exit();
}

if (isset($_POST['search_query'])) {
    $result_array = [];
$result = sqlstatement("SELECT * FROM form_builder WHERE form_name LIKE '%".$_POST['search_query']."%' AND  status=".$_POST['status']."");
if (sqlNumRows($result) > 0) {
    
 while ($user = sqlFetchArray($result)) {
    $t = [];
    $t['form_type'] =$user['form_type'];
    $t['id'] =$user['id'];
    $t['form_name'] =$user['form_name'];
    $t['form_json'] =$user['form_json'];
    $t['status'] =$user['status'];
    $t['active'] =$user['active'];
    $result_array[] = $t;
  
}
} else {
echo "empty";
exit();
}
echo json_encode($result_array);
exit();
}

if (isset($_POST['full_search_query'])) {
    $result_array = [];
$result = sqlstatement("SELECT * FROM form_builder WHERE status=".$_POST['status']."");
if (sqlNumRows($result) > 0) {
    
 while ($user = sqlFetchArray($result)) {
    $t = [];
    $t['form_type'] =$user['form_type'];
    $t['id'] =$user['id'];
    $t['form_name'] =$user['form_name'];
    $t['form_json'] =$user['form_json'];
    $t['status'] =$user['status'];
    $t['active'] =$user['active'];
    $result_array[] = $t;
  
}
} else {
echo "empty";
exit();
}
echo json_encode($result_array);
exit();
}




?>

<!DOCTYPE html>
<html lang="en-US">
    <head>

        <title>Form Builder</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/tether.min.css"/>
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="css/form_builder.css"/>
         <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<!--
        <script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/datatables.net-1-10-13/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="<?php echo $webroot ?>/interface/main/tabs/js/include_opener.js"></script>

        <style>
            .active_class{
                color: black;
             font-size: 20px;
             font-weight: 600;
            }
            .status_active{

                z-index: 2;
    color: #fff;
    background-color: #0275d8;
    border-color: #0275d8;
}

.panel_default
{
    color: #333;
    background-color: #f5f5f5;
    border-color: #ddd;
}
.canvas-border {
    padding: 47px 29px 0;
    background: #333;
    border-radius: 12px;
}
#canvas textarea {
        resize: none;
    }
#canvas {
    position: relative;
    padding: 1px;
    background: #ccc;
    height: 450px !important;
    overflow-y: scroll;
}
#canvas .ui-sortable-placeholder.placeholder {
    width: 25% !important;
    float: left !important;
}
/*#canvas .preview.ui-sortable-handle {
    width: 50%;
    background: #eeeeee;
    float: left;
    height: 109px !important;
}*/
#canvas .col-md-6.form-group {
    width: 25%;
    float: left;
    background: #eeeeee;
    border: 1px solid white;
    padding: 10px;
    height: 145px;
    margin-bottom: 10px !important;

}
.form_builder_field
{
    width: 250px;
    height:145px;
}
div#canvas .form_builder_field {
    width: 25% !important;
    float: left;
    min-height: 109px;
    margin: 0px !important;
    border: 1px solid #d4d4d4;
}
.placeholder {
    width: 25% !important;
    background-color: #71beea;
    border: 1px dashed #666;
    margin-bottom: 5px;
}
.modal-content
{
    margin-top : 20% !important;
}
.your-class::-webkit-input-placeholder {
    color: red;
}

        </style>
    </head>
    <body>
        
        <div class="container-fluid form_builder"  style="margin-top: 25px">
           
            
            <div class="clearfix"></div>
              <br/>
                <div class="row ">

                    <div class="col-sm-3">
                        <div style="display:flex"  style="width:100%" >
                            <div class="list-group-item active_class initial_form_status status_active" status='0'  data-id="active_form_div" style="width:50%;" >
                            <span style="cursor: pointer;">active</span></div>
                            <div class="list-group-item active_class initial_form_status" status='1' data-id="inactive_form_div" style="margin-left:10px;width:50%;">
                            <span style="cursor: pointer;">inactive</span></div>
                        </div>
                        
                           
                        <div id="active_form_div" class="hide_form" style="max-height: 700px;overflow-y: auto;">
                        <div>
                            <input type="text" class="text_val" status='0' placeholder="search form" style="width: 100%;border-color: #dfdfdf;outline:none;">
                        </div>
                        <ul class="list-group" id="active_form_ul">
                        <?php
                        $active_form = sqlstatement("SELECT * FROM form_builder where status=0");
                        $form_result = [];
                         while($res = sqlFetchArray($active_form))
                        {?>
                            <li class="list-group-item" id="active_<?=$res['id'];?>" onclick="fetchForm(<?=$res['id'];?>)"><?=$res['form_name'];?></li>

                        <?php array_push($form_result,$res);}
                         if(empty($form_result)){
                            echo '<li class="list-group-item">no active form</li>';
                         }
                         ?>
                        </ul>
                        </div>

                         <div style="display:none;" id="inactive_form_div"  class="hide_form" style="max-height: 700px;overflow-y: auto;">
                         <div>
                            <input type="text" class="text_val" status='1' placeholder="search form" style="width: 100%;border-color: #dfdfdf;outline:none;">
                        </div>
                         <ul class="list-group" id="inactive_form_ul">
                         <?php
                        $in_active_form = sqlstatement("SELECT * FROM form_builder where status=1");
                        $form_result1 = [];
                         while($res = sqlFetchArray($in_active_form))
                        {?>
                            <li class="list-group-item" id="active_<?=$res['id'];?>" data_id="<?=$res['status'];?>" onclick="fetchForm2(<?=$res['id'];?>)"><?=$res['form_name'];?></li>

                        <?php array_push($form_result1,$res);}
                         if(empty($form_result1)){
                            echo '<li class="list-group-item">no inactive form</li>';
                         }
                         ?>
                          </ul>
                        </div>

                       
                    </div>
                    <div class="col-sm-7 canvas-border">
                        <div class="row entryForm" id="form_1">
                            <div class="offset-md-5 col-md-6">
                                    <span style="color:#fff"; id="form_name_label">New Form</span>
                            </div>
                            <div style="display:inline-flex;">
                                <span style="color:#fff;pointer:cursor;" onclick="editFormLabel(2)"><i class="fa fa-pencil"></i></span>&ensp;
                                <span class="delete" style="color:#fff;pointer:cursor;display:none;"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                        <div class="row entryForm" id="form_2">
                            <div class="offset-md-5 col-md-6">
                                    <input type="text" id="form_name">New Form</span>
                            </div>
                            <div class="col-md-1" style="color:green;pointer:cursor;" onclick="editFormLabel(1)"><i class="fa fa-check"></i></div>
                        </div>
                        <div class="col-md-12 bal_builder" id="canvas">
                            <div class="form_builder_area">
                              <div class="preview"></div>
                              <div class="customForm" style="display: none;"></div>
                            </div>
                        </div>
                        <!-- <div class="row" style="height: 50px;"> -->
                        <!-- <div class="col-md-6"><select id="form_type" class="form-control"><option value="lbf">Visit Form</option><option value="lbt">Transaction Form</option></select> </div>
                        <div class="offset-md-3 col-md-3"><button class="btn btn-success " onclick="saveForm()" style="">Save</button> </div>
                    </div> -->
                    <div class="row"><div class="col-md-6"><select id="form_type" class="form-control"><option value="lbf">Visit Form</option><option value="lbt">Transaction Form</option></select> </div>
                    <div class="col-md-3">
                        <button class="btn btn-success status_button "  style="display:none;">active</button>
                    </div>
                    <div class="col-md-3"><button class="btn btn-success " onclick="saveForm()" style="">Save</button> </div>
                    </div></div>

                    <div class="col-sm-2">
                        <nav class="nav-sidebar">
                            <ul class="nav">
                                <li class="form_bal_textfield">
                                    <a href="javascript:;">Text Field <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_textarea">
                                    <a href="javascript:;">Text Area <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_select">
                                    <a href="javascript:;">Select <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_radio">
                                    <a href="javascript:;">Radio Button <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_checkbox">
                                    <a href="javascript:;">Checkbox <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_email">
                                    <a href="javascript:;">Email <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_number">
                                    <a href="javascript:;">Number <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_password">
                                    <a href="javascript:;">Password <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_date">
                                    <a href="javascript:;">Date <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <!-- <li class="form_bal_button">
                                    <a href="javascript:;">Button <i class="fa fa-plus-circle pull-right"></i></a>
                                </li> -->
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>


            <!-- <div class="form_builder_area"> -->

                <!-- </div> -->
            <!-- <div class="clearfix"></div> -->
           <!--  <div class="form_builder" style="margin-top: 25px">
                <div class="row">
                    <div class="col-sm-2">


                    </div>
                    <div class="col-md-5 bal_builder">

                    </div>
                    <div class="col-md-5">
                        <div class="col-md-12">
                            <form class="form-horizontal">

                                <div style="display: none" class="form-group plain_html"><textarea rows="50" class="form-control"></textarea></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->


</div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/form_builder.js"></script>
        <script type="text/javascript" src="../../library/dialog.js?v=<?php echo $v_js_includes; ?>"></script>
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body" id="formData">
          <p>Some text in the modal.</p>
        </div>

      </div>

    </div>
  </div>

    </body>


<script type="text/javascript">
    $(".initial_form_status").click(function(){

        var data_id = $(this).attr('data-id');
        var status = $(this).attr('status');
        //alert(data_id);  
        $('.initial_form_status').removeClass('status_active');
        $(this).addClass('status_active');
        $('.hide_form').hide();
        $("#"+data_id).show();
        $(".text_val").val('');
        full_form_detail(status);

    })
    var somethingChanged = false;
    // alert();
    // layout change function call
    $("#layout_id").change(function() {
        // alert();
      if (!myChangeCheck()) { // check layout
        $("#layout_id").val(" ");
        return;
      }
      mySubmit();
    });


    function mySubmit()  // form submit function
    {
         somethingChanged = false;
         top.restoreSession();
         // console.log(top.restoreSession());
         document.forms[0].submit();
    }

    function myChangeCheck()
    {
      if (somethingChanged) {
        if (!confirm('<?php echo xls('You have unsaved changes. Abandon them?'); ?>')) {
          return false;
        }
        // Do not set somethingChanged to false here because if they cancel the
        // action then the previously changed values will still be of interest.
      }
      return true;
    }
</script>

<!---------- Form Design ------------>
<script type="text/javascript">

    var groupDetails = ' ';
    var groupid = ' ';
    var field_order_id = ' ';
    var grp_name = ' ';
    var form_status_id=0;
    // console.log(groupDetails,groupid,field_order_id,grp_name);
    var fieldId = [];
    var optionArr = [];
    var formData = <?=json_encode($form_result)?>;
    var formData2 = <?=json_encode($form_result1)?>;
    var edit_id = '';
    $("#form_2").hide();
    $("#form_name").val($("#form_name_label").text());

    function editFormLabel(flag)
    {
        $(".entryForm").hide();
        $("#form_"+flag).show();
        if(flag==1)
        {
            $("#form_name_label").text($("#form_name").val());
        }else
        {
            $("#form_name").val($("#form_name_label").text());

        }
    }

    $("body").on("click",".delete",function(event){
        event.preventDefault();
        var cls=$(this);
        if(confirm("Are you Sure")){
            $.ajax({
                type: "POST",
                url: "index.php",
                data: {id:edit_id,action:'Delete'},
                success: function (res) { 
                    if(res){
                        $(cls).closest("tr").remove();
                        location.reload();                     
                    }
                    else{
                        alert("Try again");
                        $(cls).text("Try again");
                    }
                }
            });
        }
    });
$(document).ready(function () {

    $(".form_bal_textfield").draggable({
        helper: function () {
          return showtextinput(1);
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_textarea").draggable({
        helper: function () {
            return showtextinput(3);
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_number").draggable({
        helper: function () {
            return showtextinput(8);
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_email").draggable({
        helper: function () {
            return showtextinput(7);
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_password").draggable({
        helper: function () {
            return showtextinput(9);
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_date").draggable({
        helper: function () {
            return showtextinput(10);
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_button").draggable({
        helper: function () {
            return ;//showtextinput(2);
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_select").draggable({
        helper: function () {
            return showtextinput(4);
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_radio").draggable({
        helper: function () {
            return showtextinput(5);
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_checkbox").draggable({
        helper: function () {
            return showtextinput(6);
        },
        connectToSortable: ".form_builder_area"
    });

    $(".form_builder_area").sortable({
        cursor: 'move',
        placeholder: 'placeholder',
        start: function (e, ui) {
            ui.placeholder.height(ui.helper.outerHeight());
        },
        stop: function (ev, ui) {
            getPreview();
        }
    });


    function showtextinput(flag)
    {
        // alert();
        var field = generateField();
        var html='';
        var opt1 = '';
        fieldId.push(field);
        switch(flag){
         case 1: //textbox
            html = '<div class="form-group"><label class="control-label">Text Field</label><input type="text" name="" placeholder="" class="form-control"><i class="fa fa-cog pull-right" data-field="' + field + ' "onclick="formProperty('+field+','+flag+','+opt1+')";></i></div>';
         break;
         case 2: //button
            //  html = '<div class="form-group"><label class="control-label">Label</label><button type="" class="btn btn-primary" name="" placeholder="">Button</button><i class="fa fa-cog pull-right txt" data-field="' + field + '"></i></div>';
         break;
         case 3: //textarea
            html = '<div class="form-group"><label class="control-label">Textarea</label><textarea rows="3" name="" placeholder="" class="form-control"/><i class="fa fa-cog pull-right" data-field="' + field + ' "onclick="formProperty('+field+','+flag+','+opt1+')";></i></div>';
         break;
         case 4: // Select
            opt1 = generateField();
             html = '<div class="form-group"><label class="control-label">Select</label><select class="form-control" name=""><option data-opt="' + opt1 + '" value="Value">Option</option></select><i class="fa fa-cog pull-right" data-field="' + field + ' "onclick="formProperty('+field+','+flag+','+opt1+')";></i></div>';
         break;
         case 5: //radioButton
            opt1 = generateField();
             html = '<div class="form-group"><div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" name="" value="">radio</label><i class="fa fa-cog pull-right" data-field="' + field + ' "onclick="formProperty('+field+','+flag+','+opt1+')";></i></div></div>';
         break;
         case 6: //Checkbox
             opt1 = generateField();
             html = '<div class="form-group"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="" value="">Checkbox</label><i class="fa fa-cog pull-right" data-field="' + field + ' "onclick="formProperty('+field+','+flag+','+opt1+')";></i></div></div>';
         break;
         case 7: //Email
            html = '<div class="form-group"><label class="control-label">Email</label><input type="email" name="" placeholder="" class="form-control"><i class="fa fa-cog pull-right" data-field="' + field + ' "onclick="formProperty('+field+','+flag+','+opt1+')";></i></div>';
         break;
         case 8: //Number
            html = '<div class="form-group"><label class="control-label">Number</label><input type="number" name="" placeholder="" class="form-control"><i class="fa fa-cog pull-right" data-field="' + field + ' "onclick="formProperty('+field+','+flag+','+opt1+')";></i></div>';
         break;
         case 9: //Password
            html = '<div class="form-group"><label class="control-label">Password</label><input type="password" name="" placeholder="" class="form-control"><i class="fa fa-cog pull-right" data-field="' + field + ' "onclick="formProperty('+field+','+flag+','+opt1+')";></i></div>';
         break;
         case 10: //Date
            html = '<div class="form-group"><label class="control-label">Date</label><input type="date" name="" placeholder="" class="form-control"><i class="fa fa-cog pull-right" data-field="' + field + ' "onclick="formProperty('+field+','+flag+','+opt1+')";></i></div>';
         break;
         default:
         break;



        }
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }


    $(".form_builder_area").disableSelection();



    $(document).on('click', '.add_more_select', function () {
        $(this).closest('.form_builder_field').css('height', 'auto');
        var field = $(this).attr('data-field');
        var option = generateField();
        $('.field_extra_info_' + field).append('<div data-field="' + field + '" class="row select_row_' + field + '" data-opt="' + option + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="s_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="s_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_select" data-field="' + field + '"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_select" data-field="' + field + '"></i></div></div>');
        var options = '';
        $('.select_row_' + field).each(function () {
            var opt = $(this).find('.s_opt').val();
            var val = $(this).find('.s_val').val();
            var s_opt = $(this).attr('data-opt');
            options += '<option data-opt="' + s_opt + '" value="' + val + '">' + opt + '</option>';
        });
        $('select[name=select_' + field + ']').html(options);
        getPreview();
    });
    $(document).on('click', '.add_more_radio', function () {
        $(this).closest('.form_builder_field').css('height', 'auto');
        var field = $(this).attr('data-field');
        var option = generateField();
        $('.field_extra_info_' + field).append('<div data-opt="' + option + '" data-field="' + field + '" class="row radio_row_' + field + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="r_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="r_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_radio" data-field="' + field + '"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_radio" data-field="' + field + '"></i></div></div>');
        var options = '';
        $('.radio_row_' + field).each(function () {
            var opt = $(this).find('.r_opt').val();
            var val = $(this).find('.r_val').val();
            var s_opt = $(this).attr('data-opt');
            options += '<label class="mt-radio mt-radio-outline"><input data-opt="' + s_opt + '" type="radio" name="radio_' + field + '" value="' + val + '"> <p class="r_opt_name_' + s_opt + '">' + opt + '</p><span></span></label>';
        });
        $('.radio_list_' + field).html(options);
        getPreview();
    });
    $(document).on('click', '.add_more_checkbox', function () {
        $(this).closest('.form_builder_field').css('height', 'auto');
        var field = $(this).attr('data-field');
        var option = generateField();
        $('.field_extra_info_' + field).append('<div data-opt="' + option + '" data-field="' + field + '" class="row checkbox_row_' + field + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="c_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="c_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_checkbox" data-field="' + field + '"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_checkbox" data-field="' + field + '"></i></div></div>');
        var options = '';
        $('.checkbox_row_' + field).each(function () {
            var opt = $(this).find('.c_opt').val();
            var val = $(this).find('.c_val').val();
            var s_opt = $(this).attr('data-opt');
            options += '<label class="mt-checkbox mt-checkbox-outline"><input data-opt="' + s_opt + '" name="checkbox_' + field + '" type="checkbox" value="' + val + '"> <p class="c_opt_name_' + s_opt + '">' + opt + '</p><span></span></label>';
        });
        $('.checkbox_list_' + field).html(options);
        getPreview();
    });
    $(document).on('keyup', '.s_opt', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('select[name=select_' + field + ']').find('option[data-opt=' + option + ']').html(op_val);
        getPreview();
    });
    $(document).on('keyup', '.s_val', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('select[name=select_' + field + ']').find('option[data-opt=' + option + ']').val(op_val);
        getPreview();
    });
    $(document).on('keyup', '.r_opt', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('.radio_list_' + field).find('.r_opt_name_' + option).html(op_val);
        getPreview();
    });
    $(document).on('keyup', '.r_val', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('.radio_list_' + field).find('input[data-opt=' + option + ']').val(op_val);
        getPreview();
    });
    $(document).on('keyup', '.c_opt', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('.checkbox_list_' + field).find('.c_opt_name_' + option).html(op_val);
        getPreview();
    });
    $(document).on('keyup', '.c_val', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('.checkbox_list_' + field).find('input[data-opt=' + option + ']').val(op_val);
        getPreview();
    });
    $(document).on('click', '.edit_bal_textfield', function () {
        var field = $(this).attr('data-field');
        var el = $('.field_extra_info_' + field);
        el.html('<div class="form-group"><input type="text" name="label_' + field + '" class="form-control" placeholder="Enter Text Field Label"/></div><div class="mt-checkbox-list"><label class="mt-checkbox mt-checkbox-outline"><input name="req_' + field + '" type="checkbox" value="1"> Required<span></span></label></div>');
        getPreview();
    });
    $(document).on('click', '.save_bal_field', function (e) {
        e.preventDefault();
        var inputname='';
        $('.form_input_name').each(function(){
           inputname=$(this).val();
        });

        var field = $(this).attr('data-field');
        // alert();
        // $('.li_' + field).hide('400', function () {
            //$(this).hide();
            if(inputname==''){
                $('.form_input_name').css('border-color','red');
                $('.form_input_name').attr('placeholder','Field name requierd');
                $('.form_input_name').addClass('your-class');
                return false;
            }

            $(".modal").modal('hide');
            getPreview('','save');
        // });
    });
    $(document).on('click', '.remove_bal_field', function (e) {
        e.preventDefault();
        var field = $(this).attr('data-field');
        var errorcount=0;
        //alert(field);
        // if(edit_id!='')
        // {
            $.ajax(
            {
                method :"POST",
                data:{'check_field_value':'true','inputfield_id':field},
                dataType:'json',
                url:'./index.php',
                success:function(res)
                {
                   // alert(res);

                     if(res!=0){
                        errorcount=res;
                        alert('are you sure want to delete?this field holding a patient information');
                        return false;
                     }
                     else{
                        delete optionArr[field];
                        $('.form-extra_' + field).hide('400', function () {
                            $(this).remove();
                            $(".modal").modal('hide');
                            getPreview();
                        });
                     }

                }
            });
        //}
        // if(errorcount==0)
        // {
        //     alert(edit_id);
        //     // console.log($(this).closest('.li_' + field));

        // }

    });


    $(document).on('click', '.remove_more_select', function () {
        var field = $(this).attr('data-field');
        $(this).closest('.select_row_' + field).hide('400', function () {
            $(this).remove();
            var options = '';
            $('.select_row_' + field).each(function () {
                var opt = $(this).find('.s_opt').val();
                var val = $(this).find('.s_val').val();
                var s_opt = $(this).attr('data-opt');
                options += '<option data-opt="' + s_opt + '" value="' + val + '">' + opt + '</option>';
            });
            $('select[name=select_' + field + ']').html(options);
            getPreview();
        });
    });
    $(document).on('click', '.remove_more_radio', function () {
        var field = $(this).attr('data-field');
        $(this).closest('.radio_row_' + field).hide('400', function () {
            $(this).remove();
            var options = '';
            $('.radio_row_' + field).each(function () {
                var opt = $(this).find('.r_opt').val();
                var val = $(this).find('.r_val').val();
                var s_opt = $(this).attr('data-opt');
                options += '<label class="mt-radio mt-radio-outline"><input data-opt="' + s_opt + '" type="radio" name="radio_' + field + '" value="' + val + '"> <p class="r_opt_name_' + s_opt + '">' + opt + '</p><span></span></label>';
            });
            $('.radio_list_' + field).html(options);
            getPreview();
        });
    });
    $(document).on('click', '.remove_more_checkbox', function () {
        var field = $(this).attr('data-field');
        $(this).closest('.checkbox_row_' + field).hide('400', function () {
            $(this).remove();
            var options = '';
            $('.checkbox_row_' + field).each(function () {
                var opt = $(this).find('.c_opt').val();
                var val = $(this).find('.c_val').val();
                var s_opt = $(this).attr('data-opt');
                options += '<label class="mt-checkbox mt-checkbox-outline"><input data-opt="' + s_opt + '" name="checkbox_' + field + '" type="checkbox" value="' + val + '"> <p class="r_opt_name_' + s_opt + '">' + opt + '</p><span></span></label>';
            });
            $('.checkbox_list_' + field).html(options);
            getPreview();
        });
    });
    $(document).on('keyup', '.form_input_button_class', function () {
        getPreview();
    });
    $(document).on('keyup', '.form_input_button_value', function () {
        getPreview();
    });
    $(document).on('change', '.form_input_req', function () {
        getPreview();
    });
    $(document).on('keyup', '.form_input_placeholder', function () {
        getPreview();
    });
    $(document).on('keyup', '.form_input_label', function () {
        getPreview();
    });
    $(document).on('keyup', '.form_input_name', function () {
        getPreview();
    });
    function generateField() {
        return Math.floor(Math.random() * (100000 - 1 + 1) + 57);
    }
    $(document).on('click','.remove_view',function(e)
    {
        e.preventDefault();
        var field = $(this).attr('data-field');
        //         var index = fieldId.indexOf(field);
        // fieldId.splice(index,1);
        $.ajax(
            {
                method :"POST",
                data:{'check_field_value':'true','inputfield_id':field},
                dataType:'json',
                url:'./index.php',
                success:function(res)
                {


                     if(res!=0){
                        errorcount=res;
                        alert('are you sure want to delete?this field holding a patient information');
                        return false;
                     }
                     else{
                        delete optionArr[field];
                        $(".form-extra_"+field).hide('400', function () {
                            $(this).remove();
                            $("#formData").html('');
                            getPreview();
                        });
                     }

                }
            });

        // $(this).closest('.li_'+field).remove();

    })

    function getPreview(plain_html = '',saveHtml='') {

        var el = $('.modal .form_output');
        var html = '';
        var form_array = [];
        var records = '';
        var required = '';

        var i = 0;
        var validation = [];
        el.each(function () {

            var data_type = $(this).attr('data-type');
            var field = $(this).attr('data-field');
            var group_id = $(this).attr('.data-group-id');
            var label = $(this).find('.form_input_label').val();
            var name = $(this).find('.form_input_name').val();
            var placeholder = $(this).find('.form_input_placeholder').val();
            //alert(data_type);


            if (data_type === 'textarea') {
                var placeholder = $(this).find('.form_input_placeholder').val();
                var checkbox = $(this).find('.form_input_req');
                // var required = '';
                if (checkbox.is(':checked')) {
                    required = 'required';
                    // records['required']  = 'required';
                }
                html += '<div class="col-md-6"><label class="control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label></div><div style="margin-top: -8px;"><textarea id="area_'+field+'" rows="2" style="height: 73px;" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + '/></div>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {'inputLabel':label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',inputId:name,inputPlaceholder:"",inputValue:"",inputOptions:"",inputOptionId:"","inputRequired":required,"inputfield_id":field};
                }
            }else if (data_type === 'select') {
                var option_html = '';
                var options = [];
                $(this).find('select option').each(function () {
                    var option = $(this).html();
                    var value = $(this).val();
                    if(saveHtml=='save')
                    {

                        options.push({'optLabel':option,'optValue':value});
                    }
                    option_html += '<option value="' + value + '">' + option + '</option>';
                });

                html += '<label class="col-md-6 control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label><div><select class="form-control" name="' + name + '" id="select_'+field+'" >' + option_html + '</select><span id="option_'+data_type+'_'+field+'" style="display:none;">'+$("#"+field).val()+'</span></div>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {"inputLabel":label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',inputId:name,inputPlaceholder:"",inputValue:"",inputOptions:options,inputOptionId:$("#"+field).val(),"inputRequired":"","inputfield_id":field};
                }
            }else if (data_type === 'radio') {

                var option_html = '';
                option_html +='<div style="max-height: 70px;overflow-y: auto;">';
                var options = [];
                $(this).find('.mt-radio').each(function () {
                    var option = $(this).find('p').html();

                    var value = $(this).find('input[type=radio]').val();
                    if(saveHtml=='save')
                    {
                         options.push({'optLabel':option,'optValue':value});

                    }
                    option_html += '<div class="col-md-8 form-check"><label class="form-check-label" data-type="'+data_type+'"><input type="radio" class="form-check-input" name="' + name + '" value="' + value + '">' + option + '</label></div>';

                });
                option_html +='</div>';
                html += '<div class="col-md-6"><label class="control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label></div>' + option_html +'<span id="option_'+data_type+'_'+field+'" style="display:none;">'+$("#"+field).val()+'</span>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {"inputLabel":label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',inputId:name,inputPlaceholder:"",inputValue:"",inputOptions:options,inputOptionId:$("#"+field).val(),"inputRequired":"","inputfield_id":field};
                }
            }else if (data_type === 'checkbox') {
                var option_html = '';
                option_html +='<div style="max-height: 70px;overflow-y: auto;">';
                var options = [];
                $(this).find('.mt-checkbox').each(function () {
                    var option = $(this).find('p').html();
                    var value = $(this).find('input[type=checkbox]').val();
                    // optionArr.push({'option':option,'value':value});
                    if(saveHtml=='save')
                    {
                        options.push({'optLabel':option,'optValue':value});

                    }
                    option_html += '<div class="col-md-8 form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="' + name + '[]" value="' + value + '">' + option + '</label></div>';
                });
                option_html +='</div>';
                html += '<div class="col-md-6"  ><label class="control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label></div>' + option_html +'<span id="option_'+data_type+'_'+field+'" style="display:none;">'+$("#"+field).val()+'</span>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {"inputLabel":label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',inputId:name,inputPlaceholder:"",inputValue:"",inputOptions:options,inputOptionId:$("#"+field).val(),"inputRequired":"","inputfield_id":field};
                }
            }
            else if(data_type==='text')
            {

                var checkbox = $(this).find('.form_input_req');
                // var required = '';
                if (checkbox.is(':checked')) {
                    required = 'required';
                    // records['required']  = 'required';
                }
                html += '<div class="col-md-12"><label class="control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label><div style="width:100%"><input style="width:100%;" type="'+data_type+'" data-field="'+field+'" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + ' id="text_'+field+'" style="width:180px;"/></div>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {"inputLabel":label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',"inputId":name,"inputPlaceholder":placeholder,"inputValue":"","inputOptions":"","inputOptionId":"","inputRequired":required,"inputfield_id":field};
                }
            }
            else
            {
                 var checkbox = $(this).find('.form_input_req');
                // var required = '';
                if (checkbox.is(':checked')) {
                    required = 'required';
                    // records['required']  = 'required';
                }
                html += '<div class="col-md-12"><label class="control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label><div><input type="'+data_type+'" data-field="'+field+'" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + ' id="text_'+field+'"/></div>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {"inputLabel":label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',"inputId":name,"inputPlaceholder":placeholder,"inputValue":"","inputOptions":"","inputOptionId":"","inputRequired":required,"inputfield_id":field};
                }
            }
            html +='<div class="col-md-12" style="margin-top:3px"><div class="col-md-2 pull-right"><button type="button" class="btn btn-primary btn-sm pull-right" data-field="' + field + '" onclick="editForm(\''+data_type+'\',\''+field+'\',\''+gflag+'\')"><i class="fa fa-pencil-square-o"></i></button></div><div class="col-md-2 pull-right"><button type="button" class="btn btn-primary btn-sm pull-right remove_view" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div>'
            if(saveHtml=='save')
            {
                var saveHtmlData = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/>';
                $("#customForm_"+field).html(saveHtmlData + $(this).html());

            }
            if (plain_html === 'html') {
                if(name =='')
                {
                    // console.log(name);
                    validation.push(data_type);
                }
                var groupData = '';
            records = {
                    "name" : name,
                    "id"   : name,
                    "data-field": field,
                    "label" : label,
                    "data_type" : data_type,
                    "required" : required,
                    "inputfield_id":field
            };
                if(data_type==='select')
                {
                    records['option_id'] = $("#"+field).val();
                }else if(data_type ==='radio')
                {
                    records['options'] = optionArr;
                }else if(data_type==='checkbox')
                {
                     records['options'] = optionArr;
                }
                // if(i!=0)
                // {
                //     field_oreder_id = +field_order_id + 10;
                // }else
                // {
                //     field_order_id = field_order_id;
                // }
                records['order_id'] = field_order_id;
                if(groupid !='')
                {
                        grp_name = grp_name;
                }else
                {
                        grp_name = $("#group_name").val();
                }
                var groupdetails = groupDetails = {'group_id':groupid,'grp_name':grp_name};
                groupData = {'groups':groupdetails,'records':records};
                // console.log(groupData);
            form_array.push(groupData);
            }
            i++;
        });
            // form_array.push()

    console.log(validation.length);
        if (html.length) {
            // alert();
            $('.export_html').show();
        } else {
            $('.export_html').hide();
        }
        if (plain_html === 'html') {
            $('.preview').show();

                console.log(opener);

                if(grp_name =='')
                {
                    alert('Please Enter Group Name');
                    return false;

              }else if(validation.length!=0)
              {
                    alert('Please Enter All Fields');
                    return false;
              }else
              {
                  console.log(form_array);
                // opener.setGroupItems(JSON.stringify(form_array),groupid,grp_name);
                //  dlgclose();
                  return false;
              }
            // $('.plain_html').show().find('textarea').val(html);
        } else {
            $('.plain_html').hide();

            $('.form-extra_'+field).html(html).show();
    }
    }
    $(document).on('click', '.export_html', function () {
       //(this).('data-field');
    //    alert();
        getPreview('html');
    });
});

function editForm(data_type,field,flag)
{

    var el = $(".form-extra_"+field);

            var label = $("#label_"+field).text();
            // console.log(label);
            formProperty(field,flag,'');


                var name = $(el).find('input').attr('name');
                var required = $(el).find('input').attr('required');
                var placeholder = $(el).find('input').attr('placeholder');
                $('.form_input_label').val(label);

                if(data_type=='checkbox')
                {
                    name = name.replace("[]","");
                }
                if(flag==3)
                {
                    name = $("#area_"+field).attr('name');
                    placeholder = $("#area_"+field).attr('placeholder');
                }
                if(flag==4)
                {
                   name = $("#select_"+field).attr('name');
                }
                $('.form_input_name').val(name);
                $('.form_input_placeholder').val(placeholder);

                console.log(required);
                if(required !==undefined)
                {
                    $('.form_input_req').attr('checked',true);
                }


                if(flag==4 || flag==5 || flag==6)
                {
                        var list = $("#option_"+data_type+"_"+field).text();
                        SetList(list);
                }



   // $(this).closest('.form_builder_field').css('height', 'auto');
  };
    var field = '';
    var html = '';
    var opt1 = '';
    var gflag = '';

    function formProperty(data_field,flag,option)
    // $(document).on('click', '.txt', function()
     {
    // alert('text');
    // console.log(flag);
    gflag = flag;

  field = data_field;
  html = '';
  opt1 = option;
   $("div.li_"+field+".form_builder_field").css('height', 'auto');
//    getSelectFieldHTML();
        // console.log($($(this).closest('.form_builder_field')));
        if(flag==1){
        html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="text" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" class="form-control form_input_placeholder" placeholder="Placeholder"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" required placeholder="Name"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req">Required</label></div></div><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm save_bal_field pull-right" data-field="' + field + '">save</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div>';
        // console.log(html);
        }else if(flag == 3)
        {
            html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="textarea" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" class="form-control form_input_placeholder" placeholder="Placeholder"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name"  required placeholder="Name"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req">Required</label></div><button type="button" class="btn btn-primary btn-sm save_bal_field pull-right" data-field="' + field + '">save</button><button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button></div></div>';
        }
        else if(flag==4)
        {
            html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div><hr/><div class="row li_row form_output" data-type="select" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" required placeholder="Name"/></div></div><div class="col-md-12"><div class="form-group"><select name="select_' + field + '" class="form-control"><option data-opt="' + opt1 + '" value="Value">Option</option></select></div></div></div><div class="row li_row"><div class="col-md-12"><div class="field_extra_info_' + field + '"><div data-field="' + field + '" class="row select_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-12"><div class="form-group"><input type="text" value="Option" class="s_opt form-control" id='+field+' onclick="editDrop()"/></div></div><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm save_bal_field pull-right" data-field="' + field + '">save</button><button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button></div></div>';
        }else if(flag==5)
        {
            html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div><hr/><div class="row li_row form_output" data-type="radio" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name"  placeholder="Name"/></div></div><div class="col-md-12"><div class="form-group"><div class="mt-radio-list radio_list_' + field + '"><label class="mt-radio mt-radio-outline"><input data-opt="' + opt1 + '" type="radio" name="radio_' + field + '" value="Value"> <p class="r_opt_name_' + opt1 + '">Option</p><span></span></label></div></div></div></div><div class="row li_row"><div class="col-md-12"><div class="form-group"><input type="text" value="Option" class="s_opt form-control" id='+field+' onclick="editDrop()"/></div></div><div class="col-md-12"><div class="field_extra_info_' + field + '"><div data-field="' + field + '" class="row radio_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm save_bal_field pull-right" data-field="' + field + '">save</button><button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button></div></div>';
        }else if(flag==6)
        {
            html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div><hr/><div class="row li_row form_output" data-type="checkbox" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name"/></div></div><div class="col-md-12"><div class="form-group"><div class="mt-checkbox-list checkbox_list_' + field + '"><label class="mt-checkbox mt-checkbox-outline"><input data-opt="' + opt1 + '" type="checkbox" name="checkbox_' + field + '" value="Value"> <p class="c_opt_name_' + opt1 + '">Option</p><span></span></label></div></div></div></div><div class="row li_row"><div class="col-md-12"><div class="field_extra_info_' + field + '"><div data-field="' + field + '" class="row checkbox_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-12"><div class="form-group"><input type="text" value="Option" class="s_opt form-control" id='+field+' onclick="editDrop()"/></div></div><button type="button" class="btn btn-primary btn-sm save_bal_field pull-right" data-field="' + field + '">save</button><button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button></div></div>';
        }
        else if(flag==7)
        {
            html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="email" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" class="form-control form_input_placeholder" placeholder="Placeholder"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req">Required</label></div><button type="button" class="btn btn-primary btn-sm save_bal_field pull-right" data-field="' + field + '">save</button><button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button></div></div>'
        }else if(flag==8)
        {
            html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="number" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" class="form-control form_input_placeholder" placeholder="Placeholder"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req">Required</label></div><button type="button" class="btn btn-primary btn-sm save_bal_field pull-right" data-field="' + field + '">save</button><button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button></div></div>'
        }else if(flag==9)
        {
            html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="password" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" class="form-control form_input_placeholder" placeholder="Placeholder"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req">Required</label></div><button type="button" class="btn btn-primary btn-sm save_bal_field pull-right" data-field="' + field + '">save</button><button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button></div></div>'
        }else if(flag==10)
        {
            html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="date" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req">Required</label></div><button type="button" class="btn btn-primary btn-sm save_bal_field pull-right" data-field="' + field + '">save</button><button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button></div></div>';
        }
        $("#formData").html('');
        $("#formData").html(html);

        $(".modal").modal('show');

        $(".li_"+field).remove();
        var customFormDiv = $("#customForm_"+field).html();
        var previewData = $('.form-extra_'+field).html();
        if(previewData === undefined)
        {
            $(".preview").append('<div class="col-md-6 form-group form-extra_'+field+'"></div>');
        }
        if(customFormDiv ===undefined)
        {
            $(".customForm").append('<div id="customForm_'+field+'">');
        }
     }

     function editDrop()
     {
         var title = '';
         dlgopen('../patient_file/encounter/find_code_dynamic.php?what=lists',"_blank", 850, 750, "", title);
     }

     function SetList(listid) {
        console.log(listid,opt1,field);
        // $(selectedfield).val(listid);

        $.ajax(
            {
                method:"post",
                data:{'listid':listid},
                url:'index.php',
                dataType:"json",
                success:function(res)
                {
                    var responce = [];
                   responce = res;
                    console.log(res);
                    $("#"+field).val(listid);
                    var options = '';
                    console.log(gflag);
                    if(responce.length !=0)
                    {

                        if(gflag==4)
                        {
                            $.each(responce,function(i,val)
                            {
                                options += '<option value='+val.option_id+'>'+val.title+'</option>';
                            });
                            $('select[name=select_' + field + ']').html(options);
                        }

                        if(gflag==5)
                        {
                            var option_html ='';
                          $.each(responce,function(i,val){
                                var option = val.option_id;
                                var value = val.title;

                            option_html += '<div class="col-md-8 form-check mt-radio"><label class="form-check-label"><input type="radio" class="form-check-input" name="radio_' + field + '" value="' + value + '"><p>' + option + '</p></label></div>';
                            });
                            $('.radio_list_'+field).html(option_html);
                        }
                        if(gflag==6)
                        {
                            var option_html ='';
                          $.each(responce,function(i,val){
                                var option = val.option_id;
                                var value = val.title;


                                option_html += '<div class="col-md-8 form-check mt-checkbox"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="' + field + '_[]" value="' + value + '"><p>' + option + '</p></label></div>';
                            });
                          $(".checkbox_list_"+field).html(option_html);
                        }

                    }
                }, error: function (request, status, error) {

                  },
            })
    }
    function clearArray(array) {
    while (array.length > 0) {
        array.pop();
    }
    }

    function saveForm()
    {
        var records = '';
        var formProperty = [];
        var namecount = [];
        if(namecount.length !=0){
            clearArray(namecount);
        }

        //console.log(optionArr);return false;
        optionArr.forEach(function(val,i)
        {
            namecount.push(val.inputName);
        });
        var  seen = new Set();
        var duplicates = namecount.filter(n => seen.size === seen.add(n).size);
        var duplicate_name=duplicates.length;
        console.log(duplicate_name);
        if(duplicate_name>0)
        {
                alert(duplicates +' filed name repeated please change anyone field');
                return false;
        }
        if(optionArr.length !=0)
        {
            optionArr = optionArr.filter(function(res){ return res});
            optionArr.forEach(function(val,i)
            {
                formProperty[i] = val;
            })
            records = {'formProperty':formProperty};
            var formName=$("#form_name").val();
            $.ajax(
            {
                method :"POST",
                data:{'data':records,'form_submit':'submit','form_id':edit_id,'formName':$("#form_name").val(),'form_type':$("#form_type").val()},
                dataType:'json',
                url:'./index.php',
                success:function(res)
                {
                    //alert(res);
                     if(res==1){
                        window.location.reload();
                     }
                     else{
                        alert(''+formName+' Form name alreday exit please change form name');
                        return false;
                     }


                }
            })
        }

    }


    function fetchForm(id)
    {
        $('.delete').css('display','block');
        $(".preview").empty();
        formFieldInfo = formData.filter(res=>res.id==id)[0];
        form_status_id = formFieldInfo.status;
        //alert(form_status_id);
        // console.log(formFieldInfo);
        //edit form id
        edit_id = formFieldInfo.id;
        //formName
        $("#form_name_label").text(formFieldInfo.form_name);
        $("#form_name").val(formFieldInfo.form_name);
        //json decode
        $jsonData = JSON.parse(formFieldInfo.form_json);
        //form render
        viewFormPage($jsonData);
        //active color
        $(".list-group-item").removeClass('active');
        $("#active_"+id).addClass('active');
    }

    function fetchForm2(id)
    {
        $(".preview").empty();
        formFieldInfo = formData2.filter(res=>res.id==id)[0];
        console.log(formData2);
        form_status_id = formFieldInfo.status;
        //alert(form_status_id);
        // console.log(formFieldInfo);
        //edit form id
        edit_id = formFieldInfo.id;
        //formName
        $("#form_name_label").text(formFieldInfo.form_name);
        $("#form_name").val(formFieldInfo.form_name);
        //json decode
        $jsonData = JSON.parse(formFieldInfo.form_json);
        //form render
        viewFormPage($jsonData);
        //active color
        $(".list-group-item").removeClass('active');
        $("#active_"+id).addClass('active');
    }

    function viewFormPage(formFieldData)
    {
        // console.log(field);
        //alert(form_status_id);
        if(form_status_id==0)
        {
            $(".status_button").show();
            $(".status_button").text('inactive');
        }
        else{
            $(".status_button").show();
            $(".status_button").text('active');
        }
        var html = '';
        optionArr = [];
        formFieldData.formProperty.forEach(function(val,i){
            console.log(val);
            if(typeof (val.inputfield_id)==='undefined')
            {
                var field = Math.floor(Math.random() * (100000 - 1 + 1) + 57);
            }
            else{
                var field = val.inputfield_id;
            }

            var label = val.inputLabel;
            var name = val.inputName;
            var placeholder = val.inputPlaceholder;
            var required = val.inputRequired;
            var inputoptions = val.inputOptions;
            console.log(required);
            var option_id = val.inputOptionId;
            var data_type = val.inputType;
            var saveHtml = 'save';
            var array = [{'id':1,'data_type':'text'},{'id':3,'data_type':'textarea'},{'id':4,'data_type':'select'},{'id':5,'data_type':'radio'},{'id':6,'data_type':'checkbox'},{'id':7,'data_type':'email'},{'id':8,'data_type':'number'},{'id':9,'data_type':'password'},{'id':10,'data_type':'date'}];
            gflag = array.filter(res=>res.data_type==data_type)[0];
            gflag = gflag.id;
        if (data_type === 'textarea') {

                // var required = '';

                html = '<div class="col-md-6"><label class="control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label></div><div style="margin-top: -8px;"><textarea id="area_'+field+'" rows="3" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + '/></div>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {'inputLabel':label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',inputId:name,inputPlaceholder:"",inputValue:"",inputOptions:"",inputOptionId:"","inputRequired":required,"inputfield_id":field};
                }
            }else if (data_type === 'select') {
                var option_html = '';
                var options = [];
                inputoptions.forEach(function (val,i) {
                    var option = val.optLabel;
                    var value = val.optValue;
                    console.log(value);
                    if(saveHtml=='save')
                    {

                        options.push({'optLabel':option,'optValue':value});
                    }
                    option_html += '<option value="' + value + '">' + option + '</option>';
                });

                html = '<label class="col-md-6 control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label><div><select class="form-control" name="' + name + '" id="select_'+field+'" >' + option_html + '</select><span id="option_'+data_type+'_'+field+'" style="display:none;">'+option_id+'</span></div>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {"inputLabel":label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',inputId:name,inputPlaceholder:"",inputValue:"",inputOptions:options,inputOptionId:option_id,"inputRequired":"","inputfield_id":field};
                }
            }else if (data_type === 'radio') {

                var option_html = '';
                option_html +='<div style="max-height: 70px;overflow-y: auto;">';
                var options = [];
                inputoptions.forEach(function (val,i) {
                    var option = val.optLabel;
                    var value = val.optValue;
                    if(saveHtml=='save')
                    {
                         options.push({'optLabel':option,'optValue':value});

                    }
                    option_html += '<div class="col-md-8 form-check"><label class="form-check-label" data-type="'+data_type+'"><input type="radio" class="form-check-input" name="' + name + '" value="' + value + '">' + option + '</label></div>';
                });
                option_html +='</div>';
                html = '<div class="col-md-6"><label class="control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label></div>' + option_html +'<span id="option_'+data_type+'_'+field+'" style="display:none;">'+option_id+'</span>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {"inputLabel":label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',inputId:name,inputPlaceholder:"",inputValue:"",inputOptions:options,inputOptionId:option_id,"inputRequired":"","inputfield_id":field};
                }
            }else if (data_type === 'checkbox') {
                var option_html = '';
                var options = [];
                option_html +='<div style="max-height: 70px;overflow-y: auto;">';
                inputoptions.forEach(function (val,i) {
                    var option = val.optLabel;
                    var value = val.optValue;
                    // optionArr.push({'option':option,'value':value});
                    if(saveHtml=='save')
                    {
                        options.push({'optLabel':option,'optValue':value});

                    }
                    option_html += '<div class="col-md-8 form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="' + name + '[]" value="' + value + '">' + option + '</label></div>';
                });
                option_html +='</div>';
                html = '<div class="col-md-6"  ><label class="control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label></div>' + option_html +'<span id="option_'+data_type+'_'+field+'" style="display:none;">'+option_id+'</span>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {"inputLabel":label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',inputId:name,inputPlaceholder:"",inputValue:"",inputOptions:options,inputOptionId:option_id,"inputRequired":"","inputfield_id":field};
                }
            }else
            {
                html = '<div class="col-md-12"><label class="control-label" id="label_'+field+'" data-type="'+data_type+'">' + label + '</label><div class="col-md-12"><input type="'+data_type+'" data-field="'+field+'" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + ' id="text_'+field+'"/></div>';
                if(saveHtml =='save')
                {
                    optionArr[field] = {"inputLabel":label,'inputType':data_type,'inputName':name,'inputClass':name+' col-md-6',"inputId":name,"inputPlaceholder":placeholder,"inputValue":"","inputOptions":"","inputOptionId":"","inputRequired":required,"inputfield_id":field};
                }
            }
            html +='<div class="col-md-12" style="margin-top:3px"><div class="col-md-2 pull-right"><button type="button" class="btn btn-primary btn-sm pull-right" data-field="' + field + '" onclick="editForm(\''+data_type+'\',\''+field+'\',\''+gflag+'\')"><i class="fa fa-pencil-square-o"></i></button></div><div class="col-md-2 pull-right"><button type="button" class="btn btn-primary btn-sm pull-right remove_view" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div>';

            $(".preview").append('<div class="col-md-6 form-group form-extra_'+field+'"></div>');

            $(".form-extra_"+field).html('');
            $('.form-extra_'+field).html(html).show();
        });

    }

    $(".status_button").on('click',function(){
        // alert(edit_id);
        // alert(form_status_id);
        $.ajax(
            {
                method :"POST",
                data:{'form_status_id':form_status_id,'edit_id':edit_id},
                dataType:'json',
                url:'./index.php',
                success:function(res)
                {
                    window.location.reload();
                }
            });

    });


    function full_form_detail(status){
        var list ='';
        $.ajax({
              url: './index.php',
              method: 'POST',
              data: {'full_search_query':'query','status':status},
              success: function(data){
                
                //console.log(data);
                if(data=='empty'){
                    list='<li class="list-group-item">no form data</li>';
                }
                else{
                    data=JSON.parse(data);
                    $.each( data, function( key, value ) {
                        console.log(value);
                        //<li class="list-group-item" id="active_<?=$res['id'];?>" data_id="<?=$res['status'];?>" onclick="fetchForm2(<?=$res['id'];?>)"><?=$res['form_name'];?></li>
                        if(status==0){
                        list +='<li class="list-group-item" id="active_'+value.id+'" data-id="'+value.status+'" onclick="fetchForm('+value.id+')">'+value.form_name+'</li>';
                        }
                        else{
                            list +='<li class="list-group-item" id="active_'+value.id+'" data-id="'+value.status+'" onclick="fetchForm2('+value.id+')">'+value.form_name+'</li>';  
                        }
                        // $("#active_form_ul").html('<li class="list-group-item">'+value.form_name+'</li>');
                    });
                }
                if(status==0){
                        $("#active_form_ul").html(list);
                    }
                    else{
                        $("#inactive_form_ul").html(list);
                    }
              }
              
            });

    }
 

    $(".text_val").keyup(function(){
          var status = $(this).attr('status');
          var query = $(this).val();
          var list ='';
          if (query != "") {
            $.ajax({
              url: './index.php',
              method: 'POST',
              data: {'search_query':query,'status':status},
              success: function(data){
                
                //console.log(data);
                if(data=='empty'){
                    list='<li class="list-group-item">no form data</li>';
                }
                else{
                    data=JSON.parse(data);
                    $.each( data, function( key, value ) {
                        if(status==0){
                        list +='<li class="list-group-item" id="active_'+value.id+'" data-id="'+value.status+'" onclick="fetchForm('+value.id+')">'+value.form_name+'</li>';
                        }
                        else{
                            list +='<li class="list-group-item" id="active_'+value.id+'" data-id="'+value.status+'" onclick="fetchForm2('+value.id+')">'+value.form_name+'</li>';  
                        }
                       // $("#active_form_ul").html('<li class="list-group-item">'+value.form_name+'</li>');
                    });
                }
                if(status==0){
                        $("#active_form_ul").html(list);
                    }
                    else{
                        $("#inactive_form_ul").html(list);
                    }
              }
              
            });
            
          }
          else{
            full_form_detail(status);
          }
        });                  
 



</script>

<!------------ End ------------------->
</html>
