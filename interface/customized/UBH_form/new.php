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
    $sql = "SELECT * FROM `form_ubh` WHERE id=? AND pid = ? AND encounter = ?";
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

 $sql1="SELECT * FROM `patient_data` WHERE  pid = ?";
   
   $res1 = sqlStatement($sql1, array($_SESSION["pid"]));
   
   for ($iter1 = 0; $row1 = sqlFetchArray($res1); $iter1++) {
       $all1[$iter1] = $row1;
   }
   $check_res1 = $all1[0];
   $session_name = trim($check_res1['fname'] . ' ' . $check_res1['lname']);
   $session_add=$check_res1['street'].','.$check_res1['city'].','.$check_res1['state'].','.$check_res1['country_code'].','.$check_res1['postal_code'];
   $dat=date("Y-m-d");

   $sessionen=$_SESSION["encounter"];

   $sql2="SELECT * FROM `users` join form_encounter ON users.id = form_encounter.pid where encounter='$sessionen'";
   $res2 = sqlStatement($sql2);
   for ($iter2 = 0; $row2 = sqlFetchArray($res2); $iter2++) {
       $all2[$iter2] = $row2;
   }
   $check_res2 = $all2[0];
   // print_r($check_res2);
   // die();
   $session_name2=trim($check_res2['fname'] . ' ' . $check_res2['lname']);
   
   ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UBH Member consent Form for Appeals</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
      * {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent;
      }

      .heading {
        font-size: 20px;
        text-align: right;
        margin-right: 80px;
        font-size: bold;
        font-weight: 600;
      }

      .center {
        text-align: center;
      }

      .p-size {
        font-size: 15px;
      }

      .p-size1 {
        font-size: 15px;
      }

      ::placeholder {
        color: black;
      }

      input {
        outline: none;
      }

      td {
        border: 2px solid black;
        padding: 5px;
      }

      .row {
        width: 100% !important;
      }

      input#desid {
        margin-bottom: 24px;
      }

      .pm {
        margin-left: 10px;
      }

      .field {
        border: bottom 1px solid black;
      }

      .text_b {
        font-size: 15px;
      }

      p.p-size.pm.marginp {
        margin-left: 45px;
      }

      .dp {
        display: flex;
      }
      .subbtn {
    background: #0066A2;
    color: white;
    border-style: outset;
    border-color: #0066A2;
    height: 38px;
    width: 100px;
    margin-bottom: 10px;
    font: bold15px arial,sans-serif;
    text-shadow: none;
}
.btndiv{
  margin: 25px;
  text-align: center;
 
}

