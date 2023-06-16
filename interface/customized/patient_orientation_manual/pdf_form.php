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
$data =array();

    $sql = "SELECT * FROM form_patient_orientation WHERE id = $formid AND pid = $pid";
   
    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);
   
  //  echo $sql;
   
    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
 ?>
<style>
    
</style>
<body id='body' class='body'>
<?php
$header ="<div class='row' style='line-height:1px;' >
  
</div>";

ob_start();
 
        ?>
        <!-- <hr/> -->
        <br/> <br/> <br/> <br/><br/> <br/> <br/> <br/>
                    <table style="width:100%; "> 
                        <tr>
                            <td style= "text-align:center">
                                <h2><b><u>Center for Network Therapy</u></b></h2>
                            </td>  
                        </tr>
                    </table>   <br/> <br/> <br/> <br/> <br/><br/> <br/> <br/> <br/> <br/>
                    <table style="width:100%; "> 
                        <tr>
                            <td style=" text-align:center">
                                <h2><b>Patient Orientation Manual</b></h2>
                            </td>  
                        </tr>
                    </table>  
                    <br/><br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>  <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>  <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>  <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>     
                    <table style="width:100%;table-layout:fixed;display:table;"> 
                        <tbody>
                            <tr>
                                <td style="font-size:25px;">
                                    <h5><u>The Center for Network Therapy (CNT)</u></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size:25px;">
                                    <h5><u><b>Mission Statement</b></u></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:20px;">
                                <?php
                                if(isset($data['text1'])){
                                    echo $data['text1']; 
                                } else{
                            ?>
                                    <p>
                                        CNT is a private organization created to meet the needs of individuals and families affected by substance abuse. The program is primarily group based addressing issues through a bio-psycho-social- cultural model. CNT operates on the premise that addiction is a life threatening disease.While we treat the individual, we also understand the impact of substance abuse on the entire family system. CNT works within that system to treat the individual. CNT uses the Network Therapy approach. According to Network Therapy, the involvement of family, friends, and other supportive individuals is an essential part of the client’s recovery process. All CNT clinical practices are evidenced based and outcome oriented.</p>
                                        <?php
                                            }
                                        ?>
                                 </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size:25px;">
                                    <h5><u><b>Service Description (Including hours of Operation)</b></u></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
                                <?php
                                if(isset($data['text2'])){
                                    echo $data['text2']; 
                                } else{
                            ?>
         <p>CNT is the first and only Medically Monitored Ambulatory Detoxification facility in New Jersey
Licensed to treat all substance related dependencies. CNT provides a board certified ASAM
physician/psychiatrist, experienced detoxification registered nurses, Licensed Clinical Addiction
therapists and Social Workers. CNT, under the care of a physician and nurse, provide medically
monitored services for substance abuse and certain psychiatric diagnoses. CNT provides
physician, nurse, therapist and social work groups and one on one educational and therapeutic
session’s. CNT also provides Partial Hospitalization Program (PHP). Hours of operation are
from 9am-7pm 7 days a week.</p><?php
                                            }
                                        ?>
                                 </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size:25px;">
                                    <h5><u><b>Copy of Patient’s Rights and Grievance Procedure</b></u></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
                                    <p><b>Each client receiving services at CNT shall have the following rights:</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <ol><?php echo $data['text3']??"
                                        <li>To be informed of these rights, as evidenced by the patient’s written acknowledgement,
                                            or by documentation of by the staff in the medical records, that the client was offered a
                                            written copy of these rights and given a written or verbal explanation of these rights, in
                                            terms the patient could understand. The facility shall have a means to notify clients of
                                            any rules and regulations it has adopted regarding client conduct in the facility.</li>
                                            <li>To be informed of services available in the facility, of the names and professional status
of the personnel providing and/or responsible for the patient’s care, and of the fees and
related charges, including the payment, fee, deposit, and refund policy of the facility and
any charges for services not covered by sources of third party payment or not covered by
the facilities basic rate.</li>
                                            <li>To be informed if the facility has authorized other healthcare and educational institutions
to participate in the patient’s treatment. The patient shall also have the right to know the
identity and function of these institutions, and refuse to allow their participation in the
patient’s treatment.</li>
                                            <li>To receive from the patient’s clinical practioner(s), service in terms that the patient
understands, an explanation of his or her complete condition or diagnosis, recommended
treatment, treatment options, including the option of no treatment, risk(s) of treatment,
and expected results(s). If this information would be detrimental to the patient’s health, or
if the patient is unable to understand the information, the explanation should be provided
to the patient’s next of kin or guardian. This release of information to the next of kin and
or guardian, along with the reason for not informing the patient directly, shall be
documented in the patient’s record.</li>
                                            <li>To participate in the planning of the client’s care and treatment and to refuse medication
and treatment such refusal will be documented in the patient’s record.</li>
                                            <li>To be included in experimental research only when the patient gives informed, written
consent to such participation, or when a guardian gives such consent to an incompetent
patient in accordance with law, rule and regulation. The patient may refuse to participate
in experiential research, including the investigation of new drugs and medical devices.</li>
                                            <li>To voice grievances and recommend changes in policies and services to facility
personnel, the governing authority, and/or outside representatives of the patient’s choice
either individually or as a group, free from restraints, interference, coercion,
discrimination or reprisals.</li>
                                            <li>To be free from mental and physical abuse, free from exploitation, freedom from
humiliation and free from use of restraints Drugs and other medications shall not be used
for discipline of patient’s or for the convenience of facility personnel.</li>
                                            <li>To confidential treatment information about the patient. Information about the patient’s
record shall not be released to anyone outside the facility without the client’s approval,
unless another healthcare facility to which the patient was transferred to require the
information, or unless the release of the information is required and permitted by law, a
third party payment contract, or peer review, or unless the information if needed by the
New Jersey State Department of Health for statutorily authorized purposes. The facility
may release data about the patient for studies containing aggregated statistic’s when the
patient’s identity is masked.</li>
                                            <li>To be treated with courtesy, consideration, respect, and recognition of the patient’s
dignity, individuality, and right to privacy, including but not limited to, auditory and
visual privacy. The patient’s privacy shall also be respected when facility personnel and
discussing the patient.</li>
                                            <li>To not perform work for the facility unless the work is part of the patient’s treatment is
performed voluntarily by the patient.</li>
                                            <li>To exercise civil and religious liberties, including the right to independent personal
decisions. No religious belief or practices, or any attendance at religious services, shall
be imposed on any patient.</li>
                                            <li>The right not to be discriminated against for receiving services on the basis of race,
Ethnicity, age, color, religion, sexual preference, national origin, disability, veteran
status, Or HIV infection, whether asymptomatic or symptomatic, or AIDS.</li>
                                            <li>The right to receive services in the least restrictive feasible environment.</li>
                                            <li>The right to give consent or to refuse any service, treatment or therapy.</li>
                                            <li>The right to be informed and the right to refuse any unusual or hazardous treatment
procedures.</li>
                                            <li>The right to be advised and the right to refuse observation by others and by techniques
such as one-way vision mirrors, tape recorders, video recorders, television, movies or
photographs.</li>
                                            <li>The right to consult with an independent treatment specialist or legal counsel at one’s
own expense.</li>
                                            <li>The right to be informed of the reason(s) for terminating participation in a program.</li>
                                            <li>The right to be informed of the reason(s) for denial of a service.</li>
                                            <li>The right to have a written signed copy of the Clients Rights Policy and
Grievance Procedures.</li>
                                            <li>Methods for obtaining authorizations for release of information.</li>
                                            <li>Mechanisms to facilitate access and referral to guardians and conservators, self-help
groups, advocacy services, and legal services.</li>
                                            <li>The parameters of confidentiality.</li>
                                            <li>The right to give informed consent or to refuse any services, treatment or therapy.</li>
                                    "?></ol>                                    
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size:20px;">
                                    <h5> <b>Complaints may be lodged at the following offices</b> </h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size:20px;">
                                    <p>Center for Network Therapy<br/>
333 Cedar Avenue, Building B, Suite 3<br/>
Middlesex, NJ 08846<br/>
732-560-1080</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                     
                                </td>
                            </tr>
                            <br/>
                            <tr>
                                <td style="text-align:center;font-size:20px;">
                                <p>Division of Health Facilities Evaluation and Licensing<br/>
New Jersey State Department of Health<br/>
P.O. Box 367<br/>
Trenton, NJ 08625-0367<br/>
609-792-9770</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size:20px;">
                                     <p>Instructions for client in event of treatment-related emergency</p>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
                                     <p>If you wish to speak to your counselor when you are not at the Center for Network Therapy
(CNT), you may page him/her at the following numbers:</p>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
                                     <p>Staff-on-call<br/>
732-484-9661</p>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
                                     <p><b>Indra Cidambi, MD,</b> Medical Director<br/>
                                     Cell: 908-432-1929</p>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"> 
                                     <p>Kumar Cidambi, Facility Administrator<br/>
                                     Cell: 917-679-9154</p>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
                                     <p>You may contact APS if you are experiencing a psychiatric emergency:<br/><br/>APS (Acute Psychiatric Services)<br/>
732-235-5700<br/><br/>You may also call PESS at Somerset Medical Center if you are experiencing a psychiatric
emergency:<br/><br/>PESS (Psychiatric Emergency Services at Somerset County)<br/>

908-526-4100<br/><br/><b>These procedures will be explained to you during your intake. (The intake worker will give the
client a copy of the above numbers upon admission to the program).</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                <h4><b><u>Patient Orientation Handbook</u></b></h4>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
 <p><?php echo $data['text4']??"This handbook is provided to you to help orient you to our agency. If you have questions
or need further Information, please see a staff member. Included in the handbook is the
following:"?></p>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
                                <ul><?php echo $data['text5']??"
<li>Agency Mission Statement</li>
<li>Service Description (Including hours of operation)</li>
<li>Copy of agency Rules & Regulations</li>
<li>Copy of Client Rights form and Client Grievance Procedure</li>
<li>Explanation of client satisfaction survey process</li>
<li>Information regarding access to after-hours services in the community</li>
<li>Copy of agency Ethics Statement</li>
<li>Copy of Notice of Confidentiality / Privacy Practices</li>
<li>Site Map (for locations of emergency exits, fire extinguishers, first aid kits)</li>
<li>Copy of policy on seclusion & restraint</li>
<li>Educational information on HIV/AIDS, TB, Hepatitis B, and Hepatitis C other
Infectious Diseases, how to access information on advance directives</li>
                                     "?>
                                </ul>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
 <p><b><u> Mission Statement:</u></b><br/>
