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
       $sql = "SELECT * FROM `form_oxford` WHERE id=? AND pid = ? AND encounter = ?";
       $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
       for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
           $all[$iter] = $row;
       }
       $check_res = $all[0];
   }
   // print_r($check_res);
   // die();
   $check_res = $formid ? $check_res : array();
   
   //
   
   $sql1="SELECT * FROM `patient_data` WHERE  pid = ?";
   
   $res1 = sqlStatement($sql1, array($_SESSION["pid"]));
   
   for ($iter1 = 0; $row1 = sqlFetchArray($res1); $iter1++) {
       $all1[$iter1] = $row1;
   }
   $check_res1 = $all1[0];
   $session_name = trim($check_res1['fname'] . ' ' . $check_res1['lname']);
   $session_add=$check_res1['street'].','.$check_res1['city'].','.$check_res1['state'].','.$check_res1['country_code'].','.$check_res1['postal_code'];
   $dat=date("Y-m-d");

 
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
   </head>
   <body style="margin:80px;border:2px solid black;padding:50px;font-family:sans-serif;font-size:15px;">
      <form method="post" name="my_form" id="my_pat_form" action="<?php echo $rootdir; ?>/forms/oxford_form/save.php?id=<?php echo attr_url($formid); ?>">
         <div>
            <h1 style="text-align:center;">Authorization for Release of Health Information</h1>
            <div style="display: inline-block; width:200px;" >
               <input style="border:none;border-bottom:1px solid black;" type="text"  name="name" value="
                <?php echo isset($check_res['Mname']) ? $check_res['Mname'] : $session_name; ?>" /><br>
               <br><label style="color:black;font-family:sans-serif;">Member's FullName</label>
            </div>
            <div style="display: inline-block; width:200px;margin-left:100px" >
               <input  style="border:none;border-bottom:1px solid black;" type="date"  name="date"  value="<?php 
                        echo isset($check_res['Mdob']) ? $check_res['Mdob'] : $check_res1['DOB'] ;
                        ?>"/><br>

               <br><label style="color:black;font-family:sans-serif;">Date of Birth</label>
            </div>
            <div style="display: inline-block; width:200px;margin-left:100px" >
               <input  style="border:none;border-bottom:1px solid black;" type="text"  name="memberid"  value="<?php 
                        echo isset($check_res['Mid']) ? $check_res['Mid'] : $check_res1['pubpid'] ;
                        ?>"  /><br>

               <br><label style="color:black;font-family:sans-serif;">Member or Subscriber Id</label>
            </div>
         </div>
         <div style="display: inline-block; width:200px;" >
            <input  style="border:none;border-bottom:1px solid black;" type="text"  name="memberaddress" value="<?php 
                        echo isset($check_res['Maddress']) ? $check_res['Maddress'] : $check_res1['street'] ;
                        ?>" /><br>

            <br><label style="color:black;font-family:sans-serif;">Members street address</label>
         </div>
         <div style="display: inline-block; width:200px;margin-left:100px" >
            <input  style="border:none;border-bottom:1px solid black;" type="text" name="city" value="<?php 
                        echo isset($check_res['Mcity']) ? $check_res['Mcity'] : $check_res1['city'] ;
                        ?>"/><br>

            <br>   <label style="color:black;font-family:sans-serif;">city</label>
         </div>
         <div style="display: inline-block; width:100px;margin-left:100px">
            <input  style="border:none;border-bottom:1px solid black;" type="text"  name="state" value="<?php 
                        echo isset($check_res['Mstate']) ? $check_res['Mstate'] : $check_res1['state'] ;
                        ?>"/><br>
            
            <br> <label style="color:black;font-family:sans-serif;">state</label>
         </div>
         <div style="display: inline-block; width:100px;margin-left:100px">
            <input  style="border:none;border-bottom:1px solid black;" type="number"  name="zipcode" value="<?php 
                        echo isset($check_res['Mzipcode']) ? $check_res['Mzipcode'] : $check_res1['postal_code'] ;
                        ?>"/><br>


            <br><label style="color:black;font-family:sans-serif;">ZIP code</label>
         </div>
         </div>
         </div>
         <div class="content">
            <p style="font-size:20px;font-weight: bold;background-color:brown;color:white">I understand and agree that:         </p>
            <div contentEditable="true" class="text_edit"><?php 
          echo $check_res['text1']??'
            <ul style="font-size:17px;">
               <li>this authorization is voluntary;</li>
               <li>my health information may contain information created by other persons or entities including
                  health care providers and may contain medical, pharmacy, dental, vision, mental health,
                  substance abuse, HIV/AIDS, psychotherapy, reproductive, communicable disease and
                  health care program information;
               </li>
               <li>I may not be denied treatment, payment for health care services, or enrollment or eligibility
                  for health care benefits if I do not sign this form;
               </li>
               <li>my health information may be subject to re-disclosure by the recipient, and if the recipient is
                  not a health plan or health care provider, the information may no longer be protected by the
                  federal privacy regulations;
               </li>
               <li>this authorization will expire one year from the date I sign the authorization. I may revoke this
                  authorization at any time by notifying Oxford Health Plans, Inc. or Oxford Health Insurance,
                  Inc. (“Oxford”), 1 as appropriate, in writing; however, the revocation will not have an effect on
                  any actions taken prior to the date my revocation is received and processed.
               </li>
            </ul> ';?>
          </div><input type="hidden" name="text1" id="text1">
         </div>
         <div class="content2">
            <h3 style="font-size:20px;font-weight: bold;background-color:brown;color:white">Who May Receive and Disclose My Information: </h3>
            <p style="font-size:17px;">I authorize Oxford and its affiliates to receive from or disclose my individually identifiable health
               information to the following person(s) or organization(s):
            </p>
            <br>
            <div>
               <input style="border:none;border-bottom:1px solid black;width:1000px;margin-bottom:10px" type="text"  name="organizationname1" value="            <?php 
                 echo isset($check_res['org1']) ? $check_res['org1'] : $session_name ;
                ?>"><br>
   
               <label>Full Name of Person(s) or Organization(s)</label><br>
               <input style="border:none;border-bottom:1px solid black;width:1000px;margin-bottom:10px" type="text"  name="organizationname2" value=" <?php 
                 echo isset($check_res['org2']) ? $check_res['org2'] : $session_add ;
                ?>"><br>


               <label>Full Name of Address or Organization(s)</label>
               <h3 style="font-size:20px;font-weight: bold;background-color:brown;color:white">Type of Information to Be Disclosed: </h3>
            </div>
            <input type="checkbox" name="checkbox1"  value="1" <?php if ($check_res['checkbox1'] == "1") {
               echo "checked";}?>>
            <label> I authorize disclosure of all my health information including information relating to medical,
            pharmacy, dental, vision, mental health, substance abuse, HIV/AIDS, psychotherapy,
            reproductive, communicable disease and health care program information; or </label><br>
            <br><input type="checkbox" name="checkbox3"  value="1" <?php if ($check_res['checkbox3'] == "1") {
               echo "checked";}?>>
            <label> I authorize only the disclosure of the following information</label><br><br>
            <div >
               <input style="border:none;border-bottom:1px solid black;width:1000px;margin-bottom:10px" type="text" name="information1" value=" <?php echo text($check_res['information1']);?>"><br>
               <label>Type of information</label>
            </div>
         </div>
         <h3 style="font-size:20px;font-weight: bold;background-color:brown;color:white">Purpose of Disclosure: </h3>
         <input type="checkbox" name="checkbox2"  value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked";}?>>
         <label> My health information is being disclosed at my request or at the request of my personal
         representative; or</label><br>
         <br><input type="checkbox" name="checkbox4"  value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked";}?>>  
         <label> My health information is being disclosed for the following purpose</label><br><br>
         <div>
            <input style="border:none;border-bottom:1px solid black;width:1000px;margin-bottom:10px" type="text"  name="information2" value=" <?php echo text($check_res['information2']);?>"><br>
            <label style="font-size:17px;color:black;">Explain purpose</label>
         </div>
         </div><br>
         <div style="display: inline-block; width:500px;margin-bottom:20px;" >
            <input style="border:none;border-bottom:1px solid black;" type="text"  name="signature1" value="<?php 
                 echo isset($check_res['Wsign']) ? $check_res['Wsign'] : $session_name ;
                ?>"><br>
            <label>Signature of member</label>
         </div>

         <div style="display: inline-block; width:500px;margin-bottom:20px;" >
            <input style="border:none;border-bottom:1px solid black;" type="date"  name="date1" value="<?php 
                 echo isset($check_res['date1']) ? $check_res['date1'] : $dat ;
                ?>"><br>

            
            <label>Date</label>
         </div>
         <br>
         <div style="display: inline-block; width:500px;margin-bottom:20px;" >
            <input style="border:none;border-bottom:1px solid black;" type="text"  name="signature2" value=" <?php echo text($check_res['Wsign']);?>"><br>
            
            <label>
            Witness Signature (For Illinois Residents Only)</label>
         </div>
         <div style="display: inline-block; width:500px;margin-bottom:20px;" >
            <input style="border:none;border-bottom:1px solid black;" type="date"  name="date2" value="<?php 
                 echo isset($check_res['date2']) ? $check_res['date1'] : $dat ;
                ?>"><br>
            
            <label>Date</label>
         </div>
         <br>
         <p style="font-size:20px;font-weight: bold;background-color:brown;color:white" >
            Please note: If you are a guardian or court appointed representative, you must attach a
            copy of your legal authorization to represent the member and complete the following
         </p>
         </div>
         <div >
            <p style="font-size: 20px;">
               Guardian or Representative:
            </p>
            <div style="display: inline-block; width:400px;margin-bottom:20px" >
               <input style="border:none;border-bottom:1px solid black;width:250px" type="text"  name="Gname" value=" <?php 
                 echo isset($check_res['Gname']) ? $check_res['Gname'] : $check_res1['guardiansname'];
                ?>"/><br>
               
               <label> FullName</label>
            </div>
            <div style="display: inline-block; width:600px;margin-bottom:20px" >
               <input style="border:none;border-bottom:1px solid black;width:150px" type="number" name="Gnumber" value=" <?php 
                 echo isset($check_res['Gnumber']) ? $check_res['Gnumber'] : $check_res1['guardianphone'];
                ?>"/><br>
               <label>Phone Number</label>
            </div>
            <div style="display: inline-block; width:400px;margin-bottom:20px" >
               <input style="border:none;border-bottom:1px solid black;width:250px" type="text"  name="Gaddress" value="<?php 
                 echo isset($check_res['Gaddress']) ? $check_res['Gaddress'] : $check_res1['guardianaddress'];
                ?>"/><br>
               
               <label>Street address</label>
            </div>
            <div style="display: inline-block; width:200px;margin-bottom:20px" >
               <input style="border:none;border-bottom:1px solid black;width:150px" type="text" name="Gcity" value="<?php 
                 echo isset($check_res['Gcity']) ? $check_res['Gcity'] : $check_res1['guardiancity'];
                ?>"/><br>
               
               <label>city</label>
            </div>
            <div style="display: inline-block; width:200px;margin-bottom:20px" >
               <input style="border:none;border-bottom:1px solid black;width:150px" type="text"  name="Gstate" value=" <?php 
                 echo isset($check_res['Gstate']) ? $check_res['Gstate'] : $check_res1['guardianstate'];
                ?>"/><br>
               
               <label>state</label>
            </div>
            <div style="display: inline-block; width:200px;margin-bottom:20px" >
               <input style="border:none;border-bottom:1px solid black;width:150px" type="number" name="Gzipcode" value="<?php 
                 echo isset($check_res['Gzipcode']) ? $check_res['Gzipcode'] : $check_res1['guardianpostalcode'];
                ?>"/><br>

               
               <label>ZIP code</label>
            </div>
            <div style="display: inline-block; width:600px;margin-bottom:20px" >
               <input style="border:none;border-bottom:1px solid black;width:400px" type="text"  name="Gsignature" value="<?php 
                 echo isset($check_res['Gsign']) ? $check_res['Gsign'] : $check_res1['guardiansname'];
                ?>"><br>

               <label>
               Signature of Guardian or Representative</label>
            </div>
            <div style="display: inline-block; width:400px;margin-bottom:20px" >
               <input style="border:none;border-bottom:1px solid black;width:200px" type="DATE"  name="Gdate" value="<?php 
                 echo isset($check_res['Gdate']) ? $check_res['Gdate'] : $dat;
                ?>"><br>
               
               <label>Date</label>
            </div>
            <p style="font-size: 20px;">
               (For California and Georgia residents only) I understand that I may see and copy the information
               described on this form if I ask for it, and that I may receive a copy of this form after I sign it
            </p>
         </div>
         <h3 style="text-align: center;">
            PLEASE MAINTAIN A COPY OF THIS FORM FOR YOUR RECORDS<br>
            AND RETURN THE ORIGINAL TO:
         </h3>
         <br>
         <p style="text-align:center">
            UnitedHealthcare<br>
            Customer Service Privacy Unit<br>
            P.O. Box 740815<br>
            Atlanta, GA 30374-08
         </p>
         <br>
         <p>
            1 Oxford HMO products are underwritten by Oxford Health Plans (NY), Inc., Oxford Health Plans (NJ), Inc. and
            Oxford Health Plans (CT), Inc. Oxford insurance products are underwritten by Oxford Health Insurance, In
         </p>
         </div>
         <input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" id="btn-save" type="submit" name="sub" value="Submit" >
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