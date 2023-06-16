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
    $sql = "SELECT * FROM `labcorp_form` WHERE id=? AND pid = ? AND encounter = ?";
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
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
    <?php Header::setupHeader(); ?>
    <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
  
</head>
<body>
<div class="container mt-3">
            <div class="row" >
            <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/last_form/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="col-12 mt-3">
                        <table class="table table-bordered" style="width:100%;">
                            <tr>
                            <td>
                           <b>Patient Legal Name(Last,First,Mt):</b> 
                           <input type="text" name="input1" style="" value="<?php echo text($check_res['input1']);?>">  </td>
                           
                           <td>
                           <b>Sex:</b>
                                <input type="text" name="input2" style="" value="<?php echo text($check_res['input2']);?>">
                            </td>
                            <td>
                            <b>Date of birth:</b> 
                                        <input type="date" name="input3" style="" value="<?php echo text($check_res['input3']);?>"> 
                            </td>
                            <td>
                            <b>Collaction of time:</b> 
                                <input type="time" name="input4" style="" value="<?php echo text($check_res['input4']);?>"> 
                            </td>
                            <td>
                            <b>Fasting</b> 
                              <input type="checkbox" name="checkbox1" class="fasting" value="1" <?php if ($check_res['checkbox1'] == "1") {echo "checked";}?>>Yes 
                              <input type="checkbox" name="checkbox2" class="fasting" value="1" <?php if ($check_res['checkbox2'] == "1") {echo "checked";}?>>No  
                            </td>
                            <td>
                            <b>Urine hrs/vol</b>
                                Hrs <input type="text" name="input5" style="border-bottom:1px solid black" value="<?php echo text($check_res['input5']);?>">Vol <br><br><input type="text" name="input6" style="border-bottom:1px solid black" value="<?php echo text($check_res['input6']);?>">
                            </td>
                            </tr>
                        </table>
                        <table class="table table-bordered" style="width:100%;margin-top: -17px;">
                        <tr>
                       <td>
                           <b>NPI</b> <br>
                           <input type="text" name="input7" style="" value="<?php echo text($check_res['input7']);?>">
                       </td>
                       <td>
                           <b>Physician's ID#</b> <br>
                           <input type="text" name="input8" style="" value="<?php echo text($check_res['input8']);?>">

                       </td>
                       <td>
                           <b>Patient's ID#</b> <br>
                           <input type="text" name="input9" style="" value="<?php echo text($check_res['input9']);?>">
                       </td>
                       <td>
                           <b>Hospital Patient status:</b>
                           <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {echo "checked";}?>>In-Patient 
                           <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {echo "checked";}?>>Out-Patient
                           <input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {echo "checked";}?>>Non-Patient

                       </td>
                   </tr> 
                        </table>
                        <table class="table table-bordered" style="width:100%;margin-top: -17px;">
                        <tr>
                       <td > 
                           <b>Physician's Name(Last,First):</b>
                           <input type="text" name="input10" style="" value="<?php echo text($check_res['input10']);?>">
                           </td>
                           <td>
                           <b>Physician/Authorized <br>Signature:</b>
                           <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
              <i class="fas fa-search view_icon" id="rn_input11" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input11" id="input11" value="<?php echo text($check_res['input11']); ?>"  />
                           

                       </td>
                       <td>
                           <b>Patient Address:</b> 
                           <input type="text" name="input12" style="" value="<?php echo text($check_res['input12']);?>"> <br/><br/>
                           <b>City:</b>
                           <input type="text" name="input13" style="" value="<?php echo text($check_res['input13']);?>"> 

                       </td>
                       <td>
                           <b>Phone:</b>
                           <input type="text" name="input14" style="" value="<?php echo text($check_res['input14']);?>"> <br/><br/>
                           <b>State:</b>
                           <input type="text" name="input15" style="" value="<?php echo text($check_res['input15']);?>"> 
                           

                       </td>
                       <td>
                           <b>zip:</b>
                           <input type="text" name="input16" style="" value="<?php echo text($check_res['input16']);?>"> 

                       </td>
                   </tr>
                   
                        </table>
                        <table class="table table-bordered" style="width:100%;margin-top: -17px;">
                        <tr>
                       <th>

                       <b>Diagnosis/signa/symptoma in ICO-CM format in Effect of date of Service</b>
                       <input type="text" name="input17" style="" value="<?php echo text($check_res['input17']);?>">
                       </th>
            
                       <th>
                           <b>Name of Policy Holder(If Different Filed Data Of Service Patient)</b>
                           <input type="text" name="input18" style="" value="<?php echo text($check_res['input18']);?>"> <br/><br/>
                           <b>Address of Policy Holder:</b>
                           <input type="text" name="input19" style="" value="<?php echo text($check_res['input19']);?>"> <br/><br/>
                           <b>City:</b>
                           <input type="text" name="input20" style="" value="<?php echo text($check_res['input20']);?>"> 
                            
                       </th>
                       <th>
                           <b>APT#:</b>
                           <input type="text" name="input21" style="" value="<?php echo text($check_res['input21']);?>"> <br/><br/>
                           <b>State:</b>
                           <input type="text" name="input22" style=""  value="<?php echo text($check_res['input22']);?>"> 

                       </th>
                       <th>
                           <b>Zip:</b>
                           <input type="text" name="input23" style="" value="<?php echo text($check_res['input23']);?>"> 
                       </th>
                   </tr>
