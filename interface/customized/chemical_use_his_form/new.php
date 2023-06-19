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
    $sql = "SELECT * FROM `chemical_use_form` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];

}

$check_res = $formid ? $check_res : array();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
</head>
<body>
<div class="container mt-3">
    <div class="row">
        <div class="container-fluid">
        <form method="post" name="my_form" action="<?php echo $rootdir; ?>/customized/chemical_use_his_form/save.php?id=<?php echo attr_url($formid); ?>">

     <table  style="border:1px solid black;width:100%" class="table table-bordered">
      <tr>
          <th >
             <h3 style="font-weight:bold;text-align:center;">CHEMICAL USE HISTORY</h3> <br>
             <input type="checkbox" style="text-align:center;" name="checkbox01" value="1" <?php if ($check_res['checkbox01'] == "1") {echo "checked";}?>><label style="text-align:center;">Denies used all chemical</label>
          </th>
    </tr>
</table>
<table  style="border:1px solid black;width:100%" class="table table-bordered">

          <tr>
          <th>
              <b>Class of Substance</b>
          </th>
          <th>
              <b>Amount,Frequency,pattern use</b>
          </th>
          <th>
              <b>Duration</b>
          </th>
          <th>
              <b>Last Used</b>
          </th>
          </tr>
          <tr>
          <th>
              <b>Cigarettes/Tobacco</b>
          </th>
          <th>
              <input type="text" name="input1" style="border:none" value="<?php echo text($check_res['input1']);?>">
          </th>
          <th>
          <input type="text" name="input2" style="border:none" value="<?php echo text($check_res['input2']);?>">
          </th>
          <th>
          <input type="text" name="input3" style="border:none" value="<?php echo text($check_res['input3']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Alcohol</b>
          </th>
          <th>
              <input type="text" name="input4" style="border:none" value="<?php echo text($check_res['input4']);?>">
          </th>
          <th>
          <input type="text" name="input5" style="border:none" value="<?php echo text($check_res['input5']);?>">
          </th>
          <th>
          <input type="text" name="input6" style="border:none" value="<?php echo text($check_res['input6']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Amphetamine</b>
          </th>
          <th>
              <input type="text" name="input7" style="border:none" value="<?php echo text($check_res['input7']);?>">
          </th>
          <th>
          <input type="text" name="input8" style="border:none" value="<?php echo text($check_res['input8']);?>">
          </th>
          <th>
          <input type="text" name="input9" style="border:none" value="<?php echo text($check_res['input9']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Marijuana</b>
          </th>
          <th>
              <input type="text" name="input10" style="border:none" value="<?php echo text($check_res['input10']);?>">
          </th>
          <th>
          <input type="text" name="input11" style="border:none" value="<?php echo text($check_res['input11']);?>">
          </th>
          <th>
          <input type="text" name="input12" style="border:none" value="<?php echo text($check_res['input12']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Cocaine</b>
          </th>
          <th>
              <input type="text" name="input13" style="border:none" value="<?php echo text($check_res['input13']);?>">
          </th>
          <th>
          <input type="text" name="input14" style="border:none" value="<?php echo text($check_res['input14']);?>">
          </th>
          <th>
          <input type="text" name="input15" style="border:none" value="<?php echo text($check_res['input15']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Hallucinogens</b>
          </th>
          <th>
              <input type="text" name="input16" style="border:none" value="<?php echo text($check_res['input16']);?>">
          </th>
          <th>
          <input type="text" name="input17" style="border:none" value="<?php echo text($check_res['input17']);?>">
          </th>
          <th>
          <input type="text" name="input18" style="border:none" value="<?php echo text($check_res['input18']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Inhalants</b>
          </th>
          <th>
              <input type="text" name="input19" style="border:none" value="<?php echo text($check_res['input19']);?>">
          </th>
          <th>
          <input type="text" name="input20" style="border:none" value="<?php echo text($check_res['input20']);?>">
          </th>
          <th>
          <input type="text" name="input21" style="border:none" value="<?php echo text($check_res['input21']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Opiates</b>
          </th>
          <th>
              <input type="text" name="input22" style="border:none" value="<?php echo text($check_res['input22']);?>">
          </th>
          <th>
          <input type="text" name="input23" style="border:none" value="<?php echo text($check_res['input23']);?>">
          </th>
          <th>
          <input type="text" name="input24" style="border:none" value="<?php echo text($check_res['input24']);?>">
          </th>
          <tr>
          <th>
              <b>PCP</b>
          </th>
          <th>
              <input type="text" name="input25" style="border:none" value="<?php echo text($check_res['input25']);?>">
          </th>
          <th>
          <input type="text" name="input26" style="border:none" value="<?php echo text($check_res['input26']);?>">
          </th>
          <th>
          <input type="text" name="input27" style="border:none" value="<?php echo text($check_res['input27']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Sedatives</b>
          </th>
          <th>
              <input type="text" name="input28" style="border:none" value="<?php echo text($check_res['input28']);?>">
          </th>
          <th>
          <input type="text" name="input29" style="border:none" value="<?php echo text($check_res['input29']);?>">
          </th>
          <th>
          <input type="text" name="input30" style="border:none" value="<?php echo text($check_res['input30']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Ecstasy</b>
          </th>
          <th>
              <input type="text" name="input31" style="border:none" value="<?php echo text($check_res['input31']);?>">
          </th>
          <th>
          <input type="text" name="input32" style="border:none" value="<?php echo text($check_res['input32']);?>">
          </th>
          <th>
          <input type="text" name="input33" style="border:none" value="<?php echo text($check_res['input33']);?>">
          </th>
          </tr>
          </tr>
          <tr>
          <th>
              <b>Rave drugs</b>
          </th>
          <th>
              <input type="text" name="input34" style="border:none" value="<?php echo text($check_res['input34']);?>">
          </th>
          <th>
          <input type="text" name="input35" style="border:none" value="<?php echo text($check_res['input35']);?>">
          </th>
          <th>
          <input type="text" name="input36" style="border:none" value="<?php echo text($check_res['input36']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Prescription pain meds</b>
          </th>
          <th>
              <input type="text" name="input37" style="border:none" value="<?php echo text($check_res['input37']);?>">
          </th>
          <th>
          <input type="text" name="input38" style="border:none" value="<?php echo text($check_res['input38']);?>">
          </th>
          <th>
          <input type="text" name="input39" style="border:none" value="<?php echo text($check_res['input39']);?>">
          </th>
          </tr>
          <tr>
          <th>
              <b>Other</b>
          </th>
          <th>
              <input type="text" name="input40" style="border:none" value="<?php echo text($check_res['input40']);?>">
          </th>
          <th>
          <input type="text" name="input41" style="border:none" value="<?php echo text($check_res['input41']);?>">
          </th>
          <th>
          <input type="text" name="input42" style="border:none" value="<?php echo text($check_res['input42']);?>">
          </th>
          </tr>
       </table >
       <table style="border:1px solid black;width:100%" class="table table-bordered">
       <tr>
              <th>
                  <h5 STYLE="text-align:center;font-weight:bold;">TREATMENT HISTORY<h5>
              </th>
          </tr>
          <tr>
              <th>
                  <p>Substance abuse:(most recent,reason,for treatment,facility,when,treatment length,level of treatment,outcome)</p> 
                  <input type="text" name="input43" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input43']);?>"> <br>
                  <input type="text" name="input44" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input44']);?>"> <br>
                  <input type="text" name="input45" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input45']);?>">
              </th>
             </tr>
             <tr>
              <th>
                  <p>Longest period of abstinece:(when and how it was achieved):</p>
                  <input type="text" name="input46" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input46']);?>"> <br>
                  <input type="text" name="input47" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input47']);?>">
              </th>
          </tr>
          <tr>
              <th>
                  <p>Previous psychiatric Treatment History</p>
                  <input type="text" name="input48" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input48']);?>"> <br>
                  <input type="text" name="input49" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input49']);?>"> <br>
                  <input type="text" name="input50" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input50']);?>"> <br>
                  <input type="text" name="input51" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input51']);?>"> <br>
                  <input type="text" name="input52" id="" style="border:none;border-bottom:1px solid black;width:100%" value="<?php echo text($check_res['input52']);?>">

              </th>
          </tr>
          <tr>
              <th>
                  <h4 style="font-weight:bold;text-align:center;">MEDICAL HISTORY(P-Patient  F-Family)</h4>
              </th>
          </tr>
