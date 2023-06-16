<?php
/**
 * assessment_intake new.php.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

header('Access-Control-Allow-Origin: *');
$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

formHeader("Form: assessment_intake");

$pid              = 0+(isset($_GET['pid']) ? $_GET['pid']:0);

$patient_id_check =  sqlQuery("SELECT * FROM patient_data WHERE pid = ?", array($pid));
if($patient_id_check!=''){
    $result          = sqlQuery("SELECT * FROM form_assessment_intake WHERE pid = ?", array($pid));
    $formid          = ($result['id']!='' ? $result['id'] :0);
    //echo $formid;
    if($formid!=0)
    {
        $check_res = sqlQuery("SELECT * FROM form_assessment_intake WHERE id = ?", array($formid ));
    }
    else{
        $check_res = array();
    }   
}
else{
    header("Location: http://" . $_SERVER['HTTP_HOST']."/networkTherapy/openemr/");
}

?>

<html><head>
    <?php Header::setupHeader(); ?>
</head>

<body class="body_top">


<?php $res    = sqlStatement("SELECT * FROM patient_data WHERE pid = ?", array($pid));
$result       = SqlFetchArray($res);
$yesr_in_date = explode('-',$result['DOB']);
$today        = date('Y');
$age          = '';
if($yesr_in_date[0]!='0000')
{
    $age      = $today-$yesr_in_date[0];
} 

?>
<span class="title"><center><u><?php echo xlt('PATIENT INFORMATION'); ?></u></center></span><br /><br />
<b>Name:</b>&nbsp; <?php echo text($result['fname']) . '&nbsp' . text($result['mname']) . '&nbsp;' . text($result['lname']);?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <?php echo text($result['DOB']);?><br><br>
<b>Address:</b>&nbsp; <?php echo text($result['street']);?></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="172" height="1">
<label><b>City:</b>&nbsp; <?php echo text($result['city']);?></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="125" height="1">
<label><b>State/Zip:</b>&nbsp; <?php echo text($result['state']);?></label><br><br>
<b>Telephone Number:</b>&nbsp;  <?php echo text($result['phone_home']);?><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="400" height="1">
<b>E-Mail:</b>&nbsp;<?php echo text($result['email']);?><br><br>
<label><b>SSN:</b>&nbsp;<?php echo text($result['ss']);?></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="65" height="1">
<label><b>Sex:</b>&nbsp;<?php echo text($result['sex']);?></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="65" height="1">
<label><b>Age:</b>&nbsp;<?php echo text($age);?></label>
<label><b>Marital Status:</b>&nbsp;<?php echo text($result['status']);?></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="65" height="1">
<label><b>Race:</b>&nbsp;<?php echo text($result['race']);?></label><br><br>
<label><b>Emergency Contact 1:</b>&nbsp;<?php echo text($result['guardians1name']);?></label>
<label><b>Relationship:</b>&nbsp;<?php echo text($result['guardian1relationship']);?></label>
<label><b>Tel:</b>&nbsp; <?php echo text($result['guardian1phone']);?></label><br><br>
<label><b>Emergency Contact 2:</b>&nbsp;<?php echo text($result['guardian2name']);?></label>
<label><b>Relationship:</b>&nbsp;<?php echo text($result['guardian2relationship']);?></label>
<label><b>Tel:</b>&nbsp;<?php echo text($result['guardian2phone']);?><br><br>
<?php
$insurencer_data =  sqlQuery("SELECT * FROM insurance_data WHERE pid = ?", array($pid));
?>
<p>I grant CNT permission to contact me in writing at the address provided above, orally and by voicemails through the
telephone number(s) provided above and share information with the above people in case of an emergency.
</p>
<p>Additionally, I understand it is my responsibility to keep CNT abreast of changes to the above contact information.</p>
<label><b>Initial</b>&nbsp;<?php echo text($result['initial']); ?></label><br><br>
<span class="title"><center><u><?php echo xlt('PATIENT INSURANCE INFORMATION'); ?></u></center></span><br /><br />
<label><b>Insurance Carrier:</b>&nbsp;<?php echo text($insurencer_data['plan_name']); ?></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="65" height="1">
<label><b>Contact #:</b>&nbsp;<?php echo text($insurencer_data['subscriber_phone']); ?></label><br><br>
<label><b>Insurance Subscriber’s Name:</b>&nbsp;<?php echo text($insurencer_data['subscriber_fname'].' '.$insurencer_data['subscriber_mname'].' ' .$insurencer_data['subscriber_lname']); ?></label>
<label><b>DOB:</b>&nbsp;<?php echo text($insurencer_data['subscriber_DOB']); ?></label>
<label><b>Relationship to Patient:</b>&nbsp;<?php echo text($insurencer_data['subscriber_relationship']); ?></label><br>
<p style='font: italian;'>* (if different from client, this section must be filled out)</p>
<label><b>Insured Person’s ID #:</b>&nbsp;<?php echo text($insurencer_data['pid']); ?></label>
<label><b>Insured Person’s Tel #:</b>&nbsp;<?php echo text($insurencer_data['subscriber_phone']); ?></label><br><br>
<label><b>Client’s ID #:</b>&nbsp;<?php echo text($insurencer_data['pid']); ?></label>
<label><b>Group #:</b>&nbsp;<?php echo text($insurencer_data['group_number']); ?></label><br>
<p># I agree to let Center for Network Therapy share treatment and other information with my insurance company in
order to obtain pre-authorization for treatment, payment, and other purposes.<br><b>Signature #:</b>&nbsp;<?php echo text($insurencer_data['subscriber_fname']); ?></p>



<form method=post action="save.php?pid=<?php echo $_GET['pid']?>&id=<?php echo $formid;?>" name="my_form" id="my_pat_form">

<!-- <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" /> -->
<br>
<span class="title"><center><u><?php echo xlt('DRUG TESTING RELEASE FORM'); ?></u></center></span><br /><br />

<p><b>*</b> I understand that the urine sample that has been requested may be tested for drugs of abuse, but not for physical </p><p>
conditions. I agree to allow such testing. I understand the provisions of the pre-placement drug screening policy.</p>

<p><b>*</b> Listed below are my medication(s), prescriptions, and over-the-counter medications such as cold medicine,</p><p>
Tylenol, Ibuprofen, etc., that I have taken over the last 30 days.</p>

<p><b>*</b> I fully understand that if I continue to use substances of abuse, CNT may re-evaluate my case for appropriate
referral.
</p>
<label><b>Applicant Name:</b>&nbsp;<input type="text" name="appname" value="<?php echo text($check_res['appname'] ?? ''); ?>"></label>

<label><b>Applicant Signature:</b>&nbsp;<input type="text" name="appsign" value="<?php echo text($check_res['appsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" name="appdate" class="datepicker"   value="<?php echo text($check_res['appdate'] ? strstr($check_res['appdate'], ' ', true):''); ?>"></label><br><br>
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;<input type="text" name="par_sign" value="<?php echo text($check_res['par_sign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="par_date"  value="<?php echo text($check_res['par_date'] ? strstr($check_res['par_date'], ' ', true):''); ?>"></label><br><br>
<label><b>Witness Name (CNT Employee):</b>&nbsp;<input type="text" name="witname" value="<?php echo text($check_res['witname'] ?? ''); ?>"></label>
<label><b>Witness Signature:</b>&nbsp;<input type="text" name="witsign" value="<?php echo text($check_res['witsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="witdate" value="<?php echo text($check_res['witdate'] ?strstr($check_res['witdate'], ' ', true): ''); ?>"></label><br><br>

<span class="title"><center><u><?php echo xlt('VIDEO SURVEILLANCE POLICY'); ?></u></center></span><br />
<span class="title"><center><?php echo xlt('Acknowledgement, Consent, and Release'); ?></center></span><br /><br />
<p>I acknowledge that I have received a copy of CENTER FOR NETWORK THERAPY’s Orientation
Manual and Client Rights, that I have been given the opportunity to read and ask any questions that I
might have, and that by signing this acknowledgement, I agree to adhere to the policies as a condition
of my admission into the CENTER FOR NETWORK THERAPY. I understand and agree that in
acknowledging and signing this form, I am agreeing to being video taped through company
surveillance cameras located throughout the facility.</p>

<p>In accordance with Center for Network Therapy policy regarding searches, I understand that all bags
and personal belongings brought into CENTER FOR NETWORK THERAPY are subject to search at
any time without my knowledge, presence, or permission. With the exception of my personal vehicle, I
understand I am prohibited from locking or otherwise securing any such personal item. In the event
that a search of my personal vehicle becomes necessary, I agree to allow personnel designated by
CENTER FOR NETWORK THERAPY to conduct such a search at any time the company may direct
while I am a client at the CENTER FOR NETWORK THERAPY.</p>

<p>I further understand that in order to promote the safety of employees and Patient’s, as well as the
security of its facilities, CENTER FOR NETWORK THERAPY may conduct video surveillance of any
portion of its premises at any time, the only exception being private areas of restrooms, and that video
cameras will be positioned in appropriate places within and around CENTER FOR NETWORK
THERAPY buildings and used in order to help promote the safety and security of people and property.
I hereby give my consent to such video surveillance at any time the company may choose.
</p>

<p>I hereby release CENTER FOR NETWORK THERAPY from all liability, including liability for
negligence, associated with the enforcement of these policies and/or any searches or surveillance
undertaken pursuant to these policies.
</p>

<label><b>(Client Name)</b>&nbsp;<input type="text" name="ack_name" value="<?php echo text($check_res['ack_name'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="ack_date1" value="<?php echo text($check_res['ack_date1'] ?strstr($check_res['ack_date1'], ' ', true): ''); ?>"></label>
<label><b>Client Name – Signature:</b>&nbsp;<input type="text" name="ack_sign" value="<?php echo text($check_res['ack_sign'] ?? ''); ?>"></label><br><br>
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;<input type="text" name="ack_parsign" value="<?php echo text($check_res['ack_parsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="ack_date2" value="<?php echo text($check_res['ack_date2'] ?strstr($check_res['ack_date2'], ' ', true): ''); ?>"></label><br><br>
<label><b>(Witness)</b>&nbsp;<input type="text" name="ack_witname" value="<?php echo text($check_res['ack_witname'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="ack_witdate" value="<?php echo text($check_res['ack_witdate'] ?strstr($check_res['ack_witdate'], ' ', true): ''); ?>"></label><br><br>

<span class="title"><?php echo xlt('Financial Agreement/Payment Policy'); ?></span><br /><br />

<p>Upon admission to the CNT, your insurance company will be contacted to verify benefits and you will be
informed by CNT what your benefits are. You will be asked to sign a financial agreement describing what
your financial responsibilities are.</p>

<p>Clients who use their health insurance benefits to cover sessions at the CNT should remember that when
these professional services are rendered, we would submit a claim to your insurance company; however,
you are responsible for the co-pay and fees your insurance company does not cover.</p>

<p>Insured clients are expected to remit payment for their fees as services are rendered, unless other
arrangements are made in advance and in writing with the CNT. The CNT is required by law to collect
insurance co-pays. Even though an insurance claim is filed, the client is responsible for any balance due or
any non-payment by the insurance carrier. CNT is not responsible for collecting your insurance claim or for
negotiating a settlement on a disputed claim. You are responsible for payment of your account.</p>

<p>Once an insurance claim is filed, we will attempt to collect the balance due for 90 days. If we are not
reimbursed for the services rendered within that time frame, you will be held responsible and will be
expected to pay the amount due in full. In addition, you are responsible for informing CNT of any changes
in your insurance coverage, such as the need for pre-certification. If you do not inform us, and claims are
denied as a result, you will be held responsible for the full amount due.</p>

<p>If your visits to CNT are not covered by insurance, and you are a self pay client, you will be expected to
make payments weekly. Each agreement is based upon individual situations. If you fail to remit timely
payment upon receipt of your statement, CNT will no longer be able to provide additional services until
payment is made in full. In addition you will be responsible for all costs incurred by CNT to collect the
amounts due including interest at the rate of the lessor of (1) 1.5% per month, or (2) the maximum rate
allowed by law, as well as reasonable attorneys fees and costs incurred.</p>

<p>Clients whose account balances exceed $350 will be required to make a payment arrangement so that the
balance can be paid down. Account balances that are outstanding for over 90 days may be forwarded to a
collection agency. Payment is accepted by credit/debit card, check, money order, or cash. If a check is
returned due to insufficient funds, a $35 fee, in addition to any bank fee, will be charged. In addition,
payment will then only be accepted by cash or money order.</p>

<p>Copies of records are charged at $1.00 per page for the first 100 pages and $0.25/page thereafter; for a maximum of $200. This
will also be based on ability to pay.</p>

<p>For your reference, our current fees for self pay are as follows (these are subject to change):</p>

<p><b>*</b> Bio-Psycho-Social Cultural Substance Abuse Evaluation: $300 (drug test additional $50 fee)</p>

<p><b>*</b> Individual/Family Sessions: $150; Outpatient Group: $175/session; Family Group: $125/session; Ambulatory Detox:
$550/day. Partial Care: $350/day.</p>

<p><b>*</b> Seven to Ten working days notice needs to be provided to CNT to complete request.
I have received a copy of this financial policy and agree to the above terms.
</p>

<label><b>Client Signature: </b>&nbsp;<input type="text" name="fin_clisign" value="<?php echo text($check_res['fin_clisign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="fin_date1" value="<?php echo text($check_res['fin_date1'] ?strstr($check_res['fin_date1'], ' ', true): ''); ?>"></label><br><br>
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;<input type="text" name="fin_parsign" value="<?php echo text($check_res['fin_parsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="fin_date2" value="<?php echo text($check_res['fin_date2'] ?strstr($check_res['fin_date2'], ' ', true): ''); ?>"></label><br><br>

<span class="title"><?php echo xlt('Consent to Obtain/Release Information (Inpatient Treatment Facilities)'); ?></span><br /><br />

<b>Client Name:</b>&nbsp; <?php echo text($result['fname']) . '&nbsp' . text($result['mname']) . '&nbsp;' . text($result['lname']);?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <input type="text" class="datepicker" name="con_dob" value="<?php echo text($check_res['con_dob'] ?strstr($check_res['con_dob'], ' ', true):''); ?>"><br><br>

<p>I authorize the Center for Network Therapy staff to correspond with the following in coordination
with treatment recommendations:</p>

<p style='font-style: italic;'>Seabrook House &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Summit Oaks Hospital<br>
 101 Madison Ave #205, Morristown, NJ 07960 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;19 Prospect St., Summit, NJ 07901<br>
 (973) 946-8200 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(908) 522-7000<br></p>

 <p style='font-style: italic;'>Carrier Clinic Princeton &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Princeton House Behavioral Health<br>
 252 Co Rd 601, Belle Mead, NJ 08502 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 905 Herrontown Rd, Princeton, NJ 08450<br>
 1-(800) 933-3579 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1-(800) 242-2550<br></p>


<p>To OBTAIN and/or RELEASE the following information:</p>
<p>Please <b><u>INTIAL</u></b> where applicable:</p>

    <input type=checkbox name='in1' class="check-pat" <?php echo(($check_res['in1']&& $check_res['in1']==1) ?'checked':''); ?>>&nbsp;Psychological Evaluation
    <input type="hidden" name='in1' id="in1" value="0" >

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
    <input type=checkbox name='in2' class="check-pat" <?php echo(($check_res['in2']&& $check_res['in2']==1) ?'checked':''); ?> >&nbsp;Psychiatric/Psychological Records<br>
    <input type="hidden" name='in2' id='in2' value="0" >

    <input type=checkbox name='in3'  class="check-pat" <?php echo(($check_res['in3']&& $check_res['in3']==1) ?'checked':''); ?>>&nbsp;Intake/Admission Summary
    <input type="hidden" name='in3' id='in3' value="0" >

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="31" height="1">
    <input type=checkbox name='in4' class="check-pat" <?php echo(($check_res['in4']&& $check_res['in4']==1) ?'checked':''); ?> >&nbsp;Treatment Plans/Recommendations<br>
    <input type="hidden" name='in4' id='in4' value="0">

    <input type=checkbox name='in5' class="check-pat" <?php echo(($check_res['in5']&& $check_res['in5']==1) ?'checked':''); ?> >&nbsp;Treatment Progress
    <input type="hidden" name='in5' id="in5" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="81" height="1">
    <input type=checkbox name='in6' class="check-pat" <?php echo(($check_res['in6']&& $check_res['in6']==1) ?'checked':''); ?> >&nbsp;Closing/Discharge Summary<br>
    <input type="hidden" name='in6' id="in6" value="0">

    <input type=checkbox name='in7' class="check-pat" <?php echo(($check_res['in7']&& $check_res['in7']==1) ?'checked':''); ?>  >&nbsp;Probation/Parole Records
    <input type="hidden" name='in7' id="in7" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="43" height="1">
    <input type=checkbox name='in8' class="check-pat" <?php echo(($check_res['in8']&& $check_res['in8']==1) ?'checked':''); ?>  >&nbsp;Medical Records<br>
    <input type="hidden" name='in8' id="in8" value="0">

    <input type=checkbox name='in9' class="check-pat" <?php echo(($check_res['in9']&& $check_res['in9']==1) ?'checked':''); ?>>&nbsp;Urine Drug Screen Results
    <input type="hidden" name='in9' id="in9" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="40" height="1">
    <input type=checkbox name='in10' class="check-pat" <?php echo(($check_res['in10']&& $check_res['in10']==1) ?'checked':''); ?> >&nbsp;Other<br><br>
    <input type="hidden" name='in10' id="in10" value="0">

<p>For the purpose of <b><u>COLLABORATION</u></b>.</p>

<p>I voluntarily choose to sign below for the purpose(s) specified above. <b><u>This release will expire in 1
year date signed unless otherwise specified</u></b>. I further understand that I may cancel authorization
for release of information at any time unless the information has already been sent.</p>

<label><b>Client Signature: </b>&nbsp;<input type="text" name="in_clisign" value="<?php echo text($check_res['in_clisign'] ?? ''); ?>" ></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="in_date1" value="<?php echo text($check_res['in_date1'] ?strstr($check_res['in_date1'], ' ', true): ''); ?>"></label><br><br>
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;<input type="text" name="in_parsign" value="<?php echo text($check_res['in_parsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="in_date2" value="<?php echo text($check_res['in_date2'] ?strstr($check_res['in_date2'], ' ', true): ''); ?>"></label><br><br>
<label><b>Witness Signature:</b>&nbsp;<input type="text" name="in_witsign" value="<?php echo text($check_res['in_witsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="in_date3" value="<?php echo text($check_res['in_date3'] ?strstr($check_res['in_date3'], ' ', true): ''); ?>"></label><br><br>

<span class="title"><center><?php echo xlt('Consent to Obtain/Release Information from client’s'); ?></center></span>
<span class="title"><center><u><?php echo xlt('Primary Care Physician or most recent hospitalization'); ?></u></center></span><br /><br />

<b>Client Name:</b>&nbsp; <?php echo text($result['fname']) . '&nbsp' . text($result['mname']) . '&nbsp;' . text($result['lname']);?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <input type="text" class="datepicker" name="pri_dob" value="<?php echo text($check_res['pri_dob'] ?strstr($check_res['pri_dob'], ' ', true): ''); ?>"><br><br>

<p><b>I authorize The Center for Network Therapy staff to correspond with:</b></p>
<label><b>Physician/Hospital Name:</b>&nbsp;<input type="text" name="pri_hosp" value="<?php echo text($check_res['pri_hosp'] ?? ''); ?>"></label><br>
<b>Address: Street:</b>&nbsp;<input type="text" name="pri_addr" value="<?php echo text($check_res['pri_addr'] ?? ''); ?>"><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>City:</b>&nbsp;<input type="text" name="pri_city" value="<?php echo text($check_res['pri_city'] ?? ''); ?>"></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>State</b>&nbsp;<input type="text" name="pri_state" value="<?php echo text($check_res['pri_state'] ?? ''); ?>"></label>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>Zip</b>&nbsp;<input type="text" name="pri_zip" value="<?php echo text($check_res['pri_zip'] ?? ''); ?>"></label><br><br>
<label><b>Phone#:</b>&nbsp;<input type="text" name="pri_phone" value="<?php echo text($check_res['pri_phone'] ?? ''); ?>"></label><br><br>
<label><b>Fax#:</b>&nbsp;<input type="text" name="pri_fax" value="<?php echo text($check_res['pri_fax'] ?? ''); ?>"></label><br><br>

<p>To OBTAIN and/or RELEASE the following information:</p>
<p>Please <b><u>INTIAL</u></b> where applicable:</p>

    <input type=checkbox name='recent_labs' class="check-pat" <?php echo(($check_res['recent_labs']&& $check_res['recent_labs']==1) ?'checked':''); ?>  >&nbsp;Most recent labs
    <input type="hidden" name="recent_labs" id="recent_labs" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
    <input type=checkbox name='recent_physical' class="check-pat" <?php echo(($check_res['recent_physical']&& $check_res['recent_physical']==1) ?'checked':''); ?>  >&nbsp;Most recent physical
    <input type="hidden" name="recent_physical" id="recent_physical" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
    <input type=checkbox name='dx_history' class="check-pat" <?php echo(($check_res['dx_history']&& $check_res['dx_history']==1) ?'checked':''); ?> >&nbsp;Dx history
    <input type="hidden" name="dx_history" id="dx_history" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="31" height="1">
    <input type=checkbox name='medication_list' class="check-pat" <?php echo(($check_res['medication_list']&& $check_res['medication_list']==1) ?'checked':''); ?>  >&nbsp;Current medication list<br>
    <input type="hidden" name="medication_list" id="medication_list" value="0">

<p>I understand that my record may contain information on HIV/AIDS and/or alcohol and drugs. I am also
giving consent for this information to be released:</p>
<p>** Please initial where appropriate:

    <input type=checkbox name='yes' class="check-pat" <?php echo(($check_res['yes']&& $check_res['yes']==1) ?'checked':''); ?>  >&nbsp;YES
    <input type="hidden" name="yes" id="yes" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
    <input type=checkbox name='no' class="check-pat" <?php echo(($check_res['no']&& $check_res['no']==1) ?'checked':''); ?>  >&nbsp;NO
    <inpu type="hidden" name="no" id="no" value="0">
</p>
<p><b>FEDERAL REGULATIONS (CFR 42, PART 2)</b> prohibits any further release of this
information to other parties. I understand that this release will remain in effect for 90 days from
date signed below unless revoked in writing.</p>

<label><b>Client Signature: </b>&nbsp;<input type="text" name="pri_clisign" value="<?php echo text($check_res['pri_clisign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="pri_date1" value="<?php echo text($check_res['pri_date1'] ?strstr($check_res['pri_date1'], ' ', true): ''); ?>"></label><br><br>
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;<input type="text" name="pri_parsign" value="<?php echo text($check_res['witsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="pri_date2" value="<?php echo text($check_res['pri_date2'] ?strstr($check_res['pri_date2'], ' ', true): ''); ?>"></label><br><br>
<label><b>Witness Signature:</b>&nbsp;<input type="text" name="pri_witsign" value="<?php echo text($check_res['pri_witsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="pri_date3" value="<?php echo text($check_res['pri_date3'] ?strstr($check_res['pri_date3'], ' ', true): ''); ?>"></label><br><br>


<span class="title"><center><?php echo xlt('Consent to Obtain/Release Information from Client’s Pharmacy '); ?></center></span><br>

<b>Client Name:</b>&nbsp; <?php echo text($result['fname']) . '&nbsp' . text($result['mname']) . '&nbsp;' . text($result['lname']);?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <input type="text" class="datepicker" name="pha_dob" value="<?php echo text($check_res['pha_dob'] ?strstr($check_res['witdate'], ' ', true): ''); ?>"><br><br>

<p><b>I authorize The Center for Network Therapy staff to correspond with:</b></p>
<label><b>Pharmacy Name:</b>&nbsp;<input type="text" name="pha_hosp" value="<?php echo text($check_res['pha_hosp'] ?? ''); ?>"></label><br>
<b>Address: Street:</b>&nbsp;<input type="text" name="pha_addr" value="<?php echo text($check_res['pha_addr'] ?? ''); ?>"><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>City:</b>&nbsp;<input type="text" name="pha_city" value="<?php echo text($check_res['pha_city'] ?? ''); ?>"></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>State</b>&nbsp;<input type="text" name="pha_state" value="<?php echo text($check_res['pha_state'] ?? ''); ?>"></label>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>Zip</b>&nbsp;<input type="text" name="pha_zip" value="<?php echo text($check_res['pha_zip'] ?? ''); ?>"></label><br><br>
<label><b>Phone#:</b>&nbsp;<input type="text" name="pha_phone" value="<?php echo text($check_res['pha_phone'] ?? ''); ?>"></label><br><br>
<label><b>Fax#:</b>&nbsp;<input type="text" name="pha_fax" value="<?php echo text($check_res['pha_fax'] ?? ''); ?>"></label><br><br>

<label><b>Client Signature: </b>&nbsp;<input type="text" name="pha_clisign" value="<?php echo text($check_res['pha_clisign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="pha_date1" value="<?php echo text($check_res['pha_date1'] ?strstr($check_res['pha_date1'], ' ', true): ''); ?>"></label><br><br>
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;<input type="text" name="pha_parsign" value="<?php echo text($check_res['pha_parsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="pha_date2" value="<?php echo text($check_res['pha_date2'] ?strstr($check_res['pha_date2'], ' ', true): ''); ?>"></label><br><br>
<label><b>Witness Signature:</b>&nbsp;<input type="text" name="pha_witsign" value="<?php echo text($check_res['pha_witsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="pha_date3" value="<?php echo text($check_res['pha_date3'] ?strstr($check_res['pha_date3'], ' ', true): ''); ?>"></label><br><br>



<span class="title"><center><b>Consent to Obtain/Release Information</b> (Family, Supportive Individuals, etc.)</center></span><br>

<b>Client Name:</b>&nbsp; <?php echo text($result['fname']) . '&nbsp' . text($result['mname']) . '&nbsp;' . text($result['lname']);?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <input type="text" class="datepicker" name="fam_dob" value="<?php echo text($check_res['fam_dob'] ?strstr($check_res['fam_dob'], ' ', true): ''); ?>"><br><br>

<p><b>I authorize The Center for Network Therapy staff to correspond with:</b></p>
<label><b>Person:</b>&nbsp;<input type="text" name="fam_person" value="<?php echo text($check_res['fam_person'] ?? ''); ?>"></label><label><b>(Relationship)</b>&nbsp;<input type="text" name="fam_rel"></label><br>
<b>Address: Street:</b>&nbsp;<input type="text" name="fam_addr" value="<?php echo text($check_res['fam_addr'] ?? ''); ?>"><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>City:</b>&nbsp;<input type="text" name="fam_city" value="<?php echo text($check_res['fam_city'] ?? ''); ?>"></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>State</b>&nbsp;<input type="text" name="fam_state" value="<?php echo text($check_res['fam_state'] ?? ''); ?>"></label>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>Zip</b>&nbsp;<input type="text" name="fam_zip" value="<?php echo text($check_res['fam_zip'] ?? ''); ?>"></label><br><br>
<label><b>Phone#:</b>&nbsp;<input type="text" name="fam_phone" value="<?php echo text($check_res['fam_phone'] ?? ''); ?>"></label><br><br>


<p>To OBTAIN and/or RELEASE the following information:</p>
<p>Please <b><u>INTIAL</u></b> where applicable:</p>
    <input type=checkbox name='fam1' class="check-pat" <?php echo(($check_res['fam1']&& $check_res['fam1']==1) ?'checked':''); ?>  >&nbsp;Psychological Evaluation
    <input type="hidden" name="fam1" id="fam1" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
    <input type=checkbox name='fam2' class="check-pat" <?php echo(($check_res['fam2']&& $check_res['fam2']==1) ?'checked':''); ?>  >&nbsp;Psychiatric/Psychological Records<br>
    <input type="hidden" name="fam2" id="fam2" value="0">

    <input type=checkbox name='fam3' class="check-pat" <?php echo(($check_res['fam3']&& $check_res['fam3']==1) ?'checked':''); ?> >&nbsp;Intake/Admission Summary
    <input type="hidden" name="fam3" id="fam3" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="31" height="1">
    <input type=checkbox name='fam4'class="check-pat" <?php echo(($check_res['fam4']&& $check_res['fam4']==1) ?'checked':''); ?>  >&nbsp;Treatment Plans/Recommendations<br>
    <input type="hidden" name="fam4" id="fam4" value="0">

    <input type=checkbox name='fam5' class="check-pat" <?php echo(($check_res['fam5']&& $check_res['fam5']==1) ?'checked':''); ?>  >&nbsp;Treatment Progress
    <input type="hidden" name="fam5" id="fam5" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="81" height="1">
    <input type=checkbox name='fam6' class="check-pat" <?php echo(($check_res['fam6']&& $check_res['fam6']==1) ?'checked':''); ?> >&nbsp;Closing/Discharge Summary<br>
    <input type="hidden" name="fam6" id="fam6" value="0">

    <input type=checkbox name='fam7' class="check-pat" <?php echo(($check_res['fam7']&& $check_res['fam7']==1) ?'checked':''); ?>  >&nbsp;Probation/Parole Records
    <input type="hidden" name="fam7" id="fam7" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="43" height="1">
    <input type=checkbox name='fam8' class="check-pat" <?php echo(($check_res['fam8']&& $check_res['fam8']==1) ?'checked':''); ?>  >&nbsp;Medical Records<br>
    <input type="hidden" name="fam8" id="fam8" value="0">

    <input type=checkbox name='fam9' class="check-pat" <?php echo(($check_res['fam9']&& $check_res['fam9']==1) ?'checked':''); ?>  >&nbsp;Urine Drug Screen Results
    <input type="hidden" name="fam9" id="fam9" value="0">

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="40" height="1">
    <input type=checkbox name='fam10' class="check-pat" <?php echo(($check_res['fam10']&& $check_res['fam10']==1) ?'checked':''); ?>  >&nbsp;Other<br><br>
    <input type="hidden" name="fam10" id="fam10" value="0">

<p>For the purpose of <b><u>COLLABORATION</u></b>.</p>

<p>I voluntarily choose to sign below for the purpose(s) specified above. <b><u>This release will expire in 1
year date signed unless otherwise specified</u></b>. I further understand that I may cancel authorization
for release of information at any time unless the information has already been sent.</p>

<label><b>Client Signature: </b>&nbsp;<input type="text" name="fam_clisign" value="<?php echo text($check_res['fam_clisign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="fam_date1" value="<?php echo text($check_res['fam_date1'] ?strstr($check_res['fam_date1'], ' ', true): ''); ?>"></label><br><br>
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;<input type="text" name="fam_parsign" value="<?php echo text($check_res['fam_parsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="fam_date2" value="<?php echo text($check_res['fam_date2'] ?strstr($check_res['fam_date2'], ' ', true): ''); ?>"></label><br><br>
<label><b>Witness Signature:</b>&nbsp;<input type="text" name="fam_witsign" value="<?php echo text($check_res['fam_witsign'] ?? ''); ?>"></label>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="fam_date3" value="<?php echo text($check_res['fam_date3'] ?strstr($check_res['fam_date3'], ' ', true): ''); ?>"></label><br><br>

<span class="title"><center><u>Symptom Assessment for Pulmonary Tuberculosis (TB)</u></center></span><br>

<b>Client Name:</b>&nbsp; <?php echo text($result['fname']) . '&nbsp' . text($result['mname']) . '&nbsp;' . text($result['lname']);?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <input type="text" class="datepicker" name="tb_dob" value="<?php echo text($check_res['tb_dob'] ?strstr($check_res['tb_dob'], ' ', true): ''); ?>"><br><br>
<label><b>Date:</b>&nbsp;<input type="text" class="datepicker" name="tb_date" value="<?php echo text($check_res['tb_date'] ?strstr($check_res['tb_date'], ' ', true): ''); ?>"></label><br><br>
<label><b>Definition:</b>
Tuberculosis is a highly contagious bacteria, Mycobacterium tuberculosis,
transmitted by air droplets from person to person that may cause fever, sweats, blood sputum
cough, weight loss, fatigue and chest pain that may cause chronic liver, kidney and lung
problems.
</label>

<label><b>TB-Like Symptoms (Check all that apply):</b></label><br>

<input type=checkbox name='tb1' class="check-pat" <?php echo(($check_res['tb1']&& $check_res['tb1']==1) ?'checked':''); ?>  >&nbsp;Productive Cough Of Undiagnosed Cause (more than 3 weeks in duration)<br>
<input type="hidden" name="tb1" id="tb1" value="0">

<input type=checkbox name='tb2' class="check-pat" <?php echo(($check_res['tb2']&& $check_res['tb2']==1) ?'checked':''); ?> >&nbsp;Coughing up blood (Hemoptysis)<br>
<input type="hidden" name="tb2" id="tb2" value="0">

<input type=checkbox name='tb3' class="check-pat"<?php echo(($check_res['tb3']&& $check_res['tb3']==1) ?'checked':''); ?> >&nbsp;Unexplained Weight Loss (10 pounds or greater without dieting)<br>
<input type="hidden" name="tb3" id="tb3" value="0">

<input type=checkbox name='tb4'  class="check-pat"<?php echo(($check_res['tb4']&& $check_res['tb4']==1) ?'checked':''); ?>>&nbsp;Night Sweats (regarding of room temperature)<br>
<input type="hidden" name="tb4" id="tb4" value="0">

<input type=checkbox name='tb5'  class="check-pat"<?php echo(($check_res['tb5']&& $check_res['tb5']==1) ?'checked':''); ?>  >&nbsp;Unexplained Loss of Appetite<br>
<input type="hidden" name="tb5" id="tb5" value="0">

<input type=checkbox name='tb6'  class="check-pat"<?php echo(($check_res['tb6']&& $check_res['tb6']==1) ?'checked':''); ?>  >&nbsp;Very Easily Tired (Fatigability)<br>
<input type="hidden" name="tb6" id="tb6" value="0">

<input type=checkbox name='tb7' class="check-pat" <?php echo(($check_res['in7']&& $check_res['tb7']==1) ?'checked':''); ?> >&nbsp;Fever<br>
<input type="hidden" name="tb7" id="tb7" value="0">

<input type=checkbox name='tb8' class="check-pat"<?php echo(($check_res['tb8']&& $check_res['tb8']==1) ?'checked':''); ?> >&nbsp;Chills<br>
<input type="hidden" name="tb8" id="tb8" value="0">

<input type=checkbox name='tb9' class="check-pat"<?php echo(($check_res['tb9']&& $check_res['tb9']==1) ?'checked':''); ?> >&nbsp; Chest Pain<br>
<input type="hidden" name="tb9" id="tb9" value="0">

<input type=checkbox name='tb10'class="check-pat" <?php echo(($check_res['tb10']&& $check_res['tb10']==1) ?'checked':''); ?> >&nbsp;Close contact with someone with infectious T.B<br>
<input type="hidden" name="tb10" id="tb10" value="0">

<input type=checkbox name='tb11' class="check-pat"<?php echo(($check_res['tb11']&& $check_res['tb11']==1) ?'checked':''); ?>  >&nbsp;Foreign born person outside United States<br>
<input type="hidden" name="tb11" id="tb11" value="0">

<input type=checkbox name='tb12' class="check-pat" <?php echo(($check_res['tb12']&& $check_res['tb12']==1) ?'checked':''); ?> >&nbsp;Traveler to a high prevalent TB country for more then 1 month<br>
<input type="hidden" name="tb12" id="tb12" value="0">

<input type=checkbox name='tb13' class="check-pat" <?php echo(($check_res['tb13']&& $check_res['tb13']==1) ?'checked':''); ?>  >&nbsp;Current, former resident, or employee of correction facility, long term care hospital, hospice, or homeless shelter
<input type="hidden" name="tb13" id="tb13" value="0">

<br><br>

<label><b>Client Signature: </b>&nbsp;<input type="text" name="tb_clisign"></label><br>
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;<input type="text" name="tb_parsign"></label>

<div class="form-group">
    <div class="btn-group" role="group">
       <button type="button"  class="btn btn-primary btn-save"><?php echo xlt('Save'); ?></button>
    </div>
</div>

</form>
<?php
formFooter();
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    $(function(){
        $('.check-pat').each(function(){
            if($(this).is(":checked",true))
            {
                var name = $(this).attr('name'); 
                $('#'+name).val('1');
                $(this).val('1');
            }
            else{
                var name = $(this).attr('name'); 
                $('#'+name).val('0');
                $(this).val('0');
            }
        });

       
            $(".datepicker").datepicker
            ({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-70:+1",
            });
        

    });
    // $('.check-pat').on('click',function(){
    //     if($(this).is(":checked",true))
    //     {
    //         $(this).val('1');
                    
    //     }
    //     else{
    //        $(this).val('0');
    //     }
    // });
    
    $('.btn-save') .on('click',function(){
        
        $('.check-pat').each(function(){
            if($(this).is(":checked",true))
            {
             var name = $(this).attr('name');  
             $('#'+name).val('1');
                $(this).val('1');
            }
            else{
                var name = $(this).attr('name'); 
                $('#'+name).val('0');
                $(this).val('0');
            }
        });
        
        $errocount = 0;
        if($errocount==0)
        {
            $('#my_pat_form').submit();

        }
    });
    $("#sendMail").on('click', function(){
    
    var patient_id  = $("#patient_id").val();
    $.ajax({
       url: 'sendmail_ass.php',
       method: 'POST',
       data: {'patient_id': patient_id},
       beforeSend: function() {
            $('#sendMail').attr("disabled", true);
        },
        success: function(data){
           alert(data);
           $("#sendMail").attr("disabled", false);
           return false;
            //data returned from php
       }
    });
});
 </script>  