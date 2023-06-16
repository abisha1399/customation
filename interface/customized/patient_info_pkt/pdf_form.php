<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/api.inc");
include_once("$srcdir/patient.inc");
//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");




$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$name = $_GET['formname'];
$pid = $_SESSION["pid"];
$encounter = $_GET["encounter"];



$result = SqlQuery("SELECT * FROM patient_data where id=".$pid."");
$check_res= $formid ? formFetch("patient_info_pkt", $formid) : array();
// }else{// $pid=$_SESSION['pid'];
// $check_res = SqlQuery("SELECT * FROM patient_data where id=".$pid."");
// }

    use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>


<style>
    h2{
        text-align:center;
    }
</style>
<body id='body' class='body'>
<?php
ob_start();
?>
<body>

                    <table style="width:100%;" cellpadding="10" cellspacing="0">
                            <tr>
                            <th colspan="3" style="text-align:center;">Center for Network Therapy</th>
                            </tr>
                            <tr>
                                <th style="text-align:center;" colspan="3"><u>PATIENT INFO</u></th>
                        </tr>
                        <tr>
                            <td><b>name:</b><?php echo $check_res['name1']??'';?></td>
                            <td ></td><b>date:</b><?php echo $check_res['dob']??'';?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Address:</b><?php echo $check_res['addr']??'';?> </td>
                            <td><b>city:</b><?php echo $check_res['city']??'';?></td>
                            <td><b>State/Zip :</b><?php echo $check_res['state']??'';?></td>
                        </tr>
                        <tr>
                        <td><b>phone:</b><?php echo $check_res['phone']??'';?></td>
                            <td><b>email :</b><?php echo $check_res['email']??'';?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Social Security # :</b><?php echo $check_res['ssn']??'';?>&nbsp;
                            <b>Sex  :</b><?php echo $check_res['sex']??'';?>&nbsp;
                            <b>Age :</b><?php echo $check_res['age']??'';?>&nbsp;
                            <b>Marital Status :</b><?php echo $check_res['marital']??'';?>&nbsp;
                            <b>Race:</b><?php echo $check_res['race']??'';?> &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><b>Emergency Contact 1: </b><?php echo $check_res['cont1']??'';?></td>
                            <td><b>Relationship:</b><?php echo $check_res['rel1']??'';?></td>
                            <td><b>Tel :</b><?php echo $check_res['tel1']??'';?></td>
                        </tr>
                        <tr>
                            <td><b>Emergency Contact 2: </b><?php echo $check_res['cont2']??'';?> </td>
                            <td><b>Relationship:</b><?php echo $check_res['rel2']??'';?></td>
                            <td><b>Tel :</b><?php echo $check_res['tel2']??'';?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            I grant CNT permission to contact me in writing at the address provided above, orally and by voicemails through the telephone number(s) provided above and share information with the above people in case of an emergency. Additionally, I understand it is my responsibility to keep CNT abreast of changes to the above contact information.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Initial</b> <?php echo $check_res['initial']??'';?>
                            </td>
                        </tr>
                    </table>

                    <br>

                    <table style="width:100%"  cellpadding="10" cellspacing="0">

                                <th style="text-align:center;" colspan="3"><u>PATIENT INSURANCE INFO</u></th>
                        </tr>
                        <tr>
                            <td style="width:50%"><b>Insurance Carrier:</b><?php echo $check_res['ins_car']??'';?></td>
                            <td style="width:50%"><b>Contact #:</b><?php echo $check_res['ins_cont']??'';?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Insurance Subscriber’s Name: </b><?php echo $check_res['ins_subscriber']??'';?>
                            &nbsp;<b>DOB:</b><?php echo $check_res['ins_dob']??'';?>
                            &nbsp;<b>Relationship to Patient: </b><?php echo $check_res['ins_rel']??'';?>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Insured Person’s ID #</b> :<?php echo $check_res['ins_id']??'';?>&nbsp;
                            <b>Insured Person’s Tel #:</b><?php echo $check_res['ins_tel']??'';?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <b>Client’s ID #  :</b><?php echo $check_res['ins_cliid']??'';?>&nbsp;
                           <b> Group #:</b> <?php echo $check_res['ins_grp']??'';?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">
                            <b>*</b>	I agree to let Center for Network Therapy share treatment and other information with my insurance company in order to obtain pre-authorization for treatment, payment, and other purposes.
                            </td>
                        </tr>
                        <tr>
                            <td style="display:flex;">
                            <b>Signature: </b>

                            <?php
                            if($check_res['ins_sign']!=''){
                                echo '<img src='.$check_res['ins_sign'].' style="width:20%;height:40px;" >';
                            }


                            ?>
                        </td>
                        </tr>
                    </table>

                    <br>
                        <span class="title"><center><u><?php echo xlt('DRUG TESTING RELEASE FORM'); ?></u></center></span><br /><br />
                        <?php echo $check_res['text1']?$check_res['text1']:"
                        <p><b>*</b> I understand that the urine sample that has been requested may be tested for drugs of abuse, but not for physical </p><p>
                        conditions. I agree to allow such testing. I understand the provisions of the pre-placement drug screening policy.</p>

                        <p><b>*</b> Listed below are my medication(s), prescriptions, and over-the-counter medications such as cold medicine,</p><p>
                        Tylenol, Ibuprofen, etc., that I have taken over the last 30 days.</p>" ?>
                        <p><?php echo $check_res['medicine']??'';?></p>

                        <p><b>*</b> I fully understand that if I continue to use substances of abuse, CNT may re-evaluate my case for appropriate
                        referral.
                        </p>
                        <label><b>Applicant Name:</b>&nbsp;<?php echo text($check_res['appname'] ?? ''); ?></label>

                        <div style="display:flex;"><b>Applicant Signature:</b>&nbsp;
                        <?php
                            if(check_res['appsign']!=''){
                                echo '<img src='.$check_res['appsign'].' style="width:20%;height:40px;" >';
                            }
                            ?>

                        <label><b>Date:</b>&nbsp;<?php echo text($check_res['appdate'] ? strstr($check_res['appdate'], ' ', true):''); ?></label>
                        </div><br><br>
                        <div style="display:flex;"><b>Parent/Legal Guardian Signature:</b>&nbsp;
                        <?php
                            if(check_res['par_sign']!=''){
                                echo '<img src='.$check_res['par_sign'].' style="width:20%;height:40px;" >';
                            }
                            ?>

                        <label><b>Date:</b>&nbsp;<?php echo text($check_res['par_date'] ? strstr($check_res['par_date'], ' ', true):''); ?></label>
                        </div>
                        <br><br>
                        <label><b>Witness Name (CNT Employee):</b>&nbsp;<?php echo text($check_res['witname'] ?? ''); ?></label>
                        <div style="display:flex;"><b>Witness Signature:</b>&nbsp;
                        <?php
                            if(check_res['witsign']!=''){
                                echo '<img src='.$check_res['witsign'].' style="width:20%;height:40px;" >';
                            }
                            ?>

                        <label><b>Date:</b>&nbsp;<?php echo text($check_res['witdate'] ?strstr($check_res['witdate'], ' ', true): ''); ?></label>
                        </div>


                        <br><br>

