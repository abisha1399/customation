
<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
if ($formid) {
    $sql = "SELECT * FROM `form_medication1` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php Header::setupHeader(); ?>
    <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script> -->


</head>

<body>
    <div class="container mt-3">
        <div class="row">
          <div  style="border:1px solid black;" class="container-fluid">
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/form_medication1/save.php?id=<?php echo attr_url($formid); ?>">

<h2>Medication Administration log</h2>
<table style="width:100%;">
<tr>
    <td style="width:30%;">
    <label>Patient Name:</label><input  type="text" name="input92" value="<?php echo text($check_res['input92']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
</td>
<td style="width:30%;">
    <label>DOB:</label><input  type="date" value="<?php echo text($check_res['input93']);?>" name="input93" style="border:none;border-bottom:2px solid black;width:150px;"/>
</td>
<td style="width:30%;">
    <label>Allergies:</label><input  type="text" value="<?php echo text($check_res['input94']);?>" name="input94" style="border:none;border-bottom:2px solid black;width:150px;"/>
</td>

</tr>
</table><br><br><br>

<table class="table table-bordered" style="width:100%;">
      <thead>
    <tr>
      <th style="width:18%" scope="col">Medication,Dose,<br>Frequency,Route</th>
      <th style="width:9%" scope="col">Hour</th>
      <th style="width:9%" scope="col">Date/Nurse Initials</th>
      <th style="width:9%" scope="col">Patient Initials</th>
      <th style="width:9%" scope="col">Date/Nurse Initials</th>
      <th style="width:9%" scope="col">Patient Initials</th>
      <th style="width:9%" scope="col">Date/Nurse Initials</th>
      <th style="width:9%" scope="col">Patient Initials</th>
      <th style="width:9%" scope="col">Date/Nurse Initials</th>
      <th style="width:9%" scope="col">Patient Initials</th>
      
    </tr>
  </thead>
  <tbody>
  <tr>
      <td><input value="<?php echo text($check_res['input1']);?>" type="text" name="input1" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input2']);?>" type="text" name="input2" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input3']);?>" type="text" name="input3" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input4']);?>" type="text" name="input4" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input5']);?>" type="text" name="input5" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input6']);?>" type="text" name="input6" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input7']);?>" type="text" name="input7" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input8']);?>" type="text" name="input8" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input9']);?>" type="text" name="input9" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input10']);?>" type="text" name="input10" style="border:none;width:90%;"/></td>

    </tr>
    <tr>
      <td><input value="<?php echo text($check_res['input11']);?>" type="text" name="input11" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input12']);?>" type="text" name="input12" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input13']);?>" type="text" name="input13" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input14']);?>" type="text" name="input14" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input15']);?>" type="text" name="input15" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input16']);?>" type="text" name="input16" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input17']);?>" type="text" name="input17" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input18']);?>" type="text" name="input18" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input19']);?>" type="text" name="input19" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input20']);?>" type="text" name="input20" style="border:none;width:90%;"/></td>

    </tr>
    <tr>
      <td><input value="<?php echo text($check_res['input21']);?>" type="text" name="input21" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input22']);?>" type="text" name="input22" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input23']);?>" type="text" name="input23" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input24']);?>" type="text" name="input24" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input25']);?>" type="text" name="input25" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input26']);?>" type="text" name="input26" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input27']);?>" type="text" name="input27" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input28']);?>" type="text" name="input28" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input29']);?>" type="text" name="input29" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input30']);?>" type="text" name="input30" style="border:none;width:90%;"/></td>

    </tr>
    <tr>
      <td><input value="<?php echo text($check_res['input31']);?>" type="text" name="input31" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input32']);?>" type="text" name="input32" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input33']);?>" type="text" name="input33" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input34']);?>" type="text" name="input34" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input35']);?>" type="text" name="input35" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input36']);?>" type="text" name="input36" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input37']);?>" type="text" name="input37" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input38']);?>" type="text" name="input38" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input39']);?>" type="text" name="input39" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input40']);?>" type="text" name="input40" style="border:none;width:90%;"/></td>

    </tr>
    <tr>
      <td><input value="<?php echo text($check_res['input41']);?>" type="text" name="input41" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input42']);?>" type="text" name="input42" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input43']);?>" type="text" name="input43" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input44']);?>" type="text" name="input44" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input45']);?>" type="text" name="input45" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input46']);?>" type="text" name="input46" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input47']);?>" type="text" name="input47" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input48']);?>" type="text" name="input48" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input49']);?>" type="text" name="input49" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input50']);?>" type="text" name="input50" style="border:none;width:90%;"/></td>

    </tr>
    <tr>
      <td><input value="<?php echo text($check_res['input51']);?>" type="text" name="input51" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input52']);?>" type="text" name="input52" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input53']);?>" type="text" name="input53" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input54']);?>" type="text" name="input54" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input55']);?>" type="text" name="input55" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input56']);?>" type="text" name="input56" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input57']);?>" type="text" name="input57" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input58']);?>" type="text" name="input58" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input59']);?>" type="text" name="input59" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input60']);?>" type="text" name="input60" style="border:none;width:90%;"/></td>

    </tr>
    <tr>
      <td><input value="<?php echo text($check_res['input61']);?>" type="text" name="input61" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input62']);?>" type="text" name="input62" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input63']);?>" type="text" name="input63" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input64']);?>" type="text" name="input64" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input65']);?>" type="text" name="input65" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input66']);?>" type="text" name="input66" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input67']);?>" type="text" name="input67" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input68']);?>" type="text" name="input68" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input69']);?>" type="text" name="input69" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input70']);?>" type="text" name="input70" style="border:none;width:90%;"/></td>

    </tr>
    <tr>
      <td><input value="<?php echo text($check_res['input71']);?>" type="text" name="input71" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input72']);?>" type="text" name="input72" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input73']);?>" type="text" name="input73" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input74']);?>" type="text" name="input74" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input75']);?>" type="text" name="input75" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input76']);?>" type="text" name="input76" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input77']);?>" type="text" name="input77" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input78']);?>" type="text" name="input78" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input79']);?>" type="text" name="input79" style="border:none;width:90%;"/></td>
      <td><input value="<?php echo text($check_res['input80']);?>" type="text" name="input80" style="border:none;width:90%;"/></td>

    </tr>
