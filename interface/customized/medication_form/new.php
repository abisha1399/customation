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
       $sql = "SELECT * FROM `form_medication` WHERE id=? AND pid = ? AND encounter = ?";
       $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
       for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
           $all[$iter] = $row;
       }
       $check_res = $all[0];
   }
   //echo $formid;
   $check_res = $formid ? $check_res : array();

   $select2=explode(",",$check_res['select2']);
   // print_r($check_res);
   // die;

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
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ntherapy</title>
      <!-- Latest compiled and minified CSS -->
      <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
      <style type="text/css">
         .pen_icon {
            cursor: pointer;
        }
    .div1{
      display: flex;
    }
    .h2_2{
      float: right;
      text-align: right;
      margin-left: 430px;
      text-decoration: underline;
    }
    b{
      font-size: 20px;
    }
    .b1{
      font-size: 16px !important;
    }
    .parentdiv{
      display: flex;
    }
    .sub2{
      margin-left: auto;
      margin-right: 0;
      height: 113px;
      border: 1px solid black;
      padding: 7px;
    }
    .u{
      text-decoration: underline;
    }
    .txt_1{
      width: 100%;
      height: 100px;
    }
    input {
    border: 0;
    outline: 0;
    border-bottom: 1px solid black;
}
.btndiv {
         text-align: center;
         margin-bottom: 18px;
         }
         input.subbtn {
         background: blue;
         color: white;
         }
         button.cancel {
         background: red;
         color: white;
         }

  </style>
</head>
<body class="example">
      <div class="container mt-3">
         <div class="row">
            <div class="container-fluid" style="border:1px solid black;">
               <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/medication_form/save.php?id=<?php echo attr_url($formid); ?>">
               <div class="div1">
    <b class="h2_1">Medication Reconciliation Form</b>
    <b class="h2_2">The Center for Network Therapy</b>
  </div><br><br>
  <div class="parentdiv">

    <div class="sub1">
    <label>Patient Name</label>
    <input type="text" name="pname" value="<?php echo $check_res['pname']; ?>"><br><br>
    <label>DOB:</label>
    <input type="date" name="dob" value="<?php echo $check_res['dob']; ?>"><br><br>
    <label>Allergies:</label>
    <input type="text" name="allergies" value="<?php echo $check_res['allergies']; ?>"><br><br>
    </div>

    <div class="sub2">
      <b class="b1">Information Source:</b><br><br>
      <input type="checkbox" name="patient" value="1"
      <?php
    if($check_res['patient']=="1"){
        echo "checked";
    }
    ?>

      >&nbsp;
      <label>Patient</label>&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="caregiver" value="1"
      <?php
    if($check_res['caregiver']=="1"){
        echo "checked";
    }
    ?>
      >&nbsp;
      <label>Caregiver</label>&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="provided"  value="1"
      <?php
    if($check_res['provided']=="1"){
        echo "checked";
    }
    ?>
      >&nbsp;
      <label>Provided List</label>&nbsp;&nbsp;&nbsp;<br>
      <input type="checkbox" name="other" value="1"
      <?php
    if($check_res['other']=="1"){
        echo "checked";
    }
    ?>
      >&nbsp;
      <label>Other:</label>
    </div>





   </div>
    <input type="checkbox" name="homemeds" value="1"
    <?php
    if($check_res['homemeds']=="1"){
        echo "checked";
    }
    ?>
    >
    <label>patient takes no home meds</label><br>

<table style="width:100%;">
  <tr>
  <td><b class="b1 u">Current Medication(Dose,route,frequency)<b></td>
  <td><b class="b1 u">Indication</b></td>
  <td><b class="b1 u">Date/Time last dose</b></td>
  <td><b class="b1 u">Continue</b></td>
  </tr>
</table>
<br>
<textarea name="txt1" class="txt_1"><?php echo $check_res['txt_1']; ?></textarea><br><br>
<table style="width:100%;">
  <tr>
    <td><b class="b1">Nurse Signature:
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
      <input type="hidden" name="nsign" id="nsign" value="<?php echo $check_res['nsign']; ?>">
      <img src='' class="img" id="img_nsign" style="display:none;width:50%;height:100px;" >
    </b></td>
    <td><b class="b1">Date/Time:</b>
<input type="datetime-local" name="datetime1" value="<?php echo $check_res['datetime1']; ?>">
    </td>
  </tr>
</table>
<br>
<table style="width:80%;">
  <tr>
    <td><b class="b1 u">Discharge Medication(dose,route,frequency)
        </b></td>
    <td><b class="b1 u">Indication:</b></td>
  </tr>
</table>
<br><br>
<textarea name="txt2" class="txt_1"><?php echo $check_res['txt2']; ?></textarea><br><br>

<table style="width:60%;">
  <tr>
    <td><b class="b1">Physician Signature:</b>
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
      <input type="hidden" name="psign"  id="psign" value="<?php echo $check_res['psign']; ?>">
      <img src='' class="img" id="img_psign" style="display:none;width:50%;height:100px;" >
    </td>
    <td><b class="b1">Date/Time:</b>
  <input type="datetime-local" name="date2" value="<?php echo $check_res['date2']; ?>">
    </td>
  </tr>
    <tr>
    <td><b class="b1">Nurse Signature:</b>
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
<input type="hidden" name="nsign2" id="nsign2" value="<?php echo $check_res['nsign2']; ?>">
<img src='' class="img" id="img_nsign2" style="display:none;width:50%;height:100px;" >
    </td>
    <td><b class="b1">Date/Time:</b>
<input type="datetime-local" name="date3" value="<?php echo $check_res['date3']; ?>">
    </td>
  </tr>
    <tr>
    <td><b class="b1">Patient Signature:</b>
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
      <input type="hidden" name="patsign"  id="patsign" value="<?php echo $check_res['patsign']; ?>">
      <img src='' class="img" id="img_patsign" style="display:none;width:50%;height:100px;" >
    </td>
    <td><b class="b1">Date/Time:</b>
<input type="datetime-local" name="date4" value="<?php echo $check_res['date4']; ?>">
    </td>
  </tr>
</table>

<br>
                  <div class="btndiv">
                     <input type="submit" name="sub" value="Submit" class="subbtn">
                     <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../forms/admission_orders/assets/js/jquery.signature.min.js"></script>
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
       // alert(sign_value);
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