<span class="title"><center><u><?php echo xlt('VIDEO SURVEILLANCE POLICY'); ?></u></center></span><br />
<span class="title"><center><?php echo xlt('Acknowledgement, Consent, and Release'); ?></center></span><br /><br />

<?php echo $check_res['text2']?$check_res['text2']:"
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
</p>" ?>

<label><b>(Client Name)</b>&nbsp;<?php echo text($check_res['ack_name'] ?? ''); ?></label>
<label><b>Date:</b>&nbsp;<?php echo text($check_res['ack_date1'] ?strstr($check_res['ack_date1'], ' ', true): ''); ?></label>
<label style="display:flex;"><b>Client Name – Signature:</b>&nbsp;
<?php
    if(check_res['ack_sign']!=''){
        echo '<img src='.$check_res['witsign'].' style="width:20%;height:40px;" >';
    }
    ?>
</label><br><br>
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;<?php echo text($check_res['ack_parsign'] ?? ''); ?></label>
<label><b>Date:</b>&nbsp;<?php echo text($check_res['ack_date2'] ?strstr($check_res['ack_date2'], ' ', true): ''); ?></label><br><br>
<label><b>(Witness)</b>&nbsp;<?php echo text($check_res['ack_witname'] ?? ''); ?></label>
<label><b>Date:</b>&nbsp;<?php echo text($check_res['ack_witdate'] ?strstr($check_res['ack_witdate'], ' ', true): ''); ?></label><br><br>

<span class="title"><?php echo xlt('Financial Agreement/Payment Policy'); ?></span><br /><br />
<?php echo $check_res['text3']?$check_res['text3']:"
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
</p>" ?>

