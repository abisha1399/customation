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
      $sql = "SELECT * FROM `form_beck_anxiety_inventory` WHERE id=? AND pid = ? AND encounter = ?";
      $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
      for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
          $all[$iter] = $row;
      }
      $check_res = $all[0];
  }

  $check_res = $formid ? $check_res : array();

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Beck Anxiety Inventory</title>
      <!-- Latest compiled and minified CSS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
      <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
      <style type="text/css">
          td{
            font-size: 15px;
          }
          #id1{
            margin-left: 56px;
          }
          input {
            border: 0;
            outline: 0;
            border-bottom: 1px solid black;      
          }
          .h3_1{
            text-align:center;
            font-size: 20px;
          }
          .tabel5 td p{
            margin-left: 10px;
          }
          b{
            margin-left: 10px;
          }
          input[type="checkbox"] {
              margin-right: 5px;
          }
          .btndiv {
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
          .asinput{
            width:60%;
          }
          
  </style>
</head>
<body>
    <div class="container mt-3">
    <div class="row" style="border:1px solid black;" ;>
      <div class="container-fluid">
        <br><br>
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/beck_anxiety_inventory/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%; text-align:center;">Beck Anxiety Inventory</h4></td>
         </tr>
        </table>
        <br>
        <table>
          <tr>
            <td style="width:25%;">
            <p>Below is a list of common symptoms of anxiety. Please carefully read each item in the list.
              Indicate how much you have been bothered by that symptom during the past month, including
              today, by circling the number in the corresponding space in the column next to each symptom.</p>
            </td>
          </tr>
        </table>
        <br>
        <table style="width:100%; border: 1px solid black;">
          <tr>
            <td style="width:20%; border: 1px solid black;"></td>        
            <td style="width:20%; border: 1px solid black;">Not At All <p style="text-align:center;">0</p></td>        
            <td style="width:20%; border: 1px solid black;">Mildly but it didn’t bother me much.&emsp;&emsp;&emsp; 1</td>        
            <td style="width:20%; border: 1px solid black;">Moderately - it wasn’t pleasant at times &emsp;&emsp;&emsp;&emsp; 2</td>        
            <td style="width:20%; border: 1px solid black;">Severely – it bothered me a lot <p style="text-align:center;">3</p></td>        
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Numbness or tingling</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="numbness" value="0" <?php 
                if($check_res['numbness']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="numbness" value="1" <?php 
                if($check_res['numbness']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="numbness" value="2" <?php 
                if($check_res['numbness']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="numbness" value="3" <?php 
                if($check_res['numbness']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Feeling hot</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling" value="0" <?php 
                if($check_res['feeling']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling" value="1" <?php 
                if($check_res['feeling']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling" value="2" <?php 
                if($check_res['feeling']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling" value="3" <?php 
                if($check_res['feeling']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Wobbliness in legs</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="wobbliness" value="0" <?php 
                if($check_res['wobbliness']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="wobbliness" value="1" <?php 
                if($check_res['wobbliness']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="wobbliness" value="2" <?php 
                if($check_res['wobbliness']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="wobbliness" value="3" <?php 
                if($check_res['wobbliness']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Unable to relax</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unable" value="0" <?php 
                if($check_res['unable']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unable" value="1" <?php 
                if($check_res['unable']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unable" value="2" <?php 
                if($check_res['unable']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unable" value="3" <?php 
                if($check_res['unable']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Fear of worst happening</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear" value="0" <?php 
                if($check_res['fear']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear" value="1" <?php 
                if($check_res['fear']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear" value="2" <?php 
                if($check_res['fear']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear" value="3" <?php 
                if($check_res['fear']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Dizzy or lightheaded</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="dizzy" value="0" <?php 
                if($check_res['dizzy']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="dizzy" value="1" <?php 
                if($check_res['dizzy']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="dizzy" value="2" <?php 
                if($check_res['dizzy']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="dizzy" value="3" <?php 
                if($check_res['dizzy']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Heart pounding/racing</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="heart" value="0" <?php 
                if($check_res['heart']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="heart" value="1" <?php 
                if($check_res['heart']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="heart" value="2" <?php 
                if($check_res['heart']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="heart" value="3" <?php 
                if($check_res['heart']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Unsteady</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unsteady" value="0" <?php 
                if($check_res['unsteady']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unsteady" value="1" <?php 
                if($check_res['unsteady']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unsteady" value="2" <?php 
                if($check_res['unsteady']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unsteady" value="3" <?php 
                if($check_res['unsteady']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Terrified or afraid</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="terrified" value="0" <?php 
                if($check_res['terrified']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="terrified" value="1" <?php 
                if($check_res['terrified']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="terrified" value="2" <?php 
                if($check_res['terrified']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="terrified" value="3" <?php 
                if($check_res['terrified']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Nervous</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="nervous" value="0" <?php 
                if($check_res['nervous']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="nervous" value="1" <?php 
                if($check_res['nervous']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="nervous" value="2" <?php 
                if($check_res['nervous']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="nervous" value="3" <?php 
                if($check_res['nervous']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Feeling of choking</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling_choking" value="0" <?php 
                if($check_res['feeling_choking']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling_choking" value="1" <?php 
                if($check_res['feeling_choking']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling_choking" value="2" <?php 
                if($check_res['feeling_choking']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling_choking" value="3" <?php 
                if($check_res['feeling_choking']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Handstrembling</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hands_trembling" value="0" <?php 
                if($check_res['hands_trembling']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hands_trembling" value="1" <?php 
                if($check_res['hands_trembling']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hands_trembling" value="2" <?php 
                if($check_res['hands_trembling']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hands_trembling" value="3" <?php 
                if($check_res['hands_trembling']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Shaky / unsteady</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="shaky_unsteady	" value="0" <?php 
                if($check_res['shaky_unsteady']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="shaky_unsteady	" value="1" <?php 
                if($check_res['shaky_unsteady']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="shaky_unsteady	" value="2" <?php 
                if($check_res['shaky_unsteady']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="shaky_unsteady	" value="3" <?php 
                if($check_res['shaky_unsteady']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Fear of losing control</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_losing_control" value="0" <?php 
                if($check_res['fear_losing_control']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_losing_control" value="1" <?php 
                if($check_res['fear_losing_control']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_losing_control" value="2" <?php 
                if($check_res['fear_losing_control']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_losing_control" value="3" <?php 
                if($check_res['fear_losing_control']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Difficulty in breathing</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="difficulty" value="0" <?php 
                if($check_res['difficulty']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="difficulty" value="1" <?php 
                if($check_res['difficulty']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="difficulty" value="2" <?php 
                if($check_res['difficulty']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="difficulty" value="3" <?php 
                if($check_res['difficulty']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Fear of dying</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_dying" value="0" <?php 
                if($check_res['fear_dying']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_dying" value="1" <?php 
                if($check_res['fear_dying']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_dying" value="2" <?php 
                if($check_res['fear_dying']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_dying" value="3" <?php 
                if($check_res['fear_dying']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Scared</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="scared" value="0" <?php 
                if($check_res['scared']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="scared" value="1" <?php 
                if($check_res['scared']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="scared" value="2" <?php 
                if($check_res['scared']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="scared" value="3" <?php 
                if($check_res['scared']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Indigestion</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="indigestion" value="0" <?php 
                if($check_res['indigestion']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="indigestion" value="1" <?php 
                if($check_res['indigestion']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="indigestion" value="2" <?php 
                if($check_res['indigestion']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="indigestion" value="3" <?php 
                if($check_res['indigestion']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Faint / lightheaded</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="faint" value="0" <?php 
                if($check_res['faint']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="faint" value="1" <?php 
                if($check_res['faint']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="faint" value="2" <?php 
                if($check_res['faint']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="faint" value="3" <?php 
                if($check_res['faint']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Face flushed</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="face" value="0" <?php 
                if($check_res['face']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="face" value="1" <?php 
                if($check_res['face']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="face" value="2" <?php 
                if($check_res['face']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="face" value="3" <?php 
                if($check_res['face']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Hot/cold sweats</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hot_cold" value="0" <?php 
                if($check_res['hot_cold']=="0"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hot_cold" value="1" <?php 
                if($check_res['hot_cold']=="1"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hot_cold" value="2" <?php 
                if($check_res['hot_cold']=="2"){
                 echo "checked";
                }
              ?>></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hot_cold" value="3" <?php 
                if($check_res['hot_cold']=="3"){
                 echo "checked";
                }
              ?>></td>           
          </tr>
        </table>
        <p><b>Scoring</b> - Sum each column. Then sum the column totals to achieve a grand score.</p>
        <table style="width:100%;">
          <tr>
            <td>Write grand score here <input style="width:5%" type="text" name="grand_score" id="score" value="<?php echo isset($check_res['grand_score'])?$check_res['grand_score']:'0';?>"></td>
          </tr>
      </table>
      <br><br>
        <div class="btndiv">
          <input type="submit" name="sub" value="Submit" class="subbtn">
          <button class="cancel" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
        </div>
</form>

</div>
</div>
</div>
</body>
<script>
  $("input[type='radio']").on('change',function(){
    var numbness,feeling,wobbliness,unable,fear,dizzy,heart,unsteady,terrified,nervous,feeling_choking,hands_trembling,shaky_unsteady,fear_losing_control,difficulty,fear_dying,scared,indigestion,faint,face,hot_cold;

    numbness = $("input[name='numbness']:checked").val();
    numbness=(numbness>0) ? numbness:"0";
    feeling = $("input[name='feeling']:checked").val();
    feeling=(feeling>0) ? feeling:"0";
    wobbliness = $("input[name='wobbliness']:checked").val();
    wobbliness=(wobbliness>0) ? wobbliness:"0";
    unable = $("input[name='unable']:checked").val();
    unable=(unable>0) ? unable:"0";
    fear = $("input[name='fear']:checked").val();
    fear=(fear>0) ? fear:"0";
    dizzy = $("input[name='dizzy']:checked").val();
    dizzy=(dizzy>0) ? dizzy:"0";
    heart = $("input[name='heart']:checked").val();
    heart=(heart>0) ? heart:"0";
    unsteady = $("input[name='unsteady']:checked").val();
    unsteady=(unsteady>0) ? unsteady:"0";
    terrified = $("input[name='terrified']:checked").val();
    terrified=(terrified>0) ? terrified:"0";

    nervous = $("input[name='nervous']:checked").val();
    nervous=(nervous>0) ? nervous:"0";
    feeling_choking = $("input[name='feeling_choking']:checked").val();
    feeling_choking=(feeling_choking>0) ? feeling_choking:"0";
    hands_trembling = $("input[name='hands_trembling']:checked").val();
    hands_trembling=(hands_trembling>0) ? hands_trembling:"0";
    shaky_unsteady = $("input[name='shaky_unsteady']:checked").val();
    shaky_unsteady=(shaky_unsteady>0) ? shaky_unsteady:"0";
    fear_losing_control = $("input[name='fear_losing_control']:checked").val();
    fear_losing_control=(fear_losing_control>0) ? fear_losing_control:"0";
    difficulty = $("input[name='difficulty']:checked").val();
    difficulty=(difficulty>0) ? difficulty:"0";
    fear_dying = $("input[name='fear_dying']:checked").val();
    fear_dying=(fear_dying>0) ? fear_dying:"0";
    scared = $("input[name='scared']:checked").val();
    scared=(scared>0) ? scared:"0";
    indigestion = $("input[name='indigestion']:checked").val();
    indigestion=(indigestion>0) ? indigestion:"0";

    faint = $("input[name='faint']:checked").val();
    faint=(faint>0) ? faint:"0";
    face = $("input[name='face']:checked").val();
    face=(face>0) ? face:"0";
    hot_cold = $("input[name='hot_cold']:checked").val();
    hot_cold=(hot_cold>0) ? hot_cold:"0";
    //alert(a);
    // b=$("#score").val();
    var sum=parseInt(numbness)+parseInt(feeling)+parseInt(wobbliness)+parseInt(fear)+parseInt(dizzy)+parseInt(heart)+parseInt(unsteady)+parseInt(terrified)+parseInt(nervous)+parseInt(feeling_choking)+parseInt(hands_trembling)+parseInt(shaky_unsteady)+parseInt(fear_losing_control)+parseInt(difficulty)+parseInt(fear_dying)+parseInt(scared)+parseInt(indigestion)+parseInt(faint)+parseInt(face)+parseInt(hot_cold);
    // alert(sum);
    $('#score').val(sum);
  })
</script>
</html>