Through proven Evidenced Based Practices delivered by supportive and dedicated professionals,
CNT offers a path to wellness for the intervention and recovery from substance abuse and related
issues for individuals and their families in our communities.</p>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
 <p><b><u> Location:</u></b><br/>
 Main Office: 333 Cedar Avenue Building, B, Suite 3 Middlesex, NJ 08846</p>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
 <p><b><u> Hours of Operation:</u></b><br/>
Monday 9:00am – 7:00pm<br/>
Tuesday 9:00am – 7:00pm<br/>
Wednesday 9:0am – 7:00pm<br/>
Thursday 9:00am – 7:00pm<br/>
Friday 9:00am – 7:00pm<br/>
Saturday 9:00am – 7:00pm<br/><b>
(For emergency and inclement weather closings please refer to local cable news)</b></p>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
 <p><b><u> Access to After-Hours Staff:</u></b><br/>
 The Nursing Director is available 24/7 for all questions and emergencies. Please call CNT at
732-560-1080. The Answering Service will contact the Nursing Director.</p>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
 <p><b><u> Levels of Care offered by Center for Network Therapy (CNT)</u></b><br/><?php echo $data['text6']??"
 CNT offers the following levels of care:<br/><br/>
Level 11-D- Ambulatory Detoxification with Extended onsite Monitoring<br/>
Level II-5 Partial Hospitalization<br/><br/>
Admission to each level of care is based upon the American Society for Addiction Medicine<br/>
(ASAM) patient placement Criteria<br/><br/>
The protocols involve a review of criteria for seven dimensions (life areas):</p>
<ul><li>Acute Intoxication & Withdrawal potential</li>
<li>Biomedical Conditions & Complications</li>
<li>Emotional/ Behavioral/ Cognitive Conditions & Complications</li>
<li>Treatment Acceptance and Resistance</li>
<li>Relapse Potential</li>
<li>Recovery Environment</li>
<li>Family/ Caregiver Functioning</li></ul>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text7']??"
                                <p><b>Admissions & Reviews</b><br/>Dr. Cidambi reviews all admissions. Reviews are conducted on a regular basis. Continuation of
