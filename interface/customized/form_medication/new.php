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
if ($formid) {
    $sql = "SELECT * FROM `form_medications` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo xlt("Form Medications"); ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php Header::setupHeader(); ?>
      <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
    	input[type=text] {
          border: none;
          border-bottom: 2px solid black;
}
.bt{
	width: 100px;
    margin: auto;
    margin-top: 10px;
    display: flex;
}
.container{
	border: 2px solid black;
}
    </style>
</head>
<body>
 <div class="container mt-3">
  <div class="container-fluid">
     <div class="row">  
     <div class="col-6">
     	<h5>Center for Network Therapy</h5>
     	<p>20 Gibson,Suite 103<br>Freehold,NJ 07728<br/>732-431-5800</p>
     	<br/>
     	<h4>PRN Medication Monitoring</h4>
     	<br/>
     	<h5>Current Level of Discomfort:(0,1,2,3,4,5,6,7,8,9,10)</h5>
     	<h5>Reassessment of Discomfort:(0,1,2,3,4,5,6,7,8,9,10)</h5>
     	<br/>
     	
     </div>
    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/form_medication/save.php?id=<?php echo attr_url($formid); ?>">
     <div class="col-6">
     	<h5>Patients Name:<input type="text" name="name"  value=" <?php echo text($check_res['patient_name']); ?>"></h5>
      <h5>DOB:<input type="date" name="dob" value="<?php echo text($check_res['dob']); ?>"></h5>
     	<br/><br/><br/><br/><br/><br/><br/><br/>
     </div>      
     </div>
     <div class="row">
        <div class="col-4">
        <h5>Medication:<br/><input type="text" name="medication" value="<?php echo text($check_res['medication']); ?>"></h5>
     	<h5>Date/Time:<br/><input type="datetime-local" name="dt" value="<?php echo text($check_res['dtime']); ?>"></h5>
     	<h5>Current Level:<input type="text" name="current" value="<?php echo text($check_res['current']); ?>"></h5>
     	<h5>Withdraw s/s:<input type="text" name="withdraw" value="<?php echo text($check_res['withdraw']); ?>"></h5>
     	<h5>Nurse's Signature: </h5>
        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" name="nurse" id="nurse" style="width:60%;" value="<?php echo text($check_res['nurse']);?>"/>
         <img src='' class="img" id="img_nurse" style="display:none;width:50%;height:100px;">
        </div>
        <div class="col-4">
        	<h5>Post comfort Level<br/><input type="text" name="post" value="<?php echo text($check_res['post']); ?>"></h5>
        </div>
        <div class="col-4">
        	<h5>Med Effective:yes/no<br/>
                <input type="checkbox" class="medcheck1" name="med" value="1"<?php 
        if($check_res['med']=="1"){
           echo "checked";
        }
        ?> >YES/
                <input type="checkbox" class="medcheck1" name="med" value="2"<?php 
        if($check_res['med']=="2"){
           echo "checked";
        }
        ?>>NO</h5>
        </div>   
  	     	     	
     </div>
     <br/>
     <div class="row">
        <div class="col-4">
        <h5>Medication:<br/><input type="text" name="medication1" value="<?php echo text($check_res['medication1']); ?>"></h5>
     	<h5>Date/Time:<br/><input type="datetime-local" name="dt1" value="<?php echo text($check_res['dtime1']); ?>"></h5>
     	<h5>Current Level:<input type="text" name="current1" value="<?php echo text($check_res['current1']); ?>"></h5>
     	<h5>Withdraw s/s:<input type="text" name="withdraw1" value="<?php echo text($check_res['withdraw1']); ?>"></h5>
     	<h5>Nurse's Signature: </h5>
        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" name="nurse1" id="nurse1" style="width:60%;" value="<?php echo text($check_res['nurse1']);?>"/>
         <img src='' class="img" id="img_nurse1" style="display:none;width:50%;height:100px;">
        </div>
        <div class="col-4">
        	<h5><input type="text" name="post1" value="<?php echo text($check_res['post1']); ?>"></h5>
        </div>
        <div class="col-4">
        	<h5>
                <input type="checkbox" class="medcheck2" name="med1" value="1"<?php 
        if($check_res['med1']=="1"){
           echo "checked";
        }
        ?> >YES/
                <input type="checkbox"  class="medcheck2" name="med1" value="2"<?php 
        if($check_res['med1']=="2"){
           echo "checked";
        }
        ?> >NO</h5>
        </div>     	     	     	
     </div>
     <br/>
     <div class="row">
        <div class="col-4">
        <h5>Medication:<br/><input type="text" name="medication2" value="<?php echo text($check_res['medication2']); ?>"></h5>
     	<h5>Date/Time:<br/><input type="datetime-local" name="dt2" value="<?php echo text($check_res['dtime2']); ?>"></h5>
     	<h5>Current Level:<input type="text" name="current2" value="<?php echo text($check_res['current2']); ?>"></h5>
     	<h5>Withdraw s/s:<input type="text" name="withdraw2" value="<?php echo text($check_res['withdraw2']); ?>"></h5>
     	<h5>Nurse's Signature: </h5>
        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" name="nurse2" id="nurse2" style="width:60%;" value="<?php echo text($check_res['nurse2']);?>"/>
         <img src='' class="img" id="img_nurse2" style="display:none;width:50%;height:100px;">
        </div>
        <div class="col-4">
        	<h5><input type="text" name="post2" value="<?php echo text($check_res['post2']); ?>"></h5>
        </div>
        <div class="col-4">
        	<h5><input type="checkbox" class="medcheck3" name="med2" value="1"<?php 
        if($check_res['med2']=="1"){
           echo "checked";
        }
        ?> >YES/<input type="checkbox" class="medcheck3" name="med2" value="2"<?php 
        if($check_res['med2']=="2"){
           echo "checked";
        }
        ?> >NO</h5>
        </div>     	     	     	
     </div>
     <br/>
     <div class="row">
        <div class="col-4">
        <h5>Medication:<br/><input type="text" name="medication3" value="<?php echo text($check_res['medication3']); ?>"></h5>
     	<h5>Date/Time:<br/><input type="datetime-local" name="dt3" value="<?php echo text($check_res['dtime3']); ?>"></h5>
     	<h5>Current Level:<input type="text" name="current3" value="<?php echo text($check_res['current3']); ?>"></h5>
     	<h5>Withdraw s/s:<input type="text" name="withdraw3" value="<?php echo text($check_res['withdraw3']); ?>"></h5>
     	<h5>Nurse's Signature: </h5>
        <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" name="nurse3" id="nurse3" style="width:60%;" value="<?php echo text($check_res['nurse3']);?>"/>
         <img src='' class="img" id="img_nurse3" style="display:none;width:50%;height:100px;"> 
        </div>
        <div class="col-4">
        	<h5><input type="text" name="post3" value="<?php echo text($check_res['post3']); ?>"></h5>
        </div>
        <div class="col-4">
        
        	<h5><input type="checkbox" class="medcheck4" name="med3" value="1"<?php 
        if($check_res['med3']=="1"){
           echo "checked";
        }
        ?> >YES/<input type="checkbox" class="medcheck4" name="med3" value="2"<?php 
        if($check_res['med3']=="2"){
           echo "checked";
        }
        ?> >NO</h5>
        </div>     	     	     	
     </div>
     <br/>
     <div class="row">
        <div class="col-4">
        <h5>Medication:<br/><input type="text" name="medication4" value="<?php echo text($check_res['medication4']); ?>"></h5>
     	<h5>Date/Time:<br/><input type="datetime-local" name="dt4" value="<?php echo text($check_res['dtime4']); ?>"></h5>
     	<h5>Current Level:<input type="text" name="current4" value="<?php echo text($check_res['current4']); ?>"></h5>
     	<h5>Withdraw s/s:<input type="text" name="withdraw4" value="<?php echo text($check_res['withdraw4']); ?>"></h5>
     	<h5>Nurse's Signature:
          </h5>
         <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
         <input type="hidden" name="nurse4" id="nurse4" style="width:60%;" value="<?php echo text($check_res['nurse4']);?>"/>
         <img src='' class="img" id="img_nurse4" style="display:none;width:50%;height:100px;"> 
        </div>
        <div class="col-4">
        	<h5><input type="text" name="post4" value=" <?php echo text($check_res['post4']); ?>"></h5>
        </div>
        <div class="col-4">
        	<h5><input type="checkbox" class="medcheck5" name="med4" value="1"<?php 
        if($check_res['med4']=="1"){
           echo "checked";
        }
        ?> >YES/<input type="checkbox" class="medcheck5" name="med4" value="2"<?php 
        if($check_res['med4']=="2"){
           echo "checked";
        }
        ?> >NO</h5>
        </div> 

                        <div class="btn-group bt" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-primary btn-save" style="margin-left: 15px;"><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>
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
     $('.medcheck1').on('change', function() {
     $('.medcheck1').not(this).prop('checked', false);
    $(this).prop('checked', true);
    });
     $('.medcheck2').on('change', function() {
     $('.medcheck2').not(this).prop('checked', false);
    $(this).prop('checked', true);
    });
     $('.medcheck3').on('change', function() {
     $('.medcheck3').not(this).prop('checked', false);
    $(this).prop('checked', true);
    });
     $('.medcheck4').on('change', function() {
     $('.medcheck4').not(this).prop('checked', false);
    $(this).prop('checked', true);
    });
     $('.medcheck5').on('change', function() {
     $('.medcheck5').not(this).prop('checked', false);
    $(this).prop('checked', true);
    });
</script>
</html>