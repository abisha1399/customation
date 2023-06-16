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
       $sql = "SELECT * FROM `form_benzodiazepine` WHERE id=? AND pid = ? AND encounter = ?";
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

       td{
         border: 1px solid black;
       }
       table{
         border-collapse: unset !important;
       }
       .b1 {
           margin-left: 120px;
           font-size: 20px;
       }
       #h3_1 {
           text-align: center;

       }
       label {
           font-weight: 600;
       }
       #dob_1{
         margin-left: 10px;
       }
       #doa{
             margin-left: 10px;
       }
       #m{
         margin-left: 10px;
       }
       input {
           border: 0;
           outline: 0;
           border-bottom: 1px solid black;
       }
       .div2{
         display: flex;
       }
       .div2 p{
         margin-left: 60px;
       }
       .parent {
           display: flex;
           margin-left: 22px;
       }
       #p1{
         border-bottom: 1px solid black;
       }
       }
       #bottom {
         width: 100%;
         background-color: blue;
         height: 85%;
       }
       .inner {
         width: 49%;
         height: 49%;
         border: 1px solid black;
         float: left;
       }
       div#bottom {
           width: 100%%;
       }
       img {
           margin-top: 15px;
       }
       input[type="text"] {
           width: 100%;
       }
       .inp1{
         width: 85% !important;
       }
       button.subbtn {
         background: blue;
         color: white;
         }
         button.cancel {
         background: red;
         color: white;
         }
         .tbl2 td {
    border: none;
}
input[type="number"] {
    width: 100%;
}
             </style>
       </head>
       <body>
       <div class="container mt-3">
    <div class="row">
      <div class="container-fluid">
      <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/benzodiazepine/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
          <tr>
            <td style="width:50%;"><h3 id="h3_1">Center for Network Therapy</h3><br>
              <div class="b1"><b><u>BENZODIAZEPINE<br>
                WITHDRAWAL SCALE<br>
                (CIWA-B)
              </u>
              </b></div>

            </td>
             <td style="width:50%;">
              <label>Name:</label><input type="text" name="inp1" class="inp1" value="<?php echo $check_res['inp1']?>"><br>
              <label id="dob_1">DOB:</label><input type="date" name="inp2" value="<?php echo $check_res['inp2']?>"><br>
              <label id="doa">DOA:</label><input type="date" name="inp3" value="<?php echo $check_res['inp3']?>"><br>
              <label id="m">M</label>
              <input type="checkbox" class="radio_change gender" data-id="gender" name="inp4" value="1"
              <?php
              if($check_res['inp4']=="1"){
                echo "checked";
              }
              ?>
              ><label>F</label>
              <input type="checkbox" name="inp5" value="1" class="radio_change gender" data-id="gender"
              <?php
              if($check_res['inp5']=="1"){
                echo "checked";
              }
              ?>
              >
              <input type="hidden" id="gender">

             </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="div2">
                <p><b>RATINGS:</b></p>
                <p><b>0<input type="checkbox" class="radio_change rating" data-id="rating" value="0" <?php echo isset($check_res['rating'])&&$check_res['rating']==0?'checked':''; ?>><br>NONE</b></p>
                <p><b>1 <input type="checkbox" class="radio_change rating" data-id="rating" value="1" <?php echo isset($check_res['rating'])&&$check_res['rating']==1?'checked':''; ?>><br>MILD</b></p>
                <p><b>2 <input type="checkbox" class="radio_change rating" data-id="rating" value="2" <?php echo isset($check_res['rating'])&&$check_res['rating']==2?'checked':''; ?>><br>MODERATE</b></p>
                <p><b>3 <input type="checkbox" class="radio_change rating" data-id="rating" value="3" <?php echo isset($check_res['rating'])&&$check_res['rating']==3?'checked':''; ?>><br>SEVERE</b></p>
                <p><b>4 <input type="checkbox" class="radio_change rating" data-id="rating" value="4" <?php echo isset($check_res['rating'])&&$check_res['rating']==4?'checked':''; ?>><br>VERY SEVERE</b></p>
                <p><b>SUBJECTIVE<br>DATA</b></p>
                <input type="hidden" name="rating" id="rating" value="<?php echo $check_res['rating']??''; ?>">
              </div>
            </td>
          </tr>
        </table><br><br>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Date</b></td>
            <td><input type="text" name="inp6" value="<?php echo $check_res['inp6']?>" ></td>
            <td><input type="text" name="inp7" value="<?php echo $check_res['inp7']?>" ></td>
            <td><input type="text" name="inp8" value="<?php echo $check_res['inp8']?>" ></td>
            <td><input type="text" name="inp9" value="<?php echo $check_res['inp9']?>" ></td>
            <td><input type="text" name="inp10" value="<?php echo $check_res['inp10']?>" ></td>
            <td><input type="text" name="inp11" value="<?php echo $check_res['inp11']?>" ></td>
            <td><input type="text" name="inp12" value="<?php echo $check_res['inp12']?>" ></td>
            <td><input type="text" name="inp13" value="<?php echo $check_res['inp13']?>" ></td>
            <td><input type="text" name="inp14" value="<?php echo $check_res['inp14']?>" ></td>


          </tr>
        </table>
                <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Time</b></td>
            <td><input type="text" name="inp15" value="<?php echo $check_res['inp15']?>"></td>
            <td><input type="text" name="inp16" value="<?php echo $check_res['inp16']?>"></td>
            <td><input type="text" name="inp17" value="<?php echo $check_res['inp17']?>"></td>
            <td><input type="text" name="inp18" value="<?php echo $check_res['inp18']?>"></td>
            <td><input type="text" name="inp19" value="<?php echo $check_res['inp19']?>"></td>
            <td><input type="text" name="inp20" value="<?php echo $check_res['inp20']?>"></td>
            <td><input type="text" name="inp21" value="<?php echo $check_res['inp21']?>"></td>
            <td><input type="text" name="inp22" value="<?php echo $check_res['inp22']?>"></td>
            <td><input type="text" name="inp23" value="<?php echo $check_res['inp23']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Do you feel irritable?</b></td>
           <td><input type="number" min="1" max="7" name="inp24" value="<?php echo $check_res['inp24']?>"></td>
            <td><input type="number" min="1" max="7" name="inp25" value="<?php echo $check_res['inp25']?>"></td>
            <td><input type="number" min="1" max="7" name="inp26" value="<?php echo $check_res['inp26']?>"></td>
            <td><input type="number" min="1" max="7" name="inp27" value="<?php echo $check_res['inp27']?>"></td>
            <td><input type="number" min="1" max="7" name="inp28" value="<?php echo $check_res['inp28']?>"></td>
            <td><input type="number" min="1" max="7" name="inp29" value="<?php echo $check_res['inp29']?>"></td>
            <td><input type="number" min="1" max="7" name="inp30" value="<?php echo $check_res['inp30']?>"></td>
            <td><input type="number" min="1" max="7" name="inp31" value="<?php echo $check_res['inp31']?>"></td>
            <td><input type="number" min="1" max="7" name="inp32" value="<?php echo $check_res['inp32']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Do you feel Tired?</b></td>
            <td><input type="number" min="1" max="7" name="inp33" value="<?php echo $check_res['inp33']?>"></td>
            <td><input type="number" min="1" max="7" name="inp34" value="<?php echo $check_res['inp34']?>"></td>
            <td><input type="number" min="1" max="7" name="inp35" value="<?php echo $check_res['inp35']?>"></td>
            <td><input type="number" min="1" max="7" name="inp36" value="<?php echo $check_res['inp36']?>"></td>
            <td><input type="number" min="1" max="7" name="inp37" value="<?php echo $check_res['inp37']?>"></td>
            <td><input type="number" min="1" max="7" name="inp38" value="<?php echo $check_res['inp38']?>"></td>
            <td><input type="number" min="1" max="7" name="inp39" value="<?php echo $check_res['inp39']?>"></td>
            <td><input type="number" min="1" max="7" name="inp40" value="<?php echo $check_res['inp40']?>"></td>
            <td><input type="number" min="1" max="7" name="inp41" value="<?php echo $check_res['inp41']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Do you feel tense?</b></td>
          <td><input type="number" min="1" max="7" name="inp42" value="<?php echo $check_res['inp42']?>"></td>
            <td><input type="number" min="1" max="7" name="inp43" value="<?php echo $check_res['inp43']?>"></td>
            <td><input type="number" min="1" max="7" name="inp44" value="<?php echo $check_res['inp44']?>"></td>
            <td><input type="number" min="1" max="7" name="inp45" value="<?php echo $check_res['inp45']?>"></td>
            <td><input type="number" min="1" max="7" name="inp46" value="<?php echo $check_res['inp46']?>"></td>
            <td><input type="number" min="1" max="7" name="inp47" value="<?php echo $check_res['inp47']?>"></td>
            <td><input type="number" min="1" max="7" name="inp48" value="<?php echo $check_res['inp48']?>"></td>
            <td><input type="number" min="1" max="7" name="inp49" value="<?php echo $check_res['inp49']?>"></td>
            <td><input type="number" min="1" max="7" name="inp50" value="<?php echo $check_res['inp50']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Do you have a loss of appetite?</b></td>
            <td><input type="number" min="1" max="7" name="inp51" value="<?php echo $check_res['inp51']?>"></td>
            <td><input type="number" min="1" max="7" name="inp52" value="<?php echo $check_res['inp52']?>"></td>
            <td><input type="number" min="1" max="7" name="inp53" value="<?php echo $check_res['inp53']?>"></td>
            <td><input type="number" min="1" max="7" name="inp54" value="<?php echo $check_res['inp54']?>"></td>
            <td><input type="number" min="1" max="7" name="inp55" value="<?php echo $check_res['inp55']?>"></td>
            <td><input type="number" min="1" max="7" name="inp56" value="<?php echo $check_res['inp56']?>"></td>
            <td><input type="number" min="1" max="7" name="inp57" value="<?php echo $check_res['inp57']?>"></td>
            <td><input type="number" min="1" max="7" name="inp58" value="<?php echo $check_res['inp58']?>"></td>
            <td><input type="number" min="1" max="7" name="inp59" value="<?php echo $check_res['inp59']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Is there numbness in your face &/or hands?</b></td>
            <td><input type="number" min="1" max="7" name="inp60" value="<?php echo $check_res['inp60']?>"></td>
            <td><input type="number" min="1" max="7" name="inp61" value="<?php echo $check_res['inp61']?>"></td>
            <td><input type="number" min="1" max="7" name="inp62" value="<?php echo $check_res['inp62']?>"></td>
            <td><input type="number" min="1" max="7" name="inp63" value="<?php echo $check_res['inp63']?>"></td>
            <td><input type="number" min="1" max="7" name="inp64" value="<?php echo $check_res['inp64']?>"></td>
            <td><input type="number" min="1" max="7" name="inp65" value="<?php echo $check_res['inp65']?>"></td>
            <td><input type="number" min="1" max="7" name="inp66" value="<?php echo $check_res['inp66']?>"></td>
            <td><input type="number" min="1" max="7" name="inp67" value="<?php echo $check_res['inp67']?>"></td>
            <td><input type="number" min="1" max="7" name="inp68" value="<?php echo $check_res['inp68']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Is your heart racing?</b></td>
           <td><input type="number" min="1" max="7" name="inp69" value="<?php echo $check_res['inp69']?>"></td>
            <td><input type="number" min="1" max="7" name="inp70" value="<?php echo $check_res['inp70']?>"></td>
            <td><input type="number" min="1" max="7" name="inp71" value="<?php echo $check_res['inp71']?>"></td>
            <td><input type="number" min="1" max="7" name="inp72" value="<?php echo $check_res['inp72']?>"></td>
            <td><input type="number" min="1" max="7" name="inp73" value="<?php echo $check_res['inp73']?>"></td>
            <td><input type="number" min="1" max="7" name="inp74" value="<?php echo $check_res['inp74']?>"></td>
            <td><input type="number" min="1" max="7" name="inp75" value="<?php echo $check_res['inp75']?>"></td>
            <td><input type="number" min="1" max="7" name="inp76" value="<?php echo $check_res['inp76']?>"></td>
            <td><input type="number" min="1" max="7" name="inp77" value="<?php echo $check_res['inp77']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Does your head feel full/achy?</b></td>
           <td><input type="number" min="1" max="7" name="inp78" value="<?php echo $check_res['inp78']?>"></td>
            <td><input type="number" min="1" max="7" name="inp79" value="<?php echo $check_res['inp79']?>"></td>
            <td><input type="number" min="1" max="7" name="inp80" value="<?php echo $check_res['inp80']?>"></td>
            <td><input type="number" min="1" max="7" name="inp81" value="<?php echo $check_res['inp81']?>"></td>
            <td><input type="number" min="1" max="7" name="inp82" value="<?php echo $check_res['inp82']?>"></td>
            <td><input type="number" min="1" max="7" name="inp83" value="<?php echo $check_res['inp83']?>"></td>
            <td><input type="number" min="1" max="7" name="inp84" value="<?php echo $check_res['inp84']?>"></td>
            <td><input type="number" min="1" max="7" name="inp85" value="<?php echo $check_res['inp85']?>"></td>
            <td><input type="number" min="1" max="7" name="inp86" value="<?php echo $check_res['inp86']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Are you having difficulties concentrating?</b></td>
           <td><input type="number" min="1" max="7" name="inp87" value="<?php echo $check_res['inp87']?>"></td>
            <td><input type="number" min="1" max="7" name="inp88" value="<?php echo $check_res['inp88']?>"></td>
            <td><input type="number" min="1" max="7" name="inp89" value="<?php echo $check_res['inp89']?>"></td>
            <td><input type="number" min="1" max="7" name="inp90" value="<?php echo $check_res['inp90']?>"></td>
            <td><input type="number" min="1" max="7" name="inp91" value="<?php echo $check_res['inp91']?>"></td>
            <td><input type="number" min="1" max="7" name="inp92" value="<?php echo $check_res['inp92']?>"></td>
            <td><input type="number" min="1" max="7" name="inp93" value="<?php echo $check_res['inp93']?>"></td>
            <td><input type="number" min="1" max="7" name="inp94" value="<?php echo $check_res['inp94']?>"></td>
            <td><input type="number" min="1" max="7" name="inp95" value="<?php echo $check_res['inp95']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Are your muscles aching/<br>cramping/stiff?</b></td>
             <td><input type="number" min="1" max="7" name="inp96" value="<?php echo $check_res['inp96']?>"></td>
            <td><input type="number" min="1" max="7" name="inp97" value="<?php echo $check_res['inp97']?>"></td>
            <td><input type="number" min="1" max="7" name="inp98" value="<?php echo $check_res['inp98']?>"></td>
            <td><input type="number" min="1" max="7" name="inp99" value="<?php echo $check_res['inp99']?>"></td>
            <td><input type="number" min="1" max="7" name="inp100" value="<?php echo $check_res['inp100']?>"></td>
            <td><input type="number" min="1" max="7" name="inp101" value="<?php echo $check_res['inp101']?>"></td>
            <td><input type="number" min="1" max="7" name="inp102" value="<?php echo $check_res['inp102']?>"></td>
            <td><input type="number" min="1" max="7" name="inp103" value="<?php echo $check_res['inp103']?>"></td>
            <td><input type="number" min="1" max="7" name="inp104" value="<?php echo $check_res['inp104']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Do you feel anxious?</b></td>
            <td><input type="number" min="1" max="7" name="inp105" value="<?php echo $check_res['inp105']?>"></td>
            <td><input type="number" min="1" max="7" name="inp106" value="<?php echo $check_res['inp106']?>"></td>
            <td><input type="number" min="1" max="7" name="inp107" value="<?php echo $check_res['inp107']?>"></td>
            <td><input type="number" min="1" max="7" name="inp108" value="<?php echo $check_res['inp108']?>"></td>
            <td><input type="number" min="1" max="7" name="inp109" value="<?php echo $check_res['inp109']?>"></td>
            <td><input type="number" min="1" max="7" name="inp110" value="<?php echo $check_res['inp110']?>"></td>
            <td><input type="number" min="1" max="7" name="inp111" value="<?php echo $check_res['inp111']?>"></td>
            <td><input type="number" min="1" max="7" name="inp112" value="<?php echo $check_res['inp112']?>"></td>
            <td><input type="number" min="1" max="7" name="inp113" value="<?php echo $check_res['inp113']?>"></td>
                     </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Do you feel upset?</b></td>
            <td><input type="number" min="1" max="7" name="inp114" value="<?php echo $check_res['inp114']?>"></td>
            <td><input type="number" min="1" max="7" name="inp115" value="<?php echo $check_res['inp115']?>"></td>
            <td><input type="number" min="1" max="7" name="inp116" value="<?php echo $check_res['inp116']?>"></td>
            <td><input type="number" min="1" max="7" name="inp117" value="<?php echo $check_res['inp117']?>"></td>
            <td><input type="number" min="1" max="7" name="inp118" value="<?php echo $check_res['inp118']?>"></td>
            <td><input type="number" min="1" max="7" name="inp119" value="<?php echo $check_res['inp119']?>"></td>
            <td><input type="number" min="1" max="7" name="inp120" value="<?php echo $check_res['inp120']?>"></td>
            <td><input type="number" min="1" max="7" name="inp121" value="<?php echo $check_res['inp121']?>"></td>
            <td><input type="number" min="1" max="7" name="inp122" value="<?php echo $check_res['inp122']?>"></td>

          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Do you feel that your sleep was not restful last night?</b></td>
           <td><input type="number" min="1" max="7" name="inp123" value="<?php echo $check_res['inp123']?>"></td>
            <td><input type="number" min="1" max="7" name="inp124" value="<?php echo $check_res['inp124']?>"></td>
            <td><input type="number" min="1" max="7" name="inp125" value="<?php echo $check_res['inp125']?>"></td>
            <td><input type="number" min="1" max="7" name="inp126" value="<?php echo $check_res['inp126']?>"></td>
            <td><input type="number" min="1" max="7" name="inp127" value="<?php echo $check_res['inp127']?>"></td>
            <td><input type="number" min="1" max="7" name="inp128" value="<?php echo $check_res['inp128']?>"></td>
            <td><input type="number" min="1" max="7" name="inp129" value="<?php echo $check_res['inp129']?>"></td>
            <td><input type="number" min="1" max="7" name="inp130" value="<?php echo $check_res['inp130']?>"></td>
            <td><input type="number" min="1" max="7" name="inp131" value="<?php echo $check_res['inp131']?>"></td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:15%;"><b>Do you feel weak?</b></td>
            <td><input type="number" min="1" max="7" name="inp132" value="<?php echo $check_res['inp132']?>"></td>
            <td><input type="number" min="1" max="7" name="inp133" value="<?php echo $check_res['inp133']?>"></td>
            <td><input type="number" min="1" max="7" name="inp134" value="<?php echo $check_res['inp134']?>"></td>
            <td><input type="number" min="1" max="7" name="inp135" value="<?php echo $check_res['inp135']?>"></td>
            <td><input type="number" min="1" max="7" name="inp136" value="<?php echo $check_res['inp136']?>"></td>
            <td><input type="number" min="1" max="7" name="inp137" value="<?php echo $check_res['inp137']?>"></td>
            <td><input type="number" min="1" max="7" name="inp138" value="<?php echo $check_res['inp138']?>"></td>
            <td><input type="number" min="1" max="7" name="inp139" value="<?php echo $check_res['inp139']?>"></td>
            <td><input type="number" min="1" max="7" name="inp140" value="<?php echo $check_res['inp140']?>"></td>

          </tr>
        </table><br><br>

        <table width="100%;">
          <tr>
            <td><b><u>Last Benzodiazepine use:</u></b><br>
              <b><u>Amount last 24 hours:</u></b>
            </td>
            <td><label>Date</label>
                <input type="date" name="inp141" value="<?php echo $check_res['inp141']?>"><br>
                <label>Name:</label>
                <input type="text" name="inp142" value="<?php echo $check_res['inp142']?>" class="inp1">
            </td>
            <td>
              <label>Time:</label><input type="time" name="inp143" value="<?php echo $check_res['inp143']?>"><br>
              <label>Dose:</label><input type="text" name="inp144" value="<?php echo $check_res['inp144']?>" class="inp1">
            </td>
          </tr>
          </table>
          <table width="100%;">
          <tr>
                <td style="width:15%;"><b>Blood Pressure</b></td>
            <td><input type="number" min="1" max="7" name="inp145" value="<?php echo $check_res['inp145']?>"></td>
            <td><input type="number" min="1" max="7" name="inp146" value="<?php echo $check_res['inp146']?>"></td>
            <td><input type="number" min="1" max="7" name="inp147" value="<?php echo $check_res['inp147']?>"></td>
            <td><input type="number" min="1" max="7" name="inp148" value="<?php echo $check_res['inp148']?>"></td>
            <td><input type="number" min="1" max="7" name="inp149" value="<?php echo $check_res['inp149']?>"></td>
            <td><input type="number" min="1" max="7" name="inp150" value="<?php echo $check_res['inp150']?>"></td>
            <td><input type="number" min="1" max="7" name="inp151" value="<?php echo $check_res['inp151']?>"></td>
            <td><input type="number" min="1" max="7" name="inp152" value="<?php echo $check_res['inp152']?>"></td>
            <td><input type="number" min="1" max="7" name="inp153" value="<?php echo $check_res['inp153']?>"></td>


          </tr>
                    <tr>
                <td style="width:15%;"><b>Pulse</b></td>
            <td><input type="number" min="1" max="7" name="inp154" value="<?php echo $check_res['inp154']?>"></td>
            <td><input type="number" min="1" max="7" name="inp155" value="<?php echo $check_res['inp155']?>"></td>
            <td><input type="number" min="1" max="7" name="inp156" value="<?php echo $check_res['inp156']?>"></td>
            <td><input type="number" min="1" max="7" name="inp157" value="<?php echo $check_res['inp157']?>"></td>
            <td><input type="number" min="1" max="7" name="inp158" value="<?php echo $check_res['inp158']?>"></td>
            <td><input type="number" min="1" max="7" name="inp159" value="<?php echo $check_res['inp159']?>"></td>
            <td><input type="number" min="1" max="7" name="inp160" value="<?php echo $check_res['inp160']?>"></td>
            <td><input type="number" min="1" max="7" name="inp161" value="<?php echo $check_res['inp161']?>"></td>
            <td><input type="number" min="1" max="7" name="inp162" value="<?php echo $check_res['inp162']?>"></td>


          </tr>
                    <tr>
                <td style="width:15%;"><b>Temperature per axilla</b></td>
            <td><input type="number" min="1" max="7" name="inp163" value="<?php echo $check_res['inp163']?>"></td>
            <td><input type="number" min="1" max="7" name="inp164" value="<?php echo $check_res['inp164']?>"></td>
            <td><input type="number" min="1" max="7" name="inp165" value="<?php echo $check_res['inp165']?>"></td>
            <td><input type="number" min="1" max="7" name="inp166" value="<?php echo $check_res['inp166']?>"></td>
            <td><input type="number" min="1" max="7" name="inp167" value="<?php echo $check_res['inp167']?>"></td>
            <td><input type="number" min="1" max="7" name="inp168" value="<?php echo $check_res['inp168']?>"></td>
            <td><input type="number" min="1" max="7" name="inp169" value="<?php echo $check_res['inp169']?>"></td>
            <td><input type="number" min="1" max="7" name="inp170" value="<?php echo $check_res['inp170']?>"></td>
            <td><input type="number" min="1" max="7" name="inp171" value="<?php echo $check_res['inp171']?>"></td>


          </tr>
                    <tr>
                <td style="width:15%;"><b>Respirations</b></td>
            <td><input type="number" min="1" max="7" name="inp172" value="<?php echo $check_res['inp172']?>"></td>
            <td><input type="number" min="1" max="7" name="inp173" value="<?php echo $check_res['inp173']?>"></td>
            <td><input type="number" min="1" max="7" name="inp174" value="<?php echo $check_res['inp174']?>"></td>
            <td><input type="number" min="1" max="7" name="inp175" value="<?php echo $check_res['inp175']?>"></td>
            <td><input type="number" min="1" max="7" name="inp176" value="<?php echo $check_res['inp176']?>"></td>
            <td><input type="number" min="1" max="7" name="inp177" value="<?php echo $check_res['inp177']?>"></td>
            <td><input type="number" min="1" max="7" name="inp178" value="<?php echo $check_res['inp178']?>"></td>
            <td><input type="number" min="1" max="7" name="inp179" value="<?php echo $check_res['inp179']?>"></td>
            <td><input type="number" min="1" max="7" name="inp180" value="<?php echo $check_res['inp180']?>"></td>


          </tr>
                              <tr>
                <td style="width:20%;"><b>Levels of Consciousness<br>
                    1-Alert,obeys,oriented<br>
                    2-Confused, responds to<br>
                    speech<br>
                    3-Stuporous,responds to<br>
                    pain<br>
                    4-Semi-comatose<br>
                    5-Comatose
                </b></td>
           <td><input type="number" min="1" max="7" name="inp181" value="<?php echo $check_res['inp181']?>"></td>
            <td><input type="number" min="1" max="7" name="inp182" value="<?php echo $check_res['inp182']?>"></td>
            <td><input type="number" min="1" max="7" name="inp183" value="<?php echo $check_res['inp183']?>"></td>
            <td><input type="number" min="1" max="7" name="inp184" value="<?php echo $check_res['inp184']?>"></td>
            <td><input type="number" min="1" max="7" name="inp185" value="<?php echo $check_res['inp185']?>"></td>
            <td><input type="number" min="1" max="7" name="inp186" value="<?php echo $check_res['inp186']?>"></td>
            <td><input type="number" min="1" max="7" name="inp187" value="<?php echo $check_res['inp187']?>"></td>
            <td><input type="number" min="1" max="7" name="inp188" value="<?php echo $check_res['inp188']?>"></td>
            <td><input type="number" min="1" max="7" name="inp189" value="<?php echo $check_res['inp189']?>"></td>

          </tr>
          <tr>
            <td><b>Pupils:</b>
                <div class="parent">
                  <div style="border:1px solid black;"><b>+reacts<br>-no<br>reaction<br>B brisk <br>S<br>sluggish</b></div>
                  <div style="border:1px solid black;"><p id="p1">Size(in<br>mm)</p><b>REACTION</b></div>

                </div>

            </td>
            <td style="width:9%;">
              <div id="bottom">
  <div class="inner"><input type="number" min="1" max="7" name="inp190" value="<?php echo $check_res['inp190']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp191" value="<?php echo $check_res['inp191']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp192" value="<?php echo $check_res['inp192']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp193" value="<?php echo $check_res['inp193']?>"></div>