services is determined based on the protocols and client progress in treatment as verified by:
<ul><li>Achievement of goals & objectives from the individualized treatment plan</li>
<li>Results of random urine screening</li>
<li>Input from the client & counselor</li></ul>"?>
<br/>
<p><b>Discharges</b><br/><?php echo $data['text8']??"Dr. Cidambi approves all discharges. Discharge criteria are also based upon the protocols and
patient progress in treatment as verified by:
<ul><li>Achievement of goals & objectives from the individualized treatment plan</li>
<li>Results of random urine screening</li>
<li>Input from the client & counselor</li></ul>"?>
<h5><b>SERVICES:</b></h5><?php echo $data['text9']??"
<p>Center for Network Therapy offers a variety of intensive outpatient services, which are
designed to meet the individual treatment needs of its clients.<br/><br/>
Registration:<br/><br/>
Registration is the first step for the patient in accessing services. The registration process includes
completion of the paperwork necessary to open the client’s case, a determination of financial
resources available for payment of fees (, and a toxicology screen. Intake procedure takes about
45minutes. Urine Toxicology Screening – These are done at the point of intake and randomly
throughout the duration of services. Specimens are taken following “chain of custody” procedures and
are sent to a NIDA certified lab for processing. Results can be obtained by telephone within twenty-
four hours and written results are back within forty-eight hours.</p>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
                                <h5><b>ADULT TREATMENT</b></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"> <?php echo $data['text10']??"
                                    <p><b><u>Assessment</u></b> – The assessment provides a comprehensive overview of the patient and
his/her problems. Assessment includes the alcohol and other drug history, including

8
past treatment or efforts to abstain, functioning in the areas of family, employment, health, mental
health, legal, social and other life areas. Strengths available to support the recovery process,
client motivation for recovery, and ability to abstain from alcohol and other drugs on an
outpatient basis are also assessed. Recommendations for additional services, if appropriate, are also a
part of the assessment process. The assessment usually takes one and half-hours. Some patients may
require additional assessment time. Upon completion of the assessment, an Individualized
<b><u>Treatment Plan</u></b> is developed. The plan is based on the results of the assessment and establishes the
goals for treatment. The client is encouraged to participate in the development of the treatment goals
and the treatment plan. A primary therapist will be assigned and will be responsible for service
coordination.</p>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text11']??"
                                    <p><u>Partial Hospitalization Program</u> – This five hour, five day a week group program is designed for the
patient with a diagnosis of alcohol or other drug use and assessed as needing a highly structured
program to support the recovery process. Often this patient will have had previous treatment. Multiple
life problems including more than one arrest, employment, health and relationship issues are present.
The patient may also have significant denial of the presence of an alcohol or other drug problem. The
program usually lasts from eighteen to twenty-four days and transfer to step down care is based upon
progress in treatment. Attendance at a self-help group and abstinence is mandatory. Emphasis is
placed on reducing denial, motivating the patient to accept help from self help groups, and the
attainment of life skills such as communication, decision making, relaxation, etc. Individual treatment
is part of this program.</p>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text12']??"
                                     <p><u>Ambulatory detoxification</u> - The ambulatory Detox program is approximately five to seven days in
length. An individual completes registration and assessment. Once a supervisor reviews the case, the
person is scheduled to meet with the nurse who completes a screening process to determine if the
individual is likely to be benefit from the ambulatory Detox program. The nurse reviews each case
with the doctor who accepts the individual into the Detox program. Each person is monitored daily
during the Detox and cleared to go home on a daily basis by the M.D. The client is placed in to Partial
Hospital after completing the ambulatory Detox level of care. During the titration that last
approximately fourteen weeks the individual is monitored by the nurse and the physician
for withdrawal and medication issues. Patients are required to attend counseling in conjunction with
ambulatory Detox and the titration to increase the efficacy of treatment efforts and to support their
recovery for sustainability.</p>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;">
                                     <p><?php echo $data['text13']??"<u>Individual and Family Counseling:</u> This service is available as a part of an existing group program or
as a stand-alone service.</p>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text14']??"
                                <p><u>Relapse Prevention:</u><br/>
This group program is designed to provide support to those patients who have experienced a relapse
after a period of sobriety.</p>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text15']??"
                                <p><u>Assessment –</u> The assessment provides a comprehensive overview of the patient and his/her problems.
Assessment includes the alcohol and other drug history including past
treatment or efforts to abstain; functioning in the areas of family, employment, health,
mental health, legal, social, developmental and other life areas; strengths available to
support the recovery process, patient motivation for recovery and ability to abstain from alcohol and
other drugs on an outpatient basis. Recommendations for additional services are also a part of the
assessment process. The assessment usually takes two hours. A parent/guardian is always included in
the assessment process.</p>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text16']??"
                                <p><u>Individual and Family Counseling</u> – This service is available as either a part of an existing group
program or as a stand-alone service.</p>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                 <h5><u><b>Center for Network Therapy (CNT) Rules & Regulations</b></u></h5>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"> <?php echo $data['text17']??"                                
                                 <p>As a participant in this agency’s services, I agree to abide by the following rules:</p>
                                 
                                 <ol>
                                    <li>I will be on time for my scheduled groups and individual sessions. If I am more than
Fifteen (15) minutes late, I Understand I will not be seen and I must reschedule the
appointment.</li>
                                    <li>I will follow the agreed upon terms of my financial agreement with the Center for
Network Therapy. I understand that payment is expected at the time of service for groups
or individual sessions, unless alternate arrangements are made in advance.</li>
                                    <li>I understand that there is a charge for any check returned. I also understand that if my
check is returned for any reason, I will lose the privilege of paying by check and must
pay in cash or by money order.</li>
                                    <li>I understand that two (2) missed appointments may result in my dismissal from CNT
services with the possibility of notice of non-compliance being forwarded to my referral
source (unless there is an agreement between the counselor and participant).</li>
                                    <li>I agree to abstain from the use of alcohol or other drugs not prescribed for me while
participating in any of CNT’s programs. I will advise my counselor of any medications
prescribed for me and over the counter medications taken.</li>
                                    <li>I agree I will not possess, sell, or use any illicit drugs, alcohol, or drug paraphernalia
while on CNT’s premises or in CNT’s parking lot. All persons in violation of this policy
will be reported to the authorities and terminated from the program. No loitering on
property after program hours.</li>
                                    <li>I agree to submit a urine (toxic) screen or a breath screen upon request. I understand that I
am responsible for payment of the screen within one week of the administration of the
screen.</li>
                                    <li>I understand that smoking is not permitted in CNT I agree to smoke only in designated
areas at</li>
                                    <li>CNT</li>
                                    <li>I will not sexually, physically or verbally assault, threaten, or abuse any CNT staff person
or any program participant.</li>
                                    <li>I will not willfully damage or steal the property of CNT and/or CNT staff, or other
program participants.</li>
                                    <li>I will not carry or conceal any weapon – including pocketknives.</li>
                                    <li>I understand that prescription medication is not to be brought onto the premises. If I am
required to have prescription medication and/or over the counter medication with me, I
agree to bring the medication in the original container and keep it in my possession the
entire time I am on the premises.</li>
                                    <li>I will remain on CNT’s premises during any scheduled session and I will leave the
building promptly once the session has ended.</li>
                                    <li>I agree I will not discuss other program participants’ names and cases outside my groups
or other scheduled sessions. I agree to respect the confidentiality of all other program
participants. Failure to respect confidentiality may lead to dismissal from the program.</li>
                                    <li>I understand that I am responsible to provide child care and that children may not attend
scheduled sessions without prior permission of the counselor. If a child is left in CNT’s
lobby, the child must have a responsible caregiver, which I must provide. CNT cannot
assume responsibility for the well-being and safety of children.</li>
                                    <li>I understand that CNT does not permit clothing with alcohol product logos or drug
messages. I agree to dress appropriately and to comply with the dress code as established
by the counselor.</li>
                                    <li>I understand and agree that infractions of any of the above rules could result in dismissal
from CNT services and my referral source may be notified. I also understand and agree
that infractions of some rules could result in CNT immediately notifying local police or
sheriff departments and criminal charges could result.</li>
                                    <li>I understand that if I am removed from a group, I must first meet individually with my
counselor before returning to group. I understand that my motivation for treatment and
commitment to compliance will be assessed and then reviewed with a supervisor prior to
me being re- admitted.</li>
                                    <li>I understand that if I am dismissed from services at CNT, I must first meet with an
administrator or member of the Management Team before re-entering services. I
understand that I must demonstrate my motivation for treatment, my commitment to
compliance, and my plan for addressing issues that resulted in my dismissal.</li>
                                    <li>I understand that upon dismissal from CNT that I will not receive any controlled
substance prescription renewal, appropriate discharges that are clinically indicated will
receive a prescription up to three weeks to assure continuity of care until I follow up with
an outpatient psychiatrist of my choice. I acknowledge that it is solely my responsibility
to make this appointment for follow up for substance maintenance treatment. The CNT
staff will assist me with a list of treatment providers but will not make an appointment for
me.</li>
                                    <li>I agree that while I am at CNT services, I will not engage in obtaining prescriptions from
other physicians. All prescriptions I am on will be disclosed to the CNT’s MD.</li>
                                    <li>Patients understand not to speak of each other’s treatment outside CNT relating to HIPPA
privacy laws.</li>
                                    <li>CNT is not responsible for lost or stolen items.</li>
                                    <li>Urine drug screens are done on initial assessment and randomly and are supervised.
Refusal may lead to discharge.</li>
                                    <li>Patient’s personal belongings are searched by staff daily.</li>
                                    <li>Patients are to only bring sealed and unopened food items and beverages and items to be
verified by CNT staff.</li>
                                    <li>Feet must be covered at all times (footwear: shoes, sandals, etc. at all times).</li>
                                    <li>Cell phones and electronic devices are to be given to staff, while groups are held. Devices
are used only during free time.</li>
                                    <li>Patients with medically necessary medication are to be verified by nurse daily and held
with staff nurse until ordered time. At that time, client will be observed taking own
medication. At the end of day client will have medication returned.</li>
                                    <li>There is no visitation by any other person. By appointment only may family or significant
others may have conference with CNT nurse or physician. Children under 18 years of age
must have special arrangements made for conference with client and staff. No visitors are
allowed in the back treatment area at any time.</li>
                                    <li>Patients may smoke outside CNT facility under supervision of staff and at designated
times.</li>
                                    <li>Bring only necessary items to CNT. Leave all unnecessary items home.</li>
                                    <li>Respect and treat others like you want to be treated. Please refrain from talking while
others are talking.</li>
                                    <li>Staff will not tolerate any outbursts or arguing with staff or fellow clients. Patients may
be subject to discharge.</li>
                                 </ol>"?>
                                 </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text18']??"
                                    <h4><u>CNT DRESS CODE:</u></h4>
                                    <p>It is management’s intent that attire should complement an environment that reflects an efficient,
orderly, and professional environment. This policy is intended to define appropriate “attire”.CNT
reserves the right to continue, extend, revise or revoke this policy at its discretion
Enforcement of this guideline is the responsibility of the counselor, management and supervisory
personnel.<br/>
The key point to sustaining an appropriate attire program is the use of common sense and good
judgment, and applying a dress practice that CNT deems conducive to the environment. If you
question the appropriateness of the attire, it probably isn’t appropriate.</p>"?><br/>
<h4><u>UNACCEPTABLE ATTIRE</u></h4><?php echo $data['text19']??"
<ul>
<li>Cutoff or ripped clothing</li>
<li>T-shirts with alcohol product logos, drug messages or offensive messages will NOT be 
 rmitted.</li>
<li>Spandex or Lycra such as biker shorts</li>
<li>Tank tops, tube tops, halter tops with spaghetti straps</li>
<li>Underwear as outwear</li>
<li>Beach Wear</li>
<li>Midriff length tops</li>
<li>Provocative attire such as Low-cut blouses or clothing made of mesh or sheer materials
are not acceptable</li>
<li>Off-the-shoulder tops</li>
<li>Shorts must be no shorter than 4” above the knee
If questionable attire is worn, the counselor or supervisor will hold a personal, private discussion
with the client to advise client of the inappropriateness of the attire. </li>   
</ul>"?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text20']??"
                                  <p><b><u>Description of Continuous Quality Improvement Program</u></b><br/>Center for Network Therapy has a philosophy of Continuous Quality Improvement (CQI) for the
organization and a Quality Improvement program to insure the practice of a QI philosophy and
continuous improvements to the organization."?><br/>
<?php echo $data['text21']??"<b>Patient Input</b><br/>
Patient input is an important part of this process. As a patient, you will be given the opportunity
during and after treatment to provide input regarding the services you receive. You will be asked
(through the use of surveys) about the quality of care you receive as well as your satisfaction
with services. You may also complete a suggestion box at any time (located in the main lobby).
"?><br/><b>Family Member Input</b><br/>
<?php echo $data['text22']??"Often times, family members are good sources of information on how well the agency was able to
help a client. CNT may ask you to take a survey home for a family member to complete. These
surveys and suggestion cards are also available to family members in the main lobby."?>
<br><br/><b>Outcomes & Follow-up</b><br/>
<?php echo $data['text23']??"The agency is also interested in the effectiveness of the services provided; as a result, you may be
contacted after you have completed treatment. Participation is voluntary, but is encouraged.
You will be asked a few simple questions regarding your current status including alcohol/drug
use, legal status, employment status and family relationships also, Alumni Christmas Parties
invites yearly. Your responses are strictly confidential and will not be reported to any outside
sources."?>
<br><?php echo $data['text24']??"<b>How will this information be used?</b><br/>
Center for Network Therapy will use the results of patient surveys, family member surveys and
the follow-up information to gauge the efficiency and effectiveness of programming.
The agency wants to know:
<ul>
<li>“Were we able to help you?”</li>
<li>“What could we have done differently to help you more?”</li>
<li>“Were you satisfied with the services you received?”</li></ul>
The feedback received will be used to make changes within the organization to help the agency
serve the patients more effectively. Thank you"?><br/>
<?php echo $data['text25']??"
<b><u>Organizational Ethics Statement</u></b><br/>
The Center for Network Therapy management staff approves and supports the ethical provision
of assistance to patients who participate in agency services. Center for Network Therapy will not
discriminate against or refuse its services to anyone on the basis of sexual preference, race, color,
religion, national origin, age, disability, ethnicity, sexual orientation, ability to pay or notoriety of
the referral source or client.<br/>
Center for Network Therapy accurately markets and promotes itself, consistent with its mission to
eradicate substance abuse through the provision of professional interventions to individuals
seeking treatment for chemical dependency that includes drugs and alcohol.<br/>
Center for Network Therapy will make decisions regarding service expansion, collaboration, and
affiliation in a manner consistent with our mission.<br/>
Center for Network Therapy, is committed to remaining a good community citizen with
sensitivity to the impact our decisions may have on surrounding neighborhoods.
Center for Network Therapy will not enter into any contractual or casual relationship that would
promote a conflict with our mission. Included but not limited to Conflicts of interest, exchange of
gifts, money and gratuities, personal fund raising, personal property, setting boundaries and
witnessing of documents.<br/>
Center for Network Therapy will use ethical and accepted billing practices with all patients,
regulatory agencies.<br/>The integrity of clinical decision-making is based upon the bio-psychosocial needs of the patients
and not on financial incentives.<br/>
Personal behavior and professional conduct of all Center for Network Therapy staff and
Management Team shall be held in high regard and expected from all individuals at all times.
Potential conflicts of interest shall be identified and addressed directly by all Center for
Network’s<br/>
Management Team and staff on a voluntary basis. If a conflict is identified pertaining to any
Management or staff person, it shall be addressed immediately.<br/>
The Center for Network Therapy Ethics Statement shall be communicated to all personnel and
Board members at orientation and shall be reviewed annually by all personnel. In the effort to
share the Center for Network Therapy Ethics Statement with patients and other stakeholders, the
Ethics Statement shall be posted internally and included with agency marketing literature.
Center for Network Therapy has a “no reprisal” system for personnel to use in reporting waste,
fraud, abuse and other questionable activities and practices in the form of its Management
approved Compliance Program.</p>"?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style=" font-size:20px;">
                                <?php echo $data['text26']??" <h4>THIS NOTICE DESCRIBES HOW MEDICAL AND DRUG AND ALCOHOL RELATED
INFORMATION ABOUT YOU
MAY BE USED AND DISCLOSED AND HOW YOU CAN GET ACCESS TO THIS
INFORMATION.
PLEASE REVIEW IT CAREFULLY</h4>
<p>General Information<br/>
Information regarding your health care, including payment for health care, is protected by two
federal laws: the Health<br/>
Insurance Portability and Accountability Act of 1996 (HIPAA), 42 U.S.C. § 1320d et seq., 45
C.F.R. Parts 160 & 164, and the Confidentiality Law, 42 U.S.C. § 290dd-2, 42 C.F.R. Part 2.
Under these laws, Center for Network Therapy, Inc. (CNT) may not say to a person outside CNT
that you attend the program, nor may CNT disclose any information identifying you as an alcohol
or drug abuser, or disclose any other protected information except as permitted by federal law.
CNT must obtain your written consent before it can disclose information about you for payment
purposes. For example,<br/>
CNT must obtain your written consent before it can disclose information to your health insurer in
order to be paid for services. Generally, you must also sign a written consent before CNT can
share information for treatment purposes or for health care operations. However, federal law
permits CNT to disclose information without your written permission:</p>
<ol>
    <li>Pursuant to an agreement with a business associate;</li>
    <li>For research, audit, or evaluations;</li>
    <li>To report a crime committed on CNT’s premises or against CNT staff;</li>
    <li>To medical personnel in a medical emergency;</li>
    <li>To appropriate authorities to report suspected child abuse or neglect;</li>
    <li>As allowed by a court order</li>
</ol>
<p>For example, CNT can disclose information without your consent to obtain legal or financial
services, or to another medical facility to provide health care to you, as long as there is a business
associate agreement in place.<br/><br/>Before CNT can use or disclose any information about your health in a manner that is not
described above, it must first obtain your specific written consent allowing it to make the
disclosure. You may revoke any such written consent verbally or in writing.<br/><br/><b>Note: Special revocation restrictions apply to certain releases to the criminal justice system.</b>
"?><br/><?php echo $data['text27']??"
Your Rights under HIPAA you have the right to request restrictions on certain uses and
disclosures of your health information. CNT is not required to agree to any restriction you
request, but if it does agree then it is bound by that agreement and may not use or disclose any
information, which you have restricted except as necessary in a medical emergency. You have the
right to request that we communicate with you by an alternative means or at an alternative
location. CNT will accommodate such requests that are reasonable and will not request an
explanation from you. Under HIPAA, you also have the right to inspect and copy your own health
information maintained by CNT, except to the extent that the information contains psychotherapy
notes or information compiled for use in a civil, criminal, or administrative proceeding or in other
limited circumstances. Under HIPAA, you also have the right, with some exceptions, to amend
health care information maintained in CNT’s records, and to request and receive an accounting of
disclosures of your health -related information made by CNT during the six years prior to your
request. You also have the right to receive a paper copy of this notice. We will let you know
promptly if a breach occurs that may have compromised the privacy or security of your
information. Center for Network therapy duties CNT is required by law to maintain the privacy of
your health information and to provide you with notice of its legal duties and privacy practices
with respect to your health information. CNT reserves the right to change the terms of this notice
and to make new notice provisions effective for all protected health information it maintains. The
most recent copy of this notice will be posted in the lobby of each site and will be available on
our website at <a href='http://www.recoverycnt.org/' target='_blank'>http://www.recoverycnt.org/ </a>."?><br/><?php echo $data['text28']??"
Complaints and Reporting Violations/ Contact
You may complain to CNT and the Secretary of the United States Department of Health and
Human Services if you believe your privacy rights have been violated under HIPAA. To file a
complaint or to obtain further information with CNT contact:<br/><br/>Kumar Cidambi<br/>
Privacy Officer<br/>
333 Cedar Avenue, Building, B<br/>
Middlesex, NJ, 08846<br/>
732-560-1080"?>
<br/><?php echo $data['text29']??"Complaints must be in writing and you will not be retaliated against for filing such a complaint.
Violation of the Confidentiality Law by a program is a crime. Suspected violations of the Confidentiality Law"?>
<br/><?php echo $data['text30']??"<b>NOTICE OF PRIVACY PRACTICES</b><br/>
<b>Effective Date: September 23, 2013</b><br/>
THIS NOTICE DESCRIBES HOW MEDICAL INFORMATION ABOUT YOU MAY BE USED AND
DISCLOSED AND HOW YOU CAN GET ACCESS TO THIS INFORMATION.
PLEASE REVIEW IT CAREFULLY."?>
<br/><?php echo $data['text31']??"If you have any questions about this Notice, please contact:<br/>
<b>Eddie Mann LSW, MSW, LCADC,CCS, Clinical Director</b><br/>
<b>Phone: 732-560-1080 Address: 333 Cedar Avenue Building B, Middlesex NJ 08846 at cntdirector@gmail.com</b></p>"?>
                                </td>
                            </tr>                            
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text32']??"
                                    <h4><u>OUR DUTIES</u></h4>
                                    <p>At the Center for Network Therapy, we are committed to protecting your health information and
safeguarding that information against unauthorized use or disclosure. This Notice will tell you
how we may use and disclose your health information. It also describes your rights and the
obligations we have regarding the use and disclosure of your health information.
We are required by law to: 1) maintain the privacy of your health information; 2) provide you
Notice of our legal duties and privacy practices with respect to your health information; 3) to
abide by the terms of the Notice that is currently in effect; and 4) to notify you if there is a breach
of your unsecured health information.</p>
<p>HOW WE MAY USE AND DISCLOSE YOUR PERSONAL HEALTH INFORMATION
We receive health information about you. We may receive, use or share that health information
for such activities as payment for services provided to you, conducting our internal health care
operations, communicating with your healthcare providers about your treatment and for other
purposes permitted or required by law. The following are examples of the types of uses and
disclosures of your personal information that we are permitted to make:</p>"?><?php echo $data['text33']??"
<p><b><u>Payment</u></b> - We may use or disclose information about the services provided to you and payment
for those services for payment activities such as confirming your eligibility, obtaining payment
for services, managing your claims, utilization review activities and processing of health care
data.</p>"?><?php echo $data['text34']??"
<p><b><u>Health Care Operations</u></b> - We may use your health information to train staff, manage costs,
conduct quality review activities, perform required business duties, and improve our services and
business operations.</p>"?><?php echo $data['text35']??"
<p><b><u>Treatment</u></b> - We may share your personal health information with your health care providers to
assist in coordinating your care.</p>"?><?php echo $data['text36']??"
<p><b><u>Other Uses and Disclosures</u></b> - We may also use or disclose your personal health information for
the following reasons as permitted or required by applicable law: To alert proper authorities if we
reasonably believe that you may be a victim of abuse, neglect, domestic violence or other crimes;
to notify pubic or private entity authorized by law or charter to assist in disaster relief efforts, for
the purpose of coordinating family notifications; to reduce or prevent threats to public health and
safety; for health oversight activities such as evaluations, investigations, audits, and inspections;
to governmental agencies that monitor your services; for lawsuits and similar proceedings; for
public health purposes such as to prevent the spread of a communicable disease; for certain
approved research purposes; for law enforcement reasons if required by law or in regards to a
crime or suspect; to correctional institutions in regards to inmates; to coroners, medical examiners
and funeral directors (for decedents); as required by law; for organ and tissue donation; for
specialized government functions such as military and veterans activities, national security and
intelligence purposes, and protection of the President; for Workers’ Compensation purposes; for
the management and coordination of public benefits programs; to respond to requests from the
U.S. Department of Health and Human Services; and for us to receive assistance from consultants
that have signed an agreement requiring them to maintain the confidentiality of your personal
information. Also, if you have a guardian or a power of attorney, we are permitted to provide
information to your guardian or attorney in fact.</p>"?><?php echo $data['text37']??"
<p><b><u>Uses and Disclosures That Require Your Permission</u></b>
We are prohibited from selling your personal information, such as to a company that wants your
information in order to contact you about their services, without your written permission.We are prohibited from using or disclosing your personal information for marketing purposes,
such as to promote our services, without your written permission.
All other uses and disclosures of your health information not described in this Notice will be
made only with your written permission. If you provide us permission to use or disclose health
information about you, you may revoke that permission, in writing, at any time. If you revoke
your permission, we will no longer use or disclose your health information for the purposes state
in your written permission except for those that we have already made prior to your revoking that
permission.</p>"?><?php echo $data['text38']??"
<p><b><u>Prohibited Uses and Disclosures</b></u><br/>
If we use or disclose your health information for underwriting purposes, we are prohibited from
using and disclosing the genetic information in your health information for such purposes.</p>
"?><?php echo $data['text39']??"<p><b><u>POTENTIAL IMPACT OF OTHER APPLICABLE LAWS</b></u><br/>
If any state or federal privacy laws require us to provide you with more privacy protections than
those explained here, then we must also follow that law. For example, drug and alcohol treatment
records generally receive greater protections under federal law.</p>"?>
                                </td>
                            </tr>
                                                       
                            <tr>
                                <td style=" font-size:20px;"><?php echo $data['text40']??"
                                    <h4><u>YOUR RIGHTS REGARDING YOUR PERSONAL HEALTH INFORMATION</u></h4>
                                    <p>You have the following rights regarding your health information:</p>
                                    <ul>
                                        <li>Right to Request Restrictions. You have the right to request that we restrict the information we
