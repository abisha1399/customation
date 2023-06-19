<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");




$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$name = $_GET['formname'];
$pid = $_SESSION["pid"];
$encounter = $_GET["encounter"];


$check_res =array();

    $sql = "SELECT * FROM `labcorp_form` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

    use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<style>
      
</style>
<body id='body' class='body'>
<?php
$header ="<div style='color:white;background-color:grey;text-align:center'>
<H2>Center for Network Theropey <br> 20 Gibson Place,Suite 103 <br> Freeehold,Nj07728 <br>732-431-5800
</H2>
</div>";
ob_start();
?>
<table class="table table-bordered" style="width:100%;border-collapse:collapse;">
<tr>
       <th  style="border:1px solid black;">
           <b>Patient Legal Name(Last,First,Mt):</b>
           <p><?php echo text($check_res['input1']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>Sex:</b>
           <p><?php echo text($check_res['input2']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>Date of birth:</b>
           <p><?php echo text($check_res['input3']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>	Collaction of time:</b>
           <p><?php echo text($check_res['input4']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>Fasting:</b>
           <p><input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Yes<br></p>
      <p><input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;No<br></p>
       </th>
       <th style="border:1px solid black;">
           <b>	Urine hrs/vol</b>Hrs
           <p><?php echo text($check_res['input5']); ?></p>Vol <p><br/><?php echo text($check_res['input6']); ?></p>
       </th>
   </tr>
                        </table>
                        <table class="table table-bordered" style="width:100%;border-collapse:collapse;">
                        <tr>
       <th style="border:1px solid black;">
           <b>NPI:</b>
           <p><?php echo text($check_res['input7']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>Physician's ID#:</b>
           <p><?php echo text($check_res['input8']); ?></p>
       </th>
       <th style="border:1px solid black;">
           <b>Patient's ID#:</b>
           <p><?php echo text($check_res['input9']); ?></p>
       </th>
        
       <th style="border:1px solid black;">
           <b>Hospital Patient status:</b>
           <p><input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;In-Patient<br></p>
      <p><input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Out-Patient<br></p>
     <p><input type="checkbox" name="checkbox5" value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Non-Patient<br></p>
       </th>
       
   </tr>
   </table>
   <table class="table table-bordered" style="width:100%;border-collapse:collapse;">
   <tr>
       <th style="border:1px solid black;">
          <b>Physician's Name(Last,First):</b>
          <p><?php echo text($check_res['input10']); ?></p>

       </th>
       <th style="border:1px solid black;">
           <b>Physician/Authorized Signature:</b>
           <p>   <img src='data:image/png;base64,<?php echo xlt($check_res['input11']); ?>' width='100px' height='50px'/></p>
       </th>
       <th style="border:1px solid black;">
          <b>Patient Address:</b>
          <p><?php echo text($check_res['input12']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b>City:</b>
          <p><?php echo text($check_res['input13']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b> Phone:</b>
          <p><?php echo text($check_res['input14']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b>State:</b>
          <p><?php echo text($check_res['input15']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b>zip:</b>
          <p><?php echo text($check_res['input16']); ?></p>

       </th>
   </tr>
  
   </table>
   <table class="table table-bordered" style="width:100%;border-collapse:collapse;">
   <tr>
   <th style="border:1px solid black;">
          <b>Diagnosis/signa/symptoma in ICO-CM format in Effect of date of Service:</b>
          <p><?php echo text($check_res['input17']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b>Name of Policy Holder(If Different Filed Data Of Service Patient):</b>
          <p><?php echo text($check_res['input18']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b>Address of Policy Holder:</b>
          <p><?php echo text($check_res['input19']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b>City:</b>
          <p><?php echo text($check_res['input20']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b>APT#:</b>
          <p><?php echo text($check_res['input21']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b>State:</b>
          <p><?php echo text($check_res['input22']); ?></p>

       </th>
       <th style="border:1px solid black;">
          <b>zip:</b>
          <p><?php echo text($check_res['input23']); ?></p>

       </th>
   </tr>
   </table>
   <table class="table table-bordered" style="width:100%;border-collapse:collapse;">
   <tr>
       <th style="border:1px solid black;">
           <b>PRIMARY BILLING PARTY</b>:<?php echo text($check_res['primarytx']); ?>
       </th>
       <th style="border:1px solid black;">
           <b>SECONDARY BILLING PARTY</b>:<?php echo text($check_res['secondarytx']); ?>
       </th>
       <th style="border:1px solid black;">
           <p>I hereby authorize the release of medical information related to the service  described herein and authorize payment directly to Labcorp.I agree to assume responsibility for payment of charges for laboratory services that are not covered by my healthcare insurance</p> <br>
           <b>Signature</b>:
           <p><?php echo text($check_res['input42']); ?><br/>
           <img src='data:image/png;base64,<?php echo xlt($check_res['input39']); ?>' width='100px' height='50px'/></p>
          

       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
       <b>Insurance Carrier*:</b>
       <p><?php echo text($check_res['input24']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <b>Insurance Carrier*:</b>
       <p><?php echo text($check_res['input25']); ?></p>
       </th>
       <th style="border:1px solid black;"> <b>MEDICARE ADVANCE BENEFICIARY NOTICE OF NONCOVERAGE(ABN)</b>
                        <P>Refer to policies published by your Medicare Adininistrative Constractor(MAC),CMS or <a href="https://www.labcorp.com/organizations/managed-care/medicare-medical-necessity" target="_blank">www.LapCorp.com/MedicareMedicalNecessity</a> when ordering tests that are subject to ABN guideline </P> </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
       <b>ID#:</b>
       <p><?php echo text($check_res['input26']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <b>ID#:</b>
       <p><?php echo text($check_res['input27']); ?></p>
       </th>
       <th style="border:1px solid black;"><b>Clinical information/Comments:</b>
       <?php echo text($check_res['input28']); ?></th>
   </tr>
   </table>
   <table class="table table-bordered" style="width:100%;border-collapse:collapse;">
   <tr>
       <th style="border:1px solid black;">
       <b>Group*:</b>
       <p><?php echo text($check_res['input29']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <b>Group*:</b>
       <p><?php echo text($check_res['input30']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
       <b>Insurance Address:</b>
       <p><?php echo text($check_res['input31']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <b>Insurance Address:</b>
       <p><?php echo text($check_res['input32']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
       <b>Name of Insured Person:</b>
       <p><?php echo text($check_res['input33']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <b>Name of Insured Person:</b>
       <p><?php echo text($check_res['input34']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
       <b>Relationship to Patient:</b>
       <p><?php echo text($check_res['input35']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <b>Relationship to Patient:</b>
       <p><?php echo text($check_res['input36']); ?></p>
       </th>
   </tr>
   <tr>
       <th style="border:1px solid black;">
       <b>Employer Name:</b>
       <p><?php echo text($check_res['input37']); ?></p>
       </th>
       <th style="border:1px solid black;">
       <b>Employer Name:</b>
       <p><?php echo text($check_res['input38']); ?></p>
       </th>
   </tr>
   </table>
   <table class="table table-bordered" style="width:100%;border-collapse:collapse;">
   <tr>
       <th style="border:1px solid black;">
         <b>If Medicaid State</b>
       </th>
       <th style="border:1px solid black;">
           <b>Physician's Provider#</b>
       </th>
       <th style="border:1px solid black;"> 
           <b>Work Comp </b>
           <p><input type="checkbox" name="checkbox6" value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Yes<br></p>
      <p><input type="checkbox" name="checkbox7" value="1" <?php if ($check_res['checkbox7'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;No<br></p>
       </th>
   </tr>
   </table>
   <br/><br/><br/><br/><br/><br/><br/><br/><br/>
   <table class="table table-bordered" style="width: 100%;text-align:center; background-color: black;color:white">
                <tr >
                  <td>
                  <label >Profile Options-choose only one(see reverse for last component details  <br>
                              (Additional profile options are avilable-contact your LapCorp representative)</label>
                  </td>
                </tr>
               </table>
   <table class="table table-bordered" style="width:100%;border-collapse:collapse;">
   <tr>
       <th style="border:1px solid black;">
       <p><input type="checkbox" name="checkbox8" value="1" <?php if ($check_res['checkbox8'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;764383 monitor 10drug class profile,urine(screen with reflex to confrimation)<br></p>
      <p><input type="checkbox" name="checkbox9" value="1" <?php if ($check_res['checkbox9'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;764422 monitor 14drug class profile,urine(screen with reflex to confrimation)<br></p>
         <p><input type="checkbox" name="checkbox10" value="1" <?php if ($check_res['checkbox10'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;733692 Monitor screen 10drug profile,urine(screen-only)<br></p>
      <p><input type="checkbox" name="checkbox11" value="1" <?php if ($check_res['checkbox11'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;733726 Monitor screen 14drug profile,urine(screen-only)<br></p>
       </th>
   
       <th style="border:1px solid black;">
       <p><input type="checkbox" name="checkbox12" value="1" <?php if ($check_res['checkbox12'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;790600 ToxAssure comprehensive profile,urine<br></p>
      <p><input type="checkbox" name="checkbox13" value="1" <?php if ($check_res['checkbox13'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;738526 Toxassure select profile,urine<br></p>
      <p><input type="checkbox" name="checkbox14" value="1" <?php if ($check_res['checkbox14'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;738750 Heroin Metabolite(A-Acetylmorphine)<br></p>
       </th>
   </tr>
   </table>
   <table class="table table-bordered" style="width:100%;border-collapse:collapse;">
   <tr>
       <th style="border:1px solid black;">
       <h4 style="font-size: 20px;text-align: center;">Drug Class</h4>
       </th>
       <th style="border:1px solid black;">
       Laboratory test Order(Urine)
(choose only one test per drug class)
       </th>
       <th style="border:1px solid black;">
       <p><input type="checkbox" name="checkbox15" value="1" <?php if ($check_res['checkbox15'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;This Patient is prescribed or declares use of the following medications:
    (check either Trade or Generic drug name,not both)<br></p>
       </th>
   </tr>
   </table>
   <table class="table table-bordered" style="width: 100%;border-collapse:collapse;">
                
                     <tr>
                         <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Note:If a profile is selected above do not request individual drugs that are included in the profile</b>
                         </th>
                         <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Screen Only</b>
                         </th>
                         <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Screen*,reflex <br>confrimation</b>
                         </th>
                         <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Confrimation Only</b>
                         </th>
                         <th style="border:1px solid black;border-collapse:collapse;">
                             <b>A-D</b>
                         </th>
                         <th style="border:1px solid black;border-collapse:collapse;">
                             <b>E-L</b>
                         </th>
                         <th style="border:1px solid black;border-collapse:collapse;"><b>M-R</b></th>
                         <th style="border:1px solid black;border-collapse:collapse;">
                             <b>S-Z</b>
                         </th>
                     </tr>
                     <tr>
                         <th style="border:1px solid black;border-collapse:collapse;">
                            <b>Amphetamine/Methamphetamine</b>

                         </th>
                         <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox16" value="1" <?php if ($check_res['checkbox16'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701860
                         </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox17" value="1" <?php if ($check_res['checkbox17'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737691
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox18" value="1" <?php if ($check_res['checkbox18'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737683
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox19" value="1" <?php if ($check_res['checkbox19'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Ability
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                              <input type="checkbox"  name="checkbox20" value="1" <?php if ($check_res['checkbox20'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Effexor
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox21" value="1" <?php if ($check_res['checkbox21'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Methadone
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox22" value="1" <?php if ($check_res['checkbox22'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Seroquel
                          </th>
                    </tr>
                         <tr>
                           <th style="border:1px solid black;border-collapse:collapse;">
                            <b>MDMA</b>
                           </th>
                       <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox23" value="1" <?php if ($check_res['checkbox23'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701873
                         </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox24" value="1" <?php if ($check_res['checkbox24'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737740
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox25" value="1" <?php if ($check_res['checkbox25'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737741
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox26" value="1" <?php if ($check_res['checkbox26'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Adderall
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                              <input type="checkbox"  name="checkbox27" value="1" <?php if ($check_res['checkbox27'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Endocet
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox28" value="1" <?php if ($check_res['checkbox28'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Methyphenidate
                          </th>
                          <th style="border:1px solid black;border-collapse:collapse;">
                            <input type="checkbox"  name="checkbox29" value="1" <?php if ($check_res['checkbox29'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Sertraline
                          </th>
                         </tr>
                         <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Barbiturates</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox30" value="1" <?php if ($check_res['checkbox30'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701863
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox31" value="1" <?php if ($check_res['checkbox31'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737695
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox32" value="1" <?php if ($check_res['checkbox32'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737697
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox33" value="1" <?php if ($check_res['checkbox33'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Alprazolam
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox34" value="1" <?php if ($check_res['checkbox34'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Escitalopram
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox35" value="1" <?php if ($check_res['checkbox35'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Morphine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox36" value="1" <?php if ($check_res['checkbox36'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Soma
                           </th>
                          </tr>
                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Benzodiazepines </b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox37" value="1" <?php if ($check_res['checkbox37'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701865
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox38" value="1" <?php if ($check_res['checkbox38'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>763900**
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox39" value="1" <?php if ($check_res['checkbox39'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737697
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox40" value="1" <?php if ($check_res['checkbox40'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Ambian
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox41" value="1" <?php if ($check_res['checkbox41'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Eszopiclone
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox42" value="1" <?php if ($check_res['checkbox42'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Morphine Sulfate
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox43" value="1" <?php if ($check_res['checkbox43'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Sonata
                           </th>
                          </tr>
                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Burprenorphine</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox44" value="1" <?php if ($check_res['checkbox44'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>761160
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox45" value="1" <?php if ($check_res['checkbox45'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>763400
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox46" value="1" <?php if ($check_res['checkbox46'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>764400
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox47" value="1" <?php if ($check_res['checkbox47'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Amitriptyline
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox48" value="1" <?php if ($check_res['checkbox48'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Fentanyl
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox49" value="1" <?php if ($check_res['checkbox49'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>MS-Contin
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox50" value="1" <?php if ($check_res['checkbo50'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Suboxone
                           </th>
                          </tr>
                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Cocaine Matabolite</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox51" value="1" <?php if ($check_res['checkbox51'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701861
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox52" value="1" <?php if ($check_res['checkbox52'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737750
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox53" value="1" <?php if ($check_res['checkbox53'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737752
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox54" value="1" <?php if ($check_res['checkbox54'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Amphetamine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox55" value="1" <?php if ($check_res['checkbox55'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Fioricet
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox56" value="1" <?php if ($check_res['checkbox56'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Naproxen
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox57" value="1" <?php if ($check_res['checkbox57'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Subutex
                           </th>
                          </tr>
                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Methadone</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox58" value="1" <?php if ($check_res['checkbox58'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701861
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox59" value="1" <?php if ($check_res['checkbox59'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737750
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox60" value="1" <?php if ($check_res['checkbox60'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737752
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox61" value="1" <?php if ($check_res['checkbox61'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Ativan
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox62" value="1" <?php if ($check_res['checkbox62'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Fiorinal
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox63" value="1" <?php if ($check_res['checkbox63'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Neurontin
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox64" value="1" <?php if ($check_res['checkbox64'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Temazepam
                           </th>
                          </tr>
                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Opiates</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox65" value="1" <?php if ($check_res['checkbox65'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701864
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox66" value="1" <?php if ($check_res['checkbox66'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737856
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox67" value="1" <?php if ($check_res['checkbox67'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737846
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox68" value="1" <?php if ($check_res['checkbox68'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Buprenex
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox69" value="1" <?php if ($check_res['checkbox69'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Flexeril
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox70" value="1" <?php if ($check_res['checkbox70'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Norco
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox71" value="1" <?php if ($check_res['checkbox71'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Topamax
                           </th>
                          </tr>

                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Oxycodone</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox72" value="1" <?php if ($check_res['checkbox72'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701866
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox73" value="1" <?php if ($check_res['checkbox73'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>763896
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox74" value="1" <?php if ($check_res['checkbox74'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>763897
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox75" value="1" <?php if ($check_res['checkbox75'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Buprenorphine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox76" value="1" <?php if ($check_res['checkbox76'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Fluoxetine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox77" value="1" <?php if ($check_res['checkbox77'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Nucynta
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox78" value="1" <?php if ($check_res['checkbox78'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Topiramate
                           </th>
                          </tr>

                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>PCP(phencyclidine)</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox79" value="1" <?php if ($check_res['checkbox79'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701871
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox80" value="1" <?php if ($check_res['checkbox80'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737760
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox81" value="1" <?php if ($check_res['checkbox81'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737756
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox82" value="1" <?php if ($check_res['checkbox82'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Buproprion
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox83" value="1" <?php if ($check_res['checkbox83'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Gabapentin
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox84" value="1" <?php if ($check_res['checkbox84'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Opana
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox85" value="1" <?php if ($check_res['checkbox85'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Tramadol
                           </th>
                          </tr>

                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Propoxyphene</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox86" value="1" <?php if ($check_res['checkbox86'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701872
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox87" value="1" <?php if ($check_res['checkbox87'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737477
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox88"b value="1" <?php if ($check_res['checkbox88'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737472
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox89" value="1" <?php if ($check_res['checkbox89'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Buspar
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox90" value="1" <?php if ($check_res['checkbox90'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Hydrocodone
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox91" value="1" <?php if ($check_res['checkbox91'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Oxycodone
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox92" value="1" <?php if ($check_res['checkbox92'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Tylenol
                           </th>
                          </tr>

                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>THC(Cannabinoids)</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox93" value="1" <?php if ($check_res['checkbox93'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701869
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox04" value="1" <?php if ($check_res['checkbox94'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737738
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox95" value="1" <?php if ($check_res['checkbox95'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737735
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox96" value="1" <?php if ($check_res['checkbox96'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Buspirone
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox97" value="1" <?php if ($check_res['checkbox97'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Hydrocodone/Acetamiophen
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox98" value="1" <?php if ($check_res['checkbox98'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Oxycodone/Acetaminophen
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox99" value="1" <?php if ($check_res['checkbox99'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Tylenol w/codeine
                           </th>
                          </tr>

                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Carisoprodol/Meprobamate</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox100" value="1" <?php if ($check_res['checkbox100'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>761107
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox101" value="1" <?php if ($check_res['checkbox101'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>764032
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox102" value="1" <?php if ($check_res['checkbox102'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>731738
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox103" value="1" <?php if ($check_res['checkbox103'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Butalbital
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox104" value="1" <?php if ($check_res['checkbox104'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Hydromorphone
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox105" value="1" <?php if ($check_res['checkbox105'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Oxycontin
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox106" value="1" <?php if ($check_res['checkbox106'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Ultram
                           </th>
                          </tr>

                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Fentanyl</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox107" value="1" <?php if ($check_res['checkbox107'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>761200
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox108" value="1" <?php if ($check_res['checkbox108'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>764200
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox109" value="1" <?php if ($check_res['checkbox109'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>764220
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox110" value="1" <?php if ($check_res['checkbox110'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Butrans
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox111" value="1" <?php if ($check_res['checkbox111'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Hydroxyzine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox112" value="1" <?php if ($check_res['checkbox112'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Oxymorphone
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox113" value="1" <?php if ($check_res['checkbox113'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Valium
                           </th>
                          </tr>

                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Heroin Metabolite(6 Acetyimorphine)</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox114" value="1" <?php if ($check_res['checkbox01'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701875
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox115" value="1" <?php if ($check_res['checkbox115'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737933
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox116" value="1" <?php if ($check_res['checkbox116'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>737034
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox117" value="1" <?php if ($check_res['checkbox117'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Carisoprodol
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox118" value="1" <?php if ($check_res['checkbox118'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>lbuprofen
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox119" value="1" <?php if ($check_res['checkbox119'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>OxyIR
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox120" value="1" <?php if ($check_res['checkbox120'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Venlofaxine
                           </th>
                          </tr>
                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Meperidine</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox121" value="1" <?php if ($check_res['checkbox121'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>733738
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox122" value="1" <?php if ($check_res['checkbox122'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>761060
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox123" value="1" <?php if ($check_res['checkbox123'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>731060
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox124" value="1" <?php if ($check_res['checkbox124'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Celexa
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox125" value="1" <?php if ($check_res['checkbox125'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Kadian
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox126" value="1" <?php if ($check_res['checkbox126'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Poxil
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox127" value="1" <?php if ($check_res['checkbox127'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Vicodin
                           </th>
                          </tr>

                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Tapentadol</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox128" value="1" <?php if ($check_res['checkbox128'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>701900
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox129" value="1" <?php if ($check_res['checkbox129'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>766417
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox130" value="1" <?php if ($check_res['checkbox130'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>764171
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox131" value="1" <?php if ($check_res['checkbox131'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Citalopram
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox132" value="1" <?php if ($check_res['checkbox132'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Klonopin
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox133" value="1" <?php if ($check_res['checkbox133'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Percocat
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox134" value="1" <?php if ($check_res['checkbox134'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Vicoprofen
                           </th>
                          </tr>
                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>Tramadol</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox135" value="1" <?php if ($check_res['checkbox135'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>733740
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox136" value="1" <?php if ($check_res['checkbox136'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>761018
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox137" value="1" <?php if ($check_res['checkbox137'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>761019
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox138" value="1" <?php if ($check_res['checkbox138'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Clonazepam
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox139" value="1" <?php if ($check_res['checkbox139'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Lexapro
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox140" value="1" <?php if ($check_res['checkbox140'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Phentermine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox141" value="1" <?php if ($check_res['checkbox141'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Voltaren
                           </th>
                          </tr>

                          <tr>
                            <th style="border:1px solid black;border-collapse:collapse;">
                             <b>LabCorp medwatch*report</b>
                            </th>
                        <th style="border:1px solid black;border-collapse:collapse;">
                             
                          </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox142" value="1" <?php if ($check_res['checkbox142'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>733346
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox143" value="1" <?php if ($check_res['checkbox143'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>733346
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox144" value="1" <?php if ($check_res['checkbox144'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Cyclobenzaprine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox145"b value="1" <?php if ($check_res['checkbox145'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Lidocaine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox146" value="1" <?php if ($check_res['checkbox146'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Pregabalin
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox147" value="1" <?php if ($check_res['checkbox147'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Vyvanse
                           </th>
                          </tr>
                          <tr>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox148" value="1" <?php if ($check_res['checkbox148'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Cymbalta
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox149" value="1" <?php if ($check_res['checkbox149'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Lidoderm
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox150" value="1" <?php if ($check_res['checkbox150'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Promethazine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox151" value="1" <?php if ($check_res['checkbox151'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>wellbutrin
                           </th>
                          </tr>

                          <tr>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox152" value="1" <?php if ($check_res['checkbox152'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Desyrel
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox153" value="1" <?php if ($check_res['checkbox153'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Lorazepam
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox154" value="1" <?php if ($check_res['checkbox154'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Prozac
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox155" value="1" <?php if ($check_res['checkbox155'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Xanax
                           </th>
                          </tr>

                          <tr>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox156" value="1" <?php if ($check_res['checkbox156'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Diazepam
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox157" value="1" <?php if ($check_res['checkbox157'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Lorcet
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox158" value="1" <?php if ($check_res['checkbox158'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Quetiapine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox159" value="1" <?php if ($check_res['checkbox159'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Zanaflex
                           </th>
                          </tr>

                          <tr>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox160" value="1" <?php if ($check_res['checkbox160'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Dilaudid
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox161" value="1" <?php if ($check_res['checkbox161'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Lortab
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox162" value="1" <?php if ($check_res['checkbox162'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Restoril
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox163" value="1" <?php if ($check_res['checkbox163'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Zohydro
                           </th>
                          </tr>
                          <tr>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox164" value="1" <?php if ($check_res['checkbox164'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Duloxetine
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox165" value="1" <?php if ($check_res['checkbox165'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Lunesta
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox166" value="1" <?php if ($check_res['checkbox166'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Ritalin
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox167" value="1" <?php if ($check_res['checkbox167'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Zoloft
                           </th>
                          </tr>
                          <tr>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox168" value="1" <?php if ($check_res['checkbox168'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Duragesic
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                               <input type="checkbox"  name="checkbox169" value="1" <?php if ($check_res['checkbox169'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Lyrica
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox170" value="1" <?php if ($check_res['checkbox170'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Roxicodone
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox171" value="1" <?php if ($check_res['checkbox171'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Zolpidem
                           </th>
                          </tr>
                          <tr>
                              <th style="border:1px solid black;border-collapse:collapse;">
                              <input type="checkbox"  name="checkbox172" value="1" <?php if ($check_res['checkbox172'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Other test Order:  <?php echo($check_res['test39']);?> 
                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                              <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox173" value="1" <?php if ($check_res['checkbox173'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Patient has no medication use declared and none prescribed
                           </th>
                           
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox174" value="1" <?php if ($check_res['checkbox174'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>A separate medication list is attached
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">
                             <input type="checkbox"  name="checkbox175" value="1" <?php if ($check_res['checkbox175'] == "1") { echo "checked='checked'";}else{
      echo '';
    }?>>Other medications
                           </th>
                           <th style="border:1px solid black;border-collapse:collapse;">

                              </th>
                          </tr>
               </table>
   <br/><br/>
   <table class="table table-bordered" style="width: 100%;">
                <tr >
                  <td>
                  <label><b>Patient Name:</b>
      <?php echo text($check_res['input40']); ?><br/>
      <b>Date:</b>
       <?php echo text($check_res['input41']); ?> </label>
                  </td>
                </tr>
               </table>
    



<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Reason Form");
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($body);
$mpdf->defaultfooterline = 0;
//         //save the file put which location you need folder/filname
// $checkid = sqlQuery("SELECT formid FROM pdf_directory WHERE formid=?", array($formid));
// if($checkid['formid'] != $formid){
//     $pdf_data = sqlInsert('INSERT INTO pdf_directory (path,pid,encounter,formid) VALUES (?,?,?,?)',array($filename,$_SESSION["pid"],$_SESSION["encounter"],$formid));
// }

$mpdf->Output('test.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();