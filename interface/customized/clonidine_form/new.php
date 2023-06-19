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
       $sql = "SELECT * FROM `form_clonidine` WHERE id=? AND pid = ? AND encounter = ?";
       $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
       for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
           $all[$iter] = $row;
       }
       $check_res = $all[0];
   }
   //echo $formid;
   $check_res = $formid ? $check_res : array();

   $select2=explode(",",$check_res['select2']);

   
   $sql1="SELECT * FROM `patient_data` WHERE  pid = ?";
   
   $res1 = sqlStatement($sql1, array($_SESSION["pid"]));
   
   for ($iter1 = 0; $row1 = sqlFetchArray($res1); $iter1++) {
     $all1[$iter1] = $row1;
   }
   $check_res1 = $all1[0];
   $session_name = trim($check_res1['fname'] . ' ' . $check_res1['lname']);
   $session_add=$check_res1['street'].','.$check_res1['city'].','.$check_res1['state'].','.$check_res1['country_code'].','.$check_res1['postal_code'];

   ?>
<!DOCTYPE html>
<html>
   <head>      
      <title>Netherapy</title>
      <?php Header::setupHeader(); ?>
      <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
      <!-- Latest compiled and minified CSS -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
      <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script> -->
      <style type="text/css">
#span1 {
    float: right;
    font-size: 11px;
    margin-right: 200px;
    margin-top: -41px;
}
#span2 {
    float: right;
    font-size: 11px;
    margin-right: 203px;
}
input.inp {
    width: 20%;
    border: 0;
    outline: 0;
    border-bottom: 1px solid black;
}
.ltbl input[type="text"],input[type="date"] {
    width: 46%;
    border: 0;
    outline: 0;
    border-bottom: 1px solid black;

}
input{
   
    border: 0;
    outline: 0;
    border-bottom: 1px solid black;
}
table.tbl3 input {
    width: 100%;
}
input#ip11 {
    width: 15%;
}
button.subbtn {
         background: blue;
         color: white;
         }
         button.cancel {
         background: red;
         color: white;
         }
         input[type="text"] {
    width: 100%;
}
input.inp {
    width: 20%;
}

