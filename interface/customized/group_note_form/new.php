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
    $sql = "SELECT * FROM `form_group_note` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid, $_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();

?>
<html>

<head>
    <title><?php echo xlt("Consent Form"); ?></title>
    <?php Header::setupHeader(); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    <style>
      td{
          font-size: 15px;
        }
        input {
          border: 0;
          outline: 0;
          border-bottom: 1px solid black;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        .btndiv
        {
        text-align: center;
        margin-bottom: 18px;
        }
        .subbtn {
        background: blue;
        color: white;
        }
        button.cancel {
        background: red;
        color: white;
        }
        textarea{
          width: 100%;
          height: 100px;
          border: none;
        }
        textarea:hover{
          border:none;
        }
        .boralign{
          width:100%;
          border:1px solid black
        }
        .center{
          text-align: center;
        }
      .pen_icon {
          cursor: pointer;
      }

      .view_icon {
          margin-left: 220px;
          margin-top: -26px;
      }
    </style>
</head>

<div class="container mt-3">
    <div class="row">
      <div class="container-fluid">
        <br><br>
      <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/group_note_form/save.php?id=<?php echo attr_url($formid); ?>">
        <div class="col-12 center">
          <h6 style="font-style:italic">Center for Network Therapy</h6>
        </div>
        <div class="col-12 center">
          <h6>81 Northfield Avenue, West Orange, NJ 07052 (973) 731-1375</h6>
        </div>
        <div class="col-12 center">
          <h6>GROUP NOTE</h6>
        </div>
        <div class="row" >
          <div class="col-4 boralign">
            Patient Name: <input type="text" name="pat_name" value="<?php echo $check_res['pat_name']; ?>">
          </div>
          <div class="col-4 boralign">
            Date: <input type="date" name="date3" value="<?php echo $check_res['date3']; ?>">
          </div>
          <div class="col-4 boralign" >
            Code & Duration:  <input type="text" name="code_dura" value="<?php echo $check_res['code_dura']; ?>">
          </div>
          <div class="col-12 boralign" >
            CODES:  <input type="checkbox" name="code1" value="1" <?php
        if($check_res['code1']=="1"){
         echo "checked";
        }?>>OV-Office &nbsp; <input type="checkbox" name="code2" value="21" <?php
        if($check_res['code2']=="2"){
         echo "checked";
        }?>>V-Field Visit &nbsp; <input type="checkbox" name="code3" value="3" <?php
        if($check_res['code3']=="3"){
         echo "checked";
        }?>>G-Group  &nbsp;  <input type="checkbox" name="code4" value="4" <?php
        if($check_res['code4']=="4"){
         echo "checked";
        }?>>F-Family  &nbsp;  <input type="checkbox" name="code5" value="5" <?php
        if($check_res['code5']=="5"){
         echo "checked";
        }?>>PE-Psych Eval &nbsp;<input type="checkbox" name="code6" value="6" <?php
        if($check_res['code6']=="6"){
         echo "checked";
        }?>> L-Letter &nbsp; <input type="checkbox" name="code7" value="7" <?php
        if($check_res['code7']=="7"){
         echo "checked";
        }?>>TC-Phone Call &nbsp; <input type="checkbox" name="code8" value="8" <?php
        if($check_res['code8']=="8"){
         echo "checked";
        }?>>C-Cancelled Appt &nbsp; <input type="checkbox" name="code9" value="9" <?php
        if($check_res['code9']=="9"){
         echo "checked";
        }?>>FA-Failed Appt
          </div>
          <div class="col-12 boralign" >
            TIME: &emsp; .25 = 15 Minutes  &emsp;  .5 = 30 Minutes  &emsp; .75 = 45 Minutes &emsp;  1.00 = 1 Hour &emsp; 4.5 = 4 Hours, 30 Minutes
          </div>
          <div class="col-12 boralign" >
            <p class="center">ASAM DIMENSION(S)</p>
            <p class="center">Please choose the dimension(s) that this note addresses</p>
            <p>Dimension 1 <input type="checkbox" name="dimension1" value="1" <?php
        if($check_res['dimension1']=="1"){
         echo "checked";
        }?>> &emsp; Dimension 2 <input type="checkbox" name="dimension2" value="2" <?php
        if($check_res['dimension2']=="2"){
         echo "checked";
        }?>> &emsp;  Dimension 3 <input type="checkbox" name="dimension3" value="3" <?php
        if($check_res['dimension3']=="3"){
         echo "checked";
        }?>> &emsp;  Dimension 4 <input type="checkbox" name="dimension4" value="4" <?php
        if($check_res['dimension4']=="4"){
         echo "checked";
        }?>> &emsp;  Dimension 5 <input type="checkbox" name="dimension5" value="5" <?php
        if($check_res['dimension5']=="5"){
         echo "checked";
        }?>>  &emsp; Dimension 6 <input type="checkbox" name="dimension6" value="6" <?php
        if($check_res['dimension6']=="6"){
         echo "checked";
        }?>></p>
          </div>
          <div class="col-12 boralign center">
           DAP FORMAT
          </div>
          <div class="col-6 boralign">
            <p>DATA: Patient statements that capture the theme of the session.  Brief statements as quoted by the patient may be used, as well as paraphrased summaries.</p>

            <p>Observable data or information supporting the subjective statement.  This may include the physical appearance of the patient (e.g., sweaty, shaky, comfortable, disheveled, well-groomed, well-nourished), vital signs, results of completed lab/diagnostics tests, and medications the patient is currently taking or being prescribed.</p>
            <p style="width:100%"><textarea name="text_area1"><?php echo $check_res['text_area1']; ?></textarea></p>
          </div>
          <div class="col-6 boralign">
            <p>D: “Group Topic: Relapse Prevention” The group involved a review of the benefits of using cognitive behavioral strategies and relapse prevention for each day and a discussion regarding healthier ways to cope with triggers and emotions. Client stated “xx”. Client appeared (ie. euthymic); affect congruent with mood. No SI/HI/AH/VH.</p>

            <p> Next, clients participated in the mutual aid group. The counselor introduced the topic Client appeared euthymic; affect was congruent with mood. (No) current SI/HI/AH/VH.</p>

            <p> Next, the group participated in Cognitive Behavior Therapy. The counselor introduced the topic of Client appeared euthymic; affect was congruent with mood. (No) current SI/HI/AH/VH. </p>
            <p style="width:100%"><textarea name="text_area2"><?php echo $check_res['text_area2']; ?></textarea></p>
          </div>
          <div class="col-6 boralign">
            <p>ASSESSMENT: The counselor’s or clinician’s assessment of the situation, the session, and the patient’s condition, prognosis, response to intervention, and progress in achieving treatment plan goals/objectives.  This may also include the diagnosis with a list of symptoms and information around a differential diagnosis.</p>
          </div>
          <div class="col-6 boralign">
            <p>A: Client is in (description of client’s current state of change)</p>
            <p style="width:100%"><textarea name="text_area3"><?php echo $check_res['text_area3']; ?></textarea></p>
          </div>
          <div class="col-6 boralign">
            <p>PLAN: The treatment plan moving forward, based on the clinical information acquired and the assessment.</p>
          </div>
          <div class="col-6 boralign">
            <p>P: Clinician is scheduled to meet with the client during the next group session to review additional relapse prevention strategies and coping skills congruent to maintaining her sobriety and to discuss essential topics discussed in group</p>
          </div>
          <div class="col-6 boralign">
            <p>(Name and credentials) <input type="text" name="name_cred" value="<?php echo $check_res['name_cred']; ?>"></p>
          </div>
          <div class="col-4 boralign">
            <p>Counselor Signature:
              <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
              <i class="fas fa-search view_icon phy_icon" id="cou_sign_1" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i>
              <input type="hidden" id="cou_sign1" name="cou_sign" value="<?php echo text($check_res['cou_sign']); ?>" style="width: 50%;" class="ml-2" /></p>
          </div>
          <div class="col-2 boralign">
            <p>Date: <input style="width:70%" type="date" name="date1" value="<?php echo $check_res['date1']; ?>"></p>
          </div>
          <div class="col-6 boralign">
          <div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text1']??'<p>Eddie Mann, LCSW, LCADC, MSW, CCS, </p>';?>
          </div><input type="hidden" name="text1" id="text1">
          </div>
          <div class="col-4 boralign">
            <p>Clinical Supervisor:
            <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
              <i class="fas fa-search view_icon phy_icon" id="clini_super_1" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i>
              <input type="hidden" id="clini_super" name="clini_super" value="<?php echo text($check_res['clini_super']); ?>" style="width: 50%;" class="ml-2" /></p>
          </div>
          <div class="col-2 boralign">
            <p>Date: <input style="width:70%" type="date" name="date2" value="<?php echo $check_res['date2']; ?>"></p>
          </div>
        </div>

        <br><br>
        <div class="btndiv">
          <input type="submit"  id="btn-save" value="Submit" class="subbtn">
          <button class="cancel" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
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
    </form>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    $('#btn-save') .on('click',function(){
     $('.text_edit').each(function(){
         //alert();
         var dataval = $(this).html();
         $(this).next("input").val(dataval);
         
     });

 });
</script>

</html>