</table>
<table style="border:1px solid black;width:100%" class="table table-bordered">
<tr>

                  <th><b>P</b></th>
                  <th><b>F</b></th>
                  <th>  </th>
                  <th><b>P</b></th>
                  <th><b>F</b></th>
                  <th> </th>
                  <th><b>P</b></th>
                  <th><b>F</b></th>
                  <th>  </th>
              
          </tr>
          <tr>
              <th><input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {echo "checked";}?>></th>
              <th>Heart disease</th>
              <th><input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {echo "checked";}?>></th>
              <th>Ulcer/reflux</th>
              <th><input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox6" value="1" <?php if ($check_res['checkbox6'] == "1") {echo "checked";}?>></th>
              <th>Thyroid</th>
          </tr>
          <tr>
              <th><input type="checkbox" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {echo "checked";}?>></th>
              <th>Immune disorder</th>
              <th><input type="checkbox" name="checkbox9" value="1" <?php if ($check_res['checkbox9'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {echo "checked";}?>></th>
              <th>Vascular disease</th>
              <th><input type="checkbox" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox12" value="1" <?php if ($check_res['checkbox12'] == "1") {echo "checked";}?>></th>
              <th>hepatitis</th>
          </tr>
          <tr>
              <th><input type="checkbox" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox14" value="1" <?php if ($check_res['checkbox14'] == "1") {echo "checked";}?>></th>
              <th>Chest pain/Arrhythmia</th>
              <th><input type="checkbox" name="checkbox15" value="1" <?php if ($check_res['checkbox15'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox16" value="1" <?php if ($check_res['checkbox16'] == "1") {echo "checked";}?>></th>
              <th>Migraines</th>
              <th><input type="checkbox" name="checkbox17" value="1" <?php if ($check_res['checkbox17'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox18" value="1" <?php if ($check_res['checkbox18'] == "1") {echo "checked";}?>></th>
              <th>cancer Medical</th>
          </tr>
          <tr>
              <th><input type="checkbox" name="checkbox19" value="1" <?php if ($check_res['checkbox19'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox20" value="1" <?php if ($check_res['checkbox20'] == "1") {echo "checked";}?>></th>
              <th>Kidney disease</th>
              <th><input type="checkbox" name="checkbox21" value="1" <?php if ($check_res['checkbox21'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox22" value="1" <?php if ($check_res['checkbox22'] == "1") {echo "checked";}?>></th>
              <th>Pneumonia</th>
              <th><input type="checkbox" name="checkbox23" value="1" <?php if ($check_res['checkbox23'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox24" value="1" <?php if ($check_res['checkbox24'] == "1") {echo "checked";}?>></th>
              <th>Diabetes</th>
          </tr>
          <tr>
              <th><input type="checkbox" name="checkbox25" value="1" <?php if ($check_res['checkbox25'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox26" value="1" <?php if ($check_res['checkbox26'] == "1") {echo "checked";}?>></th>
              <th>Hypertension</th>
              <th><input type="checkbox" name="checkbox27" value="1" <?php if ($check_res['checkbox27'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox28" value="1" <?php if ($check_res['checkbox28'] == "1") {echo "checked";}?>></th>
              <th>TIA/CVA</th>
              <th><input type="checkbox" name="checkbox29" value="1" <?php if ($check_res['checkbox29'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox30" value="1" <?php if ($check_res['checkbox30'] == "1") {echo "checked";}?>></th>
              <th>Seizures disorder</th>
          </tr>
          <tr>
              <th><input type="checkbox" name="checkbox31" value="1" <?php if ($check_res['checkbox31'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox32" value="1" <?php if ($check_res['checkbox32'] == "1") {echo "checked";}?>></th>
              <th>Blood disease</th>
              <th><input type="checkbox" name="checkbox33" value="1" <?php if ($check_res['checkbox33'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox34" value="1" <?php if ($check_res['checkbox34'] == "1") {echo "checked";}?>></th>
              <th>Asthma</th>
              <th><input type="checkbox" name="checkbox35" value="1" <?php if ($check_res['checkbox35'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox36" value="1" <?php if ($check_res['checkbox36'] == "1") {echo "checked";}?>></th>
              <th>Eye problem</th>
          </tr>
          <tr>
              <th><input type="checkbox" name="checkbox37" value="1" <?php if ($check_res['checkbox37'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox38" value="1" <?php if ($check_res['checkbox38'] == "1") {echo "checked";}?>></th>
              <th>Memory loss</th>
              <th><input type="checkbox" name="checkbox39" value="1" <?php if ($check_res['checkbox39'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox40" value="1" <?php if ($check_res['checkbox40'] == "1") {echo "checked";}?>></th>
              <th>Sexually transmitted disese</th>
              <th><input type="checkbox" name="checkbox41" value="1" <?php if ($check_res['checkbox41'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox42" value="1" <?php if ($check_res['checkbox42'] == "1") {echo "checked";}?>></th>
              <th>HIV</th>
          </tr>
          <tr>
              <th><input type="checkbox" name="checkbox43" value="1" <?php if ($check_res['checkbox43'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox44" value="1" <?php if ($check_res['checkbox44'] == "1") {echo "checked";}?>></th>
              <th>Mono</th>
              <th><input type="checkbox" name="checkbox45" value="1" <?php if ($check_res['checkbox45'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox46" value="1" <?php if ($check_res['checkbox46'] == "1") {echo "checked";}?>></th>
              <th>Copo</th>
              <th><input type="checkbox" name="checkbox47" value="1" <?php if ($check_res['checkbox47'] == "1") {echo "checked";}?>></th>
              <th><input type="checkbox" name="checkbox48" value="1" <?php if ($check_res['checkbox48'] == "1") {echo "checked";}?>></th>
              <th>Arthritis</th>
          </tr>
          
</table>
     <b>Other medical issues:</b> <input type="text" name="input53" id="" style="border:none;border-bottom:1px solid black;width:85%" value="<?php echo text($check_res['input53']);?>"> <br> <br>
  <table style="border:1px solid black;width:100%" class="table table-bordered">
         <tr>
             <th>
                 <h4 style="font-weight:bold;text-align:center;">SURGICAL HISTORY</h4>
             </th>
         </tr>
         <tr>
             <th>
             <b>Have you ever had surgery in the past?</b> <input type="checkbox" class="chemcheck1" name="checkbox49" value="1" <?php if ($check_res['checkbox49'] == "1") {echo "checked";}?>>YES <input type="checkbox" name="checkbox50" class="chemcheck1"  value="1" <?php if ($check_res['checkbox50'] == "1") {echo "checked";}?>>NO
             </th>
         </tr>
</table>
<table style="border:1px solid black;width:100%" class="table table-bordered">

         <tr>
             <th>
                 <b>Surgical Procedure(s):</b>
            </th>
            <th>
                <b>Year</b>
            </th>
             
         </tr>
         <tr>
             <th>
             <input type="text" name="input54" id="" style="border:none;" value="<?php echo text($check_res['input54']);?>"> 
             </th>
             <th>
             <input type="text" name="input55" id="" style="border:none;" value="<?php echo text($check_res['input55']);?>"> 
             </th>
         </tr>
         <tr>
             <th>
             <input type="text" name="input56" id="" style="border:none;" value="<?php echo text($check_res['input56']);?>"> 
             </th>
             <th>
             <input type="text" name="input57" id="" style="border:none;" value="<?php echo text($check_res['input57']);?>"> 
             </th>
         </tr>
  </table>
         <input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit" name="sub" value="Submit" >
        <button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>

</form>

</div>
</div>
</div>
<script>
    $('.chemcheck1').on('change', function() {
     $('.chemcheck1').not(this).prop('checked', false);
    });
</script>
</body>
</html>
         