</style>
       </head>
       <body>
       <div class="container mt-3">
    <div class="row">
      <div class="container-fluid">
      <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/clonidine_form/save.php?id=<?php echo attr_url($formid); ?>">  
      <table style="width: 100%;">
         <tr>
           <td style="border:1px solid black;">
             <h3>Clonidine Withdraw Protocol A</h3>
             <span id="span1">Allergies:<input type="text" name="inp1" value="<?php echo $check_res['inp1'];?>" class="inp2"></span>
           </td>
         </tr>
          </table>
          <table style="width: 100%;">
         <tr>
           <td style="border:1px solid black;width: 22.3%;"><b>Patinet Name:<input type="text" name="inp39" value="<?php echo $check_res['inp39'];?>"></b></td>
           <td style="border:1px solid black;"><span id="span2">DOB:<input type="date" name="inp2" value="<?php echo $check_res['inp2'];?>" class="inp2" style="width:70%;"></span></td>
         </tr>
         </table>
         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"><b>Medication, Dose, Frequency, Route</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Hour</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/Patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
             <td style="border:1px solid black;width: 10%;"><b>Nurse/patient<br>Initials</b></td>
           </tr>
         </table>
          <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine<input type="text" name="inp3" value="<?php echo $check_res['inp3'];?>" class="inp">mg PO 4x daily on Day of Admission Date:<input type="date" name="inp4" value="<?php echo $check_res['inp4'];?>"></td>
             <td style="border:1px solid black;width: 10%;">9.30 AM</td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp12" value="<?php echo $check_res['inp12'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>

          <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">12.00 PM</td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp13" value="<?php echo $check_res['inp13'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">3.30 PM</td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp14" value="<?php echo $check_res['inp14'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
         <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">6.30 AM</td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp15" value="<?php echo $check_res['inp15'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>

          <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine<input type="text" name="inp5" value="<?php echo $check_res['inp5'];?>" class="inp">mg PO TID on Day 2 Date:<input type="date" name="inp6" value="<?php echo $check_res['inp6'];?>"></td>
             <td style="border:1px solid black;width: 10%;">9:30 AM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp16" value="<?php echo $check_res['inp16'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0"></td>
           </tr>
         </table>
                  <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">12.30 PM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp17" value="<?php echo $check_res['inp17'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
                  <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">5.00 PM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp18" value="<?php echo $check_res['inp18'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
                  <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine<input type="text" name="inp7" value="<?php echo $check_res['inp7'];?>" class="inp">mg PO BID on Day 3 Date:<input type="date" name="inp8" value="<?php echo $check_res['inp8'];?>"></td>
             <td style="border:1px solid black;width: 10%;">9.30 AM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp19" value="<?php echo $check_res['inp19'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
                           <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;"></td>
             <td style="border:1px solid black;width: 10%;">5.00 PM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp20" value="<?php echo $check_res['inp20'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
      <table width="100%;">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine<input type="text" name="inp9" value="<?php echo $check_res['inp9'];?>" class="inp">mg PO in AM on Day 4 Date:<input type="date" name="inp10" value="<?php echo $check_res['inp10'];?>" ></td>
             <td style="border:1px solid black;width: 10%;">9.30 AM</td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp21" value="<?php echo $check_res['inp21'];?>"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
             <td style="border:1px solid black;width: 10%;background: #C0C0C0;"></td>
           </tr>
         </table>
               <table width="100%;" class="tbl3">
           <tr>
             <td style="border:1px solid black;width: 20%;">Clonidine<input type="text" name="inp11" value="<?php echo $check_res['inp11'];?>" class="inp" id="ip11">mg PO Q2<br>hours PRN signs/symptoms<br>of opiate withdrawl(i.e<br>.abdominal/muscle cramping,<br>N/V,diarrhea,lacrimation,<br>rhinorrhea,joint pain),or one<br>of the following: Pulse>95,<br>SBP>140,DBP>95.<br>Maximum 10 doses in 24<br>hours. Hold for BP <90,DBP <br> <60, or P <60.</td>
             <td style="border:1px solid black;width: 10%;"><b>PRN</b></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp22" value="<?php echo $check_res['inp22'];?>"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp23" value="<?php echo $check_res['inp23'];?>"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp24" value="<?php echo $check_res['inp24'];?>"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp25" value="<?php echo $check_res['inp25'];?>"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp26" value="<?php echo $check_res['inp26'];?>"></td>
             <td style="border:1px solid black;width: 10%;"><input type="text" name="inp27" value="<?php echo $check_res['inp27'];?>"></td>
           </tr>
         </table><br><br>
         <table width="100%;" class="ltbl">
           <tr>
             <td>Order Date:<input type="date" name="inp28" value="<?php echo $check_res['inp28'];?>"></td>
             <td><b>Patient Signature:
             <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
              <i class="fas fa-search view_icon" id="rn_inp29" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="inp29" id="inp29" value="<?php echo text($check_res['inp29']); ?>"  />
             </b></td>
             <td><b>Patient Initials:<input type="text" name="inp30" value="<?php echo $check_res['inp30'];?>"></b></td>
             <td>Reason Medication Not Given</td>
           </tr>

            <tr>
             <td>Nurse Transcribing Orders:<input type="text" name="inp31" value="<?php echo $check_res['inp31'];?>"></td>
             <td>Nurse Signature:
             <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
              <i class="fas fa-search view_icon" id="rn_inp32" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="inp32" id="inp32" value="<?php echo text($check_res['inp32']); ?>"  />
             
             </b></td>
             <td>Nurse Initals:<input type="text" name="inp33" value="<?php echo $check_res['inp33'];?>"></td>
             <td>1.Patient Refused</td>
           </tr>
           <tr>
             <td>Verfying Nurse:<input type="text" name="inp34" value="<?php echo $check_res['inp34'];?>"></td>
             <td>Nurse Signature:
             <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
              <i class="fas fa-search view_icon" id="rn_inp35" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="inp35" id="inp35" value="<?php echo text($check_res['inp35']); ?>"  />
            
              </b></td>
             <td>Nurse Initals:<input type="text" name="inp36" value="<?php echo $check_res['inp36'];?>"></td>
             <td>1.Patient's Condition</td>
           </tr>

                       <tr>
             <td></td>
             <td>Nurse Signature:</b>
             <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
              <i class="fas fa-search view_icon" id="rn_inp37" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="inp37" id="inp37" value="<?php echo text($check_res['inp37']); ?>"  />
            
             
              
            </td>
             <td>Nurse Initals:<input type="text" name="inp38" value="<?php echo $check_res['inp38'];?>"></td>
             <td>1.Hold per MD Order</td>
           </tr>
         </table><br>

         
        <table style="width:100%"; class="tbl2">
      
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;
        </td>
        <td class="btndiv">
                   <button type="submit" name="sub" value="Submit" class="subbtn">Submit</button>
                   <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>
            
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

      </tr>
     
    
    </table>
  
    </form>

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
                        <div id="sig"></div>
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

    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <img src="" id="view_sign" alt="sign img" width='200px' height='100px'>
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
        $("#sign_data").val('');
    });

    var id_name, val, display_edit, icon;


    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {
            icon = $(this).next().attr('id');;
            display_edit = $(this).next().next('input').attr('id');
            val = $("#" + display_edit).val();
            display(icon);
        });

    }

    function display(icon) {
        if (val != "") {
            $("#" + icon).css('display', 'block');

        } else {
            $("#" + icon).css('display', 'none');
        }
    }
    $('.pen_icon').click(function() {
        id_name = $(this).next().next('input').attr('id');
    });

    $('.view_icon').click(function() {
        id_name = $(this).next('input').val();
        $("#view_sign").attr("src", "data:image/png;base64," + id_name);
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        // alert(sign);
        sign = sign.split(',');
        $('#' + id_name).val(sign[1]);
        sig.signature('clear');
        $("#sign_data").val('');
        check_sign();
    });
    $('input.thiacheck').on('click', function() {
    $(this).parent().parent().find('.thiacheck').prop('checked', false);
    $(this).prop('checked', true)
    });
   
</script>
</html>
 

 