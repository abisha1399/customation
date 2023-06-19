
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
    $sql = "SELECT * FROM `form_librium` WHERE id=? AND pid = ? AND encounter = ?";
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
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
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
<form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/form_librium/save.php?id=<?php echo attr_url($formid); ?>">

<table style="width:100%;">
<tr>
    <td style="width:70%;">
    <h3>Librium Protocol D DEA #FC8418750</h3>
</td>
<td style="width:30%">
<b>Allergies:</b>
<input type="text" name="input1"  value="<?php echo text($check_res['input1']);?>" style="width:200px;border:none;border-bottom:1px solid black;"/>
</td>
</tr>
</table><br>


</table><br>
        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <th style="width: 15%;"><label>Patient Name:</label> 
                                <label><input type="text" style="width:105%;" name="input2" value="<?php echo text($check_res['input2']);?>"/></label></th>
                                <th colspan="7" style="text-align:center">DOB: 
                                <input type="date" name="input3" value="<?php echo text($check_res['input3']);?>"/></label></th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Medication, Dosage, Frequency & Rotate</th>
                                <th>Hour</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>                                                              
                            </tr>
                            <tr>
                                <td>
                                    <label>Librium 10mg PO BID and <b>and 20<br>mg</b> PO at 1230 on admission<br>date   Date:  </label> <label><input type="date" name="input4" style="width:88%;" value="<?php echo text($check_res['input4']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td> 
                                    <input type="text" name="input5" class="form-control" value="<?php echo text($check_res['input5']);?>"/>
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td>
                            <input type="text" name="input6" class="form-control" value="<?php echo text($check_res['input6']);?>"/>
</td>
      <td><b>12.30 PM</b></td>
      <td>
                            <input type="text" name="input7" class="form-control" value="<?php echo text($check_res['input7']);?>"/>
</td>

<td style="background-color:lightgray;"> 
                                  
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                    
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 
                                 
      </tr>
      <tr>
      <td><input type="text" name="input8" class="form-control" value="<?php echo text($check_res['input8']);?>"/>
</td>
<td><b>4.00 PM</b></td>
      <td><input type="text" name="input9" class="form-control" value="<?php echo text($check_res['input9']);?>"/>
</td>
                                  <td style="background-color:lightgray;"> 
                                  
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                    
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 

    </tr>

    <tr>
                                <td>
                                    <label>Librium 10mg PO TID <br>day2   Date:  </label> <label><input type="date" name="input10" style="width:88%;" value="<?php echo text($check_res['input10']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>    
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>                            
                                <td> 
                                    <input type="text" name="input11" class="form-control" value="<?php echo text($check_res['input11']);?>"/>
                                </td> 
                               
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td>
                            <input type="text" name="input12" class="form-control" value="<?php echo text($check_res['input12']);?>"/>
</td>
      <td><b>12.30 PM</b></td>
      <td style="background-color:lightgray;"> 
                                  
                                  </td> 

      <td>
                            <input type="text" name="input13" class="form-control" value="<?php echo text($check_res['input13']);?>"/>
</td>

                                  <td style="background-color:lightgray;"> 
                                    
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 
                                 
      </tr>
      <tr>
      <td><input type="text" name="input14" class="form-control" value="<?php echo text($check_res['input14']);?>"/>
</td>
<td><b>4.00 PM</b></td>
<td style="background-color:lightgray;"> 
                                  
                                  </td> 

      <td><input type="text" name="input15" class="form-control" value="<?php echo text($check_res['input15']);?>"/>
</td>
                                  <td style="background-color:lightgray;"> 
                                    
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 

    </tr>

    <tr>
                                <td>
                                    <label>Librium 10mg PO BID <br>day3   Date:  </label> <label><input type="date" name="input16" style="width:88%;" value="<?php echo text($check_res['input16']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>    
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>     
                                  
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>                        
                                <td> 
                                    <input type="text" name="input17" class="form-control" value="<?php echo text($check_res['input17']);?>"/>
                                </td> 
                               
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td>
                            <input type="text" name="input18" class="form-control" value="<?php echo text($check_res['input18']);?>"/>
</td>
<td><b>4.00 PM</b></td>
      <td style="background-color:lightgray;"> 
                                  
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                    
                                    </td> 

      <td>
                            <input type="text" name="input19" class="form-control" value="<?php echo text($check_res['input19']);?>"/>
</td>

                              
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td>                                
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 
                                 
      </tr>

      <tr>
                                <td>
                                    <label>Librium 10mg PO BID <br>day4   Date:  </label> <label><input type="date" name="input20" style="width:88%;" value="<?php echo text($check_res['input20']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>    
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>     
                                  
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                   
                                   </td>                         
                                <td> 
                                    <input type="text" name="input21" class="form-control" value="<?php echo text($check_res['input21']);?>"/>
                                </td> 
                               
                                                           
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                               
                            </tr>
                            <tr>
                                <td>
                            <input type="text" name="input22" class="form-control" value="<?php echo text($check_res['input22']);?>"/>
