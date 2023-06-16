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
       $sql = "SELECT * FROM `form_integumentary` WHERE id=? AND pid = ? AND encounter = ?";
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
      .parent{
          display: flex;
        }
          .tbl td{
        border: 1px solid black;
      }
      .tdl{
        float: right;
      }
      .sub2 {
    margin-left: 424px;
    margin-top: 25px;
  }
  table.tbl {
    width: 200%;
}

button.subbtn {
         background: blue;
         color: white;
         }
         button.cancel {
         background: red;
         color: white;
         }
         
</style>
      </head>
<body>
    <div class="container mt-3">
    <div class="row">
      <div class="container-fluid">
      <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/integumentary/save.php?id=<?php echo attr_url($formid); ?>">   
      <tabel style="width:100%;">
  <tr>
    <td style="width:100%;border: 1px solid black;"><h3><u>INTEGUMENTARY</u></h3></td>
  </tr>
</tabel>
<table style="width:100%;">
  <tr>
    <td><b>
      Skin warm,dry and intact. No jaundice. No lesions or reddened areas.<br>Oral mucous membranes pink and moist. Nail beds pink<br><u>Abnoramal Findings</u>(Please use diagram code on appropiate area)
    </b><br><input type="checkbox" name="check2" value="1"
    <?php if($check_res['check2']=="1"){
      echo "checked";
     } ?>
    >History Of eczema.
    </td>
    <td><b>Normal Findings:</b><input type="checkbox" name="check1" value="1"
    <?php if($check_res['check2']=="1"){
      echo "checked";
     } ?>
    ></td>
  </tr>
</table><br><br>

<div class="parent">
  <div class="sub1">
    <!-- <img src="/NetworkTherapy/openemr/interface/forms/integumentary/uploads/vector.png"> -->
    <img src="../../forms/integumentary/uploads/vector.png">
  </div>
  <div class="sub2">
    <table  class="tbl">
      <tr>
        <td><b>DIAGRAM CODE:</b></td>
      </tr>
      <tr>
        <td>B=Burn</td>
      </tr>
      <tr>
        <td>C=Contusion</td>
      </tr>
      <tr>
        <td>D=Decubitus</td>
      </tr>
      <tr>
        <td>E=Erythema</td>
      </tr>
      <tr>
        <td>I=Incision</td>
      </tr>
      <tr>
        <td>J=Body piercing</td>
      </tr>
      <tr>
        <td>L=Laceration</td>
      </tr>
      <tr>
        <td>P=Petechiae</td>
      </tr>
      <tr>
        <td>R=Rash</td>
      </tr>
      <tr>
        <td>S=Sour</td>
      </tr>
      <tr>
        <td>T=Tattoo</td>
      </tr>
    </table>
  </div>
</div>
<br><br>
<table>
  <tr>
    <td><b>Patient shows physical or behavioral signs of abuse</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="ptcheck1" name="check3" value="1"
    <?php if($check_res['check3']=="1"){
      echo "checked";
     } ?>
    >No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="ptcheck1" name="check4" value="1"
    <?php if($check_res['check4']=="1"){
      echo "checked";
     } ?>
    >Yes</td>
  </tr>
</table>
<table style="width:100%;height:20px;">
  <tr>
    <td style="width:100%;border: 1px solid black;"></td>
  </tr>
</table><br><br>
<table>
  <tr>
    <td><b>*signs of Abuse</b></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="check5" value="1"
    <?php if($check_res['check5']=="1"){
      echo "checked";
     } ?>
    >Unexplained bruising</td>
    <td><input type="checkbox" name="check6" value="1"
    <?php if($check_res['check6']=="1"){
      echo "checked";
     } ?>
    >Multiple injuries in defferent stages of heating</td>
  </tr>
    <tr>
    <td><input type="checkbox" name="check7" value="1"
    <?php if($check_res['check7']=="1"){
      echo "checked";
     } ?>
    >unexplained burn</td>
    <td><input type="checkbox" name="check8" value="1"
    <?php if($check_res['check8']=="1"){
      echo "checked";
     } ?>
    >Genital injury</td>
  </tr>
    </tr>
    <tr>
    <td><input type="checkbox" name="check9" value="1"
    <?php if($check_res['check9']=="1"){
      echo "checked";
     } ?>
    >Unusual fearfulness</td>
    <td><input type="checkbox" name="check10" value="1"
    <?php if($check_res['check10']=="1"){
      echo "checked";
     } ?>
    >Other:</td>
  </tr>
      <tr>
    <td><input type="checkbox" name="check11" value="1"
    <?php if($check_res['check11']=="1"){
      echo "checked";
     } ?>
    >Story inconsistent with injury</td>
  </tr>
</table><br>
<table style="border-bottom:1px solid black;width: 100%;">
  <tr>
    <td>
      <ul>
        <li><i>Refer to Victim Abuse Guidelines</i></li>
      </ul>
    </td>
  </tr>
</table>
<table>
  <tr>
    <td>
      <b>**According to patient, he/she(see diagram)&uarr;</b>
    </td>
  </tr>
</table>
<table style="width:100%";>
      
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;
          </td>
          <td class="btndiv">
                     <button type="submit" name="sub" value="Submit" class="subbtn">Submit</button>
                     <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>
              
          </td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

        </tr>
       
      
      </table>
    
      </form>
</div>
</div>
</div>
<script>
  $('.ptcheck1').on('change', function() {
  $('.ptcheck1').not(this).prop('checked', false);
  });
</script>
</body>
</html> 