.cancel{
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
          <h2 class="heading">Authorized Representative Form-Commercial Appeals</h2><br>
          <p class="p-size">A member (or “patient”) may use this form to designate an authorized representative to act on his or her <br> behalf regarding an appeal of a denial of service or payment. </p>
          <br>
          <p class="p-size">Your legal representative may submit the appropriate legal documentation in place of this form. (for example: <br> power of attorney, guardianship papers, foster parent certification or court order). </p>
          <br>
          <br>
          <p class="p-size1"><b>1. Member/Patient Information:</b> (Please provide the following information) </p>
          <table class="form_1" style="border: 1px solid black; width:100%;">
          <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/customized/UBH_form/save.php?id=<?php echo attr_url($formid); ?>">
              <tr>
                <td colspan="2">
                  <label for="fnameid">First Name:</label>
                  <input type="text" name="fname" class="fn" id="fnameid" value="<?php echo isset($check_res['fname']) ? $check_res['fname'] : $check_res1['fname']; ?>">

                  <label for="lnameid">Last Name:</label>
                  <input type="text" name="lname" id="lnameid" class="ln"value="<?php echo isset($check_res['lname']) ? $check_res['lname'] : $check_res1['lname']; ?>">

                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label for="labelid">Address:</label>
                  <input type="text" name="address" id="labelid" class="add" value="<?php echo isset($check_res['address']) ? $check_res['address'] : $check_res1['street']; ?>">

                  <label for="cityid">City:</label>
                  <input type="text" name="city" id="cityid" class="ct" value="<?php echo isset($check_res['city']) ? $check_res['city'] : $check_res1['city']; ?>">

                  <label for="stateid">State:</label>
                  <input type="text" name="state" class="st" id="stateid" value="<?php echo isset($check_res['state']) ? $check_res['state'] : $check_res1['state']; ?>">

                </td>
              </tr>
              <tr>
                <td>
                  <label for="dpn">Daytime Phone (include area code):</label>
                  <input type="text" name="phn" class="phn" id="dphn" value="<?php echo isset($check_res['phn']) ? $check_res['phn'] : $check_res1['phone_contact']; ?>">

                </td>
                <td>
                  <label for="mpid">Member/Patient ID:</label>
                  <input type="text" name="pid1" id="mpid" class="patid" value="<?php echo isset($check_res['pid1']) ? $check_res['pid1'] : $check_res1['pubpid']; ?>">

                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label for="dob">Date of Birth (mm/dd/yyyy):</label>
                  <input type="date" name="phone" class="ph" id="dob" value="<?php echo isset($check_res['phone']) ? $check_res['phone'] : $check_res1['DOB']; ?>">

                  <label for="ref">Reference or claim number (if known)</label>
                  <input type="text" name="patid" class="pid" id="ref" value="<?php echo text($check_res['patid']); ?>">
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label for="desid">Description of service and/or date of denial of service or payment:</label>
                  <input type="text" name="description" id="desid" value="<?php echo text($check_res['description']); ?>">
                </td>
              </tr>
            
          </table>
          <br>
          <br>
          <p class="p-size pm"><b>2. Person I am authorizing to pursue my appeal:</b> (Please provide the following information for your authorized representative) </p>
          <table class="form_2" style="border: 1px solid black; width:100%;">
            
              <tr>
                <td colspan="2">
                  <label for="fnid2">First Name:</label>
                  <input type="text" name="firstname" id="fnid2" value="<?php echo isset($check_res['firstname']) ? $check_res['firstname'] : $check_res2['fname']; ?>">

                </td>
                <td>
                  <label for="lnid2">Last Name:</label>
                  <input type="text" name="lastname" id="lnid2" value="<?php echo isset($check_res['lastname']) ? $check_res['lastname'] : $check_res2['lname']; ?>">

                </td>
              </tr>
              <tr>
                <td>
                  <label for="ad2id">Address:</label>
                  <input type="text" name="add2" id="ad2id" value="<?php echo isset($check_res['add2']) ? $check_res['add2'] : $check_res2['street']; ?>">

                </td>
                <td>
                  <label for="ct2id">City:</label>
                  <input type="text" name="city2" id="ct2id" value="<?php echo isset($check_res['city2']) ? $check_res['city2'] : $check_res2['city']; ?>">

                </td>
                <td>
                  <label for="stateid2">State:</label>
                  <input type="text" name="state2" id="stateid2" value="<?php echo isset($check_res['state2']) ? $check_res['state2'] : $check_res2['state']; ?>">

                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label for="dpid1">Daytime Phone: (include area code):</label>
                  <input type="text" name="dpn" id="dpid1" value="<?php echo isset($check_res['dpn']) ? $check_res['dpn'] : $check_res2['phone']; ?>">

                </td>
              </tr>
            
          </table>
          <br>
          <br>
          <p class="p-size pm"><b>3. Member/Patient:</b> By signing below I authorize the person named above to act on my behalf and receive information from United Behavioral Health and its subsidiaries in connection with my appeal. This information may include the following: </p>
          <p class="p-size pm marginp">All medical and financial information contained in my insurance file, including but not limited to treatment for venereal disease, alcoholism and drug abuse, abortion, mental disorder and HIV status relating to my examination, treatment and hospital confinement in connection with the determination which is being appealed.</p>
          <p class="p-size pm">I understand this information is confidential and will only be released as specified in this authorization. This authorization is only valid for 1 year from the date of the signature of Member/Patient or Legal Guardian below.</p>
          <table class="form_3" style="border: 1px solid black; width:100%;">
            
              <tr>
                <td>
                  <label for="sig" class="field">Signature of Member/Patient or Legal Guardian / Parent if a minor.</label>
                  <br>
                </td>
                <td>
                  <label class="field" for="npid2">Name of Member/Patient or Legal Guardian /Parent if a minor. (Please Print)</label>
                </td>
                <td>
                  <label class="field" for="dt2">Date</label>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="text" name="sign" id="sig" value="<?php echo isset($check_res['sign']) ? $check_res['sign'] : $session_name; ?>">

                </td>
                <td>
                  <input type="text" name="nmpidname" id="npid2" value="<?php echo isset($check_res['sign']) ? $check_res['sign'] : $session_name; ?>">
                </td>
                <td>
                  <input type="date" name="date2" id="dt2" value="<?php echo isset($check_res['date2']) ? $check_res['date2'] : $dat; ?>">

                </td>
              </tr>
           
          </table>
          <br>
          <br>
          <p class="p-size pm"><b>4. Representative:</b> By signing below you are certifying you will represent the member to the best of your abilities and do not have a conflict of interest posed by any relationships you may have with the insurance company or providers whom the member is seeking care. </p>
          <table class="form_4" style="border: 1px solid black; width:100%;">
            
              <tr>
                <td>
                  <label for="sig1" class="field">Signature of Authorized Representative</label>
                  <br>
                </td>
                <td>
                  <label class="field" for="npid22">Name of Authorized Representative (Please Print)</label>
                </td>
                <td>
                  <label class="field" for="dt22">Date</label>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="text" name="sign2" id="sig1" value=" <?php echo isset($check_res['sign2']) ? $check_res['sign2'] : $session_name2; ?>">
                 
                </td>
                <td>
                  <input type="text" name="nmpidname2" id="npid22" value=" <?php echo isset($check_res['sign2']) ? $check_res['sign2'] : $session_name2; ?>">
                </td>
                <td>
                  <input type="date" name="date3" id="dt22" value="<?php echo isset($check_res['date3']) ? $check_res['date3'] : $dat; ?>">

                </td>
              </tr>
          </table>
          <br>
          <br>
          <p class="p-size pm"><b>5.</b>Please include a copy (keep the original) of the adverse determination notice you received.</p>
          <br>
          <p class="p-size pm"><b>6.</b>Submit this completed form to AOR Processing via</p>
          <br>
          <div class="btndiv">
          <input type="submit" name="sub" value="Submit" class="subbtn">
          <button class="cancel" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
          </div>

    </form>
          <p class="p-size pm"> Fax to: 866-322-0051</p>
          <br>
          <div class="dp">
            <p class="p-size pm text_b">Mail to: </p>
            <p>
              <b> AOR Processing <br> 11000 Optum Circle <br> Mail Route MN103-0600 <br> Eden Prairie, MN 55344 </b>
            </p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>