use or disclose about you for purposes of treatment, payment, health care operations and
informing individuals involved in your care about your care or payment for that care. We will
consider all requests for restrictions carefully but are not required to agree to any requested
restrictions.*</li>
                                        <li>Right to Request Confidential Communications. You have the right to request that when we
need to communicate with you, we do so in a certain way or at a certain location. For example,
you can request that we only contact you by mail or at a certain phone number.</li>
                                        <li>Right to Inspect and Copy. You have the right to request access to certain health information we
have about you. Fees may apply to copied information.*</li>
                                        <li>Right to Amend. You have the right to request corrections or additions to certain health
information we have about you. You must provide us with your reasons for requesting the
change.*</li>
                                        <li>Right to An Accounting of Disclosures. You have the right to request an accounting of the
disclosures we make of your health information, except for those made with your permission and
those related to treatment, payment, our health care operations, and certain other purposes. Your
request must include a timeframe for the accounting, which must be within the six years prior to
your request. The first accounting is free but a fee will apply if more than one request is made in a
12-month period.*</li>
                                        <li>To exercise rights marked with a star (*), your request must be made in writing.
Please contact us if you need assistance.</li>
                                    </ul>"?>
                                </td>
                            </tr> 
                            <tr><td style=" font-size:22px;"><?php echo $data['text41']??"
                            <h4><u>CHANGES TO THIS NOTICE</u></h4><br/>
We reserve the right to change this Notice at any time. We reserve the right to make the
revised Notice effective for health information we already have about you as well as any
information we receive in the future. We will post a copy of our current Notice at our
office and on our website at: www.RecoveryCNT.com. In addition, each time there is a
change to our Notice, you will receive information about the revised Notice and how you
can obtain a copy of it. Information will be
posted on our website, and provided through the agency to which you receive services.
The effective date of each Notice is listed on the first page in the top center.<br>
"?>
                            </td>
                            </tr> 
                            <tr><td style="font-size:22px;">
                            <?php echo $data['text42']??"
                            <p><u><b>Seclusion and Restraint</b></u></p>
                            <h5><b>POLICY:</b></h5>
<p>It is the policy of Center for Network Therapy based on the philosophy of the
agency, not to use any restraint or seclusion techniques with clients.</p>"?>
<?php echo $data['text43']??"
<h5><b>PROCEDURE:</b></h5>
<ol>
    <li>Physical restrains of patients will not be used as a therapeutic or intervention technique
within the Agency.</li>
    <li>Seclusion will not be used as a therapeutic or intervention technique within the
Agency.</li>
    <li>All Staff will be trained in anger de-escalation as an intervention technique within the
Agency.</li>
    <li>In the event that de-escalation is not appropriate or is ineffective, staff will call 911.</li>
    <li>If a patient or community member becomes combative or violent before the
police/sheriff arrives, staff members have the right to protect themselves against
aggressive person(s).</li>
    <li>All events, which necessitate calling 911, will be reported to a supervisor, reported to
the Rutgers, UBHC, Acute Psychiatric Services(via a supervisor) and an
incident report will be completed by the end of the next working day.</li>
</ol>"?>
                            </td>
                            </tr> 
                            <tr>
                                <td style=" font-size:22px;">
                                <?php echo $data['text44']??"
<h5><u><b>Opiate Withdrawal</b></u></h5>
<p>URL of this page: <a href='http://www.nlm.nih.gov/medlineplus/ency/article/000949.htm' target='_blank'>http://www.nlm.nih.gov/medlineplus/ency/article/000949.htm</a>
Opiate withdrawal refers to the wide range of symptoms that occur after stopping or
dramatically reducing opiate drugs after heavy and prolonged use (several weeks or
more). Opiate drugs include heroin, morphine, codeine, Oxycontin, Dilaudid,
methadone, and others.<p>"?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-size:22px;">
                                <?php echo $data['text45']??"
                               <b> Causes</b>
