<?php
/**
 * assessment_intake new.php.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */


require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
formHeader("New/Search Patient");
?>

<html><head>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.signature.css">
    <?php Header::setupHeader(); ?>

    <style>
        body{
            font-size:15px;
        }
    </style>
</head>

<body class="body_top">
<div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h4 align ="center"><?php echo xlt('Patient Information'); ?></h4>
<form method=post action="save.php?mode=new" name="my_form">

    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" /><br>

    <?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = ?", array($pid));
    $result = SqlFetchArray($res); ?>

<div class = "form-row">
<div class="forms col-md-1">
<b>Title</b>&nbsp;&nbsp; <select name='title' id='title' class="form-control name">
<option value=''>---</option>
    <?php
    $ores = sqlStatement("SELECT option_id, title FROM list_options " .
    "WHERE list_id = 'titles' AND activity = 1 ORDER BY seq");
    while ($orow = sqlFetchArray($ores)) {
        echo "    <option value='" . attr($orow['title']) . "'";
        if ($orow['option_id'] == $form_title) {
            echo " selected";
        }

        echo ">" . text($orow['title']) . "</option>\n";
    }
    ?>
   </select>
</div>
<div class="forms col-md-3">
    <b>First Name</b>&nbsp;&nbsp; <input type="text" name="fname" id="fname" class="form-control name">
</div>
<div class="forms col-md-3">
    <b>Middle Name </b>&nbsp;&nbsp;<input type="text" name = "mname" class="form-control" id="mname">
</div>
<div class="forms col-md-3">
    <b>Last Name</b>&nbsp;&nbsp;<input type="text" name = "lname" id = "lname" class="form-control name" >
</div>
<div class="forms col-md-2">
        <b>Telephone Number </b>&nbsp; <input type="text" name="phone" class="form-control tel" maxlength="15">
    </div>
</div><br>
<div class="form-row">
<div class="forms col-md-2">
<b>Date of Birth </b>&nbsp; <input type="date" name="dob" id="dob" class="form-control" onblur="myFunction()">
</div>
<div class="forms col-md-1">
<b>Age </b>&nbsp;<input type="text" name="age" id="age" class="form-control" disabled style="text-align:center">
</div>
<div class="forms col-md-3">
<b>Address </b>&nbsp;<input type="text" name="addr" id="addr" class="form-control name">
</div>
<div class="forms col-md-3">
<b>City </b>&nbsp;<input type="text" name="city" id="city" class="form-control name">
</div>
<div class="forms col-md-2">
<b>State/Zip </b>&nbsp;<select name='state' id='state' class="form-control name">
    <option value=''>Unassigned</option>
<?php
$ores = sqlStatement("SELECT option_id, title FROM list_options " .
  "WHERE list_id = 'state' AND activity = 1 ORDER BY seq");
while ($orow = sqlFetchArray($ores)) {
    echo "<option value='" . attr($orow['title']) . "'";
    if ($orow['option_id'] == $form_state) {
        echo " selected";
    }
    echo ">" . text($orow['title']) . "</option>\n";
}
?>
   </select>
</div></div>
<br>
<div class="form-row">
    
    <div class="forms col-md-3">
        <b>E-Mail </b>&nbsp;<input type="text" name="email" id="email" class="form-control" title="example@xyz.zz" required>
    </div>
    <div class="forms col-md-3">
        <b>SSN </b>&nbsp;<input type="text" name="ssn" class="form-control">
    </div>
    <div class="forms col-md-2">
    <b>Gender &nbsp;&nbsp;&nbsp;</b>
        <select name='sex' id='gender' class="form-control name">
            <option value=''>Unassigned</option>
            <?php
            $ores = sqlStatement("SELECT option_id, title FROM list_options " .
            "WHERE list_id = 'sex' AND activity = 1 ORDER BY seq");
            while ($orow = sqlFetchArray($ores)) {
                echo "    <option value='" . attr($orow['title']) . "'";
                if ($orow['option_id'] == $form_sex) {
                    echo " selected";
                }
                echo ">" . text($orow['title']) . "</option>\n";
            }
            ?>
        </select>
    </div>
    <div class="forms col-md-2"><b>Marital Status </b>&nbsp;
    <select name='marital' id='marital'  class="form-control name">
            <option value=''>Unassigned</option>
            <?php
            $ores = sqlStatement("SELECT option_id, title FROM list_options " .
            "WHERE list_id = 'marital' AND activity = 1 ORDER BY seq");
            while ($orow = sqlFetchArray($ores)) {
                echo "    <option value='" . attr($orow['title']) . "'";
                if ($orow['option_id'] == $form_marital) {
                    echo " selected";
                }
                echo ">" . text($orow['title']) . "</option>\n";
            }
            ?>
        </select>
    </div>
    <div class="forms col-md-2">
    <b>Race </b>&nbsp;
    <select id='race' name="race" class="form-control">
            <option value=''>Unassigned</option>
            <?php
            $ores = sqlStatement("SELECT option_id, title FROM list_options " .
            "WHERE list_id = 'race' AND activity = 1 ORDER BY seq");
            while ($orow = sqlFetchArray($ores)) {
                echo "    <option value='" . attr($orow['title']) . "'";
                if ($orow['option_id'] == $form_race) {
                    echo " selected";
                }
                echo ">" . text($orow['title']) . "</option>\n";
            }
            ?>
        </select>
    </div>