</div>
            </td>
            <td> <div id="bottom">
  <div class="inner"><input type="number" min="1" max="7" name="inp194" value="<?php echo $check_res['inp194']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp195" value="<?php echo $check_res['inp195']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp196" value="<?php echo $check_res['inp196']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp197" value="<?php echo $check_res['inp197']?>"></div>
</div></td>
            <td> <div id="bottom">
  <div class="inner"><input type="number" min="1" max="7" name="inp198" value="<?php echo $check_res['inp198']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp199" value="<?php echo $check_res['inp199']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp200" value="<?php echo $check_res['inp200']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp201" value="<?php echo $check_res['inp201']?>"></div>
</div></td>
            <td> <div id="bottom">
  <div class="inner"><input type="number" min="1" max="7" name="inp202" value="<?php echo $check_res['inp202']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp203" value="<?php echo $check_res['inp203']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp204" value="<?php echo $check_res['inp204']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp205" value="<?php echo $check_res['inp205']?>"></div>
</div></td>
            <td> <div id="bottom">
  <div class="inner"><input type="number" min="1" max="7" name="inp206" value="<?php echo $check_res['inp206']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp207" value="<?php echo $check_res['inp207']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp208" value="<?php echo $check_res['inp208']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp209" value="<?php echo $check_res['inp209']?>"></div>