<p>About 9% of the population is believed to misuse opiates over the course of their lifetime,
including illegal drugs like heroin and prescribed pain medications such as Oxycontin. These
drugs can cause physical dependence. This means that a person relies on the drug to prevent
symptoms of withdrawal. Over time, greater amounts of the drug become necessary to produce
the same effect. The time it takes to become physically dependent varies with each individual.
When the drugs are stopped, the body needs time to recover, and withdrawal symptoms result.
Withdrawal from opiates can occur whenever any chronic use is discontinued or reduced. Some
people even withdraw from opiates after being given such drugs for pain while in the hospital
without realizing what is happening to them. They think they have the flu, and because they do
not know that opiates would fix the problem, they do not crave the drugs.</p>"?>
<p><b>Symptoms</b></p><?php echo $data['text46']??"
<p>Early symptoms of withdrawal include:</p>
<ul>
<li>Agitation</li>
<li>Anxiety</li>
<li>Muscle aches</li>
<li>Increased tearing</li>
<li>Insomnia</li>
<li>Runny nose</li>
<li>Sweating</li>
<li>Yawning
Late symptoms of withdrawal include:</li>
<li>Abdominal cramping</li>
<li>Diarrhea</li>
<li>Dilated pupils</li>
<li>Goose bumps</li>
<li>Nausea</li>
<li>Vomiting</li>
</ul>"?>
<?php echo $data['text47']??"
<p>Opioid withdrawal reactions are very uncomfortable but are not life threatening.
Symptoms usually start within 12 hours of last heroin usage and within 30 hours of last
methadone exposure.<br/>EDUCATIONAL INFORMATION ON HIV/AIDS, TB, Hepatitis & Other Infectious Diseases<br/>
Viral Hepatitis C<br/><br/>
Fact Sheet<br/>
SIGNS & SYMPTOMS<br/>"?><?php echo $data['text48']??"
80% of persons have no signs or symptoms<br/>
Jaundice<br/>
Fatigue<br/>
Dark urine<br/>
Abdominal pain<br/>
Loss of appetite<br/>
Nausea"?><br/><?php echo $data['text49']??"
CAUSE Hepatitis C Virus (HCV)<br/>
LONG-TERM EFFECTS<br/>
Chronic infection: 75-85% of infected persons<br/>
Chronic liver disease: 70% of chronically infected persons<br/>
Deaths from chronic liver disease: <3% <br/>Leading indication for liver transplant</p>"?>
                                </td>
                            </tr>
                            <tr><td style="font-size:22px;"><?php echo $data['text50']??"
                                <h5><b>TRANSMISSION</b></h5>
                                <p>Recommendations for testing based on risk for HCV infection
Occurs when blood or body fluids from an infected person enters the body of a person who is not infected. HCV
is spread through sharing needles or “works” when “shooting” drugs, through needle sticks or sharps exposures
on the job, or from an infected mother to her baby during birth. Persons at risk for HCV infection might also be
at risk for infection with hepatitis B virus (HBV) or HIV.
Recommendations for Testing Based on Risk for HCV Infection</p>"?><?php echo $data['text51']??"
<h4><b><u>PERSONS RISK OF INFECTION TESTING RECOMMENDED?
</u></b></h4>
    <p>Injecting drug users High Yes<br/>
Recipients of clotting factors<br/>
Made before 1987 High Yes<br/>
Hemodialysis patients Intermediate Yes<br/>
Recipients of blood and/or<br/>
Solid organs before 1992 Intermediate Yes<br/>
People with undiagnosed liver<br/>
Problems Intermediate Yes<br/>
Infants born to infected mothers Intermediate After 12-18 months old<br/>
Healthcare/public safety workers Low only after known exposure<br/>
People having sex with multiple<br/>
Partners Low No*<br/>
People having sex with an<br/>
Infected steady partner Low No*<br/>
*Anyone who wants to get tested should ask their doctor.</p>"?>
<?php echo $data['text52']??"
<h4><b><u>PREVENTION</u></b></h4>
<p>There is no vaccine to prevent hepatitis C.<br/>
 Do not shoot drugs; if you shoot drugs, stop and get into a treatment program; if you can’t stop,
never share needles, syringes, water, or “works”, and get vaccinated against hepatitis A & B.
Do not share personal care items that might have blood on them (razors, toothbrushes).</p>
If you are a health care or public safety worker, always follow routine barrier precautions and
safely handle needles and other sharps; get vaccinated against hepatitis B.
Consider the risk if you are thinking about getting a tattoo or body piercing. You might get
infected if the tools have someone else’s blood on them or if the artist or piercer does not follow
good health practices.</p>
<p>HCV can be spread by sex, but this is rare. If you are having sex with more than one steady sex
partner, use latex condoms* correctly and every time to prevent the spread of sexually transmitted
diseases. You should also get vaccinated against hepatitis B.
If you are HCV positive, do not donate blood, organs, or tissue.</p>"?>
<?php echo $data['text53']??"
<h4><b><u>TREATMENT & MEDICAL MANAGEMENT</u></b></h4>
HCV positive persons should be evaluated by their doctor for liver disease.
Interferon and ribavirin are two drugs licensed for the treatment of persons with chronic hepatitis
C. Interferon can be taken alone or in combination with ribavirin. Combination therapy is
currently the treatment of choice. Combination therapy can get rid of the virus in up to 4 out of
10 persons. Drinking alcohol can make your liver disease worse."?>
<?php echo $data['text54']??"
<h4><b><u>STATISTICS & TRENDS</u></b></h4>
Number of new infections per year has declined from an average of 240,000 in the 1980s to about
40,000 in 1998.<br/>
Most infections are due to illegal injection drug use.<br/>
Transfusion-associated cases occurred prior to blood donor screening; now occurs in less than
one per million transfused unit of blood.<br/>
Estimated 3.9million (1.8%) Americans have been infected with HCV, of whom 2.7 million are
chronically infected."?>
</td>
                            </tr>
</tbody>
</table>
<table style="width:100%;">
<tbody>
                            <tr><td ><?php echo $data['text55']??"
                            <h4>Viral Hepatitis B</h4><br/>
<h4>Fact Sheet</h4><br/>
<h4>SIGNS &  SYMPTOMS</h4><br/>
About 30% of persons have no signs or symptoms.<br/>
Signs and symptoms are less common in children than adults<br/>
*Jaundice *loss of appetite *fatigue<br/>
*nausea, vomiting *abdominal pain *joint pain<br/>"?>
<?php echo $data['text56']??"
<h4>CAUSE</h4>
Hepatitis B virus (HBV)<br/><br/>
<h4>LONG-TERM EFFECTS WITHOUT VACCINATION</h4>
Chronic infection occurs in:
<ul>
<li>90% of infants infected at birth</li>
<li>30% of children infected at age 1-5 years</li>
<li>6% of persons infected after age 5 years
Death from chronic liver disease occurs in:</li>
<li>15-25% of chronically infected persons</li></ul>
"?>
                            </td></tr>
                            <tr>
                                <td><?php echo $data['text57']??"
                                <h5><b><u>TRANSMISSION</u></b></h5>
<ul>
<li>Occurs when blood or body fluids from an infected person enter the body of a person who is
not immune.</li>
<li>HBV is spread through having sex with an infected person without using a condom (the
efficacy of latex condoms in preventing infection with HBV is unknown, but their proper use
may reduce transmissions), sharing needles or “works” when “shooting” drugs, through
needle sticks or sharps exposures on the job, or from infected mother to her baby
Persons at risk for HBV infection might also be at risk for infection with hepatitis C virus (HCV) or HIV.</li> </ul>
"?><?php echo $data['text58']??"
<h5><b><u>RISK GROUPS</u></b></h5>
<ul>
<li>Persons with multiple sex partners or diagnosis of a sexually transmitted disease</li>
<li>Men who have sex with men</li>
<li>Sex contacts of infected persons</li>
<li>Injection drug users</li>
<li>Household contacts of chronically infected persons</li>
<li>Infants born to infected mothers</li>
<li>Infants/children of immigrants from areas with high rates of HBV infection</li>
<li>Health care and public safety workers</li>
<li>Hemodialysis patients</li></ul>"?>
                                 </td>
                                
                            </tr>
                            <tr>
                                <td>
                                <h5><b><u>PREVENTION</u></b></h5><?php echo $data['text59']??"
<ul>
<li>Hepatitis B vaccine is the best protection.</li>
<li>If you are having sex, but not with one steady partner, use latex condoms correctly and every
time you have sex. The efficacy of latex condoms in preventing infection with HBV is
unknown, but their proper use may reduce transmission.</li>
<li>If you are pregnant, you should get a blood test for hepatitis B; infants born to HBV-infected
mothers should be given HBIG (hepatitis B immune globulin) and vaccine within 12 hours after birth.</li>
<li>Do not shoot drugs; if you shoot drugs, stop and get into a treatment program; if you cannot
stop, never share needles, syringes, water, or “works”, and get vaccinated against hepatitis A
and B.</li>
<li>Do not share personal care items that might have blood on them (razors, toothbrushes).</li>
<li>Consider the risks if you are thinking about getting a tattoo or body piercing. You might get
infected if the tools have someone else’s blood on them or if the artists or piercer does not
follow good health practices.</li>
<li>If you have or had hepatitis B, do not donate blood, organs or tissue.</li>
<li>If you are a health care or public safety worker, get vaccinated against hepatitis B, and always
follow routine barrier precautions and safely handle needles and other sharps.</li>
</ul>"?>
                                 </td>
                                
                            </tr>
                            <tr>
                                <td>
                                <h5><b><u>VACCINE RECOMMENDATIONS</u></b></h5>
                                <?php echo $data['text60']??"
<ul>
<li>Hepatitis B vaccine available since 1982</li>
<li>Routine vaccination of 0-18 year olds</li>
<li>Vaccination of risk groups of all ages (see section on risk groups) </li>  
</ul>"?>
<h5><b><u>TREATMENT & MEDICAL MANAGEMENT (National Institutes of Health fact sheet on treatment)</u></b></h5>

<?php echo $data['text61']??"
<ul><li>HBV infected persons should be evaluated by their doctor for liver disease.</li>
<li>Alpha interferon and lamivudine are two drugs licensed for the treatment of persons with
chronic hepatitis B. These drugs are effective in up to 40% of patients.</li>
<li>These drugs should not be used by pregnant women.</li>
<li>Drinking alcohol can make your liver disease worse.</li></ul>"?>
                                 </td>
                                
                            </tr>
                            <tr>
                                <td>
                                <h5><b><u>TRENDS & STATISTICS</u></b></h5>
                                <?php echo $data['text62']??"
<ul>
<li>Number of new infections per year has declined from an average of 450,000 in the 1980s to
about 80,000 in 1999.</li>
<li>Highest rate of disease occurs in 20-49 year olds.</li>
<li>Greatest decline has happened among children and adolescents due to routine hepatitis B
vaccination.</li>
<li>Estimated 1.25 million chronically infected Americans, of whom 20-30% acquired their
infection childhood.
G:\FORMS\General Client\Client Orientation Handbook.docx 28of 31
Revised 10.4.13</li></ul>"?>
                                 </td>
                                
                            </tr>
                            <tr>
                                <td>
                                <b>What is a sexually transmitted infection (STI)?</b><br/>
