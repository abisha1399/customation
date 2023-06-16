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
       $sql = "SELECT * FROM `form_nurse_admission` WHERE id=? AND pid = ? AND encounter = ?";
       $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
       for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
           $all[$iter] = $row;
       }
       $check_res = $all[0];
   }
   //echo $formid;
   $check_res = $formid ? $check_res : array();

   $select2=explode(",",$check_res['select2']);

   
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
      <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
      <style type="text/css">
           table{
  width: 100%;
  border: 1px solid black;
 }
 .cls{
  width: 100%;
  border: none;
 }
 .cls td{
  border: none;
 }
 td{
  border: 1px solid black;
 }
 .td{
  text-align: center;
 }
 b#b1 {
    margin-left: 430px;
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

         input#inp2 {
    margin-bottom: 15px;
}
      </style>
      </head>
<body>
    <div class="container mt-3">
    <div class="row">
      <div class="container-fluid">
      <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/nurse_admission_assessment/save.php?id=<?php echo attr_url($formid); ?>">
      <table class="cls">
          <tr>
            <td style="width:40%;"><b>Nursing Admission Assessment</b></td>
            <td style="width:20%;"><b>Center for Network Therapy</b></td>
          </tr>
        </table>
      <table>
        <tr>
          <td style="height: 30px;"></td>
        </tr>
        <tr>
          <td style="height: 30px;" class="td"><b>FUNCTIONAL STATUS</b></td>
        </tr>
      </table>
      <table>
        <tr>
          <td style="height:100px;"><input type="checkbox" name="check1" value="1"
          <?php 
              if($check_res['check1']=="1"){
                  echo "checked";
              }
              ?>
          >Independent with ADLs&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="checkbox" name="check2" value="1" <?php 
              if($check_res['check2']=="1"){
                  echo "checked";
              }
              ?>>Needs Prompting/encouragement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="checkbox" name="check3" value="1"
              <?php 
              if($check_res['check3']=="1"){
                  echo "checked";
              }
              ?>
              >Needs partial assistance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="checkbox" name="check4" value="1"
              <?php 
              if($check_res['check4']=="1"){
                  echo "checked";
              }
              ?>
              >Needs total assistance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
        </tr>
      </table>
            <table>
        <tr>
          <td style="height: 30px;" class="td"><b>SPIRITUAL/CULTURAL ASSESSMENT</b></td>
        </tr>
      </table>
      <table>
        <tr>
          <td>
            <b><u>Spiritual:</b></u><br>
            What is your faith or belief?<br>
            What importance does faith have in your life?<br>
            Are you part of a spiritual or religious community?<br>
            Is this of support to you?<br>
            How would you like us to address these issues during this hospitalization?
            <br>
            <br>
            <b><u>Cultural:</u></b>
            Do you identify with any specific ethinic group?<br>
            Are there any specific cultural concerns that needs to be addressed during this stay?
            <br><br>
          </td>
        </tr>
      </table>
      <table>
        <tr>
          <td style="border-bottom: 1px solid black !important;">
            <br>
            <b>Is Patient a known or suspected gang member?&nbsp;&nbsp;&nbsp;&nbsp;
             </b> <input type="checkbox" class="copcheck1" name="check5" value="1"
             <?php 
              if($check_res['check5']=="1"){
                  echo "checked";
              }
              ?>
             >No&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" class="copcheck1" name="check6" value="1"
             <?php 
              if($check_res['check6']=="1"){
                  echo "checked";
              }
              ?>
             >Yes
             <br><br>
             <b style="text-align:center;" id="b1">FIREARMS ASSESSMENT</b><br>
             <br>
             <b>Does the patient have means of self-harm at home?</b>&nbsp;&nbsp;&nbsp;
             <input type="checkbox" class="copcheck2" name="check7" value="1"
             <?php 
              if($check_res['check7']=="1"){
                  echo "checked";
              }
              ?>
             >No&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" class="copcheck2" name="check8" value="1"
             <?php 
              if($check_res['check8']=="1"){
                  echo "checked";
              }
              ?>
             >Yes (if yes,complete below, MD must be informed)<br>
             <b>what type of means?</b><br>
             <b>where is it (they) stored</b><br>
             <b>Who will dispose of or safely store items before you sent home? (name and phone #)</b><br>
           </td>
        </tr>
      </table>
      <table>
        <tr>
          <td>
            
            <b><ul>Notes:</ul></b>
           
            <textarea name="txt1" style="width: 100%;height: 100px;"><?php echo $check_res['txt1']; ?></textarea>
            <div class="btndiv">
                     <button type="submit" name="sub" value="Submit" class="subbtn">Submit</button>
                     <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>
                  </div>
          </td>

        </tr>
       
      
      </table>
    
      </form>
</div>
</div>
</div>
</body>
  <script>
     $('.copcheck1').on('change', function() {
     $('.copcheck1').not(this).prop('checked', false);
     });
     $('.copcheck2').on('change', function() {
     $('.copcheck2').not(this).prop('checked', false);
    });
  </script>
</html>