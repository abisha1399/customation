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
       $sql = "SELECT * FROM `form_detox` WHERE id=? AND pid = ? AND encounter = ?";
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
   <title>Ntherapy</title>
      <?php Header::setupHeader(); ?>
      <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
      <style type="text/css">
          td{
  font-size: 15px;
}
#id1{
  margin-left: 56px;
}
input {
  border: 0;
  outline: 0;
  border-bottom: 1px solid black;

  
        
}
.h3_1{
  text-align:center;
  font-size: 20px;
}
.tabel5 td p{
  margin-left: 10px;
}
b{
  margin-left: 10px;
}
input[type="checkbox"] {
    margin-right: 5px;
}
.btndiv {
         text-align: center;
         margin-bottom: 18px;
         }
         button.subbtn {
         background: blue;
         color: white;
         }
         button.cancel {
         background: red;
         color: white;
         }
 
 
  </style>
</head>
<body>
    <div class="container mt-3">
    <div class="row" style="border:1px solid black;" ;>
      <div class="container-fluid">
        <br><br>
        <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/detox_form/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
          <tr>
            <td style="width:70%;">Patient name:
              <input type="text" name="txt1" value="<?php echo $check_res['txt1'];?>">
            </td>
            <td style="width:30%;"><b>Center for Network Therapy<b></td>
          </tr>
        </table><br>
        <table style="width:100%;">
          <tr>
            <td>DOB:
              <input type="date" name="txt2" id="id1" value="<?php echo $check_res['txt2'];?>">
            </td>
          </tr>
        </table><br><br>
        <table style="width:100%;">
          <tr>
            <th style="width:100%;"><h3 class="h3_1">Detox Master Treatment Plan: Nursing</h3></th>
          </tr>
        </table>
        
        <table style="width:100%; border: 1px solid black;" class="tabel5">
          <tr>
            <td style="border: 1px solid black; width: 25%;"><b>Target Problem:</b>
              <p>Phsical Withdrawls Mental instability</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>

            <td style="border: 1px solid black;width: 25%;"><b>Interventions:</b>
<p><input type="checkbox" name="check1" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>
>Suboxone 8 day protocol</p>
<p><input type="checkbox" name="check2" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Suboxone 5 day protocol</p>
<p><input type="checkbox" name="check3" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Suboxone 4 day protocol</p>
<p><input type="checkbox" name="check4" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Suboxone custom protocol</p>
<p><input type="checkbox" name="check5" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Suboxone induction</p>
<p><input type="checkbox" name="check6" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Ativan b protocol</p>
<p><input type="checkbox" name="check7" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Ativan c protocol</p>
<p><input type="checkbox" name="check8" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Ativan custom protocol</p>
<p><input type="checkbox" name="check9" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Libirium b protocol</p>
<p><input type="checkbox" name="check10" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Libirium c protocol</p>
<p><input type="checkbox" name="check11" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Libirium custom protocol</p>
<p><input type="checkbox" name="check12" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Valium custom protocol</p>
<p><input type="checkbox" name="check13" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Neurotin induction</p>
<p><input type="checkbox" name="check14" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Thiamin and Folate supplement</p>
<p><input type="checkbox" name="check15" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Keppra Custom order</p>
<p><input type="checkbox" name="check16" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Keppra 500mg po BID</p>
<p><input type="checkbox" name="check17" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>All prn medication order by M.D if no contraindications</p>
<p><input type="checkbox" name="check18" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Clonidine b protocol</p>
<p><input type="checkbox" name="check19" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Clonidine custom protocol</p>
<p><input type="checkbox" name="check20" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>Prescription medication management</p>

            </td>
            <td style="border: 1px solid black;width: 25%;"><b>Time Frame:</b>
<p>
<input type="checkbox" name="check21" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="check22" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
<input type="checkbox" name="check23" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check24" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check25" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check26" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check27" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check28" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check29" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check30" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check31" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check32" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check33" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check34" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check35" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check36" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check37" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check38" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check39" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check40" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check41" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p><input type="checkbox" name="check42" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
<input type="checkbox" name="check43" value="1"<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
<input type="checkbox" name="check44" value="1"
<?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days</p>

<p>
  <input type="checkbox" name="check45" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check46" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check47" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check48" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check49" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check50" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check51" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check52" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check53" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check54" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check55" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check56" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check57" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check58" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check59" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check60" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check61" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check62" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check63" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check64" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check65" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check66" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check67" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check68" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check69" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check70" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check71" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check72" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check73" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check74" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>
  <input type="checkbox" name="check75" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>24hrs
  <input type="checkbox" name="check76" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>48hrs
  <input type="checkbox" name="check77" value="1"
  <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>>5days
</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>
            <td style="border: 1px solid black;width: 25%;"><b>Teaching Strategies:</b>
<p><b>1.Written Material</b></p>
<p><b>2.Verbal Discussion</b></p>
<p><b>3.One on One</b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>
          </tr>
        </table><br><br>
        <table>
          <tr>
            <td>Nurse Signature:
            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style=""></i>
              <i class="fas fa-search view_icon" id="rn_nsign" data-toggle="modal" data-target="#viewModal" style="display:none"></i><input type="hidden" name="nsign" id="nsign" value="<?php echo text($check_res['nsign']); ?>"  />
            </td>
             <td>Date:<input type="date" name="date1" value="<?php echo $check_res['date1'];?>"></td>
              <td>Time:<input type="time" name="time1" value="<?php echo $check_res['time1'];?>"></td>
          </tr>
        <tr>
    <td>
        &nbsp;
        
    </td>
</tr>
          <tr>
          <td>Patient Signature: <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style=""></i>
              <i class="fas fa-search view_icon" id="rn_psign" data-toggle="modal" data-target="#viewModal" style="display:none"></i><input type="hidden" name="psign" id="psign" value="<?php echo text($check_res['psign']); ?>"  /></td>
             <td>Date:<input type="date" name="date2" value="<?php echo $check_res['date2'];?>"></td>
              <td>Time:<input type="time" name="time2" value="<?php echo $check_res['time2'];?>"></td>
          </tr>
        </table><br><br>
        <div class="btndiv">
                     <button type="submit" name="sub" value="Submit" class="subbtn">Submit</button>
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