</div>
<br>
<div class="form-row">
    <div class="forms col-md-2">
        <b>Emergency Contact 1 </b>&nbsp;<input type="text" name="cont1" class="form-control">
    </div>
    <div class="forms col-md-2">
        <b>Relationship 1</b>&nbsp;
        <select id='rel1' name="rel1" class="form-control">
            <option value=''>Unassigned</option>
            <?php
            $ores = sqlStatement("SELECT option_id, title FROM list_options " .
            "WHERE list_id = 'personal_relationship' AND activity = 1 ORDER BY seq");
            while ($orow = sqlFetchArray($ores)) {
                echo "    <option value='" . attr($orow['title']) . "'";
                if ($orow['option_id'] == $relationship) {
                    echo " selected";
                }
                echo ">" . text($orow['title']) . "</option>\n";
            }
            ?>
        </select>
    </div>
    <div class="forms col-md-2">
        <b>Tel 1</b>&nbsp;<input type="text" name="tel1" id="tel1" class="form-control tel" maxlength="15">
    </div>
    <div class="forms col-md-2">
        <b>Emergency Contact 2 </b>&nbsp;<input type="text" name="cont2" class="form-control">
    </div>
    <div class="forms col-md-2">
        <b>Relationship 2</b>&nbsp;
        <select id='rel2' name="rel2" class="form-control">
            <option value=''>Unassigned</option>
            <?php
            $ores = sqlStatement("SELECT option_id, title FROM list_options " .
            "WHERE list_id = 'personal_relationship' AND activity = 1 ORDER BY seq");
            while ($orow = sqlFetchArray($ores)) {
                echo "    <option value='" . attr($orow['title']) . "'";
                if ($orow['option_id'] == $relationship) {
                    echo " selected";
                }
                echo ">" . text($orow['title']) . "</option>\n";
            }
            ?>
            </select>
    </div>
    <div class="forms col-md-2">
        <b>Tel 2</b>&nbsp;<input type="text" name="tel2" id="tel2" class="form-control tel" maxlength="15">
    </div>   
</div>

<p>I grant CNT permission to contact me in writing at the address provided above, orally and by voicemails through the
telephone number(s) provided above and share information with the above people in case of an emergency.
</p>
<p>Additionally, I understand it is my responsibility to keep CNT abreast of changes to the above contact information.</p>
<label><b>Initial</b>&nbsp;<input type="text" name="initial" class="form-control"></label><br><br>
<span class="title"><center><u><?php echo xlt('PATIENT INSURANCE INFORMATION'); ?></u></center></span><br /><br />
<div class="form-row">
    <div class="forms col-md-2">
        <b>Insurance Carrier </b>&nbsp;<input type="text" name="ins_car" class="form-control">
    </div>
    <div class="forms col-md-2">
        <b>Contact # </b>&nbsp;<input type="text" name="ins_cont" class="form-control tel" maxlength="15">
    </div>
    <div class="forms col-md-3">
        <b>Insurance Subscriber’s Name </b>&nbsp;<input type="text" name="ins_subscriber" class="form-control">
    </div>
    <div class="forms col-md-2">
        <b>DOB </b>&nbsp;<input type="date" name="ins_dob" class="form-control">
    </div>
    <div class="forms col-md-2">
    <b>Relationship to Patient </b>&nbsp;
    <select id='ins_rel' name="ins_rel" class="form-control">
            <option value=''>Unassigned</option>
            <?php
            $ores = sqlStatement("SELECT option_id, title FROM list_options " .
            "WHERE list_id = 'sub_relation' AND activity = 1 ORDER BY seq");
            while ($orow = sqlFetchArray($ores)) {
                echo "    <option value='" . attr($orow['title']) . "'";
                if ($orow['option_id'] == $subscriber_relationship) {
                    echo " selected";
                }
                echo ">" . text($orow['title']) . "</option>\n";
            }
            ?>
        </select>
    </div>
    <div class="forms col-md-2">
    </div>
