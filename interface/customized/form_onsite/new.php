
<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$sign_data = sqlStatement("SELECT * FROM `form_onsite` Where pid=".$_SESSION["pid"]." ORDER BY id DESC");
$sign_data=sqlFetchArray($sign_data);
//echo '<pre>';print_r($sign_data);
$check_res=array();
if ($formid) {
    $sql = "SELECT * FROM `form_onsite` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}
else{
    if(isset($sign_data['input42'])&& $sign_data['input42']!='')
    {
        $check_res['input42']=$sign_data['input42'];
    }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo xlt("urine screening form"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
<style>
     .pen_icon {
            cursor: pointer;
        }
        th{
            background-color: white !important;
        }
</style>

</head>

<body>
    <div class="container mt-3">
        <div class="row">
          <div  style="border:1px solid black;" class="container-fluid">
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/form_onsite/save.php?id=<?php echo attr_url($formid); ?>">

<h2 style="text-align:center;">Onsite Instant Urine Screen Results</h2>
<br>
<h3 style="text-align:center;background-color:black;color:white;">Patient Information</h3><br>
<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Patient Name:</label><input type="text" name="input1" value="<?php echo text($check_res['input1']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>
        <td style="width:50%;">
    <label>DOB:</label><input type="date" name="input2" value="<?php echo text($check_res['input2']);?>" style="border:none;border-bottom:2px solid black;width:150px;"/>
        <td>

</tr>
<br>
</table>
<h2 style="text-align:center;background-color:black;color:white;">12-panel Urine Results</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Substance</th>
      <th scope="col">Positive</th>
      <th scope="col">Negative</th>
      <th scope="col">Faint</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Amphetamine</th>
      <td><input type="text" name="input3" value="<?php echo text($check_res['input3']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input4" value="<?php echo text($check_res['input4']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input5" value="<?php echo text($check_res['input5']);?>" style="border:none;width:150px;"/></td>



    </tr>
    <tr>
    <th scope="row">Barbiturate</th>
    <td><input type="text" name="input6" value="<?php echo text($check_res['input6']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input7" value="<?php echo text($check_res['input7']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input8" value="<?php echo text($check_res['input8']);?>" style="border:none;width:150px;"/></td>
    </tr>
   <tr>
      <th scope="row">Benzodiazepines (BZO)</th>
      <td><input type="text" name="input9" value="<?php echo text($check_res['input9']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input10" value="<?php echo text($check_res['input10']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input11" value="<?php echo text($check_res['input11']);?>" style="border:none;width:150px;"/></td>
    </tr>
      <tr>
    <th scope="row">Cocaine (COC)</th>
    <td><input type="text" name="input12" value="<?php echo text($check_res['input12']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input13" value="<?php echo text($check_res['input13']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input14" value="<?php echo text($check_res['input14']);?>" style="border:none;width:150px;"/></td>
    </tr>
      <tr>
    <th scope="row">Opiates (OPJ / MOP)</th>
    <td><input type="text" name="input15" value="<?php echo text($check_res['input15']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input16" value="<?php echo text($check_res['input16']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input17" value="<?php echo text($check_res['input17']);?>" style="border:none;width:150px;"/></td>
    </tr>
     <tr>
    <th scope="row">Methadone (MTD)</th>
      <td><input type="text" name="input18" value="<?php echo text($check_res['input18']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input19" value="<?php echo text($check_res['input19']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input20" value="<?php echo text($check_res['input20']);?>" style="border:none;width:150px;"/></td>

    </tr>
     <tr>
    <th scope="row">Methamphetamine (MET)</th>
      <td><input type="text" name="input21" value="<?php echo text($check_res['input21']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input22" value="<?php echo text($check_res['input22']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input23" value="<?php echo text($check_res['input23']);?>" style="border:none;width:150px;"/></td>
    </tr>
     <tr>
    <th scope="row">Phencyclidine (PCP)</th>

      <td><input type="text" name="input24" value="<?php echo text($check_res['input24']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input25" value="<?php echo text($check_res['input25']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input26" value="<?php echo text($check_res['input26']);?>" style="border:none;width:150px;"/></td>

    </tr>
    <tr>
    <th scope="row">Oxycodone (OXY)</th>
      <td><input type="text" name="input27" value="<?php echo text($check_res['input27']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input28" value="<?php echo text($check_res['input28']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input29" value="<?php echo text($check_res['input29']);?>" style="border:none;width:150px;"/></td>

    </tr>
    <tr>
      <th scope="row">Buprenorphine/Suboxone (BUP)</th>
      <td><input type="text" name="input30" value="<?php echo text($check_res['input30']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input31" value="<?php echo text($check_res['input31']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input32" value="<?php echo text($check_res['input32']);?>" style="border:none;width:150px;"/></td>

    </tr>
    <tr>
    <th scope="row">Marijuana (THC)</th>
      <td><input type="text" name="input33" value="<?php echo text($check_res['input33']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input34" value="<?php echo text($check_res['input34']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input35" value="<?php echo text($check_res['input35']);?>" style="border:none;width:150px;"/></td>

    </tr>
    <tr>
      <th scope="row">Ecstasy (MDMA)</th>
      <td><input type="text" name="input36" value="<?php echo text($check_res['input36']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input37" value="<?php echo text($check_res['input37']);?>" style="border:none;width:150px;"/></td>
      <td><input type="text" name="input38" value="<?php echo text($check_res['input38']);?>" style="border:none;width:150px;"/></td>


    </tr>
  </tbody>
</table>
<h2 style="text-align:center;background-color:black;color:white;">Other</h2>
<table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="col">Alcohol Urine Dipstick</th>
      <td><input type="text" name="input39" value="<?php echo text($check_res['input39']);?>" style="border:none;width:400px;"/></td>

</tr>
<tr>
      <th scope="col">Fentanyl Urine Dipstick</th>
      <td><input type="text" name="input40" value="<?php echo text($check_res['input40']);?>" style="border:none;width:400px;"/></td>

</tr>
<tr>
      <th scope="col">Breathalyzer</th>
      <td><input type="text" name="input41" value="<?php echo text($check_res['input41']);?>" style="border:none;width:400px;"/></td>
</tr>
</tbody>
</table>
<table style="width:100%">
    <tr>
    <td style="width:32%;">Client Signature:&nbsp;<i class="fa fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <input type="hidden" name="input42" id="input42" value="<?php echo text($check_res['input42']);?>" style="border:none;border-bottom:1px solid black;width:150px;"/><br>
    <img src='' class="img" id="img_input42" style="display:none;width:50%;height:100px;" >
    </td>
    <td style="width:32%;">Date:<br><input type="date" name="input43" value="<?php echo text($check_res['input43']);?>" style="border:none;border-bottom:1px solid black;width:150px;"/></td>
    <td style="width:32%;">Time:<br><input type="time" name="input44" value="<?php echo text($check_res['input44']);?>" style="border:none;border-bottom:1px solid black;width:150px;"/></td>
</tr></table><br>
<table style="width:100%">
<tr>
    <td style="width:32%;">Clinician Signature:&nbsp;<i class="fa fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <input type="hidden" name="input45" id="input45" value="<?php echo text($check_res['input45']);?>" style="border:none;border-bottom:1px solid black;width:150px;"/>
    <br>
    <img src='' class="img" id="img_input45" style="display:none;width:50%;height:100px;" >
    </td>
    <td style="width:32%;">Date:<br><input type="date" name="input46" value="<?php echo text($check_res['input46']);?>" style="border:none;border-bottom:1px solid black;width:150px;"/></td>
    <td style="width:32%;">Time:<br><input type="time" name="input47" value="<?php echo text($check_res['input47']);?>" style="border:none;border-bottom:1px solid black;width:150px;"/></td>
</tr></table><br>
<table style="width:100%">
<tr>
    <td style="width:32%;">RN Signature:&nbsp;<i class="fa fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
    <input type="hidden" name="input48" id="input48" value="<?php echo text($check_res['input48']);?>" style="border:none;border-bottom:1px solid black;width:150px;"/>
    <br><img src='' class="img" id="img_input48" style="display:none;width:50%;height:100px;" >
    </td>
    <td style="width:32%;">Date:<br><input type="date" name="input49" value="<?php echo text($check_res['input49']);?>" style="border:none;border-bottom:1px solid black;width:150px;"/></td>
    <td style="width:32%;">Time:<br><input type="time" name="input50" value="<?php echo text($check_res['input50']);?>" style="border:none;border-bottom:1px solid black;width:150px;"/></td>
</tr>
</table><br>




<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit"  name="sub" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button><br>



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
</html>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