</table><br><br><br>
<table style="width:100%">
    <tr>
    <td style="width:20%"> Order Date:<br><input value="<?php echo text($check_res['input81']);?>" type="date" name="input81" style="border:none;border-bottom:1px solid black;"/></td>
    <td style="width:20%"> Parents Signature:
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <input type="hidden" name="input82" id="input82" style="width:60%;" value="<?php echo text($check_res['input82']);?>"/>
    <img src='' class="img" id="img_input82" style="display:none;width:50%;height:100px;">
    </td>
    <td style="width:20%"> Parents Initials:<br><input value="<?php echo text($check_res['input83']);?>" type="text" name="input83" style="border:none;border-bottom:1px solid black;"/></td>
    <td style="width:20%"> Reasons Medication not given:<br><br>
1.Patient Refused<br>
2.Patient Condition<br>
3.Hold per MD order



</td>



</tr>
<tr>
    <td style="width:20%"> Nurse transcribing:<input value="<?php echo text($check_res['input84']);?>" type="text" name="input84" style="border:none;border-bottom:1px solid black;"/></td>
</tr>

<tr>
    <td style="width:20%"> Verifying Nurse:<input value="<?php echo text($check_res['input85']);?>" type="text" name="input85" style="border:none;border-bottom:1px solid black;"/></td>
    <td style="width:20%"> Nurse Signature:
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <input type="hidden" name="input86" id="input86" style="width:60%;" value="<?php echo text($check_res['input86']);?>"/>
    <img src='' class="img" id="img_input86" style="display:none;width:50%;height:100px;">
    </td>
    <td style="width:20%"> Nurse Initials:<input value="<?php echo text($check_res['input87']);?>" type="text" name="input87" style="border:none;border-bottom:1px solid black;"/></td>
</tr>

<tr>
    <td style="width:20%"></td>
    <td style="width:20%"> Nurse Signature:
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <input type="hidden" name="input88" id="input88" style="width:60%;" value="<?php echo text($check_res['input88']);?>"/>
    <img src='' class="img" id="img_input88" style="display:none;width:50%;height:100px;">
    </td>
    <td style="width:20%"> Nurse Initials:<input value="<?php echo text($check_res['input89']);?>" type="text" name="input89" style="border:none;border-bottom:1px solid black;"/></td>
</tr>

<tr>
    <td style="width:20%"></td>
    <td style="width:20%"> Nurse Signature:
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <input type="hidden" name="input90" id="input90" style="width:60%;" value="<?php echo text($check_res['input90']);?>"/>
    <img src='' class="img" id="img_input90" style="display:none;width:50%;height:100px;">
    </td>
    <td style="width:20%"> Nurse Initials:<input value="<?php echo text($check_res['input91']);?>" type="text" name="input91" style="border:none;border-bottom:1px solid black;"/></td>
</tr>
   
</table><br><br>




<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit"  name="sub" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button><br><br>



</form>
</div>
</div>
</div>
       <!-- Modal -->
       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="sig">
                            <img id="view_img" style="display:none" width='380px' height='144px'>
                        </div>
                        <br />
                        <br />
                        <br />
                        <button id="clear">Clear</button>
                        <textarea id="sign_data" style="display: none"></textarea>
                    </div>
                    <input type='button' id="add_sign" class="btn btn-success" data-dismiss="modal" value='Add Sign' style='float:right'>

                </div>
            </div>
        </div>
    </div>
    <!-- modal close -->
</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../customized/admission_orders/assets/js/jquery.signature.min.js"></script>
<script>
    var sig = $('#sig').signature({
        syncField: '#sign_data',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#view_img").attr("src", '');
        $("#view_img").css('display','none');
        $('canvas').css('display','block');
        $("#sign_data").val('');
    });



    var id_name, val, display_edit, icon;


      $('.pen_icon').click(function() {
        id_name = $(this).next('input').attr('id');
        var sign_value = $("#"+id_name).val();
        //alert(sign_value);
        if(sign_value!='')
        {
            // $("#sig").css('display','none');
            $('canvas').css('display','none');
            $("#view_img").css('display','block');
            $("#view_img").attr("src", sign_value);
            $("#sign_data").val(sign_value);

        }
        // else{
        //     $("#)
        // }
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        $('#' + id_name).val(sign);
        if(sign!='')
        {
            $("#img_"+id_name).attr('src',sign);
            $("#img_"+id_name).css('display','block');
        }
        else{
            $("#img_"+id_name).css('display','none');
        }

        $('#sign_data').val('');
        sig.signature('clear');
       // $("#sign_data").val('');
       // check_sign();
    });

    $('.radio_change').on('change',function(){
        var checkbox_class= $(this).attr('data-id');
        if($(this).is(":checked"))
        {
            $('.'+checkbox_class).prop('checked',false);
            $(this).prop('checked',true);
            // $('#'+checkbox_class).val($(this).val());
        }
    })

    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {

            var id_name1 = $(this).next('input').attr('id');
            var sign_value = $("#"+id_name1).val();

            if(sign_value!='')
            {
                $("#img_"+id_name1).css('display','block');
                $("#img_"+id_name1).attr('src',sign_value);

            }

        });

    }
</script>
</html>    