</div>
<br>
<p style='font  italian;'>* (if different from client, this section must be filled out)</p>
<div class="row">
    <div class="forms col-md-3">
        <b>Insured Person’s ID # </b>&nbsp;<input type="text" name="ins_id" class="form-control tel">
    </div>
    <div class="forms col-md-3">
        <b>Insured Person’s Tel # </b>&nbsp;<input type="text" name="ins_tel" class="form-control tel"  maxlength="15">
    </div>
    <div class="forms col-md-2">
        <b>Client’s ID # </b>&nbsp;<input type="text" name="ins_cliid" class="form-control tel"  maxlength="15">
    </div>
    <div class="forms col-md-2">
        <b>Group # </b>&nbsp;<input type="text" name="ins_grp" class="form-control tel"  maxlength="15">
    </div>
</div>
<br>
<p># I agree to let Center for Network Therapy share treatment and other information with my insurance company in order to obtain pre-authorization for treatment, payment, and other purposes.<br></p>
<div class="form-row">
    <div class="form col-md-4">
        <b></b>&nbsp;<label class="h5"><?php echo xlt('Signature #'); ?></label>
        <i class="fas fa-pen" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
        <i class="fas fa-user" style="display:none;font-size:25px;"></i>
        <input type="hidden" name="ins_sign" id ="ins_sign" class="form-control">
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
                <h3>Provider E_sign</h3>
                <input type="text" id="id" name="id" style="display:none">
                <br>
                <div class="col-md-12">
                    <div id="sig" name="sig" class="w-100"></div>
                    <br/>
                    
                    <textarea id="sign_data" name="signed" style="display: none"></textarea>
                </div>
                <div class="row mt-2" style="display:flex">
                    <div class="col-12">
                        <button id="clear" class="btn btn-primary">Clear!</button>                 
                        <input type='button' id= "add_sign" name="add_sign" class="btn btn-success" data-dismiss="modal" value='Add Sign' style='float:right'>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="form-group">
                            <div class="col-sm-12 position-override">
                                <div class="btn-group" role="group">
                                    <button type="submit"  id="link_submit" onclick="top.restoreSession()" class="btn btn-primary btn-save"><?php echo xlt('Add New Patient'); ?></button>
                                    
                                </div>
                             </div>
                        </div>
</form>
</div>
</div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.signature.min.js"></script>

<script>

$(document).ready(function() {
    $(document).on("blur", ".name",function () {
        var name = $(this).attr("id");
        var val = $(this).val();
    if(val==""){
        $("#"+name).css('border','1px solid red');
    }else{
        $("#"+name).css('border','1px solid #ced4da');
    }  
})

$(document).on("blur", "#email",function () {
    
        var email = $(this).val();
        var mailformat = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

    if((email=="")||(email.match(mailformat)==null)){
        $('#email').css('border','1px solid red');
    }else{
        $('#email').css('border','1px solid #ced4da');
    }
})

$("#link_submit").click(function(e){
        var title = $('#title').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var dob = $('#dob').val();
        var state = $('#state').val();
        var gender = $('#gender').val();
        var marital = $('#marital').val();
        var addr = $('#addr').val();
        var city = $('#city').val();

     var condition = fname==""||lname==""||title==""||email==""||dob==""||state==""||gender==""||marital==""||addr==""||city=="";
     if(condition){
      alert('Fill the Mandatory fields');
      e.preventDefault(e);
    }else{
        $("form").submit();
        $("form").css('cursor','no-drop');//none
    }
    });
})

function myFunction() {
  var x = document.getElementById("dob");
   var today = new Date();
    var birthDate = new Date(x.value);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
    {
        age--;
    }
    document.getElementById("age").setAttribute('value', age);
    //alert(age);
}

(function($) {
  $.fn.inputFilter = function(callback, errMsg) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
      if (callback(this.value)) {
        // Accepted value
        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
          $(this).removeClass("input-error");
          this.setCustomValidity("");
        }
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        // Rejected value - restore the previous one
        $(this).addClass("input-error");
        this.setCustomValidity(errMsg);
        this.reportValidity();
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        // Rejected value - nothing to restore
        this.value = "";
      }
    });
  };
}(jQuery));


// Install input filters.
$(".tel").inputFilter(function(value) {
  return /^-?\d*$/.test(value); }, "Must be an number");

  var sig = $('#sig').signature({syncField: '#sign_data', syncFormat: 'PNG'});
$('#clear').click(function(e) {
    e.preventDefault();
    sig.signature('clear');
    $("#sign_data").val('');
});

$('#add_sign').click(function() {
    var sign = $('#sign_data').val();
   // alert(sign);
    sign =sign.split(',');
    $('#ins_sign').val(sign[1]);
});
</script>
</body>
<?php
formFooter();
?>
