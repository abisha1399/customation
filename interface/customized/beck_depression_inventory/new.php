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
      $sql = "SELECT * FROM `form_beck_depression_inventory` WHERE id=? AND pid = ? AND encounter = ?";
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
      <title>Beck Depression Inventory</title>
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
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/beck_depression_inventory/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%;">Beck Depression Inventory</h4></td>
         </tr>
        </table>
        <br>
        <table>
          <tr>
            <td style="width:25%;">CRTN:
              <input type="text" name="crtn" value="<?php echo $check_res['crtn'];?>">
            </td>
            <td style="width:25%;">CRF Number:
              <input type="text" name="crf_no" value="<?php echo $check_res['crf_no'];?>">
            </td>
            <td style="width:25%;">Patient inits:
              <input type="text" name="patient_inits" value="<?php echo $check_res['patient_inits'];?>">
            </td>
            <td style="width:25%;">Date:
              <input type="date" name="date" value="<?php echo $check_res['date'];?>">
            </td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td style="width:50%;">Name:
              <input style="width:90%;" type="text" name="name" value="<?php echo $check_res['name'];?>">
            </td>
            <td style="width:30%;">Marital Status:
              <input  type="text" name="marital_status" value="<?php echo $check_res['marital_status'];?>">
            </td>
            <td style="width:10%;">Age:
              <input class="asinput" type="text" name="age" value="<?php echo $check_res['age'];?>">
            </td>
            <td style="width:10%;">sex:
              <input class="asinput" type="text" name="sex" value="<?php echo $check_res['sex'];?>">
            </td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Occupation:
              <input style="width:80%;" type="text" name="occupation" value="<?php echo $check_res['occupation'];?>">
            </td>
            <td style="width:50%;">Education:
              <input style="width:80%;" type="text" name="education" value="<?php echo $check_res['education'];?>">
            </td>
          </tr>
        </table>
        <br><br>
        <table style="width:100%;">
          <tr>
            <td>
              <p style="font-size:20px;text-align: justify;"><b>Instructions:</b> This questionnaire consists of 21 groups of statements. Please read each group of statements carefully, and then pick out the<b>one statement</b> in each group that best describes the way you have been feeling during <b>the past two weeks, including today.</b> Circle the number beside the statemnet you have picked. If several statements in the group seem to apply equally well, circle the highest number for that group. Be sure that you do not choose more than one statement for any group, including Item 16 (Changes in Sleeping Pattern) or Item 18 (Changes in Appetite).</p>
            </td>
          </tr>
        </table>
        
        <table style="width:100%; border: 1px solid black;" class="tabel5">
          <tr>            
            <td style="border: 1px solid black;width: 50%;">
              <p><b>1. Sadness</b></p>
              <p>&emsp;<input type="radio" name="sadness" value="0"
              <?php 
                if($check_res['sadness']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I do not feel sad.</p>
              <p>&emsp;<input type="radio" name="sadness" value="1" 
              <?php 
                if($check_res['sadness']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel sad much  of the time</p>
              <p>&emsp;<input type="radio" name="sadness" value="2" 
              <?php 
                if($check_res['sadness']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am sad all the time.</p>
              <p>&emsp;<input type="radio" name="sadness" value="3" 
              <?php 
                if($check_res['sadness']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am so sad or unhappy that I can't stand it.</p>

              <br>

              <p><b>2. Pessimism</b></p>
              <p>&emsp;<input type="radio" name="pessimism" value="0"
              <?php 
                if($check_res['pessimism']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am not discouraged about my future.</p>
              <p>&emsp;<input type="radio" name="pessimism" value="1" 
              <?php 
                if($check_res['pessimism']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel more discouraged about my future than I used to be.</p>
              <p>&emsp;<input type="radio" name="pessimism" value="2" 
              <?php 
                if($check_res['pessimism']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I do not expect things to work put for me.</p>
              <p>&emsp;<input type="radio" name="pessimism" value="3" 
              <?php 
                if($check_res['pessimism']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel my futrue is hopeless and will only get worse.</p>
              
              <br>

              <p><b>3. Past Failure</b></p>
              <p>&emsp;<input type="radio" name="past_failure" value="0"
              <?php 
                if($check_res['past_failure']=="0"){
                echo "checked";
                }
              ?>
              >&emsp;
              I do not feel like a failure.</p>
              <p>&emsp;<input type="radio" name="past_failure" value="1" 
              <?php 
                if($check_res['past_failure']=="1"){
                echo "checked";
                }
              ?>
              >&emsp;
              I have  failed more than I should have.</p>
              <p>&emsp;<input type="radio" name="past_failure" value="2" 
              <?php 
                if($check_res['past_failure']=="2"){
                echo "checked";
                }
              ?>
              >&emsp;
              As I look back, I see a lot of Failures.</p>
              <p>&emsp;<input type="radio" name="past_failure" value="3" 
              <?php 
                if($check_res['past_failure']=="3"){
                echo "checked";
                }
              ?>
              >&emsp;
              I feel I am a total failure as a person.</p>

              <br>

              <p><b>4. Loss of Pleasure</b></p>
              <p>&emsp;<input type="radio" name="loss_of_pleasure" value="0"
              <?php 
                if($check_res['loss_of_pleasure']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I get as much pleasure as I ever did from the things I enjoy.</p>
              <p>&emsp;<input type="radio" name="loss_of_pleasure" value="1" 
              <?php 
                if($check_res['loss_of_pleasure']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I don't enjoy things as much as I used to.</p>
              <p>&emsp;<input type="radio" name="loss_of_pleasure" value="2" 
              <?php 
                if($check_res['loss_of_pleasure']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I get very little pleasure from the things I used to enjoy.</p>
              <p>&emsp;<input type="radio" name="loss_of_pleasure" value="3" 
              <?php 
                if($check_res['loss_of_pleasure']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I can't get any little pleasure from the things I used to enjoy.</p>

              <br>

              <p><b>5. Guilty Feelings</b></p>
              <p>&emsp;<input type="radio" name="guilty_feelings" value="0"
              <?php 
                if($check_res['guilty_feelings']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I don't feel particularly guilty.</p>
              <p>&emsp;<input type="radio" name="guilty_feelings" value="1" 
              <?php 
                if($check_res['guilty_feelings']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel guilty over many things I have done or should have done.</p>
              <p>&emsp;<input type="radio" name="guilty_feelings" value="2" 
              <?php 
                if($check_res['guilty_feelings']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel quite guilty most of the time.</p>
              <p>&emsp;<input type="radio" name="guilty_feelings" value="3" 
              <?php 
                if($check_res['guilty_feelings']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel guilty all of the time.</p>
            </td>

            <td style="border: 1px solid black;width: 50%;">
              <p><b>6. Punishment Feelings</b></p>
              <p>&emsp;<input type="radio" name="punishment_feelings" value="0"
              <?php 
                if($check_res['punishment_feelings']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I don't feel a am being punished.</p>
              <p>&emsp;<input type="radio" name="punishment_feelings" value="1"
              <?php 
                if($check_res['punishment_feelings']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel I may be punished.</p>
              <p>&emsp;<input type="radio" name="punishment_feelings" value="2"
              <?php 
                if($check_res['punishment_feelings']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I expect to be punished.</p>
              <p>&emsp;<input type="radio" name="punishment_feelings" value="3" <?php 
                if($check_res['punishment_feelings']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel I am being punished.</p>

              <br>

              <p><b>7. Self-Dislike</b></p>
              <p>&emsp;<input type="radio" name="self_dislike" value="0"
              <?php 
                if($check_res['self_dislike']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel the same about myself as ever.</p>
              <p>&emsp;<input type="radio" name="self_dislike" value="1" 
              <?php 
                if($check_res['self_dislike']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have lost confidence in myself</p>
              <p>&emsp;<input type="radio" name="self_dislike" value="2" 
              <?php 
                if($check_res['self_dislike']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am disappointed in myself</p>
              <p>&emsp;<input type="radio" name="self_dislike" value="3" 
              <?php 
                if($check_res['self_dislike']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I dislike myself.</p>

              <br>

              <p><b>8. Self-Criticalness</b></p>
              <p>&emsp;<input type="radio" name="self_criti" value="0"
              <?php 
                if($check_res['self_criti']=="0"){
                echo "checked";
                }
              ?>
              >&emsp;
              I don't criticize or blame myself more than usual.</p>
              <p>&emsp;<input type="radio" name="self_criti" value="1" 
              <?php 
                if($check_res['self_criti']=="1"){
                echo "checked";
                }
              ?>
              >&emsp;
              I  am more critical of myself than I used to be.</p>
              <p>&emsp;<input type="radio" name="self_criti" value="2" 
              <?php 
                if($check_res['self_criti']=="2"){
                echo "checked";
                }
              ?>
              >&emsp;
              I criticize myself for all of my faults.</p>
              <p>&emsp;<input type="radio" name="self_criti" value="3" 
              <?php 
                if($check_res['self_criti']=="3"){
                echo "checked";
                }
              ?>
              >&emsp;
              I blame myself for eveything bat that happens.</p>
              
              <br>

              <p><b>9. Suicidal Thoughts or wishes</b></p>
              <p>&emsp;<input type="radio" name="suicidal_tho" value="0"
              <?php 
                if($check_res['suicidal_tho']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I don't have any thoughts of killing myself.</p>
              <p>&emsp;<input type="radio" name="suicidal_tho" value="1" 
              <?php 
                if($check_res['suicidal_tho']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have thoughts of killing myself, but I would not carry them out.</p>
              <p>&emsp;<input type="radio" name="suicidal_tho" value="2" 
              <?php 
                if($check_res['suicidal_tho']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I would like to kill myself.</p>
              <p>&emsp;<input type="radio" name="suicidal_tho" value="3" 
              <?php 
                if($check_res['suicidal_tho']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I would kill myself if I had the chance.</p>

              <br>

              <p><b>10. Crying</b></p>
              <p>&emsp;<input type="radio" name="crying" value="0"
              <?php 
                if($check_res['crying']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I don't cry anymore than I used to.</p>
              <p>&emsp;<input type="radio" name="crying" value="1" 
              <?php 
                if($check_res['crying']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I cry more than I used to.</p>
              <p>&emsp;<input type="radio" name="crying" value="2" 
              <?php 
                if($check_res['crying']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I cry over every little thing.</p>
              <p>&emsp;<input type="radio" name="crying" value="3" 
              <?php 
                if($check_res['crying']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel like crying, but I can't.</p>
            </td>
          </tr>          
        </table>

        <br>
        <br>

        <table style="width:100%; border: 1px solid black;" class="tabel5">
          <tr>            
            <td style="border: 1px solid black;width: 50%;">
              <p><b>11. Agitation</b></p>
              <p>&emsp;<input type="radio" name="agitation" value="0"
              <?php 
                if($check_res['agitation']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am no more restless or wound up than usual.</p>
              <p>&emsp;<input type="radio" name="agitation" value="1" 
              <?php 
                if($check_res['agitation']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel more restless or wound up than usual.</p>
              <p>&emsp;<input type="radio" name="agitation" value="2" 
              <?php 
                if($check_res['agitation']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am so restless or agitated that it's hard to stay still.</p>
              <p>&emsp;<input type="radio" name="agitation" value="3" 
              <?php 
                if($check_res['agitation']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am so restless or agitated that I have to keep moving or doing something.</p>

              <br>

              <p><b>12. Loss of Interest</b></p>
              <p>&emsp;<input type="radio" name="loss_of_interest" value="0"
              <?php 
                if($check_res['loss_of_interest']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have not lost interest in other people or activites.</p>
              <p>&emsp;<input type="radio" name="loss_of_interest" value="1" 
              <?php 
                if($check_res['loss_of_interest']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am less interested in other people or things than before.</p>
              <p>&emsp;<input type="radio" name="loss_of_interest" value="2" 
              <?php 
                if($check_res['loss_of_interest']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have lost most of my interest in other people or things.</p>
              <p>&emsp;<input type="radio" name="loss_of_interest" value="3" 
              <?php 
                if($check_res['loss_of_interest']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              It's hard to get interested in anything.</p>
              
              <br>

              <p><b>13. Indecisiveness</b></p>
              <p>&emsp;<input type="radio" name="indecisiveness" value="0"
              <?php 
                if($check_res['indecisiveness']=="0"){
                echo "checked";
                }
              ?>
              >&emsp;
              I make decisions about as well as ever.</p>
              <p>&emsp;<input type="radio" name="indecisiveness" value="1" 
              <?php 
                if($check_res['indecisiveness']=="1"){
                echo "checked";
                }
              ?>
              >&emsp;
              I find it more different to make decisions than usual.</p>
              <p>&emsp;<input type="radio" name="indecisiveness" value="2" 
              <?php 
                if($check_res['indecisiveness']=="2"){
                echo "checked";
                }
              ?>
              >&emsp;
              I have much greater difficulty in making decisions than I used to.</p>
              <p>&emsp;<input type="radio" name="indecisiveness" value="3" 
              <?php 
                if($check_res['indecisiveness']=="3"){
                echo "checked";
                }
              ?>
              >&emsp;
              I have trouble making any decisions.</p>

              <br>

              <p><b>14. Worthlessness</b></p>
              <p>&emsp;<input type="radio" name="worthlessness" value="0"
              <?php 
                if($check_res['worthlessness']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I do not feel I am worthless.</p>
              <p>&emsp;<input type="radio" name="worthlessness" value="1" 
              <?php 
                if($check_res['worthlessness']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I don't consider myself as worthwhile and useful as I used to.</p>
              <p>&emsp;<input type="radio" name="worthlessness" value="2" 
              <?php 
                if($check_res['worthlessness']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel more worthless as compared to other people.</p>
              <p>&emsp;<input type="radio" name="worthlessness" value="3" 
              <?php 
                if($check_res['worthlessness']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I feel utterly worthless.</p>

              <br>

              <p><b>15. Loss of Energy</b></p>
              <p>&emsp;<input type="radio" name="loss_of_energy" value="0"
              <?php 
                if($check_res['loss_of_energy']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have as much energy as ever.</p>
              <p>&emsp;<input type="radio" name="loss_of_energy" value="1" 
              <?php 
                if($check_res['loss_of_energy']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have less energy than I used to have.</p>
              <p>&emsp;<input type="radio" name="loss_of_energy" value="2" 
              <?php 
                if($check_res['loss_of_energy']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I don't have enought enery to do very much.</p>
              <p>&emsp;<input type="radio" name="loss_of_energy" value="3" 
              <?php 
                if($check_res['loss_of_energy']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I don't have enough energy to do anythings.</p>

              <br>

              <p><b>16. Changes is Sleeping Pattern</b></p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="0"
              <?php 
                if($check_res['chg_slp_ptn']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have not exeprienced any change in my sleeping pattern.</p>
              <hr style="margin-left: 35px;margin-right: 35px;border-color: black;">
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="1" 
              <?php 
                if($check_res['chg_slp_ptn']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I sleep somewhat more than usual.</p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="1" 
              <?php 
                if($check_res['chg_slp_ptn']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I sleep somewhat less than usual.</p>
              <hr style="margin-left: 35px;margin-right: 35px;border-color: black;">
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="2" 
              <?php 
                if($check_res['chg_slp_ptn']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I sleep a lot more than usual.</p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="2" 
              <?php 
                if($check_res['chg_slp_ptn']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I sleep a lot less than usual.</p>
              <hr style="margin-left: 35px;margin-right: 35px;border-color: black;">
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="3" 
              <?php 
                if($check_res['chg_slp_ptn']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I sleep most of the day.</p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="3" 
              <?php 
                if($check_res['chg_slp_ptn']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I Wake up 1-2 hours early and can't get back to sleep.</p>

            </td>

            <td style="border: 1px solid black;width: 50%;">
              <p><b>17. Irritability</b></p>
              <p>&emsp;<input type="radio" name="irritability" value="0"
              <?php 
                if($check_res['irritability']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am no more irritable than usual.</p>
              <p>&emsp;<input type="radio" name="irritability" value="1"
              <?php 
                if($check_res['irritability']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am more irritable than usual.</p>
              <p>&emsp;<input type="radio" name="irritability" value="2"
              <?php 
                if($check_res['irritability']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am much more irritable than usual.</p>
              <p>&emsp;<input type="radio" name="irritability" value="3" <?php 
                if($check_res['irritability']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am irritable all the time.</p>

              <br>

              <p><b>18. Changes is Appetite</b></p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="0"
              <?php 
                if($check_res['chg_in_app']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have not exeprienced any change in my appetite.</p>
              <hr style="margin-left: 35px;margin-right: 35px;border-color: black;">
              <p>&emsp;<input type="radio" name="chg_in_app" value="1" 
              <?php 
                if($check_res['chg_in_app']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              My appetite is somewhat less than usual.</p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="1" 
              <?php 
                if($check_res['chg_in_app']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              My appetite is somewhat greater than usual.</p>
              <hr style="margin-left: 35px;margin-right: 35px;border-color: black;">
              <p>&emsp;<input type="radio" name="chg_in_app" value="2" 
              <?php 
                if($check_res['chg_in_app']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              My appetite is much less than before.</p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="2" 
              <?php 
                if($check_res['chg_in_app']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              My appetite is much greater than usual.</p>
              <hr style="margin-left: 35px;margin-right: 35px;border-color: black;">
              <p>&emsp;<input type="radio" name="chg_in_app" value="3" 
              <?php 
                if($check_res['chg_in_app']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have no appetite at all.</p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="3" 
              <?php 
                if($check_res['chg_in_app']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I crave food all the time.</p>

              <br>

              <p><b>19. Concentration Difficulty</b></p>
              <p>&emsp;<input type="radio" name="con_diff" value="0"
              <?php 
                if($check_res['con_diff']=="0"){
                echo "checked";
                }
              ?>
              >&emsp;
              I can concentrate as well as ever.</p>
              <p>&emsp;<input type="radio" name="con_diff" value="1" 
              <?php 
                if($check_res['con_diff']=="1"){
                echo "checked";
                }
              ?>
              >&emsp;
              I can't concentrate as well as ever.</p>
              <p>&emsp;<input type="radio" name="con_diff" value="2" 
              <?php 
                if($check_res['con_diff']=="2"){
                echo "checked";
                }
              ?>
              >&emsp;
              It's hard to keep my mind on anything for very long.</p>
              <p>&emsp;<input type="radio" name="con_diff" value="3" 
              <?php 
                if($check_res['con_diff']=="3"){
                echo "checked";
                }
              ?>
              >&emsp;
              I find I can't concentrate on anything.</p>
              
              <br>

              <p><b>20. Tiredness or fatigue</b></p>
              <p>&emsp;<input type="radio" name="tired_fati" value="0"
              <?php 
                if($check_res['tired_fati']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am no more tired or fatigued than usual.</p>
              <p>&emsp;<input type="radio" name="tired_fati" value="1" 
              <?php 
                if($check_res['tired_fati']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I get more tired or fatigued more easily than usual.</p>
              <p>&emsp;<input type="radio" name="tired_fati" value="2" 
              <?php 
                if($check_res['tired_fati']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am too tired or fatigued to do a lot of the things I used to do.</p>
              <p>&emsp;<input type="radio" name="tired_fati" value="3" 
              <?php 
                if($check_res['tired_fati']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am too tired or fatigued to do most of the things I used to do.</p>

              <br>

              <p><b>21. Loss of Interest in Sex</b></p>
              <p>&emsp;<input type="radio" name="loss_int_sex" value="0"
              <?php 
                if($check_res['loss_int_sex']=="0"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I Have not noticed any recent change in my interest in sex.</p>
              <p>&emsp;<input type="radio" name="loss_int_sex" value="1" 
              <?php 
                if($check_res['loss_int_sex']=="1"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am less interested in sex than Iused to be.</p>
              <p>&emsp;<input type="radio" name="loss_int_sex" value="2" 
              <?php 
                if($check_res['loss_int_sex']=="2"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I am much less interested in sex now.</p>
              <p>&emsp;<input type="radio" name="loss_int_sex"  value="3" 
              <?php 
                if($check_res['loss_int_sex']=="3"){
                 echo "checked";
                }
              ?>
              >&emsp;
              I have lost interest in sex completely.</p>
            </td>
          </tr>          
        </table>
        <table style="width:100%;">
          <tr>
            <td><input style="width:5%" type="text" name="total_score" id="score" value="<?php echo isset($check_res['total_score'])?$check_res['total_score']:'0';?>">Total Score</td>
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
    var sadness,pessimism,past_failure,loss_of_pleasure,guilty_feelings,punishment_feelings,self_dislike,self_criti,suicidal_tho,crying,agitation,loss_of_interest,indecisiveness,worthlessness,loss_of_energy,chg_slp_ptn,irritability,chg_in_app,con_diff,tired_fati,loss_int_sex;
    sadness = $("input[name='sadness']:checked").val();
    sadness=(sadness>0) ? sadness:"0";
    pessimism = $("input[name='pessimism']:checked").val();
    pessimism=(pessimism>0) ? pessimism:"0";
    past_failure = $("input[name='past_failure']:checked").val();
    past_failure=(past_failure>0) ? past_failure:"0";
    loss_of_pleasure = $("input[name='loss_of_pleasure']:checked").val();
    loss_of_pleasure=(loss_of_pleasure>0) ? loss_of_pleasure:"0";
    guilty_feelings = $("input[name='guilty_feelings']:checked").val();
    guilty_feelings=(guilty_feelings>0) ? guilty_feelings:"0";
    punishment_feelings = $("input[name='punishment_feelings']:checked").val();
    punishment_feelings=(punishment_feelings>0) ? punishment_feelings:"0";
    self_dislike = $("input[name='self_dislike']:checked").val();
    self_dislike=(self_dislike>0) ? self_dislike:"0";
    self_criti = $("input[name='self_criti']:checked").val();
    self_criti=(self_criti>0) ? self_criti:"0";

    suicidal_tho = $("input[name='suicidal_tho']:checked").val();
    suicidal_tho=(suicidal_tho>0) ? suicidal_tho:"0";
    crying = $("input[name='crying']:checked").val();
    crying=(crying>0) ? crying:"0";
    agitation = $("input[name='agitation']:checked").val();
    agitation=(agitation>0) ? agitation:"0";
    loss_of_interest = $("input[name='loss_of_interest']:checked").val();
    loss_of_interest=(loss_of_interest>0) ? loss_of_interest:"0";
    indecisiveness = $("input[name='indecisiveness']:checked").val();
    indecisiveness=(indecisiveness>0) ? indecisiveness:"0";

    worthlessness = $("input[name='worthlessness']:checked").val();
    worthlessness=(worthlessness>0) ? worthlessness:"0";
    loss_of_energy = $("input[name='loss_of_energy']:checked").val();
    loss_of_energy=(loss_of_energy>0) ? loss_of_energy:"0";
    chg_slp_ptn = $("input[name='chg_slp_ptn']:checked").val();
    chg_slp_ptn=(chg_slp_ptn>0) ? chg_slp_ptn:"0";
    irritability = $("input[name='irritability']:checked").val();
    irritability=(irritability>0) ? irritability:"0";
    chg_in_app = $("input[name='chg_in_app']:checked").val();
    chg_in_app=(chg_in_app>0) ? chg_in_app:"0";


    con_diff = $("input[name='con_diff']:checked").val();
    con_diff=(con_diff>0) ? con_diff:"0";
    tired_fati = $("input[name='tired_fati']:checked").val();
    tired_fati=(tired_fati>0) ? tired_fati:"0";
    loss_int_sex = $("input[name='loss_int_sex']:checked").val();
    loss_int_sex=(loss_int_sex>0) ? loss_int_sex:"0";
    
    
    //alert(a);
    // b=$("#score").val();
    var sum=parseInt(sadness)+parseInt(pessimism)+parseInt(past_failure)+parseInt(loss_of_pleasure)+parseInt(guilty_feelings)+parseInt(punishment_feelings)+parseInt(self_dislike)+parseInt(self_criti)+parseInt(suicidal_tho)+parseInt(crying)+parseInt(agitation)+parseInt(loss_of_interest)+parseInt(indecisiveness)+parseInt(worthlessness)+parseInt(loss_of_energy)+parseInt(chg_slp_ptn)+parseInt(irritability)+parseInt(chg_in_app)+parseInt(con_diff)+parseInt(tired_fati)+parseInt(loss_int_sex);
    // alert(sum);
    $('#score').val(sum);
  })
</script>
</html>