</div></td>
            <td> <div id="bottom">
  <div class="inner"><input type="number" min="1" max="7" name="inp210" value="<?php echo $check_res['inp210']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp211" value="<?php echo $check_res['inp211']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp212" value="<?php echo $check_res['inp212']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp213" value="<?php echo $check_res['inp213']?>"></div>
</div></td>
            <td> <div id="bottom">
  <div class="inner"><input type="number" min="1" max="7" name="inp214" value="<?php echo $check_res['inp214']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp215" value="<?php echo $check_res['inp215']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp216" value="<?php echo $check_res['inp216']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp217" value="<?php echo $check_res['inp217']?>"></div>
</div></td>
            <td> <div id="bottom">
  <div class="inner"><input type="number" min="1" max="7" name="inp218" value="<?php echo $check_res['inp218']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp219" value="<?php echo $check_res['inp219']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp220" value="<?php echo $check_res['inp220']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp221" value="<?php echo $check_res['inp221']?>"></div>
</div></td>
            <td> <div id="bottom">
  <div class="inner"><input type="number" min="1" max="7" name="inp222" value="<?php echo $check_res['inp222']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp223" value="<?php echo $check_res['inp223']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp224" value="<?php echo $check_res['inp224']?>"></div>
  <div class="inner"><input type="number" min="1" max="7" name="inp225" value="<?php echo $check_res['inp225']?>"></div>