<?php echo $data['text63']??"It is an infection passed from person to person through intimate sexual contact. STIs are also called sexually transmitted
diseases, or STDs."?><br/>

<b>How do you get an STI?</b><br/>
<?php echo $data['text64']??"
You can get an STI by having intimate sexual contact with someone who already has the infection. You can’t tell if a person is
infected because many STIs have no symptoms. But STIs can still be passed from person to person even if there are no
symptoms. STIs are spread during vaginal, anal, or oral sex or during genital touching. So it’s possible to get some STIs
without having intercourse. Not all STIs are spread the same way."?><br/>

<?php echo $data['text65']??"
<b>Can STIs cause health problems?</b><br/><br/>
Yes. Each STI causes different health problems. But overall, untreated STIs can cause cancer,  pelvic inflammatory disease ,
infertility, pregnancy problems, widespread infection to other parts of the body, organ damage, and even death.<br/><br/>
Having an STI also can put you at greater risk of getting HIV. For one, not stopping risky sexual behavior can lead to infection
with other STIs, including HIV. Also, infection with some STIs makes it easier for you to get HIV if you are exposed."?><br/>
<b>What are the symptoms of STIs?</b><br/>
<?php echo $data['text66']??"
Many STIs have only mild or no symptoms at all. When symptoms do develop, they often are mistaken for something else,
such as  urinary tract infection  or  yeast infection . This is why screening for STIs is so important. The STIs listed here are among
the most common or harmful to women."?>
                                 </td>
                                
                            </tr>
                        </tbody>
                    </table>
                    <br/><br/>
                    <table style="width:100%;table-layout:fixed;display:table;"> 
                        <tbody>
                            <tr>
                                <td>
                                    <p><b>Symptoms of sexually transmitted infections</b></p>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;table-layout:fixed;display:table;"> 
                        <tbody>
                            <tr>
                                <td style="width:20%;">
                                Bacterial
vaginosis (BV)
                                </td>
                                <td style="width:60%;">
                                Most women have no symptoms. Women with symptoms may have:
                                </td>
                                <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> <li>Vaginal itching</li>
                               <li> Pain when urinating</li>
                               <li>Discharge with a fishy odor</li></ul>
                                </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                Chlamydia
                                </td>
                                <td style="width:60%;">
                                Most women have no symptoms. Women with symptoms may have:
                                </td>
                                <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> <li>Abnormal vaginal discharge</li>
                               <li> Burning when urinating</li>
                               <li>Bleeding between periods</li></ul>
                                </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                 </td>
                                <td style="width:60%;">
                                Infections that are not treated, even if there are no symptoms, can lead to:
                                </td>
                                <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> <li>Lower abdominal pain</li>
                               <li> Low back pain</li>
                               <li>Nausea</li>
                               <li>Fever</li>
                               <li>Pain during sex</li>

                            </ul>
                                </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                Genital herpes
                                 </td>
                                <td style="width:60%;">
                                Some people may have no symptoms. During an “outbreak,” the symptoms are clear:
                                </td>
                                <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> <li>Small red bumps, blisters, or open sores where the virus entered the body, such as on the penis,
vagina, or mouth</li>
                               <li> Vaginal discharge</li>
                               <li>Fever</li>
                               <li>Headache</li>
                               <li>Muscle aches</li>
                               <li>Pain when urinating</li>
                               <li>Itching, burning, or swollen glands in genital area</li>
                               <li>Pain in legs, buttocks, or genital area</li>

                            </ul>
                                </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                  </td>
                                <td style="width:60%;">
                                Symptoms may go away and then come back. Sores heal after 2 to 4 weeks.                                </td>
                                <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                Gonorrhea
                                 </td>
                                <td style="width:60%;">
                                Symptoms are often mild, but most women have no symptoms. If symptoms are present, they most often

appear within 10 days of becoming infected. Symptoms are:  </td>                              </td>
                                <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> <li>Pain or burning when urinatingn</li>
                               <li> Yellowish and sometimes bloody vaginal discharge</li>
                               <li>Bleeding between periods</li>
                               <li>Pain during sex</li>
                               <li>Heavy bleeding during periods</li>

                            </ul> 
                            Infection that occurs in the throat, eye, or anus also might have symptoms in these parts of the body.
                                </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                Hepatitis B                                 </td>
                                <td style="width:60%;">
                                Some women have no symptoms. Women with symptoms may have:</td>
                                 <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> 
                              <li> Low-grade fever</li>
                                <li> Headache and muscle aches</li>
                                <li> Tiredness</li>
                                <li> Loss of appetite</li>
                                <li> Upset stomach or vomiting</li>
                                <li> Diarrhea</li>
                                <li> Dark-colored urine and pale bowel movements</li>
                                <li> Stomach pain</li>
                                <li> Skin and whites of eyes turning yellow</li>
                            </ul> 
                                 </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                HIV/AIDS                                
                            </td>
                                <td style="width:60%;">
                                Some women may have no symptoms for 10 years or more. About half of people with HIV get flu-like
symptoms about 3 to 6 weeks after becoming infected. Symptoms people can have for months or even years
before the onset of AIDS include:</td>
                                 <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> 
<li> Fevers and night sweats</li>
<li> Feeling very tired</li>
<li> Quick weight loss</li>
<li> Headache</li>
<li> Enlarged lymph nodes</li>
<li> Diarrhea, vomiting, and upset stomach</li>
<li> Mouth, genital, or anal sores</li>
<li> Dry cough</li>
<li> Rash or flaky skin</li>
<li> Short-term memory loss</li>
                            </ul> 
                            Women also might have these signs of HIV:
                            <ul> 
<li>Vaginal yeast infections and other vaginal infections, including STIs</li>
    <li>Pelvic inflammatory disease  (PID) that does not get better with treatment</li>
        <li>Menstrual cycle changes</li></ul>
                                 </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                Human
papillomavirus
(HPV)                            </td>
                                <td style="width:60%;">
                                Some women have no symptoms. Women with symptoms may have:
                                </td>
                                 <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> 
                               <li>Visible warts in the genital area, including the thighs. Warts can be raised or flat, alone or in
groups, small or large, and sometimes they are cauliflower-shaped.</li>
<li> Growths on the  cervix  and  vagina  that are often invisible.</li>
                               </ul>
 
                                 </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                Pubic lice
(sometimes called
"crabs" )                           </td>
                                <td style="width:60%;">
                                Symptoms include:
                                </td>
                                 <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> 
                               <li>Itching in the genital area</li>
<li> Finding lice or lice eggs</li>
                               </ul>
 
                                 </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                Syphilis     
                            </td>
                                <td style="width:60%;">
                                Syphilis progresses in stages. Symptoms of the primary stage are:<br><br/>A single, painless sore appearing 10 to 90 days after infection. It can appear in the genital area,
mouth, or other parts of the body. The sore goes away on its own.<br/><br/>If the infection is not treated, it moves to the secondary stage. This stage starts 3 to 6 weeks after the sore
appears. Symptoms of the secondary stage are:<br/><br/>Skin rash with rough, red or reddish-brown spots on the hands and feet that usually does not itch and
clears on its own
                                </td>
                                 <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> 
                               <li>Fever</li>
                               <li>Sore throat and swollen glands</li>
                               <li>Patchy hair loss</li>
                               <li>Headaches and muscle aches</li>
                               <li>Weight loss</li>
                               <li>Tiredness</li>
                                </ul>
                                In the latent stage, symptoms go away, but can come back. Without treatment, the infection may or
may not move to the late stage. In the late stage, symptoms are related to damage to internal organs,
such as the brain, nerves, eyes, heart, blood vessels, liver, bones, and joints. Some people may die.
                                 </td>
                                <td>
                          
                          </td>
                            </tr>
                            <tr>
                                <td style="width:20%;">
                                Trichomoniasis
(sometimes called
"trich")     
                            </td>
                                <td style="width:60%;">
                                Many women do not have symptoms. Symptoms usually appear 5 to 28 days after exposure and can include:
                                </td>
                                 <td style="width:20%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                          
                                </td>
                                <td>
                               <ul> 
                               <li>Yellow, green, or gray vaginal discharge (often foamy) with a strong odor</li>
                               <li>Discomfort during sex and when urinating</li>
                               <li>Itching or discomfort in the genital area</li>
                               <li>Lower abdominal pain (rarely)</li>
                                
                                </ul>
                                 
                                 </td>
                                <td>
                          
                          </td>
                            </tr>
                        </tbody>
                    </table>
                    <br/> 
                    <table style="width:100%;table-layout:fixed;display:table;overflow:wrap;"> 
<tbody>
    <tr>
        <td>
            <p><b>How do you get tested for STIs?</b></p>
        </td>
        
    </tr>
    <tr>
        <td  >
            <p><b>Tests for reproductive health</b></p>
            <?php echo $data['text67']??"
            <p>There is no one test for all STIs. Testing for STIs is also called STI screening. Testing (or screening) for STIs can involve:</p>
            <ul>
                <li>Pelvic and physical exam — Your doctor can look for signs of infection, such as warts, rashes, discharge.</li>
                <li>Blood sample</li>
                <li>Urine sample</li>
                <li>Fluid or tissue sample —  A swab is used to collect a sample that can be looked at under a microscope or sent to a lab for testing.</li>
            </ul>
            <p>These methods are used for many kinds of tests. So if you have a pelvic exam and  Pap test , for example, don’t assume that you
