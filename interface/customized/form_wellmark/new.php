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
    $sql = "SELECT * FROM `form_wellmark` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}
// print_r($check_res);
// die();
$check_res = $formid ? $check_res : array();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="padding:100px">
    <form method="post" id="my_pat_form" name="my_form" action="<?php echo $rootdir; ?>/forms/form_wellmark/save.php?id=<?php echo attr_url($formid); ?>">

    <h3 style="text-align:center;">PERSONAL REPRESENTATIVE APPOINTMENT AND <br>AUTHORIZATION TO RELEASE PROTECTED HEALTH INFORMATION
    </h3><br>
    <hr/>
    <p style="text-align: center;">This form is used to authorize Wellmark to disclose protected health information at the request of the individual.
    </p>
    <hr/><br>
    <h3 style="text-decoration: underline;">INDIVIDUAL AUTHORIZING DISCLOSURE</h3>
    <span>Name:</span>
    <input style="border:none;border-bottom:2px solid black;width:80%;" type="text" name="name" value=" <?php echo text($check_res['name']);?>" /><p></p>
    <span>Address:</span>
    <input style="border:none;border-bottom:2px solid black;width:76%;" type="text" name="address" value=" <?php echo text($check_res['address']);?>" /><p></p>
    <span>City,State&Zipcode:</span>
    <input style="border:none;border-bottom:2px solid black;width:74%;" type="text" name="city" value=" <?php echo text($check_res['city']);?>" /><p></p>
    <span>Phone Number:</span>
    <input style="border:none;border-bottom:2px solid black;width:76%;" type="number" name="number" value="<?php echo text($check_res['number']);?>" /><p></p>
    <span>Telephone:</span>
    <input style="border:none;border-bottom:2px solid black;width:19%;" type="number" name="telephone" value="<?php echo text($check_res['telephone']);?>" />
    <p style="display:inline;margin-left:410px">Email:</p>
    <input style="border:none;border-bottom:2px solid black;width:19%;" type="text" name="email" value="<?php echo text($check_res['email']);?>" /><p></p>
    <span>Identification Number:</span>
    <input style="border:none;border-bottom:2px solid black;width:13%;" type="number" name="inumber"  value=" <?php echo text($check_res['inumber']);?>"/>
    <p style="display:inline;margin-left:386px">Social security Number:</p>
    <input style="border:none;border-bottom:2px solid black;width:11%;" type="number" name="snumber" value="<?php echo text($check_res['snumber']);?>" /><p></p>
    <br>
    <h3 style="text-decoration: underline;">PERSONAL REPRESENTATIVE APPOINTMENT</h3>
    <p>I appoint the individual named below to act on my behalf as my Authorized Personal Representative with Wellmark Blue Cross and Blue Shield or Wellmark Health Plan of Iowa, Inc. in connection with:
    </p>
    <input type="checkbox" name="checkbox1"  value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked";}?>>
        <label> All my claims or inquiries for health care benefits on and after the effective date of this appointment.
        </label><br>
            <br><input type="checkbox" name="checkbox2"  value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked";}?> >
        <label> My inquiries and claims for health care benefits with the dates of service: [specify dates]
        </label><br>
        <input style="border:none;border-bottom:2px solid black;width:90%;" type="date" name="cinput1" value="<?php echo text($check_res['cinput1']);?>" /><p></p>
        <input type="checkbox" name="checkbox3"  value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked";}?>>
        <label>All inquiries and claims for health care benefits for the following minor dependent(s): [specify names]
        </label><br>
        <input style="border:none;border-bottom:2px solid black;width:90%;" type="text" name="cinput2" value="<?php echo text($check_res['cinput2']);?>" /><p></p>
        <input type="checkbox" name="checkbox4"  value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked";}?> >
    <label>My appeal of denied claim(s) with the date(s) of service:  [specify dates]      </label><br>
        <input style="border:none;border-bottom:2px solid black;width:90%;" type="date" name="cinput3" value="<?php echo text($check_res['cinput3']);?>"/><p></p>
       <br> <h3 style="text-decoration: underline;">PERSONAL REPRESENTATIVE        </h3>
       <span>Name:</span>
       <input style="border:none;border-bottom:2px solid black;width:80%;" type="text" name="pname" value=" <?php echo text($check_res['pname']);?>" /><p></p>
       <span>Address:</span>
       <input style="border:none;border-bottom:2px solid black;width:76%;" type="text" name="paddress" value=" <?php echo text($check_res['paddress']);?>" /><p></p>
       <span>City,State&Zipcode:</span>
       <input style="border:none;border-bottom:2px solid black;width:74%;" type="text" name="pcity" value=" <?php echo text($check_res['pcity']);?>" /><p></p>
       <span>Phone Number:</span>
       <input style="border:none;border-bottom:2px solid black;width:76%;" type="number" name="pnumber" value="<?php echo text($check_res['pnumber']);?>" /><p></p>
       <span>Telephone:</span>
       <input style="border:none;border-bottom:2px solid black;width:19%;" type="number" name="ptelephone" value="<?php echo text($check_res['ptelephone']);?>" />
       <p style="display:inline;margin-left:410px">Email:</p>
       <input style="border:none;border-bottom:2px solid black;width:19%;" type="text" name="pemail" value=" <?php echo text($check_res['pemail']);?>" /><p></p>
       <h3 style="display: inline-block;text-decoration: underline;">Effective:</h3><span>This appointment of Authorized Personal Representative and authorization to disclose is effective upon Wellmark’s receipt of a fully completed and signed original or exact copy of this form at the address stated below.</span><p></p>
       <h3 style="display: inline-block;text-decoration: underline;">Expiration:</h3><span>
         This appointment and authorization will expire 30 days after termination of my health plan coverage, or upon settlement of claims incurred while covered, unless revoked or an earlier date or event is entered below.</span><p></p>
        <input type="checkbox" name="checkbox5"  value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked";}?> >  On<input type="date" name="cinput4" value=" <?php echo text($check_res['cinput4']);?>" />       (date)
        <br><p></p>
        <input type="checkbox" name="checkbox6"  value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked";}?> >
        <label>On occurrence of the following event (which must relate to the individual or to the purpose of the use and/or disclosure being authorized): 
            <input style="border:none;border-bottom:2px solid black;width:90%;" type="text" name="cinput5" value=" <?php echo text($check_res['cinput5']);?>" /><p></p></label><br>
           <span style="display: inline-block;text-decoration: underline;font-weight: bolder;">Right to Revoke:</span><div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text1']??' I understand that I may revoke this appointment and authorization at any time by giving written notice of my revocation to Wellmark at the address stated below. I understand that revocation of this appointment and authorization will not affect any action you took in reliance on this appointment and authorization before you received my written notice of revocation.           </span><p></p> ';?>
          </div><input type="hidden" name="text1" id="text1">

        
        <h3 style="text-align: center;text-decoration: underline;">AUTHORIZATION TO DISCLOSE PROTECTED HEALTH INFORMATION</h3>
        <span style="display: inline-block;text-decoration: underline;font-weight: bolder;">Protected Health Information to be Disclosed:</span><div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text2']??' I authorize Wellmark Blue Cross and Blue Shield or Wellmark Health Plan of Iowa, Inc. to disclose the protected health information described in this form to the named Authorized Personal Representative.
        .            </span><br>
        <p>This authorization shall include and apply to any and all protected health information related to treatments where the individual has requested a restriction and/or for any health care item or service for which the health care provider has been paid out of pocket in full.</p> ';?>
        </div><input type="hidden" name="text2" id="text2">

        <span style="display: inline-block;text-decoration: underline;font-weight: bolder;">Effect of Granting this Authorization:</span>:<div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text3']??'  I understand that if the person or entity that receives the information requested is not covered by federal or state privacy laws, the information described above may be redisclosed and will no longer be protected by law          </span><p></p>';?>
          </div><input type="hidden" name="text3" id="text3">
        <span style="display: inline-block;text-decoration: underline;font-weight: bolder;">Prohibition on Redisclosure</span>:<div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text4']??'  This form does not authorize the disclosure of medical information beyond the limits of the authorization. Where information has been disclosed from the records protected by Federal law for alcohol/drug abuse records or state law for mental health records, the Federal requirements (42 CFR Part 2) and state requirements (Iowa Code Chapter 228) prohibit further disclosure without the specific written consent of the patient, or as otherwise permitted by such law and/or regulations. A general authorization for the release of medical or other information is NOT sufficient for this purpose. The Federal rules restrict any use of the information to criminally investigate or prosecute any alcohol or drug abuse patient.
    </span><p></p>';?>
    </div><input type="hidden" name="text4" id="text4">
    <span style="display: inline-block;text-decoration: underline;font-weight: bolder;">No Conditions:</span><div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text5']??' This authorization is voluntary. Wellmark will not condition your enrollment in a health plan, eligibility for benefits or payment of claims on giving this authorization</span><p></p>';?>
          </div><input type="hidden" name="text5" id="text5">
    <span style="display: inline-block;text-decoration: underline;font-weight: bolder;">Specific Authorization for Mental Health, Substance Abuse Treatment or Aids-Related Information:</span><div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text6']??' I authorize the release and disclosure of any and all protected health information, as described in this form, including specifically mental health information, substance abuse (drug or alcohol), and AIDS-related information, if applicable, to the individual named as long as this appointment of Authorized Representative is in effect. I understand that I may inspect the mental health information disclosed.