</div></td>


          </tr>
                    <tr>
            <td style="width:15%;"><b>Medications Given?</b></td>
            <td><input type="number" min="1" max="7" name="inp226" value="<?php echo $check_res['inp226']?>"></td>
            <td><input type="number" min="1" max="7" name="inp227" value="<?php echo $check_res['inp227']?>"></td>
            <td><input type="number" min="1" max="7" name="inp228" value="<?php echo $check_res['inp228']?>"></td>
            <td><input type="number" min="1" max="7" name="inp229" value="<?php echo $check_res['inp229']?>"></td>
            <td><input type="number" min="1" max="7" name="inp230" value="<?php echo $check_res['inp230']?>"></td>
            <td><input type="number" min="1" max="7" name="inp231" value="<?php echo $check_res['inp231']?>"></td>
            <td><input type="number" min="1" max="7" name="inp232" value="<?php echo $check_res['inp232']?>"></td>
            <td><input type="number" min="1" max="7" name="inp233" value="<?php echo $check_res['inp233']?>"></td>
            <td><input type="number" min="1" max="7" name="inp234" value="<?php echo $check_res['inp234']?>"></td>


          </tr>
                    <tr>
            <td style="width:15%;"><b>Nurse Initials</b></td>
           <td><input type="number" min="1" max="7" name="inp235" value="<?php echo $check_res['inp235']?>"></td>
            <td><input type="number" min="1" max="7" name="inp236" value="<?php echo $check_res['inp236']?>"></td>
            <td><input type="number" min="1" max="7" name="inp237" value="<?php echo $check_res['inp237']?>"></td>
            <td><input type="number" min="1" max="7" name="inp238" value="<?php echo $check_res['inp238']?>"></td>
            <td><input type="number" min="1" max="7" name="inp239" value="<?php echo $check_res['inp239']?>"></td>
            <td><input type="number" min="1" max="7" name="inp240" value="<?php echo $check_res['inp240']?>"></td>
            <td><input type="number" min="1" max="7" name="inp241" value="<?php echo $check_res['inp241']?>"></td>
            <td><input type="number" min="1" max="7" name="inp242" value="<?php echo $check_res['inp242']?>"></td>
            <td><input type="number" min="1" max="7" name="inp243" value="<?php echo $check_res['inp243']?>"></td>


          </tr>

        </table>
        <img src="\NetworkTherapy\openemr\interface\forms\benzodiazepine\uploads\rating.png">

        <table style="width:100%"; class="tbl2">

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
</body>
</html>
<script>
    $('.radio_change').on('change',function(){
        var checkbox_class= $(this).attr('data-id');
        if($(this).is(":checked"))
        {
            $('.'+checkbox_class).prop('checked',false);
            $(this).prop('checked',true);
            $('#'+checkbox_class).val($(this).val());
        }
    })
</script>
