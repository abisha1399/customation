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
       $sql = "SELECT * FROM `form_recovery_management` WHERE id=? AND pid = ? AND encounter = ?";
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
          .btndiv {
         text-align: center;
         margin-bottom: 18px;
         margin-top: 20px
         }
         .subbtn {
         background: blue;
         color: white;
         }
         button.cancel {
         background: red;
         color: white;
         }
         #h3_1{
    text-align: center;
  }
  td{
    border: 1px solid black;
  }
  input[type="checkbox"] {
    margin-left: 50px;
}
p {
    margin-left: 10px;
}
input[type="checkbox"] {
    margin-right: 10px;
}
b {
    margin-left: 10px;
}
textarea.txt_1 {
    width: 100%;
    height: 66px;
}.tbl td{
  border: none !important;
}

input {
    border: 0;
    outline: 0;
    border-bottom: 1px solid black;
}
      </style>

</head>
<body>
    <div class="container mt-3">
    <div class="row" style="border:1px solid black;" ;>
      <div class="container-fluid">
          <br><br>
      <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/recovery_management_form/save.php?id=<?php echo attr_url($formid); ?>">
      <table style="width:100%;">
    <tr>
      <td>
        <h3 id="h3_1"><u>Recovery Management Evaluation</u></h3>
      </td>
    </tr>
  </table><br><br>
    <table style="width:100%;">
    <tr>
      <td style="width:33%;">
        
      </td>
      <td style="width:33%;">
      <b>Pre test,day of admission</b>  
      </td>
            <td style="width:33%;">
        <b>Post test,day of discharge</b> 
      </td>
    </tr>
  </table><br><br>
     <table style="width:100%;">
    <tr>
      <td style="width:33%;">
       <p> Recognizes consequences of <br> continued substance abuse.</p>
      </td>
      <td style="width:33%;">
        <input type="checkbox" class="radio_change thiacheck check1" name="check1" value="1"
        <?php if($check_res['check1'] == "1"){
  echo "checked";
  }?>
        >YES
         <input type="checkbox"  class="radio_change thiacheck check1" name="check1" value="2"
         <?php if($check_res['check1'] == "2"){
  echo "checked";
  }?>
         >NO
          <input type="checkbox"  class="radio_change thiacheck check1" name="check1" value="3"
          <?php if($check_res['check1'] == "3"){
  echo "checked";
  }?>
          >N/A
      </td>
        <td style="width:33%;">
         <input type="checkbox"  class="radio_change thiacheck check2" name="check2" value="1"
         <?php if($check_res['check2'] == "1"){
  echo "checked";
  }?>
         >YES
         <input type="checkbox"  class="radio_change thiacheck check2" name="check2" value="2"
         <?php if($check_res['check2'] == "2"){
  echo "checked";
  }?>
         >NO
          <input type="checkbox"  class="radio_change thiacheck check2" name="check2" value="3"
          <?php if($check_res['check2'] == "3"){
  echo "checked";
  }?>
          >N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;">
        <p>Able to provide information regarding his or<br>her prescribed medications.</p>
      </td>
      <td style="width:33%;">
       <input type="checkbox"  class="radio_change thiacheck check3" name="check3" value="1"
       <?php if($check_res['check3'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check3" name="check3" value="2"
         <?php if($check_res['check3'] == "2"){
  echo "checked";
  }?>
         >NO
          <input type="checkbox"  class="radio_change thiacheck check3" name="check3" value="3"
          
          <?php if($check_res['check3'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
            <td style="width:33%;">
        <input type="checkbox" class="radio_change thiacheck check4" name="check4" value="1"
        <?php if($check_res['check4'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check4" name="check4" value="2"
         <?php if($check_res['check4'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check4" name="check4" value="3"
          <?php if($check_res['check4'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;">
        <p>identifies early warning signs and symptom and factors that contibute to relapse.</p>
      </td>
      <td style="width:33%;">
     <input type="checkbox" class="radio_change thiacheck check5" name="check5" value="1"
     <?php if($check_res['check5'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check5" name="check5" value="2"
         <?php if($check_res['check5'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check5" name="check5" value="3"
          <?php if($check_res['check5'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
            <td style="width:33%;">
        <input type="checkbox" class="radio_change thiacheck check6" name="check6" value="1"
        <?php if($check_res['check6'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check6" name="check6" value="2"
         <?php if($check_res['check6'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check6" name="check6" value="3"
          <?php if($check_res['check6'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;">
        <p>Identifies recovery strategies to prevent re-hospitalizations.</p>
      </td>
      <td style="width:33%;">
      <input type="checkbox" class="radio_change thiacheck check7" name="check7" value="1"
      <?php if($check_res['check7'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check7" name="check7" value="2"
         <?php if($check_res['check7'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check7" name="check7" value="3"
          <?php if($check_res['check7'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
            <td style="width:33%;">
       <input type="checkbox" class="radio_change thiacheck check8" name="check8" value="1"
       <?php if($check_res['check8'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check8" name="check8" value="2"
         <?php if($check_res['check8'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check8" name="check8" value="3"
          <?php if($check_res['check8'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;">
        <p>Identifies relief of symptoms or endure mild symptoms.</p>
      </td>
      <td style="width:33%;">
       <input type="checkbox" class="radio_change thiacheck check9" name="check9" value="1"
       <?php if($check_res['check9'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check9" name="check9" value="2"
         <?php if($check_res['check9'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check9" name="check9" value="3"
          <?php if($check_res['check9'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
            <td style="width:33%;">
        <input type="checkbox" class="radio_change thiacheck check10" name="check10" value="1"
        <?php if($check_res['check10'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check10" name="check10" value="2"
         <?php if($check_res['check10'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check10" name="check10" value="3"
          <?php if($check_res['check10'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;">
        <p>Demonstrates informed decision making regarding medications.</p>
      </td>
      <td style="width:33%;">
       <input type="checkbox" class="radio_change thiacheck check11" name="check11" value="1"
       <?php if($check_res['check11'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check11" name="check11" value="2"
         <?php if($check_res['check11'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check11" name="check11" value="3"
          <?php if($check_res['check11'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
            <td style="width:33%;">
        <input type="checkbox" class="radio_change thiacheck check12" name="check12" value="1"
        <?php if($check_res['check12'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check12" name="check12" value="2"
         <?php if($check_res['check12'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check12" name="check12" value="3"
          <?php if($check_res['check12'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;">
        <p>Identifies understanding of PAWS and the need for continued treatment.</p>
      </td>
      <td style="width:33%;">
      <input type="checkbox" class="radio_change thiacheck check13" name="check13" value="1"
      <?php if($check_res['check13'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check13" name="check13" value="2"
         <?php if($check_res['check13'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check13" name="check13" value="3"
          <?php if($check_res['check13'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
            <td style="width:33%;">
       <input type="checkbox" class="radio_change thiacheck check14" name="check14" value="1"
       <?php if($check_res['check14'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check14" name="check14" value="2"
         <?php if($check_res['check14'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check14" name="check42" value="3"
          <?php if($check_res['check42'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
    </tr>
        <tr>
      <td style="width:33%;">
        <p>Recognizes personal self awareness from pre-contemplation to contemplation state  </p>
      </td>
      <td style="width:33%;">
      <input type="checkbox" class="radio_change thiacheck check15" name="check15" value="1"
      <?php if($check_res['check15'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check15" name="check15" value="2"
         <?php if($check_res['check15'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check15" name="check15" value="3"
          <?php if($check_res['check15'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
            <td style="width:33%;">
        <input type="checkbox" class="radio_change thiacheck check16" name="check16" value="1"
        <?php if($check_res['check16'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check16" name="check16" value="2"
         <?php if($check_res['check16'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check16" name="check16" value="3"
          <?php if($check_res['check16'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
    </tr>

  </table>
  <br><br>
  <table>
     <tr>
      <td style="width:33%;">
        <p>Demonstrates an understanding of his/her illness and preferred treatment approaches.</p>
      </td>
      <td style="width:33%;">
      <input type="checkbox" class="radio_change thiacheck check17" name="check17" value="1"
      <?php if($check_res['check17'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check17" name="check17" value="2"
         <?php if($check_res['check17'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check17" name="check17" value="3"
          <?php if($check_res['check17'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
            <td style="width:33%;">
        <input type="checkbox" class="radio_change thiacheck check18" name="check18" value="1"
        <?php if($check_res['check18'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check18" name="check18" value="2"
         <?php if($check_res['check18'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check18" name="check18" value="3"
          <?php if($check_res['check18'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
    </tr>
     <tr>
      <td style="width:33%;">
        <p>Recognizes need for continued levels of step down treatment and or therapy.</p>
      </td>
      <td style="width:33%;">
      <input type="checkbox" class="radio_change thiacheck check19" name="check19" value="1"
      <?php if($check_res['check19'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check19" name="check19" value="2"
         <?php if($check_res['check19'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check19" name="check19" value="3"
          <?php if($check_res['check19'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
            <td style="width:33%;">
        <input type="checkbox" class="radio_change thiacheck check20" name="check20" value="1"
        <?php if($check_res['check20'] == "1"){
  echo "checked";
  }?>>YES
         <input type="checkbox" class="radio_change thiacheck check20" name="check20" value="2"
         <?php if($check_res['check20'] == "2"){
  echo "checked";
  }?>>NO
          <input type="checkbox" class="radio_change thiacheck check20" name="check20" value="3"
          <?php if($check_res['check20'] == "3"){
  echo "checked";
  }?>>N/A
      </td>
    </tr>
    
  </table><br><br>
  <textarea class="txt_1" name="txt1" placeholder="Comments:"><?php echo $check_res['txt1']?></textarea>
  <br> <br>
  <table style="width: 100%;" class="tbl">
    <tr>
      <td>Nurse Completing initial Assessment:<input type="text" name="inp1" value="<?php echo $check_res['inp1']?>"></td>
      <td>Date/Time:<input type="datetime-local" name="inp2" value="<?php echo $check_res['inp2']?>"></td>
    </tr>
  </table><br>
  <table style="width: 100%;" class="tbl">
    <tr>
      <td>Nurse Completing discharge Assessment:<input type="text" name="inp3" value="<?php echo $check_res['inp3']?>"></td>
      <td>Date/Time:<input type="datetime-local" name="inp4" value="<?php echo $check_res['inp4']?>"></td>
    </tr>
  </table>

      <div class="btndiv">
                     <button type="submit" name="sub" value="Submit" class="subbtn">Submit</button>
                     <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>
                  </div>
</form>
</div>
</div>
</div>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $('.radio_change').on('change',function(){
       var checkbox_class= $(this).attr('name');
       
       if($(this).is(":checked"))
       {
           $('.'+checkbox_class).prop('checked',false);
           $(this).prop('checked',true);
            $('#hidden_'+checkbox_class).val($(this).val());
       }
       else{
        $('#hidden_'+checkbox_class).val('');
       }
   })

    $('input.thiacheck').on('click', function() {
    $(this).prop('checked', false);
    $(this).prop('checked', true);
   });
</script>
</html>