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
    $sql = "SELECT * FROM `form_cigna` WHERE id=? AND pid = ? AND encounter = ?";
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
    <title>Cigna</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <style type="text/css">
      #i1 {
        font-size: 20px;
        font-weight: 600;
      }

      hr {
        border-top: 1px solid black;
      }

      .div1 {
        margin-top: 18px;
      }

      label.lbl {
        font-size: 15px;
        font-weight: 600;
      }

      input {
        border: 0;
        outline: 0;
        border-bottom: 1px solid black;
      }

      input#inp1 {
        width: 60%;
      }

      input#inp2,
      input#inp3 {
        width: 26%;
      }

      input#inp4 {
        width: 35%;
      }

      input#inp5 {
        width: 30%;
      }

      input#inp6 {
        width: 80%;
      }

      input#inp7 {
        width: 71%;
      }

      input#inp8,
      #inp9 {
        margin-left: 35px;
      }

      .p_tag1 {
        font-size: 15px;
        font-weight: 600;
        text-decoration: underline;
      }

      .p_tag2,
      .p_tag3 {
        font-size: 15px;
      }

      .p_tag4 {
        font-size: 15px;
        font-weight: 600;
      }

      li {
        font-size: 15px;
      }

      input#inp10 {
        width: 30%;
      }

      input#inp11 {
        width: 25%;
      }

      input#inp12 {
        width: 77%;
      }

      input#inp14 {
        width: 45%;
      }

      input#inp15 {
        width: 29%;
      }

      input#inp17 {
        width: 42%;
      }

      input#inp18 {
        width: 30%;
      }

      input#inp19 {
        width: 50%;
      }

      .div3 {
        display: flex;
      }

      .pleft {
        margin-left: 50px;
      }

      p.ptag6 {
        font-size: 13px;
        font-weight: 600;
      }

      i {
        font-size: 20px;
      }

      .div4 {
        display: flex;
      }

      .parent {
        display: flex;
      }

      .sub2 {
        margin-left: 110px;
      }

      input#inp32 {
        width: 89%;
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
    <div class="container mt-3">
      <div class="row" style="border:1px solid black;" ;>
        <div class="container-fluid">
          <div class="div1">
            <i id="i1">Request for IRO (Independent Review Organization) <br> Review and Release Form </i>
            <hr>
          </div>
          <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/Cigna_form/save.php?id=<?php echo attr_url($formid); ?>">
          <div class="div2">
            <label for="inp1" class="lbl">Patient Name:</label>
            <input type="text" name="pname" id="inp1" value="<?php echo text($check_res['pname']); ?>">
            <label for="inp2" class="lbl">SSN#:</label>
            <input type="text" name="ssn" id="inp2" value="<?php echo text($check_res['ssn']); ?>">
            <br>
            <br>
            <label for="inp3" class="lbl">Patient Date of Birth:</label>
            <input type="date" name="pdob" id="inp3" value="<?php echo text($check_res['pdob']); ?>">
            <br>
            <br>
            <label for="inp4" class="lbl">Subscriber Name (if different):</label>
            <input type="text" name="sname" id="inp4" value="<?php echo text($check_res['sname']); ?>">
            <label for="inp5" class="lbl">Relationship to patient:</label>
            <input type="text" name="rtp" id="inp5" value="<?php echo text($check_res['rtp']); ?>">
            <br>
            <br>
            <label for="inp6" class="lbl">Subscriber's Employer Name:</label>
            <input type="text" name="sename" id="inp6" value="<?php echo text($check_res['sename']); ?>">
            <br>
            <br>
            <label for="inp7" class="lbl">Coverage determination that I am appealing:</label>
            <input type="text" name="cdappeal" id="inp7" value="<?php echo text($check_res['cdappeal']); ?>">
            <br>
            <br>
            <label for="inp8" class="lbl">I am attaching additional Information for this appeal:</label>
            <input type="checkbox" name="checkyes" id="inp8" value="1"
            <?php if($check_res['checkyes']== "1") { ?> checked="checked" <?php } ?>
            >
            <label for="inp8" class="lbl">Yes:</label>

            <input type="checkbox" name="checkno" id="inp9" value="1"
            <?php if($check_res['checkno']== "1") { ?> checked="checked" <?php } ?>
            >
            <label for="inp9" class="lbl">No:</label>
          </div>
          <hr>
          <div>
            <p class="p_tag1">Please Complete this section If you are authorizing someone else to act on your behalf</p>
            <p>I am authorizing <input type="text" name="authname" value="<?php echo text($check_res['authname']); ?>" id="inp10">(name of individual) to act on my behalf in requesting a review in accordance with cigna's External review Program regarding thr non-coverage determination dated <input type="date" name="date" value="<?php echo text($check_res['date']); ?>" id="inp11">. This authorization allows Cigna to disclose any individually Identifying information to my reprentative. This includes releasing the results of the IRO decision to the above mentione authorized representative. </p>
            <label for="inp12">Authorized Representative's Address:</label>
            <input type="text" name="apaddress" id="inp12" value="<?php echo text($check_res['apaddress']); ?>">
            <br>
            <br>
            <label for="inp13">Relationship to member:</label>
            <input type="text" name="relation" id="inp13" value="<?php echo text($check_res['relation']); ?>">
            <br>
            <br>
            <hr>
            <p class="p_tag2">I understand that tha IRO will receive and review the following information from Cigna, its Agents or subsidiaries:</p>
            <ul>
              <li>My medical records and other documents that were review during the internal review process.</li>
              <br>
              <li>Documents from the internal review process, including a statement of the criteria and clinical reasons for the initial coverage decision.</li>
              <br>
              <li>The contract document for my health care benefir plan(the description of my coverage).</li>
              <br>
              <li>Any additional information not presented during the internal review process related to the appeal.</li>
            </ul>
            <br>
            <p class="p_tag3"> I understand that I may submit additional irformation related to this appeal <b> WITH THIS FORM</b> to be considered in the external review process. I understand that the decision of the lRO's reviewer(s) will be binding on Cigna and on me, except to be extent that there are other remedies available under State or Federal law. I understand that my appeal to an lRO cannot begin until I have submitted all required information. I understand I must provide the Information requested below and if applicable, sign the release of records form which allows Cigna to forward certain Information to the IRO. I understand (that any forms returned to Cigna incomplete will be returned to me for completion and my appeal will not be forwarded to the lRO until I complete the form and provide all requested Information. </p>
            <p class="p_tag4">I have read and understand the above information.</p>
            <br>
            <label for="inp14">Signature of patient electing appeal:</label>
            <input type="text" name="signpat" value="<?php echo text($check_res['signpat']); ?>" id="inp14">
            <label for="inp15">Date:</label>
            <input type="date" name="date1" value="<?php echo text($check_res['date1']); ?>" id="inp15">
            <br>
            <br>
            <p class="p_tag3">If patient is unable to give consent because of physical condition or age, complete the following:</p>
            <p class="p_tag3">Patient is a minor <input type="text" name="age" value="<?php echo text($check_res['age']); ?>" id="inp16">Years of age or is unable to give consent, beacuse <input type="text" name="bconsent" id="inp17" value="<?php echo text($check_res['bconsent']); ?>">
              <br>
              <br>
              <label for="inp17">Signature of ParentGuardian/POA:</label>
              <input type="text" name="signpg" id="inp17" value="<?php echo text($check_res['signpg']); ?>">
              <label for="inp18">Date:</label>
              <input type="date" name="date3" value="<?php echo text($check_res['date3']); ?>" id="inp18">
              <br>
              <br>
              <label for="inp19">Relationship:</label>
              <input type="text" name="relationship" value="<?php echo text($check_res['relationship']); ?>" id="inp19">
              <br>
          </div>
          <div class="div3">
            <p class="p_tag3">Return Completed Form To:</p>
            <p class="p_tag4 pleft">Cigna Behavioral health, Attn: Central Appeals Unit, <br> P.O. Box 188064, Chattanooga, TN 37422, Fax#: 877.815.4827 </p>
          </div>
          <p class="ptag6">"Cigna" is a reglstered service mark and the "Tree of Life” logo ls a service mark of Cigna intellectual property, Inc., licensed for use by Cigna Corporation and its operating subsidiaries. All products and services are provided by or through such operating subsidiaries and not by Cigna Corporation. Such operating subsidiaries include Connecticut General Life Insurance Company, Cigna Health and Life Insurance Company, Cigna Health management, Inc. and HMO of service company subsidiary of Cigna Health Corporation. Please refer to your ID card for the subsidary that insures or administers your benefit plan. </p>
          <br>
          <i>Facsimile Transmission Cover Sheet</i>
          <hr>
          <div class="div4">
            <p>
              <label for="inp20">Fax to:</label>
              <input type="text" name="fax" value="<?php echo text($check_res['fax']); ?>" id="inp20">
            </p>
            <p>
              <label for="inp21">Date:</label>
              <input type="date" name="date4" value="<?php echo text($check_res['date4']); ?>" id="inp21">
            </p>
            <p>
              <label for="inp22">Toatl number of pages(Including this Sheet)</label>
              <input type="text" name="page" value="<?php echo text($check_res['page']); ?>" id="inp22">
            </p>
          </div>
          <hr>
          <div class="parent">
            <div class="sub1">
              <label>To:</label>
              <br>
              <label for="inp23">Name:</label>
              <input type="text" name="subname" id="inp23" value="<?php echo text($check_res['subname']); ?>">
              <br>
              <br>
              <label for="inp31">Company:</label>
              <input type="text" name="subcomp" id="inp31" value="<?php echo text($check_res['subcomp']); ?>">
              <br>
              <br>
              <label for="inp24">Phone:</label>
              <input type="text" name="subphone" id="inp24" value="<?php echo text($check_res['subphone']); ?>">
              <br>
              <br>
              <label for="inp25">Address:</label>
              <input type="text" name="subadd" id="inp25" value="<?php echo text($check_res['subadd']); ?>">
              <br>
              <br>
            </div>
            <div class="sub2">
              <label>From:</label>
              <br>
              <label for="inp26">Name:</label>
              <input type="text" name="subname1" id="inp26" value="<?php echo text($check_res['subname1']); ?>">
              <br>
              <br>
              <label for="inp27">Company:</label>
              <input type="text" name="subcomp1" id="inp27" value="<?php echo text($check_res['subcomp1']); ?>">
              <br>
              <br>
              <label for="inp28">Phone:</label>
              <input type="text" name="subphone1" id="inp28" value="<?php echo text($check_res['subphone1']); ?>">
              <br>
              <br>
              <label for="inp29">Fax:</label>
              <input type="text" name="subfax" id="inp29" value="<?php echo text($check_res['subfax']); ?>">
              <br>
              <br>
              <label for="inp30">Address:</label>
              <input type="text" name="subadd1" id="inp30" value="<?php echo text($check_res['subadd1']); ?>">
              <br>
              <br>
            </div>
          </div>
          <hr>
          <label for="inp32">Additional Notes:</label>
          <input type="text" name="addnote" id="inp32" value="<?php echo text($check_res['addnote']); ?>">
          <br>
          <br>
          <div class="btndiv">
            <input type="submit" name="sub" value="Submit" class="subbtn">
            <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>
          </div>
    </form>
          <hr>
          <p class="p_tag4">"CONFIDENTIALITY NOTICE: The accompanying document(s) is intended solely for the use of the individual(s) or entity to which it is addressed. If you are not the intended recipient, kindly notify us immediately by placing a telephone call to arrange for its retrieval. Please be on notice that disclosure, distribution, photocopying or use of its contents is strictly prohibited and may violate client confidentiality. Thank you."</p>
        </div>
      </div>
    </div>
  </body>
</html>