</table>
<table class="table table-bordered" style="width:100%;margin-top: -17px;">
<tr>
<th>
                           <b>PRIMARY BILLING PARTY</b>
                           <input type="text" name="primarytx" style="" value="<?php echo text($check_res['primarytx']);?>">
                       </th>
                       <th>
                           <b>SECONDARY BILLING PARTY</b>
                           <input type="text" name="secondarytx" style="" value="<?php echo text($check_res['secondarytx']);?>">
                       </th>
                       <th>
                        <p>I hereby authorize the release of medical information related to the service  described herein and authorize payment directly to Labcorp.I agree to assume responsibility for payment of charges for laboratory services that are not covered by my healthcare insurance</p>
                        <input type="text" name="input42" style="border-bottom: 1px solid black;" value="<?php echo text($check_res['input42']);?>"> <br>
                        <b>Patient's Signature</b>  <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal" style="font-size:25px;"></i>
                        <i class="fas fa-search view_icon" id="rn_input39" data-toggle="modal" data-target="#viewModal" style="font-size:25px;display:none"></i><input type="hidden" name="input39" id="input39" value="<?php echo text($check_res['input39']); ?>"  /> <br>
                    </th>
                   
                    </tr>
                    <tr>
                       <th>
                           <b>Insurance Carrier*</b>
                           <input type="text" name="input24" style="" value="<?php echo text($check_res['input24']);?>"> 
                           
                       </th>
                       <th>
                        <b>Insurance Carrier*</b>
                        <input type="text" name="input25" style="" value="<?php echo text($check_res['input25']);?>"> 
                        
                    </th>
                    <th>
                    <b>MEDICARE ADVANCE BENEFICIARY NOTICE OF NONCOVERAGE(ABN)</b>
                        <P>Refer to policies published by your Medicare Adininistrative Constractor(MAC),CMS or <a href="https://www.labcorp.com/organizations/managed-care/medicare-medical-necessity" target="_blank">www.LapCorp.com/MedicareMedicalNecessity</a> when ordering tests that are subject to ABN guideline </P> 
                    </th>
                    </tr>
                    <tr>
                       <th>
                           <b>ID#</b>
                           <input type="text" name="input26" style="" value="<?php echo text($check_res['input26']);?>"> 
                       </th>
                       <th>
                        <b>ID#</b>
                        <input type="text" name="input27" style="" value="<?php echo text($check_res['input27']);?>"> 
                    </th>
                    <th>
                        <b>Clinical information/Comments</b>
                        <input type="text" name="input28" style="" value="<?php echo text($check_res['input28']);?>">
                    </th>
                    </tr>
                  </table>
                  <table class="table table-bordered" style="width:100%;margin-top: -17px;">
                  <tr>
                       <th>
                           <b>Group*</b>
                           <input type="text" name="input29" style="" value="<?php echo text($check_res['input29']);?>"> 
                       </th>
                       <th>
                        <b>Group*</b>
                        <input type="text" name="input30" style="" value="<?php echo text($check_res['input30']);?>"> 
                    </th>
                    </tr>
                    <tr>
                       <th>
                           <b>Insurance Address</b>
                           <input type="text" name="input31" style="" value="<?php echo text($check_res['input31']);?>"> 
                       </th>
                       <th>
                        <b>Insurance Address</b>
                        <input type="text" name="input32" style="" value="<?php echo text($check_res['input32']);?>"> 
                    </th>
                    
                   </tr>
                 
                   <tr>
                       <th>
                           <b>Name of Insured Person</b>
                           <input type="text" name="input33" style="" value="<?php echo text($check_res['input33']);?>"> 
                       </th>
                       <th>
                        <b>Name of Insured Person</b>
                        <input type="text" name="input34" style="" value="<?php echo text($check_res['input34']);?>"> 
                    </th>
                   </tr>
                   <tr>
                       <th>
                           <b>Relationship to Patient</b>
                           <input type="text" name="input35" style="" value="<?php echo text($check_res['input35']);?>"> 
                       </th>
                       <th>
                        <b>Relationship to Patient</b>
                        <input type="text" name="input36" style="" value="<?php echo text($check_res['input36']);?>"> 
                    </th>
                   </tr>
                   <tr>
                       <th>
                           <b>Employer Name</b>
                           <input type="text" name="input37" style="" value="<?php echo text($check_res['input37']);?>"> 
                       </th>
                       <th>
                        <b>Employer Name</b>
                        <input type="text" name="input38" style="" value="<?php echo text($check_res['input38']);?>"> 
                    </th>
                   </tr>
                  </table>
                  <table class="table table-bordered" style="width:100%;margin-top: -17px;">
                  <tr>
                       <th><b>If Medicaid State</b></th>
                       <th><b>Physician's Provider#</b></th>
                       <th><b>Work Comp</b>
                       <input type="checkbox" class="workcomp" name="checkbox6" value="1" <?php if ($check_res['checkbox6'] == "1") {echo "checked";}?>>Yes
                       <input type="checkbox" class="workcomp" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {echo "checked";}?>>No
                    </th>
                   </tr>
                  </table>
                  <table class="table table-bordered" style="width: 100%;">
                <tr style="text-align:center; background-color: black;color:white">
                  <td>
                  <label >Profile Options-choose only one(see reverse for last component details  <br>
                              (Additional profile options are avilable-contact your LapCorp representative)</label>
                  </td>
                </tr>
               </table>
               <table class="table table-bordered" style="width: 100%; margin-top: -17px;">
                <tr  >
                <th>
                             <input type="checkbox" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {echo "checked";}?>>764383 monitor 10drug class profile,urine(screen with reflex to confrimation) <br>
                             <input type="checkbox" name="checkbox9" value="1" <?php if ($check_res['checkbox9'] == "1") {echo "checked";}?>>764422 monitor 14drug class profile,urine(screen with reflex to confrimation) <br>
                             <input type="checkbox" name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {echo "checked";}?>>733692 Monitor screen 10drug profile,urine(screen-only) <br>
                             <input type="checkbox" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {echo "checked";}?>>733726 Monitor screen 14drug profile,urine(screen-only) <br>

                         </th>
                         <th>
                            <input type="checkbox" name="checkbox12" value="1" <?php if ($check_res['checkbox12'] == "1") {echo "checked";}?>>790600 ToxAssure comprehensive profile,urine <br>
                            <input type="checkbox" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {echo "checked";}?>>738526 Toxassure select profile,urine <br>
                            <input type="checkbox" name="checkbox14" value="1" <?php if ($check_res['checkbox14'] == "1") {echo "checked";}?>>738750 Heroin Metabolite(A-Acetylmorphine)
                         </th>
                </tr>
               </table>
               <table class="table table-bordered" style="width: 100%; margin-top: -17px;">
               <th style="width:21%">
                             <h4 style="font-size: 20px;text-align: center;">Drug Class</h4>
                         </th>
                         <th style="width:25%">
                            <b style="font-size: 20px;text-align: center;">Laboratory test Order(Urine) <br>(choose only one test per drug class)</b>

                         </th>
                         <th style="width:54%">
                             <input type="checkbox" name="checkbox15" value="1" <?php if ($check_res['checkbox15'] == "1") {echo "checked";}?>> <b>This Patient is prescribed or declares use of the following medications: <br>(check either Trade or Generic drug name,not both)</b>
                         </th>
               </table>
          
               <table class="table table-bordered" style="width: 100%; margin-top: -17px;">
                
                     <tr>
                         <th>
                             <b>Note:If a profile is selected above do not request individual drugs that are included in the profile</b>
                         </th>
                         <th>
                             <b>Screen Only</b>
                         </th>
                         <th>
                             <b>Screen*,reflex <br>confrimation</b>
                         </th>
                         <th>
                             <b>Confrimation Only</b>
                         </th>
                         <th>
                             <b>A-D</b>
                         </th>
                         <th>
                             <b>E-L</b>
                         </th>
                         <th><b>M-R</b></th>
                         <th>
                             <b>S-Z</b>
                         </th>
                     </tr>
                     <tr>
                         <th>
                            <b>Amphetamine/Methamphetamine</b>

                         </th>
                         <th>
                            <input type="checkbox"  name="checkbox16" value="1" <?php if ($check_res['checkbox16'] == "1") {echo "checked";}?>>701860
                         </th>
                          <th>
                            <input type="checkbox"  name="checkbox17" value="1" <?php if ($check_res['checkbox17'] == "1") {echo "checked";}?>>737691
                          </th>
                          <th>
                            <input type="checkbox"  name="checkbox18" value="1" <?php if ($check_res['checkbox18'] == "1") {echo "checked";}?>>737683
                          </th>
                          <th>
                            <input type="checkbox"  name="checkbox19" value="1" <?php if ($check_res['checkbox19'] == "1") {echo "checked";}?>>Ability
                          </th>
                          <th>
                              <input type="checkbox"  name="checkbox20" value="1" <?php if ($check_res['checkbox20'] == "1") {echo "checked";}?>>Effexor
                          </th>
                          <th>
                            <input type="checkbox"  name="checkbox21" value="1" <?php if ($check_res['checkbox21'] == "1") {echo "checked";}?>>Methadone
                          </th>
                          <th>
                            <input type="checkbox"  name="checkbox22" value="1" <?php if ($check_res['checkbox22'] == "1") {echo "checked";}?>>Seroquel
                          </th>
                    </tr>
                         <tr>
                           <th>
                            <b>MDMA</b>
                           </th>
                       <th>
                            <input type="checkbox"  name="checkbox23" value="1" <?php if ($check_res['checkbox23'] == "1") {echo "checked";}?>>701873
                         </th>
                          <th>
                            <input type="checkbox"  name="checkbox24" value="1" <?php if ($check_res['checkbox24'] == "1") {echo "checked";}?>>737740
                          </th>
                          <th>
                            <input type="checkbox"  name="checkbox25" value="1" <?php if ($check_res['checkbox25'] == "1") {echo "checked";}?>>737741
                          </th>
                          <th>
                            <input type="checkbox"  name="checkbox26" value="1" <?php if ($check_res['checkbox26'] == "1") {echo "checked";}?>>Adderall
                          </th>
                          <th>
                              <input type="checkbox"  name="checkbox27" value="1" <?php if ($check_res['checkbox27'] == "1") {echo "checked";}?>>Endocet
                          </th>
                          <th>
                            <input type="checkbox"  name="checkbox28" value="1" <?php if ($check_res['checkbox28'] == "1") {echo "checked";}?>>Methyphenidate
                          </th>
                          <th>
                            <input type="checkbox"  name="checkbox29" value="1" <?php if ($check_res['checkbox29'] == "1") {echo "checked";}?>>Sertraline
                          </th>
                         </tr>
                         <tr>
                            <th>
                             <b>Barbiturates</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox30" value="1" <?php if ($check_res['checkbox30'] == "1") {echo "checked";}?>>701863
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox31" value="1" <?php if ($check_res['checkbox31'] == "1") {echo "checked";}?>>737695
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox32" value="1" <?php if ($check_res['checkbox32'] == "1") {echo "checked";}?>>737697
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox33" value="1" <?php if ($check_res['checkbox33'] == "1") {echo "checked";}?>>Alprazolam
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox34" value="1" <?php if ($check_res['checkbox34'] == "1") {echo "checked";}?>>Escitalopram
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox35" value="1" <?php if ($check_res['checkbox35'] == "1") {echo "checked";}?>>Morphine
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox36" value="1" <?php if ($check_res['checkbox36'] == "1") {echo "checked";}?>>Soma
                           </th>
                          </tr>
                          <tr>
                            <th>
                             <b>Benzodiazepines </b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox37" value="1" <?php if ($check_res['checkbox37'] == "1") {echo "checked";}?>>701865
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox38" value="1" <?php if ($check_res['checkbox38'] == "1") {echo "checked";}?>>763900**
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox39" value="1" <?php if ($check_res['checkbox39'] == "1") {echo "checked";}?>>737697
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox40" value="1" <?php if ($check_res['checkbox40'] == "1") {echo "checked";}?>>Ambian
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox41" value="1" <?php if ($check_res['checkbox41'] == "1") {echo "checked";}?>>Eszopiclone
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox42" value="1" <?php if ($check_res['checkbox42'] == "1") {echo "checked";}?>>Morphine Sulfate
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox43" value="1" <?php if ($check_res['checkbox43'] == "1") {echo "checked";}?>>Sonata
                           </th>
                          </tr>
                          <tr>
                            <th>
                             <b>Burprenorphine</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox44" value="1" <?php if ($check_res['checkbox44'] == "1") {echo "checked";}?>>761160
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox45" value="1" <?php if ($check_res['checkbox45'] == "1") {echo "checked";}?>>763400
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox46" value="1" <?php if ($check_res['checkbox46'] == "1") {echo "checked";}?>>764400
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox47" value="1" <?php if ($check_res['checkbox47'] == "1") {echo "checked";}?>>Amitriptyline
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox48" value="1" <?php if ($check_res['checkbox48'] == "1") {echo "checked";}?>>Fentanyl
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox49" value="1" <?php if ($check_res['checkbox49'] == "1") {echo "checked";}?>>MS-Contin
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox50" value="1" <?php if ($check_res['checkbo50'] == "1") {echo "checked";}?>>Suboxone
                           </th>
                          </tr>
                          <tr>
                            <th>
                             <b>Cocaine Matabolite</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox51" value="1" <?php if ($check_res['checkbox51'] == "1") {echo "checked";}?>>701861
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox52" value="1" <?php if ($check_res['checkbox52'] == "1") {echo "checked";}?>>737750
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox53" value="1" <?php if ($check_res['checkbox53'] == "1") {echo "checked";}?>>737752
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox54" value="1" <?php if ($check_res['checkbox54'] == "1") {echo "checked";}?>>Amphetamine
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox55" value="1" <?php if ($check_res['checkbox55'] == "1") {echo "checked";}?>>Fioricet
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox56" value="1" <?php if ($check_res['checkbox56'] == "1") {echo "checked";}?>>Naproxen
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox57" value="1" <?php if ($check_res['checkbox57'] == "1") {echo "checked";}?>>Subutex
                           </th>
                          </tr>
                          <tr>
                            <th>
                             <b>Methadone</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox58" value="1" <?php if ($check_res['checkbox58'] == "1") {echo "checked";}?>>701861
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox59" value="1" <?php if ($check_res['checkbox59'] == "1") {echo "checked";}?>>737750
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox60" value="1" <?php if ($check_res['checkbox60'] == "1") {echo "checked";}?>>737752
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox61" value="1" <?php if ($check_res['checkbox61'] == "1") {echo "checked";}?>>Ativan
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox62" value="1" <?php if ($check_res['checkbox62'] == "1") {echo "checked";}?>>Fiorinal
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox63" value="1" <?php if ($check_res['checkbox63'] == "1") {echo "checked";}?>>Neurontin
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox64" value="1" <?php if ($check_res['checkbox64'] == "1") {echo "checked";}?>>Temazepam
                           </th>
                          </tr>
                          <tr>
                            <th>
                             <b>Opiates</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox65" value="1" <?php if ($check_res['checkbox65'] == "1") {echo "checked";}?>>701864
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox66" value="1" <?php if ($check_res['checkbox66'] == "1") {echo "checked";}?>>737856
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox67" value="1" <?php if ($check_res['checkbox67'] == "1") {echo "checked";}?>>737846
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox68" value="1" <?php if ($check_res['checkbox68'] == "1") {echo "checked";}?>>Buprenex
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox69" value="1" <?php if ($check_res['checkbox69'] == "1") {echo "checked";}?>>Flexeril
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox70" value="1" <?php if ($check_res['checkbox70'] == "1") {echo "checked";}?>>Norco
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox71" value="1" <?php if ($check_res['checkbox71'] == "1") {echo "checked";}?>>Topamax
                           </th>
                          </tr>

                          <tr>
                            <th>
                             <b>Oxycodone</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox72" value="1" <?php if ($check_res['checkbox72'] == "1") {echo "checked";}?>>701866
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox73" value="1" <?php if ($check_res['checkbox73'] == "1") {echo "checked";}?>>763896
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox74" value="1" <?php if ($check_res['checkbox74'] == "1") {echo "checked";}?>>763897
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox75" value="1" <?php if ($check_res['checkbox75'] == "1") {echo "checked";}?>>Buprenorphine
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox76" value="1" <?php if ($check_res['checkbox76'] == "1") {echo "checked";}?>>Fluoxetine
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox77" value="1" <?php if ($check_res['checkbox77'] == "1") {echo "checked";}?>>Nucynta
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox78" value="1" <?php if ($check_res['checkbox78'] == "1") {echo "checked";}?>>Topiramate
                           </th>
                          </tr>

                          <tr>
                            <th>
                             <b>PCP(phencyclidine)</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox79" value="1" <?php if ($check_res['checkbox79'] == "1") {echo "checked";}?>>701871
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox80" value="1" <?php if ($check_res['checkbox80'] == "1") {echo "checked";}?>>737760
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox81" value="1" <?php if ($check_res['checkbox81'] == "1") {echo "checked";}?>>737756
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox82" value="1" <?php if ($check_res['checkbox82'] == "1") {echo "checked";}?>>Buproprion
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox83" value="1" <?php if ($check_res['checkbox83'] == "1") {echo "checked";}?>>Gabapentin
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox84" value="1" <?php if ($check_res['checkbox84'] == "1") {echo "checked";}?>>Opana
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox85" value="1" <?php if ($check_res['checkbox85'] == "1") {echo "checked";}?>>Tramadol
                           </th>
                          </tr>

                          <tr>
                            <th>
                             <b>Propoxyphene</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox86" value="1" <?php if ($check_res['checkbox86'] == "1") {echo "checked";}?>>701872
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox87" value="1" <?php if ($check_res['checkbox87'] == "1") {echo "checked";}?>>737477
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox88"b value="1" <?php if ($check_res['checkbox88'] == "1") {echo "checked";}?>>737472
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox89" value="1" <?php if ($check_res['checkbox89'] == "1") {echo "checked";}?>>Buspar
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox90" value="1" <?php if ($check_res['checkbox90'] == "1") {echo "checked";}?>>Hydrocodone
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox91" value="1" <?php if ($check_res['checkbox91'] == "1") {echo "checked";}?>>Oxycodone
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox92" value="1" <?php if ($check_res['checkbox92'] == "1") {echo "checked";}?>>Tylenol
                           </th>
                          </tr>

                          <tr>
                            <th>
                             <b>THC(Cannabinoids)</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox93" value="1" <?php if ($check_res['checkbox93'] == "1") {echo "checked";}?>>701869
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox04" value="1" <?php if ($check_res['checkbox94'] == "1") {echo "checked";}?>>737738
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox95" value="1" <?php if ($check_res['checkbox95'] == "1") {echo "checked";}?>>737735
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox96" value="1" <?php if ($check_res['checkbox96'] == "1") {echo "checked";}?>>Buspirone
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox97" value="1" <?php if ($check_res['checkbox97'] == "1") {echo "checked";}?>>Hydrocodone/Acetamiophen
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox98" value="1" <?php if ($check_res['checkbox98'] == "1") {echo "checked";}?>>Oxycodone/Acetaminophen
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox99" value="1" <?php if ($check_res['checkbox99'] == "1") {echo "checked";}?>>Tylenol w/codeine
                           </th>
                          </tr>

                          <tr>
                            <th>
                             <b>Carisoprodol/Meprobamate</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox100" value="1" <?php if ($check_res['checkbox100'] == "1") {echo "checked";}?>>761107
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox101" value="1" <?php if ($check_res['checkbox101'] == "1") {echo "checked";}?>>764032
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox102" value="1" <?php if ($check_res['checkbox102'] == "1") {echo "checked";}?>>731738
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox103" value="1" <?php if ($check_res['checkbox103'] == "1") {echo "checked";}?>>Butalbital
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox104" value="1" <?php if ($check_res['checkbox104'] == "1") {echo "checked";}?>>Hydromorphone
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox105" value="1" <?php if ($check_res['checkbox105'] == "1") {echo "checked";}?>>Oxycontin
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox106" value="1" <?php if ($check_res['checkbox106'] == "1") {echo "checked";}?>>Ultram
                           </th>
                          </tr>

                          <tr>
                            <th>
                             <b>Fentanyl</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox107" value="1" <?php if ($check_res['checkbox107'] == "1") {echo "checked";}?>>761200
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox108" value="1" <?php if ($check_res['checkbox108'] == "1") {echo "checked";}?>>764200
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox109" value="1" <?php if ($check_res['checkbox109'] == "1") {echo "checked";}?>>764220
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox110" value="1" <?php if ($check_res['checkbox110'] == "1") {echo "checked";}?>>Butrans
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox111" value="1" <?php if ($check_res['checkbox111'] == "1") {echo "checked";}?>>Hydroxyzine
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox112" value="1" <?php if ($check_res['checkbox112'] == "1") {echo "checked";}?>>Oxymorphone
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox113" value="1" <?php if ($check_res['checkbox113'] == "1") {echo "checked";}?>>Valium
                           </th>
                          </tr>

                          <tr>
                            <th>
                             <b>Heroin Metabolite(6 Acetyimorphine)</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox114" value="1" <?php if ($check_res['checkbox01'] == "1") {echo "checked";}?>>701875
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox115" value="1" <?php if ($check_res['checkbox115'] == "1") {echo "checked";}?>>737933
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox116" value="1" <?php if ($check_res['checkbox116'] == "1") {echo "checked";}?>>737034
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox117" value="1" <?php if ($check_res['checkbox117'] == "1") {echo "checked";}?>>Carisoprodol
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox118" value="1" <?php if ($check_res['checkbox118'] == "1") {echo "checked";}?>>lbuprofen
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox119" value="1" <?php if ($check_res['checkbox119'] == "1") {echo "checked";}?>>OxyIR
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox120" value="1" <?php if ($check_res['checkbox120'] == "1") {echo "checked";}?>>Venlofaxine
                           </th>
                          </tr>
                          <tr>
                            <th>
                             <b>Meperidine</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox121" value="1" <?php if ($check_res['checkbox121'] == "1") {echo "checked";}?>>733738
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox122" value="1" <?php if ($check_res['checkbox122'] == "1") {echo "checked";}?>>761060
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox123" value="1" <?php if ($check_res['checkbox123'] == "1") {echo "checked";}?>>731060
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox124" value="1" <?php if ($check_res['checkbox124'] == "1") {echo "checked";}?>>Celexa
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox125" value="1" <?php if ($check_res['checkbox125'] == "1") {echo "checked";}?>>Kadian
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox126" value="1" <?php if ($check_res['checkbox126'] == "1") {echo "checked";}?>>Poxil
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox127" value="1" <?php if ($check_res['checkbox127'] == "1") {echo "checked";}?>>Vicodin
                           </th>
                          </tr>

                          <tr>
                            <th>
                             <b>Tapentadol</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox128" value="1" <?php if ($check_res['checkbox128'] == "1") {echo "checked";}?>>701900
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox129" value="1" <?php if ($check_res['checkbox129'] == "1") {echo "checked";}?>>766417
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox130" value="1" <?php if ($check_res['checkbox130'] == "1") {echo "checked";}?>>764171
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox131" value="1" <?php if ($check_res['checkbox131'] == "1") {echo "checked";}?>>Citalopram
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox132" value="1" <?php if ($check_res['checkbox132'] == "1") {echo "checked";}?>>Klonopin
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox133" value="1" <?php if ($check_res['checkbox133'] == "1") {echo "checked";}?>>Percocat
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox134" value="1" <?php if ($check_res['checkbox134'] == "1") {echo "checked";}?>>Vicoprofen
                           </th>
                          </tr>
                          <tr>
                            <th>
                             <b>Tramadol</b>
                            </th>
                        <th>
                             <input type="checkbox"  name="checkbox135" value="1" <?php if ($check_res['checkbox135'] == "1") {echo "checked";}?>>733740
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox136" value="1" <?php if ($check_res['checkbox136'] == "1") {echo "checked";}?>>761018
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox137" value="1" <?php if ($check_res['checkbox137'] == "1") {echo "checked";}?>>761019
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox138" value="1" <?php if ($check_res['checkbox138'] == "1") {echo "checked";}?>>Clonazepam
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox139" value="1" <?php if ($check_res['checkbox139'] == "1") {echo "checked";}?>>Lexapro
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox140" value="1" <?php if ($check_res['checkbox140'] == "1") {echo "checked";}?>>Phentermine
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox141" value="1" <?php if ($check_res['checkbox141'] == "1") {echo "checked";}?>>Voltaren
                           </th>
                          </tr>

                          <tr>
                            <th>
                             <b>LabCorp medwatch*report</b>
                            </th>
                        <th>
                             
                          </th>
                           <th>
                             <input type="checkbox"  name="checkbox142" value="1" <?php if ($check_res['checkbox142'] == "1") {echo "checked";}?>>733346
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox143" value="1" <?php if ($check_res['checkbox143'] == "1") {echo "checked";}?>>733346
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox144" value="1" <?php if ($check_res['checkbox144'] == "1") {echo "checked";}?>>Cyclobenzaprine
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox145"b value="1" <?php if ($check_res['checkbox145'] == "1") {echo "checked";}?>>Lidocaine
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox146" value="1" <?php if ($check_res['checkbox146'] == "1") {echo "checked";}?>>Pregabalin
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox147" value="1" <?php if ($check_res['checkbox147'] == "1") {echo "checked";}?>>Vyvanse
                           </th>
                          </tr>
                          <tr>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>
                             <input type="checkbox"  name="checkbox148" value="1" <?php if ($check_res['checkbox148'] == "1") {echo "checked";}?>>Cymbalta
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox149" value="1" <?php if ($check_res['checkbox149'] == "1") {echo "checked";}?>>Lidoderm
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox150" value="1" <?php if ($check_res['checkbox150'] == "1") {echo "checked";}?>>Promethazine
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox151" value="1" <?php if ($check_res['checkbox151'] == "1") {echo "checked";}?>>wellbutrin
                           </th>
                          </tr>

                          <tr>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>
                             <input type="checkbox"  name="checkbox152" value="1" <?php if ($check_res['checkbox152'] == "1") {echo "checked";}?>>Desyrel
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox153" value="1" <?php if ($check_res['checkbox153'] == "1") {echo "checked";}?>>Lorazepam
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox154" value="1" <?php if ($check_res['checkbox154'] == "1") {echo "checked";}?>>Prozac
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox155" value="1" <?php if ($check_res['checkbox155'] == "1") {echo "checked";}?>>Xanax
                           </th>
                          </tr>

                          <tr>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>
                             <input type="checkbox"  name="checkbox156" value="1" <?php if ($check_res['checkbox156'] == "1") {echo "checked";}?>>Diazepam
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox157" value="1" <?php if ($check_res['checkbox157'] == "1") {echo "checked";}?>>Lorcet
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox158" value="1" <?php if ($check_res['checkbox158'] == "1") {echo "checked";}?>>Quetiapine
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox159" value="1" <?php if ($check_res['checkbox159'] == "1") {echo "checked";}?>>Zanaflex
                           </th>
                          </tr>

                          <tr>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>
                             <input type="checkbox"  name="checkbox160" value="1" <?php if ($check_res['checkbox160'] == "1") {echo "checked";}?>>Dilaudid
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox161" value="1" <?php if ($check_res['checkbox161'] == "1") {echo "checked";}?>>Lortab
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox162" value="1" <?php if ($check_res['checkbox162'] == "1") {echo "checked";}?>>Restoril
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox163" value="1" <?php if ($check_res['checkbox163'] == "1") {echo "checked";}?>>Zohydro
                           </th>
                          </tr>
                          <tr>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>
                             <input type="checkbox"  name="checkbox164" value="1" <?php if ($check_res['checkbox164'] == "1") {echo "checked";}?>>Duloxetine
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox165" value="1" <?php if ($check_res['checkbox165'] == "1") {echo "checked";}?>>Lunesta
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox166" value="1" <?php if ($check_res['checkbox166'] == "1") {echo "checked";}?>>Ritalin
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox167" value="1" <?php if ($check_res['checkbox167'] == "1") {echo "checked";}?>>Zoloft
                           </th>
                          </tr>
                          <tr>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>
                             <input type="checkbox"  name="checkbox168" value="1" <?php if ($check_res['checkbox168'] == "1") {echo "checked";}?>>Duragesic
                           </th>
                           <th>
                               <input type="checkbox"  name="checkbox169" value="1" <?php if ($check_res['checkbox169'] == "1") {echo "checked";}?>>Lyrica
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox170" value="1" <?php if ($check_res['checkbox170'] == "1") {echo "checked";}?>>Roxicodone
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox171" value="1" <?php if ($check_res['checkbox171'] == "1") {echo "checked";}?>>Zolpidem
                           </th>
                          </tr>
                          <tr>
                              <th>
                              <input type="checkbox"  name="checkbox172" value="1" <?php if ($check_res['checkbox172'] == "1") {echo "checked";}?>>Other test Order: <input type="text" style="border:none" name="test39" value="<?php echo($check_res['test39']);?>"/>
                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>

                              </th>
                              <th>
                             <input type="checkbox"  name="checkbox173" value="1" <?php if ($check_res['checkbox173'] == "1") {echo "checked";}?>>Patient has no medication use declared and none prescribed
                           </th>
                           
                           <th>
                             <input type="checkbox"  name="checkbox174" value="1" <?php if ($check_res['checkbox174'] == "1") {echo "checked";}?>>A separate medication list is attached
                           </th>
                           <th>
                             <input type="checkbox"  name="checkbox175" value="1" <?php if ($check_res['checkbox175'] == "1") {echo "checked";}?>>Other medications
                           </th>
                          </tr>
               </table>
               <b>Patient Name:</b>
               <input type="text" style="border-bottom:1px solid black" name="input40" value="<?php echo text($check_res['input40']);?>"> <br><br>
               <b>Date:</b>
               <input type="date" style="border-bottom:1px solid black" name="input41" value="<?php echo text($check_res['input41']);?>"> <br> <br>


               <input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit" name="sub" value="Submit" >
        <button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                </div>
              </form</div></div>
 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="sig"></div>
                        <br />
                        <br />
                        <br />
                        <button id="clear">Clear</button>
                        <textarea id="sign_data" style="display: none"></textarea>
                    </div>
                    <input type='button' id="add_sign" class="btn btn-success" data-dismiss="modal" value='Add Sign' style='float:right'>

                </div>
            </div>
        </div>
    </div>
    <!-- modal close -->

    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <img src="" id="view_sign" alt="sign img" width='200px' height='100px'>
                </div>
            </div>
        </div>
    </div>
    <!-- modal close -->   
</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../forms/admission_orders/assets/js/jquery.signature.min.js"></script>
<script>
    var sig = $('#sig').signature({
        syncField: '#sign_data',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#sign_data").val('');
    });

    var id_name, val, display_edit, icon;


    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {
            icon = $(this).next().attr('id');;
            display_edit = $(this).next().next('input').attr('id');
            val = $("#" + display_edit).val();
            display(icon);
        });

    }

    function display(icon) {
        if (val != "") {
            $("#" + icon).css('display', 'block');

        } else {
            $("#" + icon).css('display', 'none');
        }
    }
    $('.pen_icon').click(function() {
        id_name = $(this).next().next('input').attr('id');
    });

    $('.view_icon').click(function() {
        id_name = $(this).next('input').val();
        $("#view_sign").attr("src", "data:image/png;base64," + id_name);
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        // alert(sign);
        sign = sign.split(',');
        $('#' + id_name).val(sign[1]);
        sig.signature('clear');
        $("#sign_data").val('');
        check_sign();
    });
        $('.fasting').on('change', function() {
        $('.fasting').not(this).prop('checked', false);
        });
        $('.workcomp').on('change', function() {
        $('.workcomp').not(this).prop('checked', false);
        });
</script>
</html>