</td>
<td><b>4.00 PM</b></td>
      <td style="background-color:lightgray;"> 
                                  
                                  </td> 
                                  <td style="background-color:lightgray;"> 
                                    
                                    </td> 
                                    
                                  <td style="background-color:lightgray;"> 
                                     
                                     </td>   

      <td>
                            <input type="text" name="input23" class="form-control" value="<?php echo text($check_res['input23']);?>"/>
</td>

                                                           
                                  <td style="background-color:lightgray;"> 
                                   
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                     
                                  </td> 
                                 
      </tr>

      <tr>
                                <td>
                                    <label>Librium 10mg PO BID <br>day5   Date:  </label> <label><input type="date" name="input24" style="width:88%;" value="<?php echo text($check_res['input24']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>    
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>     
                                  
                                <td style="background-color:lightgray;"> 
                                  
                                  </td>  
                                  <td style="background-color:lightgray;"> 
                                   
                                   </td>                         
                                   <td style="background-color:lightgray;"> 
                                   
                                   </td>
                                   <td>
                            <input type="text" name="input25" class="form-control" value="<?php echo text($check_res['input25']);?>"/>
</td>
<td style="background-color:lightgray;"> 
                                   
                                   </td>
</tr>
<tr>
                                <td>
                                    <label>Librium 10mg PO Q2 <br>hours PRN signs/symptoms<br> of alcohol withdrawal(CIWA-Ar or Bscore>28)<br>  or one of the following Pulse>95,SBP>140<br>,DBP>95.Maximum 10 doses in 24 hours.HOLD for (SBP less than90,<br>DBP less than 60,P less than 60. </label>
                                </td>
                                <td><b>PRN</b></td>   
                                <td>
                            <input type="text" name="input26" class="form-control" value="<?php echo text($check_res['input26']);?>"/>
</td>     <td>
                            <input type="text" name="input27" class="form-control" value="<?php echo text($check_res['input27']);?>"/>
</td>     <td>
                            <input type="text" name="input28" class="form-control" value="<?php echo text($check_res['input28']);?>"/>
</td>
<td>
                            <input type="text" name="input29" class="form-control" value="<?php echo text($check_res['input29']);?>"/>
</td>     <td>
                            <input type="text" name="input30" class="form-control" value="<?php echo text($check_res['input30']);?>"/>
</td>     <td>
                            <input type="text" name="input31" class="form-control" value="<?php echo text($check_res['input31']);?>"/>
</td>



  

    

</table><br><br>
<table style="width:100%">
<tr>
    <td style="width:25%">
    Order Date: <input type="date" style="border:none;border-bottom:1px solid black;width:150px;" name="input32" class="form-control" value="<?php echo text($check_res['input32']);?>"/>
</td>
<td style="width:25%">
    Patient Signature: 
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
    <i class="fas fa-search view_icon" id="rn_input33" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input33" id="input33" value="<?php echo text($check_res['input33']); ?>"  />
    
</td>
<td style="width:25%">
    Patient Initials: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="input34" class="form-control" value="<?php echo text($check_res['input34']);?>"/>
</td>
<td style="width:25%">
    <b>Reasons Medication not given</b>
</td>
</tr>
<tr>
    <td style="width:25%">
    Nurse transcribing orders: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="input35" class="form-control" value="<?php echo text($check_res['input35']);?>"/>
</td>
<td style="width:25%">
    Patient Signature: <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
    <i class="fas fa-search view_icon" id="rn_input36" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input36" id="input36" value="<?php echo text($check_res['input36']); ?>"  />
<td style="width:25%">
    Patient Initials: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="input37" class="form-control" value="<?php echo text($check_res['input37']);?>"/>
</td>
<td style="width:25%">
    <p>1.Patient Refused</p>
    <p>2.Patient Condition</p>
    <p>3.Hold per MD order</p>

</td>
</tr><tr>
    <td style="width:25%">
    Verifying Nurse: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="input38" class="form-control" value="<?php echo text($check_res['input38']);?>"/>
</td>
<td style="width:25%">
    Patient Signature:
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
    <i class="fas fa-search view_icon" id="rn_input39" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input39" id="input39" value="<?php echo text($check_res['input39']); ?>"  />
     
</td>
<td style="width:25%">
    Patient Initials: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="input40" class="form-control" value="<?php echo text($check_res['input40']);?>"/>
</td>
</tr>
<tr>
    <td style="width:25%">
</td>
<td style="width:25%">
    Patient Signature: 
    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
    <i class="fas fa-search view_icon" id="rn_input41" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input41" id="input41" value="<?php echo text($check_res['input41']); ?>"  />
    
</td>
<td style="width:25%">
    Patient Initials: <input type="text" style="border:none;border-bottom:1px solid black;width:150px;" name="input42" class="form-control" value="<?php echo text($check_res['input42']);?>"/>
</td>
</tr>
</table><br><br>
<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit"  name="sub" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button><br><br>



</form>
</div>
</div>
</div>
</body>
</html>    





















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


