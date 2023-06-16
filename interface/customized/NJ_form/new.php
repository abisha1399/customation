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
    $sql = "SELECT * FROM `form_nj` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}
//echo $formid;
$check_res = $formid ? $check_res : array();
// print_r($check_res);
// die;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NJ Form</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
      .p1 {
        text-align: right;
        margin-right: 76px;
        font-size: 23px;
        font-weight: 500;
      }

      .div1 {
        border-bottom: 1px solid black;
      }

      label {
        font-weight: 500 !important;
      }

      .div2,
      .div3,
      .div4 {
        font-size: 18px;
      }

      /*	input{
	border-bottom: 1px solid black;
    outline: none;
		}
		*/
      #l1,
      #l2,
      #l3 {
        margin-left: 90px;
      }

      input {
        border: 0;
        outline: 0;
        border-bottom: 1px solid black;
      }

      input#ip1 {
        width: 60%;
        margin-left: 43px;
      }

      #ip2 {
        width: 60%;
      }

      #ip3 {
        width: 60%;
        margin-left: 69px;
      }

      .p2 {
        font-size: 17px;
        margin-left: 15px;
      }

      .p3 {
        font-size: 17px;
        margin-left: 15px;
      }

      .p4 {
        font-size: 17px;
        margin-left: 15px;
      }

      .p5 {
        font-size: 17px;
        margin-left: 15px;
      }

      .p6 {
        font-size: 17px;
        margin-left: 15px;
      }

      .p7 {
        font-size: 17px;
        margin-left: 15px;
      }

      .p8 {
        font-size: 17px;
        margin-left: 15px;
      }

      .p9 {
        font-size: 17px;
        margin-left: 15px;
        text-decoration: underline;
        font-weight: 600;
      }

      i {
        font-size: 17px;
        margin-left: 15px;
      }

      input#ip4 {
        margin-left: 17px;
        font-size: 17px;
      }

      #l4 {
        font-size: 17px;
      }

      input#ip5 {
        margin-left: 17px;
        font-size: 17px;
      }

      #l5 {
        font-size: 17px;
      }

      input#ip6 {
        margin-left: 17px;
        font-size: 17px;
      }

      #l6 {
        font-size: 17px;
      }

      .div8 {
        border-bottom: 1px solid black;
      }

      #inp7 {
        width: 69%;
        margin-left: 27px;
      }

      #inp8 {
        margin-left: 15px;
      }

      #inpl9 {
        font-size: 17px;
        margin-left: 17px;
      }

      input#inp9 {
        width: 96%;
        margin-left: 10px;
      }

      #ip10 {
        margin-left: 13px;
      }

      label.lb10 {
        font-size: 17px;
        margin-left: 10px;
      }

      #ip11 {
        margin-left: 13px;
      }

      label.lb11 {
        font-size: 17px;
        margin-left: 10px;
      }

      #ip12 {
        margin-left: 13px;
      }

      label.lb12 {
        font-size: 17px;
        margin-left: 10px;
      }

      .div9 {
        float: right;
        margin-right: 130px;
      }

      #ib13,
      #ib14 {
        margin-left: 13px;
        font-size: 17px;
      }

      #ip13 {
        width: 50%;
      }

      #ip14 {
        width: 25%;
      }

      #ib15 {
        margin-left: 13px;
        font-size: 16px;
      }

      #ip15 {
        width: 60%;
      }

      #ip16 {
        width: 50%;
      }

      #ib16 {
        margin-left: 13px;
        font-size: 16px;
      }

      #ip17 {
        width: 50%;
      }

      #ib17 {
        margin-left: 13px;
        font-size: 16px;
      }

      .div12 {
        display: flex;
        font-size: 17px;
        font-weight: 600;
      }

      .div13 {
        display: flex;
        font-size: 17px;
        font-weight: 600;
      }

      .p14 {
        margin-left: 15px;
      }

      .p15 {
        margin-left: 25px;
      }

      .p16 {
        margin-left: 15px;
      }

      .p17 {
        margin-left: 155px;
      }

      .subbtn {
        background: #0066A2;
        color: white;
        border-style: outset;
        border-color: #0066A2;
        height: 38px;
        width: 100px;
        margin-bottom: 10px;
        font: bold15px arial, sans-serif;
        text-shadow: none;
      }

      .btndiv {
        margin: 25px;
        text-align: center;
      }

      .cancel {
        border: 1px solid red;
        padding: 8px;
        background-color: red;
        color: white;
        font-size: 16px;
        width: 99px;
      }
    </style>
  </head>
  <body>
    <div class="container mt-3">
      <div class="row" style="border: 1px solid black">
        <div class="container-fluid">
          <div class="div1">
            <p class="p1">AUTHORIZATION TO DISCLOSE <br> HEALTH INFORMATION <br> EXTERNAL REVIEW </p>
          </div>
          <br>
          <br>
          <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/NJ_form/save.php?id=<?php echo attr_url($formid); ?>">
          <div class="div2">
            <label for="inp1" id="l1">Individual/Member Name:</label>
            <input type="text" name="mname" value="<?php echo text($check_res['mname']); ?>" id="ip1">
          </div>
          <div class="div3">
            <label for="inp2" id="l2">Member Identification Number:</label>
            <input type="text" name="midnum" value="<?php echo text($check_res['midnum']); ?>" id="ip2">
          </div>
          <div class="div4">
            <label for="inp3" id="l3">Member Date of Birth:</label>
            <input type="date" name="dob" value="<?php echo text($check_res['dob']); ?>" id="ip3">
          </div>
          <br>
          <br>
          <div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text1']??'
          <p class="p2">I have requested an independent review organization (IRO) conduct a review of a benefit decision. In order for the IRO to conduct a thorough review, I understand the reviewer must be given a copy of all relevant records.</p>
          <br>
          <p class="p3">By signing this form I am authorizing ValueOptions, Inc., its subcontractors and all applicable medical providers to release to the IRO all information relating to the decision to be reviewed including, but not limited to, my files and medical record information. By initialing the lines below, I understand and agree the information to be disclosed may also include information relating to mental health, alcohol or substance use and HIV/AIDS. If I do not initial the lines below, I understand that information will not be given to the IRO and will not be included in the IRO review.</p>';?>
          </div><input type="hidden" name="text1" id="text1">
          <br>
          <i>The information to be disclosed includes (indicate by initialing):</i>
          <br>
          <br>
          <div class="div5">
            <input type="text" name="mbh" value="<?php echo text($check_res['mbh']); ?>" id="ip4">
            <label for="inp4" id="l4">Mental/Behavioral Health Information</label>
          </div>
          <div class="div6">
            <input type="text" name="ali" value="<?php echo text($check_res['ali']); ?>" id="ip5">
            <label for="inp5" id="l5">Alcohol/Substance Use Information</label>
          </div>
          <div class="div7">
            <input type="text" name="hiv" value="<?php echo text($check_res['hiv']); ?>" id="ip6">
            <label for="inp6" id="l6">HIV/AIDS Information</label>
          </div>
          <br>
          <br>
          <div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text2']??'
          <p class="p4"> I understand the IRO will use this information to make a determination on my external review. This release is valid until the IRO issues a final decision or upon my revocation. I acknowledge that I may revoke this authorization at any time by sending a written statement to ValueOptions, Inc. My revocation will be effective upon receipt, but will not affect actions already taken on the basis of the authorization. </p>
          <br>
          <p class="p5"> I understand that I have a right to refuse to sign this authorization. I also understand that completing this authorization is not a condition to receive treatment, payment or eligibility. ValueOptions, Inc. is not responsible for any action taken by an authorized recipient of my protected health information. I am aware that an authorized recipient may redisclose my information and my information may no longer be protected by the privacy law. Upon your request, a copy of this form will be provided to you. </p>
          <br>
          <div class="div8">
            <p class="p6"> This authorization must be dated and signed by the individual whose information will be released or by a person who is legally authorized to act on the individual’s behalf. </p>
          </div>
          <br>';?>
          </div><input type="hidden" name="text2" id="text2">
          <p class="p7">Signature of the Individual or the Individual’s Legally Authorized Representative** <input type="text" name="signilr" value="<?php echo text($check_res['signilr']); ?>" id="inp7">
            <label>Date:</label>
            <input type="date" name="date2" value="<?php echo text($check_res['date2']); ?>" id="inp8">
          </p>
          <label id="inpl9">Print Name:</label>
          <br>
          <input type="text" name="printn" id="inp9" value="<?php echo text($check_res['printn']); ?>">
          <p class="p8">Relationship to the Individual/Member:</p>
          <br>
          <input type="checkbox" name="legal" value="1" id="ip10"
          <?php if($check_res['legal']== "1") { ?> checked="checked" <?php } ?>
          >
          <label for="ip10" class="lb10">Self</label>
          <div class="div9">
            <input type="checkbox" name="lar" value="1" id="ip11" 
            <?php if($check_res['lar']== "1") { ?> checked="checked" <?php } ?>
            >
            <label for="ip11" class="lb11">Legally Authorized Representative**</label>
          </div>
          <div class="div10">
            <input type="checkbox" name="pomc" value="1" id="ip12"
            <?php if($check_res['lar']== "1") { ?> checked="checked" <?php } ?>
            >
            <label for="ip12" class="lb12">Parent of Minor Child</label>
            <i>(Power of Attorney, Legal Guardian, Executor or Administrator) ** If you are signing as a Legally Authorized Representative attach a copy of the appropriate legal document(s) granting you the authority to do so.</i>
          </div>
          <br>
          <br>
          <p class="p9">External Review Request <br> Required Information <br>Please complete the following: </p>
          <div class="div11">
            <p>
              <label for="ip13" id="ib13">Insurer Name:</label>
              <input type="text" name="insname" value="<?php echo text($check_res['insname']); ?>" id="ip13">
              <label for="ip14" id="ib13">Member ID #:</label>
              <input type="text" name="mid" value="<?php echo text($check_res['mid']); ?>" id="ip14">
              <br>
              <label for="ip15" id="ib15">Patient Name:</label>
              <input type="text" name="patname" id="ip15" value="<?php echo text($check_res['patname']); ?>">
              <br>
              <label for="ip16" id="ib16">Phone # and Mailing Address of Claimant:</label>
              <input type="text" name="pma" value="<?php echo text($check_res['napmame']); ?>" id="ip16">
              <br>
              <label for="ip17" id="ib17">Tracking # in the Header of Adverse Determination Letter:</label>
              <input type="text" name="thad" value="<?php echo text($check_res['thad']); ?>" id="ip17">
              <br>
            </p>
          </div>
          <div class="btndiv">
            <input type="submit" name="sub" id="btn-save" value="Submit" class="subbtn">
            <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>
          </div>
    </form>
          <div class="div12">
            <p class="p14">Mail the completed form to:</p>
            <p class="p15">ValueOptions 12369-C Sunrise Valley Drive, Reston, VA 20191</p>
          </div>
          <div class="div13">
            <p class="p16">Or fax it to:</p>
            <p class="p17">877-826-8584</p>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script>
 
    $('#btn-save') .on('click',function(){
      //  alert(222);exit;
        $('.text_edit').each(function(){
            //alert();
            var dataval = $(this).html();
            $(this).next("input").val(dataval);
          // alert( $(this).next("input").val());
            
        });
        $errocount = 0;
        if($errocount==0)
        {
            $('#my_pat_form').submit();

        }
    });
    </script>
</html>