have been tested for STIs. Pap testing is mainly used to look for cell changes that could be cancer or precancerous. Although a
Pap test sample also can be used to perform tests for HPV, doing so isn’t routine. And a Pap test does not test for other STIs. If
you want to be tested for STIs, including HPV, you must ask.</p>
<p>You can get tested for STIs at your doctor’s office or a clinic. But not all doctors offer the same tests. So it’s important to
discuss your sexual health history to find out what tests you need and where you can go to get tested.</p>"?>
<br/>
<p><b>Who needs to get tested for STIs?</b></p>
<p><b>Screening tests</b></p>
<p><b>Find out what screening tests you might need</b></p>
<?php echo $data['text68']??"
<p>If you are sexually active, talk to your doctor about STI screening. Which tests you might need and how often depend mainly
on your sexual history and your partner’s. Talking to your doctor about your sex life might seem too personal to share. But
being open and honest is the only way your doctor can help take care of you. Also, don’t assume you don’t need to be tested for
STIs if you have sex only with women. Talk to your doctor to find out what tests make sense for you.</p>"?>
<p><b>How are STIs treated?</b></p>
<?php echo $data['text69']??"
<p>The treatment depends on the type of STI. For some STIs, treatment may involve taking medicine or getting a shot. For other
STIs that can’t be cured, like herpes, treatment can help to relieve the symptoms.</p>
<p>Only use medicines prescribed or suggested by your doctor. There are products sold over the Internet that falsely claim to
prevent or treat STIs, such as herpes, chlamydia, human papillomavirus, and HIV. Some of these drugs claim to work better
than the drugs your doctor will give you. But this is not true, and the safety of these products is not known.</p>"?><br/>
<p><b>What can I do to keep from getting an STI?</b></p>
<?php echo $data['text70']??"
<p>You can lower your risk of getting an STI with the following steps. The steps work best when used together. No single strategy
can protect you from every single type of STI.</p>
<ul>
<li>Don’t have sex. The surest way to keep from getting any STI is to practice abstinence. This means not having
vaginal, oral, or anal sex. Keep in mind that some STIs, like genital herpes, can be spread without having
intercourse.</li>
<li>Be faithful. Having a sexual relationship with one partner who has been tested for STIs and is not infected is
another way to lower your risk of getting infected. Be faithful to each other. This means you only have sex with
each other and no one else.</li>
<li>Use condoms correctly and every time you have sex. Use condoms for all types of sexual contact, even if
intercourse does not take place. Use condoms from the very start to the very end of each sex act, and with every sex
partner. A male latex condom offers the best protection. You can use a male polyurethane condom if you or your
partner has a latex allergy. For vaginal sex, use a male latex condom or a female condom if your partner won’t wear a condom. For anal sex, use a male latex condom. For oral sex, use a male latex condom. A  dental dam  might also
offer some protection from some STIs.</li>
<li>Know that some methods of birth control, like birth control pills, shots, implants, or diaphragms, will not
protect you from STIs. If you use one of these methods, be sure to also use a condom correctly every timeyou have
sex.</li>
<li>Talk with your sex partner(s) about STIs and using condoms before having sex. It’s up to you to set the ground
rules and to make sure you are protected.</li>
<li>Don’t assume you’re at low risk for STIs if you have sex only with women. Some common STIs are spread
easily by skin-to-skin contact. Also, most women who have sex with women have had sex with men, too. So a
woman can get an STI from a male partner and then pass it to a female partner.</li>
<li>Talk frankly with your doctor and your sex partner(s) about any STIs you or your partner has or has
had. Talk about symptoms, such as sores or discharge. Try not to be embarrassed. Your doctor is there to help you
with any and all health problems. Also, being open with your doctor and partner will help you protect your health
and the health of others.</li>
<li>Have a yearly pelvic exam. Ask your doctor if you should be tested for STIs and how often you should be retested.
Testing for many STIs is simple and often can be done during your checkup. The sooner an STI is found, the easier
it is to treat.</li>
<li>Avoid using drugs or drinking too much alcohol. These activities may lead to risky sexual behavior, such as not
wearing a condom.</li>
</ul>"?>
<b>How do STIs affect pregnant women and their babies?</b>
<?php echo $data['text71']??"
<p>STIs can cause many of the same health problems in pregnant women as women who are not pregnant. But having an STI also
can threaten the pregnancy and unborn baby's health. Having an STI during pregnancy can cause early labor, a woman's water
to break early, and infection in the  uterus  after the birth.</p>
<p>Some STIs can be passed from a pregnant woman to the baby before and during the baby’s birth. Some STIs, like syphilis,
cross the  placenta  and infect the baby while it is in the uterus. Other STIs, like gonorrhea, chlamydia, hepatitis B, and genital
herpes, can be passed from the mother to the baby during delivery as the baby passes through the birth canal. HIV can cross the
placenta during pregnancy and infect the baby during the birth process.</p>
<p>The harmful effects to babies may include:</p>
</td>
                            </tr>
                        </tbody>
                    </table>
                    <table style='width:100%;table-layout:fixed;display:table;'> 
                        <tbody>
                            <tr>
                                <td>
                                <ul>
<li>Low birth weight</li>
<li>Eye infection</li>
<li>Pneumonia</li>
<li>Infection in the baby’s blood</li>
<li>Brain damage</li>
<li>Lack of coordination in body movements</li>
<li>Blindness</li>
<li>Deafness</li>
<li>Acute  hepatitis</li>
<li>Meningitis</li>
<li>Chronic liver disease</li>
<li>Cirrhosis</li>
<li>Stillbirth</li>
</ul>
<p>Some of these problems can be prevented if the mother receives routine prenatal care, which includes screening tests for STIs
starting early in pregnancy and repeated close to delivery, if needed. Other problems can be treated if the infection is found at
birth.</p>"?>
<b>What can pregnant women do to prevent problems from STIs?</b><?php echo $data['text72']??"
<p>Pregnant women should be screened at their first prenatal visit for STIs, including:</p>
<ul>
<li>Chlamydia</li>
<li>Gonorrhea</li>
<li>Hepatitis B</li>
<li>HIV</li>
<li>Syphilis</li>
</ul>
<p>In addition, some experts recommend that women who have had a premature delivery in the past be screened and treated for
bacterial vaginosis (BV) at the first prenatal visit. Even if a woman has been tested for STIs in the past, she should be tested
again when she becomes pregnant.</p>
<p>Chlamydia, gonorrhea, syphilis, trichomoniasis, and BV can be treated and cured with antibiotics during pregnancy. Viral STIs,
such as genital herpes and HIV, have no cure. But antiviral medication may be appropriate for some pregnant woman with
herpes to reduce symptoms. For women who have active genital herpes lesions at the onset of labor, a cesarean delivery  (C-
section) can lower the risk of passing the infection to the newborn. For women who are HIV positive, taking antiviral
medicines during pregnancy can lower the risk of giving HIV to the newborn to less than 2 percent. C-section is also an option
for some women with HIV. Women who test negative for hepatitis B may receive the hepatitis B vaccine during pregnancy.</p>
<p>Pregnant women also can  take steps  to lower their risk of getting an STI during pregnancy.</p>
<p>Do STIs affect breastfeeding?</p>
<p>Did you know?</p>
<p>If you have HIV, do not breastfeed. You can pass the virus to your baby.</p>
<p>Talk with your doctor, nurse, or a lactation consultant about the risk of passing the STI to your baby while breastfeeding. If you
have chlamydia or gonorrhea, you can keep breastfeeding. If you have syphilis or herpes, you can keep breastfeeding as long as
the sores are covered. Syphilis and herpes are spread through contact with sores and can be dangerous to your newborn. If you
have sores on your nipple or  areola , stop breastfeeding on that breast. Pump or hand express your milk from that breast until the
sore clears. Pumping will help keep up your milk supply and prevent your breast from getting engorged or overly full. You can
store your milk to give to your baby in a bottle for another feeding. But if parts of your breast pump that contact the milk also
touch the sore(s) while pumping, you should throw the milk away.</p>
<p>If you are being treated for an STI, ask your doctor about the possible effects of the drug on your breastfeeding baby. Most
treatments for STIs are safe to use while breastfeeding.</p>
                                </td></tr>
                                <tr>
                                <td>
                                <p>Is there any research being done on STIs?</p>
<p>Yes. Research on STIs is a public health priority. Research is focused on prevention, diagnosis, and treatment.</p>
<p>With prevention, researchers are looking at strategies such as vaccines and topical microbicides (meye-KROH-buh-syds). One
large study is testing a herpes vaccine for women. Topical microbicides could play a big role in protecting women from getting
STIs. But so far, they have been difficult to design. They are gels or creams that would be put into the vagina to kill or stop the
STI before it could infect someone. Researchers are also looking at the reasons some people are at higher risk of STIs, and
ways to lower these risks.</p>
<p>Early and fast diagnosis of STIs means treatment can start right away. Early treatment helps to limit the effects of an STI and
keep it from spreading to others. Researchers are looking at quick, easy, and better ways to test for STIs, including vaginal swabs women can use to collect a sample for testing. They also are studying the reasons why many STIs have no symptoms,
which can delay diagnosis.</p>
<p>Research also is underway to develop new ways to treat STIs. For instance, more and more people are becoming infected with
types of gonorrhea that do not respond well to drugs. So scientists are working to develop new antibiotics to treat these drug-
resistant types. An example of treatment research success is the life-prolonging effects of new drugs used to treat HIV.</p>
"?>
<p><b>More information on sexually transmitted infections (STI)</b></p>
<p>For more information about sexually transmitted infections (STI), call womenshealth.gov at 800-994-9662 (TDD: 888-220-
5446) or contact the following organizations:</p>
<ul>
<li><a href="https://www.ashasexualhealth.org/" target="_blank">American Social Health Association</a><br/>
Phone:800-227-8922 or 919-361-8400</li>
<li><a href="https://www.cdc.gov/nchhstp/default.htm?CDC_AA_refVal=https%3A%2F%2Fwww.cdc.gov%2Fnchhstp%2Findex.html" target="_blank">National Center for HIV/AIDS, Viral Hepatitis, STD, and TB Prevention, CDC, HHS</a><br/>
Phone:Phone: 800-232-4636 (TDD: 888-232-6348)</li>
<li><a href="http://hivtest.org/" target="_blank">National HIV and STD Testing Resources, CDC, HHS</a><br/>
Phone:800-458-5231 or 404-679-3860</li>
<li><a href="https://www.niaid.nih.gov/" target="_blank">National Institute of Allergy and Infectious Diseases, NIH, HHS</a><br/>
Phone:866- 284-4107 or 301-496-5717 (TDD: 800-877-8339)</li>
</ul>
<br/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <h5><u>TB Fact Sheet</u></h5>
What is TB?<br/>
<?php echo $data['text73']??"
TB, or tuberculosis, is a disease caused by bacteria called Mycobacterium tuberculosis. The
bacteria can attack any part of your body, but they usually attack the lungs. TB disease was once
the leading cause of death in the United States.<br/>
In the 1940s, scientist discovered the first of several drugs now used to treat TB. As a result, TB slowly
began to disappear in the United States. But TB has come back. Between 1985 and 1992, the number of
TB cases increased. The country became complacent about TB and funding of TB programs was
decreased. However, with increased funding and attention to the TB problem, we have had a steady
decline in the number of persons with TB, But TB is still a problem; more than 16,000 cases were reported
in 2000 in the United States.<br/>
TB is spread through the air from one person to another. The bacteria are put into the air when a person
with TB disease of the lungs or throat coughs or sneezes. People nearby may breathe in these bacteria and
become infected.<br/>
People who are infected with latent TB do not feel sick, do not have any symptoms, and cannot spread TB.
But they may develop TB disease at some time in the future. People with TB disease can be treated and
cured if they seek medical help. Even better, people who have latent TB infection but are not yet sick can
take medicine so that they will never develop TB disease.<br/><b>"?>
How is TB Spread?</b><br/><?php echo $data['text74']??"
TB is spread through the air from one person to another. The bacteria are put into the air when a person
with TB disease of the lungs or throat coughs or sneezes. People nearby may breathe in these bacteria and
become infected.<br/>
When a person breathes in TB bacteria, the bacteria can settle in the lungs and begin to grow. From there,
they can move through the blood to other parts of the body, such as the kidney, spine, and brain.
TB in the lungs or throat can be infectious. This means that the bacteria can be spread to other people. TB
in other parts of the body, such as the kidney or spine, is usually not infectious.
People with TB disease are most likely to spread it to people they spend time with every day. This includes
family members, friends and coworkers."?><br/>
<b>What is latent TB infection?</b><br/><?php echo $data['text75']??"
In most people who breathe in TB bacteria and become infected, the body is able to fight the bacteria to
stop them from growing. The bacteria become inactive, but they remain alive in the body and can become
active later. This is called latent TB infection. People with latent TB infection</td></tr>
<tr><td>
<ul>
<li>Have no symptoms
<li>Do not feel sick
<li>Cannot spread TB to others
<li>Usually have positive skin test reaction
<li>Can develop TB disease later in life if they do not receive treatment for latent TB infection
Many people who have latent TB infection never develop TB disease. In these people, the TB bacteria
remain inactive for a lifetime without causing disease. But in other people, especially people who have
weak immune systems, the bacteria become active and cause TB disease.</li></ul>"?>
What is TB disease?<br/><?php echo $data['text76']??"
TB bacteria become active if the immune system cannot stop them from growing. The active bacteria
begin to multiply in the body and cause TB disease. Some people develop TB disease soon after becoming
infected, before their immune system can fight the TB bacteria. Other people may get sick later, when their
immune system becomes weak for some reason.<br/><br/>
<p>Babies and young children often have weak immune systems. People infected with HIV, the virus that
causes AIDS, have very weak immune systems. Other people can have weak immune systems, too,
especially people with any of these conditions</p>
<ul>
<li>Substance abuse</li>
<li>Diabetes mellitus</li>
<li>Silicosis</li>
<li>Cancer of the head or neck</li>
<li>Leukemia or Hodgkin’s disease</li>
<li>Severe kidney disease</li>
<li>Low body weight</li>
<li>Certain medical treatments (such as corticosteroid treatment or organ transplants)
Symptoms of TB depend on where in the body the TB bacteria are growing. TB bacteria usually grow in
the lungs. TB in the lungs may cause</li>
<li>A bad cough that lasts longer than 2 weeks</li>
<li>Pain in the chest</li>
<li>Coughing up blood or sputum (phlegm from deep inside the lungs)
Other symptoms of TB disease are</li>
<li>Weakness or fatigue</li>
<li>Weight loss</li>
<li>No appetite</li>
<li>Chills</li>
<li>Fever</li>
<li>Sweating at night</li>
</ul>
<p>Differences between Latent TB infection and TB disease</p>
<p>Latent TB Infection TB Disease<br/>
Have no symptoms Symptoms include<br/>
Do not feel sick A bad cough that last longer than 2 weeks<br/>
Cannot spread TB to others  Pain in the chest<br/>
Usually have a positive skin test  Coughing up blood or sputum<br/>
Chest X-ray and sputum test normal  Weakness or fatigue</p>
<ul>
<li> Weight loss</li>
<li> No appetite</li>
<li> Chills</li>
<li> Fever</li>
<li> Sweating at night</li>
</ul>
<p>Usually have a positive skin test<br/>
May have abnormal chest x-ray and/or positive<br/>
sputum smear or culture<br/>
How can I keep from spreading TB?<br/>

