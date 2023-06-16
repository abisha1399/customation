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
      $sql = "SELECT * FROM `form_integrated_summary` WHERE id=? AND pid = ? AND encounter = ?";
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
    <div class="row">
      <div class="container-fluid">
        <br><br>
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/integrated_summary_form/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
         <tr>
          <td><h5>Integrated Summary<input type="text" name="first_name" value="<?php echo $check_res['first_name']; ?>">, <input type="text" name="last_name" value="<?php echo $check_res['last_name']; ?>"></h5></td>
         </tr>

         <tr>
          <td><br>
            Ms./Mr. is a <input type="text" name="integrated1" value="<?php echo $check_res['integrated1']; ?>"> 
            <span contentEditable="true" class="text_edit"><?php echo $check_res['text1']??'
            who entered treatment at The Center for Network Therapy for ambulatory withdrawal management for '?></span>
            <input type="hidden" name="text1" id="text1">
            <input type="text" name="integrated2" value="<?php echo $check_res['integrated2']; ?>">.
          </td>
         </tr>

         <tr>
          <td><br>
          Ms./Mr. <input type="text" name="integrated3" value="<?php echo $check_res['integrated3']; ?>"> <span contentEditable="true" class="text_edit"><?php echo $check_res['text2']??'
          reported that there is no OR a family history of addiction, which indicates that there is no OR a likely  biological predisposition for it. The client presents with '?></span>
          <input type="hidden" name="text2" id="text2"><input type="text" name="integrated4" value="<?php echo $check_res['integrated4']; ?>"> <span contentEditable="true" class="text_edit"><?php echo $check_res['text3']??'or has no psychiatric diagnosis at this time, and they will be provided with daily psychiatric assessments in an attempt to ensure continued stability. Medically, the client has a history of'?></span>
          <input type="hidden" name="text3" id="text3"> <input type="text" name="integrated5" value="<?php echo $check_res['integrated5']; ?>"> or has no biomedical complications or conditions at this time.
          </td>
         </tr>

         <tr>
          <td><br>
          Ms./Mr. <input type="text" name="integrated6" value="<?php echo $check_res['integrated6']; ?>"><span contentEditable="true" class="text_edit"><?php echo $check_res['text4']??' indicated that they have the support of their and family members, which will be beneficial for their recovery. Per the client, their addiction was mostly triggered by'?></span>
          <input type="hidden" name="text4" id="text4"> <input type="text" name="integrated7" value="<?php echo $check_res['integrated7']; ?>"><span contentEditable="true" class="text_edit"><?php echo $check_res['text5']??' and. The client’s low levels OR inconsistencies of trigger recognition and lack of knowledge OR ambivalence regarding relapse prevention strategies are risk factors for continued relapse in the absence of substance abuse treatment. Despite the risk factors, Ms./Mr.'?></span>
          <input type="hidden" name="text5" id="text5"> <input type="text" name="integrated8" value="<?php echo $check_res['integrated8']; ?>"><span contentEditable="true" class="text_edit"><?php echo $check_res['text6']??' reportedly has a desire to avoid relapse and live a substance free lifestyle for themselves and for their '?></span>
          <input type="hidden" name="text6" id="text6"><input type="text" name="integrated9" value="<?php echo $check_res['integrated9']; ?>">.
          </td>
         </tr>

         <tr>
          <td><br>
          Ms./Mr. <input type="text" name="integrated10" value="<?php echo $check_res['integrated10']; ?>"><span contentEditable="true" class="text_edit"><?php echo $check_res['text7']??' seems to be in the contemplation stage of change according to their Socrates recognition score (00), they have a'?></span>
          <input type="hidden" name="text7" id="text7"> <input type="text" name="integrated11" value="<?php echo $check_res['integrated11']; ?>">
          <span contentEditable="true" class="text_edit"><?php echo $check_res['text8']??' 
          recognition of how their addiction has negatively impacted their life and the harm that continued use will cause. They scored '?></span>
          <input type="hidden" name="text8" id="text8"><input type="text" name="integrated12" value="<?php echo $check_res['integrated12']; ?>"><span contentEditable="true" class="text_edit"><?php echo $check_res['text9']??' for ambivalence ( ), (high) which indicates that their commitment to change is not consistent OR (low) their commitment to change is consistent. Their score for taking steps was'?></span>
          <input type="hidden" name="text9" id="text9"> <input type="text" name="integrated13" value="<?php echo $check_res['integrated13']; ?>"> <span contentEditable="true" class="text_edit"><?php echo $check_res['text10']??'(00), (high) which shows that they have been starting to pursue a lifestyle free from mind altering substances, although unable to achieve long-term sobriety on their own OR (low) which shows that they demonstrate a lack of initiative to alter their lifestyle to achieve long-term sobriety on their own. The Becks Depression Index score of (00 ) indicates that there are'?></span>
          <input type="hidden" name="text10" id="text10"> <input type="text" name="integrated14" value="<?php echo $check_res['integrated14']; ?>"><span contentEditable="true" class="text_edit"><?php echo $check_res['text11']??' levels of depression at this time and the Beck Anxiety Inventory score of (00) indicates that there are'?></span>
          <input type="hidden" name="text11" id="text11"> <input type="text" name="integrated15" value="<?php echo $check_res['integrated15']; ?>"> <span contentEditable="true" class="text_edit"><?php echo $check_res['text12']??'  levels of anxiety. The client will be provided with daily psychiatric assessments to address any existing symptoms. According to their Fagerstrom Test for Nicotine score (00), they have '?></span>
          <input type="hidden" name="text12" id="text12"><input type="text" name="integrated16" value="<?php echo $check_res['integrated16']; ?>"> dependence on nicotine. 
          </td>
         </tr>

         <tr>
          <td><br>
          Ms./Mr. <input type="text" name="integrated17" value="<?php echo $check_res['integrated17']; ?>"> reports their strengths as being <input type="text" name="integrated18" value="<?php echo $check_res['integrated18']; ?>">. Ms./Mr. <input type="text" name="integrated19" value="<?php echo $check_res['integrated19']; ?>"> reports their needs to be <input type="text" name="integrated20" value="<?php echo $check_res['integrated20']; ?>">. Ms./Mr. <input type="text" name="integrated21" value="<?php echo $check_res['integrated21']; ?>"> identified their abilities as <input type="text" name="integrated22" value="<?php echo $check_res['integrated22']; ?>">. Ms./Mr. <input type="text" name="integrated23" value="<?php echo $check_res['integrated23']; ?>"> reported their preferences as <input type="text" name="integrated24" value="<?php echo $check_res['integrated24']; ?>">.
          </td>
         </tr>

         <tr>
          <td><br>
          <div contentEditable="true" class="text_edit"><?php echo $check_res['text13']??'
          At this time, it is recommended that the client fully engage in the individual, group, and psychiatric sessions provided at the Center for Network Therapy to learn relapse prevention methods and coping skills, in conjunction with gaining additional social support.  These factors have potential to assist the client with maintaining a substance free lifestyle. Absent of these therapeutic tools, the client remains at high risk for relapse.'?></div>
          <input type="hidden" name="text13" id="text13">
          </td>
         </tr>

         <tr>
          <td><br>
         <h5>Admission Date: <input type="date" name="integrated_date" value="<?php echo $check_res['integrated_date']; ?>"></h5>
          </td>
         </tr>

        </table>
        <br>
        <div class="btndiv">
          <input type="submit"  value="Submit" class="subbtn">
          <button class="cancel" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
        </div>
</form>

</div>
</div>
</div>
</body>
<script>
  $('.subbtn') .on('click',function(){
        $('.text_edit').each(function(){
            var dataval = $(this).html();
            $(this).next("input").val(dataval);
            
        });
        $errocount = 0;
        if($errocount==0)
        {
            $('#my_form').submit();

        }
    });
</script>
</html>