<div style="display:flex"><b>Client Signature: </b>&nbsp;
<?php
    if(check_res['fin_clisign']!=''){
        echo '<img src='.$check_res['fin_clisign'].' style="width:20%;height:40px;" >';
    }
    ?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['fin_date1'] ?strstr($check_res['fin_date1'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex"><b>Parent/Legal Guardian Signature:</b>&nbsp;
<?php
    if(check_res['witsign']!=''){
        echo '<img src='.$check_res['witsign'].' style="width:20%;height:40px;" >';
    }
    ?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['fin_date2'] ?strstr($check_res['fin_date2'], ' ', true): ''); ?></label>
</div>
<br><br>

<span class="title"><?php echo xlt('Consent to Obtain/Release Information (Inpatient Treatment Facilities)'); ?></span><br /><br />

<b>Client Name:</b>&nbsp; <?php echo $check_res['nclient_name1']?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <?php echo text($check_res['con_dob'] ?strstr($check_res['con_dob'], ' ', true):''); ?><br><br>

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

    <input type=checkbox name='in1' class="check-pat" <?php echo(($check_res['in1']&& $check_res['in1']==1) ?'checked=checked':''); ?>>&nbsp;Psychological Evaluation


    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
    <input type=checkbox name='in2' class="check-pat" <?php echo(($check_res['in2']&& $check_res['in2']==1) ?'checked=checked':''); ?> >&nbsp;Psychiatric/Psychological Records<br>

    <input type=checkbox name='in3'  class="check-pat" <?php echo(($check_res['in3']&& $check_res['in3']==1) ?'checked=checked':''); ?>>&nbsp;Intake/Admission Summary


    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="31" height="1">
    <input type=checkbox name='in4' class="check-pat" <?php echo(($check_res['in4']&& $check_res['in4']==1) ?'checked=checked':''); ?> >&nbsp;Treatment Plans/Recommendations<br>


    <input type=checkbox name='in5' class="check-pat" <?php echo(($check_res['in5']&& $check_res['in5']==1) ?'checked=checked':''); ?> >&nbsp;Treatment Progress


    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="81" height="1">
    <input type=checkbox name='in6' class="check-pat" <?php echo(($check_res['in6']&& $check_res['in6']==1) ?'checked=checked':''); ?> >&nbsp;Closing/Discharge Summary<br>


    <input type=checkbox name='in7' class="check-pat" <?php echo(($check_res['in7']&& $check_res['in7']==1) ?'checked=checked':''); ?>  >&nbsp;Probation/Parole Records

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="43" height="1">
    <input type=checkbox name='in8' class="check-pat" <?php echo(($check_res['in8']&& $check_res['in8']==1) ?'checked=checked':''); ?>  >&nbsp;Medical Records<br>

    <input type=checkbox name='in9' class="check-pat" <?php echo(($check_res['in9']&& $check_res['in9']==1) ?'checked=checked':''); ?>>&nbsp;Urine Drug Screen Results


    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="40" height="1">
    <input type=checkbox name='in10' class="check-pat" <?php echo(($check_res['in10']&& $check_res['in10']==1) ?'checked=checked':''); ?> >&nbsp;Other<br><br>


<p>For the purpose of <b><u>COLLABORATION</u></b>.</p>

<p>I voluntarily choose to sign below for the purpose(s) specified above. <b><u>This release will expire in 1
year date signed unless otherwise specified</u></b>. I further understand that I may cancel authorization
for release of information at any time unless the information has already been sent.</p>
<div style="display:flex;">
<b>Client Signature: </b>&nbsp;
<?php
    if(check_res['in_clisign']!=''){
        echo '<img src='.$check_res['in_clisign'].' style="width:20%;height:40px;" >';
    }
    ?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['in_date1'] ?strstr($check_res['in_date1'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex;">
<b>Parent/Legal Guardian Signature:</b>&nbsp;
<?php
    if(check_res['in_parsign']!=''){
        echo '<img src='.$check_res['in_parsign'].' style="width:20%;height:40px;" >';
    }
    ?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['in_date2'] ?strstr($check_res['in_date2'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex;">
<b>Witness Signature:</b>&nbsp;
<?php
    if(check_res['in_witsign']!=''){
        echo '<img src='.$check_res['in_witsign'].' style="width:20%;height:40px;" >';
    }
    ?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['in_date3'] ?strstr($check_res['in_date3'], ' ', true): ''); ?></label><br><br>
</div>

<span class="title"><center><u><?php echo xlt('FAMILY SESSIONS'); ?></u></center></span><br /><br />

<?php echo $check_res['text4']?$check_res['text4']:"
<p>CNT is a private organization created to meet the needs of individuals and families affected by substance abuse. The program is primarily group based addressing issues through a bio-psycho-social- cultural model. CNT operates on the premise that addiction is a life threatening disease. While we treat the individual, we also understand the impact of substance abuse on the entire family system. CNT works within that system to treat the individual. CNT uses the Network Therapy approach. According to Network Therapy, the involvement of family, friends, and other supportive individuals is an essential part of the client’s recovery process.  All CNT clinical practices are evidenced based and outcome oriented.</p>
<br>
<p>To provide education to the client and his or her family, or legally authorized representative as part of its discharge/continuum of care planning service at CNT, staff encourages participation through family sessions. Outside of contacting collateral contacts over the phone, CNT encourages family educational sessions to further integrate the client and his or her family, or legally authorized representation as a part of the treatment process.</p>
<br>
<p>Family can be identified as members of the client’s community whom he or she has identified as a part of their family unit.</p>" ?>
<br>
<p>Would you like to participate in family educational sessions?
     <input type="checkbox" class="radio_change family_session" data-id='family_session' value="yes" <?php echo isset($check_res['family_session'])&&$check_res['family_session']=='yes'?'checked=checked':'' ?>>Yes &nbsp;&nbsp;
     <input type="checkbox" class=" radio_change family_session" data-id='family_session'  value="no"  <?php echo isset($check_res['family_session'])&&$check_res['family_session']=='no'?'checked=checked':'' ?>>No

</p>
<ul>
    <li>	Please be aware that even if a NO is notated, this will be revisited by CNT Staff throughout the course of treatment.</li>
</ul>

<span class="title"><center><?php echo xlt('Consent to Obtain/Release Information from client’s'); ?></center></span>
                        <span class="title"><center><u><?php echo xlt('Primary Care Physician or most recent hospitalization'); ?></u></center></span><br /><br />

                        <b>Client Name:</b>&nbsp; <?php echo $check_res['nclient_name2']?>
                        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
                        <b>Date of Birth:</b>&nbsp; <?php echo text($check_res['pri_dob'] ?strstr($check_res['pri_dob'], ' ', true): ''); ?><br><br>

                        <p><b>I authorize The Center for Network Therapy staff to correspond with:</b></p>
                        <label><b>Physician/Hospital Name:</b>&nbsp;<?php echo text($check_res['pri_hosp'] ?? ''); ?></label><br>
                        <b>Address: Street:</b>&nbsp;<?php echo text($check_res['pri_addr'] ?? ''); ?><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
                        <label><b>City:</b>&nbsp;<?php echo text($check_res['pri_city'] ?? ''); ?></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
                        <label><b>State</b>&nbsp;<?php echo text($check_res['pri_state'] ?? ''); ?></label>
                        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
                        <label><b>Zip</b>&nbsp;<?php echo text($check_res['pri_zip'] ?? ''); ?></label><br><br>
                        <label><b>Phone#:</b>&nbsp;<?php echo text($check_res['pri_phone'] ?? ''); ?></label><br><br>
                        <label><b>Fax#:</b>&nbsp;<?php echo text($check_res['pri_fax'] ?? ''); ?></label><br><br>

                        <p>To OBTAIN and/or RELEASE the following information:</p>
                        <p>Please <b><u>INTIAL</u></b> where applicable:</p>

                            <input type=checkbox name='recent_labs' class="check-pat" <?php echo(($check_res['recent_labs']&& $check_res['recent_labs']==1) ?'checked=checked':''); ?>  >&nbsp;Most recent labs


                            <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
                            <input type=checkbox name='recent_physical' class="check-pat" <?php echo(($check_res['recent_physical']&& $check_res['recent_physical']==1) ?'checked=checked':''); ?>  >&nbsp;Most recent physical


                            <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
                            <input type=checkbox name='dx_history' class="check-pat" <?php echo(($check_res['dx_history']&& $check_res['dx_history']==1) ?'checked=checked':''); ?> >&nbsp;Dx history


                            <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="31" height="1">
                            <input type=checkbox name='medication_list' class="check-pat" <?php echo(($check_res['medication_list']&& $check_res['medication_list']==1) ?'checked=checked':''); ?>  >&nbsp;Current medication list<br>


                        <p>I understand that my record may contain information on HIV/AIDS and/or alcohol and drugs. I am also
                        giving consent for this information to be released:</p>
                        <p>** Please initial where appropriate:

                            <input type=checkbox  data-id='initial_appr' class="radio_change initial_appr" value="yes" <?php echo(($check_res['initial_appr']&& $check_res['initial_appr']=='yes') ?'checked=checked':''); ?>  >&nbsp;YES

                            <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
                            <input type=checkbox  data-id='initial_appr' class="radio_change initial_appr" value="no" <?php echo(($check_res['initial_appr']&& $check_res['initial_appr']=='no') ?'checked=checked':''); ?>  >&nbsp;NO

                        </p>
                        <p><b>FEDERAL REGULATIONS (CFR 42, PART 2)</b> prohibits any further release of this
                        information to other parties. I understand that this release will remain in effect for 90 days from
                        date signed below unless revoked in writing.</p>

                        <div style="display:flex;"><b>Client Signature: </b>&nbsp;
                        <?php
                        if(check_res['pri_clisign']!=''){
                            echo '<img src='.$check_res['pri_clisign'].' style="width:20%;height:40px;" >';
                        }
                        ?>

                        <label><b>Date:</b>&nbsp;<?php echo text($check_res['pri_date1'] ?strstr($check_res['pri_date1'], ' ', true): ''); ?></label>
                        </div>
                        <br><br>
                        <div style="display:flex;"><b>Parent/Legal Guardian Signature:</b>&nbsp;
                        <?php
                        if(check_res['pri_parsign']!=''){
                            echo '<img src='.$check_res['pri_parsign'].' style="width:20%;height:40px;" >';
                        }
                        ?>

                        <label><b>Date:</b>&nbsp;<?php echo text($check_res['pri_date2'] ?strstr($check_res['pri_date2'], ' ', true): ''); ?></label>
                        </div>
                        <br><br>

                        <div style="display:flex;"><b>Witness Signature:</b>&nbsp;
                        <?php
                        if(check_res['pri_witsign']!=''){
                            echo '<img src='.$check_res['pri_witsign'].' style="width:20%;height:40px;" >';
                        }
                        ?>

                        <label><b>Date:</b>&nbsp;<?php echo text($check_res['pri_date3'] ?strstr($check_res['pri_date3'], ' ', true): ''); ?></label>
                        </div>
                        <br><br>

                        <span class="title"><center><?php echo xlt('Consent to Obtain/Release Information from Client’s Pharmacy '); ?></center></span><br>

<b>Client Name:</b>&nbsp; <?php echo $check_res['nclient_name3']?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <?php echo text($check_res['pha_dob'] ?strstr($check_res['witdate'], ' ', true): ''); ?><br><br>

<p><b>I authorize The Center for Network Therapy staff to correspond with:</b></p>
<label><b>Pharmacy Name:</b>&nbsp;<?php echo text($check_res['pha_hosp'] ?? ''); ?></label><br>
<b>Address: Street:</b>&nbsp;<?php echo text($check_res['pha_addr'] ?? ''); ?><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>City:</b>&nbsp;<?php echo text($check_res['pha_city'] ?? ''); ?></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>State</b>&nbsp;<?php echo text($check_res['pha_state'] ?? ''); ?></label>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>Zip</b>&nbsp;<?php echo text($check_res['pha_zip'] ?? ''); ?></label><br><br>
<label><b>Phone#:</b>&nbsp;<?php echo text($check_res['pha_phone'] ?? ''); ?></label><br><br>
<label><b>Fax#:</b>&nbsp;<?php echo text($check_res['pha_fax'] ?? ''); ?></label><br><br>

<div style="display:flex;"><b>Client Signature: </b>&nbsp;
<?php
if(check_res['pha_clisign']!=''){
    echo '<img src='.$check_res['pha_clisign'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['pha_date1'] ?strstr($check_res['pha_date1'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex;"><b>Parent/Legal Guardian Signature:</b>&nbsp;
<?php
if(check_res['pha_parsign']!=''){
    echo '<img src='.$check_res['pha_parsign'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['pha_date2'] ?strstr($check_res['pha_date2'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex;"><b>Witness Signature:</b>&nbsp;
<?php
if(check_res['pha_witsign']!=''){
    echo '<img src='.$check_res['pha_witsign'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['pha_date3'] ?strstr($check_res['pha_date3'], ' ', true): ''); ?></label>
</div>
<br><br>

<span class="title"><center><b>Consent to Obtain/Release Information</b> (Family, Supportive Individuals, etc.)</center></span><br>

<b>Client Name:</b>&nbsp; <?php echo $check_res['nclient_name4']?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <?php echo text($check_res['fam_dob'] ?strstr($check_res['fam_dob'], ' ', true): ''); ?><br><br>

<p><b>I authorize The Center for Network Therapy staff to correspond with:</b></p>
<label><b>Person:</b>&nbsp;<?php echo text($check_res['fam_person'] ?? ''); ?></label><label><b>(Relationship)</b>&nbsp;<?php echo $check_res['fam_rel'] ;?></label><br>
<b>Address: Street:</b>&nbsp;<?php echo text($check_res['fam_addr'] ?? ''); ?><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>City:</b>&nbsp;<?php echo text($check_res['fam_city'] ?? ''); ?></label><img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>State</b>&nbsp;<?php echo text($check_res['fam_state'] ?? ''); ?></label>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="70" height="1">
<label><b>Zip</b>&nbsp;<?php echo text($check_res['fam_zip'] ?? ''); ?></label><br><br>
<label><b>Phone#:</b>&nbsp;<?php echo text($check_res['fam_phone'] ?? ''); ?></label><br><br>


<p>To OBTAIN and/or RELEASE the following information:</p>
<p>Please <b><u>INTIAL</u></b> where applicable:</p>
    <input type=checkbox name='fam1' class="check-pat" <?php echo(($check_res['fam1']&& $check_res['fam1']==1) ?'checked=checked':''); ?>  >&nbsp;Psychological Evaluation
    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="50" height="1">
    <input type=checkbox name='fam2' class="check-pat" <?php echo(($check_res['fam2']&& $check_res['fam2']==1) ?'checked=checked':''); ?>  >&nbsp;Psychiatric/Psychological Records<br>

    <input type=checkbox name='fam3' class="check-pat" <?php echo(($check_res['fam3']&& $check_res['fam3']==1) ?'checked=checked':''); ?> >&nbsp;Intake/Admission Summary
    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="31" height="1">
    <input type=checkbox name='fam4'class="check-pat" <?php echo(($check_res['fam4']&& $check_res['fam4']==1) ?'checked=checked':''); ?>  >&nbsp;Treatment Plans/Recommendations<br>

    <input type=checkbox name='fam5' class="check-pat" <?php echo(($check_res['fam5']&& $check_res['fam5']==1) ?'checked=checked':''); ?>  >&nbsp;Treatment Progress

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="81" height="1">
    <input type=checkbox name='fam6' class="check-pat" <?php echo(($check_res['fam6']&& $check_res['fam6']==1) ?'checked=checked':''); ?> >&nbsp;Closing/Discharge Summary<br>

    <input type=checkbox name='fam7' class="check-pat" <?php echo(($check_res['fam7']&& $check_res['fam7']==1) ?'checked=checked':''); ?>  >&nbsp;Probation/Parole Records

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="43" height="1">
    <input type=checkbox name='fam8' class="check-pat" <?php echo(($check_res['fam8']&& $check_res['fam8']==1) ?'checked=checked':''); ?>  >&nbsp;Medical Records<br>

    <input type=checkbox name='fam9' class="check-pat" <?php echo(($check_res['fam9']&& $check_res['fam9']==1) ?'checked=checked':''); ?>  >&nbsp;Urine Drug Screen Results

    <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="40" height="1">
    <input type=checkbox name='fam10' class="check-pat" <?php echo(($check_res['fam10']&& $check_res['fam10']==1) ?'checked=checked':''); ?>  >&nbsp;Other<br><br>

    <p>For the purpose of <b><u>COLLABORATION</u></b>.</p>

    <p>I voluntarily choose to sign below for the purpose(s) specified above. <b><u>This release will expire in 1
    year date signed unless otherwise specified</u></b>. I further understand that I may cancel authorization
    for release of information at any time unless the information has already been sent.</p>

    <div style="display:flex;">
        <b>Client Signature: </b>&nbsp;
        <?php
        if(check_res['fam_clisign']!=''){
            echo '<img src='.$check_res['fam_clisign'].' style="width:20%;height:40px;" >';
        }
        ?>


    <label><b>Date:</b>&nbsp;<?php echo text($check_res['fam_date1'] ?strstr($check_res['fam_date1'], ' ', true): ''); ?></label>
    </div>
    <br><br>
    <div style="display:flex;">
    <b>Parent/Legal Guardian Signature:</b>&nbsp;
    <?php
    if(check_res['fam_parsign']!=''){
        echo '<img src='.$check_res['fam_parsign'].' style="width:20%;height:40px;" >';
    }
    ?>


    <label><b>Date:</b>&nbsp;<?php echo text($check_res['fam_date2'] ?strstr($check_res['fam_date2'], ' ', true): ''); ?></label>
    </div>
    <br><br>
    <div style="display:flex;">
    <b>Witness Signature:</b>&nbsp;
    <?php
    if(check_res['fam_witsign']!=''){
        echo '<img src='.$check_res['fam_witsign'].' style="width:20%;height:40px;" >';
    }
    ?>

    <label><b>Date:</b>&nbsp;<?php echo text($check_res['fam_date3'] ?strstr($check_res['fam_date3'], ' ', true): ''); ?></label>
    </div>
    <br><br>

    <span class="title"><center><u>Symptom Assessment for Pulmonary Tuberculosis (TB)</u></center></span><br>

<b>Client Name:</b>&nbsp; <?php echo $check_res['nclient_name5']?>
<img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="472" height="1">
<b>Date of Birth:</b>&nbsp; <?php echo text($check_res['tb_dob'] ?strstr($check_res['tb_dob'], ' ', true): ''); ?><br><br>
<label><b>Date:</b>&nbsp;<?php echo text($check_res['tb_date'] ?strstr($check_res['tb_date'], ' ', true): ''); ?></label><br><br>
<label><b>Definition:</b>
Tuberculosis is a highly contagious bacteria, Mycobacterium tuberculosis,
transmitted by air droplets from person to person that may cause fever, sweats, blood sputum
cough, weight loss, fatigue and chest pain that may cause chronic liver, kidney and lung
problems.
</label>

<label><b>TB-Like Symptoms (Check all that apply):</b></label><br>

<input type=checkbox name='tb1' class="check-pat" <?php echo(($check_res['tb1']&& $check_res['tb1']==1) ?'checked=checked':''); ?>  >&nbsp;Productive Cough Of Undiagnosed Cause (more than 3 weeks in duration)<br>

<input type=checkbox name='tb2' class="check-pat" <?php echo(($check_res['tb2']&& $check_res['tb2']==1) ?'checked=checked':''); ?> >&nbsp;Coughing up blood (Hemoptysis)<br>

<input type=checkbox name='tb3' class="check-pat"<?php echo(($check_res['tb3']&& $check_res['tb3']==1) ?'checked=checked':''); ?> >&nbsp;Unexplained Weight Loss (10 pounds or greater without dieting)<br>

<input type=checkbox name='tb4'  class="check-pat"<?php echo(($check_res['tb4']&& $check_res['tb4']==1) ?'checked=checked':''); ?>>&nbsp;Night Sweats (regarding of room temperature)<br>


<input type=checkbox name='tb5'  class="check-pat"<?php echo(($check_res['tb5']&& $check_res['tb5']==1) ?'checked=checked':''); ?>  >&nbsp;Unexplained Loss of Appetite<br>


<input type=checkbox name='tb6'  class="check-pat"<?php echo(($check_res['tb6']&& $check_res['tb6']==1) ?'checked=checked':''); ?>  >&nbsp;Very Easily Tired (Fatigability)<br>


<input type=checkbox name='tb7' class="check-pat" <?php echo(($check_res['in7']&& $check_res['tb7']==1) ?'checked=checked':''); ?> >&nbsp;Fever<br>


<input type=checkbox name='tb8' class="check-pat"<?php echo(($check_res['tb8']&& $check_res['tb8']==1) ?'checked=checked':''); ?> >&nbsp;Chills<br>


<input type=checkbox name='tb9' class="check-pat"<?php echo(($check_res['tb9']&& $check_res['tb9']==1) ?'checked=checked':''); ?> >&nbsp; Chest Pain<br>

<input type=checkbox name='tb10'class="check-pat" <?php echo(($check_res['tb10']&& $check_res['tb10']==1) ?'checked=checked':''); ?> >&nbsp;Close contact with someone with infectious T.B<br>

<input type=checkbox name='tb11' class="check-pat"<?php echo(($check_res['tb11']&& $check_res['tb11']==1) ?'checked=checked':''); ?>  >&nbsp;Foreign born person outside United States<br>


<input type=checkbox name='tb12' class="check-pat" <?php echo(($check_res['tb12']&& $check_res['tb12']==1) ?'checked=checked':''); ?> >&nbsp;Traveler to a high prevalent TB country for more then 1 month<br>


<input type=checkbox name='tb13' class="check-pat" <?php echo(($check_res['tb13']&& $check_res['tb13']==1) ?'checked=checked':''); ?>  >&nbsp;Current, former resident, or employee of correction facility, long term care hospital, hospice, or homeless shelter

<br><br>

<div style="display:flex"><b>Client Signature: </b>&nbsp;
<?php
if(check_res['tb_clisign']!=''){
    echo '<img src='.$check_res['pha_witsign'].' style="width:20%;height:40px;" >';
}
?>

</div><br>
<div style="display:flex">
<label><b>Parent/Legal Guardian Signature:</b>&nbsp;
<?php
if(check_res['tb_parsign']!=''){
    echo '<img src='.$check_res['tb_parsign'].' style="width:20%;height:40px;" >';
}
?>

</label>
</div>

<label><u><b>CONFIDENTIALITY OF ALCOHOL AND DRUG ABUSE CLIENT RECORDS</b></u></label><br>
<?php echo $check_res['text5']?$check_res['text5']:"
 <p>I understand that under the Health Insurance Portability and Accountability Act of 1996 (HIPAA), I have certain rights to privacy regarding my protected health information. I understand that this information can and will be used to:</p>
 <ul>
    <li>Conduct, plan, and direct my treatment and follow-up among the multiple healthcare providers who may be involved in that treatment directly or indirectly.</li>
    <li>Obtain payment from third party payers.</li>
    <li>Conduct normal healthcare operations such as quality assessments and physical certifications.</li>
 </ul>
 <p>I have been informed by you of your Notice of Privacy Practices containing a more complete description of the uses and disclosures of my health information. I have been given the right to review such Notice of Privacy Practices prior to signing this consent. I understand that this organization has the right to change its Notice of Privacy Practices from time to time and that I may contact this organization at any time at the above address to obtain the current copy of the Notice of Privacy Practices.</p>
 <p>I understand that I may request in writing that you restrict how my private information is used or disclosed to carry out treatment, payment, or healthcare operations. I also understand you are not required to agree to my requested restrictions, but if you do agree then you are bound to abide by such restrictions.</p>
 <p>I understand that I may revoke this consent in writing at any time, except to the extent that you have taken actions relying on this consent.</p>
 <p>I also acknowledge receipt of copies of “Client Rights,” “Confidentiality of Alcohol and Drug Abuse Client Records,” and “Notice of Privacy Practices.”</p>" ?>
 <br>

 <label><u><b>INFORMED CONSENT</b></u></label><br>
 
 <?php echo $check_res['text6']?$check_res['text6']:"
 <ul>
    <li>I agree to let the Center for Network Therapy conduct, plan, and direct my treatment and follow-up among the multiple healthcare providers (as per patient’s consent) who may be involved in that treatment directly or indirectly.</li>
    <li>Individuals providing services at CNT include Board Certified Alcohol and Drug Counselors (CADC), Licensed Clinical Alcohol and Drug Counselors (LCADC), License Professional Counselors (LPC), Certified Clinical Supervisor (CCS), State Licensed Psychologist (Ph.D/Psy.D), and a Board Certified/ASAM Certified Psychiatrist (MD). </li>
    <li>In accordance with the New Jersey Office of the Attorney General, Division of Consumer Affairs State Board of Marriage and Family Examiners Alcohol and Drug Counselor Committee Statutes and Regulations has advised me of the following:</li>
    <li>In accordance with Regulation 3:34C-3.2(c), I understand that I may receive counseling services from a staff member who is not yet a (Licensed) Certified Alcohol and Drug Counselor (L)CADC; however, this individual shall remain under the clinical supervision of an appropriately licensed/certified supervisor while they are completing their practicum as per Regulation 3:34C-6.2(c).</li>

 </ul>" ?>
 <br>
 <div style="display:flex"><b>Client Signature: </b>&nbsp;
 <?php
if(check_res['inf_con_sign1']!=''){
    echo '<img src='.$check_res['inf_con_sign1'].' style="width:20%;height:40px;" >';
}
?>

&nbsp;date:<?php echo text($check_res['inf_con_date1'] ?strstr($check_res['inf_con_date1'], ' ', true): ''); ?><br><br>
</div><br>
<div style="display:flex">
<b>Parent/Legal Guardian Signature:</b>&nbsp;
<?php
if(check_res['inf_con_gudsign']!=''){
    echo '<img src='.$check_res['inf_con_gudsign'].' style="width:20%;height:40px;" >';
}
?>
&nbsp;date:<?php echo text($check_res['inf_con_date2'] ?strstr($check_res['inf_con_date2'], ' ', true): ''); ?><br><br>
</div>
<p>If signed by a personal representative of the patient, please state relationship:</p>
<?php echo $check_res['rep_patient'] ?>


<label><u><b>Group Rules:</b></u></label><br>
<ul>
<li>Client voluntarily agrees to participate in treatment.</li>
<li>The confidentiality of client information is very important. In order to ensure safe participation, what is said in a group stays in the group. You are never to discuss other clients (i.e., who they are, their presence in the program, specific problems, etc.) at home, work, social settings, on breaks, or any other setting outside group meetings.</li>
<li>Group members can say whatever they want and whenever they want. Silence can, in fact, be detrimental to a group member’s recovery.</li>
<li>Group members can refuse to answer any questions or participate in assigned responsibilities</li>
<li>Swearing, putting down, threats of violence, verbal or physical intimidation, bullying, or fighting will not be tolerated and result in immediate expulsion from the program.</li>
<li>Dating, romantic involvement, or sexual involvement between group members (unless you sign on as a couple) is prohibited as such activities can sabotage the treatment of either one or both of you.</li>
<li>Clients are required to make a commitment to the IOP schedule and be punctual. CNT reserves the right to terminate a client’s involvement with the program due to irregular or non-attendance. In the event you cannot attend a group you have to notify CNT.</li>
<li>In the event of an emergency, please go to the nearest emergency room or call CNT.</li>
<li>Cell phones, beepers, laptops, personal stereo equipment, etc., must be turned off and cell phones must be handed over to CNT staff. You may use them during breaks. If your family needs to get in touch with you during group meetings, they can call CNT.</li>
<li>Arriving for sessions under the influence of substances (incl. alcohol) or in possession of substances is not permitted.</li>
<li>Please refrain from eating during group sessions and consuming non-alcoholic beverages.</li>
<li>The program is not responsible for lost or stolen items.</li>
</ul>
<label><u><b>Medication: </b></u></label><br>
<ul>
<li>CNT believes therapeutic support is critical for recovery and medication is intended solely to enable the client to participate in appropriate therapeutic treatment. Therefore, it is our policy to provide medication management services only to clients who are enrolled in our IOP program. We do not provide stand alone medication services on an outpatient basis.</li>
<li>If a client is discharged from the IOP program due to limitations imposed by the health insurance company on IOP program participation, due to client’s non-attendance of the IOP program, completion of the program, or other reasons, it will become the client’s responsibility to find an alternate medication provider.</li>
<li>Clients must make plans to find their own psychiatrists/doctors to continue medication upon completion of the IOP program. It is recommended that patients begin identifying medication providers at the beginning of the program to facilitate a smooth transition.</li>
<li>CNT will not replace lost or stolen prescriptions. It is the clients’ responsibility to keep a count of their medications and get an appointment to see the doctor before they run out of medication. CNT will not call in prescriptions if a client fails to make a timely appointment with the doctor, if a client is unable to keep an appointment with the physician or if client runs out of medication due to more than prescribed use.</li>
</ul>
<p>I have read, understood, and agree to abide by the above:</p>
<label>Name:<?php  echo $check_res['med_name']??'';?> </label>
<label>date:<?php echo text($check_res['med_date1'] ?strstr($check_res['med_date1'], ' ', true): ''); ?><br>
<div style="display:flex"><b>Signature: </b>&nbsp;
<?php
if(check_res['med_sign1']!=''){
    echo '<img src='.$check_res['med_sign1'].' style="width:20%;height:40px;" >';
}
?>

&nbsp;
</div><br>
<div style="display:flex">
<b>Parent/Legal Guardian Signature:</b>&nbsp;
<?php
if(check_res['med_gud_sign1']!=''){
    echo '<img src='.$check_res['med_gud_sign1'].' style="width:20%;height:40px;" >';
}
?>

&nbsp;date:<?php echo text($check_res['med_gud_date1'] ?strstr($check_res['med_gud_date1'], ' ', true): ''); ?><br><br>
</div>


<label><u><b>Notice of Privacy Practices</b></u></label><br>

<p>This notice describes how medical information about you may be used and disclosed and how you can access this information. Please review it carefully.</p>

<p>We care about our patients’ privacy and strive to protect the confidentiality of your medical information at this practice. New federal legislation requires that we issue this official notice of our privacy practices. You have the right to the confidentiality of your medical information, and this practice is required by law to maintain the privacy of that protected health information. This practice is required to abide by the terms of the Notice of Privacy Practices currently in effect, and to provide notice of its legal duties and privacy practices with respect to protected health information. If you have any questions about this Notice, please contact the Privacy Officer at this practice.</p>

<p><b>Who Will Follow This Notice:</b> Any health care professional authorized to enter information into your medical record, all employees, staff and other personnel at this practice who may need access to your information must abide by this Notice. All subsidiaries, business associates (e.g. a billing service), sites and locations of this practice may share medical information with each other for treatment, payment purposes or health care operations described in this Notice. Except where treatment is involved, only the minimum necessary information needed to accomplish the task will be shared.</p>

<p><b>How We May Use and Disclose Medical</b> Information About You: The following categories describe different ways that we may use and disclose medical information without your specific consent or authorization. Examples are provided for each category of uses or disclosures. Not every possible use or disclosure in a category is listed.</p>

<p><b>For Treatment:</b> We may use medical information about you to provide you with medical treatment or services. Example: In treating you for a specific condition, we may need to know if you have allergies that could influence which medications we prescribe for the treatment process.</p>

<p><b>For Payment:</b> We may use and disclose medical information about you so that the treatment and services you receive from us may be billed and payment may be collected from you, an insurance company or a third party. Example: We may need to send your protected health information, such as your name, address, office visit date, and codes identifying your diagnosis and treatment to your insurance company for payment.</p>

<p><b>For Health Care Operations:</b> We may use and disclose medical information about you for health care operations to assure that you receive quality care. Example: We may use medical information to review our treatment and services and evaluate the performance of our staff in caring for you.</p>

<p><b>Other Uses or Disclosures That Can Be Made Without Consent or Authorization:</b></p>
<ul>
<li>As required during an investigation by law enforcement agencies</li>
<li>To avert a serious threat to public health or safety</li>
<li>As required by military command authorities for their medical records</li>
<li>To workers’ compensation or similar programs for processing of claims</li>
<li>In response to a legal proceeding</li>
<li>To a coroner or medical examiner for identification of a body</li>
<li>If an inmate, to the correctional institution or law enforcement official</li>
<li>As required by the US Food and Drug Administration (FDA)</li>
<li>Other healthcare providers’ treatment activities</li>
<li>Other covered entities’ and providers’ payment activities</li>
<li>Other covered entities’ healthcare operations activities (to the extent permitted by HIPAA)</li>
<li>Uses and disclosures required by law</li>
<li>Uses and disclosures in domestic violence or neglect situations</li>
<li>Health oversight activities</li>
<li>Other public health activities</li>
</ul>
<p>We may contact you to provide appointment reminders or information about treatment alternatives or other health-related benefits and services that may be of interest to you.</p>


<label><center><u><b>Notice of Privacy Practices</b></u></center></label><br>
<p>Please be advised that certain federal and state laws and regulations require that the CNT maintains the confidentiality of your records pertaining to this program. The following notice lists in detail the various elements of this confidentiality requirement.</p>

<p>The confidentiality of alcohol and drug abuse client records maintained by this program is protected by the following laws:</p>
<ul>
    <li>Federal Law – 42 C.F.R., Part II</li>
    <li>NJ Law – P.L. 1987, c. 116, s. 5</li>
</ul>
<p>Generally, the program may not inform a person outside the program that a client attends the program, or disclose any information identifying a client as an alcohol or drug abuser unless:</p>
<div style="margin-left:20px">
<p>1.disclosure is allowed by court order; or</p>
<p>2.disclosure is made to medical personnel in a medical emergency or to qualifying personnel for research, audit, or program evaluation. Federal law allows for medical emergencies, which are defined as situations that pose an immediate risk and require medical intervention. Typical examples of medical emergencies include a suicide threat, a drug overdose, or a client with active and infective tuberculosis who is not taking his or her medication. This may not be used as grounds to contact family or police. The NJ law allows for the disclosure of private information only when there is an immediate and imminent threat to life or property in the reasonable foreseeable future. This extends to police or emergency personnel.</p>
</div>
<p>Violation of these confidentiality laws by a program is a crime. Suspected violations may be reported to appropriate authorities in accordance with federal regulations.</p>
<p>Disclosure of complete client records, upon specific written authorization of the client, is required for payment for treatment in such a program to be made by certain insurance carriers including the federal Medicare program.</p>

<p>Federal law and regulations do not protect any information about a crime committed by a client either at the program or against any person who worked for the program, or about any threat to commit such a crime.</p>

<p>Federal law and regulations do not protect any information about suspected child abuse or neglect from being reported under state law to appropriate state or local authorities.</p>

<p>I have read the above statements and certify that I understand them fully and that any questions were answered fully.</p>
<br>

<div style="display:flex;">
    <b>Client Signature: </b>&nbsp;
    <?php
    if(check_res['pha_witsign']!=''){
        echo '<img src='.$check_res['pha_witsign'].' style="width:20%;height:40px;" >';
    }
    ?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['cl_date1_l'] ?strstr($check_res['cl_date1_l'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex;">
<b>Parent/Legal Guardian Signature:</b>&nbsp;
<?php
    if(check_res['pha_witsign']!=''){
        echo '<img src='.$check_res['pha_witsign'].' style="width:20%;height:40px;" >';
    }
    ?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['gud_date_l'] ?strstr($check_res['gud_date_l'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex;">
<b>Witness Signature:</b>&nbsp;
<?php
    if(check_res['pha_witsign']!=''){
        echo '<img src='.$check_res['pha_witsign'].' style="width:20%;height:40px;" >';
    }
    ?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['fin_wit_date'] ?strstr($check_res['fin_wit_date'], ' ', true): ''); ?></label>
</div>
<br><br>


<center><label><b><u>CLIENT RIGHTS</u></b></label></center>

<?php echo $check_res['text7']?$check_res['text7']:"
Each client receiving services at the CNT shall have the following rights:
<p>1.The right to be informed of these rights, as evidence by the client’s written acknowledgement, or by documentation by staff in the medical record, that the client was offered a written copy of these rights and given a written or verbal explanation of these rights, in terms the client could understand.  The facility shall have a means to notify clients of any rules and regulations it has adopted governing client conduct in the facility.
<p>2.The right to be notified of any rules or policies the program has established governing client conduct in the facility.
<p>3.The right to be informed of services available in the facility, of the names and professional status of the personnel providing and/or responsibilities for the client’s care, and of fees and related charges, including the payment, fee deposit, and refund policy of the facility and any charges for services not covered by sources of third party payment or not covered by the facility’s basic rate.
<p>4.	The right to be informed if the facility has authorized other health care and educational institutions to participate in the client’s treatment. The client shall also have the right to know the identity and function of these institutions, and to refuse to allow their participation in the client’s treatment.
<p>5.	The right to receive from the client’s clinical practitioner(s), in terms that the client understands, an explanation of his or her complete condition or diagnosis, recommended treatment, treatment options, including the option of no treatment, risk(s) of treatment, and expected results(s). If this information would be detrimental to the client’s health, or if the client is not capable of understanding the information, the explanation shall be provided to the client’s next of kin or guardian. This release of information to the next of kin or guardian, along with the reason for not informing the client directly, shall be documented in the client’s record. All consents to release information shall be signed by the client or their parent, guardian, or legally authorized representatives.
<p>6.	The right to participate in the planning of the client’s care and treatment, and to refuse medication and treatment. Such refusal shall be documented in the client’s record.
<p>7.	The right to be included in experimental research only when the client gives informed, written consent to such participation, or when a guardian gives such consent to an incompetent client in accordance with laws, rules and regulations. The client may refuse to participate in experimental research, including investigation of new drugs and medical devices.
<p>8.	The right to voice grievances or recommended changes in policies and services to the program, facility personnel, the governing authority and/or outside representatives of the client’s choice either individually or as a group, and free from restraint, interference, coercion, discrimination, or reprisal.
<p>9.	The right to be free from mental and physical abuse, free from exploitation, and free from use of restraints. Drugs and other medications shall not be withheld for discipline of clients or for convenience of facility personnel.
<p>10.	The right to confidential treatment of information about the client. Information in the client's clinical record shall not be released to anyone outside the program without the client's written approval to release the information in accordance with Federal statutes and rules for the Confidentiality of Alcohol and Drug Abuse Client Records at 42 U.S.C. §§290dd-2, and 290ee-2, and 42 CFR Part 2 §§2.1 et seq., and the provisions of the Health Insurance Portability and Accountability Act (HIPAA) at 45 CFR Parts 160 and 164, unless the release of the information is required and permitted by law, a third-party payment contract, a peer review, or the in-formation is needed by DAS for statutorily authorized purposes; and The program may release data about the client for studies containing aggregated statistics only when the client's identity is protected and masked;
<p>11.The right to be treated with courtesy, consideration, respect, and recognition of the client’s dignity, individuality, and right to privacy, including but not limited to, auditory and visual privacy. The client’s privacy shall also be respected when facility personnel are discussing the client.
<p>12.The right to not be required to perform work for the facility unless the work is part of the client’s treatment and performed voluntarily by the client. Such work shall be in accordance with local, state, and federal laws and rules.
<p>13.The right to exercise civil and religious liberties, including the right to independent personal decision.  No religious beliefs or practices, or any attendance at religious services, shall be imposed upon by any client. The right to not be neglected throughout the course of treatment.
<p>14.	The right to not be discriminated against because of age, race, religion, sex, nationality, sexual orientation, disability, or ability to pay; or to be deprived of any constitutional, civil, and/or legal rights solely because of receiving services from the facility. The program shall not discriminate against clients taking medication as prescribed. The right to be transferred or discharged only for medical reasons, client’s welfare, that of other clients or staff upon written order, of a physician or other licensed clinician, or for failure to pay required fees as agreed at time of admission—except as prohibited by sources of a third-party payment. The client and his or her family shall be given 10 days advance notice, depending on level of care, of such transfer or discharge.
<p>15.	The right to be notified in writing, and to have the opportunity to appeal, an involuntary discharge
16.	The right to have access to and obtain a copy of his or her clinical record, in accordance with policies and procedures and applicable Federal and State laws and rule
<p>Complaints may be logged at the following offices:</p>" ?>
<table style="width:100%">
        <tr>
            <td>New Jersey State Department of Human Services<br>
            Division of Addiction Services<br>
            PO Box 362<br>
            Trenton, NJ 08625-0362<br>
            T: 877-712-1868
            </td>
            <td>
            State of New Jersey<br>
            Office of the Ombudsman for Institutionalized Elderly<br>
            P.O. Box 808<br>
            Trenton, NJ 08625-0808<br>
            T: 609-624-4262<br>
            </td>
        </tr>
</table>

<ul>
    <li>	I agree to let the Center for Network Therapy conduct, plan, and direct my treatment and follow-up among the multiple healthcare providers (as per patient’s consent) who may be involved in that treatment directly or indirectly.
    <li>	I have been notified that some or all of the services provided by Center for Network Therapy will be provided by Certified Alcohol and Drug Counselors and by substance abuse counselor interns under the clinical supervision of a qualified supervisor.

</ul>


<div style="display:flex;">
<b>Client Signature</b>&nbsp;
<?php
if(check_res['right_sign1']!=''){
    echo '<img src='.$check_res['right_sign1'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['right_date1'] ?strstr($check_res['right_date1'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex;">
<b>Parent/Legal Guardian Signature: </b>&nbsp;
<?php
if(check_res['right_gud_sign1']!=''){
    echo '<img src='.$check_res['right_gud_sign1'].' style="width:20%;height:40px;" >';
}
?>

</div>
<br>
<p>If signed by a personal representative of the patient, please state relationship:<?php echo $check_res['right_relation']??'';?></p>


<br>

<center><label><b><u>Visitor’s Confidentiality Statement</u></b></label></center>
 <br>
 <p>As a visitor of the Center for Network Therapy (CNT), I agree to keep confidential any and all information related to any patient at the facility. I further agree to not reveal to anyone the presence of the patient at the facility and not discuss any patient information with any person, including but not limited to, staff members, students, other patients, patient’s family members, patient’s friends or other visitors and outside parties.
<p>I attest that I support the statement in the Patient’s Bill of Rights, which states that patients have the right to the privacy of their health care information.
<p>I agree that pertinent information relative to a patient’s admission, condition and treatment must only be discussed within the patient care setting, and with only the patient and CNT’s direct care staff.
<p>Patient care information may be given to family members and/or loved ones only by permission of the patient as indicated in the patient’s record release form.
<br>
<b>Name:</b>&nbsp;<?php echo text($check_res['confident_name'] ?? ''); ?>
 <label><b>Date:</b>&nbsp;<?php echo text($check_res['confident_date'] ?strstr($check_res['right_date1'], ' ', true): ''); ?></label>
<br>
<div style="display:flex;">
<b>Signature:</b>&nbsp;
<?php
if(check_res['confident_sign']!=''){
    echo '<img src='.$check_res['confident_sign'].' style="width:20%;height:40px;" >';
}
?>

</div>
<div style="display:flex;">
<b>Parent/Legal Guardian Signature:</b>&nbsp;
<?php
if(check_res['confident_gud_sign']!=''){
    echo '<img src='.$check_res['confident_gud_sign'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['confident_gud_date'] ?strstr($check_res['confident_gud_date'], ' ', true): ''); ?></label>
</div>

<br>
<center><label><b><u>(Private Health Insurance Only)</u></b></label></center>
<br>Client’s Name: <?php echo $check_res['health_ins_name']??'';?> &nbsp:
date:<?php echo text($check_res['health_ins_date'] ?strstr($check_res['health_ins_date'], ' ', true): ''); ?>
<br>
<p>I do not authorize the Center for Network Therapy to provide me with enhanced coordinated treatment that allows for the evaluation and record keeping of my treatment through the use of the New Jersey Substance Abuse Monitoring System (NJSAMS), a secure computer system, and that my information will not be maintained in the NJSAMS.

<p>Even if  my medical records are protected under federal and state law, including the federal regulations governing Confidentiality of Alcohol and Drug Abuse Patient Records, 42 C.F.R. Part 2, and the Health Insurance Portability and Accountability Act of 1996 (HIPPA), 45 C.F.R. Parts 160 & 164, and cannot be disclosed without my written consent unless otherwise provided for in the regulations.
<p>I <?php echo $check_res['med_record']??'';?> do not give Center For Network Therapy permission to enter my information in New Jersey Substance Monitoring System (NJSAMS)</p>
<br>
<div style="display:flex;"><b>Client Signature: </b>&nbsp;
<?php
if(check_res['med_parsign']!=''){
    echo '<img src='.$check_res['med_parsign'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['med_pardate1'] ?strstr($check_res['med_pardate1'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex;"><b>Parent/Legal Guardian Signature:</b>&nbsp;
<?php
if(check_res['med_parsign2']!=''){
    echo '<img src='.$check_res['med_parsign2'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['med_date2'] ?strstr($check_res['med_date2'], ' ', true): ''); ?></label>
</div>
<br><br>
<div style="display:flex;"><b>Witness Signature:</b>&nbsp;
<?php
if(check_res['med_witsign3']!=''){
    echo '<img src='.$check_res['med_witsign3'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['med_witdate3'] ?strstr($check_res['pha_date3'], ' ', true): ''); ?></label>
</div>
<br><br>

<center><label><b><u>SAFE AND SECURE MEDICINE DISPOSAL GUIDE</u></b></label></center>
<br>
<p>I have received the Safe and Secure Medicine Disposal guide.My signature below acknowledges receipt and review of this document.</p>
<p>Client’s name:<?php echo $check_res['safe_cli_name']??'';?></p>
<div style="display:flex;"><b>Client’s Signature: </b>&nbsp;
<?php
if(check_res['safe_sign1']!=''){
    echo '<img src='.$check_res['safe_sign1'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['safe_date1'] ?strstr($check_res['pha_date3'], ' ', true): ''); ?></label>
</div>
<br>
<div style="display:flex;"><b>Physician’s Signature:  </b>&nbsp;
<?php
if(check_res['safe_sign2']!=''){
    echo '<img src='.$check_res['safe_sign2'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['safe_date2'] ?strstr($check_res['pha_date3'], ' ', true): ''); ?></label>
</div>
<br>

<br>
<p>I have received the Patient Orientation Manual.  My signature below acknowledges receipt.  </p>
<br>
<div style="display:flex;"><b>Client’s Signature: </b>&nbsp;
<?php
if(check_res['orient_sign1']!=''){
    echo '<img src='.$check_res['orient_sign1'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['orient_date1'] ?strstr($check_res['orient_date1'], ' ', true): ''); ?></label>
</div>
<br>
<div style="display:flex;"><b>Family Signature:  </b>&nbsp;
<?php
if(check_res['orient_sign2']!=''){
    echo '<img src='.$check_res['orient_sign2'].' style="width:20%;height:40px;" >';
}
?>

<label><b>Date:</b>&nbsp;<?php echo text($check_res['orient_date2'] ?strstr($check_res['orient_date2'], ' ', true): ''); ?></label>
</div>
<br>
<div style="display:flex;"><b>Doctors/ CNT Representative Signature: </b>&nbsp;
<?php
if(check_res['doc_sign3']!=''){
    echo '<img src='.$check_res['doc_sign3'].' style="width:20%;height:40px;" >';
}
?>

</div>
<br>
<label><b>Date:</b>&nbsp;<?php echo text($check_res['doc_maindate'] ?strstr($check_res['doc_maindate'], ' ', true): ''); ?></label>



<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Patient info packet form");
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

$mpdf->Output('Patient info packet form.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();