The most important way to keep from spreading TB is to take all your medicine, exactly as
directed by your doctor or nurse. You should also keep all of your clinic appointments! Your
doctor or nurse needs to see how you are doing. You may need another chest x-ray or a test of
the phlegm you may cough up. These tests will show whether the medicine is working. They
will also show whether you can still give TB bacteria to others. Be sure to tell the doctor about
anything you think is wrong.<br/>
If you are sick enough with TB to go to a hospital, you may be put in a special room. These rooms use air
vents that keep TB bacteria from spreading. People who work in these rooms must wear a special
facemask to protect themselves from TB bacteria. You must stay in the room so that you will not spread
TB bacteria to other people. Ask a nurse if you need anything that is not in your room.
If you are infectious while you are at home, there are certain things you can do to protect yourself and
others near you. Your doctor may tell you to follow these guidelines to protect yourself and others:</p>
                                </td>
                            </tr>
                            <tr><td>
                            <ul>
<li>The most important thing is to take your medicine.</li>
<li>Always cover your mouth with a tissue when you cough, sneeze, or laugh. Put the tissue in a closed
paper sack and throw it away.</li>
<li>Do not go to work or school. Separate yourself from others and avoid close contact with anyone.
Sleep in a bedroom away from other family members.</li>
<li>Air out your room often to the outside of the building (if it is not too cold outside). TB spreads in
small closed spaces where air does not move. Put a fan in your window to blow out (exhaust) air that
may be filled with TB bacteria. If you open other windows in the room, the fan also will pull in fresh
air. This will reduce the chances that TB bacteria stay in the room and infect someone who breathes
the air.</li>
</ul>
<p>Remember, TB is spread through the air. People cannot get infected with TB bacteria through handshakes,
sitting on toilet seats, or sharing dishes and utensils with someone who has TB.<br/>
After you take medicine for about 2 or 3 weeks, you may no longer be able to spread TB bacteria to others.
If your doctor or nurse agrees, you will be able to go back to your daily routine. Remember, you will get
well only if you take your medicine exactly as your doctor or nurse tells you.<br/>
Think about people who may have spent time with you, such as family members, close friends, and
coworkers. The local health department may need to test them for latent TB infection. TB is especially
dangerous for children and people with HIV infection. If infected with TB bacteria, these people need
preventive therapy right away to keep from developing TB disease.<br/>
What is multidrug-resistant TB (MDR TB)?<br/>
When TB patients do not take their medicine as prescribed, the TB bacteria may become resistant to a
certain drug. This means that the drug can no longer kill the bacteria.
Drug resistance is more common in people who:</p>
<ul>
<li>Have spent time with someone with drug-resistant TB disease</li>
<li>Do not take their medicine regularly</li>
<li>Do not take all of their prescribed medicine</li>
<li>Develop TB disease again, after having taken TB medicine in the past</li>
<li>Come from areas where drug-resistant TB is common</li>
</ul>
<p>Sometimes the bacteria become resistant to more than one drug. This is called multidrug-resistant TB, or
MDR TB. This is a very serious problem. People with MDR TB disease must be treated with special
drugs. These drugs are not as good as the usual drugs for TB and they may cause more side effects. Also,
some people with MDR TB disease must see a TB expert who can closely observe their treatment to make
sure it is working.<br/>
People who have spent time with someone sick with MDR TB disease can become infected with TB
bacteria that are resistant to several drugs. If they have a positive skin test reaction, they may be given
preventive therapy. This is very important for people at high risk of developing MDR TB disease, such as
children and HIV-infected people.<br/>
G:\FORMS\General Client\Client Orientation Handbook.docx 31of 31
Revised 10.4.13</p>"?>
        </td> 
    </tr>
    <tr><td>
    <h5>TUBERCULOSIS (TB) TESTING, SEXUAL TRANSMITTED DISEASES</h5>
<h5><b>Center for Network Therapy does require a TB AND Sexual transmitted disease
testing as part of a wellness treatment plan for clients at risk.</B></h5>
<b>Risk Factors for TB:</b>
<ul>
<li>Living or working in close contact with a large group of people (a hospital
ward, homeless shelter or jail) increases TB risk.</li>
<li>History of injecting drugs increases TB risk.</li>
<li>Living or working with someone who has active TB increases risk.</li>
<li>HIV infection increases risk for TB.</li></ul>
<b>Testing Positive for TB:<br>
Testing positive for TB does not necessarily mean a person has active<br>
TB. A positive TB test does not necessarily mean the person should be
treated for TB or that the person can give TB to someone else.</b><br/>
Testing positive for TB means a person has been exposed to the disease and
should be watched for symptoms of active TB by medical personnel.
Only active TB is contagious. Active TB requires medical treatment
from a doctor/clinic.<br/>
<b>Getting a TB Test if You’re At Risk:</b><br/>
TB testing tells you if you need to watch for symptoms of active TB. Your doctor
can give you a TB test in two visits, two or three days apart. A small amount of
fluid is placed under the skin on the left arm and your skin’s reaction to that fluid
is checked by a nurse or doctor 48 to 72 hours later. If your skin shows a
“positive” reaction, your doctor may recommend a chest X-ray to see if you have
active TB.<br/><br/>
<h5><b>HIV Testing Results</b></h5>
If Patient has left the program by the time the results is made available, patient will be asked to come
into CNT to sit down with the doctor face-to-face to receive the results.
                            </td></tr>
                           
                        </tbody>
                    </table>
                    <br/><br/>
                    <table style="width:100%;table-layout:fixed;display:table;">
                        <tbody>
                             
                    <tr>
                                <td>
                                    <p>I have received the Patient Orientation Manual. My signature below acknowledges
receipt.</p>
                                </td>
                            </tr>
                             </tbody>
                    </table>
                    <table style="width:100%;table-layout:fixed;display:table;">
                        <tbody>
                            <tr>
                                <td></td>
                                <td>Client's Signature : <img src='data:image/png;base64,<?php echo xlt($data['clisign']); ?>' width='100px' height='50px'>  
                                </td>
                                <td>Date :  <?php echo xlt($data['clidate']); ?> </td>
                                
                            </tr>
                            
                        </tbody>
                    </table>
                    <br/><br/>
                    <table style="width:100%;table-layout:fixed;display:table;">
                        <tbody>
                             
                            <tr>
                                <td></td>
                                <td>Family Signature : <img src='data:image/png;base64,<?php echo xlt($data['famsign']); ?>' width='100px' height='50px'> 
                                </td>
                                <td>Date : <?php echo xlt($data['famdate']); ?> </td>                               
                            </tr>
                        </tbody>
                    </table>
                    <br/><br/>
                    <table style="width:100%;table-layout:fixed;display:table;">
                        <tbody>
                             
                            <tr>
                                <td></td>
                                <td>Doctors/ CNT Representative Signature:  <img src='data:image/png;base64,<?php echo xlt($data['docsign']); ?>'   height='50px'>  
                                </td>
                                <td>Date : <?php echo text($data['docdate']); ?> </td>                               
                            </tr>
                        </tbody>
                    </table>
            <?php
        ?>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:right'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

//$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Patient Orientation Manual");
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

$mpdf->Output('Consent_Form.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>