</span><br><br>I have had full opportunity to read and consider the contents of this personal representative appointment and authorization, and I understand that, by signing this form, I am confirming my authorization of the disclosure of my protected health information, as described in this form. If this authorization involves the disclosure of mental health information, I acknowledge receipt of a copy of the authorization.<br><p></p>';?>
</div><input type="hidden" name="text6" id="text6">
<span>Signature:</span>
<input style="border:none;border-bottom:2px solid black;width:19%;" type="text" name="signature1" value=" <?php echo text($check_res['signature1']);?>" />
<p style="display:inline;margin-left:410px">date:</p>
<input style="border:none;border-bottom:2px solid black;width:19%;" type="date" name="ldate" value="<?php echo text($check_res['ldate']);?>" /><p></p>
<span>	 Individual’s Signature (or Legal Guardian's signature)</span>
<p style="display:inline-block;margin-left: 400px;margin-top:-9px;">	(Signature date required)</p><p></p>
<input style="border:none;border-bottom:2px solid black;width:25%;" type="text" name="signature2" value=" <?php echo text($check_res['signature2']);?>"/>
<p>
    Print Name of Legal Guardian if applicable*
    </p><br>
    <i>*If a legal guardian signs for an individual, a copy of the guardian appointment document must be submitted with this form.
    </i><br>

    <h3 style="text-align: center;text-decoration: underline;">RETAIN A COPY FOR YOUR RECORDS – Send completed and signed form to:
    </h3><br>
    <p>Wellmark Privacy Office<br> Mail Station 5W590<br>
        PO Box 9232<br>
        Des Moines IA 50306-9232 <br>Or fax to (515) 376-9032
        </p>
        <p>If you have questions about how to complete this form, please call (877) 610-6395.
        </p>
        <input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit" name="sub" id="btn-save" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>

        </form>
</body>
<script>
 
 $('#btn-save') .on('click',function(){
   //  alert(222);exit;
     $('.text_edit').each(function(){
         //alert();
         var dataval = $(this).html();
         $(this).next("input").val(dataval);
        //alert( $(this).next("input").val());
         
     });
     $errocount = 0;
     if($errocount==0)
     {
         $('#my_pat_form').submit();

     }
 });
 </script>
</html>